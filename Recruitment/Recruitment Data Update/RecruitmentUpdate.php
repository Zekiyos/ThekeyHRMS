<?php require_once('../../Connections/HRMS.php'); ?>
<?php 
include('../../Classes/Class_AccessLevel.php');
 $obj_AccessLevel = new AccessLevel();
echo $obj_AccessLevel->CHK_AccessLevel(); 
?>


<?php include('../../Classes/Class_language.php'); ?>
<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL ="UPDATE `recruitment` SET `Employer`='".$_POST['Employer']."', `Place`='".$_POST['Place']."', `FirstName`='".$_POST['FirstName']."',`MiddelName`='".$_POST['MiddelName']."', `LastName`='".$_POST['LastName']."', `Age`=".$_POST['Age'].", `Sex`='".$_POST['Sex']."', `Photo`='".$_POST['Photo']."',`Date`='".$_POST['Date_Birth']."',`Address`='".$_POST['Address']."', `Department`='".$_POST['Department']."', `Position`='".$_POST['Position']."', Salary=".$_POST['Salary'].", Transport_Allowance=".$_POST['Transport_Allowance'].", Hardship_Allowance=".$_POST['Hardship_Allowance'].", Housing_Allowance=".$_POST['Housing_Allowance'].", Position_Allowance=".$_POST['Position_Allowance'].", Present_Allowance=".$_POST['Present_Allowance'].",ModifiedBy='".$_SESSION['MM_Username']."'
   WHERE ID='".$_POST['ID']."'";

  mysql_select_db($database_HRMS, $HRMS);
  $Result1 = mysql_query($updateSQL, $HRMS) or die(mysql_error());
  
  
  
  //totaldeduction payroll data update 
  $updateSQLTotalDeduction = "UPDATE total_deduction SET FirstName='".$_POST['FirstName']."', `MiddelName`='".$_POST['MiddelName']."', LastName='".$_POST['LastName']."', Department='".$_POST['Department']."', `Position`='".$_POST['Position']."',`Basic Salary`='".$_POST['Salary']."', Transport_Allowance_Amount='".$_POST['Transport_Allowance']."', Hardship_Allowance='".$_POST['Hardship_Allowance']."', Housing_Allowance='".$_POST['Housing_Allowance']."', Position_Allowance='".$_POST['Position_Allowance']."', Present_Allowance_Amount='".$_POST['Present_Allowance']."',
  ModifiedBy='".$_SESSION['MM_Username']."'
   WHERE ID='".$_POST['ID']."'";
  $Result2 = mysql_query($updateSQLTotalDeduction, $HRMS) or die(mysql_error());
  
  
 //Updating each week attendanc data according to employee data updation
  
		   for ($i=1; $i<=6; $i++)
			{
													   
			$UpdatedTabelName="week_".$i."" ;	   
		   $UpdateAttendanceSQL ="UPDATE ".$UpdatedTabelName." SET FirstName='".$_POST['FirstName']."', MiddelName='".$_POST['MiddelName']."', LastName='".$_POST['LastName']."', Department='".$_POST['Department']."' WHERE ID='".$_POST['ID']."'";
												   
		  mysql_select_db($database_HRMS, $HRMS);
		 $ResultAttendance = mysql_query($UpdateAttendanceSQL, $HRMS) or die(mysql_error());
			 }
			 
		
  if(($Result1)&& ($Result2) && ($ResultAttendance))
  echo "<script type=\"text/javascript\">alert('Employee Record Updated Successfully')</script>";
  
  
   
  
  
  
  
  
}

mysql_select_db($database_HRMS, $HRMS);

if(isset($_GET['ID']))
{

$query_RSRecruitmentUpdate = "SELECT * FROM  recruitment where ID='".$_GET['ID']."'";}else
$query_RSRecruitmentUpdate = "SELECT * FROM recruitment where ID=-1";

//$query_RSRecruitmentUpdate = "SELECT * FROM recruitment";
$RSRecruitmentUpdate = mysql_query($query_RSRecruitmentUpdate, $HRMS) or die(mysql_error());
$row_RSRecruitmentUpdate = mysql_fetch_assoc($RSRecruitmentUpdate);
$totalRows_RSRecruitmentUpdate = mysql_num_rows($RSRecruitmentUpdate);
?>
<script src="../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/ThekeyHRMS_main_Template.dwt" codeOutsideHTMLIsLocked="false" -->
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
  $_SESSION['MM_Fullname']=NULL;
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
//******



$DB_HOST = $hostname_HRMS;//'localhost';
$DB_USER = $username_HRMS;//'root';
$DB_PASSWORD = $password_HRMS;//'';//'EWSadmin';
$DB_DATABASE = $database_HRMS;//'ThekeyHRMSDB';
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
        
 
 ?>
 
<link href="../../styles/ThekeyHRMSTemplate.css" rel="stylesheet" type="text/css" />

<script src="../../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<link href="../../SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico" >
<link rel="icon" href="animated_favicon.gif" type="image/gif" >

<link rel="stylesheet"  href="../../css/tinybox2style.css" />
<script type="text/javascript" src="../../js/tinybox.js"></script>

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
    <H2 ><font  size="20" >Thekey</font><span id="headerAdvert"><font color="#999999" size="20" >HRMS</font><font color="#999999" size="3" >    To make your life easy.</font>  </span> <font color="#999999" size="3" >The key is yours!! </font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $path."/".basename(realpath(__FILE__));?>?lang=en"><img src="../../images/United Kingdom flag.png" width="35" height="25" /></a><span
title="Amharic(Ethiopia)-Translated By. Zekiyos Abayneh"
onmouseover="this.style.backgroundColor='#F2F2F2'"
onmouseout="this.style.backgroundColor='#F2F2F2'"><a href="<?php echo $path."/".basename(realpath(__FILE__));?>?lang=am"><img border="0" src="../../images/Ethiopiaflag.jpg" alt="Amharic(ETH)" width="35" height="30" /></a><span style='background:#F2F2F2'></span></span><span
title="Orommiffaa(Ethiopia)-Translated By. Nadew Solomon"
onmouseover="this.style.backgroundColor='#F2F2F2'"
onmouseout="this.style.backgroundColor='#F2F2F2'"><a href="<?php echo $path."/".basename(realpath(__FILE__));?>?lang=or"><img border="1" src="../../images/Oromiyaflag_(Ethiopia).jpg" alt="Oromifa(ETH)"  width="25" height="25" /></a></span></span><span
title="Dutch(Netherland)-Translated By. Google Translator"
onmouseover="this.style.backgroundColor='#F2F2F2'"
onmouseout="this.style.backgroundColor='#F2F2F2'">&nbsp;<a href="<?php echo $path."/".basename(realpath(__FILE__));?>?lang=nl"><img src="../../images/Netherlands-Flag-icon.png" width="35" height="25" /></a></span></span></h2>
   <H2><font color="#999999" size="+1" ></font><img src="../../img logo &amp; icons/logo.jpg" alt="Rev(3:7)He that hath THE KEY of David, he that openeth, and no man shutteth;  and shutteth, and no man openeth;" width="100" height="40" />
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     <font color="#FF6600" size="6"><?php echo $obj_lang->get('Human Resource Management System', $lang); ?> </font>
     </font>
     
   </h2>
</div>

    <div id="headerimg">
      <div class="menu_nav">


<ul id="MenuBar1" class="MenuBarHorizontal">
<li><a href="../../index.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Home', $lang); ?></a>        </li>
        <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Recruitment', $lang); ?></a>
          <ul>
            <li><a href="../Recruitment.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Recruitment Form', $lang); ?></a></li>
            <li><a href="../Photo Capture/Capture.php" target="_blank"><?php echo $obj_lang->get('Photo Capturing', $lang); ?></a></li>
            <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Equipment Handover', $lang); ?></a>
              <ul>
                <li><a href="../../Equipment HandOver/Equipment_HandOver.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Equipment Handover', $lang); ?></a></li>
                <li><a href="../../Equipment HandOver/Equipment_ReturnBack.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Equipment Returning', $lang); ?></a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li><a href="../../Personal Record/Personal_Information_Detail.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Personal   Info', $lang); ?></a></li>
        <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Leave', $lang); ?></a>
          <ul>
            <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Annual Leave', $lang); ?></a>
              <ul>
              <li><a href="../../Leaves/CalculateAnnualLeave.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Annual Leave Calculator', $lang); ?></a></li>
              <li><a href="../../Leaves/CalculateALPayment.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('AL Payment Calculator', $lang); ?></a></li>
                <li><a href="../../Leaves/Annual_Leave_Grant.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Annual Leave Grant', $lang); ?></a></li>
</ul>
            </li>
            <li><a href="../../Leaves/Funeral_Leave_Grant.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Funeral Leave', $lang); ?></a></li>
            <li><a href="../../Leaves/Maternity_Leave_Grant.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Maternity Leave', $lang); ?></a></li>
            <li><a href="../../Leaves/Paternity_Leave_Grant.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Paternity Leave', $lang); ?></a></li>
            <li><a href="../../Leaves/Sick_Leave_Grant.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Sick Leave', $lang); ?></a></li>
            <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Special Leave', $lang); ?></a>
              <ul>
                <li><a href="../../Leaves/Special_Leave_Grant.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Special Leave With Payment', $lang); ?></a></li>
                <li><a href="../../Leaves/Special_Leave_GrantWithoutPayment.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Special Leave Without Payment', $lang); ?></a></li>
              </ul>
            </li>
<li><a href="../../Leaves/Wedding_Leave_Grant.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Wedding Leave', $lang); ?></a></li>
            <li><a href="../../Leaves/Back_From_Leave_Report.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Back to Work Report', $lang); ?></a></li>
          </ul>
        </li>
        <li><a class="MenuBarItemSubmenu" href="#"><?php echo $obj_lang->get('Disciplinary Action', $lang); ?></a>
          <ul>
            <li><a href="../../Letters/warning Letters/Verbal_Warning.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Verbal Warning', $lang); ?></a>            </li>
<li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Written Warning', $lang); ?></a>
              <ul>
                <li><a href="../../Letters/warning Letters/First_Instance_Warning.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('1st Instance Warning', $lang); ?></a></li>
                <li><a href="../../Letters/warning Letters/Second_Instance_Warning.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('2nd Instance Warning', $lang); ?></a></li>
                <li><a href="../../Letters/warning Letters/Third_Instance_Warning.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('3rd Instance Warning', $lang); ?></a></li>
                <li><a href="../../Letters/warning Letters/Last_Warning.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Last Warning', $lang); ?></a></li>
              </ul>
            </li>
            <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Dismissal / Termination', $lang); ?></a>
              <ul>
<li><a href="../../Termination/Termination.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Termination Form', $lang); ?></a></li>

<li><a href="#"><?php echo $obj_lang->get('Termination Letter', $lang); ?></a></li>
<li><a href="#"><?php echo $obj_lang->get('Terminated Employee', $lang); ?></a><ul>
<li><a href="../../Termination/Terminated Employee Rollback/Terminated_Employee_RollbackSetup.php?lang=<?php echo $_REQUEST['lang']; ?>" target="_blank"><?php echo $obj_lang->get(' Rollback', $lang); ?></a></li>
<li><a href="../../Termination/Terminated Employee Cleaner/Terminated_Employee_CleanerSetup.php?lang=<?php echo $_REQUEST['lang']; ?>" target="_blank"><?php echo $obj_lang->get('Cleaner', $lang); ?></a></li>
</ul>
</li>
              </ul>
            </li>
            <li><a href="javascript: if (confirm('Are You Sure You want to remove Expired Warning?')) { window.location.href='../Letters/warning Letters/Expired_Warning_Remover.php' } else { void('') }; "><?php echo $obj_lang->get('Expired Warning Remover', $lang); ?></a></li>
            <li><a href="../../Letters/warning Letters/Warning_Letters_Viewer.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Warning Letter Viewer', $lang); ?></a></li>
          </ul>
        </li>
        <li><a href="http://localhost/Report/annual_leaverpt.php" target="_blank" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Report', $lang); ?></a>
          <ul>
            <li><a href="../../ThekeyHRMSReport/index.php" target="_blank"><?php echo $obj_lang->get('HRM Reports', $lang); ?></a></li>
            <li><a href="http://localhost/ThekeyHRMSReport/Employee_Personal_Record_Detialsmry.php" target="_blank"><?php echo $obj_lang->get('Biometric Attendance Reports', $lang); ?></a></li>
            <li><a href="../../Court Case/CourtCaseFilter.php" target="_blank"><?php echo $obj_lang->get('Court Case Report', $lang); ?></a></li>
            <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Payroll Report', $lang); ?></a>
              <ul>
                <li><a href="javascript:popup('ThekeyPayrollReport/PayrollsheetReportSelection.php')"><?php echo $obj_lang->get('Payroll Sheet', $lang); ?></a></li>
                <li><a href="javascript:popup('ThekeyPayrollReport/AttendanceReportSelection.php')"><?php echo $obj_lang->get('Attendance', $lang); ?></a></li>
                <li><a href="javascript:popup('ThekeyPayrollReport/PayslipReportSelection.php')"><?php echo $obj_lang->get('Payslip', $lang); ?></a></li>
                <li><a href="javascript:popup('ThekeyPayrollReport/CurrencyDenominationReportSelection.php')"><?php echo $obj_lang->get('Currency Denomination', $lang); ?></a></li>
                <li><a href="javascript:popup('ThekeyPayrollReport/ProvidentFundReportSelection.php')"><?php echo $obj_lang->get('Provident Fund', $lang); ?></a></li>
                <li><a href="javascript:popup('ThekeyPayrollReport/PensionReportSelection.php')"><?php echo $obj_lang->get('Pension Report', $lang); ?></a></li>
                <li><a href="javascript:popup('ThekeyPayrollReport/LUContributionReportSelection.php')"><?php echo $obj_lang->get('Labour Union Contribution', $lang); ?></a></li>
              </ul>
            </li>
            <li><a href="../../Salary Increment Report/SalaryIncrementReport.php" target="_blank"><?php echo $obj_lang->get('Salary Increment', $lang); ?></a></li>
          </ul>
        </li>
        <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Organization', $lang); ?></a>
          <ul>
<li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Contract', $lang); ?></a>
  <ul>
<li><a href="../../Letters/Contract Letters/Creat Contract Letter.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Creat New Contract', $lang); ?></a></li>
<li><a href="../../Letters/Contract Letters/Contract Letter.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Contract Letter', $lang); ?></a></li>
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
            <li><a href="../../Medical/Medical_Referral.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Medical Referral From', $lang); ?></a></li>
            <li><a href="../../Medical/Cholinesterase_Test.php?lang=<?php echo $_REQUEST['lang']; ?>" title="Cholinesterase Test"><?php echo $obj_lang->get('Cholinesterase Test', $lang); ?></a></li>
            <li><a href="../../Training/Training.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Training', $lang); ?></a></li>
          </ul>
        </li>
</ul>
<?php echo "<font face=\"Times New Roman, Times, serif\" size=\"+1\"><b>logged in as ".$_SESSION['MM_Fullname']."</b></font>";  ?>
      </div>
  </div>
  <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" -->
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
<font color="#FF6600" size="+1" > <p align="center">Recruitment Data Update Form</p></font>
  <table align="center" bgcolor="#EBEBEB">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Employer', $lang); ?>:</td>
      <td><span id="sprytxtEmployee"><input type="text" name="Employer" value="<?php echo htmlentities($row_RSRecruitmentUpdate['Employer'], ENT_COMPAT, 'utf-8'); ?>" size="32" /><span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr valign="baseline">
     <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Place', $lang); ?>:</td>
            <td><span id="sprytxtPlace"><input type="text" name="Place" value="<?php echo htmlentities($row_RSRecruitmentUpdate['Place'], ENT_COMPAT, 'utf-8'); ?>" size="32" /><span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('ID', $lang); ?>:</td>
      <td><input type="text" name="IDNO" value="<?php echo htmlentities($row_RSRecruitmentUpdate['ID'], ENT_COMPAT, 'utf-8'); ?>" size="20" readonly="readonly"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('First Name', $lang); ?>:</td>
<td><span id="sprytxtFirstName"><input type="text" name="FirstName" value="<?php echo htmlentities($row_RSRecruitmentUpdate['FirstName'], ENT_COMPAT, 'utf-8'); ?>" size="20" /><span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr valign="baseline">
       <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Middel Name', $lang); ?>:</td>
<td><span id="sprytxtMiddelName"><input type="text" name="MiddelName" value="<?php echo htmlentities($row_RSRecruitmentUpdate['MiddelName'], ENT_COMPAT, 'utf-8'); ?>" size="20" /><span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr valign="baseline">
   <td nowrap="nowrap" align="right">
      <?php echo $obj_lang->get('Last Name', $lang); ?>:
      </td>
      <td>
<span id="sprytxtLastName">
              <input type="text" name="LastName" value="<?php echo htmlentities($row_RSRecruitmentUpdate['LastName'], ENT_COMPAT, 'utf-8'); ?>" size="20" /><span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Age', $lang); ?>:</td>
      <td><input type="text" name="Age" value="<?php echo htmlentities($row_RSRecruitmentUpdate['Age'], ENT_COMPAT, 'utf-8'); ?>" size="5" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Sex', $lang); ?>:</td>
      <td><input type="text" name="Sex" value="<?php echo htmlentities($row_RSRecruitmentUpdate['Sex'], ENT_COMPAT, 'utf-8'); ?>" size="10" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Photo', $lang); ?>:</td>
      <td><input type="text" name="Photo" value="<?php echo htmlentities($row_RSRecruitmentUpdate['Photo'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
    
      </td>
      
    </tr>
    <tr valign="baseline">
    
      
      <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Date of Employement', $lang); ?>:</td>
            <td><script type='text/JavaScript' src="../../js/scw.js" ></script> <input type="text" name="Date_Birth" id="Date_Birth" onclick='scwShow(this,event);'  value="<?php echo htmlentities($row_RSRecruitmentUpdate['Date'], ENT_COMPAT, 'utf-8'); ?>" size="10" />
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Address', $lang); ?>:</td>
      <td><input type="text" name="Address" value="<?php echo htmlentities($row_RSRecruitmentUpdate['Address'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Department', $lang); ?>:</td>
      <td><span id="sprytxtDepartment"><input type="text" name="Department" value="<?php echo htmlentities($row_RSRecruitmentUpdate['Department'], ENT_COMPAT, 'utf-8'); ?>" size="32" /><span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Position', $lang); ?>:</td>
      <td><input type="text" name="Position" value="<?php echo htmlentities($row_RSRecruitmentUpdate['Position'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Salary', $lang); ?>:</td>
      <td><span id="sprytxtSalary"><input type="text" name="Salary" value="<?php echo htmlentities($row_RSRecruitmentUpdate['Salary'], ENT_COMPAT, 'utf-8'); ?>" size="10" /><span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Transport Allowance', $lang); ?>:</td>
      <td><input type="text" name="Transport_Allowance" value="<?php echo htmlentities($row_RSRecruitmentUpdate['Transport_Allowance'], ENT_COMPAT, 'utf-8'); ?>" size="6" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Hardship Allowance', $lang); ?>:</td>
      <td><input type="text" name="Hardship_Allowance" value="<?php echo htmlentities($row_RSRecruitmentUpdate['Hardship_Allowance'], ENT_COMPAT, 'utf-8'); ?>" size="6" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Housing Allowance', $lang); ?>:</td>
      <td><input type="text" name="Housing_Allowance" value="<?php echo htmlentities($row_RSRecruitmentUpdate['Housing_Allowance'], ENT_COMPAT, 'utf-8'); ?>" size="6" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Position Allowance', $lang); ?>:</td>
      <td><input type="text" name="Position_Allowance" value="<?php echo htmlentities($row_RSRecruitmentUpdate['Position_Allowance'], ENT_COMPAT, 'utf-8'); ?>" size="6" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Present Allowance', $lang); ?>:</td>
      <td><input type="text" name="Present_Allowance" value="<?php echo htmlentities($row_RSRecruitmentUpdate['Present_Allowance'], ENT_COMPAT, 'utf-8'); ?>" size="6" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="<?php echo $obj_lang->get('Update Record', $lang); ?>" onClick="return confirm('Are you sure you want to Update Probation Period Employee Record? If you Click Ok Probation Period Employee detail will be Updated or Click Cancel to Avoid Updating')" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="ID" value="<?php echo $row_RSRecruitmentUpdate['ID']; ?>" />
</form>
<p>&nbsp;</p>
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
       <li><a href="../Probation_Evaluation.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Probation Period Evaluation', $lang); ?></a>       </li>
         <li><a href="../../Personal Record/Employee_Personal_Record.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Personal Detail entry', $lang); ?></a></li>
         <li><a href="../../Database_Update/PersonalRecordDisplay.php?lang=<?php echo $_REQUEST['lang']; ?>" target="_blank"><?php echo $obj_lang->get('Personal Detail Search', $lang); ?></a></li>
         <li><a href="ProbationPersonalRecordDisplay.php?lang=<?php echo $_REQUEST['lang']; ?>" title="Probation Period Personal Record Search" target="_blank"><?php echo $obj_lang->get('Probation Period Record Search', $lang); ?></a></li>
       </ul>
     </li>
     <li><a class="MenuBarItemSubmenu" href="#"><?php echo $obj_lang->get('Employee Status Transaction', $lang); ?></a>
       <ul>
         <li><a href="../../Employee_Status_Transaction/Department_Transfer.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Department Transfer', $lang); ?></a></li>
         <li><a href="../../Employee_Status_Transaction/Promotion.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Promotion', $lang); ?></a></li>
         <li><a href="../../Employee_Status_Transaction/Demotion.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Demotion', $lang); ?></a></li>
         
         <li>
         <a href="#"><?php echo $obj_lang->get('Salary Increment', $lang); ?></a>
         <ul>
          <li><a href="../../Salary Increment Report/SalaryIncrementSetup.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Salary Increment Setup', $lang); ?></a>
          </li>
           <li><a href="../../Salary Increment Report/Salary Increment Database Update/SalaryIncrementDefinationCreat.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Salary Increment Definition', $lang); ?></a></li>
           
             </ul>
           </li>
           
         <li><a href="#" target="_blank"><?php echo $obj_lang->get('Payroll Data Setting', $lang); ?></a>
         <ul>
         <li><a href="../../Database_Update/Payroll Data Settings/PayrollDataSettingSetup.php?lang=<?php echo $_REQUEST['lang']; ?>" target="_blank"><?php echo $obj_lang->get('Payroll Dedcution Data Setting', $lang); ?></a></li>
         
         <li><a href="../../Database_Update/Payroll Data Settings/WeekPayrollDataSettingSetup.php?lang=<?php echo $_REQUEST['lang']; ?>" target="_blank"><?php echo $obj_lang->get('Attendance Data Setting', $lang); ?></a></li>
         </ul>
         
         </li>
            
         <li><a href="../../Court Case/Court_Case.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Court Case', $lang); ?></a></li>
       </ul>
     </li>
     <li>
     <a class="MenuBarItemSubmenu" target="_blank" href="#" ><?php echo $obj_lang->get('Attendance System', $lang); ?></a>
     <ul>
     <li>
     <a href="../../Attendance System/Date_Selection.php" target="_blank"><?php echo $obj_lang->get('Attendance Allocation', $lang); ?>
     </a>
    
     </li>
     <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Overtime Difinition', $lang); ?></a>
          <ul>
             <li><a href="../../Attendance System/OT Definition/OT_Definition_Department.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Departmental', $lang); ?></a></li>
             <li><a href="../../Attendance System/OT Definition/OT_Definition1.php?lang=<?php echo $_REQUEST['lang']; ?>" target="_blank" ><?php echo $obj_lang->get('Individual', $lang); ?></a></li>
          </ul>
          </li>
          <li><a href="#" ><?php echo $obj_lang->get('Working Time Definition', $lang); ?></a>
          <ul>
             <li><a href="../../Attendance System/Working_Time_Definition.php?lang=<?php echo $_REQUEST['lang']; ?>" ><?php echo $obj_lang->get('Departmental', $lang); ?></a></li>
             <li><a href="../../Attendance System/Working_Time_Definition.php?lang=<?php echo $_REQUEST['lang']; ?>" ><?php echo $obj_lang->get('Individual', $lang); ?></a></li>
          </ul>         
           </li>
            <li>
     <a href="../../Attendance System/Offday_Definition.php"><?php echo $obj_lang->get('Off day Definition', $lang); ?>
     </a>
    
     </li>  
      <li>
     <a href="../../Attendance System/Holyday_Definition.php"><?php echo $obj_lang->get('Holyday Definition', $lang); ?>
     </a>
    
     </li>  
      <li>
     <a href="../../Attendance System/Attendance_Summary.php"><?php echo $obj_lang->get('Attendance Summary', $lang); ?>
     </a>
    
     </li>        
         
    </ul>
    </li>
    
     <li><a target="_blank" href="../../Proclamation/Ethiopian Labour Law Pro.377(English).htm"><?php echo $obj_lang->get('Labour Law Proclamation', $lang); ?></a></li>
     <li><a href="#" class="MenuBarItemSubmenu"> <?php echo $obj_lang->get('HRM System Settings...', $lang); ?></a>
       <ul>
         <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('System Data Setting', $lang); ?></a>
           <ul>
             <li><a href="../../Database_Update/CreatDepartment.php"><?php echo $obj_lang->get('Creat Department', $lang); ?></a></li>
             <li><a href="../../Database_Update/DepartmentDisplay.php" target="_blank"><?php echo $obj_lang->get('Department Data', $lang); ?></a></li>
             <li><a href="RecruitmentDisplay.php" title="Recruitment Data" target="_blank"><?php echo $obj_lang->get('Recruitment Data', $lang); ?></a></li>
<li><a href="ProbationEvaluationDisplay.php" title="Probation Evaluation Data" target="_blank"><?php echo $obj_lang->get('Probation Evalution Data', $lang); ?></a></li>
<li><a href="../../Equipment HandOver/Equipment Handover Database Update/EquipmentHandOverDisplay.php" title="Equipment handover Data" target="_blank"><?php echo $obj_lang->get('Equipment Handover Data', $lang); ?></a></li>
<li><a href="../../Letters/warning Letters/Disciplinary Action Database Update/DisciplinaryDataDisplay.php" title="Disciplinary Action Data" target="_blank"><?php echo $obj_lang->get('Disciplinary Action  Data', $lang); ?></a></li>
 <li><a href="../../Salary Increment Report/Salary Increment Database Update/SalaryIncrementDisplay.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Salary Increment Data', $lang); ?></a></li>
<li><a href="../../Employee_Status_Transaction/Employee Status Database Update/PromotionDisplay.php" title="Promotion Data" target="_blank"><?php echo $obj_lang->get('Promotion Data', $lang); ?></a></li>
<li><a href="../../Employee_Status_Transaction/Employee Status Database Update/DemotionDisplay.php" title="Demotion Data" target="_blank"><?php echo $obj_lang->get('Demotion Data', $lang); ?></a></li>
<li><a href="../../Letters/warning Letters/Disciplinary Action Database Update/TerminationDisplay.php" title="Termination Data" target="_blank"><?php echo $obj_lang->get('Termination Data', $lang); ?></a></li>
           </ul>
         </li>
         <li><a href="#"><?php echo $obj_lang->get('Leave Data Setting', $lang); ?></a>
         <ul>
           <li><a href="../../Leaves/Leave Database_Update/AnnualLeaveDisplay.php" title="Annual Leave Data" target="_blank"><?php echo $obj_lang->get('Annual Leave Data', $lang); ?></a></li>
             <!--li><a href="../Leaves/Leave Database_Update/AnnualLeaveCalcDisplay.php" title="Annual Leave Calc" target="_blank"><?php echo $obj_lang->get('Annual Leave Calc', $lang); ?></a></li-->
             <li><a href="../../Leaves/Leave Database_Update/FuneralLeaveDisplay.php" title="Funeral Leave Data" target="_blank"><?php echo $obj_lang->get('Funeral Leave Data', $lang); ?></a></li>
             <li><a href="../../Leaves/Leave Database_Update/SickLeaveDisplay.php" title="Sick Leave Data" target="_blank"><?php echo $obj_lang->get('Sick Leave Data', $lang); ?></a></li>
             <li><a href="../../Leaves/Leave Database_Update/SpecialLeaveDisplay.php" title="Special Leave Data" target="_blank"><?php echo $obj_lang->get('Special Leave Data', $lang); ?></a></li>
             <li><a href="../../Leaves/Leave Database_Update/MaternityLeaveDisplay.php" title="Maternity Leave Data" target="_blank"><?php echo $obj_lang->get('Maternity Leave Data', $lang); ?></a></li>
             <li><a href="../../Leaves/Leave Database_Update/WeddingLeaveDisplay.php" title="Wedding Leave Data" target="_blank"><?php echo $obj_lang->get('Wedding Leave Data', $lang); ?></a></li>
         </ul></li>
         <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Attendance Data Setting ', $lang); ?></a>
          <ul>
            <li><a href="../../Attendance System/Biometric Attendance Database_Update/OffDayDisplay.php"><?php echo $obj_lang->get('Off Day Definition Data', $lang); ?></a></li>
            <li><a href="../../Attendance System/Biometric Attendance Database_Update/WorkingTimeSettingDisplay.php"><?php echo $obj_lang->get('Working Time Setting Departmental Data', $lang); ?></a></li>
            <li><a href="../../Attendance System/Biometric Attendance Database_Update/WorkingTimeIndivdualDisplay.php"><?php echo $obj_lang->get('Working Time Setting Individual Data', $lang); ?></a></li>
            <li><a href="../../Attendance System/Biometric Attendance Database_Update/OTDepartmentDisplay.php"><?php echo $obj_lang->get('OT Definition Departmental Data', $lang); ?></a></li>
            <li><a href="../../Attendance System/Biometric Attendance Database_Update/OTIndivdualDisplay.php"><?php echo $obj_lang->get('OT Definition Individual Data', $lang); ?></a></li>
            </ul>
         <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('User account', $lang); ?></a>
           <ul>
            <li><a href="../../User_Account/Creat_Account.php"><?php echo $obj_lang->get('Creat User Account', $lang); ?></a></li>
             <li><a href="../../User_Account/Change_Password.php"><?php echo $obj_lang->get('Change Password', $lang); ?></a></li>
             <li><a href="../../User_Account/Delete_Account.php"><?php echo $obj_lang->get('Delete User Account', $lang); ?></a></li>
           </ul>
     </li>
     
      <li><a href=""><?php echo $obj_lang->get('Access Level', $lang); ?></a>
              <ul>
            <li><a href="../../Classes/Creat_Access_Level.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Creat Access Level', $lang); ?></a></li>      
            <li><a href="../../User_Account/Access_Level_Grant.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Access Level Grant', $lang); ?></a></li>      
            <li><a href="../../User Account/Access_Level_Display.php"><?php echo $obj_lang->get('Access Level Data ...', $lang); ?></a></li>            
            
            </ul>
            
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
       <!-- InstanceBeginEditable name="SideContent" -->
    <p>&nbsp;</p>
    <br />
    <br />
    <script type="text/javascript">
	

	
	
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytxtEmployee", "none", {validateOn:["blur"]});
//var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytxtPlace", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytxtID", "none", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytxtFirstName", "none", {validateOn:["blur"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytxtMiddelName", "none", {validateOn:["blur"]});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytxtLastName", "none", {validateOn:["blur"]});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytxtAge", "none", {minValue:0, maxValue:100, validateOn:["blur"]});
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytxtPosition", "none", {validateOn:["blur"]});
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytxtSalary", "none", {validateOn:["blur"]});
var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytxtTransportAllowance", "currency", {validateOn:["blur"], isRequired:false});
var sprytextfield11 = new Spry.Widget.ValidationTextField("sprytxtHousingAllowance", "currency", {validateOn:["blur"], isRequired:false});
var sprytextfield12 = new Spry.Widget.ValidationTextField("sprytxtHardshipAllowance", "currency", {validateOn:["blur"], isRequired:false});
var sprytextfield13 = new Spry.Widget.ValidationTextField("sprytxtPositionAllowance", "currency", {validateOn:["blur"], isRequired:false});
var sprytextfield14 = new Spry.Widget.ValidationTextField("sprytxtDepartment", "none", {validateOn:["blur"]});
//var sprytextfield15 = new Spry.Widget.ValidationTextField("sprytxtPresent", "none", {validateOn:["blur"], isRequired:false});
    </script>
    <?php   
	//include ("../ALNotification.php");?>
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
    <p class="lf">&copy; Copyright ThekeyHRMS.Designed and Developed by <a href="http://www.thekey.com">Thekeysoft ICT Soultion</a> &nbsp;Licensed for 
    <?php
    $sqlCS  = "SELECT `Company_Name`,`Web_Site` FROM company_settings";
		
		$resultCS = mysql_query($sqlCS) or die(mysql_error());
		
		$rowCS=mysql_fetch_array($resultCS);
		
		echo "<a style=\"color:#03F\" target=\"_blank\" href='http://".$rowCS['Web_Site']."'>".$rowCS['Company_Name']."</a>";
     ?></p>
     </div>
  <p align="center"><img src="../../images/thekey soft.jpg" width="159" height="37" /><sup ><sup style="font-size:15px">&reg;&trade;</sup></sup></p>
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
