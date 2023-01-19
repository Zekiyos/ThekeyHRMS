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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Amharic_Template.dwt" codeOutsideHTMLIsLocked="false" -->
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
.menu_nav ul li { margin:0 4px; padding:0 8px 0 0; float:left; background:url(../../../_template/clearfocus/html/images/menu.gif) no-repeat right center;}
.menu_nav ul li a {
	display:block;
	margin:0;
	padding:18px 16px;
	color:#F60;
	text-decoration:none;
	font-size:14px;
}
.menu_nav ul li.active a, .menu_nav ul li a:hover { background:url(../../../_template/clearfocus/html/images/menu_a.gif) repeat-x top;;}
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
	background-image: url("../../../img logo & icons/fade.jpg");
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
<script src="../../../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../../../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<link href="../../../SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="../../../img logo &amp; icons/favicon.ico" >
<link rel="icon" href="../../../img logo &amp; icons/animated_favicon.gif" type="image/gif" >
</head>

<body>
<div id="headerspace"></div>
<div id="wrrapper">

<div id="header">
<div id="headerAdvert">
    <H2 ><font  size="20" >Thekey</font><span id="headerAdvert"><font color="#999999" size="20" >HRMS</font><font color="#999999" size="3" >    Bringing ICT Solution to Your need.</font>  </span> <font color="#999999" size="3" >The key is yours!! </font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../../../index.php"><img src="../../../flags/United Kingdom flag.png" width="35" height="25" /></a><a href="../../index.php"><img src="../../../flags/Ethiopiaflag.jpg" width="35" height="30" /></a><a href="../../../Dutch/index.php"><img src="../../../flags/Netherlands-Flag-icon.png" width="35" height="25" /></a></h2>
    <H2 ><font color="#999999" size="+5" ></font><img src="../../../img logo &amp; icons/logo.jpg" alt="He that hath  THE KEY  of David,  he that openeth,  and  no man shutteth;  and shutteth,  and no man openeth;" width="100" height="40" />
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
<li><a href="../../index.php"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">መግቢያ</span></a>        </li>
        <li><a href="../../Recruitment/Recruitment.php" class="MenuBarItemSubmenu"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">ቅጥር</span></a>
          <ul>
            <li><a href="../../Recruitment/Recruitment.php"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">የቅጥር ቅጽ</span></a></li>
            <li><a href="../../Equipment HandOver/Equipment_HandOver.php">እቃ ርክክብ </a></li>
          </ul>
        </li>
        <li><a href="../../Personal Record/Personal_Information_Detail.php"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">የግል ማሕደር</span></a></li>
        <li><a href="#" class="MenuBarItemSubmenu"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">ፍቃድ</span></a>
          <ul>
            <li><a href="#" class="MenuBarItemSubmenu"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">የአመት ፍቃድ</span></a>
              <ul>
                <li><a href="../../Leaves/Annual_Leave_Grant.php"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">የአመት ፍቃድ</span></a></li>
                <li><a href="../../Leaves/Annual_Leave_Calculate.php"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">	የአመት ፍቃድ አስላ</span></a></li>
              </ul>
            </li>
            <li><a href="../../Leaves/Funeral_Leave_Grant.php"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">የቀብር ፈቃድ</span></a></li>
            <li><a href="../../Leaves/Maternity_Leave_Grant.php"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">የወሊድ ፍቃድ</span></a></li>
            <li><a href="../../Leaves/Sick_Leave_Grant.php"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">የሕመም ፍቃድ</span></a></li>
            <li><a href="../../Leaves/Wedding_Leave_Grant.php"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">የጋብቻ ፍቃድ</span></a></li>
            <li><a href="../../Leaves/Back_From_Leave_Report.php">ወደሥራ መመለሱን ማሳወቂያ</a></li>
          </ul>
        </li>
        <li><a class="MenuBarItemSubmenu" href="#"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">መስጠንቀቂያ</span></a>
          <ul>
            <li><a href="../warning Letters/Verbal_Warning.php"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">የቃል መስጠንቀቂያ</span></a>            </li>
            <li><a href="#"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">የደመወዝ  ቅጣት</span></a></li>
            <li><a href="#" class="MenuBarItemSubmenu"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">የጽሑፍ መስጠንቀቂያ</span></a>
              <ul>
                <li><a href="../warning Letters/First_Instance_Warning.php"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE"><span style="font-size:10.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">	የመጀመሪያ መስጠንቀቂያ </span> </span></a></li>
                <span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">
                  <li><a href="../warning Letters/Second_Instance_Warning.php"><span style="font-size:10.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">	ሁለተኛ መስጠንቀቂያ </span></a></li>
                  <li><a href="../warning Letters/Third_Instance_Warning.php"><span style="font-size:10.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">ሶስተኛ መስጠንቀቂያ</span></a></li>
                  <li><a href="../warning Letters/Last_Warning.php"><span style="font-size:10.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">የመጨረሻ መስጠንቀቂያ</span></a></li>
</span>
              </ul>
            </li>
            <li><a href="#" class="MenuBarItemSubmenu"><span style="font-size:10.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">ሠንብት</span></a>
              <ul>
                <li><a href="../warning Letters/Termination.php"><span style="font-size:10.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">ሠንብት  ቅጽ</span></a></li>
                <li><a href="#"><span style="font-size:10.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">ሠንብት ደብዳቤ</span></a></li>
              </ul>
            </li>
            <li><a href="javascript: if (confirm('Are You Sure You want to remove Expired Warning?')) { window.location.href='../Amharic/Letters/warning Letters/Expired_Warning_Remover.php' } else { void('') }; ">ጊዜው ያለፈበትን ማስጠንቀቂያ መስወገጃ</a></li>
            <li><a href="../warning Letters/Warning_Letters_Viewer.php">ማስጠንቀቂያ ደብዳቤ ማሳያ</a></li>
          </ul>
        </li>
        <li><a href="http://localhost/Report/annual_leaverpt.php#" target="_blank"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">ሪፖርታዥ</span></a></li>
        <li><a href="#" class="MenuBarItemSubmenu"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">ውል</span></a>
          <ul>
            <li><a href="Permanent_Contract_Letter.php"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">የቆሚ ቅጥር ውል</span></a></li>
          </ul>
        </li>
        <li><a href="#" class="MenuBarItemSubmenu"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">ጥቅማ ጥቅም</span></a>
          <ul>
            <li><a href="../../Medical/Medical_Referral.php"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">የህክምና መላኪያ</span></a></li>
            <li><a href="../../Training/Training.php">ስልጠና</a></li>
          </ul>
        </li>
</ul>

      </div>
  </div>
  <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" -->
  <form method="post" action="http://tinymce.moxiecode.com/dump.php?example=true">
    <h3>Completion Of Probation Period Letter</h3>

	<p>
		This Letter is prepared for Completion of Probation Period Notfiacation which will be given for an employee who is passed his/her Probation Evaluation Period.
	</p>
    <h3><!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
      
    </h3>
    <textarea id="elm1" name="elm1" rows="30" cols="150" style="width: 80%">
    <meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=ProgId content=Word.Document>
<meta name=Generator content="Microsoft Word 12">
<meta name=Originator content="Microsoft Word 12">
<link rel=File-List
href="Completion%20Of%20Probation%20Period_files/filelist.xml">
<!--[if gte mso 9]><xml>
 <o:DocumentProperties>
  <o:Author>Zekiyos</o:Author>
  <o:Template>Normal</o:Template>
  <o:LastAuthor>Zekiyos</o:LastAuthor>
  <o:Revision>1</o:Revision>
  <o:TotalTime>1</o:TotalTime>
  <o:Created>2011-04-14T08:22:00Z</o:Created>
  <o:LastSaved>2011-04-14T08:23:00Z</o:LastSaved>
  <o:Pages>1</o:Pages>
  <o:Words>90</o:Words>
  <o:Characters>519</o:Characters>
  <o:Company>Sher Ethiopia Plc</o:Company>
  <o:Lines>4</o:Lines>
  <o:Paragraphs>1</o:Paragraphs>
  <o:CharactersWithSpaces>608</o:CharactersWithSpaces>
  <o:Version>12.00</o:Version>
 </o:DocumentProperties>
</xml><![endif]-->
<link rel=themeData
href="Completion%20Of%20Probation%20Period_files/themedata.thmx">
<link rel=colorSchemeMapping
href="Completion%20Of%20Probation%20Period_files/colorschememapping.xml">
<!--[if gte mso 9]><xml>
 <w:WordDocument>
  <w:SpellingState>Clean</w:SpellingState>
  <w:GrammarState>Clean</w:GrammarState>
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
span.SpellE
	{mso-style-name:"";
	mso-spl-e:yes;}
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

<p class=MsoNormal align=right style='text-align:right;tab-stops:228.0pt'><b
style='mso-bidi-font-weight:normal'><span style='font-size:11.0pt;font-family:
"Bookman Old Style","serif"'><span style='mso-spacerun:yes'>           </span></span></b><span
style='font-family:"Bookman Old Style","serif"'><span
style='mso-spacerun:yes'>                   </span>Date: ______________________<span
style='mso-tab-count:1'>  </span></span></p>

<p class=MsoNormal><o:p>&nbsp;</o:p></p>

<p class=MsoNormal><o:p>&nbsp;</o:p></p>

<p class=MsoNormal><b style='mso-bidi-font-weight:normal'><span
style='font-family:"Bookman Old Style","serif"'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal><b style='mso-bidi-font-weight:normal'><span
style='font-family:"Bookman Old Style","serif"'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal><b style='mso-bidi-font-weight:normal'><span
style='font-family:"Bookman Old Style","serif"'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal><b style='mso-bidi-font-weight:normal'><span
style='font-family:"Bookman Old Style","serif"'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal><b style='mso-bidi-font-weight:normal'><span
style='font-family:"Bookman Old Style","serif"'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal style='text-indent:.25in'><b style='mso-bidi-font-weight:
normal'><span style='font-family:"Bookman Old Style","serif"'>To:
___________________________________<o:p></o:p></span></b></p>

<p class=MsoNormal><b style='mso-bidi-font-weight:normal'><span
style='font-family:"Bookman Old Style","serif"'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal><b style='mso-bidi-font-weight:normal'><span
style='font-family:"Bookman Old Style","serif"'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal><b style='mso-bidi-font-weight:normal'><span
style='font-family:"Bookman Old Style","serif"'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal style='text-indent:13.5pt'><b style='mso-bidi-font-weight:
normal'><span style='font-family:"Bookman Old Style","serif"'>From: Human
Resource Director <o:p></o:p></span></b></p>

<p class=MsoNormal style='text-indent:13.5pt'><b style='mso-bidi-font-weight:
normal'><span style='font-family:"Bookman Old Style","serif"'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal style='text-indent:13.5pt'><b style='mso-bidi-font-weight:
normal'><span style='font-family:"Bookman Old Style","serif"'>Subject:
Completion of probation period <o:p></o:p></span></b></p>

<p class=MsoNormal style='text-indent:13.5pt'><span style='font-family:"Bookman Old Style","serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='margin-left:13.5pt'><span style='font-family:"Bookman Old Style","serif"'>Following
the successful completion of your forty-five days (probation period) with <span
class=SpellE>Sher</span> Ethiopia you are confirmed as a permanent status
employee effective from _____________ <o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:13.5pt'><span style='font-family:"Bookman Old Style","serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='margin-left:13.5pt'><span style='font-family:"Bookman Old Style","serif"'>Your
employment with our company will be governed by the terms &amp; policies for
confirmed permanent status employee specified in the contract of employment and
<span class=SpellE>Sher</span> Ethiopia plc.<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:13.5pt'><span style='font-family:"Bookman Old Style","serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal><span style='font-family:"Bookman Old Style","serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal align=center style='margin-left:5.0in;text-align:center'><span
style='font-family:"Bookman Old Style","serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal align=center style='margin-left:5.0in;text-align:center'><span
style='font-family:"Bookman Old Style","serif"'>Yours faithfully<o:p></o:p></span></p>

<p class=MsoNormal align=center style='margin-left:5.0in;text-align:center'><span
style='font-family:"Bookman Old Style","serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal align=center style='margin-left:5.0in;text-align:center'><span
style='font-family:"Bookman Old Style","serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal align=center style='margin-left:5.0in;text-align:center'><span
style='font-family:"Bookman Old Style","serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal align=center style='margin-left:5.0in;text-align:center'><span
class=SpellE><span style='font-family:"Bookman Old Style","serif"'>Genene</span></span><span
style='font-family:"Bookman Old Style","serif"'> <span class=SpellE>Azene</span><o:p></o:p></span></p>

<p class=MsoNormal align=center style='margin-left:5.0in;text-align:center'><span
style='font-family:"Bookman Old Style","serif"'>Human Resource Director<o:p></o:p></span></p>

<p class=MsoNormal><span style='font-family:"Bookman Old Style","serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal><span style='font-family:"Bookman Old Style","serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal><span style='font-family:"Bookman Old Style","serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='text-align:justify'><b style='mso-bidi-font-weight:
normal'><span style='font-size:11.0pt;font-family:"Bookman Old Style","serif"'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal style='text-align:justify'><b style='mso-bidi-font-weight:
normal'><span style='font-size:11.0pt;font-family:"Bookman Old Style","serif"'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal style='text-align:justify'><b style='mso-bidi-font-weight:
normal'><span style='font-size:11.0pt;font-family:"Bookman Old Style","serif"'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal style='text-align:justify'><b style='mso-bidi-font-weight:
normal'><span style='font-size:11.0pt;font-family:"Bookman Old Style","serif"'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal style='line-height:150%'><span style='font-family:"Bookman Old Style","serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal><o:p>&nbsp;</o:p></p>

<p class=MsoNormal><o:p>&nbsp;</o:p></p>

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
     <li><a href="../../../Recruitment/Probation_Evaluation.php"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">የጊዜዊ ሰራተኛ መገምግሚያ</span></a>       </li>
     <li><a href="#" class="MenuBarItemSubmenu"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">የግለ ማሕደር ቅጽ</span></a>
       <ul>
         <li><a href="../../Personal Record/Employee_Personal_Record.php">የግለ ማሕደር ቅጽ</a></li>
         <li><a href="../../../Database_Update/PersonalRecordDisplay.php" target="_blank">የግለ ማሕደር መፈለጊያ</a></li>
       </ul>
     </li>
     <li><a href="../../Proclamation/Ethiopian Labour Law Pro.377-2003 Amharic and English.htm" target="_blank"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">ስለ አሠሪና ሠራተኛ የወጣ አዋጅ</span></a></li>
     <li><a href="#" class="MenuBarItemSubmenu"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">የሰራተኛ ሁናቴ ለውጥ</span></a>
       <ul>
         <li><a href="../../Employee_Status_Transaction/Promotion.php">የደረጃ እድገት </a></li>
         <li><a href="../../Employee_Status_Transaction/Demotion.php">የደረጃ ቅነሳ </a></li>
         <li><a href="../../Employee_Status_Transaction/Department_Transfer.php">የሥራ  ክፍል ዝውውር </a></li>
       </ul>
     </li>
<li><a href="#" class="MenuBarItemSubmenu"><span style="font-size:11.0pt;font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;color:#FF6600;
background:#EEEEEE">ሰሀአ ሲስተም ይሁንታ...</span></a>
  <ul>
<li><a href="#" class="MenuBarItemSubmenu">ተጠቃሚ</a>
  <ul>
    <li><a href="../../../User_Account/Creat_Account.php">ተጠቃሚ ፍጠር </a></li>
    <li><a href="../../../User_Account/Change_Password.php">የይለፍ ቃል መለወጫ</a></li>
    <li><a href="../../../User_Account/Delete_Account.php">ተጠቃሚ መሰረዣ </a></li>
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
    <p>&nbsp;</p>
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
    <p class="lf">&copy; Copyright ThkeyHRMS.Designed and Developed by <a href="http://www.bluewebtemplates.com">Thekey ICT Soultion</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;Licensed for Company Name</p>
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
