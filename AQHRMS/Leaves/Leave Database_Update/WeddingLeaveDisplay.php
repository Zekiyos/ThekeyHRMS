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

$maxRows_RSWeddingLeaveDisplay = 10;
$pageNum_RSWeddingLeaveDisplay = 0;
if (isset($_GET['pageNum_RSWeddingLeaveDisplay'])) {
  $pageNum_RSWeddingLeaveDisplay = $_GET['pageNum_RSWeddingLeaveDisplay'];
}
$startRow_RSWeddingLeaveDisplay = $pageNum_RSWeddingLeaveDisplay * $maxRows_RSWeddingLeaveDisplay;

mysql_select_db($database_HRMS, $HRMS);

if(isset($_GET['ID']))
$query_RSWeddingLeaveDisplay = "SELECT * FROM wedding_leave WHERE ID='".$_GET['ID']."'";
else
$query_RSWeddingLeaveDisplay = "SELECT * FROM wedding_leave";

$query_limit_RSWeddingLeaveDisplay = sprintf("%s LIMIT %d, %d", $query_RSWeddingLeaveDisplay, $startRow_RSWeddingLeaveDisplay, $maxRows_RSWeddingLeaveDisplay);
$RSWeddingLeaveDisplay = mysql_query($query_limit_RSWeddingLeaveDisplay, $HRMS) or die(mysql_error());
$row_RSWeddingLeaveDisplay = mysql_fetch_assoc($RSWeddingLeaveDisplay);

if (isset($_GET['totalRows_RSWeddingLeaveDisplay'])) {
  $totalRows_RSWeddingLeaveDisplay = $_GET['totalRows_RSWeddingLeaveDisplay'];
} else {
  $all_RSWeddingLeaveDisplay = mysql_query($query_RSWeddingLeaveDisplay);
  $totalRows_RSWeddingLeaveDisplay = mysql_num_rows($all_RSWeddingLeaveDisplay);
}
$totalPages_RSWeddingLeaveDisplay = ceil($totalRows_RSWeddingLeaveDisplay/$maxRows_RSWeddingLeaveDisplay)-1;

$queryString_RSWeddingLeaveDisplay = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RSWeddingLeaveDisplay") == false && 
        stristr($param, "totalRows_RSWeddingLeaveDisplay") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RSWeddingLeaveDisplay = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RSWeddingLeaveDisplay = sprintf("&totalRows_RSWeddingLeaveDisplay=%d%s", $totalRows_RSWeddingLeaveDisplay, $queryString_RSWeddingLeaveDisplay);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<font color="#FF6600" size="+2" > <p align="center">Wedding Leave Data Display</p></font>
<?php
$_GET['TableName']="wedding_leave";

$_GET['OpenPage']="weddingLeaveDisplay";

 include("../../Search Name/SearchName.php");?>
<table  cellpadding="0" align="center" border="1" bordercolor="#FF6600">
  <tr>
    <td>Operation</td>
    <td>ID</td>
    <td>FirstName</td>
    <td>MiddelName</td>
    <td>LastName</td>
    <td>Department</td>
    <td>WeddingLeavedays</td>
    <td>RestDay</td>
    <td>WeddingLeave_TakenDate</td>
    <td>ReportOn</td>
    <td>LeaveType</td>
    <td>Reported</td>
    <td>Report_Back_Date</td>
  </tr>
  <?php do { ?>
    <tr>
       <td><a  target="_blank" href="WeddingLeaveUpdate.php?Auto_ID=<?php echo $row_RSWeddingLeaveDisplay['Auto_ID']; ?>"  ><?php echo "<p>Update</p> </a>";?></a>
      
     <a  href="javascript: if (confirm('Are You Sure You want to Delete the Sick Leave record?')) { window.location.href='WeddingLeaveDelete.php?Auto_ID=<?php echo $row_RSWeddingLeaveDisplay['Auto_ID']; ?>' } else { void('') }; "
         ><?php echo "Delete </a>";?></a> <br /></td>
      <td><?php echo $row_RSWeddingLeaveDisplay['ID']; ?></td>
      <td><?php echo $row_RSWeddingLeaveDisplay['FirstName']; ?></td>
      <td><?php echo $row_RSWeddingLeaveDisplay['MiddelName']; ?></td>
      <td><?php echo $row_RSWeddingLeaveDisplay['LastName']; ?></td>
      <td><?php echo $row_RSWeddingLeaveDisplay['Department']; ?></td>
      <td><?php echo $row_RSWeddingLeaveDisplay['WeddingLeavedays']; ?></td>
      <td><?php echo $row_RSWeddingLeaveDisplay['RestDay']; ?></td>
      <td><?php echo $row_RSWeddingLeaveDisplay['WeddingLeave_TakenDate']; ?></td>
      <td><?php echo $row_RSWeddingLeaveDisplay['ReportOn']; ?></td>
      <td><?php echo $row_RSWeddingLeaveDisplay['LeaveType']; ?></td>
      <td><?php echo $row_RSWeddingLeaveDisplay['Reported']; ?></td>
      <td><?php echo $row_RSWeddingLeaveDisplay['Report_Back_Date']; ?></td>
    </tr>
    <?php } while ($row_RSWeddingLeaveDisplay = mysql_fetch_assoc($RSWeddingLeaveDisplay)); ?>
</table>
<table width="252" height="49" border="0" align="center">
  <tr>
    <td><?php if ($pageNum_RSWeddingLeaveDisplay > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_RSWeddingLeaveDisplay=%d%s", $currentPage, 0, $queryString_RSWeddingLeaveDisplay); ?>"><img src="First.gif" /></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_RSWeddingLeaveDisplay > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_RSWeddingLeaveDisplay=%d%s", $currentPage, max(0, $pageNum_RSWeddingLeaveDisplay - 1), $queryString_RSWeddingLeaveDisplay); ?>"><img src="Previous.gif" /></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_RSWeddingLeaveDisplay < $totalPages_RSWeddingLeaveDisplay) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_RSWeddingLeaveDisplay=%d%s", $currentPage, min($totalPages_RSWeddingLeaveDisplay, $pageNum_RSWeddingLeaveDisplay + 1), $queryString_RSWeddingLeaveDisplay); ?>"><img src="Next.gif" /></a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_RSWeddingLeaveDisplay < $totalPages_RSWeddingLeaveDisplay) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_RSWeddingLeaveDisplay=%d%s", $currentPage, $totalPages_RSWeddingLeaveDisplay, $queryString_RSWeddingLeaveDisplay); ?>"><img src="Last.gif" /></a>
        <?php } // Show if not last page ?></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($RSWeddingLeaveDisplay);
?>
