<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Thekey HRMS</title>
        <?php
        $base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
        require_once $base_path . 'Templates/head.php';
        ?>
    </head>
    <body>
        <div id="busy">
            <img alt="Am Working" src="http://<?php echo $base_url ?>images/BusyAnimation.gif">
        </div>
        <div id="thekey_page">
            <?php require_once $base_path . 'Templates/header.php'; ?>
            <div id="mainContent">
                <?php require_once('../Classes/Class_Leave.php'); ?>
                <?php
                echo '<p class="WelCome">Wel Come "' . $_SESSION['MM_Fullname'] . "\"</p>";
                $mydb = new DataBase();
                ?>     
                <?php
                $editFormAction = $_SERVER['PHP_SELF'];
                if (isset($_SERVER['QUERY_STRING'])) {
                    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
                }
                if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
                    $obj_leave = new leave();
                    if (($_POST['Leavedays'] < 0) OR ($_POST['Leave_Taken_Date'] > $_POST['ReportOn'])) {
                        echo"<script type=\"text/javascript\"> alert('The Date value for Reported On is lessthan the date value of Leave Grant Day.'); </script>";
                    } else
                    if ($obj_leave->CHK_Leave_Existance($_GET['ID'], $_POST['Leave_Taken_Date']) != false) {
                        $Leave_Taken_Date = $_POST['Leave_Taken_Date'];
                        $LeaveType = $obj_leave->CHK_Leave_Existance($_GET['ID'], $_POST['Leave_Taken_Date']);
                        echo "<script type=\"text/javascript\"> alert('This Employee is already taken $LeaveType On Date $Leave_Taken_Date.'); </script>";
                    } else {
                        $db = 'ThekeyHRMSDB';
                        $ID = $_GET['ID'];
                        $FirstName = $_POST['FirstName'];
                        $MiddelName = $_POST['MiddelName'];
                        $LastName = $_POST['LastName'];
                        $sqlDE = "SELECT `ID` , FirstName ,MiddelName , LastName,`Date_Employement`,
		period_diff( date_format( now( ) , '%Y%m' ) ,
		date_format( `Date_Employement` , '%Y%m' ) ) AS Workingmonths FROM 
		$db.employee_personal_record where ID= '" . $ID . "' and FirstName='" . $FirstName . "'";
                        $resultDE = mysql_query($sqlDE) or die(mysql_error());
                        $rowDE = mysql_fetch_array($resultDE);

                        $dateofemployeement = $rowDE['Date_Employement'];

                        $WorkingMonth = $rowDE['Workingmonths'];

                        $noyear = ($rowDE['Workingmonths']) / 12;

                       
//Old annual leave setting using company setting rules
					  // list($Company_Name, $Annual_Leave_Expiry_Year, $Annual_Leave_Initial_Days, $Annual_Leave_CONST_Year) = $obj_leave->get_Company_Annual_Leave_Setting();

					   
 list($Company_Name, $Annual_Leave_Expiry_Year, $Annual_Leave_Initial_Days, $Annual_Leave_CONST_Year) = $obj_leave->get_annual_leave_setting($dateofemployeement);

					   
					   //                        if (strtoupper($Company_Name) == strtoupper("Sher Ethiopia plc")) {
//                            if ($dateofemployeement <= "2010-12-01")
//                                $initialALdays = 14;
//                            else
//                                $initialALdays = $Annual_Leave_Initial_Days;
//                        }
//                        else
                            $initialALdays = $Annual_Leave_Initial_Days;
                        $Annual_Leave_CONST_Year = $Annual_Leave_CONST_Year;
                        $totalALdays = $obj_leave->AnnualLeaveCalcualte($initialALdays, $Annual_Leave_CONST_Year, $db, $_GET['ID'], $_POST['FirstName']);
                        $TotalTakenDay = $obj_leave->ALTotalTakenDay($db, $_GET['ID'], $_POST['FirstName'], 0);
                        $TotalLeftDays = $obj_leave->ALTotalLeftDay($totalALdays, $TotalTakenDay);
                        $TotalLeftDays = $TotalLeftDays - $_POST['Leavedays'];
                        if ($TotalLeftDays > 0) { //comparing the requseted leave with current left status
                            $data = array('ID' => $_GET['ID']
                                , 'FirstName' => $_POST['FirstName']
                                , 'MiddelName' => $_POST['MiddelName']
                                , 'LastName' => $_POST['LastName']
                                , 'Department' => $_POST['Department']
                                , 'Leavedays' => $_POST['Leavedays']
                                , 'Restday' => $_POST['Restday']
                                , 'Leave_Taken_Date' => $_POST['Leave_Taken_Date']
                                , 'ReportOn' => $_POST['ReportOn']
                                , 'ModifiedBy' => $_SESSION['MM_Fullname']);

                            $Result1 = $mydb->insert('annual_leave', $data);

                            if ($Result1)
                                echo "<script type=\"text/javascript\">alert('You have granted Annual Leave for {$_POST['FirstName']}  {$_POST['MiddelName']} {$_POST['Leavedays']} days Successfully.')</script>";
                            $TotalTakenDay = $TotalTakenDay + $_POST['Leavedays'];

                            echo '<div class="pop_up_div" title="Total Annual Leave:">';
                            echo '<div style="display:block;overflow:hidden;" >';
                            echo "<font color=\"#FF6600\"  size=\"+1.5\" face=\"Times New Roman, Times, serif\">This Annual Leave is Calcualted as of Today date " . date("Y-m-d") . " for Employee {$_POST['FirstName']} {$_POST['MiddelName']} {$_POST['LastName']} employeed on {$dateofemployeement}</font><br/>";
                            echo "<br/>";
                            echo "<br/>";
                            echo $obj_leave->ALYearAllocation($totalALdays, $initialALdays, $Annual_Leave_CONST_Year, $dateofemployeement) . "<br>";
                            echo "Total Left Annual Leave:";
                            echo $obj_leave->ALYearAllocation($TotalLeftDays, $initialALdays, $Annual_Leave_CONST_Year, $dateofemployeement) . "<br>";
                            $sqlWM = "SELECT `ID` , FirstName ,MiddelName , LastName,`Date_Employement` ,
		period_diff( date_format( now( ) , '%Y%m' ) ,
		date_format( `Date_Employement` , '%Y%m' ) ) AS Workingmonths FROM 
		$db.employee_personal_record where ID= '" . $ID . "' and FirstName='" . $FirstName . "'";

                            $resultWM = mysql_query($sqlWM) or die(mysql_error());

                            $rowWM = mysql_fetch_array($resultWM);

                            $WorkingMonth = $rowWM['Workingmonths'];
                            $noyear = $WorkingMonth / 12;
                            $date = date('Y-m-d');
                            list($thisyear, $lastyear, $beforelastyear) = $obj_leave->AL3YearAllocation($totalALdays, $noyear);
                            list($thisyearLeft, $lastyearLeft, $beforelastyearLeft) = $obj_leave->AL3YearAllocation($TotalLeftDays, $noyear);

                            echo "<a href=\"Annual_Leave_Application_format/ALReport.php?" .
                            "ID={$_GET['ID']}&" .
                            "FirstName={$_POST['FirstName']}&" .
                            "MiddelName={$_POST['MiddelName']}&" .
                            "LastName={$_POST['LastName']} &" .
                            "Department={$_POST['Department']}&" .
                            "Date_Employement=" . $dateofemployeement . "&" .
                            "Workingmonths={$WorkingMonth}&" .
                            "Leave_Taken_Date={$_POST['Leave_Taken_Date']}&" .
                            "ReportOn={$_POST['ReportOn']}&" .
                            "Leavedays={$_POST['Leavedays']}&" .
                            "Restday={$_POST['Restday']}&" .
                            "TotalTakenDay={$TotalTakenDay}&" .
                            "TotalLeftDays={$TotalLeftDays}&" .
                            "thisyearLeft={$thisyearLeft}&" .
                            "lastyearLeft={$lastyearLeft}&" .
                            "initialALdays={$initialALdays}&" .
                            "Annual_Leave_CONST_Year={$Annual_Leave_CONST_Year}&" .
                            "beforelastyearLeft={$beforelastyearLeft}";

                            echo "\"  target=\"_blank\" class=\".button\">Annual Leave Report</a>";
                            echo '</div>';
                            echo '</div>';
                        }
                        else
                            echo "<script type=\"text/javascript\"> alert('The requested annual leave days are MORE THAN current total Left annual leave status of the selected employee!!                                                    Please try to decrease granted leave days.'); </script>";
                    }
                }

                /* mysql_select_db($database_HRMS, $HRMS);
                $query_RSAnnualLeave = "SELECT * FROM annual_leave";
                $RSAnnualLeave = mysql_query($query_RSAnnualLeave, $HRMS) or die(mysql_error());
                $row_RSAnnualLeave = mysql_fetch_assoc($RSAnnualLeave);
                $totalRows_RSAnnualLeave = mysql_num_rows($RSAnnualLeave);

                mysql_select_db($database_HRMS, $HRMS);
                $query_RSID4AnnualLeave = "SELECT * FROM employee_personal_record";
                $RSID4AnnualLeave = mysql_query($query_RSID4AnnualLeave, $HRMS) or die(mysql_error());
                $row_RSID4AnnualLeave = mysql_fetch_assoc($RSID4AnnualLeave);
                $totalRows_RSID4AnnualLeave = mysql_num_rows($RSID4AnnualLeave);

                mysql_select_db($database_HRMS, $HRMS);
                $query_RSALDeatilEntryFromALCaluate = "SELECT * FROM annual_leave_calculate";
                $RSALDeatilEntryFromALCaluate = mysql_query($query_RSALDeatilEntryFromALCaluate, $HRMS) or die(mysql_error());
                $row_RSALDeatilEntryFromALCaluate = mysql_fetch_assoc($RSALDeatilEntryFromALCaluate);
                $totalRows_RSALDeatilEntryFromALCaluate = mysql_num_rows($RSALDeatilEntryFromALCaluate);

                mysql_select_db($database_HRMS, $HRMS);
                $query_RSALDeatilEntry = "SELECT * FROM annual_leave_detail";
                $RSALDeatilEntry = mysql_query($query_RSALDeatilEntry, $HRMS) or die(mysql_error());
                $row_RSALDeatilEntry = mysql_fetch_assoc($RSALDeatilEntry);
                $totalRows_RSALDeatilEntry = mysql_num_rows($RSALDeatilEntry);*/
                ?>

                <h1 class="form_lable">
                    <?php echo $obj_lang->get('Annual Leave Grant Form', $lang); ?>
                </h1>


                <?php
                $_GET['TableName'] = "employee_personal_record";

                $_GET['OpenPage'] = "Annual_Leave_Grant";

                require_once($base_path . "Search_Name/SearchName.php");
                ?>


                <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                    <table width="400" height="462" align="center" background="" bgcolor="#EBEBEB">
                        <tr valign="baseline">
                            <td width="128" align="right" nowrap="nowrap"> <?php echo $obj_lang->get('Selected ID', $lang); ?>:</td>
                            <td width="385">
                                <input type="text" value="<?php
                if (isset($_GET['ID'])) {
                    //mysql_select_db('ThekeyHRMSlanguage');					
                    echo $_GET['ID'];
                }
                ?>" size="10" readonly="readonly"  />     
                            </td>
                        </tr>

                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('First Name', $lang); ?>:</td>
                            <td align="left"><input name="FirstName" type="text" value="<?php
                                       $query = "SELECT * FROM employee_personal_record";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {
                                               if ($row['ID'] == $_GET['ID']) {
                                                   echo "{$row['FirstName']}";
                                               }
                                           }
                                       }
                ?>"  


                                                    size="20" maxlength="20" readonly="readonly" align="left" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Middel Name', $lang); ?>:</td>
                            <td><input name="MiddelName" type="text" value="<?php
                                                    $query = "SELECT * FROM employee_personal_record";
                                                    $result = mysql_query($query);
                                                    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                                        if (isset($_GET['ID'])) {


                                                            if ($row['ID'] == $_GET['ID']) {
                                                                echo "{$row['MiddelName']}";
                                                            }
                                                        }
                                                    }
                ?>"size="20" maxlength="20" readonly="readonly" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td  align="right" nowrap="nowrap"><?php echo $obj_lang->get('Last Name', $lang); ?>:</td>
                            <td><input name="LastName" type="text" value="<?php
                                       $query = "SELECT * FROM employee_personal_record";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {


                                               if ($row['ID'] == $_GET['ID']) {
                                                   echo "{$row['LastName']}";
                                               }
                                           }
                                       }
                ?>" size="20" maxlength="20" readonly="readonly" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td  align="right" nowrap="nowrap"><?php echo $obj_lang->get('Department', $lang); ?>:</td>
                            <td>
                                <input name="Department" type="text" value="<?php
                                       $query = "SELECT * FROM employee_personal_record";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {
                                               if ($row['ID'] == $_GET['ID']) {
                                                   echo "{$row['Department']}";
                                               }
                                           }
                                       }
                ?>" size="20" maxlength="20" readonly="readonly" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td  align="right" nowrap="nowrap"><?php echo $obj_lang->get('Leave days', $lang); ?>:</td>
                            <td><input  id="Leavedays" required="required"  name="Leavedays" type="number" value="0" size="5" maxlength="4"  /></td>            
                        </tr>
                        <tr valign="baseline">
                            <td  align="right" nowrap="nowrap"><?php echo $obj_lang->get('Rest days', $lang); ?>:</td>
                            <td><input name="Restday" id="Restday"  required="required"  type="number" value="0" size="5" maxlength="4" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Leave Taken Date', $lang); ?>:</td>
                            <td><input type="Date" id="Leave_Taken_Date" required="required" name="Leave_Taken_Date"  value="<?php echo date("Y-m-d"); ?>" size="15"  /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Report On', $lang); ?>:</td>
                            <td><input type="text"  id="ReportOn" name="ReportOn" readonly="readonly" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">&nbsp;</td>
                            <td align="right"> <input type="submit" value="<?php echo $obj_lang->get('Grant', $lang); ?>" onClick="return confirm('Are you sure you want to Grant Annual Leave for this Employee?')"   /></td>
                        </tr>
                    </table>
                    <p>
                        <input type="hidden" name="MM_insert" value="form1" />
                    </p>
                </form>
                <!-- InstanceEndEditable -->
            </div>
        </div>
    </body>
    <!-- InstanceEnd --> 
</html>