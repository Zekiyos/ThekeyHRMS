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
$Sick_Leave = NULL;

//
// Table class for Sick Leave
//
class crSick_Leave {
	var $TableVar = 'Sick_Leave';
	var $TableName = 'Sick Leave';
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
	var $Sick_Leave_Per_Department;
	var $Auto_ID;
	var $ID;
	var $FirstName;
	var $MiddelName;
	var $LastName;
	var $SickLeaveDays;
	var $SickLeave_Taken_Date;
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
	function crSick_Leave() {
		global $ReportLanguage;

		// Auto_ID
		$this->Auto_ID = new crField('Sick_Leave', 'Sick Leave', 'x_Auto_ID', 'Auto_ID', '`Auto_ID`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->Auto_ID->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['Auto_ID'] =& $this->Auto_ID;
		$this->Auto_ID->DateFilter = "";
		$this->Auto_ID->SqlSelect = "";
		$this->Auto_ID->SqlOrderBy = "";
		$this->Auto_ID->FldGroupByType = "";
		$this->Auto_ID->FldGroupInt = "0";
		$this->Auto_ID->FldGroupSql = "";

		// ID
		$this->ID = new crField('Sick_Leave', 'Sick Leave', 'x_ID', 'ID', '`ID`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['ID'] =& $this->ID;
		$this->ID->DateFilter = "";
		$this->ID->SqlSelect = "SELECT DISTINCT `ID` FROM " . $this->SqlFrom();
		$this->ID->SqlOrderBy = "`ID`";
		$this->ID->FldGroupByType = "";
		$this->ID->FldGroupInt = "0";
		$this->ID->FldGroupSql = "";

		// FirstName
		$this->FirstName = new crField('Sick_Leave', 'Sick Leave', 'x_FirstName', 'FirstName', '`FirstName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['FirstName'] =& $this->FirstName;
		$this->FirstName->DateFilter = "";
		$this->FirstName->SqlSelect = "SELECT DISTINCT `FirstName` FROM " . $this->SqlFrom();
		$this->FirstName->SqlOrderBy = "`FirstName`";
		$this->FirstName->FldGroupByType = "";
		$this->FirstName->FldGroupInt = "0";
		$this->FirstName->FldGroupSql = "";

		// MiddelName
		$this->MiddelName = new crField('Sick_Leave', 'Sick Leave', 'x_MiddelName', 'MiddelName', '`MiddelName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['MiddelName'] =& $this->MiddelName;
		$this->MiddelName->DateFilter = "";
		$this->MiddelName->SqlSelect = "SELECT DISTINCT `MiddelName` FROM " . $this->SqlFrom();
		$this->MiddelName->SqlOrderBy = "`MiddelName`";
		$this->MiddelName->FldGroupByType = "";
		$this->MiddelName->FldGroupInt = "0";
		$this->MiddelName->FldGroupSql = "";

		// LastName
		$this->LastName = new crField('Sick_Leave', 'Sick Leave', 'x_LastName', 'LastName', '`LastName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['LastName'] =& $this->LastName;
		$this->LastName->DateFilter = "";
		$this->LastName->SqlSelect = "SELECT DISTINCT `LastName` FROM " . $this->SqlFrom();
		$this->LastName->SqlOrderBy = "`LastName`";
		$this->LastName->FldGroupByType = "";
		$this->LastName->FldGroupInt = "0";
		$this->LastName->FldGroupSql = "";

		// SickLeaveDays
		$this->SickLeaveDays = new crField('Sick_Leave', 'Sick Leave', 'x_SickLeaveDays', 'SickLeaveDays', '`SickLeaveDays`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->SickLeaveDays->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['SickLeaveDays'] =& $this->SickLeaveDays;
		$this->SickLeaveDays->DateFilter = "";
		$this->SickLeaveDays->SqlSelect = "SELECT DISTINCT `SickLeaveDays` FROM " . $this->SqlFrom();
		$this->SickLeaveDays->SqlOrderBy = "`SickLeaveDays`";
		$this->SickLeaveDays->FldGroupByType = "";
		$this->SickLeaveDays->FldGroupInt = "0";
		$this->SickLeaveDays->FldGroupSql = "";

		// SickLeave_Taken_Date
		$this->SickLeave_Taken_Date = new crField('Sick_Leave', 'Sick Leave', 'x_SickLeave_Taken_Date', 'SickLeave_Taken_Date', '`SickLeave_Taken_Date`', 133, EWRPT_DATATYPE_DATE, 5);
		$this->SickLeave_Taken_Date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateYMD"));
		$this->fields['SickLeave_Taken_Date'] =& $this->SickLeave_Taken_Date;
		$this->SickLeave_Taken_Date->DateFilter = "";
		$this->SickLeave_Taken_Date->SqlSelect = "SELECT DISTINCT `SickLeave_Taken_Date` FROM " . $this->SqlFrom();
		$this->SickLeave_Taken_Date->SqlOrderBy = "`SickLeave_Taken_Date`";
		$this->SickLeave_Taken_Date->FldGroupByType = "";
		$this->SickLeave_Taken_Date->FldGroupInt = "0";
		$this->SickLeave_Taken_Date->FldGroupSql = "";

		// ReportOn
		$this->ReportOn = new crField('Sick_Leave', 'Sick Leave', 'x_ReportOn', 'ReportOn', '`ReportOn`', 133, EWRPT_DATATYPE_DATE, 5);
		$this->ReportOn->GroupingFieldId = 1;
		$this->ReportOn->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateYMD"));
		$this->fields['ReportOn'] =& $this->ReportOn;
		$this->ReportOn->DateFilter = "";
		$this->ReportOn->SqlSelect = "SELECT DISTINCT `ReportOn` FROM " . $this->SqlFrom();
		$this->ReportOn->SqlOrderBy = "`ReportOn`";
		$this->ReportOn->FldGroupByType = "";
		$this->ReportOn->FldGroupInt = "0";
		$this->ReportOn->FldGroupSql = "";

		// LeaveType
		$this->LeaveType = new crField('Sick_Leave', 'Sick Leave', 'x_LeaveType', 'LeaveType', '`LeaveType`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['LeaveType'] =& $this->LeaveType;
		$this->LeaveType->DateFilter = "";
		$this->LeaveType->SqlSelect = "";
		$this->LeaveType->SqlOrderBy = "";
		$this->LeaveType->FldGroupByType = "";
		$this->LeaveType->FldGroupInt = "0";
		$this->LeaveType->FldGroupSql = "";

		// Reported
		$this->Reported = new crField('Sick_Leave', 'Sick Leave', 'x_Reported', 'Reported', '`Reported`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Reported'] =& $this->Reported;
		$this->Reported->DateFilter = "";
		$this->Reported->SqlSelect = "";
		$this->Reported->SqlOrderBy = "";
		$this->Reported->FldGroupByType = "";
		$this->Reported->FldGroupInt = "0";
		$this->Reported->FldGroupSql = "";

		// Report_Back_Date
		$this->Report_Back_Date = new crField('Sick_Leave', 'Sick Leave', 'x_Report_Back_Date', 'Report_Back_Date', '`Report_Back_Date`', 133, EWRPT_DATATYPE_DATE, 5);
		$this->Report_Back_Date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateYMD"));
		$this->fields['Report_Back_Date'] =& $this->Report_Back_Date;
		$this->Report_Back_Date->DateFilter = "";
		$this->Report_Back_Date->SqlSelect = "";
		$this->Report_Back_Date->SqlOrderBy = "";
		$this->Report_Back_Date->FldGroupByType = "";
		$this->Report_Back_Date->FldGroupInt = "0";
		$this->Report_Back_Date->FldGroupSql = "";

		// Department
		$this->Department = new crField('Sick_Leave', 'Sick Leave', 'x_Department', 'Department', '`Department`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Department'] =& $this->Department;
		$this->Department->DateFilter = "";
		$this->Department->SqlSelect = "";
		$this->Department->SqlOrderBy = "";
		$this->Department->FldGroupByType = "";
		$this->Department->FldGroupInt = "0";
		$this->Department->FldGroupSql = "";

		// Sick Leave Per Department
		$this->Sick_Leave_Per_Department = new crChart('Sick_Leave', 'Sick Leave', 'Sick_Leave_Per_Department', 'Sick Leave Per Department', 'Department', 'SickLeaveDays', '', 1, 'AVG', 550, 440);
		$this->Sick_Leave_Per_Department->SqlSelect = "SELECT `Department`, '', AVG(`SickLeaveDays`) FROM ";
		$this->Sick_Leave_Per_Department->SqlGroupBy = "`Department`";
		$this->Sick_Leave_Per_Department->SqlOrderBy = "";
		$this->Sick_Leave_Per_Department->SeriesDateType = "";
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
		return "`sick_leave`";
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
		return "`ReportOn` ASC";
	}

	// Table Level Group SQL
	function SqlFirstGroupField() {
		return "`ReportOn`";
	}

	function SqlSelectGroup() {
		return "SELECT DISTINCT " . $this->SqlFirstGroupField() . " AS `ReportOn` FROM " . $this->SqlFrom();
	}

	function SqlOrderByGroup() {
		return "`ReportOn` ASC";
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
$Sick_Leave_summary = new crSick_Leave_summary();
$Page =& $Sick_Leave_summary;

// Page init
$Sick_Leave_summary->Page_Init();

// Page main
$Sick_Leave_summary->Page_Main();
?>
<?php include "phprptinc/header.php"; ?>
<?php if ($Sick_Leave->Export == "") { ?>
<script type="text/javascript">

// Create page object
var Sick_Leave_summary = new ewrpt_Page("Sick_Leave_summary");

// page properties
Sick_Leave_summary.PageID = "summary"; // page ID
Sick_Leave_summary.FormID = "fSick_Leavesummaryfilter"; // form ID
var EWRPT_PAGE_ID = Sick_Leave_summary.PageID;

// extend page with ValidateForm function
Sick_Leave_summary.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var elm = fobj.sv1_SickLeaveDays;
	if (elm && !ewrpt_CheckInteger(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Sick_Leave->SickLeaveDays->FldErrMsg()) ?>"))
			return false;
	}

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj)) return false;
	return true;
}

// extend page with Form_CustomValidate function
Sick_Leave_summary.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EWRPT_CLIENT_VALIDATE) { ?>
Sick_Leave_summary.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
Sick_Leave_summary.ValidateRequired = false; // no JavaScript validation
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
<?php $Sick_Leave_summary->ShowPageHeader(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php $Sick_Leave_summary->ShowMessage(); ?>
<?php if ($Sick_Leave->Export == "" || $Sick_Leave->Export == "print" || $Sick_Leave->Export == "email") { ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php } ?>
<?php if ($Sick_Leave->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
<?php $jsdata = ewrpt_GetJsData($Sick_Leave->ReportOn, $Sick_Leave->ReportOn->FldType); ?>
ewrpt_CreatePopup("Sick_Leave_ReportOn", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Sick_Leave->ID, $Sick_Leave->ID->FldType); ?>
ewrpt_CreatePopup("Sick_Leave_ID", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Sick_Leave->FirstName, $Sick_Leave->FirstName->FldType); ?>
ewrpt_CreatePopup("Sick_Leave_FirstName", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Sick_Leave->MiddelName, $Sick_Leave->MiddelName->FldType); ?>
ewrpt_CreatePopup("Sick_Leave_MiddelName", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Sick_Leave->LastName, $Sick_Leave->LastName->FldType); ?>
ewrpt_CreatePopup("Sick_Leave_LastName", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Sick_Leave->SickLeaveDays, $Sick_Leave->SickLeaveDays->FldType); ?>
ewrpt_CreatePopup("Sick_Leave_SickLeaveDays", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Sick_Leave->SickLeave_Taken_Date, $Sick_Leave->SickLeave_Taken_Date->FldType); ?>
ewrpt_CreatePopup("Sick_Leave_SickLeave_Taken_Date", [<?php echo $jsdata ?>]);
</script>
<div id="Sick_Leave_ReportOn_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Sick_Leave_ID_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Sick_Leave_FirstName_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Sick_Leave_MiddelName_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Sick_Leave_LastName_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Sick_Leave_SickLeaveDays_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Sick_Leave_SickLeave_Taken_Date_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<?php } ?>
<?php if ($Sick_Leave->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<?php if ($Sick_Leave->Export == "" || $Sick_Leave->Export == "print" || $Sick_Leave->Export == "email") { ?>
<?php } ?>
<?php echo $Sick_Leave->TableCaption() ?>
<?php if ($Sick_Leave->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $Sick_Leave_summary->ExportPrintUrl ?>"><?php echo $ReportLanguage->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $Sick_Leave_summary->ExportExcelUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $Sick_Leave_summary->ExportWordUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToWord") ?></a>
<?php if ($Sick_Leave_summary->FilterApplied) { ?>
&nbsp;&nbsp;<a href="Sick_Leavesmry.php?cmd=reset"><?php echo $ReportLanguage->Phrase("ResetAllFilter") ?></a>
<?php } ?>
<?php } ?>
<br /><br />
<?php if ($Sick_Leave->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($Sick_Leave->Export == "" || $Sick_Leave->Export == "print" || $Sick_Leave->Export == "email") { ?>
<?php } ?>
<?php if ($Sick_Leave->Export == "") { ?>
	</div></td>
	<!-- Left Container (End) -->
	<!-- Center Container - Report (Begin) -->
	<td style="vertical-align: top;" class="ewPadding"><div id="ewCenter" class="phpreportmaker">
	<!-- center slot -->
<?php } ?>
<!-- summary report starts -->
<div id="report_summary">
<?php if ($Sick_Leave->Export == "") { ?>
<?php
if ($Sick_Leave->FilterPanelOption == 2 || ($Sick_Leave->FilterPanelOption == 3 && $Sick_Leave_summary->FilterApplied) || $Sick_Leave_summary->Filter == "0=101") {
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
<form name="fSick_Leavesummaryfilter" id="fSick_Leavesummaryfilter" action="Sick_Leavesmry.php" class="ewForm" onsubmit="return Sick_Leave_summary.ValidateForm(this);">
<table class="ewRptExtFilter">
	<tr>
		<td><span class="phpreportmaker"><?php echo $Sick_Leave->ID->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_ID" id="so1_ID" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_ID" id="sv1_ID" size="30" maxlength="7" value="<?php echo ewrpt_HtmlEncode($Sick_Leave->ID->SearchValue) ?>"<?php echo ($Sick_Leave_summary->ClearExtFilter == 'Sick_Leave_ID') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Sick_Leave->FirstName->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_FirstName" id="so1_FirstName" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_FirstName" id="sv1_FirstName" size="30" maxlength="20" value="<?php echo ewrpt_HtmlEncode($Sick_Leave->FirstName->SearchValue) ?>"<?php echo ($Sick_Leave_summary->ClearExtFilter == 'Sick_Leave_FirstName') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Sick_Leave->MiddelName->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_MiddelName" id="so1_MiddelName" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_MiddelName" id="sv1_MiddelName" size="30" maxlength="20" value="<?php echo ewrpt_HtmlEncode($Sick_Leave->MiddelName->SearchValue) ?>"<?php echo ($Sick_Leave_summary->ClearExtFilter == 'Sick_Leave_MiddelName') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Sick_Leave->LastName->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_LastName" id="so1_LastName" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_LastName" id="sv1_LastName" size="30" maxlength="20" value="<?php echo ewrpt_HtmlEncode($Sick_Leave->LastName->SearchValue) ?>"<?php echo ($Sick_Leave_summary->ClearExtFilter == 'Sick_Leave_LastName') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Sick_Leave->SickLeaveDays->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><select name="so1_SickLeaveDays" id="so1_SickLeaveDays" onchange="ewrpt_SrchOprChanged('so1_SickLeaveDays')"><option value="="<?php if ($Sick_Leave->SickLeaveDays->SearchOperator == "=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("="); ?></option><option value="<>"<?php if ($Sick_Leave->SickLeaveDays->SearchOperator == "<>") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<>"); ?></option><option value="<"<?php if ($Sick_Leave->SickLeaveDays->SearchOperator == "<") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<"); ?></option><option value="<="<?php if ($Sick_Leave->SickLeaveDays->SearchOperator == "<=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<="); ?></option><option value=">"<?php if ($Sick_Leave->SickLeaveDays->SearchOperator == ">") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase(">"); ?></option><option value=">="<?php if ($Sick_Leave->SickLeaveDays->SearchOperator == ">=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase(">="); ?></option><option value="BETWEEN"<?php if ($Sick_Leave->SickLeaveDays->SearchOperator == "BETWEEN") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("BETWEEN"); ?></option></select></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_SickLeaveDays" id="sv1_SickLeaveDays" size="30" value="<?php echo ewrpt_HtmlEncode($Sick_Leave->SickLeaveDays->SearchValue) ?>"<?php echo ($Sick_Leave_summary->ClearExtFilter == 'Sick_Leave_SickLeaveDays') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
				<td><span class="ewRptSearchOpr" style="display: none" id="btw1_SickLeaveDays" name="btw1_SickLeaveDays">&nbsp;<?php echo $ReportLanguage->Phrase("AND") ?>&nbsp;</span></td>
				<td><span class="phpreportmaker" style="display: none" id="btw1_SickLeaveDays" name="btw1_SickLeaveDays">
<input type="text" name="sv2_SickLeaveDays" id="sv2_SickLeaveDays" size="30" value="<?php echo ewrpt_HtmlEncode($Sick_Leave->SickLeaveDays->SearchValue2) ?>"<?php echo ($Sick_Leave_summary->ClearExtFilter == 'Sick_Leave_SickLeaveDays') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Sick_Leave->SickLeave_Taken_Date->FldCaption() ?></span></td>
		<td></td>
		<td colspan="4"><span class="ewRptSearchOpr">
		<select name="sv_SickLeave_Taken_Date[]" id="sv_SickLeave_Taken_Date[]" multiple<?php echo ($Sick_Leave_summary->ClearExtFilter == 'Sick_Leave_SickLeave_Taken_Date') ? " class=\"ewInputCleared\"" : "" ?>>
		<option value="<?php echo EWRPT_ALL_VALUE; ?>"<?php if (ewrpt_MatchedFilterValue($Sick_Leave->SickLeave_Taken_Date->DropDownValue, EWRPT_ALL_VALUE)) echo " selected=\"selected\""; ?>><?php echo $ReportLanguage->Phrase("SelectAll"); ?></option>
<?php

// Popup filter
$cntf = is_array($Sick_Leave->SickLeave_Taken_Date->CustomFilters) ? count($Sick_Leave->SickLeave_Taken_Date->CustomFilters) : 0;
$cntd = is_array($Sick_Leave->SickLeave_Taken_Date->DropDownList) ? count($Sick_Leave->SickLeave_Taken_Date->DropDownList) : 0;
$totcnt = $cntf + $cntd;
$wrkcnt = 0;
	for ($i = 0; $i < $cntf; $i++) {
		if ($Sick_Leave->SickLeave_Taken_Date->CustomFilters[$i]->FldName == 'SickLeave_Taken_Date') {
?>
		<option value="<?php echo "@@" . $Sick_Leave->SickLeave_Taken_Date->CustomFilters[$i]->FilterName ?>"<?php if (ewrpt_MatchedFilterValue($Sick_Leave->SickLeave_Taken_Date->DropDownValue, "@@" . $Sick_Leave->SickLeave_Taken_Date->CustomFilters[$i]->FilterName)) echo " selected=\"selected\"" ?>><?php echo $Sick_Leave->SickLeave_Taken_Date->CustomFilters[$i]->DisplayName ?></option>
<?php
		}
		$wrkcnt += 1;
	}

//}
	for ($i = 0; $i < $cntd; $i++) {
?>
		<option value="<?php echo $Sick_Leave->SickLeave_Taken_Date->DropDownList[$i] ?>"<?php if (ewrpt_MatchedFilterValue($Sick_Leave->SickLeave_Taken_Date->DropDownValue, $Sick_Leave->SickLeave_Taken_Date->DropDownList[$i])) echo " selected=\"selected\"" ?>><?php echo ewrpt_DropDownDisplayValue($Sick_Leave->SickLeave_Taken_Date->DropDownList[$i], "date", 5) ?></option>
<?php
		$wrkcnt += 1;
	}

//}
?>
		</select>
		</span></td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Sick_Leave->ReportOn->FldCaption() ?></span></td>
		<td></td>
		<td colspan="4"><span class="ewRptSearchOpr">
		<select name="sv_ReportOn[]" id="sv_ReportOn[]" multiple<?php echo ($Sick_Leave_summary->ClearExtFilter == 'Sick_Leave_ReportOn') ? " class=\"ewInputCleared\"" : "" ?>>
		<option value="<?php echo EWRPT_ALL_VALUE; ?>"<?php if (ewrpt_MatchedFilterValue($Sick_Leave->ReportOn->DropDownValue, EWRPT_ALL_VALUE)) echo " selected=\"selected\""; ?>><?php echo $ReportLanguage->Phrase("SelectAll"); ?></option>
<?php

// Popup filter
$cntf = is_array($Sick_Leave->ReportOn->CustomFilters) ? count($Sick_Leave->ReportOn->CustomFilters) : 0;
$cntd = is_array($Sick_Leave->ReportOn->DropDownList) ? count($Sick_Leave->ReportOn->DropDownList) : 0;
$totcnt = $cntf + $cntd;
$wrkcnt = 0;
	for ($i = 0; $i < $cntf; $i++) {
		if ($Sick_Leave->ReportOn->CustomFilters[$i]->FldName == 'ReportOn') {
?>
		<option value="<?php echo "@@" . $Sick_Leave->ReportOn->CustomFilters[$i]->FilterName ?>"<?php if (ewrpt_MatchedFilterValue($Sick_Leave->ReportOn->DropDownValue, "@@" . $Sick_Leave->ReportOn->CustomFilters[$i]->FilterName)) echo " selected=\"selected\"" ?>><?php echo $Sick_Leave->ReportOn->CustomFilters[$i]->DisplayName ?></option>
<?php
		}
		$wrkcnt += 1;
	}

//}
	for ($i = 0; $i < $cntd; $i++) {
?>
		<option value="<?php echo $Sick_Leave->ReportOn->DropDownList[$i] ?>"<?php if (ewrpt_MatchedFilterValue($Sick_Leave->ReportOn->DropDownValue, $Sick_Leave->ReportOn->DropDownList[$i])) echo " selected=\"selected\"" ?>><?php echo ewrpt_DropDownDisplayValue($Sick_Leave->ReportOn->DropDownList[$i], "date", 5) ?></option>
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
ewrpt_SrchOprChanged('so1_SickLeaveDays');
</script>
<!-- Search form (end) -->
</div>
<br />
<?php } ?>
<?php if ($Sick_Leave->ShowCurrentFilter) { ?>
<div id="ewrptFilterList">
<?php $Sick_Leave_summary->ShowFilterList() ?>
</div>
<br />
<?php } ?>
<table class="ewGrid" cellspacing="0"><tr>
	<td class="ewGridContent">
<?php if ($Sick_Leave->Export == "") { ?>
<div class="ewGridUpperPanel">
<form action="Sick_Leavesmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($Sick_Leave_summary->StartGrp, $Sick_Leave_summary->DisplayGrps, $Sick_Leave_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="Sick_Leavesmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="Sick_Leavesmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="Sick_Leavesmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="Sick_Leavesmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($Sick_Leave_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($Sick_Leave_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($Sick_Leave_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($Sick_Leave_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($Sick_Leave_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($Sick_Leave_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($Sick_Leave_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($Sick_Leave_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($Sick_Leave_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($Sick_Leave_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($Sick_Leave->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
if ($Sick_Leave->ExportAll && $Sick_Leave->Export <> "") {
	$Sick_Leave_summary->StopGrp = $Sick_Leave_summary->TotalGrps;
} else {
	$Sick_Leave_summary->StopGrp = $Sick_Leave_summary->StartGrp + $Sick_Leave_summary->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($Sick_Leave_summary->StopGrp) > intval($Sick_Leave_summary->TotalGrps))
	$Sick_Leave_summary->StopGrp = $Sick_Leave_summary->TotalGrps;
$Sick_Leave_summary->RecCount = 0;

// Get first row
if ($Sick_Leave_summary->TotalGrps > 0) {
	$Sick_Leave_summary->GetGrpRow(1);
	$Sick_Leave_summary->GrpCount = 1;
}
while (($rsgrp && !$rsgrp->EOF && $Sick_Leave_summary->GrpCount <= $Sick_Leave_summary->DisplayGrps) || $Sick_Leave_summary->ShowFirstHeader) {

	// Show header
	if ($Sick_Leave_summary->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Sick_Leave->SortUrl($Sick_Leave->ReportOn) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Sick_Leave->ReportOn->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Sick_Leave->SortUrl($Sick_Leave->ReportOn) ?>',0);"><?php echo $Sick_Leave->ReportOn->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Sick_Leave->ReportOn->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Sick_Leave->ReportOn->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Sick_Leave->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Sick_Leave_ReportOn', false, '<?php echo $Sick_Leave->ReportOn->RangeFrom; ?>', '<?php echo $Sick_Leave->ReportOn->RangeTo; ?>');return false;" name="x_ReportOn<?php echo $Sick_Leave_summary->Cnt[0][0]; ?>" id="x_ReportOn<?php echo $Sick_Leave_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Sick_Leave->SortUrl($Sick_Leave->ID) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Sick_Leave->ID->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Sick_Leave->SortUrl($Sick_Leave->ID) ?>',0);"><?php echo $Sick_Leave->ID->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Sick_Leave->ID->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Sick_Leave->ID->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Sick_Leave->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Sick_Leave_ID', false, '<?php echo $Sick_Leave->ID->RangeFrom; ?>', '<?php echo $Sick_Leave->ID->RangeTo; ?>');return false;" name="x_ID<?php echo $Sick_Leave_summary->Cnt[0][0]; ?>" id="x_ID<?php echo $Sick_Leave_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Sick_Leave->SortUrl($Sick_Leave->FirstName) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Sick_Leave->FirstName->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Sick_Leave->SortUrl($Sick_Leave->FirstName) ?>',0);"><?php echo $Sick_Leave->FirstName->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Sick_Leave->FirstName->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Sick_Leave->FirstName->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Sick_Leave->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Sick_Leave_FirstName', false, '<?php echo $Sick_Leave->FirstName->RangeFrom; ?>', '<?php echo $Sick_Leave->FirstName->RangeTo; ?>');return false;" name="x_FirstName<?php echo $Sick_Leave_summary->Cnt[0][0]; ?>" id="x_FirstName<?php echo $Sick_Leave_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Sick_Leave->SortUrl($Sick_Leave->MiddelName) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Sick_Leave->MiddelName->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Sick_Leave->SortUrl($Sick_Leave->MiddelName) ?>',0);"><?php echo $Sick_Leave->MiddelName->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Sick_Leave->MiddelName->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Sick_Leave->MiddelName->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Sick_Leave->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Sick_Leave_MiddelName', false, '<?php echo $Sick_Leave->MiddelName->RangeFrom; ?>', '<?php echo $Sick_Leave->MiddelName->RangeTo; ?>');return false;" name="x_MiddelName<?php echo $Sick_Leave_summary->Cnt[0][0]; ?>" id="x_MiddelName<?php echo $Sick_Leave_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Sick_Leave->SortUrl($Sick_Leave->LastName) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Sick_Leave->LastName->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Sick_Leave->SortUrl($Sick_Leave->LastName) ?>',0);"><?php echo $Sick_Leave->LastName->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Sick_Leave->LastName->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Sick_Leave->LastName->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Sick_Leave->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Sick_Leave_LastName', false, '<?php echo $Sick_Leave->LastName->RangeFrom; ?>', '<?php echo $Sick_Leave->LastName->RangeTo; ?>');return false;" name="x_LastName<?php echo $Sick_Leave_summary->Cnt[0][0]; ?>" id="x_LastName<?php echo $Sick_Leave_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Sick_Leave->SortUrl($Sick_Leave->SickLeaveDays) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Sick_Leave->SickLeaveDays->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Sick_Leave->SortUrl($Sick_Leave->SickLeaveDays) ?>',0);"><?php echo $Sick_Leave->SickLeaveDays->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Sick_Leave->SickLeaveDays->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Sick_Leave->SickLeaveDays->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Sick_Leave->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Sick_Leave_SickLeaveDays', false, '<?php echo $Sick_Leave->SickLeaveDays->RangeFrom; ?>', '<?php echo $Sick_Leave->SickLeaveDays->RangeTo; ?>');return false;" name="x_SickLeaveDays<?php echo $Sick_Leave_summary->Cnt[0][0]; ?>" id="x_SickLeaveDays<?php echo $Sick_Leave_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Sick_Leave->SortUrl($Sick_Leave->SickLeave_Taken_Date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Sick_Leave->SickLeave_Taken_Date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Sick_Leave->SortUrl($Sick_Leave->SickLeave_Taken_Date) ?>',0);"><?php echo $Sick_Leave->SickLeave_Taken_Date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Sick_Leave->SickLeave_Taken_Date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Sick_Leave->SickLeave_Taken_Date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Sick_Leave->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Sick_Leave_SickLeave_Taken_Date', false, '<?php echo $Sick_Leave->SickLeave_Taken_Date->RangeFrom; ?>', '<?php echo $Sick_Leave->SickLeave_Taken_Date->RangeTo; ?>');return false;" name="x_SickLeave_Taken_Date<?php echo $Sick_Leave_summary->Cnt[0][0]; ?>" id="x_SickLeave_Taken_Date<?php echo $Sick_Leave_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Sick_Leave->SortUrl($Sick_Leave->Department) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Sick_Leave->Department->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Sick_Leave->SortUrl($Sick_Leave->Department) ?>',0);"><?php echo $Sick_Leave->Department->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Sick_Leave->Department->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Sick_Leave->Department->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$Sick_Leave_summary->ShowFirstHeader = FALSE;
	}

	// Build detail SQL
	$sWhere = ewrpt_DetailFilterSQL($Sick_Leave->ReportOn, $Sick_Leave->SqlFirstGroupField(), $Sick_Leave->ReportOn->GroupValue());
	if ($Sick_Leave_summary->Filter != "")
		$sWhere = "($Sick_Leave_summary->Filter) AND ($sWhere)";
	$sSql = ewrpt_BuildReportSql($Sick_Leave->SqlSelect(), $Sick_Leave->SqlWhere(), $Sick_Leave->SqlGroupBy(), $Sick_Leave->SqlHaving(), $Sick_Leave->SqlOrderBy(), $sWhere, $Sick_Leave_summary->Sort);
	$rs = $conn->Execute($sSql);
	$rsdtlcnt = ($rs) ? $rs->RecordCount() : 0;
	if ($rsdtlcnt > 0)
		$Sick_Leave_summary->GetRow(1);
	while ($rs && !$rs->EOF) { // Loop detail records
		$Sick_Leave_summary->RecCount++;

		// Render detail row
		$Sick_Leave->ResetCSS();
		$Sick_Leave->RowType = EWRPT_ROWTYPE_DETAIL;
		$Sick_Leave_summary->RenderRow();
?>
	<tr<?php echo $Sick_Leave->RowAttributes(); ?>>
		<td<?php echo $Sick_Leave->ReportOn->CellAttributes(); ?>><div<?php echo $Sick_Leave->ReportOn->ViewAttributes(); ?>><?php echo $Sick_Leave->ReportOn->GroupViewValue; ?></div></td>
		<td<?php echo $Sick_Leave->ID->CellAttributes() ?>>
<div<?php echo $Sick_Leave->ID->ViewAttributes(); ?>><?php echo $Sick_Leave->ID->ListViewValue(); ?></div>
</td>
		<td<?php echo $Sick_Leave->FirstName->CellAttributes() ?>>
<div<?php echo $Sick_Leave->FirstName->ViewAttributes(); ?>><?php echo $Sick_Leave->FirstName->ListViewValue(); ?></div>
</td>
		<td<?php echo $Sick_Leave->MiddelName->CellAttributes() ?>>
<div<?php echo $Sick_Leave->MiddelName->ViewAttributes(); ?>><?php echo $Sick_Leave->MiddelName->ListViewValue(); ?></div>
</td>
		<td<?php echo $Sick_Leave->LastName->CellAttributes() ?>>
<div<?php echo $Sick_Leave->LastName->ViewAttributes(); ?>><?php echo $Sick_Leave->LastName->ListViewValue(); ?></div>
</td>
		<td<?php echo $Sick_Leave->SickLeaveDays->CellAttributes() ?>>
<div<?php echo $Sick_Leave->SickLeaveDays->ViewAttributes(); ?>><?php echo $Sick_Leave->SickLeaveDays->ListViewValue(); ?></div>
</td>
		<td<?php echo $Sick_Leave->SickLeave_Taken_Date->CellAttributes() ?>>
<div<?php echo $Sick_Leave->SickLeave_Taken_Date->ViewAttributes(); ?>><?php echo $Sick_Leave->SickLeave_Taken_Date->ListViewValue(); ?></div>
</td>
		<td<?php echo $Sick_Leave->Department->CellAttributes() ?>>
<div<?php echo $Sick_Leave->Department->ViewAttributes(); ?>><?php echo $Sick_Leave->Department->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$Sick_Leave_summary->AccumulateSummary();

		// Get next record
		$Sick_Leave_summary->GetRow(2);

		// Show Footers
?>
<?php
	} // End detail records loop
?>
<?php

	// Next group
	$Sick_Leave_summary->GetGrpRow(2);
	$Sick_Leave_summary->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
<?php
if ($Sick_Leave_summary->TotalGrps > 0) {
	$Sick_Leave->ResetCSS();
	$Sick_Leave->RowType = EWRPT_ROWTYPE_TOTAL;
	$Sick_Leave->RowTotalType = EWRPT_ROWTOTAL_GRAND;
	$Sick_Leave->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
	$Sick_Leave->RowAttrs["class"] = "ewRptGrandSummary";
	$Sick_Leave_summary->RenderRow();
?>
	<!-- tr><td colspan="8"><span class="phpreportmaker">&nbsp;<br /></span></td></tr -->
	<tr<?php echo $Sick_Leave->RowAttributes(); ?>><td colspan="8"><?php echo $ReportLanguage->Phrase("RptGrandTotal") ?> (<?php echo ewrpt_FormatNumber($Sick_Leave_summary->TotCount,0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php } ?>
	</tfoot>
</table>
</div>
<?php if ($Sick_Leave_summary->TotalGrps > 0) { ?>
<?php if ($Sick_Leave->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="Sick_Leavesmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($Sick_Leave_summary->StartGrp, $Sick_Leave_summary->DisplayGrps, $Sick_Leave_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="Sick_Leavesmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="Sick_Leavesmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="Sick_Leavesmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="Sick_Leavesmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($Sick_Leave_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($Sick_Leave_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($Sick_Leave_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($Sick_Leave_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($Sick_Leave_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($Sick_Leave_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($Sick_Leave_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($Sick_Leave_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($Sick_Leave_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($Sick_Leave_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($Sick_Leave->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php if ($Sick_Leave->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($Sick_Leave->Export == "" || $Sick_Leave->Export == "print" || $Sick_Leave->Export == "email") { ?>
<?php } ?>
<?php if ($Sick_Leave->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3" class="ewPadding"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($Sick_Leave->Export == "" || $Sick_Leave->Export == "print" || $Sick_Leave->Export == "email") { ?>
<a name="cht_Sick_Leave_Per_Department"></a>
<div id="div_Sick_Leave_Sick_Leave_Per_Department"></div>
<?php

// Initialize chart data
$Sick_Leave->Sick_Leave_Per_Department->ID = "Sick_Leave_Sick_Leave_Per_Department"; // Chart ID
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("type", "1", FALSE); // Chart type
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("seriestype", "0", FALSE); // Chart series type
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("bgcolor", "#FCFCFC", TRUE); // Background color
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("caption", $Sick_Leave->Sick_Leave_Per_Department->ChartCaption(), TRUE); // Chart caption
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("xaxisname", $Sick_Leave->Sick_Leave_Per_Department->ChartXAxisName(), TRUE); // X axis name
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("yaxisname", $Sick_Leave->Sick_Leave_Per_Department->ChartYAxisName(), TRUE); // Y axis name
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("shownames", "1", TRUE); // Show names
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("showvalues", "1", TRUE); // Show values
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("showhovercap", "0", TRUE); // Show hover
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("alpha", "50", FALSE); // Chart alpha
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("colorpalette", "#FF0000|#FF0080|#FF00FF|#8000FF|#FF8000|#FF3D3D|#7AFFFF|#0000FF|#FFFF00|#FF7A7A|#3DFFFF|#0080FF|#80FF00|#00FF00|#00FF80|#00FFFF", FALSE); // Chart color palette
?>
<?php
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("showCanvasBg", "1", TRUE); // showCanvasBg
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("showCanvasBase", "1", TRUE); // showCanvasBase
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("showLimits", "1", TRUE); // showLimits
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("animation", "1", TRUE); // animation
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("rotateNames", "0", TRUE); // rotateNames
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("yAxisMinValue", "0", TRUE); // yAxisMinValue
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("yAxisMaxValue", "0", TRUE); // yAxisMaxValue
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("PYAxisMinValue", "0", TRUE); // PYAxisMinValue
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("PYAxisMaxValue", "0", TRUE); // PYAxisMaxValue
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("SYAxisMinValue", "0", TRUE); // SYAxisMinValue
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("SYAxisMaxValue", "0", TRUE); // SYAxisMaxValue
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("showColumnShadow", "0", TRUE); // showColumnShadow
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("showPercentageValues", "1", TRUE); // showPercentageValues
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("showPercentageInLabel", "1", TRUE); // showPercentageInLabel
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("showBarShadow", "0", TRUE); // showBarShadow
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("showAnchors", "1", TRUE); // showAnchors
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("showAreaBorder", "1", TRUE); // showAreaBorder
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("isSliced", "1", TRUE); // isSliced
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("showAsBars", "0", TRUE); // showAsBars
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("showShadow", "0", TRUE); // showShadow
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("formatNumber", "0", TRUE); // formatNumber
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("formatNumberScale", "0", TRUE); // formatNumberScale
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("decimalSeparator", ".", TRUE); // decimalSeparator
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("thousandSeparator", ",", TRUE); // thousandSeparator
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("decimalPrecision", "2", TRUE); // decimalPrecision
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("divLineDecimalPrecision", "2", TRUE); // divLineDecimalPrecision
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("limitsDecimalPrecision", "2", TRUE); // limitsDecimalPrecision
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("zeroPlaneShowBorder", "1", TRUE); // zeroPlaneShowBorder
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("showDivLineValue", "1", TRUE); // showDivLineValue
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("showAlternateHGridColor", "0", TRUE); // showAlternateHGridColor
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("showAlternateVGridColor", "0", TRUE); // showAlternateVGridColor
$Sick_Leave->Sick_Leave_Per_Department->SetChartParam("hoverCapSepChar", ":", TRUE); // hoverCapSepChar

// Define trend lines
?>
<?php
$SqlSelect = $Sick_Leave->SqlSelect();
$SqlChartSelect = $Sick_Leave->Sick_Leave_Per_Department->SqlSelect;
$sSqlChartBase = $Sick_Leave->SqlFrom();

// Load chart data from sql directly
$sSql = $SqlChartSelect . $sSqlChartBase;
$sSql = ewrpt_BuildReportSql($sSql, $Sick_Leave->SqlWhere(), $Sick_Leave->Sick_Leave_Per_Department->SqlGroupBy, "", $Sick_Leave->Sick_Leave_Per_Department->SqlOrderBy, $Sick_Leave_summary->Filter, "");
if (EWRPT_DEBUG_ENABLED) echo "(Chart SQL): " . $sSql . "<br>";
ewrpt_LoadChartData($sSql, $Sick_Leave->Sick_Leave_Per_Department);
ewrpt_SortChartData($Sick_Leave->Sick_Leave_Per_Department->Data, 0, "");

// Call Chart_Rendering event
$Sick_Leave->Chart_Rendering($Sick_Leave->Sick_Leave_Per_Department);
$chartxml = $Sick_Leave->Sick_Leave_Per_Department->ChartXml();

// Call Chart_Rendered event
$Sick_Leave->Chart_Rendered($Sick_Leave->Sick_Leave_Per_Department, $chartxml);
echo $Sick_Leave->Sick_Leave_Per_Department->ShowChartFCF($chartxml);
?>
<a href="#top"><?php echo $ReportLanguage->Phrase("Top") ?></a>
<br /><br />
<?php } ?>
<?php if ($Sick_Leave->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $Sick_Leave_summary->ShowPageFooter(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($Sick_Leave->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "phprptinc/footer.php"; ?>
<?php
$Sick_Leave_summary->Page_Terminate();
?>
<?php

//
// Page class
//
class crSick_Leave_summary {

	// Page ID
	var $PageID = 'summary';

	// Table name
	var $TableName = 'Sick Leave';

	// Page object name
	var $PageObjName = 'Sick_Leave_summary';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $Sick_Leave;
		if ($Sick_Leave->UseTokenInUrl) $PageUrl .= "t=" . $Sick_Leave->TableVar . "&"; // Add page token
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
		global $Sick_Leave;
		if ($Sick_Leave->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($Sick_Leave->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($Sick_Leave->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crSick_Leave_summary() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (Sick_Leave)
		$GLOBALS["Sick_Leave"] = new crSick_Leave();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'summary', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'Sick Leave', TRUE);

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
		global $Sick_Leave;

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$Sick_Leave->Export = $_GET["export"];
	}
	$gsExport = $Sick_Leave->Export; // Get export parameter, used in header
	$gsExportFile = $Sick_Leave->TableVar; // Get export file, used in header
	if ($Sick_Leave->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($Sick_Leave->Export == "word") {
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
		global $Sick_Leave;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($Sick_Leave->Export == "email") {
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
		global $Sick_Leave;
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
		$Sick_Leave->ReportOn->SelectionList = "";
		$Sick_Leave->ReportOn->DefaultSelectionList = "";
		$Sick_Leave->ReportOn->ValueList = "";
		$Sick_Leave->ID->SelectionList = "";
		$Sick_Leave->ID->DefaultSelectionList = "";
		$Sick_Leave->ID->ValueList = "";
		$Sick_Leave->FirstName->SelectionList = "";
		$Sick_Leave->FirstName->DefaultSelectionList = "";
		$Sick_Leave->FirstName->ValueList = "";
		$Sick_Leave->MiddelName->SelectionList = "";
		$Sick_Leave->MiddelName->DefaultSelectionList = "";
		$Sick_Leave->MiddelName->ValueList = "";
		$Sick_Leave->LastName->SelectionList = "";
		$Sick_Leave->LastName->DefaultSelectionList = "";
		$Sick_Leave->LastName->ValueList = "";
		$Sick_Leave->SickLeaveDays->SelectionList = "";
		$Sick_Leave->SickLeaveDays->DefaultSelectionList = "";
		$Sick_Leave->SickLeaveDays->ValueList = "";
		$Sick_Leave->SickLeave_Taken_Date->SelectionList = "";
		$Sick_Leave->SickLeave_Taken_Date->DefaultSelectionList = "";
		$Sick_Leave->SickLeave_Taken_Date->ValueList = "";

		// Load default filter values
		$this->LoadDefaultFilters();

		// Set up popup filter
		$this->SetupPopup();

		// Extended filter
		$sExtendedFilter = "";

		// Get dropdown values
		$this->GetExtendedFilterValues();

		// Load custom filters
		$Sick_Leave->CustomFilters_Load();

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
		$sGrpSort = ewrpt_UpdateSortFields($Sick_Leave->SqlOrderByGroup(), $this->Sort, 2); // Get grouping field only
		$sSql = ewrpt_BuildReportSql($Sick_Leave->SqlSelectGroup(), $Sick_Leave->SqlWhere(), $Sick_Leave->SqlGroupBy(), $Sick_Leave->SqlHaving(), $Sick_Leave->SqlOrderByGroup(), $this->Filter, $sGrpSort);
		$this->TotalGrps = $this->GetGrpCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($Sick_Leave->ExportAll && $Sick_Leave->Export <> "")
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
		global $Sick_Leave;
		switch ($lvl) {
			case 1:
				return (is_null($Sick_Leave->ReportOn->CurrentValue) && !is_null($Sick_Leave->ReportOn->OldValue)) ||
					(!is_null($Sick_Leave->ReportOn->CurrentValue) && is_null($Sick_Leave->ReportOn->OldValue)) ||
					($Sick_Leave->ReportOn->GroupValue() <> $Sick_Leave->ReportOn->GroupOldValue());
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
		global $Sick_Leave;
		$rsgrpcnt = $conn->Execute($sql);
		$grpcnt = ($rsgrpcnt) ? $rsgrpcnt->RecordCount() : 0;
		if ($rsgrpcnt) $rsgrpcnt->Close();
		return $grpcnt;
	}

	// Get group rs
	function GetGrpRs($sql, $start, $grps) {
		global $conn;
		global $Sick_Leave;
		$wrksql = $sql;
		if ($start > 0 && $grps > -1)
			$wrksql .= " LIMIT " . ($start-1) . ", " . ($grps);
		$rswrk = $conn->Execute($wrksql);
		return $rswrk;
	}

	// Get group row values
	function GetGrpRow($opt) {
		global $rsgrp;
		global $Sick_Leave;
		if (!$rsgrp)
			return;
		if ($opt == 1) { // Get first group

			//$rsgrp->MoveFirst(); // NOTE: no need to move position
			$Sick_Leave->ReportOn->setDbValue(""); // Init first value
		} else { // Get next group
			$rsgrp->MoveNext();
		}
		if (!$rsgrp->EOF)
			$Sick_Leave->ReportOn->setDbValue($rsgrp->fields('ReportOn'));
		if ($rsgrp->EOF) {
			$Sick_Leave->ReportOn->setDbValue("");
		}
	}

	// Get row values
	function GetRow($opt) {
		global $rs;
		global $Sick_Leave;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$Sick_Leave->Auto_ID->setDbValue($rs->fields('Auto_ID'));
			$Sick_Leave->ID->setDbValue($rs->fields('ID'));
			$Sick_Leave->FirstName->setDbValue($rs->fields('FirstName'));
			$Sick_Leave->MiddelName->setDbValue($rs->fields('MiddelName'));
			$Sick_Leave->LastName->setDbValue($rs->fields('LastName'));
			$Sick_Leave->SickLeaveDays->setDbValue($rs->fields('SickLeaveDays'));
			$Sick_Leave->SickLeave_Taken_Date->setDbValue($rs->fields('SickLeave_Taken_Date'));
			if ($opt <> 1)
				$Sick_Leave->ReportOn->setDbValue($rs->fields('ReportOn'));
			$Sick_Leave->LeaveType->setDbValue($rs->fields('LeaveType'));
			$Sick_Leave->Reported->setDbValue($rs->fields('Reported'));
			$Sick_Leave->Report_Back_Date->setDbValue($rs->fields('Report_Back_Date'));
			$Sick_Leave->Department->setDbValue($rs->fields('Department'));
			$this->Val[1] = $Sick_Leave->ID->CurrentValue;
			$this->Val[2] = $Sick_Leave->FirstName->CurrentValue;
			$this->Val[3] = $Sick_Leave->MiddelName->CurrentValue;
			$this->Val[4] = $Sick_Leave->LastName->CurrentValue;
			$this->Val[5] = $Sick_Leave->SickLeaveDays->CurrentValue;
			$this->Val[6] = $Sick_Leave->SickLeave_Taken_Date->CurrentValue;
			$this->Val[7] = $Sick_Leave->Department->CurrentValue;
		} else {
			$Sick_Leave->Auto_ID->setDbValue("");
			$Sick_Leave->ID->setDbValue("");
			$Sick_Leave->FirstName->setDbValue("");
			$Sick_Leave->MiddelName->setDbValue("");
			$Sick_Leave->LastName->setDbValue("");
			$Sick_Leave->SickLeaveDays->setDbValue("");
			$Sick_Leave->SickLeave_Taken_Date->setDbValue("");
			$Sick_Leave->ReportOn->setDbValue("");
			$Sick_Leave->LeaveType->setDbValue("");
			$Sick_Leave->Reported->setDbValue("");
			$Sick_Leave->Report_Back_Date->setDbValue("");
			$Sick_Leave->Department->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $Sick_Leave;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$Sick_Leave->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$Sick_Leave->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $Sick_Leave->getStartGroup();
			}
		} else {
			$this->StartGrp = $Sick_Leave->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$Sick_Leave->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$Sick_Leave->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$Sick_Leave->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $Sick_Leave;

		// Initialize popup
		// Build distinct values for ReportOn

		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Sick_Leave->ReportOn->SqlSelect, $Sick_Leave->SqlWhere(), $Sick_Leave->SqlGroupBy(), $Sick_Leave->SqlHaving(), $Sick_Leave->ReportOn->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Sick_Leave->ReportOn->setDbValue($rswrk->fields[0]);
			if (is_null($Sick_Leave->ReportOn->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Sick_Leave->ReportOn->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Sick_Leave->ReportOn->GroupViewValue = ewrpt_DisplayGroupValue($Sick_Leave->ReportOn,ewrpt_FormatDateTime($Sick_Leave->ReportOn->GroupValue(), 5));
				ewrpt_SetupDistinctValues($Sick_Leave->ReportOn->ValueList, $Sick_Leave->ReportOn->GroupValue(), $Sick_Leave->ReportOn->GroupViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Sick_Leave->ReportOn->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Sick_Leave->ReportOn->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for ID
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Sick_Leave->ID->SqlSelect, $Sick_Leave->SqlWhere(), $Sick_Leave->SqlGroupBy(), $Sick_Leave->SqlHaving(), $Sick_Leave->ID->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Sick_Leave->ID->setDbValue($rswrk->fields[0]);
			if (is_null($Sick_Leave->ID->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Sick_Leave->ID->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Sick_Leave->ID->ViewValue = $Sick_Leave->ID->CurrentValue;
				ewrpt_SetupDistinctValues($Sick_Leave->ID->ValueList, $Sick_Leave->ID->CurrentValue, $Sick_Leave->ID->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Sick_Leave->ID->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Sick_Leave->ID->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for FirstName
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Sick_Leave->FirstName->SqlSelect, $Sick_Leave->SqlWhere(), $Sick_Leave->SqlGroupBy(), $Sick_Leave->SqlHaving(), $Sick_Leave->FirstName->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Sick_Leave->FirstName->setDbValue($rswrk->fields[0]);
			if (is_null($Sick_Leave->FirstName->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Sick_Leave->FirstName->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Sick_Leave->FirstName->ViewValue = $Sick_Leave->FirstName->CurrentValue;
				ewrpt_SetupDistinctValues($Sick_Leave->FirstName->ValueList, $Sick_Leave->FirstName->CurrentValue, $Sick_Leave->FirstName->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Sick_Leave->FirstName->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Sick_Leave->FirstName->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for MiddelName
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Sick_Leave->MiddelName->SqlSelect, $Sick_Leave->SqlWhere(), $Sick_Leave->SqlGroupBy(), $Sick_Leave->SqlHaving(), $Sick_Leave->MiddelName->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Sick_Leave->MiddelName->setDbValue($rswrk->fields[0]);
			if (is_null($Sick_Leave->MiddelName->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Sick_Leave->MiddelName->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Sick_Leave->MiddelName->ViewValue = $Sick_Leave->MiddelName->CurrentValue;
				ewrpt_SetupDistinctValues($Sick_Leave->MiddelName->ValueList, $Sick_Leave->MiddelName->CurrentValue, $Sick_Leave->MiddelName->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Sick_Leave->MiddelName->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Sick_Leave->MiddelName->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for LastName
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Sick_Leave->LastName->SqlSelect, $Sick_Leave->SqlWhere(), $Sick_Leave->SqlGroupBy(), $Sick_Leave->SqlHaving(), $Sick_Leave->LastName->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Sick_Leave->LastName->setDbValue($rswrk->fields[0]);
			if (is_null($Sick_Leave->LastName->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Sick_Leave->LastName->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Sick_Leave->LastName->ViewValue = $Sick_Leave->LastName->CurrentValue;
				ewrpt_SetupDistinctValues($Sick_Leave->LastName->ValueList, $Sick_Leave->LastName->CurrentValue, $Sick_Leave->LastName->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Sick_Leave->LastName->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Sick_Leave->LastName->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for SickLeaveDays
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Sick_Leave->SickLeaveDays->SqlSelect, $Sick_Leave->SqlWhere(), $Sick_Leave->SqlGroupBy(), $Sick_Leave->SqlHaving(), $Sick_Leave->SickLeaveDays->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Sick_Leave->SickLeaveDays->setDbValue($rswrk->fields[0]);
			if (is_null($Sick_Leave->SickLeaveDays->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Sick_Leave->SickLeaveDays->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Sick_Leave->SickLeaveDays->ViewValue = $Sick_Leave->SickLeaveDays->CurrentValue;
				ewrpt_SetupDistinctValues($Sick_Leave->SickLeaveDays->ValueList, $Sick_Leave->SickLeaveDays->CurrentValue, $Sick_Leave->SickLeaveDays->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Sick_Leave->SickLeaveDays->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Sick_Leave->SickLeaveDays->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for SickLeave_Taken_Date
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Sick_Leave->SickLeave_Taken_Date->SqlSelect, $Sick_Leave->SqlWhere(), $Sick_Leave->SqlGroupBy(), $Sick_Leave->SqlHaving(), $Sick_Leave->SickLeave_Taken_Date->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Sick_Leave->SickLeave_Taken_Date->setDbValue($rswrk->fields[0]);
			if (is_null($Sick_Leave->SickLeave_Taken_Date->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Sick_Leave->SickLeave_Taken_Date->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Sick_Leave->SickLeave_Taken_Date->ViewValue = ewrpt_FormatDateTime($Sick_Leave->SickLeave_Taken_Date->CurrentValue, 5);
				ewrpt_SetupDistinctValues($Sick_Leave->SickLeave_Taken_Date->ValueList, $Sick_Leave->SickLeave_Taken_Date->CurrentValue, $Sick_Leave->SickLeave_Taken_Date->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Sick_Leave->SickLeave_Taken_Date->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Sick_Leave->SickLeave_Taken_Date->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

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
				$this->ClearSessionSelection('ReportOn');
				$this->ClearSessionSelection('ID');
				$this->ClearSessionSelection('FirstName');
				$this->ClearSessionSelection('MiddelName');
				$this->ClearSessionSelection('LastName');
				$this->ClearSessionSelection('SickLeaveDays');
				$this->ClearSessionSelection('SickLeave_Taken_Date');
				$this->ResetPager();
			}
		}

		// Load selection criteria to array
		// Get Report On selected values

		if (is_array(@$_SESSION["sel_Sick_Leave_ReportOn"])) {
			$this->LoadSelectionFromSession('ReportOn');
		} elseif (@$_SESSION["sel_Sick_Leave_ReportOn"] == EWRPT_INIT_VALUE) { // Select all
			$Sick_Leave->ReportOn->SelectionList = "";
		}

		// Get ID selected values
		if (is_array(@$_SESSION["sel_Sick_Leave_ID"])) {
			$this->LoadSelectionFromSession('ID');
		} elseif (@$_SESSION["sel_Sick_Leave_ID"] == EWRPT_INIT_VALUE) { // Select all
			$Sick_Leave->ID->SelectionList = "";
		}

		// Get First Name selected values
		if (is_array(@$_SESSION["sel_Sick_Leave_FirstName"])) {
			$this->LoadSelectionFromSession('FirstName');
		} elseif (@$_SESSION["sel_Sick_Leave_FirstName"] == EWRPT_INIT_VALUE) { // Select all
			$Sick_Leave->FirstName->SelectionList = "";
		}

		// Get Middel Name selected values
		if (is_array(@$_SESSION["sel_Sick_Leave_MiddelName"])) {
			$this->LoadSelectionFromSession('MiddelName');
		} elseif (@$_SESSION["sel_Sick_Leave_MiddelName"] == EWRPT_INIT_VALUE) { // Select all
			$Sick_Leave->MiddelName->SelectionList = "";
		}

		// Get Last Name selected values
		if (is_array(@$_SESSION["sel_Sick_Leave_LastName"])) {
			$this->LoadSelectionFromSession('LastName');
		} elseif (@$_SESSION["sel_Sick_Leave_LastName"] == EWRPT_INIT_VALUE) { // Select all
			$Sick_Leave->LastName->SelectionList = "";
		}

		// Get Sick Leave Days selected values
		if (is_array(@$_SESSION["sel_Sick_Leave_SickLeaveDays"])) {
			$this->LoadSelectionFromSession('SickLeaveDays');
		} elseif (@$_SESSION["sel_Sick_Leave_SickLeaveDays"] == EWRPT_INIT_VALUE) { // Select all
			$Sick_Leave->SickLeaveDays->SelectionList = "";
		}

		// Get Sick Leave Taken Date selected values
		if (is_array(@$_SESSION["sel_Sick_Leave_SickLeave_Taken_Date"])) {
			$this->LoadSelectionFromSession('SickLeave_Taken_Date');
		} elseif (@$_SESSION["sel_Sick_Leave_SickLeave_Taken_Date"] == EWRPT_INIT_VALUE) { // Select all
			$Sick_Leave->SickLeave_Taken_Date->SelectionList = "";
		}
	}

	// Reset pager
	function ResetPager() {

		// Reset start position (reset command)
		global $Sick_Leave;
		$this->StartGrp = 1;
		$Sick_Leave->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $Sick_Leave;
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
			$Sick_Leave->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$Sick_Leave->setStartGroup($this->StartGrp);
		} else {
			if ($Sick_Leave->getGroupPerPage() <> "") {
				$this->DisplayGrps = $Sick_Leave->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $Security;
		global $Sick_Leave;
		if ($Sick_Leave->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($Sick_Leave->SqlSelectCount(), $Sick_Leave->SqlWhere(), $Sick_Leave->SqlGroupBy(), $Sick_Leave->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}
		}

		// Call Row_Rendering event
		$Sick_Leave->Row_Rendering();

		/* --------------------
		'  Render view codes
		' --------------------- */
		if ($Sick_Leave->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// ReportOn
			$Sick_Leave->ReportOn->GroupViewValue = $Sick_Leave->ReportOn->GroupOldValue();
			$Sick_Leave->ReportOn->GroupViewValue = ewrpt_FormatDateTime($Sick_Leave->ReportOn->GroupViewValue, 5);
			$Sick_Leave->ReportOn->CellAttrs["class"] = ($Sick_Leave->RowGroupLevel == 1) ? "ewRptGrpSummary1" : "ewRptGrpField1";
			$Sick_Leave->ReportOn->GroupViewValue = ewrpt_DisplayGroupValue($Sick_Leave->ReportOn, $Sick_Leave->ReportOn->GroupViewValue);

			// ID
			$Sick_Leave->ID->ViewValue = $Sick_Leave->ID->Summary;

			// FirstName
			$Sick_Leave->FirstName->ViewValue = $Sick_Leave->FirstName->Summary;

			// MiddelName
			$Sick_Leave->MiddelName->ViewValue = $Sick_Leave->MiddelName->Summary;

			// LastName
			$Sick_Leave->LastName->ViewValue = $Sick_Leave->LastName->Summary;

			// SickLeaveDays
			$Sick_Leave->SickLeaveDays->ViewValue = $Sick_Leave->SickLeaveDays->Summary;

			// SickLeave_Taken_Date
			$Sick_Leave->SickLeave_Taken_Date->ViewValue = $Sick_Leave->SickLeave_Taken_Date->Summary;
			$Sick_Leave->SickLeave_Taken_Date->ViewValue = ewrpt_FormatDateTime($Sick_Leave->SickLeave_Taken_Date->ViewValue, 5);

			// Department
			$Sick_Leave->Department->ViewValue = $Sick_Leave->Department->Summary;
		} else {

			// ReportOn
			$Sick_Leave->ReportOn->GroupViewValue = $Sick_Leave->ReportOn->GroupValue();
			$Sick_Leave->ReportOn->GroupViewValue = ewrpt_FormatDateTime($Sick_Leave->ReportOn->GroupViewValue, 5);
			$Sick_Leave->ReportOn->CellAttrs["class"] = "ewRptGrpField1";
			$Sick_Leave->ReportOn->GroupViewValue = ewrpt_DisplayGroupValue($Sick_Leave->ReportOn, $Sick_Leave->ReportOn->GroupViewValue);
			if ($Sick_Leave->ReportOn->GroupValue() == $Sick_Leave->ReportOn->GroupOldValue() && !$this->ChkLvlBreak(1))
				$Sick_Leave->ReportOn->GroupViewValue = "&nbsp;";

			// ID
			$Sick_Leave->ID->ViewValue = $Sick_Leave->ID->CurrentValue;
			$Sick_Leave->ID->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// FirstName
			$Sick_Leave->FirstName->ViewValue = $Sick_Leave->FirstName->CurrentValue;
			$Sick_Leave->FirstName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// MiddelName
			$Sick_Leave->MiddelName->ViewValue = $Sick_Leave->MiddelName->CurrentValue;
			$Sick_Leave->MiddelName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// LastName
			$Sick_Leave->LastName->ViewValue = $Sick_Leave->LastName->CurrentValue;
			$Sick_Leave->LastName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// SickLeaveDays
			$Sick_Leave->SickLeaveDays->ViewValue = $Sick_Leave->SickLeaveDays->CurrentValue;
			$Sick_Leave->SickLeaveDays->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// SickLeave_Taken_Date
			$Sick_Leave->SickLeave_Taken_Date->ViewValue = $Sick_Leave->SickLeave_Taken_Date->CurrentValue;
			$Sick_Leave->SickLeave_Taken_Date->ViewValue = ewrpt_FormatDateTime($Sick_Leave->SickLeave_Taken_Date->ViewValue, 5);
			$Sick_Leave->SickLeave_Taken_Date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Department
			$Sick_Leave->Department->ViewValue = $Sick_Leave->Department->CurrentValue;
			$Sick_Leave->Department->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// ReportOn
		$Sick_Leave->ReportOn->HrefValue = "";

		// ID
		$Sick_Leave->ID->HrefValue = "";

		// FirstName
		$Sick_Leave->FirstName->HrefValue = "";

		// MiddelName
		$Sick_Leave->MiddelName->HrefValue = "";

		// LastName
		$Sick_Leave->LastName->HrefValue = "";

		// SickLeaveDays
		$Sick_Leave->SickLeaveDays->HrefValue = "";

		// SickLeave_Taken_Date
		$Sick_Leave->SickLeave_Taken_Date->HrefValue = "";

		// Department
		$Sick_Leave->Department->HrefValue = "";

		// Call Row_Rendered event
		$Sick_Leave->Row_Rendered();
	}

	// Get extended filter values
	function GetExtendedFilterValues() {
		global $Sick_Leave;

		// Field SickLeave_Taken_Date
		$sSelect = "SELECT DISTINCT `SickLeave_Taken_Date` FROM " . $Sick_Leave->SqlFrom();
		$sOrderBy = "`SickLeave_Taken_Date` ASC";
		$wrkSql = ewrpt_BuildReportSql($sSelect, $Sick_Leave->SqlWhere(), "", "", $sOrderBy, $this->UserIDFilter, "");
		$Sick_Leave->SickLeave_Taken_Date->DropDownList = ewrpt_GetDistinctValues("date", $wrkSql);

		// Field ReportOn
		$sSelect = "SELECT DISTINCT `ReportOn` FROM " . $Sick_Leave->SqlFrom();
		$sOrderBy = "`ReportOn` ASC";
		$wrkSql = ewrpt_BuildReportSql($sSelect, $Sick_Leave->SqlWhere(), "", "", $sOrderBy, $this->UserIDFilter, "");
		$Sick_Leave->ReportOn->DropDownList = ewrpt_GetDistinctValues("date", $wrkSql);
	}

	// Return extended filter
	function GetExtendedFilter() {
		global $Sick_Leave;
		global $gsFormError;
		$sFilter = "";
		$bPostBack = ewrpt_IsHttpPost();
		$bRestoreSession = TRUE;
		$bSetupFilter = FALSE;

		// Reset extended filter if filter changed
		if ($bPostBack) {

			// Clear extended filter for field ID
			if ($this->ClearExtFilter == 'Sick_Leave_ID')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'ID');

			// Clear extended filter for field FirstName
			if ($this->ClearExtFilter == 'Sick_Leave_FirstName')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'FirstName');

			// Clear extended filter for field MiddelName
			if ($this->ClearExtFilter == 'Sick_Leave_MiddelName')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'MiddelName');

			// Clear extended filter for field LastName
			if ($this->ClearExtFilter == 'Sick_Leave_LastName')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'LastName');

			// Clear extended filter for field SickLeaveDays
			if ($this->ClearExtFilter == 'Sick_Leave_SickLeaveDays')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'SickLeaveDays');

			// Clear dropdown for field SickLeave_Taken_Date
			if ($this->ClearExtFilter == 'Sick_Leave_SickLeave_Taken_Date')
				$this->SetSessionDropDownValue(EWRPT_INIT_VALUE, 'SickLeave_Taken_Date');

			// Clear dropdown for field ReportOn
			if ($this->ClearExtFilter == 'Sick_Leave_ReportOn')
				$this->SetSessionDropDownValue(EWRPT_INIT_VALUE, 'ReportOn');

		// Reset search command
		} elseif (@$_GET["cmd"] == "reset") {

			// Load default values
			// Field ID

			$this->SetSessionFilterValues($Sick_Leave->ID->SearchValue, $Sick_Leave->ID->SearchOperator, $Sick_Leave->ID->SearchCondition, $Sick_Leave->ID->SearchValue2, $Sick_Leave->ID->SearchOperator2, 'ID');

			// Field FirstName
			$this->SetSessionFilterValues($Sick_Leave->FirstName->SearchValue, $Sick_Leave->FirstName->SearchOperator, $Sick_Leave->FirstName->SearchCondition, $Sick_Leave->FirstName->SearchValue2, $Sick_Leave->FirstName->SearchOperator2, 'FirstName');

			// Field MiddelName
			$this->SetSessionFilterValues($Sick_Leave->MiddelName->SearchValue, $Sick_Leave->MiddelName->SearchOperator, $Sick_Leave->MiddelName->SearchCondition, $Sick_Leave->MiddelName->SearchValue2, $Sick_Leave->MiddelName->SearchOperator2, 'MiddelName');

			// Field LastName
			$this->SetSessionFilterValues($Sick_Leave->LastName->SearchValue, $Sick_Leave->LastName->SearchOperator, $Sick_Leave->LastName->SearchCondition, $Sick_Leave->LastName->SearchValue2, $Sick_Leave->LastName->SearchOperator2, 'LastName');

			// Field SickLeaveDays
			$this->SetSessionFilterValues($Sick_Leave->SickLeaveDays->SearchValue, $Sick_Leave->SickLeaveDays->SearchOperator, $Sick_Leave->SickLeaveDays->SearchCondition, $Sick_Leave->SickLeaveDays->SearchValue2, $Sick_Leave->SickLeaveDays->SearchOperator2, 'SickLeaveDays');

			// Field SickLeave_Taken_Date
			$this->SetSessionDropDownValue($Sick_Leave->SickLeave_Taken_Date->DropDownValue, 'SickLeave_Taken_Date');

			// Field ReportOn
			$this->SetSessionDropDownValue($Sick_Leave->ReportOn->DropDownValue, 'ReportOn');
			$bSetupFilter = TRUE;
		} else {

			// Field ID
			if ($this->GetFilterValues($Sick_Leave->ID)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field FirstName
			if ($this->GetFilterValues($Sick_Leave->FirstName)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field MiddelName
			if ($this->GetFilterValues($Sick_Leave->MiddelName)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field LastName
			if ($this->GetFilterValues($Sick_Leave->LastName)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field SickLeaveDays
			if ($this->GetFilterValues($Sick_Leave->SickLeaveDays)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field SickLeave_Taken_Date
			if ($this->GetDropDownValue($Sick_Leave->SickLeave_Taken_Date->DropDownValue, 'SickLeave_Taken_Date')) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			} elseif ($Sick_Leave->SickLeave_Taken_Date->DropDownValue <> EWRPT_INIT_VALUE && !isset($_SESSION['sv_Sick_Leave->SickLeave_Taken_Date'])) {
				$bSetupFilter = TRUE;
			}

			// Field ReportOn
			if ($this->GetDropDownValue($Sick_Leave->ReportOn->DropDownValue, 'ReportOn')) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			} elseif ($Sick_Leave->ReportOn->DropDownValue <> EWRPT_INIT_VALUE && !isset($_SESSION['sv_Sick_Leave->ReportOn'])) {
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
			$this->GetSessionFilterValues($Sick_Leave->ID);

			// Field FirstName
			$this->GetSessionFilterValues($Sick_Leave->FirstName);

			// Field MiddelName
			$this->GetSessionFilterValues($Sick_Leave->MiddelName);

			// Field LastName
			$this->GetSessionFilterValues($Sick_Leave->LastName);

			// Field SickLeaveDays
			$this->GetSessionFilterValues($Sick_Leave->SickLeaveDays);

			// Field SickLeave_Taken_Date
			$this->GetSessionDropDownValue($Sick_Leave->SickLeave_Taken_Date);

			// Field ReportOn
			$this->GetSessionDropDownValue($Sick_Leave->ReportOn);
		}

		// Call page filter validated event
		$Sick_Leave->Page_FilterValidated();

		// Build SQL
		// Field ID

		$this->BuildExtendedFilter($Sick_Leave->ID, $sFilter);

		// Field FirstName
		$this->BuildExtendedFilter($Sick_Leave->FirstName, $sFilter);

		// Field MiddelName
		$this->BuildExtendedFilter($Sick_Leave->MiddelName, $sFilter);

		// Field LastName
		$this->BuildExtendedFilter($Sick_Leave->LastName, $sFilter);

		// Field SickLeaveDays
		$this->BuildExtendedFilter($Sick_Leave->SickLeaveDays, $sFilter);

		// Field SickLeave_Taken_Date
		$this->BuildDropDownFilter($Sick_Leave->SickLeave_Taken_Date, $sFilter, "");

		// Field ReportOn
		$this->BuildDropDownFilter($Sick_Leave->ReportOn, $sFilter, "");

		// Save parms to session
		// Field ID

		$this->SetSessionFilterValues($Sick_Leave->ID->SearchValue, $Sick_Leave->ID->SearchOperator, $Sick_Leave->ID->SearchCondition, $Sick_Leave->ID->SearchValue2, $Sick_Leave->ID->SearchOperator2, 'ID');

		// Field FirstName
		$this->SetSessionFilterValues($Sick_Leave->FirstName->SearchValue, $Sick_Leave->FirstName->SearchOperator, $Sick_Leave->FirstName->SearchCondition, $Sick_Leave->FirstName->SearchValue2, $Sick_Leave->FirstName->SearchOperator2, 'FirstName');

		// Field MiddelName
		$this->SetSessionFilterValues($Sick_Leave->MiddelName->SearchValue, $Sick_Leave->MiddelName->SearchOperator, $Sick_Leave->MiddelName->SearchCondition, $Sick_Leave->MiddelName->SearchValue2, $Sick_Leave->MiddelName->SearchOperator2, 'MiddelName');

		// Field LastName
		$this->SetSessionFilterValues($Sick_Leave->LastName->SearchValue, $Sick_Leave->LastName->SearchOperator, $Sick_Leave->LastName->SearchCondition, $Sick_Leave->LastName->SearchValue2, $Sick_Leave->LastName->SearchOperator2, 'LastName');

		// Field SickLeaveDays
		$this->SetSessionFilterValues($Sick_Leave->SickLeaveDays->SearchValue, $Sick_Leave->SickLeaveDays->SearchOperator, $Sick_Leave->SickLeaveDays->SearchCondition, $Sick_Leave->SickLeaveDays->SearchValue2, $Sick_Leave->SickLeaveDays->SearchOperator2, 'SickLeaveDays');

		// Field SickLeave_Taken_Date
		$this->SetSessionDropDownValue($Sick_Leave->SickLeave_Taken_Date->DropDownValue, 'SickLeave_Taken_Date');

		// Field ReportOn
		$this->SetSessionDropDownValue($Sick_Leave->ReportOn->DropDownValue, 'ReportOn');

		// Setup filter
		if ($bSetupFilter) {

			// Field ID
			$sWrk = "";
			$this->BuildExtendedFilter($Sick_Leave->ID, $sWrk);
			$this->LoadSelectionFromFilter($Sick_Leave->ID, $sWrk, $Sick_Leave->ID->SelectionList);
			$_SESSION['sel_Sick_Leave_ID'] = ($Sick_Leave->ID->SelectionList == "") ? EWRPT_INIT_VALUE : $Sick_Leave->ID->SelectionList;

			// Field FirstName
			$sWrk = "";
			$this->BuildExtendedFilter($Sick_Leave->FirstName, $sWrk);
			$this->LoadSelectionFromFilter($Sick_Leave->FirstName, $sWrk, $Sick_Leave->FirstName->SelectionList);
			$_SESSION['sel_Sick_Leave_FirstName'] = ($Sick_Leave->FirstName->SelectionList == "") ? EWRPT_INIT_VALUE : $Sick_Leave->FirstName->SelectionList;

			// Field MiddelName
			$sWrk = "";
			$this->BuildExtendedFilter($Sick_Leave->MiddelName, $sWrk);
			$this->LoadSelectionFromFilter($Sick_Leave->MiddelName, $sWrk, $Sick_Leave->MiddelName->SelectionList);
			$_SESSION['sel_Sick_Leave_MiddelName'] = ($Sick_Leave->MiddelName->SelectionList == "") ? EWRPT_INIT_VALUE : $Sick_Leave->MiddelName->SelectionList;

			// Field LastName
			$sWrk = "";
			$this->BuildExtendedFilter($Sick_Leave->LastName, $sWrk);
			$this->LoadSelectionFromFilter($Sick_Leave->LastName, $sWrk, $Sick_Leave->LastName->SelectionList);
			$_SESSION['sel_Sick_Leave_LastName'] = ($Sick_Leave->LastName->SelectionList == "") ? EWRPT_INIT_VALUE : $Sick_Leave->LastName->SelectionList;

			// Field SickLeaveDays
			$sWrk = "";
			$this->BuildExtendedFilter($Sick_Leave->SickLeaveDays, $sWrk);
			$this->LoadSelectionFromFilter($Sick_Leave->SickLeaveDays, $sWrk, $Sick_Leave->SickLeaveDays->SelectionList);
			$_SESSION['sel_Sick_Leave_SickLeaveDays'] = ($Sick_Leave->SickLeaveDays->SelectionList == "") ? EWRPT_INIT_VALUE : $Sick_Leave->SickLeaveDays->SelectionList;

			// Field SickLeave_Taken_Date
			$sWrk = "";
			$this->BuildDropDownFilter($Sick_Leave->SickLeave_Taken_Date, $sWrk, "");
			$this->LoadSelectionFromFilter($Sick_Leave->SickLeave_Taken_Date, $sWrk, $Sick_Leave->SickLeave_Taken_Date->SelectionList);
			$_SESSION['sel_Sick_Leave_SickLeave_Taken_Date'] = ($Sick_Leave->SickLeave_Taken_Date->SelectionList == "") ? EWRPT_INIT_VALUE : $Sick_Leave->SickLeave_Taken_Date->SelectionList;

			// Field ReportOn
			$sWrk = "";
			$this->BuildDropDownFilter($Sick_Leave->ReportOn, $sWrk, "");
			$this->LoadSelectionFromFilter($Sick_Leave->ReportOn, $sWrk, $Sick_Leave->ReportOn->SelectionList);
			$_SESSION['sel_Sick_Leave_ReportOn'] = ($Sick_Leave->ReportOn->SelectionList == "") ? EWRPT_INIT_VALUE : $Sick_Leave->ReportOn->SelectionList;
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
		$this->GetSessionValue($fld->DropDownValue, 'sv_Sick_Leave_' . $parm);
	}

	// Get filter values from session
	function GetSessionFilterValues(&$fld) {
		$parm = substr($fld->FldVar, 2);
		$this->GetSessionValue($fld->SearchValue, 'sv1_Sick_Leave_' . $parm);
		$this->GetSessionValue($fld->SearchOperator, 'so1_Sick_Leave_' . $parm);
		$this->GetSessionValue($fld->SearchCondition, 'sc_Sick_Leave_' . $parm);
		$this->GetSessionValue($fld->SearchValue2, 'sv2_Sick_Leave_' . $parm);
		$this->GetSessionValue($fld->SearchOperator2, 'so2_Sick_Leave_' . $parm);
	}

	// Get value from session
	function GetSessionValue(&$sv, $sn) {
		if (isset($_SESSION[$sn]))
			$sv = $_SESSION[$sn];
	}

	// Set dropdown value to session
	function SetSessionDropDownValue($sv, $parm) {
		$_SESSION['sv_Sick_Leave_' . $parm] = $sv;
	}

	// Set filter values to session
	function SetSessionFilterValues($sv1, $so1, $sc, $sv2, $so2, $parm) {
		$_SESSION['sv1_Sick_Leave_' . $parm] = $sv1;
		$_SESSION['so1_Sick_Leave_' . $parm] = $so1;
		$_SESSION['sc_Sick_Leave_' . $parm] = $sc;
		$_SESSION['sv2_Sick_Leave_' . $parm] = $sv2;
		$_SESSION['so2_Sick_Leave_' . $parm] = $so2;
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
		global $ReportLanguage, $gsFormError, $Sick_Leave;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EWRPT_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ewrpt_CheckInteger($Sick_Leave->SickLeaveDays->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Sick_Leave->SickLeaveDays->FldErrMsg();
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
		$_SESSION["sel_Sick_Leave_$parm"] = "";
		$_SESSION["rf_Sick_Leave_$parm"] = "";
		$_SESSION["rt_Sick_Leave_$parm"] = "";
	}

	// Load selection from session
	function LoadSelectionFromSession($parm) {
		global $Sick_Leave;
		$fld =& $Sick_Leave->fields($parm);
		$fld->SelectionList = @$_SESSION["sel_Sick_Leave_$parm"];
		$fld->RangeFrom = @$_SESSION["rf_Sick_Leave_$parm"];
		$fld->RangeTo = @$_SESSION["rt_Sick_Leave_$parm"];
	}

	// Load default value for filters
	function LoadDefaultFilters() {
		global $Sick_Leave;

		/**
		* Set up default values for non Text filters
		*/

		// Field SickLeave_Taken_Date
		$Sick_Leave->SickLeave_Taken_Date->DefaultDropDownValue = EWRPT_INIT_VALUE;
		$Sick_Leave->SickLeave_Taken_Date->DropDownValue = $Sick_Leave->SickLeave_Taken_Date->DefaultDropDownValue;
		$sWrk = "";
		$this->BuildDropDownFilter($Sick_Leave->SickLeave_Taken_Date, $sWrk, "");
		$this->LoadSelectionFromFilter($Sick_Leave->SickLeave_Taken_Date, $sWrk, $Sick_Leave->SickLeave_Taken_Date->DefaultSelectionList);

		// Field ReportOn
		$Sick_Leave->ReportOn->DefaultDropDownValue = EWRPT_INIT_VALUE;
		$Sick_Leave->ReportOn->DropDownValue = $Sick_Leave->ReportOn->DefaultDropDownValue;
		$sWrk = "";
		$this->BuildDropDownFilter($Sick_Leave->ReportOn, $sWrk, "");
		$this->LoadSelectionFromFilter($Sick_Leave->ReportOn, $sWrk, $Sick_Leave->ReportOn->DefaultSelectionList);

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
		$this->SetDefaultExtFilter($Sick_Leave->ID, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Sick_Leave->ID);
		$sWrk = "";
		$this->BuildExtendedFilter($Sick_Leave->ID, $sWrk);
		$this->LoadSelectionFromFilter($Sick_Leave->ID, $sWrk, $Sick_Leave->ID->DefaultSelectionList);
		$Sick_Leave->ID->SelectionList = $Sick_Leave->ID->DefaultSelectionList;

		// Field FirstName
		$this->SetDefaultExtFilter($Sick_Leave->FirstName, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Sick_Leave->FirstName);
		$sWrk = "";
		$this->BuildExtendedFilter($Sick_Leave->FirstName, $sWrk);
		$this->LoadSelectionFromFilter($Sick_Leave->FirstName, $sWrk, $Sick_Leave->FirstName->DefaultSelectionList);
		$Sick_Leave->FirstName->SelectionList = $Sick_Leave->FirstName->DefaultSelectionList;

		// Field MiddelName
		$this->SetDefaultExtFilter($Sick_Leave->MiddelName, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Sick_Leave->MiddelName);
		$sWrk = "";
		$this->BuildExtendedFilter($Sick_Leave->MiddelName, $sWrk);
		$this->LoadSelectionFromFilter($Sick_Leave->MiddelName, $sWrk, $Sick_Leave->MiddelName->DefaultSelectionList);
		$Sick_Leave->MiddelName->SelectionList = $Sick_Leave->MiddelName->DefaultSelectionList;

		// Field LastName
		$this->SetDefaultExtFilter($Sick_Leave->LastName, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Sick_Leave->LastName);
		$sWrk = "";
		$this->BuildExtendedFilter($Sick_Leave->LastName, $sWrk);
		$this->LoadSelectionFromFilter($Sick_Leave->LastName, $sWrk, $Sick_Leave->LastName->DefaultSelectionList);
		$Sick_Leave->LastName->SelectionList = $Sick_Leave->LastName->DefaultSelectionList;

		// Field SickLeaveDays
		$this->SetDefaultExtFilter($Sick_Leave->SickLeaveDays, "USER SELECT", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Sick_Leave->SickLeaveDays);
		$sWrk = "";
		$this->BuildExtendedFilter($Sick_Leave->SickLeaveDays, $sWrk);
		$this->LoadSelectionFromFilter($Sick_Leave->SickLeaveDays, $sWrk, $Sick_Leave->SickLeaveDays->DefaultSelectionList);
		$Sick_Leave->SickLeaveDays->SelectionList = $Sick_Leave->SickLeaveDays->DefaultSelectionList;

		/**
		* Set up default values for popup filters
		* NOTE: if extended filter is enabled, use default values in extended filter instead
		*/
	}

	// Check if filter applied
	function CheckFilter() {
		global $Sick_Leave;

		// Check ID text filter
		if ($this->TextFilterApplied($Sick_Leave->ID))
			return TRUE;

		// Check ID popup filter
		if (!ewrpt_MatchedArray($Sick_Leave->ID->DefaultSelectionList, $Sick_Leave->ID->SelectionList))
			return TRUE;

		// Check FirstName text filter
		if ($this->TextFilterApplied($Sick_Leave->FirstName))
			return TRUE;

		// Check FirstName popup filter
		if (!ewrpt_MatchedArray($Sick_Leave->FirstName->DefaultSelectionList, $Sick_Leave->FirstName->SelectionList))
			return TRUE;

		// Check MiddelName text filter
		if ($this->TextFilterApplied($Sick_Leave->MiddelName))
			return TRUE;

		// Check MiddelName popup filter
		if (!ewrpt_MatchedArray($Sick_Leave->MiddelName->DefaultSelectionList, $Sick_Leave->MiddelName->SelectionList))
			return TRUE;

		// Check LastName text filter
		if ($this->TextFilterApplied($Sick_Leave->LastName))
			return TRUE;

		// Check LastName popup filter
		if (!ewrpt_MatchedArray($Sick_Leave->LastName->DefaultSelectionList, $Sick_Leave->LastName->SelectionList))
			return TRUE;

		// Check SickLeaveDays text filter
		if ($this->TextFilterApplied($Sick_Leave->SickLeaveDays))
			return TRUE;

		// Check SickLeaveDays popup filter
		if (!ewrpt_MatchedArray($Sick_Leave->SickLeaveDays->DefaultSelectionList, $Sick_Leave->SickLeaveDays->SelectionList))
			return TRUE;

		// Check SickLeave_Taken_Date extended filter
		if ($this->NonTextFilterApplied($Sick_Leave->SickLeave_Taken_Date))
			return TRUE;

		// Check SickLeave_Taken_Date popup filter
		if (!ewrpt_MatchedArray($Sick_Leave->SickLeave_Taken_Date->DefaultSelectionList, $Sick_Leave->SickLeave_Taken_Date->SelectionList))
			return TRUE;

		// Check ReportOn extended filter
		if ($this->NonTextFilterApplied($Sick_Leave->ReportOn))
			return TRUE;

		// Check ReportOn popup filter
		if (!ewrpt_MatchedArray($Sick_Leave->ReportOn->DefaultSelectionList, $Sick_Leave->ReportOn->SelectionList))
			return TRUE;
		return FALSE;
	}

	// Show list of filters
	function ShowFilterList() {
		global $Sick_Leave;
		global $ReportLanguage;

		// Initialize
		$sFilterList = "";

		// Field ID
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Sick_Leave->ID, $sExtWrk);
		if (is_array($Sick_Leave->ID->SelectionList))
			$sWrk = ewrpt_JoinArray($Sick_Leave->ID->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Sick_Leave->ID->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field FirstName
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Sick_Leave->FirstName, $sExtWrk);
		if (is_array($Sick_Leave->FirstName->SelectionList))
			$sWrk = ewrpt_JoinArray($Sick_Leave->FirstName->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Sick_Leave->FirstName->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field MiddelName
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Sick_Leave->MiddelName, $sExtWrk);
		if (is_array($Sick_Leave->MiddelName->SelectionList))
			$sWrk = ewrpt_JoinArray($Sick_Leave->MiddelName->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Sick_Leave->MiddelName->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field LastName
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Sick_Leave->LastName, $sExtWrk);
		if (is_array($Sick_Leave->LastName->SelectionList))
			$sWrk = ewrpt_JoinArray($Sick_Leave->LastName->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Sick_Leave->LastName->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field SickLeaveDays
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Sick_Leave->SickLeaveDays, $sExtWrk);
		if (is_array($Sick_Leave->SickLeaveDays->SelectionList))
			$sWrk = ewrpt_JoinArray($Sick_Leave->SickLeaveDays->SelectionList, ", ", EWRPT_DATATYPE_NUMBER);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Sick_Leave->SickLeaveDays->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field SickLeave_Taken_Date
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildDropDownFilter($Sick_Leave->SickLeave_Taken_Date, $sExtWrk, "");
		if (is_array($Sick_Leave->SickLeave_Taken_Date->SelectionList))
			$sWrk = ewrpt_JoinArray($Sick_Leave->SickLeave_Taken_Date->SelectionList, ", ", EWRPT_DATATYPE_DATE);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Sick_Leave->SickLeave_Taken_Date->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field ReportOn
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildDropDownFilter($Sick_Leave->ReportOn, $sExtWrk, "");
		if (is_array($Sick_Leave->ReportOn->SelectionList))
			$sWrk = ewrpt_JoinArray($Sick_Leave->ReportOn->SelectionList, ", ", EWRPT_DATATYPE_DATE);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Sick_Leave->ReportOn->FldCaption() . "<br />";
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
		global $Sick_Leave;
		$sWrk = "";
		if (!$this->ExtendedFilterExist($Sick_Leave->ID)) {
			if (is_array($Sick_Leave->ID->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Sick_Leave->ID, "`ID`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Sick_Leave->FirstName)) {
			if (is_array($Sick_Leave->FirstName->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Sick_Leave->FirstName, "`FirstName`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Sick_Leave->MiddelName)) {
			if (is_array($Sick_Leave->MiddelName->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Sick_Leave->MiddelName, "`MiddelName`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Sick_Leave->LastName)) {
			if (is_array($Sick_Leave->LastName->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Sick_Leave->LastName, "`LastName`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Sick_Leave->SickLeaveDays)) {
			if (is_array($Sick_Leave->SickLeaveDays->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Sick_Leave->SickLeaveDays, "`SickLeaveDays`", EWRPT_DATATYPE_NUMBER);
			}
		}
		if (!$this->DropDownFilterExist($Sick_Leave->SickLeave_Taken_Date, "")) {
			if (is_array($Sick_Leave->SickLeave_Taken_Date->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Sick_Leave->SickLeave_Taken_Date, "`SickLeave_Taken_Date`", EWRPT_DATATYPE_DATE);
			}
		}
		if (!$this->DropDownFilterExist($Sick_Leave->ReportOn, "")) {
			if (is_array($Sick_Leave->ReportOn->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Sick_Leave->ReportOn, "`ReportOn`", EWRPT_DATATYPE_DATE);
			}
		}
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $Sick_Leave;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$Sick_Leave->setOrderBy("");
				$Sick_Leave->setStartGroup(1);
				$Sick_Leave->ReportOn->setSort("");
				$Sick_Leave->ID->setSort("");
				$Sick_Leave->FirstName->setSort("");
				$Sick_Leave->MiddelName->setSort("");
				$Sick_Leave->LastName->setSort("");
				$Sick_Leave->SickLeaveDays->setSort("");
				$Sick_Leave->SickLeave_Taken_Date->setSort("");
				$Sick_Leave->Department->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$Sick_Leave->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$Sick_Leave->CurrentOrderType = @$_GET["ordertype"];
			$sSortSql = $Sick_Leave->SortSql();
			$Sick_Leave->setOrderBy($sSortSql);
			$Sick_Leave->setStartGroup(1);
		}

		// Set up default sort
		if ($Sick_Leave->getOrderBy() == "") {
			$Sick_Leave->setOrderBy("`ID` ASC");
			$Sick_Leave->ID->setSort("ASC");
		}
		return $Sick_Leave->getOrderBy();
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
