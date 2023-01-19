
<?php require_once('../Connections/HRMS.php'); ?>
<?php

require_once('../Classes/Class_AccessLevel.php');
$obj_AccessLevel = new AccessLevel();
echo $obj_AccessLevel->CHK_AccessLevel();
?>

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('../Classes/Class_Attendance_System.php');
$obj_OT = new Attendance_System();



//$StackDepartment=array($Department);
//$StackDepartment=$Department;

$StackDepartment = array();

$StackDepartment = $obj_OT->get_full_department_list('Department');
foreach ($StackDepartment as $Departmentvalue) {
    // if (mysql_num_rows(mysql_query("Select * FROM `Attendance_Sheet` WHERE `Department`='" . $Departmentvalue . "'"))) {

    $dates = $obj_OT->get_not_Scaned_Date($Departmentvalue);
    print_r($dates);
    echo '<br/>';
    echo '<br/>';
//  $IDStack=$obj_OT->get_Scaned_employee('GH 11 Aspen Harvesting');
//print_r($IDStack);
    echo '<br/>';
    echo '<br/>';

    $obj_OT->get_not_Scaned_employee($Departmentvalue); //012-07-21', '2012-08-19');
    //print_r($Not_Scanned_ID);
    echo '<br/>';
    echo '<br/>';
    //  }
}
?>
