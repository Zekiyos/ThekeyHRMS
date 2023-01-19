<?php require_once('../Connections/HRMS.php'); ?>
<?php require_once('../Classes/Class_Leave.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Untitled Document</title>
        <script language=javascript src="../Js/popup.js">
        </script>
        <script type="text/javascript" src="../Js/toggle.js">
        </script>

    </head>

    <body >

        <?php
        if (isset($_POST['ID'])) {

            /* $initialALdays=14; */
            $db = 'ThekeyHRMSDB';
            $ID = $_POST['ID'];
            $FirstName = $_POST['FirstName'];

            $sqlDE = "SELECT `ID` , FirstName ,MiddelName , LastName,`Date_Employement`,
		period_diff( date_format( now( ) , '%Y%m' ) ,
		date_format( `Date_Employement` , '%Y%m' ) ) AS Workingmonths FROM 
		$db.employee_personal_record where ID= '" . $ID . "' and FirstName='" . $FirstName . "'";
            $resultDE = mysql_query($sqlDE) or die(mysql_error());
            $rowDE = mysql_fetch_array($resultDE);

            $dateofemployeement = $rowDE['Date_Employement'];

            $WorkingMonth = $rowDE['Workingmonths'];

            $noyear = ($rowDE['Workingmonths']) / 12;

            $NoDay = $noyear / 365;

            $obj_leave = new leave();

			//Old annual leave setting using company setting rules
         //   list($Company_Name, $Annual_Leave_Expiry_Year, $Annual_Leave_Initial_Days, $Annual_Leave_CONST_Year) = $obj_leave->get_Company_Annual_Leave_Setting();

 list($Company_Name, $Annual_Leave_Expiry_Year, $Annual_Leave_Initial_Days, $Annual_Leave_CONST_Year) = $obj_leave->get_annual_leave_setting($dateofemployeement);

 
 //            //for company wich it has to many initial days due to CBA rule change
//            if (strtoupper($Company_Name) == strtoupper("Sher Ethiopia plc")) {
//                if ($dateofemployeement <= "2010-12-01")
//                    $initialALdays = 14;
//                else
//                    $initialALdays = $Annual_Leave_Initial_Days;
//            }
//            else
                $initialALdays = $Annual_Leave_Initial_Days;



            $Annual_Leave_CONST_Year = $Annual_Leave_CONST_Year;




            $totalALdays = $obj_leave->AnnualLeaveCalcualte($initialALdays, $Annual_Leave_CONST_Year, $db, $_POST['ID'], $_POST['FirstName']);
            $TotalTakenDay = $obj_leave->ALTotalTakenDay($db, $_POST['ID'], $_POST['FirstName'], $_POST['Leavedays']);
            $TotalTakenDay = $TotalTakenDay; //+$_POST['Leavedays'];
            $TotalLeftDays = $obj_leave->ALTotalLeftDay($totalALdays, $TotalTakenDay);

            echo "<input type=button value=\"Print Out\" onclick=\"PrintContent('CalculatedAnnualLeaveReport')\" align=\"right\" >";
            echo "<br/>";
            echo "<div id=\"CalculatedAnnualLeaveReport\" >";

            echo "<font color=\"#FF6600\"  size=\"+1.5\" face=\"Times New Roman, Times, serif\">This Annual Leave is Calcualted as of Today date " . date("Y-m-d") . " for Employee {$_POST['FirstName']} {$_POST['MiddelName']} {$_POST['LastName']} employeed on {$dateofemployeement}</font><br/>";
            echo "<br/>";
            echo "<input value=\"+\" type=\"button\" id=\"Detail1\" onclick=\"javascript:toggle('Detail')\" />Detail";
            echo "<div id=\"Detail\" style=\"display: none;\">";

            echo "<font color=\"#39Ft\"  size=\"+1\" face=\"Times New Roman, Times, serif\">No. of Working<ul><li>Year :" . $noyear . "</li><li>Month :" . $WorkingMonth . "</li><li>Day :" . $NoDay . "</li></ul> According to <ul><li>Initial Annual Leave Year:" . $initialALdays . "</li><li>Annual Leave Constant Year:" . $Annual_Leave_CONST_Year . "</li>
	<li>One Incremental Per Year:+1</li></ul></font>";
            echo "</div>";
            echo "<br/>";
            echo "<input value=\"+\" type=\"button\" id=\"TotalAnnualLeave1\" onclick=\"javascript:toggle('TotalAnnualLeave')\" />Total Annual Leave";
            echo "<div id=\"TotalAnnualLeave\" style=\"display: none;\">";

            echo "<br>Total Annual Leave:";
            echo $obj_leave->ALYearAllocation($totalALdays, $initialALdays, $Annual_Leave_CONST_Year, $dateofemployeement) . "<br>";

            echo "</div>";
            echo "<br/>";
            echo "<input value=\"+\" type=\"button\" id=\"TotalLeftAnnualLeave1\" onclick=\"javascript:toggle('TotalLeftAnnualLeave')\" />Total Left Annual Leave";
            echo "<div id=\"TotalLeftAnnualLeave\" style=\"display: none;\">";

            echo "Total Left Annual Leave:";
            echo $obj_leave->ALYearAllocation($TotalLeftDays, $initialALdays, $Annual_Leave_CONST_Year, $dateofemployeement) . "<br>";

            echo "</div>";
            echo "<br/>";
        }
        ?>
<!--i style="float:right;">Thekeysoft</i-->
    </body>
</html>

</div>