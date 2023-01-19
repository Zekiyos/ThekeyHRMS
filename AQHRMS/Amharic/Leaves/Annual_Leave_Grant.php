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
	
	//update deatail
	//$CHKAvialNumberAL=0;
	
	
			  $sqlupdate  = "SELECT * FROM employee_personal_record";
					$result = mysql_query($sqlupdate);
						
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					
					if ($row['ID'] == $_GET['ID'])
					{   
					
					$sqlALcalcuate= "SELECT * FROM annual_leave_calculate";
					$resultALcalcuate = mysql_query($sqlALcalcuate);
					
					while($rowALcalcuate = mysql_fetch_array($resultALcalcuate, MYSQL_ASSOC))
				    {
					
					if ($rowALcalcuate['ID'] == $_GET['ID'])
					{
					
			$WorkingMonth=$rowALcalcuate['WorkingMonth'];
			
			$WorkingYear=$rowALcalcuate['WorkingYear'];
			
			$ThisYearALdays=$rowALcalcuate['ThisYearALdays'];
			
			$LastYearALdays=$rowALcalcuate['LastYearALdays'];
			
			$BeforeLastYearALdays=$rowALcalcuate['BeforeLastYearALdays'];
			
			$ALCalculated_Date=$rowALcalcuate['Calculated_Date'];
			
			$TotalALdays=$rowALcalcuate['TotalALdays'];
			
			
			$ALTaken_Date=$_POST['Leave_Taken_Date'];
			
			//$ALTaken= ($rowALcalcuate['ALTaken'] + $_POST['Leavedays']);
						
			$ALTaken=$_POST['Leavedays'];				
			$date=date("Y-m-d");
			
						
			if(($BeforeLastYearALdays - $_POST['Leavedays']) >= 0 )
			{
				$ThisYearALLeft=$ThisYearALdays;
				$LastYearALLeft=$LastYearALdays;
				$BeforeLastYearAlLeft=$BeforeLastYearALdays- $_POST['Leavedays'];
			}
			else
	 if((($BeforeLastYearALdays - $_POST['Leavedays']) < 0 ) and (($LastYearALdays - $BeforeLastYearALdays - $_POST['Leavedays']) >= 0))
	  {
				$ThisYearALLeft=$ThisYearALdays;
				$LastYearALLeft=$LastYearALdays - $BeforeLastYearALdays - $_POST['Leavedays'];
				$BeforeLastYearAlLeft=0;
			
	  }
	 else if((($LastYearALdays - $BeforeLastYearALdays - $_POST['Leavedays']) < 0) and (($ThisYearALdays - $LastYearALdays - $BeforeLastYearALdays - $_POST['Leavedays']) >= 0))
	 {
	  
	            $ThisYearALLeft=($ThisYearALdays - $LastYearALdays - $BeforeLastYearALdays - $_POST['Leavedays']);
				$LastYearALLeft=0;
				$BeforeLastYearAlLeft=0;
	  
	 }
	 else	 
	 {   //$CHKAvialNumberAL=1;
		 echo "<script type=\"text/javascript\">
		  alert('The number of Leave days you have tried to grant is Greater Than this employee total annual leave left');
		  </script>";
		  
		  break 2;
	 }
	 
	 		
			
	  $TotalALLeftdays=$ThisYearALLeft + $LastYearALLeft + $BeforeLastYearAlLeft;
			
			 
		if(mysql_num_rows(mysql_query("SELECT * FROM annual_leave_detail WHERE ID='". $_GET['ID'] ."'"))){ 	 
		 $sqlCHK="SELECT * FROM annual_leave_detail WHERE ID='". $_GET['ID'] ."'";
               $resultsqlCHK =mysql_query($sqlCHK);
			   	 $number=0;			   				          			 		
				//while($rowsqlCHK = mysql_fetch_array($resultsqlCHK, MYSQL_ASSOC))
				//{					
					//if ($rowsqlCHK['ID'] != $_GET['ID'])
					//{
				  
					// updating Employee annual Leave detail
				$updateSQL ="UPDATE annual_leave_detail SET `WorkingMonth`='". $WorkingMonth ."',`WorkingYear`='".$WorkingYear."',`ThisYearALdays`='".$ThisYearALdays."',`LastYearALdays`='".$LastYearALdays."',`BeforeLastYearALdays`='".$BeforeLastYearALdays."',`TotalALdays`='".$TotalALdays."',`AlCalculated_Date` ='".$ALCalculated_Date."',`ThisYearALLeft` ='".$ThisYearALLeft."',`LastYearALLeft`='".$LastYearALLeft."',`BeforeLastYearAlLeft`='".$BeforeLastYearAlLeft."',`TotalALLeftdays`='". $TotalALLeftdays."',`ALTaken`='".$ALTaken."',`ALTaken_Date`='".$ALTaken_Date."' WHERE ID = '". $_GET['ID'] ."'";
					
						mysql_query($updateSQL);					
					 //echo "Updated".$_GET['ID']."<br>". $TotalALLeftdays."".$ThisYearALdays."";
					 
				   
					}
			   else{
		 
		  $FirstName=$row['FirstName'];
				   $MiddelName=$row['MiddelName'];
				   $LastName=$row['LastName'];
				   echo "<script type=\"text/javascript\">
		  //alert('THere is no');
		  </script>";
  $sqlINSTAnnualDetail="INSERT INTO `aqhrmsdb`.`annual_leave_detail` (`Auto_ID`, `ID`, `FirstName`, `MiddelName`, `LastName`,`WorkingMonth`,`WorkingYear`, `ThisYearALdays`, `LastYearALdays`, `BeforeLastYearALdays`, `TotalALdays`,`AlCalculated_Date`, `ThisYearALLeft`, `LastYearALLeft`, `BeforeLastYearAlLeft`, `TotalALLeftdays`, `ALTaken`, `ALTaken_Date`) VALUES (NULL,'".$_GET['ID']."','".$FirstName."','".$MiddelName."','".$LastName."',".$WorkingMonth.",".$WorkingYear.",". $ThisYearALdays.",". $LastYearALdays.",".$BeforeLastYearALdays.",".$TotalALdays .",".$ALCalculated_Date.", ".$ThisYearALLeft.",".$LastYearALLeft.",".$BeforeLastYearAlLeft.",".$TotalALLeftdays.",".$ALTaken.",'".$ALTaken_Date."'".")";
				//if not exist in annual leave table deatil it will be inserted
				 mysql_query($sqlINSTAnnualDetail);
			   }
					
				//}
			   
					}
					
			   }
			}
		}
	
	
	// updating Employee annual Leave detail end
	
	//if($CHKAvialNumberAL=0)
	//{
	
  $insertSQL = sprintf("INSERT INTO annual_leave (ID, FirstName, MiddelName, LastName, Leavedays,Restday,Leave_taken_Date,ReportOn) VALUES (%s, %s, %s, %s, %s,%s,%s, %s)",
                       GetSQLValueString($_GET['ID'], "text"),
                       GetSQLValueString($_POST['FirstName'], "text"),
                       GetSQLValueString($_POST['MiddelName'], "text"),
                       GetSQLValueString($_POST['LastName'], "text"),
                       GetSQLValueString($_POST['Leavedays'], "int"),
					   GetSQLValueString($_POST['Restday'], "int"),
					   GetSQLValueString($_POST['Leave_Taken_Date'], "date"),
                       GetSQLValueString($_POST['ReportOn'], "date"));

  mysql_select_db($database_HRMS, $HRMS);
  $Result1 = mysql_query($insertSQL, $HRMS) or die(mysql_error());
	//}
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Amharic_Template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thekey HRMS in Amharic</title>
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
	height: 1500px;
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
	text-decoration: underline;
}
a {
	font-size: 16px;
}
</style>
<script src="../../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<link href="../../SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="../../img logo &amp; icons/favicon.ico" >
<link rel="icon" href="../../img logo &amp; icons/animated_favicon.gif" type="image/gif" >
</head>

<body>
<div id="headerspace"></div>
<div id="wrrapper">

<div id="header">
<div id="headerAdvert">
    <H2 ><font  size="20" >Thekey</font><span id="headerAdvert"><font color="#999999" size="20" >HRMS</font><font color="#999999" size="3" >    Bringing ICT Solution to Your need.</font>  </span> <font color="#999999" size="3" >The key is yours!! </font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../../index.php"><img src="../../flags/United Kingdom flag.png" width="35" height="25" /></a><a href="../index.php"><img src="../../flags/Ethiopiaflag.jpg" width="35" height="30" /></a><a href="../../Dutch/index.php"><img src="../../flags/Netherlands-Flag-icon.png" width="35" height="25" /></a></h2>
    <H2 ><font color="#999999" size="+5" ></font><img src="../../img logo &amp; icons/logo.jpg" alt="He that hath  THE KEY  of David,  he that openeth,  and  no man shutteth;  and shutteth,  and no man openeth;" width="100" height="40" />
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#FF6600" size="6"><span style="font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#FFFFF">  የሰው  ሀይል  አስተዳደር  ሲስተም </span></font>
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
<li><a href="../index.php"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">መግቢያ</span></a>        </li>
        <li><a href="../Recruitment/Recruitment.php" class="MenuBarItemSubmenu"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">ቅጥር</span></a>
          <ul>
            <li><a href="../Recruitment/Recruitment.php"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">የቅጥር ቅጽ</span></a></li>
            <li><a href="../Equipment HandOver/Equipment_HandOver.php">እቃ ርክክብ </a></li>
          </ul>
        </li>
        <li><a href="../Personal Record/Personal_Information_Detail.php"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">የግል ማሕደር</span></a></li>
        <li><a href="#" class="MenuBarItemSubmenu"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">ፍቃድ</span></a>
          <ul>
            <li><a href="#" class="MenuBarItemSubmenu"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">የአመት ፍቃድ</span></a>
              <ul>
                <li><a href="Annual_Leave_Grant.php"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">የአመት ፍቃድ</span></a></li>
                <li><a href="Annual_Leave_Calculate.php"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">	የአመት ፍቃድ አስላ</span></a></li>
              </ul>
            </li>
            <li><a href="Funeral_Leave_Grant.php"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">የቀብር ፈቃድ</span></a></li>
            <li><a href="Maternity_Leave_Grant.php"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">የወሊድ ፍቃድ</span></a></li>
            <li><a href="Sick_Leave_Grant.php"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">የሕመም ፍቃድ</span></a></li>
            <li><a href="Wedding_Leave_Grant.php"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">የጋብቻ ፍቃድ</span></a></li>
            <li><a href="Back_From_Leave_Report.php">ወደሥራ መመለሱን ማሳወቂያ</a></li>
          </ul>
        </li>
        <li><a class="MenuBarItemSubmenu" href="#"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">መስጠንቀቂያ</span></a>
          <ul>
            <li><a href="../Letters/warning Letters/Verbal_Warning.php"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">የቃል መስጠንቀቂያ</span></a>            </li>
            <li><a href="#"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">የደመወዝ  ቅጣት</span></a></li>
            <li><a href="#" class="MenuBarItemSubmenu"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">የጽሑፍ መስጠንቀቂያ</span></a>
              <ul>
                <li><a href="../Letters/warning Letters/First_Instance_Warning.php"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE"><span style="font-size:10.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">	የመጀመሪያ መስጠንቀቂያ </span> </span></a></li>
                <span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">
                  <li><a href="../Letters/warning Letters/Second_Instance_Warning.php"><span style="font-size:10.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">	ሁለተኛ መስጠንቀቂያ </span></a></li>
                  <li><a href="../Letters/warning Letters/Third_Instance_Warning.php"><span style="font-size:10.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">ሶስተኛ መስጠንቀቂያ</span></a></li>
                  <li><a href="../Letters/warning Letters/Last_Warning.php"><span style="font-size:10.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">የመጨረሻ መስጠንቀቂያ</span></a></li>
</span>
              </ul>
            </li>
            <li><a href="#" class="MenuBarItemSubmenu"><span style="font-size:10.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">ሠንብት</span></a>
              <ul>
                <li><a href="../Letters/warning Letters/Termination.php"><span style="font-size:10.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">ሠንብት  ቅጽ</span></a></li>
                <li><a href="#"><span style="font-size:10.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">ሠንብት ደብዳቤ</span></a></li>
              </ul>
            </li>
            <li><a href="javascript: if (confirm('Are You Sure You want to remove Expired Warning?')) { window.location.href='../Amharic/Letters/warning Letters/Expired_Warning_Remover.php' } else { void('') }; ">ጊዜው ያለፈበትን ማስጠንቀቂያ መስወገጃ</a></li>
            <li><a href="../Letters/warning Letters/Warning_Letters_Viewer.php">ማስጠንቀቂያ ደብዳቤ ማሳያ</a></li>
          </ul>
        </li>
        <li><a href="http://localhost/Report/annual_leaverpt.php#" target="_blank"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">ሪፖርታዥ</span></a></li>
        <li><a href="#" class="MenuBarItemSubmenu"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">ውል</span></a>
          <ul>
            <li><a href="../Letters/Contract Letters/Permanent_Contract_Letter.php"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">የቆሚ ቅጥር ውል</span></a></li>
          </ul>
        </li>
        <li><a href="#" class="MenuBarItemSubmenu"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">ጥቅማ ጥቅም</span></a>
          <ul>
            <li><a href="../Medical/Medical_Referral.php"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">የህክምና መላኪያ</span></a></li>
            <li><a href="../Training/Training.php">ስልጠና</a></li>
          </ul>
        </li>
</ul>

      </div>
  </div>
  <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" -->
 
      <blockquote>
        <blockquote>
          <blockquote>
            <blockquote>
              <blockquote>
              <p class="active">
       
    <font color="#FF6600" size="+1">  የአመት ፍቃድ መስጫ ቅጽ </font>        
	

                  <?php include("Select_ID4AnnualLeaveGrant.php");?>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    
      <table width="400" height="462" align="center" background="" bgcolor="#EBEBEB">
        <tr valign="baseline">
          <td width="128" align="right" nowrap="nowrap">መ.ቁጥር:</td>
          <td width="385">
     <input value="<?php echo $_GET['ID']; ?>" size="10" readonly="readonly"  />     
        </td>
        </tr>
        
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">ስም :</td>
          <td align="left"><input name="FirstName" type="text" value="<?php
            
       			 		$query  = "SELECT * FROM employee_personal_record";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					if($_GET['ID'] =="")
			    {
					$_GET['ID']="SH-4444";
				}
					if ($row['ID'] == $_GET['ID'])
					{
						
					echo "{$row['FirstName']}";
					
					}
					
				}
				 ?>"  
          
          
          size="20" maxlength="20" readonly="readonly" align="left" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">የአባት ስም :</td>
          <td><input name="MiddelName" type="text" value="<?php
            
       			 		$query  = "SELECT * FROM employee_personal_record";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					if($_GET['ID'] =="")
			    {
					$_GET['ID']="SH-4444";
				}
					if ($row['ID'] == $_GET['ID'])
					{
					echo "{$row['MiddelName']}";
					}
					
				}
				 ?>"size="20" maxlength="20" readonly="readonly" /></td>
        </tr>
        <tr valign="baseline">
          <td  align="right" nowrap="nowrap">የአያት ስም  :</td>
          <td><input name="LastName" type="text" value="<?php
            
       			 		$query  = "SELECT * FROM employee_personal_record";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					if($_GET['ID'] =="")
			    {
					$_GET['ID']="SH-4444";
				}
					if ($row['ID'] == $_GET['ID'])
					{
					echo "{$row['LastName']}";
					}
					
				}
				 ?>" size="20" maxlength="20" readonly="readonly" /></td>
        </tr>
        <tr valign="baseline">
          <td  align="right" nowrap="nowrap">የአመት እረፍት ቀን :</td>
          <td>
            <input name="Leavedays" type="text" value="" size="5" maxlength="4" />
          </td>
        </tr>
        <tr valign="baseline">
          <td  align="right" nowrap="nowrap">የእረፍት ቀን :</td>
          <td>
            <input name="Restday" type="text" value="" size="5" maxlength="4" />
          </td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">የእረፍት የወሰደበት ቀን :</td>
          <td><input type="text" name="Leave_Taken_Date" value="<?php echo date("Y-m-d"); ?>" size="15" readonly="readonly" />

</td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">መመለሻ ቀን:</td>
          <td><script type='text/JavaScript' src="../../Calendar/scw.js" ></script>
		
		<input type="text" name="ReportOn" onclick='scwShow(this,event);' value='<?php echo date("Y-m-d");?>' />
        
</td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td><input type="submit" value="Grant" onclick="return confirm('Are you sure you want to Grant Annual Leave for this Employee?')"   /></td>
        </tr>
      </table>
      </font>
      <p>
        <input type="hidden" name="MM_insert" value="form1" />
      </p>
      
    </form>
        
    
  <!-- InstanceEndEditable -->
    <blockquote>&nbsp;</blockquote>
  </div>
  <div id="sidebar">
    <div id="sidemenu">
    
   <ul id="MenuBar2" class="MenuBarVertical">
     <li><a href="../../Recruitment/Probation_Evaluation.php"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">የጊዜዊ ሰራተኛ መገምግሚያ</span></a>       </li>
     <li><a href="#" class="MenuBarItemSubmenu"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">የግለ ማሕደር ቅጽ</span></a>
       <ul>
         <li><a href="../Personal Record/Employee_Personal_Record.php">የግለ ማሕደር ቅጽ</a></li>
         <li><a href="../../Database_Update/PersonalRecordDisplay.php" target="_blank">የግለ ማሕደር መፈለጊያ</a></li>
       </ul>
     </li>
     <li><a href="../Proclamation/Ethiopian Labour Law Pro.377-2003 Amharic and English.htm" target="_blank"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">ስለ አሠሪና ሠራተኛ የወጣ አዋጅ</span></a></li>
     <li><a href="#" class="MenuBarItemSubmenu"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">የሰራተኛ ሁናቴ ለውጥ</span></a>
       <ul>
         <li><a href="../Employee_Status_Transaction/Promotion.php">የደረጃ እድገት </a></li>
         <li><a href="../Employee_Status_Transaction/Demotion.php">የደረጃ ቅነሳ </a></li>
         <li><a href="../Employee_Status_Transaction/Department_Transfer.php">የሥራ  ክፍል ዝውውር </a></li>
       </ul>
     </li>
<li><a href="#" class="MenuBarItemSubmenu"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">ሰሀአ ሲስተም ይሁንታ...</span></a>
  <ul>
<li><a href="#" class="MenuBarItemSubmenu">ተጠቃሚ</a>
  <ul>
    <li><a href="../../User_Account/Creat_Account.php">ተጠቃሚ ፍጠር </a></li>
    <li><a href="../../User_Account/Change_Password.php">የይለፍ ቃል መለወጫ</a></li>
    <li><a href="../../User_Account/Delete_Account.php">ተጠቃሚ መሰረዣ </a></li>
  </ul>
</li>
<li><a href="<?php echo $logoutAction ?>">ውጣ</a></li>
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
    <a href="../Proclamation/Ethiopian Labour Law Pro.377-2003 Amharic and English.htm#a72" target="_blank">ስለ አመት ዕረፍት አዋጅ</a>
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
    <p class="lf">&copy; Copyright ThkeyHRMS.Designed and Developed by <a href="http://www.bluewebtemplates.com">Thekey ICT Soultion</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;Licensed for Company Name</p>
  </div>
  
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