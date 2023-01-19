<?php
session_start();
ob_start();
?>
<?php include "phprptinc/ewrcfg4.php"; ?>
<?php include "phprptinc/ewmysql.php"; ?>
<?php include "phprptinc/ewrfn4.php"; ?>
<?php include "phprptinc/ewrusrfn.php"; ?>
<?php

// Global variable for table object
$Tranfered_In = NULL;

//
// Table class for Tranfered In
//
class crTranfered_In {
	var $TableVar = 'Tranfered_In';
	var $TableName = 'Tranfered In';
	var $TableType = 'REPORT';
	var $ShowCurrentFilter = EWRPT_SHOW_CURRENT_FILTER;
	var $FilterPanelOption = EWRPT_FILTER_PANEL_OPTION;
	var $CurrentOrder; // Current order
	var $CurrentOrderType; // Current order type

	// Table caption
	function TableCaption() {
		global $ReportLanguage;
		return $ReportLanguage->TablePhrase($this->TableVar, "TblCaption");
	}

	// Session Group Per Page
	function getGroupPerPage() {
		return @$_SESSION[EWRPT_PROJECT_VAR . "_" . $this->TableVar . "_grpperpage"];
	}

	function setGroupPerPage($v) {
		@$_SESSION[EWRPT_PROJECT_VAR . "_" . $this->TableVar . "_grpperpage"] = $v;
	}

	// Session Start Group
	function getStartGroup() {
		return @$_SESSION[EWRPT_PROJECT_VAR . "_" . $this->TableVar . "_start"];
	}

	function setStartGroup($v) {
		@$_SESSION[EWRPT_PROJECT_VAR . "_" . $this->TableVar . "_start"] = $v;
	}

	// Session Order By
	function getOrderBy() {
		return @$_SESSION[EWRPT_PROJECT_VAR . "_" . $this->TableVar . "_orderby"];
	}

	function setOrderBy($v) {
		@$_SESSION[EWRPT_PROJECT_VAR . "_" . $this->TableVar . "_orderby"] = $v;
	}

//	var $SelectLimit = TRUE;
	var $Auto_ID;
	var $ID;
	var $FirstName;
	var $MiddelName;
	var $LastName;
	var $Position;
	var $FromDepartment;
	var $ToDepartment;
	var $Position_AfterTransfered;
	var $Transfered_Date;
	var $fields = array();
	var $Export; // Export
	var $ExportAll = TRUE;
	var $UseTokenInUrl = EWRPT_USE_TOKEN_IN_URL;
	var $RowType; // Row type
	var $RowTotalType; // Row total type
	var $RowTotalSubType; // Row total subtype
	var $RowGroupLevel; // Row group level
	var $RowAttrs = array(); // Row attributes

	// Reset CSS styles for table object
	function ResetCSS() {
    	$this->RowAttrs["style"] = "";
		$this->RowAttrs["class"] = "";
		foreach ($this->fields as $fld) {
			$fld->ResetCSS();
		}
	}

	//
	// Table class constructor
	//
	function crTranfered_In() {
		global $ReportLanguage;

		// Auto_ID
		$this->Auto_ID = new crField('Tranfered_In', 'Tranfered In', 'x_Auto_ID', 'Auto_ID', '`Auto_ID`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->Auto_ID->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['Auto_ID'] =& $this->Auto_ID;
		$this->Auto_ID->DateFilter = "";
		$this->Auto_ID->SqlSelect = "";
		$this->Auto_ID->SqlOrderBy = "";
		$this->Auto_ID->FldGroupByType = "";
		$this->Auto_ID->FldGroupInt = "0";
		$this->Auto_ID->FldGroupSql = "";

		// ID
		$this->ID = new crField('Tranfered_In', 'Tranfered In', 'x_ID', 'ID', '`ID`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['ID'] =& $this->ID;
		$this->ID->DateFilter = "";
		$this->ID->SqlSelect = "SELECT DISTINCT `ID` FROM " . $this->SqlFrom();
		$this->ID->SqlOrderBy = "`ID`";
		$this->ID->FldGroupByType = "";
		$this->ID->FldGroupInt = "0";
		$this->ID->FldGroupSql = "";

		// FirstName
		$this->FirstName = new crField('Tranfered_In', 'Tranfered In', 'x_FirstName', 'FirstName', '`FirstName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['FirstName'] =& $this->FirstName;
		$this->FirstName->DateFilter = "";
		$this->FirstName->SqlSelect = "SELECT DISTINCT `FirstName` FROM " . $this->SqlFrom();
		$this->FirstName->SqlOrderBy = "`FirstName`";
		$this->FirstName->FldGroupByType = "";
		$this->FirstName->FldGroupInt = "0";
		$this->FirstName->FldGroupSql = "";

		// MiddelName
		$this->MiddelName = new crField('Tranfered_In', 'Tranfered In', 'x_MiddelName', 'MiddelName', '`MiddelName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['MiddelName'] =& $this->MiddelName;
		$this->MiddelName->DateFilter = "";
		$this->MiddelName->SqlSelect = "SELECT DISTINCT `MiddelName` FROM " . $this->SqlFrom();
		$this->MiddelName->SqlOrderBy = "`MiddelName`";
		$this->MiddelName->FldGroupByType = "";
		$this->MiddelName->FldGroupInt = "0";
		$this->MiddelName->FldGroupSql = "";

		// LastName
		$this->LastName = new crField('Tranfered_In', 'Tranfered In', 'x_LastName', 'LastName', '`LastName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['LastName'] =& $this->LastName;
		$this->LastName->DateFilter = "";
		$this->LastName->SqlSelect = "SELECT DISTINCT `LastName` FROM " . $this->SqlFrom();
		$this->LastName->SqlOrderBy = "`LastName`";
		$this->LastName->FldGroupByType = "";
		$this->LastName->FldGroupInt = "0";
		$this->LastName->FldGroupSql = "";

		// Position
		$this->Position = new crField('Tranfered_In', 'Tranfered In', 'x_Position', 'Position', '`Position`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Position'] =& $this->Position;
		$this->Position->DateFilter = "";
		$this->Position->SqlSelect = "SELECT DISTINCT `Position` FROM " . $this->SqlFrom();
		$this->Position->SqlOrderBy = "`Position`";
		$this->Position->FldGroupByType = "";
		$this->Position->FldGroupInt = "0";
		$this->Position->FldGroupSql = "";

		// FromDepartment
		$this->FromDepartment = new crField('Tranfered_In', 'Tranfered In', 'x_FromDepartment', 'FromDepartment', '`FromDepartment`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['FromDepartment'] =& $this->FromDepartment;
		$this->FromDepartment->DateFilter = "";
		$this->FromDepartment->SqlSelect = "SELECT DISTINCT `FromDepartment` FROM " . $this->SqlFrom();
		$this->FromDepartment->SqlOrderBy = "`FromDepartment`";
		$this->FromDepartment->FldGroupByType = "";
		$this->FromDepartment->FldGroupInt = "0";
		$this->FromDepartment->FldGroupSql = "";

		// ToDepartment
		$this->ToDepartment = new crField('Tranfered_In', 'Tranfered In', 'x_ToDepartment', 'ToDepartment', '`ToDepartment`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->ToDepartment->GroupingFieldId = 1;
		$this->fields['ToDepartment'] =& $this->ToDepartment;
		$this->ToDepartment->DateFilter = "";
		$this->ToDepartment->SqlSelect = "SELECT DISTINCT `ToDepartment` FROM " . $this->SqlFrom();
		$this->ToDepartment->SqlOrderBy = "`ToDepartment`";
		$this->ToDepartment->FldGroupByType = "";
		$this->ToDepartment->FldGroupInt = "0";
		$this->ToDepartment->FldGroupSql = "";

		// Position_AfterTransfered
		$this->Position_AfterTransfered = new crField('Tranfered_In', 'Tranfered In', 'x_Position_AfterTransfered', 'Position_AfterTransfered', '`Position_AfterTransfered`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Position_AfterTransfered'] =& $this->Position_AfterTransfered;
		$this->Position_AfterTransfered->DateFilter = "";
		$this->Position_AfterTransfered->SqlSelect = "SELECT DISTINCT `Position_AfterTransfered` FROM " . $this->SqlFrom();
		$this->Position_AfterTransfered->SqlOrderBy = "`Position_AfterTransfered`";
		$this->Position_AfterTransfered->FldGroupByType = "";
		$this->Position_AfterTransfered->FldGroupInt = "0";
		$this->Position_AfterTransfered->FldGroupSql = "";

		// Transfered_Date
		$this->Transfered_Date = new crField('Tranfered_In', 'Tranfered In', 'x_Transfered_Date', 'Transfered_Date', '`Transfered_Date`', 133, EWRPT_DATATYPE_DATE, 5);
		$this->Transfered_Date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateYMD"));
		$this->fields['Transfered_Date'] =& $this->Transfered_Date;
		$this->Transfered_Date->DateFilter = "";
		$this->Transfered_Date->SqlSelect = "SELECT DISTINCT `Transfered_Date` FROM " . $this->SqlFrom();
		$this->Transfered_Date->SqlOrderBy = "`Transfered_Date`";
		$this->Transfered_Date->FldGroupByType = "";
		$this->Transfered_Date->FldGroupInt = "0";
		$this->Transfered_Date->FldGroupSql = "";
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
		} else {
			if ($ofld->GroupingFieldId == 0) $ofld->setSort("");
		}
	}

	// Get Sort SQL
	function SortSql() {
		$sDtlSortSql = "";
		$argrps = array();
		foreach ($this->fields as $fld) {
			if ($fld->getSort() <> "") {
				if ($fld->GroupingFieldId > 0) {
					if ($fld->FldGroupSql <> "")
						$argrps[$fld->GroupingFieldId] = str_replace("%s", $fld->FldExpression, $fld->FldGroupSql) . " " . $fld->getSort();
					else
						$argrps[$fld->GroupingFieldId] = $fld->FldExpression . " " . $fld->getSort();
				} else {
					if ($sDtlSortSql <> "") $sDtlSortSql .= ", ";
					$sDtlSortSql .= $fld->FldExpression . " " . $fld->getSort();
				}
			}
		}
		$sSortSql = "";
		foreach ($argrps as $grp) {
			if ($sSortSql <> "") $sSortSql .= ", ";
			$sSortSql .= $grp;
		}
		if ($sDtlSortSql <> "") {
			if ($sSortSql <> "") $sSortSql .= ",";
			$sSortSql .= $sDtlSortSql;
		}
		return $sSortSql;
	}

	// Table level SQL
	function SqlFrom() { // From
		return "`department_transfer`";
	}

	function SqlSelect() { // Select
		return "SELECT * FROM " . $this->SqlFrom();
	}

	function SqlWhere() { // Where
		return "";
	}

	function SqlGroupBy() { // Group By
		return "";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
		return "`ToDepartment` ASC";
	}

	// Table Level Group SQL
	function SqlFirstGroupField() {
		return "`ToDepartment`";
	}

	function SqlSelectGroup() {
		return "SELECT DISTINCT " . $this->SqlFirstGroupField() . " AS `ToDepartment` FROM " . $this->SqlFrom();
	}

	function SqlOrderByGroup() {
		return "`ToDepartment` ASC";
	}

	function SqlSelectAgg() {
		return "SELECT * FROM " . $this->SqlFrom();
	}

	function SqlAggPfx() {
		return "";
	}

	function SqlAggSfx() {
		return "";
	}

	function SqlSelectCount() {
		return "SELECT COUNT(*) FROM " . $this->SqlFrom();
	}

	// Sort URL
	function SortUrl(&$fld) {
		return "";
	}

	// Row attributes
	function RowAttributes() {
		$sAtt = "";
		foreach ($this->RowAttrs as $k => $v) {
			if (trim($v) <> "")
				$sAtt .= " " . $k . "=\"" . trim($v) . "\"";
		}
		return $sAtt;
	}

	// Field object by fldvar
	function &fields($fldvar) {
		return $this->fields[$fldvar];
	}

	// Table level events
	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}

	// Load Custom Filters event
	function CustomFilters_Load() {

		// Enter your code here	
		// ewrpt_RegisterCustomFilter($this-><Field>, 'LastMonth', 'Last Month', 'GetLastMonthFilter'); // Date example
		// ewrpt_RegisterCustomFilter($this-><Field>, 'StartsWithA', 'Starts With A', 'GetStartsWithAFilter'); // String example

	}

	// Page Filter Validated event
	function Page_FilterValidated() {

		// Example:
		//global $MyTable;
		//$MyTable->MyField1->SearchValue = "your search criteria"; // Search value

	}

	// Chart Rendering event
	function Chart_Rendering(&$chart) {

		// var_dump($chart);
	}

	// Chart Rendered event
	function Chart_Rendered($chart, &$chartxml) {

		//var_dump($chart);
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}
}
?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Create page object
$Tranfered_In_summary = new crTranfered_In_summary();
$Page =& $Tranfered_In_summary;

// Page init
$Tranfered_In_summary->Page_Init();

// Page main
$Tranfered_In_summary->Page_Main();
?>
<?php include "phprptinc/header.php"; ?>
<?php if ($Tranfered_In->Export == "") { ?>
<script type="text/javascript">

// Create page object
var Tranfered_In_summary = new ewrpt_Page("Tranfered_In_summary");

// page properties
Tranfered_In_summary.PageID = "summary"; // page ID
Tranfered_In_summary.FormID = "fTranfered_Insummaryfilter"; // form ID
var EWRPT_PAGE_ID = Tranfered_In_summary.PageID;

// extend page with ValidateForm function
Tranfered_In_summary.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var elm = fobj.sv1_Transfered_Date;
	if (elm && !ewrpt_CheckDate(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Tranfered_In->Transfered_Date->FldErrMsg()) ?>"))
			return false;
	}

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj)) return false;
	return true;
}

// extend page with Form_CustomValidate function
Tranfered_In_summary.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EWRPT_CLIENT_VALIDATE) { ?>
Tranfered_In_summary.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
Tranfered_In_summary.ValidateRequired = false; // no JavaScript validation
<?php } ?>
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php $Tranfered_In_summary->ShowPageHeader(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php $Tranfered_In_summary->ShowMessage(); ?>
<?php if ($Tranfered_In->Export == "" || $Tranfered_In->Export == "print" || $Tranfered_In->Export == "email") { ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php } ?>
<?php if ($Tranfered_In->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
<?php $jsdata = ewrpt_GetJsData($Tranfered_In->ToDepartment, $Tranfered_In->ToDepartment->FldType); ?>
ewrpt_CreatePopup("Tranfered_In_ToDepartment", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Tranfered_In->ID, $Tranfered_In->ID->FldType); ?>
ewrpt_CreatePopup("Tranfered_In_ID", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Tranfered_In->FirstName, $Tranfered_In->FirstName->FldType); ?>
ewrpt_CreatePopup("Tranfered_In_FirstName", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Tranfered_In->MiddelName, $Tranfered_In->MiddelName->FldType); ?>
ewrpt_CreatePopup("Tranfered_In_MiddelName", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Tranfered_In->LastName, $Tranfered_In->LastName->FldType); ?>
ewrpt_CreatePopup("Tranfered_In_LastName", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Tranfered_In->Position, $Tranfered_In->Position->FldType); ?>
ewrpt_CreatePopup("Tranfered_In_Position", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Tranfered_In->FromDepartment, $Tranfered_In->FromDepartment->FldType); ?>
ewrpt_CreatePopup("Tranfered_In_FromDepartment", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Tranfered_In->Position_AfterTransfered, $Tranfered_In->Position_AfterTransfered->FldType); ?>
ewrpt_CreatePopup("Tranfered_In_Position_AfterTransfered", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Tranfered_In->Transfered_Date, $Tranfered_In->Transfered_Date->FldType); ?>
ewrpt_CreatePopup("Tranfered_In_Transfered_Date", [<?php echo $jsdata ?>]);
</script>
<div id="Tranfered_In_ToDepartment_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Tranfered_In_ID_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Tranfered_In_FirstName_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Tranfered_In_MiddelName_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Tranfered_In_LastName_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Tranfered_In_Position_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Tranfered_In_FromDepartment_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Tranfered_In_Position_AfterTransfered_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Tranfered_In_Transfered_Date_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<?php } ?>
<?php if ($Tranfered_In->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<?php if ($Tranfered_In->Export == "" || $Tranfered_In->Export == "print" || $Tranfered_In->Export == "email") { ?>
<?php } ?>
<?php echo $Tranfered_In->TableCaption() ?>
<?php if ($Tranfered_In->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $Tranfered_In_summary->ExportPrintUrl ?>"><?php echo $ReportLanguage->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $Tranfered_In_summary->ExportExcelUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $Tranfered_In_summary->ExportWordUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToWord") ?></a>
<?php if ($Tranfered_In_summary->FilterApplied) { ?>
&nbsp;&nbsp;<a href="Tranfered_Insmry.php?cmd=reset"><?php echo $ReportLanguage->Phrase("ResetAllFilter") ?></a>
<?php } ?>
<?php } ?>
<br /><br />
<?php if ($Tranfered_In->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($Tranfered_In->Export == "" || $Tranfered_In->Export == "print" || $Tranfered_In->Export == "email") { ?>
<?php } ?>
<?php if ($Tranfered_In->Export == "") { ?>
	</div></td>
	<!-- Left Container (End) -->
	<!-- Center Container - Report (Begin) -->
	<td style="vertical-align: top;" class="ewPadding"><div id="ewCenter" class="phpreportmaker">
	<!-- center slot -->
<?php } ?>
<!-- summary report starts -->
<div id="report_summary">
<?php if ($Tranfered_In->Export == "") { ?>
<?php
if ($Tranfered_In->FilterPanelOption == 2 || ($Tranfered_In->FilterPanelOption == 3 && $Tranfered_In_summary->FilterApplied) || $Tranfered_In_summary->Filter == "0=101") {
	$sButtonImage = "phprptimages/collapse.gif";
	$sDivDisplay = "";
} else {
	$sButtonImage = "phprptimages/expand.gif";
	$sDivDisplay = " style=\"display: none;\"";
}
?>
<a href="javascript:ewrpt_ToggleFilterPanel();" style="text-decoration: none;"><img id="ewrptToggleFilterImg" src="<?php echo $sButtonImage ?>" alt="" width="9" height="9" border="0"></a><span class="phpreportmaker">&nbsp;<?php echo $ReportLanguage->Phrase("Filters") ?></span><br /><br />
<div id="ewrptExtFilterPanel"<?php echo $sDivDisplay ?>>
<!-- Search form (begin) -->
<form name="fTranfered_Insummaryfilter" id="fTranfered_Insummaryfilter" action="Tranfered_Insmry.php" class="ewForm" onsubmit="return Tranfered_In_summary.ValidateForm(this);">
<table class="ewRptExtFilter">
	<tr>
		<td><span class="phpreportmaker"><?php echo $Tranfered_In->ID->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_ID" id="so1_ID" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_ID" id="sv1_ID" size="30" maxlength="7" value="<?php echo ewrpt_HtmlEncode($Tranfered_In->ID->SearchValue) ?>"<?php echo ($Tranfered_In_summary->ClearExtFilter == 'Tranfered_In_ID') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Tranfered_In->FirstName->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_FirstName" id="so1_FirstName" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_FirstName" id="sv1_FirstName" size="30" maxlength="20" value="<?php echo ewrpt_HtmlEncode($Tranfered_In->FirstName->SearchValue) ?>"<?php echo ($Tranfered_In_summary->ClearExtFilter == 'Tranfered_In_FirstName') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Tranfered_In->MiddelName->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_MiddelName" id="so1_MiddelName" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_MiddelName" id="sv1_MiddelName" size="30" maxlength="20" value="<?php echo ewrpt_HtmlEncode($Tranfered_In->MiddelName->SearchValue) ?>"<?php echo ($Tranfered_In_summary->ClearExtFilter == 'Tranfered_In_MiddelName') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Tranfered_In->LastName->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_LastName" id="so1_LastName" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_LastName" id="sv1_LastName" size="30" maxlength="20" value="<?php echo ewrpt_HtmlEncode($Tranfered_In->LastName->SearchValue) ?>"<?php echo ($Tranfered_In_summary->ClearExtFilter == 'Tranfered_In_LastName') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Tranfered_In->Position->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_Position" id="so1_Position" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_Position" id="sv1_Position" size="30" maxlength="40" value="<?php echo ewrpt_HtmlEncode($Tranfered_In->Position->SearchValue) ?>"<?php echo ($Tranfered_In_summary->ClearExtFilter == 'Tranfered_In_Position') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Tranfered_In->FromDepartment->FldCaption() ?></span></td>
		<td></td>
		<td colspan="4"><span class="ewRptSearchOpr">
		<select name="sv_FromDepartment[]" id="sv_FromDepartment[]" multiple<?php echo ($Tranfered_In_summary->ClearExtFilter == 'Tranfered_In_FromDepartment') ? " class=\"ewInputCleared\"" : "" ?>>
		<option value="<?php echo EWRPT_ALL_VALUE; ?>"<?php if (ewrpt_MatchedFilterValue($Tranfered_In->FromDepartment->DropDownValue, EWRPT_ALL_VALUE)) echo " selected=\"selected\""; ?>><?php echo $ReportLanguage->Phrase("SelectAll"); ?></option>
<?php

// Popup filter
$cntf = is_array($Tranfered_In->FromDepartment->CustomFilters) ? count($Tranfered_In->FromDepartment->CustomFilters) : 0;
$cntd = is_array($Tranfered_In->FromDepartment->DropDownList) ? count($Tranfered_In->FromDepartment->DropDownList) : 0;
$totcnt = $cntf + $cntd;
$wrkcnt = 0;
	for ($i = 0; $i < $cntf; $i++) {
		if ($Tranfered_In->FromDepartment->CustomFilters[$i]->FldName == 'FromDepartment') {
?>
		<option value="<?php echo "@@" . $Tranfered_In->FromDepartment->CustomFilters[$i]->FilterName ?>"<?php if (ewrpt_MatchedFilterValue($Tranfered_In->FromDepartment->DropDownValue, "@@" . $Tranfered_In->FromDepartment->CustomFilters[$i]->FilterName)) echo " selected=\"selected\"" ?>><?php echo $Tranfered_In->FromDepartment->CustomFilters[$i]->DisplayName ?></option>
<?php
		}
		$wrkcnt += 1;
	}

//}
	for ($i = 0; $i < $cntd; $i++) {
?>
		<option value="<?php echo $Tranfered_In->FromDepartment->DropDownList[$i] ?>"<?php if (ewrpt_MatchedFilterValue($Tranfered_In->FromDepartment->DropDownValue, $Tranfered_In->FromDepartment->DropDownList[$i])) echo " selected=\"selected\"" ?>><?php echo ewrpt_DropDownDisplayValue($Tranfered_In->FromDepartment->DropDownList[$i], "", 0) ?></option>
<?php
		$wrkcnt += 1;
	}

//}
?>
		</select>
		</span></td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Tranfered_In->ToDepartment->FldCaption() ?></span></td>
		<td></td>
		<td colspan="4"><span class="ewRptSearchOpr">
		<select name="sv_ToDepartment[]" id="sv_ToDepartment[]" multiple<?php echo ($Tranfered_In_summary->ClearExtFilter == 'Tranfered_In_ToDepartment') ? " class=\"ewInputCleared\"" : "" ?>>
		<option value="<?php echo EWRPT_ALL_VALUE; ?>"<?php if (ewrpt_MatchedFilterValue($Tranfered_In->ToDepartment->DropDownValue, EWRPT_ALL_VALUE)) echo " selected=\"selected\""; ?>><?php echo $ReportLanguage->Phrase("SelectAll"); ?></option>
<?php

// Popup filter
$cntf = is_array($Tranfered_In->ToDepartment->CustomFilters) ? count($Tranfered_In->ToDepartment->CustomFilters) : 0;
$cntd = is_array($Tranfered_In->ToDepartment->DropDownList) ? count($Tranfered_In->ToDepartment->DropDownList) : 0;
$totcnt = $cntf + $cntd;
$wrkcnt = 0;
	for ($i = 0; $i < $cntf; $i++) {
		if ($Tranfered_In->ToDepartment->CustomFilters[$i]->FldName == 'ToDepartment') {
?>
		<option value="<?php echo "@@" . $Tranfered_In->ToDepartment->CustomFilters[$i]->FilterName ?>"<?php if (ewrpt_MatchedFilterValue($Tranfered_In->ToDepartment->DropDownValue, "@@" . $Tranfered_In->ToDepartment->CustomFilters[$i]->FilterName)) echo " selected=\"selected\"" ?>><?php echo $Tranfered_In->ToDepartment->CustomFilters[$i]->DisplayName ?></option>
<?php
		}
		$wrkcnt += 1;
	}

//}
	for ($i = 0; $i < $cntd; $i++) {
?>
		<option value="<?php echo $Tranfered_In->ToDepartment->DropDownList[$i] ?>"<?php if (ewrpt_MatchedFilterValue($Tranfered_In->ToDepartment->DropDownValue, $Tranfered_In->ToDepartment->DropDownList[$i])) echo " selected=\"selected\"" ?>><?php echo ewrpt_DropDownDisplayValue($Tranfered_In->ToDepartment->DropDownList[$i], "", 0) ?></option>
<?php
		$wrkcnt += 1;
	}

//}
?>
		</select>
		</span></td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Tranfered_In->Position_AfterTransfered->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_Position_AfterTransfered" id="so1_Position_AfterTransfered" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_Position_AfterTransfered" id="sv1_Position_AfterTransfered" size="30" maxlength="50" value="<?php echo ewrpt_HtmlEncode($Tranfered_In->Position_AfterTransfered->SearchValue) ?>"<?php echo ($Tranfered_In_summary->ClearExtFilter == 'Tranfered_In_Position_AfterTransfered') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Tranfered_In->Transfered_Date->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><select name="so1_Transfered_Date" id="so1_Transfered_Date" onchange="ewrpt_SrchOprChanged('so1_Transfered_Date')"><option value="="<?php if ($Tranfered_In->Transfered_Date->SearchOperator == "=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("="); ?></option><option value="<>"<?php if ($Tranfered_In->Transfered_Date->SearchOperator == "<>") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<>"); ?></option><option value="<"<?php if ($Tranfered_In->Transfered_Date->SearchOperator == "<") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<"); ?></option><option value="<="<?php if ($Tranfered_In->Transfered_Date->SearchOperator == "<=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<="); ?></option><option value=">"<?php if ($Tranfered_In->Transfered_Date->SearchOperator == ">") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase(">"); ?></option><option value=">="<?php if ($Tranfered_In->Transfered_Date->SearchOperator == ">=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase(">="); ?></option><option value="BETWEEN"<?php if ($Tranfered_In->Transfered_Date->SearchOperator == "BETWEEN") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("BETWEEN"); ?></option></select></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_Transfered_Date" id="sv1_Transfered_Date" value="<?php echo ewrpt_HtmlEncode($Tranfered_In->Transfered_Date->SearchValue) ?>"<?php echo ($Tranfered_In_summary->ClearExtFilter == 'Tranfered_In_Transfered_Date') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
				<td><span class="ewRptSearchOpr" style="display: none" id="btw1_Transfered_Date" name="btw1_Transfered_Date">&nbsp;<?php echo $ReportLanguage->Phrase("AND") ?>&nbsp;</span></td>
				<td><span class="phpreportmaker" style="display: none" id="btw1_Transfered_Date" name="btw1_Transfered_Date">
<input type="text" name="sv2_Transfered_Date" id="sv2_Transfered_Date" value="<?php echo ewrpt_HtmlEncode($Tranfered_In->Transfered_Date->SearchValue2) ?>"<?php echo ($Tranfered_In_summary->ClearExtFilter == 'Tranfered_In_Transfered_Date') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
</table>
<table class="ewRptExtFilter">
	<tr>
		<td><span class="phpreportmaker">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo $ReportLanguage->Phrase("Search") ?>">&nbsp;
			<input type="Reset" name="Reset" id="Reset" value="<?php echo $ReportLanguage->Phrase("Reset") ?>">&nbsp;
		</span></td>
	</tr>
</table>
</form>
<script type="text/javascript">
ewrpt_SrchOprChanged('so1_Transfered_Date');
</script>
<!-- Search form (end) -->
</div>
<br />
<?php } ?>
<?php if ($Tranfered_In->ShowCurrentFilter) { ?>
<div id="ewrptFilterList">
<?php $Tranfered_In_summary->ShowFilterList() ?>
</div>
<br />
<?php } ?>
<table class="ewGrid" cellspacing="0"><tr>
	<td class="ewGridContent">
<?php if ($Tranfered_In->Export == "") { ?>
<div class="ewGridUpperPanel">
<form action="Tranfered_Insmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($Tranfered_In_summary->StartGrp, $Tranfered_In_summary->DisplayGrps, $Tranfered_In_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="Tranfered_Insmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="Tranfered_Insmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="Tranfered_Insmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="Tranfered_Insmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/lastdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpreportmaker">&nbsp;<?php echo $ReportLanguage->Phrase("of") ?> <?php echo $Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Record") ?> <?php echo $Pager->FromIndex ?> <?php echo $ReportLanguage->Phrase("To") ?> <?php echo $Pager->ToIndex ?> <?php echo $ReportLanguage->Phrase("Of") ?> <?php echo $Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Tranfered_In_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($Tranfered_In_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($Tranfered_In_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($Tranfered_In_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($Tranfered_In_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($Tranfered_In_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($Tranfered_In_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($Tranfered_In_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($Tranfered_In_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($Tranfered_In_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($Tranfered_In->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
</select>
		</span></td>
<?php } ?>
	</tr>
</table>
</form>
</div>
<?php } ?>
<!-- Report Grid (Begin) -->
<div class="ewGridMiddlePanel">
<table class="ewTable ewTableSeparate" cellspacing="0">
<?php

// Set the last group to display if not export all
if ($Tranfered_In->ExportAll && $Tranfered_In->Export <> "") {
	$Tranfered_In_summary->StopGrp = $Tranfered_In_summary->TotalGrps;
} else {
	$Tranfered_In_summary->StopGrp = $Tranfered_In_summary->StartGrp + $Tranfered_In_summary->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($Tranfered_In_summary->StopGrp) > intval($Tranfered_In_summary->TotalGrps))
	$Tranfered_In_summary->StopGrp = $Tranfered_In_summary->TotalGrps;
$Tranfered_In_summary->RecCount = 0;

// Get first row
if ($Tranfered_In_summary->TotalGrps > 0) {
	$Tranfered_In_summary->GetGrpRow(1);
	$Tranfered_In_summary->GrpCount = 1;
}
while (($rsgrp && !$rsgrp->EOF && $Tranfered_In_summary->GrpCount <= $Tranfered_In_summary->DisplayGrps) || $Tranfered_In_summary->ShowFirstHeader) {

	// Show header
	if ($Tranfered_In_summary->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Tranfered_In->SortUrl($Tranfered_In->ToDepartment) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Tranfered_In->ToDepartment->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Tranfered_In->SortUrl($Tranfered_In->ToDepartment) ?>',0);"><?php echo $Tranfered_In->ToDepartment->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Tranfered_In->ToDepartment->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Tranfered_In->ToDepartment->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Tranfered_In->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Tranfered_In_ToDepartment', false, '<?php echo $Tranfered_In->ToDepartment->RangeFrom; ?>', '<?php echo $Tranfered_In->ToDepartment->RangeTo; ?>');return false;" name="x_ToDepartment<?php echo $Tranfered_In_summary->Cnt[0][0]; ?>" id="x_ToDepartment<?php echo $Tranfered_In_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Tranfered_In->SortUrl($Tranfered_In->ID) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Tranfered_In->ID->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Tranfered_In->SortUrl($Tranfered_In->ID) ?>',0);"><?php echo $Tranfered_In->ID->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Tranfered_In->ID->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Tranfered_In->ID->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Tranfered_In->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Tranfered_In_ID', false, '<?php echo $Tranfered_In->ID->RangeFrom; ?>', '<?php echo $Tranfered_In->ID->RangeTo; ?>');return false;" name="x_ID<?php echo $Tranfered_In_summary->Cnt[0][0]; ?>" id="x_ID<?php echo $Tranfered_In_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Tranfered_In->SortUrl($Tranfered_In->FirstName) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Tranfered_In->FirstName->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Tranfered_In->SortUrl($Tranfered_In->FirstName) ?>',0);"><?php echo $Tranfered_In->FirstName->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Tranfered_In->FirstName->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Tranfered_In->FirstName->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Tranfered_In->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Tranfered_In_FirstName', false, '<?php echo $Tranfered_In->FirstName->RangeFrom; ?>', '<?php echo $Tranfered_In->FirstName->RangeTo; ?>');return false;" name="x_FirstName<?php echo $Tranfered_In_summary->Cnt[0][0]; ?>" id="x_FirstName<?php echo $Tranfered_In_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Tranfered_In->SortUrl($Tranfered_In->MiddelName) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Tranfered_In->MiddelName->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Tranfered_In->SortUrl($Tranfered_In->MiddelName) ?>',0);"><?php echo $Tranfered_In->MiddelName->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Tranfered_In->MiddelName->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Tranfered_In->MiddelName->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Tranfered_In->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Tranfered_In_MiddelName', false, '<?php echo $Tranfered_In->MiddelName->RangeFrom; ?>', '<?php echo $Tranfered_In->MiddelName->RangeTo; ?>');return false;" name="x_MiddelName<?php echo $Tranfered_In_summary->Cnt[0][0]; ?>" id="x_MiddelName<?php echo $Tranfered_In_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Tranfered_In->SortUrl($Tranfered_In->LastName) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Tranfered_In->LastName->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Tranfered_In->SortUrl($Tranfered_In->LastName) ?>',0);"><?php echo $Tranfered_In->LastName->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Tranfered_In->LastName->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Tranfered_In->LastName->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Tranfered_In->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Tranfered_In_LastName', false, '<?php echo $Tranfered_In->LastName->RangeFrom; ?>', '<?php echo $Tranfered_In->LastName->RangeTo; ?>');return false;" name="x_LastName<?php echo $Tranfered_In_summary->Cnt[0][0]; ?>" id="x_LastName<?php echo $Tranfered_In_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Tranfered_In->SortUrl($Tranfered_In->Position) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Tranfered_In->Position->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Tranfered_In->SortUrl($Tranfered_In->Position) ?>',0);"><?php echo $Tranfered_In->Position->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Tranfered_In->Position->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Tranfered_In->Position->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Tranfered_In->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Tranfered_In_Position', false, '<?php echo $Tranfered_In->Position->RangeFrom; ?>', '<?php echo $Tranfered_In->Position->RangeTo; ?>');return false;" name="x_Position<?php echo $Tranfered_In_summary->Cnt[0][0]; ?>" id="x_Position<?php echo $Tranfered_In_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Tranfered_In->SortUrl($Tranfered_In->FromDepartment) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Tranfered_In->FromDepartment->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Tranfered_In->SortUrl($Tranfered_In->FromDepartment) ?>',0);"><?php echo $Tranfered_In->FromDepartment->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Tranfered_In->FromDepartment->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Tranfered_In->FromDepartment->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Tranfered_In->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Tranfered_In_FromDepartment', false, '<?php echo $Tranfered_In->FromDepartment->RangeFrom; ?>', '<?php echo $Tranfered_In->FromDepartment->RangeTo; ?>');return false;" name="x_FromDepartment<?php echo $Tranfered_In_summary->Cnt[0][0]; ?>" id="x_FromDepartment<?php echo $Tranfered_In_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Tranfered_In->SortUrl($Tranfered_In->Position_AfterTransfered) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Tranfered_In->Position_AfterTransfered->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Tranfered_In->SortUrl($Tranfered_In->Position_AfterTransfered) ?>',0);"><?php echo $Tranfered_In->Position_AfterTransfered->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Tranfered_In->Position_AfterTransfered->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Tranfered_In->Position_AfterTransfered->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Tranfered_In->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Tranfered_In_Position_AfterTransfered', false, '<?php echo $Tranfered_In->Position_AfterTransfered->RangeFrom; ?>', '<?php echo $Tranfered_In->Position_AfterTransfered->RangeTo; ?>');return false;" name="x_Position_AfterTransfered<?php echo $Tranfered_In_summary->Cnt[0][0]; ?>" id="x_Position_AfterTransfered<?php echo $Tranfered_In_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Tranfered_In->SortUrl($Tranfered_In->Transfered_Date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Tranfered_In->Transfered_Date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Tranfered_In->SortUrl($Tranfered_In->Transfered_Date) ?>',0);"><?php echo $Tranfered_In->Transfered_Date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Tranfered_In->Transfered_Date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Tranfered_In->Transfered_Date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Tranfered_In->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Tranfered_In_Transfered_Date', false, '<?php echo $Tranfered_In->Transfered_Date->RangeFrom; ?>', '<?php echo $Tranfered_In->Transfered_Date->RangeTo; ?>');return false;" name="x_Transfered_Date<?php echo $Tranfered_In_summary->Cnt[0][0]; ?>" id="x_Transfered_Date<?php echo $Tranfered_In_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$Tranfered_In_summary->ShowFirstHeader = FALSE;
	}

	// Build detail SQL
	$sWhere = ewrpt_DetailFilterSQL($Tranfered_In->ToDepartment, $Tranfered_In->SqlFirstGroupField(), $Tranfered_In->ToDepartment->GroupValue());
	if ($Tranfered_In_summary->Filter != "")
		$sWhere = "($Tranfered_In_summary->Filter) AND ($sWhere)";
	$sSql = ewrpt_BuildReportSql($Tranfered_In->SqlSelect(), $Tranfered_In->SqlWhere(), $Tranfered_In->SqlGroupBy(), $Tranfered_In->SqlHaving(), $Tranfered_In->SqlOrderBy(), $sWhere, $Tranfered_In_summary->Sort);
	$rs = $conn->Execute($sSql);
	$rsdtlcnt = ($rs) ? $rs->RecordCount() : 0;
	if ($rsdtlcnt > 0)
		$Tranfered_In_summary->GetRow(1);
	while ($rs && !$rs->EOF) { // Loop detail records
		$Tranfered_In_summary->RecCount++;

		// Render detail row
		$Tranfered_In->ResetCSS();
		$Tranfered_In->RowType = EWRPT_ROWTYPE_DETAIL;
		$Tranfered_In_summary->RenderRow();
?>
	<tr<?php echo $Tranfered_In->RowAttributes(); ?>>
		<td<?php echo $Tranfered_In->ToDepartment->CellAttributes(); ?>><div<?php echo $Tranfered_In->ToDepartment->ViewAttributes(); ?>><?php echo $Tranfered_In->ToDepartment->GroupViewValue; ?></div></td>
		<td<?php echo $Tranfered_In->ID->CellAttributes() ?>>
<div<?php echo $Tranfered_In->ID->ViewAttributes(); ?>><?php echo $Tranfered_In->ID->ListViewValue(); ?></div>
</td>
		<td<?php echo $Tranfered_In->FirstName->CellAttributes() ?>>
<div<?php echo $Tranfered_In->FirstName->ViewAttributes(); ?>><?php echo $Tranfered_In->FirstName->ListViewValue(); ?></div>
</td>
		<td<?php echo $Tranfered_In->MiddelName->CellAttributes() ?>>
<div<?php echo $Tranfered_In->MiddelName->ViewAttributes(); ?>><?php echo $Tranfered_In->MiddelName->ListViewValue(); ?></div>
</td>
		<td<?php echo $Tranfered_In->LastName->CellAttributes() ?>>
<div<?php echo $Tranfered_In->LastName->ViewAttributes(); ?>><?php echo $Tranfered_In->LastName->ListViewValue(); ?></div>
</td>
		<td<?php echo $Tranfered_In->Position->CellAttributes() ?>>
<div<?php echo $Tranfered_In->Position->ViewAttributes(); ?>><?php echo $Tranfered_In->Position->ListViewValue(); ?></div>
</td>
		<td<?php echo $Tranfered_In->FromDepartment->CellAttributes() ?>>
<div<?php echo $Tranfered_In->FromDepartment->ViewAttributes(); ?>><?php echo $Tranfered_In->FromDepartment->ListViewValue(); ?></div>
</td>
		<td<?php echo $Tranfered_In->Position_AfterTransfered->CellAttributes() ?>>
<div<?php echo $Tranfered_In->Position_AfterTransfered->ViewAttributes(); ?>><?php echo $Tranfered_In->Position_AfterTransfered->ListViewValue(); ?></div>
</td>
		<td<?php echo $Tranfered_In->Transfered_Date->CellAttributes() ?>>
<div<?php echo $Tranfered_In->Transfered_Date->ViewAttributes(); ?>><?php echo $Tranfered_In->Transfered_Date->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$Tranfered_In_summary->AccumulateSummary();

		// Get next record
		$Tranfered_In_summary->GetRow(2);

		// Show Footers
?>
<?php
	} // End detail records loop
?>
<?php
			$Tranfered_In->ResetCSS();
			$Tranfered_In->RowType = EWRPT_ROWTYPE_TOTAL;
			$Tranfered_In->RowTotalType = EWRPT_ROWTOTAL_GROUP;
			$Tranfered_In->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
			$Tranfered_In->RowGroupLevel = 1;
			$Tranfered_In_summary->RenderRow();
?>
	<tr<?php echo $Tranfered_In->RowAttributes(); ?>>
		<td colspan="9"<?php echo $Tranfered_In->ToDepartment->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSumHead") ?> <?php echo $Tranfered_In->ToDepartment->FldCaption() ?>: <?php echo $Tranfered_In->ToDepartment->GroupViewValue; ?> (<?php echo ewrpt_FormatNumber($Tranfered_In_summary->Cnt[1][0],0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php

			// Reset level 1 summary
			$Tranfered_In_summary->ResetLevelSummary(1);
?>
<?php

	// Next group
	$Tranfered_In_summary->GetGrpRow(2);
	$Tranfered_In_summary->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
<?php
if ($Tranfered_In_summary->TotalGrps > 0) {
	$Tranfered_In->ResetCSS();
	$Tranfered_In->RowType = EWRPT_ROWTYPE_TOTAL;
	$Tranfered_In->RowTotalType = EWRPT_ROWTOTAL_GRAND;
	$Tranfered_In->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
	$Tranfered_In->RowAttrs["class"] = "ewRptGrandSummary";
	$Tranfered_In_summary->RenderRow();
?>
	<!-- tr><td colspan="9"><span class="phpreportmaker">&nbsp;<br /></span></td></tr -->
	<tr<?php echo $Tranfered_In->RowAttributes(); ?>><td colspan="9"><?php echo $ReportLanguage->Phrase("RptGrandTotal") ?> (<?php echo ewrpt_FormatNumber($Tranfered_In_summary->TotCount,0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php } ?>
	</tfoot>
</table>
</div>
<?php if ($Tranfered_In_summary->TotalGrps > 0) { ?>
<?php if ($Tranfered_In->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="Tranfered_Insmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($Tranfered_In_summary->StartGrp, $Tranfered_In_summary->DisplayGrps, $Tranfered_In_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="Tranfered_Insmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="Tranfered_Insmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="Tranfered_Insmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="Tranfered_Insmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/lastdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpreportmaker">&nbsp;<?php echo $ReportLanguage->Phrase("of") ?> <?php echo $Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Record") ?> <?php echo $Pager->FromIndex ?> <?php echo $ReportLanguage->Phrase("To") ?> <?php echo $Pager->ToIndex ?> <?php echo $ReportLanguage->Phrase("Of") ?> <?php echo $Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Tranfered_In_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($Tranfered_In_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($Tranfered_In_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($Tranfered_In_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($Tranfered_In_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($Tranfered_In_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($Tranfered_In_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($Tranfered_In_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($Tranfered_In_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($Tranfered_In_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($Tranfered_In->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
</select>
		</span></td>
<?php } ?>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
</div>
<!-- Summary Report Ends -->
<?php if ($Tranfered_In->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($Tranfered_In->Export == "" || $Tranfered_In->Export == "print" || $Tranfered_In->Export == "email") { ?>
<?php } ?>
<?php if ($Tranfered_In->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($Tranfered_In->Export == "" || $Tranfered_In->Export == "print" || $Tranfered_In->Export == "email") { ?>
<?php } ?>
<?php if ($Tranfered_In->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $Tranfered_In_summary->ShowPageFooter(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($Tranfered_In->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "phprptinc/footer.php"; ?>
<?php
$Tranfered_In_summary->Page_Terminate();
?>
<?php

//
// Page class
//
class crTranfered_In_summary {

	// Page ID
	var $PageID = 'summary';

	// Table name
	var $TableName = 'Tranfered In';

	// Page object name
	var $PageObjName = 'Tranfered_In_summary';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $Tranfered_In;
		if ($Tranfered_In->UseTokenInUrl) $PageUrl .= "t=" . $Tranfered_In->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Export URLs
	var $ExportPrintUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EWRPT_SESSION_MESSAGE];
	}

	function setMessage($v) {
		if (@$_SESSION[EWRPT_SESSION_MESSAGE] <> "") { // Append
			$_SESSION[EWRPT_SESSION_MESSAGE] .= "<br />" . $v;
		} else {
			$_SESSION[EWRPT_SESSION_MESSAGE] = $v;
		}
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage);
		if ($sMessage <> "") { // Message in Session, display
			echo "<p><span class=\"ewMessage\">" . $sMessage . "</span></p>";
			$_SESSION[EWRPT_SESSION_MESSAGE] = ""; // Clear message in Session
		}
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p><span class=\"phpreportmaker\">" . $sHeader . "</span></p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Fotoer exists, display
			echo "<p><span class=\"phpreportmaker\">" . $sFooter . "</span></p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $Tranfered_In;
		if ($Tranfered_In->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($Tranfered_In->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($Tranfered_In->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crTranfered_In_summary() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (Tranfered_In)
		$GLOBALS["Tranfered_In"] = new crTranfered_In();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'summary', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'Tranfered In', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new crTimer();

		// Open connection
		$conn = ewrpt_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $ReportLanguage, $Security;
		global $Tranfered_In;

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$Tranfered_In->Export = $_GET["export"];
	}
	$gsExport = $Tranfered_In->Export; // Get export parameter, used in header
	$gsExportFile = $Tranfered_In->TableVar; // Get export file, used in header
	if ($Tranfered_In->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($Tranfered_In->Export == "word") {
		header('Content-Type: application/vnd.ms-word');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;
		global $ReportLanguage;
		global $Tranfered_In;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($Tranfered_In->Export == "email") {
			$sContent = ob_get_contents();
			$this->ExportEmail($sContent);
			ob_end_clean();

			 // Close connection
			$conn->Close();
			header("Location: " . ewrpt_CurrentPage());
			exit();
		}

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		if ($url <> "") {
			if (!EWRPT_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}

	// Initialize common variables
	// Paging variables

	var $RecCount = 0; // Record count
	var $StartGrp = 0; // Start group
	var $StopGrp = 0; // Stop group
	var $TotalGrps = 0; // Total groups
	var $GrpCount = 0; // Group count
	var $DisplayGrps = 3; // Groups per page
	var $GrpRange = 10;
	var $Sort = "";
	var $Filter = "";
	var $UserIDFilter = "";

	// Clear field for ext filter
	var $ClearExtFilter = "";
	var $FilterApplied;
	var $ShowFirstHeader;
	var $Cnt, $Col, $Val, $Smry, $Mn, $Mx, $GrandSmry, $GrandMn, $GrandMx;
	var $TotCount;

	//
	// Page main
	//
	function Page_Main() {
		global $Tranfered_In;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 9;
		$nGrps = 2;
		$this->Val = ewrpt_InitArray($nDtls, 0);
		$this->Cnt = ewrpt_Init2DArray($nGrps, $nDtls, 0);
		$this->Smry = ewrpt_Init2DArray($nGrps, $nDtls, 0);
		$this->Mn = ewrpt_Init2DArray($nGrps, $nDtls, NULL);
		$this->Mx = ewrpt_Init2DArray($nGrps, $nDtls, NULL);
		$this->GrandSmry = ewrpt_InitArray($nDtls, 0);
		$this->GrandMn = ewrpt_InitArray($nDtls, NULL);
		$this->GrandMx = ewrpt_InitArray($nDtls, NULL);

		// Set up if accumulation required
		$this->Col = array(FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE);

		// Set up groups per page dynamically
		$this->SetUpDisplayGrps();
		$Tranfered_In->ToDepartment->SelectionList = "";
		$Tranfered_In->ToDepartment->DefaultSelectionList = "";
		$Tranfered_In->ToDepartment->ValueList = "";
		$Tranfered_In->ID->SelectionList = "";
		$Tranfered_In->ID->DefaultSelectionList = "";
		$Tranfered_In->ID->ValueList = "";
		$Tranfered_In->FirstName->SelectionList = "";
		$Tranfered_In->FirstName->DefaultSelectionList = "";
		$Tranfered_In->FirstName->ValueList = "";
		$Tranfered_In->MiddelName->SelectionList = "";
		$Tranfered_In->MiddelName->DefaultSelectionList = "";
		$Tranfered_In->MiddelName->ValueList = "";
		$Tranfered_In->LastName->SelectionList = "";
		$Tranfered_In->LastName->DefaultSelectionList = "";
		$Tranfered_In->LastName->ValueList = "";
		$Tranfered_In->Position->SelectionList = "";
		$Tranfered_In->Position->DefaultSelectionList = "";
		$Tranfered_In->Position->ValueList = "";
		$Tranfered_In->FromDepartment->SelectionList = "";
		$Tranfered_In->FromDepartment->DefaultSelectionList = "";
		$Tranfered_In->FromDepartment->ValueList = "";
		$Tranfered_In->Position_AfterTransfered->SelectionList = "";
		$Tranfered_In->Position_AfterTransfered->DefaultSelectionList = "";
		$Tranfered_In->Position_AfterTransfered->ValueList = "";
		$Tranfered_In->Transfered_Date->SelectionList = "";
		$Tranfered_In->Transfered_Date->DefaultSelectionList = "";
		$Tranfered_In->Transfered_Date->ValueList = "";

		// Load default filter values
		$this->LoadDefaultFilters();

		// Set up popup filter
		$this->SetupPopup();

		// Extended filter
		$sExtendedFilter = "";

		// Get dropdown values
		$this->GetExtendedFilterValues();

		// Load custom filters
		$Tranfered_In->CustomFilters_Load();

		// Build extended filter
		$sExtendedFilter = $this->GetExtendedFilter();
		if ($sExtendedFilter <> "") {
			if ($this->Filter <> "")
  				$this->Filter = "($this->Filter) AND ($sExtendedFilter)";
			else
				$this->Filter = $sExtendedFilter;
		}

		// Build popup filter
		$sPopupFilter = $this->GetPopupFilter();

		//ewrpt_SetDebugMsg("popup filter: " . $sPopupFilter);
		if ($sPopupFilter <> "") {
			if ($this->Filter <> "")
				$this->Filter = "($this->Filter) AND ($sPopupFilter)";
			else
				$this->Filter = $sPopupFilter;
		}

		// Check if filter applied
		$this->FilterApplied = $this->CheckFilter();

		// Get sort
		$this->Sort = $this->GetSort();

		// Get total group count
		$sGrpSort = ewrpt_UpdateSortFields($Tranfered_In->SqlOrderByGroup(), $this->Sort, 2); // Get grouping field only
		$sSql = ewrpt_BuildReportSql($Tranfered_In->SqlSelectGroup(), $Tranfered_In->SqlWhere(), $Tranfered_In->SqlGroupBy(), $Tranfered_In->SqlHaving(), $Tranfered_In->SqlOrderByGroup(), $this->Filter, $sGrpSort);
		$this->TotalGrps = $this->GetGrpCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($Tranfered_In->ExportAll && $Tranfered_In->Export <> "")
		    $this->DisplayGrps = $this->TotalGrps;
		else
			$this->SetUpStartGroup(); 

		// Get current page groups
		$rsgrp = $this->GetGrpRs($sSql, $this->StartGrp, $this->DisplayGrps);

		// Init detail recordset
		$rs = NULL;
	}

	// Check level break
	function ChkLvlBreak($lvl) {
		global $Tranfered_In;
		switch ($lvl) {
			case 1:
				return (is_null($Tranfered_In->ToDepartment->CurrentValue) && !is_null($Tranfered_In->ToDepartment->OldValue)) ||
					(!is_null($Tranfered_In->ToDepartment->CurrentValue) && is_null($Tranfered_In->ToDepartment->OldValue)) ||
					($Tranfered_In->ToDepartment->GroupValue() <> $Tranfered_In->ToDepartment->GroupOldValue());
		}
	}

	// Accummulate summary
	function AccumulateSummary() {
		$cntx = count($this->Smry);
		for ($ix = 0; $ix < $cntx; $ix++) {
			$cnty = count($this->Smry[$ix]);
			for ($iy = 1; $iy < $cnty; $iy++) {
				$this->Cnt[$ix][$iy]++;
				if ($this->Col[$iy]) {
					$valwrk = $this->Val[$iy];
					if (is_null($valwrk) || !is_numeric($valwrk)) {

						// skip
					} else {
						$this->Smry[$ix][$iy] += $valwrk;
						if (is_null($this->Mn[$ix][$iy])) {
							$this->Mn[$ix][$iy] = $valwrk;
							$this->Mx[$ix][$iy] = $valwrk;
						} else {
							if ($this->Mn[$ix][$iy] > $valwrk) $this->Mn[$ix][$iy] = $valwrk;
							if ($this->Mx[$ix][$iy] < $valwrk) $this->Mx[$ix][$iy] = $valwrk;
						}
					}
				}
			}
		}
		$cntx = count($this->Smry);
		for ($ix = 1; $ix < $cntx; $ix++) {
			$this->Cnt[$ix][0]++;
		}
	}

	// Reset level summary
	function ResetLevelSummary($lvl) {

		// Clear summary values
		$cntx = count($this->Smry);
		for ($ix = $lvl; $ix < $cntx; $ix++) {
			$cnty = count($this->Smry[$ix]);
			for ($iy = 1; $iy < $cnty; $iy++) {
				$this->Cnt[$ix][$iy] = 0;
				if ($this->Col[$iy]) {
					$this->Smry[$ix][$iy] = 0;
					$this->Mn[$ix][$iy] = NULL;
					$this->Mx[$ix][$iy] = NULL;
				}
			}
		}
		$cntx = count($this->Smry);
		for ($ix = $lvl; $ix < $cntx; $ix++) {
			$this->Cnt[$ix][0] = 0;
		}

		// Reset record count
		$this->RecCount = 0;
	}

	// Accummulate grand summary
	function AccumulateGrandSummary() {
		$this->Cnt[0][0]++;
		$cntgs = count($this->GrandSmry);
		for ($iy = 1; $iy < $cntgs; $iy++) {
			if ($this->Col[$iy]) {
				$valwrk = $this->Val[$iy];
				if (is_null($valwrk) || !is_numeric($valwrk)) {

					// skip
				} else {
					$this->GrandSmry[$iy] += $valwrk;
					if (is_null($this->GrandMn[$iy])) {
						$this->GrandMn[$iy] = $valwrk;
						$this->GrandMx[$iy] = $valwrk;
					} else {
						if ($this->GrandMn[$iy] > $valwrk) $this->GrandMn[$iy] = $valwrk;
						if ($this->GrandMx[$iy] < $valwrk) $this->GrandMx[$iy] = $valwrk;
					}
				}
			}
		}
	}

	// Get group count
	function GetGrpCnt($sql) {
		global $conn;
		global $Tranfered_In;
		$rsgrpcnt = $conn->Execute($sql);
		$grpcnt = ($rsgrpcnt) ? $rsgrpcnt->RecordCount() : 0;
		if ($rsgrpcnt) $rsgrpcnt->Close();
		return $grpcnt;
	}

	// Get group rs
	function GetGrpRs($sql, $start, $grps) {
		global $conn;
		global $Tranfered_In;
		$wrksql = $sql;
		if ($start > 0 && $grps > -1)
			$wrksql .= " LIMIT " . ($start-1) . ", " . ($grps);
		$rswrk = $conn->Execute($wrksql);
		return $rswrk;
	}

	// Get group row values
	function GetGrpRow($opt) {
		global $rsgrp;
		global $Tranfered_In;
		if (!$rsgrp)
			return;
		if ($opt == 1) { // Get first group

			//$rsgrp->MoveFirst(); // NOTE: no need to move position
			$Tranfered_In->ToDepartment->setDbValue(""); // Init first value
		} else { // Get next group
			$rsgrp->MoveNext();
		}
		if (!$rsgrp->EOF)
			$Tranfered_In->ToDepartment->setDbValue($rsgrp->fields('ToDepartment'));
		if ($rsgrp->EOF) {
			$Tranfered_In->ToDepartment->setDbValue("");
		}
	}

	// Get row values
	function GetRow($opt) {
		global $rs;
		global $Tranfered_In;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$Tranfered_In->Auto_ID->setDbValue($rs->fields('Auto_ID'));
			$Tranfered_In->ID->setDbValue($rs->fields('ID'));
			$Tranfered_In->FirstName->setDbValue($rs->fields('FirstName'));
			$Tranfered_In->MiddelName->setDbValue($rs->fields('MiddelName'));
			$Tranfered_In->LastName->setDbValue($rs->fields('LastName'));
			$Tranfered_In->Position->setDbValue($rs->fields('Position'));
			$Tranfered_In->FromDepartment->setDbValue($rs->fields('FromDepartment'));
			if ($opt <> 1)
				$Tranfered_In->ToDepartment->setDbValue($rs->fields('ToDepartment'));
			$Tranfered_In->Position_AfterTransfered->setDbValue($rs->fields('Position_AfterTransfered'));
			$Tranfered_In->Transfered_Date->setDbValue($rs->fields('Transfered_Date'));
			$this->Val[1] = $Tranfered_In->ID->CurrentValue;
			$this->Val[2] = $Tranfered_In->FirstName->CurrentValue;
			$this->Val[3] = $Tranfered_In->MiddelName->CurrentValue;
			$this->Val[4] = $Tranfered_In->LastName->CurrentValue;
			$this->Val[5] = $Tranfered_In->Position->CurrentValue;
			$this->Val[6] = $Tranfered_In->FromDepartment->CurrentValue;
			$this->Val[7] = $Tranfered_In->Position_AfterTransfered->CurrentValue;
			$this->Val[8] = $Tranfered_In->Transfered_Date->CurrentValue;
		} else {
			$Tranfered_In->Auto_ID->setDbValue("");
			$Tranfered_In->ID->setDbValue("");
			$Tranfered_In->FirstName->setDbValue("");
			$Tranfered_In->MiddelName->setDbValue("");
			$Tranfered_In->LastName->setDbValue("");
			$Tranfered_In->Position->setDbValue("");
			$Tranfered_In->FromDepartment->setDbValue("");
			$Tranfered_In->ToDepartment->setDbValue("");
			$Tranfered_In->Position_AfterTransfered->setDbValue("");
			$Tranfered_In->Transfered_Date->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $Tranfered_In;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$Tranfered_In->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$Tranfered_In->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $Tranfered_In->getStartGroup();
			}
		} else {
			$this->StartGrp = $Tranfered_In->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$Tranfered_In->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$Tranfered_In->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$Tranfered_In->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $Tranfered_In;

		// Initialize popup
		// Build distinct values for ToDepartment

		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Tranfered_In->ToDepartment->SqlSelect, $Tranfered_In->SqlWhere(), $Tranfered_In->SqlGroupBy(), $Tranfered_In->SqlHaving(), $Tranfered_In->ToDepartment->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Tranfered_In->ToDepartment->setDbValue($rswrk->fields[0]);
			if (is_null($Tranfered_In->ToDepartment->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Tranfered_In->ToDepartment->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Tranfered_In->ToDepartment->GroupViewValue = ewrpt_DisplayGroupValue($Tranfered_In->ToDepartment,$Tranfered_In->ToDepartment->GroupValue());
				ewrpt_SetupDistinctValues($Tranfered_In->ToDepartment->ValueList, $Tranfered_In->ToDepartment->GroupValue(), $Tranfered_In->ToDepartment->GroupViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Tranfered_In->ToDepartment->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Tranfered_In->ToDepartment->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for ID
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Tranfered_In->ID->SqlSelect, $Tranfered_In->SqlWhere(), $Tranfered_In->SqlGroupBy(), $Tranfered_In->SqlHaving(), $Tranfered_In->ID->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Tranfered_In->ID->setDbValue($rswrk->fields[0]);
			if (is_null($Tranfered_In->ID->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Tranfered_In->ID->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Tranfered_In->ID->ViewValue = $Tranfered_In->ID->CurrentValue;
				ewrpt_SetupDistinctValues($Tranfered_In->ID->ValueList, $Tranfered_In->ID->CurrentValue, $Tranfered_In->ID->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Tranfered_In->ID->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Tranfered_In->ID->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for FirstName
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Tranfered_In->FirstName->SqlSelect, $Tranfered_In->SqlWhere(), $Tranfered_In->SqlGroupBy(), $Tranfered_In->SqlHaving(), $Tranfered_In->FirstName->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Tranfered_In->FirstName->setDbValue($rswrk->fields[0]);
			if (is_null($Tranfered_In->FirstName->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Tranfered_In->FirstName->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Tranfered_In->FirstName->ViewValue = $Tranfered_In->FirstName->CurrentValue;
				ewrpt_SetupDistinctValues($Tranfered_In->FirstName->ValueList, $Tranfered_In->FirstName->CurrentValue, $Tranfered_In->FirstName->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Tranfered_In->FirstName->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Tranfered_In->FirstName->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for MiddelName
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Tranfered_In->MiddelName->SqlSelect, $Tranfered_In->SqlWhere(), $Tranfered_In->SqlGroupBy(), $Tranfered_In->SqlHaving(), $Tranfered_In->MiddelName->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Tranfered_In->MiddelName->setDbValue($rswrk->fields[0]);
			if (is_null($Tranfered_In->MiddelName->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Tranfered_In->MiddelName->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Tranfered_In->MiddelName->ViewValue = $Tranfered_In->MiddelName->CurrentValue;
				ewrpt_SetupDistinctValues($Tranfered_In->MiddelName->ValueList, $Tranfered_In->MiddelName->CurrentValue, $Tranfered_In->MiddelName->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Tranfered_In->MiddelName->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Tranfered_In->MiddelName->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for LastName
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Tranfered_In->LastName->SqlSelect, $Tranfered_In->SqlWhere(), $Tranfered_In->SqlGroupBy(), $Tranfered_In->SqlHaving(), $Tranfered_In->LastName->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Tranfered_In->LastName->setDbValue($rswrk->fields[0]);
			if (is_null($Tranfered_In->LastName->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Tranfered_In->LastName->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Tranfered_In->LastName->ViewValue = $Tranfered_In->LastName->CurrentValue;
				ewrpt_SetupDistinctValues($Tranfered_In->LastName->ValueList, $Tranfered_In->LastName->CurrentValue, $Tranfered_In->LastName->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Tranfered_In->LastName->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Tranfered_In->LastName->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for Position
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Tranfered_In->Position->SqlSelect, $Tranfered_In->SqlWhere(), $Tranfered_In->SqlGroupBy(), $Tranfered_In->SqlHaving(), $Tranfered_In->Position->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Tranfered_In->Position->setDbValue($rswrk->fields[0]);
			if (is_null($Tranfered_In->Position->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Tranfered_In->Position->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Tranfered_In->Position->ViewValue = $Tranfered_In->Position->CurrentValue;
				ewrpt_SetupDistinctValues($Tranfered_In->Position->ValueList, $Tranfered_In->Position->CurrentValue, $Tranfered_In->Position->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Tranfered_In->Position->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Tranfered_In->Position->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for FromDepartment
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Tranfered_In->FromDepartment->SqlSelect, $Tranfered_In->SqlWhere(), $Tranfered_In->SqlGroupBy(), $Tranfered_In->SqlHaving(), $Tranfered_In->FromDepartment->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Tranfered_In->FromDepartment->setDbValue($rswrk->fields[0]);
			if (is_null($Tranfered_In->FromDepartment->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Tranfered_In->FromDepartment->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Tranfered_In->FromDepartment->ViewValue = $Tranfered_In->FromDepartment->CurrentValue;
				ewrpt_SetupDistinctValues($Tranfered_In->FromDepartment->ValueList, $Tranfered_In->FromDepartment->CurrentValue, $Tranfered_In->FromDepartment->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Tranfered_In->FromDepartment->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Tranfered_In->FromDepartment->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for Position_AfterTransfered
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Tranfered_In->Position_AfterTransfered->SqlSelect, $Tranfered_In->SqlWhere(), $Tranfered_In->SqlGroupBy(), $Tranfered_In->SqlHaving(), $Tranfered_In->Position_AfterTransfered->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Tranfered_In->Position_AfterTransfered->setDbValue($rswrk->fields[0]);
			if (is_null($Tranfered_In->Position_AfterTransfered->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Tranfered_In->Position_AfterTransfered->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Tranfered_In->Position_AfterTransfered->ViewValue = $Tranfered_In->Position_AfterTransfered->CurrentValue;
				ewrpt_SetupDistinctValues($Tranfered_In->Position_AfterTransfered->ValueList, $Tranfered_In->Position_AfterTransfered->CurrentValue, $Tranfered_In->Position_AfterTransfered->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Tranfered_In->Position_AfterTransfered->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Tranfered_In->Position_AfterTransfered->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for Transfered_Date
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Tranfered_In->Transfered_Date->SqlSelect, $Tranfered_In->SqlWhere(), $Tranfered_In->SqlGroupBy(), $Tranfered_In->SqlHaving(), $Tranfered_In->Transfered_Date->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Tranfered_In->Transfered_Date->setDbValue($rswrk->fields[0]);
			if (is_null($Tranfered_In->Transfered_Date->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Tranfered_In->Transfered_Date->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Tranfered_In->Transfered_Date->ViewValue = ewrpt_FormatDateTime($Tranfered_In->Transfered_Date->CurrentValue, 5);
				ewrpt_SetupDistinctValues($Tranfered_In->Transfered_Date->ValueList, $Tranfered_In->Transfered_Date->CurrentValue, $Tranfered_In->Transfered_Date->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Tranfered_In->Transfered_Date->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Tranfered_In->Transfered_Date->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Process post back form
		if (ewrpt_IsHttpPost()) {
			$sName = @$_POST["popup"]; // Get popup form name
			if ($sName <> "") {
				$cntValues = (is_array(@$_POST["sel_$sName"])) ? count($_POST["sel_$sName"]) : 0;
				if ($cntValues > 0) {
					$arValues = ewrpt_StripSlashes($_POST["sel_$sName"]);
					if (trim($arValues[0]) == "") // Select all
						$arValues = EWRPT_INIT_VALUE;
					if (!ewrpt_MatchedArray($arValues, $_SESSION["sel_$sName"])) {
						if ($this->HasSessionFilterValues($sName))
							$this->ClearExtFilter = $sName; // Clear extended filter for this field
					}
					$_SESSION["sel_$sName"] = $arValues;
					$_SESSION["rf_$sName"] = ewrpt_StripSlashes(@$_POST["rf_$sName"]);
					$_SESSION["rt_$sName"] = ewrpt_StripSlashes(@$_POST["rt_$sName"]);
					$this->ResetPager();
				}
			}

		// Get 'reset' command
		} elseif (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];
			if (strtolower($sCmd) == "reset") {
				$this->ClearSessionSelection('ToDepartment');
				$this->ClearSessionSelection('ID');
				$this->ClearSessionSelection('FirstName');
				$this->ClearSessionSelection('MiddelName');
				$this->ClearSessionSelection('LastName');
				$this->ClearSessionSelection('Position');
				$this->ClearSessionSelection('FromDepartment');
				$this->ClearSessionSelection('Position_AfterTransfered');
				$this->ClearSessionSelection('Transfered_Date');
				$this->ResetPager();
			}
		}

		// Load selection criteria to array
		// Get To Department selected values

		if (is_array(@$_SESSION["sel_Tranfered_In_ToDepartment"])) {
			$this->LoadSelectionFromSession('ToDepartment');
		} elseif (@$_SESSION["sel_Tranfered_In_ToDepartment"] == EWRPT_INIT_VALUE) { // Select all
			$Tranfered_In->ToDepartment->SelectionList = "";
		}

		// Get ID selected values
		if (is_array(@$_SESSION["sel_Tranfered_In_ID"])) {
			$this->LoadSelectionFromSession('ID');
		} elseif (@$_SESSION["sel_Tranfered_In_ID"] == EWRPT_INIT_VALUE) { // Select all
			$Tranfered_In->ID->SelectionList = "";
		}

		// Get First Name selected values
		if (is_array(@$_SESSION["sel_Tranfered_In_FirstName"])) {
			$this->LoadSelectionFromSession('FirstName');
		} elseif (@$_SESSION["sel_Tranfered_In_FirstName"] == EWRPT_INIT_VALUE) { // Select all
			$Tranfered_In->FirstName->SelectionList = "";
		}

		// Get Middel Name selected values
		if (is_array(@$_SESSION["sel_Tranfered_In_MiddelName"])) {
			$this->LoadSelectionFromSession('MiddelName');
		} elseif (@$_SESSION["sel_Tranfered_In_MiddelName"] == EWRPT_INIT_VALUE) { // Select all
			$Tranfered_In->MiddelName->SelectionList = "";
		}

		// Get Last Name selected values
		if (is_array(@$_SESSION["sel_Tranfered_In_LastName"])) {
			$this->LoadSelectionFromSession('LastName');
		} elseif (@$_SESSION["sel_Tranfered_In_LastName"] == EWRPT_INIT_VALUE) { // Select all
			$Tranfered_In->LastName->SelectionList = "";
		}

		// Get Position selected values
		if (is_array(@$_SESSION["sel_Tranfered_In_Position"])) {
			$this->LoadSelectionFromSession('Position');
		} elseif (@$_SESSION["sel_Tranfered_In_Position"] == EWRPT_INIT_VALUE) { // Select all
			$Tranfered_In->Position->SelectionList = "";
		}

		// Get From Department selected values
		if (is_array(@$_SESSION["sel_Tranfered_In_FromDepartment"])) {
			$this->LoadSelectionFromSession('FromDepartment');
		} elseif (@$_SESSION["sel_Tranfered_In_FromDepartment"] == EWRPT_INIT_VALUE) { // Select all
			$Tranfered_In->FromDepartment->SelectionList = "";
		}

		// Get Position After Transfered selected values
		if (is_array(@$_SESSION["sel_Tranfered_In_Position_AfterTransfered"])) {
			$this->LoadSelectionFromSession('Position_AfterTransfered');
		} elseif (@$_SESSION["sel_Tranfered_In_Position_AfterTransfered"] == EWRPT_INIT_VALUE) { // Select all
			$Tranfered_In->Position_AfterTransfered->SelectionList = "";
		}

		// Get Transfered Date selected values
		if (is_array(@$_SESSION["sel_Tranfered_In_Transfered_Date"])) {
			$this->LoadSelectionFromSession('Transfered_Date');
		} elseif (@$_SESSION["sel_Tranfered_In_Transfered_Date"] == EWRPT_INIT_VALUE) { // Select all
			$Tranfered_In->Transfered_Date->SelectionList = "";
		}
	}

	// Reset pager
	function ResetPager() {

		// Reset start position (reset command)
		global $Tranfered_In;
		$this->StartGrp = 1;
		$Tranfered_In->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $Tranfered_In;
		$sWrk = @$_GET[EWRPT_TABLE_GROUP_PER_PAGE];
		if ($sWrk <> "") {
			if (is_numeric($sWrk)) {
				$this->DisplayGrps = intval($sWrk);
			} else {
				if (strtoupper($sWrk) == "ALL") { // display all groups
					$this->DisplayGrps = -1;
				} else {
					$this->DisplayGrps = 3; // Non-numeric, load default
				}
			}
			$Tranfered_In->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$Tranfered_In->setStartGroup($this->StartGrp);
		} else {
			if ($Tranfered_In->getGroupPerPage() <> "") {
				$this->DisplayGrps = $Tranfered_In->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $Security;
		global $Tranfered_In;
		if ($Tranfered_In->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($Tranfered_In->SqlSelectCount(), $Tranfered_In->SqlWhere(), $Tranfered_In->SqlGroupBy(), $Tranfered_In->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}
		}

		// Call Row_Rendering event
		$Tranfered_In->Row_Rendering();

		/* --------------------
		'  Render view codes
		' --------------------- */
		if ($Tranfered_In->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// ToDepartment
			$Tranfered_In->ToDepartment->GroupViewValue = $Tranfered_In->ToDepartment->GroupOldValue();
			$Tranfered_In->ToDepartment->CellAttrs["class"] = ($Tranfered_In->RowGroupLevel == 1) ? "ewRptGrpSummary1" : "ewRptGrpField1";
			$Tranfered_In->ToDepartment->GroupViewValue = ewrpt_DisplayGroupValue($Tranfered_In->ToDepartment, $Tranfered_In->ToDepartment->GroupViewValue);

			// ID
			$Tranfered_In->ID->ViewValue = $Tranfered_In->ID->Summary;

			// FirstName
			$Tranfered_In->FirstName->ViewValue = $Tranfered_In->FirstName->Summary;

			// MiddelName
			$Tranfered_In->MiddelName->ViewValue = $Tranfered_In->MiddelName->Summary;

			// LastName
			$Tranfered_In->LastName->ViewValue = $Tranfered_In->LastName->Summary;

			// Position
			$Tranfered_In->Position->ViewValue = $Tranfered_In->Position->Summary;

			// FromDepartment
			$Tranfered_In->FromDepartment->ViewValue = $Tranfered_In->FromDepartment->Summary;

			// Position_AfterTransfered
			$Tranfered_In->Position_AfterTransfered->ViewValue = $Tranfered_In->Position_AfterTransfered->Summary;

			// Transfered_Date
			$Tranfered_In->Transfered_Date->ViewValue = $Tranfered_In->Transfered_Date->Summary;
			$Tranfered_In->Transfered_Date->ViewValue = ewrpt_FormatDateTime($Tranfered_In->Transfered_Date->ViewValue, 5);
		} else {

			// ToDepartment
			$Tranfered_In->ToDepartment->GroupViewValue = $Tranfered_In->ToDepartment->GroupValue();
			$Tranfered_In->ToDepartment->CellAttrs["class"] = "ewRptGrpField1";
			$Tranfered_In->ToDepartment->GroupViewValue = ewrpt_DisplayGroupValue($Tranfered_In->ToDepartment, $Tranfered_In->ToDepartment->GroupViewValue);
			if ($Tranfered_In->ToDepartment->GroupValue() == $Tranfered_In->ToDepartment->GroupOldValue() && !$this->ChkLvlBreak(1))
				$Tranfered_In->ToDepartment->GroupViewValue = "&nbsp;";

			// ID
			$Tranfered_In->ID->ViewValue = $Tranfered_In->ID->CurrentValue;
			$Tranfered_In->ID->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// FirstName
			$Tranfered_In->FirstName->ViewValue = $Tranfered_In->FirstName->CurrentValue;
			$Tranfered_In->FirstName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// MiddelName
			$Tranfered_In->MiddelName->ViewValue = $Tranfered_In->MiddelName->CurrentValue;
			$Tranfered_In->MiddelName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// LastName
			$Tranfered_In->LastName->ViewValue = $Tranfered_In->LastName->CurrentValue;
			$Tranfered_In->LastName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Position
			$Tranfered_In->Position->ViewValue = $Tranfered_In->Position->CurrentValue;
			$Tranfered_In->Position->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// FromDepartment
			$Tranfered_In->FromDepartment->ViewValue = $Tranfered_In->FromDepartment->CurrentValue;
			$Tranfered_In->FromDepartment->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Position_AfterTransfered
			$Tranfered_In->Position_AfterTransfered->ViewValue = $Tranfered_In->Position_AfterTransfered->CurrentValue;
			$Tranfered_In->Position_AfterTransfered->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Transfered_Date
			$Tranfered_In->Transfered_Date->ViewValue = $Tranfered_In->Transfered_Date->CurrentValue;
			$Tranfered_In->Transfered_Date->ViewValue = ewrpt_FormatDateTime($Tranfered_In->Transfered_Date->ViewValue, 5);
			$Tranfered_In->Transfered_Date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// ToDepartment
		$Tranfered_In->ToDepartment->HrefValue = "";

		// ID
		$Tranfered_In->ID->HrefValue = "";

		// FirstName
		$Tranfered_In->FirstName->HrefValue = "";

		// MiddelName
		$Tranfered_In->MiddelName->HrefValue = "";

		// LastName
		$Tranfered_In->LastName->HrefValue = "";

		// Position
		$Tranfered_In->Position->HrefValue = "";

		// FromDepartment
		$Tranfered_In->FromDepartment->HrefValue = "";

		// Position_AfterTransfered
		$Tranfered_In->Position_AfterTransfered->HrefValue = "";

		// Transfered_Date
		$Tranfered_In->Transfered_Date->HrefValue = "";

		// Call Row_Rendered event
		$Tranfered_In->Row_Rendered();
	}

	// Get extended filter values
	function GetExtendedFilterValues() {
		global $Tranfered_In;

		// Field FromDepartment
		$sSelect = "SELECT DISTINCT `FromDepartment` FROM " . $Tranfered_In->SqlFrom();
		$sOrderBy = "`FromDepartment` ASC";
		$wrkSql = ewrpt_BuildReportSql($sSelect, $Tranfered_In->SqlWhere(), "", "", $sOrderBy, $this->UserIDFilter, "");
		$Tranfered_In->FromDepartment->DropDownList = ewrpt_GetDistinctValues("", $wrkSql);

		// Field ToDepartment
		$sSelect = "SELECT DISTINCT `ToDepartment` FROM " . $Tranfered_In->SqlFrom();
		$sOrderBy = "`ToDepartment` ASC";
		$wrkSql = ewrpt_BuildReportSql($sSelect, $Tranfered_In->SqlWhere(), "", "", $sOrderBy, $this->UserIDFilter, "");
		$Tranfered_In->ToDepartment->DropDownList = ewrpt_GetDistinctValues("", $wrkSql);
	}

	// Return extended filter
	function GetExtendedFilter() {
		global $Tranfered_In;
		global $gsFormError;
		$sFilter = "";
		$bPostBack = ewrpt_IsHttpPost();
		$bRestoreSession = TRUE;
		$bSetupFilter = FALSE;

		// Reset extended filter if filter changed
		if ($bPostBack) {

			// Clear extended filter for field ID
			if ($this->ClearExtFilter == 'Tranfered_In_ID')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'ID');

			// Clear extended filter for field FirstName
			if ($this->ClearExtFilter == 'Tranfered_In_FirstName')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'FirstName');

			// Clear extended filter for field MiddelName
			if ($this->ClearExtFilter == 'Tranfered_In_MiddelName')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'MiddelName');

			// Clear extended filter for field LastName
			if ($this->ClearExtFilter == 'Tranfered_In_LastName')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'LastName');

			// Clear extended filter for field Position
			if ($this->ClearExtFilter == 'Tranfered_In_Position')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'Position');

			// Clear dropdown for field FromDepartment
			if ($this->ClearExtFilter == 'Tranfered_In_FromDepartment')
				$this->SetSessionDropDownValue(EWRPT_INIT_VALUE, 'FromDepartment');

			// Clear dropdown for field ToDepartment
			if ($this->ClearExtFilter == 'Tranfered_In_ToDepartment')
				$this->SetSessionDropDownValue(EWRPT_INIT_VALUE, 'ToDepartment');

			// Clear extended filter for field Position_AfterTransfered
			if ($this->ClearExtFilter == 'Tranfered_In_Position_AfterTransfered')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'Position_AfterTransfered');

			// Clear extended filter for field Transfered_Date
			if ($this->ClearExtFilter == 'Tranfered_In_Transfered_Date')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'Transfered_Date');

		// Reset search command
		} elseif (@$_GET["cmd"] == "reset") {

			// Load default values
			// Field ID

			$this->SetSessionFilterValues($Tranfered_In->ID->SearchValue, $Tranfered_In->ID->SearchOperator, $Tranfered_In->ID->SearchCondition, $Tranfered_In->ID->SearchValue2, $Tranfered_In->ID->SearchOperator2, 'ID');

			// Field FirstName
			$this->SetSessionFilterValues($Tranfered_In->FirstName->SearchValue, $Tranfered_In->FirstName->SearchOperator, $Tranfered_In->FirstName->SearchCondition, $Tranfered_In->FirstName->SearchValue2, $Tranfered_In->FirstName->SearchOperator2, 'FirstName');

			// Field MiddelName
			$this->SetSessionFilterValues($Tranfered_In->MiddelName->SearchValue, $Tranfered_In->MiddelName->SearchOperator, $Tranfered_In->MiddelName->SearchCondition, $Tranfered_In->MiddelName->SearchValue2, $Tranfered_In->MiddelName->SearchOperator2, 'MiddelName');

			// Field LastName
			$this->SetSessionFilterValues($Tranfered_In->LastName->SearchValue, $Tranfered_In->LastName->SearchOperator, $Tranfered_In->LastName->SearchCondition, $Tranfered_In->LastName->SearchValue2, $Tranfered_In->LastName->SearchOperator2, 'LastName');

			// Field Position
			$this->SetSessionFilterValues($Tranfered_In->Position->SearchValue, $Tranfered_In->Position->SearchOperator, $Tranfered_In->Position->SearchCondition, $Tranfered_In->Position->SearchValue2, $Tranfered_In->Position->SearchOperator2, 'Position');

			// Field FromDepartment
			$this->SetSessionDropDownValue($Tranfered_In->FromDepartment->DropDownValue, 'FromDepartment');

			// Field ToDepartment
			$this->SetSessionDropDownValue($Tranfered_In->ToDepartment->DropDownValue, 'ToDepartment');

			// Field Position_AfterTransfered
			$this->SetSessionFilterValues($Tranfered_In->Position_AfterTransfered->SearchValue, $Tranfered_In->Position_AfterTransfered->SearchOperator, $Tranfered_In->Position_AfterTransfered->SearchCondition, $Tranfered_In->Position_AfterTransfered->SearchValue2, $Tranfered_In->Position_AfterTransfered->SearchOperator2, 'Position_AfterTransfered');

			// Field Transfered_Date
			$this->SetSessionFilterValues($Tranfered_In->Transfered_Date->SearchValue, $Tranfered_In->Transfered_Date->SearchOperator, $Tranfered_In->Transfered_Date->SearchCondition, $Tranfered_In->Transfered_Date->SearchValue2, $Tranfered_In->Transfered_Date->SearchOperator2, 'Transfered_Date');
			$bSetupFilter = TRUE;
		} else {

			// Field ID
			if ($this->GetFilterValues($Tranfered_In->ID)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field FirstName
			if ($this->GetFilterValues($Tranfered_In->FirstName)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field MiddelName
			if ($this->GetFilterValues($Tranfered_In->MiddelName)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field LastName
			if ($this->GetFilterValues($Tranfered_In->LastName)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field Position
			if ($this->GetFilterValues($Tranfered_In->Position)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field FromDepartment
			if ($this->GetDropDownValue($Tranfered_In->FromDepartment->DropDownValue, 'FromDepartment')) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			} elseif ($Tranfered_In->FromDepartment->DropDownValue <> EWRPT_INIT_VALUE && !isset($_SESSION['sv_Tranfered_In->FromDepartment'])) {
				$bSetupFilter = TRUE;
			}

			// Field ToDepartment
			if ($this->GetDropDownValue($Tranfered_In->ToDepartment->DropDownValue, 'ToDepartment')) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			} elseif ($Tranfered_In->ToDepartment->DropDownValue <> EWRPT_INIT_VALUE && !isset($_SESSION['sv_Tranfered_In->ToDepartment'])) {
				$bSetupFilter = TRUE;
			}

			// Field Position_AfterTransfered
			if ($this->GetFilterValues($Tranfered_In->Position_AfterTransfered)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field Transfered_Date
			if ($this->GetFilterValues($Tranfered_In->Transfered_Date)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}
			if (!$this->ValidateForm()) {
				$this->setMessage($gsFormError);
				return $sFilter;
			}
		}

		// Restore session
		if ($bRestoreSession) {

			// Field ID
			$this->GetSessionFilterValues($Tranfered_In->ID);

			// Field FirstName
			$this->GetSessionFilterValues($Tranfered_In->FirstName);

			// Field MiddelName
			$this->GetSessionFilterValues($Tranfered_In->MiddelName);

			// Field LastName
			$this->GetSessionFilterValues($Tranfered_In->LastName);

			// Field Position
			$this->GetSessionFilterValues($Tranfered_In->Position);

			// Field FromDepartment
			$this->GetSessionDropDownValue($Tranfered_In->FromDepartment);

			// Field ToDepartment
			$this->GetSessionDropDownValue($Tranfered_In->ToDepartment);

			// Field Position_AfterTransfered
			$this->GetSessionFilterValues($Tranfered_In->Position_AfterTransfered);

			// Field Transfered_Date
			$this->GetSessionFilterValues($Tranfered_In->Transfered_Date);
		}

		// Call page filter validated event
		$Tranfered_In->Page_FilterValidated();

		// Build SQL
		// Field ID

		$this->BuildExtendedFilter($Tranfered_In->ID, $sFilter);

		// Field FirstName
		$this->BuildExtendedFilter($Tranfered_In->FirstName, $sFilter);

		// Field MiddelName
		$this->BuildExtendedFilter($Tranfered_In->MiddelName, $sFilter);

		// Field LastName
		$this->BuildExtendedFilter($Tranfered_In->LastName, $sFilter);

		// Field Position
		$this->BuildExtendedFilter($Tranfered_In->Position, $sFilter);

		// Field FromDepartment
		$this->BuildDropDownFilter($Tranfered_In->FromDepartment, $sFilter, "");

		// Field ToDepartment
		$this->BuildDropDownFilter($Tranfered_In->ToDepartment, $sFilter, "");

		// Field Position_AfterTransfered
		$this->BuildExtendedFilter($Tranfered_In->Position_AfterTransfered, $sFilter);

		// Field Transfered_Date
		$this->BuildExtendedFilter($Tranfered_In->Transfered_Date, $sFilter);

		// Save parms to session
		// Field ID

		$this->SetSessionFilterValues($Tranfered_In->ID->SearchValue, $Tranfered_In->ID->SearchOperator, $Tranfered_In->ID->SearchCondition, $Tranfered_In->ID->SearchValue2, $Tranfered_In->ID->SearchOperator2, 'ID');

		// Field FirstName
		$this->SetSessionFilterValues($Tranfered_In->FirstName->SearchValue, $Tranfered_In->FirstName->SearchOperator, $Tranfered_In->FirstName->SearchCondition, $Tranfered_In->FirstName->SearchValue2, $Tranfered_In->FirstName->SearchOperator2, 'FirstName');

		// Field MiddelName
		$this->SetSessionFilterValues($Tranfered_In->MiddelName->SearchValue, $Tranfered_In->MiddelName->SearchOperator, $Tranfered_In->MiddelName->SearchCondition, $Tranfered_In->MiddelName->SearchValue2, $Tranfered_In->MiddelName->SearchOperator2, 'MiddelName');

		// Field LastName
		$this->SetSessionFilterValues($Tranfered_In->LastName->SearchValue, $Tranfered_In->LastName->SearchOperator, $Tranfered_In->LastName->SearchCondition, $Tranfered_In->LastName->SearchValue2, $Tranfered_In->LastName->SearchOperator2, 'LastName');

		// Field Position
		$this->SetSessionFilterValues($Tranfered_In->Position->SearchValue, $Tranfered_In->Position->SearchOperator, $Tranfered_In->Position->SearchCondition, $Tranfered_In->Position->SearchValue2, $Tranfered_In->Position->SearchOperator2, 'Position');

		// Field FromDepartment
		$this->SetSessionDropDownValue($Tranfered_In->FromDepartment->DropDownValue, 'FromDepartment');

		// Field ToDepartment
		$this->SetSessionDropDownValue($Tranfered_In->ToDepartment->DropDownValue, 'ToDepartment');

		// Field Position_AfterTransfered
		$this->SetSessionFilterValues($Tranfered_In->Position_AfterTransfered->SearchValue, $Tranfered_In->Position_AfterTransfered->SearchOperator, $Tranfered_In->Position_AfterTransfered->SearchCondition, $Tranfered_In->Position_AfterTransfered->SearchValue2, $Tranfered_In->Position_AfterTransfered->SearchOperator2, 'Position_AfterTransfered');

		// Field Transfered_Date
		$this->SetSessionFilterValues($Tranfered_In->Transfered_Date->SearchValue, $Tranfered_In->Transfered_Date->SearchOperator, $Tranfered_In->Transfered_Date->SearchCondition, $Tranfered_In->Transfered_Date->SearchValue2, $Tranfered_In->Transfered_Date->SearchOperator2, 'Transfered_Date');

		// Setup filter
		if ($bSetupFilter) {

			// Field ID
			$sWrk = "";
			$this->BuildExtendedFilter($Tranfered_In->ID, $sWrk);
			$this->LoadSelectionFromFilter($Tranfered_In->ID, $sWrk, $Tranfered_In->ID->SelectionList);
			$_SESSION['sel_Tranfered_In_ID'] = ($Tranfered_In->ID->SelectionList == "") ? EWRPT_INIT_VALUE : $Tranfered_In->ID->SelectionList;

			// Field FirstName
			$sWrk = "";
			$this->BuildExtendedFilter($Tranfered_In->FirstName, $sWrk);
			$this->LoadSelectionFromFilter($Tranfered_In->FirstName, $sWrk, $Tranfered_In->FirstName->SelectionList);
			$_SESSION['sel_Tranfered_In_FirstName'] = ($Tranfered_In->FirstName->SelectionList == "") ? EWRPT_INIT_VALUE : $Tranfered_In->FirstName->SelectionList;

			// Field MiddelName
			$sWrk = "";
			$this->BuildExtendedFilter($Tranfered_In->MiddelName, $sWrk);
			$this->LoadSelectionFromFilter($Tranfered_In->MiddelName, $sWrk, $Tranfered_In->MiddelName->SelectionList);
			$_SESSION['sel_Tranfered_In_MiddelName'] = ($Tranfered_In->MiddelName->SelectionList == "") ? EWRPT_INIT_VALUE : $Tranfered_In->MiddelName->SelectionList;

			// Field LastName
			$sWrk = "";
			$this->BuildExtendedFilter($Tranfered_In->LastName, $sWrk);
			$this->LoadSelectionFromFilter($Tranfered_In->LastName, $sWrk, $Tranfered_In->LastName->SelectionList);
			$_SESSION['sel_Tranfered_In_LastName'] = ($Tranfered_In->LastName->SelectionList == "") ? EWRPT_INIT_VALUE : $Tranfered_In->LastName->SelectionList;

			// Field Position
			$sWrk = "";
			$this->BuildExtendedFilter($Tranfered_In->Position, $sWrk);
			$this->LoadSelectionFromFilter($Tranfered_In->Position, $sWrk, $Tranfered_In->Position->SelectionList);
			$_SESSION['sel_Tranfered_In_Position'] = ($Tranfered_In->Position->SelectionList == "") ? EWRPT_INIT_VALUE : $Tranfered_In->Position->SelectionList;

			// Field FromDepartment
			$sWrk = "";
			$this->BuildDropDownFilter($Tranfered_In->FromDepartment, $sWrk, "");
			$this->LoadSelectionFromFilter($Tranfered_In->FromDepartment, $sWrk, $Tranfered_In->FromDepartment->SelectionList);
			$_SESSION['sel_Tranfered_In_FromDepartment'] = ($Tranfered_In->FromDepartment->SelectionList == "") ? EWRPT_INIT_VALUE : $Tranfered_In->FromDepartment->SelectionList;

			// Field ToDepartment
			$sWrk = "";
			$this->BuildDropDownFilter($Tranfered_In->ToDepartment, $sWrk, "");
			$this->LoadSelectionFromFilter($Tranfered_In->ToDepartment, $sWrk, $Tranfered_In->ToDepartment->SelectionList);
			$_SESSION['sel_Tranfered_In_ToDepartment'] = ($Tranfered_In->ToDepartment->SelectionList == "") ? EWRPT_INIT_VALUE : $Tranfered_In->ToDepartment->SelectionList;

			// Field Position_AfterTransfered
			$sWrk = "";
			$this->BuildExtendedFilter($Tranfered_In->Position_AfterTransfered, $sWrk);
			$this->LoadSelectionFromFilter($Tranfered_In->Position_AfterTransfered, $sWrk, $Tranfered_In->Position_AfterTransfered->SelectionList);
			$_SESSION['sel_Tranfered_In_Position_AfterTransfered'] = ($Tranfered_In->Position_AfterTransfered->SelectionList == "") ? EWRPT_INIT_VALUE : $Tranfered_In->Position_AfterTransfered->SelectionList;

			// Field Transfered_Date
			$sWrk = "";
			$this->BuildExtendedFilter($Tranfered_In->Transfered_Date, $sWrk);
			$this->LoadSelectionFromFilter($Tranfered_In->Transfered_Date, $sWrk, $Tranfered_In->Transfered_Date->SelectionList);
			$_SESSION['sel_Tranfered_In_Transfered_Date'] = ($Tranfered_In->Transfered_Date->SelectionList == "") ? EWRPT_INIT_VALUE : $Tranfered_In->Transfered_Date->SelectionList;
		}
		return $sFilter;
	}

	// Get drop down value from querystring
	function GetDropDownValue(&$sv, $parm) {
		if (ewrpt_IsHttpPost())
			return FALSE; // Skip post back
		if (isset($_GET["sv_$parm"])) {
			$sv = ewrpt_StripSlashes($_GET["sv_$parm"]);
			return TRUE;
		}
		return FALSE;
	}

	// Get filter values from querystring
	function GetFilterValues(&$fld) {
		$parm = substr($fld->FldVar, 2);
		if (ewrpt_IsHttpPost())
			return; // Skip post back
		$got = FALSE;
		if (isset($_GET["sv1_$parm"])) {
			$fld->SearchValue = ewrpt_StripSlashes($_GET["sv1_$parm"]);
			$got = TRUE;
		}
		if (isset($_GET["so1_$parm"])) {
			$fld->SearchOperator = ewrpt_StripSlashes($_GET["so1_$parm"]);
			$got = TRUE;
		}
		if (isset($_GET["sc_$parm"])) {
			$fld->SearchCondition = ewrpt_StripSlashes($_GET["sc_$parm"]);
			$got = TRUE;
		}
		if (isset($_GET["sv2_$parm"])) {
			$fld->SearchValue2 = ewrpt_StripSlashes($_GET["sv2_$parm"]);
			$got = TRUE;
		}
		if (isset($_GET["so2_$parm"])) {
			$fld->SearchOperator2 = ewrpt_StripSlashes($_GET["so2_$parm"]);
			$got = TRUE;
		}
		return $got;
	}

	// Set default ext filter
	function SetDefaultExtFilter(&$fld, $so1, $sv1, $sc, $so2, $sv2) {
		$fld->DefaultSearchValue = $sv1; // Default ext filter value 1
		$fld->DefaultSearchValue2 = $sv2; // Default ext filter value 2 (if operator 2 is enabled)
		$fld->DefaultSearchOperator = $so1; // Default search operator 1
		$fld->DefaultSearchOperator2 = $so2; // Default search operator 2 (if operator 2 is enabled)
		$fld->DefaultSearchCondition = $sc; // Default search condition (if operator 2 is enabled)
	}

	// Apply default ext filter
	function ApplyDefaultExtFilter(&$fld) {
		$fld->SearchValue = $fld->DefaultSearchValue;
		$fld->SearchValue2 = $fld->DefaultSearchValue2;
		$fld->SearchOperator = $fld->DefaultSearchOperator;
		$fld->SearchOperator2 = $fld->DefaultSearchOperator2;
		$fld->SearchCondition = $fld->DefaultSearchCondition;
	}

	// Check if Text Filter applied
	function TextFilterApplied(&$fld) {
		return (strval($fld->SearchValue) <> strval($fld->DefaultSearchValue) ||
			strval($fld->SearchValue2) <> strval($fld->DefaultSearchValue2) ||
			(strval($fld->SearchValue) <> "" &&
				strval($fld->SearchOperator) <> strval($fld->DefaultSearchOperator)) ||
			(strval($fld->SearchValue2) <> "" &&
				strval($fld->SearchOperator2) <> strval($fld->DefaultSearchOperator2)) ||
			strval($fld->SearchCondition) <> strval($fld->DefaultSearchCondition));
	}

	// Check if Non-Text Filter applied
	function NonTextFilterApplied(&$fld) {
		if (is_array($fld->DefaultDropDownValue) && is_array($fld->DropDownValue)) {
			if (count($fld->DefaultDropDownValue) <> count($fld->DropDownValue))
				return TRUE;
			else
				return (count(array_diff($fld->DefaultDropDownValue, $fld->DropDownValue)) <> 0);
		}
		else {
			$v1 = strval($fld->DefaultDropDownValue);
			if ($v1 == EWRPT_INIT_VALUE)
				$v1 = "";
			$v2 = strval($fld->DropDownValue);
			if ($v2 == EWRPT_INIT_VALUE || $v2 == EWRPT_ALL_VALUE)
				$v2 = "";
			return ($v1 <> $v2);
		}
	}

	// Load selection from a filter clause
	function LoadSelectionFromFilter(&$fld, $filter, &$sel) {
		$sel = "";
		if ($filter <> "") {
			$sSql = ewrpt_BuildReportSql($fld->SqlSelect, "", "", "", $fld->SqlOrderBy, $filter, "");
			ewrpt_LoadArrayFromSql($sSql, $sel);
		}
	}

	// Get dropdown value from session
	function GetSessionDropDownValue(&$fld) {
		$parm = substr($fld->FldVar, 2);
		$this->GetSessionValue($fld->DropDownValue, 'sv_Tranfered_In_' . $parm);
	}

	// Get filter values from session
	function GetSessionFilterValues(&$fld) {
		$parm = substr($fld->FldVar, 2);
		$this->GetSessionValue($fld->SearchValue, 'sv1_Tranfered_In_' . $parm);
		$this->GetSessionValue($fld->SearchOperator, 'so1_Tranfered_In_' . $parm);
		$this->GetSessionValue($fld->SearchCondition, 'sc_Tranfered_In_' . $parm);
		$this->GetSessionValue($fld->SearchValue2, 'sv2_Tranfered_In_' . $parm);
		$this->GetSessionValue($fld->SearchOperator2, 'so2_Tranfered_In_' . $parm);
	}

	// Get value from session
	function GetSessionValue(&$sv, $sn) {
		if (isset($_SESSION[$sn]))
			$sv = $_SESSION[$sn];
	}

	// Set dropdown value to session
	function SetSessionDropDownValue($sv, $parm) {
		$_SESSION['sv_Tranfered_In_' . $parm] = $sv;
	}

	// Set filter values to session
	function SetSessionFilterValues($sv1, $so1, $sc, $sv2, $so2, $parm) {
		$_SESSION['sv1_Tranfered_In_' . $parm] = $sv1;
		$_SESSION['so1_Tranfered_In_' . $parm] = $so1;
		$_SESSION['sc_Tranfered_In_' . $parm] = $sc;
		$_SESSION['sv2_Tranfered_In_' . $parm] = $sv2;
		$_SESSION['so2_Tranfered_In_' . $parm] = $so2;
	}

	// Check if has Session filter values
	function HasSessionFilterValues($parm) {
		return ((@$_SESSION['sv_' . $parm] <> "" && @$_SESSION['sv_' . $parm] <> EWRPT_INIT_VALUE) ||
			(@$_SESSION['sv1_' . $parm] <> "" && @$_SESSION['sv1_' . $parm] <> EWRPT_INIT_VALUE) ||
			(@$_SESSION['sv2_' . $parm] <> "" && @$_SESSION['sv2_' . $parm] <> EWRPT_INIT_VALUE));
	}

	// Dropdown filter exist
	function DropDownFilterExist(&$fld, $FldOpr) {
		$sWrk = "";
		$this->BuildDropDownFilter($fld, $sWrk, $FldOpr);
		return ($sWrk <> "");
	}

	// Build dropdown filter
	function BuildDropDownFilter(&$fld, &$FilterClause, $FldOpr) {
		$FldVal = $fld->DropDownValue;
		$sSql = "";
		if (is_array($FldVal)) {
			foreach ($FldVal as $val) {
				$sWrk = $this->GetDropDownfilter($fld, $val, $FldOpr);
				if ($sWrk <> "") {
					if ($sSql <> "")
						$sSql .= " OR " . $sWrk;
					else
						$sSql = $sWrk;
				}
			}
		} else {
			$sSql = $this->GetDropDownfilter($fld, $FldVal, $FldOpr);
		}
		if ($sSql <> "") {
			if ($FilterClause <> "") $FilterClause = "(" . $FilterClause . ") AND ";
			$FilterClause .= "(" . $sSql . ")";
		}
	}

	function GetDropDownfilter(&$fld, $FldVal, $FldOpr) {
		$FldName = $fld->FldName;
		$FldExpression = $fld->FldExpression;
		$FldDataType = $fld->FldDataType;
		$sWrk = "";
		if ($FldVal == EWRPT_NULL_VALUE) {
			$sWrk = $FldExpression . " IS NULL";
		} elseif ($FldVal == EWRPT_EMPTY_VALUE) {
			$sWrk = $FldExpression . " = ''";
		} else {
			if (substr($FldVal, 0, 2) == "@@") {
				$sWrk = ewrpt_getCustomFilter($fld, $FldVal);
			} else {
				if ($FldVal <> "" && $FldVal <> EWRPT_INIT_VALUE && $FldVal <> EWRPT_ALL_VALUE) {
					if ($FldDataType == EWRPT_DATATYPE_DATE && $FldOpr <> "") {
						$sWrk = $this->DateFilterString($FldOpr, $FldVal, $FldDataType);
					} else {
						$sWrk = $this->FilterString("=", $FldVal, $FldDataType);
					}
				}
				if ($sWrk <> "") $sWrk = $FldExpression . $sWrk;
			}
		}
		return $sWrk;
	}

	// Extended filter exist
	function ExtendedFilterExist(&$fld) {
		$sExtWrk = "";
		$this->BuildExtendedFilter($fld, $sExtWrk);
		return ($sExtWrk <> "");
	}

	// Build extended filter
	function BuildExtendedFilter(&$fld, &$FilterClause) {
		$FldName = $fld->FldName;
		$FldExpression = $fld->FldExpression;
		$FldDataType = $fld->FldDataType;
		$FldDateTimeFormat = $fld->FldDateTimeFormat;
		$FldVal1 = $fld->SearchValue;
		$FldOpr1 = $fld->SearchOperator;
		$FldCond = $fld->SearchCondition;
		$FldVal2 = $fld->SearchValue2;
		$FldOpr2 = $fld->SearchOperator2;
		$sWrk = "";
		$FldOpr1 = strtoupper(trim($FldOpr1));
		if ($FldOpr1 == "") $FldOpr1 = "=";
		$FldOpr2 = strtoupper(trim($FldOpr2));
		if ($FldOpr2 == "") $FldOpr2 = "=";
		$wrkFldVal1 = $FldVal1;
		$wrkFldVal2 = $FldVal2;
		if ($FldDataType == EWRPT_DATATYPE_BOOLEAN) {
			if ($wrkFldVal1 <> "") $wrkFldVal1 = ($wrkFldVal1 == "1") ? EWRPT_TRUE_STRING : EWRPT_FALSE_STRING;
			if ($wrkFldVal2 <> "") $wrkFldVal2 = ($wrkFldVal2 == "1") ? EWRPT_TRUE_STRING : EWRPT_FALSE_STRING;
		} elseif ($FldDataType == EWRPT_DATATYPE_DATE) {
			if ($wrkFldVal1 <> "") $wrkFldVal1 = ewrpt_UnFormatDateTime($wrkFldVal1, $FldDateTimeFormat);
			if ($wrkFldVal2 <> "") $wrkFldVal2 = ewrpt_UnFormatDateTime($wrkFldVal2, $FldDateTimeFormat);
		}
		if ($FldOpr1 == "BETWEEN") {
			$IsValidValue = ($FldDataType <> EWRPT_DATATYPE_NUMBER ||
				($FldDataType == EWRPT_DATATYPE_NUMBER && is_numeric($wrkFldVal1) && is_numeric($wrkFldVal2)));
			if ($wrkFldVal1 <> "" && $wrkFldVal2 <> "" && $IsValidValue)
				$sWrk = $FldExpression . " BETWEEN " . ewrpt_QuotedValue($wrkFldVal1, $FldDataType) .
					" AND " . ewrpt_QuotedValue($wrkFldVal2, $FldDataType);
		} elseif ($FldOpr1 == "IS NULL" || $FldOpr1 == "IS NOT NULL") {
			$sWrk = $FldExpression . " " . $wrkFldVal1;
		} else {
			$IsValidValue = ($FldDataType <> EWRPT_DATATYPE_NUMBER ||
				($FldDataType == EWRPT_DATATYPE_NUMBER && is_numeric($wrkFldVal1)));
			if ($wrkFldVal1 <> "" && $IsValidValue && ewrpt_IsValidOpr($FldOpr1, $FldDataType))
				$sWrk = $FldExpression . $this->FilterString($FldOpr1, $wrkFldVal1, $FldDataType);
			$IsValidValue = ($FldDataType <> EWRPT_DATATYPE_NUMBER ||
				($FldDataType == EWRPT_DATATYPE_NUMBER && is_numeric($wrkFldVal2)));
			if ($wrkFldVal2 <> "" && $IsValidValue && ewrpt_IsValidOpr($FldOpr2, $FldDataType)) {
				if ($sWrk <> "")
					$sWrk .= " " . (($FldCond == "OR") ? "OR" : "AND") . " ";
				$sWrk .= $FldExpression . $this->FilterString($FldOpr2, $wrkFldVal2, $FldDataType);
			}
		}
		if ($sWrk <> "") {
			if ($FilterClause <> "") $FilterClause .= " AND ";
			$FilterClause .= "(" . $sWrk . ")";
		}
	}

	// Validate form
	function ValidateForm() {
		global $ReportLanguage, $gsFormError, $Tranfered_In;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EWRPT_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ewrpt_CheckDate($Tranfered_In->Transfered_Date->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Tranfered_In->Transfered_Date->FldErrMsg();
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br />" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Return filter string
	function FilterString($FldOpr, $FldVal, $FldType) {
		if ($FldOpr == "LIKE" || $FldOpr == "NOT LIKE") {
			return " " . $FldOpr . " " . ewrpt_QuotedValue("%$FldVal%", $FldType);
		} elseif ($FldOpr == "STARTS WITH") {
			return " LIKE " . ewrpt_QuotedValue("$FldVal%", $FldType);
		} else {
			return " $FldOpr " . ewrpt_QuotedValue($FldVal, $FldType);
		}
	}

	// Return date search string
	function DateFilterString($FldOpr, $FldVal, $FldType) {
		$wrkVal1 = ewrpt_DateVal($FldOpr, $FldVal, 1);
		$wrkVal2 = ewrpt_DateVal($FldOpr, $FldVal, 2);
		if ($wrkVal1 <> "" && $wrkVal2 <> "") {
			return " BETWEEN " . ewrpt_QuotedValue($wrkVal1, $FldType) . " AND " . ewrpt_QuotedValue($wrkVal2, $FldType);
		} else {
			return "";
		}
	}

	// Clear selection stored in session
	function ClearSessionSelection($parm) {
		$_SESSION["sel_Tranfered_In_$parm"] = "";
		$_SESSION["rf_Tranfered_In_$parm"] = "";
		$_SESSION["rt_Tranfered_In_$parm"] = "";
	}

	// Load selection from session
	function LoadSelectionFromSession($parm) {
		global $Tranfered_In;
		$fld =& $Tranfered_In->fields($parm);
		$fld->SelectionList = @$_SESSION["sel_Tranfered_In_$parm"];
		$fld->RangeFrom = @$_SESSION["rf_Tranfered_In_$parm"];
		$fld->RangeTo = @$_SESSION["rt_Tranfered_In_$parm"];
	}

	// Load default value for filters
	function LoadDefaultFilters() {
		global $Tranfered_In;

		/**
		* Set up default values for non Text filters
		*/

		// Field FromDepartment
		$Tranfered_In->FromDepartment->DefaultDropDownValue = EWRPT_INIT_VALUE;
		$Tranfered_In->FromDepartment->DropDownValue = $Tranfered_In->FromDepartment->DefaultDropDownValue;
		$sWrk = "";
		$this->BuildDropDownFilter($Tranfered_In->FromDepartment, $sWrk, "");
		$this->LoadSelectionFromFilter($Tranfered_In->FromDepartment, $sWrk, $Tranfered_In->FromDepartment->DefaultSelectionList);

		// Field ToDepartment
		$Tranfered_In->ToDepartment->DefaultDropDownValue = EWRPT_INIT_VALUE;
		$Tranfered_In->ToDepartment->DropDownValue = $Tranfered_In->ToDepartment->DefaultDropDownValue;
		$sWrk = "";
		$this->BuildDropDownFilter($Tranfered_In->ToDepartment, $sWrk, "");
		$this->LoadSelectionFromFilter($Tranfered_In->ToDepartment, $sWrk, $Tranfered_In->ToDepartment->DefaultSelectionList);

		/**
		* Set up default values for extended filters
		* function SetDefaultExtFilter(&$fld, $so1, $sv1, $sc, $so2, $sv2)
		* Parameters:
		* $fld - Field object
		* $so1 - Default search operator 1
		* $sv1 - Default ext filter value 1
		* $sc - Default search condition (if operator 2 is enabled)
		* $so2 - Default search operator 2 (if operator 2 is enabled)
		* $sv2 - Default ext filter value 2 (if operator 2 is enabled)
		*/

		// Field ID
		$this->SetDefaultExtFilter($Tranfered_In->ID, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Tranfered_In->ID);
		$sWrk = "";
		$this->BuildExtendedFilter($Tranfered_In->ID, $sWrk);
		$this->LoadSelectionFromFilter($Tranfered_In->ID, $sWrk, $Tranfered_In->ID->DefaultSelectionList);
		$Tranfered_In->ID->SelectionList = $Tranfered_In->ID->DefaultSelectionList;

		// Field FirstName
		$this->SetDefaultExtFilter($Tranfered_In->FirstName, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Tranfered_In->FirstName);
		$sWrk = "";
		$this->BuildExtendedFilter($Tranfered_In->FirstName, $sWrk);
		$this->LoadSelectionFromFilter($Tranfered_In->FirstName, $sWrk, $Tranfered_In->FirstName->DefaultSelectionList);
		$Tranfered_In->FirstName->SelectionList = $Tranfered_In->FirstName->DefaultSelectionList;

		// Field MiddelName
		$this->SetDefaultExtFilter($Tranfered_In->MiddelName, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Tranfered_In->MiddelName);
		$sWrk = "";
		$this->BuildExtendedFilter($Tranfered_In->MiddelName, $sWrk);
		$this->LoadSelectionFromFilter($Tranfered_In->MiddelName, $sWrk, $Tranfered_In->MiddelName->DefaultSelectionList);
		$Tranfered_In->MiddelName->SelectionList = $Tranfered_In->MiddelName->DefaultSelectionList;

		// Field LastName
		$this->SetDefaultExtFilter($Tranfered_In->LastName, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Tranfered_In->LastName);
		$sWrk = "";
		$this->BuildExtendedFilter($Tranfered_In->LastName, $sWrk);
		$this->LoadSelectionFromFilter($Tranfered_In->LastName, $sWrk, $Tranfered_In->LastName->DefaultSelectionList);
		$Tranfered_In->LastName->SelectionList = $Tranfered_In->LastName->DefaultSelectionList;

		// Field Position
		$this->SetDefaultExtFilter($Tranfered_In->Position, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Tranfered_In->Position);
		$sWrk = "";
		$this->BuildExtendedFilter($Tranfered_In->Position, $sWrk);
		$this->LoadSelectionFromFilter($Tranfered_In->Position, $sWrk, $Tranfered_In->Position->DefaultSelectionList);
		$Tranfered_In->Position->SelectionList = $Tranfered_In->Position->DefaultSelectionList;

		// Field Position_AfterTransfered
		$this->SetDefaultExtFilter($Tranfered_In->Position_AfterTransfered, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Tranfered_In->Position_AfterTransfered);
		$sWrk = "";
		$this->BuildExtendedFilter($Tranfered_In->Position_AfterTransfered, $sWrk);
		$this->LoadSelectionFromFilter($Tranfered_In->Position_AfterTransfered, $sWrk, $Tranfered_In->Position_AfterTransfered->DefaultSelectionList);
		$Tranfered_In->Position_AfterTransfered->SelectionList = $Tranfered_In->Position_AfterTransfered->DefaultSelectionList;

		// Field Transfered_Date
		$this->SetDefaultExtFilter($Tranfered_In->Transfered_Date, "USER SELECT", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Tranfered_In->Transfered_Date);
		$sWrk = "";
		$this->BuildExtendedFilter($Tranfered_In->Transfered_Date, $sWrk);
		$this->LoadSelectionFromFilter($Tranfered_In->Transfered_Date, $sWrk, $Tranfered_In->Transfered_Date->DefaultSelectionList);
		$Tranfered_In->Transfered_Date->SelectionList = $Tranfered_In->Transfered_Date->DefaultSelectionList;

		/**
		* Set up default values for popup filters
		* NOTE: if extended filter is enabled, use default values in extended filter instead
		*/
	}

	// Check if filter applied
	function CheckFilter() {
		global $Tranfered_In;

		// Check ID text filter
		if ($this->TextFilterApplied($Tranfered_In->ID))
			return TRUE;

		// Check ID popup filter
		if (!ewrpt_MatchedArray($Tranfered_In->ID->DefaultSelectionList, $Tranfered_In->ID->SelectionList))
			return TRUE;

		// Check FirstName text filter
		if ($this->TextFilterApplied($Tranfered_In->FirstName))
			return TRUE;

		// Check FirstName popup filter
		if (!ewrpt_MatchedArray($Tranfered_In->FirstName->DefaultSelectionList, $Tranfered_In->FirstName->SelectionList))
			return TRUE;

		// Check MiddelName text filter
		if ($this->TextFilterApplied($Tranfered_In->MiddelName))
			return TRUE;

		// Check MiddelName popup filter
		if (!ewrpt_MatchedArray($Tranfered_In->MiddelName->DefaultSelectionList, $Tranfered_In->MiddelName->SelectionList))
			return TRUE;

		// Check LastName text filter
		if ($this->TextFilterApplied($Tranfered_In->LastName))
			return TRUE;

		// Check LastName popup filter
		if (!ewrpt_MatchedArray($Tranfered_In->LastName->DefaultSelectionList, $Tranfered_In->LastName->SelectionList))
			return TRUE;

		// Check Position text filter
		if ($this->TextFilterApplied($Tranfered_In->Position))
			return TRUE;

		// Check Position popup filter
		if (!ewrpt_MatchedArray($Tranfered_In->Position->DefaultSelectionList, $Tranfered_In->Position->SelectionList))
			return TRUE;

		// Check FromDepartment extended filter
		if ($this->NonTextFilterApplied($Tranfered_In->FromDepartment))
			return TRUE;

		// Check FromDepartment popup filter
		if (!ewrpt_MatchedArray($Tranfered_In->FromDepartment->DefaultSelectionList, $Tranfered_In->FromDepartment->SelectionList))
			return TRUE;

		// Check ToDepartment extended filter
		if ($this->NonTextFilterApplied($Tranfered_In->ToDepartment))
			return TRUE;

		// Check ToDepartment popup filter
		if (!ewrpt_MatchedArray($Tranfered_In->ToDepartment->DefaultSelectionList, $Tranfered_In->ToDepartment->SelectionList))
			return TRUE;

		// Check Position_AfterTransfered text filter
		if ($this->TextFilterApplied($Tranfered_In->Position_AfterTransfered))
			return TRUE;

		// Check Position_AfterTransfered popup filter
		if (!ewrpt_MatchedArray($Tranfered_In->Position_AfterTransfered->DefaultSelectionList, $Tranfered_In->Position_AfterTransfered->SelectionList))
			return TRUE;

		// Check Transfered_Date text filter
		if ($this->TextFilterApplied($Tranfered_In->Transfered_Date))
			return TRUE;

		// Check Transfered_Date popup filter
		if (!ewrpt_MatchedArray($Tranfered_In->Transfered_Date->DefaultSelectionList, $Tranfered_In->Transfered_Date->SelectionList))
			return TRUE;
		return FALSE;
	}

	// Show list of filters
	function ShowFilterList() {
		global $Tranfered_In;
		global $ReportLanguage;

		// Initialize
		$sFilterList = "";

		// Field ID
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Tranfered_In->ID, $sExtWrk);
		if (is_array($Tranfered_In->ID->SelectionList))
			$sWrk = ewrpt_JoinArray($Tranfered_In->ID->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Tranfered_In->ID->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field FirstName
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Tranfered_In->FirstName, $sExtWrk);
		if (is_array($Tranfered_In->FirstName->SelectionList))
			$sWrk = ewrpt_JoinArray($Tranfered_In->FirstName->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Tranfered_In->FirstName->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field MiddelName
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Tranfered_In->MiddelName, $sExtWrk);
		if (is_array($Tranfered_In->MiddelName->SelectionList))
			$sWrk = ewrpt_JoinArray($Tranfered_In->MiddelName->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Tranfered_In->MiddelName->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field LastName
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Tranfered_In->LastName, $sExtWrk);
		if (is_array($Tranfered_In->LastName->SelectionList))
			$sWrk = ewrpt_JoinArray($Tranfered_In->LastName->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Tranfered_In->LastName->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Position
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Tranfered_In->Position, $sExtWrk);
		if (is_array($Tranfered_In->Position->SelectionList))
			$sWrk = ewrpt_JoinArray($Tranfered_In->Position->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Tranfered_In->Position->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field FromDepartment
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildDropDownFilter($Tranfered_In->FromDepartment, $sExtWrk, "");
		if (is_array($Tranfered_In->FromDepartment->SelectionList))
			$sWrk = ewrpt_JoinArray($Tranfered_In->FromDepartment->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Tranfered_In->FromDepartment->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field ToDepartment
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildDropDownFilter($Tranfered_In->ToDepartment, $sExtWrk, "");
		if (is_array($Tranfered_In->ToDepartment->SelectionList))
			$sWrk = ewrpt_JoinArray($Tranfered_In->ToDepartment->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Tranfered_In->ToDepartment->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Position_AfterTransfered
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Tranfered_In->Position_AfterTransfered, $sExtWrk);
		if (is_array($Tranfered_In->Position_AfterTransfered->SelectionList))
			$sWrk = ewrpt_JoinArray($Tranfered_In->Position_AfterTransfered->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Tranfered_In->Position_AfterTransfered->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Transfered_Date
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Tranfered_In->Transfered_Date, $sExtWrk);
		if (is_array($Tranfered_In->Transfered_Date->SelectionList))
			$sWrk = ewrpt_JoinArray($Tranfered_In->Transfered_Date->SelectionList, ", ", EWRPT_DATATYPE_DATE);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Tranfered_In->Transfered_Date->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Show Filters
		if ($sFilterList <> "")
			echo $ReportLanguage->Phrase("CurrentFilters") . "<br />$sFilterList";
	}

	// Return poup filter
	function GetPopupFilter() {
		global $Tranfered_In;
		$sWrk = "";
		if (!$this->ExtendedFilterExist($Tranfered_In->ID)) {
			if (is_array($Tranfered_In->ID->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Tranfered_In->ID, "`ID`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Tranfered_In->FirstName)) {
			if (is_array($Tranfered_In->FirstName->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Tranfered_In->FirstName, "`FirstName`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Tranfered_In->MiddelName)) {
			if (is_array($Tranfered_In->MiddelName->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Tranfered_In->MiddelName, "`MiddelName`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Tranfered_In->LastName)) {
			if (is_array($Tranfered_In->LastName->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Tranfered_In->LastName, "`LastName`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Tranfered_In->Position)) {
			if (is_array($Tranfered_In->Position->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Tranfered_In->Position, "`Position`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->DropDownFilterExist($Tranfered_In->FromDepartment, "")) {
			if (is_array($Tranfered_In->FromDepartment->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Tranfered_In->FromDepartment, "`FromDepartment`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->DropDownFilterExist($Tranfered_In->ToDepartment, "")) {
			if (is_array($Tranfered_In->ToDepartment->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Tranfered_In->ToDepartment, "`ToDepartment`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Tranfered_In->Position_AfterTransfered)) {
			if (is_array($Tranfered_In->Position_AfterTransfered->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Tranfered_In->Position_AfterTransfered, "`Position_AfterTransfered`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Tranfered_In->Transfered_Date)) {
			if (is_array($Tranfered_In->Transfered_Date->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Tranfered_In->Transfered_Date, "`Transfered_Date`", EWRPT_DATATYPE_DATE);
			}
		}
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $Tranfered_In;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$Tranfered_In->setOrderBy("");
				$Tranfered_In->setStartGroup(1);
				$Tranfered_In->ToDepartment->setSort("");
				$Tranfered_In->ID->setSort("");
				$Tranfered_In->FirstName->setSort("");
				$Tranfered_In->MiddelName->setSort("");
				$Tranfered_In->LastName->setSort("");
				$Tranfered_In->Position->setSort("");
				$Tranfered_In->FromDepartment->setSort("");
				$Tranfered_In->Position_AfterTransfered->setSort("");
				$Tranfered_In->Transfered_Date->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$Tranfered_In->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$Tranfered_In->CurrentOrderType = @$_GET["ordertype"];
			$sSortSql = $Tranfered_In->SortSql();
			$Tranfered_In->setOrderBy($sSortSql);
			$Tranfered_In->setStartGroup(1);
		}

		// Set up default sort
		if ($Tranfered_In->getOrderBy() == "") {
			$Tranfered_In->setOrderBy("`ID` ASC");
			$Tranfered_In->ID->setSort("ASC");
		}
		return $Tranfered_In->getOrderBy();
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Message Showing event
	function Message_Showing(&$msg) {

		// Example:
		//$msg = "your new message";

	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
