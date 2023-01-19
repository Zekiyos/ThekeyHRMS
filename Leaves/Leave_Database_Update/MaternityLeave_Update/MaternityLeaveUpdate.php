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

    $data = array(
        'MaternityLeaveDays' => $_POST['MaternityLeaveDays']
        , 'MaternityLeave_Taken_Date' => $_POST['MaternityLeave_Taken_Date']
        , 'ReportOn' => $_POST['ReportOn']
        , 'Reported' => $_POST['Reported']
        , 'Report_Back_Date' => isset($_POST['Report_Back_Date']) ? $_POST['Report_Back_Date'] : null
        , 'ModifiedBy' => $_SESSION['MM_Fullname']);

    $mydb->where(array('Auto_ID' => $_POST['Auto_ID']));
    $Result1 = $mydb->update('maternity_leave', $data);

    $updateGoTo = "index.php";

    if ($Result1)
        echo "<script type=\"text/javascript\"> alert('Employee Maternity Leave Data updated Successfully '); </script>";



   
    header(sprintf("Location: %s", $updateGoTo));
}
?>
<?php
mysql_select_db($database_HRMS, $HRMS);


if (isset($_GET['Auto_ID'])) {

    $query_RSMaternityLeaveUpdate = "SELECT * FROM  maternity_leave where Auto_ID=" . $_GET['Auto_ID'] . "";
}else
    $query_RSMaternityLeaveUpdate = "SELECT * FROM funeral_leave where Auto_ID=-1";


//$query_RSMaternityLeaveUpdate = "SELECT * FROM maternity_leave";
$RSMaternityLeaveUpdate = mysql_query($query_RSMaternityLeaveUpdate, $HRMS) or die(mysql_error());
$row_RSMaternityLeaveUpdate = mysql_fetch_assoc($RSMaternityLeaveUpdate);
$totalRows_RSMaternityLeaveUpdate = mysql_num_rows($RSMaternityLeaveUpdate);
?>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <font color="#FF6600" size="+1" > <p align="center">Maternity Leave Record Update form</p></font>
    <table align="center">
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">ID:</td>
            <td><input type="text" readonly="readonly" name="ID"  value="<?php echo htmlentities($row_RSMaternityLeaveUpdate['ID'], ENT_COMPAT, 'utf-8'); ?>" size="32" readonly="readonly" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">First Name:</td>
            <td><input type="text" readonly="readonly" name="FirstName" value="<?php echo htmlentities($row_RSMaternityLeaveUpdate['FirstName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Middel Name:</td>
            <td><input type="text" readonly="readonly" name="MiddelName" value="<?php echo htmlentities($row_RSMaternityLeaveUpdate['MiddelName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Last Name:</td>
            <td><input type="text" readonly="readonly" name="LastName" value="<?php echo htmlentities($row_RSMaternityLeaveUpdate['LastName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Leave Days:</td>
            <td><input type="text" readonly="readonly" id="total_leave_day" name="MaternityLeaveDays" value="<?php echo htmlentities($row_RSMaternityLeaveUpdate['MaternityLeaveDays'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Leave Taken Date:</td>
            <td><input type="date" id="myLeave_Taken_Date" name="MaternityLeave_Taken_Date" value="<?php echo htmlentities($row_RSMaternityLeaveUpdate['MaternityLeave_Taken_Date'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Report On:</td>
            <td><input type="date" id="myLeaveReportOn" name="ReportOn" value="<?php echo htmlentities($row_RSMaternityLeaveUpdate['ReportOn'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Reported:</td>
            <td><input type="text" name="Reported" value="<?php echo htmlentities($row_RSMaternityLeaveUpdate['Reported'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Report Back Date:</td>
            <td><input type="text" name="Report_Back_Date" value="<?php echo htmlentities($row_RSMaternityLeaveUpdate['Report_Back_Date'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" value="Update record" /></td>
        </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="Auto_ID" value="<?php echo $row_RSMaternityLeaveUpdate['Auto_ID']; ?>" />
</form>