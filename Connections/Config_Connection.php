<?php

# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"

//$appRoot=$_SERVER['DOCUMENT_ROOT'].'/ThekeyHRMS/';

//include($appRoot.'Classes/Class_Connection.php');


       $hostName ="localhost";
        $userName = "root";
        $password = "";
        $dbName = "Thekeyhrmsdb_sher";
        
$ThekeyHRMSCon= mysql_pconnect($hostName,$userName,$password) or trigger_error(mysql_error(),E_USER_ERROR);

mysql_select_db($dbName);

mysql_set_charset('UTF8',$ThekeyHRMSCon);

?>