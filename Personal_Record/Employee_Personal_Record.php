<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/ThekeyHRMS_main_Template.dwt" codeOutsideHTMLIsLocked="false" -->
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
        <div id="busy" >
            <img alt="Am Working" src="http://<?php echo $base_url ?>images/BusyAnimation.gif">
        </div>
        <div id="thekey_page" class="not_pop_up">
            <?php
            $editFormAction = $_SERVER['PHP_SELF'];
            if (isset($_SERVER['QUERY_STRING'])) {
                $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
            }

            if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

                $fileuploder = new file_upload();
                $fileuploder->allowedType("jpg");
                $fileuploder->uploadpath($base_path . "Employee_Images");
                $fileuploder->doupload(isset($_POST['ID']) ? $_POST['ID'] . '.jpg' : '', true);

                $uploadedfiles = $fileuploder->uploadedfiles();
                $error = $fileuploder->showerror();
                if (!isset($error_message))
                    $error_message = '';

                foreach ($error as $erkey => $ervalue) {
                    if (isset($error_message))
                        $error_message .=$ervalue;
                    else
                        $error_message = $ervalue;
                }
                $Photo = '';

                if (isset($uploadedfiles[0])) {
                    $Photo = $uploadedfiles[0];
                }

                $merital_status = '';
                if (isset($_POST['Martial_Status']))
                    $merital_status = $_POST['Martial_Status'];
                $updateSQL = "UPDATE employee_personal_Record SET
                    `FirstName`='" . $_POST['FirstName'] . "',
                     `MiddelName`='" . $_POST['MiddelName'] . "',
                   `LastName`='" . $_POST['LastName'] . "',
                   `Department`='" . $_POST['Department'] . "',";

                $employee_children = isset($_POST['Children_number']) ? $_POST['Children_number'] : null;

                if (isset($_POST['Group'])) {
                    $updateSQL .= "`Group`='" . $_POST['Group'] . "',";
                }
                if (is_numeric($_POST['Children_number'])) {
                    $updateSQL .= "`Children_number`=" . $_POST['Children_number'] . ",";
                }
                $updateSQL .= "`Position`='" . $_POST['Position'] . "',
                  `Date_Birth`='" . $_POST['Date_Birth'] . "',
	  `Place_Birth`='" . $_POST['Place_Birth'] . "',";
                if (($_POST['Date_Employement'] != '')) {
                    $updateSQL .= "`Date_Employement`='" . $_POST['Date_Employement'] . "',";
                }
                $updateSQL .="
	  `Email`='" . $_POST['Email'] . "',
	  `Telephone`='" . $_POST['Telephone'] . "',
	  `Educational_Status`='" . $_POST['Educational_Status'] . "',
	  `Martial_Status`='" . $merital_status . "',
	  `Spouse_Name`='" . $_POST['Spouse_Name'] . "',
	  `Contact_Emergency`='" . $_POST['Contact_Emergency'] . "',
	  `Contact_Relation`='" . $_POST['Contact_Relation'] . "',
	  `Contact_Address`='" . $_POST['Contact_Address'] . "',
	  `Name_Child`='" . $_POST['Name_Child'] . "',
	  `Age_Child`='" . $_POST['Age_Child'] . "',
	  `Sex_Child`='" . $_POST['Sex_Child'] . "',
	  `Photo`='" . $Photo . "',
	  `Experience`='" . $_POST['Experience'] . "',
	  `HardCopy_Shelf_No`='" . $_POST['HardCopy_Shelf_No'] . "',
	  `ModifiedBy`='" . $_SESSION['MM_Fullname'] . "'
	   WHERE Auto_ID = '" . $_GET['Auto_ID'] . "'";

//echo $updateSQL;

                mysql_select_db($database_HRMS, $HRMS);
                $Result1 = mysql_query($updateSQL, $HRMS) or die(mysql_error());

                $mydb = new DataBase();
                $data1 = array(
                    'FirstName' => $_POST['FirstName']
                    , 'MiddelName' => $_POST['MiddelName']
                    , 'LastName' => $_POST['LastName']
                    , 'Department' => $_POST['Department']
                    , 'Date_Birth' => ($_POST['Date_Birth'] != '') ? trim($_POST['Date_Birth']) : null
                    , 'Age' => trim($_POST['Age'])
                    , 'Sex' => $_POST['Sex']
                    , 'Department' => $_POST['Department']
                    , 'Position' => $_POST['Position']
                    , 'Salary' => trim($_POST['Salary'])
                    , 'ModifiedBy' => $_SESSION['MM_Username']);

                $mydb->where(array('ID' => $_POST['ID']));
                $mydb->update('recruitment', $data1);


                if (($Result1))
                    echo "<script type=\"text/javascript\">alert('Employee Record Deatil Entered Successfully')</script>";
            }



            $mydb = new DataBase();
            $mydb->where("Auto_ID", $_GET['Auto_ID']);
            $employee_list = $mydb->get("employee_personal_record");
            $employee = array();
            if ($employee_list['count'] > 0) {
                $employee = $employee_list['result'][0];
            }
            require_once $base_path . 'Templates/header.php';
            ?>

            <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" -->
                <?php
                echo '<p class="WelCome">Wel Come "' . $_SESSION['MM_Fullname'] . "\"</p>";
                ?>


                <h1 class="form_lable"><?php echo $obj_lang->get('Empoyee Personal record entry form', $lang); ?></h1>
                <form  enctype="multipart/form-data"  action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                    <table width="630" align="center">

                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('ID', $lang); ?>:</td>
                            <td>
                                <input   required="required"   type="text" name="ID"
                                         value="<?php echo isset($employee['ID']) ? $employee['ID'] : '' ?>"/>
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('First Name', $lang); ?>:</td>
                            <td><input   required="required"   type="text" name="FirstName"
                                         value="<?php echo isset($employee['FirstName']) ? $employee['FirstName'] : '' ?>"
                                         size="20" maxlength="20"   />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Middel Name', $lang); ?>:</td>
                            <td><input   required="required"   type="text" name="MiddelName"
                                         value="<?php echo isset($employee['MiddelName']) ? $employee['MiddelName'] : '' ?>"
                                         size="20" maxlength="20"  /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Last Name', $lang); ?>:</td>
                            <td>
                                <input   required="required"   type="text" name="LastName"
                                         value="<?php echo isset($employee['LastName']) ? $employee['LastName'] : '' ?>"
                                         size="20" maxlength="20" />
                            </td>
                        </tr>



                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Date of Birth', $lang); ?>:</td>
                            <td>
                                <input   required="required"   type="Date" class="calculate_age" name="Date_Birth"
                                         value="<?php echo isset($employee['Date_Birth']) ? $employee['Date_Birth'] : '' ?>"
                                         size="20"  />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Place of Birth', $lang); ?>:</td>
                            <td>
                                <input type="text" name="Place_Birth" value="<?php echo isset($employee['Place_Birth']) ? $employee['Place_Birth'] : '' ?>" size="32" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Age', $lang); ?>:</td>
                            <td>
                                <input type="text" name="Age" id="Age"
                                       value="<?php echo isset($employee['Date_Birth']) ? round((time() - strtotime($employee['Date_Birth'])) / 31556926, 2) : '' ?>"
                                       size="5"  />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Sex', $lang); ?>:</td>
                            <td><input type="radio" name="Sex" value="Male" <?php
                if (!(strcmp($employee['Sex'], 'Male'))) {
                    echo "checked=\"checked\"";
                }
                ?>/>
                                Male<input type="radio" name="Sex" value="Female" <?php
                                       if (!(strcmp($employee['Sex'], "Female"))) {
                                           echo "checked=\"checked\"";
                                       }
                ?>/>
                                Female</td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Email', $lang); ?>:</td>
                            <td>
                                <input  type="text" name="Email"
                                        value="<?php echo isset($employee['Email']) ? $employee['Email'] : '' ?>"
                                        size="32" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Telephone', $lang); ?>:</td>
                            <td>
                                <input type="text" name="Telephone"
                                       value="<?php echo isset($employee['Telephone']) ? $employee['Telephone'] : '' ?>"
                                       size="32" />
                            </td>
                        </tr>

                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Date of Employement', $lang); ?>:</td>
                            <td>  <script type='text/JavaScript' src="../Js/scw.js" ></script>

                                <input   required="required"    type="Date" name="Date_Employement"
                                         value="<?php echo isset($employee['Date_Employement']) ? $employee['Date_Employement'] : '' ?>"
                                         size="20"  /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Department', $lang); ?>:</td>
                            <td>
                                <?php
                                $mydb = new DataBase();
                                $mydb->select('DISTINCT Department');
                                $mydb->where('Department!=', '');
                                $mydb->order_by('Department');
                                $result = $mydb->get('department');
                                $department_list = $result['result'];
                                if ($result) {
                                    $my_form = new Form();
                                    echo $my_form->dropdown($department_list, 'Department', 'Department', array('name' => 'Department', 'id' => 'Department'), isset($employee['Department']) ? $employee['Department'] : '');
                                }
                                ?>
                        </tr>
                        <?php
                        if (isset($company_info['support_group'])):
                            if ($company_info['support_group']):
                                ?>
                                <tr>
                                    <td align="right">
                                        Group No
                                    </td>
                                    <td>
                                        <input type="number" name="Group" value="<?php echo isset($employee['Group']) ? $employee['Group'] : '' ?>" />
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endif; ?>


                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Position', $lang); ?>:</td>
                            <td><input type="text" name="Position"
                                       value="<?php echo isset($employee['Position']) ? $employee['Position'] : '' ?>"
                                       size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Educational Status', $lang); ?>:</td>
                            <td>
                                <input type="text" name="Educational_Status" value="<?php echo isset($employee['Educational_Status']) ? $employee['Educational_Status'] : '' ?>" size="32" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Salary', $lang); ?>:</td>
                            <td>
                                <input   required="required"   type="text" name="Salary"
                                         value="<?php echo isset($employee['Salary']) ? $employee['Salary'] : '' ?> "
                                         size="10"  />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Martial Status', $lang); ?>:</td>
                            <td>
                                <?php
                                $mertial_status = array('Single', 'Married', 'Divorced', 'Separated');
                                foreach ($mertial_status as $mer_key => $mer_value):
                                    ?>
                                    <label>
                                        <input type="radio"  name="Martial_Status" value="<?php echo $mer_value ?>" <?php echo (strtolower($employee['Martial_Status']) == strtolower($mer_value)) ? 'checked="checked"' : '' ?> />
                                        <?php echo $obj_lang->get($mer_value, $lang); ?>
                                    </label>
                                <?php endforeach; ?>
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td colspan="2" nowrap="nowrap" align="left" class="expand_view">
                                <a><label class="ui-icon ui-icon-circle-plus"></label> <label>Detail Martial Status</label></a>
                            </td>
                        </tr>
                    </table>
                    <table width="630" id="DetailMS" style="display: none;" align="center">
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">
                                <?php echo $obj_lang->get('Spouse Name', $lang); ?>:
                            </td>
                            <td>
                                <input type="text" name="Spouse_Name"
                                       value="<?php echo isset($employee['Spouse_Name']) ? $employee['Spouse_Name'] : '' ?> "
                                       size="32" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Number of Childern', $lang); ?>:</td>
                            <td>
                                <input    type="number" name="Children_number"
                                         value="<?php echo isset($employee['Children_number']) ? $employee['Children_number'] : '' ?> "
                                         size="32" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Name of Child', $lang); ?>(comma separted):</td>
                            <td><input type="text" name="Name_Child"
                                       value="<?php echo isset($employee['Name_Child']) ? $employee['Name_Child'] : '' ?> "
                                       size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Age of Child', $lang); ?>(comma separted):</td>
                            <td><input type="text" name="Age_Child"
                                       value="<?php echo isset($employee['Age_Child']) ? $employee['Age_Child'] : '' ?> "
                                       size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Sex of Child', $lang); ?> (Comma separted):</td>
                            <td><input type="text" name="Sex_Child"
                                       value="<?php echo isset($employee['Sex_Child']) ? $employee['Sex_Child'] : '' ?> "
                                       size="32" />
                            </td>
                        </tr>

                    </table>
                    <table width="630" align="center">
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Photo', $lang); ?>:</td>
                            <td><input type="file" name="Photo"
                                       value="<?php echo isset($employee['Photo']) ? $employee['Photo'] : '' ?> "
                                       size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Image', $lang); ?>:</td>
                            <td><input type="file" name="Image" value="" size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Shelf Number(Hard Copy Place)', $lang); ?>:</td>
                            <td>
                                <input type="text" name="HardCopy_Shelf_No" value="Shelf No 0  ,Row 0 ,Coloumn 0 ,Box File 0  " size="50" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Emergency Contact', $lang); ?>:</td>
                            <td><input type="text" name="Contact_Emergency"
                                       value="<?php echo isset($employee['Contact_Emergency']) ? $employee['Contact_Emergency'] : '' ?> "
                                       size="32" /></td>
                        </tr>

                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Emergency Contact Relation', $lang); ?>:</td>
                            <td><input type="text" name="Contact_Relation"
                                       value="<?php echo isset($employee['Contact_Relation']) ? $employee['Contact_Relation'] : '' ?> "
                                       size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Emergency Contact Address', $lang); ?>:</td>
                            <td><input type="text" name="Contact_Address"
                                       value="<?php echo isset($employee['Contact_Address']) ? $employee['Contact_Address'] : '' ?> "
                                       size="32" /></td>
                        </tr>

                        <tr>
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Work Experience', $lang); ?>:</td>
                            <td>
                                <textarea name="Experience" id="Experience" cols="30" rows="5"><?php echo isset($employee['Experience']) ? $employee['Experience'] : '' ?></textarea>
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">&nbsp;</td>
                            <td><input type="submit" value="<?php echo $obj_lang->get('Enter Personal Detail', $lang); ?>" onClick="return confirm('Are you sure you want to register Personal detail this Employee?')"  /></td>
                        </tr>
                    </table>

                    <input type="hidden" name="MM_insert" value="form1" />
                </form>


                <?php

                function shelf_chacker() {
                    $no_shelf = 5;
                    $no_row_per_shelf = 4;
                    $no_colomn_per_shelf = 10;
                    $no_box_file_per_set = 12;
                    $no_employee_file_per_box = 1;
                    $sqlchk = "SELECT * FROM employee_personal_recored where " . $_POST['HardCopy_Shelf_No'] . "";
                    $result = mysql_num_rows($sqlchk);
                    if ($result == $no_employee_file_per_box)
                        echo "Occopied try to give other";
                    else
                        echo "free available space you can put there";
                }
                ?>

                <!-- InstanceEndEditable -->
            </div>
        </div>

    </body>
    <!-- InstanceEnd --> 
</html>


