<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Payroll Deduction Data Setting</title>

<link rel="stylesheet"  href="../../Css/tinybox2style.css" />
<script type="text/javascript" src="../../Js/tinybox.js"></script>

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
 require_once('../../Connections/HRMS.php');


include('../../Classes/Class_ThekeyPayrollSystem_Data_Setting.php'); 
$obj_PayrollData=new  ThekeyPayrollSystem_Data_Setting();

//include('Department_Selection.php');


//echo " <a  onclick=\"TINY.box.show({url:'Department_Selection.php',width:350,height:500})\">Department Selection</a>";


echo "<font color=\"#FF6600\" size=\"+1\"> <p align=\"center\">Thekey Payroll System Deduction Data Setting </p></font>";
//echo "<p align=\"center\"><a onclick=\"POPUPW=window.open('Department_Selection.php','POPUPW','width=400,height=500');\" >Department Selection</a></p>";

//echo "<p align=\"center\"><a href='Department_Selection.php'  >Department Selection</a></p>";

//if(isset($_GET['Department']))
//{
echo "<form name=\"SelectedID\"  action=\"PayrollDataSettingSetup2.php\" method=\"post\">";

echo "<table  cellpadding=\"0\" align=\"center\" border=\"1\" bordercolor=\"#00F\"> ";
echo "<tr><td>Payroll Data Fields</td><td>";
$obj_PayrollData->get_TotalDeductionBenefit_Columns();
echo "</td>";
echo "<td><input name=\"FieldData\" id=\"FieldData\" type=\"text\"></td></tr></table>";

echo "<br/>";

echo "<input type=\"checkbox\" id=\"CHKALL\" name=\"CheckAll\" onclick=\"checkAll(document.SelectedID['CHK[]'])\" />Select All";

//$obj_PayrollData->get_TotalDeduction_employee_list($_GET['Department']);
echo "<br/>";




echo "<p align=\"center\"><input type=\"submit\" value=\"Next\" name=\"Next\"></p>";
echo "</form>";
//}

?>


</body>
</html>