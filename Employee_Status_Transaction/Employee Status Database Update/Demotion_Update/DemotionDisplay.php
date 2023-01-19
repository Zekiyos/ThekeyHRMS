<?php require_once('../../../Connections/HRMS.php'); ?>
<?php 
include('../../../Classes/Class_AccessLevel.php');
 $obj_AccessLevel = new AccessLevel();
echo $obj_AccessLevel->CHK_AccessLevel(); 
?>

<?php


$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RSDemotionDisplay = 10;
$pageNum_RSDemotionDisplay = 0;
if (isset($_GET['pageNum_RSDemotionDisplay'])) {
  $pageNum_RSDemotionDisplay = $_GET['pageNum_RSDemotionDisplay'];
}
$startRow_RSDemotionDisplay = $pageNum_RSDemotionDisplay * $maxRows_RSDemotionDisplay;

mysql_select_db($database_HRMS, $HRMS);
$query_RSDemotionDisplay = "SELECT * FROM employee_demotion";
$query_limit_RSDemotionDisplay = sprintf("%s LIMIT %d, %d", $query_RSDemotionDisplay, $startRow_RSDemotionDisplay, $maxRows_RSDemotionDisplay);
$RSDemotionDisplay = mysql_query($query_limit_RSDemotionDisplay, $HRMS) or die(mysql_error());
$row_RSDemotionDisplay = mysql_fetch_assoc($RSDemotionDisplay);

if (isset($_GET['totalRows_RSDemotionDisplay'])) {
  $totalRows_RSDemotionDisplay = $_GET['totalRows_RSDemotionDisplay'];
} else {
  $all_RSDemotionDisplay = mysql_query($query_RSDemotionDisplay);
  $totalRows_RSDemotionDisplay = mysql_num_rows($all_RSDemotionDisplay);
}
$totalPages_RSDemotionDisplay = ceil($totalRows_RSDemotionDisplay/$maxRows_RSDemotionDisplay)-1;

$queryString_RSDemotionDisplay = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RSDemotionDisplay") == false && 
        stristr($param, "totalRows_RSDemotionDisplay") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RSDemotionDisplay = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RSDemotionDisplay = sprintf("&totalRows_RSDemotionDisplay=%d%s", $totalRows_RSDemotionDisplay, $queryString_RSDemotionDisplay);

$maxRows_RSDemotionDisplay = 5;
$pageNum_RSDemotionDisplay = 0;
if (isset($_GET['pageNum_RSDemotionDisplay'])) {
  $pageNum_RSDemotionDisplay = $_GET['pageNum_RSDemotionDisplay'];
}
$startRow_RSDemotionDisplay = $pageNum_RSDemotionDisplay * $maxRows_RSDemotionDisplay;

mysql_select_db($database_HRMS, $HRMS);

if(isset($_GET['ID']))
$query_RSDemotionDisplay = "SELECT * FROM employee_demotion WHERE ID='".$_GET['ID']."'";
else
$query_RSDemotionDisplay = "SELECT * FROM employee_demotion";

$query_limit_RSDemotionDisplay = sprintf("%s LIMIT %d, %d", $query_RSDemotionDisplay, $startRow_RSDemotionDisplay, $maxRows_RSDemotionDisplay);
$RSDemotionDisplay = mysql_query($query_limit_RSDemotionDisplay, $HRMS) or die(mysql_error());
$row_RSDemotionDisplay = mysql_fetch_assoc($RSDemotionDisplay);

if (isset($_GET['totalRows_RSDemotionDisplay'])) {
  $totalRows_RSDemotionDisplay = $_GET['totalRows_RSDemotionDisplay'];
} else {
  $all_RSDemotionDisplay = mysql_query($query_RSDemotionDisplay);
  $totalRows_RSDemotionDisplay = mysql_num_rows($all_RSDemotionDisplay);
}
$totalPages_RSDemotionDisplay = ceil($totalRows_RSDemotionDisplay/$maxRows_RSDemotionDisplay)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Demotion Data Display</title>
</head>

<body>
<font color="#FF6600" size="+1" > <p align="center">Demotion Data Display</p></font>
<?php
$_GET['TableName']="employee_demotion";

$_GET['OpenPage']="demotiondisplay";

 include("../../../Search_Name/SearchName.php");?>
<table  cellpadding="0" align="center" border="1" bordercolor="#FF6600"> 
  <tr>
    <td>Operation</td>
    <td>ID</td>
    <td>FirstName</td>
    <td>MiddelName</td>
    <td>LastName</td>
    <td>Evaluation_Result</td>
    <td>Position_Before_Demotion</td>
    <td>Position_After_Demotion</td>
    <td>Department_Before_Demotion</td>
    <td>Department_After_Demotion</td>
    <td>Salary_Before_Demotion</td>
    <td>Salary_After_Demotion</td>
    <td>Demotion_Date</td>
  </tr>
  <?php do { ?>
    <tr>
      <td> <a  href="javascript: if (confirm('Are You Sure You want to Delete the Demotion data record?')) { window.location.href='DemotionDelete.php?Auto_ID=<?php echo $row_RSDemotionDisplay['Auto_ID']; ?>' } else { void('') }; "
         ><?php echo "Delete </a>";?></a> <br /></td>
      <td><?php echo $row_RSDemotionDisplay['ID']; ?></td>
      <td><?php echo $row_RSDemotionDisplay['FirstName']; ?></td>
      <td><?php echo $row_RSDemotionDisplay['MiddelName']; ?></td>
      <td><?php echo $row_RSDemotionDisplay['LastName']; ?></td>
      <td><?php echo $row_RSDemotionDisplay['Evaluation_Result']; ?></td>
      <td><?php echo $row_RSDemotionDisplay['Position_Before_Demotion']; ?></td>
      <td><?php echo $row_RSDemotionDisplay['Position_After_Demotion']; ?></td>
      <td><?php echo $row_RSDemotionDisplay['Department_Before_Demotion']; ?></td>
      <td><?php echo $row_RSDemotionDisplay['Department_After_Demotion']; ?></td>
      <td><?php echo $row_RSDemotionDisplay['Salary_Before_Demotion']; ?></td>
      <td><?php echo $row_RSDemotionDisplay['Salary_After_Demotion']; ?></td>
      <td><?php echo $row_RSDemotionDisplay['Demotion_Date']; ?></td>
    </tr>
    <?php } while ($row_RSDemotionDisplay = mysql_fetch_assoc($RSDemotionDisplay)); ?>
</table>
<p>&nbsp;
<table width="331" border="0" align="center">
  <tr>
    <td><?php if ($pageNum_RSDemotionDisplay > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_RSDemotionDisplay=%d%s", $currentPage, 0, $queryString_RSDemotionDisplay); ?>"><img src="../../../images/First.gif" /></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_RSDemotionDisplay > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_RSDemotionDisplay=%d%s", $currentPage, max(0, $pageNum_RSDemotionDisplay - 1), $queryString_RSDemotionDisplay); ?>"><img src="../../../images/Previous.gif" /></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_RSDemotionDisplay < $totalPages_RSDemotionDisplay) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_RSDemotionDisplay=%d%s", $currentPage, min($totalPages_RSDemotionDisplay, $pageNum_RSDemotionDisplay + 1), $queryString_RSDemotionDisplay); ?>"><img src="../../../images/Next.gif" /></a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_RSDemotionDisplay < $totalPages_RSDemotionDisplay) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_RSDemotionDisplay=%d%s", $currentPage, $totalPages_RSDemotionDisplay, $queryString_RSDemotionDisplay); ?>"><img src="../../../images/Last.gif" /></a>
        <?php } // Show if not last page ?></td>
  </tr>
</table>
</p>
</body>
</html>
<?php
mysql_free_result($RSDemotionDisplay);
?>
