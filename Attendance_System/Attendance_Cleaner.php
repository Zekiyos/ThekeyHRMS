<?php require_once('../Connections/HRMS.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Thekey HRMS</title>

        <?php
        $dont_check = true;
        $base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
        require_once $base_path . 'Templates/head.php';
        ?>
        <script type="text/javascript" src="../Js/SelectedDepartment4ScanSheet.js"></script>

    </head>S
    <body>
        <div id="busy">
            <img alt="Am Working" src="http://<?php echo $base_url ?>images/BusyAnimation.gif"/>
        </div>
        <div id="thekey_page">
            <?php require_once $base_path . 'Templates/header.php'; ?>

            <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" -->
                <h1 class="form_lable">
                    Attendance Cleaner
                </h1>

                <?php
                include('../Classes/Class_Attendance_System.php');
                $obj_AS = new Attendance_System();

                $editFormAction = $_SERVER['PHP_SELF'];

                if (isset($_SERVER['QUERY_STRING'])) {
                    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
                }

                if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

                    if ((isset($_POST['TableName'])) && (isset($_POST['Department'])) && isset($_POST['From_Date']) && isset($_POST['To_Date'])) {
                        $TableName = $_POST['TableName'];
                        $From_Date = $_POST['From_Date'];
                        $To_Date = $_POST['To_Date'];
                        $SelectedDepartment = $_POST['Department'];
                        foreach ($SelectedDepartment as $SelectedDepartmentvalue) {
                            $resultCL = $obj_AS->Attendance_Cleaner($_POST['TableName'], $SelectedDepartmentvalue, $_POST['From_Date'], $_POST['To_Date']);
                        }

                        if ($resultCL)
                            echo "<script type = \"text/javascript\"> alert(' You have Cleaned $TableName for $SelectedDepartmentvalue from $From_Date to $To_Date Successfully.')</script>";
                    }
                }
                ?>




                <form id="form_multiple" name="form1" method="POST"  action="<?php echo $editFormAction; ?>">
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
                                    <option selected="selected">--First Select Section--</option>

                                </select>

                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td  align="right" nowrap="nowrap"><label ></label>Department:</td>
                            <td>

                                <select id="Department" name="Department[]" class="Department" multiple   >
                                    <option selected="selected" value="?">--First Select Section--</option>

                                </select>
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td  align="right" nowrap="nowrap"><label ></label>Choose Table:</td>
                            <td>

                                <input type="radio" name="TableName" id="TableName" value="attendance_allocation" checked="checked"/>Attendance Allocation
                            </td>
                        </tr>

                        <tr>
                            <td>

                            </td>
                            <td>
                                <input type="submit"  value="Clean" onClick="return confirm('Are you sure you want to Issue, you want to Clean Attendance?')"  />
                            </td>
                        </tr>

                    </table>
                    <input type="hidden" name="MM_insert" value="form1" />
                </form>


            </div>
        </div>
    </body>
</html>