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
        <script type="text/javascript" src="../Js/SelectedDepartment4ScanSheet.js"></script>

    </head>S
    <body>
        <div id="busy">
            <img alt="Am Working" src="http://<?php echo $base_url ?>images/BusyAnimation.gif"/>
        </div>
        <div id="thekey_page">
            <?php require_once $base_path . 'Templates/header.php'; ?>

            <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" -->
                <h1 class="form_lable">
                    XL CSV FIle Importer
                </h1>

                <?php
                include('../Classes/Class_XL.php');
                $obj_XL = new XL();



                $editFormAction = $_SERVER['PHP_SELF'];

                if (isset($_SERVER['QUERY_STRING'])) {
                    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
                }

                if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

                    if ((isset($_POST['TableName'])) && isset($_POST['Import_File'])) {
                        
                        /***** Seting access level based on allowed tables for user to importing *********/
                        
                        echo $_POST['Import_File'];

                        $obj_XL->XL_export($_POST['TableName'], $_POST['Import_File']);
                    }
                }
                ?>
                <form id="form1" name="form1" method="POST"  action="<?php echo $editFormAction; ?>">
                    <table align="center"  bgcolor="#EBEBEB" >
                        <tr valign="baseline">
                            <td align="right">Table Name</td>
                            <td nowrap="nowrap">
                                <?php
                                $obj_XL->get_Attendance_Allocation_list();
                                ?></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('CSV File', $lang); ?>:</td>
                            <td><input type="file"  name="Import_File" value="" size="32"  /></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit"  value="Import" onClick="return confirm('Are you sure, you want to Import this XL.CSV File?')"  />
                            </td>
                        </tr>

                    </table>
                    <input type="hidden" name="MM_insert" value="form1" />
                </form>


            </div>
        </div>
    </body>
</html>