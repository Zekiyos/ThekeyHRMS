<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class XL extends db_config {

    public function get_Attendance_Allocation_list() {
        /* Selecting only those in the same month and half year worker employee */
        $queryOT = "SHOW TABLES FROM `thekeyhrmsdb`";

        $resultOT = mysql_query($queryOT);

        echo "<select id=\"TableName\" >";
        echo "<option>----Select Table----</option>";
       
        while ($rowOT = mysql_fetch_array($resultOT, MYSQL_ASSOC)) {

            echo "<option value=\"{$rowOT['Tables_in_thekeyhrmsdb']}\">";

            $year_month = strtoupper($rowOT['Tables_in_thekeyhrmsdb']);

            echo "$year_month</option>";
        }

        echo "</select>";
    }

    public function XL_export($databasetable, $csvfile) {


        //$databasetable = "department";

        $fieldseparator = ",";
        $lineseparator = "\n";
        // $csvfile = "C:\department.csv";
        /*         * ***************************************************************************************** */
        /* Would you like to add an ampty field at the beginning of these records?
          /* This is useful if you have a table with the first field being an auto_increment integer
          /* and the csv file does not have such as empty field before the records.
          /* Set 1 for yes and 0 for no. ATTENTION: don't set to 1 if you are not sure.
          /* This can dump data in the wrong fields if this extra field does not exist in the table
          /******************************************************************************************* */
        $addauto = 0;
        /*         * ***************************************************************************************** */
        /* Would you like to save the mysql queries in a file? If yes set $save to 1.
          /* Permission on the file should be set to 777. Either upload a sample file through ftp and
          /* change the permissions, or execute at the prompt: touch output.sql && chmod 777 output.sql
          /******************************************************************************************* */
        $save = 1;
        $outputfile = "output.sql";
        /*         * ***************************************************************************************** */
        if (!file_exists($csvfile)) {
            echo "File not found. Make sure you specified the correct path.\n";
            exit;
        }
        $file = fopen($csvfile, "r");
        if (!$file) {
            echo "Error opening data file.\n";
            exit;
        }
        $size = filesize($csvfile);
        if (!$size) {
            echo "File is empty.\n";
            exit;
        }
        $csvcontent = fread($file, $size);
        fclose($file);

        $lines = 0;
        $queries = "";
        $linearray = array();
        foreach (split($lineseparator, $csvcontent) as $line) {
            $lines++;
            $line = trim($line, " \t");
            $line = str_replace("\r", "", $line);
            /*             * **********************************************************************************************************
              This line escapes the special character. remove it if entries are already escaped in the csv file
             * ********************************************************************************************************** */
            $line = str_replace("'", "\'", $line);
            /*             * ******************************************************************************************************** */
            $linearray = explode($fieldseparator, $line);
            $linemysql = implode("','", $linearray);
            if ($addauto)
                $query = "insert into $databasetable values('','$linemysql');";
            else
                $query = "insert into $databasetable values('$linemysql');";
            $queries .= $query . "\n";
            @mysql_query($query);
        }

        if ($save) {
            if (!is_writable($outputfile)) {
                echo "File is not writable, check permissions.\n";
            } else {
                $file2 = fopen($outputfile, "w");
                if (!$file2) {
                    echo "Error writing to the output file.\n";
                } else {
                    fwrite($file2, $queries);
                    fclose($file2);
                }
            }
        }
        echo "Found a total of $lines records in this csv file.\n";
    }

}

?>
