<?php 
class Salary_Increment{
	
	public function get_employee_list()
	{
		/* Selecting only those in the same month and half year worker employee */
	 $querySI  = "SELECT ID,FirstName,MiddelName,LastName,Department,Position,date_Employement FROM herburghrmsdb.employee_personal_record 
where MONTH(date_Employement)= MONTH(CURDATE()) OR 
((datediff(curdate(),date_Employement)/365)>=0.5 AND 
(datediff(curdate(),date_Employement)/365) < 0.6  )
 ORDER BY ID ASC";
				
	$resultSI = mysql_query($querySI);

	$stack = array();
	while($rowSI = mysql_fetch_array($resultSI, MYSQL_ASSOC))
				{
				
                array_push($stack, $rowSI['ID']);
                //print_r($stack);
				
				}
				
		return $stack;				
	}
	
	
	
	
	public function get_no_year($IDNumber)
	{
		 		$querySI  = "SELECT Date_Employement,datediff(curdate(),date_Employement) AS No_Days FROM herburghrmsdb.employee_personal_record where ID='".$IDNumber."'";
	$resultSI = mysql_query($querySI);
	$rowSI = mysql_fetch_array($resultSI);
	
	//echo $rowSI['Date_Employement']."<br/>"; 
	//echo "No of Days:".$rowSI['No_Days']."<br/>";
	//echo "Month:".($rowSI['No_Days']/30)."<br/>";
	
	//return $rowSI['No_Days']/365;
	if ((($rowSI['No_Days']/365) >= 0.5) AND (($rowSI['No_Days']/365) < 0.6))
	{
	return 0.5;
	}
	else
	{
	return floor($rowSI['No_Days']/365);
	}
	}
	
	
	
	public function get_Salary($IDNumber)
	{
		 		$querySI  = "SELECT Salary FROM herburghrmsdb.employee_personal_record where ID='".$IDNumber."'";
	$resultSI = mysql_query($querySI);
	$rowSI = mysql_fetch_array($resultSI);
	
	return $rowSI['Salary'];
	
	}
	
	
	
	
	public function get_Salary_Increment($inital,$NoYear)
	{
	  $querySI  = "SELECT Salary_Increment FROM herburghrmsdb.wage_allocation where Initial_Salary='".$inital."' and no_year=$NoYear";
	$resultSI = mysql_query($querySI);
	$rowSI = mysql_fetch_array($resultSI);
	
	return $rowSI['Salary_Increment'];
	
	}
	
	
	
	
	public function get_employee_Detail($IDNumber)
	{
		$querySI  = "SELECT ID,FirstName,MiddelName,LastName,Department,Position,date_Employement FROM herburghrmsdb.employee_personal_record 
where ID='".$IDNumber."' ORDER BY ID ASC";
	
	$resultSI = mysql_query($querySI);
	$rowSI = mysql_fetch_array($resultSI);
	
	return array($rowSI['FirstName'],$rowSI['MiddelName'],$rowSI['LastName'],$rowSI['Department'],$rowSI['Position'],$rowSI['date_Employement']);

	}
	
	
	
	
	public function Calcualte_Increment()
	
	{
		$stack =$this->get_employee_list();
		
		echo "<table >";
			echo "<th>ID</th>
			<th>Full Name</th>
			<th>Department</th>
			<th>Position</th>
			<th> Salaray</th>
			<th>Date of Employement</th>
			<th>No of Year</th>
			<th>After Increment</th>";
		foreach($stack as $value)
        {
           //echo $value . "<br />";
		   $IDNumber=$value;
	    list($FirstName,$MiddelName,$LastName,$Department,$Position,$date_Employement)=$this->get_employee_Detail($IDNumber);
		$NoYear=$this->get_no_year($IDNumber);
		$salary=$this->get_Salary($IDNumber);
		$Salary_After_Increment= $this->get_Salary_Increment($salary,$NoYear);
		
			echo "<tr> <td>";
			echo "<input type=\"checkbox\" name=\"CHK[]\" value=\"'".$IDNumber."'\">";
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
	
	
	public function Update_Salary($IDNumber)
		
		{
			$NoYear=$this->get_no_year($IDNumber);
			$salary=$this->get_Salary($IDNumber);
			$Salary_After_Increment= $this->get_Salary_Increment($salary,$NoYear);
			
			$sqlUPDT1="UPDATE herburghrmsdb.`employee_personal_record` SET 
	               `Salary`='".$Salary_After_Increment."' WHERE `ID`='".$IDNumber."'";
			$sqlUPDT2="UPDATE herburghrmsdb.`total_deduction` SET 
	               `Basic Salary`='".$Salary_After_Increment."' WHERE `ID`='".$IDNumber."'";
				   
			mysql_query($sqlUPDT1) or die(mysql_error());
	        mysql_query($sqlUPDT2) or die(mysql_error());
		
					
		}
	 
	
	
	
}

?>