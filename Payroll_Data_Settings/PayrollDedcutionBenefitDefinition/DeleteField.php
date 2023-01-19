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
                $addfieldSQL = "ALTER TABLE `total_deduction_benefit_defualt` DROP `" . $FieldName . "` ";

                mysql_select_db($database_HRMS, $HRMS);
                $Result1 = mysql_query($addfieldSQL, $HRMS) or die(mysql_error());

                echo "<script type=\"text/javascript\">alert('You have Deleted Selected Field $FieldName Form Payroll Data Deduction Benfit Setting Successfully.')</script>";

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

            <table height="106" align="center"  bgcolor="#CCCCCC">
                <p align="center"><b>Delete Field</b></p>
                <tr>
                    <td height="45" align="right">
                        Name Of Field
                    </td>
                    <td align="left">

                        <?php
                        $query = "SHOW COLUMNS FROM ThekeyHRMSDB.`total_deduction_benefit_defualt` where `Field`<>'Auto_ID' and `Field`<>'ID' and `Field`<>'FirstName' and `Field`<>'MiddelName' and `Field`<>'LastName' and `Field`<> 'Basic Salary' and `Field`<>'Department' and `Field`<>'Position' and `Field`<>'Total_Holyday' and `Field`<>'ModifiedBy'";
                        $result = mysql_query($query);
                        echo "<select id=\"FieldName\" name=\"FieldName\">";
                        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

                            echo "<option value=\"{$row['Field']}\" >{$row['Field']}</option>";
                        }
                        echo "</select>";
                        ?>
                    </td>
                </tr>


                <tr valign="baseline">
                    <td nowrap="nowrap" align="right">&nbsp;</td>
                    <td><input type="submit" value="Delete Field" /></td>
                </tr>
            </table>
            <input type="hidden" name="MM_insert" value="form1" />
        </form>
    </body>
</html>