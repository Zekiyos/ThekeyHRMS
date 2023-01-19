<?php
$base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
require_once $base_path . 'Templates/head.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/ThekeyHRMS_main_Template.dwt" codeOutsideHTMLIsLocked="false" -->
    <head>
        <!--meta http-equiv="Content-Type" content="text/html; charset=utf-8" /-->
        <title>Thekey HRMS</title>

        <style>

            .Attendance_Summary {
                border-collapse: collapse;
                margin-right: 57px;
                width: 95%;
            }
            .Attendance_Summary tr th {
                color: Green;
                padding: 6px;
                text-transform: capitalize;
                white-space: nowrap;
                border: 1;
            }
            .Attendance_Summary tr td {
                white-space: nowrap;
            }
            .Attendance_Summary tbody tr:nth-child(2n) {
                background: 255 255 205;
            }


        </style>

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



                <script type="text/javascript" src="../Js/PrintContent.js">
                </script>
                <?php
                $editFormAction = $_SERVER['PHP_SELF'];
                if (isset($_SERVER['QUERY_STRING'])) {
                    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
                }

                require_once('../Classes/Class_Attendance_System.php');
                $objAS = new Attendance_System();

                list($Company_Name,
                        $Logo_Path,
                        $Logo_Height,
                        $Logo_Width,
                        $Company_Telphone,
                        $Company_Email,
                        $Web_Site,
                        $Company_POBOX,
                        $Company_Fax,
                        $Company_City,
                        $Company_Country,
                        $Equipment_Picture_Path,
                        $Annual_Leave_Expiry_Year,
                        $Annual_Leave_Initial_Days,
                        $Annual_Leave_CONST_Year,
                        $Attendance_Opening_Date,
                        $Attendance_Closing_Date) = $objAS->get_Company_Setting();

                if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
                   
                    $TableName = isset($_GET['Attendance']) ? $_GET['Attendance'] : 'Attendance_Allocation';

                    if ((mysql_num_rows(mysql_query("SELECT * FROM $TableName where Date >= '" . $_POST['From_Date'] . "' and Date <= '" . $_POST['To_Date'] . "'")))) {

                        echo '<h1 class="form_lable">';
                        echo $obj_lang->get('Attendance Summary Report', $lang) . " From " . $_POST['From_Date'] . " to " . $_POST['To_Date'] . "";
                        echo "</h1>";
                        echo '<ul class="format">';
						   // if (strtoupper($_GET['Year_Month']) != strtoupper("Attendance_Allocation")) {
                        echo '<li>';
                        echo "<input style=\"float: left;\" type=button value=\"Print Out\" onclick=\"PrintContent('Attendance_Summary')\" align=\"right\" />";
                        echo '</li>';
						//}
                        echo '<li>';
						echo '<li>';
					/*	$monthYear =date('Y',$_POST['From_Date']).'_'.date('m',$_POST['From_Date']);
						
        echo "<a class='btn btn-danger' ><i class='fa fa-tasks' ID=\"attendance_summarizer\"   alt='Summerize Attendance for Payroll' title='Summerize Attendance for Payroll' onClick=\"return confirm('Are you sure you want to Summarize this Attendance?')\" ></i></a>";
        echo '<input type="hidden" id="selected_Department" name="selected_Department" value="' . htmlentities(json_encode($Department)) . '" />';
        echo '<input type="hidden" id="selected_monthYear" name="selected_monthYear" value="' . $monthYear . '" />';
        echo '</li>';*/
                        //$_SESSION['allocation_summery'] = $dip_filter;
                        //echo '<a style="float: left;" href="' . $_SERVER['PHP_SELF'] . '?Attendance=Attendance_Allocation&XL=excel&From_Date=' . $_POST['From_Date'] . '&To_Date=' . $_POST['To_Date'] . '">';
                        // echo '<img width="30px" title="Export As Excel File" alt="Export As Excel File" src="http://' . $base_url . '/images/excel.png"></a>';

                        echo '</li>';
						 if (strtoupper($_GET['Year_Month']) == strtoupper("Attendance_Allocation")) {
//echo $_POST['From_Date'].(int) substr($_POST['To_Date'], 5, 2).'-'.(int) substr($_POST['To_Date'], 8, 2).'-'. (int)substr($_POST['To_Date'], 0, 4);
if(((int) substr($_POST['To_Date'], 8, 2))>=21){

 $yearMonth_date = mktime(0, 0, 0,(int) substr($_POST['To_Date'], 5, 2)+1,(int) substr($_POST['To_Date'], 8, 2), (int)substr($_POST['To_Date'], 0, 4));
 
}else{
$yearMonth_date = mktime(0, 0, 0,(int) substr($_POST['To_Date'], 5, 2),(int) substr($_POST['To_Date'], 8, 2), (int)substr($_POST['To_Date'], 0, 4));
}

                        

						
                        $yearMonth = date("Y_F", $yearMonth_date);
                    } else {
                        $yearMonth = $_GET['Year_Month'];
                    }
                    echo '<li>';
					//  if ((strtoupper($_GET['Year_Month']) == strtoupper("Attendance_Allocation"))&&(date('d') >=0)&&(date('d') <26)) {
					  if ((strtoupper($_GET['Year_Month']) == strtoupper("Attendance_Allocation"))){
                    echo "<a class='btn btn-danger' ><input style=\"float: left;\" type=button value='&Sum;' class='iconfa-tasks' ID=\"attendance_summarizer\"   alt='Summerize Attendance for Payroll' title='Summerize Attendance for Payroll' onClick=\"return confirm('Are you sure you want to Summarize this Attendance?')\" ></a>";
                    }
					echo '<input type="hidden" id="selected_Department" name="selected_Department" value="' . htmlentities(json_encode($_POST['Department'])) . '" />';
                    echo '<input type="hidden" id="selected_monthYear" name="selected_monthYear" value="' . $yearMonth . '" />';
                    echo '<input type="hidden" id="FromDate" name="FromDate" value="' . $_POST['From_Date'] . '" />';
                    echo '<input type="hidden" id="ToDate" name="ToDate" value="' . $_POST['To_Date'] . '" />';


                    echo '</li>';
                        ?>
                        <li><a href="<?php echo $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'] . '&Export=XL' ?>" ><img style="width: 32px;" src="http://<?php echo $base_url ?>images/excel.png" alt="Export As Excel File" title="Export As Excel File"/></a></li>
                        <?php
                        echo '</ul>';


                        echo "<div id=\"Attendance_Summary\">";
                        echo '<h3>';
                        echo $obj_lang->get('Attendance Summary Report', $lang) . " From " . $_POST['From_Date'] . " to " . $_POST['To_Date'] . "";
                        echo "</h3>";


                         // $objAS->Attendance_Summary($TableName, $_POST['Department'], $_POST['From_Date'], $_POST['To_Date']);
                    if (isset($_GET['Year_Month'])) {

                        if (strtoupper($_GET['Year_Month']) == strtoupper("Attendance_Allocation")) {
                            $objAS->generateAttendanceSummary($_POST['Department'], $_POST['From_Date'], $_POST['To_Date']);
                        } else {
                            $objAS->display_attendance_summary_both_manual_biometric($_POST['Department'], $_GET['Year_Month']);
                        }


                    }
                        echo "</div>";
                    }
                    else
                        echo "<script type=\"text/javascript\">alert('There is no runned attendance Allocation for the specifed Date Range in $TableName');</script>";
                }
                ?>
                <?php
                if (!(isset($_POST["From_Date"]))) {
                    ?>
                    <h1 class="form_lable">
                        <?php echo $obj_lang->get('Attendance Summary Report', $lang); ?>
                    </h1>
                    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">

                        <table width="476" height="180" align="center" background="" bgcolor="#EBEBEB">
                            <tr>

                                <td height="61">&nbsp;</td>
                                <td height="61">&nbsp;</td>
                                <td align="right"><?php
                  //  require_once('Attendance_Selection.php');
                        ?>
                                              <select name="Year_Month" id="Year_Month" onchange="updateQueryStringParameter('Year_Month')" >

                                        <option selected="selected">------Select Attendance-----</option>
                                        <?php
                                        $sql = mysql_query("Select DISTINCT `Year_Month` from biometric_attendance_summary");
                                        echo "<option value=\"Attendance_Allocation\">Current Month</option>";
                                        while ($row = mysql_fetch_array($sql)) {
                                            $id = $row['Year_Month'];
                                            $data = $row['Year_Month'];
                                            echo '<option value="' . $id . '">' . $data . '</option>';
                                        }
                                        ?>
                                    </select> 
                                </td>
                            </tr>

                                     <tr valign="baseline">
                                <td width="132"  align="right" nowrap="nowrap">From Date:</td>
                                <td width="93"> <?php
                                    $Today = date('Y-m-d');

                                    if (isset($_GET['Year_Month'])) {

                                        if (strtoupper($_GET['Year_Month']) == strtoupper("Attendance_Allocation")) {

                                            $lastmonth = mktime(0, 0, 0, date("m") - 1, trim($Attendance_Opening_Date), date("Y"));

                                            $date = date("Y-m-d", $lastmonth);
                                            $date2 = date("Y-m-d");
                                        } else {
                                            $date = strtoupper(substr($_GET['Year_Month'], 0, 4)) .
                                                    "-" . date("m", mktime(0, 0, 0, date("m", strtotime(strtoupper(substr($_GET['Year_Month'], 5)))) - 1)) . "-" . trim($Attendance_Opening_Date);


                                            $date2 = strtoupper(substr($_GET['Year_Month'], 0, 4)) .
                                                    "-" . date("m", strtotime(strtoupper(substr($_GET['Year_Month'], 5)))) . "-" . trim($Attendance_Closing_Date);
                                        }
                                    }
                                        ?><input type="date" name="From_Date" value='<?php
                                if (isset($date))
                                    echo $date;
                                        ?>
                                           ' size="12" /></td>
                                <td align="center"><?php
                                if (isset($_GET['Year_Month'])) {
                                    echo "<font color=\"#FF6600\" size=\"+1\">";
                                    if (strtoupper($_GET['Year_Month']) == strtoupper("Attendance_Allocation")) {
                                        echo "Current Month";
                                    } else {
                                        echo strtoupper(substr($_GET['Year_Month'], 0, 4));
                                        echo " " . strtoupper(substr($_GET['Year_Month'], 5));
                                    }
                                    echo"</font>";
                                }
                                        ?></td>

                                <td align="right" nowrap="nowrap">To Date:</td>
                                <td ><input type="date" name="To_Date"  value='<?php
                                if (isset($date))
                                    echo $date2;
                                        ?>
                                            ' size="12" /></td>
                            </tr>


                            <tr valign="baseline">

                                <td  align="right" nowrap="nowrap" colspan="2"><label for="Section">Section</label>:</td>
                                <td>
                                    <select name="Section" class="Section">

                                        <option selected="selected">------Select Section-----</option>
                                        <?php
                                        $sql = mysql_query("Select DISTINCT Section from Department");
                                        while ($row = mysql_fetch_array($sql)) {
                                            $id = $row['Section'];
                                            $data = $row['Section'];
                                            echo '<option value="' . $id . '">' . $data . '</option>';
                                        }
                                        ?>
                                    </select> 
                                </td>
                            </tr>
                            <tr valign="baseline">
                                <td  align="right" nowrap="nowrap" colspan="2"><label>Sub Section</label>:</td>
                                <td>
                                    <select name="SubSection" class="SubSection">
                                        <option selected="selected">--First Select Section--</option>

                                    </select>
                                </td>
                            </tr>
                            <tr valign="baseline">
                                <td  align="right" nowrap="nowrap" colspan="2"><label >Group</label>:</td>
                                <td>

                                    <select name="Group" class="Group" id="Group">
                                        <option selected="selected">--First Select Section--</option>

                                    </select>

                                </td>
                            </tr>
                            <tr valign="baseline">
                                <td  align="right" nowrap="nowrap" colspan="2"><label ></label>Department:</td>
                                <td>

                                    <select  id="Department[]" name="Department[]" multiple="multiple" class="Department" >
                                        <option selected="selected">--First Select Section--</option>

                                    </select>
                                </td>
                            </tr>


                            <tr valign="baseline">
                                <td nowrap="nowrap" align="right">&nbsp;</td><td>
                                    <td>&nbsp;&nbsp;<input type="submit" value="Show Summary" /></td>
                            </tr>
                        </table>
                        <input type="hidden" name="MM_insert" value="form1" />
                    </form>

                    <!-- InstanceEndEditable -->
                </div>
            </div>
        </body>
        <!-- InstanceEnd --> 
    </html>

    <?php
} //*end of showing date selection form */


if (isset($_GET['Export'])) {
    $fileName = "Attendance Summary Excel Export ";
    $objAS->XL_Export($_SESSION['AttendanceSummarySql'], $fileName);
}

//
//if (isset($_GET['XL'])) {
//    echo '<hr>';
//    $sqlAL = file_get_contents('../sql/Biometric_Total_Attendance_SummaryAL.sql');
//
//
//
//
//
//    if (!$sqlAL) {
//        die('Error opening file Biometric_Total_Attendance_Summary.sql Check its Existance');
//    } else {
//
//
//        $sqlAL = $sqlAL . " 
//                WHERE (" . $_SESSION['allocation_summery'] . ")  and `Date`>= '" . $_GET['From_Date'] . "'  and `Date`<='" . $_GET['To_Date'] . "'
//                         AND `attendance_allocation`.`FirstName`<> ''
//                   
//                        Group By attendance_allocation.ID 
//                        having (Total_Working_Day+Total_Leave_Days>0)
//                        Order By attendance_allocation.Department,IDNO";
//    }
//
//    $date_dif = round((strtotime($_GET['To_Date']) - strtotime($_GET['From_Date'])) / 86400, 0);
//    $date_dif++;
//   // if ($date_dif > 23) {
//   //     $date_dif = 23;
//  //  }
//
//    $sqlAL = preg_replace('/working_day_val/', $date_dif, $sqlAL);
//
//
//    $resultAL = mysql_query($sqlAL);
//    //print_r($resultAL[0]);
//    
//    
//    
//    $objAS->export_to_csv($resultAL,array(
//        'ID'=>'ID'
//        ,'FirstName'=>'FirstName'
//        ,'MiddelName'=>'MiddelName'
//        ,'LastName'=>'LastName'
//        ,'Department'=>'Department'
//        ,'Working_Day'=>'Working_Day'
//        ,'Total_Leave_Days'=>'Total_Leave_Days'
//        ,'DayOT_Hour'=>'DayOT_Hour'
//        ,'NightOT_Hour'=>'NightOT_Hour'
//        ,'OffDayOT_Hour'=>'OffDayOT_Hour'
//        ,'HolyDayOT_Hour'=>'HolyDayOT_Hour'
//        ));
//}
?>

