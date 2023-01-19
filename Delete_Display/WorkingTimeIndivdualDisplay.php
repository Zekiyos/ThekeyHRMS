<?php require_once('../Connections/HRMS.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RSworkingTimesettingIndividual = 6;
$pageNum_RSworkingTimesettingIndividual = 0;
if (isset($_GET['pageNum_RSworkingTimesettingIndividual'])) {
    $pageNum_RSworkingTimesettingIndividual = $_GET['pageNum_RSworkingTimesettingIndividual'];
}
$startRow_RSworkingTimesettingIndividual = $pageNum_RSworkingTimesettingIndividual * $maxRows_RSworkingTimesettingIndividual;

mysql_select_db($database_HRMS, $HRMS);
$query_RSworkingTimesettingIndividual = "SELECT * FROM working_time_setting_individual ORDER BY ID ASC";
$query_limit_RSworkingTimesettingIndividual = sprintf("%s LIMIT %d, %d", $query_RSworkingTimesettingIndividual, $startRow_RSworkingTimesettingIndividual, $maxRows_RSworkingTimesettingIndividual);
$RSworkingTimesettingIndividual = mysql_query($query_limit_RSworkingTimesettingIndividual, $HRMS) or die(mysql_error());
$row_RSworkingTimesettingIndividual = mysql_fetch_assoc($RSworkingTimesettingIndividual);

if (isset($_GET['totalRows_RSworkingTimesettingIndividual'])) {
    $totalRows_RSworkingTimesettingIndividual = $_GET['totalRows_RSworkingTimesettingIndividual'];
} else {
    $all_RSworkingTimesettingIndividual = mysql_query($query_RSworkingTimesettingIndividual);
    $totalRows_RSworkingTimesettingIndividual = mysql_num_rows($all_RSworkingTimesettingIndividual);
}
$totalPages_RSworkingTimesettingIndividual = ceil($totalRows_RSworkingTimesettingIndividual / $maxRows_RSworkingTimesettingIndividual) - 1;

$queryString_RSworkingTimesettingIndividual = "";
if (!empty($_SERVER['QUERY_STRING'])) {
    $params = explode("&", $_SERVER['QUERY_STRING']);
    $newParams = array();
    foreach ($params as $param) {
        if (stristr($param, "pageNum_RSworkingTimesettingIndividual") == false &&
                stristr($param, "totalRows_RSworkingTimesettingIndividual") == false) {
            array_push($newParams, $param);
        }
    }
    if (count($newParams) != 0) {
        $queryString_RSworkingTimesettingIndividual = "&" . htmlentities(implode("&", $newParams));
    }
}
$queryString_RSworkingTimesettingIndividual = sprintf("&totalRows_RSworkingTimesettingIndividual=%d%s", $totalRows_RSworkingTimesettingIndividual, $queryString_RSworkingTimesettingIndividual);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Untitled Document</title>
    </head>

    <body>
        <font color="#FF6600" size="+1" > <p align="center">Working Time Setting Individual Data Display</p></font>
        <?php
        $_GET['TableName'] = "working_time_setting_individual";

        $_GET['OpenPage'] = "WorkingTimeIndivdualDisplay";

        require_once($base_path . "Search_Name/SearchName.php");
        ?>
        <table  cellpadding="0" align="center" border="1" bordercolor="#FF6600"> 
            <tr>
                <td>Operation</td>
                <td>ID</td>
                <td>FirstName</td>
                <td>MiddelName</td>
                <td>LastName</td>
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
                        <a  target="_blank" href="../Attendance_System/Biometric_Attendance_Database_Update/WorkingTimeIndivdual_Update/WorkingTimeIndivdualUpdate.php?Auto_ID=<?php echo $row_RSworkingTimesettingIndividual['Auto_ID'] ?>" ><?php echo "<p>Update</p> </a>"; ?></a>

                        <a  href="javascript: if (confirm('Are You Sure You want to Delete this employee Working Time Setting data record?')) { window.location.href='WorkingTimeIndivdualDelete.php?Auto_ID=<?php echo $row_RSworkingTimesettingIndividual['Auto_ID']; ?>' } else { void('') }; "
                            ><?php echo "Delete </a>"; ?></a> <br /></td>
                    <td><?php echo $row_RSworkingTimesettingIndividual['ID']; ?></td>
                    <td><?php echo $row_RSworkingTimesettingIndividual['FirstName']; ?></td>
                    <td><?php echo $row_RSworkingTimesettingIndividual['MiddelName']; ?></td>
                    <td><?php echo $row_RSworkingTimesettingIndividual['LastName']; ?></td>
                    <td><?php echo $row_RSworkingTimesettingIndividual['Department']; ?></td>
                    <td><?php echo $row_RSworkingTimesettingIndividual['From_Date']; ?></td>
                    <td><?php echo $row_RSworkingTimesettingIndividual['To_Date']; ?></td>
                    <td><?php echo $row_RSworkingTimesettingIndividual['Start']; ?></td>
                    <td><?php echo $row_RSworkingTimesettingIndividual['Start_Break']; ?></td>
                    <td><?php echo $row_RSworkingTimesettingIndividual['End_Break']; ?></td>
                    <td><?php echo $row_RSworkingTimesettingIndividual['End']; ?></td>
                </tr>
            <?php } while ($row_RSworkingTimesettingIndividual = mysql_fetch_assoc($RSworkingTimesettingIndividual)); ?>
        </table>
        <p>&nbsp;
            <table width="406" height="44" border="0" align="center">
                <tr>
                    <td><?php if ($pageNum_RSworkingTimesettingIndividual > 0) { // Show if not first page    ?>
                            <a href="<?php printf("%s?pageNum_RSworkingTimesettingIndividual=%d%s", $currentPage, 0, $queryString_RSworkingTimesettingIndividual); ?>"><img src="../Img/First.gif" /></a>
                        <?php } // Show if not first page  ?></td>
                    <td><?php if ($pageNum_RSworkingTimesettingIndividual > 0) { // Show if not first page   ?>
                            <a href="<?php printf("%s?pageNum_RSworkingTimesettingIndividual=%d%s", $currentPage, max(0, $pageNum_RSworkingTimesettingIndividual - 1), $queryString_RSworkingTimesettingIndividual); ?>"><img src="../Img/Previous.gif" /></a>
                        <?php } // Show if not first page  ?></td>
                    <td><?php if ($pageNum_RSworkingTimesettingIndividual < $totalPages_RSworkingTimesettingIndividual) { // Show if not last page   ?>
                            <a href="<?php printf("%s?pageNum_RSworkingTimesettingIndividual=%d%s", $currentPage, min($totalPages_RSworkingTimesettingIndividual, $pageNum_RSworkingTimesettingIndividual + 1), $queryString_RSworkingTimesettingIndividual); ?>"><img src="../Img/Next.gif" /></a>
                        <?php } // Show if not last page  ?></td>
                    <td><?php if ($pageNum_RSworkingTimesettingIndividual < $totalPages_RSworkingTimesettingIndividual) { // Show if not last page   ?>
                            <a href="<?php printf("%s?pageNum_RSworkingTimesettingIndividual=%d%s", $currentPage, $totalPages_RSworkingTimesettingIndividual, $queryString_RSworkingTimesettingIndividual); ?>"><img src="../Img/Last.gif" /></a>
                        <?php } // Show if not last page  ?></td>
                </tr>
            </table>
        </p>
    </body>
</html>
<?php
mysql_free_result($RSworkingTimesettingIndividual);
?>
