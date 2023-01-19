<?php require_once('../Connections/HRMS.php'); ?>
<?php
require_once('../Classes/Class_AccessLevel.php');
$obj_AccessLevel = new AccessLevel();
echo $obj_AccessLevel->CHK_AccessLevel();
?>

<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RSEquipmenthandOverDisplay = 5;
$pageNum_RSEquipmenthandOverDisplay = 0;
if (isset($_GET['pageNum_RSEquipmenthandOverDisplay'])) {
    $pageNum_RSEquipmenthandOverDisplay = $_GET['pageNum_RSEquipmenthandOverDisplay'];
}
$startRow_RSEquipmenthandOverDisplay = $pageNum_RSEquipmenthandOverDisplay * $maxRows_RSEquipmenthandOverDisplay;

mysql_select_db($database_HRMS, $HRMS)
;
if (isset($_GET['ID']))
    $query_RSEquipmenthandOverDisplay = "SELECT * FROM equipment_handover WHERE ID='" . $_GET['ID'] . "'";
else
    $query_RSEquipmenthandOverDisplay = "SELECT * FROM equipment_handover";

$query_limit_RSEquipmenthandOverDisplay = sprintf("%s LIMIT %d, %d", $query_RSEquipmenthandOverDisplay, $startRow_RSEquipmenthandOverDisplay, $maxRows_RSEquipmenthandOverDisplay);
$RSEquipmenthandOverDisplay = mysql_query($query_limit_RSEquipmenthandOverDisplay, $HRMS) or die(mysql_error());
$row_RSEquipmenthandOverDisplay = mysql_fetch_assoc($RSEquipmenthandOverDisplay);

if (isset($_GET['totalRows_RSEquipmenthandOverDisplay'])) {
    $totalRows_RSEquipmenthandOverDisplay = $_GET['totalRows_RSEquipmenthandOverDisplay'];
} else {
    $all_RSEquipmenthandOverDisplay = mysql_query($query_RSEquipmenthandOverDisplay);
    $totalRows_RSEquipmenthandOverDisplay = mysql_num_rows($all_RSEquipmenthandOverDisplay);
}
$totalPages_RSEquipmenthandOverDisplay = ceil($totalRows_RSEquipmenthandOverDisplay / $maxRows_RSEquipmenthandOverDisplay) - 1;

$queryString_RSEquipmenthandOverDisplay = "";
if (!empty($_SERVER['QUERY_STRING'])) {
    $params = explode("&", $_SERVER['QUERY_STRING']);
    $newParams = array();
    foreach ($params as $param) {
        if (stristr($param, "pageNum_RSEquipmenthandOverDisplay") == false &&
                stristr($param, "totalRows_RSEquipmenthandOverDisplay") == false) {
            array_push($newParams, $param);
        }
    }
    if (count($newParams) != 0) {
        $queryString_RSEquipmenthandOverDisplay = "&" . htmlentities(implode("&", $newParams));
    }
}
$queryString_RSEquipmenthandOverDisplay = sprintf("&totalRows_RSEquipmenthandOverDisplay=%d%s", $totalRows_RSEquipmenthandOverDisplay, $queryString_RSEquipmenthandOverDisplay);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Untitled Document</title>
    </head>

    <body>
        <font color="#FF6600" size="+1" > <p align="center">Equipment Handover Data Display</p>
            <p align="center">&nbsp;</p>
        </font>
        <?php
        $_GET['TableName'] = "equipment_handover";

        $_GET['OpenPage'] = "EquipmentHandOverdisplay";

        require_once($base_path . "Search_Name/SearchName.php");
        ?>
        <table  cellpadding="0" align="center" border="1" bordercolor="#FF6600"> 
            <tr>
                <td width="61">Operation</td>
                <td width="223">ID</td>
                <td width="271">FirstName</td>
                <td width="287">MiddelName</td>
                <td width="270">LastName</td>
                <td width="308">EquipmentName</td>
                <td width="282">Taken_Date</td>
                <td width="322">Replacement_Date</td>
                <td width="301">Returning_Date</td>
                <td width="263">Returned</td>
            </tr>
            <?php do { ?>
                <tr>
                    <td><a  target="_blank" href="../Equipment_HandOver/Equipment_Handover_Database_Update/EquipmentHandOverUpdate.php?Auto_ID=<?php echo $row_RSEquipmenthandOverDisplay['Auto_ID']; ?>"  ><?php echo "<p>Update</p> </a>"; ?></a>

                        <a  href="javascript: if (confirm('Are You Sure You want to Delete the Equipmnet Handover data record?')) { window.location.href='EquipmenthandOverDelete.php?Auto_ID=<?php echo $row_RSEquipmenthandOverDisplay['Auto_ID']; ?>' } else { void('') }; "
                            ><?php echo "Delete </a>"; ?></a> <br /></td>
                    <td><?php echo $row_RSEquipmenthandOverDisplay['ID']; ?></td>
                    <td><?php echo $row_RSEquipmenthandOverDisplay['FirstName']; ?></td>
                    <td><?php echo $row_RSEquipmenthandOverDisplay['MiddelName']; ?></td>
                    <td><?php echo $row_RSEquipmenthandOverDisplay['LastName']; ?></td>
                    <td><?php echo $row_RSEquipmenthandOverDisplay['EquipmentName']; ?></td>
                    <td><?php echo $row_RSEquipmenthandOverDisplay['Taken_Date']; ?></td>
                    <td><?php echo $row_RSEquipmenthandOverDisplay['Replacement_Date']; ?></td>
                    <td><?php echo $row_RSEquipmenthandOverDisplay['Returning_Date']; ?></td>
                    <td><?php echo $row_RSEquipmenthandOverDisplay['Returned']; ?></td>
                </tr>
            <?php } while ($row_RSEquipmenthandOverDisplay = mysql_fetch_assoc($RSEquipmenthandOverDisplay)); ?>
        </table>
        <table width="333" height="46" border="0" align="center">
            <tr>
                <td><?php if ($pageNum_RSEquipmenthandOverDisplay > 0) { // Show if not first page    ?>
                        <a href="<?php printf("%s?pageNum_RSEquipmenthandOverDisplay=%d%s", $currentPage, 0, $queryString_RSEquipmenthandOverDisplay); ?>"><img src="../Img/First.gif" /></a>
                    <?php } // Show if not first page  ?></td>
                <td><?php if ($pageNum_RSEquipmenthandOverDisplay > 0) { // Show if not first page   ?>
                        <a href="<?php printf("%s?pageNum_RSEquipmenthandOverDisplay=%d%s", $currentPage, max(0, $pageNum_RSEquipmenthandOverDisplay - 1), $queryString_RSEquipmenthandOverDisplay); ?>"><img src="../Img/Previous.gif" /></a>
                    <?php } // Show if not first page  ?></td>
                <td><?php if ($pageNum_RSEquipmenthandOverDisplay < $totalPages_RSEquipmenthandOverDisplay) { // Show if not last page   ?>
                        <a href="<?php printf("%s?pageNum_RSEquipmenthandOverDisplay=%d%s", $currentPage, min($totalPages_RSEquipmenthandOverDisplay, $pageNum_RSEquipmenthandOverDisplay + 1), $queryString_RSEquipmenthandOverDisplay); ?>"><img src="../Img/Next.gif" /></a>
                    <?php } // Show if not last page  ?></td>
                <td><?php if ($pageNum_RSEquipmenthandOverDisplay < $totalPages_RSEquipmenthandOverDisplay) { // Show if not last page   ?>
                        <a href="<?php printf("%s?pageNum_RSEquipmenthandOverDisplay=%d%s", $currentPage, $totalPages_RSEquipmenthandOverDisplay, $queryString_RSEquipmenthandOverDisplay); ?>"><img src="../Img/Last.gif" /></a>
                    <?php } // Show if not last page  ?></td>
            </tr>
        </table>
    </body>
</html>
<?php
mysql_free_result($RSEquipmenthandOverDisplay);
?>
