<?php require_once('../Connections/HRMS.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Untitled Document</title>
    </head>

    <body>
        <input type="button" value="Generate ID" onclick="generateid()"/>

        <?php
        $base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
        $filename = $base_path . 'Recruitment/LastID.txt';
        if (file_exists($filename)) {

            $fd = fopen($filename, "r+") or die("Can't open file $filename");
            $fstring = fread($fd, filesize($filename));

//$fstring2=$fstring+1;
            fclose($fd);

//$fd2 = fopen($filename, "w+") or die("Can't open file $filename");
//$fout = fwrite($fd2, $fstring2);
//fclose($fd2);

            $initial = $fstring;


            $sqlCS = "SELECT ID_Number_Initial_Character,Maximum_Allowed_ID_Number FROM company_settings";

            $resultCS = mysql_query($sqlCS) or die(mysql_error());

            $rowCS = mysql_fetch_array($resultCS);
            $Maximum_Allowed_ID_Number = $rowCS['Maximum_Allowed_ID_Number'];
            $ID_Number_Initial_Character = $rowCS['ID_Number_Initial_Character'];


            if ($initial > $Maximum_Allowed_ID_Number)
                echo "<script type=\"text/javascript\"> alert('Last ID number($initial) exceed out of the maximaum allowed ID Number($Maximum_Allowed_ID_Number).Contact Thekeysoft System Developer to change the maximaum allowed ID Number.'); </script>";
            else {
                $ID_Leading_Zero = "";

                $Leading_Zero = (strlen($Maximum_Allowed_ID_Number) - strlen($initial));


                for ($ID_Digit = 1; $ID_Digit <= $Leading_Zero; $ID_Digit++) {
                    $ID_Leading_Zero.="0";
                }
                $ID = $ID_Number_Initial_Character . "-" . $ID_Leading_Zero . $initial;

                echo "ID :" . $ID;
            }
        }
        else
            echo "<script type=\"text/javascript\"> alert('Last ID Number text file is not exist.Write Last ID Number on the notepad and save in the Recruitment folder as LastID.txt'); </script>";

//$initial=$initial+1+1;
//$ID="AQ-".$initial;
//echo "ID".$ID;


        function generateid() {
            $initial = 0000;

            $initial = $initial + 1;
            $ID = "AQ-00" . $initial;
            echo "id" . $ID;

            echo "<script type=\"text/javascript\"> alert({$ID}); </script>";
        }
        ?>
    </body>
</html>