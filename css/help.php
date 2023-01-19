<?php

$help = array();

$help['annual leave grant form'] =
        '<ol>
            <li>From the&nbsp; leave menu select Annual Leave</li>
            <li>Click on annual leave grant menu from the sub menu</li>
            <li>Select the employee you want to grant annual leave</li>
        </ol>
            <p><strong>Note</strong>: you can select ID number from the drop down list or you can search by employee name if you use search employee type employee name and click search button ( ) then select the employee from the list you get by clicking on employee ID Number.</p>
        <ol>
            <li>Enter Leave days how much leave days the employee ask</li>
            <li>Enter rest days all the rest days between the start and end day of the leave</li>
            <li>Enter leave taken date when the employee wants to start the leave count.</li>
            <li>Click Grant Button</li>
        </ol>';


if (isset($_GET['help'])) {
    echo $_GET['help'];
    if (isset($help[strtolower($_GET['help'])])) {
        echo $help[strtolower($_GET['help'])];
    } else {
        echo '<h3>No Help Found</h3>';
    }
} else {
    echo '<h3>No Help Found</h3>';
}
?>
