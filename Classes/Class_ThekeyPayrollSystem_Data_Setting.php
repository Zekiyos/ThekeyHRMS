<?php

class ThekeyPayrollSystem_Data_Setting {

    public function get_TotalDeduction_employee_list($Department) {
        /* Selecting only those in the same month and half year worker employee */
        $queryTE = "SELECT `ID`,`FirstName`,`MiddelName`,`LastName`,`Department` FROM ThekeyHRMSDB.`total_deduction` where Department='" . $Department . "' ORDER By `Department`,`ID` ASC";

        //mysql_select_db($database_HRMS, $HRMS);			
        $resultTE = mysql_query($queryTE);


        echo "<table class=\"rgrid\"  cellpadding=\"0\"  bordercolor=\"#FF6600\"> ";
        echo '<thead>';
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>First Name</th>";
        echo "<th>Middel Name</th>";
        echo "<th>Last Name</th>";
        echo "<th>Department</th>";
        echo "</tr>";
        echo '</thead>';
        echo '</tbody>';
        while ($rowTE = mysql_fetch_assoc($resultTE, MYSQL_ASSOC)) {

            echo "<tr>";
            echo "<td><input type=\"checkbox\" class=\"check_this_all\" name=\"CHK[]\" value=\"'" . $rowTE['ID'] . "'\">
	  	   {$rowTE['ID']}</td>";

            echo " <td> {$rowTE['FirstName']}</td>";

            echo "<td>{$rowTE['MiddelName']}</td>";

            echo "<td>{$rowTE['LastName']} </td>";

            echo "<td>{$rowTE['Department']}</td>";

            echo "</tr>";
        }
        echo '</tbody>';


        echo "</table>";
    }

    public function get_week_employee_list($Department, $week) {
        /* Selecting only those in the same month and half year worker employee */
        $queryTE = "SELECT `ID`,`FirstName`,`MiddelName`,`LastName`,`Department` FROM ThekeyHRMSDB.`" . $week . "` where Department='" . $Department . "' ORDER By `Department`,`ID` ASC";

        //mysql_select_db($database_HRMS, $HRMS);			
        $resultTE = mysql_query($queryTE);


        echo "<table  cellpadding=\"0\" align=\"center\" border=\"1\" bordercolor=\"#FF6600\"> ";
        echo "<tr>";
        echo "<td>ID</td>";
        echo "<td>First Name</td>";
        echo "<td>Middel Name</td>";
        echo "<td>Last Name</td>";
        echo "<td>Department</td>";
        echo "</tr>";
        while ($rowTE = mysql_fetch_assoc($resultTE, MYSQL_ASSOC)) {

            echo "<tr>";
            echo "<td><input type=\"checkbox\" name=\"CHK[]\" value=\"'" . $rowTE['ID'] . "'\">
	  	   {$rowTE['ID']}</td>";

            echo " <td> {$rowTE['FirstName']}</td>";

            echo "<td>{$rowTE['MiddelName']}</td>";

            echo "<td>{$rowTE['LastName']} </td>";

            echo "<td>{$rowTE['Department']}</td>";

            echo "</tr>";
        }



        echo "</table>";
    }

    public function get_TotalDeduction_Columns() {
        /* Selecting only those in the same month and half year worker employee */
        $queryTE = "SHOW COLUMNS FROM ThekeyHRMSDB.`total_deduction` where `Field`<>'Auto_ID' and `Field`<>'ID' and `Field`<>'FirstName' and `Field`<>'MiddelName' and `Field`<>'LastName' and `Field`<> 'Basic Salary' and `Field`<>'Department' and `Field`<>'Position'";

        //mysql_select_db($database_HRMS, $HRMS);			
        $resultTE = mysql_query($queryTE);


        echo "<select id=\"Field\" name=\"Field\"  >";
        echo "<option selected=\"selected\">Please Choose Payroll Data Field</option>";



        while ($rowTE = mysql_fetch_assoc($resultTE, MYSQL_ASSOC)) {


            //echo "<td><input type=\"checkbox\" name=\"CHK[]\" value=\"'".$rowTE['ID']."'\">  {$rowTE['ID']}</td>";


            echo "<option value=\"{$rowTE['Field']}\">{$rowTE['Field']}</option>";
        }



        echo "</select>";
    }

    public function get_week_Columns($week) {
        /* Selecting only those in the same month and half year worker employee */
        $queryTE = "SHOW COLUMNS FROM ThekeyHRMSDB.`" . $week . "` where `Field`<>'Auto_ID' and `Field`<>'ID' and `Field`<>'FirstName' and `Field`<>'MiddelName' and `Field`<>'LastName' and `Field`<> 'Basic Salary' and `Field`<>'Department' and `Field`<>'Position'";

        //mysql_select_db($database_HRMS, $HRMS);			
        $resultTE = mysql_query($queryTE);


        echo "<select id=\"Field\" name=\"Field\"  >";
        echo "<option selected=\"selected\">Please Choose Payroll Data Field</option>";



        while ($rowTE = mysql_fetch_assoc($resultTE, MYSQL_ASSOC)) {


            //echo "<td><input type=\"checkbox\" name=\"CHK[]\" value=\"'".$rowTE['ID']."'\">  {$rowTE['ID']}</td>";


            echo "<option value=\"{$rowTE['Field']}\">{$rowTE['Field']}</option>";
        }



        echo "</select>";
    }

    public function get_selected_employee($a) {

        echo "<table  cellpadding=\"0\" align=\"center\" border=\"1\" bordercolor=\"#FF6600\"> ";
        echo "<tr>";
        echo "<td>ID</td>";
        echo "<td>First Name</td>";
        echo "<td>Middel Name</td>";
        echo "<td>Last Name</td>";
        echo "<td>Department</td>";
        echo "</tr>";

        $N = count($a);

        for ($i = 0; $i < $N; $i++) {
            $IDNumber = str_replace("'", "", $a[$i]);

            $_SESSION['IDNo'].="," . $IDNumber; //Copying the selected ID for updating use



            /* Selecting only those in the same month and half year worker employee */
            $querySE = "SELECT `ID`,`FirstName`,`MiddelName`,`LastName`,`Department` FROM ThekeyHRMSDB.`total_deduction` WHERE ID='" . $IDNumber . "' ORDER By `Department`,`ID` ASC";

            //mysql_select_db($database_HRMS, $HRMS);			
            $resultSE = mysql_query($querySE);



            while ($rowSE = mysql_fetch_assoc($resultSE, MYSQL_ASSOC)) {

                echo "<tr>";
                echo "<td>{$rowSE['ID']}</td>";

                echo " <td> {$rowSE['FirstName']}</td>";

                echo "<td>{$rowSE['MiddelName']}</td>";

                echo "<td>{$rowSE['LastName']} </td>";

                echo "<td>{$rowSE['Department']}</td>";

                echo "</tr>";
            }
        }
        echo "</table>";
    }

    public function get_selected_employee_week($a, $week) {

        echo "<table  cellpadding=\"0\" align=\"center\" border=\"1\" bordercolor=\"#FF6600\"> ";
        echo "<tr>";
        echo "<td>ID</td>";
        echo "<td>First Name</td>";
        echo "<td>Middel Name</td>";
        echo "<td>Last Name</td>";
        echo "<td>Department</td>";
        echo "</tr>";

        $N = count($a);

        for ($i = 0; $i < $N; $i++) {
            $IDNumber = str_replace("'", "", $a[$i]);

            $_SESSION['IDNo'].="," . $IDNumber; //Copying the selected ID for updating use



            /* Selecting only those in the same month and half year worker employee */
            $querySE = "SELECT `ID`,`FirstName`,`MiddelName`,`LastName`,`Department` FROM ThekeyHRMSDB.`" . $week . "` WHERE ID='" . $IDNumber . "' ORDER By `Department`,`ID` ASC";

            //mysql_select_db($database_HRMS, $HRMS);			
            $resultSE = mysql_query($querySE);



            while ($rowSE = mysql_fetch_assoc($resultSE, MYSQL_ASSOC)) {

                echo "<tr>";
                echo "<td>{$rowSE['ID']}</td>";

                echo " <td> {$rowSE['FirstName']}</td>";

                echo "<td>{$rowSE['MiddelName']}</td>";

                echo "<td>{$rowSE['LastName']} </td>";

                echo "<td>{$rowSE['Department']}</td>";

                echo "</tr>";
            }
        }
        echo "</table>";
    }

    public function UpdatePayrollData($tableName, $Field, $FieldData, $IDNumber) {

        $sqlUPDT = "UPDATE ThekeyHRMSDB.`" . $tableName . "` SET 
	               `" . $Field . "`='" . $FieldData . "'";
        if ($tableName == "total_deduction")
            $sqlUPDT = $sqlUPDT . ",ModifiedBy='" . $_SESSION['MM_Username'] . "' WHERE `ID`='" . $IDNumber . "'";
        else
            $sqlUPDT = $sqlUPDT . " WHERE `ID`='" . $IDNumber . "'";

        mysql_query($sqlUPDT) or die(mysql_error());

        return true;
    }

    /*
     * Updates the database with the values sent
     * Required: table (the name of the table to be updated
     *           rows (the rows/values in a key/value array
     *           where (the row/condition in an array (row,condition) )
     */

    public function update($table, $rows, $where) {

        // Parse the where values
        // even values (including 0) contain the where rows
        // odd values contain the clauses for the row
        for ($i = 0; $i < count($where); $i++) {
            if ($i % 2 != 0) {
                if (is_string($where[$i])) {
                    if (($i + 1) != null)
                        $where[$i] = '"' . $where[$i] . '" AND ';
                    else
                        $where[$i] = '"' . $where[$i] . '"';
                }
            }
        }
        $where = implode('', $where);


        $update = 'UPDATE ' . $table . ' SET ';
        $keys = array_keys($rows);
        for ($i = 0; $i < count($rows); $i++) {
            if (is_string($rows[$keys[$i]])) {
                $update .= $keys[$i] . '="' . $rows[$keys[$i]] . '"';
            } else {
                $update .= $keys[$i] . '=' . $rows[$keys[$i]];
            }

            // Parse to add commas
            if ($i != count($rows) - 1) {
                $update .= ',';
            }
        }
        $update .= ' WHERE ' . $where;
        $query = @mysql_query($update);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function Rollback($IDNumber, $sourceTable, $desinationTable) {
        $queryRB = "INSERT INTO ThekeyHRMSDB." . $desinationTable . " () SELECT  * FROM " . $sourceTable . " WHERE ID = '" . $IDNumber . "'";
        mysql_query($queryRB);
    }

    public function Clear_Rollbacked($IDNumber, $Tablename) {

        $queryCR = "DELETE FROM " . $Tablename . " WHERE ID = '" . $IDNumber . "'";
        mysql_query($queryCR);
    }

    public function get_terminated_employee($db, $ID) {
        /* Selecting Terminated employee */
        $queryTE = "SELECT `ID`,`FirstName`,`MiddelName`,`LastName`,`Department`,`Terminated_Date` 
	 FROM $db.`terminated_employee` 
	 Where ID='" . $ID . "'";

        $resultTE = mysql_query($queryTE);

        $rowTE = mysql_fetch_assoc($resultTE, MYSQL_ASSOC);

        $ID = $rowTE['ID'];
        $FirstName = $rowTE['FirstName'];

        $MiddelName = $rowTE['MiddelName'];

        $LastName = $rowTE['LastName'];

        $Department = $rowTE['Department'];


        return array($ID, $FirstName, $MiddelName, $LastName, $Department);
    }

    public function insert_week_attendance($db, $table, $ID) {
        list($ID, $FirstName, $MiddelName, $LastName, $Department) = $this->get_terminated_employee($db, $ID);

        $queryINS = "INSERT INTO `" . $db . "`.`" . $table . "` (`Auto_ID`, `ID`, `FirstName`, `MiddelName`, `LastName`, `Department`, `No_Absent`, `No_Normal1`, `No_Normal2`, `No_Sunday`, `No_Holyday`) VALUES (NULL, '" . $ID . "', '" . $FirstName . "', '" . $MiddelName . "', '" . $LastName . "', '" . $Department . "', '0.00', '0.00', '0.00', '0.00', '0.00')";

        mysql_query($queryINS);
    }

}

//clas clossing brace
?>