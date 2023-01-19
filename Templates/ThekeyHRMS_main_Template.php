 


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Thekey HRMS</title>



        <?php
//initialize the session
        if (!session_id()) {
            session_start();
        }

// ** Logout the current user. **
        $logoutAction = $_SERVER['PHP_SELF'] . "?doLogout=true";
        if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")) {
            $logoutAction .="&" . htmlentities($_SERVER['QUERY_STRING']);
        }

        if ((isset($_GET['doLogout'])) && ($_GET['doLogout'] == "true")) {
            //to fully log out a visitor we need to clear the session varialbles
            $_SESSION['MM_Fullname'] = NULL;
            $_SESSION['MM_Username'] = NULL;
            $_SESSION['MM_UserGroup'] = NULL;
            $_SESSION['PrevUrl'] = NULL;
            unset($_SESSION['MM_Username']);
            unset($_SESSION['MM_UserGroup']);
            unset($_SESSION['PrevUrl']);

            $logoutGoTo = "../login.php";
            if ($logoutGoTo) {
                header("Location: $logoutGoTo");
                exit;
            }
        }
        ?>


        <?php
//******
////$db = new MySQLi($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_DATABASE,$DB_PORT);
//
        $db = mysql_connect($hostname_HRMS, $username_HRMS, $password_HRMS);
        if (!$db) {
            die('Not connected with Language Database : ' . mysql_error());
        }
        $db_selected = mysql_select_db($database_HRMS, $db);
        if (!$db_selected) {
            die('Can\'t use Language database : ' . mysql_error());
        }

//Setting Charcter set to unicode to support all language
        mysql_set_charset('utf8', $db);
// $db -> set_charset('utf8');
// create a new Langauge Object
        $obj_lang = new Language($db);

// ideally pull this from a users profile.

        if (!isset($_REQUEST["lang"]))
            $_REQUEST["lang"] = "en";

        $lang = $_REQUEST["lang"];
        ?>

        <?php
        $realpath = dirname(realpath(__FILE__));
//checking the connection is secure or not the identfy http or https protocol then append server host name
        $path = ((isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) != 'off') ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . "/" . substr($realpath, strlen($_SERVER['DOCUMENT_ROOT']));

        if (DIRECTORY_SEPARATOR == '\\')
            $path = str_replace('\\', '/', $path);
        ?>



    </head>

    <body>


        <div id="mainContent"><!-- TemplateBeginEditable name="MainContent" -->


















            <!-- TemplateEndEditable -->
            <blockquote>&nbsp;</blockquote>
        </div>



    </body>
</html>


