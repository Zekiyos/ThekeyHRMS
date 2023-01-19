<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <!--meta http-equiv="Content-Type" content="text/html; charset=utf-8" /-->
        <title>Thekey HRMS</title>

        <?php
        $dont_check = true;
        $base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
        require_once $base_path . 'Templates/head.php';
        ?>
    </head>

    <body>
        <div id="busy" style="display: none;">
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

                if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

                    $data = array(
                        'Attendance' => $_POST['Attendance']
                        , 'Motivation' => $_POST['Motivation']
                        , 'Performance_Individual' => $_POST['Performance_Individual']
                        , 'Performance_Group' => $_POST['Performance_Group']
                        , 'Communication_Supervisor' => $_POST['Communication_Supervisor']
                        , 'Manger_Remark' => $_POST['Manger_Remark']
                        , 'HR_Opinon' => $_POST['HR_Opinon']
                        , 'Date' => $_POST['Date']
                        , 'Result' => $_POST['Result']
                        , 'ModifiedBy' => $_SESSION['MM_Username']);

                    $mydb->where(array('Auto_ID' => $_POST['Auto_ID']));
                    $Result1 = $mydb->update('probation_evalutaion', $data);

                    if ($Result1)
                        echo "<script type=\"text/javascript\">alert('You have Updated Probation Evaluation For the Selcted Employee  {$_POST['FirstName']}  {$_POST['MiddelName']}  Successfully.')</script>";
                }

                mysql_select_db($database_HRMS, $HRMS);
                if (isset($_GET['Auto_ID'])) {

                    $query_RSProbationEvaluationUpdate = "SELECT * FROM  probation_evalutaion where Auto_ID=" . $_GET['Auto_ID'] . "";
                }else
                    $query_RSProbationEvaluationUpdate = "SELECT * FROM probation_evalutaion where Auto_ID=-1";

                $RSProbationEvaluationUpdate = mysql_query($query_RSProbationEvaluationUpdate, $HRMS) or die(mysql_error());
                $row_RSProbationEvaluationUpdate = mysql_fetch_assoc($RSProbationEvaluationUpdate);
                $totalRows_RSProbationEvaluationUpdate = mysql_num_rows($RSProbationEvaluationUpdate);
                $options = array(array("filed" => "Poor"), array("filed" => "Good"), array("filed" => "Very Good"));
                $myform = new Form();
                ?>
                <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                    <h1 class="form_lable">
                        Probation Evaluation Data Update Form
                    </h1>
                    <table align="center">
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">ID:</td>
                            <td><input type="text" readonly="readonly" name="ID" value="<?php echo htmlentities($row_RSProbationEvaluationUpdate['ID'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">First Name:</td>
                            <td><input type="text" readonly="readonly"  name="FirstName" value="<?php echo htmlentities($row_RSProbationEvaluationUpdate['FirstName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Middel Name:</td>
                            <td><input type="text" readonly="readonly"  name="MiddelName" value="<?php echo htmlentities($row_RSProbationEvaluationUpdate['MiddelName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Last Name:</td>
                            <td><input type="text"  readonly="readonly" name="LastName" value="<?php echo htmlentities($row_RSProbationEvaluationUpdate['LastName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Department:</td>
                            <td><input type="text"  readonly="readonly" name="Department" value="<?php echo htmlentities($row_RSProbationEvaluationUpdate['Department'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Position:</td>
                            <td><input type="text" readonly="readonly"  name="Position" value="<?php echo htmlentities($row_RSProbationEvaluationUpdate['Position'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Date of Employement:</td>
                            <td><input type="text"  readonly="readonly" name="Date_Employement" value="<?php echo htmlentities($row_RSProbationEvaluationUpdate['Date_Employement'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Attendance:</td>
                            <td>
                                <?php  echo $myform->dropdown($options, "filed", "filed", array("name" => "Attendance"), $row_RSProbationEvaluationUpdate['Attendance']); ?>
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Motivation:</td>
                            <td>
                                <?php echo $myform->dropdown($options, "filed", "filed", array("name" => "Motivation"), $row_RSProbationEvaluationUpdate['Motivation']); ?>
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Performance as Individual:</td>
                            <td>
                                <?php echo $myform->dropdown($options, "filed", "filed", array("name" => "Performance_Individual"), $row_RSProbationEvaluationUpdate['Performance_Individual']); ?>
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Performance in Group:</td>
                            <td>
                                <?php echo $myform->dropdown($options, "filed", "filed", array("name" => "Performance_Group"), $row_RSProbationEvaluationUpdate['Performance_Group']); ?>
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Communication with Supervisor:</td>
                            <td>
                                <?php echo $myform->dropdown($options, "filed", "filed", array("name" => "Communication_Supervisor"), $row_RSProbationEvaluationUpdate['Communication_Supervisor']); ?>
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right" valign="top">Manger Remark:</td>
                            <td><textarea name="Manger_Remark" cols="50" rows="5"><?php echo htmlentities($row_RSProbationEvaluationUpdate['Manger_Remark'], ENT_COMPAT, 'utf-8'); ?></textarea></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right" valign="top">HR Opinon:</td>
                            <td><textarea name="HR_Opinon" cols="50" rows="5"><?php echo htmlentities($row_RSProbationEvaluationUpdate['HR_Opinon'], ENT_COMPAT, 'utf-8'); ?></textarea></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Date:</td>
                            <td><input type="text" name="Date" value="<?php echo htmlentities($row_RSProbationEvaluationUpdate['Date'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Result:</td>
                            <td>
                                <?php
                                $result_option = array(array("filed" => "Failed"), array("filed" => "Passed"));
                                echo $myform->dropdown($result_option, "filed", "filed", array("name" => "Result"), $row_RSProbationEvaluationUpdate['Result']);
                                ?>
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">&nbsp;</td>
                            <td><input type="submit" value="Update record" /></td>
                        </tr>
                    </table>
                    <input type="hidden" name="MM_update" value="form1" />
                    <input type="hidden" name="Auto_ID" value="<?php echo $row_RSProbationEvaluationUpdate['Auto_ID']; ?>" />
                </form>
            </div>
        </div>
    </body>
</html>