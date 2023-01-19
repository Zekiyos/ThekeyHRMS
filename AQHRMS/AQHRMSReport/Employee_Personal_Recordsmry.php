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
$Employee_Personal_Record = NULL;

//
// Table class for Employee Personal Record
//
class crEmployee_Personal_Record {
	var $TableVar = 'Employee_Personal_Record';
	var $TableName = 'Employee Personal Record';
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
	var $Number_Of_Employee_Per_Department;
	var $Funner_Chart_Number_of__Employee_Per_Department;
	var $Employee_Distribution;
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
	function crEmployee_Personal_Record() {
		global $ReportLanguage;

		// Auto_ID
		$this->Auto_ID = new crField('Employee_Personal_Record', 'Employee Personal Record', 'x_Auto_ID', 'Auto_ID', '`Auto_ID`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->Auto_ID->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['Auto_ID'] =& $this->Auto_ID;
		$this->Auto_ID->DateFilter = "";
		$this->Auto_ID->SqlSelect = "";
		$this->Auto_ID->SqlOrderBy = "";
		$this->Auto_ID->FldGroupByType = "";
		$this->Auto_ID->FldGroupInt = "0";
		$this->Auto_ID->FldGroupSql = "";

		// ID
		$this->ID = new crField('Employee_Personal_Record', 'Employee Personal Record', 'x_ID', 'ID', '`ID`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['ID'] =& $this->ID;
		$this->ID->DateFilter = "";
		$this->ID->SqlSelect = "SELECT DISTINCT `ID` FROM " . $this->SqlFrom();
		$this->ID->SqlOrderBy = "`ID`";
		$this->ID->FldGroupByType = "";
		$this->ID->FldGroupInt = "0";
		$this->ID->FldGroupSql = "";

		// FirstName
		$this->FirstName = new crField('Employee_Personal_Record', 'Employee Personal Record', 'x_FirstName', 'FirstName', '`FirstName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['FirstName'] =& $this->FirstName;
		$this->FirstName->DateFilter = "";
		$this->FirstName->SqlSelect = "SELECT DISTINCT `FirstName` FROM " . $this->SqlFrom();
		$this->FirstName->SqlOrderBy = "`FirstName`";
		$this->FirstName->FldGroupByType = "";
		$this->FirstName->FldGroupInt = "0";
		$this->FirstName->FldGroupSql = "";

		// MiddelName
		$this->MiddelName = new crField('Employee_Personal_Record', 'Employee Personal Record', 'x_MiddelName', 'MiddelName', '`MiddelName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['MiddelName'] =& $this->MiddelName;
		$this->MiddelName->DateFilter = "";
		$this->MiddelName->SqlSelect = "SELECT DISTINCT `MiddelName` FROM " . $this->SqlFrom();
		$this->MiddelName->SqlOrderBy = "`MiddelName`";
		$this->MiddelName->FldGroupByType = "";
		$this->MiddelName->FldGroupInt = "0";
		$this->MiddelName->FldGroupSql = "";

		// LastName
		$this->LastName = new crField('Employee_Personal_Record', 'Employee Personal Record', 'x_LastName', 'LastName', '`LastName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['LastName'] =& $this->LastName;
		$this->LastName->DateFilter = "";
		$this->LastName->SqlSelect = "SELECT DISTINCT `LastName` FROM " . $this->SqlFrom();
		$this->LastName->SqlOrderBy = "`LastName`";
		$this->LastName->FldGroupByType = "";
		$this->LastName->FldGroupInt = "0";
		$this->LastName->FldGroupSql = "";

		// Date_Birth
		$this->Date_Birth = new crField('Employee_Personal_Record', 'Employee Personal Record', 'x_Date_Birth', 'Date_Birth', '`Date_Birth`', 133, EWRPT_DATATYPE_DATE, 5);
		$this->Date_Birth->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateYMD"));
		$this->fields['Date_Birth'] =& $this->Date_Birth;
		$this->Date_Birth->DateFilter = "";
		$this->Date_Birth->SqlSelect = "SELECT DISTINCT `Date_Birth` FROM " . $this->SqlFrom();
		$this->Date_Birth->SqlOrderBy = "`Date_Birth`";
		$this->Date_Birth->FldGroupByType = "";
		$this->Date_Birth->FldGroupInt = "0";
		$this->Date_Birth->FldGroupSql = "";

		// Place_Birth
		$this->Place_Birth = new crField('Employee_Personal_Record', 'Employee Personal Record', 'x_Place_Birth', 'Place_Birth', '`Place_Birth`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Place_Birth'] =& $this->Place_Birth;
		$this->Place_Birth->DateFilter = "";
		$this->Place_Birth->SqlSelect = "SELECT DISTINCT `Place_Birth` FROM " . $this->SqlFrom();
		$this->Place_Birth->SqlOrderBy = "`Place_Birth`";
		$this->Place_Birth->FldGroupByType = "";
		$this->Place_Birth->FldGroupInt = "0";
		$this->Place_Birth->FldGroupSql = "";

		// Age
		$this->Age = new crField('Employee_Personal_Record', 'Employee Personal Record', 'x_Age', 'Age', '`Age`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->Age->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['Age'] =& $this->Age;
		$this->Age->DateFilter = "";
		$this->Age->SqlSelect = "SELECT DISTINCT `Age` FROM " . $this->SqlFrom();
		$this->Age->SqlOrderBy = "`Age`";
		$this->Age->FldGroupByType = "";
		$this->Age->FldGroupInt = "0";
		$this->Age->FldGroupSql = "";

		// Sex
		$this->Sex = new crField('Employee_Personal_Record', 'Employee Personal Record', 'x_Sex', 'Sex', '`Sex`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Sex'] =& $this->Sex;
		$this->Sex->DateFilter = "";
		$this->Sex->SqlSelect = "SELECT DISTINCT `Sex` FROM " . $this->SqlFrom();
		$this->Sex->SqlOrderBy = "`Sex`";
		$this->Sex->FldGroupByType = "";
		$this->Sex->FldGroupInt = "0";
		$this->Sex->FldGroupSql = "";

		// Email
		$this->zEmail = new crField('Employee_Personal_Record', 'Employee Personal Record', 'x_zEmail', 'Email', '`Email`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['zEmail'] =& $this->zEmail;
		$this->zEmail->DateFilter = "";
		$this->zEmail->SqlSelect = "SELECT DISTINCT `Email` FROM " . $this->SqlFrom();
		$this->zEmail->SqlOrderBy = "`Email`";
		$this->zEmail->FldGroupByType = "";
		$this->zEmail->FldGroupInt = "0";
		$this->zEmail->FldGroupSql = "";

		// Date_Employement
		$this->Date_Employement = new crField('Employee_Personal_Record', 'Employee Personal Record', 'x_Date_Employement', 'Date_Employement', '`Date_Employement`', 133, EWRPT_DATATYPE_DATE, 5);
		$this->Date_Employement->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateYMD"));
		$this->fields['Date_Employement'] =& $this->Date_Employement;
		$this->Date_Employement->DateFilter = "";
		$this->Date_Employement->SqlSelect = "SELECT DISTINCT `Date_Employement` FROM " . $this->SqlFrom();
		$this->Date_Employement->SqlOrderBy = "`Date_Employement`";
		$this->Date_Employement->FldGroupByType = "";
		$this->Date_Employement->FldGroupInt = "0";
		$this->Date_Employement->FldGroupSql = "";

		// Department
		$this->Department = new crField('Employee_Personal_Record', 'Employee Personal Record', 'x_Department', 'Department', '`Department`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->Department->GroupingFieldId = 1;
		$this->fields['Department'] =& $this->Department;
		$this->Department->DateFilter = "";
		$this->Department->SqlSelect = "SELECT DISTINCT `Department` FROM " . $this->SqlFrom();
		$this->Department->SqlOrderBy = "`Department`";
		$this->Department->FldGroupByType = "";
		$this->Department->FldGroupInt = "0";
		$this->Department->FldGroupSql = "";

		// Position
		$this->Position = new crField('Employee_Personal_Record', 'Employee Personal Record', 'x_Position', 'Position', '`Position`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Position'] =& $this->Position;
		$this->Position->DateFilter = "";
		$this->Position->SqlSelect = "SELECT DISTINCT `Position` FROM " . $this->SqlFrom();
		$this->Position->SqlOrderBy = "`Position`";
		$this->Position->FldGroupByType = "";
		$this->Position->FldGroupInt = "0";
		$this->Position->FldGroupSql = "";

		// Educational_Status
		$this->Educational_Status = new crField('Employee_Personal_Record', 'Employee Personal Record', 'x_Educational_Status', 'Educational_Status', '`Educational_Status`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Educational_Status'] =& $this->Educational_Status;
		$this->Educational_Status->DateFilter = "";
		$this->Educational_Status->SqlSelect = "SELECT DISTINCT `Educational_Status` FROM " . $this->SqlFrom();
		$this->Educational_Status->SqlOrderBy = "`Educational_Status`";
		$this->Educational_Status->FldGroupByType = "";
		$this->Educational_Status->FldGroupInt = "0";
		$this->Educational_Status->FldGroupSql = "";

		// Salary
		$this->Salary = new crField('Employee_Personal_Record', 'Employee Personal Record', 'x_Salary', 'Salary', '`Salary`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->Salary->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['Salary'] =& $this->Salary;
		$this->Salary->DateFilter = "";
		$this->Salary->SqlSelect = "SELECT DISTINCT `Salary` FROM " . $this->SqlFrom();
		$this->Salary->SqlOrderBy = "`Salary`";
		$this->Salary->FldGroupByType = "";
		$this->Salary->FldGroupInt = "0";
		$this->Salary->FldGroupSql = "";

		// Martial_Status
		$this->Martial_Status = new crField('Employee_Personal_Record', 'Employee Personal Record', 'x_Martial_Status', 'Martial_Status', '`Martial_Status`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Martial_Status'] =& $this->Martial_Status;
		$this->Martial_Status->DateFilter = "";
		$this->Martial_Status->SqlSelect = "SELECT DISTINCT `Martial_Status` FROM " . $this->SqlFrom();
		$this->Martial_Status->SqlOrderBy = "`Martial_Status`";
		$this->Martial_Status->FldGroupByType = "";
		$this->Martial_Status->FldGroupInt = "0";
		$this->Martial_Status->FldGroupSql = "";

		// Children_number
		$this->Children_number = new crField('Employee_Personal_Record', 'Employee Personal Record', 'x_Children_number', 'Children_number', '`Children_number`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->Children_number->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['Children_number'] =& $this->Children_number;
		$this->Children_number->DateFilter = "";
		$this->Children_number->SqlSelect = "SELECT DISTINCT `Children_number` FROM " . $this->SqlFrom();
		$this->Children_number->SqlOrderBy = "`Children_number`";
		$this->Children_number->FldGroupByType = "";
		$this->Children_number->FldGroupInt = "0";
		$this->Children_number->FldGroupSql = "";

		// Name_Child
		$this->Name_Child = new crField('Employee_Personal_Record', 'Employee Personal Record', 'x_Name_Child', 'Name_Child', '`Name_Child`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Name_Child'] =& $this->Name_Child;
		$this->Name_Child->DateFilter = "";
		$this->Name_Child->SqlSelect = "SELECT DISTINCT `Name_Child` FROM " . $this->SqlFrom();
		$this->Name_Child->SqlOrderBy = "`Name_Child`";
		$this->Name_Child->FldGroupByType = "";
		$this->Name_Child->FldGroupInt = "0";
		$this->Name_Child->FldGroupSql = "";

		// Age_Child
		$this->Age_Child = new crField('Employee_Personal_Record', 'Employee Personal Record', 'x_Age_Child', 'Age_Child', '`Age_Child`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Age_Child'] =& $this->Age_Child;
		$this->Age_Child->DateFilter = "";
		$this->Age_Child->SqlSelect = "SELECT DISTINCT `Age_Child` FROM " . $this->SqlFrom();
		$this->Age_Child->SqlOrderBy = "`Age_Child`";
		$this->Age_Child->FldGroupByType = "";
		$this->Age_Child->FldGroupInt = "0";
		$this->Age_Child->FldGroupSql = "";

		// Sex_Child
		$this->Sex_Child = new crField('Employee_Personal_Record', 'Employee Personal Record', 'x_Sex_Child', 'Sex_Child', '`Sex_Child`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Sex_Child'] =& $this->Sex_Child;
		$this->Sex_Child->DateFilter = "";
		$this->Sex_Child->SqlSelect = "SELECT DISTINCT `Sex_Child` FROM " . $this->SqlFrom();
		$this->Sex_Child->SqlOrderBy = "`Sex_Child`";
		$this->Sex_Child->FldGroupByType = "";
		$this->Sex_Child->FldGroupInt = "0";
		$this->Sex_Child->FldGroupSql = "";

		// Photo
		$this->Photo = new crField('Employee_Personal_Record', 'Employee Personal Record', 'x_Photo', 'Photo', '`Photo`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Photo'] =& $this->Photo;
		$this->Photo->DateFilter = "";
		$this->Photo->SqlSelect = "SELECT DISTINCT `Photo` FROM " . $this->SqlFrom();
		$this->Photo->SqlOrderBy = "`Photo`";
		$this->Photo->FldGroupByType = "";
		$this->Photo->FldGroupInt = "0";
		$this->Photo->FldGroupSql = "";

		// Image
		$this->Image = new crField('Employee_Personal_Record', 'Employee Personal Record', 'x_Image', 'Image', '`Image`', 205, EWRPT_DATATYPE_BLOB, -1);
		$this->fields['Image'] =& $this->Image;
		$this->Image->DateFilter = "";
		$this->Image->SqlSelect = "";
		$this->Image->SqlOrderBy = "";
		$this->Image->FldGroupByType = "";
		$this->Image->FldGroupInt = "0";
		$this->Image->FldGroupSql = "";

		// Experience
		$this->Experience = new crField('Employee_Personal_Record', 'Employee Personal Record', 'x_Experience', 'Experience', '`Experience`', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['Experience'] =& $this->Experience;
		$this->Experience->DateFilter = "";
		$this->Experience->SqlSelect = "";
		$this->Experience->SqlOrderBy = "";
		$this->Experience->FldGroupByType = "";
		$this->Experience->FldGroupInt = "0";
		$this->Experience->FldGroupSql = "";

		// HardCopy_Shelf_No
		$this->HardCopy_Shelf_No = new crField('Employee_Personal_Record', 'Employee Personal Record', 'x_HardCopy_Shelf_No', 'HardCopy_Shelf_No', '`HardCopy_Shelf_No`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['HardCopy_Shelf_No'] =& $this->HardCopy_Shelf_No;
		$this->HardCopy_Shelf_No->DateFilter = "";
		$this->HardCopy_Shelf_No->SqlSelect = "";
		$this->HardCopy_Shelf_No->SqlOrderBy = "";
		$this->HardCopy_Shelf_No->FldGroupByType = "";
		$this->HardCopy_Shelf_No->FldGroupInt = "0";
		$this->HardCopy_Shelf_No->FldGroupSql = "";

		// ModifiedBy
		$this->ModifiedBy = new crField('Employee_Personal_Record', 'Employee Personal Record', 'x_ModifiedBy', 'ModifiedBy', '`ModifiedBy`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['ModifiedBy'] =& $this->ModifiedBy;
		$this->ModifiedBy->DateFilter = "";
		$this->ModifiedBy->SqlSelect = "";
		$this->ModifiedBy->SqlOrderBy = "";
		$this->ModifiedBy->FldGroupByType = "";
		$this->ModifiedBy->FldGroupInt = "0";
		$this->ModifiedBy->FldGroupSql = "";

		// Telephone
		$this->Telephone = new crField('Employee_Personal_Record', 'Employee Personal Record', 'x_Telephone', 'Telephone', '`Telephone`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Telephone'] =& $this->Telephone;
		$this->Telephone->DateFilter = "";
		$this->Telephone->SqlSelect = "";
		$this->Telephone->SqlOrderBy = "";
		$this->Telephone->FldGroupByType = "";
		$this->Telephone->FldGroupInt = "0";
		$this->Telephone->FldGroupSql = "";

		// Number Of Employee Per Department
		$this->Number_Of_Employee_Per_Department = new crChart('Employee_Personal_Record', 'Employee Personal Record', 'Number_Of_Employee_Per_Department', 'Number Of Employee Per Department', 'Department', 'ID', '', 5, 'COUNT', 2600, 500);
		$this->Number_Of_Employee_Per_Department->SqlSelect = "SELECT `Department`, '', COUNT(`ID`) FROM ";
		$this->Number_Of_Employee_Per_Department->SqlGroupBy = "`Department`";
		$this->Number_Of_Employee_Per_Department->SqlOrderBy = "";
		$this->Number_Of_Employee_Per_Department->SeriesDateType = "";

		// Funner Chart Number of  Employee Per Department
		$this->Funner_Chart_Number_of__Employee_Per_Department = new crChart('Employee_Personal_Record', 'Employee Personal Record', 'Funner_Chart_Number_of__Employee_Per_Department', 'Funner Chart Number of  Employee Per Department', 'Department', 'ID', '', 22, 'COUNT', 600, 400);
		$this->Funner_Chart_Number_of__Employee_Per_Department->SqlSelect = "SELECT `Department`, '', COUNT(`ID`) FROM ";
		$this->Funner_Chart_Number_of__Employee_Per_Department->SqlGroupBy = "`Department`";
		$this->Funner_Chart_Number_of__Employee_Per_Department->SqlOrderBy = "`Department` ASC";
		$this->Funner_Chart_Number_of__Employee_Per_Department->SeriesDateType = "";

		// Employee Distribution
		$this->Employee_Distribution = new crChart('Employee_Personal_Record', 'Employee Personal Record', 'Employee_Distribution', 'Employee Distribution', 'Department', 'ID', '', 6, 'COUNT', 1050, 1000);
		$this->Employee_Distribution->SqlSelect = "SELECT `Department`, '', COUNT(`ID`) FROM ";
		$this->Employee_Distribution->SqlGroupBy = "`Department`";
		$this->Employee_Distribution->SqlOrderBy = "`Department` ASC";
		$this->Employee_Distribution->SeriesDateType = "";
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
$Employee_Personal_Record_summary = new crEmployee_Personal_Record_summary();
$Page =& $Employee_Personal_Record_summary;

// Page init
$Employee_Personal_Record_summary->Page_Init();

// Page main
$Employee_Personal_Record_summary->Page_Main();
?>
<?php include "phprptinc/header.php"; ?>
<?php if ($Employee_Personal_Record->Export == "") { ?>
<script type="text/javascript">

// Create page object
var Employee_Personal_Record_summary = new ewrpt_Page("Employee_Personal_Record_summary");

// page properties
Employee_Personal_Record_summary.PageID = "summary"; // page ID
Employee_Personal_Record_summary.FormID = "fEmployee_Personal_Recordsummaryfilter"; // form ID
var EWRPT_PAGE_ID = Employee_Personal_Record_summary.PageID;

// extend page with ValidateForm function
Employee_Personal_Record_summary.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var elm = fobj.sv1_Date_Birth;
	if (elm && !ewrpt_CheckDate(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Employee_Personal_Record->Date_Birth->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv2_Date_Birth;
	if (elm && !ewrpt_CheckDate(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Employee_Personal_Record->Date_Birth->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv1_Age;
	if (elm && !ewrpt_CheckInteger(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Employee_Personal_Record->Age->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv1_Date_Employement;
	if (elm && !ewrpt_CheckDate(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Employee_Personal_Record->Date_Employement->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv2_Date_Employement;
	if (elm && !ewrpt_CheckDate(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Employee_Personal_Record->Date_Employement->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv1_Salary;
	if (elm && !ewrpt_CheckInteger(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Employee_Personal_Record->Salary->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv1_Children_number;
	if (elm && !ewrpt_CheckInteger(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Employee_Personal_Record->Children_number->FldErrMsg()) ?>"))
			return false;
	}

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj)) return false;
	return true;
}

// extend page with Form_CustomValidate function
Employee_Personal_Record_summary.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EWRPT_CLIENT_VALIDATE) { ?>
Employee_Personal_Record_summary.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
Employee_Personal_Record_summary.ValidateRequired = false; // no JavaScript validation
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
<?php $Employee_Personal_Record_summary->ShowPageHeader(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php $Employee_Personal_Record_summary->ShowMessage(); ?>
<?php if ($Employee_Personal_Record->Export == "" || $Employee_Personal_Record->Export == "print" || $Employee_Personal_Record->Export == "email") { ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php } ?>
<?php if ($Employee_Personal_Record->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
<?php $jsdata = ewrpt_GetJsData($Employee_Personal_Record->Department, $Employee_Personal_Record->Department->FldType); ?>
ewrpt_CreatePopup("Employee_Personal_Record_Department", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Employee_Personal_Record->ID, $Employee_Personal_Record->ID->FldType); ?>
ewrpt_CreatePopup("Employee_Personal_Record_ID", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Employee_Personal_Record->FirstName, $Employee_Personal_Record->FirstName->FldType); ?>
ewrpt_CreatePopup("Employee_Personal_Record_FirstName", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Employee_Personal_Record->MiddelName, $Employee_Personal_Record->MiddelName->FldType); ?>
ewrpt_CreatePopup("Employee_Personal_Record_MiddelName", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Employee_Personal_Record->LastName, $Employee_Personal_Record->LastName->FldType); ?>
ewrpt_CreatePopup("Employee_Personal_Record_LastName", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Employee_Personal_Record->Date_Birth, $Employee_Personal_Record->Date_Birth->FldType); ?>
ewrpt_CreatePopup("Employee_Personal_Record_Date_Birth", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Employee_Personal_Record->Place_Birth, $Employee_Personal_Record->Place_Birth->FldType); ?>
ewrpt_CreatePopup("Employee_Personal_Record_Place_Birth", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Employee_Personal_Record->Age, $Employee_Personal_Record->Age->FldType); ?>
ewrpt_CreatePopup("Employee_Personal_Record_Age", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Employee_Personal_Record->Sex, $Employee_Personal_Record->Sex->FldType); ?>
ewrpt_CreatePopup("Employee_Personal_Record_Sex", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Employee_Personal_Record->zEmail, $Employee_Personal_Record->zEmail->FldType); ?>
ewrpt_CreatePopup("Employee_Personal_Record_zEmail", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Employee_Personal_Record->Date_Employement, $Employee_Personal_Record->Date_Employement->FldType); ?>
ewrpt_CreatePopup("Employee_Personal_Record_Date_Employement", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Employee_Personal_Record->Position, $Employee_Personal_Record->Position->FldType); ?>
ewrpt_CreatePopup("Employee_Personal_Record_Position", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Employee_Personal_Record->Educational_Status, $Employee_Personal_Record->Educational_Status->FldType); ?>
ewrpt_CreatePopup("Employee_Personal_Record_Educational_Status", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Employee_Personal_Record->Salary, $Employee_Personal_Record->Salary->FldType); ?>
ewrpt_CreatePopup("Employee_Personal_Record_Salary", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Employee_Personal_Record->Martial_Status, $Employee_Personal_Record->Martial_Status->FldType); ?>
ewrpt_CreatePopup("Employee_Personal_Record_Martial_Status", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Employee_Personal_Record->Children_number, $Employee_Personal_Record->Children_number->FldType); ?>
ewrpt_CreatePopup("Employee_Personal_Record_Children_number", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Employee_Personal_Record->Name_Child, $Employee_Personal_Record->Name_Child->FldType); ?>
ewrpt_CreatePopup("Employee_Personal_Record_Name_Child", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Employee_Personal_Record->Age_Child, $Employee_Personal_Record->Age_Child->FldType); ?>
ewrpt_CreatePopup("Employee_Personal_Record_Age_Child", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Employee_Personal_Record->Sex_Child, $Employee_Personal_Record->Sex_Child->FldType); ?>
ewrpt_CreatePopup("Employee_Personal_Record_Sex_Child", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Employee_Personal_Record->Photo, $Employee_Personal_Record->Photo->FldType); ?>
ewrpt_CreatePopup("Employee_Personal_Record_Photo", [<?php echo $jsdata ?>]);
</script>
<div id="Employee_Personal_Record_Department_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Employee_Personal_Record_ID_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Employee_Personal_Record_FirstName_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Employee_Personal_Record_MiddelName_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Employee_Personal_Record_LastName_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Employee_Personal_Record_Date_Birth_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Employee_Personal_Record_Place_Birth_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Employee_Personal_Record_Age_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Employee_Personal_Record_Sex_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Employee_Personal_Record_zEmail_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Employee_Personal_Record_Date_Employement_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Employee_Personal_Record_Position_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Employee_Personal_Record_Educational_Status_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Employee_Personal_Record_Salary_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Employee_Personal_Record_Martial_Status_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Employee_Personal_Record_Children_number_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Employee_Personal_Record_Name_Child_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Employee_Personal_Record_Age_Child_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Employee_Personal_Record_Sex_Child_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Employee_Personal_Record_Photo_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<?php } ?>
<?php if ($Employee_Personal_Record->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<?php if ($Employee_Personal_Record->Export == "" || $Employee_Personal_Record->Export == "print" || $Employee_Personal_Record->Export == "email") { ?>
<?php } ?>
<?php echo $Employee_Personal_Record->TableCaption() ?>
<?php if ($Employee_Personal_Record->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $Employee_Personal_Record_summary->ExportPrintUrl ?>"><?php echo $ReportLanguage->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $Employee_Personal_Record_summary->ExportExcelUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $Employee_Personal_Record_summary->ExportWordUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToWord") ?></a>
<?php if ($Employee_Personal_Record_summary->FilterApplied) { ?>
&nbsp;&nbsp;<a href="Employee_Personal_Recordsmry.php?cmd=reset"><?php echo $ReportLanguage->Phrase("ResetAllFilter") ?></a>
<?php } ?>
<?php } ?>
<br /><br />
<?php if ($Employee_Personal_Record->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($Employee_Personal_Record->Export == "" || $Employee_Personal_Record->Export == "print" || $Employee_Personal_Record->Export == "email") { ?>
<?php } ?>
<?php if ($Employee_Personal_Record->Export == "") { ?>
	</div></td>
	<!-- Left Container (End) -->
	<!-- Center Container - Report (Begin) -->
	<td style="vertical-align: top;" class="ewPadding"><div id="ewCenter" class="phpreportmaker">
	<!-- center slot -->
<?php } ?>
<!-- summary report starts -->
<div id="report_summary">
<?php if ($Employee_Personal_Record->Export == "") { ?>
<?php
if ($Employee_Personal_Record->FilterPanelOption == 2 || ($Employee_Personal_Record->FilterPanelOption == 3 && $Employee_Personal_Record_summary->FilterApplied) || $Employee_Personal_Record_summary->Filter == "0=101") {
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
<form name="fEmployee_Personal_Recordsummaryfilter" id="fEmployee_Personal_Recordsummaryfilter" action="Employee_Personal_Recordsmry.php" class="ewForm" onsubmit="return Employee_Personal_Record_summary.ValidateForm(this);">
<table class="ewRptExtFilter">
	<tr>
		<td><span class="phpreportmaker"><?php echo $Employee_Personal_Record->ID->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_ID" id="so1_ID" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_ID" id="sv1_ID" size="30" maxlength="10" value="<?php echo ewrpt_HtmlEncode($Employee_Personal_Record->ID->SearchValue) ?>"<?php echo ($Employee_Personal_Record_summary->ClearExtFilter == 'Employee_Personal_Record_ID') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Employee_Personal_Record->FirstName->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_FirstName" id="so1_FirstName" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_FirstName" id="sv1_FirstName" size="30" maxlength="20" value="<?php echo ewrpt_HtmlEncode($Employee_Personal_Record->FirstName->SearchValue) ?>"<?php echo ($Employee_Personal_Record_summary->ClearExtFilter == 'Employee_Personal_Record_FirstName') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Employee_Personal_Record->MiddelName->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_MiddelName" id="so1_MiddelName" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_MiddelName" id="sv1_MiddelName" size="30" maxlength="20" value="<?php echo ewrpt_HtmlEncode($Employee_Personal_Record->MiddelName->SearchValue) ?>"<?php echo ($Employee_Personal_Record_summary->ClearExtFilter == 'Employee_Personal_Record_MiddelName') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Employee_Personal_Record->LastName->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_LastName" id="so1_LastName" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_LastName" id="sv1_LastName" size="30" maxlength="20" value="<?php echo ewrpt_HtmlEncode($Employee_Personal_Record->LastName->SearchValue) ?>"<?php echo ($Employee_Personal_Record_summary->ClearExtFilter == 'Employee_Personal_Record_LastName') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Employee_Personal_Record->Date_Birth->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("BETWEEN"); ?><input type="hidden" name="so1_Date_Birth" id="so1_Date_Birth" value="BETWEEN"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_Date_Birth" id="sv1_Date_Birth" value="<?php echo ewrpt_HtmlEncode($Employee_Personal_Record->Date_Birth->SearchValue) ?>"<?php echo ($Employee_Personal_Record_summary->ClearExtFilter == 'Employee_Personal_Record_Date_Birth') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
				<td><span class="ewRptSearchOpr" id="btw1_Date_Birth" name="btw1_Date_Birth">&nbsp;<?php echo $ReportLanguage->Phrase("AND") ?>&nbsp;</span></td>
				<td><span class="phpreportmaker" id="btw1_Date_Birth" name="btw1_Date_Birth">
<input type="text" name="sv2_Date_Birth" id="sv2_Date_Birth" value="<?php echo ewrpt_HtmlEncode($Employee_Personal_Record->Date_Birth->SearchValue2) ?>"<?php echo ($Employee_Personal_Record_summary->ClearExtFilter == 'Employee_Personal_Record_Date_Birth') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Employee_Personal_Record->Place_Birth->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_Place_Birth" id="so1_Place_Birth" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_Place_Birth" id="sv1_Place_Birth" size="30" maxlength="20" value="<?php echo ewrpt_HtmlEncode($Employee_Personal_Record->Place_Birth->SearchValue) ?>"<?php echo ($Employee_Personal_Record_summary->ClearExtFilter == 'Employee_Personal_Record_Place_Birth') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Employee_Personal_Record->Age->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><select name="so1_Age" id="so1_Age" onchange="ewrpt_SrchOprChanged('so1_Age')"><option value="="<?php if ($Employee_Personal_Record->Age->SearchOperator == "=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("="); ?></option><option value="<>"<?php if ($Employee_Personal_Record->Age->SearchOperator == "<>") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<>"); ?></option><option value="<"<?php if ($Employee_Personal_Record->Age->SearchOperator == "<") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<"); ?></option><option value="<="<?php if ($Employee_Personal_Record->Age->SearchOperator == "<=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<="); ?></option><option value=">"<?php if ($Employee_Personal_Record->Age->SearchOperator == ">") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase(">"); ?></option><option value=">="<?php if ($Employee_Personal_Record->Age->SearchOperator == ">=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase(">="); ?></option><option value="BETWEEN"<?php if ($Employee_Personal_Record->Age->SearchOperator == "BETWEEN") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("BETWEEN"); ?></option></select></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_Age" id="sv1_Age" size="30" value="<?php echo ewrpt_HtmlEncode($Employee_Personal_Record->Age->SearchValue) ?>"<?php echo ($Employee_Personal_Record_summary->ClearExtFilter == 'Employee_Personal_Record_Age') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
				<td><span class="ewRptSearchOpr" style="display: none" id="btw1_Age" name="btw1_Age">&nbsp;<?php echo $ReportLanguage->Phrase("AND") ?>&nbsp;</span></td>
				<td><span class="phpreportmaker" style="display: none" id="btw1_Age" name="btw1_Age">
<input type="text" name="sv2_Age" id="sv2_Age" size="30" value="<?php echo ewrpt_HtmlEncode($Employee_Personal_Record->Age->SearchValue2) ?>"<?php echo ($Employee_Personal_Record_summary->ClearExtFilter == 'Employee_Personal_Record_Age') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Employee_Personal_Record->Sex->FldCaption() ?></span></td>
		<td></td>
		<td colspan="4"><span class="ewRptSearchOpr">
<?php

// Popup filter
$cntf = is_array($Employee_Personal_Record->Sex->CustomFilters) ? count($Employee_Personal_Record->Sex->CustomFilters) : 0;
$cntd = is_array($Employee_Personal_Record->Sex->DropDownList) ? count($Employee_Personal_Record->Sex->DropDownList) : 0;
$totcnt = $cntf + $cntd;
$wrkcnt = 0;
	for ($i = 0; $i < $cntf; $i++) {
		if ($Employee_Personal_Record->Sex->CustomFilters[$i]->FldName == 'Sex') {
?>
		<?php echo ewrpt_RepeatColumnTable($totcnt, $wrkcnt, 5, 1) ?>
<label><input type="checkbox" name="$Employee_Personal_Record->Sex->DropDownValue[]" id="$Employee_Personal_Record->Sex->DropDownValue[]" value="<?php echo "@@" . $Employee_Personal_Record->Sex->CustomFilters[$i]->FilterName ?>"<?php if (ewrpt_MatchedFilterValue($Employee_Personal_Record->Sex->DropDownValue, "@@" . $Employee_Personal_Record->Sex->CustomFilters[$i]->FilterName)) echo " checked=\"checked\"" ?>><?php echo $Employee_Personal_Record->Sex->CustomFilters[$i]->DisplayName ?></label>
<?php echo ewrpt_RepeatColumnTable($totcnt, $wrkcnt, 5, 2) ?>
<?php
		}
		$wrkcnt += 1;
	}

//}
	for ($i = 0; $i < $cntd; $i++) {
?>
		<?php echo ewrpt_RepeatColumnTable($totcnt, $wrkcnt, 5, 1) ?>
<label><input type="checkbox" name="sv_Sex[]" id="sv_Sex[]" value="<?php echo $Employee_Personal_Record->Sex->DropDownList[$i] ?>"<?php if (ewrpt_MatchedFilterValue($Employee_Personal_Record->Sex->DropDownValue, $Employee_Personal_Record->Sex->DropDownList[$i])) echo " checked=\"checked\"" ?>><?php echo ewrpt_DropDownDisplayValue($Employee_Personal_Record->Sex->DropDownList[$i], "", 0) ?></label>
<?php echo ewrpt_RepeatColumnTable($totcnt, $wrkcnt, 5, 2) ?>
<?php
		$wrkcnt += 1;
	}

//}
?>
		</span></td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Employee_Personal_Record->zEmail->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_zEmail" id="so1_zEmail" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_zEmail" id="sv1_zEmail" size="30" maxlength="30" value="<?php echo ewrpt_HtmlEncode($Employee_Personal_Record->zEmail->SearchValue) ?>"<?php echo ($Employee_Personal_Record_summary->ClearExtFilter == 'Employee_Personal_Record_zEmail') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Employee_Personal_Record->Date_Employement->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("BETWEEN"); ?><input type="hidden" name="so1_Date_Employement" id="so1_Date_Employement" value="BETWEEN"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_Date_Employement" id="sv1_Date_Employement" value="<?php echo ewrpt_HtmlEncode($Employee_Personal_Record->Date_Employement->SearchValue) ?>"<?php echo ($Employee_Personal_Record_summary->ClearExtFilter == 'Employee_Personal_Record_Date_Employement') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
				<td><span class="ewRptSearchOpr" id="btw1_Date_Employement" name="btw1_Date_Employement">&nbsp;<?php echo $ReportLanguage->Phrase("AND") ?>&nbsp;</span></td>
				<td><span class="phpreportmaker" id="btw1_Date_Employement" name="btw1_Date_Employement">
<input type="text" name="sv2_Date_Employement" id="sv2_Date_Employement" value="<?php echo ewrpt_HtmlEncode($Employee_Personal_Record->Date_Employement->SearchValue2) ?>"<?php echo ($Employee_Personal_Record_summary->ClearExtFilter == 'Employee_Personal_Record_Date_Employement') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Employee_Personal_Record->Department->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_Department" id="so1_Department" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_Department" id="sv1_Department" size="30" maxlength="50" value="<?php echo ewrpt_HtmlEncode($Employee_Personal_Record->Department->SearchValue) ?>"<?php echo ($Employee_Personal_Record_summary->ClearExtFilter == 'Employee_Personal_Record_Department') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Employee_Personal_Record->Position->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_Position" id="so1_Position" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_Position" id="sv1_Position" size="30" maxlength="50" value="<?php echo ewrpt_HtmlEncode($Employee_Personal_Record->Position->SearchValue) ?>"<?php echo ($Employee_Personal_Record_summary->ClearExtFilter == 'Employee_Personal_Record_Position') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Employee_Personal_Record->Educational_Status->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_Educational_Status" id="so1_Educational_Status" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_Educational_Status" id="sv1_Educational_Status" size="30" maxlength="50" value="<?php echo ewrpt_HtmlEncode($Employee_Personal_Record->Educational_Status->SearchValue) ?>"<?php echo ($Employee_Personal_Record_summary->ClearExtFilter == 'Employee_Personal_Record_Educational_Status') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Employee_Personal_Record->Salary->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><select name="so1_Salary" id="so1_Salary" onchange="ewrpt_SrchOprChanged('so1_Salary')"><option value="="<?php if ($Employee_Personal_Record->Salary->SearchOperator == "=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("="); ?></option><option value="<>"<?php if ($Employee_Personal_Record->Salary->SearchOperator == "<>") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<>"); ?></option><option value="<"<?php if ($Employee_Personal_Record->Salary->SearchOperator == "<") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<"); ?></option><option value="<="<?php if ($Employee_Personal_Record->Salary->SearchOperator == "<=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<="); ?></option><option value=">"<?php if ($Employee_Personal_Record->Salary->SearchOperator == ">") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase(">"); ?></option><option value=">="<?php if ($Employee_Personal_Record->Salary->SearchOperator == ">=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase(">="); ?></option><option value="BETWEEN"<?php if ($Employee_Personal_Record->Salary->SearchOperator == "BETWEEN") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("BETWEEN"); ?></option></select></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_Salary" id="sv1_Salary" size="30" value="<?php echo ewrpt_HtmlEncode($Employee_Personal_Record->Salary->SearchValue) ?>"<?php echo ($Employee_Personal_Record_summary->ClearExtFilter == 'Employee_Personal_Record_Salary') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
				<td><span class="ewRptSearchOpr" style="display: none" id="btw1_Salary" name="btw1_Salary">&nbsp;<?php echo $ReportLanguage->Phrase("AND") ?>&nbsp;</span></td>
				<td><span class="phpreportmaker" style="display: none" id="btw1_Salary" name="btw1_Salary">
<input type="text" name="sv2_Salary" id="sv2_Salary" size="30" value="<?php echo ewrpt_HtmlEncode($Employee_Personal_Record->Salary->SearchValue2) ?>"<?php echo ($Employee_Personal_Record_summary->ClearExtFilter == 'Employee_Personal_Record_Salary') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Employee_Personal_Record->Martial_Status->FldCaption() ?></span></td>
		<td></td>
		<td colspan="4"><span class="ewRptSearchOpr">
<?php

// Popup filter
$cntf = is_array($Employee_Personal_Record->Martial_Status->CustomFilters) ? count($Employee_Personal_Record->Martial_Status->CustomFilters) : 0;
$cntd = is_array($Employee_Personal_Record->Martial_Status->DropDownList) ? count($Employee_Personal_Record->Martial_Status->DropDownList) : 0;
$totcnt = $cntf + $cntd;
$wrkcnt = 0;
	for ($i = 0; $i < $cntf; $i++) {
		if ($Employee_Personal_Record->Martial_Status->CustomFilters[$i]->FldName == 'Martial_Status') {
?>
		<?php echo ewrpt_RepeatColumnTable($totcnt, $wrkcnt, 5, 1) ?>
<label><input type="checkbox" name="$Employee_Personal_Record->Martial_Status->DropDownValue[]" id="$Employee_Personal_Record->Martial_Status->DropDownValue[]" value="<?php echo "@@" . $Employee_Personal_Record->Martial_Status->CustomFilters[$i]->FilterName ?>"<?php if (ewrpt_MatchedFilterValue($Employee_Personal_Record->Martial_Status->DropDownValue, "@@" . $Employee_Personal_Record->Martial_Status->CustomFilters[$i]->FilterName)) echo " checked=\"checked\"" ?>><?php echo $Employee_Personal_Record->Martial_Status->CustomFilters[$i]->DisplayName ?></label>
<?php echo ewrpt_RepeatColumnTable($totcnt, $wrkcnt, 5, 2) ?>
<?php
		}
		$wrkcnt += 1;
	}

//}
	for ($i = 0; $i < $cntd; $i++) {
?>
		<?php echo ewrpt_RepeatColumnTable($totcnt, $wrkcnt, 5, 1) ?>
<label><input type="checkbox" name="sv_Martial_Status[]" id="sv_Martial_Status[]" value="<?php echo $Employee_Personal_Record->Martial_Status->DropDownList[$i] ?>"<?php if (ewrpt_MatchedFilterValue($Employee_Personal_Record->Martial_Status->DropDownValue, $Employee_Personal_Record->Martial_Status->DropDownList[$i])) echo " checked=\"checked\"" ?>><?php echo ewrpt_DropDownDisplayValue($Employee_Personal_Record->Martial_Status->DropDownList[$i], "", 0) ?></label>
<?php echo ewrpt_RepeatColumnTable($totcnt, $wrkcnt, 5, 2) ?>
<?php
		$wrkcnt += 1;
	}

//}
?>
		</span></td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Employee_Personal_Record->Children_number->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><select name="so1_Children_number" id="so1_Children_number" onchange="ewrpt_SrchOprChanged('so1_Children_number')"><option value="="<?php if ($Employee_Personal_Record->Children_number->SearchOperator == "=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("="); ?></option><option value="<>"<?php if ($Employee_Personal_Record->Children_number->SearchOperator == "<>") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<>"); ?></option><option value="<"<?php if ($Employee_Personal_Record->Children_number->SearchOperator == "<") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<"); ?></option><option value="<="<?php if ($Employee_Personal_Record->Children_number->SearchOperator == "<=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("<="); ?></option><option value=">"<?php if ($Employee_Personal_Record->Children_number->SearchOperator == ">") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase(">"); ?></option><option value=">="<?php if ($Employee_Personal_Record->Children_number->SearchOperator == ">=") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase(">="); ?></option><option value="BETWEEN"<?php if ($Employee_Personal_Record->Children_number->SearchOperator == "BETWEEN") echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("BETWEEN"); ?></option></select></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_Children_number" id="sv1_Children_number" size="30" value="<?php echo ewrpt_HtmlEncode($Employee_Personal_Record->Children_number->SearchValue) ?>"<?php echo ($Employee_Personal_Record_summary->ClearExtFilter == 'Employee_Personal_Record_Children_number') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
				<td><span class="ewRptSearchOpr" style="display: none" id="btw1_Children_number" name="btw1_Children_number">&nbsp;<?php echo $ReportLanguage->Phrase("AND") ?>&nbsp;</span></td>
				<td><span class="phpreportmaker" style="display: none" id="btw1_Children_number" name="btw1_Children_number">
<input type="text" name="sv2_Children_number" id="sv2_Children_number" size="30" value="<?php echo ewrpt_HtmlEncode($Employee_Personal_Record->Children_number->SearchValue2) ?>"<?php echo ($Employee_Personal_Record_summary->ClearExtFilter == 'Employee_Personal_Record_Children_number') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Employee_Personal_Record->Name_Child->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_Name_Child" id="so1_Name_Child" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_Name_Child" id="sv1_Name_Child" size="30" maxlength="200" value="<?php echo ewrpt_HtmlEncode($Employee_Personal_Record->Name_Child->SearchValue) ?>"<?php echo ($Employee_Personal_Record_summary->ClearExtFilter == 'Employee_Personal_Record_Name_Child') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Employee_Personal_Record->Age_Child->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_Age_Child" id="so1_Age_Child" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_Age_Child" id="sv1_Age_Child" size="30" maxlength="50" value="<?php echo ewrpt_HtmlEncode($Employee_Personal_Record->Age_Child->SearchValue) ?>"<?php echo ($Employee_Personal_Record_summary->ClearExtFilter == 'Employee_Personal_Record_Age_Child') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Employee_Personal_Record->Sex_Child->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_Sex_Child" id="so1_Sex_Child" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_Sex_Child" id="sv1_Sex_Child" size="30" maxlength="50" value="<?php echo ewrpt_HtmlEncode($Employee_Personal_Record->Sex_Child->SearchValue) ?>"<?php echo ($Employee_Personal_Record_summary->ClearExtFilter == 'Employee_Personal_Record_Sex_Child') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Employee_Personal_Record->Experience->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_Experience" id="so1_Experience" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_Experience" id="sv1_Experience" value="<?php echo ewrpt_HtmlEncode($Employee_Personal_Record->Experience->SearchValue) ?>"<?php echo ($Employee_Personal_Record_summary->ClearExtFilter == 'Employee_Personal_Record_Experience') ? " class=\"ewInputCleared\"" : "" ?>>
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
ewrpt_SrchOprChanged('so1_Age');
ewrpt_SrchOprChanged('so1_Salary');
ewrpt_SrchOprChanged('so1_Children_number');
</script>
<!-- Search form (end) -->
</div>
<br />
<?php } ?>
<?php if ($Employee_Personal_Record->ShowCurrentFilter) { ?>
<div id="ewrptFilterList">
<?php $Employee_Personal_Record_summary->ShowFilterList() ?>
</div>
<br />
<?php } ?>
<table class="ewGrid" cellspacing="0"><tr>
	<td class="ewGridContent">
<?php if ($Employee_Personal_Record->Export == "") { ?>
<div class="ewGridUpperPanel">
<form action="Employee_Personal_Recordsmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($Employee_Personal_Record_summary->StartGrp, $Employee_Personal_Record_summary->DisplayGrps, $Employee_Personal_Record_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="Employee_Personal_Recordsmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="Employee_Personal_Recordsmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="Employee_Personal_Recordsmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="Employee_Personal_Recordsmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($Employee_Personal_Record_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($Employee_Personal_Record_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($Employee_Personal_Record_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($Employee_Personal_Record_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($Employee_Personal_Record_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($Employee_Personal_Record_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($Employee_Personal_Record_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($Employee_Personal_Record_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($Employee_Personal_Record_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($Employee_Personal_Record_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($Employee_Personal_Record->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
if ($Employee_Personal_Record->ExportAll && $Employee_Personal_Record->Export <> "") {
	$Employee_Personal_Record_summary->StopGrp = $Employee_Personal_Record_summary->TotalGrps;
} else {
	$Employee_Personal_Record_summary->StopGrp = $Employee_Personal_Record_summary->StartGrp + $Employee_Personal_Record_summary->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($Employee_Personal_Record_summary->StopGrp) > intval($Employee_Personal_Record_summary->TotalGrps))
	$Employee_Personal_Record_summary->StopGrp = $Employee_Personal_Record_summary->TotalGrps;
$Employee_Personal_Record_summary->RecCount = 0;

// Get first row
if ($Employee_Personal_Record_summary->TotalGrps > 0) {
	$Employee_Personal_Record_summary->GetGrpRow(1);
	$Employee_Personal_Record_summary->GrpCount = 1;
}
while (($rsgrp && !$rsgrp->EOF && $Employee_Personal_Record_summary->GrpCount <= $Employee_Personal_Record_summary->DisplayGrps) || $Employee_Personal_Record_summary->ShowFirstHeader) {

	// Show header
	if ($Employee_Personal_Record_summary->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Employee_Personal_Record->SortUrl($Employee_Personal_Record->Department) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Employee_Personal_Record->Department->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Employee_Personal_Record->SortUrl($Employee_Personal_Record->Department) ?>',0);"><?php echo $Employee_Personal_Record->Department->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Employee_Personal_Record->Department->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Employee_Personal_Record->Department->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Employee_Personal_Record->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Employee_Personal_Record_Department', false, '<?php echo $Employee_Personal_Record->Department->RangeFrom; ?>', '<?php echo $Employee_Personal_Record->Department->RangeTo; ?>');return false;" name="x_Department<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>" id="x_Department<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Employee_Personal_Record->SortUrl($Employee_Personal_Record->ID) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Employee_Personal_Record->ID->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Employee_Personal_Record->SortUrl($Employee_Personal_Record->ID) ?>',0);"><?php echo $Employee_Personal_Record->ID->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Employee_Personal_Record->ID->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Employee_Personal_Record->ID->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Employee_Personal_Record->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Employee_Personal_Record_ID', false, '<?php echo $Employee_Personal_Record->ID->RangeFrom; ?>', '<?php echo $Employee_Personal_Record->ID->RangeTo; ?>');return false;" name="x_ID<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>" id="x_ID<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Employee_Personal_Record->SortUrl($Employee_Personal_Record->FirstName) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Employee_Personal_Record->FirstName->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Employee_Personal_Record->SortUrl($Employee_Personal_Record->FirstName) ?>',0);"><?php echo $Employee_Personal_Record->FirstName->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Employee_Personal_Record->FirstName->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Employee_Personal_Record->FirstName->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Employee_Personal_Record->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Employee_Personal_Record_FirstName', false, '<?php echo $Employee_Personal_Record->FirstName->RangeFrom; ?>', '<?php echo $Employee_Personal_Record->FirstName->RangeTo; ?>');return false;" name="x_FirstName<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>" id="x_FirstName<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Employee_Personal_Record->SortUrl($Employee_Personal_Record->MiddelName) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Employee_Personal_Record->MiddelName->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Employee_Personal_Record->SortUrl($Employee_Personal_Record->MiddelName) ?>',0);"><?php echo $Employee_Personal_Record->MiddelName->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Employee_Personal_Record->MiddelName->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Employee_Personal_Record->MiddelName->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Employee_Personal_Record->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Employee_Personal_Record_MiddelName', false, '<?php echo $Employee_Personal_Record->MiddelName->RangeFrom; ?>', '<?php echo $Employee_Personal_Record->MiddelName->RangeTo; ?>');return false;" name="x_MiddelName<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>" id="x_MiddelName<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Employee_Personal_Record->SortUrl($Employee_Personal_Record->LastName) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Employee_Personal_Record->LastName->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Employee_Personal_Record->SortUrl($Employee_Personal_Record->LastName) ?>',0);"><?php echo $Employee_Personal_Record->LastName->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Employee_Personal_Record->LastName->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Employee_Personal_Record->LastName->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Employee_Personal_Record->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Employee_Personal_Record_LastName', false, '<?php echo $Employee_Personal_Record->LastName->RangeFrom; ?>', '<?php echo $Employee_Personal_Record->LastName->RangeTo; ?>');return false;" name="x_LastName<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>" id="x_LastName<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Employee_Personal_Record->SortUrl($Employee_Personal_Record->Date_Birth) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Employee_Personal_Record->Date_Birth->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Employee_Personal_Record->SortUrl($Employee_Personal_Record->Date_Birth) ?>',0);"><?php echo $Employee_Personal_Record->Date_Birth->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Employee_Personal_Record->Date_Birth->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Employee_Personal_Record->Date_Birth->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Employee_Personal_Record->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Employee_Personal_Record_Date_Birth', false, '<?php echo $Employee_Personal_Record->Date_Birth->RangeFrom; ?>', '<?php echo $Employee_Personal_Record->Date_Birth->RangeTo; ?>');return false;" name="x_Date_Birth<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>" id="x_Date_Birth<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Employee_Personal_Record->SortUrl($Employee_Personal_Record->Place_Birth) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Employee_Personal_Record->Place_Birth->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Employee_Personal_Record->SortUrl($Employee_Personal_Record->Place_Birth) ?>',0);"><?php echo $Employee_Personal_Record->Place_Birth->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Employee_Personal_Record->Place_Birth->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Employee_Personal_Record->Place_Birth->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Employee_Personal_Record->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Employee_Personal_Record_Place_Birth', false, '<?php echo $Employee_Personal_Record->Place_Birth->RangeFrom; ?>', '<?php echo $Employee_Personal_Record->Place_Birth->RangeTo; ?>');return false;" name="x_Place_Birth<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>" id="x_Place_Birth<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Employee_Personal_Record->SortUrl($Employee_Personal_Record->Age) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Employee_Personal_Record->Age->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Employee_Personal_Record->SortUrl($Employee_Personal_Record->Age) ?>',0);"><?php echo $Employee_Personal_Record->Age->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Employee_Personal_Record->Age->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Employee_Personal_Record->Age->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Employee_Personal_Record->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Employee_Personal_Record_Age', false, '<?php echo $Employee_Personal_Record->Age->RangeFrom; ?>', '<?php echo $Employee_Personal_Record->Age->RangeTo; ?>');return false;" name="x_Age<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>" id="x_Age<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Employee_Personal_Record->SortUrl($Employee_Personal_Record->Sex) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Employee_Personal_Record->Sex->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Employee_Personal_Record->SortUrl($Employee_Personal_Record->Sex) ?>',0);"><?php echo $Employee_Personal_Record->Sex->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Employee_Personal_Record->Sex->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Employee_Personal_Record->Sex->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Employee_Personal_Record->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Employee_Personal_Record_Sex', false, '<?php echo $Employee_Personal_Record->Sex->RangeFrom; ?>', '<?php echo $Employee_Personal_Record->Sex->RangeTo; ?>');return false;" name="x_Sex<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>" id="x_Sex<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Employee_Personal_Record->SortUrl($Employee_Personal_Record->zEmail) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Employee_Personal_Record->zEmail->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Employee_Personal_Record->SortUrl($Employee_Personal_Record->zEmail) ?>',0);"><?php echo $Employee_Personal_Record->zEmail->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Employee_Personal_Record->zEmail->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Employee_Personal_Record->zEmail->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Employee_Personal_Record->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Employee_Personal_Record_zEmail', false, '<?php echo $Employee_Personal_Record->zEmail->RangeFrom; ?>', '<?php echo $Employee_Personal_Record->zEmail->RangeTo; ?>');return false;" name="x_zEmail<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>" id="x_zEmail<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Employee_Personal_Record->SortUrl($Employee_Personal_Record->Date_Employement) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Employee_Personal_Record->Date_Employement->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Employee_Personal_Record->SortUrl($Employee_Personal_Record->Date_Employement) ?>',0);"><?php echo $Employee_Personal_Record->Date_Employement->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Employee_Personal_Record->Date_Employement->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Employee_Personal_Record->Date_Employement->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Employee_Personal_Record->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Employee_Personal_Record_Date_Employement', false, '<?php echo $Employee_Personal_Record->Date_Employement->RangeFrom; ?>', '<?php echo $Employee_Personal_Record->Date_Employement->RangeTo; ?>');return false;" name="x_Date_Employement<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>" id="x_Date_Employement<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Employee_Personal_Record->SortUrl($Employee_Personal_Record->Position) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Employee_Personal_Record->Position->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Employee_Personal_Record->SortUrl($Employee_Personal_Record->Position) ?>',0);"><?php echo $Employee_Personal_Record->Position->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Employee_Personal_Record->Position->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Employee_Personal_Record->Position->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Employee_Personal_Record->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Employee_Personal_Record_Position', false, '<?php echo $Employee_Personal_Record->Position->RangeFrom; ?>', '<?php echo $Employee_Personal_Record->Position->RangeTo; ?>');return false;" name="x_Position<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>" id="x_Position<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Employee_Personal_Record->SortUrl($Employee_Personal_Record->Educational_Status) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Employee_Personal_Record->Educational_Status->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Employee_Personal_Record->SortUrl($Employee_Personal_Record->Educational_Status) ?>',0);"><?php echo $Employee_Personal_Record->Educational_Status->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Employee_Personal_Record->Educational_Status->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Employee_Personal_Record->Educational_Status->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Employee_Personal_Record->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Employee_Personal_Record_Educational_Status', false, '<?php echo $Employee_Personal_Record->Educational_Status->RangeFrom; ?>', '<?php echo $Employee_Personal_Record->Educational_Status->RangeTo; ?>');return false;" name="x_Educational_Status<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>" id="x_Educational_Status<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Employee_Personal_Record->SortUrl($Employee_Personal_Record->Salary) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Employee_Personal_Record->Salary->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Employee_Personal_Record->SortUrl($Employee_Personal_Record->Salary) ?>',0);"><?php echo $Employee_Personal_Record->Salary->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Employee_Personal_Record->Salary->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Employee_Personal_Record->Salary->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Employee_Personal_Record->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Employee_Personal_Record_Salary', false, '<?php echo $Employee_Personal_Record->Salary->RangeFrom; ?>', '<?php echo $Employee_Personal_Record->Salary->RangeTo; ?>');return false;" name="x_Salary<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>" id="x_Salary<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Employee_Personal_Record->SortUrl($Employee_Personal_Record->Martial_Status) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Employee_Personal_Record->Martial_Status->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Employee_Personal_Record->SortUrl($Employee_Personal_Record->Martial_Status) ?>',0);"><?php echo $Employee_Personal_Record->Martial_Status->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Employee_Personal_Record->Martial_Status->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Employee_Personal_Record->Martial_Status->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Employee_Personal_Record->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Employee_Personal_Record_Martial_Status', false, '<?php echo $Employee_Personal_Record->Martial_Status->RangeFrom; ?>', '<?php echo $Employee_Personal_Record->Martial_Status->RangeTo; ?>');return false;" name="x_Martial_Status<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>" id="x_Martial_Status<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Employee_Personal_Record->SortUrl($Employee_Personal_Record->Children_number) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Employee_Personal_Record->Children_number->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Employee_Personal_Record->SortUrl($Employee_Personal_Record->Children_number) ?>',0);"><?php echo $Employee_Personal_Record->Children_number->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Employee_Personal_Record->Children_number->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Employee_Personal_Record->Children_number->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Employee_Personal_Record->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Employee_Personal_Record_Children_number', false, '<?php echo $Employee_Personal_Record->Children_number->RangeFrom; ?>', '<?php echo $Employee_Personal_Record->Children_number->RangeTo; ?>');return false;" name="x_Children_number<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>" id="x_Children_number<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Employee_Personal_Record->SortUrl($Employee_Personal_Record->Name_Child) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Employee_Personal_Record->Name_Child->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Employee_Personal_Record->SortUrl($Employee_Personal_Record->Name_Child) ?>',0);"><?php echo $Employee_Personal_Record->Name_Child->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Employee_Personal_Record->Name_Child->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Employee_Personal_Record->Name_Child->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Employee_Personal_Record->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Employee_Personal_Record_Name_Child', false, '<?php echo $Employee_Personal_Record->Name_Child->RangeFrom; ?>', '<?php echo $Employee_Personal_Record->Name_Child->RangeTo; ?>');return false;" name="x_Name_Child<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>" id="x_Name_Child<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Employee_Personal_Record->SortUrl($Employee_Personal_Record->Age_Child) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Employee_Personal_Record->Age_Child->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Employee_Personal_Record->SortUrl($Employee_Personal_Record->Age_Child) ?>',0);"><?php echo $Employee_Personal_Record->Age_Child->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Employee_Personal_Record->Age_Child->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Employee_Personal_Record->Age_Child->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Employee_Personal_Record->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Employee_Personal_Record_Age_Child', false, '<?php echo $Employee_Personal_Record->Age_Child->RangeFrom; ?>', '<?php echo $Employee_Personal_Record->Age_Child->RangeTo; ?>');return false;" name="x_Age_Child<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>" id="x_Age_Child<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Employee_Personal_Record->SortUrl($Employee_Personal_Record->Sex_Child) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Employee_Personal_Record->Sex_Child->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Employee_Personal_Record->SortUrl($Employee_Personal_Record->Sex_Child) ?>',0);"><?php echo $Employee_Personal_Record->Sex_Child->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Employee_Personal_Record->Sex_Child->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Employee_Personal_Record->Sex_Child->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Employee_Personal_Record->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Employee_Personal_Record_Sex_Child', false, '<?php echo $Employee_Personal_Record->Sex_Child->RangeFrom; ?>', '<?php echo $Employee_Personal_Record->Sex_Child->RangeTo; ?>');return false;" name="x_Sex_Child<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>" id="x_Sex_Child<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Employee_Personal_Record->SortUrl($Employee_Personal_Record->Photo) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Employee_Personal_Record->Photo->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Employee_Personal_Record->SortUrl($Employee_Personal_Record->Photo) ?>',0);"><?php echo $Employee_Personal_Record->Photo->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Employee_Personal_Record->Photo->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Employee_Personal_Record->Photo->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Employee_Personal_Record->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Employee_Personal_Record_Photo', false, '<?php echo $Employee_Personal_Record->Photo->RangeFrom; ?>', '<?php echo $Employee_Personal_Record->Photo->RangeTo; ?>');return false;" name="x_Photo<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>" id="x_Photo<?php echo $Employee_Personal_Record_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Employee_Personal_Record->SortUrl($Employee_Personal_Record->Image) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Employee_Personal_Record->Image->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Employee_Personal_Record->SortUrl($Employee_Personal_Record->Image) ?>',0);"><?php echo $Employee_Personal_Record->Image->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Employee_Personal_Record->Image->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Employee_Personal_Record->Image->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Employee_Personal_Record->SortUrl($Employee_Personal_Record->Experience) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Employee_Personal_Record->Experience->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Employee_Personal_Record->SortUrl($Employee_Personal_Record->Experience) ?>',0);"><?php echo $Employee_Personal_Record->Experience->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Employee_Personal_Record->Experience->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Employee_Personal_Record->Experience->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Employee_Personal_Record->SortUrl($Employee_Personal_Record->HardCopy_Shelf_No) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Employee_Personal_Record->HardCopy_Shelf_No->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Employee_Personal_Record->SortUrl($Employee_Personal_Record->HardCopy_Shelf_No) ?>',0);"><?php echo $Employee_Personal_Record->HardCopy_Shelf_No->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Employee_Personal_Record->HardCopy_Shelf_No->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Employee_Personal_Record->HardCopy_Shelf_No->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Employee_Personal_Record->SortUrl($Employee_Personal_Record->Telephone) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Employee_Personal_Record->Telephone->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Employee_Personal_Record->SortUrl($Employee_Personal_Record->Telephone) ?>',0);"><?php echo $Employee_Personal_Record->Telephone->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Employee_Personal_Record->Telephone->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Employee_Personal_Record->Telephone->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$Employee_Personal_Record_summary->ShowFirstHeader = FALSE;
	}

	// Build detail SQL
	$sWhere = ewrpt_DetailFilterSQL($Employee_Personal_Record->Department, $Employee_Personal_Record->SqlFirstGroupField(), $Employee_Personal_Record->Department->GroupValue());
	if ($Employee_Personal_Record_summary->Filter != "")
		$sWhere = "($Employee_Personal_Record_summary->Filter) AND ($sWhere)";
	$sSql = ewrpt_BuildReportSql($Employee_Personal_Record->SqlSelect(), $Employee_Personal_Record->SqlWhere(), $Employee_Personal_Record->SqlGroupBy(), $Employee_Personal_Record->SqlHaving(), $Employee_Personal_Record->SqlOrderBy(), $sWhere, $Employee_Personal_Record_summary->Sort);
	$rs = $conn->Execute($sSql);
	$rsdtlcnt = ($rs) ? $rs->RecordCount() : 0;
	if ($rsdtlcnt > 0)
		$Employee_Personal_Record_summary->GetRow(1);
	while ($rs && !$rs->EOF) { // Loop detail records
		$Employee_Personal_Record_summary->RecCount++;

		// Render detail row
		$Employee_Personal_Record->ResetCSS();
		$Employee_Personal_Record->RowType = EWRPT_ROWTYPE_DETAIL;
		$Employee_Personal_Record_summary->RenderRow();
?>
	<tr<?php echo $Employee_Personal_Record->RowAttributes(); ?>>
		<td<?php echo $Employee_Personal_Record->Department->CellAttributes(); ?>><div<?php echo $Employee_Personal_Record->Department->ViewAttributes(); ?>><?php echo $Employee_Personal_Record->Department->GroupViewValue; ?></div></td>
		<td<?php echo $Employee_Personal_Record->ID->CellAttributes() ?>>
<div<?php echo $Employee_Personal_Record->ID->ViewAttributes(); ?>><?php echo $Employee_Personal_Record->ID->ListViewValue(); ?></div>
</td>
		<td<?php echo $Employee_Personal_Record->FirstName->CellAttributes() ?>>
<div<?php echo $Employee_Personal_Record->FirstName->ViewAttributes(); ?>><?php echo $Employee_Personal_Record->FirstName->ListViewValue(); ?></div>
</td>
		<td<?php echo $Employee_Personal_Record->MiddelName->CellAttributes() ?>>
<div<?php echo $Employee_Personal_Record->MiddelName->ViewAttributes(); ?>><?php echo $Employee_Personal_Record->MiddelName->ListViewValue(); ?></div>
</td>
		<td<?php echo $Employee_Personal_Record->LastName->CellAttributes() ?>>
<div<?php echo $Employee_Personal_Record->LastName->ViewAttributes(); ?>><?php echo $Employee_Personal_Record->LastName->ListViewValue(); ?></div>
</td>
		<td<?php echo $Employee_Personal_Record->Date_Birth->CellAttributes() ?>>
<div<?php echo $Employee_Personal_Record->Date_Birth->ViewAttributes(); ?>><?php echo $Employee_Personal_Record->Date_Birth->ListViewValue(); ?></div>
</td>
		<td<?php echo $Employee_Personal_Record->Place_Birth->CellAttributes() ?>>
<div<?php echo $Employee_Personal_Record->Place_Birth->ViewAttributes(); ?>><?php echo $Employee_Personal_Record->Place_Birth->ListViewValue(); ?></div>
</td>
		<td<?php echo $Employee_Personal_Record->Age->CellAttributes() ?>>
<div<?php echo $Employee_Personal_Record->Age->ViewAttributes(); ?>><?php echo $Employee_Personal_Record->Age->ListViewValue(); ?></div>
</td>
		<td<?php echo $Employee_Personal_Record->Sex->CellAttributes() ?>>
<div<?php echo $Employee_Personal_Record->Sex->ViewAttributes(); ?>><?php echo $Employee_Personal_Record->Sex->ListViewValue(); ?></div>
</td>
		<td<?php echo $Employee_Personal_Record->zEmail->CellAttributes() ?>>
<div<?php echo $Employee_Personal_Record->zEmail->ViewAttributes(); ?>><?php echo $Employee_Personal_Record->zEmail->ListViewValue(); ?></div>
</td>
		<td<?php echo $Employee_Personal_Record->Date_Employement->CellAttributes() ?>>
<div<?php echo $Employee_Personal_Record->Date_Employement->ViewAttributes(); ?>><?php echo $Employee_Personal_Record->Date_Employement->ListViewValue(); ?></div>
</td>
		<td<?php echo $Employee_Personal_Record->Position->CellAttributes() ?>>
<div<?php echo $Employee_Personal_Record->Position->ViewAttributes(); ?>><?php echo $Employee_Personal_Record->Position->ListViewValue(); ?></div>
</td>
		<td<?php echo $Employee_Personal_Record->Educational_Status->CellAttributes() ?>>
<div<?php echo $Employee_Personal_Record->Educational_Status->ViewAttributes(); ?>><?php echo $Employee_Personal_Record->Educational_Status->ListViewValue(); ?></div>
</td>
		<td<?php echo $Employee_Personal_Record->Salary->CellAttributes() ?>>
<div<?php echo $Employee_Personal_Record->Salary->ViewAttributes(); ?>><?php echo $Employee_Personal_Record->Salary->ListViewValue(); ?></div>
</td>
		<td<?php echo $Employee_Personal_Record->Martial_Status->CellAttributes() ?>>
<div<?php echo $Employee_Personal_Record->Martial_Status->ViewAttributes(); ?>><?php echo $Employee_Personal_Record->Martial_Status->ListViewValue(); ?></div>
</td>
		<td<?php echo $Employee_Personal_Record->Children_number->CellAttributes() ?>>
<div<?php echo $Employee_Personal_Record->Children_number->ViewAttributes(); ?>><?php echo $Employee_Personal_Record->Children_number->ListViewValue(); ?></div>
</td>
		<td<?php echo $Employee_Personal_Record->Name_Child->CellAttributes() ?>>
<div<?php echo $Employee_Personal_Record->Name_Child->ViewAttributes(); ?>><?php echo $Employee_Personal_Record->Name_Child->ListViewValue(); ?></div>
</td>
		<td<?php echo $Employee_Personal_Record->Age_Child->CellAttributes() ?>>
<div<?php echo $Employee_Personal_Record->Age_Child->ViewAttributes(); ?>><?php echo $Employee_Personal_Record->Age_Child->ListViewValue(); ?></div>
</td>
		<td<?php echo $Employee_Personal_Record->Sex_Child->CellAttributes() ?>>
<div<?php echo $Employee_Personal_Record->Sex_Child->ViewAttributes(); ?>><?php echo $Employee_Personal_Record->Sex_Child->ListViewValue(); ?></div>
</td>
		<td<?php echo $Employee_Personal_Record->Photo->CellAttributes() ?>>
<div<?php echo $Employee_Personal_Record->Photo->ViewAttributes(); ?>><?php echo $Employee_Personal_Record->Photo->ListViewValue(); ?></div>
</td>
		<td<?php echo $Employee_Personal_Record->Image->CellAttributes() ?>>
<?php if ($Employee_Personal_Record->Image->HrefValue <> "") { ?>
<?php if (!is_null($Employee_Personal_Record->Image->DbValue)) { ?>
<a href="<?php echo $Employee_Personal_Record->Image->HrefValue; ?>" target="_blank"><img src="Employee_Personal_Record_Image_rptbv.php?Auto_ID=<?php echo $Employee_Personal_Record->Auto_ID->CurrentValue ?>" border=0<?php echo $Employee_Personal_Record->Image->ViewAttributes() ?>></a>
<?php } else { echo "&nbsp;"; } ?>
<?php } else { ?>
<?php if (!is_null($Employee_Personal_Record->Image->DbValue)) { ?>
<img src="Employee_Personal_Record_Image_rptbv.php?Auto_ID=<?php echo $Employee_Personal_Record->Auto_ID->CurrentValue ?>" border=0<?php echo $Employee_Personal_Record->Image->ViewAttributes() ?>>
<?php } else { echo "&nbsp;"; } ?>
<?php } ?>
</td>
		<td<?php echo $Employee_Personal_Record->Experience->CellAttributes() ?>>
<div<?php echo $Employee_Personal_Record->Experience->ViewAttributes(); ?>><?php echo $Employee_Personal_Record->Experience->ListViewValue(); ?></div>
</td>
		<td<?php echo $Employee_Personal_Record->HardCopy_Shelf_No->CellAttributes() ?>>
<div<?php echo $Employee_Personal_Record->HardCopy_Shelf_No->ViewAttributes(); ?>><?php echo $Employee_Personal_Record->HardCopy_Shelf_No->ListViewValue(); ?></div>
</td>
		<td<?php echo $Employee_Personal_Record->Telephone->CellAttributes() ?>>
<div<?php echo $Employee_Personal_Record->Telephone->ViewAttributes(); ?>><?php echo $Employee_Personal_Record->Telephone->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$Employee_Personal_Record_summary->AccumulateSummary();

		// Get next record
		$Employee_Personal_Record_summary->GetRow(2);

		// Show Footers
?>
<?php
	} // End detail records loop
?>
<?php

	// Next group
	$Employee_Personal_Record_summary->GetGrpRow(2);
	$Employee_Personal_Record_summary->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
<?php
if ($Employee_Personal_Record_summary->TotalGrps > 0) {
	$Employee_Personal_Record->ResetCSS();
	$Employee_Personal_Record->RowType = EWRPT_ROWTYPE_TOTAL;
	$Employee_Personal_Record->RowTotalType = EWRPT_ROWTOTAL_GRAND;
	$Employee_Personal_Record->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
	$Employee_Personal_Record->RowAttrs["class"] = "ewRptGrandSummary";
	$Employee_Personal_Record_summary->RenderRow();
?>
	<!-- tr><td colspan="24"><span class="phpreportmaker">&nbsp;<br /></span></td></tr -->
	<tr<?php echo $Employee_Personal_Record->RowAttributes(); ?>><td colspan="24"><?php echo $ReportLanguage->Phrase("RptGrandTotal") ?> (<?php echo ewrpt_FormatNumber($Employee_Personal_Record_summary->TotCount,0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php } ?>
	</tfoot>
</table>
</div>
<?php if ($Employee_Personal_Record_summary->TotalGrps > 0) { ?>
<?php if ($Employee_Personal_Record->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="Employee_Personal_Recordsmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($Employee_Personal_Record_summary->StartGrp, $Employee_Personal_Record_summary->DisplayGrps, $Employee_Personal_Record_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="Employee_Personal_Recordsmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="Employee_Personal_Recordsmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="Employee_Personal_Recordsmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="Employee_Personal_Recordsmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($Employee_Personal_Record_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($Employee_Personal_Record_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($Employee_Personal_Record_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($Employee_Personal_Record_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($Employee_Personal_Record_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($Employee_Personal_Record_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($Employee_Personal_Record_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($Employee_Personal_Record_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($Employee_Personal_Record_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($Employee_Personal_Record_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($Employee_Personal_Record->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php if ($Employee_Personal_Record->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($Employee_Personal_Record->Export == "" || $Employee_Personal_Record->Export == "print" || $Employee_Personal_Record->Export == "email") { ?>
<?php } ?>
<?php if ($Employee_Personal_Record->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3" class="ewPadding"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($Employee_Personal_Record->Export == "" || $Employee_Personal_Record->Export == "print" || $Employee_Personal_Record->Export == "email") { ?>
<a name="cht_Number_Of_Employee_Per_Department"></a>
<div id="div_Employee_Personal_Record_Number_Of_Employee_Per_Department"></div>
<?php

// Initialize chart data
$Employee_Personal_Record->Number_Of_Employee_Per_Department->ID = "Employee_Personal_Record_Number_Of_Employee_Per_Department"; // Chart ID
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("type", "5", FALSE); // Chart type
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("seriestype", "0", FALSE); // Chart series type
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("bgcolor", "#FCFCFC", TRUE); // Background color
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("caption", $Employee_Personal_Record->Number_Of_Employee_Per_Department->ChartCaption(), TRUE); // Chart caption
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("xaxisname", $Employee_Personal_Record->Number_Of_Employee_Per_Department->ChartXAxisName(), TRUE); // X axis name
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("yaxisname", $Employee_Personal_Record->Number_Of_Employee_Per_Department->ChartYAxisName(), TRUE); // Y axis name
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("shownames", "1", TRUE); // Show names
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("showvalues", "1", TRUE); // Show values
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("showhovercap", "1", TRUE); // Show hover
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("alpha", "50", FALSE); // Chart alpha
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("colorpalette", "#FF0000|#FF0080|#FF00FF|#8000FF|#FF8000|#FF3D3D|#7AFFFF|#0000FF|#FFFF00|#FF7A7A|#3DFFFF|#0080FF|#80FF00|#00FF00|#00FF80|#00FFFF", FALSE); // Chart color palette
?>
<?php
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("showCanvasBg", "1", TRUE); // showCanvasBg
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("showCanvasBase", "1", TRUE); // showCanvasBase
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("showLimits", "1", TRUE); // showLimits
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("animation", "1", TRUE); // animation
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("rotateNames", "0", TRUE); // rotateNames
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("yAxisMinValue", "0", TRUE); // yAxisMinValue
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("yAxisMaxValue", "0", TRUE); // yAxisMaxValue
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("PYAxisMinValue", "0", TRUE); // PYAxisMinValue
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("PYAxisMaxValue", "0", TRUE); // PYAxisMaxValue
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("SYAxisMinValue", "0", TRUE); // SYAxisMinValue
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("SYAxisMaxValue", "0", TRUE); // SYAxisMaxValue
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("showColumnShadow", "0", TRUE); // showColumnShadow
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("showPercentageValues", "1", TRUE); // showPercentageValues
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("showPercentageInLabel", "1", TRUE); // showPercentageInLabel
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("showBarShadow", "0", TRUE); // showBarShadow
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("showAnchors", "1", TRUE); // showAnchors
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("showAreaBorder", "1", TRUE); // showAreaBorder
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("isSliced", "1", TRUE); // isSliced
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("showAsBars", "0", TRUE); // showAsBars
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("showShadow", "0", TRUE); // showShadow
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("formatNumber", "0", TRUE); // formatNumber
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("formatNumberScale", "0", TRUE); // formatNumberScale
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("decimalSeparator", ".", TRUE); // decimalSeparator
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("thousandSeparator", ",", TRUE); // thousandSeparator
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("decimalPrecision", "2", TRUE); // decimalPrecision
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("divLineDecimalPrecision", "2", TRUE); // divLineDecimalPrecision
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("limitsDecimalPrecision", "2", TRUE); // limitsDecimalPrecision
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("zeroPlaneShowBorder", "1", TRUE); // zeroPlaneShowBorder
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("showDivLineValue", "1", TRUE); // showDivLineValue
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("showAlternateHGridColor", "0", TRUE); // showAlternateHGridColor
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("showAlternateVGridColor", "0", TRUE); // showAlternateVGridColor
$Employee_Personal_Record->Number_Of_Employee_Per_Department->SetChartParam("hoverCapSepChar", ":", TRUE); // hoverCapSepChar

// Define trend lines
?>
<?php
$SqlSelect = $Employee_Personal_Record->SqlSelect();
$SqlChartSelect = $Employee_Personal_Record->Number_Of_Employee_Per_Department->SqlSelect;
$sSqlChartBase = $Employee_Personal_Record->SqlFrom();

// Load chart data from sql directly
$sSql = $SqlChartSelect . $sSqlChartBase;
$sSql = ewrpt_BuildReportSql($sSql, $Employee_Personal_Record->SqlWhere(), $Employee_Personal_Record->Number_Of_Employee_Per_Department->SqlGroupBy, "", $Employee_Personal_Record->Number_Of_Employee_Per_Department->SqlOrderBy, $Employee_Personal_Record_summary->Filter, "");
if (EWRPT_DEBUG_ENABLED) echo "(Chart SQL): " . $sSql . "<br>";
ewrpt_LoadChartData($sSql, $Employee_Personal_Record->Number_Of_Employee_Per_Department);
ewrpt_SortChartData($Employee_Personal_Record->Number_Of_Employee_Per_Department->Data, 0, "");

// Call Chart_Rendering event
$Employee_Personal_Record->Chart_Rendering($Employee_Personal_Record->Number_Of_Employee_Per_Department);
$chartxml = $Employee_Personal_Record->Number_Of_Employee_Per_Department->ChartXml();

// Call Chart_Rendered event
$Employee_Personal_Record->Chart_Rendered($Employee_Personal_Record->Number_Of_Employee_Per_Department, $chartxml);
echo $Employee_Personal_Record->Number_Of_Employee_Per_Department->ShowChartFCF($chartxml);
?>
<a href="#top"><?php echo $ReportLanguage->Phrase("Top") ?></a>
<br /><br />
<a name="cht_Funner_Chart_Number_of__Employee_Per_Department"></a>
<div id="div_Employee_Personal_Record_Funner_Chart_Number_of__Employee_Per_Department"></div>
<?php

// Initialize chart data
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->ID = "Employee_Personal_Record_Funner_Chart_Number_of__Employee_Per_Department"; // Chart ID
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("type", "22", FALSE); // Chart type
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("seriestype", "0", FALSE); // Chart series type
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("bgcolor", "#FCFCFC", TRUE); // Background color
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("caption", $Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->ChartCaption(), TRUE); // Chart caption
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("xaxisname", $Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->ChartXAxisName(), TRUE); // X axis name
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("yaxisname", $Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->ChartYAxisName(), TRUE); // Y axis name
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("shownames", "1", TRUE); // Show names
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("showvalues", "1", TRUE); // Show values
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("showhovercap", "0", TRUE); // Show hover
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("alpha", "50", FALSE); // Chart alpha
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("colorpalette", "#FF0000|#FF0080|#FF00FF|#8000FF|#FF8000|#FF3D3D|#7AFFFF|#0000FF|#FFFF00|#FF7A7A|#3DFFFF|#0080FF|#80FF00|#00FF00|#00FF80|#00FFFF", FALSE); // Chart color palette
?>
<?php
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("showCanvasBg", "1", TRUE); // showCanvasBg
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("showCanvasBase", "1", TRUE); // showCanvasBase
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("showLimits", "1", TRUE); // showLimits
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("animation", "1", TRUE); // animation
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("rotateNames", "0", TRUE); // rotateNames
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("yAxisMinValue", "0", TRUE); // yAxisMinValue
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("yAxisMaxValue", "0", TRUE); // yAxisMaxValue
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("PYAxisMinValue", "0", TRUE); // PYAxisMinValue
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("PYAxisMaxValue", "0", TRUE); // PYAxisMaxValue
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("SYAxisMinValue", "0", TRUE); // SYAxisMinValue
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("SYAxisMaxValue", "0", TRUE); // SYAxisMaxValue
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("showColumnShadow", "0", TRUE); // showColumnShadow
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("showPercentageValues", "1", TRUE); // showPercentageValues
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("showPercentageInLabel", "1", TRUE); // showPercentageInLabel
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("showBarShadow", "0", TRUE); // showBarShadow
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("showAnchors", "1", TRUE); // showAnchors
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("showAreaBorder", "1", TRUE); // showAreaBorder
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("isSliced", "1", TRUE); // isSliced
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("showAsBars", "0", TRUE); // showAsBars
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("showShadow", "0", TRUE); // showShadow
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("formatNumber", "0", TRUE); // formatNumber
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("formatNumberScale", "0", TRUE); // formatNumberScale
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("decimalSeparator", ".", TRUE); // decimalSeparator
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("thousandSeparator", ",", TRUE); // thousandSeparator
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("decimalPrecision", "2", TRUE); // decimalPrecision
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("divLineDecimalPrecision", "2", TRUE); // divLineDecimalPrecision
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("limitsDecimalPrecision", "2", TRUE); // limitsDecimalPrecision
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("zeroPlaneShowBorder", "1", TRUE); // zeroPlaneShowBorder
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("showDivLineValue", "1", TRUE); // showDivLineValue
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("showAlternateHGridColor", "0", TRUE); // showAlternateHGridColor
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("showAlternateVGridColor", "0", TRUE); // showAlternateVGridColor
$Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SetChartParam("hoverCapSepChar", ":", TRUE); // hoverCapSepChar

// Define trend lines
?>
<?php
$SqlSelect = $Employee_Personal_Record->SqlSelect();
$SqlChartSelect = $Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SqlSelect;
$sSqlChartBase = $Employee_Personal_Record->SqlFrom();

// Load chart data from sql directly
$sSql = $SqlChartSelect . $sSqlChartBase;
$sSql = ewrpt_BuildReportSql($sSql, $Employee_Personal_Record->SqlWhere(), $Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SqlGroupBy, "", $Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->SqlOrderBy, $Employee_Personal_Record_summary->Filter, "");
if (EWRPT_DEBUG_ENABLED) echo "(Chart SQL): " . $sSql . "<br>";
ewrpt_LoadChartData($sSql, $Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department);
ewrpt_SortChartData($Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->Data, 1, "");

// Call Chart_Rendering event
$Employee_Personal_Record->Chart_Rendering($Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department);
$chartxml = $Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->ChartXml();

// Call Chart_Rendered event
$Employee_Personal_Record->Chart_Rendered($Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department, $chartxml);
echo $Employee_Personal_Record->Funner_Chart_Number_of__Employee_Per_Department->ShowChartFCF($chartxml);
?>
<a href="#top"><?php echo $ReportLanguage->Phrase("Top") ?></a>
<br /><br />
<a name="cht_Employee_Distribution"></a>
<div id="div_Employee_Personal_Record_Employee_Distribution"></div>
<?php

// Initialize chart data
$Employee_Personal_Record->Employee_Distribution->ID = "Employee_Personal_Record_Employee_Distribution"; // Chart ID
$Employee_Personal_Record->Employee_Distribution->SetChartParam("type", "6", FALSE); // Chart type
$Employee_Personal_Record->Employee_Distribution->SetChartParam("seriestype", "0", FALSE); // Chart series type
$Employee_Personal_Record->Employee_Distribution->SetChartParam("bgcolor", "#FCFCFC", TRUE); // Background color
$Employee_Personal_Record->Employee_Distribution->SetChartParam("caption", $Employee_Personal_Record->Employee_Distribution->ChartCaption(), TRUE); // Chart caption
$Employee_Personal_Record->Employee_Distribution->SetChartParam("xaxisname", $Employee_Personal_Record->Employee_Distribution->ChartXAxisName(), TRUE); // X axis name
$Employee_Personal_Record->Employee_Distribution->SetChartParam("yaxisname", $Employee_Personal_Record->Employee_Distribution->ChartYAxisName(), TRUE); // Y axis name
$Employee_Personal_Record->Employee_Distribution->SetChartParam("shownames", "1", TRUE); // Show names
$Employee_Personal_Record->Employee_Distribution->SetChartParam("showvalues", "1", TRUE); // Show values
$Employee_Personal_Record->Employee_Distribution->SetChartParam("showhovercap", "1", TRUE); // Show hover
$Employee_Personal_Record->Employee_Distribution->SetChartParam("alpha", "50", FALSE); // Chart alpha
$Employee_Personal_Record->Employee_Distribution->SetChartParam("colorpalette", "#FF0000|#FF0080|#FF00FF|#8000FF|#FF8000|#FF3D3D|#7AFFFF|#0000FF|#FFFF00|#FF7A7A|#3DFFFF|#0080FF|#80FF00|#00FF00|#00FF80|#00FFFF", FALSE); // Chart color palette
?>
<?php
$Employee_Personal_Record->Employee_Distribution->SetChartParam("showCanvasBg", "1", TRUE); // showCanvasBg
$Employee_Personal_Record->Employee_Distribution->SetChartParam("showCanvasBase", "1", TRUE); // showCanvasBase
$Employee_Personal_Record->Employee_Distribution->SetChartParam("showLimits", "1", TRUE); // showLimits
$Employee_Personal_Record->Employee_Distribution->SetChartParam("animation", "1", TRUE); // animation
$Employee_Personal_Record->Employee_Distribution->SetChartParam("rotateNames", "0", TRUE); // rotateNames
$Employee_Personal_Record->Employee_Distribution->SetChartParam("yAxisMinValue", "0", TRUE); // yAxisMinValue
$Employee_Personal_Record->Employee_Distribution->SetChartParam("yAxisMaxValue", "0", TRUE); // yAxisMaxValue
$Employee_Personal_Record->Employee_Distribution->SetChartParam("PYAxisMinValue", "0", TRUE); // PYAxisMinValue
$Employee_Personal_Record->Employee_Distribution->SetChartParam("PYAxisMaxValue", "0", TRUE); // PYAxisMaxValue
$Employee_Personal_Record->Employee_Distribution->SetChartParam("SYAxisMinValue", "0", TRUE); // SYAxisMinValue
$Employee_Personal_Record->Employee_Distribution->SetChartParam("SYAxisMaxValue", "0", TRUE); // SYAxisMaxValue
$Employee_Personal_Record->Employee_Distribution->SetChartParam("showColumnShadow", "0", TRUE); // showColumnShadow
$Employee_Personal_Record->Employee_Distribution->SetChartParam("showPercentageValues", "1", TRUE); // showPercentageValues
$Employee_Personal_Record->Employee_Distribution->SetChartParam("showPercentageInLabel", "1", TRUE); // showPercentageInLabel
$Employee_Personal_Record->Employee_Distribution->SetChartParam("showBarShadow", "0", TRUE); // showBarShadow
$Employee_Personal_Record->Employee_Distribution->SetChartParam("showAnchors", "1", TRUE); // showAnchors
$Employee_Personal_Record->Employee_Distribution->SetChartParam("showAreaBorder", "1", TRUE); // showAreaBorder
$Employee_Personal_Record->Employee_Distribution->SetChartParam("isSliced", "1", TRUE); // isSliced
$Employee_Personal_Record->Employee_Distribution->SetChartParam("showAsBars", "0", TRUE); // showAsBars
$Employee_Personal_Record->Employee_Distribution->SetChartParam("showShadow", "0", TRUE); // showShadow
$Employee_Personal_Record->Employee_Distribution->SetChartParam("formatNumber", "0", TRUE); // formatNumber
$Employee_Personal_Record->Employee_Distribution->SetChartParam("formatNumberScale", "0", TRUE); // formatNumberScale
$Employee_Personal_Record->Employee_Distribution->SetChartParam("decimalSeparator", ".", TRUE); // decimalSeparator
$Employee_Personal_Record->Employee_Distribution->SetChartParam("thousandSeparator", ",", TRUE); // thousandSeparator
$Employee_Personal_Record->Employee_Distribution->SetChartParam("decimalPrecision", "2", TRUE); // decimalPrecision
$Employee_Personal_Record->Employee_Distribution->SetChartParam("divLineDecimalPrecision", "2", TRUE); // divLineDecimalPrecision
$Employee_Personal_Record->Employee_Distribution->SetChartParam("limitsDecimalPrecision", "2", TRUE); // limitsDecimalPrecision
$Employee_Personal_Record->Employee_Distribution->SetChartParam("zeroPlaneShowBorder", "1", TRUE); // zeroPlaneShowBorder
$Employee_Personal_Record->Employee_Distribution->SetChartParam("showDivLineValue", "1", TRUE); // showDivLineValue
$Employee_Personal_Record->Employee_Distribution->SetChartParam("showAlternateHGridColor", "0", TRUE); // showAlternateHGridColor
$Employee_Personal_Record->Employee_Distribution->SetChartParam("showAlternateVGridColor", "0", TRUE); // showAlternateVGridColor
$Employee_Personal_Record->Employee_Distribution->SetChartParam("hoverCapSepChar", ":", TRUE); // hoverCapSepChar

// Define trend lines
?>
<?php
$SqlSelect = $Employee_Personal_Record->SqlSelect();
$SqlChartSelect = $Employee_Personal_Record->Employee_Distribution->SqlSelect;
$sSqlChartBase = $Employee_Personal_Record->SqlFrom();

// Load chart data from sql directly
$sSql = $SqlChartSelect . $sSqlChartBase;
$sSql = ewrpt_BuildReportSql($sSql, $Employee_Personal_Record->SqlWhere(), $Employee_Personal_Record->Employee_Distribution->SqlGroupBy, "", $Employee_Personal_Record->Employee_Distribution->SqlOrderBy, $Employee_Personal_Record_summary->Filter, "");
if (EWRPT_DEBUG_ENABLED) echo "(Chart SQL): " . $sSql . "<br>";
ewrpt_LoadChartData($sSql, $Employee_Personal_Record->Employee_Distribution);
ewrpt_SortChartData($Employee_Personal_Record->Employee_Distribution->Data, 1, "");

// Call Chart_Rendering event
$Employee_Personal_Record->Chart_Rendering($Employee_Personal_Record->Employee_Distribution);
$chartxml = $Employee_Personal_Record->Employee_Distribution->ChartXml();

// Call Chart_Rendered event
$Employee_Personal_Record->Chart_Rendered($Employee_Personal_Record->Employee_Distribution, $chartxml);
echo $Employee_Personal_Record->Employee_Distribution->ShowChartFCF($chartxml);
?>
<a href="#top"><?php echo $ReportLanguage->Phrase("Top") ?></a>
<br /><br />
<?php } ?>
<?php if ($Employee_Personal_Record->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $Employee_Personal_Record_summary->ShowPageFooter(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($Employee_Personal_Record->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "phprptinc/footer.php"; ?>
<?php
$Employee_Personal_Record_summary->Page_Terminate();
?>
<?php

//
// Page class
//
class crEmployee_Personal_Record_summary {

	// Page ID
	var $PageID = 'summary';

	// Table name
	var $TableName = 'Employee Personal Record';

	// Page object name
	var $PageObjName = 'Employee_Personal_Record_summary';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $Employee_Personal_Record;
		if ($Employee_Personal_Record->UseTokenInUrl) $PageUrl .= "t=" . $Employee_Personal_Record->TableVar . "&"; // Add page token
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
		global $Employee_Personal_Record;
		if ($Employee_Personal_Record->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($Employee_Personal_Record->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($Employee_Personal_Record->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crEmployee_Personal_Record_summary() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (Employee_Personal_Record)
		$GLOBALS["Employee_Personal_Record"] = new crEmployee_Personal_Record();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'summary', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'Employee Personal Record', TRUE);

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
		global $Employee_Personal_Record;

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$Employee_Personal_Record->Export = $_GET["export"];
	}
	$gsExport = $Employee_Personal_Record->Export; // Get export parameter, used in header
	$gsExportFile = $Employee_Personal_Record->TableVar; // Get export file, used in header
	if ($Employee_Personal_Record->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($Employee_Personal_Record->Export == "word") {
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
		global $Employee_Personal_Record;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($Employee_Personal_Record->Export == "email") {
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
		global $Employee_Personal_Record;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 24;
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
		$this->Col = array(FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE);

		// Set up groups per page dynamically
		$this->SetUpDisplayGrps();
		$Employee_Personal_Record->Department->SelectionList = "";
		$Employee_Personal_Record->Department->DefaultSelectionList = "";
		$Employee_Personal_Record->Department->ValueList = "";
		$Employee_Personal_Record->ID->SelectionList = "";
		$Employee_Personal_Record->ID->DefaultSelectionList = "";
		$Employee_Personal_Record->ID->ValueList = "";
		$Employee_Personal_Record->FirstName->SelectionList = "";
		$Employee_Personal_Record->FirstName->DefaultSelectionList = "";
		$Employee_Personal_Record->FirstName->ValueList = "";
		$Employee_Personal_Record->MiddelName->SelectionList = "";
		$Employee_Personal_Record->MiddelName->DefaultSelectionList = "";
		$Employee_Personal_Record->MiddelName->ValueList = "";
		$Employee_Personal_Record->LastName->SelectionList = "";
		$Employee_Personal_Record->LastName->DefaultSelectionList = "";
		$Employee_Personal_Record->LastName->ValueList = "";
		$Employee_Personal_Record->Date_Birth->SelectionList = "";
		$Employee_Personal_Record->Date_Birth->DefaultSelectionList = "";
		$Employee_Personal_Record->Date_Birth->ValueList = "";
		$Employee_Personal_Record->Place_Birth->SelectionList = "";
		$Employee_Personal_Record->Place_Birth->DefaultSelectionList = "";
		$Employee_Personal_Record->Place_Birth->ValueList = "";
		$Employee_Personal_Record->Age->SelectionList = "";
		$Employee_Personal_Record->Age->DefaultSelectionList = "";
		$Employee_Personal_Record->Age->ValueList = "";
		$Employee_Personal_Record->Sex->SelectionList = "";
		$Employee_Personal_Record->Sex->DefaultSelectionList = "";
		$Employee_Personal_Record->Sex->ValueList = "";
		$Employee_Personal_Record->zEmail->SelectionList = "";
		$Employee_Personal_Record->zEmail->DefaultSelectionList = "";
		$Employee_Personal_Record->zEmail->ValueList = "";
		$Employee_Personal_Record->Date_Employement->SelectionList = "";
		$Employee_Personal_Record->Date_Employement->DefaultSelectionList = "";
		$Employee_Personal_Record->Date_Employement->ValueList = "";
		$Employee_Personal_Record->Position->SelectionList = "";
		$Employee_Personal_Record->Position->DefaultSelectionList = "";
		$Employee_Personal_Record->Position->ValueList = "";
		$Employee_Personal_Record->Educational_Status->SelectionList = "";
		$Employee_Personal_Record->Educational_Status->DefaultSelectionList = "";
		$Employee_Personal_Record->Educational_Status->ValueList = "";
		$Employee_Personal_Record->Salary->SelectionList = "";
		$Employee_Personal_Record->Salary->DefaultSelectionList = "";
		$Employee_Personal_Record->Salary->ValueList = "";
		$Employee_Personal_Record->Martial_Status->SelectionList = "";
		$Employee_Personal_Record->Martial_Status->DefaultSelectionList = "";
		$Employee_Personal_Record->Martial_Status->ValueList = "";
		$Employee_Personal_Record->Children_number->SelectionList = "";
		$Employee_Personal_Record->Children_number->DefaultSelectionList = "";
		$Employee_Personal_Record->Children_number->ValueList = "";
		$Employee_Personal_Record->Name_Child->SelectionList = "";
		$Employee_Personal_Record->Name_Child->DefaultSelectionList = "";
		$Employee_Personal_Record->Name_Child->ValueList = "";
		$Employee_Personal_Record->Age_Child->SelectionList = "";
		$Employee_Personal_Record->Age_Child->DefaultSelectionList = "";
		$Employee_Personal_Record->Age_Child->ValueList = "";
		$Employee_Personal_Record->Sex_Child->SelectionList = "";
		$Employee_Personal_Record->Sex_Child->DefaultSelectionList = "";
		$Employee_Personal_Record->Sex_Child->ValueList = "";
		$Employee_Personal_Record->Photo->SelectionList = "";
		$Employee_Personal_Record->Photo->DefaultSelectionList = "";
		$Employee_Personal_Record->Photo->ValueList = "";

		// Load default filter values
		$this->LoadDefaultFilters();

		// Set up popup filter
		$this->SetupPopup();

		// Extended filter
		$sExtendedFilter = "";

		// Get dropdown values
		$this->GetExtendedFilterValues();

		// Load custom filters
		$Employee_Personal_Record->CustomFilters_Load();

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
		$sGrpSort = ewrpt_UpdateSortFields($Employee_Personal_Record->SqlOrderByGroup(), $this->Sort, 2); // Get grouping field only
		$sSql = ewrpt_BuildReportSql($Employee_Personal_Record->SqlSelectGroup(), $Employee_Personal_Record->SqlWhere(), $Employee_Personal_Record->SqlGroupBy(), $Employee_Personal_Record->SqlHaving(), $Employee_Personal_Record->SqlOrderByGroup(), $this->Filter, $sGrpSort);
		$this->TotalGrps = $this->GetGrpCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($Employee_Personal_Record->ExportAll && $Employee_Personal_Record->Export <> "")
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
		global $Employee_Personal_Record;
		switch ($lvl) {
			case 1:
				return (is_null($Employee_Personal_Record->Department->CurrentValue) && !is_null($Employee_Personal_Record->Department->OldValue)) ||
					(!is_null($Employee_Personal_Record->Department->CurrentValue) && is_null($Employee_Personal_Record->Department->OldValue)) ||
					($Employee_Personal_Record->Department->GroupValue() <> $Employee_Personal_Record->Department->GroupOldValue());
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
		global $Employee_Personal_Record;
		$rsgrpcnt = $conn->Execute($sql);
		$grpcnt = ($rsgrpcnt) ? $rsgrpcnt->RecordCount() : 0;
		if ($rsgrpcnt) $rsgrpcnt->Close();
		return $grpcnt;
	}

	// Get group rs
	function GetGrpRs($sql, $start, $grps) {
		global $conn;
		global $Employee_Personal_Record;
		$wrksql = $sql;
		if ($start > 0 && $grps > -1)
			$wrksql .= " LIMIT " . ($start-1) . ", " . ($grps);
		$rswrk = $conn->Execute($wrksql);
		return $rswrk;
	}

	// Get group row values
	function GetGrpRow($opt) {
		global $rsgrp;
		global $Employee_Personal_Record;
		if (!$rsgrp)
			return;
		if ($opt == 1) { // Get first group

			//$rsgrp->MoveFirst(); // NOTE: no need to move position
			$Employee_Personal_Record->Department->setDbValue(""); // Init first value
		} else { // Get next group
			$rsgrp->MoveNext();
		}
		if (!$rsgrp->EOF)
			$Employee_Personal_Record->Department->setDbValue($rsgrp->fields('Department'));
		if ($rsgrp->EOF) {
			$Employee_Personal_Record->Department->setDbValue("");
		}
	}

	// Get row values
	function GetRow($opt) {
		global $rs;
		global $Employee_Personal_Record;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$Employee_Personal_Record->Auto_ID->setDbValue($rs->fields('Auto_ID'));
			$Employee_Personal_Record->ID->setDbValue($rs->fields('ID'));
			$Employee_Personal_Record->FirstName->setDbValue($rs->fields('FirstName'));
			$Employee_Personal_Record->MiddelName->setDbValue($rs->fields('MiddelName'));
			$Employee_Personal_Record->LastName->setDbValue($rs->fields('LastName'));
			$Employee_Personal_Record->Date_Birth->setDbValue($rs->fields('Date_Birth'));
			$Employee_Personal_Record->Place_Birth->setDbValue($rs->fields('Place_Birth'));
			$Employee_Personal_Record->Age->setDbValue($rs->fields('Age'));
			$Employee_Personal_Record->Sex->setDbValue($rs->fields('Sex'));
			$Employee_Personal_Record->zEmail->setDbValue($rs->fields('Email'));
			$Employee_Personal_Record->Date_Employement->setDbValue($rs->fields('Date_Employement'));
			if ($opt <> 1)
				$Employee_Personal_Record->Department->setDbValue($rs->fields('Department'));
			$Employee_Personal_Record->Position->setDbValue($rs->fields('Position'));
			$Employee_Personal_Record->Educational_Status->setDbValue($rs->fields('Educational_Status'));
			$Employee_Personal_Record->Salary->setDbValue($rs->fields('Salary'));
			$Employee_Personal_Record->Martial_Status->setDbValue($rs->fields('Martial_Status'));
			$Employee_Personal_Record->Children_number->setDbValue($rs->fields('Children_number'));
			$Employee_Personal_Record->Name_Child->setDbValue($rs->fields('Name_Child'));
			$Employee_Personal_Record->Age_Child->setDbValue($rs->fields('Age_Child'));
			$Employee_Personal_Record->Sex_Child->setDbValue($rs->fields('Sex_Child'));
			$Employee_Personal_Record->Photo->setDbValue($rs->fields('Photo'));
			$Employee_Personal_Record->Image->setDbValue($rs->fields('Image'));
			$Employee_Personal_Record->Experience->setDbValue($rs->fields('Experience'));
			$Employee_Personal_Record->HardCopy_Shelf_No->setDbValue($rs->fields('HardCopy_Shelf_No'));
			$Employee_Personal_Record->ModifiedBy->setDbValue($rs->fields('ModifiedBy'));
			$Employee_Personal_Record->Telephone->setDbValue($rs->fields('Telephone'));
			$this->Val[1] = $Employee_Personal_Record->ID->CurrentValue;
			$this->Val[2] = $Employee_Personal_Record->FirstName->CurrentValue;
			$this->Val[3] = $Employee_Personal_Record->MiddelName->CurrentValue;
			$this->Val[4] = $Employee_Personal_Record->LastName->CurrentValue;
			$this->Val[5] = $Employee_Personal_Record->Date_Birth->CurrentValue;
			$this->Val[6] = $Employee_Personal_Record->Place_Birth->CurrentValue;
			$this->Val[7] = $Employee_Personal_Record->Age->CurrentValue;
			$this->Val[8] = $Employee_Personal_Record->Sex->CurrentValue;
			$this->Val[9] = $Employee_Personal_Record->zEmail->CurrentValue;
			$this->Val[10] = $Employee_Personal_Record->Date_Employement->CurrentValue;
			$this->Val[11] = $Employee_Personal_Record->Position->CurrentValue;
			$this->Val[12] = $Employee_Personal_Record->Educational_Status->CurrentValue;
			$this->Val[13] = $Employee_Personal_Record->Salary->CurrentValue;
			$this->Val[14] = $Employee_Personal_Record->Martial_Status->CurrentValue;
			$this->Val[15] = $Employee_Personal_Record->Children_number->CurrentValue;
			$this->Val[16] = $Employee_Personal_Record->Name_Child->CurrentValue;
			$this->Val[17] = $Employee_Personal_Record->Age_Child->CurrentValue;
			$this->Val[18] = $Employee_Personal_Record->Sex_Child->CurrentValue;
			$this->Val[19] = $Employee_Personal_Record->Photo->CurrentValue;
			$this->Val[20] = $Employee_Personal_Record->Image->CurrentValue;
			$this->Val[21] = $Employee_Personal_Record->Experience->CurrentValue;
			$this->Val[22] = $Employee_Personal_Record->HardCopy_Shelf_No->CurrentValue;
			$this->Val[23] = $Employee_Personal_Record->Telephone->CurrentValue;
		} else {
			$Employee_Personal_Record->Auto_ID->setDbValue("");
			$Employee_Personal_Record->ID->setDbValue("");
			$Employee_Personal_Record->FirstName->setDbValue("");
			$Employee_Personal_Record->MiddelName->setDbValue("");
			$Employee_Personal_Record->LastName->setDbValue("");
			$Employee_Personal_Record->Date_Birth->setDbValue("");
			$Employee_Personal_Record->Place_Birth->setDbValue("");
			$Employee_Personal_Record->Age->setDbValue("");
			$Employee_Personal_Record->Sex->setDbValue("");
			$Employee_Personal_Record->zEmail->setDbValue("");
			$Employee_Personal_Record->Date_Employement->setDbValue("");
			$Employee_Personal_Record->Department->setDbValue("");
			$Employee_Personal_Record->Position->setDbValue("");
			$Employee_Personal_Record->Educational_Status->setDbValue("");
			$Employee_Personal_Record->Salary->setDbValue("");
			$Employee_Personal_Record->Martial_Status->setDbValue("");
			$Employee_Personal_Record->Children_number->setDbValue("");
			$Employee_Personal_Record->Name_Child->setDbValue("");
			$Employee_Personal_Record->Age_Child->setDbValue("");
			$Employee_Personal_Record->Sex_Child->setDbValue("");
			$Employee_Personal_Record->Photo->setDbValue("");
			$Employee_Personal_Record->Image->setDbValue("");
			$Employee_Personal_Record->Experience->setDbValue("");
			$Employee_Personal_Record->HardCopy_Shelf_No->setDbValue("");
			$Employee_Personal_Record->ModifiedBy->setDbValue("");
			$Employee_Personal_Record->Telephone->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $Employee_Personal_Record;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$Employee_Personal_Record->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$Employee_Personal_Record->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $Employee_Personal_Record->getStartGroup();
			}
		} else {
			$this->StartGrp = $Employee_Personal_Record->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$Employee_Personal_Record->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$Employee_Personal_Record->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$Employee_Personal_Record->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $Employee_Personal_Record;

		// Initialize popup
		// Build distinct values for Department

		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Employee_Personal_Record->Department->SqlSelect, $Employee_Personal_Record->SqlWhere(), $Employee_Personal_Record->SqlGroupBy(), $Employee_Personal_Record->SqlHaving(), $Employee_Personal_Record->Department->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Employee_Personal_Record->Department->setDbValue($rswrk->fields[0]);
			if (is_null($Employee_Personal_Record->Department->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Employee_Personal_Record->Department->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Employee_Personal_Record->Department->GroupViewValue = ewrpt_DisplayGroupValue($Employee_Personal_Record->Department,$Employee_Personal_Record->Department->GroupValue());
				ewrpt_SetupDistinctValues($Employee_Personal_Record->Department->ValueList, $Employee_Personal_Record->Department->GroupValue(), $Employee_Personal_Record->Department->GroupViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->Department->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->Department->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for ID
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Employee_Personal_Record->ID->SqlSelect, $Employee_Personal_Record->SqlWhere(), $Employee_Personal_Record->SqlGroupBy(), $Employee_Personal_Record->SqlHaving(), $Employee_Personal_Record->ID->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Employee_Personal_Record->ID->setDbValue($rswrk->fields[0]);
			if (is_null($Employee_Personal_Record->ID->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Employee_Personal_Record->ID->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Employee_Personal_Record->ID->ViewValue = $Employee_Personal_Record->ID->CurrentValue;
				ewrpt_SetupDistinctValues($Employee_Personal_Record->ID->ValueList, $Employee_Personal_Record->ID->CurrentValue, $Employee_Personal_Record->ID->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->ID->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->ID->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for FirstName
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Employee_Personal_Record->FirstName->SqlSelect, $Employee_Personal_Record->SqlWhere(), $Employee_Personal_Record->SqlGroupBy(), $Employee_Personal_Record->SqlHaving(), $Employee_Personal_Record->FirstName->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Employee_Personal_Record->FirstName->setDbValue($rswrk->fields[0]);
			if (is_null($Employee_Personal_Record->FirstName->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Employee_Personal_Record->FirstName->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Employee_Personal_Record->FirstName->ViewValue = $Employee_Personal_Record->FirstName->CurrentValue;
				ewrpt_SetupDistinctValues($Employee_Personal_Record->FirstName->ValueList, $Employee_Personal_Record->FirstName->CurrentValue, $Employee_Personal_Record->FirstName->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->FirstName->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->FirstName->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for MiddelName
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Employee_Personal_Record->MiddelName->SqlSelect, $Employee_Personal_Record->SqlWhere(), $Employee_Personal_Record->SqlGroupBy(), $Employee_Personal_Record->SqlHaving(), $Employee_Personal_Record->MiddelName->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Employee_Personal_Record->MiddelName->setDbValue($rswrk->fields[0]);
			if (is_null($Employee_Personal_Record->MiddelName->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Employee_Personal_Record->MiddelName->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Employee_Personal_Record->MiddelName->ViewValue = $Employee_Personal_Record->MiddelName->CurrentValue;
				ewrpt_SetupDistinctValues($Employee_Personal_Record->MiddelName->ValueList, $Employee_Personal_Record->MiddelName->CurrentValue, $Employee_Personal_Record->MiddelName->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->MiddelName->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->MiddelName->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for LastName
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Employee_Personal_Record->LastName->SqlSelect, $Employee_Personal_Record->SqlWhere(), $Employee_Personal_Record->SqlGroupBy(), $Employee_Personal_Record->SqlHaving(), $Employee_Personal_Record->LastName->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Employee_Personal_Record->LastName->setDbValue($rswrk->fields[0]);
			if (is_null($Employee_Personal_Record->LastName->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Employee_Personal_Record->LastName->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Employee_Personal_Record->LastName->ViewValue = $Employee_Personal_Record->LastName->CurrentValue;
				ewrpt_SetupDistinctValues($Employee_Personal_Record->LastName->ValueList, $Employee_Personal_Record->LastName->CurrentValue, $Employee_Personal_Record->LastName->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->LastName->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->LastName->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for Date_Birth
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Employee_Personal_Record->Date_Birth->SqlSelect, $Employee_Personal_Record->SqlWhere(), $Employee_Personal_Record->SqlGroupBy(), $Employee_Personal_Record->SqlHaving(), $Employee_Personal_Record->Date_Birth->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Employee_Personal_Record->Date_Birth->setDbValue($rswrk->fields[0]);
			if (is_null($Employee_Personal_Record->Date_Birth->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Employee_Personal_Record->Date_Birth->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Employee_Personal_Record->Date_Birth->ViewValue = ewrpt_FormatDateTime($Employee_Personal_Record->Date_Birth->CurrentValue, 5);
				ewrpt_SetupDistinctValues($Employee_Personal_Record->Date_Birth->ValueList, $Employee_Personal_Record->Date_Birth->CurrentValue, $Employee_Personal_Record->Date_Birth->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->Date_Birth->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->Date_Birth->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for Place_Birth
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Employee_Personal_Record->Place_Birth->SqlSelect, $Employee_Personal_Record->SqlWhere(), $Employee_Personal_Record->SqlGroupBy(), $Employee_Personal_Record->SqlHaving(), $Employee_Personal_Record->Place_Birth->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Employee_Personal_Record->Place_Birth->setDbValue($rswrk->fields[0]);
			if (is_null($Employee_Personal_Record->Place_Birth->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Employee_Personal_Record->Place_Birth->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Employee_Personal_Record->Place_Birth->ViewValue = $Employee_Personal_Record->Place_Birth->CurrentValue;
				ewrpt_SetupDistinctValues($Employee_Personal_Record->Place_Birth->ValueList, $Employee_Personal_Record->Place_Birth->CurrentValue, $Employee_Personal_Record->Place_Birth->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->Place_Birth->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->Place_Birth->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for Age
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Employee_Personal_Record->Age->SqlSelect, $Employee_Personal_Record->SqlWhere(), $Employee_Personal_Record->SqlGroupBy(), $Employee_Personal_Record->SqlHaving(), $Employee_Personal_Record->Age->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Employee_Personal_Record->Age->setDbValue($rswrk->fields[0]);
			if (is_null($Employee_Personal_Record->Age->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Employee_Personal_Record->Age->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Employee_Personal_Record->Age->ViewValue = $Employee_Personal_Record->Age->CurrentValue;
				ewrpt_SetupDistinctValues($Employee_Personal_Record->Age->ValueList, $Employee_Personal_Record->Age->CurrentValue, $Employee_Personal_Record->Age->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->Age->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->Age->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for Sex
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Employee_Personal_Record->Sex->SqlSelect, $Employee_Personal_Record->SqlWhere(), $Employee_Personal_Record->SqlGroupBy(), $Employee_Personal_Record->SqlHaving(), $Employee_Personal_Record->Sex->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Employee_Personal_Record->Sex->setDbValue($rswrk->fields[0]);
			if (is_null($Employee_Personal_Record->Sex->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Employee_Personal_Record->Sex->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Employee_Personal_Record->Sex->ViewValue = $Employee_Personal_Record->Sex->CurrentValue;
				ewrpt_SetupDistinctValues($Employee_Personal_Record->Sex->ValueList, $Employee_Personal_Record->Sex->CurrentValue, $Employee_Personal_Record->Sex->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->Sex->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->Sex->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for Email
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Employee_Personal_Record->zEmail->SqlSelect, $Employee_Personal_Record->SqlWhere(), $Employee_Personal_Record->SqlGroupBy(), $Employee_Personal_Record->SqlHaving(), $Employee_Personal_Record->zEmail->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Employee_Personal_Record->zEmail->setDbValue($rswrk->fields[0]);
			if (is_null($Employee_Personal_Record->zEmail->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Employee_Personal_Record->zEmail->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Employee_Personal_Record->zEmail->ViewValue = $Employee_Personal_Record->zEmail->CurrentValue;
				ewrpt_SetupDistinctValues($Employee_Personal_Record->zEmail->ValueList, $Employee_Personal_Record->zEmail->CurrentValue, $Employee_Personal_Record->zEmail->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->zEmail->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->zEmail->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for Date_Employement
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Employee_Personal_Record->Date_Employement->SqlSelect, $Employee_Personal_Record->SqlWhere(), $Employee_Personal_Record->SqlGroupBy(), $Employee_Personal_Record->SqlHaving(), $Employee_Personal_Record->Date_Employement->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Employee_Personal_Record->Date_Employement->setDbValue($rswrk->fields[0]);
			if (is_null($Employee_Personal_Record->Date_Employement->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Employee_Personal_Record->Date_Employement->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Employee_Personal_Record->Date_Employement->ViewValue = ewrpt_FormatDateTime($Employee_Personal_Record->Date_Employement->CurrentValue, 5);
				ewrpt_SetupDistinctValues($Employee_Personal_Record->Date_Employement->ValueList, $Employee_Personal_Record->Date_Employement->CurrentValue, $Employee_Personal_Record->Date_Employement->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->Date_Employement->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->Date_Employement->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for Position
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Employee_Personal_Record->Position->SqlSelect, $Employee_Personal_Record->SqlWhere(), $Employee_Personal_Record->SqlGroupBy(), $Employee_Personal_Record->SqlHaving(), $Employee_Personal_Record->Position->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Employee_Personal_Record->Position->setDbValue($rswrk->fields[0]);
			if (is_null($Employee_Personal_Record->Position->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Employee_Personal_Record->Position->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Employee_Personal_Record->Position->ViewValue = $Employee_Personal_Record->Position->CurrentValue;
				ewrpt_SetupDistinctValues($Employee_Personal_Record->Position->ValueList, $Employee_Personal_Record->Position->CurrentValue, $Employee_Personal_Record->Position->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->Position->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->Position->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for Educational_Status
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Employee_Personal_Record->Educational_Status->SqlSelect, $Employee_Personal_Record->SqlWhere(), $Employee_Personal_Record->SqlGroupBy(), $Employee_Personal_Record->SqlHaving(), $Employee_Personal_Record->Educational_Status->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Employee_Personal_Record->Educational_Status->setDbValue($rswrk->fields[0]);
			if (is_null($Employee_Personal_Record->Educational_Status->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Employee_Personal_Record->Educational_Status->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Employee_Personal_Record->Educational_Status->ViewValue = $Employee_Personal_Record->Educational_Status->CurrentValue;
				ewrpt_SetupDistinctValues($Employee_Personal_Record->Educational_Status->ValueList, $Employee_Personal_Record->Educational_Status->CurrentValue, $Employee_Personal_Record->Educational_Status->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->Educational_Status->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->Educational_Status->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for Salary
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Employee_Personal_Record->Salary->SqlSelect, $Employee_Personal_Record->SqlWhere(), $Employee_Personal_Record->SqlGroupBy(), $Employee_Personal_Record->SqlHaving(), $Employee_Personal_Record->Salary->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Employee_Personal_Record->Salary->setDbValue($rswrk->fields[0]);
			if (is_null($Employee_Personal_Record->Salary->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Employee_Personal_Record->Salary->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Employee_Personal_Record->Salary->ViewValue = $Employee_Personal_Record->Salary->CurrentValue;
				ewrpt_SetupDistinctValues($Employee_Personal_Record->Salary->ValueList, $Employee_Personal_Record->Salary->CurrentValue, $Employee_Personal_Record->Salary->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->Salary->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->Salary->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for Martial_Status
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Employee_Personal_Record->Martial_Status->SqlSelect, $Employee_Personal_Record->SqlWhere(), $Employee_Personal_Record->SqlGroupBy(), $Employee_Personal_Record->SqlHaving(), $Employee_Personal_Record->Martial_Status->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Employee_Personal_Record->Martial_Status->setDbValue($rswrk->fields[0]);
			if (is_null($Employee_Personal_Record->Martial_Status->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Employee_Personal_Record->Martial_Status->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Employee_Personal_Record->Martial_Status->ViewValue = $Employee_Personal_Record->Martial_Status->CurrentValue;
				ewrpt_SetupDistinctValues($Employee_Personal_Record->Martial_Status->ValueList, $Employee_Personal_Record->Martial_Status->CurrentValue, $Employee_Personal_Record->Martial_Status->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->Martial_Status->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->Martial_Status->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for Children_number
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Employee_Personal_Record->Children_number->SqlSelect, $Employee_Personal_Record->SqlWhere(), $Employee_Personal_Record->SqlGroupBy(), $Employee_Personal_Record->SqlHaving(), $Employee_Personal_Record->Children_number->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Employee_Personal_Record->Children_number->setDbValue($rswrk->fields[0]);
			if (is_null($Employee_Personal_Record->Children_number->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Employee_Personal_Record->Children_number->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Employee_Personal_Record->Children_number->ViewValue = $Employee_Personal_Record->Children_number->CurrentValue;
				ewrpt_SetupDistinctValues($Employee_Personal_Record->Children_number->ValueList, $Employee_Personal_Record->Children_number->CurrentValue, $Employee_Personal_Record->Children_number->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->Children_number->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->Children_number->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for Name_Child
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Employee_Personal_Record->Name_Child->SqlSelect, $Employee_Personal_Record->SqlWhere(), $Employee_Personal_Record->SqlGroupBy(), $Employee_Personal_Record->SqlHaving(), $Employee_Personal_Record->Name_Child->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Employee_Personal_Record->Name_Child->setDbValue($rswrk->fields[0]);
			if (is_null($Employee_Personal_Record->Name_Child->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Employee_Personal_Record->Name_Child->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Employee_Personal_Record->Name_Child->ViewValue = $Employee_Personal_Record->Name_Child->CurrentValue;
				ewrpt_SetupDistinctValues($Employee_Personal_Record->Name_Child->ValueList, $Employee_Personal_Record->Name_Child->CurrentValue, $Employee_Personal_Record->Name_Child->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->Name_Child->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->Name_Child->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for Age_Child
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Employee_Personal_Record->Age_Child->SqlSelect, $Employee_Personal_Record->SqlWhere(), $Employee_Personal_Record->SqlGroupBy(), $Employee_Personal_Record->SqlHaving(), $Employee_Personal_Record->Age_Child->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Employee_Personal_Record->Age_Child->setDbValue($rswrk->fields[0]);
			if (is_null($Employee_Personal_Record->Age_Child->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Employee_Personal_Record->Age_Child->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Employee_Personal_Record->Age_Child->ViewValue = $Employee_Personal_Record->Age_Child->CurrentValue;
				ewrpt_SetupDistinctValues($Employee_Personal_Record->Age_Child->ValueList, $Employee_Personal_Record->Age_Child->CurrentValue, $Employee_Personal_Record->Age_Child->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->Age_Child->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->Age_Child->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for Sex_Child
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Employee_Personal_Record->Sex_Child->SqlSelect, $Employee_Personal_Record->SqlWhere(), $Employee_Personal_Record->SqlGroupBy(), $Employee_Personal_Record->SqlHaving(), $Employee_Personal_Record->Sex_Child->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Employee_Personal_Record->Sex_Child->setDbValue($rswrk->fields[0]);
			if (is_null($Employee_Personal_Record->Sex_Child->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Employee_Personal_Record->Sex_Child->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Employee_Personal_Record->Sex_Child->ViewValue = $Employee_Personal_Record->Sex_Child->CurrentValue;
				ewrpt_SetupDistinctValues($Employee_Personal_Record->Sex_Child->ValueList, $Employee_Personal_Record->Sex_Child->CurrentValue, $Employee_Personal_Record->Sex_Child->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->Sex_Child->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->Sex_Child->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for Photo
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Employee_Personal_Record->Photo->SqlSelect, $Employee_Personal_Record->SqlWhere(), $Employee_Personal_Record->SqlGroupBy(), $Employee_Personal_Record->SqlHaving(), $Employee_Personal_Record->Photo->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Employee_Personal_Record->Photo->setDbValue($rswrk->fields[0]);
			if (is_null($Employee_Personal_Record->Photo->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Employee_Personal_Record->Photo->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Employee_Personal_Record->Photo->ViewValue = $Employee_Personal_Record->Photo->CurrentValue;
				ewrpt_SetupDistinctValues($Employee_Personal_Record->Photo->ValueList, $Employee_Personal_Record->Photo->CurrentValue, $Employee_Personal_Record->Photo->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->Photo->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Employee_Personal_Record->Photo->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

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
				$this->ClearSessionSelection('Date_Birth');
				$this->ClearSessionSelection('Place_Birth');
				$this->ClearSessionSelection('Age');
				$this->ClearSessionSelection('Sex');
				$this->ClearSessionSelection('zEmail');
				$this->ClearSessionSelection('Date_Employement');
				$this->ClearSessionSelection('Position');
				$this->ClearSessionSelection('Educational_Status');
				$this->ClearSessionSelection('Salary');
				$this->ClearSessionSelection('Martial_Status');
				$this->ClearSessionSelection('Children_number');
				$this->ClearSessionSelection('Name_Child');
				$this->ClearSessionSelection('Age_Child');
				$this->ClearSessionSelection('Sex_Child');
				$this->ClearSessionSelection('Photo');
				$this->ResetPager();
			}
		}

		// Load selection criteria to array
		// Get Department selected values

		if (is_array(@$_SESSION["sel_Employee_Personal_Record_Department"])) {
			$this->LoadSelectionFromSession('Department');
		} elseif (@$_SESSION["sel_Employee_Personal_Record_Department"] == EWRPT_INIT_VALUE) { // Select all
			$Employee_Personal_Record->Department->SelectionList = "";
		}

		// Get ID selected values
		if (is_array(@$_SESSION["sel_Employee_Personal_Record_ID"])) {
			$this->LoadSelectionFromSession('ID');
		} elseif (@$_SESSION["sel_Employee_Personal_Record_ID"] == EWRPT_INIT_VALUE) { // Select all
			$Employee_Personal_Record->ID->SelectionList = "";
		}

		// Get First Name selected values
		if (is_array(@$_SESSION["sel_Employee_Personal_Record_FirstName"])) {
			$this->LoadSelectionFromSession('FirstName');
		} elseif (@$_SESSION["sel_Employee_Personal_Record_FirstName"] == EWRPT_INIT_VALUE) { // Select all
			$Employee_Personal_Record->FirstName->SelectionList = "";
		}

		// Get Middel Name selected values
		if (is_array(@$_SESSION["sel_Employee_Personal_Record_MiddelName"])) {
			$this->LoadSelectionFromSession('MiddelName');
		} elseif (@$_SESSION["sel_Employee_Personal_Record_MiddelName"] == EWRPT_INIT_VALUE) { // Select all
			$Employee_Personal_Record->MiddelName->SelectionList = "";
		}

		// Get Last Name selected values
		if (is_array(@$_SESSION["sel_Employee_Personal_Record_LastName"])) {
			$this->LoadSelectionFromSession('LastName');
		} elseif (@$_SESSION["sel_Employee_Personal_Record_LastName"] == EWRPT_INIT_VALUE) { // Select all
			$Employee_Personal_Record->LastName->SelectionList = "";
		}

		// Get Date Birth selected values
		if (is_array(@$_SESSION["sel_Employee_Personal_Record_Date_Birth"])) {
			$this->LoadSelectionFromSession('Date_Birth');
		} elseif (@$_SESSION["sel_Employee_Personal_Record_Date_Birth"] == EWRPT_INIT_VALUE) { // Select all
			$Employee_Personal_Record->Date_Birth->SelectionList = "";
		}

		// Get Place Birth selected values
		if (is_array(@$_SESSION["sel_Employee_Personal_Record_Place_Birth"])) {
			$this->LoadSelectionFromSession('Place_Birth');
		} elseif (@$_SESSION["sel_Employee_Personal_Record_Place_Birth"] == EWRPT_INIT_VALUE) { // Select all
			$Employee_Personal_Record->Place_Birth->SelectionList = "";
		}

		// Get Age selected values
		if (is_array(@$_SESSION["sel_Employee_Personal_Record_Age"])) {
			$this->LoadSelectionFromSession('Age');
		} elseif (@$_SESSION["sel_Employee_Personal_Record_Age"] == EWRPT_INIT_VALUE) { // Select all
			$Employee_Personal_Record->Age->SelectionList = "";
		}

		// Get Sex selected values
		if (is_array(@$_SESSION["sel_Employee_Personal_Record_Sex"])) {
			$this->LoadSelectionFromSession('Sex');
		} elseif (@$_SESSION["sel_Employee_Personal_Record_Sex"] == EWRPT_INIT_VALUE) { // Select all
			$Employee_Personal_Record->Sex->SelectionList = "";
		}

		// Get Email selected values
		if (is_array(@$_SESSION["sel_Employee_Personal_Record_zEmail"])) {
			$this->LoadSelectionFromSession('zEmail');
		} elseif (@$_SESSION["sel_Employee_Personal_Record_zEmail"] == EWRPT_INIT_VALUE) { // Select all
			$Employee_Personal_Record->zEmail->SelectionList = "";
		}

		// Get Date Employement selected values
		if (is_array(@$_SESSION["sel_Employee_Personal_Record_Date_Employement"])) {
			$this->LoadSelectionFromSession('Date_Employement');
		} elseif (@$_SESSION["sel_Employee_Personal_Record_Date_Employement"] == EWRPT_INIT_VALUE) { // Select all
			$Employee_Personal_Record->Date_Employement->SelectionList = "";
		}

		// Get Position selected values
		if (is_array(@$_SESSION["sel_Employee_Personal_Record_Position"])) {
			$this->LoadSelectionFromSession('Position');
		} elseif (@$_SESSION["sel_Employee_Personal_Record_Position"] == EWRPT_INIT_VALUE) { // Select all
			$Employee_Personal_Record->Position->SelectionList = "";
		}

		// Get Educational Status selected values
		if (is_array(@$_SESSION["sel_Employee_Personal_Record_Educational_Status"])) {
			$this->LoadSelectionFromSession('Educational_Status');
		} elseif (@$_SESSION["sel_Employee_Personal_Record_Educational_Status"] == EWRPT_INIT_VALUE) { // Select all
			$Employee_Personal_Record->Educational_Status->SelectionList = "";
		}

		// Get Salary selected values
		if (is_array(@$_SESSION["sel_Employee_Personal_Record_Salary"])) {
			$this->LoadSelectionFromSession('Salary');
		} elseif (@$_SESSION["sel_Employee_Personal_Record_Salary"] == EWRPT_INIT_VALUE) { // Select all
			$Employee_Personal_Record->Salary->SelectionList = "";
		}

		// Get Martial Status selected values
		if (is_array(@$_SESSION["sel_Employee_Personal_Record_Martial_Status"])) {
			$this->LoadSelectionFromSession('Martial_Status');
		} elseif (@$_SESSION["sel_Employee_Personal_Record_Martial_Status"] == EWRPT_INIT_VALUE) { // Select all
			$Employee_Personal_Record->Martial_Status->SelectionList = "";
		}

		// Get Children number selected values
		if (is_array(@$_SESSION["sel_Employee_Personal_Record_Children_number"])) {
			$this->LoadSelectionFromSession('Children_number');
		} elseif (@$_SESSION["sel_Employee_Personal_Record_Children_number"] == EWRPT_INIT_VALUE) { // Select all
			$Employee_Personal_Record->Children_number->SelectionList = "";
		}

		// Get Name Child selected values
		if (is_array(@$_SESSION["sel_Employee_Personal_Record_Name_Child"])) {
			$this->LoadSelectionFromSession('Name_Child');
		} elseif (@$_SESSION["sel_Employee_Personal_Record_Name_Child"] == EWRPT_INIT_VALUE) { // Select all
			$Employee_Personal_Record->Name_Child->SelectionList = "";
		}

		// Get Age Child selected values
		if (is_array(@$_SESSION["sel_Employee_Personal_Record_Age_Child"])) {
			$this->LoadSelectionFromSession('Age_Child');
		} elseif (@$_SESSION["sel_Employee_Personal_Record_Age_Child"] == EWRPT_INIT_VALUE) { // Select all
			$Employee_Personal_Record->Age_Child->SelectionList = "";
		}

		// Get Sex Child selected values
		if (is_array(@$_SESSION["sel_Employee_Personal_Record_Sex_Child"])) {
			$this->LoadSelectionFromSession('Sex_Child');
		} elseif (@$_SESSION["sel_Employee_Personal_Record_Sex_Child"] == EWRPT_INIT_VALUE) { // Select all
			$Employee_Personal_Record->Sex_Child->SelectionList = "";
		}

		// Get Photo selected values
		if (is_array(@$_SESSION["sel_Employee_Personal_Record_Photo"])) {
			$this->LoadSelectionFromSession('Photo');
		} elseif (@$_SESSION["sel_Employee_Personal_Record_Photo"] == EWRPT_INIT_VALUE) { // Select all
			$Employee_Personal_Record->Photo->SelectionList = "";
		}
	}

	// Reset pager
	function ResetPager() {

		// Reset start position (reset command)
		global $Employee_Personal_Record;
		$this->StartGrp = 1;
		$Employee_Personal_Record->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $Employee_Personal_Record;
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
			$Employee_Personal_Record->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$Employee_Personal_Record->setStartGroup($this->StartGrp);
		} else {
			if ($Employee_Personal_Record->getGroupPerPage() <> "") {
				$this->DisplayGrps = $Employee_Personal_Record->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $Security;
		global $Employee_Personal_Record;
		if ($Employee_Personal_Record->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($Employee_Personal_Record->SqlSelectCount(), $Employee_Personal_Record->SqlWhere(), $Employee_Personal_Record->SqlGroupBy(), $Employee_Personal_Record->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}
		}

		// Call Row_Rendering event
		$Employee_Personal_Record->Row_Rendering();

		/* --------------------
		'  Render view codes
		' --------------------- */
		if ($Employee_Personal_Record->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// Department
			$Employee_Personal_Record->Department->GroupViewValue = $Employee_Personal_Record->Department->GroupOldValue();
			$Employee_Personal_Record->Department->CellAttrs["class"] = ($Employee_Personal_Record->RowGroupLevel == 1) ? "ewRptGrpSummary1" : "ewRptGrpField1";
			$Employee_Personal_Record->Department->GroupViewValue = ewrpt_DisplayGroupValue($Employee_Personal_Record->Department, $Employee_Personal_Record->Department->GroupViewValue);

			// ID
			$Employee_Personal_Record->ID->ViewValue = $Employee_Personal_Record->ID->Summary;

			// FirstName
			$Employee_Personal_Record->FirstName->ViewValue = $Employee_Personal_Record->FirstName->Summary;

			// MiddelName
			$Employee_Personal_Record->MiddelName->ViewValue = $Employee_Personal_Record->MiddelName->Summary;

			// LastName
			$Employee_Personal_Record->LastName->ViewValue = $Employee_Personal_Record->LastName->Summary;

			// Date_Birth
			$Employee_Personal_Record->Date_Birth->ViewValue = $Employee_Personal_Record->Date_Birth->Summary;
			$Employee_Personal_Record->Date_Birth->ViewValue = ewrpt_FormatDateTime($Employee_Personal_Record->Date_Birth->ViewValue, 5);

			// Place_Birth
			$Employee_Personal_Record->Place_Birth->ViewValue = $Employee_Personal_Record->Place_Birth->Summary;

			// Age
			$Employee_Personal_Record->Age->ViewValue = $Employee_Personal_Record->Age->Summary;

			// Sex
			$Employee_Personal_Record->Sex->ViewValue = $Employee_Personal_Record->Sex->Summary;

			// Email
			$Employee_Personal_Record->zEmail->ViewValue = $Employee_Personal_Record->zEmail->Summary;

			// Date_Employement
			$Employee_Personal_Record->Date_Employement->ViewValue = $Employee_Personal_Record->Date_Employement->Summary;
			$Employee_Personal_Record->Date_Employement->ViewValue = ewrpt_FormatDateTime($Employee_Personal_Record->Date_Employement->ViewValue, 5);

			// Position
			$Employee_Personal_Record->Position->ViewValue = $Employee_Personal_Record->Position->Summary;

			// Educational_Status
			$Employee_Personal_Record->Educational_Status->ViewValue = $Employee_Personal_Record->Educational_Status->Summary;

			// Salary
			$Employee_Personal_Record->Salary->ViewValue = $Employee_Personal_Record->Salary->Summary;

			// Martial_Status
			$Employee_Personal_Record->Martial_Status->ViewValue = $Employee_Personal_Record->Martial_Status->Summary;

			// Children_number
			$Employee_Personal_Record->Children_number->ViewValue = $Employee_Personal_Record->Children_number->Summary;

			// Name_Child
			$Employee_Personal_Record->Name_Child->ViewValue = $Employee_Personal_Record->Name_Child->Summary;

			// Age_Child
			$Employee_Personal_Record->Age_Child->ViewValue = $Employee_Personal_Record->Age_Child->Summary;

			// Sex_Child
			$Employee_Personal_Record->Sex_Child->ViewValue = $Employee_Personal_Record->Sex_Child->Summary;

			// Photo
			$Employee_Personal_Record->Photo->ViewValue = $Employee_Personal_Record->Photo->Summary;

			// Image
			if (!is_null($Employee_Personal_Record->Image->DbValue)) {
				$Employee_Personal_Record->Image->ViewValue = $Employee_Personal_Record->Image->FldCaption();
			} else {
				$Employee_Personal_Record->Image->ViewValue = "";
			}

			// Experience
			$Employee_Personal_Record->Experience->ViewValue = $Employee_Personal_Record->Experience->Summary;

			// HardCopy_Shelf_No
			$Employee_Personal_Record->HardCopy_Shelf_No->ViewValue = $Employee_Personal_Record->HardCopy_Shelf_No->Summary;

			// Telephone
			$Employee_Personal_Record->Telephone->ViewValue = $Employee_Personal_Record->Telephone->Summary;
		} else {

			// Department
			$Employee_Personal_Record->Department->GroupViewValue = $Employee_Personal_Record->Department->GroupValue();
			$Employee_Personal_Record->Department->CellAttrs["class"] = "ewRptGrpField1";
			$Employee_Personal_Record->Department->GroupViewValue = ewrpt_DisplayGroupValue($Employee_Personal_Record->Department, $Employee_Personal_Record->Department->GroupViewValue);
			if ($Employee_Personal_Record->Department->GroupValue() == $Employee_Personal_Record->Department->GroupOldValue() && !$this->ChkLvlBreak(1))
				$Employee_Personal_Record->Department->GroupViewValue = "&nbsp;";

			// ID
			$Employee_Personal_Record->ID->ViewValue = $Employee_Personal_Record->ID->CurrentValue;
			$Employee_Personal_Record->ID->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// FirstName
			$Employee_Personal_Record->FirstName->ViewValue = $Employee_Personal_Record->FirstName->CurrentValue;
			$Employee_Personal_Record->FirstName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// MiddelName
			$Employee_Personal_Record->MiddelName->ViewValue = $Employee_Personal_Record->MiddelName->CurrentValue;
			$Employee_Personal_Record->MiddelName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// LastName
			$Employee_Personal_Record->LastName->ViewValue = $Employee_Personal_Record->LastName->CurrentValue;
			$Employee_Personal_Record->LastName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Date_Birth
			$Employee_Personal_Record->Date_Birth->ViewValue = $Employee_Personal_Record->Date_Birth->CurrentValue;
			$Employee_Personal_Record->Date_Birth->ViewValue = ewrpt_FormatDateTime($Employee_Personal_Record->Date_Birth->ViewValue, 5);
			$Employee_Personal_Record->Date_Birth->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Place_Birth
			$Employee_Personal_Record->Place_Birth->ViewValue = $Employee_Personal_Record->Place_Birth->CurrentValue;
			$Employee_Personal_Record->Place_Birth->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Age
			$Employee_Personal_Record->Age->ViewValue = $Employee_Personal_Record->Age->CurrentValue;
			$Employee_Personal_Record->Age->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Sex
			$Employee_Personal_Record->Sex->ViewValue = $Employee_Personal_Record->Sex->CurrentValue;
			$Employee_Personal_Record->Sex->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Email
			$Employee_Personal_Record->zEmail->ViewValue = $Employee_Personal_Record->zEmail->CurrentValue;
			$Employee_Personal_Record->zEmail->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Date_Employement
			$Employee_Personal_Record->Date_Employement->ViewValue = $Employee_Personal_Record->Date_Employement->CurrentValue;
			$Employee_Personal_Record->Date_Employement->ViewValue = ewrpt_FormatDateTime($Employee_Personal_Record->Date_Employement->ViewValue, 5);
			$Employee_Personal_Record->Date_Employement->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Position
			$Employee_Personal_Record->Position->ViewValue = $Employee_Personal_Record->Position->CurrentValue;
			$Employee_Personal_Record->Position->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Educational_Status
			$Employee_Personal_Record->Educational_Status->ViewValue = $Employee_Personal_Record->Educational_Status->CurrentValue;
			$Employee_Personal_Record->Educational_Status->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Salary
			$Employee_Personal_Record->Salary->ViewValue = $Employee_Personal_Record->Salary->CurrentValue;
			$Employee_Personal_Record->Salary->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Martial_Status
			$Employee_Personal_Record->Martial_Status->ViewValue = $Employee_Personal_Record->Martial_Status->CurrentValue;
			$Employee_Personal_Record->Martial_Status->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Children_number
			$Employee_Personal_Record->Children_number->ViewValue = $Employee_Personal_Record->Children_number->CurrentValue;
			$Employee_Personal_Record->Children_number->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Name_Child
			$Employee_Personal_Record->Name_Child->ViewValue = $Employee_Personal_Record->Name_Child->CurrentValue;
			$Employee_Personal_Record->Name_Child->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Age_Child
			$Employee_Personal_Record->Age_Child->ViewValue = $Employee_Personal_Record->Age_Child->CurrentValue;
			$Employee_Personal_Record->Age_Child->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Sex_Child
			$Employee_Personal_Record->Sex_Child->ViewValue = $Employee_Personal_Record->Sex_Child->CurrentValue;
			$Employee_Personal_Record->Sex_Child->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Photo
			$Employee_Personal_Record->Photo->ViewValue = $Employee_Personal_Record->Photo->CurrentValue;
			$Employee_Personal_Record->Photo->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Image
			if (!is_null($Employee_Personal_Record->Image->DbValue)) {
				$Employee_Personal_Record->Image->ViewValue = $Employee_Personal_Record->Image->FldCaption();
			} else {
				$Employee_Personal_Record->Image->ViewValue = "";
			}
			$Employee_Personal_Record->Image->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Experience
			$Employee_Personal_Record->Experience->ViewValue = $Employee_Personal_Record->Experience->CurrentValue;
			$Employee_Personal_Record->Experience->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// HardCopy_Shelf_No
			$Employee_Personal_Record->HardCopy_Shelf_No->ViewValue = $Employee_Personal_Record->HardCopy_Shelf_No->CurrentValue;
			$Employee_Personal_Record->HardCopy_Shelf_No->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Telephone
			$Employee_Personal_Record->Telephone->ViewValue = $Employee_Personal_Record->Telephone->CurrentValue;
			$Employee_Personal_Record->Telephone->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// Department
		$Employee_Personal_Record->Department->HrefValue = "";

		// ID
		$Employee_Personal_Record->ID->HrefValue = "";

		// FirstName
		$Employee_Personal_Record->FirstName->HrefValue = "";

		// MiddelName
		$Employee_Personal_Record->MiddelName->HrefValue = "";

		// LastName
		$Employee_Personal_Record->LastName->HrefValue = "";

		// Date_Birth
		$Employee_Personal_Record->Date_Birth->HrefValue = "";

		// Place_Birth
		$Employee_Personal_Record->Place_Birth->HrefValue = "";

		// Age
		$Employee_Personal_Record->Age->HrefValue = "";

		// Sex
		$Employee_Personal_Record->Sex->HrefValue = "";

		// Email
		$Employee_Personal_Record->zEmail->HrefValue = "";

		// Date_Employement
		$Employee_Personal_Record->Date_Employement->HrefValue = "";

		// Position
		$Employee_Personal_Record->Position->HrefValue = "";

		// Educational_Status
		$Employee_Personal_Record->Educational_Status->HrefValue = "";

		// Salary
		$Employee_Personal_Record->Salary->HrefValue = "";

		// Martial_Status
		$Employee_Personal_Record->Martial_Status->HrefValue = "";

		// Children_number
		$Employee_Personal_Record->Children_number->HrefValue = "";

		// Name_Child
		$Employee_Personal_Record->Name_Child->HrefValue = "";

		// Age_Child
		$Employee_Personal_Record->Age_Child->HrefValue = "";

		// Sex_Child
		$Employee_Personal_Record->Sex_Child->HrefValue = "";

		// Photo
		$Employee_Personal_Record->Photo->HrefValue = "";

		// Image
		if (!empty($Employee_Personal_Record->Image->DbValue)) {
			$Employee_Personal_Record->Image->HrefValue = "Employee_Personal_Record_Image_rptbv.php?Auto_ID=" . $Employee_Personal_Record->Auto_ID->CurrentValue;
			if ($Employee_Personal_Record->Export <> "") $Employee_Personal_Record->Image->HrefValue = ewrpt_ConvertFullUrl($Employee_Personal_Record->Image->HrefValue);
		} else {
			$Employee_Personal_Record->Image->HrefValue = "";
		}

		// Experience
		$Employee_Personal_Record->Experience->HrefValue = "";

		// HardCopy_Shelf_No
		$Employee_Personal_Record->HardCopy_Shelf_No->HrefValue = "";

		// Telephone
		$Employee_Personal_Record->Telephone->HrefValue = "";

		// Call Row_Rendered event
		$Employee_Personal_Record->Row_Rendered();
	}

	// Get extended filter values
	function GetExtendedFilterValues() {
		global $Employee_Personal_Record;

		// Field Sex
		$sSelect = "SELECT DISTINCT `Sex` FROM " . $Employee_Personal_Record->SqlFrom();
		$sOrderBy = "`Sex` ASC";
		$wrkSql = ewrpt_BuildReportSql($sSelect, $Employee_Personal_Record->SqlWhere(), "", "", $sOrderBy, $this->UserIDFilter, "");
		$Employee_Personal_Record->Sex->DropDownList = ewrpt_GetDistinctValues("", $wrkSql);

		// Field Martial_Status
		$sSelect = "SELECT DISTINCT `Martial_Status` FROM " . $Employee_Personal_Record->SqlFrom();
		$sOrderBy = "`Martial_Status` ASC";
		$wrkSql = ewrpt_BuildReportSql($sSelect, $Employee_Personal_Record->SqlWhere(), "", "", $sOrderBy, $this->UserIDFilter, "");
		$Employee_Personal_Record->Martial_Status->DropDownList = ewrpt_GetDistinctValues("", $wrkSql);
	}

	// Return extended filter
	function GetExtendedFilter() {
		global $Employee_Personal_Record;
		global $gsFormError;
		$sFilter = "";
		$bPostBack = ewrpt_IsHttpPost();
		$bRestoreSession = TRUE;
		$bSetupFilter = FALSE;

		// Reset extended filter if filter changed
		if ($bPostBack) {

			// Clear extended filter for field ID
			if ($this->ClearExtFilter == 'Employee_Personal_Record_ID')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'ID');

			// Clear extended filter for field FirstName
			if ($this->ClearExtFilter == 'Employee_Personal_Record_FirstName')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'FirstName');

			// Clear extended filter for field MiddelName
			if ($this->ClearExtFilter == 'Employee_Personal_Record_MiddelName')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'MiddelName');

			// Clear extended filter for field LastName
			if ($this->ClearExtFilter == 'Employee_Personal_Record_LastName')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'LastName');

			// Clear extended filter for field Date_Birth
			if ($this->ClearExtFilter == 'Employee_Personal_Record_Date_Birth')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'Date_Birth');

			// Clear extended filter for field Place_Birth
			if ($this->ClearExtFilter == 'Employee_Personal_Record_Place_Birth')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'Place_Birth');

			// Clear extended filter for field Age
			if ($this->ClearExtFilter == 'Employee_Personal_Record_Age')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'Age');

			// Clear dropdown for field Sex
			if ($this->ClearExtFilter == 'Employee_Personal_Record_Sex')
				$this->SetSessionDropDownValue(EWRPT_INIT_VALUE, 'Sex');

			// Clear extended filter for field Email
			if ($this->ClearExtFilter == 'Employee_Personal_Record_zEmail')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'zEmail');

			// Clear extended filter for field Date_Employement
			if ($this->ClearExtFilter == 'Employee_Personal_Record_Date_Employement')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'Date_Employement');

			// Clear extended filter for field Department
			if ($this->ClearExtFilter == 'Employee_Personal_Record_Department')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'Department');

			// Clear extended filter for field Position
			if ($this->ClearExtFilter == 'Employee_Personal_Record_Position')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'Position');

			// Clear extended filter for field Educational_Status
			if ($this->ClearExtFilter == 'Employee_Personal_Record_Educational_Status')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'Educational_Status');

			// Clear extended filter for field Salary
			if ($this->ClearExtFilter == 'Employee_Personal_Record_Salary')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'Salary');

			// Clear dropdown for field Martial_Status
			if ($this->ClearExtFilter == 'Employee_Personal_Record_Martial_Status')
				$this->SetSessionDropDownValue(EWRPT_INIT_VALUE, 'Martial_Status');

			// Clear extended filter for field Children_number
			if ($this->ClearExtFilter == 'Employee_Personal_Record_Children_number')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'Children_number');

			// Clear extended filter for field Name_Child
			if ($this->ClearExtFilter == 'Employee_Personal_Record_Name_Child')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'Name_Child');

			// Clear extended filter for field Age_Child
			if ($this->ClearExtFilter == 'Employee_Personal_Record_Age_Child')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'Age_Child');

			// Clear extended filter for field Sex_Child
			if ($this->ClearExtFilter == 'Employee_Personal_Record_Sex_Child')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'Sex_Child');

		// Reset search command
		} elseif (@$_GET["cmd"] == "reset") {

			// Load default values
			// Field ID

			$this->SetSessionFilterValues($Employee_Personal_Record->ID->SearchValue, $Employee_Personal_Record->ID->SearchOperator, $Employee_Personal_Record->ID->SearchCondition, $Employee_Personal_Record->ID->SearchValue2, $Employee_Personal_Record->ID->SearchOperator2, 'ID');

			// Field FirstName
			$this->SetSessionFilterValues($Employee_Personal_Record->FirstName->SearchValue, $Employee_Personal_Record->FirstName->SearchOperator, $Employee_Personal_Record->FirstName->SearchCondition, $Employee_Personal_Record->FirstName->SearchValue2, $Employee_Personal_Record->FirstName->SearchOperator2, 'FirstName');

			// Field MiddelName
			$this->SetSessionFilterValues($Employee_Personal_Record->MiddelName->SearchValue, $Employee_Personal_Record->MiddelName->SearchOperator, $Employee_Personal_Record->MiddelName->SearchCondition, $Employee_Personal_Record->MiddelName->SearchValue2, $Employee_Personal_Record->MiddelName->SearchOperator2, 'MiddelName');

			// Field LastName
			$this->SetSessionFilterValues($Employee_Personal_Record->LastName->SearchValue, $Employee_Personal_Record->LastName->SearchOperator, $Employee_Personal_Record->LastName->SearchCondition, $Employee_Personal_Record->LastName->SearchValue2, $Employee_Personal_Record->LastName->SearchOperator2, 'LastName');

			// Field Date_Birth
			$this->SetSessionFilterValues($Employee_Personal_Record->Date_Birth->SearchValue, $Employee_Personal_Record->Date_Birth->SearchOperator, $Employee_Personal_Record->Date_Birth->SearchCondition, $Employee_Personal_Record->Date_Birth->SearchValue2, $Employee_Personal_Record->Date_Birth->SearchOperator2, 'Date_Birth');

			// Field Place_Birth
			$this->SetSessionFilterValues($Employee_Personal_Record->Place_Birth->SearchValue, $Employee_Personal_Record->Place_Birth->SearchOperator, $Employee_Personal_Record->Place_Birth->SearchCondition, $Employee_Personal_Record->Place_Birth->SearchValue2, $Employee_Personal_Record->Place_Birth->SearchOperator2, 'Place_Birth');

			// Field Age
			$this->SetSessionFilterValues($Employee_Personal_Record->Age->SearchValue, $Employee_Personal_Record->Age->SearchOperator, $Employee_Personal_Record->Age->SearchCondition, $Employee_Personal_Record->Age->SearchValue2, $Employee_Personal_Record->Age->SearchOperator2, 'Age');

			// Field Sex
			$this->SetSessionDropDownValue($Employee_Personal_Record->Sex->DropDownValue, 'Sex');

			// Field Email
			$this->SetSessionFilterValues($Employee_Personal_Record->zEmail->SearchValue, $Employee_Personal_Record->zEmail->SearchOperator, $Employee_Personal_Record->zEmail->SearchCondition, $Employee_Personal_Record->zEmail->SearchValue2, $Employee_Personal_Record->zEmail->SearchOperator2, 'zEmail');

			// Field Date_Employement
			$this->SetSessionFilterValues($Employee_Personal_Record->Date_Employement->SearchValue, $Employee_Personal_Record->Date_Employement->SearchOperator, $Employee_Personal_Record->Date_Employement->SearchCondition, $Employee_Personal_Record->Date_Employement->SearchValue2, $Employee_Personal_Record->Date_Employement->SearchOperator2, 'Date_Employement');

			// Field Department
			$this->SetSessionFilterValues($Employee_Personal_Record->Department->SearchValue, $Employee_Personal_Record->Department->SearchOperator, $Employee_Personal_Record->Department->SearchCondition, $Employee_Personal_Record->Department->SearchValue2, $Employee_Personal_Record->Department->SearchOperator2, 'Department');

			// Field Position
			$this->SetSessionFilterValues($Employee_Personal_Record->Position->SearchValue, $Employee_Personal_Record->Position->SearchOperator, $Employee_Personal_Record->Position->SearchCondition, $Employee_Personal_Record->Position->SearchValue2, $Employee_Personal_Record->Position->SearchOperator2, 'Position');

			// Field Educational_Status
			$this->SetSessionFilterValues($Employee_Personal_Record->Educational_Status->SearchValue, $Employee_Personal_Record->Educational_Status->SearchOperator, $Employee_Personal_Record->Educational_Status->SearchCondition, $Employee_Personal_Record->Educational_Status->SearchValue2, $Employee_Personal_Record->Educational_Status->SearchOperator2, 'Educational_Status');

			// Field Salary
			$this->SetSessionFilterValues($Employee_Personal_Record->Salary->SearchValue, $Employee_Personal_Record->Salary->SearchOperator, $Employee_Personal_Record->Salary->SearchCondition, $Employee_Personal_Record->Salary->SearchValue2, $Employee_Personal_Record->Salary->SearchOperator2, 'Salary');

			// Field Martial_Status
			$this->SetSessionDropDownValue($Employee_Personal_Record->Martial_Status->DropDownValue, 'Martial_Status');

			// Field Children_number
			$this->SetSessionFilterValues($Employee_Personal_Record->Children_number->SearchValue, $Employee_Personal_Record->Children_number->SearchOperator, $Employee_Personal_Record->Children_number->SearchCondition, $Employee_Personal_Record->Children_number->SearchValue2, $Employee_Personal_Record->Children_number->SearchOperator2, 'Children_number');

			// Field Name_Child
			$this->SetSessionFilterValues($Employee_Personal_Record->Name_Child->SearchValue, $Employee_Personal_Record->Name_Child->SearchOperator, $Employee_Personal_Record->Name_Child->SearchCondition, $Employee_Personal_Record->Name_Child->SearchValue2, $Employee_Personal_Record->Name_Child->SearchOperator2, 'Name_Child');

			// Field Age_Child
			$this->SetSessionFilterValues($Employee_Personal_Record->Age_Child->SearchValue, $Employee_Personal_Record->Age_Child->SearchOperator, $Employee_Personal_Record->Age_Child->SearchCondition, $Employee_Personal_Record->Age_Child->SearchValue2, $Employee_Personal_Record->Age_Child->SearchOperator2, 'Age_Child');

			// Field Sex_Child
			$this->SetSessionFilterValues($Employee_Personal_Record->Sex_Child->SearchValue, $Employee_Personal_Record->Sex_Child->SearchOperator, $Employee_Personal_Record->Sex_Child->SearchCondition, $Employee_Personal_Record->Sex_Child->SearchValue2, $Employee_Personal_Record->Sex_Child->SearchOperator2, 'Sex_Child');

			// Field Experience
			$this->SetSessionFilterValues($Employee_Personal_Record->Experience->SearchValue, $Employee_Personal_Record->Experience->SearchOperator, $Employee_Personal_Record->Experience->SearchCondition, $Employee_Personal_Record->Experience->SearchValue2, $Employee_Personal_Record->Experience->SearchOperator2, 'Experience');
			$bSetupFilter = TRUE;
		} else {

			// Field ID
			if ($this->GetFilterValues($Employee_Personal_Record->ID)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field FirstName
			if ($this->GetFilterValues($Employee_Personal_Record->FirstName)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field MiddelName
			if ($this->GetFilterValues($Employee_Personal_Record->MiddelName)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field LastName
			if ($this->GetFilterValues($Employee_Personal_Record->LastName)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field Date_Birth
			if ($this->GetFilterValues($Employee_Personal_Record->Date_Birth)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field Place_Birth
			if ($this->GetFilterValues($Employee_Personal_Record->Place_Birth)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field Age
			if ($this->GetFilterValues($Employee_Personal_Record->Age)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field Sex
			if ($this->GetDropDownValue($Employee_Personal_Record->Sex->DropDownValue, 'Sex')) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			} elseif ($Employee_Personal_Record->Sex->DropDownValue <> EWRPT_INIT_VALUE && !isset($_SESSION['sv_Employee_Personal_Record->Sex'])) {
				$bSetupFilter = TRUE;
			}

			// Field Email
			if ($this->GetFilterValues($Employee_Personal_Record->zEmail)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field Date_Employement
			if ($this->GetFilterValues($Employee_Personal_Record->Date_Employement)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field Department
			if ($this->GetFilterValues($Employee_Personal_Record->Department)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field Position
			if ($this->GetFilterValues($Employee_Personal_Record->Position)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field Educational_Status
			if ($this->GetFilterValues($Employee_Personal_Record->Educational_Status)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field Salary
			if ($this->GetFilterValues($Employee_Personal_Record->Salary)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field Martial_Status
			if ($this->GetDropDownValue($Employee_Personal_Record->Martial_Status->DropDownValue, 'Martial_Status')) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			} elseif ($Employee_Personal_Record->Martial_Status->DropDownValue <> EWRPT_INIT_VALUE && !isset($_SESSION['sv_Employee_Personal_Record->Martial_Status'])) {
				$bSetupFilter = TRUE;
			}

			// Field Children_number
			if ($this->GetFilterValues($Employee_Personal_Record->Children_number)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field Name_Child
			if ($this->GetFilterValues($Employee_Personal_Record->Name_Child)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field Age_Child
			if ($this->GetFilterValues($Employee_Personal_Record->Age_Child)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field Sex_Child
			if ($this->GetFilterValues($Employee_Personal_Record->Sex_Child)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field Experience
			if ($this->GetFilterValues($Employee_Personal_Record->Experience)) {
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
			$this->GetSessionFilterValues($Employee_Personal_Record->ID);

			// Field FirstName
			$this->GetSessionFilterValues($Employee_Personal_Record->FirstName);

			// Field MiddelName
			$this->GetSessionFilterValues($Employee_Personal_Record->MiddelName);

			// Field LastName
			$this->GetSessionFilterValues($Employee_Personal_Record->LastName);

			// Field Date_Birth
			$this->GetSessionFilterValues($Employee_Personal_Record->Date_Birth);

			// Field Place_Birth
			$this->GetSessionFilterValues($Employee_Personal_Record->Place_Birth);

			// Field Age
			$this->GetSessionFilterValues($Employee_Personal_Record->Age);

			// Field Sex
			$this->GetSessionDropDownValue($Employee_Personal_Record->Sex);

			// Field Email
			$this->GetSessionFilterValues($Employee_Personal_Record->zEmail);

			// Field Date_Employement
			$this->GetSessionFilterValues($Employee_Personal_Record->Date_Employement);

			// Field Department
			$this->GetSessionFilterValues($Employee_Personal_Record->Department);

			// Field Position
			$this->GetSessionFilterValues($Employee_Personal_Record->Position);

			// Field Educational_Status
			$this->GetSessionFilterValues($Employee_Personal_Record->Educational_Status);

			// Field Salary
			$this->GetSessionFilterValues($Employee_Personal_Record->Salary);

			// Field Martial_Status
			$this->GetSessionDropDownValue($Employee_Personal_Record->Martial_Status);

			// Field Children_number
			$this->GetSessionFilterValues($Employee_Personal_Record->Children_number);

			// Field Name_Child
			$this->GetSessionFilterValues($Employee_Personal_Record->Name_Child);

			// Field Age_Child
			$this->GetSessionFilterValues($Employee_Personal_Record->Age_Child);

			// Field Sex_Child
			$this->GetSessionFilterValues($Employee_Personal_Record->Sex_Child);

			// Field Experience
			$this->GetSessionFilterValues($Employee_Personal_Record->Experience);
		}

		// Call page filter validated event
		$Employee_Personal_Record->Page_FilterValidated();

		// Build SQL
		// Field ID

		$this->BuildExtendedFilter($Employee_Personal_Record->ID, $sFilter);

		// Field FirstName
		$this->BuildExtendedFilter($Employee_Personal_Record->FirstName, $sFilter);

		// Field MiddelName
		$this->BuildExtendedFilter($Employee_Personal_Record->MiddelName, $sFilter);

		// Field LastName
		$this->BuildExtendedFilter($Employee_Personal_Record->LastName, $sFilter);

		// Field Date_Birth
		$this->BuildExtendedFilter($Employee_Personal_Record->Date_Birth, $sFilter);

		// Field Place_Birth
		$this->BuildExtendedFilter($Employee_Personal_Record->Place_Birth, $sFilter);

		// Field Age
		$this->BuildExtendedFilter($Employee_Personal_Record->Age, $sFilter);

		// Field Sex
		$this->BuildDropDownFilter($Employee_Personal_Record->Sex, $sFilter, "");

		// Field Email
		$this->BuildExtendedFilter($Employee_Personal_Record->zEmail, $sFilter);

		// Field Date_Employement
		$this->BuildExtendedFilter($Employee_Personal_Record->Date_Employement, $sFilter);

		// Field Department
		$this->BuildExtendedFilter($Employee_Personal_Record->Department, $sFilter);

		// Field Position
		$this->BuildExtendedFilter($Employee_Personal_Record->Position, $sFilter);

		// Field Educational_Status
		$this->BuildExtendedFilter($Employee_Personal_Record->Educational_Status, $sFilter);

		// Field Salary
		$this->BuildExtendedFilter($Employee_Personal_Record->Salary, $sFilter);

		// Field Martial_Status
		$this->BuildDropDownFilter($Employee_Personal_Record->Martial_Status, $sFilter, "");

		// Field Children_number
		$this->BuildExtendedFilter($Employee_Personal_Record->Children_number, $sFilter);

		// Field Name_Child
		$this->BuildExtendedFilter($Employee_Personal_Record->Name_Child, $sFilter);

		// Field Age_Child
		$this->BuildExtendedFilter($Employee_Personal_Record->Age_Child, $sFilter);

		// Field Sex_Child
		$this->BuildExtendedFilter($Employee_Personal_Record->Sex_Child, $sFilter);

		// Field Experience
		$this->BuildExtendedFilter($Employee_Personal_Record->Experience, $sFilter);

		// Save parms to session
		// Field ID

		$this->SetSessionFilterValues($Employee_Personal_Record->ID->SearchValue, $Employee_Personal_Record->ID->SearchOperator, $Employee_Personal_Record->ID->SearchCondition, $Employee_Personal_Record->ID->SearchValue2, $Employee_Personal_Record->ID->SearchOperator2, 'ID');

		// Field FirstName
		$this->SetSessionFilterValues($Employee_Personal_Record->FirstName->SearchValue, $Employee_Personal_Record->FirstName->SearchOperator, $Employee_Personal_Record->FirstName->SearchCondition, $Employee_Personal_Record->FirstName->SearchValue2, $Employee_Personal_Record->FirstName->SearchOperator2, 'FirstName');

		// Field MiddelName
		$this->SetSessionFilterValues($Employee_Personal_Record->MiddelName->SearchValue, $Employee_Personal_Record->MiddelName->SearchOperator, $Employee_Personal_Record->MiddelName->SearchCondition, $Employee_Personal_Record->MiddelName->SearchValue2, $Employee_Personal_Record->MiddelName->SearchOperator2, 'MiddelName');

		// Field LastName
		$this->SetSessionFilterValues($Employee_Personal_Record->LastName->SearchValue, $Employee_Personal_Record->LastName->SearchOperator, $Employee_Personal_Record->LastName->SearchCondition, $Employee_Personal_Record->LastName->SearchValue2, $Employee_Personal_Record->LastName->SearchOperator2, 'LastName');

		// Field Date_Birth
		$this->SetSessionFilterValues($Employee_Personal_Record->Date_Birth->SearchValue, $Employee_Personal_Record->Date_Birth->SearchOperator, $Employee_Personal_Record->Date_Birth->SearchCondition, $Employee_Personal_Record->Date_Birth->SearchValue2, $Employee_Personal_Record->Date_Birth->SearchOperator2, 'Date_Birth');

		// Field Place_Birth
		$this->SetSessionFilterValues($Employee_Personal_Record->Place_Birth->SearchValue, $Employee_Personal_Record->Place_Birth->SearchOperator, $Employee_Personal_Record->Place_Birth->SearchCondition, $Employee_Personal_Record->Place_Birth->SearchValue2, $Employee_Personal_Record->Place_Birth->SearchOperator2, 'Place_Birth');

		// Field Age
		$this->SetSessionFilterValues($Employee_Personal_Record->Age->SearchValue, $Employee_Personal_Record->Age->SearchOperator, $Employee_Personal_Record->Age->SearchCondition, $Employee_Personal_Record->Age->SearchValue2, $Employee_Personal_Record->Age->SearchOperator2, 'Age');

		// Field Sex
		$this->SetSessionDropDownValue($Employee_Personal_Record->Sex->DropDownValue, 'Sex');

		// Field Email
		$this->SetSessionFilterValues($Employee_Personal_Record->zEmail->SearchValue, $Employee_Personal_Record->zEmail->SearchOperator, $Employee_Personal_Record->zEmail->SearchCondition, $Employee_Personal_Record->zEmail->SearchValue2, $Employee_Personal_Record->zEmail->SearchOperator2, 'zEmail');

		// Field Date_Employement
		$this->SetSessionFilterValues($Employee_Personal_Record->Date_Employement->SearchValue, $Employee_Personal_Record->Date_Employement->SearchOperator, $Employee_Personal_Record->Date_Employement->SearchCondition, $Employee_Personal_Record->Date_Employement->SearchValue2, $Employee_Personal_Record->Date_Employement->SearchOperator2, 'Date_Employement');

		// Field Department
		$this->SetSessionFilterValues($Employee_Personal_Record->Department->SearchValue, $Employee_Personal_Record->Department->SearchOperator, $Employee_Personal_Record->Department->SearchCondition, $Employee_Personal_Record->Department->SearchValue2, $Employee_Personal_Record->Department->SearchOperator2, 'Department');

		// Field Position
		$this->SetSessionFilterValues($Employee_Personal_Record->Position->SearchValue, $Employee_Personal_Record->Position->SearchOperator, $Employee_Personal_Record->Position->SearchCondition, $Employee_Personal_Record->Position->SearchValue2, $Employee_Personal_Record->Position->SearchOperator2, 'Position');

		// Field Educational_Status
		$this->SetSessionFilterValues($Employee_Personal_Record->Educational_Status->SearchValue, $Employee_Personal_Record->Educational_Status->SearchOperator, $Employee_Personal_Record->Educational_Status->SearchCondition, $Employee_Personal_Record->Educational_Status->SearchValue2, $Employee_Personal_Record->Educational_Status->SearchOperator2, 'Educational_Status');

		// Field Salary
		$this->SetSessionFilterValues($Employee_Personal_Record->Salary->SearchValue, $Employee_Personal_Record->Salary->SearchOperator, $Employee_Personal_Record->Salary->SearchCondition, $Employee_Personal_Record->Salary->SearchValue2, $Employee_Personal_Record->Salary->SearchOperator2, 'Salary');

		// Field Martial_Status
		$this->SetSessionDropDownValue($Employee_Personal_Record->Martial_Status->DropDownValue, 'Martial_Status');

		// Field Children_number
		$this->SetSessionFilterValues($Employee_Personal_Record->Children_number->SearchValue, $Employee_Personal_Record->Children_number->SearchOperator, $Employee_Personal_Record->Children_number->SearchCondition, $Employee_Personal_Record->Children_number->SearchValue2, $Employee_Personal_Record->Children_number->SearchOperator2, 'Children_number');

		// Field Name_Child
		$this->SetSessionFilterValues($Employee_Personal_Record->Name_Child->SearchValue, $Employee_Personal_Record->Name_Child->SearchOperator, $Employee_Personal_Record->Name_Child->SearchCondition, $Employee_Personal_Record->Name_Child->SearchValue2, $Employee_Personal_Record->Name_Child->SearchOperator2, 'Name_Child');

		// Field Age_Child
		$this->SetSessionFilterValues($Employee_Personal_Record->Age_Child->SearchValue, $Employee_Personal_Record->Age_Child->SearchOperator, $Employee_Personal_Record->Age_Child->SearchCondition, $Employee_Personal_Record->Age_Child->SearchValue2, $Employee_Personal_Record->Age_Child->SearchOperator2, 'Age_Child');

		// Field Sex_Child
		$this->SetSessionFilterValues($Employee_Personal_Record->Sex_Child->SearchValue, $Employee_Personal_Record->Sex_Child->SearchOperator, $Employee_Personal_Record->Sex_Child->SearchCondition, $Employee_Personal_Record->Sex_Child->SearchValue2, $Employee_Personal_Record->Sex_Child->SearchOperator2, 'Sex_Child');

		// Field Experience
		$this->SetSessionFilterValues($Employee_Personal_Record->Experience->SearchValue, $Employee_Personal_Record->Experience->SearchOperator, $Employee_Personal_Record->Experience->SearchCondition, $Employee_Personal_Record->Experience->SearchValue2, $Employee_Personal_Record->Experience->SearchOperator2, 'Experience');

		// Setup filter
		if ($bSetupFilter) {

			// Field ID
			$sWrk = "";
			$this->BuildExtendedFilter($Employee_Personal_Record->ID, $sWrk);
			$this->LoadSelectionFromFilter($Employee_Personal_Record->ID, $sWrk, $Employee_Personal_Record->ID->SelectionList);
			$_SESSION['sel_Employee_Personal_Record_ID'] = ($Employee_Personal_Record->ID->SelectionList == "") ? EWRPT_INIT_VALUE : $Employee_Personal_Record->ID->SelectionList;

			// Field FirstName
			$sWrk = "";
			$this->BuildExtendedFilter($Employee_Personal_Record->FirstName, $sWrk);
			$this->LoadSelectionFromFilter($Employee_Personal_Record->FirstName, $sWrk, $Employee_Personal_Record->FirstName->SelectionList);
			$_SESSION['sel_Employee_Personal_Record_FirstName'] = ($Employee_Personal_Record->FirstName->SelectionList == "") ? EWRPT_INIT_VALUE : $Employee_Personal_Record->FirstName->SelectionList;

			// Field MiddelName
			$sWrk = "";
			$this->BuildExtendedFilter($Employee_Personal_Record->MiddelName, $sWrk);
			$this->LoadSelectionFromFilter($Employee_Personal_Record->MiddelName, $sWrk, $Employee_Personal_Record->MiddelName->SelectionList);
			$_SESSION['sel_Employee_Personal_Record_MiddelName'] = ($Employee_Personal_Record->MiddelName->SelectionList == "") ? EWRPT_INIT_VALUE : $Employee_Personal_Record->MiddelName->SelectionList;

			// Field LastName
			$sWrk = "";
			$this->BuildExtendedFilter($Employee_Personal_Record->LastName, $sWrk);
			$this->LoadSelectionFromFilter($Employee_Personal_Record->LastName, $sWrk, $Employee_Personal_Record->LastName->SelectionList);
			$_SESSION['sel_Employee_Personal_Record_LastName'] = ($Employee_Personal_Record->LastName->SelectionList == "") ? EWRPT_INIT_VALUE : $Employee_Personal_Record->LastName->SelectionList;

			// Field Date_Birth
			$sWrk = "";
			$this->BuildExtendedFilter($Employee_Personal_Record->Date_Birth, $sWrk);
			$this->LoadSelectionFromFilter($Employee_Personal_Record->Date_Birth, $sWrk, $Employee_Personal_Record->Date_Birth->SelectionList);
			$_SESSION['sel_Employee_Personal_Record_Date_Birth'] = ($Employee_Personal_Record->Date_Birth->SelectionList == "") ? EWRPT_INIT_VALUE : $Employee_Personal_Record->Date_Birth->SelectionList;

			// Field Place_Birth
			$sWrk = "";
			$this->BuildExtendedFilter($Employee_Personal_Record->Place_Birth, $sWrk);
			$this->LoadSelectionFromFilter($Employee_Personal_Record->Place_Birth, $sWrk, $Employee_Personal_Record->Place_Birth->SelectionList);
			$_SESSION['sel_Employee_Personal_Record_Place_Birth'] = ($Employee_Personal_Record->Place_Birth->SelectionList == "") ? EWRPT_INIT_VALUE : $Employee_Personal_Record->Place_Birth->SelectionList;

			// Field Age
			$sWrk = "";
			$this->BuildExtendedFilter($Employee_Personal_Record->Age, $sWrk);
			$this->LoadSelectionFromFilter($Employee_Personal_Record->Age, $sWrk, $Employee_Personal_Record->Age->SelectionList);
			$_SESSION['sel_Employee_Personal_Record_Age'] = ($Employee_Personal_Record->Age->SelectionList == "") ? EWRPT_INIT_VALUE : $Employee_Personal_Record->Age->SelectionList;

			// Field Sex
			$sWrk = "";
			$this->BuildDropDownFilter($Employee_Personal_Record->Sex, $sWrk, "");
			$this->LoadSelectionFromFilter($Employee_Personal_Record->Sex, $sWrk, $Employee_Personal_Record->Sex->SelectionList);
			$_SESSION['sel_Employee_Personal_Record_Sex'] = ($Employee_Personal_Record->Sex->SelectionList == "") ? EWRPT_INIT_VALUE : $Employee_Personal_Record->Sex->SelectionList;

			// Field Email
			$sWrk = "";
			$this->BuildExtendedFilter($Employee_Personal_Record->zEmail, $sWrk);
			$this->LoadSelectionFromFilter($Employee_Personal_Record->zEmail, $sWrk, $Employee_Personal_Record->zEmail->SelectionList);
			$_SESSION['sel_Employee_Personal_Record_zEmail'] = ($Employee_Personal_Record->zEmail->SelectionList == "") ? EWRPT_INIT_VALUE : $Employee_Personal_Record->zEmail->SelectionList;

			// Field Date_Employement
			$sWrk = "";
			$this->BuildExtendedFilter($Employee_Personal_Record->Date_Employement, $sWrk);
			$this->LoadSelectionFromFilter($Employee_Personal_Record->Date_Employement, $sWrk, $Employee_Personal_Record->Date_Employement->SelectionList);
			$_SESSION['sel_Employee_Personal_Record_Date_Employement'] = ($Employee_Personal_Record->Date_Employement->SelectionList == "") ? EWRPT_INIT_VALUE : $Employee_Personal_Record->Date_Employement->SelectionList;

			// Field Department
			$sWrk = "";
			$this->BuildExtendedFilter($Employee_Personal_Record->Department, $sWrk);
			$this->LoadSelectionFromFilter($Employee_Personal_Record->Department, $sWrk, $Employee_Personal_Record->Department->SelectionList);
			$_SESSION['sel_Employee_Personal_Record_Department'] = ($Employee_Personal_Record->Department->SelectionList == "") ? EWRPT_INIT_VALUE : $Employee_Personal_Record->Department->SelectionList;

			// Field Position
			$sWrk = "";
			$this->BuildExtendedFilter($Employee_Personal_Record->Position, $sWrk);
			$this->LoadSelectionFromFilter($Employee_Personal_Record->Position, $sWrk, $Employee_Personal_Record->Position->SelectionList);
			$_SESSION['sel_Employee_Personal_Record_Position'] = ($Employee_Personal_Record->Position->SelectionList == "") ? EWRPT_INIT_VALUE : $Employee_Personal_Record->Position->SelectionList;

			// Field Educational_Status
			$sWrk = "";
			$this->BuildExtendedFilter($Employee_Personal_Record->Educational_Status, $sWrk);
			$this->LoadSelectionFromFilter($Employee_Personal_Record->Educational_Status, $sWrk, $Employee_Personal_Record->Educational_Status->SelectionList);
			$_SESSION['sel_Employee_Personal_Record_Educational_Status'] = ($Employee_Personal_Record->Educational_Status->SelectionList == "") ? EWRPT_INIT_VALUE : $Employee_Personal_Record->Educational_Status->SelectionList;

			// Field Salary
			$sWrk = "";
			$this->BuildExtendedFilter($Employee_Personal_Record->Salary, $sWrk);
			$this->LoadSelectionFromFilter($Employee_Personal_Record->Salary, $sWrk, $Employee_Personal_Record->Salary->SelectionList);
			$_SESSION['sel_Employee_Personal_Record_Salary'] = ($Employee_Personal_Record->Salary->SelectionList == "") ? EWRPT_INIT_VALUE : $Employee_Personal_Record->Salary->SelectionList;

			// Field Martial_Status
			$sWrk = "";
			$this->BuildDropDownFilter($Employee_Personal_Record->Martial_Status, $sWrk, "");
			$this->LoadSelectionFromFilter($Employee_Personal_Record->Martial_Status, $sWrk, $Employee_Personal_Record->Martial_Status->SelectionList);
			$_SESSION['sel_Employee_Personal_Record_Martial_Status'] = ($Employee_Personal_Record->Martial_Status->SelectionList == "") ? EWRPT_INIT_VALUE : $Employee_Personal_Record->Martial_Status->SelectionList;

			// Field Children_number
			$sWrk = "";
			$this->BuildExtendedFilter($Employee_Personal_Record->Children_number, $sWrk);
			$this->LoadSelectionFromFilter($Employee_Personal_Record->Children_number, $sWrk, $Employee_Personal_Record->Children_number->SelectionList);
			$_SESSION['sel_Employee_Personal_Record_Children_number'] = ($Employee_Personal_Record->Children_number->SelectionList == "") ? EWRPT_INIT_VALUE : $Employee_Personal_Record->Children_number->SelectionList;

			// Field Name_Child
			$sWrk = "";
			$this->BuildExtendedFilter($Employee_Personal_Record->Name_Child, $sWrk);
			$this->LoadSelectionFromFilter($Employee_Personal_Record->Name_Child, $sWrk, $Employee_Personal_Record->Name_Child->SelectionList);
			$_SESSION['sel_Employee_Personal_Record_Name_Child'] = ($Employee_Personal_Record->Name_Child->SelectionList == "") ? EWRPT_INIT_VALUE : $Employee_Personal_Record->Name_Child->SelectionList;

			// Field Age_Child
			$sWrk = "";
			$this->BuildExtendedFilter($Employee_Personal_Record->Age_Child, $sWrk);
			$this->LoadSelectionFromFilter($Employee_Personal_Record->Age_Child, $sWrk, $Employee_Personal_Record->Age_Child->SelectionList);
			$_SESSION['sel_Employee_Personal_Record_Age_Child'] = ($Employee_Personal_Record->Age_Child->SelectionList == "") ? EWRPT_INIT_VALUE : $Employee_Personal_Record->Age_Child->SelectionList;

			// Field Sex_Child
			$sWrk = "";
			$this->BuildExtendedFilter($Employee_Personal_Record->Sex_Child, $sWrk);
			$this->LoadSelectionFromFilter($Employee_Personal_Record->Sex_Child, $sWrk, $Employee_Personal_Record->Sex_Child->SelectionList);
			$_SESSION['sel_Employee_Personal_Record_Sex_Child'] = ($Employee_Personal_Record->Sex_Child->SelectionList == "") ? EWRPT_INIT_VALUE : $Employee_Personal_Record->Sex_Child->SelectionList;
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
		$this->GetSessionValue($fld->DropDownValue, 'sv_Employee_Personal_Record_' . $parm);
	}

	// Get filter values from session
	function GetSessionFilterValues(&$fld) {
		$parm = substr($fld->FldVar, 2);
		$this->GetSessionValue($fld->SearchValue, 'sv1_Employee_Personal_Record_' . $parm);
		$this->GetSessionValue($fld->SearchOperator, 'so1_Employee_Personal_Record_' . $parm);
		$this->GetSessionValue($fld->SearchCondition, 'sc_Employee_Personal_Record_' . $parm);
		$this->GetSessionValue($fld->SearchValue2, 'sv2_Employee_Personal_Record_' . $parm);
		$this->GetSessionValue($fld->SearchOperator2, 'so2_Employee_Personal_Record_' . $parm);
	}

	// Get value from session
	function GetSessionValue(&$sv, $sn) {
		if (isset($_SESSION[$sn]))
			$sv = $_SESSION[$sn];
	}

	// Set dropdown value to session
	function SetSessionDropDownValue($sv, $parm) {
		$_SESSION['sv_Employee_Personal_Record_' . $parm] = $sv;
	}

	// Set filter values to session
	function SetSessionFilterValues($sv1, $so1, $sc, $sv2, $so2, $parm) {
		$_SESSION['sv1_Employee_Personal_Record_' . $parm] = $sv1;
		$_SESSION['so1_Employee_Personal_Record_' . $parm] = $so1;
		$_SESSION['sc_Employee_Personal_Record_' . $parm] = $sc;
		$_SESSION['sv2_Employee_Personal_Record_' . $parm] = $sv2;
		$_SESSION['so2_Employee_Personal_Record_' . $parm] = $so2;
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
		global $ReportLanguage, $gsFormError, $Employee_Personal_Record;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EWRPT_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ewrpt_CheckDate($Employee_Personal_Record->Date_Birth->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Employee_Personal_Record->Date_Birth->FldErrMsg();
		}
		if (!ewrpt_CheckDate($Employee_Personal_Record->Date_Birth->SearchValue2)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Employee_Personal_Record->Date_Birth->FldErrMsg();
		}
		if (!ewrpt_CheckInteger($Employee_Personal_Record->Age->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Employee_Personal_Record->Age->FldErrMsg();
		}
		if (!ewrpt_CheckDate($Employee_Personal_Record->Date_Employement->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Employee_Personal_Record->Date_Employement->FldErrMsg();
		}
		if (!ewrpt_CheckDate($Employee_Personal_Record->Date_Employement->SearchValue2)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Employee_Personal_Record->Date_Employement->FldErrMsg();
		}
		if (!ewrpt_CheckInteger($Employee_Personal_Record->Salary->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Employee_Personal_Record->Salary->FldErrMsg();
		}
		if (!ewrpt_CheckInteger($Employee_Personal_Record->Children_number->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Employee_Personal_Record->Children_number->FldErrMsg();
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
		$_SESSION["sel_Employee_Personal_Record_$parm"] = "";
		$_SESSION["rf_Employee_Personal_Record_$parm"] = "";
		$_SESSION["rt_Employee_Personal_Record_$parm"] = "";
	}

	// Load selection from session
	function LoadSelectionFromSession($parm) {
		global $Employee_Personal_Record;
		$fld =& $Employee_Personal_Record->fields($parm);
		$fld->SelectionList = @$_SESSION["sel_Employee_Personal_Record_$parm"];
		$fld->RangeFrom = @$_SESSION["rf_Employee_Personal_Record_$parm"];
		$fld->RangeTo = @$_SESSION["rt_Employee_Personal_Record_$parm"];
	}

	// Load default value for filters
	function LoadDefaultFilters() {
		global $Employee_Personal_Record;

		/**
		* Set up default values for non Text filters
		*/

		// Field Sex
		$Employee_Personal_Record->Sex->DefaultDropDownValue = "Male";
		$Employee_Personal_Record->Sex->DropDownValue = $Employee_Personal_Record->Sex->DefaultDropDownValue;
		$sWrk = "";
		$this->BuildDropDownFilter($Employee_Personal_Record->Sex, $sWrk, "");
		$this->LoadSelectionFromFilter($Employee_Personal_Record->Sex, $sWrk, $Employee_Personal_Record->Sex->DefaultSelectionList);

		// Field Martial_Status
		$Employee_Personal_Record->Martial_Status->DefaultDropDownValue = EWRPT_INIT_VALUE;
		$Employee_Personal_Record->Martial_Status->DropDownValue = $Employee_Personal_Record->Martial_Status->DefaultDropDownValue;
		$sWrk = "";
		$this->BuildDropDownFilter($Employee_Personal_Record->Martial_Status, $sWrk, "");
		$this->LoadSelectionFromFilter($Employee_Personal_Record->Martial_Status, $sWrk, $Employee_Personal_Record->Martial_Status->DefaultSelectionList);

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
		$this->SetDefaultExtFilter($Employee_Personal_Record->ID, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Employee_Personal_Record->ID);
		$sWrk = "";
		$this->BuildExtendedFilter($Employee_Personal_Record->ID, $sWrk);
		$this->LoadSelectionFromFilter($Employee_Personal_Record->ID, $sWrk, $Employee_Personal_Record->ID->DefaultSelectionList);
		$Employee_Personal_Record->ID->SelectionList = $Employee_Personal_Record->ID->DefaultSelectionList;

		// Field FirstName
		$this->SetDefaultExtFilter($Employee_Personal_Record->FirstName, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Employee_Personal_Record->FirstName);
		$sWrk = "";
		$this->BuildExtendedFilter($Employee_Personal_Record->FirstName, $sWrk);
		$this->LoadSelectionFromFilter($Employee_Personal_Record->FirstName, $sWrk, $Employee_Personal_Record->FirstName->DefaultSelectionList);
		$Employee_Personal_Record->FirstName->SelectionList = $Employee_Personal_Record->FirstName->DefaultSelectionList;

		// Field MiddelName
		$this->SetDefaultExtFilter($Employee_Personal_Record->MiddelName, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Employee_Personal_Record->MiddelName);
		$sWrk = "";
		$this->BuildExtendedFilter($Employee_Personal_Record->MiddelName, $sWrk);
		$this->LoadSelectionFromFilter($Employee_Personal_Record->MiddelName, $sWrk, $Employee_Personal_Record->MiddelName->DefaultSelectionList);
		$Employee_Personal_Record->MiddelName->SelectionList = $Employee_Personal_Record->MiddelName->DefaultSelectionList;

		// Field LastName
		$this->SetDefaultExtFilter($Employee_Personal_Record->LastName, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Employee_Personal_Record->LastName);
		$sWrk = "";
		$this->BuildExtendedFilter($Employee_Personal_Record->LastName, $sWrk);
		$this->LoadSelectionFromFilter($Employee_Personal_Record->LastName, $sWrk, $Employee_Personal_Record->LastName->DefaultSelectionList);
		$Employee_Personal_Record->LastName->SelectionList = $Employee_Personal_Record->LastName->DefaultSelectionList;

		// Field Date_Birth
		$this->SetDefaultExtFilter($Employee_Personal_Record->Date_Birth, "BETWEEN", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Employee_Personal_Record->Date_Birth);
		$sWrk = "";
		$this->BuildExtendedFilter($Employee_Personal_Record->Date_Birth, $sWrk);
		$this->LoadSelectionFromFilter($Employee_Personal_Record->Date_Birth, $sWrk, $Employee_Personal_Record->Date_Birth->DefaultSelectionList);
		$Employee_Personal_Record->Date_Birth->SelectionList = $Employee_Personal_Record->Date_Birth->DefaultSelectionList;

		// Field Place_Birth
		$this->SetDefaultExtFilter($Employee_Personal_Record->Place_Birth, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Employee_Personal_Record->Place_Birth);
		$sWrk = "";
		$this->BuildExtendedFilter($Employee_Personal_Record->Place_Birth, $sWrk);
		$this->LoadSelectionFromFilter($Employee_Personal_Record->Place_Birth, $sWrk, $Employee_Personal_Record->Place_Birth->DefaultSelectionList);
		$Employee_Personal_Record->Place_Birth->SelectionList = $Employee_Personal_Record->Place_Birth->DefaultSelectionList;

		// Field Age
		$this->SetDefaultExtFilter($Employee_Personal_Record->Age, "USER SELECT", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Employee_Personal_Record->Age);
		$sWrk = "";
		$this->BuildExtendedFilter($Employee_Personal_Record->Age, $sWrk);
		$this->LoadSelectionFromFilter($Employee_Personal_Record->Age, $sWrk, $Employee_Personal_Record->Age->DefaultSelectionList);
		$Employee_Personal_Record->Age->SelectionList = $Employee_Personal_Record->Age->DefaultSelectionList;

		// Field Email
		$this->SetDefaultExtFilter($Employee_Personal_Record->zEmail, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Employee_Personal_Record->zEmail);
		$sWrk = "";
		$this->BuildExtendedFilter($Employee_Personal_Record->zEmail, $sWrk);
		$this->LoadSelectionFromFilter($Employee_Personal_Record->zEmail, $sWrk, $Employee_Personal_Record->zEmail->DefaultSelectionList);
		$Employee_Personal_Record->zEmail->SelectionList = $Employee_Personal_Record->zEmail->DefaultSelectionList;

		// Field Date_Employement
		$this->SetDefaultExtFilter($Employee_Personal_Record->Date_Employement, "BETWEEN", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Employee_Personal_Record->Date_Employement);
		$sWrk = "";
		$this->BuildExtendedFilter($Employee_Personal_Record->Date_Employement, $sWrk);
		$this->LoadSelectionFromFilter($Employee_Personal_Record->Date_Employement, $sWrk, $Employee_Personal_Record->Date_Employement->DefaultSelectionList);
		$Employee_Personal_Record->Date_Employement->SelectionList = $Employee_Personal_Record->Date_Employement->DefaultSelectionList;

		// Field Department
		$this->SetDefaultExtFilter($Employee_Personal_Record->Department, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Employee_Personal_Record->Department);
		$sWrk = "";
		$this->BuildExtendedFilter($Employee_Personal_Record->Department, $sWrk);
		$this->LoadSelectionFromFilter($Employee_Personal_Record->Department, $sWrk, $Employee_Personal_Record->Department->DefaultSelectionList);
		$Employee_Personal_Record->Department->SelectionList = $Employee_Personal_Record->Department->DefaultSelectionList;

		// Field Position
		$this->SetDefaultExtFilter($Employee_Personal_Record->Position, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Employee_Personal_Record->Position);
		$sWrk = "";
		$this->BuildExtendedFilter($Employee_Personal_Record->Position, $sWrk);
		$this->LoadSelectionFromFilter($Employee_Personal_Record->Position, $sWrk, $Employee_Personal_Record->Position->DefaultSelectionList);
		$Employee_Personal_Record->Position->SelectionList = $Employee_Personal_Record->Position->DefaultSelectionList;

		// Field Educational_Status
		$this->SetDefaultExtFilter($Employee_Personal_Record->Educational_Status, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Employee_Personal_Record->Educational_Status);
		$sWrk = "";
		$this->BuildExtendedFilter($Employee_Personal_Record->Educational_Status, $sWrk);
		$this->LoadSelectionFromFilter($Employee_Personal_Record->Educational_Status, $sWrk, $Employee_Personal_Record->Educational_Status->DefaultSelectionList);
		$Employee_Personal_Record->Educational_Status->SelectionList = $Employee_Personal_Record->Educational_Status->DefaultSelectionList;

		// Field Salary
		$this->SetDefaultExtFilter($Employee_Personal_Record->Salary, "USER SELECT", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Employee_Personal_Record->Salary);
		$sWrk = "";
		$this->BuildExtendedFilter($Employee_Personal_Record->Salary, $sWrk);
		$this->LoadSelectionFromFilter($Employee_Personal_Record->Salary, $sWrk, $Employee_Personal_Record->Salary->DefaultSelectionList);
		$Employee_Personal_Record->Salary->SelectionList = $Employee_Personal_Record->Salary->DefaultSelectionList;

		// Field Children_number
		$this->SetDefaultExtFilter($Employee_Personal_Record->Children_number, "USER SELECT", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Employee_Personal_Record->Children_number);
		$sWrk = "";
		$this->BuildExtendedFilter($Employee_Personal_Record->Children_number, $sWrk);
		$this->LoadSelectionFromFilter($Employee_Personal_Record->Children_number, $sWrk, $Employee_Personal_Record->Children_number->DefaultSelectionList);
		$Employee_Personal_Record->Children_number->SelectionList = $Employee_Personal_Record->Children_number->DefaultSelectionList;

		// Field Name_Child
		$this->SetDefaultExtFilter($Employee_Personal_Record->Name_Child, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Employee_Personal_Record->Name_Child);
		$sWrk = "";
		$this->BuildExtendedFilter($Employee_Personal_Record->Name_Child, $sWrk);
		$this->LoadSelectionFromFilter($Employee_Personal_Record->Name_Child, $sWrk, $Employee_Personal_Record->Name_Child->DefaultSelectionList);
		$Employee_Personal_Record->Name_Child->SelectionList = $Employee_Personal_Record->Name_Child->DefaultSelectionList;

		// Field Age_Child
		$this->SetDefaultExtFilter($Employee_Personal_Record->Age_Child, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Employee_Personal_Record->Age_Child);
		$sWrk = "";
		$this->BuildExtendedFilter($Employee_Personal_Record->Age_Child, $sWrk);
		$this->LoadSelectionFromFilter($Employee_Personal_Record->Age_Child, $sWrk, $Employee_Personal_Record->Age_Child->DefaultSelectionList);
		$Employee_Personal_Record->Age_Child->SelectionList = $Employee_Personal_Record->Age_Child->DefaultSelectionList;

		// Field Sex_Child
		$this->SetDefaultExtFilter($Employee_Personal_Record->Sex_Child, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Employee_Personal_Record->Sex_Child);
		$sWrk = "";
		$this->BuildExtendedFilter($Employee_Personal_Record->Sex_Child, $sWrk);
		$this->LoadSelectionFromFilter($Employee_Personal_Record->Sex_Child, $sWrk, $Employee_Personal_Record->Sex_Child->DefaultSelectionList);
		$Employee_Personal_Record->Sex_Child->SelectionList = $Employee_Personal_Record->Sex_Child->DefaultSelectionList;

		// Field Experience
		$this->SetDefaultExtFilter($Employee_Personal_Record->Experience, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Employee_Personal_Record->Experience);

		/**
		* Set up default values for popup filters
		* NOTE: if extended filter is enabled, use default values in extended filter instead
		*/

		// Field Photo
		// Setup your default values for the popup filter below, e.g.
		// $Employee_Personal_Record->Photo->DefaultSelectionList = array("val1", "val2");

		$Employee_Personal_Record->Photo->DefaultSelectionList = "";
		$Employee_Personal_Record->Photo->SelectionList = $Employee_Personal_Record->Photo->DefaultSelectionList;
	}

	// Check if filter applied
	function CheckFilter() {
		global $Employee_Personal_Record;

		// Check ID text filter
		if ($this->TextFilterApplied($Employee_Personal_Record->ID))
			return TRUE;

		// Check ID popup filter
		if (!ewrpt_MatchedArray($Employee_Personal_Record->ID->DefaultSelectionList, $Employee_Personal_Record->ID->SelectionList))
			return TRUE;

		// Check FirstName text filter
		if ($this->TextFilterApplied($Employee_Personal_Record->FirstName))
			return TRUE;

		// Check FirstName popup filter
		if (!ewrpt_MatchedArray($Employee_Personal_Record->FirstName->DefaultSelectionList, $Employee_Personal_Record->FirstName->SelectionList))
			return TRUE;

		// Check MiddelName text filter
		if ($this->TextFilterApplied($Employee_Personal_Record->MiddelName))
			return TRUE;

		// Check MiddelName popup filter
		if (!ewrpt_MatchedArray($Employee_Personal_Record->MiddelName->DefaultSelectionList, $Employee_Personal_Record->MiddelName->SelectionList))
			return TRUE;

		// Check LastName text filter
		if ($this->TextFilterApplied($Employee_Personal_Record->LastName))
			return TRUE;

		// Check LastName popup filter
		if (!ewrpt_MatchedArray($Employee_Personal_Record->LastName->DefaultSelectionList, $Employee_Personal_Record->LastName->SelectionList))
			return TRUE;

		// Check Date_Birth text filter
		if ($this->TextFilterApplied($Employee_Personal_Record->Date_Birth))
			return TRUE;

		// Check Date_Birth popup filter
		if (!ewrpt_MatchedArray($Employee_Personal_Record->Date_Birth->DefaultSelectionList, $Employee_Personal_Record->Date_Birth->SelectionList))
			return TRUE;

		// Check Place_Birth text filter
		if ($this->TextFilterApplied($Employee_Personal_Record->Place_Birth))
			return TRUE;

		// Check Place_Birth popup filter
		if (!ewrpt_MatchedArray($Employee_Personal_Record->Place_Birth->DefaultSelectionList, $Employee_Personal_Record->Place_Birth->SelectionList))
			return TRUE;

		// Check Age text filter
		if ($this->TextFilterApplied($Employee_Personal_Record->Age))
			return TRUE;

		// Check Age popup filter
		if (!ewrpt_MatchedArray($Employee_Personal_Record->Age->DefaultSelectionList, $Employee_Personal_Record->Age->SelectionList))
			return TRUE;

		// Check Sex extended filter
		if ($this->NonTextFilterApplied($Employee_Personal_Record->Sex))
			return TRUE;

		// Check Sex popup filter
		if (!ewrpt_MatchedArray($Employee_Personal_Record->Sex->DefaultSelectionList, $Employee_Personal_Record->Sex->SelectionList))
			return TRUE;

		// Check Email text filter
		if ($this->TextFilterApplied($Employee_Personal_Record->zEmail))
			return TRUE;

		// Check Email popup filter
		if (!ewrpt_MatchedArray($Employee_Personal_Record->zEmail->DefaultSelectionList, $Employee_Personal_Record->zEmail->SelectionList))
			return TRUE;

		// Check Date_Employement text filter
		if ($this->TextFilterApplied($Employee_Personal_Record->Date_Employement))
			return TRUE;

		// Check Date_Employement popup filter
		if (!ewrpt_MatchedArray($Employee_Personal_Record->Date_Employement->DefaultSelectionList, $Employee_Personal_Record->Date_Employement->SelectionList))
			return TRUE;

		// Check Department text filter
		if ($this->TextFilterApplied($Employee_Personal_Record->Department))
			return TRUE;

		// Check Department popup filter
		if (!ewrpt_MatchedArray($Employee_Personal_Record->Department->DefaultSelectionList, $Employee_Personal_Record->Department->SelectionList))
			return TRUE;

		// Check Position text filter
		if ($this->TextFilterApplied($Employee_Personal_Record->Position))
			return TRUE;

		// Check Position popup filter
		if (!ewrpt_MatchedArray($Employee_Personal_Record->Position->DefaultSelectionList, $Employee_Personal_Record->Position->SelectionList))
			return TRUE;

		// Check Educational_Status text filter
		if ($this->TextFilterApplied($Employee_Personal_Record->Educational_Status))
			return TRUE;

		// Check Educational_Status popup filter
		if (!ewrpt_MatchedArray($Employee_Personal_Record->Educational_Status->DefaultSelectionList, $Employee_Personal_Record->Educational_Status->SelectionList))
			return TRUE;

		// Check Salary text filter
		if ($this->TextFilterApplied($Employee_Personal_Record->Salary))
			return TRUE;

		// Check Salary popup filter
		if (!ewrpt_MatchedArray($Employee_Personal_Record->Salary->DefaultSelectionList, $Employee_Personal_Record->Salary->SelectionList))
			return TRUE;

		// Check Martial_Status extended filter
		if ($this->NonTextFilterApplied($Employee_Personal_Record->Martial_Status))
			return TRUE;

		// Check Martial_Status popup filter
		if (!ewrpt_MatchedArray($Employee_Personal_Record->Martial_Status->DefaultSelectionList, $Employee_Personal_Record->Martial_Status->SelectionList))
			return TRUE;

		// Check Children_number text filter
		if ($this->TextFilterApplied($Employee_Personal_Record->Children_number))
			return TRUE;

		// Check Children_number popup filter
		if (!ewrpt_MatchedArray($Employee_Personal_Record->Children_number->DefaultSelectionList, $Employee_Personal_Record->Children_number->SelectionList))
			return TRUE;

		// Check Name_Child text filter
		if ($this->TextFilterApplied($Employee_Personal_Record->Name_Child))
			return TRUE;

		// Check Name_Child popup filter
		if (!ewrpt_MatchedArray($Employee_Personal_Record->Name_Child->DefaultSelectionList, $Employee_Personal_Record->Name_Child->SelectionList))
			return TRUE;

		// Check Age_Child text filter
		if ($this->TextFilterApplied($Employee_Personal_Record->Age_Child))
			return TRUE;

		// Check Age_Child popup filter
		if (!ewrpt_MatchedArray($Employee_Personal_Record->Age_Child->DefaultSelectionList, $Employee_Personal_Record->Age_Child->SelectionList))
			return TRUE;

		// Check Sex_Child text filter
		if ($this->TextFilterApplied($Employee_Personal_Record->Sex_Child))
			return TRUE;

		// Check Sex_Child popup filter
		if (!ewrpt_MatchedArray($Employee_Personal_Record->Sex_Child->DefaultSelectionList, $Employee_Personal_Record->Sex_Child->SelectionList))
			return TRUE;

		// Check Photo popup filter
		if (!ewrpt_MatchedArray($Employee_Personal_Record->Photo->DefaultSelectionList, $Employee_Personal_Record->Photo->SelectionList))
			return TRUE;

		// Check Experience text filter
		if ($this->TextFilterApplied($Employee_Personal_Record->Experience))
			return TRUE;
		return FALSE;
	}

	// Show list of filters
	function ShowFilterList() {
		global $Employee_Personal_Record;
		global $ReportLanguage;

		// Initialize
		$sFilterList = "";

		// Field ID
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Employee_Personal_Record->ID, $sExtWrk);
		if (is_array($Employee_Personal_Record->ID->SelectionList))
			$sWrk = ewrpt_JoinArray($Employee_Personal_Record->ID->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Employee_Personal_Record->ID->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field FirstName
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Employee_Personal_Record->FirstName, $sExtWrk);
		if (is_array($Employee_Personal_Record->FirstName->SelectionList))
			$sWrk = ewrpt_JoinArray($Employee_Personal_Record->FirstName->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Employee_Personal_Record->FirstName->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field MiddelName
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Employee_Personal_Record->MiddelName, $sExtWrk);
		if (is_array($Employee_Personal_Record->MiddelName->SelectionList))
			$sWrk = ewrpt_JoinArray($Employee_Personal_Record->MiddelName->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Employee_Personal_Record->MiddelName->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field LastName
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Employee_Personal_Record->LastName, $sExtWrk);
		if (is_array($Employee_Personal_Record->LastName->SelectionList))
			$sWrk = ewrpt_JoinArray($Employee_Personal_Record->LastName->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Employee_Personal_Record->LastName->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Date_Birth
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Employee_Personal_Record->Date_Birth, $sExtWrk);
		if (is_array($Employee_Personal_Record->Date_Birth->SelectionList))
			$sWrk = ewrpt_JoinArray($Employee_Personal_Record->Date_Birth->SelectionList, ", ", EWRPT_DATATYPE_DATE);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Employee_Personal_Record->Date_Birth->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Place_Birth
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Employee_Personal_Record->Place_Birth, $sExtWrk);
		if (is_array($Employee_Personal_Record->Place_Birth->SelectionList))
			$sWrk = ewrpt_JoinArray($Employee_Personal_Record->Place_Birth->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Employee_Personal_Record->Place_Birth->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Age
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Employee_Personal_Record->Age, $sExtWrk);
		if (is_array($Employee_Personal_Record->Age->SelectionList))
			$sWrk = ewrpt_JoinArray($Employee_Personal_Record->Age->SelectionList, ", ", EWRPT_DATATYPE_NUMBER);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Employee_Personal_Record->Age->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Sex
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildDropDownFilter($Employee_Personal_Record->Sex, $sExtWrk, "");
		if (is_array($Employee_Personal_Record->Sex->SelectionList))
			$sWrk = ewrpt_JoinArray($Employee_Personal_Record->Sex->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Employee_Personal_Record->Sex->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Email
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Employee_Personal_Record->zEmail, $sExtWrk);
		if (is_array($Employee_Personal_Record->zEmail->SelectionList))
			$sWrk = ewrpt_JoinArray($Employee_Personal_Record->zEmail->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Employee_Personal_Record->zEmail->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Date_Employement
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Employee_Personal_Record->Date_Employement, $sExtWrk);
		if (is_array($Employee_Personal_Record->Date_Employement->SelectionList))
			$sWrk = ewrpt_JoinArray($Employee_Personal_Record->Date_Employement->SelectionList, ", ", EWRPT_DATATYPE_DATE);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Employee_Personal_Record->Date_Employement->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Department
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Employee_Personal_Record->Department, $sExtWrk);
		if (is_array($Employee_Personal_Record->Department->SelectionList))
			$sWrk = ewrpt_JoinArray($Employee_Personal_Record->Department->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Employee_Personal_Record->Department->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Position
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Employee_Personal_Record->Position, $sExtWrk);
		if (is_array($Employee_Personal_Record->Position->SelectionList))
			$sWrk = ewrpt_JoinArray($Employee_Personal_Record->Position->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Employee_Personal_Record->Position->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Educational_Status
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Employee_Personal_Record->Educational_Status, $sExtWrk);
		if (is_array($Employee_Personal_Record->Educational_Status->SelectionList))
			$sWrk = ewrpt_JoinArray($Employee_Personal_Record->Educational_Status->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Employee_Personal_Record->Educational_Status->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Salary
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Employee_Personal_Record->Salary, $sExtWrk);
		if (is_array($Employee_Personal_Record->Salary->SelectionList))
			$sWrk = ewrpt_JoinArray($Employee_Personal_Record->Salary->SelectionList, ", ", EWRPT_DATATYPE_NUMBER);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Employee_Personal_Record->Salary->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Martial_Status
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildDropDownFilter($Employee_Personal_Record->Martial_Status, $sExtWrk, "");
		if (is_array($Employee_Personal_Record->Martial_Status->SelectionList))
			$sWrk = ewrpt_JoinArray($Employee_Personal_Record->Martial_Status->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Employee_Personal_Record->Martial_Status->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Children_number
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Employee_Personal_Record->Children_number, $sExtWrk);
		if (is_array($Employee_Personal_Record->Children_number->SelectionList))
			$sWrk = ewrpt_JoinArray($Employee_Personal_Record->Children_number->SelectionList, ", ", EWRPT_DATATYPE_NUMBER);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Employee_Personal_Record->Children_number->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Name_Child
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Employee_Personal_Record->Name_Child, $sExtWrk);
		if (is_array($Employee_Personal_Record->Name_Child->SelectionList))
			$sWrk = ewrpt_JoinArray($Employee_Personal_Record->Name_Child->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Employee_Personal_Record->Name_Child->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Age_Child
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Employee_Personal_Record->Age_Child, $sExtWrk);
		if (is_array($Employee_Personal_Record->Age_Child->SelectionList))
			$sWrk = ewrpt_JoinArray($Employee_Personal_Record->Age_Child->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Employee_Personal_Record->Age_Child->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Sex_Child
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Employee_Personal_Record->Sex_Child, $sExtWrk);
		if (is_array($Employee_Personal_Record->Sex_Child->SelectionList))
			$sWrk = ewrpt_JoinArray($Employee_Personal_Record->Sex_Child->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Employee_Personal_Record->Sex_Child->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Photo
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($Employee_Personal_Record->Photo->SelectionList))
			$sWrk = ewrpt_JoinArray($Employee_Personal_Record->Photo->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Employee_Personal_Record->Photo->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field Experience
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Employee_Personal_Record->Experience, $sExtWrk);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Employee_Personal_Record->Experience->FldCaption() . "<br />";
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
		global $Employee_Personal_Record;
		$sWrk = "";
		if (!$this->ExtendedFilterExist($Employee_Personal_Record->ID)) {
			if (is_array($Employee_Personal_Record->ID->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Employee_Personal_Record->ID, "`ID`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Employee_Personal_Record->FirstName)) {
			if (is_array($Employee_Personal_Record->FirstName->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Employee_Personal_Record->FirstName, "`FirstName`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Employee_Personal_Record->MiddelName)) {
			if (is_array($Employee_Personal_Record->MiddelName->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Employee_Personal_Record->MiddelName, "`MiddelName`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Employee_Personal_Record->LastName)) {
			if (is_array($Employee_Personal_Record->LastName->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Employee_Personal_Record->LastName, "`LastName`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Employee_Personal_Record->Date_Birth)) {
			if (is_array($Employee_Personal_Record->Date_Birth->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Employee_Personal_Record->Date_Birth, "`Date_Birth`", EWRPT_DATATYPE_DATE);
			}
		}
		if (!$this->ExtendedFilterExist($Employee_Personal_Record->Place_Birth)) {
			if (is_array($Employee_Personal_Record->Place_Birth->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Employee_Personal_Record->Place_Birth, "`Place_Birth`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Employee_Personal_Record->Age)) {
			if (is_array($Employee_Personal_Record->Age->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Employee_Personal_Record->Age, "`Age`", EWRPT_DATATYPE_NUMBER);
			}
		}
		if (!$this->DropDownFilterExist($Employee_Personal_Record->Sex, "")) {
			if (is_array($Employee_Personal_Record->Sex->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Employee_Personal_Record->Sex, "`Sex`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Employee_Personal_Record->zEmail)) {
			if (is_array($Employee_Personal_Record->zEmail->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Employee_Personal_Record->zEmail, "`Email`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Employee_Personal_Record->Date_Employement)) {
			if (is_array($Employee_Personal_Record->Date_Employement->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Employee_Personal_Record->Date_Employement, "`Date_Employement`", EWRPT_DATATYPE_DATE);
			}
		}
		if (!$this->ExtendedFilterExist($Employee_Personal_Record->Department)) {
			if (is_array($Employee_Personal_Record->Department->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Employee_Personal_Record->Department, "`Department`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Employee_Personal_Record->Position)) {
			if (is_array($Employee_Personal_Record->Position->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Employee_Personal_Record->Position, "`Position`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Employee_Personal_Record->Educational_Status)) {
			if (is_array($Employee_Personal_Record->Educational_Status->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Employee_Personal_Record->Educational_Status, "`Educational_Status`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Employee_Personal_Record->Salary)) {
			if (is_array($Employee_Personal_Record->Salary->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Employee_Personal_Record->Salary, "`Salary`", EWRPT_DATATYPE_NUMBER);
			}
		}
		if (!$this->DropDownFilterExist($Employee_Personal_Record->Martial_Status, "")) {
			if (is_array($Employee_Personal_Record->Martial_Status->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Employee_Personal_Record->Martial_Status, "`Martial_Status`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Employee_Personal_Record->Children_number)) {
			if (is_array($Employee_Personal_Record->Children_number->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Employee_Personal_Record->Children_number, "`Children_number`", EWRPT_DATATYPE_NUMBER);
			}
		}
		if (!$this->ExtendedFilterExist($Employee_Personal_Record->Name_Child)) {
			if (is_array($Employee_Personal_Record->Name_Child->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Employee_Personal_Record->Name_Child, "`Name_Child`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Employee_Personal_Record->Age_Child)) {
			if (is_array($Employee_Personal_Record->Age_Child->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Employee_Personal_Record->Age_Child, "`Age_Child`", EWRPT_DATATYPE_STRING);
			}
		}
		if (!$this->ExtendedFilterExist($Employee_Personal_Record->Sex_Child)) {
			if (is_array($Employee_Personal_Record->Sex_Child->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Employee_Personal_Record->Sex_Child, "`Sex_Child`", EWRPT_DATATYPE_STRING);
			}
		}
			if (is_array($Employee_Personal_Record->Photo->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Employee_Personal_Record->Photo, "`Photo`", EWRPT_DATATYPE_STRING);
			}
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $Employee_Personal_Record;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$Employee_Personal_Record->setOrderBy("");
				$Employee_Personal_Record->setStartGroup(1);
				$Employee_Personal_Record->Department->setSort("");
				$Employee_Personal_Record->ID->setSort("");
				$Employee_Personal_Record->FirstName->setSort("");
				$Employee_Personal_Record->MiddelName->setSort("");
				$Employee_Personal_Record->LastName->setSort("");
				$Employee_Personal_Record->Date_Birth->setSort("");
				$Employee_Personal_Record->Place_Birth->setSort("");
				$Employee_Personal_Record->Age->setSort("");
				$Employee_Personal_Record->Sex->setSort("");
				$Employee_Personal_Record->zEmail->setSort("");
				$Employee_Personal_Record->Date_Employement->setSort("");
				$Employee_Personal_Record->Position->setSort("");
				$Employee_Personal_Record->Educational_Status->setSort("");
				$Employee_Personal_Record->Salary->setSort("");
				$Employee_Personal_Record->Martial_Status->setSort("");
				$Employee_Personal_Record->Children_number->setSort("");
				$Employee_Personal_Record->Name_Child->setSort("");
				$Employee_Personal_Record->Age_Child->setSort("");
				$Employee_Personal_Record->Sex_Child->setSort("");
				$Employee_Personal_Record->Photo->setSort("");
				$Employee_Personal_Record->Image->setSort("");
				$Employee_Personal_Record->Experience->setSort("");
				$Employee_Personal_Record->HardCopy_Shelf_No->setSort("");
				$Employee_Personal_Record->Telephone->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$Employee_Personal_Record->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$Employee_Personal_Record->CurrentOrderType = @$_GET["ordertype"];
			$sSortSql = $Employee_Personal_Record->SortSql();
			$Employee_Personal_Record->setOrderBy($sSortSql);
			$Employee_Personal_Record->setStartGroup(1);
		}

		// Set up default sort
		if ($Employee_Personal_Record->getOrderBy() == "") {
			$Employee_Personal_Record->setOrderBy("`ID` ASC");
			$Employee_Personal_Record->ID->setSort("ASC");
		}
		return $Employee_Personal_Record->getOrderBy();
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
