<?php require_once('../Connections/HRMS.php'); ?>
<?php

//if(isset($_POST['Section']))
//{
//$id=$_POST['Section'];

if ((isset($_POST['Section'])) or (isset($_POST['SubSection'])) or (isset($_POST['Group']))) {

    if (isset($_POST['Section'])) {
        $ColumnName = "`Section`";
        $id = $_POST['Section'];
    }

    if (isset($_POST['SubSection'])) {
        $ColumnName = "`Sub Section`";
        $id = $_POST['SubSection'];
    }


    if (isset($_POST['Group'])) {
        $ColumnName = "`Group`";
        $id = $_POST['Group'];
    }


    $sql = mysql_query("select DISTINCT `Sub Section` from Department where $ColumnName='$id'");

    while ($row = mysql_fetch_array($sql)) {
        $id = $row['Sub Section'];
        $data = $row['Sub Section'];
        echo '<option value="' . $id . '">' . $data . '</option>';
    }
}
?>