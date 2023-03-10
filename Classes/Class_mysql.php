<?php

/*
 * File Name: Database.php
 * Date: November 18, 2008
 * Author: Angelo Rodrigues
 * Description: Contains database connection, result
 *              Management functions, input validation
 *
 *              All functions return true if completed
 *              successfully and false if an error
 *              occurred
 *
 */

class Mysql_DB {
    /*
     * Edit the following variables
     */

    private $db_host = 'localhost';     // Database Host
    private $db_user = 'root';          // Username
    private $db_pass = 'EWSadmin';          // Password
    private $db_name = 'thekeyhrmsdb';          // Database
    /*
     * End edit
     */
    private $con = false;               // Checks to see if the connection is active
    private $result = array();          // Results that are returned from the query

    /*
     * Connects to the database, only one connection
     * allowed
     */

    public function _construct() {
        $this->connect();
    }

    public function connect() {
        if (!$this->con) {
            $myconn = @mysql_connect($this->db_host, $this->db_user, $this->db_pass);
            if ($myconn) {
                $seldb = @mysql_select_db($this->db_name, $myconn);
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

    /*
     * Changes the new database, sets all current results
     * to null
     */

    public function setDatabase($name) {
        if ($this->con) {
            if (@mysql_close()) {
                $this->con = false;
                $this->results = null;
                $this->db_name = $name;
                $this->connect();
            }
        }
    }

    /*
     * Checks to see if the table exists when performing
     * queries
     */

    private function tableExists($table) {
        $tablesInDb = @mysql_query('SHOW TABLES FROM ' . $this->db_name . ' LIKE "' . $table . '"');
        if ($tablesInDb) {
            if (mysql_num_rows($tablesInDb) == 1) {
                return true;
            } else {
                return false;
            }
        }
    }

    /*
     * Selects information from the database.
     * Required: table (the name of the table)
     * Optional: rows (the columns requested, separated by commas)
     *           where (column = value as a string)
     *           order (column DIRECTION as a string)
     */

    public function select($table, $rows = '*', $where = null, $join = null, $order = null) {
        $q = 'SELECT ' . $rows . ' FROM ' . $table;
        if ($join != null)
            $q .= ' JOIN ' . $join;

        if ($where != null)
            $q .= ' WHERE ' . $where;
        if ($order != null)
            $q .= ' ORDER BY ' . $order;

        // echo '<hr>'.$q;

        $query = mysql_query($q);

        if ($query) {
            $this->numResults = mysql_num_rows($query);
            for ($i = 0; $i < $this->numResults; $i++) {
                $r = mysql_fetch_array($query);
                $key = array_keys($r);
                for ($x = 0; $x < count($key); $x++) {

                    // Sanitizes keys so only alphavalues are allowed
                    if (!is_int($key[$x])) {
                        if (mysql_num_rows($query) > 1)
                            $this->result[$i][$key[$x]] = $r[$key[$x]];
                        else if (mysql_num_rows($query) < 1)
                            $this->result = null;
                        else
                            $this->result[$key[$x]] = $r[$key[$x]];
                    }
                }
            }
            return true;
        }
        else {

            return false;
        }
    }

    /*
     * Insert values into the table
     * Required: table (the name of the table)
     *           values (the values to be inserted)
     * Optional: rows (if values don't match the number of rows)
     */

    public function insert($table, $values, $rows = null) {
        if ($this->tableExists($table)) {
            $insert = 'INSERT INTO ' . $table;
            if ($rows != null) {
                $insert .= ' (' . $rows . ')';
            }

            for ($i = 0; $i < count($values); $i++) {
                if (is_string($values[$i]))
                    $values[$i] = '"' . $values[$i] . '"';
            }
            $values = implode(',', $values);
            $insert .= ' VALUES (' . $values . ')';

            $ins = @mysql_query($insert);

            if ($ins) {
                return true;
            } else {
                return false;
            }
        }
    }

    /*     * *********************
     * insert Data to the table 
     * 
     * 
     * 
     */

    public function insertData($tableName, $insertFields, $insertValues) {
        if ($this->tableExists($tableName)) {

            $insertSql = 'INSERT INTO ' . $tableName;

            
           $insertFields = implode(',', $insertFields);
           
           $insertSql .=' ('. $insertFields. ')';

            for ($i = 0; $i < count($insertValues); $i++) {
                if (is_string($insertValues[$i]))
                    $insertValues[$i] = '"' . $insertValues[$i] . '"';
            }

            $insertValues = implode(',', $insertValues);

            $insertSql .= ' VALUES (' . $insertValues . ')';

            //echo '<hr>'.$insertSql;
            
            $insertResult = @mysql_query($insertSql);

            if ($insertResult) {
                return true;
            } else {
                return false;
            }
        }
    }

    /*
     * Deletes table or records where condition is true
     * Required: table (the name of the table)
     * Optional: where (condition [column =  value])
     */

    public function delete($table, $where = null) {
        if ($this->tableExists($table)) {
            if ($where == null) {
                $delete = 'DELETE ' . $table;
            } else {
                $delete = 'DELETE FROM ' . $table . ' WHERE ' . $where;
            }
            $del = @mysql_query($delete);

            if ($del) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /*
     * Updates the database with the values sent
     * Required: table (the name of the table to be updated
     *           rows (the rows/values in a key/value array
     *           where (the row/condition in an array (row,condition) )
     */

    public function update($table, $rows, $where) {
        if ($this->tableExists($table)) {
            // Parse the where values
            // even values (including 0) contain the where rows
            // odd values contain the clauses for the row
            for ($i = 0; $i < count($where); $i++) {
                if ($i % 2 != 0) {
                    if (is_string($where[$i])) {
                        if (($i + 1) != null)
                            $where[$i] = '"' . $where[$i] . '" AND ';
                        else
                            $where[$i] = '"' . $where[$i] . '"';
                    }
                }
            }
            $where = implode('', $where);


            $update = 'UPDATE ' . $table . ' SET ';
            $keys = array_keys($rows);
            for ($i = 0; $i < count($rows); $i++) {
                if (is_string($rows[$keys[$i]])) {
                    $update .= $keys[$i] . '="' . $rows[$keys[$i]] . '"';
                } else {
                    $update .= $keys[$i] . '=' . $rows[$keys[$i]];
                }

                // Parse to add commas
                if ($i != count($rows) - 1) {
                    $update .= ',';
                }
            }
            $update .= ' WHERE ' . $where;

           // echo $update;

            $query = @mysql_query($update);
            echo $query;
            if ($query) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /*
     * Returns the result set
     */

    public function getResult() {
        return $this->result;
    }

}

//$mysql = new Mysql_DB;
//$mysql->connect();
//$mysql->select('employee_personal_record');
//$mysql->select('employee_personal_record','ID,FirstName,MiddelName','ID<>"" AND FirstName="Dekebo"'); 
//  $insertRecutiment = $obj_Recruitment->insert("Recruitment", array($_POST['Employer'], $_POST['Place'], $_POST['ID'], $_POST['FirstName']
//                    , $_POST['MiddelName'], $_POST['LastName'], $_POST['Date_Birth'], $_POST['Age'], $_POST['Sex'], $Photo, $_POST['Date']
//                    , $_POST['Address'], $_POST['Department'], $_POST['Position'], $_POST['Salary'], $_POST['Transport_Allowance']
//                    , $_POST['Housing_Allowance'], $_POST['Hardship_Allowance'], $_POST['Position_Allowance'], $_POST['Present_Allowance'], $_SESSION['MM_Username']), "Employer, Place, ID, FirstName, MiddelName, LastName,Date_Birth, Age, Sex, Photo, `Date`, Address,`Department`, `Position`, Salary, Transport_Allowance,Housing_Allowance,Hardship_Allowance, Position_Allowance,Present_Allowance,ModifiedBy");
//$mysql->update('employee_personal_record', array('FirstName'=>'DEK'), array('FirstName="Dekebo"'));
//  $insertValues = array('valueIDx','Terminated_Datex', 'Termination_ReasonX', 'Black_ListX');
//    $insertFields = array('ID', 'Terminated_Date', 'Termination_Reason', 'Black_List');
// $Result1 = $mysql->insertData('terminated_employee',$insertFields, $insertValues);
?>