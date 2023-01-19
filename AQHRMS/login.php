<?php require_once('Connections/HRMS.php'); ?>
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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['txtUsername'])) {
  $loginUsername=$_POST['txtUsername'];
  $password=$_POST['txtPassword'];
  $MM_fldUserAuthorization = "Access_Level";
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "login.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_HRMS, $HRMS);
  	
	$password=  "Select ENCODE('" .$_POST['txtPassword']. "','PASSWORD') as password";
	$encrptpassword=mysql_query($password);
	$row=mysql_fetch_array($encrptpassword,MYSQL_ASSOC);
	
	
	
  $LoginRS__query=sprintf("SELECT UserName, Password, Access_Level FROM users WHERE UserName=%s AND Password=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($row['password'], "text")); //$password for clear comaprisi
   
  $LoginRS = mysql_query($LoginRS__query, $HRMS) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'Access_Level');
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
   // header("Location: ". $MM_redirectLoginFailed );
   echo "<script type=\"text/javascript\">alert('Incorrect Username Or Password!Check if CAPS LOCK is ON.'); </script>";
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thekey HRMS login</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="img logo &amp; icons/favicon.ico" >
<link rel="icon" href="img logo &amp; icons/animated_favicon.gif" type="image/gif" >
</head>

<body  bgproperties="center" background="img logo &amp; icons/bg.JPG"  >
<blockquote>
    <blockquote> 
    <blockquote>
    <blockquote>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <form  ACTION="<?php echo $loginFormAction; ?>" id="frmLogin" name="frmLogin" method="POST" >
 
 
 <!--img src="fade.jpg" width="1000" height="300" /-->
<table width="386" height="139" bgcolor="#EBEBEB" align="center"  >
  <tr align="center">
  <td width="378" height="64">
  
    <label for="txtUsername">User Name</label>
    <span id="sprytextfield2">
    <input type="text" name="txtUsername" id="txtUsername" tabindex="10" />
    
    <span class="textfieldRequiredMsg">A value is required.</span></span></p>
  
  </tr>
  <tr align="center">
  <td height="67">
    <label for="txtPassword"> Password</label>
    <span id="sprypassword1">
    <input type="password" name="txtPassword" id="txtPassword" tabindex="20" />
    <span class="passwordRequiredMsg">A value is required.</span></span></p>
   
    
     <blockquote>
    <blockquote> 
    <blockquote>
    <blockquote>
    <blockquote>
     <blockquote>
      <input type="submit" name="btnLogin" id="btnLogin" value="Login" tabindex="30" align="right" />
    </blockquote>
    </blockquote>
    </blockquote>
    </blockquote>
     </blockquote>
    </blockquote>
    </td>
    </tr>
  </table>
<p>&nbsp;</p>
</form>
<script type="text/javascript">
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");
</script>
</body>
</html>