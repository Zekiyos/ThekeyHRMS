<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<input type="button" value="Generate ID" onclick="generateid()"/>

<?php
$filename="LastID.txt"; 
if (file_exists($filename)) {

$fd = fopen($filename, "r+") or die("Can't open file $filename");
$fstring = fread($fd, filesize($filename));

$fstring2=$fstring+1;
fclose($fd);

$fd2 = fopen($filename, "w+") or die("Can't open file $filename");
$fout = fwrite($fd2, $fstring2);
fclose($fd2);

$initial=$fstring2;

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

 echo "ID :".$ID;
 }
}
else
echo "<script type=\"text/javascript\"> alert('Last ID Number text file is not exist.Write Last ID Number on the notpad and save in the Recruitment folder as LastID.txt'); </script>";
//$initial=$initial+1+1;
//$ID="AQ-".$initial;
//echo "ID".$ID;


function generateid(){
$initial=0000;

$initial=$initial+1;
$ID="AQ-00".$initial;
echo "id".$ID;

echo "<script type=\"text/javascript\"> alert({$ID}); </script>";
}?>
</body>
</html>