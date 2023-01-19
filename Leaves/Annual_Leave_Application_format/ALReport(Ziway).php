<?php require_once('../../Connections/HRMS.php'); ?>
<?php require_once('../../Classes/Class_Leave.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Annual Leave Application Report</title>
        <script type="text/javascript" src="../js/PrintContent.js"> 
         </head>

         <body>
            <?php
            echo "<input type=button value=\"Print Out\" onclick=\"PrintContent('AL_Application_Form')\" align=\"right\" >";
            ?>
        <div align="left" id="AL_Application_Form" >	
<p align="left"><span mso-no-proof:yes="mso-no-proof:yes"'><img width="183" height="68"  src="../../img logo &amp; icons/Company_logo.png" /></span><strong>        </strong><strong>የአመት ፈቃድ መጠየቂያና መስጫ  ቅፅ</strong><strong> </strong><br />
  <strong>                                                        </strong><strong>Annual Leave Form</strong><strong>       </strong><strong> </strong><br />
  <strong>                                                                                                   </strong>ቁጥር  / No  ____________________<strong> </strong><br />
  <strong>                                                                                         </strong><br />
<strong>                                                                                            </strong>ቀን / Date <u>______<?php echo " " . date("d/m/Y"); ?>_____</u></p>
<p align="left">የአመልካች ስም<u>____________<strong><font color= "color=&quot;#FF0000&quot;">
            <?php
            if (isset($_GET['FirstName'])) {
                echo "{$_GET['FirstName']} {$_GET['MiddelName']} {$_GET['LastName']} ";
            }
            ?>
         </font></strong>_______________</u><br />
         Name of Applicant<br />
         የስራ ክፍል<u>______________<font color= "color=&quot;#FF0000&quot;">
            <?php
            if (isset($_GET['Department'])) {
                echo "{$_GET['Department']}";
            }
            ?>
        </font>________________</u><br />
        Department <br />
        የስራ መደብ_____________<font color= "color=&quot;#FF0000&quot;">
        <u><?php
            if (isset($_GET['Position'])) {
                echo "{$_GET['Position']}";
            }
            ?></u>
        </font>________________<br />
        Position <br />
        የተጠየቀው ቀን ብዛት______<font color= "color=&quot;#FF0000&quot;">
        <u><?php
            if (isset($_GET['Leavedays'])) {
                echo "{$_GET['Leavedays']}";
            }
            ?></u>
        </font>_________________<br />
        Number of days requested<br />
        በፈቃድ  ጊዜ የመኖሪያ አድራሻ _________________ቀበሌ_________ስልክ___________________ <br />
        My  contact during leave residential Address                      Kebele                   Tel </p>
<p>የጠያቂው ፊርማ ___________________     ቀን ____<u><?php echo " " . date("d/m/Y"); ?></u>_______ <br />
        Requested  by                                                             Date <br />
        የቅርብ አለቃ ስም ___________________________  ፊርማ __________________<br />
        Supervisor’s Name and Signature <br />
        ፈቃዱ የተሰጠው  ከ___<font color= "color=&quot;#FF0000&quot;">
        <u><?php
            if (isset($_GET['Leave_Taken_Date'])) {
                echo "{$_GET['Leave_Taken_Date']}";
            }
            ?></u>
        </font>___ እስከ___<font color= "color=&quot;#FF0000&quot;">
        <u><?php
            if (isset($_GET['ReportOn'])) {
                echo "{$_GET['ReportOn']}";
            }
            ?></u>
        </font>__ ለ___<font color= "color=&quot;#FF0000&quot;">
        <u><?php
            if (isset($_GET['Leavedays'])) {
                echo "{$_GET['Leavedays']}";
            }
            ?></u>
        </font>___ቀናት<br />
        Annual  Leave given from       to                    for                  days<br />
        ተጨማሪ የሳምንት እረፍት /በዓል ቀናት ብዛት_____<font color= "color=&quot;#FF0000&quot;">
        <u><?php
            if (isset($_GET['Restday'])) {
                echo "{$_GET['Restday']}";
            }
            ?></u>
        </font>________<br />
        Additional  rest days / holidays<br />
        ወደ ስራ የሚመለስበት ቀን______<font color= "color=&quot;#FF0000&quot;">
        <u><?php
            if (isset($_GET['ReportOn'])) {
                echo "{$_GET['ReportOn']}";
            }
            ?></u>
        </font>_________<br />
        Date of returned  to work
            <?php
            if (isset($_GET['TotalLeftDays']) and isset($_GET['initialALdays']) and isset($_GET['Date_Employement'])) {
                $obj_leave = new leave();
                echo $obj_leave->ALYearAllocation($_GET['TotalLeftDays'], $_GET['initialALdays'], $_GET['Annual_Leave_CONST_Year'], $_GET['Date_Employement']) . "<br>";
            }
            ?><!-- ቀሪ የአመት ፈቃድ/Left annual Leave         <br />
    ከ 2007 _________________ ቀናት / days <br />
        ከ 2008 _________________ ቀናት / days<br />
        ከ 2009 _________________ ቀናት / days<br />
        ከ 2010 ________________  ቀናት / days<br />
        ከ 2011 _________________ ቀናት / days<br />
        ከ 2012 _________________ ቀናት / days><br /-->
        ጠቅላላ ቀሪ የአመት እረፍት  ቀናት ብዛት______<font color= "color=&quot;#FF0000&quot;">
<?php
if (isset($_GET['TotalLeftDays'])) {
    echo "<u>{$_GET['TotalLeftDays']}</u>";
}
?>
        </font>_______________<br />
        Total left annual leave days</p>
<p>ያረጋገጠው/ Confirmed by                           ያፀደቀው/  Approved  by Admin &amp;HRM(አስተዳደርና ሰዉ ሀይል ስራ አስኪያጅ )  <br />
        ስም/Name ______________________                  ስም/Name ____________________ <br />
        ፊርማ/Sign _____________________                   ፊርማ/Sign ___________________</p>
        </div>
        </body>
        </html>