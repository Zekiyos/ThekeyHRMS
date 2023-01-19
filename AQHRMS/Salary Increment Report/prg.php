<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
.all-rounded {
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
}
 
.spacer {
	display: block;
}
 
#progress-bar {
	width: 300px;
	margin: 0 auto;
	background: #cccccc;
	border: 3px solid #f2f2f2;
}
 
#progress-bar-percentage {
	background: #3063A5;
	padding: 5px 0px;
 	color: #FFF;
 	font-weight: bold;
 	text-align: center;
}
</style>
</head>

<body>
<?php
function progressBar($percentage) {
	print "<div id=\"progress-bar\" class=\"all-rounded\">\n";
	print "<div id=\"progress-bar-percentage\" class=\"all-rounded\" style=\"width: $percentage%\">";
		if ($percentage > 5) {print "$percentage%";} else {print "<div class=\"spacer\">&nbsp;</div>";}
	print "</div></div>";
}
?>
<?php //echo progressBar(90);

for($i=1;$i<=100;$i++)
{
	echo progressBar($i);
	usleep(10000);
}

 ?>
</body>
</html>