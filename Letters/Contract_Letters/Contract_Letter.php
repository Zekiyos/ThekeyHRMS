
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
                <h1 class="form_lable">
                    Create Contract Letter
                </h1>
                <?php
                $editFormAction = $_SERVER['PHP_SELF'];
                if (isset($_SERVER['QUERY_STRING'])) {
                    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
                }

                if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
                    
                }

                mysql_select_db($database_HRMS, $HRMS);
                $query_RSFristWarniing = "SELECT * FROM employee_personal_record";
                $RSFristWarniing = mysql_query($query_RSFristWarniing, $HRMS) or die(mysql_error());
                $row_RSFristWarniing = mysql_fetch_assoc($RSFristWarniing);
                $totalRows_RSFristWarniing = mysql_num_rows($RSFristWarniing);
                ?>

                <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                    <table width="1000" align="center" >
                        <tr valign="baseline">
                            <td width="132">
                                <?php
                                $_GET['TableName'] = "employee_personal_record";

                                $_GET['OpenPage'] = "Contract_Letter";

                                require_once($base_path . "Search_Name/SearchName.php");
                                ?>

                            </td></tr><tr>
                            <td width="414" align="left" nowrap="nowrap"><?php echo $obj_lang->get('First Name', $lang); ?>:
                                <input type="text" name="FirstName" value="<?php
                                $query = "SELECT * FROM total_deduction";
                                $result = mysql_query($query);
                                while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                    if (isset($_GET['ID'])) {
                                        if ($row['ID'] == $_GET['ID']) {

                                            echo "{$row['FirstName']}";
                                        }
                                    }
                                }
                                ?>" size="20" readonly="readonly"  />
                                <input type="text" name="MiddelName" value="<?php
                                       $query = "SELECT * FROM total_deduction";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {
                                               if ($row['ID'] == $_GET['ID']) {

                                                   echo "{$row['MiddelName']}";
                                               }
                                           }
                                       }
                                ?>" readonly="readonly" size="20" />
                                <input type="text" name="LastName" value="<?php
                                       $query = "SELECT * FROM total_deduction";
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
                        <tr valign="baseline"><td><?php echo $obj_lang->get('Department', $lang); ?>:<input type="text" name="Department" value="<?php
                                       $query = "SELECT * FROM total_deduction";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {
                                               if ($row['ID'] == $_GET['ID']) {

                                                   echo "{$row['Department']}";
                                               }
                                           }
                                       }
                                ?>"  readonly="readonly" size="32" />
                                <?php echo $obj_lang->get('Date', $lang); ?>:
                                <script type='text/JavaScript' src="../../Js/scw.js" ></script> <input type="text" name="Date" onclick='scwShow(this,event);' value='<?php echo date("Y-m-d"); ?>' /></td>

                        </tr>

                        <tr valign="baseline">
                            <td nowrap="nowrap" align="left" valign="top"><p><?php echo $obj_lang->get('Contract Letter', $lang); ?>
                                    <textarea class="wywyg" name="Contract Letter" style="width: 100% ; height: 400px;">
                                        <?php include_once 'latter_doc.php'; ?>
                                    </textarea>
                            </td>
                            <script type="text/javascript">
                                function toggle(element) {
                                    document.getElementById(element).style.display = (document.getElementById(element).style.display == "none") ? "" : "none";
                                    //style="display: none;"
                                }
                            </script>
                            <!--input value="ContractLetter" type="button" onClick="javascript:toggle('ContractLetter')" /-->
                            <div id="ContractLetter" ></div>
                        </tr>

                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><input type="reset" name="reset" value="<?php echo $obj_lang->get('Reset', $lang); ?>" /></td>
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
    <!-- InstanceEnd --> </html>

