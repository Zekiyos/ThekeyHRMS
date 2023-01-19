<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <title>Sher Annual Leave Application Form</title>
        <style>
            #header > *
            {
                float: left;
            }

            #header > img
            {
                width: 206px;
                height: 93px;
            }

            #mainContent
            {
                clear: both;
            }

            ul
            {
                list-style: none;
                clear: both;
            }
            ul li
            {
                float: left;
                margin-right: 10px;

            }
            ul li.clear_line
            {
                clear: both;
            }
            
            ul li.new_line
            {
                margin-top: 20px;
                margin-bottom: 20px;
            }

        </style>
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
    </head>

    <body>
        <?php
        require_once('../../Connections/HRMS.php');
        $base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
        require_once $base_path . 'config/database.php';
        require_once $base_path . 'lib/database.php';
        require_once('../../Classes/Class_Leave.php');

        if (!defined('validurl'))
            define("validurl", TRUE);
        $base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
        $port = $_SERVER['SERVER_PORT'];
        if ($port == 80) {
            $port = '';
        } else {
            if (!preg_match('/[:]/', $port))
                $port = ':' . $port;
        }
        $base_url = 'http://' . $_SERVER['SERVER_NAME'] . $port . '/';

        $mydb = new DataBase();
        $company_info = array();
        $result = $mydb->get('company_settings', 1);
        if ($result['count'] > 0) {
            $company_info = $result['result'][0];
        }

        $img_file = isset($company_info['Logo_Path']) ? $company_info['Logo_Path'] : '';

        $mydb->where('ID', $_GET['ID']);
        $result = $mydb->get('employee_personal_record');
        $employee_detail = array();
        if ($result['count'] > 0) {
            $employee_detail = $result['result'][0];
        }
        ?>

        <?php echo "<input type=button value=\"Print Out\" onclick=\"PrintContent()\" align=\"right\" >"; ?>
        <div align="left" id="AL_Application_Form" >
            <div id="header">
                <img src="<?php echo $base_url . $img_file ?>"  />
                <p align="center">
                    <strong><?php echo isset($company_info['company_name_am']) ? $company_info['company_name_am'] : '' ?></strong>
                    <br/>
                    <strong><?php echo isset($company_info['Company_Name']) ? $company_info['Company_Name'] : '' ?></strong><br />
                    <strong>የፍቃድ መጠየቂያ ፎርም</strong><br />
                    <strong><u>LEAVE APPLICATION FORM</u></strong><br />
                </p>
            </div>
            <div id="mainContent">

                <ul>
                    <li class="new_line">
                        <strong>ክፍል 1</strong><br />
                        PART 1<br />
                    </li>
                    <li class="clear_line">
                        የአመልካች ስም  <br />
                        NAME OF Applicant (MR/MRS/MS)
                    </li>
                    <li>
                        <?php echo isset($_GET['FirstName']) ? $_GET['FirstName'] . ' ' . $_GET['MiddelName'] . ' ' . $_GET['LastName'] : ''; ?>
                    </li>
                    <li>
                        የፔይሮል ቁ<br/>
                        P/NO
                    </li>
                    <li>
                        <?php echo isset($_GET['ID']) ? $_GET['ID'] : ''; ?>
                    </li>
                    <li class="clear_line">
                        ክፍል<br />
                        DEPARTMENT
                    </li>
                    <li>
                        <?php echo isset($employee_detail['Department']) ? $employee_detail['Department'] : '' ?>
                    </li>
                    <li>
                        ኃላፊነት<br/>
                        Position
                    </li>
                    <li>
                        <?php echo isset($employee_detail['Position']) ? $employee_detail['Position'] : '' ?>
                    </li>
                    <li class="clear_line">
                        የተጠየቀው ቀን ብዛት
                    </li>
                    <li class="clear_line">
                        1. I wish to apply for <?php echo isset($_GET['Leavedays']) ? $_GET['Leavedays'] : '' ?>
                        leave days from ______ Crop year starting from 
                        <?php echo isset($_GET['Leave_Taken_Date']) ? $_GET['Leave_Taken_Date'] : ''; ?>
                    </li>
                    <li class="clear_line">
                        የፍቃድ ጊዜ አድራሻ የመኖሪያ አድራሻ ክ/ከተማ           ቀበሌ<br />
                        My contact during  leave:-Residential Address kifle ketema<u>   </u>kebele<u>          </u>
                    </li>
                    <li>
                        ስልክ<br />
                        Tel.<u>                                             </u><br />
                    </li>
                    <li class="clear_line">
                        ፊርማ                     <br />
                        Signature<u>                        </u>
                    </li>
                    <li>
                        ቀን<br/>
                        Date<u>                    </u><br />
                    </li>
                    <li class="clear_line">
                        <?php
                        if (isset($_GET['TotalLeftDays']) and isset($_GET['initialALdays']) and isset($_GET['Date_Employement'])) {
                            $obj_leave = new leave();
                            echo $obj_leave->ALYearAllocation($_GET['TotalLeftDays'], $_GET['initialALdays'], $_GET['Annual_Leave_CONST_Year'], $_GET['Date_Employement']) . "<br>";
                        }
                        ?>
                    </li>
                </ul>


                <ul>
                    <li>………………………………………………………………………………………….</li>
                    <li class="new_line clear_line">
                        ክፍል 2<br />
                        Part 2             (<u>FOR OFFICIAL USE ONLY)</u><br />
                       
                    </li>
                    <li class="clear_line">
                         የኃላፊ አስተያየት <br/>
                        Authorized Statement<u>                                                                                                           </u></li>
                    <li class="clear_line">
                        ሥም                    ፊርማ                        ቀን<br />
                        NAME<u>                </u>Signature<u>                     </u>Date<u>              </u><br />
                        (General Manager/Dep’t  Head/Supervisor)
                    </li>
                    <li class="clear_line new_line">
                        ክፍል3<br />
                        Part3<br />
                    </li>
                    <li class="clear_line">
                        አመልካቹ                         የዕረፍት ቀን<br />
                        The applicant is granted 
                        <?php echo isset($_GET['Leavedays']) ? $_GET['Leavedays'] : ''; ?>
                        leave day’s plus
                        <?php isset($_GET['Restday']) ? $_GET['Restday'] : ''; ?>
                        rest day’s we’ve and
                    </li>
                    <li>
                        የሚመለስበት ቀን           የሚቀረው ቀን<br />
                        Should report on
                        <?php echo isset($_GET['ReportOn']) ? $_GET['ReportOn'] : ''; ?>
                        the balance of leave days carried  forward will be<u>           </u>
                    </li>
                    <li class="clear_line">
                        ከ                                      <br />
                        As at<u>             </u>                      <br />
                        ፊርማ                           ቀን<br />
                        Signature<u>                        </u>Date<u>                                </u> <br />
                        (General Manager/Human  Resources Manage)<br />
                    </li>
                    <li class="clear_line new_line">
                        ስርጭት    
                         <br />
                         Distribution: 
                    </li>
                    <li class="clear_line" >
                        ዋና ለአመልካቹ <br />
                         Original-Applicant<br />
                        ኮፒ  ለግል ማህደር<br />
                        Duplicate-Personal File<br />
                    </li>
                </ul>

            </div>
           

        </div>
    </body>
</html>