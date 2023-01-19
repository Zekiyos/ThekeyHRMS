 
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
            <?php
            require_once $base_path . 'Templates/header.php';

            $dont_check = true;
            $mydb = new DataBase();
            $mydb->select('DISTINCT Department');
            $mydb->where('Department!=', '');
            $mydb->order_by('Department');
            $result = $mydb->get('employee_personal_record');
            $department_list = $result['result'];
            ?>

            <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" -->
                <?php
                echo '<p class="WelCome">Wel Come "' . $_SESSION['MM_Fullname'] . "\"</p>";
                ?>

                <div id="dash_bord">
                    <div>
                        <form class="thekeyform" method="post" target="_blank">
                            <h3>Print ID</h3>
                            <ul>
                                <li>
                                    <label>Issued Date</label>
                                    <input type="date" name="date_of_issued" required="required"/>
                                </li>
                                <li>
                                    <label>Print ID Card By ID</label>
                                    <input type="text" name="employee_id" placeholder="Employee ID"/>
                                </li>
                                <li>
                                    <label>Print By Department</label>
                                    <?php
                                    if ($result) {
                                        $my_form = new Form();
                                        echo $my_form->dropdown($department_list, 'Department', 'Department', array('name' => 'department', 'id' => 'department'));
                                    }
                                    ?>
                                </li>
                                <?php
                                $result = $mydb->get('company_settings', 1);
                                if ($result['count'] > 0) {
                                    $company_info = $result['result'][0];
                                }
                                if (isset($company_info['support_group'])):
                                    if ($company_info['support_group']):
                                        ?>
                                        <li>
                                            <label>
                                                Group No
                                            </label>
                                            <input type="number" placeholder="Group 1,Group 2" name="Group" value="<?php echo isset($employee['Group']) ? $employee['Group'] : '' ?>" />
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <li>
                                    <label>Print ID Card For Employee Employeed between Days</label>
                                    <input type="date" name="start" placeholder="Start From Date"/>
                                    <input type="date" name="end" placeholder="To Date" />
                                </li>
                                <li>
                                    <input type="submit" value="print" name="print_id"/>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>

                <!-- InstanceEndEditable -->
            </div>
        </div>

    </body>
    <!-- InstanceEnd --> </html>


