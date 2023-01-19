 
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
                require_once $appRoot . '/Classes/Class_report.php';
                require_once $appRoot . '/Classes/Class_Chart.php';
                $objChart = new Chart();
                $objReport = new Report();

                echo '<p class="WelCome">Wel Come "' . $_SESSION['MM_Fullname'] . "\"</p>";
                if ((isset($_REQUEST['report']))) {

                    $header_lable = ucfirst(str_replace('_', ' ', $_REQUEST['report'])) . ' Report';
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
                        $nbase_url .= '?report=' . $_GET['report'] . '&No_Record=30';
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
                    $reportName = $_GET['report'];

                    list($reportName, $reportDescription, $Report_Field, $Report_Field_Display_Name, $tableName, $Join_Table, $whereClause, $User_Feed_Parameter) = $objReport->get_Report_Defintion($reportName);

                    if (strtoupper($tableName) != 'USER_DEFINED_REPORT') {

                        echo '<form method="post" >';
                        echo '<div id="my_tool_bar">';

                        require_once $appRoot . 'Report/Display_Field.php';
                        require_once $appRoot . 'Report/Filter.php';
                        require_once $appRoot . 'Report/Aggregate.php';
                        require_once $appRoot . 'Report/Save_As_User_Defined_Report.php';
                        require_once $appRoot . 'Report/Chart/Create_User_Defined_Chart.php';
                        echo '</div>';
                        echo '</form>';
                    }
                    ?>
                    <?php
                    ?>
                    <div id="grid_view_content">
                        <?php
                        echo '<div id="ThekeyHRMSReport">';

                    
                        if (isset($_POST['User_Defined_Report_Name']) && ($_POST['User_Defined_Report_Name'] != '')) {

                            $user_Defined_Report_Sql = $_SESSION['reportSql'];
                            $resultCreat = $objReport->create_User_Defined_Report($_POST['User_Defined_Report_Name'], $_POST['User_Defined_Report_Description'], $user_Defined_Report_Sql);
                            if ($resultCreat) {
                                echo '<script type="text/javascript" > alert(\'User Defined Report Saved Successfully\')</script>';
                            }
                        }

                        if (isset($_POST['Chart_Name']) && ($_POST['Chart_Name'] != '')) {

                            $Chart_Name = $_POST['Chart_Name'];

                            $Chart_Caption = $_POST['Chart_Caption'];

                            $Chart_Type = $_POST['Chart_Type'];

                            $X_axis_Title = $_POST['X_axis_Title'];
                            $X_axis_Category_Field = $_POST['X_axis_Category_Field'];

                            $Y_axis_Title = $_POST['Y_axis_Title'];
                            $Y_axis_Summary_Field = $_POST['Y_axis_Summary_Field'];
                            $Y_axis_Summary_Value = $_POST['Y_axis_Summary_Value'];

                            $Table_Name = $Table_Name;
                            $Join_Table = $Join_Table;

                            $resultCreatChart = $objChart->createChart($Chart_Name, $Chart_Caption, $Chart_Type, $X_axis_Title, $X_axis_Category_Field, $Y_axis_Title, $Y_axis_Summary_Field, $Y_axis_Summary_Value, $Table_Name, $Join_Table);

                            if ($resultCreatChart) {
                                echo '<script type="text/javascript" > alert(\'Chart Created Successfully\')</script>';
                            }
                        }

                        $objReport->generate_report($_GET['report']);

                        $fileName = $header_lable . " Excel Export ";

                        if (isset($_GET['Export'])) {
                            $objReport->XL_Export($_SESSION['reportSql'], $fileName);
                        }

                        echo '</div>';
                        ?>
                    </div>

                <?php } ?>

              <!-- InstanceEndEditable -->
            </div>
        </div>
    </body>
    <!-- InstanceEnd -->
</html>


