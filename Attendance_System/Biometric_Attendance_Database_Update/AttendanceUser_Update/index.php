 
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
                if (isset($_GET['Auto_ID']) && (count($_POST) == 0)) {
                    $case_id = $_GET['Auto_ID'];
                    $mydb->where('Auto_ID', $case_id);
                    $result = $mydb->delete('user_attendance');
                    if ($result) {
                        alert('You Have Succesffuly Delete the Record !');
                    }
                }



                $mydb = new DataBase();
                $header_lable = 'Attendance User';
                $mydb = filter($mydb,true);
                $result = $mydb->get('user_attendance');
                $total_num_row = $result['total_row'];                 $result = $result['result'];
                
                $header_info = $mydb->show_column('user_attendance');
                ksort($header_info);

                $update_page = 'AttendanceUserUpdate.php';
                $key_filed = 'Auto_ID';

                $hide = array('Auto_ID' => 'Auto_ID');
                $table = "user_attendance";

                require_once $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/gui/grid_view.php';
                ?>

                <!-- InstanceEndEditable -->
            </div>
        </div>
    </body>
    <!-- InstanceEnd --> </html>


