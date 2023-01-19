<div id="thekeysearch_name">

    <?php
    if (!(isset($base_url))) {
        if (!defined('validurl'))
            define("validurl", TRUE);
        $base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
        $base_url = $_SERVER['SERVER_NAME'] . '/ThekeyHRMS/';
    }

    $realpath = dirname(realpath(__FILE__));
//checking the connection is secure or not the identfy http or https protocol then append server host name
    $path = ((isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) != 'off') ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . "/" . substr($realpath, strlen($_SERVER['DOCUMENT_ROOT']));
    if (DIRECTORY_SEPARATOR == '\\')
        $path = str_replace('\\', '/', $path);

    $obj_AccessLevel = new AccessLevel();
    $selecte_group = $_SESSION['MM_UserGroup'];
    $my_department = $obj_AccessLevel->get_department_access($selecte_group);

    $query_RSFirstName = "SELECT  DISTINCT `ID` , `FirstName` , `MiddelName` , `LastName` , `Department` FROM employee_personal_record";


    if (isset($_GET['TableName']))
        if ($_GET['TableName'] != 'employee_personal_record')
            $query_RSFirstName = "SELECT  DISTINCT `employee_personal_record`.`ID` , `employee_personal_record`.`FirstName` , `employee_personal_record`.`MiddelName` , `employee_personal_record`.`LastName` , `employee_personal_record`.`Department` FROM " . $_GET['TableName'] . " join employee_personal_record on " . $_GET['TableName'] . ".ID=employee_personal_record.ID";
    $is_first = true;

    if (is_array($my_department)) {

        if (count($my_department) > 0) {
            $query_RSFirstName .= ' Where ';

            foreach ($my_department as $key => $value) {
                if ($is_first) {
                    $query_RSFirstName .=' (`employee_personal_record`.`Department`=\'' . $value . '\'';
                    $is_first = false;
                }
                else
                    $query_RSFirstName .=' or  `employee_personal_record`.`Department`=\'' . $value . '\'';
            }
        }
        $query_RSFirstName = $query_RSFirstName . ')';
    }

    $old_query = $query_RSFirstName;
    $query_RSFirstName .= ' ORDER BY ID ASC';


    $RSFirstName = mysql_query($query_RSFirstName, $HRMS) or die(mysql_error());



    $row_RSFirstName = mysql_fetch_assoc($RSFirstName);
    $totalRows_RSFirstName = mysql_num_rows($RSFirstName);
    ?>

    <?php
    $editFormAction = $_SERVER['PHP_SELF'];
    if (isset($_SERVER['QUERY_STRING'])) {
        $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
    }

    if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "SearchName")) {

        if (isset($_POST['find'])) {
            $find = $_POST['find'];
        }
        $searching = "yes";

        //This is only displayed if they have submitted the form
        if ($searching == "yes") {
            echo "<h2><font color=\"#FB33\">Results</font></h2><p>";

            //If they did not enter a search term we give them an error
            if ($find == "") {
                echo "<p><font color=\"#FF0000\">Enter First a search term</font>";
// exit;
            } else {

                // Otherwise we connect to our Database
                /////mysql_connect("localhost", "root", "") or die(mysql_error());
                ////// mysql_select_db("ThekeyHRMSDB") or die(mysql_error());
                // We preform a bit of filtering
                //Now we search for our search term, in the field the user specified

                $data = $old_query;
                if (isset($_POST['find'])) {
                    $find = $_POST['find'];
                    if (is_numeric($find)) {

                        $find = strip_tags($find);
                        $find = trim($find);
                        $field = "ID";
                    } else {

                        $find = strtoupper($find);
                        $find = strip_tags($find);
                        $find = trim($find);
                        $field = "FirstName";
                    }


                    if (!$is_first)
                        $data .=" and upper($field) LIKE'%$find%'";
                    else
                        $data .=" where upper($field) LIKE'%$find%'";
                }
                $data .= ' ORDER BY ID ASC';

                echo "<table id=\"SearchNameResult\" border=\"4\" align=\"center\" bgcolor=\"#EBEBEB\" bordercolor=\"#FF6600\" >";

                $data = mysql_query($data, $HRMS) or die(mysql_error());
                //And we display the results
                while ($result = mysql_fetch_array($data)) {
                    $ID = $result['ID'];


                    echo "<tr><td>";

                    if (isset($_GET['OpenPage']))
                        echo "<a href=\"" . $_GET['OpenPage'] . ".php?ID=" . $ID . "\">";

                    echo $result['ID'] . "</td><td>";
                    echo " " . $result['FirstName'] . "</td><td>";
                    echo " ";
                    echo $result['MiddelName'] . "</td><td>";
                    echo " ";
                    echo $result['LastName'] . "</td><td>";
                    echo " ";
                    echo $result['Department'] . "</td></tr></a>";
// echo "<br>";
                }

                //This counts the number or results - and if there wasn't any it gives them a little message explaining that
                $anymatches = mysql_num_rows($data);
                if ($anymatches == 0) {
                    echo "<font color=\"#FF0000\">Sorry, but there is no such employee on entire current employee list<br><br></font>";
                }

                //And we remind them what they searched for
                echo "<b>Searched For:</b> " . $find;
                echo "<br/><b> Total Available :</b> " . $anymatches . " employee";
                echo "<br/>";
            }
        }//else closing for empty serach text
        // mysql_select_db($database_HRMS, $HRMS);
        // $Result1 = mysql_query($insertSQL, $HRMS) or die(mysql_error());
    }



    $RSsearch = $RSFirstName;
    $row_RSsearch = $row_RSFirstName;
    $totalRows_RSsearch = $totalRows_RSFirstName;




////serach code end
    ?>


    <script type='text/javascript'>
        var $_GET = <?php echo json_encode($_GET); ?>;

        function SelectedFirstName(elem, helperMsg) {
            //document.writeln(elem.value);
            alert("You have Slelcted " + elem.value + "!")
            //var ID=elem.value;

<?php if (isset($_GET['$OpenPage'])) { ?>
                location = "<?php echo $_GET['$OpenPage']; ?>.php?FirstName=" + elem.value;
<?php } ?>
            if (elem.value == "Please Choose FirstName") {
                alert(helperMsg);
                elem.focus();
                return false;
            } else {
                return true;
            }


        }
        function TypedFirstName(elem, helperMsg) {
            var str = elem.value;
            str = str.toUpperCase()
            //str.replace("Microsoft","W3Schools"));
            //if (str.match("SH")==null) {
            if (str.indexOf("AQ") != 0) {

<?php if (isset($_GET['$OpenPage'])) { ?>
                    location = "<?php echo $_GET['$OpenPage']; ?>.php?FirstName=" + elem.value;
<?php } ?>
            }
            else

            {
<?php if (isset($_GET['$OpenPage'])) { ?>
                    location = "<?php echo $_GET['$OpenPage']; ?>.php?ID=" + elem.value;
<?php } ?>
            }
            if (elem.value == "") {
                alert(helperMsg);
                elem.focus();
                return false;
            } else {
                return true;
            }

        }

        function SelectedID(elem, helperMsg) {

            //Getting Passed vaule using bultin php v 5 json function
            var $_GET = <?php echo json_encode($_GET); ?>;
            //document.write($_GET["OpenPage"]);

            alert("You Choose " + elem.value + " ID Number!")
            var ID = elem.value;


            if (typeof $_GET["OpenPage"] != 'undefined')
                location = "" + $_GET["OpenPage"] + ".php?ID=" + elem.value;
            if (elem.value == "Please Choose ID Number") {
                alert(helperMsg);
                elem.focus();
                return false;
            } else {
                return true;
            }
        }
    </script>
    <script type="text/javascript">
        //J-query for First name aut display script
        $().ready(function() {

            //Checking the the table name to complete set or not the display the data from table name
            $("#find").autocomplete("<?php echo "http://" . $base_url; ?>Search_Name/get_FirstName.php?TableName=<?php
if (isset($_GET['TableName'])) {
    echo $_GET['TableName'];
} else {
    echo "employee_personal_record";
}
?>", {
                width: 260,
                matchContains: true
            });

        });
    </script>
</div>

<form action="<?php echo $editFormAction; ?>" method="post" name="SearchName" id="SearchName">
    <table width="528" id="frmSearchName">
        <tr>
            <td>Type Employee Name </td>
            <td><input type="text" size="20"  id="find" name="find" /></td>
            <td><input type="image" src="<?php echo "http://" . $base_url . "img/Search.png"; ?>" alt="Search" width="33" height="24" /></td>
            <td> <input type="hidden" name="MM_insert" value="SearchName" /></td>
            <td><label for="ID">OR Select ID</label>
                <select name="ID" id="ID" tabindex="40" onchange="SelectedID(document.getElementById('ID'), 'Please Choose Something')">
                    <option value="Select ID">Select ID</option>
                    <?php
                    do {
                        ?>
                        <option value="<?php echo $row_RSFirstName['ID'] ?>"><?php echo $row_RSFirstName['ID'] ?></option>
                        <?php
                    } while ($row_RSFirstName = mysql_fetch_assoc($RSFirstName));
                    $rows = mysql_num_rows($RSFirstName);
                    if ($rows > 0) {
                        mysql_data_seek($RSFirstName, 0);
                        $row_RSFirstName = mysql_fetch_assoc($RSFirstName);
                    }
                    ?>
                </select>
            </td>
        </tr>
    </table>
</form>