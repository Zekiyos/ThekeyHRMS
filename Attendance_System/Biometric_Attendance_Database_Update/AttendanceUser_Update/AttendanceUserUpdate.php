<?php
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


    $data = array('Department' => $_POST['Department']
                            , 'Prepared' => $_POST['Prepared']
                            , 'Department_Manager' => $_POST['Department_Manager']
                            , 'Checked' => $_POST['Checked']
                            , 'Approved' => $_POST['Approved']);

    $mydb->where(array('Auto_ID' => $_POST['Auto_ID']));
    $Result1 = $mydb->update('user_attendance', $data);


    $updateGoTo = "index.php";

    header(sprintf("Location: %s", $updateGoTo));
}
?>
<?php
mysql_select_db($database_HRMS, $HRMS);
if (isset($_GET['Auto_ID'])) {

    $query_RSAttendanceUserUpdate = "SELECT * FROM user_attendance where Auto_ID='" . $_GET['Auto_ID'] . "'";
}else
    $query_RSAttendanceUserUpdate = "SELECT * FROM user_attendance where Auto_ID=-1";
$RSAttendanceUserUpdate = mysql_query($query_RSAttendanceUserUpdate, $HRMS) or die(mysql_error());
$row_RSAttendanceUserUpdate = mysql_fetch_assoc($RSAttendanceUserUpdate);
$totalRows_RSAttendanceUserUpdate = mysql_num_rows($RSAttendanceUserUpdate);
?>

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">


    <p align="center"><font color="#FF6600" size="+1"> <?php echo $obj_lang->get('Attendance User Update Form', $lang); ?></font>
    <table align="center">
         <tr valign="baseline">
            <td nowrap="nowrap" align="right">Department(Section):</td>
            <td>
                <input type="text" name="Department" value='<?php echo htmlentities($row_RSAttendanceUserUpdate['Department'], ENT_COMPAT, 'utf-8'); ?>' size="15" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Prepared By:</td>
            <td>
                <input type="text" name="Prepared" value='<?php echo htmlentities($row_RSAttendanceUserUpdate['Prepared'], ENT_COMPAT, 'utf-8'); ?>' size="15" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Department Manager:</td>
            <td><input type="text" name="Department_Manager"  value='<?php echo htmlentities($row_RSAttendanceUserUpdate['Department_Manager'], ENT_COMPAT, 'utf-8'); ?>' size="15" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Checked By:</td>
            <td><input type="text" name="Checked" value="<?php echo htmlentities($row_RSAttendanceUserUpdate['Checked'], ENT_COMPAT, 'utf-8'); ?>" size="15" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Approved By:</td>
            <td><input type="text" name="Approved" value="<?php echo htmlentities($row_RSAttendanceUserUpdate['Approved'], ENT_COMPAT, 'utf-8'); ?>" size="15" /></td>
        </tr>

        <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" value="Update record" /></td>
        </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="Auto_ID" value="<?php echo $row_RSAttendanceUserUpdate['Auto_ID']; ?>" />
</form>
