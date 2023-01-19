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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RSAnnualLeaveCalcDisplay = 5;
$pageNum_RSAnnualLeaveCalcDisplay = 0;
if (isset($_GET['pageNum_RSAnnualLeaveCalcDisplay'])) {
  $pageNum_RSAnnualLeaveCalcDisplay = $_GET['pageNum_RSAnnualLeaveCalcDisplay'];
}
$startRow_RSAnnualLeaveCalcDisplay = $pageNum_RSAnnualLeaveCalcDisplay * $maxRows_RSAnnualLeaveCalcDisplay;

mysql_select_db($database_HRMS, $HRMS);

if(isset($_GET['ID']))
$query_RSAnnualLeaveCalcDisplay = "SELECT * FROM annual_leave_calculate WHERE ID='".$_GET['ID']."'";
else
$query_RSAnnualLeaveCalcDisplay = "SELECT * FROM annual_leave_calculate";

$query_limit_RSAnnualLeaveCalcDisplay = sprintf("%s LIMIT %d, %d", $query_RSAnnualLeaveCalcDisplay, $startRow_RSAnnualLeaveCalcDisplay, $maxRows_RSAnnualLeaveCalcDisplay);
$RSAnnualLeaveCalcDisplay = mysql_query($query_limit_RSAnnualLeaveCalcDisplay, $HRMS) or die(mysql_error());
$row_RSAnnualLeaveCalcDisplay = mysql_fetch_assoc($RSAnnualLeaveCalcDisplay);

if (isset($_GET['totalRows_RSAnnualLeaveCalcDisplay'])) {
  $totalRows_RSAnnualLeaveCalcDisplay = $_GET['totalRows_RSAnnualLeaveCalcDisplay'];
} else {
  $all_RSAnnualLeaveCalcDisplay = mysql_query($query_RSAnnualLeaveCalcDisplay);
  $totalRows_RSAnnualLeaveCalcDisplay = mysql_num_rows($all_RSAnnualLeaveCalcDisplay);
}
$totalPages_RSAnnualLeaveCalcDisplay = ceil($totalRows_RSAnnualLeaveCalcDisplay/$maxRows_RSAnnualLeaveCalcDisplay)-1;

$queryString_RSAnnualLeaveCalcDisplay = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RSAnnualLeaveCalcDisplay") == false && 
        stristr($param, "totalRows_RSAnnualLeaveCalcDisplay") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RSAnnualLeaveCalcDisplay = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RSAnnualLeaveCalcDisplay = sprintf("&totalRows_RSAnnualLeaveCalcDisplay=%d%s", $totalRows_RSAnnualLeaveCalcDisplay, $queryString_RSAnnualLeaveCalcDisplay);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<font color="#FF6600" size="+2" > <p align="center">Annual Leave Calculated Data Table</p></font>
<?php
$_GET['TableName']="annual_leave_calculate";

$_GET['OpenPage']="annualleaveCalcdisplay";

 include("../../Search Name/SearchName.php");?>
 
<table cellpadding="0" align="center" border="1" bordercolor="#FF6600">
  <tr>
    <td>Operation</td>
    <td>ID</td>
    <td>FirstName</td>
    <td>MiddelName</td>
    <td>LastName</td>
    <td>WorkingMonth</td>
    <td>WorkingYear</td>
    <td>ThisYearALdays</td>
    <td>LastYearALdays</td>
    <td>BeforeLastYearALdays</td>
    <td>TotalALdays</td>
    <td>TotalTakenDay</td>
    <td>TotalLeftDay</td>
    <td>Calculated_Date</td>
    <td>ModifiedBy</td>
    <td>BeforeLastYearLeft</td>
    <td>LastYearLeft</td>
    <td>ThisYearLeft</td>
  </tr>
  <?php do { ?>
    <tr>
    
    <td><a  target="_blank" href="AnnualLeaveCalcUpdate.php?Auto_ID=<?php echo $row_RSAnnualLeaveCalcDisplay['Auto_ID']; ?>"  ><?php echo "<p>Update</p> </a>";?></a>
    <a  href="javascript: if (confirm('Are You Sure You want to Delete the Annual Leave Calculated record?')) { window.location.href='AnnualLeaveCalcDelete.php?Auto_ID=<?php echo $row_RSAnnualLeaveCalcDisplay['Auto_ID']; ?>' } else { void('') }; "
         ><?php echo "Delete </a>";?></a> <br /><?php //echo $row_RSAnnualLeaveDsiplay['Auto_ID']; ?></td>
		 
      <td><?php echo $row_RSAnnualLeaveCalcDisplay['ID']; ?></td>
      <td><?php echo $row_RSAnnualLeaveCalcDisplay['FirstName']; ?></td>
      <td><?php echo $row_RSAnnualLeaveCalcDisplay['MiddelName']; ?></td>
      <td><?php echo $row_RSAnnualLeaveCalcDisplay['LastName']; ?></td>
      <td><?php echo $row_RSAnnualLeaveCalcDisplay['WorkingMonth']; ?></td>
      <td><?php echo $row_RSAnnualLeaveCalcDisplay['WorkingYear']; ?></td>
      <td><?php echo $row_RSAnnualLeaveCalcDisplay['ThisYearALdays']; ?></td>
      <td><?php echo $row_RSAnnualLeaveCalcDisplay['LastYearALdays']; ?></td>
      <td><?php echo $row_RSAnnualLeaveCalcDisplay['BeforeLastYearALdays']; ?></td>
      <td><?php echo $row_RSAnnualLeaveCalcDisplay['TotalALdays']; ?></td>
      <td><?php echo $row_RSAnnualLeaveCalcDisplay['TotalTakenDay']; ?></td>
      <td><?php echo $row_RSAnnualLeaveCalcDisplay['TotalLeftDay']; ?></td>
      <td><?php echo $row_RSAnnualLeaveCalcDisplay['Calculated_Date']; ?></td>
      <td><?php echo $row_RSAnnualLeaveCalcDisplay['ModifiedBy']; ?></td>
      <td><?php echo $row_RSAnnualLeaveCalcDisplay['BeforeLastYearLeft']; ?></td>
      <td><?php echo $row_RSAnnualLeaveCalcDisplay['LastYearLeft']; ?></td>
      <td><?php echo $row_RSAnnualLeaveCalcDisplay['ThisYearLeft']; ?></td>
    </tr>
    <?php } while ($row_RSAnnualLeaveCalcDisplay = mysql_fetch_assoc($RSAnnualLeaveCalcDisplay)); ?>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="315" border="0" align="center">
  <tr>
    <td><?php if ($pageNum_RSAnnualLeaveCalcDisplay > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_RSAnnualLeaveCalcDisplay=%d%s", $currentPage, 0, $queryString_RSAnnualLeaveCalcDisplay); ?>"><img src="First.gif" /></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_RSAnnualLeaveCalcDisplay > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_RSAnnualLeaveCalcDisplay=%d%s", $currentPage, max(0, $pageNum_RSAnnualLeaveCalcDisplay - 1), $queryString_RSAnnualLeaveCalcDisplay); ?>"><img src="Previous.gif" /></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_RSAnnualLeaveCalcDisplay < $totalPages_RSAnnualLeaveCalcDisplay) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_RSAnnualLeaveCalcDisplay=%d%s", $currentPage, min($totalPages_RSAnnualLeaveCalcDisplay, $pageNum_RSAnnualLeaveCalcDisplay + 1), $queryString_RSAnnualLeaveCalcDisplay); ?>"><img src="Next.gif" /></a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_RSAnnualLeaveCalcDisplay < $totalPages_RSAnnualLeaveCalcDisplay) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_RSAnnualLeaveCalcDisplay=%d%s", $currentPage, $totalPages_RSAnnualLeaveCalcDisplay, $queryString_RSAnnualLeaveCalcDisplay); ?>"><img src="Last.gif" /></a>
        <?php } // Show if not last page ?></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($RSAnnualLeaveCalcDisplay);
?>
