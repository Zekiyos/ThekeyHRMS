<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_PayrollDB = "localhost";
$database_PayrollDB = "Payrolldb";
$username_PayrollDB = "root";
$password_PayrollDB = "";
$PayrollDB = mysql_pconnect($hostname_PayrollDB, $username_PayrollDB, $password_PayrollDB) or trigger_error(mysql_error(),E_USER_ERROR); 
?>