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
                require_once('../../Classes/Class_Terminated_Employee_Rollback.php');
                $obj_Terminated_Rollback = new Terminated_Employee_Rollback();

                echo "<form name=\"SelectedID4Update\"  action=\"Terminated_Employee_RollbackSetup3.php\" method=\"post\">";

                echo "<input  name=\"IDNo\" type=\"hidden\" >";
                if (!session_id()) {
                    session_start();
                };
                $_SESSION['IDNo'] = "";
                if (isset($_POST['CHK']) && isset($_POST['Next'])) {
                    $a = $_POST['CHK'];
                    if (empty($a)) {
                        echo("You didn't select any Terminated Employee for RollBack to Current Employee.");
                    } else {
                        $N = count($a);
                        /* for($i=0; $i < $N; $i++)
                          {
                          $IDNumber=str_replace("'","",$a[$i]);

                          $_SESSION['IDNo'].=",".$IDNumber;
                          } */
                        echo("You selected $N Employees(s): ");

                        $obj_Terminated_Rollback->get_selected_terminated_employee($a);
                    }
                }
                echo "<p align=\"center\"><a href=\"Terminated_Employee_RollbackSetup.php\"><input type=\"button\" value=\"Before\" name=\"Before\" ></a>";
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"Rollback\" value=\"Rollback to Current Employee\"></p>";
                echo "</form>";
                ?>

                <!-- InstanceEndEditable -->
            </div>
        </div>
    </body>
    <!-- InstanceEnd -->
</html>


