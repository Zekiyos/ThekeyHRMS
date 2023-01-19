<?php require_once('../Connections/HRMS.php'); ?>
<?php
session_start();

//if(isset($_POST['Group']))
//{
//$id=$_POST['Group'];
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


    //$sql = mysql_query("Select DISTINCT `Department` from Department where $ColumnName='$id'");
	
	   $sql = "Select DISTINCT `Department` from `Department` where $ColumnName='$id'";

    $sql = $sql . ' AND `Department` IN (SELECT `Department` FROM `thekey_department_data_access` WHERE `group_name`="' . $_SESSION['MM_UserGroup'] . '")';
    
    //echo '<option >' .$sql.'</option>';
  
    
    $result = mysql_query($sql);

    while ($row = mysql_fetch_array($result)) {
        $id = $row['Department'];
        $data = $row['Department'];
        echo '<option value="' . $id . '">' . $data . '</option>';
    }
}
?>