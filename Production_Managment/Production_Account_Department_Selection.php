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
                <?php
                echo '<h1 class="form_lable">';
                echo 'Department Selection for Production Account Create Form';
                echo "</h1>";
                ?>

                <form id="form1" name="form1" method="POST" action="Creat_Production_Account.php">
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

                                <select id="Department[]" name="Department[]" class="Department" multiple >
                                    <option selected="selected">--First Select Section--</option>

                                </select>
                            </td>
                        </tr>

                         <tr valign="baseline">
                            <td nowrap="nowrap" align="right">&nbsp;</td><td>
                                <td>&nbsp;&nbsp;<input type="submit" value="Next" /></td>
                        </tr>

                    </table>

                </form>
            </div>
        </div>
    </body>
</html>