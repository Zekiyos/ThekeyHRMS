 
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
                ?>
                <?php
                if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

                    if (!(mysql_num_rows(mysql_query("SELECT * FROM holyday_definition where `Date`='" . $_POST['Date'] . "'")))) {

                        $data = array('Holyday_Name' => $_POST['Holyday_Name']
                            , 'Date' => $_POST['Date']
                            , 'ModifiedBy' => $_SESSION['MM_Fullname']
                            );


                        $Result1 = $mydb->insert('holyday_definition', $data);



                        echo "<script type=\"text/javascript\">alert('You have Defined Holyday {$_POST['Holyday_Name']} Successfully.')</script>";
                    }

                    else
                        echo "<script type=\"text/javascript\">alert('Holyday Definition already defined on date {$_POST['Date']}.')</script>";
                }
                ?>
                <h1 class="form_lable">
                    <?php echo $obj_lang->get('Holyday Definition Form', $lang); ?>
                </h1>
                <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                    <table align="center" background="" bgcolor="#EBEBEB">
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Holyday Name:</td>
                            <td>
                                <input type="text" name="Holyday_Name" value=""/>
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Date:</td>
                            <td>
                                <input type="Date" name="Date" value='<?php echo date('Y-m-d'); ?>' size="12" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">&nbsp;</td>
                            <td><input type="submit" value="Define Holday" /></td>
                        </tr>
                    </table>
                    <input type="hidden" name="MM_insert" value="form1" />
                </form>




                <!-- InstanceEndEditable -->
            </div>
        </div>
    </body>
    <!-- InstanceEnd --> </html>


