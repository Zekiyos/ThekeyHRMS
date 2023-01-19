<?php

$menu_list = array(
    'Recruitment' => array(
        'Recruitment Form' => 'Recruitment/Recruitment.php',
        'Recruitment Data' => 'Recruitment/Recruitment_Data_Update/index.php',
        'Photo Capturing' => 'Recruitment/Photo_Capture/Capture.php',
        'ID Card' => 'Personal_Record/id.php',
        'Probation Period Evaluation' => 'Recruitment/Probation_Evaluation.php',
        'Probation Evalution Data' => 'Recruitment/ProbationEvaluation_Update/index.php',
        'Equipment Handover' => array(
            'Equipment Handover' => 'Equipment_HandOver/Equipment_HandOver.php',
            'Equipment Handover Data' => 'Equipment_HandOver/Equipment_Handover_Database_Update/index.php',
            'Equipment Returning' => 'Equipment_HandOver/Equipment_ReturnBack.php')
    ),
    'Personal Info' => array(
        'Personal Info' => 'Personal_Record/index.php',
    ),
    'Leave' => array(
        'Annual Leave' => array(
            'Annual Leave Grant' => 'Leaves/Annual_Leave_Grant.php',
            'Annual Leave Calculate' => 'Leaves/CalculateAnnualLeave.php'
            , 'Calculate Annual Leave Payment' => 'Leaves/CalculateALPayment.php'),
        'Funeral Leave Grant' => 'Leaves/Funeral_Leave_Grant.php',
        'Maternity Leave Grant' => 'Leaves/Maternity_Leave_Grant.php',
        'Paternity Leave Grant' => 'Leaves/Paternity_Leave_Grant.php',
        'Sick Leave Grant' => 'Leaves/Sick_Leave_Grant.php',
        'Special Leave' => array(
            'Leave With Payment Grant' => 'Leaves/Special_Leave_Grant.php',
            'Leave Without Payment Grant' => 'Leaves/Special_Leave_GrantWithoutPayment.php'
        ),
        'Wedding Leave Grant' => 'Leaves/Wedding_Leave_Grant.php',
        'Back to Work' => 'Leaves/Back_From_Leave_Report.php'
    ),
    'Disciplinary Action' => array(
        'Verbal Warning' => 'Letters/warning_Letters/Verbal_Warning.php',
        'Written Warning' => array(
            'First Inistance Warning' => 'Letters/warning_Letters/First_Instance_Warning.php',
            'Second Inistance Warning' => 'Letters/warning_Letters/Second_Instance_Warning.php',
            'Third Inistance Warning' => 'Letters/warning_Letters/Third_Instance_Warning.php',
            'Last Inistance Warning' => 'Letters/warning_Letters/Last_Warning.php'),
        'Suspension' => 'Leaves/Suspension.php',
        'Dismissal / Termination' => array(
            'Termination Form' => 'Termination/Termination.php',
			'Termination Probation Period Form' => 'Termination/Termination_Probation_Period.php',
            'Termination Letter' => '',
            'Terminated Employee Cleaner' => 'Termination/Terminated_Employee_Cleaner/Terminated_Employee_CleanerSetup.php',
            'Terminated Employee Rollback' => 'Termination/Terminated_Employee_Rollback/Terminated_Employee_RollbackSetup.php'),
        'Expired Warning Remover' => 'Letters/warning_Letters/Expired_Warning_Remover.php',
        'Warning Letter Viewer' => 'Letters/Warning_Letters/Warning_Letters_Viewer.php'
    ),
    'Organization' => array(
        'Contract' => array(
            'Creat New Contract' => 'Letters/Contract_Letters/Creat_Contract_Letter.php',
            'Contract Letter' => 'Letters/Contract_Letters/Contract_Letter.php'
        ),
        'Policy' => 'Organization/Policy.pdf',
        'Plan' => 'Organization/Plan.pdf',
        'Procedure' => 'Organization/Procedure.pdf',
        'CBA' => 'Organization/CBA.pdf'
    ),
    'Benefits' => array(
        'Medical Referral From' => 'Medical/Medical_Referral.php',
        'Health Care Insurance' => array(
            'Health Care Insurance' => 'Medical/Health_Care_Insurance.php',
            'Health Care Insurance Definition' => 'Medical/Health_Care_Insurance_Definition.php'),
        'Cholinesterase Test' => 'Medical/Cholinesterase_Test.php',
        'Training' => 'Training/Training.php',
        'Training Data' => 'Training/Training_Update/index.php'
    ),
    'Employee Status' => array(
        'Department Transfer' => 'Employee_Status_Transaction/Department_Transfer.php',
        'Promotion' => 'Employee_Status_Transaction/Promotion.php',
        'Demotion' => 'Employee_Status_Transaction/Demotion.php',
        'Salary Increment' => array(
            'Salary Increment Setup' => 'Salary_Increment_Report/SalaryIncrementSetup.php',
            'Salary Increment Definition' => 'Salary_Increment_Report/Salary_Increment_Database_Update/SalaryIncrementDefinationCreat.php'
        ),
        'Payroll Data Setting' => array(
            'Payroll Dedcution Data Setting' => 'Payroll_Data_Settings/PayrollDataSettingSetup.php',
            'Attendance Data Setting' => 'Payroll_Data_Settings/WeekPayrollDataSettingSetup.php'
        ),
        'Court Case' => 'Court_Case/Court_Case.php'
    ),
    'Attendance' => array(
        'Attendance Allocation' => 'Attendance_System/Attendance_Allocation.php',
		'Attendance Allocation Result' => 'Attendance_System/Show_Attendance_Allocation.php',
        'Overtime Difinition' => array(
            'Departmental OT' => 'Attendance_System/OT_Definition/OT_Definition_Department.php',
            'Departmental OT Multiple' => 'Attendance_System/OT_Definition/OT_Definition_Department_Multiple.php',
            'Individual OT' => 'Attendance_System/OT_Definition/OT_Definition1.php'),
        'Working Time Definition' => array(
            'Departmental' => 'Attendance_System/Working_Time_Definition.php',
            'Departmental Multiple' => 'Attendance_System/Working_Time_Definition_Multiple.php',
            'Individual' => 'Attendance_System/Working_Time_Definition_Individual.php'
        ),
        'Late Tolerance Definition' => 'Attendance_System/Late_Tolerance_Definition.php',
        'Off Day Definition' => 'Attendance_System/OffDay_Definition.php',
        'Holyday Definition' => 'Attendance_System/Holyday_Definition.php',
        //'Attendance Scan Sheet Importer' => 'Attendance_System/Attendance_Scan_Sheet_Importer.php',
        //'Attendance Cleaner' => 'Attendance_System/Attendance_Cleaner.php',
        'Attendance Summarizer' => 'Attendance_System/Attendance_Summarizer.php',
        'Attendance User' => 'Attendance_System/Attendance_User.php',
        'Attendance Summary' => 'Attendance_System/Attendance_Summary.php'
    ),
	'Report' => array(
	'Production Managment System' => array(
            'Daily Production Entry' => '/Production_Managment/Daily_Production.php',
            'Creat Production Account' => '/Production_Managment/Production_Account_Department_Selection.php',
            'Production Report' => '/Production_Managment/Production_Report.php',
        ),
        'Employee Personal Record' => array(
            'Employee Personal Record' => 'report/Report_Display.php?report=Employee Personal Record',
            'Department Transfer Report' => 'report/Report_Display.php?report=Department Transfer',
            'Terminated Employee Report' => 'report/Report_Display.php?report=Terminated Employee',
        ),
        'Recruitment Personal Record' => array(
            'Recruitment Personal Record' => 'report/Report_Display.php?report=Recruitment Personal Record',
        //'Absent Day Recruitment Report' => 'report/Report_Display.php?report=Absent Day Recruitment',
        // 'Absent Day Termination Report' => 'report/Report_Display.php?report=Absent Day Termination'
        ),
        'Attendance Report' => array(
            'Attendance Allocation' => 'report/Report_Display.php?report=Attendance Allocation',
            'Attendance Scan Sheet' => 'report/Report_Display.php?report=Attendance Scan Sheet'
        ),
        'Training Report' => array(
            'Training Report' => 'report/Report_Display.php?report=Training',
        ),
        'Medical Report' => array(
            'Cholinesterase Test Report' => 'report/Report_Display.php?report=cholinesterase Test',
            'Medical Referral Report' => 'report/Report_Display.php?report=Medical Referral',
            'Health Care Insurance Report' => 'report/Report_Display.php?report=Health Care Insurance',
        ),
        'Leave Report' => array(
            'Total Leave Taken Report' => 'report/Report_Display.php?report=Total Leave Taken',
            'Annual Leave Report' => 'report/Report_Display.php?report=Annual Leave',
            'Sick Leave Report' => 'report/Report_Display.php?report=Sick Leave',
            'Funeral Leave Report' => 'report/Report_Display.php?report=Funeral Leave',
            'Maternity Leave Report' => 'report/Report_Display.php?report=Maternity Leave',
            'Paternity Leave Report' => 'report/Report_Display.php?report=Paternity Leave',
            'Wedding Leave Report' => 'report/Report_Display.php?report=Wedding Leave',
        ),
        'Terminated Employee Leave' => array(
            'Annual Leave' => 'report/Report_Display.php?report=Terminated Employee Annual Leave',
            'Sick Leave' => 'report/Report_Display.php?report=Terminated Employee Sick Leave',
            'Funeral Leave' => 'report/Report_Display.php?report=Terminated Employee Funeral Leave',
            'Maternity Leave' => 'report/Report_Display.php?report=Terminated Employee Maternity Leave',
            'Paternity Leave' => 'report/Report_Display.php?report=Terminated Employee Paternity Leave',
            'Wedding Leave' => 'report/Report_Display.php?report=Terminated Employee Wedding Leave',
        ),
        'Disciplinary Action Report' => 'report/Report_Display.php?report=Disciplinary Action',
        'Court Case Report' => 'report/Report_Display.php?report=Court Case',
        'User Defined Report' => 'report/User_Defined_Report_Selection.php',
		'User Defined Chart' => 'report/chart/User_Defined_Chart_Selection.php'
    ),
   
    'HRM System Settings' => array(
        'System Data Setting' => array(
            'XL Importer' => 'Database_Update/XL_Import.php',
            'Creat Department' => 'Database_Update/CreatDepartment.php',
            'Department Data' => 'Database_Update/Department_Update/index.php',
			'Creat Position' => 'Database_Update/CreatPosition.php',
            'Position Data' => 'Database_Update/Position_Update/index.php',
            'Disciplinary Action  Data' => 'Letters/warning_Letters/Disciplinary_Action_Database_Update/index.php',
            'Salary Increment Data' => 'Salary_Increment_Report/Salary_Increment_Database_Update/SalaryIncrementDisplay.php',
            'Promotion Data' => 'Employee_Status_Transaction/Employee_Status_Database_Update/Promotion_Update/index.php',
            'Demotion Data' => 'Employee_Status_Transaction/Employee_Status_Database_Update/Demotion_Update/index.php',
            'Termination Data' => 'Letters/warning_Letters/Disciplinary_Action_Database_Update/index.php',
            'Suspension Data' => 'Leaves/Suspension_data_update/index.php',
            'Court Case Data' => 'Court_Case/Court_Case_Database_Update/index.php'
        ),
        'Leave Data Setting' => array(
            'Annual Leave Data' => 'Leaves/Leave_Database_Update/AnnualLeave_Update/index.php',
            'Funeral Leave Data' => 'Leaves/Leave_Database_Update/FuneralLeave_Update/index.php',
            'Sick Leave Data' => 'Leaves/Leave_Database_Update/SickLeave_Update/index.php',
            'Special Leave Data' => 'Leaves/Leave_Database_Update/SpecialLeave_Update/index.php',
            'Paternity Leave Data' => 'Leaves/Leave_Database_Update/PaternityLeave_Update/index.php',
            'Maternity Leave Data' => 'Leaves/Leave_Database_Update/MaternityLeave_Update/index.php',
            'Wedding Leave Data' => 'Leaves/Leave_Database_Update/WeddingLeave_Update/index.php'
        ),
        'Benefit Data Setting' => array(
            'Medical Referral Data' => 'Medical/Medical_Update/MedicalReferral_Update/index.php',
            'Health Care Insurance Data' => 'Medical/Medical_Update/HealthCareInsurance_Update/index.php',
            'Health Care Insurance Definition Data' => 'Medical/Medical_Update/HealthCareInsuranceDefiniton_Update/index.php',
            'Cholinesterase Test Data' => 'Medical/Medical_Update/CholinesteraseTest_Update/index.php',
            'Training Data' => 'Training/Training_Update/index.php'
        ),
        'Attendance Data Setting' => array(
            'Off Day Definition Data' => 'Attendance_System/Biometric_Attendance_Database_Update/OffDay_Update/index.php',
            'Working Time Setting Departmental Data' => 'Attendance_System/Biometric_Attendance_Database_Update/WorkingTimeSetting_Update/index.php',
            'Working Time Setting Individual Data' => 'Attendance_System/Biometric_Attendance_Database_Update/WorkingTimeIndivdual_Update/index.php',
            'OT Definition Departmental Data' => 'Attendance_System/Biometric_Attendance_Database_Update/OTDepartment_Update/index.php',
            'OT Definition Individual Data' => 'Attendance_System/Biometric_Attendance_Database_Update/OTIndivdual_Update/index.php',
            'Holyday Definition Data' => 'Attendance_System/Biometric_Attendance_Database_Update/HolyDay_Update/index.php',
            'Late Tolerance Definition Data' => 'Attendance_System/Biometric_Attendance_Database_Update/LateTolerance_Update/index.php',
            'Attendance User Data' => 'Attendance_System/Biometric_Attendance_Database_Update/AttendanceUser_Update/index.php'
        ),
        'User Account' => array(
            'Creat User Account' => 'User_Account/Creat_Account.php',
            'Access Level Grant' => 'User_Account/Access_Level_Grant.php',
            'Department Data Access' => 'User_Account/department_access_level_grant.php',
            'Change Password' => 'User_Account/Change_Password.php',
            'Delete User Account' => 'User_Account/index.php'
        )
    )
);

$newmenu = $menu_list;
if (isset($_SESSION['MM_UserGroup'])) {
    $mygroupis = $_SESSION['MM_UserGroup'];
    $my_role_is = $obj_AccessLevel->get_Granted_AccessLevel($mygroupis);

    $newmenu = clear_menu($menu_list, $my_role_is);
}
$my_menu_working_list = $menu_list;

function clear_menu($array, $items) {
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $result = clear_menu($value, $items);
            if (count($result) > 0) {
                $array[$key] = $result;
            } else {
                unset($array[$key]);
            }
        } else if (!isset($items[$key])) {
            unset($array[$key]);
        }
    }
    return $array;
}

?>
