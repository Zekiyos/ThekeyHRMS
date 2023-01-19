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
$Recruitment_Per_Department = NULL;

//
// Table class for Recruitment Per Department
//
class crRecruitment_Per_Department {
	var $TableVar = 'Recruitment_Per_Department';
	var $TableName = 'Recruitment Per Department';
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
	var $Department_Name;
	var $Recruited;
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
	function crRecruitment_Per_Department() {
		global $ReportLanguage;

		// Auto_ID
		$this->Auto_ID = new crField('Recruitment_Per_Department', 'Recruitment Per Department', 'x_Auto_ID', 'Auto_ID', '`Auto_ID`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->Auto_ID->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['Auto_ID'] =& $this->Auto_ID;
		$this->Auto_ID->DateFilter = "";
		$this->Auto_ID->SqlSelect = "";
		$this->Auto_ID->SqlOrderBy = "";
		$this->Auto_ID->FldGroupByType = "";
		$this->Auto_ID->FldGroupInt = "0";
		$this->Auto_ID->FldGroupSql = "";

		// Employee
		$this->Employee = new crField('Recruitment_Per_Department', 'Recruitment Per Department', 'x_Employee', 'Employee', '`Employee`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Employee'] =& $this->Employee;
		$this->Employee->DateFilter = "";
		$this->Employee->SqlSelect = "";
		$this->Employee->SqlOrderBy = "";
		$this->Employee->FldGroupByType = "";
		$this->Employee->FldGroupInt = "0";
		$this->Employee->FldGroupSql = "";

		// Place
		$this->Place = new crField('Recruitment_Per_Department', 'Recruitment Per Department', 'x_Place', 'Place', '`Place`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Place'] =& $this->Place;
		$this->Place->DateFilter = "";
		$this->Place->SqlSelect = "";
		$this->Place->SqlOrderBy = "";
		$this->Place->FldGroupByType = "";
		$this->Place->FldGroupInt = "0";
		$this->Place->FldGroupSql = "";

		// ID
		$this->ID = new crField('Recruitment_Per_Department', 'Recruitment Per Department', 'x_ID', 'ID', '`ID`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['ID'] =& $this->ID;
		$this->ID->DateFilter = "";
		$this->ID->SqlSelect = "";
		$this->ID->SqlOrderBy = "";
		$this->ID->FldGroupByType = "";
		$this->ID->FldGroupInt = "0";
		$this->ID->FldGroupSql = "";

		// FirstName
		$this->FirstName = new crField('Recruitment_Per_Department', 'Recruitment Per Department', 'x_FirstName', 'FirstName', '`FirstName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['FirstName'] =& $this->FirstName;
		$this->FirstName->DateFilter = "";
		$this->FirstName->SqlSelect = "";
		$this->FirstName->SqlOrderBy = "";
		$this->FirstName->FldGroupByType = "";
		$this->FirstName->FldGroupInt = "0";
		$this->FirstName->FldGroupSql = "";

		// MiddelName
		$this->MiddelName = new crField('Recruitment_Per_Department', 'Recruitment Per Department', 'x_MiddelName', 'MiddelName', '`MiddelName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['MiddelName'] =& $this->MiddelName;
		$this->MiddelName->DateFilter = "";
		$this->MiddelName->SqlSelect = "";
		$this->MiddelName->SqlOrderBy = "";
		$this->MiddelName->FldGroupByType = "";
		$this->MiddelName->FldGroupInt = "0";
		$this->MiddelName->FldGroupSql = "";

		// LastName
		$this->LastName = new crField('Recruitment_Per_Department', 'Recruitment Per Department', 'x_LastName', 'LastName', '`LastName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['LastName'] =& $this->LastName;
		$this->LastName->DateFilter = "";
		$this->LastName->SqlSelect = "";
		$this->LastName->SqlOrderBy = "";
		$this->LastName->FldGroupByType = "";
		$this->LastName->FldGroupInt = "0";
		$this->LastName->FldGroupSql = "";

		// Age
		$this->Age = new crField('Recruitment_Per_Department', 'Recruitment Per Department', 'x_Age', 'Age', '`Age`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->Age->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['Age'] =& $this->Age;
		$this->Age->DateFilter = "";
		$this->Age->SqlSelect = "";
		$this->Age->SqlOrderBy = "";
		$this->Age->FldGroupByType = "";
		$this->Age->FldGroupInt = "0";
		$this->Age->FldGroupSql = "";

		// Sex
		$this->Sex = new crField('Recruitment_Per_Department', 'Recruitment Per Department', 'x_Sex', 'Sex', '`Sex`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Sex'] =& $this->Sex;
		$this->Sex->DateFilter = "";
		$this->Sex->SqlSelect = "";
		$this->Sex->SqlOrderBy = "";
		$this->Sex->FldGroupByType = "";
		$this->Sex->FldGroupInt = "0";
		$this->Sex->FldGroupSql = "";

		// Photo
		$this->Photo = new crField('Recruitment_Per_Department', 'Recruitment Per Department', 'x_Photo', 'Photo', '`Photo`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Photo'] =& $this->Photo;
		$this->Photo->DateFilter = "";
		$this->Photo->SqlSelect = "";
		$this->Photo->SqlOrderBy = "";
		$this->Photo->FldGroupByType = "";
		$this->Photo->FldGroupInt = "0";
		$this->Photo->FldGroupSql = "";

		// Date
		$this->Date = new crField('Recruitment_Per_Department', 'Recruitment Per Department', 'x_Date', 'Date', '`Date`', 133, EWRPT_DATATYPE_DATE, 5);
		$this->Date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateYMD"));
		$this->fields['Date'] =& $this->Date;
		$this->Date->DateFilter = "";
		$this->Date->SqlSelect = "";
		$this->Date->SqlOrderBy = "";
		$this->Date->FldGroupByType = "";
		$this->Date->FldGroupInt = "0";
		$this->Date->FldGroupSql = "";

		// Address
		$this->Address = new crField('Recruitment_Per_Department', 'Recruitment Per Department', 'x_Address', 'Address', '`Address`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Address'] =& $this->Address;
		$this->Address->DateFilter = "";
		$this->Address->SqlSelect = "";
		$this->Address->SqlOrderBy = "";
		$this->Address->FldGroupByType = "";
		$this->Address->FldGroupInt = "0";
		$this->Address->FldGroupSql = "";

		// Department
		$this->Department = new crField('Recruitment_Per_Department', 'Recruitment Per Department', 'x_Department', 'Department', '`Department`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Department'] =& $this->Department;
		$this->Department->DateFilter = "";
		$this->Department->SqlSelect = "";
		$this->Department->SqlOrderBy = "";
		$this->Department->FldGroupByType = "";
		$this->Department->FldGroupInt = "0";
		$this->Department->FldGroupSql = "";

		// Position
		$this->Position = new crField('Recruitment_Per_Department', 'Recruitment Per Department', 'x_Position', 'Position', '`Position`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Position'] =& $this->Position;
		$this->Position->DateFilter = "";
		$this->Position->SqlSelect = "";
		$this->Position->SqlOrderBy = "";
		$this->Position->FldGroupByType = "";
		$this->Position->FldGroupInt = "0";
		$this->Position->FldGroupSql = "";

		// Department Name
		$this->Department_Name = new crField('Recruitment_Per_Department', 'Recruitment Per Department', 'x_Department_Name', 'Department Name', 'aqhrmsdb.recruitment.Department', 200, EWRPT_DATATYPE_STRING, -1);
		$this->Department_Name->GroupingFieldId = 1;
		$this->fields['Department_Name'] =& $this->Department_Name;
		$this->Department_Name->DateFilter = "";
		$this->Department_Name->SqlSelect = "";
		$this->Department_Name->SqlOrderBy = "";
		$this->Department_Name->FldGroupByType = "";
		$this->Department_Name->FldGroupInt = "0";
		$this->Department_Name->FldGroupSql = "";

		// Recruited
		$this->Recruited = new crField('Recruitment_Per_Department', 'Recruitment Per Department', 'x_Recruited', 'Recruited', 'Count(aqhrmsdb.recruitment.ID)', 20, EWRPT_DATATYPE_NUMBER, -1);
		$this->Recruited->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['Recruited'] =& $this->Recruited;
		$this->Recruited->DateFilter = "";
		$this->Recruited->SqlSelect = "";
		$this->Recruited->SqlOrderBy = "";
		$this->Recruited->FldGroupByType = "";
		$this->Recruited->FldGroupInt = "0";
		$this->Recruited->FldGroupSql = "";

		// Housing_Allowance
		$this->Housing_Allowance = new crField('Recruitment_Per_Department', 'Recruitment Per Department', 'x_Housing_Allowance', 'Housing_Allowance', '`Housing_Allowance`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Housing_Allowance->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Housing_Allowance'] =& $this->Housing_Allowance;
		$this->Housing_Allowance->DateFilter = "";
		$this->Housing_Allowance->SqlSelect = "";
		$this->Housing_Allowance->SqlOrderBy = "";
		$this->Housing_Allowance->FldGroupByType = "";
		$this->Housing_Allowance->FldGroupInt = "0";
		$this->Housing_Allowance->FldGroupSql = "";

		// Salary
		$this->Salary = new crField('Recruitment_Per_Department', 'Recruitment Per Department', 'x_Salary', 'Salary', '`Salary`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Salary->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Salary'] =& $this->Salary;
		$this->Salary->DateFilter = "";
		$this->Salary->SqlSelect = "";
		$this->Salary->SqlOrderBy = "";
		$this->Salary->FldGroupByType = "";
		$this->Salary->FldGroupInt = "0";
		$this->Salary->FldGroupSql = "";

		// Transport_Allowance
		$this->Transport_Allowance = new crField('Recruitment_Per_Department', 'Recruitment Per Department', 'x_Transport_Allowance', 'Transport_Allowance', '`Transport_Allowance`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Transport_Allowance->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Transport_Allowance'] =& $this->Transport_Allowance;
		$this->Transport_Allowance->DateFilter = "";
		$this->Transport_Allowance->SqlSelect = "";
		$this->Transport_Allowance->SqlOrderBy = "";
		$this->Transport_Allowance->FldGroupByType = "";
		$this->Transport_Allowance->FldGroupInt = "0";
		$this->Transport_Allowance->FldGroupSql = "";

		// Hardship_Allowance
		$this->Hardship_Allowance = new crField('Recruitment_Per_Department', 'Recruitment Per Department', 'x_Hardship_Allowance', 'Hardship_Allowance', '`Hardship_Allowance`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Hardship_Allowance->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Hardship_Allowance'] =& $this->Hardship_Allowance;
		$this->Hardship_Allowance->DateFilter = "";
		$this->Hardship_Allowance->SqlSelect = "";
		$this->Hardship_Allowance->SqlOrderBy = "";
		$this->Hardship_Allowance->FldGroupByType = "";
		$this->Hardship_Allowance->FldGroupInt = "0";
		$this->Hardship_Allowance->FldGroupSql = "";

		// Position_Allowance
		$this->Position_Allowance = new crField('Recruitment_Per_Department', 'Recruitment Per Department', 'x_Position_Allowance', 'Position_Allowance', '`Position_Allowance`', 5, EWRPT_DATATYPE_NUMBER, -1);
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
		return "`aqhrmsdb`.`recruitment`";
	}

	function SqlSelect() { // Select
		return "SELECT *,`aqhrmsdb`.`recruitment`.`Department` AS `Department Name`, count(`aqhrmsdb`.`recruitment`.`ID`) AS `Recruited` FROM " . $this->SqlFrom();
	}

	function SqlWhere() { // Where
		return "";
	}

	function SqlGroupBy() { // Group By
		return "`aqhrmsdb`.`recruitment`.`Department`";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
		return "aqhrmsdb.recruitment.Department ASC";
	}

	// Table Level Group SQL
	function SqlFirstGroupField() {
		return "aqhrmsdb.recruitment.Department";
	}

	function SqlSelectGroup() {
		return "SELECT DISTINCT " . $this->SqlFirstGroupField() . " AS `Department Name` FROM " . $this->SqlFrom();
	}

	function SqlOrderByGroup() {
		return "aqhrmsdb.recruitment.Department ASC";
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
$Recruitment_Per_Department_summary = new crRecruitment_Per_Department_summary();
$Page =& $Recruitment_Per_Department_summary;

// Page init
$Recruitment_Per_Department_summary->Page_Init();

// Page main
$Recruitment_Per_Department_summary->Page_Main();
?>
<?php include "phprptinc/header.php"; ?>
<?php if ($Recruitment_Per_Department->Export == "") { ?>
<script type="text/javascript">

// Create page object
var Recruitment_Per_Department_summary = new ewrpt_Page("Recruitment_Per_Department_summary");

// page properties
Recruitment_Per_Department_summary.PageID = "summary"; // page ID
Recruitment_Per_Department_summary.FormID = "fRecruitment_Per_Departmentsummaryfilter"; // form ID
var EWRPT_PAGE_ID = Recruitment_Per_Department_summary.PageID;

// extend page with ValidateForm function
Recruitment_Per_Department_summary.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var elm = fobj.sv1_Date;
	if (elm && !ewrpt_CheckDate(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Recruitment_Per_Department->Date->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv2_Date;
	if (elm && !ewrpt_CheckDate(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Recruitment_Per_Department->Date->FldErrMsg()) ?>"))
			return false;
	}

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj)) return false;
	return true;
}

// extend page with Form_CustomValidate function
Recruitment_Per_Department_summary.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EWRPT_CLIENT_VALIDATE) { ?>
Recruitment_Per_Department_summary.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
Recruitment_Per_Department_summary.ValidateRequired = false; // no JavaScript validation
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
<?php $Recruitment_Per_Department_summary->ShowPageHeader(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php $Recruitment_Per_Department_summary->ShowMessage(); ?>
<?php if ($Recruitment_Per_Department->Export == "" || $Recruitment_Per_Department->Export == "print" || $Recruitment_Per_Department->Export == "email") { ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php } ?>
<?php if ($Recruitment_Per_Department->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
</script>
<?php } ?>
<?php if ($Recruitment_Per_Department->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<?php if ($Recruitment_Per_Department->Export == "" || $Recruitment_Per_Department->Export == "print" || $Recruitment_Per_Department->Export == "email") { ?>
<?php } ?>
<?php echo $Recruitment_Per_Department->TableCaption() ?>
<?php if ($Recruitment_Per_Department->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $Recruitment_Per_Department_summary->ExportPrintUrl ?>"><?php echo $ReportLanguage->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $Recruitment_Per_Department_summary->ExportExcelUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $Recruitment_Per_Department_summary->ExportWordUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToWord") ?></a>
<?php if ($Recruitment_Per_Department_summary->FilterApplied) { ?>
&nbsp;&nbsp;<a href="Recruitment_Per_Departmentsmry.php?cmd=reset"><?php echo $ReportLanguage->Phrase("ResetAllFilter") ?></a>
<?php } ?>
<?php } ?>
<br /><br />
<?php if ($Recruitment_Per_Department->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($Recruitment_Per_Department->Export == "" || $Recruitment_Per_Department->Export == "print" || $Recruitment_Per_Department->Export == "email") { ?>
<?php } ?>
<?php if ($Recruitment_Per_Department->Export == "") { ?>
	</div></td>
	<!-- Left Container (End) -->
	<!-- Center Container - Report (Begin) -->
	<td style="vertical-align: top;" class="ewPadding"><div id="ewCenter" class="phpreportmaker">
	<!-- center slot -->
<?php } ?>
<!-- summary report starts -->
<div id="report_summary">
<?php if ($Recruitment_Per_Department->Export == "") { ?>
<?php
if ($Recruitment_Per_Department->FilterPanelOption == 2 || ($Recruitment_Per_Department->FilterPanelOption == 3 && $Recruitment_Per_Department_summary->FilterApplied) || $Recruitment_Per_Department_summary->Filter == "0=101") {
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
<form name="fRecruitment_Per_Departmentsummaryfilter" id="fRecruitment_Per_Departmentsummaryfilter" action="Recruitment_Per_Departmentsmry.php" class="ewForm" onsubmit="return Recruitment_Per_Department_summary.ValidateForm(this);">
<table class="ewRptExtFilter">
	<tr>
		<td><span class="phpreportmaker"><?php echo $Recruitment_Per_Department->Date->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("BETWEEN"); ?><input type="hidden" name="so1_Date" id="so1_Date" value="BETWEEN"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_Date" id="sv1_Date" value="<?php echo ewrpt_HtmlEncode($Recruitment_Per_Department->Date->SearchValue) ?>"<?php echo ($Recruitment_Per_Department_summary->ClearExtFilter == 'Recruitment_Per_Department_Date') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
				<td><span class="ewRptSearchOpr" id="btw1_Date" name="btw1_Date">&nbsp;<?php echo $ReportLanguage->Phrase("AND") ?>&nbsp;</span></td>
				<td><span class="phpreportmaker" id="btw1_Date" name="btw1_Date">
<input type="text" name="sv2_Date" id="sv2_Date" value="<?php echo ewrpt_HtmlEncode($Recruitment_Per_Department->Date->SearchValue2) ?>"<?php echo ($Recruitment_Per_Department_summary->ClearExtFilter == 'Recruitment_Per_Department_Date') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Recruitment_Per_Department->Department->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_Department" id="so1_Department" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_Department" id="sv1_Department" size="30" maxlength="50" value="<?php echo ewrpt_HtmlEncode($Recruitment_Per_Department->Department->SearchValue) ?>"<?php echo ($Recruitment_Per_Department_summary->ClearExtFilter == 'Recruitment_Per_Department_Department') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Recruitment_Per_Department->Position->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_Position" id="so1_Position" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_Position" id="sv1_Position" size="30" maxlength="30" value="<?php echo ewrpt_HtmlEncode($Recruitment_Per_Department->Position->SearchValue) ?>"<?php echo ($Recruitment_Per_Department_summary->ClearExtFilter == 'Recruitment_Per_Department_Position') ? " class=\"ewInputCleared\"" : "" ?>>
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
<?php if ($Recruitment_Per_Department->ShowCurrentFilter) { ?>
<div id="ewrptFilterList">
<?php $Recruitment_Per_Department_summary->ShowFilterList() ?>
</div>
<br />
<?php } ?>
<table class="ewGrid" cellspacing="0"><tr>
	<td class="ewGridContent">
<?php if ($Recruitment_Per_Department->Export == "") { ?>
<div class="ewGridUpperPanel">
<form action="Recruitment_Per_Departmentsmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($Recruitment_Per_Department_summary->StartGrp, $Recruitment_Per_Department_summary->DisplayGrps, $Recruitment_Per_Department_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="Recruitment_Per_Departmentsmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="Recruitment_Per_Departmentsmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="Recruitment_Per_Departmentsmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="Recruitment_Per_Departmentsmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($Recruitment_Per_Department_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($Recruitment_Per_Department_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($Recruitment_Per_Department_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($Recruitment_Per_Department_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($Recruitment_Per_Department_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($Recruitment_Per_Department_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($Recruitment_Per_Department_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($Recruitment_Per_Department_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($Recruitment_Per_Department_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($Recruitment_Per_Department_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($Recruitment_Per_Department->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
if ($Recruitment_Per_Department->ExportAll && $Recruitment_Per_Department->Export <> "") {
	$Recruitment_Per_Department_summary->StopGrp = $Recruitment_Per_Department_summary->TotalGrps;
} else {
	$Recruitment_Per_Department_summary->StopGrp = $Recruitment_Per_Department_summary->StartGrp + $Recruitment_Per_Department_summary->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($Recruitment_Per_Department_summary->StopGrp) > intval($Recruitment_Per_Department_summary->TotalGrps))
	$Recruitment_Per_Department_summary->StopGrp = $Recruitment_Per_Department_summary->TotalGrps;
$Recruitment_Per_Department_summary->RecCount = 0;

// Get first row
if ($Recruitment_Per_Department_summary->TotalGrps > 0) {
	$Recruitment_Per_Department_summary->GetGrpRow(1);
	$Recruitment_Per_Department_summary->GrpCount = 1;
}
while (($rsgrp && !$rsgrp->EOF && $Recruitment_Per_Department_summary->GrpCount <= $Recruitment_Per_Department_summary->DisplayGrps) || $Recruitment_Per_Department_summary->ShowFirstHeader) {

	// Show header
	if ($Recruitment_Per_Department_summary->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Recruitment_Per_Department->SortUrl($Recruitment_Per_Department->Department_Name) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Recruitment_Per_Department->Department_Name->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Recruitment_Per_Department->SortUrl($Recruitment_Per_Department->Department_Name) ?>',0);"><?php echo $Recruitment_Per_Department->Department_Name->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Recruitment_Per_Department->Department_Name->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Recruitment_Per_Department->Department_Name->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Recruitment_Per_Department->SortUrl($Recruitment_Per_Department->Recruited) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Recruitment_Per_Department->Recruited->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Recruitment_Per_Department->SortUrl($Recruitment_Per_Department->Recruited) ?>',0);"><?php echo $Recruitment_Per_Department->Recruited->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Recruitment_Per_Department->Recruited->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Recruitment_Per_Department->Recruited->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Recruitment_Per_Department->SortUrl($Recruitment_Per_Department->Housing_Allowance) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Recruitment_Per_Department->Housing_Allowance->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Recruitment_Per_Department->SortUrl($Recruitment_Per_Department->Housing_Allowance) ?>',0);"><?php echo $Recruitment_Per_Department->Housing_Allowance->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Recruitment_Per_Department->Housing_Allowance->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Recruitment_Per_Department->Housing_Allowance->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Recruitment_Per_Department->SortUrl($Recruitment_Per_Department->Salary) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Recruitment_Per_Department->Salary->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Recruitment_Per_Department->SortUrl($Recruitment_Per_Department->Salary) ?>',0);"><?php echo $Recruitment_Per_Department->Salary->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Recruitment_Per_Department->Salary->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Recruitment_Per_Department->Salary->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Recruitment_Per_Department->SortUrl($Recruitment_Per_Department->Transport_Allowance) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Recruitment_Per_Department->Transport_Allowance->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Recruitment_Per_Department->SortUrl($Recruitment_Per_Department->Transport_Allowance) ?>',0);"><?php echo $Recruitment_Per_Department->Transport_Allowance->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Recruitment_Per_Department->Transport_Allowance->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Recruitment_Per_Department->Transport_Allowance->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Recruitment_Per_Department->SortUrl($Recruitment_Per_Department->Hardship_Allowance) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Recruitment_Per_Department->Hardship_Allowance->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Recruitment_Per_Department->SortUrl($Recruitment_Per_Department->Hardship_Allowance) ?>',0);"><?php echo $Recruitment_Per_Department->Hardship_Allowance->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Recruitment_Per_Department->Hardship_Allowance->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Recruitment_Per_Department->Hardship_Allowance->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Recruitment_Per_Department->SortUrl($Recruitment_Per_Department->Position_Allowance) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Recruitment_Per_Department->Position_Allowance->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Recruitment_Per_Department->SortUrl($Recruitment_Per_Department->Position_Allowance) ?>',0);"><?php echo $Recruitment_Per_Department->Position_Allowance->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Recruitment_Per_Department->Position_Allowance->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Recruitment_Per_Department->Position_Allowance->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$Recruitment_Per_Department_summary->ShowFirstHeader = FALSE;
	}

	// Build detail SQL
	$sWhere = ewrpt_DetailFilterSQL($Recruitment_Per_Department->Department_Name, $Recruitment_Per_Department->SqlFirstGroupField(), $Recruitment_Per_Department->Department_Name->GroupValue());
	if ($Recruitment_Per_Department_summary->Filter != "")
		$sWhere = "($Recruitment_Per_Department_summary->Filter) AND ($sWhere)";
	$sSql = ewrpt_BuildReportSql($Recruitment_Per_Department->SqlSelect(), $Recruitment_Per_Department->SqlWhere(), $Recruitment_Per_Department->SqlGroupBy(), $Recruitment_Per_Department->SqlHaving(), $Recruitment_Per_Department->SqlOrderBy(), $sWhere, $Recruitment_Per_Department_summary->Sort);
	$rs = $conn->Execute($sSql);
	$rsdtlcnt = ($rs) ? $rs->RecordCount() : 0;
	if ($rsdtlcnt > 0)
		$Recruitment_Per_Department_summary->GetRow(1);
	while ($rs && !$rs->EOF) { // Loop detail records
		$Recruitment_Per_Department_summary->RecCount++;

		// Render detail row
		$Recruitment_Per_Department->ResetCSS();
		$Recruitment_Per_Department->RowType = EWRPT_ROWTYPE_DETAIL;
		$Recruitment_Per_Department_summary->RenderRow();
?>
	<tr<?php echo $Recruitment_Per_Department->RowAttributes(); ?>>
		<td<?php echo $Recruitment_Per_Department->Department_Name->CellAttributes(); ?>><div<?php echo $Recruitment_Per_Department->Department_Name->ViewAttributes(); ?>><?php echo $Recruitment_Per_Department->Department_Name->GroupViewValue; ?></div></td>
		<td<?php echo $Recruitment_Per_Department->Recruited->CellAttributes() ?>>
<div<?php echo $Recruitment_Per_Department->Recruited->ViewAttributes(); ?>><?php echo $Recruitment_Per_Department->Recruited->ListViewValue(); ?></div>
</td>
		<td<?php echo $Recruitment_Per_Department->Housing_Allowance->CellAttributes() ?>>
<div<?php echo $Recruitment_Per_Department->Housing_Allowance->ViewAttributes(); ?>><?php echo $Recruitment_Per_Department->Housing_Allowance->ListViewValue(); ?></div>
</td>
		<td<?php echo $Recruitment_Per_Department->Salary->CellAttributes() ?>>
<div<?php echo $Recruitment_Per_Department->Salary->ViewAttributes(); ?>><?php echo $Recruitment_Per_Department->Salary->ListViewValue(); ?></div>
</td>
		<td<?php echo $Recruitment_Per_Department->Transport_Allowance->CellAttributes() ?>>
<div<?php echo $Recruitment_Per_Department->Transport_Allowance->ViewAttributes(); ?>><?php echo $Recruitment_Per_Department->Transport_Allowance->ListViewValue(); ?></div>
</td>
		<td<?php echo $Recruitment_Per_Department->Hardship_Allowance->CellAttributes() ?>>
<div<?php echo $Recruitment_Per_Department->Hardship_Allowance->ViewAttributes(); ?>><?php echo $Recruitment_Per_Department->Hardship_Allowance->ListViewValue(); ?></div>
</td>
		<td<?php echo $Recruitment_Per_Department->Position_Allowance->CellAttributes() ?>>
<div<?php echo $Recruitment_Per_Department->Position_Allowance->ViewAttributes(); ?>><?php echo $Recruitment_Per_Department->Position_Allowance->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$Recruitment_Per_Department_summary->AccumulateSummary();

		// Get next record
		$Recruitment_Per_Department_summary->GetRow(2);

		// Show Footers
?>
<?php
	} // End detail records loop
?>
<?php
			$Recruitment_Per_Department->ResetCSS();
			$Recruitment_Per_Department->RowType = EWRPT_ROWTYPE_TOTAL;
			$Recruitment_Per_Department->RowTotalType = EWRPT_ROWTOTAL_GROUP;
			$Recruitment_Per_Department->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
			$Recruitment_Per_Department->RowGroupLevel = 1;
			$Recruitment_Per_Department_summary->RenderRow();
?>
	<tr<?php echo $Recruitment_Per_Department->RowAttributes(); ?>>
		<td colspan="7"<?php echo $Recruitment_Per_Department->Department_Name->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSumHead") ?> <?php echo $Recruitment_Per_Department->Department_Name->FldCaption() ?>: <?php echo $Recruitment_Per_Department->Department_Name->GroupViewValue; ?> (<?php echo ewrpt_FormatNumber($Recruitment_Per_Department_summary->Cnt[1][0],0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php

			// Reset level 1 summary
			$Recruitment_Per_Department_summary->ResetLevelSummary(1);
?>
<?php

	// Next group
	$Recruitment_Per_Department_summary->GetGrpRow(2);
	$Recruitment_Per_Department_summary->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
<?php if (intval(@$Recruitment_Per_Department_summary->Cnt[0][6]) > 0) { ?>
<?php
	$Recruitment_Per_Department->ResetCSS();
	$Recruitment_Per_Department->RowType = EWRPT_ROWTYPE_TOTAL;
	$Recruitment_Per_Department->RowTotalType = EWRPT_ROWTOTAL_PAGE;
	$Recruitment_Per_Department->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
	$Recruitment_Per_Department->RowAttrs["class"] = "ewRptPageSummary";
	$Recruitment_Per_Department_summary->RenderRow();
?>
	<tr<?php echo $Recruitment_Per_Department->RowAttributes(); ?>><td colspan="7"><?php echo $ReportLanguage->Phrase("RptPageTotal") ?> (<?php echo ewrpt_FormatNumber($Recruitment_Per_Department_summary->Cnt[0][6],0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
	<!-- tr class="ewRptPageSummary"><td colspan="7"><span class="phpreportmaker">&nbsp;<br /></span></td></tr -->
<?php } ?>
<?php
if ($Recruitment_Per_Department_summary->TotalGrps > 0) {
	$Recruitment_Per_Department->ResetCSS();
	$Recruitment_Per_Department->RowType = EWRPT_ROWTYPE_TOTAL;
	$Recruitment_Per_Department->RowTotalType = EWRPT_ROWTOTAL_GRAND;
	$Recruitment_Per_Department->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
	$Recruitment_Per_Department->RowAttrs["class"] = "ewRptGrandSummary";
	$Recruitment_Per_Department_summary->RenderRow();
?>
	<!-- tr><td colspan="7"><span class="phpreportmaker">&nbsp;<br /></span></td></tr -->
	<tr<?php echo $Recruitment_Per_Department->RowAttributes(); ?>><td colspan="7"><?php echo $ReportLanguage->Phrase("RptGrandTotal") ?> (<?php echo ewrpt_FormatNumber($Recruitment_Per_Department_summary->TotCount,0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php } ?>
	</tfoot>
</table>
</div>
<?php if ($Recruitment_Per_Department_summary->TotalGrps > 0) { ?>
<?php if ($Recruitment_Per_Department->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="Recruitment_Per_Departmentsmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($Recruitment_Per_Department_summary->StartGrp, $Recruitment_Per_Department_summary->DisplayGrps, $Recruitment_Per_Department_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="Recruitment_Per_Departmentsmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="Recruitment_Per_Departmentsmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="Recruitment_Per_Departmentsmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="Recruitment_Per_Departmentsmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($Recruitment_Per_Department_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($Recruitment_Per_Department_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($Recruitment_Per_Department_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($Recruitment_Per_Department_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($Recruitment_Per_Department_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($Recruitment_Per_Department_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($Recruitment_Per_Department_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($Recruitment_Per_Department_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($Recruitment_Per_Department_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($Recruitment_Per_Department_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($Recruitment_Per_Department->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php if ($Recruitment_Per_Department->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($Recruitment_Per_Department->Export == "" || $Recruitment_Per_Department->Export == "print" || $Recruitment_Per_Department->Export == "email") { ?>
<?php } ?>
<?php if ($Recruitment_Per_Department->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($Recruitment_Per_Department->Export == "" || $Recruitment_Per_Department->Export == "print" || $Recruitment_Per_Department->Export == "email") { ?>
<?php } ?>
<?php if ($Recruitment_Per_Department->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $Recruitment_Per_Department_summary->ShowPageFooter(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($Recruitment_Per_Department->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "phprptinc/footer.php"; ?>
<?php
$Recruitment_Per_Department_summary->Page_Terminate();
?>
<?php

//
// Page class
//
class crRecruitment_Per_Department_summary {

	// Page ID
	var $PageID = 'summary';

	// Table name
	var $TableName = 'Recruitment Per Department';

	// Page object name
	var $PageObjName = 'Recruitment_Per_Department_summary';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $Recruitment_Per_Department;
		if ($Recruitment_Per_Department->UseTokenInUrl) $PageUrl .= "t=" . $Recruitment_Per_Department->TableVar . "&"; // Add page token
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
		global $Recruitment_Per_Department;
		if ($Recruitment_Per_Department->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($Recruitment_Per_Department->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($Recruitment_Per_Department->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crRecruitment_Per_Department_summary() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (Recruitment_Per_Department)
		$GLOBALS["Recruitment_Per_Department"] = new crRecruitment_Per_Department();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'summary', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'Recruitment Per Department', TRUE);

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
		global $Recruitment_Per_Department;

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$Recruitment_Per_Department->Export = $_GET["export"];
	}
	$gsExport = $Recruitment_Per_Department->Export; // Get export parameter, used in header
	$gsExportFile = $Recruitment_Per_Department->TableVar; // Get export file, used in header
	if ($Recruitment_Per_Department->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($Recruitment_Per_Department->Export == "word") {
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
		global $Recruitment_Per_Department;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($Recruitment_Per_Department->Export == "email") {
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
		global $Recruitment_Per_Department;
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

		// Load default filter values
		$this->LoadDefaultFilters();

		// Set up popup filter
		$this->SetupPopup();

		// Extended filter
		$sExtendedFilter = "";

		// Get dropdown values
		$this->GetExtendedFilterValues();

		// Load custom filters
		$Recruitment_Per_Department->CustomFilters_Load();

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
		$sGrpSort = ewrpt_UpdateSortFields($Recruitment_Per_Department->SqlOrderByGroup(), $this->Sort, 2); // Get grouping field only
		$sSql = ewrpt_BuildReportSql($Recruitment_Per_Department->SqlSelectGroup(), $Recruitment_Per_Department->SqlWhere(), $Recruitment_Per_Department->SqlGroupBy(), $Recruitment_Per_Department->SqlHaving(), $Recruitment_Per_Department->SqlOrderByGroup(), $this->Filter, $sGrpSort);
		$this->TotalGrps = $this->GetGrpCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($Recruitment_Per_Department->ExportAll && $Recruitment_Per_Department->Export <> "")
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
		global $Recruitment_Per_Department;
		switch ($lvl) {
			case 1:
				return (is_null($Recruitment_Per_Department->Department_Name->CurrentValue) && !is_null($Recruitment_Per_Department->Department_Name->OldValue)) ||
					(!is_null($Recruitment_Per_Department->Department_Name->CurrentValue) && is_null($Recruitment_Per_Department->Department_Name->OldValue)) ||
					($Recruitment_Per_Department->Department_Name->GroupValue() <> $Recruitment_Per_Department->Department_Name->GroupOldValue());
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
		global $Recruitment_Per_Department;
		$rsgrpcnt = $conn->Execute($sql);
		$grpcnt = ($rsgrpcnt) ? $rsgrpcnt->RecordCount() : 0;
		if ($rsgrpcnt) $rsgrpcnt->Close();
		return $grpcnt;
	}

	// Get group rs
	function GetGrpRs($sql, $start, $grps) {
		global $conn;
		global $Recruitment_Per_Department;
		$wrksql = $sql;
		if ($start > 0 && $grps > -1)
			$wrksql .= " LIMIT " . ($start-1) . ", " . ($grps);
		$rswrk = $conn->Execute($wrksql);
		return $rswrk;
	}

	// Get group row values
	function GetGrpRow($opt) {
		global $rsgrp;
		global $Recruitment_Per_Department;
		if (!$rsgrp)
			return;
		if ($opt == 1) { // Get first group

			//$rsgrp->MoveFirst(); // NOTE: no need to move position
			$Recruitment_Per_Department->Department_Name->setDbValue(""); // Init first value
		} else { // Get next group
			$rsgrp->MoveNext();
		}
		if (!$rsgrp->EOF)
			$Recruitment_Per_Department->Department_Name->setDbValue($rsgrp->fields('Department Name'));
		if ($rsgrp->EOF) {
			$Recruitment_Per_Department->Department_Name->setDbValue("");
		}
	}

	// Get row values
	function GetRow($opt) {
		global $rs;
		global $Recruitment_Per_Department;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$Recruitment_Per_Department->Auto_ID->setDbValue($rs->fields('Auto_ID'));
			$Recruitment_Per_Department->Employee->setDbValue($rs->fields('Employee'));
			$Recruitment_Per_Department->Place->setDbValue($rs->fields('Place'));
			$Recruitment_Per_Department->ID->setDbValue($rs->fields('ID'));
			$Recruitment_Per_Department->FirstName->setDbValue($rs->fields('FirstName'));
			$Recruitment_Per_Department->MiddelName->setDbValue($rs->fields('MiddelName'));
			$Recruitment_Per_Department->LastName->setDbValue($rs->fields('LastName'));
			$Recruitment_Per_Department->Age->setDbValue($rs->fields('Age'));
			$Recruitment_Per_Department->Sex->setDbValue($rs->fields('Sex'));
			$Recruitment_Per_Department->Photo->setDbValue($rs->fields('Photo'));
			$Recruitment_Per_Department->Date->setDbValue($rs->fields('Date'));
			$Recruitment_Per_Department->Address->setDbValue($rs->fields('Address'));
			$Recruitment_Per_Department->Department->setDbValue($rs->fields('Department'));
			$Recruitment_Per_Department->Position->setDbValue($rs->fields('Position'));
			if ($opt <> 1)
				$Recruitment_Per_Department->Department_Name->setDbValue($rs->fields('Department Name'));
			$Recruitment_Per_Department->Recruited->setDbValue($rs->fields('Recruited'));
			$Recruitment_Per_Department->Housing_Allowance->setDbValue($rs->fields('Housing_Allowance'));
			$Recruitment_Per_Department->Salary->setDbValue($rs->fields('Salary'));
			$Recruitment_Per_Department->Transport_Allowance->setDbValue($rs->fields('Transport_Allowance'));
			$Recruitment_Per_Department->Hardship_Allowance->setDbValue($rs->fields('Hardship_Allowance'));
			$Recruitment_Per_Department->Position_Allowance->setDbValue($rs->fields('Position_Allowance'));
			$this->Val[1] = $Recruitment_Per_Department->Recruited->CurrentValue;
			$this->Val[2] = $Recruitment_Per_Department->Housing_Allowance->CurrentValue;
			$this->Val[3] = $Recruitment_Per_Department->Salary->CurrentValue;
			$this->Val[4] = $Recruitment_Per_Department->Transport_Allowance->CurrentValue;
			$this->Val[5] = $Recruitment_Per_Department->Hardship_Allowance->CurrentValue;
			$this->Val[6] = $Recruitment_Per_Department->Position_Allowance->CurrentValue;
		} else {
			$Recruitment_Per_Department->Auto_ID->setDbValue("");
			$Recruitment_Per_Department->Employee->setDbValue("");
			$Recruitment_Per_Department->Place->setDbValue("");
			$Recruitment_Per_Department->ID->setDbValue("");
			$Recruitment_Per_Department->FirstName->setDbValue("");
			$Recruitment_Per_Department->MiddelName->setDbValue("");
			$Recruitment_Per_Department->LastName->setDbValue("");
			$Recruitment_Per_Department->Age->setDbValue("");
			$Recruitment_Per_Department->Sex->setDbValue("");
			$Recruitment_Per_Department->Photo->setDbValue("");
			$Recruitment_Per_Department->Date->setDbValue("");
			$Recruitment_Per_Department->Address->setDbValue("");
			$Recruitment_Per_Department->Department->setDbValue("");
			$Recruitment_Per_Department->Position->setDbValue("");
			$Recruitment_Per_Department->Department_Name->setDbValue("");
			$Recruitment_Per_Department->Recruited->setDbValue("");
			$Recruitment_Per_Department->Housing_Allowance->setDbValue("");
			$Recruitment_Per_Department->Salary->setDbValue("");
			$Recruitment_Per_Department->Transport_Allowance->setDbValue("");
			$Recruitment_Per_Department->Hardship_Allowance->setDbValue("");
			$Recruitment_Per_Department->Position_Allowance->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $Recruitment_Per_Department;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$Recruitment_Per_Department->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$Recruitment_Per_Department->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $Recruitment_Per_Department->getStartGroup();
			}
		} else {
			$this->StartGrp = $Recruitment_Per_Department->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$Recruitment_Per_Department->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$Recruitment_Per_Department->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$Recruitment_Per_Department->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $Recruitment_Per_Department;

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
		global $Recruitment_Per_Department;
		$this->StartGrp = 1;
		$Recruitment_Per_Department->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $Recruitment_Per_Department;
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
			$Recruitment_Per_Department->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$Recruitment_Per_Department->setStartGroup($this->StartGrp);
		} else {
			if ($Recruitment_Per_Department->getGroupPerPage() <> "") {
				$this->DisplayGrps = $Recruitment_Per_Department->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $Security;
		global $Recruitment_Per_Department;
		if ($Recruitment_Per_Department->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($Recruitment_Per_Department->SqlSelectCount(), $Recruitment_Per_Department->SqlWhere(), $Recruitment_Per_Department->SqlGroupBy(), $Recruitment_Per_Department->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}
		}

		// Call Row_Rendering event
		$Recruitment_Per_Department->Row_Rendering();

		/* --------------------
		'  Render view codes
		' --------------------- */
		if ($Recruitment_Per_Department->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// Department Name
			$Recruitment_Per_Department->Department_Name->GroupViewValue = $Recruitment_Per_Department->Department_Name->GroupOldValue();
			$Recruitment_Per_Department->Department_Name->CellAttrs["class"] = ($Recruitment_Per_Department->RowGroupLevel == 1) ? "ewRptGrpSummary1" : "ewRptGrpField1";
			$Recruitment_Per_Department->Department_Name->GroupViewValue = ewrpt_DisplayGroupValue($Recruitment_Per_Department->Department_Name, $Recruitment_Per_Department->Department_Name->GroupViewValue);

			// Recruited
			$Recruitment_Per_Department->Recruited->ViewValue = $Recruitment_Per_Department->Recruited->Summary;

			// Housing_Allowance
			$Recruitment_Per_Department->Housing_Allowance->ViewValue = $Recruitment_Per_Department->Housing_Allowance->Summary;

			// Salary
			$Recruitment_Per_Department->Salary->ViewValue = $Recruitment_Per_Department->Salary->Summary;

			// Transport_Allowance
			$Recruitment_Per_Department->Transport_Allowance->ViewValue = $Recruitment_Per_Department->Transport_Allowance->Summary;

			// Hardship_Allowance
			$Recruitment_Per_Department->Hardship_Allowance->ViewValue = $Recruitment_Per_Department->Hardship_Allowance->Summary;

			// Position_Allowance
			$Recruitment_Per_Department->Position_Allowance->ViewValue = $Recruitment_Per_Department->Position_Allowance->Summary;
		} else {

			// Department Name
			$Recruitment_Per_Department->Department_Name->GroupViewValue = $Recruitment_Per_Department->Department_Name->GroupValue();
			$Recruitment_Per_Department->Department_Name->CellAttrs["class"] = "ewRptGrpField1";
			$Recruitment_Per_Department->Department_Name->GroupViewValue = ewrpt_DisplayGroupValue($Recruitment_Per_Department->Department_Name, $Recruitment_Per_Department->Department_Name->GroupViewValue);
			if ($Recruitment_Per_Department->Department_Name->GroupValue() == $Recruitment_Per_Department->Department_Name->GroupOldValue() && !$this->ChkLvlBreak(1))
				$Recruitment_Per_Department->Department_Name->GroupViewValue = "&nbsp;";

			// Recruited
			$Recruitment_Per_Department->Recruited->ViewValue = $Recruitment_Per_Department->Recruited->CurrentValue;
			$Recruitment_Per_Department->Recruited->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Housing_Allowance
			$Recruitment_Per_Department->Housing_Allowance->ViewValue = $Recruitment_Per_Department->Housing_Allowance->CurrentValue;
			$Recruitment_Per_Department->Housing_Allowance->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Salary
			$Recruitment_Per_Department->Salary->ViewValue = $Recruitment_Per_Department->Salary->CurrentValue;
			$Recruitment_Per_Department->Salary->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Transport_Allowance
			$Recruitment_Per_Department->Transport_Allowance->ViewValue = $Recruitment_Per_Department->Transport_Allowance->CurrentValue;
			$Recruitment_Per_Department->Transport_Allowance->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Hardship_Allowance
			$Recruitment_Per_Department->Hardship_Allowance->ViewValue = $Recruitment_Per_Department->Hardship_Allowance->CurrentValue;
			$Recruitment_Per_Department->Hardship_Allowance->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Position_Allowance
			$Recruitment_Per_Department->Position_Allowance->ViewValue = $Recruitment_Per_Department->Position_Allowance->CurrentValue;
			$Recruitment_Per_Department->Position_Allowance->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// Department Name
		$Recruitment_Per_Department->Department_Name->HrefValue = "";

		// Recruited
		$Recruitment_Per_Department->Recruited->HrefValue = "";

		// Housing_Allowance
		$Recruitment_Per_Department->Housing_Allowance->HrefValue = "";

		// Salary
		$Recruitment_Per_Department->Salary->HrefValue = "";

		// Transport_Allowance
		$Recruitment_Per_Department->Transport_Allowance->HrefValue = "";

		// Hardship_Allowance
		$Recruitment_Per_Department->Hardship_Allowance->HrefValue = "";

		// Position_Allowance
		$Recruitment_Per_Department->Position_Allowance->HrefValue = "";

		// Call Row_Rendered event
		$Recruitment_Per_Department->Row_Rendered();
	}

	// Get extended filter values
	function GetExtendedFilterValues() {
		global $Recruitment_Per_Department;
	}

	// Return extended filter
	function GetExtendedFilter() {
		global $Recruitment_Per_Department;
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
			// Field Date

			$this->SetSessionFilterValues($Recruitment_Per_Department->Date->SearchValue, $Recruitment_Per_Department->Date->SearchOperator, $Recruitment_Per_Department->Date->SearchCondition, $Recruitment_Per_Department->Date->SearchValue2, $Recruitment_Per_Department->Date->SearchOperator2, 'Date');

			// Field Department
			$this->SetSessionFilterValues($Recruitment_Per_Department->Department->SearchValue, $Recruitment_Per_Department->Department->SearchOperator, $Recruitment_Per_Department->Department->SearchCondition, $Recruitment_Per_Department->Department->SearchValue2, $Recruitment_Per_Department->Department->SearchOperator2, 'Department');

			// Field Position
			$this->SetSessionFilterValues($Recruitment_Per_Department->Position->SearchValue, $Recruitment_Per_Department->Position->SearchOperator, $Recruitment_Per_Department->Position->SearchCondition, $Recruitment_Per_Department->Position->SearchValue2, $Recruitment_Per_Department->Position->SearchOperator2, 'Position');
			$bSetupFilter = TRUE;
		} else {

			// Field Date
			if ($this->GetFilterValues($Recruitment_Per_Department->Date)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field Department
			if ($this->GetFilterValues($Recruitment_Per_Department->Department)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field Position
			if ($this->GetFilterValues($Recruitment_Per_Department->Position)) {
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

			// Field Date
			$this->GetSessionFilterValues($Recruitment_Per_Department->Date);

			// Field Department
			$this->GetSessionFilterValues($Recruitment_Per_Department->Department);

			// Field Position
			$this->GetSessionFilterValues($Recruitment_Per_Department->Position);
		}

		// Call page filter validated event
		$Recruitment_Per_Department->Page_FilterValidated();

		// Build SQL
		// Field Date

		$this->BuildExtendedFilter($Recruitment_Per_Department->Date, $sFilter);

		// Field Department
		$this->BuildExtendedFilter($Recruitment_Per_Department->Department, $sFilter);

		// Field Position
		$this->BuildExtendedFilter($Recruitment_Per_Department->Position, $sFilter);

		// Save parms to session
		// Field Date

		$this->SetSessionFilterValues($Recruitment_Per_Department->Date->SearchValue, $Recruitment_Per_Department->Date->SearchOperator, $Recruitment_Per_Department->Date->SearchCondition, $Recruitment_Per_Department->Date->SearchValue2, $Recruitment_Per_Department->Date->SearchOperator2, 'Date');

		// Field Department
		$this->SetSessionFilterValues($Recruitment_Per_Department->Department->SearchValue, $Recruitment_Per_Department->Department->SearchOperator, $Recruitment_Per_Department->Department->SearchCondition, $Recruitment_Per_Department->Department->SearchValue2, $Recruitment_Per_Department->Department->SearchOperator2, 'Department');

		// Field Position
		$this->SetSessionFilterValues($Recruitment_Per_Department->Position->SearchValue, $Recruitment_Per_Department->Position->SearchOperator, $Recruitment_Per_Department->Position->SearchCondition, $Recruitment_Per_Department->Position->SearchValue2, $Recruitment_Per_Department->Position->SearchOperator2, 'Position');

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
		$this->GetSessionValue($fld->DropDownValue, 'sv_Recruitment_Per_Department_' . $parm);
	}

	// Get filter values from session
	function GetSessionFilterValues(&$fld) {
		$parm = substr($fld->FldVar, 2);
		$this->GetSessionValue($fld->SearchValue, 'sv1_Recruitment_Per_Department_' . $parm);
		$this->GetSessionValue($fld->SearchOperator, 'so1_Recruitment_Per_Department_' . $parm);
		$this->GetSessionValue($fld->SearchCondition, 'sc_Recruitment_Per_Department_' . $parm);
		$this->GetSessionValue($fld->SearchValue2, 'sv2_Recruitment_Per_Department_' . $parm);
		$this->GetSessionValue($fld->SearchOperator2, 'so2_Recruitment_Per_Department_' . $parm);
	}

	// Get value from session
	function GetSessionValue(&$sv, $sn) {
		if (isset($_SESSION[$sn]))
			$sv = $_SESSION[$sn];
	}

	// Set dropdown value to session
	function SetSessionDropDownValue($sv, $parm) {
		$_SESSION['sv_Recruitment_Per_Department_' . $parm] = $sv;
	}

	// Set filter values to session
	function SetSessionFilterValues($sv1, $so1, $sc, $sv2, $so2, $parm) {
		$_SESSION['sv1_Recruitment_Per_Department_' . $parm] = $sv1;
		$_SESSION['so1_Recruitment_Per_Department_' . $parm] = $so1;
		$_SESSION['sc_Recruitment_Per_Department_' . $parm] = $sc;
		$_SESSION['sv2_Recruitment_Per_Department_' . $parm] = $sv2;
		$_SESSION['so2_Recruitment_Per_Department_' . $parm] = $so2;
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
		global $ReportLanguage, $gsFormError, $Recruitment_Per_Department;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EWRPT_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ewrpt_CheckDate($Recruitment_Per_Department->Date->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Recruitment_Per_Department->Date->FldErrMsg();
		}
		if (!ewrpt_CheckDate($Recruitment_Per_Department->Date->SearchValue2)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Recruitment_Per_Department->Date->FldErrMsg();
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
		$_SESSION["sel_Recruitment_Per_Department_$parm"] = "";
		$_SESSION["rf_Recruitment_Per_Department_$parm"] = "";
		$_SESSION["rt_Recruitment_Per_Department_$parm"] = "";
	}

	// Load selection from session
	function LoadSelectionFromSession($parm) {
		global $Recruitment_Per_Department;
		$fld =& $Recruitment_Per_Department->fields($parm);
		$fld->SelectionList = @$_SESSION["sel_Recruitment_Per_Department_$parm"];
		$fld->RangeFrom = @$_SESSION["rf_Recruitment_Per_Department_$parm"];
		$fld->RangeTo = @$_SESSION["rt_Recruitment_Per_Department_$parm"];
	}

	// Load default value for filters
	function LoadDefaultFilters() {
		global $Recruitment_Per_Department;

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

		// Field Date
		$this->SetDefaultExtFilter($Recruitment_Per_Department->Date, "BETWEEN", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Recruitment_Per_Department->Date);

		// Field Department
		$this->SetDefaultExtFilter($Recruitment_Per_Department->Department, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Recruitment_Per_Department->Department);

		// Field Position
		$this->SetDefaultExtFilter($Recruitment_Per_Department->Position, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Recruitment_Per_Department->Position);

		/**
		* Set up default values for popup filters
		* NOTE: if extended filter is enabled, use default values in extended filter instead
		*/
	}

	// Check if filter applied
	function CheckFilter() {
		global $Recruitment_Per_Department;

		// Check Date text filter
		if ($this->TextFilterApplied($Recruitment_Per_Department->Date))
			return TRUE;

		// Check Department text filter
		if ($this->TextFilterApplied($Recruitment_Per_Department->Department))
			return TRUE;

		// Check Position text filter
		if ($this->TextFilterApplied($Recruitment_Per_Department->Position))
			return TRUE;
		return FALSE;
	}

	// Show list of filters
	function ShowFilterList() {
		global $Recruitment_Per_Department;
		global $ReportLanguage;

		// Initialize
		$sFilterList = "";

		// Field Date
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Recruitment_Per_Department->Date, $sExtWrk);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Recruitment_Per_Department->Date->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Department
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Recruitment_Per_Department->Department, $sExtWrk);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Recruitment_Per_Department->Department->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Position
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Recruitment_Per_Department->Position, $sExtWrk);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Recruitment_Per_Department->Position->FldCaption() . "<br />";
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
		global $Recruitment_Per_Department;
		$sWrk = "";
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $Recruitment_Per_Department;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$Recruitment_Per_Department->setOrderBy("");
				$Recruitment_Per_Department->setStartGroup(1);
				$Recruitment_Per_Department->Department_Name->setSort("");
				$Recruitment_Per_Department->Recruited->setSort("");
				$Recruitment_Per_Department->Housing_Allowance->setSort("");
				$Recruitment_Per_Department->Salary->setSort("");
				$Recruitment_Per_Department->Transport_Allowance->setSort("");
				$Recruitment_Per_Department->Hardship_Allowance->setSort("");
				$Recruitment_Per_Department->Position_Allowance->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$Recruitment_Per_Department->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$Recruitment_Per_Department->CurrentOrderType = @$_GET["ordertype"];
			$sSortSql = $Recruitment_Per_Department->SortSql();
			$Recruitment_Per_Department->setOrderBy($sSortSql);
			$Recruitment_Per_Department->setStartGroup(1);
		}
		return $Recruitment_Per_Department->getOrderBy();
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
