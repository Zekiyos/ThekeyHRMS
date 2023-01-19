<?php
require_once('../../Connections/HRMS.php');
$dont_check = true;
$include_html = true;
/* Database Class Including to the page** */
if (!defined('validurl'))
    define("validurl", TRUE);
$base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
require_once $base_path . 'config/database.php';
require_once $base_path . 'lib/database.php';

$mydb = new DataBase();

require_once('../../Classes/Class_language.php');

$base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
require_once $base_path . 'Templates/head.php';
?>
<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {


    $data = array(
        'EquipmentName' => $_POST['EquipmentName']
        , 'Taken_Date' => $_POST['Taken_Date']
        , 'Replacement_Date' => ($_POST['Replacement_Date'] != "") ? $_POST['Replacement_Date'] : null
        , 'Returning_Date' => ($_POST['Returning_Date'] != "") ? $_POST['Returning_Date'] : null
        , 'Returned' => $_POST['Returned']);

    $mydb->where(array('Auto_ID' => $_POST['Auto_ID']));
    $Result1 = $mydb->update('equipment_handover', $data);

    $updateGoTo = "index.php";

    header(sprintf("Location: %s", $updateGoTo));
}
?>
<?php
mysql_select_db($database_HRMS, $HRMS);
if (isset($_GET['Auto_ID'])) {

    $query_RSEquipmnetHandoverUpdate = "SELECT * FROM equipment_handover where Auto_ID=" . $_GET['Auto_ID'] . "";
}else
    $query_RSEquipmnetHandoverUpdate = "SELECT * FROM equipment_handover where Auto_ID=-1";

//$query_RSEquipmnetHandoverUpdate = "SELECT * FROM equipment_handover";

$RSEquipmnetHandoverUpdate = mysql_query($query_RSEquipmnetHandoverUpdate, $HRMS) or die(mysql_error());
$row_RSEquipmnetHandoverUpdate = mysql_fetch_assoc($RSEquipmnetHandoverUpdate);
$totalRows_RSEquipmnetHandoverUpdate = mysql_num_rows($RSEquipmnetHandoverUpdate);
?>
<font color="#FF6600" size="+1" > <p align="center">Equipment Handover Data Update</p></font>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table align="center">
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">ID:</td>
            <td><input type="text" name="ID" readonly="readonly" value="<?php echo htmlentities($row_RSEquipmnetHandoverUpdate['ID'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">First Name:</td>
            <td><input type="text" readonly="readonly"  name="FirstName" value="<?php echo htmlentities($row_RSEquipmnetHandoverUpdate['FirstName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Middel Name:</td>
            <td><input type="text"  readonly="readonly" name="MiddelName" value="<?php echo htmlentities($row_RSEquipmnetHandoverUpdate['MiddelName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Last Name:</td>
            <td><input type="text"  readonly="readonly" name="LastName" value="<?php echo htmlentities($row_RSEquipmnetHandoverUpdate['LastName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Equipment Name:</td>
            <td><input type="text"  readonly="readonly"  name="EquipmentName" value="<?php echo htmlentities($row_RSEquipmnetHandoverUpdate['EquipmentName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Taken Date:</td>
            <td><input type="text" name="Taken_Date" value="<?php echo htmlentities($row_RSEquipmnetHandoverUpdate['Taken_Date'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Replacement Date:</td>
            <td><input type="text" name="Replacement_Date" value="<?php echo htmlentities($row_RSEquipmnetHandoverUpdate['Replacement_Date'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Returning Date:</td>
            <td><input type="text" name="Returning_Date" value="<?php echo htmlentities($row_RSEquipmnetHandoverUpdate['Returning_Date'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Returned:</td>
            <td valign="baseline"><table>
                    <tr>
                        <td><input type="radio" name="Returned" value="YES" <?php
if (!(strcmp(htmlentities($row_RSEquipmnetHandoverUpdate['Returned'], ENT_COMPAT, 'utf-8'), "YES"))) {
    echo "checked=\"checked\"";
}
?> />
                            YES</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="Returned" value="NO" <?php
                                   if (!(strcmp(htmlentities($row_RSEquipmnetHandoverUpdate['Returned'], ENT_COMPAT, 'utf-8'), "NO"))) {
                                       echo "checked=\"checked\"";
                                   }
?> />
                            NO</td>
                    </tr>
                </table></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" value="Update record" /></td>
        </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="Auto_ID" value="<?php echo $row_RSEquipmnetHandoverUpdate['Auto_ID']; ?>" />
</form>