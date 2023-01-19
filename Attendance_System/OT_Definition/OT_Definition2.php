 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/ThekeyHRMS_main_Template.dwt" codeOutsideHTMLIsLocked="false" -->
    <head>
        <!--meta http-equiv="Content-Type" content="text/html; charset=utf-8" /-->
        <title>Thekey HRMS</title>

        <?php
        $dont_check = true;
        $base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
        require_once $base_path . 'Templates/head.php';
        ?>
    </head>

    <body>
        <div id="busy" >
            <img alt="Am Working" src="http://<?php echo $base_url ?>images/BusyAnimation.gif">
        </div>
        <div id="thekey_page">
            <?php require_once $base_path . 'Templates/header.php'; ?>

            <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" -->
                <?php
                echo '<p class="WelCome">Wel Come "' . $_SESSION['MM_Fullname'] . "\"</p>";

                $mydb = new DataBase();
                ?>
                <p></p>
                <?php
                require_once('../../Classes/Class_Attendance_System.php');
                $obj_OT = new Attendance_System();

                echo "<form name=\"SelectedID4OTSetup\"  action=\"OT_Definition3.php\" method=\"post\">";

                echo "<input  name=\"IDNo\" type=\"hidden\" >";
//session_start();
                $_SESSION['IDNo'] = "";


                $DayOT_IDNo['OT'] = "";
                if (isset($_POST['CHK_ID']) && isset($_POST['Next'])) {
                    $a = $_POST['CHK_ID'];

                    if (isset($_POST['CHK_DayOT']))
                        $DayOT = $_POST['CHK_DayOT'];

                    if (isset($_POST['CHK_NightOT']))
                        $NightOT = $_POST['CHK_NightOT'];

                    if (isset($_POST['DayOT_MaxHR']))
                        $DayOT_MaxHR = $_POST['DayOT_MaxHR'];

                    if (isset($_POST['NightOT_MaxHR']))
                        $NightOT_MaxHR = $_POST['NightOT_MaxHR'];

                    if (isset($_POST['DayOT_Start']))
                        $DayOT_Start = $_POST['DayOT_Start'];

                    if (isset($_POST['NightOT_Start']))
                        $NightOT_Start = $_POST['NightOT_Start'];

                    if (isset($_POST['NightOT_End']))
                        $NightOT_End = $_POST['NightOT_End'];






                    if (empty($a)) {
                        echo("You didn't select any Employee for Overtime Allocation Setup.");
                    } else {
                        $N = count($a);

                        if (isset($_POST['From_Date']))
                            $From_Date = $_POST['From_Date'];
                        else
                            $From_Date = "Unkown";


                        if (isset($_POST['To_Date']))
                            $To_Date = $_POST['To_Date'];
                        else
                            $To_Date = "Unkown";

                        echo "<input type=\"hidden\" name=\"From_Date\" value=\"$From_Date\"/>";

                        echo "<input type=\"hidden\" name=\"To_Date\" value=\"$To_Date\"/>";

                        echo("You have selected $N Employees(s) OT Setup on date $From_Date to $To_Date : ");

                        echo "<table >";
                        echo "<th>ID</th>
			<th>Full Name</th>
			<th>Department</th>
			<th>Day OT</th>";
                        echo "<th>Day OT Max Hour</th>";
                        echo "<th>Night OT</th>";
                        echo "<th>Night OT Max Hour</th>";
                        echo "<th>Day OT Start Hour</th>";
                        echo "<th>Night OT Start Hour</th>";
                        echo "<th>Night OT End Hour</th>";

                        $countrecord = 0;

                        for ($i = 0; $i < $N; $i++) {
                            $countrecord = $countrecord + 1;
                            // echo($a[$i] ."");
                            // $a[$i].=$a[$i].",";
                            //$_POST['IDNo'].=$a[$i].",";

                            $IDNumber = str_replace("'", "", $a[$i]);

                            $_SESSION['IDNo'].="," . $IDNumber; //Copying the selected ID for updating use


                            list($FirstName, $MiddelName, $LastName, $Department) = $obj_OT->get_employee_Detail($IDNumber);

                            echo "<tr> <td>";

                            echo $IDNumber;
                            echo "</td>";

                            echo "<td>";
                            echo "$FirstName $MiddelName $LastName";
                            echo "</td>";

                            echo "<td>";
                            echo "$Department";
                            echo "</td>";

                            echo "<td>";

                            //echo $IDNumber;
                            //if($DayOT[$i]==$a[$i])
                            if (isset($_POST['CHK_DayOT']))
                                if (in_array("'" . $IDNumber . "'", $_POST['CHK_DayOT'])) {


                                    echo "<input type=\"checkbox\" id=\"CHK_DayOT[]\" checked=\"checked\" name=\"CHK_DayOT[]\"  value=\"'" . $IDNumber . "'\">";
                                } else {
                                    echo "<input type=\"checkbox\" id=\"CHK_DayOT[]\"  name=\"CHK_DayOT[]\"  value=\"'" . $IDNumber . "'\">";
                                }
                            echo "</td>";


                            if ($countrecord == 1) {
                                echo "<td nowrap=\"nowrap\">";
                                echo "<input type=\"text\" name=\"DayOT_MaxHR\" value=\"$DayOT_MaxHR\" size=\"8\">";
                                echo "</td>";
                            } else {
                                echo "<td nowrap=\"nowrap\"></td>";
                            }


                            echo "<td>";

                            if (isset($_POST['CHK_NightOT']))
                                if (in_array("'" . $IDNumber . "'", $_POST['CHK_NightOT'])) {
                                    $_SESSION['NightOT_IDNo'] = "," . $IDNumber;

                                    echo "<input type=\"checkbox\" id=\"CHK_NightOT[]\" checked=\"checked\" name=\"CHK_NightOT[]\"  value=\"'" . $IDNumber . "'\">";
                                } else {
                                    echo "<input type=\"checkbox\" id=\"CHK_NightOT[]\"  name=\"CHK_NightOT[]\"  value=\"'" . $IDNumber . "'\">";
                                }
                            echo "</td>";



                            /* echo "<td>";

                              if(isset($_POST['CHK_SundayOT']))
                              if(in_array("'".$IDNumber."'", $_POST['CHK_SundayOT']))
                              {
                              $_SESSION['SundayOT_IDNo']=",".$IDNumber;

                              echo "<input type=\"checkbox\" id=\"CHK_SundayOT[]\" checked=\"checked\" name=\"CHK_SundayOT[]\"  value=\"'".$IDNumber."'\">";
                              }
                              else
                              {
                              echo "<input type=\"checkbox\" id=\"CHK_SundayOT[]\"  name=\"CHK_SundayOT[]\"  value=\"'".$IDNumber."'\">";
                              }
                              echo "</td>";

                              echo "<td>";
                              if(isset($_POST['CHK_HolydayOT']))
                              if(in_array("'".$IDNumber."'", $_POST['CHK_HolydayOT']))
                              {
                              $_SESSION['HolydayOT_IDNo']=",".$IDNumber;
                              echo "<input type=\"checkbox\" id=\"CHK_HolydayOT[]\" checked=\"checked\" name=\"CHK_HolydayOT[]\"  value=\"'".$IDNumber."'\">";
                              }
                              else
                              {
                              echo "<input type=\"checkbox\" id=\"CHK_HolydayOT[]\"  name=\"CHK_HolydayOT[]\"  value=\"'".$IDNumber."'\">";
                              }
                              echo "</td>"; */

                            if ($countrecord == 1) {
                                echo "<td nowrap=\"nowrap\">";
                                echo "<input type=\"text\" name=\"NightOT_MaxHR\" value=\"$NightOT_MaxHR\" size=\"8\">";
                                echo "</td>";

                                echo "<td nowrap=\"nowrap\">";
                                echo "<input type=\"text\" name=\"DayOT_Start\" value=\"$DayOT_Start\" size=\"8\">";
                                echo "</td>";

                                echo "<td nowrap=\"nowrap\">";
                                echo "<input type=\"text\" name=\"NightOT_Start\" value=\"$NightOT_Start\" size=\"8\">";
                                echo "</td>";

                                echo "<td nowrap=\"nowrap\">";
                                echo "<input type=\"text\" name=\"NightOT_End\" value=\"$NightOT_End\" size=\"8\">";
                                echo "</td>";
                            } else {
                                echo "<td nowrap=\"nowrap\"></td>";
                            }


                            echo "</tr>";
                        }
                        echo "</table>";
                        //echo $_SESSION['IDNo'];
                    }
                }

                echo "<p align=\"center\"><input type=\"submit\" name=\"OTAllocation\" value=\"Run OT Allocation\"></p>";
                echo "</form>";
                ?>


                <!-- InstanceEndEditable -->
            </div>
        </div>
    </body>
    <!-- InstanceEnd --> </html>


