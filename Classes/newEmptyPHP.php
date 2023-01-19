<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class R_Report {

    var $result;
    var $header_info;
    private $report_list = array(
        /*Annual leave report*/
       'Annual Leave' => array(
            'select' => array(
                'annual_leave.FirstName', 'annual_leave.MiddelName',
                'annual_leave.LastName', 'employee_personal_record.Department',
                'annual_leave.Leavedays', 'annual_leave.RestDay',
                'annual_leave.Leave_Taken_Date', 'annual_leave.ReportOn',
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
            'group_by' => array('employee_personal_record.Department', 'Position')
        ),
            
        'Annual Leave Per Department' => array(
            'aggreaget' => array('Total' => 'COUNT(ID)'),
            'select' => array(
                'Department'
            ),
            'group_by' => array('Department'),
            'from_table' => 'annual_leave'
        ),
            /*Sick leave report*/
        'Sick Leave' => array(
            'select' => array(
                'sick_leave.FirstName', 'sick_leave.MiddelName',
                'sick_leave.LastName', 'employee_personal_record.Department',
                'sick_leave.SickLeaveDays','sick_leave.SickLeave_Taken_Date',
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
            'group_by' => array('Department', 'Position')
        ),
        'Sick Leave Per Department' => array(
            'aggreaget' => array('Total' => 'COUNT(ID)'),
            'select' => array(
                'Department'
            ),
            'group_by' => array('Department'),
            'from_table' => 'sick_leave'
        ),
        
        /*Funeral leave report*/
        'Funeral Leave' => array(
            'select' => array(
                'funeral_leave.FirstName', 'funeral_leave.MiddelName',
                'funeral_leave.LastName', 'employee_personal_record.Department',
                'funeral_leave.FuneralLeaveDays','funeral_leave.RestDay',
                'funeral_leave.SickLeave_Taken_Date','funeral_leave.ReportOn'
            ),
            'from_table' => 'funeral_leave',
            'join' => array(
                'employee_personal_record' => array(
                    'sick_leave.ID', 'employee_personal_record.id'
                )
                , 'department' => array(
                    'Department.Department', 'employee_personal_record.Department'
                )
            ),
            'group_by' => array('Department', 'Position')
        ),
        'Funeral Leave Per Department' => array(
            'aggreaget' => array('Total' => 'COUNT(ID)'),
            'select' => array(
                'Department'
            ),
            'group_by' => array('Department'),
            'from_table' => 'funeral_leave'
        ),
        /*Maternity leave report*/
        'Maternity Leave' => array(
            'select' => array(
                'maternity_leave.FirstName', 'maternity_leave.MiddelName',
                'maternity_leave.LastName', 'employee_personal_record.Department',
                'maternity_leave.MaternityLeaveDays','maternity_leave.MaternityLeave_Taken_Date',
                'maternity_leave.ReportOn'
            ),
            'from_table' => 'maternity_leave',
            'join' => array(
                'employee_personal_record' => array(
                    'sick_leave.ID', 'employee_personal_record.id'
                )
                , 'department' => array(
                    'Department.Department', 'employee_personal_record.Department'
                )
            ),
            'group_by' => array('Department', 'Position')
        ),
        'Maternity Leave Per Department' => array(
            'aggreaget' => array('Total' => 'COUNT(ID)'),
            'select' => array(
                'Department'
            ),
            'group_by' => array('Department'),
            'from_table' => 'maternity_leave'
        ),
        
         /*Paternity leave report*/
        'Paternity Leave' => array(
            'select' => array(
                'paternity_leave.FirstName', 'paternity_leave.MiddelName',
                'paternity_leave.LastName', 'employee_personal_record.Department',
                'paternity_leave.PaternityLeaveDays','paternity_leave.PaternityLeave_Taken_Date',
                'paternity_leave.ReportOn'
            ),
            'from_table' => 'paternity_leave',
            'join' => array(
                'employee_personal_record' => array(
                    'sick_leave.ID', 'employee_personal_record.id'
                )
                , 'department' => array(
                    'Department.Department', 'employee_personal_record.Department'
                )
            ),
            'group_by' => array('Department', 'Position')
        ),
        'Paternity Leave Per Department' => array(
            'aggreaget' => array('Total' => 'COUNT(ID)'),
            'select' => array(
                'Department'
            ),
            'group_by' => array('Department'),
            'from_table' => 'paternity_leave'
        ),
        
         /*Wedding leave report*/
        'Wedding Leave' => array(
            'select' => array(
                'wedding_leave.FirstName', 'wedding_leave.MiddelName',
                'wedding_leave.LastName', 'employee_personal_record.Department',
                'wedding_leave.WeddingLeavedays','wedding_leave.RestDay','wedding_leave.WeddingLeave_TakenDate 	',
                'wedding_leave.ReportOn'
            ),
            'from_table' => 'wedding_leave',
            'join' => array(
                'employee_personal_record' => array(
                    'sick_leave.ID', 'employee_personal_record.id'
                )
                , 'department' => array(
                    'Department.Department', 'employee_personal_record.Department'
                )
            ),
            'group_by' => array('Department', 'Position')
        ),
        'Wedding Leave Per Department' => array(
            'aggreaget' => array('Total' => 'COUNT(ID)'),
            'select' => array(
                'Department'
            ),
            'group_by' => array('Department'),
            'from_table' => 'wedding_leave'
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
        if (isset($this->report_list[$report])) {
            $report_info = $this->report_list[$report];
            $mydb = new DataBase();

            /** Join All Important Table * */
            if (isset($report_info['select'])) {
                $mydb->select($report_info['select']);
            }

            /** Join All Important Table * */
            if (isset($report_info['aggreaget'])) {
                foreach ($report_info['aggreaget'] as $rkey => $rvalue) {
                    $mydb->math($rvalue, $rkey);
                }
            }


            /** Join All Important Table * */
            if (isset($report_info['join'])) {
                foreach ($report_info['join'] as $key => $value) {
                    $mydb->join($key, $value[0] . '=' . $value[1]);
                }
            }

            /** prepare Group By Clause * */
            if (isset($report_info['group_by'])) {
                foreach ($report_info['group_by'] as $key => $value) {
                    $mydb->group_by($value);
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
                                    $mydb->having($value . $_POST['operator'][$key], $_POST['value'][$key]);
                                }
                            }
                        }
                    }
                }
            }


            $result = $mydb->get($report_info['from_table']);
            if ($result['count'] > 0) {
                $this->header_info = $result['result'][0];
            } else {
                if (isset($report_info['select'])) {
                    $mydb->select($report_info['select']);
                }
                $new_result = $mydb->get($report_info['from_table']);
                if ($new_result['count'] > 0) {
                    $this->header_info = $new_result['result'][0];
                }
            }



            $this->result = $result['result'];
        }
    }

}

$thekeyreport = new R_Report();
$result = $thekeyreport->result;
$header_info = $thekeyreport->header_info;
?>
