<?php require_once('../../Connections/HRMS.php'); ?>
<?php
require_once('../../Classes/Class_AccessLevel.php');
$obj_AccessLevel = new AccessLevel();
$obj_AccessLevel->CHK_AccessLevel();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/ThekeyHRMS_main_Template.dwt" codeOutsideHTMLIsLocked="false" -->
    <head>
        <title>Thekey HRMS</title>
        <?php
        $base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
        require_once $base_path . 'Templates/head.php';
        ?>
    </head>

    <body>
        <div id="busy" >
            <img alt="Am Working" src="http://<?php echo $base_url ?>images/BusyAnimation.gif">
        </div>
        <div id="thekey_page">
            <?php require_once $base_path . 'Templates/header.php'; ?>
            <div id="mainContent">
                <!-- InstanceBeginEditable name="MainContent" -->
                <?php
                $editFormAction = $_SERVER['PHP_SELF'];
                if (isset($_SERVER['QUERY_STRING'])) {
                    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
                }
                if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
                    if ((isset($_POST['DayOT'])) and (isset($_POST['NightOT'])) and (isset($_POST['SundayOT'])) and (isset($_POST['HolydayOT'])))
                        echo "<script type=\"text/javascript\">alert('You don't Checked any Overtime Definition for the  Department {$_POST['Department']}.')</script>";
                    else {
                        if (!(isset($_POST['DayOT'])))
                            $_POST['DayOT'] = " ";
                        if (!(isset($_POST['NightOT'])))
                            $_POST['NightOT'] = " ";
                        if (!(isset($_POST['SundayOT'])))
                            $_POST['SundayOT'] = " ";
                        if (!(isset($_POST['HolydayOT'])))
                            $_POST['HolydayOT'] = " ";
                        $insertSQL = sprintf("INSERT INTO ot_definition_department (Department, From_Date, To_Date, DayOT, NightOT, DayOT_Start, DayOT_MaxHR, NightOT_Start, NightOT_End, NightOT_MaxHR) VALUES (%s, %s, %s,%s, %s, %s, %s, %s, %s, %s)", '\'' . $_POST['Department'] . '\'', '\'' . $_POST['From_Date'] . '\'', '\'' . $_POST['To_Date'] . '\'', '\'' . $_POST['DayOT'] . '\'', '\'' . $_POST['NightOT'] . '\'', '\'' . $_POST['DayOT_Start'] . '\'', '\'' . $_POST['DayOT_MaxHR'] . '\'', '\'' . $_POST['NightOT_Start'] . '\'', '\'' . $_POST['NightOT_End'] . '\'', '\'' . $_POST['NightOT_MaxHR'] . '\'');
                        mysql_select_db($database_HRMS, $HRMS);
                        $Result1 = mysql_query($insertSQL, $HRMS) or die(mysql_error());
                        echo "<script type=\"text/javascript\">alert('You have Defined Overtime for Department {$_POST['Department']} Successfully.')</script>";
                    }
                }
                ?>
                <?php
                mysql_select_db($database_HRMS, $HRMS);
                //$query_RSDepartment = "SELECT Department FROM department ORDER BY Department ASC";
                $query_RSDepartment = "SELECT * FROM thekey_department_data_access Where group_name='". $_SESSION['MM_UserGroup']."' ORDER BY Department ASC";
                $RSDepartment = mysql_query($query_RSDepartment, $HRMS) or die(mysql_error());
                $row_RSDepartment = mysql_fetch_assoc($RSDepartment);
                $totalRows_RSDepartment = mysql_num_rows($RSDepartment);
                
                 //******************For Comapny suport Group NO************/
                $query_RSGroupNo = "SELECT * FROM `department_group_no` WHERE `Department` IN (
                    SELECT Department FROM thekey_department_data_access 
                    Where group_name='" . $_SESSION['MM_UserGroup'] . "')";

                $RSGroupNo = mysql_query($query_RSGroupNo, $HRMS) or die(mysql_error());
                $row_RSGroupNo = mysql_fetch_assoc($RSGroupNo);
                $totalRows_RSGroupNo = mysql_num_rows($RSGroupNo);

                /**************End of Group Number supportt query**************/
                
                ?>
                <h1 class="form_lable">
                    <?php echo $obj_lang->get('Departmental Overtime Definition Form', $lang); ?>
                </h1>
                <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                    <table align="center" background="" bgcolor="#EBEBEB">
                       
                         <?php
                        $sqlCS = "SELECT `Company_Name` from $database_HRMS.company_settings";

                        $resultCS = mysql_query($sqlCS) or die(mysql_error());

                        $rowCS = mysql_fetch_array($resultCS);

                        if (isset($company_info['support_group']) && !($company_info['support_group'])) {
                            ?>

                            <tr valign="baseline">
                                <td></td>
                                <td nowrap="nowrap" align="right">Department:</td>
                                <td>
                                    <select name="Department" id="Department" >
                                        <?php
                                        do {
                                            ?>
                                            <option value="<?php echo $row_RSDepartment['Department'] ?>" ><?php echo $row_RSDepartment['Department'] ?></option>
                                            <?php
                                        } while ($row_RSDepartment = mysql_fetch_assoc($RSDepartment));
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <?php
                        }elseif (isset($company_info['support_group'])) {
                            if ($company_info['support_group']) {
                                echo '<tr>';
                                echo '<td></td>';
                                echo '<td align="right">';
                                echo 'Group Number';
                                echo '</td>';
                                echo '<td>';
                                ?>
                                <!--Select name="Group_No" id="Group_No" -->
                                <select name="Department" id="Department" >
                                    <?php
                                    do {
                                        ?>
                                        <option value="<?php echo $row_RSGroupNo['Group_No'] ?>" ><?php echo $row_RSGroupNo['Group_No'] ?></option>
                                        <?php
                                    } while ($row_RSGroupNo = mysql_fetch_assoc($RSGroupNo));
                                    ?>
                                </select>

                                <?php
                                echo '</td>';
                                echo '</tr>';
                            }
                        }
                        ?>
                        <tr valign="baseline">
                            <td height="41" align="right" nowrap="nowrap"><?php echo $obj_lang->get('From Date', $lang); ?>:</td>
                            <td>
                                <?php echo "<script type='text/JavaScript' src=\"../../Calendar/scw.js\" ></script>"; ?>
                                <input type="date" name="From_Date" value='<?php echo date('Y-m-d'); ?>' size="12" />
                            </td>
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('To Date', $lang); ?>:</td>
                            <td ><input type="date" name="To_Date" value='<?php echo date('Y-m-d'); ?>'  size="12" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td height="39" align="right" nowrap="nowrap"><input type="checkbox" name="DayOT" value="Y" /></td>
                            <td nowrap="nowrap" align="left"> <?php echo $obj_lang->get('Day OT', $lang); ?></td>
                            <td nowrap="nowrap" align="right"><input type="checkbox" name="NightOT" value="Y" /></td>
                            <td nowrap="nowrap" align="left"> <?php echo $obj_lang->get('Night OT', $lang); ?></td>
                        </tr>
                        <tr>
                            <td height="38" align="right" nowrap="nowrap">
                                <?php echo $obj_lang->get('Day OT Start Hour', $lang); ?>
                            </td>
                            <td nowrap="nowrap" ><input type="text" name="DayOT_Start" value="00:00:00" size="" /></td>
                            <td height="51" align="right" nowrap="nowrap">
                                <?php echo $obj_lang->get('Nigth OT Start Hour', $lang); ?>
                            </td>
                            <td nowrap="nowrap" ><input type="text" name="NightOT_Start" value="22:00:00"  size="10"/></td>
                        </tr>
                        <tr valign="baseline">
                            <td align="right" nowrap="nowrap"><?php echo $obj_lang->get('Day OT End Hour', $lang); ?></td>
                            <td></td>
                            <td align="right" nowrap="nowrap">
                                <?php echo $obj_lang->get('Nigth OT End Hour', $lang); ?>
                            </td>
                            <td nowrap="nowrap" ><input type="text" name="NightOT_End" value="06:00:00" size="10" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td height="45" align="right" nowrap="nowrap"> <?php echo $obj_lang->get('Day OT Max Hour', $lang); ?></td>
                            <td nowrap="nowrap" align="left"><input type="text" name="DayOT_MaxHR" value="00:00:00" size="10" /></td>
                            <td nowrap="nowrap" align="right"> <?php echo $obj_lang->get('Night OT Max Hour', $lang); ?></td>
                            <td nowrap="nowrap" align="left"><input type="text" name="NightOT_MaxHR" value="00:00:00" size="10" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">&nbsp;</td><td></td>
                            <td align="left"><input type="submit" value="Define OT" /></td>
                        </tr>
                    </table>
                    <input type="hidden" name="MM_insert" value="form1" />
                </form>
                <!-- InstanceEndEditable -->
            </div>
        </div>
    </body>
    <!-- InstanceEnd -->
</html>