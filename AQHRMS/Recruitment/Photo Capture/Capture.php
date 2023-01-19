
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Capture a photo online using in web cam </title>
</meta name="google-site-verification" content="liGddaK7I8_x0tSdKv36CRi_rMfRt3yMNjILkbOAxxY" />
<meta name="language" content="English" />

<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-22897853-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<style type="text/css">
<!--
body,td,th {
	font-family: Georgia,"Times New Roman",Times,serif;;
	font-size: 12px;
	color: #333;
}
body {
	margin-left: 0px;
	margin-top: 30px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.maindiv{
	width:690px;
	margin:0 auto;
	padding:0px;
	background:#CCC;
}
.innerbg{ padding:6px; background:#FFF;}
.result{ border:solid 1px #CCC; margin:10px 2px; padding:4px 2px;}
.title a{ font-weight:bold; color:#c24f00; text-decoration:none; font-size:14px;}
.discptn a{ text-decoration:none; color:#999;}
.link a{ color:#008000; text-decoration:none;}
img{ cursor:pointer;}
-->
</style>
<script src="js/swfobject.js" language="javascript"></script>
</head>
<body>

  <div style="width:730px; margin:0 auto;">
  </div>
<div class="maindiv">
<div class="innerbg">
<table width="104%" border="0" cellpadding="2" cellspacing="2">
 <tr><td align="center"><p><font color="#FF3300" size="+1" >Thekey HRMS </font></p>
   <p><font color="#FF3300" size="+1" >ID Number 
     <input type="text" name="ID" value="<?php
$filename="../LastID.txt"; 
if (file_exists($filename)) {

$fd = fopen($filename, "r+") or die("Can't open file $filename");
$fstring = fread($fd, filesize($filename));

//$fstring2=$fstring+1;
fclose($fd);

//$fd2 = fopen($filename, "w+") or die("Can't open file $filename");
//$fout = fwrite($fd2, $fstring2);
//fclose($fd2);

$initial=$fstring;

 if( $initial > 99999)
 echo "<script type=\"text/javascript\"> alert('ID number Exceed The Limt Contact System Devloper to Change the limted value.'); </script>";
 else{
 if (strlen($initial)==1)
 $ID="AQ-0000".$initial;
 else
 if (strlen($initial)==2)
 $ID="AQ-000".$initial;
  else
 if (strlen($initial)==3)
 $ID="AQ-00".$initial;
  else
 if (strlen($initial)==4)
 $ID="AQ-0".$initial;
  else
 if (strlen($initial)==5)
  $ID="AQ-".$initial;

 echo $ID;
 }
}
else
echo "<script type=\"text/javascript\"> alert('Last ID Number text file is not exist.Write Last ID Number on the notpad and save in the Recruitment folder as LastID.txt'); </script>";

?>" size="15" /> 
     Employee Photography Capturing</font></p></td></tr>
  <tr>
    <td align="center" valign="middle">
    <div>
<div id="flashArea" class="flashArea" style="height:100%;"><p align="center">This content requires the Adobe Flash Player.<br /><a href="http://www.adobe.com/go/getflashplayer">
						<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /><br />
    <a href="http://www.macromedia.com/go/getflash/">Get Flash</a></p>
	</div>
<script type="text/javascript">
	var mainswf = new SWFObject("CapturePhoto.swf", "main", "800", "360", "11", "#ffffff");
	mainswf.addParam("scale", "noscale");
	mainswf.addParam("wmode", "window");
	mainswf.addParam("allowFullScreen", "true");
	//mainswf.addVariable("requireLogin", "false");
	mainswf.write("flashArea");
	
  </script>
    </div>

    </td>
    </tr>
</table>
</div>
</div>
<div style="width:730px; margin:0 auto; padding:8px 0px;">

</body>
</html>