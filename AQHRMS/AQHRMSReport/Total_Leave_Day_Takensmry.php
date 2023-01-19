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
$Total_Leave_Day_Taken = NULL;

//
// Table class for Total Leave Day Taken
//
class crTotal_Leave_Day_Taken {
	var $TableVar = 'Total_Leave_Day_Taken';
	var $TableName = 'Total Leave Day Taken';
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
	var $ID;
	var $FirstName;
	var $MiddelName;
	var $Total_Leave_Days;
	var $MONTH;
	var $YEAR;
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
	function crTotal_Leave_Day_Taken() {
		global $ReportLanguage;

		// ID
		$this->ID = new crField('Total_Leave_Day_Taken', 'Total Leave Day Taken', 'x_ID', 'ID', '`ID`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['ID'] =& $this->ID;
		$this->ID->DateFilter = "";
		$this->ID->SqlSelect = "SELECT DISTINCT `ID` FROM " . $this->SqlFrom();
		$this->ID->SqlOrderBy = "`ID`";
		$this->ID->FldGroupByType = "";
		$this->ID->FldGroupInt = "0";
		$this->ID->FldGroupSql = "";

		// FirstName
		$this->FirstName = new crField('Total_Leave_Day_Taken', 'Total Leave Day Taken', 'x_FirstName', 'FirstName', '`FirstName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['FirstName'] =& $this->FirstName;
		$this->FirstName->DateFilter = "";
		$this->FirstName->SqlSelect = "SELECT DISTINCT `FirstName` FROM " . $this->SqlFrom();
		$this->FirstName->SqlOrderBy = "`FirstName`";
		$this->FirstName->FldGroupByType = "";
		$this->FirstName->FldGroupInt = "0";
		$this->FirstName->FldGroupSql = "";

		// MiddelName
		$this->MiddelName = new crField('Total_Leave_Day_Taken', 'Total Leave Day Taken', 'x_MiddelName', 'MiddelName', '`MiddelName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['MiddelName'] =& $this->MiddelName;
		$this->MiddelName->DateFilter = "";
		$this->MiddelName->SqlSelect = "SELECT DISTINCT `MiddelName` FROM " . $this->SqlFrom();
		$this->MiddelName->SqlOrderBy = "`MiddelName`";
		$this->MiddelName->FldGroupByType = "";
		$this->MiddelName->FldGroupInt = "0";
		$this->MiddelName->FldGroupSql = "";

		// Total Leave Days
		$this->Total_Leave_Days = new crField('Total_Leave_Day_Taken', 'Total Leave Day Taken', 'x_Total_Leave_Days', 'Total Leave Days', '`Total Leave Days`', 131, EWRPT_DATATYPE_NUMBER, -1);
		$this->Total_Leave_Days->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Total_Leave_Days'] =& $this->Total_Leave_Days;
		$this->Total_Leave_Days->DateFilter = "";
		$this->Total_Leave_Days->SqlSelect = "SELECT DISTINCT `Total Leave Days` FROM " . $this->SqlFrom();
		$this->Total_Leave_Days->SqlOrderBy = "`Total Leave Days`";
		$this->Total_Leave_Days->FldGroupByType = "";
		$this->Total_Leave_Days->FldGroupInt = "0";
		$this->Total_Leave_Days->FldGroupSql = "";

		// MONTH
		$this->MONTH = new crField('Total_Leave_Day_Taken', 'Total Leave Day Taken', 'x_MONTH', 'MONTH', '`MONTH`', 20, EWRPT_DATATYPE_NUMBER, -1);
		$this->MONTH->GroupingFieldId = 2;
		$this->MONTH->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['MONTH'] =& $this->MONTH;
		$this->MONTH->DateFilter = "";
		$this->MONTH->SqlSelect = "SELECT DISTINCT `MONTH` FROM " . $this->SqlFrom();
		$this->MONTH->SqlOrderBy = "`MONTH`";
		$this->MONTH->FldGroupByType = "";
		$this->MONTH->FldGroupInt = "0";
		$this->MONTH->FldGroupSql = "";

		// YEAR
		$this->YEAR = new crField('Total_Leave_Day_Taken', 'Total Leave Day Taken', 'x_YEAR', 'YEAR', '`YEAR`', 20, EWRPT_DATATYPE_NUMBER, -1);
		$this->YEAR->GroupingFieldId = 1;
		$this->YEAR->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['YEAR'] =& $this->YEAR;
		$this->YEAR->DateFilter = "";
		$this->YEAR->SqlSelect = "SELECT DISTINCT `YEAR` FROM " . $this->SqlFrom();
		$this->YEAR->SqlOrderBy = "`YEAR`";
		$this->YEAR->FldGroupByType = "";
		$this->YEAR->FldGroupInt = "0";
		$this->YEAR->FldGroupSql = "";
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
		return "`totalleavedays`";
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
		return "`YEAR` ASC, `MONTH` ASC";
	}

	// Table Level Group SQL
	function SqlFirstGroupField() {
		return "`YEAR`";
	}

	function SqlSelectGroup() {
		return "SELECT DISTINCT " . $this->SqlFirstGroupField() . " AS `YEAR` FROM " . $this->SqlFrom();
	}

	function SqlOrderByGroup() {
		return "`YEAR` ASC";
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
$Total_Leave_Day_Taken_summary = new crTotal_Leave_Day_Taken_summary();
$Page =& $Total_Leave_Day_Taken_summary;

// Page init
$Total_Leave_Day_Taken_summary->Page_Init();

// Page main
$Total_Leave_Day_Taken_summary->Page_Main();
?>
<?php include "phprptinc/header.php"; ?>
<?php if ($Total_Leave_Day_Taken->Export == "") { ?>
<script type="text/javascript">

// Create page object
var Total_Leave_Day_Taken_summary = new ewrpt_Page("Total_Leave_Day_Taken_summary");

// page properties
Total_Leave_Day_Taken_summary.PageID = "summary"; // page ID
Total_Leave_Day_Taken_summary.FormID = "fTotal_Leave_Day_Takensummaryfilter"; // form ID
var EWRPT_PAGE_ID = Total_Leave_Day_Taken_summary.PageID;

// extend page with ValidateForm function
Total_Leave_Day_Taken_summary.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var elm = fobj.sv1_Total_Leave_Days;
	if (elm && !ewrpt_CheckNumber(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Total_Leave_Day_Taken->Total_Leave_Days->FldErrMsg()) ?>"))
			return false;
	}

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj)) return false;
	return true;
}

// extend page with Form_CustomValidate function
Total_Leave_Day_Taken_summary.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EWRPT_CLIENT_VALIDATE) { ?>
Total_Leave_Day_Taken_summary.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
Total_Leave_Day_Taken_summary.ValidateRequired = false; // no JavaScript validation
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
<?php $Total_Leave_Day_Taken_summary->ShowPageHeader(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php $Total_Leave_Day_Taken_summary->ShowMessage(); ?>
<?php if ($Total_Leave_Day_Taken->Export == "" || $Total_Leave_Day_Taken->Export == "print" || $Total_Leave_Day_Taken->Export == "email") { ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php } ?>
<?php if ($Total_Leave_Day_Taken->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
<?php $jsdata = ewrpt_GetJsData($Total_Leave_Day_Taken->YEAR, $Total_Leave_Day_Taken->YEAR->FldType); ?>
ewrpt_CreatePopup("Total_Leave_Day_Taken_YEAR", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Total_Leave_Day_Taken->MONTH, $Total_Leave_Day_Taken->MONTH->FldType); ?>
ewrpt_CreatePopup("Total_Leave_Day_Taken_MONTH", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Total_Leave_Day_Taken->ID, $Total_Leave_Day_Taken->ID->FldType); ?>
ewrpt_CreatePopup("Total_Leave_Day_Taken_ID", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Total_Leave_Day_Taken->FirstName, $Total_Leave_Day_Taken->FirstName->FldType); ?>
ewrpt_CreatePopup("Total_Leave_Day_Taken_FirstName", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Total_Leave_Day_Taken->MiddelName, $Total_Leave_Day_Taken->MiddelName->FldType); ?>
ewrpt_CreatePopup("Total_Leave_Day_Taken_MiddelName", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Total_Leave_Day_Taken->Total_Leave_Days, $Total_Leave_Day_Taken->Total_Leave_Days->FldType); ?>
ewrpt_CreatePopup("Total_Leave_Day_Taken_Total_Leave_Days", [<?php echo $jsdata ?>]);
</script>
<div id="Total_Leave_Day_Taken_YEAR_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Total_Leave_Day_Taken_MONTH_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Total_Leave_Day_Taken_ID_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Total_Leave_Day_Taken_FirstName_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Total_Leave_Day_Taken_MiddelName_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Total_Leave_Day_Taken_Total_Leave_Days_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<?php } ?>
<?php if ($Total_Leave_Day_Taken->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<?php if ($Total_Leave_Day_Taken->Export == "" || $Total_Leave_Day_Taken->Export == "print" || $Total_Leave_Day_Taken->Export == "email") { ?>
<?php } ?>
<?php echo $Total_Leave_Day_Taken->TableCaption() ?>
<?php if ($Total_Leave_Day_Taken->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $Total_Leave_Day_Taken_summary->ExportPrintUrl ?>"><?php echo $ReportLanguage->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $Total_Leave_Day_Taken_summary->ExportExcelUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $Total_Leave_Day_Taken_summary->ExportWordUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToWord") ?></a>
<?php if ($Total_Leave_Day_Taken_summary->FilterApplied) { ?>
&nbsp;&nbsp;<a href="Total_Leave_Day_Takensmry.php?cmd=reset"><?php echo $ReportLanguage->Phrase("ResetAllFilter") ?></a>
<?php } ?>
<?php } ?>
<br /><br />
<?php if ($Total_Leave_Day_Taken->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($Total_Leave_Day_Taken->Export == "" || $Total_Leave_Day_Taken->Export == "print" || $Total_Leave_Day_Taken->Export == "email") { ?>
<?php } ?>
<?php if ($Total_Leave_Day_Taken->Export == "") { ?>
	</div></td>
	<!-- Left Container (End) -->
	<!-- Center Container - Report (Begin) -->
	<td style="vertical-align: top;" class="ewPadding"><div id="ewCenter" class="phpreportmaker">
	<!-- center slot -->
<?php } ?>
<!-- summary report starts -->
<div id="report_summary">
<?php if ($Total_Leave_Day_Taken->Export == "") { ?>
<?php
if ($Total_Leave_Day_Taken->FilterPanelOption == 2 || ($Total_Leave_Day_Taken->FilterPanelOption == 3 && $Total_Leave_Day_Taken_summary->FilterApplied) || $Total_Leave_Day_Taken_summary->Filter == "0=101") {
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
<form name="fTotal_Leave_Day_Takensummaryfilter" id="fTotal_Leave_Day_Takensummaryfilter" action="Total_Leave_Day_Takensmry.php" class="ewForm" onsubmit="return Total_Leave_Day_Taken_summary.ValidateForm(this);">
<table class="ewRptExtFilter">
	<tr>
		<td><span class="phpreportmaker"><?php echo $Total_Leave_Day_Taken->ID->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_ID" id="so1_ID" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_ID" id="sv1_ID" size="30" maxlength="7" value="<?php echo ewrpt_HtmlEncode($Total_Leave_Day_Taken->ID->SearchValue) ?>"<?php echo ($Total_Leave_Day_Taken_summary->ClearExtFilter == 'Total_Leave_Day_Taken_ID') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Total_Leave_Day_Taken->FirstName->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_FirstName" id="so1_FirstName" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_FirstName" id="sv1_FirstName" size="30" maxlength="20" value="<?php echo ewrpt_HtmlEncode($Total_Leave_Day_Taken->FirstName->SearchValue) ?>"<?php echo ($Total_Leave_Day_Taken_summary->ClearExtFilter == 'Total_Leave_Day_Taken_FirstName') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Total_Leave_Day_Taken->MiddelName->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_MiddelName" id="so1_MiddelName" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_MiddelName" id="sv1_MiddelName" size="30" maxlength="20" value="<?php echo ewrpt_HtmlEncode($Total_Leave_Day_Taken->MiddelName->SearchValue) ?>"<?php echo ($Total_Leave_Day_Taken_summary->ClearExtFilter == 'Total_Leave_Day_Taken_MiddelName') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Total_Leave_Day_Taken->Total_Leave_Days->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("="); ?><input type="hidden" name="so1_Total_Leave_Days" id="so1_Total_Leave_Days" value="="></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_Total_Leave_Days" id="sv1_Total_Leave_Days" size="30" value="<?php echo ewrpt_HtmlEncode($Total_Leave_Day_Taken->Total_Leave_Days->SearchValue) ?>"<?php echo ($Total_Leave_Day_Taken_summary->ClearExtFilter == 'Total_Leave_Day_Taken_Total_Leave_Days') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Total_Leave_Day_Taken->MONTH->FldCaption() ?></span></td>
		<td></td>
		<td colspan="4"><span class="ewRptSearchOpr">
		<select name="sv_MONTH[]" id="sv_MONTH[]" multiple<?php echo ($Total_Leave_Day_Taken_summary->ClearExtFilter == 'Total_Leave_Day_Taken_MONTH') ? " class=\"ewInputCleared\"" : "" ?>>
		<option value="<?php echo EWRPT_ALL_VALUE; ?>"<?php if (ewrpt_MatchedFilterValue($Total_Leave_Day_Taken->MONTH->DropDownValue, EWRPT_ALL_VALUE)) echo " selected=\"selected\""; ?>><?php echo $ReportLanguage->Phrase("SelectAll"); ?></option>
<?php

// Popup filter
$cntf = is_array($Total_Leave_Day_Taken->MONTH->CustomFilters) ? count($Total_Leave_Day_Taken->MONTH->CustomFilters) : 0;
$cntd = is_array($Total_Leave_Day_Taken->MONTH->DropDownList) ? count($Total_Leave_Day_Taken->MONTH->DropDownList) : 0;
$totcnt = $cntf + $cntd;
$wrkcnt = 0;
	for ($i = 0; $i < $cntf; $i++) {
		if ($Total_Leave_Day_Taken->MONTH->CustomFilters[$i]->FldName == 'MONTH') {
?>
		<option value="<?php echo "@@" . $Total_Leave_Day_Taken->MONTH->CustomFilters[$i]->FilterName ?>"<?php if (ewrpt_MatchedFilterValue($Total_Leave_Day_Taken->MONTH->DropDownValue, "@@" . $Total_Leave_Day_Taken->MONTH->CustomFilters[$i]->FilterName)) echo " selected=\"selected\"" ?>><?php echo $Total_Leave_Day_Taken->MONTH->CustomFilters[$i]->DisplayName ?></option>
<?php
		}
		$wrkcnt += 1;
	}

//}
	for ($i = 0; $i < $cntd; $i++) {
?>
		<option value="<?php echo $Total_Leave_Day_Taken->MONTH->DropDownList[$i] ?>"<?php if (ewrpt_MatchedFilterValue($Total_Leave_Day_Taken->MONTH->DropDownValue, $Total_Leave_Day_Taken->MONTH->DropDownList[$i])) echo " selected=\"selected\"" ?>><?php echo ewrpt_DropDownDisplayValue($Total_Leave_Day_Taken->MONTH->DropDownList[$i], "", 0) ?></option>
<?php
		$wrkcnt += 1;
	}

//}
?>
		</select>
		</span></td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Total_Leave_Day_Taken->YEAR->FldCaption() ?></span></td>
		<td></td>
		<td colspan="4"><span class="ewRptSearchOpr">
		<select name="sv_YEAR" id="sv_YEAR"<?php echo ($Total_Leave_Day_Taken_summary->ClearExtFilter == 'Total_Leave_Day_Taken_YEAR') ? " class=\"ewInputCleared\"" : "" ?>>
		<option value="<?php echo EWRPT_ALL_VALUE; ?>"<?php if (ewrpt_MatchedFilterValue($Total_Leave_Day_Taken->YEAR->DropDownValue, EWRPT_ALL_VALUE)) echo " selected=\"selected\""; ?>><?php echo $ReportLanguage->Phrase("PleaseSelect"); ?></option>
<?php

// Popup filter
$cntf = is_array($Total_Leave_Day_Taken->YEAR->CustomFilters) ? count($Total_Leave_Day_Taken->YEAR->CustomFilters) : 0;
$cntd = is_array($Total_Leave_Day_Taken->YEAR->DropDownList) ? count($Total_Leave_Day_Taken->YEAR->DropDownList) : 0;
$totcnt = $cntf + $cntd;
$wrkcnt = 0;
	for ($i = 0; $i < $cntf; $i++) {
		if ($Total_Leave_Day_Taken->YEAR->CustomFilters[$i]->FldName == 'YEAR') {
?>
		<option value="<?php echo "@@" . $Total_Leave_Day_Taken->YEAR->CustomFilters[$i]->FilterName ?>"<?php if (ewrpt_MatchedFilterValue($Total_Leave_Day_Taken->YEAR->DropDownValue, "@@" . $Total_Leave_Day_Taken->YEAR->CustomFilters[$i]->FilterName)) echo " selected=\"selected\"" ?>><?php echo $Total_Leave_Day_Taken->YEAR->CustomFilters[$i]->DisplayName ?></option>
<?php
		}
		$wrkcnt += 1;
	}

//}
	for ($i = 0; $i < $cntd; $i++) {
?>
		<option value="<?php echo $Total_Leave_Day_Taken->YEAR->DropDownList[$i] ?>"<?php if (ewrpt_MatchedFilterValue($Total_Leave_Day_Taken->YEAR->DropDownValue, $Total_Leave_Day_Taken->YEAR->DropDownList[$i])) echo " selected=\"selected\"" ?>><?php echo ewrpt_DropDownDisplayValue($Total_Leave_Day_Taken->YEAR->DropDownList[$i], "", 0) ?></option>
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
<!-- Search form (end) -->
</div>
<br />
<?php } ?>
<?php if ($Total_Leave_Day_Taken->ShowCurrentFilter) { ?>
<div id="ewrptFilterList">
<?php $Total_Leave_Day_Taken_summary->ShowFilterList() ?>
</div>
<br />
<?php } ?>
<table class="ewGrid" cellspacing="0"><tr>
	<td class="ewGridContent">
<?php if ($Total_Leave_Day_Taken->Export == "") { ?>
<div class="ewGridUpperPanel">
<form action="Total_Leave_Day_Takensmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($Total_Leave_Day_Taken_summary->StartGrp, $Total_Leave_Day_Taken_summary->DisplayGrps, $Total_Leave_Day_Taken_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="Total_Leave_Day_Takensmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="Total_Leave_Day_Takensmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="Total_Leave_Day_Takensmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="Total_Leave_Day_Takensmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($Total_Leave_Day_Taken_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($Total_Leave_Day_Taken_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($Total_Leave_Day_Taken_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($Total_Leave_Day_Taken_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($Total_Leave_Day_Taken_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($Total_Leave_Day_Taken_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($Total_Leave_Day_Taken_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($Total_Leave_Day_Taken_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($Total_Leave_Day_Taken_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($Total_Leave_Day_Taken_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($Total_Leave_Day_Taken->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
if ($Total_Leave_Day_Taken->ExportAll && $Total_Leave_Day_Taken->Export <> "") {
	$Total_Leave_Day_Taken_summary->StopGrp = $Total_Leave_Day_Taken_summary->TotalGrps;
} else {
	$Total_Leave_Day_Taken_summary->StopGrp = $Total_Leave_Day_Taken_summary->StartGrp + $Total_Leave_Day_Taken_summary->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($Total_Leave_Day_Taken_summary->StopGrp) > intval($Total_Leave_Day_Taken_summary->TotalGrps))
	$Total_Leave_Day_Taken_summary->StopGrp = $Total_Leave_Day_Taken_summary->TotalGrps;
$Total_Leave_Day_Taken_summary->RecCount = 0;

// Get first row
if ($Total_Leave_Day_Taken_summary->TotalGrps > 0) {
	$Total_Leave_Day_Taken_summary->GetGrpRow(1);
	$Total_Leave_Day_Taken_summary->GrpCount = 1;
}
while (($rsgrp && !$rsgrp->EOF && $Total_Leave_Day_Taken_summary->GrpCount <= $Total_Leave_Day_Taken_summary->DisplayGrps) || $Total_Leave_Day_Taken_summary->ShowFirstHeader) {

	// Show header
	if ($Total_Leave_Day_Taken_summary->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Total_Leave_Day_Taken->SortUrl($Total_Leave_Day_Taken->YEAR) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Total_Leave_Day_Taken->YEAR->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Total_Leave_Day_Taken->SortUrl($Total_Leave_Day_Taken->YEAR) ?>',0);"><?php echo $Total_Leave_Day_Taken->YEAR->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Total_Leave_Day_Taken->YEAR->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Total_Leave_Day_Taken->YEAR->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Total_Leave_Day_Taken->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Total_Leave_Day_Taken_YEAR', false, '<?php echo $Total_Leave_Day_Taken->YEAR->RangeFrom; ?>', '<?php echo $Total_Leave_Day_Taken->YEAR->RangeTo; ?>');return false;" name="x_YEAR<?php echo $Total_Leave_Day_Taken_summary->Cnt[0][0]; ?>" id="x_YEAR<?php echo $Total_Leave_Day_Taken_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Total_Leave_Day_Taken->SortUrl($Total_Leave_Day_Taken->MONTH) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Total_Leave_Day_Taken->MONTH->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Total_Leave_Day_Taken->SortUrl($Total_Leave_Day_Taken->MONTH) ?>',0);"><?php echo $Total_Leave_Day_Taken->MONTH->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Total_Leave_Day_Taken->MONTH->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Total_Leave_Day_Taken->MONTH->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Total_Leave_Day_Taken->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Total_Leave_Day_Taken_MONTH', false, '<?php echo $Total_Leave_Day_Taken->MONTH->RangeFrom; ?>', '<?php echo $Total_Leave_Day_Taken->MONTH->RangeTo; ?>');return false;" name="x_MONTH<?php echo $Total_Leave_Day_Taken_summary->Cnt[0][0]; ?>" id="x_MONTH<?php echo $Total_Leave_Day_Taken_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Total_Leave_Day_Taken->SortUrl($Total_Leave_Day_Taken->ID) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Total_Leave_Day_Taken->ID->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Total_Leave_Day_Taken->SortUrl($Total_Leave_Day_Taken->ID) ?>',0);"><?php echo $Total_Leave_Day_Taken->ID->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Total_Leave_Day_Taken->ID->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Total_Leave_Day_Taken->ID->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Total_Leave_Day_Taken->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Total_Leave_Day_Taken_ID', false, '<?php echo $Total_Leave_Day_Taken->ID->RangeFrom; ?>', '<?php echo $Total_Leave_Day_Taken->ID->RangeTo; ?>');return false;" name="x_ID<?php echo $Total_Leave_Day_Taken_summary->Cnt[0][0]; ?>" id="x_ID<?php echo $Total_Leave_Day_Taken_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Total_Leave_Day_Taken->SortUrl($Total_Leave_Day_Taken->FirstName) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Total_Leave_Day_Taken->FirstName->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Total_Leave_Day_Taken->SortUrl($Total_Leave_Day_Taken->FirstName) ?>',0);"><?php echo $Total_Leave_Day_Taken->FirstName->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Total_Leave_Day_Taken->FirstName->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Total_Leave_Day_Taken->FirstName->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Total_Leave_Day_Taken->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Total_Leave_Day_Taken_FirstName', false, '<?php echo $Total_Leave_Day_Taken->FirstName->RangeFrom; ?>', '<?php echo $Total_Leave_Day_Taken->FirstName->RangeTo; ?>');return false;" name="x_FirstName<?php echo $Total_Leave_Day_Taken_summary->Cnt[0][0]; ?>" id="x_FirstName<?php echo $Total_Leave_Day_Taken_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Total_Leave_Day_Taken->SortUrl($Total_Leave_Day_Taken->MiddelName) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Total_Leave_Day_Taken->MiddelName->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Total_Leave_Day_Taken->SortUrl($Total_Leave_Day_Taken->MiddelName) ?>',0);"><?php echo $Total_Leave_Day_Taken->MiddelName->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Total_Leave_Day_Taken->MiddelName->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Total_Leave_Day_Taken->MiddelName->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Total_Leave_Day_Taken->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Total_Leave_Day_Taken_MiddelName', false, '<?php echo $Total_Leave_Day_Taken->MiddelName->RangeFrom; ?>', '<?php echo $Total_Leave_Day_Taken->MiddelName->RangeTo; ?>');return false;" name="x_MiddelName<?php echo $Total_Leave_Day_Taken_summary->Cnt[0][0]; ?>" id="x_MiddelName<?php echo $Total_Leave_Day_Taken_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Total_Leave_Day_Taken->SortUrl($Total_Leave_Day_Taken->Total_Leave_Days) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Total_Leave_Day_Taken->Total_Leave_Days->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Total_Leave_Day_Taken->SortUrl($Total_Leave_Day_Taken->Total_Leave_Days) ?>',0);"><?php echo $Total_Leave_Day_Taken->Total_Leave_Days->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Total_Leave_Day_Taken->Total_Leave_Days->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Total_Leave_Day_Taken->Total_Leave_Days->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Total_Leave_Day_Taken->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Total_Leave_Day_Taken_Total_Leave_Days', false, '<?php echo $Total_Leave_Day_Taken->Total_Leave_Days->RangeFrom; ?>', '<?php echo $Total_Leave_Day_Taken->Total_Leave_Days->RangeTo; ?>');return false;" name="x_Total_Leave_Days<?php echo $Total_Leave_Day_Taken_summary->Cnt[0][0]; ?>" id="x_Total_Leave_Days<?php echo $Total_Leave_Day_Taken_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$Total_Leave_Day_Taken_summary->ShowFirstHeader = FALSE;
	}

	// Build detail SQL
	$sWhere = ewrpt_DetailFilterSQL($Total_Leave_Day_Taken->YEAR, $Total_Leave_Day_Taken->SqlFirstGroupField(), $Total_Leave_Day_Taken->YEAR->GroupValue());
	if ($Total_Leave_Day_Taken_summary->Filter != "")
		$sWhere = "($Total_Leave_Day_Taken_summary->Filter) AND ($sWhere)";
	$sSql = ewrpt_BuildReportSql($Total_Leave_Day_Taken->SqlSelect(), $Total_Leave_Day_Taken->SqlWhere(), $Total_Leave_Day_Taken->SqlGroupBy(), $Total_Leave_Day_Taken->SqlHaving(), $Total_Leave_Day_Taken->SqlOrderBy(), $sWhere, $Total_Leave_Day_Taken_summary->Sort);
	$rs = $conn->Execute($sSql);
	$rsdtlcnt = ($rs) ? $rs->RecordCount() : 0;
	if ($rsdtlcnt > 0)
		$Total_Leave_Day_Taken_summary->GetRow(1);
	while ($rs && !$rs->EOF) { // Loop detail records
		$Total_Leave_Day_Taken_summary->RecCount++;

		// Render detail row
		$Total_Leave_Day_Taken->ResetCSS();
		$Total_Leave_Day_Taken->RowType = EWRPT_ROWTYPE_DETAIL;
		$Total_Leave_Day_Taken_summary->RenderRow();
?>
	<tr<?php echo $Total_Leave_Day_Taken->RowAttributes(); ?>>
		<td<?php echo $Total_Leave_Day_Taken->YEAR->CellAttributes(); ?>><div<?php echo $Total_Leave_Day_Taken->YEAR->ViewAttributes(); ?>><?php echo $Total_Leave_Day_Taken->YEAR->GroupViewValue; ?></div></td>
		<td<?php echo $Total_Leave_Day_Taken->MONTH->CellAttributes(); ?>><div<?php echo $Total_Leave_Day_Taken->MONTH->ViewAttributes(); ?>><?php echo $Total_Leave_Day_Taken->MONTH->GroupViewValue; ?></div></td>
		<td<?php echo $Total_Leave_Day_Taken->ID->CellAttributes() ?>>
<div<?php echo $Total_Leave_Day_Taken->ID->ViewAttributes(); ?>><?php echo $Total_Leave_Day_Taken->ID->ListViewValue(); ?></div>
</td>
		<td<?php echo $Total_Leave_Day_Taken->FirstName->CellAttributes() ?>>
<div<?php echo $Total_Leave_Day_Taken->FirstName->ViewAttributes(); ?>><?php echo $Total_Leave_Day_Taken->FirstName->ListViewValue(); ?></div>
</td>
		<td<?php echo $Total_Leave_Day_Taken->MiddelName->CellAttributes() ?>>
<div<?php echo $Total_Leave_Day_Taken->MiddelName->ViewAttributes(); ?>><?php echo $Total_Leave_Day_Taken->MiddelName->ListViewValue(); ?></div>
</td>
		<td<?php echo $Total_Leave_Day_Taken->Total_Leave_Days->CellAttributes() ?>>
<div<?php echo $Total_Leave_Day_Taken->Total_Leave_Days->ViewAttributes(); ?>><?php echo $Total_Leave_Day_Taken->Total_Leave_Days->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$Total_Leave_Day_Taken_summary->AccumulateSummary();

		// Get next record
		$Total_Leave_Day_Taken_summary->GetRow(2);

		// Show Footers
?>
<?php
	} // End detail records loop
?>
<?php

	// Next group
	$Total_Leave_Day_Taken_summary->GetGrpRow(2);
	$Total_Leave_Day_Taken_summary->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
<?php
if ($Total_Leave_Day_Taken_summary->TotalGrps > 0) {
	$Total_Leave_Day_Taken->ResetCSS();
	$Total_Leave_Day_Taken->RowType = EWRPT_ROWTYPE_TOTAL;
	$Total_Leave_Day_Taken->RowTotalType = EWRPT_ROWTOTAL_GRAND;
	$Total_Leave_Day_Taken->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
	$Total_Leave_Day_Taken->RowAttrs["class"] = "ewRptGrandSummary";
	$Total_Leave_Day_Taken_summary->RenderRow();
?>
	<!-- tr><td colspan="6"><span class="phpreportmaker">&nbsp;<br /></span></td></tr -->
	<tr<?php echo $Total_Leave_Day_Taken->RowAttributes(); ?>><td colspan="6"><?php echo $ReportLanguage->Phrase("RptGrandTotal") ?> (<?php echo ewrpt_FormatNumber($Total_Leave_Day_Taken_summary->TotCount,0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php } ?>
	</tfoot>
</table>
</div>
<?php if ($Total_Leave_Day_Taken_summary->TotalGrps > 0) { ?>
<?php if ($Total_Leave_Day_Taken->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="Total_Leave_Day_Takensmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($Total_Leave_Day_Taken_summary->StartGrp, $Total_Leave_Day_Taken_summary->DisplayGrps, $Total_Leave_Day_Taken_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="Total_Leave_Day_Takensmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="Total_Leave_Day_Takensmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="Total_Leave_Day_Takensmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="Total_Leave_Day_Takensmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($Total_Leave_Day_Taken_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($Total_Leave_Day_Taken_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($Total_Leave_Day_Taken_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($Total_Leave_Day_Taken_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($Total_Leave_Day_Taken_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($Total_Leave_Day_Taken_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($Total_Leave_Day_Taken_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($Total_Leave_Day_Taken_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($Total_Leave_Day_Taken_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($Total_Leave_Day_Taken_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($Total_Leave_Day_Taken->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php if ($Total_Leave_Day_Taken->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($Total_Leave_Day_Taken->Export == "" || $Total_Leave_Day_Taken->Export == "print" || $Total_Leave_Day_Taken->Export == "email") { ?>
<?php } ?>
<?php if ($Total_Leave_Day_Taken->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($Total_Leave_Day_Taken->Export == "" || $Total_Leave_Day_Taken->Export == "print" || $Total_Leave_Day_Taken->Export == "email") { ?>
<?php } ?>
<?php if ($Total_Leave_Day_Taken->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $Total_Leave_Day_Taken_summary->ShowPageFooter(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($Total_Leave_Day_Taken->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "phprptinc/footer.php"; ?>
<?php
$Total_Leave_Day_Taken_summary->Page_Terminate();
?>
<?php

//
// Page class
//
class crTotal_Leave_Day_Taken_summary {

	// Page ID
	var $PageID = 'summary';

	// Table name
	var $TableName = 'Total Leave Day Taken';

	// Page object name
	var $PageObjName = 'Total_Leave_Day_Taken_summary';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $Total_Leave_Day_Taken;
		if ($Total_Leave_Day_Taken->UseTokenInUrl) $PageUrl .= "t=" . $Total_Leave_Day_Taken->TableVar . "&"; // Add page token
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
		global $Total_Leave_Day_Taken;
		if ($Total_Leave_Day_Taken->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($Total_Leave_Day_Taken->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($Total_Leave_Day_Taken->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crTotal_Leave_Day_Taken_summary() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (Total_Leave_Day_Taken)
		$GLOBALS["Total_Leave_Day_Taken"] = new crTotal_Leave_Day_Taken();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'summary', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'Total Leave Day Taken', TRUE);

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
		global $Total_Leave_Day_Taken;

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$Total_Leave_Day_Taken->Export = $_GET["export"];
	}
	$gsExport = $Total_Leave_Day_Taken->Export; // Get export parameter, used in header
	$gsExportFile = $Total_Leave_Day_Taken->TableVar; // Get export file, used in header
	if ($Total_Leave_Day_Taken->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($Total_Leave_Day_Taken->Export == "word") {
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
		global $Total_Leave_Day_Taken;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($Total_Leave_Day_Taken->Export == "email") {
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
		global $Total_Leave_Day_Taken;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 5;
		$nGrps = 3;
		$this->Val = ewrpt_InitArray($nDtls, 0);
		$this->Cnt = ewrpt_Init2DArray($nGrps, $nDtls, 0);
		$this->Smry = ewrpt_Init2DArray($nGrps, $nDtls, 0);
		$this->Mn = ewrpt_Init2DArray($nGrps, $nDtls, NULL);
		$this->Mx = ewrpt_Init2DArray($nGrps, $nDtls, NULL);
		$this->GrandSmry = ewrpt_InitArray($nDtls, 0);
		$this->GrandMn = ewrpt_InitArray($nDtls, NULL);
		$this->GrandMx = ewrpt_InitArray($nDtls, NULL);

		// Set up if accumulation required
		$this->Col = array(FALSE, FALSE, FALSE, FALSE, FALSE);

		// Set up groups per page dynamically
		$this->SetUpDisplayGrps();
		$Total_Leave_Day_Taken->YEAR->SelectionList = "";
		$Total_Leave_Day_Taken->YEAR->DefaultSelectionList = "";
		$Total_Leave_Day_Taken->YEAR->ValueList = "";
		$Total_Leave_Day_Taken->MONTH->SelectionList = "";
		$Total_Leave_Day_Taken->MONTH->DefaultSelectionList = "";
		$Total_Leave_Day_Taken->MONTH->ValueList = "";
		$Total_Leave_Day_Taken->ID->SelectionList = "";
		$Total_Leave_Day_Taken->ID->DefaultSelectionList = "";
		$Total_Leave_Day_Taken->ID->ValueList = "";
		$Total_Leave_Day_Taken->FirstName->SelectionList = "";
		$Total_Leave_Day_Taken->FirstName->DefaultSelectionList = "";
		$Total_Leave_Day_Taken->FirstName->ValueList = "";
		$Total_Leave_Day_Taken->MiddelName->SelectionList = "";
		$Total_Leave_Day_Taken->MiddelName->DefaultSelectionList = "";
		$Total_Leave_Day_Taken->MiddelName->ValueList = "";
		$Total_Leave_Day_Taken->Total_Leave_Days->SelectionList = "";
		$Total_Leave_Day_Taken->Total_Leave_Days->DefaultSelectionList = "";
		$Total_Leave_Day_Taken->Total_Leave_Days->ValueList = "";

		// Load default filter values
		$this->LoadDefaultFilters();

		// Set up popup filter
		$this->SetupPopup();

		// Extended filter
		$sExtendedFilter = "";

		// Get dropdown values
		$this->GetExtendedFilterValues();

		// Load custom filters
		$Total_Leave_Day_Taken->CustomFilters_Load();

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
		$sGrpSort = ewrpt_UpdateSortFields($Total_Leave_Day_Taken->SqlOrderByGroup(), $this->Sort, 2); // Get grouping field only
		$sSql = ewrpt_BuildReportSql($Total_Leave_Day_Taken->SqlSelectGroup(), $Total_Leave_Day_Taken->SqlWhere(), $Total_Leave_Day_Taken->SqlGroupBy(), $Total_Leave_Day_Taken->SqlHaving(), $Total_Leave_Day_Taken->SqlOrderByGroup(), $this->Filter, $sGrpSort);
		$this->TotalGrps = $this->GetGrpCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($Total_Leave_Day_Taken->ExportAll && $Total_Leave_Day_Taken->Export <> "")
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
		global $Total_Leave_Day_Taken;
		switch ($lvl) {
			case 1:
				return (is_null($Total_Leave_Day_Taken->YEAR->CurrentValue) && !is_null($Total_Leave_Day_Taken->YEAR->OldValue)) ||
					(!is_null($Total_Leave_Day_Taken->YEAR->CurrentValue) && is_null($Total_Leave_Day_Taken->YEAR->OldValue)) ||
					($Total_Leave_Day_Taken->YEAR->GroupValue() <> $Total_Leave_Day_Taken->YEAR->GroupOldValue());
			case 2:
				return (is_null($Total_Leave_Day_Taken->MONTH->CurrentValue) && !is_null($Total_Leave_Day_Taken->MONTH->OldValue)) ||
					(!is_null($Total_Leave_Day_Taken->MONTH->CurrentValue) && is_null($Total_Leave_Day_Taken->MONTH->OldValue)) ||
					($Total_Leave_Day_Taken->MONTH->GroupValue() <> $Total_Leave_Day_Taken->MONTH->GroupOldValue()) || $this->ChkLvlBreak(1); // Recurse upper level
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
		global $Total_Leave_Day_Taken;
		$rsgrpcnt = $conn->Execute($sql);
		$grpcnt = ($rsgrpcnt) ? $rsgrpcnt->RecordCount() : 0;
		if ($rsgrpcnt) $rsgrpcnt->Close();
		return $grpcnt;
	}

	// Get group rs
	function GetGrpRs($sql, $start, $grps) {
		global $conn;
		global $Total_Leave_Day_Taken;
		$wrksql = $sql;
		if ($start > 0 && $grps > -1)
			$wrksql .= " LIMIT " . ($start-1) . ", " . ($grps);
		$rswrk = $conn->Execute($wrksql);
		return $rswrk;
	}

	// Get group row values
	function GetGrpRow($opt) {
		global $rsgrp;
		global $Total_Leave_Day_Taken;
		if (!$rsgrp)
			return;
		if ($opt == 1) { // Get first group

			//$rsgrp->MoveFirst(); // NOTE: no need to move position
			$Total_Leave_Day_Taken->YEAR->setDbValue(""); // Init first value
		} else { // Get next group
			$rsgrp->MoveNext();
		}
		if (!$rsgrp->EOF)
			$Total_Leave_Day_Taken->YEAR->setDbValue($rsgrp->fields('YEAR'));
		if ($rsgrp->EOF) {
			$Total_Leave_Day_Taken->YEAR->setDbValue("");
		}
	}

	// Get row values
	function GetRow($opt) {
		global $rs;
		global $Total_Leave_Day_Taken;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$Total_Leave_Day_Taken->ID->setDbValue($rs->fields('ID'));
			$Total_Leave_Day_Taken->FirstName->setDbValue($rs->fields('FirstName'));
			$Total_Leave_Day_Taken->MiddelName->setDbValue($rs->fields('MiddelName'));
			$Total_Leave_Day_Taken->Total_Leave_Days->setDbValue($rs->fields('Total Leave Days'));
			$Total_Leave_Day_Taken->MONTH->setDbValue($rs->fields('MONTH'));
			if ($opt <> 1)
				$Total_Leave_Day_Taken->YEAR->setDbValue($rs->fields('YEAR'));
			$this->Val[1] = $Total_Leave_Day_Taken->ID->CurrentValue;
			$this->Val[2] = $Total_Leave_Day_Taken->FirstName->CurrentValue;
			$this->Val[3] = $Total_Leave_Day_Taken->MiddelName->CurrentValue;
			$this->Val[4] = $Total_Leave_Day_Taken->Total_Leave_Days->CurrentValue;
		} else {
			$Total_Leave_Day_Taken->ID->setDbValue("");
			$Total_Leave_Day_Taken->FirstName->setDbValue("");
			$Total_Leave_Day_Taken->MiddelName->setDbValue("");
			$Total_Leave_Day_Taken->Total_Leave_Days->setDbValue("");
			$Total_Leave_Day_Taken->MONTH->setDbValue("");
			$Total_Leave_Day_Taken->YEAR->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $Total_Leave_Day_Taken;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$Total_Leave_Day_Taken->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$Total_Leave_Day_Taken->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $Total_Leave_Day_Taken->getStartGroup();
			}
		} else {
			$this->StartGrp = $Total_Leave_Day_Taken->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$Total_Leave_Day_Taken->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$Total_Leave_Day_Taken->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$Total_Leave_Day_Taken->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $Total_Leave_Day_Taken;

		// Initialize popup
		// Build distinct values for YEAR

		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Total_Leave_Day_Taken->YEAR->SqlSelect, $Total_Leave_Day_Taken->SqlWhere(), $Total_Leave_Day_Taken->SqlGroupBy(), $Total_Leave_Day_Taken->SqlHaving(), $Total_Leave_Day_Taken->YEAR->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Total_Leave_Day_Taken->YEAR->setDbValue($rswrk->fields[0]);
			if (is_null($Total_Leave_Day_Taken->YEAR->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Total_Leave_Day_Taken->YEAR->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Total_Leave_Day_Taken->YEAR->GroupViewValue = ewrpt_DisplayGroupValue($Total_Leave_Day_Taken->YEAR,$Total_Leave_Day_Taken->YEAR->GroupValue());
				ewrpt_SetupDistinctValues($Total_Leave_Day_Taken->YEAR->ValueList, $Total_Leave_Day_Taken->YEAR->GroupValue(), $Total_Leave_Day_Taken->YEAR->GroupViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Total_Leave_Day_Taken->YEAR->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Total_Leave_Day_Taken->YEAR->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for MONTH
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Total_Leave_Day_Taken->MONTH->SqlSelect, $Total_Leave_Day_Taken->SqlWhere(), $Total_Leave_Day_Taken->SqlGroupBy(), $Total_Leave_Day_Taken->SqlHaving(), $Total_Leave_Day_Taken->MONTH->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Total_Leave_Day_Taken->MONTH->setDbValue($rswrk->fields[0]);
			if (is_null($Total_Leave_Day_Taken->MONTH->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Total_Leave_Day_Taken->MONTH->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Total_Leave_Day_Taken->MONTH->GroupViewValue = ewrpt_DisplayGroupValue($Total_Leave_Day_Taken->MONTH,$Total_Leave_Day_Taken->MONTH->GroupValue());
				ewrpt_SetupDistinctValues($Total_Leave_Day_Taken->MONTH->ValueList, $Total_Leave_Day_Taken->MONTH->GroupValue(), $Total_Leave_Day_Taken->MONTH->GroupViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Total_Leave_Day_Taken->MONTH->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Total_Leave_Day_Taken->MONTH->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for ID
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Total_Leave_Day_Taken->ID->SqlSelect, $Total_Leave_Day_Taken->SqlWhere(), $Total_Leave_Day_Taken->SqlGroupBy(), $Total_Leave_Day_Taken->SqlHaving(), $Total_Leave_Day_Taken->ID->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Total_Leave_Day_Taken->ID->setDbValue($rswrk->fields[0]);
			if (is_null($Total_Leave_Day_Taken->ID->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Total_Leave_Day_Taken->ID->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Total_Leave_Day_Taken->ID->ViewValue = $Total_Leave_Day_Taken->ID->CurrentValue;
				ewrpt_SetupDistinctValues($Total_Leave_Day_Taken->ID->ValueList, $Total_Leave_Day_Taken->ID->CurrentValue, $Total_Leave_Day_Taken->ID->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Total_Leave_Day_Taken->ID->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Total_Leave_Day_Taken->ID->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for FirstName
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Total_Leave_Day_Taken->FirstName->SqlSelect, $Total_Leave_Day_Taken->SqlWhere(), $Total_Leave_Day_Taken->SqlGroupBy(), $Total_Leave_Day_Taken->SqlHaving(), $Total_Leave_Day_Taken->FirstName->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Total_Leave_Day_Taken->FirstName->setDbValue($rswrk->fields[0]);
			if (is_null($Total_Leave_Day_Taken->FirstName->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Total_Leave_Day_Taken->FirstName->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Total_Leave_Day_Taken->FirstName->ViewValue = $Total_Leave_Day_Taken->FirstName->CurrentValue;
				ewrpt_SetupDistinctValues($Total_Leave_Day_Taken->FirstName->ValueList, $Total_Leave_Day_Taken->FirstName->CurrentValue, $Total_Leave_Day_Taken->FirstName->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Total_Leave_Day_Taken->FirstName->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Total_Leave_Day_Taken->FirstName->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for MiddelName
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Total_Leave_Day_Taken->MiddelName->SqlSelect, $Total_Leave_Day_Taken->SqlWhere(), $Total_Leave_Day_Taken->SqlGroupBy(), $Total_Leave_Day_Taken->SqlHaving(), $Total_Leave_Day_Taken->MiddelName->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Total_Leave_Day_Taken->MiddelName->setDbValue($rswrk->fields[0]);
			if (is_null($Total_Leave_Day_Taken->MiddelName->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Total_Leave_Day_Taken->MiddelName->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Total_Leave_Day_Taken->MiddelName->ViewValue = $Total_Leave_Day_Taken->MiddelName->CurrentValue;
				ewrpt_SetupDistinctValues($Total_Leave_Day_Taken->MiddelName->ValueList, $Total_Leave_Day_Taken->MiddelName->CurrentValue, $Total_Leave_Day_Taken->MiddelName->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Total_Leave_Day_Taken->MiddelName->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Total_Leave_Day_Taken->MiddelName->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for Total Leave Days
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Total_Leave_Day_Taken->Total_Leave_Days->SqlSelect, $Total_Leave_Day_Taken->SqlWhere(), $Total_Leave_Day_Taken->SqlGroupBy(), $Total_Leave_Day_Taken->SqlHaving(), $Total_Leave_Day_Taken->Total_Leave_Days->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Total_Leave_Day_Taken->Total_Leave_Days->setDbValue($rswrk->fields[0]);
			if (is_null($Total_Leave_Day_Taken->Total_Leave_Days->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Total_Leave_Day_Taken->Total_Leave_Days->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Total_Leave_Day_Taken->Total_Leave_Days->ViewValue = $Total_Leave_Day_Taken->Total_Leave_Days->CurrentValue;
				ewrpt_SetupDistinctValues($Total_Leave_Day_Taken->Total_Leave_Days->ValueList, $Total_Leave_Day_Taken->Total_Leave_Days->CurrentValue, $Total_Leave_Day_Taken->Total_Leave_Days->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Total_Leave_Day_Taken->Total_Leave_Days->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Total_Leave_Day_Taken->Total_Leave_Days->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

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
				$this->ClearSessionSelection('YEAR');
				$this->ClearSessionSelection('MONTH');
				$this->ClearSessionSelection('ID');
				$this->ClearSessionSelection('FirstName');
				$this->ClearSessionSelection('MiddelName');
				$this->ClearSessionSelection('Total_Leave_Days');
				$this->ResetPager();
			}
		}

		// Load selection criteria to array
		// Get YEAR selected values

		if (is_array(@$_SESSION["sel_Total_Leave_Day_Taken_YEAR"])) {
			$this->LoadSelectionFromSession('YEAR');
		} elseif (@$_SESSION["sel_Total_Leave_Day_Taken_YEAR"] == EWRPT_INIT_VALUE) { // Select all
			$Total_Leave_Day_Taken->YEAR->SelectionList = "";
		}

		// Get MONTH selected values
		if (is_array(@$_SESSION["sel_Total_Leave_Day_Taken_MONTH"])) {
			$this->LoadSelectionFromSession('MONTH');
		} elseif (@$_SESSION["sel_Total_Leave_Day_Taken_MONTH"] == EWRPT_INIT_VALUE) { // Select all
			$Total_Leave_Day_Taken->MONTH->SelectionList = "";
		}

		// Get ID selected values
		if (is_array(@$_SESSION["sel_Total_Leave_Day_Taken_ID"])) {
			$this->LoadSelectionFromSession('ID');
		} elseif (@$_SESSION["sel_Total_Leave_Day_Taken_ID"] == EWRPT_INIT_VALUE) { // Select all
			$Total_Leave_Day_Taken->ID->SelectionList = "";
		}

		// Get First Name selected values
		if (is_array(@$_SESSION["sel_Total_Leave_Day_Taken_FirstName"])) {
			$this->LoadSelectionFromSession('FirstName');
		} elseif (@$_SESSION["sel_Total_Leave_Day_Taken_FirstName"] == EWRPT_INIT_VALUE) { // Select all
			$Total_Leave_Day_Taken->FirstName->SelectionList = "";
		}

		// Get Middel Name selected values
		if (is_array(@$_SESSION["sel_Total_Leave_Day_Taken_MiddelName"])) {
			$this->LoadSelectionFromSession('MiddelName');
		} elseif (@$_SESSION["sel_Total_Leave_Day_Taken_MiddelName"] == EWRPT_INIT_VALUE) { // Select all
			$Total_Leave_Day_Taken->MiddelName->SelectionList = "";
		}

		// Get Total Leave Days selected values
		if (is_array(@$_SESSION["sel_Total_Leave_Day_Taken_Total_Leave_Days"])) {
			$this->LoadSelectionFromSession('Total_Leave_Days');
		} elseif (@$_SESSION["sel_Total_Leave_Day_Taken_Total_Leave_Days"] == EWRPT_INIT_VALUE) { // Select all
			$Total_Leave_Day_Taken->Total_Leave_Days->SelectionList = "";
		}
	}

	// Reset pager
	function ResetPager() {

		// Reset start position (reset command)
		global $Total_Leave_Day_Taken;
		$this->StartGrp = 1;
		$Total_Leave_Day_Taken->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $Total_Leave_Day_Taken;
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
			$Total_Leave_Day_Taken->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$Total_Leave_Day_Taken->setStartGroup($this->StartGrp);
		} else {
			if ($Total_Leave_Day_Taken->getGroupPerPage() <> "") {
				$this->DisplayGrps = $Total_Leave_Day_Taken->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $Security;
		global $Total_Leave_Day_Taken;
		if ($Total_Leave_Day_Taken->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($Total_Leave_Day_Taken->SqlSelectCount(), $Total_Leave_Day_Taken->SqlWhere(), $Total_Leave_Day_Taken->SqlGroupBy(), $Total_Leave_Day_Taken->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}
		}

		// Call Row_Rendering event
		$Total_Leave_Day_Taken->Row_Rendering();

		/* --------------------
		'  Render view codes
		' --------------------- */
		if ($Total_Leave_Day_Taken->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// YEAR
			$Total_Leave_Day_Taken->YEAR->GroupViewValue = $Total_Leave_Day_Taken->YEAR->GroupOldValue();
			$Total_Leave_Day_Taken->YEAR->CellAttrs["class"] = ($Total_Leave_Day_Taken->RowGroupLevel == 1) ? "ewRptGrpSummary1" : "ewRptGrpField1";
			$Total_Leave_Day_Taken->YEAR->GroupViewValue = ewrpt_DisplayGroupValue($Total_Leave_Day_Taken->YEAR, $Total_Leave_Day_Taken->YEAR->GroupViewValue);

			// MONTH
			$Total_Leave_Day_Taken->MONTH->GroupViewValue = $Total_Leave_Day_Taken->MONTH->GroupOldValue();
			$Total_Leave_Day_Taken->MONTH->CellAttrs["class"] = ($Total_Leave_Day_Taken->RowGroupLevel == 2) ? "ewRptGrpSummary2" : "ewRptGrpField2";
			$Total_Leave_Day_Taken->MONTH->GroupViewValue = ewrpt_DisplayGroupValue($Total_Leave_Day_Taken->MONTH, $Total_Leave_Day_Taken->MONTH->GroupViewValue);

			// ID
			$Total_Leave_Day_Taken->ID->ViewValue = $Total_Leave_Day_Taken->ID->Summary;

			// FirstName
			$Total_Leave_Day_Taken->FirstName->ViewValue = $Total_Leave_Day_Taken->FirstName->Summary;

			// MiddelName
			$Total_Leave_Day_Taken->MiddelName->ViewValue = $Total_Leave_Day_Taken->MiddelName->Summary;

			// Total Leave Days
			$Total_Leave_Day_Taken->Total_Leave_Days->ViewValue = $Total_Leave_Day_Taken->Total_Leave_Days->Summary;
		} else {

			// YEAR
			$Total_Leave_Day_Taken->YEAR->GroupViewValue = $Total_Leave_Day_Taken->YEAR->GroupValue();
			$Total_Leave_Day_Taken->YEAR->CellAttrs["class"] = "ewRptGrpField1";
			$Total_Leave_Day_Taken->YEAR->GroupViewValue = ewrpt_DisplayGroupValue($Total_Leave_Day_Taken->YEAR, $Total_Leave_Day_Taken->YEAR->GroupViewValue);
			if ($Total_Leave_Day_Taken->YEAR->GroupValue() == $Total_Leave_Day_Taken->YEAR->GroupOldValue() && !$this->ChkLvlBreak(1))
				$Total_Leave_Day_Taken->YEAR->GroupViewValue = "&nbsp;";

			// MONTH
			$Total_Leave_Day_Taken->MONTH->GroupViewValue = $Total_Leave_Day_Taken->MONTH->GroupValue();
			$Total_Leave_Day_Taken->MONTH->CellAttrs["class"] = "ewRptGrpField2";
			$Total_Leave_Day_Taken->MONTH->GroupViewValue = ewrpt_DisplayGroupValue($Total_Leave_Day_Taken->MONTH, $Total_Leave_Day_Taken->MONTH->GroupViewValue);
			if ($Total_Leave_Day_Taken->MONTH->GroupValue() == $Total_Leave_Day_Taken->MONTH->GroupOldValue() && !$this->ChkLvlBreak(2))
				$Total_Leave_Day_Taken->MONTH->GroupViewValue = "&nbsp;";

			// ID
			$Total_Leave_Day_Taken->ID->ViewValue = $Total_Leave_Day_Taken->ID->CurrentValue;
			$Total_Leave_Day_Taken->ID->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// FirstName
			$Total_Leave_Day_Taken->FirstName->ViewValue = $Total_Leave_Day_Taken->FirstName->CurrentValue;
			$Total_Leave_Day_Taken->FirstName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// MiddelName
			$Total_Leave_Day_Taken->MiddelName->ViewValue = $Total_Leave_Day_Taken->MiddelName->CurrentValue;
			$Total_Leave_Day_Taken->MiddelName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Total Leave Days
			$Total_Leave_Day_Taken->Total_Leave_Days->ViewValue = $Total_Leave_Day_Taken->Total_Leave_Days->CurrentValue;
			$Total_Leave_Day_Taken->Total_Leave_Days->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// YEAR
		$Total_Leave_Day_Taken->YEAR->HrefValue = "";

		// MONTH
		$Total_Leave_Day_Taken->MONTH->HrefValue = "";

		// ID
		$Total_Leave_Day_Taken->ID->HrefValue = "";

		// FirstName
		$Total_Leave_Day_Taken->FirstName->HrefValue = "";

		// MiddelName
		$Total_Leave_Day_Taken->MiddelName->HrefValue = "";

		// Total Leave Days
		$Total_Leave_Day_Taken->Total_Leave_Days->HrefValue = "";

		// Call Row_Rendered event
		$Total_Leave_Day_Taken->Row_Rendered();
	}

	// Get extended filter values
	function GetExtendedFilterValues() {
		global $Total_Leave_Day_Taken;

		// Field MONTH
		$sSelect = "SELECT DISTINCT `MONTH` FROM " . $Total_Leave_Day_Taken->SqlFrom();
		$sOrderBy = "`MONTH` ASC";
		$wrkSql = ewrpt_BuildReportSql($sSelect, $Total_Leave_Day_Taken->SqlWhere(), "", "", $sOrderBy, $this->UserIDFilter, "");
		$Total_Leave_Day_Taken->MONTH->DropDownList = ewrpt_GetDistinctValues("", $wrkSql);

		// Field YEAR
		$sSelect = "SELECT DISTINCT `YEAR` FROM " . $Total_Leave_Day_Taken->SqlFrom();
		$sOrderBy = "`YEAR` ASC";
		$wrkSql = ewrpt_BuildReportSql($sSelect, $Total_Leave_Day_Taken->SqlWhere(), "", "", $sOrderBy, $this->UserIDFilter, "");
		$Total_Leave_Day_Taken->YEAR->DropDownList = ewrpt_GetDistinctValues("", $wrkSql);
	}

	// Return extended filter
	function GetExtendedFilter() {
		global $Total_Leave_Day_Taken;
		global $gsFormError;
		$sFilter = "";
		$bPostBack = ewrpt_IsHttpPost();
		$bRestoreSession = TRUE;
		$bSetupFilter = FALSE;

		// Reset extended filter if filter changed
		if ($bPostBack) {

			// Clear extended filter for field ID
			if ($this->ClearExtFilter == 'Total_Leave_Day_Taken_ID')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'ID');

			// Clear extended filter for field FirstName
			if ($this->ClearExtFilter == 'Total_Leave_Day_Taken_FirstName')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'FirstName');

			// Clear extended filter for field MiddelName
			if ($this->ClearExtFilter == 'Total_Leave_Day_Taken_MiddelName')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'MiddelName');

			// Clear extended filter for field Total Leave Days
			if ($this->ClearExtFilter == 'Total_Leave_Day_Taken_Total_Leave_Days')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'Total_Leave_Days');

			// Clear dropdown for field MONTH
			if ($this->ClearExtFilter == 'Total_Leave_Day_Taken_MONTH')
				$this->SetSessionDropDownValue(EWRPT_INIT_VALUE, 'MONTH');

			// Clear dropdown for field YEAR
			if ($this->ClearExtFilter == 'Total_Leave_Day_Taken_YEAR')
				$this->SetSessionDropDownValue(EWRPT_INIT_VALUE, 'YEAR');

		// Reset search command
		} elseif (@$_GET["cmd"] == "reset") {

			// Load default values
			// Field ID

			$this->SetSessionFilterValues($Total_Leave_Day_Taken->ID->SearchValue, $Total_Leave_Day_Taken->ID->SearchOperator, $Total_Leave_Day_Taken->ID->SearchCondition, $Total_Leave_Day_Taken->ID->SearchValue2, $Total_Leave_Day_Taken->ID->SearchOperator2, 'ID');

			// Field FirstName
			$this->SetSessionFilterValues($Total_Leave_Day_Taken->FirstName->SearchValue, $Total_Leave_Day_Taken->FirstName->SearchOperator, $Total_Leave_Day_Taken->FirstName->SearchCondition, $Total_Leave_Day_Taken->FirstName->SearchValue2, $Total_Leave_Day_Taken->FirstName->SearchOperator2, 'FirstName');

			// Field MiddelName
			$this->SetSessionFilterValues($Total_Leave_Day_Taken->MiddelName->SearchValue, $Total_Leave_Day_Taken->MiddelName->SearchOperator, $Total_Leave_Day_Taken->MiddelName->SearchCondition, $Total_Leave_Day_Taken->MiddelName->SearchValue2, $Total_Leave_Day_Taken->MiddelName->SearchOperator2, 'MiddelName');

			// Field Total Leave Days
			$this->SetSessionFilterValues($Total_Leave_Day_Taken->Total_Leave_Days->SearchValue, $Total_Leave_Day_Taken->Total_Leave_Days->SearchOperator, $Total_Leave_Day_Taken->Total_Leave_Days->SearchCondition, $Total_Leave_Day_Taken->Total_Leave_Days->SearchValue2, $Total_Leave_Day_Taken->Total_Leave_Days->SearchOperator2, 'Total_Leave_Days');

			// Field MONTH
			$this->SetSessionDropDownValue($Total_Leave_Day_Taken->MONTH->DropDownValue, 'MONTH');

			// Field YEAR
			$this->SetSessionDropDownValue($Total_Leave_Day_Taken->YEAR->DropDownValue, 'YEAR');
			$bSetupFilter = TRUE;
		} else {

			// Field ID
			if ($this->GetFilterValues($Total_Leave_Day_Taken->ID)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field FirstName
			if ($this->GetFilterValues($Total_Leave_Day_Taken->FirstName)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field MiddelName
			if ($this->GetFilterValues($Total_Leave_Day_Taken->MiddelName)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field Total Leave Days
			if ($this->GetFilterValues($Total_Leave_Day_Taken->Total_Leave_Days)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field MONTH
			if ($this->GetDropDownValue($Total_Leave_Day_Taken->MONTH->DropDownValue, 'MONTH')) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			} elseif ($Total_Leave_Day_Taken->MONTH->DropDownValue <> EWRPT_INIT_VALUE && !isset($_SESSION['sv_Total_Leave_Day_Taken->MONTH'])) {
				$bSetupFilter = TRUE;
			}

			// Field YEAR
			if ($this->GetDropDownValue($Total_Leave_Day_Taken->YEAR->DropDownValue, 'YEAR')) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			} elseif ($Total_Leave_Day_Taken->YEAR->DropDownValue <> EWRPT_INIT_VALUE && !isset($_SESSION['sv_Total_Leave_Day_Taken->YEAR'])) {
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
			$this->GetSessionFilterValues($Total_Leave_Day_Taken->ID);

			// Field FirstName
			$this->GetSessionFilterValues($Total_Leave_Day_Taken->FirstName);

			// Field MiddelName
			$this->GetSessionFilterValues($Total_Leave_Day_Taken->MiddelName);

			// Field Total Leave Days
			$this->GetSessionFilterValues($Total_Leave_Day_Taken->Total_Leave_Days);

			// Field MONTH
			$this->GetSessionDropDownValue($Total_Leave_Day_Taken->MONTH);

			// Field YEAR
			$this->GetSessionDropDownValue($Total_Leave_Day_Taken->YEAR);
		}

		// Call page filter validated event
		$Total_Leave_Day_Taken->Page_FilterValidated();

		// Build SQL
		// Field ID

		$this->BuildExtendedFilter($Total_Leave_Day_Taken->ID, $sFilter);

		// Field FirstName
		$this->BuildExtendedFilter($Total_Leave_Day_Taken->FirstName, $sFilter);

		// Field MiddelName
		$this->BuildExtendedFilter($Total_Leave_Day_Taken->MiddelName, $sFilter);

		// Field Total Leave Days
		$this->BuildExtendedFilter($Total_Leave_Day_Taken->Total_Leave_Days, $sFilter);

		// Field MONTH
		$this->BuildDropDownFilter($Total_Leave_Day_Taken->MONTH, $sFilter, "");

		// Field YEAR
		$this->BuildDropDownFilter($Total_Leave_Day_Taken->YEAR, $sFilter, "");

		// Save parms to session
		// Field ID

		$this->SetSessionFilterValues($Total_Leave_Day_Taken->ID->SearchValue, $Total_Leave_Day_Taken->ID->SearchOperator, $Total_Leave_Day_Taken->ID->SearchCondition, $Total_Leave_Day_Taken->ID->SearchValue2, $Total_Leave_Day_Taken->ID->SearchOperator2, 'ID');

		// Field FirstName
		$this->SetSessionFilterValues($Total_Leave_Day_Taken->FirstName->SearchValue, $Total_Leave_Day_Taken->FirstName->SearchOperator, $Total_Leave_Day_Taken->FirstName->SearchCondition, $Total_Leave_Day_Taken->FirstName->SearchValue2, $Total_Leave_Day_Taken->FirstName->SearchOperator2, 'FirstName');

		// Field MiddelName
		$this->SetSessionFilterValues($Total_Leave_Day_Taken->MiddelName->SearchValue, $Total_Leave_Day_Taken->MiddelName->SearchOperator, $Total_Leave_Day_Taken->MiddelName->SearchCondition, $Total_Leave_Day_Taken->MiddelName->SearchValue2, $Total_Leave_Day_Taken->MiddelName->SearchOperator2, 'MiddelName');

		// Field Total Leave Days
		$this->SetSessionFilterValues($Total_Leave_Day_Taken->Total_Leave_Days->SearchValue, $Total_Leave_Day_Taken->Total_Leave_Days->SearchOperator, $Total_Leave_Day_Taken->Total_Leave_Days->SearchCondition, $Total_Leave_Day_Taken->Total_Leave_Days->SearchValue2, $Total_Leave_Day_Taken->Total_Leave_Days->SearchOperator2, 'Total_Leave_Days');

		// Field MONTH
		$this->SetSessionDropDownValue($Total_Leave_Day_Taken->MONTH->DropDownValue, 'MONTH');

		// Field YEAR
		$this->SetSessionDropDownValue($Total_Leave_Day_Taken->YEAR->DropDownValue, 'YEAR');

		// Setup filter
		if ($bSetupFilter) {

			// Field ID
			$sWrk = "";
			$this->BuildExtendedFilter($Total_Leave_Day_Taken->ID, $sWrk);
			$this->LoadSelectionFromFilter($Total_Leave_Day_Taken->ID, $sWrk, $Total_Leave_Day_Taken->ID->SelectionList);
			$_SESSION['sel_Total_Leave_Day_Taken_ID'] = ($Total_Leave_Day_Taken->ID->SelectionList == "") ? EWRPT_INIT_VALUE : $Total_Leave_Day_Taken->ID->SelectionList;

			// Field FirstName
			$sWrk = "";
			$this->BuildExtendedFilter($Total_Leave_Day_Taken->FirstName, $sWrk);
			$this->LoadSelectionFromFilter($Total_Leave_Day_Taken->FirstName, $sWrk, $Total_Leave_Day_Taken->FirstName->SelectionList);
			$_SESSION['sel_Total_Leave_Day_Taken_FirstName'] = ($Total_Leave_Day_Taken->FirstName->SelectionList == "") ? EWRPT_INIT_VALUE : $Total_Leave_Day_Taken->FirstName->SelectionList;

			// Field MiddelName
			$sWrk = "";
			$this->BuildExtendedFilter($Total_Leave_Day_Taken->MiddelName, $sWrk);
			$this->LoadSelectionFromFilter($Total_Leave_Day_Taken->MiddelName, $sWrk, $Total_Leave_Day_Taken->MiddelName->SelectionList);
			$_SESSION['sel_Total_Leave_Day_Taken_MiddelName'] = ($Total_Leave_Day_Taken->MiddelName->SelectionList == "") ? EWRPT_INIT_VALUE : $Total_Leave_Day_Taken->MiddelName->SelectionList;

			// Field Total Leave Days
			$sWrk = "";
			$this->BuildExtendedFilter($Total_Leave_Day_Taken->Total_Leave_Days, $sWrk);
			$this->LoadSelectionFromFilter($Total_Leave_Day_Taken->Total_Leave_Days, $sWrk, $Total_Leave_Day_Taken->Total_Leave_Days->SelectionList);
			$_SESSION['sel_Total_Leave_Day_Taken_Total_Leave_Days'] = ($Total_Leave_Day_Taken->Total_Leave_Days->SelectionList == "") ? EWRPT_INIT_VALUE : $Total_Leave_Day_Taken->Total_Leave_Days->SelectionList;

			// Field MONTH
			$sWrk = "";
			$this->BuildDropDownFilter($Total_Leave_Day_Taken->MONTH, $sWrk, "");
			$this->LoadSelectionFromFilter($Total_Leave_Day_Taken->MONTH, $sWrk, $Total_Leave_Day_Taken->MONTH->SelectionList);
			$_SESSION['sel_Total_Leave_Day_Taken_MONTH'] = ($Total_Leave_Day_Taken->MONTH->SelectionList == "") ? EWRPT_INIT_VALUE : $Total_Leave_Day_Taken->MONTH->SelectionList;

			// Field YEAR
			$sWrk = "";
			$this->BuildDropDownFilter($Total_Leave_Day_Taken->YEAR, $sWrk, "");
			$this->LoadSelectionFromFilter($Total_Leave_Day_Taken->YEAR, $sWrk, $Total_Leave_Day_Taken->YEAR->SelectionList);
			$_SESSION['sel_Total_Leave_Day_Taken_YEAR'] = ($Total_Leave_Day_Taken->YEAR->SelectionList == "") ? EWRPT_INIT_VALUE : $Total_Leave_Day_Taken->YEAR->SelectionList;
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
		$this->GetSessionValue($fld->DropDownValue, 'sv_Total_Leave_Day_Taken_' . $parm);
	}

	// Get filter values from session
	function GetSessionFilterValues(&$fld) {
		$parm = substr($fld->FldVar, 2);
		$this->GetSessionValue($fld->SearchValue, 'sv1_Total_Leave_Day_Taken_' . $parm);
		$this->GetSessionValue($fld->SearchOperator, 'so1_Total_Leave_Day_Taken_' . $parm);
		$this->GetSessionValue($fld->SearchCondition, 'sc_Total_Leave_Day_Taken_' . $parm);
		$this->GetSessionValue($fld->SearchValue2, 'sv2_Total_Leave_Day_Taken_' . $parm);
		$this->GetSessionValue($fld->SearchOperator2, 'so2_Total_Leave_Day_Taken_' . $parm);
	}

	// Get value from session
	function GetSessionValue(&$sv, $sn) {
		if (isset($_SESSION[$sn]))
			$sv = $_SESSION[$sn];
	}

	// Set dropdown value to session
	function SetSessionDropDownValue($sv, $parm) {
		$_SESSION['sv_Total_Leave_Day_Taken_' . $parm] = $sv;
	}

	// Set filter values to session
	function SetSessionFilterValues($sv1, $so1, $sc, $sv2, $so2, $parm) {
		$_SESSION['sv1_Total_Leave_Day_Taken_' . $parm] = $sv1;
		$_SESSION['so1_Total_Leave_Day_Taken_' . $parm] = $so1;
		$_SESSION['sc_Total_Leave_Day_Taken_' . $parm] = $sc;
		$_SESSION['sv2_Total_Leave_Day_Taken_' . $parm] = $sv2;
		$_SESSION['so2_Total_Leave_Day_Taken_' . $parm] = $so2;
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
		global $ReportLanguage, $gsFormError, $Total_Leave_Day_Taken;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EWRPT_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ewrpt_CheckNumber($Total_Leave_Day_Taken->Total_Leave_Days->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Total_Leave_Day_Taken->Total_Leave_Days->FldErrMsg();
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
		$_SESSION["sel_Total_Leave_Day_Taken_$parm"] = "";
		$_SESSION["rf_Total_Leave_Day_Taken_$parm"] = "";
		$_SESSION["rt_Total_Leave_Day_Taken_$parm"] = "";
	}

	// Load selection from session
	function LoadSelectionFromSession($parm) {
		global $Total_Leave_Day_Taken;
		$fld =& $Total_Leave_Day_Taken->fields($parm);
		$fld->SelectionList = @$_SESSION["sel_Total_Leave_Day_Taken_$parm"];
		$fld->RangeFrom = @$_SESSION["rf_Total_Leave_Day_Taken_$parm"];
		$fld->RangeTo = @$_SESSION["rt_Total_Leave_Day_Taken_$parm"];
	}

	// Load default value for filters
	function LoadDefaultFilters() {
		global $Total_Leave_Day_Taken;

		/**
		* Set up default values for non Text filters
		*/

		// Field MONTH
		$Total_Leave_Day_Taken->MONTH->DefaultDropDownValue = EWRPT_INIT_VALUE;
		$Total_Leave_Day_Taken->MONTH->DropDownValue = $Total_Leave_Day_Taken->MONTH->DefaultDropDownValue;
		$sWrk = "";
		$this->BuildDropDownFilter($Total_Leave_Day_Taken->MONTH, $sWrk, "");
		$this->LoadSelectionFromFilter($Total_Leave_Day_Taken->MONTH, $sWrk, $Total_Leave_Day_Taken->MONTH->DefaultSelectionList);

		// Field YEAR
		$Total_Leave_Day_Taken->YEAR->DefaultDropDownValue = EWRPT_INIT_VALUE;
		$Total_Leave_Day_Taken->YEAR->DropDownValue = $Total_Leave_Day_Taken->YEAR->DefaultDropDownValue;
		$sWrk = "";
		$this->BuildDropDownFilter($Total_Leave_Day_Taken->YEAR, $sWrk, "");
		$this->LoadSelectionFromFilter($Total_Leave_Day_Taken->YEAR, $sWrk, $Total_Leave_Day_Taken->YEAR->DefaultSelectionList);

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
		$this->SetDefaultExtFilter($Total_Leave_Day_Taken->ID, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Total_Leave_Day_Taken->ID);
		$sWrk = "";
		$this->BuildExtendedFilter($Total_Leave_Day_Taken->ID, $sWrk);
		$this->LoadSelectionFromFilter($Total_Leave_Day_Taken->ID, $sWrk, $Total_Leave_Day_Taken->ID->DefaultSelectionList);
		$Total_Leave_Day_Taken->ID->SelectionList = $Total_Leave_Day_Taken->ID->DefaultSelectionList;

		// Field FirstName
		$this->SetDefaultExtFilter($Total_Leave_Day_Taken->FirstName, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Total_Leave_Day_Taken->FirstName);
		$sWrk = "";
		$this->BuildExtendedFilter($Total_Leave_Day_Taken->FirstName, $sWrk);
		$this->LoadSelectionFromFilter($Total_Leave_Day_Taken->FirstName, $sWrk, $Total_Leave_Day_Taken->FirstName->DefaultSelectionList);
		$Total_Leave_Day_Taken->FirstName->SelectionList = $Total_Leave_Day_Taken->FirstName->DefaultSelectionList;

		// Field MiddelName
		$this->SetDefaultExtFilter($Total_Leave_Day_Taken->MiddelName, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Total_Leave_Day_Taken->MiddelName);
		$sWrk = "";
		$this->BuildExtendedFilter($Total_Leave_Day_Taken->MiddelName, $sWrk);
		$this->LoadSelectionFromFilter($Total_Leave_Day_Taken->MiddelName, $sWrk, $Total_Leave_Day_Taken->MiddelName->DefaultSelectionList);
		$Total_Leave_Day_Taken->MiddelName->SelectionList = $Total_Leave_Day_Taken->MiddelName->DefaultSelectionList;

		// Field Total Leave Days
		$this->SetDefaultExtFilter($Total_Leave_Day_Taken->Total_Leave_Days, "=", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Total_Leave_Day_Taken->Total_Leave_Days);
		$sWrk = "";
		$this->BuildExtendedFilter($Total_Leave_Day_Taken->Total_Leave_Days, $sWrk);
		$this->LoadSelectionFromFilter($Total_Leave_Day_Taken->Total_Leave_Days, $sWrk, $Total_Leave_Day_Taken->Total_Leave_Days->DefaultSelectionList);
		$Total_Leave_Day_Taken->Total_Leave_Days->SelectionList = $Total_Leave_Day_Taken->Total_Leave_Days->DefaultSelectionList;

		/**
		* Set up default values for popup filters
		* NOTE: if extended filter is enabled, use default values in extended filter instead
		*/
	}

	// Check if filter applied
	function CheckFilter() {
		global $Total_Leave_Day_Taken;

		// Check ID text filter
		if ($this->TextFilterApplied($Total_Leave_Day_Taken->ID))
			return TRUE;

		// Check ID popup filter
		if (!ewrpt_MatchedArray($Total_Leave_Day_Taken->ID->DefaultSelectionList, $Total_Leave_Day_Taken->ID->SelectionList))
			return TRUE;

		// Check FirstName text filter
		if ($this->TextFilterApplied($Total_Leave_Day_Taken->FirstName))
			return TRUE;

		// Check FirstName popup filter
		if (!ewrpt_MatchedArray($Total_Leave_Day_Taken->FirstName->DefaultSelectionList, $Total_Leave_Day_Taken->FirstName->SelectionList))
			return TRUE;

		// Check MiddelName text filter
		if ($this->TextFilterApplied($Total_Leave_Day_Taken->MiddelName))
			return TRUE;

		// Check MiddelName popup filter
		if (!ewrpt_MatchedArray($Total_Leave_Day_Taken->MiddelName->DefaultSelectionList, $Total_Leave_Day_Taken->MiddelName->SelectionList))
			return TRUE;

		// Check Total Leave Days text filter
		if ($this->TextFilterApplied($Total_Leave_Day_Taken->Total_Leave_Days))
			return TRUE;

		// Check Total Leave Days popup filter
		if (!ewrpt_MatchedArray($Total_Leave_Day_Taken->Total_Leave_Days->DefaultSelectionList, $Total_Leave_Day_Taken->Total_Leave_Days->SelectionList))
			return TRUE;

		// Check MONTH extended filter
		if ($this->NonTextFilterApplied($Total_Leave_Day_Taken->MONTH))
			return TRUE;

		// Check MONTH popup filter
		if (!ewrpt_MatchedArray($Total_Leave_Day_Taken->MONTH->DefaultSelectionList, $Total_Leave_Day_Taken->MONTH->SelectionList))
			return TRUE;

		// Check YEAR extended filter
		if ($this->NonTextFilterApplied($Total_Leave_Day_Taken->YEAR))
			return TRUE;

		// Check YEAR popup filter
		if (!ewrpt_MatchedArray($Total_Leave_Day_Taken->YEAR->DefaultSelectionList, $Total_Leave_Day_Taken->YEAR->SelectionList))
			return TRUE;
		return FALSE;
	}

	// Show list of filters
	function ShowFilterList() {
		global $Total_Leave_Day_Taken;
		global $ReportLanguage;

		// Initialize
		$sFilterList = "";

		// Field ID
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Total_Leave_Day_Taken->ID, $sExtWrk);
		if (is_array($Total_Leave_Day_Taken->ID->SelectionList))
			$sWrk = ewrpt_JoinArray($Total_Leave_Day_Taken->ID->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Total_Leave_Day_Taken->ID->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field FirstName
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Total_Leave_Day_Taken->FirstName, $sExtWrk);
		if (is_array($Total_Leave_Day_Taken->FirstName->SelectionList))
			$sWrk = ewrpt_JoinArray($Total_Leave_Day_Taken->FirstName->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Total_Leave_Day_Taken->FirstName->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field MiddelName
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Total_Leave_Day_Taken->MiddelName, $sExtWrk);
		if (is_array($Total_Leave_Day_Taken->MiddelName->SelectionList))
			$sWrk = ewrpt_JoinArray($Total_Leave_Day_Taken->MiddelName->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Total_Leave_Day_Taken->MiddelName->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Total Leave Days
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Total_Leave_Day_Taken->Total_Leave_Days, $sExtWrk);
		if (is_array($Total_Leave_Day_Taken->Total_Leave_Days->SelectionList))
			$sWrk = ewrpt_JoinArray($Total_Leave_Day_Taken->Total_Leave_Days->SelectionList, ", ", EWRPT_DATATYPE_NUMBER);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Total_Leave_Day_Taken->Total_Leave_Days->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field MONTH
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildDropDownFilter($Total_Leave_Day_Taken->MONTH, $sExtWrk, "");
		if (is_array($Total_Leave_Day_Taken->MONTH->SelectionList))
			$sWrk = ewrpt_JoinArray($Total_Leave_Day_Taken->MONTH->SelectionList, ", ", EWRPT_DATATYPE_NUMBER);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Total_Leave_Day_Taken->MONTH->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field YEAR
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildDropDownFilter($Total_Leave_Day_Taken->YEAR, $sExtWrk, "");
		if (is_array($Total_Leave_Day_Taken->YEAR->SelectionList))
			$sWrk = ewrpt_JoinArray($Total_Leave_Day_Taken->YEAR->SelectionList, ", ", EWRPT_DATATYPE_NUMBER);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Total_Leave_Day_Taken->YEAR->FldCaption() . "<br />";
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
		global $Total_Leave_Day_Taken;
		$sWrk = "";
		if (!$this->ExtendedFilterExist($Total_Leave_Day_Taken->ID)) {
			if (is_array($Total_Leave_Day_Taken->ID->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Total_Leave_Day_Taken->ID, "`ID`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Total_Leave_Day_Taken->FirstName)) {
			if (is_array($Total_Leave_Day_Taken->FirstName->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Total_Leave_Day_Taken->FirstName, "`FirstName`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Total_Leave_Day_Taken->MiddelName)) {
			if (is_array($Total_Leave_Day_Taken->MiddelName->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Total_Leave_Day_Taken->MiddelName, "`MiddelName`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Total_Leave_Day_Taken->Total_Leave_Days)) {
			if (is_array($Total_Leave_Day_Taken->Total_Leave_Days->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Total_Leave_Day_Taken->Total_Leave_Days, "`Total Leave Days`", EWRPT_DATATYPE_NUMBER);
			}
		}
		if (!$this->DropDownFilterExist($Total_Leave_Day_Taken->MONTH, "")) {
			if (is_array($Total_Leave_Day_Taken->MONTH->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Total_Leave_Day_Taken->MONTH, "`MONTH`", EWRPT_DATATYPE_NUMBER);
			}
		}
		if (!$this->DropDownFilterExist($Total_Leave_Day_Taken->YEAR, "")) {
			if (is_array($Total_Leave_Day_Taken->YEAR->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Total_Leave_Day_Taken->YEAR, "`YEAR`", EWRPT_DATATYPE_NUMBER);
			}
		}
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $Total_Leave_Day_Taken;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$Total_Leave_Day_Taken->setOrderBy("");
				$Total_Leave_Day_Taken->setStartGroup(1);
				$Total_Leave_Day_Taken->YEAR->setSort("");
				$Total_Leave_Day_Taken->MONTH->setSort("");
				$Total_Leave_Day_Taken->ID->setSort("");
				$Total_Leave_Day_Taken->FirstName->setSort("");
				$Total_Leave_Day_Taken->MiddelName->setSort("");
				$Total_Leave_Day_Taken->Total_Leave_Days->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$Total_Leave_Day_Taken->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$Total_Leave_Day_Taken->CurrentOrderType = @$_GET["ordertype"];
			$sSortSql = $Total_Leave_Day_Taken->SortSql();
			$Total_Leave_Day_Taken->setOrderBy($sSortSql);
			$Total_Leave_Day_Taken->setStartGroup(1);
		}

		// Set up default sort
		if ($Total_Leave_Day_Taken->getOrderBy() == "") {
			$Total_Leave_Day_Taken->setOrderBy("`ID` ASC");
			$Total_Leave_Day_Taken->ID->setSort("ASC");
		}
		return $Total_Leave_Day_Taken->getOrderBy();
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
