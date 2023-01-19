<?php require_once('../Connections/HRMS.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RSOffDay = 5;
$pageNum_RSOffDay = 0;
if (isset($_GET['pageNum_RSOffDay'])) {
    $pageNum_RSOffDay = $_GET['pageNum_RSOffDay'];
}
$startRow_RSOffDay = $pageNum_RSOffDay * $maxRows_RSOffDay;

mysql_select_db($database_HRMS, $HRMS);

if (isset($_GET['ID']))
    $query_RSOffDay = "SELECT * FROM employee_offday WHERE ID='" . $_GET['ID'] . "'";
else
    $query_RSOffDay = "SELECT * FROM employee_offday ORDER BY ID ASC";
$query_limit_RSOffDay = sprintf("%s LIMIT %d, %d", $query_RSOffDay, $startRow_RSOffDay, $maxRows_RSOffDay);
$RSOffDay = mysql_query($query_limit_RSOffDay, $HRMS) or die(mysql_error());
$row_RSOffDay = mysql_fetch_assoc($RSOffDay);

if (isset($_GET['totalRows_RSOffDay'])) {
    $totalRows_RSOffDay = $_GET['totalRows_RSOffDay'];
} else {
    $all_RSOffDay = mysql_query($query_RSOffDay);
    $totalRows_RSOffDay = mysql_num_rows($all_RSOffDay);
}
$totalPages_RSOffDay = ceil($totalRows_RSOffDay / $maxRows_RSOffDay) - 1;

$queryString_RSOffDay = "";
if (!empty($_SERVER['QUERY_STRING'])) {
    $params = explode("&", $_SERVER['QUERY_STRING']);
    $newParams = array();
    foreach ($params as $param) {
        if (stristr($param, "pageNum_RSOffDay") == false &&
                stristr($param, "totalRows_RSOffDay") == false) {
            array_push($newParams, $param);
        }
    }
    if (count($newParams) != 0) {
        $queryString_RSOffDay = "&" . htmlentities(implode("&", $newParams));
    }
}
$queryString_RSOffDay = sprintf("&totalRows_RSOffDay=%d%s", $totalRows_RSOffDay, $queryString_RSOffDay);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Employee Off Day</title>
    </head>

    <body>
        <font color="#FF6600" size="+1" > <p align="center">Employee Off Day Data Display</p></font>
        <?php
        $_GET['TableName'] = "employee_offday";

        $_GET['OpenPage'] = "OffDayDisplay";

        require_once($base_path . "Search_Name/SearchName.php");
        ?>
        <table  cellpadding="0" align="center" border="1" bordercolor="#FF6600"> 
            <tr>
                <td>Opertation</td>
                <td>ID</td>
                <td>FirstName</td>
                <td>MiddelName</td>
                <td>LastName</td>
                <td>Department</td>
                <td>Off_Day</td>
                <td>From_Date</td>
                <td>To_Date</td>
            </tr>
            <?php do { ?>
                <tr>
                    <td>
                        <a  target="_blank" href="../Attendance_System/Biometric_Attendance_Database_Update/OffDay_Update/OffDayUpdate.php?Auto_ID=<?php echo $row_RSOffDay['Auto_ID'] ?>" ><?php echo "<p>Update</p> </a>"; ?></a>

                        <a  href="javascript: if (confirm('Are You Sure You want to Delete this Off Day data record?')) { window.location.href='OffDayDelete.php?Auto_ID=<?php echo $row_RSOffDay['Auto_ID']; ?>' } else { void('') }; "
                            ><?php echo "Delete </a>"; ?></a> <br /></td>
                    <td><?php echo $row_RSOffDay['ID']; ?></td>
                    <td><?php echo $row_RSOffDay['FirstName']; ?></td>
                    <td><?php echo $row_RSOffDay['MiddelName']; ?></td>
                    <td><?php echo $row_RSOffDay['LastName']; ?></td>
                    <td><?php echo $row_RSOffDay['Department']; ?></td>
                    <td><?php echo $row_RSOffDay['Off_Day']; ?></td>
                    <td><?php echo $row_RSOffDay['From_Date']; ?></td>
                    <td><?php echo $row_RSOffDay['To_Date']; ?></td>
                </tr>
            <?php } while ($row_RSOffDay = mysql_fetch_assoc($RSOffDay)); ?>
        </table>
        <p>&nbsp;
            <table width="406" height="44" border="0" align="center">
                <tr>
                    <td><?php if ($pageNum_RSOffDay > 0) { // Show if not first page    ?>
                            <a href="<?php printf("%s?pageNum_RSOffDay=%d%s", $currentPage, 0, $queryString_RSOffDay); ?>"><img src="../Img/First.gif" /></a>
                        <?php } // Show if not first page  ?></td>
                    <td><?php if ($pageNum_RSOffDay > 0) { // Show if not first page   ?>
                            <a href="<?php printf("%s?pageNum_RSOffDay=%d%s", $currentPage, max(0, $pageNum_RSOffDay - 1), $queryString_RSOffDay); ?>"><img src="../Img/Previous.gif" /></a>
                        <?php } // Show if not first page  ?></td>
                    <td><?php if ($pageNum_RSOffDay < $totalPages_RSOffDay) { // Show if not last page   ?>
                            <a href="<?php printf("%s?pageNum_RSOffDay=%d%s", $currentPage, min($totalPages_RSOffDay, $pageNum_RSOffDay + 1), $queryString_RSOffDay); ?>"><img src="../Img/Next.gif" /></a>
                        <?php } // Show if not last page  ?></td>
                    <td><?php if ($pageNum_RSOffDay < $totalPages_RSOffDay) { // Show if not last page   ?>
                            <a href="<?php printf("%s?pageNum_RSOffDay=%d%s", $currentPage, $totalPages_RSOffDay, $queryString_RSOffDay); ?>"><img src="../Img/Last.gif" /></a>
                        <?php } // Show if not last page  ?></td>
                </tr>
            </table>
    </body>
</html>
<?php
mysql_free_result($RSOffDay);
?>
