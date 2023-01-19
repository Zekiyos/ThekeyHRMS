<?php 
include('../../User_account/Class_AccessLevel.php');
 $obj_AccessLevel = new AccessLevel();
echo $obj_AccessLevel->CHK_AccessLevel(); 
?>
<?php require_once('../../Connections/HRMS.php'); ?>
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
$query_RSFirstName = "SELECT * FROM recruitment ORDER BY ID ASC";
$RSFirstName = mysql_query($query_RSFirstName, $HRMS) or die(mysql_error());
$row_RSFirstName = mysql_fetch_assoc($RSFirstName);
$totalRows_RSFirstName = mysql_num_rows($RSFirstName);mysql_select_db($database_HRMS, $HRMS);
$query_RSFirstName = "SELECT ID, FirstName, MiddelName, LastName FROM recruitment ORDER BY ID ASC";
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
 echo "<script type=\"text/javascript\">alert('Please, Enter first a search term.')";
echo "Window.location.href='PersonalRecordDisplay.php'</script>"; 
 exit; 
 } 
 else
 {
 
 // Otherwise we connect to our Database 
 /////mysql_connect("localhost", "root", "") or die(mysql_error()); 
////// mysql_select_db("aqhrmsdb") or die(mysql_error()); 
 
 // We preform a bit of filtering 
 $find = strtoupper($find); 
 $find = strip_tags($find); 
 $find = trim ($find); 
 $field="FirstName";
 //Now we search for our search term, in the field the user specified 
 
if($_POST['comparison']!="Contain")
 {
	  $data = mysql_query("SELECT *
FROM `recruitment`
WHERE ".$_POST['field']." ". $_POST['comparison']."'".$find."'");  
 }
 else
 {
 $data = mysql_query("SELECT * FROM recruitment WHERE upper(".$_POST['field'].") LIKE'%$find%' "); 
 
 }
 
// echo "<table border=\"4\" align=\"center\"LIMIT 10 bgcolor=\"#EBEBEB\" bordercolor=\"#FF6600\" >";
 
 //And we display the results 
 while($result = mysql_fetch_array( $data )) 
 { 
 $ID=$result['ID'];
 //display results over here 

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
    <select name="field" id="field">
    <option value="FirstName">First Name</option>
      <option value="ID">ID</option>
      <option value="MiddelName">Middel Name</option>
      <option value="LastName">Last Name</option>
	  <option value="Employee">Employee</option>
	  <option value="Place">Place</option>
      <option value="Age">Age</option>
      <option value="Sex">Sex</option>
	  <option value="Photo">Photo</option>
      <option value="Date">Date of Employement</option>
	  <option value="Address">Address</option> 
      <option value="Department">Department</option>
      <option value="Position">Position</option>
      <option value="Salary">Salary</option>
      <option value="Transport_Allowance">Transport Allowance</option>  	 
	  <option value="Hardship_Allowance">Hardship Allowance</option>
	  <option value="Housing_Allowance">Housing Allowance</option>  	 
	  <option value="Position_Allowance">Position Allowance</option>
	  <option value="Present_Allowance">Present Allowance</option>
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
	<td>ID</td>
    <td>First Name</td>
    <td>Middel Name</td>
    <td>Last Name</td>
	<td>Employee</td>
    <td>Place</td>
    <td>Age</td>
    <td>Sex</td>
    <td>Photo</td>
    <td>Date of Employement</td>
	<td>Address</td> 
    <td>Department</td>
    <td>Position</td>
    <td>Salary</td>
    <td>Transport_Allowance</td>  	 
	<td>Hardship_Allowance</td>
	<td>Housing_Allowance</td>  	 
	<td>Position_Allowance</td>
	<td>Present_Allowance</td>
    </tr>
  <?php do { ?>
    <tr><td><a  target="_blank" href="RecruitmentUpdate.php?Auto_ID=<?php echo $result['Auto_ID']; ?>"  ><?php echo "<p>Update</p> </a>";?></a>
     <a  href="javascript: if (confirm('Are You Sure You want to Delete the Employee Recored?')) { window.location.href='RecruitmentDelete.php?Auto_ID=<?php echo $result['Auto_ID']; ?>' } else { void('') }; "
    
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
      <td bgcolor="<?php if($_POST['field']=="Employee")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Employee']; ?>&nbsp; </td>
      <td bgcolor="<?php if($_POST['field']=="Place")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Place']; ?>&nbsp; </td>
      <td bgcolor="<?php if($_POST['field']=="Age")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Age']; ?>&nbsp; </td>
      <td bgcolor="<?php if($_POST['field']=="Sex")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Sex']; ?>&nbsp; </td>
      <td bgcolor="<?php if($_POST['field']=="Photo")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Photo']; ?>&nbsp; </td>
      <td bgcolor="<?php if($_POST['field']=="Date")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Date']; ?>&nbsp; </td>
		  <td bgcolor="<?php if($_POST['field']=="Address")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Address']; ?>&nbsp; </td>
      <td bgcolor="<?php if($_POST['field']=="Department")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Department']; ?>&nbsp; </td>
      <td bgcolor="<?php if($_POST['field']=="Position")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Position']; ?>&nbsp; </td>
      <td bgcolor="<?php if($_POST['field']=="Salary")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Salary']; ?>&nbsp; </td>
      <td bgcolor="<?php if($_POST['field']=="Transport_Allowance")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Transport_Allowance']; ?>&nbsp; </td>
          
      <td bgcolor="<?php if($_POST['field']=="Hardship_Allowance")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Housing_Allowance']; ?>&nbsp; </td>
         
         <td bgcolor="<?php if($_POST['field']=="Hardship_Allowance")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Housing_Allowance']; ?>&nbsp; </td>
           
      <td bgcolor="<?php if($_POST['field']=="Position_Allowance")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Position_Allowance']; ?>&nbsp; </td>
          
      <td bgcolor="<?php if($_POST['field']=="Present_Allowance")
	  echo "#FFFFCC";
		  ?>"><?php echo $result['Present_Allowance']; ?>&nbsp; </td>
           </tr>
    <?php } while ($result = mysql_fetch_assoc($data)); ?>
</table>


<?php




 
 } 
 
 //This counts the number or results - and if there wasn't any it gives them a little message explaining that 
 $anymatches=mysql_num_rows($data); 
 

 if ($anymatches == 0) 
 { 
 echo "<font color=\"#FF0000\">Sorry, but there is no such employee on entire current employee list.Check the term you have typed in!! </font>&nbsp;&nbsp;&nbsp;<a href=\"ProbationPersonalRecordDisplay.php\">Try again</a><br><br>"; 
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
$query_RSsearch = "SELECT * FROM recruitment";
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
<font color="#FF6600" size="+2" > <p align="center">Probation Period Personal Record Search and Update</p> </font>
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
	  <option value="Employee">Employee</option>
	  <option value="Place">Place</option>
      <option value="Age">Age</option>
      <option value="Sex">Sex</option>
	  <option value="Photo">Photo</option>
      <option value="Date">Date of Employement</option>
	  <option value="Address">Address</option> 
      <option value="Department">Department</option>
      <option value="Position">Position</option>
      <option value="Salary">Salary</option>
      <option value="Transport_Allowance">Transport Allowance</option>  	 
	  <option value="Hardship_Allowance">Hardship Allowance</option>
	  <option value="Housing_Allowance">Housing Allowance</option>  	 
	  <option value="Position_Allowance">Position Allowance</option>
	  <option value="Present_Allowance">Present Allowance</option>
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
</table>
 
</form>
<?php }?>
</body>
</html>
<?php
mysql_free_result($RSFirstName);
?>
