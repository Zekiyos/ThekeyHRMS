<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/ThekeyHRMS_main_Template.dwt" codeOutsideHTMLIsLocked="false" -->
    <head>
        <!--meta http-equiv="Content-Type" content="text/html; charset=utf-8" /-->
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

            <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" -->
                <?php
                echo '<p class="WelCome">Wel Come "' . $_SESSION['MM_Fullname'] . "\"</p>";

                $mydb = new DataBase();
                ?>

                <?php
                $editFormAction = $_SERVER['PHP_SELF'];
                if (isset($_SERVER['QUERY_STRING'])) {
                    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
                }

                if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

                    if (!(mysql_num_rows(mysql_query("SELECT Department FROM working_time_setting where Department='" . $_POST['Department'] . "'")))) {

                        $SelectedDepartment = array();
                        $selectedDate = array();

                        $SelectedDepartment = $_POST['Department'];

                        $selectedDate = explode(",", $_POST['Date_Selected']);


                        foreach ($selectedDate as $selectedDatevalue) {


                            foreach ($SelectedDepartment as $SelectedDepartmentvalue) {

                                $Department = $SelectedDepartmentvalue;
                                $From_Date = $selectedDatevalue;
                                $To_Date = $selectedDatevalue;

                                $data = array('Department' => $Department
                                    , 'From_Date' => $From_Date
                                    , 'To_Date' => $To_Date
                                    , 'Start' => $_POST['Start']
                                    , 'Start_Break' => $_POST['Start_Break']
                                    , 'End_Break' => $_POST['End_Break']
                                    , 'End' => $_POST['End']
                                    , 'Working_Hour' => $_POST['Working_Hour']
                                    , 'Working_Hour_Hold' => $_POST['Working_Hour_Hold']
                                    , 'ModifiedBy' => $_SESSION['MM_Fullname']
                                );

                                $Result1 = $mydb->insert('working_time_setting', $data);
                            }
                        }



                        if ($Result1)
                            echo "<script type=\"text/javascript\">alert('You have Defined Working time Successfully for the Selected Department.')</script>";
                    }
                    else
                        echo "<script type=\"text/javascript\">alert('Working time for {$_POST['Department']} Department already Defined.If you want to redefine it,delete first defined data.')</script>";
                }
                ?>
                <?php
                mysql_select_db($database_HRMS, $HRMS);
                //$query_RSDepartment = "SELECT Department FROM department ORDER BY Department ASC";
                $query_RSDepartment = "SELECT * FROM thekey_department_data_access Where group_name='" . $_SESSION['MM_UserGroup'] . "' ORDER BY Department ASC";
                $RSDepartment = mysql_query($query_RSDepartment, $HRMS) or die(mysql_error());
                $row_RSDepartment = mysql_fetch_assoc($RSDepartment);
                $totalRows_RSDepartment = mysql_num_rows($RSDepartment);

                //******************FOr Comapny suport Group NO************/
                $query_RSGroupNo = "SELECT * FROM `department_group_no` WHERE `Department` IN (
                    SELECT Department FROM thekey_department_data_access 
                    Where group_name='" . $_SESSION['MM_UserGroup'] . "')";

                $RSGroupNo = mysql_query($query_RSGroupNo, $HRMS) or die(mysql_error());
                $row_RSGroupNo = mysql_fetch_assoc($RSGroupNo);
                $totalRows_RSGroupNo = mysql_num_rows($RSGroupNo);

                /*                 * ************************ */

                include '../classes/Class_Report.php';

                $objReport = new Report();
                ?>
                <h1 class="form_lable">
                    <?php echo $obj_lang->get('Report Definition Create Form', $lang); ?>
                </h1>
                <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form_multiple">
                    <table width="400" height="395" align="center" background="" bgcolor="#EBEBEB">

                        <tr valign="baseline">

                            <td height="41" align="right" nowrap="nowrap"><?php echo $obj_lang->get('Report Name', $lang); ?>:</td>
                            <td>
                                <input type="text" id="Report_Name" name="Report_Name" value='' size="20"  />
                            </td>

                        </tr>
                        <tr valign="baseline">
                            <td height="41" align="right" nowrap="nowrap"><?php echo $obj_lang->get('Report Description', $lang); ?>:</td>
                            <td>
                                <textarea type="text" id="Report_Description" name="Report_Description">
                                </textarea>
                            </td>
                        </tr>
                        <tr valign="baseline">

                            <td height="41" align="right" nowrap="nowrap"><?php echo $obj_lang->get('Table Name', $lang); ?>:</td>
                            <td>
                                <select id="Report_Table_Name" name="Report_Table_Name" class="Report_Table_Name"  >
                                    <?php
                                    $objReport->Show_Table_List();
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr valign="baseline">

                            <td height="41" align="right" nowrap="nowrap"><?php echo $obj_lang->get('JOIN Table', $lang); ?>:</td>
                            <td>
                                <select id="Report_Join_Table_Name" name="Report_Join_Table_Name" class="Report_Join_Table_Name"  >
                                    <?php
                                    $objReport->Show_Table_List();
                                    ?>
                                </select>

                            </td>
                        </tr>

                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Report Filed:</td>
                            <td>
                                <select name="Report_Field[]" id="Report_Field[]" class="Report_Field" multiple="multiple" size="8">

                                </select>
                            </td>
                        </tr>

                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Report Filed Display Name:</td>
                            <td>
                                <textarea name="Report_Field_Display_Name[]" id="Report_Field_Display_Name[]" class="Report_Field_Display_Name"  size="8">
                                  
                                </textarea>
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">&nbsp;</td>
                            <td><input type="submit" value="Define Report" /></td>
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