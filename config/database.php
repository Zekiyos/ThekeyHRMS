<?php

/**
  | -------------------------------------------------------------------
  | DATABASE CONNECTIVITY SETTINGS
  | -------------------------------------------------------------------
  | This file will contain the settings needed to access your database.
  |
  | |
  | -------------------------------------------------------------------
  | EXPLANATION OF VARIABLES
  | -------------------------------------------------------------------
  |
  |	['hostname'] The hostname of your database server.
  |	['username'] The username used to connect to the database
  |	['password'] The password used to connect to the database
  |	['database'] The name of the database you want to connect to
 * 
 */
class db_config {

    public $hostname_HRMS;
    public $database_HRMS;
    public $username_HRMS;
    public $password_HRMS;

    function __construct() {
	//$this->hostname_HRMS = "localhost";
	//$this->database_HRMS = "ThekeyHRMSDB";
	//$this->username_HRMS = "root";
	//$this->password_HRMS = "EWSadmin";
	
	echo "Please Don't Check Force Import, If you aready Import once.It slows down the server.";
	echo "<center><hr><b><h1>Please Wait a moment ...<br/><br/>
	Thekey HRMS is Blocked for temporarily!</h1></b>For more information call <i>+251-46-4414040 or +251-46-4412273</i></center>";
	echo "<a href='http://192.168.1.201/thekeyhrms_ci/index.php/Users/login' > Thekey HRMS New Version</a>";
	exit();

    }

}

$my_db_config = new db_config();
$hostname_HRMS = $my_db_config->hostname_HRMS;
$database_HRMS = $my_db_config->database_HRMS;
$username_HRMS = $my_db_config->username_HRMS;
$password_HRMS = $my_db_config->password_HRMS;
?>
