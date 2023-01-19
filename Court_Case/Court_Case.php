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

            <div id="mainContent">
                <!-- InstanceBeginEditable name="MainContent" -->
                <?php
                echo '<p class="WelCome">Wel Come "' . $_SESSION['MM_Fullname'] . "\"</p>";

                $mydb = new DataBase();


                $editFormAction = $_SERVER['PHP_SELF'];
                if (isset($_SERVER['QUERY_STRING'])) {
                    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
                }

                if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

                    //DELETE FROM table_name WHERE some_column=some_value

                    $data = array('ID' => $_POST['ID']
                        , 'FirstName' => $_POST['FirstName']
                        , 'MiddelName' => $_POST['MiddelName']
                        , 'LastName' => $_POST['LastName']
                        , 'Department' => $_POST['Department']
                        , 'FileNumber' => $_POST['FileNumber']
                        , 'ClaimAmount' => $_POST['ClaimAmount']
                        , 'AdvocateName' => $_POST['AdvocateName']
                        , 'Court' => $_POST['Court']
                        , 'Case' => $_POST['Case']
                        , 'Result' => $_POST['Result']
                        , 'Decision' => $_POST['Decision']
                        , 'Case_Status' => $_POST['Case_Status']
                        , 'AppointmentDate' => $_POST['AppointmentDate']
                        , 'FileDate' => $_POST['FileDate']);


                    $Result1 = $mydb->insert('court_case', $data);

                    if ($Result1)
                        echo "<script type=\"text/javascript\">alert('Cour case data registred Successfully.') </script>";



                    /*                     * **************Mailing Cour Case****************** */

                    $sqlmu = "SELECT * FROM `Users_mail_account` WHERE `Mail_Recipient_Group`='Court Case' OR `Mail_Recipient_Group`='All'";

                    $result = mysql_query($sqlmu);
                    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                        $Subject = "Court Case Appointement " . date("Y-m-d");
                        $msg = " ID:" . $_GET['ID'] . "<br/>";
                        $msg = $msg . "Plaintiff Full Name:-" . $_POST['FirstName'] . " " . $_POST['MiddelName'] . " " . $_POST['LastName'];

                        send_email("rajumesfin@gmail.com", ".$Subject.", ".$msg.");
                    }


                    /*                     * ************end of mailing Cout Case************ */
                }

                mysql_select_db($database_HRMS, $HRMS);
                $query_RSTermination = "SELECT * FROM terminated_employee";
                $RSTermination = mysql_query($query_RSTermination, $HRMS) or die(mysql_error());
                $row_RSTermination = mysql_fetch_assoc($RSTermination);
                $totalRows_RSTermination = mysql_num_rows($RSTermination);
                ?>
                <h1 class="form_lable">
                    <?php echo $obj_lang->get('Court Cases Registration Form', $lang); ?>
                </h1>
                <?php
                $mydb = new DataBase();


                $_GET['TableName'] = "terminated_employee";

                $_GET['OpenPage'] = "Court_Case";

                require_once($base_path . "Search_Name/SearchName.php");
                ?>
                <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" >
                    <table width="486" height="345" align="center" bgcolor="#EBEBEB">
                        <tr valign="baseline">
                            <td width="155" align="right" nowrap="nowrap">ID:</td>
                            <td width="319">
                                <input  readonly="readonly"  type="text" name="ID" value="<?php
                if (isset($_GET['ID'])) {

                    echo $_GET['ID'];
                }
                ?>" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('First Name', $lang); ?>:</td>
                            <td><input readonly="readonly" type="text" name="FirstName" value="<?php
                                        $query = "SELECT * FROM terminated_employee";
                                        $result = mysql_query($query);
                                        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                            if (isset($_GET['ID'])) {


                                                if ($row['ID'] == $_GET['ID']) {
                                                    echo "{$row['FirstName']}";
                                                }
                                            }
                                        }
                ?>"size="20" maxlength="20"  /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Middel Name', $lang); ?>:</td>
                            <td><input  readonly="readonly"  type="text" name="MiddelName" value="<?php
                                       $query = "SELECT * FROM terminated_employee";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {


                                               if ($row['ID'] == $_GET['ID']) {
                                                   echo "{$row['MiddelName']}";
                                               }
                                           }
                                       }
                ?>" size="20" maxlength="20"  /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Last Name', $lang); ?>:</td>
                            <td><input  readonly="readonly"  type="text" name="LastName" value="<?php
                                        $query = "SELECT * FROM terminated_employee";
                                        $result = mysql_query($query);
                                        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                            if (isset($_GET['ID'])) {


                                                if ($row['ID'] == $_GET['ID']) {
                                                    echo "{$row['LastName']}";
                                                }
                                            }
                                        }
                ?>"size="20" maxlength="20"  /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Department', $lang); ?>:</td>
                            <td><input  readonly="readonly"  type="text" name="Department" value="<?php
                                        $query = "SELECT * FROM terminated_employee";
                                        $result = mysql_query($query);
                                        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                            if (isset($_GET['ID'])) {
                                                if ($row['ID'] == $_GET['ID']) {
                                                    echo "{$row['Department']}";
                                                }
                                            }
                                        }
                ?>"size="20" maxlength="35"  /></td>


                        </tr>
                        <tr>
                            <td nowrap="nowrap" align="right">
                                <?php echo $obj_lang->get('File Number', $lang); ?>:
                            </td>
                            <td>
                                <input type="text" name="FileNumber" required="required" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('File Date', $lang); ?>:</td>
                            <td>
                                <input type="Date" name="FileDate" required="required" value='<?php echo date("Y-m-d"); ?>' /></td>
                        </tr>
                        <tr>
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Calim Amount in Birr', $lang); ?>:</td>
                            <td><input type="text" required="required" name="ClaimAmount" /></td>
                        </tr>
                        <tr>
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Advocator Name', $lang); ?>:</td>
                            <td><input type="text" name="AdvocateName" required="required" /></td>
                        </tr>

                        <tr valign="baseline"><td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Court', $lang); ?></td><td>
                                <select id="Court" name="Court" size="1">
                                    <option>Woreda</option>
                                    <option>Higher Court</option>
                                    <option>Oromia Supreme Court</option>
                                    <option>State Cassation</option>
                                    <option>Federal Supreme Court</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Case', $lang); ?>:</td>
                            <td><textarea name="Case" id="Case" rows="5" cols="45"></textarea></td>
                        </tr>
                        <tr valign="baseline"><td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Decision', $lang); ?></td><td>

                                <input type="radio" name="Decision" value="Against Company"   /><?php echo $obj_lang->get('Against Company', $lang); ?>
                                <input type="radio" name="Decision" value="Infavour Company"  /><?php echo $obj_lang->get('Infavour Company', $lang); ?><br />
                                <input align="middle"  type="radio" name="Decision" value="Unknown" checked="checked"  /><?php echo $obj_lang->get('Unknown', $lang); ?>
                            </td>
                        </tr>
                        <tr>
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Decision Result', $lang); ?>:</td>
                            <td><textarea name="Result" id="Result" rows="5" cols="45"></textarea></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Case Status', $lang); ?></td>
                            <td>
                                <select name="Case_Status">
                                    <option value="Pending"><?php echo $obj_lang->get('Pending', $lang); ?></option>
                                    <option value="Appealed"><?php echo $obj_lang->get('Closed', $lang); ?></option>
                                </select>
                            </td>
                        </tr>

                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Appointment Date', $lang); ?>:</td>
                            <td>

                                <input type="Date" name="AppointmentDate"  value='' />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">&nbsp;</td>
                            <td><input type="submit" value="<?php echo $obj_lang->get('Register', $lang); ?>" onclick="return confirm('Are you sure you want to register this case for the specifed former employee? Click Ok to register Or cancel to omit registering the data.')" /></td>
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


