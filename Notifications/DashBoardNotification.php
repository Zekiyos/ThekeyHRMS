
<?php

// $d = date("Y-m-d");


$attendanceOpeningDate = date('2012-m-') . $company_info['Attendance_Opening_Date'];
$attendanceClosingDate = date('Y-m-') . $company_info['Attendance_Closing_Date'];


$query1 = "SELECT e.ID,e.FirstName AS 'First Name', e.MiddelName AS 'Middle Name', e.LastName AS 'Last Name', e.Department,e.Group,
    COUNT(a.Status) AS 'Absent Days','" . $attendanceOpeningDate . "','" . $attendanceClosingDate . "' 
FROM attendance_allocation a
JOIN employee_personal_record e ON e.ID=a.ID 
    WHERE Status='Absent' AND DATE BETWEEN '" . $attendanceOpeningDate . "' AND '" . $attendanceClosingDate . "' GROUP BY e.ID HAVING COUNT(a.Status)>=10";

$query2 = "SELECT e.ID,e.FirstName AS 'First Name', e.MiddelName AS 'Middle Name', e.LastName AS 'Last Name', e.Department,e.Group,COUNT(a.Status) AS 'Absent Days',
SUBDATE(CURDATE(), INTERVAL 365 DAY) AS From_Date, CURDATE() AS To_Date
 FROM attendance_allocation a 
JOIN employee_personal_record e ON e.ID=a.ID 
    WHERE Status='Absent' AND DATE BETWEEN SUBDATE(CURDATE(), INTERVAL 365 DAY) AND CURDATE()  GROUP BY e.ID HAVING COUNT(a.Status)>=30";

//echo '<hr>' . $query1 . '<hr>';
$result1 = mysql_query($query1);
$noRows1 = mysql_num_rows($result1);

$result2 = mysql_query($query2);
$noRows2 = mysql_num_rows($result2);



if (($noRows1) || ($noRows2)) {
    echo '<div id="EmployeeAbsenteeismNotification">';

    $row1 = mysql_fetch_array($result1);
    $row2 = mysql_fetch_array($result2);


    $i = 0;

    echo '<font color=\"#989898\" face=\"Times New Roman, Times, serif\" ><h3>Employee Absenteeism</h3></font>';

    echo '<a href="Notifications/EmployeeAbsenteeismNotification.php" target=\"_blank\" >Detail Notify</a>)';

    echo '<ul>';
    if ($noRows1)
        echo '<li>';
    echo '<a target="_blank" href="report/Report_Display.php?report=Absenteeism &gt; 10 days Current Month" > (+)</a>';
    echo 'There are ' . $noRows1 . ' Employee are Absent More than 10 Days from ' . $attendanceOpeningDate . ' to ' . $attendanceClosingDate . '</li>';
    if ($noRows2)
        echo '<li>';
    echo '<a target="_blank" href="report/Report_Display.php?report=Absenteeism &gt; 30 days in 365 days" > (+)</a>';
    echo 'There are ' . $noRows2 . ' Employee are Absent More than 30 Days from ' . $row2['From_Date'] . ' to ' . $row2['To_Date'] . '</li>';

    echo '</ul>';



    echo '</div>';
}
?>
<?php

$d = date("Y-m-d");

$query = "SELECT * FROM court_case where DATEDIFF('" . $d . "',court_case.AppointmentDate) >-5 and DATEDIFF('" . $d . "',court_case.AppointmentDate) <=1 ";
if (mysql_num_rows(mysql_query($query))) {
    echo '<div id="CourtCase">';
    echo '<font color=\"#989898\" face=\"Times New Roman, Times, serif\" ><h3>Court Case Appointment</h3></font>';


    $result = mysql_query($query);
    $i = 0;
    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {


        $i = $i + 1;


        echo "<font  color=\"#FF9900\" size=\"+1\" face=\"Times New Roman, Times, serif\">" . "{$row['FirstName']}" . " {$row['MiddelName']}" . " {$row['LastName']}" . "</font><br>";
        echo "<font color=\"#03F\" size=\"+0\" >" . "<a href=\"../Notifications/Court Case Report/CourtCaseReport.php\" target=\"_blank\" >case on {$row['Court']} Court</a> Appointment is on date {$row['AppointmentDate']}" . "</font><p> </p>";
    }

    echo '</div>';
}
?>
<?php
?>
<?php

$d = date("Y-m-d");

$query = "SELECT COUNT(ID) AS NO_Employee,LeaveType
FROM annual_Leave
WHERE ReportOn <= CURDATE( ) and Reported='NO'
UNION ALL
SELECT COUNT(ID) AS NO_Employee,LeaveType
FROM sick_leave
WHERE ReportOn <= CURDATE( ) and Reported='NO'
UNION ALL
SELECT COUNT(ID) AS NO_Employee,LeaveType
FROM maternity_leave
WHERE ReportOn <= CURDATE( ) and Reported='NO'
UNION ALL
SELECT COUNT(ID) AS NO_Employee,LeaveType
FROM paternity_leave
WHERE ReportOn <= CURDATE( ) and Reported='NO'
UNION ALL
SELECT COUNT(ID) AS NO_Employee,LeaveType
FROM Special_leave
WHERE ReportOn <= CURDATE( ) and Reported='NO'
UNION ALL
SELECT COUNT(ID) AS NO_Employee,LeaveType
FROM funeral_leave
WHERE ReportOn <= CURDATE( ) and Reported='NO'
UNION ALL
SELECT COUNT(ID) AS NO_Employee,LeaveType
FROM Wedding_leave
WHERE ReportOn <= CURDATE( ) and Reported='NO' GROUP BY LeaveType";
if (mysql_num_rows(mysql_query($query))) {
    echo '<div id="Leave">';

    $result = mysql_query($query);
    $i = 0;

    echo '<font color=\"#989898\" face=\"Times New Roman, Times, serif\" ><h3>On Leave</h3></font>';
    echo '(Not Reported Back to Work: ';
    echo '<a href="Notifications/ALNotification.php" target=\"_blank\" >Detail Notify</a>)';

    echo '<ul>';

    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

        $i = $i + 1;


        if ($row['NO_Employee'] != 0)
            echo "<li type=\"square\"><font color=\"#111\" size=\"+0\" face=\"Times New Roman, Times, serif\" >" .
            "{$row['LeaveType']}" . " :  {$row['NO_Employee']} employee.</li></font>";
    }
    echo '</ul>';
    echo "<a href=\"/Leaves/Back_From_Leave_Report.php" . "\" > Fill Report Back </a>";

    echo '</div>';
}
?>


<?php

// $d = date("Y-m-d");

$query = "SELECT COUNT(e.ID) AS No_Employee,DATEDIFF(CURDATE(),e.Date_Employement) AS No_Day 
        FROM employee_personal_record e where DATEDIFF(CURDATE(),e.Date_Employement) >= 40 and 
        DATEDIFF(CURDATE(),e.Date_Employement) <= 45 GROUP BY e.Date_Employement";

if (mysql_num_rows(mysql_query($query))) {
    echo '<div id="ProbationEvaluation">';


    $result = mysql_query($query);
    $i = 0;

    echo '<font color=\"#989898\" face=\"Times New Roman, Times, serif\" ><h3>Probation Period</h3></font>';

    echo '<a href="Notifications/EvalutionNotification.php" target=\"_blank\" >Detail Notify</a>)';

    echo '<ul>';

    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $i = $i + 1;

        if ($row['No_Employee'] != 0)
            echo "<li type=\"square\"><font color=\"#111\" size=\"+0\" face=\"Times New Roman, Times, serif\" >"
            . "{$row['No_Employee']} employee left only " . " :  {$row['No_Day']} days to finish 45 days Probation Period.
                </li></font>";
    }
    echo '</ul>';
    echo "<a href=\"/Recruitment/Probation_Evaluation.php" . "\" > Fill Probation Evaluation</a>";

    echo '</div>';
}
?>