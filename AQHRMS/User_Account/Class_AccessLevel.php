<?php /*
require_once('../Connections/HRMS.php');

$db_selected = mysql_select_db($database_HRMS, $HRMS);
if (!$db_selected) {
    die ('Can\'t use database : ' . mysql_error());
}
 */?>
<?php
class AccessLevel{

public  function __construct() {
	
     $hostname_HRMS = "localhost";
     $database_HRMS = "aqhrmsdb";
     $username_HRMS = "root";
     $password_HRMS = "";
     $HRMS = mysql_pconnect($hostname_HRMS, $username_HRMS, $password_HRMS) or trigger_error(mysql_error(),E_USER_ERROR); 
     mysql_set_charset('utf8',$HRMS); 

     $db_selected = mysql_select_db($database_HRMS, $HRMS);
     if (!$db_selected)
      {
       die ('Can\'t use database : ' . mysql_error());
      }
   }

public function get_pagename()
{
	//return basename(dirname(realpath(__FILE__)))."/".basename(realpath(__FILE__))."";
	$pagepath="http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI'];
	return $pagepath;
}


public function Granted_AccessLevel($PageName,$AccessLevel)
{
	$sqlINST="INSERT INTO `access_level_privilege` 
			(`PageName`, `Granted_Access_Level`) VALUES ('".$PageName."','".$AccessLevel."')";			
				
	mysql_query($sqlINST);
		
}

public function get_Granted_AccessLevel($PageName)
{

$sqlGranted="Select `Granted_Access_Level` from access_level_privilege WHERE `PageName` LIKE '%".$PageName."%'";
	$resultGranted = mysql_query($sqlGranted) or die(mysql_error());
	
	$rowGranted=mysql_fetch_array($resultGranted);
	$Granted_Access_Level=$rowGranted['Granted_Access_Level'];
	//append comma for separtion from administartor access level
	$Granted_Access_Level=",".$Granted_Access_Level; 	
	return $Granted_Access_Level;
}

public function set_AccessLevel($PageDesc,$PageName,$AccessLevel){
	
	if(mysql_num_rows(mysql_query("SELECT * FROM `access_level_privilege` WHERE `PageName` LIKE '%".$PageName."%'"))){
		
		//if the page previlage is exist appen the value by contactinating ,with access level
		$sqlUPDT="UPDATE `access_level_privilege` set `Granted_Access_Level`= CONCAT( `Granted_Access_Level`,',".$AccessLevel."') WHERE `PageName`='".$PageName."'";
		mysql_query($sqlUPDT);
		
	}else
	{
		//if the page access level is not there insert as first.
	$sqlINST="INSERT INTO `access_level_privilege` 
			(`Page_Description`,`PageName`, `Granted_Access_Level`) VALUES ('".$PageDesc."','".$PageName."','".$AccessLevel."')";			
				
	mysql_query($sqlINST);
	
	}
}
public function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}
public function CHK_AccessLevel()
{
		
	if (!isset($_SESSION))  //checking th esession wheter started or not if not start
	{
    session_start();
     }

    $pagepath= $this->get_pagename(); //get current page name for comparison

     //echo $pagepath."<br/>";
     //echo $this->get_Granted_AccessLevel($pagepath);

    //adding grated access level to give an access for th ecurrent page
	if($this->get_Granted_AccessLevel($pagepath)=="undifined")
	$MM_authorizedUsers="administrator";
    else
	$MM_authorizedUsers="administrator".$this->get_Granted_AccessLevel($pagepath); 

    //$MM_authorizedUsers = "admin,administrator";

    $MM_donotCheckaccess = "false";

    // *** Restrict Access To Page: Grant or deny access to this page
	//assigning document root to locate where the login form is 
    $dirDoc="http://" . $_SERVER['HTTP_HOST']."/aqhrms/";
	$MM_restrictGoTo = $dirDoc."login.php";
	//$MM_restrictGoTo="../login.php";
    if (!((isset($_SESSION['MM_Username'])) && ($this->isAuthorized("",$MM_authorizedUsers,    $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
    $MM_qsChar = "?";
    $MM_referrer = $_SERVER['PHP_SELF'];
    if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
    if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
    $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
    $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
     header("Location: ". $MM_restrictGoTo); 
  exit;
    }
	
   }

public function array_flatten($array) {
  if (!is_array($array)) {
    return FALSE;
  }
  $result = array();
  foreach ($array as $key => $value) {
    if (is_array($value)) {
      $result = array_merge($result, array_flatten($value));
    }
    else {
      $result[$key] = $value;
    }
  }
  return $result;
} 

   public function RetriveData($filedName,$typ)
   {
	   $sqlGranted="Select DISTINCT ".$filedName." from access_level_privilege"; 
	   
	  $resultGranted = mysql_query($sqlGranted) or die(mysql_error());
	
	 
	 $filedData=array();
	 $filedData="";
	 $count=0;
	  while($rowGranted=mysql_fetch_array($resultGranted,MYSQL_ASSOC))
	  {  if($count==0)
	      {
	       $filedData.=$rowGranted[$filedName];
	      }
	     else
		 {
		  $filedData.=",".$rowGranted[$filedName];
		 }
			 $count++;
		 
		  }
	   //split data as array by exploding by , delimeter
	  $allfiledData = explode(',',$filedData);
	  //copying unique data only for omiton of redendant file data
	  $allfiledData=array_unique($allfiledData);
		asort($allfiledData);
		//makeing array name for checkbox only
		if(strtoupper($typ) == strtoupper("checkbox")){
		$filedName=$filedName."[]";
		}
		
		  echo "<table bgcolor=\"#EBEBEB\" border=\"1\" bordercolor=\"#FF6600\">";
		  foreach($allfiledData as $value)
		  {
			 
		  echo "<tr>";
		  echo "<td>";
		  echo "<input type=\"$typ\" name=\"$filedName\" value=\"$value\" > ".$value;
		  echo "</td>";
		  echo "</tr>";
		 
		  }
	      echo "</table >";
	  
   }


}//class clossing brace


?>