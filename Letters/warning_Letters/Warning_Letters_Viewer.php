

<!-- TinyMCE -->
<script type="text/javascript" src="../../Js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="../../Js/tiny_mce/tinyMCE.js"></script>

<!-- /TinyMCE -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/ThekeyHRMS_main_Template.dwt" codeOutsideHTMLIsLocked="false" -->
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
                mysql_select_db($database_HRMS, $HRMS);
                $query_RSLetterViewer = "SELECT * FROM disciplinary_action";
                $RSLetterViewer = mysql_query($query_RSLetterViewer, $HRMS) or die(mysql_error());
                $row_RSLetterViewer = mysql_fetch_assoc($RSLetterViewer);
                $totalRows_RSLetterViewer = mysql_num_rows($RSLetterViewer);
                ?>
                <h1 class="form_lable">
                    <?php echo $obj_lang->get('Warning Letter Viwer', $lang); ?>
                </h1>
                <?php
                $_GET['TableName'] = "disciplinary_action";

                $_GET['OpenPage'] = "Warning_Letters_Viewer";

                require_once($base_path . "Search_Name/SearchName.php");
                ?>
                <form action="" method="get">
                    <p><?php
                require_once("Select_ID4WarningLetterViewer.php");
                if (isset($_GET['WarningType']) and isset($_GET['ID']))
                    if (($_GET['ID'] == "Please Choose ID") and ($_GET['WarningType'] != "Warning Type"))
                        echo "<blockquote<blockquote><font  size=\"+2\" color=\"#FF6600\" >Please Choose ID first </font></blockquote></blockquote>";
                    else
                    if (($_GET['ID'] != "Please Choose ID") and ($_GET['WarningType'] == "Warning Type"))
                        echo "<blockquote<blockquote><font  size=\"+2\" color=\"#FF6600\" >Please Choose Warning type first </font></blockquote></blockquote>";
                    else
                        echo "<blockquote<blockquote><font  size=\"+2\" color=\"#FF6600\" >" . $_GET['ID'] . " and " . $_GET['WarningType'] . "</font></blockquote></blockquote>";
                ?>&nbsp;</p>

                    <textarea name="txtLetter" cols="70" rows="30" disabled="disabled" readonly="readonly">
    
                        <?php
                        $query = "SELECT * FROM Disciplinary_action";
                        $result = mysql_query($query);
                        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

                            if (isset($_GET['ID']) and isset($_GET['WarningType'])) {

                                if (($row['ID'] == $_GET['ID']) and ($_GET['WarningType'] == "First Inistance Warning")) {

                                    if (is_null($row['First_Inistance'])) {
                                        echo "<font  size=\"+5\" color=\"#FF0000\" >" . $_GET['ID'] . " " . $row['FirstName'] . " " . $row['MiddelName'] . " dosen't have First Inistance Warning</font>";
                                    } else {

                                        echo "{$row['First_Inistance']}";
                                    }
                                } else
                                if (($row['ID'] == $_GET['ID']) and ($_GET['WarningType'] == "Second Inistance Warning")) {
                                    if (is_null($row['Second_Inistance'])) {
                                        echo "<font  size=\"+5\" color=\"#FF0000\" >" . $_GET['ID'] . " dosen't have Second Inistance Warning</font>";
                                    }
                                    else
                                        echo "{$row['Second_Inistance']}";
                                }
                                else
                                if (($row['ID'] == $_GET['ID']) and ($_GET['WarningType'] == "Third Inistance Warning")) {
                                    if (is_null($row['Third_Inistance'])) {
                                        echo "<font  size=\"+5\" color=\"#FF0000\" >" . $_GET['ID'] . " dosen't have Third Inistance Warning</font>";
                                    }
                                    else
                                        echo "{$row['Third_Inistance']}";
                                }
                                else
                                if (($row['ID'] == $_GET['ID']) and ($_GET['WarningType'] == "Last Warning")) {
                                    if (is_null($row['Last_Warning'])) {
                                        echo "<font  size=\"+5\" color=\"#FF0000\" >" . $_GET['ID'] . " dosen't have Last Warning</font>";
                                    }
                                    else
                                        echo "{$row['Last_Warning']}";
                                }
                            }
                        }
                        ?></textarea></form>


                <!-- InstanceEndEditable -->
            </div>
        </div>

    </body>
    <!-- InstanceEnd --> </html>
<?php
mysql_free_result($RSLetterViewer);
?>

