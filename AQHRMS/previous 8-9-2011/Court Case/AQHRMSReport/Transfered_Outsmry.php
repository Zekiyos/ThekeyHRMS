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
$Transfered_Out = NULL;

//
// Table class for Transfered Out
//
class crTransfered_Out {
	var $TableVar = 'Transfered_Out';
	var $TableName = 'Transfered Out';
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
	function crTransfered_Out() {
		global $ReportLanguage;

		// Auto_ID
		$this->Auto_ID = new crField('Transfered_Out', 'Transfered Out', 'x_Auto_ID', 'Auto_ID', '`Auto_ID`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->Auto_ID->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['Auto_ID'] =& $this->Auto_ID;
		$this->Auto_ID->DateFilter = "";
		$this->Auto_ID->SqlSelect = "";
		$this->Auto_ID->SqlOrderBy = "";
		$this->Auto_ID->FldGroupByType = "";
		$this->Auto_ID->FldGroupInt = "0";
		$this->Auto_ID->FldGroupSql = "";

		// ID
		$this->ID = new crField('Transfered_Out', 'Transfered Out', 'x_ID', 'ID', '`ID`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['ID'] =& $this->ID;
		$this->ID->DateFilter = "";
		$this->ID->SqlSelect = "SELECT DISTINCT `ID` FROM " . $this->SqlFrom();
		$this->ID->SqlOrderBy = "`ID`";
		$this->ID->FldGroupByType = "";
		$this->ID->FldGroupInt = "0";
		$this->ID->FldGroupSql = "";

		// FirstName
		$this->FirstName = new crField('Transfered_Out', 'Transfered Out', 'x_FirstName', 'FirstName', '`FirstName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['FirstName'] =& $this->FirstName;
		$this->FirstName->DateFilter = "";
		$this->FirstName->SqlSelect = "SELECT DISTINCT `FirstName` FROM " . $this->SqlFrom();
		$this->FirstName->SqlOrderBy = "`FirstName`";
		$this->FirstName->FldGroupByType = "";
		$this->FirstName->FldGroupInt = "0";
		$this->FirstName->FldGroupSql = "";

		// MiddelName
		$this->MiddelName = new crField('Transfered_Out', 'Transfered Out', 'x_MiddelName', 'MiddelName', '`MiddelName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['MiddelName'] =& $this->MiddelName;
		$this->MiddelName->DateFilter = "";
		$this->MiddelName->SqlSelect = "SELECT DISTINCT `MiddelName` FROM " . $this->SqlFrom();
		$this->MiddelName->SqlOrderBy = "`MiddelName`";
		$this->MiddelName->FldGroupByType = "";
		$this->MiddelName->FldGroupInt = "0";
		$this->MiddelName->FldGroupSql = "";

		// LastName
		$this->LastName = new crField('Transfered_Out', 'Transfered Out', 'x_LastName', 'LastName', '`LastName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['LastName'] =& $this->LastName;
		$this->LastName->DateFilter = "";
		$this->LastName->SqlSelect = "SELECT DISTINCT `LastName` FROM " . $this->SqlFrom();
		$this->LastName->SqlOrderBy = "`LastName`";
		$this->LastName->FldGroupByType = "";
		$this->LastName->FldGroupInt = "0";
		$this->LastName->FldGroupSql = "";

		// Position
		$this->Position = new crField('Transfered_Out', 'Transfered Out', 'x_Position', 'Position', '`Position`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Position'] =& $this->Position;
		$this->Position->DateFilter = "";
		$this->Position->SqlSelect = "SELECT DISTINCT `Position` FROM " . $this->SqlFrom();
		$this->Position->SqlOrderBy = "`Position`";
		$this->Position->FldGroupByType = "";
		$this->Position->FldGroupInt = "0";
		$this->Position->FldGroupSql = "";

		// FromDepartment
		$this->FromDepartment = new crField('Transfered_Out', 'Transfered Out', 'x_FromDepartment', 'FromDepartment', '`FromDepartment`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->FromDepartment->GroupingFieldId = 1;
		$this->fields['FromDepartment'] =& $this->FromDepartment;
		$this->FromDepartment->DateFilter = "";
		$this->FromDepartment->SqlSelect = "SELECT DISTINCT `FromDepartment` FROM " . $this->SqlFrom();
		$this->FromDepartment->SqlOrderBy = "`FromDepartment`";
		$this->FromDepartment->FldGroupByType = "";
		$this->FromDepartment->FldGroupInt = "0";
		$this->FromDepartment->FldGroupSql = "";

		// ToDepartment
		$this->ToDepartment = new crField('Transfered_Out', 'Transfered Out', 'x_ToDepartment', 'ToDepartment', '`ToDepartment`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['ToDepartment'] =& $this->ToDepartment;
		$this->ToDepartment->DateFilter = "";
		$this->ToDepartment->SqlSelect = "SELECT DISTINCT `ToDepartment` FROM " . $this->SqlFrom();
		$this->ToDepartment->SqlOrderBy = "`ToDepartment`";
		$this->ToDepartment->FldGroupByType = "";
		$this->ToDepartment->FldGroupInt = "0";
		$this->ToDepartment->FldGroupSql = "";

		// Position_AfterTransfered
		$this->Position_AfterTransfered = new crField('Transfered_Out', 'Transfered Out', 'x_Position_AfterTransfered', 'Position_AfterTransfered', '`Position_AfterTransfered`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Position_AfterTransfered'] =& $this->Position_AfterTransfered;
		$this->Position_AfterTransfered->DateFilter = "";
		$this->Position_AfterTransfered->SqlSelect = "SELECT DISTINCT `Position_AfterTransfered` FROM " . $this->SqlFrom();
		$this->Position_AfterTransfered->SqlOrderBy = "`Position_AfterTransfered`";
		$this->Position_AfterTransfered->FldGroupByType = "";
		$this->Position_AfterTransfered->FldGroupInt = "0";
		$this->Position_AfterTransfered->FldGroupSql = "";

		// Transfered_Date
		$this->Transfered_Date = new crField('Transfered_Out', 'Transfered Out', 'x_Transfered_Date', 'Transfered_Date', '`Transfered_Date`', 133, EWRPT_DATATYPE_DATE, 5);
		$this->Transfered_Date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateYMD"));
		$this->fields['Transfered_Date'] =& $this->Transfered_Date;
		$this->Transfered_Date->DateFilter = "";
		$this->Transfered_Date->SqlSelect = "";
		$this->Transfered_Date->SqlOrderBy = "";
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
		return "`FromDepartment` ASC";
	}

	// Table Level Group SQL
	function SqlFirstGroupField() {
		return "`FromDepartment`";
	}

	function SqlSelectGroup() {
		return "SELECT DISTINCT " . $this->SqlFirstGroupField() . " AS `FromDepartment` FROM " . $this->SqlFrom();
	}

	function SqlOrderByGroup() {
		return "`FromDepartment` ASC";
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
$Transfered_Out_summary = new crTransfered_Out_summary();
$Page =& $Transfered_Out_summary;

// Page init
$Transfered_Out_summary->Page_Init();

// Page main
$Transfered_Out_summary->Page_Main();
?>
<?php include "phprptinc/header.php"; ?>
<?php if ($Transfered_Out->Export == "") { ?>
<script type="text/javascript">

// Create page object
var Transfered_Out_summary = new ewrpt_Page("Transfered_Out_summary");

// page properties
Transfered_Out_summary.PageID = "summary"; // page ID
Transfered_Out_summary.FormID = "fTransfered_Outsummaryfilter"; // form ID
var EWRPT_PAGE_ID = Transfered_Out_summary.PageID;

// extend page with ValidateForm function
Transfered_Out_summary.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var elm = fobj.sv1_Transfered_Date;
	if (elm && !ewrpt_CheckDate(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Transfered_Out->Transfered_Date->FldErrMsg()) ?>"))
			return false;
	}

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj)) return false;
	return true;
}

// extend page with Form_CustomValidate function
Transfered_Out_summary.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EWRPT_CLIENT_VALIDATE) { ?>
Transfered_Out_summary.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
Transfered_Out_summary.ValidateRequired = false; // no JavaScript validation
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
<?php $Transfered_Out_summary->ShowPageHeader(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php $Transfered_Out_summary->ShowMessage(); ?>
<?php if ($Transfered_Out->Export == "" || $Transfered_Out->Export == "print" || $Transfered_Out->Export == "email") { ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php } ?>
<?php if ($Transfered_Out->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
<?php $jsdata = ewrpt_GetJsData($Transfered_Out->FromDepartment, $Transfered_Out->FromDepartment->FldType); ?>
ewrpt_CreatePopup("Transfered_Out_FromDepartment", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Transfered_Out->ID, $Transfered_Out->ID->FldType); ?>
ewrpt_CreatePopup("Transfered_Out_ID", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Transfered_Out->FirstName, $Transfered_Out->FirstName->FldType); ?>
ewrpt_CreatePopup("Transfered_Out_FirstName", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Transfered_Out->MiddelName, $Transfered_Out->MiddelName->FldType); ?>
ewrpt_CreatePopup("Transfered_Out_MiddelName", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Transfered_Out->LastName, $Transfered_Out->LastName->FldType); ?>
ewrpt_CreatePopup("Transfered_Out_LastName", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Transfered_Out->Position, $Transfered_Out->Position->FldType); ?>
ewrpt_CreatePopup("Transfered_Out_Position", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Transfered_Out->ToDepartment, $Transfered_Out->ToDepartment->FldType); ?>
ewrpt_CreatePopup("Transfered_Out_ToDepartment", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Transfered_Out->Position_AfterTransfered, $Transfered_Out->Position_AfterTransfered->FldType); ?>
ewrpt_CreatePopup("Transfered_Out_Position_AfterTransfered", [<?php echo $jsdata ?>]);
</script>
<div id="Transfered_Out_FromDepartment_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Transfered_Out_ID_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Transfered_Out_FirstName_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Transfered_Out_MiddelName_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Transfered_Out_LastName_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Transfered_Out_Position_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Transfered_Out_ToDepartment_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Transfered_Out_Position_AfterTransfered_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<?php } ?>
<?php if ($Transfered_Out->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<?php if ($Transfered_Out->Export == "" || $Transfered_Out->Export == "print" || $Transfered_Out->Export == "email") { ?>
<?php } ?>
<?php echo $Transfered_Out->TableCaption() ?>
<?php if ($Transfered_Out->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $Transfered_Out_summary->ExportPrintUrl ?>"><?php echo $ReportLanguage->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $Transfered_Out_summary->ExportExcelUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $Transfered_Out_summary->ExportWordUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToWord") ?></a>
<?php if ($Transfered_Out_summary->FilterApplied) { ?>
&nbsp;&nbsp;<a href="Transfered_Outsmry.php?cmd=reset"><?php echo $ReportLanguage->Phrase("ResetAllFilter") ?></a>
<?php } ?>
<?php } ?>
<br /><br />
<?php if ($Transfered_Out->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($Transfered_Out->Export == "" || $Transfered_Out->Export == "print" || $Transfered_Out->Export == "email") { ?>
<?php } ?>
<?php if ($Transfered_Out->Export == "") { ?>
	</div></td>
	<!-- Left Container (End) -->
	<!-- Center Container - Report (Begin) -->
	<td style="vertical-align: top;" class="ewPadding"><div id="ewCenter" class="phpreportmaker">
	<!-- center slot -->
<?php } ?>
<!-- summary report starts -->
<div id="report_summary">
<?php if ($Transfered_Out->Export == "") { ?>
<?php
if ($Transfered_Out->FilterPanelOption == 2 || ($Transfered_Out->FilterPanelOption == 3 && $Transfered_Out_summary->FilterApplied) || $Transfered_Out_summary->Filter == "0=101") {
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
<form name="fTransfered_Outsummaryfilter" id="fTransfered_Outsummaryfilter" action="Transfered_Outsmry.php" class="ewForm" onsubmit="return Transfered_Out_summary.ValidateForm(this);">
<table class="ewRptExtFilter">
	<tr>
		<td><span class="phpreportmaker"><?php echo $Transfered_Out->ID->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_ID" id="so1_ID" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_ID" id="sv1_ID" size="30" maxlength="7" value="<?php echo ewrpt_HtmlEncode($Transfered_Out->ID->SearchValue) ?>"<?php echo ($Transfered_Out_summary->ClearExtFilter == 'Transfered_Out_ID') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Transfered_Out->FirstName->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_FirstName" id="so1_FirstName" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_FirstName" id="sv1_FirstName" size="30" maxlength="20" value="<?php echo ewrpt_HtmlEncode($Transfered_Out->FirstName->SearchValue) ?>"<?php echo ($Transfered_Out_summary->ClearExtFilter == 'Transfered_Out_FirstName') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Transfered_Out->MiddelName->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_MiddelName" id="so1_MiddelName" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_MiddelName" id="sv1_MiddelName" size="30" maxlength="20" value="<?php echo ewrpt_HtmlEncode($Transfered_Out->MiddelName->SearchValue) ?>"<?php echo ($Transfered_Out_summary->ClearExtFilter == 'Transfered_Out_MiddelName') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Transfered_Out->LastName->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_LastName" id="so1_LastName" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_LastName" id="sv1_LastName" size="30" maxlength="20" value="<?php echo ewrpt_HtmlEncode($Transfered_Out->LastName->SearchValue) ?>"<?php echo ($Transfered_Out_summary->ClearExtFilter == 'Transfered_Out_LastName') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Transfered_Out->Position->FldCaption() ?></span></td>
		<td></td>
		<td colspan="4"><span class="ewRptSearchOpr">
		<select name="sv_Position[]" id="sv_Position[]" multiple<?php echo ($Transfered_Out_summary->ClearExtFilter == 'Transfered_Out_Position') ? " class=\"ewInputCleared\"" : "" ?>>
		<option value="<?php echo EWRPT_ALL_VALUE; ?>"<?php if (ewrpt_MatchedFilterValue($Transfered_Out->Position->DropDownValue, EWRPT_ALL_VALUE)) echo " selected=\"selected\""; ?>><?php echo $ReportLanguage->Phrase("SelectAll"); ?></option>
<?php

// Popup filter
$cntf = is_array($Transfered_Out->Position->CustomFilters) ? count($Transfered_Out->Position->CustomFilters) : 0;
$cntd = is_array($Transfered_Out->Position->DropDownList) ? count($Transfered_Out->Position->DropDownList) : 0;
$totcnt = $cntf + $cntd;
$wrkcnt = 0;
	for ($i = 0; $i < $cntf; $i++) {
		if ($Transfered_Out->Position->CustomFilters[$i]->FldName == 'Position') {
?>
		<option value="<?php echo "@@" . $Transfered_Out->Position->CustomFilters[$i]->FilterName ?>"<?php if (ewrpt_MatchedFilterValue($Transfered_Out->Position->DropDownValue, "@@" . $Transfered_Out->Position->CustomFilters[$i]->FilterName)) echo " selected=\"selected\"" ?>><?php echo $Transfered_Out->Position->CustomFilters[$i]->DisplayName ?></option>
<?php
		}
		$wrkcnt += 1;
	}

//}
	for ($i = 0; $i < $cntd; $i++) {
?>
		<option value="<?php echo $Transfered_Out->Position->DropDownList[$i] ?>"<?php if (ewrpt_MatchedFilterValue($Transfered_Out->Position->DropDownValue, $Transfered_Out->Position->DropDownList[$i])) echo " selected=\"selected\"" ?>><?php echo ewrpt_DropDownDisplayValue($Transfered_Out->Position->DropDownList[$i], "", 0) ?></option>
<?php
		$wrkcnt += 1;
	}

//}
?>
		</select>
		</span></td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Transfered_Out->FromDepartment->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_FromDepartment" id="so1_FromDepartment" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_FromDepartment" id="sv1_FromDepartment" size="30" maxlength="50" value="<?php echo ewrpt_HtmlEncode($Transfered_Out->FromDepartment->SearchValue) ?>"<?php echo ($Transfered_Out_summary->ClearExtFilter == 'Transfered_Out_FromDepartment') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Transfered_Out->Transfered_Date->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><select name="so1_Transfered_Date" id="so1_Transfered_Date" onchange="ewrpt_SrchOprChanged('so1_Transfered_Date')"><option value="="<?php if ($Transfered_Out->Transfered_Date->SearchOperator == "=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("="); ?></option><option value="<>"<?php if ($Transfered_Out->Transfered_Date->SearchOperator == "<>") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<>"); ?></option><option value="<"<?php if ($Transfered_Out->Transfered_Date->SearchOperator == "<") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<"); ?></option><option value="<="<?php if ($Transfered_Out->Transfered_Date->SearchOperator == "<=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<="); ?></option><option value=">"<?php if ($Transfered_Out->Transfered_Date->SearchOperator == ">") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase(">"); ?></option><option value=">="<?php if ($Transfered_Out->Transfered_Date->SearchOperator == ">=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase(">="); ?></option><option value="BETWEEN"<?php if ($Transfered_Out->Transfered_Date->SearchOperator == "BETWEEN") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("BETWEEN"); ?></option></select></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_Transfered_Date" id="sv1_Transfered_Date" value="<?php echo ewrpt_HtmlEncode($Transfered_Out->Transfered_Date->SearchValue) ?>"<?php echo ($Transfered_Out_summary->ClearExtFilter == 'Transfered_Out_Transfered_Date') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
				<td><span class="ewRptSearchOpr" style="display: none" id="btw1_Transfered_Date" name="btw1_Transfered_Date">&nbsp;<?php echo $ReportLanguage->Phrase("AND") ?>&nbsp;</span></td>
				<td><span class="phpreportmaker" style="display: none" id="btw1_Transfered_Date" name="btw1_Transfered_Date">
<input type="text" name="sv2_Transfered_Date" id="sv2_Transfered_Date" value="<?php echo ewrpt_HtmlEncode($Transfered_Out->Transfered_Date->SearchValue2) ?>"<?php echo ($Transfered_Out_summary->ClearExtFilter == 'Transfered_Out_Transfered_Date') ? " class=\"ewInputCleared\"" : "" ?>>
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
<?php if ($Transfered_Out->ShowCurrentFilter) { ?>
<div id="ewrptFilterList">
<?php $Transfered_Out_summary->ShowFilterList() ?>
</div>
<br />
<?php } ?>
<table class="ewGrid" cellspacing="0"><tr>
	<td class="ewGridContent">
<?php if ($Transfered_Out->Export == "") { ?>
<div class="ewGridUpperPanel">
<form action="Transfered_Outsmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($Transfered_Out_summary->StartGrp, $Transfered_Out_summary->DisplayGrps, $Transfered_Out_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="Transfered_Outsmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="Transfered_Outsmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="Transfered_Outsmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="Transfered_Outsmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($Transfered_Out_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($Transfered_Out_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($Transfered_Out_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($Transfered_Out_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($Transfered_Out_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($Transfered_Out_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($Transfered_Out_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($Transfered_Out_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($Transfered_Out_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($Transfered_Out_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($Transfered_Out->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
if ($Transfered_Out->ExportAll && $Transfered_Out->Export <> "") {
	$Transfered_Out_summary->StopGrp = $Transfered_Out_summary->TotalGrps;
} else {
	$Transfered_Out_summary->StopGrp = $Transfered_Out_summary->StartGrp + $Transfered_Out_summary->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($Transfered_Out_summary->StopGrp) > intval($Transfered_Out_summary->TotalGrps))
	$Transfered_Out_summary->StopGrp = $Transfered_Out_summary->TotalGrps;
$Transfered_Out_summary->RecCount = 0;

// Get first row
if ($Transfered_Out_summary->TotalGrps > 0) {
	$Transfered_Out_summary->GetGrpRow(1);
	$Transfered_Out_summary->GrpCount = 1;
}
while (($rsgrp && !$rsgrp->EOF && $Transfered_Out_summary->GrpCount <= $Transfered_Out_summary->DisplayGrps) || $Transfered_Out_summary->ShowFirstHeader) {

	// Show header
	if ($Transfered_Out_summary->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Transfered_Out->SortUrl($Transfered_Out->FromDepartment) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Transfered_Out->FromDepartment->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Transfered_Out->SortUrl($Transfered_Out->FromDepartment) ?>',0);"><?php echo $Transfered_Out->FromDepartment->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Transfered_Out->FromDepartment->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Transfered_Out->FromDepartment->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Transfered_Out->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Transfered_Out_FromDepartment', false, '<?php echo $Transfered_Out->FromDepartment->RangeFrom; ?>', '<?php echo $Transfered_Out->FromDepartment->RangeTo; ?>');return false;" name="x_FromDepartment<?php echo $Transfered_Out_summary->Cnt[0][0]; ?>" id="x_FromDepartment<?php echo $Transfered_Out_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Transfered_Out->SortUrl($Transfered_Out->Auto_ID) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Transfered_Out->Auto_ID->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Transfered_Out->SortUrl($Transfered_Out->Auto_ID) ?>',0);"><?php echo $Transfered_Out->Auto_ID->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Transfered_Out->Auto_ID->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Transfered_Out->Auto_ID->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Transfered_Out->SortUrl($Transfered_Out->ID) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Transfered_Out->ID->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Transfered_Out->SortUrl($Transfered_Out->ID) ?>',0);"><?php echo $Transfered_Out->ID->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Transfered_Out->ID->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Transfered_Out->ID->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Transfered_Out->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Transfered_Out_ID', false, '<?php echo $Transfered_Out->ID->RangeFrom; ?>', '<?php echo $Transfered_Out->ID->RangeTo; ?>');return false;" name="x_ID<?php echo $Transfered_Out_summary->Cnt[0][0]; ?>" id="x_ID<?php echo $Transfered_Out_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Transfered_Out->SortUrl($Transfered_Out->FirstName) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Transfered_Out->FirstName->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Transfered_Out->SortUrl($Transfered_Out->FirstName) ?>',0);"><?php echo $Transfered_Out->FirstName->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Transfered_Out->FirstName->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Transfered_Out->FirstName->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Transfered_Out->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Transfered_Out_FirstName', false, '<?php echo $Transfered_Out->FirstName->RangeFrom; ?>', '<?php echo $Transfered_Out->FirstName->RangeTo; ?>');return false;" name="x_FirstName<?php echo $Transfered_Out_summary->Cnt[0][0]; ?>" id="x_FirstName<?php echo $Transfered_Out_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Transfered_Out->SortUrl($Transfered_Out->MiddelName) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Transfered_Out->MiddelName->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Transfered_Out->SortUrl($Transfered_Out->MiddelName) ?>',0);"><?php echo $Transfered_Out->MiddelName->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Transfered_Out->MiddelName->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Transfered_Out->MiddelName->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Transfered_Out->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Transfered_Out_MiddelName', false, '<?php echo $Transfered_Out->MiddelName->RangeFrom; ?>', '<?php echo $Transfered_Out->MiddelName->RangeTo; ?>');return false;" name="x_MiddelName<?php echo $Transfered_Out_summary->Cnt[0][0]; ?>" id="x_MiddelName<?php echo $Transfered_Out_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Transfered_Out->SortUrl($Transfered_Out->LastName) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Transfered_Out->LastName->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Transfered_Out->SortUrl($Transfered_Out->LastName) ?>',0);"><?php echo $Transfered_Out->LastName->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Transfered_Out->LastName->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Transfered_Out->LastName->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Transfered_Out->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Transfered_Out_LastName', false, '<?php echo $Transfered_Out->LastName->RangeFrom; ?>', '<?php echo $Transfered_Out->LastName->RangeTo; ?>');return false;" name="x_LastName<?php echo $Transfered_Out_summary->Cnt[0][0]; ?>" id="x_LastName<?php echo $Transfered_Out_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Transfered_Out->SortUrl($Transfered_Out->Position) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Transfered_Out->Position->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Transfered_Out->SortUrl($Transfered_Out->Position) ?>',0);"><?php echo $Transfered_Out->Position->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Transfered_Out->Position->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Transfered_Out->Position->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Transfered_Out->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Transfered_Out_Position', false, '<?php echo $Transfered_Out->Position->RangeFrom; ?>', '<?php echo $Transfered_Out->Position->RangeTo; ?>');return false;" name="x_Position<?php echo $Transfered_Out_summary->Cnt[0][0]; ?>" id="x_Position<?php echo $Transfered_Out_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Transfered_Out->SortUrl($Transfered_Out->ToDepartment) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Transfered_Out->ToDepartment->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Transfered_Out->SortUrl($Transfered_Out->ToDepartment) ?>',0);"><?php echo $Transfered_Out->ToDepartment->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Transfered_Out->ToDepartment->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Transfered_Out->ToDepartment->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Transfered_Out->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Transfered_Out_ToDepartment', false, '<?php echo $Transfered_Out->ToDepartment->RangeFrom; ?>', '<?php echo $Transfered_Out->ToDepartment->RangeTo; ?>');return false;" name="x_ToDepartment<?php echo $Transfered_Out_summary->Cnt[0][0]; ?>" id="x_ToDepartment<?php echo $Transfered_Out_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Transfered_Out->SortUrl($Transfered_Out->Position_AfterTransfered) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Transfered_Out->Position_AfterTransfered->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Transfered_Out->SortUrl($Transfered_Out->Position_AfterTransfered) ?>',0);"><?php echo $Transfered_Out->Position_AfterTransfered->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Transfered_Out->Position_AfterTransfered->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Transfered_Out->Position_AfterTransfered->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Transfered_Out->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Transfered_Out_Position_AfterTransfered', false, '<?php echo $Transfered_Out->Position_AfterTransfered->RangeFrom; ?>', '<?php echo $Transfered_Out->Position_AfterTransfered->RangeTo; ?>');return false;" name="x_Position_AfterTransfered<?php echo $Transfered_Out_summary->Cnt[0][0]; ?>" id="x_Position_AfterTransfered<?php echo $Transfered_Out_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Transfered_Out->SortUrl($Transfered_Out->Transfered_Date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Transfered_Out->Transfered_Date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Transfered_Out->SortUrl($Transfered_Out->Transfered_Date) ?>',0);"><?php echo $Transfered_Out->Transfered_Date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Transfered_Out->Transfered_Date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Transfered_Out->Transfered_Date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$Transfered_Out_summary->ShowFirstHeader = FALSE;
	}

	// Build detail SQL
	$sWhere = ewrpt_DetailFilterSQL($Transfered_Out->FromDepartment, $Transfered_Out->SqlFirstGroupField(), $Transfered_Out->FromDepartment->GroupValue());
	if ($Transfered_Out_summary->Filter != "")
		$sWhere = "($Transfered_Out_summary->Filter) AND ($sWhere)";
	$sSql = ewrpt_BuildReportSql($Transfered_Out->SqlSelect(), $Transfered_Out->SqlWhere(), $Transfered_Out->SqlGroupBy(), $Transfered_Out->SqlHaving(), $Transfered_Out->SqlOrderBy(), $sWhere, $Transfered_Out_summary->Sort);
	$rs = $conn->Execute($sSql);
	$rsdtlcnt = ($rs) ? $rs->RecordCount() : 0;
	if ($rsdtlcnt > 0)
		$Transfered_Out_summary->GetRow(1);
	while ($rs && !$rs->EOF) { // Loop detail records
		$Transfered_Out_summary->RecCount++;

		// Render detail row
		$Transfered_Out->ResetCSS();
		$Transfered_Out->RowType = EWRPT_ROWTYPE_DETAIL;
		$Transfered_Out_summary->RenderRow();
?>
	<tr<?php echo $Transfered_Out->RowAttributes(); ?>>
		<td<?php echo $Transfered_Out->FromDepartment->CellAttributes(); ?>><div<?php echo $Transfered_Out->FromDepartment->ViewAttributes(); ?>><?php echo $Transfered_Out->FromDepartment->GroupViewValue; ?></div></td>
		<td<?php echo $Transfered_Out->Auto_ID->CellAttributes() ?>>
<div<?php echo $Transfered_Out->Auto_ID->ViewAttributes(); ?>><?php echo $Transfered_Out->Auto_ID->ListViewValue(); ?></div>
</td>
		<td<?php echo $Transfered_Out->ID->CellAttributes() ?>>
<div<?php echo $Transfered_Out->ID->ViewAttributes(); ?>><?php echo $Transfered_Out->ID->ListViewValue(); ?></div>
</td>
		<td<?php echo $Transfered_Out->FirstName->CellAttributes() ?>>
<div<?php echo $Transfered_Out->FirstName->ViewAttributes(); ?>><?php echo $Transfered_Out->FirstName->ListViewValue(); ?></div>
</td>
		<td<?php echo $Transfered_Out->MiddelName->CellAttributes() ?>>
<div<?php echo $Transfered_Out->MiddelName->ViewAttributes(); ?>><?php echo $Transfered_Out->MiddelName->ListViewValue(); ?></div>
</td>
		<td<?php echo $Transfered_Out->LastName->CellAttributes() ?>>
<div<?php echo $Transfered_Out->LastName->ViewAttributes(); ?>><?php echo $Transfered_Out->LastName->ListViewValue(); ?></div>
</td>
		<td<?php echo $Transfered_Out->Position->CellAttributes() ?>>
<div<?php echo $Transfered_Out->Position->ViewAttributes(); ?>><?php echo $Transfered_Out->Position->ListViewValue(); ?></div>
</td>
		<td<?php echo $Transfered_Out->ToDepartment->CellAttributes() ?>>
<div<?php echo $Transfered_Out->ToDepartment->ViewAttributes(); ?>><?php echo $Transfered_Out->ToDepartment->ListViewValue(); ?></div>
</td>
		<td<?php echo $Transfered_Out->Position_AfterTransfered->CellAttributes() ?>>
<div<?php echo $Transfered_Out->Position_AfterTransfered->ViewAttributes(); ?>><?php echo $Transfered_Out->Position_AfterTransfered->ListViewValue(); ?></div>
</td>
		<td<?php echo $Transfered_Out->Transfered_Date->CellAttributes() ?>>
<div<?php echo $Transfered_Out->Transfered_Date->ViewAttributes(); ?>><?php echo $Transfered_Out->Transfered_Date->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$Transfered_Out_summary->AccumulateSummary();

		// Get next record
		$Transfered_Out_summary->GetRow(2);

		// Show Footers
?>
<?php
	} // End detail records loop
?>
<?php
			$Transfered_Out->ResetCSS();
			$Transfered_Out->RowType = EWRPT_ROWTYPE_TOTAL;
			$Transfered_Out->RowTotalType = EWRPT_ROWTOTAL_GROUP;
			$Transfered_Out->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
			$Transfered_Out->RowGroupLevel = 1;
			$Transfered_Out_summary->RenderRow();
?>
	<tr<?php echo $Transfered_Out->RowAttributes(); ?>>
		<td colspan="10"<?php echo $Transfered_Out->FromDepartment->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSumHead") ?> <?php echo $Transfered_Out->FromDepartment->FldCaption() ?>: <?php echo $Transfered_Out->FromDepartment->GroupViewValue; ?> (<?php echo ewrpt_FormatNumber($Transfered_Out_summary->Cnt[1][0],0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php

			// Reset level 1 summary
			$Transfered_Out_summary->ResetLevelSummary(1);
?>
<?php

	// Next group
	$Transfered_Out_summary->GetGrpRow(2);
	$Transfered_Out_summary->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
<?php
if ($Transfered_Out_summary->TotalGrps > 0) {
	$Transfered_Out->ResetCSS();
	$Transfered_Out->RowType = EWRPT_ROWTYPE_TOTAL;
	$Transfered_Out->RowTotalType = EWRPT_ROWTOTAL_GRAND;
	$Transfered_Out->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
	$Transfered_Out->RowAttrs["class"] = "ewRptGrandSummary";
	$Transfered_Out_summary->RenderRow();
?>
	<!-- tr><td colspan="10"><span class="phpreportmaker">&nbsp;<br /></span></td></tr -->
	<tr<?php echo $Transfered_Out->RowAttributes(); ?>><td colspan="10"><?php echo $ReportLanguage->Phrase("RptGrandTotal") ?> (<?php echo ewrpt_FormatNumber($Transfered_Out_summary->TotCount,0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php } ?>
	</tfoot>
</table>
</div>
<?php if ($Transfered_Out_summary->TotalGrps > 0) { ?>
<?php if ($Transfered_Out->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="Transfered_Outsmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($Transfered_Out_summary->StartGrp, $Transfered_Out_summary->DisplayGrps, $Transfered_Out_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="Transfered_Outsmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="Transfered_Outsmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="Transfered_Outsmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="Transfered_Outsmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($Transfered_Out_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($Transfered_Out_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($Transfered_Out_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($Transfered_Out_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($Transfered_Out_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($Transfered_Out_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($Transfered_Out_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($Transfered_Out_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($Transfered_Out_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($Transfered_Out_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($Transfered_Out->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php if ($Transfered_Out->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($Transfered_Out->Export == "" || $Transfered_Out->Export == "print" || $Transfered_Out->Export == "email") { ?>
<?php } ?>
<?php if ($Transfered_Out->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($Transfered_Out->Export == "" || $Transfered_Out->Export == "print" || $Transfered_Out->Export == "email") { ?>
<?php } ?>
<?php if ($Transfered_Out->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $Transfered_Out_summary->ShowPageFooter(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($Transfered_Out->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "phprptinc/footer.php"; ?>
<?php
$Transfered_Out_summary->Page_Terminate();
?>
<?php

//
// Page class
//
class crTransfered_Out_summary {

	// Page ID
	var $PageID = 'summary';

	// Table name
	var $TableName = 'Transfered Out';

	// Page object name
	var $PageObjName = 'Transfered_Out_summary';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $Transfered_Out;
		if ($Transfered_Out->UseTokenInUrl) $PageUrl .= "t=" . $Transfered_Out->TableVar . "&"; // Add page token
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
		global $Transfered_Out;
		if ($Transfered_Out->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($Transfered_Out->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($Transfered_Out->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crTransfered_Out_summary() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (Transfered_Out)
		$GLOBALS["Transfered_Out"] = new crTransfered_Out();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'summary', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'Transfered Out', TRUE);

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
		global $Transfered_Out;

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$Transfered_Out->Export = $_GET["export"];
	}
	$gsExport = $Transfered_Out->Export; // Get export parameter, used in header
	$gsExportFile = $Transfered_Out->TableVar; // Get export file, used in header
	if ($Transfered_Out->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($Transfered_Out->Export == "word") {
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
		global $Transfered_Out;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($Transfered_Out->Export == "email") {
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
		global $Transfered_Out;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 10;
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
		$this->Col = array(FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE);

		// Set up groups per page dynamically
		$this->SetUpDisplayGrps();
		$Transfered_Out->FromDepartment->SelectionList = "";
		$Transfered_Out->FromDepartment->DefaultSelectionList = "";
		$Transfered_Out->FromDepartment->ValueList = "";
		$Transfered_Out->ID->SelectionList = "";
		$Transfered_Out->ID->DefaultSelectionList = "";
		$Transfered_Out->ID->ValueList = "";
		$Transfered_Out->FirstName->SelectionList = "";
		$Transfered_Out->FirstName->DefaultSelectionList = "";
		$Transfered_Out->FirstName->ValueList = "";
		$Transfered_Out->MiddelName->SelectionList = "";
		$Transfered_Out->MiddelName->DefaultSelectionList = "";
		$Transfered_Out->MiddelName->ValueList = "";
		$Transfered_Out->LastName->SelectionList = "";
		$Transfered_Out->LastName->DefaultSelectionList = "";
		$Transfered_Out->LastName->ValueList = "";
		$Transfered_Out->Position->SelectionList = "";
		$Transfered_Out->Position->DefaultSelectionList = "";
		$Transfered_Out->Position->ValueList = "";
		$Transfered_Out->ToDepartment->SelectionList = "";
		$Transfered_Out->ToDepartment->DefaultSelectionList = "";
		$Transfered_Out->ToDepartment->ValueList = "";
		$Transfered_Out->Position_AfterTransfered->SelectionList = "";
		$Transfered_Out->Position_AfterTransfered->DefaultSelectionList = "";
		$Transfered_Out->Position_AfterTransfered->ValueList = "";

		// Load default filter values
		$this->LoadDefaultFilters();

		// Set up popup filter
		$this->SetupPopup();

		// Extended filter
		$sExtendedFilter = "";

		// Get dropdown values
		$this->GetExtendedFilterValues();

		// Load custom filters
		$Transfered_Out->CustomFilters_Load();

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
		$sGrpSort = ewrpt_UpdateSortFields($Transfered_Out->SqlOrderByGroup(), $this->Sort, 2); // Get grouping field only
		$sSql = ewrpt_BuildReportSql($Transfered_Out->SqlSelectGroup(), $Transfered_Out->SqlWhere(), $Transfered_Out->SqlGroupBy(), $Transfered_Out->SqlHaving(), $Transfered_Out->SqlOrderByGroup(), $this->Filter, $sGrpSort);
		$this->TotalGrps = $this->GetGrpCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($Transfered_Out->ExportAll && $Transfered_Out->Export <> "")
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
		global $Transfered_Out;
		switch ($lvl) {
			case 1:
				return (is_null($Transfered_Out->FromDepartment->CurrentValue) && !is_null($Transfered_Out->FromDepartment->OldValue)) ||
					(!is_null($Transfered_Out->FromDepartment->CurrentValue) && is_null($Transfered_Out->FromDepartment->OldValue)) ||
					($Transfered_Out->FromDepartment->GroupValue() <> $Transfered_Out->FromDepartment->GroupOldValue());
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
		global $Transfered_Out;
		$rsgrpcnt = $conn->Execute($sql);
		$grpcnt = ($rsgrpcnt) ? $rsgrpcnt->RecordCount() : 0;
		if ($rsgrpcnt) $rsgrpcnt->Close();
		return $grpcnt;
	}

	// Get group rs
	function GetGrpRs($sql, $start, $grps) {
		global $conn;
		global $Transfered_Out;
		$wrksql = $sql;
		if ($start > 0 && $grps > -1)
			$wrksql .= " LIMIT " . ($start-1) . ", " . ($grps);
		$rswrk = $conn->Execute($wrksql);
		return $rswrk;
	}

	// Get group row values
	function GetGrpRow($opt) {
		global $rsgrp;
		global $Transfered_Out;
		if (!$rsgrp)
			return;
		if ($opt == 1) { // Get first group

			//$rsgrp->MoveFirst(); // NOTE: no need to move position
			$Transfered_Out->FromDepartment->setDbValue(""); // Init first value
		} else { // Get next group
			$rsgrp->MoveNext();
		}
		if (!$rsgrp->EOF)
			$Transfered_Out->FromDepartment->setDbValue($rsgrp->fields('FromDepartment'));
		if ($rsgrp->EOF) {
			$Transfered_Out->FromDepartment->setDbValue("");
		}
	}

	// Get row values
	function GetRow($opt) {
		global $rs;
		global $Transfered_Out;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$Transfered_Out->Auto_ID->setDbValue($rs->fields('Auto_ID'));
			$Transfered_Out->ID->setDbValue($rs->fields('ID'));
			$Transfered_Out->FirstName->setDbValue($rs->fields('FirstName'));
			$Transfered_Out->MiddelName->setDbValue($rs->fields('MiddelName'));
			$Transfered_Out->LastName->setDbValue($rs->fields('LastName'));
			$Transfered_Out->Position->setDbValue($rs->fields('Position'));
			if ($opt <> 1)
				$Transfered_Out->FromDepartment->setDbValue($rs->fields('FromDepartment'));
			$Transfered_Out->ToDepartment->setDbValue($rs->fields('ToDepartment'));
			$Transfered_Out->Position_AfterTransfered->setDbValue($rs->fields('Position_AfterTransfered'));
			$Transfered_Out->Transfered_Date->setDbValue($rs->fields('Transfered_Date'));
			$this->Val[1] = $Transfered_Out->Auto_ID->CurrentValue;
			$this->Val[2] = $Transfered_Out->ID->CurrentValue;
			$this->Val[3] = $Transfered_Out->FirstName->CurrentValue;
			$this->Val[4] = $Transfered_Out->MiddelName->CurrentValue;
			$this->Val[5] = $Transfered_Out->LastName->CurrentValue;
			$this->Val[6] = $Transfered_Out->Position->CurrentValue;
			$this->Val[7] = $Transfered_Out->ToDepartment->CurrentValue;
			$this->Val[8] = $Transfered_Out->Position_AfterTransfered->CurrentValue;
			$this->Val[9] = $Transfered_Out->Transfered_Date->CurrentValue;
		} else {
			$Transfered_Out->Auto_ID->setDbValue("");
			$Transfered_Out->ID->setDbValue("");
			$Transfered_Out->FirstName->setDbValue("");
			$Transfered_Out->MiddelName->setDbValue("");
			$Transfered_Out->LastName->setDbValue("");
			$Transfered_Out->Position->setDbValue("");
			$Transfered_Out->FromDepartment->setDbValue("");
			$Transfered_Out->ToDepartment->setDbValue("");
			$Transfered_Out->Position_AfterTransfered->setDbValue("");
			$Transfered_Out->Transfered_Date->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $Transfered_Out;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$Transfered_Out->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$Transfered_Out->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $Transfered_Out->getStartGroup();
			}
		} else {
			$this->StartGrp = $Transfered_Out->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$Transfered_Out->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$Transfered_Out->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$Transfered_Out->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $Transfered_Out;

		// Initialize popup
		// Build distinct values for FromDepartment

		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Transfered_Out->FromDepartment->SqlSelect, $Transfered_Out->SqlWhere(), $Transfered_Out->SqlGroupBy(), $Transfered_Out->SqlHaving(), $Transfered_Out->FromDepartment->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Transfered_Out->FromDepartment->setDbValue($rswrk->fields[0]);
			if (is_null($Transfered_Out->FromDepartment->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Transfered_Out->FromDepartment->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Transfered_Out->FromDepartment->GroupViewValue = ewrpt_DisplayGroupValue($Transfered_Out->FromDepartment,$Transfered_Out->FromDepartment->GroupValue());
				ewrpt_SetupDistinctValues($Transfered_Out->FromDepartment->ValueList, $Transfered_Out->FromDepartment->GroupValue(), $Transfered_Out->FromDepartment->GroupViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Transfered_Out->FromDepartment->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Transfered_Out->FromDepartment->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for ID
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Transfered_Out->ID->SqlSelect, $Transfered_Out->SqlWhere(), $Transfered_Out->SqlGroupBy(), $Transfered_Out->SqlHaving(), $Transfered_Out->ID->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Transfered_Out->ID->setDbValue($rswrk->fields[0]);
			if (is_null($Transfered_Out->ID->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Transfered_Out->ID->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Transfered_Out->ID->ViewValue = $Transfered_Out->ID->CurrentValue;
				ewrpt_SetupDistinctValues($Transfered_Out->ID->ValueList, $Transfered_Out->ID->CurrentValue, $Transfered_Out->ID->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Transfered_Out->ID->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Transfered_Out->ID->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for FirstName
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Transfered_Out->FirstName->SqlSelect, $Transfered_Out->SqlWhere(), $Transfered_Out->SqlGroupBy(), $Transfered_Out->SqlHaving(), $Transfered_Out->FirstName->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Transfered_Out->FirstName->setDbValue($rswrk->fields[0]);
			if (is_null($Transfered_Out->FirstName->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Transfered_Out->FirstName->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Transfered_Out->FirstName->ViewValue = $Transfered_Out->FirstName->CurrentValue;
				ewrpt_SetupDistinctValues($Transfered_Out->FirstName->ValueList, $Transfered_Out->FirstName->CurrentValue, $Transfered_Out->FirstName->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Transfered_Out->FirstName->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Transfered_Out->FirstName->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for MiddelName
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Transfered_Out->MiddelName->SqlSelect, $Transfered_Out->SqlWhere(), $Transfered_Out->SqlGroupBy(), $Transfered_Out->SqlHaving(), $Transfered_Out->MiddelName->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Transfered_Out->MiddelName->setDbValue($rswrk->fields[0]);
			if (is_null($Transfered_Out->MiddelName->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Transfered_Out->MiddelName->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Transfered_Out->MiddelName->ViewValue = $Transfered_Out->MiddelName->CurrentValue;
				ewrpt_SetupDistinctValues($Transfered_Out->MiddelName->ValueList, $Transfered_Out->MiddelName->CurrentValue, $Transfered_Out->MiddelName->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Transfered_Out->MiddelName->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Transfered_Out->MiddelName->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for LastName
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Transfered_Out->LastName->SqlSelect, $Transfered_Out->SqlWhere(), $Transfered_Out->SqlGroupBy(), $Transfered_Out->SqlHaving(), $Transfered_Out->LastName->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Transfered_Out->LastName->setDbValue($rswrk->fields[0]);
			if (is_null($Transfered_Out->LastName->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Transfered_Out->LastName->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Transfered_Out->LastName->ViewValue = $Transfered_Out->LastName->CurrentValue;
				ewrpt_SetupDistinctValues($Transfered_Out->LastName->ValueList, $Transfered_Out->LastName->CurrentValue, $Transfered_Out->LastName->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Transfered_Out->LastName->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Transfered_Out->LastName->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for Position
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Transfered_Out->Position->SqlSelect, $Transfered_Out->SqlWhere(), $Transfered_Out->SqlGroupBy(), $Transfered_Out->SqlHaving(), $Transfered_Out->Position->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Transfered_Out->Position->setDbValue($rswrk->fields[0]);
			if (is_null($Transfered_Out->Position->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Transfered_Out->Position->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Transfered_Out->Position->ViewValue = $Transfered_Out->Position->CurrentValue;
				ewrpt_SetupDistinctValues($Transfered_Out->Position->ValueList, $Transfered_Out->Position->CurrentValue, $Transfered_Out->Position->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Transfered_Out->Position->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Transfered_Out->Position->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for ToDepartment
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Transfered_Out->ToDepartment->SqlSelect, $Transfered_Out->SqlWhere(), $Transfered_Out->SqlGroupBy(), $Transfered_Out->SqlHaving(), $Transfered_Out->ToDepartment->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Transfered_Out->ToDepartment->setDbValue($rswrk->fields[0]);
			if (is_null($Transfered_Out->ToDepartment->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Transfered_Out->ToDepartment->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Transfered_Out->ToDepartment->ViewValue = $Transfered_Out->ToDepartment->CurrentValue;
				ewrpt_SetupDistinctValues($Transfered_Out->ToDepartment->ValueList, $Transfered_Out->ToDepartment->CurrentValue, $Transfered_Out->ToDepartment->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Transfered_Out->ToDepartment->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Transfered_Out->ToDepartment->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for Position_AfterTransfered
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Transfered_Out->Position_AfterTransfered->SqlSelect, $Transfered_Out->SqlWhere(), $Transfered_Out->SqlGroupBy(), $Transfered_Out->SqlHaving(), $Transfered_Out->Position_AfterTransfered->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Transfered_Out->Position_AfterTransfered->setDbValue($rswrk->fields[0]);
			if (is_null($Transfered_Out->Position_AfterTransfered->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Transfered_Out->Position_AfterTransfered->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Transfered_Out->Position_AfterTransfered->ViewValue = $Transfered_Out->Position_AfterTransfered->CurrentValue;
				ewrpt_SetupDistinctValues($Transfered_Out->Position_AfterTransfered->ValueList, $Transfered_Out->Position_AfterTransfered->CurrentValue, $Transfered_Out->Position_AfterTransfered->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Transfered_Out->Position_AfterTransfered->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Transfered_Out->Position_AfterTransfered->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

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
				$this->ClearSessionSelection('FromDepartment');
				$this->ClearSessionSelection('ID');
				$this->ClearSessionSelection('FirstName');
				$this->ClearSessionSelection('MiddelName');
				$this->ClearSessionSelection('LastName');
				$this->ClearSessionSelection('Position');
				$this->ClearSessionSelection('ToDepartment');
				$this->ClearSessionSelection('Position_AfterTransfered');
				$this->ResetPager();
			}
		}

		// Load selection criteria to array
		// Get From Department selected values

		if (is_array(@$_SESSION["sel_Transfered_Out_FromDepartment"])) {
			$this->LoadSelectionFromSession('FromDepartment');
		} elseif (@$_SESSION["sel_Transfered_Out_FromDepartment"] == EWRPT_INIT_VALUE) { // Select all
			$Transfered_Out->FromDepartment->SelectionList = "";
		}

		// Get ID selected values
		if (is_array(@$_SESSION["sel_Transfered_Out_ID"])) {
			$this->LoadSelectionFromSession('ID');
		} elseif (@$_SESSION["sel_Transfered_Out_ID"] == EWRPT_INIT_VALUE) { // Select all
			$Transfered_Out->ID->SelectionList = "";
		}

		// Get First Name selected values
		if (is_array(@$_SESSION["sel_Transfered_Out_FirstName"])) {
			$this->LoadSelectionFromSession('FirstName');
		} elseif (@$_SESSION["sel_Transfered_Out_FirstName"] == EWRPT_INIT_VALUE) { // Select all
			$Transfered_Out->FirstName->SelectionList = "";
		}

		// Get Middel Name selected values
		if (is_array(@$_SESSION["sel_Transfered_Out_MiddelName"])) {
			$this->LoadSelectionFromSession('MiddelName');
		} elseif (@$_SESSION["sel_Transfered_Out_MiddelName"] == EWRPT_INIT_VALUE) { // Select all
			$Transfered_Out->MiddelName->SelectionList = "";
		}

		// Get Last Name selected values
		if (is_array(@$_SESSION["sel_Transfered_Out_LastName"])) {
			$this->LoadSelectionFromSession('LastName');
		} elseif (@$_SESSION["sel_Transfered_Out_LastName"] == EWRPT_INIT_VALUE) { // Select all
			$Transfered_Out->LastName->SelectionList = "";
		}

		// Get Position selected values
		if (is_array(@$_SESSION["sel_Transfered_Out_Position"])) {
			$this->LoadSelectionFromSession('Position');
		} elseif (@$_SESSION["sel_Transfered_Out_Position"] == EWRPT_INIT_VALUE) { // Select all
			$Transfered_Out->Position->SelectionList = "";
		}

		// Get To Department selected values
		if (is_array(@$_SESSION["sel_Transfered_Out_ToDepartment"])) {
			$this->LoadSelectionFromSession('ToDepartment');
		} elseif (@$_SESSION["sel_Transfered_Out_ToDepartment"] == EWRPT_INIT_VALUE) { // Select all
			$Transfered_Out->ToDepartment->SelectionList = "";
		}

		// Get Position After Transfered selected values
		if (is_array(@$_SESSION["sel_Transfered_Out_Position_AfterTransfered"])) {
			$this->LoadSelectionFromSession('Position_AfterTransfered');
		} elseif (@$_SESSION["sel_Transfered_Out_Position_AfterTransfered"] == EWRPT_INIT_VALUE) { // Select all
			$Transfered_Out->Position_AfterTransfered->SelectionList = "";
		}
	}

	// Reset pager
	function ResetPager() {

		// Reset start position (reset command)
		global $Transfered_Out;
		$this->StartGrp = 1;
		$Transfered_Out->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $Transfered_Out;
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
			$Transfered_Out->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$Transfered_Out->setStartGroup($this->StartGrp);
		} else {
			if ($Transfered_Out->getGroupPerPage() <> "") {
				$this->DisplayGrps = $Transfered_Out->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $Security;
		global $Transfered_Out;
		if ($Transfered_Out->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($Transfered_Out->SqlSelectCount(), $Transfered_Out->SqlWhere(), $Transfered_Out->SqlGroupBy(), $Transfered_Out->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}
		}

		// Call Row_Rendering event
		$Transfered_Out->Row_Rendering();

		/* --------------------
		'  Render view codes
		' --------------------- */
		if ($Transfered_Out->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// FromDepartment
			$Transfered_Out->FromDepartment->GroupViewValue = $Transfered_Out->FromDepartment->GroupOldValue();
			$Transfered_Out->FromDepartment->CellAttrs["class"] = ($Transfered_Out->RowGroupLevel == 1) ? "ewRptGrpSummary1" : "ewRptGrpField1";
			$Transfered_Out->FromDepartment->GroupViewValue = ewrpt_DisplayGroupValue($Transfered_Out->FromDepartment, $Transfered_Out->FromDepartment->GroupViewValue);

			// Auto_ID
			$Transfered_Out->Auto_ID->ViewValue = $Transfered_Out->Auto_ID->Summary;

			// ID
			$Transfered_Out->ID->ViewValue = $Transfered_Out->ID->Summary;

			// FirstName
			$Transfered_Out->FirstName->ViewValue = $Transfered_Out->FirstName->Summary;

			// MiddelName
			$Transfered_Out->MiddelName->ViewValue = $Transfered_Out->MiddelName->Summary;

			// LastName
			$Transfered_Out->LastName->ViewValue = $Transfered_Out->LastName->Summary;

			// Position
			$Transfered_Out->Position->ViewValue = $Transfered_Out->Position->Summary;

			// ToDepartment
			$Transfered_Out->ToDepartment->ViewValue = $Transfered_Out->ToDepartment->Summary;

			// Position_AfterTransfered
			$Transfered_Out->Position_AfterTransfered->ViewValue = $Transfered_Out->Position_AfterTransfered->Summary;

			// Transfered_Date
			$Transfered_Out->Transfered_Date->ViewValue = $Transfered_Out->Transfered_Date->Summary;
			$Transfered_Out->Transfered_Date->ViewValue = ewrpt_FormatDateTime($Transfered_Out->Transfered_Date->ViewValue, 5);
		} else {

			// FromDepartment
			$Transfered_Out->FromDepartment->GroupViewValue = $Transfered_Out->FromDepartment->GroupValue();
			$Transfered_Out->FromDepartment->CellAttrs["class"] = "ewRptGrpField1";
			$Transfered_Out->FromDepartment->GroupViewValue = ewrpt_DisplayGroupValue($Transfered_Out->FromDepartment, $Transfered_Out->FromDepartment->GroupViewValue);
			if ($Transfered_Out->FromDepartment->GroupValue() == $Transfered_Out->FromDepartment->GroupOldValue() && !$this->ChkLvlBreak(1))
				$Transfered_Out->FromDepartment->GroupViewValue = "&nbsp;";

			// Auto_ID
			$Transfered_Out->Auto_ID->ViewValue = $Transfered_Out->Auto_ID->CurrentValue;
			$Transfered_Out->Auto_ID->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// ID
			$Transfered_Out->ID->ViewValue = $Transfered_Out->ID->CurrentValue;
			$Transfered_Out->ID->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// FirstName
			$Transfered_Out->FirstName->ViewValue = $Transfered_Out->FirstName->CurrentValue;
			$Transfered_Out->FirstName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// MiddelName
			$Transfered_Out->MiddelName->ViewValue = $Transfered_Out->MiddelName->CurrentValue;
			$Transfered_Out->MiddelName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// LastName
			$Transfered_Out->LastName->ViewValue = $Transfered_Out->LastName->CurrentValue;
			$Transfered_Out->LastName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Position
			$Transfered_Out->Position->ViewValue = $Transfered_Out->Position->CurrentValue;
			$Transfered_Out->Position->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// ToDepartment
			$Transfered_Out->ToDepartment->ViewValue = $Transfered_Out->ToDepartment->CurrentValue;
			$Transfered_Out->ToDepartment->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Position_AfterTransfered
			$Transfered_Out->Position_AfterTransfered->ViewValue = $Transfered_Out->Position_AfterTransfered->CurrentValue;
			$Transfered_Out->Position_AfterTransfered->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Transfered_Date
			$Transfered_Out->Transfered_Date->ViewValue = $Transfered_Out->Transfered_Date->CurrentValue;
			$Transfered_Out->Transfered_Date->ViewValue = ewrpt_FormatDateTime($Transfered_Out->Transfered_Date->ViewValue, 5);
			$Transfered_Out->Transfered_Date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// FromDepartment
		$Transfered_Out->FromDepartment->HrefValue = "";

		// Auto_ID
		$Transfered_Out->Auto_ID->HrefValue = "";

		// ID
		$Transfered_Out->ID->HrefValue = "";

		// FirstName
		$Transfered_Out->FirstName->HrefValue = "";

		// MiddelName
		$Transfered_Out->MiddelName->HrefValue = "";

		// LastName
		$Transfered_Out->LastName->HrefValue = "";

		// Position
		$Transfered_Out->Position->HrefValue = "";

		// ToDepartment
		$Transfered_Out->ToDepartment->HrefValue = "";

		// Position_AfterTransfered
		$Transfered_Out->Position_AfterTransfered->HrefValue = "";

		// Transfered_Date
		$Transfered_Out->Transfered_Date->HrefValue = "";

		// Call Row_Rendered event
		$Transfered_Out->Row_Rendered();
	}

	// Get extended filter values
	function GetExtendedFilterValues() {
		global $Transfered_Out;

		// Field Position
		$sSelect = "SELECT DISTINCT `Position` FROM " . $Transfered_Out->SqlFrom();
		$sOrderBy = "`Position` ASC";
		$wrkSql = ewrpt_BuildReportSql($sSelect, $Transfered_Out->SqlWhere(), "", "", $sOrderBy, $this->UserIDFilter, "");
		$Transfered_Out->Position->DropDownList = ewrpt_GetDistinctValues("", $wrkSql);
	}

	// Return extended filter
	function GetExtendedFilter() {
		global $Transfered_Out;
		global $gsFormError;
		$sFilter = "";
		$bPostBack = ewrpt_IsHttpPost();
		$bRestoreSession = TRUE;
		$bSetupFilter = FALSE;

		// Reset extended filter if filter changed
		if ($bPostBack) {

			// Clear extended filter for field ID
			if ($this->ClearExtFilter == 'Transfered_Out_ID')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'ID');

			// Clear extended filter for field FirstName
			if ($this->ClearExtFilter == 'Transfered_Out_FirstName')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'FirstName');

			// Clear extended filter for field MiddelName
			if ($this->ClearExtFilter == 'Transfered_Out_MiddelName')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'MiddelName');

			// Clear extended filter for field LastName
			if ($this->ClearExtFilter == 'Transfered_Out_LastName')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'LastName');

			// Clear dropdown for field Position
			if ($this->ClearExtFilter == 'Transfered_Out_Position')
				$this->SetSessionDropDownValue(EWRPT_INIT_VALUE, 'Position');

			// Clear extended filter for field FromDepartment
			if ($this->ClearExtFilter == 'Transfered_Out_FromDepartment')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'FromDepartment');

		// Reset search command
		} elseif (@$_GET["cmd"] == "reset") {

			// Load default values
			// Field ID

			$this->SetSessionFilterValues($Transfered_Out->ID->SearchValue, $Transfered_Out->ID->SearchOperator, $Transfered_Out->ID->SearchCondition, $Transfered_Out->ID->SearchValue2, $Transfered_Out->ID->SearchOperator2, 'ID');

			// Field FirstName
			$this->SetSessionFilterValues($Transfered_Out->FirstName->SearchValue, $Transfered_Out->FirstName->SearchOperator, $Transfered_Out->FirstName->SearchCondition, $Transfered_Out->FirstName->SearchValue2, $Transfered_Out->FirstName->SearchOperator2, 'FirstName');

			// Field MiddelName
			$this->SetSessionFilterValues($Transfered_Out->MiddelName->SearchValue, $Transfered_Out->MiddelName->SearchOperator, $Transfered_Out->MiddelName->SearchCondition, $Transfered_Out->MiddelName->SearchValue2, $Transfered_Out->MiddelName->SearchOperator2, 'MiddelName');

			// Field LastName
			$this->SetSessionFilterValues($Transfered_Out->LastName->SearchValue, $Transfered_Out->LastName->SearchOperator, $Transfered_Out->LastName->SearchCondition, $Transfered_Out->LastName->SearchValue2, $Transfered_Out->LastName->SearchOperator2, 'LastName');

			// Field Position
			$this->SetSessionDropDownValue($Transfered_Out->Position->DropDownValue, 'Position');

			// Field FromDepartment
			$this->SetSessionFilterValues($Transfered_Out->FromDepartment->SearchValue, $Transfered_Out->FromDepartment->SearchOperator, $Transfered_Out->FromDepartment->SearchCondition, $Transfered_Out->FromDepartment->SearchValue2, $Transfered_Out->FromDepartment->SearchOperator2, 'FromDepartment');

			// Field Transfered_Date
			$this->SetSessionFilterValues($Transfered_Out->Transfered_Date->SearchValue, $Transfered_Out->Transfered_Date->SearchOperator, $Transfered_Out->Transfered_Date->SearchCondition, $Transfered_Out->Transfered_Date->SearchValue2, $Transfered_Out->Transfered_Date->SearchOperator2, 'Transfered_Date');
			$bSetupFilter = TRUE;
		} else {

			// Field ID
			if ($this->GetFilterValues($Transfered_Out->ID)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field FirstName
			if ($this->GetFilterValues($Transfered_Out->FirstName)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field MiddelName
			if ($this->GetFilterValues($Transfered_Out->MiddelName)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field LastName
			if ($this->GetFilterValues($Transfered_Out->LastName)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field Position
			if ($this->GetDropDownValue($Transfered_Out->Position->DropDownValue, 'Position')) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			} elseif ($Transfered_Out->Position->DropDownValue <> EWRPT_INIT_VALUE && !isset($_SESSION['sv_Transfered_Out->Position'])) {
				$bSetupFilter = TRUE;
			}

			// Field FromDepartment
			if ($this->GetFilterValues($Transfered_Out->FromDepartment)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field Transfered_Date
			if ($this->GetFilterValues($Transfered_Out->Transfered_Date)) {
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
			$this->GetSessionFilterValues($Transfered_Out->ID);

			// Field FirstName
			$this->GetSessionFilterValues($Transfered_Out->FirstName);

			// Field MiddelName
			$this->GetSessionFilterValues($Transfered_Out->MiddelName);

			// Field LastName
			$this->GetSessionFilterValues($Transfered_Out->LastName);

			// Field Position
			$this->GetSessionDropDownValue($Transfered_Out->Position);

			// Field FromDepartment
			$this->GetSessionFilterValues($Transfered_Out->FromDepartment);

			// Field Transfered_Date
			$this->GetSessionFilterValues($Transfered_Out->Transfered_Date);
		}

		// Call page filter validated event
		$Transfered_Out->Page_FilterValidated();

		// Build SQL
		// Field ID

		$this->BuildExtendedFilter($Transfered_Out->ID, $sFilter);

		// Field FirstName
		$this->BuildExtendedFilter($Transfered_Out->FirstName, $sFilter);

		// Field MiddelName
		$this->BuildExtendedFilter($Transfered_Out->MiddelName, $sFilter);

		// Field LastName
		$this->BuildExtendedFilter($Transfered_Out->LastName, $sFilter);

		// Field Position
		$this->BuildDropDownFilter($Transfered_Out->Position, $sFilter, "");

		// Field FromDepartment
		$this->BuildExtendedFilter($Transfered_Out->FromDepartment, $sFilter);

		// Field Transfered_Date
		$this->BuildExtendedFilter($Transfered_Out->Transfered_Date, $sFilter);

		// Save parms to session
		// Field ID

		$this->SetSessionFilterValues($Transfered_Out->ID->SearchValue, $Transfered_Out->ID->SearchOperator, $Transfered_Out->ID->SearchCondition, $Transfered_Out->ID->SearchValue2, $Transfered_Out->ID->SearchOperator2, 'ID');

		// Field FirstName
		$this->SetSessionFilterValues($Transfered_Out->FirstName->SearchValue, $Transfered_Out->FirstName->SearchOperator, $Transfered_Out->FirstName->SearchCondition, $Transfered_Out->FirstName->SearchValue2, $Transfered_Out->FirstName->SearchOperator2, 'FirstName');

		// Field MiddelName
		$this->SetSessionFilterValues($Transfered_Out->MiddelName->SearchValue, $Transfered_Out->MiddelName->SearchOperator, $Transfered_Out->MiddelName->SearchCondition, $Transfered_Out->MiddelName->SearchValue2, $Transfered_Out->MiddelName->SearchOperator2, 'MiddelName');

		// Field LastName
		$this->SetSessionFilterValues($Transfered_Out->LastName->SearchValue, $Transfered_Out->LastName->SearchOperator, $Transfered_Out->LastName->SearchCondition, $Transfered_Out->LastName->SearchValue2, $Transfered_Out->LastName->SearchOperator2, 'LastName');

		// Field Position
		$this->SetSessionDropDownValue($Transfered_Out->Position->DropDownValue, 'Position');

		// Field FromDepartment
		$this->SetSessionFilterValues($Transfered_Out->FromDepartment->SearchValue, $Transfered_Out->FromDepartment->SearchOperator, $Transfered_Out->FromDepartment->SearchCondition, $Transfered_Out->FromDepartment->SearchValue2, $Transfered_Out->FromDepartment->SearchOperator2, 'FromDepartment');

		// Field Transfered_Date
		$this->SetSessionFilterValues($Transfered_Out->Transfered_Date->SearchValue, $Transfered_Out->Transfered_Date->SearchOperator, $Transfered_Out->Transfered_Date->SearchCondition, $Transfered_Out->Transfered_Date->SearchValue2, $Transfered_Out->Transfered_Date->SearchOperator2, 'Transfered_Date');

		// Setup filter
		if ($bSetupFilter) {

			// Field ID
			$sWrk = "";
			$this->BuildExtendedFilter($Transfered_Out->ID, $sWrk);
			$this->LoadSelectionFromFilter($Transfered_Out->ID, $sWrk, $Transfered_Out->ID->SelectionList);
			$_SESSION['sel_Transfered_Out_ID'] = ($Transfered_Out->ID->SelectionList == "") ? EWRPT_INIT_VALUE : $Transfered_Out->ID->SelectionList;

			// Field FirstName
			$sWrk = "";
			$this->BuildExtendedFilter($Transfered_Out->FirstName, $sWrk);
			$this->LoadSelectionFromFilter($Transfered_Out->FirstName, $sWrk, $Transfered_Out->FirstName->SelectionList);
			$_SESSION['sel_Transfered_Out_FirstName'] = ($Transfered_Out->FirstName->SelectionList == "") ? EWRPT_INIT_VALUE : $Transfered_Out->FirstName->SelectionList;

			// Field MiddelName
			$sWrk = "";
			$this->BuildExtendedFilter($Transfered_Out->MiddelName, $sWrk);
			$this->LoadSelectionFromFilter($Transfered_Out->MiddelName, $sWrk, $Transfered_Out->MiddelName->SelectionList);
			$_SESSION['sel_Transfered_Out_MiddelName'] = ($Transfered_Out->MiddelName->SelectionList == "") ? EWRPT_INIT_VALUE : $Transfered_Out->MiddelName->SelectionList;

			// Field LastName
			$sWrk = "";
			$this->BuildExtendedFilter($Transfered_Out->LastName, $sWrk);
			$this->LoadSelectionFromFilter($Transfered_Out->LastName, $sWrk, $Transfered_Out->LastName->SelectionList);
			$_SESSION['sel_Transfered_Out_LastName'] = ($Transfered_Out->LastName->SelectionList == "") ? EWRPT_INIT_VALUE : $Transfered_Out->LastName->SelectionList;

			// Field Position
			$sWrk = "";
			$this->BuildDropDownFilter($Transfered_Out->Position, $sWrk, "");
			$this->LoadSelectionFromFilter($Transfered_Out->Position, $sWrk, $Transfered_Out->Position->SelectionList);
			$_SESSION['sel_Transfered_Out_Position'] = ($Transfered_Out->Position->SelectionList == "") ? EWRPT_INIT_VALUE : $Transfered_Out->Position->SelectionList;

			// Field FromDepartment
			$sWrk = "";
			$this->BuildExtendedFilter($Transfered_Out->FromDepartment, $sWrk);
			$this->LoadSelectionFromFilter($Transfered_Out->FromDepartment, $sWrk, $Transfered_Out->FromDepartment->SelectionList);
			$_SESSION['sel_Transfered_Out_FromDepartment'] = ($Transfered_Out->FromDepartment->SelectionList == "") ? EWRPT_INIT_VALUE : $Transfered_Out->FromDepartment->SelectionList;
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
		$this->GetSessionValue($fld->DropDownValue, 'sv_Transfered_Out_' . $parm);
	}

	// Get filter values from session
	function GetSessionFilterValues(&$fld) {
		$parm = substr($fld->FldVar, 2);
		$this->GetSessionValue($fld->SearchValue, 'sv1_Transfered_Out_' . $parm);
		$this->GetSessionValue($fld->SearchOperator, 'so1_Transfered_Out_' . $parm);
		$this->GetSessionValue($fld->SearchCondition, 'sc_Transfered_Out_' . $parm);
		$this->GetSessionValue($fld->SearchValue2, 'sv2_Transfered_Out_' . $parm);
		$this->GetSessionValue($fld->SearchOperator2, 'so2_Transfered_Out_' . $parm);
	}

	// Get value from session
	function GetSessionValue(&$sv, $sn) {
		if (isset($_SESSION[$sn]))
			$sv = $_SESSION[$sn];
	}

	// Set dropdown value to session
	function SetSessionDropDownValue($sv, $parm) {
		$_SESSION['sv_Transfered_Out_' . $parm] = $sv;
	}

	// Set filter values to session
	function SetSessionFilterValues($sv1, $so1, $sc, $sv2, $so2, $parm) {
		$_SESSION['sv1_Transfered_Out_' . $parm] = $sv1;
		$_SESSION['so1_Transfered_Out_' . $parm] = $so1;
		$_SESSION['sc_Transfered_Out_' . $parm] = $sc;
		$_SESSION['sv2_Transfered_Out_' . $parm] = $sv2;
		$_SESSION['so2_Transfered_Out_' . $parm] = $so2;
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
		global $ReportLanguage, $gsFormError, $Transfered_Out;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EWRPT_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ewrpt_CheckDate($Transfered_Out->Transfered_Date->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Transfered_Out->Transfered_Date->FldErrMsg();
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
		$_SESSION["sel_Transfered_Out_$parm"] = "";
		$_SESSION["rf_Transfered_Out_$parm"] = "";
		$_SESSION["rt_Transfered_Out_$parm"] = "";
	}

	// Load selection from session
	function LoadSelectionFromSession($parm) {
		global $Transfered_Out;
		$fld =& $Transfered_Out->fields($parm);
		$fld->SelectionList = @$_SESSION["sel_Transfered_Out_$parm"];
		$fld->RangeFrom = @$_SESSION["rf_Transfered_Out_$parm"];
		$fld->RangeTo = @$_SESSION["rt_Transfered_Out_$parm"];
	}

	// Load default value for filters
	function LoadDefaultFilters() {
		global $Transfered_Out;

		/**
		* Set up default values for non Text filters
		*/

		// Field Position
		$Transfered_Out->Position->DefaultDropDownValue = EWRPT_INIT_VALUE;
		$Transfered_Out->Position->DropDownValue = $Transfered_Out->Position->DefaultDropDownValue;
		$sWrk = "";
		$this->BuildDropDownFilter($Transfered_Out->Position, $sWrk, "");
		$this->LoadSelectionFromFilter($Transfered_Out->Position, $sWrk, $Transfered_Out->Position->DefaultSelectionList);

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
		$this->SetDefaultExtFilter($Transfered_Out->ID, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Transfered_Out->ID);
		$sWrk = "";
		$this->BuildExtendedFilter($Transfered_Out->ID, $sWrk);
		$this->LoadSelectionFromFilter($Transfered_Out->ID, $sWrk, $Transfered_Out->ID->DefaultSelectionList);
		$Transfered_Out->ID->SelectionList = $Transfered_Out->ID->DefaultSelectionList;

		// Field FirstName
		$this->SetDefaultExtFilter($Transfered_Out->FirstName, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Transfered_Out->FirstName);
		$sWrk = "";
		$this->BuildExtendedFilter($Transfered_Out->FirstName, $sWrk);
		$this->LoadSelectionFromFilter($Transfered_Out->FirstName, $sWrk, $Transfered_Out->FirstName->DefaultSelectionList);
		$Transfered_Out->FirstName->SelectionList = $Transfered_Out->FirstName->DefaultSelectionList;

		// Field MiddelName
		$this->SetDefaultExtFilter($Transfered_Out->MiddelName, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Transfered_Out->MiddelName);
		$sWrk = "";
		$this->BuildExtendedFilter($Transfered_Out->MiddelName, $sWrk);
		$this->LoadSelectionFromFilter($Transfered_Out->MiddelName, $sWrk, $Transfered_Out->MiddelName->DefaultSelectionList);
		$Transfered_Out->MiddelName->SelectionList = $Transfered_Out->MiddelName->DefaultSelectionList;

		// Field LastName
		$this->SetDefaultExtFilter($Transfered_Out->LastName, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Transfered_Out->LastName);
		$sWrk = "";
		$this->BuildExtendedFilter($Transfered_Out->LastName, $sWrk);
		$this->LoadSelectionFromFilter($Transfered_Out->LastName, $sWrk, $Transfered_Out->LastName->DefaultSelectionList);
		$Transfered_Out->LastName->SelectionList = $Transfered_Out->LastName->DefaultSelectionList;

		// Field FromDepartment
		$this->SetDefaultExtFilter($Transfered_Out->FromDepartment, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Transfered_Out->FromDepartment);
		$sWrk = "";
		$this->BuildExtendedFilter($Transfered_Out->FromDepartment, $sWrk);
		$this->LoadSelectionFromFilter($Transfered_Out->FromDepartment, $sWrk, $Transfered_Out->FromDepartment->DefaultSelectionList);
		$Transfered_Out->FromDepartment->SelectionList = $Transfered_Out->FromDepartment->DefaultSelectionList;

		// Field Transfered_Date
		$this->SetDefaultExtFilter($Transfered_Out->Transfered_Date, "USER SELECT", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Transfered_Out->Transfered_Date);

		/**
		* Set up default values for popup filters
		* NOTE: if extended filter is enabled, use default values in extended filter instead
		*/

		// Field ToDepartment
		// Setup your default values for the popup filter below, e.g.
		// $Transfered_Out->ToDepartment->DefaultSelectionList = array("val1", "val2");

		$Transfered_Out->ToDepartment->DefaultSelectionList = "";
		$Transfered_Out->ToDepartment->SelectionList = $Transfered_Out->ToDepartment->DefaultSelectionList;

		// Field Position_AfterTransfered
		// Setup your default values for the popup filter below, e.g.
		// $Transfered_Out->Position_AfterTransfered->DefaultSelectionList = array("val1", "val2");

		$Transfered_Out->Position_AfterTransfered->DefaultSelectionList = "";
		$Transfered_Out->Position_AfterTransfered->SelectionList = $Transfered_Out->Position_AfterTransfered->DefaultSelectionList;
	}

	// Check if filter applied
	function CheckFilter() {
		global $Transfered_Out;

		// Check ID text filter
		if ($this->TextFilterApplied($Transfered_Out->ID))
			return TRUE;

		// Check ID popup filter
		if (!ewrpt_MatchedArray($Transfered_Out->ID->DefaultSelectionList, $Transfered_Out->ID->SelectionList))
			return TRUE;

		// Check FirstName text filter
		if ($this->TextFilterApplied($Transfered_Out->FirstName))
			return TRUE;

		// Check FirstName popup filter
		if (!ewrpt_MatchedArray($Transfered_Out->FirstName->DefaultSelectionList, $Transfered_Out->FirstName->SelectionList))
			return TRUE;

		// Check MiddelName text filter
		if ($this->TextFilterApplied($Transfered_Out->MiddelName))
			return TRUE;

		// Check MiddelName popup filter
		if (!ewrpt_MatchedArray($Transfered_Out->MiddelName->DefaultSelectionList, $Transfered_Out->MiddelName->SelectionList))
			return TRUE;

		// Check LastName text filter
		if ($this->TextFilterApplied($Transfered_Out->LastName))
			return TRUE;

		// Check LastName popup filter
		if (!ewrpt_MatchedArray($Transfered_Out->LastName->DefaultSelectionList, $Transfered_Out->LastName->SelectionList))
			return TRUE;

		// Check Position extended filter
		if ($this->NonTextFilterApplied($Transfered_Out->Position))
			return TRUE;

		// Check Position popup filter
		if (!ewrpt_MatchedArray($Transfered_Out->Position->DefaultSelectionList, $Transfered_Out->Position->SelectionList))
			return TRUE;

		// Check FromDepartment text filter
		if ($this->TextFilterApplied($Transfered_Out->FromDepartment))
			return TRUE;

		// Check FromDepartment popup filter
		if (!ewrpt_MatchedArray($Transfered_Out->FromDepartment->DefaultSelectionList, $Transfered_Out->FromDepartment->SelectionList))
			return TRUE;

		// Check ToDepartment popup filter
		if (!ewrpt_MatchedArray($Transfered_Out->ToDepartment->DefaultSelectionList, $Transfered_Out->ToDepartment->SelectionList))
			return TRUE;

		// Check Position_AfterTransfered popup filter
		if (!ewrpt_MatchedArray($Transfered_Out->Position_AfterTransfered->DefaultSelectionList, $Transfered_Out->Position_AfterTransfered->SelectionList))
			return TRUE;

		// Check Transfered_Date text filter
		if ($this->TextFilterApplied($Transfered_Out->Transfered_Date))
			return TRUE;
		return FALSE;
	}

	// Show list of filters
	function ShowFilterList() {
		global $Transfered_Out;
		global $ReportLanguage;

		// Initialize
		$sFilterList = "";

		// Field ID
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Transfered_Out->ID, $sExtWrk);
		if (is_array($Transfered_Out->ID->SelectionList))
			$sWrk = ewrpt_JoinArray($Transfered_Out->ID->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Transfered_Out->ID->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field FirstName
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Transfered_Out->FirstName, $sExtWrk);
		if (is_array($Transfered_Out->FirstName->SelectionList))
			$sWrk = ewrpt_JoinArray($Transfered_Out->FirstName->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Transfered_Out->FirstName->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field MiddelName
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Transfered_Out->MiddelName, $sExtWrk);
		if (is_array($Transfered_Out->MiddelName->SelectionList))
			$sWrk = ewrpt_JoinArray($Transfered_Out->MiddelName->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Transfered_Out->MiddelName->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field LastName
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Transfered_Out->LastName, $sExtWrk);
		if (is_array($Transfered_Out->LastName->SelectionList))
			$sWrk = ewrpt_JoinArray($Transfered_Out->LastName->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Transfered_Out->LastName->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Position
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildDropDownFilter($Transfered_Out->Position, $sExtWrk, "");
		if (is_array($Transfered_Out->Position->SelectionList))
			$sWrk = ewrpt_JoinArray($Transfered_Out->Position->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Transfered_Out->Position->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field FromDepartment
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Transfered_Out->FromDepartment, $sExtWrk);
		if (is_array($Transfered_Out->FromDepartment->SelectionList))
			$sWrk = ewrpt_JoinArray($Transfered_Out->FromDepartment->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Transfered_Out->FromDepartment->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field ToDepartment
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($Transfered_Out->ToDepartment->SelectionList))
			$sWrk = ewrpt_JoinArray($Transfered_Out->ToDepartment->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Transfered_Out->ToDepartment->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Position_AfterTransfered
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($Transfered_Out->Position_AfterTransfered->SelectionList))
			$sWrk = ewrpt_JoinArray($Transfered_Out->Position_AfterTransfered->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Transfered_Out->Position_AfterTransfered->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Transfered_Date
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Transfered_Out->Transfered_Date, $sExtWrk);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Transfered_Out->Transfered_Date->FldCaption() . "<br />";
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
		global $Transfered_Out;
		$sWrk = "";
		if (!$this->ExtendedFilterExist($Transfered_Out->ID)) {
			if (is_array($Transfered_Out->ID->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Transfered_Out->ID, "`ID`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Transfered_Out->FirstName)) {
			if (is_array($Transfered_Out->FirstName->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Transfered_Out->FirstName, "`FirstName`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Transfered_Out->MiddelName)) {
			if (is_array($Transfered_Out->MiddelName->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Transfered_Out->MiddelName, "`MiddelName`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Transfered_Out->LastName)) {
			if (is_array($Transfered_Out->LastName->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Transfered_Out->LastName, "`LastName`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->DropDownFilterExist($Transfered_Out->Position, "")) {
			if (is_array($Transfered_Out->Position->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Transfered_Out->Position, "`Position`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Transfered_Out->FromDepartment)) {
			if (is_array($Transfered_Out->FromDepartment->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Transfered_Out->FromDepartment, "`FromDepartment`", EWRPT_DATATYPE_STRING);
			}
		}
			if (is_array($Transfered_Out->ToDepartment->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Transfered_Out->ToDepartment, "`ToDepartment`", EWRPT_DATATYPE_STRING);
			}
			if (is_array($Transfered_Out->Position_AfterTransfered->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Transfered_Out->Position_AfterTransfered, "`Position_AfterTransfered`", EWRPT_DATATYPE_STRING);
			}
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $Transfered_Out;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$Transfered_Out->setOrderBy("");
				$Transfered_Out->setStartGroup(1);
				$Transfered_Out->FromDepartment->setSort("");
				$Transfered_Out->Auto_ID->setSort("");
				$Transfered_Out->ID->setSort("");
				$Transfered_Out->FirstName->setSort("");
				$Transfered_Out->MiddelName->setSort("");
				$Transfered_Out->LastName->setSort("");
				$Transfered_Out->Position->setSort("");
				$Transfered_Out->ToDepartment->setSort("");
				$Transfered_Out->Position_AfterTransfered->setSort("");
				$Transfered_Out->Transfered_Date->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$Transfered_Out->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$Transfered_Out->CurrentOrderType = @$_GET["ordertype"];
			$sSortSql = $Transfered_Out->SortSql();
			$Transfered_Out->setOrderBy($sSortSql);
			$Transfered_Out->setStartGroup(1);
		}

		// Set up default sort
		if ($Transfered_Out->getOrderBy() == "") {
			$Transfered_Out->setOrderBy("`ID` ASC");
			$Transfered_Out->ID->setSort("ASC");
		}
		return $Transfered_Out->getOrderBy();
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
