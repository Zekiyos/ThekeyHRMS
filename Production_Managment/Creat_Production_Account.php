
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/ThekeyPayrollSystem_main_Template.dwt" codeOutsideHTMLIsLocked="false" -->
    <head>
        <!--meta http-equiv="Content-Type" content="text/html; charset=utf-8" /-->
        <title>Thekey HRMS</title>
        <?php
        $dont_check = true;
        $port = $_SERVER['SERVER_PORT'];
        if ($port == 80) {
        $port = '';
        } else {
        $port = ':' . $port;
        }
        $appRoot = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
        $appPath = $_SERVER['SERVER_NAME'] . $port . '/ThekeyHRMS/';
        require_once $appRoot . 'Templates/head.php';
        ?>
    </head>
    <body>
        <div id="busy">
            <img alt="Am Working" src="http://<?php echo $appPath ?>images/BusyAnimation.gif"/>
        </div>
        <div id="thekey_page">
            <?php require_once $appRoot . 'Templates/header.php'; ?>
            <div id="mainContent">
                <!-- InstanceBeginEditable name="MainContent" -->
                <?php
                if (isset($_SESSION['MM_Fullname']))
                echo '<p class="WelCome">Wel Come "' . $_SESSION['MM_Fullname'] . "\"</p>";
                ?>
                <?php
                include('../Classes/Class_Production_Managment.php');

                $objPM = new Production_Managment();

                $editFormAction = $_SERVER['PHP_SELF'];
                if (isset($_SERVER['QUERY_STRING'])) {
                $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
                }
                if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
                $accountName = $_POST['Account_Name'];
                $accountDescription = $_POST['Account_Description'];
                $accountGroup= $_POST['Account_Group'];
                $accountArea = $_POST['Account_Area'];
                $departmentList = implode(',',$_POST['Department_List']);
                $objPM->createProductionAccount($accountName, $accountDescription,$accountGroup, $accountArea, $departmentList);
                }
                ?>

                <?php
                echo '<h1 class="form_lable">';
                echo 'Production Account Create Form';
                echo "</h1>";
                ?>
                <form action="<?php echo $editFormAction; ?>" method="POST" name="form1" id="form1">

                    <table  name="departmentSelection" id="departmentSelection" width="476" height="180" align="center" background="" bgcolor="#EBEBEB">
                        <tr valign="baseline">
                            <td height="2" align="right" nowrap="nowrap" colspan="1"><label for="Account_Name">Account Name</label>:</td>
                            <td>
                                <input name="Account_Name" type="text"></input>
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td height="2" align="right" nowrap="nowrap" colspan="1"><label for="Account_Description">Account Description</label>:</td>
                            <td>
                                <textarea name="Account_Description"></textarea>

                            </td>
                        </tr>
                         <tr valign="baseline">
                            <td height="2" align="right" nowrap="nowrap" colspan="1"><label for="Account_Group">Account Group</label>:</td>
                            <td>
                                <input name="Account_Group" type="text"></input>
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td height="2" align="right" nowrap="nowrap" colspan="1"><label for="Department">Department List</label>:</td>
                            <td>
                                <Select name="Department_List[]" Multiple>
                                    <?php
                                    if (isset($_POST['Department'])){
                                    foreach ($_POST['Department'] as $key => $value) {
                                    echo '<option selected>'.$value.'</option>';
                                    }
                                    }
                                    ?>
                                </select>

                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td height="2" align="right" nowrap="nowrap" colspan="1"><label for="Account_Area">Account Area</label>:</td>
                            <td>
                                <input name="Account_Area" type="text"></input>
                            </td>
                        </tr>

                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">&nbsp;</td><td>
                                <td>&nbsp;&nbsp;<input type="submit" value="Create Account" /></td>
                        </tr>
                    </table>
                    <input type="hidden" name="MM_insert" value="form1" />
                </form>



            </div>

            <!-- InstanceEndEditable -->
        </div>
    </body>
    <!-- InstanceEnd -->
</html>


