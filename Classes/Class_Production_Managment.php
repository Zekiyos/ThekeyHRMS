<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Class_Production_Managment
 *
 * @author Zekiyos
 */
class Production_Managment {

    //put your code here

    public function createProductionAccount($accountName, $accountDescription, $accountGroup, $accountArea, $departmentList) {
        $sql1 = "SELECT * FROM `production_account` WHERE Account_Name='" . $accountName . "'";
        if (mysql_num_rows(mysql_query($sql1))) {
            return false;
        } else {
            $sql2 = "INSERT INTO production_account (`Account_Name`, `Account_Description`,`Account_Group`, `Account_Area`, `Department`)";
            $sql2.=" Value ('" . $accountName . "','" . $accountDescription . "','" . $accountGroup . "','" . $accountArea . "','" . $departmentList . "')";

            $result = mysql_query($sql2);
        }

        return $result;
    }

    public function getAccountName() {
        $sql1 = "SELECT * FROM `production_account` ";
        $result = mysql_query($sql1);
        while ($row = mysql_fetch_array($result)) {
            echo '<option>' . $row['Account_Name'] . '</option>';
        }
    }

    public function getAccountGroup() {
        $sql1 = "SELECT DISTINCT Account_Group FROM `production_account` ";
        $result = mysql_query($sql1);
        while ($row = mysql_fetch_array($result)) {
            echo '<option>' . $row['Account_Group'] . '</option>';
        }
    }

    public function getUnit() {
        $sql1 = "SELECT * FROM `production_Unit` ";
        $result = mysql_query($sql1);
        while ($row = mysql_fetch_array($result)) {
            echo '<option>' . $row['Unit'] . '</option>';
        }
    }

    public function enterDailyProduction($accountName, $date, $unit, $productionAmount) {
        $sql1 = "SELECT * FROM `Daily_Production` WHERE Account_Name='" . $accountName . "' AND Date='" . $date . "'";
        if (mysql_num_rows(mysql_query($sql1))) {
            return false;
        } else {
            $sql2 = "INSERT INTO Daily_Production (`Account_Name`, `Date`, `Unit`, `Production_Amount`)";
            $sql2.=" Value ('" . $accountName . "','" . $date . "','" . $unit . "','" . $productionAmount . "')";

            $result = mysql_query($sql2);
        }

        return $result;
    }

    public function getTotalWorking($department, $date) {
        


$sql="SELECT SEC_TO_TIME(SUM(TIMESTAMPDIFF(Second,StartPauze,EindPauze))) AS Total_Break_Hour,
SEC_TO_TIME(SUM(TIMESTAMPDIFF(Second,Starttijd,Eindtijd))) AS Total_Working_Hour,
gg.`Omschrijving` AS Department

 FROM identysoft.snapshot s 
                JOIN identysoft.user ON User.userID=S.UserID 
                JOIN identysoft.gebruikersgroep as gg ON gg.gebruikersgroepID=user.gebruikersgroepID
                JOIN identysoft.vrijveldwaarde v ON v.userid=user.userid
WHERE Fiat=1 ";

 $sql .=" and s.Datum='" . $date . "'";
        $sql .= " AND (";
        $sql .=' gg.`Omschrijving` LIKE \'%' . $department . '%\'';
        $sql .= " )
		
		AND Eindtijd IS NOT NULL

                 AND v.vrijveldid='8951c7d4-d6a7-4db2-a201-b29fe37b4787'
				 GROUP BY Department ";

//echo '<hr>'.$sql;
        $result = mysql_query($sql);
        if (mysql_num_rows($result)) {
            $row = mysql_fetch_array($result);
            $totalWorkingHour = $row['Total_Working_Hour'];

            return $totalWorkingHour;
        } else {
            return false;
        }
    }

    public function getNoEmployee($department, $date) {
       
$sql="SELECT COUNT(Waarde) AS No_Employee,Waarde AS ID,`user`.`Voornaam` AS FirstName,
                `user`.Tussenvoegsel AS MiddelName,
                `user`.`Achternaam` AS LastName,
gg.`Omschrijving` AS Department

 FROM identysoft.snapshot s 
                JOIN identysoft.user ON User.userID=S.UserID 
                JOIN identysoft.gebruikersgroep as gg ON gg.gebruikersgroepID=user.gebruikersgroepID
                JOIN identysoft.vrijveldwaarde v ON v.userid=user.userid
WHERE Fiat=1 ";

 $sql .=" and s.Datum='" . $date . "'";
        $sql .= " AND (";
        $sql .=' gg.`Omschrijving` LIKE \'%' . $department . '%\'';
        $sql .= " )

		AND Eindtijd IS NOT NULL
		
                 AND v.vrijveldid='8951c7d4-d6a7-4db2-a201-b29fe37b4787'
				 GROUP BY Department ";

        $result = mysql_query($sql);
        if (mysql_num_rows($result)) {
            $row = mysql_fetch_array($result);
            $totalNoEmployee = $row['No_Employee'];
            return $totalNoEmployee;
        } else {
            return false;
        }
    }

    public function getAccountList($accountGroup) {
        $sql = "SELECT DISTINCT Account_Name FROM `production_account` WHERE Account_Group='" . $accountGroup . "'";
        $arrayAccountName = array();
		
       // echo $sql;
		
        $result = mysql_query($sql);
        if (mysql_num_rows($result)) {
            while ($row = mysql_fetch_array($result)) {

                $accountName = $row['Account_Name'];
                array_push($arrayAccountName, $accountName);
            }
            return $arrayAccountName;
        } else {
            return false;
        }
    }

    public function getAccountDefiniton($accountName) {
        $sql = "SELECT * FROM `production_account` WHERE Account_Name='" . $accountName . "'";

        $result = mysql_query($sql);
        if (mysql_num_rows($result)) {
            $row = mysql_fetch_array($result);

            $accountName = $row['Account_Name'];
            $accountDescription = $row['Account_Description'];
            $accountArea = $row['Account_Area'];
            $departmentList = $row['Department'];

            return array($accountName, $accountDescription, $accountArea, $departmentList);
        } else {
            return false;
        }
    }

    public function getAccountNoEmployee($accountName, $date) {
        list($accountName, $accountDescription, $accountArea, $departmentList) = $this->getAccountDefiniton($accountName);

        $departmentStack = explode(',', $departmentList);

        $accountNoEmployee = 0;
        foreach ($departmentStack as $key => $value) {
            $departmentNoEmployee = $this->getNoEmployee($value, $date);

            $accountNoEmployee+=$departmentNoEmployee;
        }
        return $accountNoEmployee;
    }

    public function getAccountTotalWorkingHour($accountName, $date) {
        list($accountName, $accountDescription, $accountArea, $departmentList) = $this->getAccountDefiniton($accountName);

        $departmentStack = explode(',', $departmentList);

        $accountTotalWorkingHour = 0;
        foreach ($departmentStack as $key => $value) {
            $departmentTotalWorkingHour = $this->getTotalWorking($value, $date);

            $accountTotalWorkingHour+=$departmentTotalWorkingHour;
        }
        return $accountTotalWorkingHour;
    }

    public function getAccountDailyProduction($accountName, $date) {
        $sql = "SELECT * FROM `Daily_Production` WHERE Account_Name='" . $accountName . "' AND Date='" . $date . "'";

        $result = mysql_query($sql);
        if (mysql_num_rows($result)) {
            $row = mysql_fetch_array($result);

            $unit = $row['Unit'];
            $productionAmount = $row['Production_Amount'];

            return array($unit, $productionAmount);
        } else {
            return false;
        }
    }

    public function getAccountProductionPerNoEmployee($accountName, $date) {

        $accountNoEmployee = $this->getAccountNoEmployee($accountName, $date);
        list($unit, $productionAmount) = $this->getAccountDailyProduction($accountName, $date);
        if ($accountNoEmployee != 0)
            $productionAmountPerNoEmployee = $productionAmount / $accountNoEmployee;
        else
            $productionAmountPerNoEmployee = 0;

        return $productionAmountPerNoEmployee . ' ' . $unit;
    }

    public function getAccountAreaPerNoEmployee($accountName, $date) {
        list($accountName, $accountDescription, $accountArea, $departmentList) = $this->getAccountDefiniton($accountName);
        $accountNoEmployee = $this->getAccountNoEmployee($accountName, $date);
        if ($accountNoEmployee != 0)
            $accountAreaPerNoEmployee = $accountArea / $accountNoEmployee;
        else
            $accountAreaPerNoEmployee = 0;

        return $accountAreaPerNoEmployee;
    }

    public function getAccountWorkingHourPerNoEmployee($accountName, $date) {

        $accountTotalWorkingHour = $this->getAccountTotalWorkingHour($accountName, $date);
        $accountNoEmployee = $this->getAccountNoEmployee($accountName, $date);
        if ($accountNoEmployee != 0)
            $accountWorkingHourPerNoEmployee = $accountTotalWorkingHour / $accountNoEmployee;
        else
            $accountWorkingHourPerNoEmployee = 0;


        return $accountWorkingHourPerNoEmployee;
    }

    public function getAccountTotalEmployeeWorkingHour($accountName, $date) {
        $accountTotalWorkingHour = $this->getAccountTotalWorkingHour($accountName, $date);
        $accountNoEmployee = $this->getAccountNoEmployee($accountName, $date);
        if ($accountNoEmployee != 0)
            $accountTotalEmployeeWorkingHour = $accountTotalWorkingHour ;/// $accountNoEmployee;
        else
            $accountTotalEmployeeWorkingHour = 0;

        return $accountTotalEmployeeWorkingHour;
    }

    public function generateAccountProductionPerWorkingDetail($accountName, $date) {
        list($accountName, $accountDescription, $accountArea, $departmentList) = $this->getAccountDefiniton($accountName);
        $accountNoEmployee = $this->getAccountNoEmployee($accountName, $date);
        list($unit, $productionAmount) = $this->getAccountDailyProduction($accountName, $date);
        $productionAmountPerNoEmployee = round($this->getAccountProductionPerNoEmployee($accountName, $date),2);
        $accountAreaPerNoEmployee = round($this->getAccountAreaPerNoEmployee($accountName, $date),2);
        $accountWorkingHourPerNoEmployee = round($this->getAccountWorkingHourPerNoEmployee($accountName, $date),2);
        $accountTotalEmployeeWorkingHour = round($this->getAccountTotalEmployeeWorkingHour($accountName, $date),2);

//        return array($accountName, $accountArea, $accountNoEmployee, $productionAmount, $productionAmountPerNoEmployee
//            , $accountAreaPerNoEmployee, $accountWorkingHourPerNoEmployee, $accountTotalEmployeeWorkingHour);

 $accountProductionAmountPerArea = round($productionAmount/$accountArea,2);
        $accountProductionAmountPerTotalEmployee = round($productionAmount/$accountTotalEmployeeWorkingHour,2);
      



        return array('Account Name' => $accountName,
            'Account Area Per Sq. Meter' => $accountArea,
            'Account No Employee' => $accountNoEmployee,
            'Production Amount' => $productionAmount,
            'Production Amount Per No Employee' => $productionAmountPerNoEmployee,
            'Account Area Per Sq. Meter Per No Employee' => $accountAreaPerNoEmployee,
            'Account Working Hour Per No Employee' => $accountWorkingHourPerNoEmployee,
            'Account Total Employee Working Hour' => $accountTotalEmployeeWorkingHour,
			'Account Production Amount Per Area Per Sq. Meter'  => $accountWorkingHourPerNoEmployee,
            'Account Total Employee Working Hour' => $accountTotalEmployeeWorkingHour);
    }

    public function generateReportArray($arrayrow) {
        if (isset($arrayrow)) {
            $this->generate_table($arrayrow);
        }
    }

    public function reorderArrayData($arrayData) {


        $i = 0;
        foreach ($arrayData as $arrayDatakey => $arrayDataValue) {
            $j = 0;
            if (is_array($arrayDataValue)) {
                foreach ($arrayDataValue as $key => $value) {

                    if ($key == 'Account Name') {
                        $arrCatNames[$i] = $value;
                    } else {
                        if ($arrayDatakey == 0) {
                            $arrData[$j][0] = $key;
                            $arrData[$j][1] = ""; // Dataset Parameters
                            $j+=1;
                        }
                    }
                }
            }

            $i+=1;
        }


        $j = 2;
        foreach ($arrayData as $arrayDatakey => $arrayDataValue) {
            if (is_array($arrayDataValue)) {
                foreach ($arrayDataValue as $key => $value) {
                    if ($key != 'Account Name') {
                        for ($i = 0; $i <= count($arrayData); $i++) {

                            if ($arrData[$i][0] == $key)
                                $arrData[$i][$j] = $value;
                        }
                    }
                }
            }
            $j+=1;
        }

        return array($arrData, $arrCatNames);
    }

    public function generate_table($arrayData) {

        echo '<table class="ThekeyHRMS_rpt" id="ThekeyHRMS_rpt" >';

        echo '<thead>';
        echo '<tr>';
        echo '<th> S.No </th>';
        foreach ($arrayData as $arrayDatakey => $arrayDataValue) {

            if (is_array($arrayDataValue)) {
                foreach ($arrayDataValue as $key => $value) {
                    if ($arrayDatakey == 0)
                        echo '<th>' . $key . '</th>';
                }
            }else
                echo '<th>' . $arrayDatakey . '</th>';
        }
        echo '</tr>';
        echo '</thead>';

        if (isset($_GET['pageNo'])) {
            if (isset($_GET['NO_Record'])) {
                $startRow = $_GET['pageNo'] * $_GET['NO_Record'];
            }else
                $startRow = $_GET['pageNo'] * 10;

            if ($startRow >= $_GET['totalRows']) //if start row greater than total rows set to zero
                $startRow = 0;


            $serialNo = $startRow + 1;
        } else {
            $serialNo = 1;
        }

        echo '<tbody>';
        echo '<tr>';
        foreach ($arrayData as $arrayDatakey => $arrayDataValue) {



            if (is_array($arrayDataValue)) {
                echo '<tr>';

                echo '<td>';
                echo $serialNo++;
                echo'</td>';

                foreach ($arrayDataValue as $key => $value) {

                    echo '<td>' . $value . '</td>';
                }
                echo '</tr>';
            } else {
                echo '<td>' . $arrayDataValue . '</td>';
            }
        }
        echo '</tr>';

        echo '</tbody>';
        echo '</table>';
    }

}

?>
