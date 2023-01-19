<div id="search_bar" class="top_bar">
    <p>Filter<a class="show_search down">&nbsp;</a></p>
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

         echo '<br/><input type="submit" value="Filter" style="padding-left: 12px; border-left-width: 1px; margin-left: 300px;" />';
        
         echo '<table>';
        foreach ($reportFieldDisplayName as $fieldNamekey => $fieldNameValue) {

            //Creat filter field Name in text input format 

            echo '<tr>';
            echo '<td>';
            echo '<label>' . ucwords($fieldNameValue) . '</label>';
            echo '<input type="hidden" name="FilterField[]"  value="' . $reportField[$fieldNamekey] . '" />';
            echo '</td>';

            echo '<td>';
            echo '<select class="FilterOperator" name="FilterOperator[]">';

            echo '<option value="LIKE">CONTAIN</option>';
            echo '<option value="=">=</option>';
            echo '<option value="!=">!=</option>';
            echo '<option value=">">></option>';
            echo '<option value=">=">>=</option>';
            echo '<option value="<"><</option>';
            echo '<option value="<="><=</option>';
             echo '<option value="BETWEEN" >BETWEEN</option>';
            echo '</select>';
            echo '</td>';

            echo '<td>';
            echo '<input type="text" class="FilterValue" name="FilterValue[]" />';
            echo '</td>';


            if ($fieldNamekey != (count($reportFieldDisplayName) - 1)) { //Adding Logical Operator if it is not the Last Field
                
                echo '<td>';
                echo '<select name="FilterLogicalOperator[]">';
                echo '<option value="AND">AND</option>';
                echo '<option value="OR">OR</option>';
                echo '</select>';
                echo '</td>';
            }

            echo '</tr>';
        }

        echo '</table>';
    }

    echo '<input type="submit" value="Filter" style="padding-left: 12px; border-left-width: 1px; margin-left: 300px;" />';
   
     require_once $base_path . 'Report/Display_Field.php';
    ?>
</div>