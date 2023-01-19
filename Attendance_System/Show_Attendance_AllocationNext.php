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
                    $quickFind = NULL;
                    foreach ($_POST['SelectedID'] as $key => $value) {
                        $valueArray = explode("_", $value);
                        $ID = $valueArray[0];
                        $Date = $valueArray[1];

                        $operation = "INSERT";

                        $obj_OT->Attendance_Cleaner("attendance_sheet", $Date, $Date, NULL, $ID);
                        $obj_OT->Attendance_Cleaner("attendance_allocation", $Date, $Date, NULL, $ID);

                        $obj_OT->Attendance_Scan_Sheet_Importer($Date, $Date, NULL, $ID);

                        $obj_OT->Attendance_Allocation($Date, $Date, NULL, $ID, $operation, $quickFind);
                        $quickFind = "NO";
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
                            <tr>
                                <td>
                                    <?php
                                    echo '<table>';
                                    echo '<th>ID</th>';
                                    echo '<th>Date</th>';

                                    foreach ($_POST['ID'] as $key => $value) {
                                        $valueArray = explode("_", $value);
                                        $ID = $valueArray[0];
                                        $Date = $valueArray[1];

                                        echo '<tr>';
                                        echo '<td>' . $ID . '</td>';
                                        echo '<td>' . $Date . '</td>';
                                        echo '</tr>';

                                        echo '<input type="hidden" id="SelectedID[]" name="SelectedID[]" value="' . $value . '" />';
                                    }
                                    echo '</table>';
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Action Taken:
                                </td>
                                <td>
                                    <input type="radio" id="Action" Name="Action">Run Attendance Allocation</input>
                                    <!--input type="radio" id="Action" Name="Action">Schedule for Automatic Attendance Allocation</input-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                </td>
                                <td>
                                    <input type="submit" value="Run Now" />
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
