<?php require_once('../../Connections/HRMS.php'); ?>
<?php 
include('../../Classes/Class_AccessLevel.php');
 $obj_AccessLevel = new AccessLevel();
echo $obj_AccessLevel->CHK_AccessLevel(); 
?>

<?php

include('../../Classes/Class_Terminated_Employee_Cleaner.php'); 
$obj_Terminated_Cleaner=new Terminated_Employee_Cleaner();

echo "<form name=\"SelectedID4Update\"  action=\"Terminated_Employee_CleanerSetup3.php\" method=\"post\">";

echo "<input  name=\"IDNo\" type=\"hidden\" >";
session_start();
$_SESSION['IDNo']="";
if(isset($_POST['CHK']) && isset($_POST['Next']))
{
     $a = $_POST['CHK'];
     if(empty($a))
      {
       echo("You didn't select any Terminated Employee to Cleaned.");
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
	  
	  $obj_Terminated_Cleaner->get_selected_terminated_employee($a);
	 
       }
	   	
		
    
}
echo "<p align=\"center\"><a href=\"Terminated_Employee_CleanerSetup.php\"><input type=\"button\" value=\"Before\" name=\"Before\" ></a>";	
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"Cleaner\" value=\"Clean\"></p>";
echo "</form>";	
		
?>