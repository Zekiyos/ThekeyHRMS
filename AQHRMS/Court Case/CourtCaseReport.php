

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

$maxRows_RSCourtCaseReport = 10;
$pageNum_RSCourtCaseReport = 0;
if (isset($_GET['pageNum_RSCourtCaseReport'])) {
  $pageNum_RSCourtCaseReport = $_GET['pageNum_RSCourtCaseReport'];
}
$startRow_RSCourtCaseReport = $pageNum_RSCourtCaseReport * $maxRows_RSCourtCaseReport;

mysql_select_db($database_HRMS, $HRMS);

 if (isset($_POST['FromDate']))
$query_RSCourtCaseReport = "SELECT * FROM court_case where FileDate >= '".$_POST['FromDate']."' and FileDate <= '".$_POST['ToDate']."' ";
else
$query_RSCourtCaseReport = "SELECT * FROM court_case";
$query_limit_RSCourtCaseReport = sprintf("%s LIMIT %d, %d", $query_RSCourtCaseReport, $startRow_RSCourtCaseReport, $maxRows_RSCourtCaseReport);
$RSCourtCaseReport = mysql_query($query_limit_RSCourtCaseReport, $HRMS) or die(mysql_error());
$row_RSCourtCaseReport = mysql_fetch_assoc($RSCourtCaseReport);

if (isset($_GET['totalRows_RSCourtCaseReport'])) {
  $totalRows_RSCourtCaseReport = $_GET['totalRows_RSCourtCaseReport'];
} else {
  $all_RSCourtCaseReport = mysql_query($query_RSCourtCaseReport);
  $totalRows_RSCourtCaseReport = mysql_num_rows($all_RSCourtCaseReport);
}
$totalPages_RSCourtCaseReport = ceil($totalRows_RSCourtCaseReport/$maxRows_RSCourtCaseReport)-1;
?>
<script type="text/javascript">
function PrintContent()
    {
		
        var DocumentContainer = document.getElementById('courtcasereport');
        var WindowObject = window.open('', "TrackHistoryData", 
                              "width=740,height=325,top=200,left=250,toolbars=no,scrollbars=yes,status=no,resizable=no");
        WindowObject.document.writeln(DocumentContainer.innerHTML);
        WindowObject.document.close();
        WindowObject.focus();
        WindowObject.print();
        WindowObject.close();
    }
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?php require_once('CourtCaseReportDateSelection.php'); ?>
<?php
echo "<input type=button  value=\"Print Out\" onclick=\"PrintContent()\" align=\"right\" >";	?>

<div id="courtcasereport" align="center">
<img src="../Database_Update/Personal Record Database_Update/Sherlogo.JPG" height="109" width="1050" />
<font color=\"#000066\"  size="+2" > <p align="center">Court Case Report <?php if (isset($_POST['FromDate']))echo "File Date From ".$_POST['FromDate']." to ".$_POST['ToDate']." "; ?> </p></font>

<table cellpadding="0" align="center" border="1" bordercolor="#FF6600">
  <tr><font size="+1">
    <td>ID</td>
    <td>FirstName</td>
    <td>MiddelName</td>
    <td>LastName</td>
    <td>FileNumber</td>
    <td>FileDate</td>
    <td>ClaimAmount</td>
    <td>AdvocateName</td>
    <td>AppointmentDate</td>
    <td>Court</td>
    <td>Decision</td>
    <td>Case_Status</td>
    </font>
  </tr>
  <?php do { ?>
    <tr>
      
      <td><?php echo "<font size=\"+1\">".$row_RSCourtCaseReport['ID']; ?></td>
      <td><?php echo "<font size=\"+1\">".$row_RSCourtCaseReport['FirstName']; ?></td>
      <td><?php echo "<font size=\"+1\">".$row_RSCourtCaseReport['MiddelName']; ?></td>
      <td><?php echo "<font size=\"+1\">".$row_RSCourtCaseReport['LastName']; ?></td>
      
      <td><?php echo "<font size=\"+1\">".$row_RSCourtCaseReport['FileNumber']; ?></td>
      <td><?php echo "<font size=\"+1\">".$row_RSCourtCaseReport['FileDate']; ?></td>
      <td><?php echo "<font size=\"+1\">"."Br.". $row_RSCourtCaseReport['ClaimAmount']; ?></td>
      <td><?php echo "<font size=\"+1\">".$row_RSCourtCaseReport['AdvocateName']; ?></td>
      <td><?php echo "<font size=\"+1\">".$row_RSCourtCaseReport['AppointmentDate']; ?></td>
      <td><?php echo "<font size=\"+1\">".$row_RSCourtCaseReport['Court']; ?></td>
      <td><?php echo "<font size=\"+1\">".$row_RSCourtCaseReport['Decision']; ?></td>
      <td><?php echo"<font size=\"+1\">". $row_RSCourtCaseReport['Case_Status']."</font>"; ?></td>
    </tr>
    <?php } while ($row_RSCourtCaseReport = mysql_fetch_assoc($RSCourtCaseReport)); ?>
</table>
</div>
<script language=javascript>
<!--
function popDemo(N) {
newWindow = window.open(N, 'popD','toolbar=no,menubar=no,resizable=no,scrollbars=no,status=no,location=no,width=370,height=220');
}
//-->
</script>
<a href="javascript:popDemo('message.htm')"></a>
</body>
</html>
<?php
mysql_free_result($RSCourtCaseReport);
?>
