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

$maxRows_RSPromotionDisplay = 10;
$pageNum_RSPromotionDisplay = 0;
if (isset($_GET['pageNum_RSPromotionDisplay'])) {
  $pageNum_RSPromotionDisplay = $_GET['pageNum_RSPromotionDisplay'];
}
$startRow_RSPromotionDisplay = $pageNum_RSPromotionDisplay * $maxRows_RSPromotionDisplay;

mysql_select_db($database_HRMS, $HRMS);
$query_RSPromotionDisplay = "SELECT * FROM employee_promotion";
$query_limit_RSPromotionDisplay = sprintf("%s LIMIT %d, %d", $query_RSPromotionDisplay, $startRow_RSPromotionDisplay, $maxRows_RSPromotionDisplay);
$RSPromotionDisplay = mysql_query($query_limit_RSPromotionDisplay, $HRMS) or die(mysql_error());
$row_RSPromotionDisplay = mysql_fetch_assoc($RSPromotionDisplay);

if (isset($_GET['totalRows_RSPromotionDisplay'])) {
  $totalRows_RSPromotionDisplay = $_GET['totalRows_RSPromotionDisplay'];
} else {
  $all_RSPromotionDisplay = mysql_query($query_RSPromotionDisplay);
  $totalRows_RSPromotionDisplay = mysql_num_rows($all_RSPromotionDisplay);
}
$totalPages_RSPromotionDisplay = ceil($totalRows_RSPromotionDisplay/$maxRows_RSPromotionDisplay)-1;

$queryString_RSPromotionDisplay = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RSPromotionDisplay") == false && 
        stristr($param, "totalRows_RSPromotionDisplay") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RSPromotionDisplay = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RSPromotionDisplay = sprintf("&totalRows_RSPromotionDisplay=%d%s", $totalRows_RSPromotionDisplay, $queryString_RSPromotionDisplay);

$maxRows_RSPromotionDisplay = 5;
$pageNum_RSPromotionDisplay = 0;
if (isset($_GET['pageNum_RSPromotionDisplay'])) {
  $pageNum_RSPromotionDisplay = $_GET['pageNum_RSPromotionDisplay'];
}
$startRow_RSPromotionDisplay = $pageNum_RSPromotionDisplay * $maxRows_RSPromotionDisplay;

mysql_select_db($database_HRMS, $HRMS);

if(isset($_GET['ID']))
$query_RSPromotionDisplay = "SELECT * FROM employee_promotion WHERE ID='".$_GET['ID']."'";
else
$query_RSPromotionDisplay = "SELECT * FROM employee_promotion";

$query_limit_RSPromotionDisplay = sprintf("%s LIMIT %d, %d", $query_RSPromotionDisplay, $startRow_RSPromotionDisplay, $maxRows_RSPromotionDisplay);
$RSPromotionDisplay = mysql_query($query_limit_RSPromotionDisplay, $HRMS) or die(mysql_error());
$row_RSPromotionDisplay = mysql_fetch_assoc($RSPromotionDisplay);

if (isset($_GET['totalRows_RSPromotionDisplay'])) {
  $totalRows_RSPromotionDisplay = $_GET['totalRows_RSPromotionDisplay'];
} else {
  $all_RSPromotionDisplay = mysql_query($query_RSPromotionDisplay);
  $totalRows_RSPromotionDisplay = mysql_num_rows($all_RSPromotionDisplay);
}
$totalPages_RSPromotionDisplay = ceil($totalRows_RSPromotionDisplay/$maxRows_RSPromotionDisplay)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Promotion Data Display</title>
</head>

<body>
<font color="#FF6600" size="+1" > <p align="center">Promotion Data Display</p>
<p align="center">&nbsp;</p>
</font>
<?php
$_GET['TableName']="employee_promotion";

$_GET['OpenPage']="promotiondisplay";

 include("../../Search Name/SearchName.php");?>
<table  cellpadding="0" align="center" border="1" bordercolor="#FF6600"> 
  <tr>
    <td>Operation</td>
    <td>ID</td>
    <td>FirstName</td>
    <td>MiddelName</td>
    <td>LastName</td>
    <td>Evaluation_Result</td>
    <td>Position_Before_Promotion</td>
    <td>Position_After_Promotion</td>
    <td>Department_Before_Promotion</td>
    <td>Department_After_Promotion</td>
    <td>Salary_Before_Promotion</td>
    <td>Salary_After_Promotion</td>
    <td>Promotion_Date</td>
  </tr>
  <?php do { ?>
    <tr>
      <td>      
     <a  href="javascript: if (confirm('Are You Sure You want to Delete the Promotion data record?')) { window.location.href='PromotionDelete.php?Auto_ID=<?php echo $row_RSPromotionDisplay['Auto_ID']; ?>' } else { void('') }; "
         ><?php echo "Delete </a>";?></a> <br /></td>
      <td><?php echo $row_RSPromotionDisplay['ID']; ?></td>
      <td><?php echo $row_RSPromotionDisplay['FirstName']; ?></td>
      <td><?php echo $row_RSPromotionDisplay['MiddelName']; ?></td>
      <td><?php echo $row_RSPromotionDisplay['LastName']; ?></td>
      <td><?php echo $row_RSPromotionDisplay['Evaluation_Result']; ?></td>
      <td><?php echo $row_RSPromotionDisplay['Position_Before_Promotion']; ?></td>
      <td><?php echo $row_RSPromotionDisplay['Position_After_Promotion']; ?></td>
      <td><?php echo $row_RSPromotionDisplay['Department_Before_Promotion']; ?></td>
      <td><?php echo $row_RSPromotionDisplay['Department_After_Promotion']; ?></td>
      <td><?php echo $row_RSPromotionDisplay['Salary_Before_Promotion']; ?></td>
      <td><?php echo $row_RSPromotionDisplay['Salary_After_Promotion']; ?></td>
      <td><?php echo $row_RSPromotionDisplay['Promotion_Date']; ?></td>
    </tr>
    <?php } while ($row_RSPromotionDisplay = mysql_fetch_assoc($RSPromotionDisplay)); ?>
</table>
<p>&nbsp;
<table width="325" border="0" align="center">
  <tr>
    <td><?php if ($pageNum_RSPromotionDisplay > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_RSPromotionDisplay=%d%s", $currentPage, 0, $queryString_RSPromotionDisplay); ?>"><img src="First.gif" /></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_RSPromotionDisplay > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_RSPromotionDisplay=%d%s", $currentPage, max(0, $pageNum_RSPromotionDisplay - 1), $queryString_RSPromotionDisplay); ?>"><img src="Previous.gif" /></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_RSPromotionDisplay < $totalPages_RSPromotionDisplay) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_RSPromotionDisplay=%d%s", $currentPage, min($totalPages_RSPromotionDisplay, $pageNum_RSPromotionDisplay + 1), $queryString_RSPromotionDisplay); ?>"><img src="Next.gif" /></a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_RSPromotionDisplay < $totalPages_RSPromotionDisplay) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_RSPromotionDisplay=%d%s", $currentPage, $totalPages_RSPromotionDisplay, $queryString_RSPromotionDisplay); ?>"><img src="Last.gif" /></a>
        <?php } // Show if not last page ?></td>
  </tr>
</table>
</p>
</body>
</html>
<?php
mysql_free_result($RSPromotionDisplay);
?>
