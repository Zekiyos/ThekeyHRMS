<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_HRMS = "localhost";
$database_HRMS = "aqhrmsdb";
$username_HRMS = "root";
$password_HRMS = "";
$HRMS = mysql_pconnect($hostname_HRMS, $username_HRMS, $password_HRMS) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
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