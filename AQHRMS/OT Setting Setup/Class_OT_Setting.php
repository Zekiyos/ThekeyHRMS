<?php 
class OT_Setting{
	
	public function get_employee_list($db,$Department)
	{
		/* Selecting only those in the same month and half year worker employee */
	 $queryOT  = "SELECT ID,FirstName,MiddelName,LastName,Department,Position,date_Employement FROM $db.employee_personal_record 
 where Department='".$Department."' ORDER BY Department,ID ASC";
				
	$resultOT = mysql_query($queryOT);

	$stack = array();
	
	while($rowOT = mysql_fetch_array($resultOT, MYSQL_ASSOC))
				{
				
                array_push($stack, $rowOT['ID']);
                //print_r($stack);
				
				}
				
		return $stack;				
	}
	
	
	public function get_employee_Detail($db,$IDNumber)
	{
		$queryOT  = "SELECT ID,FirstName,MiddelName,LastName,Department,Position,date_Employement FROM $db.employee_personal_record 
where ID='".$IDNumber."'  ORDER BY ID ASC";
	
	$resultOT = mysql_query($queryOT);
	$rowOT = mysql_fetch_array($resultOT);
	
	return array($rowOT['FirstName'],$rowOT['MiddelName'],$rowOT['LastName'],$rowOT['Department']);

	}
	
	
	public function get_department_list($db,$Department)
	{
		/* Selecting only those in the same month and half year worker employee */
	 $queryOT  = "SELECT Department FROM $db.department where Department=$Department
 ORDER BY Department ASC";
				
	$resultOT = mysql_query($queryOT);

	echo "<select id=\"Department\">";
	while($rowOT = mysql_fetch_array($resultOT, MYSQL_ASSOC))
				{
				
                echo "<option>{$rowOT['Department']}</option>";
                				
				}
				
	echo "</select>";				
	}
	
	public function OT_Setting_List($Department)
	
	{
		$stack =$this->get_employee_list("aqhrmsdb",$Department);
		
		echo "<table align=\"center\" >";
			echo "<th align=\"center\">ID</th>
			     <th align=\"center\">Full Name</th>
			     <th align=\"center\">Department</th>";
			
		    echo "<th align=\"center\">
			<input type=\"checkbox\" id=\"CHKALL_DayOT\" name=\"CheckAll_DayOT\" onclick=\"checkAll(document.SelectedID['CHK_DayOT[]'])\" />DAY OT</th>
			     <th align=\"center\">
				 <input type=\"checkbox\" id=\"CHKALL_NightOT\" name=\"CheckAll_NightOT\" onclick=\"checkAll(document.SelectedID['CHK_NightOT[]'])\" />Night OT</th>
			     <th align=\"center\">
				 <input type=\"checkbox\" id=\"CHKALL_SundayOT\" name=\"CheckAll_SundayOT\" onclick=\"checkAll(document.SelectedID['CHK_SundayOT[]'])\" />Sunday OT</th>
			     <th align=\"center\">
				 <input type=\"checkbox\" id=\"CHKALL_HolydayOT\" name=\"CheckAll_HolydayOT\" onclick=\"checkAll(document.SelectedID['CHK_HolydayOT[]'])\" />Holyday OT</th>";
				
			
		foreach($stack as $value)
        {
           //echo $value . "<br />";
		   $IDNumber=$value;
	    list($FirstName,$MiddelName,$LastName,$Department)=$this->get_employee_Detail("AQHRMSDB",$IDNumber);
		
		    
		
			echo "<tr align=\"center\"> <td>";
			echo "<input type=\"checkbox\" name=\"CHK_ID[]\" value=\"'".$IDNumber."'\">";
			echo $IDNumber;
			echo "</td>";
			
			echo "<td align=\"left\">";
			echo "$FirstName $MiddelName $LastName";
			echo "</td>";
			
			echo "<td>";
			echo "$Department";
			echo "</td>";
			
			echo "<td>";
			echo "<input type=\"checkbox\" id=\"CHK_DayOT[]\" name=\"CHK_DayOT[]\" value=\"'".$IDNumber."'\">";
			echo "</td>";
									
			echo "<td>";
			echo "<input type=\"checkbox\" name=\"CHK_NightOT[]\" value=\"'".$IDNumber."'\">";
			echo "</td>";
			
			echo "<td>";
			echo "<input type=\"checkbox\" name=\"CHK_SundayOT[]\" value=\"'".$IDNumber."'\">";
			echo "</td>";
			
			echo "<td>";
			echo "<input type=\"checkbox\" name=\"CHK_HolydayOT[]\" value=\"'".$IDNumber."'\">";
			echo "</td>";
			
			
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