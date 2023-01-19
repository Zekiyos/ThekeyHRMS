<?php

class Company_Settings {

    public function get_company_Settings() {
        $sqlCS = "SELECT `Company_Name`,`Annual_Leave_Expiry_Year`,`Annual_Leave _Initial_Days`,`Medical_Referral_Hospital_Email`,`Logo_Path`,`Equipment_Picture_Path`,`Web_Site`,`Company_P.O.BOX`,`Company_Country`,`Company_City`,`Company_Telphone`,`Company_Email`,`Company_Fax` FROM company_settings";

        $resultCS = mysql_query($sqlCS) or die(mysql_error());

        $rowCS = mysql_fetch_array($resultCS);

        $Equipment_Picture_Path = $rowCS['Equipment_Picture_Path'];
    }

}

?>