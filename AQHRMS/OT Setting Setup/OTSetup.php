<?php require_once('../Connections/HRMS.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript">
   
function checkAll(field) {
    if((document.SelectedID.CheckAll_ID.checked) ||
	  (document.SelectedID.CheckAll_DayOT.checked) ||
	  (document.SelectedID.CheckAll_NightOT.checked)||
	  (document.SelectedID.CheckAll_SundayOT.checked)||
	  (document.SelectedID.CheckAll_HolydayOT.checked) )
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
include('Class_OT_Setting.php'); 

$obj_OT=new  OT_Setting();
echo "<br/>";
include ("SelectedDepartment4OTSetting.php");
echo "<form name=\"SelectedID\"  action=\"OTSetupStep2.php\" method=\"post\">";

echo "<input type=\"checkbox\" id=\"CHKALL_ID\" name=\"CheckAll_ID\" onclick=\"checkAll(document.SelectedID['CHK_ID[]'])\" />Select All";
//echo $obj_OT->get_department_list("AQHRMSDB");

if(isset ($_GET['Department']))
echo $obj_OT->OT_Setting_List($_GET['Department']);
echo "<br/>";

echo "<p align=\"center\"><input type=\"submit\" value=\"Next\" name=\"Next\"></p>";
echo "</form>";

?>

</body>
</html>