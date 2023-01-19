<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "administrator,admin";
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
<script type="text/javascript">
function PrintContent()
    {
		
        var DocumentContainer = document.getElementById('AL Detail');
        var WindowObject = window.open('', "TrackHistoryData", 
                              "width=740,height=325,top=200,left=250,toolbars=no,scrollbars=yes,status=no,resizable=no");
        WindowObject.document.writeln(DocumentContainer.innerHTML);
        WindowObject.document.close();
        WindowObject.focus();
        WindowObject.print();
        WindowObject.close();
    }
</script>



</head>

<body>

<?php 

						function ALCalculation()
						{
						
						
						
										$sqlWM = "SELECT `ID` , FirstName , 
										MiddelName , LastName,`Date_Employement` ,
										period_diff( date_format( now( ) , '%Y%m' ) ,
										date_format( `Date_Employement` , '%Y%m' ) ) AS Workingmonths FROM employee_personal_record where ID= 'SH-0713' and FirstName='Tigistu'";
						
						$resultWM = mysql_query($sqlWM);
														
				while($row = mysql_fetch_array($resultWM, MYSQL_ASSOC))
				{
									
								$initialALdays=14;
																							
								$noyear=($row['Workingmonths'])/12;
																
								$TotalAL=round(($initialALdays)*($row['Workingmonths'])/12);
							    //$al=$noyear+$initialALdays-1;
								
								if ($noyear < 1.5)
							{		
							$thisyear=$TotalAL;
							$lastyear=0;
							$beforelastyear=0;
							}
							
							if(($noyear >= 1.5) and( $noyear <= 2.5))
							{															
							$thisyear=($TotalAL/2);
							$lastyear=($TotalAL/2)-1;
							$beforelastyear=0;
							}
														
							if ($noyear > 2.5) 
							 {							    															
							$thisyear=($TotalAL/3);
							$lastyear=($TotalAL/3)-1;
							$beforelastyear=($TotalAL/3)-2;								
							}
								
																						
					$totalALdays=$TotalAL;			
									
					//$totalALdays=$thisyear+$lastyear+$beforelastyear;
						
					$ID=$row['ID'];
					$FirstName=$row['FirstName'];
					$MiddelName=$row['MiddelName'];
					$LastName=$row['LastName'];
					$Workingmonths=$row['Workingmonths'];
					$TakenDay=2;
					$date=date("Y-m-d");
					
						if(mysql_num_rows(mysql_query("SELECT * FROM `annual_leave_calculate2` WHERE ID='SH-0713'"))){
						
						$query3  = "SELECT * FROM `annual_leave_calculate2` WHERE ID='SH-0713'";
						$result3 = mysql_query($query3);
				while($row3 = mysql_fetch_array($result3, MYSQL_ASSOC))
				{
					
				$TotalTakenDay = $row3['TotalTakenDay'];
					
				$TotalTakenDay= $TotalTakenDay + $TakenDay;
				}
				
				}						
					else{
						$TotalTakenDay=0;
					$TotalTakenDay= $TotalTakenDay + $TakenDay;
					}
					$Total_Left_Days = $totalALdays - $TotalTakenDay;	
					
						if( $Total_Left_Days > 0)
						{
							
				//$insertSQL = sprintf("INSERT INTO annual_leave (ID, FirstName, MiddelName, LastName, Leavedays,Restday,Leave_taken_Date,ReportOn,ModifiedBy) VALUES (%s, %s, %s, %s, %s,%s,%s, %s, %s)",
//                       GetSQLValueString($_GET['ID'], "text"),
//                       GetSQLValueString($_POST['FirstName'], "text"),
//                       GetSQLValueString($_POST['MiddelName'], "text"),
//                       GetSQLValueString($_POST['LastName'], "text"),
//                       GetSQLValueString($_POST['Leavedays'], "int"),
//					   GetSQLValueString($_POST['Restday'], "int"),
//					   GetSQLValueString($_POST['Leave_Taken_Date'], "date"),
//                       GetSQLValueString($_POST['ReportOn'], "date"),
//					   GetSQLValueString( $_SESSION['MM_Username'] , "text"));
//
//  mysql_select_db($database_HRMS, $HRMS);
//  $Result1 = mysql_query($insertSQL, $HRMS) or die(mysql_error());
							
							
								
					echo "<input type=button value=\"Print Out\" onclick=\"PrintContent()\" align=\"right\" >";
					echo"<DIV id=\"AL Detail\"><br><br/>";
				    echo " <b><font color=\"Blue\">Calculated Annual Leaves Detail</b> </font><br>";               
					echo "Date of Employeement-----:".$row['Date_Employement']."<br>";
					echo "Working Month------------:".$Workingmonths."<br>";
					echo "For This Year-------------:$thisyear<br/>";
					echo "Last Year-----------------:$lastyear <br/>";
					echo "Before Last Year----------:$beforelastyear<br/>";
					echo "Total Annual Leavedays---:<font color=\"RED\"><b>$totalALdays </b></font><br/>";
					echo "-----------------------------------------<br/>";
					
					
					echo "Total Leave Taken Days---:<font color=\"RED\"><b>".$TotalTakenDay ."</b></font><br/>";
					echo "-----------------------------------------<br/>";
					
								
										
					/*Left annaul leve Asigning for for each Year starting code*/
					
					   if ($noyear < 1.5)
							{		
							$thisyearLeft=$Total_Left_Days;
							$lastyearLeft=0;
							$beforelastyearLeft=0;
							}
							
							if(($noyear >= 1.5) and( $noyear <= 2.5))
							{															
							$thisyearLeft=($Total_Left_Days/2);
							$lastyearLeft=($Total_Left_Days/2)-1;
							$beforelastyearLeft=0;
							}
														
							if ($noyear > 2.5) 
							 {							    															
							$thisyearLeft=($Total_Left_Days/3);
							$lastyearLeft=($Total_Left_Days/3)-1;
							$beforelastyearLeft=($Total_Left_Days/3)-2;								
							}
										
					        echo "<br/><b><font color=\"RED\">Annual Leave Left  Deatil</font></b> <br/>";
					        echo "This Year-----------:".$thisyearLeft."<br/>";
						    echo "Last Year-----------:".$lastyearLeft."<br/>";
							echo "Before Last Year----:".$beforelastyearLeft."<br/>";
					        echo "-----------------------------------------<br/>";
					 
   					        echo "Total Left Days:<font color=\"RED\"> <b>".$Total_Left_Days."</font><b><br/></DIV>";
							
							
							if(mysql_num_rows(mysql_query("SELECT * FROM `annual_leave_calculate2` WHERE ID='SH-0713'"))){
							$sqlupdate= "UPDATE `annual_leave_calculate2` SET 
							
										`WorkingMonth`=".$Workingmonths.",
										`WorkingYear`=".$noyear.",
										`ThisYearALdays`=".$thisyear.",
										`LastYearALdays`=".$lastyear.",
										`BeforeLastYearALdays`=".$beforelastyear.",
										`TotalALdays`=".$totalALdays.",
										`TotalTakenDay`=".$TakenDay.", 
										`Calculated_Date`='".$date."',
										ModifiedBy='".$_SESSION['MM_Username']."',
										`TotalTakenDay`=".$TotalTakenDay.",
										`TotalLeftDay`=".$Total_Left_Days.",
										`BeforeLastYearLeft`=".$beforelastyearLeft.",
										`LastYearLeft`=".$lastyearLeft.",
										`ThisYearLeft`=".$thisyearLeft.
										" WHERE ID='SH-0713'";
													
					    mysql_query($sqlupdate);
						
						
							}
					
				 else
				
		                {
																								
								$sqlINST="INSERT INTO `sherhrmsdb`.`annual_leave_calculate2` 
								(`Auto_ID`, `ID`, `FirstName`, `MiddelName`, `LastName`, `WorkingMonth`,	`WorkingYear`, `ThisYearALdays`, `LastYearALdays`, `BeforeLastYearALdays`,	`TotalALdays`,							`TotalTakenDay`,`Calculated_Date`,`ModifiedBy`,`TotalLeftDay`,`BeforeLastYearLeft`,`LastYearLeft`,`ThisYearLeft`) VALUES (NULL,"."'".$ID."'".","."'".$FirstName."'".","."'".$MiddelName."'".","."'".$LastName."'".",".$Workingmonths.",".$noyear.",". $thisyear.",". $lastyear.",".$beforelastyear. ",".$totalALdays .",".$TakenDay.","."'".$date."','".$_SESSION['MM_Username']."',".$Total_Left_Days.",".$beforelastyearLeft.",".$lastyearLeft.",".$thisyearLeft.")";			
					
						mysql_query($sqlINST);
						
			               }
						
						}
						else
						echo "<script type=\"text/javascript\"> alert('The requested annual leave days are MORE THAN current total Left annual leave status of the selected employee!!                                                    Please try to decrease granted leave days.'); </script>";
						 	 	
						
				    }
				
						
          }
		  
									?>
<input value="AL" type="submit" ondblclick="<?php  echo ALCalculation();?>" />
</body>
</html>
<?php
mysql_free_result($RSALCalculate);

mysql_free_result($RS4ALCalculate);

mysql_free_result($RSALCalculation);
?>
