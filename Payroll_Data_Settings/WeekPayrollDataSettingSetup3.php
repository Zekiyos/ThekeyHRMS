 
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
//include('file:///E|/HRM/Classes/Progress bar Class/Class_ProgressBar.php'); 
//$obj_prg_bar=new  Progress_Bar();

                include('../Classes/Class_ThekeyPayrollSystem_Data_Setting.php');

                $obj_PayrollData = new ThekeyPayrollSystem_Data_Setting();

//session_start();

                if (isset($_POST['FieldData']) && isset($_POST['Field']) && isset($_POST['Week'])) {

                    $FieldData = $_POST['FieldData'];
                    $Field = $_POST['Field'];
                    $Week = $_POST['Week'];
                    $IDNo = "";
                    $IDNo = $_SESSION['IDNo'];
                    $arrIDNo = Explode(",", $IDNo);
                    foreach ($arrIDNo as $value) {
                        $update = $obj_PayrollData->UpdatePayrollData($Week, $Field, $FieldData, $value);
                    }
                    if (isset($update) and ($update)) {
                        session_unset();
                        echo "<script type=\"text/javascript\"> alert('You have Updated Payroll Attendance Data Setting Successfully!!'); </script>";
                    }
                }
                ?>
                <!-- InstanceEndEditable -->
            </div>
        </div>

    </body>
    <!-- InstanceEnd -->
</html>


