 
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
                mysql_select_db($database_HRMS, $HRMS);
                $query_RSTraining = "SELECT * FROM employee_personal_record";
                $RSTraining = mysql_query($query_RSTraining, $HRMS) or die(mysql_error());
                $row_RSTraining = mysql_fetch_assoc($RSTraining);
                $totalRows_RSTraining = mysql_num_rows($RSTraining);
                ?>

                <?php
                $editFormAction = $_SERVER['PHP_SELF'];
                if (isset($_SERVER['QUERY_STRING'])) {
                    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
                }

                if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

                    $data = array('ID' => $_POST['ID']
                        , 'FirstName' => $_POST['FirstName']
                        , 'MiddelName' => $_POST['MiddelName']
                        , 'LastName' => $_POST['LastName']
                        , 'TrainingName' => $_POST['TrainingName']
                        , 'Training_Start_Date' => $_POST['Training_Start_Date']
                        , 'Training_End_Date' => $_POST['Training_End_Date']
                        , 'Refreshment_Date' => $_POST['Refreshment_Date']
                        , 'Status' => $_POST['Status']);

                    $Result1 = $mydb->insert('Training', $data);

                    if ($Result1)
                        echo "<script type=\"text/javascript\">alert('You have registed Training Data Successfully.')</script>";
                }
                ?>
                <h1 class="form_lable">
                    <?php echo $obj_lang->get('Training status entry Form ', $lang); ?>
                </h1>
                <?php
                $_GET['TableName'] = "employee_personal_record";

                $_GET['OpenPage'] = "Training";

                require_once($base_path . "Search_Name/SearchName.php");
                ?>
                <?php
                mysql_free_result($RSTraining);
                ?>
                <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">

                    <table width="400" height="395" align="center" background="" bgcolor="#EBEBEB">
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
                ?>"  


                                                    size="20" maxlength="20" readonly="readonly" align="left" /></td>
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
                            <td height="36"  align="right" nowrap="nowrap"><?php echo $obj_lang->get('Training', $lang); ?>:</td>
                            <td>
                                <select name="TrainingName">
                                    <option>Please Choose the Training</option>
                                    <option>Internal Audit</option>
                                    <option>Environmental  Risk Assessment Course</option>
                                    <option>Safety  Officers  course</option>
                                    <option>Safety Committee </option>
                                    <option>Safe Use and Handling of Chemicals</option>
                                    <option>Farm Store Keeping</option>
                                    <option>Farm Scouting and IPM application</option>
                                    <option>Gender and Equity</option>
                                    <option>Peer Education</option>

                                </select>
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td height="43"  align="right" nowrap="nowrap"><?php echo $obj_lang->get('Training Start Date', $lang); ?>:</td>
                            <td>
                                <input name="Training_Start_Date" type="Date"  value="<?php echo date("Y-m-d"); ?>" size="20" maxlength="20" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td height="50" align="right" nowrap="nowrap"><?php echo $obj_lang->get('Training End Date', $lang); ?>:</td>
                            <td>
                                <input type="Date" name="Training_End_Date"   value='<?php echo date("Y-m-d"); ?>' />
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo $obj_lang->get('Training Refreshment Date', $lang); ?>:</td>
                            <td><input type="Date"name="Refreshment_Date" id="Refreshment_Date"  value='<?php echo date("Y-m-d"); ?>' /></td>
                        </tr>
                        <tr>
                            <td height="48" align="right"><?php echo $obj_lang->get('Status', $lang); ?>: </td>
                            <td>
                                <input type="radio" name="Status" value="Incomplete" /><?php echo $obj_lang->get('Incomplete', $lang); ?>
                                <input type="radio" name="Status" value="Complete" /><?php echo $obj_lang->get('Complete', $lang); ?>

                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">&nbsp;</td>
                            <td><input type="submit" value="<?php echo $obj_lang->get('Register', $lang); ?>" onclick="return confirm('Are you sure you want to registered the specfied training for this Employee?')"   /></td>
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