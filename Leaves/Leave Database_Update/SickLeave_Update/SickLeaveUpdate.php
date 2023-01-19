<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--meta http-equiv="Content-Type" content="text/html; charset=utf-8" /-->
<title>Thekey HRMS</title>

<?php
    $base_path = $_SERVER['DOCUMENT_ROOT'] . 'ThekeyHRMS/';
    require_once $base_path . 'Templates/head.php';
    ?>
</head>

<body>
<div id="busy" style="display: none;">
            <img alt="Am Working" src="http://<?php echo $base_url ?>images/BusyAnimation.gif">
        </div>

<?php 
	
	$mydb = new DataBase(); ?>
    <?php


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	$data = array('ID' => $_POST['ID']
        ,'FirstName' => $_POST['FirstName']
        , 'MiddelName' => $_POST['MiddelName']
        ,'LastName' => $_POST['LastName']
        , 'SickLeavedays' => $_POST['SickLeavedays']
        , 'SickLeave_Taken_Date' => $_POST['SickLeave_Taken_Date']
         , 'ReportOn' => $_POST['ReportOn']
         , 'LeaveType' => $_POST['LeaveType']
         , 'Reported' => $_POST['Reported']
         , 'Report_Back_Date' => $_POST['Report_Back_Date']
           , 'ModifiedBy' => $_SESSION['MM_FullName']);
    
    $mydb->where(array('Auto_ID' => $_POST['Auto_ID']));
    $Result1 = $mydb->update('sick_leave', $data);
   

  
  if($Result1)
  echo "<script type=\"text/javascript\"> alert('Employee Sick Leave Data updated Successfully '); </script>";
   
     $updateGoTo = "index.php";
	 
 
  
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
  
}
?>
    <?php
mysql_select_db($database_HRMS, $HRMS);
if(isset($_GET['Auto_ID']))
{

$query_RSSickLeaveUpdate = "SELECT * FROM  sick_leave where Auto_ID=".$_GET['Auto_ID']."";}else
$query_RSSickLeaveUpdate = "SELECT * FROM sick_leave where Auto_ID=-1";
//$query_RSSickLeaveUpdate = "SELECT * FROM sick_leave";
$RSSickLeaveUpdate = mysql_query($query_RSSickLeaveUpdate, $HRMS) or die(mysql_error());
$row_RSSickLeaveUpdate = mysql_fetch_assoc($RSSickLeaveUpdate);
$totalRows_RSSickLeaveUpdate = mysql_num_rows($RSSickLeaveUpdate);
?>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
      <font color="#FF6600" size="+1" > <p align="center">Sick Leave Record Update form</p></font>
      <table align="center">
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">ID:</td>
          <td><input type="text" name="ID" value="<?php echo htmlentities($row_RSSickLeaveUpdate['ID'], ENT_COMPAT, 'utf-8'); ?>" size="32" readonly="readonly" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">First Name:</td>
          <td><input type="text" name="FirstName" value="<?php echo htmlentities($row_RSSickLeaveUpdate['FirstName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Middel Name:</td>
          <td><input type="text" name="MiddelName" value="<?php echo htmlentities($row_RSSickLeaveUpdate['MiddelName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Last Name:</td>
          <td><input type="text" name="LastName" value="<?php echo htmlentities($row_RSSickLeaveUpdate['LastName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Leave days:</td>
          <td><input type="text" name="SickLeavedays" value="<?php echo htmlentities($row_RSSickLeaveUpdate['SickLeaveDays'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Leave Taken Date:</td>
          <td><input type="text" name="SickLeave_Taken_Date" value="<?php echo htmlentities($row_RSSickLeaveUpdate['SickLeave_Taken_Date'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Report On:</td>
          <td><input type="text" name="ReportOn" value="<?php echo htmlentities($row_RSSickLeaveUpdate['ReportOn'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Leave Type:</td>
          <td><input type="text" name="LeaveType" value="<?php echo htmlentities($row_RSSickLeaveUpdate['LeaveType'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Reported:</td>
          <td><input type="text" name="Reported" value="<?php echo htmlentities($row_RSSickLeaveUpdate['Reported'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Report Back Date:</td>
          <td><input type="text" name="Report_Back_Date" value="<?php echo htmlentities($row_RSSickLeaveUpdate['Report_Back_Date'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td><input type="submit" value="Update record" /></td>
        </tr>
      </table>
      <input type="hidden" name="MM_update" value="form1" />
      <input type="hidden" name="Auto_ID" value="<?php echo $row_RSSickLeaveUpdate['Auto_ID']; ?>" />
    </form>
</body>
</html>
<?php
mysql_free_result($RSSickLeaveUpdate);
?>

