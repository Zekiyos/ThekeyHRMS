
<p><img src="../../Img/Company_logo.JPG"  alt="" width="70" height="40" />?????????????????????????????????????????????????????????????? <br />
    AQ ROSES PLC<br />
    P O Box 404 <br />
<u>ZEWAY</u>
</p>
<p>?Date:<u><?php echo date("d/m/Y"); ?></u><br />
To:<?php
$query = "SELECT * FROM total_deduction";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    if (isset($_GET['ID'])) {
        if ($row['ID'] == $_GET['ID']) {

            echo "<br><b><font size=\"+3\">" . "TO:  <u>" . "{$row['FirstName']}";
            echo " {$row['MiddelName']}";
            echo " {$row['LastName']}" . "</u></br></b></font>";
        }
    }
}
?></p>
<p>?<strong><u>?RE: Permanent Employment Contract</u></strong>?<br />
    We  are pleased to offer you a Permanent employment contract as a general worker in  the<strong> <?php
$query = "SELECT * FROM total_deduction";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    if (isset($_GET['ID'])) {
        if ($row['ID'] == $_GET['ID']) {


            echo " {$row['Department']}</u></font>";
        }
    }
}
?> </strong>section with a  probation period of forty five (45) days under  the terms and conditions of service stipulated below:<strong><u></u></strong></p>
<ul>
    <li><strong><u>Designation  and location of work</u></strong></li>
</ul>
<p>?????????? You will be  deployed to the <strong><?php
        $query = "SELECT * FROM recruitment";
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            if (isset($_GET['ID'])) {
                if ($row['ID'] == $_GET['ID']) {

                    echo "<br><b>Position:  <u><font size=\"+3\">";
                    echo " {$row['Position']}</u></font>";
                }
            }
        }
?> </strong>section  to perform the following duties:</p>
<?php
if (isset($_GET['ID'])) {
    $query = "SELECT `total_deduction`.ID,Job_Description,Job_Description_Amharic FROM `contract_letter` JOIN `total_deduction` ON Contract_letter.Department =`total_deduction`.Department "; //WHERE `employee_personal_record`.ID = ".$_GET['ID']."";
    $result = mysql_query($query);

    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

        if ($row['ID'] == $_GET['ID']) {

            echo "<br><b><font size=\"+3\">";
            echo " {$row['Job_Description']}</font>";
        }
    }
}
?>
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

<ul>
    <li><strong><u>Leave</u></strong></li>
    <li>On completion of one (1) year of service you  will be entitled to pro-rata leave at the rate of 14 days (fourteen days) for  every completed year of service, according to the labor proclamation 377/2003  section 76.</li>
    <li>Medical expenses and sick leave of the employee  will be covered by the company if the employee gets medication in Sher Hospital.  This facility is also available for the direct family (parents,  brothers/sisters, husband/wife, and children) of the employee, but these  expenses will not be covered by the employer.</li>
    <li>Maternity leave of three months will be granted  by the employer.</li>
    <li><strong><u>Payment  of wages</u></strong></li>
</ul>
<p>You are  entitled to a gross basic salary of birr <?php
$query = "SELECT * FROM total_deduction";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    if (isset($_GET['ID'])) {
        if ($row['ID'] == $_GET['ID']) {


            echo " {$row['Basic Salary']}</u></font>";
        }
    }
}
?> (----------------------------------) per month. In addition to this, you will  be paid birr <?php
    $query = "SELECT * FROM total_deduction";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        if (isset($_GET['ID'])) {
            if ($row['ID'] == $_GET['ID']) {


                echo " {$row['Present_Allowance_Amount']}</u></font>";
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
    <li><strong><u>Disciplinary offences at work</u></strong>????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????  In case of disciplinary offences during work at the company, the  employer will? decide disciplinary actions  according to the internal regulations of the company.</li>
    <li><strong><u>Others</u></strong></li>
</ul>
<p>In situations not mentioned in  this contract, the decision will be made based on the CBA. When no CBA is  available, the decision will be in accordance with the Ethiopian labor  proclamation.<br />
    I????????????????have read and understood the above contract terms and I  accept to be bound by this contract.<br />
    <br />
    Employee's signature???????Date????????..<br />
    <br />
    <strong><u>Contact  person in case of emergency</u></strong><br />
    Name??????????????<br />
    Address: occupation????????.<br />
    Kebele????House number??..<strong><u></u></strong><br />
    <strong>????????????????????? </strong>Telephone<strong>??????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????? </strong></p>
<p><strong>????????????????????????????????? ??????????????????????????????????????????????????????????????Yours  faithfully</strong></p>
<p align="right"><strong>????????????????????????????????????????????????????????????????????????????????????????????????????????????????????  ?????????????????????????????????????????????????????????????????????????????????????????????????????????????????</strong><strong> </strong><br />
    <strong> ????????????????????????????????????????????????????????????????????????????????????????Aychiluhim  Abebe??????????????????Human Resource Manager</strong><br />
<p align="left"><img src="../../Img/AQlogo.gif"  alt="" width="70" height="40" /></p>
<p>?? ?  ?? ??? ?/??/??/?<br />
    ?.?.? 4?4<br />
    ???<br />
    <br />
    ??<u><?php echo date("d/m/Y"); ?></u> <br />
<br />
?<u><?php
    $query = "SELECT * FROM total_deduction";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        if (isset($_GET['ID'])) {
            if ($row['ID'] == $_GET['ID']) {

                echo "<br><b><font size=\"+3\">" . "<u>" . "{$row['FirstName']}";
                echo " {$row['MiddelName']}";
                echo " {$row['LastName']}" . "</u></br></b></font>";
            }
        }
    }
?></u>? </p>
<p><u>?? ??? ?? ?????</u></p>
<p>? ?? ??? ?/??/??/?  ????? ???? ??? ???? ?????? ???? ???? ?? ???? ?? ??? ????? ???? ???? ?? ?????  ???? ??? ? <u><?php
    $query = "SELECT * FROM total_deduction";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        if (isset($_GET['ID'])) {
            if ($row['ID'] == $_GET['ID']) {


                echo " {$row['Department']}</u></font>";
            }
        }
    }
?></u> ???  ???  ??? ??? ????<span unicode1="Unicode1""'>?</span>?? ??? ?? ???? ???????? ???????<br />
1 <strong><u>??? ??</u></strong><strong><u><span unicode1="Unicode1""'>h</span></u></strong><strong> </strong><br />
<?php
if (isset($_GET['ID'])) {
    $query = "SELECT `total_deduction`.ID,Job_Description,Job_Description_Amharic FROM `contract_letter` JOIN `total_deduction` ON Contract_letter.Department =`total_deduction`.Department "; //WHERE `employee_personal_record`.ID = ".$_GET['ID']."";
    $result = mysql_query($query);

    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

        if ($row['ID'] == $_GET['ID']) {

            echo " {$row['Job_Description_Amharic']}</font>";
        }
    }
}
?>
<p><strong>? 2</strong>.? <strong><em><u>?? ?????? ??</u></em></strong><br />
    ?? ??? ?? ?.?.?. ? <u><?php echo date("d/m/Y"); ?></u>???? ??????<br />
3 <strong><em><u>??? ??? ?? ??</u></em></strong><br />
????? ??? 48 ??? ???? ??????????  ??? ????? ??? ??? ???? ??? ?? ????</p>
<ul>
    <li><strong><em><u>????  ??? ???</u></em></strong></li>
</ul>
<p>????? ?????  ??? ??? ??? ????? ???? ?????? ???? ???? ?? ???? ???? ??? ???  ???? ???? ????? ??<br />
    5.?? <strong><em><u>????? ???? ??</u></em></strong><br />
    ????? ??? ??? ????? ?? ????????  ????? ??? ????? ?? ??? ????? ???? ????? ??????<br />
    6?? <strong><em><u>????  ???? ???</u></em><u></u></strong><br />
    ????? ????? ??? ????? ????? ???? ?????? ???? ???? ??? 377/96 ???? ?? ???? ???? ???????</p>
<p>? 7??? <strong><em>?<u>????  ?????</u></em></strong><u></u></p>
<ul>
    <li>????? ???? ??? ??? ??? ?14 ??? ????  ???????????? ????? ??? ????? ???? ??????</li>
    <li>????? ???? ??? ???? ????? ???? ????  ??????? </li>
</ul>

<p><strong>?  8??? <u>??? ????</u></strong></p>
<p><span ge\0027ez-1="Ge\0027ez-1""'>????  ??? ???  </span>?? <?php
$query = "SELECT * FROM total_deduction";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    if (isset($_GET['ID'])) {
        if ($row['ID'] == $_GET['ID']) {


            echo " {$row['Basic Salary']}</u></font>";
        }
    }
}
?>  (----------------------------------)  ???? ????????? ?????? ???? ?? <?php
    $query = "SELECT * FROM total_deduction";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        if (isset($_GET['ID'])) {
            if ($row['ID'] == $_GET['ID']) {


                echo " {$row['Present_Allowance_Amount']}</u></font>";
            }
        }
    }
?>
    (__________________ ??) ??? ?? ?????  ??? (Present allowance)) ????? ?? ??? ?.?.?  ??? ???? ???????</p>
<p><strong>?? 9.<u> ??? ?????? ??????</u></strong></p>
<ul>
    <li>???? ??????? ??????? ?????? ???????  ????? ????? ????? ?? ?? ?????</li>
    <li>????? ?????? ???? ???? ?????? ??  ????? ??? ?? ??? ????????</li>
    <li>?????? ?? ??? ??? ??? ?? ??????  ???? ???? ????</li>
    <li>?????? ????? ?? ???? ????????????????? </li>
    <li>?????? ???? ?? ??? ?????? ???? ???  ??????? ??? ?? ????? ???? ???? ??????</li>
    <li>??????? ??? ???? ???? ???? ?????  ????????</li>
</ul>
<p><strong>10. <u>??? ???? ????? ??????</u></strong><br />
    <strong>? </strong>?????  ??? ??? ???? ??? ???? ????? ?????? ???? ?? ???? ???? ????? ???? ?? ???? ???  ???????<br />
    <strong>11 <u>???? </u></strong><br />
    ??? ?? ?? ?????? ????? ???? ?????  ????? ?? ????? ????? ??? ?????? ????? ??? ?? ???? ???? ??????<br />
    ??? ???? ?????? ???? ?? ??/?/?/?/??<u>????????????????????? </u>????? ???? ??? ???  ???? ???? ??? ?????? ??? ????????<br />
?????? ???<u>?????????????????????? </u>??<u>????????????????????? </u><br />
<u>???? ?? ???? ???</u><br />
??<u>???????????????????????? </u><br />
????? ??? ????<u>?????????????????? </u><br />
???<u>???????????? </u>??? ???<u>?????????????????????? </u><br />
??? ???<u>???????????????????? </u>????????????????????????????????????????? <br />
<br />
<p align="right"> ?????  ??<br />
    <br />
    ?????? ???<br />
    ???  ??? ??????<strong><u></u></strong></p></p></strong></p>?????????????????????????????????