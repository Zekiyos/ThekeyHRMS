<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>First Inistance Warning Letter Sample</title>
    </head>

    <body>    
        <table  >
            <tr>
                <td><img  src="../../images/Company_logo.JPG"  height="100" width="150" /></td>
                <td> AQ Roses PLC<br />
                    P.O.Box 404<br/>
                    Ziway<br />
                    Ethiopia<br />
                </td>
                <td>Tel. +251-0464414274/75 /77<br />
                    Fax: +251-0464414273<br />
                    email: aqroses@gmail.com  or aqroses@yahoo.com  or<br />
                    Ethiopia@aqroses.com</td>
            </tr>
        </table>


        <p align="center">ኤ  ኪው ሮዝስ ኃ.የተ.የግ.ማ. <strong>AQ  Roses PLC.</strong><br />
            <u>የማስጠንቀቂያ ደብዳቤ </u><strong><u>Warning Letter</u></strong><u> </u><br />
            <br />
            የሠራተኛው ስው <u><?php
$query = "SELECT * FROM employee_personal_record";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    if (isset($_GET['ID'])) {
        if ($row['ID'] == $_GET['ID']) {

            echo "<br><b><font size=\"+3\">" . "Full Name:" . "{$row['FirstName']}";
            echo " {$row['MiddelName']}";
            echo " {$row['LastName']}" . "</br></b></font>";
        }
    }
}
?></u><br />
            Name of employe                                                                                                                                                                                    <u></u><br />
            የሥራ ድርሻ<u><?php
                $query = "SELECT * FROM employee_personal_record";
                $result = mysql_query($query);
                while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                    if (isset($_GET['ID'])) {
                        if ($row['ID'] == $_GET['ID']) {

                            echo "<br><b><font size=\"+3\">";
                            echo " {$row['Position']}</font>";
                        }
                    }
                }
?></u><br />
            Duty<br />
            ቀን<u><?php echo date("d/m/Y"); ?></u><br />
            Date                                                                                                                                                                                                                                                                                                                                        </p>
        <table border="1" cellspacing="0" cellpadding="0">
            <tr>
                <td width="130" valign="top"><br />
                    የጥፋት ዓይነት<br />
                    Undisciplined character </td>
                <td width="249" valign="top"><p align="center">የመጀመሪያ<br />
                        ማስጠንቀቂያ<br />
                        1st Warning Letter</p></td>
                <td width="228" valign="top"><p align="center">ተጨማሪ አስተያየት<br />
                        Additional Comment</p></td>
            </tr>
            <tr>
                <td width="130" valign="top"><p align="center">&nbsp;</p>
                    <p align="center">ትእዛዝ አለመክበር<br />
                        Noncompliance</p></td>
                <td width="249" valign="top"><p align="center">&nbsp;</p></td>
                <td width="228" valign="top"><p align="right">&nbsp;</p></td>
            </tr>
            <tr>
                <td width="130" valign="top"><p align="center">&nbsp;</p>
                    <p align="center">ኃላፊነት አለመወጣት<br />
                        Being Irresponsible</p></td>
                <td width="249" valign="top"><p align="center">&nbsp;</p></td>
                <td width="228" valign="top"><p align="right">&nbsp;</p></td>
            </tr>
            <tr>
                <td width="130" valign="top"><p align="center">&nbsp;</p>
                    <p align="center">ከሥራ መዘግየት<br />
                        Tardiness</p></td>
                <td width="249" valign="top"><p align="center">&nbsp;</p></td>
                <td width="228" valign="top"><p align="right">&nbsp;</p></td>
            </tr>
            <tr>
                <td width="130" valign="top"><p align="center">&nbsp;</p>
                    <p align="center">ከሥራ መቅረት<br />
                        Absent without <br />
                        Permission </p></td>
                <td width="249" valign="top"><p align="center">&nbsp;</p></td>
                <td width="228" valign="top"><p align="right">&nbsp;</p></td>
            </tr>
            <tr>
                <td width="130" valign="top">
                    <p align="center">ስርቆት<br />
                        Theft</p></td>
                <td width="249" valign="top"><p align="center">&nbsp;</p></td>
                <td width="228" valign="top"><p align="right">&nbsp;</p></td>
            </tr>
            <tr>
                <td width="130" valign="top"><p align="center">&nbsp;</p>
                    <p align="center">ሌሎች<br />

                        Others</p></td>
                <td width="249" valign="top"><p align="center">&nbsp;</p></td>
                <td width="228" valign="top"><p align="right">&nbsp;</p></td>
            </tr>
        </table>
        <p>ይህ  ማስጠንቀቂያ በቅጣት መልክ እንዲሰጥዎ ድርጅቱ መወሰኑን እየገለጽን ከዚህ በኋላ እንደዚህ ዓይነት ስህተት እንዳይደገም ጥንቃቄ እንዲያደርጉ  ለማሳሰብ እንወዳለን ፡፡<br />
            The  Company Decides' to give this Warning Letter for the Mention ice companies rule  violation and you have to take care to don't repeat the undisciplined  character.<br />
            የሱፐርቫይዘሩ  ስምና ፊርማ                                                             ያጸደቀው ስምና ፊርማ                      <br />
            Supervisor's  Name &amp; Signature<u>             </u><u>                        </u>                         (Approved  by &amp; signature)<u></u><br />
            <u>                                                    </u><br />
            የተቀባይ  ስምና ፊርማ</p>
        Emloyees  Name &amp; signature <u>                                                                  </u>




    </body>
</html>         
