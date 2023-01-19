<?php require_once('../Connections/HRMS.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "admin,administrator";
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

$MM_restrictGoTo = "../login.php";
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

if ((isset($_GET['ID'])) && ($_GET['ID'] != "")) {
  $deleteSQL = sprintf("DELETE FROM employee_personal_record WHERE Auto_ID=%s",
                       GetSQLValueString($_GET['Auto_ID'], "int"));

  mysql_select_db($database_HRMS, $HRMS);
  $Result1 = mysql_query($deleteSQL, $HRMS) or die(mysql_error());


/*//totaldeduction payroll data delete
  $DeleteSQLTotalDeduction =sprintf("DELETE FROM total_deduction WHERE ID=%s",
                       GetSQLValueString($_GET['ID'], "int"));
					      
  
  $Result2 = mysql_query($DeleteSQLTotalDeduction, $HRMS) or die(mysql_error());
  
  //Deleting each week attendance data according to employee data 
  
		   for ($i=1; $i<=6; $i++)
			{
													   
			$UpdatedTabelName="week_".$i."" ;	   
		   $DeleteAttendanceSQL =sprintf("DELETE FROM ".$UpdatedTabelName." WHERE ID=%s",
                       GetSQLValueString($_GET['ID'], "int"));
					   
												   
		  mysql_select_db($database_HRMS, $HRMS);
		 $ResultAttendance = mysql_query($DeleteAttendanceSQL, $HRMS) or die(mysql_error());
			 }
  */
 echo "<script type=\"text/javascript\">alert('You have deleted the recored successfully.')</script>";
  
  $deleteGoTo = "PersonalRecordDisplay.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  
  header(sprintf("Location: %s", $deleteGoTo));
}
?>
