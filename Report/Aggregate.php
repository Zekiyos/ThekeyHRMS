<div id="aggregate" class="top_bar">
    <p>Aggregate<a class="show_search down">&nbsp;</a></p>
    <?php
    $reportName = $_GET['report'];


    $sqlrpt = "SELECT * FROM  thekey_hrms_report_definition WHERE Report_Name='" . $reportName . "'";

    $resultrpt = mysql_query($sqlrpt) or die(mysql_error());

    $rowrpt = mysql_fetch_array($resultrpt);

    $Report_Name = $rowrpt['Report_Name'];

    $Report_Description = $rowrpt['Report_Description'];

    $Report_Field = $rowrpt['Report_Field'];

    $Report_Field_Display_Name = $rowrpt['Report_Field_Display_Name'];

    $Table_Name = $rowrpt['Table_Name'];

    $Join_Table = $rowrpt['Join_Table'];

    //  list($reportName, $reportDescription, $Report_Field, $Report_Field_Display_Name, $tableName, $Join_Table) = $obj_Report->get_Report_Defintion($reportName);

    $reportField = explode(',', $Report_Field);

    $reportFieldDisplayName = explode(',', $Report_Field_Display_Name);

    $showFrontField = array('ID', 'First Name', 'Middel Name', 'Last Name', 'Department');

    if (isset($reportField)) {

        echo '<table>';

        echo '<tr>';
        echo '<td>';

        echo '<label>COUNT</label>';

        echo '</td>';


        echo '<td>';

        echo '<select multiple="multiple" size="3" name="CountFieldName[]" >';

        foreach ($reportFieldDisplayName as $fieldNamekey => $fieldNameValue) {

            echo '<option value="' . $reportField[$fieldNamekey] . '" >' . ucwords($fieldNameValue) . '</option>';
        }
        echo '</select>';
        echo '</td>';

        echo '<td>';

        echo '<label>COUNT UNIQUE</label>';

        echo '</td>';

        echo '<td>';

        echo '<select multiple="multiple" name="CountDistinctFieldName[]" size="3" >';

        foreach ($reportFieldDisplayName as $fieldNamekey => $fieldNameValue) {

            echo '<option value="' . $reportField[$fieldNamekey] . '" >' . ucwords($fieldNameValue) . '</option>';
        }
        echo '</select>';
        echo '</td>';


        echo '<tr>';
        echo '<td>';

        echo '<label>SUM</label>';

        echo '</td>';

        echo '<td>';

        echo '<select multiple="multiple" size="3" name="SumFieldName[]" >';

        foreach ($reportFieldDisplayName as $fieldNamekey => $fieldNameValue) {

            echo '<option value="' . $reportField[$fieldNamekey] . '" >' . ucwords($fieldNameValue) . '</option>';
        }
        echo '</select>';
        echo '</td>';

        echo '<td>';
        echo '<label>Group By</label>';
        echo '</td>';

        echo '<td>';
        echo '<select multiple="multiple" name="GroupBy[]" >';

        foreach ($reportFieldDisplayName as $fieldNamekey => $fieldNameValue) {

            echo '<option value="' . $reportField[$fieldNamekey] . '" >' . ucwords($fieldNameValue) . '</option>';
        }
        echo '</select>';
        echo '</td>';

        echo '</tr>';

        echo '</table>';
    }



    echo '<input name="Aggregate" type="submit" value="Generate Report" style="padding-left: 12px; border-left-width: 1px; margin-left: 200px;" />';


    echo '</form>';
    ?>
</div>