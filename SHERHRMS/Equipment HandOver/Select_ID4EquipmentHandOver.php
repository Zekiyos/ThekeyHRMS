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
$totalRows_RSFirstName = mysql_num_rows($RSFirstName);

mysql_select_db($database_HRMS, $HRMS);
$query_RSID = "SELECT ID FROM employee_personal_record ORDER BY ID ASC";
$RSID = mysql_query($query_RSID, $HRMS) or die(mysql_error());
$row_RSID = mysql_fetch_assoc($RSID);
$totalRows_RSID = mysql_num_rows($RSID);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>

<script type='text/javascript'>
function SelectedID(elem, helperMsg){
	//document.writeln(elem.value);
	alert ( "You have Slelcted " + elem.value + "!")
	var ID=elem.value;
	
location="Equipment_HandOver.php?ID=" + elem.value;
	if(elem.value == "Please Choose ID"){
		alert(helperMsg);
		elem.focus();
		return false;
	}else{
		return true;
	}
}

</script>

<head>

</head>
<!--Probation_Evaluation.php-->
<body >
<form id="form1" name="form1" method="get" action="" >
  <p>
    <label for="ID">Select Employee ID:</label>
    <select name="ID" id="ID" onchange="SelectedID(document.getElementById('ID'), 'Please Choose Something')">
      <option label="Please Choose Name"></option> 
      <?php
	 // echo $_GET['ID'];
	 
	           if(isset($_GET['ID'] ))
				{
				}
	do {  
?>
      <option value="<?php echo $row_RSID['ID']?>"><?php echo $row_RSID['ID']?></option>
      <?php
} while ($row_RSID = mysql_fetch_assoc($RSID));
  $rows = mysql_num_rows($RSID);
  if($rows > 0) {
      mysql_data_seek($RSID, 0);
	  $row_RSID = mysql_fetch_assoc($RSID);
  }
	 
?>
    </select>
  </form>
</body>
</html>
<?php
mysql_free_result($RSFirstName);

mysql_free_result($RSID);
?>
