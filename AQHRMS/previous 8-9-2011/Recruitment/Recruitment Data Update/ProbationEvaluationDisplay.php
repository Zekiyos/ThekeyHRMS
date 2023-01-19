
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

$maxRows_RSProbationEvaluationDisplay = 10;
$pageNum_RSProbationEvaluationDisplay = 0;
if (isset($_GET['pageNum_RSProbationEvaluationDisplay'])) {
  $pageNum_RSProbationEvaluationDisplay = $_GET['pageNum_RSProbationEvaluationDisplay'];
}
$startRow_RSProbationEvaluationDisplay = $pageNum_RSProbationEvaluationDisplay * $maxRows_RSProbationEvaluationDisplay;

mysql_select_db($database_HRMS, $HRMS);
$query_RSProbationEvaluationDisplay = "SELECT * FROM probation_evalutaion";
$query_limit_RSProbationEvaluationDisplay = sprintf("%s LIMIT %d, %d", $query_RSProbationEvaluationDisplay, $startRow_RSProbationEvaluationDisplay, $maxRows_RSProbationEvaluationDisplay);
$RSProbationEvaluationDisplay = mysql_query($query_limit_RSProbationEvaluationDisplay, $HRMS) or die(mysql_error());
$row_RSProbationEvaluationDisplay = mysql_fetch_assoc($RSProbationEvaluationDisplay);

if (isset($_GET['totalRows_RSProbationEvaluationDisplay'])) {
  $totalRows_RSProbationEvaluationDisplay = $_GET['totalRows_RSProbationEvaluationDisplay'];
} else {
  $all_RSProbationEvaluationDisplay = mysql_query($query_RSProbationEvaluationDisplay);
  $totalRows_RSProbationEvaluationDisplay = mysql_num_rows($all_RSProbationEvaluationDisplay);
}
$totalPages_RSProbationEvaluationDisplay = ceil($totalRows_RSProbationEvaluationDisplay/$maxRows_RSProbationEvaluationDisplay)-1;

$queryString_RSProbationEvaluationDisplay = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RSProbationEvaluationDisplay") == false && 
        stristr($param, "totalRows_RSProbationEvaluationDisplay") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RSProbationEvaluationDisplay = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RSProbationEvaluationDisplay = sprintf("&totalRows_RSProbationEvaluationDisplay=%d%s", $totalRows_RSProbationEvaluationDisplay, $queryString_RSProbationEvaluationDisplay);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<font color="#FF6600" size="+1" > <p align="center">Probation Evaluation Data Display</p></font>
<table  cellpadding="0" align="center" border="1" bordercolor="#FF6600">
  <tr>
    <td>Operation</td>
    <td>ID</td>
    <td>FirstName</td>
    <td>MiddelName</td>
    <td>LastName</td>
    <td>Department</td>
    <td>Position</td>
    <td>Date_Employement</td>
    <td>Attendance</td>
    <td>Motivation</td>
    <td>Performance_Individual</td>
    <td>Performance_Group</td>
    <td>Communication_Supervisor</td>
    <td>Manger_Remark</td>
    <td>HR_Opinon</td>
    <td>Date</td>
    <td>Result</td>
  </tr>
  <?php do { ?>
    <tr>
        <td><a  target="_blank" href="ProbationEvaluationUpdate.php?Auto_ID=<?php echo $row_RSProbationEvaluationDisplay['Auto_ID']; ?>"  ><?php echo "<p>Update</p> </a>";?></a>
      
     <a  href="javascript: if (confirm('Are You Sure You want to Delete this Evalution Result of this Person?')) { window.location.href='ProbationEvaluationDelete.php?Auto_ID=<?php echo $row_RSProbationEvaluationDisplay['Auto_ID']; ?>' } else { void('') }; "
         ><?php echo "Delete </a>";?></a> <br /></td>
      <td><?php echo $row_RSProbationEvaluationDisplay['ID']; ?></td>
      <td><?php echo $row_RSProbationEvaluationDisplay['FirstName']; ?></td>
      <td><?php echo $row_RSProbationEvaluationDisplay['MiddelName']; ?></td>
      <td><?php echo $row_RSProbationEvaluationDisplay['LastName']; ?></td>
      <td><?php echo $row_RSProbationEvaluationDisplay['Department']; ?></td>
      <td><?php echo $row_RSProbationEvaluationDisplay['Position']; ?></td>
      <td><?php echo $row_RSProbationEvaluationDisplay['Date_Employement']; ?></td>
      <td><?php echo $row_RSProbationEvaluationDisplay['Attendance']; ?></td>
      <td><?php echo $row_RSProbationEvaluationDisplay['Motivation']; ?></td>
      <td><?php echo $row_RSProbationEvaluationDisplay['Performance_Individual']; ?></td>
      <td><?php echo $row_RSProbationEvaluationDisplay['Performance_Group']; ?></td>
      <td><?php echo $row_RSProbationEvaluationDisplay['Communication_Supervisor']; ?></td>
      <td><?php echo $row_RSProbationEvaluationDisplay['Manger_Remark']; ?></td>
      <td><?php echo $row_RSProbationEvaluationDisplay['HR_Opinon']; ?></td>
      <td><?php echo $row_RSProbationEvaluationDisplay['Date']; ?></td>
      <td><?php echo $row_RSProbationEvaluationDisplay['Result']; ?></td>
    </tr>
    <?php } while ($row_RSProbationEvaluationDisplay = mysql_fetch_assoc($RSProbationEvaluationDisplay)); ?>
</table>
<table width="277" border="0" align="center">
  <tr>
    <td><?php if ($pageNum_RSProbationEvaluationDisplay > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_RSProbationEvaluationDisplay=%d%s", $currentPage, 0, $queryString_RSProbationEvaluationDisplay); ?>"><img src="First.gif" /></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_RSProbationEvaluationDisplay > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_RSProbationEvaluationDisplay=%d%s", $currentPage, max(0, $pageNum_RSProbationEvaluationDisplay - 1), $queryString_RSProbationEvaluationDisplay); ?>"><img src="Previous.gif" /></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_RSProbationEvaluationDisplay < $totalPages_RSProbationEvaluationDisplay) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_RSProbationEvaluationDisplay=%d%s", $currentPage, min($totalPages_RSProbationEvaluationDisplay, $pageNum_RSProbationEvaluationDisplay + 1), $queryString_RSProbationEvaluationDisplay); ?>"><img src="Next.gif" /></a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_RSProbationEvaluationDisplay < $totalPages_RSProbationEvaluationDisplay) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_RSProbationEvaluationDisplay=%d%s", $currentPage, $totalPages_RSProbationEvaluationDisplay, $queryString_RSProbationEvaluationDisplay); ?>"><img src="Last.gif" /></a>
        <?php } // Show if not last page ?></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($RSProbationEvaluationDisplay);
?>
