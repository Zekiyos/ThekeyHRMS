<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php include('../connections/hrms.php'); ?>
<?php include('Class_Personal_Info.php'); 

$obj_Perosnal_Info=new  Personal_info();
echo $obj_Perosnal_Info->Basic_Info('AQ-00014');
echo $obj_Perosnal_Info->Leaves('AQ-00014');
echo $obj_Perosnal_Info->Equipment('AQ-00082');
echo $obj_Perosnal_Info->Training('AQ-00082');
echo $obj_Perosnal_Info->Disciplinary_Action('AQ-00139');
echo $obj_Perosnal_Info->Job_Description('AQ-00082');
echo $obj_Perosnal_Info->HardCopy_Location('$AQ-00081');

include('../Leaves/Class_Leave.php');
   $initialALdays=14;
		$db='aqhrmsdb';
		$ID='AQ-00014';
		$Leavedays=0;
		
		$sqlDE = "SELECT `ID` , FirstName ,MiddelName , LastName,`Date_Employement`,
		period_diff( date_format( now( ) , '%Y%m' ) ,
		date_format( `Date_Employement` , '%Y%m' ) ) AS Workingmonths FROM 
		$db.employee_personal_record where ID= '".$ID."'";
		
	    $resultDE = mysql_query($sqlDE) or die(mysql_error());
		$rowDE=mysql_fetch_array($resultDE);
		
		$FirstName=$rowDE['FirstName'];
		$MiddelName=$rowDE['MiddelName'];
		$LastName=$rowDE['LastName'];
		
		$dateofemployeement=$rowDE['Date_Employement'];
		
		$WorkingMonth=$rowDE['Workingmonths'];
		
		$noyear=($rowDE['Workingmonths'])/12;
					
    $obj_leave = new Leave();
	
	$totalALdays=$obj_leave->AnnualLeaveCalcualte($initialALdays,$db,$ID,$FirstName);
	$TotalTakenDay=$obj_leave->ALTotalTakenDay($db,$ID,$FirstName,$Leavedays);
	$TotalTakenDay=$TotalTakenDay;//+$Leavedays;
	$TotalLeftDays=$obj_leave->ALTotalLeftDay($totalALdays,$TotalTakenDay);
	echo "<font color=\"#FF6600\"  size=\"+1.5\" face=\"Times New Roman, Times, serif\">This Annual Leave is Calcualted as of Today date ".date("Y-m-d")." for Employee {$FirstName} {$MiddelName} {$LastName}</font><br/>";
	echo "<br>Total Annual Leave:";
echo $obj_leave->ALYearAllocation($totalALdays,$initialALdays,$dateofemployeement)."<br>";	
echo "Total Left Annual Leave:";
echo $obj_leave->ALYearAllocation($TotalLeftDays,$initialALdays,$dateofemployeement)."<br>";

?> 
</body>
</html>