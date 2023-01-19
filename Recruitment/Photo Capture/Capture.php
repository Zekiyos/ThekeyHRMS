 
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
 <?php require_once $base_path .'Templates/header.php'; ?>

  <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" -->
                <?php
                echo '<p class="WelCome">Wel Come "' . $_SESSION['MM_Fullname'] . "\"</p>";

                $mydb = new DataBase();
                ?>
                <style type="text/css">
                    <!--
                    .maindiv{
                        width:706px;
                        height: 483px;
                        overflow: hidden;
                        margin:0 auto;
                        padding:0px;
                        background:#CCC;
                    }
                    .innerbg{ padding:6px; background:#FFF;}
                    .result{ border:solid 1px #CCC; margin:10px 2px; padding:4px 2px;}
                    .title a{ font-weight:bold; color:#c24f00; text-decoration:none; font-size:14px;}
                    .discptn a{ text-decoration:none; color:#999;}
                    .link a{ color:#008000; text-decoration:none;}
                    img{ cursor:pointer;}
                    -->
                </style>
                <script src="js/swfobject.js" language="javascript"></script>

                <div style="width:730px; margin:0 auto;">
                </div>
                <div class="maindiv">
                    <div class="innerbg">
                        <table width="104%" height="230" border="0" cellpadding="2" cellspacing="2">
                            <tr><td align="center"><p><font color="#FF3300" size="+1" >Thekey HRMS Photo Capturing </font></p>
                                    <p><font color="#FF3300" size="+1" >ID Number 
                                            <input type="text" name="ID" id="ID" value="<?php
                $filename = "../LastID.txt";
                if (file_exists($filename)) {

                    $fd = fopen($filename, "r+") or die("Can't open file $filename");
                    $fstring = fread($fd, filesize($filename));

                    fclose($fd);


                    $initial = $fstring;

                    $sqlCS = "SELECT ID_Number_Initial_Character,Maximum_Allowed_ID_Number FROM company_settings";

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
                                            Employee Photography Capturing</font></p></td></tr>
                            <tr>
                                <td align="center" valign="middle">
                                    <div>
                                        <div id="flashArea" class="flashArea" style="height:100%;"><p align="center">This content requires the Adobe Flash Player.<br /><a href="http://www.adobe.com/go/getflashplayer">
                                                    <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /><br />
                                                    <a href="http://www.macromedia.com/go/getflash/">Get Flash</a></p>
                                        </div>
                                        <script type="text/javascript">
                                            var mainswf = new SWFObject("CapturePhoto.swf", "main", "800", "370", "11", "#ffffff");
                                            mainswf.addParam("scale", "noscale");
                                            mainswf.addParam("wmode", "window");
                                            mainswf.addParam("allowFullScreen", "true");
                                            //mainswf.addVariable("requireLogin", "false");
                                            mainswf.write("flashArea");
	
                                        </script>
                                    </div>


                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div style="width:730px; margin:0 auto; padding:8px 0px;">


                    <!-- InstanceEndEditable -->
 </div>
  </div>
  
</body>
<!-- InstanceEnd --></html>


