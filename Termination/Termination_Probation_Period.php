 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/ThekeyHRMS_main_Template.dwt" codeOutsideHTMLIsLocked="false" -->
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
                    $NO = "NO";
                    if (!(mysql_num_rows(mysql_query("SELECT * FROM equipment_handover WHERE ID='" . $_GET['ID'] . "' and Returned='" . $NO . "' ")))) {

                        $data = array('ID' => $_POST['ID']
                            , 'FirstName' => $_POST['FirstName']
                            , 'MiddelName' => $_POST['MiddelName']
                            , 'LastName' => $_POST['LastName']
                            , 'Department' => $_POST['Department']
                            , 'Terminated_Date' => $_POST['Terminated_Date']
                            , 'Termination_Reason' => $_POST['Termination_Reason']);

              
                        $Result1 = $mydb->insert('probation_period_terminated_employee', $data);

                        if ($Result1)
                            echo "<script type=\"text/javascript\">alert('You have Terminated Probation Period Employee Successfully.') </script>";
                    }
                    else {
                        echo "<script type=\"text/javascript\"> confirm('You can\'t Terminate Employee When Unretured Equipment is on his/her Hand');</script>";
                    }
                }

                mysql_select_db($database_HRMS, $HRMS);
                $query_RSTermination = "SELECT * FROM terminated_employee";
                $RSTermination = mysql_query($query_RSTermination, $HRMS) or die(mysql_error());
                $row_RSTermination = mysql_fetch_assoc($RSTermination);
                $totalRows_RSTermination = mysql_num_rows($RSTermination);
                ?>
                <h1 class="form_lable">
                    <?php echo $obj_lang->get('Employee Termination Under Probation Period Form', $lang); ?>
                </h1>
                <?php
                $_GET['TableName'] = "employee_personal_record";

                $_GET['OpenPage'] = "Termination_Probation_Period";

                require_once($base_path . "Search_Name/SearchName.php");
                ?>
                <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" >
                    <table width="357" height="345" align="center" bgcolor="#EBEBEB">
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('ID', $lang); ?>:</td>
                            <td><input type="text" name="ID" value="<?php
                if (isset($_GET['ID'])) {
                    echo $_GET['ID'];
                }
                ?>"  readonly="readonly"/>
                            </td>
                        </tr>



                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('First Name', $lang); ?>:</td>
                            <td><input type="text" name="FirstName" value="<?php
                                       $query = "SELECT * FROM employee_personal_record";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {
                                               if ($row['ID'] == $_GET['ID']) {
                                                   echo "{$row['FirstName']}";
                                               }
                                           }
                                       }
                ?>"size="20" maxlength="20" readonly="readonly"  /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Middel Name', $lang); ?>:</td>
                            <td><input type="text" name="MiddelName" value="<?php
                                       $query = "SELECT * FROM employee_personal_record";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {
                                               if ($row['ID'] == $_GET['ID']) {
                                                   echo "{$row['MiddelName']}";
                                               }
                                           }
                                       }
                ?>" size="20" maxlength="20" readonly="readonly"  /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Last Name', $lang); ?>:</td>
                            <td><input type="text" name="LastName" value="<?php
                                       $query = "SELECT * FROM employee_personal_record";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {
                                               if ($row['ID'] == $_GET['ID']) {
                                                   echo "{$row['LastName']}";
                                               }
                                           }
                                       }
                ?>"size="20" maxlength="20" readonly="readonly" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Department', $lang); ?>:</td>
                            <td><input type="text" name="Department" value="<?php
                                       $query = "SELECT * FROM employee_personal_record";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {
                                               if ($row['ID'] == $_GET['ID']) {
                                                   echo "{$row['Department']}";
                                               }
                                           }
                                       }
                ?>"size="30" maxlength="35" readonly="readonly" /></td>
                        </tr>
                        <tr align="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Termination Reason', $lang); ?>:</td>
                            <td><textarea name="Termination_Reason" id="Termination_Reason"></textarea></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Terminated Date', $lang); ?>:</td>
                            <td>
                                <input type="Date" name="Terminated_Date"  value='<?php echo date("Y-m-d"); ?>' /></td>
                        </tr>
                        <tr>
                            <td>
                            </td>
                            <td>
                                <?php
                                $query = "SELECT * FROM equipment_handover ";
                                $result = mysql_query($query);
                                while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                    if (isset($_GET['ID'])) {
                                        if (($row['ID'] == $_GET['ID']) and ($row['Returned'] == "NO")) {
                                            echo "<textarea cols=\"30\" rows=\"3\" readonly=\"readonly\" >Equipment on {$row['FirstName']} {$row['MiddelName']} hand:{$row['EquipmentName']} taken on {$row['Taken_Date']}.</textarea>";
                                        }
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">&nbsp;</td>
                            <td><input type="submit" value="<?php echo $obj_lang->get('Terminate', $lang); ?>" onclick="return confirm('Are you sure you want to Terminate this Employee? If you Click Ok Employee will be deleted from current employee list or Click Cancel to Avoid Termination')" /></td>
                        </tr>
                    </table>
                    <p>
                        <input type="hidden" name="MM_insert" value="form1" />
                    </p>
                </form>

                <!-- InstanceEndEditable -->
            </div>
        </div>

    </body>
    <!-- InstanceEnd --> 
</html>


