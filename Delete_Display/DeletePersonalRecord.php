<?php require_once('../Connections/HRMS.php'); ?>
<?php

require_once('../Classes/Class_AccessLevel.php');
$obj_AccessLevel = new AccessLevel();
echo $obj_AccessLevel->CHK_AccessLevel();
?>
<?php require_once('../Classes/Class_language.php'); ?>
<?php

if ((isset($_GET['ID'])) && ($_GET['ID'] != "")) {
    $deleteSQL = "DELETE FROM employee_personal_record WHERE ID='" . $_GET['ID'] . "'";

    mysql_select_db($database_HRMS, $HRMS);
    $Result1 = mysql_query($deleteSQL, $HRMS) or die(mysql_error());

    if ($Result1)
        echo "<script type=\"text/javascript\">alert('You have deleted the recored successfully.')</script>";

    $deleteGoTo = "PersonalRecordDisplay.php";
    if (isset($_SERVER['QUERY_STRING'])) {
        $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
        $deleteGoTo .= $_SERVER['QUERY_STRING'];
    }

    header(sprintf("Location: %s", $deleteGoTo));
}
?>
