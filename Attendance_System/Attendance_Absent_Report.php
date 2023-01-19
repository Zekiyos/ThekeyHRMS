
<?php require_once('../Connections/HRMS.php'); ?>
<?php 
include('../User_Account/Class_AccessLevel.php');
 $obj_AccessLevel = new AccessLevel();
echo $obj_AccessLevel->CHK_AccessLevel(); 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Attendance Allocation</title>
<style>
    .Attendance_allocation {
    border-collapse: collapse;
    margin-right: 57px;
    width: 95%;
}
.Attendance_allocation tr th {
    background: url("../images/grid_header.png") repeat scroll 0 0 transparent;
    color: orange;
    padding: 4px;
    text-transform: capitalize;
    white-space: nowrap;
}
.Attendance_allocation tr td {
    white-space: nowrap;
}
.Attendance_allocation tbody tr:nth-child(2n) {
    background: url("../images/grid_even_row.png") repeat scroll 0 0 transparent;
}
#busy {
    background-image: url("../images/bg.png");
    height: 200%;
    position: absolute;
    width: 100%;
    z-index: 1000;
}
#busy img {
    display: block;
    margin-left: auto;
    margin-right: auto;
    margin-top: 300px;
    position: relative;
    text-align: center;
}

</style>
<link href="../Css/ProgressBar.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet"  href="../Css/tinybox2style.css" />
<script type="text/javascript" src="../Js/tinybox.js"></script>
<script type='text/JavaScript' src="../Js/js.js" ></script>
<script type='text/JavaScript' src="../Js/scw.js" ></script>
<script type='text/JavaScript' src="../Calendar/scw.js" ></script>
<script type='text/JavaScript' src="../Js/SelectedDepartment4Attendance.js" ></script>
</head>

<body  >
    <!--div id="busy" >
            <img alt="Am Working" src="../images/BusyAnimation.gif">
        </div-->

    <?php
//if(isset($_GET['Department']) && isset($_GET['From_Date'])&& isset($_GET['To_Date']))
//{
//$sql="Select * FROM `Attendance_Allocation` WHERE `Date` BETWEEN '".$_GET['From_Date']."' and '".$_GET['To_Date']."' and Department='".$_GET['Department']."'";
//if((mysql_num_rows(mysql_query($sql))))
//{
//
//}
//}else
//{
//    
//    
//}


include('Class_Attendance_System.php'); 
$obj_OT=new  Attendance_System();


if(isset($_GET['Department']) && isset($_GET['From_Date'])&& isset($_GET['To_Date']))
{
	
	$Department=$_GET['Department'];

	//$StackDepartment=array($Department);
	//$StackDepartment=$Department;
	
	$StackDepartment=array();
	array_push($StackDepartment,$_GET['Department']);
		
		foreach($StackDepartment as $Departmentvalue)
        {
			if(mysql_num_rows(mysql_query("Select * FROM `Attendance_Allocation` WHERE `Department`='".$Departmentvalue."'")))
		    {
				
				//$obj_prg_bar->progressbar('Attendance Allocation is running for '.$Departmentvalue.' Department',100000,'Attendance Allocation for '.$Departmentvalue.' Has Been Done.');
				?>
				

				<?php
				if(!(isset($_GET['operation'])))
				
			
               $obj_OT->Attendance_Absent($Departmentvalue,$_GET['From_Date'],$_GET['To_Date']);
		    }
			else
			 echo "<script type=\"text/javascript\"> alert('Soory, there is no Scan Attendance Sheet for $Department Department');</script>";
		}

}else
{
    require_once 'Department_Selection4Absent.php';
}
    
    


?>
</body>
</html>