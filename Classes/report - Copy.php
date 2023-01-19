<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class R_Report {

    var $result;
    var $header_info;
    var $error_message;
    private $report_list = array(
        /* Employee Personal Record eport */
        'Employee Personal Record' => array(
            'select' => array(
                'Section', 'Sub Section', 'Group', 'Department.Department',
                'employee_personal_record.FirstName', 'employee_personal_record.MiddelName',
                'employee_personal_record.LastName', 'employee_personal_record.Department',
                'employee_personal_record.Date_Employement'
            ),
            'from_table' => 'employee_personal_record',
            'join' => array(
                'department' => array(
                    'Department.Department', 'employee_personal_record.Department'
                )
            ),
        ),
        /* Department Transfer report */
        'Department Transfer' => array(
            'select' => array(
                'Section', 'Sub Section', 'Department.Department',
                'department_transfer.FirstName', 'department_transfer.MiddelName',
                'department_transfer.LastName', 'Position',
                'FromDepartment', 'ToDepartment', 'Position_AfterTransfered',
                'Transfered_Date'
            ),
            'from_table' => 'department_transfer',
            'join' => array(
                'department' => array(
                    'Department.Department', 'department_transfer.FromDepartment'
                )
            ),
        ),
        /* Terminated employee report */
        'Terminated Employee' => array(
            'select' => array(
                'Section', 'Sub Section', 'Department.Department',
                'terminated_employee.FirstName', 'terminated_employee.MiddelName',
                'terminated_employee.LastName',
                'terminated_employee.Department', 'Terminated_Date', 'Termination_Reason'
            ),
            'from_table' => 'terminated_employee',
            'join' => array(
                'department' => array(
                    'Department.Department', 'terminated_employee.Department'
                )
            ),
        ),
        /* Training report */
        'Training' => array(
            'select' => array(
                'Section', 'Sub Section', 'employee_personal_record.Department',
                'training.FirstName', 'training.MiddelName',
                'training.LastName', 'TrainingName',
                'Training_Start_Date', 'Training_End_Date', 'Refreshment_Date', 'Status'
            ),
            'from_table' => 'training',
            'join' => array(
                'employee_personal_record' => array(
                    'employee_personal_record.id', 'training.ID'
                ),
                'department' => array(
                    'department.Department', 'employee_personal_record.Department'
                )
            ),
        ),
        /* Recruitment Personal Record report */
        'Recruitment Personal Record' => array(
            'select' => array(
                'Section', 'Sub Section', 'Department.Department',
                'recruitment.FirstName', 'recruitment.MiddelName',
                'recruitment.LastName', 'recruitment.Department', 'recruitment.Date'
            ),
            'from_table' => 'recruitment',
            'join' => array(
                'department' => array(
                    'Department.Department', 'recruitment.Department'
                )
            ),
        ),
        
         /* Attendance System eport */
        'Attendance Report' => array(
            'select' => array(
                'Section', 'Sub Section', 'Department.Department',
                 'attendance_allocation.Date','attendance_allocation.ID',
                'attendance_allocation.FirstName','attendance_allocation.MiddelName',
  'attendance_allocation.LastName', 'attendance_allocation.Status'
            ),
            'from_table' => 'attendance_allocation',
            'join' => array(
                'department' => array(
                    'Department.Department', 'attendance_allocation.Department'
                )
            ),
              //'Where'=>array('attendance_allocation.Status','Absent'),
        ),
        /* Absent Day Recruitment Personal Record report */
        'Absent Day Recruitment' => array(
            'select' => array(
                'Section', 'Sub Section', 'Department.Department',
                'recruitment.FirstName', 'recruitment.MiddelName',
                'recruitment.LastName', 'recruitment.Department', 'absentday_recruitment.Recruitment_Date',
                'absentday_recruitment.MonthLastDay', 'absentday_recruitment.PresentDay', 'absentday_recruitment.AbsentDay_Recruitment'
            ),
            'from_table' => 'absentday_recruitment',
            'join' => array(
                'recruitment' => array(
                    'absentday_recruitment.ID', 'recruitment.id'
                )
                , 'department' => array(
                    'Department.Department', 'recruitment.Department'
                )
            ),
          
        ),
        /* Absent Day Termination Personal Record report */
        'Absent Day Termination' => array(
            'select' => array(
                'Section', 'Sub Section', 'Department.Department',
                'terminated_employee.FirstName', 'terminated_employee.MiddelName',
                'terminated_employee.LastName', 'terminated_employee.Department', 'absentday_termination.Terminated_Date',
                'absentday_termination.MonthLastDay', 'absentday_termination.PresentDay', 'absentday_termination.absentday_termination'
            ),
            'from_table' => 'absentday_termination',
            'join' => array(
                'terminated_employee' => array(
                    'absentday_termination.ID', 'terminated_employee.id'
                )
                , 'department' => array(
                    'Department.Department', 'terminated_employee.Department'
                )
            ),
        ),
        /* medical_referral report */
        'Medical Referral' => array(
            'select' => array(
                'Section', 'Sub Section', 'Department.Department',
                'medical_referral.FirstName', 'medical_referral.MiddelName',
                'medical_referral.LastName', 'medical_referral.Department',
                'Referral_Case', 'Treatment_Cost', 'Refferal_Date'
            ),
            'from_table' => 'medical_referral',
            'join' => array(
                'department' => array(
                    'Department.Department', 'medical_referral.Department'
                )
            ),
        ),
        /* Health Care Insurance report */
        'Health Care Insurance' => array(
            'select' => array(
                'Section', 'Sub Section', 'Department.Department',
                'health_care_insurance.FirstName', 'health_care_insurance.MiddelName',
                'health_care_insurance.LastName', 'health_care_insurance.Department',
                'Referral_Case', 'Treatment_Cost', 'Refferal_Date'
            ),
            'from_table' => 'health_care_insurance',
            'join' => array(
                'department' => array(
                    'Department.Department', 'health_care_insurance.Department'
                )
            ),
        ),
        /* cholinesterase test report */
        'Cholinesterase Test' => array(
            'select' => array(
                'Section', 'Sub Section', 'Department.Department',
                'cholinesterase_test.FirstName', 'cholinesterase_test.MiddelName',
                'cholinesterase_test.LastName', 'cholinesterase_test.Department',
                'LastResult', 'LastTestDate', 'FirstResult',
                'FirstTestDate', 'FirstDifference', 'SecondResult',
                'SecondTestDate', 'SecondDifference', 'ThirdResult',
                'ThirdTestDate', 'ThirdDifference', 'ForthResult',
                'ForthTestDate', 'ForthDifference', 'Year'
            ),
            'from_table' => 'cholinesterase_test',
            'join' => array(
                'department' => array(
                    'Department.Department', 'cholinesterase_test.Department'
                )
            ),
        ),
        /* Total Leave Taken report */
        'Total Leave Taken' => array(
            'select' => array(
                'Section', 'Sub Section', 'Department.Department',
                'total_leavedays.FirstName', 'total_leavedays.MiddelName',
                'employee_personal_record.LastName', 'employee_personal_record.Department',
                'MONTH', 'YEAR', 'ReportOn_MONTH', 'ReportOn_YEAR', 'LeaveType',
                'NoMonth', 'LeaveDays'
            ),
            'from_table' => 'total_leavedays',
            'join' => array(
                'employee_personal_record' => array(
                    'total_leavedays.ID', 'employee_personal_record.id'
                )
                , 'department' => array(
                    'Department.Department', 'employee_personal_record.Department'
                )
            ),
        ),
        /* Annual leave report */
        'Annual Leave' => array(
            'select' => array(
                'Section', 'Sub Section', 'Department.Department',
                'annual_leave.FirstName', 'annual_leave.MiddelName',
                'annual_leave.LastName', 'employee_personal_record.Department',
                'annual_leave.Leavedays', 'annual_leave.RestDay',
                'annual_leave.Leave_Taken_Date', 'annual_leave.ReportOn'
            ),
            'from_table' => 'annual_leave',
            'join' => array(
                'employee_personal_record' => array(
                    'annual_leave.ID', 'employee_personal_record.id'
                )
                , 'department' => array(
                    'Department.Department', 'employee_personal_record.Department'
                )
            ),
        ),
        /* Sick leave report */
        'Sick Leave' => array(
            'select' => array(
                'Section', 'Sub Section', 'Department.Department',
                'sick_leave.FirstName', 'sick_leave.MiddelName',
                'sick_leave.LastName', 'employee_personal_record.Department',
                'sick_leave.SickLeaveDays', 'sick_leave.SickLeave_Taken_Date',
                'sick_leave.ReportOn'
            ),
            'from_table' => 'sick_leave',
            'join' => array(
                'employee_personal_record' => array(
                    'sick_leave.ID', 'employee_personal_record.id'
                )
                , 'department' => array(
                    'Department.Department', 'employee_personal_record.Department'
                )
            ),
        ),
        /* Funeral leave report */
        'Funeral Leave' => array(
            'select' => array(
                'Section', 'Sub Section', 'Department.Department',
                'funeral_leave.FirstName', 'funeral_leave.MiddelName',
                'funeral_leave.LastName', 'employee_personal_record.Department',
                'funeral_leave.FuneralLeaveDays', 'funeral_leave.RestDay',
                'funeral_leave.FuneralLeave_Taken_Date', 'funeral_leave.ReportOn'
            ),
            'from_table' => 'funeral_leave',
            'join' => array(
                'employee_personal_record' => array(
                    'funeral_leave.ID', 'employee_personal_record.id'
                )
                , 'department' => array(
                    'Department.Department', 'employee_personal_record.Department'
                )
            ),
        ),
        /* Maternity leave report */
        'Maternity Leave' => array(
            'select' => array(
                'Section', 'Sub Section', 'Department.Department',
                'maternity_leave.FirstName', 'maternity_leave.MiddelName',
                'maternity_leave.LastName', 'employee_personal_record.Department',
                'maternity_leave.MaternityLeaveDays', 'maternity_leave.MaternityLeave_Taken_Date',
                'maternity_leave.ReportOn'
            ),
            'from_table' => 'maternity_leave',
            'join' => array(
                'employee_personal_record' => array(
                    'maternity_leave.ID', 'employee_personal_record.id'
                )
                , 'department' => array(
                    'Department.Department', 'employee_personal_record.Department'
                )
            ),
        ),
        /* Paternity leave report */
        'Paternity Leave' => array(
            'select' => array(
                'Section', 'Sub Section', 'Department.Department',
                'paternity_leave.FirstName', 'paternity_leave.MiddelName',
                'paternity_leave.LastName', 'employee_personal_record.Department',
                'paternity_leave.PaternityLeaveDays', 'paternity_leave.PaternityLeave_Taken_Date',
                'paternity_leave.ReportOn'
            ),
            'from_table' => 'paternity_leave',
            'join' => array(
                'employee_personal_record' => array(
                    'paternity_leave.ID', 'employee_personal_record.id'
                )
                , 'department' => array(
                    'Department.Department', 'employee_personal_record.Department'
                )
            ),
        ),
        /* Special leave report */
        'Special Leave' => array(
            'select' => array(
                'Section', 'Sub Section', 'Department.Department', 'LeaveType',
                'special_leave.FirstName', 'special_leave.MiddelName',
                'special_leave.LastName', 'employee_personal_record.Department',
                'special_leave.specialLeaveDays', 'special_leave.specialLeave_Taken_Date',
                'special_leave.ReportOn'
            ),
            'from_table' => 'special_leave',
            'join' => array(
                'employee_personal_record' => array(
                    'special_leave.ID', 'employee_personal_record.id'
                )
                , 'department' => array(
                    'Department.Department', 'employee_personal_record.Department'
                )
            ),
        ),
        /* Wedding leave report */
        'Wedding Leave' => array(
            'select' => array(
                'Section', 'Sub Section', 'Department.Department',
                'wedding_leave.FirstName', 'wedding_leave.MiddelName',
                'wedding_leave.LastName', 'employee_personal_record.Department',
                'wedding_leave.WeddingLeavedays', 'wedding_leave.RestDay', 'wedding_leave.WeddingLeave_TakenDate',
                'wedding_leave.ReportOn'
            ),
            'from_table' => 'wedding_leave',
            'join' => array(
                'employee_personal_record' => array(
                    'wedding_leave.ID', 'employee_personal_record.id'
                )
                , 'department' => array(
                    'Department.Department', 'employee_personal_record.Department'
                )
            ),
        ),
        /* Terminated Employee  Annual leave report */
        'Terminated Employee Annual Leave' => array(
            'select' => array(
                'Section', 'Sub Section', 'Department.Department',
                'terminated_employee_annual_leave.FirstName', 'terminated_employee_annual_leave.MiddelName',
                'terminated_employee_annual_leave.LastName', 'terminated_employee_personal_record.Department',
                'terminated_employee_annual_leave.Leavedays', 'terminated_employee_annual_leave.RestDay',
                'terminated_employee_annual_leave.Leave_Taken_Date', 'terminated_employee_annual_leave.ReportOn'
            ),
            'from_table' => 'terminated_employee_annual_leave',
            'join' => array(
                'terminated_employee_personal_record' => array(
                    'terminated_employee_annual_leave.ID', 'terminated_employee_personal_record.id'
                )
                , 'department' => array(
                    'Department.Department', 'terminated_employee_personal_record.Department'
                )
            ),
        ),
        /* Terminated Employee  Sick leave report */
        'Terminated Employee Sick Leave' => array(
            'select' => array(
                'Section', 'Sub Section', 'Department.Department',
                'terminated_employee_sick_leave.FirstName', 'terminated_employee_sick_leave.MiddelName',
                'terminated_employee_sick_leave.LastName', 'terminated_employee_personal_record.Department',
                'terminated_employee_sick_leave.SickLeaveDays',
                'terminated_employee_sick_leave.SickLeave_Taken_Date', 'terminated_employee_sick_leave.ReportOn'
            ),
            'from_table' => 'terminated_employee_sick_leave',
            'join' => array(
                'terminated_employee_personal_record' => array(
                    'terminated_employee_sick_leave.ID', 'terminated_employee_personal_record.id'
                )
                , 'department' => array(
                    'Department.Department', 'terminated_employee_personal_record.Department'
                )
            ),
        ),
        /* Terminated Employee  Funeral leave report */
        'Terminated Employee Funeral Leave' => array(
            'select' => array(
                'Section', 'Sub Section', 'Department.Department',
                'terminated_employee_funeral_leave.FirstName', 'terminated_employee_funeral_leave.MiddelName',
                'terminated_employee_funeral_leave.LastName', 'terminated_employee_personal_record.Department',
                'terminated_employee_funeral_leave.FuneralLeavedays', 'terminated_employee_funeral_leave.RestDay',
                'terminated_employee_funeral_leave.FuneralLeave_Taken_Date', 'terminated_employee_funeral_leave.ReportOn'
            ),
            'from_table' => 'terminated_employee_funeral_leave',
            'join' => array(
                'terminated_employee_personal_record' => array(
                    'terminated_employee_funeral_leave.ID', 'terminated_employee_personal_record.id'
                )
                , 'department' => array(
                    'Department.Department', 'terminated_employee_personal_record.Department'
                )
            ),
        ),
        /* Terminated Employee  Wedding leave report */
        'Terminated Employee Wedding Leave' => array(
            'select' => array(
                'Section', 'Sub Section', 'Department.Department',
                'terminated_employee_wedding_leave.FirstName', 'terminated_employee_wedding_leave.MiddelName',
                'terminated_employee_wedding_leave.LastName', 'terminated_employee_personal_record.Department',
                'terminated_employee_wedding_leave.WeddingLeavedays', 'terminated_employee_wedding_leave.RestDay',
                'terminated_employee_wedding_leave.WeddingLeave_TakenDate', 'terminated_employee_wedding_leave.ReportOn'
            ),
            'from_table' => 'terminated_employee_wedding_leave',
            'join' => array(
                'terminated_employee_personal_record' => array(
                    'terminated_employee_wedding_leave.ID', 'terminated_employee_personal_record.id'
                )
                , 'department' => array(
                    'Department.Department', 'terminated_employee_personal_record.Department'
                )
            ),
        ),
        /* Terminated Employee  Maternity leave report */
        'Terminated Employee Maternity Leave' => array(
            'select' => array(
                'Section', 'Sub Section', 'Department.Department',
                'terminated_employee_maternity_leave.FirstName', 'terminated_employee_maternity_leave.MiddelName',
                'terminated_employee_maternity_leave.LastName', 'terminated_employee_personal_record.Department',
                'terminated_employee_maternity_leave.MaternityLeavedays', 'terminated_employee_maternity_leave.MaternityLeave_Taken_Date',
                'terminated_employee_maternity_leave.ReportOn'
            ),
            'from_table' => 'terminated_employee_maternity_leave',
            'join' => array(
                'terminated_employee_personal_record' => array(
                    'terminated_employee_maternity_leave.ID', 'terminated_employee_personal_record.id'
                )
                , 'department' => array(
                    'Department.Department', 'terminated_employee_personal_record.Department'
                )
            ),
        ),
        /* Terminated Employee  Patrnity leave report */
        'Terminated Employee Paternity Leave' => array(
            'select' => array(
                'Section', 'Sub Section', 'Department.Department',
                'terminated_employee_Paternity_leave.FirstName', 'terminated_employee_Paternity_leave.MiddelName',
                'terminated_employee_Paternity_leave.LastName', 'terminated_employee_personal_record.Department',
                'terminated_employee_paternity_leave.PaternityLeavedays', 'terminated_employee_paternity_leave.PaternityLeave_Taken_Date',
                'terminated_employee_Paternity_leave.ReportOn'
            ),
            'from_table' => 'terminated_employee_Paternity_leave',
            'join' => array(
                'terminated_employee_personal_record' => array(
                    'terminated_employee_Paternity_leave.ID', 'terminated_employee_personal_record.id'
                )
                , 'department' => array(
                    'Department.Department', 'terminated_employee_personal_record.Department'
                )
            ),
        ),
        /* Terminated Employee  Special leave report */
        'Terminated Employee Special Leave' => array(
            'select' => array(
                'Section', 'Sub Section', 'Department.Department',
                'terminated_employee_Special_leave.FirstName', 'terminated_employee_Special_leave.MiddelName',
                'terminated_employee_Special_leave.LastName', 'terminated_employee_personal_record.Department',
                'terminated_employee_Special_leave.SpecialLeavedays', 'terminated_employee_Special_leave.SpecialLeave_Taken_Date',
                'terminated_employee_Special_leave.ReportOn'
            ),
            'from_table' => 'terminated_employee_Special_leave',
            'join' => array(
                'terminated_employee_personal_record' => array(
                    'terminated_employee_Special_leave.ID', 'terminated_employee_personal_record.id'
                )
                , 'department' => array(
                    'Department.Department', 'terminated_employee_personal_record.Department'
                )
            ),
        ),
        'Court Case' => array(
            'from_table' => ' court_case'
        )
    );

    function __construct() {
        $this->handle_event();
    }

    function handle_event() {
        if (isset($_REQUEST['report'])) {
            $report = $_REQUEST['report'];
            $this->reports($report, 'Show');
        }
        else
            echo 'No Report Selected';
    }

    function reports($report, $event) {
        $my_col_db = new DataBase();
        if (isset($this->report_list[$report])) {
            $report_info = $this->report_list[$report];
            $mydb = new DataBase();
            $this->header_info = $my_col_db->show_column($report_info['from_table']);
            /** Join All Important Table * */
            if (!isset($_POST['Aggregate'])) {
                if (isset($report_info['select'])) {
                    $mydb->select($report_info['select']);
                }
            }
            $jump_aggrigation = false;
            $jump_groupby = false;
            if (isset($_POST['aggregate_function'])) {
                $aggregate_function = $_POST['aggregate_function'];
                if ($aggregate_function[0] != '') {
                    $aggregate_filed = $_POST['aggregate_filed'];
                    foreach ($aggregate_function as $aggkey => $aggvalue) {
                        if ($aggvalue == 'Group By') {
                            $jump_groupby = true;
                            $mydb->group_by($aggregate_filed[$aggkey]);
                            $mydb->select($aggregate_filed[$aggkey]);
                        } else {
                            $jump_aggrigation = true;
                            $my_aggrigation = $aggvalue . '(' . $aggregate_filed[$aggkey] . ')';
                            $mydb->math($my_aggrigation, preg_replace('/[[:space:]]/', '', $aggvalue . '_' . $aggregate_filed));
                        }
                    }
                }
            }
            /** Join All Important Table * */
            if (isset($report_info['aggreaget']) && !$jump_aggrigation) {
                foreach ($report_info['aggreaget'] as $rkey => $rvalue) {
                    $mydb->math($rvalue, $rkey);
                }
            }


            /** Join All Important Table * */
            if (isset($report_info['join'])) {
                foreach ($report_info['join'] as $key => $value) {
                    $mydb->join($key, $value[0] . '=' . $value[1]);
                    $this->header_info = array_merge($this->header_info, $my_col_db->show_column($key));
                }
            }

            /** prepare Group By Clause * */
            if (isset($report_info['group_by']) && !$jump_groupby) {
                foreach ($report_info['group_by'] as $key => $value) {
                    $mydb->group_by($value);
                    $mydb->select($value);
                }
            }

            /** prepare having Clause * */
            if (isset($report_info['having'])) {
                foreach ($report_info['having'] as $key => $value) {
                    $mydb->having($key, $value);
                }
            }

            /** prepare having Clause * */
            if (isset($report_info['where'])) {
                foreach ($report_info['where'] as $key => $value) {
                    $mydb->where($key, $value);
                }
            }
            if (isset($_POST['filed_name'])) {
                foreach ($_POST['filed_name'] as $key => $value) {
                    if ($value != '') {
                        if ($_POST['operator'][$key] != '') {
                            if ($_POST['value'][$key] != '') {
                                if ($_POST['operator'][$key] == 'Like') {
                                    $mydb->like($value, $_POST['value'][$key]);
                                } else {
                                    $mydb->where($value . $_POST['operator'][$key], $_POST['value'][$key]);
                                }
                            }
                        }
                    }
                }
            }
            $result = $mydb->get($report_info['from_table']);
            $this->error_message = $mydb->error_message;
            $this->result = $result['result'];
        }
    }

}

$thekeyreport = new R_Report();
$result = $thekeyreport->result;
if ($thekeyreport->error_message != "") {
    $error_message = $thekeyreport->error_message;
}

$header_info =$thekeyreport->header_info;
ksort($header_info);
?>
