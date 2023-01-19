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
										date_format( `Date_Employement` , '%Y%m' ) ) AS Workingmonths FROM aqhrmsdb.employee_personal_record where ID= '".$_GET['ID']."' and FirstName='".$_POST['FirstName']."'";
						
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
						if(mysql_num_rows(mysql_query("SELECT * FROM aqhrmsdb.`annual_leave_calculate` WHERE ID='".$_GET['ID']."' and FirstName='".$_POST['FirstName']."'"))){
						
				$query3  = "SELECT * FROM aqhrmsdb.`annual_leave_calculate` WHERE ID='".$_GET['ID']."' and FirstName='".$_POST['FirstName']."'";
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
				$insertSQL = sprintf("INSERT INTO aqhrmsdb.annual_leave (ID, FirstName, MiddelName, LastName,Department, Leavedays,Restday,Leave_taken_Date,ReportOn,ModifiedBy) VALUES (%s, %s, %s, %s, %s,%s,%s, %s,%s, %s)",
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
                    <div align="left" id="AL_Application_Form" >
                    <?php echo " ".date("Y-M-d")." ".time();?>
                    <p><img src="Annual Leave Application format/AQlogo.gif" alt="" width="120" height="40" /><strong> </strong><br />
  <strong>   AQ Roses plc</strong><br />
  <strong>   <u>Annual leave request form</u></strong></p>
<p><strong>Employee name<font color= "color=&quot;#FF0000&quot;"><?php echo "<u>{$_POST['FirstName']} {$_POST['MiddelName']} {$_POST['LastName']} </u>"?></font></strong><br />
  <strong>Dep&rsquo;t<font color= "color=&quot;#FF0000&quot;"><?php
            
       			 		$query  = "SELECT * FROM employee_personal_record";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
				
					if ($row['ID'] == $_GET['ID'])
					{
						
					echo "<u>{$row['Department']}</u>";
					
					
					}
				}
				
				 ?></font></strong><br />
    <strong>Date of Employeement(የተቀጠረበት ቀን </span>) <font color= "color=&quot;#FF0000&quot;"><?php $query  = "SELECT * FROM employee_personal_record";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
				
					if ($row['ID'] == $_GET['ID'])
					{
						
					echo "<u>{$row['Date_Employement']}</u>";
					
					
					}
				}?></font></font><strong> Working Month(በሥራ ላይ የቆየባቸው ወራቶች</span>) </strong> <font color= "color=&quot;#FF0000&quot;"><?php echo "".$Workingmonths."<br>"; ?></font></strong></font><br />
                
  <strong>ID N<u>o<font color= "color=&quot;#FF0000&quot;"><?php echo "<u> {$_GET['ID']} </u>"?></font></u></strong><br />
   <strong>Annual leave required from<font color= "color=&quot;#FF0000&quot;"><?php echo "<u> {$_POST['Leave_Taken_Date']} </u>"?></font>to<?php echo " <u> {$_POST['ReportOn']} </u>"?></strong>For(<span sans-serif="sans-serif""'>ለ          </span>)<font color= "color=&quot;#FF0000&quot;"><?php echo "<u> {$_POST['Leavedays']} </u>"?></font>days (<strong>ቀናት</strong>)<strong></strong><br />
 <span sans-serif="sans-serif""'> </span></strong>
  <strong> </strong><strong>የተጠየቀው የዓመት  ፍቃድ</strong><strong><span sans-serif="sans-serif""'>           </span></strong><strong>                         </strong><strong>እስከ</strong><strong> </strong><strong> 
  <strong>Back to work on<font color= "color=&quot;#FF0000&quot;"><?php echo "<u> {$_POST['ReportOn']} </u>"?></font></strong><br />
  <strong>ወደስራ የሚመለሱበት ቀን</strong>
  <strong>Annual leave taken  <font color="#FF0000"><?php echo "<u> {$TotalTakenDay} </u>"?></font>days</strong><br />
  <strong>አሁን</strong><strong><span sans-serif="sans-serif""'>&nbsp;</span></strong><strong>የሚወስዳቻዉ ቀናት</strong><strong><span sans-serif="sans-serif""'> </span></strong><br />
  <strong>Annual leave remaining   <font color= "color=&quot;#FF0000&quot;"><?php echo "<u>{$Total_Left_Days}</u>"?></font>days</strong><br />
  <strong><em>የሚኖሩት ቀሪ </em></strong><strong>ቀናት </strong><strong><span sans-serif="sans-serif""'> </span></strong><br />
   <?php echo "<b>This Year(<span style=\"font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;\">ከአሁኑ ዓመት</span>): <font color= \"color=&quot;#FF0000&quot;\">{$thisyearLeft} </font>, ";
		echo " Last Year(<span style=\"font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;\">ካለፈው ዓመት</span>): <font color= \"color=&quot;#FF0000&quot;\">{$lastyearLeft}</font> , ";
		echo " Before Last Year(<span style=\"font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;\">ከሁለት ዓመት በፊት</span>): <font color= \"color=&quot;#FF0000&quot;\">{$beforelastyearLeft}</font></b><br/>";
		?>
  <strong><em>Requested by:</em></strong><strong>                                  <em>Given by:                                   Approved by:</em></strong><br />
  <strong><em>የጠየቀው                  የፈቀደው               ያጸደቀው</em></strong><strong> </strong><br />
  <strong>Name and signature                         Name and  signature                   Name and  signature </strong><br />
  <strong>                                                                              </strong><br />
  <strong>_______________                            ________________                     _______________</strong><br />
  <strong> Note: -prepared  in two copies. One to the employee and the second for personnel file.</br>
<table border="1" cellspacing="0" cellpadding="0" align="left" width="650">
  <tr>
    <td width="543" valign="top"></td>
  </tr>
</table>
<br/><?php echo " ".date("Y-M-d")." ".time();?>
                    <p><img src="Annual Leave Application format/AQlogo.gif" alt="" width="120" height="40" /><strong> </strong><br />
  <strong>   AQ Roses plc</strong><br />
  <strong>   <u>Annual leave request form</u></strong></p>
<p><strong>Employee name<font color= "color=&quot;#FF0000&quot;"><?php echo "<u>{$_POST['FirstName']} {$_POST['MiddelName']} {$_POST['LastName']} </u>"?></font></strong><br />
  <strong>Dep&rsquo;t<font color= "color=&quot;#FF0000&quot;"><?php
            
       			 		$query  = "SELECT * FROM employee_personal_record";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
				
					if ($row['ID'] == $_GET['ID'])
					{
						
					echo "<u>{$row['Department']}</u>";
					
					
					}
				}
				
				 ?></font></strong><br />
    <strong>Date of Employeement(የተቀጠረበት ቀን </span>) <font color= "color=&quot;#FF0000&quot;"><?php $query  = "SELECT * FROM employee_personal_record";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
				
					if ($row['ID'] == $_GET['ID'])
					{
						
					echo "<u>{$row['Date_Employement']}</u>";
					
					
					}
				}?></font></font><strong> Working Month(በሥራ ላይ የቆየባቸው ወራቶች</span>) </strong> <font color= "color=&quot;#FF0000&quot;"><?php echo "".$Workingmonths."<br>"; ?></font></strong></font><br />
                
  <strong>ID N<u>o<font color= "color=&quot;#FF0000&quot;"><?php echo "<u> {$_GET['ID']} </u>"?></font></u></strong><br />
   <strong>Annual leave required from<font color= "color=&quot;#FF0000&quot;"><?php echo "<u> {$_POST['Leave_Taken_Date']} </u>"?></font>to<?php echo " <u> {$_POST['ReportOn']} </u>"?></strong>For(<span sans-serif="sans-serif""'>ለ          </span>)<font color= "color=&quot;#FF0000&quot;"><?php echo "<u> {$_POST['Leavedays']} </u>"?></font>days (<strong>ቀናት</strong>)<strong></strong><br />
 <span sans-serif="sans-serif""'> </span></strong>
  <strong> </strong><strong>የተጠየቀው የዓመት  ፍቃድ</strong><strong><span sans-serif="sans-serif""'>           </span></strong><strong>                         </strong><strong>እስከ</strong><strong> </strong><strong> 
  <strong>Back to work on<font color= "color=&quot;#FF0000&quot;"><?php echo "<u> {$_POST['ReportOn']} </u>"?></font></strong><br />
  <strong>ወደስራ የሚመለሱበት ቀን</strong>
  <strong>Annual leave taken  <font color="#FF0000"><?php echo "<u> {$TotalTakenDay} </u>"?></font>days</strong><br />
  <strong>አሁን</strong><strong><span sans-serif="sans-serif""'>&nbsp;</span></strong><strong>የሚወስዳቻዉ ቀናት</strong><strong><span sans-serif="sans-serif""'> </span></strong><br />
  <strong>Annual leave remaining   <font color= "color=&quot;#FF0000&quot;"><?php echo "<u>{$Total_Left_Days}</u>"?></font>days</strong><br />
  <strong><em>የሚኖሩት ቀሪ </em></strong><strong>ቀናት </strong><strong><span sans-serif="sans-serif""'> </span></strong><br />
   <?php echo "<b>This Year(<span style=\"font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;\">ከአሁኑ ዓመት</span>): <font color= \"color=&quot;#FF0000&quot;\">{$thisyearLeft} </font>, ";
		echo " Last Year(<span style=\"font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;\">ካለፈው ዓመት</span>): <font color= \"color=&quot;#FF0000&quot;\">{$lastyearLeft}</font> , ";
		echo " Before Last Year(<span style=\"font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;\">ከሁለት ዓመት በፊት</span>): <font color= \"color=&quot;#FF0000&quot;\">{$beforelastyearLeft}</font></b><br/>";
		?>
  <strong><em>Requested by:</em></strong><strong>                                  <em>Given by:                                   Approved by:</em></strong><br />
  <strong><em>የጠየቀው                  የፈቀደው               ያጸደቀው</em></strong><strong> </strong><br />
  <strong>Name and signature                         Name and  signature                   Name and  signature </strong><br />
  <strong>                                                                              </strong><br />
  <strong>_______________                            ________________                     _______________</strong><br />
  <strong> Note: -prepared  in two copies. One to the employee and the second for personnel file.
</div>
                        <?php
							if(mysql_num_rows(mysql_query("SELECT * FROM aqhrmsdb.`annual_leave_calculate` WHERE ID='".$_GET['ID']."'"))){
							
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
								$sqlINST="INSERT INTO `aqhrmsdb`.`annual_leave_calculate` 
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



<?php
/**
 * Small Wrapper class to manage Languages stored in a MySQL DB

 */
class Language {
 
    var $defaultlang = "en";	// Default Language
 
    var $languages = array("en");
 
    // mysqli instance;
    var $db;
 
    function __construct($db="", $defaultlang="") {
    
		mysql_select_db('aqhrmsdb');
        
        if($db != "") {
            $this->db = $db;
        } else {
            $this->db = new mysqli();
        }
        if($defaultlang != "") {
            $this->defaultlang = $defaultlang;
        }
        $this->languages = $this->getLanguageIDs();
    }
 
    /**
     * Get text from DB given a specific Text ID and Language
     */
    public function get($textid, $langid="") {
        if($langid == "") {
            $langid = $this->defaultlang;
        }
      	$query = "SELECT text FROM lang_$langid WHERE textid='$textid'";
        $result = mysql_query($query) or die(mysql_error());
        $row = mysql_fetch_array($result);
        $text = $row[0];
        if($langid == $this->defaultlang) {  // if language is default, return the langauge unchecked.
        if($text=="")
            return $textid;
        else
            return $text;
            
        } else {
            if($text != "") { // Is text field un-translated? (i.e. not empty string)
                return $text;
            } else { 
            //// If not, query using default language
            ///// return $this->get($textid, $this->defaultlang);
            
                //copying defualt laguage translation
             $defaultexist = $this->get($textid, $this->defaultlang);
             
             if($defaultexist=="")//is default is empty return textid
                return $textid;
             else  //else return default language transaltion
               return $this->get($textid, $this->defaultlang); 
                
            }
        }
        return "";
    }
 
    /**
     * Return an Array of Language IDs of each language in the Database
     */
    public function getLanguageIDs() {
        $languages = array();
        $sql = "SELECT `lang` FROM `languages`";
        $result = mysql_query($sql);
        $i = 0;
        while($row = mysql_fetch_array($result)) {
            $languages[$i] = $row[0];
            $i++;
        }
        return $languages;
    }
 
    /**
     * Return an Array of Descriptions of each language in the Database.
     */
    public function getLanguageDescriptions() {
        $languagesDesc = array();
        $sql = "SELECT description FROM languages";
        $result = mysql_query($sql) or die(mysql_error());
        $i = 0;
        while($row = mysql_fetch_array( $result )) {
            $languagesDesc[$i] = $row[0];
            $i++;
        }
        return $languagesDesc;
    }
 
    /**
     * Delete a Text ID from all Language Tables
     * @param $textid
     */
    public function deleteTextID($textid) {
        if($textid != "") {
            $numLanguages = count($this->languages);
            for($i = 0; $i < $numLanguages; $i++) {
                $sql = "DELETE FROM lang_".$this->languages[$i]." WHERE textid='$textid'";
                $result = mysql_query($sql) or die(mysql_error());
            }
            $status = "Deleted TextID ".$textid;
        }
        return $status;
    }
 
    /**
     * Update Text for a specific Language
     * @param $langid
     * @param $textid
     * @param $text
     */
    public function updateText($langid, $textid, $text) {
        if($langid != "" && $textid != "" && $text != "") {
            $sql = "UPDATE lang_$langid SET text='$text' WHERE textid='$textid' ";
            $result = mysql_query($sql) or die(mysql_error());
            $status = "Updated Entry";
        }
	return $status;
    }
 
    /**
     * Delete a Language from the Database
     * @param $langid
     */
    public function deleteLanguage($langid) {
    	if($langid != "") {
            $sql = "DROP TABLE IF EXISTS lang_".$langid;
            $result = mysql_query($sql) or die(mysql_error());
            $sql = "DELETE FROM languages WHERE lang='$langid'";
            $result = mysql_query($sql) or die(mysql_error());
        }
	return "Deleted Language Table ".$langid;
    }
 
    /**
     * Add TextID field to all language databases
     * @param $textid
     */
    public function addTextID($textid) {
        $numLanguages = count($this->languages);
        for($i = 0; $i < $numLanguages; $i++) {

            $status = $status.$this->languages[$i];
            $sql = "INSERT INTO lang_".$this->languages[$i]." (`textid`, `text`) VALUES ('$textid', '')";
            $result = mysql_query($sql) or die(mysql_error());
        }
        $status = $status."Added Text ID";
        return $status;
    }
 
    /**
     * Add a new Language
     * @paam $langID is typically a 2 letter ID (English is 'en', Japanese is 'jp')
     * The created database is 'lang_$langID' (lang_en, lang_jp)
     * @param $langDesc is the Description for the language.
     */
    public function addLanguage($langid, $langdesc) {
    	if($langid != "" && $langdesc != "") {
            $sql = "INSERT INTO languages (`lang`, `description`) VALUES ('$langid', '$langdesc')";
            $result = mysql_query($sql) or die(mysql_error());
            $sql = "CREATE TABLE IF NOT EXISTS `lang_$langid` (
        	`textid` varchar(255) collate latin1_general_ci NOT NULL,
                `text` longtext charset utf8 collate utf8_unicode_ci NOT NULL
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
            $result = mysql_query($sql) or die(mysql_error());
            $sql = "SELECT textid FROM lang_en";
            $result = mysql_query($sql) or die(mysql_error());
            while($row = mysql_fetch_array($result)) {
                $sql = "INSERT INTO lang_$langid (`textid`, `text`) VALUES ('$row[0]', '')";
        	$result2 = mysql_query($sql) or die(mysql_error());
            }
            $status = "Added Language";
	}
        return $status;
    }
 
}
?>
<?php
//******

$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASSWORD = '';
$DB_DATABASE = 'aqhrmsdb';
$DB_PORT = '3306';

////$db = new MySQLi($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_DATABASE,$DB_PORT);
//
$db = mysql_connect($DB_HOST, $DB_USER, $DB_PASSWORD);
if (!$db) {
    die('Not connected with Language Database : ' . mysql_error());
}
$db_selected = mysql_select_db($DB_DATABASE, $db);
if (!$db_selected) {
    die ('Can\'t use Language database : ' . mysql_error());
}

//Setting Charcter set to unicode to support all language
mysql_set_charset('utf8',$db); 
// $db -> set_charset('utf8');

// create a new Langauge Object
$obj_lang = new Language($db);

// ideally pull this from a users profile.
 
if(!isset($_REQUEST["lang"]))
$_REQUEST["lang"]="en";

$lang = $_REQUEST["lang"];
?>

<?php 
  
   $realpath = dirname(realpath(__FILE__));
//checking the connection is secure or not the identfy http or https protocol then append server host name
$path = ((isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) != 'off') ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] ."/". substr($realpath, strlen($_SERVER['DOCUMENT_ROOT']));

if (DIRECTORY_SEPARATOR == '\\')
        $path = str_replace('\\', '/', $path);
        
 /*     echo $path."/Language/Language.php";
        
//Language Translation Code

include($path.'/Language/Language.php');

include($path.'/Language/Language_Connection.php');

// create a new Langauge Object
//if (class_exists("Language"))
$obj_lang = new Language($db);
 
// ideally pull this from a users profile.
//if(isset($_REQUEST["Lang"]))
$lang = $_REQUEST["lang"]; 
//else
//$lang="en";*/
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
.menu_nav ul li { margin:0 4px; padding:0 8px 0 0; float:left; background:url(../../_template/clearfocus/html/images/menu.gif) no-repeat right center;}
.menu_nav ul li a {
	display:block;
	margin:0;
	padding:18px 16px;
	color:#F60;
	text-decoration:none;
	font-size:14px;
}
.menu_nav ul li.active a, .menu_nav ul li a:hover { background:url(../../_template/clearfocus/html/images/menu_a.gif) repeat-x top;;}
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
	background-image: url("../../img logo & icons/fade.jpg");
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
<script src="../../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<link href="../../SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico" >
<link rel="icon" href="animated_favicon.gif" type="image/gif" >

<script language=javascript>
<!--
function popup(N) {
newWindow = window.open(N, 'popD','toolbar=no,menubar=no,resizable=no,scrollbars=no,status=no,location=no,width=550,height=215');
}
//-->
</script>

</head>

<body>
<div id="headerspace"></div>
<div id="wrrapper">

<div id="header">
<div id="headerAdvert">
    <H2 ><font  size="20" >Thekey</font><span id="headerAdvert"><font color="#999999" size="20" >HRMS</font><font color="#999999" size="3" >    Bringing ICT Solution to Your need.</font>  </span> <font color="#999999" size="3" >The key is yours!! </font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $path."/".basename(realpath(__FILE__));?>?lang=en"><img src="../../flags/United Kingdom flag.png" width="35" height="25" /></a><a href="<?php echo $path."/".basename(realpath(__FILE__));?>?lang=am"><img border="0" src="../../flags/Ethiopiaflag.jpg" alt="Amharic(ETH)" width="35" height="30" /></a><a href="<?php echo $path."/".basename(realpath(__FILE__));?>?lang=nl"><img src="../../flags/Netherlands-Flag-icon.png" width="35" height="25" /></a></h2>
   <H2><font color="#999999" size="+1" ></font><img src="../../img logo &amp; icons/logo.jpg" alt="Rev(3:7)He that hath THE KEY of David, he that openeth, and no man shutteth;  and shutteth, and no man openeth;" width="100" height="40" />
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     <font color="#FF6600" size="6"><?php echo $obj_lang->get('Human Resource Management System', $lang); ?> </font>
     </font>
     
   </h2>
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
<li><a href="../../index.php"><?php echo $obj_lang->get('Home', $lang); ?></a>        </li>
        <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Recruitment', $lang); ?></a>
          <ul>
            <li><a href="../../Recruitment/Recruitment.php"><?php echo $obj_lang->get('Recruitment Form', $lang); ?></a></li>
            <li><a href="../../Recruitment/Photo Capture/Capture.php" target="_blank"><?php echo $obj_lang->get('Photo Capturing', $lang); ?></a></li>
            <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Equipment Handover', $lang); ?></a>
              <ul>
                <li><a href="../../Equipment HandOver/Equipment_HandOver.php"><?php echo $obj_lang->get('Equipment Handover', $lang); ?></a></li>
                <li><a href="../../Equipment HandOver/Equipment_ReturnBack.php"><?php echo $obj_lang->get('Equipment TookOver', $lang); ?></a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li><a href="../../Personal Record/Personal_Information_Detail.php"><?php echo $obj_lang->get('Personal   Info', $lang); ?></a></li>
        <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Leave', $lang); ?></a>
          <ul>
            <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Annual Leave', $lang); ?></a>
              <ul>
              <li><a href="../../Leaves/CalculateAnnualLeave.php"><?php echo $obj_lang->get('Annual Leave Calculator', $lang); ?></a></li>
                <li><a href="../../Leaves/Annual_Leave_Grant.php"><?php echo $obj_lang->get('Annual Leave Grant', $lang); ?></a></li>
</ul>
            </li>
            <li><a href="../../Leaves/Funeral_Leave_Grant.php"><?php echo $obj_lang->get('Funeral Leave', $lang); ?></a></li>
            <li><a href="../../Leaves/Maternity_Leave_Grant.php"><?php echo $obj_lang->get('Maternity Leave', $lang); ?></a></li>
            <li><a href="../../Leaves/Paternity_Leave_Grant.php"><?php echo $obj_lang->get('Paternity Leave', $lang); ?></a></li>
            <li><a href="../../Leaves/Sick_Leave_Grant.php"><?php echo $obj_lang->get('Sick Leave', $lang); ?></a></li>
            <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Special Leave', $lang); ?></a>
              <ul>
                <li><a href="../../Leaves/Special_Leave_Grant.php"><?php echo $obj_lang->get('Special Leave With Payment', $lang); ?></a></li>
                <li><a href="../../Leaves/Special_Leave_GrantWithoutPayment.php"><?php echo $obj_lang->get('Special Leave Without Payment', $lang); ?></a></li>
              </ul>
            </li>
<li><a href="../../Leaves/Wedding_Leave_Grant.php"><?php echo $obj_lang->get('Wedding Leave', $lang); ?></a></li>
            <li><a href="../../Leaves/Back_From_Leave_Report.php"><?php echo $obj_lang->get('Back to Work Report', $lang); ?></a></li>
          </ul>
        </li>
        <li><a class="MenuBarItemSubmenu" href="#"><?php echo $obj_lang->get('Disciplinary Action', $lang); ?></a>
          <ul>
            <li><a href="../../Letters/warning Letters/Verbal_Warning.php"><?php echo $obj_lang->get('Verbal Warning', $lang); ?></a>            </li>
<li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Written Warning', $lang); ?></a>
              <ul>
                <li><a href="../../Letters/warning Letters/First_Instance_Warning.php"><?php echo $obj_lang->get('1st Instance Warning', $lang); ?></a></li>
                <li><a href="../../Letters/warning Letters/Second_Instance_Warning.php"><?php echo $obj_lang->get('2nd Instance Warning', $lang); ?></a></li>
                <li><a href="../../Letters/warning Letters/Third_Instance_Warning.php"><?php echo $obj_lang->get('3rd Instance Warning', $lang); ?></a></li>
                <li><a href="../../Letters/warning Letters/Last_Warning.php"><?php echo $obj_lang->get('Last Warning', $lang); ?></a></li>
              </ul>
            </li>
            <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Dismissal / Termination', $lang); ?></a>
              <ul>
<li><a href="../../Letters/warning Letters/Termination.php"><?php echo $obj_lang->get('Termination Form', $lang); ?></a></li>
<li><a href="../../Letters/warning Letters/Termination4ProbationPeriod.php"><?php echo $obj_lang->get('Probation Period Termination', $lang); ?></a></li>
<li><a href="#"><?php echo $obj_lang->get('Termination Letter', $lang); ?></a></li>
              </ul>
            </li>
            <li><a href="javascript: if (confirm('Are You Sure You want to remove Expired Warning?')) { window.location.href='../Letters/warning Letters/Expired_Warning_Remover.php' } else { void('') }; "><?php echo $obj_lang->get('Expired Warning Remover', $lang); ?></a></li>
            <li><a href="../../Letters/warning Letters/Warning_Letters_Viewer.php"><?php echo $obj_lang->get('Warning Letter Viewer', $lang); ?></a></li>
          </ul>
        </li>
        <li><a href="http://localhost/Report/annual_leaverpt.php" target="_blank" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Report', $lang); ?></a>
          <ul>
            <li><a href="../../AQHRMSReport/index.php" target="_blank"><?php echo $obj_lang->get('HRM Reports', $lang); ?></a></li>
            <li><a href="../../Court Case/CourtCaseFilter.php" target="_blank"><?php echo $obj_lang->get('Court Case Report', $lang); ?></a></li>
            <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Payroll Report', $lang); ?></a>
              <ul>
                <li><a href="javascript:popup('AQPayrollReport/PayrollsheetReportSelection.php')"><?php echo $obj_lang->get('Payroll Sheet', $lang); ?></a></li>
                <li><a href="javascript:popup('AQPayrollReport/AttendanceReportSelection.php')"><?php echo $obj_lang->get('Attendance', $lang); ?></a></li>
                <li><a href="javascript:popup('AQPayrollReport/PayslipReportSelection.php')"><?php echo $obj_lang->get('Payslip', $lang); ?></a></li>
                <li><a href="javascript:popup('AQPayrollReport/CurrencyDenominationReportSelection.php')"><?php echo $obj_lang->get('Currency Denomination', $lang); ?></a></li>
                <li><a href="javascript:popup('AQPayrollReport/ProvidentFundReportSelection.php')"><?php echo $obj_lang->get('Provident Fund', $lang); ?></a></li>
                <li><a href="javascript:popup('AQPayrollReport/PensionReportSelection.php')"><?php echo $obj_lang->get('Pension Report', $lang); ?></a></li>
                <li><a href="javascript:popup('AQPayrollReport/LUContributionReportSelection.php')"><?php echo $obj_lang->get('Labour Union Contribution', $lang); ?></a></li>
              </ul>
            </li>
            <li><a href="../../Salary Increment Report/SalaryIncrementReport.php" target="_blank"><?php echo $obj_lang->get('Salary Increment', $lang); ?></a></li>
          </ul>
        </li>
        <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Organization', $lang); ?></a>
          <ul>
<li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Contract', $lang); ?></a>
  <ul>
<li><a href="../../Letters/Contract Letters/Creat Contract Letter.php"><?php echo $obj_lang->get('Creat New Contract', $lang); ?></a></li>
<li><a href="../../Letters/Contract Letters/Contract Letter.php"><?php echo $obj_lang->get('Contract Letter', $lang); ?></a></li>
  </ul>
</li>
            <li><a href="../../Organization/Policy.pdf" target="_blank"><?php echo $obj_lang->get('Policy', $lang); ?></a></li>
            <li><a href="../../Organization/Plan.pdf" target="_blank"><?php echo $obj_lang->get('Plan', $lang); ?></a></li>
            <li><a href="../../Organization/Procedure.pdf" target="blank"><?php echo $obj_lang->get('Procedure', $lang); ?></a></li>
            <li><a href="../../Organization/CBA.pdf" target="_blank"><?php echo $obj_lang->get('CBA', $lang); ?></a></li>
          </ul>
        </li>
        <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Benefits', $lang); ?></a>
          <ul>
            <li><a href="../../Medical/Medical_Referral.php"><?php echo $obj_lang->get('Medical Referral From', $lang); ?></a></li>
            <li><a href="../../Medical/Cholinesterase_Test.php" title="Cholinesterase Test"><?php echo $obj_lang->get('Cholinesterase Test', $lang); ?></a></li>
            <li><a href="../../Training/Training.php"><?php echo $obj_lang->get('Training', $lang); ?></a></li>
          </ul>
        </li>
</ul>
<?php echo "<font face=\"Times New Roman, Times, serif\" size=\"+1\"><b>logged in as ".$_SESSION['MM_Username']."</b></font>";  ?>
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
          <td  align="right" nowrap="nowrap">Department:</td>
          <td><input name="Department" type="text" value="<?php
            
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
				}
				 ?>" size="20" maxlength="20" readonly="readonly" /></td>
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
          <script type='text/JavaScript' src="../Calendar/scw.js" ></script>
		
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
	if(x[2]=='08')
	var  newday=parseInt('8')+parseInt(leaveday)+ parseInt(restday);
	else
	if(x[2]=='09')
	var  newday=parseInt('9')+parseInt(leaveday)+ parseInt(restday);
	else
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
     <li><a href="#"><?php echo $obj_lang->get('Tools', $lang); ?></a>
       <ul>
         <li><a href="javascript:popup('Calendar/CalendarConvertor.html')"><?php echo $obj_lang->get('Calendar Convertor', $lang); ?></a></li>
         <li><a href="Calendar/GeorgianEthiopianYearlyCalendar.html" target="_blank"><?php echo $obj_lang->get('Calendar', $lang); ?></a></li>
         <li><a href="javascript:popup('Calendar/Time.html')"><?php echo $obj_lang->get('Time', $lang); ?></a></li>
       </ul>
     </li>
     <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Personal Detail', $lang); ?></a>
       <ul>
       <li><a href="../../Recruitment/Probation_Evaluation.php"><?php echo $obj_lang->get('Probation Period Evaluation', $lang); ?></a>       </li>
         <li><a href="../../Personal Record/Employee_Personal_Record.php"><?php echo $obj_lang->get('Personal Detail entry', $lang); ?></a></li>
         <li><a href="../../Database_Update/PersonalRecordDisplay.php" target="_blank"><?php echo $obj_lang->get('Personal Detail Search', $lang); ?></a></li>
         <li><a href="../../Recruitment/Recruitment Data Update/ProbationPersonalRecordDisplay.php" title="Probation Period Personal Record Search" target="_blank"><?php echo $obj_lang->get('Probation Period Record Search', $lang); ?></a></li>
       </ul>
     </li>
     <li><a class="MenuBarItemSubmenu" href="#"><?php echo $obj_lang->get('Employee Status Transaction', $lang); ?></a>
       <ul>
         <li><a href="../../Employee_Status_Transaction/Department_Transfer.php"><?php echo $obj_lang->get('Department Transfer', $lang); ?></a></li>
         <li><a href="../../Employee_Status_Transaction/Promotion.php"><?php echo $obj_lang->get('Promotion', $lang); ?></a></li>
         <li><a href="../../Employee_Status_Transaction/Demotion.php"><?php echo $obj_lang->get('Demotion', $lang); ?></a></li>
         <li><a href="../../Court Case/Court_Case.php"><?php echo $obj_lang->get('Court Case', $lang); ?></a></li>
       </ul>
     </li>
     <li><a target="_blank" href="../../Proclamation/Ethiopian Labour Law Pro.377(English).htm"><?php echo $obj_lang->get('Labour Law Proclamation', $lang); ?></a></li>
     <li><a href="#" class="MenuBarItemSubmenu"> <?php echo $obj_lang->get('HRM System Settings...', $lang); ?></a>
       <ul>
         <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('System Data Setting', $lang); ?></a>
           <ul>
             <li><a href="../../Database_Update/CreatDepartment.php"><?php echo $obj_lang->get('Creat Department', $lang); ?></a></li>
             <li><a href="../../Database_Update/DepartmentDisplay.php" target="_blank"><?php echo $obj_lang->get('Department Data', $lang); ?></a></li>
             <li><a href="../../Recruitment/Recruitment Data Update/RecruitmentDisplay.php" title="Recruitment Data" target="_blank"><?php echo $obj_lang->get('Recruitment Data', $lang); ?></a></li>
<li><a href="../../Recruitment/Recruitment Data Update/ProbationEvaluationDisplay.php" title="Probation Evaluation Data" target="_blank"><?php echo $obj_lang->get('Probation Evalution Data', $lang); ?></a></li>
<li><a href="../../Equipment HandOver/Equipment Handover Database Update/EquipmentHandOverDisplay.php" title="Equipment handover Data" target="_blank"><?php echo $obj_lang->get('Equipment Handover Data', $lang); ?></a></li>
<li><a href="../../Letters/warning Letters/Disciplinary Action Database Update/DisciplinaryDataDisplay.php" title="Disciplinary Action Data" target="_blank"><?php echo $obj_lang->get('Disciplinary Action  Data', $lang); ?></a></li>
<li><a href="../../Employee_Status_Transaction/Employee Status Database Update/PromotionDisplay.php" title="Promotion Data" target="_blank"><?php echo $obj_lang->get('Promotion Data', $lang); ?></a></li>
<li><a href="../../Employee_Status_Transaction/Employee Status Database Update/DemotionDisplay.php" title="Demotion Data" target="_blank"><?php echo $obj_lang->get('Demotion Data', $lang); ?></a></li>
<li><a href="../../Letters/warning Letters/Disciplinary Action Database Update/TerminationDisplay.php" title="Termination Data" target="_blank"><?php echo $obj_lang->get('Termination Data', $lang); ?></a></li>
           </ul>
         </li>
         <li><a href="#"><?php echo $obj_lang->get('Leave Data Setting', $lang); ?></a>
         <ul>
           <li><a href="../../Leaves/Leave Database_Update/AnnualLeaveDisplay.php" title="Annual Leave Data" target="_blank"><?php echo $obj_lang->get('Annual Leave Data', $lang); ?></a></li>
             <li><a href="../../Leaves/Leave Database_Update/AnnualLeaveCalcDisplay.php" title="Annual Leave Calc" target="_blank"><?php echo $obj_lang->get('Annual Leave Calc', $lang); ?></a></li>
             <li><a href="../../Leaves/Leave Database_Update/FuneralLeaveDisplay.php" title="Funeral Leave Data" target="_blank"><?php echo $obj_lang->get('Funeral Leave Data', $lang); ?></a></li>
             <li><a href="../../Leaves/Leave Database_Update/SickLeaveDisplay.php" title="Sick Leave Data" target="_blank"><?php echo $obj_lang->get('Sick Leave Data', $lang); ?></a></li>
             <li><a href="../../Leaves/Leave Database_Update/SpecialLeaveDisplay.php" title="Special Leave Data" target="_blank"><?php echo $obj_lang->get('Special Leave Data', $lang); ?></a></li>
             <li><a href="../../Leaves/Leave Database_Update/MaternityLeaveDisplay.php" title="Maternity Leave Data" target="_blank"><?php echo $obj_lang->get('Maternity Leave Data', $lang); ?></a></li>
             <li><a href="../../Leaves/Leave Database_Update/WeddingLeaveDisplay.php" title="Wedding Leave Data" target="_blank"><?php echo $obj_lang->get('Wedding Leave Data', $lang); ?></a></li>
         </ul></li>
         <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('User account', $lang); ?></a>
           <ul>
             <li><a href="../../User_Account/Creat_Account.php"><?php echo $obj_lang->get('Creat User Account', $lang); ?></a></li>
             <li><a href="../../User_Account/Change_Password.php"><?php echo $obj_lang->get('Change Password', $lang); ?></a></li>
             <li><a href="../../User_Account/Delete_Account.php"><?php echo $obj_lang->get('Delete User Account', $lang); ?></a></li>
           </ul>
     </li>
<li><a href="<?php echo $logoutAction ?>"><?php echo $obj_lang->get('Log Out', $lang); ?></a></li>
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
    <a href="../Proclamation/Ethiopian Labour Law Pro.377(English).htm#a76" target="_blank">Annual Leave Labour Law</a>
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
    <p class="lf">&copy; Copyright ThekeyHRMS.Designed and Developed by <a href="http://www.thekey.com">Thekeysoft ICT Soultion</a> &nbsp;Licensed for Ammerlaan Quality Roses(AQ Roses)</p>
     </div>
  <p align="center"><img src="../../img logo & icons/thekey soft.jpg" width="159" height="37" /><sup ><sup style="font-size:15px">&reg;&trade;</sup></sup></p>
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