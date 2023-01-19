<?php
if (!defined('validurl'))
    define("validurl", TRUE);

$dont_check = true;

require_once('../Connections/HRMS.php');
?>

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
                    Salary Increment
                </h1>

                <?php
                require_once('../Classes/Class_Salary_Increment.php');
                $obj_Salary_Increment = new Salary_Increment();

                echo "<form name=\"SelectedID4Update\"  action=\"SalaryIncrementSetupStep3.php\" method=\"post\">";

                echo "<input  name=\"IDNo\" type=\"hidden\" >";
                if (!session_id()) {
                    session_start();
                }
                $_SESSION['IDNo'] = "";
                if (isset($_POST['CHK']) && isset($_POST['Next'])) {
                    $a = $_POST['CHK'];
                    if (empty($a)) {
                        echo("You didn't select any Employee for Salary Increment.");
                    } else {
                        $N = count($a);
                        echo("You selected $N Employees(s): ");

                        echo "<table >";
                        echo "<th>ID</th>
			<th>Full Name</th>
			<th>Department</th>
			<th>Position</th>
			<th> Salaray</th>
			<th>Date of Employement</th>
			<th>No of Year</th>
			<th>After Increment</th>";

                        for ($i = 0; $i < $N; $i++) {
                            // echo($a[$i] ."");
                            // $a[$i].=$a[$i].",";
                            //$_POST['IDNo'].=$a[$i].",";

                            $IDNumber = str_replace("'", "", $a[$i]);

                            $_SESSION['IDNo'].="," . $IDNumber; //Copying the selected ID for updating use

                            list($FirstName, $MiddelName, $LastName, $Department, $Position, $date_Employement) = $obj_Salary_Increment->get_employee_Detail($IDNumber);

                            $NoYear = $obj_Salary_Increment->get_no_year($IDNumber);
                            $salary = $obj_Salary_Increment->get_Salary($IDNumber);
                            $Salary_After_Increment = $obj_Salary_Increment->get_Salary_Increment($salary, $NoYear);

                            echo "<tr> <td>";

                            echo $IDNumber;
                            echo "</td>";

                            echo "<td>";
                            echo "$FirstName $MiddelName $LastName";
                            echo "</td>";

                            echo "<td>";
                            echo "$Department";
                            echo "</td>";

                            echo "<td>";
                            echo "$Position";
                            echo "</td>";

                            echo "<td>";
                            echo $salary;
                            echo "</td>";

                            echo "<td>";
                            echo "$date_Employement";
                            echo "</td>";

                            echo "<td>";
                            echo $NoYear;
                            echo "</td>";

                            echo "<td>";
                            echo $Salary_After_Increment;
                            echo "</td></tr>";
                        }
                        echo "</table>";
                        //echo $_SESSION['IDNo'];
                    }
                }

                echo "<p align=\"center\"><input type=\"submit\" name=\"UpdateSalary\" value=\"Update Salary\"></p>";
                echo "</form>";
                ?>

            </div>
        </div>
    </body>
    <!-- InstanceEnd -->
</html>