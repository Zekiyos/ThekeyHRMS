<title>Calss_Attendance_System</title>
<?php

class Attendance_System {

    public function get_employee_list($db, $Department) {
        /* Selecting only those in the same month and half year worker employee */
        $queryOT = "SELECT ID,FirstName,MiddelName,LastName,Department,Position,date_Employement FROM $db.employee_personal_record 
 where Department='" . $Department . "' ORDER BY Department,ID ASC";

        $resultOT = mysql_query($queryOT);

        $stack = array();

        while ($rowOT = mysql_fetch_array($resultOT, MYSQL_ASSOC)) {

            array_push($stack, $rowOT['ID']);
            //print_r($stack);
        }

        return $stack;
    }

    public function get_employee_Detail($db, $IDNumber) {
        $queryOT = "SELECT ID,FirstName,MiddelName,LastName,Department,Position,date_Employement FROM $db.employee_personal_record 
where ID='" . $IDNumber . "'  ORDER BY ID ASC";

        $resultOT = mysql_query($queryOT);
        $rowOT = mysql_fetch_array($resultOT);

        return array($rowOT['FirstName'], $rowOT['MiddelName'], $rowOT['LastName'], $rowOT['Department']);
    }

    public function get_employee_offday($IDNumber) {
        if (mysql_num_rows(mysql_query("SELECT ID,FirstName,MiddelName,LastName,Department FROM `ThekeyHRMSDB`.employee_offDay 
where ID='" . $IDNumber . "'  ORDER BY ID ASC"))) {
            $queryOT = "SELECT ID,FirstName,MiddelName,LastName,Department FROM `ThekeyHRMSDB`.employee_offDay 
where ID='" . $IDNumber . "'  ORDER BY ID ASC";

            $resultOT = mysql_query($queryOT);
            $rowOT = mysql_fetch_array($resultOT);

            return array($rowOT['FirstName'], $rowOT['MiddelName'], $rowOT['LastName'], $rowOT['Department']);
        }
        return false;
    }

    public function get_department_list($db, $Department) {
        /* Selecting only those in the same month and half year worker employee */
        $queryOT = "SELECT Department FROM $db.department where Department='" . $Department . "'
 ORDER BY Department ASC";

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

    public function OT_Setting_List($db, $Department) {
        $stack = $this->get_employee_list($db, $Department);

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
            list($FirstName, $MiddelName, $LastName, $Department) = $this->get_employee_Detail($db, $IDNumber);



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
                echo "<input type=\"text\" name=\"NightOT_Start\" value=\"00:22:00\" size=\"8\">";
                echo "</td>";

                echo "<td nowrap=\"nowrap\">";
                echo "<input type=\"text\" name=\"NightOT_End\" value=\"00:06:00\" size=\"8\">";
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

    public function get_employee_OT_definition($db, $ID, $Department, $Date) {
        /* Selecting only those in the same month and half year worker employee */
        $queryOT = "SELECT * FROM $db.`OT_Definition`
 where ID='" . $ID . "' and '" . $Date . "' >= `From_Date` and '" . $Date . "' <= `To_Date` ";
      
        
        $resultOT = mysql_query($queryOT);

        if (mysql_num_rows($resultOT)) {

            $rowOT = mysql_fetch_array($resultOT, MYSQL_ASSOC);
            //($rowOT['ID'],$rowOT['DayOT'],$rowOT['NightOT'],$rowOT['SundayOT'],$rowOT['HolydayOT'])                
            return array($ID,
                $rowOT['DayOT'], $rowOT['NightOT'], $rowOT['SundayOT'], $rowOT['HolydayOT'],
                $rowOT['DayOT_MaxHR'], $rowOT['NightOT_MaxHR'],
                $rowOT['DayOT_Start'], $rowOT['NightOT_Start'], $rowOT['NightOT_End']);
        } else {


            $queryOTDept = "SELECT * FROM $db.`OT_Definition_Department` 
                Where `Department`='" . $Department . "' and 
                    `From_Date` <= '" . $Date . "' and `To_Date` >= '" . $Date . "'";

            $resultOTDept = mysql_query($queryOTDept);

            $rowOTDept = mysql_fetch_array($resultOTDept, MYSQL_ASSOC);

            return array($ID,
                $rowOTDept['DayOT'], $rowOTDept['NightOT'], $rowOTDept['SundayOT'], $rowOTDept['HolydayOT'],
                $rowOTDept['DayOT_MaxHR'], $rowOTDept['NightOT_MaxHR'],
                $rowOTDept['DayOT_Start'], $rowOTDept['NightOT_Start'], $rowOTDept['NightOT_End']);
        }
    }

    public function get_working_time_setting($db, $Department, $Date, $ID = NULL) {

        //Get individual Working Time setting if it defined by ine the working_time_setting_individual	

        if ((isset($ID)) and ((mysql_num_rows(mysql_query("SELECT ID FROM $db.working_time_setting_individual 
where ID='" . $ID . "' and `From_Date` <='" . $Date . "'
AND `To_Date` >='" . $Date . "'"))))) {
            $queryOT = "SELECT * FROM $db.working_time_setting_individual 
 where ID='" . $ID . "' and `From_Date` <='" . $Date . "'
AND `To_Date` >='" . $Date . "'";

            $resultOT = mysql_query($queryOT);

            $rowOT = mysql_fetch_array($resultOT, MYSQL_ASSOC);

            $Start = $rowOT['Start'];
            $Start_Break = $rowOT['Start_Break'];
            $End_Break = $rowOT['End_Break'];
            $End = $rowOT['End'];
        } else
        if ((mysql_num_rows(mysql_query("SELECT * FROM $db.Working_Time_Setting 
 where Department='" . $Department . "' and `From_Date` <='" . $Date . "'
AND `To_Date` >='" . $Date . "'")))) {
            $queryOT = "SELECT * FROM $db.Working_Time_Setting 
 where Department='" . $Department . "' and `From_Date` <='" . $Date . "'
AND `To_Date` >='" . $Date . "'";

            $resultOT = mysql_query($queryOT);

            $rowOT = mysql_fetch_array($resultOT, MYSQL_ASSOC);

            $Start = $rowOT['Start'];
            $Start_Break = $rowOT['Start_Break'];
            $End_Break = $rowOT['End_Break'];
            $End = $rowOT['End'];
        } else {
            $queryOT = "SELECT * FROM $db.Working_Time_Setting 
 where Department='Default' and `From_Date` <='" . $Date . "'
AND `To_Date` >='" . $Date . "'";

            $resultOT = mysql_query($queryOT);

            $rowOT = mysql_fetch_array($resultOT, MYSQL_ASSOC);

            $Start = $rowOT['Start'];
            $Start_Break = $rowOT['Start_Break'];
            $End_Break = $rowOT['End_Break'];
            $End = $rowOT['End'];
        }
        return array($Department, $Start, $Start_Break, $End_Break, $End);
    }

    public function get_late_tolerance_setting($db, $Department, $ID = NULL) {

        //Get individual Working Time setting if it defined by ine the working_time_setting_individual	
        if ((isset($ID)) and ((mysql_num_rows(mysql_query("SELECT ID FROM late_tolerance_setting_individual where ID='" . $ID . "'"))))) {
            $queryOT = "SELECT * FROM $db.late_tolerance_setting_individual 
 where ID='" . $ID . "'";

            $resultOT = mysql_query($queryOT);

            $rowOT = mysql_fetch_array($resultOT, MYSQL_ASSOC);

            //latance after work starting time
            $After_Start = $rowOT['After_Start'];

            //latance before break starting time
            $Before_Start_Break = $rowOT['Before_Start_Break'];

            //latance after break work starting time
            $After_End_Break = $rowOT['After_End_Break'];

            //latance before work end time
            $Before_End = $rowOT['Before_End'];
        } else
        if ((mysql_num_rows(mysql_query("SELECT * FROM $db.late_tolerance_setting 
 where Department='" . $Department . "'")))) {
            $queryOT = "SELECT * FROM $db.late_tolerance_setting 
 where Department='" . $Department . "'";

            $resultOT = mysql_query($queryOT);

            $rowOT = mysql_fetch_array($resultOT, MYSQL_ASSOC);

            //latance after work starting time
            $After_Start = $rowOT['After_Start'];

            //latance before break starting time
            $Before_Start_Break = $rowOT['Before_Start_Break'];

            //latance after break work starting time
            $After_End_Break = $rowOT['After_End_Break'];

            //latance before work end time
            $Before_End = $rowOT['Before_End'];
        } else {
            $queryOT = "SELECT * FROM $db.late_tolerance_setting 
 where Department='Default'";

            $resultOT = mysql_query($queryOT);

            $rowOT = mysql_fetch_array($resultOT, MYSQL_ASSOC);

            //latance after work starting time
            $After_Start = $rowOT['After_Start'];

            //latance before break starting time
            $Before_Start_Break = $rowOT['Before_Start_Break'];

            //latance after break work starting time
            $After_End_Break = $rowOT['After_End_Break'];

            //latance before work end time
            $Before_End = $rowOT['Before_End'];
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
    }

    public function time_add($First, $Second) {
        $sqlTA = "SELECT ADDTIME( '$First', '$Second' ) AS Result";

        $resultTA = mysql_query($sqlTA);

        $rowTA = mysql_fetch_array($resultTA, MYSQL_ASSOC);

        return $rowTA['Result'];
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
            }
            else
                $Second_Session_End = "00:00:00";


            //Second Session Total
            if ($End != "00:00:00") {

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

    public function Working_Hour($Scan_ID, $Scan_Department, $Scan_Date, $Scan_Start, $Scan_Start_Break, $Scan_End_Break, $Scan_End, $late_tolerance = NULL) {

        list($Department, $Start, $Start_Break, $End_Break, $End) = $this->get_working_time_setting("THEKEYHRMSDB", $Scan_Department, $Scan_Date, $Scan_ID);

// 24-hour time to 12-hour time 
//        $time_in_12_hour_format = DATE("g:i a", STRTOTIME("13:30"));
// 12-hour time to 24-hour time 
//        $time_in_24_hour_format = DATE("H:i", STRTOTIME("1:30 pm"));


        /*         * ********************Shift Worker(Shift workers doesnt have Start 
         * working time so assign the scanned time)******************* */
        if (($Start == "00:00:00")) {
            $Start = $Scan_Start;
            $Start_Break = $Scan_Start_Break;
            $End_Break = $Scan_End_Break;
            $End = $Scan_End;
            
//             list($Start_AB, $Start_Break_AB, $First_Session_Start, $First_Session_End, $First_Session_HR) = $this->first_session_working_hour($Scan_Start, $Scan_Start_Break, $Start, $Start_Break);
//
//                list($End_Break_AB, $End_AB, $Second_Session_Start, $Second_Session_End, $Second_Session_HR) = $this->second_session_working_hour($Scan_End_Break, $Scan_End, $End_Break, $End);
//     
                
                
           
            if (trim(strtoupper(substr($Scan_Department, 6, 5))) == trim(strtoupper('Spray'))) {
                list($Start_AB, $Start_Break_AB, $First_Session_Start, $First_Session_End, $First_Session_HR) = $this->first_session_working_hour($Scan_Start, $Scan_End, $Start, $End);

                $Second_Session_Start = "00:00:00";
                $Second_Session_End = "00:00:00";
                $Second_Session_HR = "00:00:00";
                
            }  else {
                 list($Start_AB, $Start_Break_AB, $First_Session_Start, $First_Session_End, $First_Session_HR) = $this->first_session_working_hour($Scan_Start, $Scan_Start_Break, $Start, $Start_Break);

            list($End_Break_AB, $End_AB, $Second_Session_Start, $Second_Session_End, $Second_Session_HR) = $this->second_session_working_hour($Scan_End_Break, $Scan_End, $End_Break, $End);

            }
                
                
        }
        /*         * ************************************ */

        if (($Scan_Start == NULL) and ($Scan_Start_Break == NULL)
                and ($Scan_End_Break == NULL) and ($Scan_End == NULL)) {

            $First_Session_Start = "00:00:00";
            $First_Session_End = "00:00:00";
            $First_Session_HR = "00:00:00";
            $Second_Session_Start = "00:00:00";
            $Second_Session_End = "00:00:00";
            $Second_Session_HR = "00:00:00";
        } else {

            if (($Start != "00:00:00") and ($Start_Break != "00:00:00")
                    and ($End_Break != "00:00:00") and ($End != "00:00:00")) {

                list($Start_AB, $Start_Break_AB, $First_Session_Start, $First_Session_End, $First_Session_HR) = $this->first_session_working_hour($Scan_Start, $Scan_Start_Break, $Start, $Start_Break);

                list($End_Break_AB, $End_AB, $Second_Session_Start, $Second_Session_End, $Second_Session_HR) = $this->second_session_working_hour($Scan_End_Break, $Scan_End, $End_Break, $End);
            } else
            if (($Start != "00:00:00") and ($Start_Break != "00:00:00")
                    and ($End_Break != "00:00:00") and ($End == "00:00:00")) {
                list($Start_AB, $Start_Break_AB, $First_Session_Start, $First_Session_End, $First_Session_HR) = $this->first_session_working_hour($Scan_Start, $Scan_Start_Break, $Start, $Start_Break);

                list($End_Break_AB, $End_AB, $Second_Session_Start, $Second_Session_End, $Second_Session_HR) = $this->second_session_working_hour($Scan_End_Break, $Scan_End, $End_Break, $End);

                if ($Second_Session_HR == "UNKNOWN") {
                    $Second_Session_HR_Total = $this->time_diff("08:00:00", $First_Session_HR);

                    $Second_Session_HR = $this->time_diff($Second_Session_HR_Total, $End_Break_AB);
                }
            } else
            if (($Start != "00:00:00") and ($Start_Break != "00:00:00")
                    and ($End_Break == "00:00:00") and ($End == "00:00:00")) {
                list($Start_AB, $Start_Break_AB, $First_Session_Start, $First_Session_End, $First_Session_HR) = $this->first_session_working_hour($Scan_Start, $Scan_Start_Break, $Start, $Start_Break);

                $Second_Session_Start = "00:00:00";
                $Second_Session_End = "00:00:00";
                $Second_Session_HR = "00:00:00";
            } else
            if (($Start != "00:00:00") and ($Start_Break == "00:00:00")
                    and ($End_Break == "00:00:00") and ($End == "00:00:00")) {

                list($Start_AB, $Start_Break_AB, $First_Session_Start, $First_Session_End, $First_Session_HR) = $this->first_session_working_hour($Scan_Start, $Scan_End, $Start, $End);

                if ($First_Session_HR == "UNKNOWN") {
                    $First_Session_HR = $this->time_diff("08:00:00", $Start_AB);
                }
                $Second_Session_Start = "00:00:00";
                $Second_Session_End = "00:00:00";
                $Second_Session_HR = "00:00:00";
            } else
            if (($Start != "00:00:00") and ($Start_Break == "00:00:00")
                    and ($End_Break == "00:00:00") and ($End != "00:00:00")) {
                list($Start_AB, $Start_Break_AB, $First_Session_Start, $First_Session_End, $First_Session_HR) = $this->first_session_working_hour($Scan_Start, $Scan_End, $Start, $End);

                $Second_Session_Start = "00:00:00";
                $Second_Session_End = "00:00:00";
                $Second_Session_HR = "00:00:00";

                /*                 * ********coldroom('GH 11-12 Cold Room') case //if only breaks are not avaial and scan data registed Scan_End in the in Start_Break **************** */
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
                } else
                if (($Start == "00:00:00") and ($Start_Break == "00:00:00")
                        and ($End_Break == "00:00:00") and ($End == "00:00:00")) {

                    $First_Session_Start = "00:00:00";
                    $First_Session_End = "00:00:00";
                    $First_Session_HR = "00:00:00";

                    $Second_Session_Start = "00:00:00";
                    $Second_Session_End = "00:00:00";
                    $Second_Session_HR = "00:00:00";
                }
            }
        }


        //total Working Hour Before Late tolerance
        $WorkingHR = $this->time_add($First_Session_HR, $Second_Session_HR);


        //late tolerance is enabled          
        if (($late_tolerance == "TRUE") and ($Start_Break != "00:00:00") and ($End_Break != "00:00:00")) {
            list($Department, $After_Start, $Before_Start_Break, $After_End_Break, $Before_End) = $this->get_late_tolerance_setting("ThekeyHRMSDB", $Scan_Department, $Scan_ID);

            list($Department, $Start, $Start_Break, $End_Break, $End) = $this->get_working_time_setting("THEKEYHRMSDB", $Scan_Department, $Scan_Date, $Scan_ID);



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
                $First_Session_HR = $this->time_diff($First_Session_End, $First_Session_Start);
            } else {
                $First_Session_Start = "00:00:00";
                $First_Session_End = "00:00:00";
                $First_Session_HR = "00:00:00";
            }

            //Second Sessioon Total
            if (isset($Second_Session_End) and isset($Second_Session_Start)) {
                $Second_Session_HR = $this->time_diff($Second_Session_End, $Second_Session_Start);
            } else {
                $Second_Session_Start = "00:00:00";
                $Second_Session_End = "00:00:00";
                $Second_Session_HR = "00:00:00";
            }

             //Total Working Hour
            $WorkingHR = $this->time_add($First_Session_HR, $Second_Session_HR);
            
if (trim(strtoupper(substr($Scan_Department, 6, 5))) == trim(strtoupper('Spray'))) {
                list($Start_AB, $Start_Break_AB, $First_Session_Start, $First_Session_End, $First_Session_HR) = $this->first_session_working_hour($Scan_Start, $Scan_End, $Start, $End);

               if($First_Session_HR >'00:00:00')
               {
                    $WorkingHR ='08:00:00';
               }
                
            } 
            
            
           
        }



        if ($WorkingHR <= "00:00:00")
            $WorkingHR = ""; //"00:00:00";

        if ($WorkingHR >= "08:00:00")
            $WorkingHR = "08:00:00";




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

    public function OT($Scan_ID, $Scan_Date, $round = NULL) {
        /*         * ***************OT Starting and End Definition**************************** */

        //$DayOT_Start="15:30:00";
        //$DayOT_Start="16:00:00";
        //$NightOT_Start="22:00:00";
        //$NightOT_End="06:00:00";
        $WorkingHR = "";

        $DayOTHR = "";
        $NightOTHR = "";


        $SundayOTHR = "";
        $HolydayOTHR = "";





        list($Scan_ID, $Scan_Date1, $Scan_Start, $Scan_Start_Break, $Scan_End_Break, $Scan_End, $Scan_Department) = $this->get_attendance($Scan_ID, $Scan_Date);

        list($Department, $Start, $Start_Break, $End_Break, $End) = $this->get_working_time_setting("THEKEYHRMSDB", $Scan_Department, $Scan_Date, $Scan_ID);

        list($ID, $DayOT, $NightOT, $SundayOT, $HolydayOT,
                $DayOT_MaxHR, $NightOT_MaxHR, $DayOT_Start, $NightOT_Start, $NightOT_End) = $this->get_employee_OT_definition("ThekeyHRMSDB", $Scan_ID, $Scan_Department, $Scan_Date);


        //************** Day OT Allocation**********************//
		
		
		
        if ((trim(strtoupper($DayOT)) == 'Y') and ($Scan_End > $End) and ($Scan_End <= $NightOT_Start)) {

		  if($End !='00:00:00'){
		
            $DayOTHR = $this->time_diff($Scan_End, $End);
		}else{
		
            $DayOTHR = $this->time_diff($Scan_End, $DayOT_Start);
		}
		
		
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

        if ((trim(strtoupper($NightOT)) == "Y") and ($Scan_End > $End) and ($Scan_End > $NightOT_Start)
                and ($Scan_End <= $NightOT_End)) {
            $NightOTHR = $this->time_diff($Scan_End, $End);


            $NightOTHR = $this->time_diff($NightOTHR, $DayOTHR);
        } else
        if ((trim(strtoupper($DayOT)) == "Y") and ($Scan_End > $End) and ($Scan_End > $NightOT_Start)
                and ($Scan_End >= $NightOT_End)) {
            $NightOTHR = $this->time_diff($Scan_End, $NightOT_End);

            $NightOTHR = $this->time_diff($NightOTHR, $DayOTHR);
        }


        /*         * *********************Sunday(Offday) OT Allocation******************************** */
        $Off_Day = trim(strtoupper($this->get_offday($Scan_ID)));

        $Day_of_Scan_Date = trim(strtoupper(date("l", strtotime($Scan_Date))));

        if (($Off_Day == $Day_of_Scan_Date) and ($Scan_End > "00:00:00")) {
            list($First_Session_Start_OffDay, $First_Session_End_OffDay, $First_Session_HR_OffDay, $Second_Session_Start_OffDay, $Second_Session_End_OffDay, $Second_Session_HR_OffDay, $WorkingHR_OffDay) = $this->Working_Hour($Scan_ID, $Scan_Department, $Scan_Date, $Scan_Start, $Scan_Start_Break, $Scan_End_Break, $Scan_End);

            $SundayOTHR = $WorkingHR_OffDay;



            if (($SundayOTHR > "00:00:00")) {

                //$DayNightOTHR=$this->time_add($NightOTHR,$DayOTHR);
                $SundayOTHR = $this->time_add($SundayOTHR, $DayOTHR); //sum of all working hour and Day OT

                $SundayOTHR = $this->time_add($SundayOTHR, $NightOTHR); //sum of all working hour and Night OT

                $DayOTHR = "";
                $NightOTHR = "";
            }
        }

        /*         * *************************************************************** */

        /*********************** Holyday OT *****************************************/
        $Holday_Name = trim(strtoupper($this->get_Holyday($Scan_Date)));

        if ($Holday_Name != trim(strtoupper("Not Holyday"))) {
            list($First_Session_Start_HolyDay, $First_Session_End_HolyDay, $First_Session_HR_HolyDay, $Second_Session_Start_HolyDay, $Second_Session_End_HolyDay, $Second_Session_HR_HolyDay, $WorkingHR_HolyDay) = $this->Working_Hour($Scan_ID, $Scan_Department, $Scan_Date, $Scan_Start, $Scan_Start_Break, $Scan_End_Break, $Scan_End);

            if ($DayOTHR != "") {
               $WorkingHR_HolyDay = $this->time_add($WorkingHR_HolyDay, $DayOTHR); //sum of all Holyday working hour and Day OT

                $DayOTHR = "";
            }
            if ($NightOTHR != "") {
                $WorkingHR_HolyDay = $this->time_add($WorkingHR_HolyDay, $NightOTHR); //sum of all Holyday working hour and Night OT

                $NightOTHR = "";
            }

            $HolydayOTHR = $WorkingHR_HolyDay;
        }
        /*         * ***************************Holday OT END************************** */


        if ($DayOTHR < "00:00:00")
            $DayOTHR = ""; //"00:00:00";

        if ($NightOTHR < "00:00:00")
            $NightOTHR = ""; //"00:00:00";

        if ($SundayOTHR < "00:00:00")
            $SundayOTHR = ""; //"00:00:00";

        if ($HolydayOTHR < "00:00:00")
            $HolydayOTHR = ""; //"00:00:00";		
			
			

			if (($HolydayOTHR <= "08:00:00") and ($HolydayOTHR > "00:00:00"))
          {     		//  $HolydayOTHR = "08:00:00"; //"00:00:00";	
		  }


	/******************************** OT for those who scanning time is equal to Working Time Setting*****************************************/
			
			if( ($Start == $Scan_Start) and ($Start_Break == $Scan_Start_Break)
            and ($End_Break == $Scan_End_Break)){
			
			 if ((trim(strtoupper($DayOT)) == 'Y') ) {

              $DayOTHR = $DayOT_MaxHR;
        
               }
			
			}
			
			
	/************************************************************************/
			
			
			


        if ($round == "TRUE") {
            if (($DayOTHR >= $DayOT_MaxHR)) {

                $DayOTHR = $DayOT_MaxHR;
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

    function createDateRangeArray($strDateFrom, $strDateTo) {
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

        if ($No_Employee) {
            if (mysql_num_rows(mysql_query("SELECT Date from (SELECT COUNT(ID) as IDNO,Date FROM `thekeyhrmsdb`.`attendance_sheet` 
                where Department='" . $Department . "' and Date BETWEEN '" . $From_Date . "' AND '" . $To_Date . "'  Group BY Date) as sql1
                    where IDNO < " . $No_Employee . ""))) {
                $sqlOT = "SELECT Date from (SELECT COUNT(ID) as IDNO,Date FROM `thekeyhrmsdb`.`attendance_sheet` 
                where Department='" . $Department . "' and Date BETWEEN '" . $From_Date . "' AND '" . $To_Date . "'    Group BY Date) as sql1
                    where IDNO < " . $No_Employee . "";


                $DateStack = array();
                $resultOT = mysql_query($sqlOT);

                while ($rowOT = mysql_fetch_array($resultOT, MYSQL_ASSOC)) {

                    array_push($DateStack, $rowOT['Date']);
                }
            } else {
                $DateStack = array(0, 0);
            }
        } else {
            $DateStack = '0000-00-00';
        }
        return $DateStack;
    }

    function get_Date_Range($From_Date, $To_Date) {

        $start = strtotime($From_Date);
        $end = strtotime($To_Date);
        $incriment = 60 * 60 * 24;
        $date_rage = array();
        for ($i = $start; $i <= $end; $i += $incriment) {

            $date_rage[] = date('Y-m-d', $i);
        }
        return $date_rage;
    }

    public function get_Scaned_employee($Department, $Date) {

        $IDStack = array();

        $sqlOT = "SELECT * FROM `thekeyhrmsdb`.`attendance_sheet`
            where Department='" . $Department . "' and  Date = '" . $Date . "' Group BY ID,Date";

        $resultOT = mysql_query($sqlOT);

        while ($rowOT = mysql_fetch_array($resultOT, MYSQL_ASSOC)) {
            array_push($IDStack, $rowOT['ID']);
        }

        return $IDStack;
    }

    public function get_not_Scaned_employeex($Department) {


        $Scaned_ID_Stack = $this->get_Scaned_employee($Department);

        $ID_employee = $this->get_employee($Department);

        $Date = $this->get_not_Scaned_Date($Department);



        // $Not_Scanned_ID = array_diff($Scaned_ID_Stack, $ID_employee);

        if (is_array($ID_employee) and is_array($Scaned_ID_Stack)) {

            $Not_Scanned_ID = array_diff($ID_employee, $Scaned_ID_Stack);

            //$Not_Scanned_ID = array_diff($Scaned_ID_Stack, $ID_employee);

            echo "<br/> Total unique <br/>";
//print_r($result);

            $result = array_unique($Not_Scanned_ID);
            var_dump($result);

            echo "<br/> Total <br/>";
            print_r($ID_employee);

            echo "<br/> Not Scan Dates";

            print_r($Date);

            echo "<br/> toatl <br/>";

            print_r($ID_employee);

            echo "<br/> Diff <br/>";

            print_r($Not_Scanned_ID);


//$Not_Scanned_ID = array_unique($Not_Scanned_ID);
            //$DateRange[] = $this->createDateRangeArray($From_Date, $To_Date);
            // if(is_e)

            if (is_array($Date)) {
                echo '<table border="1">';
                echo "<th>ID</th>";

                echo "<th>FirstName</th>";

                echo "<th>MiddelName</th>";

                echo "<th>LastName</th>";

                echo "<th>Data</th>";

                echo "<th>Department</th>";

                echo "<th>Date</th>";

                foreach ($Date as $Datevalue) {
                    $Datevalue = $Datevalue;
                    global $Datevalue;
                    foreach ($ID_employee as $Not_Scanned_IDValue) {
                        /*                         * ********************
                          echo '<br/>';
                          echo $Datevalue;
                          echo '<br/>';
                          echo $Not_Scanned_IDValue;
                          echo '<br/>';
                         * 
                         * 
                         */
                        if (!(mysql_num_rows(mysql_query("SELECT *  FROM `thekeyhrmsdb`.`attendance_sheet`
            where Date='" . $Datevalue . "' and ID='" . $Not_Scanned_IDValue . "'")))) {

                            echo $Datevalue;
                            /*                             * ******************
                              echo '<br/> d';
                              echo $Datevalue;
                              echo '<br/> id';
                              echo $Not_Scanned_IDValue;
                              echo '<br/>';
                             * 
                             * 

                              $sqlAS = "SELECT *  FROM `thekeyhrmsdb`.`attendance_sheet`
                              where Date='" . $Datevalue . "' and ID='" . $Not_Scanned_IDValue . "'";

                              $resultAS = mysql_query($sqlAS);

                              $rowAS = mysql_fetch_array($resultAS, MYSQL_ASSOC);

                              $Datevalue1=$rowAS['Date'];
                             * 
                             */




                            list($FirstName, $MiddelName, $LastName, $Department) = $this->get_employee_offday($Not_Scanned_IDValue);

                            if (($FirstName) and ($Datevalue)) {
                                echo '<hr>' . $Datevalue;
                                echo '<tr align="right">';
                                echo '<td>';
                                echo " " . $Not_Scanned_IDValue . "</td> <td>" . $FirstName . " </td><td>" . $MiddelName . "</td><td> " . $LastName . "</td><td>" . $Department . "</td><td> not Scanned in Date</td>";

                                echo "<td>";

                                echo $Datevalue;
                                echo '</td>';


                                echo '</tr>';
                            } else {

                                //list($Scan_ID, $Scan_Date, $Scan_Start, $Scan_Start_Break, $Scan_End_Break,
                                //$Scan_End, $Scan_Department)=$this->get_attendance($Not_Scanned_IDValue, $DateValue);
                                // echo '<tr align="right">' ;
                                //  echo '<td>';
                                //  echo " " . $Not_Scanned_IDValue . "</td> <td> " . $FirstName . "</td> <td> " . $MiddelName . "</td> <td> " . $LastName . " </td> <td> not in Employe off Day on Date ";// . $DateValue."  Scanned";
                                //  echo $Datevalue;
                                //  echo '</td>';
                                //  echo '</tr>';
                            }
                        }
                    }
                }
            }
            else
                echo " NO Problem of Scanning and Snapshot Creation";
        }
        else
            echo " NO Problem of Scanning and Snapshot Creation for $Department Department";
    }

    public function get_not_Scaned_employeex2($Department, $From_Date, $To_Date) {


        $ID_employee = $this->get_employee($Department);

        $Date = $this->get_not_Scaned_Date($Department, $From_Date, $To_Date);

        if (is_array($ID_employee) and is_array($Date)) {

            echo '<table border="1">';
            echo "<th>ID</th>";

            echo "<th>FirstName</th>";

            echo "<th>MiddelName</th>";

            echo "<th>LastName</th>";

            echo "<th>Data</th>";

            echo "<th>Department</th>";

            echo "<th>Date</th>";

            foreach ($Date as $Datevalue) {

                foreach ($ID_employee as $Not_Scanned_IDValue) {


                    $Scaned_ID_Stack = $this->get_Scaned_employee($Department, $Datevalue);


                    if (!( in_array($Not_Scanned_IDValue, $Scaned_ID_Stack))) {

                        list($FirstName, $MiddelName, $LastName, $Department) = $this->get_employee_Detail('Thekeyhrmsdb', $Not_Scanned_IDValue);

                        if (($FirstName)) {

                            echo '<tr align="right">';
                            echo '<td>';
                            echo " " . $Not_Scanned_IDValue . "</td> <td>" . $FirstName . " </td><td>" . $MiddelName . "</td><td> " . $LastName . "</td><td>" . $Department . "</td><td> not Scanned in Date</td>";

                            echo "<td>";

                            echo $Datevalue;
                            echo '</td>';


                            echo '</tr>';
                        }
                    }
                }
            }
        }
        else
            echo " NO Problem of Scanning and Snapshot Creation";
    }

    public function get_not_Scaned_employee($Department, $Scan_Date) {


        $NotScanIDStack = array();
        $ID_employee = $this->get_employee($Department);

        $Date = $this->get_not_Scaned_Date($Department, $Scan_Date, $Scan_Date);

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

    public function get_offday($ID) {
        if (mysql_num_rows(mysql_query("SELECT * FROM `Employee_Offday` where ID='" . $ID . "'"))) {
            $sqlOT = "SELECT * FROM `Employee_Offday` where ID='" . $ID . "'";

            $resultOT = mysql_query($sqlOT);
            $rowOT = mysql_fetch_array($resultOT, MYSQL_ASSOC);

            $Off_Day = $rowOT['Off_Day'];
        } else {
            $Off_Day = "Sunday";
        }

        return $Off_Day;
    }

    public function get_Holyday($Date) {

        $sqlHD = "SELECT Holyday_Name FROM `Holyday_Definition` where Date='" . $Date . "'";
        $resultHD = mysql_query($sqlHD); //or die(mysql_error());
        if (!$resultHD) {
            die('Query failed: ' . mysql_error());
        } else
        if (mysql_num_rows($resultHD)) {
            $resultOT = mysql_query($sqlHD);
            $rowOT = mysql_fetch_array($resultOT, MYSQL_ASSOC);

            $Holday_Name = $rowOT['Holyday_Name'];


            return $Holday_Name;
        }
        else
            return "Not Holyday";
    }

    public function get_leave($ID, $Date) {
        if (mysql_num_rows(mysql_query("SELECT * FROM `total_leave_taken_dates` where ID='" . $ID . "' and Leave_Taken_Date<='" . $Date . "' and ReportOn > '" . $Date . "'"))) {
            $sqlOT = "SELECT * FROM `total_leave_taken_dates` where ID='" . $ID . "' and Leave_Taken_Date<='" . $Date . "' and ReportOn > '" . $Date . "'";

            $resultOT = mysql_query($sqlOT);
            $rowOT = mysql_fetch_array($resultOT, MYSQL_ASSOC);

            $LeaveType = $rowOT['LeaveType'];
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

    public function Attendance_Allocation($Department, $From_Date, $To_Date, $operation = NULL) {


        $Date_Rage = $this->get_Date_Range($From_Date, $To_Date);

        $Not_Scaned_Date = $this->get_not_Scaned_Date($Department, $From_Date, $To_Date);

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
               
            $sqlOT = "SELECT * FROM `Attendance_Sheet` 
          where Department='" . $Department . "' AND
              `Date` = '" . $Date_Ragevalue . "' AND ID <>'SH-New' ORDER BY Department,Date,ID"; //



            if (( in_array($Date_Ragevalue, $Not_Scaned_Date))) {


                $NotScanIDStack = $this->get_not_Scaned_employee($Department, $Date_Ragevalue);

               if($NotScanIDStack){

                    foreach ($NotScanIDStack as $Not_Scanned_IDValue) {

                        
                        list($Not_Scan_FirstName, $Not_Scan_MiddelName, $Not_Scan_LastName, $Not_Scan_Department) = $this->get_employee_Detail('Thekeyhrmsdb', $Not_Scanned_IDValue);
                        
         
                        $Not_Scan_Start = NULL;
                        $Not_Scan_Start_Break = NULL;
                        $Not_Scan_End_Break = NULL;
                        $Not_Scan_End = NULL;
                        
                        
                $this->generate_attendance_allocation($Not_Scanned_IDValue,$Not_Scan_Department, $Date_Ragevalue, $Not_Scan_Start, 
				$Not_Scan_Start_Break, $Not_Scan_End_Break, $Not_Scan_End, $operation);
      
                        
                    }
                }

              
            }




            $resultOT = mysql_query($sqlOT);


            while ($rowOT = mysql_fetch_array($resultOT, MYSQL_ASSOC)) {


                $Scan_ID = $rowOT['ID'];
                $Scan_FirstName = $rowOT['FirstName'];
                $Scan_MiddelName = $rowOT['MiddelName'];
                $Scan_LastName = $rowOT['LastName'];
                $Department = $rowOT['Department'];
                $Scan_Date = $rowOT['Date'];
                $Scan_Start = $rowOT['Start'];
                $Scan_Start_Break = $rowOT['Start_Break'];
                $Scan_End_Break = $rowOT['End_Break'];
                $Scan_End = $rowOT['End'];
                $Scan_Department = $rowOT['Department'];
       $this->generate_attendance_allocation($Scan_ID, $Scan_Department, $Scan_Date, $Scan_Start, $Scan_Start_Break, $Scan_End_Break, $Scan_End,$operation);
            }

            
        }
        echo "</tbody>";

            echo "</table>";
    }
    
    
        function generate_attendance_allocation($Scan_ID, $Scan_Department,
                $Scan_Date, $Scan_Start, $Scan_Start_Break, $Scan_End_Break, $Scan_End, $operation=NULL) {

    list($Scan_FirstName, $Scan_MiddelName, $Scan_LastName,$Department1) = $this->get_employee_Detail('Thekeyhrmsdb', $Scan_ID);
                   
            list($Department, $Start, $Start_Break, $End_Break, $End) = $this->get_working_time_setting("THEKEYHRMSDB", $Scan_Department, $Scan_Date, $Scan_ID);

            list($ID, $DayOT, $NightOT, $SundayOT, $HolydayOT,
                    $DayOT_MaxHR, $NightOT_MaxHR, $DayOT_Start, $NightOT_Start, $NightOT_End) = $this->get_employee_OT_definition("ThekeyHRMSDB", $Scan_ID, $Scan_Department, $Scan_Date);
            //list($ID,$DayOT,$NightOT,$SundayOT,$HolydayOT)=$this->get_employee_OT_definition("THEKEYHRMSDB",$Scan_ID,$Scan_Date);

            list($First_Session_Start, $First_Session_End, $First_Session_HR, $Second_Session_Start, $Second_Session_End, $Second_Session_HR, $WorkingHR) = $this->Working_Hour($Scan_ID, $Scan_Department, $Scan_Date, $Scan_Start, $Scan_Start_Break, $Scan_End_Break, $Scan_End, $late_tolerance = "TRUE");

            
            list($DayOTHR, $NightOTHR, $SundayOTHR, $HolydayOTHR) = $this->OT($Scan_ID, $Scan_Date, $round = "TRUE");

            $LeaveType = trim(strtoupper($this->get_leave($Scan_ID, $Scan_Date)));


            $Off_Day = trim(strtoupper($this->get_offday($Scan_ID)));
            $Day_of_Scan_Date = trim(strtoupper(date("l", strtotime($Scan_Date))));

            $Holday_Name = trim(strtoupper($this->get_Holyday($Scan_Date)));

            if (trim(strtoupper($LeaveType)) == trim(strtoupper("Not On Leave"))) {
                if (($WorkingHR == "" ) and ($SundayOTHR == "" ) and ($HolydayOTHR == "" ) and ($Off_Day != $Day_of_Scan_Date)
                        and ($Holday_Name == trim(strtoupper("Not Holyday")))) {
                    $Status = "Absent";
                } else if ($HolydayOTHR != "") {
                    $Status = "Holy Day";
                } else {
                    $Status = "";
                }
            } else {
                $Status = $LeaveType;
            }


            if (($SundayOTHR > "00:00:00") OR ($HolydayOTHR > "00:00:00")) {
                $WorkingHR = "00:00:00";
            }

            /*             * ********************************* */


            if (trim(strtoupper(substr($Scan_Department, 9, 9))) == trim(strtoupper('Cold Room'))) {

                if (($WorkingHR > "02:00:00")) {
                    $WorkingHR = "08:00:00";
                }
            }
            /*             * ******************************* */



            echo "<tr align=\"right\">";
            echo "<td>" . $Scan_ID . " </td>";
			if($Scan_FirstName=='')
			{
			  $Scan_FirstName='NOT IN ThekeyHRMS';
			}
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

            /*             * ****** for printing ********** */
            // echo "</tr><tr>";
            /*             * ******************** */
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


            $Off_Day = trim(strtoupper($this->get_offday($Scan_ID)));
            $Day_of_Scan_Date = trim(strtoupper(date("l", strtotime($Scan_Date))));

            if (($Off_Day == $Day_of_Scan_Date)) {
                echo "<td  bgcolor=\"#33FF99\" align=\"justify\">Off-" . $Off_Day . "</td>";
            } else {
                echo "<td></td>";
            }


            /*             * ***************Absent Hour*********************** */
            if ((($WorkingHR == "") or ($WorkingHR < "08:00:00")) and
                    ($Off_Day != $Day_of_Scan_Date) and (($Status == "") or ($Status == "Absent")) and
                    ($HolydayOTHR == "" ) and ($Holday_Name == trim(strtoupper("Not Holyday")))) {
                if ($WorkingHR == "") {
                    $WorkingHR = "00:00:00";
                }

                $AbsentHR = $this->time_diff("08:00:00", $WorkingHR);

                echo "<td bgcolor=\"#FF0000\">" . $AbsentHR . "</td>";
            } else {
                $AbsentHR = "";
                echo "<td ></td>";
            }

            /*             * ************************************ */


            if ($Status == "Absent")
                echo "<td bgcolor=\"#FF0000\">" . $Status . "</td>";
            else
            if ($Status != "")
                echo "<td bgcolor=\"#66FFCC\" >" . $Status . "</td>";
            else
                echo "<td >" . $Status . "</td>";

            echo "</tr>";

            //	$this->insert("Attendace_Allocation",.$Scan_ID.$Scan_FullName.$Scan_Department.$Scan_Date.$Start.$Start_Break.$End_Break.$End.$Scan_Start.$Scan_Start_Break.$First_Session_HR.$Scan_End_Break.$Scan_End.$Second_Session_HR.$WorkingHR.$DayOTHR.$NightOTHR.$SundayOTHR.$HolydayOTHR,ID.Full_Name.Department.Date.Start.Start_Break.End_Break.End.Scan_Start.Scan_Start_Break.First_Session.Scan_End_Break.Scan_End.Second_Session.Working_HR.DayOT_HR.NightOT_HR.SundayOT_HR.HolydayOT_HR);


            /*             * ************************** */
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

            /**             * ************************ */
            if ($operation == "Update") {


                $updateSQL = "UPDATE `Attendance_Allocation` SET  FirstName='" . $Scan_FirstName . "',
		              MiddelName='" . $Scan_MiddelName . "',LastName='" . $Scan_LastName . "',

					  Department='" . $Scan_Department . "', `Date`='" . $Scan_Date . "', Start='" . $Start . "',Start_Break='" . $Start_Break . "',First_Session='" . $First_Session_HR . "',Scan_End_Break='" . $Scan_End_Break . "', Scan_End='" . $Scan_End . "', Second_Session='" . $Second_Session_HR . "',`Working_HR`='" . $WorkingHR . "', DayOT_HR='" . $DayOTHR . "', NightOT_HR='" . $NightOTHR . "', SundayOT_HR='" . $SundayOTHR . "', HolydayOT_HR='" . $HolydayOTHR . "', AbsentHR='" . $AbsentHR . "' WHERE `ID`='" . $Scan_ID . "' AND `Date`='" . $Scan_Date . "'";

//,ModifiedBy='".$_SESSION['MM_Username'].
// mysql_select_db($database_HRMS, $HRMS);
                $Result1 = mysql_query($updateSQL) or die(mysql_error());

                if ($Result1)
                    echo "<script type=\"text/javascript\"> alert('Attendance Allocation is Updated for $Scan_FirstName $Scan_MiddelName $Scan_LastName on Scan Date $Scan_Date Successfully.')</script>";
            } else if ($operation == "Insert") {

                $sqlINSRT = "INSERT INTO `Attendance_Allocation` 
		(`ID`,`FirstName`,`MiddelName`,`LastName`,`Department`,`Date`,`Start`,`Start_Break`,`End_Break`,`End`,`Scan_Start`,`Scan_Start_Break`,`First_Session`,`Scan_End_Break`,`Scan_End`,`Second_Session`,`Working_HR`,`DayOT_HR`,`NightOT_HR`,`SundayOT_HR`,`HolydayOT_HR`,`AbsentHR`,`Status`)
VALUES ('" . $Scan_ID . "','" . $Scan_FirstName . "','" . $Scan_MiddelName . "','" . $Scan_LastName . "','" . $Scan_Department . "','" . $Scan_Date . "','" . $Start . "','" . $Start_Break . "','" . $End_Break . "','" . $End . "','" . $Scan_Start . "','" . $Scan_Start_Break . "','" . $First_Session_HR . "','" . $Scan_End_Break . "','" . $Scan_End . "','" . $Second_Session_HR . "','" . $WorkingHR . "','" . $DayOTHR . "','" . $NightOTHR . "','" . $SundayOTHR . "','" . $HolydayOTHR . "','" . $AbsentHR . "','" . $Status . "') ";

                if ($ID != "")
                    mysql_query($sqlINSRT) or die(mysql_error());
            }
        

    }

    function Run_Attendance_Allocation() {
        $Department = $this->get_department_list("ThekeyHRMSDB", "*");
    }

    public function get_Attendance_Allocation_list() {
        /* Selecting only those in the same month and half year worker employee */
        $queryOT = "SHOW TABLES FROM `thekeyhrmsdb`";

        $resultOT = mysql_query($queryOT);

        echo "<select id=\"Attendace_Allocation\" onchange=\"SelectedAttendance(document.getElementById('Attendace_Allocation'),'Please Choose Attendance First')\">";
        echo "<option>Select Attendance	</option>";
        while ($rowOT = mysql_fetch_array($resultOT, MYSQL_ASSOC)) {
            if (substr(strtoupper($rowOT['Tables_in_thekeyhrmsdb']), 0, 21) == strtoupper("Attendance_Allocation")) {

                echo "<option value=\"{$rowOT['Tables_in_thekeyhrmsdb']}\">";

                if (strtoupper($rowOT['Tables_in_thekeyhrmsdb']) == strtoupper("Attendance_Allocation")) {
                    $year_month = "Current Month";
                }
                else
                    $year_month = strtoupper(substr($rowOT['Tables_in_thekeyhrmsdb'], 22));

                echo "$year_month</option>";
            }
        }

        echo "</select>";
    }

    public function Attendance_Summary($From, $To) {

        $sqlAS1 = "Select attendance_allocation.ID,attendance_allocation.FirstName,
attendance_allocation.MiddelName,attendance_allocation.LastName,attendance_allocation.Department,attendance_allocation.Date,
Sum(Time_To_Sec(attendance_allocation.Working_HR)) /3600 As Total_Working_Hour,                  Sum(Time_To_Sec(attendance_allocation.Working_HR)) / 28800 As Total_Working_Day,
Sum(Time_To_Sec(attendance_allocation.DayOT_HR)) /3600 As DayOT_Hour,
Sum(Time_To_Sec(attendance_allocation.NightOT_HR)) /3600 As NightyOT_Hour,
Sum(Time_To_Sec(attendance_allocation.SundayOT_HR)) /3600 As OffDayOT_Hour,
Sum(Time_To_Sec( attendance_allocation.HolydayOT_HR)) /3600 As HolyDayOT_Hour 
 From attendance_allocation Where Date >= '" . $From . "' and Date <= '" . $To . "'
 Group By attendance_allocation.ID 
 Order By attendance_allocation.Department,attendance_allocation.ID";



        $DB_HOST = 'localhost'; //$hostname_HRMS;
        $DB_USER = 'root'; //$username_HRMS;
        $DB_PASSWORD = 'EWSadmin'; // 'EWSadmin'; //EWSadmin';//$password_HRMS;//'';//'EWSadmin';
        $DB_DATABASE = 'ThekeyHRMSDB'; //$database_HRMS;//
        $DB_PORT = '3306';

////$db = new MySQLi($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_DATABASE,$DB_PORT);
//
        $db = mysql_connect($DB_HOST, $DB_USER, $DB_PASSWORD);
        if (!$db) {
            die('Not connected with Language Database : ' . mysql_error());
        }
        $db_selected = mysql_select_db($DB_DATABASE, $db);
        if (!$db_selected) {
            die('Can\'t use Language database : ' . mysql_error());
        }

        mysql_set_charset('utf8', $db);

        $sqlAS = "call `thekeyhrmsdb`.`Biometric_Total_Attendance`('" . $From . "','" . $To . "')";

        $resultAS = mysql_query($sqlAS);

        echo "<table id=\"Attendance_Summary_Table\" align=\"center\"  border=\"1\">";
        echo "<th>ID</th>
<th>Full_Name</th>
<th>Department</th>
<th>From Date</th>
<th>To Date</th>
<th>Total_Working_HR</th>
<th>Total_Working_Day</th>
<th>Total_Absent_HR</th>
<th>Total_Absent_Day</th>
<th>Working_Day</th>
<th>Total_Leave_Day</th>
<th>DayOT_HR</th>
<th>NightyOT_HR</th>
<th>OffDayOT_HR</th>
<th>HolyDayOT_HR</th>";


        while ($rowAS = mysql_fetch_array($resultAS, MYSQL_ASSOC)) {
            echo "<tr align=\"center\">";

            echo "<td>" . $rowAS['ID'] . "</td>";
            echo "<td>" . $rowAS['FirstName'] . " " . $rowAS['MiddelName'] . " " . $rowAS['LastName'] . "</td>";
            echo "<td>" . $rowAS['Department'] . "</td>";
            echo "<td>" . $rowAS['From_Date'] . "</td>";
            echo "<td>" . $rowAS['To_Date'] . "</td>";
            echo "<td>" . $rowAS['Total_Working_Hour'] . "</td>";
            echo "<td>" . $rowAS['Total_Working_Day'] . "</td>";
            echo "<td>" . $rowAS['Total_Absent_Hour'] . "</td>";
            echo "<td>" . $rowAS['Total_Absent_Day'] . "</td>";
            echo "<td>" . $rowAS['Working_Day'] . "</td>";
            echo "<td>" . $rowAS['Total_Leave_Days'] . "</td>";
            echo "<td>" . $rowAS['DayOT_Hour'] . "</td>";
            echo "<td>" . $rowAS['NightOT_Hour'] . "</td>";
            echo "<td>" . $rowAS['OffDayOT_Hour'] . "</td>";
            echo "<td>" . $rowAS['HolyDayOT_Hour'] . "</td>";

            echo "</tr>";
        }
        echo "</table>";
    }

    public function copy_table($from, $to) {


        $success1 = mysql_query("CREATE TABLE $to LIKE $from");
        $success2 = mysql_query("INSERT INTO $to SELECT * FROM $from");
        $success = $success2;


        return $success;
    }

    public function Summarize_Current_Attendance($Year_Month) {
        /*         * Drop attendance_allocation if exist by the same month and year name* */

        $queryDrop = "DROP TABLE IF EXISTS `ThekeyHRMSDB`.`Attendance_Allocation_" . $Year_Month . "`";

        $resultDrop = mysql_query($queryDrop);

        /* Creating summerize attendance allocation using selected year and month */



        // $querySum  = "CREATE  TABLE IF NOT EXISTS  `ThekeyHRMSDB`.`Attendance_Allocation_".$Year_Month."`" SELECT * FROM (attendance_allocation)";

        $result = $this->copy_table("attendance_allocation", "Attendance_Allocation_" . $Year_Month);
        if ($result)
            echo "<script type=\"text/javascript\"> alert('Attendance Allocation is Summarized for month of $Year_Month Successfully.')</script>";
    }

}
?>