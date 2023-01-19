<form id="form1" name="form1" method="get" action="" >
    <p>
        <label for="Department">Select Department:</label>
        <?php
        $mydb = new DataBase();
        $mydb->select('DISTINCT Department');
        $mydb->where('Department!=', '');
        $mydb->order_by('Department');
        $result = $mydb->get('employee_personal_record');
        $department_list = $result['result'];
        if (isset($_GET['Department'])) {
            if ($_GET['Department'] == "") {
                $_GET['Department'] = "Coldstore";
            }
        }
        if ($result) {
            $my_form = new Form();
            echo $my_form->dropdown($department_list, 'Department', 'Department', array(
                'onchange' => 'SelectedDepartment(document.getElementById(\'Department\'), \'Please Choose Something\')',
                'id' => "Department",
                'name' => 'department')
            );
        }
        ?>
</form>