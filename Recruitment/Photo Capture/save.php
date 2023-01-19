<?php

require_once('../../Connections/HRMS.php');
if (isset($GLOBALS["HTTP_RAW_POST_DATA"])) {

    $img_Name = $_GET["ID"];
    $jpg = $GLOBALS["HTTP_RAW_POST_DATA"];
    $img = $_GET["img"];
    $filename = "../LastID.txt";
    if (file_exists($filename)) {

        $fd = fopen($filename, "r+") or die("Can't open file $filename");
        $fstring = fread($fd, filesize($filename));

        fclose($fd);


        $initial = $fstring;

        $sqlCS = "SELECT ID_Number_Initial_Character,Maximum_Allowed_ID_Number FROM company_settings";

        $resultCS = mysql_query($sqlCS) or die(mysql_error());

        $rowCS = mysql_fetch_array($resultCS);
        $Maximum_Allowed_ID_Number = $rowCS['Maximum_Allowed_ID_Number'];
        $ID_Number_Initial_Character = $rowCS['ID_Number_Initial_Character'];


        if ($initial > $Maximum_Allowed_ID_Number) {
            echo "<script type=\"text/javascript\"> alert('Last ID number($initial) exceed out of the maximaum allowed ID Number($Maximum_Allowed_ID_Number).Contact Thekeysoft System Developer to change the maximaum allowed ID Number.'); </script>";
        } else {
            $ID_Leading_Zero = "";

            $Leading_Zero = (strlen($Maximum_Allowed_ID_Number) - strlen($initial));


            for ($ID_Digit = 1; $ID_Digit <= $Leading_Zero; $ID_Digit++) {
                $ID_Leading_Zero.="0";
            }
            $ID = $ID_Number_Initial_Character . "-" . $ID_Leading_Zero . $initial;

            $filename = "../../Employee_Images/" . $ID . ".JPG";
        }
    }
    else
        echo "<script type=\"text/javascript\"> alert('Last ID Number text file is not exist.Write Last ID Number on the notepad and save in the Recruitment folder as LastID.txt'); </script>";
    file_put_contents($filename, $jpg);
} else {
    echo "Encoded JPEG information not received.";
}
?>