<?php require_once('../../../Connections/HRMS.php'); ?>
<?php 
include('../../../Classes/Class_AccessLevel.php');
 $obj_AccessLevel = new AccessLevel();
echo $obj_AccessLevel->CHK_AccessLevel(); 
?>

<?php


$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RSSpecialLeaveDisplay = 5;
$pageNum_RSSpecialLeaveDisplay = 0;
if (isset($_GET['pageNum_RSSpecialLeaveDisplay'])) {
  $pageNum_RSSpecialLeaveDisplay = $_GET['pageNum_RSSpecialLeaveDisplay'];
}
$startRow_RSSpecialLeaveDisplay = $pageNum_RSSpecialLeaveDisplay * $maxRows_RSSpecialLeaveDisplay;

mysql_select_db($database_HRMS, $HRMS);

if(isset($_GET['ID']))
$query_RSSpecialLeaveDisplay = "SELECT * FROM special_leave WHERE ID='".$_GET['ID']."'";
else
$query_RSSpecialLeaveDisplay = "SELECT * FROM special_leave";

$query_limit_RSSpecialLeaveDisplay = sprintf("%s LIMIT %d, %d", $query_RSSpecialLeaveDisplay, $startRow_RSSpecialLeaveDisplay, $maxRows_RSSpecialLeaveDisplay);
$RSSpecialLeaveDisplay = mysql_query($query_limit_RSSpecialLeaveDisplay, $HRMS) or die(mysql_error());
$row_RSSpecialLeaveDisplay = mysql_fetch_assoc($RSSpecialLeaveDisplay);

if (isset($_GET['totalRows_RSSpecialLeaveDisplay'])) {
  $totalRows_RSSpecialLeaveDisplay = $_GET['totalRows_RSSpecialLeaveDisplay'];
} else {
  $all_RSSpecialLeaveDisplay = mysql_query($query_RSSpecialLeaveDisplay);
  $totalRows_RSSpecialLeaveDisplay = mysql_num_rows($all_RSSpecialLeaveDisplay);
}
$totalPages_RSSpecialLeaveDisplay = ceil($totalRows_RSSpecialLeaveDisplay/$maxRows_RSSpecialLeaveDisplay)-1;

$queryString_RSSpecialLeaveDisplay = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RSSpecialLeaveDisplay") == false && 
        stristr($param, "totalRows_RSSpecialLeaveDisplay") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RSSpecialLeaveDisplay = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RSSpecialLeaveDisplay = sprintf("&totalRows_RSSpecialLeaveDisplay=%d%s", $totalRows_RSSpecialLeaveDisplay, $queryString_RSSpecialLeaveDisplay);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Special Leave Display</title>
</head>

<body>
<font color="#FF6600" size="+2" > <p align="center">Special Leave Data Display</p></font>
<?php
$_GET['TableName']="special_leave";

$_GET['OpenPage']="SpecialLeaveDisplay";

 include("../../../Search_Name/SearchName.php");?>
<table  cellpadding="0" align="center" border="1" bordercolor="#FF6600">
  <tr>
    <td>Operation</td>
    <td>ID</td>
    <td>FirstName</td>
    <td>MiddelName</td>
    <td>LastName</td>
    <td>Department</td>
    <td>SpecialLeaveDays</td>
    <td>SpecialLeave_Taken_Date</td>
    <td>ReportOn</td>
    <td>LeaveType</td>
    <td>Reported</td>
    <td>Report_Back_Date</td>
  </tr>
  <?php do { ?>
    <tr>
      <td>      
     <a  href="javascript: if (confirm('Are You Sure You want to Delete the Special Leave record?')) { window.location.href='SpecialLeaveDelete.php?Auto_ID=<?php echo $row_RSSpecialLeaveDisplay['Auto_ID']; ?>' } else { void('') }; "
         ><?php echo "Delete </a>";?></a> <br /></td>
      <td><?php echo $row_RSSpecialLeaveDisplay['ID']; ?></td>
      <td><?php echo $row_RSSpecialLeaveDisplay['FirstName']; ?></td>
      <td><?php echo $row_RSSpecialLeaveDisplay['MiddelName']; ?></td>
      <td><?php echo $row_RSSpecialLeaveDisplay['LastName']; ?></td>
      <td><?php echo $row_RSSpecialLeaveDisplay['Department']; ?></td>
      <td><?php echo $row_RSSpecialLeaveDisplay['SpecialLeaveDays']; ?></td>
      <td><?php echo $row_RSSpecialLeaveDisplay['SpecialLeave_Taken_Date']; ?></td>
      <td><?php echo $row_RSSpecialLeaveDisplay['ReportOn']; ?></td>
      <td><?php echo $row_RSSpecialLeaveDisplay['LeaveType']; ?></td>
      <td><?php echo $row_RSSpecialLeaveDisplay['Reported']; ?></td>
      <td><?php echo $row_RSSpecialLeaveDisplay['Report_Back_Date']; ?></td>
    </tr>
    <?php } while ($row_RSSpecialLeaveDisplay = mysql_fetch_assoc($RSSpecialLeaveDisplay)); ?>
</table>
<table width="282" height="53" border="0" align="center">
  <tr>
    <td><?php if ($pageNum_RSSpecialLeaveDisplay > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_RSSpecialLeaveDisplay=%d%s", $currentPage, 0, $queryString_RSSpecialLeaveDisplay); ?>"><img src="../../../Img/First.gif" /></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_RSSpecialLeaveDisplay > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_RSSpecialLeaveDisplay=%d%s", $currentPage, max(0, $pageNum_RSSpecialLeaveDisplay - 1), $queryString_RSSpecialLeaveDisplay); ?>"><img src="../../../Img/Previous.gif" /></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_RSSpecialLeaveDisplay < $totalPages_RSSpecialLeaveDisplay) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_RSSpecialLeaveDisplay=%d%s", $currentPage, min($totalPages_RSSpecialLeaveDisplay, $pageNum_RSSpecialLeaveDisplay + 1), $queryString_RSSpecialLeaveDisplay); ?>"><img src="../../../Img/Next.gif" /></a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_RSSpecialLeaveDisplay < $totalPages_RSSpecialLeaveDisplay) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_RSSpecialLeaveDisplay=%d%s", $currentPage, $totalPages_RSSpecialLeaveDisplay, $queryString_RSSpecialLeaveDisplay); ?>"><img src="../../../Img/Last.gif" /></a>
        <?php } // Show if not last page ?></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($RSSpecialLeaveDisplay);
?>
