<?php require_once('../../Connections/HRMS.php'); ?>
<?php 
include('../../Classes/Class_AccessLevel.php');
 $obj_AccessLevel = new AccessLevel();
echo $obj_AccessLevel->CHK_AccessLevel(); 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript">
   
function checkAll(field) {
    if(document.SelectedID.CheckAll.checked)
    {
    for (i = 0; i < field.length; i++)
    field[i].checked = true;
    }
    else
    {
    for (i = 0; i < field.length; i++)
    field[i].checked = false;
    }
    }
</script>
</head>

<body>

<?php
 


include('../../Classes/Class_Terminated_Employee_Cleaner.php'); 
$obj_Terminated_Cleaner=new  Terminated_Employee_Cleaner();

echo "<font color=\"#FF6600\" size=\"+1\"> <p align=\"center\">Terminated Employee Cleaner Data </p></font>";
echo "<form name=\"SelectedID\"  action=\"Terminated_Employee_CleanerSetup2.php\" method=\"post\">";

echo "<input type=\"checkbox\" id=\"CHKALL\" name=\"CheckAll\" onclick=\"checkAll(document.SelectedID['CHK[]'])\" />Select All";

$obj_Terminated_Cleaner->get_Terminated_employee_list();
echo "<br/>";

echo "<p align=\"center\"><input type=\"submit\" value=\"Next\" name=\"Next\"></p>";
echo "</form>";


?>


</body>
</html>