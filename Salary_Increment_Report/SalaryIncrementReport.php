<?php require_once('../Connections/HRMS.php'); ?>
<?php
require_once('../Classes/Class_AccessLevel.php');
$obj_AccessLevel = new AccessLevel();
echo $obj_AccessLevel->CHK_AccessLevel();
?>

<?php
mysql_select_db($database_HRMS, $HRMS);
//$query_RSSalaryIncrement = "select ID,FirstName,MiddelName,Department, Date_employement,Salary,0.80 as This_year_Increment, Salary+0.8 as Increment from ThekeyHRMSDB.employee_personal_record  where  datediff(curdate(),date_Employement) >=365 and datediff(curdate(),date_Employement) < 395 Union ALL select ID,FirstName,MiddelName,Department, Date_employement,Salary,0.50 as This_year_Increment, Salary+0.50 as Increment from ThekeyHRMSDB.employee_personal_record  where  datediff(curdate(),date_Employement) >=730 and datediff(curdate(),date_Employement) < 760";

$query_RSSalaryIncrement = "select ID,FirstName,MiddelName,Department, 
Date_employement,Salary,
IF(Salary=564,27,IF(Salary=740,25,If(Salary=726,29,if(Salary=681,24,0)))) as This_year_Increment,
IF(Salary=564,591,IF(Salary=740,765,If(Salary=726,755,if(Salary=681,705,Salary)))) as After_Increment from ThekeyHRMSDB.employee_personal_record 
 where  (datediff(curdate(),date_Employement) >=365 and datediff(curdate(),
 date_Employement) < 395) Union ALL select ID,FirstName,MiddelName,
 Department, Date_employement,Salary,
IF(Salary=591,15,IF(Salary=765,25,If(Salary=755,725,if(Salary=705,24,0)))) as This_year_Increment,IF(Salary=591,606,IF(Salary=765,790,If(Salary=755,780,if(Salary=705,729,Salary)))) as After_Increment from ThekeyHRMSDB.employee_personal_record  
 where  datediff(curdate(),date_Employement) >=730 and datediff(curdate(),date_Employement) < 760 Order By Department,Date_Employement,This_year_Increment DESC";

$RSSalaryIncrement = mysql_query($query_RSSalaryIncrement, $HRMS) or die(mysql_error());
$row_RSSalaryIncrement = mysql_fetch_assoc($RSSalaryIncrement);
$totalRows_RSSalaryIncrement = mysql_num_rows($RSSalaryIncrement);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Salary Increment Report</title>
    </head>

    <body>
        <font color="#FF6600" size="+2" ><p align="center">This Month Salary Increment </p></font>
        </blockquote>
        <blockquote><blockquote><blockquote><blockquote> <blockquote>
                            <blockquote><blockquote><blockquote><blockquote> <blockquote>
                                                <blockquote><blockquote><blockquote><blockquote> <blockquote><blockquote><blockquote> <blockquote><blockquote><blockquote> <blockquote>
                                                                                            <input type=button value="Print Out" onClick="PrintContent('SalaryIncrement')" align="right" ></blockquote></blockquote></blockquote></blockquote></blockquote>
                                                                    </blockquote></blockquote></blockquote></blockquote></blockquote>
                                                </blockquote></blockquote></blockquote></blockquote></blockquote></blockquote></blockquote></blockquote></blockquote></blockquote></blockquote>
        <script type="text/javascript" src="../Js/PrintContent.js">
        </script>
        <div id="SalaryIncrement">
            <table id="SalaryIncrementTable" ellpadding="0" align="center" border="1" bordercolor="#E19319">
                <tr>
                    <td>ID Number</td>
                    <td>First Name</td>
                    <td>Middel Name</td>
                    <td>Department</td>
                    <td>Date Of employement</td>
                    <td>Salary</td>
                    <td>This year Increment</td>
                    <td>Salary After Increment</td>
                </tr>
                <?php do { ?>
                    <tr>
                        <td><?php echo $row_RSSalaryIncrement['ID']; ?></td>
                        <td><?php echo $row_RSSalaryIncrement['FirstName']; ?></td>
                        <td><?php echo $row_RSSalaryIncrement['MiddelName']; ?></td>
                        <td><?php echo $row_RSSalaryIncrement['Department']; ?></td>
                        <td><?php echo $row_RSSalaryIncrement['Date_employement']; ?></td>
                        <td><?php echo $row_RSSalaryIncrement['Salary']; ?></td>
                        <td><?php echo $row_RSSalaryIncrement['This_year_Increment']; ?></td>
                        <td><?php echo $row_RSSalaryIncrement['After_Increment']; ?></td>
                    </tr>
                <?php } while ($row_RSSalaryIncrement = mysql_fetch_assoc($RSSalaryIncrement)); ?>
            </table>
        </div>
    </body>
</html>
<?php
mysql_free_result($RSSalaryIncrement);
?>
