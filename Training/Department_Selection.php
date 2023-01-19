<?php require_once('../Connections/HRMS.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Thekey HRMS</title>

        <?php
        $dont_check = true;
        $base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
        require_once $base_path . 'Templates/head.php';
        ?>


    </head>
    <body>
        <div id="busy">
            <img alt="Am Working" src="http://<?php echo $base_url ?>images/BusyAnimation.gif"/>
        </div>
        <div id="thekey_page">
            <?php require_once $base_path . 'Templates/header.php'; ?>

            <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" -->
                <h1 class="form_lable">
                    Department Selection
                </h1>
                <?php if (!(isset($_GET['Department']))) {
                    ?>
                    <form id="form1" name="form1" method="get" action="">
                        <table align="center"  bgcolor="#EBEBEB" width="382" height="361">

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
                                    <input type="button" onclick="SelectedDepartment4Employeelist(document.getElementById('Department[]'),'Please Choose Department First')" value="Next" />
                                </td>
                            </tr>
                        </table>
                    </form>
                    <?php
                } else {
                    require_once('../Classes/Class_Attendance_System.php');
                    $obj_OT = new Attendance_System();
                    $db = $database_HRMS;
                    $Department = $_GET['Department'];

                    $stack = $obj_OT->get_employee_list($db, $Department);

                    echo "<table align=\"center\" nowrap=\"nowrap\" border=\"1\" bordercolor=\"#FFFFFF\">";
                    echo "<th align=\"left\" nowrap=\"nowrap\" >ID</th>
			     <th align=\"center\" nowrap=\"nowrap\">Full Name</th>
			     <th align=\"center\" nowrap=\"nowrap\">Department</th>";


                    foreach ($stack as $value) {

                        $IDNumber = $value;
                        list($FirstName, $MiddelName, $LastName, $Department) = $obj_OT->get_employee_Detail($db, $IDNumber);
                     
                        echo "<form name=\"SelectedID\"  action=\".php\" method=\"post\">";


                        echo "<tr align=\"left\" nowrap=\"nowrap\"> <td>";
                        echo "<input type=\"checkbox\" name=\"CHK_ID[]\" value=\"'" . $IDNumber . "'\">";
                        echo $IDNumber;
                        echo "</td>";

                        echo "<td align=\"left\" nowrap=\"nowrap\">";
                        echo "$FirstName $MiddelName $LastName";
                        echo "</td>";

                        echo "<td nowrap=\"nowrap\">";
                        echo "$Department";
                        echo "</td>";
                        echo '</tr>';
                    }
                    echo "<tr align=\"left\" nowrap=\"nowrap\"> <td colspan=4>";
                     echo "<p align=\"center\"><input type=\"submit\" value=\"Next\" name=\"Next\"></p>";
                     echo '</tr>';
                    echo "</table>";
                }
                ?>



            </div>
        </div>
    </body>
</html>