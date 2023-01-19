<?php
$con=mysql_connect("localhost","root","");

if($con){
	mysql_select_db("aqhrmsdb",$con);
	
}
else{
	die("Could not connect to database");
}
?>