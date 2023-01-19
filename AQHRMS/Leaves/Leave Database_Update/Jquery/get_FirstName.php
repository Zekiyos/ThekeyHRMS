<?php require_once('../../../Connections/HRMS.php'); ?>
<?php
//require_once "config.php";
$q = strtolower($_GET["q"]);
if (!$q) return;
if(isset($_GET['TableName']))
$sql = "SELECT DISTINCT FirstName as FirstName,MiddelName from ".$_GET['TableName']." where FirstName LIKE '%$q%'";
else
$sql = "SELECT DISTINCT FirstName as FirstName,MiddelName from employee_personal_record where FirstName LIKE '%$q%'";

$rsd = mysql_query($sql);

while($rs = mysql_fetch_array($rsd)) {
	$fname = $rs['FirstName'];
	$mname=$rs['MiddelName'];
	echo "$fname|$mname\n";
}
?>