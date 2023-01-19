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

$maxRows_RSSickLeaveUpdate = 5;
$pageNum_RSSickLeaveUpdate = 0;
if (isset($_GET['pageNum_RSSickLeaveUpdate'])) {
  $pageNum_RSSickLeaveUpdate = $_GET['pageNum_RSSickLeaveUpdate'];
}
$startRow_RSSickLeaveUpdate = $pageNum_RSSickLeaveUpdate * $maxRows_RSSickLeaveUpdate;

mysql_select_db($database_HRMS, $HRMS);
$query_RSSickLeaveUpdate = "SELECT * FROM sick_leave";
$query_limit_RSSickLeaveUpdate = sprintf("%s LIMIT %d, %d", $query_RSSickLeaveUpdate, $startRow_RSSickLeaveUpdate, $maxRows_RSSickLeaveUpdate);
$RSSickLeaveUpdate = mysql_query($query_limit_RSSickLeaveUpdate, $HRMS) or die(mysql_error());
$row_RSSickLeaveUpdate = mysql_fetch_assoc($RSSickLeaveUpdate);

if (isset($_GET['totalRows_RSSickLeaveUpdate'])) {
  $totalRows_RSSickLeaveUpdate = $_GET['totalRows_RSSickLeaveUpdate'];
} else {
  $all_RSSickLeaveUpdate = mysql_query($query_RSSickLeaveUpdate);
  $totalRows_RSSickLeaveUpdate = mysql_num_rows($all_RSSickLeaveUpdate);
}
$totalPages_RSSickLeaveUpdate = ceil($totalRows_RSSickLeaveUpdate/$maxRows_RSSickLeaveUpdate)-1;

$queryString_RSSickLeaveUpdate = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RSSickLeaveUpdate") == false && 
        stristr($param, "totalRows_RSSickLeaveUpdate") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RSSickLeaveUpdate = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RSSickLeaveUpdate = sprintf("&totalRows_RSSickLeaveUpdate=%d%s", $totalRows_RSSickLeaveUpdate, $queryString_RSSickLeaveUpdate);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<font color="#FF6600" size="+2" > <p align="center">Sick Leave Data Display</p></font>
<table  cellpadding="0" align="center" border="1" bordercolor="#FF6600">
  <tr>
    <td>Auto_ID</td>
    <td>ID</td>
    <td>FirstName</td>
    <td>MiddelName</td>
    <td>LastName</td>
    <td>SickLeaveDays</td>
    <td>SickLeave_Taken_Date</td>
    <td>ReportOn</td>
    <td>LeaveType</td>
    <td>Reported</td>
    <td>Report_Back_Date</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><a  target="_blank" href="SickLeaveUpdate.php?Auto_ID=<?php echo $row_RSSickLeaveUpdate['Auto_ID']; ?>"  ><?php echo "<p>Update</p> </a>";?></a>
      
     <a  href="javascript: if (confirm('Are You Sure You want to Delete the Sick Leave record?')) { window.location.href='SickLeaveDelete.php?Auto_ID=<?php echo $row_RSSickLeaveUpdate['Auto_ID']; ?>' } else { void('') }; "
         ><?php echo "Delete </a>";?></a> <br /></td>
         
      <td><?php echo $row_RSSickLeaveUpdate['ID']; ?></td>
      <td><?php echo $row_RSSickLeaveUpdate['FirstName']; ?></td>
      <td><?php echo $row_RSSickLeaveUpdate['MiddelName']; ?></td>
      <td><?php echo $row_RSSickLeaveUpdate['LastName']; ?></td>
      <td><?php echo $row_RSSickLeaveUpdate['SickLeaveDays']; ?></td>
      <td><?php echo $row_RSSickLeaveUpdate['SickLeave_Taken_Date']; ?></td>
      <td><?php echo $row_RSSickLeaveUpdate['ReportOn']; ?></td>
      <td><?php echo $row_RSSickLeaveUpdate['LeaveType']; ?></td>
      <td><?php echo $row_RSSickLeaveUpdate['Reported']; ?></td>
      <td><?php echo $row_RSSickLeaveUpdate['Report_Back_Date']; ?></td>
    </tr>
    <?php } while ($row_RSSickLeaveUpdate = mysql_fetch_assoc($RSSickLeaveUpdate)); ?>
</table>
<p></p>
<table width="355" border="0" align="center">
  <tr>
    <td><?php if ($pageNum_RSSickLeaveUpdate > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_RSSickLeaveUpdate=%d%s", $currentPage, 0, $queryString_RSSickLeaveUpdate); ?>"><img src="First.gif" /></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_RSSickLeaveUpdate > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_RSSickLeaveUpdate=%d%s", $currentPage, max(0, $pageNum_RSSickLeaveUpdate - 1), $queryString_RSSickLeaveUpdate); ?>"><img src="Previous.gif" /></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_RSSickLeaveUpdate < $totalPages_RSSickLeaveUpdate) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_RSSickLeaveUpdate=%d%s", $currentPage, min($totalPages_RSSickLeaveUpdate, $pageNum_RSSickLeaveUpdate + 1), $queryString_RSSickLeaveUpdate); ?>"><img src="Next.gif" /></a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_RSSickLeaveUpdate < $totalPages_RSSickLeaveUpdate) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_RSSickLeaveUpdate=%d%s", $currentPage, $totalPages_RSSickLeaveUpdate, $queryString_RSSickLeaveUpdate); ?>"><img src="Last.gif" /></a>
        <?php } // Show if not last page ?></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($RSSickLeaveUpdate);
?>
