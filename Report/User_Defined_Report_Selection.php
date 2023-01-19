
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
                require_once $appRoot . '/Classes/Class_report.php';

                $objReport = new Report();
                ?>
                <?php
                echo '<h1 class="form_lable">';
                echo 'User Defined Report Selection Form';
                echo "</h1>";
                ?>
                <form action="Report_Display.php" method="GET" name="form1" id="form1">

                    <table  name="userDefinedReportSelection" id="userDefinedReportSelection" align="center" background="" bgcolor="#EBEBEB">
                        <tr> <td  align="right" nowrap="nowrap" colspan="2">
                                Report Name
                            </td>
                            <td>
                                <select name="report" class="ReportSelection" >
                                    <option>Select Report</option>
                                        <?php $objReport->get_User_Defined_Report(); ?>
                                </select>
                            </td>
                        </tr>
                         <tr>
                            
                            <td colspan="5"><div class="ReportDisplayOption"></div></td>
                        </tr>

                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">&nbsp;</td><td>
                                <td>&nbsp;&nbsp;<input type="submit" value="Show Report" /></td>
                        </tr>
                    </table>
                </form>


                <!-- InstanceEndEditable -->
            </div>
        </div>
    </body>
    <!-- InstanceEnd -->
</html>