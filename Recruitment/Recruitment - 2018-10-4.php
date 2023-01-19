<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/ThekeyHRMS_main_Template.dwt" codeOutsideHTMLIsLocked="false" -->
    <head>
        <!--meta http-equiv="Content-Type" content="text/html; charset=utf-8" /-->
        <title>Thekey HRMS</title>
        <?php
        $base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
        require_once $base_path . 'Templates/head.php';
        $filename = $base_path . 'Recruitment/LastID.txt';

        $filename = realpath($filename);
        ?>
    </head>

    <body>
        <div id="busy" >
            <img alt="Am Working" src="http://<?php echo $base_url ?>images/BusyAnimation.gif">
        </div>
        <div id="thekey_page">
            <?php
            $editFormAction = $_SERVER['PHP_SELF'];
            if (isset($_SERVER['QUERY_STRING'])) {
                $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
            }


            if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {


                $fileuploder = new file_upload();
                $fileuploder->allowedType("jpg");
                $fileuploder->uploadpath($base_path . "Employee_Images");
                $fileuploder->doupload(isset($_POST['ID']) ? $_POST['ID'] . '.jpg' : '');

                $uploadedfiles = $fileuploder->uploadedfiles();
                $error = $fileuploder->showerror();
                if (!isset($error_message))
                    $error_message = '';
                foreach ($error as $erkey => $ervalue) {
                    if (isset($error_message))
                        $error_message .=$ervalue;
                    else
                        $error_message = $ervalue;
                }
                $Photo = '';
                if (isset($uploadedfiles[0])) {
                    $Photo = $uploadedfiles[0];
                }
                require_once('../Classes/Class_Recruitment.php');
                $obj_Recruitment = new Recruitment();


                $insertemployeePR = $obj_Recruitment->insert("employee_personal_record", array($_POST['ID'], $_POST['FirstName'], $_POST['MiddelName'], $_POST['LastName'],
                    $_POST['Date_Birth'], $_POST['Age'], $_POST['Sex'], $_POST['Date'], $_POST['Department'],
                    $_POST['Position'], $_POST['Salary'], $Photo, $_SESSION['MM_Fullname']), "`ID`,`FirstName`,`MiddelName`,`LastName`,`Date_Birth`,`Age`,`Sex`,`Date_Employement`,`Department`,`Position`,`Salary`,`Photo`,`ModifiedBy`");


//$_POST['Group_No'],`Group`,

                $insertRecutiment = $obj_Recruitment->insert("Recruitment", array($_POST['Employer'], $_POST['Place'], $_POST['ID'], $_POST['FirstName']
                    , $_POST['MiddelName'], $_POST['LastName'], $_POST['Date_Birth'], $_POST['Age'], $_POST['Sex'], $Photo, $_POST['Date']
                    , $_POST['Address'], $_POST['Department'], $_POST['Position'], $_POST['Salary'], $_POST['Transport_Allowance']
                    , $_POST['Housing_Allowance'], $_POST['Hardship_Allowance'], $_POST['Position_Allowance'], $_POST['Present_Allowance'], $_SESSION['MM_Username']), "Employer, Place, ID, FirstName, MiddelName, LastName,Date_Birth, Age, Sex, Photo, `Date`, Address,`Department`, `Position`, Salary, Transport_Allowance,Housing_Allowance,Hardship_Allowance, Position_Allowance,Present_Allowance,ModifiedBy");

                $inserttotaldeduction = $obj_Recruitment->insert("total_deduction", array($_POST['ID'], $_POST['FirstName'], $_POST['MiddelName'], $_POST['LastName'], $_POST['Salary'], $_POST['Department'], $_POST['Position'], $_POST['Hardship_Allowance'], $_POST['Housing_Allowance'],
                    $_POST['Transport_Allowance'], $_POST['Position_Allowance'], $_POST['Present_Allowance'], "NO", $_SESSION['MM_Username']), "`ID`,`FirstName`,`MiddelName`,`LastName`,`Basic salary`,`Department`,`Position`,`Hardship_Allowance`,Housing_Allowance,`Transport_Allowance_Amount`,`Position_Allowance`,`Present_Allowance_Amount`,`CHK_Pension`,`ModifiedBy`");


                for ($i = 1; $i <= 6; $i++) {
                    $week = "week_" . $i;
                    $insertweek = $obj_Recruitment->insert($week, array($_POST['ID'], $_POST['FirstName'], $_POST['MiddelName'], $_POST['LastName'], $_POST['Department']), "`ID`,`FirstName`,`MiddelName`,`LastName`,`Department`");
                }


                if (($insertweek) && ($inserttotaldeduction) && ($insertemployeePR) && ($insertRecutiment))
                    echo "<script type=\"text/javascript\">alert('Employee Recruited Successfully')</script>";
                else
                    echo "<script type=\"text/javascript\">alert('When You try to Recruited Employee,there is some error.It maight be the Employee is already recruited')</script>";
                $base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';

                if (file_exists($filename)) {
                    $fd = fopen($filename, "r+") or die("Can't open file $filename");
                    $fstring = fread($fd, filesize($filename));

                    $fstring2 = $fstring + 1;
                    fclose($fd);

                    $fd2 = fopen($filename, "w+") or die("Can't open file $filename");
                    $fout = fwrite($fd2, $fstring2);
                    fclose($fd2);
                }
            }

            $maxRows_RSRecruitment = 10;
            $pageNum_RSRecruitment = 0;
            if (isset($_GET['pageNum_RSRecruitment'])) {
                $pageNum_RSRecruitment = $_GET['pageNum_RSRecruitment'];
            }
            $startRow_RSRecruitment = $pageNum_RSRecruitment * $maxRows_RSRecruitment;

            mysql_select_db($database_HRMS, $HRMS);
            $query_RSRecruitment = "SELECT * FROM recruitment";
            $query_limit_RSRecruitment = sprintf("%s LIMIT %d, %d", $query_RSRecruitment, $startRow_RSRecruitment, $maxRows_RSRecruitment);
            $RSRecruitment = mysql_query($query_limit_RSRecruitment, $HRMS) or die(mysql_error());
            $row_RSRecruitment = mysql_fetch_assoc($RSRecruitment);


            if (isset($_GET['totalRows_RSRecruitment'])) {
                $totalRows_RSRecruitment = $_GET['totalRows_RSRecruitment'];
            } else {
                $all_RSRecruitment = mysql_query($query_RSRecruitment);
                $totalRows_RSRecruitment = mysql_num_rows($all_RSRecruitment);
            }
            $totalPages_RSRecruitment = ceil($totalRows_RSRecruitment / $maxRows_RSRecruitment) - 1;

            mysql_select_db($database_HRMS, $HRMS);
            $query_RSDepartment = "SELECT * FROM thekey_department_data_access Where group_name='" . $_SESSION['MM_UserGroup'] . "' ORDER BY Department ASC";
            $RSDepartment = mysql_query($query_RSDepartment, $HRMS) or die(mysql_error());
            $row_RSDepartment = mysql_fetch_assoc($RSDepartment);
            $totalRows_RSDepartment = mysql_num_rows($RSDepartment);
            ?>
            <?php require_once $base_path . 'Templates/header.php'; ?>

            <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" -->
                <h1 class="form_lable">
                    <?php echo $obj_lang->get('Employee Probation Period Recruitment Form', $lang); ?> 
                </h1>
                <form enctype="multipart/form-data" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                    <table width="535" height="535" >
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Employer', $lang); ?>:</td>
                            <td><input type="text" name="Employer" value="<?php
                    $sqlCS = "SELECT `Company_Name`,`Web_Site` FROM $database_HRMS.company_settings";

                    $resultCS = mysql_query($sqlCS) or die(mysql_error());

                    $rowCS = mysql_fetch_array($resultCS);

                    echo $rowCS['Company_Name'];
                    ?>" size="35" readonly="readonly" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Place', $lang); ?>:</td>
                            <td>
                                <input type="text" name="Place" value="<?php
                                       $sqlCS = "SELECT `Company_Country`,`Company_City` FROM $database_HRMS.company_settings";

                                       $resultCS = mysql_query($sqlCS) or die(mysql_error());

                                       $rowCS = mysql_fetch_array($resultCS);

                                       echo $rowCS['Company_City'] . "," . $rowCS['Company_Country'];
                    ?>" size="32" readonly="readonly" />           
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('ID', $lang); ?>:</td>
                            <td>
                                <input   required="required"   type="text" name="ID" value="<?php
                                       if (file_exists($filename)) {

                                           $fd = fopen($filename, "r+") or die("Can't open file $filename");
                                           $fstring = fread($fd, filesize($filename));

                                           fclose($fd);

                                           $initial = $fstring;


                                           $sqlCS = "SELECT ID_Number_Initial_Character,Maximum_Allowed_ID_Number FROM $database_HRMS.company_settings";

                                           $resultCS = mysql_query($sqlCS) or die(mysql_error());

                                           $rowCS = mysql_fetch_array($resultCS);
                                           $Maximum_Allowed_ID_Number = $rowCS['Maximum_Allowed_ID_Number'];
                                           $ID_Number_Initial_Character = $rowCS['ID_Number_Initial_Character'];


                                           if ($initial > $Maximum_Allowed_ID_Number) {
                                               echo "ID EXCEED Z Range";
                                           } else {
                                               $ID_Leading_Zero = "";

                                               $Leading_Zero = (strlen($Maximum_Allowed_ID_Number) - strlen($initial));


                                               for ($ID_Digit = 1; $ID_Digit <= $Leading_Zero; $ID_Digit++) {
                                                   $ID_Leading_Zero.="0";
                                               }
                                               $ID = $ID_Number_Initial_Character . "-" . $ID_Leading_Zero . $initial;

                                               echo $ID;
                                           }
                                       }
                                       else
                                           echo "LastID.txt NOT EXISTS";
                    ?>" size="15" />
                            </td>
                            <?php
                            if (file_exists($filename) == false) //Checking File Existance
                                echo "<script type=\"text/javascript\"> alert('Last ID Number text file is not exist.Write Last ID Number on the notpad and save in the Recruitment folder as LastID.txt'); </script>";
                            else
                            if ($initial > $Maximum_Allowed_ID_Number) //Check the maximum allowed ID Number
                                echo "<script type=\"text/javascript\"> alert('Last ID number($initial) exceed out of the maximaum allowed ID Number($Maximum_Allowed_ID_Number).Contact Thekeysoft System Developer to change the maximaum allowed ID Number.'); </script>";
                            ?>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('First Name', $lang); ?>:</td>
                            <td>
                                <input required="required" type="text" name="FirstName" value="" size="20" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Middel Name', $lang); ?>:</td>
                            <td>
                                <input  required="required"  type="text" name="MiddelName" value="" size="20" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Last Name', $lang); ?>:</td>
                            <td>
                                <input  required="required"  type="text" name="LastName" value="" size="20" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Date of Birth', $lang); ?>:</td>
                            <td><input  required="required"  type="Date" name="Date_Birth" id="Date_Birth" class="calculate_age" value="<?php echo date("Y-m-d"); ?> " size="15" />
                        </tr>
                        <tr>
                            <td align="right">
                                <?php echo $obj_lang->get('Age', $lang); ?>:
                            </td>
                            <td>
                                <input   required="required"    type="text" name="Age" id="Age" value="0" readonly="readonly" size="8" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Sex', $lang); ?>:</td>
                            <td valign="baseline"><table>
                                    <tr>
                                        <td><input required="required"    type="radio" name="Sex" value="Male" <?php
                                if (!(strcmp("Female", "Male"))) {
                                    echo "checked=\"checked\"";
                                }
                                ?>/>
                                            <?php echo $obj_lang->get('Male', $lang); ?></td>
                                    </tr>
                                    <tr>
                                        <td><input required="required"    type="radio" name="Sex" value="Female" <?php
                                            if (!(strcmp("Female1", "Female"))) {
                                                echo "checked=\"checked\"";
                                            }
                                            ?>/>
                                            <?php echo $obj_lang->get('Female', $lang); ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Photo', $lang); ?>:</td>
                            <td><input type="file" name="Photo" value="" size="32"  /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Date of Employement', $lang); ?>:</td>
                            <td> <input   required="required"   type="Date" name="Date"  value="<?php echo date("Y-m-d"); ?> " size="15" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right" valign="top"><?php echo $obj_lang->get('Address', $lang); ?>:</td>
                            <td><textarea   required="required"   name="Address" cols="50" rows="5"></textarea></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Department', $lang); ?>:</td>
                            <td>
                                <select   required="required"   name="Department" >
                                    <option value=""><?php echo $obj_lang->get('Choose Department', $lang); ?></option>
                                    <?php
                                    do {
                                        ?>
                                        <option value="<?php echo $row_RSDepartment['Department'] ?>"><?php echo $row_RSDepartment['Department'] ?></option>
                                        <?php
                                    } while ($row_RSDepartment = mysql_fetch_assoc($RSDepartment));
                                    $rows = mysql_num_rows($RSDepartment);
                                    if ($rows > 0) {
                                        mysql_data_seek($RSDepartment, 0);
                                        $row_RSDepartment = mysql_fetch_assoc($RSDepartment);
                                    }
                                    ?>
                                </select>
                            </td>
                            <?php
                            $sqlCS = "SELECT `Company_Name` from $database_HRMS.company_settings";

                            $resultCS = mysql_query($sqlCS) or die(mysql_error());

                            $rowCS = mysql_fetch_array($resultCS);

                            if (isset($company_info['support_group'])) {
                                if ($company_info['support_group']) {
                                    echo '<tr>';
                                    echo '<td align="right">';
                                    echo 'Group Number';
                                    echo '</td>';
                                    echo '<td>';
                                    echo " <input type=\"text\" name=\"Group_No\" value=\"\" size=\"5\" />";
                                    echo '</td>';
                                    echo '</tr>';
                                }
                            }
                            ?>
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Position', $lang); ?>:</td>
                            <td>
                                <input   required="required"   type="text" name="Position" value="" size="32" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Salary', $lang); ?>:</td>
                            <td>
                                <input   required="required"   type="number" name="Salary" value="0" size="15" />
                            </td>
                        </tr>
						
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Transport Allowance', $lang); ?>:</td>
                            <td>
                                <input   required="required"   type="number" name="Transport_Allowance" value="0" size="15" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Housing Allowance', $lang); ?>:</td>
                            <td>
                                <input   required="required"   type="number" name="Housing_Allowance" value="0" size="15" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Hardship Allowance', $lang); ?>:</td>
                            <td>
                                <input   required="required"   type="number" name="Hardship_Allowance" value="0" size="15" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Position Allowance', $lang); ?>:</td>
                            <td>
                                <input   required="required"   type="number" name="Position_Allowance" value="0" size="15" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Present Allowance', $lang); ?>:</td>
                            <td>
                                <input   required="required"   type="number" name="Present_Allowance" value="0" size="15" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">&nbsp;</td>
                            <td>
                                <input type="submit" value="<?php echo $obj_lang->get('Register', $lang); ?>" height="120" width="100"/>
                            </td>
                        </tr>
                    </table>
                    <p>
                        <input type="hidden" name="MM_insert" value="form1" />
                    </p>
                </form>

                <!-- InstanceEndEditable -->
            </div>
        </div>

    </body>
    <!-- InstanceEnd -->
</html>