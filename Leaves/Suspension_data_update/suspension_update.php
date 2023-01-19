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
if (isset($_POST["MM_update"])) {
    $data = array(
        'SuspendedDays' => $_POST['SuspendedDays']
        , 'Suspended_Date' => $_POST['Suspended_Date']
        , 'ReportOn' => $_POST['ReportOn']
        , 'ModifiedBy' => $_SESSION['MM_Username']
        , 'Reported' => $_POST['Reported']
        , 'Report_Back_Date' => ($_POST['Report_Back_Date'] != '') ? $_POST['Report_Back_Date'] : null
    );

    $mydb->where(array('Auto_ID' => $_POST['Auto_ID']));
    $Result1 = $mydb->update('employee_offday', $data);


    $updateGoTo = "index.php";

    header(sprintf("Location: %s", $updateGoTo));
}


mysql_select_db($database_HRMS, $HRMS);
if (isset($_GET['Auto_ID'])) {
    $mydb->where('Auto_ID', $_GET['Auto_ID']);
    $result = $mydb->get('suspension');
    if ($result['count'] > 0) {
        $result = $result['result'][0];
    }
}
?>

<form  method="post">
    <p align="center"><font color="#FF6600" size="+1"> <?php echo $obj_lang->get('Suspended Employee Update Form', $lang); ?></font></p>
    <table align="center">
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">ID:</td>
            <td>
                <input type="text" name="ID" readonly="readonly" value="<?php echo isset($result['ID']) ? $result['ID'] : ''; ?>" size="12" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">First Name:</td>
            <td><input type="text" name="FirstName" readonly="readonly" value="<?php echo isset($result['FirstName']) ? $result['FirstName'] : ''; ?>" size="20" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Middel Name:</td>
            <td><input type="text" name="MiddelName" readonly="readonly" value="<?php echo isset($result['MiddelName']) ? $result['MiddelName'] : ''; ?>" size="20" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Last Name:</td>
            <td><input type="text" name="LastName" readonly="readonly" value="<?php echo isset($result['LastName']) ? $result['LastName'] : ''; ?>" size="20" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Department:</td>
            <td><input type="text" name="Department" readonly="readonly" value="<?php echo isset($result['Department']) ? $result['Department'] : ''; ?>" size="40" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Suspended Date:</td>
            <td><input  type="Date" name="Suspended_Date" value="<?php echo isset($result['Suspended_Date']) ? $result['Suspended_Date'] : ''; ?>" size="10" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Report On:</td>
            <td><input type="Date" name="ReportOn" value="<?php echo isset($result['ReportOn']) ? $result['ReportOn'] : ''; ?>" size="10" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Reported:</td>
            <td><input type="Text" name="Reported" value="<?php echo isset($result['Reported']) ? $result['Reported'] : ''; ?>" size="10" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Reported:</td>
            <td><input type="Date" name="Report_Back_Date" value="<?php echo isset($result['Report_Back_Date']) ? $result['Report_Back_Date'] : ''; ?>" size="10" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" value="Update record" /></td>
        </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="Auto_ID" value="<?php echo $result['Auto_ID']; ?>" />
</form>