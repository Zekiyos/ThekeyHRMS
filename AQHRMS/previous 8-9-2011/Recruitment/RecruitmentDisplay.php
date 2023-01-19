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

$maxRows_RSRecruitment = 5;
$pageNum_RSRecruitment = 0;
if (isset($_GET['pageNum_RSRecruitment'])) {
  $pageNum_RSRecruitment = $_GET['pageNum_RSRecruitment'];
}
$startRow_RSRecruitment = $pageNum_RSRecruitment * $maxRows_RSRecruitment;

mysql_select_db($database_HRMS, $HRMS);
$query_RSRecruitment = "SELECT * FROM recruitment";
$query_limit_RSRecruitment = sprintf("%s LIMIT %d, %d", $query_RSRecruitment, $startRow_RSRecruitment, $maxRows_RSRecruitment);
$RSRecruitment = mysql_query($query_limit_RSRecruitment, $HRMS) or die(mysql_error());
$row_RSRecruitment = mysql_fetch_assoc($RSRecruitment);

if (isset($_GET['totalRows_RSRecruitment'])) {
  $totalRows_RSRecruitment = $_GET['totalRows_RSRecruitment'];
} else {
  $all_RSRecruitment = mysql_query($query_RSRecruitment);
  $totalRows_RSRecruitment = mysql_num_rows($all_RSRecruitment);
}
$totalPages_RSRecruitment = ceil($totalRows_RSRecruitment/$maxRows_RSRecruitment)-1;

$queryString_RSRecruitment = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RSRecruitment") == false && 
        stristr($param, "totalRows_RSRecruitment") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RSRecruitment = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RSRecruitment = sprintf("&totalRows_RSRecruitment=%d%s", $totalRows_RSRecruitment, $queryString_RSRecruitment);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<font color="#FF6600" size="+2" > <p align="center">Recruitment Data Display</p></font>
<table  cellpadding="0" align="center" border="1" bordercolor="#FF6600">  <tr>
    <td>Operation</td>
    <td>Employee</td>
    <td>Place</td>
    <td>ID</td>
    <td>FirstName</td>
    <td>MiddelName</td>
    <td>LastName</td>
    <td>Age</td>
    <td>Sex</td>
    <td>Photo</td>
    <td>Date</td>
    <td>Address</td>
    <td>Department</td>
    <td>Position</td>
    <td>Salary</td>
    <td>Transport_Allowance</td>
    <td>Hardship_Allowance</td>
    <td>Housing_Allowance</td>
    <td>Position_Allowance</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><a  target="_blank" href="RecruitmentUpdate.php?Auto_ID=<?php echo $row_RSRecruitment['Auto_ID']; ?>"  ><?php echo "<p>Update</p> </a>";?></a>
      
     <a  href="javascript: if (confirm('Are You Sure You want to Delete this Recruited Person record?')) { window.location.href='RecruitmentDelete.php?Auto_ID=<?php echo $row_RSRecruitment['Auto_ID']; ?>' } else { void('') }; "
         ><?php echo "Delete </a>";?></a> <br /></td>
      <td><?php echo $row_RSRecruitment['Employee']; ?></td>
      <td><?php echo $row_RSRecruitment['Place']; ?></td>
      <td><?php echo $row_RSRecruitment['ID']; ?></td>
      <td><?php echo $row_RSRecruitment['FirstName']; ?></td>
      <td><?php echo $row_RSRecruitment['MiddelName']; ?></td>
      <td><?php echo $row_RSRecruitment['LastName']; ?></td>
      <td><?php echo $row_RSRecruitment['Age']; ?></td>
      <td><?php echo $row_RSRecruitment['Sex']; ?></td>
      <td><?php echo $row_RSRecruitment['Photo']; ?></td>
      <td><?php echo $row_RSRecruitment['Date']; ?></td>
      <td><?php echo $row_RSRecruitment['Address']; ?></td>
      <td><?php echo $row_RSRecruitment['Department']; ?></td>
      <td><?php echo $row_RSRecruitment['Position']; ?></td>
      <td><?php echo $row_RSRecruitment['Salary']; ?></td>
      <td><?php echo $row_RSRecruitment['Transport_Allowance']; ?></td>
      <td><?php echo $row_RSRecruitment['Hardship_Allowance']; ?></td>
      <td><?php echo $row_RSRecruitment['Housing_Allowance']; ?></td>
      <td><?php echo $row_RSRecruitment['Position_Allowance']; ?></td>
    </tr>
    <?php } while ($row_RSRecruitment = mysql_fetch_assoc($RSRecruitment)); ?>
</table>
<table width="331" border="0" align="center">
  <tr>
    <td><?php if ($pageNum_RSRecruitment > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_RSRecruitment=%d%s", $currentPage, 0, $queryString_RSRecruitment); ?>"><img src="First.gif" /></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_RSRecruitment > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_RSRecruitment=%d%s", $currentPage, max(0, $pageNum_RSRecruitment - 1), $queryString_RSRecruitment); ?>"><img src="Previous.gif" /></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_RSRecruitment < $totalPages_RSRecruitment) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_RSRecruitment=%d%s", $currentPage, min($totalPages_RSRecruitment, $pageNum_RSRecruitment + 1), $queryString_RSRecruitment); ?>"><img src="Next.gif" /></a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_RSRecruitment < $totalPages_RSRecruitment) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_RSRecruitment=%d%s", $currentPage, $totalPages_RSRecruitment, $queryString_RSRecruitment); ?>"><img src="Last.gif" /></a>
        <?php } // Show if not last page ?></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($RSRecruitment);
?>
