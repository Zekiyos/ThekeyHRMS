<?php

require_once('../Connections/HRMS.php');

$con = mysql_connect($hostname_HRMS, $username_HRMS, $password_HRMS);

if ($con) {
    mysql_select_db($database_HRMS, $con);
} else {
    die("Could not connect to database");
}
?>