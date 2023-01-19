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
$Paternity_Leave = NULL;

//
// Table class for Paternity Leave
//
class crPaternity_Leave {
	var $TableVar = 'Paternity_Leave';
	var $TableName = 'Paternity Leave';
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
	var $PaternityLeaveDays;
	var $PaternityLeave_Taken_Date;
	var $ReportOn;
	var $LeaveType;
	var $Reported;
	var $Report_Back_Date;
	var $Department;
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
	function crPaternity_Leave() {
		global $ReportLanguage;

		// Auto_ID
		$this->Auto_ID = new crField('Paternity_Leave', 'Paternity Leave', 'x_Auto_ID', 'Auto_ID', '`Auto_ID`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->Auto_ID->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['Auto_ID'] =& $this->Auto_ID;
		$this->Auto_ID->DateFilter = "";
		$this->Auto_ID->SqlSelect = "";
		$this->Auto_ID->SqlOrderBy = "";
		$this->Auto_ID->FldGroupByType = "";
		$this->Auto_ID->FldGroupInt = "0";
		$this->Auto_ID->FldGroupSql = "";

		// ID
		$this->ID = new crField('Paternity_Leave', 'Paternity Leave', 'x_ID', 'ID', '`ID`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['ID'] =& $this->ID;
		$this->ID->DateFilter = "";
		$this->ID->SqlSelect = "SELECT DISTINCT `ID` FROM " . $this->SqlFrom();
		$this->ID->SqlOrderBy = "`ID`";
		$this->ID->FldGroupByType = "";
		$this->ID->FldGroupInt = "0";
		$this->ID->FldGroupSql = "";

		// FirstName
		$this->FirstName = new crField('Paternity_Leave', 'Paternity Leave', 'x_FirstName', 'FirstName', '`FirstName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['FirstName'] =& $this->FirstName;
		$this->FirstName->DateFilter = "";
		$this->FirstName->SqlSelect = "SELECT DISTINCT `FirstName` FROM " . $this->SqlFrom();
		$this->FirstName->SqlOrderBy = "`FirstName`";
		$this->FirstName->FldGroupByType = "";
		$this->FirstName->FldGroupInt = "0";
		$this->FirstName->FldGroupSql = "";

		// MiddelName
		$this->MiddelName = new crField('Paternity_Leave', 'Paternity Leave', 'x_MiddelName', 'MiddelName', '`MiddelName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['MiddelName'] =& $this->MiddelName;
		$this->MiddelName->DateFilter = "";
		$this->MiddelName->SqlSelect = "SELECT DISTINCT `MiddelName` FROM " . $this->SqlFrom();
		$this->MiddelName->SqlOrderBy = "`MiddelName`";
		$this->MiddelName->FldGroupByType = "";
		$this->MiddelName->FldGroupInt = "0";
		$this->MiddelName->FldGroupSql = "";

		// LastName
		$this->LastName = new crField('Paternity_Leave', 'Paternity Leave', 'x_LastName', 'LastName', '`LastName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['LastName'] =& $this->LastName;
		$this->LastName->DateFilter = "";
		$this->LastName->SqlSelect = "SELECT DISTINCT `LastName` FROM " . $this->SqlFrom();
		$this->LastName->SqlOrderBy = "`LastName`";
		$this->LastName->FldGroupByType = "";
		$this->LastName->FldGroupInt = "0";
		$this->LastName->FldGroupSql = "";

		// PaternityLeaveDays
		$this->PaternityLeaveDays = new crField('Paternity_Leave', 'Paternity Leave', 'x_PaternityLeaveDays', 'PaternityLeaveDays', '`PaternityLeaveDays`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->PaternityLeaveDays->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['PaternityLeaveDays'] =& $this->PaternityLeaveDays;
		$this->PaternityLeaveDays->DateFilter = "";
		$this->PaternityLeaveDays->SqlSelect = "SELECT DISTINCT `PaternityLeaveDays` FROM " . $this->SqlFrom();
		$this->PaternityLeaveDays->SqlOrderBy = "`PaternityLeaveDays`";
		$this->PaternityLeaveDays->FldGroupByType = "";
		$this->PaternityLeaveDays->FldGroupInt = "0";
		$this->PaternityLeaveDays->FldGroupSql = "";

		// PaternityLeave_Taken_Date
		$this->PaternityLeave_Taken_Date = new crField('Paternity_Leave', 'Paternity Leave', 'x_PaternityLeave_Taken_Date', 'PaternityLeave_Taken_Date', '`PaternityLeave_Taken_Date`', 133, EWRPT_DATATYPE_DATE, 5);
		$this->PaternityLeave_Taken_Date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateYMD"));
		$this->fields['PaternityLeave_Taken_Date'] =& $this->PaternityLeave_Taken_Date;
		$this->PaternityLeave_Taken_Date->DateFilter = "";
		$this->PaternityLeave_Taken_Date->SqlSelect = "SELECT DISTINCT `PaternityLeave_Taken_Date` FROM " . $this->SqlFrom();
		$this->PaternityLeave_Taken_Date->SqlOrderBy = "`PaternityLeave_Taken_Date`";
		$this->PaternityLeave_Taken_Date->FldGroupByType = "";
		$this->PaternityLeave_Taken_Date->FldGroupInt = "0";
		$this->PaternityLeave_Taken_Date->FldGroupSql = "";

		// ReportOn
		$this->ReportOn = new crField('Paternity_Leave', 'Paternity Leave', 'x_ReportOn', 'ReportOn', '`ReportOn`', 133, EWRPT_DATATYPE_DATE, 5);
		$this->ReportOn->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateYMD"));
		$this->fields['ReportOn'] =& $this->ReportOn;
		$this->ReportOn->DateFilter = "";
		$this->ReportOn->SqlSelect = "SELECT DISTINCT `ReportOn` FROM " . $this->SqlFrom();
		$this->ReportOn->SqlOrderBy = "`ReportOn`";
		$this->ReportOn->FldGroupByType = "";
		$this->ReportOn->FldGroupInt = "0";
		$this->ReportOn->FldGroupSql = "";

		// LeaveType
		$this->LeaveType = new crField('Paternity_Leave', 'Paternity Leave', 'x_LeaveType', 'LeaveType', '`LeaveType`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['LeaveType'] =& $this->LeaveType;
		$this->LeaveType->DateFilter = "";
		$this->LeaveType->SqlSelect = "";
		$this->LeaveType->SqlOrderBy = "";
		$this->LeaveType->FldGroupByType = "";
		$this->LeaveType->FldGroupInt = "0";
		$this->LeaveType->FldGroupSql = "";

		// Reported
		$this->Reported = new crField('Paternity_Leave', 'Paternity Leave', 'x_Reported', 'Reported', '`Reported`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Reported'] =& $this->Reported;
		$this->Reported->DateFilter = "";
		$this->Reported->SqlSelect = "";
		$this->Reported->SqlOrderBy = "";
		$this->Reported->FldGroupByType = "";
		$this->Reported->FldGroupInt = "0";
		$this->Reported->FldGroupSql = "";

		// Report_Back_Date
		$this->Report_Back_Date = new crField('Paternity_Leave', 'Paternity Leave', 'x_Report_Back_Date', 'Report_Back_Date', '`Report_Back_Date`', 133, EWRPT_DATATYPE_DATE, 5);
		$this->Report_Back_Date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateYMD"));
		$this->fields['Report_Back_Date'] =& $this->Report_Back_Date;
		$this->Report_Back_Date->DateFilter = "";
		$this->Report_Back_Date->SqlSelect = "";
		$this->Report_Back_Date->SqlOrderBy = "";
		$this->Report_Back_Date->FldGroupByType = "";
		$this->Report_Back_Date->FldGroupInt = "0";
		$this->Report_Back_Date->FldGroupSql = "";

		// Department
		$this->Department = new crField('Paternity_Leave', 'Paternity Leave', 'x_Department', 'Department', '`Department`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->Department->GroupingFieldId = 1;
		$this->fields['Department'] =& $this->Department;
		$this->Department->DateFilter = "";
		$this->Department->SqlSelect = "";
		$this->Department->SqlOrderBy = "";
		$this->Department->FldGroupByType = "";
		$this->Department->FldGroupInt = "0";
		$this->Department->FldGroupSql = "";
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
		return "`paternity_leave`";
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
		return "`Department` ASC";
	}

	// Table Level Group SQL
	function SqlFirstGroupField() {
		return "`Department`";
	}

	function SqlSelectGroup() {
		return "SELECT DISTINCT " . $this->SqlFirstGroupField() . " AS `Department` FROM " . $this->SqlFrom();
	}

	function SqlOrderByGroup() {
		return "`Department` ASC";
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
$Paternity_Leave_summary = new crPaternity_Leave_summary();
$Page =& $Paternity_Leave_summary;

// Page init
$Paternity_Leave_summary->Page_Init();

// Page main
$Paternity_Leave_summary->Page_Main();
?>
<?php include "phprptinc/header.php"; ?>
<?php if ($Paternity_Leave->Export == "") { ?>
<script type="text/javascript">

// Create page object
var Paternity_Leave_summary = new ewrpt_Page("Paternity_Leave_summary");

// page properties
Paternity_Leave_summary.PageID = "summary"; // page ID
Paternity_Leave_summary.FormID = "fPaternity_Leavesummaryfilter"; // form ID
var EWRPT_PAGE_ID = Paternity_Leave_summary.PageID;

// extend page with ValidateForm function
Paternity_Leave_summary.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var elm = fobj.sv1_PaternityLeaveDays;
	if (elm && !ewrpt_CheckInteger(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Paternity_Leave->PaternityLeaveDays->FldErrMsg()) ?>"))
			return false;
	}

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj)) return false;
	return true;
}

// extend page with Form_CustomValidate function
Paternity_Leave_summary.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EWRPT_CLIENT_VALIDATE) { ?>
Paternity_Leave_summary.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
Paternity_Leave_summary.ValidateRequired = false; // no JavaScript validation
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
<?php $Paternity_Leave_summary->ShowPageHeader(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php $Paternity_Leave_summary->ShowMessage(); ?>
<?php if ($Paternity_Leave->Export == "" || $Paternity_Leave->Export == "print" || $Paternity_Leave->Export == "email") { ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php } ?>
<?php if ($Paternity_Leave->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
<?php $jsdata = ewrpt_GetJsData($Paternity_Leave->ID, $Paternity_Leave->ID->FldType); ?>
ewrpt_CreatePopup("Paternity_Leave_ID", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Paternity_Leave->FirstName, $Paternity_Leave->FirstName->FldType); ?>
ewrpt_CreatePopup("Paternity_Leave_FirstName", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Paternity_Leave->MiddelName, $Paternity_Leave->MiddelName->FldType); ?>
ewrpt_CreatePopup("Paternity_Leave_MiddelName", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Paternity_Leave->LastName, $Paternity_Leave->LastName->FldType); ?>
ewrpt_CreatePopup("Paternity_Leave_LastName", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Paternity_Leave->PaternityLeaveDays, $Paternity_Leave->PaternityLeaveDays->FldType); ?>
ewrpt_CreatePopup("Paternity_Leave_PaternityLeaveDays", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Paternity_Leave->PaternityLeave_Taken_Date, $Paternity_Leave->PaternityLeave_Taken_Date->FldType); ?>
ewrpt_CreatePopup("Paternity_Leave_PaternityLeave_Taken_Date", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Paternity_Leave->ReportOn, $Paternity_Leave->ReportOn->FldType); ?>
ewrpt_CreatePopup("Paternity_Leave_ReportOn", [<?php echo $jsdata ?>]);
</script>
<div id="Paternity_Leave_ID_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Paternity_Leave_FirstName_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Paternity_Leave_MiddelName_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Paternity_Leave_LastName_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Paternity_Leave_PaternityLeaveDays_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Paternity_Leave_PaternityLeave_Taken_Date_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Paternity_Leave_ReportOn_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<?php } ?>
<?php if ($Paternity_Leave->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<?php if ($Paternity_Leave->Export == "" || $Paternity_Leave->Export == "print" || $Paternity_Leave->Export == "email") { ?>
<?php } ?>
<?php echo $Paternity_Leave->TableCaption() ?>
<?php if ($Paternity_Leave->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $Paternity_Leave_summary->ExportPrintUrl ?>"><?php echo $ReportLanguage->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $Paternity_Leave_summary->ExportExcelUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $Paternity_Leave_summary->ExportWordUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToWord") ?></a>
<?php if ($Paternity_Leave_summary->FilterApplied) { ?>
&nbsp;&nbsp;<a href="Paternity_Leavesmry.php?cmd=reset"><?php echo $ReportLanguage->Phrase("ResetAllFilter") ?></a>
<?php } ?>
<?php } ?>
<br /><br />
<?php if ($Paternity_Leave->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($Paternity_Leave->Export == "" || $Paternity_Leave->Export == "print" || $Paternity_Leave->Export == "email") { ?>
<?php } ?>
<?php if ($Paternity_Leave->Export == "") { ?>
	</div></td>
	<!-- Left Container (End) -->
	<!-- Center Container - Report (Begin) -->
	<td style="vertical-align: top;" class="ewPadding"><div id="ewCenter" class="phpreportmaker">
	<!-- center slot -->
<?php } ?>
<!-- summary report starts -->
<div id="report_summary">
<?php if ($Paternity_Leave->Export == "") { ?>
<?php
if ($Paternity_Leave->FilterPanelOption == 2 || ($Paternity_Leave->FilterPanelOption == 3 && $Paternity_Leave_summary->FilterApplied) || $Paternity_Leave_summary->Filter == "0=101") {
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
<form name="fPaternity_Leavesummaryfilter" id="fPaternity_Leavesummaryfilter" action="Paternity_Leavesmry.php" class="ewForm" onsubmit="return Paternity_Leave_summary.ValidateForm(this);">
<table class="ewRptExtFilter">
	<tr>
		<td><span class="phpreportmaker"><?php echo $Paternity_Leave->ID->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_ID" id="so1_ID" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_ID" id="sv1_ID" size="30" maxlength="7" value="<?php echo ewrpt_HtmlEncode($Paternity_Leave->ID->SearchValue) ?>"<?php echo ($Paternity_Leave_summary->ClearExtFilter == 'Paternity_Leave_ID') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Paternity_Leave->FirstName->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_FirstName" id="so1_FirstName" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_FirstName" id="sv1_FirstName" size="30" maxlength="20" value="<?php echo ewrpt_HtmlEncode($Paternity_Leave->FirstName->SearchValue) ?>"<?php echo ($Paternity_Leave_summary->ClearExtFilter == 'Paternity_Leave_FirstName') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Paternity_Leave->MiddelName->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_MiddelName" id="so1_MiddelName" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_MiddelName" id="sv1_MiddelName" size="30" maxlength="20" value="<?php echo ewrpt_HtmlEncode($Paternity_Leave->MiddelName->SearchValue) ?>"<?php echo ($Paternity_Leave_summary->ClearExtFilter == 'Paternity_Leave_MiddelName') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Paternity_Leave->LastName->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_LastName" id="so1_LastName" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_LastName" id="sv1_LastName" size="30" maxlength="20" value="<?php echo ewrpt_HtmlEncode($Paternity_Leave->LastName->SearchValue) ?>"<?php echo ($Paternity_Leave_summary->ClearExtFilter == 'Paternity_Leave_LastName') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Paternity_Leave->PaternityLeaveDays->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><select name="so1_PaternityLeaveDays" id="so1_PaternityLeaveDays" onchange="ewrpt_SrchOprChanged('so1_PaternityLeaveDays')"><option value="="<?php if ($Paternity_Leave->PaternityLeaveDays->SearchOperator == "=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("="); ?></option><option value="<>"<?php if ($Paternity_Leave->PaternityLeaveDays->SearchOperator == "<>") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<>"); ?></option><option value="<"<?php if ($Paternity_Leave->PaternityLeaveDays->SearchOperator == "<") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<"); ?></option><option value="<="<?php if ($Paternity_Leave->PaternityLeaveDays->SearchOperator == "<=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<="); ?></option><option value=">"<?php if ($Paternity_Leave->PaternityLeaveDays->SearchOperator == ">") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase(">"); ?></option><option value=">="<?php if ($Paternity_Leave->PaternityLeaveDays->SearchOperator == ">=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase(">="); ?></option><option value="BETWEEN"<?php if ($Paternity_Leave->PaternityLeaveDays->SearchOperator == "BETWEEN") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("BETWEEN"); ?></option></select></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_PaternityLeaveDays" id="sv1_PaternityLeaveDays" size="30" value="<?php echo ewrpt_HtmlEncode($Paternity_Leave->PaternityLeaveDays->SearchValue) ?>"<?php echo ($Paternity_Leave_summary->ClearExtFilter == 'Paternity_Leave_PaternityLeaveDays') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
				<td><span class="ewRptSearchOpr" style="display: none" id="btw1_PaternityLeaveDays" name="btw1_PaternityLeaveDays">&nbsp;<?php echo $ReportLanguage->Phrase("AND") ?>&nbsp;</span></td>
				<td><span class="phpreportmaker" style="display: none" id="btw1_PaternityLeaveDays" name="btw1_PaternityLeaveDays">
<input type="text" name="sv2_PaternityLeaveDays" id="sv2_PaternityLeaveDays" size="30" value="<?php echo ewrpt_HtmlEncode($Paternity_Leave->PaternityLeaveDays->SearchValue2) ?>"<?php echo ($Paternity_Leave_summary->ClearExtFilter == 'Paternity_Leave_PaternityLeaveDays') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Paternity_Leave->PaternityLeave_Taken_Date->FldCaption() ?></span></td>
		<td></td>
		<td colspan="4"><span class="ewRptSearchOpr">
		<select name="sv_PaternityLeave_Taken_Date[]" id="sv_PaternityLeave_Taken_Date[]" multiple<?php echo ($Paternity_Leave_summary->ClearExtFilter == 'Paternity_Leave_PaternityLeave_Taken_Date') ? " class=\"ewInputCleared\"" : "" ?>>
		<option value="<?php echo EWRPT_ALL_VALUE; ?>"<?php if (ewrpt_MatchedFilterValue($Paternity_Leave->PaternityLeave_Taken_Date->DropDownValue, EWRPT_ALL_VALUE)) echo " selected=\"selected\""; ?>><?php echo $ReportLanguage->Phrase("SelectAll"); ?></option>
<?php

// Popup filter
$cntf = is_array($Paternity_Leave->PaternityLeave_Taken_Date->CustomFilters) ? count($Paternity_Leave->PaternityLeave_Taken_Date->CustomFilters) : 0;
$cntd = is_array($Paternity_Leave->PaternityLeave_Taken_Date->DropDownList) ? count($Paternity_Leave->PaternityLeave_Taken_Date->DropDownList) : 0;
$totcnt = $cntf + $cntd;
$wrkcnt = 0;
	for ($i = 0; $i < $cntf; $i++) {
		if ($Paternity_Leave->PaternityLeave_Taken_Date->CustomFilters[$i]->FldName == 'PaternityLeave_Taken_Date') {
?>
		<option value="<?php echo "@@" . $Paternity_Leave->PaternityLeave_Taken_Date->CustomFilters[$i]->FilterName ?>"<?php if (ewrpt_MatchedFilterValue($Paternity_Leave->PaternityLeave_Taken_Date->DropDownValue, "@@" . $Paternity_Leave->PaternityLeave_Taken_Date->CustomFilters[$i]->FilterName)) echo " selected=\"selected\"" ?>><?php echo $Paternity_Leave->PaternityLeave_Taken_Date->CustomFilters[$i]->DisplayName ?></option>
<?php
		}
		$wrkcnt += 1;
	}

//}
	for ($i = 0; $i < $cntd; $i++) {
?>
		<option value="<?php echo $Paternity_Leave->PaternityLeave_Taken_Date->DropDownList[$i] ?>"<?php if (ewrpt_MatchedFilterValue($Paternity_Leave->PaternityLeave_Taken_Date->DropDownValue, $Paternity_Leave->PaternityLeave_Taken_Date->DropDownList[$i])) echo " selected=\"selected\"" ?>><?php echo ewrpt_DropDownDisplayValue($Paternity_Leave->PaternityLeave_Taken_Date->DropDownList[$i], "date", 5) ?></option>
<?php
		$wrkcnt += 1;
	}

//}
?>
		</select>
		</span></td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Paternity_Leave->ReportOn->FldCaption() ?></span></td>
		<td></td>
		<td colspan="4"><span class="ewRptSearchOpr">
		<select name="sv_ReportOn[]" id="sv_ReportOn[]" multiple<?php echo ($Paternity_Leave_summary->ClearExtFilter == 'Paternity_Leave_ReportOn') ? " class=\"ewInputCleared\"" : "" ?>>
		<option value="<?php echo EWRPT_ALL_VALUE; ?>"<?php if (ewrpt_MatchedFilterValue($Paternity_Leave->ReportOn->DropDownValue, EWRPT_ALL_VALUE)) echo " selected=\"selected\""; ?>><?php echo $ReportLanguage->Phrase("SelectAll"); ?></option>
<?php

// Popup filter
$cntf = is_array($Paternity_Leave->ReportOn->CustomFilters) ? count($Paternity_Leave->ReportOn->CustomFilters) : 0;
$cntd = is_array($Paternity_Leave->ReportOn->DropDownList) ? count($Paternity_Leave->ReportOn->DropDownList) : 0;
$totcnt = $cntf + $cntd;
$wrkcnt = 0;
	for ($i = 0; $i < $cntf; $i++) {
		if ($Paternity_Leave->ReportOn->CustomFilters[$i]->FldName == 'ReportOn') {
?>
		<option value="<?php echo "@@" . $Paternity_Leave->ReportOn->CustomFilters[$i]->FilterName ?>"<?php if (ewrpt_MatchedFilterValue($Paternity_Leave->ReportOn->DropDownValue, "@@" . $Paternity_Leave->ReportOn->CustomFilters[$i]->FilterName)) echo " selected=\"selected\"" ?>><?php echo $Paternity_Leave->ReportOn->CustomFilters[$i]->DisplayName ?></option>
<?php
		}
		$wrkcnt += 1;
	}

//}
	for ($i = 0; $i < $cntd; $i++) {
?>
		<option value="<?php echo $Paternity_Leave->ReportOn->DropDownList[$i] ?>"<?php if (ewrpt_MatchedFilterValue($Paternity_Leave->ReportOn->DropDownValue, $Paternity_Leave->ReportOn->DropDownList[$i])) echo " selected=\"selected\"" ?>><?php echo ewrpt_DropDownDisplayValue($Paternity_Leave->ReportOn->DropDownList[$i], "date", 5) ?></option>
<?php
		$wrkcnt += 1;
	}

//}
?>
		</select>
		</span></td>
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
ewrpt_SrchOprChanged('so1_PaternityLeaveDays');
</script>
<!-- Search form (end) -->
</div>
<br />
<?php } ?>
<?php if ($Paternity_Leave->ShowCurrentFilter) { ?>
<div id="ewrptFilterList">
<?php $Paternity_Leave_summary->ShowFilterList() ?>
</div>
<br />
<?php } ?>
<table class="ewGrid" cellspacing="0"><tr>
	<td class="ewGridContent">
<?php if ($Paternity_Leave->Export == "") { ?>
<div class="ewGridUpperPanel">
<form action="Paternity_Leavesmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($Paternity_Leave_summary->StartGrp, $Paternity_Leave_summary->DisplayGrps, $Paternity_Leave_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="Paternity_Leavesmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="Paternity_Leavesmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="Paternity_Leavesmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="Paternity_Leavesmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($Paternity_Leave_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($Paternity_Leave_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($Paternity_Leave_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($Paternity_Leave_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($Paternity_Leave_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($Paternity_Leave_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($Paternity_Leave_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($Paternity_Leave_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($Paternity_Leave_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($Paternity_Leave_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($Paternity_Leave->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
if ($Paternity_Leave->ExportAll && $Paternity_Leave->Export <> "") {
	$Paternity_Leave_summary->StopGrp = $Paternity_Leave_summary->TotalGrps;
} else {
	$Paternity_Leave_summary->StopGrp = $Paternity_Leave_summary->StartGrp + $Paternity_Leave_summary->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($Paternity_Leave_summary->StopGrp) > intval($Paternity_Leave_summary->TotalGrps))
	$Paternity_Leave_summary->StopGrp = $Paternity_Leave_summary->TotalGrps;
$Paternity_Leave_summary->RecCount = 0;

// Get first row
if ($Paternity_Leave_summary->TotalGrps > 0) {
	$Paternity_Leave_summary->GetGrpRow(1);
	$Paternity_Leave_summary->GrpCount = 1;
}
while (($rsgrp && !$rsgrp->EOF && $Paternity_Leave_summary->GrpCount <= $Paternity_Leave_summary->DisplayGrps) || $Paternity_Leave_summary->ShowFirstHeader) {

	// Show header
	if ($Paternity_Leave_summary->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Paternity_Leave->SortUrl($Paternity_Leave->Department) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Paternity_Leave->Department->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Paternity_Leave->SortUrl($Paternity_Leave->Department) ?>',0);"><?php echo $Paternity_Leave->Department->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Paternity_Leave->Department->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Paternity_Leave->Department->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Paternity_Leave->SortUrl($Paternity_Leave->ID) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Paternity_Leave->ID->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Paternity_Leave->SortUrl($Paternity_Leave->ID) ?>',0);"><?php echo $Paternity_Leave->ID->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Paternity_Leave->ID->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Paternity_Leave->ID->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Paternity_Leave->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Paternity_Leave_ID', false, '<?php echo $Paternity_Leave->ID->RangeFrom; ?>', '<?php echo $Paternity_Leave->ID->RangeTo; ?>');return false;" name="x_ID<?php echo $Paternity_Leave_summary->Cnt[0][0]; ?>" id="x_ID<?php echo $Paternity_Leave_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Paternity_Leave->SortUrl($Paternity_Leave->FirstName) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Paternity_Leave->FirstName->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Paternity_Leave->SortUrl($Paternity_Leave->FirstName) ?>',0);"><?php echo $Paternity_Leave->FirstName->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Paternity_Leave->FirstName->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Paternity_Leave->FirstName->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Paternity_Leave->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Paternity_Leave_FirstName', false, '<?php echo $Paternity_Leave->FirstName->RangeFrom; ?>', '<?php echo $Paternity_Leave->FirstName->RangeTo; ?>');return false;" name="x_FirstName<?php echo $Paternity_Leave_summary->Cnt[0][0]; ?>" id="x_FirstName<?php echo $Paternity_Leave_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Paternity_Leave->SortUrl($Paternity_Leave->MiddelName) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Paternity_Leave->MiddelName->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Paternity_Leave->SortUrl($Paternity_Leave->MiddelName) ?>',0);"><?php echo $Paternity_Leave->MiddelName->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Paternity_Leave->MiddelName->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Paternity_Leave->MiddelName->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Paternity_Leave->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Paternity_Leave_MiddelName', false, '<?php echo $Paternity_Leave->MiddelName->RangeFrom; ?>', '<?php echo $Paternity_Leave->MiddelName->RangeTo; ?>');return false;" name="x_MiddelName<?php echo $Paternity_Leave_summary->Cnt[0][0]; ?>" id="x_MiddelName<?php echo $Paternity_Leave_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Paternity_Leave->SortUrl($Paternity_Leave->LastName) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Paternity_Leave->LastName->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Paternity_Leave->SortUrl($Paternity_Leave->LastName) ?>',0);"><?php echo $Paternity_Leave->LastName->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Paternity_Leave->LastName->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Paternity_Leave->LastName->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Paternity_Leave->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Paternity_Leave_LastName', false, '<?php echo $Paternity_Leave->LastName->RangeFrom; ?>', '<?php echo $Paternity_Leave->LastName->RangeTo; ?>');return false;" name="x_LastName<?php echo $Paternity_Leave_summary->Cnt[0][0]; ?>" id="x_LastName<?php echo $Paternity_Leave_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Paternity_Leave->SortUrl($Paternity_Leave->PaternityLeaveDays) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Paternity_Leave->PaternityLeaveDays->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Paternity_Leave->SortUrl($Paternity_Leave->PaternityLeaveDays) ?>',0);"><?php echo $Paternity_Leave->PaternityLeaveDays->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Paternity_Leave->PaternityLeaveDays->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Paternity_Leave->PaternityLeaveDays->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Paternity_Leave->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Paternity_Leave_PaternityLeaveDays', false, '<?php echo $Paternity_Leave->PaternityLeaveDays->RangeFrom; ?>', '<?php echo $Paternity_Leave->PaternityLeaveDays->RangeTo; ?>');return false;" name="x_PaternityLeaveDays<?php echo $Paternity_Leave_summary->Cnt[0][0]; ?>" id="x_PaternityLeaveDays<?php echo $Paternity_Leave_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Paternity_Leave->SortUrl($Paternity_Leave->PaternityLeave_Taken_Date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Paternity_Leave->PaternityLeave_Taken_Date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Paternity_Leave->SortUrl($Paternity_Leave->PaternityLeave_Taken_Date) ?>',0);"><?php echo $Paternity_Leave->PaternityLeave_Taken_Date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Paternity_Leave->PaternityLeave_Taken_Date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Paternity_Leave->PaternityLeave_Taken_Date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Paternity_Leave->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Paternity_Leave_PaternityLeave_Taken_Date', false, '<?php echo $Paternity_Leave->PaternityLeave_Taken_Date->RangeFrom; ?>', '<?php echo $Paternity_Leave->PaternityLeave_Taken_Date->RangeTo; ?>');return false;" name="x_PaternityLeave_Taken_Date<?php echo $Paternity_Leave_summary->Cnt[0][0]; ?>" id="x_PaternityLeave_Taken_Date<?php echo $Paternity_Leave_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Paternity_Leave->SortUrl($Paternity_Leave->ReportOn) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Paternity_Leave->ReportOn->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Paternity_Leave->SortUrl($Paternity_Leave->ReportOn) ?>',0);"><?php echo $Paternity_Leave->ReportOn->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Paternity_Leave->ReportOn->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Paternity_Leave->ReportOn->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Paternity_Leave->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Paternity_Leave_ReportOn', false, '<?php echo $Paternity_Leave->ReportOn->RangeFrom; ?>', '<?php echo $Paternity_Leave->ReportOn->RangeTo; ?>');return false;" name="x_ReportOn<?php echo $Paternity_Leave_summary->Cnt[0][0]; ?>" id="x_ReportOn<?php echo $Paternity_Leave_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$Paternity_Leave_summary->ShowFirstHeader = FALSE;
	}

	// Build detail SQL
	$sWhere = ewrpt_DetailFilterSQL($Paternity_Leave->Department, $Paternity_Leave->SqlFirstGroupField(), $Paternity_Leave->Department->GroupValue());
	if ($Paternity_Leave_summary->Filter != "")
		$sWhere = "($Paternity_Leave_summary->Filter) AND ($sWhere)";
	$sSql = ewrpt_BuildReportSql($Paternity_Leave->SqlSelect(), $Paternity_Leave->SqlWhere(), $Paternity_Leave->SqlGroupBy(), $Paternity_Leave->SqlHaving(), $Paternity_Leave->SqlOrderBy(), $sWhere, $Paternity_Leave_summary->Sort);
	$rs = $conn->Execute($sSql);
	$rsdtlcnt = ($rs) ? $rs->RecordCount() : 0;
	if ($rsdtlcnt > 0)
		$Paternity_Leave_summary->GetRow(1);
	while ($rs && !$rs->EOF) { // Loop detail records
		$Paternity_Leave_summary->RecCount++;

		// Render detail row
		$Paternity_Leave->ResetCSS();
		$Paternity_Leave->RowType = EWRPT_ROWTYPE_DETAIL;
		$Paternity_Leave_summary->RenderRow();
?>
	<tr<?php echo $Paternity_Leave->RowAttributes(); ?>>
		<td<?php echo $Paternity_Leave->Department->CellAttributes(); ?>><div<?php echo $Paternity_Leave->Department->ViewAttributes(); ?>><?php echo $Paternity_Leave->Department->GroupViewValue; ?></div></td>
		<td<?php echo $Paternity_Leave->ID->CellAttributes() ?>>
<div<?php echo $Paternity_Leave->ID->ViewAttributes(); ?>><?php echo $Paternity_Leave->ID->ListViewValue(); ?></div>
</td>
		<td<?php echo $Paternity_Leave->FirstName->CellAttributes() ?>>
<div<?php echo $Paternity_Leave->FirstName->ViewAttributes(); ?>><?php echo $Paternity_Leave->FirstName->ListViewValue(); ?></div>
</td>
		<td<?php echo $Paternity_Leave->MiddelName->CellAttributes() ?>>
<div<?php echo $Paternity_Leave->MiddelName->ViewAttributes(); ?>><?php echo $Paternity_Leave->MiddelName->ListViewValue(); ?></div>
</td>
		<td<?php echo $Paternity_Leave->LastName->CellAttributes() ?>>
<div<?php echo $Paternity_Leave->LastName->ViewAttributes(); ?>><?php echo $Paternity_Leave->LastName->ListViewValue(); ?></div>
</td>
		<td<?php echo $Paternity_Leave->PaternityLeaveDays->CellAttributes() ?>>
<div<?php echo $Paternity_Leave->PaternityLeaveDays->ViewAttributes(); ?>><?php echo $Paternity_Leave->PaternityLeaveDays->ListViewValue(); ?></div>
</td>
		<td<?php echo $Paternity_Leave->PaternityLeave_Taken_Date->CellAttributes() ?>>
<div<?php echo $Paternity_Leave->PaternityLeave_Taken_Date->ViewAttributes(); ?>><?php echo $Paternity_Leave->PaternityLeave_Taken_Date->ListViewValue(); ?></div>
</td>
		<td<?php echo $Paternity_Leave->ReportOn->CellAttributes() ?>>
<div<?php echo $Paternity_Leave->ReportOn->ViewAttributes(); ?>><?php echo $Paternity_Leave->ReportOn->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$Paternity_Leave_summary->AccumulateSummary();

		// Get next record
		$Paternity_Leave_summary->GetRow(2);

		// Show Footers
?>
<?php
	} // End detail records loop
?>
<?php

	// Next group
	$Paternity_Leave_summary->GetGrpRow(2);
	$Paternity_Leave_summary->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
<?php
if ($Paternity_Leave_summary->TotalGrps > 0) {
	$Paternity_Leave->ResetCSS();
	$Paternity_Leave->RowType = EWRPT_ROWTYPE_TOTAL;
	$Paternity_Leave->RowTotalType = EWRPT_ROWTOTAL_GRAND;
	$Paternity_Leave->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
	$Paternity_Leave->RowAttrs["class"] = "ewRptGrandSummary";
	$Paternity_Leave_summary->RenderRow();
?>
	<!-- tr><td colspan="8"><span class="phpreportmaker">&nbsp;<br /></span></td></tr -->
	<tr<?php echo $Paternity_Leave->RowAttributes(); ?>><td colspan="8"><?php echo $ReportLanguage->Phrase("RptGrandTotal") ?> (<?php echo ewrpt_FormatNumber($Paternity_Leave_summary->TotCount,0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php } ?>
	</tfoot>
</table>
</div>
<?php if ($Paternity_Leave_summary->TotalGrps > 0) { ?>
<?php if ($Paternity_Leave->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="Paternity_Leavesmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($Paternity_Leave_summary->StartGrp, $Paternity_Leave_summary->DisplayGrps, $Paternity_Leave_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="Paternity_Leavesmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="Paternity_Leavesmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="Paternity_Leavesmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="Paternity_Leavesmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($Paternity_Leave_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($Paternity_Leave_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($Paternity_Leave_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($Paternity_Leave_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($Paternity_Leave_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($Paternity_Leave_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($Paternity_Leave_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($Paternity_Leave_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($Paternity_Leave_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($Paternity_Leave_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($Paternity_Leave->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php if ($Paternity_Leave->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($Paternity_Leave->Export == "" || $Paternity_Leave->Export == "print" || $Paternity_Leave->Export == "email") { ?>
<?php } ?>
<?php if ($Paternity_Leave->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($Paternity_Leave->Export == "" || $Paternity_Leave->Export == "print" || $Paternity_Leave->Export == "email") { ?>
<?php } ?>
<?php if ($Paternity_Leave->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $Paternity_Leave_summary->ShowPageFooter(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($Paternity_Leave->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "phprptinc/footer.php"; ?>
<?php
$Paternity_Leave_summary->Page_Terminate();
?>
<?php

//
// Page class
//
class crPaternity_Leave_summary {

	// Page ID
	var $PageID = 'summary';

	// Table name
	var $TableName = 'Paternity Leave';

	// Page object name
	var $PageObjName = 'Paternity_Leave_summary';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $Paternity_Leave;
		if ($Paternity_Leave->UseTokenInUrl) $PageUrl .= "t=" . $Paternity_Leave->TableVar . "&"; // Add page token
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
		global $Paternity_Leave;
		if ($Paternity_Leave->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($Paternity_Leave->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($Paternity_Leave->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crPaternity_Leave_summary() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (Paternity_Leave)
		$GLOBALS["Paternity_Leave"] = new crPaternity_Leave();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'summary', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'Paternity Leave', TRUE);

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
		global $Paternity_Leave;

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$Paternity_Leave->Export = $_GET["export"];
	}
	$gsExport = $Paternity_Leave->Export; // Get export parameter, used in header
	$gsExportFile = $Paternity_Leave->TableVar; // Get export file, used in header
	if ($Paternity_Leave->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($Paternity_Leave->Export == "word") {
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
		global $Paternity_Leave;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($Paternity_Leave->Export == "email") {
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
		global $Paternity_Leave;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 8;
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
		$this->Col = array(FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE);

		// Set up groups per page dynamically
		$this->SetUpDisplayGrps();
		$Paternity_Leave->ID->SelectionList = "";
		$Paternity_Leave->ID->DefaultSelectionList = "";
		$Paternity_Leave->ID->ValueList = "";
		$Paternity_Leave->FirstName->SelectionList = "";
		$Paternity_Leave->FirstName->DefaultSelectionList = "";
		$Paternity_Leave->FirstName->ValueList = "";
		$Paternity_Leave->MiddelName->SelectionList = "";
		$Paternity_Leave->MiddelName->DefaultSelectionList = "";
		$Paternity_Leave->MiddelName->ValueList = "";
		$Paternity_Leave->LastName->SelectionList = "";
		$Paternity_Leave->LastName->DefaultSelectionList = "";
		$Paternity_Leave->LastName->ValueList = "";
		$Paternity_Leave->PaternityLeaveDays->SelectionList = "";
		$Paternity_Leave->PaternityLeaveDays->DefaultSelectionList = "";
		$Paternity_Leave->PaternityLeaveDays->ValueList = "";
		$Paternity_Leave->PaternityLeave_Taken_Date->SelectionList = "";
		$Paternity_Leave->PaternityLeave_Taken_Date->DefaultSelectionList = "";
		$Paternity_Leave->PaternityLeave_Taken_Date->ValueList = "";
		$Paternity_Leave->ReportOn->SelectionList = "";
		$Paternity_Leave->ReportOn->DefaultSelectionList = "";
		$Paternity_Leave->ReportOn->ValueList = "";

		// Load default filter values
		$this->LoadDefaultFilters();

		// Set up popup filter
		$this->SetupPopup();

		// Extended filter
		$sExtendedFilter = "";

		// Get dropdown values
		$this->GetExtendedFilterValues();

		// Load custom filters
		$Paternity_Leave->CustomFilters_Load();

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
		$sGrpSort = ewrpt_UpdateSortFields($Paternity_Leave->SqlOrderByGroup(), $this->Sort, 2); // Get grouping field only
		$sSql = ewrpt_BuildReportSql($Paternity_Leave->SqlSelectGroup(), $Paternity_Leave->SqlWhere(), $Paternity_Leave->SqlGroupBy(), $Paternity_Leave->SqlHaving(), $Paternity_Leave->SqlOrderByGroup(), $this->Filter, $sGrpSort);
		$this->TotalGrps = $this->GetGrpCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($Paternity_Leave->ExportAll && $Paternity_Leave->Export <> "")
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
		global $Paternity_Leave;
		switch ($lvl) {
			case 1:
				return (is_null($Paternity_Leave->Department->CurrentValue) && !is_null($Paternity_Leave->Department->OldValue)) ||
					(!is_null($Paternity_Leave->Department->CurrentValue) && is_null($Paternity_Leave->Department->OldValue)) ||
					($Paternity_Leave->Department->GroupValue() <> $Paternity_Leave->Department->GroupOldValue());
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
		global $Paternity_Leave;
		$rsgrpcnt = $conn->Execute($sql);
		$grpcnt = ($rsgrpcnt) ? $rsgrpcnt->RecordCount() : 0;
		if ($rsgrpcnt) $rsgrpcnt->Close();
		return $grpcnt;
	}

	// Get group rs
	function GetGrpRs($sql, $start, $grps) {
		global $conn;
		global $Paternity_Leave;
		$wrksql = $sql;
		if ($start > 0 && $grps > -1)
			$wrksql .= " LIMIT " . ($start-1) . ", " . ($grps);
		$rswrk = $conn->Execute($wrksql);
		return $rswrk;
	}

	// Get group row values
	function GetGrpRow($opt) {
		global $rsgrp;
		global $Paternity_Leave;
		if (!$rsgrp)
			return;
		if ($opt == 1) { // Get first group

			//$rsgrp->MoveFirst(); // NOTE: no need to move position
			$Paternity_Leave->Department->setDbValue(""); // Init first value
		} else { // Get next group
			$rsgrp->MoveNext();
		}
		if (!$rsgrp->EOF)
			$Paternity_Leave->Department->setDbValue($rsgrp->fields('Department'));
		if ($rsgrp->EOF) {
			$Paternity_Leave->Department->setDbValue("");
		}
	}

	// Get row values
	function GetRow($opt) {
		global $rs;
		global $Paternity_Leave;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$Paternity_Leave->Auto_ID->setDbValue($rs->fields('Auto_ID'));
			$Paternity_Leave->ID->setDbValue($rs->fields('ID'));
			$Paternity_Leave->FirstName->setDbValue($rs->fields('FirstName'));
			$Paternity_Leave->MiddelName->setDbValue($rs->fields('MiddelName'));
			$Paternity_Leave->LastName->setDbValue($rs->fields('LastName'));
			$Paternity_Leave->PaternityLeaveDays->setDbValue($rs->fields('PaternityLeaveDays'));
			$Paternity_Leave->PaternityLeave_Taken_Date->setDbValue($rs->fields('PaternityLeave_Taken_Date'));
			$Paternity_Leave->ReportOn->setDbValue($rs->fields('ReportOn'));
			$Paternity_Leave->LeaveType->setDbValue($rs->fields('LeaveType'));
			$Paternity_Leave->Reported->setDbValue($rs->fields('Reported'));
			$Paternity_Leave->Report_Back_Date->setDbValue($rs->fields('Report_Back_Date'));
			if ($opt <> 1)
				$Paternity_Leave->Department->setDbValue($rs->fields('Department'));
			$this->Val[1] = $Paternity_Leave->ID->CurrentValue;
			$this->Val[2] = $Paternity_Leave->FirstName->CurrentValue;
			$this->Val[3] = $Paternity_Leave->MiddelName->CurrentValue;
			$this->Val[4] = $Paternity_Leave->LastName->CurrentValue;
			$this->Val[5] = $Paternity_Leave->PaternityLeaveDays->CurrentValue;
			$this->Val[6] = $Paternity_Leave->PaternityLeave_Taken_Date->CurrentValue;
			$this->Val[7] = $Paternity_Leave->ReportOn->CurrentValue;
		} else {
			$Paternity_Leave->Auto_ID->setDbValue("");
			$Paternity_Leave->ID->setDbValue("");
			$Paternity_Leave->FirstName->setDbValue("");
			$Paternity_Leave->MiddelName->setDbValue("");
			$Paternity_Leave->LastName->setDbValue("");
			$Paternity_Leave->PaternityLeaveDays->setDbValue("");
			$Paternity_Leave->PaternityLeave_Taken_Date->setDbValue("");
			$Paternity_Leave->ReportOn->setDbValue("");
			$Paternity_Leave->LeaveType->setDbValue("");
			$Paternity_Leave->Reported->setDbValue("");
			$Paternity_Leave->Report_Back_Date->setDbValue("");
			$Paternity_Leave->Department->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $Paternity_Leave;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$Paternity_Leave->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$Paternity_Leave->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $Paternity_Leave->getStartGroup();
			}
		} else {
			$this->StartGrp = $Paternity_Leave->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$Paternity_Leave->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$Paternity_Leave->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$Paternity_Leave->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $Paternity_Leave;

		// Initialize popup
		// Build distinct values for ID

		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Paternity_Leave->ID->SqlSelect, $Paternity_Leave->SqlWhere(), $Paternity_Leave->SqlGroupBy(), $Paternity_Leave->SqlHaving(), $Paternity_Leave->ID->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Paternity_Leave->ID->setDbValue($rswrk->fields[0]);
			if (is_null($Paternity_Leave->ID->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Paternity_Leave->ID->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Paternity_Leave->ID->ViewValue = $Paternity_Leave->ID->CurrentValue;
				ewrpt_SetupDistinctValues($Paternity_Leave->ID->ValueList, $Paternity_Leave->ID->CurrentValue, $Paternity_Leave->ID->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Paternity_Leave->ID->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Paternity_Leave->ID->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for FirstName
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Paternity_Leave->FirstName->SqlSelect, $Paternity_Leave->SqlWhere(), $Paternity_Leave->SqlGroupBy(), $Paternity_Leave->SqlHaving(), $Paternity_Leave->FirstName->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Paternity_Leave->FirstName->setDbValue($rswrk->fields[0]);
			if (is_null($Paternity_Leave->FirstName->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Paternity_Leave->FirstName->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Paternity_Leave->FirstName->ViewValue = $Paternity_Leave->FirstName->CurrentValue;
				ewrpt_SetupDistinctValues($Paternity_Leave->FirstName->ValueList, $Paternity_Leave->FirstName->CurrentValue, $Paternity_Leave->FirstName->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Paternity_Leave->FirstName->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Paternity_Leave->FirstName->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for MiddelName
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Paternity_Leave->MiddelName->SqlSelect, $Paternity_Leave->SqlWhere(), $Paternity_Leave->SqlGroupBy(), $Paternity_Leave->SqlHaving(), $Paternity_Leave->MiddelName->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Paternity_Leave->MiddelName->setDbValue($rswrk->fields[0]);
			if (is_null($Paternity_Leave->MiddelName->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Paternity_Leave->MiddelName->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Paternity_Leave->MiddelName->ViewValue = $Paternity_Leave->MiddelName->CurrentValue;
				ewrpt_SetupDistinctValues($Paternity_Leave->MiddelName->ValueList, $Paternity_Leave->MiddelName->CurrentValue, $Paternity_Leave->MiddelName->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Paternity_Leave->MiddelName->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Paternity_Leave->MiddelName->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for LastName
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Paternity_Leave->LastName->SqlSelect, $Paternity_Leave->SqlWhere(), $Paternity_Leave->SqlGroupBy(), $Paternity_Leave->SqlHaving(), $Paternity_Leave->LastName->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Paternity_Leave->LastName->setDbValue($rswrk->fields[0]);
			if (is_null($Paternity_Leave->LastName->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Paternity_Leave->LastName->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Paternity_Leave->LastName->ViewValue = $Paternity_Leave->LastName->CurrentValue;
				ewrpt_SetupDistinctValues($Paternity_Leave->LastName->ValueList, $Paternity_Leave->LastName->CurrentValue, $Paternity_Leave->LastName->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Paternity_Leave->LastName->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Paternity_Leave->LastName->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for PaternityLeaveDays
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Paternity_Leave->PaternityLeaveDays->SqlSelect, $Paternity_Leave->SqlWhere(), $Paternity_Leave->SqlGroupBy(), $Paternity_Leave->SqlHaving(), $Paternity_Leave->PaternityLeaveDays->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Paternity_Leave->PaternityLeaveDays->setDbValue($rswrk->fields[0]);
			if (is_null($Paternity_Leave->PaternityLeaveDays->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Paternity_Leave->PaternityLeaveDays->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Paternity_Leave->PaternityLeaveDays->ViewValue = $Paternity_Leave->PaternityLeaveDays->CurrentValue;
				ewrpt_SetupDistinctValues($Paternity_Leave->PaternityLeaveDays->ValueList, $Paternity_Leave->PaternityLeaveDays->CurrentValue, $Paternity_Leave->PaternityLeaveDays->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Paternity_Leave->PaternityLeaveDays->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Paternity_Leave->PaternityLeaveDays->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for PaternityLeave_Taken_Date
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Paternity_Leave->PaternityLeave_Taken_Date->SqlSelect, $Paternity_Leave->SqlWhere(), $Paternity_Leave->SqlGroupBy(), $Paternity_Leave->SqlHaving(), $Paternity_Leave->PaternityLeave_Taken_Date->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Paternity_Leave->PaternityLeave_Taken_Date->setDbValue($rswrk->fields[0]);
			if (is_null($Paternity_Leave->PaternityLeave_Taken_Date->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Paternity_Leave->PaternityLeave_Taken_Date->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Paternity_Leave->PaternityLeave_Taken_Date->ViewValue = ewrpt_FormatDateTime($Paternity_Leave->PaternityLeave_Taken_Date->CurrentValue, 5);
				ewrpt_SetupDistinctValues($Paternity_Leave->PaternityLeave_Taken_Date->ValueList, $Paternity_Leave->PaternityLeave_Taken_Date->CurrentValue, $Paternity_Leave->PaternityLeave_Taken_Date->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Paternity_Leave->PaternityLeave_Taken_Date->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Paternity_Leave->PaternityLeave_Taken_Date->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for ReportOn
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Paternity_Leave->ReportOn->SqlSelect, $Paternity_Leave->SqlWhere(), $Paternity_Leave->SqlGroupBy(), $Paternity_Leave->SqlHaving(), $Paternity_Leave->ReportOn->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Paternity_Leave->ReportOn->setDbValue($rswrk->fields[0]);
			if (is_null($Paternity_Leave->ReportOn->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Paternity_Leave->ReportOn->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Paternity_Leave->ReportOn->ViewValue = ewrpt_FormatDateTime($Paternity_Leave->ReportOn->CurrentValue, 5);
				ewrpt_SetupDistinctValues($Paternity_Leave->ReportOn->ValueList, $Paternity_Leave->ReportOn->CurrentValue, $Paternity_Leave->ReportOn->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Paternity_Leave->ReportOn->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Paternity_Leave->ReportOn->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

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
				$this->ClearSessionSelection('ID');
				$this->ClearSessionSelection('FirstName');
				$this->ClearSessionSelection('MiddelName');
				$this->ClearSessionSelection('LastName');
				$this->ClearSessionSelection('PaternityLeaveDays');
				$this->ClearSessionSelection('PaternityLeave_Taken_Date');
				$this->ClearSessionSelection('ReportOn');
				$this->ResetPager();
			}
		}

		// Load selection criteria to array
		// Get ID selected values

		if (is_array(@$_SESSION["sel_Paternity_Leave_ID"])) {
			$this->LoadSelectionFromSession('ID');
		} elseif (@$_SESSION["sel_Paternity_Leave_ID"] == EWRPT_INIT_VALUE) { // Select all
			$Paternity_Leave->ID->SelectionList = "";
		}

		// Get First Name selected values
		if (is_array(@$_SESSION["sel_Paternity_Leave_FirstName"])) {
			$this->LoadSelectionFromSession('FirstName');
		} elseif (@$_SESSION["sel_Paternity_Leave_FirstName"] == EWRPT_INIT_VALUE) { // Select all
			$Paternity_Leave->FirstName->SelectionList = "";
		}

		// Get Middel Name selected values
		if (is_array(@$_SESSION["sel_Paternity_Leave_MiddelName"])) {
			$this->LoadSelectionFromSession('MiddelName');
		} elseif (@$_SESSION["sel_Paternity_Leave_MiddelName"] == EWRPT_INIT_VALUE) { // Select all
			$Paternity_Leave->MiddelName->SelectionList = "";
		}

		// Get Last Name selected values
		if (is_array(@$_SESSION["sel_Paternity_Leave_LastName"])) {
			$this->LoadSelectionFromSession('LastName');
		} elseif (@$_SESSION["sel_Paternity_Leave_LastName"] == EWRPT_INIT_VALUE) { // Select all
			$Paternity_Leave->LastName->SelectionList = "";
		}

		// Get Paternity Leave Days selected values
		if (is_array(@$_SESSION["sel_Paternity_Leave_PaternityLeaveDays"])) {
			$this->LoadSelectionFromSession('PaternityLeaveDays');
		} elseif (@$_SESSION["sel_Paternity_Leave_PaternityLeaveDays"] == EWRPT_INIT_VALUE) { // Select all
			$Paternity_Leave->PaternityLeaveDays->SelectionList = "";
		}

		// Get Paternity Leave Taken Date selected values
		if (is_array(@$_SESSION["sel_Paternity_Leave_PaternityLeave_Taken_Date"])) {
			$this->LoadSelectionFromSession('PaternityLeave_Taken_Date');
		} elseif (@$_SESSION["sel_Paternity_Leave_PaternityLeave_Taken_Date"] == EWRPT_INIT_VALUE) { // Select all
			$Paternity_Leave->PaternityLeave_Taken_Date->SelectionList = "";
		}

		// Get Report On selected values
		if (is_array(@$_SESSION["sel_Paternity_Leave_ReportOn"])) {
			$this->LoadSelectionFromSession('ReportOn');
		} elseif (@$_SESSION["sel_Paternity_Leave_ReportOn"] == EWRPT_INIT_VALUE) { // Select all
			$Paternity_Leave->ReportOn->SelectionList = "";
		}
	}

	// Reset pager
	function ResetPager() {

		// Reset start position (reset command)
		global $Paternity_Leave;
		$this->StartGrp = 1;
		$Paternity_Leave->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $Paternity_Leave;
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
			$Paternity_Leave->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$Paternity_Leave->setStartGroup($this->StartGrp);
		} else {
			if ($Paternity_Leave->getGroupPerPage() <> "") {
				$this->DisplayGrps = $Paternity_Leave->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $Security;
		global $Paternity_Leave;
		if ($Paternity_Leave->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($Paternity_Leave->SqlSelectCount(), $Paternity_Leave->SqlWhere(), $Paternity_Leave->SqlGroupBy(), $Paternity_Leave->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}
		}

		// Call Row_Rendering event
		$Paternity_Leave->Row_Rendering();

		/* --------------------
		'  Render view codes
		' --------------------- */
		if ($Paternity_Leave->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// Department
			$Paternity_Leave->Department->GroupViewValue = $Paternity_Leave->Department->GroupOldValue();
			$Paternity_Leave->Department->CellAttrs["class"] = ($Paternity_Leave->RowGroupLevel == 1) ? "ewRptGrpSummary1" : "ewRptGrpField1";
			$Paternity_Leave->Department->GroupViewValue = ewrpt_DisplayGroupValue($Paternity_Leave->Department, $Paternity_Leave->Department->GroupViewValue);

			// ID
			$Paternity_Leave->ID->ViewValue = $Paternity_Leave->ID->Summary;

			// FirstName
			$Paternity_Leave->FirstName->ViewValue = $Paternity_Leave->FirstName->Summary;

			// MiddelName
			$Paternity_Leave->MiddelName->ViewValue = $Paternity_Leave->MiddelName->Summary;

			// LastName
			$Paternity_Leave->LastName->ViewValue = $Paternity_Leave->LastName->Summary;

			// PaternityLeaveDays
			$Paternity_Leave->PaternityLeaveDays->ViewValue = $Paternity_Leave->PaternityLeaveDays->Summary;

			// PaternityLeave_Taken_Date
			$Paternity_Leave->PaternityLeave_Taken_Date->ViewValue = $Paternity_Leave->PaternityLeave_Taken_Date->Summary;
			$Paternity_Leave->PaternityLeave_Taken_Date->ViewValue = ewrpt_FormatDateTime($Paternity_Leave->PaternityLeave_Taken_Date->ViewValue, 5);

			// ReportOn
			$Paternity_Leave->ReportOn->ViewValue = $Paternity_Leave->ReportOn->Summary;
			$Paternity_Leave->ReportOn->ViewValue = ewrpt_FormatDateTime($Paternity_Leave->ReportOn->ViewValue, 5);
		} else {

			// Department
			$Paternity_Leave->Department->GroupViewValue = $Paternity_Leave->Department->GroupValue();
			$Paternity_Leave->Department->CellAttrs["class"] = "ewRptGrpField1";
			$Paternity_Leave->Department->GroupViewValue = ewrpt_DisplayGroupValue($Paternity_Leave->Department, $Paternity_Leave->Department->GroupViewValue);
			if ($Paternity_Leave->Department->GroupValue() == $Paternity_Leave->Department->GroupOldValue() && !$this->ChkLvlBreak(1))
				$Paternity_Leave->Department->GroupViewValue = "&nbsp;";

			// ID
			$Paternity_Leave->ID->ViewValue = $Paternity_Leave->ID->CurrentValue;
			$Paternity_Leave->ID->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// FirstName
			$Paternity_Leave->FirstName->ViewValue = $Paternity_Leave->FirstName->CurrentValue;
			$Paternity_Leave->FirstName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// MiddelName
			$Paternity_Leave->MiddelName->ViewValue = $Paternity_Leave->MiddelName->CurrentValue;
			$Paternity_Leave->MiddelName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// LastName
			$Paternity_Leave->LastName->ViewValue = $Paternity_Leave->LastName->CurrentValue;
			$Paternity_Leave->LastName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// PaternityLeaveDays
			$Paternity_Leave->PaternityLeaveDays->ViewValue = $Paternity_Leave->PaternityLeaveDays->CurrentValue;
			$Paternity_Leave->PaternityLeaveDays->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// PaternityLeave_Taken_Date
			$Paternity_Leave->PaternityLeave_Taken_Date->ViewValue = $Paternity_Leave->PaternityLeave_Taken_Date->CurrentValue;
			$Paternity_Leave->PaternityLeave_Taken_Date->ViewValue = ewrpt_FormatDateTime($Paternity_Leave->PaternityLeave_Taken_Date->ViewValue, 5);
			$Paternity_Leave->PaternityLeave_Taken_Date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// ReportOn
			$Paternity_Leave->ReportOn->ViewValue = $Paternity_Leave->ReportOn->CurrentValue;
			$Paternity_Leave->ReportOn->ViewValue = ewrpt_FormatDateTime($Paternity_Leave->ReportOn->ViewValue, 5);
			$Paternity_Leave->ReportOn->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// Department
		$Paternity_Leave->Department->HrefValue = "";

		// ID
		$Paternity_Leave->ID->HrefValue = "";

		// FirstName
		$Paternity_Leave->FirstName->HrefValue = "";

		// MiddelName
		$Paternity_Leave->MiddelName->HrefValue = "";

		// LastName
		$Paternity_Leave->LastName->HrefValue = "";

		// PaternityLeaveDays
		$Paternity_Leave->PaternityLeaveDays->HrefValue = "";

		// PaternityLeave_Taken_Date
		$Paternity_Leave->PaternityLeave_Taken_Date->HrefValue = "";

		// ReportOn
		$Paternity_Leave->ReportOn->HrefValue = "";

		// Call Row_Rendered event
		$Paternity_Leave->Row_Rendered();
	}

	// Get extended filter values
	function GetExtendedFilterValues() {
		global $Paternity_Leave;

		// Field PaternityLeave_Taken_Date
		$sSelect = "SELECT DISTINCT `PaternityLeave_Taken_Date` FROM " . $Paternity_Leave->SqlFrom();
		$sOrderBy = "`PaternityLeave_Taken_Date` ASC";
		$wrkSql = ewrpt_BuildReportSql($sSelect, $Paternity_Leave->SqlWhere(), "", "", $sOrderBy, $this->UserIDFilter, "");
		$Paternity_Leave->PaternityLeave_Taken_Date->DropDownList = ewrpt_GetDistinctValues("date", $wrkSql);

		// Field ReportOn
		$sSelect = "SELECT DISTINCT `ReportOn` FROM " . $Paternity_Leave->SqlFrom();
		$sOrderBy = "`ReportOn` ASC";
		$wrkSql = ewrpt_BuildReportSql($sSelect, $Paternity_Leave->SqlWhere(), "", "", $sOrderBy, $this->UserIDFilter, "");
		$Paternity_Leave->ReportOn->DropDownList = ewrpt_GetDistinctValues("date", $wrkSql);
	}

	// Return extended filter
	function GetExtendedFilter() {
		global $Paternity_Leave;
		global $gsFormError;
		$sFilter = "";
		$bPostBack = ewrpt_IsHttpPost();
		$bRestoreSession = TRUE;
		$bSetupFilter = FALSE;

		// Reset extended filter if filter changed
		if ($bPostBack) {

			// Clear extended filter for field ID
			if ($this->ClearExtFilter == 'Paternity_Leave_ID')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'ID');

			// Clear extended filter for field FirstName
			if ($this->ClearExtFilter == 'Paternity_Leave_FirstName')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'FirstName');

			// Clear extended filter for field MiddelName
			if ($this->ClearExtFilter == 'Paternity_Leave_MiddelName')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'MiddelName');

			// Clear extended filter for field LastName
			if ($this->ClearExtFilter == 'Paternity_Leave_LastName')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'LastName');

			// Clear extended filter for field PaternityLeaveDays
			if ($this->ClearExtFilter == 'Paternity_Leave_PaternityLeaveDays')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'PaternityLeaveDays');

			// Clear dropdown for field PaternityLeave_Taken_Date
			if ($this->ClearExtFilter == 'Paternity_Leave_PaternityLeave_Taken_Date')
				$this->SetSessionDropDownValue(EWRPT_INIT_VALUE, 'PaternityLeave_Taken_Date');

			// Clear dropdown for field ReportOn
			if ($this->ClearExtFilter == 'Paternity_Leave_ReportOn')
				$this->SetSessionDropDownValue(EWRPT_INIT_VALUE, 'ReportOn');

		// Reset search command
		} elseif (@$_GET["cmd"] == "reset") {

			// Load default values
			// Field ID

			$this->SetSessionFilterValues($Paternity_Leave->ID->SearchValue, $Paternity_Leave->ID->SearchOperator, $Paternity_Leave->ID->SearchCondition, $Paternity_Leave->ID->SearchValue2, $Paternity_Leave->ID->SearchOperator2, 'ID');

			// Field FirstName
			$this->SetSessionFilterValues($Paternity_Leave->FirstName->SearchValue, $Paternity_Leave->FirstName->SearchOperator, $Paternity_Leave->FirstName->SearchCondition, $Paternity_Leave->FirstName->SearchValue2, $Paternity_Leave->FirstName->SearchOperator2, 'FirstName');

			// Field MiddelName
			$this->SetSessionFilterValues($Paternity_Leave->MiddelName->SearchValue, $Paternity_Leave->MiddelName->SearchOperator, $Paternity_Leave->MiddelName->SearchCondition, $Paternity_Leave->MiddelName->SearchValue2, $Paternity_Leave->MiddelName->SearchOperator2, 'MiddelName');

			// Field LastName
			$this->SetSessionFilterValues($Paternity_Leave->LastName->SearchValue, $Paternity_Leave->LastName->SearchOperator, $Paternity_Leave->LastName->SearchCondition, $Paternity_Leave->LastName->SearchValue2, $Paternity_Leave->LastName->SearchOperator2, 'LastName');

			// Field PaternityLeaveDays
			$this->SetSessionFilterValues($Paternity_Leave->PaternityLeaveDays->SearchValue, $Paternity_Leave->PaternityLeaveDays->SearchOperator, $Paternity_Leave->PaternityLeaveDays->SearchCondition, $Paternity_Leave->PaternityLeaveDays->SearchValue2, $Paternity_Leave->PaternityLeaveDays->SearchOperator2, 'PaternityLeaveDays');

			// Field PaternityLeave_Taken_Date
			$this->SetSessionDropDownValue($Paternity_Leave->PaternityLeave_Taken_Date->DropDownValue, 'PaternityLeave_Taken_Date');

			// Field ReportOn
			$this->SetSessionDropDownValue($Paternity_Leave->ReportOn->DropDownValue, 'ReportOn');
			$bSetupFilter = TRUE;
		} else {

			// Field ID
			if ($this->GetFilterValues($Paternity_Leave->ID)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field FirstName
			if ($this->GetFilterValues($Paternity_Leave->FirstName)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field MiddelName
			if ($this->GetFilterValues($Paternity_Leave->MiddelName)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field LastName
			if ($this->GetFilterValues($Paternity_Leave->LastName)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field PaternityLeaveDays
			if ($this->GetFilterValues($Paternity_Leave->PaternityLeaveDays)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field PaternityLeave_Taken_Date
			if ($this->GetDropDownValue($Paternity_Leave->PaternityLeave_Taken_Date->DropDownValue, 'PaternityLeave_Taken_Date')) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			} elseif ($Paternity_Leave->PaternityLeave_Taken_Date->DropDownValue <> EWRPT_INIT_VALUE && !isset($_SESSION['sv_Paternity_Leave->PaternityLeave_Taken_Date'])) {
				$bSetupFilter = TRUE;
			}

			// Field ReportOn
			if ($this->GetDropDownValue($Paternity_Leave->ReportOn->DropDownValue, 'ReportOn')) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			} elseif ($Paternity_Leave->ReportOn->DropDownValue <> EWRPT_INIT_VALUE && !isset($_SESSION['sv_Paternity_Leave->ReportOn'])) {
				$bSetupFilter = TRUE;
			}
			if (!$this->ValidateForm()) {
				$this->setMessage($gsFormError);
				return $sFilter;
			}
		}

		// Restore session
		if ($bRestoreSession) {

			// Field ID
			$this->GetSessionFilterValues($Paternity_Leave->ID);

			// Field FirstName
			$this->GetSessionFilterValues($Paternity_Leave->FirstName);

			// Field MiddelName
			$this->GetSessionFilterValues($Paternity_Leave->MiddelName);

			// Field LastName
			$this->GetSessionFilterValues($Paternity_Leave->LastName);

			// Field PaternityLeaveDays
			$this->GetSessionFilterValues($Paternity_Leave->PaternityLeaveDays);

			// Field PaternityLeave_Taken_Date
			$this->GetSessionDropDownValue($Paternity_Leave->PaternityLeave_Taken_Date);

			// Field ReportOn
			$this->GetSessionDropDownValue($Paternity_Leave->ReportOn);
		}

		// Call page filter validated event
		$Paternity_Leave->Page_FilterValidated();

		// Build SQL
		// Field ID

		$this->BuildExtendedFilter($Paternity_Leave->ID, $sFilter);

		// Field FirstName
		$this->BuildExtendedFilter($Paternity_Leave->FirstName, $sFilter);

		// Field MiddelName
		$this->BuildExtendedFilter($Paternity_Leave->MiddelName, $sFilter);

		// Field LastName
		$this->BuildExtendedFilter($Paternity_Leave->LastName, $sFilter);

		// Field PaternityLeaveDays
		$this->BuildExtendedFilter($Paternity_Leave->PaternityLeaveDays, $sFilter);

		// Field PaternityLeave_Taken_Date
		$this->BuildDropDownFilter($Paternity_Leave->PaternityLeave_Taken_Date, $sFilter, "");

		// Field ReportOn
		$this->BuildDropDownFilter($Paternity_Leave->ReportOn, $sFilter, "");

		// Save parms to session
		// Field ID

		$this->SetSessionFilterValues($Paternity_Leave->ID->SearchValue, $Paternity_Leave->ID->SearchOperator, $Paternity_Leave->ID->SearchCondition, $Paternity_Leave->ID->SearchValue2, $Paternity_Leave->ID->SearchOperator2, 'ID');

		// Field FirstName
		$this->SetSessionFilterValues($Paternity_Leave->FirstName->SearchValue, $Paternity_Leave->FirstName->SearchOperator, $Paternity_Leave->FirstName->SearchCondition, $Paternity_Leave->FirstName->SearchValue2, $Paternity_Leave->FirstName->SearchOperator2, 'FirstName');

		// Field MiddelName
		$this->SetSessionFilterValues($Paternity_Leave->MiddelName->SearchValue, $Paternity_Leave->MiddelName->SearchOperator, $Paternity_Leave->MiddelName->SearchCondition, $Paternity_Leave->MiddelName->SearchValue2, $Paternity_Leave->MiddelName->SearchOperator2, 'MiddelName');

		// Field LastName
		$this->SetSessionFilterValues($Paternity_Leave->LastName->SearchValue, $Paternity_Leave->LastName->SearchOperator, $Paternity_Leave->LastName->SearchCondition, $Paternity_Leave->LastName->SearchValue2, $Paternity_Leave->LastName->SearchOperator2, 'LastName');

		// Field PaternityLeaveDays
		$this->SetSessionFilterValues($Paternity_Leave->PaternityLeaveDays->SearchValue, $Paternity_Leave->PaternityLeaveDays->SearchOperator, $Paternity_Leave->PaternityLeaveDays->SearchCondition, $Paternity_Leave->PaternityLeaveDays->SearchValue2, $Paternity_Leave->PaternityLeaveDays->SearchOperator2, 'PaternityLeaveDays');

		// Field PaternityLeave_Taken_Date
		$this->SetSessionDropDownValue($Paternity_Leave->PaternityLeave_Taken_Date->DropDownValue, 'PaternityLeave_Taken_Date');

		// Field ReportOn
		$this->SetSessionDropDownValue($Paternity_Leave->ReportOn->DropDownValue, 'ReportOn');

		// Setup filter
		if ($bSetupFilter) {

			// Field ID
			$sWrk = "";
			$this->BuildExtendedFilter($Paternity_Leave->ID, $sWrk);
			$this->LoadSelectionFromFilter($Paternity_Leave->ID, $sWrk, $Paternity_Leave->ID->SelectionList);
			$_SESSION['sel_Paternity_Leave_ID'] = ($Paternity_Leave->ID->SelectionList == "") ? EWRPT_INIT_VALUE : $Paternity_Leave->ID->SelectionList;

			// Field FirstName
			$sWrk = "";
			$this->BuildExtendedFilter($Paternity_Leave->FirstName, $sWrk);
			$this->LoadSelectionFromFilter($Paternity_Leave->FirstName, $sWrk, $Paternity_Leave->FirstName->SelectionList);
			$_SESSION['sel_Paternity_Leave_FirstName'] = ($Paternity_Leave->FirstName->SelectionList == "") ? EWRPT_INIT_VALUE : $Paternity_Leave->FirstName->SelectionList;

			// Field MiddelName
			$sWrk = "";
			$this->BuildExtendedFilter($Paternity_Leave->MiddelName, $sWrk);
			$this->LoadSelectionFromFilter($Paternity_Leave->MiddelName, $sWrk, $Paternity_Leave->MiddelName->SelectionList);
			$_SESSION['sel_Paternity_Leave_MiddelName'] = ($Paternity_Leave->MiddelName->SelectionList == "") ? EWRPT_INIT_VALUE : $Paternity_Leave->MiddelName->SelectionList;

			// Field LastName
			$sWrk = "";
			$this->BuildExtendedFilter($Paternity_Leave->LastName, $sWrk);
			$this->LoadSelectionFromFilter($Paternity_Leave->LastName, $sWrk, $Paternity_Leave->LastName->SelectionList);
			$_SESSION['sel_Paternity_Leave_LastName'] = ($Paternity_Leave->LastName->SelectionList == "") ? EWRPT_INIT_VALUE : $Paternity_Leave->LastName->SelectionList;

			// Field PaternityLeaveDays
			$sWrk = "";
			$this->BuildExtendedFilter($Paternity_Leave->PaternityLeaveDays, $sWrk);
			$this->LoadSelectionFromFilter($Paternity_Leave->PaternityLeaveDays, $sWrk, $Paternity_Leave->PaternityLeaveDays->SelectionList);
			$_SESSION['sel_Paternity_Leave_PaternityLeaveDays'] = ($Paternity_Leave->PaternityLeaveDays->SelectionList == "") ? EWRPT_INIT_VALUE : $Paternity_Leave->PaternityLeaveDays->SelectionList;

			// Field PaternityLeave_Taken_Date
			$sWrk = "";
			$this->BuildDropDownFilter($Paternity_Leave->PaternityLeave_Taken_Date, $sWrk, "");
			$this->LoadSelectionFromFilter($Paternity_Leave->PaternityLeave_Taken_Date, $sWrk, $Paternity_Leave->PaternityLeave_Taken_Date->SelectionList);
			$_SESSION['sel_Paternity_Leave_PaternityLeave_Taken_Date'] = ($Paternity_Leave->PaternityLeave_Taken_Date->SelectionList == "") ? EWRPT_INIT_VALUE : $Paternity_Leave->PaternityLeave_Taken_Date->SelectionList;

			// Field ReportOn
			$sWrk = "";
			$this->BuildDropDownFilter($Paternity_Leave->ReportOn, $sWrk, "");
			$this->LoadSelectionFromFilter($Paternity_Leave->ReportOn, $sWrk, $Paternity_Leave->ReportOn->SelectionList);
			$_SESSION['sel_Paternity_Leave_ReportOn'] = ($Paternity_Leave->ReportOn->SelectionList == "") ? EWRPT_INIT_VALUE : $Paternity_Leave->ReportOn->SelectionList;
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
		$this->GetSessionValue($fld->DropDownValue, 'sv_Paternity_Leave_' . $parm);
	}

	// Get filter values from session
	function GetSessionFilterValues(&$fld) {
		$parm = substr($fld->FldVar, 2);
		$this->GetSessionValue($fld->SearchValue, 'sv1_Paternity_Leave_' . $parm);
		$this->GetSessionValue($fld->SearchOperator, 'so1_Paternity_Leave_' . $parm);
		$this->GetSessionValue($fld->SearchCondition, 'sc_Paternity_Leave_' . $parm);
		$this->GetSessionValue($fld->SearchValue2, 'sv2_Paternity_Leave_' . $parm);
		$this->GetSessionValue($fld->SearchOperator2, 'so2_Paternity_Leave_' . $parm);
	}

	// Get value from session
	function GetSessionValue(&$sv, $sn) {
		if (isset($_SESSION[$sn]))
			$sv = $_SESSION[$sn];
	}

	// Set dropdown value to session
	function SetSessionDropDownValue($sv, $parm) {
		$_SESSION['sv_Paternity_Leave_' . $parm] = $sv;
	}

	// Set filter values to session
	function SetSessionFilterValues($sv1, $so1, $sc, $sv2, $so2, $parm) {
		$_SESSION['sv1_Paternity_Leave_' . $parm] = $sv1;
		$_SESSION['so1_Paternity_Leave_' . $parm] = $so1;
		$_SESSION['sc_Paternity_Leave_' . $parm] = $sc;
		$_SESSION['sv2_Paternity_Leave_' . $parm] = $sv2;
		$_SESSION['so2_Paternity_Leave_' . $parm] = $so2;
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
		global $ReportLanguage, $gsFormError, $Paternity_Leave;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EWRPT_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ewrpt_CheckInteger($Paternity_Leave->PaternityLeaveDays->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Paternity_Leave->PaternityLeaveDays->FldErrMsg();
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
		$_SESSION["sel_Paternity_Leave_$parm"] = "";
		$_SESSION["rf_Paternity_Leave_$parm"] = "";
		$_SESSION["rt_Paternity_Leave_$parm"] = "";
	}

	// Load selection from session
	function LoadSelectionFromSession($parm) {
		global $Paternity_Leave;
		$fld =& $Paternity_Leave->fields($parm);
		$fld->SelectionList = @$_SESSION["sel_Paternity_Leave_$parm"];
		$fld->RangeFrom = @$_SESSION["rf_Paternity_Leave_$parm"];
		$fld->RangeTo = @$_SESSION["rt_Paternity_Leave_$parm"];
	}

	// Load default value for filters
	function LoadDefaultFilters() {
		global $Paternity_Leave;

		/**
		* Set up default values for non Text filters
		*/

		// Field PaternityLeave_Taken_Date
		$Paternity_Leave->PaternityLeave_Taken_Date->DefaultDropDownValue = EWRPT_INIT_VALUE;
		$Paternity_Leave->PaternityLeave_Taken_Date->DropDownValue = $Paternity_Leave->PaternityLeave_Taken_Date->DefaultDropDownValue;
		$sWrk = "";
		$this->BuildDropDownFilter($Paternity_Leave->PaternityLeave_Taken_Date, $sWrk, "");
		$this->LoadSelectionFromFilter($Paternity_Leave->PaternityLeave_Taken_Date, $sWrk, $Paternity_Leave->PaternityLeave_Taken_Date->DefaultSelectionList);

		// Field ReportOn
		$Paternity_Leave->ReportOn->DefaultDropDownValue = EWRPT_INIT_VALUE;
		$Paternity_Leave->ReportOn->DropDownValue = $Paternity_Leave->ReportOn->DefaultDropDownValue;
		$sWrk = "";
		$this->BuildDropDownFilter($Paternity_Leave->ReportOn, $sWrk, "");
		$this->LoadSelectionFromFilter($Paternity_Leave->ReportOn, $sWrk, $Paternity_Leave->ReportOn->DefaultSelectionList);

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
		$this->SetDefaultExtFilter($Paternity_Leave->ID, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Paternity_Leave->ID);
		$sWrk = "";
		$this->BuildExtendedFilter($Paternity_Leave->ID, $sWrk);
		$this->LoadSelectionFromFilter($Paternity_Leave->ID, $sWrk, $Paternity_Leave->ID->DefaultSelectionList);
		$Paternity_Leave->ID->SelectionList = $Paternity_Leave->ID->DefaultSelectionList;

		// Field FirstName
		$this->SetDefaultExtFilter($Paternity_Leave->FirstName, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Paternity_Leave->FirstName);
		$sWrk = "";
		$this->BuildExtendedFilter($Paternity_Leave->FirstName, $sWrk);
		$this->LoadSelectionFromFilter($Paternity_Leave->FirstName, $sWrk, $Paternity_Leave->FirstName->DefaultSelectionList);
		$Paternity_Leave->FirstName->SelectionList = $Paternity_Leave->FirstName->DefaultSelectionList;

		// Field MiddelName
		$this->SetDefaultExtFilter($Paternity_Leave->MiddelName, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Paternity_Leave->MiddelName);
		$sWrk = "";
		$this->BuildExtendedFilter($Paternity_Leave->MiddelName, $sWrk);
		$this->LoadSelectionFromFilter($Paternity_Leave->MiddelName, $sWrk, $Paternity_Leave->MiddelName->DefaultSelectionList);
		$Paternity_Leave->MiddelName->SelectionList = $Paternity_Leave->MiddelName->DefaultSelectionList;

		// Field LastName
		$this->SetDefaultExtFilter($Paternity_Leave->LastName, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Paternity_Leave->LastName);
		$sWrk = "";
		$this->BuildExtendedFilter($Paternity_Leave->LastName, $sWrk);
		$this->LoadSelectionFromFilter($Paternity_Leave->LastName, $sWrk, $Paternity_Leave->LastName->DefaultSelectionList);
		$Paternity_Leave->LastName->SelectionList = $Paternity_Leave->LastName->DefaultSelectionList;

		// Field PaternityLeaveDays
		$this->SetDefaultExtFilter($Paternity_Leave->PaternityLeaveDays, "USER SELECT", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Paternity_Leave->PaternityLeaveDays);
		$sWrk = "";
		$this->BuildExtendedFilter($Paternity_Leave->PaternityLeaveDays, $sWrk);
		$this->LoadSelectionFromFilter($Paternity_Leave->PaternityLeaveDays, $sWrk, $Paternity_Leave->PaternityLeaveDays->DefaultSelectionList);
		$Paternity_Leave->PaternityLeaveDays->SelectionList = $Paternity_Leave->PaternityLeaveDays->DefaultSelectionList;

		/**
		* Set up default values for popup filters
		* NOTE: if extended filter is enabled, use default values in extended filter instead
		*/
	}

	// Check if filter applied
	function CheckFilter() {
		global $Paternity_Leave;

		// Check ID text filter
		if ($this->TextFilterApplied($Paternity_Leave->ID))
			return TRUE;

		// Check ID popup filter
		if (!ewrpt_MatchedArray($Paternity_Leave->ID->DefaultSelectionList, $Paternity_Leave->ID->SelectionList))
			return TRUE;

		// Check FirstName text filter
		if ($this->TextFilterApplied($Paternity_Leave->FirstName))
			return TRUE;

		// Check FirstName popup filter
		if (!ewrpt_MatchedArray($Paternity_Leave->FirstName->DefaultSelectionList, $Paternity_Leave->FirstName->SelectionList))
			return TRUE;

		// Check MiddelName text filter
		if ($this->TextFilterApplied($Paternity_Leave->MiddelName))
			return TRUE;

		// Check MiddelName popup filter
		if (!ewrpt_MatchedArray($Paternity_Leave->MiddelName->DefaultSelectionList, $Paternity_Leave->MiddelName->SelectionList))
			return TRUE;

		// Check LastName text filter
		if ($this->TextFilterApplied($Paternity_Leave->LastName))
			return TRUE;

		// Check LastName popup filter
		if (!ewrpt_MatchedArray($Paternity_Leave->LastName->DefaultSelectionList, $Paternity_Leave->LastName->SelectionList))
			return TRUE;

		// Check PaternityLeaveDays text filter
		if ($this->TextFilterApplied($Paternity_Leave->PaternityLeaveDays))
			return TRUE;

		// Check PaternityLeaveDays popup filter
		if (!ewrpt_MatchedArray($Paternity_Leave->PaternityLeaveDays->DefaultSelectionList, $Paternity_Leave->PaternityLeaveDays->SelectionList))
			return TRUE;

		// Check PaternityLeave_Taken_Date extended filter
		if ($this->NonTextFilterApplied($Paternity_Leave->PaternityLeave_Taken_Date))
			return TRUE;

		// Check PaternityLeave_Taken_Date popup filter
		if (!ewrpt_MatchedArray($Paternity_Leave->PaternityLeave_Taken_Date->DefaultSelectionList, $Paternity_Leave->PaternityLeave_Taken_Date->SelectionList))
			return TRUE;

		// Check ReportOn extended filter
		if ($this->NonTextFilterApplied($Paternity_Leave->ReportOn))
			return TRUE;

		// Check ReportOn popup filter
		if (!ewrpt_MatchedArray($Paternity_Leave->ReportOn->DefaultSelectionList, $Paternity_Leave->ReportOn->SelectionList))
			return TRUE;
		return FALSE;
	}

	// Show list of filters
	function ShowFilterList() {
		global $Paternity_Leave;
		global $ReportLanguage;

		// Initialize
		$sFilterList = "";

		// Field ID
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Paternity_Leave->ID, $sExtWrk);
		if (is_array($Paternity_Leave->ID->SelectionList))
			$sWrk = ewrpt_JoinArray($Paternity_Leave->ID->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Paternity_Leave->ID->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field FirstName
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Paternity_Leave->FirstName, $sExtWrk);
		if (is_array($Paternity_Leave->FirstName->SelectionList))
			$sWrk = ewrpt_JoinArray($Paternity_Leave->FirstName->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Paternity_Leave->FirstName->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field MiddelName
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Paternity_Leave->MiddelName, $sExtWrk);
		if (is_array($Paternity_Leave->MiddelName->SelectionList))
			$sWrk = ewrpt_JoinArray($Paternity_Leave->MiddelName->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Paternity_Leave->MiddelName->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field LastName
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Paternity_Leave->LastName, $sExtWrk);
		if (is_array($Paternity_Leave->LastName->SelectionList))
			$sWrk = ewrpt_JoinArray($Paternity_Leave->LastName->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Paternity_Leave->LastName->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field PaternityLeaveDays
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Paternity_Leave->PaternityLeaveDays, $sExtWrk);
		if (is_array($Paternity_Leave->PaternityLeaveDays->SelectionList))
			$sWrk = ewrpt_JoinArray($Paternity_Leave->PaternityLeaveDays->SelectionList, ", ", EWRPT_DATATYPE_NUMBER);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Paternity_Leave->PaternityLeaveDays->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field PaternityLeave_Taken_Date
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildDropDownFilter($Paternity_Leave->PaternityLeave_Taken_Date, $sExtWrk, "");
		if (is_array($Paternity_Leave->PaternityLeave_Taken_Date->SelectionList))
			$sWrk = ewrpt_JoinArray($Paternity_Leave->PaternityLeave_Taken_Date->SelectionList, ", ", EWRPT_DATATYPE_DATE);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Paternity_Leave->PaternityLeave_Taken_Date->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field ReportOn
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildDropDownFilter($Paternity_Leave->ReportOn, $sExtWrk, "");
		if (is_array($Paternity_Leave->ReportOn->SelectionList))
			$sWrk = ewrpt_JoinArray($Paternity_Leave->ReportOn->SelectionList, ", ", EWRPT_DATATYPE_DATE);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Paternity_Leave->ReportOn->FldCaption() . "<br />";
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
		global $Paternity_Leave;
		$sWrk = "";
		if (!$this->ExtendedFilterExist($Paternity_Leave->ID)) {
			if (is_array($Paternity_Leave->ID->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Paternity_Leave->ID, "`ID`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Paternity_Leave->FirstName)) {
			if (is_array($Paternity_Leave->FirstName->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Paternity_Leave->FirstName, "`FirstName`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Paternity_Leave->MiddelName)) {
			if (is_array($Paternity_Leave->MiddelName->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Paternity_Leave->MiddelName, "`MiddelName`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Paternity_Leave->LastName)) {
			if (is_array($Paternity_Leave->LastName->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Paternity_Leave->LastName, "`LastName`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Paternity_Leave->PaternityLeaveDays)) {
			if (is_array($Paternity_Leave->PaternityLeaveDays->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Paternity_Leave->PaternityLeaveDays, "`PaternityLeaveDays`", EWRPT_DATATYPE_NUMBER);
			}
		}
		if (!$this->DropDownFilterExist($Paternity_Leave->PaternityLeave_Taken_Date, "")) {
			if (is_array($Paternity_Leave->PaternityLeave_Taken_Date->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Paternity_Leave->PaternityLeave_Taken_Date, "`PaternityLeave_Taken_Date`", EWRPT_DATATYPE_DATE);
			}
		}
		if (!$this->DropDownFilterExist($Paternity_Leave->ReportOn, "")) {
			if (is_array($Paternity_Leave->ReportOn->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Paternity_Leave->ReportOn, "`ReportOn`", EWRPT_DATATYPE_DATE);
			}
		}
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $Paternity_Leave;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$Paternity_Leave->setOrderBy("");
				$Paternity_Leave->setStartGroup(1);
				$Paternity_Leave->Department->setSort("");
				$Paternity_Leave->ID->setSort("");
				$Paternity_Leave->FirstName->setSort("");
				$Paternity_Leave->MiddelName->setSort("");
				$Paternity_Leave->LastName->setSort("");
				$Paternity_Leave->PaternityLeaveDays->setSort("");
				$Paternity_Leave->PaternityLeave_Taken_Date->setSort("");
				$Paternity_Leave->ReportOn->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$Paternity_Leave->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$Paternity_Leave->CurrentOrderType = @$_GET["ordertype"];
			$sSortSql = $Paternity_Leave->SortSql();
			$Paternity_Leave->setOrderBy($sSortSql);
			$Paternity_Leave->setStartGroup(1);
		}

		// Set up default sort
		if ($Paternity_Leave->getOrderBy() == "") {
			$Paternity_Leave->setOrderBy("`ID` ASC");
			$Paternity_Leave->ID->setSort("ASC");
		}
		return $Paternity_Leave->getOrderBy();
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
