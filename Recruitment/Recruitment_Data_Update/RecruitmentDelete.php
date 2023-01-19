<?php require_once('../../Connections/HRMS.php'); ?>
<?php
require_once('../../Classes/Class_AccessLevel.php');
$obj_AccessLevel = new AccessLevel();
echo $obj_AccessLevel->CHK_AccessLevel();
?>

<?php
if ((isset($_GET['ID'])) && ($_GET['ID'] != "")) {
    $deleteSQL = "DELETE FROM recruitment WHERE ID='" . $_GET['ID'] . "'";
    mysql_select_db($database_HRMS, $HRMS);
    $Result1 = mysql_query($deleteSQL, $HRMS) or die(mysql_error());

    $deleteGoTo = "RecruitmentDisplay.php";
    if (isset($_SERVER['QUERY_STRING'])) {
        $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
        $deleteGoTo .= $_SERVER['QUERY_STRING'];
    }
    header(sprintf("Location: %s", $deleteGoTo));
}

mysql_select_db($database_HRMS, $HRMS);
$query_RSRecruitmentDelete = "SELECT * FROM recruitment";
$RSRecruitmentDelete = mysql_query($query_RSRecruitmentDelete, $HRMS) or die(mysql_error());
$row_RSRecruitmentDelete = mysql_fetch_assoc($RSRecruitmentDelete);
$totalRows_RSRecruitmentDelete = mysql_num_rows($RSRecruitmentDelete);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Recruitment Data Deletion</title>
    </head>

    <body>
    </body>
</html>
<?php
mysql_free_result($RSRecruitmentDelete);
?>
