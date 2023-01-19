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
$Funera_Leave_Per_Department_Summary = NULL;

//
// Table class for Funera Leave Per Department Summary
//
class crFunera_Leave_Per_Department_Summary {
	var $TableVar = 'Funera_Leave_Per_Department_Summary';
	var $TableName = 'Funera Leave Per Department Summary';
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
	var $FuneralLeaveDays;
	var $RestDay;
	var $FuneralLeave_Taken_Date;
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
	function crFunera_Leave_Per_Department_Summary() {
		global $ReportLanguage;

		// Auto_ID
		$this->Auto_ID = new crField('Funera_Leave_Per_Department_Summary', 'Funera Leave Per Department Summary', 'x_Auto_ID', 'Auto_ID', '`Auto_ID`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->Auto_ID->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['Auto_ID'] =& $this->Auto_ID;
		$this->Auto_ID->DateFilter = "";
		$this->Auto_ID->SqlSelect = "";
		$this->Auto_ID->SqlOrderBy = "";
		$this->Auto_ID->FldGroupByType = "";
		$this->Auto_ID->FldGroupInt = "0";
		$this->Auto_ID->FldGroupSql = "";

		// ID
		$this->ID = new crField('Funera_Leave_Per_Department_Summary', 'Funera Leave Per Department Summary', 'x_ID', 'ID', '`ID`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['ID'] =& $this->ID;
		$this->ID->DateFilter = "";
		$this->ID->SqlSelect = "";
		$this->ID->SqlOrderBy = "";
		$this->ID->FldGroupByType = "";
		$this->ID->FldGroupInt = "0";
		$this->ID->FldGroupSql = "";

		// FirstName
		$this->FirstName = new crField('Funera_Leave_Per_Department_Summary', 'Funera Leave Per Department Summary', 'x_FirstName', 'FirstName', '`FirstName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['FirstName'] =& $this->FirstName;
		$this->FirstName->DateFilter = "";
		$this->FirstName->SqlSelect = "";
		$this->FirstName->SqlOrderBy = "";
		$this->FirstName->FldGroupByType = "";
		$this->FirstName->FldGroupInt = "0";
		$this->FirstName->FldGroupSql = "";

		// MiddelName
		$this->MiddelName = new crField('Funera_Leave_Per_Department_Summary', 'Funera Leave Per Department Summary', 'x_MiddelName', 'MiddelName', '`MiddelName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['MiddelName'] =& $this->MiddelName;
		$this->MiddelName->DateFilter = "";
		$this->MiddelName->SqlSelect = "";
		$this->MiddelName->SqlOrderBy = "";
		$this->MiddelName->FldGroupByType = "";
		$this->MiddelName->FldGroupInt = "0";
		$this->MiddelName->FldGroupSql = "";

		// LastName
		$this->LastName = new crField('Funera_Leave_Per_Department_Summary', 'Funera Leave Per Department Summary', 'x_LastName', 'LastName', '`LastName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['LastName'] =& $this->LastName;
		$this->LastName->DateFilter = "";
		$this->LastName->SqlSelect = "";
		$this->LastName->SqlOrderBy = "";
		$this->LastName->FldGroupByType = "";
		$this->LastName->FldGroupInt = "0";
		$this->LastName->FldGroupSql = "";

		// FuneralLeaveDays
		$this->FuneralLeaveDays = new crField('Funera_Leave_Per_Department_Summary', 'Funera Leave Per Department Summary', 'x_FuneralLeaveDays', 'FuneralLeaveDays', '`FuneralLeaveDays`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->FuneralLeaveDays->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['FuneralLeaveDays'] =& $this->FuneralLeaveDays;
		$this->FuneralLeaveDays->DateFilter = "";
		$this->FuneralLeaveDays->SqlSelect = "";
		$this->FuneralLeaveDays->SqlOrderBy = "";
		$this->FuneralLeaveDays->FldGroupByType = "";
		$this->FuneralLeaveDays->FldGroupInt = "0";
		$this->FuneralLeaveDays->FldGroupSql = "";

		// RestDay
		$this->RestDay = new crField('Funera_Leave_Per_Department_Summary', 'Funera Leave Per Department Summary', 'x_RestDay', 'RestDay', '`RestDay`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->RestDay->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['RestDay'] =& $this->RestDay;
		$this->RestDay->DateFilter = "";
		$this->RestDay->SqlSelect = "";
		$this->RestDay->SqlOrderBy = "";
		$this->RestDay->FldGroupByType = "";
		$this->RestDay->FldGroupInt = "0";
		$this->RestDay->FldGroupSql = "";

		// FuneralLeave_Taken_Date
		$this->FuneralLeave_Taken_Date = new crField('Funera_Leave_Per_Department_Summary', 'Funera Leave Per Department Summary', 'x_FuneralLeave_Taken_Date', 'FuneralLeave_Taken_Date', '`FuneralLeave_Taken_Date`', 133, EWRPT_DATATYPE_DATE, 5);
		$this->FuneralLeave_Taken_Date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateYMD"));
		$this->fields['FuneralLeave_Taken_Date'] =& $this->FuneralLeave_Taken_Date;
		$this->FuneralLeave_Taken_Date->DateFilter = "";
		$this->FuneralLeave_Taken_Date->SqlSelect = "";
		$this->FuneralLeave_Taken_Date->SqlOrderBy = "";
		$this->FuneralLeave_Taken_Date->FldGroupByType = "";
		$this->FuneralLeave_Taken_Date->FldGroupInt = "0";
		$this->FuneralLeave_Taken_Date->FldGroupSql = "";

		// ReportOn
		$this->ReportOn = new crField('Funera_Leave_Per_Department_Summary', 'Funera Leave Per Department Summary', 'x_ReportOn', 'ReportOn', '`ReportOn`', 133, EWRPT_DATATYPE_DATE, 5);
		$this->ReportOn->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateYMD"));
		$this->fields['ReportOn'] =& $this->ReportOn;
		$this->ReportOn->DateFilter = "";
		$this->ReportOn->SqlSelect = "";
		$this->ReportOn->SqlOrderBy = "";
		$this->ReportOn->FldGroupByType = "";
		$this->ReportOn->FldGroupInt = "0";
		$this->ReportOn->FldGroupSql = "";

		// LeaveType
		$this->LeaveType = new crField('Funera_Leave_Per_Department_Summary', 'Funera Leave Per Department Summary', 'x_LeaveType', 'LeaveType', '`LeaveType`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['LeaveType'] =& $this->LeaveType;
		$this->LeaveType->DateFilter = "";
		$this->LeaveType->SqlSelect = "";
		$this->LeaveType->SqlOrderBy = "";
		$this->LeaveType->FldGroupByType = "";
		$this->LeaveType->FldGroupInt = "0";
		$this->LeaveType->FldGroupSql = "";

		// Reported
		$this->Reported = new crField('Funera_Leave_Per_Department_Summary', 'Funera Leave Per Department Summary', 'x_Reported', 'Reported', '`Reported`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Reported'] =& $this->Reported;
		$this->Reported->DateFilter = "";
		$this->Reported->SqlSelect = "";
		$this->Reported->SqlOrderBy = "";
		$this->Reported->FldGroupByType = "";
		$this->Reported->FldGroupInt = "0";
		$this->Reported->FldGroupSql = "";

		// Report_Back_Date
		$this->Report_Back_Date = new crField('Funera_Leave_Per_Department_Summary', 'Funera Leave Per Department Summary', 'x_Report_Back_Date', 'Report_Back_Date', '`Report_Back_Date`', 133, EWRPT_DATATYPE_DATE, 5);
		$this->Report_Back_Date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateYMD"));
		$this->fields['Report_Back_Date'] =& $this->Report_Back_Date;
		$this->Report_Back_Date->DateFilter = "";
		$this->Report_Back_Date->SqlSelect = "";
		$this->Report_Back_Date->SqlOrderBy = "";
		$this->Report_Back_Date->FldGroupByType = "";
		$this->Report_Back_Date->FldGroupInt = "0";
		$this->Report_Back_Date->FldGroupSql = "";

		// Department
		$this->Department = new crField('Funera_Leave_Per_Department_Summary', 'Funera Leave Per Department Summary', 'x_Department', 'Department', '`Department`', 200, EWRPT_DATATYPE_STRING, -1);
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
		return "`funeral_leave`";
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
$Funera_Leave_Per_Department_Summary_summary = new crFunera_Leave_Per_Department_Summary_summary();
$Page =& $Funera_Leave_Per_Department_Summary_summary;

// Page init
$Funera_Leave_Per_Department_Summary_summary->Page_Init();

// Page main
$Funera_Leave_Per_Department_Summary_summary->Page_Main();
?>
<?php include "phprptinc/header.php"; ?>
<?php if ($Funera_Leave_Per_Department_Summary->Export == "") { ?>
<script type="text/javascript">

// Create page object
var Funera_Leave_Per_Department_Summary_summary = new ewrpt_Page("Funera_Leave_Per_Department_Summary_summary");

// page properties
Funera_Leave_Per_Department_Summary_summary.PageID = "summary"; // page ID
Funera_Leave_Per_Department_Summary_summary.FormID = "fFunera_Leave_Per_Department_Summarysummaryfilter"; // form ID
var EWRPT_PAGE_ID = Funera_Leave_Per_Department_Summary_summary.PageID;

// extend page with ValidateForm function
Funera_Leave_Per_Department_Summary_summary.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var elm = fobj.sv1_FuneralLeaveDays;
	if (elm && !ewrpt_CheckInteger(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Funera_Leave_Per_Department_Summary->FuneralLeaveDays->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv1_RestDay;
	if (elm && !ewrpt_CheckInteger(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Funera_Leave_Per_Department_Summary->RestDay->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv1_FuneralLeave_Taken_Date;
	if (elm && !ewrpt_CheckDate(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Funera_Leave_Per_Department_Summary->FuneralLeave_Taken_Date->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv1_ReportOn;
	if (elm && !ewrpt_CheckDate(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Funera_Leave_Per_Department_Summary->ReportOn->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv2_ReportOn;
	if (elm && !ewrpt_CheckDate(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Funera_Leave_Per_Department_Summary->ReportOn->FldErrMsg()) ?>"))
			return false;
	}

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj)) return false;
	return true;
}

// extend page with Form_CustomValidate function
Funera_Leave_Per_Department_Summary_summary.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EWRPT_CLIENT_VALIDATE) { ?>
Funera_Leave_Per_Department_Summary_summary.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
Funera_Leave_Per_Department_Summary_summary.ValidateRequired = false; // no JavaScript validation
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
<?php $Funera_Leave_Per_Department_Summary_summary->ShowPageHeader(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php $Funera_Leave_Per_Department_Summary_summary->ShowMessage(); ?>
<?php if ($Funera_Leave_Per_Department_Summary->Export == "" || $Funera_Leave_Per_Department_Summary->Export == "print" || $Funera_Leave_Per_Department_Summary->Export == "email") { ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php } ?>
<?php if ($Funera_Leave_Per_Department_Summary->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
</script>
<?php } ?>
<?php if ($Funera_Leave_Per_Department_Summary->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<?php if ($Funera_Leave_Per_Department_Summary->Export == "" || $Funera_Leave_Per_Department_Summary->Export == "print" || $Funera_Leave_Per_Department_Summary->Export == "email") { ?>
<?php } ?>
<?php echo $Funera_Leave_Per_Department_Summary->TableCaption() ?>
<?php if ($Funera_Leave_Per_Department_Summary->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $Funera_Leave_Per_Department_Summary_summary->ExportPrintUrl ?>"><?php echo $ReportLanguage->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $Funera_Leave_Per_Department_Summary_summary->ExportExcelUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $Funera_Leave_Per_Department_Summary_summary->ExportWordUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToWord") ?></a>
<?php if ($Funera_Leave_Per_Department_Summary_summary->FilterApplied) { ?>
&nbsp;&nbsp;<a href="Funera_Leave_Per_Department_Summarysmry.php?cmd=reset"><?php echo $ReportLanguage->Phrase("ResetAllFilter") ?></a>
<?php } ?>
<?php } ?>
<br /><br />
<?php if ($Funera_Leave_Per_Department_Summary->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($Funera_Leave_Per_Department_Summary->Export == "" || $Funera_Leave_Per_Department_Summary->Export == "print" || $Funera_Leave_Per_Department_Summary->Export == "email") { ?>
<?php } ?>
<?php if ($Funera_Leave_Per_Department_Summary->Export == "") { ?>
	</div></td>
	<!-- Left Container (End) -->
	<!-- Center Container - Report (Begin) -->
	<td style="vertical-align: top;" class="ewPadding"><div id="ewCenter" class="phpreportmaker">
	<!-- center slot -->
<?php } ?>
<!-- summary report starts -->
<div id="report_summary">
<?php if ($Funera_Leave_Per_Department_Summary->Export == "") { ?>
<?php
if ($Funera_Leave_Per_Department_Summary->FilterPanelOption == 2 || ($Funera_Leave_Per_Department_Summary->FilterPanelOption == 3 && $Funera_Leave_Per_Department_Summary_summary->FilterApplied) || $Funera_Leave_Per_Department_Summary_summary->Filter == "0=101") {
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
<form name="fFunera_Leave_Per_Department_Summarysummaryfilter" id="fFunera_Leave_Per_Department_Summarysummaryfilter" action="Funera_Leave_Per_Department_Summarysmry.php" class="ewForm" onsubmit="return Funera_Leave_Per_Department_Summary_summary.ValidateForm(this);">
<table class="ewRptExtFilter">
	<tr>
		<td><span class="phpreportmaker"><?php echo $Funera_Leave_Per_Department_Summary->ID->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_ID" id="so1_ID" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_ID" id="sv1_ID" size="30" maxlength="7" value="<?php echo ewrpt_HtmlEncode($Funera_Leave_Per_Department_Summary->ID->SearchValue) ?>"<?php echo ($Funera_Leave_Per_Department_Summary_summary->ClearExtFilter == 'Funera_Leave_Per_Department_Summary_ID') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Funera_Leave_Per_Department_Summary->FirstName->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_FirstName" id="so1_FirstName" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_FirstName" id="sv1_FirstName" size="30" maxlength="20" value="<?php echo ewrpt_HtmlEncode($Funera_Leave_Per_Department_Summary->FirstName->SearchValue) ?>"<?php echo ($Funera_Leave_Per_Department_Summary_summary->ClearExtFilter == 'Funera_Leave_Per_Department_Summary_FirstName') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Funera_Leave_Per_Department_Summary->FuneralLeaveDays->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><select name="so1_FuneralLeaveDays" id="so1_FuneralLeaveDays" onchange="ewrpt_SrchOprChanged('so1_FuneralLeaveDays')"><option value="="<?php if ($Funera_Leave_Per_Department_Summary->FuneralLeaveDays->SearchOperator == "=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("="); ?></option><option value="<>"<?php if ($Funera_Leave_Per_Department_Summary->FuneralLeaveDays->SearchOperator == "<>") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<>"); ?></option><option value="<"<?php if ($Funera_Leave_Per_Department_Summary->FuneralLeaveDays->SearchOperator == "<") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<"); ?></option><option value="<="<?php if ($Funera_Leave_Per_Department_Summary->FuneralLeaveDays->SearchOperator == "<=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<="); ?></option><option value=">"<?php if ($Funera_Leave_Per_Department_Summary->FuneralLeaveDays->SearchOperator == ">") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase(">"); ?></option><option value=">="<?php if ($Funera_Leave_Per_Department_Summary->FuneralLeaveDays->SearchOperator == ">=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase(">="); ?></option><option value="BETWEEN"<?php if ($Funera_Leave_Per_Department_Summary->FuneralLeaveDays->SearchOperator == "BETWEEN") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("BETWEEN"); ?></option></select></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_FuneralLeaveDays" id="sv1_FuneralLeaveDays" size="30" value="<?php echo ewrpt_HtmlEncode($Funera_Leave_Per_Department_Summary->FuneralLeaveDays->SearchValue) ?>"<?php echo ($Funera_Leave_Per_Department_Summary_summary->ClearExtFilter == 'Funera_Leave_Per_Department_Summary_FuneralLeaveDays') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
				<td><span class="ewRptSearchOpr" style="display: none" id="btw1_FuneralLeaveDays" name="btw1_FuneralLeaveDays">&nbsp;<?php echo $ReportLanguage->Phrase("AND") ?>&nbsp;</span></td>
				<td><span class="phpreportmaker" style="display: none" id="btw1_FuneralLeaveDays" name="btw1_FuneralLeaveDays">
<input type="text" name="sv2_FuneralLeaveDays" id="sv2_FuneralLeaveDays" size="30" value="<?php echo ewrpt_HtmlEncode($Funera_Leave_Per_Department_Summary->FuneralLeaveDays->SearchValue2) ?>"<?php echo ($Funera_Leave_Per_Department_Summary_summary->ClearExtFilter == 'Funera_Leave_Per_Department_Summary_FuneralLeaveDays') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Funera_Leave_Per_Department_Summary->RestDay->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><select name="so1_RestDay" id="so1_RestDay" onchange="ewrpt_SrchOprChanged('so1_RestDay')"><option value="="<?php if ($Funera_Leave_Per_Department_Summary->RestDay->SearchOperator == "=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("="); ?></option><option value="<>"<?php if ($Funera_Leave_Per_Department_Summary->RestDay->SearchOperator == "<>") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<>"); ?></option><option value="<"<?php if ($Funera_Leave_Per_Department_Summary->RestDay->SearchOperator == "<") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<"); ?></option><option value="<="<?php if ($Funera_Leave_Per_Department_Summary->RestDay->SearchOperator == "<=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<="); ?></option><option value=">"<?php if ($Funera_Leave_Per_Department_Summary->RestDay->SearchOperator == ">") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase(">"); ?></option><option value=">="<?php if ($Funera_Leave_Per_Department_Summary->RestDay->SearchOperator == ">=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase(">="); ?></option><option value="BETWEEN"<?php if ($Funera_Leave_Per_Department_Summary->RestDay->SearchOperator == "BETWEEN") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("BETWEEN"); ?></option></select></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_RestDay" id="sv1_RestDay" size="30" value="<?php echo ewrpt_HtmlEncode($Funera_Leave_Per_Department_Summary->RestDay->SearchValue) ?>"<?php echo ($Funera_Leave_Per_Department_Summary_summary->ClearExtFilter == 'Funera_Leave_Per_Department_Summary_RestDay') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
				<td><span class="ewRptSearchOpr" style="display: none" id="btw1_RestDay" name="btw1_RestDay">&nbsp;<?php echo $ReportLanguage->Phrase("AND") ?>&nbsp;</span></td>
				<td><span class="phpreportmaker" style="display: none" id="btw1_RestDay" name="btw1_RestDay">
<input type="text" name="sv2_RestDay" id="sv2_RestDay" size="30" value="<?php echo ewrpt_HtmlEncode($Funera_Leave_Per_Department_Summary->RestDay->SearchValue2) ?>"<?php echo ($Funera_Leave_Per_Department_Summary_summary->ClearExtFilter == 'Funera_Leave_Per_Department_Summary_RestDay') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Funera_Leave_Per_Department_Summary->FuneralLeave_Taken_Date->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><select name="so1_FuneralLeave_Taken_Date" id="so1_FuneralLeave_Taken_Date" onchange="ewrpt_SrchOprChanged('so1_FuneralLeave_Taken_Date')"><option value="="<?php if ($Funera_Leave_Per_Department_Summary->FuneralLeave_Taken_Date->SearchOperator == "=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("="); ?></option><option value="<>"<?php if ($Funera_Leave_Per_Department_Summary->FuneralLeave_Taken_Date->SearchOperator == "<>") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<>"); ?></option><option value="<"<?php if ($Funera_Leave_Per_Department_Summary->FuneralLeave_Taken_Date->SearchOperator == "<") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<"); ?></option><option value="<="<?php if ($Funera_Leave_Per_Department_Summary->FuneralLeave_Taken_Date->SearchOperator == "<=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<="); ?></option><option value=">"<?php if ($Funera_Leave_Per_Department_Summary->FuneralLeave_Taken_Date->SearchOperator == ">") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase(">"); ?></option><option value=">="<?php if ($Funera_Leave_Per_Department_Summary->FuneralLeave_Taken_Date->SearchOperator == ">=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase(">="); ?></option><option value="BETWEEN"<?php if ($Funera_Leave_Per_Department_Summary->FuneralLeave_Taken_Date->SearchOperator == "BETWEEN") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("BETWEEN"); ?></option></select></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_FuneralLeave_Taken_Date" id="sv1_FuneralLeave_Taken_Date" value="<?php echo ewrpt_HtmlEncode($Funera_Leave_Per_Department_Summary->FuneralLeave_Taken_Date->SearchValue) ?>"<?php echo ($Funera_Leave_Per_Department_Summary_summary->ClearExtFilter == 'Funera_Leave_Per_Department_Summary_FuneralLeave_Taken_Date') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
				<td><span class="ewRptSearchOpr" style="display: none" id="btw1_FuneralLeave_Taken_Date" name="btw1_FuneralLeave_Taken_Date">&nbsp;<?php echo $ReportLanguage->Phrase("AND") ?>&nbsp;</span></td>
				<td><span class="phpreportmaker" style="display: none" id="btw1_FuneralLeave_Taken_Date" name="btw1_FuneralLeave_Taken_Date">
<input type="text" name="sv2_FuneralLeave_Taken_Date" id="sv2_FuneralLeave_Taken_Date" value="<?php echo ewrpt_HtmlEncode($Funera_Leave_Per_Department_Summary->FuneralLeave_Taken_Date->SearchValue2) ?>"<?php echo ($Funera_Leave_Per_Department_Summary_summary->ClearExtFilter == 'Funera_Leave_Per_Department_Summary_FuneralLeave_Taken_Date') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Funera_Leave_Per_Department_Summary->ReportOn->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("BETWEEN"); ?><input type="hidden" name="so1_ReportOn" id="so1_ReportOn" value="BETWEEN"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_ReportOn" id="sv1_ReportOn" value="<?php echo ewrpt_HtmlEncode($Funera_Leave_Per_Department_Summary->ReportOn->SearchValue) ?>"<?php echo ($Funera_Leave_Per_Department_Summary_summary->ClearExtFilter == 'Funera_Leave_Per_Department_Summary_ReportOn') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
				<td><span class="ewRptSearchOpr" id="btw1_ReportOn" name="btw1_ReportOn">&nbsp;<?php echo $ReportLanguage->Phrase("AND") ?>&nbsp;</span></td>
				<td><span class="phpreportmaker" id="btw1_ReportOn" name="btw1_ReportOn">
<input type="text" name="sv2_ReportOn" id="sv2_ReportOn" value="<?php echo ewrpt_HtmlEncode($Funera_Leave_Per_Department_Summary->ReportOn->SearchValue2) ?>"<?php echo ($Funera_Leave_Per_Department_Summary_summary->ClearExtFilter == 'Funera_Leave_Per_Department_Summary_ReportOn') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Funera_Leave_Per_Department_Summary->Department->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_Department" id="so1_Department" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_Department" id="sv1_Department" size="30" maxlength="50" value="<?php echo ewrpt_HtmlEncode($Funera_Leave_Per_Department_Summary->Department->SearchValue) ?>"<?php echo ($Funera_Leave_Per_Department_Summary_summary->ClearExtFilter == 'Funera_Leave_Per_Department_Summary_Department') ? " class=\"ewInputCleared\"" : "" ?>>
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
ewrpt_SrchOprChanged('so1_FuneralLeaveDays');
ewrpt_SrchOprChanged('so1_RestDay');
ewrpt_SrchOprChanged('so1_FuneralLeave_Taken_Date');
</script>
<!-- Search form (end) -->
</div>
<br />
<?php } ?>
<?php if ($Funera_Leave_Per_Department_Summary->ShowCurrentFilter) { ?>
<div id="ewrptFilterList">
<?php $Funera_Leave_Per_Department_Summary_summary->ShowFilterList() ?>
</div>
<br />
<?php } ?>
<table class="ewGrid" cellspacing="0"><tr>
	<td class="ewGridContent">
<?php if ($Funera_Leave_Per_Department_Summary->Export == "") { ?>
<div class="ewGridUpperPanel">
<form action="Funera_Leave_Per_Department_Summarysmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($Funera_Leave_Per_Department_Summary_summary->StartGrp, $Funera_Leave_Per_Department_Summary_summary->DisplayGrps, $Funera_Leave_Per_Department_Summary_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="Funera_Leave_Per_Department_Summarysmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="Funera_Leave_Per_Department_Summarysmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="Funera_Leave_Per_Department_Summarysmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="Funera_Leave_Per_Department_Summarysmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($Funera_Leave_Per_Department_Summary_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($Funera_Leave_Per_Department_Summary_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($Funera_Leave_Per_Department_Summary_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($Funera_Leave_Per_Department_Summary_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($Funera_Leave_Per_Department_Summary_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($Funera_Leave_Per_Department_Summary_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($Funera_Leave_Per_Department_Summary_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($Funera_Leave_Per_Department_Summary_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($Funera_Leave_Per_Department_Summary_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($Funera_Leave_Per_Department_Summary_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($Funera_Leave_Per_Department_Summary->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
if ($Funera_Leave_Per_Department_Summary->ExportAll && $Funera_Leave_Per_Department_Summary->Export <> "") {
	$Funera_Leave_Per_Department_Summary_summary->StopGrp = $Funera_Leave_Per_Department_Summary_summary->TotalGrps;
} else {
	$Funera_Leave_Per_Department_Summary_summary->StopGrp = $Funera_Leave_Per_Department_Summary_summary->StartGrp + $Funera_Leave_Per_Department_Summary_summary->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($Funera_Leave_Per_Department_Summary_summary->StopGrp) > intval($Funera_Leave_Per_Department_Summary_summary->TotalGrps))
	$Funera_Leave_Per_Department_Summary_summary->StopGrp = $Funera_Leave_Per_Department_Summary_summary->TotalGrps;
$Funera_Leave_Per_Department_Summary_summary->RecCount = 0;

// Get first row
if ($Funera_Leave_Per_Department_Summary_summary->TotalGrps > 0) {
	$Funera_Leave_Per_Department_Summary_summary->GetGrpRow(1);
	$Funera_Leave_Per_Department_Summary_summary->GrpCount = 1;
}
while (($rsgrp && !$rsgrp->EOF && $Funera_Leave_Per_Department_Summary_summary->GrpCount <= $Funera_Leave_Per_Department_Summary_summary->DisplayGrps) || $Funera_Leave_Per_Department_Summary_summary->ShowFirstHeader) {

	// Show header
	if ($Funera_Leave_Per_Department_Summary_summary->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Funera_Leave_Per_Department_Summary->SortUrl($Funera_Leave_Per_Department_Summary->Department) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Funera_Leave_Per_Department_Summary->Department->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Funera_Leave_Per_Department_Summary->SortUrl($Funera_Leave_Per_Department_Summary->Department) ?>',0);"><?php echo $Funera_Leave_Per_Department_Summary->Department->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Funera_Leave_Per_Department_Summary->Department->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Funera_Leave_Per_Department_Summary->Department->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$Funera_Leave_Per_Department_Summary_summary->ShowFirstHeader = FALSE;
	}

	// Build detail SQL
	$sWhere = ewrpt_DetailFilterSQL($Funera_Leave_Per_Department_Summary->Department, $Funera_Leave_Per_Department_Summary->SqlFirstGroupField(), $Funera_Leave_Per_Department_Summary->Department->GroupValue());
	if ($Funera_Leave_Per_Department_Summary_summary->Filter != "")
		$sWhere = "($Funera_Leave_Per_Department_Summary_summary->Filter) AND ($sWhere)";
	$sSql = ewrpt_BuildReportSql($Funera_Leave_Per_Department_Summary->SqlSelect(), $Funera_Leave_Per_Department_Summary->SqlWhere(), $Funera_Leave_Per_Department_Summary->SqlGroupBy(), $Funera_Leave_Per_Department_Summary->SqlHaving(), $Funera_Leave_Per_Department_Summary->SqlOrderBy(), $sWhere, $Funera_Leave_Per_Department_Summary_summary->Sort);
	$rs = $conn->Execute($sSql);
	$rsdtlcnt = ($rs) ? $rs->RecordCount() : 0;
	if ($rsdtlcnt > 0)
		$Funera_Leave_Per_Department_Summary_summary->GetRow(1);
	while ($rs && !$rs->EOF) { // Loop detail records
		$Funera_Leave_Per_Department_Summary_summary->RecCount++;

		// Render detail row
		$Funera_Leave_Per_Department_Summary->ResetCSS();
		$Funera_Leave_Per_Department_Summary->RowType = EWRPT_ROWTYPE_DETAIL;
		$Funera_Leave_Per_Department_Summary_summary->RenderRow();
?>
<?php

		// Accumulate page summary
		$Funera_Leave_Per_Department_Summary_summary->AccumulateSummary();

		// Get next record
		$Funera_Leave_Per_Department_Summary_summary->GetRow(2);

		// Show Footers
?>
<?php
	} // End detail records loop
?>
<?php
			$Funera_Leave_Per_Department_Summary->ResetCSS();
			$Funera_Leave_Per_Department_Summary->RowType = EWRPT_ROWTYPE_TOTAL;
			$Funera_Leave_Per_Department_Summary->RowTotalType = EWRPT_ROWTOTAL_GROUP;
			$Funera_Leave_Per_Department_Summary->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
			$Funera_Leave_Per_Department_Summary->RowGroupLevel = 1;
			$Funera_Leave_Per_Department_Summary_summary->RenderRow();
?>
	<tr<?php echo $Funera_Leave_Per_Department_Summary->RowAttributes(); ?>>
		<td colspan="1"<?php echo $Funera_Leave_Per_Department_Summary->Department->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSumHead") ?> <?php echo $Funera_Leave_Per_Department_Summary->Department->FldCaption() ?>: <?php echo $Funera_Leave_Per_Department_Summary->Department->GroupViewValue; ?> (<?php echo ewrpt_FormatNumber($Funera_Leave_Per_Department_Summary_summary->Cnt[1][0],0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php

			// Reset level 1 summary
			$Funera_Leave_Per_Department_Summary_summary->ResetLevelSummary(1);
?>
<?php

	// Next group
	$Funera_Leave_Per_Department_Summary_summary->GetGrpRow(2);
	$Funera_Leave_Per_Department_Summary_summary->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
<?php
if ($Funera_Leave_Per_Department_Summary_summary->TotalGrps > 0) {
	$Funera_Leave_Per_Department_Summary->ResetCSS();
	$Funera_Leave_Per_Department_Summary->RowType = EWRPT_ROWTYPE_TOTAL;
	$Funera_Leave_Per_Department_Summary->RowTotalType = EWRPT_ROWTOTAL_GRAND;
	$Funera_Leave_Per_Department_Summary->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
	$Funera_Leave_Per_Department_Summary->RowAttrs["class"] = "ewRptGrandSummary";
	$Funera_Leave_Per_Department_Summary_summary->RenderRow();
?>
	<!-- tr><td colspan="1"><span class="phpreportmaker">&nbsp;<br /></span></td></tr -->
	<tr<?php echo $Funera_Leave_Per_Department_Summary->RowAttributes(); ?>><td colspan="1"><?php echo $ReportLanguage->Phrase("RptGrandTotal") ?> (<?php echo ewrpt_FormatNumber($Funera_Leave_Per_Department_Summary_summary->TotCount,0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php } ?>
	</tfoot>
</table>
</div>
<?php if ($Funera_Leave_Per_Department_Summary_summary->TotalGrps > 0) { ?>
<?php if ($Funera_Leave_Per_Department_Summary->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="Funera_Leave_Per_Department_Summarysmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($Funera_Leave_Per_Department_Summary_summary->StartGrp, $Funera_Leave_Per_Department_Summary_summary->DisplayGrps, $Funera_Leave_Per_Department_Summary_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="Funera_Leave_Per_Department_Summarysmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="Funera_Leave_Per_Department_Summarysmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="Funera_Leave_Per_Department_Summarysmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="Funera_Leave_Per_Department_Summarysmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($Funera_Leave_Per_Department_Summary_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($Funera_Leave_Per_Department_Summary_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($Funera_Leave_Per_Department_Summary_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($Funera_Leave_Per_Department_Summary_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($Funera_Leave_Per_Department_Summary_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($Funera_Leave_Per_Department_Summary_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($Funera_Leave_Per_Department_Summary_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($Funera_Leave_Per_Department_Summary_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($Funera_Leave_Per_Department_Summary_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($Funera_Leave_Per_Department_Summary_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($Funera_Leave_Per_Department_Summary->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php if ($Funera_Leave_Per_Department_Summary->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($Funera_Leave_Per_Department_Summary->Export == "" || $Funera_Leave_Per_Department_Summary->Export == "print" || $Funera_Leave_Per_Department_Summary->Export == "email") { ?>
<?php } ?>
<?php if ($Funera_Leave_Per_Department_Summary->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($Funera_Leave_Per_Department_Summary->Export == "" || $Funera_Leave_Per_Department_Summary->Export == "print" || $Funera_Leave_Per_Department_Summary->Export == "email") { ?>
<?php } ?>
<?php if ($Funera_Leave_Per_Department_Summary->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $Funera_Leave_Per_Department_Summary_summary->ShowPageFooter(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($Funera_Leave_Per_Department_Summary->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "phprptinc/footer.php"; ?>
<?php
$Funera_Leave_Per_Department_Summary_summary->Page_Terminate();
?>
<?php

//
// Page class
//
class crFunera_Leave_Per_Department_Summary_summary {

	// Page ID
	var $PageID = 'summary';

	// Table name
	var $TableName = 'Funera Leave Per Department Summary';

	// Page object name
	var $PageObjName = 'Funera_Leave_Per_Department_Summary_summary';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $Funera_Leave_Per_Department_Summary;
		if ($Funera_Leave_Per_Department_Summary->UseTokenInUrl) $PageUrl .= "t=" . $Funera_Leave_Per_Department_Summary->TableVar . "&"; // Add page token
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
		global $Funera_Leave_Per_Department_Summary;
		if ($Funera_Leave_Per_Department_Summary->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($Funera_Leave_Per_Department_Summary->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($Funera_Leave_Per_Department_Summary->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crFunera_Leave_Per_Department_Summary_summary() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (Funera_Leave_Per_Department_Summary)
		$GLOBALS["Funera_Leave_Per_Department_Summary"] = new crFunera_Leave_Per_Department_Summary();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'summary', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'Funera Leave Per Department Summary', TRUE);

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
		global $Funera_Leave_Per_Department_Summary;

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$Funera_Leave_Per_Department_Summary->Export = $_GET["export"];
	}
	$gsExport = $Funera_Leave_Per_Department_Summary->Export; // Get export parameter, used in header
	$gsExportFile = $Funera_Leave_Per_Department_Summary->TableVar; // Get export file, used in header
	if ($Funera_Leave_Per_Department_Summary->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($Funera_Leave_Per_Department_Summary->Export == "word") {
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
		global $Funera_Leave_Per_Department_Summary;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($Funera_Leave_Per_Department_Summary->Export == "email") {
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
		global $Funera_Leave_Per_Department_Summary;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 1;
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
		$this->Col = array(FALSE);

		// Set up groups per page dynamically
		$this->SetUpDisplayGrps();

		// Load default filter values
		$this->LoadDefaultFilters();

		// Set up popup filter
		$this->SetupPopup();

		// Extended filter
		$sExtendedFilter = "";

		// Get dropdown values
		$this->GetExtendedFilterValues();

		// Load custom filters
		$Funera_Leave_Per_Department_Summary->CustomFilters_Load();

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
		$sGrpSort = ewrpt_UpdateSortFields($Funera_Leave_Per_Department_Summary->SqlOrderByGroup(), $this->Sort, 2); // Get grouping field only
		$sSql = ewrpt_BuildReportSql($Funera_Leave_Per_Department_Summary->SqlSelectGroup(), $Funera_Leave_Per_Department_Summary->SqlWhere(), $Funera_Leave_Per_Department_Summary->SqlGroupBy(), $Funera_Leave_Per_Department_Summary->SqlHaving(), $Funera_Leave_Per_Department_Summary->SqlOrderByGroup(), $this->Filter, $sGrpSort);
		$this->TotalGrps = $this->GetGrpCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($Funera_Leave_Per_Department_Summary->ExportAll && $Funera_Leave_Per_Department_Summary->Export <> "")
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
		global $Funera_Leave_Per_Department_Summary;
		switch ($lvl) {
			case 1:
				return (is_null($Funera_Leave_Per_Department_Summary->Department->CurrentValue) && !is_null($Funera_Leave_Per_Department_Summary->Department->OldValue)) ||
					(!is_null($Funera_Leave_Per_Department_Summary->Department->CurrentValue) && is_null($Funera_Leave_Per_Department_Summary->Department->OldValue)) ||
					($Funera_Leave_Per_Department_Summary->Department->GroupValue() <> $Funera_Leave_Per_Department_Summary->Department->GroupOldValue());
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
		global $Funera_Leave_Per_Department_Summary;
		$rsgrpcnt = $conn->Execute($sql);
		$grpcnt = ($rsgrpcnt) ? $rsgrpcnt->RecordCount() : 0;
		if ($rsgrpcnt) $rsgrpcnt->Close();
		return $grpcnt;
	}

	// Get group rs
	function GetGrpRs($sql, $start, $grps) {
		global $conn;
		global $Funera_Leave_Per_Department_Summary;
		$wrksql = $sql;
		if ($start > 0 && $grps > -1)
			$wrksql .= " LIMIT " . ($start-1) . ", " . ($grps);
		$rswrk = $conn->Execute($wrksql);
		return $rswrk;
	}

	// Get group row values
	function GetGrpRow($opt) {
		global $rsgrp;
		global $Funera_Leave_Per_Department_Summary;
		if (!$rsgrp)
			return;
		if ($opt == 1) { // Get first group

			//$rsgrp->MoveFirst(); // NOTE: no need to move position
			$Funera_Leave_Per_Department_Summary->Department->setDbValue(""); // Init first value
		} else { // Get next group
			$rsgrp->MoveNext();
		}
		if (!$rsgrp->EOF)
			$Funera_Leave_Per_Department_Summary->Department->setDbValue($rsgrp->fields('Department'));
		if ($rsgrp->EOF) {
			$Funera_Leave_Per_Department_Summary->Department->setDbValue("");
		}
	}

	// Get row values
	function GetRow($opt) {
		global $rs;
		global $Funera_Leave_Per_Department_Summary;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$Funera_Leave_Per_Department_Summary->Auto_ID->setDbValue($rs->fields('Auto_ID'));
			$Funera_Leave_Per_Department_Summary->ID->setDbValue($rs->fields('ID'));
			$Funera_Leave_Per_Department_Summary->FirstName->setDbValue($rs->fields('FirstName'));
			$Funera_Leave_Per_Department_Summary->MiddelName->setDbValue($rs->fields('MiddelName'));
			$Funera_Leave_Per_Department_Summary->LastName->setDbValue($rs->fields('LastName'));
			$Funera_Leave_Per_Department_Summary->FuneralLeaveDays->setDbValue($rs->fields('FuneralLeaveDays'));
			$Funera_Leave_Per_Department_Summary->RestDay->setDbValue($rs->fields('RestDay'));
			$Funera_Leave_Per_Department_Summary->FuneralLeave_Taken_Date->setDbValue($rs->fields('FuneralLeave_Taken_Date'));
			$Funera_Leave_Per_Department_Summary->ReportOn->setDbValue($rs->fields('ReportOn'));
			$Funera_Leave_Per_Department_Summary->LeaveType->setDbValue($rs->fields('LeaveType'));
			$Funera_Leave_Per_Department_Summary->Reported->setDbValue($rs->fields('Reported'));
			$Funera_Leave_Per_Department_Summary->Report_Back_Date->setDbValue($rs->fields('Report_Back_Date'));
			if ($opt <> 1)
				$Funera_Leave_Per_Department_Summary->Department->setDbValue($rs->fields('Department'));
		} else {
			$Funera_Leave_Per_Department_Summary->Auto_ID->setDbValue("");
			$Funera_Leave_Per_Department_Summary->ID->setDbValue("");
			$Funera_Leave_Per_Department_Summary->FirstName->setDbValue("");
			$Funera_Leave_Per_Department_Summary->MiddelName->setDbValue("");
			$Funera_Leave_Per_Department_Summary->LastName->setDbValue("");
			$Funera_Leave_Per_Department_Summary->FuneralLeaveDays->setDbValue("");
			$Funera_Leave_Per_Department_Summary->RestDay->setDbValue("");
			$Funera_Leave_Per_Department_Summary->FuneralLeave_Taken_Date->setDbValue("");
			$Funera_Leave_Per_Department_Summary->ReportOn->setDbValue("");
			$Funera_Leave_Per_Department_Summary->LeaveType->setDbValue("");
			$Funera_Leave_Per_Department_Summary->Reported->setDbValue("");
			$Funera_Leave_Per_Department_Summary->Report_Back_Date->setDbValue("");
			$Funera_Leave_Per_Department_Summary->Department->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $Funera_Leave_Per_Department_Summary;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$Funera_Leave_Per_Department_Summary->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$Funera_Leave_Per_Department_Summary->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $Funera_Leave_Per_Department_Summary->getStartGroup();
			}
		} else {
			$this->StartGrp = $Funera_Leave_Per_Department_Summary->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$Funera_Leave_Per_Department_Summary->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$Funera_Leave_Per_Department_Summary->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$Funera_Leave_Per_Department_Summary->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $Funera_Leave_Per_Department_Summary;

		// Initialize popup
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
				$this->ResetPager();
			}
		}

		// Load selection criteria to array
	}

	// Reset pager
	function ResetPager() {

		// Reset start position (reset command)
		global $Funera_Leave_Per_Department_Summary;
		$this->StartGrp = 1;
		$Funera_Leave_Per_Department_Summary->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $Funera_Leave_Per_Department_Summary;
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
			$Funera_Leave_Per_Department_Summary->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$Funera_Leave_Per_Department_Summary->setStartGroup($this->StartGrp);
		} else {
			if ($Funera_Leave_Per_Department_Summary->getGroupPerPage() <> "") {
				$this->DisplayGrps = $Funera_Leave_Per_Department_Summary->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $Security;
		global $Funera_Leave_Per_Department_Summary;
		if ($Funera_Leave_Per_Department_Summary->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($Funera_Leave_Per_Department_Summary->SqlSelectCount(), $Funera_Leave_Per_Department_Summary->SqlWhere(), $Funera_Leave_Per_Department_Summary->SqlGroupBy(), $Funera_Leave_Per_Department_Summary->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}
		}

		// Call Row_Rendering event
		$Funera_Leave_Per_Department_Summary->Row_Rendering();

		/* --------------------
		'  Render view codes
		' --------------------- */
		if ($Funera_Leave_Per_Department_Summary->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// Department
			$Funera_Leave_Per_Department_Summary->Department->GroupViewValue = $Funera_Leave_Per_Department_Summary->Department->GroupOldValue();
			$Funera_Leave_Per_Department_Summary->Department->CellAttrs["class"] = ($Funera_Leave_Per_Department_Summary->RowGroupLevel == 1) ? "ewRptGrpSummary1" : "ewRptGrpField1";
			$Funera_Leave_Per_Department_Summary->Department->GroupViewValue = ewrpt_DisplayGroupValue($Funera_Leave_Per_Department_Summary->Department, $Funera_Leave_Per_Department_Summary->Department->GroupViewValue);
		} else {

			// Department
			$Funera_Leave_Per_Department_Summary->Department->GroupViewValue = $Funera_Leave_Per_Department_Summary->Department->GroupValue();
			$Funera_Leave_Per_Department_Summary->Department->CellAttrs["class"] = "ewRptGrpField1";
			$Funera_Leave_Per_Department_Summary->Department->GroupViewValue = ewrpt_DisplayGroupValue($Funera_Leave_Per_Department_Summary->Department, $Funera_Leave_Per_Department_Summary->Department->GroupViewValue);
			if ($Funera_Leave_Per_Department_Summary->Department->GroupValue() == $Funera_Leave_Per_Department_Summary->Department->GroupOldValue() && !$this->ChkLvlBreak(1))
				$Funera_Leave_Per_Department_Summary->Department->GroupViewValue = "&nbsp;";
		}

		// Department
		$Funera_Leave_Per_Department_Summary->Department->HrefValue = "";

		// Call Row_Rendered event
		$Funera_Leave_Per_Department_Summary->Row_Rendered();
	}

	// Get extended filter values
	function GetExtendedFilterValues() {
		global $Funera_Leave_Per_Department_Summary;
	}

	// Return extended filter
	function GetExtendedFilter() {
		global $Funera_Leave_Per_Department_Summary;
		global $gsFormError;
		$sFilter = "";
		$bPostBack = ewrpt_IsHttpPost();
		$bRestoreSession = TRUE;
		$bSetupFilter = FALSE;

		// Reset extended filter if filter changed
		if ($bPostBack) {

		// Reset search command
		} elseif (@$_GET["cmd"] == "reset") {

			// Load default values
			// Field ID

			$this->SetSessionFilterValues($Funera_Leave_Per_Department_Summary->ID->SearchValue, $Funera_Leave_Per_Department_Summary->ID->SearchOperator, $Funera_Leave_Per_Department_Summary->ID->SearchCondition, $Funera_Leave_Per_Department_Summary->ID->SearchValue2, $Funera_Leave_Per_Department_Summary->ID->SearchOperator2, 'ID');

			// Field FirstName
			$this->SetSessionFilterValues($Funera_Leave_Per_Department_Summary->FirstName->SearchValue, $Funera_Leave_Per_Department_Summary->FirstName->SearchOperator, $Funera_Leave_Per_Department_Summary->FirstName->SearchCondition, $Funera_Leave_Per_Department_Summary->FirstName->SearchValue2, $Funera_Leave_Per_Department_Summary->FirstName->SearchOperator2, 'FirstName');

			// Field FuneralLeaveDays
			$this->SetSessionFilterValues($Funera_Leave_Per_Department_Summary->FuneralLeaveDays->SearchValue, $Funera_Leave_Per_Department_Summary->FuneralLeaveDays->SearchOperator, $Funera_Leave_Per_Department_Summary->FuneralLeaveDays->SearchCondition, $Funera_Leave_Per_Department_Summary->FuneralLeaveDays->SearchValue2, $Funera_Leave_Per_Department_Summary->FuneralLeaveDays->SearchOperator2, 'FuneralLeaveDays');

			// Field RestDay
			$this->SetSessionFilterValues($Funera_Leave_Per_Department_Summary->RestDay->SearchValue, $Funera_Leave_Per_Department_Summary->RestDay->SearchOperator, $Funera_Leave_Per_Department_Summary->RestDay->SearchCondition, $Funera_Leave_Per_Department_Summary->RestDay->SearchValue2, $Funera_Leave_Per_Department_Summary->RestDay->SearchOperator2, 'RestDay');

			// Field FuneralLeave_Taken_Date
			$this->SetSessionFilterValues($Funera_Leave_Per_Department_Summary->FuneralLeave_Taken_Date->SearchValue, $Funera_Leave_Per_Department_Summary->FuneralLeave_Taken_Date->SearchOperator, $Funera_Leave_Per_Department_Summary->FuneralLeave_Taken_Date->SearchCondition, $Funera_Leave_Per_Department_Summary->FuneralLeave_Taken_Date->SearchValue2, $Funera_Leave_Per_Department_Summary->FuneralLeave_Taken_Date->SearchOperator2, 'FuneralLeave_Taken_Date');

			// Field ReportOn
			$this->SetSessionFilterValues($Funera_Leave_Per_Department_Summary->ReportOn->SearchValue, $Funera_Leave_Per_Department_Summary->ReportOn->SearchOperator, $Funera_Leave_Per_Department_Summary->ReportOn->SearchCondition, $Funera_Leave_Per_Department_Summary->ReportOn->SearchValue2, $Funera_Leave_Per_Department_Summary->ReportOn->SearchOperator2, 'ReportOn');

			// Field Department
			$this->SetSessionFilterValues($Funera_Leave_Per_Department_Summary->Department->SearchValue, $Funera_Leave_Per_Department_Summary->Department->SearchOperator, $Funera_Leave_Per_Department_Summary->Department->SearchCondition, $Funera_Leave_Per_Department_Summary->Department->SearchValue2, $Funera_Leave_Per_Department_Summary->Department->SearchOperator2, 'Department');
			$bSetupFilter = TRUE;
		} else {

			// Field ID
			if ($this->GetFilterValues($Funera_Leave_Per_Department_Summary->ID)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field FirstName
			if ($this->GetFilterValues($Funera_Leave_Per_Department_Summary->FirstName)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field FuneralLeaveDays
			if ($this->GetFilterValues($Funera_Leave_Per_Department_Summary->FuneralLeaveDays)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field RestDay
			if ($this->GetFilterValues($Funera_Leave_Per_Department_Summary->RestDay)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field FuneralLeave_Taken_Date
			if ($this->GetFilterValues($Funera_Leave_Per_Department_Summary->FuneralLeave_Taken_Date)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field ReportOn
			if ($this->GetFilterValues($Funera_Leave_Per_Department_Summary->ReportOn)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field Department
			if ($this->GetFilterValues($Funera_Leave_Per_Department_Summary->Department)) {
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
			$this->GetSessionFilterValues($Funera_Leave_Per_Department_Summary->ID);

			// Field FirstName
			$this->GetSessionFilterValues($Funera_Leave_Per_Department_Summary->FirstName);

			// Field FuneralLeaveDays
			$this->GetSessionFilterValues($Funera_Leave_Per_Department_Summary->FuneralLeaveDays);

			// Field RestDay
			$this->GetSessionFilterValues($Funera_Leave_Per_Department_Summary->RestDay);

			// Field FuneralLeave_Taken_Date
			$this->GetSessionFilterValues($Funera_Leave_Per_Department_Summary->FuneralLeave_Taken_Date);

			// Field ReportOn
			$this->GetSessionFilterValues($Funera_Leave_Per_Department_Summary->ReportOn);

			// Field Department
			$this->GetSessionFilterValues($Funera_Leave_Per_Department_Summary->Department);
		}

		// Call page filter validated event
		$Funera_Leave_Per_Department_Summary->Page_FilterValidated();

		// Build SQL
		// Field ID

		$this->BuildExtendedFilter($Funera_Leave_Per_Department_Summary->ID, $sFilter);

		// Field FirstName
		$this->BuildExtendedFilter($Funera_Leave_Per_Department_Summary->FirstName, $sFilter);

		// Field FuneralLeaveDays
		$this->BuildExtendedFilter($Funera_Leave_Per_Department_Summary->FuneralLeaveDays, $sFilter);

		// Field RestDay
		$this->BuildExtendedFilter($Funera_Leave_Per_Department_Summary->RestDay, $sFilter);

		// Field FuneralLeave_Taken_Date
		$this->BuildExtendedFilter($Funera_Leave_Per_Department_Summary->FuneralLeave_Taken_Date, $sFilter);

		// Field ReportOn
		$this->BuildExtendedFilter($Funera_Leave_Per_Department_Summary->ReportOn, $sFilter);

		// Field Department
		$this->BuildExtendedFilter($Funera_Leave_Per_Department_Summary->Department, $sFilter);

		// Save parms to session
		// Field ID

		$this->SetSessionFilterValues($Funera_Leave_Per_Department_Summary->ID->SearchValue, $Funera_Leave_Per_Department_Summary->ID->SearchOperator, $Funera_Leave_Per_Department_Summary->ID->SearchCondition, $Funera_Leave_Per_Department_Summary->ID->SearchValue2, $Funera_Leave_Per_Department_Summary->ID->SearchOperator2, 'ID');

		// Field FirstName
		$this->SetSessionFilterValues($Funera_Leave_Per_Department_Summary->FirstName->SearchValue, $Funera_Leave_Per_Department_Summary->FirstName->SearchOperator, $Funera_Leave_Per_Department_Summary->FirstName->SearchCondition, $Funera_Leave_Per_Department_Summary->FirstName->SearchValue2, $Funera_Leave_Per_Department_Summary->FirstName->SearchOperator2, 'FirstName');

		// Field FuneralLeaveDays
		$this->SetSessionFilterValues($Funera_Leave_Per_Department_Summary->FuneralLeaveDays->SearchValue, $Funera_Leave_Per_Department_Summary->FuneralLeaveDays->SearchOperator, $Funera_Leave_Per_Department_Summary->FuneralLeaveDays->SearchCondition, $Funera_Leave_Per_Department_Summary->FuneralLeaveDays->SearchValue2, $Funera_Leave_Per_Department_Summary->FuneralLeaveDays->SearchOperator2, 'FuneralLeaveDays');

		// Field RestDay
		$this->SetSessionFilterValues($Funera_Leave_Per_Department_Summary->RestDay->SearchValue, $Funera_Leave_Per_Department_Summary->RestDay->SearchOperator, $Funera_Leave_Per_Department_Summary->RestDay->SearchCondition, $Funera_Leave_Per_Department_Summary->RestDay->SearchValue2, $Funera_Leave_Per_Department_Summary->RestDay->SearchOperator2, 'RestDay');

		// Field FuneralLeave_Taken_Date
		$this->SetSessionFilterValues($Funera_Leave_Per_Department_Summary->FuneralLeave_Taken_Date->SearchValue, $Funera_Leave_Per_Department_Summary->FuneralLeave_Taken_Date->SearchOperator, $Funera_Leave_Per_Department_Summary->FuneralLeave_Taken_Date->SearchCondition, $Funera_Leave_Per_Department_Summary->FuneralLeave_Taken_Date->SearchValue2, $Funera_Leave_Per_Department_Summary->FuneralLeave_Taken_Date->SearchOperator2, 'FuneralLeave_Taken_Date');

		// Field ReportOn
		$this->SetSessionFilterValues($Funera_Leave_Per_Department_Summary->ReportOn->SearchValue, $Funera_Leave_Per_Department_Summary->ReportOn->SearchOperator, $Funera_Leave_Per_Department_Summary->ReportOn->SearchCondition, $Funera_Leave_Per_Department_Summary->ReportOn->SearchValue2, $Funera_Leave_Per_Department_Summary->ReportOn->SearchOperator2, 'ReportOn');

		// Field Department
		$this->SetSessionFilterValues($Funera_Leave_Per_Department_Summary->Department->SearchValue, $Funera_Leave_Per_Department_Summary->Department->SearchOperator, $Funera_Leave_Per_Department_Summary->Department->SearchCondition, $Funera_Leave_Per_Department_Summary->Department->SearchValue2, $Funera_Leave_Per_Department_Summary->Department->SearchOperator2, 'Department');

		// Setup filter
		if ($bSetupFilter) {
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
		$this->GetSessionValue($fld->DropDownValue, 'sv_Funera_Leave_Per_Department_Summary_' . $parm);
	}

	// Get filter values from session
	function GetSessionFilterValues(&$fld) {
		$parm = substr($fld->FldVar, 2);
		$this->GetSessionValue($fld->SearchValue, 'sv1_Funera_Leave_Per_Department_Summary_' . $parm);
		$this->GetSessionValue($fld->SearchOperator, 'so1_Funera_Leave_Per_Department_Summary_' . $parm);
		$this->GetSessionValue($fld->SearchCondition, 'sc_Funera_Leave_Per_Department_Summary_' . $parm);
		$this->GetSessionValue($fld->SearchValue2, 'sv2_Funera_Leave_Per_Department_Summary_' . $parm);
		$this->GetSessionValue($fld->SearchOperator2, 'so2_Funera_Leave_Per_Department_Summary_' . $parm);
	}

	// Get value from session
	function GetSessionValue(&$sv, $sn) {
		if (isset($_SESSION[$sn]))
			$sv = $_SESSION[$sn];
	}

	// Set dropdown value to session
	function SetSessionDropDownValue($sv, $parm) {
		$_SESSION['sv_Funera_Leave_Per_Department_Summary_' . $parm] = $sv;
	}

	// Set filter values to session
	function SetSessionFilterValues($sv1, $so1, $sc, $sv2, $so2, $parm) {
		$_SESSION['sv1_Funera_Leave_Per_Department_Summary_' . $parm] = $sv1;
		$_SESSION['so1_Funera_Leave_Per_Department_Summary_' . $parm] = $so1;
		$_SESSION['sc_Funera_Leave_Per_Department_Summary_' . $parm] = $sc;
		$_SESSION['sv2_Funera_Leave_Per_Department_Summary_' . $parm] = $sv2;
		$_SESSION['so2_Funera_Leave_Per_Department_Summary_' . $parm] = $so2;
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
		global $ReportLanguage, $gsFormError, $Funera_Leave_Per_Department_Summary;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EWRPT_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ewrpt_CheckInteger($Funera_Leave_Per_Department_Summary->FuneralLeaveDays->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Funera_Leave_Per_Department_Summary->FuneralLeaveDays->FldErrMsg();
		}
		if (!ewrpt_CheckInteger($Funera_Leave_Per_Department_Summary->RestDay->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Funera_Leave_Per_Department_Summary->RestDay->FldErrMsg();
		}
		if (!ewrpt_CheckDate($Funera_Leave_Per_Department_Summary->FuneralLeave_Taken_Date->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Funera_Leave_Per_Department_Summary->FuneralLeave_Taken_Date->FldErrMsg();
		}
		if (!ewrpt_CheckDate($Funera_Leave_Per_Department_Summary->ReportOn->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Funera_Leave_Per_Department_Summary->ReportOn->FldErrMsg();
		}
		if (!ewrpt_CheckDate($Funera_Leave_Per_Department_Summary->ReportOn->SearchValue2)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Funera_Leave_Per_Department_Summary->ReportOn->FldErrMsg();
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
		$_SESSION["sel_Funera_Leave_Per_Department_Summary_$parm"] = "";
		$_SESSION["rf_Funera_Leave_Per_Department_Summary_$parm"] = "";
		$_SESSION["rt_Funera_Leave_Per_Department_Summary_$parm"] = "";
	}

	// Load selection from session
	function LoadSelectionFromSession($parm) {
		global $Funera_Leave_Per_Department_Summary;
		$fld =& $Funera_Leave_Per_Department_Summary->fields($parm);
		$fld->SelectionList = @$_SESSION["sel_Funera_Leave_Per_Department_Summary_$parm"];
		$fld->RangeFrom = @$_SESSION["rf_Funera_Leave_Per_Department_Summary_$parm"];
		$fld->RangeTo = @$_SESSION["rt_Funera_Leave_Per_Department_Summary_$parm"];
	}

	// Load default value for filters
	function LoadDefaultFilters() {
		global $Funera_Leave_Per_Department_Summary;

		/**
		* Set up default values for non Text filters
		*/

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
		$this->SetDefaultExtFilter($Funera_Leave_Per_Department_Summary->ID, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Funera_Leave_Per_Department_Summary->ID);

		// Field FirstName
		$this->SetDefaultExtFilter($Funera_Leave_Per_Department_Summary->FirstName, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Funera_Leave_Per_Department_Summary->FirstName);

		// Field FuneralLeaveDays
		$this->SetDefaultExtFilter($Funera_Leave_Per_Department_Summary->FuneralLeaveDays, "USER SELECT", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Funera_Leave_Per_Department_Summary->FuneralLeaveDays);

		// Field RestDay
		$this->SetDefaultExtFilter($Funera_Leave_Per_Department_Summary->RestDay, "USER SELECT", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Funera_Leave_Per_Department_Summary->RestDay);

		// Field FuneralLeave_Taken_Date
		$this->SetDefaultExtFilter($Funera_Leave_Per_Department_Summary->FuneralLeave_Taken_Date, "USER SELECT", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Funera_Leave_Per_Department_Summary->FuneralLeave_Taken_Date);

		// Field ReportOn
		$this->SetDefaultExtFilter($Funera_Leave_Per_Department_Summary->ReportOn, "BETWEEN", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Funera_Leave_Per_Department_Summary->ReportOn);

		// Field Department
		$this->SetDefaultExtFilter($Funera_Leave_Per_Department_Summary->Department, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Funera_Leave_Per_Department_Summary->Department);

		/**
		* Set up default values for popup filters
		* NOTE: if extended filter is enabled, use default values in extended filter instead
		*/
	}

	// Check if filter applied
	function CheckFilter() {
		global $Funera_Leave_Per_Department_Summary;

		// Check ID text filter
		if ($this->TextFilterApplied($Funera_Leave_Per_Department_Summary->ID))
			return TRUE;

		// Check FirstName text filter
		if ($this->TextFilterApplied($Funera_Leave_Per_Department_Summary->FirstName))
			return TRUE;

		// Check FuneralLeaveDays text filter
		if ($this->TextFilterApplied($Funera_Leave_Per_Department_Summary->FuneralLeaveDays))
			return TRUE;

		// Check RestDay text filter
		if ($this->TextFilterApplied($Funera_Leave_Per_Department_Summary->RestDay))
			return TRUE;

		// Check FuneralLeave_Taken_Date text filter
		if ($this->TextFilterApplied($Funera_Leave_Per_Department_Summary->FuneralLeave_Taken_Date))
			return TRUE;

		// Check ReportOn text filter
		if ($this->TextFilterApplied($Funera_Leave_Per_Department_Summary->ReportOn))
			return TRUE;

		// Check Department text filter
		if ($this->TextFilterApplied($Funera_Leave_Per_Department_Summary->Department))
			return TRUE;
		return FALSE;
	}

	// Show list of filters
	function ShowFilterList() {
		global $Funera_Leave_Per_Department_Summary;
		global $ReportLanguage;

		// Initialize
		$sFilterList = "";

		// Field ID
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Funera_Leave_Per_Department_Summary->ID, $sExtWrk);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Funera_Leave_Per_Department_Summary->ID->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field FirstName
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Funera_Leave_Per_Department_Summary->FirstName, $sExtWrk);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Funera_Leave_Per_Department_Summary->FirstName->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field FuneralLeaveDays
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Funera_Leave_Per_Department_Summary->FuneralLeaveDays, $sExtWrk);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Funera_Leave_Per_Department_Summary->FuneralLeaveDays->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field RestDay
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Funera_Leave_Per_Department_Summary->RestDay, $sExtWrk);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Funera_Leave_Per_Department_Summary->RestDay->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field FuneralLeave_Taken_Date
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Funera_Leave_Per_Department_Summary->FuneralLeave_Taken_Date, $sExtWrk);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Funera_Leave_Per_Department_Summary->FuneralLeave_Taken_Date->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field ReportOn
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Funera_Leave_Per_Department_Summary->ReportOn, $sExtWrk);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Funera_Leave_Per_Department_Summary->ReportOn->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Department
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Funera_Leave_Per_Department_Summary->Department, $sExtWrk);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Funera_Leave_Per_Department_Summary->Department->FldCaption() . "<br />";
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
		global $Funera_Leave_Per_Department_Summary;
		$sWrk = "";
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $Funera_Leave_Per_Department_Summary;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$Funera_Leave_Per_Department_Summary->setOrderBy("");
				$Funera_Leave_Per_Department_Summary->setStartGroup(1);
				$Funera_Leave_Per_Department_Summary->Department->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$Funera_Leave_Per_Department_Summary->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$Funera_Leave_Per_Department_Summary->CurrentOrderType = @$_GET["ordertype"];
			$sSortSql = $Funera_Leave_Per_Department_Summary->SortSql();
			$Funera_Leave_Per_Department_Summary->setOrderBy($sSortSql);
			$Funera_Leave_Per_Department_Summary->setStartGroup(1);
		}
		return $Funera_Leave_Per_Department_Summary->getOrderBy();
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
