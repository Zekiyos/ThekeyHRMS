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
    $data = array('Department' => $_POST['Department']
        , 'From_Date' => $_POST['From_Date']
        , 'To_Date' => $_POST['To_Date']
        , 'DayOT' => isset($_POST['DayOT']) ? $_POST['DayOT'] : null
        , 'DayOT_MaxHR' => $_POST['DayOT_MaxHR']
        , 'NightOT' => isset($_POST['NightOT']) ? $_POST['NightOT'] : null
        , 'NightOT_MaxHR' => isset($_POST['NightOT_MaxHR']) ? $_POST['NightOT_MaxHR'] : NULL
        , 'SundayOT' => isset($_POST['SundayOT']) ? $_POST['SundayOT'] : null
        , 'HolydayOT' => isset($_POST['HolydayOT']) ? $_POST['HolydayOT'] : null
        , 'DayOT_Start' => $_POST['DayOT_Start']
        , 'NightOT_Start' => $_POST['NightOT_Start']
        , 'NightOT_End' => $_POST['NightOT_End']);
    $mydb->where(array('Auto_ID' => $_POST['Auto_ID']));

    $Result1 = $mydb->update('ot_definition_department', $data);
    $updateGoTo = "index.php";
    header(sprintf("Location: %s", $updateGoTo));
}
?>
<?php
$ot_def = array();
if (isset($_GET['Auto_ID'])) {
    $result = $mydb->where('Auto_ID', $_GET['Auto_ID'])
            ->get('ot_definition_department');
    if ($result['count'] > 0) {
        $ot_def = $result['result'][0];
    }
}
?>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <font color="#FF6600" size="+1"> <?php echo $obj_lang->get('Departmental Overtime Definition Update Form', $lang); ?></font>
    <table align="center">
        <tr valign="baseline">
            <td height="26" align="right" nowrap="nowrap">Department:</td>
            <td><input type="text" readonly="readonly" name="Department" value="<?php echo isset($ot_def['Department']) ? $ot_def['Department'] : ''; ?>" size="40" /></td>
        </tr>
        <tr valign="baseline">
            <td height="24" align="right" nowrap="nowrap">From Date:</td>
            <td><input type="Date" name="From_Date" value="<?php echo isset($ot_def['From_Date']) ? $ot_def['From_Date'] : '' ?>" size="10" /></td>
        </tr>
        <tr valign="baseline">
            <td height="45" align="right" nowrap="nowrap">To Date:</td>
            <td><input type="Date" name="To_Date" value="<?php echo isset($ot_def['To_Date']) ? $ot_def['To_Date'] : ''; ?>" size="10" /></td>
        </tr>
        <tr valign="baseline">
            <td height="32" align="right" nowrap="nowrap">Day OT:</td>
            <td><table>
                    <tr>
                        <td>
                            <input type="radio" name="DayOT" value="Y" 
                            <?php
                            if (!strcmp($ot_def['DayOT'], 'Y')) {
                                echo "checked=\"checked\"";
                            }
                            ?>
                                   />
                            YES
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="radio" name="DayOT" value=""
                            <?php
                            if (!strcmp($ot_def['DayOT'], '')) {
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
            <td nowrap="nowrap" align="right">Day OT MaxHour:</td>
            <td> <input type="text" name="DayOT_MaxHR" value="<?php echo isset($ot_def['DayOT_MaxHR']) ? $ot_def['DayOT_MaxHR'] : ''; ?>" size="10" /></td>
        </tr>
        <tr valign="baseline">
            <td height="44" align="right" nowrap="nowrap">Night OT:</td>
            <td>
                <table>
                    <tr>
                        <td>
                            <input type="radio" name="NightOT" value="Y" 
                            <?php
                            if (!strcmp($ot_def['NightOT'], 'Y')) {
                                echo "checked=\"checked\"";
                            }
                            ?>
                                   />
                            YES
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="radio" name="NightOT" value="" 
                            <?php
                            if (!strcmp($ot_def['NightOT'], '')) {
                                echo "checked=\"checked\"";
                            }
                            ?>
                                   />
                            NO
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
        <tr valign="baseline">
            <td height="43" align="right" nowrap="nowrap">Night OT Max Hour:</td>
            <td><input type="time" value="<?php echo isset($ot_def['NightOT_MaxHR']) ? $ot_def['NightOT_MaxHR'] : ''; ?>" name="NightOT_MaxHR"/> </td>
        </tr>
        <tr>
            <td height="35" align="right" nowrap="nowrap">Sunday OT:</td>
            <td>
                <table>
                    <tr>
                        <td>
                            <input type="radio" name="SundayOT" value="Y" 
                            <?php
                            if (!strcmp($ot_def['SundayOT'], 'Y')) {
                                echo "checked=\"checked\"";
                            }
                            ?>
                                   />
                            YES</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="SundayOT" value="" 
                            <?php
                            if (!strcmp($ot_def['SundayOT'], '')) {
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
            <td height="35" align="right" nowrap="nowrap">Holy day OT:</td>
            <td><table>
                    <tr>
                        <td>
                            <input type="radio" name="HolydayOT" value="Y" 
                            <?php
                            if (!strcmp($ot_def['HolydayOT'], 'Y')) {
                                echo "checked=\"checked\"";
                            }
                            ?>
                                   />
                            YES</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="HolydayOT" value=""
                            <?php
                            if (!strcmp($ot_def['HolydayOT'], '')) {
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
            <td  align="right" nowrap="nowrap">Day OT Start:</td>
            <td><input type="text" name="DayOT_Start" value="<?php echo isset($ot_def['DayOT_Start']) ? $ot_def['DayOT_Start'] : ''; ?>" size="10" /></td>
        </tr>
        <tr valign="baseline">
            <td  align="right" nowrap="nowrap">Night OT Start:</td>
            <td><input type="text" name="NightOT_Start" value="<?php echo isset($ot_def['NightOT_Start']) ? $ot_def['NightOT_Start'] : ''; ?>" size="10" /></td>
        </tr>
        <tr valign="baseline">
            <td  align="right" nowrap="nowrap">Night OT End:</td>
            <td><input type="text" name="NightOT_End" value="<?php echo isset($ot_def['NightOT_End']) ? $ot_def['NightOT_End'] : ''; ?>" size="10" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" value="Update record" /></td>
        </tr>
    </table>

    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="Auto_ID" value="<?php echo isset($ot_def['Auto_ID']) ? $ot_def['Auto_ID'] : ''; ?>" />
</form>