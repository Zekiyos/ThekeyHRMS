<?php
if (!defined('validurl'))
    define("validurl", TRUE);

$dont_check = true;

require_once('../../Connections/HRMS.php');
?>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Thekey HRMS</title>
        <?php
        $dont_check = true;
        $base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
        require_once $base_path . 'Templates/head.php';
        ?>
    </head>

    <body>
        <div id="busy">
            <img alt="Am Working" src="http://<?php echo $base_url ?>images/BusyAnimation.gif"/>
        </div>
        <div id="thekey_page">
            <?php require_once $base_path . 'Templates/header.php'; ?>

            <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" -->
                <h1 class="form_lable">
                    Terminated Employee Cleaner Data
                </h1>

                <?php require_once('../../Connections/HRMS.php'); ?>
                <?php
                require_once('../../Classes/Class_Terminated_Employee_Rollback.php');
                $obj_Terminated_Rollback = new Terminated_Employee_Rollback();
                if (!session_id()) {
                    session_start();
                };
                $IDNo = "";
                $IDNo = $_SESSION['IDNo'];
                $arrIDNo = Explode(",", $IDNo);
                foreach ($arrIDNo as $value) {
                    //echo "<br/>".$value."<br/>";
                    //if ($value="AQ-01360")
                    //echo "<br/>".$value."<br/>";
                    //copy terminated employee detial back to Current Employee

                    
                    if($value=='')
                    {
                        continue;
                    }
                    
                    $obj_Terminated_Rollback->Rollback($value, "terminated_employee_personal_record", "employee_personal_record");

                    $obj_Terminated_Rollback->Rollback($value, "terminated_employee_annual_leave", "annual_leave");

                    $obj_Terminated_Rollback->Rollback($value, "terminated_employee_disciplinary_action", "disciplinary_action");

                    $obj_Terminated_Rollback->Rollback($value, "terminated_employee_funeral_leave", "funeral_leave");

                    $obj_Terminated_Rollback->Rollback($value, "terminated_employee_maternity_leave", "maternity_leave");

                    $obj_Terminated_Rollback->Rollback($value, "terminated_employee_paternity_leave", "paternity_leave");

                    $obj_Terminated_Rollback->Rollback($value, "terminated_employee_special_leave", "special_leave");

                    $obj_Terminated_Rollback->Rollback($value, "terminated_employee_sick_leave", "sick_leave");

                    $obj_Terminated_Rollback->Rollback($value, "terminated_employee_wedding_leave", "wedding_leave");

                    $obj_Terminated_Rollback->Rollback($value, "terminated_employee_total_deduction", "total_deduction");

                    
                    list($IDNO, $FirstName, $MiddelName, $LastName, $Department) = $obj_Terminated_Rollback->get_terminated_employee("ThekeyHRMSDB", $value);
                    if ($value != "") {
                        for ($i = 1; $i <= 6; $i++) {
                            $week = "week_" . $i;

                            $obj_Terminated_Rollback->insert_week_attendance("ThekeyHRMSDB", $week, $value);
                        }
                    }


//Clearing all entered data after termination
                    $obj_Terminated_Rollback->Clear_Rollbacked($value, "terminated_employee_personal_Record");

                    $obj_Terminated_Rollback->Clear_Rollbacked($value, "terminated_employee_annual_leave");

                    $obj_Terminated_Rollback->Clear_Rollbacked($value, "terminated_employee_disciplinary_action");

                    $obj_Terminated_Rollback->Clear_Rollbacked($value, "terminated_employee_funeral_leave");

                    $obj_Terminated_Rollback->Clear_Rollbacked($value, "terminated_employee_maternity_leave");

                    $obj_Terminated_Rollback->Clear_Rollbacked($value, "terminated_employee_paternity_leave");

                    $obj_Terminated_Rollback->Clear_Rollbacked($value, "terminated_employee_special_leave");

                    $obj_Terminated_Rollback->Clear_Rollbacked($value, "terminated_employee_personal_record");

                    $obj_Terminated_Rollback->Clear_Rollbacked($value, "terminated_employee_sick_leave");

                    $obj_Terminated_Rollback->Clear_Rollbacked($value, "terminated_employee_wedding_leave");

                    $obj_Terminated_Rollback->Clear_Rollbacked($value, "terminated_employee");

                    $obj_Terminated_Rollback->Clear_Rollbacked($value, "terminated_employee_total_deduction");
                }
                //session_unset();
                echo "<script type=\"text/javascript\"> alert('You have Rolled back employee Successfully!!'); </script>";
                ?>

                <!-- InstanceEndEditable -->
            </div>
        </div>
    </body>
    <!-- InstanceEnd -->
</html>

