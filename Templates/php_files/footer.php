<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Untitled Document</title>
    </head>

    <body>
        <div id="footer">
            <p class="lf">&copy; Copyright ThekeyHRMS.Designed and Developed by <a href="http://www.thekey.com">Thekeysoft ICT Soultion</a> &nbsp;Licensed for 
                <?php
                $sqlCS = "SELECT `Company_Name`,`Web_Site` FROM company_settings";

                $resultCS = mysql_query($sqlCS) or die(mysql_error());

                $rowCS = mysql_fetch_array($resultCS);

                echo "<a style=\"color:#03F\" target=\"_blank\" href='http://" . $rowCS['Web_Site'] . "'>" . $rowCS['Company_Name'] . "</a>";
                ?></p>
        </div>
    </body>
</html>