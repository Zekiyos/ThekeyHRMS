<?php

$db = mysql_connect($hostname_HRMS, $username_HRMS, $password_HRMS);
if (!$db) {
    die('Not connected with Language Database : ' . mysql_error());
}
$db_selected = mysql_select_db($database_HRMS, $db);
if (!$db_selected) {
    die('Can\'t use Language database : ' . mysql_error());
}

//Setting Charcter set to unicode to support all language
mysql_set_charset('utf8', $db);
?>