 
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
                ?>
                <?php
                if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
                    $check_dpt = "SELECT ID FROM working_time_setting_individual where ID='" . $_POST['ID'] . "' and ((`From_Date`>= '" . $_POST['From_Date'] . "'" . " and   `To_Date`<= '" . $_POST['From_Date'] . "')" . " or (`To_Date`<= '" . $_POST['To_Date'] . "'" . " and  `From_Date`>= '" . $_POST['To_Date'] . "'))";
                    if (!(mysql_num_rows(mysql_query($check_dpt)))) {
                        $data = array('ID' => $_POST['ID']
                            , 'FirstName' => $_POST['FirstName']
                            , 'MiddelName' => $_POST['MiddelName']
                            , 'LastName' => $_POST['LastName']
                            , 'Department' => $_POST['Department']
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

                        $Result1 = $mydb->insert('working_time_setting_individual', $data);

                        if ($Result1)
                            echo "<script type=\"text/javascript\">alert('You have Defined Working time Successfully for Employee ID Number {$_POST['ID']}.')</script>";
                    }
                    else {
                        echo "<script type=\"text/javascript\">alert('Working time for {$_POST['Department']} Selected Employee already Defined.If you want to redefine it,delete first defined data.')</script>";
                    }
                }
                ?>

                <h1 class="form_lable">
                    <?php echo $obj_lang->get('Individual Working Time Definition Form', $lang); ?>
                </h1>
                <?php
                $_GET['TableName'] = "employee_personal_record";

                $_GET['OpenPage'] = "Working_Time_Definition_Individual";

                require_once($base_path . "Search_Name/SearchName.php");
                ?>

                <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                    <table width="400" height="395" align="center" background="" bgcolor="#EBEBEB">
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">ID:</td>
                            <td><input type="text" name="ID" value="<?php
                if (isset($_GET['ID'])) {
                    echo $_GET['ID'];
                }
                ?>" size="10" readonly="readonly" /></td>
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
                ?>"   size="20" maxlength="20" readonly="readonly" align="left" /></td>
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
                ?>" size="30" maxlength="30" readonly="readonly" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">From Date:</td>
                            <td><?php
                                       echo "<script type='text/JavaScript' src=\"../Calendar/scw.js\" ></script>";
                                       $Today = date('Y-m-d');
                ?><input type="text" name="From_Date" onclick='scwShow(this, event);' value='<?php echo date('Y-m-d'); ?>' size="12" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">To Date:</td>
                            <td><input type="text" name="To_Date" onclick='scwShow(this, event);' value='<?php echo date('Y-m-d'); ?>' size="12" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Start:</td>
                            <td><input type="text" name="Start" value="<?php echo "06:30:00"; //date("H:i:s");               ?>" size="10" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Start Break:</td>
                            <td><input type="text" name="Start_Break" value="<?php echo "12:00:00"; //date("H:i:s");                ?>" size="10" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">End Break:</td>
                            <td><input type="text" name="End_Break" value="<?php echo "13:00:00"; //date("H:i:s");               ?>" size="10" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">End:</td>
                            <td><input type="text" name="End" value="<?php echo "15:30:00"; //date("H:i:s");                ?>" size="10" /></td>
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
    <!-- InstanceEnd --> </html>


