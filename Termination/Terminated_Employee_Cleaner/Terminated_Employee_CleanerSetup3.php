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


                <?php
                require_once $base_path . 'Classes/Class_Terminated_Employee_Cleaner.php';
                $obj_Terminated_Cleaner = new Terminated_Employee_Cleaner();
                if (!session_id()) {
                    session_start();
                };

                $IDNo = $_SESSION['IDNo'];

                $arrIDNo = Explode(",", $IDNo);
                foreach ($arrIDNo as $value) {
                    for ($i = 1; $i <= 6; $i++) {
                        $week = "week_" . $i;
                        $obj_Terminated_Cleaner->Clear_Terminated_Employee($value, $week);
                    }

                    $obj_Terminated_Cleaner->Clear_Terminated_Employee($value, "total_deduction");
                }
                //session_unset();
                echo "<script type=\"text/javascript\"> alert('You have Cleared Selected employee Successfully!!'); </script>";
                ?>

                <!-- InstanceEndEditable -->
            </div>
        </div>
    </body>
    <!-- InstanceEnd -->
</html>


