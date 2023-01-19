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
$query_RSFirstName = "SELECT * FROM employee_personal_record ORDER BY FirstName ASC";
$RSFirstName = mysql_query($query_RSFirstName, $HRMS) or die(mysql_error());
$row_RSFirstName = mysql_fetch_assoc($RSFirstName);
$totalRows_RSFirstName = mysql_num_rows($RSFirstName);mysql_select_db($database_HRMS, $HRMS);
$query_RSFirstName = "SELECT ID, FirstName, MiddelName, LastName FROM employee_personal_record ORDER BY FirstName ASC";
$RSFirstName = mysql_query($query_RSFirstName, $HRMS) or die(mysql_error());
$row_RSFirstName = mysql_fetch_assoc($RSFirstName);
$totalRows_RSFirstName = mysql_num_rows($RSFirstName);
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
<body >
<form id="form1" name="form1" method="get" action="">
  የሰራተኛውን ስም ይጻፉ ወይም ይምረጡ
  <input type="text" name="txtFirstName" id="txtFirstName" tabindex="20" 
  />
  <script type="text/javascript">
 document.getElementById('txtFirstName').onkeypress = function(e){
    if (!e) e = window.event;  
	 // resolve event instance
    if (e.keyCode == '13'){
      //alert(this.value);
	  document.getElementById('Display').click();
      return false;
    }
  }
</script>
  <input type="button" value="Display" onclick="TypedFirstName(document.getElementById('txtFirstName'), 'Please Type the name of Employee first')" id="Display"  />
  
  
   <label for="FirstName"></label>
    <select name="FirstName" id="FirstName" onchange="SelectedFirstName(document.getElementById('FirstName'), 'Please Choose Something')">
      <option label="Please Choose Name"></option> 
      <?php
	  //echo $_GET['FirstName'];
	  if(($_GET['FirstName'] =="") or ( $_GET['ID']=="" ))
				{
					if(( $_GET['ID']=="" ) and ($_GET['FirstName'] !=""))
					$_GET['ID']=="X";
					else
					if(( $_GET['ID']!= "" ) and ($_GET['FirstName'] ==""))
					$_GET['FirstName']="X";
										
				}
				 if(($_GET['FirstName'] =="") and ( $_GET['ID']=="" ))
				 {
					 $_GET['ID']=="X";
					 $_GET['FirstName']="X";
				 }
	do {  
?>
      <option value="<?php echo $row_RSFirstName['FirstName']?>"><?php echo $row_RSFirstName['FirstName']?></option>
      <?php
} while ($row_RSFirstName = mysql_fetch_assoc($RSFirstName));
  $rows = mysql_num_rows($RSFirstName);
  if($rows > 0) {
      mysql_data_seek($RSFirstName, 0);
	  $row_RSID = mysql_fetch_assoc($RSFirstName);
  }
	
?>

  


  </select>
    <label for="ID">ID</label>
  <select name="ID" id="ID" tabindex="40" onchange="SelectedID(document.getElementById('ID'), 'Please Choose Something')">
    <?php
	if(($_GET['FirstName'] =="") or ( $_GET['ID']=="" ))
				{
					if(( $_GET['ID']=="" ) and ($_GET['FirstName'] !=""))
					$_GET['ID']="X";
					else
					if(( $_GET['ID']!="" ) and ($_GET['FirstName'] ==""))
					$_GET['FirstName']="X";
										
				}
				 if(($_GET['FirstName'] =="") and ( $_GET['ID']=="" ))
				 {
					 $_GET['ID']="X";
					 $_GET['FirstName']="X";
				 }
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
  </select>
</form>
</body>
</html>
<?php
mysql_free_result($RSFirstName);
?>
