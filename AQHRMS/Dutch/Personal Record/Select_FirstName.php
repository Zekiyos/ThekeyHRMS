<?php require_once('../Connections/HRMS.php'); ?>
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
$query_RSFirstName = "SELECT * FROM employee_personal_record ORDER BY ID ASC";
$RSFirstName = mysql_query($query_RSFirstName, $HRMS) or die(mysql_error());
$row_RSFirstName = mysql_fetch_assoc($RSFirstName);
$totalRows_RSFirstName = mysql_num_rows($RSFirstName);mysql_select_db($database_HRMS, $HRMS);
$query_RSFirstName = "SELECT ID, FirstName, MiddelName, LastName FROM employee_personal_record ORDER BY ID ASC";
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  
  
  $searching ="yes";
  $find = $_POST['find'];


 //This is only displayed if they have submitted the form 
 if ($searching =="yes") 
 { 
 echo "<h2><font color=\"#FB33\">Resultaten</font></h2><p>"; 
 
 //If they did not enter a search term we give them an error 
 if ($find == "") 
 { 
 echo "<p><font color=\"#FF0000\">Voer eerst een zoekterm in</font>"; 
 //exit; 
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
 $data = mysql_query("SELECT * FROM employee_personal_record WHERE upper($field) LIKE'%$find%'"); 
 
 echo "<table border=\"4\" align=\"center\" bgcolor=\"#EBEBEB\" bordercolor=\"#FF6600\" >";
 
 //And we display the results 
 while($result = mysql_fetch_array( $data )) 
 { 
 $ID=$result['ID'];
 echo "<tr><td><a href=\"Personal_Information_Detail.php?ID=";
 echo $ID."\">";
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
 echo "<font color=\"#FF0000\">Sorry, maar er is geen dergelijke werknemer op de volledige lijst van huidige werknemer<br><br></font>"; 
 } 
 
 //And we remind them what they searched for 
 echo "<b>Gezocht Voor:</b> " .$find; 
 } 

 
 }//else closing for empty serach text
  
  

 // mysql_select_db($database_HRMS, $HRMS);
 // $Result1 = mysql_query($insertSQL, $HRMS) or die(mysql_error());
}

mysql_select_db($database_HRMS, $HRMS);
$query_RSsearch = "SELECT * FROM employee_personal_record";
$RSsearch = mysql_query($query_RSsearch, $HRMS) or die(mysql_error());
$row_RSsearch = mysql_fetch_assoc($RSsearch);
$totalRows_RSsearch = mysql_num_rows($RSsearch);




////serach code end
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document

</title>

<script type='text/javascript'>
function SelectedFirstName(elem, helperMsg){
	//document.writeln(elem.value);
	alert ( "You have Slelcted " + elem.value + "!")
	//var ID=elem.value;

location="Personal_Information_detail.php?FirstName=" + elem.value;
 
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
if (str.indexOf("SH")!=0) {
	
location="Personal_Information_detail.php?FirstName=" + elem.value;
}
else
{
location="Personal_Information_detail.php?ID=" + elem.value;
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
	
	alert ( "You have Slelcted " + elem.value + "!")
	var ID=elem.value;
location="Personal_Information_detail.php?ID=" + elem.value;
	if(elem.value == "Please Choose ID Number"){
		alert(helperMsg);
		elem.focus();
		return false;
	}else{
		return true;
	}
}


</script>



</head>
<!--Probation_Evaluation.php-->
<body ><form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table>
    <tr>
    <td><label for="txtFirstName2">Typ of selecteer Naam werknemer</label></td>
  <td><input type="text" size="20" id="find" name="find" />
  </td>
  <td><input type="image" src="../../img logo &amp; icons/Search.png" width="67" height="69" />   </td>
  <td>&nbsp;&nbsp;&nbsp;</td>
  <td> <input type="hidden" name="MM_insert" value="form1" /></td>
  <td>    <label for="ID">ID</label>
  <select name="ID" id="ID" tabindex="40" onchange="SelectedID(document.getElementById('ID'), 'Please Choose Something')">
  <option value="Select ID">Selecteer ID</option>
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
