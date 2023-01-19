
<?php //require_once('../Connections/HRMS.php'); 
/*
echo getcwd()."<br/>";
echo realpath(__FILE__)."<br/>";
echo dirname(realpath(__FILE__))."xxx<br/>";
echo basename(realpath(__FILE__))."<br/>";
echo basename(dirname(realpath(__FILE__)))."<br/>";
echo str_replace("\\","/",dirname(realpath(__FILE__)))."<br/>";
echo $_SERVER['DOCUMENT_ROOT']."ZZZ<br/>";
echo get_include_path()."<br/>";
chdir(dirname(realpath(__FILE__)));
echo getcwd()."<br/>";

echo getcwd()."/jquery/get_FirstName.php";
echo dirname(__FILE__) ."<br>";

echo $_SERVER['DOCUMENT_ROOT'].basename(dirname(realpath(__FILE__)))."<br/>";
echo "http://localhost/aqhrms/".basename(dirname(realpath(__FILE__)))."<br/>";

echo ((isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) != 'off') ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
*/

?>
<?php
$realpath = dirname(realpath(__FILE__));
//checking the connection is secure or not the identfy http or https protocol then append server host name
$path = ((isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) != 'off') ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] ."/". substr($realpath, strlen($_SERVER['DOCUMENT_ROOT']));
if (DIRECTORY_SEPARATOR == '\\')
        $path = str_replace('\\', '/', $path);
//echo $path;
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
//if(!session_start())
//{
//session_start();
//ob_start();
//}
//require_once "Jquery/config.php";

?>

<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_HRMS, $HRMS);

if(isset($_GET['TableName']))
$query_RSFirstName = "SELECT DISTINCT `ID` , `FirstName` , `MiddelName` , `LastName` , `Department` FROM ".$_GET['TableName']." ORDER BY ID ASC";
else
$query_RSFirstName = "SELECT  DISTINCT `ID` , `FirstName` , `MiddelName` , `LastName` , `Department` FROM employee_personal_record ORDER BY ID ASC";

$RSFirstName = mysql_query($query_RSFirstName, $HRMS) or die(mysql_error());
$row_RSFirstName = mysql_fetch_assoc($RSFirstName);
$totalRows_RSFirstName = mysql_num_rows($RSFirstName);mysql_select_db($database_HRMS, $HRMS);
if(isset($_GET['TableName']))
$query_RSFirstName = "SELECT  DISTINCT `ID` , `FirstName` , `MiddelName` , `LastName` , `Department` FROM ".$_GET['TableName']." ORDER BY ID ASC";
else
$query_RSFirstName = "SELECT  DISTINCT `ID` , `FirstName` , `MiddelName` , `LastName` , `Department` FROM employee_personal_record ORDER BY ID ASC";


$RSFirstName = mysql_query($query_RSFirstName, $HRMS) or die(mysql_error());
$row_RSFirstName = mysql_fetch_assoc($RSFirstName);
$totalRows_RSFirstName = mysql_num_rows($RSFirstName);
?>

<?php

//// serach code



if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "SearchName")) {
  
  
  $searching ="yes";
  $find = $_POST['find'];


 //This is only displayed if they have submitted the form 
 if ($searching =="yes") 
 { 
 echo "<h2><font color=\"#FB33\">Results</font></h2><p>"; 
 
 //If they did not enter a search term we give them an error 
 if ($find == "") 
 { 
 echo "<p><font color=\"#FF0000\">Enter First a search term</font>"; 
// exit; 
 } 
 else
 {
 
 // Otherwise we connect to our Database 
 /////mysql_connect("localhost", "root", "") or die(mysql_error()); 
////// mysql_select_db("aqhrmsdb") or die(mysql_error()); 
 
 // We preform a bit of filtering 
 $find = strtoupper($find); 
 $find = strip_tags($find); 
 $find = trim ($find); 
 $field="FirstName";
 //Now we search for our search term, in the field the user specified 
 if(isset($_GET['TableName']))
 
 $data = mysql_query("SELECT DISTINCT `ID` , `FirstName` , `MiddelName` , `LastName` , `Department` FROM ".$_GET['TableName']." WHERE upper($field) LIKE'%$find%'"); 
  else
  $data = mysql_query("SELECT DISTINCT `ID` , `FirstName` , `MiddelName` , `LastName` , `Department` FROM employee_personal_Record WHERE upper($field) LIKE'%$find%'"); 
 
 
 echo "<table border=\"4\" align=\"center\" bgcolor=\"#EBEBEB\" bordercolor=\"#FF6600\" >";
 
 //And we display the results 
 while($result = mysql_fetch_array( $data )) 
 { 
 $ID=$result['ID'];
 
 
 echo "<tr><td>";
 
 if(isset($_GET['OpenPage']))
 echo "<a href=\"".$_GET['OpenPage'].".php?ID=".$ID."\">";
  
 echo $result['ID']."</td><td>"; 
 echo " ".$result['FirstName']."</td><td>"; 
 echo " "; 
 echo $result['MiddelName']."</td><td>"; 
 echo " "; 
 echo $result['LastName']."</td><td>";
 echo " "; 
 echo $result['Department']."</td></tr></a>"; 
// echo "<br>"; 
 
 } 
 
 //This counts the number or results - and if there wasn't any it gives them a little message explaining that 
 $anymatches=mysql_num_rows($data); 
 if ($anymatches == 0) 
 { 
 echo "<font color=\"#FF0000\">Sorry, but there is no such employee on entire current employee list<br><br></font>"; 
 } 
 
 //And we remind them what they searched for 
 echo "<b>Searched For:</b> " .$find;
 echo "<br/><b> Total Available :</b> ".$anymatches." employee"; 
 } 

  
 }//else closing for empty serach text
  

 // mysql_select_db($database_HRMS, $HRMS);
 // $Result1 = mysql_query($insertSQL, $HRMS) or die(mysql_error());
}

mysql_select_db($database_HRMS, $HRMS);

if(isset($_GET['TableName']))
$query_RSsearch = "SELECT DISTINCT `ID` , `FirstName` , `MiddelName` , `LastName` , `Department` FROM ".$_GET['TableName']."";
else
$query_RSsearch = "SELECT  DISTINCT `ID` , `FirstName` , `MiddelName` , `LastName` , `Department` FROM employee_personal_record ORDER BY ID ASC";

$RSsearch = mysql_query($query_RSsearch, $HRMS) or die(mysql_error());
$row_RSsearch = mysql_fetch_assoc($RSsearch);
$totalRows_RSsearch = mysql_num_rows($RSsearch);




////serach code end
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>

</title>

<script type='text/javascript'>
var $_GET = <?php echo json_encode($_GET); ?>;

function SelectedFirstName(elem, helperMsg){
	//document.writeln(elem.value);
	alert ( "You have Slelcted " + elem.value + "!")
	//var ID=elem.value;

<?php if(isset($_GET['$OpenPage'])){?>
location="<?php  echo $_GET['$OpenPage']; ?>.php?FirstName=" + elem.value;
 <?php } ?>
	if(elem.value == "Please Choose FirstName"){
		alert(helperMsg);
		elem.focus();
		return false;
	}else{
		return true;
	}
	

}
function TypedFirstName(elem, helperMsg){
	var str=elem.value;
	str=str.toUpperCase()
	//str.replace("Microsoft","W3Schools"));
//if (str.match("SH")==null) {
if (str.indexOf("AQ")!=0) {
	
<?php if(isset($_GET['$OpenPage'])){?>
location="<?php  echo $_GET['$OpenPage']; ?>.php?FirstName=" + elem.value;
 <?php } ?>
}
else
{
	<?php if(isset($_GET['$OpenPage'])){?>
location="<?php  echo $_GET['$OpenPage']; ?>.php?ID=" + elem.value;
 <?php } ?>
}
	if(elem.value == ""){
		alert(helperMsg);
		elem.focus();
		return false;
	}else{
		return true;
	}
	
}

function SelectedID(elem, helperMsg){
	
	//Getting Passed vaule using bultin php v 5 json function
	var $_GET = <?php echo json_encode($_GET); ?>;
    //document.write($_GET["OpenPage"]);

	alert ( "You have Selected " + elem.value + "!")
	var ID=elem.value;
	

if( typeof $_GET["OpenPage"] != 'undefined')
location="" + $_GET["OpenPage"] + ".php?ID=" + elem.value;
//location="Personal_Information_detail.php?ID=" + elem.value;

	if(elem.value == "Please Choose ID Number"){
		alert(helperMsg);
		elem.focus();
		return false;
	}else{
		return true;
	}
}

</script>

<script type="text/javascript" src="
<?php echo $path."/Jquery/jquery.js";?>"></script>
 
<script type='text/javascript' src='
<?php echo $path."/Jquery/jquery.autocomplete.js";?>'></script>
<link rel="stylesheet" type="text/css" href="
<?php echo $path."/Jquery/jquery.autocomplete.css";?>"/>

<script type="text/javascript">
//J-query for First name aut display script
$().ready(function() {
	
	//Checking the the table name to complete set or not the display the data from table name 
	$("#find").autocomplete("<?php echo $path;?>/jquery/get_FirstName.php?TableName=<?php if(isset($_GET['TableName'])){
	echo $_GET['TableName'];
	}
	else{
	echo "employee_personal_record";
	}
	?>", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	
	/*$("#find").autocomplete("jquery/get_FirstName.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});*/
});
</script>


</head>

<body >
<form action="<?php echo $editFormAction; ?>" method="post" name="SearchName" id="SearchName">
  <table width="528" height="66">
    <tr>
    <td width="137" height="62">Type Employee Name </td>
  <td width="121"><input type="text" size="20"  id="find" name="find" />
  </td>
  <td width="70"><input type="image" src="<?php echo $path."/Jquery/Search.png";?>" alt="Search" width="70" height="60" />   </td>
  
  <td width="17"> <input type="hidden" name="MM_insert" value="SearchName" /></td>
  <td width="242">    <label for="ID">OR Select ID</label>
  <select name="ID" id="ID" tabindex="40" onchange="SelectedID(document.getElementById('ID'), 'Please Choose Something')">
  <option value="Select ID">Select ID</option>
    <?php
	
				 do {  
?>
    <option value="<?php echo $row_RSFirstName['ID']?>"><?php echo $row_RSFirstName['ID']?></option>
    <?php
} while ($row_RSFirstName = mysql_fetch_assoc($RSFirstName));
  $rows = mysql_num_rows($RSFirstName);
  if($rows > 0) {
      mysql_data_seek($RSFirstName, 0);
	  $row_RSFirstName = mysql_fetch_assoc($RSFirstName);
  }
?>
  </select></td>
  </tr>
</table>
 
</form>

</body>
</html>
<?php
mysql_free_result($RSFirstName);

?>
