 <?php
/// class usage for access level list
include('Class_AccessLevel.php');
 $obj_AccessLevel = new AccessLevel();
echo $obj_AccessLevel->CHK_AccessLevel();
//echo "http://" . $_SERVER['HTTP_HOST']."../login.php" ;
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "administrator";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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
	
 if(($_POST['Password'] )!= ($_POST['ConfirmPassword']))
 {
			echo "<script type=\"text/javascript\"> alert('The New Password You have entered is not similar with the confirmation password!!')</script>";	
 }else
				
if(mysql_num_rows(mysql_query("SELECT * FROM users WHERE UserName='".$_POST['UserName']."'"))){
	
	echo "<script type=\"text/javascript\"> alert('The user name'".$_POST['UserName']."'alerdy used.try to change to other.')</script>";
}else
{
	
	$password=  "Select ENCODE('" .$_POST['Password']. "','PASSWORD') as password";
	$encrptpassword=mysql_query($password);
	$row=mysql_fetch_array($encrptpassword,MYSQL_ASSOC);
	
	//echo $row['password'];
	
	
	
	$sqlcrtaccount=sprintf("INSERT INTO users (UserName, Password,Access_Level) VALUES ( %s,%s, %s)",                      
                       GetSQLValueString($_POST['UserName'], "text"),
                       GetSQLValueString( $row['password'], "text"),
                       GetSQLValueString($_POST['Granted_Access_Level'], "text")
					                  );
									  
									
									
		
				mysql_select_db($database_HRMS, $HRMS);
				$Result1 = mysql_query($sqlcrtaccount, $HRMS) or die(mysql_error());
				
				echo "<script type=\"text/javascript\"> alert('You have Creat User account {$_POST['UserName']} with Access Level for {$_POST['Granted_Access_Level']} Successfully'); </script>";

					}
					
				
		 
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
<script src="../SpryAssets/SpryValidationRadio.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationRadio.css" rel="stylesheet" type="text/css" />
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
  <input name="Password" type="password" size="30" />
  <span class="textfieldRequiredMsg">Type your Old Passowrd.</span><span class="textfieldMinCharsMsg">Minimum number of characters is 5.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters which is 12.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td height="44" align="right" nowrap="nowrap">Confirm Password:</td>
      <td><span id="sprytxtconfirmPassword">
    <input name="ConfirmPassword" type="password" size="30" />
    <span class="textfieldRequiredMsg">Enter Your New Password.</span><span class="textfieldMinCharsMsg">Minimum number of characters is 5.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters which is 12.</span></span></td>
    </tr>
    <tr align="center">
    <td align="right">Access Level</td>
    <td height="62" align="left"><p><span id="spryradio1">
      <?php echo $obj_AccessLevel->RetriveData('Granted_Access_Level','Radio');?>
      <!--label>
          <input type="radio" name="AccessLevel" value="user" id="RadioGroup2_0" />
          User</label>
        <br />
        <label>
          <input type="radio" name="AccessLevel" value="admin" id="RadioGroup2_1" />
          Admin</label>
        <br />
        <label>
          <input type="radio" name="AccessLevel" value="administrator" id="RadioGroup2_2" />
          Administrator</label-->
        <br />
        <span class="radioRequiredMsg">Please select user access level.</span></span>        <br />
    </p>
    <span><span class="textfieldRequiredMsg">Type Your New Password agian</span><span class="textfieldMinCharsMsg">Minimum number of characters is 5.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters which is 12.</span></span></td></tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Creat Account" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  
</form>

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytxtUserName", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytxtOldPassword", "none", {validateOn:["blur"], minChars:5, maxChars:12});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytxtconfirmPassword", "none", {minChars:5, maxChars:12, validateOn:["blur"]});
var spryradio1 = new Spry.Widget.ValidationRadio("spryradio1", {validateOn:["blur"]});
</script>
</body>
</html>
<?php
mysql_free_result($RSChangePassword);
?>
