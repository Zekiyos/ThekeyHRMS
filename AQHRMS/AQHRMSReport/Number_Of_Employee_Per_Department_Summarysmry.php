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
$Number_Of_Employee_Per_Department_Summary = NULL;

//
// Table class for Number Of Employee Per Department Summary
//
class crNumber_Of_Employee_Per_Department_Summary {
	var $TableVar = 'Number_Of_Employee_Per_Department_Summary';
	var $TableName = 'Number Of Employee Per Department Summary';
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
	var $Date_Birth;
	var $Place_Birth;
	var $Age;
	var $Sex;
	var $zEmail;
	var $Date_Employement;
	var $Department;
	var $Position;
	var $Educational_Status;
	var $Salary;
	var $Martial_Status;
	var $Children_number;
	var $Name_Child;
	var $Age_Child;
	var $Sex_Child;
	var $Photo;
	var $Image;
	var $Experience;
	var $HardCopy_Shelf_No;
	var $ModifiedBy;
	var $Telephone;
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
	function crNumber_Of_Employee_Per_Department_Summary() {
		global $ReportLanguage;

		// Auto_ID
		$this->Auto_ID = new crField('Number_Of_Employee_Per_Department_Summary', 'Number Of Employee Per Department Summary', 'x_Auto_ID', 'Auto_ID', '`Auto_ID`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->Auto_ID->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['Auto_ID'] =& $this->Auto_ID;
		$this->Auto_ID->DateFilter = "";
		$this->Auto_ID->SqlSelect = "";
		$this->Auto_ID->SqlOrderBy = "";
		$this->Auto_ID->FldGroupByType = "";
		$this->Auto_ID->FldGroupInt = "0";
		$this->Auto_ID->FldGroupSql = "";

		// ID
		$this->ID = new crField('Number_Of_Employee_Per_Department_Summary', 'Number Of Employee Per Department Summary', 'x_ID', 'ID', '`ID`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['ID'] =& $this->ID;
		$this->ID->DateFilter = "";
		$this->ID->SqlSelect = "";
		$this->ID->SqlOrderBy = "";
		$this->ID->FldGroupByType = "";
		$this->ID->FldGroupInt = "0";
		$this->ID->FldGroupSql = "";

		// FirstName
		$this->FirstName = new crField('Number_Of_Employee_Per_Department_Summary', 'Number Of Employee Per Department Summary', 'x_FirstName', 'FirstName', '`FirstName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['FirstName'] =& $this->FirstName;
		$this->FirstName->DateFilter = "";
		$this->FirstName->SqlSelect = "";
		$this->FirstName->SqlOrderBy = "";
		$this->FirstName->FldGroupByType = "";
		$this->FirstName->FldGroupInt = "0";
		$this->FirstName->FldGroupSql = "";

		// MiddelName
		$this->MiddelName = new crField('Number_Of_Employee_Per_Department_Summary', 'Number Of Employee Per Department Summary', 'x_MiddelName', 'MiddelName', '`MiddelName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['MiddelName'] =& $this->MiddelName;
		$this->MiddelName->DateFilter = "";
		$this->MiddelName->SqlSelect = "";
		$this->MiddelName->SqlOrderBy = "";
		$this->MiddelName->FldGroupByType = "";
		$this->MiddelName->FldGroupInt = "0";
		$this->MiddelName->FldGroupSql = "";

		// LastName
		$this->LastName = new crField('Number_Of_Employee_Per_Department_Summary', 'Number Of Employee Per Department Summary', 'x_LastName', 'LastName', '`LastName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['LastName'] =& $this->LastName;
		$this->LastName->DateFilter = "";
		$this->LastName->SqlSelect = "";
		$this->LastName->SqlOrderBy = "";
		$this->LastName->FldGroupByType = "";
		$this->LastName->FldGroupInt = "0";
		$this->LastName->FldGroupSql = "";

		// Date_Birth
		$this->Date_Birth = new crField('Number_Of_Employee_Per_Department_Summary', 'Number Of Employee Per Department Summary', 'x_Date_Birth', 'Date_Birth', '`Date_Birth`', 133, EWRPT_DATATYPE_DATE, 5);
		$this->Date_Birth->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateYMD"));
		$this->fields['Date_Birth'] =& $this->Date_Birth;
		$this->Date_Birth->DateFilter = "";
		$this->Date_Birth->SqlSelect = "";
		$this->Date_Birth->SqlOrderBy = "";
		$this->Date_Birth->FldGroupByType = "";
		$this->Date_Birth->FldGroupInt = "0";
		$this->Date_Birth->FldGroupSql = "";

		// Place_Birth
		$this->Place_Birth = new crField('Number_Of_Employee_Per_Department_Summary', 'Number Of Employee Per Department Summary', 'x_Place_Birth', 'Place_Birth', '`Place_Birth`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Place_Birth'] =& $this->Place_Birth;
		$this->Place_Birth->DateFilter = "";
		$this->Place_Birth->SqlSelect = "";
		$this->Place_Birth->SqlOrderBy = "";
		$this->Place_Birth->FldGroupByType = "";
		$this->Place_Birth->FldGroupInt = "0";
		$this->Place_Birth->FldGroupSql = "";

		// Age
		$this->Age = new crField('Number_Of_Employee_Per_Department_Summary', 'Number Of Employee Per Department Summary', 'x_Age', 'Age', '`Age`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->Age->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['Age'] =& $this->Age;
		$this->Age->DateFilter = "";
		$this->Age->SqlSelect = "";
		$this->Age->SqlOrderBy = "";
		$this->Age->FldGroupByType = "";
		$this->Age->FldGroupInt = "0";
		$this->Age->FldGroupSql = "";

		// Sex
		$this->Sex = new crField('Number_Of_Employee_Per_Department_Summary', 'Number Of Employee Per Department Summary', 'x_Sex', 'Sex', '`Sex`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Sex'] =& $this->Sex;
		$this->Sex->DateFilter = "";
		$this->Sex->SqlSelect = "";
		$this->Sex->SqlOrderBy = "";
		$this->Sex->FldGroupByType = "";
		$this->Sex->FldGroupInt = "0";
		$this->Sex->FldGroupSql = "";

		// Email
		$this->zEmail = new crField('Number_Of_Employee_Per_Department_Summary', 'Number Of Employee Per Department Summary', 'x_zEmail', 'Email', '`Email`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['zEmail'] =& $this->zEmail;
		$this->zEmail->DateFilter = "";
		$this->zEmail->SqlSelect = "";
		$this->zEmail->SqlOrderBy = "";
		$this->zEmail->FldGroupByType = "";
		$this->zEmail->FldGroupInt = "0";
		$this->zEmail->FldGroupSql = "";

		// Date_Employement
		$this->Date_Employement = new crField('Number_Of_Employee_Per_Department_Summary', 'Number Of Employee Per Department Summary', 'x_Date_Employement', 'Date_Employement', '`Date_Employement`', 133, EWRPT_DATATYPE_DATE, 5);
		$this->Date_Employement->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateYMD"));
		$this->fields['Date_Employement'] =& $this->Date_Employement;
		$this->Date_Employement->DateFilter = "";
		$this->Date_Employement->SqlSelect = "";
		$this->Date_Employement->SqlOrderBy = "";
		$this->Date_Employement->FldGroupByType = "";
		$this->Date_Employement->FldGroupInt = "0";
		$this->Date_Employement->FldGroupSql = "";

		// Department
		$this->Department = new crField('Number_Of_Employee_Per_Department_Summary', 'Number Of Employee Per Department Summary', 'x_Department', 'Department', '`Department`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->Department->GroupingFieldId = 1;
		$this->fields['Department'] =& $this->Department;
		$this->Department->DateFilter = "";
		$this->Department->SqlSelect = "";
		$this->Department->SqlOrderBy = "";
		$this->Department->FldGroupByType = "";
		$this->Department->FldGroupInt = "0";
		$this->Department->FldGroupSql = "";

		// Position
		$this->Position = new crField('Number_Of_Employee_Per_Department_Summary', 'Number Of Employee Per Department Summary', 'x_Position', 'Position', '`Position`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Position'] =& $this->Position;
		$this->Position->DateFilter = "";
		$this->Position->SqlSelect = "";
		$this->Position->SqlOrderBy = "";
		$this->Position->FldGroupByType = "";
		$this->Position->FldGroupInt = "0";
		$this->Position->FldGroupSql = "";

		// Educational_Status
		$this->Educational_Status = new crField('Number_Of_Employee_Per_Department_Summary', 'Number Of Employee Per Department Summary', 'x_Educational_Status', 'Educational_Status', '`Educational_Status`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Educational_Status'] =& $this->Educational_Status;
		$this->Educational_Status->DateFilter = "";
		$this->Educational_Status->SqlSelect = "";
		$this->Educational_Status->SqlOrderBy = "";
		$this->Educational_Status->FldGroupByType = "";
		$this->Educational_Status->FldGroupInt = "0";
		$this->Educational_Status->FldGroupSql = "";

		// Salary
		$this->Salary = new crField('Number_Of_Employee_Per_Department_Summary', 'Number Of Employee Per Department Summary', 'x_Salary', 'Salary', '`Salary`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->Salary->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['Salary'] =& $this->Salary;
		$this->Salary->DateFilter = "";
		$this->Salary->SqlSelect = "";
		$this->Salary->SqlOrderBy = "";
		$this->Salary->FldGroupByType = "";
		$this->Salary->FldGroupInt = "0";
		$this->Salary->FldGroupSql = "";

		// Martial_Status
		$this->Martial_Status = new crField('Number_Of_Employee_Per_Department_Summary', 'Number Of Employee Per Department Summary', 'x_Martial_Status', 'Martial_Status', '`Martial_Status`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Martial_Status'] =& $this->Martial_Status;
		$this->Martial_Status->DateFilter = "";
		$this->Martial_Status->SqlSelect = "";
		$this->Martial_Status->SqlOrderBy = "";
		$this->Martial_Status->FldGroupByType = "";
		$this->Martial_Status->FldGroupInt = "0";
		$this->Martial_Status->FldGroupSql = "";

		// Children_number
		$this->Children_number = new crField('Number_Of_Employee_Per_Department_Summary', 'Number Of Employee Per Department Summary', 'x_Children_number', 'Children_number', '`Children_number`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->Children_number->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['Children_number'] =& $this->Children_number;
		$this->Children_number->DateFilter = "";
		$this->Children_number->SqlSelect = "";
		$this->Children_number->SqlOrderBy = "";
		$this->Children_number->FldGroupByType = "";
		$this->Children_number->FldGroupInt = "0";
		$this->Children_number->FldGroupSql = "";

		// Name_Child
		$this->Name_Child = new crField('Number_Of_Employee_Per_Department_Summary', 'Number Of Employee Per Department Summary', 'x_Name_Child', 'Name_Child', '`Name_Child`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Name_Child'] =& $this->Name_Child;
		$this->Name_Child->DateFilter = "";
		$this->Name_Child->SqlSelect = "";
		$this->Name_Child->SqlOrderBy = "";
		$this->Name_Child->FldGroupByType = "";
		$this->Name_Child->FldGroupInt = "0";
		$this->Name_Child->FldGroupSql = "";

		// Age_Child
		$this->Age_Child = new crField('Number_Of_Employee_Per_Department_Summary', 'Number Of Employee Per Department Summary', 'x_Age_Child', 'Age_Child', '`Age_Child`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Age_Child'] =& $this->Age_Child;
		$this->Age_Child->DateFilter = "";
		$this->Age_Child->SqlSelect = "";
		$this->Age_Child->SqlOrderBy = "";
		$this->Age_Child->FldGroupByType = "";
		$this->Age_Child->FldGroupInt = "0";
		$this->Age_Child->FldGroupSql = "";

		// Sex_Child
		$this->Sex_Child = new crField('Number_Of_Employee_Per_Department_Summary', 'Number Of Employee Per Department Summary', 'x_Sex_Child', 'Sex_Child', '`Sex_Child`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Sex_Child'] =& $this->Sex_Child;
		$this->Sex_Child->DateFilter = "";
		$this->Sex_Child->SqlSelect = "";
		$this->Sex_Child->SqlOrderBy = "";
		$this->Sex_Child->FldGroupByType = "";
		$this->Sex_Child->FldGroupInt = "0";
		$this->Sex_Child->FldGroupSql = "";

		// Photo
		$this->Photo = new crField('Number_Of_Employee_Per_Department_Summary', 'Number Of Employee Per Department Summary', 'x_Photo', 'Photo', '`Photo`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Photo'] =& $this->Photo;
		$this->Photo->DateFilter = "";
		$this->Photo->SqlSelect = "";
		$this->Photo->SqlOrderBy = "";
		$this->Photo->FldGroupByType = "";
		$this->Photo->FldGroupInt = "0";
		$this->Photo->FldGroupSql = "";

		// Image
		$this->Image = new crField('Number_Of_Employee_Per_Department_Summary', 'Number Of Employee Per Department Summary', 'x_Image', 'Image', '`Image`', 205, EWRPT_DATATYPE_BLOB, -1);
		$this->fields['Image'] =& $this->Image;
		$this->Image->DateFilter = "";
		$this->Image->SqlSelect = "";
		$this->Image->SqlOrderBy = "";
		$this->Image->FldGroupByType = "";
		$this->Image->FldGroupInt = "0";
		$this->Image->FldGroupSql = "";

		// Experience
		$this->Experience = new crField('Number_Of_Employee_Per_Department_Summary', 'Number Of Employee Per Department Summary', 'x_Experience', 'Experience', '`Experience`', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['Experience'] =& $this->Experience;
		$this->Experience->DateFilter = "";
		$this->Experience->SqlSelect = "";
		$this->Experience->SqlOrderBy = "";
		$this->Experience->FldGroupByType = "";
		$this->Experience->FldGroupInt = "0";
		$this->Experience->FldGroupSql = "";

		// HardCopy_Shelf_No
		$this->HardCopy_Shelf_No = new crField('Number_Of_Employee_Per_Department_Summary', 'Number Of Employee Per Department Summary', 'x_HardCopy_Shelf_No', 'HardCopy_Shelf_No', '`HardCopy_Shelf_No`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['HardCopy_Shelf_No'] =& $this->HardCopy_Shelf_No;
		$this->HardCopy_Shelf_No->DateFilter = "";
		$this->HardCopy_Shelf_No->SqlSelect = "";
		$this->HardCopy_Shelf_No->SqlOrderBy = "";
		$this->HardCopy_Shelf_No->FldGroupByType = "";
		$this->HardCopy_Shelf_No->FldGroupInt = "0";
		$this->HardCopy_Shelf_No->FldGroupSql = "";

		// ModifiedBy
		$this->ModifiedBy = new crField('Number_Of_Employee_Per_Department_Summary', 'Number Of Employee Per Department Summary', 'x_ModifiedBy', 'ModifiedBy', '`ModifiedBy`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['ModifiedBy'] =& $this->ModifiedBy;
		$this->ModifiedBy->DateFilter = "";
		$this->ModifiedBy->SqlSelect = "";
		$this->ModifiedBy->SqlOrderBy = "";
		$this->ModifiedBy->FldGroupByType = "";
		$this->ModifiedBy->FldGroupInt = "0";
		$this->ModifiedBy->FldGroupSql = "";

		// Telephone
		$this->Telephone = new crField('Number_Of_Employee_Per_Department_Summary', 'Number Of Employee Per Department Summary', 'x_Telephone', 'Telephone', '`Telephone`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Telephone'] =& $this->Telephone;
		$this->Telephone->DateFilter = "";
		$this->Telephone->SqlSelect = "";
		$this->Telephone->SqlOrderBy = "";
		$this->Telephone->FldGroupByType = "";
		$this->Telephone->FldGroupInt = "0";
		$this->Telephone->FldGroupSql = "";
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
		return "`employee_personal_record`";
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
$Number_Of_Employee_Per_Department_Summary_summary = new crNumber_Of_Employee_Per_Department_Summary_summary();
$Page =& $Number_Of_Employee_Per_Department_Summary_summary;

// Page init
$Number_Of_Employee_Per_Department_Summary_summary->Page_Init();

// Page main
$Number_Of_Employee_Per_Department_Summary_summary->Page_Main();
?>
<?php include "phprptinc/header.php"; ?>
<?php if ($Number_Of_Employee_Per_Department_Summary->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php $Number_Of_Employee_Per_Department_Summary_summary->ShowPageHeader(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php $Number_Of_Employee_Per_Department_Summary_summary->ShowMessage(); ?>
<?php if ($Number_Of_Employee_Per_Department_Summary->Export == "" || $Number_Of_Employee_Per_Department_Summary->Export == "print" || $Number_Of_Employee_Per_Department_Summary->Export == "email") { ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php } ?>
<?php if ($Number_Of_Employee_Per_Department_Summary->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
</script>
<?php } ?>
<?php if ($Number_Of_Employee_Per_Department_Summary->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<?php if ($Number_Of_Employee_Per_Department_Summary->Export == "" || $Number_Of_Employee_Per_Department_Summary->Export == "print" || $Number_Of_Employee_Per_Department_Summary->Export == "email") { ?>
<?php } ?>
<?php echo $Number_Of_Employee_Per_Department_Summary->TableCaption() ?>
<?php if ($Number_Of_Employee_Per_Department_Summary->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $Number_Of_Employee_Per_Department_Summary_summary->ExportPrintUrl ?>"><?php echo $ReportLanguage->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $Number_Of_Employee_Per_Department_Summary_summary->ExportExcelUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $Number_Of_Employee_Per_Department_Summary_summary->ExportWordUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToWord") ?></a>
<?php } ?>
<br /><br />
<?php if ($Number_Of_Employee_Per_Department_Summary->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($Number_Of_Employee_Per_Department_Summary->Export == "" || $Number_Of_Employee_Per_Department_Summary->Export == "print" || $Number_Of_Employee_Per_Department_Summary->Export == "email") { ?>
<?php } ?>
<?php if ($Number_Of_Employee_Per_Department_Summary->Export == "") { ?>
	</div></td>
	<!-- Left Container (End) -->
	<!-- Center Container - Report (Begin) -->
	<td style="vertical-align: top;" class="ewPadding"><div id="ewCenter" class="phpreportmaker">
	<!-- center slot -->
<?php } ?>
<!-- summary report starts -->
<div id="report_summary">
<table class="ewGrid" cellspacing="0"><tr>
	<td class="ewGridContent">
<?php if ($Number_Of_Employee_Per_Department_Summary->Export == "") { ?>
<div class="ewGridUpperPanel">
<form action="Number_Of_Employee_Per_Department_Summarysmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($Number_Of_Employee_Per_Department_Summary_summary->StartGrp, $Number_Of_Employee_Per_Department_Summary_summary->DisplayGrps, $Number_Of_Employee_Per_Department_Summary_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="Number_Of_Employee_Per_Department_Summarysmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="Number_Of_Employee_Per_Department_Summarysmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="Number_Of_Employee_Per_Department_Summarysmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="Number_Of_Employee_Per_Department_Summarysmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($Number_Of_Employee_Per_Department_Summary_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($Number_Of_Employee_Per_Department_Summary_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($Number_Of_Employee_Per_Department_Summary_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($Number_Of_Employee_Per_Department_Summary_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($Number_Of_Employee_Per_Department_Summary_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($Number_Of_Employee_Per_Department_Summary_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($Number_Of_Employee_Per_Department_Summary_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($Number_Of_Employee_Per_Department_Summary_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($Number_Of_Employee_Per_Department_Summary_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($Number_Of_Employee_Per_Department_Summary_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($Number_Of_Employee_Per_Department_Summary->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
if ($Number_Of_Employee_Per_Department_Summary->ExportAll && $Number_Of_Employee_Per_Department_Summary->Export <> "") {
	$Number_Of_Employee_Per_Department_Summary_summary->StopGrp = $Number_Of_Employee_Per_Department_Summary_summary->TotalGrps;
} else {
	$Number_Of_Employee_Per_Department_Summary_summary->StopGrp = $Number_Of_Employee_Per_Department_Summary_summary->StartGrp + $Number_Of_Employee_Per_Department_Summary_summary->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($Number_Of_Employee_Per_Department_Summary_summary->StopGrp) > intval($Number_Of_Employee_Per_Department_Summary_summary->TotalGrps))
	$Number_Of_Employee_Per_Department_Summary_summary->StopGrp = $Number_Of_Employee_Per_Department_Summary_summary->TotalGrps;
$Number_Of_Employee_Per_Department_Summary_summary->RecCount = 0;

// Get first row
if ($Number_Of_Employee_Per_Department_Summary_summary->TotalGrps > 0) {
	$Number_Of_Employee_Per_Department_Summary_summary->GetGrpRow(1);
	$Number_Of_Employee_Per_Department_Summary_summary->GrpCount = 1;
}
while (($rsgrp && !$rsgrp->EOF && $Number_Of_Employee_Per_Department_Summary_summary->GrpCount <= $Number_Of_Employee_Per_Department_Summary_summary->DisplayGrps) || $Number_Of_Employee_Per_Department_Summary_summary->ShowFirstHeader) {

	// Show header
	if ($Number_Of_Employee_Per_Department_Summary_summary->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Number_Of_Employee_Per_Department_Summary->SortUrl($Number_Of_Employee_Per_Department_Summary->Department) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Number_Of_Employee_Per_Department_Summary->Department->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Number_Of_Employee_Per_Department_Summary->SortUrl($Number_Of_Employee_Per_Department_Summary->Department) ?>',0);"><?php echo $Number_Of_Employee_Per_Department_Summary->Department->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Number_Of_Employee_Per_Department_Summary->Department->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Number_Of_Employee_Per_Department_Summary->Department->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$Number_Of_Employee_Per_Department_Summary_summary->ShowFirstHeader = FALSE;
	}

	// Build detail SQL
	$sWhere = ewrpt_DetailFilterSQL($Number_Of_Employee_Per_Department_Summary->Department, $Number_Of_Employee_Per_Department_Summary->SqlFirstGroupField(), $Number_Of_Employee_Per_Department_Summary->Department->GroupValue());
	if ($Number_Of_Employee_Per_Department_Summary_summary->Filter != "")
		$sWhere = "($Number_Of_Employee_Per_Department_Summary_summary->Filter) AND ($sWhere)";
	$sSql = ewrpt_BuildReportSql($Number_Of_Employee_Per_Department_Summary->SqlSelect(), $Number_Of_Employee_Per_Department_Summary->SqlWhere(), $Number_Of_Employee_Per_Department_Summary->SqlGroupBy(), $Number_Of_Employee_Per_Department_Summary->SqlHaving(), $Number_Of_Employee_Per_Department_Summary->SqlOrderBy(), $sWhere, $Number_Of_Employee_Per_Department_Summary_summary->Sort);
	$rs = $conn->Execute($sSql);
	$rsdtlcnt = ($rs) ? $rs->RecordCount() : 0;
	if ($rsdtlcnt > 0)
		$Number_Of_Employee_Per_Department_Summary_summary->GetRow(1);
	while ($rs && !$rs->EOF) { // Loop detail records
		$Number_Of_Employee_Per_Department_Summary_summary->RecCount++;

		// Render detail row
		$Number_Of_Employee_Per_Department_Summary->ResetCSS();
		$Number_Of_Employee_Per_Department_Summary->RowType = EWRPT_ROWTYPE_DETAIL;
		$Number_Of_Employee_Per_Department_Summary_summary->RenderRow();
?>
<?php

		// Accumulate page summary
		$Number_Of_Employee_Per_Department_Summary_summary->AccumulateSummary();

		// Get next record
		$Number_Of_Employee_Per_Department_Summary_summary->GetRow(2);

		// Show Footers
?>
<?php
	} // End detail records loop
?>
<?php
			$Number_Of_Employee_Per_Department_Summary->ResetCSS();
			$Number_Of_Employee_Per_Department_Summary->RowType = EWRPT_ROWTYPE_TOTAL;
			$Number_Of_Employee_Per_Department_Summary->RowTotalType = EWRPT_ROWTOTAL_GROUP;
			$Number_Of_Employee_Per_Department_Summary->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
			$Number_Of_Employee_Per_Department_Summary->RowGroupLevel = 1;
			$Number_Of_Employee_Per_Department_Summary_summary->RenderRow();
?>
	<tr<?php echo $Number_Of_Employee_Per_Department_Summary->RowAttributes(); ?>>
		<td colspan="1"<?php echo $Number_Of_Employee_Per_Department_Summary->Department->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSumHead") ?> <?php echo $Number_Of_Employee_Per_Department_Summary->Department->FldCaption() ?>: <?php echo $Number_Of_Employee_Per_Department_Summary->Department->GroupViewValue; ?> (<?php echo ewrpt_FormatNumber($Number_Of_Employee_Per_Department_Summary_summary->Cnt[1][0],0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php

			// Reset level 1 summary
			$Number_Of_Employee_Per_Department_Summary_summary->ResetLevelSummary(1);
?>
<?php

	// Next group
	$Number_Of_Employee_Per_Department_Summary_summary->GetGrpRow(2);
	$Number_Of_Employee_Per_Department_Summary_summary->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
<?php if (intval(@$Number_Of_Employee_Per_Department_Summary_summary->Cnt[0][0]) > 0) { ?>
<?php
	$Number_Of_Employee_Per_Department_Summary->ResetCSS();
	$Number_Of_Employee_Per_Department_Summary->RowType = EWRPT_ROWTYPE_TOTAL;
	$Number_Of_Employee_Per_Department_Summary->RowTotalType = EWRPT_ROWTOTAL_PAGE;
	$Number_Of_Employee_Per_Department_Summary->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
	$Number_Of_Employee_Per_Department_Summary->RowAttrs["class"] = "ewRptPageSummary";
	$Number_Of_Employee_Per_Department_Summary_summary->RenderRow();
?>
	<tr<?php echo $Number_Of_Employee_Per_Department_Summary->RowAttributes(); ?>><td colspan="1"><?php echo $ReportLanguage->Phrase("RptPageTotal") ?> (<?php echo ewrpt_FormatNumber($Number_Of_Employee_Per_Department_Summary_summary->Cnt[0][0],0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
	<!-- tr class="ewRptPageSummary"><td colspan="1"><span class="phpreportmaker">&nbsp;<br /></span></td></tr -->
<?php } ?>
<?php
if ($Number_Of_Employee_Per_Department_Summary_summary->TotalGrps > 0) {
	$Number_Of_Employee_Per_Department_Summary->ResetCSS();
	$Number_Of_Employee_Per_Department_Summary->RowType = EWRPT_ROWTYPE_TOTAL;
	$Number_Of_Employee_Per_Department_Summary->RowTotalType = EWRPT_ROWTOTAL_GRAND;
	$Number_Of_Employee_Per_Department_Summary->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
	$Number_Of_Employee_Per_Department_Summary->RowAttrs["class"] = "ewRptGrandSummary";
	$Number_Of_Employee_Per_Department_Summary_summary->RenderRow();
?>
	<!-- tr><td colspan="1"><span class="phpreportmaker">&nbsp;<br /></span></td></tr -->
	<tr<?php echo $Number_Of_Employee_Per_Department_Summary->RowAttributes(); ?>><td colspan="1"><?php echo $ReportLanguage->Phrase("RptGrandTotal") ?> (<?php echo ewrpt_FormatNumber($Number_Of_Employee_Per_Department_Summary_summary->TotCount,0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php } ?>
	</tfoot>
</table>
</div>
<?php if ($Number_Of_Employee_Per_Department_Summary_summary->TotalGrps > 0) { ?>
<?php if ($Number_Of_Employee_Per_Department_Summary->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="Number_Of_Employee_Per_Department_Summarysmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($Number_Of_Employee_Per_Department_Summary_summary->StartGrp, $Number_Of_Employee_Per_Department_Summary_summary->DisplayGrps, $Number_Of_Employee_Per_Department_Summary_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="Number_Of_Employee_Per_Department_Summarysmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="Number_Of_Employee_Per_Department_Summarysmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="Number_Of_Employee_Per_Department_Summarysmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="Number_Of_Employee_Per_Department_Summarysmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($Number_Of_Employee_Per_Department_Summary_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($Number_Of_Employee_Per_Department_Summary_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($Number_Of_Employee_Per_Department_Summary_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($Number_Of_Employee_Per_Department_Summary_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($Number_Of_Employee_Per_Department_Summary_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($Number_Of_Employee_Per_Department_Summary_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($Number_Of_Employee_Per_Department_Summary_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($Number_Of_Employee_Per_Department_Summary_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($Number_Of_Employee_Per_Department_Summary_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($Number_Of_Employee_Per_Department_Summary_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($Number_Of_Employee_Per_Department_Summary->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php if ($Number_Of_Employee_Per_Department_Summary->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($Number_Of_Employee_Per_Department_Summary->Export == "" || $Number_Of_Employee_Per_Department_Summary->Export == "print" || $Number_Of_Employee_Per_Department_Summary->Export == "email") { ?>
<?php } ?>
<?php if ($Number_Of_Employee_Per_Department_Summary->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($Number_Of_Employee_Per_Department_Summary->Export == "" || $Number_Of_Employee_Per_Department_Summary->Export == "print" || $Number_Of_Employee_Per_Department_Summary->Export == "email") { ?>
<?php } ?>
<?php if ($Number_Of_Employee_Per_Department_Summary->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $Number_Of_Employee_Per_Department_Summary_summary->ShowPageFooter(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($Number_Of_Employee_Per_Department_Summary->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "phprptinc/footer.php"; ?>
<?php
$Number_Of_Employee_Per_Department_Summary_summary->Page_Terminate();
?>
<?php

//
// Page class
//
class crNumber_Of_Employee_Per_Department_Summary_summary {

	// Page ID
	var $PageID = 'summary';

	// Table name
	var $TableName = 'Number Of Employee Per Department Summary';

	// Page object name
	var $PageObjName = 'Number_Of_Employee_Per_Department_Summary_summary';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $Number_Of_Employee_Per_Department_Summary;
		if ($Number_Of_Employee_Per_Department_Summary->UseTokenInUrl) $PageUrl .= "t=" . $Number_Of_Employee_Per_Department_Summary->TableVar . "&"; // Add page token
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
		global $Number_Of_Employee_Per_Department_Summary;
		if ($Number_Of_Employee_Per_Department_Summary->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($Number_Of_Employee_Per_Department_Summary->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($Number_Of_Employee_Per_Department_Summary->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crNumber_Of_Employee_Per_Department_Summary_summary() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (Number_Of_Employee_Per_Department_Summary)
		$GLOBALS["Number_Of_Employee_Per_Department_Summary"] = new crNumber_Of_Employee_Per_Department_Summary();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'summary', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'Number Of Employee Per Department Summary', TRUE);

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
		global $Number_Of_Employee_Per_Department_Summary;

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$Number_Of_Employee_Per_Department_Summary->Export = $_GET["export"];
	}
	$gsExport = $Number_Of_Employee_Per_Department_Summary->Export; // Get export parameter, used in header
	$gsExportFile = $Number_Of_Employee_Per_Department_Summary->TableVar; // Get export file, used in header
	if ($Number_Of_Employee_Per_Department_Summary->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($Number_Of_Employee_Per_Department_Summary->Export == "word") {
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
		global $Number_Of_Employee_Per_Department_Summary;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($Number_Of_Employee_Per_Department_Summary->Export == "email") {
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
		global $Number_Of_Employee_Per_Department_Summary;
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

		// Set up popup filter
		$this->SetupPopup();

		// Extended filter
		$sExtendedFilter = "";

		// Build popup filter
		$sPopupFilter = $this->GetPopupFilter();

		//ewrpt_SetDebugMsg("popup filter: " . $sPopupFilter);
		if ($sPopupFilter <> "") {
			if ($this->Filter <> "")
				$this->Filter = "($this->Filter) AND ($sPopupFilter)";
			else
				$this->Filter = $sPopupFilter;
		}

		// No filter
		$this->FilterApplied = FALSE;

		// Get sort
		$this->Sort = $this->GetSort();

		// Get total group count
		$sGrpSort = ewrpt_UpdateSortFields($Number_Of_Employee_Per_Department_Summary->SqlOrderByGroup(), $this->Sort, 2); // Get grouping field only
		$sSql = ewrpt_BuildReportSql($Number_Of_Employee_Per_Department_Summary->SqlSelectGroup(), $Number_Of_Employee_Per_Department_Summary->SqlWhere(), $Number_Of_Employee_Per_Department_Summary->SqlGroupBy(), $Number_Of_Employee_Per_Department_Summary->SqlHaving(), $Number_Of_Employee_Per_Department_Summary->SqlOrderByGroup(), $this->Filter, $sGrpSort);
		$this->TotalGrps = $this->GetGrpCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($Number_Of_Employee_Per_Department_Summary->ExportAll && $Number_Of_Employee_Per_Department_Summary->Export <> "")
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
		global $Number_Of_Employee_Per_Department_Summary;
		switch ($lvl) {
			case 1:
				return (is_null($Number_Of_Employee_Per_Department_Summary->Department->CurrentValue) && !is_null($Number_Of_Employee_Per_Department_Summary->Department->OldValue)) ||
					(!is_null($Number_Of_Employee_Per_Department_Summary->Department->CurrentValue) && is_null($Number_Of_Employee_Per_Department_Summary->Department->OldValue)) ||
					($Number_Of_Employee_Per_Department_Summary->Department->GroupValue() <> $Number_Of_Employee_Per_Department_Summary->Department->GroupOldValue());
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
		global $Number_Of_Employee_Per_Department_Summary;
		$rsgrpcnt = $conn->Execute($sql);
		$grpcnt = ($rsgrpcnt) ? $rsgrpcnt->RecordCount() : 0;
		if ($rsgrpcnt) $rsgrpcnt->Close();
		return $grpcnt;
	}

	// Get group rs
	function GetGrpRs($sql, $start, $grps) {
		global $conn;
		global $Number_Of_Employee_Per_Department_Summary;
		$wrksql = $sql;
		if ($start > 0 && $grps > -1)
			$wrksql .= " LIMIT " . ($start-1) . ", " . ($grps);
		$rswrk = $conn->Execute($wrksql);
		return $rswrk;
	}

	// Get group row values
	function GetGrpRow($opt) {
		global $rsgrp;
		global $Number_Of_Employee_Per_Department_Summary;
		if (!$rsgrp)
			return;
		if ($opt == 1) { // Get first group

			//$rsgrp->MoveFirst(); // NOTE: no need to move position
			$Number_Of_Employee_Per_Department_Summary->Department->setDbValue(""); // Init first value
		} else { // Get next group
			$rsgrp->MoveNext();
		}
		if (!$rsgrp->EOF)
			$Number_Of_Employee_Per_Department_Summary->Department->setDbValue($rsgrp->fields('Department'));
		if ($rsgrp->EOF) {
			$Number_Of_Employee_Per_Department_Summary->Department->setDbValue("");
		}
	}

	// Get row values
	function GetRow($opt) {
		global $rs;
		global $Number_Of_Employee_Per_Department_Summary;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$Number_Of_Employee_Per_Department_Summary->Auto_ID->setDbValue($rs->fields('Auto_ID'));
			$Number_Of_Employee_Per_Department_Summary->ID->setDbValue($rs->fields('ID'));
			$Number_Of_Employee_Per_Department_Summary->FirstName->setDbValue($rs->fields('FirstName'));
			$Number_Of_Employee_Per_Department_Summary->MiddelName->setDbValue($rs->fields('MiddelName'));
			$Number_Of_Employee_Per_Department_Summary->LastName->setDbValue($rs->fields('LastName'));
			$Number_Of_Employee_Per_Department_Summary->Date_Birth->setDbValue($rs->fields('Date_Birth'));
			$Number_Of_Employee_Per_Department_Summary->Place_Birth->setDbValue($rs->fields('Place_Birth'));
			$Number_Of_Employee_Per_Department_Summary->Age->setDbValue($rs->fields('Age'));
			$Number_Of_Employee_Per_Department_Summary->Sex->setDbValue($rs->fields('Sex'));
			$Number_Of_Employee_Per_Department_Summary->zEmail->setDbValue($rs->fields('Email'));
			$Number_Of_Employee_Per_Department_Summary->Date_Employement->setDbValue($rs->fields('Date_Employement'));
			if ($opt <> 1)
				$Number_Of_Employee_Per_Department_Summary->Department->setDbValue($rs->fields('Department'));
			$Number_Of_Employee_Per_Department_Summary->Position->setDbValue($rs->fields('Position'));
			$Number_Of_Employee_Per_Department_Summary->Educational_Status->setDbValue($rs->fields('Educational_Status'));
			$Number_Of_Employee_Per_Department_Summary->Salary->setDbValue($rs->fields('Salary'));
			$Number_Of_Employee_Per_Department_Summary->Martial_Status->setDbValue($rs->fields('Martial_Status'));
			$Number_Of_Employee_Per_Department_Summary->Children_number->setDbValue($rs->fields('Children_number'));
			$Number_Of_Employee_Per_Department_Summary->Name_Child->setDbValue($rs->fields('Name_Child'));
			$Number_Of_Employee_Per_Department_Summary->Age_Child->setDbValue($rs->fields('Age_Child'));
			$Number_Of_Employee_Per_Department_Summary->Sex_Child->setDbValue($rs->fields('Sex_Child'));
			$Number_Of_Employee_Per_Department_Summary->Photo->setDbValue($rs->fields('Photo'));
			$Number_Of_Employee_Per_Department_Summary->Image->setDbValue($rs->fields('Image'));
			$Number_Of_Employee_Per_Department_Summary->Experience->setDbValue($rs->fields('Experience'));
			$Number_Of_Employee_Per_Department_Summary->HardCopy_Shelf_No->setDbValue($rs->fields('HardCopy_Shelf_No'));
			$Number_Of_Employee_Per_Department_Summary->ModifiedBy->setDbValue($rs->fields('ModifiedBy'));
			$Number_Of_Employee_Per_Department_Summary->Telephone->setDbValue($rs->fields('Telephone'));
		} else {
			$Number_Of_Employee_Per_Department_Summary->Auto_ID->setDbValue("");
			$Number_Of_Employee_Per_Department_Summary->ID->setDbValue("");
			$Number_Of_Employee_Per_Department_Summary->FirstName->setDbValue("");
			$Number_Of_Employee_Per_Department_Summary->MiddelName->setDbValue("");
			$Number_Of_Employee_Per_Department_Summary->LastName->setDbValue("");
			$Number_Of_Employee_Per_Department_Summary->Date_Birth->setDbValue("");
			$Number_Of_Employee_Per_Department_Summary->Place_Birth->setDbValue("");
			$Number_Of_Employee_Per_Department_Summary->Age->setDbValue("");
			$Number_Of_Employee_Per_Department_Summary->Sex->setDbValue("");
			$Number_Of_Employee_Per_Department_Summary->zEmail->setDbValue("");
			$Number_Of_Employee_Per_Department_Summary->Date_Employement->setDbValue("");
			$Number_Of_Employee_Per_Department_Summary->Department->setDbValue("");
			$Number_Of_Employee_Per_Department_Summary->Position->setDbValue("");
			$Number_Of_Employee_Per_Department_Summary->Educational_Status->setDbValue("");
			$Number_Of_Employee_Per_Department_Summary->Salary->setDbValue("");
			$Number_Of_Employee_Per_Department_Summary->Martial_Status->setDbValue("");
			$Number_Of_Employee_Per_Department_Summary->Children_number->setDbValue("");
			$Number_Of_Employee_Per_Department_Summary->Name_Child->setDbValue("");
			$Number_Of_Employee_Per_Department_Summary->Age_Child->setDbValue("");
			$Number_Of_Employee_Per_Department_Summary->Sex_Child->setDbValue("");
			$Number_Of_Employee_Per_Department_Summary->Photo->setDbValue("");
			$Number_Of_Employee_Per_Department_Summary->Image->setDbValue("");
			$Number_Of_Employee_Per_Department_Summary->Experience->setDbValue("");
			$Number_Of_Employee_Per_Department_Summary->HardCopy_Shelf_No->setDbValue("");
			$Number_Of_Employee_Per_Department_Summary->ModifiedBy->setDbValue("");
			$Number_Of_Employee_Per_Department_Summary->Telephone->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $Number_Of_Employee_Per_Department_Summary;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$Number_Of_Employee_Per_Department_Summary->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$Number_Of_Employee_Per_Department_Summary->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $Number_Of_Employee_Per_Department_Summary->getStartGroup();
			}
		} else {
			$this->StartGrp = $Number_Of_Employee_Per_Department_Summary->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$Number_Of_Employee_Per_Department_Summary->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$Number_Of_Employee_Per_Department_Summary->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$Number_Of_Employee_Per_Department_Summary->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $Number_Of_Employee_Per_Department_Summary;

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
		global $Number_Of_Employee_Per_Department_Summary;
		$this->StartGrp = 1;
		$Number_Of_Employee_Per_Department_Summary->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $Number_Of_Employee_Per_Department_Summary;
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
			$Number_Of_Employee_Per_Department_Summary->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$Number_Of_Employee_Per_Department_Summary->setStartGroup($this->StartGrp);
		} else {
			if ($Number_Of_Employee_Per_Department_Summary->getGroupPerPage() <> "") {
				$this->DisplayGrps = $Number_Of_Employee_Per_Department_Summary->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $Security;
		global $Number_Of_Employee_Per_Department_Summary;
		if ($Number_Of_Employee_Per_Department_Summary->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($Number_Of_Employee_Per_Department_Summary->SqlSelectCount(), $Number_Of_Employee_Per_Department_Summary->SqlWhere(), $Number_Of_Employee_Per_Department_Summary->SqlGroupBy(), $Number_Of_Employee_Per_Department_Summary->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}
		}

		// Call Row_Rendering event
		$Number_Of_Employee_Per_Department_Summary->Row_Rendering();

		/* --------------------
		'  Render view codes
		' --------------------- */
		if ($Number_Of_Employee_Per_Department_Summary->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// Department
			$Number_Of_Employee_Per_Department_Summary->Department->GroupViewValue = $Number_Of_Employee_Per_Department_Summary->Department->GroupOldValue();
			$Number_Of_Employee_Per_Department_Summary->Department->CellAttrs["class"] = ($Number_Of_Employee_Per_Department_Summary->RowGroupLevel == 1) ? "ewRptGrpSummary1" : "ewRptGrpField1";
			$Number_Of_Employee_Per_Department_Summary->Department->GroupViewValue = ewrpt_DisplayGroupValue($Number_Of_Employee_Per_Department_Summary->Department, $Number_Of_Employee_Per_Department_Summary->Department->GroupViewValue);
		} else {

			// Department
			$Number_Of_Employee_Per_Department_Summary->Department->GroupViewValue = $Number_Of_Employee_Per_Department_Summary->Department->GroupValue();
			$Number_Of_Employee_Per_Department_Summary->Department->CellAttrs["class"] = "ewRptGrpField1";
			$Number_Of_Employee_Per_Department_Summary->Department->GroupViewValue = ewrpt_DisplayGroupValue($Number_Of_Employee_Per_Department_Summary->Department, $Number_Of_Employee_Per_Department_Summary->Department->GroupViewValue);
			if ($Number_Of_Employee_Per_Department_Summary->Department->GroupValue() == $Number_Of_Employee_Per_Department_Summary->Department->GroupOldValue() && !$this->ChkLvlBreak(1))
				$Number_Of_Employee_Per_Department_Summary->Department->GroupViewValue = "&nbsp;";
		}

		// Department
		$Number_Of_Employee_Per_Department_Summary->Department->HrefValue = "";

		// Call Row_Rendered event
		$Number_Of_Employee_Per_Department_Summary->Row_Rendered();
	}

	// Return poup filter
	function GetPopupFilter() {
		global $Number_Of_Employee_Per_Department_Summary;
		$sWrk = "";
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $Number_Of_Employee_Per_Department_Summary;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$Number_Of_Employee_Per_Department_Summary->setOrderBy("");
				$Number_Of_Employee_Per_Department_Summary->setStartGroup(1);
				$Number_Of_Employee_Per_Department_Summary->Department->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$Number_Of_Employee_Per_Department_Summary->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$Number_Of_Employee_Per_Department_Summary->CurrentOrderType = @$_GET["ordertype"];
			$sSortSql = $Number_Of_Employee_Per_Department_Summary->SortSql();
			$Number_Of_Employee_Per_Department_Summary->setOrderBy($sSortSql);
			$Number_Of_Employee_Per_Department_Summary->setStartGroup(1);
		}
		return $Number_Of_Employee_Per_Department_Summary->getOrderBy();
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
