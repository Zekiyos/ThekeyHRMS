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
$Cholinesterase_Test = NULL;

//
// Table class for Cholinesterase Test
//
class crCholinesterase_Test {
	var $TableVar = 'Cholinesterase_Test';
	var $TableName = 'Cholinesterase Test';
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
	var $Department;
	var $LastResult;
	var $LastTestDate;
	var $FirstResult;
	var $FirstTestDate;
	var $FirstDifference;
	var $SecondResult;
	var $SecondTestDate;
	var $SecondDifference;
	var $ThirdResult;
	var $ThirdTestDate;
	var $ThirdDifference;
	var $ForthResult;
	var $ForthTestDate;
	var $ForthDifference;
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
	function crCholinesterase_Test() {
		global $ReportLanguage;

		// Auto_ID
		$this->Auto_ID = new crField('Cholinesterase_Test', 'Cholinesterase Test', 'x_Auto_ID', 'Auto_ID', '`Auto_ID`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->Auto_ID->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['Auto_ID'] =& $this->Auto_ID;
		$this->Auto_ID->DateFilter = "";
		$this->Auto_ID->SqlSelect = "";
		$this->Auto_ID->SqlOrderBy = "";
		$this->Auto_ID->FldGroupByType = "";
		$this->Auto_ID->FldGroupInt = "0";
		$this->Auto_ID->FldGroupSql = "";

		// ID
		$this->ID = new crField('Cholinesterase_Test', 'Cholinesterase Test', 'x_ID', 'ID', '`ID`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['ID'] =& $this->ID;
		$this->ID->DateFilter = "";
		$this->ID->SqlSelect = "SELECT DISTINCT `ID` FROM " . $this->SqlFrom();
		$this->ID->SqlOrderBy = "`ID`";
		$this->ID->FldGroupByType = "";
		$this->ID->FldGroupInt = "0";
		$this->ID->FldGroupSql = "";

		// FirstName
		$this->FirstName = new crField('Cholinesterase_Test', 'Cholinesterase Test', 'x_FirstName', 'FirstName', '`FirstName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['FirstName'] =& $this->FirstName;
		$this->FirstName->DateFilter = "";
		$this->FirstName->SqlSelect = "SELECT DISTINCT `FirstName` FROM " . $this->SqlFrom();
		$this->FirstName->SqlOrderBy = "`FirstName`";
		$this->FirstName->FldGroupByType = "";
		$this->FirstName->FldGroupInt = "0";
		$this->FirstName->FldGroupSql = "";

		// MiddelName
		$this->MiddelName = new crField('Cholinesterase_Test', 'Cholinesterase Test', 'x_MiddelName', 'MiddelName', '`MiddelName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['MiddelName'] =& $this->MiddelName;
		$this->MiddelName->DateFilter = "";
		$this->MiddelName->SqlSelect = "SELECT DISTINCT `MiddelName` FROM " . $this->SqlFrom();
		$this->MiddelName->SqlOrderBy = "`MiddelName`";
		$this->MiddelName->FldGroupByType = "";
		$this->MiddelName->FldGroupInt = "0";
		$this->MiddelName->FldGroupSql = "";

		// LastName
		$this->LastName = new crField('Cholinesterase_Test', 'Cholinesterase Test', 'x_LastName', 'LastName', '`LastName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['LastName'] =& $this->LastName;
		$this->LastName->DateFilter = "";
		$this->LastName->SqlSelect = "SELECT DISTINCT `LastName` FROM " . $this->SqlFrom();
		$this->LastName->SqlOrderBy = "`LastName`";
		$this->LastName->FldGroupByType = "";
		$this->LastName->FldGroupInt = "0";
		$this->LastName->FldGroupSql = "";

		// Department
		$this->Department = new crField('Cholinesterase_Test', 'Cholinesterase Test', 'x_Department', 'Department', '`Department`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->Department->GroupingFieldId = 1;
		$this->fields['Department'] =& $this->Department;
		$this->Department->DateFilter = "";
		$this->Department->SqlSelect = "SELECT DISTINCT `Department` FROM " . $this->SqlFrom();
		$this->Department->SqlOrderBy = "`Department`";
		$this->Department->FldGroupByType = "";
		$this->Department->FldGroupInt = "0";
		$this->Department->FldGroupSql = "";

		// LastResult
		$this->LastResult = new crField('Cholinesterase_Test', 'Cholinesterase Test', 'x_LastResult', 'LastResult', '`LastResult`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->LastResult->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['LastResult'] =& $this->LastResult;
		$this->LastResult->DateFilter = "";
		$this->LastResult->SqlSelect = "SELECT DISTINCT `LastResult` FROM " . $this->SqlFrom();
		$this->LastResult->SqlOrderBy = "`LastResult`";
		$this->LastResult->FldGroupByType = "";
		$this->LastResult->FldGroupInt = "0";
		$this->LastResult->FldGroupSql = "";

		// LastTestDate
		$this->LastTestDate = new crField('Cholinesterase_Test', 'Cholinesterase Test', 'x_LastTestDate', 'LastTestDate', '`LastTestDate`', 133, EWRPT_DATATYPE_DATE, 5);
		$this->LastTestDate->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateYMD"));
		$this->fields['LastTestDate'] =& $this->LastTestDate;
		$this->LastTestDate->DateFilter = "";
		$this->LastTestDate->SqlSelect = "SELECT DISTINCT `LastTestDate` FROM " . $this->SqlFrom();
		$this->LastTestDate->SqlOrderBy = "`LastTestDate`";
		$this->LastTestDate->FldGroupByType = "";
		$this->LastTestDate->FldGroupInt = "0";
		$this->LastTestDate->FldGroupSql = "";

		// FirstResult
		$this->FirstResult = new crField('Cholinesterase_Test', 'Cholinesterase Test', 'x_FirstResult', 'FirstResult', '`FirstResult`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->FirstResult->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['FirstResult'] =& $this->FirstResult;
		$this->FirstResult->DateFilter = "";
		$this->FirstResult->SqlSelect = "";
		$this->FirstResult->SqlOrderBy = "";
		$this->FirstResult->FldGroupByType = "";
		$this->FirstResult->FldGroupInt = "0";
		$this->FirstResult->FldGroupSql = "";

		// FirstTestDate
		$this->FirstTestDate = new crField('Cholinesterase_Test', 'Cholinesterase Test', 'x_FirstTestDate', 'FirstTestDate', '`FirstTestDate`', 133, EWRPT_DATATYPE_DATE, 5);
		$this->FirstTestDate->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateYMD"));
		$this->fields['FirstTestDate'] =& $this->FirstTestDate;
		$this->FirstTestDate->DateFilter = "";
		$this->FirstTestDate->SqlSelect = "SELECT DISTINCT `FirstTestDate` FROM " . $this->SqlFrom();
		$this->FirstTestDate->SqlOrderBy = "`FirstTestDate`";
		$this->FirstTestDate->FldGroupByType = "";
		$this->FirstTestDate->FldGroupInt = "0";
		$this->FirstTestDate->FldGroupSql = "";

		// FirstDifference
		$this->FirstDifference = new crField('Cholinesterase_Test', 'Cholinesterase Test', 'x_FirstDifference', 'FirstDifference', '`FirstDifference`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->FirstDifference->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['FirstDifference'] =& $this->FirstDifference;
		$this->FirstDifference->DateFilter = "";
		$this->FirstDifference->SqlSelect = "SELECT DISTINCT `FirstDifference` FROM " . $this->SqlFrom();
		$this->FirstDifference->SqlOrderBy = "`FirstDifference`";
		$this->FirstDifference->FldGroupByType = "";
		$this->FirstDifference->FldGroupInt = "0";
		$this->FirstDifference->FldGroupSql = "";

		// SecondResult
		$this->SecondResult = new crField('Cholinesterase_Test', 'Cholinesterase Test', 'x_SecondResult', 'SecondResult', '`SecondResult`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->SecondResult->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['SecondResult'] =& $this->SecondResult;
		$this->SecondResult->DateFilter = "";
		$this->SecondResult->SqlSelect = "SELECT DISTINCT `SecondResult` FROM " . $this->SqlFrom();
		$this->SecondResult->SqlOrderBy = "`SecondResult`";
		$this->SecondResult->FldGroupByType = "";
		$this->SecondResult->FldGroupInt = "0";
		$this->SecondResult->FldGroupSql = "";

		// SecondTestDate
		$this->SecondTestDate = new crField('Cholinesterase_Test', 'Cholinesterase Test', 'x_SecondTestDate', 'SecondTestDate', '`SecondTestDate`', 133, EWRPT_DATATYPE_DATE, 5);
		$this->SecondTestDate->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateYMD"));
		$this->fields['SecondTestDate'] =& $this->SecondTestDate;
		$this->SecondTestDate->DateFilter = "";
		$this->SecondTestDate->SqlSelect = "SELECT DISTINCT `SecondTestDate` FROM " . $this->SqlFrom();
		$this->SecondTestDate->SqlOrderBy = "`SecondTestDate`";
		$this->SecondTestDate->FldGroupByType = "";
		$this->SecondTestDate->FldGroupInt = "0";
		$this->SecondTestDate->FldGroupSql = "";

		// SecondDifference
		$this->SecondDifference = new crField('Cholinesterase_Test', 'Cholinesterase Test', 'x_SecondDifference', 'SecondDifference', '`SecondDifference`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->SecondDifference->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['SecondDifference'] =& $this->SecondDifference;
		$this->SecondDifference->DateFilter = "";
		$this->SecondDifference->SqlSelect = "SELECT DISTINCT `SecondDifference` FROM " . $this->SqlFrom();
		$this->SecondDifference->SqlOrderBy = "`SecondDifference`";
		$this->SecondDifference->FldGroupByType = "";
		$this->SecondDifference->FldGroupInt = "0";
		$this->SecondDifference->FldGroupSql = "";

		// ThirdResult
		$this->ThirdResult = new crField('Cholinesterase_Test', 'Cholinesterase Test', 'x_ThirdResult', 'ThirdResult', '`ThirdResult`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->ThirdResult->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['ThirdResult'] =& $this->ThirdResult;
		$this->ThirdResult->DateFilter = "";
		$this->ThirdResult->SqlSelect = "SELECT DISTINCT `ThirdResult` FROM " . $this->SqlFrom();
		$this->ThirdResult->SqlOrderBy = "`ThirdResult`";
		$this->ThirdResult->FldGroupByType = "";
		$this->ThirdResult->FldGroupInt = "0";
		$this->ThirdResult->FldGroupSql = "";

		// ThirdTestDate
		$this->ThirdTestDate = new crField('Cholinesterase_Test', 'Cholinesterase Test', 'x_ThirdTestDate', 'ThirdTestDate', '`ThirdTestDate`', 133, EWRPT_DATATYPE_DATE, 5);
		$this->ThirdTestDate->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateYMD"));
		$this->fields['ThirdTestDate'] =& $this->ThirdTestDate;
		$this->ThirdTestDate->DateFilter = "";
		$this->ThirdTestDate->SqlSelect = "SELECT DISTINCT `ThirdTestDate` FROM " . $this->SqlFrom();
		$this->ThirdTestDate->SqlOrderBy = "`ThirdTestDate`";
		$this->ThirdTestDate->FldGroupByType = "";
		$this->ThirdTestDate->FldGroupInt = "0";
		$this->ThirdTestDate->FldGroupSql = "";

		// ThirdDifference
		$this->ThirdDifference = new crField('Cholinesterase_Test', 'Cholinesterase Test', 'x_ThirdDifference', 'ThirdDifference', '`ThirdDifference`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->ThirdDifference->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['ThirdDifference'] =& $this->ThirdDifference;
		$this->ThirdDifference->DateFilter = "";
		$this->ThirdDifference->SqlSelect = "SELECT DISTINCT `ThirdDifference` FROM " . $this->SqlFrom();
		$this->ThirdDifference->SqlOrderBy = "`ThirdDifference`";
		$this->ThirdDifference->FldGroupByType = "";
		$this->ThirdDifference->FldGroupInt = "0";
		$this->ThirdDifference->FldGroupSql = "";

		// ForthResult
		$this->ForthResult = new crField('Cholinesterase_Test', 'Cholinesterase Test', 'x_ForthResult', 'ForthResult', '`ForthResult`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->ForthResult->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['ForthResult'] =& $this->ForthResult;
		$this->ForthResult->DateFilter = "";
		$this->ForthResult->SqlSelect = "SELECT DISTINCT `ForthResult` FROM " . $this->SqlFrom();
		$this->ForthResult->SqlOrderBy = "`ForthResult`";
		$this->ForthResult->FldGroupByType = "";
		$this->ForthResult->FldGroupInt = "0";
		$this->ForthResult->FldGroupSql = "";

		// ForthTestDate
		$this->ForthTestDate = new crField('Cholinesterase_Test', 'Cholinesterase Test', 'x_ForthTestDate', 'ForthTestDate', '`ForthTestDate`', 133, EWRPT_DATATYPE_DATE, 5);
		$this->ForthTestDate->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateYMD"));
		$this->fields['ForthTestDate'] =& $this->ForthTestDate;
		$this->ForthTestDate->DateFilter = "";
		$this->ForthTestDate->SqlSelect = "SELECT DISTINCT `ForthTestDate` FROM " . $this->SqlFrom();
		$this->ForthTestDate->SqlOrderBy = "`ForthTestDate`";
		$this->ForthTestDate->FldGroupByType = "";
		$this->ForthTestDate->FldGroupInt = "0";
		$this->ForthTestDate->FldGroupSql = "";

		// ForthDifference
		$this->ForthDifference = new crField('Cholinesterase_Test', 'Cholinesterase Test', 'x_ForthDifference', 'ForthDifference', '`ForthDifference`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->ForthDifference->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['ForthDifference'] =& $this->ForthDifference;
		$this->ForthDifference->DateFilter = "";
		$this->ForthDifference->SqlSelect = "SELECT DISTINCT `ForthDifference` FROM " . $this->SqlFrom();
		$this->ForthDifference->SqlOrderBy = "`ForthDifference`";
		$this->ForthDifference->FldGroupByType = "";
		$this->ForthDifference->FldGroupInt = "0";
		$this->ForthDifference->FldGroupSql = "";
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
		return "`cholinesterase_test`";
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
$Cholinesterase_Test_summary = new crCholinesterase_Test_summary();
$Page =& $Cholinesterase_Test_summary;

// Page init
$Cholinesterase_Test_summary->Page_Init();

// Page main
$Cholinesterase_Test_summary->Page_Main();
?>
<?php include "phprptinc/header.php"; ?>
<?php if ($Cholinesterase_Test->Export == "") { ?>
<script type="text/javascript">

// Create page object
var Cholinesterase_Test_summary = new ewrpt_Page("Cholinesterase_Test_summary");

// page properties
Cholinesterase_Test_summary.PageID = "summary"; // page ID
Cholinesterase_Test_summary.FormID = "fCholinesterase_Testsummaryfilter"; // form ID
var EWRPT_PAGE_ID = Cholinesterase_Test_summary.PageID;

// extend page with ValidateForm function
Cholinesterase_Test_summary.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var elm = fobj.sv1_LastResult;
	if (elm && !ewrpt_CheckNumber(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Cholinesterase_Test->LastResult->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv1_LastTestDate;
	if (elm && !ewrpt_CheckDate(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Cholinesterase_Test->LastTestDate->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv2_LastTestDate;
	if (elm && !ewrpt_CheckDate(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Cholinesterase_Test->LastTestDate->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv1_FirstResult;
	if (elm && !ewrpt_CheckNumber(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Cholinesterase_Test->FirstResult->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv1_FirstTestDate;
	if (elm && !ewrpt_CheckDate(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Cholinesterase_Test->FirstTestDate->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv2_FirstTestDate;
	if (elm && !ewrpt_CheckDate(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Cholinesterase_Test->FirstTestDate->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv1_FirstDifference;
	if (elm && !ewrpt_CheckNumber(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Cholinesterase_Test->FirstDifference->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv1_SecondResult;
	if (elm && !ewrpt_CheckNumber(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Cholinesterase_Test->SecondResult->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv1_SecondTestDate;
	if (elm && !ewrpt_CheckDate(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Cholinesterase_Test->SecondTestDate->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv2_SecondTestDate;
	if (elm && !ewrpt_CheckDate(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Cholinesterase_Test->SecondTestDate->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv1_SecondDifference;
	if (elm && !ewrpt_CheckNumber(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Cholinesterase_Test->SecondDifference->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv1_ThirdResult;
	if (elm && !ewrpt_CheckNumber(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Cholinesterase_Test->ThirdResult->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv1_ThirdTestDate;
	if (elm && !ewrpt_CheckDate(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Cholinesterase_Test->ThirdTestDate->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv2_ThirdTestDate;
	if (elm && !ewrpt_CheckDate(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Cholinesterase_Test->ThirdTestDate->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv1_ThirdDifference;
	if (elm && !ewrpt_CheckNumber(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Cholinesterase_Test->ThirdDifference->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv1_ForthResult;
	if (elm && !ewrpt_CheckNumber(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Cholinesterase_Test->ForthResult->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv1_ForthTestDate;
	if (elm && !ewrpt_CheckDate(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Cholinesterase_Test->ForthTestDate->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv2_ForthTestDate;
	if (elm && !ewrpt_CheckDate(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Cholinesterase_Test->ForthTestDate->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv1_ForthDifference;
	if (elm && !ewrpt_CheckNumber(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Cholinesterase_Test->ForthDifference->FldErrMsg()) ?>"))
			return false;
	}

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj)) return false;
	return true;
}

// extend page with Form_CustomValidate function
Cholinesterase_Test_summary.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EWRPT_CLIENT_VALIDATE) { ?>
Cholinesterase_Test_summary.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
Cholinesterase_Test_summary.ValidateRequired = false; // no JavaScript validation
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
<?php $Cholinesterase_Test_summary->ShowPageHeader(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php $Cholinesterase_Test_summary->ShowMessage(); ?>
<?php if ($Cholinesterase_Test->Export == "" || $Cholinesterase_Test->Export == "print" || $Cholinesterase_Test->Export == "email") { ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php } ?>
<?php if ($Cholinesterase_Test->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
<?php $jsdata = ewrpt_GetJsData($Cholinesterase_Test->Department, $Cholinesterase_Test->Department->FldType); ?>
ewrpt_CreatePopup("Cholinesterase_Test_Department", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Cholinesterase_Test->ID, $Cholinesterase_Test->ID->FldType); ?>
ewrpt_CreatePopup("Cholinesterase_Test_ID", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Cholinesterase_Test->FirstName, $Cholinesterase_Test->FirstName->FldType); ?>
ewrpt_CreatePopup("Cholinesterase_Test_FirstName", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Cholinesterase_Test->MiddelName, $Cholinesterase_Test->MiddelName->FldType); ?>
ewrpt_CreatePopup("Cholinesterase_Test_MiddelName", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Cholinesterase_Test->LastName, $Cholinesterase_Test->LastName->FldType); ?>
ewrpt_CreatePopup("Cholinesterase_Test_LastName", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Cholinesterase_Test->LastResult, $Cholinesterase_Test->LastResult->FldType); ?>
ewrpt_CreatePopup("Cholinesterase_Test_LastResult", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Cholinesterase_Test->LastTestDate, $Cholinesterase_Test->LastTestDate->FldType); ?>
ewrpt_CreatePopup("Cholinesterase_Test_LastTestDate", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Cholinesterase_Test->FirstTestDate, $Cholinesterase_Test->FirstTestDate->FldType); ?>
ewrpt_CreatePopup("Cholinesterase_Test_FirstTestDate", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Cholinesterase_Test->FirstDifference, $Cholinesterase_Test->FirstDifference->FldType); ?>
ewrpt_CreatePopup("Cholinesterase_Test_FirstDifference", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Cholinesterase_Test->SecondResult, $Cholinesterase_Test->SecondResult->FldType); ?>
ewrpt_CreatePopup("Cholinesterase_Test_SecondResult", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Cholinesterase_Test->SecondTestDate, $Cholinesterase_Test->SecondTestDate->FldType); ?>
ewrpt_CreatePopup("Cholinesterase_Test_SecondTestDate", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Cholinesterase_Test->SecondDifference, $Cholinesterase_Test->SecondDifference->FldType); ?>
ewrpt_CreatePopup("Cholinesterase_Test_SecondDifference", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Cholinesterase_Test->ThirdResult, $Cholinesterase_Test->ThirdResult->FldType); ?>
ewrpt_CreatePopup("Cholinesterase_Test_ThirdResult", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Cholinesterase_Test->ThirdTestDate, $Cholinesterase_Test->ThirdTestDate->FldType); ?>
ewrpt_CreatePopup("Cholinesterase_Test_ThirdTestDate", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Cholinesterase_Test->ThirdDifference, $Cholinesterase_Test->ThirdDifference->FldType); ?>
ewrpt_CreatePopup("Cholinesterase_Test_ThirdDifference", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Cholinesterase_Test->ForthResult, $Cholinesterase_Test->ForthResult->FldType); ?>
ewrpt_CreatePopup("Cholinesterase_Test_ForthResult", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Cholinesterase_Test->ForthTestDate, $Cholinesterase_Test->ForthTestDate->FldType); ?>
ewrpt_CreatePopup("Cholinesterase_Test_ForthTestDate", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Cholinesterase_Test->ForthDifference, $Cholinesterase_Test->ForthDifference->FldType); ?>
ewrpt_CreatePopup("Cholinesterase_Test_ForthDifference", [<?php echo $jsdata ?>]);
</script>
<div id="Cholinesterase_Test_Department_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Cholinesterase_Test_ID_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Cholinesterase_Test_FirstName_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Cholinesterase_Test_MiddelName_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Cholinesterase_Test_LastName_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Cholinesterase_Test_LastResult_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Cholinesterase_Test_LastTestDate_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Cholinesterase_Test_FirstTestDate_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Cholinesterase_Test_FirstDifference_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Cholinesterase_Test_SecondResult_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Cholinesterase_Test_SecondTestDate_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Cholinesterase_Test_SecondDifference_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Cholinesterase_Test_ThirdResult_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Cholinesterase_Test_ThirdTestDate_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Cholinesterase_Test_ThirdDifference_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Cholinesterase_Test_ForthResult_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Cholinesterase_Test_ForthTestDate_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Cholinesterase_Test_ForthDifference_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<?php } ?>
<?php if ($Cholinesterase_Test->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<?php if ($Cholinesterase_Test->Export == "" || $Cholinesterase_Test->Export == "print" || $Cholinesterase_Test->Export == "email") { ?>
<?php } ?>
<?php echo $Cholinesterase_Test->TableCaption() ?>
<?php if ($Cholinesterase_Test->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $Cholinesterase_Test_summary->ExportPrintUrl ?>"><?php echo $ReportLanguage->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $Cholinesterase_Test_summary->ExportExcelUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $Cholinesterase_Test_summary->ExportWordUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToWord") ?></a>
<?php if ($Cholinesterase_Test_summary->FilterApplied) { ?>
&nbsp;&nbsp;<a href="Cholinesterase_Testsmry.php?cmd=reset"><?php echo $ReportLanguage->Phrase("ResetAllFilter") ?></a>
<?php } ?>
<?php } ?>
<br /><br />
<?php if ($Cholinesterase_Test->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($Cholinesterase_Test->Export == "" || $Cholinesterase_Test->Export == "print" || $Cholinesterase_Test->Export == "email") { ?>
<?php } ?>
<?php if ($Cholinesterase_Test->Export == "") { ?>
	</div></td>
	<!-- Left Container (End) -->
	<!-- Center Container - Report (Begin) -->
	<td style="vertical-align: top;" class="ewPadding"><div id="ewCenter" class="phpreportmaker">
	<!-- center slot -->
<?php } ?>
<!-- summary report starts -->
<div id="report_summary">
<?php if ($Cholinesterase_Test->Export == "") { ?>
<?php
if ($Cholinesterase_Test->FilterPanelOption == 2 || ($Cholinesterase_Test->FilterPanelOption == 3 && $Cholinesterase_Test_summary->FilterApplied) || $Cholinesterase_Test_summary->Filter == "0=101") {
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
<form name="fCholinesterase_Testsummaryfilter" id="fCholinesterase_Testsummaryfilter" action="Cholinesterase_Testsmry.php" class="ewForm" onsubmit="return Cholinesterase_Test_summary.ValidateForm(this);">
<table class="ewRptExtFilter">
	<tr>
		<td><span class="phpreportmaker"><?php echo $Cholinesterase_Test->ID->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_ID" id="so1_ID" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_ID" id="sv1_ID" size="30" maxlength="15" value="<?php echo ewrpt_HtmlEncode($Cholinesterase_Test->ID->SearchValue) ?>"<?php echo ($Cholinesterase_Test_summary->ClearExtFilter == 'Cholinesterase_Test_ID') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Cholinesterase_Test->FirstName->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_FirstName" id="so1_FirstName" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_FirstName" id="sv1_FirstName" size="30" maxlength="20" value="<?php echo ewrpt_HtmlEncode($Cholinesterase_Test->FirstName->SearchValue) ?>"<?php echo ($Cholinesterase_Test_summary->ClearExtFilter == 'Cholinesterase_Test_FirstName') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Cholinesterase_Test->MiddelName->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_MiddelName" id="so1_MiddelName" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_MiddelName" id="sv1_MiddelName" size="30" maxlength="20" value="<?php echo ewrpt_HtmlEncode($Cholinesterase_Test->MiddelName->SearchValue) ?>"<?php echo ($Cholinesterase_Test_summary->ClearExtFilter == 'Cholinesterase_Test_MiddelName') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Cholinesterase_Test->LastName->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_LastName" id="so1_LastName" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_LastName" id="sv1_LastName" size="30" maxlength="20" value="<?php echo ewrpt_HtmlEncode($Cholinesterase_Test->LastName->SearchValue) ?>"<?php echo ($Cholinesterase_Test_summary->ClearExtFilter == 'Cholinesterase_Test_LastName') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Cholinesterase_Test->Department->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_Department" id="so1_Department" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_Department" id="sv1_Department" size="30" maxlength="50" value="<?php echo ewrpt_HtmlEncode($Cholinesterase_Test->Department->SearchValue) ?>"<?php echo ($Cholinesterase_Test_summary->ClearExtFilter == 'Cholinesterase_Test_Department') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Cholinesterase_Test->LastResult->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("="); ?><input type="hidden" name="so1_LastResult" id="so1_LastResult" value="="></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_LastResult" id="sv1_LastResult" size="30" value="<?php echo ewrpt_HtmlEncode($Cholinesterase_Test->LastResult->SearchValue) ?>"<?php echo ($Cholinesterase_Test_summary->ClearExtFilter == 'Cholinesterase_Test_LastResult') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Cholinesterase_Test->LastTestDate->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("BETWEEN"); ?><input type="hidden" name="so1_LastTestDate" id="so1_LastTestDate" value="BETWEEN"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_LastTestDate" id="sv1_LastTestDate" value="<?php echo ewrpt_HtmlEncode($Cholinesterase_Test->LastTestDate->SearchValue) ?>"<?php echo ($Cholinesterase_Test_summary->ClearExtFilter == 'Cholinesterase_Test_LastTestDate') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
				<td><span class="ewRptSearchOpr" id="btw1_LastTestDate" name="btw1_LastTestDate">&nbsp;<?php echo $ReportLanguage->Phrase("AND") ?>&nbsp;</span></td>
				<td><span class="phpreportmaker" id="btw1_LastTestDate" name="btw1_LastTestDate">
<input type="text" name="sv2_LastTestDate" id="sv2_LastTestDate" value="<?php echo ewrpt_HtmlEncode($Cholinesterase_Test->LastTestDate->SearchValue2) ?>"<?php echo ($Cholinesterase_Test_summary->ClearExtFilter == 'Cholinesterase_Test_LastTestDate') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Cholinesterase_Test->FirstResult->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("="); ?><input type="hidden" name="so1_FirstResult" id="so1_FirstResult" value="="></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_FirstResult" id="sv1_FirstResult" size="30" value="<?php echo ewrpt_HtmlEncode($Cholinesterase_Test->FirstResult->SearchValue) ?>"<?php echo ($Cholinesterase_Test_summary->ClearExtFilter == 'Cholinesterase_Test_FirstResult') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Cholinesterase_Test->FirstTestDate->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("BETWEEN"); ?><input type="hidden" name="so1_FirstTestDate" id="so1_FirstTestDate" value="BETWEEN"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_FirstTestDate" id="sv1_FirstTestDate" value="<?php echo ewrpt_HtmlEncode($Cholinesterase_Test->FirstTestDate->SearchValue) ?>"<?php echo ($Cholinesterase_Test_summary->ClearExtFilter == 'Cholinesterase_Test_FirstTestDate') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
				<td><span class="ewRptSearchOpr" id="btw1_FirstTestDate" name="btw1_FirstTestDate">&nbsp;<?php echo $ReportLanguage->Phrase("AND") ?>&nbsp;</span></td>
				<td><span class="phpreportmaker" id="btw1_FirstTestDate" name="btw1_FirstTestDate">
<input type="text" name="sv2_FirstTestDate" id="sv2_FirstTestDate" value="<?php echo ewrpt_HtmlEncode($Cholinesterase_Test->FirstTestDate->SearchValue2) ?>"<?php echo ($Cholinesterase_Test_summary->ClearExtFilter == 'Cholinesterase_Test_FirstTestDate') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Cholinesterase_Test->FirstDifference->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("="); ?><input type="hidden" name="so1_FirstDifference" id="so1_FirstDifference" value="="></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_FirstDifference" id="sv1_FirstDifference" size="30" value="<?php echo ewrpt_HtmlEncode($Cholinesterase_Test->FirstDifference->SearchValue) ?>"<?php echo ($Cholinesterase_Test_summary->ClearExtFilter == 'Cholinesterase_Test_FirstDifference') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Cholinesterase_Test->SecondResult->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("="); ?><input type="hidden" name="so1_SecondResult" id="so1_SecondResult" value="="></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_SecondResult" id="sv1_SecondResult" size="30" value="<?php echo ewrpt_HtmlEncode($Cholinesterase_Test->SecondResult->SearchValue) ?>"<?php echo ($Cholinesterase_Test_summary->ClearExtFilter == 'Cholinesterase_Test_SecondResult') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Cholinesterase_Test->SecondTestDate->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("BETWEEN"); ?><input type="hidden" name="so1_SecondTestDate" id="so1_SecondTestDate" value="BETWEEN"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_SecondTestDate" id="sv1_SecondTestDate" value="<?php echo ewrpt_HtmlEncode($Cholinesterase_Test->SecondTestDate->SearchValue) ?>"<?php echo ($Cholinesterase_Test_summary->ClearExtFilter == 'Cholinesterase_Test_SecondTestDate') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
				<td><span class="ewRptSearchOpr" id="btw1_SecondTestDate" name="btw1_SecondTestDate">&nbsp;<?php echo $ReportLanguage->Phrase("AND") ?>&nbsp;</span></td>
				<td><span class="phpreportmaker" id="btw1_SecondTestDate" name="btw1_SecondTestDate">
<input type="text" name="sv2_SecondTestDate" id="sv2_SecondTestDate" value="<?php echo ewrpt_HtmlEncode($Cholinesterase_Test->SecondTestDate->SearchValue2) ?>"<?php echo ($Cholinesterase_Test_summary->ClearExtFilter == 'Cholinesterase_Test_SecondTestDate') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Cholinesterase_Test->SecondDifference->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("="); ?><input type="hidden" name="so1_SecondDifference" id="so1_SecondDifference" value="="></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_SecondDifference" id="sv1_SecondDifference" size="30" value="<?php echo ewrpt_HtmlEncode($Cholinesterase_Test->SecondDifference->SearchValue) ?>"<?php echo ($Cholinesterase_Test_summary->ClearExtFilter == 'Cholinesterase_Test_SecondDifference') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Cholinesterase_Test->ThirdResult->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("="); ?><input type="hidden" name="so1_ThirdResult" id="so1_ThirdResult" value="="></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_ThirdResult" id="sv1_ThirdResult" size="30" value="<?php echo ewrpt_HtmlEncode($Cholinesterase_Test->ThirdResult->SearchValue) ?>"<?php echo ($Cholinesterase_Test_summary->ClearExtFilter == 'Cholinesterase_Test_ThirdResult') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Cholinesterase_Test->ThirdTestDate->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("BETWEEN"); ?><input type="hidden" name="so1_ThirdTestDate" id="so1_ThirdTestDate" value="BETWEEN"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_ThirdTestDate" id="sv1_ThirdTestDate" value="<?php echo ewrpt_HtmlEncode($Cholinesterase_Test->ThirdTestDate->SearchValue) ?>"<?php echo ($Cholinesterase_Test_summary->ClearExtFilter == 'Cholinesterase_Test_ThirdTestDate') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
				<td><span class="ewRptSearchOpr" id="btw1_ThirdTestDate" name="btw1_ThirdTestDate">&nbsp;<?php echo $ReportLanguage->Phrase("AND") ?>&nbsp;</span></td>
				<td><span class="phpreportmaker" id="btw1_ThirdTestDate" name="btw1_ThirdTestDate">
<input type="text" name="sv2_ThirdTestDate" id="sv2_ThirdTestDate" value="<?php echo ewrpt_HtmlEncode($Cholinesterase_Test->ThirdTestDate->SearchValue2) ?>"<?php echo ($Cholinesterase_Test_summary->ClearExtFilter == 'Cholinesterase_Test_ThirdTestDate') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Cholinesterase_Test->ThirdDifference->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("="); ?><input type="hidden" name="so1_ThirdDifference" id="so1_ThirdDifference" value="="></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_ThirdDifference" id="sv1_ThirdDifference" size="30" value="<?php echo ewrpt_HtmlEncode($Cholinesterase_Test->ThirdDifference->SearchValue) ?>"<?php echo ($Cholinesterase_Test_summary->ClearExtFilter == 'Cholinesterase_Test_ThirdDifference') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Cholinesterase_Test->ForthResult->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("="); ?><input type="hidden" name="so1_ForthResult" id="so1_ForthResult" value="="></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_ForthResult" id="sv1_ForthResult" size="30" value="<?php echo ewrpt_HtmlEncode($Cholinesterase_Test->ForthResult->SearchValue) ?>"<?php echo ($Cholinesterase_Test_summary->ClearExtFilter == 'Cholinesterase_Test_ForthResult') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Cholinesterase_Test->ForthTestDate->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("BETWEEN"); ?><input type="hidden" name="so1_ForthTestDate" id="so1_ForthTestDate" value="BETWEEN"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_ForthTestDate" id="sv1_ForthTestDate" value="<?php echo ewrpt_HtmlEncode($Cholinesterase_Test->ForthTestDate->SearchValue) ?>"<?php echo ($Cholinesterase_Test_summary->ClearExtFilter == 'Cholinesterase_Test_ForthTestDate') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
				<td><span class="ewRptSearchOpr" id="btw1_ForthTestDate" name="btw1_ForthTestDate">&nbsp;<?php echo $ReportLanguage->Phrase("AND") ?>&nbsp;</span></td>
				<td><span class="phpreportmaker" id="btw1_ForthTestDate" name="btw1_ForthTestDate">
<input type="text" name="sv2_ForthTestDate" id="sv2_ForthTestDate" value="<?php echo ewrpt_HtmlEncode($Cholinesterase_Test->ForthTestDate->SearchValue2) ?>"<?php echo ($Cholinesterase_Test_summary->ClearExtFilter == 'Cholinesterase_Test_ForthTestDate') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Cholinesterase_Test->ForthDifference->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("="); ?><input type="hidden" name="so1_ForthDifference" id="so1_ForthDifference" value="="></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_ForthDifference" id="sv1_ForthDifference" size="30" value="<?php echo ewrpt_HtmlEncode($Cholinesterase_Test->ForthDifference->SearchValue) ?>"<?php echo ($Cholinesterase_Test_summary->ClearExtFilter == 'Cholinesterase_Test_ForthDifference') ? " class=\"ewInputCleared\"" : "" ?>>
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
<?php if ($Cholinesterase_Test->ShowCurrentFilter) { ?>
<div id="ewrptFilterList">
<?php $Cholinesterase_Test_summary->ShowFilterList() ?>
</div>
<br />
<?php } ?>
<table class="ewGrid" cellspacing="0"><tr>
	<td class="ewGridContent">
<?php if ($Cholinesterase_Test->Export == "") { ?>
<div class="ewGridUpperPanel">
<form action="Cholinesterase_Testsmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($Cholinesterase_Test_summary->StartGrp, $Cholinesterase_Test_summary->DisplayGrps, $Cholinesterase_Test_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="Cholinesterase_Testsmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="Cholinesterase_Testsmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="Cholinesterase_Testsmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="Cholinesterase_Testsmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($Cholinesterase_Test_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($Cholinesterase_Test_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($Cholinesterase_Test_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($Cholinesterase_Test_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($Cholinesterase_Test_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($Cholinesterase_Test_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($Cholinesterase_Test_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($Cholinesterase_Test_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($Cholinesterase_Test_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($Cholinesterase_Test_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($Cholinesterase_Test->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
if ($Cholinesterase_Test->ExportAll && $Cholinesterase_Test->Export <> "") {
	$Cholinesterase_Test_summary->StopGrp = $Cholinesterase_Test_summary->TotalGrps;
} else {
	$Cholinesterase_Test_summary->StopGrp = $Cholinesterase_Test_summary->StartGrp + $Cholinesterase_Test_summary->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($Cholinesterase_Test_summary->StopGrp) > intval($Cholinesterase_Test_summary->TotalGrps))
	$Cholinesterase_Test_summary->StopGrp = $Cholinesterase_Test_summary->TotalGrps;
$Cholinesterase_Test_summary->RecCount = 0;

// Get first row
if ($Cholinesterase_Test_summary->TotalGrps > 0) {
	$Cholinesterase_Test_summary->GetGrpRow(1);
	$Cholinesterase_Test_summary->GrpCount = 1;
}
while (($rsgrp && !$rsgrp->EOF && $Cholinesterase_Test_summary->GrpCount <= $Cholinesterase_Test_summary->DisplayGrps) || $Cholinesterase_Test_summary->ShowFirstHeader) {

	// Show header
	if ($Cholinesterase_Test_summary->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Cholinesterase_Test->SortUrl($Cholinesterase_Test->Department) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Cholinesterase_Test->Department->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Cholinesterase_Test->SortUrl($Cholinesterase_Test->Department) ?>',0);"><?php echo $Cholinesterase_Test->Department->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Cholinesterase_Test->Department->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Cholinesterase_Test->Department->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Cholinesterase_Test->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Cholinesterase_Test_Department', false, '<?php echo $Cholinesterase_Test->Department->RangeFrom; ?>', '<?php echo $Cholinesterase_Test->Department->RangeTo; ?>');return false;" name="x_Department<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>" id="x_Department<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Cholinesterase_Test->SortUrl($Cholinesterase_Test->ID) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Cholinesterase_Test->ID->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Cholinesterase_Test->SortUrl($Cholinesterase_Test->ID) ?>',0);"><?php echo $Cholinesterase_Test->ID->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Cholinesterase_Test->ID->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Cholinesterase_Test->ID->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Cholinesterase_Test->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Cholinesterase_Test_ID', false, '<?php echo $Cholinesterase_Test->ID->RangeFrom; ?>', '<?php echo $Cholinesterase_Test->ID->RangeTo; ?>');return false;" name="x_ID<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>" id="x_ID<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Cholinesterase_Test->SortUrl($Cholinesterase_Test->FirstName) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Cholinesterase_Test->FirstName->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Cholinesterase_Test->SortUrl($Cholinesterase_Test->FirstName) ?>',0);"><?php echo $Cholinesterase_Test->FirstName->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Cholinesterase_Test->FirstName->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Cholinesterase_Test->FirstName->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Cholinesterase_Test->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Cholinesterase_Test_FirstName', false, '<?php echo $Cholinesterase_Test->FirstName->RangeFrom; ?>', '<?php echo $Cholinesterase_Test->FirstName->RangeTo; ?>');return false;" name="x_FirstName<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>" id="x_FirstName<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Cholinesterase_Test->SortUrl($Cholinesterase_Test->MiddelName) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Cholinesterase_Test->MiddelName->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Cholinesterase_Test->SortUrl($Cholinesterase_Test->MiddelName) ?>',0);"><?php echo $Cholinesterase_Test->MiddelName->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Cholinesterase_Test->MiddelName->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Cholinesterase_Test->MiddelName->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Cholinesterase_Test->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Cholinesterase_Test_MiddelName', false, '<?php echo $Cholinesterase_Test->MiddelName->RangeFrom; ?>', '<?php echo $Cholinesterase_Test->MiddelName->RangeTo; ?>');return false;" name="x_MiddelName<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>" id="x_MiddelName<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Cholinesterase_Test->SortUrl($Cholinesterase_Test->LastName) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Cholinesterase_Test->LastName->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Cholinesterase_Test->SortUrl($Cholinesterase_Test->LastName) ?>',0);"><?php echo $Cholinesterase_Test->LastName->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Cholinesterase_Test->LastName->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Cholinesterase_Test->LastName->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Cholinesterase_Test->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Cholinesterase_Test_LastName', false, '<?php echo $Cholinesterase_Test->LastName->RangeFrom; ?>', '<?php echo $Cholinesterase_Test->LastName->RangeTo; ?>');return false;" name="x_LastName<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>" id="x_LastName<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Cholinesterase_Test->SortUrl($Cholinesterase_Test->LastResult) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Cholinesterase_Test->LastResult->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Cholinesterase_Test->SortUrl($Cholinesterase_Test->LastResult) ?>',0);"><?php echo $Cholinesterase_Test->LastResult->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Cholinesterase_Test->LastResult->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Cholinesterase_Test->LastResult->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Cholinesterase_Test->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Cholinesterase_Test_LastResult', false, '<?php echo $Cholinesterase_Test->LastResult->RangeFrom; ?>', '<?php echo $Cholinesterase_Test->LastResult->RangeTo; ?>');return false;" name="x_LastResult<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>" id="x_LastResult<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Cholinesterase_Test->SortUrl($Cholinesterase_Test->LastTestDate) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Cholinesterase_Test->LastTestDate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Cholinesterase_Test->SortUrl($Cholinesterase_Test->LastTestDate) ?>',0);"><?php echo $Cholinesterase_Test->LastTestDate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Cholinesterase_Test->LastTestDate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Cholinesterase_Test->LastTestDate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Cholinesterase_Test->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Cholinesterase_Test_LastTestDate', false, '<?php echo $Cholinesterase_Test->LastTestDate->RangeFrom; ?>', '<?php echo $Cholinesterase_Test->LastTestDate->RangeTo; ?>');return false;" name="x_LastTestDate<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>" id="x_LastTestDate<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Cholinesterase_Test->SortUrl($Cholinesterase_Test->FirstResult) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Cholinesterase_Test->FirstResult->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Cholinesterase_Test->SortUrl($Cholinesterase_Test->FirstResult) ?>',0);"><?php echo $Cholinesterase_Test->FirstResult->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Cholinesterase_Test->FirstResult->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Cholinesterase_Test->FirstResult->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Cholinesterase_Test->SortUrl($Cholinesterase_Test->FirstTestDate) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Cholinesterase_Test->FirstTestDate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Cholinesterase_Test->SortUrl($Cholinesterase_Test->FirstTestDate) ?>',0);"><?php echo $Cholinesterase_Test->FirstTestDate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Cholinesterase_Test->FirstTestDate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Cholinesterase_Test->FirstTestDate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Cholinesterase_Test->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Cholinesterase_Test_FirstTestDate', false, '<?php echo $Cholinesterase_Test->FirstTestDate->RangeFrom; ?>', '<?php echo $Cholinesterase_Test->FirstTestDate->RangeTo; ?>');return false;" name="x_FirstTestDate<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>" id="x_FirstTestDate<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Cholinesterase_Test->SortUrl($Cholinesterase_Test->FirstDifference) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Cholinesterase_Test->FirstDifference->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Cholinesterase_Test->SortUrl($Cholinesterase_Test->FirstDifference) ?>',0);"><?php echo $Cholinesterase_Test->FirstDifference->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Cholinesterase_Test->FirstDifference->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Cholinesterase_Test->FirstDifference->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Cholinesterase_Test->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Cholinesterase_Test_FirstDifference', false, '<?php echo $Cholinesterase_Test->FirstDifference->RangeFrom; ?>', '<?php echo $Cholinesterase_Test->FirstDifference->RangeTo; ?>');return false;" name="x_FirstDifference<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>" id="x_FirstDifference<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Cholinesterase_Test->SortUrl($Cholinesterase_Test->SecondResult) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Cholinesterase_Test->SecondResult->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Cholinesterase_Test->SortUrl($Cholinesterase_Test->SecondResult) ?>',0);"><?php echo $Cholinesterase_Test->SecondResult->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Cholinesterase_Test->SecondResult->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Cholinesterase_Test->SecondResult->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Cholinesterase_Test->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Cholinesterase_Test_SecondResult', false, '<?php echo $Cholinesterase_Test->SecondResult->RangeFrom; ?>', '<?php echo $Cholinesterase_Test->SecondResult->RangeTo; ?>');return false;" name="x_SecondResult<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>" id="x_SecondResult<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Cholinesterase_Test->SortUrl($Cholinesterase_Test->SecondTestDate) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Cholinesterase_Test->SecondTestDate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Cholinesterase_Test->SortUrl($Cholinesterase_Test->SecondTestDate) ?>',0);"><?php echo $Cholinesterase_Test->SecondTestDate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Cholinesterase_Test->SecondTestDate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Cholinesterase_Test->SecondTestDate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Cholinesterase_Test->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Cholinesterase_Test_SecondTestDate', false, '<?php echo $Cholinesterase_Test->SecondTestDate->RangeFrom; ?>', '<?php echo $Cholinesterase_Test->SecondTestDate->RangeTo; ?>');return false;" name="x_SecondTestDate<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>" id="x_SecondTestDate<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Cholinesterase_Test->SortUrl($Cholinesterase_Test->SecondDifference) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Cholinesterase_Test->SecondDifference->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Cholinesterase_Test->SortUrl($Cholinesterase_Test->SecondDifference) ?>',0);"><?php echo $Cholinesterase_Test->SecondDifference->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Cholinesterase_Test->SecondDifference->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Cholinesterase_Test->SecondDifference->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Cholinesterase_Test->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Cholinesterase_Test_SecondDifference', false, '<?php echo $Cholinesterase_Test->SecondDifference->RangeFrom; ?>', '<?php echo $Cholinesterase_Test->SecondDifference->RangeTo; ?>');return false;" name="x_SecondDifference<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>" id="x_SecondDifference<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Cholinesterase_Test->SortUrl($Cholinesterase_Test->ThirdResult) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Cholinesterase_Test->ThirdResult->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Cholinesterase_Test->SortUrl($Cholinesterase_Test->ThirdResult) ?>',0);"><?php echo $Cholinesterase_Test->ThirdResult->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Cholinesterase_Test->ThirdResult->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Cholinesterase_Test->ThirdResult->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Cholinesterase_Test->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Cholinesterase_Test_ThirdResult', false, '<?php echo $Cholinesterase_Test->ThirdResult->RangeFrom; ?>', '<?php echo $Cholinesterase_Test->ThirdResult->RangeTo; ?>');return false;" name="x_ThirdResult<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>" id="x_ThirdResult<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Cholinesterase_Test->SortUrl($Cholinesterase_Test->ThirdTestDate) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Cholinesterase_Test->ThirdTestDate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Cholinesterase_Test->SortUrl($Cholinesterase_Test->ThirdTestDate) ?>',0);"><?php echo $Cholinesterase_Test->ThirdTestDate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Cholinesterase_Test->ThirdTestDate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Cholinesterase_Test->ThirdTestDate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Cholinesterase_Test->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Cholinesterase_Test_ThirdTestDate', false, '<?php echo $Cholinesterase_Test->ThirdTestDate->RangeFrom; ?>', '<?php echo $Cholinesterase_Test->ThirdTestDate->RangeTo; ?>');return false;" name="x_ThirdTestDate<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>" id="x_ThirdTestDate<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Cholinesterase_Test->SortUrl($Cholinesterase_Test->ThirdDifference) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Cholinesterase_Test->ThirdDifference->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Cholinesterase_Test->SortUrl($Cholinesterase_Test->ThirdDifference) ?>',0);"><?php echo $Cholinesterase_Test->ThirdDifference->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Cholinesterase_Test->ThirdDifference->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Cholinesterase_Test->ThirdDifference->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Cholinesterase_Test->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Cholinesterase_Test_ThirdDifference', false, '<?php echo $Cholinesterase_Test->ThirdDifference->RangeFrom; ?>', '<?php echo $Cholinesterase_Test->ThirdDifference->RangeTo; ?>');return false;" name="x_ThirdDifference<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>" id="x_ThirdDifference<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Cholinesterase_Test->SortUrl($Cholinesterase_Test->ForthResult) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Cholinesterase_Test->ForthResult->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Cholinesterase_Test->SortUrl($Cholinesterase_Test->ForthResult) ?>',0);"><?php echo $Cholinesterase_Test->ForthResult->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Cholinesterase_Test->ForthResult->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Cholinesterase_Test->ForthResult->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Cholinesterase_Test->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Cholinesterase_Test_ForthResult', false, '<?php echo $Cholinesterase_Test->ForthResult->RangeFrom; ?>', '<?php echo $Cholinesterase_Test->ForthResult->RangeTo; ?>');return false;" name="x_ForthResult<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>" id="x_ForthResult<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Cholinesterase_Test->SortUrl($Cholinesterase_Test->ForthTestDate) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Cholinesterase_Test->ForthTestDate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Cholinesterase_Test->SortUrl($Cholinesterase_Test->ForthTestDate) ?>',0);"><?php echo $Cholinesterase_Test->ForthTestDate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Cholinesterase_Test->ForthTestDate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Cholinesterase_Test->ForthTestDate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Cholinesterase_Test->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Cholinesterase_Test_ForthTestDate', false, '<?php echo $Cholinesterase_Test->ForthTestDate->RangeFrom; ?>', '<?php echo $Cholinesterase_Test->ForthTestDate->RangeTo; ?>');return false;" name="x_ForthTestDate<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>" id="x_ForthTestDate<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Cholinesterase_Test->SortUrl($Cholinesterase_Test->ForthDifference) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Cholinesterase_Test->ForthDifference->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Cholinesterase_Test->SortUrl($Cholinesterase_Test->ForthDifference) ?>',0);"><?php echo $Cholinesterase_Test->ForthDifference->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Cholinesterase_Test->ForthDifference->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Cholinesterase_Test->ForthDifference->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Cholinesterase_Test->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Cholinesterase_Test_ForthDifference', false, '<?php echo $Cholinesterase_Test->ForthDifference->RangeFrom; ?>', '<?php echo $Cholinesterase_Test->ForthDifference->RangeTo; ?>');return false;" name="x_ForthDifference<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>" id="x_ForthDifference<?php echo $Cholinesterase_Test_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$Cholinesterase_Test_summary->ShowFirstHeader = FALSE;
	}

	// Build detail SQL
	$sWhere = ewrpt_DetailFilterSQL($Cholinesterase_Test->Department, $Cholinesterase_Test->SqlFirstGroupField(), $Cholinesterase_Test->Department->GroupValue());
	if ($Cholinesterase_Test_summary->Filter != "")
		$sWhere = "($Cholinesterase_Test_summary->Filter) AND ($sWhere)";
	$sSql = ewrpt_BuildReportSql($Cholinesterase_Test->SqlSelect(), $Cholinesterase_Test->SqlWhere(), $Cholinesterase_Test->SqlGroupBy(), $Cholinesterase_Test->SqlHaving(), $Cholinesterase_Test->SqlOrderBy(), $sWhere, $Cholinesterase_Test_summary->Sort);
	$rs = $conn->Execute($sSql);
	$rsdtlcnt = ($rs) ? $rs->RecordCount() : 0;
	if ($rsdtlcnt > 0)
		$Cholinesterase_Test_summary->GetRow(1);
	while ($rs && !$rs->EOF) { // Loop detail records
		$Cholinesterase_Test_summary->RecCount++;

		// Render detail row
		$Cholinesterase_Test->ResetCSS();
		$Cholinesterase_Test->RowType = EWRPT_ROWTYPE_DETAIL;
		$Cholinesterase_Test_summary->RenderRow();
?>
	<tr<?php echo $Cholinesterase_Test->RowAttributes(); ?>>
		<td<?php echo $Cholinesterase_Test->Department->CellAttributes(); ?>><div<?php echo $Cholinesterase_Test->Department->ViewAttributes(); ?>><?php echo $Cholinesterase_Test->Department->GroupViewValue; ?></div></td>
		<td<?php echo $Cholinesterase_Test->ID->CellAttributes() ?>>
<div<?php echo $Cholinesterase_Test->ID->ViewAttributes(); ?>><?php echo $Cholinesterase_Test->ID->ListViewValue(); ?></div>
</td>
		<td<?php echo $Cholinesterase_Test->FirstName->CellAttributes() ?>>
<div<?php echo $Cholinesterase_Test->FirstName->ViewAttributes(); ?>><?php echo $Cholinesterase_Test->FirstName->ListViewValue(); ?></div>
</td>
		<td<?php echo $Cholinesterase_Test->MiddelName->CellAttributes() ?>>
<div<?php echo $Cholinesterase_Test->MiddelName->ViewAttributes(); ?>><?php echo $Cholinesterase_Test->MiddelName->ListViewValue(); ?></div>
</td>
		<td<?php echo $Cholinesterase_Test->LastName->CellAttributes() ?>>
<div<?php echo $Cholinesterase_Test->LastName->ViewAttributes(); ?>><?php echo $Cholinesterase_Test->LastName->ListViewValue(); ?></div>
</td>
		<td<?php echo $Cholinesterase_Test->LastResult->CellAttributes() ?>>
<div<?php echo $Cholinesterase_Test->LastResult->ViewAttributes(); ?>><?php echo $Cholinesterase_Test->LastResult->ListViewValue(); ?></div>
</td>
		<td<?php echo $Cholinesterase_Test->LastTestDate->CellAttributes() ?>>
<div<?php echo $Cholinesterase_Test->LastTestDate->ViewAttributes(); ?>><?php echo $Cholinesterase_Test->LastTestDate->ListViewValue(); ?></div>
</td>
		<td<?php echo $Cholinesterase_Test->FirstResult->CellAttributes() ?>>
<div<?php echo $Cholinesterase_Test->FirstResult->ViewAttributes(); ?>><?php echo $Cholinesterase_Test->FirstResult->ListViewValue(); ?></div>
</td>
		<td<?php echo $Cholinesterase_Test->FirstTestDate->CellAttributes() ?>>
<div<?php echo $Cholinesterase_Test->FirstTestDate->ViewAttributes(); ?>><?php echo $Cholinesterase_Test->FirstTestDate->ListViewValue(); ?></div>
</td>
		<td<?php echo $Cholinesterase_Test->FirstDifference->CellAttributes() ?>>
<div<?php echo $Cholinesterase_Test->FirstDifference->ViewAttributes(); ?>><?php echo $Cholinesterase_Test->FirstDifference->ListViewValue(); ?></div>
</td>
		<td<?php echo $Cholinesterase_Test->SecondResult->CellAttributes() ?>>
<div<?php echo $Cholinesterase_Test->SecondResult->ViewAttributes(); ?>><?php echo $Cholinesterase_Test->SecondResult->ListViewValue(); ?></div>
</td>
		<td<?php echo $Cholinesterase_Test->SecondTestDate->CellAttributes() ?>>
<div<?php echo $Cholinesterase_Test->SecondTestDate->ViewAttributes(); ?>><?php echo $Cholinesterase_Test->SecondTestDate->ListViewValue(); ?></div>
</td>
		<td<?php echo $Cholinesterase_Test->SecondDifference->CellAttributes() ?>>
<div<?php echo $Cholinesterase_Test->SecondDifference->ViewAttributes(); ?>><?php echo $Cholinesterase_Test->SecondDifference->ListViewValue(); ?></div>
</td>
		<td<?php echo $Cholinesterase_Test->ThirdResult->CellAttributes() ?>>
<div<?php echo $Cholinesterase_Test->ThirdResult->ViewAttributes(); ?>><?php echo $Cholinesterase_Test->ThirdResult->ListViewValue(); ?></div>
</td>
		<td<?php echo $Cholinesterase_Test->ThirdTestDate->CellAttributes() ?>>
<div<?php echo $Cholinesterase_Test->ThirdTestDate->ViewAttributes(); ?>><?php echo $Cholinesterase_Test->ThirdTestDate->ListViewValue(); ?></div>
</td>
		<td<?php echo $Cholinesterase_Test->ThirdDifference->CellAttributes() ?>>
<div<?php echo $Cholinesterase_Test->ThirdDifference->ViewAttributes(); ?>><?php echo $Cholinesterase_Test->ThirdDifference->ListViewValue(); ?></div>
</td>
		<td<?php echo $Cholinesterase_Test->ForthResult->CellAttributes() ?>>
<div<?php echo $Cholinesterase_Test->ForthResult->ViewAttributes(); ?>><?php echo $Cholinesterase_Test->ForthResult->ListViewValue(); ?></div>
</td>
		<td<?php echo $Cholinesterase_Test->ForthTestDate->CellAttributes() ?>>
<div<?php echo $Cholinesterase_Test->ForthTestDate->ViewAttributes(); ?>><?php echo $Cholinesterase_Test->ForthTestDate->ListViewValue(); ?></div>
</td>
		<td<?php echo $Cholinesterase_Test->ForthDifference->CellAttributes() ?>>
<div<?php echo $Cholinesterase_Test->ForthDifference->ViewAttributes(); ?>><?php echo $Cholinesterase_Test->ForthDifference->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$Cholinesterase_Test_summary->AccumulateSummary();

		// Get next record
		$Cholinesterase_Test_summary->GetRow(2);

		// Show Footers
?>
<?php
	} // End detail records loop
?>
<?php
			$Cholinesterase_Test->ResetCSS();
			$Cholinesterase_Test->RowType = EWRPT_ROWTYPE_TOTAL;
			$Cholinesterase_Test->RowTotalType = EWRPT_ROWTOTAL_GROUP;
			$Cholinesterase_Test->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
			$Cholinesterase_Test->RowGroupLevel = 1;
			$Cholinesterase_Test_summary->RenderRow();
?>
	<tr<?php echo $Cholinesterase_Test->RowAttributes(); ?>>
		<td colspan="19"<?php echo $Cholinesterase_Test->Department->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSumHead") ?> <?php echo $Cholinesterase_Test->Department->FldCaption() ?>: <?php echo $Cholinesterase_Test->Department->GroupViewValue; ?> (<?php echo ewrpt_FormatNumber($Cholinesterase_Test_summary->Cnt[1][0],0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php

			// Reset level 1 summary
			$Cholinesterase_Test_summary->ResetLevelSummary(1);
?>
<?php

	// Next group
	$Cholinesterase_Test_summary->GetGrpRow(2);
	$Cholinesterase_Test_summary->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
<?php if (intval(@$Cholinesterase_Test_summary->Cnt[0][18]) > 0) { ?>
<?php
	$Cholinesterase_Test->ResetCSS();
	$Cholinesterase_Test->RowType = EWRPT_ROWTYPE_TOTAL;
	$Cholinesterase_Test->RowTotalType = EWRPT_ROWTOTAL_PAGE;
	$Cholinesterase_Test->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
	$Cholinesterase_Test->RowAttrs["class"] = "ewRptPageSummary";
	$Cholinesterase_Test_summary->RenderRow();
?>
	<tr<?php echo $Cholinesterase_Test->RowAttributes(); ?>><td colspan="19"><?php echo $ReportLanguage->Phrase("RptPageTotal") ?> (<?php echo ewrpt_FormatNumber($Cholinesterase_Test_summary->Cnt[0][18],0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
	<!-- tr class="ewRptPageSummary"><td colspan="19"><span class="phpreportmaker">&nbsp;<br /></span></td></tr -->
<?php } ?>
<?php
if ($Cholinesterase_Test_summary->TotalGrps > 0) {
	$Cholinesterase_Test->ResetCSS();
	$Cholinesterase_Test->RowType = EWRPT_ROWTYPE_TOTAL;
	$Cholinesterase_Test->RowTotalType = EWRPT_ROWTOTAL_GRAND;
	$Cholinesterase_Test->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
	$Cholinesterase_Test->RowAttrs["class"] = "ewRptGrandSummary";
	$Cholinesterase_Test_summary->RenderRow();
?>
	<!-- tr><td colspan="19"><span class="phpreportmaker">&nbsp;<br /></span></td></tr -->
	<tr<?php echo $Cholinesterase_Test->RowAttributes(); ?>><td colspan="19"><?php echo $ReportLanguage->Phrase("RptGrandTotal") ?> (<?php echo ewrpt_FormatNumber($Cholinesterase_Test_summary->TotCount,0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php } ?>
	</tfoot>
</table>
</div>
<?php if ($Cholinesterase_Test_summary->TotalGrps > 0) { ?>
<?php if ($Cholinesterase_Test->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="Cholinesterase_Testsmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($Cholinesterase_Test_summary->StartGrp, $Cholinesterase_Test_summary->DisplayGrps, $Cholinesterase_Test_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="Cholinesterase_Testsmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="Cholinesterase_Testsmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="Cholinesterase_Testsmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="Cholinesterase_Testsmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($Cholinesterase_Test_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($Cholinesterase_Test_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($Cholinesterase_Test_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($Cholinesterase_Test_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($Cholinesterase_Test_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($Cholinesterase_Test_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($Cholinesterase_Test_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($Cholinesterase_Test_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($Cholinesterase_Test_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($Cholinesterase_Test_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($Cholinesterase_Test->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php if ($Cholinesterase_Test->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($Cholinesterase_Test->Export == "" || $Cholinesterase_Test->Export == "print" || $Cholinesterase_Test->Export == "email") { ?>
<?php } ?>
<?php if ($Cholinesterase_Test->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($Cholinesterase_Test->Export == "" || $Cholinesterase_Test->Export == "print" || $Cholinesterase_Test->Export == "email") { ?>
<?php } ?>
<?php if ($Cholinesterase_Test->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $Cholinesterase_Test_summary->ShowPageFooter(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($Cholinesterase_Test->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "phprptinc/footer.php"; ?>
<?php
$Cholinesterase_Test_summary->Page_Terminate();
?>
<?php

//
// Page class
//
class crCholinesterase_Test_summary {

	// Page ID
	var $PageID = 'summary';

	// Table name
	var $TableName = 'Cholinesterase Test';

	// Page object name
	var $PageObjName = 'Cholinesterase_Test_summary';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $Cholinesterase_Test;
		if ($Cholinesterase_Test->UseTokenInUrl) $PageUrl .= "t=" . $Cholinesterase_Test->TableVar . "&"; // Add page token
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
		global $Cholinesterase_Test;
		if ($Cholinesterase_Test->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($Cholinesterase_Test->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($Cholinesterase_Test->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crCholinesterase_Test_summary() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (Cholinesterase_Test)
		$GLOBALS["Cholinesterase_Test"] = new crCholinesterase_Test();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'summary', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'Cholinesterase Test', TRUE);

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
		global $Cholinesterase_Test;

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$Cholinesterase_Test->Export = $_GET["export"];
	}
	$gsExport = $Cholinesterase_Test->Export; // Get export parameter, used in header
	$gsExportFile = $Cholinesterase_Test->TableVar; // Get export file, used in header
	if ($Cholinesterase_Test->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($Cholinesterase_Test->Export == "word") {
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
		global $Cholinesterase_Test;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($Cholinesterase_Test->Export == "email") {
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
		global $Cholinesterase_Test;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 19;
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
		$this->Col = array(FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE);

		// Set up groups per page dynamically
		$this->SetUpDisplayGrps();
		$Cholinesterase_Test->Department->SelectionList = "";
		$Cholinesterase_Test->Department->DefaultSelectionList = "";
		$Cholinesterase_Test->Department->ValueList = "";
		$Cholinesterase_Test->ID->SelectionList = "";
		$Cholinesterase_Test->ID->DefaultSelectionList = "";
		$Cholinesterase_Test->ID->ValueList = "";
		$Cholinesterase_Test->FirstName->SelectionList = "";
		$Cholinesterase_Test->FirstName->DefaultSelectionList = "";
		$Cholinesterase_Test->FirstName->ValueList = "";
		$Cholinesterase_Test->MiddelName->SelectionList = "";
		$Cholinesterase_Test->MiddelName->DefaultSelectionList = "";
		$Cholinesterase_Test->MiddelName->ValueList = "";
		$Cholinesterase_Test->LastName->SelectionList = "";
		$Cholinesterase_Test->LastName->DefaultSelectionList = "";
		$Cholinesterase_Test->LastName->ValueList = "";
		$Cholinesterase_Test->LastResult->SelectionList = "";
		$Cholinesterase_Test->LastResult->DefaultSelectionList = "";
		$Cholinesterase_Test->LastResult->ValueList = "";
		$Cholinesterase_Test->LastTestDate->SelectionList = "";
		$Cholinesterase_Test->LastTestDate->DefaultSelectionList = "";
		$Cholinesterase_Test->LastTestDate->ValueList = "";
		$Cholinesterase_Test->FirstTestDate->SelectionList = "";
		$Cholinesterase_Test->FirstTestDate->DefaultSelectionList = "";
		$Cholinesterase_Test->FirstTestDate->ValueList = "";
		$Cholinesterase_Test->FirstDifference->SelectionList = "";
		$Cholinesterase_Test->FirstDifference->DefaultSelectionList = "";
		$Cholinesterase_Test->FirstDifference->ValueList = "";
		$Cholinesterase_Test->SecondResult->SelectionList = "";
		$Cholinesterase_Test->SecondResult->DefaultSelectionList = "";
		$Cholinesterase_Test->SecondResult->ValueList = "";
		$Cholinesterase_Test->SecondTestDate->SelectionList = "";
		$Cholinesterase_Test->SecondTestDate->DefaultSelectionList = "";
		$Cholinesterase_Test->SecondTestDate->ValueList = "";
		$Cholinesterase_Test->SecondDifference->SelectionList = "";
		$Cholinesterase_Test->SecondDifference->DefaultSelectionList = "";
		$Cholinesterase_Test->SecondDifference->ValueList = "";
		$Cholinesterase_Test->ThirdResult->SelectionList = "";
		$Cholinesterase_Test->ThirdResult->DefaultSelectionList = "";
		$Cholinesterase_Test->ThirdResult->ValueList = "";
		$Cholinesterase_Test->ThirdTestDate->SelectionList = "";
		$Cholinesterase_Test->ThirdTestDate->DefaultSelectionList = "";
		$Cholinesterase_Test->ThirdTestDate->ValueList = "";
		$Cholinesterase_Test->ThirdDifference->SelectionList = "";
		$Cholinesterase_Test->ThirdDifference->DefaultSelectionList = "";
		$Cholinesterase_Test->ThirdDifference->ValueList = "";
		$Cholinesterase_Test->ForthResult->SelectionList = "";
		$Cholinesterase_Test->ForthResult->DefaultSelectionList = "";
		$Cholinesterase_Test->ForthResult->ValueList = "";
		$Cholinesterase_Test->ForthTestDate->SelectionList = "";
		$Cholinesterase_Test->ForthTestDate->DefaultSelectionList = "";
		$Cholinesterase_Test->ForthTestDate->ValueList = "";
		$Cholinesterase_Test->ForthDifference->SelectionList = "";
		$Cholinesterase_Test->ForthDifference->DefaultSelectionList = "";
		$Cholinesterase_Test->ForthDifference->ValueList = "";

		// Load default filter values
		$this->LoadDefaultFilters();

		// Set up popup filter
		$this->SetupPopup();

		// Extended filter
		$sExtendedFilter = "";

		// Get dropdown values
		$this->GetExtendedFilterValues();

		// Load custom filters
		$Cholinesterase_Test->CustomFilters_Load();

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
		$sGrpSort = ewrpt_UpdateSortFields($Cholinesterase_Test->SqlOrderByGroup(), $this->Sort, 2); // Get grouping field only
		$sSql = ewrpt_BuildReportSql($Cholinesterase_Test->SqlSelectGroup(), $Cholinesterase_Test->SqlWhere(), $Cholinesterase_Test->SqlGroupBy(), $Cholinesterase_Test->SqlHaving(), $Cholinesterase_Test->SqlOrderByGroup(), $this->Filter, $sGrpSort);
		$this->TotalGrps = $this->GetGrpCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($Cholinesterase_Test->ExportAll && $Cholinesterase_Test->Export <> "")
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
		global $Cholinesterase_Test;
		switch ($lvl) {
			case 1:
				return (is_null($Cholinesterase_Test->Department->CurrentValue) && !is_null($Cholinesterase_Test->Department->OldValue)) ||
					(!is_null($Cholinesterase_Test->Department->CurrentValue) && is_null($Cholinesterase_Test->Department->OldValue)) ||
					($Cholinesterase_Test->Department->GroupValue() <> $Cholinesterase_Test->Department->GroupOldValue());
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
		global $Cholinesterase_Test;
		$rsgrpcnt = $conn->Execute($sql);
		$grpcnt = ($rsgrpcnt) ? $rsgrpcnt->RecordCount() : 0;
		if ($rsgrpcnt) $rsgrpcnt->Close();
		return $grpcnt;
	}

	// Get group rs
	function GetGrpRs($sql, $start, $grps) {
		global $conn;
		global $Cholinesterase_Test;
		$wrksql = $sql;
		if ($start > 0 && $grps > -1)
			$wrksql .= " LIMIT " . ($start-1) . ", " . ($grps);
		$rswrk = $conn->Execute($wrksql);
		return $rswrk;
	}

	// Get group row values
	function GetGrpRow($opt) {
		global $rsgrp;
		global $Cholinesterase_Test;
		if (!$rsgrp)
			return;
		if ($opt == 1) { // Get first group

			//$rsgrp->MoveFirst(); // NOTE: no need to move position
			$Cholinesterase_Test->Department->setDbValue(""); // Init first value
		} else { // Get next group
			$rsgrp->MoveNext();
		}
		if (!$rsgrp->EOF)
			$Cholinesterase_Test->Department->setDbValue($rsgrp->fields('Department'));
		if ($rsgrp->EOF) {
			$Cholinesterase_Test->Department->setDbValue("");
		}
	}

	// Get row values
	function GetRow($opt) {
		global $rs;
		global $Cholinesterase_Test;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$Cholinesterase_Test->Auto_ID->setDbValue($rs->fields('Auto_ID'));
			$Cholinesterase_Test->ID->setDbValue($rs->fields('ID'));
			$Cholinesterase_Test->FirstName->setDbValue($rs->fields('FirstName'));
			$Cholinesterase_Test->MiddelName->setDbValue($rs->fields('MiddelName'));
			$Cholinesterase_Test->LastName->setDbValue($rs->fields('LastName'));
			if ($opt <> 1)
				$Cholinesterase_Test->Department->setDbValue($rs->fields('Department'));
			$Cholinesterase_Test->LastResult->setDbValue($rs->fields('LastResult'));
			$Cholinesterase_Test->LastTestDate->setDbValue($rs->fields('LastTestDate'));
			$Cholinesterase_Test->FirstResult->setDbValue($rs->fields('FirstResult'));
			$Cholinesterase_Test->FirstTestDate->setDbValue($rs->fields('FirstTestDate'));
			$Cholinesterase_Test->FirstDifference->setDbValue($rs->fields('FirstDifference'));
			$Cholinesterase_Test->SecondResult->setDbValue($rs->fields('SecondResult'));
			$Cholinesterase_Test->SecondTestDate->setDbValue($rs->fields('SecondTestDate'));
			$Cholinesterase_Test->SecondDifference->setDbValue($rs->fields('SecondDifference'));
			$Cholinesterase_Test->ThirdResult->setDbValue($rs->fields('ThirdResult'));
			$Cholinesterase_Test->ThirdTestDate->setDbValue($rs->fields('ThirdTestDate'));
			$Cholinesterase_Test->ThirdDifference->setDbValue($rs->fields('ThirdDifference'));
			$Cholinesterase_Test->ForthResult->setDbValue($rs->fields('ForthResult'));
			$Cholinesterase_Test->ForthTestDate->setDbValue($rs->fields('ForthTestDate'));
			$Cholinesterase_Test->ForthDifference->setDbValue($rs->fields('ForthDifference'));
			$this->Val[1] = $Cholinesterase_Test->ID->CurrentValue;
			$this->Val[2] = $Cholinesterase_Test->FirstName->CurrentValue;
			$this->Val[3] = $Cholinesterase_Test->MiddelName->CurrentValue;
			$this->Val[4] = $Cholinesterase_Test->LastName->CurrentValue;
			$this->Val[5] = $Cholinesterase_Test->LastResult->CurrentValue;
			$this->Val[6] = $Cholinesterase_Test->LastTestDate->CurrentValue;
			$this->Val[7] = $Cholinesterase_Test->FirstResult->CurrentValue;
			$this->Val[8] = $Cholinesterase_Test->FirstTestDate->CurrentValue;
			$this->Val[9] = $Cholinesterase_Test->FirstDifference->CurrentValue;
			$this->Val[10] = $Cholinesterase_Test->SecondResult->CurrentValue;
			$this->Val[11] = $Cholinesterase_Test->SecondTestDate->CurrentValue;
			$this->Val[12] = $Cholinesterase_Test->SecondDifference->CurrentValue;
			$this->Val[13] = $Cholinesterase_Test->ThirdResult->CurrentValue;
			$this->Val[14] = $Cholinesterase_Test->ThirdTestDate->CurrentValue;
			$this->Val[15] = $Cholinesterase_Test->ThirdDifference->CurrentValue;
			$this->Val[16] = $Cholinesterase_Test->ForthResult->CurrentValue;
			$this->Val[17] = $Cholinesterase_Test->ForthTestDate->CurrentValue;
			$this->Val[18] = $Cholinesterase_Test->ForthDifference->CurrentValue;
		} else {
			$Cholinesterase_Test->Auto_ID->setDbValue("");
			$Cholinesterase_Test->ID->setDbValue("");
			$Cholinesterase_Test->FirstName->setDbValue("");
			$Cholinesterase_Test->MiddelName->setDbValue("");
			$Cholinesterase_Test->LastName->setDbValue("");
			$Cholinesterase_Test->Department->setDbValue("");
			$Cholinesterase_Test->LastResult->setDbValue("");
			$Cholinesterase_Test->LastTestDate->setDbValue("");
			$Cholinesterase_Test->FirstResult->setDbValue("");
			$Cholinesterase_Test->FirstTestDate->setDbValue("");
			$Cholinesterase_Test->FirstDifference->setDbValue("");
			$Cholinesterase_Test->SecondResult->setDbValue("");
			$Cholinesterase_Test->SecondTestDate->setDbValue("");
			$Cholinesterase_Test->SecondDifference->setDbValue("");
			$Cholinesterase_Test->ThirdResult->setDbValue("");
			$Cholinesterase_Test->ThirdTestDate->setDbValue("");
			$Cholinesterase_Test->ThirdDifference->setDbValue("");
			$Cholinesterase_Test->ForthResult->setDbValue("");
			$Cholinesterase_Test->ForthTestDate->setDbValue("");
			$Cholinesterase_Test->ForthDifference->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $Cholinesterase_Test;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$Cholinesterase_Test->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$Cholinesterase_Test->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $Cholinesterase_Test->getStartGroup();
			}
		} else {
			$this->StartGrp = $Cholinesterase_Test->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$Cholinesterase_Test->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$Cholinesterase_Test->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$Cholinesterase_Test->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $Cholinesterase_Test;

		// Initialize popup
		// Build distinct values for Department

		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Cholinesterase_Test->Department->SqlSelect, $Cholinesterase_Test->SqlWhere(), $Cholinesterase_Test->SqlGroupBy(), $Cholinesterase_Test->SqlHaving(), $Cholinesterase_Test->Department->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Cholinesterase_Test->Department->setDbValue($rswrk->fields[0]);
			if (is_null($Cholinesterase_Test->Department->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Cholinesterase_Test->Department->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Cholinesterase_Test->Department->GroupViewValue = ewrpt_DisplayGroupValue($Cholinesterase_Test->Department,$Cholinesterase_Test->Department->GroupValue());
				ewrpt_SetupDistinctValues($Cholinesterase_Test->Department->ValueList, $Cholinesterase_Test->Department->GroupValue(), $Cholinesterase_Test->Department->GroupViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->Department->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->Department->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for ID
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Cholinesterase_Test->ID->SqlSelect, $Cholinesterase_Test->SqlWhere(), $Cholinesterase_Test->SqlGroupBy(), $Cholinesterase_Test->SqlHaving(), $Cholinesterase_Test->ID->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Cholinesterase_Test->ID->setDbValue($rswrk->fields[0]);
			if (is_null($Cholinesterase_Test->ID->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Cholinesterase_Test->ID->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Cholinesterase_Test->ID->ViewValue = $Cholinesterase_Test->ID->CurrentValue;
				ewrpt_SetupDistinctValues($Cholinesterase_Test->ID->ValueList, $Cholinesterase_Test->ID->CurrentValue, $Cholinesterase_Test->ID->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->ID->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->ID->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for FirstName
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Cholinesterase_Test->FirstName->SqlSelect, $Cholinesterase_Test->SqlWhere(), $Cholinesterase_Test->SqlGroupBy(), $Cholinesterase_Test->SqlHaving(), $Cholinesterase_Test->FirstName->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Cholinesterase_Test->FirstName->setDbValue($rswrk->fields[0]);
			if (is_null($Cholinesterase_Test->FirstName->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Cholinesterase_Test->FirstName->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Cholinesterase_Test->FirstName->ViewValue = $Cholinesterase_Test->FirstName->CurrentValue;
				ewrpt_SetupDistinctValues($Cholinesterase_Test->FirstName->ValueList, $Cholinesterase_Test->FirstName->CurrentValue, $Cholinesterase_Test->FirstName->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->FirstName->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->FirstName->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for MiddelName
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Cholinesterase_Test->MiddelName->SqlSelect, $Cholinesterase_Test->SqlWhere(), $Cholinesterase_Test->SqlGroupBy(), $Cholinesterase_Test->SqlHaving(), $Cholinesterase_Test->MiddelName->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Cholinesterase_Test->MiddelName->setDbValue($rswrk->fields[0]);
			if (is_null($Cholinesterase_Test->MiddelName->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Cholinesterase_Test->MiddelName->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Cholinesterase_Test->MiddelName->ViewValue = $Cholinesterase_Test->MiddelName->CurrentValue;
				ewrpt_SetupDistinctValues($Cholinesterase_Test->MiddelName->ValueList, $Cholinesterase_Test->MiddelName->CurrentValue, $Cholinesterase_Test->MiddelName->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->MiddelName->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->MiddelName->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for LastName
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Cholinesterase_Test->LastName->SqlSelect, $Cholinesterase_Test->SqlWhere(), $Cholinesterase_Test->SqlGroupBy(), $Cholinesterase_Test->SqlHaving(), $Cholinesterase_Test->LastName->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Cholinesterase_Test->LastName->setDbValue($rswrk->fields[0]);
			if (is_null($Cholinesterase_Test->LastName->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Cholinesterase_Test->LastName->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Cholinesterase_Test->LastName->ViewValue = $Cholinesterase_Test->LastName->CurrentValue;
				ewrpt_SetupDistinctValues($Cholinesterase_Test->LastName->ValueList, $Cholinesterase_Test->LastName->CurrentValue, $Cholinesterase_Test->LastName->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->LastName->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->LastName->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for LastResult
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Cholinesterase_Test->LastResult->SqlSelect, $Cholinesterase_Test->SqlWhere(), $Cholinesterase_Test->SqlGroupBy(), $Cholinesterase_Test->SqlHaving(), $Cholinesterase_Test->LastResult->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Cholinesterase_Test->LastResult->setDbValue($rswrk->fields[0]);
			if (is_null($Cholinesterase_Test->LastResult->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Cholinesterase_Test->LastResult->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Cholinesterase_Test->LastResult->ViewValue = $Cholinesterase_Test->LastResult->CurrentValue;
				ewrpt_SetupDistinctValues($Cholinesterase_Test->LastResult->ValueList, $Cholinesterase_Test->LastResult->CurrentValue, $Cholinesterase_Test->LastResult->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->LastResult->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->LastResult->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for LastTestDate
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Cholinesterase_Test->LastTestDate->SqlSelect, $Cholinesterase_Test->SqlWhere(), $Cholinesterase_Test->SqlGroupBy(), $Cholinesterase_Test->SqlHaving(), $Cholinesterase_Test->LastTestDate->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Cholinesterase_Test->LastTestDate->setDbValue($rswrk->fields[0]);
			if (is_null($Cholinesterase_Test->LastTestDate->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Cholinesterase_Test->LastTestDate->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Cholinesterase_Test->LastTestDate->ViewValue = ewrpt_FormatDateTime($Cholinesterase_Test->LastTestDate->CurrentValue, 5);
				ewrpt_SetupDistinctValues($Cholinesterase_Test->LastTestDate->ValueList, $Cholinesterase_Test->LastTestDate->CurrentValue, $Cholinesterase_Test->LastTestDate->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->LastTestDate->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->LastTestDate->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for FirstTestDate
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Cholinesterase_Test->FirstTestDate->SqlSelect, $Cholinesterase_Test->SqlWhere(), $Cholinesterase_Test->SqlGroupBy(), $Cholinesterase_Test->SqlHaving(), $Cholinesterase_Test->FirstTestDate->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Cholinesterase_Test->FirstTestDate->setDbValue($rswrk->fields[0]);
			if (is_null($Cholinesterase_Test->FirstTestDate->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Cholinesterase_Test->FirstTestDate->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Cholinesterase_Test->FirstTestDate->ViewValue = ewrpt_FormatDateTime($Cholinesterase_Test->FirstTestDate->CurrentValue, 5);
				ewrpt_SetupDistinctValues($Cholinesterase_Test->FirstTestDate->ValueList, $Cholinesterase_Test->FirstTestDate->CurrentValue, $Cholinesterase_Test->FirstTestDate->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->FirstTestDate->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->FirstTestDate->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for FirstDifference
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Cholinesterase_Test->FirstDifference->SqlSelect, $Cholinesterase_Test->SqlWhere(), $Cholinesterase_Test->SqlGroupBy(), $Cholinesterase_Test->SqlHaving(), $Cholinesterase_Test->FirstDifference->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Cholinesterase_Test->FirstDifference->setDbValue($rswrk->fields[0]);
			if (is_null($Cholinesterase_Test->FirstDifference->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Cholinesterase_Test->FirstDifference->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Cholinesterase_Test->FirstDifference->ViewValue = $Cholinesterase_Test->FirstDifference->CurrentValue;
				ewrpt_SetupDistinctValues($Cholinesterase_Test->FirstDifference->ValueList, $Cholinesterase_Test->FirstDifference->CurrentValue, $Cholinesterase_Test->FirstDifference->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->FirstDifference->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->FirstDifference->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for SecondResult
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Cholinesterase_Test->SecondResult->SqlSelect, $Cholinesterase_Test->SqlWhere(), $Cholinesterase_Test->SqlGroupBy(), $Cholinesterase_Test->SqlHaving(), $Cholinesterase_Test->SecondResult->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Cholinesterase_Test->SecondResult->setDbValue($rswrk->fields[0]);
			if (is_null($Cholinesterase_Test->SecondResult->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Cholinesterase_Test->SecondResult->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Cholinesterase_Test->SecondResult->ViewValue = $Cholinesterase_Test->SecondResult->CurrentValue;
				ewrpt_SetupDistinctValues($Cholinesterase_Test->SecondResult->ValueList, $Cholinesterase_Test->SecondResult->CurrentValue, $Cholinesterase_Test->SecondResult->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->SecondResult->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->SecondResult->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for SecondTestDate
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Cholinesterase_Test->SecondTestDate->SqlSelect, $Cholinesterase_Test->SqlWhere(), $Cholinesterase_Test->SqlGroupBy(), $Cholinesterase_Test->SqlHaving(), $Cholinesterase_Test->SecondTestDate->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Cholinesterase_Test->SecondTestDate->setDbValue($rswrk->fields[0]);
			if (is_null($Cholinesterase_Test->SecondTestDate->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Cholinesterase_Test->SecondTestDate->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Cholinesterase_Test->SecondTestDate->ViewValue = ewrpt_FormatDateTime($Cholinesterase_Test->SecondTestDate->CurrentValue, 5);
				ewrpt_SetupDistinctValues($Cholinesterase_Test->SecondTestDate->ValueList, $Cholinesterase_Test->SecondTestDate->CurrentValue, $Cholinesterase_Test->SecondTestDate->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->SecondTestDate->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->SecondTestDate->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for SecondDifference
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Cholinesterase_Test->SecondDifference->SqlSelect, $Cholinesterase_Test->SqlWhere(), $Cholinesterase_Test->SqlGroupBy(), $Cholinesterase_Test->SqlHaving(), $Cholinesterase_Test->SecondDifference->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Cholinesterase_Test->SecondDifference->setDbValue($rswrk->fields[0]);
			if (is_null($Cholinesterase_Test->SecondDifference->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Cholinesterase_Test->SecondDifference->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Cholinesterase_Test->SecondDifference->ViewValue = $Cholinesterase_Test->SecondDifference->CurrentValue;
				ewrpt_SetupDistinctValues($Cholinesterase_Test->SecondDifference->ValueList, $Cholinesterase_Test->SecondDifference->CurrentValue, $Cholinesterase_Test->SecondDifference->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->SecondDifference->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->SecondDifference->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for ThirdResult
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Cholinesterase_Test->ThirdResult->SqlSelect, $Cholinesterase_Test->SqlWhere(), $Cholinesterase_Test->SqlGroupBy(), $Cholinesterase_Test->SqlHaving(), $Cholinesterase_Test->ThirdResult->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Cholinesterase_Test->ThirdResult->setDbValue($rswrk->fields[0]);
			if (is_null($Cholinesterase_Test->ThirdResult->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Cholinesterase_Test->ThirdResult->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Cholinesterase_Test->ThirdResult->ViewValue = $Cholinesterase_Test->ThirdResult->CurrentValue;
				ewrpt_SetupDistinctValues($Cholinesterase_Test->ThirdResult->ValueList, $Cholinesterase_Test->ThirdResult->CurrentValue, $Cholinesterase_Test->ThirdResult->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->ThirdResult->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->ThirdResult->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for ThirdTestDate
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Cholinesterase_Test->ThirdTestDate->SqlSelect, $Cholinesterase_Test->SqlWhere(), $Cholinesterase_Test->SqlGroupBy(), $Cholinesterase_Test->SqlHaving(), $Cholinesterase_Test->ThirdTestDate->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Cholinesterase_Test->ThirdTestDate->setDbValue($rswrk->fields[0]);
			if (is_null($Cholinesterase_Test->ThirdTestDate->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Cholinesterase_Test->ThirdTestDate->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Cholinesterase_Test->ThirdTestDate->ViewValue = ewrpt_FormatDateTime($Cholinesterase_Test->ThirdTestDate->CurrentValue, 5);
				ewrpt_SetupDistinctValues($Cholinesterase_Test->ThirdTestDate->ValueList, $Cholinesterase_Test->ThirdTestDate->CurrentValue, $Cholinesterase_Test->ThirdTestDate->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->ThirdTestDate->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->ThirdTestDate->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for ThirdDifference
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Cholinesterase_Test->ThirdDifference->SqlSelect, $Cholinesterase_Test->SqlWhere(), $Cholinesterase_Test->SqlGroupBy(), $Cholinesterase_Test->SqlHaving(), $Cholinesterase_Test->ThirdDifference->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Cholinesterase_Test->ThirdDifference->setDbValue($rswrk->fields[0]);
			if (is_null($Cholinesterase_Test->ThirdDifference->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Cholinesterase_Test->ThirdDifference->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Cholinesterase_Test->ThirdDifference->ViewValue = $Cholinesterase_Test->ThirdDifference->CurrentValue;
				ewrpt_SetupDistinctValues($Cholinesterase_Test->ThirdDifference->ValueList, $Cholinesterase_Test->ThirdDifference->CurrentValue, $Cholinesterase_Test->ThirdDifference->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->ThirdDifference->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->ThirdDifference->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for ForthResult
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Cholinesterase_Test->ForthResult->SqlSelect, $Cholinesterase_Test->SqlWhere(), $Cholinesterase_Test->SqlGroupBy(), $Cholinesterase_Test->SqlHaving(), $Cholinesterase_Test->ForthResult->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Cholinesterase_Test->ForthResult->setDbValue($rswrk->fields[0]);
			if (is_null($Cholinesterase_Test->ForthResult->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Cholinesterase_Test->ForthResult->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Cholinesterase_Test->ForthResult->ViewValue = $Cholinesterase_Test->ForthResult->CurrentValue;
				ewrpt_SetupDistinctValues($Cholinesterase_Test->ForthResult->ValueList, $Cholinesterase_Test->ForthResult->CurrentValue, $Cholinesterase_Test->ForthResult->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->ForthResult->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->ForthResult->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for ForthTestDate
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Cholinesterase_Test->ForthTestDate->SqlSelect, $Cholinesterase_Test->SqlWhere(), $Cholinesterase_Test->SqlGroupBy(), $Cholinesterase_Test->SqlHaving(), $Cholinesterase_Test->ForthTestDate->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Cholinesterase_Test->ForthTestDate->setDbValue($rswrk->fields[0]);
			if (is_null($Cholinesterase_Test->ForthTestDate->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Cholinesterase_Test->ForthTestDate->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Cholinesterase_Test->ForthTestDate->ViewValue = ewrpt_FormatDateTime($Cholinesterase_Test->ForthTestDate->CurrentValue, 5);
				ewrpt_SetupDistinctValues($Cholinesterase_Test->ForthTestDate->ValueList, $Cholinesterase_Test->ForthTestDate->CurrentValue, $Cholinesterase_Test->ForthTestDate->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->ForthTestDate->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->ForthTestDate->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for ForthDifference
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Cholinesterase_Test->ForthDifference->SqlSelect, $Cholinesterase_Test->SqlWhere(), $Cholinesterase_Test->SqlGroupBy(), $Cholinesterase_Test->SqlHaving(), $Cholinesterase_Test->ForthDifference->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Cholinesterase_Test->ForthDifference->setDbValue($rswrk->fields[0]);
			if (is_null($Cholinesterase_Test->ForthDifference->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Cholinesterase_Test->ForthDifference->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Cholinesterase_Test->ForthDifference->ViewValue = $Cholinesterase_Test->ForthDifference->CurrentValue;
				ewrpt_SetupDistinctValues($Cholinesterase_Test->ForthDifference->ValueList, $Cholinesterase_Test->ForthDifference->CurrentValue, $Cholinesterase_Test->ForthDifference->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->ForthDifference->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Cholinesterase_Test->ForthDifference->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

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
				$this->ClearSessionSelection('LastResult');
				$this->ClearSessionSelection('LastTestDate');
				$this->ClearSessionSelection('FirstTestDate');
				$this->ClearSessionSelection('FirstDifference');
				$this->ClearSessionSelection('SecondResult');
				$this->ClearSessionSelection('SecondTestDate');
				$this->ClearSessionSelection('SecondDifference');
				$this->ClearSessionSelection('ThirdResult');
				$this->ClearSessionSelection('ThirdTestDate');
				$this->ClearSessionSelection('ThirdDifference');
				$this->ClearSessionSelection('ForthResult');
				$this->ClearSessionSelection('ForthTestDate');
				$this->ClearSessionSelection('ForthDifference');
				$this->ResetPager();
			}
		}

		// Load selection criteria to array
		// Get Department selected values

		if (is_array(@$_SESSION["sel_Cholinesterase_Test_Department"])) {
			$this->LoadSelectionFromSession('Department');
		} elseif (@$_SESSION["sel_Cholinesterase_Test_Department"] == EWRPT_INIT_VALUE) { // Select all
			$Cholinesterase_Test->Department->SelectionList = "";
		}

		// Get ID selected values
		if (is_array(@$_SESSION["sel_Cholinesterase_Test_ID"])) {
			$this->LoadSelectionFromSession('ID');
		} elseif (@$_SESSION["sel_Cholinesterase_Test_ID"] == EWRPT_INIT_VALUE) { // Select all
			$Cholinesterase_Test->ID->SelectionList = "";
		}

		// Get First Name selected values
		if (is_array(@$_SESSION["sel_Cholinesterase_Test_FirstName"])) {
			$this->LoadSelectionFromSession('FirstName');
		} elseif (@$_SESSION["sel_Cholinesterase_Test_FirstName"] == EWRPT_INIT_VALUE) { // Select all
			$Cholinesterase_Test->FirstName->SelectionList = "";
		}

		// Get Middel Name selected values
		if (is_array(@$_SESSION["sel_Cholinesterase_Test_MiddelName"])) {
			$this->LoadSelectionFromSession('MiddelName');
		} elseif (@$_SESSION["sel_Cholinesterase_Test_MiddelName"] == EWRPT_INIT_VALUE) { // Select all
			$Cholinesterase_Test->MiddelName->SelectionList = "";
		}

		// Get Last Name selected values
		if (is_array(@$_SESSION["sel_Cholinesterase_Test_LastName"])) {
			$this->LoadSelectionFromSession('LastName');
		} elseif (@$_SESSION["sel_Cholinesterase_Test_LastName"] == EWRPT_INIT_VALUE) { // Select all
			$Cholinesterase_Test->LastName->SelectionList = "";
		}

		// Get Last Result selected values
		if (is_array(@$_SESSION["sel_Cholinesterase_Test_LastResult"])) {
			$this->LoadSelectionFromSession('LastResult');
		} elseif (@$_SESSION["sel_Cholinesterase_Test_LastResult"] == EWRPT_INIT_VALUE) { // Select all
			$Cholinesterase_Test->LastResult->SelectionList = "";
		}

		// Get Last Test Date selected values
		if (is_array(@$_SESSION["sel_Cholinesterase_Test_LastTestDate"])) {
			$this->LoadSelectionFromSession('LastTestDate');
		} elseif (@$_SESSION["sel_Cholinesterase_Test_LastTestDate"] == EWRPT_INIT_VALUE) { // Select all
			$Cholinesterase_Test->LastTestDate->SelectionList = "";
		}

		// Get First Test Date selected values
		if (is_array(@$_SESSION["sel_Cholinesterase_Test_FirstTestDate"])) {
			$this->LoadSelectionFromSession('FirstTestDate');
		} elseif (@$_SESSION["sel_Cholinesterase_Test_FirstTestDate"] == EWRPT_INIT_VALUE) { // Select all
			$Cholinesterase_Test->FirstTestDate->SelectionList = "";
		}

		// Get First Difference selected values
		if (is_array(@$_SESSION["sel_Cholinesterase_Test_FirstDifference"])) {
			$this->LoadSelectionFromSession('FirstDifference');
		} elseif (@$_SESSION["sel_Cholinesterase_Test_FirstDifference"] == EWRPT_INIT_VALUE) { // Select all
			$Cholinesterase_Test->FirstDifference->SelectionList = "";
		}

		// Get Second Result selected values
		if (is_array(@$_SESSION["sel_Cholinesterase_Test_SecondResult"])) {
			$this->LoadSelectionFromSession('SecondResult');
		} elseif (@$_SESSION["sel_Cholinesterase_Test_SecondResult"] == EWRPT_INIT_VALUE) { // Select all
			$Cholinesterase_Test->SecondResult->SelectionList = "";
		}

		// Get Second Test Date selected values
		if (is_array(@$_SESSION["sel_Cholinesterase_Test_SecondTestDate"])) {
			$this->LoadSelectionFromSession('SecondTestDate');
		} elseif (@$_SESSION["sel_Cholinesterase_Test_SecondTestDate"] == EWRPT_INIT_VALUE) { // Select all
			$Cholinesterase_Test->SecondTestDate->SelectionList = "";
		}

		// Get Second Difference selected values
		if (is_array(@$_SESSION["sel_Cholinesterase_Test_SecondDifference"])) {
			$this->LoadSelectionFromSession('SecondDifference');
		} elseif (@$_SESSION["sel_Cholinesterase_Test_SecondDifference"] == EWRPT_INIT_VALUE) { // Select all
			$Cholinesterase_Test->SecondDifference->SelectionList = "";
		}

		// Get Third Result selected values
		if (is_array(@$_SESSION["sel_Cholinesterase_Test_ThirdResult"])) {
			$this->LoadSelectionFromSession('ThirdResult');
		} elseif (@$_SESSION["sel_Cholinesterase_Test_ThirdResult"] == EWRPT_INIT_VALUE) { // Select all
			$Cholinesterase_Test->ThirdResult->SelectionList = "";
		}

		// Get Third Test Date selected values
		if (is_array(@$_SESSION["sel_Cholinesterase_Test_ThirdTestDate"])) {
			$this->LoadSelectionFromSession('ThirdTestDate');
		} elseif (@$_SESSION["sel_Cholinesterase_Test_ThirdTestDate"] == EWRPT_INIT_VALUE) { // Select all
			$Cholinesterase_Test->ThirdTestDate->SelectionList = "";
		}

		// Get Third Difference selected values
		if (is_array(@$_SESSION["sel_Cholinesterase_Test_ThirdDifference"])) {
			$this->LoadSelectionFromSession('ThirdDifference');
		} elseif (@$_SESSION["sel_Cholinesterase_Test_ThirdDifference"] == EWRPT_INIT_VALUE) { // Select all
			$Cholinesterase_Test->ThirdDifference->SelectionList = "";
		}

		// Get Forth Result selected values
		if (is_array(@$_SESSION["sel_Cholinesterase_Test_ForthResult"])) {
			$this->LoadSelectionFromSession('ForthResult');
		} elseif (@$_SESSION["sel_Cholinesterase_Test_ForthResult"] == EWRPT_INIT_VALUE) { // Select all
			$Cholinesterase_Test->ForthResult->SelectionList = "";
		}

		// Get Forth Test Date selected values
		if (is_array(@$_SESSION["sel_Cholinesterase_Test_ForthTestDate"])) {
			$this->LoadSelectionFromSession('ForthTestDate');
		} elseif (@$_SESSION["sel_Cholinesterase_Test_ForthTestDate"] == EWRPT_INIT_VALUE) { // Select all
			$Cholinesterase_Test->ForthTestDate->SelectionList = "";
		}

		// Get Forth Difference selected values
		if (is_array(@$_SESSION["sel_Cholinesterase_Test_ForthDifference"])) {
			$this->LoadSelectionFromSession('ForthDifference');
		} elseif (@$_SESSION["sel_Cholinesterase_Test_ForthDifference"] == EWRPT_INIT_VALUE) { // Select all
			$Cholinesterase_Test->ForthDifference->SelectionList = "";
		}
	}

	// Reset pager
	function ResetPager() {

		// Reset start position (reset command)
		global $Cholinesterase_Test;
		$this->StartGrp = 1;
		$Cholinesterase_Test->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $Cholinesterase_Test;
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
			$Cholinesterase_Test->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$Cholinesterase_Test->setStartGroup($this->StartGrp);
		} else {
			if ($Cholinesterase_Test->getGroupPerPage() <> "") {
				$this->DisplayGrps = $Cholinesterase_Test->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $Security;
		global $Cholinesterase_Test;
		if ($Cholinesterase_Test->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($Cholinesterase_Test->SqlSelectCount(), $Cholinesterase_Test->SqlWhere(), $Cholinesterase_Test->SqlGroupBy(), $Cholinesterase_Test->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}
		}

		// Call Row_Rendering event
		$Cholinesterase_Test->Row_Rendering();

		/* --------------------
		'  Render view codes
		' --------------------- */
		if ($Cholinesterase_Test->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// Department
			$Cholinesterase_Test->Department->GroupViewValue = $Cholinesterase_Test->Department->GroupOldValue();
			$Cholinesterase_Test->Department->CellAttrs["class"] = ($Cholinesterase_Test->RowGroupLevel == 1) ? "ewRptGrpSummary1" : "ewRptGrpField1";
			$Cholinesterase_Test->Department->GroupViewValue = ewrpt_DisplayGroupValue($Cholinesterase_Test->Department, $Cholinesterase_Test->Department->GroupViewValue);

			// ID
			$Cholinesterase_Test->ID->ViewValue = $Cholinesterase_Test->ID->Summary;

			// FirstName
			$Cholinesterase_Test->FirstName->ViewValue = $Cholinesterase_Test->FirstName->Summary;

			// MiddelName
			$Cholinesterase_Test->MiddelName->ViewValue = $Cholinesterase_Test->MiddelName->Summary;

			// LastName
			$Cholinesterase_Test->LastName->ViewValue = $Cholinesterase_Test->LastName->Summary;

			// LastResult
			$Cholinesterase_Test->LastResult->ViewValue = $Cholinesterase_Test->LastResult->Summary;

			// LastTestDate
			$Cholinesterase_Test->LastTestDate->ViewValue = $Cholinesterase_Test->LastTestDate->Summary;
			$Cholinesterase_Test->LastTestDate->ViewValue = ewrpt_FormatDateTime($Cholinesterase_Test->LastTestDate->ViewValue, 5);

			// FirstResult
			$Cholinesterase_Test->FirstResult->ViewValue = $Cholinesterase_Test->FirstResult->Summary;

			// FirstTestDate
			$Cholinesterase_Test->FirstTestDate->ViewValue = $Cholinesterase_Test->FirstTestDate->Summary;
			$Cholinesterase_Test->FirstTestDate->ViewValue = ewrpt_FormatDateTime($Cholinesterase_Test->FirstTestDate->ViewValue, 5);

			// FirstDifference
			$Cholinesterase_Test->FirstDifference->ViewValue = $Cholinesterase_Test->FirstDifference->Summary;

			// SecondResult
			$Cholinesterase_Test->SecondResult->ViewValue = $Cholinesterase_Test->SecondResult->Summary;

			// SecondTestDate
			$Cholinesterase_Test->SecondTestDate->ViewValue = $Cholinesterase_Test->SecondTestDate->Summary;
			$Cholinesterase_Test->SecondTestDate->ViewValue = ewrpt_FormatDateTime($Cholinesterase_Test->SecondTestDate->ViewValue, 5);

			// SecondDifference
			$Cholinesterase_Test->SecondDifference->ViewValue = $Cholinesterase_Test->SecondDifference->Summary;

			// ThirdResult
			$Cholinesterase_Test->ThirdResult->ViewValue = $Cholinesterase_Test->ThirdResult->Summary;

			// ThirdTestDate
			$Cholinesterase_Test->ThirdTestDate->ViewValue = $Cholinesterase_Test->ThirdTestDate->Summary;
			$Cholinesterase_Test->ThirdTestDate->ViewValue = ewrpt_FormatDateTime($Cholinesterase_Test->ThirdTestDate->ViewValue, 5);

			// ThirdDifference
			$Cholinesterase_Test->ThirdDifference->ViewValue = $Cholinesterase_Test->ThirdDifference->Summary;

			// ForthResult
			$Cholinesterase_Test->ForthResult->ViewValue = $Cholinesterase_Test->ForthResult->Summary;

			// ForthTestDate
			$Cholinesterase_Test->ForthTestDate->ViewValue = $Cholinesterase_Test->ForthTestDate->Summary;
			$Cholinesterase_Test->ForthTestDate->ViewValue = ewrpt_FormatDateTime($Cholinesterase_Test->ForthTestDate->ViewValue, 5);

			// ForthDifference
			$Cholinesterase_Test->ForthDifference->ViewValue = $Cholinesterase_Test->ForthDifference->Summary;
		} else {

			// Department
			$Cholinesterase_Test->Department->GroupViewValue = $Cholinesterase_Test->Department->GroupValue();
			$Cholinesterase_Test->Department->CellAttrs["class"] = "ewRptGrpField1";
			$Cholinesterase_Test->Department->GroupViewValue = ewrpt_DisplayGroupValue($Cholinesterase_Test->Department, $Cholinesterase_Test->Department->GroupViewValue);
			if ($Cholinesterase_Test->Department->GroupValue() == $Cholinesterase_Test->Department->GroupOldValue() && !$this->ChkLvlBreak(1))
				$Cholinesterase_Test->Department->GroupViewValue = "&nbsp;";

			// ID
			$Cholinesterase_Test->ID->ViewValue = $Cholinesterase_Test->ID->CurrentValue;
			$Cholinesterase_Test->ID->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// FirstName
			$Cholinesterase_Test->FirstName->ViewValue = $Cholinesterase_Test->FirstName->CurrentValue;
			$Cholinesterase_Test->FirstName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// MiddelName
			$Cholinesterase_Test->MiddelName->ViewValue = $Cholinesterase_Test->MiddelName->CurrentValue;
			$Cholinesterase_Test->MiddelName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// LastName
			$Cholinesterase_Test->LastName->ViewValue = $Cholinesterase_Test->LastName->CurrentValue;
			$Cholinesterase_Test->LastName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// LastResult
			$Cholinesterase_Test->LastResult->ViewValue = $Cholinesterase_Test->LastResult->CurrentValue;
			$Cholinesterase_Test->LastResult->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// LastTestDate
			$Cholinesterase_Test->LastTestDate->ViewValue = $Cholinesterase_Test->LastTestDate->CurrentValue;
			$Cholinesterase_Test->LastTestDate->ViewValue = ewrpt_FormatDateTime($Cholinesterase_Test->LastTestDate->ViewValue, 5);
			$Cholinesterase_Test->LastTestDate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// FirstResult
			$Cholinesterase_Test->FirstResult->ViewValue = $Cholinesterase_Test->FirstResult->CurrentValue;
			$Cholinesterase_Test->FirstResult->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// FirstTestDate
			$Cholinesterase_Test->FirstTestDate->ViewValue = $Cholinesterase_Test->FirstTestDate->CurrentValue;
			$Cholinesterase_Test->FirstTestDate->ViewValue = ewrpt_FormatDateTime($Cholinesterase_Test->FirstTestDate->ViewValue, 5);
			$Cholinesterase_Test->FirstTestDate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// FirstDifference
			$Cholinesterase_Test->FirstDifference->ViewValue = $Cholinesterase_Test->FirstDifference->CurrentValue;
			$Cholinesterase_Test->FirstDifference->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// SecondResult
			$Cholinesterase_Test->SecondResult->ViewValue = $Cholinesterase_Test->SecondResult->CurrentValue;
			$Cholinesterase_Test->SecondResult->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// SecondTestDate
			$Cholinesterase_Test->SecondTestDate->ViewValue = $Cholinesterase_Test->SecondTestDate->CurrentValue;
			$Cholinesterase_Test->SecondTestDate->ViewValue = ewrpt_FormatDateTime($Cholinesterase_Test->SecondTestDate->ViewValue, 5);
			$Cholinesterase_Test->SecondTestDate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// SecondDifference
			$Cholinesterase_Test->SecondDifference->ViewValue = $Cholinesterase_Test->SecondDifference->CurrentValue;
			$Cholinesterase_Test->SecondDifference->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// ThirdResult
			$Cholinesterase_Test->ThirdResult->ViewValue = $Cholinesterase_Test->ThirdResult->CurrentValue;
			$Cholinesterase_Test->ThirdResult->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// ThirdTestDate
			$Cholinesterase_Test->ThirdTestDate->ViewValue = $Cholinesterase_Test->ThirdTestDate->CurrentValue;
			$Cholinesterase_Test->ThirdTestDate->ViewValue = ewrpt_FormatDateTime($Cholinesterase_Test->ThirdTestDate->ViewValue, 5);
			$Cholinesterase_Test->ThirdTestDate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// ThirdDifference
			$Cholinesterase_Test->ThirdDifference->ViewValue = $Cholinesterase_Test->ThirdDifference->CurrentValue;
			$Cholinesterase_Test->ThirdDifference->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// ForthResult
			$Cholinesterase_Test->ForthResult->ViewValue = $Cholinesterase_Test->ForthResult->CurrentValue;
			$Cholinesterase_Test->ForthResult->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// ForthTestDate
			$Cholinesterase_Test->ForthTestDate->ViewValue = $Cholinesterase_Test->ForthTestDate->CurrentValue;
			$Cholinesterase_Test->ForthTestDate->ViewValue = ewrpt_FormatDateTime($Cholinesterase_Test->ForthTestDate->ViewValue, 5);
			$Cholinesterase_Test->ForthTestDate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// ForthDifference
			$Cholinesterase_Test->ForthDifference->ViewValue = $Cholinesterase_Test->ForthDifference->CurrentValue;
			$Cholinesterase_Test->ForthDifference->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// Department
		$Cholinesterase_Test->Department->HrefValue = "";

		// ID
		$Cholinesterase_Test->ID->HrefValue = "";

		// FirstName
		$Cholinesterase_Test->FirstName->HrefValue = "";

		// MiddelName
		$Cholinesterase_Test->MiddelName->HrefValue = "";

		// LastName
		$Cholinesterase_Test->LastName->HrefValue = "";

		// LastResult
		$Cholinesterase_Test->LastResult->HrefValue = "";

		// LastTestDate
		$Cholinesterase_Test->LastTestDate->HrefValue = "";

		// FirstResult
		$Cholinesterase_Test->FirstResult->HrefValue = "";

		// FirstTestDate
		$Cholinesterase_Test->FirstTestDate->HrefValue = "";

		// FirstDifference
		$Cholinesterase_Test->FirstDifference->HrefValue = "";

		// SecondResult
		$Cholinesterase_Test->SecondResult->HrefValue = "";

		// SecondTestDate
		$Cholinesterase_Test->SecondTestDate->HrefValue = "";

		// SecondDifference
		$Cholinesterase_Test->SecondDifference->HrefValue = "";

		// ThirdResult
		$Cholinesterase_Test->ThirdResult->HrefValue = "";

		// ThirdTestDate
		$Cholinesterase_Test->ThirdTestDate->HrefValue = "";

		// ThirdDifference
		$Cholinesterase_Test->ThirdDifference->HrefValue = "";

		// ForthResult
		$Cholinesterase_Test->ForthResult->HrefValue = "";

		// ForthTestDate
		$Cholinesterase_Test->ForthTestDate->HrefValue = "";

		// ForthDifference
		$Cholinesterase_Test->ForthDifference->HrefValue = "";

		// Call Row_Rendered event
		$Cholinesterase_Test->Row_Rendered();
	}

	// Get extended filter values
	function GetExtendedFilterValues() {
		global $Cholinesterase_Test;
	}

	// Return extended filter
	function GetExtendedFilter() {
		global $Cholinesterase_Test;
		global $gsFormError;
		$sFilter = "";
		$bPostBack = ewrpt_IsHttpPost();
		$bRestoreSession = TRUE;
		$bSetupFilter = FALSE;

		// Reset extended filter if filter changed
		if ($bPostBack) {

			// Clear extended filter for field ID
			if ($this->ClearExtFilter == 'Cholinesterase_Test_ID')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'ID');

			// Clear extended filter for field FirstName
			if ($this->ClearExtFilter == 'Cholinesterase_Test_FirstName')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'FirstName');

			// Clear extended filter for field MiddelName
			if ($this->ClearExtFilter == 'Cholinesterase_Test_MiddelName')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'MiddelName');

			// Clear extended filter for field LastName
			if ($this->ClearExtFilter == 'Cholinesterase_Test_LastName')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'LastName');

			// Clear extended filter for field Department
			if ($this->ClearExtFilter == 'Cholinesterase_Test_Department')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'Department');

			// Clear extended filter for field LastResult
			if ($this->ClearExtFilter == 'Cholinesterase_Test_LastResult')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'LastResult');

			// Clear extended filter for field LastTestDate
			if ($this->ClearExtFilter == 'Cholinesterase_Test_LastTestDate')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'LastTestDate');

			// Clear extended filter for field FirstTestDate
			if ($this->ClearExtFilter == 'Cholinesterase_Test_FirstTestDate')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'FirstTestDate');

			// Clear extended filter for field FirstDifference
			if ($this->ClearExtFilter == 'Cholinesterase_Test_FirstDifference')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'FirstDifference');

			// Clear extended filter for field SecondResult
			if ($this->ClearExtFilter == 'Cholinesterase_Test_SecondResult')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'SecondResult');

			// Clear extended filter for field SecondTestDate
			if ($this->ClearExtFilter == 'Cholinesterase_Test_SecondTestDate')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'SecondTestDate');

			// Clear extended filter for field SecondDifference
			if ($this->ClearExtFilter == 'Cholinesterase_Test_SecondDifference')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'SecondDifference');

			// Clear extended filter for field ThirdResult
			if ($this->ClearExtFilter == 'Cholinesterase_Test_ThirdResult')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'ThirdResult');

			// Clear extended filter for field ThirdTestDate
			if ($this->ClearExtFilter == 'Cholinesterase_Test_ThirdTestDate')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'ThirdTestDate');

			// Clear extended filter for field ThirdDifference
			if ($this->ClearExtFilter == 'Cholinesterase_Test_ThirdDifference')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'ThirdDifference');

			// Clear extended filter for field ForthResult
			if ($this->ClearExtFilter == 'Cholinesterase_Test_ForthResult')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'ForthResult');

			// Clear extended filter for field ForthTestDate
			if ($this->ClearExtFilter == 'Cholinesterase_Test_ForthTestDate')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'ForthTestDate');

			// Clear extended filter for field ForthDifference
			if ($this->ClearExtFilter == 'Cholinesterase_Test_ForthDifference')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'ForthDifference');

		// Reset search command
		} elseif (@$_GET["cmd"] == "reset") {

			// Load default values
			// Field ID

			$this->SetSessionFilterValues($Cholinesterase_Test->ID->SearchValue, $Cholinesterase_Test->ID->SearchOperator, $Cholinesterase_Test->ID->SearchCondition, $Cholinesterase_Test->ID->SearchValue2, $Cholinesterase_Test->ID->SearchOperator2, 'ID');

			// Field FirstName
			$this->SetSessionFilterValues($Cholinesterase_Test->FirstName->SearchValue, $Cholinesterase_Test->FirstName->SearchOperator, $Cholinesterase_Test->FirstName->SearchCondition, $Cholinesterase_Test->FirstName->SearchValue2, $Cholinesterase_Test->FirstName->SearchOperator2, 'FirstName');

			// Field MiddelName
			$this->SetSessionFilterValues($Cholinesterase_Test->MiddelName->SearchValue, $Cholinesterase_Test->MiddelName->SearchOperator, $Cholinesterase_Test->MiddelName->SearchCondition, $Cholinesterase_Test->MiddelName->SearchValue2, $Cholinesterase_Test->MiddelName->SearchOperator2, 'MiddelName');

			// Field LastName
			$this->SetSessionFilterValues($Cholinesterase_Test->LastName->SearchValue, $Cholinesterase_Test->LastName->SearchOperator, $Cholinesterase_Test->LastName->SearchCondition, $Cholinesterase_Test->LastName->SearchValue2, $Cholinesterase_Test->LastName->SearchOperator2, 'LastName');

			// Field Department
			$this->SetSessionFilterValues($Cholinesterase_Test->Department->SearchValue, $Cholinesterase_Test->Department->SearchOperator, $Cholinesterase_Test->Department->SearchCondition, $Cholinesterase_Test->Department->SearchValue2, $Cholinesterase_Test->Department->SearchOperator2, 'Department');

			// Field LastResult
			$this->SetSessionFilterValues($Cholinesterase_Test->LastResult->SearchValue, $Cholinesterase_Test->LastResult->SearchOperator, $Cholinesterase_Test->LastResult->SearchCondition, $Cholinesterase_Test->LastResult->SearchValue2, $Cholinesterase_Test->LastResult->SearchOperator2, 'LastResult');

			// Field LastTestDate
			$this->SetSessionFilterValues($Cholinesterase_Test->LastTestDate->SearchValue, $Cholinesterase_Test->LastTestDate->SearchOperator, $Cholinesterase_Test->LastTestDate->SearchCondition, $Cholinesterase_Test->LastTestDate->SearchValue2, $Cholinesterase_Test->LastTestDate->SearchOperator2, 'LastTestDate');

			// Field FirstResult
			$this->SetSessionFilterValues($Cholinesterase_Test->FirstResult->SearchValue, $Cholinesterase_Test->FirstResult->SearchOperator, $Cholinesterase_Test->FirstResult->SearchCondition, $Cholinesterase_Test->FirstResult->SearchValue2, $Cholinesterase_Test->FirstResult->SearchOperator2, 'FirstResult');

			// Field FirstTestDate
			$this->SetSessionFilterValues($Cholinesterase_Test->FirstTestDate->SearchValue, $Cholinesterase_Test->FirstTestDate->SearchOperator, $Cholinesterase_Test->FirstTestDate->SearchCondition, $Cholinesterase_Test->FirstTestDate->SearchValue2, $Cholinesterase_Test->FirstTestDate->SearchOperator2, 'FirstTestDate');

			// Field FirstDifference
			$this->SetSessionFilterValues($Cholinesterase_Test->FirstDifference->SearchValue, $Cholinesterase_Test->FirstDifference->SearchOperator, $Cholinesterase_Test->FirstDifference->SearchCondition, $Cholinesterase_Test->FirstDifference->SearchValue2, $Cholinesterase_Test->FirstDifference->SearchOperator2, 'FirstDifference');

			// Field SecondResult
			$this->SetSessionFilterValues($Cholinesterase_Test->SecondResult->SearchValue, $Cholinesterase_Test->SecondResult->SearchOperator, $Cholinesterase_Test->SecondResult->SearchCondition, $Cholinesterase_Test->SecondResult->SearchValue2, $Cholinesterase_Test->SecondResult->SearchOperator2, 'SecondResult');

			// Field SecondTestDate
			$this->SetSessionFilterValues($Cholinesterase_Test->SecondTestDate->SearchValue, $Cholinesterase_Test->SecondTestDate->SearchOperator, $Cholinesterase_Test->SecondTestDate->SearchCondition, $Cholinesterase_Test->SecondTestDate->SearchValue2, $Cholinesterase_Test->SecondTestDate->SearchOperator2, 'SecondTestDate');

			// Field SecondDifference
			$this->SetSessionFilterValues($Cholinesterase_Test->SecondDifference->SearchValue, $Cholinesterase_Test->SecondDifference->SearchOperator, $Cholinesterase_Test->SecondDifference->SearchCondition, $Cholinesterase_Test->SecondDifference->SearchValue2, $Cholinesterase_Test->SecondDifference->SearchOperator2, 'SecondDifference');

			// Field ThirdResult
			$this->SetSessionFilterValues($Cholinesterase_Test->ThirdResult->SearchValue, $Cholinesterase_Test->ThirdResult->SearchOperator, $Cholinesterase_Test->ThirdResult->SearchCondition, $Cholinesterase_Test->ThirdResult->SearchValue2, $Cholinesterase_Test->ThirdResult->SearchOperator2, 'ThirdResult');

			// Field ThirdTestDate
			$this->SetSessionFilterValues($Cholinesterase_Test->ThirdTestDate->SearchValue, $Cholinesterase_Test->ThirdTestDate->SearchOperator, $Cholinesterase_Test->ThirdTestDate->SearchCondition, $Cholinesterase_Test->ThirdTestDate->SearchValue2, $Cholinesterase_Test->ThirdTestDate->SearchOperator2, 'ThirdTestDate');

			// Field ThirdDifference
			$this->SetSessionFilterValues($Cholinesterase_Test->ThirdDifference->SearchValue, $Cholinesterase_Test->ThirdDifference->SearchOperator, $Cholinesterase_Test->ThirdDifference->SearchCondition, $Cholinesterase_Test->ThirdDifference->SearchValue2, $Cholinesterase_Test->ThirdDifference->SearchOperator2, 'ThirdDifference');

			// Field ForthResult
			$this->SetSessionFilterValues($Cholinesterase_Test->ForthResult->SearchValue, $Cholinesterase_Test->ForthResult->SearchOperator, $Cholinesterase_Test->ForthResult->SearchCondition, $Cholinesterase_Test->ForthResult->SearchValue2, $Cholinesterase_Test->ForthResult->SearchOperator2, 'ForthResult');

			// Field ForthTestDate
			$this->SetSessionFilterValues($Cholinesterase_Test->ForthTestDate->SearchValue, $Cholinesterase_Test->ForthTestDate->SearchOperator, $Cholinesterase_Test->ForthTestDate->SearchCondition, $Cholinesterase_Test->ForthTestDate->SearchValue2, $Cholinesterase_Test->ForthTestDate->SearchOperator2, 'ForthTestDate');

			// Field ForthDifference
			$this->SetSessionFilterValues($Cholinesterase_Test->ForthDifference->SearchValue, $Cholinesterase_Test->ForthDifference->SearchOperator, $Cholinesterase_Test->ForthDifference->SearchCondition, $Cholinesterase_Test->ForthDifference->SearchValue2, $Cholinesterase_Test->ForthDifference->SearchOperator2, 'ForthDifference');
			$bSetupFilter = TRUE;
		} else {

			// Field ID
			if ($this->GetFilterValues($Cholinesterase_Test->ID)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field FirstName
			if ($this->GetFilterValues($Cholinesterase_Test->FirstName)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field MiddelName
			if ($this->GetFilterValues($Cholinesterase_Test->MiddelName)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field LastName
			if ($this->GetFilterValues($Cholinesterase_Test->LastName)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field Department
			if ($this->GetFilterValues($Cholinesterase_Test->Department)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field LastResult
			if ($this->GetFilterValues($Cholinesterase_Test->LastResult)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field LastTestDate
			if ($this->GetFilterValues($Cholinesterase_Test->LastTestDate)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field FirstResult
			if ($this->GetFilterValues($Cholinesterase_Test->FirstResult)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field FirstTestDate
			if ($this->GetFilterValues($Cholinesterase_Test->FirstTestDate)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field FirstDifference
			if ($this->GetFilterValues($Cholinesterase_Test->FirstDifference)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field SecondResult
			if ($this->GetFilterValues($Cholinesterase_Test->SecondResult)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field SecondTestDate
			if ($this->GetFilterValues($Cholinesterase_Test->SecondTestDate)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field SecondDifference
			if ($this->GetFilterValues($Cholinesterase_Test->SecondDifference)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field ThirdResult
			if ($this->GetFilterValues($Cholinesterase_Test->ThirdResult)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field ThirdTestDate
			if ($this->GetFilterValues($Cholinesterase_Test->ThirdTestDate)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field ThirdDifference
			if ($this->GetFilterValues($Cholinesterase_Test->ThirdDifference)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field ForthResult
			if ($this->GetFilterValues($Cholinesterase_Test->ForthResult)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field ForthTestDate
			if ($this->GetFilterValues($Cholinesterase_Test->ForthTestDate)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field ForthDifference
			if ($this->GetFilterValues($Cholinesterase_Test->ForthDifference)) {
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
			$this->GetSessionFilterValues($Cholinesterase_Test->ID);

			// Field FirstName
			$this->GetSessionFilterValues($Cholinesterase_Test->FirstName);

			// Field MiddelName
			$this->GetSessionFilterValues($Cholinesterase_Test->MiddelName);

			// Field LastName
			$this->GetSessionFilterValues($Cholinesterase_Test->LastName);

			// Field Department
			$this->GetSessionFilterValues($Cholinesterase_Test->Department);

			// Field LastResult
			$this->GetSessionFilterValues($Cholinesterase_Test->LastResult);

			// Field LastTestDate
			$this->GetSessionFilterValues($Cholinesterase_Test->LastTestDate);

			// Field FirstResult
			$this->GetSessionFilterValues($Cholinesterase_Test->FirstResult);

			// Field FirstTestDate
			$this->GetSessionFilterValues($Cholinesterase_Test->FirstTestDate);

			// Field FirstDifference
			$this->GetSessionFilterValues($Cholinesterase_Test->FirstDifference);

			// Field SecondResult
			$this->GetSessionFilterValues($Cholinesterase_Test->SecondResult);

			// Field SecondTestDate
			$this->GetSessionFilterValues($Cholinesterase_Test->SecondTestDate);

			// Field SecondDifference
			$this->GetSessionFilterValues($Cholinesterase_Test->SecondDifference);

			// Field ThirdResult
			$this->GetSessionFilterValues($Cholinesterase_Test->ThirdResult);

			// Field ThirdTestDate
			$this->GetSessionFilterValues($Cholinesterase_Test->ThirdTestDate);

			// Field ThirdDifference
			$this->GetSessionFilterValues($Cholinesterase_Test->ThirdDifference);

			// Field ForthResult
			$this->GetSessionFilterValues($Cholinesterase_Test->ForthResult);

			// Field ForthTestDate
			$this->GetSessionFilterValues($Cholinesterase_Test->ForthTestDate);

			// Field ForthDifference
			$this->GetSessionFilterValues($Cholinesterase_Test->ForthDifference);
		}

		// Call page filter validated event
		$Cholinesterase_Test->Page_FilterValidated();

		// Build SQL
		// Field ID

		$this->BuildExtendedFilter($Cholinesterase_Test->ID, $sFilter);

		// Field FirstName
		$this->BuildExtendedFilter($Cholinesterase_Test->FirstName, $sFilter);

		// Field MiddelName
		$this->BuildExtendedFilter($Cholinesterase_Test->MiddelName, $sFilter);

		// Field LastName
		$this->BuildExtendedFilter($Cholinesterase_Test->LastName, $sFilter);

		// Field Department
		$this->BuildExtendedFilter($Cholinesterase_Test->Department, $sFilter);

		// Field LastResult
		$this->BuildExtendedFilter($Cholinesterase_Test->LastResult, $sFilter);

		// Field LastTestDate
		$this->BuildExtendedFilter($Cholinesterase_Test->LastTestDate, $sFilter);

		// Field FirstResult
		$this->BuildExtendedFilter($Cholinesterase_Test->FirstResult, $sFilter);

		// Field FirstTestDate
		$this->BuildExtendedFilter($Cholinesterase_Test->FirstTestDate, $sFilter);

		// Field FirstDifference
		$this->BuildExtendedFilter($Cholinesterase_Test->FirstDifference, $sFilter);

		// Field SecondResult
		$this->BuildExtendedFilter($Cholinesterase_Test->SecondResult, $sFilter);

		// Field SecondTestDate
		$this->BuildExtendedFilter($Cholinesterase_Test->SecondTestDate, $sFilter);

		// Field SecondDifference
		$this->BuildExtendedFilter($Cholinesterase_Test->SecondDifference, $sFilter);

		// Field ThirdResult
		$this->BuildExtendedFilter($Cholinesterase_Test->ThirdResult, $sFilter);

		// Field ThirdTestDate
		$this->BuildExtendedFilter($Cholinesterase_Test->ThirdTestDate, $sFilter);

		// Field ThirdDifference
		$this->BuildExtendedFilter($Cholinesterase_Test->ThirdDifference, $sFilter);

		// Field ForthResult
		$this->BuildExtendedFilter($Cholinesterase_Test->ForthResult, $sFilter);

		// Field ForthTestDate
		$this->BuildExtendedFilter($Cholinesterase_Test->ForthTestDate, $sFilter);

		// Field ForthDifference
		$this->BuildExtendedFilter($Cholinesterase_Test->ForthDifference, $sFilter);

		// Save parms to session
		// Field ID

		$this->SetSessionFilterValues($Cholinesterase_Test->ID->SearchValue, $Cholinesterase_Test->ID->SearchOperator, $Cholinesterase_Test->ID->SearchCondition, $Cholinesterase_Test->ID->SearchValue2, $Cholinesterase_Test->ID->SearchOperator2, 'ID');

		// Field FirstName
		$this->SetSessionFilterValues($Cholinesterase_Test->FirstName->SearchValue, $Cholinesterase_Test->FirstName->SearchOperator, $Cholinesterase_Test->FirstName->SearchCondition, $Cholinesterase_Test->FirstName->SearchValue2, $Cholinesterase_Test->FirstName->SearchOperator2, 'FirstName');

		// Field MiddelName
		$this->SetSessionFilterValues($Cholinesterase_Test->MiddelName->SearchValue, $Cholinesterase_Test->MiddelName->SearchOperator, $Cholinesterase_Test->MiddelName->SearchCondition, $Cholinesterase_Test->MiddelName->SearchValue2, $Cholinesterase_Test->MiddelName->SearchOperator2, 'MiddelName');

		// Field LastName
		$this->SetSessionFilterValues($Cholinesterase_Test->LastName->SearchValue, $Cholinesterase_Test->LastName->SearchOperator, $Cholinesterase_Test->LastName->SearchCondition, $Cholinesterase_Test->LastName->SearchValue2, $Cholinesterase_Test->LastName->SearchOperator2, 'LastName');

		// Field Department
		$this->SetSessionFilterValues($Cholinesterase_Test->Department->SearchValue, $Cholinesterase_Test->Department->SearchOperator, $Cholinesterase_Test->Department->SearchCondition, $Cholinesterase_Test->Department->SearchValue2, $Cholinesterase_Test->Department->SearchOperator2, 'Department');

		// Field LastResult
		$this->SetSessionFilterValues($Cholinesterase_Test->LastResult->SearchValue, $Cholinesterase_Test->LastResult->SearchOperator, $Cholinesterase_Test->LastResult->SearchCondition, $Cholinesterase_Test->LastResult->SearchValue2, $Cholinesterase_Test->LastResult->SearchOperator2, 'LastResult');

		// Field LastTestDate
		$this->SetSessionFilterValues($Cholinesterase_Test->LastTestDate->SearchValue, $Cholinesterase_Test->LastTestDate->SearchOperator, $Cholinesterase_Test->LastTestDate->SearchCondition, $Cholinesterase_Test->LastTestDate->SearchValue2, $Cholinesterase_Test->LastTestDate->SearchOperator2, 'LastTestDate');

		// Field FirstResult
		$this->SetSessionFilterValues($Cholinesterase_Test->FirstResult->SearchValue, $Cholinesterase_Test->FirstResult->SearchOperator, $Cholinesterase_Test->FirstResult->SearchCondition, $Cholinesterase_Test->FirstResult->SearchValue2, $Cholinesterase_Test->FirstResult->SearchOperator2, 'FirstResult');

		// Field FirstTestDate
		$this->SetSessionFilterValues($Cholinesterase_Test->FirstTestDate->SearchValue, $Cholinesterase_Test->FirstTestDate->SearchOperator, $Cholinesterase_Test->FirstTestDate->SearchCondition, $Cholinesterase_Test->FirstTestDate->SearchValue2, $Cholinesterase_Test->FirstTestDate->SearchOperator2, 'FirstTestDate');

		// Field FirstDifference
		$this->SetSessionFilterValues($Cholinesterase_Test->FirstDifference->SearchValue, $Cholinesterase_Test->FirstDifference->SearchOperator, $Cholinesterase_Test->FirstDifference->SearchCondition, $Cholinesterase_Test->FirstDifference->SearchValue2, $Cholinesterase_Test->FirstDifference->SearchOperator2, 'FirstDifference');

		// Field SecondResult
		$this->SetSessionFilterValues($Cholinesterase_Test->SecondResult->SearchValue, $Cholinesterase_Test->SecondResult->SearchOperator, $Cholinesterase_Test->SecondResult->SearchCondition, $Cholinesterase_Test->SecondResult->SearchValue2, $Cholinesterase_Test->SecondResult->SearchOperator2, 'SecondResult');

		// Field SecondTestDate
		$this->SetSessionFilterValues($Cholinesterase_Test->SecondTestDate->SearchValue, $Cholinesterase_Test->SecondTestDate->SearchOperator, $Cholinesterase_Test->SecondTestDate->SearchCondition, $Cholinesterase_Test->SecondTestDate->SearchValue2, $Cholinesterase_Test->SecondTestDate->SearchOperator2, 'SecondTestDate');

		// Field SecondDifference
		$this->SetSessionFilterValues($Cholinesterase_Test->SecondDifference->SearchValue, $Cholinesterase_Test->SecondDifference->SearchOperator, $Cholinesterase_Test->SecondDifference->SearchCondition, $Cholinesterase_Test->SecondDifference->SearchValue2, $Cholinesterase_Test->SecondDifference->SearchOperator2, 'SecondDifference');

		// Field ThirdResult
		$this->SetSessionFilterValues($Cholinesterase_Test->ThirdResult->SearchValue, $Cholinesterase_Test->ThirdResult->SearchOperator, $Cholinesterase_Test->ThirdResult->SearchCondition, $Cholinesterase_Test->ThirdResult->SearchValue2, $Cholinesterase_Test->ThirdResult->SearchOperator2, 'ThirdResult');

		// Field ThirdTestDate
		$this->SetSessionFilterValues($Cholinesterase_Test->ThirdTestDate->SearchValue, $Cholinesterase_Test->ThirdTestDate->SearchOperator, $Cholinesterase_Test->ThirdTestDate->SearchCondition, $Cholinesterase_Test->ThirdTestDate->SearchValue2, $Cholinesterase_Test->ThirdTestDate->SearchOperator2, 'ThirdTestDate');

		// Field ThirdDifference
		$this->SetSessionFilterValues($Cholinesterase_Test->ThirdDifference->SearchValue, $Cholinesterase_Test->ThirdDifference->SearchOperator, $Cholinesterase_Test->ThirdDifference->SearchCondition, $Cholinesterase_Test->ThirdDifference->SearchValue2, $Cholinesterase_Test->ThirdDifference->SearchOperator2, 'ThirdDifference');

		// Field ForthResult
		$this->SetSessionFilterValues($Cholinesterase_Test->ForthResult->SearchValue, $Cholinesterase_Test->ForthResult->SearchOperator, $Cholinesterase_Test->ForthResult->SearchCondition, $Cholinesterase_Test->ForthResult->SearchValue2, $Cholinesterase_Test->ForthResult->SearchOperator2, 'ForthResult');

		// Field ForthTestDate
		$this->SetSessionFilterValues($Cholinesterase_Test->ForthTestDate->SearchValue, $Cholinesterase_Test->ForthTestDate->SearchOperator, $Cholinesterase_Test->ForthTestDate->SearchCondition, $Cholinesterase_Test->ForthTestDate->SearchValue2, $Cholinesterase_Test->ForthTestDate->SearchOperator2, 'ForthTestDate');

		// Field ForthDifference
		$this->SetSessionFilterValues($Cholinesterase_Test->ForthDifference->SearchValue, $Cholinesterase_Test->ForthDifference->SearchOperator, $Cholinesterase_Test->ForthDifference->SearchCondition, $Cholinesterase_Test->ForthDifference->SearchValue2, $Cholinesterase_Test->ForthDifference->SearchOperator2, 'ForthDifference');

		// Setup filter
		if ($bSetupFilter) {

			// Field ID
			$sWrk = "";
			$this->BuildExtendedFilter($Cholinesterase_Test->ID, $sWrk);
			$this->LoadSelectionFromFilter($Cholinesterase_Test->ID, $sWrk, $Cholinesterase_Test->ID->SelectionList);
			$_SESSION['sel_Cholinesterase_Test_ID'] = ($Cholinesterase_Test->ID->SelectionList == "") ? EWRPT_INIT_VALUE : $Cholinesterase_Test->ID->SelectionList;

			// Field FirstName
			$sWrk = "";
			$this->BuildExtendedFilter($Cholinesterase_Test->FirstName, $sWrk);
			$this->LoadSelectionFromFilter($Cholinesterase_Test->FirstName, $sWrk, $Cholinesterase_Test->FirstName->SelectionList);
			$_SESSION['sel_Cholinesterase_Test_FirstName'] = ($Cholinesterase_Test->FirstName->SelectionList == "") ? EWRPT_INIT_VALUE : $Cholinesterase_Test->FirstName->SelectionList;

			// Field MiddelName
			$sWrk = "";
			$this->BuildExtendedFilter($Cholinesterase_Test->MiddelName, $sWrk);
			$this->LoadSelectionFromFilter($Cholinesterase_Test->MiddelName, $sWrk, $Cholinesterase_Test->MiddelName->SelectionList);
			$_SESSION['sel_Cholinesterase_Test_MiddelName'] = ($Cholinesterase_Test->MiddelName->SelectionList == "") ? EWRPT_INIT_VALUE : $Cholinesterase_Test->MiddelName->SelectionList;

			// Field LastName
			$sWrk = "";
			$this->BuildExtendedFilter($Cholinesterase_Test->LastName, $sWrk);
			$this->LoadSelectionFromFilter($Cholinesterase_Test->LastName, $sWrk, $Cholinesterase_Test->LastName->SelectionList);
			$_SESSION['sel_Cholinesterase_Test_LastName'] = ($Cholinesterase_Test->LastName->SelectionList == "") ? EWRPT_INIT_VALUE : $Cholinesterase_Test->LastName->SelectionList;

			// Field Department
			$sWrk = "";
			$this->BuildExtendedFilter($Cholinesterase_Test->Department, $sWrk);
			$this->LoadSelectionFromFilter($Cholinesterase_Test->Department, $sWrk, $Cholinesterase_Test->Department->SelectionList);
			$_SESSION['sel_Cholinesterase_Test_Department'] = ($Cholinesterase_Test->Department->SelectionList == "") ? EWRPT_INIT_VALUE : $Cholinesterase_Test->Department->SelectionList;

			// Field LastResult
			$sWrk = "";
			$this->BuildExtendedFilter($Cholinesterase_Test->LastResult, $sWrk);
			$this->LoadSelectionFromFilter($Cholinesterase_Test->LastResult, $sWrk, $Cholinesterase_Test->LastResult->SelectionList);
			$_SESSION['sel_Cholinesterase_Test_LastResult'] = ($Cholinesterase_Test->LastResult->SelectionList == "") ? EWRPT_INIT_VALUE : $Cholinesterase_Test->LastResult->SelectionList;

			// Field LastTestDate
			$sWrk = "";
			$this->BuildExtendedFilter($Cholinesterase_Test->LastTestDate, $sWrk);
			$this->LoadSelectionFromFilter($Cholinesterase_Test->LastTestDate, $sWrk, $Cholinesterase_Test->LastTestDate->SelectionList);
			$_SESSION['sel_Cholinesterase_Test_LastTestDate'] = ($Cholinesterase_Test->LastTestDate->SelectionList == "") ? EWRPT_INIT_VALUE : $Cholinesterase_Test->LastTestDate->SelectionList;

			// Field FirstTestDate
			$sWrk = "";
			$this->BuildExtendedFilter($Cholinesterase_Test->FirstTestDate, $sWrk);
			$this->LoadSelectionFromFilter($Cholinesterase_Test->FirstTestDate, $sWrk, $Cholinesterase_Test->FirstTestDate->SelectionList);
			$_SESSION['sel_Cholinesterase_Test_FirstTestDate'] = ($Cholinesterase_Test->FirstTestDate->SelectionList == "") ? EWRPT_INIT_VALUE : $Cholinesterase_Test->FirstTestDate->SelectionList;

			// Field FirstDifference
			$sWrk = "";
			$this->BuildExtendedFilter($Cholinesterase_Test->FirstDifference, $sWrk);
			$this->LoadSelectionFromFilter($Cholinesterase_Test->FirstDifference, $sWrk, $Cholinesterase_Test->FirstDifference->SelectionList);
			$_SESSION['sel_Cholinesterase_Test_FirstDifference'] = ($Cholinesterase_Test->FirstDifference->SelectionList == "") ? EWRPT_INIT_VALUE : $Cholinesterase_Test->FirstDifference->SelectionList;

			// Field SecondResult
			$sWrk = "";
			$this->BuildExtendedFilter($Cholinesterase_Test->SecondResult, $sWrk);
			$this->LoadSelectionFromFilter($Cholinesterase_Test->SecondResult, $sWrk, $Cholinesterase_Test->SecondResult->SelectionList);
			$_SESSION['sel_Cholinesterase_Test_SecondResult'] = ($Cholinesterase_Test->SecondResult->SelectionList == "") ? EWRPT_INIT_VALUE : $Cholinesterase_Test->SecondResult->SelectionList;

			// Field SecondTestDate
			$sWrk = "";
			$this->BuildExtendedFilter($Cholinesterase_Test->SecondTestDate, $sWrk);
			$this->LoadSelectionFromFilter($Cholinesterase_Test->SecondTestDate, $sWrk, $Cholinesterase_Test->SecondTestDate->SelectionList);
			$_SESSION['sel_Cholinesterase_Test_SecondTestDate'] = ($Cholinesterase_Test->SecondTestDate->SelectionList == "") ? EWRPT_INIT_VALUE : $Cholinesterase_Test->SecondTestDate->SelectionList;

			// Field SecondDifference
			$sWrk = "";
			$this->BuildExtendedFilter($Cholinesterase_Test->SecondDifference, $sWrk);
			$this->LoadSelectionFromFilter($Cholinesterase_Test->SecondDifference, $sWrk, $Cholinesterase_Test->SecondDifference->SelectionList);
			$_SESSION['sel_Cholinesterase_Test_SecondDifference'] = ($Cholinesterase_Test->SecondDifference->SelectionList == "") ? EWRPT_INIT_VALUE : $Cholinesterase_Test->SecondDifference->SelectionList;

			// Field ThirdResult
			$sWrk = "";
			$this->BuildExtendedFilter($Cholinesterase_Test->ThirdResult, $sWrk);
			$this->LoadSelectionFromFilter($Cholinesterase_Test->ThirdResult, $sWrk, $Cholinesterase_Test->ThirdResult->SelectionList);
			$_SESSION['sel_Cholinesterase_Test_ThirdResult'] = ($Cholinesterase_Test->ThirdResult->SelectionList == "") ? EWRPT_INIT_VALUE : $Cholinesterase_Test->ThirdResult->SelectionList;

			// Field ThirdTestDate
			$sWrk = "";
			$this->BuildExtendedFilter($Cholinesterase_Test->ThirdTestDate, $sWrk);
			$this->LoadSelectionFromFilter($Cholinesterase_Test->ThirdTestDate, $sWrk, $Cholinesterase_Test->ThirdTestDate->SelectionList);
			$_SESSION['sel_Cholinesterase_Test_ThirdTestDate'] = ($Cholinesterase_Test->ThirdTestDate->SelectionList == "") ? EWRPT_INIT_VALUE : $Cholinesterase_Test->ThirdTestDate->SelectionList;

			// Field ThirdDifference
			$sWrk = "";
			$this->BuildExtendedFilter($Cholinesterase_Test->ThirdDifference, $sWrk);
			$this->LoadSelectionFromFilter($Cholinesterase_Test->ThirdDifference, $sWrk, $Cholinesterase_Test->ThirdDifference->SelectionList);
			$_SESSION['sel_Cholinesterase_Test_ThirdDifference'] = ($Cholinesterase_Test->ThirdDifference->SelectionList == "") ? EWRPT_INIT_VALUE : $Cholinesterase_Test->ThirdDifference->SelectionList;

			// Field ForthResult
			$sWrk = "";
			$this->BuildExtendedFilter($Cholinesterase_Test->ForthResult, $sWrk);
			$this->LoadSelectionFromFilter($Cholinesterase_Test->ForthResult, $sWrk, $Cholinesterase_Test->ForthResult->SelectionList);
			$_SESSION['sel_Cholinesterase_Test_ForthResult'] = ($Cholinesterase_Test->ForthResult->SelectionList == "") ? EWRPT_INIT_VALUE : $Cholinesterase_Test->ForthResult->SelectionList;

			// Field ForthTestDate
			$sWrk = "";
			$this->BuildExtendedFilter($Cholinesterase_Test->ForthTestDate, $sWrk);
			$this->LoadSelectionFromFilter($Cholinesterase_Test->ForthTestDate, $sWrk, $Cholinesterase_Test->ForthTestDate->SelectionList);
			$_SESSION['sel_Cholinesterase_Test_ForthTestDate'] = ($Cholinesterase_Test->ForthTestDate->SelectionList == "") ? EWRPT_INIT_VALUE : $Cholinesterase_Test->ForthTestDate->SelectionList;

			// Field ForthDifference
			$sWrk = "";
			$this->BuildExtendedFilter($Cholinesterase_Test->ForthDifference, $sWrk);
			$this->LoadSelectionFromFilter($Cholinesterase_Test->ForthDifference, $sWrk, $Cholinesterase_Test->ForthDifference->SelectionList);
			$_SESSION['sel_Cholinesterase_Test_ForthDifference'] = ($Cholinesterase_Test->ForthDifference->SelectionList == "") ? EWRPT_INIT_VALUE : $Cholinesterase_Test->ForthDifference->SelectionList;
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
		$this->GetSessionValue($fld->DropDownValue, 'sv_Cholinesterase_Test_' . $parm);
	}

	// Get filter values from session
	function GetSessionFilterValues(&$fld) {
		$parm = substr($fld->FldVar, 2);
		$this->GetSessionValue($fld->SearchValue, 'sv1_Cholinesterase_Test_' . $parm);
		$this->GetSessionValue($fld->SearchOperator, 'so1_Cholinesterase_Test_' . $parm);
		$this->GetSessionValue($fld->SearchCondition, 'sc_Cholinesterase_Test_' . $parm);
		$this->GetSessionValue($fld->SearchValue2, 'sv2_Cholinesterase_Test_' . $parm);
		$this->GetSessionValue($fld->SearchOperator2, 'so2_Cholinesterase_Test_' . $parm);
	}

	// Get value from session
	function GetSessionValue(&$sv, $sn) {
		if (isset($_SESSION[$sn]))
			$sv = $_SESSION[$sn];
	}

	// Set dropdown value to session
	function SetSessionDropDownValue($sv, $parm) {
		$_SESSION['sv_Cholinesterase_Test_' . $parm] = $sv;
	}

	// Set filter values to session
	function SetSessionFilterValues($sv1, $so1, $sc, $sv2, $so2, $parm) {
		$_SESSION['sv1_Cholinesterase_Test_' . $parm] = $sv1;
		$_SESSION['so1_Cholinesterase_Test_' . $parm] = $so1;
		$_SESSION['sc_Cholinesterase_Test_' . $parm] = $sc;
		$_SESSION['sv2_Cholinesterase_Test_' . $parm] = $sv2;
		$_SESSION['so2_Cholinesterase_Test_' . $parm] = $so2;
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
		global $ReportLanguage, $gsFormError, $Cholinesterase_Test;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EWRPT_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ewrpt_CheckNumber($Cholinesterase_Test->LastResult->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Cholinesterase_Test->LastResult->FldErrMsg();
		}
		if (!ewrpt_CheckDate($Cholinesterase_Test->LastTestDate->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Cholinesterase_Test->LastTestDate->FldErrMsg();
		}
		if (!ewrpt_CheckDate($Cholinesterase_Test->LastTestDate->SearchValue2)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Cholinesterase_Test->LastTestDate->FldErrMsg();
		}
		if (!ewrpt_CheckNumber($Cholinesterase_Test->FirstResult->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Cholinesterase_Test->FirstResult->FldErrMsg();
		}
		if (!ewrpt_CheckDate($Cholinesterase_Test->FirstTestDate->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Cholinesterase_Test->FirstTestDate->FldErrMsg();
		}
		if (!ewrpt_CheckDate($Cholinesterase_Test->FirstTestDate->SearchValue2)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Cholinesterase_Test->FirstTestDate->FldErrMsg();
		}
		if (!ewrpt_CheckNumber($Cholinesterase_Test->FirstDifference->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Cholinesterase_Test->FirstDifference->FldErrMsg();
		}
		if (!ewrpt_CheckNumber($Cholinesterase_Test->SecondResult->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Cholinesterase_Test->SecondResult->FldErrMsg();
		}
		if (!ewrpt_CheckDate($Cholinesterase_Test->SecondTestDate->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Cholinesterase_Test->SecondTestDate->FldErrMsg();
		}
		if (!ewrpt_CheckDate($Cholinesterase_Test->SecondTestDate->SearchValue2)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Cholinesterase_Test->SecondTestDate->FldErrMsg();
		}
		if (!ewrpt_CheckNumber($Cholinesterase_Test->SecondDifference->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Cholinesterase_Test->SecondDifference->FldErrMsg();
		}
		if (!ewrpt_CheckNumber($Cholinesterase_Test->ThirdResult->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Cholinesterase_Test->ThirdResult->FldErrMsg();
		}
		if (!ewrpt_CheckDate($Cholinesterase_Test->ThirdTestDate->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Cholinesterase_Test->ThirdTestDate->FldErrMsg();
		}
		if (!ewrpt_CheckDate($Cholinesterase_Test->ThirdTestDate->SearchValue2)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Cholinesterase_Test->ThirdTestDate->FldErrMsg();
		}
		if (!ewrpt_CheckNumber($Cholinesterase_Test->ThirdDifference->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Cholinesterase_Test->ThirdDifference->FldErrMsg();
		}
		if (!ewrpt_CheckNumber($Cholinesterase_Test->ForthResult->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Cholinesterase_Test->ForthResult->FldErrMsg();
		}
		if (!ewrpt_CheckDate($Cholinesterase_Test->ForthTestDate->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Cholinesterase_Test->ForthTestDate->FldErrMsg();
		}
		if (!ewrpt_CheckDate($Cholinesterase_Test->ForthTestDate->SearchValue2)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Cholinesterase_Test->ForthTestDate->FldErrMsg();
		}
		if (!ewrpt_CheckNumber($Cholinesterase_Test->ForthDifference->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Cholinesterase_Test->ForthDifference->FldErrMsg();
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
		$_SESSION["sel_Cholinesterase_Test_$parm"] = "";
		$_SESSION["rf_Cholinesterase_Test_$parm"] = "";
		$_SESSION["rt_Cholinesterase_Test_$parm"] = "";
	}

	// Load selection from session
	function LoadSelectionFromSession($parm) {
		global $Cholinesterase_Test;
		$fld =& $Cholinesterase_Test->fields($parm);
		$fld->SelectionList = @$_SESSION["sel_Cholinesterase_Test_$parm"];
		$fld->RangeFrom = @$_SESSION["rf_Cholinesterase_Test_$parm"];
		$fld->RangeTo = @$_SESSION["rt_Cholinesterase_Test_$parm"];
	}

	// Load default value for filters
	function LoadDefaultFilters() {
		global $Cholinesterase_Test;

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
		$this->SetDefaultExtFilter($Cholinesterase_Test->ID, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Cholinesterase_Test->ID);
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->ID, $sWrk);
		$this->LoadSelectionFromFilter($Cholinesterase_Test->ID, $sWrk, $Cholinesterase_Test->ID->DefaultSelectionList);
		$Cholinesterase_Test->ID->SelectionList = $Cholinesterase_Test->ID->DefaultSelectionList;

		// Field FirstName
		$this->SetDefaultExtFilter($Cholinesterase_Test->FirstName, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Cholinesterase_Test->FirstName);
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->FirstName, $sWrk);
		$this->LoadSelectionFromFilter($Cholinesterase_Test->FirstName, $sWrk, $Cholinesterase_Test->FirstName->DefaultSelectionList);
		$Cholinesterase_Test->FirstName->SelectionList = $Cholinesterase_Test->FirstName->DefaultSelectionList;

		// Field MiddelName
		$this->SetDefaultExtFilter($Cholinesterase_Test->MiddelName, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Cholinesterase_Test->MiddelName);
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->MiddelName, $sWrk);
		$this->LoadSelectionFromFilter($Cholinesterase_Test->MiddelName, $sWrk, $Cholinesterase_Test->MiddelName->DefaultSelectionList);
		$Cholinesterase_Test->MiddelName->SelectionList = $Cholinesterase_Test->MiddelName->DefaultSelectionList;

		// Field LastName
		$this->SetDefaultExtFilter($Cholinesterase_Test->LastName, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Cholinesterase_Test->LastName);
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->LastName, $sWrk);
		$this->LoadSelectionFromFilter($Cholinesterase_Test->LastName, $sWrk, $Cholinesterase_Test->LastName->DefaultSelectionList);
		$Cholinesterase_Test->LastName->SelectionList = $Cholinesterase_Test->LastName->DefaultSelectionList;

		// Field Department
		$this->SetDefaultExtFilter($Cholinesterase_Test->Department, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Cholinesterase_Test->Department);
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->Department, $sWrk);
		$this->LoadSelectionFromFilter($Cholinesterase_Test->Department, $sWrk, $Cholinesterase_Test->Department->DefaultSelectionList);
		$Cholinesterase_Test->Department->SelectionList = $Cholinesterase_Test->Department->DefaultSelectionList;

		// Field LastResult
		$this->SetDefaultExtFilter($Cholinesterase_Test->LastResult, "=", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Cholinesterase_Test->LastResult);
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->LastResult, $sWrk);
		$this->LoadSelectionFromFilter($Cholinesterase_Test->LastResult, $sWrk, $Cholinesterase_Test->LastResult->DefaultSelectionList);
		$Cholinesterase_Test->LastResult->SelectionList = $Cholinesterase_Test->LastResult->DefaultSelectionList;

		// Field LastTestDate
		$this->SetDefaultExtFilter($Cholinesterase_Test->LastTestDate, "BETWEEN", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Cholinesterase_Test->LastTestDate);
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->LastTestDate, $sWrk);
		$this->LoadSelectionFromFilter($Cholinesterase_Test->LastTestDate, $sWrk, $Cholinesterase_Test->LastTestDate->DefaultSelectionList);
		$Cholinesterase_Test->LastTestDate->SelectionList = $Cholinesterase_Test->LastTestDate->DefaultSelectionList;

		// Field FirstResult
		$this->SetDefaultExtFilter($Cholinesterase_Test->FirstResult, "=", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Cholinesterase_Test->FirstResult);

		// Field FirstTestDate
		$this->SetDefaultExtFilter($Cholinesterase_Test->FirstTestDate, "BETWEEN", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Cholinesterase_Test->FirstTestDate);
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->FirstTestDate, $sWrk);
		$this->LoadSelectionFromFilter($Cholinesterase_Test->FirstTestDate, $sWrk, $Cholinesterase_Test->FirstTestDate->DefaultSelectionList);
		$Cholinesterase_Test->FirstTestDate->SelectionList = $Cholinesterase_Test->FirstTestDate->DefaultSelectionList;

		// Field FirstDifference
		$this->SetDefaultExtFilter($Cholinesterase_Test->FirstDifference, "=", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Cholinesterase_Test->FirstDifference);
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->FirstDifference, $sWrk);
		$this->LoadSelectionFromFilter($Cholinesterase_Test->FirstDifference, $sWrk, $Cholinesterase_Test->FirstDifference->DefaultSelectionList);
		$Cholinesterase_Test->FirstDifference->SelectionList = $Cholinesterase_Test->FirstDifference->DefaultSelectionList;

		// Field SecondResult
		$this->SetDefaultExtFilter($Cholinesterase_Test->SecondResult, "=", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Cholinesterase_Test->SecondResult);
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->SecondResult, $sWrk);
		$this->LoadSelectionFromFilter($Cholinesterase_Test->SecondResult, $sWrk, $Cholinesterase_Test->SecondResult->DefaultSelectionList);
		$Cholinesterase_Test->SecondResult->SelectionList = $Cholinesterase_Test->SecondResult->DefaultSelectionList;

		// Field SecondTestDate
		$this->SetDefaultExtFilter($Cholinesterase_Test->SecondTestDate, "BETWEEN", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Cholinesterase_Test->SecondTestDate);
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->SecondTestDate, $sWrk);
		$this->LoadSelectionFromFilter($Cholinesterase_Test->SecondTestDate, $sWrk, $Cholinesterase_Test->SecondTestDate->DefaultSelectionList);
		$Cholinesterase_Test->SecondTestDate->SelectionList = $Cholinesterase_Test->SecondTestDate->DefaultSelectionList;

		// Field SecondDifference
		$this->SetDefaultExtFilter($Cholinesterase_Test->SecondDifference, "=", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Cholinesterase_Test->SecondDifference);
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->SecondDifference, $sWrk);
		$this->LoadSelectionFromFilter($Cholinesterase_Test->SecondDifference, $sWrk, $Cholinesterase_Test->SecondDifference->DefaultSelectionList);
		$Cholinesterase_Test->SecondDifference->SelectionList = $Cholinesterase_Test->SecondDifference->DefaultSelectionList;

		// Field ThirdResult
		$this->SetDefaultExtFilter($Cholinesterase_Test->ThirdResult, "=", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Cholinesterase_Test->ThirdResult);
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->ThirdResult, $sWrk);
		$this->LoadSelectionFromFilter($Cholinesterase_Test->ThirdResult, $sWrk, $Cholinesterase_Test->ThirdResult->DefaultSelectionList);
		$Cholinesterase_Test->ThirdResult->SelectionList = $Cholinesterase_Test->ThirdResult->DefaultSelectionList;

		// Field ThirdTestDate
		$this->SetDefaultExtFilter($Cholinesterase_Test->ThirdTestDate, "BETWEEN", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Cholinesterase_Test->ThirdTestDate);
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->ThirdTestDate, $sWrk);
		$this->LoadSelectionFromFilter($Cholinesterase_Test->ThirdTestDate, $sWrk, $Cholinesterase_Test->ThirdTestDate->DefaultSelectionList);
		$Cholinesterase_Test->ThirdTestDate->SelectionList = $Cholinesterase_Test->ThirdTestDate->DefaultSelectionList;

		// Field ThirdDifference
		$this->SetDefaultExtFilter($Cholinesterase_Test->ThirdDifference, "=", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Cholinesterase_Test->ThirdDifference);
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->ThirdDifference, $sWrk);
		$this->LoadSelectionFromFilter($Cholinesterase_Test->ThirdDifference, $sWrk, $Cholinesterase_Test->ThirdDifference->DefaultSelectionList);
		$Cholinesterase_Test->ThirdDifference->SelectionList = $Cholinesterase_Test->ThirdDifference->DefaultSelectionList;

		// Field ForthResult
		$this->SetDefaultExtFilter($Cholinesterase_Test->ForthResult, "=", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Cholinesterase_Test->ForthResult);
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->ForthResult, $sWrk);
		$this->LoadSelectionFromFilter($Cholinesterase_Test->ForthResult, $sWrk, $Cholinesterase_Test->ForthResult->DefaultSelectionList);
		$Cholinesterase_Test->ForthResult->SelectionList = $Cholinesterase_Test->ForthResult->DefaultSelectionList;

		// Field ForthTestDate
		$this->SetDefaultExtFilter($Cholinesterase_Test->ForthTestDate, "BETWEEN", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Cholinesterase_Test->ForthTestDate);
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->ForthTestDate, $sWrk);
		$this->LoadSelectionFromFilter($Cholinesterase_Test->ForthTestDate, $sWrk, $Cholinesterase_Test->ForthTestDate->DefaultSelectionList);
		$Cholinesterase_Test->ForthTestDate->SelectionList = $Cholinesterase_Test->ForthTestDate->DefaultSelectionList;

		// Field ForthDifference
		$this->SetDefaultExtFilter($Cholinesterase_Test->ForthDifference, "=", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Cholinesterase_Test->ForthDifference);
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->ForthDifference, $sWrk);
		$this->LoadSelectionFromFilter($Cholinesterase_Test->ForthDifference, $sWrk, $Cholinesterase_Test->ForthDifference->DefaultSelectionList);
		$Cholinesterase_Test->ForthDifference->SelectionList = $Cholinesterase_Test->ForthDifference->DefaultSelectionList;

		/**
		* Set up default values for popup filters
		* NOTE: if extended filter is enabled, use default values in extended filter instead
		*/
	}

	// Check if filter applied
	function CheckFilter() {
		global $Cholinesterase_Test;

		// Check ID text filter
		if ($this->TextFilterApplied($Cholinesterase_Test->ID))
			return TRUE;

		// Check ID popup filter
		if (!ewrpt_MatchedArray($Cholinesterase_Test->ID->DefaultSelectionList, $Cholinesterase_Test->ID->SelectionList))
			return TRUE;

		// Check FirstName text filter
		if ($this->TextFilterApplied($Cholinesterase_Test->FirstName))
			return TRUE;

		// Check FirstName popup filter
		if (!ewrpt_MatchedArray($Cholinesterase_Test->FirstName->DefaultSelectionList, $Cholinesterase_Test->FirstName->SelectionList))
			return TRUE;

		// Check MiddelName text filter
		if ($this->TextFilterApplied($Cholinesterase_Test->MiddelName))
			return TRUE;

		// Check MiddelName popup filter
		if (!ewrpt_MatchedArray($Cholinesterase_Test->MiddelName->DefaultSelectionList, $Cholinesterase_Test->MiddelName->SelectionList))
			return TRUE;

		// Check LastName text filter
		if ($this->TextFilterApplied($Cholinesterase_Test->LastName))
			return TRUE;

		// Check LastName popup filter
		if (!ewrpt_MatchedArray($Cholinesterase_Test->LastName->DefaultSelectionList, $Cholinesterase_Test->LastName->SelectionList))
			return TRUE;

		// Check Department text filter
		if ($this->TextFilterApplied($Cholinesterase_Test->Department))
			return TRUE;

		// Check Department popup filter
		if (!ewrpt_MatchedArray($Cholinesterase_Test->Department->DefaultSelectionList, $Cholinesterase_Test->Department->SelectionList))
			return TRUE;

		// Check LastResult text filter
		if ($this->TextFilterApplied($Cholinesterase_Test->LastResult))
			return TRUE;

		// Check LastResult popup filter
		if (!ewrpt_MatchedArray($Cholinesterase_Test->LastResult->DefaultSelectionList, $Cholinesterase_Test->LastResult->SelectionList))
			return TRUE;

		// Check LastTestDate text filter
		if ($this->TextFilterApplied($Cholinesterase_Test->LastTestDate))
			return TRUE;

		// Check LastTestDate popup filter
		if (!ewrpt_MatchedArray($Cholinesterase_Test->LastTestDate->DefaultSelectionList, $Cholinesterase_Test->LastTestDate->SelectionList))
			return TRUE;

		// Check FirstResult text filter
		if ($this->TextFilterApplied($Cholinesterase_Test->FirstResult))
			return TRUE;

		// Check FirstTestDate text filter
		if ($this->TextFilterApplied($Cholinesterase_Test->FirstTestDate))
			return TRUE;

		// Check FirstTestDate popup filter
		if (!ewrpt_MatchedArray($Cholinesterase_Test->FirstTestDate->DefaultSelectionList, $Cholinesterase_Test->FirstTestDate->SelectionList))
			return TRUE;

		// Check FirstDifference text filter
		if ($this->TextFilterApplied($Cholinesterase_Test->FirstDifference))
			return TRUE;

		// Check FirstDifference popup filter
		if (!ewrpt_MatchedArray($Cholinesterase_Test->FirstDifference->DefaultSelectionList, $Cholinesterase_Test->FirstDifference->SelectionList))
			return TRUE;

		// Check SecondResult text filter
		if ($this->TextFilterApplied($Cholinesterase_Test->SecondResult))
			return TRUE;

		// Check SecondResult popup filter
		if (!ewrpt_MatchedArray($Cholinesterase_Test->SecondResult->DefaultSelectionList, $Cholinesterase_Test->SecondResult->SelectionList))
			return TRUE;

		// Check SecondTestDate text filter
		if ($this->TextFilterApplied($Cholinesterase_Test->SecondTestDate))
			return TRUE;

		// Check SecondTestDate popup filter
		if (!ewrpt_MatchedArray($Cholinesterase_Test->SecondTestDate->DefaultSelectionList, $Cholinesterase_Test->SecondTestDate->SelectionList))
			return TRUE;

		// Check SecondDifference text filter
		if ($this->TextFilterApplied($Cholinesterase_Test->SecondDifference))
			return TRUE;

		// Check SecondDifference popup filter
		if (!ewrpt_MatchedArray($Cholinesterase_Test->SecondDifference->DefaultSelectionList, $Cholinesterase_Test->SecondDifference->SelectionList))
			return TRUE;

		// Check ThirdResult text filter
		if ($this->TextFilterApplied($Cholinesterase_Test->ThirdResult))
			return TRUE;

		// Check ThirdResult popup filter
		if (!ewrpt_MatchedArray($Cholinesterase_Test->ThirdResult->DefaultSelectionList, $Cholinesterase_Test->ThirdResult->SelectionList))
			return TRUE;

		// Check ThirdTestDate text filter
		if ($this->TextFilterApplied($Cholinesterase_Test->ThirdTestDate))
			return TRUE;

		// Check ThirdTestDate popup filter
		if (!ewrpt_MatchedArray($Cholinesterase_Test->ThirdTestDate->DefaultSelectionList, $Cholinesterase_Test->ThirdTestDate->SelectionList))
			return TRUE;

		// Check ThirdDifference text filter
		if ($this->TextFilterApplied($Cholinesterase_Test->ThirdDifference))
			return TRUE;

		// Check ThirdDifference popup filter
		if (!ewrpt_MatchedArray($Cholinesterase_Test->ThirdDifference->DefaultSelectionList, $Cholinesterase_Test->ThirdDifference->SelectionList))
			return TRUE;

		// Check ForthResult text filter
		if ($this->TextFilterApplied($Cholinesterase_Test->ForthResult))
			return TRUE;

		// Check ForthResult popup filter
		if (!ewrpt_MatchedArray($Cholinesterase_Test->ForthResult->DefaultSelectionList, $Cholinesterase_Test->ForthResult->SelectionList))
			return TRUE;

		// Check ForthTestDate text filter
		if ($this->TextFilterApplied($Cholinesterase_Test->ForthTestDate))
			return TRUE;

		// Check ForthTestDate popup filter
		if (!ewrpt_MatchedArray($Cholinesterase_Test->ForthTestDate->DefaultSelectionList, $Cholinesterase_Test->ForthTestDate->SelectionList))
			return TRUE;

		// Check ForthDifference text filter
		if ($this->TextFilterApplied($Cholinesterase_Test->ForthDifference))
			return TRUE;

		// Check ForthDifference popup filter
		if (!ewrpt_MatchedArray($Cholinesterase_Test->ForthDifference->DefaultSelectionList, $Cholinesterase_Test->ForthDifference->SelectionList))
			return TRUE;
		return FALSE;
	}

	// Show list of filters
	function ShowFilterList() {
		global $Cholinesterase_Test;
		global $ReportLanguage;

		// Initialize
		$sFilterList = "";

		// Field ID
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->ID, $sExtWrk);
		if (is_array($Cholinesterase_Test->ID->SelectionList))
			$sWrk = ewrpt_JoinArray($Cholinesterase_Test->ID->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Cholinesterase_Test->ID->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field FirstName
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->FirstName, $sExtWrk);
		if (is_array($Cholinesterase_Test->FirstName->SelectionList))
			$sWrk = ewrpt_JoinArray($Cholinesterase_Test->FirstName->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Cholinesterase_Test->FirstName->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field MiddelName
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->MiddelName, $sExtWrk);
		if (is_array($Cholinesterase_Test->MiddelName->SelectionList))
			$sWrk = ewrpt_JoinArray($Cholinesterase_Test->MiddelName->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Cholinesterase_Test->MiddelName->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field LastName
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->LastName, $sExtWrk);
		if (is_array($Cholinesterase_Test->LastName->SelectionList))
			$sWrk = ewrpt_JoinArray($Cholinesterase_Test->LastName->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Cholinesterase_Test->LastName->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Department
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->Department, $sExtWrk);
		if (is_array($Cholinesterase_Test->Department->SelectionList))
			$sWrk = ewrpt_JoinArray($Cholinesterase_Test->Department->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Cholinesterase_Test->Department->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field LastResult
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->LastResult, $sExtWrk);
		if (is_array($Cholinesterase_Test->LastResult->SelectionList))
			$sWrk = ewrpt_JoinArray($Cholinesterase_Test->LastResult->SelectionList, ", ", EWRPT_DATATYPE_NUMBER);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Cholinesterase_Test->LastResult->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field LastTestDate
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->LastTestDate, $sExtWrk);
		if (is_array($Cholinesterase_Test->LastTestDate->SelectionList))
			$sWrk = ewrpt_JoinArray($Cholinesterase_Test->LastTestDate->SelectionList, ", ", EWRPT_DATATYPE_DATE);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Cholinesterase_Test->LastTestDate->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field FirstResult
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->FirstResult, $sExtWrk);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Cholinesterase_Test->FirstResult->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field FirstTestDate
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->FirstTestDate, $sExtWrk);
		if (is_array($Cholinesterase_Test->FirstTestDate->SelectionList))
			$sWrk = ewrpt_JoinArray($Cholinesterase_Test->FirstTestDate->SelectionList, ", ", EWRPT_DATATYPE_DATE);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Cholinesterase_Test->FirstTestDate->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field FirstDifference
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->FirstDifference, $sExtWrk);
		if (is_array($Cholinesterase_Test->FirstDifference->SelectionList))
			$sWrk = ewrpt_JoinArray($Cholinesterase_Test->FirstDifference->SelectionList, ", ", EWRPT_DATATYPE_NUMBER);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Cholinesterase_Test->FirstDifference->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field SecondResult
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->SecondResult, $sExtWrk);
		if (is_array($Cholinesterase_Test->SecondResult->SelectionList))
			$sWrk = ewrpt_JoinArray($Cholinesterase_Test->SecondResult->SelectionList, ", ", EWRPT_DATATYPE_NUMBER);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Cholinesterase_Test->SecondResult->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field SecondTestDate
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->SecondTestDate, $sExtWrk);
		if (is_array($Cholinesterase_Test->SecondTestDate->SelectionList))
			$sWrk = ewrpt_JoinArray($Cholinesterase_Test->SecondTestDate->SelectionList, ", ", EWRPT_DATATYPE_DATE);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Cholinesterase_Test->SecondTestDate->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field SecondDifference
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->SecondDifference, $sExtWrk);
		if (is_array($Cholinesterase_Test->SecondDifference->SelectionList))
			$sWrk = ewrpt_JoinArray($Cholinesterase_Test->SecondDifference->SelectionList, ", ", EWRPT_DATATYPE_NUMBER);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Cholinesterase_Test->SecondDifference->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field ThirdResult
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->ThirdResult, $sExtWrk);
		if (is_array($Cholinesterase_Test->ThirdResult->SelectionList))
			$sWrk = ewrpt_JoinArray($Cholinesterase_Test->ThirdResult->SelectionList, ", ", EWRPT_DATATYPE_NUMBER);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Cholinesterase_Test->ThirdResult->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field ThirdTestDate
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->ThirdTestDate, $sExtWrk);
		if (is_array($Cholinesterase_Test->ThirdTestDate->SelectionList))
			$sWrk = ewrpt_JoinArray($Cholinesterase_Test->ThirdTestDate->SelectionList, ", ", EWRPT_DATATYPE_DATE);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Cholinesterase_Test->ThirdTestDate->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field ThirdDifference
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->ThirdDifference, $sExtWrk);
		if (is_array($Cholinesterase_Test->ThirdDifference->SelectionList))
			$sWrk = ewrpt_JoinArray($Cholinesterase_Test->ThirdDifference->SelectionList, ", ", EWRPT_DATATYPE_NUMBER);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Cholinesterase_Test->ThirdDifference->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field ForthResult
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->ForthResult, $sExtWrk);
		if (is_array($Cholinesterase_Test->ForthResult->SelectionList))
			$sWrk = ewrpt_JoinArray($Cholinesterase_Test->ForthResult->SelectionList, ", ", EWRPT_DATATYPE_NUMBER);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Cholinesterase_Test->ForthResult->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field ForthTestDate
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->ForthTestDate, $sExtWrk);
		if (is_array($Cholinesterase_Test->ForthTestDate->SelectionList))
			$sWrk = ewrpt_JoinArray($Cholinesterase_Test->ForthTestDate->SelectionList, ", ", EWRPT_DATATYPE_DATE);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Cholinesterase_Test->ForthTestDate->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field ForthDifference
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Cholinesterase_Test->ForthDifference, $sExtWrk);
		if (is_array($Cholinesterase_Test->ForthDifference->SelectionList))
			$sWrk = ewrpt_JoinArray($Cholinesterase_Test->ForthDifference->SelectionList, ", ", EWRPT_DATATYPE_NUMBER);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Cholinesterase_Test->ForthDifference->FldCaption() . "<br />";
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
		global $Cholinesterase_Test;
		$sWrk = "";
		if (!$this->ExtendedFilterExist($Cholinesterase_Test->ID)) {
			if (is_array($Cholinesterase_Test->ID->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Cholinesterase_Test->ID, "`ID`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Cholinesterase_Test->FirstName)) {
			if (is_array($Cholinesterase_Test->FirstName->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Cholinesterase_Test->FirstName, "`FirstName`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Cholinesterase_Test->MiddelName)) {
			if (is_array($Cholinesterase_Test->MiddelName->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Cholinesterase_Test->MiddelName, "`MiddelName`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Cholinesterase_Test->LastName)) {
			if (is_array($Cholinesterase_Test->LastName->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Cholinesterase_Test->LastName, "`LastName`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Cholinesterase_Test->Department)) {
			if (is_array($Cholinesterase_Test->Department->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Cholinesterase_Test->Department, "`Department`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Cholinesterase_Test->LastResult)) {
			if (is_array($Cholinesterase_Test->LastResult->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Cholinesterase_Test->LastResult, "`LastResult`", EWRPT_DATATYPE_NUMBER);
			}
		}
		if (!$this->ExtendedFilterExist($Cholinesterase_Test->LastTestDate)) {
			if (is_array($Cholinesterase_Test->LastTestDate->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Cholinesterase_Test->LastTestDate, "`LastTestDate`", EWRPT_DATATYPE_DATE);
			}
		}
		if (!$this->ExtendedFilterExist($Cholinesterase_Test->FirstTestDate)) {
			if (is_array($Cholinesterase_Test->FirstTestDate->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Cholinesterase_Test->FirstTestDate, "`FirstTestDate`", EWRPT_DATATYPE_DATE);
			}
		}
		if (!$this->ExtendedFilterExist($Cholinesterase_Test->FirstDifference)) {
			if (is_array($Cholinesterase_Test->FirstDifference->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Cholinesterase_Test->FirstDifference, "`FirstDifference`", EWRPT_DATATYPE_NUMBER);
			}
		}
		if (!$this->ExtendedFilterExist($Cholinesterase_Test->SecondResult)) {
			if (is_array($Cholinesterase_Test->SecondResult->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Cholinesterase_Test->SecondResult, "`SecondResult`", EWRPT_DATATYPE_NUMBER);
			}
		}
		if (!$this->ExtendedFilterExist($Cholinesterase_Test->SecondTestDate)) {
			if (is_array($Cholinesterase_Test->SecondTestDate->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Cholinesterase_Test->SecondTestDate, "`SecondTestDate`", EWRPT_DATATYPE_DATE);
			}
		}
		if (!$this->ExtendedFilterExist($Cholinesterase_Test->SecondDifference)) {
			if (is_array($Cholinesterase_Test->SecondDifference->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Cholinesterase_Test->SecondDifference, "`SecondDifference`", EWRPT_DATATYPE_NUMBER);
			}
		}
		if (!$this->ExtendedFilterExist($Cholinesterase_Test->ThirdResult)) {
			if (is_array($Cholinesterase_Test->ThirdResult->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Cholinesterase_Test->ThirdResult, "`ThirdResult`", EWRPT_DATATYPE_NUMBER);
			}
		}
		if (!$this->ExtendedFilterExist($Cholinesterase_Test->ThirdTestDate)) {
			if (is_array($Cholinesterase_Test->ThirdTestDate->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Cholinesterase_Test->ThirdTestDate, "`ThirdTestDate`", EWRPT_DATATYPE_DATE);
			}
		}
		if (!$this->ExtendedFilterExist($Cholinesterase_Test->ThirdDifference)) {
			if (is_array($Cholinesterase_Test->ThirdDifference->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Cholinesterase_Test->ThirdDifference, "`ThirdDifference`", EWRPT_DATATYPE_NUMBER);
			}
		}
		if (!$this->ExtendedFilterExist($Cholinesterase_Test->ForthResult)) {
			if (is_array($Cholinesterase_Test->ForthResult->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Cholinesterase_Test->ForthResult, "`ForthResult`", EWRPT_DATATYPE_NUMBER);
			}
		}
		if (!$this->ExtendedFilterExist($Cholinesterase_Test->ForthTestDate)) {
			if (is_array($Cholinesterase_Test->ForthTestDate->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Cholinesterase_Test->ForthTestDate, "`ForthTestDate`", EWRPT_DATATYPE_DATE);
			}
		}
		if (!$this->ExtendedFilterExist($Cholinesterase_Test->ForthDifference)) {
			if (is_array($Cholinesterase_Test->ForthDifference->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Cholinesterase_Test->ForthDifference, "`ForthDifference`", EWRPT_DATATYPE_NUMBER);
			}
		}
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $Cholinesterase_Test;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$Cholinesterase_Test->setOrderBy("");
				$Cholinesterase_Test->setStartGroup(1);
				$Cholinesterase_Test->Department->setSort("");
				$Cholinesterase_Test->ID->setSort("");
				$Cholinesterase_Test->FirstName->setSort("");
				$Cholinesterase_Test->MiddelName->setSort("");
				$Cholinesterase_Test->LastName->setSort("");
				$Cholinesterase_Test->LastResult->setSort("");
				$Cholinesterase_Test->LastTestDate->setSort("");
				$Cholinesterase_Test->FirstResult->setSort("");
				$Cholinesterase_Test->FirstTestDate->setSort("");
				$Cholinesterase_Test->FirstDifference->setSort("");
				$Cholinesterase_Test->SecondResult->setSort("");
				$Cholinesterase_Test->SecondTestDate->setSort("");
				$Cholinesterase_Test->SecondDifference->setSort("");
				$Cholinesterase_Test->ThirdResult->setSort("");
				$Cholinesterase_Test->ThirdTestDate->setSort("");
				$Cholinesterase_Test->ThirdDifference->setSort("");
				$Cholinesterase_Test->ForthResult->setSort("");
				$Cholinesterase_Test->ForthTestDate->setSort("");
				$Cholinesterase_Test->ForthDifference->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$Cholinesterase_Test->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$Cholinesterase_Test->CurrentOrderType = @$_GET["ordertype"];
			$sSortSql = $Cholinesterase_Test->SortSql();
			$Cholinesterase_Test->setOrderBy($sSortSql);
			$Cholinesterase_Test->setStartGroup(1);
		}

		// Set up default sort
		if ($Cholinesterase_Test->getOrderBy() == "") {
			$Cholinesterase_Test->setOrderBy("`ID` ASC");
			$Cholinesterase_Test->ID->setSort("ASC");
		}
		return $Cholinesterase_Test->getOrderBy();
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
