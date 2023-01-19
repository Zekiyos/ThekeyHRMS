<?php 

class Personal_info{
	
	
	public function Basic_Info($IDNumber,$lang)
	{
		 		$queryBI  = "SELECT * FROM employee_personal_record where ID='".$IDNumber."'";
	$resultBI = mysql_query($queryBI);
	$rowBI = mysql_fetch_array($resultBI);
	if($lang=="English")
	{
	echo "<font color=\"#FF0000\">ID: {$rowBI['ID']} </font>";
	echo "<br/>Name:";
	echo "{$rowBI['FirstName']}";											
	echo " {$rowBI['MiddelName']}";
	echo " {$rowBI['LastName']}";
	echo "  </em> <br /><em>was born  ";             
    echo "{$rowBI['Date_Birth']}";
	
	$DateofBirth=$rowBI['Date_Birth'];
	$current=date('Y-m-d');
	if(date('m')<10)
	{
			
	$currentEC = mktime(0, 0, 0, date("m")+4, date("d")+10, date('Y')-8);
	$current=date("Y-m-d", $currentEC);	
	}
	else
	{
	$currentEC = mktime(0, 0, 0, date("m")-10, date("d")+10, date('Y')-8);
	$current=date("Y-m-d", $currentEC);	
	}
	
	$yeardiff=$this->datediff('yyyy', $DateofBirth,$current, false);
	$monthdiff=$this->datediff('m', $DateofBirth,$current , false);
	$datediff1=$this->datediff('d', $DateofBirth,$current , false);	
	
	echo " , {$yeardiff} Years Old.<br />";	 		
	 $sex=$rowBI['Sex']; 
	echo "{$rowBI['Sex']}<br/>"; 
	 
     if($rowBI['Experience']!="")
      {  echo "{$rowBI['Experience']} experienced <br />"; 
	  }
	     if($rowBI['Email']!="")
      { 
	     echo "   Email: <em> {$rowBI['Email']} <br />";
       }
	   
	  echo  " employeed on<em>";
      echo "{$rowBI['Date_Employement']}"; 
      echo "in {$rowBI['Department']}";	
      echo "as {$rowBI['Position']}";
      echo "<br>Monthly salary ".$rowBI['Salary']." birr";
	  echo "<br>Education Status ".$rowBI['Educational_Status']."";
	}
	else
	{
		
   echo "<em>የተወለደው {$rowBI['Date_Birth']}";
   echo ", {$rowBI['Age']} አመቱ(ቷ) ነው፡፡	"; 
	 	 		
	 $sex=$rowBI['Sex'];
	  	
   echo "{$rowBI['Sex']}<br/>"; 
     if($rowBI['Experience']!="")
      {   
	     echo "የስራ ልምድ  {$rowBI['Experience']}<br />"; 
      }
   if($rowBI['Email']!="")
     {  
      echo "ኢሜል: <em>{$rowBI['Email']}<br /> "; 
     } 
   echo "የተቀጠረው(ችው) በቀን<em> {$rowBI['Date_Employement']}";
   echo " በ {$rowBI['Department']}";   			 		
   echo " እንደ {$rowBI['Position']} ሰራተኝነት";
   echo "<br>የወር ደመወዝ  ".$rowBI['Salary']." ብር";	
	}
					
	}
					
	public function Leaves($IDNumber)
	{
		/***********        Annual Leave             *********/
		$queryAL  = "SELECT * FROM annual_leave where ID='".$IDNumber."'";
		$resultAL = mysql_query($queryAL);
	while($rowAL = mysql_fetch_array($resultAL, MYSQL_ASSOC))
	{
		echo " <li>Number Of Annual leave " .$rowAL['FirstName']." tooks" ;
		echo " {$rowAL['Leavedays']} ";
		echo "days on"." {$rowAL['Leave_Taken_Date']}"."<br/>";
                
	}
		
	/***********        Sick Leave             *********/
		$querySL = "SELECT * FROM sick_leave where ID='".$IDNumber."'";
	    $resultSL = mysql_query($querySL);
	 
	 while($rowSL = mysql_fetch_array($resultSL, MYSQL_ASSOC))
	  {
	   echo " <li>Number Of Sick leave " .$rowSL['FirstName']." tooks" ;
	   echo " {$rowSL['SickLeaveDays']} ";
	   echo "on"." {$rowSL['SickLeave_Taken_Date']}";
	  }
	  
	  /***********        Maternity Leave             *********/
	     $queryML  = "SELECT * FROM Maternity_leave where ID='".$IDNumber."'";
		 $resultML = mysql_query($queryML);
	while($rowML = mysql_fetch_array($resultML, MYSQL_ASSOC))
	 {		
	   echo "<br> <li>Number Of Maternity leave " .$rowML['FirstName']." tooks" ;
	   echo " {$rowML['MaternityLeaveDays']} ";
	   echo "on"." {$rowML['MaternityLeave_Taken_Date']}";
                 
	 }
			/***********        Wedding Leave             *********/		 
       	$queryWL  = "SELECT * FROM paternity_leave where ID='".$IDNumber."'";
		$resultWL = mysql_query($queryWL);
	while($rowWL = mysql_fetch_array($resultWL, MYSQL_ASSOC))
	 {
		echo "<br> <li>Number Of Paternity leave " .$rowWL['FirstName']." tooks" ;
		echo " {$rowWL['PaternityLeaveDays']} ";
		echo "on"." {$rowWL['PaternityLeave_Taken_Date']}";
     }
			/***********        Funeral Leave             *********/	 
		$queryFL  = "SELECT * FROM Funeral_leave where ID='".$IDNumber."'";
		$resultFL = mysql_query($queryFL);
	while($rowFL = mysql_fetch_array($resultFL, MYSQL_ASSOC))
	 {		
	    echo "<br> <li>Number Of Funeral leave " .$rowFL['FirstName']." tooks" ;
		echo " {$rowFL['FuneralLeaveDays']} ";
		echo "on"." {$rowFL['FuneralLeave_Taken_Date']}";
  	}	 	
	   /***********        Wedding Leave             *********/
		$queryWL  = "SELECT * FROM Wedding_leave where ID='".$IDNumber."'";
		$resultWL = mysql_query($queryWL);
	while($rowWL = mysql_fetch_array($resultWL, MYSQL_ASSOC))
	 {		
	   echo "<br> <li>Number Of Wedding leave " .$rowWL['FirstName']." tooks" ;
	   echo " {$rowWL['WeddingLeavedays']} ";
	   echo "on"." {$rowWL['WeddingLeave_TakenDate']}";
     }
	 
	 /***********        Special Leave             *********/
	 	$querySPL  = "SELECT * FROM Special_leave where ID='".$IDNumber."'";
		$resultSPL = mysql_query($querySPL);
	while($rowSPL = mysql_fetch_array($resultSPL, MYSQL_ASSOC))
	 {
		echo "<br> <li>Number Of Special leave " .$rowSPL['FirstName']." tooks" ;
		echo " {$rowSPL['SpecialLeaveDays']} ";
		echo "on"." {$rowSPL['SpecialLeave_Taken_Date']}";
      }
	}
	
	/***********        Equipment Handover            *********/
 public function Equipment($IDNumber)
 {
	 $queryEQ  = "SELECT * FROM equipment_handover where ID='".$IDNumber."'";
	 $resultEQ = mysql_query($queryEQ);
	while($rowEQ = mysql_fetch_array($resultEQ, MYSQL_ASSOC))
	{
		echo "</blockquote></blockquote><blockquote><blockquote><blockquote><b><u>Equipments</b></blockquote></u></blockquote></blockquote><li type=\"circle\">{$rowEQ['FirstName']} took ";
		echo "{$rowEQ['EquipmentName']} on date {$rowEQ['Taken_Date']}.It should be replaced on<font color=\"#FF0000\"> {$rowEQ['Replacement_Date']} </font>";
	}
					
 }
	
	/***********        Training          *********/
 public  function Training ($IDNumber)
 {
	  $queryTR  = "SELECT * FROM training where ID='".$IDNumber."'";
	  $resultTR = mysql_query($queryTR);
	while($rowTR = mysql_fetch_array($resultTR, MYSQL_ASSOC))
	{
		echo "</u></blockquote></blockquote><blockquote><blockquote><blockquote><b><u>Training</u></b></blockquote></blockquote></blockquote> <li type=\"circle\">{$rowTR['FirstName']} took ";
		echo "{$rowTR['TrainingName']} training from {$rowTR['Training_Start_Date']} to {$rowTR['Training_End_Date']}  and  he/she  {$rowTR['Status']} the training.";
	}
	
 }
 
 
 public function Disciplinary_Action($IDNumber)
 {
	   $queryDA  = "SELECT * FROM Disciplinary_action where ID='".$IDNumber."'";
		$resultDA = mysql_query($queryDA);
	 while($rowDA = mysql_fetch_array($resultDA, MYSQL_ASSOC))
	  {
		 	echo "<blockquote><blockquote><blockquote> <b><u>Discipline Action</u></blockquote></blockquote></blockquote> </b>";
			echo " ".$rowDA['FirstName']." Receive:- <br>" ;
				if ( $rowDA['First_Inistance'] != "")
				{
				  echo "<blockquote><blockquote><li type=\"Square\"> First Instance Warning ";
				}
				if ( $rowDA['Second_Inistance'] != "")
				 {
				   echo "<li type=\"Square\"> Second Instance Warning ";
				 }
				 if ( $rowDA['Third_Inistance'] != "")
				 {
				   echo "<li type=\"Square\"> Third Instance Warning ";
				 }
				 if ( $rowDA['Last_Warning'] != "")
				 {
				  echo "<li type=\"Square\"> Last Warning </blockquote></blockquote>";
				 }
		 }
	
  }
 
 
 public function Job_Description($IDNumber)
 {
     $queryJB ="SELECT `employee_personal_record`.ID,Job_Description,Job_Description_Amharic FROM `contract_letter` JOIN `employee_personal_record` ON Contract_letter.Department =`employee_personal_record`.Department WHERE `employee_personal_record`.ID = '".$IDNumber."'";
						
	 $resultJB = mysql_query($queryJB);
	while($rowJB = mysql_fetch_array($resultJB, MYSQL_ASSOC))
	{
	   	echo "<blockquote><blockquote><blockquote> <b><u>Job Description</u></blockquote></blockquote></blockquote> </b>";
		echo "{$rowJB['Job_Description']}";
				
	 }

 }
 
 public function HardCopy_Location($IDNumber)
 {
	   $query  = "SELECT * FROM employee_personal_record where ID='".$IDNumber."'";
	   $result = mysql_query($query);
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		echo "<br></blockquote></blockquote><font color=\"#FF6600\" size=\"+1\">Hard Copy file exist in :";
		echo "{$row['HardCopy_Shelf_No']}</font>";
	}
 }
 
 ////////////////////////***************
 
 
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

 
 
 
 //////////////////////////*************
 
 
 
	
}//Class Closing Brace



?>