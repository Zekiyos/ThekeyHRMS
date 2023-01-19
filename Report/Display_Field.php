<div id="Display_bar" class="Display_bar">
    <p align="center" style="margin-top: 0px; font-weight: bold;">Display Field<a class="show_search down">&nbsp;</a></p>
    <div id="FieldList" class="FieldList">
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

            echo '<input type="submit" value="Display" style="padding-left: 12px; border-left-width: 1px; margin-left: 300px;" />';

            echo '<table>';
            echo '<tr>';
            foreach ($reportFieldDisplayName as $fieldNamekey => $fieldNameValue) {

                if (is_int($fieldNamekey / 4)) {
                    echo '</tr><tr>';
                }

                echo '<td>';
                $fieldNameValue=trim($fieldNameValue);
                if (($fieldNameValue == 'ID')
                        ||($fieldNameValue== 'First Name')
                        || ($fieldNameValue == 'Middel Name')
                        || ($fieldNameValue == 'Last Name')
                        || ($fieldNameValue == 'Department')) {
                    echo '<input type="Checkbox" name="DisplayFieldName[]" value="' . $reportField[$fieldNamekey] . '" CHECKED >' . $fieldNameValue . '<br/>';
                } else {
                    echo '<input type="Checkbox" name="DisplayFieldName[]" value="' . $reportField[$fieldNamekey] . '"  >' . $fieldNameValue . '<br/>';
                }
                echo '</td>';
            }
            echo '</tr>';
            echo '</table>';
        }

        echo '<input type="submit" value="Display" style="padding-left: 12px; border-left-width: 1px; margin-left: 300px;" />';
        ?>
    </div>
</div>