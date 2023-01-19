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
        <div id="thekey_page">
            <?php require_once $base_path . 'Templates/header.php'; ?>

            <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" -->
                <?php
                echo '<p class="WelCome">Wel Come "' . $_SESSION['MM_Fullname'] . "\"</p>";

                $mydb = new DataBase();
                ?>
                <h1 class="form_lable">Recruitment Data</h1>

                <?php
                $employee_detail = array();
                if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
                    $mydb = new DataBase();
                    $employee_detail = $_POST;
                    $data1 = array('ID' => $_POST['ID']
                        , 'Employer' => $_POST['Employer']
                        , 'Place' => $_POST['Place']
                        , 'FirstName' => $_POST['FirstName']
                        , 'MiddelName' => $_POST['MiddelName']
                        , 'LastName' => $_POST['LastName']
                        , 'Department' => $_POST['Department']
                        , 'Date_Birth' => $_POST['Date_Birth']
                        , 'Age' => $_POST['Age']
                        , 'Sex' => $_POST['Sex'] //, 'Telephone' => $_POST['Telephone']
                        , 'Date' => $_POST['Date']
                        , 'Address' => $_POST['Address']
                        , 'Department' => $_POST['Department']
                        , 'Position' => $_POST['Position']
                        , 'Salary' => $_POST['Salary']
                        , 'Transport_Allowance' => $_POST['Transport_Allowance']
                        , 'Hardship_Allowance' => $_POST['Hardship_Allowance']
                        , 'Housing_Allowance' => $_POST['Housing_Allowance']
                        , 'Position_Allowance' => $_POST['Position_Allowance']
                        , 'Present_Allowance' => $_POST['Present_Allowance']
                        , 'ModifiedBy' => $_SESSION['MM_Username']);

                    $mydb->where(array('Auto_ID' => $_POST['Auto_ID']));
                    $Result1 = $mydb->update('recruitment', $data1);

                    //totaldeduction payroll data update 

                    $data2 = array('ID' => $_POST['ID']
                        , 'FirstName' => $_POST['FirstName']
                        , 'MiddelName' => $_POST['MiddelName']
                        , 'LastName' => $_POST['LastName']
                        , 'Department' => $_POST['Department']
                        , 'Position' => $_POST['Position']
                        , 'Basic Salary' => $_POST['Salary']
                        , 'Transport_Allowance' => $_POST['Transport_Allowance']
                        , 'Hardship_Allowance' => $_POST['Hardship_Allowance']
                        , 'Housing_Allowance' => $_POST['Housing_Allowance']
                        , 'Position_Allowance' => $_POST['Position_Allowance']
                        , 'Present_Allowance' => $_POST['Present_Allowance']
                        , 'ModifiedBy' => $_SESSION['MM_Username']);

                    $mydb->where(array('ID' => $_POST['ID']));
                    $Result2 = $mydb->update('total_deduction', $data2);

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
                    $mydb->update('employee_personal_record', $data1);




                    //Updating each week attendanc data according to employee data updation

                    for ($i = 1; $i <= 6; $i++) {

                        $data3 = array('ID' => $_POST['ID']
                            , 'FirstName' => $_POST['FirstName']
                            , 'MiddelName' => $_POST['MiddelName']
                            , 'LastName' => $_POST['LastName']
                            , 'Department' => $_POST['Department']);

                        $mydb->where(array('ID' => $_POST['ID']));
                        $ResultAttendance = $mydb->update('week_' . $i, $data3);
                    }


                    if (($Result1) && ($Result2) && ($ResultAttendance))
                        echo "<script type=\"text/javascript\">alert('Employee Record Updated Successfully')</script>";
                }
                else {
                    if (isset($_GET['Auto_ID'])) {
                        $my_id = $_GET['Auto_ID'];
                        $mydb = new DataBase();
                        $mydb->where("Auto_ID", $my_id);
                        $employee_info = $mydb->get('recruitment');
                        if ($employee_info['count'] > 0) {
                            $employee_detail = $employee_info['result'][0];
                        }
                    }
                }
                ?>
                <form action="" method="post" name="form1" id="form1">
                    <h1 class="form_lable">   
                        Recruitment Data Update Form
                    </h1>
                    <table align="center" bgcolor="#EBEBEB">
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Employer', $lang); ?>:</td>
                            <td>
                                <input type="text" name="Employer" value="<?php echo isset($employee_detail['Employer']) ? $employee_detail['Employer'] : '' ?>" size="32" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Place', $lang); ?>:</td>
                            <td>
                                <input type="text" name="Place" value="<?php echo isset($employee_detail['Place']) ? $employee_detail['Place'] : '' ?>" size="32" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('ID', $lang); ?>:</td>
                            <td><input   required="required"   type="text" name="ID" value="<?php echo isset($employee_detail['ID']) ? $employee_detail['ID'] : '' ?>" size="20" readonly="readonly"/></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('First Name', $lang); ?>:</td>
                            <td>
                                <input   required="required"   type="text" name="FirstName" value="<?php echo isset($employee_detail['FirstName']) ? $employee_detail['FirstName'] : '' ?>" size="20" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Middel Name', $lang); ?>:</td>
                            <td>
                                <input   required="required"   type="text" name="MiddelName" value="<?php echo isset($employee_detail['MiddelName']) ? $employee_detail['MiddelName'] : '' ?>" size="20" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Last Name', $lang); ?>:</td>
                            <td>
                                <input type="text" name="LastName"value="<?php echo isset($employee_detail['LastName']) ? $employee_detail['LastName'] : '' ?>" size="20" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Date of Birth', $lang); ?>:</td>
                            <td><input   required="required"   type="Date" class="calculate_age" name="Date_Birth" id="Date_Birth" value="<?php echo isset($employee_detail['Date_Birth']) ? $employee_detail['Date_Birth'] : '' ?>" size="15" />

                                <?php echo $obj_lang->get('Age', $lang); ?>:
                                <input   required="required"   type="number" name="Age" id="Age" value="<?php echo isset($employee_detail['Date_Birth']) ? round((time() - strtotime($employee_detail['Date_Birth'])) / 31556926, 2) : '' ?>0" readonly="readonly" size="8" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Sex', $lang); ?>:</td>
                            <td valign="baseline"><table>
                                    <tr>
                                        <td><input type="radio" name="Sex" value="Male" <?php
                                if (!(strcmp($employee_detail['Sex'], "Male"))) {
                                    echo "checked=\"checked\"";
                                }
                                ?>/>
                                            <?php echo $obj_lang->get('Male', $lang); ?></td>
                                    </tr>
                                    <tr>
                                        <td><input type="radio" name="Sex" value="Female" <?php
                                            if (!(strcmp($employee_detail['Sex'], "Female"))) {
                                                echo "checked=\"checked\"";
                                            }
                                            ?>/>
                                            <?php echo $obj_lang->get('Female', $lang); ?></td>
                                    </tr>
                                </table></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Photo', $lang); ?>:</td>
                            <td><input type="file" name="Photo" value="<?php echo isset($employee_detail['Photo']) ? $employee_detail['Photo'] : '' ?>" size="32"  /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Date of Employement', $lang); ?>:</td>
                            <td> <input   required="required"   type="Date" name="Date"  value="<?php echo isset($employee_detail['Date']) ? $employee_detail['Date'] : '' ?>" size="15" />

                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right" valign="middle"><?php echo $obj_lang->get('Address', $lang); ?>:</td>
                            <td>
                                <textarea name="Address" cols="50" rows="5"><?php echo isset($employee_detail['Address']) ? $employee_detail['Address'] : '' ?></textarea>
                            </td>
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
                                    echo $my_form->dropdown($department_list, 'Department', 'Department', array('name' => 'Department', 'id' => 'Department'), isset($employee_detail['Department']) ? $employee_detail['Department'] : '');
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Group Number</td>
                            <td>
                                <?php
                                $result = $mydb->get('company_settings', 1);
                                if ($result['count'] > 0) {
                                    $company_info = $result['result'][0];
                                }
                                if (isset($company_info['support_group'])):
                                    if ($company_info['support_group']):
                                        ?>
                                        <input   required="required"   type="number" name="Group" value="<?php echo isset($employee_detail['Group']) ? $employee_detail['Group'] : '' ?>" />
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Position', $lang); ?>:</td>
                            <td>
                                <input   required="required"   type="text" name="Position" value="<?php echo isset($employee_detail['Position']) ? $employee_detail['Position'] : '' ?>" size="32" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Salary', $lang); ?>:</td>
                            <td>
                                <input   required="required"   type="number" name="Salary" value="<?php echo isset($employee_detail['Salary']) ? $employee_detail['Salary'] : '0' ?>" size="15" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Transport Allowance', $lang); ?>:</td>
                            <td>
                                <input   required="required"   type="number" name="Transport_Allowance" value="<?php echo isset($employee_detail['Transport_Allowance']) ? $employee_detail['Transport_Allowance'] : '0' ?>" size="15" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Housing Allowance', $lang); ?>:</td>
                            <td>
                                <input   required="required"   type="number" name="Housing_Allowance" value="<?php echo isset($employee_detail['Housing_Allowance']) ? $employee_detail['Housing_Allowance'] : '0' ?>" size="15" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Hardship Allowance', $lang); ?>:</td>
                            <td>
                                <input   required="required"   type="number" name="Hardship_Allowance" value="<?php echo isset($employee_detail['Hardship_Allowance']) ? $employee_detail['Hardship_Allowance'] : '0' ?>" size="15" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Position Allowance', $lang); ?>:</td>
                            <td>
                                <input   required="required"   type="number" name="Position_Allowance" value="<?php echo isset($employee_detail['Position_Allowance']) ? $employee_detail['Position_Allowance'] : '0' ?>" size="15" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Present Allowance', $lang); ?>:</td>
                            <td>
                                <input   required="required"   type="number" name="Present_Allowance" value="<?php echo isset($employee_detail['Present_Allowance']) ? $employee_detail['Present_Allowance'] : '0' ?>" size="15" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">&nbsp;</td>
                            <td><input type="submit" value="<?php echo $obj_lang->get('Update Record', $lang); ?>" onClick="return confirm('Are you sure you want to Update Probation Period Employee Record? If you Click Ok Probation Period Employee detail will be Updated or Click Cancel to Avoid Updating')" /></td>
                        </tr>
                    </table>
                    <input type="hidden" name="MM_update" value="form1" />
                    <input type="hidden" name="Auto_ID" value="<?php echo $employee_detail['Auto_ID']; ?>" />
                </form>

                <!-- InstanceEndEditable -->
            </div>
        </div>

    </body>
    <!-- InstanceEnd --> 
</html>




