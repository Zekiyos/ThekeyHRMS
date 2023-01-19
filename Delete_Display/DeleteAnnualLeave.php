<?php require_once('../Connections/HRMS.php'); ?>
<?php
require_once('../Classes/Class_AccessLevel.php');
$obj_AccessLevel = new AccessLevel();
echo $obj_AccessLevel->CHK_AccessLevel();
?>

<?php
if ((isset($_GET['Auto_ID'])) && ($_GET['Auto_ID'] != "")) {
    $deleteSQL = sprintf("DELETE FROM annual_leave WHERE Auto_ID=%s", GetSQLValueString($_GET['Auto_ID'], "int"));

    mysql_select_db($database_HRMS, $HRMS);
    $Result1 = mysql_query($deleteSQL, $HRMS) or die(mysql_error());

    $deleteGoTo = "AnnualLeaveDisplay.php";
    if (isset($_SERVER['QUERY_STRING'])) {
        $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
        $deleteGoTo .= $_SERVER['QUERY_STRING'];
    }
    echo "<script type=\"text/javascript\">alert('You Have deleted the record successfully.')</script>";
    header(sprintf("Location: %s", $deleteGoTo));
}

mysql_select_db($database_HRMS, $HRMS);
$query_RSDeleteAnnualLeave = "SELECT * FROM annual_leave";
$RSDeleteAnnualLeave = mysql_query($query_RSDeleteAnnualLeave, $HRMS) or die(mysql_error());
$row_RSDeleteAnnualLeave = mysql_fetch_assoc($RSDeleteAnnualLeave);
$totalRows_RSDeleteAnnualLeave = mysql_num_rows($RSDeleteAnnualLeave);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Untitled Document</title>
    </head>

    <body>
    </body>
</html>
<?php
mysql_free_result($RSDeleteAnnualLeave);
?>
