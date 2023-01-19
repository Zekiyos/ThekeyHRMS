<?php require_once('../Connections/HRMS.php'); ?>
<?php
require_once('../Classes/Class_AccessLevel.php');
$obj_AccessLevel = new AccessLevel();
echo $obj_AccessLevel->CHK_AccessLevel();
?>

<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RSFuneralLeaveDisplay = 10;
$pageNum_RSFuneralLeaveDisplay = 0;
if (isset($_GET['pageNum_RSFuneralLeaveDisplay'])) {
    $pageNum_RSFuneralLeaveDisplay = $_GET['pageNum_RSFuneralLeaveDisplay'];
}
$startRow_RSFuneralLeaveDisplay = $pageNum_RSFuneralLeaveDisplay * $maxRows_RSFuneralLeaveDisplay;

mysql_select_db($database_HRMS, $HRMS);
if (isset($_GET['ID']))
    $query_RSFuneralLeaveDisplay = "SELECT * FROM funeral_leave WHERE ID='" . $_GET['ID'] . "'";
else
    $query_RSFuneralLeaveDisplay = "SELECT * FROM funeral_leave";

$query_limit_RSFuneralLeaveDisplay = sprintf("%s LIMIT %d, %d", $query_RSFuneralLeaveDisplay, $startRow_RSFuneralLeaveDisplay, $maxRows_RSFuneralLeaveDisplay);
$RSFuneralLeaveDisplay = mysql_query($query_limit_RSFuneralLeaveDisplay, $HRMS) or die(mysql_error());
$row_RSFuneralLeaveDisplay = mysql_fetch_assoc($RSFuneralLeaveDisplay);

if (isset($_GET['totalRows_RSFuneralLeaveDisplay'])) {
    $totalRows_RSFuneralLeaveDisplay = $_GET['totalRows_RSFuneralLeaveDisplay'];
} else {
    $all_RSFuneralLeaveDisplay = mysql_query($query_RSFuneralLeaveDisplay);
    $totalRows_RSFuneralLeaveDisplay = mysql_num_rows($all_RSFuneralLeaveDisplay);
}
$totalPages_RSFuneralLeaveDisplay = ceil($totalRows_RSFuneralLeaveDisplay / $maxRows_RSFuneralLeaveDisplay) - 1;

$queryString_RSFuneralLeaveDisplay = "";
if (!empty($_SERVER['QUERY_STRING'])) {
    $params = explode("&", $_SERVER['QUERY_STRING']);
    $newParams = array();
    foreach ($params as $param) {
        if (stristr($param, "pageNum_RSFuneralLeaveDisplay") == false &&
                stristr($param, "totalRows_RSFuneralLeaveDisplay") == false) {
            array_push($newParams, $param);
        }
    }
    if (count($newParams) != 0) {
        $queryString_RSFuneralLeaveDisplay = "&" . htmlentities(implode("&", $newParams));
    }
}
$queryString_RSFuneralLeaveDisplay = sprintf("&totalRows_RSFuneralLeaveDisplay=%d%s", $totalRows_RSFuneralLeaveDisplay, $queryString_RSFuneralLeaveDisplay);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Funeral Leave Display</title>
    </head>

    <body>
        <font color="#FF6600" size="+2" > <p align="center">Funeral Leave Data Display</p></font>
        <?php
        $_GET['TableName'] = "funeral_leave";

        $_GET['OpenPage'] = "FuneralLeaveDisplay";

        require_once($base_path . "Search_Name/SearchName.php");
        ?>
        <table  cellpadding="0" align="center" border="1" bordercolor="#FF6600">  <tr>
                <td>Operation</td>
                <td>ID</td>
                <td>FirstName</td>
                <td>MiddelName</td>
                <td>LastName</td>
                <td>Department</td>
                <td>FuneralLeaveDays</td>
                <td>RestDay</td>
                <td>FuneralLeave_Taken_Date</td>
                <td>ReportOn</td>
                <td>LeaveType</td>
                <td>Reported</td>
                <td>Report_Back_Date</td>
            </tr>
            <?php do { ?>
                <tr>
                    <td><a  target="_blank" href="../Leaves/Leave Database_Update/FuneralLeave_Update/FuneralLeaveUpdate.php?Auto_ID=<?php echo $row_RSFuneralLeaveDisplay['Auto_ID']; ?>"  ><?php echo "<p>Update</p> </a>"; ?></a>

                        <a  href="javascript: if (confirm('Are You Sure You want to Delete the Funeral Leave record?')) { window.location.href='FuneralLeaveDelete.php?Auto_ID=<?php echo $row_RSFuneralLeaveDisplay['Auto_ID']; ?>' } else { void('') }; "
                            ><?php echo "Delete </a>"; ?></a> <br /></td>
                    <td><?php echo $row_RSFuneralLeaveDisplay['ID']; ?></td>
                    <td><?php echo $row_RSFuneralLeaveDisplay['FirstName']; ?></td>
                    <td><?php echo $row_RSFuneralLeaveDisplay['MiddelName']; ?></td>
                    <td><?php echo $row_RSFuneralLeaveDisplay['LastName']; ?></td>
                    <td><?php echo $row_RSFuneralLeaveDisplay['Department']; ?></td>
                    <td><?php echo $row_RSFuneralLeaveDisplay['FuneralLeaveDays']; ?></td>
                    <td><?php echo $row_RSFuneralLeaveDisplay['RestDay']; ?></td>
                    <td><?php echo $row_RSFuneralLeaveDisplay['FuneralLeave_Taken_Date']; ?></td>
                    <td><?php echo $row_RSFuneralLeaveDisplay['ReportOn']; ?></td>
                    <td><?php echo $row_RSFuneralLeaveDisplay['LeaveType']; ?></td>
                    <td><?php echo $row_RSFuneralLeaveDisplay['Reported']; ?></td>
                    <td><?php echo $row_RSFuneralLeaveDisplay['Report_Back_Date']; ?></td>
                </tr>
            <?php } while ($row_RSFuneralLeaveDisplay = mysql_fetch_assoc($RSFuneralLeaveDisplay)); ?>
        </table>
        <table width="250" border="0" align="center">
            <tr>
                <td><?php if ($pageNum_RSFuneralLeaveDisplay > 0) { // Show if not first page    ?>
                        <a href="<?php printf("%s?pageNum_RSFuneralLeaveDisplay=%d%s", $currentPage, 0, $queryString_RSFuneralLeaveDisplay); ?>"><img src="../Img/First.gif" /></a>
                    <?php } // Show if not first page  ?></td>
                <td><?php if ($pageNum_RSFuneralLeaveDisplay > 0) { // Show if not first page   ?>
                        <a href="<?php printf("%s?pageNum_RSFuneralLeaveDisplay=%d%s", $currentPage, max(0, $pageNum_RSFuneralLeaveDisplay - 1), $queryString_RSFuneralLeaveDisplay); ?>"><img src="../Img/Previous.gif" /></a>
                    <?php } // Show if not first page  ?></td>
                <td><?php if ($pageNum_RSFuneralLeaveDisplay < $totalPages_RSFuneralLeaveDisplay) { // Show if not last page   ?>
                        <a href="<?php printf("%s?pageNum_RSFuneralLeaveDisplay=%d%s", $currentPage, min($totalPages_RSFuneralLeaveDisplay, $pageNum_RSFuneralLeaveDisplay + 1), $queryString_RSFuneralLeaveDisplay); ?>"><img src="../Img/Next.gif" /></a>
                    <?php } // Show if not last page  ?></td>
                <td><?php if ($pageNum_RSFuneralLeaveDisplay < $totalPages_RSFuneralLeaveDisplay) { // Show if not last page   ?>
                        <a href="<?php printf("%s?pageNum_RSFuneralLeaveDisplay=%d%s", $currentPage, $totalPages_RSFuneralLeaveDisplay, $queryString_RSFuneralLeaveDisplay); ?>"><img src="../Img/Last.gif" /></a>
                    <?php } // Show if not last page  ?></td>
            </tr>
        </table>
    </body>
</html>
<?php
mysql_free_result($RSFuneralLeaveDisplay);
?>
