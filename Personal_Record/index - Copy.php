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
        <div id="thekey_page" class="not_pop_up">
            <?php require_once $base_path . 'Templates/header.php'; ?>

            <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" -->
                <?php
                echo '<p class="WelCome">Wel Come "' . $_SESSION['MM_Fullname'] . "\"</p>";

                $mydb = new DataBase();
                ?>
                <h1 class="form_lable">Employee Perosnal Detail Information</h1>
                <?php
                if (isset($_GET['id'])) {
                    $case_id = $_GET['id'];
                    $mydb->where('ID', $case_id);
                    $result = $mydb->delete('employee_personal_record');
                    if ($result) {
                        alert('You Have Succesffuly Delete the Record !');
                    }
                }



                $mydb = new DataBase();
                $mydb->select(array('id', 'Auto_ID', 'FirstName as First Name', 'MiddelName as Middel Name', 'LastName as Last Name', 'Sex', 'Martial_Status as Martial Status', 'Department'));
                //$header_lable = 'Employee Perosnal Detail Information';
                $mydb = filter($mydb);
                $result = $mydb->get('employee_personal_record');
                $total_num_row = $result['total_row'];                 $result = $result['result'];


                $header_info = $mydb->show_column('employee_personal_record');
                ksort($header_info);
                

                $update_page = 'Employee_Personal_Record.php';
                $key_filed = 'id';

                
                
                $action = array(
                    "view" => array("url" => "Personal_Information_Detail.php", "key" => "id"),
                );
                $hide = array('Auto_ID' => 'Auto_ID');
                $table = 'employee_offday';
                require_once $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/gui/grid_view.php';
                ?>

                <!-- InstanceEnd Editable -->
            </div>
        </div>

    </body>
    <!-- InstanceEnd -->
</html>


