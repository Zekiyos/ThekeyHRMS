<?php

if (!defined('validurl'))
    exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of security
 *
 * @author raju
 */
class security {

    //put your code here
    function escape_string($value) {
        return mysql_real_escape_string($value);
    }

}

?>
