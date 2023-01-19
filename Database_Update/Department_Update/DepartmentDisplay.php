<?php require_once('../../Connections/HRMS.php'); ?>
<?php
require_once('../../Classes/Class_AccessLevel.php');
$obj_AccessLevel = new AccessLevel();
echo $obj_AccessLevel->CHK_AccessLevel();
?>

<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RSDepartmentDisplay = 5;
$pageNum_RSDepartmentDisplay = 0;
if (isset($_GET['pageNum_RSDepartmentDisplay'])) {
    $pageNum_RSDepartmentDisplay = $_GET['pageNum_RSDepartmentDisplay'];
}
$startRow_RSDepartmentDisplay = $pageNum_RSDepartmentDisplay * $maxRows_RSDepartmentDisplay;

mysql_select_db($database_HRMS, $HRMS);
$query_RSDepartmentDisplay = "SELECT * FROM department";
$query_limit_RSDepartmentDisplay = sprintf("%s LIMIT %d, %d", $query_RSDepartmentDisplay, $startRow_RSDepartmentDisplay, $maxRows_RSDepartmentDisplay);
$RSDepartmentDisplay = mysql_query($query_limit_RSDepartmentDisplay, $HRMS) or die(mysql_error());
$row_RSDepartmentDisplay = mysql_fetch_assoc($RSDepartmentDisplay);

if (isset($_GET['totalRows_RSDepartmentDisplay'])) {
    $totalRows_RSDepartmentDisplay = $_GET['totalRows_RSDepartmentDisplay'];
} else {
    $all_RSDepartmentDisplay = mysql_query($query_RSDepartmentDisplay);
    $totalRows_RSDepartmentDisplay = mysql_num_rows($all_RSDepartmentDisplay);
}
$totalPages_RSDepartmentDisplay = ceil($totalRows_RSDepartmentDisplay / $maxRows_RSDepartmentDisplay) - 1;

$queryString_RSDepartmentDisplay = "";
if (!empty($_SERVER['QUERY_STRING'])) {
    $params = explode("&", $_SERVER['QUERY_STRING']);
    $newParams = array();
    foreach ($params as $param) {
        if (stristr($param, "pageNum_RSDepartmentDisplay") == false &&
                stristr($param, "totalRows_RSDepartmentDisplay") == false) {
            array_push($newParams, $param);
        }
    }
    if (count($newParams) != 0) {
        $queryString_RSDepartmentDisplay = "&" . htmlentities(implode("&", $newParams));
    }
}
$queryString_RSDepartmentDisplay = sprintf("&totalRows_RSDepartmentDisplay=%d%s", $totalRows_RSDepartmentDisplay, $queryString_RSDepartmentDisplay);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Department Dsiplay</title>
    </head>

    <body>
        <font color="#FF6600" size="+1" > <p align="center">Department Data Display</p></font>
        <table  cellpadding="0" align="center" border="1" bordercolor="#FF6600"> 
            <tr>
                <td>Opertation</td>
                <td>Section</td>
                <td>Sub Section</td>
                <td>Group</td>
                <td>Department</td>
            </tr>
<?php do { ?>
                <tr>
                    <td>
                        <a  target="_blank" href="DepartmentUpdate.php?Department=<?php echo $row_RSDepartmentDisplay['Department'] ?>" ><?php echo "<p>Update</p> </a>"; ?></a>

                        <a  href="javascript: if (confirm('Are You Sure You want to Delete this Department data record?')) { window.location.href='DepartmentDelete.php?Department=<?php echo $row_RSDepartmentDisplay['Department']; ?>' } else { void('') }; "
                            ><?php echo "Delete </a>"; ?></a> <br /></td>
                    <td><?php echo $row_RSDepartmentDisplay['Section']; ?></td>
                    <td><?php echo $row_RSDepartmentDisplay['Sub Section']; ?></td>
                    <td><?php echo $row_RSDepartmentDisplay['Group']; ?></td>
                    <td><?php echo $row_RSDepartmentDisplay['Department']; ?></td>
                </tr>
<?php } while ($row_RSDepartmentDisplay = mysql_fetch_assoc($RSDepartmentDisplay)); ?>
        </table>
        <p>&nbsp;
            <table width="406" height="44" border="0" align="center">
                <tr>
                    <td><?php if ($pageNum_RSDepartmentDisplay > 0) { // Show if not first page  ?>
                            <a href="<?php printf("%s?pageNum_RSDepartmentDisplay=%d%s", $currentPage, 0, $queryString_RSDepartmentDisplay); ?>"><img src="../../images/First.gif" /></a>
<?php } // Show if not first page  ?></td>
                    <td><?php if ($pageNum_RSDepartmentDisplay > 0) { // Show if not first page  ?>
                            <a href="<?php printf("%s?pageNum_RSDepartmentDisplay=%d%s", $currentPage, max(0, $pageNum_RSDepartmentDisplay - 1), $queryString_RSDepartmentDisplay); ?>"><img src="../../images/Previous.gif" /></a>
<?php } // Show if not first page  ?></td>
                    <td><?php if ($pageNum_RSDepartmentDisplay < $totalPages_RSDepartmentDisplay) { // Show if not last page  ?>
                            <a href="<?php printf("%s?pageNum_RSDepartmentDisplay=%d%s", $currentPage, min($totalPages_RSDepartmentDisplay, $pageNum_RSDepartmentDisplay + 1), $queryString_RSDepartmentDisplay); ?>"><img src="../../images/Next.gif" /></a>
<?php } // Show if not last page  ?></td>
                    <td><?php if ($pageNum_RSDepartmentDisplay < $totalPages_RSDepartmentDisplay) { // Show if not last page  ?>
                            <a href="<?php printf("%s?pageNum_RSDepartmentDisplay=%d%s", $currentPage, $totalPages_RSDepartmentDisplay, $queryString_RSDepartmentDisplay); ?>"><img src="../../images/Last.gif" /></a>
<?php } // Show if not last page  ?></td>
                </tr>
            </table>
        </p>
    </body>
</html>
<?php
mysql_free_result($RSDepartmentDisplay);
?>
