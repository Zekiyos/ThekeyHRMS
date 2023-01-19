<?php
require_once("../Classes/language.php");


//$db = new MySQLi($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_DATABASE,$DB_PORT);


$db = mysql_connect($hostname_HRMS, $username_HRMS, $password_HRMS);
if (!$db) {
    die('Not connected : ' . mysql_error());
}
$db_selected = mysql_select_db($database_HRMS, $db);
if (!$db_selected) {
    die('Can\'t use Language db : ' . mysql_error());
}

//Setting Charcter set to unicode to support all language
mysql_set_charset('utf8', $db);
// $db -> set_charset('utf8');
// create a new Langauge Object
$obj_lang = new Language($db);

// ideally pull this from a users profile.
$lang = $_REQUEST["lang"];
// $lang = "en"; 
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    </head>

    <body>
        <a href="index.php?lang=en"><?php echo $obj_lang->get('LANG_EN', $lang); ?></a>|<a href="index.php?lang=jp"><?php echo $obj_lang->get('LANG_JP', $lang); ?></a>|<a href="index.php?lang=zh"><?php echo $obj_lang->get('LANG_ZH', $lang); ?></a>
        <form>
            <?php echo $obj_lang->get('FNAME', $lang); ?>:<input type="text" name="firstname" /><br />
            <?php echo $obj_lang->get('LNAME', $lang); ?>:<input type="text" name="lastname" /><br />
            <select name="lang">
                <option value="en"><?php echo $obj_lang->get('LANG_EN', $lang); ?></option>
                <option value="jp"><?php echo $obj_lang->get('LANG_JP', $lang); ?></option>
                <option value="zh"><?php echo $obj_lang->get('LANG_ZH', $lang); ?></option>
            </select><br />
            <input type="submit" value=<?php echo $obj_lang->get('SUBMIT', $lang); ?> />
        </form> 
    </body>
</html>