<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../Salary Increment Report/ProgressBar.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?php require_once('../Connections/HRMS.php'); ?>
<?php

include('../Salary Increment Report/Class_progressBar.php'); 
$obj_prg_bar=new  Progress_Bar();

include('Class_Terminated_Employee_Rollback.php'); 
$obj_Terminated_Rollback=new  Terminated_Employee_Rollback();
session_start();
$obj_prg_bar->progressbar('Terminated Employee is Rollingback... ',250000,' Rolling back to Current Employee Has Been Done.');

//if(isset($_POST['IDNo']))

//echo $_SESSION['IDNo'];
$IDNo=$_SESSION['IDNo'];

 $arrIDNo = Explode(",", $IDNo); 
 foreach($arrIDNo as $value)
        {
			echo "<br/>".$value."<br/>";
			if ($value="AQ-01360")
			echo "<br/>".$value."<br/>";
			
			//copy terminated employee detial back to Current Employee
			
$obj_Terminated_Rollback->Rollback($value,"terminated_employee_personal_record","employee_personal_record");
		
$obj_Terminated_Rollback->Rollback($value,"terminated_employee_annual_leave","annual_leave");

$obj_Terminated_Rollback->Rollback($value,"terminated_employee_disciplinary_action","disciplinary_action");	

$obj_Terminated_Rollback->Rollback($value,"terminated_employee_funeral_leave","funeral_leave");

$obj_Terminated_Rollback->Rollback($value,"terminated_employee_maternity_leave","maternity_leave");

$obj_Terminated_Rollback->Rollback($value,"terminated_employee_paternity_leave","paternity_leave");

$obj_Terminated_Rollback->Rollback($value,"terminated_employee_special_leave","special_leave");

$obj_Terminated_Rollback->Rollback($value,"terminated_employee_sick_leave","sick_leave");

$obj_Terminated_Rollback->Rollback($value,"terminated_employee_wedding_leave","wedding_leave");


//Clearing all entered data after termination
$obj_Terminated_Rollback->Clear_Rollbacked($value,"terminated_employee_personal_Record");

$obj_Terminated_Rollback->Clear_Rollbacked($value,"terminated_employee_annual_leave");

$obj_Terminated_Rollback->Clear_Rollbacked($value,"terminated_employee_disciplinary_action");

$obj_Terminated_Rollback->Clear_Rollbacked($value,"terminated_employee_funeral_leave");

$obj_Terminated_Rollback->Clear_Rollbacked($value,"terminated_employee_maternity_leave");

$obj_Terminated_Rollback->Clear_Rollbacked($value,"terminated_employee_paternity_leave");

$obj_Terminated_Rollback->Clear_Rollbacked($value,"terminated_employee_special_leave");

$obj_Terminated_Rollback->Clear_Rollbacked($value,"terminated_employee_personal_record");

$obj_Terminated_Rollback->Clear_Rollbacked($value,"terminated_employee_sick_leave");

$obj_Terminated_Rollback->Clear_Rollbacked($value,"terminated_employee_wedding_leave");

$obj_Terminated_Rollback->Clear_Rollbacked($value,"terminated_employee_employee");

}
echo "<script type=\"text/javascript\"> alert('You have Rolled back employee Successfully!!'); </script>";

?>


</body>
</html>