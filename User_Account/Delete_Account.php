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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {



     $password=  "Select md5('" .$_POST['Password']. "') as password";
	$encrptpassword=mysql_query($password);
	$row=mysql_fetch_array($encrptpassword,MYSQL_ASSOC);
	


if(mysql_num_rows(mysql_query("SELECT * FROM users WHERE UserName='".$_POST['UserName']."' and Password='".$row['password']."'"))){
$dltaccount="delete from users where UserName='".$_POST['UserName']."' and   Password='".$row['password']."'";
  mysql_select_db($database_HRMS, $HRMS);
  $Result1 = mysql_query($dltaccount, $HRMS) or die(mysql_error());
  echo "<script type=\"text/javascript\">alert('You have delete the user account successfully!! ')</script>";
}
else
echo "<script type=\"text/javascript\">alert('You have enter wrong Username or Password for deletion ')</script>";
}

mysql_select_db($database_HRMS, $HRMS);
$query_RSDelete = "SELECT * FROM users";
$RSDelete = mysql_query($query_RSDelete, $HRMS) or die(mysql_error());
$row_RSDelete = mysql_fetch_assoc($RSDelete);
$totalRows_RSDelete = mysql_num_rows($RSDelete);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="284" align="center"  bgcolor="#EBEBEB">
    
    <tr valign="baseline">
      <td height="36" align="right" nowrap="nowrap">UserName:</td>
      <td><input type="text" name="UserName" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td height="37" align="right" nowrap="nowrap">Password:</td>
      <td><input  name="Password" type="password" value="" size="32" /></td>
    </tr>
        <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Delete Account" onclick="return confirm('Are you sure you want to Delete the specified user account?')"  /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($RSDelete);
?>
