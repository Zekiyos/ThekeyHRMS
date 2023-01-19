<?php require_once('../../Connections/HRMS.php'); ?>
<?php 
include('../../Classes/Class_AccessLevel.php');
 $obj_AccessLevel = new AccessLevel();
echo $obj_AccessLevel->CHK_AccessLevel(); 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Terminated Employee Cleaner</title>
<link href="../../css/ProgressBar.css" rel="stylesheet" type="text/css" />


</head>

<body>


<?php

include('../../Classes/Class_ProgressBar.php'); 
$obj_prg_bar=new  Progress_Bar();

include('../../Classes/Class_Terminated_Employee_Cleaner.php'); 
$obj_Terminated_Cleaner=new  Terminated_Employee_Cleaner();
session_start();
$obj_prg_bar->progressbar('Terminated Employee is Clearing... ',250000,' Cleaning Terminated Employee  Has Been Done.');

//if(isset($_POST['IDNo']))

//echo $_SESSION['IDNo'];
$IDNo=$_SESSION['IDNo'];

 $arrIDNo = Explode(",", $IDNo); 
 foreach($arrIDNo as $value)
        {
			//echo "<br/>".$value."<br/>";
			//if ($value="AQ-01360")
			//echo "<br/>".$value."<br/>";
			
			//copy terminated employee detial back to Current Employee
	for($i=1;$i<=6;$i++)
	{
	  $week="week_".$i;
	$obj_Terminated_Cleaner->Clear_Terminated_Employee($value,$week);
	}
	
	$obj_Terminated_Cleaner->Clear_Terminated_Employee($value,"total_deduction");


}
session_unset();
echo "<script type=\"text/javascript\"> alert('You have Cleared Selected employee Successfully!!'); </script>";

?>


</body>
</html>