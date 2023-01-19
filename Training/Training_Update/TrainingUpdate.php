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
                        , 'TrainingName' => $_POST['TrainingName']
                        , 'Training_Start_Date' => $_POST['Training_Start_Date']
                        , 'Training_End_Date' => $_POST['Training_End_Date']
                        , 'Refreshment_Date' => $_POST['Refreshment_Date']
                        , 'Status' => $_POST['Status']);

    $mydb->where(array('Auto_ID' => $_POST['Auto_ID']));
    $Result1 = $mydb->update('Training', $data);


    $updateGoTo = "index.php";

    header(sprintf("Location: %s", $updateGoTo));
}
?>
<?php
mysql_select_db($database_HRMS, $HRMS);
if (isset($_GET['Auto_ID'])) {

    $query_RSTrainingUpdate = "SELECT * FROM Training where Auto_ID='" . $_GET['Auto_ID'] . "'";
}else
    $query_RSTrainingUpdate = "SELECT * FROM Training where Auto_ID=-1";
$RSTrainingUpdate = mysql_query($query_RSTrainingUpdate, $HRMS) or die(mysql_error());
$row_RSTrainingUpdate = mysql_fetch_assoc($RSTrainingUpdate);
$totalRows_RSTrainingUpdate = mysql_num_rows($RSTrainingUpdate);
?>

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">


    <p align="center"><font color="#FF6600" size="+1"> <?php echo $obj_lang->get('Employee Training Update Form', $lang); ?></font>
    <table align="center">
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">ID:</td>
            <td><input type="text" name="ID" readonly="readonly" value="<?php echo htmlentities($row_RSTrainingUpdate['ID'], ENT_COMPAT, 'utf-8'); ?>" size="12" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">First Name:</td>
            <td><input type="text" name="FirstName" readonly="readonly" value="<?php echo htmlentities($row_RSTrainingUpdate['FirstName'], ENT_COMPAT, 'utf-8'); ?>" size="20" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Middel Name:</td>
            <td><input type="text" name="MiddelName" readonly="readonly" value="<?php echo htmlentities($row_RSTrainingUpdate['MiddelName'], ENT_COMPAT, 'utf-8'); ?>" size="20" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Last Name:</td>
            <td><input type="text" name="LastName" readonly="readonly" value="<?php echo htmlentities($row_RSTrainingUpdate['LastName'], ENT_COMPAT, 'utf-8'); ?>" size="20" /></td>
        </tr>
        
         <tr valign="baseline">
            <td nowrap="nowrap" align="right">Training Name:</td>
            <td><input  type="text" name="TrainingName" value="<?php echo htmlentities($row_RSTrainingUpdate['TrainingName'], ENT_COMPAT, 'utf-8'); ?>" size="10" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Training Start Date:</td>
            <td><input  type="Date" name="Training_Start_Date" value="<?php echo htmlentities($row_RSTrainingUpdate['Training_Start_Date'], ENT_COMPAT, 'utf-8'); ?>" size="10" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Training End Date:</td>
            <td><input type="Date" name="Training_End_Date" value="<?php echo htmlentities($row_RSTrainingUpdate['Training_End_Date'], ENT_COMPAT, 'utf-8'); ?>" size="10" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Refreshment Date:</td>
            <td><input type="Date" name="Refreshment_Date" value="<?php echo htmlentities($row_RSTrainingUpdate['Refreshment_Date'], ENT_COMPAT, 'utf-8'); ?>" size="10" /></td>
        </tr>
    
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" value="Update record" /></td>
        </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="Auto_ID" value="<?php echo $row_RSTrainingUpdate['Auto_ID']; ?>" />
</form>