<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Class_Chart
 *
 * @author Zekiyos
 */
//include("../Report/Chart/FusionCharts.php");

class Chart {

    //put your code here


    public function getChartType($series) {

        $chartTypeSingleSeries = array('Column3D',
            'Column2D',
            'Line',
            'Area2D',
            'Bar2D',
            'Pie2D',
            'Pie3D',
            'Doughnut2D',
            'Candlestick',
            'Funnel',
            'Gantt');

        $chartTypeMultiSeries = array('MSColumn2D',
            'MSColumn3D',
            'MSLine',
            'MSBar2D',
            'MSArea2D',
            'StackedColumn3D',
            'StackedColumn2D',
            'StackedBar2D',
            'StackedArea2D',
            'MSColumn2DLineDY',
            'MSColumn3DLineDY');

        $chartTypeNameSingleSeries = array('Column 3D',
            'Column 2D',
            'Line 2D',
            'Area 2D',
            'Bar 2D',
            'Pie 2D',
            'Pie 3D',
            'Doughnut 2D',
            'Candlestick Chart',
            'Funnel Chart',
            'Gantt Chart');

        $chartTypeNameMultiSeries = array(
            'Multi-series Column 2D',
            'Multi-series Column 3D',
            'Multi-series Line 2D',
            'Multi-series Bar 2D',
            'Multi-series Area 2D',
            'Stacked Column 3D',
            'Stacked Column 2D',
            'Stacked Bar 2D',
            'Stacked Area 2D',
            'Multi-series Column 2D + Line - Dual Y Axis',
            'Multi-series Column 3D + Line - Dual Y Axis');

        if ($series == 'Single') {
            $chartType = $chartTypeSingleSeries;
            $chartTypeName = $chartTypeNameSingleSeries;
        } else
        if ($series == 'Multi') {
            $chartType = $chartTypeMultiSeries;
            $chartTypeName = $chartTypeNameMultiSeries;
        }

        foreach ($chartType as $key => $value) {
            echo '<option value="' . $value . '">' . $chartTypeName[$key] . '</option>' . "\n";
        }
    }

    public function get_Y_xis_Summary_Value() {

        $Y_axis_Summary_Value = array('SUM', 'COUNT', 'AVG', 'MAX', 'MIN');
        foreach ($Y_axis_Summary_Value as $key => $value) {
            echo '<option value="' . $value . '">' . $value . '</option>' . "\n";
        }
    }

    public function createChart($Chart_Name, $Chart_Caption, $Chart_Type, $X_axis_Title, $X_axis_Category_Field, $Y_axis_Title, $Y_axis_Summary_Field, $Y_axis_Summary_Value, $Table_Name, $Join_Table) {

        $sql = "INSERT INTO  thekey_hrms_Chart_definition (Chart_Name, Chart_Caption, Chart_Type, X_axis_Title,
            X_axis_Category_Field, Y_axis_Title, Y_axis_Summary_Field,
            Y_axis_Summary_Value,Table_Name, Join_Table)
            values ('" . $Chart_Name . "','" . $Chart_Caption . "','" . $Chart_Type . "','" . $X_axis_Title . "','" .
                $X_axis_Category_Field . "','" . $Y_axis_Title . "','" . $Y_axis_Summary_Field . "','" .
                $Y_axis_Summary_Value . "','" . $Table_Name . "','" . $Join_Table . "')";

        $result = mysql_query($sql);
        return $result;
    }

    public function get_Chart_Defintion($chartName) {

        $sql = "SELECT * FROM  thekey_hrms_chart_definition WHERE chart_Name='" . $chartName . "'";

        $result = mysql_query($sql) or die(mysql_error());

        $row = mysql_fetch_array($result);

        $Chart_Name = $row['Chart_Name'];

        $Chart_Caption = $row['Chart_Caption'];

        $Chart_Type = $row['Chart_Type'];

        $X_axis_Title = $row['X_axis_Title'];
        $X_axis_Category_Field = $row['X_axis_Category_Field'];

        $Y_axis_Title = $row['Y_axis_Title'];
        $Y_axis_Summary_Field = $row['Y_axis_Summary_Field'];
        $Y_axis_Summary_Value = $row['Y_axis_Summary_Value'];

        $Series_Field_Summary = $row['Series_Field_Summary'];
        $Series_Field = $row['Series_Field'];

        $Table_Name = $row['Table_Name'];



        $Join_Table = $row['Join_Table'];
        $Where_Clause = $row['Where_Clause'];

        return array($Chart_Name, $Chart_Caption, $Chart_Type, $X_axis_Title,
            $X_axis_Category_Field, $Y_axis_Title, $Y_axis_Summary_Field,
            $Y_axis_Summary_Value, $Series_Field_Summary, $Series_Field, $Table_Name, $Join_Table, $Where_Clause);
    }

    public function generate_Chart($chartName, $chartWidth, $chartHeight, $showNames, $chartType = NULL, $chartSplit = 1) {

        list($Chart_Name, $Chart_Caption, $Chart_Type, $X_axis_Title,
                $X_axis_Category_Field, $Y_axis_Title, $Y_axis_Summary_Field,
                $Y_axis_Summary_Value, $Series_Field_Summary, $Series_Field, $Table_Name, $Join_Table) = $this->get_Chart_Defintion($chartName);
//numberSuffix=' Employee'

        $chartColor = array('AFD8F8', 'F6BD0F', '8BBA00', 'FF8E46', '008E8E', 'D64646', '8E468E', '588526', 'B3AA00', '008ED6', '9D080D', 'A186BE');

        if (isset($_POST['FilterField'])) {

            $filterFieldName = $_POST['FilterField'];

            $filterOperator = $_POST['FilterOperator'];

            $filterValue = $_POST['FilterValue'];

            $filterLogicalOperator = $_POST['FilterLogicalOperator'];
        }

        $strXML = "<graph caption='" . $Chart_Caption . "' subCaption='' pieSliceDepth='40' showBorder='1' showNames='" . $showNames . "' formatNumberScale='0'  decimalPrecision='0'>";

        $strQuery = "SELECT DISTINCT  " . $X_axis_Category_Field . " AS " . $X_axis_Title . " FROM " . $Table_Name . " " . $Join_Table;

        //  echo $strQuery;
        // $strQuery = "select Department from Department";

        $result = mysql_query($strQuery) or die(mysql_error());

        $numRows = mysql_numrows($result);

        $i = 0;

        if ($result) {

            while ($ors = mysql_fetch_array($result)) {

                if ($i == 12)
                    $i = 0;

                $sql = "SELECT " . $X_axis_Category_Field . " AS " . $X_axis_Title;
                $sql .= "," . $Y_axis_Summary_Value . "(" . $Y_axis_Summary_Field . ") AS " . $Y_axis_Title;
                $sql .=" FROM " . $Table_Name . " " . $Join_Table;

                //  $strQuery = $sql . " WHERE " . $X_axis_Category_Field . "='" . $ors[$X_axis_Title] . "'";


                if (isset($_POST['FilterField'])) {
                    $sql = $this->filterQuery($sql, $filterFieldName, $filterOperator, $filterValue, $filterLogicalOperator);
                }

                $strQuery = $sql . " AND (" . $X_axis_Category_Field . "='" . $ors[$X_axis_Title] . "')";


                $result2 = mysql_query($strQuery) or die(mysql_error());
                $ors2 = mysql_fetch_array($result2);

                $X_axis_Title1 = $ors[$X_axis_Title];

                $strXML .= "<set name='" . $X_axis_Title1 . "' value='" . $ors2[$Y_axis_Title] . "' color='" . $chartColor[$i++] . "' />";
                mysql_free_result($result2);
            }
        }
        $strXML .= "</graph>";


        if ($chartType != NULL)
            $Chart_Type = $chartType;

        echo renderChart("Chart/Charts/" . $Chart_Type, "", $strXML, $Chart_Name . $numRows, $chartWidth, $chartHeight);
    }
 public function generate_Series_Chart($chartName, $chartWidth, $chartHeight, $showNames, $chartSplit = 1, $rotateNames = 0,$pathSWF=NULL) {

        list($Chart_Name, $Chart_Caption, $Chart_Type, $X_axis_Title,
                $X_axis_Category_Field, $Y_axis_Title, $Y_axis_Summary_Field,
                $Y_axis_Summary_Value, $Series_Field_Summary, $Series_Field, $Table_Name, $Join_Table, $Where_Clause) = $this->get_Chart_Defintion($chartName);


        if (isset($_POST['chartType']))
            $Chart_Type = $_POST['chartType'];

        if ((substr($Chart_Type, 0, 2) == 'MS' ) || (substr($Chart_Type, 0, 7) == 'Stacked' )) {
            $series = 'Multi';
        } else {
            $series = 'Single';
        }

        if (isset($_POST['FilterField'])) {
            $filterFieldName = $_POST['FilterField'];
            $filterOperator = $_POST['FilterOperator'];
            $filterValue = $_POST['FilterValue'];
            $filterLogicalOperator = $_POST['FilterLogicalOperator'];
        }

        if ($series == 'Single') {
            $sql = "SELECT " . $X_axis_Category_Field . " AS `" . $X_axis_Title;
            $sql .= "`," . $Y_axis_Summary_Value . "(" . $Y_axis_Summary_Field . ") AS `" . $Y_axis_Title . "`";
            $sql .=" FROM " . $Table_Name . " " . $Join_Table;
            if (isset($_POST['FilterField'])) {
                $sql = $this->filterQuery($sql, $filterFieldName, $filterOperator, $filterValue, $filterLogicalOperator);
            }
            $strQuery = $sql . ' GROUP BY ' . $X_axis_Title . ' ORDER BY ' . $X_axis_Title;
            $strQuery1 = $strQuery;
        } else {
            $strQuery = $Series_Field_Summary;
            $strQuery1 = $strQuery;
        }

        
        //Filter condition by parameter enerting from user feed
        if ($Where_Clause != '') {
            $whereCondition = explode(',', $Where_Clause);
            $countParameter=0;
            foreach ($whereCondition as $key => $whereConditionValue) {
                $countParameter++;
                $wherevalue = explode('=', $whereConditionValue);

                $parameterValue = "'".$_GET[$wherevalue[0]]."'";
    
                $parameters = 'parameter' . $countParameter;
   
                $strQuery2 = preg_replace('/' . $parameters . '/', $parameterValue, $strQuery1);
                
                $strQuery = $strQuery2;
                $strQuery1 = $strQuery2;
            }
         
        }

        //End of Parmater filtering
        if (!(isset($_GET['Export'])))
            $_SESSION['chartSql'] = $strQuery;

        //echo '<hr>'.$strQuery;

        $numRows = mysql_num_rows(mysql_query($strQuery));
        
        if($numRows==0){
            echo 'There is NO DATA to Display on the Chart of the Selected Parameter';
        }else
        if($numRows>0){
        $rowLimit = round($numRows / $chartSplit);



        for ($i = 1; $i <= $chartSplit; $i++) {

            $FC = new FusionCharts($Chart_Type, $chartWidth, $chartHeight);

            
            if($pathSWF==NULL)
            $pathSWF='Charts/';
            
            $FC->setSWFPath($pathSWF);
            
            $strParam = "caption=$Chart_Caption;subcaption=Comparison; rotateNames=$rotateNames; showNames=$showNames; pieSliceDepth=40; xAxisName=$X_axis_Title; yAxisName=$Y_axis_Title; numberPrefix=; decimalPrecision=0";
            $FC->setChartParams($strParam);

            if ($i == 1) {
                $rowStart = 0;
                $rowEnd = $rowLimit;
            }

            if (($rowEnd < $numRows) && ($i != 1)) {

                $rowStart+=$rowLimit;
                $rowEnd+=$rowLimit;
            }

            $strQuery = $strQuery1 . " LIMIT $rowStart,$rowEnd";

            // echo '<hr>'.$strQuery;

            if ($series == 'Multi') {
                $this->addCategories($FC, $strQuery, $X_axis_Category_Field);

                $Series_FieldArray = explode(',', $Series_Field);

                foreach ($Series_FieldArray as $key => $value) {
                    $this->addData($FC, $strQuery, $value);
                }
            } else {
                $result = mysql_query($strQuery);
                $FC->addDataFromDatabase($result, $Y_axis_Title, $X_axis_Title);
            }

            echo $Chart_Caption . ' Chart ';
            if($chartSplit>1)
            echo ':' . $i;
            
            $FC->renderChart();
        }
        }
    }

    public function generate_Series_Chart1($chartName, $chartWidth, $chartHeight, $showName, $chartSplit = 1, $rotateNames = 0,$pathSWF=NULL){
        $this->generate_Series_Chart($chartName, $chartWidth, $chartHeight, $showName, $chartSplit, $rotateNames, $pathSWF);
   
    }
            
            public function get_User_Defined_Chart() {

        $sql = "SELECT * FROM thekey_hrms_chart_definition"; // WHERE Table_Name='USER_DEFINED_REPORT'";
        $result = mysql_query($sql);
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            echo "<option value='" . (ucfirst($row['Chart_Name'])) . "'>" . (ucfirst($row['Chart_Name'])) . "</option>";
        }
    }

    public function addCategories($FC, $strQuery, $labelField) {
        $result = mysql_query($strQuery);
        if ($result) {
            while ($rows = mysql_fetch_array($result)) {
                $FC->addCategory($rows[$labelField]);
            }
        }
    }

    public function addData($FC, $strQuery, $labelField) {

        $result = mysql_query($strQuery);
        if ($result) {
            $FC->addDataset($labelField);
            while ($rows = mysql_fetch_array($result)) {
                $FC->addChartData($rows[$labelField]);
            }
        }
    }

    public function filterQuery($sql, $filterFieldName, $filterOperator, $filterValue, $filterLogicalOperator) {
        /*         * ********** Filter Option ************** */

        $sql = $sql . ' WHERE ';

        $filterValueNull = TRUE;

        foreach ($filterFieldName as $key => $filterFieldNamevalue) {

            if (trim($filterValue[$key]) != '') {

                $filterValueNull = FALSE;

                $sql = $sql . ' ' . trim($filterFieldNamevalue) . ' ' . $filterOperator[$key];


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

        if ($filterValueNull == TRUE) {

            $sql = $sql . ' 1';
        }

        return $sql;
        /*         * ***************** End of Filter Option ************* */
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
