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
                if (isset($_GET['Auto_ID']) && (!isset($_POST['MM_update']))) {
                    $case_id = $_GET['Auto_ID'];
                    $mydb->where('Auto_ID', $case_id);
                    $mydb->delete('equipment_handover');
                }



                $mydb = new DataBase();
                $header_lable = 'Equipment Handover';
                $mydb = filter($mydb);
                $result = $mydb->get('equipment_handover');
                $total_num_row = $result['total_row'];                 $result = $result['result'];

                $header_info = $mydb->show_column('equipment_handover');
                ksort($header_info);

                $update_page = 'EquipmentHandOverUpdate.php';
                $key_filed = 'Auto_ID';

                $hide = array('Auto_ID' => 'Auto_ID');
                $table = "employee_offday";



                require_once $base_path . 'gui/grid_view.php';
                ?>

                <!-- InstanceEndEditable -->
            </div>
        </div>

    </body>
    <!-- InstanceEnd --> </html>


