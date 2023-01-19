<?php require_once('../Connections/HRMS.php'); ?>
<?php
require_once('../Classes/Class_AccessLevel.php');
$obj_AccessLevel = new AccessLevel();
echo $obj_AccessLevel->CHK_AccessLevel();
?>

<?php
if ((isset($_GET['Department'])) && ($_GET['Department'] != "")) {
    $deleteSQL = sprintf("DELETE FROM department WHERE Department=%s", GetSQLValueString($_GET['Department'], "text"));

    mysql_select_db($database_HRMS, $HRMS);
    $Result1 = mysql_query($deleteSQL, $HRMS) or die(mysql_error());

    $deleteGoTo = "DepartmentDisplay.php";
    if (isset($_SERVER['QUERY_STRING'])) {
        $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
        $deleteGoTo .= $_SERVER['QUERY_STRING'];
    }
    header(sprintf("Location: %s", $deleteGoTo));
}

mysql_select_db($database_HRMS, $HRMS);
$query_RSDepartmentDelete = "SELECT * FROM department";
$RSDepartmentDelete = mysql_query($query_RSDepartmentDelete, $HRMS) or die(mysql_error());
$row_RSDepartmentDelete = mysql_fetch_assoc($RSDepartmentDelete);
$totalRows_RSDepartmentDelete = mysql_num_rows($RSDepartmentDelete);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Department Delete</title>
    </head>

    <body>
    </body>
</html>
<?php
mysql_free_result($RSDepartmentDelete);
?>
