<?php require_once('../../Connections/HRMS.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Untitled Document</title>
        <link rel="stylesheet"  href="../../Css/tinybox2style.css" />
        <script type="text/javascript" src="../../Js/tinybox.js"></script>
    </head>

    <body>
        <?php
        $editFormAction = $_SERVER['PHP_SELF'];
        if (isset($_SERVER['QUERY_STRING'])) {
            $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
        }
        ?>
        <?php
        if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

            if (!(mysql_num_rows(mysql_query("SELECT * FROM total_deduction_benefit_defualt ")))) {
                $FieldDataType = $_POST['FieldDataType'];
                if ($_POST['FieldDataType'] == "Text") {
                    $FieldDataType == "VARCHAR";
                } else
                if ($FieldDataType == "Date") {

                    $FieldDataType == "Date";
                } else
                if ($FieldDataType == "Number") {
                    $FieldDataType == "double";
                }

                $FieldName = $_POST['FieldName'];
                $addfieldSQL = "ALTER TABLE `total_deduction_benefit_defualt`  ADD `" . $_POST['FieldName'] . "` " . $FieldDataType . " NOT NULL";

                mysql_select_db($database_HRMS, $HRMS);
                $Result1 = mysql_query($addfieldSQL, $HRMS) or die(mysql_error());

                echo "<script type=\"text/javascript\">alert('You have Added New $FieldName Field For Payroll Data Deduction Benfit Setting Successfully.')</script>";

                $addGoTo = "PayrollDeductionBenefitSetup.php";
                if (isset($_SERVER['QUERY_STRING'])) {
                    $addGoTo .= (strpos($addGoTo, '?')) ? "&" : "?";
                    $addGoTo .= $_SERVER['QUERY_STRING'];
                }
                header(sprintf("Location: %s", $addGoTo));
            }
        }
        ?>
        <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1"> 

            <table height="190" align="center"  bgcolor="#CCCCCC">
                <p align="center"><b>Add New Field</b></p>
                <tr>
                    <td height="45" align="right">
                        Name Of Fieldii
                    </td>
                    <td align="left">
                        <input type="text" name="FieldName" id="FieldName" value="" size="40" />
                    </td>
                </tr>
                <tr>
                    <td height="69" align="right">
                        Data Type</td>
                    <td align="left">
                        <select id="FieldDataType" name="FieldDataType">
                            <option>Choose Data Type</option>
                            <option>Number</option>
                            <option>Text</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td height="45" align="right">
                        Field Size
                    </td>
                    <td align="left">
                        <input type="text" id="FieldSize" value="" size="5" />
                    </td>
                </tr>

                <tr valign="baseline">
                    <td nowrap="nowrap" align="right">&nbsp;</td>
                    <td><input type="submit" value="Add Field" /></td>
                </tr>
            </table>
            <input type="hidden" name="MM_insert" value="form1" />
        </form>
    </body>
</html>