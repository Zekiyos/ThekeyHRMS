<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/ThekeyHRMS_main_Template.dwt" codeOutsideHTMLIsLocked="false" -->
    <head>
        <!--meta http-equiv="Content-Type" content="text/html; charset=utf-8" /-->
        <title>Thekey HRMS</title>
        <?php
        $base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
        $dont_check = true;
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
                include('../Classes/Class_ThekeyPayrollSystem_Data_Setting.php');

                $obj_PayrollData = new ThekeyPayrollSystem_Data_Setting();

                echo "<form name=\"SelectedID4Update\"  action=\"PayrollDataSettingSetup3.php\" method=\"post\">";

                echo "<input  name=\"IDNo\" type=\"hidden\" >";
                $_SESSION['IDNo'] = "";


                if (isset($_POST['CHK']) && isset($_POST['Next']) && isset($_POST['FieldData']) && isset($_POST['Field'])) {
                    $a = $_POST['CHK'];
                    $field = $_POST['Field'];
                    $fieldData = $_POST['FieldData'];




                    if (empty($a)) {
                        echo "<font color=\"#FF0000\">";
                        echo("You didn't Select any Employee for Payroll Data Setting.<br/>");
                        echo "</font>";
                    } else
                    if ($field == "Please Choose Payroll Data Field") {
                        echo "<font color=\"#FF0000\">";
                        echo("You didn't Select Payroll Data Field.<br/>");
                        echo "</font>";
                    } else
                    if ($fieldData == "") {
                        echo "<font color=\"#FF0000\">";
                        echo("You didn't Put Payroll Data for the Selected Field $field .<br/>");
                        echo "</font>";
                    } else {
                        $N = count($a);
                        /* for($i=0; $i < $N; $i++)
                          {
                          $IDNumber=str_replace("'","",$a[$i]);

                          $_SESSION['IDNo'].=",".$IDNumber;
                          } */
                        echo("You have selected <font color=\"#FF0000\">$N</font> Employees(s):<br/> ");

                        echo("To Set Payroll Data <font color=\"#FF0000\">$fieldData</font> for the Field <font color=\"#FF0000\">$field</font> .<br/>");

                        echo("<font color=\"#FF0000\">$field=$fieldData</font> .<br/>");

                        echo "<input  name=\"Field\" type=\"hidden\" value=\"$field\">";
                        echo "<input  name=\"FieldData\" type=\"hidden\" value=\"$fieldData\">";


                        $obj_PayrollData->get_selected_employee($a);
                    }
                }
                echo "<p align=\"center\"><a href=\"PayrollDataSettingSetup.php\"><input type=\"button\" value=\"Before\" name=\"Before\" ></a>";
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"Update\" value=\"Run\"></p>";
                echo "</form>";
                ?>
                <!-- InstanceEndEditable -->
            </div>
        </div>

    </body>
    <!-- InstanceEnd -->
</html>


