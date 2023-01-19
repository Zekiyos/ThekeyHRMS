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
.menu_nav ul li { margin:0 4px; padding:0 8px 0 0; float:left; background:url(_template/clearfocus/html/images/menu.gif) no-repeat right center;}
.menu_nav ul li a {
	display:block;
	margin:0;
	padding:18px 16px;
	color:#F60;
	text-decoration:none;
	font-size:14px;
}
.menu_nav ul li.active a, .menu_nav ul li a:hover { background:url(_template/clearfocus/html/images/menu_a.gif) repeat-x top;;}
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
	background-image: url("img logo & icons/fade.jpg");
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
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="headerspace"></div>
<div id="wrrapper">

<div id="header">
<div id="headerAdvert">
    <H2 ><font  size="20" >Thekey</font><span id="headerAdvert"><font color="#999999" size="20" >HRMS</font><font color="#999999" size="3" ><span id="result_box3" lang="nl" xml:lang="nl"><span title="Click for alternate translations">Brengen</span> <span title="Click for alternate translations">ICT-</span><span title="Click for alternate translations">oplossing voor</span> <span title="Click for alternate translations">uw</span> <span title="Click for alternate translations">behoefte</span></span>.</font></span><font color="#999999" size="3" ><span id="result_box4" lang="nl" xml:lang="nl"><span title="Click for alternate translations">De</span> <span title="Click for alternate translations">sleutel</span> <span title="Click for alternate translations">is aan jou</span></span>! </font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../index.php"><img src="flags/United Kingdom flag.png" width="35" height="25" /></a><a href="../Amharic/index.php"><img border="0" src="flags/Ethiopiaflag.jpg" alt="Amharic(ETH)" width="35" height="30" /></a><a href="index.php"><img src="flags/Netherlands-Flag-icon.png" width="35" height="25" /></a></h2>
    <H2 ><font color="#999999" size="+5" ></font><img src="../img logo &amp; icons/logo.jpg" alt="He that hath  THE KEY  of David,  he that openeth,  and  no man shutteth;  and shutteth,  and no man openeth;" width="100" height="40" />
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
            <li><a href="Recriutment/Recruitment.php">Werving vorm</a></li>
            <li><a href="Equipment HandOver/Equipment_HandOver.php">Apparatuur Handover</a></li>
          </ul>
        </li>
        <li><a href="Personal Record/Personal_Information_Detail.php">Persoonlijke Informatie</a></li>
        <li><a href="#" class="MenuBarItemSubmenu"><span id="result_box2" lang="nl" xml:lang="nl"><span title="Click for alternate translations">Verlof</span></span></a>
          <ul>
            <li><a href="#" class="MenuBarItemSubmenu">Jaarlijks verlof</a>
              <ul>
                <li><a href="Leaves/Annual_Leave_Grant.php">Jaarlijks verlof Grant vorm</a></li>
                <li><a href="Leaves/Annual_Leave_Calculate.php">Run Jaarlijks verlof Berekening</a></li>
              </ul>
            </li>
            <li><a href="Leaves/Funeral_Leave_Grant.php">Laat begrafenis</a></li>
            <li><a href="Leaves/Maternity_Leave_Grant.php">Zwangerschapsverlof</a></li>
            <li><a href="Leaves/Sick_Leave_Grant.php">Sick Leave</a></li>
            <li><a href="Leaves/Wedding_Leave_Grant.php">Laat bruiloft</a></li>
            <li><a href="Leaves/Back_From_Leave_Report.php">Back to Work Report</a></li>
          </ul>
        </li>
        <li><a class="MenuBarItemSubmenu" href="#">Disciplinaire maatregelen</a>
          <ul>
            <li><a href="Letters/warning Letters/Verbal_Warning.php">Mondelinge waarschuwing</a>            </li>
            <li><a href="#">Salaris bestraffing</a></li>
            <li><a href="#" class="MenuBarItemSubmenu">Schriftelijke waarschuwing</a>
              <ul>
                <li><a href="Letters/warning Letters/First_Instance_Warning.php">1 aanleg Waarschuwing</a></li>
                <li><a href="Letters/warning Letters/Second_Instance_Warning.php">2 aanleg Waarschuwing</a></li>
                <li><a href="Letters/warning Letters/Third_Instance_Warning.php">3 aanleg Waarschuwing</a></li>
                <li><a href="Letters/warning Letters/Last_Warning.php">Laatste waarschuwing</a></li>
</ul>
            </li>
            <li><a href="#" class="MenuBarItemSubmenu">Beëindiging</a>
              <ul>
                <li><a href="Letters/warning Letters/Termination.php">Beëindiging Formulier</a></li>
                <li><a href="#">Opzeggingsbrief</a></li>
              </ul>
            </li>
            <li><a href="javascript: if (confirm('Are You Sure You want to remove Expired Warning?')) { window.location.href='../Dutch/Letters/warning Letters/Expired_Warning_Remover.php' } else { void('') }; ">verstreken Waarschuwing Remover</a></li>
          </ul>
        </li>
        <li><a target="_blank" href="http://localhost/Report/annual_leaverpt.php">Verslag</a></li>
        <li><a href="#" class="MenuBarItemSubmenu">Contract</a>
          <ul>
            <li><a href="Letters/Contract Letters/Permanent_Contract_Letter.php">Dienstverband voor onbepaalde tijd</a></li>
          </ul>
        </li>
        <li><a href="#" class="MenuBarItemSubmenu">Voordelen</a>
          <ul>
            <li><a href="Medical/Medical_Referral.php">Medische verwijzing van</a></li>
            <li><a href="Training/Training.php">Training</a></li>
          </ul>
        </li>
</ul>

      </div>
  </div>
  <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" -->
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
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
    <blockquote>&nbsp;</blockquote>
  </div>
  <div id="sidebar">
    <div id="sidemenu">
    
   <ul id="MenuBar2" class="MenuBarVertical">
     <li><a href="Recriutment/Probation_Evaluation.php">Proeftijd Evaluatie</a>       </li>
     <li><a href="#" class="MenuBarItemSubmenu">Persoonlijke Detail</a>
       <ul>
         <li><a href="Personal Record/Employee_Personal_Record.php">Persoonlijke Detail Entry</a></li>
         <li><a href="../Database_Update/PersonalRecordDisplay.php" target="_blank">Persoonlijke Record Search</a></li>
       </ul>
     </li>
     <li><a href="#" class="MenuBarItemSubmenu">De status van werknemer Transactie</a>
       <ul>
         <li><a href="Employee_Status_Transaction/Promotion.php">Promotie</a></li>
         <li><a href="Employee_Status_Transaction/Demotion.php">Demotie</a></li>
         <li><a href="Employee_Status_Transaction/Department_Transfer.php">Afdeling Transfer</a></li>
       </ul>
     </li>
<li><a href="Proclamation/Ethiopian Labour Law Pro.377(Dutch).htm" target="_blank">Arbeidsrecht Proclamatie</a></li>
     <li><a href="#" class="MenuBarItemSubmenu"> HRM-systeem Instellingen ...</a>
       <ul>
<li><a href="#" class="MenuBarItemSubmenu">Gebruikersaccount</a>
  <ul>
    <li><a href="../User_Account/Creat_Account.php">Maak Gebruikersaccount</a></li>
    <li><a href="../User_Account/Change_Password.php">Wachtwoord wijzigen</a></li>
    <li><a href="../User_Account/Delete_Account.php">Verwijderen Gebruikersaccount</a></li>
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
    <?php include ("Notifications/ALNotification.php");?>
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
