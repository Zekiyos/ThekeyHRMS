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
        , 'From_Date' => $_POST['From_Date']
        , 'To_Date' => $_POST['To_Date']
        , 'After_Start' => $_POST['After_Start']
        , 'Before_Start_Break' => $_POST['Before_Start_Break']
        , 'After_End_Break' => $_POST['After_End_Break']
        , 'Before_End' => $_POST['Before_End']);

    $mydb->where(array('Auto_ID' => $_POST['Auto_ID']));
    $Result1 = $mydb->update('late_tolerance_setting', $data);
    
    $updateGoTo = "index.php";

    header(sprintf("Location: %s", $updateGoTo));
}
?>
<?php
mysql_select_db($database_HRMS, $HRMS);
if (isset($_GET['Auto_ID'])) {

    $query_RSLateToleranceUpdate = "SELECT * FROM late_tolerance_setting where Auto_ID='" . $_GET['Auto_ID'] . "'";
}else
    $query_RSLateToleranceUpdate = "SELECT * FROM late_tolerance_setting where Auto_ID=-1";
$RSLateToleranceUpdate = mysql_query($query_RSLateToleranceUpdate, $HRMS) or die(mysql_error());
$row_RSLateToleranceUpdate = mysql_fetch_assoc($RSLateToleranceUpdate);
$totalRows_RSLateToleranceUpdate = mysql_num_rows($RSLateToleranceUpdate);
?>


<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
   <p align="center"><font color="#FF6600" size="+1"> <?php echo $obj_lang->get('Employee Late Tolerance Update Form', $lang); ?></font>

    <table width="400" height="395" align="center" background="" bgcolor="#EBEBEB">
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Department:</td>
            <td>
                <input type="date" name="From_Date" value='<?php echo htmlentities($row_RSLateToleranceUpdate['Department'], ENT_COMPAT, 'utf-8'); ?>' size="12" /></td>

            </td>
        </tr>
        <tr> </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">From Date:</td>
            <td>
                <input type="date" name="From_Date" value='<?php echo htmlentities($row_RSLateToleranceUpdate['From_Date'], ENT_COMPAT, 'utf-8'); ?>' size="12" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">To Date:</td>
            <td><input type="date" name="To_Date"  value='<?php echo htmlentities($row_RSLateToleranceUpdate['To_Date'], ENT_COMPAT, 'utf-8'); ?>' size="12" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">After Start:</td>
            <td><input type="time" name="After_Start" value="<?php echo htmlentities($row_RSLateToleranceUpdate['After_Start'], ENT_COMPAT, 'utf-8'); ?>" size="10" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Before Start Break:</td>
            <td><input type="time" name="Before_Start_Break" value="<?php echo htmlentities($row_RSLateToleranceUpdate['Before_Start_Break'], ENT_COMPAT, 'utf-8'); ?>" size="10" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">After End Break:</td>
            <td><input type="time" name="After_End_Break" value="<?php echo htmlentities($row_RSLateToleranceUpdate['After_End_Break'], ENT_COMPAT, 'utf-8'); ?>" size="10" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Before End:</td>
            <td><input type="time" name="Before_End" value="<?php echo htmlentities($row_RSLateToleranceUpdate['Before_End'], ENT_COMPAT, 'utf-8'); ?>" size="10" /></td>
        </tr>
       
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" value="Update record" /></td>
        </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="Auto_ID" value="<?php echo $row_RSLateToleranceUpdate['Auto_ID']; ?>" />
</form>