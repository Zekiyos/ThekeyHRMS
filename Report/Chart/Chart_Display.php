 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/ThekeyHRMS_main_Template.dwt" codeOutsideHTMLIsLocked="false" -->
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

        $base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
        require_once $base_path . 'Templates/head.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/Classes/report.php';
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
                echo '<p class="WelCome">Wel Come "' . $_SESSION['MM_Fullname'] . "\"</p>";
                if ((isset($_REQUEST['Chart']))) {

                    $header_lable = ucfirst(str_replace('_', ' ', $_REQUEST['Chart'])) . ' Chart';
                    echo '<h1 class="form_lable">'
                    . $header_lable . '</h1>';
                }
                ?>
                <?php if (!isset($_GET['export'])) { ?>
                    <div id="popup_update"></div>
                    <?php
                    $port = $_SERVER['SERVER_PORT'];
                    if ($port == 80) {
                        $port = '';
                    } else {
                        if (!preg_match('/[:]/', $port))
                            $port = ':' . $port;
                    }
                    $nbase_url = $_SERVER['SERVER_NAME'] . $port;

                    $nbase_url = 'http://' . $nbase_url . '/' . $_SERVER['PHP_SELF'];
                    if (isset($_GET['report'])) {
                        $nbase_url .= '?chart=' . $_GET['chart'] . '&No_Record=30';
                    } else {
                        $nbase_url .='?';
                    }
                    ?>
                    <div id="export_tool_bar">
                        <ul>
                            <?php
                            echo '<li>';
                            echo '<label  style="margin-left: 50px;">Quick Find:</label>';
                            echo '<input type="text" id="quickfind" style="width: 200px; height: 20px; 
                                background: url("../images/input_bg.png") repeat scroll 0 0 transparent;
                                border: 1px solid gray;    border-radius: 6px 6px 6px 6px;"  />';
                            //echo '<input type="button" id="hidefilters" value="hide Filters" style="margin-left: 10px;" />';
                            echo '<input type="button" style="margin-left: 10px;margin-right: 10px;" id="cleanfilters" value="Clear Filters" />';
                            echo '</li>';
                            echo '<li>';
                            echo "<input style=\"float: left;\" type=button value=\"Print Out\" onclick=\"PrintContent('ThekeyHRMSReport')\" align=\"right\" />";
                            echo '</li>';
                            ?>
                            <li><a href="<?php echo $nbase_url . '&Export=XL' ?>" target="_blank"><img src="http://<?php echo $appPath ?>images/excel.png" alt="Export As Excel File" title="Export As Excel File"/></a></li>
                        </ul>
                    </div>

                    <?php
                    ?>
                    <div id="grid_view_content">
                        <?php
                        echo '<div id="ThekeyHRMSReport">';

                        if (isset($_GET['Chart'])) {
                            echo "<a  onclick=\"javascript:toggle('ThekeyHRMSChart')\" class=\"expand ui-icon ui-icon-circle-minus\"></a>Chart";
                            echo '<div id="ThekeyHRMSChart"  >';

                            $chartName = $_GET['Chart'];

                            if (isset($chartName)) {

                                include("FusionCharts.php");
                                include('FusionCharts_Gen.php');

                                require_once $appRoot . '/Classes/Class_Chart.php';

                                $objChart = new Chart();

                                list($Chart_Name, $Chart_Caption, $Chart_Type, $X_axis_Title,
                                        $X_axis_Category_Field, $Y_axis_Title, $Y_axis_Summary_Field,
                                        $Y_axis_Summary_Value, $Series_Field_Summary, $Series_Field, $Table_Name, $Join_Table, $Where_Clause) =
                                        $objChart->get_Chart_Defintion($chartName);

                                if (strtoupper($Table_Name) != 'USER_DEFINED_CHART') {
                                    require_once $appRoot . 'Report/Chart/Chart_Filter.php';
                                }
                                require_once $appRoot . 'Report/Chart/Chart_Option.php';


                                if (isset($_POST['chartType']))
                                    $chartType = $_POST['chartType'];

                                if (isset($_POST['showName']))
                                    $showName = $_POST['showName'];
                                else
                                if (isset($_GET['showName']))
                                    $showName = $_GET['showName'];
                                else
                                    $showName = 1;


                                if (isset($_POST['chartHeight'])) {
                                    $chartHeight = $_POST['chartHeight'];
                                } else if (isset($_GET['chartHeight'])) {
                                    $chartHeight = $_GET['chartHeight'];
                                } else {
                                    $chartHeight = 650;
                                }

                                if (isset($_POST['chartWidth'])) {
                                    $chartWidth = $_POST['chartWidth'];
                                } else
                                if (isset($_GET['chartWidth'])) {
                                    $chartWidth = $_GET['chartWidth'];
                                } else {
                                    $chartWidth = 850;
                                }

                                if (isset($_POST['chartSplit'])) {
                                    $chartSplit = $_POST['chartSplit'];
                                } else
                                if (isset($_GET['chartSplit'])) {
                                    $chartSplit = $_GET['chartSplit'];
                                }else
                                    $chartSplit = 1;


                                if (isset($_POST['rotateNames'])) {
                                    $rotateNames = $_POST['rotateNames'];
                                } else if (isset($_GET['rotateNames'])) {
                                    $rotateNames = $_GET['rotateNames'];
                                }else
                                    $rotateNames = 0;


                                $objChart->generate_Series_Chart($chartName, $chartWidth, $chartHeight, $showName, $chartSplit, $rotateNames);
                            }

                            echo '</div>';
                        }

                        $fileName = $header_lable . " Excel Export ";

                        if (isset($_GET['Export'])) {
                            $objChart->XL_Export($_SESSION['chartSql'], $fileName);
                        }

                        echo '</div>';
                        ?>
                    </div>

                <?php } ?>

                <!-- InstanceEndEditable -->
            </div>
        </div>

    </body>
    <!-- InstanceEnd --></html>






