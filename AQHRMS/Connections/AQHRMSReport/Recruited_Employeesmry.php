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
$Recruited_Employee = NULL;

//
// Table class for Recruited Employee
//
class crRecruited_Employee {
	var $TableVar = 'Recruited_Employee';
	var $TableName = 'Recruited Employee';
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
	var $Employee;
	var $Place;
	var $ID;
	var $FirstName;
	var $MiddelName;
	var $LastName;
	var $Age;
	var $Sex;
	var $Photo;
	var $Date;
	var $Address;
	var $Department;
	var $Position;
	var $Housing_Allowance;
	var $Salary;
	var $Transport_Allowance;
	var $Hardship_Allowance;
	var $Position_Allowance;
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
	function crRecruited_Employee() {
		global $ReportLanguage;

		// Auto_ID
		$this->Auto_ID = new crField('Recruited_Employee', 'Recruited Employee', 'x_Auto_ID', 'Auto_ID', '`Auto_ID`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->Auto_ID->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['Auto_ID'] =& $this->Auto_ID;
		$this->Auto_ID->DateFilter = "";
		$this->Auto_ID->SqlSelect = "";
		$this->Auto_ID->SqlOrderBy = "";
		$this->Auto_ID->FldGroupByType = "";
		$this->Auto_ID->FldGroupInt = "0";
		$this->Auto_ID->FldGroupSql = "";

		// Employee
		$this->Employee = new crField('Recruited_Employee', 'Recruited Employee', 'x_Employee', 'Employee', '`Employee`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Employee'] =& $this->Employee;
		$this->Employee->DateFilter = "";
		$this->Employee->SqlSelect = "SELECT DISTINCT `Employee` FROM " . $this->SqlFrom();
		$this->Employee->SqlOrderBy = "`Employee`";
		$this->Employee->FldGroupByType = "";
		$this->Employee->FldGroupInt = "0";
		$this->Employee->FldGroupSql = "";

		// Place
		$this->Place = new crField('Recruited_Employee', 'Recruited Employee', 'x_Place', 'Place', '`Place`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Place'] =& $this->Place;
		$this->Place->DateFilter = "";
		$this->Place->SqlSelect = "SELECT DISTINCT `Place` FROM " . $this->SqlFrom();
		$this->Place->SqlOrderBy = "`Place`";
		$this->Place->FldGroupByType = "";
		$this->Place->FldGroupInt = "0";
		$this->Place->FldGroupSql = "";

		// ID
		$this->ID = new crField('Recruited_Employee', 'Recruited Employee', 'x_ID', 'ID', '`ID`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['ID'] =& $this->ID;
		$this->ID->DateFilter = "";
		$this->ID->SqlSelect = "SELECT DISTINCT `ID` FROM " . $this->SqlFrom();
		$this->ID->SqlOrderBy = "`ID`";
		$this->ID->FldGroupByType = "";
		$this->ID->FldGroupInt = "0";
		$this->ID->FldGroupSql = "";

		// FirstName
		$this->FirstName = new crField('Recruited_Employee', 'Recruited Employee', 'x_FirstName', 'FirstName', '`FirstName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['FirstName'] =& $this->FirstName;
		$this->FirstName->DateFilter = "";
		$this->FirstName->SqlSelect = "SELECT DISTINCT `FirstName` FROM " . $this->SqlFrom();
		$this->FirstName->SqlOrderBy = "`FirstName`";
		$this->FirstName->FldGroupByType = "";
		$this->FirstName->FldGroupInt = "0";
		$this->FirstName->FldGroupSql = "";

		// MiddelName
		$this->MiddelName = new crField('Recruited_Employee', 'Recruited Employee', 'x_MiddelName', 'MiddelName', '`MiddelName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['MiddelName'] =& $this->MiddelName;
		$this->MiddelName->DateFilter = "";
		$this->MiddelName->SqlSelect = "SELECT DISTINCT `MiddelName` FROM " . $this->SqlFrom();
		$this->MiddelName->SqlOrderBy = "`MiddelName`";
		$this->MiddelName->FldGroupByType = "";
		$this->MiddelName->FldGroupInt = "0";
		$this->MiddelName->FldGroupSql = "";

		// LastName
		$this->LastName = new crField('Recruited_Employee', 'Recruited Employee', 'x_LastName', 'LastName', '`LastName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['LastName'] =& $this->LastName;
		$this->LastName->DateFilter = "";
		$this->LastName->SqlSelect = "SELECT DISTINCT `LastName` FROM " . $this->SqlFrom();
		$this->LastName->SqlOrderBy = "`LastName`";
		$this->LastName->FldGroupByType = "";
		$this->LastName->FldGroupInt = "0";
		$this->LastName->FldGroupSql = "";

		// Age
		$this->Age = new crField('Recruited_Employee', 'Recruited Employee', 'x_Age', 'Age', '`Age`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->Age->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['Age'] =& $this->Age;
		$this->Age->DateFilter = "";
		$this->Age->SqlSelect = "SELECT DISTINCT `Age` FROM " . $this->SqlFrom();
		$this->Age->SqlOrderBy = "`Age`";
		$this->Age->FldGroupByType = "";
		$this->Age->FldGroupInt = "0";
		$this->Age->FldGroupSql = "";

		// Sex
		$this->Sex = new crField('Recruited_Employee', 'Recruited Employee', 'x_Sex', 'Sex', '`Sex`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Sex'] =& $this->Sex;
		$this->Sex->DateFilter = "";
		$this->Sex->SqlSelect = "SELECT DISTINCT `Sex` FROM " . $this->SqlFrom();
		$this->Sex->SqlOrderBy = "`Sex`";
		$this->Sex->FldGroupByType = "";
		$this->Sex->FldGroupInt = "0";
		$this->Sex->FldGroupSql = "";

		// Photo
		$this->Photo = new crField('Recruited_Employee', 'Recruited Employee', 'x_Photo', 'Photo', '`Photo`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Photo'] =& $this->Photo;
		$this->Photo->DateFilter = "";
		$this->Photo->SqlSelect = "SELECT DISTINCT `Photo` FROM " . $this->SqlFrom();
		$this->Photo->SqlOrderBy = "`Photo`";
		$this->Photo->FldGroupByType = "";
		$this->Photo->FldGroupInt = "0";
		$this->Photo->FldGroupSql = "";

		// Date
		$this->Date = new crField('Recruited_Employee', 'Recruited Employee', 'x_Date', 'Date', '`Date`', 133, EWRPT_DATATYPE_DATE, 5);
		$this->Date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateYMD"));
		$this->fields['Date'] =& $this->Date;
		$this->Date->DateFilter = "";
		$this->Date->SqlSelect = "SELECT DISTINCT `Date` FROM " . $this->SqlFrom();
		$this->Date->SqlOrderBy = "`Date`";
		$this->Date->FldGroupByType = "";
		$this->Date->FldGroupInt = "0";
		$this->Date->FldGroupSql = "";

		// Address
		$this->Address = new crField('Recruited_Employee', 'Recruited Employee', 'x_Address', 'Address', '`Address`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Address'] =& $this->Address;
		$this->Address->DateFilter = "";
		$this->Address->SqlSelect = "SELECT DISTINCT `Address` FROM " . $this->SqlFrom();
		$this->Address->SqlOrderBy = "`Address`";
		$this->Address->FldGroupByType = "";
		$this->Address->FldGroupInt = "0";
		$this->Address->FldGroupSql = "";

		// Department
		$this->Department = new crField('Recruited_Employee', 'Recruited Employee', 'x_Department', 'Department', '`Department`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->Department->GroupingFieldId = 1;
		$this->fields['Department'] =& $this->Department;
		$this->Department->DateFilter = "";
		$this->Department->SqlSelect = "SELECT DISTINCT `Department` FROM " . $this->SqlFrom();
		$this->Department->SqlOrderBy = "`Department`";
		$this->Department->FldGroupByType = "";
		$this->Department->FldGroupInt = "0";
		$this->Department->FldGroupSql = "";

		// Position
		$this->Position = new crField('Recruited_Employee', 'Recruited Employee', 'x_Position', 'Position', '`Position`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Position'] =& $this->Position;
		$this->Position->DateFilter = "";
		$this->Position->SqlSelect = "SELECT DISTINCT `Position` FROM " . $this->SqlFrom();
		$this->Position->SqlOrderBy = "`Position`";
		$this->Position->FldGroupByType = "";
		$this->Position->FldGroupInt = "0";
		$this->Position->FldGroupSql = "";

		// Housing_Allowance
		$this->Housing_Allowance = new crField('Recruited_Employee', 'Recruited Employee', 'x_Housing_Allowance', 'Housing_Allowance', '`Housing_Allowance`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Housing_Allowance->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Housing_Allowance'] =& $this->Housing_Allowance;
		$this->Housing_Allowance->DateFilter = "";
		$this->Housing_Allowance->SqlSelect = "";
		$this->Housing_Allowance->SqlOrderBy = "";
		$this->Housing_Allowance->FldGroupByType = "";
		$this->Housing_Allowance->FldGroupInt = "0";
		$this->Housing_Allowance->FldGroupSql = "";

		// Salary
		$this->Salary = new crField('Recruited_Employee', 'Recruited Employee', 'x_Salary', 'Salary', '`Salary`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Salary->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Salary'] =& $this->Salary;
		$this->Salary->DateFilter = "";
		$this->Salary->SqlSelect = "";
		$this->Salary->SqlOrderBy = "";
		$this->Salary->FldGroupByType = "";
		$this->Salary->FldGroupInt = "0";
		$this->Salary->FldGroupSql = "";

		// Transport_Allowance
		$this->Transport_Allowance = new crField('Recruited_Employee', 'Recruited Employee', 'x_Transport_Allowance', 'Transport_Allowance', '`Transport_Allowance`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Transport_Allowance->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Transport_Allowance'] =& $this->Transport_Allowance;
		$this->Transport_Allowance->DateFilter = "";
		$this->Transport_Allowance->SqlSelect = "";
		$this->Transport_Allowance->SqlOrderBy = "";
		$this->Transport_Allowance->FldGroupByType = "";
		$this->Transport_Allowance->FldGroupInt = "0";
		$this->Transport_Allowance->FldGroupSql = "";

		// Hardship_Allowance
		$this->Hardship_Allowance = new crField('Recruited_Employee', 'Recruited Employee', 'x_Hardship_Allowance', 'Hardship_Allowance', '`Hardship_Allowance`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Hardship_Allowance->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Hardship_Allowance'] =& $this->Hardship_Allowance;
		$this->Hardship_Allowance->DateFilter = "";
		$this->Hardship_Allowance->SqlSelect = "";
		$this->Hardship_Allowance->SqlOrderBy = "";
		$this->Hardship_Allowance->FldGroupByType = "";
		$this->Hardship_Allowance->FldGroupInt = "0";
		$this->Hardship_Allowance->FldGroupSql = "";

		// Position_Allowance
		$this->Position_Allowance = new crField('Recruited_Employee', 'Recruited Employee', 'x_Position_Allowance', 'Position_Allowance', '`Position_Allowance`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Position_Allowance->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Position_Allowance'] =& $this->Position_Allowance;
		$this->Position_Allowance->DateFilter = "";
		$this->Position_Allowance->SqlSelect = "";
		$this->Position_Allowance->SqlOrderBy = "";
		$this->Position_Allowance->FldGroupByType = "";
		$this->Position_Allowance->FldGroupInt = "0";
		$this->Position_Allowance->FldGroupSql = "";
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
		return "`recruitment`";
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
$Recruited_Employee_summary = new crRecruited_Employee_summary();
$Page =& $Recruited_Employee_summary;

// Page init
$Recruited_Employee_summary->Page_Init();

// Page main
$Recruited_Employee_summary->Page_Main();
?>
<?php include "phprptinc/header.php"; ?>
<?php if ($Recruited_Employee->Export == "") { ?>
<script type="text/javascript">

// Create page object
var Recruited_Employee_summary = new ewrpt_Page("Recruited_Employee_summary");

// page properties
Recruited_Employee_summary.PageID = "summary"; // page ID
Recruited_Employee_summary.FormID = "fRecruited_Employeesummaryfilter"; // form ID
var EWRPT_PAGE_ID = Recruited_Employee_summary.PageID;

// extend page with ValidateForm function
Recruited_Employee_summary.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var elm = fobj.sv1_Age;
	if (elm && !ewrpt_CheckInteger(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Recruited_Employee->Age->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv1_Date;
	if (elm && !ewrpt_CheckDate(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Recruited_Employee->Date->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv2_Date;
	if (elm && !ewrpt_CheckDate(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Recruited_Employee->Date->FldErrMsg()) ?>"))
			return false;
	}

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj)) return false;
	return true;
}

// extend page with Form_CustomValidate function
Recruited_Employee_summary.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EWRPT_CLIENT_VALIDATE) { ?>
Recruited_Employee_summary.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
Recruited_Employee_summary.ValidateRequired = false; // no JavaScript validation
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
<?php $Recruited_Employee_summary->ShowPageHeader(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php $Recruited_Employee_summary->ShowMessage(); ?>
<?php if ($Recruited_Employee->Export == "" || $Recruited_Employee->Export == "print" || $Recruited_Employee->Export == "email") { ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php } ?>
<?php if ($Recruited_Employee->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
<?php $jsdata = ewrpt_GetJsData($Recruited_Employee->Department, $Recruited_Employee->Department->FldType); ?>
ewrpt_CreatePopup("Recruited_Employee_Department", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Recruited_Employee->Employee, $Recruited_Employee->Employee->FldType); ?>
ewrpt_CreatePopup("Recruited_Employee_Employee", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Recruited_Employee->Place, $Recruited_Employee->Place->FldType); ?>
ewrpt_CreatePopup("Recruited_Employee_Place", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Recruited_Employee->ID, $Recruited_Employee->ID->FldType); ?>
ewrpt_CreatePopup("Recruited_Employee_ID", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Recruited_Employee->FirstName, $Recruited_Employee->FirstName->FldType); ?>
ewrpt_CreatePopup("Recruited_Employee_FirstName", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Recruited_Employee->MiddelName, $Recruited_Employee->MiddelName->FldType); ?>
ewrpt_CreatePopup("Recruited_Employee_MiddelName", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Recruited_Employee->LastName, $Recruited_Employee->LastName->FldType); ?>
ewrpt_CreatePopup("Recruited_Employee_LastName", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Recruited_Employee->Age, $Recruited_Employee->Age->FldType); ?>
ewrpt_CreatePopup("Recruited_Employee_Age", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Recruited_Employee->Sex, $Recruited_Employee->Sex->FldType); ?>
ewrpt_CreatePopup("Recruited_Employee_Sex", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Recruited_Employee->Photo, $Recruited_Employee->Photo->FldType); ?>
ewrpt_CreatePopup("Recruited_Employee_Photo", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Recruited_Employee->Date, $Recruited_Employee->Date->FldType); ?>
ewrpt_CreatePopup("Recruited_Employee_Date", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Recruited_Employee->Address, $Recruited_Employee->Address->FldType); ?>
ewrpt_CreatePopup("Recruited_Employee_Address", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Recruited_Employee->Position, $Recruited_Employee->Position->FldType); ?>
ewrpt_CreatePopup("Recruited_Employee_Position", [<?php echo $jsdata ?>]);
</script>
<div id="Recruited_Employee_Department_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Recruited_Employee_Employee_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Recruited_Employee_Place_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Recruited_Employee_ID_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Recruited_Employee_FirstName_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Recruited_Employee_MiddelName_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Recruited_Employee_LastName_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Recruited_Employee_Age_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Recruited_Employee_Sex_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Recruited_Employee_Photo_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Recruited_Employee_Date_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Recruited_Employee_Address_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Recruited_Employee_Position_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<?php } ?>
<?php if ($Recruited_Employee->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<?php if ($Recruited_Employee->Export == "" || $Recruited_Employee->Export == "print" || $Recruited_Employee->Export == "email") { ?>
<?php } ?>
<?php echo $Recruited_Employee->TableCaption() ?>
<?php if ($Recruited_Employee->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $Recruited_Employee_summary->ExportPrintUrl ?>"><?php echo $ReportLanguage->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $Recruited_Employee_summary->ExportExcelUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $Recruited_Employee_summary->ExportWordUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToWord") ?></a>
<?php if ($Recruited_Employee_summary->FilterApplied) { ?>
&nbsp;&nbsp;<a href="Recruited_Employeesmry.php?cmd=reset"><?php echo $ReportLanguage->Phrase("ResetAllFilter") ?></a>
<?php } ?>
<?php } ?>
<br /><br />
<?php if ($Recruited_Employee->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($Recruited_Employee->Export == "" || $Recruited_Employee->Export == "print" || $Recruited_Employee->Export == "email") { ?>
<?php } ?>
<?php if ($Recruited_Employee->Export == "") { ?>
	</div></td>
	<!-- Left Container (End) -->
	<!-- Center Container - Report (Begin) -->
	<td style="vertical-align: top;" class="ewPadding"><div id="ewCenter" class="phpreportmaker">
	<!-- center slot -->
<?php } ?>
<!-- summary report starts -->
<div id="report_summary">
<?php if ($Recruited_Employee->Export == "") { ?>
<?php
if ($Recruited_Employee->FilterPanelOption == 2 || ($Recruited_Employee->FilterPanelOption == 3 && $Recruited_Employee_summary->FilterApplied) || $Recruited_Employee_summary->Filter == "0=101") {
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
<form name="fRecruited_Employeesummaryfilter" id="fRecruited_Employeesummaryfilter" action="Recruited_Employeesmry.php" class="ewForm" onsubmit="return Recruited_Employee_summary.ValidateForm(this);">
<table class="ewRptExtFilter">
	<tr>
		<td><span class="phpreportmaker"><?php echo $Recruited_Employee->Employee->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_Employee" id="so1_Employee" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_Employee" id="sv1_Employee" size="30" maxlength="50" value="<?php echo ewrpt_HtmlEncode($Recruited_Employee->Employee->SearchValue) ?>"<?php echo ($Recruited_Employee_summary->ClearExtFilter == 'Recruited_Employee_Employee') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Recruited_Employee->Place->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_Place" id="so1_Place" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_Place" id="sv1_Place" size="30" maxlength="30" value="<?php echo ewrpt_HtmlEncode($Recruited_Employee->Place->SearchValue) ?>"<?php echo ($Recruited_Employee_summary->ClearExtFilter == 'Recruited_Employee_Place') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Recruited_Employee->ID->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_ID" id="so1_ID" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_ID" id="sv1_ID" size="30" maxlength="8" value="<?php echo ewrpt_HtmlEncode($Recruited_Employee->ID->SearchValue) ?>"<?php echo ($Recruited_Employee_summary->ClearExtFilter == 'Recruited_Employee_ID') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Recruited_Employee->FirstName->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_FirstName" id="so1_FirstName" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_FirstName" id="sv1_FirstName" size="30" maxlength="20" value="<?php echo ewrpt_HtmlEncode($Recruited_Employee->FirstName->SearchValue) ?>"<?php echo ($Recruited_Employee_summary->ClearExtFilter == 'Recruited_Employee_FirstName') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Recruited_Employee->MiddelName->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_MiddelName" id="so1_MiddelName" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_MiddelName" id="sv1_MiddelName" size="30" maxlength="20" value="<?php echo ewrpt_HtmlEncode($Recruited_Employee->MiddelName->SearchValue) ?>"<?php echo ($Recruited_Employee_summary->ClearExtFilter == 'Recruited_Employee_MiddelName') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Recruited_Employee->Age->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("="); ?><input type="hidden" name="so1_Age" id="so1_Age" value="="></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_Age" id="sv1_Age" size="30" value="<?php echo ewrpt_HtmlEncode($Recruited_Employee->Age->SearchValue) ?>"<?php echo ($Recruited_Employee_summary->ClearExtFilter == 'Recruited_Employee_Age') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Recruited_Employee->Sex->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_Sex" id="so1_Sex" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_Sex" id="sv1_Sex" size="30" maxlength="7" value="<?php echo ewrpt_HtmlEncode($Recruited_Employee->Sex->SearchValue) ?>"<?php echo ($Recruited_Employee_summary->ClearExtFilter == 'Recruited_Employee_Sex') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Recruited_Employee->Date->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("BETWEEN"); ?><input type="hidden" name="so1_Date" id="so1_Date" value="BETWEEN"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_Date" id="sv1_Date" value="<?php echo ewrpt_HtmlEncode($Recruited_Employee->Date->SearchValue) ?>"<?php echo ($Recruited_Employee_summary->ClearExtFilter == 'Recruited_Employee_Date') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
				<td><span class="ewRptSearchOpr" id="btw1_Date" name="btw1_Date">&nbsp;<?php echo $ReportLanguage->Phrase("AND") ?>&nbsp;</span></td>
				<td><span class="phpreportmaker" id="btw1_Date" name="btw1_Date">
<input type="text" name="sv2_Date" id="sv2_Date" value="<?php echo ewrpt_HtmlEncode($Recruited_Employee->Date->SearchValue2) ?>"<?php echo ($Recruited_Employee_summary->ClearExtFilter == 'Recruited_Employee_Date') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Recruited_Employee->Department->FldCaption() ?></span></td>
		<td></td>
		<td colspan="4"><span class="ewRptSearchOpr">
		<select name="sv_Department[]" id="sv_Department[]" multiple<?php echo ($Recruited_Employee_summary->ClearExtFilter == 'Recruited_Employee_Department') ? " class=\"ewInputCleared\"" : "" ?>>
		<option value="<?php echo EWRPT_ALL_VALUE; ?>"<?php if (ewrpt_MatchedFilterValue($Recruited_Employee->Department->DropDownValue, EWRPT_ALL_VALUE)) echo " selected=\"selected\""; ?>><?php echo $ReportLanguage->Phrase("SelectAll"); ?></option>
<?php

// Popup filter
$cntf = is_array($Recruited_Employee->Department->CustomFilters) ? count($Recruited_Employee->Department->CustomFilters) : 0;
$cntd = is_array($Recruited_Employee->Department->DropDownList) ? count($Recruited_Employee->Department->DropDownList) : 0;
$totcnt = $cntf + $cntd;
$wrkcnt = 0;
	for ($i = 0; $i < $cntf; $i++) {
		if ($Recruited_Employee->Department->CustomFilters[$i]->FldName == 'Department') {
?>
		<option value="<?php echo "@@" . $Recruited_Employee->Department->CustomFilters[$i]->FilterName ?>"<?php if (ewrpt_MatchedFilterValue($Recruited_Employee->Department->DropDownValue, "@@" . $Recruited_Employee->Department->CustomFilters[$i]->FilterName)) echo " selected=\"selected\"" ?>><?php echo $Recruited_Employee->Department->CustomFilters[$i]->DisplayName ?></option>
<?php
		}
		$wrkcnt += 1;
	}

//}
	for ($i = 0; $i < $cntd; $i++) {
?>
		<option value="<?php echo $Recruited_Employee->Department->DropDownList[$i] ?>"<?php if (ewrpt_MatchedFilterValue($Recruited_Employee->Department->DropDownValue, $Recruited_Employee->Department->DropDownList[$i])) echo " selected=\"selected\"" ?>><?php echo ewrpt_DropDownDisplayValue($Recruited_Employee->Department->DropDownList[$i], "", 0) ?></option>
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
<?php if ($Recruited_Employee->ShowCurrentFilter) { ?>
<div id="ewrptFilterList">
<?php $Recruited_Employee_summary->ShowFilterList() ?>
</div>
<br />
<?php } ?>
<table class="ewGrid" cellspacing="0"><tr>
	<td class="ewGridContent">
<?php if ($Recruited_Employee->Export == "") { ?>
<div class="ewGridUpperPanel">
<form action="Recruited_Employeesmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($Recruited_Employee_summary->StartGrp, $Recruited_Employee_summary->DisplayGrps, $Recruited_Employee_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="Recruited_Employeesmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="Recruited_Employeesmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="Recruited_Employeesmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="Recruited_Employeesmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($Recruited_Employee_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($Recruited_Employee_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($Recruited_Employee_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($Recruited_Employee_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($Recruited_Employee_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($Recruited_Employee_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($Recruited_Employee_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($Recruited_Employee_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($Recruited_Employee_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($Recruited_Employee_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($Recruited_Employee->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
if ($Recruited_Employee->ExportAll && $Recruited_Employee->Export <> "") {
	$Recruited_Employee_summary->StopGrp = $Recruited_Employee_summary->TotalGrps;
} else {
	$Recruited_Employee_summary->StopGrp = $Recruited_Employee_summary->StartGrp + $Recruited_Employee_summary->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($Recruited_Employee_summary->StopGrp) > intval($Recruited_Employee_summary->TotalGrps))
	$Recruited_Employee_summary->StopGrp = $Recruited_Employee_summary->TotalGrps;
$Recruited_Employee_summary->RecCount = 0;

// Get first row
if ($Recruited_Employee_summary->TotalGrps > 0) {
	$Recruited_Employee_summary->GetGrpRow(1);
	$Recruited_Employee_summary->GrpCount = 1;
}
while (($rsgrp && !$rsgrp->EOF && $Recruited_Employee_summary->GrpCount <= $Recruited_Employee_summary->DisplayGrps) || $Recruited_Employee_summary->ShowFirstHeader) {

	// Show header
	if ($Recruited_Employee_summary->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Recruited_Employee->SortUrl($Recruited_Employee->Department) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Recruited_Employee->Department->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Recruited_Employee->SortUrl($Recruited_Employee->Department) ?>',0);"><?php echo $Recruited_Employee->Department->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Recruited_Employee->Department->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Recruited_Employee->Department->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Recruited_Employee->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Recruited_Employee_Department', false, '<?php echo $Recruited_Employee->Department->RangeFrom; ?>', '<?php echo $Recruited_Employee->Department->RangeTo; ?>');return false;" name="x_Department<?php echo $Recruited_Employee_summary->Cnt[0][0]; ?>" id="x_Department<?php echo $Recruited_Employee_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Recruited_Employee->SortUrl($Recruited_Employee->Employee) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Recruited_Employee->Employee->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Recruited_Employee->SortUrl($Recruited_Employee->Employee) ?>',0);"><?php echo $Recruited_Employee->Employee->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Recruited_Employee->Employee->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Recruited_Employee->Employee->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Recruited_Employee->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Recruited_Employee_Employee', false, '<?php echo $Recruited_Employee->Employee->RangeFrom; ?>', '<?php echo $Recruited_Employee->Employee->RangeTo; ?>');return false;" name="x_Employee<?php echo $Recruited_Employee_summary->Cnt[0][0]; ?>" id="x_Employee<?php echo $Recruited_Employee_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Recruited_Employee->SortUrl($Recruited_Employee->Place) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Recruited_Employee->Place->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Recruited_Employee->SortUrl($Recruited_Employee->Place) ?>',0);"><?php echo $Recruited_Employee->Place->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Recruited_Employee->Place->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Recruited_Employee->Place->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Recruited_Employee->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Recruited_Employee_Place', false, '<?php echo $Recruited_Employee->Place->RangeFrom; ?>', '<?php echo $Recruited_Employee->Place->RangeTo; ?>');return false;" name="x_Place<?php echo $Recruited_Employee_summary->Cnt[0][0]; ?>" id="x_Place<?php echo $Recruited_Employee_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Recruited_Employee->SortUrl($Recruited_Employee->ID) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Recruited_Employee->ID->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Recruited_Employee->SortUrl($Recruited_Employee->ID) ?>',0);"><?php echo $Recruited_Employee->ID->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Recruited_Employee->ID->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Recruited_Employee->ID->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Recruited_Employee->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Recruited_Employee_ID', false, '<?php echo $Recruited_Employee->ID->RangeFrom; ?>', '<?php echo $Recruited_Employee->ID->RangeTo; ?>');return false;" name="x_ID<?php echo $Recruited_Employee_summary->Cnt[0][0]; ?>" id="x_ID<?php echo $Recruited_Employee_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Recruited_Employee->SortUrl($Recruited_Employee->FirstName) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Recruited_Employee->FirstName->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Recruited_Employee->SortUrl($Recruited_Employee->FirstName) ?>',0);"><?php echo $Recruited_Employee->FirstName->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Recruited_Employee->FirstName->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Recruited_Employee->FirstName->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Recruited_Employee->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Recruited_Employee_FirstName', false, '<?php echo $Recruited_Employee->FirstName->RangeFrom; ?>', '<?php echo $Recruited_Employee->FirstName->RangeTo; ?>');return false;" name="x_FirstName<?php echo $Recruited_Employee_summary->Cnt[0][0]; ?>" id="x_FirstName<?php echo $Recruited_Employee_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Recruited_Employee->SortUrl($Recruited_Employee->MiddelName) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Recruited_Employee->MiddelName->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Recruited_Employee->SortUrl($Recruited_Employee->MiddelName) ?>',0);"><?php echo $Recruited_Employee->MiddelName->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Recruited_Employee->MiddelName->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Recruited_Employee->MiddelName->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Recruited_Employee->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Recruited_Employee_MiddelName', false, '<?php echo $Recruited_Employee->MiddelName->RangeFrom; ?>', '<?php echo $Recruited_Employee->MiddelName->RangeTo; ?>');return false;" name="x_MiddelName<?php echo $Recruited_Employee_summary->Cnt[0][0]; ?>" id="x_MiddelName<?php echo $Recruited_Employee_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Recruited_Employee->SortUrl($Recruited_Employee->LastName) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Recruited_Employee->LastName->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Recruited_Employee->SortUrl($Recruited_Employee->LastName) ?>',0);"><?php echo $Recruited_Employee->LastName->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Recruited_Employee->LastName->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Recruited_Employee->LastName->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Recruited_Employee->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Recruited_Employee_LastName', false, '<?php echo $Recruited_Employee->LastName->RangeFrom; ?>', '<?php echo $Recruited_Employee->LastName->RangeTo; ?>');return false;" name="x_LastName<?php echo $Recruited_Employee_summary->Cnt[0][0]; ?>" id="x_LastName<?php echo $Recruited_Employee_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Recruited_Employee->SortUrl($Recruited_Employee->Age) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Recruited_Employee->Age->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Recruited_Employee->SortUrl($Recruited_Employee->Age) ?>',0);"><?php echo $Recruited_Employee->Age->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Recruited_Employee->Age->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Recruited_Employee->Age->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Recruited_Employee->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Recruited_Employee_Age', false, '<?php echo $Recruited_Employee->Age->RangeFrom; ?>', '<?php echo $Recruited_Employee->Age->RangeTo; ?>');return false;" name="x_Age<?php echo $Recruited_Employee_summary->Cnt[0][0]; ?>" id="x_Age<?php echo $Recruited_Employee_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Recruited_Employee->SortUrl($Recruited_Employee->Sex) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Recruited_Employee->Sex->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Recruited_Employee->SortUrl($Recruited_Employee->Sex) ?>',0);"><?php echo $Recruited_Employee->Sex->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Recruited_Employee->Sex->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Recruited_Employee->Sex->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Recruited_Employee->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Recruited_Employee_Sex', false, '<?php echo $Recruited_Employee->Sex->RangeFrom; ?>', '<?php echo $Recruited_Employee->Sex->RangeTo; ?>');return false;" name="x_Sex<?php echo $Recruited_Employee_summary->Cnt[0][0]; ?>" id="x_Sex<?php echo $Recruited_Employee_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Recruited_Employee->SortUrl($Recruited_Employee->Photo) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Recruited_Employee->Photo->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Recruited_Employee->SortUrl($Recruited_Employee->Photo) ?>',0);"><?php echo $Recruited_Employee->Photo->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Recruited_Employee->Photo->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Recruited_Employee->Photo->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Recruited_Employee->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Recruited_Employee_Photo', false, '<?php echo $Recruited_Employee->Photo->RangeFrom; ?>', '<?php echo $Recruited_Employee->Photo->RangeTo; ?>');return false;" name="x_Photo<?php echo $Recruited_Employee_summary->Cnt[0][0]; ?>" id="x_Photo<?php echo $Recruited_Employee_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Recruited_Employee->SortUrl($Recruited_Employee->Date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Recruited_Employee->Date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Recruited_Employee->SortUrl($Recruited_Employee->Date) ?>',0);"><?php echo $Recruited_Employee->Date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Recruited_Employee->Date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Recruited_Employee->Date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Recruited_Employee->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Recruited_Employee_Date', false, '<?php echo $Recruited_Employee->Date->RangeFrom; ?>', '<?php echo $Recruited_Employee->Date->RangeTo; ?>');return false;" name="x_Date<?php echo $Recruited_Employee_summary->Cnt[0][0]; ?>" id="x_Date<?php echo $Recruited_Employee_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Recruited_Employee->SortUrl($Recruited_Employee->Address) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Recruited_Employee->Address->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Recruited_Employee->SortUrl($Recruited_Employee->Address) ?>',0);"><?php echo $Recruited_Employee->Address->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Recruited_Employee->Address->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Recruited_Employee->Address->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Recruited_Employee->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Recruited_Employee_Address', false, '<?php echo $Recruited_Employee->Address->RangeFrom; ?>', '<?php echo $Recruited_Employee->Address->RangeTo; ?>');return false;" name="x_Address<?php echo $Recruited_Employee_summary->Cnt[0][0]; ?>" id="x_Address<?php echo $Recruited_Employee_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Recruited_Employee->SortUrl($Recruited_Employee->Position) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Recruited_Employee->Position->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Recruited_Employee->SortUrl($Recruited_Employee->Position) ?>',0);"><?php echo $Recruited_Employee->Position->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Recruited_Employee->Position->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Recruited_Employee->Position->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Recruited_Employee->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Recruited_Employee_Position', false, '<?php echo $Recruited_Employee->Position->RangeFrom; ?>', '<?php echo $Recruited_Employee->Position->RangeTo; ?>');return false;" name="x_Position<?php echo $Recruited_Employee_summary->Cnt[0][0]; ?>" id="x_Position<?php echo $Recruited_Employee_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Recruited_Employee->SortUrl($Recruited_Employee->Housing_Allowance) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Recruited_Employee->Housing_Allowance->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Recruited_Employee->SortUrl($Recruited_Employee->Housing_Allowance) ?>',0);"><?php echo $Recruited_Employee->Housing_Allowance->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Recruited_Employee->Housing_Allowance->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Recruited_Employee->Housing_Allowance->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Recruited_Employee->SortUrl($Recruited_Employee->Salary) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Recruited_Employee->Salary->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Recruited_Employee->SortUrl($Recruited_Employee->Salary) ?>',0);"><?php echo $Recruited_Employee->Salary->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Recruited_Employee->Salary->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Recruited_Employee->Salary->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Recruited_Employee->SortUrl($Recruited_Employee->Transport_Allowance) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Recruited_Employee->Transport_Allowance->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Recruited_Employee->SortUrl($Recruited_Employee->Transport_Allowance) ?>',0);"><?php echo $Recruited_Employee->Transport_Allowance->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Recruited_Employee->Transport_Allowance->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Recruited_Employee->Transport_Allowance->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Recruited_Employee->SortUrl($Recruited_Employee->Hardship_Allowance) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Recruited_Employee->Hardship_Allowance->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Recruited_Employee->SortUrl($Recruited_Employee->Hardship_Allowance) ?>',0);"><?php echo $Recruited_Employee->Hardship_Allowance->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Recruited_Employee->Hardship_Allowance->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Recruited_Employee->Hardship_Allowance->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Recruited_Employee->SortUrl($Recruited_Employee->Position_Allowance) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Recruited_Employee->Position_Allowance->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Recruited_Employee->SortUrl($Recruited_Employee->Position_Allowance) ?>',0);"><?php echo $Recruited_Employee->Position_Allowance->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Recruited_Employee->Position_Allowance->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Recruited_Employee->Position_Allowance->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$Recruited_Employee_summary->ShowFirstHeader = FALSE;
	}

	// Build detail SQL
	$sWhere = ewrpt_DetailFilterSQL($Recruited_Employee->Department, $Recruited_Employee->SqlFirstGroupField(), $Recruited_Employee->Department->GroupValue());
	if ($Recruited_Employee_summary->Filter != "")
		$sWhere = "($Recruited_Employee_summary->Filter) AND ($sWhere)";
	$sSql = ewrpt_BuildReportSql($Recruited_Employee->SqlSelect(), $Recruited_Employee->SqlWhere(), $Recruited_Employee->SqlGroupBy(), $Recruited_Employee->SqlHaving(), $Recruited_Employee->SqlOrderBy(), $sWhere, $Recruited_Employee_summary->Sort);
	$rs = $conn->Execute($sSql);
	$rsdtlcnt = ($rs) ? $rs->RecordCount() : 0;
	if ($rsdtlcnt > 0)
		$Recruited_Employee_summary->GetRow(1);
	while ($rs && !$rs->EOF) { // Loop detail records
		$Recruited_Employee_summary->RecCount++;

		// Render detail row
		$Recruited_Employee->ResetCSS();
		$Recruited_Employee->RowType = EWRPT_ROWTYPE_DETAIL;
		$Recruited_Employee_summary->RenderRow();
?>
	<tr<?php echo $Recruited_Employee->RowAttributes(); ?>>
		<td<?php echo $Recruited_Employee->Department->CellAttributes(); ?>><div<?php echo $Recruited_Employee->Department->ViewAttributes(); ?>><?php echo $Recruited_Employee->Department->GroupViewValue; ?></div></td>
		<td<?php echo $Recruited_Employee->Employee->CellAttributes() ?>>
<div<?php echo $Recruited_Employee->Employee->ViewAttributes(); ?>><?php echo $Recruited_Employee->Employee->ListViewValue(); ?></div>
</td>
		<td<?php echo $Recruited_Employee->Place->CellAttributes() ?>>
<div<?php echo $Recruited_Employee->Place->ViewAttributes(); ?>><?php echo $Recruited_Employee->Place->ListViewValue(); ?></div>
</td>
		<td<?php echo $Recruited_Employee->ID->CellAttributes() ?>>
<div<?php echo $Recruited_Employee->ID->ViewAttributes(); ?>><?php echo $Recruited_Employee->ID->ListViewValue(); ?></div>
</td>
		<td<?php echo $Recruited_Employee->FirstName->CellAttributes() ?>>
<div<?php echo $Recruited_Employee->FirstName->ViewAttributes(); ?>><?php echo $Recruited_Employee->FirstName->ListViewValue(); ?></div>
</td>
		<td<?php echo $Recruited_Employee->MiddelName->CellAttributes() ?>>
<div<?php echo $Recruited_Employee->MiddelName->ViewAttributes(); ?>><?php echo $Recruited_Employee->MiddelName->ListViewValue(); ?></div>
</td>
		<td<?php echo $Recruited_Employee->LastName->CellAttributes() ?>>
<div<?php echo $Recruited_Employee->LastName->ViewAttributes(); ?>><?php echo $Recruited_Employee->LastName->ListViewValue(); ?></div>
</td>
		<td<?php echo $Recruited_Employee->Age->CellAttributes() ?>>
<div<?php echo $Recruited_Employee->Age->ViewAttributes(); ?>><?php echo $Recruited_Employee->Age->ListViewValue(); ?></div>
</td>
		<td<?php echo $Recruited_Employee->Sex->CellAttributes() ?>>
<div<?php echo $Recruited_Employee->Sex->ViewAttributes(); ?>><?php echo $Recruited_Employee->Sex->ListViewValue(); ?></div>
</td>
		<td<?php echo $Recruited_Employee->Photo->CellAttributes() ?>>
<div<?php echo $Recruited_Employee->Photo->ViewAttributes(); ?>><?php echo $Recruited_Employee->Photo->ListViewValue(); ?></div>
</td>
		<td<?php echo $Recruited_Employee->Date->CellAttributes() ?>>
<div<?php echo $Recruited_Employee->Date->ViewAttributes(); ?>><?php echo $Recruited_Employee->Date->ListViewValue(); ?></div>
</td>
		<td<?php echo $Recruited_Employee->Address->CellAttributes() ?>>
<div<?php echo $Recruited_Employee->Address->ViewAttributes(); ?>><?php echo $Recruited_Employee->Address->ListViewValue(); ?></div>
</td>
		<td<?php echo $Recruited_Employee->Position->CellAttributes() ?>>
<div<?php echo $Recruited_Employee->Position->ViewAttributes(); ?>><?php echo $Recruited_Employee->Position->ListViewValue(); ?></div>
</td>
		<td<?php echo $Recruited_Employee->Housing_Allowance->CellAttributes() ?>>
<div<?php echo $Recruited_Employee->Housing_Allowance->ViewAttributes(); ?>><?php echo $Recruited_Employee->Housing_Allowance->ListViewValue(); ?></div>
</td>
		<td<?php echo $Recruited_Employee->Salary->CellAttributes() ?>>
<div<?php echo $Recruited_Employee->Salary->ViewAttributes(); ?>><?php echo $Recruited_Employee->Salary->ListViewValue(); ?></div>
</td>
		<td<?php echo $Recruited_Employee->Transport_Allowance->CellAttributes() ?>>
<div<?php echo $Recruited_Employee->Transport_Allowance->ViewAttributes(); ?>><?php echo $Recruited_Employee->Transport_Allowance->ListViewValue(); ?></div>
</td>
		<td<?php echo $Recruited_Employee->Hardship_Allowance->CellAttributes() ?>>
<div<?php echo $Recruited_Employee->Hardship_Allowance->ViewAttributes(); ?>><?php echo $Recruited_Employee->Hardship_Allowance->ListViewValue(); ?></div>
</td>
		<td<?php echo $Recruited_Employee->Position_Allowance->CellAttributes() ?>>
<div<?php echo $Recruited_Employee->Position_Allowance->ViewAttributes(); ?>><?php echo $Recruited_Employee->Position_Allowance->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$Recruited_Employee_summary->AccumulateSummary();

		// Get next record
		$Recruited_Employee_summary->GetRow(2);

		// Show Footers
?>
<?php
	} // End detail records loop
?>
<?php
			$Recruited_Employee->ResetCSS();
			$Recruited_Employee->RowType = EWRPT_ROWTYPE_TOTAL;
			$Recruited_Employee->RowTotalType = EWRPT_ROWTOTAL_GROUP;
			$Recruited_Employee->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
			$Recruited_Employee->RowGroupLevel = 1;
			$Recruited_Employee_summary->RenderRow();
?>
	<tr<?php echo $Recruited_Employee->RowAttributes(); ?>>
		<td colspan="18"<?php echo $Recruited_Employee->Department->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSumHead") ?> <?php echo $Recruited_Employee->Department->FldCaption() ?>: <?php echo $Recruited_Employee->Department->GroupViewValue; ?> (<?php echo ewrpt_FormatNumber($Recruited_Employee_summary->Cnt[1][0],0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php

			// Reset level 1 summary
			$Recruited_Employee_summary->ResetLevelSummary(1);
?>
<?php

	// Next group
	$Recruited_Employee_summary->GetGrpRow(2);
	$Recruited_Employee_summary->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
<?php if (intval(@$Recruited_Employee_summary->Cnt[0][17]) > 0) { ?>
<?php
	$Recruited_Employee->ResetCSS();
	$Recruited_Employee->RowType = EWRPT_ROWTYPE_TOTAL;
	$Recruited_Employee->RowTotalType = EWRPT_ROWTOTAL_PAGE;
	$Recruited_Employee->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
	$Recruited_Employee->RowAttrs["class"] = "ewRptPageSummary";
	$Recruited_Employee_summary->RenderRow();
?>
	<tr<?php echo $Recruited_Employee->RowAttributes(); ?>><td colspan="18"><?php echo $ReportLanguage->Phrase("RptPageTotal") ?> (<?php echo ewrpt_FormatNumber($Recruited_Employee_summary->Cnt[0][17],0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
	<!-- tr class="ewRptPageSummary"><td colspan="18"><span class="phpreportmaker">&nbsp;<br /></span></td></tr -->
<?php } ?>
<?php
if ($Recruited_Employee_summary->TotalGrps > 0) {
	$Recruited_Employee->ResetCSS();
	$Recruited_Employee->RowType = EWRPT_ROWTYPE_TOTAL;
	$Recruited_Employee->RowTotalType = EWRPT_ROWTOTAL_GRAND;
	$Recruited_Employee->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
	$Recruited_Employee->RowAttrs["class"] = "ewRptGrandSummary";
	$Recruited_Employee_summary->RenderRow();
?>
	<!-- tr><td colspan="18"><span class="phpreportmaker">&nbsp;<br /></span></td></tr -->
	<tr<?php echo $Recruited_Employee->RowAttributes(); ?>><td colspan="18"><?php echo $ReportLanguage->Phrase("RptGrandTotal") ?> (<?php echo ewrpt_FormatNumber($Recruited_Employee_summary->TotCount,0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php } ?>
	</tfoot>
</table>
</div>
<?php if ($Recruited_Employee_summary->TotalGrps > 0) { ?>
<?php if ($Recruited_Employee->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="Recruited_Employeesmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($Recruited_Employee_summary->StartGrp, $Recruited_Employee_summary->DisplayGrps, $Recruited_Employee_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="Recruited_Employeesmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="Recruited_Employeesmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="Recruited_Employeesmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="Recruited_Employeesmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($Recruited_Employee_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($Recruited_Employee_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($Recruited_Employee_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($Recruited_Employee_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($Recruited_Employee_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($Recruited_Employee_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($Recruited_Employee_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($Recruited_Employee_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($Recruited_Employee_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($Recruited_Employee_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($Recruited_Employee->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php if ($Recruited_Employee->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($Recruited_Employee->Export == "" || $Recruited_Employee->Export == "print" || $Recruited_Employee->Export == "email") { ?>
<?php } ?>
<?php if ($Recruited_Employee->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($Recruited_Employee->Export == "" || $Recruited_Employee->Export == "print" || $Recruited_Employee->Export == "email") { ?>
<?php } ?>
<?php if ($Recruited_Employee->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $Recruited_Employee_summary->ShowPageFooter(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($Recruited_Employee->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "phprptinc/footer.php"; ?>
<?php
$Recruited_Employee_summary->Page_Terminate();
?>
<?php

//
// Page class
//
class crRecruited_Employee_summary {

	// Page ID
	var $PageID = 'summary';

	// Table name
	var $TableName = 'Recruited Employee';

	// Page object name
	var $PageObjName = 'Recruited_Employee_summary';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $Recruited_Employee;
		if ($Recruited_Employee->UseTokenInUrl) $PageUrl .= "t=" . $Recruited_Employee->TableVar . "&"; // Add page token
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
		global $Recruited_Employee;
		if ($Recruited_Employee->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($Recruited_Employee->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($Recruited_Employee->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crRecruited_Employee_summary() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (Recruited_Employee)
		$GLOBALS["Recruited_Employee"] = new crRecruited_Employee();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'summary', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'Recruited Employee', TRUE);

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
		global $Recruited_Employee;

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$Recruited_Employee->Export = $_GET["export"];
	}
	$gsExport = $Recruited_Employee->Export; // Get export parameter, used in header
	$gsExportFile = $Recruited_Employee->TableVar; // Get export file, used in header
	if ($Recruited_Employee->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($Recruited_Employee->Export == "word") {
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
		global $Recruited_Employee;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($Recruited_Employee->Export == "email") {
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
		global $Recruited_Employee;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 18;
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
		$this->Col = array(FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE);

		// Set up groups per page dynamically
		$this->SetUpDisplayGrps();
		$Recruited_Employee->Department->SelectionList = "";
		$Recruited_Employee->Department->DefaultSelectionList = "";
		$Recruited_Employee->Department->ValueList = "";
		$Recruited_Employee->Employee->SelectionList = "";
		$Recruited_Employee->Employee->DefaultSelectionList = "";
		$Recruited_Employee->Employee->ValueList = "";
		$Recruited_Employee->Place->SelectionList = "";
		$Recruited_Employee->Place->DefaultSelectionList = "";
		$Recruited_Employee->Place->ValueList = "";
		$Recruited_Employee->ID->SelectionList = "";
		$Recruited_Employee->ID->DefaultSelectionList = "";
		$Recruited_Employee->ID->ValueList = "";
		$Recruited_Employee->FirstName->SelectionList = "";
		$Recruited_Employee->FirstName->DefaultSelectionList = "";
		$Recruited_Employee->FirstName->ValueList = "";
		$Recruited_Employee->MiddelName->SelectionList = "";
		$Recruited_Employee->MiddelName->DefaultSelectionList = "";
		$Recruited_Employee->MiddelName->ValueList = "";
		$Recruited_Employee->LastName->SelectionList = "";
		$Recruited_Employee->LastName->DefaultSelectionList = "";
		$Recruited_Employee->LastName->ValueList = "";
		$Recruited_Employee->Age->SelectionList = "";
		$Recruited_Employee->Age->DefaultSelectionList = "";
		$Recruited_Employee->Age->ValueList = "";
		$Recruited_Employee->Sex->SelectionList = "";
		$Recruited_Employee->Sex->DefaultSelectionList = "";
		$Recruited_Employee->Sex->ValueList = "";
		$Recruited_Employee->Photo->SelectionList = "";
		$Recruited_Employee->Photo->DefaultSelectionList = "";
		$Recruited_Employee->Photo->ValueList = "";
		$Recruited_Employee->Date->SelectionList = "";
		$Recruited_Employee->Date->DefaultSelectionList = "";
		$Recruited_Employee->Date->ValueList = "";
		$Recruited_Employee->Address->SelectionList = "";
		$Recruited_Employee->Address->DefaultSelectionList = "";
		$Recruited_Employee->Address->ValueList = "";
		$Recruited_Employee->Position->SelectionList = "";
		$Recruited_Employee->Position->DefaultSelectionList = "";
		$Recruited_Employee->Position->ValueList = "";

		// Load default filter values
		$this->LoadDefaultFilters();

		// Set up popup filter
		$this->SetupPopup();

		// Extended filter
		$sExtendedFilter = "";

		// Get dropdown values
		$this->GetExtendedFilterValues();

		// Load custom filters
		$Recruited_Employee->CustomFilters_Load();

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
		$sGrpSort = ewrpt_UpdateSortFields($Recruited_Employee->SqlOrderByGroup(), $this->Sort, 2); // Get grouping field only
		$sSql = ewrpt_BuildReportSql($Recruited_Employee->SqlSelectGroup(), $Recruited_Employee->SqlWhere(), $Recruited_Employee->SqlGroupBy(), $Recruited_Employee->SqlHaving(), $Recruited_Employee->SqlOrderByGroup(), $this->Filter, $sGrpSort);
		$this->TotalGrps = $this->GetGrpCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($Recruited_Employee->ExportAll && $Recruited_Employee->Export <> "")
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
		global $Recruited_Employee;
		switch ($lvl) {
			case 1:
				return (is_null($Recruited_Employee->Department->CurrentValue) && !is_null($Recruited_Employee->Department->OldValue)) ||
					(!is_null($Recruited_Employee->Department->CurrentValue) && is_null($Recruited_Employee->Department->OldValue)) ||
					($Recruited_Employee->Department->GroupValue() <> $Recruited_Employee->Department->GroupOldValue());
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
		global $Recruited_Employee;
		$rsgrpcnt = $conn->Execute($sql);
		$grpcnt = ($rsgrpcnt) ? $rsgrpcnt->RecordCount() : 0;
		if ($rsgrpcnt) $rsgrpcnt->Close();
		return $grpcnt;
	}

	// Get group rs
	function GetGrpRs($sql, $start, $grps) {
		global $conn;
		global $Recruited_Employee;
		$wrksql = $sql;
		if ($start > 0 && $grps > -1)
			$wrksql .= " LIMIT " . ($start-1) . ", " . ($grps);
		$rswrk = $conn->Execute($wrksql);
		return $rswrk;
	}

	// Get group row values
	function GetGrpRow($opt) {
		global $rsgrp;
		global $Recruited_Employee;
		if (!$rsgrp)
			return;
		if ($opt == 1) { // Get first group

			//$rsgrp->MoveFirst(); // NOTE: no need to move position
			$Recruited_Employee->Department->setDbValue(""); // Init first value
		} else { // Get next group
			$rsgrp->MoveNext();
		}
		if (!$rsgrp->EOF)
			$Recruited_Employee->Department->setDbValue($rsgrp->fields('Department'));
		if ($rsgrp->EOF) {
			$Recruited_Employee->Department->setDbValue("");
		}
	}

	// Get row values
	function GetRow($opt) {
		global $rs;
		global $Recruited_Employee;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$Recruited_Employee->Auto_ID->setDbValue($rs->fields('Auto_ID'));
			$Recruited_Employee->Employee->setDbValue($rs->fields('Employee'));
			$Recruited_Employee->Place->setDbValue($rs->fields('Place'));
			$Recruited_Employee->ID->setDbValue($rs->fields('ID'));
			$Recruited_Employee->FirstName->setDbValue($rs->fields('FirstName'));
			$Recruited_Employee->MiddelName->setDbValue($rs->fields('MiddelName'));
			$Recruited_Employee->LastName->setDbValue($rs->fields('LastName'));
			$Recruited_Employee->Age->setDbValue($rs->fields('Age'));
			$Recruited_Employee->Sex->setDbValue($rs->fields('Sex'));
			$Recruited_Employee->Photo->setDbValue($rs->fields('Photo'));
			$Recruited_Employee->Date->setDbValue($rs->fields('Date'));
			$Recruited_Employee->Address->setDbValue($rs->fields('Address'));
			if ($opt <> 1)
				$Recruited_Employee->Department->setDbValue($rs->fields('Department'));
			$Recruited_Employee->Position->setDbValue($rs->fields('Position'));
			$Recruited_Employee->Housing_Allowance->setDbValue($rs->fields('Housing_Allowance'));
			$Recruited_Employee->Salary->setDbValue($rs->fields('Salary'));
			$Recruited_Employee->Transport_Allowance->setDbValue($rs->fields('Transport_Allowance'));
			$Recruited_Employee->Hardship_Allowance->setDbValue($rs->fields('Hardship_Allowance'));
			$Recruited_Employee->Position_Allowance->setDbValue($rs->fields('Position_Allowance'));
			$this->Val[1] = $Recruited_Employee->Employee->CurrentValue;
			$this->Val[2] = $Recruited_Employee->Place->CurrentValue;
			$this->Val[3] = $Recruited_Employee->ID->CurrentValue;
			$this->Val[4] = $Recruited_Employee->FirstName->CurrentValue;
			$this->Val[5] = $Recruited_Employee->MiddelName->CurrentValue;
			$this->Val[6] = $Recruited_Employee->LastName->CurrentValue;
			$this->Val[7] = $Recruited_Employee->Age->CurrentValue;
			$this->Val[8] = $Recruited_Employee->Sex->CurrentValue;
			$this->Val[9] = $Recruited_Employee->Photo->CurrentValue;
			$this->Val[10] = $Recruited_Employee->Date->CurrentValue;
			$this->Val[11] = $Recruited_Employee->Address->CurrentValue;
			$this->Val[12] = $Recruited_Employee->Position->CurrentValue;
			$this->Val[13] = $Recruited_Employee->Housing_Allowance->CurrentValue;
			$this->Val[14] = $Recruited_Employee->Salary->CurrentValue;
			$this->Val[15] = $Recruited_Employee->Transport_Allowance->CurrentValue;
			$this->Val[16] = $Recruited_Employee->Hardship_Allowance->CurrentValue;
			$this->Val[17] = $Recruited_Employee->Position_Allowance->CurrentValue;
		} else {
			$Recruited_Employee->Auto_ID->setDbValue("");
			$Recruited_Employee->Employee->setDbValue("");
			$Recruited_Employee->Place->setDbValue("");
			$Recruited_Employee->ID->setDbValue("");
			$Recruited_Employee->FirstName->setDbValue("");
			$Recruited_Employee->MiddelName->setDbValue("");
			$Recruited_Employee->LastName->setDbValue("");
			$Recruited_Employee->Age->setDbValue("");
			$Recruited_Employee->Sex->setDbValue("");
			$Recruited_Employee->Photo->setDbValue("");
			$Recruited_Employee->Date->setDbValue("");
			$Recruited_Employee->Address->setDbValue("");
			$Recruited_Employee->Department->setDbValue("");
			$Recruited_Employee->Position->setDbValue("");
			$Recruited_Employee->Housing_Allowance->setDbValue("");
			$Recruited_Employee->Salary->setDbValue("");
			$Recruited_Employee->Transport_Allowance->setDbValue("");
			$Recruited_Employee->Hardship_Allowance->setDbValue("");
			$Recruited_Employee->Position_Allowance->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $Recruited_Employee;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$Recruited_Employee->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$Recruited_Employee->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $Recruited_Employee->getStartGroup();
			}
		} else {
			$this->StartGrp = $Recruited_Employee->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$Recruited_Employee->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$Recruited_Employee->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$Recruited_Employee->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $Recruited_Employee;

		// Initialize popup
		// Build distinct values for Department

		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Recruited_Employee->Department->SqlSelect, $Recruited_Employee->SqlWhere(), $Recruited_Employee->SqlGroupBy(), $Recruited_Employee->SqlHaving(), $Recruited_Employee->Department->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Recruited_Employee->Department->setDbValue($rswrk->fields[0]);
			if (is_null($Recruited_Employee->Department->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Recruited_Employee->Department->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Recruited_Employee->Department->GroupViewValue = ewrpt_DisplayGroupValue($Recruited_Employee->Department,$Recruited_Employee->Department->GroupValue());
				ewrpt_SetupDistinctValues($Recruited_Employee->Department->ValueList, $Recruited_Employee->Department->GroupValue(), $Recruited_Employee->Department->GroupViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Recruited_Employee->Department->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Recruited_Employee->Department->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for Employee
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Recruited_Employee->Employee->SqlSelect, $Recruited_Employee->SqlWhere(), $Recruited_Employee->SqlGroupBy(), $Recruited_Employee->SqlHaving(), $Recruited_Employee->Employee->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Recruited_Employee->Employee->setDbValue($rswrk->fields[0]);
			if (is_null($Recruited_Employee->Employee->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Recruited_Employee->Employee->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Recruited_Employee->Employee->ViewValue = $Recruited_Employee->Employee->CurrentValue;
				ewrpt_SetupDistinctValues($Recruited_Employee->Employee->ValueList, $Recruited_Employee->Employee->CurrentValue, $Recruited_Employee->Employee->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Recruited_Employee->Employee->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Recruited_Employee->Employee->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for Place
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Recruited_Employee->Place->SqlSelect, $Recruited_Employee->SqlWhere(), $Recruited_Employee->SqlGroupBy(), $Recruited_Employee->SqlHaving(), $Recruited_Employee->Place->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Recruited_Employee->Place->setDbValue($rswrk->fields[0]);
			if (is_null($Recruited_Employee->Place->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Recruited_Employee->Place->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Recruited_Employee->Place->ViewValue = $Recruited_Employee->Place->CurrentValue;
				ewrpt_SetupDistinctValues($Recruited_Employee->Place->ValueList, $Recruited_Employee->Place->CurrentValue, $Recruited_Employee->Place->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Recruited_Employee->Place->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Recruited_Employee->Place->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for ID
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Recruited_Employee->ID->SqlSelect, $Recruited_Employee->SqlWhere(), $Recruited_Employee->SqlGroupBy(), $Recruited_Employee->SqlHaving(), $Recruited_Employee->ID->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Recruited_Employee->ID->setDbValue($rswrk->fields[0]);
			if (is_null($Recruited_Employee->ID->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Recruited_Employee->ID->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Recruited_Employee->ID->ViewValue = $Recruited_Employee->ID->CurrentValue;
				ewrpt_SetupDistinctValues($Recruited_Employee->ID->ValueList, $Recruited_Employee->ID->CurrentValue, $Recruited_Employee->ID->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Recruited_Employee->ID->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Recruited_Employee->ID->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for FirstName
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Recruited_Employee->FirstName->SqlSelect, $Recruited_Employee->SqlWhere(), $Recruited_Employee->SqlGroupBy(), $Recruited_Employee->SqlHaving(), $Recruited_Employee->FirstName->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Recruited_Employee->FirstName->setDbValue($rswrk->fields[0]);
			if (is_null($Recruited_Employee->FirstName->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Recruited_Employee->FirstName->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Recruited_Employee->FirstName->ViewValue = $Recruited_Employee->FirstName->CurrentValue;
				ewrpt_SetupDistinctValues($Recruited_Employee->FirstName->ValueList, $Recruited_Employee->FirstName->CurrentValue, $Recruited_Employee->FirstName->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Recruited_Employee->FirstName->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Recruited_Employee->FirstName->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for MiddelName
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Recruited_Employee->MiddelName->SqlSelect, $Recruited_Employee->SqlWhere(), $Recruited_Employee->SqlGroupBy(), $Recruited_Employee->SqlHaving(), $Recruited_Employee->MiddelName->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Recruited_Employee->MiddelName->setDbValue($rswrk->fields[0]);
			if (is_null($Recruited_Employee->MiddelName->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Recruited_Employee->MiddelName->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Recruited_Employee->MiddelName->ViewValue = $Recruited_Employee->MiddelName->CurrentValue;
				ewrpt_SetupDistinctValues($Recruited_Employee->MiddelName->ValueList, $Recruited_Employee->MiddelName->CurrentValue, $Recruited_Employee->MiddelName->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Recruited_Employee->MiddelName->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Recruited_Employee->MiddelName->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for LastName
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Recruited_Employee->LastName->SqlSelect, $Recruited_Employee->SqlWhere(), $Recruited_Employee->SqlGroupBy(), $Recruited_Employee->SqlHaving(), $Recruited_Employee->LastName->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Recruited_Employee->LastName->setDbValue($rswrk->fields[0]);
			if (is_null($Recruited_Employee->LastName->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Recruited_Employee->LastName->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Recruited_Employee->LastName->ViewValue = $Recruited_Employee->LastName->CurrentValue;
				ewrpt_SetupDistinctValues($Recruited_Employee->LastName->ValueList, $Recruited_Employee->LastName->CurrentValue, $Recruited_Employee->LastName->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Recruited_Employee->LastName->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Recruited_Employee->LastName->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for Age
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Recruited_Employee->Age->SqlSelect, $Recruited_Employee->SqlWhere(), $Recruited_Employee->SqlGroupBy(), $Recruited_Employee->SqlHaving(), $Recruited_Employee->Age->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Recruited_Employee->Age->setDbValue($rswrk->fields[0]);
			if (is_null($Recruited_Employee->Age->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Recruited_Employee->Age->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Recruited_Employee->Age->ViewValue = $Recruited_Employee->Age->CurrentValue;
				ewrpt_SetupDistinctValues($Recruited_Employee->Age->ValueList, $Recruited_Employee->Age->CurrentValue, $Recruited_Employee->Age->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Recruited_Employee->Age->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Recruited_Employee->Age->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for Sex
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Recruited_Employee->Sex->SqlSelect, $Recruited_Employee->SqlWhere(), $Recruited_Employee->SqlGroupBy(), $Recruited_Employee->SqlHaving(), $Recruited_Employee->Sex->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Recruited_Employee->Sex->setDbValue($rswrk->fields[0]);
			if (is_null($Recruited_Employee->Sex->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Recruited_Employee->Sex->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Recruited_Employee->Sex->ViewValue = $Recruited_Employee->Sex->CurrentValue;
				ewrpt_SetupDistinctValues($Recruited_Employee->Sex->ValueList, $Recruited_Employee->Sex->CurrentValue, $Recruited_Employee->Sex->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Recruited_Employee->Sex->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Recruited_Employee->Sex->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for Photo
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Recruited_Employee->Photo->SqlSelect, $Recruited_Employee->SqlWhere(), $Recruited_Employee->SqlGroupBy(), $Recruited_Employee->SqlHaving(), $Recruited_Employee->Photo->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Recruited_Employee->Photo->setDbValue($rswrk->fields[0]);
			if (is_null($Recruited_Employee->Photo->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Recruited_Employee->Photo->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Recruited_Employee->Photo->ViewValue = $Recruited_Employee->Photo->CurrentValue;
				ewrpt_SetupDistinctValues($Recruited_Employee->Photo->ValueList, $Recruited_Employee->Photo->CurrentValue, $Recruited_Employee->Photo->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Recruited_Employee->Photo->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Recruited_Employee->Photo->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for Date
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Recruited_Employee->Date->SqlSelect, $Recruited_Employee->SqlWhere(), $Recruited_Employee->SqlGroupBy(), $Recruited_Employee->SqlHaving(), $Recruited_Employee->Date->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Recruited_Employee->Date->setDbValue($rswrk->fields[0]);
			if (is_null($Recruited_Employee->Date->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Recruited_Employee->Date->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Recruited_Employee->Date->ViewValue = ewrpt_FormatDateTime($Recruited_Employee->Date->CurrentValue, 5);
				ewrpt_SetupDistinctValues($Recruited_Employee->Date->ValueList, $Recruited_Employee->Date->CurrentValue, $Recruited_Employee->Date->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Recruited_Employee->Date->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Recruited_Employee->Date->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for Address
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Recruited_Employee->Address->SqlSelect, $Recruited_Employee->SqlWhere(), $Recruited_Employee->SqlGroupBy(), $Recruited_Employee->SqlHaving(), $Recruited_Employee->Address->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Recruited_Employee->Address->setDbValue($rswrk->fields[0]);
			if (is_null($Recruited_Employee->Address->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Recruited_Employee->Address->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Recruited_Employee->Address->ViewValue = $Recruited_Employee->Address->CurrentValue;
				ewrpt_SetupDistinctValues($Recruited_Employee->Address->ValueList, $Recruited_Employee->Address->CurrentValue, $Recruited_Employee->Address->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Recruited_Employee->Address->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Recruited_Employee->Address->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for Position
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Recruited_Employee->Position->SqlSelect, $Recruited_Employee->SqlWhere(), $Recruited_Employee->SqlGroupBy(), $Recruited_Employee->SqlHaving(), $Recruited_Employee->Position->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Recruited_Employee->Position->setDbValue($rswrk->fields[0]);
			if (is_null($Recruited_Employee->Position->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Recruited_Employee->Position->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Recruited_Employee->Position->ViewValue = $Recruited_Employee->Position->CurrentValue;
				ewrpt_SetupDistinctValues($Recruited_Employee->Position->ValueList, $Recruited_Employee->Position->CurrentValue, $Recruited_Employee->Position->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Recruited_Employee->Position->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Recruited_Employee->Position->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

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
				$this->ClearSessionSelection('Employee');
				$this->ClearSessionSelection('Place');
				$this->ClearSessionSelection('ID');
				$this->ClearSessionSelection('FirstName');
				$this->ClearSessionSelection('MiddelName');
				$this->ClearSessionSelection('LastName');
				$this->ClearSessionSelection('Age');
				$this->ClearSessionSelection('Sex');
				$this->ClearSessionSelection('Photo');
				$this->ClearSessionSelection('Date');
				$this->ClearSessionSelection('Address');
				$this->ClearSessionSelection('Position');
				$this->ResetPager();
			}
		}

		// Load selection criteria to array
		// Get Department selected values

		if (is_array(@$_SESSION["sel_Recruited_Employee_Department"])) {
			$this->LoadSelectionFromSession('Department');
		} elseif (@$_SESSION["sel_Recruited_Employee_Department"] == EWRPT_INIT_VALUE) { // Select all
			$Recruited_Employee->Department->SelectionList = "";
		}

		// Get Employee selected values
		if (is_array(@$_SESSION["sel_Recruited_Employee_Employee"])) {
			$this->LoadSelectionFromSession('Employee');
		} elseif (@$_SESSION["sel_Recruited_Employee_Employee"] == EWRPT_INIT_VALUE) { // Select all
			$Recruited_Employee->Employee->SelectionList = "";
		}

		// Get Place selected values
		if (is_array(@$_SESSION["sel_Recruited_Employee_Place"])) {
			$this->LoadSelectionFromSession('Place');
		} elseif (@$_SESSION["sel_Recruited_Employee_Place"] == EWRPT_INIT_VALUE) { // Select all
			$Recruited_Employee->Place->SelectionList = "";
		}

		// Get ID selected values
		if (is_array(@$_SESSION["sel_Recruited_Employee_ID"])) {
			$this->LoadSelectionFromSession('ID');
		} elseif (@$_SESSION["sel_Recruited_Employee_ID"] == EWRPT_INIT_VALUE) { // Select all
			$Recruited_Employee->ID->SelectionList = "";
		}

		// Get First Name selected values
		if (is_array(@$_SESSION["sel_Recruited_Employee_FirstName"])) {
			$this->LoadSelectionFromSession('FirstName');
		} elseif (@$_SESSION["sel_Recruited_Employee_FirstName"] == EWRPT_INIT_VALUE) { // Select all
			$Recruited_Employee->FirstName->SelectionList = "";
		}

		// Get Middel Name selected values
		if (is_array(@$_SESSION["sel_Recruited_Employee_MiddelName"])) {
			$this->LoadSelectionFromSession('MiddelName');
		} elseif (@$_SESSION["sel_Recruited_Employee_MiddelName"] == EWRPT_INIT_VALUE) { // Select all
			$Recruited_Employee->MiddelName->SelectionList = "";
		}

		// Get Last Name selected values
		if (is_array(@$_SESSION["sel_Recruited_Employee_LastName"])) {
			$this->LoadSelectionFromSession('LastName');
		} elseif (@$_SESSION["sel_Recruited_Employee_LastName"] == EWRPT_INIT_VALUE) { // Select all
			$Recruited_Employee->LastName->SelectionList = "";
		}

		// Get Age selected values
		if (is_array(@$_SESSION["sel_Recruited_Employee_Age"])) {
			$this->LoadSelectionFromSession('Age');
		} elseif (@$_SESSION["sel_Recruited_Employee_Age"] == EWRPT_INIT_VALUE) { // Select all
			$Recruited_Employee->Age->SelectionList = "";
		}

		// Get Sex selected values
		if (is_array(@$_SESSION["sel_Recruited_Employee_Sex"])) {
			$this->LoadSelectionFromSession('Sex');
		} elseif (@$_SESSION["sel_Recruited_Employee_Sex"] == EWRPT_INIT_VALUE) { // Select all
			$Recruited_Employee->Sex->SelectionList = "";
		}

		// Get Photo selected values
		if (is_array(@$_SESSION["sel_Recruited_Employee_Photo"])) {
			$this->LoadSelectionFromSession('Photo');
		} elseif (@$_SESSION["sel_Recruited_Employee_Photo"] == EWRPT_INIT_VALUE) { // Select all
			$Recruited_Employee->Photo->SelectionList = "";
		}

		// Get Date selected values
		if (is_array(@$_SESSION["sel_Recruited_Employee_Date"])) {
			$this->LoadSelectionFromSession('Date');
		} elseif (@$_SESSION["sel_Recruited_Employee_Date"] == EWRPT_INIT_VALUE) { // Select all
			$Recruited_Employee->Date->SelectionList = "";
		}

		// Get Address selected values
		if (is_array(@$_SESSION["sel_Recruited_Employee_Address"])) {
			$this->LoadSelectionFromSession('Address');
		} elseif (@$_SESSION["sel_Recruited_Employee_Address"] == EWRPT_INIT_VALUE) { // Select all
			$Recruited_Employee->Address->SelectionList = "";
		}

		// Get Position selected values
		if (is_array(@$_SESSION["sel_Recruited_Employee_Position"])) {
			$this->LoadSelectionFromSession('Position');
		} elseif (@$_SESSION["sel_Recruited_Employee_Position"] == EWRPT_INIT_VALUE) { // Select all
			$Recruited_Employee->Position->SelectionList = "";
		}
	}

	// Reset pager
	function ResetPager() {

		// Reset start position (reset command)
		global $Recruited_Employee;
		$this->StartGrp = 1;
		$Recruited_Employee->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $Recruited_Employee;
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
			$Recruited_Employee->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$Recruited_Employee->setStartGroup($this->StartGrp);
		} else {
			if ($Recruited_Employee->getGroupPerPage() <> "") {
				$this->DisplayGrps = $Recruited_Employee->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $Security;
		global $Recruited_Employee;
		if ($Recruited_Employee->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($Recruited_Employee->SqlSelectCount(), $Recruited_Employee->SqlWhere(), $Recruited_Employee->SqlGroupBy(), $Recruited_Employee->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}
		}

		// Call Row_Rendering event
		$Recruited_Employee->Row_Rendering();

		/* --------------------
		'  Render view codes
		' --------------------- */
		if ($Recruited_Employee->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// Department
			$Recruited_Employee->Department->GroupViewValue = $Recruited_Employee->Department->GroupOldValue();
			$Recruited_Employee->Department->CellAttrs["class"] = ($Recruited_Employee->RowGroupLevel == 1) ? "ewRptGrpSummary1" : "ewRptGrpField1";
			$Recruited_Employee->Department->GroupViewValue = ewrpt_DisplayGroupValue($Recruited_Employee->Department, $Recruited_Employee->Department->GroupViewValue);

			// Employee
			$Recruited_Employee->Employee->ViewValue = $Recruited_Employee->Employee->Summary;

			// Place
			$Recruited_Employee->Place->ViewValue = $Recruited_Employee->Place->Summary;

			// ID
			$Recruited_Employee->ID->ViewValue = $Recruited_Employee->ID->Summary;

			// FirstName
			$Recruited_Employee->FirstName->ViewValue = $Recruited_Employee->FirstName->Summary;

			// MiddelName
			$Recruited_Employee->MiddelName->ViewValue = $Recruited_Employee->MiddelName->Summary;

			// LastName
			$Recruited_Employee->LastName->ViewValue = $Recruited_Employee->LastName->Summary;

			// Age
			$Recruited_Employee->Age->ViewValue = $Recruited_Employee->Age->Summary;

			// Sex
			$Recruited_Employee->Sex->ViewValue = $Recruited_Employee->Sex->Summary;

			// Photo
			$Recruited_Employee->Photo->ViewValue = $Recruited_Employee->Photo->Summary;

			// Date
			$Recruited_Employee->Date->ViewValue = $Recruited_Employee->Date->Summary;
			$Recruited_Employee->Date->ViewValue = ewrpt_FormatDateTime($Recruited_Employee->Date->ViewValue, 5);

			// Address
			$Recruited_Employee->Address->ViewValue = $Recruited_Employee->Address->Summary;

			// Position
			$Recruited_Employee->Position->ViewValue = $Recruited_Employee->Position->Summary;

			// Housing_Allowance
			$Recruited_Employee->Housing_Allowance->ViewValue = $Recruited_Employee->Housing_Allowance->Summary;

			// Salary
			$Recruited_Employee->Salary->ViewValue = $Recruited_Employee->Salary->Summary;

			// Transport_Allowance
			$Recruited_Employee->Transport_Allowance->ViewValue = $Recruited_Employee->Transport_Allowance->Summary;

			// Hardship_Allowance
			$Recruited_Employee->Hardship_Allowance->ViewValue = $Recruited_Employee->Hardship_Allowance->Summary;

			// Position_Allowance
			$Recruited_Employee->Position_Allowance->ViewValue = $Recruited_Employee->Position_Allowance->Summary;
		} else {

			// Department
			$Recruited_Employee->Department->GroupViewValue = $Recruited_Employee->Department->GroupValue();
			$Recruited_Employee->Department->CellAttrs["class"] = "ewRptGrpField1";
			$Recruited_Employee->Department->GroupViewValue = ewrpt_DisplayGroupValue($Recruited_Employee->Department, $Recruited_Employee->Department->GroupViewValue);
			if ($Recruited_Employee->Department->GroupValue() == $Recruited_Employee->Department->GroupOldValue() && !$this->ChkLvlBreak(1))
				$Recruited_Employee->Department->GroupViewValue = "&nbsp;";

			// Employee
			$Recruited_Employee->Employee->ViewValue = $Recruited_Employee->Employee->CurrentValue;
			$Recruited_Employee->Employee->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Place
			$Recruited_Employee->Place->ViewValue = $Recruited_Employee->Place->CurrentValue;
			$Recruited_Employee->Place->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// ID
			$Recruited_Employee->ID->ViewValue = $Recruited_Employee->ID->CurrentValue;
			$Recruited_Employee->ID->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// FirstName
			$Recruited_Employee->FirstName->ViewValue = $Recruited_Employee->FirstName->CurrentValue;
			$Recruited_Employee->FirstName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// MiddelName
			$Recruited_Employee->MiddelName->ViewValue = $Recruited_Employee->MiddelName->CurrentValue;
			$Recruited_Employee->MiddelName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// LastName
			$Recruited_Employee->LastName->ViewValue = $Recruited_Employee->LastName->CurrentValue;
			$Recruited_Employee->LastName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Age
			$Recruited_Employee->Age->ViewValue = $Recruited_Employee->Age->CurrentValue;
			$Recruited_Employee->Age->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Sex
			$Recruited_Employee->Sex->ViewValue = $Recruited_Employee->Sex->CurrentValue;
			$Recruited_Employee->Sex->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Photo
			$Recruited_Employee->Photo->ViewValue = $Recruited_Employee->Photo->CurrentValue;
			$Recruited_Employee->Photo->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Date
			$Recruited_Employee->Date->ViewValue = $Recruited_Employee->Date->CurrentValue;
			$Recruited_Employee->Date->ViewValue = ewrpt_FormatDateTime($Recruited_Employee->Date->ViewValue, 5);
			$Recruited_Employee->Date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Address
			$Recruited_Employee->Address->ViewValue = $Recruited_Employee->Address->CurrentValue;
			$Recruited_Employee->Address->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Position
			$Recruited_Employee->Position->ViewValue = $Recruited_Employee->Position->CurrentValue;
			$Recruited_Employee->Position->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Housing_Allowance
			$Recruited_Employee->Housing_Allowance->ViewValue = $Recruited_Employee->Housing_Allowance->CurrentValue;
			$Recruited_Employee->Housing_Allowance->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Salary
			$Recruited_Employee->Salary->ViewValue = $Recruited_Employee->Salary->CurrentValue;
			$Recruited_Employee->Salary->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Transport_Allowance
			$Recruited_Employee->Transport_Allowance->ViewValue = $Recruited_Employee->Transport_Allowance->CurrentValue;
			$Recruited_Employee->Transport_Allowance->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Hardship_Allowance
			$Recruited_Employee->Hardship_Allowance->ViewValue = $Recruited_Employee->Hardship_Allowance->CurrentValue;
			$Recruited_Employee->Hardship_Allowance->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Position_Allowance
			$Recruited_Employee->Position_Allowance->ViewValue = $Recruited_Employee->Position_Allowance->CurrentValue;
			$Recruited_Employee->Position_Allowance->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// Department
		$Recruited_Employee->Department->HrefValue = "";

		// Employee
		$Recruited_Employee->Employee->HrefValue = "";

		// Place
		$Recruited_Employee->Place->HrefValue = "";

		// ID
		$Recruited_Employee->ID->HrefValue = "";

		// FirstName
		$Recruited_Employee->FirstName->HrefValue = "";

		// MiddelName
		$Recruited_Employee->MiddelName->HrefValue = "";

		// LastName
		$Recruited_Employee->LastName->HrefValue = "";

		// Age
		$Recruited_Employee->Age->HrefValue = "";

		// Sex
		$Recruited_Employee->Sex->HrefValue = "";

		// Photo
		$Recruited_Employee->Photo->HrefValue = "";

		// Date
		$Recruited_Employee->Date->HrefValue = "";

		// Address
		$Recruited_Employee->Address->HrefValue = "";

		// Position
		$Recruited_Employee->Position->HrefValue = "";

		// Housing_Allowance
		$Recruited_Employee->Housing_Allowance->HrefValue = "";

		// Salary
		$Recruited_Employee->Salary->HrefValue = "";

		// Transport_Allowance
		$Recruited_Employee->Transport_Allowance->HrefValue = "";

		// Hardship_Allowance
		$Recruited_Employee->Hardship_Allowance->HrefValue = "";

		// Position_Allowance
		$Recruited_Employee->Position_Allowance->HrefValue = "";

		// Call Row_Rendered event
		$Recruited_Employee->Row_Rendered();
	}

	// Get extended filter values
	function GetExtendedFilterValues() {
		global $Recruited_Employee;

		// Field Department
		$sSelect = "SELECT DISTINCT `Department` FROM " . $Recruited_Employee->SqlFrom();
		$sOrderBy = "`Department` ASC";
		$wrkSql = ewrpt_BuildReportSql($sSelect, $Recruited_Employee->SqlWhere(), "", "", $sOrderBy, $this->UserIDFilter, "");
		$Recruited_Employee->Department->DropDownList = ewrpt_GetDistinctValues("", $wrkSql);
	}

	// Return extended filter
	function GetExtendedFilter() {
		global $Recruited_Employee;
		global $gsFormError;
		$sFilter = "";
		$bPostBack = ewrpt_IsHttpPost();
		$bRestoreSession = TRUE;
		$bSetupFilter = FALSE;

		// Reset extended filter if filter changed
		if ($bPostBack) {

			// Clear extended filter for field Employee
			if ($this->ClearExtFilter == 'Recruited_Employee_Employee')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'Employee');

			// Clear extended filter for field Place
			if ($this->ClearExtFilter == 'Recruited_Employee_Place')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'Place');

			// Clear extended filter for field ID
			if ($this->ClearExtFilter == 'Recruited_Employee_ID')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'ID');

			// Clear extended filter for field FirstName
			if ($this->ClearExtFilter == 'Recruited_Employee_FirstName')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'FirstName');

			// Clear extended filter for field MiddelName
			if ($this->ClearExtFilter == 'Recruited_Employee_MiddelName')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'MiddelName');

			// Clear extended filter for field Age
			if ($this->ClearExtFilter == 'Recruited_Employee_Age')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'Age');

			// Clear extended filter for field Sex
			if ($this->ClearExtFilter == 'Recruited_Employee_Sex')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'Sex');

			// Clear extended filter for field Date
			if ($this->ClearExtFilter == 'Recruited_Employee_Date')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'Date');

			// Clear dropdown for field Department
			if ($this->ClearExtFilter == 'Recruited_Employee_Department')
				$this->SetSessionDropDownValue(EWRPT_INIT_VALUE, 'Department');

		// Reset search command
		} elseif (@$_GET["cmd"] == "reset") {

			// Load default values
			// Field Employee

			$this->SetSessionFilterValues($Recruited_Employee->Employee->SearchValue, $Recruited_Employee->Employee->SearchOperator, $Recruited_Employee->Employee->SearchCondition, $Recruited_Employee->Employee->SearchValue2, $Recruited_Employee->Employee->SearchOperator2, 'Employee');

			// Field Place
			$this->SetSessionFilterValues($Recruited_Employee->Place->SearchValue, $Recruited_Employee->Place->SearchOperator, $Recruited_Employee->Place->SearchCondition, $Recruited_Employee->Place->SearchValue2, $Recruited_Employee->Place->SearchOperator2, 'Place');

			// Field ID
			$this->SetSessionFilterValues($Recruited_Employee->ID->SearchValue, $Recruited_Employee->ID->SearchOperator, $Recruited_Employee->ID->SearchCondition, $Recruited_Employee->ID->SearchValue2, $Recruited_Employee->ID->SearchOperator2, 'ID');

			// Field FirstName
			$this->SetSessionFilterValues($Recruited_Employee->FirstName->SearchValue, $Recruited_Employee->FirstName->SearchOperator, $Recruited_Employee->FirstName->SearchCondition, $Recruited_Employee->FirstName->SearchValue2, $Recruited_Employee->FirstName->SearchOperator2, 'FirstName');

			// Field MiddelName
			$this->SetSessionFilterValues($Recruited_Employee->MiddelName->SearchValue, $Recruited_Employee->MiddelName->SearchOperator, $Recruited_Employee->MiddelName->SearchCondition, $Recruited_Employee->MiddelName->SearchValue2, $Recruited_Employee->MiddelName->SearchOperator2, 'MiddelName');

			// Field Age
			$this->SetSessionFilterValues($Recruited_Employee->Age->SearchValue, $Recruited_Employee->Age->SearchOperator, $Recruited_Employee->Age->SearchCondition, $Recruited_Employee->Age->SearchValue2, $Recruited_Employee->Age->SearchOperator2, 'Age');

			// Field Sex
			$this->SetSessionFilterValues($Recruited_Employee->Sex->SearchValue, $Recruited_Employee->Sex->SearchOperator, $Recruited_Employee->Sex->SearchCondition, $Recruited_Employee->Sex->SearchValue2, $Recruited_Employee->Sex->SearchOperator2, 'Sex');

			// Field Date
			$this->SetSessionFilterValues($Recruited_Employee->Date->SearchValue, $Recruited_Employee->Date->SearchOperator, $Recruited_Employee->Date->SearchCondition, $Recruited_Employee->Date->SearchValue2, $Recruited_Employee->Date->SearchOperator2, 'Date');

			// Field Department
			$this->SetSessionDropDownValue($Recruited_Employee->Department->DropDownValue, 'Department');
			$bSetupFilter = TRUE;
		} else {

			// Field Employee
			if ($this->GetFilterValues($Recruited_Employee->Employee)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field Place
			if ($this->GetFilterValues($Recruited_Employee->Place)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field ID
			if ($this->GetFilterValues($Recruited_Employee->ID)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field FirstName
			if ($this->GetFilterValues($Recruited_Employee->FirstName)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field MiddelName
			if ($this->GetFilterValues($Recruited_Employee->MiddelName)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field Age
			if ($this->GetFilterValues($Recruited_Employee->Age)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field Sex
			if ($this->GetFilterValues($Recruited_Employee->Sex)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field Date
			if ($this->GetFilterValues($Recruited_Employee->Date)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field Department
			if ($this->GetDropDownValue($Recruited_Employee->Department->DropDownValue, 'Department')) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			} elseif ($Recruited_Employee->Department->DropDownValue <> EWRPT_INIT_VALUE && !isset($_SESSION['sv_Recruited_Employee->Department'])) {
				$bSetupFilter = TRUE;
			}
			if (!$this->ValidateForm()) {
				$this->setMessage($gsFormError);
				return $sFilter;
			}
		}

		// Restore session
		if ($bRestoreSession) {

			// Field Employee
			$this->GetSessionFilterValues($Recruited_Employee->Employee);

			// Field Place
			$this->GetSessionFilterValues($Recruited_Employee->Place);

			// Field ID
			$this->GetSessionFilterValues($Recruited_Employee->ID);

			// Field FirstName
			$this->GetSessionFilterValues($Recruited_Employee->FirstName);

			// Field MiddelName
			$this->GetSessionFilterValues($Recruited_Employee->MiddelName);

			// Field Age
			$this->GetSessionFilterValues($Recruited_Employee->Age);

			// Field Sex
			$this->GetSessionFilterValues($Recruited_Employee->Sex);

			// Field Date
			$this->GetSessionFilterValues($Recruited_Employee->Date);

			// Field Department
			$this->GetSessionDropDownValue($Recruited_Employee->Department);
		}

		// Call page filter validated event
		$Recruited_Employee->Page_FilterValidated();

		// Build SQL
		// Field Employee

		$this->BuildExtendedFilter($Recruited_Employee->Employee, $sFilter);

		// Field Place
		$this->BuildExtendedFilter($Recruited_Employee->Place, $sFilter);

		// Field ID
		$this->BuildExtendedFilter($Recruited_Employee->ID, $sFilter);

		// Field FirstName
		$this->BuildExtendedFilter($Recruited_Employee->FirstName, $sFilter);

		// Field MiddelName
		$this->BuildExtendedFilter($Recruited_Employee->MiddelName, $sFilter);

		// Field Age
		$this->BuildExtendedFilter($Recruited_Employee->Age, $sFilter);

		// Field Sex
		$this->BuildExtendedFilter($Recruited_Employee->Sex, $sFilter);

		// Field Date
		$this->BuildExtendedFilter($Recruited_Employee->Date, $sFilter);

		// Field Department
		$this->BuildDropDownFilter($Recruited_Employee->Department, $sFilter, "");

		// Save parms to session
		// Field Employee

		$this->SetSessionFilterValues($Recruited_Employee->Employee->SearchValue, $Recruited_Employee->Employee->SearchOperator, $Recruited_Employee->Employee->SearchCondition, $Recruited_Employee->Employee->SearchValue2, $Recruited_Employee->Employee->SearchOperator2, 'Employee');

		// Field Place
		$this->SetSessionFilterValues($Recruited_Employee->Place->SearchValue, $Recruited_Employee->Place->SearchOperator, $Recruited_Employee->Place->SearchCondition, $Recruited_Employee->Place->SearchValue2, $Recruited_Employee->Place->SearchOperator2, 'Place');

		// Field ID
		$this->SetSessionFilterValues($Recruited_Employee->ID->SearchValue, $Recruited_Employee->ID->SearchOperator, $Recruited_Employee->ID->SearchCondition, $Recruited_Employee->ID->SearchValue2, $Recruited_Employee->ID->SearchOperator2, 'ID');

		// Field FirstName
		$this->SetSessionFilterValues($Recruited_Employee->FirstName->SearchValue, $Recruited_Employee->FirstName->SearchOperator, $Recruited_Employee->FirstName->SearchCondition, $Recruited_Employee->FirstName->SearchValue2, $Recruited_Employee->FirstName->SearchOperator2, 'FirstName');

		// Field MiddelName
		$this->SetSessionFilterValues($Recruited_Employee->MiddelName->SearchValue, $Recruited_Employee->MiddelName->SearchOperator, $Recruited_Employee->MiddelName->SearchCondition, $Recruited_Employee->MiddelName->SearchValue2, $Recruited_Employee->MiddelName->SearchOperator2, 'MiddelName');

		// Field Age
		$this->SetSessionFilterValues($Recruited_Employee->Age->SearchValue, $Recruited_Employee->Age->SearchOperator, $Recruited_Employee->Age->SearchCondition, $Recruited_Employee->Age->SearchValue2, $Recruited_Employee->Age->SearchOperator2, 'Age');

		// Field Sex
		$this->SetSessionFilterValues($Recruited_Employee->Sex->SearchValue, $Recruited_Employee->Sex->SearchOperator, $Recruited_Employee->Sex->SearchCondition, $Recruited_Employee->Sex->SearchValue2, $Recruited_Employee->Sex->SearchOperator2, 'Sex');

		// Field Date
		$this->SetSessionFilterValues($Recruited_Employee->Date->SearchValue, $Recruited_Employee->Date->SearchOperator, $Recruited_Employee->Date->SearchCondition, $Recruited_Employee->Date->SearchValue2, $Recruited_Employee->Date->SearchOperator2, 'Date');

		// Field Department
		$this->SetSessionDropDownValue($Recruited_Employee->Department->DropDownValue, 'Department');

		// Setup filter
		if ($bSetupFilter) {

			// Field Employee
			$sWrk = "";
			$this->BuildExtendedFilter($Recruited_Employee->Employee, $sWrk);
			$this->LoadSelectionFromFilter($Recruited_Employee->Employee, $sWrk, $Recruited_Employee->Employee->SelectionList);
			$_SESSION['sel_Recruited_Employee_Employee'] = ($Recruited_Employee->Employee->SelectionList == "") ? EWRPT_INIT_VALUE : $Recruited_Employee->Employee->SelectionList;

			// Field Place
			$sWrk = "";
			$this->BuildExtendedFilter($Recruited_Employee->Place, $sWrk);
			$this->LoadSelectionFromFilter($Recruited_Employee->Place, $sWrk, $Recruited_Employee->Place->SelectionList);
			$_SESSION['sel_Recruited_Employee_Place'] = ($Recruited_Employee->Place->SelectionList == "") ? EWRPT_INIT_VALUE : $Recruited_Employee->Place->SelectionList;

			// Field ID
			$sWrk = "";
			$this->BuildExtendedFilter($Recruited_Employee->ID, $sWrk);
			$this->LoadSelectionFromFilter($Recruited_Employee->ID, $sWrk, $Recruited_Employee->ID->SelectionList);
			$_SESSION['sel_Recruited_Employee_ID'] = ($Recruited_Employee->ID->SelectionList == "") ? EWRPT_INIT_VALUE : $Recruited_Employee->ID->SelectionList;

			// Field FirstName
			$sWrk = "";
			$this->BuildExtendedFilter($Recruited_Employee->FirstName, $sWrk);
			$this->LoadSelectionFromFilter($Recruited_Employee->FirstName, $sWrk, $Recruited_Employee->FirstName->SelectionList);
			$_SESSION['sel_Recruited_Employee_FirstName'] = ($Recruited_Employee->FirstName->SelectionList == "") ? EWRPT_INIT_VALUE : $Recruited_Employee->FirstName->SelectionList;

			// Field MiddelName
			$sWrk = "";
			$this->BuildExtendedFilter($Recruited_Employee->MiddelName, $sWrk);
			$this->LoadSelectionFromFilter($Recruited_Employee->MiddelName, $sWrk, $Recruited_Employee->MiddelName->SelectionList);
			$_SESSION['sel_Recruited_Employee_MiddelName'] = ($Recruited_Employee->MiddelName->SelectionList == "") ? EWRPT_INIT_VALUE : $Recruited_Employee->MiddelName->SelectionList;

			// Field Age
			$sWrk = "";
			$this->BuildExtendedFilter($Recruited_Employee->Age, $sWrk);
			$this->LoadSelectionFromFilter($Recruited_Employee->Age, $sWrk, $Recruited_Employee->Age->SelectionList);
			$_SESSION['sel_Recruited_Employee_Age'] = ($Recruited_Employee->Age->SelectionList == "") ? EWRPT_INIT_VALUE : $Recruited_Employee->Age->SelectionList;

			// Field Sex
			$sWrk = "";
			$this->BuildExtendedFilter($Recruited_Employee->Sex, $sWrk);
			$this->LoadSelectionFromFilter($Recruited_Employee->Sex, $sWrk, $Recruited_Employee->Sex->SelectionList);
			$_SESSION['sel_Recruited_Employee_Sex'] = ($Recruited_Employee->Sex->SelectionList == "") ? EWRPT_INIT_VALUE : $Recruited_Employee->Sex->SelectionList;

			// Field Date
			$sWrk = "";
			$this->BuildExtendedFilter($Recruited_Employee->Date, $sWrk);
			$this->LoadSelectionFromFilter($Recruited_Employee->Date, $sWrk, $Recruited_Employee->Date->SelectionList);
			$_SESSION['sel_Recruited_Employee_Date'] = ($Recruited_Employee->Date->SelectionList == "") ? EWRPT_INIT_VALUE : $Recruited_Employee->Date->SelectionList;

			// Field Department
			$sWrk = "";
			$this->BuildDropDownFilter($Recruited_Employee->Department, $sWrk, "");
			$this->LoadSelectionFromFilter($Recruited_Employee->Department, $sWrk, $Recruited_Employee->Department->SelectionList);
			$_SESSION['sel_Recruited_Employee_Department'] = ($Recruited_Employee->Department->SelectionList == "") ? EWRPT_INIT_VALUE : $Recruited_Employee->Department->SelectionList;
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
		$this->GetSessionValue($fld->DropDownValue, 'sv_Recruited_Employee_' . $parm);
	}

	// Get filter values from session
	function GetSessionFilterValues(&$fld) {
		$parm = substr($fld->FldVar, 2);
		$this->GetSessionValue($fld->SearchValue, 'sv1_Recruited_Employee_' . $parm);
		$this->GetSessionValue($fld->SearchOperator, 'so1_Recruited_Employee_' . $parm);
		$this->GetSessionValue($fld->SearchCondition, 'sc_Recruited_Employee_' . $parm);
		$this->GetSessionValue($fld->SearchValue2, 'sv2_Recruited_Employee_' . $parm);
		$this->GetSessionValue($fld->SearchOperator2, 'so2_Recruited_Employee_' . $parm);
	}

	// Get value from session
	function GetSessionValue(&$sv, $sn) {
		if (isset($_SESSION[$sn]))
			$sv = $_SESSION[$sn];
	}

	// Set dropdown value to session
	function SetSessionDropDownValue($sv, $parm) {
		$_SESSION['sv_Recruited_Employee_' . $parm] = $sv;
	}

	// Set filter values to session
	function SetSessionFilterValues($sv1, $so1, $sc, $sv2, $so2, $parm) {
		$_SESSION['sv1_Recruited_Employee_' . $parm] = $sv1;
		$_SESSION['so1_Recruited_Employee_' . $parm] = $so1;
		$_SESSION['sc_Recruited_Employee_' . $parm] = $sc;
		$_SESSION['sv2_Recruited_Employee_' . $parm] = $sv2;
		$_SESSION['so2_Recruited_Employee_' . $parm] = $so2;
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
		global $ReportLanguage, $gsFormError, $Recruited_Employee;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EWRPT_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ewrpt_CheckInteger($Recruited_Employee->Age->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Recruited_Employee->Age->FldErrMsg();
		}
		if (!ewrpt_CheckDate($Recruited_Employee->Date->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Recruited_Employee->Date->FldErrMsg();
		}
		if (!ewrpt_CheckDate($Recruited_Employee->Date->SearchValue2)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Recruited_Employee->Date->FldErrMsg();
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
		$_SESSION["sel_Recruited_Employee_$parm"] = "";
		$_SESSION["rf_Recruited_Employee_$parm"] = "";
		$_SESSION["rt_Recruited_Employee_$parm"] = "";
	}

	// Load selection from session
	function LoadSelectionFromSession($parm) {
		global $Recruited_Employee;
		$fld =& $Recruited_Employee->fields($parm);
		$fld->SelectionList = @$_SESSION["sel_Recruited_Employee_$parm"];
		$fld->RangeFrom = @$_SESSION["rf_Recruited_Employee_$parm"];
		$fld->RangeTo = @$_SESSION["rt_Recruited_Employee_$parm"];
	}

	// Load default value for filters
	function LoadDefaultFilters() {
		global $Recruited_Employee;

		/**
		* Set up default values for non Text filters
		*/

		// Field Department
		$Recruited_Employee->Department->DefaultDropDownValue = EWRPT_INIT_VALUE;
		$Recruited_Employee->Department->DropDownValue = $Recruited_Employee->Department->DefaultDropDownValue;
		$sWrk = "";
		$this->BuildDropDownFilter($Recruited_Employee->Department, $sWrk, "");
		$this->LoadSelectionFromFilter($Recruited_Employee->Department, $sWrk, $Recruited_Employee->Department->DefaultSelectionList);

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

		// Field Employee
		$this->SetDefaultExtFilter($Recruited_Employee->Employee, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Recruited_Employee->Employee);
		$sWrk = "";
		$this->BuildExtendedFilter($Recruited_Employee->Employee, $sWrk);
		$this->LoadSelectionFromFilter($Recruited_Employee->Employee, $sWrk, $Recruited_Employee->Employee->DefaultSelectionList);
		$Recruited_Employee->Employee->SelectionList = $Recruited_Employee->Employee->DefaultSelectionList;

		// Field Place
		$this->SetDefaultExtFilter($Recruited_Employee->Place, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Recruited_Employee->Place);
		$sWrk = "";
		$this->BuildExtendedFilter($Recruited_Employee->Place, $sWrk);
		$this->LoadSelectionFromFilter($Recruited_Employee->Place, $sWrk, $Recruited_Employee->Place->DefaultSelectionList);
		$Recruited_Employee->Place->SelectionList = $Recruited_Employee->Place->DefaultSelectionList;

		// Field ID
		$this->SetDefaultExtFilter($Recruited_Employee->ID, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Recruited_Employee->ID);
		$sWrk = "";
		$this->BuildExtendedFilter($Recruited_Employee->ID, $sWrk);
		$this->LoadSelectionFromFilter($Recruited_Employee->ID, $sWrk, $Recruited_Employee->ID->DefaultSelectionList);
		$Recruited_Employee->ID->SelectionList = $Recruited_Employee->ID->DefaultSelectionList;

		// Field FirstName
		$this->SetDefaultExtFilter($Recruited_Employee->FirstName, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Recruited_Employee->FirstName);
		$sWrk = "";
		$this->BuildExtendedFilter($Recruited_Employee->FirstName, $sWrk);
		$this->LoadSelectionFromFilter($Recruited_Employee->FirstName, $sWrk, $Recruited_Employee->FirstName->DefaultSelectionList);
		$Recruited_Employee->FirstName->SelectionList = $Recruited_Employee->FirstName->DefaultSelectionList;

		// Field MiddelName
		$this->SetDefaultExtFilter($Recruited_Employee->MiddelName, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Recruited_Employee->MiddelName);
		$sWrk = "";
		$this->BuildExtendedFilter($Recruited_Employee->MiddelName, $sWrk);
		$this->LoadSelectionFromFilter($Recruited_Employee->MiddelName, $sWrk, $Recruited_Employee->MiddelName->DefaultSelectionList);
		$Recruited_Employee->MiddelName->SelectionList = $Recruited_Employee->MiddelName->DefaultSelectionList;

		// Field Age
		$this->SetDefaultExtFilter($Recruited_Employee->Age, "=", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Recruited_Employee->Age);
		$sWrk = "";
		$this->BuildExtendedFilter($Recruited_Employee->Age, $sWrk);
		$this->LoadSelectionFromFilter($Recruited_Employee->Age, $sWrk, $Recruited_Employee->Age->DefaultSelectionList);
		$Recruited_Employee->Age->SelectionList = $Recruited_Employee->Age->DefaultSelectionList;

		// Field Sex
		$this->SetDefaultExtFilter($Recruited_Employee->Sex, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Recruited_Employee->Sex);
		$sWrk = "";
		$this->BuildExtendedFilter($Recruited_Employee->Sex, $sWrk);
		$this->LoadSelectionFromFilter($Recruited_Employee->Sex, $sWrk, $Recruited_Employee->Sex->DefaultSelectionList);
		$Recruited_Employee->Sex->SelectionList = $Recruited_Employee->Sex->DefaultSelectionList;

		// Field Date
		$this->SetDefaultExtFilter($Recruited_Employee->Date, "BETWEEN", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Recruited_Employee->Date);
		$sWrk = "";
		$this->BuildExtendedFilter($Recruited_Employee->Date, $sWrk);
		$this->LoadSelectionFromFilter($Recruited_Employee->Date, $sWrk, $Recruited_Employee->Date->DefaultSelectionList);
		$Recruited_Employee->Date->SelectionList = $Recruited_Employee->Date->DefaultSelectionList;

		/**
		* Set up default values for popup filters
		* NOTE: if extended filter is enabled, use default values in extended filter instead
		*/

		// Field LastName
		// Setup your default values for the popup filter below, e.g.
		// $Recruited_Employee->LastName->DefaultSelectionList = array("val1", "val2");

		$Recruited_Employee->LastName->DefaultSelectionList = "";
		$Recruited_Employee->LastName->SelectionList = $Recruited_Employee->LastName->DefaultSelectionList;

		// Field Photo
		// Setup your default values for the popup filter below, e.g.
		// $Recruited_Employee->Photo->DefaultSelectionList = array("val1", "val2");

		$Recruited_Employee->Photo->DefaultSelectionList = "";
		$Recruited_Employee->Photo->SelectionList = $Recruited_Employee->Photo->DefaultSelectionList;

		// Field Address
		// Setup your default values for the popup filter below, e.g.
		// $Recruited_Employee->Address->DefaultSelectionList = array("val1", "val2");

		$Recruited_Employee->Address->DefaultSelectionList = "";
		$Recruited_Employee->Address->SelectionList = $Recruited_Employee->Address->DefaultSelectionList;

		// Field Position
		// Setup your default values for the popup filter below, e.g.
		// $Recruited_Employee->Position->DefaultSelectionList = array("val1", "val2");

		$Recruited_Employee->Position->DefaultSelectionList = "";
		$Recruited_Employee->Position->SelectionList = $Recruited_Employee->Position->DefaultSelectionList;
	}

	// Check if filter applied
	function CheckFilter() {
		global $Recruited_Employee;

		// Check Employee text filter
		if ($this->TextFilterApplied($Recruited_Employee->Employee))
			return TRUE;

		// Check Employee popup filter
		if (!ewrpt_MatchedArray($Recruited_Employee->Employee->DefaultSelectionList, $Recruited_Employee->Employee->SelectionList))
			return TRUE;

		// Check Place text filter
		if ($this->TextFilterApplied($Recruited_Employee->Place))
			return TRUE;

		// Check Place popup filter
		if (!ewrpt_MatchedArray($Recruited_Employee->Place->DefaultSelectionList, $Recruited_Employee->Place->SelectionList))
			return TRUE;

		// Check ID text filter
		if ($this->TextFilterApplied($Recruited_Employee->ID))
			return TRUE;

		// Check ID popup filter
		if (!ewrpt_MatchedArray($Recruited_Employee->ID->DefaultSelectionList, $Recruited_Employee->ID->SelectionList))
			return TRUE;

		// Check FirstName text filter
		if ($this->TextFilterApplied($Recruited_Employee->FirstName))
			return TRUE;

		// Check FirstName popup filter
		if (!ewrpt_MatchedArray($Recruited_Employee->FirstName->DefaultSelectionList, $Recruited_Employee->FirstName->SelectionList))
			return TRUE;

		// Check MiddelName text filter
		if ($this->TextFilterApplied($Recruited_Employee->MiddelName))
			return TRUE;

		// Check MiddelName popup filter
		if (!ewrpt_MatchedArray($Recruited_Employee->MiddelName->DefaultSelectionList, $Recruited_Employee->MiddelName->SelectionList))
			return TRUE;

		// Check LastName popup filter
		if (!ewrpt_MatchedArray($Recruited_Employee->LastName->DefaultSelectionList, $Recruited_Employee->LastName->SelectionList))
			return TRUE;

		// Check Age text filter
		if ($this->TextFilterApplied($Recruited_Employee->Age))
			return TRUE;

		// Check Age popup filter
		if (!ewrpt_MatchedArray($Recruited_Employee->Age->DefaultSelectionList, $Recruited_Employee->Age->SelectionList))
			return TRUE;

		// Check Sex text filter
		if ($this->TextFilterApplied($Recruited_Employee->Sex))
			return TRUE;

		// Check Sex popup filter
		if (!ewrpt_MatchedArray($Recruited_Employee->Sex->DefaultSelectionList, $Recruited_Employee->Sex->SelectionList))
			return TRUE;

		// Check Photo popup filter
		if (!ewrpt_MatchedArray($Recruited_Employee->Photo->DefaultSelectionList, $Recruited_Employee->Photo->SelectionList))
			return TRUE;

		// Check Date text filter
		if ($this->TextFilterApplied($Recruited_Employee->Date))
			return TRUE;

		// Check Date popup filter
		if (!ewrpt_MatchedArray($Recruited_Employee->Date->DefaultSelectionList, $Recruited_Employee->Date->SelectionList))
			return TRUE;

		// Check Address popup filter
		if (!ewrpt_MatchedArray($Recruited_Employee->Address->DefaultSelectionList, $Recruited_Employee->Address->SelectionList))
			return TRUE;

		// Check Department extended filter
		if ($this->NonTextFilterApplied($Recruited_Employee->Department))
			return TRUE;

		// Check Department popup filter
		if (!ewrpt_MatchedArray($Recruited_Employee->Department->DefaultSelectionList, $Recruited_Employee->Department->SelectionList))
			return TRUE;

		// Check Position popup filter
		if (!ewrpt_MatchedArray($Recruited_Employee->Position->DefaultSelectionList, $Recruited_Employee->Position->SelectionList))
			return TRUE;
		return FALSE;
	}

	// Show list of filters
	function ShowFilterList() {
		global $Recruited_Employee;
		global $ReportLanguage;

		// Initialize
		$sFilterList = "";

		// Field Employee
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Recruited_Employee->Employee, $sExtWrk);
		if (is_array($Recruited_Employee->Employee->SelectionList))
			$sWrk = ewrpt_JoinArray($Recruited_Employee->Employee->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Recruited_Employee->Employee->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Place
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Recruited_Employee->Place, $sExtWrk);
		if (is_array($Recruited_Employee->Place->SelectionList))
			$sWrk = ewrpt_JoinArray($Recruited_Employee->Place->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Recruited_Employee->Place->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field ID
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Recruited_Employee->ID, $sExtWrk);
		if (is_array($Recruited_Employee->ID->SelectionList))
			$sWrk = ewrpt_JoinArray($Recruited_Employee->ID->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Recruited_Employee->ID->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field FirstName
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Recruited_Employee->FirstName, $sExtWrk);
		if (is_array($Recruited_Employee->FirstName->SelectionList))
			$sWrk = ewrpt_JoinArray($Recruited_Employee->FirstName->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Recruited_Employee->FirstName->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field MiddelName
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Recruited_Employee->MiddelName, $sExtWrk);
		if (is_array($Recruited_Employee->MiddelName->SelectionList))
			$sWrk = ewrpt_JoinArray($Recruited_Employee->MiddelName->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Recruited_Employee->MiddelName->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field LastName
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($Recruited_Employee->LastName->SelectionList))
			$sWrk = ewrpt_JoinArray($Recruited_Employee->LastName->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Recruited_Employee->LastName->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Age
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Recruited_Employee->Age, $sExtWrk);
		if (is_array($Recruited_Employee->Age->SelectionList))
			$sWrk = ewrpt_JoinArray($Recruited_Employee->Age->SelectionList, ", ", EWRPT_DATATYPE_NUMBER);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Recruited_Employee->Age->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Sex
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Recruited_Employee->Sex, $sExtWrk);
		if (is_array($Recruited_Employee->Sex->SelectionList))
			$sWrk = ewrpt_JoinArray($Recruited_Employee->Sex->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Recruited_Employee->Sex->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Photo
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($Recruited_Employee->Photo->SelectionList))
			$sWrk = ewrpt_JoinArray($Recruited_Employee->Photo->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Recruited_Employee->Photo->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Date
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Recruited_Employee->Date, $sExtWrk);
		if (is_array($Recruited_Employee->Date->SelectionList))
			$sWrk = ewrpt_JoinArray($Recruited_Employee->Date->SelectionList, ", ", EWRPT_DATATYPE_DATE);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Recruited_Employee->Date->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Address
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($Recruited_Employee->Address->SelectionList))
			$sWrk = ewrpt_JoinArray($Recruited_Employee->Address->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Recruited_Employee->Address->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Department
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildDropDownFilter($Recruited_Employee->Department, $sExtWrk, "");
		if (is_array($Recruited_Employee->Department->SelectionList))
			$sWrk = ewrpt_JoinArray($Recruited_Employee->Department->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Recruited_Employee->Department->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Position
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($Recruited_Employee->Position->SelectionList))
			$sWrk = ewrpt_JoinArray($Recruited_Employee->Position->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Recruited_Employee->Position->FldCaption() . "<br />";
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
		global $Recruited_Employee;
		$sWrk = "";
		if (!$this->ExtendedFilterExist($Recruited_Employee->Employee)) {
			if (is_array($Recruited_Employee->Employee->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Recruited_Employee->Employee, "`Employee`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Recruited_Employee->Place)) {
			if (is_array($Recruited_Employee->Place->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Recruited_Employee->Place, "`Place`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Recruited_Employee->ID)) {
			if (is_array($Recruited_Employee->ID->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Recruited_Employee->ID, "`ID`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Recruited_Employee->FirstName)) {
			if (is_array($Recruited_Employee->FirstName->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Recruited_Employee->FirstName, "`FirstName`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Recruited_Employee->MiddelName)) {
			if (is_array($Recruited_Employee->MiddelName->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Recruited_Employee->MiddelName, "`MiddelName`", EWRPT_DATATYPE_STRING);
			}
		}
			if (is_array($Recruited_Employee->LastName->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Recruited_Employee->LastName, "`LastName`", EWRPT_DATATYPE_STRING);
			}
		if (!$this->ExtendedFilterExist($Recruited_Employee->Age)) {
			if (is_array($Recruited_Employee->Age->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Recruited_Employee->Age, "`Age`", EWRPT_DATATYPE_NUMBER);
			}
		}
		if (!$this->ExtendedFilterExist($Recruited_Employee->Sex)) {
			if (is_array($Recruited_Employee->Sex->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Recruited_Employee->Sex, "`Sex`", EWRPT_DATATYPE_STRING);
			}
		}
			if (is_array($Recruited_Employee->Photo->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Recruited_Employee->Photo, "`Photo`", EWRPT_DATATYPE_STRING);
			}
		if (!$this->ExtendedFilterExist($Recruited_Employee->Date)) {
			if (is_array($Recruited_Employee->Date->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Recruited_Employee->Date, "`Date`", EWRPT_DATATYPE_DATE);
			}
		}
			if (is_array($Recruited_Employee->Address->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Recruited_Employee->Address, "`Address`", EWRPT_DATATYPE_STRING);
			}
		if (!$this->DropDownFilterExist($Recruited_Employee->Department, "")) {
			if (is_array($Recruited_Employee->Department->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Recruited_Employee->Department, "`Department`", EWRPT_DATATYPE_STRING);
			}
		}
			if (is_array($Recruited_Employee->Position->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Recruited_Employee->Position, "`Position`", EWRPT_DATATYPE_STRING);
			}
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $Recruited_Employee;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$Recruited_Employee->setOrderBy("");
				$Recruited_Employee->setStartGroup(1);
				$Recruited_Employee->Department->setSort("");
				$Recruited_Employee->Employee->setSort("");
				$Recruited_Employee->Place->setSort("");
				$Recruited_Employee->ID->setSort("");
				$Recruited_Employee->FirstName->setSort("");
				$Recruited_Employee->MiddelName->setSort("");
				$Recruited_Employee->LastName->setSort("");
				$Recruited_Employee->Age->setSort("");
				$Recruited_Employee->Sex->setSort("");
				$Recruited_Employee->Photo->setSort("");
				$Recruited_Employee->Date->setSort("");
				$Recruited_Employee->Address->setSort("");
				$Recruited_Employee->Position->setSort("");
				$Recruited_Employee->Housing_Allowance->setSort("");
				$Recruited_Employee->Salary->setSort("");
				$Recruited_Employee->Transport_Allowance->setSort("");
				$Recruited_Employee->Hardship_Allowance->setSort("");
				$Recruited_Employee->Position_Allowance->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$Recruited_Employee->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$Recruited_Employee->CurrentOrderType = @$_GET["ordertype"];
			$sSortSql = $Recruited_Employee->SortSql();
			$Recruited_Employee->setOrderBy($sSortSql);
			$Recruited_Employee->setStartGroup(1);
		}

		// Set up default sort
		if ($Recruited_Employee->getOrderBy() == "") {
			$Recruited_Employee->setOrderBy("`ID` ASC");
			$Recruited_Employee->ID->setSort("ASC");
		}
		return $Recruited_Employee->getOrderBy();
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
