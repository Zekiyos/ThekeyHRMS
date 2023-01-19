<?php
$dont_check = true;
$base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
$include_html = true;
require_once $base_path . 'Templates/head.php';
$mydb = new DataBase();
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
    pre($_POST);

    $data = array(
        'Section' => $_POST['Section']
        , 'Sub Section' => $_POST['Sub_Section']
        , 'Group' => isset($_POST['Group']) ? $_POST['Group'] : ''
        , 'Department' => $_POST['Department']);

    $mydb->where(array('Auto_ID' => $_GET['Auto_ID']));

    $Result1 = $mydb->update('department', $data);

    $updateGoTo = "index.php";
    header(sprintf("Location: %s", $updateGoTo));
}

$department = urldecode($_GET['Auto_ID']);

$mydb = new DataBase();
$mydb->where('Auto_ID', $department);
$result = $mydb->get('department');
$department_info = array();
if ($result['count'] > 0) {
    $department_info = $result['result'][0];
}
?>

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table align="center">
        <tr valign="baseline">
            <td colspan="2"><font color="#FF6600" size="+1" >Department Detail Update Form</font></td>
        </tr>
        <tr valign="baseline">
            <td align="right" nowrap="nowrap">Section:</td>
            <td>
                <input type="text" name="Section" value="<?php echo isset($department_info['Section']) ? $department_info['Section'] : ''; ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td align="right" nowrap="nowrap">Sub Section:</td>
            <td>
                <input type="text" name="Sub_Section" value="<?php echo isset($department_info['Sub Section']) ? $department_info['Sub Section'] : ''; ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td align="right" nowrap="nowrap">Group:</td>
            <td>
                <input type="text" name="Group" value="<?php echo isset($department_info['Group']) ? $department_info['Group'] : ''; ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td align="right" nowrap="nowrap">Department:</td>
            <td>
                <input type="text" name="Department" value="<?php echo isset($department_info['Department']) ? $department_info['Department'] : ''; ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td colspan="2" align="right"><input type="submit" value="Update Department" /></td>
        </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" />
</form>