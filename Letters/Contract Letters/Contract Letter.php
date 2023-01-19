<?php require_once('../../Connections/HRMS.php'); ?>
<?php 
include('../../Classes/Class_AccessLevel.php');
 $obj_AccessLevel = new AccessLevel();
echo $obj_AccessLevel->CHK_AccessLevel(); 
?>
<?php include('../../Classes/Class_language.php');?>
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
				 /*$count=0;
				
       			 		$queryDA  = "SELECT * FROM Disciplinary_action where id='".$_GET['ID']."'";
				
						$resultDA = mysql_query($queryDA);
				while($rowDA = mysql_fetch_array($resultDA, MYSQL_ASSOC))
				{
					
					if ($rowDA['ID'] == $_GET['ID'])
					{
						
				
				$updateDASQL="UPDATE Disciplinary_action SET `First_Inistance`='". $_POST['First_Inistance'] ."',`First_Inistance_Date`='". $_POST['First_Inistance_Date']."' WHERE ID = '". $_GET['ID'] ."'";
					
		mysql_query($updateDASQL);
						
                 $count=1;
					}
				}
				 
		
	if($count==0)
	{
  $insertSQL = sprintf("INSERT INTO disciplinary_action (ID, FirstName, MiddelName, LastName, Department, First_Inistance,First_Inistance_Date) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_GET['ID'], "text"),
                       GetSQLValueString($_POST['FirstName'], "text"),
                       GetSQLValueString($_POST['MiddelName'], "text"),
                       GetSQLValueString($_POST['LastName'], "text"),
                       GetSQLValueString($_POST['Department'], "text"),
                       GetSQLValueString($_POST['First_Inistance'], "text"),
					   GetSQLValueString($_POST['First_Inistance_Date'], "text"));

  mysql_select_db($database_HRMS, $HRMS);
  $Result1 = mysql_query($insertSQL, $HRMS) or die(mysql_error());
	}*/
}

mysql_select_db($database_HRMS, $HRMS);
$query_RSFristWarniing = "SELECT * FROM employee_personal_record";
$RSFristWarniing = mysql_query($query_RSFristWarniing, $HRMS) or die(mysql_error());
$row_RSFristWarniing = mysql_fetch_assoc($RSFristWarniing);
$totalRows_RSFristWarniing = mysql_num_rows($RSFristWarniing);

?>
<!-- TinyMCE -->
<script type="text/javascript" src="../../js/tiny_mce/tiny_mce.js"></script>
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/ThekeyHRMS_main_Template.dwt" codeOutsideHTMLIsLocked="false" -->
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
            <li><a href="../../Recruitment/Recruitment.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Recruitment Form', $lang); ?></a></li>
            <li><a href="../../Recruitment/Photo Capture/Capture.php" target="_blank"><?php echo $obj_lang->get('Photo Capturing', $lang); ?></a></li>
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
            <li><a href="../warning Letters/Verbal_Warning.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Verbal Warning', $lang); ?></a>            </li>
<li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Written Warning', $lang); ?></a>
              <ul>
                <li><a href="../warning Letters/First_Instance_Warning.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('1st Instance Warning', $lang); ?></a></li>
                <li><a href="../warning Letters/Second_Instance_Warning.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('2nd Instance Warning', $lang); ?></a></li>
                <li><a href="../warning Letters/Third_Instance_Warning.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('3rd Instance Warning', $lang); ?></a></li>
                <li><a href="../warning Letters/Last_Warning.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Last Warning', $lang); ?></a></li>
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
            <li><a href="../warning Letters/Warning_Letters_Viewer.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Warning Letter Viewer', $lang); ?></a></li>
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
<li><a href="Creat Contract Letter.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Creat New Contract', $lang); ?></a></li>
<li><a href="Contract Letter.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Contract Letter', $lang); ?></a></li>
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
  <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" --> <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table width="1000" align="center" >
     <tr valign="baseline">
      <td width="132">
     <?php
$_GET['TableName']="employee_personal_record";

$_GET['OpenPage']="Contract Letter";

 include("../../Search Name/SearchName.php");?>
 
     </td></tr><tr>
      <td width="414" align="left" nowrap="nowrap"><?php echo $obj_lang->get('First Name', $lang); ?>:
        <input type="text" name="FirstName" value="<?php
            
       			 		$query  = "SELECT * FROM total_deduction";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					 if(isset($_GET['ID'] )){	
					if ($row['ID'] == $_GET['ID'])
					{
						
					echo "{$row['FirstName']}";
					
					}
					
				}
				}?>" size="20" readonly="readonly"  />
        <input type="text" name="MiddelName" value="<?php
            
       			 		$query  = "SELECT * FROM total_deduction";
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
        <input type="text" name="LastName" value="<?php
            
       			 		$query  = "SELECT * FROM total_deduction";
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
      <tr valign="baseline"><td><?php echo $obj_lang->get('Department', $lang); ?>:<input type="text" name="Department" value="<?php
            
       			 		$query  = "SELECT * FROM total_deduction";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					 if(isset($_GET['ID'] )){	
					if ($row['ID'] == $_GET['ID'])
					{
						
					echo "{$row['Department']}";
					
					}
					
				}
				}?>"  readonly="readonly" size="32" />
        <?php echo $obj_lang->get('Date', $lang); ?>:
       <script type='text/JavaScript' src="../../js/scw.js" ></script> <input type="text" name="Date" onclick='scwShow(this,event);' value='<?php echo date("Y-m-d");?>' /></td>
          
    </tr>
    
    <tr valign="baseline">
      <td nowrap="nowrap" align="left" valign="top"><p><?php echo $obj_lang->get('Contract Letter', $lang); ?>
        <textarea name="Contract Letter" cols="70" rows="43" >
      <p><img src="../../images/Company_logo.JPG"  alt="" width="70" height="40" />                                                               <br />
  AQ ROSES PLC<br />
  P O Box 404 <br />
  <u>ZEWAY</u></p>
<p> Date:<u><?php echo date("d/m/Y"); ?></u><br />
  To:<?php $query  = "SELECT * FROM total_deduction";
	$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					 if(isset($_GET['ID'] ))
					 {	
						if ($row['ID'] == $_GET['ID'])
						{
							
						echo "<br><b><font size=\"+3\">"."TO:  <u>"."{$row['FirstName']}";
						echo " {$row['MiddelName']}";
						echo " {$row['LastName']}"."</u></br></b></font>";
						}
					
					 }
				}?></p>
<p> <strong><u> RE: Permanent Employment Contract</u></strong> <br />
  We  are pleased to offer you a Permanent employment contract as a general worker in  the<strong> <?php
            
       			 		$query  = "SELECT * FROM total_deduction";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					 if(isset($_GET['ID'] )){	
					if ($row['ID'] == $_GET['ID'])
					{
					
					
					echo " {$row['Department']}</u></font>";
					
					}
					
					 }
					 }
				 ?> </strong>section with a  probation period of forty five (45) days under  the terms and conditions of service stipulated below:<strong><u></u></strong></p>
<ul>
  <li><strong><u>Designation  and location of work</u></strong></li>
</ul>
<p>           You will be  deployed to the <strong><?php
            
       			 		$query  = "SELECT * FROM recruitment";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					 if(isset($_GET['ID'] )){	
					if ($row['ID'] == $_GET['ID'])
					{
					
					echo "<br><b>Position:  <u><font size=\"+3\">";
					echo " {$row['Position']}</u></font>";
					
					}
					
					 }
					 }
				 ?> </strong>section  to perform the following duties:</p>
                 <?php
            
						if(isset($_GET['ID'] )){	
						$query ="SELECT `total_deduction`.ID,Job_Description,Job_Description_Amharic FROM `contract_letter` JOIN `total_deduction` ON Contract_letter.Department =`total_deduction`.Department "; //WHERE `employee_personal_record`.ID = ".$_GET['ID']."";
						$result = mysql_query($query);
						
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					
					if ($row['ID'] == $_GET['ID'])
					{
					
					echo "<br><b><font size=\"+3\">";
					echo " {$row['Job_Description']}</font>";
					
					}
					
				}	 }
					
				 ?>
<!--ul>
  <li>Packaging of the flowers in the boxes</li>
  <li>Fill the boxes according to the known packaging  rate</li>
  <li>Loading and offloading the cold truck</li>
  <li>Keep your area always clean and tidy</li>
  <li>Any other duties as may be lawfully assigned to  you by the management from time to time.</li>
</ul-->
<ul>
  <li><strong><u>Commencement  Date</u></strong></li>
</ul>
<p>This contract  comes into effect starting from<u><?php echo date("d/m/Y"); ?></u>. </p>
<ul>
  <li><strong><u>Hours of  work</u></strong></li>
</ul>
<p>The normal working week shall  consist of forty-eight hours of work spread over six days of the week  comprising of six (6) days of eight (8) hours of work per day.</p>
<ul>
  <li><strong><u>Over time</u></strong></li>
</ul>
<p>Where you are  requested by management to work in excess of the normal hours of work per day  or week as specified in paragraph 4 above due to urgent work, you shall be paid  for over time according to the labor proclamation377/2003 section 66.</p>
<ul>
  <li><strong><u>Weekly  rest</u></strong></li>
</ul>
<p>You are  entitled to one (1) rest day in every period of seven (7) days with pay.  However, where the rest day does not fall on a Sunday owing to the nature of  our operations, any other day will be made a rest day as a substitute.</p>
<ul>
  <li><strong><u>Public  holidays</u></strong></li>
</ul>
<p>Public holiday  shall be with full pay and where you are required to work on such days, you  will be paid two and one half (2 1/2) the basic hourly rate. Where  the public holiday coincides or falls on your rest day, you will be entitled to  only one payment.</p>
<p>&nbsp;</p>
<ul>
  <li><strong><u>Leave</u></strong></li>
  <li>On completion of one (1) year of service you  will be entitled to pro-rata leave at the rate of 14 days (fourteen days) for  every completed year of service, according to the labor proclamation 377/2003  section 76.</li>
  <li>Medical expenses and sick leave of the employee  will be covered by the company if the employee gets medication in Sher Hospital.  This facility is also available for the direct family (parents,  brothers/sisters, husband/wife, and children) of the employee, but these  expenses will not be covered by the employer.</li>
  <li>Maternity leave of three months will be granted  by the employer.</li>
  <li><strong><u>Payment  of wages</u></strong></li>
</ul>
<p>You are  entitled to a gross basic salary of birr <?php
            
       			 		$query  = "SELECT * FROM total_deduction";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					 if(isset($_GET['ID'] )){	
					if ($row['ID'] == $_GET['ID'])
					{
					
					
					echo " {$row['Basic Salary']}</u></font>";
					
					}
					
					 }
					 }
				 ?> (----------------------------------) per month. In addition to this, you will  be paid birr <?php
            
       			 		$query  = "SELECT * FROM total_deduction";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					 if(isset($_GET['ID'] )){	
					if ($row['ID'] == $_GET['ID'])
					{
					
					
					echo " {$row['Present_Allowance_Amount']}</u></font>";
					
					}
					
					 }
					 }
				 ?> (_____________________________ birr) present allowance which shall be subject to  deduction in case you are absent without permission. Salary &amp; allowance will  be paid at the end of each month.</p>
<ul>
  <li><strong><u>Health  and safety at work </u></strong></li>
  <li>You will be expected to adhere to the safety  procedures and the health and safety precautions as provided for the safety  regulations of the company.</li>
  <li>You should not do or omit to do any thing likely  to endanger your health or that of any other person at your place of work.</li>
  <li>You should wear any applicable protective  equipment provided to you all the times while performing your task.</li>
  <li>You will not partake in any food or drink at  prohibited places or smoke in any place likely to cause rise to hazardous dusts  or fumes.</li>
  <li>You will not misuse any company property.</li>
  <li>You should notify your supervisor immediately  when an accident occurs to you.</li>
  <li>You should endeavor to conserve the environment.</li>
  <li><strong><u>Disciplinary offences at work</u></strong>                                                                                                                                              In case of disciplinary offences during work at the company, the  employer will  decide disciplinary actions  according to the internal regulations of the company.</li>
  <li><strong><u>Others</u></strong></li>
</ul>
<p>In situations not mentioned in  this contract, the decision will be made based on the CBA. When no CBA is  available, the decision will be in accordance with the Ethiopian labor  proclamation.<br />
  I…………………………………………have read and understood the above contract terms and I  accept to be bound by this contract.<br />
  <br />
  Employee's signature…………………Date……………………..<br />
  <br />
  <strong><u>Contact  person in case of emergency</u></strong><br />
  Name……………………………………<br />
  Address: occupation…………………….<br />
  Kebele…………House number……..<strong><u></u></strong><br />
  <strong>                      </strong>Telephone<strong>………………                                                                                                                      </strong></p>
<p><strong>                                                                                                Yours  faithfully</strong></p>
<p align="right"><strong>                                                                                                                                                                                                                                       </strong><strong> </strong><br />
  <strong>                                                                                         Aychiluhim  Abebe                  Human Resource Manager</strong><br />
  <p align="left"><img src="../../images/AQlogo.gif"  alt="" width="70" height="40" /></p>
<p>   ኤ  ኪው ሮዝስ ኃ/የተ/የግ/ማ<br />
  ፖ.ሣ.ቁ 4ዐ4<br />
  ዝዋይ<br />
  <br />
  ቀን<u><?php echo date("d/m/Y"); ?></u> <br />
  <br />
ለ<u><?php $query  = "SELECT * FROM total_deduction";
	$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					 if(isset($_GET['ID'] ))
					 {	
						if ($row['ID'] == $_GET['ID'])
						{
							
						echo "<br><b><font size=\"+3\">"."<u>"."{$row['FirstName']}";
						echo " {$row['MiddelName']}";
						echo " {$row['LastName']}"."</u></br></b></font>";
						}
					
					 }
				}?></u>  </p>
<p><u>ቀሚ የስራ ውል ስምምነት</u></p>
<p>ኤ ኪው ሮዝስ ኃ/የተ/የግ/ድ  እርስዎን በአበባ እርሻ ሁለገብ ሠራተኝነት ከአርባ አምስት ቀን የሙከራ ጊዜ በኋላ በቋሚነት የሚፀና የቅጥር ውል ሲሰጥዎት  ደስተኛ ሲሆን በ <u><?php
            
       			 		$query  = "SELECT * FROM total_deduction";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					 if(isset($_GET['ID'] )){	
					if ($row['ID'] == $_GET['ID'])
					{
					
					
					echo " {$row['Department']}</u></font>";
					
					}
					
					 }
					 }
				 ?></u> የሥራ  ክፍል  ከዚህ በታች የተገለ<span unicode1="Unicode1""'>è</span>ትን የሥራ ውል አካሎች እንደሚከተለው ያሳውቃል፡፡<br />
  1 <strong><u>የስራ ድር</u></strong><strong><u><span unicode1="Unicode1""'>h</span></u></strong><strong> </strong><br />
  <?php
            
						if(isset($_GET['ID'] )){	
						$query ="SELECT `total_deduction`.ID,Job_Description,Job_Description_Amharic FROM `contract_letter` JOIN `total_deduction` ON Contract_letter.Department =`total_deduction`.Department "; //WHERE `employee_personal_record`.ID = ".$_GET['ID']."";
						$result = mysql_query($query);
						
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					
					if ($row['ID'] == $_GET['ID'])
					{
					
										echo " {$row['Job_Description_Amharic']}</font>";
					
					}
					
				}	 }
					
				 ?>
  <!--strong><em><u>አበባ ማቀዝቀዣና ማሸጊያ ክፍል </u></em></strong><strong><em><u><span unicode1="Unicode1""'>(</span>cold  store and Packing section</u></em></strong><strong><em><u><span sans-serif="sans-serif""'>)</span></u></em></strong></p>
<ul>
  <li>አበቦችን በካርቶን ውስጥ ማሸግ</li>
  <li>አበቦችን በሚታወቅ የማሸጊያ መጠን በካርቶን ውስጥ  በአግባቡ በመደርደር ማሸግ</li>
  <li>ሁልጊዜ ከሥራ በኋላ የማሸጊያ ክፍልን አጠቃላይ ንጽሕና  እንዲኖረው ማድረግ፡፡</li>
  <li>የታሸጉ አበቦችን በመጫን ካርቶን እና የተለያዩ እቃዎችን  ከመኪና ላይ ማውረድ፡፡</li>
  <li>በአጠቃላይ በድርጅቱ የሚታዘዙትን ሥራ መሥራት፡፡</li>
</ul-->
<p><strong>  2</strong>.  <strong><em><u>ውሉ የሚፀናበት ጊዜ</u></em></strong><br />
  ይህ የሥራ ውል እ.አ.አ. ከ <u><?php echo date("d/m/Y"); ?></u> የፀና ይሆናል፡፡<br />
  3 <strong><em><u>የሥራ ሰዓት እና ጊዜ</u></em></strong><br />
  በሳምንት ውስጥ 48 ሰዓት መስራት ይጠበቅብዎታል፡፡  ይህም በስድስት ቀናት ውስጥ የሚኖር የሥራ ጊዜ ነው፡፡</p>
<ul>
  <li><strong><em><u>የትርፍ  ሰዓት ክፍያ</u></em></strong></li>
</ul>
<p>በድርጅቱ ኃላፊዎች  ታዘው ትርፍ ሰዓት እንዲሰሩ ቢጠየቁ የኢትዮጲያ አሠሪና ሠራተኛ ህግ ባወጣው የትርፍ ሰዓት አዋጅ  መሰረት ክፍያው ይፈጸማል ፡፡<br />
  5.   <strong><em><u>የሳምንት እረፍት ቀን</u></em></strong><br />
  በሳምንት ውስጥ አንድ የእረፍት ቀን ይኖርዎታል፡፡  የእረፍት ቀንዎ በመስሪያ ቤቱ የስራ ኘሮግራም መሰረት የሚወሰን ይሆናል፡፡<br />
  6   <strong><em><u>የህዝብ  በዓላት ክፍያ</u></em><u></u></strong><br />
  በድርጅቱ ኃላፊዎች ታዘው በበዓላት እንዲሰሩ ቢጠየቁ የኢትዮጲያ አሠሪና ሠራተኛ አዋጅ 377/96 ባወጣው ህግ መሰረት ክፍያው ይፈጸማል፡፡</p>
<p>  7    <strong><em>የ<u>ተለያዩ  እረፍቶች</u></em></strong><u></u></p>
<ul>
  <li>በድርጅቱ ለአንድ ዓመት ከሰሩ በኋላ ለ14 ቀናት እረፍት  ይኖሮታል፡፡እረፍቱም በድርጅቱ የስራ ኘሮግራም ተፈጻሚ ይሆናል፡፡</li>
  <li>በድርጅቱ የውስጥ ደንብ መሰረት የህክምና ወጪዎን ድርጅቱ  ይሸፍናል፡፡ </li>
</ul>
<p>&nbsp;</p>
<p><strong>   8    <u>የወር ደመወዝ</u></strong></p>
<p><span ge\0027ez-1="Ge\0027ez-1""'>ከግብር  በፊት በወር  </span>ብር <?php
            
       			 		$query  = "SELECT * FROM total_deduction";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					 if(isset($_GET['ID'] )){	
					if ($row['ID'] == $_GET['ID'])
					{
					
					
					echo " {$row['Basic Salary']}</u></font>";
					
					}
					
					 }
					 }
				 ?>  (----------------------------------)  ደመወዝ ይከፈልዎታል፡፡ በተጨማሪም በየወሩ ብር <?php
            
       			 		$query  = "SELECT * FROM total_deduction";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					 if(isset($_GET['ID'] )){	
					if ($row['ID'] == $_GET['ID'])
					{
					
					
					echo " {$row['Present_Allowance_Amount']}</u></font>";
					
					}
					
					 }
					 }
				 ?>
 (__________________ ብር) በሥራ ላይ የመገኘት  አበል (Present allowance)) ደመወዝም ሆነ አበል እ.ኤ.አ  በወሩ መጨረሻ ይከፈላል፡፡</p>
<p><strong>   9.<u> ጤናና ደኀንነትን በተመለከተ</u></strong></p>
<ul>
  <li>ድርጅቱ ለደህንነትዎ የሚሰጠዎትን አልባሳትና መሳሪያዎችን  በአግባቡ መጠቀምና ለድርጅቱ ሥራ ብቻ ማዋል፡፡</li>
  <li>ድርጅቱን እርስዎንና ሌሎችን ለአደጋ የሚያጋልጥ ሥራ  በድርጅቱ ቅጥር ግቢ ውስጥ አለማድረግ፡፡</li>
  <li>በተከለከለ ቦታ ምግብ መጠጥ ሲጋራ እና የመሣሠሉት  መጠቀም ክልክል ነው፡፡</li>
  <li>የድርጅቱን ንብረት  ያለ አግባብ አለመጠቀም፡፡          </li>
  <li>በድርጅቱና በሌሎች ላይ አደጋ ሊያስከትል ይችላል ብለው  የሚጠራጠሩት ነገር ካለ ወዲያውኑ ለቅርብ አለቃዎ ማሳወቅ፡፡</li>
  <li>የአካባቢውን አየር ንብረት ሊበክሉ የሚችሉ ነገሮችን  አለማድረግ፡፡</li>
</ul>
<p><strong>10. <u>የሥነ ምግባር ጉድለትን በተመለከተ</u></strong><br />
  <strong>  </strong>በድርጅቱ  ውስጥ ምንም ዓይነት የሥነ ምግባር ጉድለትና የድርጅቱን የውስጥ ህግ የሚጥስ ሠራተኛ በድርጅቱ የውስጥ ህግ መሰረት ቅጣት  ይሰጠዋል፡፡<br />
  <strong>11 <u>ሌሎች  </u></strong><br />
  በዚህ ውል ላለ ያልተጠቀሰ ማናቸውም ነረሮች የኀብረት  ስምምነት ካለ በነብረት ስምምነት ከሌለ በኢትዮጲያ ሠራተኛና አሠሪ ህግ መሰረት ተፈፃሚ ይሆናል፡፡<br />
  ከዚህ በላሐይ በተገለፀው መሰረት እኔ አቶ/ወ/ሮ/ወ/ሪት<u>                      </u>አምብቤና ተረድቼ በውሉ ውስጥ  ያሉትን ነገሮች በሙሉ በመስማማት ውሉን ፈርሜያለሁ፡፡<br />
  የሠራተኛው ፊርማ<u>                       </u>ቀን<u>                      </u><br />
  <u>በአደጋ ጊዜ የቅርብ ተጠሪ</u><br />
  ስም<u>                         </u><br />
  አድራሻ፡ የሥራ አድርሻ<u>                   </u><br />
  ቀበሌ<u>             </u>የቤት ቁጥር<u>                       </u><br />
  ስልክ ቁጥር<u>                     </u>                                          <br />
  <br />
<p align="right"> ከሰላምታ  ጋር<br />
  <br />
  አይችሉህም አበበ<br />
  የሰው  ኀይል አስተዳደር<strong><u></u></strong></p></p></strong></p>                                 
           </textarea>
      </td>
     <script type="text/javascript">
function toggle(element) {
    document.getElementById(element).style.display = (document.getElementById(element).style.display == "none") ? "" : "none";
//style="display: none;"
}
</script>
<!--input value="ContractLetter" type="button" onClick="javascript:toggle('ContractLetter')" /-->
    <div id="ContractLetter" ></div>
    </tr>
    
    <tr valign="baseline">
      <td nowrap="nowrap" align="center"><input type="reset" name="reset" value="<?php echo $obj_lang->get('Reset', $lang); ?>" /></td>
     
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
     <li><a href="#"><?php echo $obj_lang->get('Tools', $lang); ?></a>
       <ul>
         <li><a href="javascript:popup('Calendar/CalendarConvertor.html')"><?php echo $obj_lang->get('Calendar Convertor', $lang); ?></a></li>
         <li><a href="Calendar/GeorgianEthiopianYearlyCalendar.html" target="_blank"><?php echo $obj_lang->get('Calendar', $lang); ?></a></li>
         <li><a href="javascript:popup('Calendar/Time.html')"><?php echo $obj_lang->get('Time', $lang); ?></a></li>
       </ul>
     </li>
     <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Personal Detail', $lang); ?></a>
       <ul>
       <li><a href="../../Recruitment/Probation_Evaluation.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Probation Period Evaluation', $lang); ?></a>       </li>
         <li><a href="../../Personal Record/Employee_Personal_Record.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Personal Detail entry', $lang); ?></a></li>
         <li><a href="../../Database_Update/PersonalRecordDisplay.php?lang=<?php echo $_REQUEST['lang']; ?>" target="_blank"><?php echo $obj_lang->get('Personal Detail Search', $lang); ?></a></li>
         <li><a href="../../Recruitment/Recruitment Data Update/ProbationPersonalRecordDisplay.php?lang=<?php echo $_REQUEST['lang']; ?>" title="Probation Period Personal Record Search" target="_blank"><?php echo $obj_lang->get('Probation Period Record Search', $lang); ?></a></li>
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
             <li><a href="../../Recruitment/Recruitment Data Update/RecruitmentDisplay.php" title="Recruitment Data" target="_blank"><?php echo $obj_lang->get('Recruitment Data', $lang); ?></a></li>
<li><a href="../../Recruitment/Recruitment Data Update/ProbationEvaluationDisplay.php" title="Probation Evaluation Data" target="_blank"><?php echo $obj_lang->get('Probation Evalution Data', $lang); ?></a></li>
<li><a href="../../Equipment HandOver/Equipment Handover Database Update/EquipmentHandOverDisplay.php" title="Equipment handover Data" target="_blank"><?php echo $obj_lang->get('Equipment Handover Data', $lang); ?></a></li>
<li><a href="../warning Letters/Disciplinary Action Database Update/DisciplinaryDataDisplay.php" title="Disciplinary Action Data" target="_blank"><?php echo $obj_lang->get('Disciplinary Action  Data', $lang); ?></a></li>
 <li><a href="../../Salary Increment Report/Salary Increment Database Update/SalaryIncrementDisplay.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Salary Increment Data', $lang); ?></a></li>
<li><a href="../../Employee_Status_Transaction/Employee Status Database Update/PromotionDisplay.php" title="Promotion Data" target="_blank"><?php echo $obj_lang->get('Promotion Data', $lang); ?></a></li>
<li><a href="../../Employee_Status_Transaction/Employee Status Database Update/DemotionDisplay.php" title="Demotion Data" target="_blank"><?php echo $obj_lang->get('Demotion Data', $lang); ?></a></li>
<li><a href="../warning Letters/Disciplinary Action Database Update/TerminationDisplay.php" title="Termination Data" target="_blank"><?php echo $obj_lang->get('Termination Data', $lang); ?></a></li>
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
        <p><br />
    <br /> <br />
    <br />
    <a href="../../Proclamation/Ethiopian Labour Law Pro.377(English).htm#a4" target="_blank"><?php echo $obj_lang->get('Contract of Employment Labour Law', $lang); ?></a>
      <?php //include ("../../Notifications/ALNotification.php"); ?>
		
        
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
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
