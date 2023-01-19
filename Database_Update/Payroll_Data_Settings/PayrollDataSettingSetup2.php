<?php require_once('../../Connections/HRMS.php'); ?>
<?php

require_once('../../Classes/Class_AccessLevel.php');
$obj_AccessLevel = new AccessLevel();
echo $obj_AccessLevel->CHK_AccessLevel();
?>

<?php

require_once('../../Classes/Class_ThekeyPayrollSystem_Data_Setting.php');

$obj_PayrollData = new ThekeyPayrollSystem_Data_Setting();

echo "<form name=\"SelectedID4Update\"  action=\"PayrollDataSettingSetup3.php\" method=\"post\">";

echo "<input  name=\"IDNo\" type=\"hidden\" >";
//session_start();
$_SESSION['IDNo'] = "";


if (isset($_POST['CHK']) && isset($_POST['Next']) && isset($_POST['FieldData']) && isset($_POST['Field'])) {
    $a = $_POST['CHK'];
    $field = $_POST['Field'];
    $fieldData = $_POST['FieldData'];




    if (empty($a)) {
        echo "<font color=\"#FF0000\">";
        echo("You didn't Select any Employee for Payroll Data Setting.<br/>");
        echo "</font>";
    } else
    if ($field == "Please Choose Payroll Data Field") {
        echo "<font color=\"#FF0000\">";
        echo("You didn't Select Payroll Data Field.<br/>");
        echo "</font>";
    } else
    if ($fieldData == "") {
        echo "<font color=\"#FF0000\">";
        echo("You didn't Put Payroll Data for the Selected Field $field .<br/>");
        echo "</font>";
    } else {
        $N = count($a);
        /* for($i=0; $i < $N; $i++)
          {
          $IDNumber=str_replace("'","",$a[$i]);

          $_SESSION['IDNo'].=",".$IDNumber;
          } */
        echo("You have selected <font color=\"#FF0000\">$N</font> Employees(s):<br/> ");

        echo("To Set Payroll Data <font color=\"#FF0000\">$fieldData</font> for the Field <font color=\"#FF0000\">$field</font> .<br/>");

        echo("<font color=\"#FF0000\">$field=$fieldData</font> .<br/>");

        echo "<input  name=\"Field\" type=\"hidden\" value=\"$field\">";
        echo "<input  name=\"FieldData\" type=\"hidden\" value=\"$fieldData\">";


        $obj_PayrollData->get_selected_employee($a);
    }
}
echo "<p align=\"center\"><a href=\"PayrollDataSettingSetup.php\"><input type=\"button\" value=\"Before\" name=\"Before\" ></a>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"Update\" value=\"Run\"></p>";
echo "</form>";
?>