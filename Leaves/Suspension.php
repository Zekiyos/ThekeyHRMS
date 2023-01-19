
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

                    if ($_POST['SuspendedDays'] < 0) {
                        echo"<script type=\"text/javascript\"> alert('The Date value for Reported On is lessthan the date value of Suspension Day.'); </script>";
                    } else
                    if ($obj_leave->CHK_Leave_Existance($_GET['ID'], $_POST['Suspended_Date']) != false) {
                        $Suspended_Date = $_POST['Suspended_Date'];
                        $LeaveType = $obj_leave->CHK_Leave_Existance($_GET['ID'], $_POST['Suspended_Date']);
                        echo"<script type=\"text/javascript\"> alert('This Employee is already on $LeaveType On Date $Suspended_Date.'); </script>";
                    } else {

                        $data = array('ID' => $_GET['ID']
                            , 'FirstName' => $_POST['FirstName']
                            , 'MiddelName' => $_POST['MiddelName']
                            , 'LastName' => $_POST['LastName']
                            , 'Department' => $_POST['Department']
                            , 'SuspendedDays' => $_POST['SuspendedDays']
                            , 'Suspended_Date' => $_POST['Suspended_Date']
                            , 'ReportOn' => $_POST['ReportOn']
                            , 'ModifiedBy' => $_SESSION['MM_Fullname']);

                        $Result1 = $mydb->insert('suspension', $data);

                        if ($Result1)
                            echo "<script type=\"text/javascript\">alert('You have Suspended {$_POST['FirstName']}  {$_POST['MiddelName']} for {$_POST['SuspendedDays']} days Successfully.')</script>";
                    }
                }
                ?>
                <h1 class="form_lable">
                    <?php echo $obj_lang->get('Employee Suspension Form', $lang); ?>
                </h1>
                <?php
                $_GET['TableName'] = "employee_personal_record";
                $_GET['OpenPage'] = "Suspension";

                require_once($base_path . "Search_Name/SearchName.php");
                ?>
                <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                    <table align="center" bgcolor="#EBEBEB">
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('ID', $lang); ?>:</td>
                            <td><input type="text" name="ID" value="<?php
                if (isset($_GET['ID'])) {
                    echo $_GET['ID'];
                }
                ?>" size="10" readonly="readonly" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('First Name', $lang); ?>:</td>
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
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Middel Name', $lang); ?>:</td>
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
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Last Name', $lang); ?>:</td>
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
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Suspended Days', $lang); ?>:</td>
                            <td><input type="text" id="total_leave_day" name="SuspendedDays" value="" size="4" readonly="readonly"/></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Suspenison Date', $lang); ?>:</td>
                            <td><input type="Date" required="required"  id="myLeave_Taken_Date" name="Suspended_Date"  value="<?php echo date("Y-m-d"); ?>" size="15"  /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Report On', $lang); ?>:</td>
                            <td>    
                                <input type="Date" required="required"   id="myLeaveReportOn" name="ReportOn"  value='<?php echo date("Y-m-d"); ?>' /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">&nbsp;</td>
                            <td><input type="submit" value="<?php echo $obj_lang->get('Suspend', $lang); ?>" onClick="return confirm('Are you sure you want to Suspened the selected Employee?')"  /></td>
                        </tr>
                    </table>
                    <input type="hidden" name="MM_insert" value="form1" />
                </form>
                <!-- InstanceEndEditable -->
            </div>
        </div>

    </body>
    <!-- InstanceEnd --> </html>

