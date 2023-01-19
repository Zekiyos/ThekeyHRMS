
       <?php

       /*
        * To change this template, choose Tools | Templates
        * and open the template in the editor.
        */

       Class DB_Relationship extends db_config {

           public function get_Table_list() {
               /* Selecting only those in the same month and half year worker employee */
               $queryOT = "SHOW TABLES FROM `thekeyhrmsdb`";

               $resultOT = mysql_query($queryOT);
               echo "<table align=\"center\">";
               echo '<tr>';
               echo '<td>';
               echo "<select id=\"Tables_in_thekeyhrmsdb\" name=\"Tables_in_thekeyhrmsdb[]\" multiple=\"multiple\" size=\"20\">";


               while ($rowOT = mysql_fetch_array($resultOT, MYSQL_ASSOC)) {

                   echo "<option value=\"{$rowOT['Tables_in_thekeyhrmsdb']}\">{$rowOT['Tables_in_thekeyhrmsdb']}</option>";
               }

               echo "</select>";

               echo '</td>';
               echo '</tr>';
               echo '</table>';
           }

           public function add_foreign_key($TableName,$FromTable) {
               
               $sql6="ALTER TABLE $TableName DROP INDEX `Department` ";
               $sql5="ALTER TABLE $TableName ADD INDEX ( `Department` )";
               
               $sql1 = "ALTER TABLE $TableName DROP FOREIGN KEY department_'" . $TableName . "'";
               $sql2 = "ALTER TABLE $TableName ADD FOREIGN KEY ( `Department` ) REFERENCES `thekeyhrmsdb`.`department` (
`Department`
) ON DELETE RESTRICT ON UPDATE CASCADE";
               
              

               $sql3 = "ALTER TABLE $TableName DROP FOREIGN KEY '".$FromTable."'_'" . $TableName . "'";
               $sql4 = "ALTER TABLE $TableName ADD FOREIGN KEY ( `ID` ) REFERENCES $FromTable (
`ID`
) ON DELETE CASCADE ON UPDATE CASCADE";
               
               
               
               
//               echo '<hr>1'.$sql1;
//               echo '<hr>2'.$sql2;
//               echo '<hr>3'.$sql3;
//               echo '<hr>4'.$sql4;
//               echo '<hr>5'.$sql5;
//               echo '<hr>6'.$sql6;

               mysql_query($sql6);
               
               mysql_query($sql5);
               
               mysql_query($sql1);
              $result1=mysql_query($sql2);
               mysql_query($sql3);
               mysql_query($sql4);
               
               
               return $result1;
           }

       }
       ?>
