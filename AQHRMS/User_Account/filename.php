<?php /*
if (!isset($_SESSION)) {
  session_start();
}
/// class usage for access level list
include('../User_account/Class_AccessLevel.php');
 $obj_AccessLevel = new AccessLevel();

$pagepath= $obj_AccessLevel->get_pagename();
echo $pagepath."<br/>";
echo $obj_AccessLevel->get_Granted_AccessLevel($pagepath);

$MM_authorizedUsers=$obj_AccessLevel->get_Granted_AccessLevel($pagepath);

//$MM_authorizedUsers = "admin,administrator";

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
*/?>


<?php
/// class usage for access level list
include('../User_account/Class_AccessLevel.php');
 $obj_AccessLevel = new AccessLevel();
echo $obj_AccessLevel->CHK_AccessLevel();
echo "Granted";
echo $obj_AccessLevel->RetriveData('Granted_Access_Level','CHECKBOX');
echo $obj_AccessLevel->get_pagename();
//echo $obj_AccessLevel->get_Granted_AccessLevel("Annual_Leave_Grant.php");

//echo $obj_AccessLevel->get_Granted_AccessLevel("http://localhost/AQHRMS%28LANGUAGE%29/Leaves/Annual_Leave_Grant.php");

?>

<?php 
function getfilename($filePath){
$string="";
$fileCount=0;
$childDir="";
$realpath = dirname(realpath(__FILE__));
//checking the connection is secure or not the identfy http or https protocol then append server host name
$path = ((isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) != 'off') ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] ."/". substr($realpath, strlen($_SERVER['DOCUMENT_ROOT']));
if (DIRECTORY_SEPARATOR == '\\')
        $path = str_replace('\\', '/', $path);
		echo $path;

//$PATH=$_SERVER['DOCUMENT_ROOT'];
//$filePath=$PATH.'/'; # Specify the path you want to look in. 
$dir = opendir($filePath); # Open the path
//echo "<select>";
if(is_dir("$filePath")){
while ($file = readdir($dir)) {
	
	if (preg_match('/.php/i', $file))
	 {
  //if (eregi("\.php",$file)) { # Look at only files with a .php extension
  //echo "<option>";
  //echo "$file</option>";
    $string .= "$file<br />"; 
    $fileCount++;
	

  }else
  if(is_dir($file))
  { 
  //getfilename($file);
 
  }
   
}

//echo "</select>";
if ($fileCount > 0) {
  echo sprintf("<strong>List of Files in %s</strong><br />%s<strong>Total Files: %s</strong>",$filePath,$string,$fileCount);
}

}
}
//$url1="http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI'];
//getTitle("http://localhost/AQHRMS(LANGUAGE)/User_Account/filename.php");
//getfilename($_SERVER['DOCUMENT_ROOT']."AQHRMS(LANGUAGE)/User_Account/");


?>

<?php

function getTitle($Url){
    $str = file_get_contents($Url);
    if(strlen($str)>0){
        preg_match("/\<title\>(.*)\<\/title\>/",$str,$title);
        return $title[1];
    }
}
//Example:
//echo getTitle("http://www.washingtontimes.com/");

?>



<?php
/*
 * mrlemonade ~
 */

function getFilesFromDir($dir) {

  $files = array();
  if ($handle = opendir($dir)) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
            if(is_dir($dir.'/'.$file)) {
                $dir2 = $dir.'/'.$file;
                $files[] = getFilesFromDir($dir2);
            }
            else {
              $files[] = $dir.'/'.$file;
            }
        }
    }
    closedir($handle);
  }

  return array_flat($files);
}

function array_flat($array) {
$tmp=array();
  foreach($array as $a) {
    if(is_array($a)) {
      $tmp = array_merge($tmp, array_flat($a));
    }
    else {
      $tmp[] = $a;
    }
  }

  return $tmp;
}

// Usage
//$dir = '/data';
$dir=$_SERVER['DOCUMENT_ROOT']."aqhrms/";
//$foo = getFilesFromDir($dir);

//print_r($foo)."<br/>";

?>