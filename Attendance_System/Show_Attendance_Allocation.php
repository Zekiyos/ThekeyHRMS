

<?php
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;
?>

<?php
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


        <title>Attendance Allocation</title>




        <script type='text/JavaScript' src="../Js/SelectedDepartment4Attendance.js" ></script>


    </head>
    <body>
        <div id="busy">
            <img alt="Am Working" src="http://<?php echo $base_url ?>images/BusyAnimation.gif"/>
        </div>
        <div id="thekey_page">
            <?php require_once $base_path . 'Templates/header.php'; ?>

            <div id="mainContent">
                <!-- InstanceBeginEditable name="MainContent" -->
            <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" --> 
                <?php
                $editFormAction = $_SERVER['PHP_SELF'];
                if (isset($_SERVER['QUERY_STRING'])) {
                    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
                }
                ?>
                <?php
                include('../Classes/Class_Attendance_System.php');
                $obj_OT = new Attendance_System();

                if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {



                    if ((isset($_POST['From_Date']) && isset($_POST['To_Date']))) {
                        if ((isset($_POST['Department'])) && ($_POST['Department'] != '')
                                && ($_POST['ID'] == '') ) {

                            $Department = $_POST['Department'];
                            $fromDate = $_POST['From_Date'];
                            $toDate = $_POST['To_Date'];
                            $obj_OT->showAttendanceAllocation($fromDate, $toDate, $Department);
                        } else
                        if ((isset($_POST['ID'])) || (isset($_POST['Group_No']))) {

                            $ID = array();

                            if ((isset($_POST['ID'])) && ($_POST['ID'] != '')) {
                                $ID = explode(',', $_POST['ID']);
                            }

                            if (isset($_POST['Group_No']) && ($_POST['Group_No'] != '')) {

                                $Group_No = $_POST['Group_No'];

                                foreach ($Group_No as $key => $Group_Novalue) {
                                    $IDGroupNo = $obj_OT->get_employee_list_group_no($Group_Novalue);
                                    $ID = array_merge($ID, $IDGroupNo);
                                }
                            }
                            $obj_OT->showAttendanceAllocation($fromDate, $toDate, $Department = NULL, $ID);
                        }
                    }
                } else {

                    $query_RSGroupNo = "SELECT * FROM `department_group_no` WHERE `Department` IN (
                    SELECT Department FROM thekey_department_data_access 
                    Where group_name='" . $_SESSION['MM_UserGroup'] . "') ORDER BY Group_No";

                    $RSGroupNo = mysql_query($query_RSGroupNo) or die(mysql_error());
                    $row_RSGroupNo = mysql_fetch_assoc($RSGroupNo);
                    $totalRows_RSGroupNo = mysql_num_rows($RSGroupNo);
                    ?>
                    <h1 class="form_lable">
                        <?php echo $obj_lang->get('Attendance Allocation Result Display', $lang); ?>
                    </h1>
                    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                        <table align="center"  bgcolor="#EBEBEB" width="382" height="361">
                            <tr valign="baseline">
                                <td align="right">
                                    From Date
                                </td>
                                <td nowrap="nowrap">
                                    <input type="date" name="From_Date" id="From_Date"  value='<?php echo date('Y-m-d'); ?>' size="12" />
                                </td>
                            </tr>
                            <tr>
                                <td align="right">
                                    To Date
                                </td>
                                <td>
                                    <input type="date" name="To_Date" id="To_Date" value='<?php echo date('Y-m-d'); ?>' size="12" />
                                </td>
                            </tr>
                            <tr valign="baseline">
                                <td align="right" nowrap="nowrap"><label for="Section">Section</label>:</td>
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
                                <td align="right" nowrap="nowrap"><label>Sub Section</label>:</td>
                                <td>
                                    <select name="SubSection" class="SubSection">
                                        <option selected="selected">--First Select Section--</option>
                                    </select>
                                </td>
                            </tr>
                            <tr valign="baseline">
                                <td  align="right" nowrap="nowrap"><label >Group</label>:</td>
                                <td>

                                    <select name="Group" class="Group">
                                        <option selected="selected" value="">--First Select Section--</option>

                                    </select>

                                </td>
                            </tr>
                            <tr valign="baseline">
                                <td  align="right" nowrap="nowrap"><label ></label>Department:</td>
                                <td>

                                    <select id="Department[]" name="Department" class="Department" >
                                        <option selected="selected" value="" >--First Select Section--</option>

                                    </select>
                                </td>
                            </tr>
                            <?php
                            if (isset($company_info['support_group'])) {
                                if ($company_info['support_group']) {
                                    echo '<tr>';
                                    echo '<td align="right">';
                                    echo 'Group Number';
                                    echo '</td>';
                                    echo '<td>';

                                    echo '<Select name="Group_No[]" class="Group_No" multiple="multiple" id="Group_No[]" >';

                                    do {
                                        echo '<option value="' . $row_RSGroupNo['Group_No'] . '" >';
                                        echo $row_RSGroupNo['Group_No'] . '</option>';
                                    } while ($row_RSGroupNo = mysql_fetch_assoc($RSGroupNo));

                                    echo '</select>';

                                    echo '</td>';
                                    echo '</tr>';
                                }
                            }
                            ?>
                            <tr valign="baseline">
                                <td  align="right" nowrap="nowrap"><label >ID Number:</label></td>
                                <td>
                                    <input  type="text" ID="ID[]" Name="ID" value="" placeholder="ID No 1,ID No 2,ID No 3.." size="200"/>


                                </td>
                            </tr>
                            <tr>
                                <td>
                                </td>
                                <td>
                                    <input type="submit" value="Show Attendance Allocation" />
                                </td>
                            </tr>

                        </table>
                        <input type="hidden" name="MM_insert" value="form1" />
                    </form>
                <?php }
                ?>
                <blockquote>&nbsp;</blockquote>
                <!-- InstanceEndEditable -->
            </div>
        </div>

    </body>
    <!-- InstanceEnd --></html>

<?php
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$finish = $time;
$total_time = round(($finish - $start), 4);
echo 'This Attendance Allocation Page generated in ' . $total_time . ' Seconds.';
?>