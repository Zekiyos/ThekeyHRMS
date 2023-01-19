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


     $data = array( 'From_Basic_Salary' => $_POST['From_Basic_Salary']
                        , 'To_Basic_Salary' => $_POST['To_Basic_Salary']
                        , 'Insurance_Amount' => $_POST['Insurance_Amount']
                        , 'Amount_Type' => $_POST['Amount_Type']);

    $mydb->where(array('Auto_ID' => $_POST['Auto_ID']));
    $Result1 = $mydb->update('health_care_insurance_Definition', $data);


    $updateGoTo = "index.php";

    header(sprintf("Location: %s", $updateGoTo));
}
?>
<?php
mysql_select_db($database_HRMS, $HRMS);
if (isset($_GET['Auto_ID'])) {

    $query_RSHealthCareUpdate = "SELECT * FROM health_care_insurance_Definition where Auto_ID='" . $_GET['Auto_ID'] . "'";
}else
    $query_RSHealthCareUpdate = "SELECT * FROM health_care_insurance_Definition where Auto_ID=-1";
$RSHealthCareUpdate = mysql_query($query_RSHealthCareUpdate, $HRMS) or die(mysql_error());
$row_RSHealthCareUpdate = mysql_fetch_assoc($RSHealthCareUpdate);
$totalRows_RSHealthCareUpdate = mysql_num_rows($RSHealthCareUpdate);
?>

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">


    <p align="center"><font color="#FF6600" size="+1"> <?php echo $obj_lang->get('Health Care Insurance Definition Update Form', $lang); ?></font>

    <table width="277" align="center" bgcolor="#EBEBEB">
        <tr valign="baseline">
            <td height="41" align="right" nowrap="nowrap">From Basic Salary:</td>
            <td><input type="text" name="From_Basic_Salary" value="<?php echo htmlentities($row_RSHealthCareUpdate['From_Basic_Salary'], ENT_COMPAT, 'utf-8'); ?>" size="20"  /></td>
        </tr>
        <tr valign="baseline">
            <td height="41" align="right" nowrap="nowrap">To Basic Salary:</td>
            <td><input type="text" name="To_Basic_Salary" value="<?php echo htmlentities($row_RSHealthCareUpdate['To_Basic_Salary'], ENT_COMPAT, 'utf-8'); ?>" size="20"  /></td>
        </tr>
        <tr valign="baseline">
            <td height="41" align="right" nowrap="nowrap">Insurance Amount:</td>
            <td><input type="text" name="Insurance_Amount" value="<?php echo htmlentities($row_RSHealthCareUpdate['Insurance_Amount'], ENT_COMPAT, 'utf-8'); ?>" size="20"  /></td>
        </tr>
        <tr valign="baseline">
            <td height="36" align="right" nowrap="nowrap">Amount Type:</td>
            <td><input type="text" name="Amount_Type" value="<?php echo htmlentities($row_RSHealthCareUpdate['Amount_Type'], ENT_COMPAT, 'utf-8'); ?>" size="20"  /></td>
        </tr>
        
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" value="Update record" /></td>
        </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="Auto_ID" value="<?php echo $row_RSHealthCareUpdate['Auto_ID']; ?>" />
</form>
