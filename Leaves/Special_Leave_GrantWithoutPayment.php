
<script src="../Js/Numberofdays.js" type="text/javascript"></script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/ThekeyHRMS_main_Template.dwt" codeOutsideHTMLIsLocked="false" -->
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

                    if ($_POST['SpecialLeaveDays'] < 0) {
                        echo"<script type=\"text/javascript\"> alert('The Date value for Reported On is lessthan the date value of Leave Grant Day.'); </script>";
                    } else
                    if ($obj_leave->CHK_Leave_Existance($_GET['ID'], $_POST['SpecialLeave_Taken_Date']) != false) {
                        $Leave_Taken_Date = $_POST['SpecialLeave_Taken_Date'];
                        $LeaveType = $obj_leave->CHK_Leave_Existance($_GET['ID'], $_POST['SpecialLeave_Taken_Date']);
                        echo"<script type=\"text/javascript\"> alert('This Employee is already taken $LeaveType On Date $Leave_Taken_Date.'); </script>";
                    } else {



                        $LeaveType = "Special Leave Without Payment";

                        $data = array('ID' => $_POST['ID']
                            , 'FirstName' => $_POST['FirstName']
                            , 'MiddelName' => $_POST['MiddelName']
                            , 'LastName' => $_POST['LastName']
                            , 'Department' => $_POST['Department']
                            , 'SpecialLeaveDays' => $_POST['SpecialLeaveDays']
                            , 'SpecialLeave_Taken_Date' => $_POST['SpecialLeave_Taken_Date']
                            , 'ReportOn' => $_POST['ReportOn']
                            , 'LeaveType' => $LeaveType
                            , 'ModifiedBy' => $_SESSION['MM_Fullname']);

                        $Result1 = $mydb->insert('Special_leave', $data);

                        if ($Result1)
                            echo "<script type=\"text/javascript\">alert('You have granted Special Leave for {$_POST['FirstName']}  {$_POST['MiddelName']} {$_POST['SpecialLeaveDays']} days Successfully.')</script>";
                    }
                }

                mysql_select_db($database_HRMS, $HRMS);
                $query_RSMaternityLeaveGrant = "SELECT * FROM Paternity_leave";
                $RSMaternityLeaveGrant = mysql_query($query_RSMaternityLeaveGrant, $HRMS) or die(mysql_error());
                $row_RSMaternityLeaveGrant = mysql_fetch_assoc($RSMaternityLeaveGrant);
                $totalRows_RSMaternityLeaveGrant = mysql_num_rows($RSMaternityLeaveGrant);
                ?>
                <?php //require_once("Select_ID4SpecialLeaveGrantWithoutPayment.php"); ?>
                <h1 class="form_lable">
                    <?php echo $obj_lang->get('Special Leave Grant', $lang); ?>
                    <?php echo $obj_lang->get('(WITHOUT PAYMENT)', $lang); ?>
                </h1>

                <?php
                $_GET['TableName'] = "employee_personal_record";

                $_GET['OpenPage'] = "Special_Leave_GrantWithoutPayment";

                require_once($base_path . "Search_Name/SearchName.php");
                ?>
                <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                    <table align="center" bgcolor="#EBEBEB">
                        <tr valign="baseline">
                            <td height="34" align="right" nowrap="nowrap"><?php echo $obj_lang->get('ID', $lang); ?>:</td>
                            <td><input type="text" name="ID" value="<?php
                if (isset($_GET['ID'])) {
                    echo $_GET['ID'];
                }
                ?>" size="10" readonly="readonly" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td height="31" align="right" nowrap="nowrap"><?php echo $obj_lang->get('First Name', $lang); ?>:</td>
                            <td><input type="text" name="FirstName" value="<?php
                                       $query = "SELECT * FROM employee_personal_record";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {

                                               if ($row['ID'] == $_GET['ID']) {

                                                   echo "{$row['FirstName']}";
                                               }
                                           }
                                       }
                ?>" size="20" readonly="readonly" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td height="34" align="right" nowrap="nowrap"><?php echo $obj_lang->get('Middel Name', $lang); ?>:</td>
                            <td><input type="text" name="MiddelName" value="<?php
                                       $query = "SELECT * FROM employee_personal_record";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {

                                               if ($row['ID'] == $_GET['ID']) {

                                                   echo "{$row['MiddelName']}";
                                               }
                                           }
                                       }
                ?>" size="20" readonly="readonly" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td height="36" align="right" nowrap="nowrap"><?php echo $obj_lang->get('Last Name', $lang); ?>:</td>
                            <td><input type="text" name="LastName" value="<?php
                                       $query = "SELECT * FROM employee_personal_record";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {

                                               if ($row['ID'] == $_GET['ID']) {

                                                   echo "{$row['LastName']}";
                                               }
                                           }
                                       }
                ?>" size="20" readonly="readonly" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td height="40" align="right" nowrap="nowrap"><?php echo $obj_lang->get('Department', $lang); ?>:</td>
                            <td><input type="text" name="Department" value="<?php
                                       $query = "SELECT * FROM employee_personal_record";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {
                                               if ($row['ID'] == $_GET['ID']) {

                                                   echo "{$row['Department']}";
                                               }
                                           }
                                       }
                ?>" size="20" readonly="readonly" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td height="36" align="right" nowrap="nowrap"><?php echo $obj_lang->get('Special Leave Days', $lang); ?>:</td>
                            <td><input type="text" id="total_leave_day" name="SpecialLeaveDays" value="" size="4" readonly="readonly" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td height="34" align="right" nowrap="nowrap"><?php echo $obj_lang->get('Special Leave Taken Date', $lang); ?>:</td>
                            <td><input type="Date" required="required" id="myLeave_Taken_Date"  name="SpecialLeave_Taken_Date"  value="<?php echo date("Y-m-d"); ?>" size="15"  /></td>
                        </tr>
                        <tr valign="baseline">
                            <td height="35" align="right" nowrap="nowrap"><?php echo $obj_lang->get('Report On', $lang); ?>:</td>
                            <td>    
                                <input type="Date" required="required" id="myLeaveReportOn" name="ReportOn"  value='<?php echo date("Y-m-d"); ?>' /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">&nbsp;</td>
                            <td><input type="submit" value="<?php echo $obj_lang->get('Grant Special leave', $lang); ?>" onClick="return confirm('Are you sure you want to Grant Special Leave for this Employee?')"  /></td>
                        </tr>
                    </table>
                    <input type="hidden" name="MM_insert" value="form1" />
                </form>


                <blockquote>&nbsp;</blockquote>
            </div>
            <!-- InstanceEndEditable -->
        </div>
        </div>

    </body>
    <!-- InstanceEnd --> </html>
<?php
mysql_free_result($RSMaternityLeaveGrant);
?>
