<?php require_once('../Connections/HRMS.php'); ?><?php
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

$maxRows_DetailRS1 = 10;
$pageNum_DetailRS1 = 0;
if (isset($_GET['pageNum_DetailRS1'])) {
  $pageNum_DetailRS1 = $_GET['pageNum_DetailRS1'];
}
$startRow_DetailRS1 = $pageNum_DetailRS1 * $maxRows_DetailRS1;

$colname_DetailRS1 = "-1";
if (isset($_GET['recordID'])) {
  $colname_DetailRS1 = $_GET['recordID'];
}
mysql_select_db($database_HRMS, $HRMS);
$query_DetailRS1 = sprintf("SELECT * FROM employee_personal_record WHERE Auto_ID = %s", GetSQLValueString($colname_DetailRS1, "int"));
$query_limit_DetailRS1 = sprintf("%s LIMIT %d, %d", $query_DetailRS1, $startRow_DetailRS1, $maxRows_DetailRS1);
$DetailRS1 = mysql_query($query_limit_DetailRS1, $HRMS) or die(mysql_error());
$row_DetailRS1 = mysql_fetch_assoc($DetailRS1);

if (isset($_GET['totalRows_DetailRS1'])) {
  $totalRows_DetailRS1 = $_GET['totalRows_DetailRS1'];
} else {
  $all_DetailRS1 = mysql_query($query_DetailRS1);
  $totalRows_DetailRS1 = mysql_num_rows($all_DetailRS1);
}
$totalPages_DetailRS1 = ceil($totalRows_DetailRS1/$maxRows_DetailRS1)-1;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Personal Record Detail</title>
</head>

<body>
<script>
//function save(){
//saveHTML(document.getElementById('PersonalRecordDetail').innerHTML);
//document.location.href = '1.html';
////document.ex
//
//}
</script>
<!--button onclick="save()">Click to save</Button--> 
</blockquote>
   <blockquote><blockquote><blockquote><blockquote> <blockquote>
   <blockquote><blockquote><blockquote><blockquote> <blockquote>
   <blockquote><blockquote><blockquote><blockquote> <blockquote><blockquote><blockquote> <blockquote><blockquote><blockquote> <blockquote>
   <input type=button value="Print Out" onclick="PrintContent()" align="right" ></blockquote></blockquote></blockquote></blockquote></blockquote>
   </blockquote></blockquote></blockquote></blockquote></blockquote>
   </blockquote></blockquote></blockquote></blockquote></blockquote></blockquote></blockquote></blockquote></blockquote></blockquote></blockquote>
<script type="text/javascript">
function PrintContent()
    {
		 if (confirm('Are you sure you want to Print Out the Search result in current setting of paper scale?')) {
			 var DocumentContainer = document.getElementById('PersonalRecordDetail');
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
</script>
<div id="PersonalRecordDetail">
<?php echo "<p align=\"center\"><font color=\"#FF6600\" size=\"+2\" face=\"Times New Roman\">".$row_DetailRS1['FirstName']." ".$row_DetailRS1['MiddelName'] ."'s Personal Detail</font></p>
"; ?>


<table border="1" align="center"  bgcolor="#FFFFFF" bordercolor="#FF9900"  >
  <tr>
    <td>Auto_ID</td>
    <td><?php echo $row_DetailRS1['Auto_ID']; ?></td>
  </tr>
  <tr>
    <td>ID</td>
    <td><?php echo $row_DetailRS1['ID']; ?></td>
  </tr>
  <tr>
    <td>FirstName</td>
    <td><?php echo $row_DetailRS1['FirstName']; ?></td>
  </tr>
  <tr>
    <td>MiddelName</td>
    <td><?php echo $row_DetailRS1['MiddelName']; ?></td>
  </tr>
  <tr>
    <td>LastName</td>
    <td><?php echo $row_DetailRS1['LastName']; ?></td>
  </tr>
  <tr>
    <td>Date_Birth</td>
    <td><?php echo $row_DetailRS1['Date_Birth']; ?></td>
  </tr>
  <tr>
    <td>Place_Birth</td>
    <td><?php echo $row_DetailRS1['Place_Birth']; ?></td>
  </tr>
  <tr>
    <td>Age</td>
    <td><?php echo $row_DetailRS1['Age']; ?></td>
  </tr>
  <tr>
    <td>Sex</td>
    <td><?php echo $row_DetailRS1['Sex']; ?></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><?php echo $row_DetailRS1['Email']; ?></td>
  </tr>
  <tr>
    <td>Date_Employement</td>
    <td><?php echo $row_DetailRS1['Date_Employement']; ?></td>
  </tr>
  <tr>
    <td>Department</td>
    <td><?php echo $row_DetailRS1['Department']; ?></td>
  </tr>
  <tr>
    <td>Position</td>
    <td><?php echo $row_DetailRS1['Position']; ?></td>
  </tr>
  <tr>
    <td>Educational_Status</td>
    <td><?php echo $row_DetailRS1['Educational_Status']; ?></td>
  </tr>
  <tr>
    <td>Salary</td>
    <td><?php echo $row_DetailRS1['Salary']; ?></td>
  </tr>
  <tr>
    <td>Martial_Status</td>
    <td><?php echo $row_DetailRS1['Martial_Status']; ?></td>
  </tr>
  <tr>
    <td>Children_number</td>
    <td><?php echo $row_DetailRS1['Children_number']; ?></td>
  </tr>
  <tr>
    <td>Name_Child</td>
    <td><?php echo $row_DetailRS1['Name_Child']; ?></td>
  </tr>
  <tr>
    <td>Age_Child</td>
    <td><?php echo $row_DetailRS1['Age_Child']; ?></td>
  </tr>
  <tr>
    <td>Sex_Child</td>
    <td><?php echo $row_DetailRS1['Sex_Child']; ?></td>
  </tr>
  <tr>
    <td>Photo</td>
    <td><?php echo $row_DetailRS1['Photo']; ?></td>
  </tr>
  <tr>
    <td>Image</td>
    <td><?php echo $row_DetailRS1['Image']; ?></td>
  </tr>
  <tr>
    <td>Experience</td>
    <td><?php echo $row_DetailRS1['Experience']; ?></td>
  </tr>
  <tr>
    <td>HardCopy_Shelf_No</td>
    <td><?php echo $row_DetailRS1['HardCopy_Shelf_No']; ?></td>
  </tr>
  <tr>
    <td>ModifiedBy</td>
    <td><?php echo $row_DetailRS1['ModifiedBy']; ?></td>
  </tr>
</table>
</div>
</body>
</html><?php
mysql_free_result($DetailRS1);
?>