<?php require_once('../Connections/HRMS.php'); ?>
<?php

include('Class_Terminated_Employee_Rollback.php'); 
$obj_Terminated_Rollback=new Terminated_Employee_Rollback();

echo "<form name=\"SelectedID4Update\"  action=\"Terminated_Employee_RollbackSetup3.php\" method=\"post\">";

echo "<input  name=\"IDNo\" type=\"hidden\" >";
session_start();
$_SESSION['IDNo']="";
if(isset($_POST['CHK']) && isset($_POST['Next']))
{
     $a = $_POST['CHK'];
     if(empty($a))
      {
       echo("You didn't select any Terminated Employee for RollBack to Current Employee.");
      }
     else
     {
      $N = count($a);
	  /*for($i=0; $i < $N; $i++)
       {
         $IDNumber=str_replace("'","",$a[$i]);
		
		$_SESSION['IDNo'].=",".$IDNumber;
	   }*/
      echo("You selected $N Employees(s): ");
	  
	  $obj_Terminated_Rollback->get_selected_terminated_employee($a);
	 
       }
	   	
		
    
}
echo "<p align=\"center\"><a href=\"Terminated_Employee_RollbackSetup.php\"><input type=\"button\" value=\"Before\" name=\"Before\" ></a>";	
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"Rollback\" value=\"Rollback to Current Employee\"></p>";
echo "</form>";	
		
?>