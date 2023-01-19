<?php

# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
if (!defined('validurl'))
    if (!defined('validurl'))
        define("validurl", TRUE);

if (!function_exists("alert")) {

    function alert($message) {
        echo "<script type=\"text/javascript\">alert('$message')</script>";
    }

}
$base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
require_once $base_path . 'config/database.php';



$HRMS = mysql_pconnect($hostname_HRMS, $username_HRMS, $password_HRMS) or trigger_error(mysql_error(), E_USER_ERROR);
mysql_select_db($database_HRMS);
mysql_set_charset('utf8', $HRMS);
?>