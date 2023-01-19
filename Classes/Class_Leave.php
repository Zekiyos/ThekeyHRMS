<?php

class Leave {

//var $initialALdays=14;

    function get_name() {

        return $this->name;
    }

    function set_name($new_name) {

        $this->name = $new_name;
    }

    public function get_Company_Annual_Leave_Setting() {
        $queryCAL = "SELECT `Company_Name`,`Annual_Leave_Expiry_Year`,
       `Annual_Leave_Initial_Days`,  `Annual_Leave_CONST_Year`
FROM `company_settings`";
        if (mysql_num_rows(mysql_query($queryCAL))) {
            $resultCAL = mysql_query($queryCAL);

            $rowCAL = mysql_fetch_array($resultCAL);

            $Company_Name = $rowCAL['Company_Name'];

            $Annual_Leave_Expiry_Year = $rowCAL['Annual_Leave_Expiry_Year'];

            $Annual_Leave_Initial_Days = $rowCAL['Annual_Leave_Initial_Days'];

            $Annual_Leave_CONST_Year = $rowCAL['Annual_Leave_CONST_Year'];
            return array($Company_Name, $Annual_Leave_Expiry_Year, $Annual_Leave_Initial_Days, $Annual_Leave_CONST_Year);
        }
        else
            return false;
    }
	
	 public function get_annual_leave_setting($date_employeement) {
        $sql = "SELECT *
FROM `annual_leave_settings`
WHERE `Company_Name` LIKE 'Sher Ethiopia PLC' AND  '$date_employeement' BETWEEN `From_Date_Employement` AND `To_Date_Employement`";
//echo $sql;
         if (mysql_num_rows(mysql_query($sql))) {
            $resultCAL = mysql_query($sql);

            $rowCAL = mysql_fetch_array($resultCAL);

            $Company_Name = $rowCAL['Company_Name'];

            $Annual_Leave_Expiry_Year = $rowCAL['Annual_Leave_Expiry_Year'];

            $Annual_Leave_Initial_Days = $rowCAL['Annual_Leave_Initial_Days'];

            $Annual_Leave_CONST_Year = $rowCAL['Annual_Leave_CONST_Year'];
            return array($Company_Name, $Annual_Leave_Expiry_Year, $Annual_Leave_Initial_Days, $Annual_Leave_CONST_Year);
        }
        else
            return false;
    }

    public function AnnualLeaveCalcualte($initialALdays, $Annual_Leave_CONST_Year, $db, $ID, $FirstName) {


        $sqlWM = "SELECT `ID` , FirstName ,MiddelName , LastName,`Date_Employement` ,
		period_diff( date_format( now( ) , '%Y%m' ) ,
		date_format( `Date_Employement` , '%Y%m' ) ) AS Workingmonths FROM 
		$db.employee_personal_record where ID= '" . $ID . "'";

        $resultWM = mysql_query($sqlWM) or die(mysql_error());

        $rowWM = mysql_fetch_array($resultWM);

        $WorkingMonth = $rowWM['Workingmonths'];

        $noyear = ($rowWM['Workingmonths']) / 12;

        $date_of_Employement = $rowWM['Date_Employement'];

        if ($noyear < 1) {

            $TotalAL = round(($initialALdays) * $noyear); //calculating annual leave  for lessthan a year
        } else

        if (is_float($noyear)) {

            $fractionyear = ($noyear) - floor($noyear); //getting fraction year

            $integerYear = floor($noyear);  //getting integer year

            $TotalAL = 0;

            //calcualting fraction year annual leave year which laies on the last(current working) year 
            if ($Annual_Leave_CONST_Year > 0)
                $fractionAL = (($initialALdays + $integerYear + 1 - $Annual_Leave_CONST_Year) * $fractionyear);
            else
                $fractionAL = (($initialALdays + $integerYear) * $fractionyear);


            if ($Annual_Leave_CONST_Year > 0) {
                if ($integerYear < $Annual_Leave_CONST_Year)
                    $LastYearLeaveday = $initialALdays;
                else
                    $LastYearLeaveday = $initialALdays + $integerYear - $Annual_Leave_CONST_Year;
            }
            else
                $LastYearLeaveday = $initialALdays + $integerYear - 1;


            for ($LastYearLeaveday; $LastYearLeaveday > $initialALdays; $LastYearLeaveday--) {

                $TotalAL = $TotalAL + $LastYearLeaveday; //calculating integer year annual leave
            }

            if ($Annual_Leave_CONST_Year == 0) {

                $TotalAL = $TotalAL + $LastYearLeaveday; //calculating employement year annual leave
            }

            if ($Annual_Leave_CONST_Year > 0) {
                /*                 * ***If working year lessthan al constant year it should be deducted by 1** */
                if ($integerYear < $Annual_Leave_CONST_Year)
                    $Annual_Leave_CONST_Year = $integerYear; //$Annual_Leave_CONST_Year-1;
                for ($Annual_Leave_CONST_Year; $Annual_Leave_CONST_Year > 0; $Annual_Leave_CONST_Year--) {

                    $TotalAL = $TotalAL + $LastYearLeaveday; //calculating integer year annual leave
                }
            }


            $TotalAL = $TotalAL + $fractionAL;
        } else {  //if it not float mean Integer year which is  calculated on employeement date
            $TotalAL = 0;

            if ($Annual_Leave_CONST_Year > 0) {
                if ($noyear < $Annual_Leave_CONST_Year)
                    $LastYearLeaveday = $initialALdays;
                else
                    $LastYearLeaveday = $initialALdays + $noyear - $Annual_Leave_CONST_Year;
            }
            else
                $LastYearLeaveday = $initialALdays + $noyear - 1;

            for ($LastYearLeaveday; $LastYearLeaveday > $initialALdays; $LastYearLeaveday--) {
                $TotalAL = $TotalAL + $LastYearLeaveday;
            }

            if ($Annual_Leave_CONST_Year == 0) {

                $TotalAL = $TotalAL + $LastYearLeaveday; //calculating employement year annual leave
            }


            //listing all years which start constant Annual Leave year 
            if ($Annual_Leave_CONST_Year > 0) {
                /*                 * ***If working year lessthan al constant year it should be deducted by 1** */
                if ($noyear < $Annual_Leave_CONST_Year)
                    $Annual_Leave_CONST_Year = $noyear;

                for ($Annual_Leave_CONST_Year; $Annual_Leave_CONST_Year > 0; $Annual_Leave_CONST_Year--) {
                    $TotalAL = $TotalAL + $LastYearLeaveday; //calculating integer year annual leave
                }
            }
        }


        return $TotalAL;
    }

    public function AL3YearAllocation($TotalAL, $noyear) {
        if ($noyear < 1.5) {
            $thisyear = $TotalAL;
            $lastyear = 0;
            $beforelastyear = 0;
        }

        if (($noyear >= 1.5) AND ( $noyear <= 2.5)) {
            $thisyear = ($TotalAL / 2);
            $lastyear = ($TotalAL / 2) - 1;
            $beforelastyear = 0;
        }

        if ($noyear > 2.5) {
            $thisyear = ($TotalAL / 3);
            $lastyear = ($TotalAL / 3) - 1;
            $beforelastyear = ($TotalAL / 3) - 2;
        }

        return array($thisyear, $lastyear, $beforelastyear);
    }

    public function ALTotalTakenDay_old($db, $ID, $FirstName, $GrantDay) {
        if (mysql_num_rows(mysql_query("SELECT * FROM $db.`annual_leave_calculate` WHERE ID='" . $ID . "' and FirstName='" . $FirstName . "'"))) {

            $queryTotalAL = "SELECT * FROM $db.`annual_leave_calculate` WHERE ID='" . $ID . "' and FirstName='" . $FirstName . "'";
            $resultTotalAL = mysql_query($queryTotalAL);
            $rowTotalAL = mysql_fetch_array($resultTotalAL);
            $TotalTakenDay = $rowTotalAL['TotalTakenDay']; //total leave taken before
            $TotalTakenDay = $TotalTakenDay + $GrantDay;
            return $TotalTakenDay;
        } else {
            $TotalTakenDay = 0;
            $TotalTakenDay = $TotalTakenDay + $GrantDay;
            return $TotalTakenDay;
        }
    }

    public function ALTotalTakenDay($db, $ID, $FirstName, $GrantDay) {
        if (mysql_num_rows(mysql_query("SELECT `ID` , `FirstName` , `MiddelName` , `LastName` , `Department` , SUM( `Leavedays` ) AS TotalTakenDay
FROM `annual_leave`
 WHERE ID='" . $ID . "' GROUP BY ID"))) {

            $queryTotalAL = "SELECT `ID` , `FirstName` , `MiddelName` , `LastName` , `Department` , SUM( `Leavedays` ) AS TotalTakenDay
FROM `annual_leave`
 WHERE ID='" . $ID . "' GROUP BY ID";
            $resultTotalAL = mysql_query($queryTotalAL);
            $rowTotalAL = mysql_fetch_array($resultTotalAL);
            $TotalTakenDay = $rowTotalAL['TotalTakenDay']; //total leave taken before
            $TotalTakenDay = $TotalTakenDay + $GrantDay;
            return $TotalTakenDay;
        } else {
            $TotalTakenDay = 0;
            $TotalTakenDay = $TotalTakenDay + $GrantDay;
            return $TotalTakenDay;
        }
    }

    public function ALYearAllocationX($totalALdays, $initialALdays, $Annual_Leave_CONST_Year, $dateofemployeement) {

        //$de=$row['Date_Employement'];
        $de = $dateofemployeement;
        $current = date('Y-m-d');
        //$initialALdays=14;

        list($DEyear, $DEmonth, $DEday, $DEhour, $DEminute, $DEsecond) = explode('-', date('Y-m-d-h-i-s', strtotime($de)));

        list($currentyear, $currentmonth, $currentday, $currenthour, $currentminute, $currentsecond) = explode('-', date('Y-m-d-h-i-s', strtotime($current)));


        $sqlWM = "SELECT period_diff( date_format( now( ) , '%Y%m' ) ,
		date_format( '" . $dateofemployeement . "' , '%Y%m' ) ) AS Workingmonths";

        $resultWM = mysql_query($sqlWM) or die(mysql_error());

        $rowWM = mysql_fetch_array($resultWM);

        $WorkingMonth = $rowWM['Workingmonths'];

        $noyear = ($rowWM['Workingmonths']) / 12;

        $monthdiff = $WorkingMonth;
        $yeardiff = $noyear;
        //$yeardiff=$this->datediff('yyyy', $de,$current, false);
        //$monthdiff=$this->datediff('m', $de,$current , false);
        $datediff1 = $this->datediff('d', $de, $current, false);
        echo "yeardiff " . $yeardiff . "<br/>";
        echo "monthdiff " . $monthdiff . "<br/>";
        echo "datediff1 " . $datediff1 . "<br/>";

        echo "<br><font color=\"#0000FF\" face=\"Times New Roman, Times, serif\" size=\"+1\">ቀሪ የአመት ፈቃድ/Yearly Allocation for Annual Leave  <font color=\"#FF0000\">" . $totalALdays . "</font> ቀናት / days</br>";
        //assign the total for the current ccause the total is lessthan the initial
        if ($totalALdays <= $initialALdays) {
            echo "Year $currentyear - $currentmonth :<font color=\"#FF0000\">" . $totalALdays . "</font>" . " ቀናት / days</font></br>";
        } else
        if ($totalALdays > $initialALdays) {
            if (is_float($yeardiff)) {

                $fractionyear = ($yeardiff) - floor($yeardiff); //getting fraction year

                $integerYear = floor($yeardiff);  //getting integer year
                //calcualting fraction year annual leave year which laies on the last(current working) year 
                if ($Annual_Leave_CONST_Year > 0) {
                    $fractionAL = (($initialALdays + $integerYear + 1 - $Annual_Leave_CONST_Year) * $fractionyear);
                    $lastyear = $de + $yeardiff;  //final year 
                    $currentyeardate = $de + $yeardiff . "-" . $DEmonth . "-" . $DEday . ""; //final full year stay
                    $currentdate = date("Y-m-d");

                    $CurrentYearALDays = $fractionAL;

                    echo "Year $lastyear - $DEmonth to Year $currentyear - $currentmonth <font color=\"#FF0000\">" . $CurrentYearALDays . "</font>" . " ቀናት / days</br>";
                } else {
                    $fractionAL = (($initialALdays + $integerYear + 1) * $fractionyear);
                    $lastyear = $de + $yeardiff;  //final year 
                    $currentyeardate = $de + $yeardiff . "-" . $DEmonth . "-" . $DEday . ""; //final full year stay
                    $currentdate = date("Y-m-d");

                    $CurrentYearALDays = $fractionAL;

                    echo "Year $lastyear - $DEmonth to Year $currentyear - $currentmonth <font color=\"#FF0000\">" . $CurrentYearALDays . "</font>" . " ቀናት / days</br>";
                }

                if ($Annual_Leave_CONST_Year > 0)
                    $LastYearLeaveday = $initialALdays + $integerYear - $Annual_Leave_CONST_Year - 1;
                else
                    $LastYearLeaveday = $initialALdays + $integerYear - 1;

                echo "integerYear" . $integerYear . "<br/>";
                //echo "LastYearLeaveday".$LastYearLeaveday."<br/>";				
                for ($LastYearLeaveday; $LastYearLeaveday > $initialALdays; $LastYearLeaveday--) {
                    echo "LastYearLeaveday" . $LastYearLeaveday . "<br/>";

                    $TotalAL = $TotalAL + $LastYearLeaveday; //calculating integer year annual leave
                    echo "TotalAL" . $TotalAL . "<br/>";
                }
                if ($Annual_Leave_CONST_Year > 0)
                    for ($Annual_Leave_CONST_Year; $Annual_Leave_CONST_Year > 0; $Annual_Leave_CONST_Year--) {
                        echo "LastYearLeaveday" . $LastYearLeaveday . "<br/>";

                        $TotalAL = $TotalAL + $LastYearLeaveday; //calculating integer year annual leave
                        echo "TotalAL" . $TotalAL . "<br/>";
                    }

                echo "TotalAL" . $TotalAL . "<br/>";
                $TotalAL = $TotalAL + $fractionAL;
                echo $TotalAL;


                /* if($Annual_Leave_CONST_Year>0)
                  {

                  echo "integerYear".$integerYear."<br/>";
                  $fractionAL=(($initialALdays+$integerYear+1-$Annual_Leave_CONST_Year)*$fractionyear);

                  $CurrentYearAL=$fractionAL;

                  $LastFullAL=$initialALdays+$integerYear;

                  }
                  else
                  {
                  $fractionAL=(($initialALdays+$integerYear+1)*$fractionyear);

                  $CurrentYearAL=$fractionAL;

                  $LastFullAL=$initialALdays+$integerYear-1;
                  }


                  }
                  else
                  {
                  if($Annual_Leave_CONST_Year>0)
                  {
                  $yeardiff=$yeardiff-$Annual_Leave_CONST_Year-1;

                  $CurrentYearAL=$initialALdays+$yeardiff-1;

                  $LastFullAL=$initialALdays+$yeardiff-1;

                  }
                  else
                  {
                  $CurrentYearAL=$initialALdays+$yeardiff-1;

                  $LastFullAL=$initialALdays+$yeardiff-1;
                  }

                 */
            }

            //$CurrentYearAL=$initialALdays+$yeardiff-1;
            echo "CurrentYearAL" . $CurrentYearAL . "<br/>";
            //assign the total for the current ccause the total is lessthan the initial puls year diffrence mean what it belong for the year
            if ($CurrentYearAL >= $totalALdays) {
                echo "Year $currentyear - $currentmonth :<font color=\"#FF0000\">" . $totalALdays . "</font>" . " ቀናት / days</font></br>";
            } else
            if ($CurrentYearAL < $totalALdays) {
                $lastyear = $de + $yeardiff;  //final year 
                $currentyeardate = $de + $yeardiff . "-" . $DEmonth . "-" . $DEday . ""; //final full year stay
                $currentdate = date("Y-m-d");

                /////$monthdiff3=$this->datediff('m', $currentyeardate,$currentdate , false)+1;	
                //date diff month diffrence make -1 of the th ediffrence so it shall be added one
                /////$CurrentYearALDays=($monthdiff3*($CurrentYearAL/12)); //annual leave for the year                       
                $CurrentYearALDays = $CurrentYearAL;

                echo "Year $lastyear - $DEmonth to Year $currentyear - $currentmonth <font color=\"#FF0000\">" . $CurrentYearALDays . "</font>" . " ቀናት / days</br>";

                //deduct leave belong for final year form total for other allocation
                $totalALdays = $totalALdays - $CurrentYearALDays;

                if ($Annual_Leave_CONST_Year > 0) {
                    //$LastFullAL=$LastFullAL-$Annual_Leave_CONST_Year+1;

                    for ($j = $LastFullAL; $j <= $totalALdays; $j = $LastFullAL--) {//looping by deducting what is assign for the year
                        // $CurrentYearAL=$CurrentYearAL;
                        if ($LastFullAL < $initialALdays) {
                            $LastFullAL = $initialALdays;
                        }

                        $totalALdays = $totalALdays - $LastFullAL;

                        $prvyear = $lastyear - 1;

                        echo "Year $prvyear - $DEmonth  to Year $lastyear - $DEmonth <font color=\"#FF0000\">" . $LastFullAL . "</font> ቀናት / days<br/>";

                        $lastyear = $lastyear - 1;
                    }
                } else {
                    for ($j = $LastFullAL; $j <= $totalALdays; $j = $LastFullAL--) {

                        //looping by deducting what is assign for the year
                        $totalALdays = $totalALdays - $LastFullAL;


                        $prvyear = $lastyear - 1;

                        echo "Year $prvyear - $DEmonth  to Year $lastyear - $DEmonth <font color=\"#FF0000\">" . $LastFullAL . "</font> ቀናት / days<br/>";

                        $lastyear = $lastyear - 1;
                    }
                }

                //assign for the year which is not assign full annual leave
                if (isset($prvyear))
                    $DEyear = $prvyear - 1;
                else
                    $prvyear = $lastyear;

                if ($totalALdays != 0)
                    echo "Year $DEyear - $DEmonth  to Year $prvyear - $DEmonth <font color=\"#FF0000\">" . $totalALdays . "</font> ቀናት / days</font><br/>";
            }
        }
    }

    public function ALTotalLeftDay($totalALdays, $TotalTakenDay) {

        $TotalLeftDays = $totalALdays - $TotalTakenDay;

        return $TotalLeftDays;
    }

    public function datediff($interval, $datefrom, $dateto, $using_timestamps = false) {
        /* $interval can be: yyyy - Number of full years 
          q - Number of full quarters
          m - Number of full months
          y - Difference between day numbers (eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".)
          d - Number of full days
          w - Number of full weekdays
          ww - Number of full weeks
          h - Number of full hours
          n - Number of full minutes
          s - Number of full seconds (default) */
        if (!$using_timestamps) {
            $datefrom = strtotime($datefrom, 0);
            $dateto = strtotime($dateto, 0);
        } $difference = $dateto - $datefrom;
        // Difference in seconds
        switch ($interval) {
            case 'yyyy':
                // Number of full years 
                $years_difference = floor($difference / 31536000);
                if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom) + $years_difference) > $dateto) {
                    $years_difference--;
                } if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto) - ($years_difference + 1)) > $datefrom) {
                    $years_difference++;
                } $datediff = $years_difference;
                break;
            case "q": // Number of full quarters 
                $quarters_difference = floor($difference / 8035200);
                while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom) + ($quarters_difference * 3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
                    $months_difference++;
                } $quarters_difference--;
                $datediff = $quarters_difference;
                break;
            case "m": // Number of full months 
                $months_difference = floor($difference / 2678400);
                while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom) + ($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
                    $months_difference++;
                }
                $months_difference--;
                $datediff = $months_difference;
                break;
            case 'y': // Difference between day numbers 
                $datediff = date("z", $dateto) - date("z", $datefrom);
                break;
            case "d": // Number of full days 
                $datediff = floor($difference / 86400);
                break;
            case "w": // Number of full weekdays 
                $days_difference = floor($difference / 86400);
                $weeks_difference = floor($days_difference / 7);  // Complete weeks 
                $first_day = date("w", $datefrom);
                $days_remainder = floor($days_difference % 7);
                $odd_days = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder? 
                if ($odd_days > 7) {  // Sunday 
                    $days_remainder--;
                } if ($odd_days > 6) {
                    // Saturday
                    $days_remainder--;
                } $datediff = ($weeks_difference * 5) + $days_remainder;
                break;
            case "ww": // Number of full weeks 
                $datediff = floor($difference / 604800);
                break;
            case "h": // Number of full hours 
                $datediff = floor($difference / 3600);
                break;
            case "n": // Number of full minutes 
                $datediff = floor($difference / 60);
                break;
            default: // Number of full seconds  (default) 
                $datediff = $difference;
                break;
        } return $datediff;
    }

    public function CHK_Leave_Existance($ID, $Leave_Taken_Date) {
     $queryLE = "SELECT `ID`,`LeaveType` FROM `annual_leave` WHERE `ID`='" . $ID . "' and '" . $Leave_Taken_Date . "'>=Leave_taken_date and '" . $Leave_Taken_Date . "'< ReportOn
UNION ALL

SELECT `ID`,`LeaveType` FROM `funeral_leave` WHERE `ID`='" . $ID . "' and '" . $Leave_Taken_Date . "'>=FuneralLeave_taken_date and '" . $Leave_Taken_Date . "'< ReportOn

UNION ALL

SELECT `ID`,`LeaveType` FROM `Sick_leave` WHERE `ID`='" . $ID . "' and '" . $Leave_Taken_Date . "'>=SickLeave_taken_date and '" . $Leave_Taken_Date . "'< ReportOn

UNION ALL

SELECT `ID`,`LeaveType` FROM `Maternity_leave` WHERE `ID`='" . $ID . "' and '" . $Leave_Taken_Date . "'>=MaternityLeave_taken_date and '" . $Leave_Taken_Date ."'< ReportOn

UNION ALL

SELECT `ID`,`LeaveType` FROM `Paternity_leave` WHERE `ID`='" . $ID . "' and '" . $Leave_Taken_Date . "'>=PaternityLeave_taken_date and '" . $Leave_Taken_Date . "'< ReportOn

UNION ALL

SELECT `ID`,`LeaveType` FROM `Special_leave` WHERE `ID`='" . $ID . "' and '" . $Leave_Taken_Date . "'>=SpecialLeave_taken_date and '" . $Leave_Taken_Date . "'< ReportOn

UNION ALL

SELECT `ID`,`LeaveType` FROM `Wedding_leave` WHERE `ID`='" . $ID . "' and '" . $Leave_Taken_Date . "'>=WeddingLeave_takendate and '" . $Leave_Taken_Date . "'< ReportOn";



        if (mysql_num_rows(mysql_query($queryLE))) {
            $resultLE = mysql_query($queryLE);

            $rowLE = mysql_fetch_array($resultLE);

            $LeaveType = $rowLE['LeaveType'];

            return $LeaveType;
        }
        else
            return false;
    }

    public function Clac_AL_Payment($TotlLeftAL, $SalaryPerDay) {

        return $Payment = $TotlLeftAL * $SalaryPerDay;
    }

    public function ALYearAllocation($totalALdays, $initialALdays, $Annual_Leave_CONST_Year, $dateofemployeement) {

        $de = $dateofemployeement;
        $current = date('Y-m-d');

        list($DEyear, $DEmonth, $DEday, $DEhour, $DEminute, $DEsecond) = explode('-', date('Y-m-d-h-i-s', strtotime($de)));

        list($currentyear, $currentmonth, $currentday, $currenthour, $currentminute, $currentsecond) = explode('-', date('Y-m-d-h-i-s', strtotime($current)));


        $sqlWM = "SELECT period_diff( date_format( now( ) , '%Y%m' ) ,
		date_format( '" . $dateofemployeement . "' , '%Y%m' ) ) AS Workingmonths";

        $resultWM = mysql_query($sqlWM) or die(mysql_error());

        $rowWM = mysql_fetch_array($resultWM);

        $WorkingMonth = $rowWM['Workingmonths'];

        $noyear = ($rowWM['Workingmonths']) / 12;

        $noyear = round($noyear, 2);

        echo "<br><font color=\"#0000FF\" face=\"Times New Roman, Times, serif\" size=\"+1\">ቀሪ የአመት ፈቃድ/Yearly Allocation for Annual Leave  <font color=\"#FF0000\">" . round($totalALdays,2) . "</font> ቀናት / days</br>";

        if ($noyear < 1) {

            $TotalAL = round(($initialALdays) * $noyear,2); //calculating annual leave  for lessthan a year

            $currentyeardate = $de + $noyear . "-" . $DEmonth . "-" . $DEday . ""; //final full year stay
            $currentdate = date("Y-m-d");

            $lastyear = $de + floor($noyear);  //final year 


            echo "Year $lastyear - $DEmonth to Year $currentyear - $currentmonth <font color=\"#FF0000\">" . round($totalALdays,2) . "</font>" . " ቀናት / days</br>";
        } else

        if (is_float($noyear)) {

            $fractionyear = ($noyear) - floor($noyear); //getting fraction year

            $integerYear = floor($noyear);  //getting integer year
            //calcualting fraction year annual leave year which laies on the last(current working) year 

            if ($Annual_Leave_CONST_Year > 0) {
                $fractionAL = (($initialALdays + $integerYear + 1 - $Annual_Leave_CONST_Year) * $fractionyear);
            } else {
                $fractionAL = (($initialALdays + $integerYear) * $fractionyear);
            }

            $lastyear = $de + $integerYear;  //final year 
            $currentyeardate = $de + $integerYear . "-" . $DEmonth . "-" . $DEday . ""; //final full year stay
            $currentdate = date("Y-m-d");



            //deducting fraction year from left annual leave
            $totalALdays = $totalALdays - $fractionAL;

            if ($totalALdays < $fractionAL)
                $CurrentYearALDays = $totalALdays;
            else
                $CurrentYearALDays = $fractionAL;

            echo "Year $lastyear - $DEmonth to Year $currentyear - $currentmonth <font color=\"#FF0000\">" . round($CurrentYearALDays,2) . "</font>" . " ቀናት / days</br>";



            $TotalAL = 0;

            if ($Annual_Leave_CONST_Year > 0) {
                if ($integerYear < $Annual_Leave_CONST_Year)
                    $LastYearLeaveday = $initialALdays;
                else
                    $LastYearLeaveday = $initialALdays + $integerYear - $Annual_Leave_CONST_Year;
            }
            else
                $LastYearLeaveday = $initialALdays + $integerYear - 1;


            for ($LastYearLeaveday; $LastYearLeaveday > $initialALdays; $LastYearLeaveday--) {



                //checking left AL is less than calcualted AL if it is so display which is left and exit(break) loop 				
                if ($totalALdays < $LastYearLeaveday) {

                    $Leaveday = $totalALdays;

                    break;
                } else {
                    $Leaveday = $LastYearLeaveday;
                }

                $prvyear = $lastyear - 1;

                echo "Year $prvyear - $DEmonth  to Year $lastyear - $DEmonth <font color=\"#FF0000\">" . round($Leaveday,2) . "</font> ቀናት / days<br/>";

                $lastyear = $lastyear - 1;

                $TotalAL = $TotalAL + $LastYearLeaveday; //calculating integer year annual leave
                //Deducting yearly calculated annual leave from total left to show only which is untaken leave
                $totalALdays = $totalALdays - $LastYearLeaveday;
            }

            if ($Annual_Leave_CONST_Year == 0) {
                //checking left AL is less than calcualted AL if it is so display which is left and exit loop 				
                if ($totalALdays < $LastYearLeaveday) {

                    $Leaveday = $totalALdays;
                } else {
                    $Leaveday = $LastYearLeaveday;
                }



                $prvyear = $lastyear - 1;
                if ($Leaveday != -1)
                    echo "Year $prvyear - $DEmonth  to Year $lastyear - $DEmonth <font color=\"#FF0000\">" . round($Leaveday,2) . "</font> ቀናት / days<br/>";

                $lastyear = $lastyear - 1;

                $TotalAL = $TotalAL + $LastYearLeaveday; //calculating integer year annual leave
                //Deducting yearly calculated annual leave from total left to show only which is untaken leave
                $totalALdays = $totalALdays - $LastYearLeaveday;
            }

            if ($Annual_Leave_CONST_Year > 0) {
                /*                 * ***If working year lessthan al constant year it should be deducted by full year** */
                if ($integerYear < $Annual_Leave_CONST_Year)
                    $Annual_Leave_CONST_Year = $integerYear;

                for ($Annual_Leave_CONST_Year; $Annual_Leave_CONST_Year > 0; $Annual_Leave_CONST_Year--) {



                    //checking left AL is less than calcualted AL if it is so display which is left and exit(break) loop 				
                    if ($totalALdays < $LastYearLeaveday) {

                        $Leaveday = $totalALdays;

                        $prvyear = $lastyear - 1;

                        echo "Year $prvyear - $DEmonth  to Year $lastyear - $DEmonth <font color=\"#FF0000\">" . round($Leaveday,2) . "</font> ቀናት / days<br/>";

                        $lastyear = $lastyear - 1;


                        $TotalAL = $TotalAL + $LastYearLeaveday; //calculating integer year annual leave
                        //Deducting yearly calculated annual leave from total left to show only which is untaken leave
                        $totalALdays = $totalALdays - $LastYearLeaveday;

                        break;
                    } else {
                        $Leaveday = $LastYearLeaveday;
                    }


                    $prvyear = $lastyear - 1;

                    echo "Year $prvyear - $DEmonth  to Year $lastyear - $DEmonth <font color=\"#FF0000\">" . round($Leaveday,2) . "</font> ቀናት / days<br/>";

                    $lastyear = $lastyear - 1;


                    $TotalAL = $TotalAL + $LastYearLeaveday; //calculating integer year annual leave
                    //Deducting yearly calculated annual leave from total left to show only which is untaken leave
                    $totalALdays = $totalALdays - $LastYearLeaveday;
                }
            }

            $TotalAL = $TotalAL + $fractionAL;
        } else {  //if it not float mean Integer year which is  calculated on employeement date
            $lastyear = $de + $noyear;
            $TotalAL = 0;
            //$LastYearLeaveday=$initialALdays+$noyear-1;

            if ($Annual_Leave_CONST_Year > 0) {
                if ($noyear < $Annual_Leave_CONST_Year)
                    $LastYearLeaveday = $initialALdays;
                else
                    $LastYearLeaveday = $initialALdays + $noyear - $Annual_Leave_CONST_Year;
            }
            else
                $LastYearLeaveday = $initialALdays + $noyear - 1;


            for ($LastYearLeaveday; $LastYearLeaveday > $initialALdays; $LastYearLeaveday--) {


                //checking left AL is less than calcualted AL if it is so display which is left and exit(break) loop 				
                if ($totalALdays < $LastYearLeaveday) {

                    $Leaveday = $totalALdays;
                    break;
                } else {
                    $Leaveday = $LastYearLeaveday;
                }


                $prvyear = $lastyear - 1;

                echo "Year $prvyear - $DEmonth  to Year $lastyear - $DEmonth <font color=\"#FF0000\">" . round($Leaveday,2) . "</font> ቀናት / days<br/>";

                $lastyear = $lastyear - 1;

                $TotalAL = $TotalAL + $LastYearLeaveday;
                //Deducting yearly calculated annual leave from total left to show only which is untaken leave
                $totalALdays = $totalALdays - $LastYearLeaveday;
            }


            if ($Annual_Leave_CONST_Year == 0) {
                //checking left AL is less than calcualted AL if it is so display which is left and exit loop 				
                if ($totalALdays < $LastYearLeaveday) {

                    $Leaveday = $totalALdays;
                } else {
                    $Leaveday = $LastYearLeaveday;
                }



                $prvyear = $lastyear - 1;
                //if($Leaveday!=-1)
                echo "Year $prvyear - $DEmonth  to Year $lastyear - $DEmonth <font color=\"#FF0000\">" . round($Leaveday,2) . "</font> ቀናት / days<br/>";

                $lastyear = $lastyear - 1;

                $TotalAL = $TotalAL + $LastYearLeaveday; //calculating integer year annual leave
                //Deducting yearly calculated annual leave from total left to show only which is untaken leave
                $totalALdays = $totalALdays - $LastYearLeaveday;
            }


            //listing all years which start constant Annual Leave year 
            if ($Annual_Leave_CONST_Year > 0) {
                /*                 * ***If working year lessthan al constant year it should be deducted by full year** */
                if ($noyear < $Annual_Leave_CONST_Year)
                    $Annual_Leave_CONST_Year = $noyear;

                for ($Annual_Leave_CONST_Year; $Annual_Leave_CONST_Year > 0; $Annual_Leave_CONST_Year--) {


                    //checking left AL is less than calcualted AL if it is so display which is left and exit loop 				
                    if ($totalALdays < $LastYearLeaveday) {

                        $Leaveday = $totalALdays;
                        $prvyear = $lastyear - 1;
                        echo "Year $prvyear - $DEmonth  to Year $lastyear - $DEmonth <font color=\"#FF0000\">" . round($Leaveday,2) . "</font> ቀናት / days<br/>";
                        $lastyear = $lastyear - 1;


                        $TotalAL = $TotalAL + $LastYearLeaveday; //calculating integer year annual leave
                        //Deducting yearly calculated annual leave from total left to show only which is untaken leave
                        $totalALdays = $totalALdays - $LastYearLeaveday;

                        break;
                    } else {
                        $Leaveday = $LastYearLeaveday;
                    }

                    $prvyear = $lastyear - 1;

                    echo "Year $prvyear - $DEmonth  to Year $lastyear - $DEmonth <font color=\"#FF0000\">" . round($Leaveday,2) . "</font> ቀናት / days<br/>";

                    $lastyear = $lastyear - 1;


                    $TotalAL = $TotalAL + $LastYearLeaveday; //calculating integer year annual leave
                    //Deducting yearly calculated annual leave from total left to show only which is untaken leave
                    $totalALdays = $totalALdays - $LastYearLeaveday;
                }
            }
        }
    }

}

?>