<?php

class Terminated_Employee_Rollback {

    public function get_terminated_employee_list() {
        /* Selecting only those in the same month and half year worker employee */
        $queryTE = "SELECT `ID`,`FirstName`,`MiddelName`,`LastName`,`Department`,`Terminated_Date` FROM ThekeyHRMSDB.`terminated_employee` ORDER By `Terminated_Date`,`Department`,`ID` ASC";

        //mysql_select_db($database_HRMS, $HRMS);			
        $resultTE = mysql_query($queryTE);


        echo "<table  cellpadding=\"0\" align=\"center\" border=\"1\" bordercolor=\"#FF6600\"> ";
        echo "<tr>";
        echo "<td>ID</td>";
        echo "<td>First Name</td>";
        echo "<td>Middel Name</td>";
        echo "<td>Last Name</td>";
        echo "<td>Department</td>";
        echo "<td>Terminated Date</>";
        echo "</tr>";
        while ($rowTE = mysql_fetch_assoc($resultTE, MYSQL_ASSOC)) {

            echo "<tr>";
            echo "<td><input type=\"checkbox\" name=\"CHK[]\" value=\"'" . $rowTE['ID'] . "'\">
	  	   {$rowTE['ID']}</td>";

            echo " <td> {$rowTE['FirstName']}</td>";

            echo "<td>{$rowTE['MiddelName']}</td>";

            echo "<td>{$rowTE['LastName']} </td>";

            echo "<td>{$rowTE['Department']}</td>";

            echo "<td>{$rowTE['Terminated_Date']}</td> ";

            echo "</tr>";
        }



        echo "</table>";
    }

    public function get_selected_terminated_employee($a) {

        echo "<table  cellpadding=\"0\" align=\"center\" border=\"1\" bordercolor=\"#FF6600\"> ";
        echo "<tr>";
        echo "<td>ID</td>";
        echo "<td>First Name</td>";
        echo "<td>Middel Name</td>";
        echo "<td>Last Name</td>";
        echo "<td>Department</td>";
        echo "<td>Terminated Date</>";
        echo "</tr>";

        $N = count($a);

        for ($i = 0; $i < $N; $i++) {
            $IDNumber = str_replace("'", "", $a[$i]);

            $_SESSION['IDNo'].="," . $IDNumber; //Copying the selected ID for updating use



            /* Selecting only those in the same month and half year worker employee */
            $querySE = "SELECT `ID`,`FirstName`,`MiddelName`,`LastName`,`Department`,`Terminated_Date` FROM ThekeyHRMSDB.`terminated_employee` WHERE ID='" . $IDNumber . "' ORDER By `Terminated_Date`,`Department`,`ID` ASC";

            //mysql_select_db($database_HRMS, $HRMS);			
            $resultSE = mysql_query($querySE);



            while ($rowSE = mysql_fetch_assoc($resultSE, MYSQL_ASSOC)) {

                echo "<tr>";
                echo "<td>{$rowSE['ID']}</td>";

                echo " <td> {$rowSE['FirstName']}</td>";

                echo "<td>{$rowSE['MiddelName']}</td>";

                echo "<td>{$rowSE['LastName']} </td>";

                echo "<td>{$rowSE['Department']}</td>";

                echo "<td>{$rowSE['Terminated_Date']}</td> ";

                echo "</tr>";
            }
        }
        echo "</table>";
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