<?php require_once('../../../Connections/HRMS.php'); ?>
<?php
require_once('../../../Classes/Class_AccessLevel.php');
$obj_AccessLevel = new AccessLevel();
echo $obj_AccessLevel->CHK_AccessLevel();
?>

<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RSAnnualLeaveDisplay = 5;
$pageNum_RSAnnualLeaveDisplay = 0;
if (isset($_GET['pageNum_RSAnnualLeaveDisplay'])) {
    $pageNum_RSAnnualLeaveDisplay = $_GET['pageNum_RSAnnualLeaveDisplay'];
}
$startRow_RSAnnualLeaveDisplay = $pageNum_RSAnnualLeaveDisplay * $maxRows_RSAnnualLeaveDisplay;

mysql_select_db($database_HRMS, $HRMS);
if (isset($_GET['ID']))
    $query_RSAnnualLeaveDisplay = "SELECT * FROM annual_leave WHERE ID='" . $_GET['ID'] . "'";
else
    $query_RSAnnualLeaveDisplay = "SELECT * FROM annual_leave ORDER BY ID ASC";

$query_limit_RSAnnualLeaveDisplay = sprintf("%s LIMIT %d, %d", $query_RSAnnualLeaveDisplay, $startRow_RSAnnualLeaveDisplay, $maxRows_RSAnnualLeaveDisplay);
$RSAnnualLeaveDisplay = mysql_query($query_limit_RSAnnualLeaveDisplay, $HRMS) or die(mysql_error());
$row_RSAnnualLeaveDisplay = mysql_fetch_assoc($RSAnnualLeaveDisplay);

if (isset($_GET['totalRows_RSAnnualLeaveDisplay'])) {
    $totalRows_RSAnnualLeaveDisplay = $_GET['totalRows_RSAnnualLeaveDisplay'];
} else {
    $all_RSAnnualLeaveDisplay = mysql_query($query_RSAnnualLeaveDisplay);
    $totalRows_RSAnnualLeaveDisplay = mysql_num_rows($all_RSAnnualLeaveDisplay);
}
$totalPages_RSAnnualLeaveDisplay = ceil($totalRows_RSAnnualLeaveDisplay / $maxRows_RSAnnualLeaveDisplay) - 1;

$queryString_RSAnnualLeaveDisplay = "";
if (!empty($_SERVER['QUERY_STRING'])) {
    $params = explode("&", $_SERVER['QUERY_STRING']);
    $newParams = array();
    foreach ($params as $param) {
        if (stristr($param, "pageNum_RSAnnualLeaveDisplay") == false &&
                stristr($param, "totalRows_RSAnnualLeaveDisplay") == false) {
            array_push($newParams, $param);
        }
    }
    if (count($newParams) != 0) {
        $queryString_RSAnnualLeaveDisplay = "&" . htmlentities(implode("&", $newParams));
    }
}
$queryString_RSAnnualLeaveDisplay = sprintf("&totalRows_RSAnnualLeaveDisplay=%d%s", $totalRows_RSAnnualLeaveDisplay, $queryString_RSAnnualLeaveDisplay);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Untitled Document</title>
    </head>

    <body>
        <font color="#FF6600" size="+2" > <p align="center">Annual Leave Data Display</p></font>
<?php
$_GET['TableName'] = "annual_leave";

$_GET['OpenPage'] = "annualleavedisplay";

require_once($base_path . "Search_Name/SearchName.php");
?>

        <table  cellpadding="0" align="center" border="1" bordercolor="#FF6600">
            <tr>
                <td>Operation</td>
                <td>ID</td>
                <td>FirstName</td>
                <td>MiddelName</td>
                <td>LastName</td>
                <td>Leavedays</td>
                <td>RestDay</td>
                <td>Leave_Taken_Date</td>
                <td>ReportOn</td>
                <td>LeaveType</td>
                <td>ModifiedBy</td>
                <td>Reported</td>
                <td>Report_Back_Date</td>
            </tr>
            <?php do { ?>
                <tr>
                    <td><a  target="_blank" href="AnnualLeaveUpdate.php?Auto_ID=<?php echo $row_RSAnnualLeaveDisplay['Auto_ID']; ?>"  ><?php echo "<p>Update</p> </a>"; ?></a>

                        <a  href="javascript: if (confirm('Are You Sure You want to Delete the Annual Leave record?')) { window.location.href='DeleteAnnualLeave.php?Auto_ID=<?php echo $row_RSAnnualLeaveDisplay['Auto_ID']; ?>' } else { void('') }; "
                            ><?php echo "Delete </a>"; ?></a> <br /><?php //echo $row_RSAnnualLeaveDsiplay['Auto_ID'];  ?></td>


                    <td><?php echo $row_RSAnnualLeaveDisplay['ID']; ?></td>
                    <td><?php echo $row_RSAnnualLeaveDisplay['FirstName']; ?></td>
                    <td><?php echo $row_RSAnnualLeaveDisplay['MiddelName']; ?></td>
                    <td><?php echo $row_RSAnnualLeaveDisplay['LastName']; ?></td>
                    <td><?php echo $row_RSAnnualLeaveDisplay['Leavedays']; ?></td>
                    <td><?php echo $row_RSAnnualLeaveDisplay['RestDay']; ?></td>
                    <td><?php echo $row_RSAnnualLeaveDisplay['Leave_Taken_Date']; ?></td>
                    <td><?php echo $row_RSAnnualLeaveDisplay['ReportOn']; ?></td>
                    <td><?php echo $row_RSAnnualLeaveDisplay['LeaveType']; ?></td>
                    <td><?php echo $row_RSAnnualLeaveDisplay['ModifiedBy']; ?></td>
                    <td><?php echo $row_RSAnnualLeaveDisplay['Reported']; ?></td>
                    <td><?php echo $row_RSAnnualLeaveDisplay['Report_Back_Date']; ?></td>
                </tr>
            <?php } while ($row_RSAnnualLeaveDisplay = mysql_fetch_assoc($RSAnnualLeaveDisplay)); ?>
        </table>
        <p></p>
        <table width="340" border="0" align="center">
            <tr>
                <td><?php if ($pageNum_RSAnnualLeaveDisplay > 0) { // Show if not first page  ?>
                        <a href="<?php printf("%s?pageNum_RSAnnualLeaveDisplay=%d%s", $currentPage, 0, $queryString_RSAnnualLeaveDisplay); ?>"><img src="../../../images/First.gif" /></a>
                    <?php } // Show if not first page  ?></td>
                <td><?php if ($pageNum_RSAnnualLeaveDisplay > 0) { // Show if not first page ?>
                        <a href="<?php printf("%s?pageNum_RSAnnualLeaveDisplay=%d%s", $currentPage, max(0, $pageNum_RSAnnualLeaveDisplay - 1), $queryString_RSAnnualLeaveDisplay); ?>"><img src="../../../images/Previous.gif" /></a>
                    <?php } // Show if not first page  ?></td>
                <td><?php if ($pageNum_RSAnnualLeaveDisplay < $totalPages_RSAnnualLeaveDisplay) { // Show if not last page ?>
                        <a href="<?php printf("%s?pageNum_RSAnnualLeaveDisplay=%d%s", $currentPage, min($totalPages_RSAnnualLeaveDisplay, $pageNum_RSAnnualLeaveDisplay + 1), $queryString_RSAnnualLeaveDisplay); ?>"><img src="../../../images/Next.gif" /></a>
                    <?php } // Show if not last page  ?></td>
                <td><?php if ($pageNum_RSAnnualLeaveDisplay < $totalPages_RSAnnualLeaveDisplay) { // Show if not last page ?>
                        <a href="<?php printf("%s?pageNum_RSAnnualLeaveDisplay=%d%s", $currentPage, $totalPages_RSAnnualLeaveDisplay, $queryString_RSAnnualLeaveDisplay); ?>"><img src="../../../images/Last.gif" /></a>
                    <?php } // Show if not last page  ?></td>
            </tr>
        </table>
    </body>
</html>
<?php
mysql_free_result($RSAnnualLeaveDisplay);
?>
