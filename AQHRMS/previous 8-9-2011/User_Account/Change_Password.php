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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	
 if(($_POST['NewPassword'] )!= ($_POST['ConfirmPassword']))
 {
			echo "<script type=\"text/javascript\"> alert('The New Password You have entered is not similar with the confirmation password!!')</script>";	
 }else
				
    /*********************************************Password encription	*/
	$oldpassword=  "Select ENCODE('" .$_POST['OldPassword']. "','PASSWORD') as password";
	$encrptoldpassword=mysql_query($oldpassword);
	$rowold=mysql_fetch_array($encrptoldpassword,MYSQL_ASSOC);
	
	$newpassword=  "Select ENCODE('" .$_POST['NewPassword']. "','PASSWORD') as NewPassword";
	$encrptnewpassword=mysql_query($newpassword);
	$rownew=mysql_fetch_array($encrptnewpassword,MYSQL_ASSOC);
	
	/****************************************/
			if(mysql_num_rows(mysql_query("SELECT * FROM users WHERE UserName='".$_POST['UserName']."' and Password='".$rowold['password']."'"))){	
			
			$sqlchgPassword="UPDATE users SET Password='".$rownew['NewPassword']."' where UserName='".$_POST['UserName']."' and Password='".$rowold['password']."'";
				mysql_select_db($database_HRMS, $HRMS);
				$Result1 = mysql_query($sqlchgPassword, $HRMS) or die(mysql_error());
				echo "<script type=\"text/javascript\"> alert('You have changed the Password Successfully!!')</script>";

					}
					else 
echo "<script type=\"text/javascript\"> alert('User Name OR Current Password you have enter is incorrect!!')</script>";
				
		 
}

mysql_select_db($database_HRMS, $HRMS);
$query_RSChangePassword = "SELECT * FROM users";
$RSChangePassword = mysql_query($query_RSChangePassword, $HRMS) or die(mysql_error());
$row_RSChangePassword = mysql_fetch_assoc($RSChangePassword);
$totalRows_RSChangePassword = mysql_num_rows($RSChangePassword);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="690" height="227" align="center"  bgcolor="#EBEBEB">
    <tr valign="baseline">
      <td height="37" align="right" nowrap="nowrap">UserName:</td>
      <td> <span id="sprytxtUserName">
      <input name="UserName" type="text" id="UserName"  size="30"/>
    <span class="textfieldRequiredMsg">Enter User Name First.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td height="44" align="right" nowrap="nowrap">Password:</td>
      <td><span id="sprytxtOldPassword">
  <input name="OldPassword" type="password" size="30" />
  <span class="textfieldRequiredMsg">Type your Old Passowrd.</span><span class="textfieldMinCharsMsg">Minimum number of characters is 5.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters which is 12.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td height="44" align="right" nowrap="nowrap">New Password:</td>
      <td><span id="sprytxtNewPassword">
    <input name="NewPassword" type="password" size="30" />
    <span class="textfieldRequiredMsg">Enter Your New Password.</span><span class="textfieldMinCharsMsg">Minimum number of characters is 5.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters which is 12.</span></span></td>
    </tr>
    <tr align="center">
    <td align="right">Confirm Password</td>
    <td height="62" align="left"><span id="sprytxtConfirmPassword">
    <input name="ConfirmPassword" size="30" type="password" />
    <span class="textfieldRequiredMsg">Type Your New Password agian</span><span class="textfieldMinCharsMsg">Minimum number of characters is 5.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters which is 12.</span></span></td></tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Change Password" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  
</form>

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytxtUserName", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytxtOldPassword", "none", {validateOn:["blur"], minChars:5, maxChars:12});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytxtNewPassword", "none", {minChars:5, maxChars:12, validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytxtConfirmPassword", "none", {minChars:5, maxChars:12, validateOn:["blur"]});
</script>
</body>
</html>
<?php
mysql_free_result($RSChangePassword);
?>
