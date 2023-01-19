<?php //include('../class_leave.php'); ?>
<?php require_once('../../Connections/HRMS.php'); ?>
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
<title>Annual Leave Application Form Report</title>
</head>

<body>
<?php 
echo "<input type=button value=\"Print Out\" onclick=\"PrintContent()\" align=\"right\" >";	
							?>
                    <div align="left" id="AL_Application_Form" >
                    <?php echo " ".date("Y-M-d")." ".time();?>
                    <p><img src="../../images/Company_logo.JPG" alt="" width="96" height="46" /><strong> </strong><br />
  <strong><?php
    $sqlCS  = "SELECT * FROM company_settings";
		
		$resultCS = mysql_query($sqlCS) or die(mysql_error());
		
		$rowCS=mysql_fetch_array($resultCS);
		
		echo "{$rowCS['Company_Name']}";
     ?></strong><br />
  <strong>   <u>Annual leave request form</u></strong></p>
<p><strong>Employee name<font color= "color=&quot;#FF0000&quot;"><?php
 if(isset($_GET['FirstName'])){
 echo "<u>{$_GET['FirstName']} {$_GET['MiddelName']} {$_GET['LastName']} </u>" ;}?></font></strong><br />
  <strong>Dep&rsquo;t<font color= "color=&quot;#FF0000&quot;"><?php
if(isset($_GET['Department']))
{echo "<u>{$_GET['Department']}</u>";}?></font></strong><br />
    <strong>Date of Employeement(የተቀጠረበት ቀን </span>) <font color= "color=&quot;#FF0000&quot;"><?php
if(isset($_GET['Date_Employement'])){echo "<u>{$_GET['Date_Employement']}</u>";}?></font></font><strong> Working Month(በሥራ ላይ የቆየባቸው ወራቶች</span>) </strong> <font color= "color=&quot;#FF0000&quot;"><?php
if(isset($_GET['Workingmonths']))
{echo "<u>{$_GET['Workingmonths']}</u>";}?></font></strong></font><br />
                
  <strong>ID N<u>o<font color= "color=&quot;#FF0000&quot;"><?php if(isset($_GET['ID'])){ echo "<u> {$_GET['ID']} </u>";}?></font></u></strong><br />
   <strong>Annual leave required from<font color= "color=&quot;#FF0000&quot;"><?php
if(isset($_GET['Leave_Taken_Date']))
{echo "<u>{$_GET['Leave_Taken_Date']}</u>";}?></font>to<?php
if(isset($_GET['ReportOn']))
{echo "<u>{$_GET['ReportOn']}</u>";}?></strong>For(<span sans-serif="sans-serif""'>ለ</span>)<font color= "color=&quot;#FF0000&quot;"><?php
if(isset($_GET['Leavedays']))
{echo "<u>{$_GET['Leavedays']}</u>";}?></font>days (<strong>ቀናት</strong>)<strong></strong><br />
 <span sans-serif="sans-serif""'> </span></strong>
  <strong> </strong><strong>የተጠየቀው የዓመት  ፍቃድ</strong><strong><span sans-serif="sans-serif""'>           </span></strong><strong>                         </strong><strong>እስከ</strong><strong> </strong><strong> 
  <strong>Back to work on<font color= "color=&quot;#FF0000&quot;"><?php
if(isset($_GET['ReportOn']))
{echo "<u>{$_GET['ReportOn']}</u>";}?></font></strong><br />
  <strong>ወደስራ የሚመለሱበት ቀን</strong>
  <strong>Annual leave taken  <font color="#FF0000"><?php
if(isset($_GET['TotalTakenDay']))
{echo "<u>{$_GET['TotalTakenDay']}</u>";}?></font>days</strong><br />
  <strong>አሁን</strong><strong><span sans-serif="sans-serif""'>&nbsp;</span></strong><strong>የሚወስዳቻዉ ቀናት</strong><strong><span sans-serif="sans-serif""'> </span></strong><br />
  <strong>Annual leave remaining   <font color= "color=&quot;#FF0000&quot;"><?php
if(isset($_GET['TotalLeftDays']))
{echo "<u>{$_GET['TotalLeftDays']}</u>";}?></font>days</strong><br />
  <strong><em>የሚኖሩት ቀሪ </em></strong><strong>ቀናት </strong><strong><span sans-serif="sans-serif""'> </span></strong><br />
   <?php echo "<b>This Year(<span style=\"font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;\">ከአሁኑ ዓመት</span>): <font color= \"color=&quot;#FF0000&quot;\">";
   
if(isset($_GET['thisyearLeft']))
{echo "<u>{$_GET['thisyearLeft']}</u>";}
echo " </font>, ";
		echo " Last Year(<span style=\"font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;\">ካለፈው ዓመት</span>): <font color= \"color=&quot;#FF0000&quot;\">";
		if(isset($_GET['lastyearLeft']))
{echo "<u>{$_GET['lastyearLeft']}</u>";}

		echo "</font> , ";
		echo " Before Last Year(<span style=\"font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;\">ከሁለት ዓመት በፊት</span>): <font color= \"color=&quot;#FF0000&quot;\">";
		
		if(isset($_GET['beforelastyearLeft']))
{echo "<u>{$_GET['beforelastyearLeft']}</u>";}
		echo "</font></b><br/>";
		?>
  <strong><em>Requested by:</em></strong><strong>                                  <em>Given by:                                   Approved by:</em></strong><br />
  <strong><em>የጠየቀው                  የፈቀደው               ያጸደቀው</em></strong><strong> </strong><br />
  <strong>Name and signature                         Name and  signature                   Name and  signature </strong><br />
  <strong>                                                                              </strong><br />
  <strong>_______________                            ________________                     _______________</strong><br />
  <strong> Note: -prepared  in two copies. One to the employee and the second for personnel file.</br>
<table border="1" cellspacing="0" cellpadding="0" align="left" width="650">
  <tr>
    <td width="543" valign="top"></td>
  </tr>
</table><br />
<?php echo " ".date("Y-M-d")." ".time();?><p><img src="../../images/Company_logo.JPG" alt="" width="100" height="46" /><strong> </strong><br />
  <strong>   <?php
    $sqlCS  = "SELECT * FROM company_settings";
		
		$resultCS = mysql_query($sqlCS) or die(mysql_error());
		
		$rowCS=mysql_fetch_array($resultCS);
		
		echo "{$rowCS['Company_Name']}";
     ?></strong><br />
  <strong>   <u>Annual leave request form</u></strong></p>
<p><strong>Employee name<font color= "color=&quot;#FF0000&quot;"><?php
 if(isset($_GET['FirstName'])){
 echo "<u>{$_GET['FirstName']} {$_GET['MiddelName']} {$_GET['LastName']} </u>" ;}?></font></strong><br />
  <strong>Dep&rsquo;t<font color= "color=&quot;#FF0000&quot;"><?php
if(isset($_GET['Department']))
{echo "<u>{$_GET['Department']}</u>";}?></font></strong><br />
    <strong>Date of Employeement(የተቀጠረበት ቀን </span>) <font color= "color=&quot;#FF0000&quot;"><?php
if(isset($_GET['Date_Employement'])){echo "<u>{$_GET['Date_Employement']}</u>";}?></font></font><strong> Working Month(በሥራ ላይ የቆየባቸው ወራቶች</span>) </strong> <font color= "color=&quot;#FF0000&quot;"><?php
if(isset($_GET['Workingmonths']))
{echo "<u>{$_GET['Workingmonths']}</u>";}?></font></strong></font><br />
                
  <strong>ID N<u>o<font color= "color=&quot;#FF0000&quot;"><?php if(isset($_GET['ID'])){ echo "<u> {$_GET['ID']} </u>";}?></font></u></strong><br />
   <strong>Annual leave required from<font color= "color=&quot;#FF0000&quot;"><?php
if(isset($_GET['Leave_Taken_Date']))
{echo "<u>{$_GET['Leave_Taken_Date']}</u>";}?></font>to<?php
if(isset($_GET['ReportOn']))
{echo "<u>{$_GET['ReportOn']}</u>";}?></strong>For(<span sans-serif="sans-serif""'>ለ</span>)<font color= "color=&quot;#FF0000&quot;"><?php
if(isset($_GET['Leavedays']))
{echo "<u>{$_GET['Leavedays']}</u>";}?></font>days (<strong>ቀናት</strong>)<strong></strong><br />
 <span sans-serif="sans-serif""'> </span>
  <strong> </strong><strong>የተጠየቀው የዓመት  ፍቃድ</strong><strong><span sans-serif="sans-serif""'>           </span></strong><strong>                         </strong><strong>እስከ</strong><strong> </strong><strong> 
  <strong>Back to work on<font color= "color=&quot;#FF0000&quot;"><?php
if(isset($_GET['ReportOn']))
{echo "<u>{$_GET['ReportOn']}</u>";}?></font></strong><br />
  <strong>ወደስራ የሚመለሱበት ቀን</strong>
  <strong>Annual leave taken  <font color="#FF0000"><?php
if(isset($_GET['TotalTakenDay']))
{echo "<u>{$_GET['TotalTakenDay']}</u>";}?></font>days</strong><br />
  <strong>አሁን</strong><strong><span sans-serif="sans-serif""'>&nbsp;</span></strong><strong>የሚወስዳቻዉ ቀናት</strong><strong><span sans-serif="sans-serif""'> </span></strong><br />
  <strong>Annual leave remaining   <font color= "color=&quot;#FF0000&quot;"><?php
if(isset($_GET['TotalLeftDays']))
{echo "<u>{$_GET['TotalLeftDays']}</u>";}?></font>days</strong><br />
  <strong><em>የሚኖሩት ቀሪ </em></strong><strong>ቀናት </strong><strong><span sans-serif="sans-serif""'> </span></strong><br />
   <?php echo "<b>This Year(<span style=\"font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;\">ከአሁኑ ዓመት</span>): <font color= \"color=&quot;#FF0000&quot;\">";
   
if(isset($_GET['thisyearLeft']))
{echo "<u>{$_GET['thisyearLeft']}</u>";}
echo " </font>, ";
		echo " Last Year(<span style=\"font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;\">ካለፈው ዓመት</span>): <font color= \"color=&quot;#FF0000&quot;\">";
		if(isset($_GET['lastyearLeft']))
{echo "<u>{$_GET['lastyearLeft']}</u>";}

		echo "</font> , ";
		echo " Before Last Year(<span style=\"font-family:&quot;TITUS Cyberbit Basic&quot;,&quot;serif&quot;;\">ከሁለት ዓመት በፊት</span>): <font color= \"color=&quot;#FF0000&quot;\">";
		
		if(isset($_GET['beforelastyearLeft']))
{echo "<u>{$_GET['beforelastyearLeft']}</u>";}
		echo "</font></b><br/>";
		?>
  <strong><em>Requested by:</em></strong><strong>                                  <em>Given by:                                   Approved by:</em></strong><br />
  <strong><em>የጠየቀው                  የፈቀደው               ያጸደቀው</em></strong><strong> </strong><br />
  <strong>Name and signature                         Name and  signature                   Name and  signature </strong><br />
  <strong>                                                                              </strong><br />
  <strong>_______________                            ________________                     _______________</strong><br />
  <strong> Note: -prepared  in two copies. One to the employee and the second for personnel file.</br>
</div>
                    

</body>
</html>