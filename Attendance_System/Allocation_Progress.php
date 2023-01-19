<?php require_once('../Connections/HRMS.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Attendance Allocation</title>

        <link href="../Css/ProgressBar.css" rel="stylesheet" type="text/css" />
        <script language=javascript>
            <!--
            function popup(N) {
                newWindow = window.open(N, 'popD','toolbar=no,menubar=no,resizable=no,scrollbars=no,status=no,location=no,width=550,height=215');
            }
            //-->onload="javascript:popup('ALCalculatedReport.php')"
        </script>
    </head>

    <body>

        <?php
        require_once('../Classes/Class_ProgressBar.php');
        $obj_prg_bar = new Progress_Bar();

        require_once('../Classes/Class_Attendance_System.php');
        $obj_OT = new Attendance_System();

        $StackDepartment = $obj_OT->get_full_department_list("Department", "Department", "Department='Grading line 11-12'", "Department");

//$StackDepartment=array("GH 11-13 Cold Room","GH 11 Aspen Harvesting");	

        foreach ($StackDepartment as $Departmentvalue) {
            if (mysql_num_rows(mysql_query("Select * FROM `Attendance_Sheet` WHERE `Department`='" . $Departmentvalue . "'"))) {
                //"POPUPW=window.open('ALCalculatedReport.php','POPUPW','width=400,height=450');"
                $obj_prg_bar->progressbar('Attendnace Allocation is running for ' . $Departmentvalue . ' Department', 100000, 'Attendnace Allocation for ' . $Departmentvalue . ' Has Been Done.');
            }
        }
        ?>
    </body>
</html>