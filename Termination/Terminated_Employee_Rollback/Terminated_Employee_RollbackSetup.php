<?php
if (!defined('validurl'))
    define("validurl", TRUE);
require_once('../../Connections/HRMS.php');

require_once('../../Classes/Class_AccessLevel.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Thekey HRMS</title>

        <?php
        $dont_check = true;
        $base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
        require_once $base_path . 'Templates/head.php';
        ?>
        <script type="text/javascript">
   
            function checkAll(field) {
                if(document.SelectedID.CheckAll.checked)
                {
                    for (i = 0; i < field.length; i++)
                        field[i].checked = true;
                }
                else
                {
                    for (i = 0; i < field.length; i++)
                        field[i].checked = false;
                }
            }
        </script>
    </head>

    <body>
        <div id="busy">
            <img alt="Am Working" src="http://<?php echo $base_url ?>images/BusyAnimation.gif"/>
        </div>
        <div id="thekey_page">
            <?php require_once $base_path . 'Templates/header.php'; ?>

            <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" -->
                <h1 class="form_lable">
                    Terminated Employee Rollback  Definition Data
                </h1>
                <?php
                require_once('../../Connections/HRMS.php');


                require_once('../../Classes/Class_Terminated_Employee_Rollback.php');
                $obj_Terminated_Rollback = new Terminated_Employee_Rollback();
                echo "<form name=\"SelectedID\"  action=\"Terminated_Employee_RollbackSetup2.php\" method=\"post\">";

                echo "<input type=\"checkbox\" id=\"CHKALL\" name=\"CheckAll\" onclick=\"checkAll(document.SelectedID['CHK[]'])\" />Select All";

                $obj_Terminated_Rollback->get_Terminated_employee_list();
                echo "<br/>";

                echo "<p align=\"center\"><input type=\"submit\" value=\"Next\" name=\"Next\"></p>";
                echo "</form>";
                ?>
            </div>
        </div>

    </body>
</html>