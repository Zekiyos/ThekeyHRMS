<?php 
include('../User_account/Class_AccessLevel.php');
 $obj_AccessLevel = new AccessLevel();
echo $obj_AccessLevel->CHK_AccessLevel(); 
?>
<?php require_once('../Connections/HRMS.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO recruitment (Employee, Place, ID, FirstName, MiddelName, LastName, Age, Sex, Photo, `Date`, Address,`Department`, `Position`, Salary, Transport_Allowance,Housing_Allowance,Hardship_Allowance, Position_Allowance,Present_Allowance) VALUES (%s, %s, %s, %s, %s, %s, %s,%s, %s,%s, %s, %s, %s, %s, %s, %s, %s, %s,%s)",
                       GetSQLValueString($_POST['Employee'], "text"),
                       GetSQLValueString($_POST['Place'], "text"),
                       GetSQLValueString($_POST['ID'], "text"),
                       GetSQLValueString($_POST['FirstName'], "text"),
                       GetSQLValueString($_POST['MiddelName'], "text"),
                       GetSQLValueString($_POST['LastName'], "text"),
                       GetSQLValueString($_POST['Age'], "int"),
                       GetSQLValueString($_POST['Sex'], "text"),
                       GetSQLValueString($_POST['Photo'], "text"),
                       GetSQLValueString($_POST['Date'], "date"),
                       GetSQLValueString($_POST['Address'], "text"),
					   GetSQLValueString($_POST['Department'], "text"),
                       GetSQLValueString($_POST['Position'], "text"),
                       GetSQLValueString($_POST['Salary'], "double"),
                       GetSQLValueString($_POST['Transport_Allowance'], "double"),
                       GetSQLValueString($_POST['Housing_Allowance'], "double"),
				       GetSQLValueString($_POST['Hardship_Allowance'], "double"),
					   GetSQLValueString($_POST['Position_Allowance'], "double"),
					   GetSQLValueString($_POST['Present_Allowance'], "double"));

  mysql_select_db($database_HRMS, $HRMS);
  $Result1 = mysql_query($insertSQL, $HRMS) or die(mysql_error());
  
 /*******************Payroll data entry for new employeee registration*/ 
 
   $insertPayrollDBSQL = sprintf("INSERT INTO total_deduction (`ID`,`FirstName`,`MiddelName`,`LastName`,`Basic salary`,`Department`,`Position`,`Hardship_Allowance`,Housing_Allowance,`Transport_Allowance_Amount`,`Position_Allowance`,`Present_Allowance_Amount`)
                                                           VALUES ( %s, %s, %s, %s, %s, %s, %s, %s, %s,%s,%s,%s)",
                       GetSQLValueString($_POST['ID'], "text"),
                       GetSQLValueString($_POST['FirstName'], "text"),
                       GetSQLValueString($_POST['MiddelName'], "text"),
                       GetSQLValueString($_POST['LastName'], "text"),
                       GetSQLValueString($_POST['Salary'], "double"),
					   GetSQLValueString($_POST['Department'], "text"),
                       GetSQLValueString($_POST['Position'], "text"),
                       GetSQLValueString($_POST['Hardship_Allowance'], "double"),
                          GetSQLValueString($_POST['Housing_Allowance'], "double"),
                       GetSQLValueString($_POST['Transport_Allowance'], "double"),
				       GetSQLValueString($_POST['Position_Allowance'], "double"),
				       GetSQLValueString($_POST['Present_Allowance'], "double"));

     mysql_select_db($database_HRMS, $HRMS);
      $Result1 = mysql_query($insertPayrollDBSQL, $HRMS) or die(mysql_error());
  
 
  /*End of payroll dtata entry for new employee registration**********************/
  
  
  /***************************************************************************************************/
  /*Attendance week data entry start*/
  
  //checking Week day of recruitment
  /********************by checkin week and insert the recruited employee*************/
  /***
  $DateValue=$_POST['Date'];
  
   $WeekOFMonthSQL="SELECT WEEK('".$DateValue."',6) - WEEK(DATE_SUB('".$DateValue."', INTERVAL DAYOFMONTH('".$DateValue."')-1 DAY),6)+1 AS WeekOFMonth ";
						$resultWeekOFMonth = mysql_query($WeekOFMonthSQL);
				while($rowWeekOFMonth = mysql_fetch_array($resultWeekOFMonth, MYSQL_ASSOC))
				{
					
					$WeekOFMonth =$rowWeekOFMonth ['WeekOFMonth'];
					
					$UpdatedTabelName="week_".$WeekOFMonth."" ;
					
				}
			
				
		
  $insertAttendanceSQL = sprintf("INSERT INTO ".$UpdatedTabelName." (`ID`,`FirstName`,`MiddelName`,`LastName`,`Department`)
                                                           VALUES ( %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['ID'], "text"),
                       GetSQLValueString($_POST['FirstName'], "text"),
                       GetSQLValueString($_POST['MiddelName'], "text"),
                       GetSQLValueString($_POST['LastName'], "text"),
                       GetSQLValueString($_POST['Salary'], "int"),
					   GetSQLValueString($_POST['Department'], "text"));
					   ********************************************************/
					   /***************************Insertion of Data fro weekly Attendance****/
					 
					 
					 		/*********************************************************************
				//Since there is one off-day per 7 days and 6 working days.to get total Month Off day will be last day of the month diveded by Seven
				$TotalMonthOffDay=DAY( LAST_DAY($DateValue ))/7   ;
				
				//To get AbsentOffday which passes before the person recruitment day it should be find by the number of day which the employee is recruited and Total Month off day
				$AbsentOffDay=( DAY($DateValue) * $TotalMonthOffDay )/ DAY( LAST_DAY($DateValue ));
				
				//To get Absent working day absent off-day shall be deducted from day of recuitment
				$AbsentWorkingDay=DAY( $DateValue ) - $AbsentOffDay;
				
				$AbsentWorkingHour = $AbsentWorkingDay*8;
				//In SQL
				Select @TotalMonthOffDay:=DAY( LAST_DAY('2011-08-13' ))/7 AS TotalMonthOffDay,
       @AbsentOffDay:=DAY('2011-08-13') * @TotalMonthOffDay / DAY( LAST_DAY('2011-08-13' )) AS AbsentOffDay,
	@AbsentWorkingDay:=DAY( '2011-08-13' ) - @AbsentOffDay AS AbsentWorkingDay,
	@AbsentWorkingHour:= @AbsentWorkingDay *8 AS AbsentWorkingHour
		*********************************************************/
		
		$DateValue=$_POST['Date'];
		
	/****$UnpaidHour="Select @TotalMonthOffDay:=DAY( LAST_DAY('".$DateValue."' ))/7 AS TotalMonthOffDay,
    @AbsentOffDay:=DAY('".$DateValue."') * @TotalMonthOffDay / DAY( LAST_DAY('".$DateValue."' )) AS AbsentOffDay,
	@AbsentWorkingDay:=DAY( '".$DateValue."' ) - @AbsentOffDay AS AbsentWorkingDay,
	@AbsentWorkingHour:= @AbsentWorkingDay *8 AS AbsentWorkingHour";****/
	/************
	*****$UnpaidHour="Select @AbsentWorkingHour:= DAY( '".$DateValue."' )*8 AS AbsentWorkingHour";
	********/
	
////	$UnpaidHour="Select @TotalMonthOffDay:=DAY( LAST_DAY('".$DateValue."' ))/7 AS TotalMonthOffDay,
////				@AbsentDay:= DateDiff( LAST_DAY('".$DateValue."' ),'".$DateValue."') AS AbsentDay,
////				@AbsentOffDay:=@AbsentDay * @TotalMonthOffDay / DAY( LAST_DAY('".$DateValue."' )) AS AbsentOffDay,
////				@AbsentWorkingDay:=@AbsentDay - @AbsentOffDay AS AbsentWorkingDay,
////				@PersentOffday:=DAY('".$DateValue."') /7 AS PersentOffday,
////				@PersentWorkingDay:=DAY('".$DateValue."' ) - @PersentOffday AS PersentWorkingDay,
////				IF(YEAR('".$DateValue."')=YEAR(CURDATE()) AND MONTH('".$DateValue."')=MONTH(CURDATE()),
////				       @AbsentWorkingHour:=@PersentWorkingDay*8, 0) AS AbsentWorkingHour";
////					   
////				
////				
////									
////				$resultUnpaidHour = mysql_query($UnpaidHour);
////	   while($rowUnpaidHour = mysql_fetch_array($resultUnpaidHour, MYSQL_ASSOC))
////				{
////				      $AbsentWorkingHour = $rowUnpaidHour['AbsentWorkingHour'];
////				
////					   $insertAbsentSQL = sprintf("INSERT INTO week_1 (`ID`,`FirstName`,`MiddelName`,`LastName`,`Department`,`No_Absent`)
////                                                           VALUES ( %s, %s, %s, %s, %s,%s)",
////                       GetSQLValueString($_POST['ID'], "text"),
////                       GetSQLValueString($_POST['FirstName'], "text"),
////                       GetSQLValueString($_POST['MiddelName'], "text"),
////                       GetSQLValueString($_POST['LastName'], "text"),
////                       GetSQLValueString($_POST['Department'], "text"),
////					  GetSQLValueString($AbsentWorkingHour, "double"));	
////					  
////					  mysql_select_db($database_HRMS, $HRMS);
////                      $ResultAttendance = mysql_query($insertAbsentSQL, $HRMS) or die(mysql_error());
////				}  
////				
////				
							
					   
					   for ($i=1; $i<=6; $i++)
					   {
						   					   
					$UpdatedTabelName="week_".$i."" ;	   
					    $insertAttendanceSQL = sprintf("INSERT INTO ".$UpdatedTabelName." (`ID`,`FirstName`,`MiddelName`,`LastName`,`Department`)
                                                           VALUES ( %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['ID'], "text"),
                       GetSQLValueString($_POST['FirstName'], "text"),
                       GetSQLValueString($_POST['MiddelName'], "text"),
                       GetSQLValueString($_POST['LastName'], "text"),
                       GetSQLValueString($_POST['Department'], "text"));
					   
					   
  mysql_select_db($database_HRMS, $HRMS);
  $ResultAttendance = mysql_query($insertAttendanceSQL, $HRMS) or die(mysql_error());
					   }
  /*end of week data*/
   /*************************************************************************************************************/
   
   /*********************/
$filename="LastID.txt";
if (file_exists($filename)) {

$fd = fopen($filename, "r+") or die("Can't open file $filename");
$fstring = fread($fd, filesize($filename));

$fstring2=$fstring+1;
fclose($fd);

$fd2 = fopen($filename, "w+") or die("Can't open file $filename");
$fout = fwrite($fd2, $fstring2);
fclose($fd2);
}
   /********************************/
  
}

$maxRows_RSRecruitment = 10;
$pageNum_RSRecruitment = 0;
if (isset($_GET['pageNum_RSRecruitment'])) {
  $pageNum_RSRecruitment = $_GET['pageNum_RSRecruitment'];
}
$startRow_RSRecruitment = $pageNum_RSRecruitment * $maxRows_RSRecruitment;

mysql_select_db($database_HRMS, $HRMS);
$query_RSRecruitment = "SELECT * FROM recruitment";
$query_limit_RSRecruitment = sprintf("%s LIMIT %d, %d", $query_RSRecruitment, $startRow_RSRecruitment, $maxRows_RSRecruitment);
$RSRecruitment = mysql_query($query_limit_RSRecruitment, $HRMS) or die(mysql_error());
$row_RSRecruitment = mysql_fetch_assoc($RSRecruitment);

if (isset($_GET['totalRows_RSRecruitment'])) {
  $totalRows_RSRecruitment = $_GET['totalRows_RSRecruitment'];
} else {
  $all_RSRecruitment = mysql_query($query_RSRecruitment);
  $totalRows_RSRecruitment = mysql_num_rows($all_RSRecruitment);
}
$totalPages_RSRecruitment = ceil($totalRows_RSRecruitment/$maxRows_RSRecruitment)-1;

mysql_select_db($database_HRMS, $HRMS);
$query_RSDepartment = "SELECT * FROM department ORDER BY Department ASC";
$RSDepartment = mysql_query($query_RSDepartment, $HRMS) or die(mysql_error());
$row_RSDepartment = mysql_fetch_assoc($RSDepartment);
$totalRows_RSDepartment = mysql_num_rows($RSDepartment);
?>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/main_TemplateNew.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thekey HRMS</title>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "../login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
/**
 * Small Wrapper class to manage Languages stored in a MySQL DB

 */
class Language {
 
    var $defaultlang = "en";	// Default Language
 
    var $languages = array("en");
 
    // mysqli instance;
    var $db;
 
    function __construct($db="", $defaultlang="") {
    
		mysql_select_db('aqhrmsdb');
        
        if($db != "") {
            $this->db = $db;
        } else {
            $this->db = new mysqli();
        }
        if($defaultlang != "") {
            $this->defaultlang = $defaultlang;
        }
        $this->languages = $this->getLanguageIDs();
    }
 
    /**
     * Get text from DB given a specific Text ID and Language
     */
    public function get($textid, $langid="") {
        if($langid == "") {
            $langid = $this->defaultlang;
        }
      	$query = "SELECT text FROM lang_$langid WHERE textid='$textid'";
        $result = mysql_query($query) or die(mysql_error());
        $row = mysql_fetch_array($result);
        $text = $row[0];
        if($langid == $this->defaultlang) {  // if language is default, return the langauge unchecked.
        if($text=="")
            return $textid;
        else
            return $text;
            
        } else {
            if($text != "") { // Is text field un-translated? (i.e. not empty string)
                return $text;
            } else { 
            //// If not, query using default language
            ///// return $this->get($textid, $this->defaultlang);
            
                //copying defualt laguage translation
             $defaultexist = $this->get($textid, $this->defaultlang);
             
             if($defaultexist=="")//is default is empty return textid
                return $textid;
             else  //else return default language transaltion
               return $this->get($textid, $this->defaultlang); 
                
            }
        }
        return "";
    }
 
    /**
     * Return an Array of Language IDs of each language in the Database
     */
    public function getLanguageIDs() {
        $languages = array();
        $sql = "SELECT `lang` FROM `languages`";
        $result = mysql_query($sql);
        $i = 0;
        while($row = mysql_fetch_array($result)) {
            $languages[$i] = $row[0];
            $i++;
        }
        return $languages;
    }
 
    /**
     * Return an Array of Descriptions of each language in the Database.
     */
    public function getLanguageDescriptions() {
        $languagesDesc = array();
        $sql = "SELECT description FROM languages";
        $result = mysql_query($sql) or die(mysql_error());
        $i = 0;
        while($row = mysql_fetch_array( $result )) {
            $languagesDesc[$i] = $row[0];
            $i++;
        }
        return $languagesDesc;
    }
 
    /**
     * Delete a Text ID from all Language Tables
     * @param $textid
     */
    public function deleteTextID($textid) {
        if($textid != "") {
            $numLanguages = count($this->languages);
            for($i = 0; $i < $numLanguages; $i++) {
                $sql = "DELETE FROM lang_".$this->languages[$i]." WHERE textid='$textid'";
                $result = mysql_query($sql) or die(mysql_error());
            }
            $status = "Deleted TextID ".$textid;
        }
        return $status;
    }
 
    /**
     * Update Text for a specific Language
     * @param $langid
     * @param $textid
     * @param $text
     */
    public function updateText($langid, $textid, $text) {
        if($langid != "" && $textid != "" && $text != "") {
            $sql = "UPDATE lang_$langid SET text='$text' WHERE textid='$textid' ";
            $result = mysql_query($sql) or die(mysql_error());
            $status = "Updated Entry";
        }
	return $status;
    }
 
    /**
     * Delete a Language from the Database
     * @param $langid
     */
    public function deleteLanguage($langid) {
    	if($langid != "") {
            $sql = "DROP TABLE IF EXISTS lang_".$langid;
            $result = mysql_query($sql) or die(mysql_error());
            $sql = "DELETE FROM languages WHERE lang='$langid'";
            $result = mysql_query($sql) or die(mysql_error());
        }
	return "Deleted Language Table ".$langid;
    }
 
    /**
     * Add TextID field to all language databases
     * @param $textid
     */
    public function addTextID($textid) {
        $numLanguages = count($this->languages);
        for($i = 0; $i < $numLanguages; $i++) {

            $status = $status.$this->languages[$i];
            $sql = "INSERT INTO lang_".$this->languages[$i]." (`textid`, `text`) VALUES ('$textid', '')";
            $result = mysql_query($sql) or die(mysql_error());
        }
        $status = $status."Added Text ID";
        return $status;
    }
 
    /**
     * Add a new Language
     * @paam $langID is typically a 2 letter ID (English is 'en', Japanese is 'jp')
     * The created database is 'lang_$langID' (lang_en, lang_jp)
     * @param $langDesc is the Description for the language.
     */
    public function addLanguage($langid, $langdesc) {
    	if($langid != "" && $langdesc != "") {
            $sql = "INSERT INTO languages (`lang`, `description`) VALUES ('$langid', '$langdesc')";
            $result = mysql_query($sql) or die(mysql_error());
            $sql = "CREATE TABLE IF NOT EXISTS `lang_$langid` (
        	`textid` varchar(255) collate latin1_general_ci NOT NULL,
                `text` longtext charset utf8 collate utf8_unicode_ci NOT NULL
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
            $result = mysql_query($sql) or die(mysql_error());
            $sql = "SELECT textid FROM lang_en";
            $result = mysql_query($sql) or die(mysql_error());
            while($row = mysql_fetch_array($result)) {
                $sql = "INSERT INTO lang_$langid (`textid`, `text`) VALUES ('$row[0]', '')";
        	$result2 = mysql_query($sql) or die(mysql_error());
            }
            $status = "Added Language";
	}
        return $status;
    }
 
}
?>
<?php
//******

$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASSWORD = '';
$DB_DATABASE = 'aqhrmsdb';
$DB_PORT = '3306';

////$db = new MySQLi($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_DATABASE,$DB_PORT);
//
$db = mysql_connect($DB_HOST, $DB_USER, $DB_PASSWORD);
if (!$db) {
    die('Not connected with Language Database : ' . mysql_error());
}
$db_selected = mysql_select_db($DB_DATABASE, $db);
if (!$db_selected) {
    die ('Can\'t use Language database : ' . mysql_error());
}

//Setting Charcter set to unicode to support all language
mysql_set_charset('utf8',$db); 
// $db -> set_charset('utf8');

// create a new Langauge Object
$obj_lang = new Language($db);

// ideally pull this from a users profile.
 
if(!isset($_REQUEST["lang"]))
$_REQUEST["lang"]="en";

$lang = $_REQUEST["lang"];
?>

<?php 
  
   $realpath = dirname(realpath(__FILE__));
//checking the connection is secure or not the identfy http or https protocol then append server host name
$path = ((isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) != 'off') ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] ."/". substr($realpath, strlen($_SERVER['DOCUMENT_ROOT']));

if (DIRECTORY_SEPARATOR == '\\')
        $path = str_replace('\\', '/', $path);
        
 /*     echo $path."/Language/Language.php";
        
//Language Translation Code

include($path.'/Language/Language.php');

include($path.'/Language/Language_Connection.php');

// create a new Langauge Object
//if (class_exists("Language"))
$obj_lang = new Language($db);
 
// ideally pull this from a users profile.
//if(isset($_REQUEST["Lang"]))
$lang = $_REQUEST["lang"]; 
//else
//$lang="en";*/
 ?>
 
<style type="text/css">
body {
	margin: 0;
	padding: 0;
	text-align: center;
	width: auto;
}
#wrrapper {
	margin: 0 auto;
	text-align: left;
	width: 900px;
	background-color: #999;
}
#headerspace {
	background-color: #999;
	height: 10px;
	width: 1280px;
}


/* menu */
.menu_nav {
	margin:0;
	padding:-15px 20px 0 20px;
	float:left;
	width: auto;
}
.menu_nav ul { list-style:none;}
.menu_nav ul li { margin:0 4px; padding:0 8px 0 0; float:left; background:url(../_template/clearfocus/html/images/menu.gif) no-repeat right center;}
.menu_nav ul li a {
	display:block;
	margin:0;
	padding:18px 16px;
	color:#F60;
	text-decoration:none;
	font-size:14px;
}
.menu_nav ul li.active a, .menu_nav ul li a:hover { background:url(../_template/clearfocus/html/images/menu_a.gif) repeat-x top;;}
#header {
	background-color: #FFF;
	height: 300px;
	top: 0px;
	clip: rect(0px,auto,auto,auto);
	width: 900px;
}
#sidemenu {
	font-size: 14px;
	font-weight: normal;
	color: #F60;
	background-color: #CCC;
	height: 250px;
	width: 120px;
}
#sidecontent {
	color: #F60;
	height: 430px;
	width: 120px;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
}
#headerimg {
	height: 60px;
	width: auto;
	background-color: #FFF;
	background-image: url("../img logo & icons/fade.jpg");
}
#mainnavigation {
	height: 200px;
	width: 100px;
	color: #660;
}
#headerAdvert {
	background-color: #FFF;
	height: 120px;
	width: 870px;
	color: #F90;
	font-size: 14px;
	top: 0px;
	clip: rect(0px,auto,auto,auto);
}
#sidebar {
	background-color: #FFF;
	margin: 0px;
	padding: 0px;
	height: 700px;
	width: 120px;
	left: 650px;
	top: 0px;
	float: right;
	color: #F60;
	font-weight: lighter;
	font-size: 18px;
	font-variant: normal;
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	text-align: left;
}
#footer {
	background-color: #999;
	margin: 0px;
	padding: 0px;
	height: 20px;
	width: 900px;
	clear: both;
	left: 7px;
	top: 922px;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
}
#mainContent {
	background-color: #FFF;
	height: 900px;
	width: 780px;
	float: left;
	font-family: Georgia, "Times New Roman", Times, serif;
	font-size: 16px;
	font-style: normal;
	color: #000;
	text-align: left;
}
#header #headerAdvert h1 {
	font-size: 14px;
	font-style: normal;
	font-weight: 100;
	color: #333;
}
a:link {
	color: #F30;
	text-decoration: underline;
}
a:visited {
	color: #F60;
	text-decoration: underline;
}
a:hover {
	color: #03F;
	text-decoration: none;
}
a:active {
	color: #F30;
}
a {
	font-size: 16px;
}
</style>
<script src="../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico" >
<link rel="icon" href="animated_favicon.gif" type="image/gif" >

<script language=javascript>
<!--
function popup(N) {
newWindow = window.open(N, 'popD','toolbar=no,menubar=no,resizable=no,scrollbars=no,status=no,location=no,width=550,height=215');
}
//-->
</script>

</head>

<body>
<div id="headerspace"></div>
<div id="wrrapper">

<div id="header">
<div id="headerAdvert">
    <H2 ><font  size="20" >Thekey</font><span id="headerAdvert"><font color="#999999" size="20" >HRMS</font><font color="#999999" size="3" >    Bringing ICT Solution to Your need.</font>  </span> <font color="#999999" size="3" >The key is yours!! </font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $path."/".basename(realpath(__FILE__));?>?lang=en"><img src="../flags/United Kingdom flag.png" width="35" height="25" /></a><a href="<?php echo $path."/".basename(realpath(__FILE__));?>?lang=am"><img border="0" src="../flags/Ethiopiaflag.jpg" alt="Amharic(ETH)" width="35" height="30" /></a><a href="<?php echo $path."/".basename(realpath(__FILE__));?>?lang=nl"><img src="../flags/Netherlands-Flag-icon.png" width="35" height="25" /></a></h2>
   <H2><font color="#999999" size="+1" ></font><img src="../img logo &amp; icons/logo.jpg" alt="Rev(3:7)He that hath THE KEY of David, he that openeth, and no man shutteth;  and shutteth, and no man openeth;" width="100" height="40" />
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     <font color="#FF6600" size="6"><?php echo $obj_lang->get('Human Resource Management System', $lang); ?> </font>
     </font>
     
   </h2>
</div>
    <div id="headerimg">
      <div class="menu_nav">

<!--
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="support.html">Recriument</a>
          </li>
          <li><a href="about.html">Leave</a></li>
          <li><a href="blog.html">Benfite</a></li>
          <li><a href="blog.html">Report</a></li>
          <li><a href="blog.html">Leave</a></li>
        </ul>
        -->
<ul id="MenuBar1" class="MenuBarHorizontal">
<li><a href="../index.php"><?php echo $obj_lang->get('Home', $lang); ?></a>        </li>
        <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Recruitment', $lang); ?></a>
          <ul>
            <li><a href="Recruitment.php"><?php echo $obj_lang->get('Recruitment Form', $lang); ?></a></li>
            <li><a href="Photo Capture/Capture.php" target="_blank"><?php echo $obj_lang->get('Photo Capturing', $lang); ?></a></li>
            <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Equipment Handover', $lang); ?></a>
              <ul>
                <li><a href="../Equipment HandOver/Equipment_HandOver.php"><?php echo $obj_lang->get('Equipment Handover', $lang); ?></a></li>
                <li><a href="../Equipment HandOver/Equipment_ReturnBack.php"><?php echo $obj_lang->get('Equipment TookOver', $lang); ?></a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li><a href="../Personal Record/Personal_Information_Detail.php"><?php echo $obj_lang->get('Personal   Info', $lang); ?></a></li>
        <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Leave', $lang); ?></a>
          <ul>
            <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Annual Leave', $lang); ?></a>
              <ul>
              <li><a href="../Leaves/CalculateAnnualLeave.php"><?php echo $obj_lang->get('Annual Leave Calculator', $lang); ?></a></li>
                <li><a href="../Leaves/Annual_Leave_Grant.php"><?php echo $obj_lang->get('Annual Leave Grant', $lang); ?></a></li>
</ul>
            </li>
            <li><a href="../Leaves/Funeral_Leave_Grant.php"><?php echo $obj_lang->get('Funeral Leave', $lang); ?></a></li>
            <li><a href="../Leaves/Maternity_Leave_Grant.php"><?php echo $obj_lang->get('Maternity Leave', $lang); ?></a></li>
            <li><a href="../Leaves/Paternity_Leave_Grant.php"><?php echo $obj_lang->get('Paternity Leave', $lang); ?></a></li>
            <li><a href="../Leaves/Sick_Leave_Grant.php"><?php echo $obj_lang->get('Sick Leave', $lang); ?></a></li>
            <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Special Leave', $lang); ?></a>
              <ul>
                <li><a href="../Leaves/Special_Leave_Grant.php"><?php echo $obj_lang->get('Special Leave With Payment', $lang); ?></a></li>
                <li><a href="../Leaves/Special_Leave_GrantWithoutPayment.php"><?php echo $obj_lang->get('Special Leave Without Payment', $lang); ?></a></li>
              </ul>
            </li>
<li><a href="../Leaves/Wedding_Leave_Grant.php"><?php echo $obj_lang->get('Wedding Leave', $lang); ?></a></li>
            <li><a href="../Leaves/Back_From_Leave_Report.php"><?php echo $obj_lang->get('Back to Work Report', $lang); ?></a></li>
          </ul>
        </li>
        <li><a class="MenuBarItemSubmenu" href="#"><?php echo $obj_lang->get('Disciplinary Action', $lang); ?></a>
          <ul>
            <li><a href="../Letters/warning Letters/Verbal_Warning.php"><?php echo $obj_lang->get('Verbal Warning', $lang); ?></a>            </li>
<li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Written Warning', $lang); ?></a>
              <ul>
                <li><a href="../Letters/warning Letters/First_Instance_Warning.php"><?php echo $obj_lang->get('1st Instance Warning', $lang); ?></a></li>
                <li><a href="../Letters/warning Letters/Second_Instance_Warning.php"><?php echo $obj_lang->get('2nd Instance Warning', $lang); ?></a></li>
                <li><a href="../Letters/warning Letters/Third_Instance_Warning.php"><?php echo $obj_lang->get('3rd Instance Warning', $lang); ?></a></li>
                <li><a href="../Letters/warning Letters/Last_Warning.php"><?php echo $obj_lang->get('Last Warning', $lang); ?></a></li>
              </ul>
            </li>
            <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Dismissal / Termination', $lang); ?></a>
              <ul>
<li><a href="../Letters/warning Letters/Termination.php"><?php echo $obj_lang->get('Termination Form', $lang); ?></a></li>
<li><a href="../Letters/warning Letters/Termination4ProbationPeriod.php"><?php echo $obj_lang->get('Probation Period Termination', $lang); ?></a></li>
<li><a href="#"><?php echo $obj_lang->get('Termination Letter', $lang); ?></a></li>
              </ul>
            </li>
            <li><a href="javascript: if (confirm('Are You Sure You want to remove Expired Warning?')) { window.location.href='../Letters/warning Letters/Expired_Warning_Remover.php' } else { void('') }; "><?php echo $obj_lang->get('Expired Warning Remover', $lang); ?></a></li>
            <li><a href="../Letters/warning Letters/Warning_Letters_Viewer.php"><?php echo $obj_lang->get('Warning Letter Viewer', $lang); ?></a></li>
          </ul>
        </li>
        <li><a href="http://localhost/Report/annual_leaverpt.php" target="_blank" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Report', $lang); ?></a>
          <ul>
            <li><a href="../AQHRMSReport/index.php" target="_blank"><?php echo $obj_lang->get('HRM Reports', $lang); ?></a></li>
            <li><a href="../Court Case/CourtCaseFilter.php" target="_blank"><?php echo $obj_lang->get('Court Case Report', $lang); ?></a></li>
            <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Payroll Report', $lang); ?></a>
              <ul>
                <li><a href="javascript:popup('AQPayrollReport/PayrollsheetReportSelection.php')"><?php echo $obj_lang->get('Payroll Sheet', $lang); ?></a></li>
                <li><a href="javascript:popup('AQPayrollReport/AttendanceReportSelection.php')"><?php echo $obj_lang->get('Attendance', $lang); ?></a></li>
                <li><a href="javascript:popup('AQPayrollReport/PayslipReportSelection.php')"><?php echo $obj_lang->get('Payslip', $lang); ?></a></li>
                <li><a href="javascript:popup('AQPayrollReport/CurrencyDenominationReportSelection.php')"><?php echo $obj_lang->get('Currency Denomination', $lang); ?></a></li>
                <li><a href="javascript:popup('AQPayrollReport/ProvidentFundReportSelection.php')"><?php echo $obj_lang->get('Provident Fund', $lang); ?></a></li>
                <li><a href="javascript:popup('AQPayrollReport/PensionReportSelection.php')"><?php echo $obj_lang->get('Pension Report', $lang); ?></a></li>
                <li><a href="javascript:popup('AQPayrollReport/LUContributionReportSelection.php')"><?php echo $obj_lang->get('Labour Union Contribution', $lang); ?></a></li>
              </ul>
            </li>
            <li><a href="../Salary Increment Report/SalaryIncrementReport.php" target="_blank"><?php echo $obj_lang->get('Salary Increment', $lang); ?></a></li>
          </ul>
        </li>
        <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Organization', $lang); ?></a>
          <ul>
<li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Contract', $lang); ?></a>
  <ul>
<li><a href="../Letters/Contract Letters/Creat Contract Letter.php"><?php echo $obj_lang->get('Creat New Contract', $lang); ?></a></li>
<li><a href="../Letters/Contract Letters/Contract Letter.php"><?php echo $obj_lang->get('Contract Letter', $lang); ?></a></li>
  </ul>
</li>
            <li><a href="../Organization/Policy.pdf" target="_blank"><?php echo $obj_lang->get('Policy', $lang); ?></a></li>
            <li><a href="../Organization/Plan.pdf" target="_blank"><?php echo $obj_lang->get('Plan', $lang); ?></a></li>
            <li><a href="../Organization/Procedure.pdf" target="blank"><?php echo $obj_lang->get('Procedure', $lang); ?></a></li>
            <li><a href="../Organization/CBA.pdf" target="_blank"><?php echo $obj_lang->get('CBA', $lang); ?></a></li>
          </ul>
        </li>
        <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Benefits', $lang); ?></a>
          <ul>
            <li><a href="../Medical/Medical_Referral.php"><?php echo $obj_lang->get('Medical Referral From', $lang); ?></a></li>
            <li><a href="../Medical/Cholinesterase_Test.php" title="Cholinesterase Test"><?php echo $obj_lang->get('Cholinesterase Test', $lang); ?></a></li>
            <li><a href="../Training/Training.php"><?php echo $obj_lang->get('Training', $lang); ?></a></li>
          </ul>
        </li>
</ul>
<?php echo "<font face=\"Times New Roman, Times, serif\" size=\"+1\"><b>logged in as ".$_SESSION['MM_Username']."</b></font>";  ?>
      </div>
  </div>
  <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" --><?php echo $obj_lang->get('Employee Probation Period Recruitment Form', $lang); ?> 
                                 
     </p> <p class="active">&nbsp;</p>
      <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
        <table width="535" height="535" align="center" bgcolor="#EBEBEB">
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Employee', $lang); ?>:</td>
<td><span id="sprytxtEmployee">
              <input type="text" name="Employee" value="Ammerlaan Quality Roses(AQ Roses)" size="35" readonly="readonly" />
            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Place', $lang); ?>:</td>
            <td><span id="sprytxtPlace"><span id="sprytextfield2">
              <input type="text" name="Place" value="Ziway,Ethiopia" size="32" readonly="readonly" />
            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('ID', $lang); ?>:</td>
<td><span id="sprytxtID">
              <input type="text" name="ID" value="<?php
$filename="LastID.txt"; 
if (file_exists($filename)) {

$fd = fopen($filename, "r+") or die("Can't open file $filename");
$fstring = fread($fd, filesize($filename));

//$fstring2=$fstring+1;
fclose($fd);

//$fd2 = fopen($filename, "w+") or die("Can't open file $filename");
//$fout = fwrite($fd2, $fstring2);
//fclose($fd2);

$initial=$fstring;

 if( $initial > 99999)
 echo "<script type=\"text/javascript\"> alert('ID number Exceed The Limt Contact System Devloper to Change the limted value.'); </script>";
 else{
 if (strlen($initial)==1)
 $ID="AQ-0000".$initial;
 else
 if (strlen($initial)==2)
 $ID="AQ-000".$initial;
  else
 if (strlen($initial)==3)
 $ID="AQ-00".$initial;
  else
 if (strlen($initial)==4)
 $ID="AQ-0".$initial;
  else
 if (strlen($initial)==5)
  $ID="AQ-".$initial;

 echo $ID;
 }
}
else
echo "<script type=\"text/javascript\"> alert('Last ID Number text file is not exist.Write Last ID Number on the notpad and save in the Recruitment folder as LastID.txt'); </script>";

?>" size="15" />
            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('First Name', $lang); ?>:</td>
<td><span id="sprytxtFirstName">
              <input type="text" name="FirstName" value="" size="20" />
            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Middel Name', $lang); ?>:</td>
<td><span id="sprytxtMiddelName">
              <input type="text" name="MiddelName" value="" size="20" />
            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Last Name', $lang); ?>:</td>
<td><span id="sprytxtLastName">
              <input type="text" name="LastName" value="" size="20" />
            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Age', $lang); ?>:</td>
            <td><span id="sprytxtAge">
            <input type="text" name="Age" value="" size="8" />
            <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span><span class="textfieldMinValueMsg">The entered value is less than the minimum required.</span><span class="textfieldMaxValueMsg">The entered value is greater than the maximum allowed.</span></span></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Sex', $lang); ?>:</td>
            <td valign="baseline"><table>
              <tr>
                <td><input type="radio" name="Sex" value="Male" <?php if (!(strcmp("Female","Male"))) {echo "checked=\"checked\"";} ?>/>
                  <?php echo $obj_lang->get('Male', $lang); ?></td>
              </tr>
              <tr>
                <td><input type="radio" name="Sex" value="Female" <?php if (!(strcmp("Female","Female"))) {echo "checked=\"checked\"";} ?>/>
                  <?php echo $obj_lang->get('Female', $lang); ?></td>
              </tr>
            </table></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Photo', $lang); ?>:</td>
            <td><input type="file" name="Photo" value="" size="32"  /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Date', $lang); ?>:</td>
            <td><script type='text/JavaScript' src="../Calendar/scw.js" ></script> <input type="text" name="Date" onclick='scwShow(this,event);' value="<?php echo date("Y-m-d"); ?> " size="15" />
			 
			</td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right" valign="top"><?php echo $obj_lang->get('Address', $lang); ?>:</td>
            <td>
              <textarea name="Address" cols="50" rows="5"></textarea>
            </td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Department', $lang); ?>:</td>
<td><!--span id="sprytxtDepartment">
              <input type="text" name="Department" value="" size="32" />
            <span class="textfieldRequiredMsg">A value is required.</span></span-->
            <select name="Department" >
            <option value=""><?php echo $obj_lang->get('Choose Department', $lang); ?></option>
              <?php
do {  
?>
              <option value="<?php echo $row_RSDepartment['Department']?>"><?php echo $row_RSDepartment['Department']?></option>
              <?php
} while ($row_RSDepartment = mysql_fetch_assoc($RSDepartment));
  $rows = mysql_num_rows($RSDepartment);
  if($rows > 0) {
      mysql_data_seek($RSDepartment, 0);
	  $row_RSDepartment = mysql_fetch_assoc($RSDepartment);
  }
?>
            </select></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Position', $lang); ?>:</td>
<td><span id="sprytxtPosition">
              <input type="text" name="Position" value="" size="32" />
            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Salary', $lang); ?>:</td>
<td><span id="sprytxtSalary">
              <input type="text" name="Salary" value="" size="15" />
            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Transport Allowance', $lang); ?>:</td>
<td><span id="sprytxtTransportAllowance">
              <input type="text" name="Transport_Allowance" value="" size="15" />
            <span class="textfieldInvalidFormatMsg">Invalid format type Number in Birr.</span></span></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Housing Allowance', $lang); ?>:</td>
<td><span id="sprytxtHousingAllowance">
              <input type="text" name="Housing_Allowance" value="" size="15" />
            <span class="textfieldInvalidFormatMsg">Invalid format type Number in Birr.</span></span></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Hardship Allowance', $lang); ?>:</td>
<td><span id="sprytxtHardshipAllowance">
              <input type="text" name="Hardship_Allowance" value="" size="15" />
            <span class="textfieldInvalidFormatMsg">Invalid format type Number in Birr.</span></span></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Position Allowance', $lang); ?>:</td>
            <td><span id="sprytxtPositionAllowance">
            <input type="text" name="Position_Allowance" value="" size="15" />
<span class="textfieldInvalidFormatMsg">Invalid format type Number in Birr.</span></span></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Present Allowance', $lang); ?>:</td>
            <td><span id="sprytxtPresentAllowance">
            <input type="text" name="Present_Allowance" value="" size="15" />
<span class="textfieldInvalidFormatMsg">Invalid format type Number in Birr.</span></span></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;               <input type="submit" value="<?php echo $obj_lang->get('Register', $lang); ?>" height="120" width="100"/></td>
          </tr>
        </table>
        <p>
          <input type="hidden" name="MM_insert" value="form1" />
        </p>
        <p>&nbsp;</p>
      </form>
      <p>&nbsp;</p>
<p>&nbsp;</p>
<blockquote>&nbsp;
      <p>&nbsp;</p>
  </blockquote>
    
  <!-- InstanceEndEditable -->
    <blockquote>&nbsp;</blockquote>
  </div>
  <div id="sidebar">
    <div id="sidemenu">
    
   <ul id="MenuBar2" class="MenuBarVertical">
     <li><a href="#"><?php echo $obj_lang->get('Tools', $lang); ?></a>
       <ul>
         <li><a href="javascript:popup('Calendar/CalendarConvertor.html')"><?php echo $obj_lang->get('Calendar Convertor', $lang); ?></a></li>
         <li><a href="Calendar/GeorgianEthiopianYearlyCalendar.html" target="_blank"><?php echo $obj_lang->get('Calendar', $lang); ?></a></li>
         <li><a href="javascript:popup('Calendar/Time.html')"><?php echo $obj_lang->get('Time', $lang); ?></a></li>
       </ul>
     </li>
     <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Personal Detail', $lang); ?></a>
       <ul>
       <li><a href="Probation_Evaluation.php"><?php echo $obj_lang->get('Probation Period Evaluation', $lang); ?></a>       </li>
         <li><a href="../Personal Record/Employee_Personal_Record.php"><?php echo $obj_lang->get('Personal Detail entry', $lang); ?></a></li>
         <li><a href="../Database_Update/PersonalRecordDisplay.php" target="_blank"><?php echo $obj_lang->get('Personal Detail Search', $lang); ?></a></li>
         <li><a href="Recruitment Data Update/ProbationPersonalRecordDisplay.php" title="Probation Period Personal Record Search" target="_blank"><?php echo $obj_lang->get('Probation Period Record Search', $lang); ?></a></li>
       </ul>
     </li>
     <li><a class="MenuBarItemSubmenu" href="#"><?php echo $obj_lang->get('Employee Status Transaction', $lang); ?></a>
       <ul>
         <li><a href="../Employee_Status_Transaction/Department_Transfer.php"><?php echo $obj_lang->get('Department Transfer', $lang); ?></a></li>
         <li><a href="../Employee_Status_Transaction/Promotion.php"><?php echo $obj_lang->get('Promotion', $lang); ?></a></li>
         <li><a href="../Employee_Status_Transaction/Demotion.php"><?php echo $obj_lang->get('Demotion', $lang); ?></a></li>
         <li><a href="../Court Case/Court_Case.php"><?php echo $obj_lang->get('Court Case', $lang); ?></a></li>
       </ul>
     </li>
     <li><a target="_blank" href="../Proclamation/Ethiopian Labour Law Pro.377(English).htm"><?php echo $obj_lang->get('Labour Law Proclamation', $lang); ?></a></li>
     <li><a href="#" class="MenuBarItemSubmenu"> <?php echo $obj_lang->get('HRM System Settings...', $lang); ?></a>
       <ul>
         <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('System Data Setting', $lang); ?></a>
           <ul>
             <li><a href="../Database_Update/CreatDepartment.php"><?php echo $obj_lang->get('Creat Department', $lang); ?></a></li>
             <li><a href="../Database_Update/DepartmentDisplay.php" target="_blank"><?php echo $obj_lang->get('Department Data', $lang); ?></a></li>
             <li><a href="Recruitment Data Update/RecruitmentDisplay.php" title="Recruitment Data" target="_blank"><?php echo $obj_lang->get('Recruitment Data', $lang); ?></a></li>
<li><a href="Recruitment Data Update/ProbationEvaluationDisplay.php" title="Probation Evaluation Data" target="_blank"><?php echo $obj_lang->get('Probation Evalution Data', $lang); ?></a></li>
<li><a href="../Equipment HandOver/Equipment Handover Database Update/EquipmentHandOverDisplay.php" title="Equipment handover Data" target="_blank"><?php echo $obj_lang->get('Equipment Handover Data', $lang); ?></a></li>
<li><a href="../Letters/warning Letters/Disciplinary Action Database Update/DisciplinaryDataDisplay.php" title="Disciplinary Action Data" target="_blank"><?php echo $obj_lang->get('Disciplinary Action  Data', $lang); ?></a></li>
<li><a href="../Employee_Status_Transaction/Employee Status Database Update/PromotionDisplay.php" title="Promotion Data" target="_blank"><?php echo $obj_lang->get('Promotion Data', $lang); ?></a></li>
<li><a href="../Employee_Status_Transaction/Employee Status Database Update/DemotionDisplay.php" title="Demotion Data" target="_blank"><?php echo $obj_lang->get('Demotion Data', $lang); ?></a></li>
<li><a href="../Letters/warning Letters/Disciplinary Action Database Update/TerminationDisplay.php" title="Termination Data" target="_blank"><?php echo $obj_lang->get('Termination Data', $lang); ?></a></li>
           </ul>
         </li>
         <li><a href="#"><?php echo $obj_lang->get('Leave Data Setting', $lang); ?></a>
         <ul>
           <li><a href="../Leaves/Leave Database_Update/AnnualLeaveDisplay.php" title="Annual Leave Data" target="_blank"><?php echo $obj_lang->get('Annual Leave Data', $lang); ?></a></li>
             <li><a href="../Leaves/Leave Database_Update/AnnualLeaveCalcDisplay.php" title="Annual Leave Calc" target="_blank"><?php echo $obj_lang->get('Annual Leave Calc', $lang); ?></a></li>
             <li><a href="../Leaves/Leave Database_Update/FuneralLeaveDisplay.php" title="Funeral Leave Data" target="_blank"><?php echo $obj_lang->get('Funeral Leave Data', $lang); ?></a></li>
             <li><a href="../Leaves/Leave Database_Update/SickLeaveDisplay.php" title="Sick Leave Data" target="_blank"><?php echo $obj_lang->get('Sick Leave Data', $lang); ?></a></li>
             <li><a href="../Leaves/Leave Database_Update/SpecialLeaveDisplay.php" title="Special Leave Data" target="_blank"><?php echo $obj_lang->get('Special Leave Data', $lang); ?></a></li>
             <li><a href="../Leaves/Leave Database_Update/MaternityLeaveDisplay.php" title="Maternity Leave Data" target="_blank"><?php echo $obj_lang->get('Maternity Leave Data', $lang); ?></a></li>
             <li><a href="../Leaves/Leave Database_Update/WeddingLeaveDisplay.php" title="Wedding Leave Data" target="_blank"><?php echo $obj_lang->get('Wedding Leave Data', $lang); ?></a></li>
         </ul></li>
         <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('User account', $lang); ?></a>
           <ul>
             <li><a href="../User_Account/Creat_Account.php"><?php echo $obj_lang->get('Creat User Account', $lang); ?></a></li>
             <li><a href="../User_Account/Change_Password.php"><?php echo $obj_lang->get('Change Password', $lang); ?></a></li>
             <li><a href="../User_Account/Delete_Account.php"><?php echo $obj_lang->get('Delete User Account', $lang); ?></a></li>
           </ul>
     </li>
<li><a href="<?php echo $logoutAction ?>"><?php echo $obj_lang->get('Log Out', $lang); ?></a></li>
       </ul>
   </li>
   </ul>
<!--<p><a href="main_template.html">side menu 1</a>
      <p><a href="about.html">side menu 1</a>      
      <p><a href="about.html">side menu 1</a>
      </p>
      <a href="about.html">side menu 1</a>
<p>side menu 1</p>
<p><a href="about.html">side menu 1</a></p>
-->
</div>
  <div id="sidecontent">
    <p>&nbsp;</p>
    <!-- InstanceBeginEditable name="SideContent" -->
    <br />
    <br />
    <br /> <br />
    <br />
    <a href="../Proclamation/Ethiopian Labour Law Pro.377(English).htm#a4" target="_blank">Contract Recruitment Labour Law</a><p></p>
    <p><a href="../Proclamation/Ethiopian Labour Law Pro.377(English).htm#a11" target="_blank">Probation Period Labour Law</a></p>
    <a href="../Proclamation/Ethiopian Labour Law Pro.377(English).htm#a47" target="_blank">Personal Record Labour Law</a>
    <?php //include ("../Notifications/ALNotification.php");?>
    <?php include ("../Notifications/EvalutionNotification.php");?>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
	
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytxtEmployee", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytxtPlace", "none", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytxtID", "none", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytxtFirstName", "none", {validateOn:["blur"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytxtMiddelName", "none", {validateOn:["blur"]});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytxtLastName", "none", {validateOn:["blur"]});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytxtAge", "integer", {minValue:0, maxValue:100, validateOn:["blur"]});
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytxtPosition", "none", {validateOn:["blur"]});
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytxtSalary", "none", {validateOn:["blur"]});
var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytxtTransportAllowance", "currency", {validateOn:["blur"], isRequired:false});
var sprytextfield14 = new Spry.Widget.ValidationTextField("sprytxtHousingAllowance", "currency", {validateOn:["blur"], isRequired:false});
var sprytextfield11 = new Spry.Widget.ValidationTextField("sprytxtHardshipAllowance", "currency", {validateOn:["blur"], isRequired:false});
var sprytextfield12 = new Spry.Widget.ValidationTextField("sprytxtPositionAllowance", "currency", {validateOn:["blur"], isRequired:false});
var sprytextfield13 = new Spry.Widget.ValidationTextField("sprytxtDepartment", "none", {validateOn:["blur"]});
var sprytextfield14 = new Spry.Widget.ValidationTextField("sprytxtPresent", "none", {validateOn:["blur"]});
    </script>
    
    <!-- InstanceEndEditable -->
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  </div>
  </div>
  <div id="footer">
    <p class="lf">&copy; Copyright ThekeyHRMS.Designed and Developed by <a href="http://www.thekey.com">Thekeysoft ICT Soultion</a> &nbsp;Licensed for Ammerlaan Quality Roses(AQ Roses)</p>
     </div>
  <p align="center"><img src="../img logo & icons/thekey soft.jpg" width="159" height="37" /><sup ><sup style="font-size:15px">&reg;&trade;</sup></sup></p>
</div>
<script type="text/javascript">
var MenuBar2 = new Spry.Widget.MenuBar("MenuBar2", {imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"../SpryAssets/SpryMenuBarDownHover.gif", imgRight:"../SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($RSRecruitment);

mysql_free_result($RSDepartment);
?>
