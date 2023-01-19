<?php
//This application is developed by www.webinfopedia.com
//Visit www.webinfopedia.com for more examples and demos


//Now get the encoded image form flash through HTTP_RAW_POST_DATA
if(isset($GLOBALS["HTTP_RAW_POST_DATA"])){
	$jpg = $GLOBALS["HTTP_RAW_POST_DATA"];
	$img = $_GET["img"];
	
	//image Directory
	//$filename = "img/webinfopedia_". mktime(). ".jpg";
	//file name image by employee ID number
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

// echo $ID;
 $filename = "../../Employee_Images/".$ID.".JPG";
 
 }
}
else
echo "<script type=\"text/javascript\"> alert('Last ID Number text file is not exist.Write Last ID Number on the notpad and save in the Recruitment folder as LastID.txt'); </script>";


	
	
	file_put_contents($filename, $jpg);
} else{
	//show error if image is not recived 
	echo "Encoded JPEG information not received.";
}
?>