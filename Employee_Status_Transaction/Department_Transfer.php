<?php require_once('../Connections/HRMS.php'); 

if(!session_id())
{
    session_start();
}

if (!defined('validurl'))
    define("validurl", TRUE);
$base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
require_once $base_path . 'config/database.php';
require_once $base_path . 'lib/database.php';

$mydb = new DataBase();
?>
<?php
require_once('../Classes/Class_language.php');

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {


    $data = array('ID' => $_POST['ID']
        , 'FirstName' => $_POST['FirstName']
        , 'MiddelName' => $_POST['MiddelName']
        , 'LastName' => $_POST['LastName']
        , 'Position' => $_POST['Position']
        , 'FromDepartment' => $_POST['FromDepartment']
        , 'ToDepartment' => $_POST['ToDepartment']
        , 'Position_AfterTransfered' => $_POST['as']
        , 'Transfered_Date' => $_POST['Transfered_Date']);

    $Result1 = $mydb->insert('Department_Transfer', $data);



    $data = array('Department' => $_POST['ToDepartment']
        , 'Position' => $_POST['as']
        , 'ModifiedBy' => $_SESSION['MM_Fullname']);

    $mydb->where(array('ID' => $_POST['ID']));
    $Result2 = $mydb->update('employee_personal_record', $data);



    /*     * *******************Paroll data department update */

    $data = array('Department' => $_POST['ToDepartment']
        , 'Position' => $_POST['as']
        , 'ModifiedBy' => $_SESSION['MM_Fullname']);

    $mydb->where(array('ID' => $_POST['ID']));
    $Result3 = $mydb->update('total_deduction', $data);

    for ($i = 1; $i <= 6; $i++) {

        $UpdatedTabelName = "week_" . $i . "";


        $data = array('Department' => $_POST['ToDepartment']);

        $mydb->where(array('ID' => $_POST['ID']));
        $Result4 = $mydb->update($UpdatedTabelName, $data);
    }


    if (($Result1) and ($Result2) and ($Result3) and ($Result4))
        echo "<script type=\"text/javascript\">alert('You have Transfered '" . $_POST['FirstName'] . "' to department '" . $_POST['ToDepartment'] . "' Successfully.')</script>";
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
                    <?php echo $obj_lang->get('Employee Department Transfer', $lang); ?>  
                </h1>

                <?php
                $_GET['TableName'] = "employee_personal_record";

                $_GET['OpenPage'] = "Department_Transfer";

                require_once($base_path . "Search_Name/SearchName.php");
                ?>

                <?php
                mysql_free_result($RSDepartmentTransfer);
                ?>

                <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">

                    <table width="687" height="362" align="center" background="" bgcolor="#EBEBEB">
                        <tr valign="baseline">
                            <td width="168" height="39" align="right" nowrap="nowrap"> 
                                <?php echo $obj_lang->get('Selected ID', $lang); ?>:</td>
                            <td width="550">
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
                                ?>" size="20" maxlength="20" readonly="readonly" />


                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td height="36"  align="right" nowrap="nowrap"><?php echo $obj_lang->get('From Department', $lang); ?>:</td>
                            <td>
                                <input name="FromDepartment" type="text" value="<?php
                                       $query = "SELECT * FROM employee_personal_record";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {
                                               if ($row['ID'] == $_GET['ID']) {
                                                   echo "{$row['Department']}";
                                               }
                                           }
                                       }
                                ?>" size="22" maxlength="20" readonly="readonly" />
                            </td>
                            <td>
                                <label><?php echo $obj_lang->get('To', $lang); ?></label>
                            </td>
                            <td>
                                <!--select name="FromDepartment">
                                <?php /* $sqlfromDepart="SELECT DISTINCT Department
                                  FROM employee_personal_record
                                  ORDER BY Department ASC";

                                  $resultfromdepart=mysql_query($sqlfromDepart);
                                  while($row =mysql_fetch_array($resultfromdepart, MYSQL_ASSOC))
                                  {
                                  echo "<option value=\"".$row['Department']."\">".$row['Department']."</option>";

                                  }
                                 */ ?>
                                                         
                                </select-->

                                <select name="ToDepartment">
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
                                <input name="Position" type="text" value="<?php
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
                            <td>
                                <?php echo $obj_lang->get('As', $lang); ?>:
                            </td>
                            <td> 


                                <input name="as" type="text" value="<?php
                                $query = "SELECT * FROM employee_personal_record";
                                $result = mysql_query($query);
                                while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                    if (isset($_GET['ID'])) {
                                        if ($row['ID'] == $_GET['ID']) {
                                            echo "{$row['Position']}";
                                        }
                                    }
                                }
                                ?>" size="30" maxlength="40" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td height="43"  align="right" nowrap="nowrap"><?php echo $obj_lang->get('Date of Transfer', $lang); ?>:</td>
                            <td>

                                <input name="Transfered_Date" type="Date" required="required" value="<?php echo date("Y-m-d"); ?>" size="20" maxlength="20" />
                            </td>
                        </tr>

                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"></td>
                            <td align="center"><input type="submit" value="<?php echo $obj_lang->get('Transfer', $lang); ?>" onclick="return confirm('Are you sure you want to Tranfer this Employee ?')"   /></td>
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
    <!-- InstanceEnd --> </html>


