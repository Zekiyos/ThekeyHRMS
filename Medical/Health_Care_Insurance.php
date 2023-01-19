 
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
                echo "<br>";

                $editFormAction = $_SERVER['PHP_SELF'];
                if (isset($_SERVER['QUERY_STRING'])) {
                    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
                }


                if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {


                    include('../Classes/Class_Heath_Care_Insurance.php');
                    $obj_Health_Care_Insurance = new Health_Care_Insurance();
                    echo $obj_Health_Care_Insurance->CHK_Health_Care_Insurance($_GET['ID']);

                    $data = array('ID' => $_GET['ID']
                        , 'FirstName' => $_POST['FirstName']
                        , 'MiddelName' => $_POST['MiddelName']
                        , 'LastName' => $_POST['LastName']
                        , 'Department' => $_POST['Department']
                        , 'Referral_Case' => $_POST['Referral_Case']
                        , 'Treatment_Cost' => $_POST['Treatment_Cost']
                        , 'Refferal_Date' => $_POST['Refferal_Date']
                        , 'ModifiedBy' => $_SESSION['MM_Fullname']);

                    $Result1 = $mydb->insert('Health_Care_Insurance', $data);

                    if ($Result1)
                        echo "<script type=\"text/javascript\">alert('You have Registred {$_POST['FirstName']}  {$_POST['MiddelName']} Health Care Insurance Successfully.')</script>";

//                    $Subject = "Ours Sick Employee on day " . date("Y-m-d");
//                    $msg = "Name of Petient:-" . $_POST['FirstName'] . " " . $_POST['MiddelName'] . " " . $_POST['LastName'] . " ID:" . $_GET['ID'];
//                    send_email("ohcosh@gmail.com", $Subject, $msg);
                }
                ?>
                <h1 class="form_lable">
                    <?php echo $obj_lang->get('Helath Care Insurance', $lang); ?>
                </h1>
                <?php
                $_GET['TableName'] = "medical_referral";

                $_GET['OpenPage'] = "Health_Care_Insurance";

                include("../Search_Name/SearchName.php");
                ?>
                </blockquote>
                </blockquote></blockquote>
                <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                    <table width="277" align="center" bgcolor="#EBEBEB">
                        <tr valign="baseline">
                            <td height="41" align="right" nowrap="nowrap">FirstName:</td>
                            <td><input type="text" name="FirstName" value="<?php
                $query = "SELECT * FROM Medical_Referral";
                $result = mysql_query($query);
                while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                    if (isset($_GET['ID'])) {
                        if ($row['ID'] == $_GET['ID']) {

                            echo "{$row['FirstName']}";
                        }
                    }
                }
                ?>" size="20" readonly="readonly" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td height="41" align="right" nowrap="nowrap">MiddelName:</td>
                            <td><input type="text" name="MiddelName" value="<?php
                                       $query = "SELECT * FROM Medical_Referral";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {
                                               if ($row['ID'] == $_GET['ID']) {

                                                   echo "{$row['MiddelName']}";
                                               }
                                           }
                                       }
                ?>" size="20" readonly="readonly" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td height="36" align="right" nowrap="nowrap">LastName:</td>
                            <td><input type="text" name="LastName" value="<?php
                                       $query = "SELECT * FROM Medical_Referral";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {
                                               if ($row['ID'] == $_GET['ID']) {

                                                   echo "{$row['LastName']}";
                                               }
                                           }
                                       }
                ?>" size="20" readonly="readonly" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td height="40" align="right" nowrap="nowrap">Department:</td>
                            <td><input type="text" name="Department" value="<?php
                                       $query = "SELECT * FROM Medical_Referral";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {
                                               if ($row['ID'] == $_GET['ID']) {

                                                   echo "{$row['Department']}";
                                               }
                                           }
                                       }
                ?>" size="35" readonly="readonly" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td  align="right" nowrap="nowrap">Referral Case:</td>
                            <td>
                                <textarea id="Referral_Case" name="Referral_Case" cols="40" rows="5" value="">
                                    <?php
                                    $query = "SELECT * FROM Medical_Referral";
                                    $result = mysql_query($query);
                                    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                        if (isset($_GET['ID'])) {
                                            if ($row['ID'] == $_GET['ID']) {

                                                $Referral_Case = trim($row['Referral_Case']);
                                                echo $Referral_Case;
                                            }
                                        }
                                    }
                                    ?></textarea>
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td  align="right" nowrap="nowrap">Date of Treatment:</td>
                            <td>
                                <input type="Date" name="Refferal_Date" value="<?php
                                    $query = "SELECT * FROM Medical_Referral";
                                    $result = mysql_query($query);
                                    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                        if (isset($_GET['ID'])) {
                                            if ($row['ID'] == $_GET['ID']) {

                                                echo $row['Refferal_Date'];
                                            }
                                        }
                                    }
                                    ?>" size="20" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td  align="right" nowrap="nowrap">Treatment Cost:</td>
                            <td>

                                <input type="text" name="Treatment_Cost" value="" size="20" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">&nbsp;</td>
                            <td><input type="submit" value="Register" /></td>
                        </tr>
                    </table>

                    <p>
                        <input type="hidden" name="MM_insert" value="form1" />
                    </p>
                </form>
                <p>&nbsp;</p>


                <blockquote>&nbsp;</blockquote>
                <!-- InstanceEndEditable -->
            </div>
        </div>
    </body>
    <!-- InstanceEnd --></html>


