<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php 
if(isset($_POST['listOfItems']))
{
$data=$_POST['listOfItems'];
echo $data;
$parts = explode("|", $data);
$numParts = count($parts);
$field=""; 
$j=0;
echo $numParts ;
for($i=0;$i<$numParts;$i++)
 {
	 $j+=$j;
	 
	 $field.$j=$parts[$i];
	 echo $field.$j;
 }
}
?>

<body>
</body>
</html>
