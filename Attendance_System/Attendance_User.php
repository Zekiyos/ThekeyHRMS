<?php require_once('../Connections/HRMS.php'); ?>
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
                $query_RSLateTolerance = "SELECT * FROM employee_personal_record";
                $RSLateTolerance = mysql_query($query_RSLateTolerance, $HRMS) or die(mysql_error());
                $row_RSLateTolerance = mysql_fetch_assoc($RSLateTolerance);
                $totalRows_RSLateTolerance = mysql_num_rows($RSLateTolerance);
                ?>
 <?php
                $editFormAction = $_SERVER['PHP_SELF'];
                if (isset($_SERVER['QUERY_STRING'])) {
                    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
                }

                if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

                    if (!(mysql_num_rows(mysql_query("SELECT Department FROM user_attendance where Department='" . $_POST['Department'] . "'")))) {

                        $data = array('Department' => $_POST['Department']
                            , 'Prepared' => $_POST['Prepared']
                            , 'Department_Manager' => $_POST['Department_Manager']
                            , 'Checked' => $_POST['Checked']
                            , 'Approved' => $_POST['Approved']);

                        $Result1 = $mydb->insert('user_attendance', $data);

                        if ($Result1)
                            echo "<script type=\"text/javascript\">alert('You have Registered Attendance Users Successfully for {$_POST['Department']} Department.')</script>";
                    }
                    else
                        echo "<script type=\"text/javascript\">alert('Attendance Users for {$_POST['Department']} Department already Defined.If you want to redefine it,delete first defined data.')</script>";
                }
                ?>
                <?php
                mysql_select_db($database_HRMS, $HRMS);
                $query_RSDepartment = "SELECT Department FROM department ORDER BY Department ASC";
                $RSDepartment = mysql_query($query_RSDepartment, $HRMS) or die(mysql_error());
                $row_RSDepartment = mysql_fetch_assoc($RSDepartment);
                $totalRows_RSDepartment = mysql_num_rows($RSDepartment);
                ?>


                <h1 class="form_lable">
                    <?php echo $obj_lang->get('Attendance User', $lang); ?>
                </h1>
                <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                    <table width="400" height="395" align="center" background="" bgcolor="#EBEBEB">
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Department:</td>
                            <td>
                                <?php
                                $mydb = new DataBase();
                                $mydb->select('DISTINCT Section');
                                $mydb->where('Department!=', '');
                                $mydb->order_by('Department');
                                $result = $mydb->get('Department');
                                $department_list = $result['result'];
                                if ($result) {
                                    $my_form = new Form();
                                    echo $my_form->dropdown($department_list, 'Section', 'Section', array(
                                        'id' => "Department",
                                        'name' => 'Department')
                                    );
                                }
                                ?>
                            </td>
                        </tr>
                        <tr> </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Prepared By:</td>
                            <td>
                               <input type="text" name="Prepared" value='' size="15" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Department Manager:</td>
                            <td><input type="text" name="Department_Manager"  value='' size="15" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Checked By:</td>
                            <td><input type="text" name="Checked" value="" size="15" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Approved By:</td>
                            <td><input type="text" name="Approved" value="" size="15" /></td>
                        </tr>
                        
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">&nbsp;</td>
                            <td><input type="submit" value="Register" /></td>
                        </tr>
                    </table>
                    <input type="hidden" name="MM_insert" value="form1" />
                </form>


                <!-- InstanceEndEditable -->
            </div>
        </div>

    </body>
<!-- InstanceEnd --></html>


