<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/ThekeyHRMS_main_Template.dwt" codeOutsideHTMLIsLocked="false" -->
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
                require_once('../../Classes/Class_Attendance_System.php');

                $obj_OT = new Attendance_System();

                require_once ("SelectedDepartment4OTDefinition.php");

                echo "<br/>";
                echo "<br/>";
                echo "<br/>";
                echo "<br/>";

                echo "<form name=\"SelectedID\"  action=\"OT_Definition2.php\" method=\"post\">";

                echo "<input type=\"checkbox\" id=\"CHKALL_ID\" name=\"CheckAll_ID\"  onclick=\"checkAll(document.SelectedID['CHK_ID[]'])\" />Select All";

                $Today = date('Y-m-d');

                echo "<font color=\"#FF9900\" face=\"Times New Roman, Times, serif\" size=\"+2\">From Date:</font> <input type=\"date\" name=\"From_Date\" value='$Today' />";


                echo "<font color=\"#FF9900\" face=\"Times New Roman, Times, serif\" size=\"+2\"> To Date:</font> <input type=\"date\" name=\"To_Date\" value='$Today' />";


                if (isset($_GET['Department']))
                    echo $obj_OT->OT_Setting_List($_GET['Department']);


                echo "<p align=\"center\"><input type=\"submit\" value=\"Next\" name=\"Next\"></p>";
                echo "</form>";
                ?>

                <!-- InstanceEndEditable -->
            </div>
        </div>
    </body>
    <!-- InstanceEnd -->
</html>