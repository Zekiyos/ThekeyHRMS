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
 <?php require_once $base_path .'Templates/header.php'; ?>

  <div id="mainContent"><!-- InstanceBeginEditable name="MainContent" -->
  
   <?php echo '<p class="WelCome">Wel Come "'. $_SESSION['MM_Fullname']."\"</p>";
	
	$mydb = new DataBase(); ?>
    <?php


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	
	$Section=$_POST['Section'];
	$SubSection=$_POST['Sub_Section'];
	$Group=$_POST['Group'];
		
	
	 if($_POST['Section']=='Select Section...')
	{
		$Section=$_POST['SectionNEW'];
	}
     if($_POST['Sub_Section']=='Select Sub Section...')
	{
	    $SubSection=$_POST['Sub_SectionNEW'];
	}
	 if($_POST['Group']=='Select Group...')
	{
		$Group=$_POST['GroupNEW'];
	}
	
					   
 $data = array('Section' => $Section
        ,'Sub Section' => $SubSection
        ,'Group' => $Group
        , 'Department' => $_POST['Department']);
    
        $Result1 = $mydb->insert('department', $data);

      if($Result1)
  echo "<script type=\"text/javascript\">alert('Department Created Successfuly!!')</script>";
}
?>
    <?php
mysql_select_db($database_HRMS, $HRMS);
$query_RSCreatDeaprtment = "SELECT * FROM department ";
$RSCreatDeaprtment = mysql_query($query_RSCreatDeaprtment, $HRMS) or die(mysql_error());
$row_RSCreatDeaprtment = mysql_fetch_assoc($RSCreatDeaprtment);
$totalRows_RSCreatDeaprtment = mysql_num_rows($RSCreatDeaprtment);


$query_RSCreatDeaprtment1 = "SELECT DISTINCT  Section FROM department ORDER BY `Section`";
$RSCreatDeaprtment1= mysql_query($query_RSCreatDeaprtment1, $HRMS) or die(mysql_error());
$row_RSCreatDeaprtment1 = mysql_fetch_assoc($RSCreatDeaprtment1);
$totalRows_RSCreatDeaprtment1 = mysql_num_rows($RSCreatDeaprtment1);


$query_RSCreatDeaprtment2 = "SELECT DISTINCT `Sub Section` FROM department ORDER BY `Sub Section` ";
$RSCreatDeaprtment2= mysql_query($query_RSCreatDeaprtment2, $HRMS) or die(mysql_error());
$row_RSCreatDeaprtment2 = mysql_fetch_assoc($RSCreatDeaprtment2);
$totalRows_RSCreatDeaprtment2 = mysql_num_rows($RSCreatDeaprtment2);


$query_RSCreatDeaprtment3 = "SELECT DISTINCT  `Group` FROM department ORDER BY `Group`";
$RSCreatDeaprtment3= mysql_query($query_RSCreatDeaprtment3, $HRMS) or die(mysql_error());
$row_RSCreatDeaprtment3 = mysql_fetch_assoc($RSCreatDeaprtment3);
$totalRows_RSCreatDeaprtment3 = mysql_num_rows($RSCreatDeaprtment3);

?>
   <script type="text/javascript">
function toggle(element) {
    document.getElementById(element).style.display = (document.getElementById(element).style.display == "none") ? "" : "none";

}
</script>

<font color="#FF6600" size="+1"><p align="center">Creat New Department Form</p></font>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
      <p>&nbsp;</p>
      <table width="519" height="256" align="center" bgcolor="#EBEBEB">
        <tr valign="baseline">
          <td width="91" height="50" align="right" nowrap="nowrap">Section:</td>
          <td width="327"><select name="Section">
           <option>Select Section...</option> <?php 
do {  
?>
   
            <option value="<?php echo $row_RSCreatDeaprtment1['Section']?>" ><?php echo $row_RSCreatDeaprtment1['Section']?></option>
            <?php
} while ($row_RSCreatDeaprtment1 = mysql_fetch_assoc($RSCreatDeaprtment1));
?>
          </select><input value="+" type="button" onClick="javascript:toggle('DivSection')"/>
    <div id="DivSection" style="display: none;" ><input type="text" name="SectionNEW" size="40" value="" /></div></td>
        </tr>
        <tr> </tr>
        <tr valign="baseline">
          <td height="50" align="right" nowrap="nowrap">Sub Section:</td>
          <td><select name="Sub_Section">
        <option>Select Sub Section...</option><?php 
do {  
?>      
            <option value="<?php echo $row_RSCreatDeaprtment2['Sub Section']?>" ><?php echo $row_RSCreatDeaprtment2['Sub Section']?></option>
            <?php
} while ($row_RSCreatDeaprtment2 = mysql_fetch_assoc($RSCreatDeaprtment2));
?>
          </select><input value="+" type="button" onClick="javascript:toggle('DivSubSection')"/>
    <div id="DivSubSection" style="display: none;" ><input type="text" name="Sub_SectionNEW" size="40" value="" /></div></td>
        </tr>
        <tr> </tr>
        <tr valign="baseline">
          <td height="51" align="right" nowrap="nowrap">Group:</td>
          <td><select name="Group">
             <option>Select Group...</option> <?php 
do {  
?>  
            <option value="<?php echo $row_RSCreatDeaprtment3['Group']?>" ><?php echo $row_RSCreatDeaprtment3['Group']?></option>
            <?php
} while ($row_RSCreatDeaprtment3 = mysql_fetch_assoc($RSCreatDeaprtment3));
?>
          </select><input value="+" type="button" onClick="javascript:toggle('DivGroup')"/>
    <div id="DivGroup" style="display: none;" ><input type="text" name="GroupNEW" size="40" value="" /></div></td>
        </tr>
        <tr> </tr>
        <tr valign="baseline">
          <td height="55" align="right" nowrap="nowrap">Department:</td>
          <td><input type="text" name="Department" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td><input type="submit" value="Creat Department" /></td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form1" />
    </form>
    <p>&nbsp;</p>
<p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  <!-- InstanceEndEditable -->
 </div>
  </div>
  
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($RSCreatDeaprtment);
?>

