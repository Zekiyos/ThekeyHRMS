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
        <div id="busy">
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
                mysql_select_db($database_HRMS, $HRMS);
                $query_RSHandOver = "SELECT * FROM employee_personal_record";
                $RSHandOver = mysql_query($query_RSHandOver, $HRMS) or die(mysql_error());
                $row_RSHandOver = mysql_fetch_assoc($RSHandOver);
                $totalRows_RSHandOver = mysql_num_rows($RSHandOver);

                $editFormAction = $_SERVER['PHP_SELF'];
                if (isset($_SERVER['QUERY_STRING'])) {
                    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
                }

                if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

                    $data = array('Returned' => 'YES'
                        , 'Returning_Date' => $_POST['Returning_Date']);

                    $mydb->where(array('ID' => $_POST['ID'], 'EquipmentName' => $_POST['EquipmentName']));
                    $Result1 = $mydb->update('equipment_handover', $data);
                    if ($Result1)
                        echo "<script type=\"text/javascript\">alert('You have registed the Equipment Returning Data Seccussfully.')</script>";
                }

                mysql_select_db($database_HRMS, $HRMS);
                $query_RSHandOver = "SELECT * FROM Equipment_handover";
                $RSHandOver = mysql_query($query_RSHandOver, $HRMS) or die(mysql_error());
                $row_RSHandOver = mysql_fetch_assoc($RSHandOver);
                $totalRows_RSHandOver = mysql_num_rows($RSHandOver);
                if (isset($_GET['ID'])) {
                    mysql_select_db($database_HRMS, $HRMS);
                }
                ?>
                <h1 class="form_lable">
                    <?php echo $obj_lang->get('Equipment Return Back Form', $lang); ?>
                </h1>


                <?php
                $_GET['TableName'] = "Equipment_HandOver";

                $_GET['OpenPage'] = "Equipment_ReturnBack";

                require_once($base_path . "Search_Name/SearchName.php");
                ?>

                <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">

                    <table width="400" height="338" align="center" background="" bgcolor="#EBEBEB">
                        <tr valign="baseline">
                            <td width="128" height="39" align="right" nowrap="nowrap"> <?php echo $obj_lang->get('Selected ID', $lang); ?>:</td>
                            <td width="385">
                                <input type="text" name="ID" value="<?php
                if (isset($_GET['ID'])) {
                    echo $_GET['ID'];
                }
                ?>" size="10" readonly="readonly"  />     
                            </td>
                        </tr>

                        <tr valign="baseline">
                            <td height="37" align="right" nowrap="nowrap"><?php echo $obj_lang->get('First Name', $lang); ?>:</td>
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
                ?>"  size="20" maxlength="20" readonly="readonly" align="left" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td height="37" align="right" nowrap="nowrap"><?php echo $obj_lang->get('Middel Name', $lang); ?>:</td>
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
                            <td height="36"  align="right" nowrap="nowrap"><?php echo $obj_lang->get('Last Name', $lang); ?>:</td>
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
                            <td height="40" align="right" nowrap="nowrap"><?php echo $obj_lang->get('Department', $lang); ?>:</td>
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
                ?>" size="20" readonly="readonly" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td height="36"  align="right"  nowrap="nowrap"><?php echo $obj_lang->get('Name of Equipements', $lang); ?>:</td>
                            <td>
                                <?php
                                $hand_over_result = array();
                                $myform = new form();
                                if (isset($_GET['ID'])) {
                                    $mydb = new DataBase();
                                    $result = $mydb->where('ID', $_GET['ID'])
                                            ->where('Returned=', "NO")
                                            ->get('equipment_handover');
                                    $hand_over_result = $result['result'];
                                }
                                echo $myform->dropdown($hand_over_result, "EquipmentName", "EquipmentName", array("name" => "EquipmentName", 'required' => 'required"'));
                                ?>
                            </td>
                        </tr>

                        <tr valign="baseline">
                            <td height="38" align="right" nowrap="nowrap"><?php echo $obj_lang->get('Returing Date', $lang); ?>:</td>
                            <td>

                                <input  type="Date" name="Returning_Date"  value='<?php echo date("Y-m-d"); ?>' />
                            </td>
                        </tr>

                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">&nbsp;</td>
                            <td><input type="submit" value="<?php echo $obj_lang->get('Register', $lang); ?>" onclick="return confirm('Are you sure the specifed Employee return back the selected equipment ?')"   /></td>
                        </tr>
                    </table>
                    </font>
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