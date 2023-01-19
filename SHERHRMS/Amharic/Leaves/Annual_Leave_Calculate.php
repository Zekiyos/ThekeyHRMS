<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "administrator";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../../login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php require_once('../../Connections/HRMS.php'); ?>
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
																
								$noyear=round(($row['Workingmonths'])/12);
							    $al=$noyear+$initialALdays;
															
							
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



$sqlINST="INSERT INTO `sherhrmsdb`.`annual_leave_calculate` (`Auto_ID`, `ID`, `FirstName`, `MiddelName`, `LastName`, `WorkingMonth`, `WorkingYear`, `ThisYearALdays`, `LastYearALdays`, `BeforeLastYearALdays`, `TotalALdays`, `Calculated_Date`,ModifiedBy) VALUES (NULL,"."'".$ID."'".","."'".$FirstName."'".","."'".$MiddelName."'".","."'".$LastName."'".",".$Workingmonths.",".$noyear.",". $thisyear.",". $lastyear.",".$beforelastyear. ",".$totalALdays .","."'".$date."','".$_SESSION['MM_Username']."')";


			mysql_query($sqlINST);
			echo "<font color=\"#0000FF\"><b>Calculated Annual Leave</b>:<br/> </font><font color=\"RED\">This year for ".$ID." ".$thisyear."<br/>"." Working Month ".$row['Workingmonths']."<br/>";
			echo "For Last year ".$lastyear."<br/>";
			echo "For Before last year ".$beforelastyear."<br/>";
			echo "Total Annual Leave days would be <font color=\"#0000FF\">".$totalALdays."</font><br/>";
				}
					
					
					?>



</body>
</html>
<?php
mysql_free_result($RSALCalculate);

mysql_free_result($RS4ALCalculate);

mysql_free_result($RSALCalculation);
?>
