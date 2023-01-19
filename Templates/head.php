<?php
//initialize the session
if (!session_id()) {
    session_start();
}

function pre($array) {
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

function send_email($to, $subject, $message) {
    $mydb = new DataBase();
    $result = $mydb->get('company_settings', 1);
    $result = $result['result'][0];

    // To send HTML mail, the Content-type header must be set
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
    $headers .= 'From: ' . $result['Company_Name'] . '<' . $result['Company_Email'] . '>' . "\r\n";
    return true; //mail($to, $subject, $message, $headers);
}

if (!defined('validurl'))
    define("validurl", TRUE);
$base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
$port = $_SERVER['SERVER_PORT'];
if ($port == 80) {
    $port = '';
}  else {
    if (!preg_match('/[:]/', $port))
        $port = ':' . $port;
}
$base_url = $_SERVER['SERVER_NAME'] . $port . '/ThekeyHRMS/';
require_once $base_path . 'Classes/Class_language.php';
require_once $base_path . 'config/database.php';
require_once $base_path . 'lib/database.php';
require_once $base_path . 'lib/form.php';
require_once $base_path . 'lib/pagination.php';
require_once $base_path . 'lib/fileupload.php';

require_once $base_path . 'Connections/HRMS.php';
require_once $base_path . 'Classes/Class_AccessLevel.php';

$obj_AccessLevel = new AccessLevel();

if (!isset($dont_check)) {
    $obj_AccessLevel->CHK_AccessLevel();
} else {
    if (!isset($_SESSION['MM_Username'])) {
        $MM_restrictGoTo = 'http://' . $base_url . "login.php";
        header("Location: " . $MM_restrictGoTo);
    }
}


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

if (!isset($_REQUEST["lang"])) {
    if (isset($_SESSION['lang'])) {
        $lang = $_SESSION['lang'];
    } else {
        $lang = "en";
    }
} else {
    $lang = $_REQUEST["lang"];
    $_SESSION['lang'] = $lang;
}

$realpath = dirname(realpath(__FILE__));
//checking the connection is secure or not the identfy http or https protocol then append server host name
$path = ((isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) != 'off') ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . "/" . substr($realpath, strlen($_SERVER['DOCUMENT_ROOT']));

if (DIRECTORY_SEPARATOR == '\\')
    $path = str_replace('\\', '/', $path);
?>

<?php if (!isset($include_html)): ?>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


    <script src="http://<?php echo $base_url ?>js/jquery_lib.js" type="text/javascript"></script>
    <script  src="http://<?php echo $base_url ?>js/jquery_ui.js"></script>
    <script  src="http://<?php echo $base_url ?>js/jquery-ui.multidatespicker.js"></script>
    <script  src="http://<?php echo $base_url ?>js/DateConvertor.js"></script>
    <script type='text/javascript' src='http://<?php echo $base_url ?>js/jquery.autocomplete.js'></script>
    <script type='text/javascript' src='http://<?php echo $base_url ?>js/webforms2/webforms2-p.js'></script>
	<script type='text/javascript' src='http://<?php echo $base_url ?>js/modernizr.js'></script>
	<script type='text/javascript' src='http://<?php echo $base_url ?>Report/Chart/FusionCharts.js'></script>
   
	
    <script  src="http://<?php echo $base_url ?>js/js.js"></script>
	
	 <script type='text/javascript' src='http://<?php echo $base_url ?>js/picnet.table.filter.min.js'></script>
	<script type='text/javascript' src='http://<?php echo $base_url ?>js/jquery.tablePagination.0.5.js'></script>
<script type='text/javascript' src='http://<?php echo $base_url ?>js/jquery.tablesorter.js'></script>


    <link rel="stylesheet" type="text/css" href="<?php echo "http://" . $base_url . "css/jquery.autocomplete.css"; ?>"/>
    <link rel="stylesheet" href="http://<?php echo $base_url ?>css/themes/jquery.ui.all.css"/>
    <link href="http://<?php echo $base_url ?>css/css.css" rel="stylesheet" type="text/css" />
    <link href="http://<?php echo $base_url ?>images/icon.ico" rel="shortcut icon"/>

<?php endif; ?>