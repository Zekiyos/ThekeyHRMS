<?php require_once('../Connections/HRMS.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Untitled Document</title>
        <script type='text/javascript'>
            function SelectedAttendance(elem,FromDate,ToDate, helperMsg){
                //document.writeln(elem.value);
                alert ( "You Chooose " + elem.value + " Department!")
                var Department=elem.value;
	
                location="Attendance_Summary.php?Attendance=" + elem.value
                if(elem.value == "Please Choose Attendance"){
                    alert(helperMsg);
                    elem.focus();
                    return false;
                }else{
                    return true;
                }
            }

        </script>
    </head>

    <body>
        <table align="center">
            <tr>

                <td height="61">
                    Select Attendance         
                </td>
                <td><?php
require_once('../Classes/Class_Attendance_System.php');
$obj_AS = new Attendance_System();
echo $obj_AS->get_Attendance_Allocation_list();
?>
                </td>
            </tr>
        </table>
    </body>
</html>