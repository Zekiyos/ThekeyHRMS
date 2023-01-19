<?php 
include('../User_account/Class_AccessLevel.php');
 $obj_AccessLevel = new AccessLevel();
echo $obj_AccessLevel->CHK_AccessLevel(); 
?>
<?php require_once('../Connections/HRMS.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_HRMS, $HRMS);
$query_RSALCalculate = "SELECT * FROM annual_leave_detail";
$RSALCalculate = mysql_query($query_RSALCalculate, $HRMS) or die(mysql_error());
$row_RSALCalculate = mysql_fetch_assoc($RSALCalculate);
$totalRows_RSALCalculate = mysql_num_rows($RSALCalculate);

mysql_select_db($database_HRMS, $HRMS);
$query_RS4ALCalculate = "SELECT * FROM employee_personal_record";
$RS4ALCalculate = mysql_query($query_RS4ALCalculate, $HRMS) or die(mysql_error());
$row_RS4ALCalculate = mysql_fetch_assoc($RS4ALCalculate);
$totalRows_RS4ALCalculate = mysql_num_rows($RS4ALCalculate);

mysql_select_db($database_HRMS, $HRMS);
$query_RSALCalculation = "SELECT * FROM annual_leave_calculate";
$RSALCalculation = mysql_query($query_RSALCalculation, $HRMS) or die(mysql_error());
$row_RSALCalculation = mysql_fetch_assoc($RSALCalculation);
$totalRows_RSALCalculation = mysql_num_rows($RSALCalculation);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?php 
				
				// DATEDIFF('ReportOn','$d')
                // $d=date("Y-m-d");
       			 					
					$emptyALDetialData="TRUNCATE TABLE `annual_leave_calculate`" ;
					mysql_query($emptyALDetialData);
										$sqlWM = "SELECT `ID` , FirstName , MiddelName , LastName , period_diff( date_format( now( ) , '%Y%m' ) , date_format( `Date_Employement` , '%Y%m' ) ) AS Workingmonths FROM employee_personal_record ";
						
						$resultWM = mysql_query($sqlWM);
														
				while($row = mysql_fetch_array($resultWM, MYSQL_ASSOC))
				{
														
								$initialALdays=15;
																
								
								
								$noyear=($row['Workingmonths'])/12;
								//$al=round(($initialALdays)*($row['Workingmonths'])/12);
							    $al=$noyear+$initialALdays-1;
								
								
															
							
							if ($noyear < 1.5)
							{		
							$thisyear=$al;
							$lastyear=0;
							$beforelastyear=0;
							}
							
							if(($noyear >= 1.5) and( $noyear <= 2.5))
							{															
							$thisyear=$al;
							$lastyear=$al-1;
							$beforelastyear=0;
							}
														
							if ($noyear > 2.5) 
							 {							    															
							$thisyear=$al;
							$lastyear=$al-1;
							$beforelastyear=$al-2;								
							}
							
			$totalALdays=$thisyear+	$lastyear+$beforelastyear;
						

			$ID=$row['ID'];
			$FirstName=$row['FirstName'];
			$MiddelName=$row['MiddelName'];
			$LastName=$row['LastName'];
			$Workingmonths=$row['Workingmonths'];

			$date=date("Y-m-d");



$sqlINST="INSERT INTO `aqhrmsdb`.`annual_leave_calculate` (`Auto_ID`, `ID`, `FirstName`, `MiddelName`, `LastName`, `WorkingMonth`, `WorkingYear`, `ThisYearALdays`, `LastYearALdays`, `BeforeLastYearALdays`, `TotalALdays`, `Calculated_Date`,ModifiedBy) VALUES (NULL,"."'".$ID."'".","."'".$FirstName."'".","."'".$MiddelName."'".","."'".$LastName."'".",".$Workingmonths.",".$noyear.",". $thisyear.",". $lastyear.",".$beforelastyear. ",".$totalALdays .","."'".$date."','".$_SESSION['MM_Username']."')";


			mysql_query($sqlINST);
			echo "<font color=\"#0000FF\"><b>Calculated Annual Leave</b>:<br/> </font><font color=\"RED\">This year for ".$ID." ".$thisyear."<br></br>"." Working Month ".$row['Workingmonths']."<br/>";
			echo "For Last year ".$lastyear."<br></br>";
			echo "For Before last year ".$beforelastyear."<br></br><p>";
			
			echo "Total Annual Leave days would be <font color=\"#0000FF\">".$totalALdays."</font><br></br></p>";
				}
					
					
					?>



</body>
</html>
<?php
mysql_free_result($RSALCalculate);

mysql_free_result($RS4ALCalculate);

mysql_free_result($RSALCalculation);
?>
