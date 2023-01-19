<?php

class Attendance_System extends db_config {

    public function get_employee_list($Department) {

        /* Selecting only those in the same month and half year worker employee */

        $queryOT = "SELECT ID,FirstName,MiddelName,LastName,Department,Position,date_Employement FROM employee_personal_record 
 where Department='" . $Department . "' ORDER BY Department,ID ASC";

        $resultOT = mysql_query($queryOT);

        $stack = array();

        while ($rowOT = mysql_fetch_array($resultOT, MYSQL_ASSOC)) {

            array_push($stack, $rowOT['ID']);
            //print_r($stack);
        }

        return $stack;
    }

    public function get_employee_Detail($IDNumber) {

        $query = "SELECT ID,FirstName,MiddelName,LastName,Department,Position,date_Employement FROM employee_personal_record 
where ID='" . $IDNumber . "'  
    UNION ALL
   SELECT ID,FirstName,MiddelName,LastName,Department,Position,date_Employement FROM terminated_employee_personal_record 
where ID='" . $IDNumber . "'";

        $result = mysql_query($query);
        $row = mysql_fetch_array($result);

        return array($row['FirstName'], $row['MiddelName'], $row['LastName'], $row['Department']);
    }

    public function get_employee_Detail_DE($IDNumber) {
        $queryOT = "SELECT ID,FirstName,MiddelName,LastName,Department,Position,date_Employement FROM employee_personal_record 
where ID='" . $IDNumber . "'  
    UNION ALL
    SELECT ID,FirstName,MiddelName,LastName,Department,Position,date_Employement FROM terminated_employee_personal_record 
where ID='" . $IDNumber . "' ";

        $resultOT = mysql_query($queryOT);
        $rowOT = mysql_fetch_array($resultOT);

        return $rowOT['date_Employement'];
    }

    public function get_employee_offday($IDNumber) {

        if (mysql_num_rows(mysql_query("SELECT ID,FirstName,MiddelName,LastName,Department FROM employee_offDay 
where ID='" . $IDNumber . "'  ORDER BY ID ASC"))) {
            $queryOT = "SELECT ID,FirstName,MiddelName,LastName,Department FROM employee_offDay 
where ID='" . $IDNumber . "'  ORDER BY ID ASC";

            $resultOT = mysql_query($queryOT);
            $rowOT = mysql_fetch_array($resultOT);

            return array($rowOT['FirstName'], $rowOT['MiddelName'], $rowOT['LastName'], $rowOT['Department']);
        }
        return false;
    }

    public function get_department_list() {
        /* Selecting only those in the same month and half year worker employee */
        $queryOT = "SELECT Department FROM department ORDER BY Department ASC";

        $resultOT = mysql_query($queryOT);

        echo "<select id=\"Department\">";
        while ($rowOT = mysql_fetch_array($resultOT, MYSQL_ASSOC)) {

            echo "<option>{$rowOT['Department']}</option>";
        }

        echo "</select>";
    }

    public function get_full_department_list($table, $rows = '*', $where = null, $order = null) {
        /*         * ***
          $q = 'SELECT ' . $rows . ' FROM ' . $table;
          if ($where != null)
          $q .= ' WHERE ' . $where;
          if ($order != null)
          $q .= ' ORDER BY ' . $order;
         * ***************** */
        $q = "SELECT Department FROM department  ORDER BY Department ASC";

        $resultD = mysql_query($q);

        $StackDepartment = array();
        while ($rowD = mysql_fetch_array($resultD, MYSQL_ASSOC)) {

            array_push($StackDepartment, $rowD['Department']);
            //print_r($stack);
        }

        return $StackDepartment;
    }

    public function OT_Setting_List($Department) {
        $stack = $this->get_employee_list($Department);
        echo "<table align=\"center\" nowrap=\"nowrap\" border=\"1\" bordercolor=\"#FFFFFF\">";
        echo "<th align=\"left\" nowrap=\"nowrap\" >ID</th>
			     <th align=\"center\" nowrap=\"nowrap\">Full Name</th>
			     <th align=\"center\" nowrap=\"nowrap\">Department</th>";

        echo "<th align=\"center\" nowrap=\"nowrap\"  >
			<input type=\"checkbox\" id=\"CHKALL_DayOT\" name=\"CheckAll_DayOT\" onclick=\"checkAll(document.SelectedID['CHK_DayOT[]'])\" />DAY OT</th>";
        echo "<th align=\"center\" nowrap=\"nowrap\">
				 Day OT Max Hour</th>";

        echo "<th align=\"center\" nowrap=\"nowrap\">
				 <input type=\"checkbox\" id=\"CHKALL_NightOT\" name=\"CheckAll_NightOT\" onclick=\"checkAll(document.SelectedID['CHK_NightOT[]'])\" />Night OT</th>";
        /*
          echo "<th align=\"center\">
          <input type=\"checkbox\" id=\"CHKALL_SundayOT\" name=\"CheckAll_SundayOT\" onclick=\"checkAll(document.SelectedID['CHK_SundayOT[]'])\" />Sunday OT</th>
          <th align=\"center\">
          <input type=\"checkbox\" id=\"CHKALL_HolydayOT\" name=\"CheckAll_HolydayOT\" onclick=\"checkAll(document.SelectedID['CHK_HolydayOT[]'])\" />Holyday OT</th>
         */


        echo "<th align=\"center\" nowrap=\"nowrap\">
				 Night OT Max Hour</th>";

        echo "<th align=\"center\" nowrap=\"nowrap\">
				 Day OT Start Hour</th>
				 
				  <th align=\"center\" nowrap=\"nowrap\">
				 Nigth OT Start Hour</th>
				 
				 <th align=\"center\" nowrap=\"nowrap\">
				 Nigth OT End Hour</th>";

        $countrecord = 0;
        foreach ($stack as $value) {
            $countrecord = $countrecord + 1;
            //echo $value . "<br />";
            $IDNumber = $value;
            list($FirstName, $MiddelName, $LastName, $Department) = $this->get_employee_Detail($IDNumber);



            echo "<tr align=\"left\" nowrap=\"nowrap\"> <td>";
            echo "<input type=\"checkbox\" name=\"CHK_ID[]\" value=\"'" . $IDNumber . "'\">";
            echo $IDNumber;
            echo "</td>";

            echo "<td align=\"left\" nowrap=\"nowrap\">";
            echo "$FirstName $MiddelName $LastName";
            echo "</td>";

            echo "<td nowrap=\"nowrap\">";
            echo "$Department";
            echo "</td>";

            echo "<td nowrap=\"nowrap\">";
            echo "<input type=\"checkbox\" id=\"CHK_DayOT[]\" name=\"CHK_DayOT[]\" value=\"'" . $IDNumber . "'\">";
            echo "</td>";

            if ($countrecord == 1) {
                echo "<td nowrap=\"nowrap\">";
                echo "<input type=\"text\" name=\"DayOT_MaxHR\" value=\"00:00:00\" size=\"8\">";
                echo "</td>";
            } else {
                echo "<td nowrap=\"nowrap\"></td>";
            }

            echo "<td nowrap=\"nowrap\">";
            echo "<input type=\"checkbox\" name=\"CHK_NightOT[]\" value=\"'" . $IDNumber . "'\">";
            echo "</td>";
            /*
              echo "<td>";
              echo "<input type=\"checkbox\" name=\"CHK_SundayOT[]\" value=\"'".$IDNumber."'\">";
              echo "</td>";

              echo "<td>";
              echo "<input type=\"checkbox\" name=\"CHK_HolydayOT[]\" value=\"'".$IDNumber."'\">";
              echo "</td>";
             */

            if ($countrecord == 1) {
                echo "<td nowrap=\"nowrap\">";
                echo "<input type=\"text\" name=\"NightOT_MaxHR\" value=\"00:00:00\" size=\"8\">";
                echo "</td>";

                echo "<td nowrap=\"nowrap\">";
                echo "<input type=\"text\" name=\"DayOT_Start\" value=\"00:00:00\" size=\"8\">";
                echo "</td>";

                echo "<td nowrap=\"nowrap\">";
                echo "<input type=\"text\" name=\"NightOT_Start\" value=\"22:00:00\" size=\"8\">";
                echo "</td>";

                echo "<td nowrap=\"nowrap\">";
                echo "<input type=\"text\" name=\"NightOT_End\" value=\"06:00:00\" size=\"8\">";
                echo "</td>";
            } else {
                echo "<td nowrap=\"nowrap\"></td>";
            }
        }
        echo "</table>";
    }

    public function OT_Definition($ID, $FirstName, $MiddelName, $LastName, $Department, $From_Date, $To_Date, $DayOTvalue, $DayOT_MaxHR, $NightOTvalue, $NightOT_MaxHR, $DayOT_Start, $NightOT_Start, $NightOT_End) {
        if (mysql_num_rows(mysql_query("Select * FROM `OT_Definition` WHERE `ID`='" . $ID . "' and `From_Date`='" . $From_Date . "' and `To_Date`='" . $To_Date . "'"))) {
            $sqlUPDT = "UPDATE `OT_Definition`
SET DayOT='" . $DayOTvalue . "',NightOT='" . $NightOTvalue .
                    "',DayOT_MaxHR='" . $DayOT_MaxHR . "',
  NightOT_MaxHR='" . $NightOT_MaxHR . "',
  DayOT_Start='" . $DayOT_Start . "',
  NightOT_Start='" . $NightOT_Start . "',
  NightOT_End='" . $NightOT_End . "',
  `Department`='" . $Department . "'
 WHERE `ID`='" . $ID . "' and `From_Date`='" . $From_Date . "' and `To_Date`='" . $To_Date . "'";

            mysql_query($sqlUPDT) or die(mysql_error());
        } else {
            $sqlINSRT = "INSERT INTO `OT_Definition` 
		(`ID`,`FirstName`,`MiddelName`,`LastName`,`Department`,`From_Date`,`To_Date`,`DayOT`,`NightOT`,`DayOT_MaxHR`,`NightOT_MaxHR`,`DayOT_Start`,`NightOT_Start`,`NightOT_End`)
VALUES ('" . $ID . "','" . $FirstName . "','" . $MiddelName . "','" . $LastName . "','" . $Department . "','" . $From_Date . "','" . $To_Date . "','" . $DayOTvalue . "','" . $NightOTvalue . "','" . $DayOT_MaxHR . "','" . $NightOT_MaxHR . "','" . $DayOT_Start . "','" . $NightOT_Start . "','" . $NightOT_End . "') ";

            mysql_query($sqlINSRT) or die(mysql_error());
        }
    }

//    public function get_employee_OT_definition($ID, $Department, $Date) {
//
//        /* Selecting only those in the same month and half year worker employee */
//
//
//        $queryOT = "SELECT * FROM `OT_Definition`
// where ID='" . $ID . "' and `From_Date`<='" . $Date . "' and `To_Date` >='" . $Date . "'";
//
//
//        $resultOT = mysql_query($queryOT);
//
//        if (mysql_num_rows($resultOT)) { //1st priority
//            $rowOT = mysql_fetch_array($resultOT, MYSQL_ASSOC);
//            //($rowOT['ID'],$rowOT['DayOT'],$rowOT['NightOT'],$rowOT['SundayOT'],$rowOT['HolydayOT'])                
//            return array($ID,
//                $rowOT['DayOT'], $rowOT['NightOT'], $rowOT['SundayOT'], $rowOT['HolydayOT'],
//                $rowOT['DayOT_MaxHR'], $rowOT['NightOT_MaxHR'],
//                $rowOT['DayOT_Start'], $rowOT['NightOT_Start'], $rowOT['NightOT_End']);
//        } else { //second priority          
//            $queryOTDept = "SELECT * FROM `OT_Definition_Department` 
//                Where `Department`='" . $Department . "' and 
//                    `From_Date` <= '" . $Date . "' and `To_Date` >= '" . $Date . "'";
//
//            $resultOTDept = mysql_query($queryOTDept);
//
//            $rowOTDept = mysql_fetch_array($resultOTDept, MYSQL_ASSOC);
//
//            return array($ID,
//                $rowOTDept['DayOT'], $rowOTDept['NightOT'], $rowOTDept['SundayOT'], $rowOTDept['HolydayOT'],
//                $rowOTDept['DayOT_MaxHR'], $rowOTDept['NightOT_MaxHR'],
//                $rowOTDept['DayOT_Start'], $rowOTDept['NightOT_Start'], $rowOTDept['NightOT_End']);
//        }
//    }
//    

    public function get_employee_OT_definition($employeeIDlist, $Date) {

        $OTDefinition = array();

        foreach ($employeeIDlist as $key => $ID) {


            $queryOT = "SELECT * FROM `OT_Definition`
 where ID='" . $ID . "' and `From_Date`<='" . $Date . "' and `To_Date` >='" . $Date . "'";


            $resultOT = mysql_query($queryOT);

            if (mysql_num_rows($resultOT)) { //1st priority
                $rowOT = mysql_fetch_array($resultOT, MYSQL_ASSOC);

//                return array($ID,
//                    $rowOT['DayOT'], $rowOT['NightOT'], $rowOT['SundayOT'], $rowOT['HolydayOT'],
//                    $rowOT['DayOT_MaxHR'], $rowOT['NightOT_MaxHR'],
//                    $rowOT['DayOT_Start'], $rowOT['NightOT_Start'], $rowOT['NightOT_End']);

                array_push($OTDefinition, array('ID' => $ID,
                    'Definition' => (
                    array($ID,
                        $rowOT['DayOT'], $rowOT['NightOT'], $rowOT['SundayOT'], $rowOT['HolydayOT'],
                        $rowOT['DayOT_MaxHR'], $rowOT['NightOT_MaxHR'],
                        $rowOT['DayOT_Start'], $rowOT['NightOT_Start'], $rowOT['NightOT_End'])
                    )
                        )
                );
            } else { //second priority          
                $queryOTDept = "SELECT * FROM `OT_Definition_Department` 
                Where Department IN (Select Department FROM employee_personal_record where ID='" . $ID . "')  and 
                    `From_Date` <= '" . $Date . "' and `To_Date` >= '" . $Date . "'";

                $resultOTDept = mysql_query($queryOTDept);

                $rowOTDept = mysql_fetch_array($resultOTDept, MYSQL_ASSOC);

//                return array($ID,
//                    $rowOTDept['DayOT'], $rowOTDept['NightOT'], $rowOTDept['SundayOT'], $rowOTDept['HolydayOT'],
//                    $rowOTDept['DayOT_MaxHR'], $rowOTDept['NightOT_MaxHR'],
//                    $rowOTDept['DayOT_Start'], $rowOTDept['NightOT_Start'], $rowOTDept['NightOT_End']);
//                
                array_push($OTDefinition, array('ID' => $ID,
                    'Definition' => (
                    array($ID,
                        $rowOTDept['DayOT'], $rowOTDept['NightOT'], $rowOTDept['SundayOT'], $rowOTDept['HolydayOT'],
                        $rowOTDept['DayOT_MaxHR'], $rowOTDept['NightOT_MaxHR'],
                        $rowOTDept['DayOT_Start'], $rowOTDept['NightOT_Start'], $rowOTDept['NightOT_End'])
                    )
                        )
                );
            }
        }

        return $OTDefinition;
    }

    public function get_working_time_setting($employeeIDlist, $Date) {

        $IDarray = array();
        $Start = array();
        $Start_Break = array();
        $End_Break = array();
        $End = array();
        $Working_Hour = array();
        $Working_Hour_Hold = array();



        $workinghourDefinition = array();

        foreach ($employeeIDlist as $key => $ID) {

            /*             * ************* Query list by  priority *********** */

            $query1 = "SELECT * FROM working_time_setting_individual 
 where ID='" . $ID . "' and `From_Date` <='" . $Date . "'
AND `To_Date` >='" . $Date . "'";


            $query2 = "SELECT * FROM Working_Time_Setting 
 where Department IN (Select Department FROM employee_personal_record where ID='" . $ID . "') and `From_Date` <='" . $Date . "'
AND `To_Date` >='" . $Date . "'";


            $query3 = "SELECT * FROM Working_Time_Setting 
 where Department='Default' and `From_Date` <='" . $Date . "'
AND `To_Date` >='" . $Date . "'";

            //Get individual Working Time setting if it defined by ine the working_time_setting_individual	



            if ((mysql_num_rows(mysql_query($query1)))) { //1st priority
                $result1 = mysql_query($query1);
                $row1 = mysql_fetch_array($result1, MYSQL_ASSOC);


//                array_push($IDarray, $row1['ID']);
//                array_push($Start, $row1['Start']);
//                array_push($Start_Break, $row1['Start_Break']);
//                array_push($End_Break, $row1['End_Break']);
//                array_push($End, $row1['End']);
//
//                array_push($Working_Hour, $row1['Working_Hour']);
//                array_push($Working_Hour_Hold, $row1['Working_Hour_Hold']);


                $Start = $row1['Start'];
                $Start_Break = $row1['Start_Break'];
                $End_Break = $row1['End_Break'];
                $End = $row1['End'];
                $Working_Hour = $row1['Working_Hour'];
                $Working_Hour_Hold = $row1['Working_Hour_Hold'];

                //  $workinghourDefiniton=array($ID,$Start, $Start_Break, $End_Break, $End, $Working_Hour, $Working_Hour_Hold);

                array_push($workinghourDefinition, array('ID' => $ID,
                    'Definition' => (
                    array($ID, $Start, $Start_Break, $End_Break, $End, $Working_Hour, $Working_Hour_Hold)
                    )
                        )
                );

                //  array_push($workinghourDefinition,array($ID,$Start, $Start_Break, $End_Break, $End, $Working_Hour, $Working_Hour_Hold));
            } else {
                $result2 = mysql_query($query2);

                if ((mysql_num_rows($result2))) { // 2nd priority
                    $row2 = mysql_fetch_array($result2, MYSQL_ASSOC);

//                    array_push($IDarray, $ID);
//                    array_push($Start, $row2['Start']);
//                    array_push($Start_Break, $row2['Start_Break']);
//                    array_push($End_Break, $row2['End_Break']);
//                    array_push($End, $row2['End']);
//                    array_push($Working_Hour, $row2['Working_Hour']);
//                    array_push($Working_Hour_Hold, $row2['Working_Hour_Hold']);

                    $Start = $row2['Start'];
                    $Start_Break = $row2['Start_Break'];
                    $End_Break = $row2['End_Break'];
                    $End = $row2['End'];
                    $Working_Hour = $row2['Working_Hour'];
                    $Working_Hour_Hold = $row2['Working_Hour_Hold'];

                    //  $workinghourDefiniton=array($ID,$Start, $Start_Break, $End_Break, $End, $Working_Hour, $Working_Hour_Hold);
                    // array_push($workinghourDefinition,array($ID,$Start, $Start_Break, $End_Break, $End, $Working_Hour, $Working_Hour_Hold));

                    array_push($workinghourDefinition, array('ID' => $ID,
                        'Definition' => (
                        array($ID, $Start, $Start_Break, $End_Break, $End, $Working_Hour, $Working_Hour_Hold)
                        )
                            )
                    );
                } else {  //3rd priority
                    $result3 = mysql_query($query3);

                    $row3 = mysql_fetch_array($result3, MYSQL_ASSOC);


//                    array_push($IDarray, $ID);
//                    array_push($Start, $row3['Start']);
//                    array_push($Start_Break, $row3['Start_Break']);
//                    array_push($End_Break, $row3['End_Break']);
//                    array_push($End, $row3['End']);
//                    array_push($Working_Hour, $row3['Working_Hour']);
//                    array_push($Working_Hour_Hold, $row3['Working_Hour_Hold']);

                    $Start = $row3['Start'];
                    $Start_Break = $row3['Start_Break'];
                    $End_Break = $row3['End_Break'];
                    $End = $row3['End'];
                    $Working_Hour = $row3['Working_Hour'];
                    $Working_Hour_Hold = $row3['Working_Hour_Hold'];

                    // array_push($workinghourDefinition,array($ID,$Start, $Start_Break, $End_Break, $End, $Working_Hour, $Working_Hour_Hold));

                    array_push($workinghourDefinition, array('ID' => $ID,
                        'Definition' => (
                        array($ID, $Start, $Start_Break, $End_Break, $End, $Working_Hour, $Working_Hour_Hold)
                        )
                            )
                    );
                }
            }
        }


        return $workinghourDefinition;
        //return array($IDarray, $Start, $Start_Break, $End_Break, $End, $Working_Hour, $Working_Hour_Hold);
    }

//    public function get_working_time_setting($Department, $Date, $ID = NULL) {
//
//
//        /*         * ************* Query list by  priority *********** */
//
//        $query1 = "SELECT * FROM working_time_setting_individual 
// where ID='" . $ID . "' and `From_Date` <='" . $Date . "'
//AND `To_Date` >='" . $Date . "'";
//
//
//        $query2 = "SELECT * FROM Working_Time_Setting 
// where Department='" . $Department . "' and `From_Date` <='" . $Date . "'
//AND `To_Date` >='" . $Date . "'";
//
//
//        $query3 = "SELECT * FROM Working_Time_Setting 
// where Department='Default' and `From_Date` <='" . $Date . "'
//AND `To_Date` >='" . $Date . "'";
//
//
//        //Get individual Working Time setting if it defined by ine the working_time_setting_individual	
//
//        if ((isset($ID)) && (mysql_num_rows(mysql_query($query1)))) { //1st priority
//            $result1 = mysql_query($query1);
//            $row1 = mysql_fetch_array($result1, MYSQL_ASSOC);
//
//            $Start = $row1['Start'];
//            $Start_Break = $row1['Start_Break'];
//            $End_Break = $row1['End_Break'];
//            $End = $row1['End'];
//            $Working_Hour = $row1['Working_Hour'];
//            $Working_Hour_Hold = $row1['Working_Hour_Hold'];
//        } else {
//            $result2 = mysql_query($query2);
//
//            if ((mysql_num_rows($result2))) { // 2nd priority
//                $row2 = mysql_fetch_array($result2, MYSQL_ASSOC);
//
//                $Start = $row2['Start'];
//                $Start_Break = $row2['Start_Break'];
//                $End_Break = $row2['End_Break'];
//                $End = $row2['End'];
//                $Working_Hour = $row2['Working_Hour'];
//                $Working_Hour_Hold = $row2['Working_Hour_Hold'];
//            } else {  //3rd priority
//                $result3 = mysql_query($query3);
//
//                $row3 = mysql_fetch_array($result3, MYSQL_ASSOC);
//
//                $Start = $row3['Start'];
//                $Start_Break = $row3['Start_Break'];
//                $End_Break = $row3['End_Break'];
//                $End = $row3['End'];
//                $Working_Hour = $row3['Working_Hour'];
//                $Working_Hour_Hold = $row3['Working_Hour_Hold'];
//            }
//        }
//
//        return array($Department, $Start, $Start_Break, $End_Break, $End, $Working_Hour, $Working_Hour_Hold);
//    }

    public function get_late_tolerance_setting($Department, $ID = NULL) {

        /*         * ************* Query list by  priority *********** */

        $query1 = "SELECT * FROM late_tolerance_setting_individual 
 where ID='" . $ID . "'";

        $query2 = "SELECT * FROM late_tolerance_setting 
 where Department='" . $Department . "'";

        $query3 = "SELECT * FROM late_tolerance_setting 
 where Department='Default'";


        //Get individual Working Time setting if it defined by ine the working_time_setting_individual	
        if ((isset($ID)) && (mysql_num_rows(mysql_query($query1)))) { //1st priority
            $result1 = mysql_query($query1);
            $row1 = mysql_fetch_array($result1, MYSQL_ASSOC);

            //latance after work starting time
            $After_Start = $row1['After_Start'];

            //latance before break starting time
            $Before_Start_Break = $row1['Before_Start_Break'];

            //latance after break work starting time
            $After_End_Break = $row1['After_End_Break'];

            //latance before work end time
            $Before_End = $row1['Before_End'];
        } else {
            $result2 = mysql_query($query2);

            if ((mysql_num_rows($result2))) { // 2nd priority
                $row2 = mysql_fetch_array($result2, MYSQL_ASSOC);


                //latance after work starting time
                $After_Start = $row2['After_Start'];

                //latance before break starting time
                $Before_Start_Break = $row2['Before_Start_Break'];

                //latance after break work starting time
                $After_End_Break = $row2['After_End_Break'];

                //latance before work end time
                $Before_End = $row2['Before_End'];
            } else {  //3rd priority
                $result3 = mysql_query($query3);

                $row3 = mysql_fetch_array($result3, MYSQL_ASSOC);


                //latance after work starting time
                $After_Start = $row3['After_Start'];

                //latance before break starting time
                $Before_Start_Break = $row3['Before_Start_Break'];

                //latance after break work starting time
                $After_End_Break = $row3['After_End_Break'];

                //latance before work end time
                $Before_End = $row3['Before_End'];
            }
        }

        return array($Department, $After_Start, $Before_Start_Break, $After_End_Break, $Before_End);
    }

    public function timeDiff($firstTime, $lastTime) {

// convert to unix timestamps
        $firstTime = strtotime($firstTime);
        $lastTime = strtotime($lastTime);

// perform subtraction to get the difference (in seconds) between times
        $timeDiff = $lastTime - $firstTime;
        $years = abs(floor($timeDiff / 31536000));
        $days = abs(floor(($timeDiff - ($years * 31536000)) / 86400));
        $hours = abs(floor(($timeDiff - ($years * 31536000) - ($days * 86400)) / 3600));
        /* $difference = timeDiff("2002-03-16 10:00:00",date("Y-m-d H:i:s"));

          $days = abs(floor(($difference-($years * 31536000))/86400));

          $mins = abs(floor(($difference-($years * 31536000)-($days * 86400)-($hours * 3600))/60));#floor($difference / 60);
          echo "<p>Time Passed: " . $years . " Years, " . $days . " Days, " . $hours . " Hours, " . $mins . " Minutes.</p>";
         */

// return the difference
        return $hours;
    }

    public function time_diff($End, $Start) {

        //if($End<$Start)
        //$End=$End+12;
        $sqlTimeDiff = "SELECT TIMEDIFF('2012-01-01 $End', '2012-01-01 $Start') AS HOUR_DIFF";

        $resultOTDiff = mysql_query($sqlTimeDiff);

        $rowOTDiff = mysql_fetch_array($resultOTDiff, MYSQL_ASSOC);

        return $rowOTDiff['HOUR_DIFF'];
        
//        $End1 = strtotime('2012-01-01 ' . $End);
//
//        $Start1 = strtotime('2012-01-01 ' . $Start);
//
//        $diffsec = round(abs($End1 - $Start1));
//
//        return $this->sec2hour($diffsec);
    }

    public function time_add($First, $Second) {
        $sqlTA = "SELECT ADDTIME( '$First', '$Second' ) AS Result";

        $resultTA = mysql_query($sqlTA);

        $rowTA = mysql_fetch_array($resultTA, MYSQL_ASSOC);

        return $rowTA['Result'];


//        $to_time = strtotime('2012-01-01 ' . $First);
//        $from_time = strtotime('2012-01-01 ' . $Second);
//
//        $totalsec = $to_time + $from_time;
//
//        return $this->sec2hour($totalsec);
        //round(abs($to_time - $from_time));// / 60,2). " minute";
    }

    public function first_session_working_hour($Scan_Start, $Scan_Start_Break, $Start, $Start_Break) {

        $Start_AB = "00:00:00";
        $Start_Break_AB = "00:00:00";

        if (($Scan_Start != NULL) and ($Scan_Start_Break != NULL)) {

            //First Session Start
            if (($Scan_Start > $Start)) {
                $Start_AB = $this->time_diff($Scan_Start, $Start);
                $First_Session_Start = $Scan_Start;
            } else
            if ($Scan_Start <= $Start) {
                $Start_AB = "00:00:00";
                $First_Session_Start = $Start;
            }


            //First Session End
            if ($Start_Break != "00:00:00") {
                if (($Scan_Start_Break < $Start_Break)) {
                    $Start_Break_AB = $this->time_diff($Start_Break, $Scan_Start_Break);
                    $First_Session_End = $Scan_Start_Break;
                } else
                if ($Scan_Start_Break >= $Start_Break) {
                    $Start_Break_AB = "00:00:00";
                    $First_Session_End = $Start_Break;
                }
            }


            //First Session Total
            if ($Start_Break != "00:00:00") {


                if (isset($First_Session_End) and isset($First_Session_Start)) {

                    if ($First_Session_End < $First_Session_Start) { //If it lays Between Mid Night
                        $First_Session_Mid_Night1 = $this->time_diff("23:59:59", $First_Session_Start);

                        $First_Session_Mid_Night = $this->time_add("00:00:01", $First_Session_Mid_Night1);

                        $First_Session_HR = $this->time_add($First_Session_Mid_Night, $First_Session_End);
                    } else {

                        $First_Session_HR = $this->time_diff($First_Session_End, $First_Session_Start);
                    }
                } else {

                    $First_Session_Start = "00:00:00";
                    $First_Session_End = "00:00:00";
                    $First_Session_HR = "00:00:00";
                }


                return array($Start_AB, $Start_Break_AB, $First_Session_Start, $First_Session_End, $First_Session_HR);
            } else {

                return array($Start_AB, "00:00:00", $First_Session_Start, $Scan_Start_Break, "UNKNOWN");
            }
        } else {

            $First_Session_Start = "00:00:00";
            $First_Session_End = "00:00:00";
            $First_Session_HR = "00:00:00";

            return array($Start_AB, $Start_Break_AB, $First_Session_Start, $First_Session_End, $First_Session_HR);
        }
    }

    public function second_session_working_hour($Scan_End_Break, $Scan_End, $End_Break, $End) {

        $End_Break_AB = "00:00:00";
        $End_AB = "00:00:00";


        if (($Scan_End_Break != NULL) and ($Scan_End != NULL)) {

            //Second Session Start
            if (($Scan_End_Break > $End_Break)) {
                $End_Break_AB = $this->time_diff($Scan_End_Break, $End_Break);
                $Second_Session_Start = $Scan_End_Break;
            } else
            if ($Scan_End_Break <= $End_Break) {
                $End_Break_AB = "00:00:00";
                $Second_Session_Start = $End_Break;
            }

            //Second Session End
            if ($End != "00:00:00") {
                if ($Scan_End < $End) {
                    $End_AB = $this->time_diff($End, $Scan_End);
                    $Second_Session_End = $Scan_End;
                } else
                if ($Scan_End >= $End) {
                    $End_AB = "00:00:00";

                    $Second_Session_End = $End;
                }
            } else if (($Scan_End != "00:00:00") and ($End == "00:00:00")) {
                $Second_Session_End = $Scan_End;
            }
            else
                $Second_Session_End = "00:00:00";


            //Second Session Total
            if (($Second_Session_End != "00:00:00") and ($Second_Session_Start != "00:00:00")) {

                if (isset($Second_Session_End) and isset($Second_Session_Start)) {


                    if ($Second_Session_End < $Second_Session_Start) { //If it lays Between Mid Night
                        $Second_Session_Mid_Night1 = $this->time_diff("23:59:59", $Second_Session_Start);

                        $Second_Session_Mid_Night = $this->time_add("00:00:01", $Second_Session_Mid_Night1);

                        $Second_Session_HR = $this->time_add($Second_Session_Mid_Night, $Second_Session_End);
                    } else {

                        $Second_Session_HR = $this->time_diff($Second_Session_End, $Second_Session_Start);
                    }
                } else {

                    $Second_Session_Start = "00:00:00";
                    $Second_Session_End = "00:00:00";
                    $Second_Session_HR = "00:00:00";
                }

                return array($End_Break_AB, $End_AB, $Second_Session_Start, $Second_Session_End, $Second_Session_HR);
            } else {

                return array($End_Break_AB, "00:00:00", $Second_Session_Start, $Scan_End, "UNKNOWN");
            }
        } else {

            $Second_Session_Start = "00:00:00";
            $Second_Session_End = "00:00:00";
            $Second_Session_HR = "00:00:00";

            return array($End_Break_AB, $End_AB, $Second_Session_Start, $Second_Session_End, $Second_Session_HR);
        }
    }

    public function Working_Hour($scanData, $workingTimeDefinition, $late_tolerance = NULL) {

        list($Department, $Start, $Start_Break, $End_Break, $End, $Working_Hour, $Working_Hour_Hold) = $workingTimeDefinition;

        list($Scan_ID, $Scan_FirstName, $Scan_MiddelName, $Scan_LastName, $Scan_Department,
                $Scan_Date, $Scan_Start, $Scan_Start_Break, $Scan_End_Break, $Scan_End) = $scanData;


        /*         * *******************Shift Worker(Shift workers doesnt have Start 
         * working time so assign the scanned time)******************* */
        if (($Start == "00:00:00") && ($Scan_Start_Break != NULL) && ($Scan_End_Break != NULL)) {
            $Start = $Scan_Start;
            $Start_Break = $Scan_Start_Break;
            $End_Break = $Scan_End_Break;
            $End = $Scan_End;
            list($Start_AB, $Start_Break_AB, $First_Session_Start, $First_Session_End, $First_Session_HR) = $this->first_session_working_hour($Scan_Start, $Scan_Start_Break, $Start, $Start_Break);

            list($End_Break_AB, $End_AB, $Second_Session_Start, $Second_Session_End, $Second_Session_HR) = $this->second_session_working_hour($Scan_End_Break, $Scan_End, $End_Break, $End);
        } else
        if (($Start == "00:00:00")) {
            $Start = $Scan_Start;
            $Start_Break = $Scan_Start_Break;
            $End_Break = $Scan_End_Break;
            $End = $Scan_End;

            $Start = "00:00:00";


            list($Start_AB, $Start_Break_AB, $First_Session_Start, $First_Session_End, $First_Session_HR) = $this->first_session_working_hour($Scan_Start, $Scan_End, $Start, $End);


            $Second_Session_Start = "00:00:00";
            $Second_Session_End = "00:00:00";
            $Second_Session_HR = "00:00:00";
        }
        /*         * ************************************** */

        if (($Scan_Start == NULL) and ($Scan_Start_Break == NULL) and ($Scan_End_Break == NULL) and ($Scan_End == NULL)) {

            $First_Session_Start = "00:00:00";
            $First_Session_End = "00:00:00";
            $First_Session_HR = "00:00:00";
            $Second_Session_Start = "00:00:00";
            $Second_Session_End = "00:00:00";
            $Second_Session_HR = "00:00:00";
        } else if (($Start != "00:00:00") and ($Start_Break != "00:00:00") and ($End_Break != "00:00:00") and ($End != "00:00:00")) {

            list($Start_AB, $Start_Break_AB, $First_Session_Start, $First_Session_End, $First_Session_HR) = $this->first_session_working_hour($Scan_Start, $Scan_Start_Break, $Start, $Start_Break);

            list($End_Break_AB, $End_AB, $Second_Session_Start, $Second_Session_End, $Second_Session_HR) = $this->second_session_working_hour($Scan_End_Break, $Scan_End, $End_Break, $End);
        } else
        if (($Start != "00:00:00") and ($Start_Break != "00:00:00") and ($End_Break != "00:00:00") and ($End == "00:00:00")) {
            list($Start_AB, $Start_Break_AB, $First_Session_Start, $First_Session_End, $First_Session_HR) = $this->first_session_working_hour($Scan_Start, $Scan_Start_Break, $Start, $Start_Break);

            list($End_Break_AB, $End_AB, $Second_Session_Start, $Second_Session_End, $Second_Session_HR) = $this->second_session_working_hour($Scan_End_Break, $Scan_End, $End_Break, $End);

            if ($Second_Session_HR == "UNKNOWN") {
                $Second_Session_HR_Total = $this->time_diff($Working_Hour, $First_Session_HR);

                $Second_Session_HR = $this->time_diff($Second_Session_HR_Total, $End_Break_AB);
            }
        } else
        if (($Start != "00:00:00") and ($Start_Break != "00:00:00") and ($End_Break == "00:00:00") and ($End == "00:00:00")) {
            list($Start_AB, $Start_Break_AB, $First_Session_Start, $First_Session_End, $First_Session_HR) = $this->first_session_working_hour($Scan_Start, $Scan_Start_Break, $Start, $Start_Break);

            $Second_Session_Start = "00:00:00";
            $Second_Session_End = "00:00:00";
            $Second_Session_HR = "00:00:00";
        } else
        if (($Start != "00:00:00") and ($Start_Break == "00:00:00") and ($End_Break == "00:00:00") and ($End == "00:00:00")) {
            list($Start_AB, $Start_Break_AB, $First_Session_Start, $First_Session_End, $First_Session_HR) = $this->first_session_working_hour($Scan_Start, $Scan_End, $Start, $End);

            if ($First_Session_HR == "UNKNOWN") {
                $First_Session_HR = $this->time_diff($Working_Hour, $Start_AB);
            }
            $Second_Session_Start = "00:00:00";
            $Second_Session_End = "00:00:00";
            $Second_Session_HR = "00:00:00";
        } else
        if (($Start != "00:00:00") and ($Start_Break == "00:00:00") and ($End_Break == "00:00:00") and ($End != "00:00:00")) {
            list($Start_AB, $Start_Break_AB, $First_Session_Start, $First_Session_End, $First_Session_HR) = $this->first_session_working_hour($Scan_Start, $Scan_End, $Start, $End);

            $Second_Session_Start = "00:00:00";
            $Second_Session_End = "00:00:00";
            $Second_Session_HR = "00:00:00";
            /*             * ********coldroom('GH 11-12 Cold Room') case //if only breaks are not avaial and scan data registed Scan_End in the in Start_Break **************** */
            if (trim(strtoupper(substr($Scan_Department, 9, 9))) == trim(strtoupper('Cold Room'))) {
                if (($Scan_Start_Break != NULL) and ($Scan_End_Break != NULL)) {

                    $Second_Session_Start = $Scan_Start_Break;
                    $Second_Session_End = $Scan_End_Break;

                    $Second_Session_HR = $this->time_diff($Second_Session_End, $Second_Session_Start);
                }

                if (($Scan_Start != NULL) and ($Scan_Start_Break != NULL) and ($Scan_End == NULL)) {
                    $Scan_End = $Scan_Start_Break;
                }

                // end of coldroom('GH 11-12 Cold Room') case 

                list($Start_AB, $Start_Break_AB, $First_Session_Start, $First_Session_End, $First_Session_HR) = $this->first_session_working_hour($Scan_Start, $Scan_End, $Start, $End);
            }
//                else
//                if (($Start == "00:00:00") and ($Start_Break == "00:00:00")
//                        and ($End_Break == "00:00:00") and ($End == "00:00:00")) {
//
//                    $First_Session_Start = "00:00:00";
//                    $First_Session_End = "00:00:00";
//                    $First_Session_HR = "00:00:00";
//
//                    $Second_Session_Start = "00:00:00";
//                    $Second_Session_End = "00:00:00";
//                    $Second_Session_HR = "00:00:00";
//                }
        }



        //total Working Hour Before Late tolerance
        $WorkingHR = $this->time_add($First_Session_HR, $Second_Session_HR);


        //late tolerance is enabled          
        if (($late_tolerance == "TRUE") and ($Start_Break != "00:00:00") and ($End_Break != "00:00:00")) {

            list($Department, $After_Start, $Before_Start_Break, $After_End_Break, $Before_End) = $this->get_late_tolerance_setting($Scan_Department, $Scan_ID);


            // First Session late tolerance to start work after work starting time
            if ($First_Session_Start > $Start) {
                $First_Session_Start_late_tolerance = $this->time_diff($First_Session_Start, $After_Start);

                if ($First_Session_Start_late_tolerance < $Start) {
                    $First_Session_Start = $Start;
                } else {
                    $First_Session_Start = $First_Session_Start;
                }
            }




            // First Session late tolerance to end work before break
            if (($First_Session_End < $Start_Break) and ($Start_Break != "00:00:00")) {
                $First_Session_End_late_tolerance = $this->time_add($First_Session_End, $Before_Start_Break);

                if ($First_Session_End_late_tolerance > $Start_Break) {
                    $First_Session_End = $Start_Break;
                } else {
                    $First_Session_End = $First_Session_End;
                }
            }





            // Second Session late tolerance to start work after break
            if (($Second_Session_Start > $End_Break) and ($End_Break != "00:00:00")) {
                $Second_Session_Start_late_tolerance = $this->time_diff($Second_Session_Start, $After_End_Break);

                if ($Second_Session_Start_late_tolerance < $End_Break) {
                    $Second_Session_Start = $End_Break;
                } else {
                    $Second_Session_Start = $Second_Session_Start;
                }
            }




            // Second Session late tolerance to end work before End
            if (($Second_Session_End < $End) and ($End != "00:00:00")) {
                $Second_Session_End_late_tolerance = $this->time_add($Second_Session_End, $End);

                if ($Second_Session_End_late_tolerance > $End) {
                    $Second_Session_End = $End;
                } else {
                    $Second_Session_End = $Second_Session_End;
                }
            }


            //First Session Total
            if (isset($First_Session_End) and isset($First_Session_Start)) {

                if ($First_Session_End < $First_Session_Start) { //If it lays Between Mid Night
                    $First_Session_Mid_Night = $this->time_diff("23:59:59", $First_Session_Start);

                    $First_Session_Mid_Night = $this->time_add("00:00:01", $First_Session_Mid_Night);


                    $First_Session_HR = $this->time_add($First_Session_Mid_Night, $First_Session_End);
                } else {

                    $First_Session_HR = $this->time_diff($First_Session_End, $First_Session_Start);
                }
            } else {
                $First_Session_Start = "00:00:00";
                $First_Session_End = "00:00:00";
                $First_Session_HR = "00:00:00";
            }

            //Second Sessioon Total
            if (isset($Second_Session_End) and isset($Second_Session_Start)) {

                if ($Second_Session_End < $Second_Session_Start) { //If it lays Between Mid Night
                    $Second_Session_Mid_Night = $this->time_diff("23:59:59", $Second_Session_Start);

                    $Second_Session_Mid_Night = $this->time_add("00:00:01", $Second_Session_Mid_Night);

                    $Second_Session_HR = $this->time_add($Second_Session_Mid_Night, $Second_Session_End);
                } else {

                    $Second_Session_HR = $this->time_diff($Second_Session_End, $Second_Session_Start);
                }
            } else {
                $Second_Session_Start = "00:00:00";
                $Second_Session_End = "00:00:00";
                $Second_Session_HR = "00:00:00";
            }

            //Total Working Hour
            $WorkingHR = $this->time_add($First_Session_HR, $Second_Session_HR);
        }



        if ($WorkingHR <= "00:00:00")
            $WorkingHR = ""; //"00:00:00";

        if (($WorkingHR >= $Working_Hour)) {
            $WorkingHR = $Working_Hour_Hold;
        }

        if ($WorkingHR >= $Working_Hour_Hold)
            $WorkingHR = $Working_Hour_Hold;



        return array($First_Session_Start, $First_Session_End, $First_Session_HR, $Second_Session_Start, $Second_Session_End, $Second_Session_HR, $WorkingHR);
    }

    /*
     * Insert values into the table
     * Required: table (the name of the table)
     *           values (the values to be inserted)
     * Optional: rows (if values don't match the number of rows)
     */

    public function insert($table, $values, $rows = null) {
        if ($this->tableExists($table)) {
            $insert = 'INSERT INTO ' . $table;
            if ($rows != null) {
                $insert .= ' (' . $rows . ')';
            }

            for ($i = 0; $i < count($values); $i++) {
                if (is_string($values[$i]))
                    $values[$i] = '"' . $values[$i] . '"';
            }
            $values = implode(',', $values);
            $insert .= ' VALUES (' . $values . ')';

            $ins = @mysql_query($insert);

            if ($ins) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function OT($scanData, $workingTimeDefinition, $OTDefinition, $round = NULL) {

        /*         * **************OT Starting and End Definition**************************** */

        $WorkingHR = "";
        $DayOTHR = "";
        $NightOTHR = "";
        $SundayOTHR = "";
        $HolydayOTHR = "";


        list($Scan_ID, $Scan_FirstName, $Scan_MiddelName, $Scan_LastName, $Scan_Department,
                $Scan_Date, $Scan_Start, $Scan_Start_Break, $Scan_End_Break, $Scan_End) = $scanData;


        list($Department, $Start, $Start_Break, $End_Break, $End, $Working_Hour, $Working_Hour_Hold) = $workingTimeDefinition;


        list($ID, $DayOT, $NightOT, $SundayOT, $HolydayOT,
                $DayOT_MaxHR, $NightOT_MaxHR, $DayOT_Start, $NightOT_Start, $NightOT_End) = $OTDefinition;



        //************** Day OT Allocation**********************//
        if ((trim(strtoupper($DayOT)) == 'Y') and ($Scan_End > $End) and ($Scan_End <= $NightOT_Start)) {

            $DayOTHR = $this->time_diff($Scan_End, $DayOT_Start);
        } else
        if ((trim(strtoupper($DayOT)) == "Y") and ($Scan_End > $End) and ($Scan_End > $NightOT_Start)) {

            $DayOTHR = $this->time_diff($NightOT_Start, $DayOT_Start);
        }

        /*         * *******coldroom('GH 11-12 Cold Room') case //if only breaks are not avaial and scan data registed Scan_End in the in Start_Break **************** */
        if (trim(strtoupper(substr($Scan_Department, 9, 9))) == trim(strtoupper('Cold Room'))) {

            if (($Scan_Start_Break != NULL) and ($Scan_End_Break != NULL) and ($Scan_End != NULL)) {

                $DayOTHR = $this->time_diff($Scan_End_Break, $Scan_Start_Break);
            }
        }

        //************** Night OT Allocation**********************//	
        ////  if ((trim(strtoupper($DayOT)) != "Y") and (trim(strtoupper($NightOT)) == "Y") and  ($Scan_End > $NightOT_Start)) {
        ///      $DayOTHR = $this->time_diff($Scan_End, $NightOT_Start);
        ///    }else
        ///       if ((trim(strtoupper($DayOT)) == "Y") and (trim(strtoupper($NightOT)) == "Y") and  ($Scan_End > $NightOT_Start)) {
        ///       $NightOTHR = $this->time_diff($Scan_End, $NightOT_Start);
        ///    }


        if ((trim(strtoupper($NightOT)) == "Y") and ($Scan_End > $NightOT_Start)) {
            $NightOTHR = $this->time_diff($Scan_End, $NightOT_Start);
        }

        //  if ((trim(strtoupper($NightOT)) == "Y") and ($Scan_End > $End) and ($Scan_End > $NightOT_Start) and ($Scan_End <= $NightOT_End)) {
        // $NightOTHR = $this->time_diff($Scan_End, $NightOT_Start);
        //       $NightOTHR = $this->time_diff($Scan_End, $End);
        //       $NightOTHR = $this->time_diff($NightOTHR, $DayOTHR);
        //     }
        //    else
        //    if ((trim(strtoupper($DayOT)) == "Y") and ($Scan_End > $End) and ($Scan_End > $NightOT_Start) and ($Scan_End >= $NightOT_End)) {
        //       $NightOTHR = $this->time_diff($Scan_End, $NightOT_End);
        //       $NightOTHR = $this->time_diff($NightOTHR, $DayOTHR);
        //    }


        /*         * *********************Sunday(Offday) OT Allocation******************************** */

        $Off_Day = trim(strtoupper($this->get_offday($Scan_ID, $Scan_Date)));

        $Day_of_Scan_Date = trim(strtoupper(date("l", strtotime($Scan_Date))));

        $Holday_Name = trim(strtoupper($this->get_Holyday($Scan_Date)));


        if (($Off_Day == $Day_of_Scan_Date) && ($Holday_Name == trim(strtoupper("Not Holyday")))) {


            list($First_Session_Start_OffDay, $First_Session_End_OffDay, $First_Session_HR_OffDay, $Second_Session_Start_OffDay, $Second_Session_End_OffDay, $Second_Session_HR_OffDay, $WorkingHR_OffDay) = $this->Working_Hour($scanData, $workingTimeDefinition);

            $SundayOTHR = $WorkingHR_OffDay;



            if (($SundayOTHR > "00:00:00")) {

                //$DayNightOTHR=$this->time_add($NightOTHR,$DayOTHR);
                $SundayOTHR1 = $this->time_add($SundayOTHR, $DayOTHR); //sum of all working hour and Day OT

                $SundayOTHR = $this->time_add($SundayOTHR1, $NightOTHR); //sum of all working hour and Night OT

                $DayOTHR = "";
                $NightOTHR = "";
            }
        }

        /*         * *************************************************************** */

        /*         * *********************Holyday OT**************************************** */


        if ($Holday_Name != trim(strtoupper("Not Holyday"))) {
            list($First_Session_Start_HolyDay, $First_Session_End_HolyDay, $First_Session_HR_HolyDay, $Second_Session_Start_HolyDay, $Second_Session_End_HolyDay, $Second_Session_HR_HolyDay, $WorkingHR_HolyDay) = $this->Working_Hour($scanData, $workingTimeDefinition);

            if ($DayOTHR != "") {
                $WorkingHR_HolyDay = $this->time_add($WorkingHR_HolyDay, $DayOTHR); //sum of all Holyday working hour and Day OT

                $DayOTHR = "";
            }
            if ($NightOTHR != "") {
                $WorkingHR_HolyDay = $this->time_add($WorkingHR_HolyDay, $NightOTHR); //sum of all Holyday working hour and Night OT

                $NightOTHR = "";
            }


            if (($WorkingHR_HolyDay > "00:00:00") AND ($WorkingHR_HolyDay < "08:00:00")) {
                $WorkingHR_HolyDay = "08:00:00";
            }

            $HolydayOTHR = $WorkingHR_HolyDay;


            if (($HolydayOTHR > "00:00:00")) {
                $SundayOTHR = "";
            }
        }
        /*         * ***************************Holday OT END************************** */

        if (($HolydayOTHR > "00:00:00")) {
            $SundayOTHR = "00:00:00";
        }

        if ($DayOTHR < "00:00:00")
            $DayOTHR = ""; //"00:00:00";

        if ($NightOTHR < "00:00:00")
            $NightOTHR = ""; //"00:00:00";

        if ($SundayOTHR < "00:00:00")
            $SundayOTHR = ""; //"00:00:00";

        if ($HolydayOTHR < "00:00:00")
            $HolydayOTHR = ""; //"00:00:00";		




        if ($round == "TRUE") {

            //Deducting 15 minute from total Day Over time Hour to count starting from 15 minute

            $DayOTHR = $this->time_diff($DayOTHR, '00:15:00');


            if (($DayOTHR >= $DayOT_MaxHR)) {

                $DayOTHR = $DayOT_MaxHR;
            } else
            if (($DayOTHR <= '00:15:00')) {

                $DayOTHR = "";
            }


            if (($NightOTHR >= $NightOT_MaxHR)) {

                $NightOTHR = $NightOT_MaxHR;
            }
        }


        return array($DayOTHR, $NightOTHR, $SundayOTHR, $HolydayOTHR);
    }

    public function get_attendance($ID, $Date) {
        $sqlOT = "SELECT * FROM `Attendance_Sheet` where ID='" . $ID . "' and Date='" . $Date . "'";

        $resultOT = mysql_query($sqlOT);
        $rowOT = mysql_fetch_array($resultOT, MYSQL_ASSOC);

        $Scan_ID = $rowOT['ID'];
        $Scan_Date = $rowOT['Date'];
        $Scan_Start = $rowOT['Start'];
        $Scan_Start_Break = $rowOT['Start_Break'];
        $Scan_End_Break = $rowOT['End_Break'];
        $Scan_End = $rowOT['End'];
        $Scan_Department = $rowOT['Department'];

        return array($Scan_ID, $Scan_Date, $Scan_Start, $Scan_Start_Break, $Scan_End_Break,
            $Scan_End, $Scan_Department);
    }

    public function createDateRangeArray($strDateFrom, $strDateTo) {
        // takes two dates formatted as YYYY-MM-DD and creates an
        // inclusive array of the dates between the from and to dates.
        // could test validity of dates here but I'm already doing
        // that in the main script

        $aryRange = array();

        $iDateFrom = mktime(1, 0, 0, substr($strDateFrom, 5, 2), substr($strDateFrom, 8, 2), substr($strDateFrom, 0, 4));
        $iDateTo = mktime(1, 0, 0, substr($strDateTo, 5, 2), substr($strDateTo, 8, 2), substr($strDateTo, 0, 4));

        if ($iDateTo >= $iDateFrom) {
            array_push($aryRange, date('Y-m-d', $iDateFrom)); // first entry

            while ($iDateFrom < $iDateTo) {
                $iDateFrom+=86400; // add 24 hours
                array_push($aryRange, date('Y-m-d', $iDateFrom));
            }
        }
        return $aryRange;
    }

    public function get_No_Employee($Department) {
        if (mysql_num_rows(mysql_query("SELECT COUNT(ID) AS No_Employee FROM `employee_personal_record` where Department='" . $Department . "'"))) {
            $sqlOT = "SELECT COUNT(ID) As No_Employee FROM `employee_personal_record`  where Department='" . $Department . "' GROUP BY '" . $Department . "'";

            $resultOT = mysql_query($sqlOT);
            $rowOT = mysql_fetch_array($resultOT, MYSQL_ASSOC);

            $No_Employee = $rowOT['No_Employee'];
        } else {
            $No_Employee = "No_Employee";
        }

        return $No_Employee;
    }

    public function get_employee($Department) {
        $ID_employee = array();
        if (mysql_num_rows(mysql_query("SELECT ID  FROM `employee_personal_record` where Department='" . $Department . "'"))) {

            $sqlOT = "SELECT ID  FROM `employee_personal_record`  where Department='" . $Department . "'";


            $resultOT = mysql_query($sqlOT);
            // $rowOT = mysql_fetch_array($resultOT, MYSQL_ASSOC);
            while ($rowOT = mysql_fetch_array($resultOT, MYSQL_ASSOC)) {

                array_push($ID_employee, $rowOT['ID']);
            }
        } else {
            $ID_employee = false;
        }

        return $ID_employee;
    }

    public function get_not_Scaned_Date($Department, $From_Date, $To_Date) {

        $No_Employee = $this->get_No_Employee($Department);
        $DateStack = array();

        if ($No_Employee) {
            if (mysql_num_rows(mysql_query("SELECT Date from (SELECT COUNT(ID) as IDNO,Date FROM `attendance_sheet` 
                where Department='" . $Department . "' and Date BETWEEN '" . $From_Date . "' AND '" . $To_Date . "'  Group BY Date) as sql1
                    where IDNO < " . $No_Employee . ""))) {
                $sqlOT = "SELECT Date from (SELECT COUNT(ID) as IDNO,Date FROM `attendance_sheet` 
                where Department='" . $Department . "' and Date BETWEEN '" . $From_Date . "' AND '" . $To_Date . "'    Group BY Date) as sql1
                    where IDNO < " . $No_Employee . "";



                $resultOT = mysql_query($sqlOT);

                while ($rowOT = mysql_fetch_array($resultOT, MYSQL_ASSOC)) {

                    array_push($DateStack, $rowOT['Date']);
                }
            }
        }


        return $DateStack;
    }

    
    public function get_Date_Range($From_Date, $To_Date) {

        $start = strtotime($From_Date);
        $end1 = strtotime($To_Date);

        $incriment = 60 * 60 * 24;
        $date_rage = array();
        $end = $end1 + $incriment;
        for ($i = $start; $i < $end; $i += $incriment) {

            $date_rage[] = date('Y-m-d', $i);
        }

        return $date_rage;
    }

    
    public function get_Scaned_employee($Department, $Date) {

        $IDStack = array();

        $sqlOT = "SELECT * FROM `attendance_sheet`
            where Department='" . $Department . "' and  Date = '" . $Date . "' Group BY ID,Date";

        $resultOT = mysql_query($sqlOT);

        while ($rowOT = mysql_fetch_array($resultOT, MYSQL_ASSOC)) {
            array_push($IDStack, $rowOT['ID']);
        }

        return $IDStack;
    }

    public function get_Scan_data($ID, $Date) {

        $sql = "SELECT * FROM `Attendance_Sheet` 
          where ID='" . $ID . "' AND
              `Date` = '" . $Date . "' ";

        $result = mysql_query($sql);
        $row = mysql_fetch_array($result, MYSQL_ASSOC);


        $Scan_ID = $row['ID'];
        $Scan_FirstName = $row['FirstName'];
        $Scan_MiddelName = $row['MiddelName'];
        $Scan_LastName = $row['LastName'];
        $Scan_Department = $row['Department'];
        $Scan_Date = $row['Date'];
        $Scan_Start = $row['Start'];
        $Scan_Start_Break = $row['Start_Break'];
        $Scan_End_Break = $row['End_Break'];
        $Scan_End = $row['End'];


        return array($Scan_ID,
            $Scan_FirstName,
            $Scan_MiddelName,
            $Scan_LastName,
            $Scan_Department,
            $Scan_Date,
            $Scan_Start,
            $Scan_Start_Break,
            $Scan_End_Break,
            $Scan_End);
    }

    public function get_not_Scaned_employee($Department, $Scan_Date) {


        $NotScanIDStack = array();
        $ID_employee = $this->get_employee($Department);

        $Date = $this->get_not_Scaned_Date($Department, $Scan_Date, $Scan_Date);

        if (!(mysql_num_rows(mysql_query("SELECT Date FROM `attendance_sheet` 
                where Department='" . $Department . "' and Date='" . $Scan_Date . "'")))) {
            array_push($Date, $Scan_Date);
        }


        if (is_array($ID_employee) and is_array($Date)) {


            foreach ($Date as $Datevalue) {

                foreach ($ID_employee as $Not_Scanned_IDValue) {


                    $Scaned_ID_Stack = $this->get_Scaned_employee($Department, $Datevalue);


                    if (!( in_array($Not_Scanned_IDValue, $Scaned_ID_Stack))) {

                        array_push($NotScanIDStack, $Not_Scanned_IDValue);
                    }
                }
            }
            return $NotScanIDStack;
        }
        else
            return false;
    }

    public function get_offday($ID, $Date) {

        $sqlOffDay = "SELECT * FROM `Employee_Offday` where ID='" . $ID . "' AND From_Date<='" . $Date . "' AND To_Date>='" . $Date . "'";

        $result = mysql_query($sqlOffDay);

        if (mysql_num_rows($result)) {

            $row = mysql_fetch_array($result, MYSQL_ASSOC);
            $Off_Day = $row['Off_Day'];
        } else {
            $Off_Day = "Sunday";
        }

        return $Off_Day;
    }

    public function get_Holyday($Date) {

        $sqlHD = "SELECT Holyday_Name FROM `Holyday_Definition` where Date='" . $Date . "'";
        $resultHD = mysql_query($sqlHD); //or die(mysql_error());

        if (mysql_num_rows($resultHD)) {

            $rowHD = mysql_fetch_array($resultHD, MYSQL_ASSOC);

            $Holday_Name = $rowHD['Holyday_Name'];

            return $Holday_Name;
        }
        else
            return "Not Holyday";
    }

    public function get_leave($ID, $Date) {

        $sql = "SELECT * FROM `total_leave_taken_dates` where ID='" . $ID . "' and Leave_Taken_Date<='" . $Date . "' and ReportOn > '" . $Date . "'";

        $result = mysql_query($sql);

        if (mysql_num_rows($result)) {

            $row = mysql_fetch_array($result, MYSQL_ASSOC);

            $LeaveType = $row['LeaveType'];
        } else {
            $LeaveType = "Not On Leave";
        }

        return $LeaveType;
    }

    public function is_date($str) {
        $stamp = strtotime($str);

        if (!is_numeric($stamp)) {
            return FALSE;
        }
        $month = date('m', $stamp);
        $day = date('d', $stamp);
        $year = date('Y', $stamp);

        if (checkdate($month, $day, $year)) {
            return TRUE;
        }

        return FALSE;
    }

    public function get_definition_data($ID, $Definition) {

        foreach ($Definition as $key => $value) {

            if ($value['ID'] == $ID)
                return $value['Definition'];
        }
    }

    public function Attendance_Allocation($Department, $From_Date, $To_Date, $operation = NULL) {


        $Date_Rage = $this->get_Date_Range($From_Date, $To_Date);

        $employeeIDlist = $this->get_employee_list($Department);

        echo "<table class=\"Attendance_allocation\" align=\"center\"  border=\"1\">";

        echo "<thead>";

        echo "<th>ID </th>";
        echo "<th>Emplyee FullName </th>";
        echo "<th>Department </th>";

        echo "<th>Date </th>";

        echo "<th>Start </th>";
        echo "<th>Scan Start </th>";

        echo "<th>Start Break </th>";
        echo "<th>Scan Start Break </th>";

        echo "<th>First Session Start HR </th>";
        echo "<th>First Session End HR </th>";
        echo "<th>First Session HR </th>";


        echo "<th>End Break </th>";
        echo "<th>Scan End Break </th>";

        echo "<th>End </th>";
        echo "<th>Scan End </th>";

        echo "<th>Second Session Start HR </th>";
        echo "<th>Second Session End HR </th>";
        echo "<th>Second Session HR </th>";


        echo "<th>Total Working HR </th>";

        echo "<th>Day OT HR </th>";
        echo "<th>Day OT Max HR </th>";
        echo "<th>Night OT HR </th>";
        echo "<th>Night OT Max HR </th>";
        echo "<th>Sunday(Offday) OT HR </th>";
        echo "<th>Holyday OT HR </th>";
        echo "<th> Offday </th>";
        echo "<th> Absent Hour</th>";
        echo "<th>Employee Status</th>";

        echo "</thead>";

        echo "<tbody>";



        foreach ($Date_Rage as $Date_Ragevalue) {


            $scanEmployeeList = $this->get_Scaned_employee($Department, $Date_Ragevalue);


            $workingTimeDefinitionList = $this->get_working_time_setting($employeeIDlist, $Date_Ragevalue);


            $OTDefinitionList = $this->get_employee_OT_definition($employeeIDlist, $Date_Ragevalue);


            foreach ($employeeIDlist as $key => $employeeIDvalue) {

                $workingTimeDefinition = $this->get_definition_data($employeeIDvalue, $workingTimeDefinitionList);

                $OTDefinition = $this->get_definition_data($employeeIDvalue, $OTDefinitionList);


                //    $workingTimeDefinition = $this->get_working_time_setting($Department, $Date_Ragevalue, $employeeIDvalue);
                // $OTDefinition = $this->get_employee_OT_definition($employeeIDvalue, $Department, $Date_Ragevalue);


                if (( in_array($employeeIDvalue, $scanEmployeeList))) {


                    $scanData = $this->get_Scan_data($employeeIDvalue, $Date_Ragevalue);


                    $this->generate_attendance_allocation($scanData, $workingTimeDefinition, $OTDefinition, $operation);
                } else {

                    /*
                     * 
                     * 
                     * This code is done for missed snap shot case when it is available
                     * 

                      $CHK_missed_snapshot = $this->get_snapshot_missed_employee($employeeIDvalue, $Department, $Date_Ragevalue);

                      if ($CHK_missed_snapshot) {  //Check weather the employee is in missed snaphost or not
                      list($IDS, $DateS, $Scan_Start, $Scan_Start_Break, $Scan_End_Break,
                      $Scan_End, $DepartmentS) = $this->get_default_working_hour($Department, $Date_Ragevalue, $employeeIDvalue);

                      $Not_Scan_Start = $Scan_Start;
                      $Not_Scan_Start_Break = $Scan_Start_Break;
                      $Not_Scan_End_Break = $Scan_End_Break;
                      $Not_Scan_End = $Scan_End;
                      } else {
                     * 
                     * 
                     * 
                     */

                    $Not_Scan_ID = $employeeIDvalue;

                    list($Not_Scan_FirstName, $Not_Scan_MiddelName, $Not_Scan_LastName
                            , $Not_Scan_Department) = $this->get_employee_Detail($employeeIDvalue);


                    $Not_Scan_Start = NULL;
                    $Not_Scan_Start_Break = NULL;
                    $Not_Scan_End_Break = NULL;
                    $Not_Scan_End = NULL;


                    $notScanData = array($Not_Scan_ID, $Not_Scan_FirstName, $Not_Scan_MiddelName, $Not_Scan_LastName, $Not_Scan_Department,
                        $Date_Ragevalue, $Not_Scan_Start, $Not_Scan_Start_Break, $Not_Scan_End_Break, $Not_Scan_End);


                    $this->generate_attendance_allocation($notScanData, $workingTimeDefinition, $OTDefinition, $operation);
                }
            }
        }
        echo "</tbody>";

        echo "</table>";
    }

//    public function Attendance_Allocation($Department, $From_Date, $To_Date, $operation = NULL) {
//
//
//
//        $Date_Rage = $this->get_Date_Range($From_Date, $To_Date);
//
//
//        $Not_Scaned_Date = $this->get_not_Scaned_Date($Department, $From_Date, $To_Date);
//
//        echo "<table class=\"Attendance_allocation\" align=\"center\"  border=\"1\">";
//
//        echo "<thead>";
//
//        echo "<th>ID </th>";
//        echo "<th>Emplyee FullName </th>";
//        echo "<th>Department </th>";
//
//        echo "<th>Date </th>";
//
//
//
//        echo "<th>Start </th>";
//        echo "<th>Scan Start </th>";
//
//        echo "<th>Start Break </th>";
//        echo "<th>Scan Start Break </th>";
//
//        echo "<th>First Session Start HR </th>";
//        echo "<th>First Session End HR </th>";
//        echo "<th>First Session HR </th>";
//
//
//
//
//        echo "<th>End Break </th>";
//        echo "<th>Scan End Break </th>";
//
//        echo "<th>End </th>";
//        echo "<th>Scan End </th>";
//
//        echo "<th>Second Session Start HR </th>";
//        echo "<th>Second Session End HR </th>";
//        echo "<th>Second Session HR </th>";
//
//
//
//        echo "<th>Total Working HR </th>";
//
//        echo "<th>Day OT HR </th>";
//        echo "<th>Day OT Max HR </th>";
//        echo "<th>Night OT HR </th>";
//        echo "<th>Night OT Max HR </th>";
//        echo "<th>Sunday(Offday) OT HR </th>";
//        echo "<th>Holyday OT HR </th>";
//        echo "<th> Offday </th>";
//        echo "<th> Absent Hour</th>";
//        echo "<th>Employee Status</th>";
//
//        echo "</thead>";
//
//        echo "<tbody>";
//
//        foreach ($Date_Rage as $Date_Ragevalue) {
//
//            $sqlOT = "SELECT * FROM `Attendance_Sheet` 
//          where Department='" . $Department . "' AND
//              `Date` = '" . $Date_Ragevalue . "' AND ID <>'SH-New' ORDER BY Department,Date,ID"; //
//
//            if (!(mysql_num_rows(mysql_query("SELECT Date FROM `attendance_sheet` 
//                where Department='" . $Department . "' and Date='" . $Date_Ragevalue . "'")))) {
//                array_push($Not_Scaned_Date, $Date_Ragevalue);
//            }
//
//           
//
//
//            if (( in_array($Date_Ragevalue, $Not_Scaned_Date))) {
//
//
//                $NotScanIDStack = $this->get_not_Scaned_employee($Department, $Date_Ragevalue);
//                
//               
//                //print_r(NotScanIDStack);
//                if ($NotScanIDStack) {
//
//                    foreach ($NotScanIDStack as $Not_Scanned_IDValue) {
//
//
//                        list($Not_Scan_FirstName, $Not_Scan_MiddelName, $Not_Scan_LastName, $Not_Scan_Department) = $this->get_employee_Detail($Not_Scanned_IDValue);
//
//
//                        $Not_Scan_Start = NULL;
//                        $Not_Scan_Start_Break = NULL;
//                        $Not_Scan_End_Break = NULL;
//                        $Not_Scan_End = NULL;
//
//                        $CHK_missed_snapshot = $this->get_snapshot_missed_employee($Not_Scanned_IDValue, $Not_Scan_Department, $Date_Ragevalue);
//
//                        if ($CHK_missed_snapshot) {
//                            list($IDS, $DateS, $Scan_Start, $Scan_Start_Break, $Scan_End_Break,
//                                    $Scan_End, $DepartmentS) = $this->get_default_working_hour($Not_Scan_Department, $Date_Ragevalue, $Not_Scanned_IDValue);
//
//                            $Not_Scan_Start = $Scan_Start;
//                            $Not_Scan_Start_Break = $Scan_Start_Break;
//                            $Not_Scan_End_Break = $Scan_End_Break;
//                            $Not_Scan_End = $Scan_End;
//                        } else {
//                            $Not_Scan_Start = NULL;
//                            $Not_Scan_Start_Break = NULL;
//                            $Not_Scan_End_Break = NULL;
//                            $Not_Scan_End = NULL;
//                        }
//
//                        $this->generate_attendance_allocation($Not_Scanned_IDValue, $Not_Scan_Department, $Date_Ragevalue, $Not_Scan_Start, $Not_Scan_Start_Break, $Not_Scan_End_Break, $Not_Scan_End, $operation);
//                    }
//                }
//            }
//
//
//
//
//            $resultOT = mysql_query($sqlOT);
//
//
//            while ($rowOT = mysql_fetch_array($resultOT, MYSQL_ASSOC)) {
//
//
//                $Scan_ID = $rowOT['ID'];
//                $Scan_FirstName = $rowOT['FirstName'];
//                $Scan_MiddelName = $rowOT['MiddelName'];
//                $Scan_LastName = $rowOT['LastName'];
//                $Department = $rowOT['Department'];
//                $Scan_Date = $rowOT['Date'];
//                $Scan_Start = $rowOT['Start'];
//                $Scan_Start_Break = $rowOT['Start_Break'];
//                $Scan_End_Break = $rowOT['End_Break'];
//                $Scan_End = $rowOT['End'];
//                $Scan_Department = $rowOT['Department'];
//
//                $this->generate_attendance_allocation($Scan_ID, $Scan_Department, $Scan_Date, $Scan_Start, $Scan_Start_Break, $Scan_End_Break, $Scan_End, $operation);
//            }
//        }
//        echo "</tbody>";
//
//        echo "</table>";
//    }


    function get_snapshot_missed_employee($ID, $Department, $Date) {

        /* Selecting snapshot missed worker employee */
        $queryS = "SELECT * FROM `snapshot_missed_employee`
 where ID='" . $ID . "' and Date='" . $Date . "'"; // AND Department='" . $Department . "'";
        //echo '<hr>'.$queryS;
        $resultS = mysql_query($queryS);

        if (mysql_num_rows($resultS)) {

            $rowS = mysql_fetch_array($resultS, MYSQL_ASSOC);

            return true;
        }
        else
            return false;
    }

    function get_default_working_hour($Department, $Date, $ID) {

        list($Department, $Start, $Start_Break, $End_Break, $End, $Working_Hour, $Working_Hour_Hold) = $this->get_working_time_setting($Department, $Date, $ID);

        list($ID, $DayOT, $NightOT, $SundayOT, $HolydayOT,
                $DayOT_MaxHR, $NightOT_MaxHR, $DayOT_Start, $NightOT_Start, $NightOT_End) = $this->get_employee_OT_definition($ID, $Department, $Date);

        if ($Start != "00:00:00") {

            $Scan_Start = $Start;

            if ($Start_Break != "00:00:00") {
                $Scan_Start_Break = $Start_Break;
            } else {
                $Scan_Start_Break = '';
            }


            if ($End_Break != "00:00:00") {
                $Scan_End_Break = $End_Break;
            } else {
                $Scan_End_Break = '';
            }

            if ($End != "00:00:00") {
                $Scan_End = $End;
            } else {
                if (($End_Break == "00:00:00") or ($Start_Break == "00:00:00")) {

                    $Scan_End = $this->time_add($Working_Hour_Hold, $Start);
                } else {
                    $FirstS = $this->time_add($Start, $Start_Break); //first session

                    $SecondS = $this->time_diff($Working_Hour_Hold, $FirstS); //second session total

                    $Scan_End = $this->time_add($SecondS, $End_Break);
                }
            }
        } else {
            $Scan_Start = "07:00:00";
            $Scan_Start_Break = $this->time_add("05:00:00", $Scan_Start);

            $Scan_End_Break = $this->time_add($Scan_Start_Break, "01:00:00");

            $Scan_End = $this->time_add($Scan_End_Break, "03:00:00");
        }

        if (trim(strtoupper($DayOT)) == 'Y') {

            $Scan_End = $this->time_add($Scan_End, $DayOT_MaxHR);
        }

        return array($ID, $Date, $Scan_Start, $Scan_Start_Break, $Scan_End_Break,
            $Scan_End, $Department);
    }

    function generate_attendance_allocation($scanData, $workingTimeDefinition, $OTDefinition, $operation = NULL) {
        $Status = '';

        list($Scan_ID, $Scan_FirstName, $Scan_MiddelName, $Scan_LastName, $Scan_Department,
                $Scan_Date, $Scan_Start, $Scan_Start_Break, $Scan_End_Break, $Scan_End) = $scanData;

        list($Department, $Start, $Start_Break, $End_Break, $End, $Working_Hour, $Working_Hour_Hold) = $workingTimeDefinition;


        list($ID, $DayOT, $NightOT, $SundayOT, $HolydayOT,
                $DayOT_MaxHR, $NightOT_MaxHR, $DayOT_Start, $NightOT_Start, $NightOT_End) = $OTDefinition;


        if (($Scan_Start == NULL) and ($Scan_Start_Break == NULL) and ($Scan_End_Break == NULL) and ($Scan_End == NULL)) {

            $First_Session_Start = "00:00:00";
            $First_Session_End = "00:00:00";
            $First_Session_HR = "00:00:00";
            $Second_Session_Start = "00:00:00";
            $Second_Session_End = "00:00:00";
            $Second_Session_HR = "00:00:00";
            $WorkingHR = "00:00:00";

            $DayOTHR = "";
            $NightOTHR = "";
            $SundayOTHR = "";
            $HolydayOTHR = "";
        } else {

            list($First_Session_Start, $First_Session_End, $First_Session_HR, $Second_Session_Start, $Second_Session_End, $Second_Session_HR, $WorkingHR) = $this->Working_Hour($scanData, $workingTimeDefinition, $late_tolerance = "TRUE");

            list($DayOTHR, $NightOTHR, $SundayOTHR, $HolydayOTHR) = $this->OT($scanData, $workingTimeDefinition, $OTDefinition, $round = "TRUE");
        }


        $LeaveType = trim(strtoupper($this->get_leave($Scan_ID, $Scan_Date)));

        $Off_Day = trim(strtoupper($this->get_offday($Scan_ID, $Scan_Date)));

        $Day_of_Scan_Date = trim(strtoupper(date("l", strtotime($Scan_Date))));

        $Holday_Name = trim(strtoupper($this->get_Holyday($Scan_Date)));


        if (($Off_Day == $Day_of_Scan_Date) && ($Holday_Name == trim(strtoupper("Not Holyday")))) {

            $SundayOTHR = $WorkingHR;

            $WorkingHR = "00:00:00";
        }


        if (trim(strtoupper($LeaveType)) == trim(strtoupper("Not On Leave"))) {

            if (($WorkingHR == "" ) and ($SundayOTHR == "" ) and ($HolydayOTHR == "" ) and ($Off_Day != $Day_of_Scan_Date) and ($Holday_Name == trim(strtoupper("Not Holyday")))) {

                $date_employement = $this->get_employee_Detail_DE($ID);

                if ($Scan_Date == $date_employement) {
                    $WorkingHR = "08:00:00";
                    $AbsentHR = '00:00:00';
                    $Status = "Recruited Date";
                } else
                if ($Scan_Date < $date_employement) {
                    $WorkingHR = "00:00:00";
                    $AbsentHR = '08:00:00';
                    $Status = "Not Recruited";
                } else {
                    $Status = "Absent";
                }
            } else if ($HolydayOTHR != "") {
                $Status = "Holy Day";
                $WorkingHR = $Working_Hour_Hold;
            } else {
                $Status = "";
            }
        } else
        if (trim(strtoupper($LeaveType)) == trim(strtoupper("Special Leave Without Payment"))) {
            $WorkingHR = "00:00:00";
            $AbsentHR = '08:00:00';
        } else
        if (($Off_Day != $Day_of_Scan_Date)) {

            if (isset($LeaveType)) {
                $Status = $LeaveType;
            }

            $WorkingHR = "00:00:00";
        }


        if (($SundayOTHR > "00:00:00")) {
            $WorkingHR = "00:00:00";
        }

        /*         * ******************************** */


        if (trim(strtoupper(substr($Scan_Department, 9, 9))) == trim(strtoupper('Cold Room'))) {

            if (($WorkingHR > $Working_Hour)) {
                $WorkingHR = $Working_Hour_Hold;
            }
        }
        /*         * ***************************** */


        /*         * ************this part of code is needed for snapshot missed  to insert maxmum OT assign in that date
         * 

          $CHK_missed_snapshot = $this->get_snapshot_missed_employee($Scan_ID, $Scan_Department, $Scan_Date);

          if ($CHK_missed_snapshot) {

          if (trim(strtoupper($DayOT)) == 'Y') {

          $DayOTHR = $DayOT_MaxHR;
          }
          if (trim(strtoupper($NightOT)) == 'Y') {
          $NightOTHR = $NightOT_MaxHR;
          }
          }

         * *************** */



        if ($HolydayOTHR > "08:00:00") {

            if (trim(strtoupper(substr($Scan_Department, 0, 7))) == trim(strtoupper('Grading'))) {
                $HolydayOTHR = $this->time_diff($Scan_End, "08:30:00");
                if ($HolydayOTHR < "08:00:00") {
                    $HolydayOTHR = "08:00:00";
                }
            }
            /*             * ********************** */
            if ($HolydayOTHR > "20:00:00") {
                $HolydayOTHR = $this->time_diff($HolydayOTHR, "15:00:00");
            }
            /*             * ****************** */
        }


        echo "<tr align=\"right\">";
        echo "<td>" . $Scan_ID . " </td>";
        echo "<td>" . $Scan_FirstName . " " . $Scan_MiddelName . " " . $Scan_LastName . "</td>";
        echo "<td>" . $Scan_Department . "</td>";

        echo "<td>" . $Scan_Date . " </td>";

        echo "<td>" . $Start . " </td>";
        echo "<td bgcolor=\"#DCEEF4\">" . $Scan_Start . "</td>";

        echo "<td>" . $Start_Break . " </td>";
        echo "<td bgcolor=\"#DCEEF4\">" . $Scan_Start_Break . "</td>";

        echo "<td bgcolor=\"#FFFF00\">" . $First_Session_Start . "</td>";
        echo "<td bgcolor=\"#FFFF00\">" . $First_Session_End . "</td>";

        echo "<td bgcolor=\"#CCCCCC\" >" . $First_Session_HR . "</td>";

        /*         * ***** for printing ********** */
        // echo "</tr><tr>";
        /*         * ******************** */
        echo "<td>" . $End_Break . " </td>";
        echo "<td bgcolor=\"#DCEEF4\">" . $Scan_End_Break . "</td>";

        echo "<td>" . $End . " </td>";
        echo "<td bgcolor=\"#DCEEF4\">" . $Scan_End . "</td>";

        echo "<td bgcolor=\"#FFFF00\">" . $Second_Session_Start . "</td>";
        echo "<td bgcolor=\"#FFFF00\">" . $Second_Session_End . "</td>";

        echo "<td bgcolor=\"#CCCCCC\">" . $Second_Session_HR . "</td>";

        echo "<td bgcolor=\"#FF6600\">" . $WorkingHR . "</td>";

        echo "<td>" . $DayOTHR . "</td>";
        echo "<td>" . $DayOT_MaxHR . "</td>";
        echo "<td>" . $NightOTHR . "</td>";
        echo "<td>" . $NightOT_MaxHR . "</td>";
        echo "<td>" . $SundayOTHR . "</td>";
        echo "<td>" . $HolydayOTHR . "</td>";



        if (($Off_Day == $Day_of_Scan_Date)) {
            echo "<td  bgcolor=\"#33FF99\" align=\"justify\">Off-" . $Off_Day . "</td>";
            $Status = "Off-Day";
        } else {
            echo "<td></td>";
        }


        /*         * **************Absent Hour*********************** */
        if ((($WorkingHR == "") or ($WorkingHR < $Working_Hour)) and
                ($Off_Day != $Day_of_Scan_Date) and (($Status == "") or ($Status == "Absent") or ($Status == "Not Recruited")) and
                ($HolydayOTHR == "" ) and ($Holday_Name == trim(strtoupper("Not Holyday")))) {
            if ($WorkingHR == "") {
                $WorkingHR = "00:00:00";
            }

            $AbsentWHR = $this->time_diff($Working_Hour, $WorkingHR);



            if ($this->hour2sec($Working_Hour) != 0)
                $AbsentHRsec = round($this->hour2sec($Working_Hour_Hold) * $this->hour2sec($AbsentWHR) / $this->hour2sec($Working_Hour));
            else
                $AbsentHRsec = "00:00:00";



            $AbsentHR = $this->sec2hour($AbsentHRsec);
            echo "<td bgcolor=\"#FF0000\">" . $AbsentHR . "</td>";
        } else {
            $AbsentHR = "";
            echo "<td ></td>";
        }

        /*         * *********************************** */


        if ($Status == "Absent")
            echo "<td bgcolor=\"#FF0000\">" . $Status . "</td>";
        else
        if ($Status != "")
            echo "<td bgcolor=\"#66FFCC\" >" . $Status . "</td>";
        else
            echo "<td >" . $Status . "</td>";

        echo "</tr>";


        /*         * ************************ */

        if ($WorkingHR == "")
            $WorkingHR = '00:00:00';

        if ($DayOTHR == "")
            $DayOTHR = '00:00:00';


        if ($NightOTHR == "")
            $NightOTHR = '00:00:00';

        if ($SundayOTHR == "")
            $SundayOTHR = '00:00:00';


        if ($HolydayOTHR == "")
            $HolydayOTHR = '00:00:00';

        if ($AbsentHR == "")
            $AbsentHR = '00:00:00';

        /*         * *********************** */


        $updateSQL = "Delete From `Attendance_Allocation` WHERE ID='" . $ID . "' AND Date='" . $Scan_Date . "'";
        mysql_query($updateSQL) or die(mysql_error());





        $sqlINSRT = "INSERT INTO `Attendance_Allocation` 
        (`ID`,`FirstName`,`MiddelName`,`LastName`,`Department`,`Date`,
`Start`,`Scan_Start`,`Start_Break`,`Scan_Start_Break`,`First_Session_Start`,`First_Session_End`,`First_Session_HR`,
`End_Break`,`Scan_End_Break`,`End`,`Scan_End`,`Second_Session_Start`,`Second_Session_End`,`Second_Session_HR`,
`WorkingHR`,`DayOTHR`,`DayOT_MaxHR`,`NightOTHR`,`NightOT_MaxHR`,`SundayOTHR`,`HolydayOTHR`,`Off_Day`,`AbsentHR`,`Status`)                
   VALUES ('" . $Scan_ID . "','" . $Scan_FirstName . "','" . $Scan_MiddelName . "','" . $Scan_LastName . "','" . $Scan_Department .
                "','" . $Scan_Date . "','" . $Start . "','" . $Scan_Start . "','" . $Start_Break . "','" . $Scan_Start_Break . "','" .
                $First_Session_Start . "','" . $First_Session_End . "','" . $First_Session_HR . "','" . $End_Break . "','" . $Scan_End_Break .
                "','" . $End . "','" . $Scan_End . "','" . $Second_Session_Start . "','" . $Second_Session_End . "','" . $Second_Session_HR .
                "','" . $WorkingHR . "','" . $DayOTHR . "','" . $DayOT_MaxHR . "','" . $NightOTHR . "','" . $NightOT_MaxHR . "','" .
                $SundayOTHR . "','" . $HolydayOTHR . "','" . $Off_Day . "','" . $AbsentHR . "','" . $Status . "')";


        mysql_query($sqlINSRT) or die(mysql_error());
    }

    function Run_Attendance_Allocation() {
        $Department = $this->get_department_list();
    }

    public function get_Attendance_Allocation_list() {
        /* Selecting only those in the same month and half year worker employee */
        $queryOT = "SHOW TABLES FROM `thekeyhrmsdb`";

        $resultOT = mysql_query($queryOT);

        echo "<select id=\"Attendace_Allocation\" onchange=\"SelectedAttendance(document.getElementById('Attendace_Allocation'),'Please Choose Attendance First')\">";
        echo "<option>Select Attendance	</option>";
        echo "<option value=\"Attendance_Allocation\">Current Month</option>";
        while ($rowOT = mysql_fetch_array($resultOT, MYSQL_ASSOC)) {

            if (substr(strtoupper($rowOT['Tables_in_thekeyhrmsdb']), 0, 18) == strtoupper("Attendance_Summary")) {

                echo "<option value=\"{$rowOT['Tables_in_thekeyhrmsdb']}\">";

                $year_month = strtoupper(substr($rowOT['Tables_in_thekeyhrmsdb'], 19));

                echo "$year_month</option>";
            }
        }

        echo "</select>";
    }

    public function Attendance_Summary($TableName, $Department, $From_Date, $To_Date) {
        echo '<hr>';
        $date_dif = round((strtotime($To_Date) - strtotime($From_Date)) / 86400, 0);
          $date_dif++;
        //echo '<hr>'.$date_dif;
        if ($TableName == 'Attendance_Allocation') {
            $sqlAL1 = file_get_contents('../sql/Biometric_Total_Attendance_SummaryAL.sql');

            // if ($date_dif > 23) {
            //     $date_dif = 23;
            //   }
            $sqlAL = preg_replace('/working_day_val/', $date_dif, $sqlAL1);
            if (!$sqlAL) {
                die('Error opening file Biometric_Total_Attendance_Summary.sql Check its Existance');
            } else {
                //$sqlAL = "(" . $sqlAL . ") as sqlAS ";

                $dip_filter = '';
                if (is_array($Department)) {
                    foreach ($Department as $dep_key => $dep_value) {
                        $filter = "attendance_allocation.`Department`='" . $dep_value . "'";
                        if (!$dip_filter == '') {
                            $dip_filter .= ' or ' . $filter;
                        } else {
                            $dip_filter = $filter;
                        }
                    }
                } else {
                    $dip_filter = "attendance_allocation.`Department`='" . $Department . "'";
                }



                $sqlAL = $sqlAL . " 
                WHERE (" . $dip_filter . ")  and attendance_allocation.`Date`>= '" . $From_Date . "'  and attendance_allocation.`Date`<='" . $To_Date . "'
                         AND `attendance_allocation`.`FirstName`<> ''
                   
                        Group By attendance_allocation.ID 
                        having (Total_Working_Day+Total_Leave_Days>0)
                        Order By attendance_allocation.Department,IDNO";
            }
            //Having (Total_Working_Day!=0 or Total_Leave_Days!=0)
            //  $sqlAS = "SELECT * FROM $sql where `Department`= '" . $Department . "' and `Date`>= '" . $From_Date . "'  and `Date`<='" . $To_Date . "'";

            $sqlAS = $sqlAL;
        } else {
            $sqlAS = "SELECT * FROM $TableName where `Department`= '" . $Department . "' and `Date`>= '" . $From_Date . "' and `Date`<='" . $To_Date . "'";
        }

        // echo '<hr>'.$sqlAS;
        // die();
        
        
          $_SESSION['AttendanceSummarySql'] =$sqlAS;
          
        $resultAS = mysql_query($sqlAS);




        $this->get_company_header('Employee Time Sheet');


        echo "<table id=\"Attendance_Summary\"   class=\"Attendance_Summary\" align=\"center\"  border=\"1\">";
        echo "<th>S.No</th>
            <th>ID</th>
<th>First Name</th>
<th>Middel Name</th>
<th>Last Name</th>
<th>Department</th>
<th>Working Day</th>
<th>Leave Day</th>
<th>Day OT</th>
<th>Night OT</th>
<th>Off-Day OT</th>

<th>HolyDay OT</th>";
        $count = 0;
        $numrows = mysql_numrows($resultAS);
        while ($rowAS = mysql_fetch_array($resultAS, MYSQL_ASSOC)) {

            $count+=1;
            echo "<tr align=\"center\">";

            echo "<td>" . $count . "</td>";
            echo "<td>" . $rowAS['ID'] . "</td>";
            echo "<td>" . $rowAS['FirstName'] . "</td>";
            echo '<td>' . $rowAS['MiddelName'] . "</td> ";
            echo '<td>' . $rowAS['LastName'] . "</td>";
            echo "<td>" . $rowAS['Department'] . "</td>";
//            echo "<td>" . $rowAS['From_Date'] . "</td>";
//            echo "<td>" . $rowAS['To_Date'] . "</td>";
//            echo "<td>" . $rowAS['Total_Working_Hour'] . "</td>";
//            echo "<td>" . $rowAS['Total_Working_Day'] . "</td>";
//            echo "<td>" . $rowAS['Total_Absent_Hour'] . "</td>";
//            echo "<td>" . $rowAS['Total_Absent_Day'] . "</td>";
            echo "<td>" . $rowAS['Working_Day'] . "</td>";
            echo "<td>" . $rowAS['Total_Leave_Days'] . "</td>";
            echo "<td>" . $rowAS['DayOT_Hour'] . "</td>";
            echo "<td>" . $rowAS['NightOT_Hour'] . "</td>";
            echo "<td>" . $rowAS['OffDayOT_Hour'] . "</td>";
            echo "<td>" . $rowAS['HolyDayOT_Hour'] . "</td>";

            echo "</tr>";

            if ($count == $numrows) {

                echo "</table>";
                echo '<p></p>';
                echo '<table>';
                echo '<tr>';
                echo '<td></td>';
                echo '<td width="400" ><b> Prepared By: ' . $rowAS['Prepared'];
                echo '</b></td>';
                echo '<td width="400"><b>  Department Manger: ' . $rowAS['Department_Manager'];
                echo '</b></td>';
                echo '<td width="400"><b>  Checked By: ' . $rowAS['Checked'];
                echo '</b></td>';
                echo '<td width="400"><b>  Approved By: ' . $rowAS['Approved'];
                echo '</b></td>';
                echo '</tr>';

                echo '<tr>';
                echo '<td></td>';
                echo '<td width="400" ><b>__________________________';
                echo '</b></td>';
                echo '<td width="400" ><b>__________________________';
                echo '</b></td>';
                echo '<td width="400" ><b>__________________________';
                echo '</b></td>';
                echo '<td width="400" ><b>__________________________';
                echo '</b></td>';
                echo '</tr>';
                echo '<tr><td></td><td></td><td align="right"><img  src="../images/thekeysoft.JPG"  height="25" width="80" /></td></tr>';
                echo "</table>";
            }
        }
    }

    public function copy_table($from, $to, $Department, $From_Date, $To_Date) {

        //$sql1 = "CREATE TABLE IF NOT EXISTS $to LIKE $from";
        if ($from == "Attendance_Allocation" or $from == "Attendance_Sheet") {
            $sql2 = "INSERT INTO $to SELECT * FROM $from where `Department`= '" . $Department . "' and `Date`>= '" . $From_Date . "' 
               and `Date`<='" . $To_Date . "'";
        }
        else
            $sql2 = "INSERT INTO $to $from ";


        // $success1 = mysql_query($sql1);


        $success2 = mysql_query($sql2);
        $success = $success2;


        return $success;
    }

      public function cleanData(&$str) {

        //escape tab characters
        $str = preg_replace("/\t/", "\\t", $str);
        // escape new lines
        $str = preg_replace("/\r?\n/", "\\n", $str);
//convert 't' and 'f' to boolean values 
        if ($str == 't')
            $str = 'TRUE';
        if ($str == 'f')
            $str = 'FALSE';
//force certain number/date formats to be imported as strings
//
//    if (preg_match("/^0/", $str) || preg_match("/^\+?\d{8,}$/", $str) || preg_match("/^\d{4}.\d{1,2}.\d{1,2}/", $str)) {
//        $str = "'$str";
//    }
//    
//escape fields that include double quotes 
        if (strstr($str, '"'))
            $str = '"' . str_replace('"', '""', $str) . '"';
    }

//// filename for download
    public function XL_Export($sql,$filename) {

        ob_clean();
        $filename = $filename. date('Ymd') . ".xls";
        header("Content-Disposition: attachment;filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");
        $flag = false;
        $result = mysql_query($sql) or die('Query failed!');
        while (false != ($row = mysql_fetch_assoc($result))) {
            if (!$flag) {
                // display field/column names as first row
                echo implode("\t", array_keys($row)) . "\r\n";
                $flag = true;
            }
            array_walk($row, array($this, 'cleanData'));
            echo implode("\t", array_values($row)) . "\r\n";
        }
        exit;
    }
    
    function export_to_csv($query, $show_only = array()) {


        $first_time = True;
        $nameStr = '';
        $filed_header = '';
        ob_clean();
        $first_line = true;
        while ($row = mysql_fetch_array($query)) {
            $new_line = TRUE;

            foreach ($row as $key => $value) {

                if (!isset($show_only[$key])) {
                    continue;
                }


                $value = trim($value);
                if (!is_numeric($key)) {
                    if ($first_time) {
                        if ($filed_header == '') {
                            $filed_header = ucwords(preg_replace('[_]', ' ', $key));
                        } else {
                            $filed_header .= "," . ucwords(preg_replace('[_]', ' ', $key));
                        }
                    }
                    if ($nameStr == '') {
                        $nameStr = $value;
                    } else {
                        if ($new_line && !$first_line) {
                            $nameStr .= $value;
                            $new_line = false;
                        } else {
                            $nameStr .= "," . $value;
                        }
                    }
                }
            }
            $first_line = false;
            $first_time = false;
            $nameStr.="\n";
        }
        if (!isset($header_lable)) {
            $header_lable = 'Thekeyhrms Excel Export';
        }

        header('Content-disposition: attachment; filename="' . $header_lable . '.csv"');
        header('Content-type: application/csv');
        echo $filed_header . "\n" . $nameStr;
        exit();
    }

    public function Summarize_Current_Attendance($SourceTable, $TableName, $Department, $From_Date, $To_Date) {
        /** Drop attendance_allocation if exist by the same month and year name* */
        // $queryDrop = "DROP TABLE IF EXISTS `Attendance_Allocation_" . $Year_Month . "`";
        //  $resultDrop = mysql_query($queryDrop);

        /* Creating summerize attendance allocation using selected year and month 
         * 1.Check wather exist or not 
         * 2 if not creat else insert or update the data
         * 
         */
        if ($SourceTable == "Attendance_Summary") {

            $sql = file_get_contents('../sql/Biometric_Total_Attendance_SummaryAL.sql');

            if (!$sql) {
                die('Error opening file');
            }

            $sqlCHK = "SELECT * FROM $TableName where `Department`= '" . $Department . "' and `Date`>= '" . $From_Date . "' 
               and `Date`<='" . $To_Date . "'";

            $resultCHK = mysql_query($sqlCHK);

            if (mysql_num_rows($resultCHK)) {
                $this->Attendance_Cleaner($TableName, $Department, $From_Date, $To_Date);
            } //else {

            $sql1 = "CREATE TABLE IF NOT EXISTS $TableName $sql Limit 0";

            $success1 = mysql_query($sql1);
            $sql = $sql . " where `attendance_allocation`.`Department`= '" . $Department . "' and `Date`>= '" . $From_Date . "' 
               and `Date`<='" . $To_Date . "' AND `attendance_allocation`.`FirstName`<> ''
                   Group By attendance_allocation.ID 
 Order By attendance_allocation.Department,IDNO";



            $result = $this->copy_table($sql, $TableName, $Department, $From_Date, $To_Date);
        } else {


            $sqlCHK = "SELECT * FROM $TableName where `Department`= '" . $Department . "' and `Date`>= '" . $From_Date . "' 
               and `Date`<='" . $To_Date . "'";

            $resultCHK = mysql_query($sqlCHK);

            if (mysql_num_rows($resultCHK)) {
                $this->Attendance_Cleaner($TableName, $Department, $From_Date, $To_Date);
            } else {
                $sql1 = "CREATE TABLE IF NOT EXISTS $TableName LIKE $SourceTable";
                $success1 = mysql_query($sql1);
            }

            $result = $this->copy_table($SourceTable, $TableName, $Department, $From_Date, $To_Date);
        }

        return $result;
    }

    public function run_slq_file() {


        $hostname_HRMS = "localhost";
        $database_HRMS = "ThekeyHRMSDB";
        $username_HRMS = "root";
        $password_HRMS = ""; //EWSadmin";//

        $mysqli = new mysqli($hostname_HRMS, $username_HRMS, $password_HRMS, $database_HRMS);

        if (mysqli_connect_error()) {
            die('Connect Error (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
        }

        echo 'Success... ' . $mysqli->host_info . "<br />";
        echo 'Retrieving dumpfile' . "<br />";

        $sql = file_get_contents('../sql/Biometric_Total_Attendance_Summary.sql');
        if (!$sql) {
            die('Error opening file');
        }

        echo 'processing file <br />';
        mysqli_multi_query($mysqli, $sql);

        echo 'done.';
        $mysqli->close();
    }

    public function Attendance_Scan_Sheet_Importer($Department, $From_Date, $To_Date) {

        $sql = "
            INSERT INTO `attendance_sheet`
           (`ID`, `FirstName`, `MiddelName`, `LastName`, `Department`, `Date`,
            `Start`, `Start_Break`, `End_Break`, `End`)
                SELECT Waarde AS ID,`user`.`Voornaam` AS FirstName,
                `user`.Tussenvoegsel AS MiddelName,
                `user`.`Achternaam` AS LastName,
                gg.`Omschrijving` AS Department,
                date(s.Datum) AS 'Date',TIME(s.starttijd) AS 'Start',
                TIME(s.StartPauze) AS Start_Break,TIME(s.EindPauze) AS End_Break,
                TIME(s.Eindtijd) AS End

                FROM identysoft.snapshot s 
                JOIN identysoft.user ON User.userID=S.UserID 
                JOIN identysoft.gebruikersgroep as gg ON gg.gebruikersgroepID=user.gebruikersgroepID
                JOIN identysoft.vrijveldwaarde v ON v.userid=user.userid

                WHERE  Voornaam!='NOT IN ThekeyHRMS' and  Fiat=1";

        $sql .=" and s.Datum>='" . $From_Date . "'";
        $sql .=" and  s.Datum<='" . $To_Date . "'";
        $sql .= " AND (";


        $first = true;
        if (is_array($Department)) {
            foreach ($Department as $key => $value) {
                if ($first) {
                    $sql .=' gg.`Omschrijving` LIKE \'%' . $value . '%\'';
                    $first = false;
                }
                else
                    $sql .=' or gg.`Omschrijving` LIKE \'%' . $value . '%\'';
            }
        }
        else {
            $sql .=' gg.`Omschrijving` LIKE \'%' . $Department . '%\'';
        }


        $sql .= " )
                 AND v.vrijveldid='8951c7d4-d6a7-4db2-a201-b29fe37b4787'
                 AND Waarde<>'SH-Blocked'  ORDER BY Department,ID,Date;            
             ";


//echo '<hr>'.$sql;and Tussenvoegsel!='' 


        $resultAS = mysql_query($sql);

        if ($resultAS)
            echo "<script type = \"text/javascript\"> alert('Attendance Scan Sheet Imported for $Department from $From_Date to $To_Date Successfully.')</script>";
        else
            echo "<script type = \"text/javascript\"> alert('Attendance Scan Sheet Not Imported for $Department from $From_Date to $To_Date Successfully.')</script>";
    }

    public function Attendance_Cleaner($TableName, $Department, $From_Date, $To_Date) {



        $sqlCL = "Delete from $TableName where
            `Department`= '" . $Department . "' and `Date`>= '" . $From_Date . "' 
               and `Date`<='" . $To_Date . "'";


        $resultCL = mysql_query($sqlCL);

        return $resultCL;
    }

    public function get_company_header($header_info) {
        $sqlCS = "SELECT * FROM company_settings";

        $resultCS = mysql_query($sqlCS) or die(mysql_error());

        $rowCS = mysql_fetch_array($resultCS);

        $Equipment_Picture_Path = $rowCS['Equipment_Picture_Path'];
        $Company_Name = $rowCS['Company_Name'];
        $Logo_Path = $rowCS['Logo_Path'];
        $Logo_Height = $rowCS['Logo_Height'];
        $Logo_Width = $rowCS['Logo_Width'];
        $Company_Telphone = $rowCS['Company_Telphone'];
        $Company_Email = $rowCS['Company_Email'];
        $Web_Site = $rowCS['Web_Site'];
        $Company_POBOX = $rowCS['Company_P.O.BOX'];
        $Company_Fax = $rowCS['Company_Fax'];
        $Company_City = $rowCS['Company_City'];
        $Company_Country = $rowCS['Company_Country'];



        echo' <table  >';
        echo '<tr>';
        if ($Logo_Width < 650) {
            echo '<td><img  src="../images/' . $Logo_Path . '"  height="' . $Logo_Height . '" width="' . $Logo_Width . '" /></td>';
        }
        echo '<td> ';
        echo $Company_Name . '<br />';
        echo '  ' . $Company_POBOX . '<br/>';
        echo '  ' . $Company_City . '<br />';
        echo '  ' . $Company_Country . '<br />';
        echo '</td>';
        echo '<td>';
        echo 'Tel. ' . $Company_Telphone . '<br />';
        echo ' Fax:  ' . $Company_Fax . '<br />';
        echo ' email: ' . $Company_Email . '<br />';
        echo $Web_Site . '</td>';
        echo '<td><font color="orange" size="3"><b>' . $header_info . '</b></font></td>';

        if ($Logo_Width >= 650) {
            echo '<td><img  src="../images/' . $Logo_Path . '"  height="' . $Logo_Height . '" width="' . $Logo_Width . '" /></td>';
        }

        echo ' </tr>';
        echo ' </table>';
    }

    public function get_Company_Setting() {
        $queryCS = "SELECT * FROM `company_settings`";
        if (mysql_num_rows(mysql_query($queryCS))) {
            $resultCS = mysql_query($queryCS);

            $rowCS = mysql_fetch_array($resultCS);

            $Company_Name = $rowCS['Company_Name'];
            $Logo_Path = $rowCS['Logo_Path'];
            $Logo_Height = $rowCS['Logo_Height'];
            $Logo_Width = $rowCS['Logo_Width'];
            $Company_Telphone = $rowCS['Company_Telphone'];
            $Company_Email = $rowCS['Company_Email'];
            $Web_Site = $rowCS['Web_Site'];
            $Company_POBOX = $rowCS['Company_P.O.BOX'];
            $Company_Fax = $rowCS['Company_Fax'];
            $Company_City = $rowCS['Company_City'];
            $Company_Country = $rowCS['Company_Country'];
            $Equipment_Picture_Path = $rowCS['Equipment_Picture_Path'];
            $Annual_Leave_Expiry_Year = $rowCS['Annual_Leave_Expiry_Year'];
            $Annual_Leave_Initial_Days = $rowCS['Annual_Leave_Initial_Days'];
            $Annual_Leave_CONST_Year = $rowCS['Annual_Leave_CONST_Year'];

            $Attendance_Opening_Date = $rowCS['Attendance_Opening_Date'];
            $Attendance_Closing_Date = $rowCS['Attendance_Closing_Date'];




            return array($Company_Name,
                $Logo_Path,
                $Logo_Height,
                $Logo_Width,
                $Company_Telphone,
                $Company_Email,
                $Web_Site,
                $Company_POBOX,
                $Company_Fax,
                $Company_City,
                $Company_Country,
                $Equipment_Picture_Path,
                $Annual_Leave_Expiry_Year,
                $Annual_Leave_Initial_Days,
                $Annual_Leave_CONST_Year,
                $Attendance_Opening_Date,
                $Attendance_Closing_Date);
        }
        else
            return false;
    }

    function hour2sec($hr) {

        $time = explode(':', $hr);

        $second = 0;

        if (isset($time[0])) {
            $second = $time[0] * 3600;
        }
        if (isset($time[1])) {
            $second +=$time[1] * 60;
        }
        if (isset($time[2])) {
            $second +=$time[2];
        }
        return $second;
    }

    function sec2hour($sec, $padHours = true) {

        $hms = "";

        $hours = intval(intval($sec) / 3600);

        $hms .= ($padHours) ? str_pad($hours, 2, "0", STR_PAD_LEFT) . ":" : $hours . ":";

        $minutes = intval(($sec / 60) % 60);

        $hms .= str_pad($minutes, 2, "0", STR_PAD_LEFT) . ":";
        $seconds = intval($sec % 60);

        $hms .= str_pad($seconds, 2, "0", STR_PAD_LEFT);

        return $hms;
    }

    /*     * *****************************
      function sec2hour($sec) {
      $remain = 0;
      $remain = $sec % 3600;
      $hour = ($sec - $remain) / 3600;
      $min = '00';
      $se = '00';
      if ($remain > 0) {
      $rm = $remain % 60;
      $min = ($remain - $rm) / 60;
      if ($min < 10) {
      $min = 0 . $min;
      }
      if ($rm > 0) {
      $se = $rm;
      if ($se < 10) {
      $se = 0 . $se;
      }
      }
      }

      if (strlen($hour) == 1)
      $hour = '0' . $hour;


      return $hour . ':' . $min . ':' . $se;
      }
     * 
     * 
     */
}

?>