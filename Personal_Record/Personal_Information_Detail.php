<?php

if(isset($_GET['id']))
{
    $_GET['ID']=$_GET['id'];
}
$dont_check = true;
require_once('../Connections/HRMS.php');

require_once('../Classes/Class_language.php');

mysql_select_db($database_HRMS, $HRMS);
$query_RSPersonalRecord = "SELECT * FROM employee_personal_record";
$RSPersonalRecord = mysql_query($query_RSPersonalRecord, $HRMS) or die(mysql_error());
$row_RSPersonalRecord = mysql_fetch_assoc($RSPersonalRecord);
$totalRows_RSPersonalRecord = mysql_num_rows($RSPersonalRecord);

mysql_select_db($database_HRMS, $HRMS);
$query_RSAL4PersonalInfoDetail = "SELECT * FROM annual_leave_detail";
$RSAL4PersonalInfoDetail = mysql_query($query_RSAL4PersonalInfoDetail, $HRMS) or die(mysql_error());
$row_RSAL4PersonalInfoDetail = mysql_fetch_assoc($RSAL4PersonalInfoDetail);
$totalRows_RSAL4PersonalInfoDetail = mysql_num_rows($RSAL4PersonalInfoDetail);

mysql_select_db($database_HRMS, $HRMS);
$query_RSDIsciplinaryAction = "SELECT * FROM disciplinary_action";
$RSDIsciplinaryAction = mysql_query($query_RSDIsciplinaryAction, $HRMS) or die(mysql_error());
$row_RSDIsciplinaryAction = mysql_fetch_assoc($RSDIsciplinaryAction);
$totalRows_RSDIsciplinaryAction = mysql_num_rows($RSDIsciplinaryAction);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/ThekeyHRMS_main_Template.dwt" codeOutsideHTMLIsLocked="false" -->
    <head>
        <!--meta http-equiv="Content-Type" content="text/html; charset=utf-8" /-->
        <title>Thekey HRMS</title>
        <?php
        $base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
        require_once $base_path . 'Templates/head.php';
        ?>
        <script src="../Js/zoom.js"></script>
        <script>

            // perform JavaScript after the document is scriptable.
            $(function() {
                // setup ul.tabs to work as tabs for each div directly under div.panes
                $("ul.tabs").tabs("div.panes > div");
            });
        </script>
        <link rel="stylesheet" type="text/css" href="../Css/tabs.css" />

        <!-- tab pane styling -->
        <style>

            /* tab pane styling */
            .panes div {

                padding:15px 10px;
                border:none;
                border-top:0px;
                height:500px;
                font-size:14px;
                background-color: #FBFBFB;

            }

        </style>


    </head>

    <body>
        <div id="busy" >
            <img alt="Am Working" src="http://<?php echo $base_url ?>images/BusyAnimation.gif">
        </div>
        <div id="thekey_page">
            <?php require_once $base_path . 'Templates/header.php'; ?>

            <div id="mainContent">
                <!-- InstanceBeginEditable name="MainContent" -->
                <!--li onclick="TINY.box.show({url:'Select_FirstName.php',post:'id=16',width:400,height:100,opacity:20,topsplit:3})">Choose Employee</li-->
                <?php
///thekey/ require_once("Select_FirstName.php");
                ?>
                <h1 class="form_lable">
                    <?php echo $obj_lang->get('Employee Perosnal Detail Information', $lang); ?>
                </h1>
                <?php
                $_GET['TableName'] = "employee_personal_record";

                $_GET['OpenPage'] = "Personal_Information_Detail";

                require_once($base_path . "Search_Name/SearchName.php");
                ?>

                <input type=button value="Print Out" onclick="PrintContentPersonalInfo()" align="right" />

                <!-- This JavaScript snippet activates those tabs -->


                <table width="765" height="295" align="center" id="tblInfo">
                    <tr valign="baseline" align="left">

                        <td height="273" width="183" align="left" valign="top" nowrap="nowrap">
                            <?php
                            if (isset($_GET['ID'])) {
                                $query = "SELECT * FROM employee_personal_record";
                                $result = mysql_query($query);
                                while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                    if ($row['ID'] == $_GET['ID']) {
                                        if (($row['Photo'] == NULL ) AND ($row['Sex'] == "Female"))
                                            $Photo = "default_profile_female.jpg";
                                        else
                                        if (($row['Photo'] == NULL ) AND ($row['Sex'] == "Male"))
                                            $Photo = "default_profile_male.png";
                                        else
                                        if ($row['Photo'] == NULL)
                                            $Photo = "default_profile_male.png";
                                        else
                                            $Photo = $row['Photo'];
                                    }
                                }
                                ?>

                                <img src="<?php echo '../Employee_Images/' . $Photo; ?>"  width="185" height="185" alt="<?php echo $row['ID']; ?> Photo Not Available"  onmouseover="zxcZoom(this,'<?php echo '../Employee_Images/' . $Photo; ?>',600,500,7,'C');"
                                     onmouseout="javascript:zxcZoom(this);"   /> 
                            </td>
                            <td width="570" align="left" valign="top">
                                <?php
                                if (mysql_num_rows(mysql_query("SELECT * FROM employee_personal_record where ID='" . $_GET['ID'] . "'"))) {
                                    if (mysql_num_rows(mysql_query("SELECT * FROM employee_personal_record where ID='" . $_GET['ID'] . "'")) > 1) {
                                        echo "<font color=\"#FF0000\" size=\"+1\" >By ID Number <b>" . $_GET['ID'] . "</b> more than one employee is exist in the database.Change the ID number for either of them.</font>";
                                    } else {
                                        require_once('../Classes/Class_Personal_Info.php');

                                        $obj_Perosnal_Info = new Personal_info();
                                        echo "<ul class=\"tabs\">
                                                                <li><a href=\"#\">Basic Information</a></li>
                                                               <li><a href=\"#\">Leaves</a></li>
                                                               <li><a href=\"#\">Annual Leave</a></li>
                                                               <li><a href=\"#\">Equipment</a></li>
                                                               <li><a href=\"#\">Training</a></li>
                                                               <li><a href=\"#\">Discipline</a></li>
                                                               <li><a href=\"#\">Emergency Contact</a></li>
                                                               <li><a href=\"#\">Job Description</a></li>
                                                           </ul>";
                                        echo "<div class=\"panes\">";
                                        echo "<div id='Basic_Info'>";
                                        echo "<br/>";
                                        echo $obj_Perosnal_Info->Basic_Info($_GET['ID'], $lang);

                                        echo "</div>";
                                        echo "<div id=\"Leave\">";
                                        echo "<br/>";
                                        echo $obj_Perosnal_Info->Leaves($_GET['ID'], $lang);
                                        echo "</div>";


                                        /*                                         * *** Annual Leave Calculation ***** */
                                        echo "<div id=\"Annual_Leave\">";
                                        echo "<br/>";
                                        /*                                         * ************** Annual Leave calacultaion and Allocation from Class of Leave ***** */
                                        require_once('../Classes/Class_Leave.php');
                                        $obj_leave = new leave();

                                        $db = "ThekeyHRMSDB";
                                        list($Company_Name, $Annual_Leave_Expiry_Year, $Annual_Leave_Initial_Days, $Annual_Leave_CONST_Year) = $obj_leave->get_Company_Annual_Leave_Setting();

                                        $initialALdays = $Annual_Leave_Initial_Days;
                                        $Annual_Leave_CONST_Year = $Annual_Leave_CONST_Year;

                                        if (isset($_GET['ID'])) {




                                            $db = 'ThekeyHRMSDB';
                                            $ID = $_GET['ID'];
                                            $Leavedays = 0;

                                            $sqlDE = "SELECT `ID` , FirstName ,MiddelName , LastName,`Date_Employement`,
		period_diff( date_format( now( ) , '%Y%m' ) ,
		date_format( `Date_Employement` , '%Y%m' ) ) AS Workingmonths FROM 
		$db.employee_personal_record where ID= '" . $ID . "'";

                                            $resultDE = mysql_query($sqlDE) or die(mysql_error());
                                            $rowDE = mysql_fetch_array($resultDE);

                                            $FirstName = $rowDE['FirstName'];
                                            $MiddelName = $rowDE['MiddelName'];
                                            $LastName = $rowDE['LastName'];

                                            $dateofemployeement = $rowDE['Date_Employement'];

                                            $WorkingMonth = $rowDE['Workingmonths'];

                                            $noyear = ($rowDE['Workingmonths']) / 12;

                                            list($Company_Name, $Annual_Leave_Expiry_Year, $Annual_Leave_Initial_Days, $Annual_Leave_CONST_Year) = $obj_leave->get_Company_Annual_Leave_Setting();

                                            $initialALdays = $Annual_Leave_Initial_Days;
                                            $Annual_Leave_CONST_Year = $Annual_Leave_CONST_Year;




                                            $totalALdays = $obj_leave->AnnualLeaveCalcualte($initialALdays, $Annual_Leave_CONST_Year, $db, $ID, $FirstName);
                                            $TotalTakenDay = $obj_leave->ALTotalTakenDay($db, $ID, $FirstName, $Leavedays);
                                            $TotalTakenDay = $TotalTakenDay; //+$_POST['Leavedays'];
                                            $TotalLeftDays = $obj_leave->ALTotalLeftDay($totalALdays, $TotalTakenDay);
                                            echo "<font color=\"#FF6600\"  size=\"+1.5\" face=\"Times New Roman, Times, serif\">This Annual Leave is Calcualted as of Today date " . date("Y-m-d") . " for Employee {$FirstName} {$MiddelName} {$LastName} employeed on {$dateofemployeement}</font><br/>";
                                            echo "<br>Total Annual Leave:";
                                            echo $obj_leave->ALYearAllocation($totalALdays, $initialALdays, $Annual_Leave_CONST_Year, $dateofemployeement) . "<br>";
                                            echo "Total Left Annual Leave:";
                                            echo $obj_leave->ALYearAllocation($TotalLeftDays, $initialALdays, $Annual_Leave_CONST_Year, $dateofemployeement) . "<br>";
                                        }
                                        echo "</div>";


                                        echo "<div id=\"Equipment\">";
                                        echo "<br/>";
                                        echo $obj_Perosnal_Info->Equipment($_GET['ID'], $lang);
                                        echo "</div>";

                                        echo "<div id=\"Training\">";
                                        echo "<br/>";
                                        echo $obj_Perosnal_Info->Training($_GET['ID'], $lang);
                                        echo "</div>";

                                        echo "<div id=\"Disciplinary_Action\">";
                                        echo "<br/>";
                                        echo $obj_Perosnal_Info->Disciplinary_Action($_GET['ID'], $lang);
                                        echo "</div>";

                                        echo "<div id=\"Emergency_Contact\">";
                                        echo "<br/>";
                                        echo $obj_Perosnal_Info->Emergency_Contact($_GET['ID'], $lang);
                                        echo "</div>";

                                        echo "<div id=\"Job_Description\">";
                                        echo "<br/>";
                                        echo $obj_Perosnal_Info->Job_Description($_GET['ID'], $lang);
                                        echo "</div>";

                                        echo $obj_Perosnal_Info->HardCopy_Location($_GET['ID'], $lang);
                                        ?>

                                        <?php
                                    }
                                } else
                                if ($_GET['ID'] == "X") {
                                    echo "<font color=\"#FF0000\"  >Type the name and click on \"Display\" OR Select from the list the name first which you want to see his Personal Information detail.</font> ";
                                }



                                else
                                    echo "<font color=\"#FF0000\"  ><script type=\"text/javascript\"> alert('" . $_GET['ID'] . " is NOT in current employee list check the Name you type is whether correctly spelled  or not.OR try to select the Name OR ID from current employee name list.');</script></font>";
                            }//isset id end brase
                            ?>


                        </td>
                    </tr>
                </table>

                <!-- InstanceEndEditable -->
            </div>
        </div>

    </body>
    <!-- InstanceEnd --> 
</html>