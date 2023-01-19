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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RSCourtCaseDisplay = 5;
$pageNum_RSCourtCaseDisplay = 0;
if (isset($_GET['pageNum_RSCourtCaseDisplay'])) {
  $pageNum_RSCourtCaseDisplay = $_GET['pageNum_RSCourtCaseDisplay'];
}
$startRow_RSCourtCaseDisplay = $pageNum_RSCourtCaseDisplay * $maxRows_RSCourtCaseDisplay;

mysql_select_db($database_HRMS, $HRMS);
$query_RSCourtCaseDisplay = "SELECT * FROM court_case";
$query_limit_RSCourtCaseDisplay = sprintf("%s LIMIT %d, %d", $query_RSCourtCaseDisplay, $startRow_RSCourtCaseDisplay, $maxRows_RSCourtCaseDisplay);
$RSCourtCaseDisplay = mysql_query($query_limit_RSCourtCaseDisplay, $HRMS) or die(mysql_error());
$row_RSCourtCaseDisplay = mysql_fetch_assoc($RSCourtCaseDisplay);

if (isset($_GET['totalRows_RSCourtCaseDisplay'])) {
  $totalRows_RSCourtCaseDisplay = $_GET['totalRows_RSCourtCaseDisplay'];
} else {
  $all_RSCourtCaseDisplay = mysql_query($query_RSCourtCaseDisplay);
  $totalRows_RSCourtCaseDisplay = mysql_num_rows($all_RSCourtCaseDisplay);
}
$totalPages_RSCourtCaseDisplay = ceil($totalRows_RSCourtCaseDisplay/$maxRows_RSCourtCaseDisplay)-1;

$queryString_RSCourtCaseDisplay = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RSCourtCaseDisplay") == false && 
        stristr($param, "totalRows_RSCourtCaseDisplay") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RSCourtCaseDisplay = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RSCourtCaseDisplay = sprintf("&totalRows_RSCourtCaseDisplay=%d%s", $totalRows_RSCourtCaseDisplay, $queryString_RSCourtCaseDisplay);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Court Case Data Display</title>
</head>

<body>
<font color="#FF6600" size="+2" > <p align="center">Court Case Data Display</p></font>
<table  cellpadding="0" align="center" border="1" bordercolor="#FF6600">
  <tr>
    <td>Operation</td>
    <td>ID</td>
    <td>FirstName</td>
    <td>MiddelName</td>
    <td>LastName</td>
    <td>Department</td>
    <td>FileNumber</td>
    <td>FileDate</td>
    <td>ClaimAmount</td>
    <td>AdvocateName</td>
    <td>AppointmentDate</td>
    <td>Court</td>
    <td>Case</td>
    <td>Result</td>
    <td>Decision</td>
    <td>Case_Status</td>
  </tr>
  <?php do { ?>
    <tr>
       <td><a  target="_blank" href="CourtCaseUpdate.php?Auto_ID=<?php echo $row_RSCourtCaseDisplay['Auto_ID']; ?>"  ><?php echo "<p>Update</p> </a>";?></a>
      
     <a  href="javascript: if (confirm('Are You Sure You want to Delete the Annual Leave record?')) { window.location.href='CourtCaseDelete.php?Auto_ID=<?php echo $row_RSCourtCaseDisplay['Auto_ID']; ?>' } else { void('') }; "
         ><?php echo "Delete </a>";?></a> <br /><?php //echo $row_RSAnnualLeaveDsiplay['Auto_ID']; ?></td>
      <td><?php echo $row_RSCourtCaseDisplay['ID']; ?></td>
      <td><?php echo $row_RSCourtCaseDisplay['FirstName']; ?></td>
      <td><?php echo $row_RSCourtCaseDisplay['MiddelName']; ?></td>
      <td><?php echo $row_RSCourtCaseDisplay['LastName']; ?></td>
      <td><?php echo $row_RSCourtCaseDisplay['Department']; ?></td>
      <td><?php echo $row_RSCourtCaseDisplay['FileNumber']; ?></td>
      <td><?php echo $row_RSCourtCaseDisplay['FileDate']; ?></td>
      <td><?php echo $row_RSCourtCaseDisplay['ClaimAmount']; ?></td>
      <td><?php echo $row_RSCourtCaseDisplay['AdvocateName']; ?></td>
      <td><?php echo $row_RSCourtCaseDisplay['AppointmentDate']; ?></td>
      <td><?php echo $row_RSCourtCaseDisplay['Court']; ?></td>
      <td><?php echo $row_RSCourtCaseDisplay['Case']; ?></td>
      <td><?php echo $row_RSCourtCaseDisplay['Result']; ?></td>
      <td><?php echo $row_RSCourtCaseDisplay['Decision']; ?></td>
      <td><?php echo $row_RSCourtCaseDisplay['Case_Status']; ?></td>
    </tr>
    <?php } while ($row_RSCourtCaseDisplay = mysql_fetch_assoc($RSCourtCaseDisplay)); ?>
</table>
<p>&nbsp;</p>
<table width="449" height="50" border="0" align="center">
  <tr>
    <td><?php if ($pageNum_RSCourtCaseDisplay > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_RSCourtCaseDisplay=%d%s", $currentPage, 0, $queryString_RSCourtCaseDisplay); ?>"><img src="First.gif" /></a>
      <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_RSCourtCaseDisplay > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_RSCourtCaseDisplay=%d%s", $currentPage, max(0, $pageNum_RSCourtCaseDisplay - 1), $queryString_RSCourtCaseDisplay); ?>"><img src="Previous.gif" /></a>
      <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_RSCourtCaseDisplay < $totalPages_RSCourtCaseDisplay) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_RSCourtCaseDisplay=%d%s", $currentPage, min($totalPages_RSCourtCaseDisplay, $pageNum_RSCourtCaseDisplay + 1), $queryString_RSCourtCaseDisplay); ?>"><img src="Next.gif" /></a>
      <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_RSCourtCaseDisplay < $totalPages_RSCourtCaseDisplay) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_RSCourtCaseDisplay=%d%s", $currentPage, $totalPages_RSCourtCaseDisplay, $queryString_RSCourtCaseDisplay); ?>"><img src="Last.gif" /></a>
      <?php } // Show if not last page ?></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($RSCourtCaseDisplay);
?>
