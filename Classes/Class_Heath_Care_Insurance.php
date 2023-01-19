<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Health_Care_Insurance {
    
    
    
    public function TotalUsedCost($ID) {
        if (mysql_num_rows(mysql_query("SELECT `ID` , `FirstName` , `MiddelName` , `LastName` , `Department` , SUM( `Treatment_Cost` ) AS TotalUsedTreatment_Cost
FROM `Health_Care_Insurance`
 WHERE ID='" . $ID . "' GROUP BY ID"))) {

            $queryTotalHC = "SELECT `ID` , `FirstName` , `MiddelName` , `LastName` , `Department` , SUM( `Treatment_Cost` ) AS TotalUsedTreatment_Cost
FROM `Health_Care_Insurance`
 WHERE ID='" . $ID . "' GROUP BY ID";
            
            $resultTotalHC = mysql_query($queryTotalHC);
            $rowTotalHC = mysql_fetch_array($resultTotalHC);
            $TotalUsedTreatment_Cost = $rowTotalHC['TotalUsedTreatment_Cost']; //total leave taken before
            
            return $TotalUsedTreatment_Cost;
        } else {
            $TotalUsedTreatment_Cost = 0;
            return $TotalUsedTreatment_Cost;
        }
    }
    
    
    public function get_Health_Care_Insurance_Amount($ID) {
        $queryHC = "SELECT *
FROM `employee_personal_record` where ID='".$ID."'";
        if (mysql_num_rows(mysql_query($queryHC))) {
            $resultHC = mysql_query($queryHC);

            $rowHC = mysql_fetch_array($resultHC);

            $Salary = $rowHC['Salary'];

          $queryAM ="SELECT *
FROM `health_care_insurance_Definition` where From_Basic_Salary <= $Salary and To_Basic_Salary >= $Salary";
            
          if (mysql_num_rows(mysql_query($queryAM))) {
              
          
           $resultAM = mysql_query($queryAM);

            $rowAM = mysql_fetch_array($resultAM);

            $Insurance_Amount = $rowAM['Insurance_Amount'];
            
            $Amount_Type= $rowAM['Amount_Type'];
            if($Amount_Type=='Percent'){
                $Insurance_Amount=$Salary*$rowAM['Insurance_Amount']/100;
            }
         
          
            return $Insurance_Amount; 
            
            }
        }
        else
            return false;
    }
    
    public function CHK_Health_Care_Insurance($ID){
        
        $TotalUsedTreatment_Cost=$this->TotalUsedCost($ID);
        $Insurance_Amount=$this->get_Health_Care_Insurance_Amount($ID);
        
        $Total_Unused_Cost= $Insurance_Amount-$TotalUsedTreatment_Cost;
        
        if($Total_Unused_Cost>0){
       
        return $Total_Unused_Cost.'<br/>';
        }
        else
            return false;
    }

    
}

?>
