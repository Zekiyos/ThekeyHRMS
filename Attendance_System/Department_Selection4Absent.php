<?php require_once('../Connections/HRMS.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Department Selection</title>

        <title>Attendance Allocation</title>

        <link href="../Css/ProgressBar.css" rel="stylesheet" type="text/css" />

        <link rel="stylesheet"  href="../Css/tinybox2style.css" />
        <script type="text/javascript" src="../Js/tinybox.js"></script>


        <link rel="stylesheet" href="../Css/style.css" />
        <script type="text/javascript" src="../Js/tinybox.js"></script>
        <script type="text/javascript" src="../Js/jquery.min.js"></script>

        <script type="text/javascript" src="../Js/Department_SelectionAjax.js"></script>

        <script type="text/javascript" >

            function SelectedDepartment4AttendanceAbsent(elem,FromDate,ToDate, helperMsg){
                //document.writeln(elem.value);
                alert ( "You Chooose " + elem.value + " Department!")
                var Department=elem.value;
	
                location="../Attendance System/Attendance_Absent_Report.php?Department=" + elem.value + "&From_Date=" + FromDate.value + "&To_Date=" + ToDate.value;
                if(elem.value == "Please Choose Department"){
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


        <form id="form1" name="form1" method="get" action="">
            <table width="476" height="65" align="center" background="" bgcolor="#EBEBEB">
                <tr><td></td><td></td><td align="center"><p align="center">  <font color="#FF6600" size="">Select Dates Rage</font></p></td></tr>
                <tr valign="baseline">
                    <td width="91" height="61" align="right" nowrap="nowrap">From Date:</td>
                    <td width="81"><?php
echo "<script type='text/JavaScript' src=\"../Calendar/scw.js\" ></script>";
$Today = date('Y-m-d');
?><input type="text" id="From_Date" name="From_Date" onclick='scwShow(this,event);' value='<?php echo '2012-08-21'; ?>' size="12" /></td>

                    <td width="128" align="right" nowrap="nowrap">To Date:</td>
                    <td width="156"><input type="text" id="To_Date" name="To_Date" onclick='scwShow(this,event);' value='<?php echo '2012-09-20'; ?>' size="12" /></td>
                </tr>


                <tr valign="baseline">
                    <td height="67" align="right" nowrap="nowrap"><label for="Section">Section</label>:</td>
                    <td>
                        <select name="Section" class="Section">
                            <option selected="selected">------Select Section-----</option>
                            <?php
                            $sql = mysql_query("Select DISTINCT Section from Department");
                            while ($row = mysql_fetch_array($sql)) {
                                $id = $row['Section'];
                                $data = $row['Section'];
                                echo '<option value="' . $id . '">' . $data . '</option>';
                            }
                            ?>
                        </select> 
                    </td>
                </tr>
                <tr valign="baseline">
                    <td height="78" align="right" nowrap="nowrap"><label>Sub Section</label>:</td>
                    <td>
                        <select name="SubSection" class="SubSection">
                            <option selected="selected">--First Select Section--</option>

                        </select>
                    </td>
                </tr>
                <tr valign="baseline">
                    <td height="77" align="right" nowrap="nowrap"><label >Group</label>:</td>
                    <td>

                        <select name="Group" class="Group">
                            <option selected="selected">--First Select Section--</option>

                        </select>

                    </td>
                </tr>
                <tr valign="baseline">
                    <td height="81" align="right" nowrap="nowrap"><label ></label>Department:</td>
                    <td>

                        <select id="Department[]" name="Department" class="Department" >
                            <option selected="selected">--First Select Section--</option>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>

                    </td>
                    <td>
                        <input type="button" onclick="SelectedDepartment4AttendanceAbsent(document.getElementById('Department[]'),document.getElementById('From_Date'),document.getElementById('To_Date'),'Please Choose Department First')" value="Next" />
                    </td>
                </tr>

            </table>

        </form>

    </body>
</html>

