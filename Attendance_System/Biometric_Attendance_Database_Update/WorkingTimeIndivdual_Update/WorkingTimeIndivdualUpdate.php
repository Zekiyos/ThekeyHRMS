<?php
$dont_check = true;
$include_html=true;
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
        , 'From_Date' => $_POST['From_Date']
        , 'To_Date' => $_POST['To_Date']
        , 'Start' => $_POST['Start']
        , 'Start_Break' => $_POST['Start_Break']
        , 'End_Break' => $_POST['End_Break']
        , 'End' => $_POST['End']
        , 'Working_Hour' => $_POST['Working_Hour']
        , 'Working_Hour_Hold' => $_POST['Working_Hour_Hold']);

    $mydb->where(array('Auto_ID' => $_POST['Auto_ID']));
    $Result1 = $mydb->update('working_time_setting_individual', $data);



    $updateGoTo = "index.php";

    header(sprintf("Location: %s", $updateGoTo));
}
?>
<?php
mysql_select_db($database_HRMS, $HRMS);
if (isset($_GET['Auto_ID'])) {

    $query_RSWorkingTimeIndividual = "SELECT * FROM working_time_setting_individual where Auto_ID='" . $_GET['Auto_ID'] . "'";
}else
    $query_RSWorkingTimeIndividual = "SELECT * FROM working_time_setting_individual where Auto_ID=-1";
$RSWorkingTimeIndividual = mysql_query($query_RSWorkingTimeIndividual, $HRMS) or die(mysql_error());
$row_RSWorkingTimeIndividual = mysql_fetch_assoc($RSWorkingTimeIndividual);
$totalRows_RSWorkingTimeIndividual = mysql_num_rows($RSWorkingTimeIndividual);
?>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <font color="#FF6600" size="+1"> <?php echo $obj_lang->get('Working Time Setting Individual Update Form', $lang); ?></font>
    <table align="center">
        <tr valign="baseline">
            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('ID', $lang); ?>:</td>
            <td><input type="text" readonly="readonly" name="ID" value="<?php echo htmlentities($row_RSWorkingTimeIndividual['ID'], ENT_COMPAT, 'utf-8'); ?>" size="12" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('First Name', $lang); ?>:</td>
            <td><input type="text" readonly="readonly" name="FirstName" value="<?php echo htmlentities($row_RSWorkingTimeIndividual['FirstName'], ENT_COMPAT, 'utf-8'); ?>" size="20" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Middel Name', $lang); ?>:</td>
            <td><input type="text" readonly="readonly" name="MiddelName" value="<?php echo htmlentities($row_RSWorkingTimeIndividual['MiddelName'], ENT_COMPAT, 'utf-8'); ?>" size="20" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Last Name', $lang); ?>:</td>
            <td><input type="text" readonly="readonly" name="LastName" value="<?php echo htmlentities($row_RSWorkingTimeIndividual['LastName'], ENT_COMPAT, 'utf-8'); ?>" size="10" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Department', $lang); ?>:</td>
            <td><input type="text" readonly="readonly" name="Department" value="<?php echo htmlentities($row_RSWorkingTimeIndividual['Department'], ENT_COMPAT, 'utf-8'); ?>" size="40" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('From Date', $lang); ?>:</td>
            <td><?php echo "<script type='text/JavaScript' src=\"../../Calendar/scw.js\" ></script>";
?><input type="Date"  onclick='scwShow(this,event);' name="From_Date" value="<?php echo htmlentities($row_RSWorkingTimeIndividual['From_Date'], ENT_COMPAT, 'utf-8'); ?>" size="10" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('To Date', $lang); ?>:</td>
            <td><input onclick='scwShow(this,event);' type="Date" name="To_Date" value="<?php echo htmlentities($row_RSWorkingTimeIndividual['To_Date'], ENT_COMPAT, 'utf-8'); ?>" size="10" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Start', $lang); ?>:</td>
            <td><input type="text" name="Start" value="<?php echo htmlentities($row_RSWorkingTimeIndividual['Start'], ENT_COMPAT, 'utf-8'); ?>" size="10" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Start Break', $lang); ?>:</td>
            <td><input type="text" name="Start_Break" value="<?php echo htmlentities($row_RSWorkingTimeIndividual['Start_Break'], ENT_COMPAT, 'utf-8'); ?>" size="10" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('End Break', $lang); ?>:</td>
            <td><input type="text" name="End_Break" value="<?php echo htmlentities($row_RSWorkingTimeIndividual['End_Break'], ENT_COMPAT, 'utf-8'); ?>" size="10" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('End', $lang); ?>:</td>
            <td><input type="text" name="End" value="<?php echo htmlentities($row_RSWorkingTimeIndividual['End'], ENT_COMPAT, 'utf-8'); ?>" size="10" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Working Hour:</td>
            <td><input type="time" name="Working_Hour" value="<?php echo htmlentities($row_RSWorkingTimeIndividual['Working_Hour'], ENT_COMPAT, 'utf-8'); ?>" size="10" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Hold Working Hour:</td>
            <td><input type="time" name="Working_Hour_Hold" value="<?php echo htmlentities($row_RSWorkingTimeIndividual['Working_Hour_Hold'], ENT_COMPAT, 'utf-8'); ?>" size="10" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" value="<?php echo $obj_lang->get('Update Working Time Setting', $lang); ?>" /></td>
        </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="Auto_ID" value="<?php echo $row_RSWorkingTimeIndividual['Auto_ID']; ?>" />
</form>