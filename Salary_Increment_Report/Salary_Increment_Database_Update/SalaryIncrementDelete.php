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
                ?>
                <?php
                if ((isset($_GET['Initial_Salary'])) && ($_GET['Initial_Salary'] != "")) {
                    $deleteSQL = sprintf("DELETE FROM wage_allocation WHERE Initial_Salary=%s", GetSQLValueString($_GET['Initial_Salary'], "int"));

                    mysql_select_db($database_HRMS, $HRMS);
                    $Result1 = mysql_query($deleteSQL, $HRMS) or die(mysql_error());

                    $deleteGoTo = "SalaryIncrementDisplay.php";
                    if (isset($_SERVER['QUERY_STRING'])) {
                        $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
                        $deleteGoTo .= $_SERVER['QUERY_STRING'];
                    }
                    header(sprintf("Location: %s", $deleteGoTo));
                }
                ?>
                <!-- InstanceEndEditable -->
            </div>
        </div>
    </body>
    <!-- InstanceEnd --> 
</html>


