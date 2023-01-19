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
        $this->hostname_HRMS = "localhost";
        $this->database_HRMS = "thekeyhrmsdb_sher";
        $this->username_HRMS = "root";
        $this->password_HRMS = "";//
    }

}

$my_db_config = new db_config();
$hostname_HRMS = $my_db_config->hostname_HRMS;
$database_HRMS = $my_db_config->database_HRMS;
$username_HRMS = $my_db_config->username_HRMS;
$password_HRMS = $my_db_config->password_HRMS;
?>
