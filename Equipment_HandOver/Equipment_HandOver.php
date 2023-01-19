<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/ThekeyHRMS_main_Template.dwt" codeOutsideHTMLIsLocked="false" -->
    <head>
        <!--meta http-equiv="Content-Type" content="text/html; charset=utf-8" /-->
        <title>Thekey HRMS</title>
        <!----------------Autocomplete----------------------->
        <script type="text/javascript" src="../Js/jquery.js"></script>
        <script type='text/javascript' src='../Js/jquery.bgiframe.min.js'></script>
        <script type='text/javascript' src='../Js/jquery.ajaxQueue.js'></script>
        <script type='text/javascript' src='../Js/thickbox-compressed.js'></script>
        <script type='text/javascript' src='../Js/jquery.autocomplete.js'></script>
        <script type='text/javascript' src='../Js/localdata.js'></script>


        <script type="text/javascript">
            $().ready(function() {

                function log(event, data, formatted) {
                    $("<li>").html( !data ? "No match!" : "Selected: " + formatted).appendTo("#result");
                }
	
                function formatItem(row) {
                    return row[0] + " (<strong>id: " + row[1] + "</strong>)";
                }
                function formatResult(row) {
                    return row[0].replace(/(<.+?>)/gi, '');
                }
	
                $("#imageSearch").autocomplete("Search_Path.php", {
                    width: 320,
                    max: 10,
                    highlight: false,
                    scroll: true,
                    scrollHeight: 300,
                    formatItem: function(data, i, n, value) {
                        return "<img  src='Equipment_Picture/" + value + "' height='90' width='80'/> " + value.split(".")[0];
                    },
                    formatResult: function(data, value) {
                        return value.split(".")[0];
                    }
                });
	
	
                $(":text, textarea").result(log).next().click(function() {
                    $(this).prev().search();
                });

            });

            function changeOptions(){
                var max = parseInt(window.prompt('Please type number of items to display:', jQuery.Autocompleter.defaults.max));
                if (max > 0) {
                    $("#suggest1").setOptions({
                        max: max
                    });
                }
            }

            function changeScrollHeight() {
                var h = parseInt(window.prompt('Please type new scroll height (number in pixels):', jQuery.Autocompleter.defaults.scrollHeight));
                if(h > 0) {
                    $("#suggest1").setOptions({
                        scrollHeight: h
                    });
                }
            }

            function changeToMonths(){
                $("#suggest1")
                // clear existing data
                .val("")
                // change the local data to months
                .setOptions({data: months})
                // get the label tag
                .prev()
                // update the label tag
                .text("Month (local):");
            }
        </script>

        <!--------------end of Autocomplete-------------->
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
                $query_RSHandOver = "SELECT * FROM employee_personal_record";
                $RSHandOver = mysql_query($query_RSHandOver, $HRMS) or die(mysql_error());
                $row_RSHandOver = mysql_fetch_assoc($RSHandOver);
                $totalRows_RSHandOver = mysql_num_rows($RSHandOver);

                $editFormAction = $_SERVER['PHP_SELF'];
                if (isset($_SERVER['QUERY_STRING'])) {
                    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
                }

                if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

                    if ($_POST['EquipmentName'] == "Please choose the Equipment")
                        $SelectedEquipment = $_POST['imageSearch'];
                    else
                        $SelectedEquipment = $_POST['EquipmentName'];


                    $data = array('ID' => $_POST['ID']
                        , 'FirstName' => $_POST['FirstName']
                        , 'MiddelName' => $_POST['MiddelName']
                        , 'LastName' => $_POST['LastName']
                        , 'Department' => $_POST['Department']
                        , 'EquipmentName' => $SelectedEquipment
                        , 'Taken_Date' => $_POST['Day_Taken']
                        , 'Replacement_Date' => $_POST['Replacement_Date']);

                    
                    
                    $Result1 = $mydb->insert('Equipment_HandOver', $data);

                    if ($Result1)
                        echo "<script type=\"text/javascript\">alert('You have registed the Equipment Handover Data Seccussfully.')</script>";
                }

                mysql_select_db($database_HRMS, $HRMS);
                $query_RSHandOver = "SELECT * FROM Equipment_handover";
                $RSHandOver = mysql_query($query_RSHandOver, $HRMS) or die(mysql_error());
                $row_RSHandOver = mysql_fetch_assoc($RSHandOver);
                $totalRows_RSHandOver = mysql_num_rows($RSHandOver);

                mysql_select_db($database_HRMS, $HRMS);
                $query_RSEquipmentList = "SELECT * FROM equipment_list ORDER BY Equipment_Name ASC";
                $RSEquipmentList = mysql_query($query_RSEquipmentList, $HRMS) or die(mysql_error());
                $row_RSEquipmentList = mysql_fetch_assoc($RSEquipmentList);
                $totalRows_RSEquipmentList = mysql_num_rows($RSEquipmentList);
                ?>
                <h1 class="form_lable">
                    <?php echo $obj_lang->get('Equipment Handover Form', $lang); ?>  
                </h1>
                <?php
                $_GET['TableName'] = "employee_personal_record";

                $_GET['OpenPage'] = "Equipment_HandOver";

                require_once($base_path . "Search_Name/SearchName.php");
                ?>


                <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">

                    <table width="400" height="362" align="center" background="" bgcolor="#EBEBEB">
                        <tr valign="baseline">
                            <td width="128" height="39" align="right" nowrap="nowrap"> <?php echo $obj_lang->get('Selected ID', $lang); ?>:</td>
                            <td width="385">
                                <input name="ID" value="<?php
                if (isset($_GET['ID'])) {
                    echo $_GET['ID'];
                }
                ?>" size="10" readonly="readonly"  />     
                            </td>
                        </tr>

                        <tr valign="baseline">
                            <td height="37" align="right" nowrap="nowrap"><?php echo $obj_lang->get('First Name', $lang); ?>:</td>
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
                            <td height="37" align="right" nowrap="nowrap"><?php echo $obj_lang->get('Middel Name', $lang); ?>:</td>
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
                            <td height="36"  align="right" nowrap="nowrap"><?php echo $obj_lang->get('Last Name', $lang); ?>:</td>
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
                            <td height="40" align="right" nowrap="nowrap"><?php echo $obj_lang->get('Department', $lang); ?>:</td>
                            <td><input type="text" name="Department" value="<?php
                                       $query = "SELECT * FROM employee_personal_record";
                                       $result = mysql_query($query);
                                       while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                           if (isset($_GET['ID'])) {
                                               if ($row['ID'] == $_GET['ID']) {

                                                   echo "{$row['Department']}";
                                               }
                                           }
                                       }
                ?>" size="20" readonly="readonly" /></td>
                        </tr>
                        <tr valign="baseline">
                            <td height="36"  align="right" nowrap="nowrap"><?php echo $obj_lang->get('Equipments', $lang); ?>:</td>
                            <td>
                                <input type="text" id='imageSearch' name="imageSearch" size="12" />
                                <!--ol id="result"  ></ol-->

                                <select name="EquipmentName">
                                    <option><?php echo $obj_lang->get('Please choose the Equipment', $lang); ?></option>
                                    <?php
                                    do {
                                        ?>
                                        <option value="<?php echo $row_RSEquipmentList['Equipment_Name'] ?>"><?php echo $row_RSEquipmentList['Equipment_Name'] ?></option>
                                        <?php
                                    } while ($row_RSEquipmentList = mysql_fetch_assoc($RSEquipmentList));
                                    $rows = mysql_num_rows($RSEquipmentList);
                                    if ($rows > 0) {
                                        mysql_data_seek($RSEquipmentList, 0);
                                        $row_RSEquipmentList = mysql_fetch_assoc($RSEquipmentList);
                                    }
                                    ?>

                                </select>
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td height="43"  align="right" nowrap="nowrap"><?php echo $obj_lang->get('Day Taken On', $lang); ?>:</td>
                            <td>

                                <input name="Day_Taken" type="Date"  value="<?php echo date("Y-m-d"); ?>" size="20" maxlength="20" />
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td height="62" align="right" nowrap="nowrap"><?php echo $obj_lang->get('Replacement Date', $lang); ?>:</td>
                            <td>

                                <input type="Date" name="Replacement_Date"  value='<?php echo date("Y-m-d"); ?>' />
                            </td>
                        </tr>
                        <!--<input   type="text" name="ReportOn"  value="<?php
                                    /*

                                      $date = date("Y-m-d");
                                      //$off=$_POST['Restday']+$_POST['Leavedays']
                                      $off=1+4;
                                      $newdate = strtotime ( '+'.$off.' day' , strtotime ( $date ) ) ;
                                      $newdate = date ( 'Y-m-j' , $newdate );
                                      echo $newdate; */
                                    //$date = date("Y-m-d",strtotime($date)) 
                                    ?>" size="15" /--->

                        <tr valign="baseline">
                            <td nowrap="nowrap" align="right">&nbsp;</td>
                            <td><input type="submit" value="<?php echo $obj_lang->get('Register', $lang); ?>" onClick="return confirm('Are you sure you want to registered for this Employee?')"   /></td>
                        </tr>
                    </table>
                    </font>
                    <p>
                        <input type="hidden" name="MM_insert" value="form1" />
                    </p>

                </form>
                <?php
                mysql_free_result($RSHandOver);

                mysql_free_result($RSEquipmentList);
                ?>       

                <!-- InstanceEndEditable -->
            </div>
        </div>

    </body>
    <!-- InstanceEnd --> </html>


