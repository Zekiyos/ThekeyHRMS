
<!-- TinyMCE -->
<script type="text/javascript" src="../../Js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="../../Js/tiny_mce/tinyMCE.js"></script>
<!-- /TinyMCE -->

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


                    $count = 0;
                    $queryDA = "SELECT * FROM Disciplinary_action where id='" . $_GET['ID'] . "'";
                    $resultDA = mysql_query($queryDA);
                    while ($rowDA = mysql_fetch_array($resultDA, MYSQL_ASSOC)) {

                        if ($rowDA['ID'] == $_GET['ID']) {
                            $updateDASQL = "UPDATE Disciplinary_action SET `Second_Inistance`='" . $_POST['Second_Inistance'] . "',`Second_Inistance_Date`='" . $_POST['Second_Inistance_Date'] . "' WHERE ID = '" . $_GET['ID'] . "'";
                            mysql_query($updateDASQL);

                            $count = 1;
                        }
                    }



                    if ($count == 0) {
                        $data = array('ID' => $_GET['ID']
                            , 'FirstName' => $_POST['FirstName']
                            , 'MiddelName' => $_POST['MiddelName']
                            , 'LastName' => $_POST['LastName']
                            , 'Department' => $_POST['Department']
                            , 'Second_Inistance' => $_POST['Second_Inistance']
                            , 'Second_Inistance_Date' => $_POST['Second_Inistance_Date']
                        );
                        //, 'ModifiedBy' => $_SESSION['MM_Fullname']
                        $Result1 = $mydb->insert('disciplinary_action', $data);

                        if ($Result1)
                            echo "<script type=\"text/javascript\">alert('You have issued Second Inistance Warning Letter  for {$_POST['FirstName']}  {$_POST['MiddelName']}  Successfully.')</script>";
                    }
                }

                mysql_select_db($database_HRMS, $HRMS);
                $query_RSFristWarniing = "SELECT * FROM employee_personal_record";
                $RSFristWarniing = mysql_query($query_RSFristWarniing, $HRMS) or die(mysql_error());
                $row_RSFristWarniing = mysql_fetch_assoc($RSFristWarniing);
                $totalRows_RSFristWarniing = mysql_num_rows($RSFristWarniing);
                ?>
                <h1 class="form_lable">
                    <?php echo $obj_lang->get('Second Instance Warning Letter', $lang); ?>
                </h1>
                <?php
                $_GET['TableName'] = "employee_personal_record";

                $_GET['OpenPage'] = "Second_Instance_Warning";

                require_once($base_path . "Search_Name/SearchName.php");
                ?>
                <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                    <table width="706" align="center">
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
                ?>" size="20" readonly="readonly"  />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Middel Name', $lang); ?>:</td><td>
                                <input type="text" name="MiddelName" value="<?php
                                       $query = "SELECT * FROM employee_personal_record";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {
                                               if ($row['ID'] == $_GET['ID']) {

                                                   echo "{$row['MiddelName']}";
                                               }
                                           }
                                       }
                ?>" readonly="readonly" size="20" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">
                                <?php echo $obj_lang->get('Last Name', $lang); ?>:</td><td>
                                <input type="text" name="LastName" value="<?php
                                $query = "SELECT * FROM employee_personal_record";
                                $result = mysql_query($query);
                                while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                    if (isset($_GET['ID'])) {
                                        if ($row['ID'] == $_GET['ID']) {

                                            echo "{$row['LastName']}";
                                        }
                                    }
                                }
                                ?>"  readonly="readonly" size="20" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">
                                <label><?php echo $obj_lang->get('Department', $lang); ?>:</label>
                            </td>
                            <td>
                                <input type="text" name="Department" value="<?php
                                       $query = "SELECT * FROM employee_personal_record";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {
                                               if ($row['ID'] == $_GET['ID']) {

                                                   echo "{$row['Department']}";
                                               }
                                           }
                                       }
                                ?>"  readonly="readonly" size="32" />
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                                <label> <?php echo $obj_lang->get('Date', $lang); ?>:</label>
                            </td>
                            <td>
                                <input type="Date" name="Second_Inistance_Date"  value='<?php echo date("Y-m-d"); ?>' />
                            </td>
                        </tr

                        <tr valign="baseline">
                            <td colspan="2">
                                <br/>
                                <?php echo $obj_lang->get('Second Instance', $lang); ?>
                                <?php echo $obj_lang->get('Sample', $lang); ?>
                                <?php echo $obj_lang->get('Warning Letter', $lang); ?><hr/>
                                <textarea name="Second_Inistance" cols="60" rows="40">
                                    <?php require_once('Warning Letters Format/Second_Instance_Warning_Letter.php'); ?>
                                </textarea>
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">&nbsp;</td>
                            <td align="right">
                                <input type="reset" name="reset" value="<?php echo $obj_lang->get('Reset', $lang); ?>" />
                                <input type="submit" value="<?php echo $obj_lang->get('Issue This Letter', $lang); ?>" onClick="return confirm('Are you sure you want to This Letter for this Employee?')" /></td>
                        </tr>
                    </table>
                    <input type="hidden" name="MM_insert" value="form1" />
                </form>

                <script type="text/javascript">
                    if (document.location.protocol == 'file:') {
                        alert("The examples might not work properly on the local file system due to security settings in your browser. Please use a real webserver.");
                    }
                </script>
                <!-- InstanceEndEditable -->
            </div>
        </div>

    </body>
    <!-- InstanceEnd --> 
</html>

