<?php

//require_once("Language.php");
 
/*******
$DB_HOST = '<HOSTNAME>';
$DB_USER = '<USERNAME>';
$DB_PASSWORD = '<PASSWORD>';
$DB_DATABASE = 'language';
$DB_PORT = <PORT>*/

$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASSWORD = '';
$DB_DATABASE = 'ThekeyHRMSlanguage';
$DB_PORT = '3306';

//$db = new MySQLi($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_DATABASE,$DB_PORT);

$db = mysql_connect($DB_HOST, $DB_USER, $DB_PASSWORD);
if (!$db) {
    die('Not connected with Language Database : ' . mysql_error());
}
$db_selected = mysql_select_db($DB_DATABASE, $db);
if (!$db_selected) {
    die ('Can\'t use Language database : ' . mysql_error());
}

//Setting Charcter set to unicode to support all language
mysql_set_charset('utf8',$db); 
// $db -> set_charset('utf8');

// create a new Langauge Object
/////$obj_lang = new Language($db);
 
// ideally pull this from a users profile.
/////$lang = $_REQUEST["lang"]; 
// $lang = "en"; 
?>