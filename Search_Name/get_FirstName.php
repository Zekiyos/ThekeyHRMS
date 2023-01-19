<?php

if (!session_id()) {
    session_start();
}
if (!(isset($base_url))) {
    if (!defined('validurl'))
        define("validurl", TRUE);
    $base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
    $base_url = $_SERVER['SERVER_NAME'] . '/ThekeyHRMS/';
}

require_once $base_path . 'config/database.php';
require_once $base_path . 'Classes/Class_AccessLevel.php';
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$HRMS = mysql_pconnect($hostname_HRMS, $username_HRMS, $password_HRMS) or trigger_error(mysql_error(), E_USER_ERROR);
?>
<?php

//require_once "../Config/config.php";
$q = strtolower($_GET["q"]);
if (isset($q) && (is_numeric($q))) {

    $q = strip_tags($q);
    $qF = trim($q);
    $fieldF = "ID";
    $fieldM="FirstName";
    $qM="";
} else {

    $q = strtoupper($q);
    $q = strip_tags($q);
    $q = trim($q);
    $qs=explode(" ",$q);
    
 
   // print_r($qs);
    $fieldF = "FirstName";
    $fieldM = "MiddelName";
    if(1==count($qs)){
       
       $qF=$qs[0];
    $qM="";  
    }else{
         $qF=$qs[0];
    $qM=$qs[1];
    }
    
}

if (!$q)
    return;
if (isset($_GET['TableName'])) {

    $sql = "SELECT  DISTINCT FirstName,MiddelName,Department from " . $_GET['TableName'] . " where ( $fieldF LIKE '%$qF%' AND $fieldM LIKE '%$qM%'";
} else {
    $sql = "SELECT DISTINCT FirstName,MiddelName,Department from employee_personal_record where ( $field LIKE '%$q%'";
}
$obj_AccessLevel = new AccessLevel();
$selecte_group = $_SESSION['MM_UserGroup'];
$my_department = $obj_AccessLevel->get_department_access($selecte_group);

if ($my_department) {
    if (count($my_department) > 0) {
        $is_first = true;
        foreach ($my_department as $key => $value) {
            if ($is_first) {
                $sql .=') and ( `employee_personal_record`.`Department`=\'' . $value . '\'';
                $is_first = false;
            }
            else
                $sql .=' or   `employee_personal_record`.`Department`=\'' . $value . '\'';
        }
    }
}
$sql=$sql.')';
//echo $sql;
$rsd = mysql_query($sql);

if ($rsd) {
    while ($rs = mysql_fetch_array($rsd)) {
        $fname = $rs['FirstName'];
        $mname = $rs['MiddelName'];
        echo "$fname $mname\n";
    }
}
?>