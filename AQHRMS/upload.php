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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
 // $insertSQL = sprintf("INSERT INTO upload (id, name, type, `size`, content) VALUES (%s, %s, %s, %s, %s)",
//                       GetSQLValueString($_POST['id'], "int"),
//                       GetSQLValueString($_POST['name'], "text"),
//                       GetSQLValueString($_POST['type'], "text"),
//                       GetSQLValueString($_POST['size'], "int"),
//                       GetSQLValueString($_POST['content'], "text"));
//
//  mysql_select_db($database_HRMS, $HRMS);
//  $Result1 = mysql_query($insertSQL, $HRMS) or die(mysql_error());

if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
{
$fileName = $_FILES['userfile']['name'];
$tmpName  = $_FILES['userfile']['tmp_name'];
$fileSize = $_FILES['userfile']['size'];
$fileType = $_FILES['userfile']['type'];

$fp      = fopen($tmpName, 'r');
$content = fread($fp, filesize($tmpName));
$content = addslashes($content);
fclose($fp);

if(!get_magic_quotes_gpc())
{
    $fileName = addslashes($fileName);
}

//include 'library/config.php';
//include 'library/opendb.php';

$query = "INSERT INTO upload (name, size, type, content ) ".
"VALUES ('$fileName', '$fileSize', '$fileType', '$content')";

mysql_query($query) or die('Error, query failed');
//include 'library/closedb.php';

echo "<br>File $fileName uploaded<br>";
} 


}

mysql_select_db($database_HRMS, $HRMS);
$query_rsupload = "SELECT * FROM upload";
$rsupload = mysql_query($query_rsupload, $HRMS) or die(mysql_error());
$row_rsupload = mysql_fetch_assoc($rsupload);
$totalRows_rsupload = mysql_num_rows($rsupload);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<!--form method="post" enctype="multipart/form-data">
<table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
<tr>
<td width="246">
<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
<input name="userfile" type="file" id="userfile">
</td>
<td width="80"><input name="upload" type="submit" class="box" id="upload" value=" Upload "></td>
</tr>
</table>
</form-->
<?php
if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
{
$fileName = $_FILES['userfile']['name'];
$tmpName  = $_FILES['userfile']['tmp_name'];
$fileSize = $_FILES['userfile']['size'];
$fileType = $_FILES['userfile']['type'];

$fp      = fopen($tmpName, 'r');
$content = fread($fp, filesize($tmpName));
$content = addslashes($content);
fclose($fp);

if(!get_magic_quotes_gpc())
{
    $fileName = addslashes($fileName);
}

//include 'library/config.php';
//include 'library/opendb.php';

$query = "INSERT INTO upload (name, size, type, content ) ".
"VALUES ('$fileName', '$fileSize', '$fileType', '$content')";

mysql_query($query) or die('Error, query failed');
//include 'library/closedb.php';

echo "<br>File $fileName uploaded<br>";
}
?>

  <!--table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Id:</td>
      <td><input type="text" name="id" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Name:</td>
      <td><input type="text" name="name" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Type:</td>
      <td><input type="text" name="type" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Size:</td>
      <td><input type="text" name="size" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Content:</td>
      <td><input type="text" name="content" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record" /></td>
    </tr>
  </table-->
 <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" enctype="multipart/form-data">
  <table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
<tr>
<td width="246">
<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
<input name="userfile" type="file" id="userfile">
</td>
<td width="80"><input name="upload" type="submit" class="box" id="upload" value=" Upload "></td>
</tr>
</table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsupload);
?>
<!--
Downloading Files From MySQL Database

When we upload a file to database we also save the file type and length. These were not needed for uploading the files but is needed for downloading the files from the database.

The download page list the file names stored in database. The names are printed as a url. The url would look like download.php?id=3. To see a working example click here. I saved several images in my database, you can try downloading them.

Example :  

<html>
<head>
<title>Download File From MySQL</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<?php/*
include 'library/config.php';
include 'library/opendb.php';

$query = "SELECT id, name FROM upload";
$result = mysql_query($query) or die('Error, query failed');
if(mysql_num_rows($result) == 0)
{
echo "Database is empty <br>";
}
else
{
while(list($id, $name) = mysql_fetch_array($result))
{
?>
<a href="download.php?id=<?php=$id;?>"><?php=$name;?></a> <br>
<?php
/*
}
}
include 'library/closedb.php';
?>
</body>
</html>

 

When you click the download link, the $_GET['id'] will be set. We can use this id to identify which files to get from the database. Below is the code for downloading files from MySQL Database.

Example :  
<?php 
if(isset($_GET['id']))
{
// if id is set then get the file with the id from database

include 'library/config.php';
include 'library/opendb.php';

$id    = $_GET['id'];
$query = "SELECT name, type, size, content " .
         "FROM upload WHERE id = '$id'";

$result = mysql_query($query) or die('Error, query failed');
list($name, $type, $size, $content) =                                  mysql_fetch_array($result);

header("Content-length: $size");
header("Content-type: $type");
header("Content-Disposition: attachment; filename=$name");
echo $content;

include 'library/closedb.php';
exit;
}
*/
?>

Before sending the file content using echo first we need to set several headers. They are :

    header("Content-length: $size")
    This header tells the browser how large the file is. Some browser need it to be able to download the file properly. Anyway it's a good manner telling how big the file is. That way anyone who download the file can predict how long the download will take.
    header("Content-type: $type")
    This header tells the browser what kind of file it tries to download.
    header("Content-Disposition: attachment; filename=$name");
    Tells the browser to save this downloaded file under the specified name. If you don't send this header the browser will try to save the file using the script's name (download.php).

After sending the file the script stops executing by calling exit.

NOTE :
When sending headers the most common error message you will see is something like this :

Warning: Cannot modify header information - headers already sent by (output started at C:\Webroot\library\config.php:7) in C:\Webroot\download.php on line 13

This error happens because some data was already sent before we send the header. As for the error message above it happens because i "accidentally" add one space right after the PHP closing tag ( ?> )  in config.php file. So if you see this error message when you're sending a header just make sure you don't have any data sent before calling header(). Check the file mentioned in the error message and go to the line number specified -->