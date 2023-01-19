<?php

class Personal_info {

    public function Basic_Info($IDNumber, $lang = NULL) {
        $queryBI = "SELECT * FROM employee_personal_record where ID='" . $IDNumber . "'";
        $resultBI = mysql_query($queryBI);
        $rowBI = mysql_fetch_array($resultBI);

        $age = $this->age($rowBI['Date_Birth'], "EC");
        $ExperienceYear = $this->age($rowBI['Date_Employement'], "GC");
        switch ($lang) {
            case "en":

                echo "<font color=\"#FF0000\">ID: {$rowBI['ID']} </font>";
                echo "<br/>Name: ";
                echo "{$rowBI['FirstName']} ";
                echo "{$rowBI['MiddelName']} ";
                echo "{$rowBI['LastName']} ";
                echo "</em> <br /><em>was born  ";
                echo "{$rowBI['Date_Birth']} ";

                echo " , {$age} Years Old.<br /> ";
                $sex = $rowBI['Sex'];
                if ($sex != "")
                    echo "{$sex}<br/> ";

                if ($rowBI['Martial_Status'] != "") {
                    echo "{$rowBI['Martial_Status']} ";
                }

                if ($rowBI['Spouse_Name'] != "") {
                    echo "with {$rowBI['Spouse_Name']}<br/> ";
                } else if ($rowBI['Martial_Status'] != "")
                    echo "<br/>";

                if ($rowBI['Children_number'] != "") {
                    echo "{$rowBI['FirstName']} has {$rowBI['Children_number']} ";
                    if ($rowBI['Children_number'] > 1)
                        echo "childern<br/>";
                    else
                        echo "child<br/>";

                    if ($rowBI['Name_Child'] != "")
                        echo "Name of Child: {$rowBI['Name_Child']} <br />";
                }

                if ($rowBI['Experience'] != "") {
                    echo "{$rowBI['Experience']} experienced.<br />";
                }

                if (isset($ExperienceYear)) {
                    echo "{$ExperienceYear} years experienced in this Company.<br />";
                }

                if ($rowBI['Email'] != "") {
                    echo "Email: <em> {$rowBI['Email']} <br />";
                }

                echo "employeed on<em> ";
                echo "{$rowBI['Date_Employement']} ";
                echo "in {$rowBI['Department']} ";
                echo "as {$rowBI['Position']} ";
                echo "<br>Monthly salary " . $rowBI['Salary'] . " birr ";
                echo "<br>Education Status " . $rowBI['Educational_Status'] . " ";
                break;
            case "am":

                echo "<font color=\"#FF0000\">ID: {$rowBI['ID']} </font>";
                echo "<br/>ስም: ";
                echo "{$rowBI['FirstName']} ";
                echo "{$rowBI['MiddelName']} ";
                echo "{$rowBI['LastName']} ";
                echo "</em> <br /><em> የተወለደው  ";
                echo "{$rowBI['Date_Birth']} ";

                echo " , {$age} አመቱ(ቷ) ነው፡፡<br /> ";
                $sex = $rowBI['Sex'];
                echo "{$rowBI['Sex']}<br/> ";

                if ($rowBI['Experience'] != "") {
                    echo "የስራ ልምድ  {$rowBI['Experience']} <br />";
                }
                if ($rowBI['Email'] != "") {
                    echo "ኢሜል: <em> {$rowBI['Email']} <br />";
                }

                echo "የተቀጠረው(ችው) በቀን<em> ";
                echo "{$rowBI['Date_Employement']} ";
                echo "በ  {$rowBI['Department']} ";
                echo "እንደ {$rowBI['Position']} ሰራተኝነት";
                echo "<br>የወር ደመወዝ  " . $rowBI['Salary'] . " ብር ";
                echo "<br>የትምህርት ደረጃ " . $rowBI['Educational_Status'] . " ";
                break;
            case "nl":

                echo "<font color=\"#FF0000\">ID: {$rowBI['ID']} </font>";
                echo "<br/>Naam: ";
                echo "{$rowBI['FirstName']} ";
                echo "{$rowBI['MiddelName']} ";
                echo "{$rowBI['LastName']} ";
                echo "</em> <br /><em>werd geboren in  ";
                echo "{$rowBI['Date_Birth']} ";

                echo " , {$age} Leeftijd.<br /> ";
                $sex = $rowBI['Sex'];
                echo "{$rowBI['Sex']}<br/> ";

                if ($rowBI['Experience'] != "") {
                    echo "Werkervaring: {$rowBI['Experience']}<br />";
                }
                if ($rowBI['Email'] != "") {
                    echo "Email: <em> {$rowBI['Email']} <br />";
                }

                echo "werkzaam zijn op<em> ";
                echo "{$rowBI['Date_Employement']} ";
                echo "in {$rowBI['Department']} ";
                echo "as {$rowBI['Position']} ";
                echo "<br>Maandsalaris " . $rowBI['Salary'] . " birr ";
                echo "<br>Educatieve Status " . $rowBI['Educational_Status'] . " ";
                break;
            case "or":

                echo "<font color=\"#FF0000\">ID: {$rowBI['ID']} </font>";
                echo "<br/>Maqaa: ";
                echo "{$rowBI['FirstName']} ";
                echo "{$rowBI['MiddelName']} ";
                echo "{$rowBI['LastName']} ";
                echo "</em> <br /><em>bara dhaloota  ";
                echo "{$rowBI['Date_Birth']} ";

                echo " , {$age} Umrii.<br /> ";
                $sex = $rowBI['Sex'];
                echo "{$rowBI['Sex']}<br/> ";

                if ($rowBI['Experience'] != "") {
                    echo "{$rowBI['Experience']} Muxxaannoo Qaba <br />";
                }
                if ($rowBI['Email'] != "") {
                    echo "Imalii: <em> {$rowBI['Email']} <br />";
                }

                echo "Bara Qacarri<em> ";
                echo "{$rowBI['Date_Employement']} ";
                echo "Kutaa hojjii {$rowBI['Department']} ";
                echo "Gosa Hojjii {$rowBI['Position']} ";
                echo "<br>Mindaa Ji'aan " . $rowBI['Salary'] . " birr ";
                echo "<br>Sarkaa barumsaa: " . $rowBI['Educational_Status'] . " ";
                break;
        }
    }

    public function Leaves($IDNumber, $lang = NULL) {
        /*         * *********        Annual Leave             ******** */
        $queryAL = "SELECT * FROM annual_leave where ID='" . $IDNumber . "'";
        $resultAL = mysql_query($queryAL);
        while ($rowAL = mysql_fetch_array($resultAL, MYSQL_ASSOC)) {
            switch ($lang) {
                case "en":
                    echo " <li>Number Of Annual leave " . $rowAL['FirstName'] . " tooks";
                    echo " {$rowAL['Leavedays']} ";
                    echo "days on" . " {$rowAL['Leave_Taken_Date']} till {$rowAL['ReportOn']} " . "<br/>";
                    break;
                case "am":
                    echo " <li>" . $rowAL['FirstName'] . " የወሰደው(ችው) የአመት እረፍት ";
                    echo " {$rowAL['Leavedays']} ";
                    echo "ቀናት በ " . " {$rowAL['Leave_Taken_Date']} እስከ {$rowAL['ReportOn']} " . "<br/>";
                    break;
                case "nl":
                    echo " <li>Aantal van de jaarlijkse vakantie " . $rowAL['FirstName'] . " tooks";
                    echo " {$rowAL['Leavedays']} ";
                    echo "dagen op " . " {$rowAL['Leave_Taken_Date']} till {$rowAL['ReportOn']} " . "<br/>";
                    break;
                case "or":
                    echo " <li>Baay'inaa hayyamaa waggaa" . $rowAL['FirstName'] . " fudhaate";
                    echo " {$rowAL['Leavedays']} ";
                    echo "guyyoota " . " {$rowAL['Leave_Taken_Date']} hanga {$rowAL['ReportOn']} " . "<br/>";
                    break;
            }
        }

        /*         * *********        Sick Leave             ******** */
        $querySL = "SELECT * FROM sick_leave where ID='" . $IDNumber . "'";
        $resultSL = mysql_query($querySL);

        while ($rowSL = mysql_fetch_array($resultSL, MYSQL_ASSOC)) {
            switch ($lang) {
                case "en":
                    echo " <li>Number Of Sick leave " . $rowSL['FirstName'] . " tooks ";
                    echo "{$rowSL['SickLeaveDays']} ";
                    echo "on" . " {$rowSL['SickLeave_Taken_Date']} till {$rowSL['ReportOn']} ";
                    break;
                case "am":
                    echo " <li>" . $rowSL['FirstName'] . " የወሰደው(ችው) የሕመም ፍቃድ ";
                    echo "{$rowSL['SickLeaveDays']} ";
                    echo "ቀናት በ " . " {$rowSL['SickLeave_Taken_Date']} እስከ {$rowSL['ReportOn']} ";
                    break;
                case "nl":
                    echo " <li>Aantal van ziekteverlof " . $rowSL['FirstName'] . " tooks ";
                    echo "{$rowSL['SickLeaveDays']} ";
                    echo "dagen op " . " {$rowSL['SickLeave_Taken_Date']} till {$rowSL['ReportOn']} ";
                    break;
                case "or":
                    echo " <li>Baay'inaa hayyamaa Dhukabbii " . $rowSL['FirstName'] . " fudhate ";
                    echo "{$rowSL['SickLeaveDays']} ";
                    echo "guyyoota " . " {$rowSL['SickLeave_Taken_Date']} hanga {$rowSL['ReportOn']} ";
                    break;
            }
        }

        /*         * *********        Maternity Leave             ******** */
        $queryML = "SELECT * FROM Maternity_leave where ID='" . $IDNumber . "'";
        $resultML = mysql_query($queryML);
        while ($rowML = mysql_fetch_array($resultML, MYSQL_ASSOC)) {
            switch ($lang) {
                case "en":
                    echo "<br> <li>Number Of Maternity leave " . $rowML['FirstName'] . " tooks ";
                    echo "{$rowML['MaternityLeaveDays']} ";
                    echo "on " . " {$rowML['MaternityLeave_Taken_Date']} till {$rowML['ReportOn']} ";
                    break;
                case "am":
                    echo "<br> <li>" . $rowML['FirstName'] . " የወሰደው(ችው) የወሊድ ፍቃድ ";
                    echo "{$rowML['MaternityLeaveDays']} ";
                    echo "ቀናት በ  " . " {$rowML['MaternityLeave_Taken_Date']} እስከ {$rowML['ReportOn']} ";
                    break;
                case "nl":
                    echo "<br> <li>Aantal van het zwangerschapsverlof " . $rowML['FirstName'] . " tooks ";
                    echo "{$rowML['MaternityLeaveDays']} ";
                    echo "dagen op " . " {$rowML['MaternityLeave_Taken_Date']} till {$rowML['ReportOn']} ";
                    break;
                case "or":
                    echo "<br> <li>Baay'inaa hayyamaa Daa'umsaa " . $rowML['FirstName'] . " fudhate ";
                    echo "{$rowML['MaternityLeaveDays']} ";
                    echo "guyyoota " . " {$rowML['MaternityLeave_Taken_Date']} hanga {$rowML['ReportOn']} ";
                    break;
            }
        }
        /*         * *********        Wedding Leave             ******** */
        $queryWL = "SELECT * FROM paternity_leave where ID='" . $IDNumber . "'";
        $resultWL = mysql_query($queryWL);
        while ($rowWL = mysql_fetch_array($resultWL, MYSQL_ASSOC)) {
            switch ($lang) {
                case "en":
                    echo "<br> <li>Number Of Paternity leave " . $rowWL['FirstName'] . " tooks ";
                    echo "{$rowWL['PaternityLeaveDays']} ";
                    echo "on " . "{$rowWL['PaternityLeave_Taken_Date']} till {$rowWL['ReportOn']} ";
                    break;
                case "am":
                    echo "<br> <li>" . $rowWL['FirstName'] . " የወሰደው(ችው) የአባትነት ፍቃድ ";
                    echo "{$rowWL['PaternityLeaveDays']} ";
                    echo "ቀናት በ " . "{$rowWL['PaternityLeave_Taken_Date']} እስከ {$rowWL['ReportOn']} ";
                    break;
                case "nl":
                    echo "<br> <li>Number Of Paternity leave " . $rowWL['FirstName'] . " tooks ";
                    echo "{$rowWL['PaternityLeaveDays']} ";
                    echo "dagen op " . "{$rowWL['PaternityLeave_Taken_Date']} till {$rowWL['ReportOn']} ";
                    break;
                case "or":
                    echo "<br> <li>Baay'inaa hayyamaa Abbuummaa " . $rowWL['FirstName'] . " fudhate ";
                    echo "{$rowWL['PaternityLeaveDays']} ";
                    echo "guyyoota " . "{$rowWL['PaternityLeave_Taken_Date']} hanga {$rowWL['ReportOn']} ";
                    break;
            }
        }
        /*         * *********        Funeral Leave             ******** */
        $queryFL = "SELECT * FROM Funeral_leave where ID='" . $IDNumber . "'";
        $resultFL = mysql_query($queryFL);
        while ($rowFL = mysql_fetch_array($resultFL, MYSQL_ASSOC)) {
            switch ($lang) {
                case "en":
                    echo "<br> <li>Number Of Funeral leave " . $rowFL['FirstName'] . " tooks ";
                    echo "{$rowFL['FuneralLeaveDays']} ";
                    echo "on " . "{$rowFL['FuneralLeave_Taken_Date']} till {$rowFL['ReportOn']} ";
                    break;
                case "am":
                    echo "<br> <li>" . $rowFL['FirstName'] . " የወሰደው(ችው) የቀብር ፈቃድ ";
                    echo "{$rowFL['FuneralLeaveDays']} ";
                    echo "ቀናት በ " . "{$rowFL['FuneralLeave_Taken_Date']} እስከ {$rowFL['ReportOn']} ";
                    break;
                case "nl":
                    echo "<br> <li>Aantal van de begrafenis te verlaten " . $rowFL['FirstName'] . " tooks ";
                    echo "{$rowFL['FuneralLeaveDays']} ";
                    echo "dagen op " . "{$rowFL['FuneralLeave_Taken_Date']} till {$rowFL['ReportOn']} ";
                    break;
                case "or":
                    echo "<br> <li>Baay'inaa hayyamaa Gadgaa " . $rowFL['FirstName'] . " fudhate ";
                    echo "{$rowFL['FuneralLeaveDays']} ";
                    echo "guyyoota " . "{$rowFL['FuneralLeave_Taken_Date']} hanga {$rowFL['ReportOn']} ";
                    break;
            }
        }
        /*         * *********        Wedding Leave             ******** */
        $queryWL = "SELECT * FROM Wedding_leave where ID='" . $IDNumber . "'";
        $resultWL = mysql_query($queryWL);
        while ($rowWL = mysql_fetch_array($resultWL, MYSQL_ASSOC)) {
            switch ($lang) {
                case "en":
                    echo "<br> <li>Number Of Wedding leave " . $rowWL['FirstName'] . " tooks ";
                    echo "{$rowWL['WeddingLeavedays']} ";
                    echo "on " . "{$rowWL['WeddingLeave_TakenDate']} till {$rowWL['ReportOn']} ";
                    break;
                case "am":
                    echo "<br> <li>" . $rowWL['FirstName'] . " የወሰደው(ችው) የጋብቻ ፍቃድ ";
                    echo "{$rowWL['WeddingLeavedays']} ";
                    echo "ቀናት በ " . "{$rowWL['WeddingLeave_TakenDate']} እስከ {$rowWL['ReportOn']} ";
                    break;
                case "nl":
                    echo "<br> <li>Aantal vertrekken van de bruiloft " . $rowWL['FirstName'] . " tooks ";
                    echo "{$rowWL['WeddingLeavedays']} ";
                    echo "dagen op " . "{$rowWL['WeddingLeave_TakenDate']} till {$rowWL['ReportOn']} ";
                    break;
                case "or":
                    echo "<br> <li>Baay'inaa hayyamaa Cidhaa " . $rowWL['FirstName'] . " fudhate ";
                    echo "{$rowWL['WeddingLeavedays']} ";
                    echo "guyyoota " . "{$rowWL['WeddingLeave_TakenDate']} hanga {$rowWL['ReportOn']} ";
                    break;
            }
        }

        /*         * *********        Special Leave             ******** */
        $querySPL = "SELECT * FROM Special_leave where ID='" . $IDNumber . "'";
        $resultSPL = mysql_query($querySPL);
        while ($rowSPL = mysql_fetch_array($resultSPL, MYSQL_ASSOC)) {
            switch ($lang) {
                case "en":
                    echo "<br> <li>Number Of {$rowSPL['LeaveType']} " . $rowSPL['FirstName'] . " tooks ";
                    echo "{$rowSPL['SpecialLeaveDays']} ";
                    echo "on " . "{$rowSPL['SpecialLeave_Taken_Date']} till {$rowSPL['ReportOn']} ";
                    break;
                case "am":
                    echo "<br> <li>" . $rowSPL['FirstName'] . " የወሰደው(ችው) የሌሎች ፍቃድ ";
                    echo "{$rowSPL['SpecialLeaveDays']} ";
                    echo "ቀናት በ " . "{$rowSPL['SpecialLeave_Taken_Date']} እስከ {$rowSPL['ReportOn']} ";
                    break;
                case "nl":
                    echo "<br> <li>Number Of {$rowSPL['LeaveType']} " . $rowSPL['FirstName'] . " tooks ";
                    echo "{$rowSPL['SpecialLeaveDays']} ";
                    echo "dagen op " . "{$rowSPL['SpecialLeave_Taken_Date']} till {$rowSPL['ReportOn']} ";
                    break;
                case "or":
                    echo "<br> <li>Baay'inaa hayyamaa Addaa " . $rowSPL['FirstName'] . " fudhate ";
                    echo "{$rowSPL['SpecialLeaveDays']} ";
                    echo "guyyoota " . "{$rowSPL['SpecialLeave_Taken_Date']} hanga {$rowSPL['ReportOn']} ";
                    break;
            }
        }
    }

    /*     * *********        Equipment Handover            ******** */

    public function Equipment($IDNumber, $lang = NULL) {
        $queryEQ = "SELECT * FROM equipment_handover where ID='" . $IDNumber . "'";
        $resultEQ = mysql_query($queryEQ);
        while ($rowEQ = mysql_fetch_array($resultEQ, MYSQL_ASSOC)) {
            switch ($lang) {
                case "en":
                    echo "</blockquote></blockquote><blockquote><blockquote><blockquote><b><u>Equipments</b></blockquote></u></blockquote></blockquote><li type=\"circle\">{$rowEQ['FirstName']} took ";
                    echo "{$rowEQ['EquipmentName']} on date {$rowEQ['Taken_Date']}.It should be replaced on<font color=\"#FF0000\"> {$rowEQ['Replacement_Date']} </font>";

                    break;
                case "am":
                    echo "</blockquote></blockquote><blockquote><blockquote><blockquote><b><u>የተወሰደ እቃ</b></blockquote></u></blockquote></blockquote><li type=\"circle\">{$rowEQ['FirstName']} took ";
                    echo "{$rowEQ['EquipmentName']} እቃ በቀን {$rowEQ['Taken_Date']} ወስዶል::በቀን<font color=\"#FF0000\"> {$rowEQ['Replacement_Date']}  ሊተካ ይገባል</font>";

                    break;
                case "nl":
                    echo "</blockquote></blockquote><blockquote><blockquote><blockquote><b><u>Apparatuur</b></blockquote></u></blockquote></blockquote><li type=\"circle\">{$rowEQ['FirstName']} took ";
                    echo "{$rowEQ['EquipmentName']} on date {$rowEQ['Taken_Date']}.It should be replaced on<font color=\"#FF0000\"> {$rowEQ['Replacement_Date']} </font>";

                    break;
                case "or":
                    echo "</blockquote></blockquote><blockquote><blockquote><blockquote><b><u>Meeshaa</b></blockquote></u></blockquote></blockquote><li type=\"circle\">{$rowEQ['FirstName']}ni ";
                    echo "{$rowEQ['EquipmentName']} guyyaa {$rowEQ['Taken_Date']} fudhate.Guyyaa <font color=\"#FF0000\"> {$rowEQ['Replacement_Date']} </font> deebisu qaba(di).";

                    break;
            }
        }
    }

    /*     * *********        Training          ******** */

    public function Training($IDNumber, $lang = NULL) {
        $queryTR = "SELECT * FROM training where ID='" . $IDNumber . "'";
        $resultTR = mysql_query($queryTR);
        while ($rowTR = mysql_fetch_array($resultTR, MYSQL_ASSOC)) {
            switch ($lang) {
                case "en":

                    echo "</u></blockquote></blockquote><blockquote><blockquote><blockquote><b><u>Training</u></b></blockquote></blockquote></blockquote> <li type=\"circle\">{$rowTR['FirstName']} took ";
                    if ($rowTR['TrainingName'] != "")
                        echo "{$rowTR['TrainingName']} training from {$rowTR['Training_Start_Date']} to {$rowTR['Training_End_Date']}  and  he/she  {$rowTR['Status']} the training.";

                    break;
                case "am":
                    echo "</u></blockquote></blockquote><blockquote><blockquote><blockquote><b><u>ስልጠና</u></b></blockquote></blockquote></blockquote> <li type=\"circle\">{$rowTR['FirstName']} ";
                    echo "የ {$rowTR['TrainingName']}  ስልጠና ከቀን {$rowTR['Training_Start_Date']} እስከ ቀን {$rowTR['Training_End_Date']} ወስዶል ::";
                    if ($rowTR['Status'] != "Complete")
                        echo "ግን ስልጠናውን አቆርጦል::";
                    else
                        echo "ስልጠናውንም አጠናቆል::";

                    break;
                case "nl":
                    echo "</u></blockquote></blockquote><blockquote><blockquote><blockquote><b><u>Opleiding</u></b></blockquote></blockquote></blockquote> <li type=\"circle\">{$rowTR['FirstName']} took ";
                    echo "{$rowTR['TrainingName']} training from {$rowTR['Training_Start_Date']} to {$rowTR['Training_End_Date']}  and  he/she  {$rowTR['Status']} the training.";

                    break;
                case "or":
                    echo "</u></blockquote></blockquote><blockquote><blockquote><blockquote><b><u>Leenjii</u></b></blockquote></blockquote></blockquote> <li type=\"circle\">{$rowTR['FirstName']}ni ";
                    echo "{$rowTR['TrainingName']} iratti leenjii {$rowTR['Training_Start_Date']} irra {$rowTR['Training_End_Date']} fudhaate.";
                    if ($rowTR['Status'] != "Complete")
                        echo "Leenjii addaan kutee";
                    else
                        echo "Leenjii xumure";

                    break;
            }
        }
    }

    public function Disciplinary_Action($IDNumber, $lang = NULL) {
        $queryDA = "SELECT * FROM Disciplinary_action where ID='" . $IDNumber . "'";
        $resultDA = mysql_query($queryDA);
        while ($rowDA = mysql_fetch_array($resultDA, MYSQL_ASSOC)) {
            switch ($lang) {
                case "en":
                    echo "<blockquote><blockquote><blockquote> <b><u>Discipline Action</u></blockquote></blockquote></blockquote> </b>";
                    echo " " . $rowDA['FirstName'] . " Receive:- <br>";
                    if ($rowDA['First_Inistance'] != "") {
                        echo "<blockquote><blockquote><li type=\"Square\"><a href=\"../Letters/warning Letters/Warning_Letters_Viewer.php?ID=$IDNumber&WarningType=First Inistance Warning\" target=\"_blank\"> First Instance Warning</a> ";
                    }
                    if ($rowDA['Second_Inistance'] != "") {
                        echo "<li type=\"Square\"><a href=\"../Letters/warning Letters/Warning_Letters_Viewer.php?ID=$IDNumber&WarningType=Second Inistance Warning\" target=\"_blank\"> Second Instance Warning </a>";
                    }
                    if ($rowDA['Third_Inistance'] != "") {
                        echo "<li type=\"Square\"><a href=\"../Letters/warning Letters/Warning_Letters_Viewer.php?ID=$IDNumber&WarningType=Third Inistance Warning\" target=\"_blank\"> Third Instance Warning </a>";
                    }
                    if ($rowDA['Last_Warning'] != "") {
                        echo "<li type=\"Square\"><a href=\"../Letters/warning Letters/Warning_Letters_Viewer.php?ID=$IDNumber&WarningType=Last Warning\" target=\"_blank\"> Last Warning </a></blockquote></blockquote>";
                    }
                    break;
                case "am":
                    echo "<blockquote><blockquote><blockquote> <b><u>ማስጠንቀቂያ</u></blockquote></blockquote></blockquote> </b>";
                    echo " " . $rowDA['FirstName'] . " Receive:- <br>";
                    if ($rowDA['First_Inistance'] != "") {
                        echo "<blockquote><blockquote><li type=\"Square\"><a href=\"../Letters/warning Letters/Warning_Letters_Viewer.php?ID=$IDNumber&WarningType=First Inistance Warning\" target=\"_blank\"> የመጀመሪያ ደረጃ</a> ";
                    }
                    if ($rowDA['Second_Inistance'] != "") {
                        echo "<li type=\"Square\"><a href=\"../Letters/warning Letters/Warning_Letters_Viewer.php?ID=$IDNumber&WarningType=Second Inistance Warning\" target=\"_blank\"> የሁለተኛ ደረጃ</a> ";
                    }
                    if ($rowDA['Third_Inistance'] != "") {
                        echo "<li type=\"Square\"> <a href=\"../Letters/warning Letters/Warning_Letters_Viewer.php?ID=$IDNumber&WarningType=Third Inistance Warning\" target=\"_blank\">ሶስተኛ ደረጃ </a>";
                    }
                    if ($rowDA['Last_Warning'] != "") {
                        echo "<li type=\"Square\"><a href=\"../Letters/warning Letters/Warning_Letters_Viewer.php?ID=$IDNumber&WarningType=Last Warning\" target=\"_blank\"> የመጨረሻ መስጠንቀቂያ</a></blockquote></blockquote>";
                    }
                    break;
                case "nl":
                    echo "<blockquote><blockquote><blockquote> <b><u>Disciplinaire Maatregelen</u></blockquote></blockquote></blockquote> </b>";
                    echo " " . $rowDA['FirstName'] . " Receive:- <br>";
                    if ($rowDA['First_Inistance'] != "") {
                        echo "<blockquote><blockquote><li type=\"Square\"><a href=\"../Letters/warning Letters/Warning_Letters_Viewer.php?ID=$IDNumber&WarningType=First Inistance Warning\" target=\"_blank\"> First Instance Warning</a> ";
                    }
                    if ($rowDA['Second_Inistance'] != "") {
                        echo "<li type=\"Square\"><a href=\"../Letters/warning Letters/Warning_Letters_Viewer.php?ID=$IDNumber&WarningType=Second Inistance Warning\" target=\"_blank\"> Second Instance Warning </a>";
                    }
                    if ($rowDA['Third_Inistance'] != "") {
                        echo "<li type=\"Square\"><a href=\"../Letters/warning Letters/Warning_Letters_Viewer.php?ID=$IDNumber&WarningType=Third Inistance Warning\" target=\"_blank\"> Third Instance Warning </a>";
                    }
                    if ($rowDA['Last_Warning'] != "") {
                        echo "<li type=\"Square\"><a href=\"../Letters/warning Letters/Warning_Letters_Viewer.php?ID=$IDNumber&WarningType=Last Warning\" target=\"_blank\"> Last Warning </a></blockquote></blockquote>";
                    }
                    break;
                case "or":
                    echo "<blockquote><blockquote><blockquote> <b><u>Offeeggannoo</u></blockquote></blockquote></blockquote> </b>";
                    echo " " . $rowDA['FirstName'] . " fudhaate:- <br>";
                    if ($rowDA['First_Inistance'] != "") {
                        echo "<blockquote><blockquote><li type=\"Square\"><a href=\"../Letters/warning Letters/Warning_Letters_Viewer.php?ID=$IDNumber&WarningType=First Inistance Warning\" target=\"_blank\"> Ofeeggannoo Dursaa</a> ";
                    }
                    if ($rowDA['Second_Inistance'] != "") {
                        echo "<li type=\"Square\"><a href=\"../Letters/warning Letters/Warning_Letters_Viewer.php?ID=$IDNumber&WarningType=Second Inistance Warning\" target=\"_blank\"> Ofeeggannoo Lamaaffaa  </a>";
                    }
                    if ($rowDA['Third_Inistance'] != "") {
                        echo "<li type=\"Square\"><a href=\"../Letters/warning Letters/Warning_Letters_Viewer.php?ID=$IDNumber&WarningType=Third Inistance Warning\" target=\"_blank\"> Ofeeggannoo Sadaaffaa </a>";
                    }
                    if ($rowDA['Last_Warning'] != "") {
                        echo "<li type=\"Square\"><a href=\"../Letters/warning Letters/Warning_Letters_Viewer.php?ID=$IDNumber&WarningType=Last Warning\" target=\"_blank\"> Ofeeggannoo Dhumaa </a></blockquote></blockquote>";
                    }
                    break;
            }
        }
    }

    public function Job_Description($IDNumber, $lang = NULL) {
        $queryJB = "SELECT `employee_personal_record`.ID,Job_Description,Job_Description_Amharic FROM `contract_letter` JOIN `employee_personal_record` ON Contract_letter.Department =`employee_personal_record`.Department WHERE `employee_personal_record`.ID = '" . $IDNumber . "'";

        $resultJB = mysql_query($queryJB);
        while ($rowJB = mysql_fetch_array($resultJB, MYSQL_ASSOC)) {
            switch ($lang) {
                case "en":
                    echo "<blockquote><blockquote><blockquote> <b><u>Job Description</u></blockquote></blockquote></blockquote> </b>";
                    echo "{$rowJB['Job_Description']} ";
                    break;
                case "am":
                    echo "<blockquote><blockquote><blockquote> <b><u>Job Description</u></blockquote></blockquote></blockquote> </b>";
                    echo "{$rowJB['Job_Description']} ";
                    break;
                case "nl":
                    echo "<blockquote><blockquote><blockquote> <b><u>Job Description</u></blockquote></blockquote></blockquote> </b>";
                    echo "{$rowJB['Job_Description']} ";
                    break;
                case "or":
                    echo "<blockquote><blockquote><blockquote> <b><u>Job Description</u></blockquote></blockquote></blockquote> </b>";
                    echo "{$rowJB['Job_Description']} ";
                    break;
            }
        }
    }

    /*     * **********************Emergency Contact****************************** */

    public function Emergency_Contact($IDNumber, $lang = NULL) {
        $queryEC = "SELECT * FROM `employee_personal_record`  WHERE `employee_personal_record`.ID = '" . $IDNumber . "'";

        $resultEC = mysql_query($queryEC);
        while ($rowEC = mysql_fetch_array($resultEC, MYSQL_ASSOC)) {
            switch ($lang) {
                case "en":
                    echo "<blockquote><blockquote><blockquote> <b><u>Emergency Contact</u></blockquote></blockquote></blockquote> </b>";
                    echo "Emergency Contact: {$rowEC['Contact_Emergency']} <br/>";

                    echo "Contact Relation: {$rowEC['Contact_Relation']} <br/>";

                    echo "Contact Address: {$rowEC['Contact_Address']} <br/>";
                    break;
                case "am":
                    echo "<blockquote><blockquote><blockquote> <b><u>Emergency Contact</u></blockquote></blockquote></blockquote> </b>";
                    echo "Emergency Contact: {$rowEC['Contact_Emergency']} <br/>";

                    echo "Contact Relation: {$rowEC['Contact_Relation']} <br/>";

                    echo "Contact Address: {$rowEC['Contact_Address']} <br/>";
                    break;
                case "nl":
                    echo "<blockquote><blockquote><blockquote> <b><u>Emergency Contact</u></blockquote></blockquote></blockquote> </b>";
                    echo "Emergency Contact: {$rowEC['Contact_Emergency']} <br/>";

                    echo "Contact Relation: {$rowEC['Contact_Relation']} <br/>";

                    echo "Contact Address: {$rowEC['Contact_Address']} <br/>";
                    break;
                case "or":
                    echo "<blockquote><blockquote><blockquote> <b><u>Emergency Contact</u></blockquote></blockquote></blockquote> </b>";
                    echo "Emergency Contact: {$rowEC['Contact_Emergency']} <br/>";

                    echo "Contact Relation: {$rowEC['Contact_Relation']} <br/>";

                    echo "Contact Address: {$rowEC['Contact_Address']} <br/>";
                    break;
            }
        }
    }

    /*     * ************************************************** */

    public function HardCopy_Location($IDNumber, $lang = NULL) {
        $query = "SELECT * FROM employee_personal_record where ID='" . $IDNumber . "'";
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            switch ($lang) {
                case "en":
                    echo "<br></blockquote></blockquote><font color=\"#FF6600\" size=\"+1\">Hard Copy file exist in :";
                    echo "{$row['HardCopy_Shelf_No']}</font> ";
                    break;
                case "am":
                    echo "<br></blockquote></blockquote><font color=\"#FF6600\" size=\"+1\">ፈይሉን በ :";
                    echo "{$row['HardCopy_Shelf_No']}</font> ያገኙታል፡፡";
                    break;
                case "nl":
                    echo "<br></blockquote></blockquote><font color=\"#FF6600\" size=\"+1\">Hard Copy file exist in :";
                    echo "{$row['HardCopy_Shelf_No']}</font> ";
                    break;
                case "or":
                    echo "<br></blockquote></blockquote><font color=\"#FF6600\" size=\"+1\">faayilii bakka kana :";
                    echo "{$row['HardCopy_Shelf_No']}</font> Argatu. ";
                    break;
            }
        }
    }

    ////////////////////////***************

    public function age($DateofBirth, $Calender = NULL) {


        if ($Calender == "EC") {
            if (date('m') < 10) {

                $currentEC = mktime(0, 0, 0, date("m") + 4, date("d") + 10, date('Y') - 8);
                $current = date("Y-m-d", $currentEC);
            } else {
                $currentEC = mktime(0, 0, 0, date("m") - 10, date("d") + 10, date('Y') - 8);
                $current = date("Y-m-d", $currentEC);
            }
        } else {
            $current = date('Y-m-d');
        }
        $yeardiff = $this->datediff('yyyy', $DateofBirth, $current, false);
        $monthdiff = $this->datediff('m', $DateofBirth, $current, false);
        $datediff1 = $this->datediff('d', $DateofBirth, $current, false);

        return $yeardiff;
    }

    public function datediff($interval, $datefrom, $dateto, $using_timestamps = false) {
        /* $interval can be: yyyy - Number of full years 
          q - Number of full quarters
          m - Number of full months
          y - Difference between day numbers (eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".)
          d - Number of full days
          w - Number of full weekdays
          ww - Number of full weeks
          h - Number of full hours
          n - Number of full minutes
          s - Number of full seconds (default) */
        if (!$using_timestamps) {
            $datefrom = strtotime($datefrom, 0);
            $dateto = strtotime($dateto, 0);
        } $difference = $dateto - $datefrom;
        // Difference in seconds
        switch ($interval) {
            case 'yyyy':
                // Number of full years 
                $years_difference = floor($difference / 31536000);
                if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom) + $years_difference) > $dateto) {
                    $years_difference--;
                } if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto) - ($years_difference + 1)) > $datefrom) {
                    $years_difference++;
                } $datediff = $years_difference;
                break;
            case "q": // Number of full quarters 
                $quarters_difference = floor($difference / 8035200);
                while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom) + ($quarters_difference * 3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
                    $months_difference++;
                } $quarters_difference--;
                $datediff = $quarters_difference;
                break;
            case "m": // Number of full months 
                $months_difference = floor($difference / 2678400);
                while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom) + ($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
                    $months_difference++;
                } $months_difference--;
                $datediff = $months_difference;
                break;
            case 'y': // Difference between day numbers 
                $datediff = date("z", $dateto) - date("z", $datefrom);
                break;
            case "d": // Number of full days 
                $datediff = floor($difference / 86400);
                break;
            case "w": // Number of full weekdays 
                $days_difference = floor($difference / 86400);
                $weeks_difference = floor($days_difference / 7);  // Complete weeks 
                $first_day = date("w", $datefrom);
                $days_remainder = floor($days_difference % 7);
                $odd_days = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder? 
                if ($odd_days > 7) {  // Sunday 
                    $days_remainder--;
                } if ($odd_days > 6) {
                    // Saturday
                    $days_remainder--;
                } $datediff = ($weeks_difference * 5) + $days_remainder;
                break;
            case "ww": // Number of full weeks 
                $datediff = floor($difference / 604800);
                break;
            case "h": // Number of full hours 
                $datediff = floor($difference / 3600);
                break;
            case "n": // Number of full minutes 
                $datediff = floor($difference / 60);
                break;
            default: // Number of full seconds  (default) 
                $datediff = $difference;
                break;
        } return $datediff;
    }

    //////////////////////////*************
}

//Class Closing Brace
?>