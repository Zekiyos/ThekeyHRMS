<?php require_once('../../Connections/HRMS.php'); ?>
<?php
require_once('../../Classes/Class_AccessLevel.php');
$obj_AccessLevel = new AccessLevel();
echo $obj_AccessLevel->CHK_AccessLevel();
?>
<?php require_once('../../Classes/Class_language.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/ThekeyHRMS_main_Template.dwt" codeOutsideHTMLIsLocked="false" -->
    <head>
        <!--meta http-equiv="Content-Type" content="text/html; charset=utf-8" /-->
        <title>Thekey HRMS</title>
        <?php
        $base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
        require_once $base_path . 'Templates/head.php';
        ?>
    </head>

    <body>
        <div id="busy" >
            <img alt="Am Working" src="http://<?php echo $base_url ?>images/BusyAnimation.gif">
        </div>
        <div id="thekey_page">
            <?php require_once $base_path . 'Templates/header.php'; ?>

            <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" -->
                <?php
                $currentPage = $_SERVER["PHP_SELF"];
                ?>
                <?php
                $maxRows_RSSalaryIncrementDisplay = 5;
                $pageNum_RSSalaryIncrementDisplay = 0;
                if (isset($_GET['pageNum_RSSalaryIncrementDisplay'])) {
                    $pageNum_RSSalaryIncrementDisplay = $_GET['pageNum_RSSalaryIncrementDisplay'];
                }
                $startRow_RSSalaryIncrementDisplay = $pageNum_RSSalaryIncrementDisplay * $maxRows_RSSalaryIncrementDisplay;

                mysql_select_db($database_HRMS, $HRMS);
                $query_RSSalaryIncrementDisplay = "SELECT * FROM wage_allocation";
                $query_limit_RSSalaryIncrementDisplay = sprintf("%s LIMIT %d, %d", $query_RSSalaryIncrementDisplay, $startRow_RSSalaryIncrementDisplay, $maxRows_RSSalaryIncrementDisplay);
                $RSSalaryIncrementDisplay = mysql_query($query_limit_RSSalaryIncrementDisplay, $HRMS) or die(mysql_error());
                $row_RSSalaryIncrementDisplay = mysql_fetch_assoc($RSSalaryIncrementDisplay);

                if (isset($_GET['totalRows_RSSalaryIncrementDisplay'])) {
                    $totalRows_RSSalaryIncrementDisplay = $_GET['totalRows_RSSalaryIncrementDisplay'];
                } else {
                    $all_RSSalaryIncrementDisplay = mysql_query($query_RSSalaryIncrementDisplay);
                    $totalRows_RSSalaryIncrementDisplay = mysql_num_rows($all_RSSalaryIncrementDisplay);
                }
                $totalPages_RSSalaryIncrementDisplay = ceil($totalRows_RSSalaryIncrementDisplay / $maxRows_RSSalaryIncrementDisplay) - 1;

                $queryString_RSSalaryIncrementDisplay = "";
                if (!empty($_SERVER['QUERY_STRING'])) {
                    $params = explode("&", $_SERVER['QUERY_STRING']);
                    $newParams = array();
                    foreach ($params as $param) {
                        if (stristr($param, "pageNum_RSSalaryIncrementDisplay") == false &&
                                stristr($param, "totalRows_RSSalaryIncrementDisplay") == false) {
                            array_push($newParams, $param);
                        }
                    }
                    if (count($newParams) != 0) {
                        $queryString_RSSalaryIncrementDisplay = "&" . htmlentities(implode("&", $newParams));
                    }
                }
                $queryString_RSSalaryIncrementDisplay = sprintf("&totalRows_RSSalaryIncrementDisplay=%d%s", $totalRows_RSSalaryIncrementDisplay, $queryString_RSSalaryIncrementDisplay);
                ?>
                <font color="#FF6600" size="+1" > <p align="center">Salary Increment Setting Definition Data </p></font>
                <table  cellpadding="0" align="center" border="1" bordercolor="#FF6600"> 
                    <tr>
                        <td>Operation</td>
                        <td>Initial_Salary</td>
                        <td>No_Year</td>
                        <td>Salary_Increment</td>
                    </tr>
                    <?php do { ?>
                        <tr>
                            <td>
                                <a  target="_blank" href="SalaryIncrementUpdate.php?Initial_Salary=<?php echo $row_RSSalaryIncrementDisplay['Initial_Salary'] ?>" ><?php echo "<p>Update</p> </a>"; ?></a>

                                <a  href="javascript: if (confirm('Are You Sure You want to Delete the specified Salary Increment Setting Defination data record?')) { window.location.href='SalaryIncrementDelete.php?Initial_Salary=<?php echo $row_RSSalaryIncrementDisplay['Initial_Salary']; ?>' } else { void('') }; "
                                    ><?php echo "Delete </a>"; ?></a> <br /></td>

                            <td><?php echo $row_RSSalaryIncrementDisplay['Initial_Salary']; ?></td>
                            <td><?php echo $row_RSSalaryIncrementDisplay['No_Year']; ?></td>
                            <td><?php echo $row_RSSalaryIncrementDisplay['Salary_Increment']; ?></td>
                        </tr>
                    <?php } while ($row_RSSalaryIncrementDisplay = mysql_fetch_assoc($RSSalaryIncrementDisplay)); ?>
                </table>
                <table border="0" align="center">
                    <tr>
                        <td><?php if ($pageNum_RSSalaryIncrementDisplay > 0) { // Show if not first page      ?>
                                <a href="<?php printf("%s?pageNum_RSSalaryIncrementDisplay=%d%s", $currentPage, 0, $queryString_RSSalaryIncrementDisplay); ?>"><img src="../../Img/First.gif" /></a>
                            <?php } // Show if not first page  ?></td>
                        <td><?php if ($pageNum_RSSalaryIncrementDisplay > 0) { // Show if not first page      ?>
                                <a href="<?php printf("%s?pageNum_RSSalaryIncrementDisplay=%d%s", $currentPage, max(0, $pageNum_RSSalaryIncrementDisplay - 1), $queryString_RSSalaryIncrementDisplay); ?>"><img src="../../Img/Previous.gif" /></a>
                            <?php } // Show if not first page  ?></td>
                        <td><?php if ($pageNum_RSSalaryIncrementDisplay < $totalPages_RSSalaryIncrementDisplay) { // Show if not last page      ?>
                                <a href="<?php printf("%s?pageNum_RSSalaryIncrementDisplay=%d%s", $currentPage, min($totalPages_RSSalaryIncrementDisplay, $pageNum_RSSalaryIncrementDisplay + 1), $queryString_RSSalaryIncrementDisplay); ?>"><img src="../../Img/Next.gif" /></a>
                            <?php } // Show if not last page  ?></td>
                        <td><?php if ($pageNum_RSSalaryIncrementDisplay < $totalPages_RSSalaryIncrementDisplay) { // Show if not last page      ?>
                                <a href="<?php printf("%s?pageNum_RSSalaryIncrementDisplay=%d%s", $currentPage, $totalPages_RSSalaryIncrementDisplay, $queryString_RSSalaryIncrementDisplay); ?>"><img src="../../Img/Last.gif" /></a>
                            <?php } // Show if not last page  ?></td>
                    </tr>
                </table>
                <!-- InstanceEndEditable -->
            </div>
        </div>
    </body>
    <!-- InstanceEnd --> 
</html>
<?php
mysql_free_result($RSSalaryIncrementDisplay);
?>

