<?php require_once('../../../Connections/HRMS.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/ThekeyHRMS_main_Template.dwt" codeOutsideHTMLIsLocked="false" -->
    <head>
        <!--meta http-equiv="Content-Type" content="text/html; charset=utf-8" /-->
        <title>Thekey HRMS</title>

        <?php
        $dont_check = true;
        
        $base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
        require_once $base_path . 'Templates/head.php';
        ?>
    </head>

    <body>
        <div id="busy" style="display: none;" >
            <img alt="Am Working" src="http://<?php echo $base_url ?>images/BusyAnimation.gif">
        </div>

        <?php
        $mydb = new DataBase();
        ?>
        <?php
        $editFormAction = $_SERVER['PHP_SELF'];
        if (isset($_SERVER['QUERY_STRING'])) {
            $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
        }

        if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

            $data = array(
                'Terminated_Date' => $_POST['Terminated_Date']
                , 'Termination_Reason' => $_POST['Termination_Reason']);

            //, 'ModifiedBy' => $_SESSION['MM_Fullname']);
            $Result1 = $mydb->where('Auto_ID', $_GET['Auto_ID'])
                    ->update('terminated_employee', $data);

            if ($Result1)
                echo "<script type=\"text/javascript\">alert('You have updated Terminated Employee Data for {$_POST['FirstName']}  {$_POST['MiddelName']} Successfully.')</script>";



            $updateGoTo = "index.php";

            header(sprintf("Location: %s", $updateGoTo));
        }
        ?>
        <?php
        mysql_select_db($database_HRMS, $HRMS);

        if (isset($_GET['Auto_ID'])) {

            $query_RSTerminationUpdate = "SELECT * FROM  terminated_employee where Auto_ID=" . $_GET['Auto_ID'] . "";
        }else
            $query_RSTerminationUpdate = "SELECT * FROM terminated_employee where Auto_ID=-1";


//$query_RSTerminationUpdate = "SELECT * FROM terminated_employee";
        $RSTerminationUpdate = mysql_query($query_RSTerminationUpdate, $HRMS) or die(mysql_error());
        $row_RSTerminationUpdate = mysql_fetch_assoc($RSTerminationUpdate);
        $totalRows_RSTerminationUpdate = mysql_num_rows($RSTerminationUpdate);
        ?>
        <font color="#FF6600" size="+1" > <p align="center">Terminated Employee Data Update</p></font>
        <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
            <table align="center">
                <tr valign="baseline">
                    <td nowrap="nowrap" align="right">ID:</td>
                    <td><input type="text" name="ID" value="<?php echo htmlentities($row_RSTerminationUpdate['ID'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap="nowrap" align="right">First Name:</td>
                    <td><input type="text" name="FirstName" value="<?php echo htmlentities($row_RSTerminationUpdate['FirstName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap="nowrap" align="right">Middel Name:</td>
                    <td><input type="text" name="MiddelName" value="<?php echo htmlentities($row_RSTerminationUpdate['MiddelName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap="nowrap" align="right">Last Name:</td>
                    <td><input type="text" name="LastName" value="<?php echo htmlentities($row_RSTerminationUpdate['LastName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap="nowrap" align="right">Department:</td>
                    <td><input type="text" name="Department" value="<?php echo htmlentities($row_RSTerminationUpdate['Department'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap="nowrap" align="right">Terminated Date:</td>
                    <td><input type="text" name="Terminated_Date" value="<?php echo htmlentities($row_RSTerminationUpdate['Terminated_Date'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap="nowrap" align="right">Termination Reason:</td>
                    <td><textarea name="Termination_Reason" cols="30" rows="5">
                            <?php echo htmlentities($row_RSTerminationUpdate['Termination_Reason'], ENT_COMPAT, 'utf-8'); ?></textarea></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap="nowrap" align="right">&nbsp;</td>
                    <td><input type="submit" value="Update record" /></td>
                </tr>
            </table>
            <input type="hidden" name="MM_update" value="form1" />
            <input type="hidden" name="Auto_ID" value="<?php echo $row_RSTerminationUpdate['Auto_ID']; ?>" />
        </form>


        <!-- InstanceEndEditable -->
        </div>

    </body>
    <!-- InstanceEnd --> 
</html>