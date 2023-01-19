<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/ThekeyHRMS_main_Template.dwt" codeOutsideHTMLIsLocked="false" -->
    <head>
        <title>Thekey HRMS</title>
        <?php
        $base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
        require_once $base_path . 'Templates/head.php';

        if (count($_POST) > 0) {
            $create_new = false;
            if (isset($_POST['role'])) {
                if ($_POST['role'] == 'other') {
                    $access_level = $_POST['new_user_group'];
                    $create_new = TRUE;
                } else {
                    $access_level = $_POST['role'];
                }
            } else {
                $access_level = $_POST['new_user_group'];
                $create_new = true;
            }
            if ($create_new) {
                $myquery = $obj_AccessLevel->create_group($access_level);
            }
            $message = "Your Account Created Successfuly";
            $obj_AccessLevel->create_account($_POST['FullName'], $_POST['UserName'], $_POST['Password'], $access_level);
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
                <h1 class="form_lable">Create Account</h1>
                <form method="post" name="form1" class="new_form">
                    <ul>
                        <li>
                            <label>Full Name:</label>
                            <input name="FullName" required="required" type="text" id="FullName"  size="40"/>
                        </li>
                        <li>
                            <label>UserName:</label>
                            <input name="UserName" required="required" type="text" id="UserName"  size="30"/>
                        </li>
                        <li>
                            <label>Password</label>
                            <input id="Password" required="required" name="Password" type="password" size="30" />
                        </li>
                        <li>
                            <label>Confirm Password</label>
                            <input id="ConfirmPassword" required="required" name="ConfirmPassword" type="password" size="30" />
                        </li>
                    </ul>
                    <ul class="float options">
                        <p style="clear: both">Group</p>
                        <?php
                        $result = $obj_AccessLevel->get_group();
                        if ($result):
                            foreach ($result as $key => $value):
                                ?>
                                <li>
                                    <label><input type="radio" value="<?php echo $value['group_name']; ?>" name="role"/><?php echo $value['group_name']; ?></label>
                                </li>
                            <?php endforeach; ?>
                            <li>
                                <label><input id="other_role" type="radio" value="other" name="role"/>Other  Group</label>
                                <input req style="display: none" id="new_user_group" type="text" placeholder="New USer Group" name="new_user_group"/>
                            </li>
                            <?php
                        else:
                            ?>
                            <input type="text"  placeholder="New USer Group" name="new_user_group"/>
                        <?php endif; ?>
                    </ul>
                    <div class="button_bar">
                        <input type="submit" value="Creat Account" ><i></i></input>
                        <input type="hidden" name="MM_update" value="form1" />
                    </div>


                </form>
                <!-- InstanceEndEditable -->
            </div>
        </div>
    </body>
    <!-- InstanceEnd -->
</html>


