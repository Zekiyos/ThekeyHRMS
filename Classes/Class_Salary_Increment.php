<?php

class Salary_Increment {

    public function get_employee_list() {

        /*         * **************AQ ROSES Salary Increment Query******************** */
        $querySI = "SELECT ID,FirstName,MiddelName,LastName,employee_personal_record.Department,Position,date_Employement,
(datediff(curdate(),date_Employement)/365) AS `No_Year`,`Salary` AS `Initial_Salary`

 FROM ThekeyHRMSDB.employee_personal_record INNER JOIN wage_allocation ON
 (wage_allocation.Department=employee_personal_record.Department and

(datediff(curdate(),employee_personal_record.date_Employement)/365) >= wage_allocation.`From_No_Year`

 and
(datediff(curdate(),employee_personal_record.date_Employement)/365) < wage_allocation.`To_No_Year`
and
employee_personal_record.`Salary` = wage_allocation.`Initial_Salary` )
 ORDER BY ID ASC";

        $resultSI = mysql_query($querySI);


        $stack = array();
        if ($resultSI) {
            while ($rowSI = mysql_fetch_array($resultSI, MYSQL_ASSOC)) {

                array_push($stack, $rowSI['ID']);
                //print_r($stack);
            }
        }
        return $stack;
    }

    public function get_no_year($IDNumber) {
        $querySI = "SELECT Date_Employement,datediff(curdate(),date_Employement) AS No_Days FROM ThekeyHRMSDB.employee_personal_record where ID='" . $IDNumber . "'";
        $resultSI = mysql_query($querySI);
        $rowSI = mysql_fetch_array($resultSI);

        //echo $rowSI['Date_Employement']."<br/>";
        //echo "No of Days:".$rowSI['No_Days']."<br/>";
        //echo "Month:".($rowSI['No_Days']/30)."<br/>";
        //return $rowSI['No_Days']/365;
        if ((($rowSI['No_Days'] / 365) >= 0.5) AND (($rowSI['No_Days'] / 365) < 0.6)) {
            return 0.5;
        } else {
            // floor for herburg
            //return floor($rowSI['No_Days']/365);
            return round($rowSI['No_Days'] / 365);
        }
    }

    public function get_Salary($IDNumber) {
        $querySI = "SELECT Salary FROM ThekeyHRMSDB.employee_personal_record where ID='" . $IDNumber . "'";
        $resultSI = mysql_query($querySI);
        $rowSI = mysql_fetch_array($resultSI);

        return $rowSI['Salary'];
    }

    public function get_Salary_Increment($inital, $NoYear, $Department) {
        $querySI = "SELECT Salary_Increment FROM ThekeyHRMSDB.wage_allocation where Department='" . $Department . "' and  Initial_Salary=$inital and $NoYear >= From_no_year and  $NoYear < To_no_year ";
        $resultSI = mysql_query($querySI);
        $rowSI = mysql_fetch_array($resultSI);

        return $rowSI['Salary_Increment'];
    }

    public function get_employee_Detail($IDNumber) {
        $querySI = "SELECT ID,FirstName,MiddelName,LastName,Department,Position,date_Employement FROM ThekeyHRMSDB.employee_personal_record
where ID='" . $IDNumber . "' ORDER BY ID ASC";

        $resultSI = mysql_query($querySI);
        $rowSI = mysql_fetch_array($resultSI);

        return array($rowSI['FirstName'], $rowSI['MiddelName'], $rowSI['LastName'], $rowSI['Department'], $rowSI['Position'], $rowSI['date_Employement']);
    }

    public function Calcualte_Increment() {
        $stack = $this->get_employee_list();

        echo "<table class=\"rgrid\"  cellpadding=\"0\"> ";
        echo "<th>ID</th>
			<th>Full Name</th>
			<th>Department</th>
			<th>Position</th>
			<th> Salaray</th>
			<th>Date of Employement</th>
			<th>No of Year</th>
			<th>After Increment</th>";
        foreach ($stack as $value) {
            //echo $value . "<br />";
            $IDNumber = $value;
            list($FirstName, $MiddelName, $LastName, $Department, $Position, $date_Employement) = $this->get_employee_Detail($IDNumber);
            $NoYear = $this->get_no_year($IDNumber);
            $salary = $this->get_Salary($IDNumber);
            $Salary_After_Increment = $this->get_Salary_Increment($salary, $NoYear, $Department);

            echo "<tr> <td>";
            echo "<input type=\"checkbox\" class=\"check_this_all\"  name=\"CHK[]\" value=\"'" . $IDNumber . "'\">";
            echo $IDNumber;
            echo "</td>";

            echo "<td>";
            echo "$FirstName $MiddelName $LastName";
            echo "</td>";

            echo "<td>";
            echo "$Department";
            echo "</td>";

            echo "<td>";
            echo "$Position";
            echo "</td>";

            echo "<td>";
            echo $salary;
            echo "</td>";

            echo "<td>";
            echo "$date_Employement";
            echo "</td>";

            echo "<td>";
            echo $NoYear;
            echo "</td>";

            echo "<td>";
            echo $Salary_After_Increment;
            echo "</td></tr>";
        }
        echo "</table>";
    }

    public function Update_Salary($IDNumber) {
        $NoYear = $this->get_no_year($IDNumber);
        $salary = $this->get_Salary($IDNumber);
        $Salary_After_Increment = $this->get_Salary_Increment($salary, $NoYear);

        $sqlUPDT1 = "UPDATE ThekeyHRMSDB.`employee_personal_record` SET
	               `Salary`='" . $Salary_After_Increment . "',ModifiedBy='" . $_SESSION['MM_Username'] . "' WHERE `ID`='" . $IDNumber . "'";
        $sqlUPDT2 = "UPDATE ThekeyHRMSDB.`total_deduction` SET
	               `Basic Salary`='" . $Salary_After_Increment . "',ModifiedBy='" . $_SESSION['MM_Username'] . "' WHERE `ID`='" . $IDNumber . "'";

        mysql_query($sqlUPDT1) or die(mysql_error());
        mysql_query($sqlUPDT2) or die(mysql_error());
    }

}

?>