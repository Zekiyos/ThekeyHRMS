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
$Total_Attendance = NULL;

//
// Table class for Total Attendance
//
class crTotal_Attendance {
	var $TableVar = 'Total_Attendance';
	var $TableName = 'Total Attendance';
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
	var $Total_Absent_Per_Department;
	var $ID;
	var $FirstName;
	var $MiddelName;
	var $Department;
	var $Total_Absent;
	var $Total_No_normal1;
	var $Total_No_normal2;
	var $Total_No_Sunday;
	var $Total_No_Holyday;
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
	function crTotal_Attendance() {
		global $ReportLanguage;

		// ID
		$this->ID = new crField('Total_Attendance', 'Total Attendance', 'x_ID', 'ID', '`ID`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['ID'] =& $this->ID;
		$this->ID->DateFilter = "";
		$this->ID->SqlSelect = "SELECT DISTINCT `ID` FROM " . $this->SqlFrom();
		$this->ID->SqlOrderBy = "`ID`";
		$this->ID->FldGroupByType = "";
		$this->ID->FldGroupInt = "0";
		$this->ID->FldGroupSql = "";

		// FirstName
		$this->FirstName = new crField('Total_Attendance', 'Total Attendance', 'x_FirstName', 'FirstName', '`FirstName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['FirstName'] =& $this->FirstName;
		$this->FirstName->DateFilter = "";
		$this->FirstName->SqlSelect = "SELECT DISTINCT `FirstName` FROM " . $this->SqlFrom();
		$this->FirstName->SqlOrderBy = "`FirstName`";
		$this->FirstName->FldGroupByType = "";
		$this->FirstName->FldGroupInt = "0";
		$this->FirstName->FldGroupSql = "";

		// MiddelName
		$this->MiddelName = new crField('Total_Attendance', 'Total Attendance', 'x_MiddelName', 'MiddelName', '`MiddelName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['MiddelName'] =& $this->MiddelName;
		$this->MiddelName->DateFilter = "";
		$this->MiddelName->SqlSelect = "SELECT DISTINCT `MiddelName` FROM " . $this->SqlFrom();
		$this->MiddelName->SqlOrderBy = "`MiddelName`";
		$this->MiddelName->FldGroupByType = "";
		$this->MiddelName->FldGroupInt = "0";
		$this->MiddelName->FldGroupSql = "";

		// Department
		$this->Department = new crField('Total_Attendance', 'Total Attendance', 'x_Department', 'Department', '`Department`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->Department->GroupingFieldId = 1;
		$this->fields['Department'] =& $this->Department;
		$this->Department->DateFilter = "";
		$this->Department->SqlSelect = "SELECT DISTINCT `Department` FROM " . $this->SqlFrom();
		$this->Department->SqlOrderBy = "`Department`";
		$this->Department->FldGroupByType = "";
		$this->Department->FldGroupInt = "0";
		$this->Department->FldGroupSql = "";

		// Total_Absent
		$this->Total_Absent = new crField('Total_Attendance', 'Total Attendance', 'x_Total_Absent', 'Total_Absent', '`Total_Absent`', 131, EWRPT_DATATYPE_NUMBER, -1);
		$this->Total_Absent->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Total_Absent'] =& $this->Total_Absent;
		$this->Total_Absent->DateFilter = "";
		$this->Total_Absent->SqlSelect = "SELECT DISTINCT `Total_Absent` FROM " . $this->SqlFrom();
		$this->Total_Absent->SqlOrderBy = "`Total_Absent`";
		$this->Total_Absent->FldGroupByType = "";
		$this->Total_Absent->FldGroupInt = "0";
		$this->Total_Absent->FldGroupSql = "";

		// Total_No_normal1
		$this->Total_No_normal1 = new crField('Total_Attendance', 'Total Attendance', 'x_Total_No_normal1', 'Total_No_normal1', '`Total_No_normal1`', 131, EWRPT_DATATYPE_NUMBER, -1);
		$this->Total_No_normal1->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Total_No_normal1'] =& $this->Total_No_normal1;
		$this->Total_No_normal1->DateFilter = "";
		$this->Total_No_normal1->SqlSelect = "SELECT DISTINCT `Total_No_normal1` FROM " . $this->SqlFrom();
		$this->Total_No_normal1->SqlOrderBy = "`Total_No_normal1`";
		$this->Total_No_normal1->FldGroupByType = "";
		$this->Total_No_normal1->FldGroupInt = "0";
		$this->Total_No_normal1->FldGroupSql = "";

		// Total_No_normal2
		$this->Total_No_normal2 = new crField('Total_Attendance', 'Total Attendance', 'x_Total_No_normal2', 'Total_No_normal2', '`Total_No_normal2`', 131, EWRPT_DATATYPE_NUMBER, -1);
		$this->Total_No_normal2->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Total_No_normal2'] =& $this->Total_No_normal2;
		$this->Total_No_normal2->DateFilter = "";
		$this->Total_No_normal2->SqlSelect = "SELECT DISTINCT `Total_No_normal2` FROM " . $this->SqlFrom();
		$this->Total_No_normal2->SqlOrderBy = "`Total_No_normal2`";
		$this->Total_No_normal2->FldGroupByType = "";
		$this->Total_No_normal2->FldGroupInt = "0";
		$this->Total_No_normal2->FldGroupSql = "";

		// Total_No_Sunday
		$this->Total_No_Sunday = new crField('Total_Attendance', 'Total Attendance', 'x_Total_No_Sunday', 'Total_No_Sunday', '`Total_No_Sunday`', 131, EWRPT_DATATYPE_NUMBER, -1);
		$this->Total_No_Sunday->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Total_No_Sunday'] =& $this->Total_No_Sunday;
		$this->Total_No_Sunday->DateFilter = "";
		$this->Total_No_Sunday->SqlSelect = "SELECT DISTINCT `Total_No_Sunday` FROM " . $this->SqlFrom();
		$this->Total_No_Sunday->SqlOrderBy = "`Total_No_Sunday`";
		$this->Total_No_Sunday->FldGroupByType = "";
		$this->Total_No_Sunday->FldGroupInt = "0";
		$this->Total_No_Sunday->FldGroupSql = "";

		// Total_No_Holyday
		$this->Total_No_Holyday = new crField('Total_Attendance', 'Total Attendance', 'x_Total_No_Holyday', 'Total_No_Holyday', '`Total_No_Holyday`', 131, EWRPT_DATATYPE_NUMBER, -1);
		$this->Total_No_Holyday->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Total_No_Holyday'] =& $this->Total_No_Holyday;
		$this->Total_No_Holyday->DateFilter = "";
		$this->Total_No_Holyday->SqlSelect = "SELECT DISTINCT `Total_No_Holyday` FROM " . $this->SqlFrom();
		$this->Total_No_Holyday->SqlOrderBy = "`Total_No_Holyday`";
		$this->Total_No_Holyday->FldGroupByType = "";
		$this->Total_No_Holyday->FldGroupInt = "0";
		$this->Total_No_Holyday->FldGroupSql = "";

		// Total Absent Per Department
		$this->Total_Absent_Per_Department = new crChart('Total_Attendance', 'Total Attendance', 'Total_Absent_Per_Department', 'Total Absent Per Department', 'Department', 'Total_Absent', '', 5, 'SUM', 550, 440);
		$this->Total_Absent_Per_Department->SqlSelect = "SELECT `Department`, '', SUM(`Total_Absent`) FROM ";
		$this->Total_Absent_Per_Department->SqlGroupBy = "`Department`";
		$this->Total_Absent_Per_Department->SqlOrderBy = "";
		$this->Total_Absent_Per_Department->SeriesDateType = "";
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
		return "`total_attendance`";
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
		return "SELECT SUM(`Total_No_Holyday`) AS sum_total_no_holyday FROM " . $this->SqlFrom();
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
$Total_Attendance_summary = new crTotal_Attendance_summary();
$Page =& $Total_Attendance_summary;

// Page init
$Total_Attendance_summary->Page_Init();

// Page main
$Total_Attendance_summary->Page_Main();
?>
<?php include "phprptinc/header.php"; ?>
<?php if ($Total_Attendance->Export == "") { ?>
<script type="text/javascript">

// Create page object
var Total_Attendance_summary = new ewrpt_Page("Total_Attendance_summary");

// page properties
Total_Attendance_summary.PageID = "summary"; // page ID
Total_Attendance_summary.FormID = "fTotal_Attendancesummaryfilter"; // form ID
var EWRPT_PAGE_ID = Total_Attendance_summary.PageID;

// extend page with ValidateForm function
Total_Attendance_summary.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var elm = fobj.sv1_Total_Absent;
	if (elm && !ewrpt_CheckNumber(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Total_Attendance->Total_Absent->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv1_Total_No_normal1;
	if (elm && !ewrpt_CheckNumber(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Total_Attendance->Total_No_normal1->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv1_Total_No_normal2;
	if (elm && !ewrpt_CheckNumber(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Total_Attendance->Total_No_normal2->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv1_Total_No_Sunday;
	if (elm && !ewrpt_CheckNumber(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Total_Attendance->Total_No_Sunday->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv1_Total_No_Holyday;
	if (elm && !ewrpt_CheckNumber(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Total_Attendance->Total_No_Holyday->FldErrMsg()) ?>"))
			return false;
	}

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj)) return false;
	return true;
}

// extend page with Form_CustomValidate function
Total_Attendance_summary.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EWRPT_CLIENT_VALIDATE) { ?>
Total_Attendance_summary.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
Total_Attendance_summary.ValidateRequired = false; // no JavaScript validation
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
<?php $Total_Attendance_summary->ShowPageHeader(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php $Total_Attendance_summary->ShowMessage(); ?>
<?php if ($Total_Attendance->Export == "" || $Total_Attendance->Export == "print" || $Total_Attendance->Export == "email") { ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php } ?>
<?php if ($Total_Attendance->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
<?php $jsdata = ewrpt_GetJsData($Total_Attendance->Department, $Total_Attendance->Department->FldType); ?>
ewrpt_CreatePopup("Total_Attendance_Department", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Total_Attendance->ID, $Total_Attendance->ID->FldType); ?>
ewrpt_CreatePopup("Total_Attendance_ID", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Total_Attendance->FirstName, $Total_Attendance->FirstName->FldType); ?>
ewrpt_CreatePopup("Total_Attendance_FirstName", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Total_Attendance->MiddelName, $Total_Attendance->MiddelName->FldType); ?>
ewrpt_CreatePopup("Total_Attendance_MiddelName", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Total_Attendance->Total_Absent, $Total_Attendance->Total_Absent->FldType); ?>
ewrpt_CreatePopup("Total_Attendance_Total_Absent", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Total_Attendance->Total_No_normal1, $Total_Attendance->Total_No_normal1->FldType); ?>
ewrpt_CreatePopup("Total_Attendance_Total_No_normal1", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Total_Attendance->Total_No_normal2, $Total_Attendance->Total_No_normal2->FldType); ?>
ewrpt_CreatePopup("Total_Attendance_Total_No_normal2", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Total_Attendance->Total_No_Sunday, $Total_Attendance->Total_No_Sunday->FldType); ?>
ewrpt_CreatePopup("Total_Attendance_Total_No_Sunday", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Total_Attendance->Total_No_Holyday, $Total_Attendance->Total_No_Holyday->FldType); ?>
ewrpt_CreatePopup("Total_Attendance_Total_No_Holyday", [<?php echo $jsdata ?>]);
</script>
<div id="Total_Attendance_Department_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Total_Attendance_ID_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Total_Attendance_FirstName_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Total_Attendance_MiddelName_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Total_Attendance_Total_Absent_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Total_Attendance_Total_No_normal1_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Total_Attendance_Total_No_normal2_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Total_Attendance_Total_No_Sunday_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Total_Attendance_Total_No_Holyday_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<?php } ?>
<?php if ($Total_Attendance->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<?php if ($Total_Attendance->Export == "" || $Total_Attendance->Export == "print" || $Total_Attendance->Export == "email") { ?>
<?php } ?>
<?php echo $Total_Attendance->TableCaption() ?>
<?php if ($Total_Attendance->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $Total_Attendance_summary->ExportPrintUrl ?>"><?php echo $ReportLanguage->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $Total_Attendance_summary->ExportExcelUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $Total_Attendance_summary->ExportWordUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToWord") ?></a>
<?php if ($Total_Attendance_summary->FilterApplied) { ?>
&nbsp;&nbsp;<a href="Total_Attendancesmry.php?cmd=reset"><?php echo $ReportLanguage->Phrase("ResetAllFilter") ?></a>
<?php } ?>
<?php } ?>
<br /><br />
<?php if ($Total_Attendance->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($Total_Attendance->Export == "" || $Total_Attendance->Export == "print" || $Total_Attendance->Export == "email") { ?>
<?php } ?>
<?php if ($Total_Attendance->Export == "") { ?>
	</div></td>
	<!-- Left Container (End) -->
	<!-- Center Container - Report (Begin) -->
	<td style="vertical-align: top;" class="ewPadding"><div id="ewCenter" class="phpreportmaker">
	<!-- center slot -->
<?php } ?>
<!-- summary report starts -->
<div id="report_summary">
<?php if ($Total_Attendance->Export == "") { ?>
<?php
if ($Total_Attendance->FilterPanelOption == 2 || ($Total_Attendance->FilterPanelOption == 3 && $Total_Attendance_summary->FilterApplied) || $Total_Attendance_summary->Filter == "0=101") {
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
<form name="fTotal_Attendancesummaryfilter" id="fTotal_Attendancesummaryfilter" action="Total_Attendancesmry.php" class="ewForm" onsubmit="return Total_Attendance_summary.ValidateForm(this);">
<table class="ewRptExtFilter">
	<tr>
		<td><span class="phpreportmaker"><?php echo $Total_Attendance->FirstName->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_FirstName" id="so1_FirstName" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_FirstName" id="sv1_FirstName" size="30" maxlength="20" value="<?php echo ewrpt_HtmlEncode($Total_Attendance->FirstName->SearchValue) ?>"<?php echo ($Total_Attendance_summary->ClearExtFilter == 'Total_Attendance_FirstName') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Total_Attendance->MiddelName->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_MiddelName" id="so1_MiddelName" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_MiddelName" id="sv1_MiddelName" size="30" maxlength="20" value="<?php echo ewrpt_HtmlEncode($Total_Attendance->MiddelName->SearchValue) ?>"<?php echo ($Total_Attendance_summary->ClearExtFilter == 'Total_Attendance_MiddelName') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Total_Attendance->Department->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_Department" id="so1_Department" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_Department" id="sv1_Department" size="30" maxlength="50" value="<?php echo ewrpt_HtmlEncode($Total_Attendance->Department->SearchValue) ?>"<?php echo ($Total_Attendance_summary->ClearExtFilter == 'Total_Attendance_Department') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Total_Attendance->Total_Absent->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><select name="so1_Total_Absent" id="so1_Total_Absent" onchange="ewrpt_SrchOprChanged('so1_Total_Absent')"><option value="="<?php if ($Total_Attendance->Total_Absent->SearchOperator == "=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("="); ?></option><option value="<>"<?php if ($Total_Attendance->Total_Absent->SearchOperator == "<>") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<>"); ?></option><option value="<"<?php if ($Total_Attendance->Total_Absent->SearchOperator == "<") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<"); ?></option><option value="<="<?php if ($Total_Attendance->Total_Absent->SearchOperator == "<=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<="); ?></option><option value=">"<?php if ($Total_Attendance->Total_Absent->SearchOperator == ">") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase(">"); ?></option><option value=">="<?php if ($Total_Attendance->Total_Absent->SearchOperator == ">=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase(">="); ?></option><option value="BETWEEN"<?php if ($Total_Attendance->Total_Absent->SearchOperator == "BETWEEN") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("BETWEEN"); ?></option></select></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_Total_Absent" id="sv1_Total_Absent" size="30" value="<?php echo ewrpt_HtmlEncode($Total_Attendance->Total_Absent->SearchValue) ?>"<?php echo ($Total_Attendance_summary->ClearExtFilter == 'Total_Attendance_Total_Absent') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
				<td><span class="ewRptSearchOpr" style="display: none" id="btw1_Total_Absent" name="btw1_Total_Absent">&nbsp;<?php echo $ReportLanguage->Phrase("AND") ?>&nbsp;</span></td>
				<td><span class="phpreportmaker" style="display: none" id="btw1_Total_Absent" name="btw1_Total_Absent">
<input type="text" name="sv2_Total_Absent" id="sv2_Total_Absent" size="30" value="<?php echo ewrpt_HtmlEncode($Total_Attendance->Total_Absent->SearchValue2) ?>"<?php echo ($Total_Attendance_summary->ClearExtFilter == 'Total_Attendance_Total_Absent') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Total_Attendance->Total_No_normal1->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><select name="so1_Total_No_normal1" id="so1_Total_No_normal1" onchange="ewrpt_SrchOprChanged('so1_Total_No_normal1')"><option value="="<?php if ($Total_Attendance->Total_No_normal1->SearchOperator == "=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("="); ?></option><option value="<>"<?php if ($Total_Attendance->Total_No_normal1->SearchOperator == "<>") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<>"); ?></option><option value="<"<?php if ($Total_Attendance->Total_No_normal1->SearchOperator == "<") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<"); ?></option><option value="<="<?php if ($Total_Attendance->Total_No_normal1->SearchOperator == "<=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<="); ?></option><option value=">"<?php if ($Total_Attendance->Total_No_normal1->SearchOperator == ">") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase(">"); ?></option><option value=">="<?php if ($Total_Attendance->Total_No_normal1->SearchOperator == ">=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase(">="); ?></option><option value="BETWEEN"<?php if ($Total_Attendance->Total_No_normal1->SearchOperator == "BETWEEN") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("BETWEEN"); ?></option></select></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_Total_No_normal1" id="sv1_Total_No_normal1" size="30" value="<?php echo ewrpt_HtmlEncode($Total_Attendance->Total_No_normal1->SearchValue) ?>"<?php echo ($Total_Attendance_summary->ClearExtFilter == 'Total_Attendance_Total_No_normal1') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
				<td><span class="ewRptSearchOpr" style="display: none" id="btw1_Total_No_normal1" name="btw1_Total_No_normal1">&nbsp;<?php echo $ReportLanguage->Phrase("AND") ?>&nbsp;</span></td>
				<td><span class="phpreportmaker" style="display: none" id="btw1_Total_No_normal1" name="btw1_Total_No_normal1">
<input type="text" name="sv2_Total_No_normal1" id="sv2_Total_No_normal1" size="30" value="<?php echo ewrpt_HtmlEncode($Total_Attendance->Total_No_normal1->SearchValue2) ?>"<?php echo ($Total_Attendance_summary->ClearExtFilter == 'Total_Attendance_Total_No_normal1') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Total_Attendance->Total_No_normal2->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><select name="so1_Total_No_normal2" id="so1_Total_No_normal2" onchange="ewrpt_SrchOprChanged('so1_Total_No_normal2')"><option value="="<?php if ($Total_Attendance->Total_No_normal2->SearchOperator == "=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("="); ?></option><option value="<>"<?php if ($Total_Attendance->Total_No_normal2->SearchOperator == "<>") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<>"); ?></option><option value="<"<?php if ($Total_Attendance->Total_No_normal2->SearchOperator == "<") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<"); ?></option><option value="<="<?php if ($Total_Attendance->Total_No_normal2->SearchOperator == "<=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<="); ?></option><option value=">"<?php if ($Total_Attendance->Total_No_normal2->SearchOperator == ">") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase(">"); ?></option><option value=">="<?php if ($Total_Attendance->Total_No_normal2->SearchOperator == ">=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase(">="); ?></option><option value="BETWEEN"<?php if ($Total_Attendance->Total_No_normal2->SearchOperator == "BETWEEN") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("BETWEEN"); ?></option></select></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_Total_No_normal2" id="sv1_Total_No_normal2" size="30" value="<?php echo ewrpt_HtmlEncode($Total_Attendance->Total_No_normal2->SearchValue) ?>"<?php echo ($Total_Attendance_summary->ClearExtFilter == 'Total_Attendance_Total_No_normal2') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
				<td><span class="ewRptSearchOpr" style="display: none" id="btw1_Total_No_normal2" name="btw1_Total_No_normal2">&nbsp;<?php echo $ReportLanguage->Phrase("AND") ?>&nbsp;</span></td>
				<td><span class="phpreportmaker" style="display: none" id="btw1_Total_No_normal2" name="btw1_Total_No_normal2">
<input type="text" name="sv2_Total_No_normal2" id="sv2_Total_No_normal2" size="30" value="<?php echo ewrpt_HtmlEncode($Total_Attendance->Total_No_normal2->SearchValue2) ?>"<?php echo ($Total_Attendance_summary->ClearExtFilter == 'Total_Attendance_Total_No_normal2') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Total_Attendance->Total_No_Sunday->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><select name="so1_Total_No_Sunday" id="so1_Total_No_Sunday" onchange="ewrpt_SrchOprChanged('so1_Total_No_Sunday')"><option value="="<?php if ($Total_Attendance->Total_No_Sunday->SearchOperator == "=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("="); ?></option><option value="<>"<?php if ($Total_Attendance->Total_No_Sunday->SearchOperator == "<>") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<>"); ?></option><option value="<"<?php if ($Total_Attendance->Total_No_Sunday->SearchOperator == "<") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<"); ?></option><option value="<="<?php if ($Total_Attendance->Total_No_Sunday->SearchOperator == "<=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<="); ?></option><option value=">"<?php if ($Total_Attendance->Total_No_Sunday->SearchOperator == ">") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase(">"); ?></option><option value=">="<?php if ($Total_Attendance->Total_No_Sunday->SearchOperator == ">=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase(">="); ?></option><option value="BETWEEN"<?php if ($Total_Attendance->Total_No_Sunday->SearchOperator == "BETWEEN") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("BETWEEN"); ?></option></select></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_Total_No_Sunday" id="sv1_Total_No_Sunday" size="30" value="<?php echo ewrpt_HtmlEncode($Total_Attendance->Total_No_Sunday->SearchValue) ?>"<?php echo ($Total_Attendance_summary->ClearExtFilter == 'Total_Attendance_Total_No_Sunday') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
				<td><span class="ewRptSearchOpr" style="display: none" id="btw1_Total_No_Sunday" name="btw1_Total_No_Sunday">&nbsp;<?php echo $ReportLanguage->Phrase("AND") ?>&nbsp;</span></td>
				<td><span class="phpreportmaker" style="display: none" id="btw1_Total_No_Sunday" name="btw1_Total_No_Sunday">
<input type="text" name="sv2_Total_No_Sunday" id="sv2_Total_No_Sunday" size="30" value="<?php echo ewrpt_HtmlEncode($Total_Attendance->Total_No_Sunday->SearchValue2) ?>"<?php echo ($Total_Attendance_summary->ClearExtFilter == 'Total_Attendance_Total_No_Sunday') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Total_Attendance->Total_No_Holyday->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><select name="so1_Total_No_Holyday" id="so1_Total_No_Holyday" onchange="ewrpt_SrchOprChanged('so1_Total_No_Holyday')"><option value="="<?php if ($Total_Attendance->Total_No_Holyday->SearchOperator == "=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("="); ?></option><option value="<>"<?php if ($Total_Attendance->Total_No_Holyday->SearchOperator == "<>") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<>"); ?></option><option value="<"<?php if ($Total_Attendance->Total_No_Holyday->SearchOperator == "<") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<"); ?></option><option value="<="<?php if ($Total_Attendance->Total_No_Holyday->SearchOperator == "<=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<="); ?></option><option value=">"<?php if ($Total_Attendance->Total_No_Holyday->SearchOperator == ">") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase(">"); ?></option><option value=">="<?php if ($Total_Attendance->Total_No_Holyday->SearchOperator == ">=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase(">="); ?></option><option value="BETWEEN"<?php if ($Total_Attendance->Total_No_Holyday->SearchOperator == "BETWEEN") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("BETWEEN"); ?></option></select></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_Total_No_Holyday" id="sv1_Total_No_Holyday" size="30" value="<?php echo ewrpt_HtmlEncode($Total_Attendance->Total_No_Holyday->SearchValue) ?>"<?php echo ($Total_Attendance_summary->ClearExtFilter == 'Total_Attendance_Total_No_Holyday') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
				<td><span class="ewRptSearchOpr" style="display: none" id="btw1_Total_No_Holyday" name="btw1_Total_No_Holyday">&nbsp;<?php echo $ReportLanguage->Phrase("AND") ?>&nbsp;</span></td>
				<td><span class="phpreportmaker" style="display: none" id="btw1_Total_No_Holyday" name="btw1_Total_No_Holyday">
<input type="text" name="sv2_Total_No_Holyday" id="sv2_Total_No_Holyday" size="30" value="<?php echo ewrpt_HtmlEncode($Total_Attendance->Total_No_Holyday->SearchValue2) ?>"<?php echo ($Total_Attendance_summary->ClearExtFilter == 'Total_Attendance_Total_No_Holyday') ? " class=\"ewInputCleared\"" : "" ?>>
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
ewrpt_SrchOprChanged('so1_Total_Absent');
ewrpt_SrchOprChanged('so1_Total_No_normal1');
ewrpt_SrchOprChanged('so1_Total_No_normal2');
ewrpt_SrchOprChanged('so1_Total_No_Sunday');
ewrpt_SrchOprChanged('so1_Total_No_Holyday');
</script>
<!-- Search form (end) -->
</div>
<br />
<?php } ?>
<?php if ($Total_Attendance->ShowCurrentFilter) { ?>
<div id="ewrptFilterList">
<?php $Total_Attendance_summary->ShowFilterList() ?>
</div>
<br />
<?php } ?>
<table class="ewGrid" cellspacing="0"><tr>
	<td class="ewGridContent">
<?php if ($Total_Attendance->Export == "") { ?>
<div class="ewGridUpperPanel">
<form action="Total_Attendancesmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($Total_Attendance_summary->StartGrp, $Total_Attendance_summary->DisplayGrps, $Total_Attendance_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="Total_Attendancesmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="Total_Attendancesmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="Total_Attendancesmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="Total_Attendancesmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($Total_Attendance_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($Total_Attendance_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($Total_Attendance_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($Total_Attendance_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($Total_Attendance_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($Total_Attendance_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($Total_Attendance_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($Total_Attendance_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($Total_Attendance_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($Total_Attendance_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($Total_Attendance->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
if ($Total_Attendance->ExportAll && $Total_Attendance->Export <> "") {
	$Total_Attendance_summary->StopGrp = $Total_Attendance_summary->TotalGrps;
} else {
	$Total_Attendance_summary->StopGrp = $Total_Attendance_summary->StartGrp + $Total_Attendance_summary->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($Total_Attendance_summary->StopGrp) > intval($Total_Attendance_summary->TotalGrps))
	$Total_Attendance_summary->StopGrp = $Total_Attendance_summary->TotalGrps;
$Total_Attendance_summary->RecCount = 0;

// Get first row
if ($Total_Attendance_summary->TotalGrps > 0) {
	$Total_Attendance_summary->GetGrpRow(1);
	$Total_Attendance_summary->GrpCount = 1;
}
while (($rsgrp && !$rsgrp->EOF && $Total_Attendance_summary->GrpCount <= $Total_Attendance_summary->DisplayGrps) || $Total_Attendance_summary->ShowFirstHeader) {

	// Show header
	if ($Total_Attendance_summary->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Total_Attendance->SortUrl($Total_Attendance->Department) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Total_Attendance->Department->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Total_Attendance->SortUrl($Total_Attendance->Department) ?>',0);"><?php echo $Total_Attendance->Department->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Total_Attendance->Department->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Total_Attendance->Department->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Total_Attendance->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Total_Attendance_Department', false, '<?php echo $Total_Attendance->Department->RangeFrom; ?>', '<?php echo $Total_Attendance->Department->RangeTo; ?>');return false;" name="x_Department<?php echo $Total_Attendance_summary->Cnt[0][0]; ?>" id="x_Department<?php echo $Total_Attendance_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Total_Attendance->SortUrl($Total_Attendance->ID) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Total_Attendance->ID->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Total_Attendance->SortUrl($Total_Attendance->ID) ?>',0);"><?php echo $Total_Attendance->ID->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Total_Attendance->ID->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Total_Attendance->ID->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Total_Attendance->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Total_Attendance_ID', false, '<?php echo $Total_Attendance->ID->RangeFrom; ?>', '<?php echo $Total_Attendance->ID->RangeTo; ?>');return false;" name="x_ID<?php echo $Total_Attendance_summary->Cnt[0][0]; ?>" id="x_ID<?php echo $Total_Attendance_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Total_Attendance->SortUrl($Total_Attendance->FirstName) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Total_Attendance->FirstName->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Total_Attendance->SortUrl($Total_Attendance->FirstName) ?>',0);"><?php echo $Total_Attendance->FirstName->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Total_Attendance->FirstName->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Total_Attendance->FirstName->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Total_Attendance->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Total_Attendance_FirstName', false, '<?php echo $Total_Attendance->FirstName->RangeFrom; ?>', '<?php echo $Total_Attendance->FirstName->RangeTo; ?>');return false;" name="x_FirstName<?php echo $Total_Attendance_summary->Cnt[0][0]; ?>" id="x_FirstName<?php echo $Total_Attendance_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Total_Attendance->SortUrl($Total_Attendance->MiddelName) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Total_Attendance->MiddelName->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Total_Attendance->SortUrl($Total_Attendance->MiddelName) ?>',0);"><?php echo $Total_Attendance->MiddelName->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Total_Attendance->MiddelName->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Total_Attendance->MiddelName->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Total_Attendance->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Total_Attendance_MiddelName', false, '<?php echo $Total_Attendance->MiddelName->RangeFrom; ?>', '<?php echo $Total_Attendance->MiddelName->RangeTo; ?>');return false;" name="x_MiddelName<?php echo $Total_Attendance_summary->Cnt[0][0]; ?>" id="x_MiddelName<?php echo $Total_Attendance_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Total_Attendance->SortUrl($Total_Attendance->Total_Absent) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Total_Attendance->Total_Absent->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Total_Attendance->SortUrl($Total_Attendance->Total_Absent) ?>',0);"><?php echo $Total_Attendance->Total_Absent->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Total_Attendance->Total_Absent->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Total_Attendance->Total_Absent->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Total_Attendance->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Total_Attendance_Total_Absent', false, '<?php echo $Total_Attendance->Total_Absent->RangeFrom; ?>', '<?php echo $Total_Attendance->Total_Absent->RangeTo; ?>');return false;" name="x_Total_Absent<?php echo $Total_Attendance_summary->Cnt[0][0]; ?>" id="x_Total_Absent<?php echo $Total_Attendance_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Total_Attendance->SortUrl($Total_Attendance->Total_No_normal1) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Total_Attendance->Total_No_normal1->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Total_Attendance->SortUrl($Total_Attendance->Total_No_normal1) ?>',0);"><?php echo $Total_Attendance->Total_No_normal1->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Total_Attendance->Total_No_normal1->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Total_Attendance->Total_No_normal1->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Total_Attendance->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Total_Attendance_Total_No_normal1', false, '<?php echo $Total_Attendance->Total_No_normal1->RangeFrom; ?>', '<?php echo $Total_Attendance->Total_No_normal1->RangeTo; ?>');return false;" name="x_Total_No_normal1<?php echo $Total_Attendance_summary->Cnt[0][0]; ?>" id="x_Total_No_normal1<?php echo $Total_Attendance_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Total_Attendance->SortUrl($Total_Attendance->Total_No_normal2) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Total_Attendance->Total_No_normal2->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Total_Attendance->SortUrl($Total_Attendance->Total_No_normal2) ?>',0);"><?php echo $Total_Attendance->Total_No_normal2->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Total_Attendance->Total_No_normal2->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Total_Attendance->Total_No_normal2->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Total_Attendance->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Total_Attendance_Total_No_normal2', false, '<?php echo $Total_Attendance->Total_No_normal2->RangeFrom; ?>', '<?php echo $Total_Attendance->Total_No_normal2->RangeTo; ?>');return false;" name="x_Total_No_normal2<?php echo $Total_Attendance_summary->Cnt[0][0]; ?>" id="x_Total_No_normal2<?php echo $Total_Attendance_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Total_Attendance->SortUrl($Total_Attendance->Total_No_Sunday) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Total_Attendance->Total_No_Sunday->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Total_Attendance->SortUrl($Total_Attendance->Total_No_Sunday) ?>',0);"><?php echo $Total_Attendance->Total_No_Sunday->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Total_Attendance->Total_No_Sunday->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Total_Attendance->Total_No_Sunday->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Total_Attendance->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Total_Attendance_Total_No_Sunday', false, '<?php echo $Total_Attendance->Total_No_Sunday->RangeFrom; ?>', '<?php echo $Total_Attendance->Total_No_Sunday->RangeTo; ?>');return false;" name="x_Total_No_Sunday<?php echo $Total_Attendance_summary->Cnt[0][0]; ?>" id="x_Total_No_Sunday<?php echo $Total_Attendance_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Total_Attendance->SortUrl($Total_Attendance->Total_No_Holyday) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Total_Attendance->Total_No_Holyday->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Total_Attendance->SortUrl($Total_Attendance->Total_No_Holyday) ?>',0);"><?php echo $Total_Attendance->Total_No_Holyday->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Total_Attendance->Total_No_Holyday->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Total_Attendance->Total_No_Holyday->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Total_Attendance->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Total_Attendance_Total_No_Holyday', false, '<?php echo $Total_Attendance->Total_No_Holyday->RangeFrom; ?>', '<?php echo $Total_Attendance->Total_No_Holyday->RangeTo; ?>');return false;" name="x_Total_No_Holyday<?php echo $Total_Attendance_summary->Cnt[0][0]; ?>" id="x_Total_No_Holyday<?php echo $Total_Attendance_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$Total_Attendance_summary->ShowFirstHeader = FALSE;
	}

	// Build detail SQL
	$sWhere = ewrpt_DetailFilterSQL($Total_Attendance->Department, $Total_Attendance->SqlFirstGroupField(), $Total_Attendance->Department->GroupValue());
	if ($Total_Attendance_summary->Filter != "")
		$sWhere = "($Total_Attendance_summary->Filter) AND ($sWhere)";
	$sSql = ewrpt_BuildReportSql($Total_Attendance->SqlSelect(), $Total_Attendance->SqlWhere(), $Total_Attendance->SqlGroupBy(), $Total_Attendance->SqlHaving(), $Total_Attendance->SqlOrderBy(), $sWhere, $Total_Attendance_summary->Sort);
	$rs = $conn->Execute($sSql);
	$rsdtlcnt = ($rs) ? $rs->RecordCount() : 0;
	if ($rsdtlcnt > 0)
		$Total_Attendance_summary->GetRow(1);
	while ($rs && !$rs->EOF) { // Loop detail records
		$Total_Attendance_summary->RecCount++;

		// Render detail row
		$Total_Attendance->ResetCSS();
		$Total_Attendance->RowType = EWRPT_ROWTYPE_DETAIL;
		$Total_Attendance_summary->RenderRow();
?>
	<tr<?php echo $Total_Attendance->RowAttributes(); ?>>
		<td<?php echo $Total_Attendance->Department->CellAttributes(); ?>><div<?php echo $Total_Attendance->Department->ViewAttributes(); ?>><?php echo $Total_Attendance->Department->GroupViewValue; ?></div></td>
		<td<?php echo $Total_Attendance->ID->CellAttributes() ?>>
<div<?php echo $Total_Attendance->ID->ViewAttributes(); ?>><?php echo $Total_Attendance->ID->ListViewValue(); ?></div>
</td>
		<td<?php echo $Total_Attendance->FirstName->CellAttributes() ?>>
<div<?php echo $Total_Attendance->FirstName->ViewAttributes(); ?>><?php echo $Total_Attendance->FirstName->ListViewValue(); ?></div>
</td>
		<td<?php echo $Total_Attendance->MiddelName->CellAttributes() ?>>
<div<?php echo $Total_Attendance->MiddelName->ViewAttributes(); ?>><?php echo $Total_Attendance->MiddelName->ListViewValue(); ?></div>
</td>
		<td<?php echo $Total_Attendance->Total_Absent->CellAttributes() ?>>
<div<?php echo $Total_Attendance->Total_Absent->ViewAttributes(); ?>><?php echo $Total_Attendance->Total_Absent->ListViewValue(); ?></div>
</td>
		<td<?php echo $Total_Attendance->Total_No_normal1->CellAttributes() ?>>
<div<?php echo $Total_Attendance->Total_No_normal1->ViewAttributes(); ?>><?php echo $Total_Attendance->Total_No_normal1->ListViewValue(); ?></div>
</td>
		<td<?php echo $Total_Attendance->Total_No_normal2->CellAttributes() ?>>
<div<?php echo $Total_Attendance->Total_No_normal2->ViewAttributes(); ?>><?php echo $Total_Attendance->Total_No_normal2->ListViewValue(); ?></div>
</td>
		<td<?php echo $Total_Attendance->Total_No_Sunday->CellAttributes() ?>>
<div<?php echo $Total_Attendance->Total_No_Sunday->ViewAttributes(); ?>><?php echo $Total_Attendance->Total_No_Sunday->ListViewValue(); ?></div>
</td>
		<td<?php echo $Total_Attendance->Total_No_Holyday->CellAttributes() ?>>
<div<?php echo $Total_Attendance->Total_No_Holyday->ViewAttributes(); ?>><?php echo $Total_Attendance->Total_No_Holyday->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$Total_Attendance_summary->AccumulateSummary();

		// Get next record
		$Total_Attendance_summary->GetRow(2);

		// Show Footers
?>
<?php
	} // End detail records loop
?>
<?php

	// Next group
	$Total_Attendance_summary->GetGrpRow(2);
	$Total_Attendance_summary->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
<?php if (intval(@$Total_Attendance_summary->Cnt[0][8]) > 0) { ?>
<?php
	$Total_Attendance->ResetCSS();
	$Total_Attendance->RowType = EWRPT_ROWTYPE_TOTAL;
	$Total_Attendance->RowTotalType = EWRPT_ROWTOTAL_PAGE;
	$Total_Attendance->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
	$Total_Attendance->RowAttrs["class"] = "ewRptPageSummary";
	$Total_Attendance_summary->RenderRow();
?>
	<tr<?php echo $Total_Attendance->RowAttributes(); ?>><td colspan="9"><?php echo $ReportLanguage->Phrase("RptPageTotal") ?> (<?php echo ewrpt_FormatNumber($Total_Attendance_summary->Cnt[0][8],0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php
	$Total_Attendance->ResetCSS();
	$Total_Attendance->Total_No_Holyday->Count = $Total_Attendance_summary->Cnt[0][8];
	$Total_Attendance->Total_No_Holyday->Summary = $Total_Attendance_summary->Smry[0][8]; // Load SUM
	$Total_Attendance->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
	$Total_Attendance->Total_No_Holyday->CurrentValue = $Total_Attendance->Total_No_Holyday->Summary;
	$Total_Attendance->RowAttrs["class"] = "ewRptPageSummary";
	$Total_Attendance_summary->RenderRow();
?>
	<tr<?php echo $Total_Attendance->RowAttributes(); ?>>
		<td colspan="1" class="ewRptGrpAggregate"><?php echo $ReportLanguage->Phrase("RptSum"); ?></td>
		<td<?php echo $Total_Attendance->ID->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Total_Attendance->FirstName->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Total_Attendance->MiddelName->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Total_Attendance->Total_Absent->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Total_Attendance->Total_No_normal1->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Total_Attendance->Total_No_normal2->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Total_Attendance->Total_No_Sunday->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Total_Attendance->Total_No_Holyday->CellAttributes() ?>>
<div<?php echo $Total_Attendance->Total_No_Holyday->ViewAttributes(); ?>><?php echo $Total_Attendance->Total_No_Holyday->ListViewValue(); ?></div>
</td>
	</tr>
	<!-- tr class="ewRptPageSummary"><td colspan="9"><span class="phpreportmaker">&nbsp;<br /></span></td></tr -->
<?php } ?>
<?php
if ($Total_Attendance_summary->TotalGrps > 0) {
	$Total_Attendance->ResetCSS();
	$Total_Attendance->RowType = EWRPT_ROWTYPE_TOTAL;
	$Total_Attendance->RowTotalType = EWRPT_ROWTOTAL_GRAND;
	$Total_Attendance->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
	$Total_Attendance->RowAttrs["class"] = "ewRptGrandSummary";
	$Total_Attendance_summary->RenderRow();
?>
	<!-- tr><td colspan="9"><span class="phpreportmaker">&nbsp;<br /></span></td></tr -->
	<tr<?php echo $Total_Attendance->RowAttributes(); ?>><td colspan="9"><?php echo $ReportLanguage->Phrase("RptGrandTotal") ?> (<?php echo ewrpt_FormatNumber($Total_Attendance_summary->TotCount,0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php
	$Total_Attendance->ResetCSS();
	$Total_Attendance->Total_No_Holyday->Count = $Total_Attendance_summary->TotCount;
	$Total_Attendance->Total_No_Holyday->Summary = $Total_Attendance_summary->GrandSmry[8]; // Load SUM
	$Total_Attendance->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
	$Total_Attendance->Total_No_Holyday->CurrentValue = $Total_Attendance->Total_No_Holyday->Summary;
	$Total_Attendance->RowAttrs["class"] = "ewRptGrandSummary";
	$Total_Attendance_summary->RenderRow();
?>
	<tr<?php echo $Total_Attendance->RowAttributes(); ?>>
		<td colspan="1" class="ewRptGrpAggregate"><?php echo $ReportLanguage->Phrase("RptSum"); ?></td>
		<td<?php echo $Total_Attendance->ID->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Total_Attendance->FirstName->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Total_Attendance->MiddelName->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Total_Attendance->Total_Absent->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Total_Attendance->Total_No_normal1->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Total_Attendance->Total_No_normal2->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Total_Attendance->Total_No_Sunday->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Total_Attendance->Total_No_Holyday->CellAttributes() ?>>
<div<?php echo $Total_Attendance->Total_No_Holyday->ViewAttributes(); ?>><?php echo $Total_Attendance->Total_No_Holyday->ListViewValue(); ?></div>
</td>
	</tr>
<?php } ?>
	</tfoot>
</table>
</div>
<?php if ($Total_Attendance_summary->TotalGrps > 0) { ?>
<?php if ($Total_Attendance->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="Total_Attendancesmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($Total_Attendance_summary->StartGrp, $Total_Attendance_summary->DisplayGrps, $Total_Attendance_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="Total_Attendancesmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="Total_Attendancesmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="Total_Attendancesmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="Total_Attendancesmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($Total_Attendance_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($Total_Attendance_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($Total_Attendance_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($Total_Attendance_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($Total_Attendance_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($Total_Attendance_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($Total_Attendance_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($Total_Attendance_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($Total_Attendance_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($Total_Attendance_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($Total_Attendance->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php if ($Total_Attendance->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($Total_Attendance->Export == "" || $Total_Attendance->Export == "print" || $Total_Attendance->Export == "email") { ?>
<?php } ?>
<?php if ($Total_Attendance->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3" class="ewPadding"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($Total_Attendance->Export == "" || $Total_Attendance->Export == "print" || $Total_Attendance->Export == "email") { ?>
<a name="cht_Total_Absent_Per_Department"></a>
<div id="div_Total_Attendance_Total_Absent_Per_Department"></div>
<?php

// Initialize chart data
$Total_Attendance->Total_Absent_Per_Department->ID = "Total_Attendance_Total_Absent_Per_Department"; // Chart ID
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("type", "5", FALSE); // Chart type
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("seriestype", "0", FALSE); // Chart series type
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("bgcolor", "#FCFCFC", TRUE); // Background color
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("caption", $Total_Attendance->Total_Absent_Per_Department->ChartCaption(), TRUE); // Chart caption
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("xaxisname", $Total_Attendance->Total_Absent_Per_Department->ChartXAxisName(), TRUE); // X axis name
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("yaxisname", $Total_Attendance->Total_Absent_Per_Department->ChartYAxisName(), TRUE); // Y axis name
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("shownames", "1", TRUE); // Show names
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("showvalues", "1", TRUE); // Show values
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("showhovercap", "0", TRUE); // Show hover
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("alpha", "50", FALSE); // Chart alpha
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("colorpalette", "#FF0000|#FF0080|#FF00FF|#8000FF|#FF8000|#FF3D3D|#7AFFFF|#0000FF|#FFFF00|#FF7A7A|#3DFFFF|#0080FF|#80FF00|#00FF00|#00FF80|#00FFFF", FALSE); // Chart color palette
?>
<?php
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("showCanvasBg", "1", TRUE); // showCanvasBg
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("showCanvasBase", "1", TRUE); // showCanvasBase
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("showLimits", "1", TRUE); // showLimits
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("animation", "1", TRUE); // animation
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("rotateNames", "0", TRUE); // rotateNames
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("yAxisMinValue", "0", TRUE); // yAxisMinValue
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("yAxisMaxValue", "0", TRUE); // yAxisMaxValue
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("PYAxisMinValue", "0", TRUE); // PYAxisMinValue
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("PYAxisMaxValue", "0", TRUE); // PYAxisMaxValue
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("SYAxisMinValue", "0", TRUE); // SYAxisMinValue
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("SYAxisMaxValue", "0", TRUE); // SYAxisMaxValue
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("showColumnShadow", "0", TRUE); // showColumnShadow
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("showPercentageValues", "1", TRUE); // showPercentageValues
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("showPercentageInLabel", "1", TRUE); // showPercentageInLabel
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("showBarShadow", "0", TRUE); // showBarShadow
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("showAnchors", "1", TRUE); // showAnchors
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("showAreaBorder", "1", TRUE); // showAreaBorder
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("isSliced", "1", TRUE); // isSliced
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("showAsBars", "0", TRUE); // showAsBars
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("showShadow", "0", TRUE); // showShadow
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("formatNumber", "0", TRUE); // formatNumber
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("formatNumberScale", "0", TRUE); // formatNumberScale
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("decimalSeparator", ".", TRUE); // decimalSeparator
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("thousandSeparator", ",", TRUE); // thousandSeparator
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("decimalPrecision", "2", TRUE); // decimalPrecision
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("divLineDecimalPrecision", "2", TRUE); // divLineDecimalPrecision
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("limitsDecimalPrecision", "2", TRUE); // limitsDecimalPrecision
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("zeroPlaneShowBorder", "1", TRUE); // zeroPlaneShowBorder
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("showDivLineValue", "1", TRUE); // showDivLineValue
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("showAlternateHGridColor", "0", TRUE); // showAlternateHGridColor
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("showAlternateVGridColor", "0", TRUE); // showAlternateVGridColor
$Total_Attendance->Total_Absent_Per_Department->SetChartParam("hoverCapSepChar", ":", TRUE); // hoverCapSepChar

// Define trend lines
?>
<?php
$SqlSelect = $Total_Attendance->SqlSelect();
$SqlChartSelect = $Total_Attendance->Total_Absent_Per_Department->SqlSelect;
$sSqlChartBase = $Total_Attendance->SqlFrom();

// Load chart data from sql directly
$sSql = $SqlChartSelect . $sSqlChartBase;
$sSql = ewrpt_BuildReportSql($sSql, $Total_Attendance->SqlWhere(), $Total_Attendance->Total_Absent_Per_Department->SqlGroupBy, "", $Total_Attendance->Total_Absent_Per_Department->SqlOrderBy, $Total_Attendance_summary->Filter, "");
if (EWRPT_DEBUG_ENABLED) echo "(Chart SQL): " . $sSql . "<br>";
ewrpt_LoadChartData($sSql, $Total_Attendance->Total_Absent_Per_Department);
ewrpt_SortChartData($Total_Attendance->Total_Absent_Per_Department->Data, 0, "");

// Call Chart_Rendering event
$Total_Attendance->Chart_Rendering($Total_Attendance->Total_Absent_Per_Department);
$chartxml = $Total_Attendance->Total_Absent_Per_Department->ChartXml();

// Call Chart_Rendered event
$Total_Attendance->Chart_Rendered($Total_Attendance->Total_Absent_Per_Department, $chartxml);
echo $Total_Attendance->Total_Absent_Per_Department->ShowChartFCF($chartxml);
?>
<a href="#top"><?php echo $ReportLanguage->Phrase("Top") ?></a>
<br /><br />
<?php } ?>
<?php if ($Total_Attendance->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $Total_Attendance_summary->ShowPageFooter(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($Total_Attendance->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "phprptinc/footer.php"; ?>
<?php
$Total_Attendance_summary->Page_Terminate();
?>
<?php

//
// Page class
//
class crTotal_Attendance_summary {

	// Page ID
	var $PageID = 'summary';

	// Table name
	var $TableName = 'Total Attendance';

	// Page object name
	var $PageObjName = 'Total_Attendance_summary';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $Total_Attendance;
		if ($Total_Attendance->UseTokenInUrl) $PageUrl .= "t=" . $Total_Attendance->TableVar . "&"; // Add page token
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
		global $Total_Attendance;
		if ($Total_Attendance->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($Total_Attendance->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($Total_Attendance->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crTotal_Attendance_summary() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (Total_Attendance)
		$GLOBALS["Total_Attendance"] = new crTotal_Attendance();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'summary', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'Total Attendance', TRUE);

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
		global $Total_Attendance;

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$Total_Attendance->Export = $_GET["export"];
	}
	$gsExport = $Total_Attendance->Export; // Get export parameter, used in header
	$gsExportFile = $Total_Attendance->TableVar; // Get export file, used in header
	if ($Total_Attendance->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($Total_Attendance->Export == "word") {
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
		global $Total_Attendance;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($Total_Attendance->Export == "email") {
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
		global $Total_Attendance;
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
		$this->Col = array(FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, TRUE);

		// Set up groups per page dynamically
		$this->SetUpDisplayGrps();
		$Total_Attendance->Department->SelectionList = "";
		$Total_Attendance->Department->DefaultSelectionList = "";
		$Total_Attendance->Department->ValueList = "";
		$Total_Attendance->ID->SelectionList = "";
		$Total_Attendance->ID->DefaultSelectionList = "";
		$Total_Attendance->ID->ValueList = "";
		$Total_Attendance->FirstName->SelectionList = "";
		$Total_Attendance->FirstName->DefaultSelectionList = "";
		$Total_Attendance->FirstName->ValueList = "";
		$Total_Attendance->MiddelName->SelectionList = "";
		$Total_Attendance->MiddelName->DefaultSelectionList = "";
		$Total_Attendance->MiddelName->ValueList = "";
		$Total_Attendance->Total_Absent->SelectionList = "";
		$Total_Attendance->Total_Absent->DefaultSelectionList = "";
		$Total_Attendance->Total_Absent->ValueList = "";
		$Total_Attendance->Total_No_normal1->SelectionList = "";
		$Total_Attendance->Total_No_normal1->DefaultSelectionList = "";
		$Total_Attendance->Total_No_normal1->ValueList = "";
		$Total_Attendance->Total_No_normal2->SelectionList = "";
		$Total_Attendance->Total_No_normal2->DefaultSelectionList = "";
		$Total_Attendance->Total_No_normal2->ValueList = "";
		$Total_Attendance->Total_No_Sunday->SelectionList = "";
		$Total_Attendance->Total_No_Sunday->DefaultSelectionList = "";
		$Total_Attendance->Total_No_Sunday->ValueList = "";
		$Total_Attendance->Total_No_Holyday->SelectionList = "";
		$Total_Attendance->Total_No_Holyday->DefaultSelectionList = "";
		$Total_Attendance->Total_No_Holyday->ValueList = "";

		// Load default filter values
		$this->LoadDefaultFilters();

		// Set up popup filter
		$this->SetupPopup();

		// Extended filter
		$sExtendedFilter = "";

		// Get dropdown values
		$this->GetExtendedFilterValues();

		// Load custom filters
		$Total_Attendance->CustomFilters_Load();

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
		$sGrpSort = ewrpt_UpdateSortFields($Total_Attendance->SqlOrderByGroup(), $this->Sort, 2); // Get grouping field only
		$sSql = ewrpt_BuildReportSql($Total_Attendance->SqlSelectGroup(), $Total_Attendance->SqlWhere(), $Total_Attendance->SqlGroupBy(), $Total_Attendance->SqlHaving(), $Total_Attendance->SqlOrderByGroup(), $this->Filter, $sGrpSort);
		$this->TotalGrps = $this->GetGrpCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($Total_Attendance->ExportAll && $Total_Attendance->Export <> "")
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
		global $Total_Attendance;
		switch ($lvl) {
			case 1:
				return (is_null($Total_Attendance->Department->CurrentValue) && !is_null($Total_Attendance->Department->OldValue)) ||
					(!is_null($Total_Attendance->Department->CurrentValue) && is_null($Total_Attendance->Department->OldValue)) ||
					($Total_Attendance->Department->GroupValue() <> $Total_Attendance->Department->GroupOldValue());
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
		global $Total_Attendance;
		$rsgrpcnt = $conn->Execute($sql);
		$grpcnt = ($rsgrpcnt) ? $rsgrpcnt->RecordCount() : 0;
		if ($rsgrpcnt) $rsgrpcnt->Close();
		return $grpcnt;
	}

	// Get group rs
	function GetGrpRs($sql, $start, $grps) {
		global $conn;
		global $Total_Attendance;
		$wrksql = $sql;
		if ($start > 0 && $grps > -1)
			$wrksql .= " LIMIT " . ($start-1) . ", " . ($grps);
		$rswrk = $conn->Execute($wrksql);
		return $rswrk;
	}

	// Get group row values
	function GetGrpRow($opt) {
		global $rsgrp;
		global $Total_Attendance;
		if (!$rsgrp)
			return;
		if ($opt == 1) { // Get first group

			//$rsgrp->MoveFirst(); // NOTE: no need to move position
			$Total_Attendance->Department->setDbValue(""); // Init first value
		} else { // Get next group
			$rsgrp->MoveNext();
		}
		if (!$rsgrp->EOF)
			$Total_Attendance->Department->setDbValue($rsgrp->fields('Department'));
		if ($rsgrp->EOF) {
			$Total_Attendance->Department->setDbValue("");
		}
	}

	// Get row values
	function GetRow($opt) {
		global $rs;
		global $Total_Attendance;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$Total_Attendance->ID->setDbValue($rs->fields('ID'));
			$Total_Attendance->FirstName->setDbValue($rs->fields('FirstName'));
			$Total_Attendance->MiddelName->setDbValue($rs->fields('MiddelName'));
			if ($opt <> 1)
				$Total_Attendance->Department->setDbValue($rs->fields('Department'));
			$Total_Attendance->Total_Absent->setDbValue($rs->fields('Total_Absent'));
			$Total_Attendance->Total_No_normal1->setDbValue($rs->fields('Total_No_normal1'));
			$Total_Attendance->Total_No_normal2->setDbValue($rs->fields('Total_No_normal2'));
			$Total_Attendance->Total_No_Sunday->setDbValue($rs->fields('Total_No_Sunday'));
			$Total_Attendance->Total_No_Holyday->setDbValue($rs->fields('Total_No_Holyday'));
			$this->Val[1] = $Total_Attendance->ID->CurrentValue;
			$this->Val[2] = $Total_Attendance->FirstName->CurrentValue;
			$this->Val[3] = $Total_Attendance->MiddelName->CurrentValue;
			$this->Val[4] = $Total_Attendance->Total_Absent->CurrentValue;
			$this->Val[5] = $Total_Attendance->Total_No_normal1->CurrentValue;
			$this->Val[6] = $Total_Attendance->Total_No_normal2->CurrentValue;
			$this->Val[7] = $Total_Attendance->Total_No_Sunday->CurrentValue;
			$this->Val[8] = $Total_Attendance->Total_No_Holyday->CurrentValue;
		} else {
			$Total_Attendance->ID->setDbValue("");
			$Total_Attendance->FirstName->setDbValue("");
			$Total_Attendance->MiddelName->setDbValue("");
			$Total_Attendance->Department->setDbValue("");
			$Total_Attendance->Total_Absent->setDbValue("");
			$Total_Attendance->Total_No_normal1->setDbValue("");
			$Total_Attendance->Total_No_normal2->setDbValue("");
			$Total_Attendance->Total_No_Sunday->setDbValue("");
			$Total_Attendance->Total_No_Holyday->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $Total_Attendance;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$Total_Attendance->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$Total_Attendance->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $Total_Attendance->getStartGroup();
			}
		} else {
			$this->StartGrp = $Total_Attendance->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$Total_Attendance->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$Total_Attendance->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$Total_Attendance->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $Total_Attendance;

		// Initialize popup
		// Build distinct values for Department

		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Total_Attendance->Department->SqlSelect, $Total_Attendance->SqlWhere(), $Total_Attendance->SqlGroupBy(), $Total_Attendance->SqlHaving(), $Total_Attendance->Department->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Total_Attendance->Department->setDbValue($rswrk->fields[0]);
			if (is_null($Total_Attendance->Department->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Total_Attendance->Department->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Total_Attendance->Department->GroupViewValue = ewrpt_DisplayGroupValue($Total_Attendance->Department,$Total_Attendance->Department->GroupValue());
				ewrpt_SetupDistinctValues($Total_Attendance->Department->ValueList, $Total_Attendance->Department->GroupValue(), $Total_Attendance->Department->GroupViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Total_Attendance->Department->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Total_Attendance->Department->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for ID
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Total_Attendance->ID->SqlSelect, $Total_Attendance->SqlWhere(), $Total_Attendance->SqlGroupBy(), $Total_Attendance->SqlHaving(), $Total_Attendance->ID->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Total_Attendance->ID->setDbValue($rswrk->fields[0]);
			if (is_null($Total_Attendance->ID->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Total_Attendance->ID->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Total_Attendance->ID->ViewValue = $Total_Attendance->ID->CurrentValue;
				ewrpt_SetupDistinctValues($Total_Attendance->ID->ValueList, $Total_Attendance->ID->CurrentValue, $Total_Attendance->ID->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Total_Attendance->ID->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Total_Attendance->ID->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for FirstName
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Total_Attendance->FirstName->SqlSelect, $Total_Attendance->SqlWhere(), $Total_Attendance->SqlGroupBy(), $Total_Attendance->SqlHaving(), $Total_Attendance->FirstName->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Total_Attendance->FirstName->setDbValue($rswrk->fields[0]);
			if (is_null($Total_Attendance->FirstName->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Total_Attendance->FirstName->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Total_Attendance->FirstName->ViewValue = $Total_Attendance->FirstName->CurrentValue;
				ewrpt_SetupDistinctValues($Total_Attendance->FirstName->ValueList, $Total_Attendance->FirstName->CurrentValue, $Total_Attendance->FirstName->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Total_Attendance->FirstName->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Total_Attendance->FirstName->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for MiddelName
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Total_Attendance->MiddelName->SqlSelect, $Total_Attendance->SqlWhere(), $Total_Attendance->SqlGroupBy(), $Total_Attendance->SqlHaving(), $Total_Attendance->MiddelName->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Total_Attendance->MiddelName->setDbValue($rswrk->fields[0]);
			if (is_null($Total_Attendance->MiddelName->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Total_Attendance->MiddelName->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Total_Attendance->MiddelName->ViewValue = $Total_Attendance->MiddelName->CurrentValue;
				ewrpt_SetupDistinctValues($Total_Attendance->MiddelName->ValueList, $Total_Attendance->MiddelName->CurrentValue, $Total_Attendance->MiddelName->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Total_Attendance->MiddelName->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Total_Attendance->MiddelName->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for Total_Absent
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Total_Attendance->Total_Absent->SqlSelect, $Total_Attendance->SqlWhere(), $Total_Attendance->SqlGroupBy(), $Total_Attendance->SqlHaving(), $Total_Attendance->Total_Absent->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Total_Attendance->Total_Absent->setDbValue($rswrk->fields[0]);
			if (is_null($Total_Attendance->Total_Absent->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Total_Attendance->Total_Absent->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Total_Attendance->Total_Absent->ViewValue = $Total_Attendance->Total_Absent->CurrentValue;
				ewrpt_SetupDistinctValues($Total_Attendance->Total_Absent->ValueList, $Total_Attendance->Total_Absent->CurrentValue, $Total_Attendance->Total_Absent->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Total_Attendance->Total_Absent->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Total_Attendance->Total_Absent->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for Total_No_normal1
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Total_Attendance->Total_No_normal1->SqlSelect, $Total_Attendance->SqlWhere(), $Total_Attendance->SqlGroupBy(), $Total_Attendance->SqlHaving(), $Total_Attendance->Total_No_normal1->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Total_Attendance->Total_No_normal1->setDbValue($rswrk->fields[0]);
			if (is_null($Total_Attendance->Total_No_normal1->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Total_Attendance->Total_No_normal1->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Total_Attendance->Total_No_normal1->ViewValue = $Total_Attendance->Total_No_normal1->CurrentValue;
				ewrpt_SetupDistinctValues($Total_Attendance->Total_No_normal1->ValueList, $Total_Attendance->Total_No_normal1->CurrentValue, $Total_Attendance->Total_No_normal1->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Total_Attendance->Total_No_normal1->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Total_Attendance->Total_No_normal1->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for Total_No_normal2
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Total_Attendance->Total_No_normal2->SqlSelect, $Total_Attendance->SqlWhere(), $Total_Attendance->SqlGroupBy(), $Total_Attendance->SqlHaving(), $Total_Attendance->Total_No_normal2->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Total_Attendance->Total_No_normal2->setDbValue($rswrk->fields[0]);
			if (is_null($Total_Attendance->Total_No_normal2->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Total_Attendance->Total_No_normal2->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Total_Attendance->Total_No_normal2->ViewValue = $Total_Attendance->Total_No_normal2->CurrentValue;
				ewrpt_SetupDistinctValues($Total_Attendance->Total_No_normal2->ValueList, $Total_Attendance->Total_No_normal2->CurrentValue, $Total_Attendance->Total_No_normal2->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Total_Attendance->Total_No_normal2->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Total_Attendance->Total_No_normal2->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for Total_No_Sunday
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Total_Attendance->Total_No_Sunday->SqlSelect, $Total_Attendance->SqlWhere(), $Total_Attendance->SqlGroupBy(), $Total_Attendance->SqlHaving(), $Total_Attendance->Total_No_Sunday->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Total_Attendance->Total_No_Sunday->setDbValue($rswrk->fields[0]);
			if (is_null($Total_Attendance->Total_No_Sunday->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Total_Attendance->Total_No_Sunday->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Total_Attendance->Total_No_Sunday->ViewValue = $Total_Attendance->Total_No_Sunday->CurrentValue;
				ewrpt_SetupDistinctValues($Total_Attendance->Total_No_Sunday->ValueList, $Total_Attendance->Total_No_Sunday->CurrentValue, $Total_Attendance->Total_No_Sunday->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Total_Attendance->Total_No_Sunday->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Total_Attendance->Total_No_Sunday->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for Total_No_Holyday
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Total_Attendance->Total_No_Holyday->SqlSelect, $Total_Attendance->SqlWhere(), $Total_Attendance->SqlGroupBy(), $Total_Attendance->SqlHaving(), $Total_Attendance->Total_No_Holyday->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Total_Attendance->Total_No_Holyday->setDbValue($rswrk->fields[0]);
			if (is_null($Total_Attendance->Total_No_Holyday->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Total_Attendance->Total_No_Holyday->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Total_Attendance->Total_No_Holyday->ViewValue = $Total_Attendance->Total_No_Holyday->CurrentValue;
				ewrpt_SetupDistinctValues($Total_Attendance->Total_No_Holyday->ValueList, $Total_Attendance->Total_No_Holyday->CurrentValue, $Total_Attendance->Total_No_Holyday->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Total_Attendance->Total_No_Holyday->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Total_Attendance->Total_No_Holyday->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

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
				$this->ClearSessionSelection('Department');
				$this->ClearSessionSelection('ID');
				$this->ClearSessionSelection('FirstName');
				$this->ClearSessionSelection('MiddelName');
				$this->ClearSessionSelection('Total_Absent');
				$this->ClearSessionSelection('Total_No_normal1');
				$this->ClearSessionSelection('Total_No_normal2');
				$this->ClearSessionSelection('Total_No_Sunday');
				$this->ClearSessionSelection('Total_No_Holyday');
				$this->ResetPager();
			}
		}

		// Load selection criteria to array
		// Get Department selected values

		if (is_array(@$_SESSION["sel_Total_Attendance_Department"])) {
			$this->LoadSelectionFromSession('Department');
		} elseif (@$_SESSION["sel_Total_Attendance_Department"] == EWRPT_INIT_VALUE) { // Select all
			$Total_Attendance->Department->SelectionList = "";
		}

		// Get ID selected values
		if (is_array(@$_SESSION["sel_Total_Attendance_ID"])) {
			$this->LoadSelectionFromSession('ID');
		} elseif (@$_SESSION["sel_Total_Attendance_ID"] == EWRPT_INIT_VALUE) { // Select all
			$Total_Attendance->ID->SelectionList = "";
		}

		// Get First Name selected values
		if (is_array(@$_SESSION["sel_Total_Attendance_FirstName"])) {
			$this->LoadSelectionFromSession('FirstName');
		} elseif (@$_SESSION["sel_Total_Attendance_FirstName"] == EWRPT_INIT_VALUE) { // Select all
			$Total_Attendance->FirstName->SelectionList = "";
		}

		// Get Middel Name selected values
		if (is_array(@$_SESSION["sel_Total_Attendance_MiddelName"])) {
			$this->LoadSelectionFromSession('MiddelName');
		} elseif (@$_SESSION["sel_Total_Attendance_MiddelName"] == EWRPT_INIT_VALUE) { // Select all
			$Total_Attendance->MiddelName->SelectionList = "";
		}

		// Get Total Absent selected values
		if (is_array(@$_SESSION["sel_Total_Attendance_Total_Absent"])) {
			$this->LoadSelectionFromSession('Total_Absent');
		} elseif (@$_SESSION["sel_Total_Attendance_Total_Absent"] == EWRPT_INIT_VALUE) { // Select all
			$Total_Attendance->Total_Absent->SelectionList = "";
		}

		// Get Total No normal 1 selected values
		if (is_array(@$_SESSION["sel_Total_Attendance_Total_No_normal1"])) {
			$this->LoadSelectionFromSession('Total_No_normal1');
		} elseif (@$_SESSION["sel_Total_Attendance_Total_No_normal1"] == EWRPT_INIT_VALUE) { // Select all
			$Total_Attendance->Total_No_normal1->SelectionList = "";
		}

		// Get Total No normal 2 selected values
		if (is_array(@$_SESSION["sel_Total_Attendance_Total_No_normal2"])) {
			$this->LoadSelectionFromSession('Total_No_normal2');
		} elseif (@$_SESSION["sel_Total_Attendance_Total_No_normal2"] == EWRPT_INIT_VALUE) { // Select all
			$Total_Attendance->Total_No_normal2->SelectionList = "";
		}

		// Get Total No Sunday selected values
		if (is_array(@$_SESSION["sel_Total_Attendance_Total_No_Sunday"])) {
			$this->LoadSelectionFromSession('Total_No_Sunday');
		} elseif (@$_SESSION["sel_Total_Attendance_Total_No_Sunday"] == EWRPT_INIT_VALUE) { // Select all
			$Total_Attendance->Total_No_Sunday->SelectionList = "";
		}

		// Get Total No Holyday selected values
		if (is_array(@$_SESSION["sel_Total_Attendance_Total_No_Holyday"])) {
			$this->LoadSelectionFromSession('Total_No_Holyday');
		} elseif (@$_SESSION["sel_Total_Attendance_Total_No_Holyday"] == EWRPT_INIT_VALUE) { // Select all
			$Total_Attendance->Total_No_Holyday->SelectionList = "";
		}
	}

	// Reset pager
	function ResetPager() {

		// Reset start position (reset command)
		global $Total_Attendance;
		$this->StartGrp = 1;
		$Total_Attendance->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $Total_Attendance;
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
			$Total_Attendance->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$Total_Attendance->setStartGroup($this->StartGrp);
		} else {
			if ($Total_Attendance->getGroupPerPage() <> "") {
				$this->DisplayGrps = $Total_Attendance->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $Security;
		global $Total_Attendance;
		if ($Total_Attendance->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($Total_Attendance->SqlSelectCount(), $Total_Attendance->SqlWhere(), $Total_Attendance->SqlGroupBy(), $Total_Attendance->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}

			// Get total from sql directly
			$sSql = ewrpt_BuildReportSql($Total_Attendance->SqlSelectAgg(), $Total_Attendance->SqlWhere(), $Total_Attendance->SqlGroupBy(), $Total_Attendance->SqlHaving(), "", $this->Filter, "");
			$sSql = $Total_Attendance->SqlAggPfx() . $sSql . $Total_Attendance->SqlAggSfx();
			$rsagg = $conn->Execute($sSql);
			if ($rsagg) {
				$this->GrandSmry[8] = $rsagg->fields("sum_total_no_holyday");
				$rsagg->Close();
			} else {

				// Accumulate grand summary from detail records
				$sSql = ewrpt_BuildReportSql($Total_Attendance->SqlSelect(), $Total_Attendance->SqlWhere(), $Total_Attendance->SqlGroupBy(), $Total_Attendance->SqlHaving(), "", $this->Filter, "");
				$rs = $conn->Execute($sSql);
				if ($rs) {
					$this->GetRow(1);
					while (!$rs->EOF) {
						$this->AccumulateGrandSummary();
						$this->GetRow(2);
					}
					$rs->Close();
				}
			}
		}

		// Call Row_Rendering event
		$Total_Attendance->Row_Rendering();

		/* --------------------
		'  Render view codes
		' --------------------- */
		if ($Total_Attendance->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// Department
			$Total_Attendance->Department->GroupViewValue = $Total_Attendance->Department->GroupOldValue();
			$Total_Attendance->Department->CellAttrs["class"] = ($Total_Attendance->RowGroupLevel == 1) ? "ewRptGrpSummary1" : "ewRptGrpField1";
			$Total_Attendance->Department->GroupViewValue = ewrpt_DisplayGroupValue($Total_Attendance->Department, $Total_Attendance->Department->GroupViewValue);

			// ID
			$Total_Attendance->ID->ViewValue = $Total_Attendance->ID->Summary;

			// FirstName
			$Total_Attendance->FirstName->ViewValue = $Total_Attendance->FirstName->Summary;

			// MiddelName
			$Total_Attendance->MiddelName->ViewValue = $Total_Attendance->MiddelName->Summary;

			// Total_Absent
			$Total_Attendance->Total_Absent->ViewValue = $Total_Attendance->Total_Absent->Summary;

			// Total_No_normal1
			$Total_Attendance->Total_No_normal1->ViewValue = $Total_Attendance->Total_No_normal1->Summary;

			// Total_No_normal2
			$Total_Attendance->Total_No_normal2->ViewValue = $Total_Attendance->Total_No_normal2->Summary;

			// Total_No_Sunday
			$Total_Attendance->Total_No_Sunday->ViewValue = $Total_Attendance->Total_No_Sunday->Summary;

			// Total_No_Holyday
			$Total_Attendance->Total_No_Holyday->ViewValue = $Total_Attendance->Total_No_Holyday->Summary;
		} else {

			// Department
			$Total_Attendance->Department->GroupViewValue = $Total_Attendance->Department->GroupValue();
			$Total_Attendance->Department->CellAttrs["class"] = "ewRptGrpField1";
			$Total_Attendance->Department->GroupViewValue = ewrpt_DisplayGroupValue($Total_Attendance->Department, $Total_Attendance->Department->GroupViewValue);
			if ($Total_Attendance->Department->GroupValue() == $Total_Attendance->Department->GroupOldValue() && !$this->ChkLvlBreak(1))
				$Total_Attendance->Department->GroupViewValue = "&nbsp;";

			// ID
			$Total_Attendance->ID->ViewValue = $Total_Attendance->ID->CurrentValue;
			$Total_Attendance->ID->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// FirstName
			$Total_Attendance->FirstName->ViewValue = $Total_Attendance->FirstName->CurrentValue;
			$Total_Attendance->FirstName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// MiddelName
			$Total_Attendance->MiddelName->ViewValue = $Total_Attendance->MiddelName->CurrentValue;
			$Total_Attendance->MiddelName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Total_Absent
			$Total_Attendance->Total_Absent->ViewValue = $Total_Attendance->Total_Absent->CurrentValue;
			$Total_Attendance->Total_Absent->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Total_No_normal1
			$Total_Attendance->Total_No_normal1->ViewValue = $Total_Attendance->Total_No_normal1->CurrentValue;
			$Total_Attendance->Total_No_normal1->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Total_No_normal2
			$Total_Attendance->Total_No_normal2->ViewValue = $Total_Attendance->Total_No_normal2->CurrentValue;
			$Total_Attendance->Total_No_normal2->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Total_No_Sunday
			$Total_Attendance->Total_No_Sunday->ViewValue = $Total_Attendance->Total_No_Sunday->CurrentValue;
			$Total_Attendance->Total_No_Sunday->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Total_No_Holyday
			$Total_Attendance->Total_No_Holyday->ViewValue = $Total_Attendance->Total_No_Holyday->CurrentValue;
			$Total_Attendance->Total_No_Holyday->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// Department
		$Total_Attendance->Department->HrefValue = "";

		// ID
		$Total_Attendance->ID->HrefValue = "";

		// FirstName
		$Total_Attendance->FirstName->HrefValue = "";

		// MiddelName
		$Total_Attendance->MiddelName->HrefValue = "";

		// Total_Absent
		$Total_Attendance->Total_Absent->HrefValue = "";

		// Total_No_normal1
		$Total_Attendance->Total_No_normal1->HrefValue = "";

		// Total_No_normal2
		$Total_Attendance->Total_No_normal2->HrefValue = "";

		// Total_No_Sunday
		$Total_Attendance->Total_No_Sunday->HrefValue = "";

		// Total_No_Holyday
		$Total_Attendance->Total_No_Holyday->HrefValue = "";

		// Call Row_Rendered event
		$Total_Attendance->Row_Rendered();
	}

	// Get extended filter values
	function GetExtendedFilterValues() {
		global $Total_Attendance;
	}

	// Return extended filter
	function GetExtendedFilter() {
		global $Total_Attendance;
		global $gsFormError;
		$sFilter = "";
		$bPostBack = ewrpt_IsHttpPost();
		$bRestoreSession = TRUE;
		$bSetupFilter = FALSE;

		// Reset extended filter if filter changed
		if ($bPostBack) {

			// Clear extended filter for field FirstName
			if ($this->ClearExtFilter == 'Total_Attendance_FirstName')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'FirstName');

			// Clear extended filter for field MiddelName
			if ($this->ClearExtFilter == 'Total_Attendance_MiddelName')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'MiddelName');

			// Clear extended filter for field Department
			if ($this->ClearExtFilter == 'Total_Attendance_Department')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'Department');

			// Clear extended filter for field Total_Absent
			if ($this->ClearExtFilter == 'Total_Attendance_Total_Absent')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'Total_Absent');

			// Clear extended filter for field Total_No_normal1
			if ($this->ClearExtFilter == 'Total_Attendance_Total_No_normal1')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'Total_No_normal1');

			// Clear extended filter for field Total_No_normal2
			if ($this->ClearExtFilter == 'Total_Attendance_Total_No_normal2')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'Total_No_normal2');

			// Clear extended filter for field Total_No_Sunday
			if ($this->ClearExtFilter == 'Total_Attendance_Total_No_Sunday')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'Total_No_Sunday');

			// Clear extended filter for field Total_No_Holyday
			if ($this->ClearExtFilter == 'Total_Attendance_Total_No_Holyday')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'Total_No_Holyday');

		// Reset search command
		} elseif (@$_GET["cmd"] == "reset") {

			// Load default values
			// Field FirstName

			$this->SetSessionFilterValues($Total_Attendance->FirstName->SearchValue, $Total_Attendance->FirstName->SearchOperator, $Total_Attendance->FirstName->SearchCondition, $Total_Attendance->FirstName->SearchValue2, $Total_Attendance->FirstName->SearchOperator2, 'FirstName');

			// Field MiddelName
			$this->SetSessionFilterValues($Total_Attendance->MiddelName->SearchValue, $Total_Attendance->MiddelName->SearchOperator, $Total_Attendance->MiddelName->SearchCondition, $Total_Attendance->MiddelName->SearchValue2, $Total_Attendance->MiddelName->SearchOperator2, 'MiddelName');

			// Field Department
			$this->SetSessionFilterValues($Total_Attendance->Department->SearchValue, $Total_Attendance->Department->SearchOperator, $Total_Attendance->Department->SearchCondition, $Total_Attendance->Department->SearchValue2, $Total_Attendance->Department->SearchOperator2, 'Department');

			// Field Total_Absent
			$this->SetSessionFilterValues($Total_Attendance->Total_Absent->SearchValue, $Total_Attendance->Total_Absent->SearchOperator, $Total_Attendance->Total_Absent->SearchCondition, $Total_Attendance->Total_Absent->SearchValue2, $Total_Attendance->Total_Absent->SearchOperator2, 'Total_Absent');

			// Field Total_No_normal1
			$this->SetSessionFilterValues($Total_Attendance->Total_No_normal1->SearchValue, $Total_Attendance->Total_No_normal1->SearchOperator, $Total_Attendance->Total_No_normal1->SearchCondition, $Total_Attendance->Total_No_normal1->SearchValue2, $Total_Attendance->Total_No_normal1->SearchOperator2, 'Total_No_normal1');

			// Field Total_No_normal2
			$this->SetSessionFilterValues($Total_Attendance->Total_No_normal2->SearchValue, $Total_Attendance->Total_No_normal2->SearchOperator, $Total_Attendance->Total_No_normal2->SearchCondition, $Total_Attendance->Total_No_normal2->SearchValue2, $Total_Attendance->Total_No_normal2->SearchOperator2, 'Total_No_normal2');

			// Field Total_No_Sunday
			$this->SetSessionFilterValues($Total_Attendance->Total_No_Sunday->SearchValue, $Total_Attendance->Total_No_Sunday->SearchOperator, $Total_Attendance->Total_No_Sunday->SearchCondition, $Total_Attendance->Total_No_Sunday->SearchValue2, $Total_Attendance->Total_No_Sunday->SearchOperator2, 'Total_No_Sunday');

			// Field Total_No_Holyday
			$this->SetSessionFilterValues($Total_Attendance->Total_No_Holyday->SearchValue, $Total_Attendance->Total_No_Holyday->SearchOperator, $Total_Attendance->Total_No_Holyday->SearchCondition, $Total_Attendance->Total_No_Holyday->SearchValue2, $Total_Attendance->Total_No_Holyday->SearchOperator2, 'Total_No_Holyday');
			$bSetupFilter = TRUE;
		} else {

			// Field FirstName
			if ($this->GetFilterValues($Total_Attendance->FirstName)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field MiddelName
			if ($this->GetFilterValues($Total_Attendance->MiddelName)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field Department
			if ($this->GetFilterValues($Total_Attendance->Department)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field Total_Absent
			if ($this->GetFilterValues($Total_Attendance->Total_Absent)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field Total_No_normal1
			if ($this->GetFilterValues($Total_Attendance->Total_No_normal1)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field Total_No_normal2
			if ($this->GetFilterValues($Total_Attendance->Total_No_normal2)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field Total_No_Sunday
			if ($this->GetFilterValues($Total_Attendance->Total_No_Sunday)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field Total_No_Holyday
			if ($this->GetFilterValues($Total_Attendance->Total_No_Holyday)) {
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

			// Field FirstName
			$this->GetSessionFilterValues($Total_Attendance->FirstName);

			// Field MiddelName
			$this->GetSessionFilterValues($Total_Attendance->MiddelName);

			// Field Department
			$this->GetSessionFilterValues($Total_Attendance->Department);

			// Field Total_Absent
			$this->GetSessionFilterValues($Total_Attendance->Total_Absent);

			// Field Total_No_normal1
			$this->GetSessionFilterValues($Total_Attendance->Total_No_normal1);

			// Field Total_No_normal2
			$this->GetSessionFilterValues($Total_Attendance->Total_No_normal2);

			// Field Total_No_Sunday
			$this->GetSessionFilterValues($Total_Attendance->Total_No_Sunday);

			// Field Total_No_Holyday
			$this->GetSessionFilterValues($Total_Attendance->Total_No_Holyday);
		}

		// Call page filter validated event
		$Total_Attendance->Page_FilterValidated();

		// Build SQL
		// Field FirstName

		$this->BuildExtendedFilter($Total_Attendance->FirstName, $sFilter);

		// Field MiddelName
		$this->BuildExtendedFilter($Total_Attendance->MiddelName, $sFilter);

		// Field Department
		$this->BuildExtendedFilter($Total_Attendance->Department, $sFilter);

		// Field Total_Absent
		$this->BuildExtendedFilter($Total_Attendance->Total_Absent, $sFilter);

		// Field Total_No_normal1
		$this->BuildExtendedFilter($Total_Attendance->Total_No_normal1, $sFilter);

		// Field Total_No_normal2
		$this->BuildExtendedFilter($Total_Attendance->Total_No_normal2, $sFilter);

		// Field Total_No_Sunday
		$this->BuildExtendedFilter($Total_Attendance->Total_No_Sunday, $sFilter);

		// Field Total_No_Holyday
		$this->BuildExtendedFilter($Total_Attendance->Total_No_Holyday, $sFilter);

		// Save parms to session
		// Field FirstName

		$this->SetSessionFilterValues($Total_Attendance->FirstName->SearchValue, $Total_Attendance->FirstName->SearchOperator, $Total_Attendance->FirstName->SearchCondition, $Total_Attendance->FirstName->SearchValue2, $Total_Attendance->FirstName->SearchOperator2, 'FirstName');

		// Field MiddelName
		$this->SetSessionFilterValues($Total_Attendance->MiddelName->SearchValue, $Total_Attendance->MiddelName->SearchOperator, $Total_Attendance->MiddelName->SearchCondition, $Total_Attendance->MiddelName->SearchValue2, $Total_Attendance->MiddelName->SearchOperator2, 'MiddelName');

		// Field Department
		$this->SetSessionFilterValues($Total_Attendance->Department->SearchValue, $Total_Attendance->Department->SearchOperator, $Total_Attendance->Department->SearchCondition, $Total_Attendance->Department->SearchValue2, $Total_Attendance->Department->SearchOperator2, 'Department');

		// Field Total_Absent
		$this->SetSessionFilterValues($Total_Attendance->Total_Absent->SearchValue, $Total_Attendance->Total_Absent->SearchOperator, $Total_Attendance->Total_Absent->SearchCondition, $Total_Attendance->Total_Absent->SearchValue2, $Total_Attendance->Total_Absent->SearchOperator2, 'Total_Absent');

		// Field Total_No_normal1
		$this->SetSessionFilterValues($Total_Attendance->Total_No_normal1->SearchValue, $Total_Attendance->Total_No_normal1->SearchOperator, $Total_Attendance->Total_No_normal1->SearchCondition, $Total_Attendance->Total_No_normal1->SearchValue2, $Total_Attendance->Total_No_normal1->SearchOperator2, 'Total_No_normal1');

		// Field Total_No_normal2
		$this->SetSessionFilterValues($Total_Attendance->Total_No_normal2->SearchValue, $Total_Attendance->Total_No_normal2->SearchOperator, $Total_Attendance->Total_No_normal2->SearchCondition, $Total_Attendance->Total_No_normal2->SearchValue2, $Total_Attendance->Total_No_normal2->SearchOperator2, 'Total_No_normal2');

		// Field Total_No_Sunday
		$this->SetSessionFilterValues($Total_Attendance->Total_No_Sunday->SearchValue, $Total_Attendance->Total_No_Sunday->SearchOperator, $Total_Attendance->Total_No_Sunday->SearchCondition, $Total_Attendance->Total_No_Sunday->SearchValue2, $Total_Attendance->Total_No_Sunday->SearchOperator2, 'Total_No_Sunday');

		// Field Total_No_Holyday
		$this->SetSessionFilterValues($Total_Attendance->Total_No_Holyday->SearchValue, $Total_Attendance->Total_No_Holyday->SearchOperator, $Total_Attendance->Total_No_Holyday->SearchCondition, $Total_Attendance->Total_No_Holyday->SearchValue2, $Total_Attendance->Total_No_Holyday->SearchOperator2, 'Total_No_Holyday');

		// Setup filter
		if ($bSetupFilter) {

			// Field FirstName
			$sWrk = "";
			$this->BuildExtendedFilter($Total_Attendance->FirstName, $sWrk);
			$this->LoadSelectionFromFilter($Total_Attendance->FirstName, $sWrk, $Total_Attendance->FirstName->SelectionList);
			$_SESSION['sel_Total_Attendance_FirstName'] = ($Total_Attendance->FirstName->SelectionList == "") ? EWRPT_INIT_VALUE : $Total_Attendance->FirstName->SelectionList;

			// Field MiddelName
			$sWrk = "";
			$this->BuildExtendedFilter($Total_Attendance->MiddelName, $sWrk);
			$this->LoadSelectionFromFilter($Total_Attendance->MiddelName, $sWrk, $Total_Attendance->MiddelName->SelectionList);
			$_SESSION['sel_Total_Attendance_MiddelName'] = ($Total_Attendance->MiddelName->SelectionList == "") ? EWRPT_INIT_VALUE : $Total_Attendance->MiddelName->SelectionList;

			// Field Department
			$sWrk = "";
			$this->BuildExtendedFilter($Total_Attendance->Department, $sWrk);
			$this->LoadSelectionFromFilter($Total_Attendance->Department, $sWrk, $Total_Attendance->Department->SelectionList);
			$_SESSION['sel_Total_Attendance_Department'] = ($Total_Attendance->Department->SelectionList == "") ? EWRPT_INIT_VALUE : $Total_Attendance->Department->SelectionList;

			// Field Total_Absent
			$sWrk = "";
			$this->BuildExtendedFilter($Total_Attendance->Total_Absent, $sWrk);
			$this->LoadSelectionFromFilter($Total_Attendance->Total_Absent, $sWrk, $Total_Attendance->Total_Absent->SelectionList);
			$_SESSION['sel_Total_Attendance_Total_Absent'] = ($Total_Attendance->Total_Absent->SelectionList == "") ? EWRPT_INIT_VALUE : $Total_Attendance->Total_Absent->SelectionList;

			// Field Total_No_normal1
			$sWrk = "";
			$this->BuildExtendedFilter($Total_Attendance->Total_No_normal1, $sWrk);
			$this->LoadSelectionFromFilter($Total_Attendance->Total_No_normal1, $sWrk, $Total_Attendance->Total_No_normal1->SelectionList);
			$_SESSION['sel_Total_Attendance_Total_No_normal1'] = ($Total_Attendance->Total_No_normal1->SelectionList == "") ? EWRPT_INIT_VALUE : $Total_Attendance->Total_No_normal1->SelectionList;

			// Field Total_No_normal2
			$sWrk = "";
			$this->BuildExtendedFilter($Total_Attendance->Total_No_normal2, $sWrk);
			$this->LoadSelectionFromFilter($Total_Attendance->Total_No_normal2, $sWrk, $Total_Attendance->Total_No_normal2->SelectionList);
			$_SESSION['sel_Total_Attendance_Total_No_normal2'] = ($Total_Attendance->Total_No_normal2->SelectionList == "") ? EWRPT_INIT_VALUE : $Total_Attendance->Total_No_normal2->SelectionList;

			// Field Total_No_Sunday
			$sWrk = "";
			$this->BuildExtendedFilter($Total_Attendance->Total_No_Sunday, $sWrk);
			$this->LoadSelectionFromFilter($Total_Attendance->Total_No_Sunday, $sWrk, $Total_Attendance->Total_No_Sunday->SelectionList);
			$_SESSION['sel_Total_Attendance_Total_No_Sunday'] = ($Total_Attendance->Total_No_Sunday->SelectionList == "") ? EWRPT_INIT_VALUE : $Total_Attendance->Total_No_Sunday->SelectionList;

			// Field Total_No_Holyday
			$sWrk = "";
			$this->BuildExtendedFilter($Total_Attendance->Total_No_Holyday, $sWrk);
			$this->LoadSelectionFromFilter($Total_Attendance->Total_No_Holyday, $sWrk, $Total_Attendance->Total_No_Holyday->SelectionList);
			$_SESSION['sel_Total_Attendance_Total_No_Holyday'] = ($Total_Attendance->Total_No_Holyday->SelectionList == "") ? EWRPT_INIT_VALUE : $Total_Attendance->Total_No_Holyday->SelectionList;
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
		$this->GetSessionValue($fld->DropDownValue, 'sv_Total_Attendance_' . $parm);
	}

	// Get filter values from session
	function GetSessionFilterValues(&$fld) {
		$parm = substr($fld->FldVar, 2);
		$this->GetSessionValue($fld->SearchValue, 'sv1_Total_Attendance_' . $parm);
		$this->GetSessionValue($fld->SearchOperator, 'so1_Total_Attendance_' . $parm);
		$this->GetSessionValue($fld->SearchCondition, 'sc_Total_Attendance_' . $parm);
		$this->GetSessionValue($fld->SearchValue2, 'sv2_Total_Attendance_' . $parm);
		$this->GetSessionValue($fld->SearchOperator2, 'so2_Total_Attendance_' . $parm);
	}

	// Get value from session
	function GetSessionValue(&$sv, $sn) {
		if (isset($_SESSION[$sn]))
			$sv = $_SESSION[$sn];
	}

	// Set dropdown value to session
	function SetSessionDropDownValue($sv, $parm) {
		$_SESSION['sv_Total_Attendance_' . $parm] = $sv;
	}

	// Set filter values to session
	function SetSessionFilterValues($sv1, $so1, $sc, $sv2, $so2, $parm) {
		$_SESSION['sv1_Total_Attendance_' . $parm] = $sv1;
		$_SESSION['so1_Total_Attendance_' . $parm] = $so1;
		$_SESSION['sc_Total_Attendance_' . $parm] = $sc;
		$_SESSION['sv2_Total_Attendance_' . $parm] = $sv2;
		$_SESSION['so2_Total_Attendance_' . $parm] = $so2;
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
		global $ReportLanguage, $gsFormError, $Total_Attendance;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EWRPT_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ewrpt_CheckNumber($Total_Attendance->Total_Absent->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Total_Attendance->Total_Absent->FldErrMsg();
		}
		if (!ewrpt_CheckNumber($Total_Attendance->Total_No_normal1->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Total_Attendance->Total_No_normal1->FldErrMsg();
		}
		if (!ewrpt_CheckNumber($Total_Attendance->Total_No_normal2->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Total_Attendance->Total_No_normal2->FldErrMsg();
		}
		if (!ewrpt_CheckNumber($Total_Attendance->Total_No_Sunday->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Total_Attendance->Total_No_Sunday->FldErrMsg();
		}
		if (!ewrpt_CheckNumber($Total_Attendance->Total_No_Holyday->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Total_Attendance->Total_No_Holyday->FldErrMsg();
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
		$_SESSION["sel_Total_Attendance_$parm"] = "";
		$_SESSION["rf_Total_Attendance_$parm"] = "";
		$_SESSION["rt_Total_Attendance_$parm"] = "";
	}

	// Load selection from session
	function LoadSelectionFromSession($parm) {
		global $Total_Attendance;
		$fld =& $Total_Attendance->fields($parm);
		$fld->SelectionList = @$_SESSION["sel_Total_Attendance_$parm"];
		$fld->RangeFrom = @$_SESSION["rf_Total_Attendance_$parm"];
		$fld->RangeTo = @$_SESSION["rt_Total_Attendance_$parm"];
	}

	// Load default value for filters
	function LoadDefaultFilters() {
		global $Total_Attendance;

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

		// Field FirstName
		$this->SetDefaultExtFilter($Total_Attendance->FirstName, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Total_Attendance->FirstName);
		$sWrk = "";
		$this->BuildExtendedFilter($Total_Attendance->FirstName, $sWrk);
		$this->LoadSelectionFromFilter($Total_Attendance->FirstName, $sWrk, $Total_Attendance->FirstName->DefaultSelectionList);
		$Total_Attendance->FirstName->SelectionList = $Total_Attendance->FirstName->DefaultSelectionList;

		// Field MiddelName
		$this->SetDefaultExtFilter($Total_Attendance->MiddelName, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Total_Attendance->MiddelName);
		$sWrk = "";
		$this->BuildExtendedFilter($Total_Attendance->MiddelName, $sWrk);
		$this->LoadSelectionFromFilter($Total_Attendance->MiddelName, $sWrk, $Total_Attendance->MiddelName->DefaultSelectionList);
		$Total_Attendance->MiddelName->SelectionList = $Total_Attendance->MiddelName->DefaultSelectionList;

		// Field Department
		$this->SetDefaultExtFilter($Total_Attendance->Department, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Total_Attendance->Department);
		$sWrk = "";
		$this->BuildExtendedFilter($Total_Attendance->Department, $sWrk);
		$this->LoadSelectionFromFilter($Total_Attendance->Department, $sWrk, $Total_Attendance->Department->DefaultSelectionList);
		$Total_Attendance->Department->SelectionList = $Total_Attendance->Department->DefaultSelectionList;

		// Field Total_Absent
		$this->SetDefaultExtFilter($Total_Attendance->Total_Absent, "USER SELECT", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Total_Attendance->Total_Absent);
		$sWrk = "";
		$this->BuildExtendedFilter($Total_Attendance->Total_Absent, $sWrk);
		$this->LoadSelectionFromFilter($Total_Attendance->Total_Absent, $sWrk, $Total_Attendance->Total_Absent->DefaultSelectionList);
		$Total_Attendance->Total_Absent->SelectionList = $Total_Attendance->Total_Absent->DefaultSelectionList;

		// Field Total_No_normal1
		$this->SetDefaultExtFilter($Total_Attendance->Total_No_normal1, "USER SELECT", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Total_Attendance->Total_No_normal1);
		$sWrk = "";
		$this->BuildExtendedFilter($Total_Attendance->Total_No_normal1, $sWrk);
		$this->LoadSelectionFromFilter($Total_Attendance->Total_No_normal1, $sWrk, $Total_Attendance->Total_No_normal1->DefaultSelectionList);
		$Total_Attendance->Total_No_normal1->SelectionList = $Total_Attendance->Total_No_normal1->DefaultSelectionList;

		// Field Total_No_normal2
		$this->SetDefaultExtFilter($Total_Attendance->Total_No_normal2, "USER SELECT", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Total_Attendance->Total_No_normal2);
		$sWrk = "";
		$this->BuildExtendedFilter($Total_Attendance->Total_No_normal2, $sWrk);
		$this->LoadSelectionFromFilter($Total_Attendance->Total_No_normal2, $sWrk, $Total_Attendance->Total_No_normal2->DefaultSelectionList);
		$Total_Attendance->Total_No_normal2->SelectionList = $Total_Attendance->Total_No_normal2->DefaultSelectionList;

		// Field Total_No_Sunday
		$this->SetDefaultExtFilter($Total_Attendance->Total_No_Sunday, "USER SELECT", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Total_Attendance->Total_No_Sunday);
		$sWrk = "";
		$this->BuildExtendedFilter($Total_Attendance->Total_No_Sunday, $sWrk);
		$this->LoadSelectionFromFilter($Total_Attendance->Total_No_Sunday, $sWrk, $Total_Attendance->Total_No_Sunday->DefaultSelectionList);
		$Total_Attendance->Total_No_Sunday->SelectionList = $Total_Attendance->Total_No_Sunday->DefaultSelectionList;

		// Field Total_No_Holyday
		$this->SetDefaultExtFilter($Total_Attendance->Total_No_Holyday, "USER SELECT", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Total_Attendance->Total_No_Holyday);
		$sWrk = "";
		$this->BuildExtendedFilter($Total_Attendance->Total_No_Holyday, $sWrk);
		$this->LoadSelectionFromFilter($Total_Attendance->Total_No_Holyday, $sWrk, $Total_Attendance->Total_No_Holyday->DefaultSelectionList);
		$Total_Attendance->Total_No_Holyday->SelectionList = $Total_Attendance->Total_No_Holyday->DefaultSelectionList;

		/**
		* Set up default values for popup filters
		* NOTE: if extended filter is enabled, use default values in extended filter instead
		*/

		// Field ID
		// Setup your default values for the popup filter below, e.g.
		// $Total_Attendance->ID->DefaultSelectionList = array("val1", "val2");

		$Total_Attendance->ID->DefaultSelectionList = "";
		$Total_Attendance->ID->SelectionList = $Total_Attendance->ID->DefaultSelectionList;
	}

	// Check if filter applied
	function CheckFilter() {
		global $Total_Attendance;

		// Check ID popup filter
		if (!ewrpt_MatchedArray($Total_Attendance->ID->DefaultSelectionList, $Total_Attendance->ID->SelectionList))
			return TRUE;

		// Check FirstName text filter
		if ($this->TextFilterApplied($Total_Attendance->FirstName))
			return TRUE;

		// Check FirstName popup filter
		if (!ewrpt_MatchedArray($Total_Attendance->FirstName->DefaultSelectionList, $Total_Attendance->FirstName->SelectionList))
			return TRUE;

		// Check MiddelName text filter
		if ($this->TextFilterApplied($Total_Attendance->MiddelName))
			return TRUE;

		// Check MiddelName popup filter
		if (!ewrpt_MatchedArray($Total_Attendance->MiddelName->DefaultSelectionList, $Total_Attendance->MiddelName->SelectionList))
			return TRUE;

		// Check Department text filter
		if ($this->TextFilterApplied($Total_Attendance->Department))
			return TRUE;

		// Check Department popup filter
		if (!ewrpt_MatchedArray($Total_Attendance->Department->DefaultSelectionList, $Total_Attendance->Department->SelectionList))
			return TRUE;

		// Check Total_Absent text filter
		if ($this->TextFilterApplied($Total_Attendance->Total_Absent))
			return TRUE;

		// Check Total_Absent popup filter
		if (!ewrpt_MatchedArray($Total_Attendance->Total_Absent->DefaultSelectionList, $Total_Attendance->Total_Absent->SelectionList))
			return TRUE;

		// Check Total_No_normal1 text filter
		if ($this->TextFilterApplied($Total_Attendance->Total_No_normal1))
			return TRUE;

		// Check Total_No_normal1 popup filter
		if (!ewrpt_MatchedArray($Total_Attendance->Total_No_normal1->DefaultSelectionList, $Total_Attendance->Total_No_normal1->SelectionList))
			return TRUE;

		// Check Total_No_normal2 text filter
		if ($this->TextFilterApplied($Total_Attendance->Total_No_normal2))
			return TRUE;

		// Check Total_No_normal2 popup filter
		if (!ewrpt_MatchedArray($Total_Attendance->Total_No_normal2->DefaultSelectionList, $Total_Attendance->Total_No_normal2->SelectionList))
			return TRUE;

		// Check Total_No_Sunday text filter
		if ($this->TextFilterApplied($Total_Attendance->Total_No_Sunday))
			return TRUE;

		// Check Total_No_Sunday popup filter
		if (!ewrpt_MatchedArray($Total_Attendance->Total_No_Sunday->DefaultSelectionList, $Total_Attendance->Total_No_Sunday->SelectionList))
			return TRUE;

		// Check Total_No_Holyday text filter
		if ($this->TextFilterApplied($Total_Attendance->Total_No_Holyday))
			return TRUE;

		// Check Total_No_Holyday popup filter
		if (!ewrpt_MatchedArray($Total_Attendance->Total_No_Holyday->DefaultSelectionList, $Total_Attendance->Total_No_Holyday->SelectionList))
			return TRUE;
		return FALSE;
	}

	// Show list of filters
	function ShowFilterList() {
		global $Total_Attendance;
		global $ReportLanguage;

		// Initialize
		$sFilterList = "";

		// Field ID
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($Total_Attendance->ID->SelectionList))
			$sWrk = ewrpt_JoinArray($Total_Attendance->ID->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Total_Attendance->ID->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field FirstName
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Total_Attendance->FirstName, $sExtWrk);
		if (is_array($Total_Attendance->FirstName->SelectionList))
			$sWrk = ewrpt_JoinArray($Total_Attendance->FirstName->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Total_Attendance->FirstName->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field MiddelName
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Total_Attendance->MiddelName, $sExtWrk);
		if (is_array($Total_Attendance->MiddelName->SelectionList))
			$sWrk = ewrpt_JoinArray($Total_Attendance->MiddelName->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Total_Attendance->MiddelName->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Department
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Total_Attendance->Department, $sExtWrk);
		if (is_array($Total_Attendance->Department->SelectionList))
			$sWrk = ewrpt_JoinArray($Total_Attendance->Department->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Total_Attendance->Department->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Total_Absent
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Total_Attendance->Total_Absent, $sExtWrk);
		if (is_array($Total_Attendance->Total_Absent->SelectionList))
			$sWrk = ewrpt_JoinArray($Total_Attendance->Total_Absent->SelectionList, ", ", EWRPT_DATATYPE_NUMBER);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Total_Attendance->Total_Absent->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Total_No_normal1
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Total_Attendance->Total_No_normal1, $sExtWrk);
		if (is_array($Total_Attendance->Total_No_normal1->SelectionList))
			$sWrk = ewrpt_JoinArray($Total_Attendance->Total_No_normal1->SelectionList, ", ", EWRPT_DATATYPE_NUMBER);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Total_Attendance->Total_No_normal1->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Total_No_normal2
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Total_Attendance->Total_No_normal2, $sExtWrk);
		if (is_array($Total_Attendance->Total_No_normal2->SelectionList))
			$sWrk = ewrpt_JoinArray($Total_Attendance->Total_No_normal2->SelectionList, ", ", EWRPT_DATATYPE_NUMBER);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Total_Attendance->Total_No_normal2->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Total_No_Sunday
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Total_Attendance->Total_No_Sunday, $sExtWrk);
		if (is_array($Total_Attendance->Total_No_Sunday->SelectionList))
			$sWrk = ewrpt_JoinArray($Total_Attendance->Total_No_Sunday->SelectionList, ", ", EWRPT_DATATYPE_NUMBER);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Total_Attendance->Total_No_Sunday->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Total_No_Holyday
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Total_Attendance->Total_No_Holyday, $sExtWrk);
		if (is_array($Total_Attendance->Total_No_Holyday->SelectionList))
			$sWrk = ewrpt_JoinArray($Total_Attendance->Total_No_Holyday->SelectionList, ", ", EWRPT_DATATYPE_NUMBER);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Total_Attendance->Total_No_Holyday->FldCaption() . "<br />";
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
		global $Total_Attendance;
		$sWrk = "";
			if (is_array($Total_Attendance->ID->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Total_Attendance->ID, "`ID`", EWRPT_DATATYPE_STRING);
			}
		if (!$this->ExtendedFilterExist($Total_Attendance->FirstName)) {
			if (is_array($Total_Attendance->FirstName->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Total_Attendance->FirstName, "`FirstName`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Total_Attendance->MiddelName)) {
			if (is_array($Total_Attendance->MiddelName->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Total_Attendance->MiddelName, "`MiddelName`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Total_Attendance->Department)) {
			if (is_array($Total_Attendance->Department->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Total_Attendance->Department, "`Department`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Total_Attendance->Total_Absent)) {
			if (is_array($Total_Attendance->Total_Absent->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Total_Attendance->Total_Absent, "`Total_Absent`", EWRPT_DATATYPE_NUMBER);
			}
		}
		if (!$this->ExtendedFilterExist($Total_Attendance->Total_No_normal1)) {
			if (is_array($Total_Attendance->Total_No_normal1->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Total_Attendance->Total_No_normal1, "`Total_No_normal1`", EWRPT_DATATYPE_NUMBER);
			}
		}
		if (!$this->ExtendedFilterExist($Total_Attendance->Total_No_normal2)) {
			if (is_array($Total_Attendance->Total_No_normal2->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Total_Attendance->Total_No_normal2, "`Total_No_normal2`", EWRPT_DATATYPE_NUMBER);
			}
		}
		if (!$this->ExtendedFilterExist($Total_Attendance->Total_No_Sunday)) {
			if (is_array($Total_Attendance->Total_No_Sunday->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Total_Attendance->Total_No_Sunday, "`Total_No_Sunday`", EWRPT_DATATYPE_NUMBER);
			}
		}
		if (!$this->ExtendedFilterExist($Total_Attendance->Total_No_Holyday)) {
			if (is_array($Total_Attendance->Total_No_Holyday->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Total_Attendance->Total_No_Holyday, "`Total_No_Holyday`", EWRPT_DATATYPE_NUMBER);
			}
		}
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $Total_Attendance;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$Total_Attendance->setOrderBy("");
				$Total_Attendance->setStartGroup(1);
				$Total_Attendance->Department->setSort("");
				$Total_Attendance->ID->setSort("");
				$Total_Attendance->FirstName->setSort("");
				$Total_Attendance->MiddelName->setSort("");
				$Total_Attendance->Total_Absent->setSort("");
				$Total_Attendance->Total_No_normal1->setSort("");
				$Total_Attendance->Total_No_normal2->setSort("");
				$Total_Attendance->Total_No_Sunday->setSort("");
				$Total_Attendance->Total_No_Holyday->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$Total_Attendance->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$Total_Attendance->CurrentOrderType = @$_GET["ordertype"];
			$sSortSql = $Total_Attendance->SortSql();
			$Total_Attendance->setOrderBy($sSortSql);
			$Total_Attendance->setStartGroup(1);
		}

		// Set up default sort
		if ($Total_Attendance->getOrderBy() == "") {
			$Total_Attendance->setOrderBy("`ID` ASC");
			$Total_Attendance->ID->setSort("ASC");
		}
		return $Total_Attendance->getOrderBy();
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
