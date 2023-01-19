<?php require_once('../Connections/HRMS.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RSPersonalRecordUpdate = 10;
$pageNum_RSPersonalRecordUpdate = 0;
if (isset($_GET['pageNum_RSPersonalRecordUpdate'])) {
  $pageNum_RSPersonalRecordUpdate = $_GET['pageNum_RSPersonalRecordUpdate'];
}
$startRow_RSPersonalRecordUpdate = $pageNum_RSPersonalRecordUpdate * $maxRows_RSPersonalRecordUpdate;

mysql_select_db($database_HRMS, $HRMS);
$query_RSPersonalRecordUpdate = "SELECT * FROM employee_personal_record";
$query_limit_RSPersonalRecordUpdate = sprintf("%s LIMIT %d, %d", $query_RSPersonalRecordUpdate, $startRow_RSPersonalRecordUpdate, $maxRows_RSPersonalRecordUpdate);
$RSPersonalRecordUpdate = mysql_query($query_limit_RSPersonalRecordUpdate, $HRMS) or die(mysql_error());
$row_RSPersonalRecordUpdate = mysql_fetch_assoc($RSPersonalRecordUpdate);

if (isset($_GET['totalRows_RSPersonalRecordUpdate'])) {
  $totalRows_RSPersonalRecordUpdate = $_GET['totalRows_RSPersonalRecordUpdate'];
} else {
  $all_RSPersonalRecordUpdate = mysql_query($query_RSPersonalRecordUpdate);
  $totalRows_RSPersonalRecordUpdate = mysql_num_rows($all_RSPersonalRecordUpdate);
}
$totalPages_RSPersonalRecordUpdate = ceil($totalRows_RSPersonalRecordUpdate/$maxRows_RSPersonalRecordUpdate)-1;

$queryString_RSPersonalRecordUpdate = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RSPersonalRecordUpdate") == false && 
        stristr($param, "totalRows_RSPersonalRecordUpdate") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RSPersonalRecordUpdate = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RSPersonalRecordUpdate = sprintf("&totalRows_RSPersonalRecordUpdate=%d%s", $totalRows_RSPersonalRecordUpdate, $queryString_RSPersonalRecordUpdate);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thekey HRMS</title>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
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
<style type="text/css">
body {
	margin: 0;
	padding: 0;
	text-align: center;
	width: auto;
}
#wrrapper {
	margin: 0 auto;
	text-align: left;
	width: 900px;
	background-color: #999;
}
#headerspace {
	background-color: #999;
	height: 10px;
	width: 1280px;
}


/* menu */
.menu_nav {
	margin:0;
	padding:-15px 20px 0 20px;
	float:left;
	width: auto;
}
.menu_nav ul { list-style:none;}
.menu_nav ul li { margin:0 4px; padding:0 8px 0 0; float:left; background:url(../_template/clearfocus/html/images/menu.gif) no-repeat right center;}
.menu_nav ul li a {
	display:block;
	margin:0;
	padding:18px 16px;
	color:#F60;
	text-decoration:none;
	font-size:14px;
}
.menu_nav ul li.active a, .menu_nav ul li a:hover { background:url(../_template/clearfocus/html/images/menu_a.gif) repeat-x top;;}
#header {
	background-color: #FFF;
	height: 300px;
	top: 0px;
	clip: rect(0px,auto,auto,auto);
	width: 900px;
}
#sidemenu {
	font-size: 14px;
	font-weight: normal;
	color: #F60;
	background-color: #CCC;
	height: 250px;
	width: 120px;
}
#sidecontent {
	color: #F60;
	height: 430px;
	width: 120px;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
}
#headerimg {
	height: 60px;
	width: auto;
	background-color: #FFF;
	background-image: url("../img logo & icons/fade.jpg");
}
#mainnavigation {
	height: 200px;
	width: 100px;
	color: #660;
}
#headerAdvert {
	background-color: #FFF;
	height: 120px;
	width: 870px;
	color: #F90;
	font-size: 14px;
	top: 0px;
	clip: rect(0px,auto,auto,auto);
}
#sidebar {
	background-color: #FFF;
	margin: 0px;
	padding: 0px;
	height: 700px;
	width: 120px;
	left: 650px;
	top: 0px;
	float: right;
	color: #F60;
	font-weight: lighter;
	font-size: 18px;
	font-variant: normal;
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	text-align: left;
}
#footer {
	background-color: #999;
	margin: 0px;
	padding: 0px;
	height: 20px;
	width: 900px;
	clear: both;
	left: 7px;
	top: 922px;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
}
#mainContent {
	background-color: #FFF;
	height: 900px;
	width: 780px;
	float: left;
	font-family: Georgia, "Times New Roman", Times, serif;
	font-size: 16px;
	font-style: normal;
	color: #000;
	text-align: left;
}
#header #headerAdvert h1 {
	font-size: 14px;
	font-style: normal;
	font-weight: 100;
	color: #333;
}
a:link {
	color: #F30;
	text-decoration: underline;
}
a:visited {
	color: #F60;
	text-decoration: underline;
}
a:hover {
	color: #03F;
	text-decoration: none;
}
a:active {
	color: #F30;
}
a {
	font-size: 16px;
}
</style>
<script src="../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico" >
<link rel="icon" href="animated_favicon.gif" type="image/gif" >



</head>

<body>
<div id="headerspace"></div>
<div id="wrrapper">

<div id="header">
<div id="headerAdvert">
    <H2 ><font  size="20" >Thekey</font><span id="headerAdvert"><font color="#999999" size="20" >HRMS</font><font color="#999999" size="3" >    Bringing ICT Solution to Your need.</font>  </span> <font color="#999999" size="3" >The key is yours!! </font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../index.php"><img src="../flags/United Kingdom flag.png" width="35" height="25" /></a><a href="../Amharic/index.php"><img border="0" src="../flags/Ethiopiaflag.jpg" alt="Amharic(ETH)" width="35" height="30" /></a><a href="../Dutch/index.php"><img src="../flags/Netherlands-Flag-icon.png" width="35" height="25" /></a></h2>
   <H2><font color="#999999" size="+1" ></font><img src="../img logo &amp; icons/logo.jpg" alt="Rev(3:7)He that hath THE KEY of David, he that openeth, and no man shutteth;  and shutteth, and no man openeth;" width="100" height="40" />
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     <font color="#FF6600" size="6">Human Resource Management System </font>
     </font></h2>
  </div>
    <div id="headerimg">
      <div class="menu_nav">

<!--
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="support.html">Recriument</a>
          </li>
          <li><a href="about.html">Leave</a></li>
          <li><a href="blog.html">Benfite</a></li>
          <li><a href="blog.html">Report</a></li>
          <li><a href="blog.html">Leave</a></li>
        </ul>
        -->
<ul id="MenuBar1" class="MenuBarHorizontal">
<li><a href="#">Home</a>        </li>
        <li><a href="#" class="MenuBarItemSubmenu">Recruitment</a>
          <ul>
            <li><a href="../Recruitment/Recruitment.php">Recruitment Form</a></li>
            <li><a href="../Equipment HandOver/Equipment_HandOver.php">Equipment Handover</a></li>
          </ul>
        </li>
        <li><a href="../Personal Record/Personal_Information_Detail.php">Personal   Info.</a></li>
        <li><a href="#" class="MenuBarItemSubmenu">Leave</a>
          <ul>
            <li><a href="#" class="MenuBarItemSubmenu">Annual Leave</a>
              <ul>
                <li><a href="../Leaves/Annual_Leave_Grant.php">Annual Leave Grant</a></li>
                <li><a href="../Leaves/Annual_Leave_Calculate.php">Run Annual Leave Calculation</a></li>
              </ul>
            </li>
            <li><a href="../Leaves/Funeral_Leave_Grant.php">Funeral Leave</a></li>
            <li><a href="../Leaves/Maternity_Leave_Grant.php">Maternity Leave</a></li>
            <li><a href="../Leaves/Sick_Leave_Grant.php">Sick Leave</a></li>
            <li><a href="../Leaves/Wedding_Leave_Grant.php">Wedding Leave</a></li>
            <li><a href="../Leaves/Back_From_Leave_Report.php">Back to Work Report</a></li>
          </ul>
        </li>
        <li><a class="MenuBarItemSubmenu" href="#">Disciplinary Action</a>
          <ul>
            <li><a href="../Letters/warning Letters/Verbal_Warning.php">Verbal Warning</a>            </li>
            <li><a href="#">Salary Punishment</a></li>
            <li><a href="#" class="MenuBarItemSubmenu">Written Warning</a>
              <ul>
                <li><a href="../Letters/warning Letters/First_Instance_Warning.php">1st Instance Warning</a></li>
                <li><a href="../Letters/warning Letters/Second_Instance_Warning.php">2nd Instance Warning</a></li>
                <li><a href="../Letters/warning Letters/Third_Instance_Warning.php">3rd Instance Warning</a></li>
                <li><a href="../Letters/warning Letters/Last_Warning.php">Last Warning</a></li>
              </ul>
            </li>
            <li><a href="#" class="MenuBarItemSubmenu">Dismissal / Termination</a>
              <ul>
                <li><a href="../Letters/warning Letters/Termination.php">Termination Form</a></li>
                <li><a href="#">Termination Letter</a></li>
              </ul>
            </li>
            <li><a href="javascript: if (confirm('Are You Sure You want to remove Expired Warning?')) { window.location.href='../Letters/warning Letters/Expired_Warning_Remover.php' } else { void('') }; ">Expired Warning Remover</a></li>
            <li><a href="../Letters/warning Letters/Warning_Letters_Viewer.php">Warning Letter Viewer</a></li>
          </ul>
        </li>
        <li><a target="_blank" href="http://localhost/Report/annual_leaverpt.php">Report</a></li>
        <li><a href="#" class="MenuBarItemSubmenu">Contract</a>
          <ul>
            <li><a href="../Letters/Contract Letters/Permanent_Contract_Letter.php">Permanent Employement</a></li>
          </ul>
        </li>
        <li><a href="#" class="MenuBarItemSubmenu">Benefits</a>
          <ul>
            <li><a href="../Medical/Medical_Referral.php">Medical Referral From</a></li>
            <li><a href="../Training/Training.php">Training</a></li>
          </ul>
        </li>
</ul>
<?php echo "<font face=\"Times New Roman, Times, serif\" size=\"+1\"><b>loged in as ".$_SESSION['MM_Username']."</b></font>";  ?>
      </div>
  </div>
  <div id="mainContent">
  
<table border="1" cellpadding="0"  align="center">
  <tr>
  <td>Operation</td>
    <td >Auto_ID</td>
    <td>ID</td>
    <td>FirstName</td>
    <td>MiddelName</td>
    <td>LastName</td>
    <td>Date_Birth</td>
    <td>Place_Birth</td>
    <td>Age</td>
    <td>Sex</td>
    <td>Email</td>
    <td>Date_Employement</td>
    <td>Department</td>
    <td>Position</td>
    <td>Educational_Status</td>
    <td>Salary</td>
    <td>Martial_Status</td>
    <td>Children_number</td>
    <td>Name_Child</td>
    <td>Age_Child</td>
    <td>Sex_Child</td>
    <td>Photo</td>
    <td>Image</td>
    <td>Experience</td>
    <td>HardCopy_Shelf_No</td>
    <td>ModifiedBy</td>
    </tr>
  <?php do { ?>
    <tr><td><a href="PersonalRecordUpdate.php?Auto_ID=<?php echo $row_RSPersonalRecordUpdate['Auto_ID']; ?>"><?php echo "Update </a>";?></a>
      <td><a href="PersonalRecordDetail.php?recordID=<?php echo $row_RSPersonalRecordUpdate['Auto_ID']; ?>"> <?php echo $row_RSPersonalRecordUpdate['Auto_ID']; ?>&nbsp; </td>
      <td><?php echo $row_RSPersonalRecordUpdate['ID']; ?>&nbsp; </td>
      <td><?php echo $row_RSPersonalRecordUpdate['FirstName']; ?>&nbsp; </td>
      <td><?php echo $row_RSPersonalRecordUpdate['MiddelName']; ?>&nbsp; </td>
      <td><?php echo $row_RSPersonalRecordUpdate['LastName']; ?>&nbsp; </td>
      <td><?php echo $row_RSPersonalRecordUpdate['Date_Birth']; ?>&nbsp; </td>
      <td><?php echo $row_RSPersonalRecordUpdate['Place_Birth']; ?>&nbsp; </td>
      <td><?php echo $row_RSPersonalRecordUpdate['Age']; ?>&nbsp; </td>
      <td><?php echo $row_RSPersonalRecordUpdate['Sex']; ?>&nbsp; </td>
      <td><?php echo $row_RSPersonalRecordUpdate['Email']; ?>&nbsp; </td>
      <td><?php echo $row_RSPersonalRecordUpdate['Date_Employement']; ?>&nbsp; </td>
      <td><?php echo $row_RSPersonalRecordUpdate['Department']; ?>&nbsp; </td>
      <td><?php echo $row_RSPersonalRecordUpdate['Position']; ?>&nbsp; </td>
      <td><?php echo $row_RSPersonalRecordUpdate['Educational_Status']; ?>&nbsp; </td>
      <td><?php echo $row_RSPersonalRecordUpdate['Salary']; ?>&nbsp; </td>
      <td><?php echo $row_RSPersonalRecordUpdate['Martial_Status']; ?>&nbsp; </td>
      <td><?php echo $row_RSPersonalRecordUpdate['Children_number']; ?>&nbsp; </td>
      <td><?php echo $row_RSPersonalRecordUpdate['Name_Child']; ?>&nbsp; </td>
      <td><?php echo $row_RSPersonalRecordUpdate['Age_Child']; ?>&nbsp; </td>
      <td><?php echo $row_RSPersonalRecordUpdate['Sex_Child']; ?>&nbsp; </td>
      <td><?php echo $row_RSPersonalRecordUpdate['Photo']; ?>&nbsp; </td>
      <td><?php echo $row_RSPersonalRecordUpdate['Image']; ?>&nbsp; </td>
      <td><?php echo $row_RSPersonalRecordUpdate['Experience']; ?>&nbsp; </td>
      <td><?php echo $row_RSPersonalRecordUpdate['HardCopy_Shelf_No']; ?>&nbsp; </td>
      <td><?php echo $row_RSPersonalRecordUpdate['ModifiedBy']; ?>&nbsp; </td>
      </tr>
    <?php } while ($row_RSPersonalRecordUpdate = mysql_fetch_assoc($RSPersonalRecordUpdate)); ?>
</table>
<br />
<table border="0">
  <tr>
    <td><?php if ($pageNum_RSPersonalRecordUpdate > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_RSPersonalRecordUpdate=%d%s", $currentPage, 0, $queryString_RSPersonalRecordUpdate); ?>">First</a>
      <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_RSPersonalRecordUpdate > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_RSPersonalRecordUpdate=%d%s", $currentPage, max(0, $pageNum_RSPersonalRecordUpdate - 1), $queryString_RSPersonalRecordUpdate); ?>">Previous</a>
      <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_RSPersonalRecordUpdate < $totalPages_RSPersonalRecordUpdate) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_RSPersonalRecordUpdate=%d%s", $currentPage, min($totalPages_RSPersonalRecordUpdate, $pageNum_RSPersonalRecordUpdate + 1), $queryString_RSPersonalRecordUpdate); ?>">Next</a>
      <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_RSPersonalRecordUpdate < $totalPages_RSPersonalRecordUpdate) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_RSPersonalRecordUpdate=%d%s", $currentPage, $totalPages_RSPersonalRecordUpdate, $queryString_RSPersonalRecordUpdate); ?>">Last</a>
      <?php } // Show if not last page ?></td>
    </tr>
    
</table>
Records <?php echo ($startRow_RSPersonalRecordUpdate + 1) ?> to <?php echo min($startRow_RSPersonalRecordUpdate + $maxRows_RSPersonalRecordUpdate, $totalRows_RSPersonalRecordUpdate) ?> of <?php echo $totalRows_RSPersonalRecordUpdate ?>
<blockquote>&nbsp;</blockquote>
  </div>
  <div id="footer">
    <p class="lf">&copy; Copyright ThkeyHRMS.Designed and Developed by <a href="http://www.bluewebtemplates.com">Thekey ICT Soultion</a></p>
  </div>
  
</div>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"../SpryAssets/SpryMenuBarDownHover.gif", imgRight:"../SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</body>
</html>
<?php
mysql_free_result($RSPersonalRecordUpdate);
?>
