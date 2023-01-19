<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Report {

    public function get_Report_Defintion($reportName) {

        $sqlrpt = "SELECT * FROM  thekey_hrms_report_definition WHERE Report_Name='" . $reportName . "'";

        $resultrpt = mysql_query($sqlrpt) or die(mysql_error());

        $rowrpt = mysql_fetch_array($resultrpt);

        $Report_Name = $rowrpt['Report_Name'];

        $Report_Description = $rowrpt['Report_Description'];

        $Report_Field = $rowrpt['Report_Field'];

        $Report_Field_Display_Name = $rowrpt['Report_Field_Display_Name'];

        $Table_Name = $rowrpt['Table_Name'];

        $Join_Table = $rowrpt['Join_Table'];

        $Where_Clause = $rowrpt['Where_Clause'];
        $User_Feed_Parameter = $rowrpt['User_Feed_Parameter'];

        return array($Report_Name, $Report_Description, $Report_Field, $Report_Field_Display_Name, $Table_Name, $Join_Table, $Where_Clause, $User_Feed_Parameter);
    }

    public function generate_report($reportName) {

        //  $reportName = 'Employee Personal Record';

        list($reportName, $reportDescription, $Report_Field, $Report_Field_Display_Name, $tableName, $Join_Table, $whereClause, $User_Feed_Parameter) = $this->get_Report_Defintion($reportName);

        if (strtoupper($tableName) != 'USER_DEFINED_REPORT') {

            $reportField = explode(',', $Report_Field);

            $reportFieldDisplayName = explode(',', $Report_Field_Display_Name);

            $joinTable = $Join_Table;



            if (isset($_POST['DisplayFieldName'])) {
                $displayFieldName = $_POST['DisplayFieldName'];
            } else {
                $displayFieldName = $reportField;
            }

            if (isset($reportField)) {

                $sql = "SELECT ";

                foreach ($reportField as $fieldNamekey => $fieldNamevalue) {

                    if (in_array($fieldNamevalue, $displayFieldName)) {
                        if (($fieldNamekey == 0) ||
                                ((( array_search($reportFieldDisplayName[$fieldNamekey], $displayFieldName)) == 0) && (count($displayFieldName) == 1))
                        ) {

                            //this whole junk is for department display only case check it out

                            $sql = $sql . ' ' . $fieldNamevalue . ' AS "' . $reportFieldDisplayName[$fieldNamekey] . '"';
                        } else {

                            $sql = $sql . ' ,' . $fieldNamevalue . ' AS "' . $reportFieldDisplayName[$fieldNamekey] . '"';
                        }
                    }
                }


                /*                 * **************Appending Aggregate Function****************** */

                if ((isset($_POST['CountFieldName'])) or
                        (isset($_POST['CountDistinctFieldName'])) or
                        (isset($_POST['SumFieldName']))) {

                    $sql = "SELECT ";
                    if (isset($_POST['GroupBy'])) {
                        $groupBy = $_POST['GroupBy'];

                        foreach ($groupBy as $groupBykey => $groupByvalue) {
                            if ($groupBykey == 0) {
                                $sql = $sql . ' ' . $groupByvalue;
                            } else {
                                $sql = $sql . ' ,' . $groupByvalue; //Append comma if not first value
                            }
                        }
                    }
                }


                if (isset($_POST['CountFieldName'])) {
                    $countFieldName = $_POST['CountFieldName'];

                    $sql = $sql . ' ,' . $this->generate_aggregate_value('COUNT', $countFieldName);
                }

                if (isset($_POST['CountDistinctFieldName'])) {
                    $countDistnictFieldName = $_POST['CountDistinctFieldName'];

                    $sql = $sql . ' ,' . $this->generate_aggregate_value('COUNT(DISTINCT)', $countDistnictFieldName);
                }

                if (isset($_POST['SumFieldName'])) {
                    $sumFieldName = $_POST['SumFieldName'];
                    $sql = $sql . ' ,' . $this->generate_aggregate_value('SUM', $sumFieldName);
                }

                /*                 * ***********End of Aggregate Function ******************* */


                $sql = $sql . ' FROM ' . $tableName;


                if (isset($joinTable)) { //if join table is set it appened on the query
                    // foreach ($joinTable as $joinTablekey => $joinTablevalue) {
                    $sql = $sql . ' ' . $joinTable;
                    //  }
                }
            }

            /*             * ********** Filter Option ************** */

            /***** Filter Terminated employee*****/
            $sql = $sql . " WHERE ($tableName.ID NOT IN (SELECT ID FROM terminated_employee)) ";
            
            if (isset($whereClause)) {

                if ($whereClause != '')
                    $sql = $sql . ' AND (' . $whereClause . ') ';
                //else
                  //  $sql = $sql . ' WHERE ';
            }

            if (isset($_POST['FilterField'])) {

                $filterFieldName = $_POST['FilterField'];
                $filterOperator = $_POST['FilterOperator'];
                $filterValue = $_POST['FilterValue'];
                $filterLogicalOperator = $_POST['FilterLogicalOperator'];

                $sql = $this->filterQuery($sql, $filterFieldName, $filterOperator, $filterValue, $filterLogicalOperator);
            }
            
            //else
               // $sql.=' 1 ';

            /*             * ***************** End of Filter Option ************* */
            // echo '<hr>'.$sql;


            /*             * ******************* Appending Group By ********** */
            if (isset($_POST['GroupBy'])) {

                $groupBy = $_POST['GroupBy'];

                $sql = $sql . ' GROUP BY ';

                foreach ($groupBy as $groupBykey => $groupByvalue) {
                    if ($groupBykey == 0) {
                        $sql = $sql . ' ' . $groupByvalue;
                    } else {
                        $sql = $sql . ' ,' . $groupByvalue; //Append comma if not first value
                    }
                }
            }
            /*             * **** End of Group By ******** */
        } else {
            //user defined Report
            $sql = $Report_Field;
        }



        //Filtering by parameter enerting from user feed
        if ($User_Feed_Parameter != '') {
            $userFeedParameter = explode(',', $User_Feed_Parameter);
            $countParameter = 0;
            foreach ($userFeedParameter as $key => $userFeedParameterValue) {
                $countParameter++;
                $userParameterValue = explode('=', $userFeedParameterValue);

                $parameterValue = "'" . $_GET[$userParameterValue[0]] . "'";

                $parameters = 'rptparameter' . $countParameter;

                $sql = preg_replace('/' . $parameters . '/', $parameterValue, $sql);
            }
        }

        //End of Parmater filtering
     
	 //echo '<hr>'.$sql;

        /*         * ***************** Record Limit ************** */

        $totalRecords = mysql_num_rows(mysql_query($sql));


        /*         * ********************************* */

        $currentPage = $_SERVER["PHP_SELF"];

        if (isset($_GET['totalRows'])) {
            $totalRows = $_GET['totalRows'];
        } else {

            $result = mysql_query($sql);
            $totalRows = mysql_num_rows($result);
        }

        if (isset($_GET['pageNo'])) {
            $pageNo = $_GET['pageNo'];
        } else {
            $pageNo = 0;
        }

        if (isset($_GET['NO_Record'])) {
            $maxRows = $_GET['NO_Record'];
        } else {
            $maxRows = 10;
        }



        $startRow = $pageNo * $maxRows;

        if ($startRow >= $totalRows) { //if start row greater than total rows set to zero
            $startRow = 0;
            $pageNo = 0;
        }


        if (!(isset($_GET['Export'])))
            $_SESSION['reportSql'] = $sql;



        if (count($_POST) > 0) { //assign start row if there is any post filter or aggregate value
            $startRow = 0;
        }


        if ($startRow == 0) {   //puting sql with its filter value in session at the first instance to naviage to the filter query 
            $_SESSION['Sql'] = $sql;
            $sql = $sql . ' LIMIT ' . $startRow . ',' . $maxRows;
        } else {
            //navigating on session stored query 

            $sql = $_SESSION['Sql'] . ' LIMIT ' . $startRow . ',' . $maxRows;
        }

        // echo $sql . '<hr>' . $_SESSION['reportSql'];

        $result = mysql_query($sql) or die(mysql_error());

        $totalPages = ceil($totalRows / $maxRows) - 1;

        $queryString = "";
        if (!empty($_SERVER['QUERY_STRING'])) {
            $params = explode("&", $_SERVER['QUERY_STRING']);
            $newParams = array();
            foreach ($params as $param) {
                if (stristr($param, "pageNo") == false &&
                        stristr($param, "totalRows") == false) {
                    array_push($newParams, $param);
                }
            }
            if (count($newParams) != 0) {
                $queryString = "&" . htmlentities(implode("&", $newParams));
            }
        }

        $queryString = "&totalRows=" . $totalRows . $queryString;

        /*         * ************************** */

        /*         * *******  End Of Record Limit ******* */




        $numrows = mysql_numrows($result);


        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

            $arrayrow[] = $row;
        }

        if (isset($arrayrow)) {
            $this->generate_table($arrayrow);

            $this->paging($currentPage, $pageNo, $totalPages, $queryString, $totalRecords);
        }
    }

    public function filterQuery($sql, $filterFieldName, $filterOperator, $filterValue, $filterLogicalOperator) {
        /*         * ********** Filter Option ************** */
        $filterValueNull = TRUE;

        foreach ($filterFieldName as $key => $filterFieldNamevalue) {

            if (trim($filterValue[$key]) != '') {

                $filterValueNull = FALSE;

                $sql = $sql . ' AND ' . trim($filterFieldNamevalue) . ' ' . $filterOperator[$key];


                if ($filterOperator[$key] == "LIKE") { //Appending % value on LIKE Operator word to filter all it has contain
                    $sql = $sql . ' "%' . trim($filterValue[$key]) . '%" ';
                } else
                if ($filterOperator[$key] == "BETWEEN") { //Appending % value on LIKE Operator word to filter all it has contain
                    $filterBetweenFiled = explode('AND', $filterValue[$key]);

                    $filterBetweenFiled1 = trim($filterBetweenFiled[0]);
                    $filterBetweenFiled2 = trim($filterBetweenFiled[1]);

                    $sql = $sql . ' "' . $filterBetweenFiled1 . '" AND "' . $filterBetweenFiled2 . '"';
                }
                else
                    $sql = $sql . ' "' . trim($filterValue[$key]) . '"';


                if (($key != (count($filterFieldName) - 1)) && isset($filterLogicalOperator))  //Appending LOgical Operator value if it is not the last filter field
                    $sql = $sql . ' ' . $filterLogicalOperator[$key] . ' ';
            }
        }

        $sql = trim($sql, ' AND '); //trim operator from last postion of the query
        $sql = trim($sql, ' OR ');

        if (($filterValueNull == TRUE) && (substr($sql, -5) == 'WHERE' )) {

            $sql = $sql . ' 1';
        }

        return $sql;
        /*         * ***************** End of Filter Option ************* */
    }

    public function generate_table($arrayData) {

        echo '<table class="ThekeyHRMS_rpt" id="ThekeyHRMS_rpt" >';

        echo '<thead>';
        echo '<tr>';
        echo '<th> S.No </th>';
        foreach ($arrayData as $arrayDatakey => $arrayDataValue) {
            foreach ($arrayDataValue as $key => $value) {
                if ($arrayDatakey == 0)
                    echo '<th>' . $key . '</th>';
            }
        }
        echo '</tr>';
        echo '</thead>';

        if (isset($_GET['pageNo'])) {
            if (isset($_GET['NO_Record'])) {
                $startRow = $_GET['pageNo'] * $_GET['NO_Record'];
            }else
                $startRow = $_GET['pageNo'] * 10;

            if ($startRow >= $_GET['totalRows']) //if start row greater than total rows set to zero
                $startRow = 0;


            $serialNo = $startRow + 1;
        } else {
            $serialNo = 1;
        }

        echo '<tbody>';
        foreach ($arrayData as $arrayDatakey => $arrayDataValue) {

            echo '<tr>';

            echo '<td>';
            echo $serialNo++;
            echo'</td>';

            foreach ($arrayDataValue as $key => $value) {

                echo '<td>' . $value . '</td>';
            }
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    }

    public function paging($currentPage, $pageNo, $totalPages, $queryString, $totalRows = NULL) {

        echo '<table id="Pagination" align="right" >';
        echo '<tr>';
        echo '<td>';
        if ($pageNo > 0) { // Show if not first page 
            echo '<a  href="' . $currentPage . '?pageNo=0' . $queryString . '">
                <img src="../images/go_first.png" alt="Go First" title="Go First"></a>';
        } // Show if not first page  
        echo '</td>';
        echo '<td>';
        if ($pageNo > 0) { // Show if not first page 
            echo '<a href="' . $currentPage . '?pageNo=' . max(0, $pageNo - 1) . $queryString . '">
                <img src="../images/go_Previous.PNG" alt="Go Previous" title="Go Previous" ></a>';
        } // Show if not first page  
        echo '</td>';
        echo '<td>';
        if ($pageNo < $totalPages) { // Show if not last page 
            echo '<a href="' . $currentPage . '?pageNo=' . max(0, $pageNo + 1) . $queryString . '">
                <img src="../images/go_Next.PNG" alt="Go Next" title="Go Next" ></a>';
        } // Show if not last page  
        echo '</td>';
        echo '<td>';
        if ($pageNo < $totalPages) { // Show if not last page 
            echo '<a href="' . $currentPage . '?pageNo=' . $totalPages . $queryString . '">
                <img src="../images/go_Last.PNG" alt="Go Last" title="Go Last"></a>';
        } // Show if not last page  
        echo '</td>';
        echo '<td align="center">';

//        $queryStringArray = explode('&', $queryString);
//
//        $totalRows = substr($queryStringArray[1], 10);
//        
        echo '<b>Total Rows: ' . $totalRows . '</b>';
        echo '</td>';

        echo '<td align="right">';

        $No_Record = array(5, 10, 15, 20, 30, 40, 50, 60, 100, 200, 300, 500, 1000, 1500, 2000, 3000, 5000, 10000, intval($totalRows));

        if ($No_Record[0] <= intval($totalRows)) {
            echo ' Record Per Page:';
            echo '<Select ID="NO_Record" Name="NO_Record" onchange="updateQueryStringParameter(\'NO_Record\')" >';
            echo '<option value="50"></option>';

            foreach ($No_Record as $key => $value) {
                if ($value < intval($totalRows)) {
                    echo '<option value="' . $No_Record[$key] . '">' . $No_Record[$key] . '</option>';
                } else
                if ($value == intval($totalRows)) {
                    echo '<option value="' . $value . '"> ALL </option>';
                }
            }
            echo '</select>';
        }


        echo '</td>';
        echo '</tr>';
        echo '</table>';
    }

    public function generate_aggregate_value($aggregateFunction, $aggFieldName) {

        $sql = " ";

        foreach ($aggFieldName as $aggFieldNamekey => $aggFieldNamevalue) {
            if ($aggregateFunction == 'COUNT(DISTINCT)') {
                //if aggregate not equal to the first agg function Group By 

                $sql = $sql . ' ' . ' COUNT(DISTINCT ' . $aggFieldNamevalue . ' ) AS  " Unique No. Of ' . $aggFieldNamevalue . '"';
            } else {

                $sql = $sql . ' ' . $aggregateFunction . '(' . $aggFieldNamevalue . ') AS "';
                if ($aggregateFunction == 'COUNT')
                    $sql = $sql . ' No. Of' . $aggFieldNamevalue . '"';
                else
                    $sql = $sql . 'Total Sum Of ' . $aggFieldNamevalue . '"';
            }

            if ($aggFieldNamekey != (COUNT($aggFieldName) - 1)) {
                $sql = $sql . ',';
            }
        }

        return $sql;
    }

    public function show_table_list() {

        $sql = "SHOW TABLES FROM `thekeyhrmsdb`";

        $result = mysql_query($sql);

        echo "<option> Select Table </option>";
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

            echo "<option value='" . (strtoupper($row['Tables_in_thekeyhrmsdb'])) . "'>" . (strtoupper($row['Tables_in_thekeyhrmsdb'])) . "</option>";
        }
    }

    public function get_User_Defined_Report() {

        $sql = "SELECT * FROM thekey_hrms_report_definition WHERE Table_Name='USER_DEFINED_REPORT'";
        $result = mysql_query($sql);
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            echo "<option value='" . (ucfirst($row['Report_Name'])) . "'>" . (ucfirst($row['Report_Name'])) . "</option>";
        }
    }

    public function create_User_Defined_Report($reportName, $reportDescription, $reportSql) {
        $sql = "INSERT INTO  thekey_hrms_report_definition (Report_Name,Report_Description,Report_Field,Table_Name)
            values ('" . $reportName . "','" . $reportDescription . "','" . $reportSql . "','USER_DEFINED_REPORT')";

        $result = mysql_query($sql);
        return $result;
    }

    public function cleanData(&$str) {

        //escape tab characters
        $str = preg_replace("/\t/", "\\t", $str);
        // escape new lines
        $str = preg_replace("/\r?\n/", "\\n", $str);
//convert 't' and 'f' to boolean values 
        if ($str == 't')
            $str = 'TRUE';
        if ($str == 'f')
            $str = 'FALSE';
//force certain number/date formats to be imported as strings
//
//    if (preg_match("/^0/", $str) || preg_match("/^\+?\d{8,}$/", $str) || preg_match("/^\d{4}.\d{1,2}.\d{1,2}/", $str)) {
//        $str = "'$str";
//    }
//    
//escape fields that include double quotes 
        if (strstr($str, '"'))
            $str = '"' . str_replace('"', '""', $str) . '"';
    }

//// filename for download
    public function XL_Export($sql, $filename) {

        ob_clean();
        $filename = $filename . date('Ymd') . ".xls";
        header("Content-Disposition: attachment;filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");
        $flag = false;
        $result = mysql_query($sql) or die('Query failed!');
        while (false != ($row = mysql_fetch_assoc($result))) {
            if (!$flag) {
                // display field/column names as first row
                echo implode("\t", array_keys($row)) . "\r\n";
                $flag = true;
            }
            array_walk($row, array($this, 'cleanData'));
            echo implode("\t", array_values($row)) . "\r\n";
        }
        exit;
    }

}

?>
