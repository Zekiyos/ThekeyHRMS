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
        , 'DayOT' => isset($_POST['DayOT']) ? $_POST['DayOT'] : NULL
        , 'DayOT_MaxHR' => $_POST['DayOT_MaxHR']
        , 'NightOT' => isset($_POST['NightOT']) ? $_POST['NightOT'] : null
        , 'NightOT_MaxHR' => $_POST['NightOT_MaxHR']
        , 'SundayOT' => isset($_POST['SundayOT']) ? $_POST['SundayOT'] : null
        , 'HolydayOT' => isset($_POST['HolydayOT']) ? $_POST['HolydayOT'] : null
        , 'DayOT_Start' => $_POST['DayOT_Start']
        , 'NightOT_Start' => $_POST['NightOT_Start']
        , 'NightOT_End' => $_POST['NightOT_End']);

    $mydb->where(array('Auto_ID' => $_POST['Auto_ID']));
    $Result1 = $mydb->update('ot_definition', $data);

    $updateGoTo = "index.php";

    header(sprintf("Location: %s", $updateGoTo));
}
?>
<?php
mysql_select_db($database_HRMS, $HRMS);
if (isset($_GET['Auto_ID'])) {

    $query_RSOTIndividualUpdate = "SELECT * FROM ot_definition where Auto_ID='" . $_GET['Auto_ID'] . "'";
}else
    $query_RSOTIndividualUpdate = "SELECT * FROM ot_definition where Auto_ID=-1";
$RSOTIndividualUpdate = mysql_query($query_RSOTIndividualUpdate, $HRMS) or die(mysql_error());
$row_RSOTIndividualUpdate = mysql_fetch_assoc($RSOTIndividualUpdate);
$totalRows_RSOTIndividualUpdate = mysql_num_rows($RSOTIndividualUpdate);
?>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <font color="#FF6600" size="+1"> 
    <?php echo $obj_lang->get('Individual Overtime Definition Update Form', $lang); ?>
    </font>
    <table align="center">
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">ID:</td>
            <td><input type="text" readonly="readonly" name="ID" value="<?php echo htmlentities($row_RSOTIndividualUpdate['ID'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">First Name:</td>
            <td><input type="text" readonly="readonly" name="FirstName" value="<?php echo htmlentities($row_RSOTIndividualUpdate['FirstName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Middel Name:</td>
            <td><input type="text" readonly="readonly" name="MiddelName" value="<?php echo htmlentities($row_RSOTIndividualUpdate['MiddelName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Last Name:</td>
            <td><input type="text" readonly="readonly" name="LastName" value="<?php echo htmlentities($row_RSOTIndividualUpdate['LastName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Department:</td>
            <td><input type="text" readonly="readonly" name="Department" value="<?php echo htmlentities($row_RSOTIndividualUpdate['Department'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">From Date:</td>
            <td><input type="date"  name="From_Date" value="<?php echo htmlentities($row_RSOTIndividualUpdate['From_Date'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">To Date:</td>
            <td><input type="date" name="To_Date" value="<?php echo htmlentities($row_RSOTIndividualUpdate['To_Date'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Day OT:</td>
            <td valign="baseline"><table>
                    <tr>
                        <td>
                            <input type="radio" name="DayOT" value="Y" 
                            <?php
                            if (!(strcmp(htmlentities($row_RSOTIndividualUpdate['DayOT'], ENT_COMPAT, 'utf-8'), "Y"))) {
                                echo "checked=\"checked\"";
                            }
                            ?> />
                            Yes
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="radio" name="DayOT" value="" 
                            <?php
                            if (!(strcmp(htmlentities($row_RSOTIndividualUpdate['DayOT'], ENT_COMPAT, 'utf-8'), ""))) {
                                echo "checked=\"checked\"";
                            }
                            ?>
                                   />
                            NO
                        </td>
                    </tr>
                </table></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">DayOT MaxHR:</td>
            <td><input type="text" name="DayOT_MaxHR" value="<?php echo htmlentities($row_RSOTIndividualUpdate['DayOT_MaxHR'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Night OT:</td>
            <td valign="baseline"><table>
                    <tr>
                        <td>
                            <input type="radio" name="NightOT" value="Y" 
                            <?php
                            if (!(strcmp(htmlentities($row_RSOTIndividualUpdate['NightOT'], ENT_COMPAT, 'utf-8'), "Y"))) {
                                echo "checked=\"checked\"";
                            }
                            ?> />
                            YES
                        </td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="NightOT" value="" 
                            <?php
                            if (!(strcmp(htmlentities($row_RSOTIndividualUpdate['NightOT'], ENT_COMPAT, 'utf-8'), ""))) {
                                echo "checked=\"checked\"";
                            }
                            ?> 
                                   />
                            NO</td>
                    </tr>
                </table></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">NightOT MaxHR:</td>
            <td><input type="text" name="NightOT_MaxHR" value="<?php echo htmlentities($row_RSOTIndividualUpdate['NightOT_MaxHR'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Sunday OT:</td>
            <td valign="baseline"><table>
                    <tr>
                        <td><input type="radio" name="SundayOT" value="Y" 
                            <?php
                            if (!(strcmp(htmlentities($row_RSOTIndividualUpdate['SundayOT'], ENT_COMPAT, 'utf-8'), "Y"))) {
                                echo "checked=\"checked\"";
                            }
                            ?> />
                            YES</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="SundayOT" value=""
                            <?php
                            if (!(strcmp(htmlentities($row_RSOTIndividualUpdate['SundayOT'], ENT_COMPAT, 'utf-8'), ""))) {
                                echo "checked=\"checked\"";
                            }
                            ?> 
                                   />
                            NO</td>
                    </tr>
                </table></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Holyday OT:</td>
            <td valign="baseline"><table>
                    <tr>
                        <td><input type="radio" name="HolydayOT" value="Y" 
                            <?php
                            if (!(strcmp(htmlentities($row_RSOTIndividualUpdate['HolydayOT'], ENT_COMPAT, 'utf-8'), "Y"))) {
                                echo "checked=\"checked\"";
                            }
                            ?> />
                            YES</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="HolydayOT" value="" 
                            <?php
                            if (!(strcmp(htmlentities($row_RSOTIndividualUpdate['HolydayOT'], ENT_COMPAT, 'utf-8'), ""))) {
                                echo "checked=\"checked\"";
                            }
                            ?>
                                   />
                            NO</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">DayOT Start:</td>
            <td><input type="text" name="DayOT_Start" value="<?php echo htmlentities($row_RSOTIndividualUpdate['DayOT_Start'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">NightOT Start:</td>
            <td><input type="text" name="NightOT_Start" value="<?php echo htmlentities($row_RSOTIndividualUpdate['NightOT_Start'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">NightOT End:</td>
            <td><input type="text" name="NightOT_End" value="<?php echo htmlentities($row_RSOTIndividualUpdate['NightOT_End'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" value="Update record" /></td>
        </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="Auto_ID" value="<?php echo $row_RSOTIndividualUpdate['Auto_ID']; ?>" />
</form>