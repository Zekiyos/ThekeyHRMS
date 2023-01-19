<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<link href="ProgressBar.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php require_once('../Connections/HRMS.php'); ?>
<?php

include('Class_progressBar.php'); 
$obj_prg_bar=new  Progress_Bar();

include('Class_Salary_Increment.php'); 
$obj_Salary_Increment=new  Salary_Increment();
session_start();
$obj_prg_bar->progressbar('Salary Increment Update is Running',250000,'Salary Increment Has Been Done.');

//if(isset($_POST['IDNo']))

//echo $_SESSION['IDNo'];
$IDNo=$_SESSION['IDNo'];

 $arrIDNo = Explode(",", $IDNo); 
 foreach($arrIDNo as $value)
        {
			//echo "<br/>".$value."<br/>";
		
$obj_Salary_Increment->Update_Salary($value);
}
echo "<script type=\"text/javascript\"> alert('You have Granted Access Successfully!!'); </script>";

?>
</body>
</html>