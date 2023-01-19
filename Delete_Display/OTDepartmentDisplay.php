<?php require_once('../Connections/HRMS.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RSOTDisplayDepartmental = 5;
$pageNum_RSOTDisplayDepartmental = 0;
if (isset($_GET['pageNum_RSOTDisplayDepartmental'])) {
    $pageNum_RSOTDisplayDepartmental = $_GET['pageNum_RSOTDisplayDepartmental'];
}
$startRow_RSOTDisplayDepartmental = $pageNum_RSOTDisplayDepartmental * $maxRows_RSOTDisplayDepartmental;

mysql_select_db($database_HRMS, $HRMS);
$query_RSOTDisplayDepartmental = "SELECT * FROM ot_definition_department JOIN DEPARTMENT ON Department.Department=ot_definition_department.Department ";
$query_limit_RSOTDisplayDepartmental = sprintf("%s LIMIT %d, %d", $query_RSOTDisplayDepartmental, $startRow_RSOTDisplayDepartmental, $maxRows_RSOTDisplayDepartmental);
$RSOTDisplayDepartmental = mysql_query($query_limit_RSOTDisplayDepartmental, $HRMS) or die(mysql_error());
$row_RSOTDisplayDepartmental = mysql_fetch_assoc($RSOTDisplayDepartmental);

if (isset($_GET['totalRows_RSOTDisplayDepartmental'])) {
    $totalRows_RSOTDisplayDepartmental = $_GET['totalRows_RSOTDisplayDepartmental'];
} else {
    $all_RSOTDisplayDepartmental = mysql_query($query_RSOTDisplayDepartmental);
    $totalRows_RSOTDisplayDepartmental = mysql_num_rows($all_RSOTDisplayDepartmental);
}
$totalPages_RSOTDisplayDepartmental = ceil($totalRows_RSOTDisplayDepartmental / $maxRows_RSOTDisplayDepartmental) - 1;
$maxRows_RSOTDisplayDepartmental = 5;
$pageNum_RSOTDisplayDepartmental = 0;
if (isset($_GET['pageNum_RSOTDisplayDepartmental'])) {
    $pageNum_RSOTDisplayDepartmental = $_GET['pageNum_RSOTDisplayDepartmental'];
}
$startRow_RSOTDisplayDepartmental = $pageNum_RSOTDisplayDepartmental * $maxRows_RSOTDisplayDepartmental;

mysql_select_db($database_HRMS, $HRMS);
$query_RSOTDisplayDepartmental = "SELECT * FROM ot_definition_department JOIN DEPARTMENT ON Department.Department=ot_definition_department.Department ";
$query_limit_RSOTDisplayDepartmental = sprintf("%s LIMIT %d, %d", $query_RSOTDisplayDepartmental, $startRow_RSOTDisplayDepartmental, $maxRows_RSOTDisplayDepartmental);
$RSOTDisplayDepartmental = mysql_query($query_limit_RSOTDisplayDepartmental, $HRMS) or die(mysql_error());
$row_RSOTDisplayDepartmental = mysql_fetch_assoc($RSOTDisplayDepartmental);

if (isset($_GET['totalRows_RSOTDisplayDepartmental'])) {
    $totalRows_RSOTDisplayDepartmental = $_GET['totalRows_RSOTDisplayDepartmental'];
} else {
    $all_RSOTDisplayDepartmental = mysql_query($query_RSOTDisplayDepartmental);
    $totalRows_RSOTDisplayDepartmental = mysql_num_rows($all_RSOTDisplayDepartmental);
}
$totalPages_RSOTDisplayDepartmental = ceil($totalRows_RSOTDisplayDepartmental / $maxRows_RSOTDisplayDepartmental) - 1;
$maxRows_RSOTDisplayDepartmental = 5;
$pageNum_RSOTDisplayDepartmental = 0;
if (isset($_GET['pageNum_RSOTDisplayDepartmental'])) {
    $pageNum_RSOTDisplayDepartmental = $_GET['pageNum_RSOTDisplayDepartmental'];
}
$startRow_RSOTDisplayDepartmental = $pageNum_RSOTDisplayDepartmental * $maxRows_RSOTDisplayDepartmental;

mysql_select_db($database_HRMS, $HRMS);
$query_RSOTDisplayDepartmental = "SELECT * FROM ot_definition_department JOIN DEPARTMENT ON Department.Department=ot_definition_department.Department ";
$query_limit_RSOTDisplayDepartmental = sprintf("%s LIMIT %d, %d", $query_RSOTDisplayDepartmental, $startRow_RSOTDisplayDepartmental, $maxRows_RSOTDisplayDepartmental);
$RSOTDisplayDepartmental = mysql_query($query_limit_RSOTDisplayDepartmental, $HRMS) or die(mysql_error());
$row_RSOTDisplayDepartmental = mysql_fetch_assoc($RSOTDisplayDepartmental);

if (isset($_GET['totalRows_RSOTDisplayDepartmental'])) {
    $totalRows_RSOTDisplayDepartmental = $_GET['totalRows_RSOTDisplayDepartmental'];
} else {
    $all_RSOTDisplayDepartmental = mysql_query($query_RSOTDisplayDepartmental);
    $totalRows_RSOTDisplayDepartmental = mysql_num_rows($all_RSOTDisplayDepartmental);
}
$totalPages_RSOTDisplayDepartmental = ceil($totalRows_RSOTDisplayDepartmental / $maxRows_RSOTDisplayDepartmental) - 1;
$maxRows_RSOTDisplayDepartmental = 5;
$pageNum_RSOTDisplayDepartmental = 0;
if (isset($_GET['pageNum_RSOTDisplayDepartmental'])) {
    $pageNum_RSOTDisplayDepartmental = $_GET['pageNum_RSOTDisplayDepartmental'];
}
$startRow_RSOTDisplayDepartmental = $pageNum_RSOTDisplayDepartmental * $maxRows_RSOTDisplayDepartmental;

mysql_select_db($database_HRMS, $HRMS);
$query_RSOTDisplayDepartmental = "SELECT * FROM ot_definition_department ORDER BY Department";
//JOIN DEPARTMENT ON Department.Department=ot_definition_department.Department ";
$query_limit_RSOTDisplayDepartmental = sprintf("%s LIMIT %d, %d", $query_RSOTDisplayDepartmental, $startRow_RSOTDisplayDepartmental, $maxRows_RSOTDisplayDepartmental);
$RSOTDisplayDepartmental = mysql_query($query_limit_RSOTDisplayDepartmental, $HRMS) or die(mysql_error());
$row_RSOTDisplayDepartmental = mysql_fetch_assoc($RSOTDisplayDepartmental);

if (isset($_GET['totalRows_RSOTDisplayDepartmental'])) {
    $totalRows_RSOTDisplayDepartmental = $_GET['totalRows_RSOTDisplayDepartmental'];
} else {
    $all_RSOTDisplayDepartmental = mysql_query($query_RSOTDisplayDepartmental);
    $totalRows_RSOTDisplayDepartmental = mysql_num_rows($all_RSOTDisplayDepartmental);
}
$totalPages_RSOTDisplayDepartmental = ceil($totalRows_RSOTDisplayDepartmental / $maxRows_RSOTDisplayDepartmental) - 1;

$queryString_RSOTDisplayDepartmental = "";
if (!empty($_SERVER['QUERY_STRING'])) {
    $params = explode("&", $_SERVER['QUERY_STRING']);
    $newParams = array();
    foreach ($params as $param) {
        if (stristr($param, "pageNum_RSOTDisplayDepartmental") == false &&
                stristr($param, "totalRows_RSOTDisplayDepartmental") == false) {
            array_push($newParams, $param);
        }
    }
    if (count($newParams) != 0) {
        $queryString_RSOTDisplayDepartmental = "&" . htmlentities(implode("&", $newParams));
    }
}
$queryString_RSOTDisplayDepartmental = sprintf("&totalRows_RSOTDisplayDepartmental=%d%s", $totalRows_RSOTDisplayDepartmental, $queryString_RSOTDisplayDepartmental);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Untitled Document</title>
    </head>

    <body>

        <font color="#FF6600" size="+1" > <p align="center">Overtime Definition Department Data Display</p>
            <p align="center">&nbsp;</p>
        </font>
        <table  cellpadding="0" align="center" border="1" bordercolor="#FF6600"> 
            <tr>
                <td>Opertation</td>
                <td>Department</td>
                <td>From_Date</td>
                <td>To_Date</td>
                <td>DayOT</td>
                <td>DayOT_MaxHR</td>
                <td>NightOT</td>
                <td>NightOT_MaxHR</td>
                <td>SundayOT</td>
                <td>HolydayOT</td>
                <td>DayOT_Start</td>
                <td>NightOT_Start</td>
                <td>NightOT_End</td>
            </tr>
            <?php do { ?>
                <tr>
                    <td>
                        <a  target="_blank" href="../Attendance_System/Biometric_Attendance_Database_Update/OTDepartment_Update/OTDepartmentUpdate.php?Auto_ID=<?php echo $row_RSOTDisplayDepartmental['Auto_ID'] ?>" ><?php echo "<p>Update</p> </a>"; ?></a>

                        <a  href="javascript: if (confirm('Are You Sure You want to Delete this Department data record?')) { window.location.href='OTDepartmentDelete.php?Auto_ID=<?php echo $row_RSOTDisplayDepartmental['Auto_ID']; ?>' } else { void('') }; "
                            ><?php echo "Delete </a>"; ?></a> <br /></td>
                    <td><?php echo $row_RSOTDisplayDepartmental['Department']; ?></td>
                    <td><?php echo $row_RSOTDisplayDepartmental['From_Date']; ?></td>
                    <td><?php echo $row_RSOTDisplayDepartmental['To_Date']; ?></td>
                    <td><?php echo $row_RSOTDisplayDepartmental['DayOT']; ?></td>
                    <td><?php echo $row_RSOTDisplayDepartmental['DayOT_MaxHR']; ?></td>
                    <td><?php echo $row_RSOTDisplayDepartmental['NightOT']; ?></td>
                    <td><?php echo $row_RSOTDisplayDepartmental['NightOT_MaxHR']; ?></td>
                    <td><?php echo $row_RSOTDisplayDepartmental['SundayOT']; ?></td>
                    <td><?php echo $row_RSOTDisplayDepartmental['HolydayOT']; ?></td>
                    <td><?php echo $row_RSOTDisplayDepartmental['DayOT_Start']; ?></td>
                    <td><?php echo $row_RSOTDisplayDepartmental['NightOT_Start']; ?></td>
                    <td><?php echo $row_RSOTDisplayDepartmental['NightOT_End']; ?></td>

                </tr>
            <?php } while ($row_RSOTDisplayDepartmental = mysql_fetch_assoc($RSOTDisplayDepartmental)); ?>
        </table>
        <p>&nbsp;<table width="406" height="44" border="0" align="center">

                <tr>
                    <td><?php if ($pageNum_RSOTDisplayDepartmental > 0) { // Show if not first page    ?>
                            <a href="<?php printf("%s?pageNum_RSOTDisplayDepartmental=%d%s", $currentPage, 0, $queryString_RSOTDisplayDepartmental); ?>">First</a>
                        <?php } // Show if not first page  ?></td>
                    <td><?php if ($pageNum_RSOTDisplayDepartmental > 0) { // Show if not first page    ?>
                            <a href="<?php printf("%s?pageNum_RSOTDisplayDepartmental=%d%s", $currentPage, max(0, $pageNum_RSOTDisplayDepartmental - 1), $queryString_RSOTDisplayDepartmental); ?>">Previous</a>
                        <?php } // Show if not first page  ?></td>
                    <td><?php if ($pageNum_RSOTDisplayDepartmental < $totalPages_RSOTDisplayDepartmental) { // Show if not last page    ?>
                            <a href="<?php printf("%s?pageNum_RSOTDisplayDepartmental=%d%s", $currentPage, min($totalPages_RSOTDisplayDepartmental, $pageNum_RSOTDisplayDepartmental + 1), $queryString_RSOTDisplayDepartmental); ?>">Next</a>
                        <?php } // Show if not last page  ?></td>
                    <td><?php if ($pageNum_RSOTDisplayDepartmental < $totalPages_RSOTDisplayDepartmental) { // Show if not last page    ?>
                            <a href="<?php printf("%s?pageNum_RSOTDisplayDepartmental=%d%s", $currentPage, $totalPages_RSOTDisplayDepartmental, $queryString_RSOTDisplayDepartmental); ?>">Last</a>
                        <?php } // Show if not last page  ?></td>
                </tr>
            </table></p>
    </body>
</html>
<?php
mysql_free_result($RSOTDisplayDepartmental);
?>
