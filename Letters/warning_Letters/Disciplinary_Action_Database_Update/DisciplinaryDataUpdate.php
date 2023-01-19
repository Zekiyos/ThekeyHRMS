<?php require_once('../../../Connections/HRMS.php'); ?>

<?php
require_once('../../../Classes/Class_AccessLevel.php');
$obj_AccessLevel = new AccessLevel();
echo $obj_AccessLevel->CHK_AccessLevel();
?>
<?php require_once('../../../Classes/Class_language.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {

    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") {
        if (PHP_VERSION < 6) {
            $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
        }

        $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

        switch ($theType) {
            case "text":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "long":
            case "int":
                $theValue = ($theValue != "") ? intval($theValue) : "NULL";
                break;
            case "double":
                $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
                break;
            case "date":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "defined":
                $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
                break;
        }
        return $theValue;
    }

}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
    $updateSQL = sprintf("UPDATE disciplinary_action SET ID=%s, FirstName=%s, MiddelName=%s, LastName=%s, Department=%s, `Position`=%s, Verbal_Warning=%s, Verbal_Warning_Date=%s, First_Inistance=%s, First_Inistance_Date=%s, Second_Inistance=%s, Second_Inistance_Date=%s, Third_Inistance=%s, Third_Inistance_Date=%s, Last_Warning=%s, Last_Warning_Date=%s WHERE Auto_ID=%s", GetSQLValueString($_POST['ID'], "text"), GetSQLValueString($_POST['FirstName'], "text"), GetSQLValueString($_POST['MiddelName'], "text"), GetSQLValueString($_POST['LastName'], "text"), GetSQLValueString($_POST['Department'], "text"), GetSQLValueString($_POST['Position'], "text"), GetSQLValueString($_POST['Verbal_Warning'], "text"), GetSQLValueString($_POST['Verbal_Warning_Date'], "date"), GetSQLValueString($_POST['First_Inistance'], "text"), GetSQLValueString($_POST['First_Inistance_Date'], "date"), GetSQLValueString($_POST['Second_Inistance'], "text"), GetSQLValueString($_POST['Second_Inistance_Date'], "date"), GetSQLValueString($_POST['Third_Inistance'], "text"), GetSQLValueString($_POST['Third_Inistance_Date'], "date"), GetSQLValueString($_POST['Last_Warning'], "text"), GetSQLValueString($_POST['Last_Warning_Date'], "date"), GetSQLValueString($_POST['Auto_ID'], "int"));

    mysql_select_db($database_HRMS, $HRMS);
    $Result1 = mysql_query($updateSQL, $HRMS) or die(mysql_error());

    $updateGoTo = "DisciplinaryDataDisplay.php";
    if (isset($_SERVER['QUERY_STRING'])) {
        $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
        $updateGoTo .= $_SERVER['QUERY_STRING'];
    }
    header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_HRMS, $HRMS);

if (isset($_GET['Auto_ID'])) {

    $query_RSDisciplinaryDataUpdate = "SELECT * FROM  disciplinary_action where Auto_ID=" . $_GET['Auto_ID'] . "";
}else
    $query_RSDisciplinaryDataUpdate = "SELECT * FROM disciplinary_action where Auto_ID=-1";


//$query_RSDisciplinaryDataUpdate = "SELECT * FROM disciplinary_action";
$RSDisciplinaryDataUpdate = mysql_query($query_RSDisciplinaryDataUpdate, $HRMS) or die(mysql_error());
$row_RSDisciplinaryDataUpdate = mysql_fetch_assoc($RSDisciplinaryDataUpdate);
$totalRows_RSDisciplinaryDataUpdate = mysql_num_rows($RSDisciplinaryDataUpdate);
?>
<!-- TinyMCE -->
<script type="text/javascript" src="../../../Js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
    tinyMCE.init({
        // General options
        mode : "textareas",
        theme : "advanced",
        skin : "o2k7",
        plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

        // Theme options
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        // Example word content CSS (should be your site CSS) this one removes paragraph margins
        content_css : "css/word.css",

        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "lists/template_list.js",
        external_link_list_url : "lists/link_list.js",
        external_image_list_url : "lists/image_list.js",
        media_external_list_url : "lists/media_list.js",

        // Replace values for the template plugin
        template_replace_values : {
            username : "Some User",
            staffid : "991234"
        }
    });
</script>
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
                <font color="#FF6600" size="+1" > <p align="center">Disciplinary Data Update</p></font>
                <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                    <table align="center">
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">ID:</td>
                            <td><input type="text" name="ID" value="<?php echo htmlentities($row_RSDisciplinaryDataUpdate['ID'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">First Name:</td>
                            <td><input type="text" name="FirstName" value="<?php echo htmlentities($row_RSDisciplinaryDataUpdate['FirstName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Middel Name:</td>
                            <td><input type="text" name="MiddelName" value="<?php echo htmlentities($row_RSDisciplinaryDataUpdate['MiddelName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Last Name:</td>
                            <td><input type="text" name="LastName" value="<?php echo htmlentities($row_RSDisciplinaryDataUpdate['LastName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Department:</td>
                            <td><input type="text" name="Department" value="<?php echo htmlentities($row_RSDisciplinaryDataUpdate['Department'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Position:</td>
                            <td><input type="text" name="Position" value="<?php echo htmlentities($row_RSDisciplinaryDataUpdate['Position'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Verbal Warning:</td>
                            <td><input type="text" name="Verbal_Warning" value="<?php echo htmlentities($row_RSDisciplinaryDataUpdate['Verbal_Warning'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Verbal Warning Date:</td>
                            <td><input type="text" name="Verbal_Warning_Date" value="<?php echo htmlentities($row_RSDisciplinaryDataUpdate['Verbal_Warning_Date'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td height="164" align="right" valign="top" nowrap="nowrap">First Inistance:</td>
                            <td><textarea name="First_Inistance" cols="50" rows="15"><?php echo htmlentities($row_RSDisciplinaryDataUpdate['First_Inistance'], ENT_COMPAT, 'utf-8'); ?></textarea></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">First Inistance Date:</td>
                            <td><input type="text" name="First_Inistance_Date" value="<?php echo htmlentities($row_RSDisciplinaryDataUpdate['First_Inistance_Date'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right" valign="top">Second Inistance:</td>
                            <td><textarea name="Second_Inistance" cols="50" rows="15"><?php echo htmlentities($row_RSDisciplinaryDataUpdate['Second_Inistance'], ENT_COMPAT, 'utf-8'); ?></textarea></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Second Inistance Date:</td>
                            <td><input type="text" name="Second_Inistance_Date" value="<?php echo htmlentities($row_RSDisciplinaryDataUpdate['Second_Inistance_Date'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right" valign="top">Third Inistance:</td>
                            <td><textarea name="Third_Inistance" cols="50" rows="15"><?php echo htmlentities($row_RSDisciplinaryDataUpdate['Third_Inistance'], ENT_COMPAT, 'utf-8'); ?></textarea></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Third Inistance Date:</td>
                            <td><input type="text" name="Third_Inistance_Date" value="<?php echo htmlentities($row_RSDisciplinaryDataUpdate['Third_Inistance_Date'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right" valign="top">Last Warning:</td>
                            <td><textarea name="Last_Warning" cols="50" rows="15"><?php echo htmlentities($row_RSDisciplinaryDataUpdate['Last_Warning'], ENT_COMPAT, 'utf-8'); ?></textarea></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">Last Warning Date:</td>
                            <td><input type="text" name="Last_Warning_Date" value="<?php echo htmlentities($row_RSDisciplinaryDataUpdate['Last_Warning_Date'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">&nbsp;</td>
                            <td><input type="submit" value="Update record" /></td>
                        </tr>
                    </table>
                    <input type="hidden" name="MM_update" value="form1" />
                    <input type="hidden" name="Auto_ID" value="<?php echo $row_RSDisciplinaryDataUpdate['Auto_ID']; ?>" />
                </form>

                </p>

                <!-- InstanceEndEditable -->
            </div>
        </div>

    </body>
    <!-- InstanceEnd --> </html>
<?php
mysql_free_result($RSDisciplinaryDataUpdate);
?>

