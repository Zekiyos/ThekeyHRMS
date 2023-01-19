<?php
if (!defined('validurl'))
    if (!defined('validurl'))
        define("validurl", TRUE);
$base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
$port = $_SERVER['SERVER_PORT'];
require_once $base_path . 'config/database.php';
require_once $base_path . 'lib/database.php';
require_once $base_path . 'lib/form.php';
if ($port == 80) {
    $port = '';
} else {
    $port = ':' . $port;
}
$base_url = $_SERVER['SERVER_NAME'] . $port . '/ThekeyHRMS/';
?>
<?php if (count($_POST) <= 0): ?>
    <!DOCTYPE html>
    <?php
    require_once $base_path . 'Personal_Record/id_form.php';
    ?>
    <?php
else :

    $start_date = $_POST['start'];
    $end_date = $_POST['end'];
    $department = $_POST['department'];
    $employee_id = $_POST['employee_id'];
    $issue_date = $_POST['date_of_issued'];
    $groups='';
    if (isset($_POST['Group'])) {
        $groups = $_POST['Group'];

        $groups = preg_split('/(,|;)/', $groups);
    }
 
    $mydb = new DataBase();
    $mydb->select(array('FirstName', 'MiddelName', 'LastName', 'Department', 'ID', 'Position'));
    if ($start_date != "") {
        $mydb->where('Date_Employement>', $start_date);
    }
    if ($end_date != '') {
        $mydb->where('Date_Employement<', $end_date);
    }
    if (is_array($groups)) {
        foreach ($groups as $gkey => $gvalue) {
            if ($gvalue != '')
                $mydb->or_where('Group', $gvalue);
        }
    } else if ($groups != '') {
        $mydb->where('Group', $groups);
    }
    if ($employee_id != '') {
        $mydb->where('ID', $employee_id);
    }
    if ($department != '') {
        $mydb->where('Department', $department);
    }
    $result = $mydb->get('employee_personal_record');
    if ($result['count'] > 0) {
        $total_num_row = $result['total_row'];                 $result = $result['result'];
        require_once $base_path . 'Personal_Record/id_print.php';
    } else {
        require_once $base_path . 'Personal_Record/id_form.php';
    }
    ?>
<?php endif; ?>