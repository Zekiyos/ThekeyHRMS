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


    $data = array('ID' => $_POST['ID']
        , 'FirstName' => $_POST['FirstName']
        , 'MiddelName' => $_POST['MiddelName']
        , 'LastName' => $_POST['LastName']
        , 'Department' => $_POST['Department']
        , 'Referral_Case' => $_POST['Referral_Case']
        , 'Treatment_Cost' => $_POST['Treatment_Cost']
        , 'Refferal_Date' => $_POST['Refferal_Date']
        , 'ModifiedBy' => $_SESSION['MM_Fullname']);

    $mydb->where(array('Auto_ID' => $_POST['Auto_ID']));
    $Result1 = $mydb->update('cholinesterase_test', $data);


    $updateGoTo = "index.php";

    header(sprintf("Location: %s", $updateGoTo));
}
?>
<?php
mysql_select_db($database_HRMS, $HRMS);
if (isset($_GET['Auto_ID'])) {

    $query_RSCholinesteraseTestUpdate = "SELECT * FROM cholinesterase_test where Auto_ID='" . $_GET['Auto_ID'] . "'";
}else
    $query_RSCholinesteraseTestUpdate = "SELECT * FROM cholinesterase_test where Auto_ID=-1";
$RSCholinesteraseTestUpdate = mysql_query($query_RSCholinesteraseTestUpdate, $HRMS) or die(mysql_error());
$row_RSCholinesteraseTestUpdate = mysql_fetch_assoc($RSCholinesteraseTestUpdate);
$totalRows_RSCholinesteraseTestUpdate = mysql_num_rows($RSCholinesteraseTestUpdate);
?>

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">


    <p align="center"><font color="#FF6600" size="+1"> <?php echo $obj_lang->get('Cholinesterase Test Update Form', $lang); ?></font>

    <table width="277" align="center" bgcolor="#EBEBEB">
        <tr valign="baseline">
            <td height="41" align="right" nowrap="nowrap">ID:</td>
            <td><input type="text" name="ID" value="<?php echo htmlentities($row_RSCholinesteraseTestUpdate['ID'], ENT_COMPAT, 'utf-8'); ?>" size="20"  /></td>
        </tr>
        <tr valign="baseline">
            <td height="41" align="right" nowrap="nowrap">FirstName:</td>
            <td><input type="text" name="FirstName" value="<?php echo htmlentities($row_RSCholinesteraseTestUpdate['FirstName'], ENT_COMPAT, 'utf-8'); ?>" size="20"  /></td>
        </tr>
        <tr valign="baseline">
            <td height="41" align="right" nowrap="nowrap">MiddelName:</td>
            <td><input type="text" name="MiddelName" value="<?php echo htmlentities($row_RSCholinesteraseTestUpdate['MiddelName'], ENT_COMPAT, 'utf-8'); ?>" size="20"  /></td>
        </tr>
        <tr valign="baseline">
            <td height="36" align="right" nowrap="nowrap">LastName:</td>
            <td><input type="text" name="LastName" value="<?php echo htmlentities($row_RSCholinesteraseTestUpdate['LastName'], ENT_COMPAT, 'utf-8'); ?>" size="20"  /></td>
        </tr>
        <tr valign="baseline">
            <td height="40" align="right" nowrap="nowrap">Department:</td>
            <td><input type="text" name="Department" value="<?php echo htmlentities($row_RSCholinesteraseTestUpdate['Department'], ENT_COMPAT, 'utf-8'); ?>" size="35"  /></td>
        </tr>
        <tr valign="baseline">
            <td  align="right" nowrap="nowrap">Last Test Result:</td>
            <td>

                <input type="text" name="LastResult" value="<?php echo htmlentities($row_RSCholinesteraseTestUpdate['LastResult'], ENT_COMPAT, 'utf-8'); ?>" size="20" />
            </td>
        </tr>
        <tr valign="baseline">
            <td  align="right" nowrap="nowrap">Last Test Date:</td>
            <td>

                <input type="Date" name="LastTestDate" value="<?php echo htmlentities($row_RSCholinesteraseTestUpdate['LastTestDate'], ENT_COMPAT, 'utf-8'); ?>" size="20" />
            </td>
        </tr>

        <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" value="Update record" /></td>
        </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="Auto_ID" value="<?php echo $row_RSCholinesteraseTestUpdate['Auto_ID']; ?>" />
</form>
