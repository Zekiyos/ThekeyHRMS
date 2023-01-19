<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Untitled Document</title>
    </head>

    <body>
        <div id="sidebar">
            <div id="sidemenu">

                <ul id="MenuBar2" class="MenuBarVertical">
                    <li><a href="#"><?php echo $obj_lang->get('Tools', $lang); ?></a>
                        <ul>
                            <li><a href="javascript:popup('Calendar/CalendarConvertor.html')"><?php echo $obj_lang->get('Calendar Convertor', $lang); ?></a></li>
                            <li><a href="../Calendar/GeorgianEthiopianYearlyCalendar.html" target="_blank"><?php echo $obj_lang->get('Calendar', $lang); ?></a></li>
                            <li><a href="javascript:popup('Calendar/Time.html')"><?php echo $obj_lang->get('Time', $lang); ?></a></li>
                        </ul>
                    </li>
                    <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Personal Detail', $lang); ?></a>
                        <ul>
                            <li><a href="../../Recruitment/Probation_Evaluation.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Probation Period Evaluation', $lang); ?></a>       </li>
                            <li><a href="../../Personal_Record/Employee_Personal_Record.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Personal Detail entry', $lang); ?></a></li>
                            <li><a href="../../Database_Update/PersonalRecordDisplay.php?lang=<?php echo $_REQUEST['lang']; ?>" target="_blank"><?php echo $obj_lang->get('Personal Detail Search', $lang); ?></a></li>
                            <li><a href="../../Recruitment/Recruitment_Data_Update/ProbationPersonalRecordDisplay.php?lang=<?php echo $_REQUEST['lang']; ?>" title="Probation Period Personal Record Search" target="_blank"><?php echo $obj_lang->get('Probation Period Record Search', $lang); ?></a></li>
                        </ul>
                    </li>
                    <li><a class="MenuBarItemSubmenu" href="#"><?php echo $obj_lang->get('Employee Status Transaction', $lang); ?></a>
                        <ul>
                            <li><a href="../../Employee_Status_Transaction/Department_Transfer.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Department Transfer', $lang); ?></a></li>
                            <li><a href="../../Employee_Status_Transaction/Promotion.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Promotion', $lang); ?></a></li>
                            <li><a href="../../Employee_Status_Transaction/Demotion.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Demotion', $lang); ?></a></li>
                            <li><a href="../../Court_Case/Court_Case.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Court Case', $lang); ?></a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="MenuBarItemSubmenu" target="_blank" href="#" ><?php echo $obj_lang->get('Attendance System', $lang); ?></a>
                        <ul>
                            <li>
                                <span
                                    title="N.B - It Works Only from Home Page."
                                    onmouseover="this.style.backgroundColor='#ebeff9'"
                                    onmouseout="this.style.backgroundColor='#F2F2F2'">
                                    <a  onclick="TINY.box.show({url:'Attendance System/Department_Selection.php',width:350,height:500})" ><?php echo $obj_lang->get('Attendance Allocation', $lang); ?></a>
                                </span>
                            </li>
                            <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Overtime Difinition', $lang); ?></a>
                                <ul>
                                    <li><a href="../../Attendance_System/OT_Definition/OT_Definition_Department.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Departmental', $lang); ?></a></li>
                                    <li><a href="../../Attendance_System/OT_Definition/OT_Definition1.php?lang=<?php echo $_REQUEST['lang']; ?>" target="_blank" ><?php echo $obj_lang->get('Individual', $lang); ?></a></li>
                                </ul>
                            </li>
                            <li><a href="#" ><?php echo $obj_lang->get('Working Time Definition', $lang); ?></a>
                                <ul>
                                    <li><a href="../../Attendance_System/Working_Time_Definition.php?lang=<?php echo $_REQUEST['lang']; ?>" ><?php echo $obj_lang->get('Departmental', $lang); ?></a></li>
                                    <li><a href="../../Attendance_System/Working_Time_Definition.php?lang=<?php echo $_REQUEST['lang']; ?>" ><?php echo $obj_lang->get('Individual', $lang); ?></a></li>
                                </ul>         
                            </li>  

                        </ul>
                    </li>

                    <li><a target="_blank" href="../../Proclamation/Ethiopian Labour Law Pro.377(English).htm"><?php echo $obj_lang->get('Labour Law Proclamation', $lang); ?></a></li>
                    <li><a href="#" class="MenuBarItemSubmenu"> <?php echo $obj_lang->get('HRM System Settings...', $lang); ?></a>
                        <ul>
                            <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('System Data Setting', $lang); ?></a>
                                <ul>
                                    <li><a href="../../Database_Update/CreatDepartment.php"><?php echo $obj_lang->get('Creat Department', $lang); ?></a></li>
                                    <li><a href="../../Delete_Display/DepartmentDisplay.php" target="_blank"><?php echo $obj_lang->get('Department Data', $lang); ?></a></li>
                                    <li><a href="../../Recruitment/Recruitment_Data_Update/RecruitmentDisplay.php" title="Recruitment Data" target="_blank"><?php echo $obj_lang->get('Recruitment Data', $lang); ?></a></li>
                                    <li><a href="../../Recruitment/ProbationEvaluation_Update/ProbationEvaluationDisplay.php" title="Probation Evaluation Data" target="_blank"><?php echo $obj_lang->get('Probation Evalution Data', $lang); ?></a></li>
                                    <li><a href="../../Delete_Display/EquipmentHandOverDisplay.php" title="Equipment handover Data" target="_blank"><?php echo $obj_lang->get('Equipment Handover Data', $lang); ?></a></li>
                                    <li><a href="../../Letters/warning_Letters/Disciplinary_Action_ Database_Update/DisciplinaryDataDisplay.php" title="Disciplinary Action Data" target="_blank"><?php echo $obj_lang->get('Disciplinary Action  Data', $lang); ?></a></li>
                                    <li><a href="../../Delete_Display/PromotionDisplay.php" title="Promotion Data" target="_blank"><?php echo $obj_lang->get('Promotion Data', $lang); ?></a></li>
                                    <li><a href="../../Delete_Display/DemotionDisplay.php" title="Demotion Data" target="_blank"><?php echo $obj_lang->get('Demotion Data', $lang); ?></a></li>
                                    <li><a href="../../Letters/warning Letters/Disciplinary_Action_ Database_Update/TerminationDisplay.php" title="Termination Data" target="_blank"><?php echo $obj_lang->get('Termination Data', $lang); ?></a></li>
                                </ul>
                            </li>
                            <li><a href="#"><?php echo $obj_lang->get('Leave Data Setting', $lang); ?></a>
                                <ul>
                                    <li><a href="../../Delete_Display/AnnualLeaveDisplay.php" title="Annual Leave Data" target="_blank"><?php echo $obj_lang->get('Annual Leave Data', $lang); ?></a></li>
                                    <li><a href="../../Leaves/Leave Database_Update/AnnualLeaveCalcDisplay.php" title="Annual Leave Calc" target="_blank"><?php echo $obj_lang->get('Annual Leave Calc', $lang); ?></a></li>
                                    <li><a href="../../Delete_Display/FuneralLeaveDisplay.php" title="Funeral Leave Data" target="_blank"><?php echo $obj_lang->get('Funeral Leave Data', $lang); ?></a></li>
                                    <li><a href="../../Delete_Display/SickLeaveDisplay.php" title="Sick Leave Data" target="_blank"><?php echo $obj_lang->get('Sick Leave Data', $lang); ?></a></li>
                                    <li><a href="../../Leaves/Leave Database_Update/SpecialLeave_Update/SpecialLeaveDisplay.php" title="Special Leave Data" target="_blank"><?php echo $obj_lang->get('Special Leave Data', $lang); ?></a></li>
                                    <li><a href="../../Delete_Display/MaternityLeaveDisplay.php" title="Maternity Leave Data" target="_blank"><?php echo $obj_lang->get('Maternity Leave Data', $lang); ?></a></li>
                                    <li><a href="../../Delete_Display/WeddingLeaveDisplay.php" title="Wedding Leave Data" target="_blank"><?php echo $obj_lang->get('Wedding Leave Data', $lang); ?></a></li>
                                </ul></li>
                            <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('User account', $lang); ?></a>
                                <ul>
                                    <li><a href="../../User_Account/Creat_Account.php"><?php echo $obj_lang->get('Creat User Account', $lang); ?></a></li>
                                    <li><a href="../../User_Account/Change_Password.php"><?php echo $obj_lang->get('Change Password', $lang); ?></a></li>
                                    <li><a href="../../User_Account/Delete_Account.php"><?php echo $obj_lang->get('Delete User Account', $lang); ?></a></li>
                                </ul>
                            </li>

                            <li><a href=""><?php echo $obj_lang->get('Access Level', $lang); ?></a>
                                <ul>
                                    <li><a href="../../Classes/Creat_Access_Level.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Creat Access Level', $lang); ?></a></li>      
                                    <li><a href="../../User_Account/Access_Level_Grant.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Access Level Grant', $lang); ?></a></li>      
                                    <li><a href="../../User Account/Access_Level_Display.php"><?php echo $obj_lang->get('Access Level Data ...', $lang); ?></a></li>            

                                </ul>

                                <li><a href="<?php echo $logoutAction ?>"><?php echo $obj_lang->get('Log Out', $lang); ?></a></li>
                        </ul>
                    </li>
                </ul>
             <!--<p><a href="main_template.html">side menu 1</a>
                   <p><a href="about.html">side menu 1</a>      
                   <p><a href="about.html">side menu 1</a>
                   </p>
                   <a href="about.html">side menu 1</a>
             <p>side menu 1</p>
             <p><a href="about.html">side menu 1</a></p>
                -->
            </div>
            <div id="sidecontent">

                <!-- TemplateBeginEditable name="SideContent" -->

                <br />
                <br />

                <?php require_once ("../ALNotification.php"); ?>









                <!-- TemplateEndEditable -->


            </div>
        </div>
    </body>
</html>