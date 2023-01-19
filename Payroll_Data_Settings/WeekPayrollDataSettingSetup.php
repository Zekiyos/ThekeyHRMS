<?php
if (!defined('validurl'))
    define("validurl", TRUE);
require_once('../Connections/HRMS.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Thekey HRMS</title>

        <?php
        $dont_check = true;
        $base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
        require_once $base_path . 'Templates/head.php';
        ?>

        <script type='text/javascript'>
            function SelectedDepartment(elem,Week,helperMsg){
                alert ( "You Chooose " + elem.value + " Department for Week " + Week.value + "!")
                var Department=elem.value;
	
                location="WeekPayrollDataSettingSetup.php?Department=" + elem.value+"&Week=" + Week.value;
                if(elem.value == "Please Choose Department"){
                    alert(helperMsg);
                    elem.focus();
                    return false;
                }else{
                    return true;
                }
            }

        </script>
    </head>
    <body>
        <div id="busy">
            <img alt="Am Working" src="http://<?php echo $base_url ?>images/BusyAnimation.gif"/>
        </div>
        <div id="thekey_page">
            <?php require_once $base_path . 'Templates/header.php'; ?>

            <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" -->
                <h1 class="form_lable">
                    Attendance Data Setting
                </h1>
                <?php
                include('../Classes/Class_ThekeyPayrollSystem_Data_Setting.php');
                $obj_PayrollData = new ThekeyPayrollSystem_Data_Setting();

                // echo "<font color=\"#FF6600\" size=\"+1\"> <p align=\"center\">Thekey Payroll System Attendance Data Setting </p></font>";
//echo "<p align=\"center\"><a onclick=\"POPUPW=window.open('Department_Selection.php','POPUPW','width=400,height=500');\" >Department Selection</a></p>";



                if (isset($_GET['Department']) && isset($_GET['Week'])) {
                    $Week = $_GET['Week'];
                    echo "<form name=\"SelectedID\"  action=\"WeekPayrollDataSettingSetup2.php\" method=\"post\">";

                    echo "<table  cellpadding=\"0\" align=\"center\" border=\"1\" bordercolor=\"#00F\"> ";
                    echo "<tr><td>Payroll Data Fields</td><td>";
                    $obj_PayrollData->get_week_Columns($_GET['Week']);
                    echo "</td>";
                    echo "<td><input required=\"required\" name=\"FieldData\" id=\"FieldData\" type=\"text\"></td></tr></table>";

                    echo "<td><input name=\"Week\" id=\"Week\" type=\"hidden\" value=\"$Week\"></td></tr></table>";
                    echo "<br/>";

                    echo "<input type=\"checkbox\" id=\"CHKALL\" name=\"CheckAll\" onclick=\"checkAll(document.SelectedID['CHK[]'])\" />Select All";

                    $obj_PayrollData->get_week_employee_list($_GET['Department'], $_GET['Week']);
                    echo "<br/>";




                    echo "<p align=\"center\"><input type=\"submit\" value=\"Next\" name=\"Next\"></p>";
                    echo "</form>";
                } else {
                    ?>

                    <form id="form1" name="form1" method="get" action="PayrollDataSettingSetup2.php">
                        <table align="center"  bgcolor="#EBEBEB" width="382" height="440">

                            <tr valign="baseline">

                                <td  align="right" nowrap="nowrap"><label for="Section">Week</label>:</td>
                                <td>
                                    <select name="Week" id="Week" class="week">
                                        <option selected="selected">Select Week Number</option>
                                        <?php
                                        $week = "week_";

                                        for ($i = 1; $i <= 6; $i++) {
                                            echo '<option value="' . $week . $i . '">' . $week . $i . '</option>';
                                        }
                                        ?>
                                    </select> 
                                </td>
                            </tr>
                            <tr valign="baseline">

                                <td  align="right" nowrap="nowrap"><label for="Section">Section</label>:</td>
                                <td>
                                    <select name="Section" class="Section">
                                        <option selected="selected">------Select Section-----</option>
                                        <?php
                                        $sql = mysql_query("Select DISTINCT Section from Department");
                                        while ($row = mysql_fetch_array($sql)) {
                                            $id = $row['Section'];
                                            $data = $row['Section'];
                                            echo '<option value="' . $id . '">' . $data . '</option>';
                                        }
                                        ?>
                                    </select> 
                                </td>
                            </tr>
                            <tr valign="baseline">
                                <td  align="right" nowrap="nowrap"><label>Sub Section</label>:</td>
                                <td>
                                    <select name="SubSection" class="SubSection">
                                        <option selected="selected">--First Select Section--</option>

                                    </select>
                                </td>
                            </tr>
                            <tr valign="baseline">
                                <td align="right" nowrap="nowrap"><label >Group</label>:</td>
                                <td>

                                    <select name="Group" class="Group">
                                        <option selected="selected">--First Select Section--</option>

                                    </select>

                                </td>
                            </tr>
                            <tr valign="baseline">
                                <td  align="right" nowrap="nowrap"><label ></label>Department:</td>
                                <td>

                                    <select id="Department" name="Department" class="Department"  >
                                        <option selected="selected">--First Select Section--</option>

                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                </td>
                                <td><input type="button" onclick="SelectedDepartment(document.getElementById('Department'),document.getElementById('Week'), 'Please Choose Department First')" value="Next" />
                                </td>
                            </tr>

                        </table>

                    </form>
                    <?php
                }
                ?>

            </div>
        </div>
    </body>
</html>