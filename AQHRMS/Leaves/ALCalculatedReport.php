<?php require_once('../Connections/HRMS.php'); ?>
<?php include('Class_Leave.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script language=javascript>
<!--
function popup(N) {
newWindow = window.open(N, 'popD','toolbar=no,menubar=no,resizable=no,scrollbars=no,status=no,location=no,width=550,height=215');
}
//-->onload="javascript:popup('ALCalculatedReport.php')"
</script>
</head>

<body >
<?php
if(isset($_POST['ID'])){
	 
$initialALdays=14;
		$db='aqhrmsdb';
		$ID=$_POST['ID'];
		$FirstName=$_POST['FirstName'];
		$sqlDE = "SELECT `ID` , FirstName ,MiddelName , LastName,`Date_Employement`,
		period_diff( date_format( now( ) , '%Y%m' ) ,
		date_format( `Date_Employement` , '%Y%m' ) ) AS Workingmonths FROM 
		$db.employee_personal_record where ID= '".$ID."' and FirstName='".$FirstName."'";
	     $resultDE = mysql_query($sqlDE) or die(mysql_error());
		$rowDE=mysql_fetch_array($resultDE);
		
		$dateofemployeement=$rowDE['Date_Employement'];
		
		$WorkingMonth=$rowDE['Workingmonths'];
		
		$noyear=($rowDE['Workingmonths'])/12;
					
    $obj_leave = new leave();
	$totalALdays=$obj_leave->AnnualLeaveCalcualte($initialALdays,$db,$_POST['ID'],$_POST['FirstName']);
	$TotalTakenDay=$obj_leave->ALTotalTakenDay($db,$_POST['ID'],$_POST['FirstName'],$_POST['Leavedays']);
	$TotalTakenDay=$TotalTakenDay;//+$_POST['Leavedays'];
	$TotalLeftDays=$obj_leave->ALTotalLeftDay($totalALdays,$TotalTakenDay);
	echo "<font color=\"#FF6600\"  size=\"+1.5\" face=\"Times New Roman, Times, serif\">This Annual Leave is Calcualted as of Today date ".date("Y-m-d")." for Employee {$_POST['FirstName']} {$_POST['MiddelName']} {$_POST['LastName']}</font><br/>";
	echo "<br>Total Annual Leave:";
echo $obj_leave->ALYearAllocation($totalALdays,$initialALdays,$dateofemployeement)."<br>";	
echo "Total Left Annual Leave:";
echo $obj_leave->ALYearAllocation($TotalLeftDays,$initialALdays,$dateofemployeement)."<br>";

}
	?>
    <img src="/AQHRMS/img logo & icons/thekey soft.jpg" width="161" height="31" />
</body>
</html>