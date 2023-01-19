<?php
require_once('../../Connections/HRMS.php');

mysql_select_db($database_HRMS, $HRMS);
$query_RSFirstName = "SELECT Department FROM Department ORDER BY Department ASC";
$RSFirstName = mysql_query($query_RSFirstName, $HRMS) or die(mysql_error());
$row_RSFirstName = mysql_fetch_assoc($RSFirstName);
$totalRows_RSFirstName = mysql_num_rows($RSFirstName);

mysql_select_db($database_HRMS, $HRMS);
$query_RSID = "SELECT Department FROM Department ORDER BY Department ASC";
$RSID = mysql_query($query_RSID, $HRMS) or die(mysql_error());
$row_RSID = mysql_fetch_assoc($RSID);
$totalRows_RSID = mysql_num_rows($RSID);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title></title>

        <script type='text/javascript'>
            function SelectedID(elem, helperMsg){
                //document.writeln(elem.value);
                alert ( "You have Selected " + elem.value + "!")
                var Department=elem.value;
	
                location="Creat_Contract_Letter.php?Department=" + elem.value;
                if(elem.value == "Please Choose Department"){
                    alert(helperMsg);
                    elem.focus();
                    return false;
                }else{
                    return true;
                }
            }

        </script>

        <head>

        </head>
        <!--Probation_Evaluation.php-->
        <body >
            <form id="form1" name="form1" method="get" action="" >
                <p>
                    <label for="Department">Select  Department:</label>
                    <select name="Department" id="Department" onchange="SelectedID(document.getElementById('Department'), 'Please Choose Something')">
                        <option label="Please Choose Department"></option> 
                        <?php
                        do {
                            ?>
                            <option value="<?php echo $row_RSID['Department'] ?>"><?php echo $row_RSID['Department'] ?></option>
                            <?php
                        } while ($row_RSID = mysql_fetch_assoc($RSID));
                        $rows = mysql_num_rows($RSID);
                        if ($rows > 0) {
                            mysql_data_seek($RSID, 0);
                            $row_RSID = mysql_fetch_assoc($RSID);
                        }
                        ?>
                    </select>
            </form>
        </body>
</html>
