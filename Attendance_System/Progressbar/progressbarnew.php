<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="../../jkincludes/scripts.css" />
<meta name="description" content="Click here to get free JavaScripts, hassle free!">
<meta name="keywords"
content="free JavaScript, cut and paste JavaScript, JavaScript tutorial">
<meta name="GENERATOR" content="Microsoft FrontPage 6.0">
<title>Cut &amp; Paste Popup progress bar</title>
</head>

<body>

<div>
 <!--ZOOMSTOP-->

<script type="text/javascript" src="../../Js/dropdowntabs.js">
</script>


<div id="topsection">

<!--begin topbar-->
<div id="topbar">
<div id="toprightdiv">

<form id="jksitesearch" method="get" action="http://www.javascriptkit.com/cgi-bin/search/search.cgi" class="zoom_searchform">
<input type="text" name="zoom_query" id="zoom_query" size="20" value="Search JavaScript Kit" class="zoom_searchbox" /> 
<input type="submit" value="Submit" class="zoom_button" />
<input name="zoom_per_page" id="zoom_per_page" type="hidden" value="10" />
<input name="zoom_and" id="zoom_and" type="hidden" value="1" />
<input type="hidden" name="zoom_sort" value="0" />

<div id="jksitesearch_cat">
<b>Categories:</b> <input type="checkbox" name="zoom_cat[]" value="-1" id="searchall" style="margin-left: 5px" /><label for="searchall">All</label> <input type="checkbox" name="zoom_cat[]" id="javascriptssearch" value="0" /><label for="javascriptssearch">Free JavaScripts/ Applets</label> <input type="checkbox" name="zoom_cat[]" id="tutorialsearch" value="1" /><label for="tutorialsearch">Tutorials</label> <input type="checkbox" name="zoom_cat[]" id="referencesearch" value="2" /><label for="referencesearch">References</label>
</div>

</form>

<script type="text/javascript">
setdefaultcategory()
togglecategories()
disabledefaultsearch()
cleardefaultdata()

</script>

</div>

<a href="http://www.javascriptkit.com" title="JavaScript Kit"><img id="jklogo" src="http://www.javascriptkit.com/jkincludes/jksitelogo.gif" border="0"  alt="JavaScript Kit" /></a>


<div id="bluemenu" class="bluetabs">
<ul>
<li><a href="http://www.javascriptkit.com">Home</a></li>
<li><a href="http://www.javascriptkit.com/cutpastejava.shtml">Free JavaScripts</a></li>
<li><a href="http://www.javascriptkit.com/javatutors/" rel="tutorialdropdown">Tutorials &#9660;</a></li>
<li><a href="http://www.javascriptkit.com/jsref/" rel="refdropdown">References &#9660;</a></li>

<li><a href="http://www.javascriptkit.com/java/">Applets</a></li>
<li><a href="http://www.codingforums.com">Coding Forums</a></li>
<li><a href="http://www.freewarejava.com">Freewarejava</a></li>
</ul>
</div>


<!--1st drop down menu -->                                                   
<div id="tutorialdropdown" class="dropmenudiv_b">
<a href="http://www.javascriptkit.com/javatutors/" title="JavaScript Tutorials">JavaScript Tutorials</a>
<a href="http://www.javascriptkit.com/dhtmltutors/" title="DHTML and CSS Tutorials">DHTML/ CSS</a>
<a href="http://www.javascriptkit.com/howto/" title="Web Building Tutorials">Web Building Tutorials</a>

</div>


<!--2nd drop down menu -->                                                
<div id="refdropdown" class="dropmenudiv_b" style="width: 150px;">
<a href="http://www.javascriptkit.com/jsref/" title="JavaScript Reference">JS Reference</a>
<a href="http://www.javascriptkit.com/domref/" title="DOM Reference">DOM Reference</a>
<a href="http://www.javascriptkit.com/filters/" title="IE Filters Reference">IE Filters Reference</a>
<a href="http://www.javascriptkit.com/dhtmltutors/cssreference.shtml" title="CSS Reference">CSS Reference</a>
</div>

<script type="text/javascript">
//SYNTAX: tabdropdown.init("menu_id", [integer OR "auto"])
tabdropdown.init("bluemenu")
</script>

</div>
<!--end #topbar -->


<div id="topbanner">
<script type="text/javascript" src="http://www.javascriptkit.com/adbanner.js"></script>
</div>

</div>

 <!--ZOOMRESTART-->
</div>


<div class="maincontainer">

<div id="contentwrapper">
<div id="middlecolumn">

<p class="scriptbreadcrumb"><strong><a href="http://javascriptkit.com">Home</a> / <a
href="http://javascriptkit.com/cutpastejava.shtml">Free
JavaScripts</a> / <a
href="http://javascriptkit.com/script/cutindex9.shtml">Other</a> / Here</strong></p>

<table border="0" width="100%" cellspacing="0" cellpadding="0">

  <tr>

    <td id="scripttitle"><p><em>Cut &amp; Paste</em>  Popup progress bar</p>
    <div align="center"><center><table border="0" cellspacing="0" cellpadding="0"
    bgcolor="#E7F8ED">
      <tr>
        <td width="100%" id="credits"><strong>Credit: <a href="mailto:tking@igpp.ucla.edu"><big>Todd
          King</big></a><big> w/ modifications from
          JavaScript Kit</big></strong></td>

      </tr>
    </table>
    </center></div></td>
  </tr>
</table>

<p align="left"><strong>Description:</strong> 
Todd's popup progress bar script is used to provide a visual update of an event
in progress. Use it, for example, to display a delay before redirecting to
another page or loading a script/application. We've modified the script so it:</p>

<p align="left">-Works in NS6 as well (default is IE4+ and NS4)<br />

-Ability to specify duration of progress bar display (ie: 5 seconds)</p>

<p align="left">Definitely a script with many uses.</p>

<p align="left"><strong>Example:</strong></p>

<p align="left">
<!--webbot bot="HTMLMarkup" startspan -->

<style>
<!--
.hide { position:absolute; visibility:hidden; }
.show { position:absolute; visibility:visible; }
-->
</style>
<style>
<!--
.hide { position:absolute; visibility:hidden; }
.show { position:absolute; visibility:visible; }
-->
</style>
<SCRIPT LANGUAGE="JavaScript">

//Progress Bar script- by Todd King (tking@igpp.ucla.edu)
//Modified by JavaScript Kit for NS6, ability to specify duration
//Visit JavaScript Kit (http://javascriptkit.com) for script

var duration=3 // Specify duration of progress bar in seconds
var _progressWidth = 50;	// Display width of progress bar.

var _progressBar = "|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||"
var _progressEnd = 5;
var _progressAt = 0;


// Create and display the progress dialog.
// end: The number of steps to completion
function ProgressCreate(end) {
	// Initialize state variables
	_progressEnd = end;
	_progressAt = 0;

	// Move layer to center of window to show
	if (document.all) {	// Internet Explorer
		progress.className = 'show';
		progress.style.left = (document.body.clientWidth/2) - (progress.offsetWidth/2);
		progress.style.top = document.body.scrollTop+(document.body.clientHeight/2) - (progress.offsetHeight/2);
	} else if (document.layers) {	// Netscape
		document.progress.visibility = true;
		document.progress.left = (window.innerWidth/2) - 100+"px";
		document.progress.top = pageYOffset+(window.innerHeight/2) - 40+"px";
	} else if (document.getElementById) {	// Netscape 6+
		document.getElementById("progress").className = 'show';
		document.getElementById("progress").style.left = (window.innerWidth/2)- 100+"px";
		document.getElementById("progress").style.top = pageYOffset+(window.innerHeight/2) - 40+"px";
	}

	ProgressUpdate();	// Initialize bar
}

// Hide the progress layer
function ProgressDestroy() {
	// Move off screen to hide
	if (document.all) {	// Internet Explorer
		progress.className = 'hide';
	} else if (document.layers) {	// Netscape
		document.progress.visibility = false;
	} else if (document.getElementById) {	// Netscape 6+
		document.getElementById("progress").className = 'hide';
	}
}

// Increment the progress dialog one step
function ProgressStepIt() {
	_progressAt++;
	if(_progressAt > _progressEnd) _progressAt = _progressAt % _progressEnd;
	ProgressUpdate();
}

// Update the progress dialog with the current state
function ProgressUpdate() {
	var n = (_progressWidth / _progressEnd) * _progressAt;
	if (document.all) {	// Internet Explorer
		var bar = dialog.bar;
 	} else if (document.layers) {	// Netscape
		var bar = document.layers["progress"].document.forms["dialog"].bar;
		n = n * 0.55;	// characters are larger
	} else if (document.getElementById){
                var bar=document.getElementById("bar")
        }
	var temp = _progressBar.substring(0, n);
	bar.value = temp;
}

// Demonstrate a use of the progress dialog.
function Demo() {
	ProgressCreate(10);
	window.setTimeout("Click()", 100);
}

function Click() {
	if(_progressAt >= _progressEnd) {
		ProgressDestroy();
		return;
	}
	ProgressStepIt();
	window.setTimeout("Click()", (duration-1)*1000/10);
}

function CallJS(jsStr) { //v2.0
  return eval(jsStr)
}

</script>

<SCRIPT LANGUAGE="JavaScript">

// Create layer for progress dialog
document.write("<span id=\"progress\" class=\"hide\">");
	document.write("<FORM name=dialog id=dialog>");
	document.write("<TABLE border=2  bgcolor=\"#FFFFCC\">");
	document.write("<TR><TD ALIGN=\"center\">");
	document.write("Progress<BR>");
	document.write("<input type=text name=\"bar\" id=\"bar\" size=\"" + _progressWidth/2 + "\"");
	if(document.all||document.getElementById) 	// Microsoft, NS6
		document.write(" bar.style=\"color:navy;\">");
	else	// Netscape
		document.write(">");
	document.write("</TD></TR>");
	document.write("</TABLE>");
	document.write("</FORM>");
document.write("</span>");
ProgressDestroy();	// Hides

</script>


<form name="form1" method="post">
<center>
<input type="button" name="Demo" value="Display progress" onClick="CallJS('Demo()')">
</center>
</form>

<a href="javascript:CallJS('Demo()')">Text link example</a>
<!--webbot bot="HTMLMarkup" endspan i-checksum="15202" --></p>

<p><strong>Directions: </strong>Simply copy the below
into the &lt;BODY&gt; portion of your page:</p>

<form method="POST">
  <p><textarea name="S1" rows="8" cols="69" style="width:90%"><style>
<!--
.hide { position:absolute; visibility:hidden; }
.show { position:absolute; visibility:visible; }
-->
</style>

<SCRIPT LANGUAGE="JavaScript">

//Progress Bar script- by Todd King (tking@igpp.ucla.edu)
//Modified by JavaScript Kit for NS6, ability to specify duration
//Visit JavaScript Kit (http://javascriptkit.com) for script

var duration=3 // Specify duration of progress bar in seconds
var _progressWidth = 50;	// Display width of progress bar.

var _progressBar = "|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||"
var _progressEnd = 5;
var _progressAt = 0;


// Create and display the progress dialog.
// end: The number of steps to completion
function ProgressCreate(end) {
	// Initialize state variables
	_progressEnd = end;
	_progressAt = 0;

	// Move layer to center of window to show
	if (document.all) {	// Internet Explorer
		progress.className = 'show';
		progress.style.left = (document.body.clientWidth/2) - (progress.offsetWidth/2);
		progress.style.top = document.body.scrollTop+(document.body.clientHeight/2) - (progress.offsetHeight/2);
	} else if (document.layers) {	// Netscape
		document.progress.visibility = true;
		document.progress.left = (window.innerWidth/2) - 100+"px";
		document.progress.top = pageYOffset+(window.innerHeight/2) - 40+"px";
	} else if (document.getElementById) {	// Netscape 6+
		document.getElementById("progress").className = 'show';
		document.getElementById("progress").style.left = (window.innerWidth/2)- 100+"px";
		document.getElementById("progress").style.top = pageYOffset+(window.innerHeight/2) - 40+"px";
	}

	ProgressUpdate();	// Initialize bar
}

// Hide the progress layer
function ProgressDestroy() {
	// Move off screen to hide
	if (document.all) {	// Internet Explorer
		progress.className = 'hide';
	} else if (document.layers) {	// Netscape
		document.progress.visibility = false;
	} else if (document.getElementById) {	// Netscape 6+
		document.getElementById("progress").className = 'hide';
	}
}

// Increment the progress dialog one step
function ProgressStepIt() {
	_progressAt++;
	if(_progressAt > _progressEnd) _progressAt = _progressAt % _progressEnd;
	ProgressUpdate();
}

// Update the progress dialog with the current state
function ProgressUpdate() {
	var n = (_progressWidth / _progressEnd) * _progressAt;
	if (document.all) {	// Internet Explorer
		var bar = dialog.bar;
 	} else if (document.layers) {	// Netscape
		var bar = document.layers["progress"].document.forms["dialog"].bar;
		n = n * 0.55;	// characters are larger
	} else if (document.getElementById){
                var bar=document.getElementById("bar")
        }
	var temp = _progressBar.substring(0, n);
	bar.value = temp;
}

// Demonstrate a use of the progress dialog.
function Demo() {
	ProgressCreate(10);
	window.setTimeout("Click()", 100);
}

function Click() {
	if(_progressAt >= _progressEnd) {
		ProgressDestroy();
		return;
	}
	ProgressStepIt();
	window.setTimeout("Click()", (duration-1)*1000/10);
}

function CallJS(jsStr) { //v2.0
  return eval(jsStr)
}

</script>

<SCRIPT LANGUAGE="JavaScript">

// Create layer for progress dialog
document.write("<span id=\"progress\" class=\"hide\">");
	document.write("<FORM name=dialog id=dialog>");
	document.write("<TABLE border=2  bgcolor=\"#FFFFCC\">");
	document.write("<TR><TD ALIGN=\"center\">");
	document.write("Progress<BR>");
	document.write("<input type=text name=\"bar\" id=\"bar\" size=\"" + _progressWidth/2 + "\"");
	if(document.all||document.getElementById) 	// Microsoft, NS6
		document.write(" bar.style=\"color:navy;\">");
	else	// Netscape
		document.write(">");
	document.write("</TD></TR>");
	document.write("</TABLE>");
	document.write("</FORM>");
document.write("</span>");
ProgressDestroy();	// Hides

</script>


<form name="form1" method="post">
<center>
<input type="button" name="Demo" value="Display progress" onClick="CallJS('Demo()')">
</center>
</form>

<a href="javascript:CallJS('Demo()')">Text link example</a>

<p align="center">This free script provided by<br />
<a href="http://www.javascriptkit.com">JavaScript
Kit</a></p></textarea></p>
</form>

<p align="left">Change the first two variables as instructed by the comments.</p>

<hr width="90%" size="1">

<script type="text/javascript"><!--
google_ad_client = "pub-3356683755662088";
/* JK footer ad 728x90, created 4/10/11 */
google_ad_slot = "6831910560";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>

<div align="center" class="footad" style="font-size: 70%; margin-top: 1.5em"> <a href="http://www.dynamicdrive.com/style/" target="offsite">CSS Library</a> 
|
  <a href="http://www.dynamicdrive.com/dynamicindex1/" target="offsite">JavaScript &amp; DHTML Menus</a> 
  | <a target="offsite" href="http://www.bluedogink.com/">Cheap Printer Ink</a> | <a target="offsite" href="http://www.sitecube.com">Build a website</a> | <a target="offsite" href="http://www.softwaregeek.com/">Software Geek</a>

</div>

</div>
</div>

<div id="leftcolumn">


<div class="categoryheader">JavaScript Tools:</div>

<ul class="ddmarkermenu">
<li><a href="http://www.javascriptkit.com/epassword/index.htm">Password generator</a></li>
<li><a href="http://javascriptkit.com/popwin/index.shtml">Popup Window generator</a></li>
<li><a href="http://javascriptkit.com/mousewhipper/index.htm">onMouseover whipper</a></li>

<li><a href="http://www.javascriptkit.com/combo.htm">Combo box whipper</a></li>
<li><a href="http://javascriptkit.com/metagenerate.shtml">Meta Tags Generator</a></li>
<li><a href="http://www.javascriptkit.com/linkcheck/">HTML Validation Tool</a></li>
</ul>

<div class="bsacontainer nomargin">
<script type="text/javascript">
Vertical1438 = false;
ShowAdHereBanner1438 = false;
RepeatAll1438 = false;
NoFollowAll1438 = false;
BannerStyles1438 = new Array(
	"a{display:block;font-size:11px;color:#888;font-family:verdana,sans-serif;margin-bottom:12px;padding:0;text-align:center;text-decoration:none;overflow:hidden;position:relative;left:-6px}",
	"img{border:0;clear:right;}",
	"a.adhere{color:#666;font-weight:bold;font-size:12px;border:1px solid #ccc;background:#e7e7e7;text-align:center;}",
	"a.adhere:hover{border:1px solid #999;background:#ddd;color:#333;}"
);

document.write(unescape("%3Cscript src='"+document.location.protocol+"//s3.buysellads.com/1438/1438.js?v="+Date.parse(new Date())+"' type='text/javascript'%3E%3C/script%3E"));
</script>
</div>

<div style="margin:-2px 0 1em -0; text-align:center;">
<script language="JavaScript" type="text/javascript">
ord=Math.random();
ord=ord*10000000000000000000;
document.write('');
document.write('<\/scr'+'ipt>');
document.write('');
</script>
<!--
<a href="http://ad.za.doubleclick.net/jump/N3643.CodingForums/B5373585.3;dcadv=2074920;sz=165x90;ord=0123456789?" target="_blank">
<img src="http://ad.za.doubleclick.net/ad/N3643.CodingForums/B5373585.3;dcadv=2074920;sz=165x90;ord=0123456789?" width="165" height="90" border="0" alt="Advertisement"></a>
-->

</div>


<div class="categoryheader">Site Info</div>

<ul class="ddmarkermenu">
<li><a href="http://javascriptkit.com/advertise.shtml">Advertising Info</a></li>
<li><a href="http://javascriptkit.com/submitjavascript.htm">Submit a script</a></li>
<li><a href="http://javascriptkit.com/award.htm/">Link to Us!</a></li>
<li><a href="http://javascriptkit.com/contact.shtml">Email Us</a></li>
<li><a href="http://javascriptkit.com/privacy.htm">Privacy Statement</a></li>

</ul>

</div>

<div id="rightcolumn">



</div>

<div class="clearfix"></div>

</div>

<div id="footerarea">

<p align="center">CopyRight © 1998-2012 <a href="http://www.javascriptkit.com">JavaScript Kit</a>. NO PART may be reproduced without author's permission.</p>

<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-55377-1";
urchinTracker();
</script>
</div>
</body>
</html>
