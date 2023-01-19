<?php
class Leave {
//var $initialALdays=14;

function get_name(){

return $this->name;
}

function set_name($new_name){

 $this->name=$new_name;
}
   public function AnnualLeaveCalcualte($initialALdays,$db,$ID,$FirstName)
   {

        //$query = "SELECT text FROM lang_$langid WHERE textid='$textid'";
       // $result = mysql_query($query) or die(mysql_error());
        // $row = mysql_fetch_array($result);
        //$text = $row[0];
		
		$sqlWM = "SELECT `ID` , FirstName ,MiddelName , LastName,`Date_Employement` ,
		period_diff( date_format( now( ) , '%Y%m' ) ,
		date_format( `Date_Employement` , '%Y%m' ) ) AS Workingmonths FROM 
		$db.employee_personal_record where ID= '".$ID."' and FirstName='".$FirstName."'";
				
		$resultWM = mysql_query($sqlWM) or die(mysql_error());
		
		$rowWM=mysql_fetch_array($resultWM);
		
		$WorkingMonth=$rowWM['Workingmonths'];
		
		$noyear=($rowWM['Workingmonths'])/12;
		
		$date_of_Employement=$rowWM['Date_Employement'];
		
		if ($noyear<1)
		{
								
		$TotalAL=round(($initialALdays)*$noyear); //calculating annual leave  for lessthan a year
		}					
		else
								
		if (is_float($noyear))
		{
								
			$fractionyear=($noyear)-floor($noyear); //getting fraction year
								
			$integerYear=floor($noyear);  //getting integer year
								
			$TotalAL=0;
								
			$LastYearLeaveday=$initialALdays+$integerYear-1;
								
			for($LastYearLeaveday;$LastYearLeaveday>=$initialALdays;$LastYearLeaveday--)
			{
				$TotalAL=$TotalAL+$LastYearLeaveday; //calculating integer year annual leave
			}					
			//calcualting fraction year annual leave year
			$fractionAL=round(($initialALdays+$integerYear)*$fractionyear*12)/12;
								
			$TotalAL=$TotalAL+$fractionAL;
								
		}
								
		else  //if it not float mean actual year
			{
				$TotalAL=0;
				$LastYearLeaveday=$initialALdays+$noyear-1;
				for($LastYearLeaveday;$LastYearLeaveday>=$initialALdays;$LastYearLeaveday--)
				{
					$TotalAL=$TotalAL+$LastYearLeaveday;
				}
							
			}
		
		/***** New rule adjustment addding 2 days on frist year and 1 day on second year ****/
		if (  $date_of_Employement >= "2010-03-01" ) 
		{
			if ($noyear<2)
		    $TotalAL=$TotalAL+2; //Adding 2 days on Total annual leave for lessthan 2 year 
		   else
		   if ($noyear>=2)	
			{			
		     $TotalAL=$TotalAL+1; //Adding 1 days on Total annual leave for morethan 2 years & lessthan 3 year
	         $TotalAL=$TotalAL+2; //Adding 2 days on Total annual leave for frist year to make 16
			}
		}
		 
	/*******************end of new rule******************/				
     return $TotalAL;		
	
    }
	
	public function AL3YearAllocation($TotalAL,$noyear)
	{
	   if ($noyear < 1.5)
		{		
		    $thisyear=$TotalAL;
		    $lastyear=0;
			$beforelastyear=0;
		}
							
		if(($noyear >= 1.5) AND ( $noyear <= 2.5))
		{															
			$thisyear=($TotalAL/2);
			$lastyear=($TotalAL/2)-1;
			$beforelastyear=0;
		}
														
		if ($noyear > 2.5) 
		{							    															
			$thisyear=($TotalAL/3);
			$lastyear=($TotalAL/3)-1;
			$beforelastyear=($TotalAL/3)-2;								
		}
		
		return array($thisyear,$lastyear,$beforelastyear);	
		
	}

	public function ALTotalTakenDay($db,$ID,$FirstName,$GrantDay)
	{
	    if(mysql_num_rows(mysql_query("SELECT * FROM $db.`annual_leave_calculate` WHERE ID='".$ID."' and FirstName='".$FirstName."'")))
	    {
						
	    $queryTotalAL  = "SELECT * FROM $db.`annual_leave_calculate` WHERE ID='".$ID."' and FirstName='".$FirstName."'";
		$resultTotalAL = mysql_query($queryTotalAL);
		$rowTotalAL = mysql_fetch_array($resultTotalAL);
        $TotalTakenDay= $rowTotalAL['TotalTakenDay']; //total leave taken before
		$TotalTakenDay= $TotalTakenDay + $GrantDay;
		return $TotalTakenDay;
		}
		else{
			 $TotalTakenDay=0;
			 $TotalTakenDay= $TotalTakenDay + $GrantDay;
			 return $TotalTakenDay;
			}
	}
	
	public function ALYearAllocation($totalALdays,$initialALdays,$dateofemployeement)
	{
	
	    //$de=$row['Date_Employement'];
		$de=$dateofemployeement;
		$current=date('Y-m-d');
		//$initialALdays=14;
		
		list($DEyear,$DEmonth,$DEday,$DEhour,$DEminute,$DEsecond)=explode('-',date('Y-m-d-h-i-s',strtotime($de)));
		
		list($currentyear,$currentmonth,$currentday,$currenthour,$currentminute,$currentsecond)=explode('-',date('Y-m-d-h-i-s',strtotime($current)));
				
		$yeardiff=$this->datediff('yyyy', $de,$current, false);
		$monthdiff=$this->datediff('m', $de,$current , false);
		$datediff1=$this->datediff('d', $de,$current , false);	
				
												
		echo "<br><font color=\"#0000FF\" face=\"Times New Roman, Times, serif\" size=\"+1\">Yearly Allocation for Annual Leave : <font color=\"#FF0000\">".$totalALdays."</font></br>";
		 //assign the total for the current ccause the total is lessthan the initial
		if($totalALdays <= $initialALdays) 
		{
		echo "Year $currentyear - $currentmonth :<font color=\"#FF0000\">".$totalALdays."</font>"."</font></br>";
		}
		else
		if($totalALdays > $initialALdays)
		{
			$CurrentYearAL=$initialALdays+$yeardiff;
			//assign the total for the current ccause the total is lessthan the initial puls year diffrence mean hwat it belong for the year
			if($CurrentYearAL >= $totalALdays)
			{
			echo "Year $currentyear - $currentmonth :<font color=\"#FF0000\">".$totalALdays."</font>"."</font></br>";
			}
			else
			if($CurrentYearAL < $totalALdays)
			{
			$lastyear=$de+$yeardiff;  //final year 
			$currentyeardate=$de+$yeardiff."-".$DEmonth."-".$DEday.""; //final full year stay
			$currentdate=date("Y-m-d");
			
            $monthdiff3=$this->datediff('m', $currentyeardate,$currentdate , false)+1;			
			//date diff month diffrence make -1 of the th ediffrence so it shall be added one
						
			$CurrentYearALDays=($monthdiff3*($CurrentYearAL/12)); //annual leave for the year 
			
			echo "Year $lastyear - $DEmonth to Year $currentyear - $currentmonth :<font color=\"#FF0000\">".$CurrentYearALDays."</font>"."</br>";
			
			//deduct leave belong for final year form total for other allocation
			$totalALdays=$totalALdays-$CurrentYearALDays; 
						
			for($j=$CurrentYearAL;$j<=$totalALdays;$j=$CurrentYearAL--)
			 {
				//looping by deducting what is assign for the year
			  $totalALdays=$totalALdays-$CurrentYearAL; 
			
			   $prvyear=$lastyear-1;
			  			
			  echo "Year $prvyear - $DEmonth  to Year $lastyear - $DEmonth <font color=\"#FF0000\">".$CurrentYearAL."</font><br/>";
			  
				$lastyear=$lastyear-1;
							
			  }
			  //assign for the year which is not assign full annual leave
			  if(isset($prvyear))
			  $DEyear=$prvyear-1;
			  else
			  $prvyear=$lastyear;
			echo "Year $DEyear - $DEmonth  to Year $prvyear - $DEmonth <font color=\"#FF0000\">".$totalALdays."</font></font><br/>";
			
			}
					
		}
		
      }
	  
public function ALTotalLeftDay($totalALdays,$TotalTakenDay)
	{
	
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
 switch($interval)
 { case 'yyyy': 
 // Number of full years 
 $years_difference = floor($difference / 31536000);
 if (mktime(date("H", $datefrom), 
 date("i", $datefrom), date("s", 
 $datefrom), date("n", $datefrom),
 date("j", $datefrom), date("Y",
 $datefrom)+$years_difference) > $dateto) { 
 $years_difference--;
 } if (mktime(date("H", $dateto),
 date("i", $dateto), date("s", $dateto), 
 date("n", $dateto), date("j", $dateto),
 date("Y", $dateto)-($years_difference+1)) > $datefrom) 
 { $years_difference++; 
 } $datediff = $years_difference; break;
 case "q": // Number of full quarters 
 $quarters_difference = floor($difference / 8035200);
 while (mktime(date("H", $datefrom), date("i", $datefrom),
 date("s", $datefrom), date("n", $datefrom)+($quarters_difference*3),
 date("j", $dateto), date("Y", $datefrom)) < $dateto) { 
 $months_difference++;
 } $quarters_difference--;
 $datediff = $quarters_difference; 
 break; case "m": // Number of full months 
 $months_difference = floor($difference / 2678400);
 while (mktime(date("H", $datefrom), date("i", $datefrom), 
 date("s", $datefrom), date("n", $datefrom)+($months_difference),
 date("j", $dateto), date("Y", $datefrom)) < $dateto) { 
 $months_difference++; } $months_difference--;
 $datediff = $months_difference; break; 
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
 break; case "ww": // Number of full weeks 
 $datediff = floor($difference / 604800);
 break; 
 case "h": // Number of full hours 
 $datediff = floor($difference / 3600); 
 break; case "n": // Number of full minutes 
 $datediff = floor($difference / 60); 
 break; 
 default: // Number of full seconds  (default) 
 $datediff = $difference; 
 break;
 } return $datediff; } 	

 public function CHK_Leave_Existance($ID,$Leave_Taken_Date)
 {
$queryLE="SELECT `ID`,`LeaveType` FROM `annual_leave` WHERE `ID`='".$ID."' and '".$Leave_Taken_Date."'>=Leave_taken_date and '".$Leave_Taken_Date."'<=ReportOn
UNION ALL

SELECT `ID`,`LeaveType` FROM `funeral_leave` WHERE `ID`='".$ID."' and '".$Leave_Taken_Date."'>=FuneralLeave_taken_date and '".$Leave_Taken_Date."'<=ReportOn

UNION ALL

SELECT `ID`,`LeaveType` FROM `Sick_leave` WHERE `ID`='".$ID."' and '".$Leave_Taken_Date."'>=SickLeave_taken_date and '".$Leave_Taken_Date."'<=ReportOn

UNION ALL

SELECT `ID`,`LeaveType` FROM `Maternity_leave` WHERE `ID`='".$ID."' and '".$Leave_Taken_Date."'>=MaternityLeave_taken_date and '".$Leave_Taken_Date."'<=ReportOn

UNION ALL

SELECT `ID`,`LeaveType` FROM `Paternity_leave` WHERE `ID`='".$ID."' and '".$Leave_Taken_Date."'>=PaternityLeave_taken_date and '".$Leave_Taken_Date."'<=ReportOn

UNION ALL

SELECT `ID`,`LeaveType` FROM `Special_leave` WHERE `ID`='".$ID."' and '".$Leave_Taken_Date."'>=SpecialLeave_taken_date and '".$Leave_Taken_Date."'<=ReportOn

UNION ALL

SELECT `ID`,`LeaveType` FROM `Wedding_leave` WHERE `ID`='".$ID."' and '".$Leave_Taken_Date."'>=WeddingLeave_takendate and '".$Leave_Taken_Date."'<=ReportOn";

    

     if(mysql_num_rows(mysql_query($queryLE)))
    {   
	    $resultLE=mysql_query($queryLE);
		
		$rowLE=mysql_fetch_array($resultLE);
		
		$LeaveType=$rowLE['LeaveType']; 
		
		return $LeaveType;
     }
	 else	 
        return false;
 }


}
?>