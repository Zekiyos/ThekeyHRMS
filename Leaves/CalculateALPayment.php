
<script type="text/javascript" src="../Js/DailyRate.js">

</script> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/ThekeyHRMS_main_Template.dwt" codeOutsideHTMLIsLocked="false" -->
    <head>
        <!--meta http-equiv="Content-Type" content="text/html; charset=utf-8" /-->
        <title>Thekey HRMS</title>

        <?php
        $base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
        require_once $base_path . 'Templates/head.php';
        ?>
    </head>

    <body>
        <div id="busy" >
            <img alt="Am Working" src="http://<?php echo $base_url ?>images/BusyAnimation.gif">
        </div>
        <div id="thekey_page">
            <?php require_once $base_path . 'Templates/header.php'; ?>

            <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" -->
                <?php
                echo '<p class="WelCome">Wel Come "' . $_SESSION['MM_Fullname'] . "\"</p>";

                $mydb = new DataBase();
                ?>     


                <?php require_once('../Classes/Class_Leave.php'); ?>
                <?php
                $editFormAction = $_SERVER['PHP_SELF'];
                if (isset($_SERVER['QUERY_STRING'])) {
                    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
                }

                if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

                    $obj_leave = new leave();

                    $db = "ThekeyHRMSDB";


                    $ID = $_POST['ID'];
                    $FirstName = $_POST['FirstName'];

                    $sqlDE = "SELECT `ID` , FirstName ,MiddelName , LastName,`Date_Employement`,
		period_diff( date_format( now( ) , '%Y%m' ) ,
		date_format( `Date_Employement` , '%Y%m' ) ) AS Workingmonths FROM 
		$db.employee_personal_record where ID= '" . $ID . "' and FirstName='" . $FirstName . "'";
                    $resultDE = mysql_query($sqlDE) or die(mysql_error());
                    $rowDE = mysql_fetch_array($resultDE);

                    $dateofemployeement = $rowDE['Date_Employement'];


                    list($Company_Name, $Annual_Leave_Expiry_Year, $Annual_Leave_Initial_Days, $Annual_Leave_CONST_Year) = $obj_leave->get_Company_Annual_Leave_Setting();

                    //for company wich it has to many initial days due to CBA rule change
                    if (strtoupper($Company_Name) == strtoupper("Sher Ethiopia plc")) {
                        if ($dateofemployeement <= "2010-12-01")
                            $initialALdays = 14;
                        else
                            $initialALdays = $Annual_Leave_Initial_Days;
                    }
                    else
                        $initialALdays = $Annual_Leave_Initial_Days;


                    $Annual_Leave_CONST_Year = $Annual_Leave_CONST_Year;


                    $totalALdays = $obj_leave->AnnualLeaveCalcualte($initialALdays, $Annual_Leave_CONST_Year, $db, $_GET['ID'], $_POST['FirstName']);

                    $TotalTakenDay = $obj_leave->ALTotalTakenDay($db, $_GET['ID'], $_POST['FirstName'], 0);

                    $TotalLeftDays = $obj_leave->ALTotalLeftDay($totalALdays, $TotalTakenDay);

                    $TotalLeftDays = $TotalLeftDays - $_POST['Leavedays'];

                    $Payment = $obj_leave->Clac_AL_Payment($TotalLeftDays, $_POST['SalaryPerDay']);

                    $FirstName = $_POST['FirstName'];
                    $MiddelName = $_POST['MiddelName'];
                    echo"<script type=\"text/javascript\"> alert(' $FirstName $MiddelName untaken Annual Leave Days is $TotalLeftDays.In Payment  $Payment birr.'); </script>";
                }
                ?>
                <h1 class="form_lable">
                    <?php echo $obj_lang->get('Annual Leave Payment Calculator', $lang); ?>
                </h1>
                <?php
                $_GET['TableName'] = "employee_personal_record";

                $_GET['OpenPage'] = "CalculateALPayment";

                require_once($base_path . "Search_Name/SearchName.php");
                ?>
                <?php
                $obj_leave = new leave();

                $db = "ThekeyHRMSDB";
                ?>


                <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" onMouseOver="DailyRate('Salary','WorkingDays','SalaryPerDay')">  

                    <table width="475" height="413" align="center" background="" bgcolor="#EBEBEB">
                        <tr valign="baseline">
                            <td width="61" height="34" align="right" nowrap="nowrap"> <?php echo $obj_lang->get('Selected ID', $lang); ?>:</td>
                            <td width="435">
                                <input name="ID" value="<?php
                if (isset($_GET['ID'])) {
                    //mysql_select_db('ThekeyHRMSlanguage');					
                    echo $_GET['ID'];
                }
                ?>" size="10" readonly="readonly"  />     
                            </td>
                        </tr>

                        <tr valign="baseline">
                            <td height="40" align="right" nowrap="nowrap"><?php echo $obj_lang->get('First Name', $lang); ?>:</td>
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
                            <td height="37" align="right" nowrap="nowrap"><?php echo $obj_lang->get('Middel Name', $lang); ?>:</td>
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
                            <td height="32"  align="right" nowrap="nowrap"><?php echo $obj_lang->get('Last Name', $lang); ?>:</td>
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
                            <td height="35"  align="right" nowrap="nowrap"><?php echo $obj_lang->get('Department', $lang); ?>:</td>
                            <td><input name="Department" type="text" value="<?php
                                       $query = "SELECT * FROM employee_personal_record";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {


                                               if ($row['ID'] == $_GET['ID']) {
                                                   echo "{$row['Department']}";
                                               }
                                           }
                                       }
                ?>" size="30" maxlength="30" readonly="readonly" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td height="38"  align="right" nowrap="nowrap"><?php echo $obj_lang->get('Salary', $lang); ?>:</td>
                            <td><input  id="Salary"name="Salary" type="text" value="<?php
                                       $query = "SELECT * FROM employee_personal_record";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {


                                               if ($row['ID'] == $_GET['ID']) {
                                                   echo "{$row['Salary']}";
                                               }
                                           }
                                       }
                ?>" size="10" maxlength="10" readonly="readonly" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td height="37"  align="right" nowrap="nowrap"><?php echo $obj_lang->get('Untaken Leave days', $lang); ?>:</td>
                            <td>
                                <input  id="TotalLeftDays" name="TotalLeftDays" type="text" value="<?php
                                        if (isset($_GET['ID'])) {
                                            list($Company_Name, $Annual_Leave_Expiry_Year, $Annual_Leave_Initial_Days, $Annual_Leave_CONST_Year) = $obj_leave->get_Company_Annual_Leave_Setting();

                                            $initialALdays = $Annual_Leave_Initial_Days;
                                            $Annual_Leave_CONST_Year = $Annual_Leave_CONST_Year;


                                            $totalALdays = $obj_leave->AnnualLeaveCalcualte($initialALdays, $Annual_Leave_CONST_Year, $db, $_GET['ID'], "");

                                            $TotalTakenDay = $obj_leave->ALTotalTakenDay($db, $_GET['ID'], "", 0);

                                            $TotalLeftDays = $obj_leave->ALTotalLeftDay($totalALdays, $TotalTakenDay);

                                            echo $TotalLeftDays;
                                        }
                ?>" size="5" maxlength="4" readonly="readonly"  />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td height="40"  align="right" nowrap="nowrap"><?php echo $obj_lang->get('No of Working days', $lang); ?>:</td>
                            <td>
                                <input required="required" onkeypress="DailyRate('Salary','WorkingDays','SalaryPerDay')" id="WorkingDays" name="WorkingDays" type="text" value="26" size="5" maxlength="4"  />
                                After Leave Days:<input  required="required" id="Leavedays" name="Leavedays" type="text" value="0" size="5" maxlength="4"  />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td height="68"  align="right" nowrap="nowrap"><?php echo $obj_lang->get('Salary Per Day', $lang); ?>:</td><td><input  id="SalaryPerDay" name="SalaryPerDay" type="text" value="" size="5" maxlength="4" readonly="readonly"  />    </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">&nbsp;</td>
                            <td> <input type="submit" value="<?php echo $obj_lang->get('Calculate Annual Leave Payment', $lang); ?>"    /></td>
                        </tr>

                    </table>
                    </font>
                    <p>





                        <input type="hidden" name="MM_insert" value="form1" />

                        <!-- InstanceEndEditable -->
                        </div>
                        </div>

                        </body>
                        <!-- InstanceEnd --> </html>


