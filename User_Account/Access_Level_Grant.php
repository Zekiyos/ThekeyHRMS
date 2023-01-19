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
                    if (isset($_POST['role'])) {
                        $obj_AccessLevel->delete_access($selecte_group);
                        foreach ($_POST['role'] as $key => $value) {
                            $link = preg_replace('/[[:space:]]/', '_', $value);
                            $obj_AccessLevel->Grant_AccessLevel('/ThekeyHRMS/' . $_POST[$link], $selecte_group, $value);
                        }
                        $message = "You Grant Access To " . $selecte_group;
                    } else {
                        $error_message = 'Select at least one Role!';
                    }
                } else {
                    $error_message = 'Select The Group You want to give privilege!';
                }
            }
            $my_role = $obj_AccessLevel->get_Granted_AccessLevel($selecte_group);
        }
        ?>
    </head>

    <body>
        <div id="busy" >
            <img alt="Am Working" src="http://<?php echo $base_url ?>images/BusyAnimation.gif">
        </div>
        <div id="thekey_page">
            <?php require_once $base_path . 'Templates/header.php'; ?>

            <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" -->
                <h1 class="form_lable"><?php echo $obj_lang->get('HRMS Access Level Grant Form', $lang); ?></h1>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="GrantAL" class="new_form" id="GrantAL" method="post">
                    <ul>
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
                        <li>
                            <label class="left_text show_always"><input type="checkbox" class="check_all"/> Grant All</label>
                            <ul>
                                <?php foreach ($menu_list as $key => $value) : ?>
                                    <li>
                                        <?php if (is_array($value)): ?>
                                            <label class="left_text"><input type="checkbox" class="check_all"/>  <?php echo $key; ?></label>
                                            <ul>

                                                <?php foreach ($value as $vkey => $vvalue) : ?>
                                                    <li>
                                                        <?php if (is_array($vvalue)): ?>
                                                            <label class="left_text"><input type="checkbox" class="check_all"/> <?php echo $vkey; ?></label>
                                                            <ul>
                                                                <?php foreach ($vvalue as $vvkey => $vvvalue) : ?>
                                                                    <li>
                                                                        <label>
                                                                            <input type="checkbox" <?php echo isset($my_role[$vvkey]) ? 'checked="checked"' : ''; ?> name="role[]" value="<?php echo $vvkey ?>"/>
                                                                            <?php echo $vvkey; ?>
                                                                            <input type="hidden" name="<?php echo $vvkey; ?>" value="<?php echo $vvvalue; ?>"/>
                                                                        </label>
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        <?php else: ?>
                                                            <label>
                                                                <input type="checkbox"  <?php echo isset($my_role[$vkey]) ? 'checked="checked"' : ''; ?>  name="role[]" value="<?php echo $vkey; ?>"/>
                                                                <?php echo $vkey; ?>
                                                                <input type="hidden" name="<?php echo $vkey; ?>" value="<?php echo $vvalue; ?>"/>
                                                            </label>
                                                        <?php endif ?>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php else: ?>
                                            <label>
                                                <input type="checkbox" <?php echo isset($my_role[$key]) ? 'checked="checked"' : ''; ?>   name="role[]" value="<?php echo $key; ?>"/>
                                                <?php echo $key; ?>
                                                <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>"/>
                                            </label>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>                    
                        </li>
                        <li>
                            <div class="button_bar">
                                <input type="submit" value="Grant Access"  name="grant_group"><i></i></input>
                                <input type="hidden" name="MM_update" value="form1" />
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