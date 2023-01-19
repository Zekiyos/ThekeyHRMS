<?php
if (!defined('validurl'))
    define("validurl", TRUE);

$dont_check = true;

require_once('../Connections/HRMS.php');
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
                    Salary Increment
                </h1>

                <?php
                require_once('../Classes/Class_Salary_Increment.php');
                $obj_Salary_Increment = new Salary_Increment();
                if (!session_id()) {
                    session_start();
                }


                $IDNo = $_SESSION['IDNo'];

                $arrIDNo = Explode(",", $IDNo);
                foreach ($arrIDNo as $value) {
                    //echo "<br/>".$value."<br/>";
                    $obj_Salary_Increment->Update_Salary($value);
                }
                //session_unset();
                echo "<script type=\"text/javascript\"> alert('You have Granted Access Successfully!!'); </script>";
                ?>
            </div>
        </div>
    </body>
    <!-- InstanceEnd -->
</html>


