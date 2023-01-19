<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_HRMS = "localhost";
$database_HRMS = "aqhrmsdb";
$username_HRMS = "root";
$password_HRMS = "";
$HRMS = mysql_pconnect($hostname_HRMS, $username_HRMS, $password_HRMS) or trigger_error(mysql_error(),E_USER_ERROR); 
?>