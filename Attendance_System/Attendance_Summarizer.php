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
                    Attendance Summarizer
                </h1>

                <?php
                include('../Classes/Class_Attendance_System.php');
                $obj_AS = new Attendance_System();



                $editFormAction = $_SERVER['PHP_SELF'];

                if (isset($_SERVER['QUERY_STRING'])) {
                    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
                }

                if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

                    if ((isset($_POST['Department'])) && isset($_POST['From_Date']) && isset($_POST['To_Date'])) {

                        $SelectedDepartment = $_POST['Department'];

                        $Year_Month = $_POST['month'];


                        $SourceTable = "Attendance_Allocation";
                        $TableName = "Attendance_Allocation_" . $Year_Month;


                        $SourceTableAS = "Attendance_Sheet";
                        $TableNameAS = "Attendance_Sheet_" . $Year_Month;

                        $SourceTableAS2 = "Attendance_Summary";
                        $TableNameAS2 = "Attendance_Summary_" . $Year_Month;

                        foreach ($SelectedDepartment as $SelectedDepartmentvalue) {

                            // $result1 = $obj_AS->Summarize_Current_Attendance($SourceTable, $TableName, $SelectedDepartmentvalue, $_POST['From_Date'], $_POST['To_Date']);

                            //$result2 = $obj_AS->Summarize_Current_Attendance($SourceTableAS, $TableNameAS, $SelectedDepartmentvalue, $_POST['From_Date'], $_POST['To_Date']);


                            //$result3 = $obj_AS->Summarize_Current_Attendance($SourceTableAS2, $TableNameAS2, $SelectedDepartmentvalue, $_POST['From_Date'], $_POST['To_Date']);

                            $result4 = $obj_AS->attendanceSummarizer($Year_Month,$SelectedDepartmentvalue, $_POST['From_Date'], $_POST['To_Date']);
                        }

                        //if (($result1) && ($result2) && ($result3)) {
                        if ($result4) {
                            $alertMessage = 'Attendance is Summarized for month of $Year_Month Successfully.';

                            $alertType = 'Success';
                           // showAlert($alertMessage, $alertType);
						    echo "<script type=\"text/javascript\"> alert('Attendance is Summarized for month of $Year_Month Successfully.')</script>";
                        }
                    }
                }


                $tomorrow = mktime(0, 0, 0, date("m"), date("d") + 1, date("Y"));
                $lastmonth = mktime(0, 0, 0, date("m") - 1, date("d"), date("Y"));
                $nextmonth = mktime(0, 0, 0, date("m") + 1, date("d"), date("Y"));
                $nextyear = mktime(0, 0, 0, date("m"), date("d"), date("Y") + 1);

                $Year_MonthCurrent = date('Y_F');
                $Year_MonthNext = date('Y_F', $nextmonth);
				$Year_MonthPrev = date('Y_F', $lastmonth);
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
                            <td align="right" nowrap="nowrap"><label>Summarize Month</label>:</td>
                            <td>
                                <select name="month" >
                                    <option selected="selected">--Select Month--</option>
									<option ><?php echo $Year_MonthPrev; ?></option>
                                    <option ><?php echo $Year_MonthCurrent; ?></option>
                                    <option ><?php echo $Year_MonthNext; ?></option>
									

                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>

                            </td>
                            <td>
                                <input type="submit"  value="Summarize" onClick="return confirm('Are you sure you want to Issue, you want to Summarize Attendance?')"  />
                            </td>
                        </tr>

                    </table>
                    <input type="hidden" name="MM_insert" value="form1" />
                </form>


            </div>
        </div>
    </body>
</html>