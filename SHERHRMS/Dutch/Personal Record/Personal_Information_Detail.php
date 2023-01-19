<?php include ("../../zoom/zoom.js")?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "admin";
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
$query_RSPersonalRecord = "SELECT * FROM employee_personal_record";
$RSPersonalRecord = mysql_query($query_RSPersonalRecord, $HRMS) or die(mysql_error());
$row_RSPersonalRecord = mysql_fetch_assoc($RSPersonalRecord);
$totalRows_RSPersonalRecord = mysql_num_rows($RSPersonalRecord);

mysql_select_db($database_HRMS, $HRMS);
$query_RSAL4PersonalInfoDetail = "SELECT * FROM annual_leave_detail";
$RSAL4PersonalInfoDetail = mysql_query($query_RSAL4PersonalInfoDetail, $HRMS) or die(mysql_error());
$row_RSAL4PersonalInfoDetail = mysql_fetch_assoc($RSAL4PersonalInfoDetail);
$totalRows_RSAL4PersonalInfoDetail = mysql_num_rows($RSAL4PersonalInfoDetail);

mysql_select_db($database_HRMS, $HRMS);
$query_RSDIsciplinaryAction = "SELECT * FROM disciplinary_action";
$RSDIsciplinaryAction = mysql_query($query_RSDIsciplinaryAction, $HRMS) or die(mysql_error());
$row_RSDIsciplinaryAction = mysql_fetch_assoc($RSDIsciplinaryAction);
$totalRows_RSDIsciplinaryAction = mysql_num_rows($RSDIsciplinaryAction);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Dutch_Template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thekey HRMS in Dutch</title>
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
	float: right;
}
#sidecontent {
	color: #F60;
	height: 430px;
	width: 120px;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	float: right;
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
	height: 1200px;
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
</head>

<body>
<div id="headerspace"></div>
<div id="wrrapper">

<div id="header">
<div id="headerAdvert">
    <H2 ><font  size="20" >Thekey</font><span id="headerAdvert"><font color="#999999" size="20" >HRMS</font><font color="#999999" size="3" ><span id="result_box3" lang="nl" xml:lang="nl"><span title="Click for alternate translations">Brengen</span> <span title="Click for alternate translations">ICT-</span><span title="Click for alternate translations">oplossing voor</span> <span title="Click for alternate translations">uw</span> <span title="Click for alternate translations">behoefte</span></span>.</font></span><font color="#999999" size="3" ><span id="result_box4" lang="nl" xml:lang="nl"><span title="Click for alternate translations">De</span> <span title="Click for alternate translations">sleutel</span> <span title="Click for alternate translations">is aan jou</span></span>! </font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../../index.php"><img src="../flags/United Kingdom flag.png" width="35" height="25" /></a><a href="../../Amharic/index.php"><img border="0" src="../flags/Ethiopiaflag.jpg" alt="Amharic(ETH)" width="35" height="30" /></a><a href="../index.php"><img src="../flags/Netherlands-Flag-icon.png" width="35" height="25" /></a></h2>
    <H2 ><font color="#999999" size="+5" ></font><img src="../../img logo &amp; icons/logo.jpg" alt="He that hath  THE KEY  of David,  he that openeth,  and  no man shutteth;  and shutteth,  and no man openeth;" width="100" height="40" />
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#FF6600" size="6"> De mens Bron management Het systeem</font>
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
<li><a href="#">Home</a>        </li>
        <li><a href="#" class="MenuBarItemSubmenu"><span id="result_box" lang="nl" xml:lang="nl"><span title="Click for alternate translations">Aanwerving</span></span></a>
          <ul>
            <li><a href="../Recriutment/Recruitment.php">Werving vorm</a></li>
            <li><a href="../Equipment HandOver/Equipment_HandOver.php">Apparatuur Handover</a></li>
          </ul>
        </li>
        <li><a href="Personal_Information_Detail.php">Persoonlijke Informatie</a></li>
        <li><a href="#" class="MenuBarItemSubmenu"><span id="result_box2" lang="nl" xml:lang="nl"><span title="Click for alternate translations">Verlof</span></span></a>
          <ul>
            <li><a href="#" class="MenuBarItemSubmenu">Jaarlijks verlof</a>
              <ul>
                <li><a href="../Leaves/Annual_Leave_Grant.php">Jaarlijks verlof Grant vorm</a></li>
                <li><a href="../Leaves/Annual_Leave_Calculate.php">Run Jaarlijks verlof Berekening</a></li>
              </ul>
            </li>
            <li><a href="../Leaves/Funeral_Leave_Grant.php">Laat begrafenis</a></li>
            <li><a href="../Leaves/Maternity_Leave_Grant.php">Zwangerschapsverlof</a></li>
            <li><a href="../Leaves/Sick_Leave_Grant.php">Sick Leave</a></li>
            <li><a href="../Leaves/Wedding_Leave_Grant.php">Laat bruiloft</a></li>
            <li><a href="../Leaves/Back_From_Leave_Report.php">Back to Work Report</a></li>
          </ul>
        </li>
        <li><a class="MenuBarItemSubmenu" href="#">Disciplinaire maatregelen</a>
          <ul>
            <li><a href="../Letters/warning Letters/Verbal_Warning.php">Mondelinge waarschuwing</a>            </li>
            <li><a href="#">Salaris bestraffing</a></li>
            <li><a href="#" class="MenuBarItemSubmenu">Schriftelijke waarschuwing</a>
              <ul>
                <li><a href="../Letters/warning Letters/First_Instance_Warning.php">1 aanleg Waarschuwing</a></li>
                <li><a href="../Letters/warning Letters/Second_Instance_Warning.php">2 aanleg Waarschuwing</a></li>
                <li><a href="../Letters/warning Letters/Third_Instance_Warning.php">3 aanleg Waarschuwing</a></li>
                <li><a href="../Letters/warning Letters/Last_Warning.php">Laatste waarschuwing</a></li>
</ul>
            </li>
            <li><a href="#" class="MenuBarItemSubmenu">Beëindiging</a>
              <ul>
                <li><a href="../Letters/warning Letters/Termination.php">Beëindiging Formulier</a></li>
                <li><a href="#">Opzeggingsbrief</a></li>
              </ul>
            </li>
            <li><a href="javascript: if (confirm('Are You Sure You want to remove Expired Warning?')) { window.location.href='../Dutch/Letters/warning Letters/Expired_Warning_Remover.php' } else { void('') }; ">verstreken Waarschuwing Remover</a></li>
          </ul>
        </li>
        <li><a target="_blank" href="http://localhost/Report/annual_leaverpt.php">Verslag</a></li>
        <li><a href="#" class="MenuBarItemSubmenu">Contract</a>
          <ul>
            <li><a href="../Letters/Contract Letters/Permanent_Contract_Letter.php">Dienstverband voor onbepaalde tijd</a></li>
          </ul>
        </li>
        <li><a href="#" class="MenuBarItemSubmenu">Voordelen</a>
          <ul>
            <li><a href="../Medical/Medical_Referral.php">Medische verwijzing van</a></li>
            <li><a href="../Training/Training.php">Training</a></li>
          </ul>
        </li>
</ul>

      </div>
  </div>
  <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" -->
   </p>
    <blockquote>
              
              <p> <font color="#FF3300" size="+1" >Medewerker Persoonlijke Gedetaileerde informatie</font>
                <?php
      echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	 include("Select_FirstName.php");
	  ?>
              </p>
            
       
    </blockquote>
   <blockquote><blockquote><blockquote><blockquote> <blockquote>
   <blockquote><blockquote><blockquote><blockquote> <blockquote>
   <blockquote><blockquote><blockquote><blockquote> <blockquote>
   <input type=button value="Print Out" onclick="PrintContent()" align="right" ></blockquote></blockquote></blockquote></blockquote></blockquote>
   </blockquote></blockquote></blockquote></blockquote></blockquote>
   </blockquote></blockquote></blockquote></blockquote></blockquote>
<script type="text/javascript">
function PrintContent()
    {
        var DocumentContainer = document.getElementById('tblInfo');
        var WindowObject = window.open('', "TrackHistoryData", 
                              "width=740,height=325,top=200,left=250,toolbars=no,scrollbars=yes,status=no,resizable=no");
        WindowObject.document.writeln(DocumentContainer.innerHTML);
        WindowObject.document.close();
        WindowObject.focus();
        WindowObject.print();
        WindowObject.close();
    }
</script>

    <table width="765" height="587" align="center" id="tblInfo">
      <tr valign="baseline" align="left">
      
              <td height="273" width="191" align="left" valign="top" nowrap="nowrap"><img src="../../Employee_Images/<?php
			if( isset( $_GET['ID']))
			 {
	
       			 		$query  = "SELECT * FROM employee_personal_record";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					
					if ($row['ID'] == $_GET['ID'])
					{
						if ($row['Photo'] == NULL )
						  echo "default_profile.png";
						else
					      echo "{$row['Photo']}";
					 
					}
					
				}
				 ?>"  width="185" height="185" alt="<?php echo $row['ID'];?> Photo Not Available" onmouseover="zxcZoom(this,'<?php echo $row['ID'] .".jpg"  ?>',600,500,7,'C');"
    onmouseout="javascript:zxcZoom(this);"   /></td>
<td width="562" align="left" valign="top"><p><font color="#0033FF" size="+1"  face="Times New Roman, Times, serif" ><em>  
          </p>
  
<?php 
if(mysql_num_rows(mysql_query("SELECT * FROM employee_personal_record where ID='".$_GET['ID']."'"))){
	if(mysql_num_rows(mysql_query("SELECT * FROM employee_personal_record where ID='".$_GET['ID']."'"))>1)
	{
	echo "<font color=\"#FF0000\" size=\"+1\"  >Door ID nummer <b>".$_GET['ID']."</b> meer dan een werknemer is zo aanwezig in de database probeert te controleren of zijn id-nummer te veranderen.
</font>";
    }
    else
	{
       			 		$query  = "SELECT * FROM employee_personal_record";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					
					if ($row['ID'] == $_GET['ID'])
					{
					echo "<font color=\"#FF0000\">ID-nummer: {$row['ID']} </font>";
					echo "<span id=\"result_box5\" lang=\"nl\" xml:lang=\"nl\"><span  title=\"Name\"
onmouseover=\"this.style.backgroundColor='#ebeff9'\"
onmouseout=\"this.style.backgroundColor='#fff'\"><br/>Naam</span></span>:";
					echo "{$row['FirstName']}";											
					echo " {$row['MiddelName']}";
					echo " {$row['LastName']}";
					
				 ?>
                 
 werd geboren in <?php echo "{$row['Date_Birth']}";
		echo " , {$row['Age']}"; ?> Years Old.<br />			 		
	<?php $sex=$row['Sex']; 
		
	  echo "{$row['Sex']}<br/>"; ?>
      <?php if($row['Experience']!="")
      { ?> <?php echo "{$row['Experience']} ervaren <br />"; }?>
      <?php if($row['Email']!="")
      { ?> Email: <em>
    <?php echo "{$row['Email']}<br />";} ?>
	   <span title="employeed"onmouseover="this.style.backgroundColor='#ebeff9'"
onmouseout="this.style.backgroundColor='#fff'"> onwerkzaam zijn op</span><em>
    <?php echo "{$row['Date_Employement']}"; ?>
     		
    in
  <?php echo "{$row['Department']}"; ?>  			 		
					
  as
    <?php echo "{$row['Position']}";
       		echo "<br>Maandsalaris ".$row['Salary']." birr";	
								
					}
					
				}
				 ?>
                 
    <?php
	if ( $sex="Male"){$he="he";} else {$he="shezz";}
       			 		$queryAL  = "SELECT * FROM Annual_leave_detail";
						$resultAL = mysql_query($queryAL);
				while($rowAL = mysql_fetch_array($resultAL, MYSQL_ASSOC))
				{
					
					if ($rowAL['ID'] == $_GET['ID'])
					{
	/*					echo "<br>".$he." works for"." {$rowAL['WorkingMonth']}"." months"."("." {$rowAL['WorkingYear']}"." Years)<br>";				
					echo "<blockquote><blockquote><blockquote><u><b>Leave days </b></blockquote></blockquote></blockquote>";					
					echo "<li type=>Last annual leave ".$he." took on"." {$rowAL['ALTaken_Date']}"."<br>";	
					
					echo "<li>Total Number of annnual leave ".$he." left:"." {$rowAL['TotalALLeftdays']}"."<br>";		
					echo "<blockquote><li>from this Year". " {$rowAL['ThisYearALLeft']}"."<br>";
					echo "<li>from Last"." {$rowAL['LastYearALLeft']}"."<br>";
					echo "<li>from Before Last"." {$rowAL['BeforeLastYearALLeft']}"."<br></blockquote>";
					*/
					echo "<br>".$rowAL['FirstName']." werkt voor"." {$rowAL['WorkingMonth']}"." maanden"."("." {$rowAL['WorkingYear']}"." Years)<br>";				
					echo "<blockquote><blockquote><blockquote><u><b>Laat dagen </u></b></blockquote></blockquote></blockquote>";	
									
									
					echo "<li type=>De last jaarlijkse vakantie ".$rowAL['FirstName']." tooks dagen op"." {$rowAL['ALTaken_Date']}"."<br>";	
					
					echo "<li>Totaal aantal van de jaarlijkse vakantie ".$rowAL['FirstName']." links:"." {$rowAL['TotalALLeftdays']}"."<br>";		
					echo "<blockquote><li>van dit jaar". " {$rowAL['ThisYearALLeft']}"."<br>";
					echo "<li>van Last"." {$rowAL['LastYearALLeft']}"."<br>";
					echo "<li>van vóór Laatste"." {$rowAL['BeforeLastYearALLeft']}"."<br></blockquote>";				
					
										
					}
					
				}
				 ?>
                 <?php
				
       			 		$queryAL1  = "SELECT * FROM annual_leave";
						$resultAL1 = mysql_query($queryAL1);
				while($rowAL1 = mysql_fetch_array($resultAL1, MYSQL_ASSOC))
				{
					
					if ($rowAL1['ID'] == $_GET['ID'])
					{
						/*
						echo " <li>Number Of Annual leave " .$he." tooks" ;
						echo " {$rowAL1['Leavedays']} ";
						echo "days on"." {$rowAL1['Leave_Taken_Date']}"."<br/>";
                 */
				 echo " <li>Aantal van de jaarlijkse vakantie " .$rowAL1['FirstName']." tooks" ;
						echo " {$rowAL1['Leavedays']} ";
						echo "dagen op"." {$rowAL1['Leave_Taken_Date']}"."<br/>";
					}
				}
				?>
                 <?php
				
       			 		$querySL  = "SELECT * FROM sick_leave";
						$resultSL = mysql_query($querySL);
				while($rowSL = mysql_fetch_array($resultSL, MYSQL_ASSOC))
				{
					
					if ($rowSL['ID'] == $_GET['ID'])
					{
						//echo " <li>Number Of Sick leave " .$he." tooks" ;
						echo " <li>Aantal van ziekteverlof " .$rowSL['FirstName']." tooks" ;
						echo " {$rowSL['SickLeaveDays']} ";
						echo "op"." {$rowSL['SickLeave_Taken_Date']}";
                 
					}
				}
				?>
                 <?php if($sex="Female")
				 {
					 
       			 		$queryML  = "SELECT * FROM Maternity_leave";
						$resultML = mysql_query($queryML);
				while($rowML = mysql_fetch_array($resultML, MYSQL_ASSOC))
				{
					
					if ($rowML['ID'] == $_GET['ID'])
					{
						
						//echo "<br> <li>Number Of Maternity leave " .$he." tooks" ;
						echo "<br> <li>Aantal van het zwangerschapsverlof " .$rowML['FirstName']." tooks" ;
						
						echo " {$rowML['MaternityLeaveDays']} ";
						echo "op"." {$rowML['MaternityLeave_Taken_Date']}";
                 
					}
				}
				 }
				?>
                <?php 
				 
       			 		$queryFL  = "SELECT * FROM Funeral_leave";
						$resultFL = mysql_query($queryFL);
				while($rowFL = mysql_fetch_array($resultFL, MYSQL_ASSOC))
				{
					
					if ($rowFL['ID'] == $_GET['ID'])
					{
						//echo "<br> <li>Number Of Funeral leave " .$he." tooks" ;
						echo "<br> <li>Aantal van de begrafenis te verlaten " .$rowFL['FirstName']." tooks" ;
						echo " {$rowFL['FuneralLeaveDays']} ";
						echo "op"." {$rowFL['FuneralLeave_Taken_Date']}";
                 
					}
				}
				 
				?>
                <?php 
				 
       			 		$queryWL  = "SELECT * FROM Wedding_leave";
						$resultWL = mysql_query($queryWL);
				while($rowWL = mysql_fetch_array($resultWL, MYSQL_ASSOC))
				{
					
					if ($rowWL['ID'] == $_GET['ID'])
					{
						//echo "<br> <li>Number Of Wedding leave " .$he." tooks" ;
						echo "<br> <li>Aantal vertrekken van de bruiloft " .$rowWL['FirstName']." tooks" ;
						echo " {$rowWL['WeddingLeavedays']} ";
						echo "op"." {$rowWL['WeddingLeave_TakenDate']}";
                 
					}
				}
				 
				?>
                 </p><p>
                 <?php 
       			 		$query  = "SELECT * FROM equipment_handover";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					
					if ($row['ID'] == $_GET['ID'])
					{
					
					
					echo "</u></blockquote></blockquote><blockquote><blockquote><blockquote><b><u>Equipments</u></b></blockquote></blockquote></blockquote><li type=\"circle\">{$row['FirstName']} took ";
					echo "{$row['EquipmentName']} on date {$row['Taken_Date']}.It should be replaced on<font color=\"#FF0000\"> {$row['Replacement_Date']} </font>";
					}
				}
				?></p>
                 <?php 
       			 		$query  = "SELECT * FROM training";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					
					if ($row['ID'] == $_GET['ID'])
					{
					
					
					echo "</u></blockquote></blockquote><blockquote><blockquote><blockquote><b><u>Training</u></blockquote></b></blockquote></blockquote> <li type=\"circle\">{$row['FirstName']} took ";
					echo "{$row['TrainingName']} training from {$row['Training_Start_Date']} to {$row['Training_End_Date']}  and  he/she  {$row['Status']} the training.";
					}
				}
				?>
                 <?php 
				
				 
       			 		$queryDA  = "SELECT * FROM Disciplinary_action where ID='".$_GET['ID']."'";
						$resultDA = mysql_query($queryDA);
				while($rowDA = mysql_fetch_array($resultDA, MYSQL_ASSOC))
				{
					 //echo "<br><blockquote><blockquote><blockquote> <b>Discipline Action </blockquote></blockquote></blockquote> </b>";
					 echo "<blockquote><blockquote><blockquote> <b><u>Disciplinaire maatregelen </u></blockquote></blockquote></blockquote> </b>";
					//echo " ".$he." Receive:- <br>" ;
					echo " ".$rowDA['FirstName']." Ontvangen:- <br>" ;
					if ($rowDA['ID'] == $_GET['ID'])
					{
						
						
						if ( $rowDA['First_Inistance'] != "")
						{
						//echo "<blockquote><blockquote><li type=\"Square\"> First Instance Warning ";
						echo "<blockquote><blockquote><li type=\"Square\"> Eerste aanleg Waarschuwing ";
						}
						 if ( $rowDA['Second_Inistance'] != "")
						{
						//echo "<li type=\"Square\"> Second Instance Warning ";
						echo "<li type=\"Square\"> Tweede aanleg Waarschuwing ";
						}
						 if ( $rowDA['Third_Inistance'] != "")
						{
						//echo "<li type=\"Square\"> Third Instance Warning ";
						 echo "<li type=\"Square\"> Derde aanleg Waarschuwing ";
						}
						 if ( $rowDA['Last_Warning'] != "")
						{
						//echo "<li type=\"Square\"> Last Warning </blockquote></blockquote>";
						echo "<li type=\"Square\"> Laatste waarschuwing </blockquote></blockquote>";
						}
						
						
                 
					}
					
						
				}
				
				 
				?>
               
                  <?php 
       			 		$query  = "SELECT * FROM employee_personal_record";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					
					if ($row['ID'] == $_GET['ID'])
					{
					
					
					//echo "<br></blockquote></blockquote><font color=\"#FF6600\" size=\"+1\">Hard Copy file exist in :";
					echo "<br></blockquote></blockquote><font color=\"#FF6600\" size=\"+1\">Hard Copy bestand bestaan in :";
					echo "{$row['HardCopy_Shelf_No']}</font>";
					}
				}
				?>
	<?php
	}
	}
	else
	if ($_GET['ID']=="X")
	{
	echo "<font color=\"#FF0000\"  ><span title=\"Type the name and click on Display OR Select from the list the name first which you want to see his Personal Information detail.\"onmouseover=\"this.style.backgroundColor='#ebeff9'\"
onmouseout=\"this.style.backgroundColor='#fff'\">Typ de naam in en klik op \"Display\"of kies uit de lijst eerst de naam die u wilt zijn persoonlijke gegevens detail te zien.</span></font> ";
	}
	else
	echo "<font color=\"#FF0000\" size=\"+1\"  >".$_GET['FirstName']." <span title=\"is not in current employee list check the Name you type is whether correctly spelled  or not.OR try to select the name from current employee name list.\"onmouseover=\"this.style.backgroundColor='#ebeff9'\"
onmouseout=\"this.style.backgroundColor='#fff'\">is niet in de huidige medewerker lijst Controleer de naam die u typt correct is of spelt of not.OR proberen om de naam van de huidige naam van de werknemer lijst te selecteren.</font>";

			 }
			 
?>
   
        </td>
      </tr>
           
              
             
            </table>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  <!-- InstanceEndEditable -->
    <blockquote>&nbsp;</blockquote>
  </div>
  <div id="sidebar">
    <div id="sidemenu">
    
   <ul id="MenuBar2" class="MenuBarVertical">
     <li><a href="../Recriutment/Probation_Evaluation.php">Proeftijd Evaluatie</a>       </li>
     <li><a href="#" class="MenuBarItemSubmenu">Persoonlijke Detail</a>
       <ul>
         <li><a href="Employee_Personal_Record.php">Persoonlijke Detail Entry</a></li>
         <li><a href="../../Database_Update/PersonalRecordDisplay.php" target="_blank">Persoonlijke Record Search</a></li>
       </ul>
     </li>
     <li><a href="#" class="MenuBarItemSubmenu">De status van werknemer Transactie</a>
       <ul>
         <li><a href="../Employee_Status_Transaction/Promotion.php">Promotie</a></li>
         <li><a href="../Employee_Status_Transaction/Demotion.php">Demotie</a></li>
         <li><a href="../Employee_Status_Transaction/Department_Transfer.php">Afdeling Transfer</a></li>
       </ul>
     </li>
<li><a href="../Proclamation/Ethiopian Labour Law Pro.377(Dutch).htm" target="_blank">Arbeidsrecht Proclamatie</a></li>
     <li><a href="#" class="MenuBarItemSubmenu"> HRM-systeem Instellingen ...</a>
       <ul>
<li><a href="#" class="MenuBarItemSubmenu">Gebruikersaccount</a>
  <ul>
    <li><a href="../../User_Account/Creat_Account.php">Maak Gebruikersaccount</a></li>
    <li><a href="../../User_Account/Change_Password.php">Wachtwoord wijzigen</a></li>
    <li><a href="../../User_Account/Delete_Account.php">Verwijderen Gebruikersaccount</a></li>
  </ul>
</li>
<li><a href="<?php echo $logoutAction ?>">Afmelden</a></li>
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
    <br />
    <br />
    <br />
    <br />
    <br />
    <?php include ("../Notifications/PersonalDetailEntryNotification.php");?>
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
    <p class="lf">&copy; Copyright ThkeyHRMS.Designed and Developed by <a href="http://www.bluewebtemplates.com">Thekey ICT Soultion</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;Licensed for Company Name</p>
  </div>
  
</div>
<script type="text/javascript">
var MenuBar2 = new Spry.Widget.MenuBar("MenuBar2", {imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"../SpryAssets/SpryMenuBarDownHover.gif", imgRight:"../SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</body>
<!-- InstanceEnd --></html>

<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
<?php
mysql_free_result($RSPersonalRecord);

mysql_free_result($RSAL4PersonalInfoDetail);

mysql_free_result($RSDIsciplinaryAction);
?>
