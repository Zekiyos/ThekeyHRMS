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
$Terminated_Employee = NULL;

//
// Table class for Terminated Employee
//
class crTerminated_Employee {
	var $TableVar = 'Terminated_Employee';
	var $TableName = 'Terminated Employee';
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
	var $Terminated_Employee_Per_Department;
	var $Auto_ID;
	var $ID;
	var $FirstName;
	var $MiddelName;
	var $LastName;
	var $Department;
	var $Terminated_Date;
	var $Termination_Reason;
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
	function crTerminated_Employee() {
		global $ReportLanguage;

		// Auto_ID
		$this->Auto_ID = new crField('Terminated_Employee', 'Terminated Employee', 'x_Auto_ID', 'Auto_ID', '`Auto_ID`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->Auto_ID->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['Auto_ID'] =& $this->Auto_ID;
		$this->Auto_ID->DateFilter = "";
		$this->Auto_ID->SqlSelect = "";
		$this->Auto_ID->SqlOrderBy = "";
		$this->Auto_ID->FldGroupByType = "";
		$this->Auto_ID->FldGroupInt = "0";
		$this->Auto_ID->FldGroupSql = "";

		// ID
		$this->ID = new crField('Terminated_Employee', 'Terminated Employee', 'x_ID', 'ID', '`ID`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['ID'] =& $this->ID;
		$this->ID->DateFilter = "";
		$this->ID->SqlSelect = "SELECT DISTINCT `ID` FROM " . $this->SqlFrom();
		$this->ID->SqlOrderBy = "`ID`";
		$this->ID->FldGroupByType = "";
		$this->ID->FldGroupInt = "0";
		$this->ID->FldGroupSql = "";

		// FirstName
		$this->FirstName = new crField('Terminated_Employee', 'Terminated Employee', 'x_FirstName', 'FirstName', '`FirstName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['FirstName'] =& $this->FirstName;
		$this->FirstName->DateFilter = "";
		$this->FirstName->SqlSelect = "SELECT DISTINCT `FirstName` FROM " . $this->SqlFrom();
		$this->FirstName->SqlOrderBy = "`FirstName`";
		$this->FirstName->FldGroupByType = "";
		$this->FirstName->FldGroupInt = "0";
		$this->FirstName->FldGroupSql = "";

		// MiddelName
		$this->MiddelName = new crField('Terminated_Employee', 'Terminated Employee', 'x_MiddelName', 'MiddelName', '`MiddelName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['MiddelName'] =& $this->MiddelName;
		$this->MiddelName->DateFilter = "";
		$this->MiddelName->SqlSelect = "SELECT DISTINCT `MiddelName` FROM " . $this->SqlFrom();
		$this->MiddelName->SqlOrderBy = "`MiddelName`";
		$this->MiddelName->FldGroupByType = "";
		$this->MiddelName->FldGroupInt = "0";
		$this->MiddelName->FldGroupSql = "";

		// LastName
		$this->LastName = new crField('Terminated_Employee', 'Terminated Employee', 'x_LastName', 'LastName', '`LastName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['LastName'] =& $this->LastName;
		$this->LastName->DateFilter = "";
		$this->LastName->SqlSelect = "SELECT DISTINCT `LastName` FROM " . $this->SqlFrom();
		$this->LastName->SqlOrderBy = "`LastName`";
		$this->LastName->FldGroupByType = "";
		$this->LastName->FldGroupInt = "0";
		$this->LastName->FldGroupSql = "";

		// Department
		$this->Department = new crField('Terminated_Employee', 'Terminated Employee', 'x_Department', 'Department', '`Department`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->Department->GroupingFieldId = 1;
		$this->fields['Department'] =& $this->Department;
		$this->Department->DateFilter = "";
		$this->Department->SqlSelect = "SELECT DISTINCT `Department` FROM " . $this->SqlFrom();
		$this->Department->SqlOrderBy = "`Department`";
		$this->Department->FldGroupByType = "";
		$this->Department->FldGroupInt = "0";
		$this->Department->FldGroupSql = "";

		// Terminated_Date
		$this->Terminated_Date = new crField('Terminated_Employee', 'Terminated Employee', 'x_Terminated_Date', 'Terminated_Date', '`Terminated_Date`', 133, EWRPT_DATATYPE_DATE, 5);
		$this->Terminated_Date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateYMD"));
		$this->fields['Terminated_Date'] =& $this->Terminated_Date;
		$this->Terminated_Date->DateFilter = "";
		$this->Terminated_Date->SqlSelect = "SELECT DISTINCT `Terminated_Date` FROM " . $this->SqlFrom();
		$this->Terminated_Date->SqlOrderBy = "`Terminated_Date`";
		$this->Terminated_Date->FldGroupByType = "";
		$this->Terminated_Date->FldGroupInt = "0";
		$this->Terminated_Date->FldGroupSql = "";

		// Termination_Reason
		$this->Termination_Reason = new crField('Terminated_Employee', 'Terminated Employee', 'x_Termination_Reason', 'Termination_Reason', '`Termination_Reason`', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['Termination_Reason'] =& $this->Termination_Reason;
		$this->Termination_Reason->DateFilter = "";
		$this->Termination_Reason->SqlSelect = "";
		$this->Termination_Reason->SqlOrderBy = "";
		$this->Termination_Reason->FldGroupByType = "";
		$this->Termination_Reason->FldGroupInt = "0";
		$this->Termination_Reason->FldGroupSql = "";

		// Terminated Employee Per Department
		$this->Terminated_Employee_Per_Department = new crChart('Terminated_Employee', 'Terminated Employee', 'Terminated_Employee_Per_Department', 'Terminated Employee Per Department', 'Department', 'ID', '', 6, 'COUNT', 1000, 700);
		$this->Terminated_Employee_Per_Department->SqlSelect = "SELECT `Department`, '', COUNT(`ID`) FROM ";
		$this->Terminated_Employee_Per_Department->SqlGroupBy = "`Department`";
		$this->Terminated_Employee_Per_Department->SqlOrderBy = "`Department` ASC";
		$this->Terminated_Employee_Per_Department->SeriesDateType = "";
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
		return "`terminated_employee`";
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
$Terminated_Employee_summary = new crTerminated_Employee_summary();
$Page =& $Terminated_Employee_summary;

// Page init
$Terminated_Employee_summary->Page_Init();

// Page main
$Terminated_Employee_summary->Page_Main();
?>
<?php include "phprptinc/header.php"; ?>
<?php if ($Terminated_Employee->Export == "") { ?>
<script type="text/javascript">

// Create page object
var Terminated_Employee_summary = new ewrpt_Page("Terminated_Employee_summary");

// page properties
Terminated_Employee_summary.PageID = "summary"; // page ID
Terminated_Employee_summary.FormID = "fTerminated_Employeesummaryfilter"; // form ID
var EWRPT_PAGE_ID = Terminated_Employee_summary.PageID;

// extend page with ValidateForm function
Terminated_Employee_summary.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var elm = fobj.sv1_Terminated_Date;
	if (elm && !ewrpt_CheckDate(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Terminated_Employee->Terminated_Date->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv2_Terminated_Date;
	if (elm && !ewrpt_CheckDate(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Terminated_Employee->Terminated_Date->FldErrMsg()) ?>"))
			return false;
	}

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj)) return false;
	return true;
}

// extend page with Form_CustomValidate function
Terminated_Employee_summary.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EWRPT_CLIENT_VALIDATE) { ?>
Terminated_Employee_summary.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
Terminated_Employee_summary.ValidateRequired = false; // no JavaScript validation
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
<?php $Terminated_Employee_summary->ShowPageHeader(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php $Terminated_Employee_summary->ShowMessage(); ?>
<?php if ($Terminated_Employee->Export == "" || $Terminated_Employee->Export == "print" || $Terminated_Employee->Export == "email") { ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php } ?>
<?php if ($Terminated_Employee->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
<?php $jsdata = ewrpt_GetJsData($Terminated_Employee->Department, $Terminated_Employee->Department->FldType); ?>
ewrpt_CreatePopup("Terminated_Employee_Department", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Terminated_Employee->ID, $Terminated_Employee->ID->FldType); ?>
ewrpt_CreatePopup("Terminated_Employee_ID", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Terminated_Employee->FirstName, $Terminated_Employee->FirstName->FldType); ?>
ewrpt_CreatePopup("Terminated_Employee_FirstName", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Terminated_Employee->MiddelName, $Terminated_Employee->MiddelName->FldType); ?>
ewrpt_CreatePopup("Terminated_Employee_MiddelName", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Terminated_Employee->LastName, $Terminated_Employee->LastName->FldType); ?>
ewrpt_CreatePopup("Terminated_Employee_LastName", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Terminated_Employee->Terminated_Date, $Terminated_Employee->Terminated_Date->FldType); ?>
ewrpt_CreatePopup("Terminated_Employee_Terminated_Date", [<?php echo $jsdata ?>]);
</script>
<div id="Terminated_Employee_Department_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Terminated_Employee_ID_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Terminated_Employee_FirstName_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Terminated_Employee_MiddelName_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Terminated_Employee_LastName_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Terminated_Employee_Terminated_Date_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<?php } ?>
<?php if ($Terminated_Employee->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<?php if ($Terminated_Employee->Export == "" || $Terminated_Employee->Export == "print" || $Terminated_Employee->Export == "email") { ?>
<?php } ?>
<?php echo $Terminated_Employee->TableCaption() ?>
<?php if ($Terminated_Employee->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $Terminated_Employee_summary->ExportPrintUrl ?>"><?php echo $ReportLanguage->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $Terminated_Employee_summary->ExportExcelUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $Terminated_Employee_summary->ExportWordUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToWord") ?></a>
<?php if ($Terminated_Employee_summary->FilterApplied) { ?>
&nbsp;&nbsp;<a href="Terminated_Employeesmry.php?cmd=reset"><?php echo $ReportLanguage->Phrase("ResetAllFilter") ?></a>
<?php } ?>
<?php } ?>
<br /><br />
<?php if ($Terminated_Employee->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($Terminated_Employee->Export == "" || $Terminated_Employee->Export == "print" || $Terminated_Employee->Export == "email") { ?>
<?php } ?>
<?php if ($Terminated_Employee->Export == "") { ?>
	</div></td>
	<!-- Left Container (End) -->
	<!-- Center Container - Report (Begin) -->
	<td style="vertical-align: top;" class="ewPadding"><div id="ewCenter" class="phpreportmaker">
	<!-- center slot -->
<?php } ?>
<!-- summary report starts -->
<div id="report_summary">
<?php if ($Terminated_Employee->Export == "") { ?>
<?php
if ($Terminated_Employee->FilterPanelOption == 2 || ($Terminated_Employee->FilterPanelOption == 3 && $Terminated_Employee_summary->FilterApplied) || $Terminated_Employee_summary->Filter == "0=101") {
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
<form name="fTerminated_Employeesummaryfilter" id="fTerminated_Employeesummaryfilter" action="Terminated_Employeesmry.php" class="ewForm" onsubmit="return Terminated_Employee_summary.ValidateForm(this);">
<table class="ewRptExtFilter">
	<tr>
		<td><span class="phpreportmaker"><?php echo $Terminated_Employee->ID->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_ID" id="so1_ID" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_ID" id="sv1_ID" size="30" maxlength="7" value="<?php echo ewrpt_HtmlEncode($Terminated_Employee->ID->SearchValue) ?>"<?php echo ($Terminated_Employee_summary->ClearExtFilter == 'Terminated_Employee_ID') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Terminated_Employee->FirstName->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_FirstName" id="so1_FirstName" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_FirstName" id="sv1_FirstName" size="30" maxlength="20" value="<?php echo ewrpt_HtmlEncode($Terminated_Employee->FirstName->SearchValue) ?>"<?php echo ($Terminated_Employee_summary->ClearExtFilter == 'Terminated_Employee_FirstName') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Terminated_Employee->MiddelName->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_MiddelName" id="so1_MiddelName" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_MiddelName" id="sv1_MiddelName" size="30" maxlength="20" value="<?php echo ewrpt_HtmlEncode($Terminated_Employee->MiddelName->SearchValue) ?>"<?php echo ($Terminated_Employee_summary->ClearExtFilter == 'Terminated_Employee_MiddelName') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Terminated_Employee->LastName->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_LastName" id="so1_LastName" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_LastName" id="sv1_LastName" size="30" maxlength="20" value="<?php echo ewrpt_HtmlEncode($Terminated_Employee->LastName->SearchValue) ?>"<?php echo ($Terminated_Employee_summary->ClearExtFilter == 'Terminated_Employee_LastName') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Terminated_Employee->Department->FldCaption() ?></span></td>
		<td></td>
		<td colspan="4"><span class="ewRptSearchOpr">
		<select name="sv_Department" id="sv_Department"<?php echo ($Terminated_Employee_summary->ClearExtFilter == 'Terminated_Employee_Department') ? " class=\"ewInputCleared\"" : "" ?>>
		<option value="<?php echo EWRPT_ALL_VALUE; ?>"<?php if (ewrpt_MatchedFilterValue($Terminated_Employee->Department->DropDownValue, EWRPT_ALL_VALUE)) echo " selected=\"selected\""; ?>><?php echo $ReportLanguage->Phrase("PleaseSelect"); ?></option>
<?php

// Popup filter
$cntf = is_array($Terminated_Employee->Department->CustomFilters) ? count($Terminated_Employee->Department->CustomFilters) : 0;
$cntd = is_array($Terminated_Employee->Department->DropDownList) ? count($Terminated_Employee->Department->DropDownList) : 0;
$totcnt = $cntf + $cntd;
$wrkcnt = 0;
	for ($i = 0; $i < $cntf; $i++) {
		if ($Terminated_Employee->Department->CustomFilters[$i]->FldName == 'Department') {
?>
		<option value="<?php echo "@@" . $Terminated_Employee->Department->CustomFilters[$i]->FilterName ?>"<?php if (ewrpt_MatchedFilterValue($Terminated_Employee->Department->DropDownValue, "@@" . $Terminated_Employee->Department->CustomFilters[$i]->FilterName)) echo " selected=\"selected\"" ?>><?php echo $Terminated_Employee->Department->CustomFilters[$i]->DisplayName ?></option>
<?php
		}
		$wrkcnt += 1;
	}

//}
	for ($i = 0; $i < $cntd; $i++) {
?>
		<option value="<?php echo $Terminated_Employee->Department->DropDownList[$i] ?>"<?php if (ewrpt_MatchedFilterValue($Terminated_Employee->Department->DropDownValue, $Terminated_Employee->Department->DropDownList[$i])) echo " selected=\"selected\"" ?>><?php echo ewrpt_DropDownDisplayValue($Terminated_Employee->Department->DropDownList[$i], "", 0) ?></option>
<?php
		$wrkcnt += 1;
	}

//}
?>
		</select>
		</span></td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Terminated_Employee->Terminated_Date->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("BETWEEN"); ?><input type="hidden" name="so1_Terminated_Date" id="so1_Terminated_Date" value="BETWEEN"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_Terminated_Date" id="sv1_Terminated_Date" value="<?php echo ewrpt_HtmlEncode($Terminated_Employee->Terminated_Date->SearchValue) ?>"<?php echo ($Terminated_Employee_summary->ClearExtFilter == 'Terminated_Employee_Terminated_Date') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
				<td><span class="ewRptSearchOpr" id="btw1_Terminated_Date" name="btw1_Terminated_Date">&nbsp;<?php echo $ReportLanguage->Phrase("AND") ?>&nbsp;</span></td>
				<td><span class="phpreportmaker" id="btw1_Terminated_Date" name="btw1_Terminated_Date">
<input type="text" name="sv2_Terminated_Date" id="sv2_Terminated_Date" value="<?php echo ewrpt_HtmlEncode($Terminated_Employee->Terminated_Date->SearchValue2) ?>"<?php echo ($Terminated_Employee_summary->ClearExtFilter == 'Terminated_Employee_Terminated_Date') ? " class=\"ewInputCleared\"" : "" ?>>
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
<!-- Search form (end) -->
</div>
<br />
<?php } ?>
<?php if ($Terminated_Employee->ShowCurrentFilter) { ?>
<div id="ewrptFilterList">
<?php $Terminated_Employee_summary->ShowFilterList() ?>
</div>
<br />
<?php } ?>
<table class="ewGrid" cellspacing="0"><tr>
	<td class="ewGridContent">
<?php if ($Terminated_Employee->Export == "") { ?>
<div class="ewGridUpperPanel">
<form action="Terminated_Employeesmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($Terminated_Employee_summary->StartGrp, $Terminated_Employee_summary->DisplayGrps, $Terminated_Employee_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="Terminated_Employeesmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="Terminated_Employeesmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="Terminated_Employeesmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="Terminated_Employeesmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($Terminated_Employee_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($Terminated_Employee_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($Terminated_Employee_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($Terminated_Employee_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($Terminated_Employee_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($Terminated_Employee_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($Terminated_Employee_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($Terminated_Employee_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($Terminated_Employee_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($Terminated_Employee_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($Terminated_Employee->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
if ($Terminated_Employee->ExportAll && $Terminated_Employee->Export <> "") {
	$Terminated_Employee_summary->StopGrp = $Terminated_Employee_summary->TotalGrps;
} else {
	$Terminated_Employee_summary->StopGrp = $Terminated_Employee_summary->StartGrp + $Terminated_Employee_summary->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($Terminated_Employee_summary->StopGrp) > intval($Terminated_Employee_summary->TotalGrps))
	$Terminated_Employee_summary->StopGrp = $Terminated_Employee_summary->TotalGrps;
$Terminated_Employee_summary->RecCount = 0;

// Get first row
if ($Terminated_Employee_summary->TotalGrps > 0) {
	$Terminated_Employee_summary->GetGrpRow(1);
	$Terminated_Employee_summary->GrpCount = 1;
}
while (($rsgrp && !$rsgrp->EOF && $Terminated_Employee_summary->GrpCount <= $Terminated_Employee_summary->DisplayGrps) || $Terminated_Employee_summary->ShowFirstHeader) {

	// Show header
	if ($Terminated_Employee_summary->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Terminated_Employee->SortUrl($Terminated_Employee->Department) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Terminated_Employee->Department->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Terminated_Employee->SortUrl($Terminated_Employee->Department) ?>',0);"><?php echo $Terminated_Employee->Department->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Terminated_Employee->Department->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Terminated_Employee->Department->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Terminated_Employee->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Terminated_Employee_Department', false, '<?php echo $Terminated_Employee->Department->RangeFrom; ?>', '<?php echo $Terminated_Employee->Department->RangeTo; ?>');return false;" name="x_Department<?php echo $Terminated_Employee_summary->Cnt[0][0]; ?>" id="x_Department<?php echo $Terminated_Employee_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Terminated_Employee->SortUrl($Terminated_Employee->ID) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Terminated_Employee->ID->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Terminated_Employee->SortUrl($Terminated_Employee->ID) ?>',0);"><?php echo $Terminated_Employee->ID->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Terminated_Employee->ID->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Terminated_Employee->ID->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Terminated_Employee->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Terminated_Employee_ID', false, '<?php echo $Terminated_Employee->ID->RangeFrom; ?>', '<?php echo $Terminated_Employee->ID->RangeTo; ?>');return false;" name="x_ID<?php echo $Terminated_Employee_summary->Cnt[0][0]; ?>" id="x_ID<?php echo $Terminated_Employee_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Terminated_Employee->SortUrl($Terminated_Employee->FirstName) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Terminated_Employee->FirstName->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Terminated_Employee->SortUrl($Terminated_Employee->FirstName) ?>',0);"><?php echo $Terminated_Employee->FirstName->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Terminated_Employee->FirstName->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Terminated_Employee->FirstName->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Terminated_Employee->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Terminated_Employee_FirstName', false, '<?php echo $Terminated_Employee->FirstName->RangeFrom; ?>', '<?php echo $Terminated_Employee->FirstName->RangeTo; ?>');return false;" name="x_FirstName<?php echo $Terminated_Employee_summary->Cnt[0][0]; ?>" id="x_FirstName<?php echo $Terminated_Employee_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Terminated_Employee->SortUrl($Terminated_Employee->MiddelName) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Terminated_Employee->MiddelName->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Terminated_Employee->SortUrl($Terminated_Employee->MiddelName) ?>',0);"><?php echo $Terminated_Employee->MiddelName->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Terminated_Employee->MiddelName->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Terminated_Employee->MiddelName->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Terminated_Employee->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Terminated_Employee_MiddelName', false, '<?php echo $Terminated_Employee->MiddelName->RangeFrom; ?>', '<?php echo $Terminated_Employee->MiddelName->RangeTo; ?>');return false;" name="x_MiddelName<?php echo $Terminated_Employee_summary->Cnt[0][0]; ?>" id="x_MiddelName<?php echo $Terminated_Employee_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Terminated_Employee->SortUrl($Terminated_Employee->LastName) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Terminated_Employee->LastName->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Terminated_Employee->SortUrl($Terminated_Employee->LastName) ?>',0);"><?php echo $Terminated_Employee->LastName->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Terminated_Employee->LastName->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Terminated_Employee->LastName->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Terminated_Employee->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Terminated_Employee_LastName', false, '<?php echo $Terminated_Employee->LastName->RangeFrom; ?>', '<?php echo $Terminated_Employee->LastName->RangeTo; ?>');return false;" name="x_LastName<?php echo $Terminated_Employee_summary->Cnt[0][0]; ?>" id="x_LastName<?php echo $Terminated_Employee_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Terminated_Employee->SortUrl($Terminated_Employee->Terminated_Date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Terminated_Employee->Terminated_Date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Terminated_Employee->SortUrl($Terminated_Employee->Terminated_Date) ?>',0);"><?php echo $Terminated_Employee->Terminated_Date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Terminated_Employee->Terminated_Date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Terminated_Employee->Terminated_Date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Terminated_Employee->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Terminated_Employee_Terminated_Date', false, '<?php echo $Terminated_Employee->Terminated_Date->RangeFrom; ?>', '<?php echo $Terminated_Employee->Terminated_Date->RangeTo; ?>');return false;" name="x_Terminated_Date<?php echo $Terminated_Employee_summary->Cnt[0][0]; ?>" id="x_Terminated_Date<?php echo $Terminated_Employee_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Terminated_Employee->SortUrl($Terminated_Employee->Termination_Reason) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Terminated_Employee->Termination_Reason->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Terminated_Employee->SortUrl($Terminated_Employee->Termination_Reason) ?>',0);"><?php echo $Terminated_Employee->Termination_Reason->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Terminated_Employee->Termination_Reason->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Terminated_Employee->Termination_Reason->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$Terminated_Employee_summary->ShowFirstHeader = FALSE;
	}

	// Build detail SQL
	$sWhere = ewrpt_DetailFilterSQL($Terminated_Employee->Department, $Terminated_Employee->SqlFirstGroupField(), $Terminated_Employee->Department->GroupValue());
	if ($Terminated_Employee_summary->Filter != "")
		$sWhere = "($Terminated_Employee_summary->Filter) AND ($sWhere)";
	$sSql = ewrpt_BuildReportSql($Terminated_Employee->SqlSelect(), $Terminated_Employee->SqlWhere(), $Terminated_Employee->SqlGroupBy(), $Terminated_Employee->SqlHaving(), $Terminated_Employee->SqlOrderBy(), $sWhere, $Terminated_Employee_summary->Sort);
	$rs = $conn->Execute($sSql);
	$rsdtlcnt = ($rs) ? $rs->RecordCount() : 0;
	if ($rsdtlcnt > 0)
		$Terminated_Employee_summary->GetRow(1);
	while ($rs && !$rs->EOF) { // Loop detail records
		$Terminated_Employee_summary->RecCount++;

		// Render detail row
		$Terminated_Employee->ResetCSS();
		$Terminated_Employee->RowType = EWRPT_ROWTYPE_DETAIL;
		$Terminated_Employee_summary->RenderRow();
?>
	<tr<?php echo $Terminated_Employee->RowAttributes(); ?>>
		<td<?php echo $Terminated_Employee->Department->CellAttributes(); ?>><div<?php echo $Terminated_Employee->Department->ViewAttributes(); ?>><?php echo $Terminated_Employee->Department->GroupViewValue; ?></div></td>
		<td<?php echo $Terminated_Employee->ID->CellAttributes() ?>>
<div<?php echo $Terminated_Employee->ID->ViewAttributes(); ?>><?php echo $Terminated_Employee->ID->ListViewValue(); ?></div>
</td>
		<td<?php echo $Terminated_Employee->FirstName->CellAttributes() ?>>
<div<?php echo $Terminated_Employee->FirstName->ViewAttributes(); ?>><?php echo $Terminated_Employee->FirstName->ListViewValue(); ?></div>
</td>
		<td<?php echo $Terminated_Employee->MiddelName->CellAttributes() ?>>
<div<?php echo $Terminated_Employee->MiddelName->ViewAttributes(); ?>><?php echo $Terminated_Employee->MiddelName->ListViewValue(); ?></div>
</td>
		<td<?php echo $Terminated_Employee->LastName->CellAttributes() ?>>
<div<?php echo $Terminated_Employee->LastName->ViewAttributes(); ?>><?php echo $Terminated_Employee->LastName->ListViewValue(); ?></div>
</td>
		<td<?php echo $Terminated_Employee->Terminated_Date->CellAttributes() ?>>
<div<?php echo $Terminated_Employee->Terminated_Date->ViewAttributes(); ?>><?php echo $Terminated_Employee->Terminated_Date->ListViewValue(); ?></div>
</td>
		<td<?php echo $Terminated_Employee->Termination_Reason->CellAttributes() ?>>
<div<?php echo $Terminated_Employee->Termination_Reason->ViewAttributes(); ?>><?php echo $Terminated_Employee->Termination_Reason->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$Terminated_Employee_summary->AccumulateSummary();

		// Get next record
		$Terminated_Employee_summary->GetRow(2);

		// Show Footers
?>
<?php
	} // End detail records loop
?>
<?php
			$Terminated_Employee->ResetCSS();
			$Terminated_Employee->RowType = EWRPT_ROWTYPE_TOTAL;
			$Terminated_Employee->RowTotalType = EWRPT_ROWTOTAL_GROUP;
			$Terminated_Employee->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
			$Terminated_Employee->RowGroupLevel = 1;
			$Terminated_Employee_summary->RenderRow();
?>
	<tr<?php echo $Terminated_Employee->RowAttributes(); ?>>
		<td colspan="7"<?php echo $Terminated_Employee->Department->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSumHead") ?> <?php echo $Terminated_Employee->Department->FldCaption() ?>: <?php echo $Terminated_Employee->Department->GroupViewValue; ?> (<?php echo ewrpt_FormatNumber($Terminated_Employee_summary->Cnt[1][0],0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php

			// Reset level 1 summary
			$Terminated_Employee_summary->ResetLevelSummary(1);
?>
<?php

	// Next group
	$Terminated_Employee_summary->GetGrpRow(2);
	$Terminated_Employee_summary->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
<?php if (intval(@$Terminated_Employee_summary->Cnt[0][6]) > 0) { ?>
<?php
	$Terminated_Employee->ResetCSS();
	$Terminated_Employee->RowType = EWRPT_ROWTYPE_TOTAL;
	$Terminated_Employee->RowTotalType = EWRPT_ROWTOTAL_PAGE;
	$Terminated_Employee->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
	$Terminated_Employee->RowAttrs["class"] = "ewRptPageSummary";
	$Terminated_Employee_summary->RenderRow();
?>
	<tr<?php echo $Terminated_Employee->RowAttributes(); ?>><td colspan="7"><?php echo $ReportLanguage->Phrase("RptPageTotal") ?> (<?php echo ewrpt_FormatNumber($Terminated_Employee_summary->Cnt[0][6],0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
	<!-- tr class="ewRptPageSummary"><td colspan="7"><span class="phpreportmaker">&nbsp;<br /></span></td></tr -->
<?php } ?>
<?php
if ($Terminated_Employee_summary->TotalGrps > 0) {
	$Terminated_Employee->ResetCSS();
	$Terminated_Employee->RowType = EWRPT_ROWTYPE_TOTAL;
	$Terminated_Employee->RowTotalType = EWRPT_ROWTOTAL_GRAND;
	$Terminated_Employee->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
	$Terminated_Employee->RowAttrs["class"] = "ewRptGrandSummary";
	$Terminated_Employee_summary->RenderRow();
?>
	<!-- tr><td colspan="7"><span class="phpreportmaker">&nbsp;<br /></span></td></tr -->
	<tr<?php echo $Terminated_Employee->RowAttributes(); ?>><td colspan="7"><?php echo $ReportLanguage->Phrase("RptGrandTotal") ?> (<?php echo ewrpt_FormatNumber($Terminated_Employee_summary->TotCount,0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php } ?>
	</tfoot>
</table>
</div>
<?php if ($Terminated_Employee_summary->TotalGrps > 0) { ?>
<?php if ($Terminated_Employee->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="Terminated_Employeesmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($Terminated_Employee_summary->StartGrp, $Terminated_Employee_summary->DisplayGrps, $Terminated_Employee_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="Terminated_Employeesmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="Terminated_Employeesmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="Terminated_Employeesmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="Terminated_Employeesmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($Terminated_Employee_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($Terminated_Employee_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($Terminated_Employee_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($Terminated_Employee_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($Terminated_Employee_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($Terminated_Employee_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($Terminated_Employee_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($Terminated_Employee_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($Terminated_Employee_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($Terminated_Employee_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($Terminated_Employee->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php if ($Terminated_Employee->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($Terminated_Employee->Export == "" || $Terminated_Employee->Export == "print" || $Terminated_Employee->Export == "email") { ?>
<?php } ?>
<?php if ($Terminated_Employee->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3" class="ewPadding"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($Terminated_Employee->Export == "" || $Terminated_Employee->Export == "print" || $Terminated_Employee->Export == "email") { ?>
<a name="cht_Terminated_Employee_Per_Department"></a>
<div id="div_Terminated_Employee_Terminated_Employee_Per_Department"></div>
<?php

// Initialize chart data
$Terminated_Employee->Terminated_Employee_Per_Department->ID = "Terminated_Employee_Terminated_Employee_Per_Department"; // Chart ID
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("type", "6", FALSE); // Chart type
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("seriestype", "0", FALSE); // Chart series type
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("bgcolor", "#FCFCFC", TRUE); // Background color
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("caption", $Terminated_Employee->Terminated_Employee_Per_Department->ChartCaption(), TRUE); // Chart caption
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("xaxisname", $Terminated_Employee->Terminated_Employee_Per_Department->ChartXAxisName(), TRUE); // X axis name
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("yaxisname", $Terminated_Employee->Terminated_Employee_Per_Department->ChartYAxisName(), TRUE); // Y axis name
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("shownames", "1", TRUE); // Show names
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("showvalues", "1", TRUE); // Show values
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("showhovercap", "0", TRUE); // Show hover
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("alpha", "50", FALSE); // Chart alpha
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("colorpalette", "#FF0000|#FF0080|#FF00FF|#8000FF|#FF8000|#FF3D3D|#7AFFFF|#0000FF|#FFFF00|#FF7A7A|#3DFFFF|#0080FF|#80FF00|#00FF00|#00FF80|#00FFFF", FALSE); // Chart color palette
?>
<?php
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("showCanvasBg", "1", TRUE); // showCanvasBg
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("showCanvasBase", "1", TRUE); // showCanvasBase
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("showLimits", "1", TRUE); // showLimits
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("animation", "1", TRUE); // animation
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("rotateNames", "0", TRUE); // rotateNames
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("yAxisMinValue", "0", TRUE); // yAxisMinValue
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("yAxisMaxValue", "0", TRUE); // yAxisMaxValue
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("PYAxisMinValue", "0", TRUE); // PYAxisMinValue
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("PYAxisMaxValue", "0", TRUE); // PYAxisMaxValue
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("SYAxisMinValue", "0", TRUE); // SYAxisMinValue
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("SYAxisMaxValue", "0", TRUE); // SYAxisMaxValue
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("showColumnShadow", "0", TRUE); // showColumnShadow
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("showPercentageValues", "1", TRUE); // showPercentageValues
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("showPercentageInLabel", "1", TRUE); // showPercentageInLabel
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("showBarShadow", "0", TRUE); // showBarShadow
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("showAnchors", "1", TRUE); // showAnchors
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("showAreaBorder", "1", TRUE); // showAreaBorder
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("isSliced", "1", TRUE); // isSliced
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("showAsBars", "0", TRUE); // showAsBars
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("showShadow", "0", TRUE); // showShadow
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("formatNumber", "0", TRUE); // formatNumber
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("formatNumberScale", "0", TRUE); // formatNumberScale
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("decimalSeparator", ".", TRUE); // decimalSeparator
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("thousandSeparator", ",", TRUE); // thousandSeparator
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("decimalPrecision", "2", TRUE); // decimalPrecision
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("divLineDecimalPrecision", "2", TRUE); // divLineDecimalPrecision
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("limitsDecimalPrecision", "2", TRUE); // limitsDecimalPrecision
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("zeroPlaneShowBorder", "1", TRUE); // zeroPlaneShowBorder
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("showDivLineValue", "1", TRUE); // showDivLineValue
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("showAlternateHGridColor", "0", TRUE); // showAlternateHGridColor
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("showAlternateVGridColor", "0", TRUE); // showAlternateVGridColor
$Terminated_Employee->Terminated_Employee_Per_Department->SetChartParam("hoverCapSepChar", ":", TRUE); // hoverCapSepChar

// Define trend lines
?>
<?php
$SqlSelect = $Terminated_Employee->SqlSelect();
$SqlChartSelect = $Terminated_Employee->Terminated_Employee_Per_Department->SqlSelect;
$sSqlChartBase = $Terminated_Employee->SqlFrom();

// Load chart data from sql directly
$sSql = $SqlChartSelect . $sSqlChartBase;
$sSql = ewrpt_BuildReportSql($sSql, $Terminated_Employee->SqlWhere(), $Terminated_Employee->Terminated_Employee_Per_Department->SqlGroupBy, "", $Terminated_Employee->Terminated_Employee_Per_Department->SqlOrderBy, $Terminated_Employee_summary->Filter, "");
if (EWRPT_DEBUG_ENABLED) echo "(Chart SQL): " . $sSql . "<br>";
ewrpt_LoadChartData($sSql, $Terminated_Employee->Terminated_Employee_Per_Department);
ewrpt_SortChartData($Terminated_Employee->Terminated_Employee_Per_Department->Data, 1, "");

// Call Chart_Rendering event
$Terminated_Employee->Chart_Rendering($Terminated_Employee->Terminated_Employee_Per_Department);
$chartxml = $Terminated_Employee->Terminated_Employee_Per_Department->ChartXml();

// Call Chart_Rendered event
$Terminated_Employee->Chart_Rendered($Terminated_Employee->Terminated_Employee_Per_Department, $chartxml);
echo $Terminated_Employee->Terminated_Employee_Per_Department->ShowChartFCF($chartxml);
?>
<a href="#top"><?php echo $ReportLanguage->Phrase("Top") ?></a>
<br /><br />
<?php } ?>
<?php if ($Terminated_Employee->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $Terminated_Employee_summary->ShowPageFooter(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($Terminated_Employee->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "phprptinc/footer.php"; ?>
<?php
$Terminated_Employee_summary->Page_Terminate();
?>
<?php

//
// Page class
//
class crTerminated_Employee_summary {

	// Page ID
	var $PageID = 'summary';

	// Table name
	var $TableName = 'Terminated Employee';

	// Page object name
	var $PageObjName = 'Terminated_Employee_summary';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $Terminated_Employee;
		if ($Terminated_Employee->UseTokenInUrl) $PageUrl .= "t=" . $Terminated_Employee->TableVar . "&"; // Add page token
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
		global $Terminated_Employee;
		if ($Terminated_Employee->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($Terminated_Employee->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($Terminated_Employee->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crTerminated_Employee_summary() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (Terminated_Employee)
		$GLOBALS["Terminated_Employee"] = new crTerminated_Employee();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'summary', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'Terminated Employee', TRUE);

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
		global $Terminated_Employee;

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$Terminated_Employee->Export = $_GET["export"];
	}
	$gsExport = $Terminated_Employee->Export; // Get export parameter, used in header
	$gsExportFile = $Terminated_Employee->TableVar; // Get export file, used in header
	if ($Terminated_Employee->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($Terminated_Employee->Export == "word") {
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
		global $Terminated_Employee;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($Terminated_Employee->Export == "email") {
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
		global $Terminated_Employee;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 7;
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
		$this->Col = array(FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE);

		// Set up groups per page dynamically
		$this->SetUpDisplayGrps();
		$Terminated_Employee->Department->SelectionList = "";
		$Terminated_Employee->Department->DefaultSelectionList = "";
		$Terminated_Employee->Department->ValueList = "";
		$Terminated_Employee->ID->SelectionList = "";
		$Terminated_Employee->ID->DefaultSelectionList = "";
		$Terminated_Employee->ID->ValueList = "";
		$Terminated_Employee->FirstName->SelectionList = "";
		$Terminated_Employee->FirstName->DefaultSelectionList = "";
		$Terminated_Employee->FirstName->ValueList = "";
		$Terminated_Employee->MiddelName->SelectionList = "";
		$Terminated_Employee->MiddelName->DefaultSelectionList = "";
		$Terminated_Employee->MiddelName->ValueList = "";
		$Terminated_Employee->LastName->SelectionList = "";
		$Terminated_Employee->LastName->DefaultSelectionList = "";
		$Terminated_Employee->LastName->ValueList = "";
		$Terminated_Employee->Terminated_Date->SelectionList = "";
		$Terminated_Employee->Terminated_Date->DefaultSelectionList = "";
		$Terminated_Employee->Terminated_Date->ValueList = "";

		// Load default filter values
		$this->LoadDefaultFilters();

		// Set up popup filter
		$this->SetupPopup();

		// Extended filter
		$sExtendedFilter = "";

		// Get dropdown values
		$this->GetExtendedFilterValues();

		// Load custom filters
		$Terminated_Employee->CustomFilters_Load();

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
		$sGrpSort = ewrpt_UpdateSortFields($Terminated_Employee->SqlOrderByGroup(), $this->Sort, 2); // Get grouping field only
		$sSql = ewrpt_BuildReportSql($Terminated_Employee->SqlSelectGroup(), $Terminated_Employee->SqlWhere(), $Terminated_Employee->SqlGroupBy(), $Terminated_Employee->SqlHaving(), $Terminated_Employee->SqlOrderByGroup(), $this->Filter, $sGrpSort);
		$this->TotalGrps = $this->GetGrpCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($Terminated_Employee->ExportAll && $Terminated_Employee->Export <> "")
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
		global $Terminated_Employee;
		switch ($lvl) {
			case 1:
				return (is_null($Terminated_Employee->Department->CurrentValue) && !is_null($Terminated_Employee->Department->OldValue)) ||
					(!is_null($Terminated_Employee->Department->CurrentValue) && is_null($Terminated_Employee->Department->OldValue)) ||
					($Terminated_Employee->Department->GroupValue() <> $Terminated_Employee->Department->GroupOldValue());
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
		global $Terminated_Employee;
		$rsgrpcnt = $conn->Execute($sql);
		$grpcnt = ($rsgrpcnt) ? $rsgrpcnt->RecordCount() : 0;
		if ($rsgrpcnt) $rsgrpcnt->Close();
		return $grpcnt;
	}

	// Get group rs
	function GetGrpRs($sql, $start, $grps) {
		global $conn;
		global $Terminated_Employee;
		$wrksql = $sql;
		if ($start > 0 && $grps > -1)
			$wrksql .= " LIMIT " . ($start-1) . ", " . ($grps);
		$rswrk = $conn->Execute($wrksql);
		return $rswrk;
	}

	// Get group row values
	function GetGrpRow($opt) {
		global $rsgrp;
		global $Terminated_Employee;
		if (!$rsgrp)
			return;
		if ($opt == 1) { // Get first group

			//$rsgrp->MoveFirst(); // NOTE: no need to move position
			$Terminated_Employee->Department->setDbValue(""); // Init first value
		} else { // Get next group
			$rsgrp->MoveNext();
		}
		if (!$rsgrp->EOF)
			$Terminated_Employee->Department->setDbValue($rsgrp->fields('Department'));
		if ($rsgrp->EOF) {
			$Terminated_Employee->Department->setDbValue("");
		}
	}

	// Get row values
	function GetRow($opt) {
		global $rs;
		global $Terminated_Employee;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$Terminated_Employee->Auto_ID->setDbValue($rs->fields('Auto_ID'));
			$Terminated_Employee->ID->setDbValue($rs->fields('ID'));
			$Terminated_Employee->FirstName->setDbValue($rs->fields('FirstName'));
			$Terminated_Employee->MiddelName->setDbValue($rs->fields('MiddelName'));
			$Terminated_Employee->LastName->setDbValue($rs->fields('LastName'));
			if ($opt <> 1)
				$Terminated_Employee->Department->setDbValue($rs->fields('Department'));
			$Terminated_Employee->Terminated_Date->setDbValue($rs->fields('Terminated_Date'));
			$Terminated_Employee->Termination_Reason->setDbValue($rs->fields('Termination_Reason'));
			$this->Val[1] = $Terminated_Employee->ID->CurrentValue;
			$this->Val[2] = $Terminated_Employee->FirstName->CurrentValue;
			$this->Val[3] = $Terminated_Employee->MiddelName->CurrentValue;
			$this->Val[4] = $Terminated_Employee->LastName->CurrentValue;
			$this->Val[5] = $Terminated_Employee->Terminated_Date->CurrentValue;
			$this->Val[6] = $Terminated_Employee->Termination_Reason->CurrentValue;
		} else {
			$Terminated_Employee->Auto_ID->setDbValue("");
			$Terminated_Employee->ID->setDbValue("");
			$Terminated_Employee->FirstName->setDbValue("");
			$Terminated_Employee->MiddelName->setDbValue("");
			$Terminated_Employee->LastName->setDbValue("");
			$Terminated_Employee->Department->setDbValue("");
			$Terminated_Employee->Terminated_Date->setDbValue("");
			$Terminated_Employee->Termination_Reason->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $Terminated_Employee;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$Terminated_Employee->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$Terminated_Employee->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $Terminated_Employee->getStartGroup();
			}
		} else {
			$this->StartGrp = $Terminated_Employee->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$Terminated_Employee->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$Terminated_Employee->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$Terminated_Employee->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $Terminated_Employee;

		// Initialize popup
		// Build distinct values for Department

		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Terminated_Employee->Department->SqlSelect, $Terminated_Employee->SqlWhere(), $Terminated_Employee->SqlGroupBy(), $Terminated_Employee->SqlHaving(), $Terminated_Employee->Department->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Terminated_Employee->Department->setDbValue($rswrk->fields[0]);
			if (is_null($Terminated_Employee->Department->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Terminated_Employee->Department->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Terminated_Employee->Department->GroupViewValue = ewrpt_DisplayGroupValue($Terminated_Employee->Department,$Terminated_Employee->Department->GroupValue());
				ewrpt_SetupDistinctValues($Terminated_Employee->Department->ValueList, $Terminated_Employee->Department->GroupValue(), $Terminated_Employee->Department->GroupViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Terminated_Employee->Department->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Terminated_Employee->Department->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for ID
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Terminated_Employee->ID->SqlSelect, $Terminated_Employee->SqlWhere(), $Terminated_Employee->SqlGroupBy(), $Terminated_Employee->SqlHaving(), $Terminated_Employee->ID->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Terminated_Employee->ID->setDbValue($rswrk->fields[0]);
			if (is_null($Terminated_Employee->ID->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Terminated_Employee->ID->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Terminated_Employee->ID->ViewValue = $Terminated_Employee->ID->CurrentValue;
				ewrpt_SetupDistinctValues($Terminated_Employee->ID->ValueList, $Terminated_Employee->ID->CurrentValue, $Terminated_Employee->ID->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Terminated_Employee->ID->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Terminated_Employee->ID->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for FirstName
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Terminated_Employee->FirstName->SqlSelect, $Terminated_Employee->SqlWhere(), $Terminated_Employee->SqlGroupBy(), $Terminated_Employee->SqlHaving(), $Terminated_Employee->FirstName->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Terminated_Employee->FirstName->setDbValue($rswrk->fields[0]);
			if (is_null($Terminated_Employee->FirstName->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Terminated_Employee->FirstName->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Terminated_Employee->FirstName->ViewValue = $Terminated_Employee->FirstName->CurrentValue;
				ewrpt_SetupDistinctValues($Terminated_Employee->FirstName->ValueList, $Terminated_Employee->FirstName->CurrentValue, $Terminated_Employee->FirstName->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Terminated_Employee->FirstName->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Terminated_Employee->FirstName->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for MiddelName
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Terminated_Employee->MiddelName->SqlSelect, $Terminated_Employee->SqlWhere(), $Terminated_Employee->SqlGroupBy(), $Terminated_Employee->SqlHaving(), $Terminated_Employee->MiddelName->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Terminated_Employee->MiddelName->setDbValue($rswrk->fields[0]);
			if (is_null($Terminated_Employee->MiddelName->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Terminated_Employee->MiddelName->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Terminated_Employee->MiddelName->ViewValue = $Terminated_Employee->MiddelName->CurrentValue;
				ewrpt_SetupDistinctValues($Terminated_Employee->MiddelName->ValueList, $Terminated_Employee->MiddelName->CurrentValue, $Terminated_Employee->MiddelName->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Terminated_Employee->MiddelName->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Terminated_Employee->MiddelName->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for LastName
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Terminated_Employee->LastName->SqlSelect, $Terminated_Employee->SqlWhere(), $Terminated_Employee->SqlGroupBy(), $Terminated_Employee->SqlHaving(), $Terminated_Employee->LastName->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Terminated_Employee->LastName->setDbValue($rswrk->fields[0]);
			if (is_null($Terminated_Employee->LastName->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Terminated_Employee->LastName->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Terminated_Employee->LastName->ViewValue = $Terminated_Employee->LastName->CurrentValue;
				ewrpt_SetupDistinctValues($Terminated_Employee->LastName->ValueList, $Terminated_Employee->LastName->CurrentValue, $Terminated_Employee->LastName->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Terminated_Employee->LastName->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Terminated_Employee->LastName->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for Terminated_Date
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Terminated_Employee->Terminated_Date->SqlSelect, $Terminated_Employee->SqlWhere(), $Terminated_Employee->SqlGroupBy(), $Terminated_Employee->SqlHaving(), $Terminated_Employee->Terminated_Date->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Terminated_Employee->Terminated_Date->setDbValue($rswrk->fields[0]);
			if (is_null($Terminated_Employee->Terminated_Date->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Terminated_Employee->Terminated_Date->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Terminated_Employee->Terminated_Date->ViewValue = ewrpt_FormatDateTime($Terminated_Employee->Terminated_Date->CurrentValue, 5);
				ewrpt_SetupDistinctValues($Terminated_Employee->Terminated_Date->ValueList, $Terminated_Employee->Terminated_Date->CurrentValue, $Terminated_Employee->Terminated_Date->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Terminated_Employee->Terminated_Date->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Terminated_Employee->Terminated_Date->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

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
				$this->ClearSessionSelection('LastName');
				$this->ClearSessionSelection('Terminated_Date');
				$this->ResetPager();
			}
		}

		// Load selection criteria to array
		// Get Department selected values

		if (is_array(@$_SESSION["sel_Terminated_Employee_Department"])) {
			$this->LoadSelectionFromSession('Department');
		} elseif (@$_SESSION["sel_Terminated_Employee_Department"] == EWRPT_INIT_VALUE) { // Select all
			$Terminated_Employee->Department->SelectionList = "";
		}

		// Get ID selected values
		if (is_array(@$_SESSION["sel_Terminated_Employee_ID"])) {
			$this->LoadSelectionFromSession('ID');
		} elseif (@$_SESSION["sel_Terminated_Employee_ID"] == EWRPT_INIT_VALUE) { // Select all
			$Terminated_Employee->ID->SelectionList = "";
		}

		// Get First Name selected values
		if (is_array(@$_SESSION["sel_Terminated_Employee_FirstName"])) {
			$this->LoadSelectionFromSession('FirstName');
		} elseif (@$_SESSION["sel_Terminated_Employee_FirstName"] == EWRPT_INIT_VALUE) { // Select all
			$Terminated_Employee->FirstName->SelectionList = "";
		}

		// Get Middel Name selected values
		if (is_array(@$_SESSION["sel_Terminated_Employee_MiddelName"])) {
			$this->LoadSelectionFromSession('MiddelName');
		} elseif (@$_SESSION["sel_Terminated_Employee_MiddelName"] == EWRPT_INIT_VALUE) { // Select all
			$Terminated_Employee->MiddelName->SelectionList = "";
		}

		// Get Last Name selected values
		if (is_array(@$_SESSION["sel_Terminated_Employee_LastName"])) {
			$this->LoadSelectionFromSession('LastName');
		} elseif (@$_SESSION["sel_Terminated_Employee_LastName"] == EWRPT_INIT_VALUE) { // Select all
			$Terminated_Employee->LastName->SelectionList = "";
		}

		// Get Terminated Date selected values
		if (is_array(@$_SESSION["sel_Terminated_Employee_Terminated_Date"])) {
			$this->LoadSelectionFromSession('Terminated_Date');
		} elseif (@$_SESSION["sel_Terminated_Employee_Terminated_Date"] == EWRPT_INIT_VALUE) { // Select all
			$Terminated_Employee->Terminated_Date->SelectionList = "";
		}
	}

	// Reset pager
	function ResetPager() {

		// Reset start position (reset command)
		global $Terminated_Employee;
		$this->StartGrp = 1;
		$Terminated_Employee->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $Terminated_Employee;
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
			$Terminated_Employee->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$Terminated_Employee->setStartGroup($this->StartGrp);
		} else {
			if ($Terminated_Employee->getGroupPerPage() <> "") {
				$this->DisplayGrps = $Terminated_Employee->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $Security;
		global $Terminated_Employee;
		if ($Terminated_Employee->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($Terminated_Employee->SqlSelectCount(), $Terminated_Employee->SqlWhere(), $Terminated_Employee->SqlGroupBy(), $Terminated_Employee->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}
		}

		// Call Row_Rendering event
		$Terminated_Employee->Row_Rendering();

		/* --------------------
		'  Render view codes
		' --------------------- */
		if ($Terminated_Employee->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// Department
			$Terminated_Employee->Department->GroupViewValue = $Terminated_Employee->Department->GroupOldValue();
			$Terminated_Employee->Department->CellAttrs["class"] = ($Terminated_Employee->RowGroupLevel == 1) ? "ewRptGrpSummary1" : "ewRptGrpField1";
			$Terminated_Employee->Department->GroupViewValue = ewrpt_DisplayGroupValue($Terminated_Employee->Department, $Terminated_Employee->Department->GroupViewValue);

			// ID
			$Terminated_Employee->ID->ViewValue = $Terminated_Employee->ID->Summary;

			// FirstName
			$Terminated_Employee->FirstName->ViewValue = $Terminated_Employee->FirstName->Summary;

			// MiddelName
			$Terminated_Employee->MiddelName->ViewValue = $Terminated_Employee->MiddelName->Summary;

			// LastName
			$Terminated_Employee->LastName->ViewValue = $Terminated_Employee->LastName->Summary;

			// Terminated_Date
			$Terminated_Employee->Terminated_Date->ViewValue = $Terminated_Employee->Terminated_Date->Summary;
			$Terminated_Employee->Terminated_Date->ViewValue = ewrpt_FormatDateTime($Terminated_Employee->Terminated_Date->ViewValue, 5);

			// Termination_Reason
			$Terminated_Employee->Termination_Reason->ViewValue = $Terminated_Employee->Termination_Reason->Summary;
		} else {

			// Department
			$Terminated_Employee->Department->GroupViewValue = $Terminated_Employee->Department->GroupValue();
			$Terminated_Employee->Department->CellAttrs["class"] = "ewRptGrpField1";
			$Terminated_Employee->Department->GroupViewValue = ewrpt_DisplayGroupValue($Terminated_Employee->Department, $Terminated_Employee->Department->GroupViewValue);
			if ($Terminated_Employee->Department->GroupValue() == $Terminated_Employee->Department->GroupOldValue() && !$this->ChkLvlBreak(1))
				$Terminated_Employee->Department->GroupViewValue = "&nbsp;";

			// ID
			$Terminated_Employee->ID->ViewValue = $Terminated_Employee->ID->CurrentValue;
			$Terminated_Employee->ID->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// FirstName
			$Terminated_Employee->FirstName->ViewValue = $Terminated_Employee->FirstName->CurrentValue;
			$Terminated_Employee->FirstName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// MiddelName
			$Terminated_Employee->MiddelName->ViewValue = $Terminated_Employee->MiddelName->CurrentValue;
			$Terminated_Employee->MiddelName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// LastName
			$Terminated_Employee->LastName->ViewValue = $Terminated_Employee->LastName->CurrentValue;
			$Terminated_Employee->LastName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Terminated_Date
			$Terminated_Employee->Terminated_Date->ViewValue = $Terminated_Employee->Terminated_Date->CurrentValue;
			$Terminated_Employee->Terminated_Date->ViewValue = ewrpt_FormatDateTime($Terminated_Employee->Terminated_Date->ViewValue, 5);
			$Terminated_Employee->Terminated_Date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Termination_Reason
			$Terminated_Employee->Termination_Reason->ViewValue = $Terminated_Employee->Termination_Reason->CurrentValue;
			$Terminated_Employee->Termination_Reason->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// Department
		$Terminated_Employee->Department->HrefValue = "";

		// ID
		$Terminated_Employee->ID->HrefValue = "";

		// FirstName
		$Terminated_Employee->FirstName->HrefValue = "";

		// MiddelName
		$Terminated_Employee->MiddelName->HrefValue = "";

		// LastName
		$Terminated_Employee->LastName->HrefValue = "";

		// Terminated_Date
		$Terminated_Employee->Terminated_Date->HrefValue = "";

		// Termination_Reason
		$Terminated_Employee->Termination_Reason->HrefValue = "";

		// Call Row_Rendered event
		$Terminated_Employee->Row_Rendered();
	}

	// Get extended filter values
	function GetExtendedFilterValues() {
		global $Terminated_Employee;

		// Field Department
		$sSelect = "SELECT DISTINCT `Department` FROM " . $Terminated_Employee->SqlFrom();
		$sOrderBy = "`Department` ASC";
		$wrkSql = ewrpt_BuildReportSql($sSelect, $Terminated_Employee->SqlWhere(), "", "", $sOrderBy, $this->UserIDFilter, "");
		$Terminated_Employee->Department->DropDownList = ewrpt_GetDistinctValues("", $wrkSql);
	}

	// Return extended filter
	function GetExtendedFilter() {
		global $Terminated_Employee;
		global $gsFormError;
		$sFilter = "";
		$bPostBack = ewrpt_IsHttpPost();
		$bRestoreSession = TRUE;
		$bSetupFilter = FALSE;

		// Reset extended filter if filter changed
		if ($bPostBack) {

			// Clear extended filter for field ID
			if ($this->ClearExtFilter == 'Terminated_Employee_ID')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'ID');

			// Clear extended filter for field FirstName
			if ($this->ClearExtFilter == 'Terminated_Employee_FirstName')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'FirstName');

			// Clear extended filter for field MiddelName
			if ($this->ClearExtFilter == 'Terminated_Employee_MiddelName')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'MiddelName');

			// Clear extended filter for field LastName
			if ($this->ClearExtFilter == 'Terminated_Employee_LastName')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'LastName');

			// Clear dropdown for field Department
			if ($this->ClearExtFilter == 'Terminated_Employee_Department')
				$this->SetSessionDropDownValue(EWRPT_INIT_VALUE, 'Department');

			// Clear extended filter for field Terminated_Date
			if ($this->ClearExtFilter == 'Terminated_Employee_Terminated_Date')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'Terminated_Date');

		// Reset search command
		} elseif (@$_GET["cmd"] == "reset") {

			// Load default values
			// Field ID

			$this->SetSessionFilterValues($Terminated_Employee->ID->SearchValue, $Terminated_Employee->ID->SearchOperator, $Terminated_Employee->ID->SearchCondition, $Terminated_Employee->ID->SearchValue2, $Terminated_Employee->ID->SearchOperator2, 'ID');

			// Field FirstName
			$this->SetSessionFilterValues($Terminated_Employee->FirstName->SearchValue, $Terminated_Employee->FirstName->SearchOperator, $Terminated_Employee->FirstName->SearchCondition, $Terminated_Employee->FirstName->SearchValue2, $Terminated_Employee->FirstName->SearchOperator2, 'FirstName');

			// Field MiddelName
			$this->SetSessionFilterValues($Terminated_Employee->MiddelName->SearchValue, $Terminated_Employee->MiddelName->SearchOperator, $Terminated_Employee->MiddelName->SearchCondition, $Terminated_Employee->MiddelName->SearchValue2, $Terminated_Employee->MiddelName->SearchOperator2, 'MiddelName');

			// Field LastName
			$this->SetSessionFilterValues($Terminated_Employee->LastName->SearchValue, $Terminated_Employee->LastName->SearchOperator, $Terminated_Employee->LastName->SearchCondition, $Terminated_Employee->LastName->SearchValue2, $Terminated_Employee->LastName->SearchOperator2, 'LastName');

			// Field Department
			$this->SetSessionDropDownValue($Terminated_Employee->Department->DropDownValue, 'Department');

			// Field Terminated_Date
			$this->SetSessionFilterValues($Terminated_Employee->Terminated_Date->SearchValue, $Terminated_Employee->Terminated_Date->SearchOperator, $Terminated_Employee->Terminated_Date->SearchCondition, $Terminated_Employee->Terminated_Date->SearchValue2, $Terminated_Employee->Terminated_Date->SearchOperator2, 'Terminated_Date');
			$bSetupFilter = TRUE;
		} else {

			// Field ID
			if ($this->GetFilterValues($Terminated_Employee->ID)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field FirstName
			if ($this->GetFilterValues($Terminated_Employee->FirstName)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field MiddelName
			if ($this->GetFilterValues($Terminated_Employee->MiddelName)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field LastName
			if ($this->GetFilterValues($Terminated_Employee->LastName)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field Department
			if ($this->GetDropDownValue($Terminated_Employee->Department->DropDownValue, 'Department')) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			} elseif ($Terminated_Employee->Department->DropDownValue <> EWRPT_INIT_VALUE && !isset($_SESSION['sv_Terminated_Employee->Department'])) {
				$bSetupFilter = TRUE;
			}

			// Field Terminated_Date
			if ($this->GetFilterValues($Terminated_Employee->Terminated_Date)) {
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
			$this->GetSessionFilterValues($Terminated_Employee->ID);

			// Field FirstName
			$this->GetSessionFilterValues($Terminated_Employee->FirstName);

			// Field MiddelName
			$this->GetSessionFilterValues($Terminated_Employee->MiddelName);

			// Field LastName
			$this->GetSessionFilterValues($Terminated_Employee->LastName);

			// Field Department
			$this->GetSessionDropDownValue($Terminated_Employee->Department);

			// Field Terminated_Date
			$this->GetSessionFilterValues($Terminated_Employee->Terminated_Date);
		}

		// Call page filter validated event
		$Terminated_Employee->Page_FilterValidated();

		// Build SQL
		// Field ID

		$this->BuildExtendedFilter($Terminated_Employee->ID, $sFilter);

		// Field FirstName
		$this->BuildExtendedFilter($Terminated_Employee->FirstName, $sFilter);

		// Field MiddelName
		$this->BuildExtendedFilter($Terminated_Employee->MiddelName, $sFilter);

		// Field LastName
		$this->BuildExtendedFilter($Terminated_Employee->LastName, $sFilter);

		// Field Department
		$this->BuildDropDownFilter($Terminated_Employee->Department, $sFilter, "");

		// Field Terminated_Date
		$this->BuildExtendedFilter($Terminated_Employee->Terminated_Date, $sFilter);

		// Save parms to session
		// Field ID

		$this->SetSessionFilterValues($Terminated_Employee->ID->SearchValue, $Terminated_Employee->ID->SearchOperator, $Terminated_Employee->ID->SearchCondition, $Terminated_Employee->ID->SearchValue2, $Terminated_Employee->ID->SearchOperator2, 'ID');

		// Field FirstName
		$this->SetSessionFilterValues($Terminated_Employee->FirstName->SearchValue, $Terminated_Employee->FirstName->SearchOperator, $Terminated_Employee->FirstName->SearchCondition, $Terminated_Employee->FirstName->SearchValue2, $Terminated_Employee->FirstName->SearchOperator2, 'FirstName');

		// Field MiddelName
		$this->SetSessionFilterValues($Terminated_Employee->MiddelName->SearchValue, $Terminated_Employee->MiddelName->SearchOperator, $Terminated_Employee->MiddelName->SearchCondition, $Terminated_Employee->MiddelName->SearchValue2, $Terminated_Employee->MiddelName->SearchOperator2, 'MiddelName');

		// Field LastName
		$this->SetSessionFilterValues($Terminated_Employee->LastName->SearchValue, $Terminated_Employee->LastName->SearchOperator, $Terminated_Employee->LastName->SearchCondition, $Terminated_Employee->LastName->SearchValue2, $Terminated_Employee->LastName->SearchOperator2, 'LastName');

		// Field Department
		$this->SetSessionDropDownValue($Terminated_Employee->Department->DropDownValue, 'Department');

		// Field Terminated_Date
		$this->SetSessionFilterValues($Terminated_Employee->Terminated_Date->SearchValue, $Terminated_Employee->Terminated_Date->SearchOperator, $Terminated_Employee->Terminated_Date->SearchCondition, $Terminated_Employee->Terminated_Date->SearchValue2, $Terminated_Employee->Terminated_Date->SearchOperator2, 'Terminated_Date');

		// Setup filter
		if ($bSetupFilter) {

			// Field ID
			$sWrk = "";
			$this->BuildExtendedFilter($Terminated_Employee->ID, $sWrk);
			$this->LoadSelectionFromFilter($Terminated_Employee->ID, $sWrk, $Terminated_Employee->ID->SelectionList);
			$_SESSION['sel_Terminated_Employee_ID'] = ($Terminated_Employee->ID->SelectionList == "") ? EWRPT_INIT_VALUE : $Terminated_Employee->ID->SelectionList;

			// Field FirstName
			$sWrk = "";
			$this->BuildExtendedFilter($Terminated_Employee->FirstName, $sWrk);
			$this->LoadSelectionFromFilter($Terminated_Employee->FirstName, $sWrk, $Terminated_Employee->FirstName->SelectionList);
			$_SESSION['sel_Terminated_Employee_FirstName'] = ($Terminated_Employee->FirstName->SelectionList == "") ? EWRPT_INIT_VALUE : $Terminated_Employee->FirstName->SelectionList;

			// Field MiddelName
			$sWrk = "";
			$this->BuildExtendedFilter($Terminated_Employee->MiddelName, $sWrk);
			$this->LoadSelectionFromFilter($Terminated_Employee->MiddelName, $sWrk, $Terminated_Employee->MiddelName->SelectionList);
			$_SESSION['sel_Terminated_Employee_MiddelName'] = ($Terminated_Employee->MiddelName->SelectionList == "") ? EWRPT_INIT_VALUE : $Terminated_Employee->MiddelName->SelectionList;

			// Field LastName
			$sWrk = "";
			$this->BuildExtendedFilter($Terminated_Employee->LastName, $sWrk);
			$this->LoadSelectionFromFilter($Terminated_Employee->LastName, $sWrk, $Terminated_Employee->LastName->SelectionList);
			$_SESSION['sel_Terminated_Employee_LastName'] = ($Terminated_Employee->LastName->SelectionList == "") ? EWRPT_INIT_VALUE : $Terminated_Employee->LastName->SelectionList;

			// Field Department
			$sWrk = "";
			$this->BuildDropDownFilter($Terminated_Employee->Department, $sWrk, "");
			$this->LoadSelectionFromFilter($Terminated_Employee->Department, $sWrk, $Terminated_Employee->Department->SelectionList);
			$_SESSION['sel_Terminated_Employee_Department'] = ($Terminated_Employee->Department->SelectionList == "") ? EWRPT_INIT_VALUE : $Terminated_Employee->Department->SelectionList;

			// Field Terminated_Date
			$sWrk = "";
			$this->BuildExtendedFilter($Terminated_Employee->Terminated_Date, $sWrk);
			$this->LoadSelectionFromFilter($Terminated_Employee->Terminated_Date, $sWrk, $Terminated_Employee->Terminated_Date->SelectionList);
			$_SESSION['sel_Terminated_Employee_Terminated_Date'] = ($Terminated_Employee->Terminated_Date->SelectionList == "") ? EWRPT_INIT_VALUE : $Terminated_Employee->Terminated_Date->SelectionList;
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
		$this->GetSessionValue($fld->DropDownValue, 'sv_Terminated_Employee_' . $parm);
	}

	// Get filter values from session
	function GetSessionFilterValues(&$fld) {
		$parm = substr($fld->FldVar, 2);
		$this->GetSessionValue($fld->SearchValue, 'sv1_Terminated_Employee_' . $parm);
		$this->GetSessionValue($fld->SearchOperator, 'so1_Terminated_Employee_' . $parm);
		$this->GetSessionValue($fld->SearchCondition, 'sc_Terminated_Employee_' . $parm);
		$this->GetSessionValue($fld->SearchValue2, 'sv2_Terminated_Employee_' . $parm);
		$this->GetSessionValue($fld->SearchOperator2, 'so2_Terminated_Employee_' . $parm);
	}

	// Get value from session
	function GetSessionValue(&$sv, $sn) {
		if (isset($_SESSION[$sn]))
			$sv = $_SESSION[$sn];
	}

	// Set dropdown value to session
	function SetSessionDropDownValue($sv, $parm) {
		$_SESSION['sv_Terminated_Employee_' . $parm] = $sv;
	}

	// Set filter values to session
	function SetSessionFilterValues($sv1, $so1, $sc, $sv2, $so2, $parm) {
		$_SESSION['sv1_Terminated_Employee_' . $parm] = $sv1;
		$_SESSION['so1_Terminated_Employee_' . $parm] = $so1;
		$_SESSION['sc_Terminated_Employee_' . $parm] = $sc;
		$_SESSION['sv2_Terminated_Employee_' . $parm] = $sv2;
		$_SESSION['so2_Terminated_Employee_' . $parm] = $so2;
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
		global $ReportLanguage, $gsFormError, $Terminated_Employee;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EWRPT_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ewrpt_CheckDate($Terminated_Employee->Terminated_Date->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Terminated_Employee->Terminated_Date->FldErrMsg();
		}
		if (!ewrpt_CheckDate($Terminated_Employee->Terminated_Date->SearchValue2)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Terminated_Employee->Terminated_Date->FldErrMsg();
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
		$_SESSION["sel_Terminated_Employee_$parm"] = "";
		$_SESSION["rf_Terminated_Employee_$parm"] = "";
		$_SESSION["rt_Terminated_Employee_$parm"] = "";
	}

	// Load selection from session
	function LoadSelectionFromSession($parm) {
		global $Terminated_Employee;
		$fld =& $Terminated_Employee->fields($parm);
		$fld->SelectionList = @$_SESSION["sel_Terminated_Employee_$parm"];
		$fld->RangeFrom = @$_SESSION["rf_Terminated_Employee_$parm"];
		$fld->RangeTo = @$_SESSION["rt_Terminated_Employee_$parm"];
	}

	// Load default value for filters
	function LoadDefaultFilters() {
		global $Terminated_Employee;

		/**
		* Set up default values for non Text filters
		*/

		// Field Department
		$Terminated_Employee->Department->DefaultDropDownValue = EWRPT_INIT_VALUE;
		$Terminated_Employee->Department->DropDownValue = $Terminated_Employee->Department->DefaultDropDownValue;
		$sWrk = "";
		$this->BuildDropDownFilter($Terminated_Employee->Department, $sWrk, "");
		$this->LoadSelectionFromFilter($Terminated_Employee->Department, $sWrk, $Terminated_Employee->Department->DefaultSelectionList);

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
		$this->SetDefaultExtFilter($Terminated_Employee->ID, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Terminated_Employee->ID);
		$sWrk = "";
		$this->BuildExtendedFilter($Terminated_Employee->ID, $sWrk);
		$this->LoadSelectionFromFilter($Terminated_Employee->ID, $sWrk, $Terminated_Employee->ID->DefaultSelectionList);
		$Terminated_Employee->ID->SelectionList = $Terminated_Employee->ID->DefaultSelectionList;

		// Field FirstName
		$this->SetDefaultExtFilter($Terminated_Employee->FirstName, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Terminated_Employee->FirstName);
		$sWrk = "";
		$this->BuildExtendedFilter($Terminated_Employee->FirstName, $sWrk);
		$this->LoadSelectionFromFilter($Terminated_Employee->FirstName, $sWrk, $Terminated_Employee->FirstName->DefaultSelectionList);
		$Terminated_Employee->FirstName->SelectionList = $Terminated_Employee->FirstName->DefaultSelectionList;

		// Field MiddelName
		$this->SetDefaultExtFilter($Terminated_Employee->MiddelName, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Terminated_Employee->MiddelName);
		$sWrk = "";
		$this->BuildExtendedFilter($Terminated_Employee->MiddelName, $sWrk);
		$this->LoadSelectionFromFilter($Terminated_Employee->MiddelName, $sWrk, $Terminated_Employee->MiddelName->DefaultSelectionList);
		$Terminated_Employee->MiddelName->SelectionList = $Terminated_Employee->MiddelName->DefaultSelectionList;

		// Field LastName
		$this->SetDefaultExtFilter($Terminated_Employee->LastName, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Terminated_Employee->LastName);
		$sWrk = "";
		$this->BuildExtendedFilter($Terminated_Employee->LastName, $sWrk);
		$this->LoadSelectionFromFilter($Terminated_Employee->LastName, $sWrk, $Terminated_Employee->LastName->DefaultSelectionList);
		$Terminated_Employee->LastName->SelectionList = $Terminated_Employee->LastName->DefaultSelectionList;

		// Field Terminated_Date
		$this->SetDefaultExtFilter($Terminated_Employee->Terminated_Date, "BETWEEN", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Terminated_Employee->Terminated_Date);
		$sWrk = "";
		$this->BuildExtendedFilter($Terminated_Employee->Terminated_Date, $sWrk);
		$this->LoadSelectionFromFilter($Terminated_Employee->Terminated_Date, $sWrk, $Terminated_Employee->Terminated_Date->DefaultSelectionList);
		$Terminated_Employee->Terminated_Date->SelectionList = $Terminated_Employee->Terminated_Date->DefaultSelectionList;

		/**
		* Set up default values for popup filters
		* NOTE: if extended filter is enabled, use default values in extended filter instead
		*/
	}

	// Check if filter applied
	function CheckFilter() {
		global $Terminated_Employee;

		// Check ID text filter
		if ($this->TextFilterApplied($Terminated_Employee->ID))
			return TRUE;

		// Check ID popup filter
		if (!ewrpt_MatchedArray($Terminated_Employee->ID->DefaultSelectionList, $Terminated_Employee->ID->SelectionList))
			return TRUE;

		// Check FirstName text filter
		if ($this->TextFilterApplied($Terminated_Employee->FirstName))
			return TRUE;

		// Check FirstName popup filter
		if (!ewrpt_MatchedArray($Terminated_Employee->FirstName->DefaultSelectionList, $Terminated_Employee->FirstName->SelectionList))
			return TRUE;

		// Check MiddelName text filter
		if ($this->TextFilterApplied($Terminated_Employee->MiddelName))
			return TRUE;

		// Check MiddelName popup filter
		if (!ewrpt_MatchedArray($Terminated_Employee->MiddelName->DefaultSelectionList, $Terminated_Employee->MiddelName->SelectionList))
			return TRUE;

		// Check LastName text filter
		if ($this->TextFilterApplied($Terminated_Employee->LastName))
			return TRUE;

		// Check LastName popup filter
		if (!ewrpt_MatchedArray($Terminated_Employee->LastName->DefaultSelectionList, $Terminated_Employee->LastName->SelectionList))
			return TRUE;

		// Check Department extended filter
		if ($this->NonTextFilterApplied($Terminated_Employee->Department))
			return TRUE;

		// Check Department popup filter
		if (!ewrpt_MatchedArray($Terminated_Employee->Department->DefaultSelectionList, $Terminated_Employee->Department->SelectionList))
			return TRUE;

		// Check Terminated_Date text filter
		if ($this->TextFilterApplied($Terminated_Employee->Terminated_Date))
			return TRUE;

		// Check Terminated_Date popup filter
		if (!ewrpt_MatchedArray($Terminated_Employee->Terminated_Date->DefaultSelectionList, $Terminated_Employee->Terminated_Date->SelectionList))
			return TRUE;
		return FALSE;
	}

	// Show list of filters
	function ShowFilterList() {
		global $Terminated_Employee;
		global $ReportLanguage;

		// Initialize
		$sFilterList = "";

		// Field ID
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Terminated_Employee->ID, $sExtWrk);
		if (is_array($Terminated_Employee->ID->SelectionList))
			$sWrk = ewrpt_JoinArray($Terminated_Employee->ID->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Terminated_Employee->ID->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field FirstName
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Terminated_Employee->FirstName, $sExtWrk);
		if (is_array($Terminated_Employee->FirstName->SelectionList))
			$sWrk = ewrpt_JoinArray($Terminated_Employee->FirstName->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Terminated_Employee->FirstName->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field MiddelName
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Terminated_Employee->MiddelName, $sExtWrk);
		if (is_array($Terminated_Employee->MiddelName->SelectionList))
			$sWrk = ewrpt_JoinArray($Terminated_Employee->MiddelName->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Terminated_Employee->MiddelName->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field LastName
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Terminated_Employee->LastName, $sExtWrk);
		if (is_array($Terminated_Employee->LastName->SelectionList))
			$sWrk = ewrpt_JoinArray($Terminated_Employee->LastName->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Terminated_Employee->LastName->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Department
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildDropDownFilter($Terminated_Employee->Department, $sExtWrk, "");
		if (is_array($Terminated_Employee->Department->SelectionList))
			$sWrk = ewrpt_JoinArray($Terminated_Employee->Department->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Terminated_Employee->Department->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Terminated_Date
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Terminated_Employee->Terminated_Date, $sExtWrk);
		if (is_array($Terminated_Employee->Terminated_Date->SelectionList))
			$sWrk = ewrpt_JoinArray($Terminated_Employee->Terminated_Date->SelectionList, ", ", EWRPT_DATATYPE_DATE);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Terminated_Employee->Terminated_Date->FldCaption() . "<br />";
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
		global $Terminated_Employee;
		$sWrk = "";
		if (!$this->ExtendedFilterExist($Terminated_Employee->ID)) {
			if (is_array($Terminated_Employee->ID->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Terminated_Employee->ID, "`ID`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Terminated_Employee->FirstName)) {
			if (is_array($Terminated_Employee->FirstName->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Terminated_Employee->FirstName, "`FirstName`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Terminated_Employee->MiddelName)) {
			if (is_array($Terminated_Employee->MiddelName->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Terminated_Employee->MiddelName, "`MiddelName`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Terminated_Employee->LastName)) {
			if (is_array($Terminated_Employee->LastName->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Terminated_Employee->LastName, "`LastName`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->DropDownFilterExist($Terminated_Employee->Department, "")) {
			if (is_array($Terminated_Employee->Department->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Terminated_Employee->Department, "`Department`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Terminated_Employee->Terminated_Date)) {
			if (is_array($Terminated_Employee->Terminated_Date->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Terminated_Employee->Terminated_Date, "`Terminated_Date`", EWRPT_DATATYPE_DATE);
			}
		}
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $Terminated_Employee;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$Terminated_Employee->setOrderBy("");
				$Terminated_Employee->setStartGroup(1);
				$Terminated_Employee->Department->setSort("");
				$Terminated_Employee->ID->setSort("");
				$Terminated_Employee->FirstName->setSort("");
				$Terminated_Employee->MiddelName->setSort("");
				$Terminated_Employee->LastName->setSort("");
				$Terminated_Employee->Terminated_Date->setSort("");
				$Terminated_Employee->Termination_Reason->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$Terminated_Employee->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$Terminated_Employee->CurrentOrderType = @$_GET["ordertype"];
			$sSortSql = $Terminated_Employee->SortSql();
			$Terminated_Employee->setOrderBy($sSortSql);
			$Terminated_Employee->setStartGroup(1);
		}

		// Set up default sort
		if ($Terminated_Employee->getOrderBy() == "") {
			$Terminated_Employee->setOrderBy("`ID` ASC");
			$Terminated_Employee->ID->setSort("ASC");
		}
		return $Terminated_Employee->getOrderBy();
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
