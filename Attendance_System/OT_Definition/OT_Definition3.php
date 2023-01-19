 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/ThekeyHRMS_main_Template.dwt" codeOutsideHTMLIsLocked="false" -->
    <head>
        <!--meta http-equiv="Content-Type" content="text/html; charset=utf-8" /-->
        <title>Thekey HRMS</title>

        <?php
        $dont_check = true;
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
                <?php require_once('../../Connections/HRMS.php'); ?>
                <?php
                require_once('../../Classes/Class_Attendance_System.php');
                $obj_OT = new Attendance_System();

                $IDNo = $_SESSION['IDNo'];

                //$Date=$_SESSION['Date'];

                if (isset($_POST['Date']))
                    $Date = $_POST['Date'];
                else
                    $Date = "";


                $arrIDNo = Explode(",", $IDNo);


                foreach ($arrIDNo as $IDvalue) {
                    //echo "<br/>".$value."<br/>";
                    $DayOTvalue = "";
                    $NightOTvalue = "";
                    $SundayOTvalue = "";
                    $HolydayOTvalue = "";

                    list($FirstName, $MiddelName, $LastName, $Department) = $obj_OT->get_employee_Detail($IDvalue);

                    if (isset($_POST['CHK_DayOT']))
                        if (in_array("'" . $IDvalue . "'", $_POST['CHK_DayOT']))
                            $DayOTvalue = "Y";

                    if (isset($_POST['CHK_NightOT']))
                        if (in_array("'" . $IDvalue . "'", $_POST['CHK_NightOT']))
                            $NightOTvalue = "Y";

                    if (isset($_POST['DayOT_MaxHR']))
                        $DayOT_MaxHR = $_POST['DayOT_MaxHR'];

                    if (isset($_POST['NightOT_MaxHR']))
                        $NightOT_MaxHR = $_POST['NightOT_MaxHR'];

                    if (isset($_POST['DayOT_Start']))
                        $DayOT_Start = $_POST['DayOT_Start'];

                    if (isset($_POST['NightOT_Start']))
                        $NightOT_Start = $_POST['NightOT_Start'];

                    if (isset($_POST['NightOT_End']))
                        $NightOT_End = $_POST['NightOT_End'];


                    if (isset($_POST['From_Date']))
                        $From_Date = $_POST['From_Date'];
                    else
                        $From_Date = "Unkown";


                    if (isset($_POST['To_Date']))
                        $To_Date = $_POST['To_Date'];
                    else
                        $To_Date = "Unkown";

                    if ($IDvalue != "")
                        $obj_OT->OT_Definition($IDvalue, $FirstName, $MiddelName, $LastName, $Department, $From_Date, $To_Date, $DayOTvalue, $DayOT_MaxHR, $NightOTvalue, $NightOT_MaxHR, $DayOT_Start, $NightOT_Start, $NightOT_End);
                }

                echo "<script type=\"text/javascript\"> alert('You have set the Defination of Overtime Successfully!!'); </script>";
                ?>
                <!-- InstanceEndEditable -->
            </div>
        </div>
    </body>
    <!-- InstanceEnd --> </html>


