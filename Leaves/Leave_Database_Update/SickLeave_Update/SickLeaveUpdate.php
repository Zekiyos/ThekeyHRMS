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
        'SickLeavedays' => $_POST['SickLeavedays']
        , 'SickLeave_Taken_Date' => $_POST['SickLeave_Taken_Date']
        , 'ReportOn' => $_POST['ReportOn']
        , 'Reported' => $_POST['Reported']
        , 'Report_Back_Date' => ($_POST['Report_Back_Date'] != "") ? $_POST['Report_Back_Date'] : null
        , 'ModifiedBy' => $_SESSION['MM_Fullname']);

    $mydb->where(array('Auto_ID' => $_POST['Auto_ID']));
    $Result1 = $mydb->update('sick_leave', $data);



    if ($Result1)
        echo "<script type=\"text/javascript\"> alert('Employee Sick Leave Data updated Successfully '); </script>";

    $updateGoTo = "index.php";



    header(sprintf("Location: %s", $updateGoTo));
}
?>
<?php
mysql_select_db($database_HRMS, $HRMS);
if (isset($_GET['Auto_ID'])) {

    $query_RSSickLeaveUpdate = "SELECT * FROM  sick_leave where Auto_ID=" . $_GET['Auto_ID'] . "";
}else
    $query_RSSickLeaveUpdate = "SELECT * FROM sick_leave where Auto_ID=-1";
//$query_RSSickLeaveUpdate = "SELECT * FROM sick_leave";
$RSSickLeaveUpdate = mysql_query($query_RSSickLeaveUpdate, $HRMS) or die(mysql_error());
$row_RSSickLeaveUpdate = mysql_fetch_assoc($RSSickLeaveUpdate);
$totalRows_RSSickLeaveUpdate = mysql_num_rows($RSSickLeaveUpdate);
?>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <font color="#FF6600" size="+1" > <p align="center">Sick Leave Record Update form</p></font>
    <table align="center">
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">ID:</td>
            <td><input type="text" readonly="readonly" name="ID" value="<?php echo htmlentities($row_RSSickLeaveUpdate['ID'], ENT_COMPAT, 'utf-8'); ?>" size="32" readonly="readonly" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">First Name:</td>
            <td><input type="text" readonly="readonly" name="FirstName" value="<?php echo htmlentities($row_RSSickLeaveUpdate['FirstName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Middel Name:</td>
            <td><input type="text" readonly="readonly" name="MiddelName" value="<?php echo htmlentities($row_RSSickLeaveUpdate['MiddelName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Last Name:</td>
            <td><input type="text" readonly="readonly" name="LastName" value="<?php echo htmlentities($row_RSSickLeaveUpdate['LastName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Leave days:</td>
            <td><input type="number" readonly="readonly" id="total_leave_day" name="SickLeavedays" value="<?php echo htmlentities($row_RSSickLeaveUpdate['SickLeaveDays'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>

        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Leave Taken Date:</td>
            <td><input type="date" id="myLeave_Taken_Date" name="SickLeave_Taken_Date" value="<?php echo htmlentities($row_RSSickLeaveUpdate['SickLeave_Taken_Date'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Report On:</td>
            <td><input type="text" id="myLeaveReportOn"  name="ReportOn" value="<?php echo htmlentities($row_RSSickLeaveUpdate['ReportOn'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Reported:</td>
            <td><input type="text" name="Reported" value="<?php echo htmlentities($row_RSSickLeaveUpdate['Reported'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Report Back Date:</td>
            <td><input type="date" name="Report_Back_Date" value="<?php echo htmlentities($row_RSSickLeaveUpdate['Report_Back_Date'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" value="Update record" /></td>
        </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="Auto_ID" value="<?php echo $row_RSSickLeaveUpdate['Auto_ID']; ?>" />
</form>