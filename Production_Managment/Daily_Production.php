
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/ThekeyPayrollSystem_main_Template.dwt" codeOutsideHTMLIsLocked="false" -->
    <head>
        <!--meta http-equiv="Content-Type" content="text/html; charset=utf-8" /-->
        <title>Thekey HRMS</title>
        <?php
        $dont_check = true;
        $port = $_SERVER['SERVER_PORT'];
        if ($port == 80) {
            $port = '';
        } else {
            $port = ':' . $port;
        }
        $appRoot = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
        $appPath = $_SERVER['SERVER_NAME'] . $port . '/ThekeyHRMS/';
        require_once $appRoot . 'Templates/head.php';
        ?>
    </head>
    <body>
        <div id="busy">
            <img alt="Am Working" src="http://<?php echo $appPath ?>images/BusyAnimation.gif"/>
        </div>
        <div id="thekey_page">
            <?php require_once $appRoot . 'Templates/header.php'; ?>
            <div id="mainContent">
                <!-- InstanceBeginEditable name="MainContent" -->
                <?php
                if (isset($_SESSION['MM_Fullname']))
                    echo '<p class="WelCome">Wel Come "' . $_SESSION['MM_Fullname'] . "\"</p>";
                ?>
                <?php
                include('../Classes/Class_Production_Managment.php');

                $objPM = new Production_Managment();

                $editFormAction = $_SERVER['PHP_SELF'];
                if (isset($_SERVER['QUERY_STRING'])) {
                    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
                }
                if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
                    $accountName = $_POST['Account_Name'];
                    $date = $_POST['Date'];
                    $unit = $_POST['Unit'];
                    $productionAmount = $_POST['Production_Amount'];
                    $objPM->enterDailyProduction($accountName, $date, $unit, $productionAmount);
                }
                ?>

                <?php
                echo '<h1 class="form_lable">';
                echo 'Daily Production Entry Form';
                echo "</h1>";
                ?>
                <?php
//                list($accountName, $accountArea, $accountNoEmployee, $productionAmount, $productionAmountPerNoEmployee
//                        , $accountAreaPerNoEmployee, $accountWorkingHourPerNoEmployee, $accountTotalEmployeeWorkingHour) = $objPM->generateAccountProductionPerWorkingDetail('Harvester-08', '2012-11-22');
//
//                echo '<table border="1">';
//                echo '<th>Account Name</th>';
//                echo '<th>Account Area</th>';
//                echo '<th>Number of Employee</th>';
//                echo '<th>Production Amount</th>';
//                echo '<th>Production Per Employee</th>';
//                echo '<th>Area Per Employee</th>';
//                echo '<th>Working Hour Per Employee</th>';
//                echo '<th>Total Employee Working Hour</th>';
//
//                echo '<tr>';
//                echo '<td>' . $accountName . '</td>';
//                echo '<td>' . $accountArea . '</td>';
//                echo '<td>' . $accountNoEmployee . '</td>';
//                echo '<td>' . $productionAmount . '</td>';
//                echo '<td>' . $productionAmountPerNoEmployee . '</td>';
//                echo '<td>' . $accountAreaPerNoEmployee . '</td>';
//                echo '<td>' . $accountWorkingHourPerNoEmployee . '</td>';
//                echo '<td>' . $accountTotalEmployeeWorkingHour . '</td>';
//                echo '</tr>';
//                echo '<td>' . '</td>';
//                echo '</table>';
                ?>
                <form action="<?php echo $editFormAction; ?>" method="POST" name="form1" id="form1">

                    <table  name="departmentSelection" id="departmentSelection" width="476" height="180" align="center" background="" bgcolor="#EBEBEB">
                        <tr valign="baseline">
                            <td height="2" align="right" nowrap="nowrap" colspan="1"><label for="Account_Name">Account Name</label>:</td>
                            <td>
                                <Select name="Account_Name" >
<?php
$objPM->getAccountName();
?>
                                </select>
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td height="2" align="right" nowrap="nowrap" colspan="1"><label for="Date">Production Date</label>:</td>
                            <td>
                                <input  type="Date" name="Date"/>

                            </td>
                        </tr>
                        <td height="2" align="right" nowrap="nowrap" colspan="1"><label for="Account_Name">Unit</label>:</td>
                        <td>
                            <Select name="Unit" >
<?php
$objPM->getUnit();
?>
                            </select>
                        </td>
                        </tr>
                        <tr valign="baseline">
                            <td height="2" align="right" nowrap="nowrap" colspan="1"><label for="Production Amount">Production Amount</label>:</td>
                            <td>
                                <input name="Production_Amount" type="text" >
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">&nbsp;</td><td>
                                <td>&nbsp;&nbsp;<input type="submit" value="Register" /></td>
                        </tr>
                    </table>
                    <input type="hidden" name="MM_insert" value="form1" />
                </form>



            </div>

            <!-- InstanceEndEditable -->
        </div>
    </body>
    <!-- InstanceEnd -->
</html>


