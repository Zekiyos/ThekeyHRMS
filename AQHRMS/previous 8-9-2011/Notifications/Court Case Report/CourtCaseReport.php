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

$query_RSCourtCaseReport = "SELECT * FROM court_case where DATEDIFF(CURDATE(),court_case.AppointmentDate) >-2 and DATEDIFF(CURDATE(),court_case.AppointmentDate) <=2";

$RSCourtCaseReport = mysql_query($query_RSCourtCaseReport, $HRMS) or die(mysql_error());
$row_RSCourtCaseReport = mysql_fetch_assoc($RSCourtCaseReport);
$totalRows_RSCourtCaseReport = mysql_num_rows($RSCourtCaseReport);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<script type="text/javascript">
function PrintContent()
    {
		 if (confirm('Are you sure you want to Print Out the Search result in current setting of paper scale?')) {
			 var DocumentContainer = document.getElementById('CourtCasereport');
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
    <font color="#FF6600" size="+2" ><p align="center">Court Case Report
      </p></font>
</blockquote>
   <blockquote><blockquote><blockquote><blockquote> <blockquote>
   <blockquote><blockquote><blockquote><blockquote> <blockquote>
   <blockquote><blockquote><blockquote><blockquote> <blockquote><blockquote><blockquote> <blockquote><blockquote><blockquote> <blockquote>
   <input type=button value="Print Out" onClick="PrintContent()" align="right" ></blockquote></blockquote></blockquote></blockquote></blockquote>
   </blockquote></blockquote></blockquote></blockquote></blockquote>
   </blockquote></blockquote></blockquote></blockquote></blockquote></blockquote></blockquote></blockquote></blockquote></blockquote></blockquote>
    <div id="CourtCasereport">
<table id="CourtCase" ellpadding="0" align="center" border="1" bordercolor="#E19319">
  <tr>
    <td>Auto_ID</td>
    <td>ID</td>
    <td>FirstName</td>
    <td>MiddelName</td>
    <td>LastName</td>
    <td>Department</td>
    <td>AppointmentDate</td>
    <td>Case_Date</td>
    <td>Court</td>
    <td>Case</td>
    <td>Result</td>
    <td>Case_Status</td>
  </tr>
  <?php do { ?>
    <tr>
      <td height="37"><?php echo $row_RSCourtCaseReport['Auto_ID']; ?></td>
      <td><?php echo $row_RSCourtCaseReport['ID']; ?></td>
      <td><?php echo $row_RSCourtCaseReport['FirstName']; ?></td>
      <td><?php echo $row_RSCourtCaseReport['MiddelName']; ?></td>
      <td><?php echo $row_RSCourtCaseReport['LastName']; ?></td>
      <td><?php echo $row_RSCourtCaseReport['Department']; ?></td>
      <td><?php echo $row_RSCourtCaseReport['AppointmentDate']; ?></td>
      <td><?php echo $row_RSCourtCaseReport['Case_Date']; ?></td>
      <td><?php echo $row_RSCourtCaseReport['Court']; ?></td>
      <td><?php echo $row_RSCourtCaseReport['Case']; ?></td>
      <td><?php echo $row_RSCourtCaseReport['Result']; ?></td>
      <td><?php echo $row_RSCourtCaseReport['Case_Status']; ?></td>
    </tr>
    <?php } while ($row_RSCourtCaseReport = mysql_fetch_assoc($RSCourtCaseReport)); ?>
</table>
</div>
</body>
</html>
<?php
mysql_free_result($RSCourtCaseReport);
?>
