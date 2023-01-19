<?php require_once('../Connections/HRMS.php'); ?>
<?php
require_once('../Classes/Class_AccessLevel.php');
$obj_AccessLevel = new AccessLevel();
echo $obj_AccessLevel->CHK_AccessLevel();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Summerize Current Month Attendance</title>
    </head>

    <body>

        <?php
        require_once('../Classes/Class_Attendance_System.php');
        $obj_Sum = new Attendance_System();
        $Year_Month = "" . date("Y_F");
        echo $obj_Sum->Summarize_Current_Attendance($Year_Month);
        ?>
    </body>
</html>
