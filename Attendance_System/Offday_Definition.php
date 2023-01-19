
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
                $mydb = new DataBase();
                ?>
                <?php
                $editFormAction = $_SERVER['PHP_SELF'];
                if (isset($_SERVER['QUERY_STRING'])) {
                    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
                }
                ?>
                <?php
                if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

                      if (!(mysql_num_rows(mysql_query("SELECT * FROM employee_offday where `ID`='" . $_POST['ID'] . "' AND `From_Date`='" . $_POST['From_Date'] . "'")))) {

                        $data = array('ID' => $_POST['ID']
                            , 'FirstName' => $_POST['FirstName']
                            , 'MiddelName' => $_POST['MiddelName']
                            , 'LastName' => $_POST['LastName']
                            , 'Department' => $_POST['Department']
                            , 'From_Date' => $_POST['From_Date']
                            , 'To_Date' => $_POST['To_Date']
                            , 'Off_Day' => $_POST['Off_Day']
                            ,'ModifiedBy' => $_SESSION['MM_Fullname']
                            );

                        $Result1 = $mydb->insert('employee_offday', $data);

                        if ($Result1)
                            echo "<script type=\"text/javascript\">alert('You have Defined Offday for {$_POST['FirstName']}  {$_POST['MiddelName']} Successfully.')</script>";
                    }
                    else
                        echo "<script type=\"text/javascript\">alert('You have already Defined Offday for {$_POST['FirstName']}  {$_POST['MiddelName']}.')</script>";
                }
                ?>
                <h1 class="form_lable">
                    <?php echo $obj_lang->get('Employee Off Day  Definition Form', $lang); ?>
                </h1>

                <?php
                $_GET['TableName'] = "employee_personal_record";

                $_GET['OpenPage'] = "Offday_Definition";

                require_once($base_path . "Search_Name/SearchName.php");
                ?>
                <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                    <table align="center" bgcolor="#EBEBEB">
                        <tr valign="baseline">
                            <td width="128" align="right" nowrap="nowrap"> <?php echo $obj_lang->get('Selected ID', $lang); ?>:</td>
                            <td width="385">
                                <input type="text" name="ID" value="<?php
                if (isset($_GET['ID'])) {
                    //mysql_select_db('ThekeyHRMSlanguage');
                    echo $_GET['ID'];
                }
                ?>" size="10" readonly="readonly"  />
                            </td>
                        </tr>

                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('First Name', $lang); ?>:</td>
                            <td align="left"><input name="FirstName" type="text" value="<?php
                                       $query = "SELECT * FROM employee_personal_record";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {


                                               if ($row['ID'] == $_GET['ID']) {

                                                   echo "{$row['FirstName']}";
                                               }
                                           }
                                       }
                ?>"


                                                    size="20" maxlength="20" readonly="readonly" align="left" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Middel Name', $lang); ?>:</td>
                            <td><input name="MiddelName" type="text" value="<?php
                                                    $query = "SELECT * FROM employee_personal_record";
                                                    $result = mysql_query($query);
                                                    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                                        if (isset($_GET['ID'])) {


                                                            if ($row['ID'] == $_GET['ID']) {
                                                                echo "{$row['MiddelName']}";
                                                            }
                                                        }
                                                    }
                ?>"size="20" maxlength="20" readonly="readonly" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td  align="right" nowrap="nowrap"><?php echo $obj_lang->get('Last Name', $lang); ?>:</td>
                            <td><input name="LastName" type="text" value="<?php
                                       $query = "SELECT * FROM employee_personal_record";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {


                                               if ($row['ID'] == $_GET['ID']) {
                                                   echo "{$row['LastName']}";
                                               }
                                           }
                                       }
                ?>" size="20" maxlength="20" readonly="readonly" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td  align="right" nowrap="nowrap"><?php echo $obj_lang->get('Department', $lang); ?>:</td>
                            <td><input name="Department" type="text" value="<?php
                                       $query = "SELECT * FROM employee_personal_record";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {


                                               if ($row['ID'] == $_GET['ID']) {
                                                   echo "{$row['Department']}";
                                               }
                                           }
                                       }
                ?>" size="20" maxlength="20" readonly="readonly" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">From Date:</td>
                            <td><input type="date" name="From_Date" value="<?php echo date('Y-m-d'); ?>" size="10" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">To Date:</td>
                            <td><input type="date" name="To_Date" value="<?php echo date('Y-m-d'); ?>" size="10" /></td>
                        </tr>

                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Off Day', $lang); ?>:</td>
                            <td><select name="Off_Day">
                                    <option value="Sunday" <?php
                                       if (!(strcmp("Sunday", ""))) {
                                           echo "SELECTED";
                                       }
                ?>>Sunday</option>
                                    <option value="Monday" <?php
                                            if (!(strcmp("Monday", ""))) {
                                                echo "SELECTED";
                                            }
                ?>>Monday</option>
                                    <option value="Tuesday" <?php
                                            if (!(strcmp("Tuesday", ""))) {
                                                echo "SELECTED";
                                            }
                ?>>Tuesday</option>
                                    <option value="Wednesday" <?php
                                            if (!(strcmp("Wednesday", ""))) {
                                                echo "SELECTED";
                                            }
                ?>>Wednesday</option>
                                    <option value="Thursday" <?php
                                            if (!(strcmp("Thursday", ""))) {
                                                echo "SELECTED";
                                            }
                ?>>Thursday</option>
                                    <option value="Friday" <?php
                                            if (!(strcmp("Friday", ""))) {
                                                echo "SELECTED";
                                            }
                ?>>Friday</option>
                                    <option value="Saturday" <?php
                                            if (!(strcmp("Saturday", ""))) {
                                                echo "SELECTED";
                                            }
                ?>>Saturday</option>
                                    <option value="" >item1</option>
                                </select></td>
                        </tr>
                        <tr><td>&nbsp;</td></tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">&nbsp;</td>
                            <td><input type="submit" value="Define Offday" /></td>
                        </tr>
                    </table>
                    <input type="hidden" name="MM_insert" value="form1" />
                </form>







                <!-- InstanceEndEditable -->
            </div>
        </div>
    </body>
    <!-- InstanceEnd --> </html>


