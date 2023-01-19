<?php

if (!defined('validurl'))
    exit('No direct script access allowed');


/* DataBase this class help to hande database commands such as insert , delete , update and select
 *
 * @author Raju Mesfin Salilih rajumesfin@gmail.com
 */

class DataBase extends db_config {

    private $_my_connection;
    private $_connected;
    private $_where;
    private $_having;
    private $_join;
    private $_order_by;
    private $_group_by;
    private $_collumens;
    private $_set;
    private $as_op;
    private $_math;
    var $error_no;
    private $limit = 0;
    private $all_sql;
    private $ofset = 0;
    var $error_message;

    function math($mathfiled, $displayAs) {
        if ($this->_math != '') {
            $this->_math .= ', ' . $mathfiled . ' as ' . $this->makeFiled($displayAs);
        } else {
            $this->_math .= $mathfiled . ' as ' . $this->makeFiled($displayAs);
        }
    }

    /**
     * Initiate the configeration then connect to the database server finaly sellect the database
     */
    function show_tables($database) {
        $sql = 'show tables from ' . $this->makeFiled($database) . '';
        $result = $this->execute_query($sql);
        $row_cout = mysql_affected_rows();
        if ($row_cout > 0) {
            $lists = array();
            while ($row = mysql_fetch_array($result)) {

                $lists[$row[0]] = $database . '.' . $row[0];
            }
            return $lists;
        } else {
            $query_result = array();
            $row_cout = 0;
        }
        return array($query_result);
    }

    function show_column($table, $get_all = false) {
        $sql = 'show columns from ' . $this->makeFiled($table) . '';
        $result = $this->execute_query($sql);
        $row_cout = mysql_affected_rows();
        if ($row_cout > 0) {

            $lists = array();
            while ($row = mysql_fetch_array($result)) {
                $rows = array();
                if ($get_all) {
                    $lists[$row['Field']] = array();
                    foreach ($row as $key => $value) {
                        if (!is_numeric($key)) {
                            $lists[$row['Field']][$key] = $value;
                        }
                    }
                } else {
                    $lists[$row['Field']] = $table . '.' . $row['Field'];
                }
            }
            return $lists;
        } else {
            $query_result = array();
            $row_cout = 0;
        }
        return array($query_result);
    }

    private function isDecimal($value) {
        $pattern = "/^[-]?([^0][0-9]+|[0])([.][0-9]+){0,1}$/";
        return $this->executecomparision($pattern, $value);
    }

    private function executecomparision($pattern, $string) {
        return preg_match($pattern, $string);
    }

    private function clearall() {
        $object_variables = get_object_vars($this);
        foreach ($object_variables as $key => $value) {
            if ($key != "_my_connection" && $key != 'all_sql' && $key != "_connected" && $key != "_set" && $key != 'hostname_HRMS' && $key != 'username_HRMS' && $key != 'password_HRMS' && $key != 'database_HRMS')
                $this->$key = "";
        }
    }

    function where_in($filed, $criteria) {
        $incriteria = "";
        if (is_array($criteria)) {
            foreach ($criteria as $key => $value) {
                if ($incriteria != "") {
                    if (is_numeric($value)) {
                        $incriteria .= "," . $value . "";
                    } else {
                        $incriteria .= ",'" . $value . "'";
                    }
                } else {
                    $incriteria = is_numeric($value) ? $value : "'" . $value . "'";
                }
            }

            if ($this->_where != "") {
                $this->_where .= " and " . $this->makeFiled($filed) . " in (" . $incriteria . ")";
            } else {
                $this->_where = " " . $this->makeFiled($filed) . "  in (" . $incriteria . ")";
            }
        } else {
            if ($this->_where != "") {
                $this->_where .= " and " . $this->makeFiled($filed) . "  in (" . $criteria . ")";
            } else {
                $this->_where .= "  " . $this->makeFiled($filed) . "  in (" . $criteria . ")";
            }
        }
    }

    function or_where_in($filed, $criteria) {
        $incriteria = "";
        if (is_array($criteria)) {
            foreach ($criteria as $key => $value) {
                if ($incriteria != "") {
                    if (is_numeric($value)) {
                        $incriteria .= "," . $value . "";
                    } else {
                        $incriteria .= ",'" . $value . "'";
                    }
                } else {
                    $incriteria = is_numeric($value) ? $value : "'" . $value . "'";
                }
            }

            if ($this->_where != "") {
                $this->_where .= " or " . $this->makeFiled($filed) . "  in (" . $incriteria . ")";
            } else {
                $this->_where = " " . $this->makeFiled($filed) . "  in (" . $incriteria . ")";
            }
        } else {
            if ($this->_where != "") {
                $this->_where .= " or " . $this->makeFiled($filed) . "  in (" . $criteria . ")";
            } else {
                $this->_where .= "  " . $this->makeFiled($filed) . "  in (" . $criteria . ")";
            }
        }
    }

    function where_not_in($filed, $criteria) {
        $incriteria = "";
        if (is_array($criteria)) {
            foreach ($criteria as $key => $value) {
                if ($incriteria != "") {
                    if (is_numeric($value)) {
                        $incriteria .= "," . $value . "";
                    } else {
                        $incriteria .= ",'" . $value . "'";
                    }
                } else {
                    $incriteria = is_numeric($value) ? $value : "'" . $value . "'";
                }
            }

            if ($this->_where != "") {
                $this->_where .= " and " . $this->makeFiled($filed) . " Not in (" . $incriteria . ")";
            } else {
                $this->_where = " " . $this->makeFiled($filed) . " Not in (" . $incriteria . ")";
            }
        } else {
            if ($this->_where != "") {
                $this->_where .= " and " . $this->makeFiled($filed) . "  Not in (" . $criteria . ")";
            } else {
                $this->_where .= "  " . $this->makeFiled($filed) . "  Not in (" . $criteria . ")";
            }
        }
    }

    function or_where_not_in($filed, $criteria) {
        $incriteria = "";
        if (is_array($criteria)) {
            foreach ($criteria as $key => $value) {
                if ($incriteria != "") {
                    if (is_numeric($value)) {
                        $incriteria .= "," . $value . "";
                    } else {
                        $incriteria .= ",'" . $value . "'";
                    }
                } else {
                    $incriteria = is_numeric($value) ? $value : "'" . $value . "'";
                }
            }

            if ($this->_where != "") {
                $this->_where .= " or " . $this->makeFiled($filed) . " Not in (" . $incriteria . ")";
            } else {
                $this->_where = " " . $this->makeFiled($filed) . " Not in (" . $incriteria . ")";
            }
        } else {
            if ($this->_where != "") {
                $this->_where .= " or " . $this->makeFiled($filed) . "  Not in (" . $criteria . ")";
            } else {
                $this->_where .= "  " . $this->makeFiled($filed) . "  Not in (" . $criteria . ")";
            }
        }
    }

    function __construct() {
        parent::__construct();
        $database_name = 'thekeyhrmsdb';
        $this->connect($this->hostname_HRMS, $this->username_HRMS, $this->password_HRMS, $this->database_HRMS);
    }

    function count($table) {
        $this->math('count(*)', 'total_row');
        $sql = $this->generateselectstatment($table);
        $result = $this->execute_query($sql);
        $row_cout = mysql_affected_rows();
        if ($row_cout > 0) {
            $query_result = $this->convertDatatoObject($table, $result);
            return $query_result[0]['total_row'];
        } else {
            return 0;
        }
    }

    /**
     * Open a connection to a MySQL Server
     * @param String $server name of the mysql server or ip
     * @param String $username The username. Default value is defined by mysql
     * @param String $password
     * @param String $database_name 
     * @return Boolean return false if the connection is not stablished else it connect the <br>
     * to mysql database server and select database
     */
    private function connect($server, $username, $password, $database_name) {
        if ($server == "") {
            $server = "localhost";
        }
        if ($username == "") {
            echo "you should have to provide database user name";
            return false;
        }
        if ($database_name == "") {
            echo "Select the database you want to work on";
            return false;
        }
        if ($password != "") {
            $this->_my_connection = mysql_connect($server, $username, $password) or die(mysql_error());
            $this->_connected = true;
        } else {
            $this->_my_connection = mysql_connect($server, $username) or die(mysql_error());
            $this->_connected = true;
        }
        if ($this->_connected) {
            $this->selectDb($database_name);
        }
    }

    /**
     * Select a MySQL database
     * @param string $db The name of the database that is to be selected.
     */
    private function selectDb($db) {
        $database_name = $db;
        if ($database_name != "") {
            if ($this->_connected) {
                mysql_select_db($database_name, $this->_my_connection);
            }
        }
    }

    /**
     * This function is identical to the one above, except that multiple instances are joined by And operator:
     * @param Array/String $criteria
     * <b>Example</b> array("sex"=>"Male","age"=>32)
     */
    public function where($criteriafiled, $value = FALSE) {
        if ($value !== false) {
            if (!is_array($criteriafiled)) {
                $criteria = array($criteriafiled => $value);
            } else {
                $criteria = $criteriafiled;
            }
        } else {
            $criteria = $criteriafiled;
        }
        $this->prepareforFilter($criteria, "_where");
        return $this;
    }

    /**
     * This function enables you to generate LIKE clauses, useful for doing searches.
     * if the criteria is more than one it join them with "And" operator
     * @param Array/String $criteria
     */
    public function like($criteriafiled, $value = FALSE) {
        if ($value !== false) {
            if (!is_array($criteriafiled)) {
                $criteria = array($criteriafiled => $value);
            } else {
                $criteria = $criteriafiled;
            }
        } else {
            $criteria = $criteriafiled;
        }
        $this->prepareforFilter($criteria, "_where", "And", "like");
    }

    /**
     * This function enables you to generate LIKE clauses, useful for doing searches.
     * if the criteria is more than one it join them with "or" operator
     * @param Array/String $criteria
     */
    public function or_like($criteria) {
        $this->prepareforFilter($criteria, "_where", "or", "like");
    }

    /**
     * This function is identical to the one above, except that multiple instances are joined by OR:
     * @param Array/String $criteria
     */
    public function or_where($criteriafiled, $value = False) {

        if ($value !== false) {
            if (!is_array($criteriafiled)) {
                $criteria = array($criteriafiled => $value);
            } else {
                $criteria = $criteriafiled;
            }
        } else {
            $criteria = $criteriafiled;
        }
        $this->prepareforFilter($criteria, "_where", "or");
    }

    /**
     * Permits you to write the HAVING portion of your query.<br>
     * if the criteria is more than one it join them with "And" operator
     * @param Array/String $criteria
     */
    public function having($criteriafiled, $value = false) {
        if ($value !== false) {
            if (!is_array($criteriafiled)) {
                $criteria = array($criteriafiled => $value);
            } else {
                $criteria = $criteriafiled;
            }
        } else {
            $criteria = $criteriafiled;
        }
        $this->prepareforFilter($criteria, '_having');
    }

    /**
     *
     * Permits you to write the HAVING portion of your query.<br>
     * if the criteria is more than one it join them with "or" operator
     */
    public function or_having($criteria) {
        $this->prepareforFilter($criteria, '_having', "or");
    }

    /**
     * Lets you set an ORDER BY clause. The first parameter contains the name of the<br>
     * column you would like to order by. The second parameter lets you set the direction of the result.<br>
     * Options are asc or desc<br>
     * @param Array $fileds
     * @param Array $option [Optional] Values <b>desc</b> or <b> asc</b>
     */
    public function order_by($fileds, $option = "") {
        $this->prepareforlist($fileds, "_order_by", $option);
        return $this;
    }

    /**
     * Permits you to write the SELECT portion of your query:
     * @param Array $fileds
     */
    public function select($fileds) {
        if (is_array($fileds)) {
            $this->prepareforlist($fileds, "_collumens", '', TRUE);
        } else {
            if ($this->_collumens == '') {
                $this->_collumens = $this->makeFiled($fileds);
            } else {
                $this->_collumens .= ',' . $this->makeFiled($fileds);
            }
        }
        return $this;
    }

    /**
     * This function enables you to set values for inserts or updates.<br>
     * It can be used instead of passing a data array directly to the insert or update functions:
     * @param Array $values<br>
     * <b>Example </b> array("fname"=>"Raju","lname"=>"Mesfin")
     */
    public function set($values) {
        $this->_set = $values;
    }

    /**
     * Permits you to write the GROUP BY portion of your query:
     * @param Array/String $fileds
     * you can probide single string value or list of filed.
     */
    public function group_by($fileds) {
        $this->prepareforlist($fileds, '_group_by');
    }

    /**
     *
     * @param Array $values list of filter criteria<br>
     * <b>Example 1 </b><code> Array("fname"=>"raju");</code><br>
     * <b>Example 2</b> fname=raju;
     * @param String $saveon specify the sql statment such as where, having
     * @param String $operator [optional] specify the sql operator "And" and "or"
     * @param  Bollean $like [optional] specify if you want to use like 
     */
    private function prepareforFilter($values, $saveon, $operator = "and", $like = false) {
        if ($like) {
            $saveon = '_having';
        }
        $result = $this->$saveon;
        if (is_array($values)) {
            foreach ($values as $key => $value) {
                if (!$this->isDecimal($value)) {
                    if ($like) {
                        $value = '\'%' . mysql_real_escape_string($value) . '%\'';
                    } else {
                        $value = '\'' . mysql_real_escape_string($value) . '\'';
                    }
                } else {
                    $value = $value;
                }


                if ($result == "") {
                    if ($like == false) {
                        $pattern = '/(>=|<=|<|>|=|!=)$/';
                        $op = '=';
                        if (preg_match($pattern, $key, $machs)) {
                            $key = preg_replace($pattern, '', $key);
                            $op = $machs[0];
                        } else {
                            $op = '=';
                        }
                        $result = "(" . $this->makeFiled($key) . $op . $value . ")";
                    } else {
                        $result = "(" . $this->makeFiled($key) . " like " . $value . ")";
                    }
                } else {
                    if ($like == false) {
                        $pattern = '/(>=|<=|<|>|=|!=)$/';
                        if (preg_match($pattern, $key, $machs)) {
                            $key = preg_replace($pattern, '', $key);
                            $op = $machs[0];
                        }
                        $result = $result . " " . $operator . " (" . $this->makeFiled($key) . "=" . $value . ")";
                    }
                    else
                        $result = $result . " " . $operator . " (" . $this->makeFiled($key) . " Like " . $value . ")";
                }
            }
        } else {
            $result = $values;
        }
        $this->$saveon = '(' . $result . ')';
    }

    function makeFiled($filed) {

        $distinct = '';

        if (preg_match('/DISTINCT/', $filed)) {
            $filed = trim(preg_replace('/DISTINCT/', '', $filed));
            $distinct = 'DISTINCT';
        }

        $key = preg_split('/[.]/', $filed);
        $mysqlFiled = '';
        foreach ($key as $keyinfo => $vlues) {
            if ($mysqlFiled == '') {
                $mysqlFiled = "`" . $vlues . "`";
            } else {
                $mysqlFiled .= '.' . "`" . $vlues . "`";
            }
        }


        return $distinct . ' ' . $mysqlFiled;
    }

    /**
     *
     * @param Array $list
     * @param String $saveon
     * @param String $orderoption [optional] to set ordering option for ORDER BY clause . options "asc" or "desc"
     */
    private function prepareforlist($list, $saveon, $orderoption = "", $select = false) {

        if ($this->$saveon == "") {
            $result = "";
        } else {
            $result = $this->$saveon;
        }
        if (is_array($list)) {
            foreach ($list as $key => $value) {
                $as_operation = '';
                if ($select) {
                    $as_operation = $this->make_as($value);
                    if ($this->as_op != '')
                        $value = $this->as_op;
                }
                if ($result == "") {
                    $result = $this->makeFiled($value) . ' ' . $as_operation . ' ' . $orderoption;
                }
                else
                    $result = $result . "," . $this->makeFiled($value) . ' ' . $as_operation . ' ' . $orderoption;
            }
        }
        else {
            $as_operation = '';
            if ($select) {
                $as_operation = $this->make_as($value);
                if ($this->as_op != '')
                    $value = $this->as_op;
            }
            if ($result == "") {
                $result = $this->makeFiled($list) . ' ' . $as_operation . ' ' . $orderoption;
            }
            else
                $result = $result . "," . $this->makeFiled($list) . ' ' . $as_operation . ' ' . $orderoption;
        }
        $this->$saveon = $result;
    }

    /**
     * Runs the selection query and returns the result. Can be used by itself to retrieve all records from a table:<br>
     * The second and third parameters enable you to set a limit and offset clause:
     * @param String $table
     * @param Int $limit [optional] this help to specify the number of rows to be selected
     * @param Int $offset [optional] this help to specify where to start retriving record
     * @return Array
     */
    public function get($table, $limit = 0, $offset = 0) {
        if ($table == "") {
            echo "specify the table";
            return FALSE;
        }
        if ($limit == 0) {
            $limit = $this->limit;
        }
        if ($offset == 0) {
            $offset = $this->ofset;
        }
        $sql = $this->generateselectstatment($table, $limit, $offset);
        $result = $this->execute_query($sql);
        $row_cout = mysql_affected_rows();
        if ($row_cout > 0) {
            $query_result = $this->convertDatatoObject($table, $result);
        } else {
            $query_result = array();
            $row_cout = 0;
        }
        if ($this->all_sql != '') {
            $all_result = $this->execute_query($this->all_sql);
            $all_row_cout = mysql_affected_rows();
        } else {
            $all_row_cout = $row_cout;
        }
        return array("count" => $row_cout, "result" => $query_result, 'total_row' => $all_row_cout);
    }

    function set_limit($limit, $offset = 0) {
        $this->limit = $limit;
        $this->ofset = $offset;
    }

    /**
     * This function Accept Array from database result and return Array in Two dimensional 
     * formats that can be used for combo box as key and value
     * @param Array $result
     * @param String $keyFiled
     * @param String $valueFiled
     * @return Array
     */
    function getKeyAndValue($result, $keyFiled, $valueFiled) {
        $resultData = array();
        foreach ($result as $key => $value) {
            $resultData[$value[$keyFiled]] = $value[$valueFiled];
        }
        return $resultData;
    }

    /**
     * Generate the select sql statment 
     * @param String $table
     * @param Int $limit [optional] this help to specify the number of rows to be selected
     * @param Int $offset [optional] this help to specify where to start retriving record
     * @return string Return Select Sql Statment
     */
    private function generateselectstatment($table, $limit = 0, $offset = -1) {
        if ($this->_collumens == "") {
            $sql = "SELECT * ";
        } else {
            $sql = "Select " . $this->_collumens;
        }
        if ($this->_math != '') {
            $sql .= ',' . $this->_math;
        }
        $sql .= " From " . $table;
        $sql = $sql . " " . $this->_join;
        if ($this->_where != "") {
            $sql = $sql . " Where " . $this->_where;
        }

        if ($this->_group_by != "") {
            $sql = $sql . " Group By " . $this->_group_by;
        }
        if ($this->_having != "") {
            $sql = $sql . " Having " . $this->_having;
        }
        if ($this->_order_by != "") {
            $sql = $sql . " Order By " . $this->_order_by;
        }

        $this->all_sql = $sql;



        if ($limit != 0) {
            $sql = $sql . "  LIMIT " . $offset . " , " . $limit;
        }
        return $sql;
    }

    /**
     * Execute Sql command and return result set
     * @param String $sql
     * @return query_result
     */
    private function execute_query($sql) {
        $result = mysql_query($sql, $this->_my_connection);
        $this->clearall();
        $is_error = mysql_errno();
        if ($is_error != 0) {

            $this->error_no = $is_error;
            $this->error_message = mysql_error();
        }
        return $result;
    }

    /**
     * Permits you to write the JOIN portion of your query:<br>
     * If you need something other than a natural JOIN you can specify it via the third parameter of the function. <br>
     * Options are: left, right, outer, inner, left outer, and right outer.<br>
     * <b>Example</b>
     * <code>
     * $this->join('comments', 'comments.id = blogs.id');
     * </code>
     * @param String $table
     * @param String $joinfiled
     * @param String $joinposition [optional] optional the defult value is iner join you can specify left and right
     */
    public function join($table, $joinfiled, $joinposition = "") {
        if (($table != "") && ($joinfiled != "")) {
            $this->_join = $this->_join . " " . $joinposition . " Join " . $table . " on " . $joinfiled;
        }
        return $this;
    }

    /**
     * Convert data that retrived from the database to array format
     * @param String $table
     * @param Array $result
     * @return String
     */
    private function convertDatatoObject($table, $result) {
        $lists = array();
        while ($row = mysql_fetch_array($result)) {
            $rows = array();
            foreach ($row as $key => $value) {
                if (!is_int($key)) {
                    $rows[$key] = $value;
                }
            }
            $lists[] = $rows;
        }
        return $lists;
    }

    /**
     * Generates an insert string based on the data you supply, and runs the query.<br>
     *  You can either pass an array or object or object to the function. Here is an example using an array:<br>
     * <code>
     * $data = array(<br>
     *          'title' => 'My title' ,<br>
     *          'name' => 'My Name' ,<br>
     *          'date' => 'My date'<br>
     *       );<br>
     *   $this->insert('mytable', $data);<br>
     * </code>
     * @param String $table<br>
     * @param Array $data [optional] the data can be specifyed by using set function<br>
     * @return Boolean<br>
     */
    function insert($table, $data = array()) {
        if (count($data) > 0) {
            $this->_set = $data;
        }
        if (count($this->_set) <= 0) {
            echo "please specify what to insert";
            return false;
        }
        $filed = "";
        $values = "";
        foreach ($this->_set as $key => $value) {
            if ($filed == "")
                $filed = $this->makeFiled($key) . "";
            else {
                $filed = $filed . " , " . $this->makeFiled($key);
            }
            if ($values == "") {
                if (is_integer($value)) {
                    $values = $value;
                } else {
                    $values = "'" . mysql_real_escape_string($value) . "'";
                }
            } else {
                if (is_integer($value))
                    $values = $values . " , " . $value;
                else {
                    $values = $values . " , '" . mysql_real_escape_string($value) . "'";
                }
            }
        }
        $sql = "Insert into " . $table . "(" . $filed . ") Values(" . $values . ")";
        $result = $this->execute_query($sql);
        return $result;
    }

    /**
     * Generates a delete SQL string and runs the query.
     * @param String $table
     */
    function delete($table) {

        $sql = "Delete from " . $table;
        if ($this->_where != "") {
            $sql = $sql . " where " . $this->_where;
        }
        $this->execute_query($sql);
        if (mysql_affected_rows() > 0)
            return true;
        else
            return false;
    }

    /**
     * Generates an update string and runs the query based on the data you supply. <br>
     * You can pass an array or objectto the function. Here is an example using an array:
     * <code>
     * $data = array(
     *          'title' => $title,
     *          'name' => $name,
     *          'date' => $date
     *       );
     * $this->where('id', $id);
     * $this->update('mytable', $data);
     * </code>
     * @param String $table
     * @param Array $data [optional] the data can be specifyed by using set function<br>
     * @return Int Number of row affected
     */
    function update($table, $data = array()) {
        if (count($data) > 0) {
            $this->_set = $data;
        }
        if (count($this->_set) <= 0) {
            echo "please specify what to Update";
            return false;
        }
        $updatewhat = "";
        foreach ($this->_set as $key => $value) {
            if ($updatewhat == "") {
                if ($this->isDecimal($value))
                    $updatewhat = $this->makeFiled($key) . "=" . $value;
                else {
                    if ($value != null)
                        $updatewhat = $this->makeFiled($key) . "='" . mysql_real_escape_string($value) . "'";
                    else
                        $updatewhat = $this->makeFiled($key) . "=Null";
                }
            } else {
                if ($this->isDecimal($value))
                    $updatewhat = $updatewhat . "," . $this->makeFiled($key) . "=" . $value;
                else {
                    if ($value != null)
                        $updatewhat = $updatewhat . "," . $this->makeFiled($key) . "='" . mysql_real_escape_string($value) . "'";
                    else
                        $updatewhat = $updatewhat . "," . $this->makeFiled($key) . "=Null";
                }
            }
        }
        $sql = "Update  " . $table . " set " . $updatewhat;
        if ($this->_where != "") {
            $sql = $sql . " Where " . $this->_where;
        }
        $where = $this->_where;
        $result = $this->execute_query($sql);
        $row_cout = mysql_affected_rows();
        $this->where($where);
        $result = $this->get($table);
        
        if ($result['count'] > 0) {
        } else {
            return false;
        }
    }

    private function make_as($value) {
        $as_operation = '';
        $this->as_op = '';
        $pattern = '/[[:space:]](AS|As|aS|as)[[:space:]]/';
        if (preg_match($pattern, $value)) {
            $as_op = preg_split($pattern, $value);
            if (count($as_op) == 2) {
                if ($as_op[1] != '' && $as_op[0] != '') {
                    $this->as_op = $as_op[0];
                    $as_operation = 'As ' . $this->makeFiled($as_op[1]);
                }
            }
        }
        return $as_operation;
    }

}

?>