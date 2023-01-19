
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
                ?>
                <?php
                if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
                    $insertSQL = "INSERT INTO `thekeyhrmsdb`.`health_care_insurance_Definition` (`Auto_ID`, `From_Basic_Salary`, `To_Basic_Salary`, `Insurance_Amount`, `Amount_Type`)
                        VALUES (NULL, '" . $_POST['From_Basic_Salary'] . "', '" . $_POST['To_Basic_Salary'] . "', '" . $_POST['Insurance_Amount'] . "', '" . $_POST['Amount_Type'] . "')";


                    mysql_select_db($database_HRMS, $HRMS);
                    $Result1 = mysql_query($insertSQL, $HRMS) or die(mysql_error());

                    if ($Result1)
                        echo "<script type=\"text/javascript\">alert('You have Registred  Health Care Insurance Definiton Successfully.')</script>";

//                    $insertGoTo = "SalaryIncrementDisplay.php";
//                    if (isset($_SERVER['QUERY_STRING'])) {
//                        $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
//                        $insertGoTo .= $_SERVER['QUERY_STRING'];
//                    }
//                    header(sprintf("Location: %s", $insertGoTo));
                }
                ?>
                <h1 class="form_lable">
                    Health Care Insurance Definition
                </h1>
                <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                    <table align="center">
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">From Basic Salary:</td>
                            <td><input type="text" required="required" name="From_Basic_Salary" value="" size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">To Basic Salary:</td>
                            <td><input type="text" required="required" name="To_Basic_Salary" value="" size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Heath Care Insurance Amount:</td>
                            <td><input type="text" required="required" name="Insurance_Amount" value="" size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Amount Type', $lang); ?>:</td>
                            <td valign="baseline"><table>
                                    <tr>
                                        <td><input type="radio" name="Amount_Type" value="Amount" <?php
                if (!(strcmp("Amount", "Percent"))) {
                    echo "checked=\"checked\"";
                }
                ?>/>
                                            <?php echo $obj_lang->get('Amount', $lang); ?></td>
                                    </tr>
                                    <tr>
                                        <td><input type="radio" name="Amount_Type" value="Percent" <?php
                                            if (!(strcmp("Percent", "Percent"))) {
                                                echo "checked=\"checked\"";
                                            }
                                            ?>/>
                                            <?php echo $obj_lang->get('Percent', $lang); ?></td>
                                    </tr>
                                </table></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">&nbsp;</td>
                            <td><input type="submit" value="Register Definition" /></td>
                        </tr>
                    </table>
                    <input type="hidden" name="MM_insert" value="form1" />
                </form>
                <!-- InstanceEndEditable -->
            </div>
        </div>

    </body>
    <!-- InstanceEnd --></html>


