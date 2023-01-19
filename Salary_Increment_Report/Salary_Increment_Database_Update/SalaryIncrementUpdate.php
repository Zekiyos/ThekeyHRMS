
<?php
/* Database Class Including to the page** */
if (!defined('validurl'))
    define("validurl", TRUE);
$base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
require_once $base_path . 'config/database.php';
require_once $base_path . 'lib/database.php';

$mydb = new DataBase();
?>
<?php require_once('../../Connections/HRMS.php'); ?>


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
                $editFormAction = $_SERVER['PHP_SELF'];
                if (isset($_SERVER['QUERY_STRING'])) {
                    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
                }

                if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

                    $data = array('ID' => $_POST['ID']
                        , 'No_Year' => $_POST['No_Year']
                        , 'Salary_Increment' => $_POST['Salary_Increment']);

                    $mydb->where(array('Initial_Salary' => $_POST['Initial_Salary']));
                    $Result1 = $mydb->update('wage_allocation', $data);

                    $updateGoTo = "index.php";
                    if (isset($_SERVER['QUERY_STRING'])) {
                        $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
                        $updateGoTo .= $_SERVER['QUERY_STRING'];
                    }
                    header(sprintf("Location: %s", $updateGoTo));
                }
                ?>
                <?php
                mysql_select_db($database_HRMS, $HRMS);
                if (isset($_GET['Initial_Salary'])) {

                    $query_RSSalaryIncrementUpdate = "SELECT * FROM wage_allocation Where Initial_Salary='" . $_GET['Initial_Salary'] . "'";
                }
                else
                    $query_RSSalaryIncrementUpdate = "SELECT * FROM wage_allocation where Initial_Salary=-1";
//$query_RSSalaryIncrementUpdate = "SELECT * FROM wage_allocation";
                $RSSalaryIncrementUpdate = mysql_query($query_RSSalaryIncrementUpdate, $HRMS) or die(mysql_error());
                $row_RSSalaryIncrementUpdate = mysql_fetch_assoc($RSSalaryIncrementUpdate);
                $totalRows_RSSalaryIncrementUpdate = mysql_num_rows($RSSalaryIncrementUpdate);
                ?>
                <p align="center">
                    <font color="#FF6600" size="+1" >Salary Increment Setting Definition Update Form</font></p>
                <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                    <table align="center">
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Initial Salary:</td>
                            <td><?php echo $row_RSSalaryIncrementUpdate['Initial_Salary']; ?></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">No of Year:</td>
                            <td><input type="text" name="No_Year" value="<?php echo htmlentities($row_RSSalaryIncrementUpdate['No_Year'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Salary After Increment:</td>
                            <td><input type="text" name="Salary_Increment" value="<?php echo htmlentities($row_RSSalaryIncrementUpdate['Salary_Increment'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">&nbsp;</td>
                            <td><input type="submit" value="Update record" /></td>
                        </tr>
                    </table>
                    <input type="hidden" name="MM_update" value="form1" />
                    <input type="hidden" name="Initial_Salary" value="<?php echo $row_RSSalaryIncrementUpdate['Initial_Salary']; ?>" />
                </form>
                <!-- InstanceEndEditable -->
            </div>
        </div>
    </body>
    <!-- InstanceEnd --> 
</html>