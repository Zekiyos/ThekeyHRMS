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
<!-- TinyMCE -->
<script type="text/javascript" src="../jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		skin : "o2k7",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example word content CSS (should be your site CSS) this one removes paragraph margins
		content_css : "css/word.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- /TinyMCE -->
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	
	
				 $count=0;
       			 		$queryDA  = "SELECT * FROM Disciplinary_action where id='".$_GET['ID']."'";
						$resultDA = mysql_query($queryDA);
				while($rowDA = mysql_fetch_array($resultDA, MYSQL_ASSOC))
				{
					
					if ($rowDA['ID'] == $_GET['ID'])
					{
						
					
				$updateDASQL="UPDATE Disciplinary_action SET `Second_Inistance`='". $_POST['Second_Inistance'] ."',`Second_Inistance_Date`='". $_POST['Second_Inistance_Date']."' WHERE ID = '". $_GET['ID'] ."'";	
		mysql_query($updateDASQL);
						
                 $count=1;
					}
				}
				 
				
	
	if($count==0)
	{
	
	
  $insertSQL = sprintf("INSERT INTO disciplinary_action (ID, FirstName, MiddelName, LastName, Department, Second_Inistance,Second_Inistance_Date) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_GET['ID'], "text"),
                       GetSQLValueString($_POST['FirstName'], "text"),
                       GetSQLValueString($_POST['MiddelName'], "text"),
                       GetSQLValueString($_POST['LastName'], "text"),
                       GetSQLValueString($_POST['Department'], "text"),
                       GetSQLValueString($_POST['Second_Inistance'], "text"),
					   GetSQLValueString($_POST['Second_Inistance_Date'], "text"));

  mysql_select_db($database_HRMS, $HRMS);
  $Result1 = mysql_query($insertSQL, $HRMS) or die(mysql_error());
	}
}

mysql_select_db($database_HRMS, $HRMS);
$query_RSFristWarniing = "SELECT * FROM employee_personal_record";
$RSFristWarniing = mysql_query($query_RSFristWarniing, $HRMS) or die(mysql_error());
$row_RSFristWarniing = mysql_fetch_assoc($RSFristWarniing);
$totalRows_RSFristWarniing = mysql_num_rows($RSFristWarniing);
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
<script src="../../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<link href="../../SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="headerspace"></div>
<div id="wrrapper">

<div id="header">
<div id="headerAdvert">
    <H2 ><font  size="20" >Thekey</font><span id="headerAdvert"><font color="#999999" size="20" >HRMS</font><font color="#999999" size="3" ><span id="result_box3" lang="nl" xml:lang="nl"><span title="Click for alternate translations">Brengen</span> <span title="Click for alternate translations">ICT-</span><span title="Click for alternate translations">oplossing voor</span> <span title="Click for alternate translations">uw</span> <span title="Click for alternate translations">behoefte</span></span>.</font></span><font color="#999999" size="3" ><span id="result_box4" lang="nl" xml:lang="nl"><span title="Click for alternate translations">De</span> <span title="Click for alternate translations">sleutel</span> <span title="Click for alternate translations">is aan jou</span></span>! </font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../../../index.php"><img src="../../flags/United Kingdom flag.png" width="35" height="25" /></a><a href="../../../Amharic/index.php"><img border="0" src="../../flags/Ethiopiaflag.jpg" alt="Amharic(ETH)" width="35" height="30" /></a><a href="../../index.php"><img src="../../flags/Netherlands-Flag-icon.png" width="35" height="25" /></a></h2>
    <H2 ><font color="#999999" size="+5" ></font><img src="../../../img logo &amp; icons/logo.jpg" alt="He that hath  THE KEY  of David,  he that openeth,  and  no man shutteth;  and shutteth,  and no man openeth;" width="100" height="40" />
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
            <li><a href="../../Recriutment/Recruitment.php">Werving vorm</a></li>
            <li><a href="../../Equipment HandOver/Equipment_HandOver.php">Apparatuur Handover</a></li>
          </ul>
        </li>
        <li><a href="../../Personal Record/Personal_Information_Detail.php">Persoonlijke Informatie</a></li>
        <li><a href="#" class="MenuBarItemSubmenu"><span id="result_box2" lang="nl" xml:lang="nl"><span title="Click for alternate translations">Verlof</span></span></a>
          <ul>
            <li><a href="#" class="MenuBarItemSubmenu">Jaarlijks verlof</a>
              <ul>
                <li><a href="../../Leaves/Annual_Leave_Grant.php">Jaarlijks verlof Grant vorm</a></li>
                <li><a href="../../Leaves/Annual_Leave_Calculate.php">Run Jaarlijks verlof Berekening</a></li>
              </ul>
            </li>
            <li><a href="../../Leaves/Funeral_Leave_Grant.php">Laat begrafenis</a></li>
            <li><a href="../../Leaves/Maternity_Leave_Grant.php">Zwangerschapsverlof</a></li>
            <li><a href="../../Leaves/Sick_Leave_Grant.php">Sick Leave</a></li>
            <li><a href="../../Leaves/Wedding_Leave_Grant.php">Laat bruiloft</a></li>
            <li><a href="../../Leaves/Back_From_Leave_Report.php">Back to Work Report</a></li>
          </ul>
        </li>
        <li><a class="MenuBarItemSubmenu" href="#">Disciplinaire maatregelen</a>
          <ul>
            <li><a href="Verbal_Warning.php">Mondelinge waarschuwing</a>            </li>
            <li><a href="#">Salaris bestraffing</a></li>
            <li><a href="#" class="MenuBarItemSubmenu">Schriftelijke waarschuwing</a>
              <ul>
                <li><a href="First_Instance_Warning.php">1 aanleg Waarschuwing</a></li>
                <li><a href="Second_Instance_Warning.php">2 aanleg Waarschuwing</a></li>
                <li><a href="Third_Instance_Warning.php">3 aanleg Waarschuwing</a></li>
                <li><a href="Last_Warning.php">Laatste waarschuwing</a></li>
</ul>
            </li>
            <li><a href="#" class="MenuBarItemSubmenu">Beëindiging</a>
              <ul>
                <li><a href="Termination.php">Beëindiging Formulier</a></li>
                <li><a href="#">Opzeggingsbrief</a></li>
              </ul>
            </li>
            <li><a href="javascript: if (confirm('Are You Sure You want to remove Expired Warning?')) { window.location.href='../Dutch/Letters/warning Letters/Expired_Warning_Remover.php' } else { void('') }; ">verstreken Waarschuwing Remover</a></li>
          </ul>
        </li>
        <li><a target="_blank" href="http://localhost/Report/annual_leaverpt.php">Verslag</a></li>
        <li><a href="#" class="MenuBarItemSubmenu">Contract</a>
          <ul>
            <li><a href="../Contract Letters/Permanent_Contract_Letter.php">Dienstverband voor onbepaalde tijd</a></li>
          </ul>
        </li>
        <li><a href="#" class="MenuBarItemSubmenu">Voordelen</a>
          <ul>
            <li><a href="../../Medical/Medical_Referral.php">Medische verwijzing van</a></li>
            <li><a href="../../Training/Training.php">Training</a></li>
          </ul>
        </li>
</ul>

      </div>
  </div>
  <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" -->
 <?php  include("Select_ID4SecondInstanceWarning.php");
	 ?> <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table width="706" align="center">
     <tr valign="baseline">
      <td nowrap="nowrap" align="right">FirstName:</td>
      <td><input type="text" name="FirstName" value="<?php
            
       			 		$query  = "SELECT * FROM employee_personal_record";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					 if(isset($_GET['ID'] )){
					if ($row['ID'] == $_GET['ID'])
					{
						
					echo "{$row['FirstName']}";
					
					}
					
				}
				}?>" size="20" readonly="readonly"  />MiddelName:<input type="text" name="MiddelName" value="<?php
            
       			 		$query  = "SELECT * FROM employee_personal_record";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					 if(isset($_GET['ID'] )){	
					if ($row['ID'] == $_GET['ID'])
					{
						
					echo "{$row['MiddelName']}";
					
					}
					
				}
				}?>" readonly="readonly" size="20" />
        LastName:
        <input type="text" name="LastName" value="<?php
            
       			 		$query  = "SELECT * FROM employee_personal_record";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					 if(isset($_GET['ID'] )){	
					if ($row['ID'] == $_GET['ID'])
					{
						
					echo "{$row['LastName']}";
					
					}
					
				}
				}?>"  readonly="readonly" size="20" /></td>
    </tr>
      <tr valign="baseline">
      <td nowrap="nowrap" align="right">Department</td>
      <td>:        <input type="text" name="Department" value="<?php
            
       			 		$query  = "SELECT * FROM employee_personal_record";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					 if(isset($_GET['ID'] )){	
					if ($row['ID'] == $_GET['ID'])
					{
						
					echo "{$row['Department']}";
					
					}
					
				}
				}?>"  readonly="readonly" size="32" /><script type='text/JavaScript' src="../../../Calender/scw.js" ></script>
		Date:<input type="text" name="Second_Inistance_Date" onclick='scwShow(this,event);' value='<?php echo date("Y-m-d");?>' /></td>
    </tr>
    
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top"><p>Sample First <br />Inistance Warning<br /> Letter</td>
      <td><textarea name="Second_Inistance" cols="70" rows="30">
     
     
      <?php
            
       			 		$query  = "SELECT * FROM employee_personal_record";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					 if(isset($_GET['ID'] )){	
					if ($row['ID'] == $_GET['ID'])
					{
						
					echo "<br><b><font size=\"+3\">"."Full Name:"."{$row['FirstName']}";
					echo " {$row['MiddelName']}";
					echo " {$row['LastName']}"."</br></b></font>";
					}
					
				}
				}?>
      <br />First Inistance Warning
      Content
      <font face="Power Geez Unicode2" size="+4" >
      የመጀመሪያ ማስጠንቀቂያ
      </font>
  
      
      </textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><blockquote><blockquote><input type="reset" name="reset" value="Reset" />
        <input type="submit" value="Issue This Letter" onClick="return confirm('Are you sure you want to This Letter for this Employee?')" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
 </form>

<script type="text/javascript">
if (document.location.protocol == 'file:') {
	alert("The examples might not work properly on the local file system due to security settings in your browser. Please use a real webserver.");
}
</script>
    <!-- InstanceEndEditable -->
    <blockquote>&nbsp;</blockquote>
  </div>
  <div id="sidebar">
    <div id="sidemenu">
    
   <ul id="MenuBar2" class="MenuBarVertical">
     <li><a href="../../Recriutment/Probation_Evaluation.php">Proeftijd Evaluatie</a>       </li>
     <li><a href="#" class="MenuBarItemSubmenu">Persoonlijke Detail</a>
       <ul>
         <li><a href="../../Personal Record/Employee_Personal_Record.php">Persoonlijke Detail Entry</a></li>
         <li><a href="../../../Database_Update/PersonalRecordDisplay.php" target="_blank">Persoonlijke Record Search</a></li>
       </ul>
     </li>
     <li><a href="#" class="MenuBarItemSubmenu">De status van werknemer Transactie</a>
       <ul>
         <li><a href="../../Employee_Status_Transaction/Promotion.php">Promotie</a></li>
         <li><a href="../../Employee_Status_Transaction/Demotion.php">Demotie</a></li>
         <li><a href="../../Employee_Status_Transaction/Department_Transfer.php">Afdeling Transfer</a></li>
       </ul>
     </li>
<li><a href="../../Proclamation/Ethiopian Labour Law Pro.377(Dutch).htm" target="_blank">Arbeidsrecht Proclamatie</a></li>
     <li><a href="#" class="MenuBarItemSubmenu"> HRM-systeem Instellingen ...</a>
       <ul>
<li><a href="#" class="MenuBarItemSubmenu">Gebruikersaccount</a>
  <ul>
    <li><a href="../../../User_Account/Creat_Account.php">Maak Gebruikersaccount</a></li>
    <li><a href="../../../User_Account/Change_Password.php">Wachtwoord wijzigen</a></li>
    <li><a href="../../../User_Account/Delete_Account.php">Verwijderen Gebruikersaccount</a></li>
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
        <p>&nbsp;</p>
        <br />
    <br />
    <br />
    <br />
        <?php include ("../../Notifications/ALNotification.php"); ?>
		<?php
mysql_free_result($RSFristWarniing);
?>
        
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