<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

Class Connection {

    public $hostName = "localhost";
    public $userName = "root";
    public $password = "EWSadmin";
    public $dbName = "TheKeyHRMSDB";
    
    
    
    public $con = false;    

    public function _construct() {
        $this->connect();
    }

    public function connect() {
        if (!$this->con) {
            $myconn = @mysql_connect($this->hostName, $this->userName, $this->password);
            if ($myconn) {
                $seldb = @mysql_select_db($this->dbName, $myconn);
                if ($seldb) {
                    $this->con = true;
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

}


?>
