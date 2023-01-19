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
<title>Sher Annual Leave Application Form</title>
</head>

<body><br />
<?php echo "<input type=button value=\"Print Out\" onclick=\"PrintContent()\" align=\"right\" >";?>
<div align="left" id="AL_Application_Form" >
<img src="../../images/Company_logo.JPG" width="800" height="70" />
<p align="center"><strong>ሼር ኢትዮጵያ  ኃ.የተ.የግ.ኩባንያ</strong>
							
  <strong>Sher Ethiopia P.L.C</strong><br />
  <strong>የፍቃድ መጠየቂያ ፎርም</strong><br />
  <strong><u>LEAVE APPLICATION FORM</u></strong><br /></p>
  <strong>ክፍል 1</strong><br />
  PART 1<br />
  የአመልካች ስም                                                  የፔይሮል  ቁ <br />
  NAME OF Applicant (MR/MRS/MS)<font color= "color=&quot;#FF0000&quot;"><u><?php 
  if( isset($_GET['FirstName'])){
	  echo " {$_GET['FirstName']} {$_GET['MiddelName']} {$_GET['LastName']}" ;
	  
	  }
	  ?></u></font> P/NO<u> <font color= "color=&quot;#FF0000&quot;"><?php 
  if( isset($_GET['ID'])){
	  echo "{$_GET['ID']} " ;
	  
	  }
	  ?>            </u> </font><br />
  ክፍል                                   ኃላፊነት<br />
  DEPARTMENT<u><font color= "color=&quot;#FF0000&quot;"><?php
            if( isset($_GET['ID'])){
       			 		$query  = "SELECT * FROM employee_personal_record where ID='".$_GET['ID']."'";
						$result = mysql_query($query);
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
				
				if ($row['ID'] == $_GET['ID'])
					{
						
					echo "<u> {$row['Department']} </u>";
					
					$position =$row['Position'];
					}
				
			}?></font></u>Position <u><font color= "color=&quot;#FF0000&quot;"><?php if( isset($_GET['ID'])){echo "<u>{$position}</u>";}?>
					 </u></font><br />
  የተጠየቀው ቀን ብዛት<br />
  1. I wish to apply for <font color= "color=&quot;#FF0000&quot;"><u><?php
if(isset($_GET['Leavedays']))
{echo "<u>{$_GET['Leavedays']}</u>";}?></u> </font>leave days from<u>         </u>Crop year starting from <font color= "color=&quot;#FF0000&quot;"><u><?php
if(isset($_GET['Leave_Taken_Date']))
{echo "<u>{$_GET['Leave_Taken_Date']}</u>";}?> </font></u><br />
  የፍቃድ ጊዜ አድራሻ የመኖሪያ አድራሻ ክ/ከተማ           ቀበሌ<br />
  My contact during  leave:-Residential Address kifle ketema<u>   </u>kebele<u>          </u>
  
<p>   ስልክ<br />
  Tel.<u>                                             </u><br />
  ፊርማ                     ቀን<br />
  Signature<u>                        </u>Date<u>                    </u><br />
  
  <?php 
  if(isset($_GET['TotalLeftDays']) and isset($_GET['initialALdays']) and isset($_GET['Date_Employement']))
  {
  $obj_leave = new leave();
echo $obj_leave->ALYearAllocation($_GET['TotalLeftDays'],$_GET['initialALdays'],$_GET['Annual_Leave_CONST_Year'],$_GET['Date_Employement'])."<br>";
  }
?>
  ………………………………………………………………………………………….</p>
<p>ክፍል 2<br />
  Part 2             (<u>FOR OFFICIAL USE ONLY)</u><br />
  የኃላፊ አስተያየት</p>
<ol>
  <li>Authorized Statement<u>                                                                                                           </u></li>
</ol>
<p>ሥም                    ፊርማ                        ቀን<br />
  NAME<u>                </u>Signature<u>                     </u>Date<u>              </u><br />
  (General Manager/Dep’t  Head/Supervisor)</p>
<p>ክፍል3<br />
  Part3<br />
  አመልካቹ                         የዕረፍት ቀን<br />
  The applicant is granted <font color= "color=&quot;#FF0000&quot;"><?php
if(isset($_GET['Leavedays']))
{echo "<u>{$_GET['Leavedays']}</u>";}?></font> leave day’s plus<u> <font color= "color=&quot;#FF0000&quot;">
  <u><?php
if(isset($_GET['Restday']))
{echo "{$_GET['Restday']}";}?></u>
  </font> </u>rest day’s we’ve<u>     </u>and</p>
<p>የሚመለስበት ቀን           የሚቀረው ቀን<br />
  Should report on <u><font color= "color=&quot;#FF0000&quot;"><?php
if(isset($_GET['ReportOn']))
{echo "<u>{$_GET['ReportOn']}</u>";}?></font></u> the balance of leave days carried  forward will be<u>           </u><br />
  ከ                                      <br />
  As at<u>             </u>                      <br />
  ፊርማ                           ቀን<br />
  Signature<u>                        </u>Date<u>                                </u> <br />
  (General Manager/Human  Resources Manage)<br />
  <br />
  <br />
  ስርጭት     ዋና      ለአመልካቹ<br />
  Distribution:  Original-Applicant<br />
  ኮፒ  ለግል ማህደር<br />
  Duplicate-Personal File<br />
  <br />
  <u>     </u> <br />
  <u>     </u><u> </u><br />
</p>
<p>&nbsp;</p>
<p>                                                      </p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>                                                         <br />
  <br />
</p>
</div>
</body>
</html>