<?php require_once('../../../Connections/HRMS.php'); ?>
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

$maxRows_RSTerminationDisplay = 5;
$pageNum_RSTerminationDisplay = 0;
if (isset($_GET['pageNum_RSTerminationDisplay'])) {
  $pageNum_RSTerminationDisplay = $_GET['pageNum_RSTerminationDisplay'];
}
$startRow_RSTerminationDisplay = $pageNum_RSTerminationDisplay * $maxRows_RSTerminationDisplay;

mysql_select_db($database_HRMS, $HRMS);
if(isset($_GET['ID']))
$query_RSTerminationDisplay = "SELECT * FROM terminated_employee WHERE ID='".$_GET['ID']."'";
else
$query_RSTerminationDisplay = "SELECT * FROM terminated_employee";

$query_limit_RSTerminationDisplay = sprintf("%s LIMIT %d, %d", $query_RSTerminationDisplay, $startRow_RSTerminationDisplay, $maxRows_RSTerminationDisplay);
$RSTerminationDisplay = mysql_query($query_limit_RSTerminationDisplay, $HRMS) or die(mysql_error());
$row_RSTerminationDisplay = mysql_fetch_assoc($RSTerminationDisplay);

if (isset($_GET['totalRows_RSTerminationDisplay'])) {
  $totalRows_RSTerminationDisplay = $_GET['totalRows_RSTerminationDisplay'];
} else {
  $all_RSTerminationDisplay = mysql_query($query_RSTerminationDisplay);
  $totalRows_RSTerminationDisplay = mysql_num_rows($all_RSTerminationDisplay);
}
$totalPages_RSTerminationDisplay = ceil($totalRows_RSTerminationDisplay/$maxRows_RSTerminationDisplay)-1;

$queryString_RSTerminationDisplay = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RSTerminationDisplay") == false && 
        stristr($param, "totalRows_RSTerminationDisplay") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RSTerminationDisplay = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RSTerminationDisplay = sprintf("&totalRows_RSTerminationDisplay=%d%s", $totalRows_RSTerminationDisplay, $queryString_RSTerminationDisplay);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Termination Data Display</title>
</head>

<body>
<font color="#FF6600" size="+2" > <p align="center">Terminated Employee Data Display</p></font>
<?php
$_GET['TableName']="terminated_employee";

$_GET['OpenPage']="terminationdisplay";

 include("../../../Search Name/SearchName.php");?>
<table  cellpadding="0" align="center" border="1" bordercolor="#FF6600">  <tr>
    <td>Operation</td>
    <td>ID</td>
    <td>FirstName</td>
    <td>MiddelName</td>
    <td>LastName</td>
    <td>Department</td>
    <td>Terminated_Date</td>
    <td>Termination_Reason</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><a  target="_blank" href="TerminationUpdate.php?Auto_ID=<?php echo $row_RSTerminationDisplay['Auto_ID']; ?>"  ><?php echo "<p>Update</p> </a>";?></a>
      
     <a  href="javascript: if (confirm('Are You Sure You want to Delete the Termination record?')) { window.location.href='TerminationDelete.php?Auto_ID=<?php echo $row_RSTerminationDisplay['Auto_ID']; ?>' } else { void('') }; "
         ><?php echo "Delete </a>";?></a> <br /></td>
      <td><?php echo $row_RSTerminationDisplay['ID']; ?></td>
      <td><?php echo $row_RSTerminationDisplay['FirstName']; ?></td>
      <td><?php echo $row_RSTerminationDisplay['MiddelName']; ?></td>
      <td><?php echo $row_RSTerminationDisplay['LastName']; ?></td>
      <td><?php echo $row_RSTerminationDisplay['Department']; ?></td>
      <td><?php echo $row_RSTerminationDisplay['Terminated_Date']; ?></td>
      <td><?php echo $row_RSTerminationDisplay['Termination_Reason']; ?></td>
    </tr>
    <?php } while ($row_RSTerminationDisplay = mysql_fetch_assoc($RSTerminationDisplay)); ?>
</table>
<p>&nbsp;
<table width="397" border="0" align="center">
  <tr>
    <td><?php if ($pageNum_RSTerminationDisplay > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_RSTerminationDisplay=%d%s", $currentPage, 0, $queryString_RSTerminationDisplay); ?>"><img src="First.gif" /></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_RSTerminationDisplay > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_RSTerminationDisplay=%d%s", $currentPage, max(0, $pageNum_RSTerminationDisplay - 1), $queryString_RSTerminationDisplay); ?>"><img src="Previous.gif" /></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_RSTerminationDisplay < $totalPages_RSTerminationDisplay) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_RSTerminationDisplay=%d%s", $currentPage, min($totalPages_RSTerminationDisplay, $pageNum_RSTerminationDisplay + 1), $queryString_RSTerminationDisplay); ?>"><img src="Next.gif" /></a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_RSTerminationDisplay < $totalPages_RSTerminationDisplay) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_RSTerminationDisplay=%d%s", $currentPage, $totalPages_RSTerminationDisplay, $queryString_RSTerminationDisplay); ?>"><img src="Last.gif" /></a>
        <?php } // Show if not last page ?></td>
  </tr>
</table>
</p>
</body>
</html>
<?php
mysql_free_result($RSTerminationDisplay);
?>
