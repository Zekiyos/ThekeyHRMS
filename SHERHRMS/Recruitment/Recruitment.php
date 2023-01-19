<?php require_once('../Connections/PayrollDB.php'); ?>
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
  //$insertSQL = sprintf("INSERT INTO recruitment (Employee, Place, ID, FirstName, MiddelName, LastName, Age, Sex, Photo, `Date`, Address,`Department`, `Position`, Salary, Transport_Allowance,Hardship_Allowance, Position_Allowance) VALUES (%s, %s, %s, %s, %s, %s, %s,%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
//                       GetSQLValueString($_POST['Employee'], "text"),
//                       GetSQLValueString($_POST['Place'], "text"),
//                       GetSQLValueString($_POST['ID'], "text"),
//                       GetSQLValueString($_POST['FirstName'], "text"),
//                       GetSQLValueString($_POST['MiddelName'], "text"),
//                       GetSQLValueString($_POST['LastName'], "text"),
//                       GetSQLValueString($_POST['Age'], "int"),
//                       GetSQLValueString($_POST['Sex'], "text"),
//                       GetSQLValueString($_POST['Photo'], "text"),
//                       GetSQLValueString($_POST['Date'], "date"),
//                       GetSQLValueString($_POST['Address'], "text"),
//					   GetSQLValueString($_POST['Department'], "text"),
//                       GetSQLValueString($_POST['Position'], "text"),
//                       GetSQLValueString($_POST['Salary'], "int"),
//                       GetSQLValueString($_POST['Transport_Allowance'], "int"),
//				       GetSQLValueString($_POST['Hardship_Allowance'], "int"),
//					   GetSQLValueString($_POST['Position_Allowance'], "int"));
//
//  mysql_select_db($database_HRMS, $HRMS);
//  $Result1 = mysql_query($insertSQL, $HRMS) or die(mysql_error());
  
 /*******************Payroll data entry for new employeee registration*/ 
 
   //$insertPayrollDBSQL = sprintf("INSERT INTO Payroll_Data (`Payroll ID`,`First Name`,`Middel Name`,`Last Name`,`Basic salary`,`Department`,`Position`,`Hardship Allowance`,`Transport Allowance`,`Position Allowance`)
//                                                           VALUES ( %s, %s, %s, %s, %s, %s, %s, %s, %s,%s)",
//                       GetSQLValueString($_POST['ID'], "text"),
//                       GetSQLValueString($_POST['FirstName'], "text"),
//                       GetSQLValueString($_POST['MiddelName'], "text"),
//                       GetSQLValueString($_POST['LastName'], "text"),
//                       GetSQLValueString($_POST['Salary'], "int"),
//					   GetSQLValueString($_POST['Department'], "text"),
//                       GetSQLValueString($_POST['Position'], "text"),
//                       GetSQLValueString($_POST['Hardship_Allowance'], "int"),
//                       GetSQLValueString($_POST['Transport_Allowance'], "int"),
//				       GetSQLValueString($_POST['Position_Allowance'], "int"));
//
//  mysql_select_db($database_PayrollDB, $PayrollDB);
//  $ResultPayrollDB = mysql_query($insertPayrollDBSQL, $PayrollDB) or die(mysql_error());
  /*End of payroll dtata entry for new employee registration**********************/
  
  
  /***************************************************************************************************/
  /*Attendance week data entry start*/
  
  //checking Week day of recruitment
  
  $DateValue=$_POST['Date'];
  
   $WeekOFMonthSQL="SELECT WEEK('".$DateValue."',6) - WEEK(DATE_SUB('".$DateValue."', INTERVAL DAYOFMONTH('".$DateValue."')-1 DAY),6)+1 AS WeekOFMonth ";
						$resultWeekOFMonth = mysql_query($WeekOFMonthSQL);
				while($rowWeekOFMonth = mysql_fetch_array($resultWeekOFMonth, MYSQL_ASSOC))
				{
					
					$WeekOFMonth =$rowWeekOFMonth ['WeekOFMonth'];
					
					$UpdatedTabelName="week_".$WeekOFMonth."" ;
					
				}
				
		
  $insertAttendanceSQL = sprintf("INSERT INTO ".$UpdatedTabelName." (`ID`,`FirstName`,`MiddelName`,`LastName`,`Department`)
                                                           VALUES ( %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['ID'], "text"),
                       GetSQLValueString($_POST['FirstName'], "text"),
                       GetSQLValueString($_POST['MiddelName'], "text"),
                       GetSQLValueString($_POST['LastName'], "text"),
                       GetSQLValueString($_POST['Salary'], "int"),
					   GetSQLValueString($_POST['Department'], "text"));

  mysql_select_db($database_HRMS, $HRMS);
  $ResultAttendance = mysql_query($insertAttendanceSQL, $HRMS) or die(mysql_error());
  
  /*end of wekk data*/
   /*************************************************************************************************************/
  
}

$maxRows_RSRecruitment = 10;
$pageNum_RSRecruitment = 0;
if (isset($_GET['pageNum_RSRecruitment'])) {
  $pageNum_RSRecruitment = $_GET['pageNum_RSRecruitment'];
}
$startRow_RSRecruitment = $pageNum_RSRecruitment * $maxRows_RSRecruitment;

mysql_select_db($database_HRMS, $HRMS);
$query_RSRecruitment = "SELECT * FROM recruitment";
$query_limit_RSRecruitment = sprintf("%s LIMIT %d, %d", $query_RSRecruitment, $startRow_RSRecruitment, $maxRows_RSRecruitment);
$RSRecruitment = mysql_query($query_limit_RSRecruitment, $HRMS) or die(mysql_error());
$row_RSRecruitment = mysql_fetch_assoc($RSRecruitment);

if (isset($_GET['totalRows_RSRecruitment'])) {
  $totalRows_RSRecruitment = $_GET['totalRows_RSRecruitment'];
} else {
  $all_RSRecruitment = mysql_query($query_RSRecruitment);
  $totalRows_RSRecruitment = mysql_num_rows($all_RSRecruitment);
}
$totalPages_RSRecruitment = ceil($totalRows_RSRecruitment/$maxRows_RSRecruitment)-1;
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
newWindow = window.open(N, 'popD','toolbar=no,menubar=no,resizable=no,scrollbars=no,status=no,location=no,width=700,height=350');
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
            <li><a href="Recruitment.php">Recruitment Form</a></li>
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
        <li><a href="http://localhost/Report/annual_leaverpt.php" target="_blank" class="MenuBarItemSubmenu">Report</a>
          <ul>
            <li><a href="javascript:popDemo('Court Case/CourtCaseFilter.php')">Court Case</a></li>

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
  <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" -->Employee Probation Period Recruitment Form 
                                 
     </p> <p class="active">&nbsp;</p>
      <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
        <table width="535" height="535" align="center">
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Employee:</td>
<td><span id="sprytxtEmployee">
              <input type="text" name="Employee" value="" size="32" />
            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Place:</td>
            <td><span id="sprytxtPlace"><span id="sprytextfield2">
              <input type="text" name="Place" value="" size="32" />
            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">ID:</td>
<td><span id="sprytxtID">
              <input type="text" name="ID" value="" size="15" />
            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">First Name:</td>
<td><span id="sprytxtFirstName">
              <input type="text" name="FirstName" value="" size="20" />
            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Middel Name:</td>
<td><span id="sprytxtMiddelName">
              <input type="text" name="MiddelName" value="" size="20" />
            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">LastName:</td>
<td><span id="sprytxtLastName">
              <input type="text" name="LastName" value="" size="20" />
            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Age:</td>
            <td><span id="sprytxtAge">
            <input type="text" name="Age" value="" size="8" />
             <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span><span class="textfieldMinValueMsg">The entered value is less than the minimum required.</span><span class="textfieldMaxValueMsg">The entered value is greater than the maximum allowed.</span></span></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Sex:</td>
            <td valign="baseline"><table>
              <tr>
                <td><input type="radio" name="Sex" value="Male" <?php if (!(strcmp("Female","Male"))) {echo "checked=\"checked\"";} ?>/>
                  Male</td>
              </tr>
              <tr>
                <td><input type="radio" name="Sex" value="Female" <?php if (!(strcmp("Female","Female"))) {echo "checked=\"checked\"";} ?>/>
                  Female</td>
              </tr>
            </table></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Photo:</td>
            <td><input type="file" name="Photo" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Date:</td>
            <td> <input readonly="readonly" type="text" name="Date" value="<?php echo date("Y-m-d"); ?> " size="15" />
			 
			</td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right" valign="top">Address:</td>
            <td>
              <textarea name="Address" cols="50" rows="5"></textarea>
            </td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Department:</td>
<td><span id="sprytxtDepartment">
              <input type="text" name="Department" value="" size="32" />
            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Position:</td>
<td><span id="sprytxtPosition">
              <input type="text" name="Position" value="" size="32" />
            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Salary:</td>
<td><span id="sprytxtSalary">
              <input type="text" name="Salary" value="" size="15" />
            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Transport Allowance:</td>
<td><span id="sprytxtTransportAllowance">
              <input type="text" name="Transport_Allowance" value="" size="15" />
            <span class="textfieldInvalidFormatMsg">Invalid format type Number in Birr.</span></span></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Hardship Allowance:</td>
<td><span id="sprytxtHardshipAllowance">
              <input type="text" name="Hardship_Allowance" value="" size="15" />
            <span class="textfieldInvalidFormatMsg">Invalid format type Number in Birr.</span></span></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Position Allowance:</td>
            <td><span id="sprytxtPositionAllowance">
            <input type="text" name="Position_Allowance" value="" size="15" />
<span class="textfieldInvalidFormatMsg">Invalid format type Number in Birr.</span></span></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;               <input type="submit" value="Register" height="120" width="100"/></td>
          </tr>
        </table>
        <p>
          <input type="hidden" name="MM_insert" value="form1" />
        </p>
        <p>&nbsp;</p>
      </form>
      <p>&nbsp;</p>
<p>&nbsp;</p>
<blockquote>&nbsp;
      <p>&nbsp;</p>
  </blockquote>
    
  <!-- InstanceEndEditable -->
    <blockquote>&nbsp;</blockquote>
  </div>
  <div id="sidebar">
    <div id="sidemenu">
    
   <ul id="MenuBar2" class="MenuBarVertical">
     <li><a href="Probation_Evaluation.php">Probation Period Evaluation</a>       </li>
     <li><a href="Probation_Evaluation.php" class="MenuBarItemSubmenu">Personal Detail</a>
       <ul>
<li><a href="Probation_Evaluation.php">Probation Period Evaluation</a></li>
<li><a href="../Personal Reocrd/Employee_Personal_Record.php">Personal Detail entry</a></li>
<li><a href="../Database_Update/Personal Reocrd Database_Update/PersonalRecordDisplay.php" target="_blank">Personal Detail Search</a></li>
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
             <li><a href="../Leaves/Leave Database_Update/AnnualLeaveDisplay.php">Annual Leave Data</a></li>
             <li><a href="../Leaves/Leave Database_Update/AnnualLeaveCalcDisplay.php">Calc Annual Leave Data</a></li>
             <li><a href="../Leaves/Leave Database_Update/SickLeaveDisplay.php">Sick   Leave Data</a></li>
             <li><a href="../Leaves/Leave Database_Update/MaternityLeaveDisplay.php">Maternity Leave Data</a></li>
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
    <br />
    <br />
    <br /> <br />
    <br />
    <a href="../Ethiopian Labour Law Pro.377(English).htm#a4" target="_blank">Contract Recruitment Labour Law</a><p></p>
    <p><a href="../Ethiopian Labour Law Pro.377(English).htm#a11" target="_blank">Probation Period Labour Law</a></p>
    <a href="../Ethiopian Labour Law Pro.377(English).htm#a47" target="_blank">Personal Record Labour Law</a>
    <?php //include ("../Notifications/ALNotification.php");?>
    <?php include ("../Notifications/EvalutionNotification.php");?>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
	
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytxtEmployee", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytxtPlace", "none", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytxtID", "none", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytxtFirstName", "none", {validateOn:["blur"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytxtMiddelName", "none", {validateOn:["blur"]});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytxtLastName", "none", {validateOn:["blur"]});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytxtAge", "integer", {minValue:0, maxValue:10,validateOn:["blur"]});
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytxtPosition", "none", {validateOn:["blur"]});
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytxtSalary", "none", {validateOn:["blur"]});
var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytxtTransportAllowance", "integer", {validateOn:["blur"], isRequired:false});
var sprytextfield11 = new Spry.Widget.ValidationTextField("sprytxtHardshipAllowance", "integer", {validateOn:["blur"], isRequired:false});
var sprytextfield12 = new Spry.Widget.ValidationTextField("sprytxtPositionAllowance", "integer", {validateOn:["blur"], isRequired:false});
var sprytextfield13 = new Spry.Widget.ValidationTextField("sprytxtDepartment", "none", {validateOn:["blur"]});
    </script>
    
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
mysql_free_result($RSRecruitment);
?>
