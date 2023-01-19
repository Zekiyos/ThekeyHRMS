<title>Calss_Attendance_System</title>
<?php

class Attendance_System extends db_config {

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

    public function get_department_list($db, $Department) {
        /* Selecting only those in the same month and half year worker employee */
        $queryOT = "SELECT Department FROM $db.department where Department=$Department
 ORDER BY Department ASC";

        $resultOT = mysql_query($queryOT);

        echo "<select id=\"Department\">";
        while ($rowOT = mysql_fetch_array($resultOT, MYSQL_ASSOC)) {

            echo "<option>{$rowOT['Department']}</option>";
        }

        echo "</select>";
    }

    public function get_full_department_list($table, $rows = '*', $where = null, $order = null) {
        $q = 'SELECT ' . $rows . ' FROM ' . $table;
        if ($where != null)
            $q .= ' WHERE ' . $where;
        if ($order != null)
            $q .= ' ORDER BY ' . $order;

        // $queryD  = "SELECT Department FROM department  ORDER BY Department ASC";

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
 where ID='" . $ID . "' and '" . $Date . "' >= `From_Date` and '" . $Date . "' <= `To_Date` ORDER BY ID ASC";

        $resultOT = mysql_query($queryOT);

        if (mysql_num_rows($resultOT)) {

            $rowOT = mysql_fetch_array($resultOT, MYSQL_ASSOC);
            //($rowOT['ID'],$rowOT['DayOT'],$rowOT['NightOT'],$rowOT['SundayOT'],$rowOT['HolydayOT'])                
            return array($ID,
                $rowOT['DayOT'], $rowOT['NightOT'], $rowOT['SundayOT'], $rowOT['HolydayOT'],
                $rowOT['DayOT_MaxHR'], $rowOT['NightOT_MaxHR'],
                $rowOT['DayOT_Start'], $rowOT['NightOT_Start'], $rowOT['NightOT_End']);
        } else {


            $queryOTDept = "SELECT * FROM $db.`OT_Definition_Department` Where `Department`='" . $Department . "' and `From_Date` >= '" . $Date . "' and `To_Date` <= '" . $Date . "'";

            $resultOTDept = mysql_query($queryOTDept);

            $rowOTDept = mysql_fetch_array($resultOTDept, MYSQL_ASSOC);

            return array($ID,
                $rowOTDept['DayOT'], $rowOTDept['NightOT'], $rowOTDept['SundayOT'], $rowOTDept['HolydayOT'],
                $rowOTDept['DayOT_MaxHR'], $rowOTDept['NightOT_MaxHR'],
                $rowOTDept['DayOT_Start'], $rowOTDept['NightOT_Start'], $rowOTDept['NightOT_End']);
        }
    }

    public function get_working_time_setting($db, $Department, $ID = NULL) {

        //Get individual Working Time setting if it defined by ine the working_time_setting_individual	

        if ((isset($ID)) and ((mysql_num_rows(mysql_query("SELECT ID FROM $db.working_time_setting_individual where ID='" . $ID . "'"))))) {
            $queryOT = "SELECT * FROM $db.working_time_setting_individual 
 where ID='" . $ID . "'";

            $resultOT = mysql_query($queryOT);

            $rowOT = mysql_fetch_array($resultOT, MYSQL_ASSOC);

            $Start = $rowOT['Start'];
            $Start_Break = $rowOT['Start_Break'];
            $End_Break = $rowOT['End_Break'];
            $End = $rowOT['End'];
            //}
        } else
        if ((mysql_num_rows(mysql_query("SELECT * FROM $db.Working_Time_Setting 
 where Department='" . $Department . "'")))) {
            $queryOT = "SELECT * FROM $db.Working_Time_Setting 
 where Department='" . $Department . "'";

            $resultOT = mysql_query($queryOT);

            $rowOT = mysql_fetch_array($resultOT, MYSQL_ASSOC);

            $Start = $rowOT['Start'];
            $Start_Break = $rowOT['Start_Break'];
            $End_Break = $rowOT['End_Break'];
            $End = $rowOT['End'];
        } else {
            $queryOT = "SELECT * FROM $db.Working_Time_Setting 
 where Department='Default'";

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

    public function Working_Hour($Scan_ID, $Scan_Department, $Scan_Start, $Scan_Start_Break, $Scan_End_Break, $Scan_End, $late_tolerance = NULL) {
        list($Department, $Start, $Start_Break, $End_Break, $End) = $this->get_working_time_setting("THEKEYHRMSDB", $Scan_Department, $Scan_ID);

        // For Break Time is Avialable
        if (($Start_Break != "00:00:00") and ($End_Break != "00:00:00")) {
            //First Session Start
            if (($Scan_Start > $Start) and ($Scan_Start < $Start_Break)) {
                $Start_AB = $this->time_diff($Scan_Start, $Start);
                $First_Session_Start = $Scan_Start;
            } else
            if ($Scan_Start < $Start_Break) {
                $Start_AB = "00:00:00";
                $First_Session_Start = $Start;
            } else
            if ($Scan_Start > $Start_Break) {
                $Start_AB = $this->time_diff($Start, $Start_Break);
                $First_Session_Start = "00:00:00";
            }

            //First Session End
            if (($Scan_Start_Break < $Start_Break) and ($Scan_Start_Break > $Start)) {
                $Start_Break_AB = $this->time_diff($Start_Break, $Scan_Start_Break);
                $First_Session_End = $Scan_Start_Break;
            } else
            if ($Scan_Start_Break > $Scan_Start) {
                $Start_Break_AB = "00:00:00";
                $First_Session_End = $Start_Break;
            } else
            if ($Scan_Start_Break < $Scan_Start) {
                $Start_Break_AB = $this->time_diff($Start, $Start_Break);
                $First_Session_End = "00:00:00";
            }

            //First Session Total
            if (isset($First_Session_End) and isset($First_Session_Start)) {
                $First_Session_HR = $this->time_diff($First_Session_End, $First_Session_Start);
            } else {
                $First_Session_Start = "00:00:00";
                $First_Session_End = "00:00:00";
                $First_Session_HR = "00:00:00";
            }

            //Second Session Start
            if ($End != "00:00:00") {  //For known End time
                if (($Scan_End_Break > $End_Break) and ($Scan_End_Break < $End)) {
                    $End_Break_AB = $this->time_diff($Scan_End_Break, $End_Break);
                    $Second_Session_Start = $Scan_End_Break;
                } else
                if ($Scan_End_Break < $End) {
                    $End_Break_AB = "00:00:00";
                    $Second_Session_Start = $End_Break;
                } else
                if ($Scan_End_Break > $End) {
                    $End_Break_AB = $this->time_diff($End_Break, $End);
                    $Second_Session_Start = "00:00:00";
                }

                //Second Session End
                if ($Scan_End < $End) {
                    $End_AB = $this->time_diff($End, $Scan_End);
                    $Second_Session_End = $Scan_End;
                } else {
                    $End_AB = "00:00:00";
                    $Second_Session_End = $End;
                }
            } else {   // For Unknown End time
                if ($Scan_End_Break > $End_Break) {
                    $Second_Session_Start = $Scan_End_Break;
                } else
                if ($Scan_End_Break < $End_Break) {
                    $Second_Session_Start = $End_Break;
                }

                $First_Session_HR_Total = $this->time_diff($Start, $Start_Break);

                $Second_Session_HR_Total = $this->time_diff("08:00:00", $First_Session_HR_Total);


                $Second_Session_End = $this->time_add($End_Break, $Second_Session_HR_Total);
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

            if (($First_Session_HR < '00:00:00') and ($Second_Session_HR > '00:00:00')) {
                $First_Session_HR = ""; //"00:00:00";
                $WorkingHR = $Second_Session_HR;
            }

            if (($Second_Session_HR < '00:00:00') and ($First_Session_HR > '00:00:00')) {
                $Second_Session_HR = ""; //"00:00:00";
                $WorkingHR = $First_Session_HR;
            }

            if (($Second_Session_HR < '00:00:00') and ($First_Session_HR < '00:00:00')) {
                $First_Session_HR = "";
                $Second_Session_HR = ""; //"00:00:00";
                $WorkingHR = "00:00:00";
            }
        }//end of who has break time
        else {  // who has not break time    //Spray case if only Start is avail
            if (($Start_Break == "00:00:00") and ($End_Break == "00:00:00") and ($End == "00:00:00")) {
                if ($Scan_Start > "00:00:00") {
                    if ($Scan_Start < $Start) {
                        $First_Session_Start = $Start;
                    } else {
                        $First_Session_Start = $Scan_Start;
                    }

                    $First_Session_End = $Scan_End;

                    $First_Session_Start_AB = $this->time_diff($Start, $First_Session_Start);

                    $First_Session_HR = $this->time_diff("08:00:00", $First_Session_Start_AB);

                    $Second_Session_Start = "NA";
                    $Second_Session_End = "NA";
                    $Second_Session_HR = "NA";

                    $WorkingHR = $First_Session_HR;
                }
            } else { //coldroom case //if only breaks are not avaial
                if ($Scan_Start < $Start) {
                    $First_Session_Start = $Start;
                } else {
                    $First_Session_Start = $Scan_Start;
                }


                if ($Scan_End > $End) {
                    $First_Session_End = $End;
                } else {
                    $First_Session_End = $Scan_End;
                }

                //First Session Total
                if (isset($First_Session_End) and isset($First_Session_Start)) {
                    if ($First_Session_End < $First_Session_Start) { //If it lays Between Mid Night
                        $First_Session_Mid_Night = $this->time_diff("23:59:59", $First_Session_Start);

                        if ($Start == "23:59:59") {
                            $First_Session_Mid_Night = $this->time_add("00:00:00", $First_Session_Mid_Night);
                        } else {
                            $First_Session_Mid_Night = $this->time_add("00:00:01", $First_Session_Mid_Night);
                        }
                        $First_Session_HR = $this->time_add($First_Session_Mid_Night, $First_Session_End);
                    } else {
                        $First_Session_HR = $this->time_diff($First_Session_End, $First_Session_Start);
                    }
                } else {
                    $First_Session_Start = "00:00:00";
                    $First_Session_End = "00:00:00";
                    $First_Session_HR = "00:00:00";
                }


                $Second_Session_Start = "NA";
                $Second_Session_End = "NA";
                $Second_Session_HR = "NA";

                $First_Session_HR_Duty = $End;
                if ($First_Session_HR_Duty >
                        $First_Session_HR) {
                    $WorkingHR = $First_Session_HR;
                } else {
                    $WorkingHR = "08:00:00";
                }
            }
        } //end of scanned worker  working time function
        //not full scanning is done
        if (($Scan_Start == NULL) and ($Scan_Start_Break == NULL) and ($Scan_End_Break == NULL) and ($Scan_End == NULL)) {
            $First_Session_Start = "00:00:00";
            $First_Session_End = "00:00:00";
            $First_Session_HR = "00:00:00";
            $Second_Session_Start = "00:00:00";
            $Second_Session_End = "00:00:00";
            $Second_Session_HR = "00:00:00";

            $WorkingHR = "";
        }






        if (($late_tolerance == "TRUE") and ($Start_Break != "00:00:00") and ($End_Break != "00:00:00")) {
            list($Department, $After_Start, $Before_Start_Break, $After_End_Break, $Before_End) = $this->get_late_tolerance_setting("ThekeyHRMSDB", $Scan_Department, $Scan_ID);

            list($Department, $Start, $Start_Break, $End_Break, $End) = $this->get_working_time_setting("THEKEYHRMSDB", $Scan_Department, $Scan_ID);



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





        list($Scan_ID, $Scan_Date, $Scan_Start, $Scan_Start_Break, $Scan_End_Break, $Scan_End, $Scan_Department) = $this->get_attendance($Scan_ID, $Scan_Date);

        list($Department, $Start, $Start_Break, $End_Break, $End) = $this->get_working_time_setting("THEKEYHRMSDB", $Scan_Department, $Scan_ID);

        list($ID, $DayOT, $NightOT, $SundayOT, $HolydayOT,
                $DayOT_MaxHR, $NightOT_MaxHR, $DayOT_Start, $NightOT_Start, $NightOT_End) = $this->get_employee_OT_definition("ThekeyHRMSDB", $Scan_ID, $Scan_Department, $Scan_Date);


        //************** Day OT Allocation**********************//
        if (($DayOT == 'Y') and ($Scan_End > $End) and ($Scan_End <= $NightOT_Start)) {

            $DayOTHR = $this->time_diff($Scan_End, $End);

            //$DayOTHR=$End-$Scan_End;
        } else
        if (($DayOT == "Y") and ($Scan_End > $End) and ($Scan_End > $NightOT_Start)) {

            $DayOTHR = $this->time_diff($NightOT_Start, $DayOT_Start);

            //$DayOTHR=$NightOT_Start-$DayOT_Start;
        }


        //************** Night OT Allocation**********************//	

        if (($NightOT == "Y") and ($Scan_End > $End) and ($Scan_End > $NightOT_Start)
                and ($Scan_End <= $NightOT_End)) {
            $NightOTHR = $this->time_diff($Scan_End, $End);

            //$NightOTHR=$End-$Scan_End;

            $NightOTHR = $this->time_diff($NightOTHR, $DayOTHR);
        } else
        if (($DayOT == "Y") and ($Scan_End > $End) and ($Scan_End > $NightOT_Start)
                and ($Scan_End >= $NightOT_End)) {
            $NightOTHR = $this->time_diff($Scan_End, $NightOT_End);

            $NightOTHR = $this->time_diff($NightOTHR, $DayOTHR);
            //$NightOTHR=$NightOT_End-$Scan_End;
        }


        /*         * *********************Sunday(Offday) OT Allocation******************************** */
        $Off_Day = strtoupper($this->get_offday($Scan_ID));

        $Day_of_Scan_Date = strtoupper(date("l", strtotime($Scan_Date)));

        if (($Off_Day == $Day_of_Scan_Date) and ($Scan_End > "00:00:00")) {
            list($First_Session_Start_OffDay, $First_Session_End_OffDay, $First_Session_HR_OffDay, $Second_Session_Start_OffDay, $Second_Session_End_OffDay, $Second_Session_HR_OffDay, $WorkingHR_OffDay) = $this->Working_Hour($Scan_ID, $Scan_Department, $Scan_Start, $Scan_Start_Break, $Scan_End_Break, $Scan_End);

            $SundayOTHR = $WorkingHR_OffDay;



            if (($SundayOTHR > "00:00:00")) {

                //$DayNightOTHR=$this->time_add($NightOTHR,$DayOTHR);
                $SundayOTHR = $this->time_add($SundayOTHR, $DayOTHR); //sum of all working hour and OT

                $DayOTHR = "";
                $NightOTHR = "";
            }
        }

        /*         * *************************************************************** */

        /*         * *********************Holyday OT**************************************** */
        $Holday_Name = $this->get_Holyday($Scan_Date);
        if ($Holday_Name != "Not Holyday") {
            list($First_Session_Start_HolyDay, $First_Session_End_HolyDay, $First_Session_HR_HolyDay, $Second_Session_Start_HolyDay, $Second_Session_End_HolyDay, $Second_Session_HR_HolyDay, $WorkingHR_HolyDay) = $this->Working_Hour($Scan_ID, $Scan_Department, $Scan_Start, $Scan_Start_Break, $Scan_End_Break, $Scan_End);


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






            
//echo "<td>".$DayOTHR."</td>";
        //echo "<td>".$NightOTHR."</td>";


        if ($round == "TRUE") {
            if (($DayOTHR >= $DayOT_MaxHR) and ($DayOT_MaxHR != "00:00:00")) {

                $DayOTHR = $DayOT_MaxHR;
            }


            if (($NightOTHR >= $NightOT_MaxHR) and ($NightOT_MaxHR != "00:00:00")) {

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
        if (mysql_num_rows(mysql_query("SELECT * FROM `total_leave_taken_dates` where ID='" . $ID . "' and Leave_Taken_Date<='" . $Date . "' and ReportOn >='" . $Date . "'"))) {
            $sqlOT = "SELECT * FROM `total_leave_taken_dates` where ID='" . $ID . "' and Leave_Taken_Date<='" . $Date . "' and ReportOn >='" . $Date . "'";

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


        $sqlOT = "SELECT * FROM `Attendance_Sheet` where Department='" . $Department . "' AND  `Date`>='" . $From_Date . "'
AND `Date` <='" . $To_Date . "' AND ID<>'SH-New' ORDER BY Department,Date,ID"; //

        $resultOT = mysql_query($sqlOT);




        echo "<table align=\"center\"  border=\"1\">";

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



            list($Department, $Start, $Start_Break, $End_Break, $End) = $this->get_working_time_setting("THEKEYHRMSDB", $Scan_Department, $Scan_ID);

            list($ID, $DayOT, $NightOT, $SundayOT, $HolydayOT,
                    $DayOT_MaxHR, $NightOT_MaxHR, $DayOT_Start, $NightOT_Start, $NightOT_End) = $this->get_employee_OT_definition("ThekeyHRMSDB", $Scan_ID, $Scan_Department, $Scan_Date);
            //list($ID,$DayOT,$NightOT,$SundayOT,$HolydayOT)=$this->get_employee_OT_definition("THEKEYHRMSDB",$Scan_ID,$Scan_Date);

            list($First_Session_Start, $First_Session_End, $First_Session_HR, $Second_Session_Start, $Second_Session_End, $Second_Session_HR, $WorkingHR) = $this->Working_Hour($Scan_ID, $Scan_Department, $Scan_Start, $Scan_Start_Break, $Scan_End_Break, $Scan_End, $late_tolerance = "TRUE");

            list($DayOTHR, $NightOTHR, $SundayOTHR, $HolydayOTHR) = $this->OT($Scan_ID, $Scan_Date, $round = "TRUE");

            $LeaveType = $this->get_leave($Scan_ID, $Scan_Date);


            $Off_Day = strtoupper($this->get_offday($Scan_ID));
            $Day_of_Scan_Date = strtoupper(date("l", strtotime($Scan_Date)));



            if ($LeaveType == "Not On Leave") {
                if (($WorkingHR == "" ) and ($SundayOTHR == "" ) and ($HolydayOTHR == "" ) and ($Off_Day != $Day_of_Scan_Date)) {
                    $Status = "Absent";
                } else {
                    $Status = "";
                }
            } else {
                $Status = $LeaveType;
            }


            if (($SundayOTHR > "00:00:00") OR ($HolydayOTHR > "00:00:00")) {
                $WorkingHR = "00:00:00";
            }



            echo "<tr align=\"right\">";
            echo "<td>" . $Scan_ID . " </td>";
            echo "<td>" . $Scan_FirstName . " " . $Scan_MiddelName . " " . $Scan_LastName . "</td>";
            echo "<td>" . $Scan_Department . "</td>";

            echo "<td>" . $Scan_Date . " </td>";

            echo "<td>" . $Start . " </td>";
            echo "<td>" . $Scan_Start . "</td>";

            echo "<td>" . $Start_Break . " </td>";
            echo "<td>" . $Scan_Start_Break . "</td>";

            echo "<td bgcolor=\"#FFFF00\">" . $First_Session_Start . "</td>";
            echo "<td bgcolor=\"#FFFF00\">" . $First_Session_End . "</td>";

            echo "<td bgcolor=\"#CCCCCC\" >" . $First_Session_HR . "</td>";

            /*             * ****** for printing ********** */
            // echo "</tr><tr>";
            /*             * ******************** */
            echo "<td>" . $End_Break . " </td>";
            echo "<td>" . $Scan_End_Break . "</td>";

            echo "<td>" . $End . " </td>";
            echo "<td>" . $Scan_End . "</td>";

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


            $Off_Day = strtoupper($this->get_offday($Scan_ID));
            $Day_of_Scan_Date = strtoupper(date("l", strtotime($Scan_Date)));

            if (($Off_Day == $Day_of_Scan_Date)) { //and ($Scan_End > "00:00:00"))
                echo "<td  bgcolor=\"#33FF99\" align=\"justify\">Off-" . $Off_Day . "</td>";
            } else {
                echo "<td></td>";
            }


            /*             * ***************Absent Hour*********************** */
            if ((($WorkingHR == "") or ($WorkingHR < "08:00:00")) and ($Off_Day != $Day_of_Scan_Date) and (($Status == "") or ($Status == "Absent"))) {
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



            if ($operation == "Update") {


                $updateSQL = "UPDATE `Attendance_Allocation` SET  FirstName='" . $Scan_FirstName . "',
		              MiddelName='" . $Scan_MiddelName . "',LastName='" . $Scan_LastName . "',
					  Department='" . $Scan_Department . "', `Date`='" . $Scan_Date . "', Start='" . $Start . "',Start_Break='" . $Start_Break . "',First_Session='" . $First_Session_HR . "',Scan_End_Break='" . $Scan_End_Break . "', Scan_End='" . $Scan_End . "', Second_Session='" . $Second_Session_HR . "',`Working_HR`='" . $WorkingHR . "', DayOT_HR='" . $DayOTHR . "', NightOT_HR='" . $NightOTHR . "', SundayOT_HR='" . $SundayOTHR . "', HolydayOT_HR='" . $HolydayOTHR . "', AbsentHR='" . $AbsentHR . "' WHERE `ID`='" . $Scan_ID . "' AND `Date`='" . $Scan_Date . "'";

//,ModifiedBy='".$_SESSION['MM_Username'].
// mysql_select_db($database_HRMS, $HRMS);
                $Result1 = mysql_query($updateSQL) or die(mysql_error());


                echo "<script type=\"text/javascript\"> alert('Attendance Allocation is Updated for $Scan_FirstName $Scan_MiddelName $Scan_LastName on Scan Date $Scan_Date Successfully.')</script>";
            } else if ($operation == "Insert") {
                $sqlINSRT = "INSERT INTO `Attendance_Allocation` 
		(`ID`,`FirstName`,`MiddelName`,`LastName`,`Department`,`Date`,`Start`,`Start_Break`,`End_Break`,`End`,`Scan_Start`,`Scan_Start_Break`,`First_Session`,`Scan_End_Break`,`Scan_End`,`Second_Session`,`Working_HR`,`DayOT_HR`,`NightOT_HR`,`SundayOT_HR`,`HolydayOT_HR`,`AbsentHR`,`Status`)
VALUES ('" . $Scan_ID . "','" . $Scan_FirstName . "','" . $Scan_MiddelName . "','" . $Scan_LastName . "','" . $Scan_Department . "','" . $Scan_Date . "','" . $Start . "','" . $Start_Break . "','" . $End_Break . "','" . $End . "','" . $Scan_Start . "','" . $Scan_Start_Break . "','" . $First_Session_HR . "','" . $Scan_End_Break . "','" . $Scan_End . "','" . $Second_Session_HR . "','" . $WorkingHR . "','" . $DayOTHR . "','" . $NightOTHR . "','" . $SundayOTHR . "','" . $HolydayOTHR . "','" . $AbsentHR . "','" . $Status . "') ";

                if ($ID != "")
                    mysql_query($sqlINSRT) or die(mysql_error());
            }
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




        $db = mysql_connect($this->hostname_HRMS, $this->username_HRMS, $this->password_HRMS);
        if (!$db) {
            die('Not connected with Language Database : ' . mysql_error());
        }
        $db_selected = mysql_select_db($database_HRMS, $db);
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