<?php require_once('../../Connections/HRMS.php'); ?>
<?php
require_once('../../Classes/Class_AccessLevel.php');
$obj_AccessLevel = new AccessLevel();
echo $obj_AccessLevel->CHK_AccessLevel();
?>

<?php
if ((isset($_GET['Auto_ID'])) && ($_GET['Auto_ID'] != "")) {
    $deleteSQL = sprintf("DELETE FROM equipment_handover WHERE Auto_ID=%s", GetSQLValueString($_GET['Auto_ID'], "int"));

    mysql_select_db($database_HRMS, $HRMS);
    $Result1 = mysql_query($deleteSQL, $HRMS) or die(mysql_error());

    $deleteGoTo = "EquipmentHandOverDisplay.php";
    if (isset($_SERVER['QUERY_STRING'])) {
        $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
        $deleteGoTo .= $_SERVER['QUERY_STRING'];
    }
    header(sprintf("Location: %s", $deleteGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Equipmnet Handover Data Delete</title>
    </head>

    <body>
    </body>
</html>