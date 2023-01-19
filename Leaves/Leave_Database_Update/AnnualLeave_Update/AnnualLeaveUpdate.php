<?php
if(!session_id())
{
    session_start();
}
$dont_check = true;
$include_html = true;
$base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
require_once $base_path . 'Templates/head.php';
?>

<?php $mydb = new DataBase(); ?>
<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
    $data = array(
        'Leavedays' => $_POST['Leavedays']
        , 'RestDay' => $_POST['RestDay']
        , 'Leave_Taken_Date' => $_POST['Leave_Taken_Date']
        , 'ReportOn' => $_POST['ReportOn']
        , 'Reported' => $_POST['Reported']
        , 'Report_Back_Date' => $_POST['Report_Back_Date']
        , 'ModifiedBy' => $_SESSION['MM_Fullname']);

    $mydb->where(array('Auto_ID' => $_POST['Auto_ID']));
    $Result1 = $mydb->update('annual_leave', $data);

    $updateGoTo = "index.php";

    if ($Result1)
        echo "<script type=\"text/javascript\"> alert('Employee annual Leave Data updated Successfully '); </script>";

    header(sprintf("Location: %s", $updateGoTo));
}
?>
<?php
mysql_select_db($database_HRMS, $HRMS);
if (isset($_GET['Auto_ID'])) {

    $query_RSAnnualLeaveUpdate = "SELECT * FROM  annual_leave where Auto_ID=" . $_GET['Auto_ID'] . "";
}else
    $query_RSAnnualLeaveUpdate = "SELECT * FROM annual_leave where Auto_ID=-1";

//$query_RSAnnualLeaveUpdate = "SELECT * FROM annual_leave";
$RSAnnualLeaveUpdate = mysql_query($query_RSAnnualLeaveUpdate, $HRMS) or die(mysql_error());
$row_RSAnnualLeaveUpdate = mysql_fetch_assoc($RSAnnualLeaveUpdate);
$totalRows_RSAnnualLeaveUpdate = mysql_num_rows($RSAnnualLeaveUpdate);
?>
<font color="#FF6600" size="+1" > <p align="center">Annual Leave Record Update form</p></font>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table align="center">
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">ID:</td>
            <td><input type="text" name="ID" value="<?php echo htmlentities($row_RSAnnualLeaveUpdate['ID'], ENT_COMPAT, 'utf-8'); ?>" size="32" readonly="readonly" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">First Name:</td>
            <td><input type="text" readonly="readonly" name="FirstName" value="<?php echo htmlentities($row_RSAnnualLeaveUpdate['FirstName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Middel Name:</td>
            <td><input type="text" readonly="readonly" name="MiddelName" value="<?php echo htmlentities($row_RSAnnualLeaveUpdate['MiddelName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Last Name:</td>
            <td><input type="text" readonly="readonly" name="LastName" value="<?php echo htmlentities($row_RSAnnualLeaveUpdate['LastName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Leave days:</td>
            <td><input type="number" id="Leavedays" name="Leavedays" value="<?php echo htmlentities($row_RSAnnualLeaveUpdate['Leavedays'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Rest Day:</td>
            <td><input type="number" name="RestDay" id="Restday" value="<?php echo htmlentities($row_RSAnnualLeaveUpdate['RestDay'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Leave Taken Date:</td>
            <td><input type="date" name="Leave_Taken_Date" id="Leave_Taken_Date" value="<?php echo htmlentities($row_RSAnnualLeaveUpdate['Leave_Taken_Date'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">ReportOn:</td>
            <td><input type="text" name="ReportOn" id="ReportOn" value="<?php echo htmlentities($row_RSAnnualLeaveUpdate['ReportOn'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Reported:</td>
            <td><input type="text" name="Reported" value="<?php echo htmlentities($row_RSAnnualLeaveUpdate['Reported'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Report Back Date:</td>
            <td><input type="date" name="Report_Back_Date"  value="<?php echo htmlentities($row_RSAnnualLeaveUpdate['Report_Back_Date'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" value="Update record" /></td>
        </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="Auto_ID" value="<?php echo $row_RSAnnualLeaveUpdate['Auto_ID']; ?>" />
</form>