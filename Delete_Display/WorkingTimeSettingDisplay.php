<?php require_once('../Connections/HRMS.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RSWorkingTimeSettingDisplay = 6;
$pageNum_RSWorkingTimeSettingDisplay = 0;
if (isset($_GET['pageNum_RSWorkingTimeSettingDisplay'])) {
    $pageNum_RSWorkingTimeSettingDisplay = $_GET['pageNum_RSWorkingTimeSettingDisplay'];
}
$startRow_RSWorkingTimeSettingDisplay = $pageNum_RSWorkingTimeSettingDisplay * $maxRows_RSWorkingTimeSettingDisplay;

mysql_select_db($database_HRMS, $HRMS);
$query_RSWorkingTimeSettingDisplay = "SELECT * FROM working_time_setting ORDER BY working_time_setting.Department ASC";

//LEFT JOIN Department ON Department.Department=working_time_setting .Department  ;
$query_limit_RSWorkingTimeSettingDisplay = sprintf("%s LIMIT %d, %d", $query_RSWorkingTimeSettingDisplay, $startRow_RSWorkingTimeSettingDisplay, $maxRows_RSWorkingTimeSettingDisplay);
$RSWorkingTimeSettingDisplay = mysql_query($query_limit_RSWorkingTimeSettingDisplay, $HRMS) or die(mysql_error());
$row_RSWorkingTimeSettingDisplay = mysql_fetch_assoc($RSWorkingTimeSettingDisplay);

if (isset($_GET['totalRows_RSWorkingTimeSettingDisplay'])) {
    $totalRows_RSWorkingTimeSettingDisplay = $_GET['totalRows_RSWorkingTimeSettingDisplay'];
} else {
    $all_RSWorkingTimeSettingDisplay = mysql_query($query_RSWorkingTimeSettingDisplay);
    $totalRows_RSWorkingTimeSettingDisplay = mysql_num_rows($all_RSWorkingTimeSettingDisplay);
}
$totalPages_RSWorkingTimeSettingDisplay = ceil($totalRows_RSWorkingTimeSettingDisplay / $maxRows_RSWorkingTimeSettingDisplay) - 1;

$queryString_RSWorkingTimeSettingDisplay = "";
if (!empty($_SERVER['QUERY_STRING'])) {
    $params = explode("&", $_SERVER['QUERY_STRING']);
    $newParams = array();
    foreach ($params as $param) {
        if (stristr($param, "pageNum_RSWorkingTimeSettingDisplay") == false &&
                stristr($param, "totalRows_RSWorkingTimeSettingDisplay") == false) {
            array_push($newParams, $param);
        }
    }
    if (count($newParams) != 0) {
        $queryString_RSWorkingTimeSettingDisplay = "&" . htmlentities(implode("&", $newParams));
    }
}
$queryString_RSWorkingTimeSettingDisplay = sprintf("&totalRows_RSWorkingTimeSettingDisplay=%d%s", $totalRows_RSWorkingTimeSettingDisplay, $queryString_RSWorkingTimeSettingDisplay);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Untitled Document</title>
    </head>

    <body>
        <font color="#FF6600" size="+1" > <p align="center">Working Time Setting Data Display</p></font>
        <table  cellpadding="0" align="center" border="1" bordercolor="#FF6600"> 
            <tr>
                <td>Opertation</td>
                <td>Department</td>
                <td>From_Date</td>
                <td>To_Date</td>
                <td>Start</td>
                <td>Start_Break</td>
                <td>End_Break</td>
                <td>End</td>

            </tr>
            <?php do { ?>
                <tr>
                    <td>
                        <a  target="_blank" href="../Attendance_System/Biometric_Attendance_Database_Update/WorkingTimeSetting_Update/WorkingTimeSettingUpdate.php?Auto_ID=<?php echo $row_RSWorkingTimeSettingDisplay['Auto_ID'] ?>" ><?php echo "<p>Update</p> </a>"; ?></a>

                        <a  href="javascript: if (confirm('Are You Sure You want to Delete this Working Time Setting data record?')) { window.location.href='WorkingTimeSettingDelete.php?Auto_ID=<?php echo $row_RSWorkingTimeSettingDisplay['Auto_ID']; ?>' } else { void('') }; "
                            ><?php echo "Delete </a>"; ?></a> <br /></td>
                    <td><?php echo $row_RSWorkingTimeSettingDisplay['Department']; ?></td>
                    <td><?php echo $row_RSWorkingTimeSettingDisplay['From_Date']; ?></td>
                    <td><?php echo $row_RSWorkingTimeSettingDisplay['To_Date']; ?></td>
                    <td><?php echo $row_RSWorkingTimeSettingDisplay['Start']; ?></td>
                    <td><?php echo $row_RSWorkingTimeSettingDisplay['Start_Break']; ?></td>
                    <td><?php echo $row_RSWorkingTimeSettingDisplay['End_Break']; ?></td>
                    <td><?php echo $row_RSWorkingTimeSettingDisplay['End']; ?></td>

                </tr>
            <?php } while ($row_RSWorkingTimeSettingDisplay = mysql_fetch_assoc($RSWorkingTimeSettingDisplay)); ?>
        </table>
        <p>&nbsp;
            <table width="406" height="44" border="0" align="center">
                <tr>
                    <td><?php if ($pageNum_RSWorkingTimeSettingDisplay > 0) { // Show if not first page    ?>
                            <a href="<?php printf("%s?pageNum_RSWorkingTimeSettingDisplay=%d%s", $currentPage, 0, $queryString_RSWorkingTimeSettingDisplay); ?>"><img src="../Img/First.gif" /></a>
                        <?php } // Show if not first page  ?></td>
                    <td><?php if ($pageNum_RSWorkingTimeSettingDisplay > 0) { // Show if not first page    ?>
                            <a href="<?php printf("%s?pageNum_RSWorkingTimeSettingDisplay=%d%s", $currentPage, max(0, $pageNum_RSWorkingTimeSettingDisplay - 1), $queryString_RSWorkingTimeSettingDisplay); ?>"><img src="../Img/Previous.gif" /></a>
                        <?php } // Show if not first page  ?></td>
                    <td><?php if ($pageNum_RSWorkingTimeSettingDisplay < $totalPages_RSWorkingTimeSettingDisplay) { // Show if not last page    ?>
                            <a href="<?php printf("%s?pageNum_RSWorkingTimeSettingDisplay=%d%s", $currentPage, min($totalPages_RSWorkingTimeSettingDisplay, $pageNum_RSWorkingTimeSettingDisplay + 1), $queryString_RSWorkingTimeSettingDisplay); ?>"><img src="../Img/Next.gif" /></a>
                        <?php } // Show if not last page  ?></td>
                    <td><?php if ($pageNum_RSWorkingTimeSettingDisplay < $totalPages_RSWorkingTimeSettingDisplay) { // Show if not last page    ?>
                            <a href="<?php printf("%s?pageNum_RSWorkingTimeSettingDisplay=%d%s", $currentPage, $totalPages_RSWorkingTimeSettingDisplay, $queryString_RSWorkingTimeSettingDisplay); ?>"><img src="../Img/Last.gif" /></a>
                        <?php } // Show if not last page  ?></td>
                </tr>
            </table>
    </body>
</html>
<?php
mysql_free_result($RSWorkingTimeSettingDisplay);
?>
