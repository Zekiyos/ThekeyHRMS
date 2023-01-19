<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function pre($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

if (!defined('validurl'))
    define("validurl", TRUE);
require_once 'config/database.php';
require_once 'lib/database.php';



//db_diff('thekeyhrms_db', 'thekeyhrmsdb');


table_diff('terminated_employee_annual_leave', 'annual_leave');


function db_diff($db1, $db2) {
    $mydb = new DataBase();
    $thekeyhrms_db = $mydb->show_tables($db1);
    $thekeyhrms = $mydb->show_tables($db2);
    foreach ($thekeyhrms as $key => $value) {

        if (isset($thekeyhrms_db[$key])) {
            table_diff($value, $thekeyhrms_db[$key]);
        }
    }
}

function table_diff($table1, $table2) {
    $mydb = new DataBase();
    $my_col = $mydb->show_column($table1, TRUE);
    $new_col = $mydb->show_column($table2, TRUE);
    coll_diff($my_col, $new_col);
}

function coll_diff($my_col, $new_col) {
    foreach ($new_col as $colkey => $colvalue) {
        if (!isset($my_col[$colkey])) {
            pre($colvalue);
        } else {

            foreach ($colvalue as $colskey => $colsvalue) {
                if ($my_col[$colkey][$colskey] != $colsvalue) {
                    echo "<br/>coll_dif <br/>";
                    echo $colskey;
                    pre($colvalue);
                }
            }
            unset($my_col[$colkey]);
        }
    }
    foreach ($my_col as $xkey => $xvalue) {
        echo 'New Filed';
        pre($xvalue);
    }
}

?>
