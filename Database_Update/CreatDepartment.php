<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/ThekeyHRMS_main_Template.dwt" codeOutsideHTMLIsLocked="false" -->
    <head>
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

                $editFormAction = $_SERVER['PHP_SELF'];
                if (isset($_SERVER['QUERY_STRING'])) {
                    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
                }

                if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

                    $Section = $_POST['Section'];
                    $SubSection = $_POST['Sub_Section'];
                    //$Group = $_POST['Group'];


                    if ($_POST['Section'] == '') {
                        $Section = $_POST['SectionNEW'];
                    }
                    if ($_POST['Sub_Section'] == '') {
                        $SubSection = $_POST['Sub_SectionNEW'];
                    }
                    /* if ($_POST['Group'] == 'Select Group...') {
                      $Group = $_POST['GroupNEW'];
                      } */


                    $data = array('Section' => $Section
                        , 'Sub Section' => $SubSection
                        // , 'Group' => $Group
                        , 'Department' => $_POST['Department']);

                    $Result1 = $mydb->insert('department', $data);

                    if ($Result1)
                        echo "<script type=\"text/javascript\">alert('Department Created Successfuly!!')</script>";
                }


                $mydb = new DataBase();

                $result = $mydb->select('DISTINCT  Section')
                        ->order_by('Section')
                        ->get('department');

                $my_section = $result['result'];



                $result = $mydb->select('DISTINCT  Sub Section')
                        ->order_by('Section')
                        ->get('department');

                $my_subsection = $result['result'];
                ?>

                <h1 class="form_lable">Create New Department Form</h1>
                <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">

                    <table align="center" bgcolor="#EBEBEB">
                        <tr valign="baseline">
                            <td align="right" nowrap="nowrap">Section:</td>
                            <td class="float_content">
                                <?php
                                $my_form = new Form();
                                echo $my_form->dropdown($my_section, 'Section', 'Section', array('name' => 'Section', 'id' => 'Section'));
                                ?>
                                <a class="ui-icon ui-icon-circle-plus toggle_me" onClick="javascript:toggle('DivSection')"></a>
                                <div id="DivSection" style="display: none;" ><input type="text" name="SectionNEW" size="40" value="" /></div></td>
                        </tr>
                        <tr> </tr>
                        <tr valign="baseline">
                            <td align="right" nowrap="nowrap">Sub Section:</td>
                            <td class="float_content">
                                <?php
                                echo $my_form->dropdown($my_subsection, 'Sub Section', 'Sub Section', array('name' => 'Sub_Section', 'id' => 'Sub_Section'));
                                ?>
                                <a class="ui-icon ui-icon-circle-plus toggle_me" onClick="javascript:toggle('DivSubSection')"></a>
                                <div id="DivSubSection" style="display: none;" ><input type="text" name="Sub_SectionNEW" size="40" value="" /></div></td>
                        </tr>
                        <tr valign="baseline">
                            <td align="right" nowrap="nowrap">Department:</td>
                            <td><input type="text" name="Department" value="" size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td colspan="2" align="right"><input type="submit" value="Creat Department" /></td>
                        </tr>
                    </table>
                    <input type="hidden" name="MM_insert" value="form1" />
                </form>
                <!-- InstanceEndEditable -->
            </div>
        </div>

    </body>
    <!-- InstanceEnd -->
</html>