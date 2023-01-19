<?

//***************************************
// This is downloaded from www.plus2net.com //
/// You can distribute this code with the link to www.plus2net.com ///
//  Please don't  remove the link to www.plus2net.com ///
// This is for your learning only not for commercial use. ///////
//The author is not responsible for any type of loss or problem or damage on using this script.//
/// You can use it at your own risk. /////
//*****************************************
//error_reporting(E_ERROR | E_PARSE | E_CORE_ERROR);
set_time_limit(60);

////// Your Database Details here /////////
$dbservertype = 'mysql';
$servername = '127.0.0.1';
$dbusername = '';
$dbpassword = '';
$dbname = '';

////////////////////////////////////////
////// DONOT EDIT BELOW  /////////
///////////////////////////////////////

connecttodb($servername, $dbname, $dbusername, $dbpassword);

function connecttodb($servername, $dbname, $dbuser, $dbpassword) {
    global $link;
    $link = mysql_connect("$servername", "$dbuser", "$dbpassword");
    if (!$link) {
        die("Could not connect to MySQL");
    }
    mysql_select_db("$dbname", $link) or die("could not open db" . mysql_error());
}

//////////////////////////////// Main Code starts /////////////////////////////////////////////

$q = mysql_fetch_object(mysql_query("select max(stage) as stage from progress"));
//echo $q->stage;
///////////////////////////////////////////////
//$width=$_POST['width'];
$width = $q->stage * 20;
echo $width;
?>