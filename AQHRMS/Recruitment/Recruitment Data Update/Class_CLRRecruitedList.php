<?php 
class CLR_Recruited_List{
	
	public function CLR()
	{
		
		 
		
	    if(mysql_num_rows(mysql_query("SELECT `recruitment`.ID,`recruitment`.Date,curdate(),datediff(curdate(),`recruitment`.Date)

 FROM `employee_personal_record` INNER JOIN `recruitment` ON `recruitment`.ID=`employee_personal_record`.ID
WHERE datediff(curdate(),`recruitment`.Date) > 45
 ORDER BY `recruitment`.`ID`")))
	    {
						
	    $query = "SELECT `recruitment`.ID,`recruitment`.Date,curdate(),datediff(curdate(),`recruitment`.Date)

 FROM `employee_personal_record` INNER JOIN `recruitment` ON `recruitment`.ID=`employee_personal_record`.ID
WHERE datediff(curdate(),`recruitment`.Date) > 45
 ORDER BY `recruitment`.`ID` ";
		$result = mysql_query($query);
		while($row = mysql_fetch_array($result, MYSQL_ASSOC))
			{
        $IDNO= $row['ID'];
		$queryDEL ="DELETE FROM `recruitment` where `recruitment`.`ID`='".$IDNO."'";
		mysql_query($queryDEL);
			}
		 
echo "<script type=\"text/javascript\"> alert('The Recruitement List is Cleared Successfully!!')</script> ";
		}
		
	}
	
	
	
}


?>