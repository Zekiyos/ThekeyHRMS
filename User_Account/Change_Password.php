<html>
    <head>
        <title>Thekey HRMS</title>
        <?php
        $base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
        require_once $base_path . 'Templates/head.php';

        if (count($_POST) > 0) {
            $current_user = $_SESSION['MM_Username'];
            $old_password = $_POST['old_password'];
            $password = $_POST['Password'];
            $ConfirmPassword = $_POST['ConfirmPassword'];
            if ($ConfirmPassword == $password) {
                $mydb = new DataBase();
                $mydb->where('UserName', $current_user);
                $mydb->where('Password', md5($old_password));
                $old_info = $mydb->get('users');
                if ($old_info['count'] > 0) {
                    $mydb->where('UserName', $current_user);
                    $mydb->where('Password', md5($old_password));
                    $mydb->set(array('Password' => md5($password)));
                    $mydb->update('users');
                    $message = "Your Password Changed Successfuly !";
                } else {
                    $error_message = "Invalid Old Password";
                }
            } else {
                $error_message = "Confirm Password !";
            }
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
                <h1 class="form_lable">Change Password</h1>
                <form method="post" name="form1" class="new_form">
                    <ul>
                        <li>
                            <label>Old Password:</label>
                            <input  required="required"  name="old_password" type="password" id="old_password"  size="30"/>
                        </li>
                        <li>
                            <label>New Password</label>
                            <input  required="required"  id="Password" name="Password" type="password" size="30" />
                        </li>
                        <li>
                            <label>Confirm Password</label>
                            <input  required="required"  id="ConfirmPassword" name="ConfirmPassword" type="password" size="30" />
                        </li>
                    </ul>

                    <div class="button_bar">
                        <input type="submit" value="Change Password" ><i></i></input>
                        <input type="hidden" name="MM_update" value="form1" />
                    </div>

                </form>
                <!-- InstanceEndEditable -->
            </div>
        </div>
    </body>
    <!-- InstanceEnd -->
</html>


