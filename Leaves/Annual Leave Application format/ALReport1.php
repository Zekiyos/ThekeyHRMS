<?php require_once('../../Connections/HRMS.php'); ?>
<?php include('../Class_Leave.php'); ?>
<script type="text/javascript">
function PrintContent()
    {
		
        var DocumentContainer = document.getElementById('AL_Application_Form');
        var WindowObject = window.open('', "TrackHistoryData", 
                              "width=740,height=325,top=200,left=250,toolbars=no,scrollbars=yes,status=no,resizable=no");
        WindowObject.document.writeln(DocumentContainer.innerHTML);
        WindowObject.document.close();
        WindowObject.focus();
        WindowObject.print();
        WindowObject.close();
    }
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body >

<?php 
echo "<input type=button value=\"Print Out\" onclick=\"PrintContent()\" align=\"right\" >";	
							?>
<div align="left" id="AL_Application_Form" >
                    <?php echo " ".date("Y-M-d")." ".time();?>                        
 <br />
<p align="left"><img src="../../images/Company_logo.JPG" alt="" width="290" height="66" /></p>
<p align=""><strong><u>Annual  Leave Request Form</u></strong><br /></p>
  Me applicant<font color= "color=&quot;#FF0000&quot;"><?php
 if(isset($_GET['FirstName'])){
 echo "<u>{$_GET['FirstName']} {$_GET['MiddelName']} {$_GET['LastName']} </u>" ;}?></font>  ID No<u><font color= "color=&quot;#FF0000&quot;"><?php if(isset($_GET['ID'])){ echo "<u> {$_GET['ID']} </u>";}?></font></u>, have been working in this company since <font color= "color=&quot;#FF0000&quot;"><?php
if(isset($_GET['Date_Employement'])){echo "<u>{$_GET['Date_Employement']}</u>";}?></font> <br />in the  department of <font color= "color=&quot;#FF0000&quot;"><?php
if(isset($_GET['Department']))
{echo "<u>{$_GET['Department']}</u>";}?></font>as <font color= "color=&quot;#FF0000&quot;"><?php
if(isset($_GET['Position']))
{echo "<u>{$_GET['Position']}</u>";}?></font>.<br /> I have used  <font color= "color=&quot;#FF0000&quot;"><?php
if(isset($_GET['$TotalTakenDay']))
{echo $_GET['$TotalTakenDay'];}?></font>days of my annual leave from ____________year.  Hence, I kindly ask the <br /> company to give me  annual leave of the year _______ for <font color= "color=&quot;#FF0000&quot;"><?php
if(isset($_GET['Leavedays']))
{echo "<u>{$_GET['Leavedays']}</u>";}?></font> days from <font color= "color=&quot;#FF0000&quot;"><?php
if(isset($_GET['Leave_Taken_Date']))
{echo "<u>{$_GET['Leave_Taken_Date']}</u>";}?></font> to <font color= "color=&quot;#FF0000&quot;"><?php
if(isset($_GET['ReportOn']))
{echo "<u>{$_GET['ReportOn']}</u>";}?></font>.<br /> Finally, it is my pleasure to be on my work on the date of <font color= "color=&quot;#FF0000&quot;"><?php
if(isset($_GET['ReportOn']))
{echo "<u>{$_GET['ReportOn']}</u>";}?></font>to respect  the company rules and regulations.<br />
  Best Regards,</p>
<p>Applicant sign                           Issued by                            Approved by<br />
  _____________                       ________                             __________
<table border="1" cellspacing="0" cellpadding="0" align="left" width="650">
  <tr>
    <td width="543" valign="top"></td>
  </tr>
</table>
  <br />
  <p align="left"><img src="../../images/Company_logo.JPG" alt="" width="290" height="66" /></p>
  <p align=""><strong><u>የአመት እረፍት መጠየቂያ ቅጽ</u></strong></p><br />
  እኔ<font color= "color=&quot;#FF0000&quot;"><?php
 if(isset($_GET['FirstName'])){
 echo "<u>{$_GET['FirstName']} {$_GET['MiddelName']} {$_GET['LastName']} </u>" ;}?></font> የተባልኩት የኸርበርግ ሮዝ ሰራተኛ ስሆን ከ<font color= "color=&quot;#FF0000&quot;"><?php
if(isset($_GET['Date_Employement'])){echo "<u>{$_GET['Date_Employement']}</u>";}?></font> እስከ <font color= "color=&quot;#FF0000&quot;">ዛሬ</font>  <br /> በመስራት የ  <font color= "color=&quot;#FF0000&quot;"><?php
if(isset($_GET['Workingmonths']))
{echo "<u>{$_GET['Workingmonths']}</u>";}?> ወራት</font> ግዜ ቆይታ በዚህ መስራቤት ያለኝ ስሆን የ-----------  ቀን አመት እረፍቴን <br />ከ <font color= "color=&quot;#FF0000&quot;"><?php
if(isset($_GET['$TotalTakenDay']))
{echo $_GET['$TotalTakenDay'];}?></font>አመት የአመት እረፍቴ ተጠቅሜያለሁ፡፡አሁን በመስራቤቱ ሕግ መሰረት  የ <font color= "color=&quot;#FF0000&quot;"><?php
if(isset($_GET['Leavedays']))
{echo "<u>{$_GET['Leavedays']}</u>";}?></font>  የአመት እረፍቴን <br />  ከ------------- አመት ላይ እዲሰጠኝ ስል ጠይቃለው::በመጨረሻም የድርጅቱን ህግና ደንብ  አክብሬ <br />በ<font color= "color=&quot;#FF0000&quot;"><?php
if(isset($_GET['ReportOn']))
{echo "<u>{$_GET['ReportOn']}</u>";}?></font> ቀን ወደስራዬ ስመለስ በድስታ ነው፡፡ </p>
<br />
ከሰላምታ ጋር
<p>  የጠየቀው  ሰራተኛ ፊርማ                የፈቀደው ፊርማ             ያፀደቀው  ፊርማ       </p>
<p>  _____________               _____________     ______________</p>
<p>
  <?php 
  if(isset($_GET['TotalLeftDays']) and isset($_GET['initialALdays']) and isset($_GET['Date_Employement']))
  {
  $obj_leave = new leave();
echo $obj_leave->ALYearAllocation($_GET['TotalLeftDays'],$_GET['initialALdays'],$_GET['Annual_Leave_CONST_Year'],$_GET['Date_Employement'])."<br>";
  }
?>
</p>
</div>

</body>
</html>
