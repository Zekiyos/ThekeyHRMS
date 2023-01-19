

<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

    //DELETE FROM table_name WHERE some_column=some_value


    $insertSQL = sprintf("INSERT INTO terminated_employee (ID,FirstName, MiddelName, LastName, Department, Terminated_Date,Termination_Reason) VALUES (%s,%s, %s, %s, %s, %s, %s)", GetSQLValueString($_GET['ID'], "text"), GetSQLValueString($_POST['FirstName'], "text"), GetSQLValueString($_POST['MiddelName'], "text"), GetSQLValueString($_POST['LastName'], "text"), GetSQLValueString($_POST['Department'], "text"), GetSQLValueString($_POST['Terminated_Date'], "date"), GetSQLValueString($_POST['Termination_Reason'], "text")
    );

    /*     * **************************Updating weekly attendance for employee absent hour after termination*** */


    $DateValue = $_POST['Terminated_Date'];
    $UnpaidHourAfterTerminted = "Select @TotalMonthOffDay:=DAY( LAST_DAY('" . $DateValue . "' ))/7 AS TotalMonthOffDay,
         @AbsentDay:= DateDiff( LAST_DAY('" . $DateValue . "' ),'" . $DateValue . "') AS AbsentDay,
	    @AbsentOffDay:=@AbsentDay * @TotalMonthOffDay / DAY( LAST_DAY('" . $DateValue . "' )) AS AbsentOffDay,
	
	@AbsentWorkingDay:=@AbsentDay - @AbsentOffDay AS AbsentWorkingDay,
	IF(YEAR('" . $DateValue . "')=YEAR(CURDATE()) AND MONTH('" . $DateValue . "')=MONTH(CURDATE()),
	@AbsentWorkingHour:= @AbsentWorkingDay *8, 0)  AS AbsentWorkingHour";

    $resultUnpaidHourAfterTerminted = mysql_query($UnpaidHourAfterTerminted);
    while ($rowUnpaidHourAfterTerminted = mysql_fetch_array($resultUnpaidHourAfterTerminted, MYSQL_ASSOC)) {
        $AbsentWorkingHourAfterTerminted = $rowUnpaidHourAfterTerminted['AbsentWorkingHour'];


        $sqlupdateAbsentHour = "UPDATE `week_6` SET 
										`No_Absent`=(
   Select `No_Absent` FROM (
           SELECT `No_Absent` FROM week_6 WHERE  ID='" . $_GET['ID'] . "') AS Sql1 ) + " . $AbsentWorkingHourAfterTerminted . ",
										WHERE  ID='" . $_GET['ID'] . "'";

        mysql_query($sqlupdateAbsentHour);
    }
    /*     * **************************End of upating dat fro employee absent hour after termination for attendance entry */

    //	$Activeupdate ="UPDATE employee_personal_Record SET `Active`='0' WHERE ID = '". $_GET['ID'] ."'";
    //DELETE FROM table_name WHERE some_column=some_value
    $Copyannual_leave = "INSERT INTO terminated_employee_annual_leave () SELECT  * FROM annual_leave WHERE ID = '" . $_GET['ID'] . "'";

    $Copydisciplinary_action = "INSERT INTO terminated_employee_disciplinary_action () SELECT  * FROM disciplinary_action WHERE ID = '" . $_GET['ID'] . "'";
    $Copyfuneral_leave = "INSERT INTO terminated_employee_funeral_leave () SELECT  * FROM funeral_leave WHERE ID = '" . $_GET['ID'] . "'";

    $Copymaternity_leave = "INSERT INTO terminated_employee_maternity_leave () SELECT  * FROM maternity_leave WHERE ID = '" . $_GET['ID'] . "'";

    $Copypaternity_leave = "INSERT INTO terminated_employee_paternity_leave () SELECT  * FROM paternity_leave WHERE ID = '" . $_GET['ID'] . "'";

    $Copyspecial_leave = "INSERT INTO terminated_employee_special_leave () SELECT  * FROM special_leave WHERE ID = '" . $_GET['ID'] . "'";


    $Copyrecruitment = "INSERT INTO terminated_employee_recruitment () SELECT  * FROM recruitment WHERE ID = '" . $_GET['ID'] . "'";
    //$Copyemployee_personal_record="INSERT INTO terminated_employee_personal_record () SELECT  * FROM employee_personal_record WHERE ID = '". $_GET['ID'] ."'";
    $Copysick_leave = "INSERT INTO terminated_employee_sick_leave () SELECT  * FROM sick_leave WHERE ID = '" . $_GET['ID'] . "'";

    $Copywedding_leave = "INSERT INTO terminated_employee_wedding_leave () SELECT  * FROM wedding_leave WHERE ID = '" . $_GET['ID'] . "'";


    //$DeleteTerminated ="DELETE FROM employee_personal_Record  WHERE ID = '". $_GET['ID'] ."'";

    $DeleteFromannual_leave = "DELETE FROM annual_leave  WHERE ID = '" . $_GET['ID'] . "'";

    $DeleteFromdisciplinary_action = "DELETE FROM disciplinary_action  WHERE ID = '" . $_GET['ID'] . "'";

    $DeleteFromfuneral_leave = "DELETE FROM funeral_leave  WHERE ID = '" . $_GET['ID'] . "'";

    $DeleteFrommaternity_leave = "DELETE FROM maternity_leave  WHERE ID = '" . $_GET['ID'] . "'";

    $DeleteFrompaternity_leave = "DELETE FROM paternity_leave  WHERE ID = '" . $_GET['ID'] . "'";

    $DeleteFromspecial_leave = "DELETE FROM special_leave  WHERE ID = '" . $_GET['ID'] . "'";

    $DeleteFromemployee_personal_record = "DELETE FROM employee_personal_record  WHERE ID = '" . $_GET['ID'] . "'";

    $DeleteFromrecruitment = "DELETE FROM recruitment  WHERE ID = '" . $_GET['ID'] . "'";

    $DeleteFromsick_leave = "DELETE FROM sick_leave  WHERE ID = '" . $_GET['ID'] . "'";

    $DeleteFromwedding_leave = "DELETE FROM wedding_leave  WHERE ID = '" . $_GET['ID'] . "'";


    ///////// Copy terminated employee detail to dead files databse to future access before deletion
    mysql_query($Copyannual_leave);

    mysql_query($Copydisciplinary_action);

    mysql_query($Copyfuneral_leave);

    mysql_query($Copymaternity_leave);

    mysql_query($Copypaternity_leave);

    mysql_query($Copyspecial_leave);

    //mysql_query($Copyemployee_personal_record);

    mysql_query($Copyrecruitment); //Copy personal reocred if the person is in recuitment table mean in probation period

    mysql_query($Copysick_leave);

    mysql_query($Copywedding_leave);

    ////////// Deleting terminated employee record from current employee database 

    mysql_query($DeleteFromannual_leave);

    mysql_query($DeleteFromdisciplinary_action);

    mysql_query($DeleteFromfuneral_leave);

    mysql_query($DeleteFrommaternity_leave);

    mysql_query($DeleteFrompaternity_leave);

    mysql_query($DeleteFromspecial_leave);


    mysql_query($DeleteFromemployee_personal_record);

    mysql_query($DeleteFromrecruitment); //delete personal reocred if the person is in recuitment table mean in probation period

    mysql_query($DeleteFromsick_leave);

    mysql_query($DeleteFromwedding_leave);


    mysql_select_db($database_HRMS, $HRMS);
    $Result1 = mysql_query($insertSQL, $HRMS) or die(mysql_error());
}

mysql_select_db($database_HRMS, $HRMS);
$query_RSTermination = "SELECT * FROM terminated_employee";
$RSTermination = mysql_query($query_RSTermination, $HRMS) or die(mysql_error());
$row_RSTermination = mysql_fetch_assoc($RSTermination);
$totalRows_RSTermination = mysql_num_rows($RSTermination);
?>
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

                <blockquote>
                    <blockquote>
                        <blockquote>
                            <blockquote>
                                <blockquote>
                                    <blockquote> <font color="#FF6600" size="+1"><?php echo $obj_lang->get('Pobation Period Termination Form', $lang); ?></font>
                                        <script type="text/javascript"> confirm('Are you sure the employee what you want to terminate finished his/her  Clearnace form?It shuld be completed before You proceed to terminate');</script>
                                        <?php //require_once($base_path . "Letters/warning Letters/Select_ID4TerminationProbationPeriod.php"); ?>
                                        <?php
                                        $_GET['TableName'] = "recruitment";

                                        $_GET['OpenPage'] = "Termination4ProbationPeriod";

                                        require_once($base_path . "Search_Name/SearchName.php");
                                        ?>
                                        <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" >
                                            <table width="357" height="345" align="center" bgcolor="#EBEBEB">
                                                <tr valign="baseline">
                                                    <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('ID', $lang); ?>:</td>
                                                    <td><input type="text" name="ID" value="<?php
                                        if (isset($_GET['ID'])) {
                                            echo $_GET['ID'];
                                        }
                                        ?>"  readonly="readonly"/>
                                                    </td>
                                                </tr>



                                                <tr valign="baseline">
                                                    <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('First Name', $lang); ?>:</td>
                                                    <td><input type="text" name="FirstName" value="<?php
                                                               $query = "SELECT * FROM recruitment";
                                                               $result = mysql_query($query);
                                                               while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                                                   if (isset($_GET['ID'])) {


                                                                       if ($row['ID'] == $_GET['ID']) {
                                                                           echo "{$row['FirstName']}";
                                                                       }
                                                                   }
                                                               }
                                        ?>"size="20" maxlength="20" readonly="readonly"  /></td>
                                                </tr>
                                                <tr valign="baseline">
                                                    <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Middel Name', $lang); ?>:</td>
                                                    <td><input type="text" name="MiddelName" value="<?php
                                                               $query = "SELECT * FROM recruitment";
                                                               $result = mysql_query($query);
                                                               while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                                                   if (isset($_GET['ID'])) {
                                                                       if ($row['ID'] == $_GET['ID']) {
                                                                           echo "{$row['MiddelName']}";
                                                                       }
                                                                   }
                                                               }
                                        ?>" size="20" maxlength="20" readonly="readonly"  /></td>
                                                </tr>
                                                <tr valign="baseline">
                                                    <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Last Name', $lang); ?>:</td>
                                                    <td><input type="text" name="LastName" value="<?php
                                                               $query = "SELECT * FROM recruitment";
                                                               $result = mysql_query($query);
                                                               while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                                                   if (isset($_GET['ID'])) {
                                                                       if ($row['ID'] == $_GET['ID']) {
                                                                           echo "{$row['LastName']}";
                                                                       }
                                                                   }
                                                               }
                                        ?>"size="20" maxlength="20" readonly="readonly" /></td>
                                                </tr>
                                                <tr valign="baseline">
                                                    <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Department', $lang); ?>:</td>
                                                    <td><input type="text" name="Department" value="<?php
                                                               $query = "SELECT * FROM recruitment";
                                                               $result = mysql_query($query);
                                                               while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                                                   if (isset($_GET['ID'])) {
                                                                       if ($row['ID'] == $_GET['ID']) {
                                                                           echo "{$row['Department']}";
                                                                       }
                                                                   }
                                                               }
                                        ?>"size="20" maxlength="35" readonly="readonly" /></td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo $obj_lang->get('Termination Reason', $lang); ?>:</td>
                                                    <td><textarea name="Termination_Reason" id="Termination_Reason"></textarea></td>
                                                </tr>
                                                <tr valign="baseline">
                                                    <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Terminated Date', $lang); ?>:</td>
                                                    <td><script type='text/JavaScript' src="../Js/scw.js" ></script>

                                                        <input type="text" name="Terminated_Date" onclick='scwShow(this,event);' value='<?php echo date("Y-m-d"); ?>' /></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $query = "SELECT * FROM equipment_handover";
                                                        $result = mysql_query($query);
                                                        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                                            if (isset($_GET['ID'])) {
                                                                if (($row['ID'] == $_GET['ID']) and ($row['Returned'] == "NO")) {
                                                                    echo "<textarea cols=\"30\" rows=\"3\" readonly=\"readonly\" >Equipment on {$row['FirstName']} {$row['MiddelName']} hand:{$row['EquipmentName']} taken on {$row['Taken_Date']}.</textarea>";
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr valign="baseline">
                                                    <td nowrap="nowrap" align="right">&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                            </table>
                                            <p>
                                                <input type="hidden" name="MM_insert" value="form1" />
                                                <input type="submit" value="<?php echo $obj_lang->get('Terminate', $lang); ?>" onclick="return confirm('Are you sure you want to Terminate this Employee? If you Click Ok Employee will be deleted from current employee list or Click Cancel to Avoid Termination')" />
                                            </p>





                                        </form>

                                        <!-- InstanceEndEditable -->
                                        </div>
                                        </div>

                                        </body>
                                        <!-- InstanceEnd --> </html>

