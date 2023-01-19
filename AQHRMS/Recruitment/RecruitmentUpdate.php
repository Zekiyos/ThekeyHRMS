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
  $updateSQL = sprintf("UPDATE recruitment SET Employee=%s, Place=%s, ID=%s, FirstName=%s, MiddelName=%s, LastName=%s, Age=%s, Sex=%s, Photo=%s, `Date`=%s, Address=%s, Department=%s, `Position`=%s, Salary=%s, Transport_Allowance=%s, Hardship_Allowance=%s, Housing_Allowance=%s, Position_Allowance=%s, Present_Allowance=%s WHERE Auto_ID=%s",
                       GetSQLValueString($_POST['Employee'], "text"),
                       GetSQLValueString($_POST['Place'], "text"),
                       GetSQLValueString($_POST['ID'], "text"),
                       GetSQLValueString($_POST['FirstName'], "text"),
                       GetSQLValueString($_POST['MiddelName'], "text"),
                       GetSQLValueString($_POST['LastName'], "text"),
                       GetSQLValueString($_POST['Age'], "int"),
                       GetSQLValueString($_POST['Sex'], "text"),
                       GetSQLValueString($_POST['Photo'], "text"),
                       GetSQLValueString($_POST['Date'], "date"),
                       GetSQLValueString($_POST['Address'], "text"),
                       GetSQLValueString($_POST['Department'], "text"),
                       GetSQLValueString($_POST['Position'], "text"),
                       GetSQLValueString($_POST['Salary'], "double"),
                       GetSQLValueString($_POST['Transport_Allowance'], "double"),
                       GetSQLValueString($_POST['Hardship_Allowance'], "double"),
                       GetSQLValueString($_POST['Housing_Allowance'], "double"),
                       GetSQLValueString($_POST['Position_Allowance'], "double"),
                       GetSQLValueString($_POST['Present_Allowance'], "double"),
                       GetSQLValueString($_POST['Auto_ID'], "int"));

  mysql_select_db($database_HRMS, $HRMS);
  $Result1 = mysql_query($updateSQL, $HRMS) or die(mysql_error());
  
  
  
  //totaldeduction payroll data update 
  $updateSQLTotalDeduction = sprintf("UPDATE total_deduction SET ID=%s, FirstName=%s, MiddelName=%s, LastName=%s, Department=%s, `Position`=%s,`Basic Salary`=%s, Transport_Allowance_Amount=%s, Hardship_Allowance=%s, Housing_Allowance=%s, Position_Allowance=%s, Present_Allowance_Amount=%s WHERE ID=%s",
                       GetSQLValueString($_POST['ID'], "text"),
                       GetSQLValueString($_POST['FirstName'], "text"),
                       GetSQLValueString($_POST['MiddelName'], "text"),
                       GetSQLValueString($_POST['LastName'], "text"),
                       GetSQLValueString($_POST['Department'], "text"),
                       GetSQLValueString($_POST['Position'], "text"),
                       GetSQLValueString($_POST['Salary'], "int"),            
					   GetSQLValueString($_POST['Transport_Allowance'], "double"),
                       GetSQLValueString($_POST['Hardship_Allowance'], "double"),
                       GetSQLValueString($_POST['Housing_Allowance'], "double"),
                       GetSQLValueString($_POST['Position_Allowance'], "double"),
                       GetSQLValueString($_POST['Present_Allowance'], "double"),
					   GetSQLValueString($_POST['ID'], "text"));
  
  
  $Result2 = mysql_query($updateSQLTotalDeduction, $HRMS) or die(mysql_error());
  
  //Updating each week attendanc data according to employee data updation
  
		   for ($i=1; $i<=6; $i++)
			{
													   
			$UpdatedTabelName="week_".$i."" ;	   
		   $UpdateAttendanceSQL =sprintf("UPDATE ".$UpdatedTabelName." SET ID=%s, FirstName=%s, MiddelName=%s, LastName=%s, Department=%s WHERE ID=%s",
							   GetSQLValueString($_POST['ID'], "text"),
							   GetSQLValueString($_POST['FirstName'], "text"),
							   GetSQLValueString($_POST['MiddelName'], "text"),
							   GetSQLValueString($_POST['LastName'], "text"),
							   GetSQLValueString($_POST['Department'], "text"),
							   GetSQLValueString($_POST['ID'], "text"));
												   
		  mysql_select_db($database_HRMS, $HRMS);
		 $ResultAttendance = mysql_query($UpdateAttendanceSQL, $HRMS) or die(mysql_error());
			 }
  
  echo "<script type=\"text/javascript\">alert('Data Updated sucessfully')</script>";
  
  
   
  
  
  
  
  
}

mysql_select_db($database_HRMS, $HRMS);

if(isset($_GET['Auto_ID']))
{

$query_RSRecruitmentUpdate = "SELECT * FROM  recruitment where Auto_ID=".$_GET['Auto_ID']."";}else
$query_RSRecruitmentUpdate = "SELECT * FROM recruitment where Auto_ID=-1";

//$query_RSRecruitmentUpdate = "SELECT * FROM recruitment";
$RSRecruitmentUpdate = mysql_query($query_RSRecruitmentUpdate, $HRMS) or die(mysql_error());
$row_RSRecruitmentUpdate = mysql_fetch_assoc($RSRecruitmentUpdate);
$totalRows_RSRecruitmentUpdate = mysql_num_rows($RSRecruitmentUpdate);
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
    <H2 ><font  size="20" >Thekey</font><span id="headerAdvert"><font color="#999999" size="20" >HRMS</font><font color="#999999" size="3" >    Bringing ICT Solution to Your need.</font>  </span> <font color="#999999" size="3" >The key is yours!! </font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../index.php"><img src="../flags/United Kingdom flag.png" width="35" height="25" /></a><a href="../Amharic/index.php"><img border="0" src="../flags/Ethiopiaflag.jpg" alt="Amharic(ETH)" width="35" height="30" /></a><a href="../Dutch/index.php"><img src="../flags/Netherlands-Flag-icon.png" width="35" height="25" /></a></h2>
   <H2><font color="#999999" size="+1" ></font><img src="../img logo &amp; icons/logo.jpg" alt="Rev(3:7)He that hath THE KEY of David, he that openeth, and no man shutteth;  and shutteth, and no man openeth;" width="100" height="40" />
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     <font color="#FF6600" size="6">Human Resource Management System </font>
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
<li><a href="../index.php">Home</a>        </li>
        <li><a href="#" class="MenuBarItemSubmenu">Recruitment</a>
          <ul>
            <li><a href="Recruitment.php">Recruitment Form</a></li>
            <li><a href="Photo Capture/Capture.php" target="_blank">Photo Capturing</a></li>
            <li><a href="#" class="MenuBarItemSubmenu">Equipment Handover</a>
              <ul>
                <li><a href="../Equipment HandOver/Equipment_HandOver.php">Equipment Handover</a></li>
                <li><a href="../Equipment HandOver/Equipment_ReturnBack.php">Equipment Return Back</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li><a href="../Personal Record/Personal_Information_Detail.php">Personal   Info.</a></li>
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
            <li><a href="#" class="MenuBarItemSubmenu">Special Leave</a>
              <ul>
                <li><a href="../Leaves/Special_Leave_Grant.php">Special Leave With Payment</a></li>
                <li><a href="../Leaves/Special_Leave_GrantWithoutPayment.php">Special Leave Without Payment</a></li>
              </ul>
            </li>
<li><a href="../Leaves/Wedding_Leave_Grant.php">Wedding Leave</a></li>
            <li><a href="../Leaves/Back_From_Leave_Report.php">Back to Work Report</a></li>
          </ul>
        </li>
        <li><a class="MenuBarItemSubmenu" href="#">Disciplinary Action</a>
          <ul>
            <li><a href="../Letters/warning Letters/Verbal_Warning.php">Verbal Warning</a>            </li>
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
<li><a href="../Letters/warning Letters/Termination4ProbationPeriod.php">Probation Period Termination</a></li>
<li><a href="#">Termination Letter</a></li>
              </ul>
            </li>
            <li><a href="javascript: if (confirm('Are You Sure You want to remove Expired Warning?')) { window.location.href='../Letters/warning Letters/Expired_Warning_Remover.php' } else { void('') }; ">Expired Warning Remover</a></li>
            <li><a href="../Letters/warning Letters/Warning_Letters_Viewer.php">Warning Letter Viewer</a></li>
          </ul>
        </li>
        <li><a href="http://localhost/Report/annual_leaverpt.php" target="_blank" class="MenuBarItemSubmenu">Report</a>
          <ul>
            <li><a href="../AQHRMSReport/index.php" target="_blank">HRM Reports</a></li>
            <li><a href="../Court Case/CourtCaseFilter.php" target="_blank">Court Case Report</a></li>
            <li><a href="#" class="MenuBarItemSubmenu">Payroll Report</a>
              <ul>
                <li><a href="javascript:popup('AQPayrollReport/PayrollsheetReportSelection.php')">Payroll Sheet</a></li>
                <li><a href="javascript:popup('AQPayrollReport/AttendanceReportSelection.php')">Attendance</a></li>
                <li><a href="javascript:popup('AQPayrollReport/PayslipReportSelection.php')">Payslip</a></li>
                <li><a href="javascript:popup('AQPayrollReport/CurrencyDenominationReportSelection.php')">Currency Denomination</a></li>
                <li><a href="javascript:popup('AQPayrollReport/ProvidentFundReportSelection.php')">Provident Fund</a></li>
                <li><a href="javascript:popup('AQPayrollReport/PensionReportSelection.php')">Pension Report</a></li>
                <li><a href="javascript:popup('AQPayrollReport/LUContributionReportSelection.php')">Labour Union Contribution</a></li>
              </ul>
            </li>
            <li><a href="../Salary Increment Report/SalaryIncrementReport.php" target="_blank">Salary Increment</a></li>
          </ul>
        </li>
        <li><a href="#" class="MenuBarItemSubmenu">Organization</a>
          <ul>
<li><a href="#" class="MenuBarItemSubmenu">Contract</a>
  <ul>
<li><a href="../Letters/Contract Letters/Creat Contract Letter.php">Creat New Contract</a></li>
<li><a href="../Letters/Contract Letters/Contract Letter.php">Contract Letter</a></li>
  </ul>
</li>
            <li><a href="../Organization/Policy.pdf" target="_blank">Policy</a></li>
            <li><a href="../Organization/Plan.pdf" target="_blank">Plan</a></li>
            <li><a href="../Organization/Procedure.pdf" target="blank">Procedure</a></li>
            <li><a href="../Organization/CBA.pdf" target="_blank">CBA</a></li>
          </ul>
        </li>
        <li><a href="#" class="MenuBarItemSubmenu">Benefits</a>
          <ul>
            <li><a href="../Medical/Medical_Referral.php">Medical Referral From</a></li>
            <li><a href="../Medical/Cholinesterase_Test.php" title="Cholinesterase Test">Cholinesterase Test</a></li>
            <li><a href="../Training/Training.php">Training</a></li>
          </ul>
        </li>
</ul>
<?php echo "<font face=\"Times New Roman, Times, serif\" size=\"+1\"><b>logged in as ".$_SESSION['MM_Username']."</b></font>";  ?>
      </div>
  </div>
  <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" -->
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
<font color="#FF6600" size="+1" > <p align="center">Recruitment Data Update Form</p></font>
  <table align="center" bgcolor="#EBEBEB">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Employee:</td>
      <td><input type="text" name="Employee" value="<?php echo htmlentities($row_RSRecruitmentUpdate['Employee'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Place:</td>
      <td><input type="text" name="Place" value="<?php echo htmlentities($row_RSRecruitmentUpdate['Place'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">ID:</td>
      <td><input type="text" name="ID" value="<?php echo htmlentities($row_RSRecruitmentUpdate['ID'], ENT_COMPAT, 'utf-8'); ?>" size="32" readonly="readonly"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">First Name:</td>
      <td><input type="text" name="FirstName" value="<?php echo htmlentities($row_RSRecruitmentUpdate['FirstName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Middel Name:</td>
      <td><input type="text" name="MiddelName" value="<?php echo htmlentities($row_RSRecruitmentUpdate['MiddelName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Last Name:</td>
      <td><input type="text" name="LastName" value="<?php echo htmlentities($row_RSRecruitmentUpdate['LastName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Age:</td>
      <td><input type="text" name="Age" value="<?php echo htmlentities($row_RSRecruitmentUpdate['Age'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Sex:</td>
      <td><input type="text" name="Sex" value="<?php echo htmlentities($row_RSRecruitmentUpdate['Sex'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Photo:</td>
      <td><input type="text" name="Photo" value="<?php echo htmlentities($row_RSRecruitmentUpdate['Photo'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Date:</td>
      <td><input type="text" name="Date" value="<?php echo htmlentities($row_RSRecruitmentUpdate['Date'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Address:</td>
      <td><input type="text" name="Address" value="<?php echo htmlentities($row_RSRecruitmentUpdate['Address'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Department:</td>
      <td><input type="text" name="Department" value="<?php echo htmlentities($row_RSRecruitmentUpdate['Department'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Position:</td>
      <td><input type="text" name="Position" value="<?php echo htmlentities($row_RSRecruitmentUpdate['Position'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Salary:</td>
      <td><input type="text" name="Salary" value="<?php echo htmlentities($row_RSRecruitmentUpdate['Salary'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Transport Allowance:</td>
      <td><input type="text" name="Transport_Allowance" value="<?php echo htmlentities($row_RSRecruitmentUpdate['Transport_Allowance'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Hardship_Allowance:</td>
      <td><input type="text" name="Hardship_Allowance" value="<?php echo htmlentities($row_RSRecruitmentUpdate['Hardship_Allowance'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Housing Allowance:</td>
      <td><input type="text" name="Housing_Allowance" value="<?php echo htmlentities($row_RSRecruitmentUpdate['Housing_Allowance'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Position Allowance:</td>
      <td><input type="text" name="Position_Allowance" value="<?php echo htmlentities($row_RSRecruitmentUpdate['Position_Allowance'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Present Allowance:</td>
      <td><input type="text" name="Position_Allowance" value="<?php echo htmlentities($row_RSRecruitmentUpdate['Present_Allowance'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="Auto_ID" value="<?php echo $row_RSRecruitmentUpdate['Auto_ID']; ?>" />
</form>
<p>&nbsp;</p>
<!-- InstanceEndEditable -->
    <blockquote>&nbsp;</blockquote>
  </div>
  <div id="sidebar">
    <div id="sidemenu">
    
   <ul id="MenuBar2" class="MenuBarVertical">
     <li><a href="#">Tools</a>
       <ul>
         <li><a href="javascript:popup('Calendar/CalendarConvertor.html')">Calendar Convertor</a></li>
         <li><a href="Calendar/GeorgianEthiopianYearlyCalendar.html" target="_blank">Calendar</a></li>
         <li><a href="javascript:popup('Calendar/Time.html')">Time</a></li>
       </ul>
     </li>
     <li><a href="#" class="MenuBarItemSubmenu">Personal Detail</a>
       <ul>
       <li><a href="Probation_Evaluation.php">Probation Period Evaluation</a>       </li>
         <li><a href="../Personal Record/Employee_Personal_Record.php">Personal Detail entry</a></li>
         <li><a href="../Database_Update/PersonalRecordDisplay.php" target="_blank">Personal Detail Search</a></li>
         <li><a href="Recruitment Data Update/ProbationPersonalRecordDisplay.php" title="Probation Period Personal Record Search" target="_blank">Probation Period Record Search</a></li>
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
     <li><a target="_blank" href="../Proclamation/Ethiopian Labour Law Pro.377(English).htm">Labour Law Proclamation</a></li>
     <li><a href="#" class="MenuBarItemSubmenu"> HRM System Settings...</a>
       <ul>
         <li><a href="#" class="MenuBarItemSubmenu">System Data Setting</a>
           <ul>
             <li><a href="../Database_Update/CreatDepartment.php">Creat Department</a></li>
             <li><a href="../Database_Update/DepartmentDisplay.php" target="_blank">Department Data</a></li>
             <li><a href="Recruitment Data Update/RecruitmentDisplay.php" title="Recruitment Data" target="_blank">Recruitment Data</a></li>
<li><a href="Recruitment Data Update/ProbationEvaluationDisplay.php" title="Probation Evaluation Data" target="_blank">Probation Evalution Data</a></li>
<li><a href="../Equipment HandOver/Equipment Handover Database Update/EquipmentHandOverDisplay.php" title="Equipment handover Data" target="_blank">Equipment Handover Data</a></li>
<li><a href="../Letters/warning Letters/Disciplinary Action Database Update/DisciplinaryDataDisplay.php" title="Disciplinary Action Data" target="_blank">Disciplinary Action  Data</a></li>
<li><a href="../Employee_Status_Transaction/Employee Status Database Update/PromotionDisplay.php" title="Promotion Data" target="_blank">Promotion Data</a></li>
<li><a href="../Employee_Status_Transaction/Employee Status Database Update/DemotionDisplay.php" title="Demotion Data" target="_blank">Demotion Data</a></li>
<li><a href="../Letters/warning Letters/Disciplinary Action Database Update/TerminationDisplay.php" title="Termination Data" target="_blank">Termination Data</a></li>
           </ul>
         </li>
         <li><a href="#">Leave Data Setting</a>
         <ul>
           <li><a href="../Leaves/Leave Database_Update/AnnualLeaveDisplay.php" title="Annual Leave Data" target="_blank">Annual Leave Data</a></li>
             <li><a href="../Leaves/Leave Database_Update/AnnualLeaveCalcDisplay.php" title="Annual Leave Calc" target="_blank">Annual Leave Calc</a></li>
             <li><a href="../Leaves/Leave Database_Update/FuneralLeaveDisplay.php" title="Funeral Leave Data" target="_blank">Funeral Leave Data</a></li>
             <li><a href="../Leaves/Leave Database_Update/SickLeaveDisplay.php" title="Sick Leave Data" target="_blank">Sick Leave Data</a></li>
             <li><a href="../Leaves/Leave Database_Update/SpecialLeaveDisplay.php" title="Special Leave Data" target="_blank">Special Leave Data</a></li>
             <li><a href="../Leaves/Leave Database_Update/MaternityLeaveDisplay.php" title="Maternity Leave Data" target="_blank">Maternity Leave Data</a></li>
             <li><a href="../Leaves/Leave Database_Update/WeddingLeaveDisplay.php" title="Wedding Leave Data" target="_blank">Wedding Leave Data</a></li>
         </ul></li>
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
	//include ("ALNotification.php");?>
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
  <p align="center"><img src="../img logo & icons/thekey soft.jpg" width="159" height="37" /><sup ><sup style="font-size:15px">&reg;&trade;</sup></sup></p>
</div>
<script type="text/javascript">
var MenuBar2 = new Spry.Widget.MenuBar("MenuBar2", {imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"../SpryAssets/SpryMenuBarDownHover.gif", imgRight:"../SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($RSRecruitmentUpdate);
?>
