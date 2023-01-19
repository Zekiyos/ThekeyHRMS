<?php
require_once('../Connections/HRMS.php');

/* Database Class Including to the page** */
if (!defined('validurl'))
    define("validurl", TRUE);
$base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
require_once $base_path . 'config/database.php';
require_once $base_path . 'lib/database.php';

$mydb = new DataBase();


require_once $base_path . 'Classes/Class_AccessLevel.php';

require_once $base_path . 'Classes/Class_language.php';

$obj_AccessLevel = new AccessLevel();
echo $obj_AccessLevel->CHK_AccessLevel();


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

    if ($_POST['Department_After_Promotion'] != "Choose Department") {


        $data = array('ID' => $_POST['ID']
            , 'FirstName' => $_POST['FirstName']
            , 'MiddelName' => $_POST['MiddelName']
            , 'LastName' => $_POST['LastName']
            , 'Evaluation_Result' => $_POST['Evaluation_Result']
            , 'Position_Before_Promotion' => $_POST['Position_Before_Promotion']
            , 'Position_After_Promotion' => $_POST['Position_After_Promotion']
            , 'Department_Before_Promotion' => $_POST['Department_Before_Promotion']
            , 'Department' => $_POST['Department_After_Promotion']
            , 'Department_After_Promotion' => $_POST['Department_After_Promotion']
            , 'Salary_Before_Promotion' => $_POST['Salary_Before_Promotion']
            , 'Salary_After_Promotion' => $_POST['Salary_After_Promotion']
            , 'Promotion_Date' => $_POST['Promotion_Date']);

        
        $Result1 = $mydb->insert('employee_Promotion', $data);


        $data = array('Department' => $_POST['Department_After_Promotion']
            , 'Position' => $_POST['Position_After_Promotion']
            , 'Salary' => $_POST['Salary_After_Promotion']
            , 'ModifiedBy' => $_SESSION['MM_Fullname']);

        $mydb->where(array('ID' => $_POST['ID']));
        $Result2 = $mydb->update('employee_personal_record', $data);


        /*         * *************Payroll data update start here */


        $data = array('Department' => $_POST['Department_After_Promotion']
            , 'Position' => $_POST['Position_After_Promotion']
            , 'Basic Salary' => $_POST['Salary_After_Promotion']
            , 'ModifiedBy' => $_SESSION['MM_Fullname']);

        $mydb->where(array('ID' => $_POST['ID']));
        $Result3 = $mydb->update('total_deduction', $data);





        for ($i = 1; $i <= 6; $i++) {

            $UpdatedTabelName = "week_" . $i . "";


            $data = array('Department' => $_POST['Department_After_Promotion']);

            $mydb->where(array('ID' => $_POST['ID']));
            $Result4 = $mydb->update($UpdatedTabelName, $data);
        }
        /* end of week data updating */

        if (($Result1) and ($Result2) and ($Result3) and ($Result4))
            echo "<script type=\"text/javascript\">alert('You have Demoted the employee Successfully.')</script>";
    }
    else {

        echo "<script type=\"text/javascript\">alert('Please Choose First Department for Promotion.')</script>";
    }
}

mysql_select_db($database_HRMS, $HRMS);
$query_RSDepartmentTransfer = "SELECT * FROM employee_personal_record";
$RSDepartmentTransfer = mysql_query($query_RSDepartmentTransfer, $HRMS) or die(mysql_error());
$row_RSDepartmentTransfer = mysql_fetch_assoc($RSDepartmentTransfer);
$totalRows_RSDepartmentTransfer = mysql_num_rows($RSDepartmentTransfer);
?>
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
                    <?php echo $obj_lang->get('Employee Promotion Form', $lang); ?> 
                </h1>
                <?php
                $_GET['TableName'] = "employee_personal_record";

                $_GET['OpenPage'] = "Promotion";

                require_once($base_path . "Search_Name/SearchName.php");
                ?>
                <?php
                mysql_free_result($RSDepartmentTransfer);
                ?>

                <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">

                    <table width="738" height="383" align="center" background="" bgcolor="#EBEBEB">
                        <tr valign="baseline">
                            <td width="150" height="39" align="right" nowrap="nowrap"><?php echo $obj_lang->get('Selected ID', $lang); ?> :</td>
                            <td width="185">
                                <input type="text" name="ID" value="<?php
                if (isset($_GET['ID'])) {
                    echo $_GET['ID'];
                }
                ?>" size="10" readonly="readonly"  />     
                            </td>
                        </tr>

                        <tr valign="baseline">
                            <td height="37" align="right" nowrap="nowrap">
                                <?php echo $obj_lang->get('First Name', $lang); ?>:
                            </td>
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
                            <td>
                                <input name="MiddelName" type="text" value="<?php
                                                    $query = "SELECT * FROM employee_personal_record";
                                                    $result = mysql_query($query);
                                                    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                                        if (isset($_GET['ID'])) {
                                                            if ($row['ID'] == $_GET['ID']) {
                                                                echo "{$row['MiddelName']}";
                                                            }
                                                        }
                                                    }
                                ?>"size="20" maxlength="20" readonly="readonly" />
                            </td>
                            <td width="163" align="right"><font color="#FF6600" size="+1"><?php echo $obj_lang->get('After', $lang); ?></font> </td>
                            <td> <font color="#FF6600" size="+1"><?php echo $obj_lang->get('Promotion', $lang); ?></font></td>
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
                                ?>" size="20" maxlength="20" readonly="readonly" /><td align="right"><?php echo $obj_lang->get('Evaluation Result', $lang); ?>:</td><td width="216">
                                    <input type="text" name="Evaluation_Result" required="required" size="15" value="0" />
                                </td>


                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td height="36"  align="right" nowrap="nowrap"><?php echo $obj_lang->get('From Department', $lang); ?>:</td>
                            <td>
                                <input name="Department_Before_Promotion" type="text" value="<?php
                                       $query = "SELECT * FROM employee_personal_record";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {
                                               if ($row['ID'] == $_GET['ID']) {
                                                   echo "{$row['Department']}";
                                               }
                                           }
                                       }
                                ?>" size="30" maxlength="20" readonly="readonly" /></td>
                            <!--select name="FromDepartment">
                                                     
                            </select-->
                            <td align="right"><?php echo $obj_lang->get('To Department', $lang); ?></td>
                            <td>
                                <select name="Department_After_Promotion">
                                    <option value="Choose Department"><?php echo $obj_lang->get('Choose Department', $lang); ?></option>
                                    <?php
                                    $sqlfromDepart = "SELECT DISTINCT Department
                                                    FROM Department
                                                    ORDER BY Department ASC";
                                    $resultfromdepart = mysql_query($sqlfromDepart);
                                    while ($row = mysql_fetch_array($resultfromdepart, MYSQL_ASSOC)) {
                                        echo "<option value=\"" . $row['Department'] . "\">" . $row['Department'] . "</option>";
                                    }
                                    ?>
                                </select> 
                            </td>

                        </tr>
                        <tr>
                            <td align="right">
                                <?php echo $obj_lang->get('Position', $lang); ?>:
                            </td>
                            <td>
                                <input name="Position_Before_Promotion" type="text" value="<?php
                                $query = "SELECT * FROM employee_personal_record";
                                $result = mysql_query($query);
                                while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                    if (isset($_GET['ID'])) {
                                        if ($row['ID'] == $_GET['ID']) {
                                            echo "{$row['Position']}";
                                        }
                                    }
                                }
                                ?>" size="30" maxlength="40" readonly="readonly" /> 
                            </td>
                            <td align="right"><?php echo $obj_lang->get('Postion', $lang); ?>:</td>
                            <td>
                                <input name="Position_After_Promotion" type="text" value="<?php
                                       $query = "SELECT * FROM employee_personal_record";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {
                                               if ($row['ID'] == $_GET['ID']) {
                                                   echo "{$row['Position']}";
                                               }
                                           }
                                       }
                                ?>" size="25" maxlength="40" />
                            </td>
                            <td width="0"></td>
                        </tr>
                        <tr>
                            <td height="23" align="right"><?php echo $obj_lang->get('Salary Before Promotion', $lang); ?>
                            </td>
                            <td>
                                <input readonly="readonly" name="Salary_Before_Promotion" type="text" value="<?php
                                       $query = "SELECT * FROM employee_personal_record";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {
                                               if ($row['ID'] == $_GET['ID']) {
                                                   echo "{$row['Salary']}";
                                               }
                                           }
                                       }
                                ?>" size="20" maxlength="40" />
                            </td>
                            <td align="right">
                                <?php echo $obj_lang->get('Salary', $lang); ?>  </td>
                            <td>
                                <input name="Salary_After_Promotion" required="required"type="text" size="15" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td height="43"  align="right" nowrap="nowrap"><?php echo $obj_lang->get('Date of Promotion', $lang); ?>:</td>
                            <td>
                                <input name="Promotion_Date" type="Date" required="required" value="<?php echo date("Y-m-d"); ?>" size="20" maxlength="20" />
                            </td>
                        </tr>

                        <tr valign="baseline">
                            <td  colspan="4" align="right"><input type="submit" value="<?php echo $obj_lang->get('Promote', $lang); ?>:" onClick="return confirm('Are you sure you want to Promote this Employee?')"   /></td>
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

