<?php require_once('../Connections/HRMS.php'); ?>
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
include('Class_Salary_Increment.php'); 

$obj_Salary_Increment=new  Salary_Increment();
echo "<br/>";

echo "<form name=\"SelectedID\"  action=\"SalaryIncrementSetupStep2.php\" method=\"post\">";

echo "<input type=\"checkbox\" id=\"CHKALL\" name=\"CheckAll\" onclick=\"checkAll(document.SelectedID['CHK[]'])\" />Select All";

echo $obj_Salary_Increment->Calcualte_Increment();
echo "<br/>";

echo "<p align=\"center\"><input type=\"submit\" value=\"Next\" name=\"Next\"></p>";
echo "</form>";

?>

</body>
</html>