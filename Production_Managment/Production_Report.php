
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
                include("../Report/Chart/FusionCharts.php");
                include('../Report/Chart/FusionCharts_Gen.php');


                //In this example, using FusionCharts PHP Class
                //we plot a multiseries chart from data contained in arrays

                /* The arrays need to be of the following  structure :

                  1. Array to store Category Names :

                  A single dimensional array storing the category names

                  2. A 2 Dimensional Array to store data values

                 * * Each row will store data for 1 dataset

                  Column 1 will store : Dataset Series Name.
                  Column 2 will store : Dataset attributes
                  (as list separated by delimiter.)
                  Column 3 and rest will store : values of the dataset

                 */
                //Let's store the sales data for six products in our array. We also store the name of products.
                //Store Name of Products
//                $arrCatNames[0] = "Product A";
//                $arrCatNames[1] = "Product B";
//                $arrCatNames[2] = "Product C";
//                $arrCatNames[3] = "Product D";
//                $arrCatNames[4] = "Product E";
//                $arrCatNames[5] = "Product F";
//                //Store sales data for current year
//                $arrData[0][0] = "Current Year";
//                $arrData[0][1] = ""; // Dataset Parameters
//                $arrData[0][2] = 567500;
//                $arrData[0][3] = 815300;
//                $arrData[0][4] = 556800;
//                $arrData[0][5] = 734500;
//                $arrData[0][6] = 676800;
//                $arrData[0][7] = 648500;
//                //Store sales data for previous year
//                $arrData[1][0] = "Previous Year";
//                $arrData[1][1] = ""; // Dataset Parameter
//                $arrData[1][2] = 547300;
//                $arrData[1][3] = 584500;
//                $arrData[1][4] = 754000;
//                $arrData[1][5] = 456300;
//                $arrData[1][6] = 754500;
//                $arrData[1][7] = 437600;

             
                ?>


                <?php
                include('../Classes/Class_Production_Managment.php');

                $objPM = new Production_Managment();

                $editFormAction = $_SERVER['PHP_SELF'];
                if (isset($_SERVER['QUERY_STRING'])) {
                    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
                }
                if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
                    $accountGroup = $_POST['Account_Group'];
                    $date = $_POST['Date'];

                    $accountList = $objPM->getAccountList($accountGroup);
                    $productionData = array();
                    foreach ($accountList as $key => $value) {
                        array_push($productionData, $objPM->generateAccountProductionPerWorkingDetail($value, $date));
						
                    }

                   list($arrData, $arrCatNames)= $objPM->reorderArrayData($productionData);

                    
                       # Create FusionCharts PHP Class object for multiseries column3d chart
                $FC = new FusionCharts("MSLine", "600", "300");

                # Set Relative Path of chart SWF file.
                $FC->setSwfPath("../Charts/");

                # Define chart attributes
                $strParam = "caption=Sales by Product;numberPrefix=$;formatNumberScale=1;rotateValues=1;decimalPrecision=0";

                # Set chart attributes
                $FC->setChartParams($strParam);

                # Pass the two arrays storing data and category names to
                # FusionCharts PHP Class function addChartDataFromArray
                $FC->addChartDataFromArray($arrData, $arrCatNames);

                # Render the Chart 
                $FC->renderChart();
                    
                    $objPM->generateReportArray($productionData);
                } else {
                    ?>

                    <?php
                    echo '<h1 class="form_lable">';
                    echo 'Production Report Selection Form';
                    echo "</h1>";
                    ?>
                    <form action="<?php echo $editFormAction; ?>" method="POST" name="form1" id="form1">

                        <table  name="departmentSelection" id="departmentSelection" width="476" height="180" align="center" background="" bgcolor="#EBEBEB">
                            <tr valign="baseline">
                                <td height="2" align="right" nowrap="nowrap" colspan="1"><label for="Account_Name">Account Name</label>:</td>
                                <td>
                                    <Select name="Account_Group" >
    <?php
    $objPM->getAccountGroup();
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

                            <tr valign="baseline">
                                <td nowrap="nowrap" align="right">&nbsp;</td><td>
                                    <td>&nbsp;&nbsp;<input type="submit" value="Generate Report" /></td>
                            </tr>
                        </table>
                        <input type="hidden" name="MM_insert" value="form1" />
                    </form>

<?php }
?>

            </div>

            <!-- InstanceEndEditable -->
        </div>
    </body>
    <!-- InstanceEnd -->
</html>


