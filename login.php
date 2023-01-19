<?php require_once('Connections/HRMS.php'); ?>
<?php
if (!session_id()) {
    session_start();
}
/* Database Class Including to the page** */

if (isset($_GET['logout'])) {
    session_destroy();
}

$base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
$port = $_SERVER['SERVER_PORT'];
if ($port == 80) {
    $port = '';
} else {
    $port = ':' . $port;
}
$base_url = 'http://' . $_SERVER['SERVER_NAME'] . $port . '/ThekeyHRMS/';
$base_address = 'http://' . $_SERVER['SERVER_NAME'] . $port;
require_once $base_path . 'config/database.php';
require_once $base_path . 'lib/database.php';

$mydb = new DataBase();
?>
<?php
$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
    $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['txtUsername'])) {

    $x = 10;
    $x = $x + 10;

    $loginUsername = $_POST['txtUsername'];
    $password = $_POST['txtPassword'];
    $MM_fldUserAuthorization = "Access_Level";
    $MM_redirectLoginSuccess = "index.php";
    $MM_redirectLoginFailed = "login.php";
    $MM_redirecttoReferrer = false;

    $mydb->select(array('Full_Name', 'UserName', 'Password', 'Access_Level'));
    $mydb->where('UserName', $loginUsername);
    $mydb->where('Password', md5($password));
    $result = $mydb->get("users");





    if ($result['count']) {
        $rowFullName = $result['result'][0];
        $loginFullname = $rowFullName['Full_Name'];
        $loginStrGroup = $rowFullName['Access_Level'];


        $_SESSION['MM_Fullname'] = $loginFullname;
        $_SESSION['MM_Username'] = $loginUsername;
        $_SESSION['MM_UserGroup'] = $loginStrGroup;


        if (isset($_SESSION['PrevUrl'])) {
            if ($_SESSION['PrevUrl'] != '/ThekeyHRMS/index.php')
                $MM_redirectLoginSuccess = $base_address . $_SESSION['PrevUrl'];
            else
                $MM_redirectLoginSuccess = $base_address . '/ThekeyHRMS/';
        } else {
            $MM_redirectLoginSuccess = $base_url;
        }
        header("Location: " . $MM_redirectLoginSuccess);
    } else {
        alert('Incorrect Username Or Password!Check if CAPS LOCK is ON.');
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Thekey HRMS login</title>
        <?php
        $base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
        $port = $_SERVER['SERVER_PORT'];
        if ($port == 80) {
            $port = '';
        } else {
            $port = ':' . $port;
        }
        $base_url = $_SERVER['SERVER_NAME'] . $port . '/ThekeyHRMS/';
        ?>
        <link href="http://<?php echo $base_url ?>css/css.css" rel="stylesheet" type="text/css" />
        <link href="http://<?php echo $base_url ?>images/icon.ico" rel="shortcut icon"/>
    </head>

    <body>
        <div id="login_form">
            <form  action="<?php echo $loginFormAction; ?>" id="frmLogin" name="frmLogin" method="post" >
                <ul>
                    <li>
                        <h2 style="color: #ff6600;text-align: center;width: 100%">Thekey HRMS</h2>
                        <h3>Login</h3>
                    </li>
                    <li>
                        <label for="txtUsername">User Name</label>
                        <input type="text"  required="required"  name="txtUsername" id="txtUsername" tabindex="10" />
                    </li>
                    <li>
                        <label for="txtPassword"> Password<a>Forgot your password?</a></label>
                        <input type="password" required="required" name="txtPassword" id="txtPassword" tabindex="20" />
                    </li>
                </ul>
                <div id="login_footer">
                    <label>
                        <input type="checkbox" name="remember_me"/>
                        Keep me logged in
                    </label>
                    <input  id="btnLogin" alt="Login" type="image" src="images/login.png" name="login_button"/>
                    <br/>
                    <br/>
					<i style="float:right;">Thekeysoft</i>
                    <!--img style="float: right;" width="133" height="35"  src="images/thekeysoft.png" alt="ThekeyHRM"/-->
                </div>
            </form>
        </div>
    </body>
</html>

