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
        'SpecialLeavedays' => $_POST['SpecialLeavedays']
        , 'SpecialLeave_Taken_Date' => $_POST['SpecialLeave_Taken_Date']
        , 'ReportOn' => $_POST['ReportOn']
        , 'Reported' => $_POST['Reported']
        , 'LeaveType' => $_POST['LeaveType']
        , 'Report_Back_Date' => ($_POST['Report_Back_Date'] != "") ? $_POST['Report_Back_Date'] : null
        , 'ModifiedBy' => $_SESSION['MM_Fullname']);

    $mydb->where(array('Auto_ID' => $_POST['Auto_ID']));
    $Result1 = $mydb->update('Special_leave', $data);



    if ($Result1)
        echo "<script type=\"text/javascript\"> alert('Employee Special Leave Data updated Successfully '); </script>";

    $updateGoTo = "index.php";



    header(sprintf("Location: %s", $updateGoTo));
}
?>
<?php
mysql_select_db($database_HRMS, $HRMS);
if (isset($_GET['Auto_ID'])) {

    $query_RSSpecialLeaveUpdate = "SELECT * FROM  Special_leave where Auto_ID=" . $_GET['Auto_ID'] . "";
}else
    $query_RSSpecialLeaveUpdate = "SELECT * FROM Special_leave where Auto_ID=-1";
//$query_RSSpecialLeaveUpdate = "SELECT * FROM Special_leave";
$RSSpecialLeaveUpdate = mysql_query($query_RSSpecialLeaveUpdate, $HRMS) or die(mysql_error());
$row_RSSpecialLeaveUpdate = mysql_fetch_assoc($RSSpecialLeaveUpdate);
$totalRows_RSSpecialLeaveUpdate = mysql_num_rows($RSSpecialLeaveUpdate);
?>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <font color="#FF6600" size="+1" > <p align="center">Special Leave Record Update form</p></font>
    <table align="center">
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">ID:</td>
            <td><input type="text" readonly="readonly" name="ID" value="<?php echo htmlentities($row_RSSpecialLeaveUpdate['ID'], ENT_COMPAT, 'utf-8'); ?>" size="32" readonly="readonly" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">First Name:</td>
            <td><input type="text" readonly="readonly" name="FirstName" value="<?php echo htmlentities($row_RSSpecialLeaveUpdate['FirstName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Middel Name:</td>
            <td><input type="text" readonly="readonly" name="MiddelName" value="<?php echo htmlentities($row_RSSpecialLeaveUpdate['MiddelName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Last Name:</td>
            <td><input type="text" readonly="readonly" name="LastName" value="<?php echo htmlentities($row_RSSpecialLeaveUpdate['LastName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Leave Type:</td>
            <td><input type="number"  name="LeaveType" value="<?php echo htmlentities($row_RSSpecialLeaveUpdate['LeaveType'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Leave days:</td>
            <td><input type="number" readonly="readonly" id="total_leave_day" name="SpecialLeavedays" value="<?php echo htmlentities($row_RSSpecialLeaveUpdate['SpecialLeaveDays'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>

        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Leave Taken Date:</td>
            <td><input type="date" id="myLeave_Taken_Date" name="SpecialLeave_Taken_Date" value="<?php echo htmlentities($row_RSSpecialLeaveUpdate['SpecialLeave_Taken_Date'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Report On:</td>
            <td><input type="text" id="myLeaveReportOn"  name="ReportOn" value="<?php echo htmlentities($row_RSSpecialLeaveUpdate['ReportOn'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Reported:</td>
            <td><input type="text" name="Reported" value="<?php echo htmlentities($row_RSSpecialLeaveUpdate['Reported'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Report Back Date:</td>
            <td><input type="date" name="Report_Back_Date" value="<?php echo htmlentities($row_RSSpecialLeaveUpdate['Report_Back_Date'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" value="Update record" /></td>
        </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="Auto_ID" value="<?php echo $row_RSSpecialLeaveUpdate['Auto_ID']; ?>" />
</form>