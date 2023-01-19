
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
                $editFormAction = $_SERVER['PHP_SELF'];
                if (isset($_SERVER['QUERY_STRING'])) {
                    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
                }

                if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {



                    $insertSQL = sprintf("INSERT INTO contract_letter (Department,Job_Description,Job_Description_Amharic) VALUES ( %s, %s, %s)", '\'' . $_POST['Department'] . '\'', '\'' . $_POST['Job_Description'], "text" . '\'', '\'' . $_POST['Job_Description_Amharic'], "text" . '\'');

                    mysql_select_db($database_HRMS, $HRMS);
                    $Result1 = mysql_query($insertSQL, $HRMS) or die(mysql_error());
                }


                mysql_select_db($database_HRMS, $HRMS);
                $query_RSFristWarniing = "SELECT * FROM employee_personal_record";
                $RSFristWarniing = mysql_query($query_RSFristWarniing, $HRMS) or die(mysql_error());
                $row_RSFristWarniing = mysql_fetch_assoc($RSFristWarniing);
                $totalRows_RSFristWarniing = mysql_num_rows($RSFristWarniing);
                ?>
                <h1 class="form_lable">
                    Create Contract Letter
                </h1>
                <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                    <table width="1000" align="center">
                        <tr valign="baseline">
                            <td width="132"> 
                                <?php require_once("Select_Department4ContractLetter.php"); ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="414" align="left" nowrap="nowrap">&nbsp;</td>
                        </tr>
                        <tr valign="baseline"><td>Selected Department:<input type="text" name="Department" value="<?php if (isset($_GET['Department'])) echo $_GET['Department']; ?>"  readonly="readonly" size="32" />
                                Date:
                                <input type="date" name="Date" value='<?php echo date("Y-m-d"); ?>' /></td>

                        </tr>

                        <tr valign="baseline">
                            <td nowrap="nowrap" align="left" valign="top"><p>English Job Description   
                                    <textarea  style="width: 700px; height: 400px" name="Job_Description"></textarea>
                            </td>
                            <div id="ContractLetter" ></div>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="left" valign="top"><p>Amharic Job Description 
                                    <textarea name="Job_Description_Amharic" style="width: 700px; height: 400px" ></textarea>
                            </td>

                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="center">
                                <input type="reset" name="reset" value="Reset" />
                                <input type="submit" value="Creat Contract" onClick="return confirm('Are you sure you want to Creat This Contract Letter for the selected Department?')" />  
                            </td>
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

