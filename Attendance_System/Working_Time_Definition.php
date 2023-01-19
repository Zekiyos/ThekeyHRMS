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
                echo '<p class="WelCome">Wel Come "' . $_SESSION['MM_Fullname'] . "\"</p>";

                $mydb = new DataBase();
                ?>

                <?php
                $editFormAction = $_SERVER['PHP_SELF'];
                if (isset($_SERVER['QUERY_STRING'])) {
                    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
                }

                if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
                    $check_dpt = "SELECT Department FROM working_time_setting where Department='" . $_POST['Department'] . "' and ((`From_Date`>= '" . $_POST['From_Date'] . "'" . " and   `To_Date`<= '" . $_POST['From_Date'] . "')" . " or (`To_Date`<= '" . $_POST['To_Date'] . "'" . " and  `From_Date`>= '" . $_POST['To_Date'] . "'))";
                    if (!(mysql_num_rows(mysql_query($check_dpt)))) {

                        $data = array('Department' => $_POST['Department']
                            , 'From_Date' => $_POST['From_Date']
                            , 'To_Date' => $_POST['To_Date']
                            , 'Start' => $_POST['Start']
                            , 'Start_Break' => $_POST['Start_Break']
                            , 'End_Break' => $_POST['End_Break']
                            , 'End' => $_POST['End']
                            , 'Working_Hour' => $_POST['Working_Hour']
                            , 'Working_Hour_Hold' => $_POST['Working_Hour_Hold']
                            , 'ModifiedBy' => $_SESSION['MM_Fullname']
                        );

                        $Result1 = $mydb->insert('working_time_setting', $data);

                        if ($Result1)
                            echo "<script type=\"text/javascript\">alert('You have Defined Working time Successfully for Department {$_POST['Department']}.')</script>";
                    }
                    else
                        echo "<script type=\"text/javascript\">alert('Working time for {$_POST['Department']} Department already Defined.If you want to redefine it,delete first defined data.')</script>";
                }
                ?>
                <?php
                mysql_select_db($database_HRMS, $HRMS);
                //$query_RSDepartment = "SELECT Department FROM department ORDER BY Department ASC";
                $query_RSDepartment = "SELECT * FROM thekey_department_data_access Where group_name='" . $_SESSION['MM_UserGroup'] . "' ORDER BY Department ASC";
                $RSDepartment = mysql_query($query_RSDepartment, $HRMS) or die(mysql_error());
                $row_RSDepartment = mysql_fetch_assoc($RSDepartment);
                $totalRows_RSDepartment = mysql_num_rows($RSDepartment);

                $query_RSGroupNo = "SELECT * FROM `department_group_no` WHERE `Department` IN (
                    SELECT Department FROM thekey_department_data_access 
                    Where group_name='" . $_SESSION['MM_UserGroup'] . "')";

                $RSGroupNo = mysql_query($query_RSGroupNo, $HRMS) or die(mysql_error());
                $row_RSGroupNo = mysql_fetch_assoc($RSGroupNo);
                $totalRows_RSGroupNo = mysql_num_rows($RSGroupNo);
                ?>


                <h1 class="form_lable">
                    <?php echo $obj_lang->get('Departmental Working Time Definition Form', $lang); ?>
                </h1>
                <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                    <table width="400" height="395" align="center" background="" bgcolor="#EBEBEB">
                        <?php
                        $sqlCS = "SELECT `Company_Name` from $database_HRMS.company_settings";

                        $resultCS = mysql_query($sqlCS) or die(mysql_error());

                        $rowCS = mysql_fetch_array($resultCS);

                        if (isset($company_info['support_group']) && !($company_info['support_group'])) {
                            ?>

                            <tr valign="baseline">
                                <td nowrap="nowrap" align="right">Department:</td>
                                <td>
                                    <select name="Department" id="Department" >
                                        <?php
                                        do {
                                            ?>
                                            <option value="<?php echo $row_RSDepartment['Department'] ?>" ><?php echo $row_RSDepartment['Department'] ?></option>
                                            <?php
                                        } while ($row_RSDepartment = mysql_fetch_assoc($RSDepartment));
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <?php
                        } elseif (isset($company_info['support_group'])) {
                            if ($company_info['support_group']) {
                                echo '<tr>';
                                echo '<td align="right">';
                                echo 'Group Number';
                                echo '</td>';
                                echo '<td>';
                                ?>
                                <!--Select name="Group_No" id="Group_No" -->
                                <select name="Department" id="Department" >
                                    <?php
                                    do {
                                        ?>
                                        <option value="<?php echo $row_RSGroupNo['Group_No'] ?>" ><?php echo $row_RSGroupNo['Group_No'] ?></option>
                                        <?php
                                    } while ($row_RSGroupNo = mysql_fetch_assoc($RSGroupNo));
                                    ?>
                                </select>

                                <?php
                                echo '</td>';
                                echo '</tr>';
                            }
                        }
                        ?>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">From Date:</td>
                            <td>
                                <?php
                                echo "<script type='text/JavaScript' src=\"../Calendar/scw.js\" ></script>";
                                $Today = date('Y-m-d');
                                ?><input type="date" name="From_Date" value='<?php echo date('Y-m-d'); ?>' size="12" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">To Date:</td>
                            <td><input type="date" name="To_Date"  value='<?php echo date('Y-m-d'); ?>' size="12" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Start:</td>
                            <td><input type="time" name="Start" value="<?php echo "06:30:00"; //date("H:i:s");                ?>" size="10" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Start Break:</td>
                            <td><input type="time" name="Start_Break" value="<?php echo "12:00:00"; //date("H:i:s");                ?>" size="10" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">End Break:</td>
                            <td><input type="time" name="End_Break" value="<?php echo "13:00:00"; //date("H:i:s");                ?>" size="10" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">End:</td>
                            <td><input type="time" name="End" value="<?php echo "15:30:00"; //date("H:i:s");                ?>" size="10" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Working Hour:</td>
                            <td><input type="time" name="Working_Hour" value="<?php echo "08:00:00"; //date("H:i:s");                ?>" size="10" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Hold Working Hour:</td>
                            <td><input type="time" name="Working_Hour_Hold" value="<?php echo "08:00:00"; //date("H:i:s");                ?>" size="10" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">&nbsp;</td>
                            <td><input type="submit" value="Define Working Time" /></td>
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