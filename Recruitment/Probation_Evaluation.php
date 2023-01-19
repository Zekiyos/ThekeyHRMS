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
                echo '<p class="WelCome">Wel Come ' . $_SESSION['MM_Fullname'] . "</p>";

                $mydb = new DataBase();
                ?>
                <?php
                $editFormAction = $_SERVER['PHP_SELF'];
                if (isset($_SERVER['QUERY_STRING'])) {
                    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
                }

                $editFormAction = $_SERVER['PHP_SELF'];
                if (isset($_SERVER['QUERY_STRING'])) {
                    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
                }



                if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

                    $data = array('ID' => $_POST['ID']
                        , 'FirstName' => $_POST['FirstName']
                        , 'MiddelName' => $_POST['MiddelName']
                        , 'LastName' => $_POST['LastName']
                        , 'Department' => $_POST['Department']
                        , 'Date_Employement' => $_POST['Date_Employement']
                        , 'Attendance' => $_POST['Attendance']
                        , 'Motivation' => $_POST['Motivation']
                        , 'Performance_Individual' => $_POST['Performance_Individual']
                        , 'Performance_Group' => $_POST['Performance_Group']
                        , 'Communication_Supervisor' => $_POST['Communication_Supervisor']
                        , 'Manger_Remark' => $_POST['Manger_Remark']
                        , 'HR_Opinon' => $_POST['HR_Opinon']
                        , 'Date' => $_POST['Date']
                        , 'Result' => $_POST['Result']);

                    $Result1 = $mydb->insert('probation_evalutaion', $data);


                    if ($Result1)
                        echo "<script type=\"text/javascript\">alert('You have Set Probation Evaluation For the Selcted Employee  {$_POST['FirstName']}  {$_POST['MiddelName']}  Successfully.')</script>";
                }

                mysql_select_db($database_HRMS, $HRMS);
                $query_RSProbationEvaluation = "SELECT * FROM probation_evalutaion";
                $RSProbationEvaluation = mysql_query($query_RSProbationEvaluation, $HRMS) or die(mysql_error());
                $row_RSProbationEvaluation = mysql_fetch_assoc($RSProbationEvaluation);
                $totalRows_RSProbationEvaluation = mysql_num_rows($RSProbationEvaluation);

                mysql_select_db($database_HRMS, $HRMS);
                $query_RSRecuriut4Evaluation = "SELECT * FROM recruitment";
                $RSRecuriut4Evaluation = mysql_query($query_RSRecuriut4Evaluation, $HRMS) or die(mysql_error());
                $row_RSRecuriut4Evaluation = mysql_fetch_assoc($RSRecuriut4Evaluation);
                $totalRows_RSRecuriut4Evaluation = mysql_num_rows($RSRecuriut4Evaluation);
                ?>
                <h1 class="form_lable"><?php echo $obj_lang->get(' Employee Probation period Stay Evaluation', $lang); ?> </h1> 
                <?php
                $_GET['TableName'] = "recruitment";

                $_GET['OpenPage'] = "Probation_Evaluation";

                require_once($base_path . "Search_Name/SearchName.php");
                ?>
                <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                    <table width="560" height="559" align="center">
                        <tr valign="baseline">
                            <td height="24" align="right" nowrap="nowrap"><?php echo $obj_lang->get('Selected ID', $lang); ?> :</td>
                            <td><input type="text" readonly="readonly" name="ID" value="<?php
                if (isset($_GET['ID'])) {
                    echo $_GET['ID'];
                }
                ?>" size="15" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td width="202" align="right" nowrap="nowrap"><?php echo $obj_lang->get('First Name', $lang); ?>:</td>
                            <td width="313"><input  readonly="readonly"  type="text" name="FirstName" value="<?php
                                       $query = "SELECT * FROM recruitment";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {
                                               if ($row['ID'] == $_GET['ID']) {
                                                   echo "{$row['FirstName']}";
                                               }
                                           }
                                       }
                ?>"
                                                    size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Middel Name', $lang); ?>:</td>
                            <td><input  readonly="readonly"  type="text"  name="MiddelName" value="<?php
                                                    $query = "SELECT * FROM recruitment";
                                                    $result = mysql_query($query);
                                                    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                                        if (isset($_GET['ID'])) {
                                                            if ($row['ID'] == $_GET['ID']) {
                                                                echo "{$row['MiddelName']}";
                                                            }
                                                        }
                                                    }
                ?>"
                                        size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Last Name', $lang); ?>:</td>
                            <td><input  readonly="readonly"  type="text" name="LastName" value="<?php
                                        $query = "SELECT * FROM recruitment";
                                        $result = mysql_query($query);
                                        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                            if (isset($_GET['ID'])) {
                                                if ($row['ID'] == $_GET['ID']) {
                                                    echo "{$row['LastName']}";
                                                }
                                            }
                                        }
                ?>"
                                        size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td height="24" align="right" nowrap="nowrap"><?php echo $obj_lang->get('Department', $lang); ?>:</td>
                            <td><input  readonly="readonly"  type="text" name="Department" value="<?php
                                        $query = "SELECT * FROM recruitment";
                                        $result = mysql_query($query);
                                        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                            if (isset($_GET['ID'])) {
                                                if ($row['ID'] == $_GET['ID']) {
                                                    echo "{$row['Department']}";
                                                }
                                            }
                                        }
                ?>" size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td height="27" align="right" nowrap="nowrap"><?php echo $obj_lang->get('Position', $lang); ?>:</td>
                            <td><input  readonly="readonly"  type="text" name="Position" value="<?php
                                        $query = "SELECT * FROM recruitment";
                                        $result = mysql_query($query);
                                        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                            if (isset($_GET['ID'])) {
                                                if ($row['ID'] == $_GET['ID']) {
                                                    echo "{$row['Position']}";
                                                }
                                            }
                                        }
                ?>"
                                        size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td height="24" align="right" nowrap="nowrap"><?php echo $obj_lang->get('Date of Employement', $lang); ?>:</td>
                            <td><input type="text" name="Date_Employement" value="<?php
                                        $query = "SELECT * FROM recruitment";
                                        $result = mysql_query($query);
                                        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                            if (isset($_GET['ID'])) {
                                                if ($row['ID'] == $_GET['ID']) {
                                                    echo "{$row['Date']}";
                                                }
                                            }
                                        }
                ?>"
                                       size="32"  readonly="readonly"/></td>
                        </tr>
                        <tr valign="baseline">
                            <td  height="29" nowrap="nowrap" align="right"><?php echo $obj_lang->get('Attendance', $lang); ?>:</td>
                            <td >
                                <select name="Attendance" size="1">
                                    <option value="Poor" <?php
                                       if (!(strcmp("Poor", ""))) {
                                           echo "SELECTED";
                                       }
                ?>><?php echo $obj_lang->get('Poor', $lang); ?></option>
                                    <option value="Good" <?php
                                            if (!(strcmp("Good", ""))) {
                                                echo "SELECTED";
                                            }
                ?>><?php echo $obj_lang->get('Good', $lang); ?></option>
                                    <option value="Very Good" <?php
                                            if (!(strcmp("Very Good", ""))) {
                                                echo "SELECTED";
                                            }
                ?>><?php echo $obj_lang->get('Very Good', $lang); ?></option>
                                </select>
                                </p>
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td height="31" nowrap="nowrap" align="right"><?php echo $obj_lang->get('Motivation', $lang); ?>:</td>
                            <td>
                                <select name="Motivation" size="1">
                                    <option value="Poor" <?php
                                            if (!(strcmp("Poor", ""))) {
                                                echo "SELECTED";
                                            }
                ?>><?php echo $obj_lang->get('Poor', $lang); ?></option>
                                    <option value="Good" <?php
                                            if (!(strcmp("Good", ""))) {
                                                echo "SELECTED";
                                            }
                ?>><?php echo $obj_lang->get('Good', $lang); ?></option>
                                    <option value="Very Good" <?php
                                            if (!(strcmp("Very Good", ""))) {
                                                echo "SELECTED";
                                            }
                ?>><?php echo $obj_lang->get('Very Good', $lang); ?></option>
                                </select></td>
                        </tr>
                        <tr valign="baseline">
                            <td height="28" align="right" nowrap="nowrap"><?php echo $obj_lang->get('Performance as Individual', $lang); ?>:</td>
                            <td><p>
                                    <select name="Performance_Individual" size="1">
                                        <option value="Poor" <?php
                                            if (!(strcmp("Poor", ""))) {
                                                echo "SELECTED";
                                            }
                ?>><?php echo $obj_lang->get('Poor', $lang); ?></option>
                                        <option value="Good" <?php
                                                if (!(strcmp("Good", ""))) {
                                                    echo "SELECTED";
                                                }
                ?>><?php echo $obj_lang->get('Good', $lang); ?></option>
                                        <option value="Very Good" <?php
                                                if (!(strcmp("Very Good", ""))) {
                                                    echo "SELECTED";
                                                }
                ?>><?php echo $obj_lang->get('Very Good', $lang); ?></option>
                                    </select>
                                </p></td>
                        </tr>
                        <tr valign="baseline">
                            <td height="28" nowrap="nowrap" align="right"><?php echo $obj_lang->get('Performance in Group', $lang); ?>:</td>
                            <td><p>
                                    <select name="Performance_Group" size="1">
                                        <option value="Poor" <?php
                                                if (!(strcmp("Poor", ""))) {
                                                    echo "SELECTED";
                                                }
                ?>><?php echo $obj_lang->get('Poor', $lang); ?></option>
                                        <option value="Good" <?php
                                                if (!(strcmp("Good", ""))) {
                                                    echo "SELECTED";
                                                }
                ?>><?php echo $obj_lang->get('Good', $lang); ?></option>
                                        <option value="Very Good" <?php
                                                if (!(strcmp("Very Good", ""))) {
                                                    echo "SELECTED";
                                                }
                ?>><?php echo $obj_lang->get('Very Good', $lang); ?></option>
                                    </select>
                                </p></td>
                        </tr>
                        <tr valign="baseline">
                            <td height="24" align="right" nowrap="nowrap"><?php echo $obj_lang->get('Communication with Supervisor', $lang); ?>:</td>
                            <td><select name="Communication_Supervisor" size="1">
                                    <option value="Poor" <?php
                                                if (!(strcmp("Poor", ""))) {
                                                    echo "SELECTED";
                                                }
                ?>><?php echo $obj_lang->get('Poor', $lang); ?></option>
                                    <option value="Good" <?php
                                            if (!(strcmp("Good", ""))) {
                                                echo "SELECTED";
                                            }
                ?>><?php echo $obj_lang->get('Good', $lang); ?></option>
                                    <option value="Very Good" <?php
                                            if (!(strcmp("Very Good", ""))) {
                                                echo "SELECTED";
                                            }
                ?>><?php echo $obj_lang->get('Very Good', $lang); ?></option>
                                </select></td>
                        </tr>
                        <tr valign="baseline">
                            <td height="58" align="right" valign="top" nowrap="nowrap"><?php echo $obj_lang->get('Manger Remark', $lang); ?>:</td>
                            <td><textarea name="Manger_Remark" cols="50" rows="3"></textarea></td>
                        </tr>
                        <tr valign="baseline">
                            <td height="56" align="right" valign="top" nowrap="nowrap"><?php echo $obj_lang->get('HR Opinon', $lang); ?>:</td>
                            <td><textarea name="HR_Opinon" cols="50" rows="3"></textarea></td>
                        </tr>
                        <tr valign="baseline">
                            <td height="41" align="right" nowrap="nowrap"><?php echo $obj_lang->get('Result', $lang); ?>:</td>
                            <td><select name="Result" size="1">

                                    <option value="Failed" <?php
                                            if (!(strcmp("Failed", ""))) {
                                                echo "SELECTED";
                                            }
                ?>><?php echo $obj_lang->get('Failed', $lang); ?></option>
                                    <option value="Passed" <?php
                                            if (!(strcmp("Passed", ""))) {
                                                echo "SELECTED";
                                            }
                ?>><?php echo $obj_lang->get('Passed', $lang); ?></option>         
                                </select>
                            </td>
                        </tr>   
                        <tr>
                            <td align="right">
                                <?php echo $obj_lang->get('Date', $lang); ?>:
                            </td>
                            <td>
                                <input type="Date" name="Date" value="<?php echo date("Y-m-d"); ?>" size="20" />
                            </td>
                        </tr>

                        <tr valign="baseline">
                            <td height="26" align="right" nowrap="nowrap">&nbsp;</td>
                            <td>
                                <input type="submit" value="<?php echo $obj_lang->get('Enter', $lang); ?>"  onClick="return confirm('Are you sure you want to this evalution for this Employee?')"      /></td>
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