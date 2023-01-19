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


    $data = array( 'Holyday_Name' => $_POST['Holyday_Name']
        , 'Date' => $_POST['Date']);

    $mydb->where(array('Auto_ID' => $_POST['Auto_ID']));
    $Result1 = $mydb->update('holyday_definition', $data);


    $updateGoTo = "index.php";

    header(sprintf("Location: %s", $updateGoTo));
}
?>
<?php
mysql_select_db($database_HRMS, $HRMS);
if (isset($_GET['Auto_ID'])) {

    $query_RSHolyDayUpdate = "SELECT * FROM holyday_definition where Auto_ID='" . $_GET['Auto_ID'] . "'";
}else
    $query_RSHolyDayUpdate = "SELECT * FROM holyday_definition where Auto_ID=-1";
$RSHolyDayUpdate = mysql_query($query_RSHolyDayUpdate, $HRMS) or die(mysql_error());
$row_RSHolyDayUpdate = mysql_fetch_assoc($RSHolyDayUpdate);
$totalRows_RSHolyDayUpdate= mysql_num_rows($RSHolyDayUpdate);
?>

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">


    <p align="center"><font color="#FF6600" size="+1"> <?php echo $obj_lang->get('HolyDay Update Form', $lang); ?></font>
    <table align="center">
        <tr valign="baseline">
            <td nowrap="nowrap" align="right"> Holy Day Name:</td>
            <td><input type="text" name="Holyday_Name" value="<?php echo htmlentities($row_RSHolyDayUpdate['Holyday_Name'], ENT_COMPAT, 'utf-8'); ?>" size="12" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Date:</td>
            <td><input type="Date" name="Date" value="<?php echo htmlentities($row_RSHolyDayUpdate['Date'], ENT_COMPAT, 'utf-8'); ?>" size="20" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" value="Update record" /></td>
        </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="Auto_ID" value="<?php echo $row_RSHolyDayUpdate['Auto_ID']; ?>" />
</form>
