<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<p><img src="../../img logo & icons/AQlogo.gif"  alt="" width="70" height="40" />                                                               <br />
  AQ ROSES PLC<br />
  P O Box 404 <br />
  <u>ZEWAY</u></p>
<p> Date:<u><?php echo date("d/m/Y"); ?></u><br />
  To:<?php $query  = "SELECT * FROM employee_personal_record";
	$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					 if(isset($_GET['ID'] ))
					 {	
						if ($row['ID'] == $_GET['ID'])
						{
							
						echo "<br><b><font size=\"+3\">"."TO:  <u>"."{$row['FirstName']}";
						echo " {$row['MiddelName']}";
						echo " {$row['LastName']}"."</u></br></b></font>";
						}
					
					 }
				}?></p>
<p> <strong><u> RE: Permanent Employment Contract</u></strong> <br />
  We  are pleased to offer you a Permanent employment contract as a general worker in  the<strong> <?php
            
       			 		$query  = "SELECT * FROM employee_personal_record";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					 if(isset($_GET['ID'] )){	
					if ($row['ID'] == $_GET['ID'])
					{
					
					
					echo " {$row['Department']}</u></font>";
					
					}
					
					 }
					 }
				 ?> </strong>section with a  probation period of forty five (45) days under  the terms and conditions of service stipulated below:<strong><u></u></strong></p>
<ul>
  <li><strong><u>Designation  and location of work</u></strong></li>
</ul>
<p>           You will be  deployed to the <strong><?php
            
       			 		$query  = "SELECT * FROM employee_personal_record";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					 if(isset($_GET['ID'] )){	
					if ($row['ID'] == $_GET['ID'])
					{
					
					echo "<br><b>Position:  <u><font size=\"+3\">";
					echo " {$row['Position']}</u></font>";
					
					}
					
					 }
					 }
				 ?> </strong>section  to perform the following duties:</p>
                 <?php
            
						if(isset($_GET['ID'] )){	
						$query ="SELECT `employee_personal_record`.ID,Contract_Letter FROM `contract_letter` JOIN `employee_personal_record` ON Contract_letter.Department =`employee_personal_record`.Department "; //WHERE `employee_personal_record`.ID = ".$_GET['ID']."";
						$result = mysql_query($query);
						
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					
					if ($row['ID'] == $_GET['ID'])
					{
					
					echo "<br><b><font size=\"+3\">";
					echo " {$row['Job_Description']}</font>";
					
					}
					
				}	 }
					
				 ?>
<!--ul>
  <li>Packaging of the flowers in the boxes</li>
  <li>Fill the boxes according to the known packaging  rate</li>
  <li>Loading and offloading the cold truck</li>
  <li>Keep your area always clean and tidy</li>
  <li>Any other duties as may be lawfully assigned to  you by the management from time to time.</li>
</ul-->
<ul>
  <li><strong><u>Commencement  Date</u></strong></li>
</ul>
<p>This contract  comes into effect starting from<u><?php echo date("d/m/Y"); ?></u>. </p>
<ul>
  <li><strong><u>Hours of  work</u></strong></li>
</ul>
<p>The normal working week shall  consist of forty-eight hours of work spread over six days of the week  comprising of six (6) days of eight (8) hours of work per day.</p>
<ul>
  <li><strong><u>Over time</u></strong></li>
</ul>
<p>Where you are  requested by management to work in excess of the normal hours of work per day  or week as specified in paragraph 4 above due to urgent work, you shall be paid  for over time according to the labor proclamation377/2003 section 66.</p>
<ul>
  <li><strong><u>Weekly  rest</u></strong></li>
</ul>
<p>You are  entitled to one (1) rest day in every period of seven (7) days with pay.  However, where the rest day does not fall on a Sunday owing to the nature of  our operations, any other day will be made a rest day as a substitute.</p>
<ul>
  <li><strong><u>Public  holidays</u></strong></li>
</ul>
<p>Public holiday  shall be with full pay and where you are required to work on such days, you  will be paid two and one half (2 1/2) the basic hourly rate. Where  the public holiday coincides or falls on your rest day, you will be entitled to  only one payment.</p>
<p>&nbsp;</p>
<ul>
  <li><strong><u>Leave</u></strong></li>
  <li>On completion of one (1) year of service you  will be entitled to pro-rata leave at the rate of 14 days (fourteen days) for  every completed year of service, according to the labor proclamation 377/2003  section 76.</li>
  <li>Medical expenses and sick leave of the employee  will be covered by the company if the employee gets medication in Sher Hospital.  This facility is also available for the direct family (parents,  brothers/sisters, husband/wife, and children) of the employee, but these  expenses will not be covered by the employer.</li>
  <li>Maternity leave of three months will be granted  by the employer.</li>
  <li><strong><u>Payment  of wages</u></strong></li>
</ul>
<p>You are  entitled to a gross basic salary of birr <?php
            
       			 		$query  = "SELECT * FROM employee_personal_record";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					 if(isset($_GET['ID'] )){	
					if ($row['ID'] == $_GET['ID'])
					{
					
					
					echo " {$row['Salary']}</u></font>";
					
					}
					
					 }
					 }
				 ?> (----------------------------------) per month. In addition to this, you will  be paid birr <?php
            
       			 		$query  = "SELECT * FROM employee_personal_record";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					 if(isset($_GET['ID'] )){	
					if ($row['ID'] == $_GET['ID'])
					{
					
					
					echo " {$row['Present_Allowance']}</u></font>";
					
					}
					
					 }
					 }
				 ?> (_____________________________ birr) present allowance which shall be subject to  deduction in case you are absent without permission. Salary &amp; allowance will  be paid at the end of each month.</p>
<ul>
  <li><strong><u>Health  and safety at work </u></strong></li>
  <li>You will be expected to adhere to the safety  procedures and the health and safety precautions as provided for the safety  regulations of the company.</li>
  <li>You should not do or omit to do any thing likely  to endanger your health or that of any other person at your place of work.</li>
  <li>You should wear any applicable protective  equipment provided to you all the times while performing your task.</li>
  <li>You will not partake in any food or drink at  prohibited places or smoke in any place likely to cause rise to hazardous dusts  or fumes.</li>
  <li>You will not misuse any company property.</li>
  <li>You should notify your supervisor immediately  when an accident occurs to you.</li>
  <li>You should endeavor to conserve the environment.</li>
  <li><strong><u>Disciplinary offences at work</u></strong>                                                                                                                                              In case of disciplinary offences during work at the company, the  employer will  decide disciplinary actions  according to the internal regulations of the company.</li>
  <li><strong><u>Others</u></strong></li>
</ul>
<p>In situations not mentioned in  this contract, the decision will be made based on the CBA. When no CBA is  available, the decision will be in accordance with the Ethiopian labor  proclamation.<br />
  I…………………………………………have read and understood the above contract terms and I  accept to be bound by this contract.<br />
  <br />
  Employee’s signature…………………Date……………………..<br />
  <br />
  <strong><u>Contact  person in case of emergency</u></strong><br />
  Name……………………………………<br />
  Address: occupation…………………….<br />
  Kebele…………House number……..<strong><u></u></strong><br />
  <strong>                      </strong>Telephone<strong>………………                                                                                                                      </strong></p>
<p><strong>                                                                                                Yours  faithfully</strong></p>
<p align="right"><strong>                                                                                                                                                                                                                                       </strong><strong> </strong><br />
  <strong>                                                                                         Aychiluhim  Abebe                                                                                                                                                                                  Human Resource Manager</strong><br />
  <img src="../../img logo & icons/AQlogo.gif"  alt="" width="70" height="40" /></p>
<p>   ኤ  ኪው ሮዝስ ኃ <span ge\0027ez-1="Ge\0027ez-1""'></span>/የተ/የግ/ማ<br />
  ፖ.ሣ.ቁ 4ዐ4<br />
  ዝዋይ<br />
  <br />
  ቀን<u><?php echo date("d/m/Y"); ?></u> <br />
  <br />
ለ<u><?php $query  = "SELECT * FROM employee_personal_record";
	$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					 if(isset($_GET['ID'] ))
					 {	
						if ($row['ID'] == $_GET['ID'])
						{
							
						echo "<br><b><font size=\"+3\">"."TO:  <u>"."{$row['FirstName']}";
						echo " {$row['MiddelName']}";
						echo " {$row['LastName']}"."</u></br></b></font>";
						}
					
					 }
				}?></u>  </p>
<p><u>ቀሚ የስራ ውል ስምምነት</u></p>
<p>ኤ ኪው ሮዝስ ኃ/የተ/የግ/ድ  እርስዎን በአበባ እርሻ ሁለገብ ሠራተኝነት ከአርባ አምስት ቀን የሙከራ ጊዜ በኋላ በቋሚነት የሚፀና የቅጥር ውል ሲሰጥዎት  ደስተኛ ሲሆን በ <u><?php
            
       			 		$query  = "SELECT * FROM employee_personal_record";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					 if(isset($_GET['ID'] )){	
					if ($row['ID'] == $_GET['ID'])
					{
					
					
					echo " {$row['Department']}</u></font>";
					
					}
					
					 }
					 }
				 ?></u> የሥራ  ክፍል  ከዚህ በታች የተገለ<span unicode1="Unicode1""'>è</span>ትን የሥራ ውል አካሎች እንደሚከተለው ያሳውቃል፡፡<br />
  1 <strong><u>የስራ ድር</u></strong><strong><u><span unicode1="Unicode1""'>h</span></u></strong><strong> </strong><br />
  <?php
            
						if(isset($_GET['ID'] )){	
						$query ="SELECT `employee_personal_record`.ID,Contract_Letter FROM `contract_letter` JOIN `employee_personal_record` ON Contract_letter.Department =`employee_personal_record`.Department "; //WHERE `employee_personal_record`.ID = ".$_GET['ID']."";
						$result = mysql_query($query);
						
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					
					if ($row['ID'] == $_GET['ID'])
					{
					
					echo "<br><b><font size=\"+3\">";
					echo " {$row['Job_Description_Amharic']}</font>";
					
					}
					
				}	 }
					
				 ?>
  <!--strong><em><u>አበባ ማቀዝቀዣና ማሸጊያ ክፍል </u></em></strong><strong><em><u><span unicode1="Unicode1""'>(</span>cold  store and Packing section</u></em></strong><strong><em><u><span sans-serif="sans-serif""'>)</span></u></em></strong></p>
<ul>
  <li>አበቦችን በካርቶን ውስጥ ማሸግ</li>
  <li>አበቦችን በሚታወቅ የማሸጊያ መጠን በካርቶን ውስጥ  በአግባቡ በመደርደር ማሸግ</li>
  <li>ሁልጊዜ ከሥራ በኋላ የማሸጊያ ክፍልን አጠቃላይ ንጽሕና  እንዲኖረው ማድረግ፡፡</li>
  <li>የታሸጉ አበቦችን በመጫን ካርቶን እና የተለያዩ እቃዎችን  ከመኪና ላይ ማውረድ፡፡</li>
  <li>በአጠቃላይ በድርጅቱ የሚታዘዙትን ሥራ መሥራት፡፡</li>
</ul-->
<p><strong>  2</strong>.  <strong><em><u>ውሉ የሚፀናበት ጊዜ</u></em></strong><br />
  ይህ የሥራ ውል እ.አ.አ. ከ <u><?php echo date("d/m/Y"); ?></u> የፀና ይሆናል፡፡<br />
  3 <strong><em><u>የሥራ ሰዓት እና ጊዜ</u></em></strong><br />
  በሳምንት ውስጥ 48 ሰዓት መስራት ይጠበቅብዎታል፡፡  ይህም በስድስት ቀናት ውስጥ የሚኖር የሥራ ጊዜ ነው፡፡</p>
<ul>
  <li><strong><em><u>የትርፍ  ሰዓት ክፍያ</u></em></strong></li>
</ul>
<p>በድርጅቱ <span ge\0027ez-1="Ge\0027ez-1""'></span>ኃላፊዎች  ታዘው ትርፍ ሰዓት እንዲሰሩ ቢጠየቁ የኢትዮጲያ አሠሪና ሠራተኛ ህግ ባወጣው የትርፍ ሰዓት አዋጅ  መሰረት ክፍያው ይፈጸማል ፡፡<br />
  5.   <strong><em><u>የሳምንት እረፍት ቀን</u></em></strong><br />
  በሳምንት ውስጥ አንድ የእረፍት ቀን ይኖርዎታል፡፡  የእረፍት ቀንዎ በመስሪያ ቤቱ የስራ ኘሮግራም መሰረት የሚወሰን ይሆናል፡፡<br />
  6   <strong><em><u>የህዝብ  በዓላት ክፍያ</u></em><u></u></strong><br />
  በድርጅቱ ኃ<span ge\0027ez-1="Ge\0027ez-1""'></span>ላፊዎች ታዘው በበዓላት እንዲሰሩ ቢጠየቁ የኢትዮጲያ አሠሪና ሠራተኛ አዋጅ 377/96 ባወጣው ህግ መሰረት ክፍያው ይፈጸማል፡፡</p>
<p>  7    <strong><em>የ<u>ተለያዩ  እረፍቶች</u></em></strong><u></u></p>
<ul>
  <li>በድርጅቱ ለአንድ ዓመት ከሰሩ በኋላ ለ14 ቀናት እረፍት  ይኖሮታል፡፡እረፍቱም በድርጅቱ የስራ ኘሮግራም ተፈጻሚ ይሆናል፡፡</li>
  <li>በድርጅቱ የውስጥ ደንብ መሰረት የህክምና ወጪዎን ድርጅቱ  ይሸፍናል፡፡ </li>
</ul>
<p>&nbsp;</p>
<p><strong>   8    <u>የወር ደመወዝ</u></strong></p>
<p><span ge\0027ez-1="Ge\0027ez-1""'>ከግብር  በፊት በወር  </span>ብር <?php
            
       			 		$query  = "SELECT * FROM employee_personal_record";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					 if(isset($_GET['ID'] )){	
					if ($row['ID'] == $_GET['ID'])
					{
					
					
					echo " {$row['Salary']}</u></font>";
					
					}
					
					 }
					 }
				 ?>  (----------------------------------)  ደመወዝ ይከፈልዎታል፡፡ በተጨማሪም በየወሩ ብር <?php
            
       			 		$query  = "SELECT * FROM employee_personal_record";
						$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					 if(isset($_GET['ID'] )){	
					if ($row['ID'] == $_GET['ID'])
					{
					
					
					echo " {$row['Present_Allowance']}</u></font>";
					
					}
					
					 }
					 }
				 ?>
 (__________________ ብር) በሥራ ላይ የመገኘት  አበል (Present allowance)) ደመወዝም ሆነ አበል እ.ኤ.አ  በወሩ መጨረሻ ይከፈላል፡፡</p>
<p><strong>   9.<u> ጤናና ደኀንነትን በተመለከተ</u></strong></p>
<ul>
  <li>ድርጅቱ ለደህንነትዎ የሚሰጠዎትን አልባሳትና መሳሪያዎችን  በአግባቡ መጠቀምና ለድርጅቱ ሥራ ብቻ ማዋል፡፡</li>
  <li>ድርጅቱን እርስዎንና ሌሎችን ለአደጋ የሚያጋልጥ ሥራ  በድርጅቱ ቅጥር ግቢ ውስጥ አለማድረግ፡፡</li>
  <li>በተከለከለ ቦታ ምግብ መጠጥ ሲጋራ እና የመሣሠሉት  መጠቀም ክልክል ነው፡፡</li>
  <li>የድርጅቱን ንብረት  ያለ አግባብ አለመጠቀም፡፡          </li>
  <li>በድርጅቱና በሌሎች ላይ አደጋ ሊያስከትል ይችላል ብለው  የሚጠራጠሩት ነገር ካለ ወዲያውኑ ለቅርብ አለቃዎ ማሳወቅ፡፡</li>
  <li>የአካባቢውን አየር ንብረት ሊበክሉ የሚችሉ ነገሮችን  አለማድረግ፡፡</li>
</ul>
<p><strong>10. <u>የሥነ ምግባር ጉድለትን በተመለከተ</u></strong><br />
  <strong>  </strong>በድርጅቱ  ውስጥ ምንም ዓይነት የሥነ ምግባር ጉድለትና የድርጅቱን የውስጥ ህግ የሚጥስ ሠራተኛ በድርጅቱ የውስጥ ህግ መሰረት ቅጣት  ይሰጠዋል፡፡<br />
  <strong>11 <u>ሌሎች  </u></strong><br />
  በዚህ ውል ላለ ያልተጠቀሰ ማናቸውም ነረሮች የኀብረት  ስምምነት ካለ በነብረት ስምምነት ከሌለ በኢትዮጲያ ሠራተኛና አሠሪ ህግ መሰረት ተፈፃሚ ይሆናል፡፡<br />
  ከዚህ በላሐይ በተገለፀው መሰረት እኔ አቶ/ወ/ሮ/ወ/ሪት<u>                      </u>አምብቤና ተረድቼ በውሉ ውስጥ  ያሉትን ነገሮች በሙሉ በመስማማት ውሉን ፈርሜያለሁ፡፡<br />
  የሠራተኛው ፊርማ<u>                       </u>ቀን<u>                      </u><br />
  <u>በአደጋ ጊዜ የቅርብ ተጠሪ</u><br />
  ስም<u>                         </u><br />
  አድራሻ፡ የሥራ አድርሻ<u>                   </u><br />
  ቀበሌ<u>             </u>የቤት ቁጥር<u>                       </u><br />
  ስልክ ቁጥር<u>                     </u>                                          <br />
  <br />
<p align="right"> ከሰላምታ  ጋር<br />
  <br />
  አይችሉህም አበበ<br />
  የሰው  ኀይል አስተዳደር<strong><u></u></strong></p></p></strong></p>
</body>
</html>
