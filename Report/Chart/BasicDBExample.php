<?php
//We've included ../Includes/FusionCharts.php and ../Includes/DBConn.php, which contains
//functions to help us easily embed the charts and connect to a database.
include("FusionCharts.php");
//include("Includes/DBConn.php");

$port = $_SERVER['SERVER_PORT'];
if ($port == 80) {
    $port = '';
} else {
    $port = ':' . $port;
}
$appRoot = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
$appPath = $_SERVER['SERVER_NAME'] . $port . '/ThekeyHRMS/';

require_once $appRoot . 'Connections/Config_Connection.php';
require_once $appRoot . 'Classes/Class_Connection.php';
require_once $appRoot . 'Classes/Class_Mysql.php'

?>
<HTML>
<HEAD>
	<TITLE>
	FusionCharts Free - Database Example
	</TITLE>
	<?php
	//You need to include the following JS file, if you intend to embed the chart using JavaScript.
	//Embedding using JavaScripts avoids the "Click to Activate..." issue in Internet Explorer
	//When you make your own charts, make sure that the path to this JS file is correct. Else, you would get JavaScript errors.
	?>	
	<SCRIPT LANGUAGE="Javascript" SRC="FusionCharts.js"></SCRIPT>
	<style type="text/css">
	<!--
	body {
		font-family: Arial, Helvetica, sans-serif;
		font-size: 12px;
	}
	.text{
		font-family: Arial, Helvetica, sans-serif;
		font-size: 12px;
	}
	-->
	</style>
</HEAD>
<BODY>

<CENTER>
<?php
	//In this example, we show how to connect FusionCharts to a database.
	//For the sake of ease, we've used an MySQL databases containing two
	//tables.
		
	// Connect to the DB
        // 
	//$link = connectToDB();

	//$strXML will be used to store the entire XML document generated
	//Generate the graph element
	$strXML = "<graph caption='Factory Output report' subCaption='By Quantity' pieSliceDepth='30' showBorder='1' showNames='1' formatNumberScale='0' numberSuffix=' Units' decimalPrecision='0'>";

	// Fetch all factory records
      // $strQuery = "select * from Factory_Master";
	$strQuery = "select Department from Department";
	$result = mysql_query($strQuery) or die(mysql_error());
    
	//Iterate through each factory
	if ($result) {
		while($ors = mysql_fetch_array($result)) {
			//Now create a second query to get details for this factory
			//$strQuery = "select sum(Quantity) as TotOutput from Factory_Output where FactoryId=" . $ors['FactoryId'];
			$strQuery = "SELECT COUNT(`ID`) AS NO_Employee FROM `employee_personal_record` where `Department`='" . $ors['Department']."'";
                        $result2 = mysql_query($strQuery) or die(mysql_error()); 
			$ors2 = mysql_fetch_array($result2);
			//Generate <set name='..' value='..' />        
			//$strXML .= "<set name='" . $ors['FactoryName'] . "' value='" . $ors2['TotOutput'] . "' />";
                        $strXML .= "<set name='" . $ors['Department'] . "' value='" . $ors2['NO_Employee'] . "' />";
			//free the resultset
			mysql_free_result($result2);
		}
	}
	//mysql_close($link);

	//Finally, close <graph> element
	$strXML .= "</graph>";
	
	//Create the chart - Pie 3D Chart with data from $strXML
	echo renderChart("Charts/FCF_Pie3D.swf", "", $strXML, "Number_Department", 850, 850);
?>
<?php
 

   //Create the chart - Column 3D Chart with data from strXML variable using dataXML method
   echo renderChartHTML("Charts/FCF_Column3D.swf", "", $strXML, "myNext", 600, 300);
?>
    
    
<BR><BR>
<a href='../NoChart.html' target="_blank">Unable to see the chart above?</a>
<H5 ><a href='../default.htm'>&laquo; Back to list of examples</a></h5>
</CENTER>
</BODY>
</HTML>