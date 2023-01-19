<script type="text/javascript">
function PrintContent()
    {
		
        var DocumentContainer = document.getElementById('AL_Application_Form');
        var WindowObject = window.open('', "TrackHistoryData", 
                              "width=740,height=325,top=200,left=250,toolbars=no,scrollbars=yes,status=no,resizable=no");
        WindowObject.document.writeln(DocumentContainer.innerHTML);
        WindowObject.document.close();
        WindowObject.focus();
        WindowObject.print();
        WindowObject.close();
    }
</script>
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
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "../login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	
						
		if (($_POST['Leavedays'] < 0) OR ($_POST['Leave_Taken_Date'] > $_POST['ReportOn']))
	{
	echo"<script type=\"text/javascript\"> alert('The Date value for Reported On is lessthan the date value of Leave Grant Day.'); </script>";
	}
	else
	{				
						
										$sqlWM = "SELECT `ID` , FirstName , 
										MiddelName , LastName,`Date_Employement` ,
										period_diff( date_format( now( ) , '%Y%m' ) ,
										date_format( `Date_Employement` , '%Y%m' ) ) AS Workingmonths FROM sherhrmsdb.employee_personal_record where ID= '".$_GET['ID']."' and FirstName='".$_POST['FirstName']."'";
						
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
					$TakenDay=$_POST['Leavedays'];
					$date=date("Y-m-d");
					
						//Checking the employee is in the list of calculated Annual Leave or Not
						if(mysql_num_rows(mysql_query("SELECT * FROM sherhrmsdb.`annual_leave_calculate` WHERE ID='".$_GET['ID']."' and FirstName='".$_POST['FirstName']."'"))){
						
				$query3  = "SELECT * FROM sherhrmsdb.`annual_leave_calculate` WHERE ID='".$_GET['ID']."' and FirstName='".$_POST['FirstName']."'";
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
					
						if( $Total_Left_Days > 0) //comparing the requseted leave with current left status
						{
						
						//inserting to annaul leve table for payroll processing	
				$insertSQL = sprintf("INSERT INTO sherhrmsdb.annual_leave (ID, FirstName, MiddelName, LastName, Leavedays,Department,Restday,Leave_taken_Date,ReportOn,ModifiedBy) VALUES (%s, %s, %s, %s, %s,%s,%s,%s, %s, %s)",
                       GetSQLValueString($_GET['ID'], "text"),
                       GetSQLValueString($_POST['FirstName'], "text"),
                       GetSQLValueString($_POST['MiddelName'], "text"),
                       GetSQLValueString($_POST['LastName'], "text"),
					   GetSQLValueString($_POST['Department'], "text"),
                       GetSQLValueString($_POST['Leavedays'], "int"),
					   GetSQLValueString($_POST['Restday'], "int"),
					   GetSQLValueString($_POST['Leave_Taken_Date'], "date"),
                       GetSQLValueString($_POST['ReportOn'], "date"),
					   GetSQLValueString( $_SESSION['MM_Username'] , "text"));

  mysql_select_db($database_HRMS, $HRMS);
  $Result1 = mysql_query($insertSQL, $HRMS) or die(mysql_error());
							
						
				//////////////////////////////////////////////////		
						
						
						
				 function datediff($interval, $datefrom, $dateto, $using_timestamps = false) { 
/* $interval can be: yyyy - Number of full years 
q - Number of full quarters 
m - Number of full months 
y - Difference between day numbers (eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".) 
d - Number of full days 
w - Number of full weekdays 
ww - Number of full weeks 
h - Number of full hours 
n - Number of full minutes 
s - Number of full seconds (default) */
 if (!$using_timestamps) { 
 $datefrom = strtotime($datefrom, 0);
 $dateto = strtotime($dateto, 0); 
 } $difference = $dateto - $datefrom;
 // Difference in seconds
 switch($interval)
 { case 'yyyy': 
 // Number of full years 
 $years_difference = floor($difference / 31536000);
 if (mktime(date("H", $datefrom), 
 date("i", $datefrom), date("s", 
 $datefrom), date("n", $datefrom),
 date("j", $datefrom), date("Y",
 $datefrom)+$years_difference) > $dateto) { 
 $years_difference--;
 } if (mktime(date("H", $dateto),
 date("i", $dateto), date("s", $dateto), 
 date("n", $dateto), date("j", $dateto),
 date("Y", $dateto)-($years_difference+1)) > $datefrom) 
 { $years_difference++; 
 } $datediff = $years_difference; break;
 case "q": // Number of full quarters 
 $quarters_difference = floor($difference / 8035200);
 while (mktime(date("H", $datefrom), date("i", $datefrom),
 date("s", $datefrom), date("n", $datefrom)+($quarters_difference*3),
 date("j", $dateto), date("Y", $datefrom)) < $dateto) { 
 $months_difference++;
 } $quarters_difference--;
 $datediff = $quarters_difference; 
 break; case "m": // Number of full months 
 $months_difference = floor($difference / 2678400);
 while (mktime(date("H", $datefrom), date("i", $datefrom), 
 date("s", $datefrom), date("n", $datefrom)+($months_difference),
 date("j", $dateto), date("Y", $datefrom)) < $dateto) { 
 $months_difference++; } $months_difference--;
 $datediff = $months_difference; break; 
 case 'y': // Difference between day numbers 
 $datediff = date("z", $dateto) - date("z", $datefrom);
 break;
 case "d": // Number of full days 
 $datediff = floor($difference / 86400); 
 break;
 case "w": // Number of full weekdays 
 $days_difference = floor($difference / 86400);
 $weeks_difference = floor($days_difference / 7);  // Complete weeks 
 $first_day = date("w", $datefrom); 
 $days_remainder = floor($days_difference % 7); 
 $odd_days = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder? 
 if ($odd_days > 7) {  // Sunday 
 $days_remainder--;
 } if ($odd_days > 6) { 
 // Saturday
 $days_remainder--; 
 } $datediff = ($weeks_difference * 5) + $days_remainder;
 break; case "ww": // Number of full weeks 
 $datediff = floor($difference / 604800);
 break; 
 case "h": // Number of full hours 
 $datediff = floor($difference / 3600); 
 break; case "n": // Number of full minutes 
 $datediff = floor($difference / 60); 
 break; 
 default: // Number of full seconds  (default) 
 $datediff = $difference; 
 break;
 } return $datediff; } 			
						
						
						
	//function dateDiff($dformat, $endDate, $beginDate)
//{
//$date_parts1=explode($dformat, $beginDate);
//$date_parts2=explode($dformat, $endDate);
//$start_date=gregoriantojd($date_parts1[2], $date_parts1[1],$date_parts1[0] );
//$end_date=gregoriantojd($date_parts2[2], $date_parts2[1], $date_parts2[0]);
//$diff = $end_date - $start_date;
//return $diff;
//}
//
//function yearDiff($dformat, $endDate, $beginDate)
//{
//$date_parts1=explode($dformat, $beginDate);
//$date_parts2=explode($dformat, $endDate);
//$start_date=gregoriantojd( $date_parts1[2]);
//$end_date=gregoriantojd( $date_parts2[2]);
//$diff = $end_date - $start_date;
//return $diff;
//}
					
						
					//	$row['Date_Employement']
						//$initialALdays
						//$Total_Left_Days
					//	$TotalTakenDay
						
		//////			    $date1="2004-04-01";
//////    $date2="2004-04-09";
//////    $de=$row['Date_Employement'];
//////	$now=date('Y-m-d');
//////    print "If we minus " . $date1 . " from " . $date2 . " we get " . dateDiff("-", $date2, $date1) . 
//////	".";
//////	print "If we minus " . $de . " from " . $now . " we get -" . dateDiff("-", $now,$de ) . 
//////	".";
//////	list($DEyear,$DEmonth,$DEday,$DEhour,$DEminute,$DEsecond)=explode('-',date('Y-m-d-h-i-s',strtotime($de)));
//////
//////	echo $DEyear;
//////	
//////	$datediff1= dateDiff("-", $now,$de);
//////	$y=$datediff1/365;
//////	echo "Date Difference :" .$datediff1."  ::".$y;

		$de=$row['Date_Employement'];
		$current=date('Y-m-d');
		list($DEyear,$DEmonth,$DEday,$DEhour,$DEminute,$DEsecond)=explode('-',date('Y-m-d-h-i-s',strtotime($de)));
		list($currentyear,$currentmonth,$currentday,$currenthour,$currentminute,$currentsecond)=explode('-',date('Y-m-d-h-i-s',strtotime($current)));
				//echo "Day:de".$de." and day now".$now."is ==".datediff('m', $de,$now , false);	
					
				$yeardiff=datediff('yyyy', $de,$current, false);
				$monthdiff=datediff('m', $de,$current , false);
				$datediff1=datediff('d', $de,$current , false);
				
						//echo "Day:de".$de." and day now".$current."</br>{$yeardiff} difference year";	
//						echo "Year diff".$yeardiff."</br>";
//				        echo " Month diff ".$monthdiff."</br>";
//				        echo " Date diff ". $datediff1."</br>";
				 
											
				echo "<font color=\"#0000FF\" face=\"Times New Roman, Times, serif\" size=\"+1\">TOTAL Calculated: <font color=\"#FF0000\">".$totalALdays."</font></br>";
				$TAL=$monthdiff*(14/12);
				//echo "PHP Total Calculated: ".$TAL."</br>";
				echo "Total Taken Day:<font color=\"#FF0000\">".$TotalTakenDay."</font></br>";
				echo "Total Left Day:<font color=\"#FF0000\">".$Total_Left_Days."</font></br>";
						if($yeardiff == 0)
						{
						echo "YEAR ".$DEyear." :<font color=\"#FF0000\">".$totalALdays."</font>"."</font></br>";
										
				      					   
						}
					     else 
					if($yeardiff == 1)
						{
								
						$currentyeardate=$currentyear."-01-01";
						
						$monthdiff0=$currentmonth;
			  
						$alday=($monthdiff0*($initialALdays/12));
						
						echo "<br/> YEAR ".$DEyear." <font color=\"#FF0000\">".$alday."</font><br/>";
						$totalleft=$totalALdays - $alday;
						$nextyear=$DEyear+1;
					echo "<br/> YEAR ".$nextyear."<font color=\"#FF0000\">".$totalleft."</font></font><br/>";
												
						}
						else
						
						if($yeardiff > 1)
						{
						$afteroneyear=$DEyear+1;
						$afteroneyeardate=$afteroneyear."-01-01";
						
              $monthdiff1=datediff('m', $de,$afteroneyeardate , false);
			  
						$alday1=($monthdiff1*($initialALdays/12));
												
						echo "YEAR ".$DEyear." <font color=\"#FF0000\">".$alday1."</font></br>";
						
						
						/*$alleft1=$alday1-$TotalTakenDay;
						
						 if($alleft1>=0)
						 {
						 echo "Left on ".$DEyear."YEAR"." ".$alleft1."</br>";
						 $alleft1=0;
						 }
		                 else
						 {
						 echo "Left on ".$DEyear."YEAR 0(Zero) "."</br>";
						 $alleft=-1*$alleft1;
						 }*/
						 
						for($i=1; $i<= $yeardiff; $i++)
						{
							 
							 
							if(  $alday1 < 7.5)
							{
						    $afteroneyear= $DEyear + $i ;
							$alday3=$initialALdays+$i-1;
								
																				
						   }
							else
							{
							$afteroneyear= $DEyear + $i;
							$alday3=$initialALdays+$i;
							
												
							}
						 
			echo " YEAR ".$afteroneyear." <font color=\"#FF0000\">".$alday3."</font>"."</br>";
			
			
			      
			      /*   $alleft2=$alday3 - $alleft;
						
						 if($alleft2 >=0)
						 {
						 echo "Left on ".$afteroneyear."YEAR".$alleft2." "."</br>";
						 break;
						 }
		                 else
						 {
						 echo "Left on ".$afteroneyear."YEAR 0(Zero) "."</br>";
						 $alleft=-1*$alleft2;
						 }*/
						 
						 
						}
						
															
						$currentyeardate=$currentyear."-01-01";
						
						$monthdiff3=$currentmonth;
						
			 // echo " Month Diff".$monthdiff3."</br> ";
			 $initialALdays=$alday3+1;
			
						$alday4=($monthdiff3*($initialALdays/12));
				echo "YEAR ".$currentyear." <font color=\"#FF0000\">".$alday4."</font>"."</font></br>";
						
						}	
						
						
						
				
						
						
		//////////////////////////////////////////				
						
					//calculation result			
					//echo "<input type=button value=\"Print Out\" onclick=\"PrintContent()\" align=\"right\" >";
//					echo "<DIV id=\"AL Detail\"><br><br/>";
//					
//				    echo " <b><font color=\"Blue\">Calculated Annual Leaves Detail</b></font><br>";               
//					echo "Name---------------------:".$_POST['FirstName']." ".$_POST['MiddelName']." ".$_POST['LastName']."<br>";
//					echo "Date of Employeement-----:".$row['Date_Employement']."<br>";
//					echo "Working Month------------:".$Workingmonths."<br>";
//					echo "For This Year-------------:$thisyear<br/>";
//					echo "Last Year-----------------:$lastyear <br/>";
//					echo "Before Last Year----------:$beforelastyear<br/>";
//					echo "Total Annual Leavedays---:<font color=\"RED\"><b>$totalALdays </b></font><br/>";
//					echo "-----------------------------------------<br/>";
//					
//					
//					echo "Total Leave Taken Days---:<font color=\"RED\"><b>".$TotalTakenDay ."</b></font><br/>";
//					echo "-----------------------------------------<br/>";
//					
								
										
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
							
							
					////			
////					        echo "<br/><b><font color=\"RED\">Annual Leave Left  Deatil</font></b> <br/>";
////					        echo "This Year-----------:".$thisyearLeft."<br/>";
////						    echo "Last Year-----------:".$lastyearLeft."<br/>";
////							echo "Before Last Year----:".$beforelastyearLeft."<br/>";
////					        echo "-----------------------------------------<br/>";
////					 
////   					        echo "Total Left Days:<font color=\"RED\"> <b>".$Total_Left_Days."</font><b><br/></DIV>";
////



						
echo "<input type=button value=\"Print Out\" onclick=\"PrintContent()\" align=\"right\" >";	
							?>
                    <div align="center" id="AL_Application_Form" >
<img  src="Annual Leave Application format/Sherlogo.JPG"s width="800" height="50" />
<strong>
<strong>
<p align="center"><strong>ሼር ኢትዮጵያ  ኃ.የተ.የግ.ኩባንያ</strong>
  <strong>Sher Ethiopia P.L.C</strong><br />
  <strong>የፍቃድ መጠየቂያ ፎርም</strong><br />
  <strong><u>LEAVE APPLICATION FORM</u></strong><br />
  <strong>ክፍል 1</strong><br />
  PART 1<br />
  የአመልካች ስም                                                  የፔይሮል  ቁ <br />
  NAME OF Applicant (MR/MRS/MS)<u><font color= "color=&quot;#FF0000&quot;"><?php 
  if( isset($_GET['ID'])){
	  echo " {$_POST['FirstName']}  {$_POST['MiddelName']}  {$_POST['LastName']}" ;
	  
	  }
	  ?>                           </font> </u>ID NO<u> <font color= "color=&quot;#FF0000&quot;"><?php 
  if( isset($_GET['ID'])){
	  echo " {$_GET['ID']} " ;
	  
	  }
	  ?></u> </font><br />
  ክፍል                                   ኃላፊነት<br />
  DEPARTMENT<u><font color= "color=&quot;#FF0000&quot;"><?php
            if( isset($_GET['ID'])){
       			 		$query  = "SELECT * FROM employee_personal_record";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
				
					if ($row['ID'] == $_GET['ID'])
					{
						
					echo " <u>{$row['Department']}</u> ";
					
					$position =$row['Department'];
					}
				}
				}
				
				 ?></font></u>Position<u><?php if( isset($_GET['ID'])){echo " <u>{$position}</u> ";}?>
					 </u><br /><br />
  የተጠየቀው ቀን ብዛት<br />
  1. I wish to apply for<u><font color= "color=&quot;#FF0000&quot;"><?php 
  if( isset($_GET['ID'])){
	  echo " {$_POST['Leavedays']} " ;
	  	  }
	  ?> </font>leave days</u> from<u>         </u>Crop year, starting from<u><font color= "color=&quot;#FF0000&quot;"><?php 
  if( isset($_GET['ID'])){
	  echo  $_POST['Leave_Taken_Date'] ;
	  	  }
	  ?>        </u></font><br /><br />
  የፍቃድ ጊዜ አድራሻ የመኖሪያ አድራሻ ክ/ከተማ           ቀበሌ<br />
  My contact during  leave:-Residential Address kifle ketema<u>   </u>kebele<u>          </u></p>
  
<p>   ስልክ<br />
  Tel.<u>                                             </u><br />
  ፊርማ                     ቀን<br />
  Signature<u>                        </u>Date<u>                    </u><br />
  ………………………………………………………………………………………………………………………………………………………….</p>
<p>ክፍል 2<br />
  Part 2             (<u>FOR OFFICIAL USE ONLY)</u><br />
  የኃላፊ አስተያየት</p>
<ol>
  <li>Authorized Statement<u>                                                                                                           </u></li>
</ol>
<p>ሥም                    ፊርማ                        ቀን<br />
  NAME<u>                </u>Signature<u>                     </u>Date<u>              </u><br />
  (General Manager/Dep't  Head/Supervisor)</p>
<p>ክፍል3<br />
  Part3<br />
  አመልካቹ                         የዕረፍት ቀን<br />
  The applicant is granted<u> <font color= "color=&quot;#FF0000&quot;"> <?php 
  if( isset($_GET['ID'])){
	  echo " {$_POST['Leavedays']} " ;
	  	  }
	  ?> </u></font>leave day's plus<u></font>rest day's we've<u>  <font color= "color=&quot;#FF0000&quot;"><?php 
  if( isset($_GET['ID'])){
	  echo " {$_POST['Restday']} " ;
	  	  }
	  ?></font></u>   </u>and</p>
<p>የሚመለስበት ቀን           የሚቀረው ቀን<br />
  Should report on <u><font color= "color=&quot;#FF0000&quot;"><?php 
  if( isset($_GET['ID'])){
	  echo "  {$_POST['ReportOn']}  " ;
	  	  }
	  ?></u></u></font>the balance of leave days carried  forward will be<u>           </u><br /><font color= "color=&quot;#FF0000&quot;"><?php 
  if( isset($_GET['ID'])){
	  echo " Total(ጠቅላላ):{$Total_Left_Days} </br>";
	 // echo " From This Year(ከአሁኑ ዓመት):{$thisyearLeft}  ";
	//  echo " From Last Year(ከአለፈው ዓመት ):{$lastyearLeft}  ";
	 // echo " From Before Last Year(ከአለፈው ዓመት በፊት):{$beforelastyearLeft}</br>";
	  	  }
	  ?></font></u>
  ከ                                      <br />
  As at<u>             </u>                      <br />
  ፊርማ                           ቀን<br />
  Signature<u>                        </u>Date<u>                                </u> <br />
  (General Manager/Human  Resources Manage)<br />
   ስርጭት     ዋና      ለአመልካቹ<br />
  Distribution:  Original-Applicant<br />
  ኮፒ  ለግል ማህደር<br />
  Duplicate-Personal File<br />
  </strong>
 </font>
</div>
                        <?php
							if(mysql_num_rows(mysql_query("SELECT * FROM sherhrmsdb.`annual_leave_calculate` WHERE ID='".$_GET['ID']."'"))){
							
							//updating current status
							$sqlupdate= "UPDATE `annual_leave_calculate` SET 
							
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
										" WHERE  ID='".$_GET['ID']."' and
										FirstName='".$_POST['FirstName']."'";
													
					    mysql_query($sqlupdate);
						
						
							}
					
				 else
				
		                {
									//inserting calculated result with current status for fresh annnual employee															
								$sqlINST="INSERT INTO `sherhrmsdb`.`annual_leave_calculate` 
								(`Auto_ID`, `ID`, `FirstName`, `MiddelName`, `LastName`, `WorkingMonth`,	`WorkingYear`, `ThisYearALdays`, `LastYearALdays`, `BeforeLastYearALdays`,	`TotalALdays`,							`TotalTakenDay`,`Calculated_Date`,`ModifiedBy`,`TotalLeftDay`,`BeforeLastYearLeft`,`LastYearLeft`,`ThisYearLeft`) VALUES (NULL,"."'".$ID."'".","."'".$FirstName."'".","."'".$MiddelName."'".","."'".$LastName."'".",".$Workingmonths.",".$noyear.",". $thisyear.",". $lastyear.",".$beforelastyear. ",".$totalALdays .",".$TakenDay.","."'".$date."','".$_SESSION['MM_Username']."',".$Total_Left_Days.",".$beforelastyearLeft.",".$lastyearLeft.",".$thisyearLeft.")";			
					
						mysql_query($sqlINST);
						
			               }
						
						}
						else
						echo "<script type=\"text/javascript\"> alert('The requested annual leave days are MORE THAN current total Left annual leave status of the selected employee!!                                                    Please try to decrease granted leave days.'); </script>";
						 	 	
						
				    }
					
	}
										
					
          
}

mysql_select_db($database_HRMS, $HRMS);
$query_RSAnnualLeave = "SELECT * FROM annual_leave";
$RSAnnualLeave = mysql_query($query_RSAnnualLeave, $HRMS) or die(mysql_error());
$row_RSAnnualLeave = mysql_fetch_assoc($RSAnnualLeave);
$totalRows_RSAnnualLeave = mysql_num_rows($RSAnnualLeave);

mysql_select_db($database_HRMS, $HRMS);
$query_RSID4AnnualLeave = "SELECT * FROM employee_personal_record";
$RSID4AnnualLeave = mysql_query($query_RSID4AnnualLeave, $HRMS) or die(mysql_error());
$row_RSID4AnnualLeave = mysql_fetch_assoc($RSID4AnnualLeave);
$totalRows_RSID4AnnualLeave = mysql_num_rows($RSID4AnnualLeave);

mysql_select_db($database_HRMS, $HRMS);
$query_RSALDeatilEntryFromALCaluate = "SELECT * FROM annual_leave_calculate";
$RSALDeatilEntryFromALCaluate = mysql_query($query_RSALDeatilEntryFromALCaluate, $HRMS) or die(mysql_error());
$row_RSALDeatilEntryFromALCaluate = mysql_fetch_assoc($RSALDeatilEntryFromALCaluate);
$totalRows_RSALDeatilEntryFromALCaluate = mysql_num_rows($RSALDeatilEntryFromALCaluate);

mysql_select_db($database_HRMS, $HRMS);
$query_RSALDeatilEntry = "SELECT * FROM annual_leave_detail";
$RSALDeatilEntry = mysql_query($query_RSALDeatilEntry, $HRMS) or die(mysql_error());
$row_RSALDeatilEntry = mysql_fetch_assoc($RSALDeatilEntry);
$totalRows_RSALDeatilEntry = mysql_num_rows($RSALDeatilEntry);
?>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/main_TemplateNew.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thekey HRMS</title>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "../login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<style type="text/css">
body {
	margin: 0;
	padding: 0;
	text-align: center;
	width: auto;
}
#wrrapper {
	margin: 0 auto;
	text-align: left;
	width: 900px;
	background-color: #999;
}
#headerspace {
	background-color: #999;
	height: 10px;
	width: 1280px;
}


/* menu */
.menu_nav {
	margin:0;
	padding:-15px 20px 0 20px;
	float:left;
	width: auto;
}
.menu_nav ul { list-style:none;}
.menu_nav ul li { margin:0 4px; padding:0 8px 0 0; float:left; background:url(../_template/clearfocus/html/images/menu.gif) no-repeat right center;}
.menu_nav ul li a {
	display:block;
	margin:0;
	padding:18px 16px;
	color:#F60;
	text-decoration:none;
	font-size:14px;
}
.menu_nav ul li.active a, .menu_nav ul li a:hover { background:url(../_template/clearfocus/html/images/menu_a.gif) repeat-x top;;}
#header {
	background-color: #FFF;
	height: 300px;
	top: 0px;
	clip: rect(0px,auto,auto,auto);
	width: 900px;
}
#sidemenu {
	font-size: 14px;
	font-weight: normal;
	color: #F60;
	background-color: #CCC;
	height: 250px;
	width: 120px;
}
#sidecontent {
	color: #F60;
	height: 430px;
	width: 120px;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
}
#headerimg {
	height: 60px;
	width: auto;
	background-color: #FFF;
	background-image: url("../img logo & icons/fade.jpg");
}
#mainnavigation {
	height: 200px;
	width: 100px;
	color: #660;
}
#headerAdvert {
	background-color: #FFF;
	height: 120px;
	width: 870px;
	color: #F90;
	font-size: 14px;
	top: 0px;
	clip: rect(0px,auto,auto,auto);
}
#sidebar {
	background-color: #FFF;
	margin: 0px;
	padding: 0px;
	height: 700px;
	width: 120px;
	left: 650px;
	top: 0px;
	float: right;
	color: #F60;
	font-weight: lighter;
	font-size: 18px;
	font-variant: normal;
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	text-align: left;
}
#footer {
	background-color: #999;
	margin: 0px;
	padding: 0px;
	height: 20px;
	width: 900px;
	clear: both;
	left: 7px;
	top: 922px;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
}
#mainContent {
	background-color: #FFF;
	height: 900px;
	width: 780px;
	float: left;
	font-family: Georgia, "Times New Roman", Times, serif;
	font-size: 16px;
	font-style: normal;
	color: #000;
	text-align: left;
}
#header #headerAdvert h1 {
	font-size: 14px;
	font-style: normal;
	font-weight: 100;
	color: #333;
}
a:link {
	color: #F30;
	text-decoration: underline;
}
a:visited {
	color: #F60;
	text-decoration: underline;
}
a:hover {
	color: #03F;
	text-decoration: none;
}
a:active {
	color: #F30;
}
a {
	font-size: 16px;
}
</style>
<script src="../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico" >
<link rel="icon" href="animated_favicon.gif" type="image/gif" >

<script language=javascript>
<!--
function popDemo(N) {
newWindow = window.open(N, 'popD','toolbar=no,menubar=no,resizable=no,scrollbars=no,status=no,location=no,width=500,height=250');
}
//-->
</script>

</head>

<body>
<div id="headerspace"></div>
<div id="wrrapper">

<div id="header">
<div id="headerAdvert">
    <H2 ><font  size="20" >Thekey</font><span id="headerAdvert"><font color="#999999" size="20" >HRMS</font><font color="#999999" size="3" >    Bringing ICT Solution to Your need.</font>  </span> <font color="#999999" size="3" >The key is yours!! </font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../index.php"><img src="../flags/United Kingdom flag.png" width="35" height="25" /></a><a href="../Amharic/index.php"><img border="0" src="../flags/Ethiopiaflag.jpg" alt="Amharic(ETH)" width="35" height="30" /></a><a href="../Dutch/index.php"><img src="../flags/Netherlands-Flag-icon.png" width="35" height="25" /></a></h2>
   <H2><font color="#999999" size="+1" ></font><img src="../img logo &amp; icons/logo.jpg" alt="Rev(3:7)He that hath THE KEY of David, he that openeth, and no man shutteth;  and shutteth, and no man openeth;" width="100" height="40" />
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     <font color="#FF6600" size="6">Human Resource Management System </font>
     </font></h2>
  </div>
    <div id="headerimg">
      <div class="menu_nav">

<!--
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="support.html">Recriument</a>
          </li>
          <li><a href="about.html">Leave</a></li>
          <li><a href="blog.html">Benfite</a></li>
          <li><a href="blog.html">Report</a></li>
          <li><a href="blog.html">Leave</a></li>
        </ul>
        -->
<ul id="MenuBar1" class="MenuBarHorizontal">
<li><a href="../index.php">Home</a> </li>
        <li><a href="#" class="MenuBarItemSubmenu">Recruitment</a>
          <ul>
            <li><a href="../Recruitment/Recruitment.php">Recruitment Form</a></li>
<li><a href="#" class="MenuBarItemSubmenu">Equipment Handover</a>
              <ul>
                <li><a href="../Equipment HandOver/Equipment_HandOver.php">Equipment Handover</a></li>
                <li><a href="../Equipment HandOver/Equipment_ReturnBack.php">Equipment Return Back</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li><a href="../Personal Reocrd/Personal_Information_Detail.php">Personal   Info.</a></li>
        <li><a href="#" class="MenuBarItemSubmenu">Leave</a>
          <ul>
            <li><a href="#" class="MenuBarItemSubmenu">Annual Leave</a>
              <ul>
                <li><a href="Annual_Leave_Grant.php">Annual Leave Grant</a></li>
</ul>
            </li>
            <li><a href="Funeral_Leave_Grant.php">Funeral Leave</a></li>
            <li><a href="Maternity_Leave_Grant.php">Maternity Leave</a></li>
            <li><a href="Paternity_Leave_Grant.php">Paternity Leave</a></li>
            <li><a href="Sick_Leave_Grant.php">Sick Leave</a></li>
            <li><a href="Special_Leave_Grant.php">Special Leave</a></li>
<li><a href="Wedding_Leave_Grant.php">Wedding Leave</a></li>
            <li><a href="Back_From_Leave_Report.php">Back to Work Report</a></li>
          </ul>
        </li>
        <li><a class="MenuBarItemSubmenu" href="#">Disciplinary Action</a>
          <ul>
            <li><a href="../Letters/warning Letters/Verbal_Warning.php">Verbal Warning</a>            </li>
            <li><a href="#">Salary Punishment</a></li>
            <li><a href="#" class="MenuBarItemSubmenu">Written Warning</a>
              <ul>
                <li><a href="../Letters/warning Letters/First_Instance_Warning.php">1st Instance Warning</a></li>
                <li><a href="../Letters/warning Letters/Second_Instance_Warning.php">2nd Instance Warning</a></li>
                <li><a href="../Letters/warning Letters/Third_Instance_Warning.php">3rd Instance Warning</a></li>
                <li><a href="../Letters/warning Letters/Last_Warning.php">Last Warning</a></li>
              </ul>
            </li>
            <li><a href="#" class="MenuBarItemSubmenu">Dismissal / Termination</a>
              <ul>
                <li><a href="../Letters/warning Letters/Termination.php">Termination Form</a></li>
                <li><a href="#">Termination Letter</a></li>
              </ul>
            </li>
            <li><a href="javascript: if (confirm('Are You Sure You want to remove Expired Warning?')) { window.location.href='../Letters/warning Letters/Expired_Warning_Remover.php' } else { void('') }; ">Expired Warning Remover</a></li>
            <li><a href="../Letters/warning Letters/Warning_Letters_Viewer.php">Warning Letter Viewer</a></li>
          </ul>
        </li>
        <li><a href="http://localhost/Report/annual_leaverpt.php" target="_blank" class="MenuBarItemSubmenu">Report</a>
          <ul>
            <li><a href="javascript:popDemo('Court Case/CourtCaseReportDateSelection.php')">Court Case</a></li>

          </ul>
        </li>
        <li><a href="#" class="MenuBarItemSubmenu">Organization</a>
          <ul>
<li><a href="#">Contract</a></li>
            <li><a href="#">Procedure</a></li>
            <li><a href="#">Plan</a></li>
            <li><a href="#">Policy</a></li>
            <li><a href="#">CBA</a></li>
</ul>
        </li>
        <li><a href="#" class="MenuBarItemSubmenu">Benefits</a>
          <ul>
            <li><a href="../Medical/Medical_Referral.php">Medical Referral From</a></li>
            <li><a href="../Medical/MedicalTest.php">Medical Test</a></li>
<li><a href="../Training/Training.php">Training</a></li>
          </ul>
        </li>
</ul>
<?php echo "<font face=\"Times New Roman, Times, serif\" size=\"+1\"><b>loged in as ".$_SESSION['MM_Username']."</b></font>";  ?>
      </div>
  </div>
  <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" -->
 
      <blockquote>
        <blockquote>
          <blockquote>
            <blockquote>
              <blockquote>
              <p class="active">
               <?php function subtractDaysFromToday($number_of_days)
{
    $today = mktime(0, 0, 0, date('m'), date('d'), date('Y'));

    $subtract = $today - (86400 * $number_of_days);

    //choice a date format here
    return date("Y-m-d", $subtract);
}

?>
<?php function AddDaysFromToday($number_of_days)
{
    $today = mktime(0, 0, 0, date('m'), date('d'), date('Y'));

    $Add = $today + (86400 * $number_of_days);

    //choice a date format here
    return date("Y-m-d", $Add);
}

?>
<font color="#FF6600" size="+1">Annual Leave Grant Form</font>
                  <?php include("Select_ID4AnnualLeaveGrant.php");?>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" onMouseOver="Numberofdays()">
    
      <table width="400" height="462" align="center" background="" bgcolor="#EBEBEB">
        <tr valign="baseline">
          <td width="128" align="right" nowrap="nowrap"> Selected ID:</td>
          <td width="385">
     <input value="<?php if(isset($_GET['ID'] ))
				{
					
				echo $_GET['ID'];} ?>" size="10" readonly="readonly"  />     
        </td>
        </tr>
        
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">First Name:</td>
          <td align="left"><input name="FirstName" type="text" value="<?php
            
       			 		$query  = "SELECT * FROM employee_personal_record";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					if(isset($_GET['ID'] ))
				{
					
				
					if ($row['ID'] == $_GET['ID'])
					{
						
					echo "{$row['FirstName']}";
					
					
					}
					}
				}
				 ?>"  
          
          
          size="20" maxlength="20" readonly="readonly" align="left" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Middel Name:</td>
          <td><input name="MiddelName" type="text" value="<?php
            
       			 		$query  = "SELECT * FROM employee_personal_record";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					if(isset($_GET['ID'] ))
				{
					
				
					if ($row['ID'] == $_GET['ID'])
					{
					echo "{$row['MiddelName']}";
					}
					}
				}
				 ?>"size="20" maxlength="20" readonly="readonly" /></td>
        </tr>
        <tr valign="baseline">
          <td  align="right" nowrap="nowrap">Last Name:</td>
          <td><input name="LastName" type="text" value="<?php
            
       			 		$query  = "SELECT * FROM employee_personal_record";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					if(isset($_GET['ID'] ))
				{
					
				
					if ($row['ID'] == $_GET['ID'])
					{
					echo "{$row['LastName']}";
					}
					}
				}
				 ?>" size="20" maxlength="20" readonly="readonly" /></td>
        </tr>
         <tr valign="baseline">
                     <td height="40" align="right" nowrap="nowrap">Department:</td>
                     <td><input type="text" name="Department" value="<?php
            
       			 		$query  = "SELECT * FROM employee_personal_record";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					 if(isset($_GET['ID'] ))
					 {	
					if ($row['ID'] == $_GET['ID'])
					{
						
					echo "{$row['Department']}";
					
					}
					
				}
				}?>" size="20" readonly="readonly" /></td>
                   </tr>
        <tr valign="baseline">
          <td  align="right" nowrap="nowrap">Leave days:</td>
          <td><span id="sprytxtLeaveDays">
          <input  id="Leavedays" name="Leavedays" type="text" value="0" size="5" maxlength="4"  />
          <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMinValueMsg">The entered value is less than the minimum required.</span></span></td>
        </tr>
        <tr valign="baseline">
          <td  align="right" nowrap="nowrap">Rest days:</td>
          <td>
            <input name="Restday" id="Restday" type="text" value="0" size="5" maxlength="4" />
          </td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Leave Taken Date:</td>
          <td><input type="text" id="Leave_Taken_Date"  name="Leave_Taken_Date" onclick='scwShow(this,event);' value="<?php echo date("Y-m-d"); ?>" size="15"  />

</td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Report On:</td>
          <td>
          <script type='text/JavaScript' src="../Calender/scw.js" ></script>
		
		<input type="text" id="ReportOn" name="ReportOn" readonly="readonly" /><!--<input   type="text" name="ReportOn"  value="<?php /*
		 
		   $date = date("Y-m-d");
		  //$off=$_POST['Restday']+$_POST['Leavedays']
		  $off=1+4;
$newdate = strtotime ( '+'.$off.' day' , strtotime ( $date ) ) ;
$newdate = date ( 'Y-m-j' , $newdate );
 echo $newdate;*/
 //$date = date("Y-m-d",strtotime($date)) 

		  ?>" size="15" /--->
        
</td>

        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td> <input type="submit" value="Grant" onClick="return confirm('Are you sure you want to Grant Annual Leave for this Employee?')"   /></td>
        </tr>
     
</table>
      </font>
      <p>
        <input type="hidden" name="MM_insert" value="form1" />
      </p>
     <script type="text/javascript">
function Numberofdays(){
       t1=document.getElementById("Leave_Taken_Date").value;
	   t2=document.getElementById("ReportOn").value
	  restday=document.getElementById("Restday").value
	  leaveday=document.getElementById("Leavedays").value
        var one_day=1000*60*60*24; 
        var x=t1.split("-");     
        var y=t2.split("-");
        var date1=new Date(x[0],(x[1]-1),x[2]);
        var date2=new Date(y[0],(y[1]-1),y[2])
        var month1=x[1]-1;
        var month2=y[1]-1;
          
        _Diff=Math.ceil((date2.getTime() - date1.getTime())/(one_day)); 
      totalday=restday+leaveday

    var now = new Date();
	t1=document.getElementById("Leave_Taken_Date").value;
	
	 var x=t1.split("-"); 
	
	var  newday=parseInt(x[2])+parseInt(leaveday)+ parseInt(restday);
	//alert(newday);
	 now.setYear(x[0]);
     now.setMonth(x[1]-1);
     now.setDate(newday);

	
      	var nowStr = now.getFullYear().toString() + "-" +
        (now.getMonth()+1 < 10 ? "0" + (now.getMonth()+1).toString() : (now.getMonth()+1).toString()) + "-" +
        (now.getDate() < 10 ? "0" + now.getDate().toString() : now.getDate().toString());
		
     // alert(nowStr);

document.getElementById("ReportOn").value=nowStr;



}

   </script>  
    </form>
         
  
  <!-- InstanceEndEditable -->
    <blockquote>&nbsp;</blockquote>
  </div>
  <div id="sidebar">
    <div id="sidemenu">
    
   <ul id="MenuBar2" class="MenuBarVertical">
     <li><a href="../Recruitment/Probation_Evaluation.php">Probation Period Evaluation</a>       </li>
     <li><a href="../Recruitment/Probation_Evaluation.php" class="MenuBarItemSubmenu">Personal Detail</a>
       <ul>
<li><a href="../Recruitment/Probation_Evaluation.php">Probation Period Evaluation</a></li>
<li><a href="../Personal Reocrd/Employee_Personal_Record.php">Personal Detail entry</a></li>
<li><a href="../Database_Update/Personal Record Database_Update/PersonalRecordDisplay.php" target="_blank">Personal Detail Search</a></li>
       </ul>
     </li>
     <li><a class="MenuBarItemSubmenu" href="#">Employee Status Transaction</a>
       <ul>
         <li><a href="../Employee_Status_Transaction/Department_Transfer.php">Department Transfer</a></li>
         <li><a href="../Employee_Status_Transaction/Promotion.php">Promotion</a></li>
         <li><a href="../Employee_Status_Transaction/Demotion.php">Demotion</a></li>
         <li><a href="../Court Case/Court_Case.php">Court Case</a></li>
       </ul>
     </li>
     <li><a target="_blank" href="../Proclamation/Ethiopian Labour Law Pro.377-2003 Amharic and English.htm">Labour Law Proclamation</a></li>
     <li><a href="#" class="MenuBarItemSubmenu"> HRM System Settings...</a>
       <ul>
         <li><a href="#" class="MenuBarItemSubmenu">System Data Setting</a>
           <ul>
             <li><a href="Leave Database_Update/AnnualLeaveDisplay.php">Annual Leave Data</a></li>
             <li><a href="Leave Database_Update/AnnualLeaveCalcDisplay.php">Calc Annual Leave Data</a></li>
             <li><a href="Leave Database_Update/SickLeaveDisplay.php">Sick   Leave Data</a></li>
             <li><a href="Leave Database_Update/MaternityLeaveDisplay.php">Maternity Leave Data</a></li>
             <li><a href="../Court Case/CourtCaseDisplay.php">Cour Case Data</a></li>
           </ul>
         </li>
         <li><a href="#" class="MenuBarItemSubmenu">User account</a>
           <ul>
             <li><a href="../User_Account/Creat_Account.php">Creat User Account</a></li>
             <li><a href="../User_Account/Change_Password.php">Change Password</a></li>
             <li><a href="../User_Account/Delete_Account.php">Delete User Account</a></li>
           </ul>
       </li>
<li><a href="<?php echo $logoutAction ?>">Log Out</a></li>
       </ul>
   </li>
   </ul>
<!--<p><a href="main_template.html">side menu 1</a>
      <p><a href="about.html">side menu 1</a>      
      <p><a href="about.html">side menu 1</a>
      </p>
      <a href="about.html">side menu 1</a>
<p>side menu 1</p>
<p><a href="about.html">side menu 1</a></p>
-->
</div>
  <div id="sidecontent">
    <p>&nbsp;</p>
    <!-- InstanceBeginEditable name="SideContent" -->
    <p></p>
    <br />
    <br />
    <br />
    <a href="../Ethiopian Labour Law Pro.377(English).htm#a76" target="_blank">Annual Leave Labour Law</a>
    <?php include ("../Notifications/ALNotification.php");?>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    
    <p>&nbsp;</p>
    <!-- InstanceEndEditable -->
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  </div>
  </div>
  <div id="footer">
    <p class="lf">&copy; Copyright ThkeyHRMS.Designed and Developed by <a href="http://www.thekey.com">Thekey ICT Soultion</a> &nbsp;Licensed for Sher Ethiopia plc</p>
  </div>
  <p align="center"><img src="../img logo & icons/thekey soft.jpg" width="159" height="37" /><sup ><sup style="font-size:15px">&reg;&trade;</sup></sup></p>
</div>
<script type="text/javascript">
var MenuBar2 = new Spry.Widget.MenuBar("MenuBar2", {imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"../SpryAssets/SpryMenuBarDownHover.gif", imgRight:"../SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($RSAnnualLeave);

mysql_free_result($RSID4AnnualLeave);

mysql_free_result($RSALDeatilEntryFromALCaluate);

mysql_free_result($RSALDeatilEntry);
?>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytxtLeaveDays", "integer", {validateOn:["blur"], maxChars:3, minChars:1, minValue:0.5});
</script>