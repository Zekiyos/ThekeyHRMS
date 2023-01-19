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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE employee_personal_record SET ID=%s, FirstName=%s, MiddelName=%s, LastName=%s, Date_Birth=%s, Place_Birth=%s, Age=%s, Sex=%s, Email=%s, Date_Employement=%s, Department=%s, `Position`=%s, Educational_Status=%s, Salary=%s, Martial_Status=%s, Children_number=%s, Name_Child=%s, Age_Child=%s, Sex_Child=%s, Photo=%s, Image=%s, Experience=%s, HardCopy_Shelf_No=%s,ModifiedBy=%s WHERE Auto_ID=%s",
                       GetSQLValueString($_POST['ID'], "text"),
                       GetSQLValueString($_POST['FirstName'], "text"),
                       GetSQLValueString($_POST['MiddelName'], "text"),
                       GetSQLValueString($_POST['LastName'], "text"),
                       GetSQLValueString($_POST['Date_Birth'], "date"),
                       GetSQLValueString($_POST['Place_Birth'], "text"),
                       GetSQLValueString($_POST['Age'], "int"),
                       GetSQLValueString($_POST['Sex'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['Date_Employement'], "date"),
                       GetSQLValueString($_POST['Department'], "text"),
                       GetSQLValueString($_POST['Position'], "text"),
                       GetSQLValueString($_POST['Educational_Status'], "text"),
                       GetSQLValueString($_POST['Salary'], "int"),
                       GetSQLValueString($_POST['Martial_Status'], "text"),
                       GetSQLValueString($_POST['Children_number'], "int"),
                       GetSQLValueString($_POST['Name_Child'], "text"),
                       GetSQLValueString($_POST['Age_Child'], "text"),
                       GetSQLValueString($_POST['Sex_Child'], "text"),
                       GetSQLValueString($_POST['Photo'], "text"),
                       GetSQLValueString($_POST['Image'], "text"),
                       GetSQLValueString($_POST['Experience'], "text"),
                       GetSQLValueString($_POST['HardCopy_Shelf_No'], "text"),
					                          GetSQLValueString($_SESSION['MM_Username'],"text"),
                       GetSQLValueString($_POST['Auto_ID'], "int"));

  mysql_select_db($database_HRMS, $HRMS);
  $Result1 = mysql_query($updateSQL, $HRMS) or die(mysql_error());
}

mysql_select_db($database_HRMS, $HRMS);
if(isset($_GET['Auto_ID']))
{

$query_RSPersonalRecordUpdate = "SELECT * FROM employee_personal_record where Auto_ID=".$_GET['Auto_ID']."";}else
$query_RSPersonalRecordUpdate = "SELECT * FROM employee_personal_record where Auto_ID=-1";
$RSPersonalRecordUpdate = mysql_query($query_RSPersonalRecordUpdate, $HRMS) or die(mysql_error());
$row_RSPersonalRecordUpdate = mysql_fetch_assoc($RSPersonalRecordUpdate);
$totalRows_RSPersonalRecordUpdate = mysql_num_rows($RSPersonalRecordUpdate);

?>
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
                <li><a href="../Leaves/Annual_Leave_Grant.php">Annual Leave Grant</a></li>
</ul>
            </li>
            <li><a href="../Leaves/Funeral_Leave_Grant.php">Funeral Leave</a></li>
            <li><a href="../Leaves/Maternity_Leave_Grant.php">Maternity Leave</a></li>
            <li><a href="../Leaves/Paternity_Leave_Grant.php">Paternity Leave</a></li>
            <li><a href="../Leaves/Sick_Leave_Grant.php">Sick Leave</a></li>
            <li><a href="../Leaves/Special_Leave_Grant.php">Special Leave</a></li>
<li><a href="../Leaves/Wedding_Leave_Grant.php">Wedding Leave</a></li>
            <li><a href="../Leaves/Back_From_Leave_Report.php">Back to Work Report</a></li>
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
        <li><a target="_blank" href="http://localhost/Report/annual_leaverpt.php">Report</a></li>
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
            <li><a href="../Training/Training.php">Training</a></li>
          </ul>
        </li>
</ul>
<?php echo "<font face=\"Times New Roman, Times, serif\" size=\"+1\"><b>loged in as ".$_SESSION['MM_Username']."</b></font>";  ?>
      </div>
  </div>
  <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" -->
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
Employee Personal Record Update Form
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">ID:</td>
      <td><input type="text" id="ID" name="ID" value="<?php echo htmlentities($row_RSPersonalRecordUpdate['ID'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">FirstName:</td>
      <td><input type="text" name="FirstName" value="<?php echo htmlentities($row_RSPersonalRecordUpdate['FirstName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">MiddelName:</td>
      <td><input type="text" name="MiddelName" value="<?php echo htmlentities($row_RSPersonalRecordUpdate['MiddelName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">LastName:</td>
      <td><input type="text" name="LastName" value="<?php echo htmlentities($row_RSPersonalRecordUpdate['LastName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Date of Birth:</td>
      <td><input type="text" name="Date_Birth" value="<?php echo htmlentities($row_RSPersonalRecordUpdate['Date_Birth'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Place of Birth:</td>
      <td><input type="text" name="Place_Birth" value="<?php echo htmlentities($row_RSPersonalRecordUpdate['Place_Birth'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Age:</td>
      <td><input type="text" name="Age" value="<?php echo htmlentities($row_RSPersonalRecordUpdate['Age'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Sex:</td>
      <td valign="baseline"><table>
        <tr>
          <td><input type="radio" name="Sex" value="Male" <?php if (!(strcmp(htmlentities($row_RSPersonalRecordUpdate['Sex'], ENT_COMPAT, 'utf-8'),"Male"))) {echo "checked=\"checked\"";} ?> />
            Male</td>
        </tr>
        <tr>
          <td><input type="radio" name="Sex" value="Female" <?php if (!(strcmp(htmlentities($row_RSPersonalRecordUpdate['Sex'], ENT_COMPAT, 'utf-8'),"Female"))) {echo "checked=\"checked\"";} ?> />
            Female</td>
        </tr>
      </table></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Email:</td>
      <td><input type="text" name="Email" value="<?php echo htmlentities($row_RSPersonalRecordUpdate['Email'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Date of Employement:</td>
      <td><input type="text" name="Date_Employement" value="<?php echo htmlentities($row_RSPersonalRecordUpdate['Date_Employement'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Department:</td>
      <td><input type="text" name="Department" value="<?php echo htmlentities($row_RSPersonalRecordUpdate['Department'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Position:</td>
      <td><input type="text" name="Position" value="<?php echo htmlentities($row_RSPersonalRecordUpdate['Position'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Educational Status:</td>
      <td><input type="text" name="Educational_Status" value="<?php echo htmlentities($row_RSPersonalRecordUpdate['Educational_Status'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Salary:</td>
      <td><input type="text" name="Salary" value="<?php echo htmlentities($row_RSPersonalRecordUpdate['Salary'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Martial Status:</td>
      <td><input type="text" name="Martial_Status" value="<?php echo htmlentities($row_RSPersonalRecordUpdate['Martial_Status'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Children number:</td>
      <td><input type="text" name="Children_number" value="<?php echo htmlentities($row_RSPersonalRecordUpdate['Children_number'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Name Child(Comma Separted):</td>
      <td><input type="text" name="Name_Child" value="<?php echo htmlentities($row_RSPersonalRecordUpdate['Name_Child'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Age Child(Comma Separted:</td>
      <td><input type="text" name="Age_Child" value="<?php echo htmlentities($row_RSPersonalRecordUpdate['Age_Child'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Sex_Child:</td>
      <td><input type="text" name="Sex_Child" value="<?php echo htmlentities($row_RSPersonalRecordUpdate['Sex_Child'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Photo:</td>
      <td><input type="text" name="Photo" value="<?php echo htmlentities($row_RSPersonalRecordUpdate['Photo'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Image:</td>
      <td><input type="text" name="Image" value="<?php echo htmlentities($row_RSPersonalRecordUpdate['Image'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top">Experience:</td>
      <td><textarea name="Experience" cols="50" rows="5"><?php echo htmlentities($row_RSPersonalRecordUpdate['Experience'], ENT_COMPAT, 'utf-8'); ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Hard Copy Exit on Shelf No:</td>
      <td><input type="text" name="HardCopy_Shelf_No" value="<?php echo htmlentities($row_RSPersonalRecordUpdate['HardCopy_Shelf_No'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update Record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="Auto_ID" value="<?php echo $row_RSPersonalRecordUpdate['Auto_ID']; ?>" />
</form>
<p>&nbsp;</p>
<!-- InstanceEndEditable -->
    <blockquote>&nbsp;</blockquote>
  </div>
  <div id="sidebar">
    <div id="sidemenu">
    
   <ul id="MenuBar2" class="MenuBarVertical">
     <li><a href="../Recruitment/Probation_Evaluation.php">Probation Period Evaluation</a>       </li>
     <li><a href="#" class="MenuBarItemSubmenu">Personal Detail</a>
       <ul>
         <li><a href="../Personal Reocrd/Employee_Personal_Record.php">Personal Detail entry</a></li>
         <li><a href="PersonalRecordDisplay.php" target="_blank">Personal Detail Search</a></li>
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
         <li><a href="#" class="MenuBarItemSubmenu">Payroll System</a>
           <ul>
             <li><a href="http://localhost/phpmyadmin/tbl_export.php?db=payrolldb&amp;table=payroll_data&amp;token=d09a7e056ddcbb89efce4981f271ec46&amp;single_table=true" title="Payroll Data export Wizard" target="_blank">Export Payroll Data</a></li>
             <li><a href="http://localhost/phpmyadmin/tbl_import.php?db=payrolldb&amp;table=payroll_data&amp;token=d09a7e056ddcbb89efce4981f271ec46" title="Payroll data Import Wizard" target="_blank">Import Payroll Data</a></li>
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
    <p>&nbsp;</p>
    <br />
    <br />
   
    <?php   
	include ("../Notifications/ALNotification.php");?>
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
mysql_free_result($RSPersonalRecordUpdate);
?>
