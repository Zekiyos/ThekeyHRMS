<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Untitled Document</title>
    </head>

    <body>
        <div id="headerimg">
            <div class="menu_nav">


                <ul id="MenuBar1" class="MenuBarHorizontal">
                    <li><a href="../../index2.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Home', $lang); ?></a>        </li>
                    <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Recruitment', $lang); ?></a>
                        <ul>
                            <li><a href="../../Recruitment/Recruitment.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Recruitment Form', $lang); ?></a></li>
                            <li><a href="../../Recruitment/Photo Capture/Capture.php" target="_blank"><?php echo $obj_lang->get('Photo Capturing', $lang); ?></a></li>
                            <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Equipment Handover', $lang); ?></a>
                                <ul>
                                    <li><a href="../../Equipment_HandOver/Equipment_HandOver.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Equipment Handover', $lang); ?></a></li>
                                    <li><a href="../../Equipment_HandOver/Equipment_ReturnBack.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Equipment TookOver', $lang); ?></a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="../../Personal_Record/Personal_Information_Detail.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Personal   Info', $lang); ?></a></li>
                    <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Leave', $lang); ?></a>
                        <ul>
                            <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Annual Leave', $lang); ?></a>
                                <ul>
                                    <li><a href="../../Leaves/CalculateAnnualLeave.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Annual Leave Calculator', $lang); ?></a></li>
                                    <li><a href="../../Leaves/CalculateALPayment.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('AL Payment Calculator', $lang); ?></a></li>
                                    <li><a href="../../Leaves/Annual_Leave_Grant.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Annual Leave Grant', $lang); ?></a></li>
                                </ul>
                            </li>
                            <li><a href="../../Leaves/Funeral_Leave_Grant.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Funeral Leave', $lang); ?></a></li>
                            <li><a href="../../Leaves/Maternity_Leave_Grant.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Maternity Leave', $lang); ?></a></li>
                            <li><a href="../../Leaves/Paternity_Leave_Grant.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Paternity Leave', $lang); ?></a></li>
                            <li><a href="../../Leaves/Sick_Leave_Grant.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Sick Leave', $lang); ?></a></li>
                            <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Special Leave', $lang); ?></a>
                                <ul>
                                    <li><a href="../../Leaves/Special_Leave_Grant.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Special Leave With Payment', $lang); ?></a></li>
                                    <li><a href="../../Leaves/Special_Leave_GrantWithoutPayment.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Special Leave Without Payment', $lang); ?></a></li>
                                </ul>
                            </li>
                            <li><a href="../../Leaves/Wedding_Leave_Grant.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Wedding Leave', $lang); ?></a></li>
                            <li><a href="../../Leaves/Back_From_Leave_Report.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Back to Work Report', $lang); ?></a></li>
                        </ul>
                    </li>
                    <li><a class="MenuBarItemSubmenu" href="#"><?php echo $obj_lang->get('Disciplinary Action', $lang); ?></a>
                        <ul>
                            <li><a href="../../Letters/warning_Letters/Verbal_Warning.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Verbal Warning', $lang); ?></a>            </li>
                            <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Written Warning', $lang); ?></a>
                                <ul>
                                    <li><a href="../../Letters/warning_Letters/First_Instance_Warning.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('1st Instance Warning', $lang); ?></a></li>
                                    <li><a href="../../Letters/warning_Letters/Second_Instance_Warning.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('2nd Instance Warning', $lang); ?></a></li>
                                    <li><a href="../../Letters/warning_Letters/Third_Instance_Warning.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('3rd Instance Warning', $lang); ?></a></li>
                                    <li><a href="../../Letters/warning_Letters/Last_Warning.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Last Warning', $lang); ?></a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Dismissal / Termination', $lang); ?></a>
                                <ul>
                                    <li><a href="../../Termination/Termination.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Termination Form', $lang); ?></a></li>
                                    <li><a href="../../Termination/Termination4ProbationPeriod.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Probation Period Termination', $lang); ?></a></li>
                                    <li><a href="#"><?php echo $obj_lang->get('Termination Letter', $lang); ?></a></li>
                                </ul>
                            </li>
                            <li><a href="javascript: if (confirm('Are You Sure You want to remove Expired Warning?')) { window.location.href='../Letters/warning Letters/Expired_Warning_Remover.php' } else { void('') }; "><?php echo $obj_lang->get('Expired Warning Remover', $lang); ?></a></li>
                            <li><a href="../../Letters/warning_Letters/Warning_Letters_Viewer.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Warning Letter Viewer', $lang); ?></a></li>
                        </ul>
                    </li>
                    <li><a href="http://localhost/Report/annual_leaverpt.php" target="_blank" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Report', $lang); ?></a>
                        <ul>
                            <li><a href="../../ThekeyHRMSReport/index.php" target="_blank"><?php echo $obj_lang->get('HRM Reports', $lang); ?></a></li>
                            <li><a href="http://localhost/ThekeyHRMSReport/Employee_Personal_Record_Detialsmry.php" target="_blank"><?php echo $obj_lang->get('Biometric Attendance Reports', $lang); ?></a></li>
                            <li><a href="../../Court_Case/CourtCaseFilter.php" target="_blank"><?php echo $obj_lang->get('Court Case Report', $lang); ?></a></li>
                            <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Payroll Report', $lang); ?></a>
                                <ul>
                                    <li><a href="javascript:popup('ThekeyPayrollReport/PayrollsheetReportSelection.php')"><?php echo $obj_lang->get('Payroll Sheet', $lang); ?></a></li>
                                    <li><a href="javascript:popup('ThekeyPayrollReport/AttendanceReportSelection.php')"><?php echo $obj_lang->get('Attendance', $lang); ?></a></li>
                                    <li><a href="javascript:popup('ThekeyPayrollReport/PayslipReportSelection.php')"><?php echo $obj_lang->get('Payslip', $lang); ?></a></li>
                                    <li><a href="javascript:popup('ThekeyPayrollReport/CurrencyDenominationReportSelection.php')"><?php echo $obj_lang->get('Currency Denomination', $lang); ?></a></li>
                                    <li><a href="javascript:popup('ThekeyPayrollReport/ProvidentFundReportSelection.php')"><?php echo $obj_lang->get('Provident Fund', $lang); ?></a></li>
                                    <li><a href="javascript:popup('ThekeyPayrollReport/PensionReportSelection.php')"><?php echo $obj_lang->get('Pension Report', $lang); ?></a></li>
                                    <li><a href="javascript:popup('ThekeyPayrollReport/LUContributionReportSelection.php')"><?php echo $obj_lang->get('Labour Union Contribution', $lang); ?></a></li>
                                </ul>
                            </li>
                            <li><a href="../../Salary_Increment_Report/SalaryIncrementReport.php" target="_blank"><?php echo $obj_lang->get('Salary Increment', $lang); ?></a></li>
                        </ul>
                    </li>
                    <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Organization', $lang); ?></a>
                        <ul>
                            <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Contract', $lang); ?></a>
                                <ul>
                                    <li><a href="../../Letters/Contract Letters/Creat Contract Letter.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Creat New Contract', $lang); ?></a></li>
                                    <li><a href="../../Letters/Contract Letters/Contract Letter.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Contract Letter', $lang); ?></a></li>
                                </ul>
                            </li>
                            <li><a href="../../Organization/Policy.pdf" target="_blank"><?php echo $obj_lang->get('Policy', $lang); ?></a></li>
                            <li><a href="../../Organization/Plan.pdf" target="_blank"><?php echo $obj_lang->get('Plan', $lang); ?></a></li>
                            <li><a href="../../Organization/Procedure.pdf" target="blank"><?php echo $obj_lang->get('Procedure', $lang); ?></a></li>
                            <li><a href="../../Organization/CBA.pdf" target="_blank"><?php echo $obj_lang->get('CBA', $lang); ?></a></li>
                        </ul>
                    </li>
                    <li><a href="#" class="MenuBarItemSubmenu"><?php echo $obj_lang->get('Benefits', $lang); ?></a>
                        <ul>
                            <li><a href="../../Medical/Medical_Referral.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Medical Referral From', $lang); ?></a></li>
                            <li><a href="../../Medical/Cholinesterase_Test.php?lang=<?php echo $_REQUEST['lang']; ?>" title="Cholinesterase Test"><?php echo $obj_lang->get('Cholinesterase Test', $lang); ?></a></li>
                            <li><a href="../../Training/Training.php?lang=<?php echo $_REQUEST['lang']; ?>"><?php echo $obj_lang->get('Training', $lang); ?></a></li>
                        </ul>
                    </li>
                </ul>
                <?php echo "<font face=\"Times New Roman, Times, serif\" size=\"+1\"><b>logged in as " . $_SESSION['MM_Fullname'] . "</b></font>"; ?>
            </div>
        </div>
    </body>
</html>