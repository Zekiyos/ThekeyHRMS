

<?php require_once('../Connections/HRMS.php'); ?>
<?php
require_once('../Classes/Class_AccessLevel.php');
$obj_AccessLevel = new AccessLevel();
echo $obj_AccessLevel->CHK_AccessLevel();
?>

<?php
$maxRows_RSCourtCaseReport = 100;
$pageNum_RSCourtCaseReport = 0;
if (isset($_GET['pageNum_RSCourtCaseReport'])) {
    $pageNum_RSCourtCaseReport = $_GET['pageNum_RSCourtCaseReport'];
}
$startRow_RSCourtCaseReport = $pageNum_RSCourtCaseReport * $maxRows_RSCourtCaseReport;

mysql_select_db($database_HRMS, $HRMS);

//if(isset($_POST['FromDate']) and isset($_POST['ToDate']))


if (( $_POST['ToDate'] ) != "") {

    $query_RSCourtCaseReport = "SELECT * FROM court_case where FileDate >= '" . $_POST['FromDate'] . "' and FileDate <= '" . $_POST['ToDate'] . "' ";
} else
if (isset($_POST['Field']) and isset($_POST['find'])) {
    $filed = $_POST['Field'];
    $find = $_POST['find'];
    $find = strtoupper($find);
    $find = strip_tags($find);

    $query_RSCourtCaseReport = "SELECT * FROM court_case WHERE upper(" . $_POST['Field'] . ") LIKE'%$find%' ";
}
else
    $query_RSCourtCaseReport = "SELECT * FROM court_case";

$query_limit_RSCourtCaseReport = sprintf("%s LIMIT %d, %d", $query_RSCourtCaseReport, $startRow_RSCourtCaseReport, $maxRows_RSCourtCaseReport);
$RSCourtCaseReport = mysql_query($query_limit_RSCourtCaseReport, $HRMS) or die(mysql_error());
$row_RSCourtCaseReport = mysql_fetch_assoc($RSCourtCaseReport);

if (isset($_GET['totalRows_RSCourtCaseReport'])) {
    $totalRows_RSCourtCaseReport = $_GET['totalRows_RSCourtCaseReport'];
} else {
    $all_RSCourtCaseReport = mysql_query($query_RSCourtCaseReport);
    $totalRows_RSCourtCaseReport = mysql_num_rows($all_RSCourtCaseReport);
}
$totalPages_RSCourtCaseReport = ceil($totalRows_RSCourtCaseReport / $maxRows_RSCourtCaseReport) - 1;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title></title>

        <script type="text/javascript" src="../Js/PrintContent.js">
                </head>

                <body>

            <?php require_once('CourtCaseFilter.php'); ?>
            <?php echo "<input type=button  value=\"Print Out\" onclick=\"PrintContent('courtcasereport')\" align=\"right\" >"; ?>

                    <div id="courtcasereport" align="center">
<table align="left" >
<tr>
<td><img  src="../images/Company_logo.JPG" height="100" width="150" /></td>
<td>&nbsp;&nbsp;&nbsp;</td>
<td><?php
            $sqlCS = "SELECT * FROM company_settings";

            $resultCS = mysql_query($sqlCS) or die(mysql_error());

            $rowCS = mysql_fetch_array($resultCS);

            echo "{$rowCS['Company_Name']}<br/>
		      {$rowCS['Company_P.O.BOX']}<br/>
			  {$rowCS['Company_City']}<br/>
			  {$rowCS['Company_Country']}<br/>";
            ?>
                    </td>
<td>&nbsp;&nbsp;&nbsp;</td>
<td>Tel. <?php echo "{$rowCS['Company_Telphone']}<br/>"; ?>
    Fax: <?php echo "{$rowCS['Company_Fax']}<br/>"; ?>
    email: <?php echo "{$rowCS['Company_Email']}<br/>"; ?>
    Website: <?php echo "{$rowCS['Web_Site']}<br/>"; ?></td>
        </tr>
        </table>
        <br />
        <font color=\"#000066\"  size="+2" > <p align="justify">Court Case Report</p></font> <?php /* if (isset($_POST['FromDate']) and isset($_POST['ToDate']) )echo "File Date From ".$_POST['FromDate']." to ".$_POST['ToDate']." "; */ ?> 
<table cellpadding="0" align="center" border="1" bordercolor="#FF6600">
  <tr><font size="+1">
    <td>ID</td>
    <td>FirstName</td>
    <td>MiddelName</td>
    <td>LastName</td>
    <td>FileNumber</td>
    <td>FileDate</td>
    <td>ClaimAmount</td>
    <td>AdvocateName</td>
    <td>AppointmentDate</td>
    <td>Court</td>
    <td>Decision</td>
    <td>Case_Status</td>
            </font>
            </tr>
            <?php do { ?>
                <tr>
                  
                  <td><?php echo "<font size=\"+1\">" . $row_RSCourtCaseReport['ID']; ?></td>
                  <td><?php echo "<font size=\"+1\">" . $row_RSCourtCaseReport['FirstName']; ?></td>
                  <td><?php echo "<font size=\"+1\">" . $row_RSCourtCaseReport['MiddelName']; ?></td>
                  <td><?php echo "<font size=\"+1\">" . $row_RSCourtCaseReport['LastName']; ?></td>
                  
                  <td><?php echo "<font size=\"+1\">" . $row_RSCourtCaseReport['FileNumber']; ?></td>
                  <td><?php echo "<font size=\"+1\">" . $row_RSCourtCaseReport['FileDate']; ?></td>
                  <td><?php echo "<font size=\"+1\">" . "Br." . $row_RSCourtCaseReport['ClaimAmount']; ?></td>
                  <td><?php echo "<font size=\"+1\">" . $row_RSCourtCaseReport['AdvocateName']; ?></td>
                  <td><?php echo "<font size=\"+1\">" . $row_RSCourtCaseReport['AppointmentDate']; ?></td>
                  <td><?php echo "<font size=\"+1\">" . $row_RSCourtCaseReport['Court']; ?></td>
                  <td><?php echo "<font size=\"+1\">" . $row_RSCourtCaseReport['Decision']; ?></td>
                  <td><?php echo"<font size=\"+1\">" . $row_RSCourtCaseReport['Case_Status'] . "</font>"; ?></td>
                          </tr>
            <?php } while ($row_RSCourtCaseReport = mysql_fetch_assoc($RSCourtCaseReport)); ?>
                    </table>
                    </div>
                    </a>
                    </body>
                    </html>
            <?php
            mysql_free_result($RSCourtCaseReport);
            ?>
