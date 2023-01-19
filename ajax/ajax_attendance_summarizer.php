<?php require_once('../Connections/Config_Connection.php'); ?>
<?php
//require_once('../Classes/Class_Connection.php');

require_once('../Classes/Class_Attendance_System.php');
$objAS = new Attendance_System();

if ((isset($_POST['selected_Department']))) {

    $_POST['selected_Department'] = $_POST['selected_Department'];
    $_POST['selected_monthYear'] = $_POST['selected_monthYear'];
    $From_Date = $_POST['From_Date'];
    $To_Date = $_POST['To_Date'];


    $objAS->generateAttendanceSummary($Department = $_POST['selected_Department'], $From_Date, $To_Date, $summarize = TRUE);
}
?>