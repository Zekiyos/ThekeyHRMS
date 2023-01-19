<?php require_once('../Connections/Config_Connection.php'); ?>
<?php

require_once '../Classes/Class_Chart.php';
$objChart = new Chart();

if ((isset($_POST['Chart']))) {
    $chartName = $_POST['Chart'];

    list($Chart_Name, $Chart_Caption, $Chart_Type, $X_axis_Title,
            $X_axis_Category_Field, $Y_axis_Title, $Y_axis_Summary_Field, $Y_axis_Summary_Value,
            $Series_Field_Summary,
            $Series_Field, $Table_Name, $Join_Table, $Where_Clause) = $objChart->get_Chart_Defintion($chartName);

    if ((substr($Chart_Type, 0, 2) == 'MS' ) || (substr($Chart_Type, 0, 7) == 'Stacked' )) {
        $series = 'Multi';
    } else {
        $series = 'Single';
    }

    echo '<fieldset id="selectedIDfieldset"><legend>' . $chartName . ' Chart Display Option</legend>';
    echo'<table>';

    if ($Where_Clause != '') {
        $whereCondition = explode(',', $Where_Clause);

        echo '<tr>';
        $countParameter = 0;
        foreach ($whereCondition as $key => $whereConditionValue) {
            $countParameter++;
            $wherevalue = explode('=', $whereConditionValue);

            echo '<td>';
            echo $wherevalue[1];
            echo '</td>';
            echo '<td>';
            echo '<input type="text" Name="' . $wherevalue[0] . '" required />';
            echo '</td>';
        }
        echo '</tr>';
    }

    echo '<tr> <td height="2" align="right" nowrap="nowrap" colspan="1">Chart Type</td>';
    echo '<td align="left" colspan="3">';
    echo '<select name="chartType" id="chartType" class="\chartType\"  >';
    echo '<option >--Select Chart Type--</option>';

    $objChart->getChartType($series);

    echo '</select>';
    echo '</td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td height="2" align="right" nowrap="nowrap" colspan="1">Show Name</td>';
    echo '<td align="left"><input type="radio" checked   id="showName" name="showName" value="1" />YES';
    echo '<input type="radio" id="showName" name="showName" value="0" />NO';
    echo '</td>';
    echo '<td height="2" align="right" nowrap="nowrap" colspan="1">Rotate Name</td>';
    echo '<td align="left"><input type="radio"    id="rotateNames" name="rotateNames" value="1" />YES';
    echo '<input type="radio" checked id="rotateNames" name="rotateNames" value="0" />NO';
    echo '</td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td height="2" align="right" nowrap="nowrap" colspan="1">Split in to</td>';
    echo '<td align="left" colspan="3">';
    echo '<select name="chartSplit" id="chartSplit"   >';

    for ($i = 1; $i <= 10; $i++) {
        echo '<option >' . $i . '</option>';
    }

    echo '</select>';
    echo '</td>';
    echo'<tr> ';
    echo '<td height="2" align="right" nowrap="nowrap" colspan="1">Chart Width</td>';
    echo '<td align="left"> <input name="chartWidth" id="chartWidth" value="650" type="text3" size="3"  />';
    echo '</td>';
    echo '<td height="2" align="right" nowrap="nowrap" colspan="1">Chart Height</td>';
    echo '<td align="left"> <input name="chartHeight" id="chartHeight" value="450" type="text3" size="3" />';
    echo '</td>';
    echo '</tr>';
    echo '</table>';
    echo '</fieldset>';
}
?>