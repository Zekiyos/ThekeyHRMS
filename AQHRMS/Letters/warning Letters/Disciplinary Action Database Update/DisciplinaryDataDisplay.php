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

$maxRows_RSDisciplinaryDataDisplay = 1;
$pageNum_RSDisciplinaryDataDisplay = 0;
if (isset($_GET['pageNum_RSDisciplinaryDataDisplay'])) {
  $pageNum_RSDisciplinaryDataDisplay = $_GET['pageNum_RSDisciplinaryDataDisplay'];
}
$startRow_RSDisciplinaryDataDisplay = $pageNum_RSDisciplinaryDataDisplay * $maxRows_RSDisciplinaryDataDisplay;

mysql_select_db($database_HRMS, $HRMS);
if(isset($_GET['ID']))
$query_RSDisciplinaryDataDisplay = "SELECT * FROM disciplinary_action WHERE ID='".$_GET['ID']."'";
else
$query_RSDisciplinaryDataDisplay = "SELECT * FROM disciplinary_action";
$query_limit_RSDisciplinaryDataDisplay = sprintf("%s LIMIT %d, %d", $query_RSDisciplinaryDataDisplay, $startRow_RSDisciplinaryDataDisplay, $maxRows_RSDisciplinaryDataDisplay);
$RSDisciplinaryDataDisplay = mysql_query($query_limit_RSDisciplinaryDataDisplay, $HRMS) or die(mysql_error());
$row_RSDisciplinaryDataDisplay = mysql_fetch_assoc($RSDisciplinaryDataDisplay);

if (isset($_GET['totalRows_RSDisciplinaryDataDisplay'])) {
  $totalRows_RSDisciplinaryDataDisplay = $_GET['totalRows_RSDisciplinaryDataDisplay'];
} else {
  $all_RSDisciplinaryDataDisplay = mysql_query($query_RSDisciplinaryDataDisplay);
  $totalRows_RSDisciplinaryDataDisplay = mysql_num_rows($all_RSDisciplinaryDataDisplay);
}
$totalPages_RSDisciplinaryDataDisplay = ceil($totalRows_RSDisciplinaryDataDisplay/$maxRows_RSDisciplinaryDataDisplay)-1;

$queryString_RSDisciplinaryDataDisplay = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RSDisciplinaryDataDisplay") == false && 
        stristr($param, "totalRows_RSDisciplinaryDataDisplay") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RSDisciplinaryDataDisplay = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RSDisciplinaryDataDisplay = sprintf("&totalRows_RSDisciplinaryDataDisplay=%d%s", $totalRows_RSDisciplinaryDataDisplay, $queryString_RSDisciplinaryDataDisplay);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Disciplinary Data Display</title>
</head>

<body>
<font color="#FF6600" size="+1" > <p align="center">Disciplinary Data Display</p></font>
<?php
$_GET['TableName']="disciplinary_action";

$_GET['OpenPage']="disciplinarydatadisplay";

 include("../../../Search Name/SearchName.php");?>
<table  cellpadding="0" align="center" border="1" bordercolor="#FF6600"> 
  <tr>
    <td>Auto_ID</td>
    <td>ID</td>
    <td>FirstName</td>
    <td>MiddelName</td>
    <td>LastName</td>
    <td>Department</td>
    <td>Position</td>
    <td>Verbal_Warning</td>
    <td>First_Inistance</td>
    <td>Second_Inistance</td>
    <td>Third_Inistance</td>
    <td>Last_Warning</td>
    <td>First_Inistance_Date</td>
    <td>Verbal_Warning_Date</td>
    <td>Second_Inistance_Date</td>
    <td>Third_Inistance_Date</td>
    <td>Last_Warning_Date</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><a  target="_blank" href="DisciplinaryDataUpdate.php?Auto_ID=<?php echo $row_RSDisciplinaryDataDisplay['Auto_ID']; ?>"  ><?php echo "<p>Update</p> </a>";?></a>
      
     <a  href="javascript: if (confirm('Are You Sure You want to Delete the Displinary action Data record?')) { window.location.href='DisciplinaryDataDelete.php?Auto_ID=<?php echo $row_RSDisciplinaryDataDisplay['Auto_ID']; ?>' } else { void('') }; "
         ><?php echo "Delete </a>";?></a> <br /></td>
      <td><?php echo $row_RSDisciplinaryDataDisplay['ID']; ?></td>
      <td><?php echo $row_RSDisciplinaryDataDisplay['FirstName']; ?></td>
      <td><?php echo $row_RSDisciplinaryDataDisplay['MiddelName']; ?></td>
      <td><?php echo $row_RSDisciplinaryDataDisplay['LastName']; ?></td>
      <td><?php echo $row_RSDisciplinaryDataDisplay['Department']; ?></td>
      <td><?php echo $row_RSDisciplinaryDataDisplay['Position']; ?></td>
      <td><?php echo $row_RSDisciplinaryDataDisplay['Verbal_Warning']; ?></td>
      <td><?php echo $row_RSDisciplinaryDataDisplay['First_Inistance']; ?></td>
      <td><?php echo $row_RSDisciplinaryDataDisplay['Second_Inistance']; ?></td>
      <td><?php echo $row_RSDisciplinaryDataDisplay['Third_Inistance']; ?></td>
      <td><?php echo $row_RSDisciplinaryDataDisplay['Last_Warning']; ?></td>
      <td><?php echo $row_RSDisciplinaryDataDisplay['First_Inistance_Date']; ?></td>
      <td><?php echo $row_RSDisciplinaryDataDisplay['Verbal_Warning_Date']; ?></td>
      <td><?php echo $row_RSDisciplinaryDataDisplay['Second_Inistance_Date']; ?></td>
      <td><?php echo $row_RSDisciplinaryDataDisplay['Third_Inistance_Date']; ?></td>
      <td><?php echo $row_RSDisciplinaryDataDisplay['Last_Warning_Date']; ?></td>
    </tr>
    <?php } while ($row_RSDisciplinaryDataDisplay = mysql_fetch_assoc($RSDisciplinaryDataDisplay)); ?>
</table>
<p>&nbsp;
<table width="360" border="0" align="center">
  <tr>
    <td><?php if ($pageNum_RSDisciplinaryDataDisplay > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_RSDisciplinaryDataDisplay=%d%s", $currentPage, 0, $queryString_RSDisciplinaryDataDisplay); ?>"><img src="First.gif" /></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_RSDisciplinaryDataDisplay > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_RSDisciplinaryDataDisplay=%d%s", $currentPage, max(0, $pageNum_RSDisciplinaryDataDisplay - 1), $queryString_RSDisciplinaryDataDisplay); ?>"><img src="Previous.gif" /></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_RSDisciplinaryDataDisplay < $totalPages_RSDisciplinaryDataDisplay) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_RSDisciplinaryDataDisplay=%d%s", $currentPage, min($totalPages_RSDisciplinaryDataDisplay, $pageNum_RSDisciplinaryDataDisplay + 1), $queryString_RSDisciplinaryDataDisplay); ?>"><img src="Next.gif" /></a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_RSDisciplinaryDataDisplay < $totalPages_RSDisciplinaryDataDisplay) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_RSDisciplinaryDataDisplay=%d%s", $currentPage, $totalPages_RSDisciplinaryDataDisplay, $queryString_RSDisciplinaryDataDisplay); ?>"><img src="Last.gif" /></a>
        <?php } // Show if not last page ?></td>
  </tr>
</table>
</p>
</body>
</html>
<?php
mysql_free_result($RSDisciplinaryDataDisplay);
?>
