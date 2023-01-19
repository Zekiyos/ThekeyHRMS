<?php
require_once('../../Connections/HRMS.php');

require_once('../../Classes/Class_language.php');
?>
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

                if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

                    $insertSQL = sprintf("INSERT INTO wage_allocation (Initial_Salary, No_Year, Salary_Increment) VALUES (%s, %s, %s)", $_POST['Initial_Salary'], $_POST['No_Year'], $_POST['Salary_Increment']);


                    mysql_select_db($database_HRMS, $HRMS);
                    $Result1 = mysql_query($insertSQL, $HRMS) or die(mysql_error());

                    $insertGoTo = "SalaryIncrementDisplay.php";
                    if (isset($_SERVER['QUERY_STRING'])) {
                        $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
                        $insertGoTo .= $_SERVER['QUERY_STRING'];
                    }
                    header(sprintf("Location: %s", $insertGoTo));
                }
                ?>
                <h1 class="form_lable">
                    Salary Increment
                </h1>
                <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                    <table align="center">
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Initial Salary:</td>
                            <td><input required="required" type="text" name="Initial_Salary" value="" size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Number of Year:</td>
                            <td><input required="required" type="text" name="No_Year" value="" size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Salary After Increment:</td>
                            <td><input required="required" type="text" name="Salary_Increment" value="" size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td colspan="2" align="right"><input type="submit" value="Register Definition" /></td>
                        </tr>
                    </table>
                    <input type="hidden" name="MM_insert" value="form1" />
                </form>
                <!-- InstanceEndEditable -->
            </div>
        </div>
    </body>
    <!-- InstanceEnd -->
</html>


