<?php
$dont_check = true;
$include_html = true;
$base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
require_once $base_path . 'Templates/head.php';

$mydb = new DataBase();

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

    $data = array('ID' => $_POST['ID']
        , 'FuneralLeaveDays' => $_POST['FuneralLeaveDays']
        , 'RestDay' => $_POST['RestDay']
        , 'FuneralLeave_Taken_Date' => $_POST['FuneralLeave_Taken_Date']
        , 'ReportOn' => $_POST['ReportOn']
        , 'Reported' => $_POST['Reported']
        , 'Report_Back_Date' =>( $_POST['Report_Back_Date']!="")? $_POST['Report_Back_Date']:null
        , 'ModifiedBy' => $_SESSION['MM_Fullname']);

    $mydb->where(array('Auto_ID' => $_POST['Auto_ID']));
    $Result1 = $mydb->update('funeral_leave', $data);

    $updateGoTo = "index.php";



    if ($Result1)
        echo "<script type=\"text/javascript\"> alert('Employee Funeral Leave Data updated Successfully '); </script>";




    header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_HRMS, $HRMS);

if (isset($_GET['Auto_ID'])) {

    $query_RSFuneralLeaveUpdate = "SELECT * FROM  funeral_leave where Auto_ID=" . $_GET['Auto_ID'] . "";
}else
    $query_RSFuneralLeaveUpdate = "SELECT * FROM funeral_leave where Auto_ID=-1";

//$query_RSFuneralLeaveUpdate = "SELECT * FROM funeral_leave";
$RSFuneralLeaveUpdate = mysql_query($query_RSFuneralLeaveUpdate, $HRMS) or die(mysql_error());
$row_RSFuneralLeaveUpdate = mysql_fetch_assoc($RSFuneralLeaveUpdate);
$totalRows_RSFuneralLeaveUpdate = mysql_num_rows($RSFuneralLeaveUpdate);
?>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <font color="#FF6600" size="+1" > <p align="center">Funeral Leave Record Update form</p></font>
    <table align="center">
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">ID:</td>
            <td><input type="text" name="ID" value="<?php echo htmlentities($row_RSFuneralLeaveUpdate['ID'], ENT_COMPAT, 'utf-8'); ?>" size="32" readonly="readonly" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">First Name:</td>
            <td><input type="text" readonly="readonly" name="FirstName" value="<?php echo htmlentities($row_RSFuneralLeaveUpdate['FirstName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Middel Name:</td>
            <td><input type="text" readonly="readonly" name="MiddelName" value="<?php echo htmlentities($row_RSFuneralLeaveUpdate['MiddelName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Last Name:</td>
            <td><input type="text" readonly="readonly" name="LastName" value="<?php echo htmlentities($row_RSFuneralLeaveUpdate['LastName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>

        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Funeral Leave Days:</td>
            <td><input type="number" id="Leavedays" name="FuneralLeaveDays" value="<?php echo htmlentities($row_RSFuneralLeaveUpdate['FuneralLeaveDays'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Rest Day:</td>
            <td><input type="text" id="Restday" name="RestDay" value="<?php echo htmlentities($row_RSFuneralLeaveUpdate['RestDay'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Leave Taken Date:</td>
            <td><input type="date" id="Leave_Taken_Date" name="FuneralLeave_Taken_Date" value="<?php echo htmlentities($row_RSFuneralLeaveUpdate['FuneralLeave_Taken_Date'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Report On:</td>
            <td><input type="text" id="ReportOn" name="ReportOn" value="<?php echo htmlentities($row_RSFuneralLeaveUpdate['ReportOn'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Reported:</td>
            <td><input type="text" name="Reported" value="<?php echo htmlentities($row_RSFuneralLeaveUpdate['Reported'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Report Back Date:</td>
            <td><input type="date" name="Report_Back_Date" value="<?php echo htmlentities($row_RSFuneralLeaveUpdate['Report_Back_Date'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" value="Update record" /></td>
        </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="Auto_ID" value="<?php echo $row_RSFuneralLeaveUpdate['Auto_ID']; ?>" />
</form>