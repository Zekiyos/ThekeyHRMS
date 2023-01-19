
<?php require_once('../../Connections/HRMS.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "admin,administrator";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
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

$MM_restrictGoTo = "../../login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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

mysql_select_db($database_HRMS, $HRMS);
$query_RSFirstName = "SELECT * FROM employee_personal_record ORDER BY ID ASC";
$RSFirstName = mysql_query($query_RSFirstName, $HRMS) or die(mysql_error());
$row_RSFirstName = mysql_fetch_assoc($RSFirstName);
$totalRows_RSFirstName = mysql_num_rows($RSFirstName);mysql_select_db($database_HRMS, $HRMS);
$query_RSFirstName = "SELECT ID, FirstName, MiddelName, LastName FROM employee_personal_record ORDER BY ID ASC";
$RSFirstName = mysql_query($query_RSFirstName, $HRMS) or die(mysql_error());
$row_RSFirstName = mysql_fetch_assoc($RSFirstName);
$totalRows_RSFirstName = mysql_num_rows($RSFirstName);
?>

<?php

//// serach code



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
  
  
  $searching ="yes";
  $find = $_POST['find'];


 //This is only displayed if they have submitted the form 
 if ($searching =="yes") 
 { 
  
 
 //If they did not enter a search term we give them an error 
 if ($find == "") 
 { 
 echo "<script type=\"text/javascript\">alert('Please, Enter first a search term.');
 Window.location.href='PersonalRecordDisplay.php';</script>"; 
 exit; 
 } 
 else
 {
 
 // Otherwise we connect to our Database 
 /////mysql_connect("localhost", "root", "") or die(mysql_error()); 
////// mysql_select_db("sherhrmsdb") or die(mysql_error()); 
 
 // We preform a bit of filtering 
 $find = strtoupper($find); 
 $find = strip_tags($find); 
 $find = trim ($find); 
 $field="FirstName";
 //Now we search for our search term, in the field the user specified 
 
if($_POST['comparison']!="Contain")
 {
	 /* $data = mysql_query("SELECT *
FROM `employee_personal_record`
WHERE ".$_POST['field']." ". $_POST['comparison']."'".$find."'"); */

 $data =mysql_query("SELECT * FROM employee_personal_record 
LEFT JOIN annual_leave ON Employee_personal_record.ID= annual_Leave.ID 
LEFT JOIN sick_leave ON Employee_personal_record.ID = sick_leave.ID
LEFT JOIN Maternity_leave ON Employee_personal_record.ID = Maternity_leave.ID
LEFT JOIN funeral_leave ON Employee_personal_record.ID = funeral_leave.ID 
LEFT JOIN Wedding_leave ON Employee_personal_record.ID = Wedding_leave.ID WHERE Employee_personal_record.".$_POST['field']." ". $_POST['comparison']."'".$find."'");

 
 }
 else
 {
$data = mysql_query("SELECT * FROM employee_personal_record WHERE upper(".$_POST['field'].") LIKE'%$find%' "); 
 
 $data =mysql_query("SELECT * FROM employee_personal_record 
LEFT JOIN annual_leave ON Employee_personal_record.ID= annual_Leave.ID 
LEFT JOIN sick_leave ON Employee_personal_record.ID = sick_leave.ID
LEFT JOIN Maternity_leave ON Employee_personal_record.ID = Maternity_leave.ID
LEFT JOIN funeral_leave ON Employee_personal_record.ID = funeral_leave.ID 
LEFT JOIN Wedding_leave ON Employee_personal_record.ID = Wedding_leave.ID WHERE upper(Employee_personal_record.".$_POST['field'].") LIKE'%$find%' ");

 }
 
// echo "<table border=\"4\" align=\"center\"LIMIT 10 bgcolor=\"#EBEBEB\" bordercolor=\"#FF6600\" >";
 
 //And we display the results 
 while($result = mysql_fetch_array( $data )) 
 { 
 $ID=$result['ID'];
 //display results over here 
  
    
          echo $result['Leave_Taken_Date']; 
         echo $result['ReportOn'];           
         echo $result['Report_Back_Date']; 
		 echo $result['Leavedays']; 
	      echo $result['RestDay']; 
?>
<div id="headerAdvert" align="center">
    <H2 ><font  size="20" color="#FF6600" >Thekey</font><span id="headerAdvert"><font color="#999999" size="20" >HRMS</font><font color="#999999" size="3" >    Bringing ICT Solution to Your need.</font>  </span> <font color="#999999" size="3" >The key is yours!! </font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../../index.php"><img src="../../flags/United Kingdom flag.png" width="35" height="25" /></a><a href="../../Amharic/index.php"><img border="0" src="../../flags/Ethiopiaflag.jpg" alt="Amharic(ETH)" width="35" height="30" /></a><a href="../../Dutch/index.php"><img src="../../flags/Netherlands-Flag-icon.png" width="35" height="25" /></a></h2>
   <H2><font color="#999999" size="+1" ></font><img src="../../img logo & icons/logo.jpg" alt="Rev(3:7)He that hath THE KEY of David, he that openeth, and no man shutteth;  and shutteth, and no man openeth;" width="100" height="40" />
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     <font color="#FF6600" size="6">Human Resource Management System </font>
     </font></h2>
  </div>
  <div id="line">
</div>
  <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table>
    <tr>
    <td>Type the search term </td>
  <td><input type="text" size="20" id="find" name="find" />
  </td>
  <td><input type="image" src="../../img logo & icons/Search.png" width="67" height="69" />   </td>
  <td>&nbsp;&nbsp;
    Field Name
	
	<select name="Sick_Leave_field "id="Sick_Leave_field " style="visibility:hidden">
   <option>ID</option>
<option>FirstName</option>
<option>MiddelName</option>
<option>LastName</option>
<option>SIckLeaveDays</option>
<option>SickLeave_Taken_Date</option>
<option>ReportOn</option>
<option>LeaveType</option>
<option>Reported</option>
<option>Report_Back_Date</option>
        </select>
    <select name="field" id="field" >
   <option value="FirstName">First Name</option>
      <option value="ID">ID</option>
      <option value="MiddelName">Middel Name</option>
      <option value="LastName">Last Name</option>
      <option value="Date_Birth">Date of Birth</option>
      <option value="Place_Birth">Place of Birth</option>
      <option value="Age">Age</option>
      <option value="Sex">Sex</option>
      <option value="Email">Email</option>
      <option value="Date_Employement">Date of Employement</option>
      <option value="Department">Department</option>
      <option value="Position">Position</option>
      <option value="Educational_Status">Educational Status</option>
      <option value="Salary">Salary</option>
      <option value="Martial_Status">Martial Status</option>
      <option value="Children_number">number of Children </option>
      <option value="Name_Child">Name of Child</option>
      <option value="Age_Child">Age of Child </option>
      <option value="Sex_Child">Sex of Child </option>
      <option value="Photo">Photo</option>
      <option value="Image">Image</option>
      <option value="Experience">Experience</option>
      <option value="HardCopy_Shelf_No">Hard Copy Shelf No</option>
  </select>    &nbsp;</td>
  <td>Comparison <select name="comparison" id="comparison">
  <option>Contain</option>
  <option value="=" >EQAUL</option>
      <option value="!=">NOT EQAUL</option>
      <option value=">">GREATERTHAN</option>
      <option value="=>">GREATERTHAN OR EQUAL</option>
      <option value="<" >LESSTHAN</option>
      <option value="<=">LESSTHAN OR EQAUL</option>
      
      </select> </td>
  <td> <input type="hidden" name="MM_insert" value="form1" /></td>
  
  </tr>
</table>
  </blockquote>
   <blockquote><blockquote><blockquote><blockquote> <blockquote>
   <blockquote><blockquote><blockquote><blockquote> <blockquote>
   <blockquote><blockquote><blockquote><blockquote> <blockquote><blockquote><blockquote> <blockquote><blockquote><blockquote> <blockquote>
   <input type=button value="Print Out" onClick="PrintContent()" align="right" ></blockquote></blockquote></blockquote></blockquote></blockquote>
   </blockquote></blockquote></blockquote></blockquote></blockquote>
   </blockquote></blockquote></blockquote></blockquote></blockquote></blockquote></blockquote></blockquote></blockquote></blockquote></blockquote>
<script type="text/javascript">
function PrintContent()
    {
		 if (confirm('Are you sure you want to Print Out the Search result in current setting of paper scale?')) {
			 var DocumentContainer = document.getElementById('searchResult');
        var WindowObject = window.open('', "TrackHistoryData", 
                              "width=740,height=325,top=200,left=250,toolbars=no,scrollbars=yes,status=no,resizable=no");
        WindowObject.document.writeln(DocumentContainer.innerHTML);
		
        WindowObject.document.close();
        WindowObject.focus();
        WindowObject.print();
        WindowObject.close();
		  }
		   else
		    {alert("To adjust the paper scale go to Print preview pane and set 40% for your A4 paper."); void('') }; 
		
        
    }
	
	function XLExport() {
var i;
var j;
var mycell;
var tableID = "searchtbl";

var objXL = new ActiveXObject("Excel.Application");
var objWB = objXL.Workbooks.Add();
var objWS = objWB.ActiveSheet;

for (i=0; i < document.getElementById(tableID).rows.length; i++)
{
    for (j=0; j < document.getElementById(tableID).rows(i).cells.length; j++)
    {
        mycell = document.getElementById(tableID).rows(i).cells(j)
        objWS.Cells(i+1,j+1).Value = mycell.innerText;
       
    
    }
}

//objWS.Range("A1", "L1").Font.Bold = true;

objWS.Range("A1", "Z1").EntireColumn.AutoFit();

//objWS.Range("C1", "C1").ColumnWidth = 50;

objXL.Visible = true;

}

</script>
<script language="javascript">

function runApp()

{

var excApp = new ActiveXObject("Excel.Application");

excApp.visible = true;

var excBook = excApp.Workbooks.open("D:\Documents and Settings\Admin\My Documents\Sher HRMS Data\Book4.xls");

}

</script>
</form>
 <div id="searchResult"> 
 <input type="button" onClick="XLExport()" value="Export to XL" />
 <?php
 //Result
  echo "<h2><font color=\"#FB33\">Results</font></h2><p>";
  //And we remind them what they searched for 
  $anymatches=mysql_num_rows($data);
 
 echo "<b>Searched For:</b> " .$find;
 echo "<br/><b>On Field Name:</b>".$_POST['field']."";
 echo "<br/><b> Total Available :</b> ".$anymatches." employee";
 	 echo "<br/><b>Comparison: ".$_POST['comparison'] ."</b> ";
 
 ?>
 
<table id="searchtbl" border="1" cellpadding="0" align="center" border="1" bordercolor="#FF6600" >

  <tr>
  <td>Operation</td>
    <td >Auto_ID</td>
    <td >ID</td>
    <td>FirstName</td>
    <td>MiddelName</td>
    <td>LastName</td>
    <td>Date_Birth</td>
    <td>Place_Birth</td>
    <td>Age</td>
    <td>Sex</td>
    <td>Email</td>
    <td>Date_Employement</td>
    <td>Department</td>
    <td>Position</td>
    <td>Educational_Status</td>
    <td>Salary</td>
    <td>Martial_Status</td>
    <td>Children_number</td>
    <td>Name_Child</td>
    <td>Age_Child</td>
    <td>Sex_Child</td>
    <td>Photo</td>
    <td>Image</td>
    <td>Experience</td>
    <td>HardCopy_Shelf_No</td>
    <td>ModifiedBy</td>
    
    <td>LeaveType</td>
    <td>Leavedays</td>
<td>RestDay</td>
<td>Leave_Taken_Date</td>
<td>ReportOn</td>
<td>Reported</td>
<td>Report_Back_Date</td>

    </tr>
  <?php do { ?>
    <tr><td><a  target="_blank" href="PersonalRecordUpdate.php?Auto_ID=<?php echo $result['Auto_ID']; ?>"  ><?php echo "<p>Update</p> </a>";?></a>
     <a  href="javascript: if (confirm('Are You Sure You want to Delte the Employee Reocred?')) { window.location.href='DeletePersonalRecord.php?Auto_ID=<?php echo $result['Auto_ID']; ?>' } else { void('') }; "
    
     ><?php echo "Delete </a>";?></a>
      <td><a  target="_blank" href="PersonalRecordDetail.php?recordID=<?php echo $result['Auto_ID']; ?>"> <?php echo $result['Auto_ID']; ?>&nbsp; </td>
      <td bgcolor="<?php if($_POST['field']=="ID")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['ID']; ?>&nbsp; </td>
      <td bgcolor="<?php if($_POST['field']=="FirstName")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['FirstName']; ?>&nbsp; </td>
      <td bgcolor="<?php if($_POST['field']=="MiddelName")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['MiddelName']; ?>&nbsp; </td>
      <td bgcolor="<?php if($_POST['field']=="LastName")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['LastName']; ?>&nbsp; </td>
      <td bgcolor="<?php if($_POST['field']=="Date_Birth")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Date_Birth']; ?>&nbsp; </td>
      <td bgcolor="<?php if($_POST['field']=="Place_Birth")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Place_Birth']; ?>&nbsp; </td>
      <td bgcolor="<?php if($_POST['field']=="Age")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Age']; ?>&nbsp; </td>
      <td bgcolor="<?php if($_POST['field']=="Sex")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Sex']; ?>&nbsp; </td>
      <td bgcolor="<?php if($_POST['field']=="Email")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Email']; ?>&nbsp; </td>
      <td bgcolor="<?php if($_POST['field']=="Date_Employement")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Date_Employement']; ?>&nbsp; </td>
      <td bgcolor="<?php if($_POST['field']=="Department")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Department']; ?>&nbsp; </td>
      <td bgcolor="<?php if($_POST['field']=="Position")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Position']; ?>&nbsp; </td>
      <td bgcolor="<?php if($_POST['field']=="Educational_Status")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Educational_Status']; ?>&nbsp; </td>
      <td bgcolor="<?php if($_POST['field']=="Salary")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Salary']; ?>&nbsp; </td>
      <td bgcolor="<?php if($_POST['field']=="Martial_Status")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Martial_Status']; ?>&nbsp; </td>
      <td bgcolor="<?php if($_POST['field']=="Children_number")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Children_number']; ?>&nbsp; </td>
      <td bgcolor="<?php if($_POST['field']=="Name_Child")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Name_Child']; ?>&nbsp; </td>
      <td bgcolor="<?php if($_POST['field']=="Age_Child")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Age_Child']; ?>&nbsp; </td>
      <td bgcolor="<?php if($_POST['field']=="Sex_Child")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Sex_Child']; ?>&nbsp; </td>
      <td bgcolor="<?php if($_POST['field']=="Photo")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Photo']; ?>&nbsp; </td>
      <td bgcolor="<?php if($_POST['field']=="Image")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Image']; ?>&nbsp; </td>
      <td bgcolor="<?php if($_POST['field']=="Experience")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Experience']; ?>&nbsp; </td>
      <td bgcolor="<?php if($_POST['field']=="HardCopy_Shelf_No")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['HardCopy_Shelf_No']; ?>&nbsp; </td>
      <td bgcolor="<?php if($_POST['field']=="ModifiedBy")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['ModifiedBy']; ?>&nbsp; </td>
          
          
          
          
       <td bgcolor="<?php if($_POST['field']=="LeaveType")
	         echo "#FFFFCC";
		  ?>"><?php echo $result['LeaveType']; ?>&nbsp; </td>
          
          <td bgcolor="<?php if($_POST['field']=="Leavedays")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Leavedays']; ?>&nbsp; </td>
          
          <td bgcolor="<?php if($_POST['field']=="RestDay")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['RestDay']; ?>&nbsp; </td>
          
          <td bgcolor="<?php if($_POST['field']=="Leave_Taken_Date")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Leave_Taken_Date']; ?>&nbsp; </td>
          
          <td bgcolor="<?php if($_POST['field']=="ReportOn")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['ReportOn']; ?>&nbsp; </td>
          
          <td bgcolor="<?php if($_POST['field']=="Reported")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Reported']; ?>&nbsp; </td>
          
          <td bgcolor="<?php if($_POST['field']=="Report_Back_Date")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Report_Back_Date']; ?>&nbsp; </td>
         
      </tr>
      
      
    
      
      
      
    <?php } while ($result = mysql_fetch_assoc($data)); ?>
</table>


<?php




 
 } 
 
 //This counts the number or results - and if there wasn't any it gives them a little message explaining that 
 $anymatches=mysql_num_rows($data); 
 

 if ($anymatches == 0) 
 { 
 echo "<font color=\"#FF0000\">Sorry, but there is no such employee on entire current employee list.Check the term you have typed in!! </font>&nbsp;&nbsp;&nbsp;<a href=\"PersonalRecordDisplay.php\">Try again</a><br><br>"; 
 } 
 
 //And we remind them what they searched for 
 echo "<b>Searched For:</b> " .$find;
 echo "<br/><b>On Field Name:</b>".$_POST['field']."";
 echo "<br/><b> Total Available :</b> ".$anymatches." employee </div>"; 
 } 

  
 }//else closing for empty serach text
  

 // mysql_select_db($database_HRMS, $HRMS);
 // $Result1 = mysql_query($insertSQL, $HRMS) or die(mysql_error());
}

mysql_select_db($database_HRMS, $HRMS);
$query_RSsearch = "SELECT * FROM employee_personal_record";
$RSsearch = mysql_query($query_RSsearch, $HRMS) or die(mysql_error());
$row_RSsearch = mysql_fetch_assoc($RSsearch);
$totalRows_RSsearch = mysql_num_rows($RSsearch);




////serach code end
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>

</title>

<script type='text/javascript'>
function SelectedFirstName(elem, helperMsg){
	//document.writeln(elem.value);
	alert ( "You have Slelcted " + elem.value + "!")
	//var ID=elem.value;

location="Personal_Information_detail.php?FirstName=" + elem.value;
 
	if(elem.value == "Please Choose FirstName"){
		alert(helperMsg);
		elem.focus();
		return false;
	}else{
		return true;
	}
	

}
function TypedFirstName(elem, helperMsg){
	var str=elem.value;
	str=str.toUpperCase()
	//str.replace("Microsoft","W3Schools"));
//if (str.match("SH")==null) {
if (str.indexOf("SH")!=0) {
	
location="Personal_Information_detail.php?FirstName=" + elem.value;
}
else
{
location="Personal_Information_detail.php?ID=" + elem.value;
}
	if(elem.value == ""){
		alert(helperMsg);
		elem.focus();
		return false;
	}else{
		return true;
	}
	
}
function SelectedID(elem, helperMsg){
	
	alert ( "You have Slelcted " + elem.value + "!")
	var ID=elem.value;
location="Personal_Information_detail.php?ID=" + elem.value;
	if(elem.value == "Please Choose ID Number"){
		alert(helperMsg);
		elem.focus();
		return false;
	}else{
		return true;
	}
}


</script>



<style type="text/css">
#line {
	background-color: #666;
	height: 7px;
}
</style>

</head>

<body >
<?php if(!isset($_POST['field'])){?>
<div id="headerAdvert" align="center">
    <H2 ><font  size="20" color="#FF6600" >Thekey</font><span id="headerAdvert"><font color="#999999" size="20" >HRMS</font><font color="#999999" size="3" >    Bringing ICT Solution to Your need.</font>  </span> <font color="#999999" size="3" >The key is yours!! </font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../../index.php"><img src="../../flags/United Kingdom flag.png" width="35" height="25" /></a><a href="../../Amharic/index.php"><img border="0" src="../../flags/Ethiopiaflag.jpg" alt="Amharic(ETH)" width="35" height="30" /></a><a href="../../Dutch/index.php"><img src="../../flags/Netherlands-Flag-icon.png" width="35" height="25" /></a></h2>
   <H2><font color="#999999" size="+1" ></font><img src="../../img logo & icons/logo.jpg" alt="Rev(3:7)He that hath THE KEY of David, he that openeth, and no man shutteth;  and shutteth, and no man openeth;" width="100" height="40" />
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     <font color="#FF6600" size="6">Human Resource Management System </font>
     </font></h2>
</div>
<div id="line">
</div>
<font color="#FF6600" size="+2" > <p align="center">Personal Record Search and Update</p> </font>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">

  <table >
    <tr>
    <td>Type search term</td>
  <td><input type="text" size="20" id="find" name="find" />
  </td>
  <td><input type="image" src="../../img logo & icons/Search.png" width="67" height="69" />   </td>
  <td>&nbsp;&nbsp;
    Field Name
    <select name="field" id="field">
  <option value="FirstName">First Name</option>
      <option value="ID">ID</option>
      <option value="MiddelName">Middel Name</option>
      <option value="LastName">Last Name</option>
      <option value="Date_Birth">Date of Birth</option>
      <option value="Place_Birth">Place of Birth</option>
      <option value="Age">Age</option>
      <option value="Sex">Sex</option>
      <option value="Email">Email</option>
      <option value="Date_Employement">Date of Employement</option>
      <option value="Department">Department</option>
      <option value="Position">Position</option>
      <option value="Educational_Status">Educational Status</option>
      <option value="Salary">Salary</option>
      <option value="Martial_Status">Martial Status</option>
      <option value="Children_number">number of Children </option>
      <option value="Name_Child">Name of Child</option>
      <option value="Age_Child">Age of Child </option>
      <option value="Sex_Child">Sex of Child </option>
      <option value="Photo">Photo</option>
      <option value="Image">Image</option>
      <option value="Experience">Experience</option>
      <option value="HardCopy_Shelf_No">Hard Copy Shelf No</option>
  </select>    &nbsp;</td>
  <td> <input type="hidden" name="MM_insert" value="form1" /></td>
  <td>Comparison <select name="comparison" id="comparison">
  <option>Contain</option>
  <option value="=" >EQAUL</option>
      <option value="!=">NOT EQAUL</option>
      <option value=">">GREATERTHAN</option>
      <option value="=>">GREATERTHAN OR EQUAL</option>
      <option value="<" >LESSTHAN</option>
      <option value="<=">LESSTHAN OR EQAUL</option>
      
    
  </select> </td>
  </tr>
  <!--tr>
  <td>Leave Types<select id="leavetype" name="leavetype" multiple="multiple" size="4">
  <option>Sick Leave</option>
  <option>Annual Leave</option>
  <option>Wedding Leave</option>
  <option>Maternity Leave</option>
  <option>Funeral Leave</option>
    </select></td>
  </tr-->
</table>
 
</form>
<?php }?>
</body>
</html>
<?php
mysql_free_result($RSFirstName);
?>
