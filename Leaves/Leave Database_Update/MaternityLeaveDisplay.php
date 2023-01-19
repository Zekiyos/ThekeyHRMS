<?php require_once('../../Connections/HRMS.php'); ?>
<?php 
include('../../Classes/Class_AccessLevel.php');
 $obj_AccessLevel = new AccessLevel();
echo $obj_AccessLevel->CHK_AccessLevel(); 
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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RSMaternityLeaveDisplay = 5;
$pageNum_RSMaternityLeaveDisplay = 0;
if (isset($_GET['pageNum_RSMaternityLeaveDisplay'])) {
  $pageNum_RSMaternityLeaveDisplay = $_GET['pageNum_RSMaternityLeaveDisplay'];
}
$startRow_RSMaternityLeaveDisplay = $pageNum_RSMaternityLeaveDisplay * $maxRows_RSMaternityLeaveDisplay;

mysql_select_db($database_HRMS, $HRMS);
if(isset($_GET['ID']))
$query_RSMaternityLeaveDisplay = "SELECT * FROM maternity_leave WHERE ID='".$_GET['ID']."'";
else
$query_RSMaternityLeaveDisplay = "SELECT * FROM maternity_leave";

$query_limit_RSMaternityLeaveDisplay = sprintf("%s LIMIT %d, %d", $query_RSMaternityLeaveDisplay, $startRow_RSMaternityLeaveDisplay, $maxRows_RSMaternityLeaveDisplay);
$RSMaternityLeaveDisplay = mysql_query($query_limit_RSMaternityLeaveDisplay, $HRMS) or die(mysql_error());
$row_RSMaternityLeaveDisplay = mysql_fetch_assoc($RSMaternityLeaveDisplay);

if (isset($_GET['totalRows_RSMaternityLeaveDisplay'])) {
  $totalRows_RSMaternityLeaveDisplay = $_GET['totalRows_RSMaternityLeaveDisplay'];
} else {
  $all_RSMaternityLeaveDisplay = mysql_query($query_RSMaternityLeaveDisplay);
  $totalRows_RSMaternityLeaveDisplay = mysql_num_rows($all_RSMaternityLeaveDisplay);
}
$totalPages_RSMaternityLeaveDisplay = ceil($totalRows_RSMaternityLeaveDisplay/$maxRows_RSMaternityLeaveDisplay)-1;

$queryString_RSMaternityLeaveDisplay = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RSMaternityLeaveDisplay") == false && 
        stristr($param, "totalRows_RSMaternityLeaveDisplay") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RSMaternityLeaveDisplay = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RSMaternityLeaveDisplay = sprintf("&totalRows_RSMaternityLeaveDisplay=%d%s", $totalRows_RSMaternityLeaveDisplay, $queryString_RSMaternityLeaveDisplay);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<font color="#FF6600" size="+2" > <p align="center">Maternity Leave Data Display</p></font>
<?php
$_GET['TableName']="maternity_leave";

$_GET['OpenPage']="MaternityLeaveDisplay";

 include("../../Search Name/SearchName.php");?>
<table  cellpadding="0" align="center" border="1" bordercolor="#FF6600">
  <tr>
    <td>Auto_ID</td>
    <td>ID</td>
    <td>FirstName</td>
    <td>MiddelName</td>
    <td>LastName</td>
    <td>MaternityLeaveDays</td>
    <td>MaternityLeave_Taken_Date</td>
    <td>ReportOn</td>
    <td>LeaveType</td>
    <td>Reported</td>
    <td>Report_Back_Date</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><a  target="_blank" href="MaternityLeaveUpdate.php?Auto_ID=<?php echo $row_RSMaternityLeaveDisplay['Auto_ID']; ?>"  ><?php echo "<p>Update</p> </a>";?></a>
      
     <a  href="javascript: if (confirm('Are You Sure You want to Delete the Annual Leave record?')) { window.location.href='MaternityLeaveDelete.php?Auto_ID=<?php echo $row_RSMaternityLeaveDisplay['Auto_ID']; ?>' } else { void('') }; "
         ><?php echo "Delete </a>";?></a> <br /></td>
         
      <td><?php echo $row_RSMaternityLeaveDisplay['ID']; ?></td>
      <td><?php echo $row_RSMaternityLeaveDisplay['FirstName']; ?></td>
      <td><?php echo $row_RSMaternityLeaveDisplay['MiddelName']; ?></td>
      <td><?php echo $row_RSMaternityLeaveDisplay['LastName']; ?></td>
      <td><?php echo $row_RSMaternityLeaveDisplay['MaternityLeaveDays']; ?></td>
      <td><?php echo $row_RSMaternityLeaveDisplay['MaternityLeave_Taken_Date']; ?></td>
      <td><?php echo $row_RSMaternityLeaveDisplay['ReportOn']; ?></td>
      <td><?php echo $row_RSMaternityLeaveDisplay['LeaveType']; ?></td>
      <td><?php echo $row_RSMaternityLeaveDisplay['Reported']; ?></td>
      <td><?php echo $row_RSMaternityLeaveDisplay['Report_Back_Date']; ?></td>
    </tr>
    <?php } while ($row_RSMaternityLeaveDisplay = mysql_fetch_assoc($RSMaternityLeaveDisplay)); ?>
</table>
<p></p>
<table width="305" height="55" border="0" align="center">
  <tr>
    <td><?php if ($pageNum_RSMaternityLeaveDisplay > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_RSMaternityLeaveDisplay=%d%s", $currentPage, 0, $queryString_RSMaternityLeaveDisplay); ?>"><img src="../../images/First.gif" /></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_RSMaternityLeaveDisplay > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_RSMaternityLeaveDisplay=%d%s", $currentPage, max(0, $pageNum_RSMaternityLeaveDisplay - 1), $queryString_RSMaternityLeaveDisplay); ?>"><img src="../../images/Previous.gif" /></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_RSMaternityLeaveDisplay < $totalPages_RSMaternityLeaveDisplay) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_RSMaternityLeaveDisplay=%d%s", $currentPage, min($totalPages_RSMaternityLeaveDisplay, $pageNum_RSMaternityLeaveDisplay + 1), $queryString_RSMaternityLeaveDisplay); ?>"><img src="../../images/Next.gif" /></a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_RSMaternityLeaveDisplay < $totalPages_RSMaternityLeaveDisplay) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_RSMaternityLeaveDisplay=%d%s", $currentPage, $totalPages_RSMaternityLeaveDisplay, $queryString_RSMaternityLeaveDisplay); ?>"><img src="../../images/Last.gif" /></a>
    <?php } // Show if not last page ?></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($RSMaternityLeaveDisplay);
?>
