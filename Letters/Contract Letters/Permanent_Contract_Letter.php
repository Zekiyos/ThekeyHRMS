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
  <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" -->
  <form method="post" action="http://tinymce.moxiecode.com/dump.php?example=true">
    <h3>Permanent Employeem Contract agreemant Letter</h3>
		This Letter is prepared for Permamnent employement Contract agreement which will be sign btween employee and employeer.

   <!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
      
   
    <textarea id="elm1" name="elm1" rows="30" cols="150" style="width: 80%"><meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=ProgId content=Word.Document>
<meta name=Generator content="Microsoft Word 12">
<meta name=Originator content="Microsoft Word 12">
<link rel=File-List href="../../letters/Permanent Employment Contract_files/filelist.xml">
<!--[if gte mso 9]><xml>
 <o:DocumentProperties>
  <o:Author>Zekiyos</o:Author>
  <o:Template>Normal</o:Template>
  <o:LastAuthor>Zekiyos</o:LastAuthor>
  <o:Revision>1</o:Revision>
  <o:TotalTime>1</o:TotalTime>
  <o:Created>2011-04-14T08:15:00Z</o:Created>
  <o:LastSaved>2011-04-14T08:16:00Z</o:LastSaved>
  <o:Pages>1</o:Pages>
  <o:Words>295</o:Words>
  <o:Characters>1686</o:Characters>
  <o:Company>Sher Ethiopia Plc</o:Company>
  <o:Lines>14</o:Lines>
  <o:Paragraphs>3</o:Paragraphs>
  <o:CharactersWithSpaces>1978</o:CharactersWithSpaces>
  <o:Version>12.00</o:Version>
 </o:DocumentProperties>
</xml><![endif]-->
<link rel=themeData
href="../../letters/Permanent Employment Contract_files/themedata.thmx">
<link rel=colorSchemeMapping
href="../../letters/Permanent Employment Contract_files/colorschememapping.xml">
<!--[if gte mso 9]><xml>
 <w:WordDocument>
  <w:TrackMoves>false</w:TrackMoves>
  <w:TrackFormatting/>
  <w:PunctuationKerning/>
  <w:ValidateAgainstSchemas/>
  <w:SaveIfXMLInvalid>false</w:SaveIfXMLInvalid>
  <w:IgnoreMixedContent>false</w:IgnoreMixedContent>
  <w:AlwaysShowPlaceholderText>false</w:AlwaysShowPlaceholderText>
  <w:DoNotPromoteQF/>
  <w:LidThemeOther>EN-US</w:LidThemeOther>
  <w:LidThemeAsian>X-NONE</w:LidThemeAsian>
  <w:LidThemeComplexScript>X-NONE</w:LidThemeComplexScript>
  <w:Compatibility>
   <w:BreakWrappedTables/>
   <w:SnapToGridInCell/>
   <w:ApplyBreakingRules/>
   <w:WrapTextWithPunct/>
   <w:UseAsianBreakRules/>
   <w:DontGrowAutofit/>
   <w:SplitPgBreakAndParaMark/>
   <w:DontVertAlignCellWithSp/>
   <w:DontBreakConstrainedForcedTables/>
   <w:DontVertAlignInTxbx/>
   <w:Word11KerningPairs/>
   <w:CachedColBalance/>
  </w:Compatibility>
  <w:BrowserLevel>MicrosoftInternetExplorer4</w:BrowserLevel>
  <m:mathPr>
   <m:mathFont m:val="Cambria Math"/>
   <m:brkBin m:val="before"/>
   <m:brkBinSub m:val="&#45;-"/>
   <m:smallFrac m:val="off"/>
   <m:dispDef/>
   <m:lMargin m:val="0"/>
   <m:rMargin m:val="0"/>
   <m:defJc m:val="centerGroup"/>
   <m:wrapIndent m:val="1440"/>
   <m:intLim m:val="subSup"/>
   <m:naryLim m:val="undOvr"/>
  </m:mathPr></w:WordDocument>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <w:LatentStyles DefLockedState="false" DefUnhideWhenUsed="true"
  DefSemiHidden="true" DefQFormat="false" DefPriority="99"
  LatentStyleCount="267">
  <w:LsdException Locked="false" Priority="0" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Normal"/>
  <w:LsdException Locked="false" Priority="9" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="heading 1"/>
  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 2"/>
  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 3"/>
  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 4"/>
  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 5"/>
  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 6"/>
  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 7"/>
  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 8"/>
  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 9"/>
  <w:LsdException Locked="false" Priority="39" Name="toc 1"/>
  <w:LsdException Locked="false" Priority="39" Name="toc 2"/>
  <w:LsdException Locked="false" Priority="39" Name="toc 3"/>
  <w:LsdException Locked="false" Priority="39" Name="toc 4"/>
  <w:LsdException Locked="false" Priority="39" Name="toc 5"/>
  <w:LsdException Locked="false" Priority="39" Name="toc 6"/>
  <w:LsdException Locked="false" Priority="39" Name="toc 7"/>
  <w:LsdException Locked="false" Priority="39" Name="toc 8"/>
  <w:LsdException Locked="false" Priority="39" Name="toc 9"/>
  <w:LsdException Locked="false" Priority="35" QFormat="true" Name="caption"/>
  <w:LsdException Locked="false" Priority="10" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Title"/>
  <w:LsdException Locked="false" Priority="1" Name="Default Paragraph Font"/>
  <w:LsdException Locked="false" Priority="11" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Subtitle"/>
  <w:LsdException Locked="false" Priority="0" Name="Body Text 2"/>
  <w:LsdException Locked="false" Priority="22" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Strong"/>
  <w:LsdException Locked="false" Priority="20" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Emphasis"/>
  <w:LsdException Locked="false" Priority="59" SemiHidden="false"
   UnhideWhenUsed="false" Name="Table Grid"/>
  <w:LsdException Locked="false" UnhideWhenUsed="false" Name="Placeholder Text"/>
  <w:LsdException Locked="false" Priority="1" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="No Spacing"/>
  <w:LsdException Locked="false" Priority="60" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Shading"/>
  <w:LsdException Locked="false" Priority="61" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light List"/>
  <w:LsdException Locked="false" Priority="62" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Grid"/>
  <w:LsdException Locked="false" Priority="63" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 1"/>
  <w:LsdException Locked="false" Priority="64" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 2"/>
  <w:LsdException Locked="false" Priority="65" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 1"/>
  <w:LsdException Locked="false" Priority="66" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 2"/>
  <w:LsdException Locked="false" Priority="67" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 1"/>
  <w:LsdException Locked="false" Priority="68" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 2"/>
  <w:LsdException Locked="false" Priority="69" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 3"/>
  <w:LsdException Locked="false" Priority="70" SemiHidden="false"
   UnhideWhenUsed="false" Name="Dark List"/>
  <w:LsdException Locked="false" Priority="71" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Shading"/>
  <w:LsdException Locked="false" Priority="72" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful List"/>
  <w:LsdException Locked="false" Priority="73" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Grid"/>
  <w:LsdException Locked="false" Priority="60" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Shading Accent 1"/>
  <w:LsdException Locked="false" Priority="61" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light List Accent 1"/>
  <w:LsdException Locked="false" Priority="62" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Grid Accent 1"/>
  <w:LsdException Locked="false" Priority="63" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 1"/>
  <w:LsdException Locked="false" Priority="64" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="65" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 1 Accent 1"/>
  <w:LsdException Locked="false" UnhideWhenUsed="false" Name="Revision"/>
  <w:LsdException Locked="false" Priority="34" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="List Paragraph"/>
  <w:LsdException Locked="false" Priority="29" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Quote"/>
  <w:LsdException Locked="false" Priority="30" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Intense Quote"/>
  <w:LsdException Locked="false" Priority="66" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="67" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 1"/>
  <w:LsdException Locked="false" Priority="68" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="69" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 1"/>
  <w:LsdException Locked="false" Priority="70" SemiHidden="false"
   UnhideWhenUsed="false" Name="Dark List Accent 1"/>
  <w:LsdException Locked="false" Priority="71" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Shading Accent 1"/>
  <w:LsdException Locked="false" Priority="72" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful List Accent 1"/>
  <w:LsdException Locked="false" Priority="73" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Grid Accent 1"/>
  <w:LsdException Locked="false" Priority="60" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Shading Accent 2"/>
  <w:LsdException Locked="false" Priority="61" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light List Accent 2"/>
  <w:LsdException Locked="false" Priority="62" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Grid Accent 2"/>
  <w:LsdException Locked="false" Priority="63" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 2"/>
  <w:LsdException Locked="false" Priority="64" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="65" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 1 Accent 2"/>
  <w:LsdException Locked="false" Priority="66" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="67" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 2"/>
  <w:LsdException Locked="false" Priority="68" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="69" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 2"/>
  <w:LsdException Locked="false" Priority="70" SemiHidden="false"
   UnhideWhenUsed="false" Name="Dark List Accent 2"/>
  <w:LsdException Locked="false" Priority="71" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Shading Accent 2"/>
  <w:LsdException Locked="false" Priority="72" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful List Accent 2"/>
  <w:LsdException Locked="false" Priority="73" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Grid Accent 2"/>
  <w:LsdException Locked="false" Priority="60" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Shading Accent 3"/>
  <w:LsdException Locked="false" Priority="61" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light List Accent 3"/>
  <w:LsdException Locked="false" Priority="62" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Grid Accent 3"/>
  <w:LsdException Locked="false" Priority="63" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 3"/>
  <w:LsdException Locked="false" Priority="64" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="65" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 1 Accent 3"/>
  <w:LsdException Locked="false" Priority="66" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="67" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 3"/>
  <w:LsdException Locked="false" Priority="68" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="69" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 3"/>
  <w:LsdException Locked="false" Priority="70" SemiHidden="false"
   UnhideWhenUsed="false" Name="Dark List Accent 3"/>
  <w:LsdException Locked="false" Priority="71" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Shading Accent 3"/>
  <w:LsdException Locked="false" Priority="72" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful List Accent 3"/>
  <w:LsdException Locked="false" Priority="73" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Grid Accent 3"/>
  <w:LsdException Locked="false" Priority="60" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Shading Accent 4"/>
  <w:LsdException Locked="false" Priority="61" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light List Accent 4"/>
  <w:LsdException Locked="false" Priority="62" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Grid Accent 4"/>
  <w:LsdException Locked="false" Priority="63" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 4"/>
  <w:LsdException Locked="false" Priority="64" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="65" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 1 Accent 4"/>
  <w:LsdException Locked="false" Priority="66" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="67" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 4"/>
  <w:LsdException Locked="false" Priority="68" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="69" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 4"/>
  <w:LsdException Locked="false" Priority="70" SemiHidden="false"
   UnhideWhenUsed="false" Name="Dark List Accent 4"/>
  <w:LsdException Locked="false" Priority="71" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Shading Accent 4"/>
  <w:LsdException Locked="false" Priority="72" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful List Accent 4"/>
  <w:LsdException Locked="false" Priority="73" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Grid Accent 4"/>
  <w:LsdException Locked="false" Priority="60" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Shading Accent 5"/>
  <w:LsdException Locked="false" Priority="61" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light List Accent 5"/>
  <w:LsdException Locked="false" Priority="62" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Grid Accent 5"/>
  <w:LsdException Locked="false" Priority="63" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 5"/>
  <w:LsdException Locked="false" Priority="64" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="65" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 1 Accent 5"/>
  <w:LsdException Locked="false" Priority="66" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="67" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 5"/>
  <w:LsdException Locked="false" Priority="68" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="69" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 5"/>
  <w:LsdException Locked="false" Priority="70" SemiHidden="false"
   UnhideWhenUsed="false" Name="Dark List Accent 5"/>
  <w:LsdException Locked="false" Priority="71" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Shading Accent 5"/>
  <w:LsdException Locked="false" Priority="72" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful List Accent 5"/>
  <w:LsdException Locked="false" Priority="73" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Grid Accent 5"/>
  <w:LsdException Locked="false" Priority="60" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Shading Accent 6"/>
  <w:LsdException Locked="false" Priority="61" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light List Accent 6"/>
  <w:LsdException Locked="false" Priority="62" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Grid Accent 6"/>
  <w:LsdException Locked="false" Priority="63" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 6"/>
  <w:LsdException Locked="false" Priority="64" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="65" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 1 Accent 6"/>
  <w:LsdException Locked="false" Priority="66" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="67" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 6"/>
  <w:LsdException Locked="false" Priority="68" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="69" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 6"/>
  <w:LsdException Locked="false" Priority="70" SemiHidden="false"
   UnhideWhenUsed="false" Name="Dark List Accent 6"/>
  <w:LsdException Locked="false" Priority="71" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Shading Accent 6"/>
  <w:LsdException Locked="false" Priority="72" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful List Accent 6"/>
  <w:LsdException Locked="false" Priority="73" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Grid Accent 6"/>
  <w:LsdException Locked="false" Priority="19" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Subtle Emphasis"/>
  <w:LsdException Locked="false" Priority="21" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Intense Emphasis"/>
  <w:LsdException Locked="false" Priority="31" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Subtle Reference"/>
  <w:LsdException Locked="false" Priority="32" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Intense Reference"/>
  <w:LsdException Locked="false" Priority="33" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Book Title"/>
  <w:LsdException Locked="false" Priority="37" Name="Bibliography"/>
  <w:LsdException Locked="false" Priority="39" QFormat="true" Name="TOC Heading"/>
 </w:LatentStyles>
</xml><![endif]-->
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:"Cambria Math";
	panose-1:2 4 5 3 5 4 6 3 2 4;
	mso-font-charset:0;
	mso-generic-font-family:roman;
	mso-font-pitch:variable;
	mso-font-signature:-1610611985 1107304683 0 0 159 0;}
@font-face
	{font-family:"Bookman Old Style";
	panose-1:2 5 6 4 5 5 5 2 2 4;
	mso-font-charset:0;
	mso-generic-font-family:roman;
	mso-font-pitch:variable;
	mso-font-signature:647 0 0 0 159 0;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-parent:"";
	margin:0in;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";
	mso-fareast-font-family:"Times New Roman";}
p.MsoBodyText2, li.MsoBodyText2, div.MsoBodyText2
	{mso-style-noshow:yes;
	mso-style-link:"Body Text 2 Char";
	margin-top:0in;
	margin-right:0in;
	margin-bottom:6.0pt;
	margin-left:0in;
	line-height:200%;
	mso-pagination:widow-orphan;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";
	mso-fareast-font-family:"Times New Roman";}
p.MsoListParagraph, li.MsoListParagraph, div.MsoListParagraph
	{mso-style-priority:34;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	margin-bottom:.0001pt;
	mso-add-space:auto;
	mso-pagination:widow-orphan;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";

	mso-fareast-font-family:"Times New Roman";}
p.MsoListParagraphCxSpFirst, li.MsoListParagraphCxSpFirst, div.MsoListParagraphCxSpFirst
	{mso-style-priority:34;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-type:export-only;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	margin-bottom:.0001pt;
	mso-add-space:auto;
	mso-pagination:widow-orphan;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";
	mso-fareast-font-family:"Times New Roman";}
p.MsoListParagraphCxSpMiddle, li.MsoListParagraphCxSpMiddle, div.MsoListParagraphCxSpMiddle
	{mso-style-priority:34;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-type:export-only;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	margin-bottom:.0001pt;
	mso-add-space:auto;
	mso-pagination:widow-orphan;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";
	mso-fareast-font-family:"Times New Roman";}
p.MsoListParagraphCxSpLast, li.MsoListParagraphCxSpLast, div.MsoListParagraphCxSpLast
	{mso-style-priority:34;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-type:export-only;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	margin-bottom:.0001pt;
	mso-add-space:auto;
	mso-pagination:widow-orphan;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";
	mso-fareast-font-family:"Times New Roman";}
span.BodyText2Char
	{mso-style-name:"Body Text 2 Char";
	mso-style-noshow:yes;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Body Text 2";
	mso-ansi-font-size:12.0pt;
	mso-bidi-font-size:12.0pt;
	font-family:"Times New Roman","serif";
	mso-ascii-font-family:"Times New Roman";
	mso-fareast-font-family:"Times New Roman";
	mso-hansi-font-family:"Times New Roman";
	mso-bidi-font-family:"Times New Roman";}
.MsoChpDefault
	{mso-style-type:export-only;
	mso-default-props:yes;
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-fareast-font-family:Calibri;
	mso-fareast-theme-font:minor-latin;
	mso-hansi-font-family:Calibri;
	mso-hansi-theme-font:minor-latin;
	mso-bidi-font-family:"Times New Roman";
	mso-bidi-theme-font:minor-bidi;}
.MsoPapDefault
	{mso-style-type:export-only;
	margin-bottom:10.0pt;
	line-height:115%;}
@page WordSection1
	{size:8.5in 11.0in;
	margin:1.0in 1.0in 1.0in 1.0in;
	mso-header-margin:.5in;
	mso-footer-margin:.5in;
	mso-paper-source:0;}
div.WordSection1
	{page:WordSection1;}
 /* List Definitions */
 @list l0
	{mso-list-id:589506599;
	mso-list-type:hybrid;
	mso-list-template-ids:29686250 -778537962 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l0:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:44.25pt;
	text-indent:-26.25pt;
	mso-text-animation:none;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l0:level2
	{mso-level-tab-stop:1.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l0:level3
	{mso-level-tab-stop:1.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l0:level4
	{mso-level-tab-stop:2.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l0:level5
	{mso-level-tab-stop:2.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l0:level6
	{mso-level-tab-stop:3.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l0:level7
	{mso-level-tab-stop:3.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l0:level8
	{mso-level-tab-stop:4.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l0:level9
	{mso-level-tab-stop:4.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
ol
	{margin-bottom:0in;}
ul
	{margin-bottom:0in;}
-->
</style>
<!--[if gte mso 10]>
<style>
 /* Style Definitions */
 table.MsoNormalTable
	{mso-style-name:"Table Normal";
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-qformat:yes;
	mso-style-parent:"";
	mso-padding-alt:0in 5.4pt 0in 5.4pt;
	mso-para-margin-top:0in;
	mso-para-margin-right:0in;
	mso-para-margin-bottom:10.0pt;
	mso-para-margin-left:0in;
	line-height:115%;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-hansi-font-family:Calibri;
	mso-hansi-theme-font:minor-latin;}
</style>
<![endif]--><!--[if gte mso 9]><xml>
 <o:shapedefaults v:ext="edit" spidmax="2050"/>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <o:shapelayout v:ext="edit">
  <o:idmap v:ext="edit" data="1"/>
 </o:shapelayout></xml><![endif]-->
</head>

<body lang=EN-US style='tab-interval:.5in'>

<div class=WordSection1>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><u><span style='font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'>Permanent
Employment Contract</span><o:p></o:p></u></b></p>

<p class=MsoNormal><b style='mso-bidi-font-weight:normal'><span
style='font-size:10.0pt;font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'>Employer Sher
Ethiopia Plc.<o:p></o:p></span></b></p>

<p class=MsoNormal><b style='mso-bidi-font-weight:normal'><span
style='font-size:10.0pt;font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'>P O Box 399<o:p></o:p></span></b></p>

<p class=MsoNormal><b><span style='font-size:10.0pt;font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'><span
style='mso-spacerun:yes'>           </span><u>Ziway<o:p></o:p></u></span></b></p>

<p class=MsoNormal><b style='mso-bidi-font-weight:normal'><span
style='font-size:10.0pt;font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal style='line-height:150%'><span style='font-size:11.0pt;
line-height:150%;font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'>Employee Name:
______________________________<o:p></o:p></span></p>

<p class=MsoNormal style='line-height:150%'><span style='font-size:11.0pt;
line-height:150%;font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'>Date of Birth:
________________________<o:p></o:p></span></p>

<p class=MsoNormal style='line-height:150%'><span style='font-size:11.0pt;
line-height:150%;font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'><span
style='mso-spacerun:yes'>       </span>Address: __________________________<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:11.0pt;
font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'>We are pleased to offer you a position
of <b style='mso-bidi-font-weight:normal'><u>General Worker</u> </b>in the <b
style='mso-bidi-font-weight:normal'>Sher Ethiopia </b>under the following terms
and conditions of service stipulated below:-<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:11.0pt;
font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'><o:p>&nbsp;</o:p></span></p>

<p class=MsoListParagraphCxSpFirst style='margin-left:.25in;mso-add-space:auto;
text-align:justify;text-indent:-13.5pt;mso-list:l0 level1 lfo1'><![if !supportLists]><b><span
style='font-size:11.0pt;font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;;mso-fareast-font-family:
&quot;Bookman Old Style&quot;;mso-bidi-font-family:&quot;Bookman Old Style&quot;'><span
style='mso-list:Ignore'>1.<span style='font:7.0pt &quot;Times New Roman&quot;'> </span></span></span></b><![endif]><b><u><span
style='font-size:11.0pt;font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'>Job
responsibilities &amp; location of work <o:p></o:p></span></u></b></p>

<p class=MsoListParagraphCxSpLast style='margin-left:44.25pt;mso-add-space:
auto;text-align:justify;text-indent:-44.25pt'><span style='font-size:11.0pt;
font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'><o:p>&nbsp;</o:p></span></p>

<p class=MsoBodyText2 style='line-height:normal'><span style='font-size:11.0pt;
font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'>You shall carryout the duties as
stipulated in your job description and duty as allocated to you by your
respective manager (annexed job description) <o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:45.0pt;text-align:justify'><span
style='font-size:11.0pt;font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='text-align:justify'><b><span style='font-size:11.0pt;
font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'>2.<span style='mso-spacerun:yes'> 
</span><u>Working days &amp; rest day<o:p></o:p></u></span></b></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:11.0pt;
font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:11.0pt;
font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'>You will be required to work for 48
Hours a week spread of eight hours a day for six day after which for shall be
entitled to one rest day in every period of seven days. <o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:11.0pt;
font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'>However, due to the nature and
sensitivity of your duties, you may be called upon to respond to emergency
situations this shall be compensated as either overtime or another rest day
whichever is more appropriate as per labour proclamation. <o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:11.0pt;
font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='text-align:justify'><b style='mso-bidi-font-weight:
normal'><span style='font-size:11.0pt;font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'>3.<span
style='mso-spacerun:yes'>  </span><u>Basic Salary <o:p></o:p></u></span></b></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:11.0pt;
font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='margin-left:9.0pt;text-align:justify;text-indent:
-9.0pt'><span style='font-size:11.0pt;font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'><span
style='mso-spacerun:yes'>   </span>You are entitled to a gross basic salary of <b
style='mso-bidi-font-weight:normal'><u>495 +60 transport allowance</u></b> Birr
per month. Salary shall be paid at the end of each month (European Calendar)
for wage shall be subjected to statutory deductions as required by law.<o:p></o:p></span></p>

<p class=MsoNormal><span style='font-size:11.0pt;font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal><b style='mso-bidi-font-weight:normal'><span
style='font-size:11.0pt;font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'>4.</span></b><span
style='font-size:11.0pt;font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'><span
style='mso-spacerun:yes'>  </span><b style='mso-bidi-font-weight:normal'><u>Employee
Benefit <o:p></o:p></u></b></span></p>

<p class=MsoNormal><span style='font-size:11.0pt;font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'><span
style='mso-spacerun:yes'> </span><b style='mso-bidi-font-weight:normal'><span
style='mso-spacerun:yes'>         </span></b><span
style='mso-spacerun:yes'>       </span><o:p></o:p></span></p>

<p class=MsoNormal><b style='mso-bidi-font-weight:normal'><span
style='font-size:11.0pt;font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'><span
style='mso-spacerun:yes'> </span>4.1. <u>Medical Cover <o:p></o:p></u></span></b></p>

<p class=MsoNormal><u><span style='font-size:11.0pt;font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'><o:p><span
 style='text-decoration:none'>&nbsp;</span></o:p></span></u></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:11.0pt;
font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'><span
style='mso-spacerun:yes'> </span>Medical expense for the employee shall be
covered by Sher Ethiopia.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:11.0pt;
font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='text-align:justify'><b style='mso-bidi-font-weight:
normal'><span style='font-size:11.0pt;font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'><span
style='mso-spacerun:yes'> </span>4.2.</span></b><span style='font-size:11.0pt;
font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'><span style='mso-spacerun:yes'>  
</span><b style='mso-bidi-font-weight:normal'><u>Annual Leave</u></b><o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:11.0pt;
font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'>You are entitled to annual leave with
pay at the rate of fourteen (15) days for the first one year of service and one
more working day for every additional year of service. Leave shall be taken at
the convenience of the company.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><b style='mso-bidi-font-weight:
normal'><span style='font-size:11.0pt;font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'><span
style='mso-spacerun:yes'>             </span><o:p></o:p></span></b></p>

<p class=MsoNormal style='text-align:justify'><b style='mso-bidi-font-weight:
normal'><span style='font-size:11.0pt;font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'>4.3.
<u>Sick Leave</u></span></b><u><span style='font-size:11.0pt;font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'>
<b style='mso-bidi-font-weight:normal'><o:p></o:p></b></span></u></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:11.0pt;
font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'>In the event that you are rendered
incapable of working due to sickness other than employment related injury, you
will be entitled to six (6) months sick leave and paid as follows;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:11.0pt;
font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'>a)<span style='mso-spacerun:yes'> 
</span>The first month at full pay;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:11.0pt;
font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'>b)<span style='mso-spacerun:yes'> 
</span>The next two months at 50% of your monthly wages;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:11.0pt;
font-family:&quot;Bookman Old Style&quot;,&quot;serif&quot;'>c)<span style='mso-spacerun:yes'> 
</span>The next three months shall be without pay.<o:p></o:p></span></p>
	</textarea>

	<br />
	<input type="submit" name="save" value="Submit" onClick="return confirm('Are you sure you want to This Letter for this Employee?')" />
	<input type="reset" name="reset" value="Reset" />
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
    <p>&nbsp;</p>
    <br />
    <br /> <br />
    <br />
    <?php include ("../../Notifications/ALNotification.php");?>
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
