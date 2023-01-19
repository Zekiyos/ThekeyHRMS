 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/ThekeyHRMS_main_Template.dwt" codeOutsideHTMLIsLocked="false" -->
    <head>
        <!--meta http-equiv="Content-Type" content="text/html; charset=utf-8" /-->
        <title>Thekey HRMS</title>

        <?php
        $base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
        require_once $base_path . 'Templates/head.php';
        ?>
    </head>

    <body>
        <div id="busy" >
            <img alt="Am Working" src="http://<?php echo $base_url ?>images/BusyAnimation.gif">
        </div>
        <div id="thekey_page">
            <?php require_once $base_path . 'Templates/header.php'; ?>

            <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" -->
                <?php
                echo '<p class="WelCome">Wel Come "' . $_SESSION['MM_Fullname'] . "\"</p>";

                $mydb = new DataBase();
                ?>
                <?php
                $editFormAction = $_SERVER['PHP_SELF'];
                if (isset($_SERVER['QUERY_STRING'])) {
                    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
                }

                function ResultDifference($R1, $R2) {

                    if ($R1 != 0) {

                        $diff = $R1 - $R2;

                        $DiffPersent = ($diff * 100) / $R1;
                        return $DiffPersent;
                    }
                    else
                        return $DiffPersent = 0;
                    echo "<script type=\"text/javascript\">alert (diiference {$diff});</script>";

                    //return $diff;
                }

                if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
                    $sql = "select * from cholinesterase_test";
                    $result = mysql_query($sql);



                    if (mysql_num_rows(mysql_query("SELECT * FROM `cholinesterase_test` WHERE ID='" . $_POST['ID'] . "' and FirstName='" . $_POST['FirstName'] . "'"))) {
                        //checking avaivaabe or not
                        while ($row = mysql_fetch_assoc($result)) {
                            if ($row['ID'] == $_POST['ID']) { //check if the employee
                                if ($_POST['TestNumber'] == "FirstTest") { //Checking Employee test number of the year
                                    $TestResult = "FirstResult";
                                    $TestDate = "FirstTestDate";
                                    $DifferenceName = "FirstDifference";

                                    $Difference = ResultDifference($row['LastResult'], $_POST['TestResult']);
                                } else
                                if ($_POST['TestNumber'] == "SecondTest") {

                                    $TestResult = "SecondResult";
                                    $TestDate = "SecondTestDate";
                                    $DifferenceName = "SecondDifference";

                                    $Difference = ResultDifference($row["FirstResult"], $_POST['TestResult']);
                                    echo "Defrence In Persent" . $Difference . "Date" . $TestDate . " " . $_POST['TestDate'];
                                } else
                                if ($_POST['TestNumber'] == "ThirdTest") {

                                    $TestResult = "ThirdResult";
                                    $TestDate = "ThirdTestDate";
                                    $DifferenceName = "ThirdDifference";

                                    $Difference = ResultDifference($row['SecondResult'], $_POST['TestResult']);
                                } else
                                if ($_POST['TestNumber'] == "ForthTest") {

                                    $TestResult = "ForthResult";
                                    $TestDate = "ForthTestDate";
                                    $DifferenceName = "ForthDifference";

                                    $Difference = ResultDifference($row['ThirdResult'], $_POST['TestResult']);
                                }
                            }
                        }




                        global $Difference;
                        global $TestDate;
                        global $DifferenceName;
                        global $TestResult;
                        //Update the the test result of the employee and fiffrence
                        $sqlupdate = "UPDATE `cholinesterase_test` SET 							
										`" . $TestResult . "`=" . $_POST['TestResult'] . ",`"
                                . $TestDate . "`='" . $_POST['TestDate'] . "',`"
                                . $DifferenceName . "`=" . $Difference .
                                " WHERE  ID='" . $_POST['ID'] . "' and
										FirstName='" . $_POST['FirstName'] . "'";

                        mysql_query($sqlupdate);
                    } else {

                        $TestResult = "FirstResult";
                        $TestDate = "FirstTestDate";
                        $DifferenceName = "FirstDifference";
                        $Difference = 0;


                        ///Register the EMployee test result for the first time
                        $data = array('ID' => $_GET['ID']
                            , 'FirstName' => $_POST['FirstName']
                            , 'MiddelName' => $_POST['MiddelName']
                            , 'LastName' => $_POST['LastName']
                            , 'Department' => $_POST['Department']
                            , $TestResult => $_POST['TestResult']
                            , $DifferenceName => $Difference
                            , $TestDate => $_POST['TestDate']);

                        //, 'ModifiedBy' => $_SESSION['MM_Fullname']);

                        $Result1 = $mydb->insert('cholinesterase_test', $data);

                        if ($Result1)
                            echo "<script type=\"text/javascript\">alert('You have Registred  Cholinesterase Test for {$_POST['FirstName']} {$_POST['MiddelName']}  Successfully.')</script>";
                    }

                    if (( (float) $_POST['TestResult'] < (float) 5100) or ((float) $_POST['TestResult'] > (float) 11700)) {


                        echo "<script type=\"text/javascript\"> alert('The test Result of this employee is exceeded out of range of workers must have to work on Chemical Exposed Duty. So transfer this Employee to other Department.');</script>";

                        echo "<script type=\"text/javascript\">
                                var answer = confirm(\"Do you want Tranfere this employee to Other Department now\")
                                if (answer)
                                    window.location = \"../Employee_Status_Transaction/Department_Transfer.php?ID=" . $_POST['ID'] . "\"
                            </script>";
                    }
                }

                mysql_select_db($database_HRMS, $HRMS);
                $query_RSCholinesteraseTest = "SELECT * FROM cholinesterase_test";
                $RSCholinesteraseTest = mysql_query($query_RSCholinesteraseTest, $HRMS) or die(mysql_error());
                $row_RSCholinesteraseTest = mysql_fetch_assoc($RSCholinesteraseTest);
                $totalRows_RSCholinesteraseTest = mysql_num_rows($RSCholinesteraseTest);
                ?>
                <?php
//initialize the session
                if (!session_id()) {
                    session_start();
                }

// ** Logout the current user. **
                $logoutAction = $_SERVER['PHP_SELF'] . "?doLogout=true";
                if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")) {
                    $logoutAction .="&" . htmlentities($_SERVER['QUERY_STRING']);
                }

                if ((isset($_GET['doLogout'])) && ($_GET['doLogout'] == "true")) {
                    //to fully log out a visitor we need to clear the session varialbles
                    $_SESSION['MM_Username'] = NULL;
                    $_SESSION['MM_UserGroup'] = NULL;
                    $_SESSION['PrevUrl'] = NULL;
                    unset($_SESSION['MM_Username']);
                    unset($_SESSION['MM_UserGroup']);
                    unset($_SESSION['PrevUrl']);

                    $logoutGoTo = "../login.php";
                    if ($logoutGoTo) {
                        header("Location: $logoutGoTo");
                        exit;
                    }
                }
                ?>

                <h1 class="form_lable">
                    <?php echo $obj_lang->get('Cholinesterase Labratory Test', $lang); ?>
                </h1>

                <?php
                $_GET['TableName'] = "employee_personal_record";

                $_GET['OpenPage'] = "Cholinesterase_Test";

                include("../Search_Name/SearchName.php");
                ?>
                <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                    <table align="center"  bgcolor="#EBEBEB">
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">ID:</td>
                            <td><input type="text" name="ID"  size="15" value="<?php if (isset($_GET['ID'])) echo $_GET['ID']; ?>"/></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">First Name:</td>
                            <td><input type="text" name="FirstName" size="25" value="<?php
                $query = "SELECT * FROM employee_personal_record";
                $result = mysql_query($query);
                while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                    if (isset($_GET['ID'])) {
                        if ($row['ID'] == $_GET['ID']) {

                            echo "{$row['FirstName']}";
                        }
                    }
                }
                ?>" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Middel Name:</td>
                            <td><input type="text" name="MiddelName"  size="25" value="<?php
                                       $query = "SELECT * FROM employee_personal_record";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {
                                               if ($row['ID'] == $_GET['ID']) {

                                                   echo "{$row['MiddelName']}";
                                               }
                                           }
                                       }
                ?>" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Last Name:</td>
                            <td><input type="text" name="LastName"  size="25" value="<?php
                                       $query = "SELECT * FROM employee_personal_record";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {
                                               if ($row['ID'] == $_GET['ID']) {

                                                   echo "{$row['LastName']}";
                                               }
                                           }
                                       }
                ?>"/></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Department:</td>
                            <td><input type="text" name="Department" value="<?php
                                       $query = "SELECT * FROM employee_personal_record";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {
                                               if ($row['ID'] == $_GET['ID']) {

                                                   echo "{$row['Department']}";
                                               }
                                           }
                                       }
                ?>" size="32" /></td>
                        </tr>
                        <tr><td height="70">Number Of Test</td><td>
                                <input type="radio" name="TestNumber" value="FirstTest" />First Test
                                <input type="radio" name="TestNumber" value="SecondTest" />Second Test<br /><br />
                                <input type="radio" name="TestNumber" value="ThirdTest" />Third Test
                                <input type="radio" name="TestNumber" value="ForthTest" />Forth Test
                                <tr valign="baseline">
                                    <td height="32" align="right" nowrap="nowrap">Test Result:</td>
                                    <td><input type="text"  name="TestResult" value="" size="32" /></td>
                                </tr>
                                <tr valign="baseline">
                                    <td height="29" align="right" nowrap="nowrap">Test Taken Date:</td>
                                    <td>
                                        <input name="TestDate"  type="Date"  value="<?php echo date("Y-m-d"); ?>" size="20" /></td>
                                </tr>

                                <tr valign="baseline">
                                    <td height="39" align="right" nowrap="nowrap">&nbsp;</td>
                                    <td><input type="submit" value="Register" /></td>
                                </tr>
                                </table>
                                <input type="hidden" name="MM_insert" value="form1" />
                                </form>
                                <p>&nbsp;</p>
                                </p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <!-- InstanceEndEditable -->
                                </div>
                                </div>

                                </body>
                                <!-- InstanceEnd --></html>


