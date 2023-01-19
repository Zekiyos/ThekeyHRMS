<script src="../Js/Numberofdays.js" type="text/javascript"></script>

<script type="text/javascript" src="../Js/toggle.js">
</script>
<script type="text/javascript" src="../Js/PrintContent.js">
</script>
<script type="text/javascript" src="../Js/tinybox.js"></script>

<link rel="stylesheet"  href="../Css/tinybox2style.css" />
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

                <h1 class="form_lable"> <?php echo $obj_lang->get('Annual Leave Calculator', $lang); ?></h1>
                <?php
                $_GET['TableName'] = "employee_personal_record";

                $_GET['OpenPage'] = "CalculateAnnualLeave";

                require_once($base_path . "Search_Name/SearchName.php");
                //onsubmit="POPUPW=window.open('ALCalculatedReport.php','POPUPW','width=400,height=450');" action="ALCalculatedReport.php"
                ?>


                <form method="post" name="form1" id="form1"  >

                    <table width="400" height="389" align="center" background="" bgcolor="#EBEBEB">
                        <tr valign="baseline">
                            <td width="128" align="right" nowrap="nowrap"> <?php echo $obj_lang->get('Selected ID', $lang); ?>:</td>
                            <td width="385">
                                <input name="ID" value="<?php
                if (isset($_GET['ID'])) {
                    //mysql_select_db('ThekeyHRMSlanguage');					
                    echo $_GET['ID'];
                }
                ?>" size="10" readonly="readonly"  />     
                            </td>
                        </tr>

                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('First Name', $lang); ?>:</td>
                            <td align="left"><input name="FirstName" type="text" value="<?php
                                       $query = "SELECT * FROM employee_personal_record";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {


                                               if ($row['ID'] == $_GET['ID']) {

                                                   echo "{$row['FirstName']}";
                                               }
                                           }
                                       }
                ?>"  


                                                    size="20" maxlength="20" readonly="readonly" align="left" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right"><?php echo $obj_lang->get('Middel Name', $lang); ?>:</td>
                            <td><input name="MiddelName" type="text" value="<?php
                                                    $query = "SELECT * FROM employee_personal_record";
                                                    $result = mysql_query($query);
                                                    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                                        if (isset($_GET['ID'])) {


                                                            if ($row['ID'] == $_GET['ID']) {
                                                                echo "{$row['MiddelName']}";
                                                            }
                                                        }
                                                    }
                ?>"size="20" maxlength="20" readonly="readonly" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td  align="right" nowrap="nowrap"><?php echo $obj_lang->get('Last Name', $lang); ?>:</td>
                            <td><input name="LastName" type="text" value="<?php
                                       $query = "SELECT * FROM employee_personal_record";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {


                                               if ($row['ID'] == $_GET['ID']) {
                                                   echo "{$row['LastName']}";
                                               }
                                           }
                                       }
                ?>" size="20" maxlength="20" readonly="readonly" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td  align="right" nowrap="nowrap"><?php echo $obj_lang->get('Department', $lang); ?>:</td>
                            <td><input name="Department" type="text" value="<?php
                                       $query = "SELECT * FROM employee_personal_record";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {


                                               if ($row['ID'] == $_GET['ID']) {
                                                   echo "{$row['Department']}";
                                               }
                                           }
                                       }
                ?>" size="20" maxlength="20" readonly="readonly" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td height="78"  align="right" nowrap="nowrap"><?php echo $obj_lang->get('Leave days', $lang); ?>:</td>
                            <td>
                                <input  id="Leavedays" name="Leavedays" type="text" value="0" size="5" maxlength="4"  />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">&nbsp;</td>
                            <td> 
                                <input type="button" value=" <?php echo $obj_lang->get('Calculate Annual Leave', $lang); ?>" 
                                       onClick="TINY.box.show(
                                           {url:'ALCalculatedReport.php',post:'<?php
                                       if (isset($_GET['ID'])) {
                                           //$Leavedays=$_POST['Leavedays'];
                                           $result = mysql_query("SELECT * FROM employee_personal_record where ID='" . $_GET['ID'] . "'");
                                           $row = mysql_fetch_array($result, MYSQL_ASSOC);
                                           echo "ID=";
                                           echo $_GET['ID'];
                                           echo "&FirstName=";
                                           echo "{$row['FirstName']}";
                                           echo "&MiddelName=";
                                           echo "{$row['MiddelName']}";
                                           echo "&LastName=";
                                           echo "{$row['LastName']}";
                                           echo "&Leavedays=";
                                           echo "&0"; //{$Leavedays}";
                                       }
                ?>',width:380,opacity:20,topsplit:3})"    /> 

                            </td>
                        </tr>

                    </table>
                    </font>
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


