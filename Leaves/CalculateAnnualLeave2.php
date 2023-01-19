 
<script src="../Js/Numberofdays.js" type="text/javascript"></script>

<script type="text/javascript" src="../Js/toggle.js">
</script>
<script type="text/javascript" src="../Js/PrintContent.js">


        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/ThekeyHRMS_main_Template.dwt" codeOutsideHTMLIsLocked="false" -->
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thekey HRMS</title>
</script>
    <?php
//initialize the session
    if (!session_id()) {
        session_start();
    }

// ** Logout the current user. **
    $logoutAction = $_SERVER['PHP_SELF'] . "?doLogout=true";
    if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")) {
        $logoutAction .="&" . htmlentities($_SERVER['QUERY_STRING']);
    }

    if ((isset($_GET['doLogout'])) && ($_GET['doLogout'] == "true")) {
        //to fully log out a visitor we need to clear the session varialbles
        $_SESSION['MM_Fullname'] = NULL;
        $_SESSION['MM_Username'] = NULL;
        $_SESSION['MM_UserGroup'] = NULL;
        $_SESSION['PrevUrl'] = NULL;
        unset($_SESSION['MM_Username']);
        unset($_SESSION['MM_UserGroup']);
        unset($_SESSION['PrevUrl']);

        $logoutGoTo = "../login.php";
        if ($logoutGoTo) {
            header("Location: $logoutGoTo");
            exit;
        }
    }
    ?>


    <?php
//*****
//
    $db = mysql_connect($hostname_HRMS, $username_HRMS, $password_HRMS);
    if (!$db) {
        die('Not connected with Language Database : ' . mysql_error());
    }
    $db_selected = mysql_select_db($database_HRMS, $db);
    if (!$db_selected) {
        die('Can\'t use Language database : ' . mysql_error());
    }

//Setting Charcter set to unicode to support all language
    mysql_set_charset('utf8', $db);
// $db -> set_charset('utf8');
// create a new Langauge Object
    $obj_lang = new Language($db);

// ideally pull this from a users profile.

    if (!isset($_REQUEST["lang"]))
        $_REQUEST["lang"] = "en";

    $lang = $_REQUEST["lang"];
    ?>

    <?php
    $realpath = dirname(realpath(__FILE__));
//checking the connection is secure or not the identfy http or https protocol then append server host name
    $path = ((isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) != 'off') ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . "/" . substr($realpath, strlen($_SERVER['DOCUMENT_ROOT']));

    if (DIRECTORY_SEPARATOR == '\\')
        $path = str_replace('\\', '/', $path);
    ?>
 


            </head>

            <body>


            <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" -->
  
            <blockquote>
        
            <blockquote>
              <p class="active">
     
                      <font color="#FF6600" size="+1"> <?php echo $obj_lang->get('Annual Leave Calculator', $lang); ?></font>
    <?php
    $_GET['TableName'] = "employee_personal_record";

    $_GET['OpenPage'] = "CalculateAnnualLeave";

    require_once($base_path . "Search Name/SearchName.php");
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
          
          
		
          <input type="button" value=" <?php echo $obj_lang->get('Calculate Annual Leave', $lang); ?>" onClick="TINY.box.show({url:'ALCalculatedReport.php',post:'<?php
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
    ?>',width:380,height:1000,opacity:20,topsplit:3})"    /> 
          
            </td>
            </tr>
     
            </table>
            </font>
      <p>
        <input type="hidden" name="MM_insert" value="form1" />
                </p>
 
                </form>
         
  
                <blockquote>&nbsp;</blockquote>
    
                <!-- InstanceEndEditable -->
                <blockquote>&nbsp;</blockquote>
                </div>
  


                </body>
                <!-- InstanceEnd --> </html>


