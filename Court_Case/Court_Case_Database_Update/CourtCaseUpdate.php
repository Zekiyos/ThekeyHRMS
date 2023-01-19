<?php
$dont_check = true;
$include_html = true;
$base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
require_once $base_path . 'Templates/head.php';

$mydb = new DataBase();

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {


    $data = array(
        'FileNumber' => $_POST['FileNumber']
        , 'FileDate' => $_POST['FileDate']
        , 'ClaimAmount' => $_POST['ClaimAmount']
        , 'AdvocateName' => $_POST['AdvocateName']
        , 'AppointmentDate' => $_POST['AppointmentDate']
        , 'Court' => $_POST['Court']
        , 'Case' => $_POST['Case']
        , 'Result' => $_POST['Result']
        , 'Decision' => $_POST['Decision']
        , 'Case_Status' => $_POST['Case_Status']);

    $mydb->where(array('Auto_ID' => $_POST['Auto_ID']));
    $Result1 = $mydb->update('court_case', $data);


    $updateGoTo = "index.php";


    header(sprintf("Location: %s", $updateGoTo));
}


mysql_select_db($database_HRMS, $HRMS);

if (isset($_GET['Auto_ID'])) {

    $query_RSCourtCaseUpdate = "SELECT * FROM  court_case where Auto_ID=" . $_GET['Auto_ID'] . "";
}else
    $query_RSCourtCaseUpdate = "SELECT * FROM court_case where Auto_ID=-1";

//$query_RSCourtCaseUpdate = "SELECT * FROM court_case";
$RSCourtCaseUpdate = mysql_query($query_RSCourtCaseUpdate, $HRMS) or die(mysql_error());
$row_RSCourtCaseUpdate = mysql_fetch_assoc($RSCourtCaseUpdate);
$totalRows_RSCourtCaseUpdate = mysql_num_rows($RSCourtCaseUpdate);
?>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table align="center">
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">ID:</td>
            <td><input type="text" readonly="readonly" name="ID" value="<?php echo htmlentities($row_RSCourtCaseUpdate['ID'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">First Name:</td>
            <td><input type="text"  readonly="readonly"  name="FirstName" value="<?php echo htmlentities($row_RSCourtCaseUpdate['FirstName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Middel Name:</td>
            <td><input type="text"  readonly="readonly"  name="MiddelName" value="<?php echo htmlentities($row_RSCourtCaseUpdate['MiddelName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Last Name:</td>
            <td><input type="text"  readonly="readonly" name="LastName" value="<?php echo htmlentities($row_RSCourtCaseUpdate['LastName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Department:</td>
            <td><input type="text"  readonly="readonly" name="Department" value="<?php echo htmlentities($row_RSCourtCaseUpdate['Department'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">File Number:</td>
            <td><input type="text" name="FileNumber" value="<?php echo htmlentities($row_RSCourtCaseUpdate['FileNumber'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">File Date:</td>
            <td><input type="text" name="FileDate" value="<?php echo htmlentities($row_RSCourtCaseUpdate['FileDate'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Claim Amount:</td>
            <td><input type="text" name="ClaimAmount" value="<?php echo htmlentities($row_RSCourtCaseUpdate['ClaimAmount'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Advocate Name:</td>
            <td><input type="text" name="AdvocateName" value="<?php echo htmlentities($row_RSCourtCaseUpdate['AdvocateName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Appointment Date:</td>
            <td><input type="text" name="AppointmentDate" value="<?php echo htmlentities($row_RSCourtCaseUpdate['AppointmentDate'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Court:</td>
            <td><input type="text" name="Court" value="<?php echo htmlentities($row_RSCourtCaseUpdate['Court'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Case:</td>
            <td><input type="text" name="Case" value="<?php echo htmlentities($row_RSCourtCaseUpdate['Case'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Result:</td>
            <td><input type="text" name="Result" value="<?php echo htmlentities($row_RSCourtCaseUpdate['Result'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Decision:</td>
            <td><input type="text" name="Decision" value="<?php echo htmlentities($row_RSCourtCaseUpdate['Decision'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Case Status:</td>
            <td><input type="text" name="Case_Status" value="<?php echo htmlentities($row_RSCourtCaseUpdate['Case_Status'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" value="Update record" /></td>
        </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="Auto_ID" value="<?php echo $row_RSCourtCaseUpdate['Auto_ID']; ?>" />
</form>