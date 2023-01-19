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

            <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" --><blockquote>

                    <?php
                    $editFormAction = $_SERVER['PHP_SELF'];
                    if (isset($_SERVER['QUERY_STRING'])) {
                        $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
                    }
                    if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
                        if ($_POST['LeaveType'] == 'Please Choose Leave Type') {
                            echo "<script type=\"text/javascript\"> alert('Please Choose Leave Type which the employee is reported Back.')</script>";
                        } else
                        if ($_POST['LeaveType'] == 'Annual Leave') {
                            $sqlAL = "UPDATE annual_leave SET `Reported`='YES',Report_Back_Date='" . $_POST['Reported_Back_Date'] . "' WHERE ID = '" . $_GET['ID'] . "' and Reported='NO'";
                            mysql_query($sqlAL);
                            echo "<script type=\"text/javascript\"> alert('" . $_POST['FirstName'] . " " . $_POST['MiddelName'] . " back from Annual Leave to his/her duty is entered successfully!')</script>";
                        } else
                        if ($_POST['LeaveType'] == 'Funeral Leave') {
                            $sqlFL = "UPDATE funeral_leave SET `Reported`='YES',Report_Back_Date='" . $_POST['Reported_Back_Date'] . "' WHERE ID = '" . $_GET['ID'] . "' and Reported='NO'";
                            mysql_query($sqlFL);
                            echo "<script type=\"text/javascript\"> alert('" . $_POST['FirstName'] . " " . $_POST['MiddelName'] . " back from Funneral Leave to his/her duty is entered successfully!')</script>";
                        } else
                        if ($_POST['LeaveType'] == 'Paternity Leave') {
                            $sqlML = "UPDATE paternity_leave SET `Reported`='YES',Report_Back_Date='" . $_POST['Reported_Back_Date'] . "' WHERE ID = '" . $_GET['ID'] . "' and Reported='NO'";
                            mysql_query($sqlML);
                            echo "<script type=\"text/javascript\"> alert('" . $_POST['FirstName'] . " " . $_POST['MiddelName'] . " back from Paternity Leave to his/her duty is entered successfully!')</script>";
                        } else
                        if ($_POST['LeaveType'] == 'Special Leave') {
                            $sqlML = "UPDATE Special_leave SET `Reported`='YES',Report_Back_Date='" . $_POST['Reported_Back_Date'] . "' WHERE ID = '" . $_GET['ID'] . "'";
                            mysql_query($sqlML);
                            echo "<script type=\"text/javascript\"> alert('" . $_POST['FirstName'] . " " . $_POST['MiddelName'] . " back from Special Leave to his/her duty is entered successfully!')</script>";
                        } else
                        if ($_POST['LeaveType'] == 'Maternity Leave') {
                            $sqlML = "UPDATE maternity_leave SET `Reported`='YES',Report_Back_Date='" . $_POST['Reported_Back_Date'] . "' WHERE ID = '" . $_GET['ID'] . "'";
                            mysql_query($sqlML);
                            echo "<script type=\"text/javascript\"> alert('" . $_POST['FirstName'] . " " . $_POST['MiddelName'] . " back from Maternity Leave to his/her duty is entered successfully!')</script>";
                        } else
                        if ($_POST['LeaveType'] == 'Sick Leave') {
                            $sqlSL = "UPDATE sick_leave SET `Reported`='YES',Report_Back_Date='" . $_POST['Reported_Back_Date'] . "' WHERE ID = '" . $_GET['ID'] . "'";
                            mysql_query($sqlSL);
                            echo "<script type=\"text/javascript\"> alert('" . $_POST['FirstName'] . " " . $_POST['MiddelName'] . " back from Sick Leave to his/her duty is entered successfully!')</script>";
                        } else
                        if ($_POST['LeaveType'] == 'Wedding Leave') {
                            $sqlWL = "UPDATE wedding_leave SET `Reported`='YES',Report_Back_Date='" . $_POST['Reported_Back_Date'] . "' WHERE ID = '" . $_GET['ID'] . "'";
                            mysql_query($sqlWL);
                            echo "<script type=\"text/javascript\"> alert('" . $_POST['FirstName'] . " " . $_POST['MiddelName'] . " back from Wedding Leave to his/her duty is entered successfully!')</script>";
                        }
                    }

                    mysql_select_db($database_HRMS, $HRMS);
                    $query_RSFuneralLeaveGrant = "SELECT * FROM funeral_leave";
                    $RSFuneralLeaveGrant = mysql_query($query_RSFuneralLeaveGrant, $HRMS) or die(mysql_error());
                    $row_RSFuneralLeaveGrant = mysql_fetch_assoc($RSFuneralLeaveGrant);
                    $totalRows_RSFuneralLeaveGrant = mysql_num_rows($RSFuneralLeaveGrant);

                    $employee_info = array();
                    $mydb = new DataBase();
                    if (isset($_GET['ID'])) {
                        $result = $mydb->where('ID', $_GET['ID'])
                                ->get('employee_personal_record');
                        if ($result['count'] > 0) {
                            $employee_info = $result['result'][0];
                        }
                    }
                    ?>

                    <h1 class="form_lable">
                        <?php echo $obj_lang->get('Back to work from Leave Reporting Form', $lang); ?>  

                    </h1>
                    <?php require_once $base_path . 'Leaves/Select_ID4BackFromLeaveReport.php'; ?>
                    <br/>
                    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                        <table align="center" bgcolor="#EBEBEB">
                            <tr valign="baseline">
                                <td height="40" align="right" nowrap="nowrap"><?php echo $obj_lang->get('ID', $lang); ?>:</td>
                                <td><input type="text" name="ID" value="<?php echo isset($employee_info['ID']) ? $employee_info['ID'] : ''; ?>" size="10" readonly="readonly" /></td>
                            </tr>
                            <tr valign="baseline">
                                <td height="38" align="right" nowrap="nowrap"><?php echo $obj_lang->get('First Name', $lang); ?>:</td>
                                <td><input type="text" name="FirstName" value="<?php echo isset($employee_info['FirstName']) ? $employee_info['FirstName'] : ''; ?>" size="20" readonly="readonly"/></td>
                            </tr>
                            <tr valign="baseline">
                                <td  align="right" nowrap="nowrap"><?php echo $obj_lang->get('Middel Name', $lang); ?>:</td>
                                <td><input type="text" name="MiddelName" value="<?php echo isset($employee_info['MiddelName']) ? $employee_info['MiddelName'] : ''; ?>" size="20" readonly="readonly"  /></td>
                            </tr>
                            <tr valign="baseline">
                                <td  align="right" nowrap="nowrap"><?php echo $obj_lang->get('Last Name', $lang); ?>:</td>
                                <td><input type="text" name="LastName" value="<?php echo isset($employee_info['LastName']) ? $employee_info['LastName'] : ''; ?>" size="20" readonly="readonly" /></td>
                            </tr>
                            <tr valign="baseline">
                                <td height="31" align="right" nowrap="nowrap"><?php echo $obj_lang->get('From Leave', $lang); ?>:</td>
                                <td>
                                    <select name="LeaveType">
                                        <option value="Please Choose Leave Type"><?php echo $obj_lang->get('', $lang); ?></option>
                                        <option value="Annual Leave"><?php echo $obj_lang->get('Annual Leave', $lang); ?></option>
                                        <option value="Funeral Leave"><?php echo $obj_lang->get('Funeral Leave', $lang); ?></option>
                                        <option value="Maternity Leave"><?php echo $obj_lang->get('Maternity Leave', $lang); ?></option>
                                        <option value="Paternity Leave"><?php echo $obj_lang->get('Paternity Leave', $lang); ?></option>
                                        <option value="Sick Leave" ><?php echo $obj_lang->get('Sick Leave', $lang); ?></option>
                                        <option value="Wedding Leave"><?php echo $obj_lang->get('Wedding Leave', $lang); ?></option>
                                        <option value="Special Leave"><?php echo $obj_lang->get('Special Leave', $lang); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr valign="baseline">
                                <td height="31" align="right" nowrap="nowrap"><?php echo $obj_lang->get('Reported On', $lang); ?>:</td>
                                <td>   
                                    <input type="Date" name="Reported_Back_Date"  value='<?php echo date("Y-m-d"); ?>' /></td>
                            </tr>
                            <tr valign="baseline">
                                <td nowrap="nowrap" align="right">&nbsp;</td>
                                <td><input type="submit" value="<?php echo $obj_lang->get('Enter', $lang); ?>" /></td>
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
<?php
mysql_free_result($RSFuneralLeaveGrant);
?>
