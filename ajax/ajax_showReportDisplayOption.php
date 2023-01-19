<?php require_once('../Connections/Config_Connection.php'); ?>
<?php

require_once '../Classes/Class_Report.php';
$objReport = new Report();

if ((isset($_POST['Report']))) {
    $reportName = $_POST['Report'];
    list($reportName, $reportDescription, $Report_Field, $Report_Field_Display_Name, $tableName, $Join_Table, $whereClause, $User_Feed_Parameter) = $objReport->get_Report_Defintion($reportName);

    if ($reportDescription != '') {
    echo'<table>';
    echo '<tr><td colspan="7">';
    echo $reportDescription;
    echo '</td></tr>';
    echo'</table>';
}

    echo '<fieldset id="selectedIDfieldset"><legend>' . $reportName . ' Report Parameter Option</legend>';
    echo'<table>';

    if ($User_Feed_Parameter != '') {
        $userFeedParameter = explode(',', $User_Feed_Parameter);

        echo '<tr>';
        $countParameter = 0;
        foreach ($userFeedParameter as $key => $userFeedParameterValue) {
            $countParameter++;
            $userParameterValue = explode('=', $userFeedParameterValue);

            echo '<td>';
            echo $userParameterValue[1];
            echo '</td>';
            echo '<td>';
            echo '<input type="text" Name="' . $userParameterValue[0] . '" required />';
            echo '</td>';
        }
        echo '</tr>';
    }

    echo '</table>';
    echo '</fieldset>';
}
?>