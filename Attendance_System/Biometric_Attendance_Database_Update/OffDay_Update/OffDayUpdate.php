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
        , 'From_Date' => $_POST['From_Date']
        , 'To_Date' => $_POST['To_Date']
        , 'Off_Day' => $_POST['Off_Day']);

    $mydb->where(array('Auto_ID' => $_POST['Auto_ID']));
    $Result1 = $mydb->update('employee_offday', $data);


    $updateGoTo = "index.php";

    header(sprintf("Location: %s", $updateGoTo));
}
?>
<?php
mysql_select_db($database_HRMS, $HRMS);
if (isset($_GET['Auto_ID'])) {

    $query_RSOffDayUpdate = "SELECT * FROM employee_offday where Auto_ID='" . $_GET['Auto_ID'] . "'";
}else
    $query_RSOffDayUpdate = "SELECT * FROM employee_offday where Auto_ID=-1";
$RSOffDayUpdate = mysql_query($query_RSOffDayUpdate, $HRMS) or die(mysql_error());
$row_RSOffDayUpdate = mysql_fetch_assoc($RSOffDayUpdate);
$totalRows_RSOffDayUpdate = mysql_num_rows($RSOffDayUpdate);
?>

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">


    <p align="center"><font color="#FF6600" size="+1"> <?php echo $obj_lang->get('Employee Off Day Update Form', $lang); ?></font>
    <table align="center">
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">ID:</td>
            <td><input type="text" name="ID" readonly="readonly" value="<?php echo htmlentities($row_RSOffDayUpdate['ID'], ENT_COMPAT, 'utf-8'); ?>" size="12" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">First Name:</td>
            <td><input type="text" name="FirstName" readonly="readonly" value="<?php echo htmlentities($row_RSOffDayUpdate['FirstName'], ENT_COMPAT, 'utf-8'); ?>" size="20" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Middel Name:</td>
            <td><input type="text" name="MiddelName" readonly="readonly" value="<?php echo htmlentities($row_RSOffDayUpdate['MiddelName'], ENT_COMPAT, 'utf-8'); ?>" size="20" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Last Name:</td>
            <td><input type="text" name="LastName" readonly="readonly" value="<?php echo htmlentities($row_RSOffDayUpdate['LastName'], ENT_COMPAT, 'utf-8'); ?>" size="20" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Department:</td>
            <td><input type="text" name="Department" readonly="readonly" value="<?php echo htmlentities($row_RSOffDayUpdate['Department'], ENT_COMPAT, 'utf-8'); ?>" size="40" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">From Date:</td>
            <td><input  type="Date" name="From_Date" value="<?php echo htmlentities($row_RSOffDayUpdate['From_Date'], ENT_COMPAT, 'utf-8'); ?>" size="10" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">To Date:</td>
            <td><input type="Date" name="To_Date" value="<?php echo htmlentities($row_RSOffDayUpdate['To_Date'], ENT_COMPAT, 'utf-8'); ?>" size="10" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Off Day:</td>
            <td><select name="Off_Day">
                    <option value="Monday" <?php
if (!(strcmp("Monday", htmlentities($row_RSOffDayUpdate['Off_Day'], ENT_COMPAT, 'utf-8')))) {
    echo "SELECTED";
}
?>>Monday</option>
                    <option value="Tuesday" <?php
                            if (!(strcmp("Tuesday", htmlentities($row_RSOffDayUpdate['Off_Day'], ENT_COMPAT, 'utf-8')))) {
                                echo "SELECTED";
                            }
?>>Tuesday</option>
                    <option value="Wednesday" <?php
                            if (!(strcmp("Wednesday", htmlentities($row_RSOffDayUpdate['Off_Day'], ENT_COMPAT, 'utf-8')))) {
                                echo "SELECTED";
                            }
?>>Wednesday</option>
                    <option value="Thursday" <?php
                            if (!(strcmp("Thursday", htmlentities($row_RSOffDayUpdate['Off_Day'], ENT_COMPAT, 'utf-8')))) {
                                echo "SELECTED";
                            }
?>>Thursday</option>
                    <option value="Friday" <?php
                            if (!(strcmp("Friday", htmlentities($row_RSOffDayUpdate['Off_Day'], ENT_COMPAT, 'utf-8')))) {
                                echo "SELECTED";
                            }
?>>Friday</option>
                    <option value="Saturday" <?php
                            if (!(strcmp("Saturday", htmlentities($row_RSOffDayUpdate['Off_Day'], ENT_COMPAT, 'utf-8')))) {
                                echo "SELECTED";
                            }
?>>Saturday</option>
                    <option value="Sunday" <?php
                            if (!(strcmp("Sunday", htmlentities($row_RSOffDayUpdate['Off_Day'], ENT_COMPAT, 'utf-8')))) {
                                echo "SELECTED";
                            }
?>>Sunday</option>
                </select></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" value="Update record" /></td>
        </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="Auto_ID" value="<?php echo $row_RSOffDayUpdate['Auto_ID']; ?>" />
</form>