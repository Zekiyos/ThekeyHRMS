<div id="search_bar" class="top_bar">
    <p>Chart Filter<a class="show_search down">&nbsp;</a></p>
    <?php
  
    $sql = "SHOW COLUMNS FROM $Table_Name";
    
    $result = mysql_query($sql) or die(mysql_error());
    
    $showFrontField = array('ID', 'First Name', 'Middel Name', 'Last Name', 'Department');

    echo '<form method="post" >';
    if (isset($result)) {
         echo '<br/><input type="submit" value="Filter" style="padding-left: 12px; border-left-width: 1px; margin-left: 300px;" />';
         echo '<table>';
         $count=0;
         while ( $row = mysql_fetch_array($result)) {
             $count++;
             $ChartFieldDisplayName = $row['Field'];
         
            //Creat filter field Name in text input format 

            echo '<tr>';
            echo '<td>';
            echo '<label>' . ucwords($ChartFieldDisplayName) . '</label>';
            echo '<input type="hidden" name="FilterField[]"  value="' .$Table_Name.'.'.$ChartFieldDisplayName . '" />';
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

            if ($count != (mysql_num_rows($result))) { //Adding Logical Operator if it is not the Last Field
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
    echo '</form>';
    ?>
</div>