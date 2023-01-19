<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/ThekeyHRMS_main_Template.dwt" codeOutsideHTMLIsLocked="false" -->
    <head>
        <!--meta http-equiv="Content-Type" content="text/html; charset=utf-8" /-->
        <title>Thekey HRMS</title>

        <?php
        $base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
        require_once $base_path . 'Templates/head.php';

        $selecte_group = '';

        if (count($_POST) > 0) {
            $selecte_group = $_POST['group_list'];
            if (isset($_POST['grant_group'])) {
                if ($_POST['group_list'] != '') {
                    if (isset($_POST['Department'])) {
                        $obj_AccessLevel->delete_department_access($selecte_group);
                        foreach ($_POST['Department'] as $key => $value) {
                            $obj_AccessLevel->grant_department($selecte_group, $value);
                        }
                        $message = "You Grant Access To " . $selecte_group;
                    } else {
                        $error_message = 'Select at least one Department!';
                    }
                } else {
                    $error_message = 'Select The Group You want to give privilege!';
                }
            }
        }
        $mydb = new DataBase();
        $mydb->order_by(array('Section', 'Sub Section', 'Department'));
        $result = $mydb->get('department');
        $dipartment_list = $result['result'];
        $my_department = $obj_AccessLevel->get_department_access($selecte_group);
        ?>
    </head>

    <body>
        <div id="busy" >
            <img alt="Am Working" src="http://<?php echo $base_url ?>images/BusyAnimation.gif">
        </div>
        <div id="thekey_page">
            <?php require_once $base_path . 'Templates/header.php'; ?>

            <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" -->
                <h1 class="form_lable"><?php echo $obj_lang->get('Department Data Access Level Grant Form', $lang); ?></h1>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="GrantAL" class="new_form" id="grant_department" method="post">
                    <ul class="autowidth">
                        <li>
                            <label>Group</label>
                            <?php
                            $result = $obj_AccessLevel->get_group();
                            if ($result) {
                                $my_form = new Form();
                                echo $my_form->dropdown($result, 'group_name', 'group_name', array('name' => 'group_list', 'id' => 'group_list'), $selecte_group);
                            }
                            ?>
                        </li>
                        <?php
                        $Section = '';
                        $sub_section_changed = false;
                        $sub_section = "";
                        ?>
                        <?php foreach ($dipartment_list as $key => $value): ?>
                            <?php
                            if ($Section != $value['Section']) {

                                if ($sub_section_changed) {

                                    $sub_section_changed = false;
                                }
                                if ($sub_section != '') {
                                    echo '</ul>' . "\n";
                                    echo '</ul>' . "\n";
                                    echo '</li>' . "\n";
                                }
                                echo '<li>' . "\n";
                                echo '<label class="left_text show_always"><input type="checkbox" class="check_all"/>' . $value['Section'] . '</label>' . "\n";
                                echo '<ul>' . "\n";
                                echo '<li>' . "\n";
                                echo '<label class="left_text"><input type="checkbox" class="check_all"/>' . $value['Sub Section'] . '</label>' . "\n";
                                echo '<ul>' . "\n";
                                ?>
                                <li>
                                    <label>

                                        <input type="checkbox" <?php echo isset($my_department[$value['Department']]) ? 'checked="checked"' : ''; ?> name="Department[]" value="<?php echo $value['Department'] ?>"/>
                                        <?php echo $value['Department']; ?>
                                    </label>
                                </li>
                                <?php
                            } else {
                                $sub_section_changed = true;
                                if ($sub_section != $value['Sub Section']) {
                                    echo '</ul>' . "\n";
                                    echo '</li>' . "\n";
                                    echo '<li>' . "\n";
                                    echo '<label class="left_text"><input type="checkbox" class="check_all"/>' . $value['Sub Section'] . '</label>' . "\n";
                                    echo '<ul>' . "\n";
                                    ?>
                                    <li>
                                        <label>
                                            <input type="checkbox" <?php echo isset($my_department[$value['Department']]) ? 'checked="checked"' : ''; ?> name="Department[]" value="<?php echo $value['Department'] ?>"/>
                                            <?php echo $value['Department']; ?>
                                        </label>
                                    </li>
                                    <?php
                                } else {
                                    ?>
                                    <li>
                                        <label>
                                            <input type="checkbox" <?php echo isset($my_department[$value['Department']]) ? 'checked="checked"' : ''; ?> name="Department[]" value="<?php echo $value['Department'] ?>"/>
                                            <?php echo $value['Department']; ?>
                                        </label>
                                    </li>
                                    <?php
                                }
                            }
                            $Section = $value['Section'];
                            $sub_section = $value['Sub Section'];
                            ?>
                        <?php endforeach; ?>
                        <?php echo "</ul>"; ?>
                        <li>
                            <div class="button_bar">
                                <input type="submit" value="Grant Access"  name="grant_group"><i></i></input>
                            </div>
                        </li>
                    </ul>

                </form>



                <!-- InstanceEndEditable -->
            </div>
        </div>
    </body>
    <!-- InstanceEnd -->
</html>