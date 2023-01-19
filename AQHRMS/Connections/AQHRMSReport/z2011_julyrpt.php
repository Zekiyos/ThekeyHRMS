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
$z2011_july = NULL;

//
// Table class for 2011_july
//
class crz2011_july {
	var $TableVar = 'z2011_july';
	var $TableName = '2011_july';
	var $TableType = 'TABLE';
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
	var $LastName;
	var $Basic_salary;
	var $Section;
	var $Sub_Section;
	var $Group;
	var $Department;
	var $Position;
	var $Position_Allowance;
	var $Hardship_Allowance;
	var $Housing_Allowance;
	var $Loan;
	var $Court_Deduction;
	var $Other_Deduction;
	var $Bonus;
	var $CHK_Present_Allowance;
	var $Present_Allowance;
	var $CHK_LU;
	var $LU_Contribution;
	var $CHK_PF;
	var $PF_Amount;
	var $PF_Employee;
	var $PF_Company;
	var $CHK_Pension;
	var $Pension_5;
	var $Pension_12;
	var $Material;
	var $CHK_Pledge;
	var $Pledge;
	var $Total_Holyday;
	var $Total_Absent;
	var $Total_Absent_Day;
	var $Total_Leave_Days;
	var $Working_Day;
	var $Working_Hours;
	var $Avialable_HR;
	var $Salary_Per_Hour;
	var $Working_Day_Payment;
	var $Leave_Day_Payment;
	var $Transport_Allowance;
	var $Total_No_normal1;
	var $Day_OT;
	var $Total_No_normal2;
	var $Night_OT;
	var $Total_No_Sunday;
	var $Sunday_OT;
	var $Total_No_Holyday;
	var $Holyday_OT;
	var $Total_OT;
	var $Holyday_Double_Payment;
	var $Taxable_Income;
	var $Income_tax;
	var $Total_Deduction;
	var $PrintLayout;
	var $Prepared;
	var $Checked;
	var $Aproved;
	var $Net_Pay;
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
	function crz2011_july() {
		global $ReportLanguage;

		// ID
		$this->ID = new crField('z2011_july', '2011_july', 'x_ID', 'ID', '`ID`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['ID'] =& $this->ID;
		$this->ID->DateFilter = "";
		$this->ID->SqlSelect = "";
		$this->ID->SqlOrderBy = "";

		// FirstName
		$this->FirstName = new crField('z2011_july', '2011_july', 'x_FirstName', 'FirstName', '`FirstName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['FirstName'] =& $this->FirstName;
		$this->FirstName->DateFilter = "";
		$this->FirstName->SqlSelect = "";
		$this->FirstName->SqlOrderBy = "";

		// MiddelName
		$this->MiddelName = new crField('z2011_july', '2011_july', 'x_MiddelName', 'MiddelName', '`MiddelName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['MiddelName'] =& $this->MiddelName;
		$this->MiddelName->DateFilter = "";
		$this->MiddelName->SqlSelect = "";
		$this->MiddelName->SqlOrderBy = "";

		// LastName
		$this->LastName = new crField('z2011_july', '2011_july', 'x_LastName', 'LastName', '`LastName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['LastName'] =& $this->LastName;
		$this->LastName->DateFilter = "";
		$this->LastName->SqlSelect = "";
		$this->LastName->SqlOrderBy = "";

		// Basic salary
		$this->Basic_salary = new crField('z2011_july', '2011_july', 'x_Basic_salary', 'Basic salary', '`Basic salary`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Basic_salary->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Basic_salary'] =& $this->Basic_salary;
		$this->Basic_salary->DateFilter = "";
		$this->Basic_salary->SqlSelect = "";
		$this->Basic_salary->SqlOrderBy = "";

		// Section
		$this->Section = new crField('z2011_july', '2011_july', 'x_Section', 'Section', '`Section`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Section'] =& $this->Section;
		$this->Section->DateFilter = "";
		$this->Section->SqlSelect = "";
		$this->Section->SqlOrderBy = "";

		// Sub Section
		$this->Sub_Section = new crField('z2011_july', '2011_july', 'x_Sub_Section', 'Sub Section', '`Sub Section`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Sub_Section'] =& $this->Sub_Section;
		$this->Sub_Section->DateFilter = "";
		$this->Sub_Section->SqlSelect = "";
		$this->Sub_Section->SqlOrderBy = "";

		// Group
		$this->Group = new crField('z2011_july', '2011_july', 'x_Group', 'Group', '`Group`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Group'] =& $this->Group;
		$this->Group->DateFilter = "";
		$this->Group->SqlSelect = "";
		$this->Group->SqlOrderBy = "";

		// Department
		$this->Department = new crField('z2011_july', '2011_july', 'x_Department', 'Department', '`Department`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Department'] =& $this->Department;
		$this->Department->DateFilter = "";
		$this->Department->SqlSelect = "";
		$this->Department->SqlOrderBy = "";

		// Position
		$this->Position = new crField('z2011_july', '2011_july', 'x_Position', 'Position', '`Position`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Position'] =& $this->Position;
		$this->Position->DateFilter = "";
		$this->Position->SqlSelect = "";
		$this->Position->SqlOrderBy = "";

		// Position_Allowance
		$this->Position_Allowance = new crField('z2011_july', '2011_july', 'x_Position_Allowance', 'Position_Allowance', '`Position_Allowance`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Position_Allowance->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Position_Allowance'] =& $this->Position_Allowance;
		$this->Position_Allowance->DateFilter = "";
		$this->Position_Allowance->SqlSelect = "";
		$this->Position_Allowance->SqlOrderBy = "";

		// Hardship_Allowance
		$this->Hardship_Allowance = new crField('z2011_july', '2011_july', 'x_Hardship_Allowance', 'Hardship_Allowance', '`Hardship_Allowance`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Hardship_Allowance->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Hardship_Allowance'] =& $this->Hardship_Allowance;
		$this->Hardship_Allowance->DateFilter = "";
		$this->Hardship_Allowance->SqlSelect = "";
		$this->Hardship_Allowance->SqlOrderBy = "";

		// Housing_Allowance
		$this->Housing_Allowance = new crField('z2011_july', '2011_july', 'x_Housing_Allowance', 'Housing_Allowance', '`Housing_Allowance`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Housing_Allowance->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Housing_Allowance'] =& $this->Housing_Allowance;
		$this->Housing_Allowance->DateFilter = "";
		$this->Housing_Allowance->SqlSelect = "";
		$this->Housing_Allowance->SqlOrderBy = "";

		// Loan
		$this->Loan = new crField('z2011_july', '2011_july', 'x_Loan', 'Loan', '`Loan`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Loan->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Loan'] =& $this->Loan;
		$this->Loan->DateFilter = "";
		$this->Loan->SqlSelect = "";
		$this->Loan->SqlOrderBy = "";

		// Court Deduction
		$this->Court_Deduction = new crField('z2011_july', '2011_july', 'x_Court_Deduction', 'Court Deduction', '`Court Deduction`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Court_Deduction->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Court_Deduction'] =& $this->Court_Deduction;
		$this->Court_Deduction->DateFilter = "";
		$this->Court_Deduction->SqlSelect = "";
		$this->Court_Deduction->SqlOrderBy = "";

		// Other Deduction
		$this->Other_Deduction = new crField('z2011_july', '2011_july', 'x_Other_Deduction', 'Other Deduction', '`Other Deduction`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Other_Deduction->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Other_Deduction'] =& $this->Other_Deduction;
		$this->Other_Deduction->DateFilter = "";
		$this->Other_Deduction->SqlSelect = "";
		$this->Other_Deduction->SqlOrderBy = "";

		// Bonus
		$this->Bonus = new crField('z2011_july', '2011_july', 'x_Bonus', 'Bonus', '`Bonus`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Bonus->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Bonus'] =& $this->Bonus;
		$this->Bonus->DateFilter = "";
		$this->Bonus->SqlSelect = "";
		$this->Bonus->SqlOrderBy = "";

		// CHK_Present_Allowance
		$this->CHK_Present_Allowance = new crField('z2011_july', '2011_july', 'x_CHK_Present_Allowance', 'CHK_Present_Allowance', '`CHK_Present_Allowance`', 20, EWRPT_DATATYPE_NUMBER, -1);
		$this->CHK_Present_Allowance->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['CHK_Present_Allowance'] =& $this->CHK_Present_Allowance;
		$this->CHK_Present_Allowance->DateFilter = "";
		$this->CHK_Present_Allowance->SqlSelect = "";
		$this->CHK_Present_Allowance->SqlOrderBy = "";

		// Present_Allowance
		$this->Present_Allowance = new crField('z2011_july', '2011_july', 'x_Present_Allowance', 'Present_Allowance', '`Present_Allowance`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Present_Allowance->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Present_Allowance'] =& $this->Present_Allowance;
		$this->Present_Allowance->DateFilter = "";
		$this->Present_Allowance->SqlSelect = "";
		$this->Present_Allowance->SqlOrderBy = "";

		// CHK_LU
		$this->CHK_LU = new crField('z2011_july', '2011_july', 'x_CHK_LU', 'CHK_LU', '`CHK_LU`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['CHK_LU'] =& $this->CHK_LU;
		$this->CHK_LU->DateFilter = "";
		$this->CHK_LU->SqlSelect = "";
		$this->CHK_LU->SqlOrderBy = "";

		// LU_Contribution
		$this->LU_Contribution = new crField('z2011_july', '2011_july', 'x_LU_Contribution', 'LU_Contribution', '`LU_Contribution`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->LU_Contribution->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['LU_Contribution'] =& $this->LU_Contribution;
		$this->LU_Contribution->DateFilter = "";
		$this->LU_Contribution->SqlSelect = "";
		$this->LU_Contribution->SqlOrderBy = "";

		// CHK_PF
		$this->CHK_PF = new crField('z2011_july', '2011_july', 'x_CHK_PF', 'CHK_PF', '`CHK_PF`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['CHK_PF'] =& $this->CHK_PF;
		$this->CHK_PF->DateFilter = "";
		$this->CHK_PF->SqlSelect = "";
		$this->CHK_PF->SqlOrderBy = "";

		// PF_Amount
		$this->PF_Amount = new crField('z2011_july', '2011_july', 'x_PF_Amount', 'PF_Amount', '`PF_Amount`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->PF_Amount->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['PF_Amount'] =& $this->PF_Amount;
		$this->PF_Amount->DateFilter = "";
		$this->PF_Amount->SqlSelect = "";
		$this->PF_Amount->SqlOrderBy = "";

		// PF_Employee
		$this->PF_Employee = new crField('z2011_july', '2011_july', 'x_PF_Employee', 'PF_Employee', '`PF_Employee`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->PF_Employee->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['PF_Employee'] =& $this->PF_Employee;
		$this->PF_Employee->DateFilter = "";
		$this->PF_Employee->SqlSelect = "";
		$this->PF_Employee->SqlOrderBy = "";

		// PF_Company
		$this->PF_Company = new crField('z2011_july', '2011_july', 'x_PF_Company', 'PF_Company', '`PF_Company`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->PF_Company->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['PF_Company'] =& $this->PF_Company;
		$this->PF_Company->DateFilter = "";
		$this->PF_Company->SqlSelect = "";
		$this->PF_Company->SqlOrderBy = "";

		// CHK_Pension
		$this->CHK_Pension = new crField('z2011_july', '2011_july', 'x_CHK_Pension', 'CHK_Pension', '`CHK_Pension`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['CHK_Pension'] =& $this->CHK_Pension;
		$this->CHK_Pension->DateFilter = "";
		$this->CHK_Pension->SqlSelect = "";
		$this->CHK_Pension->SqlOrderBy = "";

		// Pension 5
		$this->Pension_5 = new crField('z2011_july', '2011_july', 'x_Pension_5', 'Pension 5', '`Pension 5`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Pension_5->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Pension_5'] =& $this->Pension_5;
		$this->Pension_5->DateFilter = "";
		$this->Pension_5->SqlSelect = "";
		$this->Pension_5->SqlOrderBy = "";

		// Pension 12
		$this->Pension_12 = new crField('z2011_july', '2011_july', 'x_Pension_12', 'Pension 12', '`Pension 12`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Pension_12->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Pension_12'] =& $this->Pension_12;
		$this->Pension_12->DateFilter = "";
		$this->Pension_12->SqlSelect = "";
		$this->Pension_12->SqlOrderBy = "";

		// Material
		$this->Material = new crField('z2011_july', '2011_july', 'x_Material', 'Material', '`Material`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Material->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Material'] =& $this->Material;
		$this->Material->DateFilter = "";
		$this->Material->SqlSelect = "";
		$this->Material->SqlOrderBy = "";

		// CHK_Pledge
		$this->CHK_Pledge = new crField('z2011_july', '2011_july', 'x_CHK_Pledge', 'CHK_Pledge', '`CHK_Pledge`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['CHK_Pledge'] =& $this->CHK_Pledge;
		$this->CHK_Pledge->DateFilter = "";
		$this->CHK_Pledge->SqlSelect = "";
		$this->CHK_Pledge->SqlOrderBy = "";

		// Pledge
		$this->Pledge = new crField('z2011_july', '2011_july', 'x_Pledge', 'Pledge', '`Pledge`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->Pledge->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['Pledge'] =& $this->Pledge;
		$this->Pledge->DateFilter = "";
		$this->Pledge->SqlSelect = "";
		$this->Pledge->SqlOrderBy = "";

		// Total_Holyday
		$this->Total_Holyday = new crField('z2011_july', '2011_july', 'x_Total_Holyday', 'Total_Holyday', '`Total_Holyday`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->Total_Holyday->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['Total_Holyday'] =& $this->Total_Holyday;
		$this->Total_Holyday->DateFilter = "";
		$this->Total_Holyday->SqlSelect = "";
		$this->Total_Holyday->SqlOrderBy = "";

		// Total_Absent
		$this->Total_Absent = new crField('z2011_july', '2011_july', 'x_Total_Absent', 'Total_Absent', '`Total_Absent`', 131, EWRPT_DATATYPE_NUMBER, -1);
		$this->Total_Absent->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Total_Absent'] =& $this->Total_Absent;
		$this->Total_Absent->DateFilter = "";
		$this->Total_Absent->SqlSelect = "";
		$this->Total_Absent->SqlOrderBy = "";

		// Total_Absent_Day
		$this->Total_Absent_Day = new crField('z2011_july', '2011_july', 'x_Total_Absent_Day', 'Total_Absent_Day', '`Total_Absent_Day`', 131, EWRPT_DATATYPE_NUMBER, -1);
		$this->Total_Absent_Day->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Total_Absent_Day'] =& $this->Total_Absent_Day;
		$this->Total_Absent_Day->DateFilter = "";
		$this->Total_Absent_Day->SqlSelect = "";
		$this->Total_Absent_Day->SqlOrderBy = "";

		// Total_Leave_Days
		$this->Total_Leave_Days = new crField('z2011_july', '2011_july', 'x_Total_Leave_Days', 'Total_Leave_Days', '`Total_Leave_Days`', 131, EWRPT_DATATYPE_NUMBER, -1);
		$this->Total_Leave_Days->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Total_Leave_Days'] =& $this->Total_Leave_Days;
		$this->Total_Leave_Days->DateFilter = "";
		$this->Total_Leave_Days->SqlSelect = "";
		$this->Total_Leave_Days->SqlOrderBy = "";

		// Working_Day
		$this->Working_Day = new crField('z2011_july', '2011_july', 'x_Working_Day', 'Working_Day', '`Working_Day`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Working_Day->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Working_Day'] =& $this->Working_Day;
		$this->Working_Day->DateFilter = "";
		$this->Working_Day->SqlSelect = "";
		$this->Working_Day->SqlOrderBy = "";

		// Working_Hours
		$this->Working_Hours = new crField('z2011_july', '2011_july', 'x_Working_Hours', 'Working_Hours', '`Working_Hours`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Working_Hours->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Working_Hours'] =& $this->Working_Hours;
		$this->Working_Hours->DateFilter = "";
		$this->Working_Hours->SqlSelect = "";
		$this->Working_Hours->SqlOrderBy = "";

		// Avialable_HR
		$this->Avialable_HR = new crField('z2011_july', '2011_july', 'x_Avialable_HR', 'Avialable_HR', '`Avialable_HR`', 20, EWRPT_DATATYPE_NUMBER, -1);
		$this->Avialable_HR->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['Avialable_HR'] =& $this->Avialable_HR;
		$this->Avialable_HR->DateFilter = "";
		$this->Avialable_HR->SqlSelect = "";
		$this->Avialable_HR->SqlOrderBy = "";

		// Salary_Per_Hour
		$this->Salary_Per_Hour = new crField('z2011_july', '2011_july', 'x_Salary_Per_Hour', 'Salary_Per_Hour', '`Salary_Per_Hour`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Salary_Per_Hour->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Salary_Per_Hour'] =& $this->Salary_Per_Hour;
		$this->Salary_Per_Hour->DateFilter = "";
		$this->Salary_Per_Hour->SqlSelect = "";
		$this->Salary_Per_Hour->SqlOrderBy = "";

		// Working_Day_Payment
		$this->Working_Day_Payment = new crField('z2011_july', '2011_july', 'x_Working_Day_Payment', 'Working_Day_Payment', '`Working_Day_Payment`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Working_Day_Payment->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Working_Day_Payment'] =& $this->Working_Day_Payment;
		$this->Working_Day_Payment->DateFilter = "";
		$this->Working_Day_Payment->SqlSelect = "";
		$this->Working_Day_Payment->SqlOrderBy = "";

		// Leave_Day_Payment
		$this->Leave_Day_Payment = new crField('z2011_july', '2011_july', 'x_Leave_Day_Payment', 'Leave_Day_Payment', '`Leave_Day_Payment`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Leave_Day_Payment->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Leave_Day_Payment'] =& $this->Leave_Day_Payment;
		$this->Leave_Day_Payment->DateFilter = "";
		$this->Leave_Day_Payment->SqlSelect = "";
		$this->Leave_Day_Payment->SqlOrderBy = "";

		// Transport_Allowance
		$this->Transport_Allowance = new crField('z2011_july', '2011_july', 'x_Transport_Allowance', 'Transport_Allowance', '`Transport_Allowance`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Transport_Allowance->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Transport_Allowance'] =& $this->Transport_Allowance;
		$this->Transport_Allowance->DateFilter = "";
		$this->Transport_Allowance->SqlSelect = "";
		$this->Transport_Allowance->SqlOrderBy = "";

		// Total_No_normal1
		$this->Total_No_normal1 = new crField('z2011_july', '2011_july', 'x_Total_No_normal1', 'Total_No_normal1', '`Total_No_normal1`', 131, EWRPT_DATATYPE_NUMBER, -1);
		$this->Total_No_normal1->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Total_No_normal1'] =& $this->Total_No_normal1;
		$this->Total_No_normal1->DateFilter = "";
		$this->Total_No_normal1->SqlSelect = "";
		$this->Total_No_normal1->SqlOrderBy = "";

		// Day_OT
		$this->Day_OT = new crField('z2011_july', '2011_july', 'x_Day_OT', 'Day_OT', '`Day_OT`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Day_OT->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Day_OT'] =& $this->Day_OT;
		$this->Day_OT->DateFilter = "";
		$this->Day_OT->SqlSelect = "";
		$this->Day_OT->SqlOrderBy = "";

		// Total_No_normal2
		$this->Total_No_normal2 = new crField('z2011_july', '2011_july', 'x_Total_No_normal2', 'Total_No_normal2', '`Total_No_normal2`', 131, EWRPT_DATATYPE_NUMBER, -1);
		$this->Total_No_normal2->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Total_No_normal2'] =& $this->Total_No_normal2;
		$this->Total_No_normal2->DateFilter = "";
		$this->Total_No_normal2->SqlSelect = "";
		$this->Total_No_normal2->SqlOrderBy = "";

		// Night_OT
		$this->Night_OT = new crField('z2011_july', '2011_july', 'x_Night_OT', 'Night_OT', '`Night_OT`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Night_OT->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Night_OT'] =& $this->Night_OT;
		$this->Night_OT->DateFilter = "";
		$this->Night_OT->SqlSelect = "";
		$this->Night_OT->SqlOrderBy = "";

		// Total_No_Sunday
		$this->Total_No_Sunday = new crField('z2011_july', '2011_july', 'x_Total_No_Sunday', 'Total_No_Sunday', '`Total_No_Sunday`', 131, EWRPT_DATATYPE_NUMBER, -1);
		$this->Total_No_Sunday->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Total_No_Sunday'] =& $this->Total_No_Sunday;
		$this->Total_No_Sunday->DateFilter = "";
		$this->Total_No_Sunday->SqlSelect = "";
		$this->Total_No_Sunday->SqlOrderBy = "";

		// Sunday_OT
		$this->Sunday_OT = new crField('z2011_july', '2011_july', 'x_Sunday_OT', 'Sunday_OT', '`Sunday_OT`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Sunday_OT->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Sunday_OT'] =& $this->Sunday_OT;
		$this->Sunday_OT->DateFilter = "";
		$this->Sunday_OT->SqlSelect = "";
		$this->Sunday_OT->SqlOrderBy = "";

		// Total_No_Holyday
		$this->Total_No_Holyday = new crField('z2011_july', '2011_july', 'x_Total_No_Holyday', 'Total_No_Holyday', '`Total_No_Holyday`', 131, EWRPT_DATATYPE_NUMBER, -1);
		$this->Total_No_Holyday->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Total_No_Holyday'] =& $this->Total_No_Holyday;
		$this->Total_No_Holyday->DateFilter = "";
		$this->Total_No_Holyday->SqlSelect = "";
		$this->Total_No_Holyday->SqlOrderBy = "";

		// Holyday_OT
		$this->Holyday_OT = new crField('z2011_july', '2011_july', 'x_Holyday_OT', 'Holyday_OT', '`Holyday_OT`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Holyday_OT->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Holyday_OT'] =& $this->Holyday_OT;
		$this->Holyday_OT->DateFilter = "";
		$this->Holyday_OT->SqlSelect = "";
		$this->Holyday_OT->SqlOrderBy = "";

		// Total_OT
		$this->Total_OT = new crField('z2011_july', '2011_july', 'x_Total_OT', 'Total_OT', '`Total_OT`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Total_OT->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Total_OT'] =& $this->Total_OT;
		$this->Total_OT->DateFilter = "";
		$this->Total_OT->SqlSelect = "";
		$this->Total_OT->SqlOrderBy = "";

		// Holyday_Double_Payment
		$this->Holyday_Double_Payment = new crField('z2011_july', '2011_july', 'x_Holyday_Double_Payment', 'Holyday_Double_Payment', '`Holyday_Double_Payment`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->Holyday_Double_Payment->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['Holyday_Double_Payment'] =& $this->Holyday_Double_Payment;
		$this->Holyday_Double_Payment->DateFilter = "";
		$this->Holyday_Double_Payment->SqlSelect = "";
		$this->Holyday_Double_Payment->SqlOrderBy = "";

		// Taxable_Income
		$this->Taxable_Income = new crField('z2011_july', '2011_july', 'x_Taxable_Income', 'Taxable_Income', '`Taxable_Income`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Taxable_Income->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Taxable_Income'] =& $this->Taxable_Income;
		$this->Taxable_Income->DateFilter = "";
		$this->Taxable_Income->SqlSelect = "";
		$this->Taxable_Income->SqlOrderBy = "";

		// Income_tax
		$this->Income_tax = new crField('z2011_july', '2011_july', 'x_Income_tax', 'Income_tax', '`Income_tax`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Income_tax->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Income_tax'] =& $this->Income_tax;
		$this->Income_tax->DateFilter = "";
		$this->Income_tax->SqlSelect = "";
		$this->Income_tax->SqlOrderBy = "";

		// Total_Deduction
		$this->Total_Deduction = new crField('z2011_july', '2011_july', 'x_Total_Deduction', 'Total_Deduction', '`Total_Deduction`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Total_Deduction->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Total_Deduction'] =& $this->Total_Deduction;
		$this->Total_Deduction->DateFilter = "";
		$this->Total_Deduction->SqlSelect = "";
		$this->Total_Deduction->SqlOrderBy = "";

		// PrintLayout
		$this->PrintLayout = new crField('z2011_july', '2011_july', 'x_PrintLayout', 'PrintLayout', '`PrintLayout`', 20, EWRPT_DATATYPE_NUMBER, -1);
		$this->PrintLayout->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['PrintLayout'] =& $this->PrintLayout;
		$this->PrintLayout->DateFilter = "";
		$this->PrintLayout->SqlSelect = "";
		$this->PrintLayout->SqlOrderBy = "";

		// Prepared
		$this->Prepared = new crField('z2011_july', '2011_july', 'x_Prepared', 'Prepared', '`Prepared`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Prepared'] =& $this->Prepared;
		$this->Prepared->DateFilter = "";
		$this->Prepared->SqlSelect = "";
		$this->Prepared->SqlOrderBy = "";

		// Checked
		$this->Checked = new crField('z2011_july', '2011_july', 'x_Checked', 'Checked', '`Checked`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Checked'] =& $this->Checked;
		$this->Checked->DateFilter = "";
		$this->Checked->SqlSelect = "";
		$this->Checked->SqlOrderBy = "";

		// Aproved
		$this->Aproved = new crField('z2011_july', '2011_july', 'x_Aproved', 'Aproved', '`Aproved`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Aproved'] =& $this->Aproved;
		$this->Aproved->DateFilter = "";
		$this->Aproved->SqlSelect = "";
		$this->Aproved->SqlOrderBy = "";

		// Net_Pay
		$this->Net_Pay = new crField('z2011_july', '2011_july', 'x_Net_Pay', 'Net_Pay', '`Net_Pay`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Net_Pay->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Net_Pay'] =& $this->Net_Pay;
		$this->Net_Pay->DateFilter = "";
		$this->Net_Pay->SqlSelect = "";
		$this->Net_Pay->SqlOrderBy = "";
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
		return "`2011_july`";
	}

	function SqlSelect() { // Select
		return "SELECT * FROM " . $this->SqlFrom();
	}

	function SqlWhere() { // Where
		return ;
	}

	function SqlGroupBy() { // Group By
		return "";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
		return "";
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
$z2011_july_rpt = new crz2011_july_rpt();
$Page =& $z2011_july_rpt;

// Page init
$z2011_july_rpt->Page_Init();

// Page main
$z2011_july_rpt->Page_Main();
?>
<?php include "phprptinc/header.php"; ?>
<?php if ($z2011_july->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php $z2011_july_rpt->ShowPageHeader(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php $z2011_july_rpt->ShowMessage(); ?>
<?php if ($z2011_july->Export == "" || $z2011_july->Export == "print" || $z2011_july->Export == "email") { ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php } ?>
<?php if ($z2011_july->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
</script>
<?php } ?>
<?php if ($z2011_july->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<?php if ($z2011_july->Export == "" || $z2011_july->Export == "print" || $z2011_july->Export == "email") { ?>
<?php } ?>
<?php echo $z2011_july->TableCaption() ?>
<?php if ($z2011_july->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $z2011_july_rpt->ExportPrintUrl ?>"><?php echo $ReportLanguage->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $z2011_july_rpt->ExportExcelUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $z2011_july_rpt->ExportWordUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToWord") ?></a>
<?php } ?>
<br /><br />
<?php if ($z2011_july->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($z2011_july->Export == "" || $z2011_july->Export == "print" || $z2011_july->Export == "email") { ?>
<?php } ?>
<?php if ($z2011_july->Export == "") { ?>
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
<?php if ($z2011_july->Export == "") { ?>
<div class="ewGridUpperPanel">
<form action="z2011_julyrpt.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($z2011_july_rpt->StartGrp, $z2011_july_rpt->DisplayGrps, $z2011_july_rpt->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="z2011_julyrpt.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="z2011_julyrpt.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="z2011_julyrpt.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="z2011_julyrpt.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($z2011_july_rpt->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($z2011_july_rpt->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("RecordsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($z2011_july_rpt->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($z2011_july_rpt->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($z2011_july_rpt->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($z2011_july_rpt->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($z2011_july_rpt->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($z2011_july_rpt->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($z2011_july_rpt->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($z2011_july_rpt->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($z2011_july->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
if ($z2011_july->ExportAll && $z2011_july->Export <> "") {
	$z2011_july_rpt->StopGrp = $z2011_july_rpt->TotalGrps;
} else {
	$z2011_july_rpt->StopGrp = $z2011_july_rpt->StartGrp + $z2011_july_rpt->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($z2011_july_rpt->StopGrp) > intval($z2011_july_rpt->TotalGrps))
	$z2011_july_rpt->StopGrp = $z2011_july_rpt->TotalGrps;
$z2011_july_rpt->RecCount = 0;

// Get first row
if ($z2011_july_rpt->TotalGrps > 0) {
	$z2011_july_rpt->GetRow(1);
	$z2011_july_rpt->GrpCount = 1;
}
while (($rs && !$rs->EOF && $z2011_july_rpt->GrpCount <= $z2011_july_rpt->DisplayGrps) || $z2011_july_rpt->ShowFirstHeader) {

	// Show header
	if ($z2011_july_rpt->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->ID) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->ID->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->ID) ?>',0);"><?php echo $z2011_july->ID->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->ID->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->ID->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->FirstName) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->FirstName->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->FirstName) ?>',0);"><?php echo $z2011_july->FirstName->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->FirstName->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->FirstName->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->MiddelName) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->MiddelName->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->MiddelName) ?>',0);"><?php echo $z2011_july->MiddelName->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->MiddelName->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->MiddelName->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->LastName) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->LastName->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->LastName) ?>',0);"><?php echo $z2011_july->LastName->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->LastName->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->LastName->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Basic_salary) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Basic_salary->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Basic_salary) ?>',0);"><?php echo $z2011_july->Basic_salary->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Basic_salary->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Basic_salary->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Section) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Section->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Section) ?>',0);"><?php echo $z2011_july->Section->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Section->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Section->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Sub_Section) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Sub_Section->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Sub_Section) ?>',0);"><?php echo $z2011_july->Sub_Section->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Sub_Section->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Sub_Section->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Group) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Group->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Group) ?>',0);"><?php echo $z2011_july->Group->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Group->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Group->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Department) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Department->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Department) ?>',0);"><?php echo $z2011_july->Department->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Department->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Department->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Position) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Position->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Position) ?>',0);"><?php echo $z2011_july->Position->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Position->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Position->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Position_Allowance) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Position_Allowance->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Position_Allowance) ?>',0);"><?php echo $z2011_july->Position_Allowance->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Position_Allowance->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Position_Allowance->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Hardship_Allowance) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Hardship_Allowance->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Hardship_Allowance) ?>',0);"><?php echo $z2011_july->Hardship_Allowance->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Hardship_Allowance->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Hardship_Allowance->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Housing_Allowance) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Housing_Allowance->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Housing_Allowance) ?>',0);"><?php echo $z2011_july->Housing_Allowance->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Housing_Allowance->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Housing_Allowance->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Loan) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Loan->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Loan) ?>',0);"><?php echo $z2011_july->Loan->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Loan->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Loan->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Court_Deduction) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Court_Deduction->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Court_Deduction) ?>',0);"><?php echo $z2011_july->Court_Deduction->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Court_Deduction->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Court_Deduction->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Other_Deduction) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Other_Deduction->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Other_Deduction) ?>',0);"><?php echo $z2011_july->Other_Deduction->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Other_Deduction->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Other_Deduction->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Bonus) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Bonus->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Bonus) ?>',0);"><?php echo $z2011_july->Bonus->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Bonus->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Bonus->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->CHK_Present_Allowance) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->CHK_Present_Allowance->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->CHK_Present_Allowance) ?>',0);"><?php echo $z2011_july->CHK_Present_Allowance->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->CHK_Present_Allowance->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->CHK_Present_Allowance->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Present_Allowance) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Present_Allowance->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Present_Allowance) ?>',0);"><?php echo $z2011_july->Present_Allowance->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Present_Allowance->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Present_Allowance->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->CHK_LU) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->CHK_LU->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->CHK_LU) ?>',0);"><?php echo $z2011_july->CHK_LU->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->CHK_LU->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->CHK_LU->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->LU_Contribution) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->LU_Contribution->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->LU_Contribution) ?>',0);"><?php echo $z2011_july->LU_Contribution->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->LU_Contribution->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->LU_Contribution->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->CHK_PF) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->CHK_PF->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->CHK_PF) ?>',0);"><?php echo $z2011_july->CHK_PF->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->CHK_PF->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->CHK_PF->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->PF_Amount) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->PF_Amount->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->PF_Amount) ?>',0);"><?php echo $z2011_july->PF_Amount->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->PF_Amount->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->PF_Amount->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->PF_Employee) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->PF_Employee->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->PF_Employee) ?>',0);"><?php echo $z2011_july->PF_Employee->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->PF_Employee->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->PF_Employee->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->PF_Company) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->PF_Company->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->PF_Company) ?>',0);"><?php echo $z2011_july->PF_Company->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->PF_Company->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->PF_Company->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->CHK_Pension) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->CHK_Pension->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->CHK_Pension) ?>',0);"><?php echo $z2011_july->CHK_Pension->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->CHK_Pension->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->CHK_Pension->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Pension_5) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Pension_5->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Pension_5) ?>',0);"><?php echo $z2011_july->Pension_5->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Pension_5->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Pension_5->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Pension_12) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Pension_12->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Pension_12) ?>',0);"><?php echo $z2011_july->Pension_12->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Pension_12->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Pension_12->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Material) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Material->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Material) ?>',0);"><?php echo $z2011_july->Material->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Material->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Material->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->CHK_Pledge) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->CHK_Pledge->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->CHK_Pledge) ?>',0);"><?php echo $z2011_july->CHK_Pledge->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->CHK_Pledge->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->CHK_Pledge->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Pledge) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Pledge->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Pledge) ?>',0);"><?php echo $z2011_july->Pledge->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Pledge->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Pledge->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Total_Holyday) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Total_Holyday->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Total_Holyday) ?>',0);"><?php echo $z2011_july->Total_Holyday->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Total_Holyday->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Total_Holyday->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Total_Absent) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Total_Absent->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Total_Absent) ?>',0);"><?php echo $z2011_july->Total_Absent->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Total_Absent->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Total_Absent->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Total_Absent_Day) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Total_Absent_Day->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Total_Absent_Day) ?>',0);"><?php echo $z2011_july->Total_Absent_Day->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Total_Absent_Day->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Total_Absent_Day->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Total_Leave_Days) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Total_Leave_Days->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Total_Leave_Days) ?>',0);"><?php echo $z2011_july->Total_Leave_Days->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Total_Leave_Days->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Total_Leave_Days->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Working_Day) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Working_Day->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Working_Day) ?>',0);"><?php echo $z2011_july->Working_Day->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Working_Day->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Working_Day->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Working_Hours) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Working_Hours->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Working_Hours) ?>',0);"><?php echo $z2011_july->Working_Hours->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Working_Hours->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Working_Hours->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Avialable_HR) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Avialable_HR->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Avialable_HR) ?>',0);"><?php echo $z2011_july->Avialable_HR->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Avialable_HR->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Avialable_HR->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Salary_Per_Hour) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Salary_Per_Hour->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Salary_Per_Hour) ?>',0);"><?php echo $z2011_july->Salary_Per_Hour->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Salary_Per_Hour->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Salary_Per_Hour->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Working_Day_Payment) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Working_Day_Payment->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Working_Day_Payment) ?>',0);"><?php echo $z2011_july->Working_Day_Payment->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Working_Day_Payment->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Working_Day_Payment->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Leave_Day_Payment) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Leave_Day_Payment->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Leave_Day_Payment) ?>',0);"><?php echo $z2011_july->Leave_Day_Payment->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Leave_Day_Payment->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Leave_Day_Payment->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Transport_Allowance) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Transport_Allowance->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Transport_Allowance) ?>',0);"><?php echo $z2011_july->Transport_Allowance->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Transport_Allowance->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Transport_Allowance->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Total_No_normal1) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Total_No_normal1->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Total_No_normal1) ?>',0);"><?php echo $z2011_july->Total_No_normal1->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Total_No_normal1->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Total_No_normal1->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Day_OT) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Day_OT->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Day_OT) ?>',0);"><?php echo $z2011_july->Day_OT->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Day_OT->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Day_OT->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Total_No_normal2) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Total_No_normal2->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Total_No_normal2) ?>',0);"><?php echo $z2011_july->Total_No_normal2->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Total_No_normal2->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Total_No_normal2->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Night_OT) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Night_OT->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Night_OT) ?>',0);"><?php echo $z2011_july->Night_OT->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Night_OT->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Night_OT->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Total_No_Sunday) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Total_No_Sunday->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Total_No_Sunday) ?>',0);"><?php echo $z2011_july->Total_No_Sunday->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Total_No_Sunday->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Total_No_Sunday->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Sunday_OT) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Sunday_OT->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Sunday_OT) ?>',0);"><?php echo $z2011_july->Sunday_OT->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Sunday_OT->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Sunday_OT->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Total_No_Holyday) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Total_No_Holyday->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Total_No_Holyday) ?>',0);"><?php echo $z2011_july->Total_No_Holyday->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Total_No_Holyday->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Total_No_Holyday->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Holyday_OT) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Holyday_OT->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Holyday_OT) ?>',0);"><?php echo $z2011_july->Holyday_OT->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Holyday_OT->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Holyday_OT->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Total_OT) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Total_OT->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Total_OT) ?>',0);"><?php echo $z2011_july->Total_OT->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Total_OT->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Total_OT->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Holyday_Double_Payment) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Holyday_Double_Payment->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Holyday_Double_Payment) ?>',0);"><?php echo $z2011_july->Holyday_Double_Payment->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Holyday_Double_Payment->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Holyday_Double_Payment->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Taxable_Income) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Taxable_Income->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Taxable_Income) ?>',0);"><?php echo $z2011_july->Taxable_Income->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Taxable_Income->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Taxable_Income->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Income_tax) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Income_tax->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Income_tax) ?>',0);"><?php echo $z2011_july->Income_tax->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Income_tax->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Income_tax->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Total_Deduction) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Total_Deduction->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Total_Deduction) ?>',0);"><?php echo $z2011_july->Total_Deduction->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Total_Deduction->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Total_Deduction->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->PrintLayout) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->PrintLayout->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->PrintLayout) ?>',0);"><?php echo $z2011_july->PrintLayout->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->PrintLayout->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->PrintLayout->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Prepared) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Prepared->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Prepared) ?>',0);"><?php echo $z2011_july->Prepared->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Prepared->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Prepared->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Checked) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Checked->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Checked) ?>',0);"><?php echo $z2011_july->Checked->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Checked->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Checked->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Aproved) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Aproved->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Aproved) ?>',0);"><?php echo $z2011_july->Aproved->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Aproved->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Aproved->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($z2011_july->SortUrl($z2011_july->Net_Pay) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $z2011_july->Net_Pay->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $z2011_july->SortUrl($z2011_july->Net_Pay) ?>',0);"><?php echo $z2011_july->Net_Pay->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($z2011_july->Net_Pay->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z2011_july->Net_Pay->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$z2011_july_rpt->ShowFirstHeader = FALSE;
	}
	$z2011_july_rpt->RecCount++;

		// Render detail row
		$z2011_july->ResetCSS();
		$z2011_july->RowType = EWRPT_ROWTYPE_DETAIL;
		$z2011_july_rpt->RenderRow();
?>
	<tr<?php echo $z2011_july->RowAttributes(); ?>>
		<td<?php echo $z2011_july->ID->CellAttributes() ?>>
<div<?php echo $z2011_july->ID->ViewAttributes(); ?>><?php echo $z2011_july->ID->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->FirstName->CellAttributes() ?>>
<div<?php echo $z2011_july->FirstName->ViewAttributes(); ?>><?php echo $z2011_july->FirstName->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->MiddelName->CellAttributes() ?>>
<div<?php echo $z2011_july->MiddelName->ViewAttributes(); ?>><?php echo $z2011_july->MiddelName->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->LastName->CellAttributes() ?>>
<div<?php echo $z2011_july->LastName->ViewAttributes(); ?>><?php echo $z2011_july->LastName->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Basic_salary->CellAttributes() ?>>
<div<?php echo $z2011_july->Basic_salary->ViewAttributes(); ?>><?php echo $z2011_july->Basic_salary->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Section->CellAttributes() ?>>
<div<?php echo $z2011_july->Section->ViewAttributes(); ?>><?php echo $z2011_july->Section->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Sub_Section->CellAttributes() ?>>
<div<?php echo $z2011_july->Sub_Section->ViewAttributes(); ?>><?php echo $z2011_july->Sub_Section->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Group->CellAttributes() ?>>
<div<?php echo $z2011_july->Group->ViewAttributes(); ?>><?php echo $z2011_july->Group->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Department->CellAttributes() ?>>
<div<?php echo $z2011_july->Department->ViewAttributes(); ?>><?php echo $z2011_july->Department->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Position->CellAttributes() ?>>
<div<?php echo $z2011_july->Position->ViewAttributes(); ?>><?php echo $z2011_july->Position->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Position_Allowance->CellAttributes() ?>>
<div<?php echo $z2011_july->Position_Allowance->ViewAttributes(); ?>><?php echo $z2011_july->Position_Allowance->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Hardship_Allowance->CellAttributes() ?>>
<div<?php echo $z2011_july->Hardship_Allowance->ViewAttributes(); ?>><?php echo $z2011_july->Hardship_Allowance->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Housing_Allowance->CellAttributes() ?>>
<div<?php echo $z2011_july->Housing_Allowance->ViewAttributes(); ?>><?php echo $z2011_july->Housing_Allowance->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Loan->CellAttributes() ?>>
<div<?php echo $z2011_july->Loan->ViewAttributes(); ?>><?php echo $z2011_july->Loan->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Court_Deduction->CellAttributes() ?>>
<div<?php echo $z2011_july->Court_Deduction->ViewAttributes(); ?>><?php echo $z2011_july->Court_Deduction->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Other_Deduction->CellAttributes() ?>>
<div<?php echo $z2011_july->Other_Deduction->ViewAttributes(); ?>><?php echo $z2011_july->Other_Deduction->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Bonus->CellAttributes() ?>>
<div<?php echo $z2011_july->Bonus->ViewAttributes(); ?>><?php echo $z2011_july->Bonus->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->CHK_Present_Allowance->CellAttributes() ?>>
<div<?php echo $z2011_july->CHK_Present_Allowance->ViewAttributes(); ?>><?php echo $z2011_july->CHK_Present_Allowance->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Present_Allowance->CellAttributes() ?>>
<div<?php echo $z2011_july->Present_Allowance->ViewAttributes(); ?>><?php echo $z2011_july->Present_Allowance->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->CHK_LU->CellAttributes() ?>>
<div<?php echo $z2011_july->CHK_LU->ViewAttributes(); ?>><?php echo $z2011_july->CHK_LU->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->LU_Contribution->CellAttributes() ?>>
<div<?php echo $z2011_july->LU_Contribution->ViewAttributes(); ?>><?php echo $z2011_july->LU_Contribution->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->CHK_PF->CellAttributes() ?>>
<div<?php echo $z2011_july->CHK_PF->ViewAttributes(); ?>><?php echo $z2011_july->CHK_PF->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->PF_Amount->CellAttributes() ?>>
<div<?php echo $z2011_july->PF_Amount->ViewAttributes(); ?>><?php echo $z2011_july->PF_Amount->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->PF_Employee->CellAttributes() ?>>
<div<?php echo $z2011_july->PF_Employee->ViewAttributes(); ?>><?php echo $z2011_july->PF_Employee->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->PF_Company->CellAttributes() ?>>
<div<?php echo $z2011_july->PF_Company->ViewAttributes(); ?>><?php echo $z2011_july->PF_Company->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->CHK_Pension->CellAttributes() ?>>
<div<?php echo $z2011_july->CHK_Pension->ViewAttributes(); ?>><?php echo $z2011_july->CHK_Pension->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Pension_5->CellAttributes() ?>>
<div<?php echo $z2011_july->Pension_5->ViewAttributes(); ?>><?php echo $z2011_july->Pension_5->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Pension_12->CellAttributes() ?>>
<div<?php echo $z2011_july->Pension_12->ViewAttributes(); ?>><?php echo $z2011_july->Pension_12->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Material->CellAttributes() ?>>
<div<?php echo $z2011_july->Material->ViewAttributes(); ?>><?php echo $z2011_july->Material->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->CHK_Pledge->CellAttributes() ?>>
<div<?php echo $z2011_july->CHK_Pledge->ViewAttributes(); ?>><?php echo $z2011_july->CHK_Pledge->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Pledge->CellAttributes() ?>>
<div<?php echo $z2011_july->Pledge->ViewAttributes(); ?>><?php echo $z2011_july->Pledge->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Total_Holyday->CellAttributes() ?>>
<div<?php echo $z2011_july->Total_Holyday->ViewAttributes(); ?>><?php echo $z2011_july->Total_Holyday->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Total_Absent->CellAttributes() ?>>
<div<?php echo $z2011_july->Total_Absent->ViewAttributes(); ?>><?php echo $z2011_july->Total_Absent->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Total_Absent_Day->CellAttributes() ?>>
<div<?php echo $z2011_july->Total_Absent_Day->ViewAttributes(); ?>><?php echo $z2011_july->Total_Absent_Day->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Total_Leave_Days->CellAttributes() ?>>
<div<?php echo $z2011_july->Total_Leave_Days->ViewAttributes(); ?>><?php echo $z2011_july->Total_Leave_Days->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Working_Day->CellAttributes() ?>>
<div<?php echo $z2011_july->Working_Day->ViewAttributes(); ?>><?php echo $z2011_july->Working_Day->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Working_Hours->CellAttributes() ?>>
<div<?php echo $z2011_july->Working_Hours->ViewAttributes(); ?>><?php echo $z2011_july->Working_Hours->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Avialable_HR->CellAttributes() ?>>
<div<?php echo $z2011_july->Avialable_HR->ViewAttributes(); ?>><?php echo $z2011_july->Avialable_HR->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Salary_Per_Hour->CellAttributes() ?>>
<div<?php echo $z2011_july->Salary_Per_Hour->ViewAttributes(); ?>><?php echo $z2011_july->Salary_Per_Hour->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Working_Day_Payment->CellAttributes() ?>>
<div<?php echo $z2011_july->Working_Day_Payment->ViewAttributes(); ?>><?php echo $z2011_july->Working_Day_Payment->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Leave_Day_Payment->CellAttributes() ?>>
<div<?php echo $z2011_july->Leave_Day_Payment->ViewAttributes(); ?>><?php echo $z2011_july->Leave_Day_Payment->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Transport_Allowance->CellAttributes() ?>>
<div<?php echo $z2011_july->Transport_Allowance->ViewAttributes(); ?>><?php echo $z2011_july->Transport_Allowance->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Total_No_normal1->CellAttributes() ?>>
<div<?php echo $z2011_july->Total_No_normal1->ViewAttributes(); ?>><?php echo $z2011_july->Total_No_normal1->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Day_OT->CellAttributes() ?>>
<div<?php echo $z2011_july->Day_OT->ViewAttributes(); ?>><?php echo $z2011_july->Day_OT->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Total_No_normal2->CellAttributes() ?>>
<div<?php echo $z2011_july->Total_No_normal2->ViewAttributes(); ?>><?php echo $z2011_july->Total_No_normal2->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Night_OT->CellAttributes() ?>>
<div<?php echo $z2011_july->Night_OT->ViewAttributes(); ?>><?php echo $z2011_july->Night_OT->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Total_No_Sunday->CellAttributes() ?>>
<div<?php echo $z2011_july->Total_No_Sunday->ViewAttributes(); ?>><?php echo $z2011_july->Total_No_Sunday->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Sunday_OT->CellAttributes() ?>>
<div<?php echo $z2011_july->Sunday_OT->ViewAttributes(); ?>><?php echo $z2011_july->Sunday_OT->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Total_No_Holyday->CellAttributes() ?>>
<div<?php echo $z2011_july->Total_No_Holyday->ViewAttributes(); ?>><?php echo $z2011_july->Total_No_Holyday->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Holyday_OT->CellAttributes() ?>>
<div<?php echo $z2011_july->Holyday_OT->ViewAttributes(); ?>><?php echo $z2011_july->Holyday_OT->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Total_OT->CellAttributes() ?>>
<div<?php echo $z2011_july->Total_OT->ViewAttributes(); ?>><?php echo $z2011_july->Total_OT->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Holyday_Double_Payment->CellAttributes() ?>>
<div<?php echo $z2011_july->Holyday_Double_Payment->ViewAttributes(); ?>><?php echo $z2011_july->Holyday_Double_Payment->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Taxable_Income->CellAttributes() ?>>
<div<?php echo $z2011_july->Taxable_Income->ViewAttributes(); ?>><?php echo $z2011_july->Taxable_Income->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Income_tax->CellAttributes() ?>>
<div<?php echo $z2011_july->Income_tax->ViewAttributes(); ?>><?php echo $z2011_july->Income_tax->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Total_Deduction->CellAttributes() ?>>
<div<?php echo $z2011_july->Total_Deduction->ViewAttributes(); ?>><?php echo $z2011_july->Total_Deduction->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->PrintLayout->CellAttributes() ?>>
<div<?php echo $z2011_july->PrintLayout->ViewAttributes(); ?>><?php echo $z2011_july->PrintLayout->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Prepared->CellAttributes() ?>>
<div<?php echo $z2011_july->Prepared->ViewAttributes(); ?>><?php echo $z2011_july->Prepared->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Checked->CellAttributes() ?>>
<div<?php echo $z2011_july->Checked->ViewAttributes(); ?>><?php echo $z2011_july->Checked->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Aproved->CellAttributes() ?>>
<div<?php echo $z2011_july->Aproved->ViewAttributes(); ?>><?php echo $z2011_july->Aproved->ListViewValue(); ?></div>
</td>
		<td<?php echo $z2011_july->Net_Pay->CellAttributes() ?>>
<div<?php echo $z2011_july->Net_Pay->ViewAttributes(); ?>><?php echo $z2011_july->Net_Pay->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$z2011_july_rpt->AccumulateSummary();

		// Get next record
		$z2011_july_rpt->GetRow(2);
	$z2011_july_rpt->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
	</tfoot>
</table>
</div>
<?php if ($z2011_july_rpt->TotalGrps > 0) { ?>
<?php if ($z2011_july->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="z2011_julyrpt.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($z2011_july_rpt->StartGrp, $z2011_july_rpt->DisplayGrps, $z2011_july_rpt->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="z2011_julyrpt.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="z2011_julyrpt.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="z2011_julyrpt.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="z2011_julyrpt.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($z2011_july_rpt->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($z2011_july_rpt->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("RecordsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($z2011_july_rpt->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($z2011_july_rpt->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($z2011_july_rpt->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($z2011_july_rpt->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($z2011_july_rpt->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($z2011_july_rpt->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($z2011_july_rpt->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($z2011_july_rpt->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($z2011_july->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php if ($z2011_july->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($z2011_july->Export == "" || $z2011_july->Export == "print" || $z2011_july->Export == "email") { ?>
<?php } ?>
<?php if ($z2011_july->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($z2011_july->Export == "" || $z2011_july->Export == "print" || $z2011_july->Export == "email") { ?>
<?php } ?>
<?php if ($z2011_july->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $z2011_july_rpt->ShowPageFooter(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($z2011_july->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "phprptinc/footer.php"; ?>
<?php
$z2011_july_rpt->Page_Terminate();
?>
<?php

//
// Page class
//
class crz2011_july_rpt {

	// Page ID
	var $PageID = 'rpt';

	// Table name
	var $TableName = '2011_july';

	// Page object name
	var $PageObjName = 'z2011_july_rpt';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $z2011_july;
		if ($z2011_july->UseTokenInUrl) $PageUrl .= "t=" . $z2011_july->TableVar . "&"; // Add page token
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
		global $z2011_july;
		if ($z2011_july->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($z2011_july->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($z2011_july->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crz2011_july_rpt() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (z2011_july)
		$GLOBALS["z2011_july"] = new crz2011_july();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'rpt', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", '2011_july', TRUE);

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
		global $z2011_july;

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$z2011_july->Export = $_GET["export"];
	}
	$gsExport = $z2011_july->Export; // Get export parameter, used in header
	$gsExportFile = $z2011_july->TableVar; // Get export file, used in header
	if ($z2011_july->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($z2011_july->Export == "word") {
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
		global $z2011_july;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($z2011_july->Export == "email") {
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
		global $z2011_july;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 61;
		$nGrps = 1;
		$this->Val = ewrpt_InitArray($nDtls, 0);
		$this->Cnt = ewrpt_Init2DArray($nGrps, $nDtls, 0);
		$this->Smry = ewrpt_Init2DArray($nGrps, $nDtls, 0);
		$this->Mn = ewrpt_Init2DArray($nGrps, $nDtls, NULL);
		$this->Mx = ewrpt_Init2DArray($nGrps, $nDtls, NULL);
		$this->GrandSmry = ewrpt_InitArray($nDtls, 0);
		$this->GrandMn = ewrpt_InitArray($nDtls, NULL);
		$this->GrandMx = ewrpt_InitArray($nDtls, NULL);

		// Set up if accumulation required
		$this->Col = array(FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE);

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

		// Get total count
		$sSql = ewrpt_BuildReportSql($z2011_july->SqlSelect(), $z2011_july->SqlWhere(), $z2011_july->SqlGroupBy(), $z2011_july->SqlHaving(), $z2011_july->SqlOrderBy(), $this->Filter, $this->Sort);
		$this->TotalGrps = $this->GetCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($z2011_july->ExportAll && $z2011_july->Export <> "")
		    $this->DisplayGrps = $this->TotalGrps;
		else
			$this->SetUpStartGroup(); 

		// Get current page records
		$rs = $this->GetRs($sSql, $this->StartGrp, $this->DisplayGrps);
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

	// Get count
	function GetCnt($sql) {
		global $conn;
		$rscnt = $conn->Execute($sql);
		$cnt = ($rscnt) ? $rscnt->RecordCount() : 0;
		if ($rscnt) $rscnt->Close();
		return $cnt;
	}

	// Get rs
	function GetRs($sql, $start, $grps) {
		global $conn;
		$wrksql = $sql;
		if ($start > 0 && $grps > -1)
			$wrksql .= " LIMIT " . ($start-1) . ", " . ($grps);
		$rswrk = $conn->Execute($wrksql);
		return $rswrk;
	}

	// Get row values
	function GetRow($opt) {
		global $rs;
		global $z2011_july;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$z2011_july->ID->setDbValue($rs->fields('ID'));
			$z2011_july->FirstName->setDbValue($rs->fields('FirstName'));
			$z2011_july->MiddelName->setDbValue($rs->fields('MiddelName'));
			$z2011_july->LastName->setDbValue($rs->fields('LastName'));
			$z2011_july->Basic_salary->setDbValue($rs->fields('Basic salary'));
			$z2011_july->Section->setDbValue($rs->fields('Section'));
			$z2011_july->Sub_Section->setDbValue($rs->fields('Sub Section'));
			$z2011_july->Group->setDbValue($rs->fields('Group'));
			$z2011_july->Department->setDbValue($rs->fields('Department'));
			$z2011_july->Position->setDbValue($rs->fields('Position'));
			$z2011_july->Position_Allowance->setDbValue($rs->fields('Position_Allowance'));
			$z2011_july->Hardship_Allowance->setDbValue($rs->fields('Hardship_Allowance'));
			$z2011_july->Housing_Allowance->setDbValue($rs->fields('Housing_Allowance'));
			$z2011_july->Loan->setDbValue($rs->fields('Loan'));
			$z2011_july->Court_Deduction->setDbValue($rs->fields('Court Deduction'));
			$z2011_july->Other_Deduction->setDbValue($rs->fields('Other Deduction'));
			$z2011_july->Bonus->setDbValue($rs->fields('Bonus'));
			$z2011_july->CHK_Present_Allowance->setDbValue($rs->fields('CHK_Present_Allowance'));
			$z2011_july->Present_Allowance->setDbValue($rs->fields('Present_Allowance'));
			$z2011_july->CHK_LU->setDbValue($rs->fields('CHK_LU'));
			$z2011_july->LU_Contribution->setDbValue($rs->fields('LU_Contribution'));
			$z2011_july->CHK_PF->setDbValue($rs->fields('CHK_PF'));
			$z2011_july->PF_Amount->setDbValue($rs->fields('PF_Amount'));
			$z2011_july->PF_Employee->setDbValue($rs->fields('PF_Employee'));
			$z2011_july->PF_Company->setDbValue($rs->fields('PF_Company'));
			$z2011_july->CHK_Pension->setDbValue($rs->fields('CHK_Pension'));
			$z2011_july->Pension_5->setDbValue($rs->fields('Pension 5'));
			$z2011_july->Pension_12->setDbValue($rs->fields('Pension 12'));
			$z2011_july->Material->setDbValue($rs->fields('Material'));
			$z2011_july->CHK_Pledge->setDbValue($rs->fields('CHK_Pledge'));
			$z2011_july->Pledge->setDbValue($rs->fields('Pledge'));
			$z2011_july->Total_Holyday->setDbValue($rs->fields('Total_Holyday'));
			$z2011_july->Total_Absent->setDbValue($rs->fields('Total_Absent'));
			$z2011_july->Total_Absent_Day->setDbValue($rs->fields('Total_Absent_Day'));
			$z2011_july->Total_Leave_Days->setDbValue($rs->fields('Total_Leave_Days'));
			$z2011_july->Working_Day->setDbValue($rs->fields('Working_Day'));
			$z2011_july->Working_Hours->setDbValue($rs->fields('Working_Hours'));
			$z2011_july->Avialable_HR->setDbValue($rs->fields('Avialable_HR'));
			$z2011_july->Salary_Per_Hour->setDbValue($rs->fields('Salary_Per_Hour'));
			$z2011_july->Working_Day_Payment->setDbValue($rs->fields('Working_Day_Payment'));
			$z2011_july->Leave_Day_Payment->setDbValue($rs->fields('Leave_Day_Payment'));
			$z2011_july->Transport_Allowance->setDbValue($rs->fields('Transport_Allowance'));
			$z2011_july->Total_No_normal1->setDbValue($rs->fields('Total_No_normal1'));
			$z2011_july->Day_OT->setDbValue($rs->fields('Day_OT'));
			$z2011_july->Total_No_normal2->setDbValue($rs->fields('Total_No_normal2'));
			$z2011_july->Night_OT->setDbValue($rs->fields('Night_OT'));
			$z2011_july->Total_No_Sunday->setDbValue($rs->fields('Total_No_Sunday'));
			$z2011_july->Sunday_OT->setDbValue($rs->fields('Sunday_OT'));
			$z2011_july->Total_No_Holyday->setDbValue($rs->fields('Total_No_Holyday'));
			$z2011_july->Holyday_OT->setDbValue($rs->fields('Holyday_OT'));
			$z2011_july->Total_OT->setDbValue($rs->fields('Total_OT'));
			$z2011_july->Holyday_Double_Payment->setDbValue($rs->fields('Holyday_Double_Payment'));
			$z2011_july->Taxable_Income->setDbValue($rs->fields('Taxable_Income'));
			$z2011_july->Income_tax->setDbValue($rs->fields('Income_tax'));
			$z2011_july->Total_Deduction->setDbValue($rs->fields('Total_Deduction'));
			$z2011_july->PrintLayout->setDbValue($rs->fields('PrintLayout'));
			$z2011_july->Prepared->setDbValue($rs->fields('Prepared'));
			$z2011_july->Checked->setDbValue($rs->fields('Checked'));
			$z2011_july->Aproved->setDbValue($rs->fields('Aproved'));
			$z2011_july->Net_Pay->setDbValue($rs->fields('Net_Pay'));
			$this->Val[1] = $z2011_july->ID->CurrentValue;
			$this->Val[2] = $z2011_july->FirstName->CurrentValue;
			$this->Val[3] = $z2011_july->MiddelName->CurrentValue;
			$this->Val[4] = $z2011_july->LastName->CurrentValue;
			$this->Val[5] = $z2011_july->Basic_salary->CurrentValue;
			$this->Val[6] = $z2011_july->Section->CurrentValue;
			$this->Val[7] = $z2011_july->Sub_Section->CurrentValue;
			$this->Val[8] = $z2011_july->Group->CurrentValue;
			$this->Val[9] = $z2011_july->Department->CurrentValue;
			$this->Val[10] = $z2011_july->Position->CurrentValue;
			$this->Val[11] = $z2011_july->Position_Allowance->CurrentValue;
			$this->Val[12] = $z2011_july->Hardship_Allowance->CurrentValue;
			$this->Val[13] = $z2011_july->Housing_Allowance->CurrentValue;
			$this->Val[14] = $z2011_july->Loan->CurrentValue;
			$this->Val[15] = $z2011_july->Court_Deduction->CurrentValue;
			$this->Val[16] = $z2011_july->Other_Deduction->CurrentValue;
			$this->Val[17] = $z2011_july->Bonus->CurrentValue;
			$this->Val[18] = $z2011_july->CHK_Present_Allowance->CurrentValue;
			$this->Val[19] = $z2011_july->Present_Allowance->CurrentValue;
			$this->Val[20] = $z2011_july->CHK_LU->CurrentValue;
			$this->Val[21] = $z2011_july->LU_Contribution->CurrentValue;
			$this->Val[22] = $z2011_july->CHK_PF->CurrentValue;
			$this->Val[23] = $z2011_july->PF_Amount->CurrentValue;
			$this->Val[24] = $z2011_july->PF_Employee->CurrentValue;
			$this->Val[25] = $z2011_july->PF_Company->CurrentValue;
			$this->Val[26] = $z2011_july->CHK_Pension->CurrentValue;
			$this->Val[27] = $z2011_july->Pension_5->CurrentValue;
			$this->Val[28] = $z2011_july->Pension_12->CurrentValue;
			$this->Val[29] = $z2011_july->Material->CurrentValue;
			$this->Val[30] = $z2011_july->CHK_Pledge->CurrentValue;
			$this->Val[31] = $z2011_july->Pledge->CurrentValue;
			$this->Val[32] = $z2011_july->Total_Holyday->CurrentValue;
			$this->Val[33] = $z2011_july->Total_Absent->CurrentValue;
			$this->Val[34] = $z2011_july->Total_Absent_Day->CurrentValue;
			$this->Val[35] = $z2011_july->Total_Leave_Days->CurrentValue;
			$this->Val[36] = $z2011_july->Working_Day->CurrentValue;
			$this->Val[37] = $z2011_july->Working_Hours->CurrentValue;
			$this->Val[38] = $z2011_july->Avialable_HR->CurrentValue;
			$this->Val[39] = $z2011_july->Salary_Per_Hour->CurrentValue;
			$this->Val[40] = $z2011_july->Working_Day_Payment->CurrentValue;
			$this->Val[41] = $z2011_july->Leave_Day_Payment->CurrentValue;
			$this->Val[42] = $z2011_july->Transport_Allowance->CurrentValue;
			$this->Val[43] = $z2011_july->Total_No_normal1->CurrentValue;
			$this->Val[44] = $z2011_july->Day_OT->CurrentValue;
			$this->Val[45] = $z2011_july->Total_No_normal2->CurrentValue;
			$this->Val[46] = $z2011_july->Night_OT->CurrentValue;
			$this->Val[47] = $z2011_july->Total_No_Sunday->CurrentValue;
			$this->Val[48] = $z2011_july->Sunday_OT->CurrentValue;
			$this->Val[49] = $z2011_july->Total_No_Holyday->CurrentValue;
			$this->Val[50] = $z2011_july->Holyday_OT->CurrentValue;
			$this->Val[51] = $z2011_july->Total_OT->CurrentValue;
			$this->Val[52] = $z2011_july->Holyday_Double_Payment->CurrentValue;
			$this->Val[53] = $z2011_july->Taxable_Income->CurrentValue;
			$this->Val[54] = $z2011_july->Income_tax->CurrentValue;
			$this->Val[55] = $z2011_july->Total_Deduction->CurrentValue;
			$this->Val[56] = $z2011_july->PrintLayout->CurrentValue;
			$this->Val[57] = $z2011_july->Prepared->CurrentValue;
			$this->Val[58] = $z2011_july->Checked->CurrentValue;
			$this->Val[59] = $z2011_july->Aproved->CurrentValue;
			$this->Val[60] = $z2011_july->Net_Pay->CurrentValue;
		} else {
			$z2011_july->ID->setDbValue("");
			$z2011_july->FirstName->setDbValue("");
			$z2011_july->MiddelName->setDbValue("");
			$z2011_july->LastName->setDbValue("");
			$z2011_july->Basic_salary->setDbValue("");
			$z2011_july->Section->setDbValue("");
			$z2011_july->Sub_Section->setDbValue("");
			$z2011_july->Group->setDbValue("");
			$z2011_july->Department->setDbValue("");
			$z2011_july->Position->setDbValue("");
			$z2011_july->Position_Allowance->setDbValue("");
			$z2011_july->Hardship_Allowance->setDbValue("");
			$z2011_july->Housing_Allowance->setDbValue("");
			$z2011_july->Loan->setDbValue("");
			$z2011_july->Court_Deduction->setDbValue("");
			$z2011_july->Other_Deduction->setDbValue("");
			$z2011_july->Bonus->setDbValue("");
			$z2011_july->CHK_Present_Allowance->setDbValue("");
			$z2011_july->Present_Allowance->setDbValue("");
			$z2011_july->CHK_LU->setDbValue("");
			$z2011_july->LU_Contribution->setDbValue("");
			$z2011_july->CHK_PF->setDbValue("");
			$z2011_july->PF_Amount->setDbValue("");
			$z2011_july->PF_Employee->setDbValue("");
			$z2011_july->PF_Company->setDbValue("");
			$z2011_july->CHK_Pension->setDbValue("");
			$z2011_july->Pension_5->setDbValue("");
			$z2011_july->Pension_12->setDbValue("");
			$z2011_july->Material->setDbValue("");
			$z2011_july->CHK_Pledge->setDbValue("");
			$z2011_july->Pledge->setDbValue("");
			$z2011_july->Total_Holyday->setDbValue("");
			$z2011_july->Total_Absent->setDbValue("");
			$z2011_july->Total_Absent_Day->setDbValue("");
			$z2011_july->Total_Leave_Days->setDbValue("");
			$z2011_july->Working_Day->setDbValue("");
			$z2011_july->Working_Hours->setDbValue("");
			$z2011_july->Avialable_HR->setDbValue("");
			$z2011_july->Salary_Per_Hour->setDbValue("");
			$z2011_july->Working_Day_Payment->setDbValue("");
			$z2011_july->Leave_Day_Payment->setDbValue("");
			$z2011_july->Transport_Allowance->setDbValue("");
			$z2011_july->Total_No_normal1->setDbValue("");
			$z2011_july->Day_OT->setDbValue("");
			$z2011_july->Total_No_normal2->setDbValue("");
			$z2011_july->Night_OT->setDbValue("");
			$z2011_july->Total_No_Sunday->setDbValue("");
			$z2011_july->Sunday_OT->setDbValue("");
			$z2011_july->Total_No_Holyday->setDbValue("");
			$z2011_july->Holyday_OT->setDbValue("");
			$z2011_july->Total_OT->setDbValue("");
			$z2011_july->Holyday_Double_Payment->setDbValue("");
			$z2011_july->Taxable_Income->setDbValue("");
			$z2011_july->Income_tax->setDbValue("");
			$z2011_july->Total_Deduction->setDbValue("");
			$z2011_july->PrintLayout->setDbValue("");
			$z2011_july->Prepared->setDbValue("");
			$z2011_july->Checked->setDbValue("");
			$z2011_july->Aproved->setDbValue("");
			$z2011_july->Net_Pay->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $z2011_july;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$z2011_july->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$z2011_july->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $z2011_july->getStartGroup();
			}
		} else {
			$this->StartGrp = $z2011_july->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$z2011_july->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$z2011_july->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$z2011_july->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $z2011_july;

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
		global $z2011_july;
		$this->StartGrp = 1;
		$z2011_july->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $z2011_july;
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
			$z2011_july->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$z2011_july->setStartGroup($this->StartGrp);
		} else {
			if ($z2011_july->getGroupPerPage() <> "") {
				$this->DisplayGrps = $z2011_july->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $Security;
		global $z2011_july;
		if ($z2011_july->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($z2011_july->SqlSelectCount(), $z2011_july->SqlWhere(), $z2011_july->SqlGroupBy(), $z2011_july->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}
		}

		// Call Row_Rendering event
		$z2011_july->Row_Rendering();

		/* --------------------
		'  Render view codes
		' --------------------- */
		if ($z2011_july->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// ID
			$z2011_july->ID->ViewValue = $z2011_july->ID->Summary;

			// FirstName
			$z2011_july->FirstName->ViewValue = $z2011_july->FirstName->Summary;

			// MiddelName
			$z2011_july->MiddelName->ViewValue = $z2011_july->MiddelName->Summary;

			// LastName
			$z2011_july->LastName->ViewValue = $z2011_july->LastName->Summary;

			// Basic salary
			$z2011_july->Basic_salary->ViewValue = $z2011_july->Basic_salary->Summary;

			// Section
			$z2011_july->Section->ViewValue = $z2011_july->Section->Summary;

			// Sub Section
			$z2011_july->Sub_Section->ViewValue = $z2011_july->Sub_Section->Summary;

			// Group
			$z2011_july->Group->ViewValue = $z2011_july->Group->Summary;

			// Department
			$z2011_july->Department->ViewValue = $z2011_july->Department->Summary;

			// Position
			$z2011_july->Position->ViewValue = $z2011_july->Position->Summary;

			// Position_Allowance
			$z2011_july->Position_Allowance->ViewValue = $z2011_july->Position_Allowance->Summary;

			// Hardship_Allowance
			$z2011_july->Hardship_Allowance->ViewValue = $z2011_july->Hardship_Allowance->Summary;

			// Housing_Allowance
			$z2011_july->Housing_Allowance->ViewValue = $z2011_july->Housing_Allowance->Summary;

			// Loan
			$z2011_july->Loan->ViewValue = $z2011_july->Loan->Summary;

			// Court Deduction
			$z2011_july->Court_Deduction->ViewValue = $z2011_july->Court_Deduction->Summary;

			// Other Deduction
			$z2011_july->Other_Deduction->ViewValue = $z2011_july->Other_Deduction->Summary;

			// Bonus
			$z2011_july->Bonus->ViewValue = $z2011_july->Bonus->Summary;

			// CHK_Present_Allowance
			$z2011_july->CHK_Present_Allowance->ViewValue = $z2011_july->CHK_Present_Allowance->Summary;

			// Present_Allowance
			$z2011_july->Present_Allowance->ViewValue = $z2011_july->Present_Allowance->Summary;

			// CHK_LU
			$z2011_july->CHK_LU->ViewValue = $z2011_july->CHK_LU->Summary;

			// LU_Contribution
			$z2011_july->LU_Contribution->ViewValue = $z2011_july->LU_Contribution->Summary;

			// CHK_PF
			$z2011_july->CHK_PF->ViewValue = $z2011_july->CHK_PF->Summary;

			// PF_Amount
			$z2011_july->PF_Amount->ViewValue = $z2011_july->PF_Amount->Summary;

			// PF_Employee
			$z2011_july->PF_Employee->ViewValue = $z2011_july->PF_Employee->Summary;

			// PF_Company
			$z2011_july->PF_Company->ViewValue = $z2011_july->PF_Company->Summary;

			// CHK_Pension
			$z2011_july->CHK_Pension->ViewValue = $z2011_july->CHK_Pension->Summary;

			// Pension 5
			$z2011_july->Pension_5->ViewValue = $z2011_july->Pension_5->Summary;

			// Pension 12
			$z2011_july->Pension_12->ViewValue = $z2011_july->Pension_12->Summary;

			// Material
			$z2011_july->Material->ViewValue = $z2011_july->Material->Summary;

			// CHK_Pledge
			$z2011_july->CHK_Pledge->ViewValue = $z2011_july->CHK_Pledge->Summary;

			// Pledge
			$z2011_july->Pledge->ViewValue = $z2011_july->Pledge->Summary;

			// Total_Holyday
			$z2011_july->Total_Holyday->ViewValue = $z2011_july->Total_Holyday->Summary;

			// Total_Absent
			$z2011_july->Total_Absent->ViewValue = $z2011_july->Total_Absent->Summary;

			// Total_Absent_Day
			$z2011_july->Total_Absent_Day->ViewValue = $z2011_july->Total_Absent_Day->Summary;

			// Total_Leave_Days
			$z2011_july->Total_Leave_Days->ViewValue = $z2011_july->Total_Leave_Days->Summary;

			// Working_Day
			$z2011_july->Working_Day->ViewValue = $z2011_july->Working_Day->Summary;

			// Working_Hours
			$z2011_july->Working_Hours->ViewValue = $z2011_july->Working_Hours->Summary;

			// Avialable_HR
			$z2011_july->Avialable_HR->ViewValue = $z2011_july->Avialable_HR->Summary;

			// Salary_Per_Hour
			$z2011_july->Salary_Per_Hour->ViewValue = $z2011_july->Salary_Per_Hour->Summary;

			// Working_Day_Payment
			$z2011_july->Working_Day_Payment->ViewValue = $z2011_july->Working_Day_Payment->Summary;

			// Leave_Day_Payment
			$z2011_july->Leave_Day_Payment->ViewValue = $z2011_july->Leave_Day_Payment->Summary;

			// Transport_Allowance
			$z2011_july->Transport_Allowance->ViewValue = $z2011_july->Transport_Allowance->Summary;

			// Total_No_normal1
			$z2011_july->Total_No_normal1->ViewValue = $z2011_july->Total_No_normal1->Summary;

			// Day_OT
			$z2011_july->Day_OT->ViewValue = $z2011_july->Day_OT->Summary;

			// Total_No_normal2
			$z2011_july->Total_No_normal2->ViewValue = $z2011_july->Total_No_normal2->Summary;

			// Night_OT
			$z2011_july->Night_OT->ViewValue = $z2011_july->Night_OT->Summary;

			// Total_No_Sunday
			$z2011_july->Total_No_Sunday->ViewValue = $z2011_july->Total_No_Sunday->Summary;

			// Sunday_OT
			$z2011_july->Sunday_OT->ViewValue = $z2011_july->Sunday_OT->Summary;

			// Total_No_Holyday
			$z2011_july->Total_No_Holyday->ViewValue = $z2011_july->Total_No_Holyday->Summary;

			// Holyday_OT
			$z2011_july->Holyday_OT->ViewValue = $z2011_july->Holyday_OT->Summary;

			// Total_OT
			$z2011_july->Total_OT->ViewValue = $z2011_july->Total_OT->Summary;

			// Holyday_Double_Payment
			$z2011_july->Holyday_Double_Payment->ViewValue = $z2011_july->Holyday_Double_Payment->Summary;

			// Taxable_Income
			$z2011_july->Taxable_Income->ViewValue = $z2011_july->Taxable_Income->Summary;

			// Income_tax
			$z2011_july->Income_tax->ViewValue = $z2011_july->Income_tax->Summary;

			// Total_Deduction
			$z2011_july->Total_Deduction->ViewValue = $z2011_july->Total_Deduction->Summary;

			// PrintLayout
			$z2011_july->PrintLayout->ViewValue = $z2011_july->PrintLayout->Summary;

			// Prepared
			$z2011_july->Prepared->ViewValue = $z2011_july->Prepared->Summary;

			// Checked
			$z2011_july->Checked->ViewValue = $z2011_july->Checked->Summary;

			// Aproved
			$z2011_july->Aproved->ViewValue = $z2011_july->Aproved->Summary;

			// Net_Pay
			$z2011_july->Net_Pay->ViewValue = $z2011_july->Net_Pay->Summary;
		} else {

			// ID
			$z2011_july->ID->ViewValue = $z2011_july->ID->CurrentValue;
			$z2011_july->ID->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// FirstName
			$z2011_july->FirstName->ViewValue = $z2011_july->FirstName->CurrentValue;
			$z2011_july->FirstName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// MiddelName
			$z2011_july->MiddelName->ViewValue = $z2011_july->MiddelName->CurrentValue;
			$z2011_july->MiddelName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// LastName
			$z2011_july->LastName->ViewValue = $z2011_july->LastName->CurrentValue;
			$z2011_july->LastName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Basic salary
			$z2011_july->Basic_salary->ViewValue = $z2011_july->Basic_salary->CurrentValue;
			$z2011_july->Basic_salary->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Section
			$z2011_july->Section->ViewValue = $z2011_july->Section->CurrentValue;
			$z2011_july->Section->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Sub Section
			$z2011_july->Sub_Section->ViewValue = $z2011_july->Sub_Section->CurrentValue;
			$z2011_july->Sub_Section->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Group
			$z2011_july->Group->ViewValue = $z2011_july->Group->CurrentValue;
			$z2011_july->Group->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Department
			$z2011_july->Department->ViewValue = $z2011_july->Department->CurrentValue;
			$z2011_july->Department->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Position
			$z2011_july->Position->ViewValue = $z2011_july->Position->CurrentValue;
			$z2011_july->Position->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Position_Allowance
			$z2011_july->Position_Allowance->ViewValue = $z2011_july->Position_Allowance->CurrentValue;
			$z2011_july->Position_Allowance->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Hardship_Allowance
			$z2011_july->Hardship_Allowance->ViewValue = $z2011_july->Hardship_Allowance->CurrentValue;
			$z2011_july->Hardship_Allowance->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Housing_Allowance
			$z2011_july->Housing_Allowance->ViewValue = $z2011_july->Housing_Allowance->CurrentValue;
			$z2011_july->Housing_Allowance->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Loan
			$z2011_july->Loan->ViewValue = $z2011_july->Loan->CurrentValue;
			$z2011_july->Loan->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Court Deduction
			$z2011_july->Court_Deduction->ViewValue = $z2011_july->Court_Deduction->CurrentValue;
			$z2011_july->Court_Deduction->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Other Deduction
			$z2011_july->Other_Deduction->ViewValue = $z2011_july->Other_Deduction->CurrentValue;
			$z2011_july->Other_Deduction->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Bonus
			$z2011_july->Bonus->ViewValue = $z2011_july->Bonus->CurrentValue;
			$z2011_july->Bonus->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// CHK_Present_Allowance
			$z2011_july->CHK_Present_Allowance->ViewValue = $z2011_july->CHK_Present_Allowance->CurrentValue;
			$z2011_july->CHK_Present_Allowance->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Present_Allowance
			$z2011_july->Present_Allowance->ViewValue = $z2011_july->Present_Allowance->CurrentValue;
			$z2011_july->Present_Allowance->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// CHK_LU
			$z2011_july->CHK_LU->ViewValue = $z2011_july->CHK_LU->CurrentValue;
			$z2011_july->CHK_LU->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// LU_Contribution
			$z2011_july->LU_Contribution->ViewValue = $z2011_july->LU_Contribution->CurrentValue;
			$z2011_july->LU_Contribution->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// CHK_PF
			$z2011_july->CHK_PF->ViewValue = $z2011_july->CHK_PF->CurrentValue;
			$z2011_july->CHK_PF->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// PF_Amount
			$z2011_july->PF_Amount->ViewValue = $z2011_july->PF_Amount->CurrentValue;
			$z2011_july->PF_Amount->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// PF_Employee
			$z2011_july->PF_Employee->ViewValue = $z2011_july->PF_Employee->CurrentValue;
			$z2011_july->PF_Employee->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// PF_Company
			$z2011_july->PF_Company->ViewValue = $z2011_july->PF_Company->CurrentValue;
			$z2011_july->PF_Company->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// CHK_Pension
			$z2011_july->CHK_Pension->ViewValue = $z2011_july->CHK_Pension->CurrentValue;
			$z2011_july->CHK_Pension->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Pension 5
			$z2011_july->Pension_5->ViewValue = $z2011_july->Pension_5->CurrentValue;
			$z2011_july->Pension_5->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Pension 12
			$z2011_july->Pension_12->ViewValue = $z2011_july->Pension_12->CurrentValue;
			$z2011_july->Pension_12->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Material
			$z2011_july->Material->ViewValue = $z2011_july->Material->CurrentValue;
			$z2011_july->Material->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// CHK_Pledge
			$z2011_july->CHK_Pledge->ViewValue = $z2011_july->CHK_Pledge->CurrentValue;
			$z2011_july->CHK_Pledge->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Pledge
			$z2011_july->Pledge->ViewValue = $z2011_july->Pledge->CurrentValue;
			$z2011_july->Pledge->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Total_Holyday
			$z2011_july->Total_Holyday->ViewValue = $z2011_july->Total_Holyday->CurrentValue;
			$z2011_july->Total_Holyday->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Total_Absent
			$z2011_july->Total_Absent->ViewValue = $z2011_july->Total_Absent->CurrentValue;
			$z2011_july->Total_Absent->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Total_Absent_Day
			$z2011_july->Total_Absent_Day->ViewValue = $z2011_july->Total_Absent_Day->CurrentValue;
			$z2011_july->Total_Absent_Day->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Total_Leave_Days
			$z2011_july->Total_Leave_Days->ViewValue = $z2011_july->Total_Leave_Days->CurrentValue;
			$z2011_july->Total_Leave_Days->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Working_Day
			$z2011_july->Working_Day->ViewValue = $z2011_july->Working_Day->CurrentValue;
			$z2011_july->Working_Day->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Working_Hours
			$z2011_july->Working_Hours->ViewValue = $z2011_july->Working_Hours->CurrentValue;
			$z2011_july->Working_Hours->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Avialable_HR
			$z2011_july->Avialable_HR->ViewValue = $z2011_july->Avialable_HR->CurrentValue;
			$z2011_july->Avialable_HR->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Salary_Per_Hour
			$z2011_july->Salary_Per_Hour->ViewValue = $z2011_july->Salary_Per_Hour->CurrentValue;
			$z2011_july->Salary_Per_Hour->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Working_Day_Payment
			$z2011_july->Working_Day_Payment->ViewValue = $z2011_july->Working_Day_Payment->CurrentValue;
			$z2011_july->Working_Day_Payment->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Leave_Day_Payment
			$z2011_july->Leave_Day_Payment->ViewValue = $z2011_july->Leave_Day_Payment->CurrentValue;
			$z2011_july->Leave_Day_Payment->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Transport_Allowance
			$z2011_july->Transport_Allowance->ViewValue = $z2011_july->Transport_Allowance->CurrentValue;
			$z2011_july->Transport_Allowance->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Total_No_normal1
			$z2011_july->Total_No_normal1->ViewValue = $z2011_july->Total_No_normal1->CurrentValue;
			$z2011_july->Total_No_normal1->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Day_OT
			$z2011_july->Day_OT->ViewValue = $z2011_july->Day_OT->CurrentValue;
			$z2011_july->Day_OT->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Total_No_normal2
			$z2011_july->Total_No_normal2->ViewValue = $z2011_july->Total_No_normal2->CurrentValue;
			$z2011_july->Total_No_normal2->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Night_OT
			$z2011_july->Night_OT->ViewValue = $z2011_july->Night_OT->CurrentValue;
			$z2011_july->Night_OT->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Total_No_Sunday
			$z2011_july->Total_No_Sunday->ViewValue = $z2011_july->Total_No_Sunday->CurrentValue;
			$z2011_july->Total_No_Sunday->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Sunday_OT
			$z2011_july->Sunday_OT->ViewValue = $z2011_july->Sunday_OT->CurrentValue;
			$z2011_july->Sunday_OT->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Total_No_Holyday
			$z2011_july->Total_No_Holyday->ViewValue = $z2011_july->Total_No_Holyday->CurrentValue;
			$z2011_july->Total_No_Holyday->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Holyday_OT
			$z2011_july->Holyday_OT->ViewValue = $z2011_july->Holyday_OT->CurrentValue;
			$z2011_july->Holyday_OT->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Total_OT
			$z2011_july->Total_OT->ViewValue = $z2011_july->Total_OT->CurrentValue;
			$z2011_july->Total_OT->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Holyday_Double_Payment
			$z2011_july->Holyday_Double_Payment->ViewValue = $z2011_july->Holyday_Double_Payment->CurrentValue;
			$z2011_july->Holyday_Double_Payment->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Taxable_Income
			$z2011_july->Taxable_Income->ViewValue = $z2011_july->Taxable_Income->CurrentValue;
			$z2011_july->Taxable_Income->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Income_tax
			$z2011_july->Income_tax->ViewValue = $z2011_july->Income_tax->CurrentValue;
			$z2011_july->Income_tax->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Total_Deduction
			$z2011_july->Total_Deduction->ViewValue = $z2011_july->Total_Deduction->CurrentValue;
			$z2011_july->Total_Deduction->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// PrintLayout
			$z2011_july->PrintLayout->ViewValue = $z2011_july->PrintLayout->CurrentValue;
			$z2011_july->PrintLayout->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Prepared
			$z2011_july->Prepared->ViewValue = $z2011_july->Prepared->CurrentValue;
			$z2011_july->Prepared->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Checked
			$z2011_july->Checked->ViewValue = $z2011_july->Checked->CurrentValue;
			$z2011_july->Checked->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Aproved
			$z2011_july->Aproved->ViewValue = $z2011_july->Aproved->CurrentValue;
			$z2011_july->Aproved->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Net_Pay
			$z2011_july->Net_Pay->ViewValue = $z2011_july->Net_Pay->CurrentValue;
			$z2011_july->Net_Pay->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// ID
		$z2011_july->ID->HrefValue = "";

		// FirstName
		$z2011_july->FirstName->HrefValue = "";

		// MiddelName
		$z2011_july->MiddelName->HrefValue = "";

		// LastName
		$z2011_july->LastName->HrefValue = "";

		// Basic salary
		$z2011_july->Basic_salary->HrefValue = "";

		// Section
		$z2011_july->Section->HrefValue = "";

		// Sub Section
		$z2011_july->Sub_Section->HrefValue = "";

		// Group
		$z2011_july->Group->HrefValue = "";

		// Department
		$z2011_july->Department->HrefValue = "";

		// Position
		$z2011_july->Position->HrefValue = "";

		// Position_Allowance
		$z2011_july->Position_Allowance->HrefValue = "";

		// Hardship_Allowance
		$z2011_july->Hardship_Allowance->HrefValue = "";

		// Housing_Allowance
		$z2011_july->Housing_Allowance->HrefValue = "";

		// Loan
		$z2011_july->Loan->HrefValue = "";

		// Court Deduction
		$z2011_july->Court_Deduction->HrefValue = "";

		// Other Deduction
		$z2011_july->Other_Deduction->HrefValue = "";

		// Bonus
		$z2011_july->Bonus->HrefValue = "";

		// CHK_Present_Allowance
		$z2011_july->CHK_Present_Allowance->HrefValue = "";

		// Present_Allowance
		$z2011_july->Present_Allowance->HrefValue = "";

		// CHK_LU
		$z2011_july->CHK_LU->HrefValue = "";

		// LU_Contribution
		$z2011_july->LU_Contribution->HrefValue = "";

		// CHK_PF
		$z2011_july->CHK_PF->HrefValue = "";

		// PF_Amount
		$z2011_july->PF_Amount->HrefValue = "";

		// PF_Employee
		$z2011_july->PF_Employee->HrefValue = "";

		// PF_Company
		$z2011_july->PF_Company->HrefValue = "";

		// CHK_Pension
		$z2011_july->CHK_Pension->HrefValue = "";

		// Pension 5
		$z2011_july->Pension_5->HrefValue = "";

		// Pension 12
		$z2011_july->Pension_12->HrefValue = "";

		// Material
		$z2011_july->Material->HrefValue = "";

		// CHK_Pledge
		$z2011_july->CHK_Pledge->HrefValue = "";

		// Pledge
		$z2011_july->Pledge->HrefValue = "";

		// Total_Holyday
		$z2011_july->Total_Holyday->HrefValue = "";

		// Total_Absent
		$z2011_july->Total_Absent->HrefValue = "";

		// Total_Absent_Day
		$z2011_july->Total_Absent_Day->HrefValue = "";

		// Total_Leave_Days
		$z2011_july->Total_Leave_Days->HrefValue = "";

		// Working_Day
		$z2011_july->Working_Day->HrefValue = "";

		// Working_Hours
		$z2011_july->Working_Hours->HrefValue = "";

		// Avialable_HR
		$z2011_july->Avialable_HR->HrefValue = "";

		// Salary_Per_Hour
		$z2011_july->Salary_Per_Hour->HrefValue = "";

		// Working_Day_Payment
		$z2011_july->Working_Day_Payment->HrefValue = "";

		// Leave_Day_Payment
		$z2011_july->Leave_Day_Payment->HrefValue = "";

		// Transport_Allowance
		$z2011_july->Transport_Allowance->HrefValue = "";

		// Total_No_normal1
		$z2011_july->Total_No_normal1->HrefValue = "";

		// Day_OT
		$z2011_july->Day_OT->HrefValue = "";

		// Total_No_normal2
		$z2011_july->Total_No_normal2->HrefValue = "";

		// Night_OT
		$z2011_july->Night_OT->HrefValue = "";

		// Total_No_Sunday
		$z2011_july->Total_No_Sunday->HrefValue = "";

		// Sunday_OT
		$z2011_july->Sunday_OT->HrefValue = "";

		// Total_No_Holyday
		$z2011_july->Total_No_Holyday->HrefValue = "";

		// Holyday_OT
		$z2011_july->Holyday_OT->HrefValue = "";

		// Total_OT
		$z2011_july->Total_OT->HrefValue = "";

		// Holyday_Double_Payment
		$z2011_july->Holyday_Double_Payment->HrefValue = "";

		// Taxable_Income
		$z2011_july->Taxable_Income->HrefValue = "";

		// Income_tax
		$z2011_july->Income_tax->HrefValue = "";

		// Total_Deduction
		$z2011_july->Total_Deduction->HrefValue = "";

		// PrintLayout
		$z2011_july->PrintLayout->HrefValue = "";

		// Prepared
		$z2011_july->Prepared->HrefValue = "";

		// Checked
		$z2011_july->Checked->HrefValue = "";

		// Aproved
		$z2011_july->Aproved->HrefValue = "";

		// Net_Pay
		$z2011_july->Net_Pay->HrefValue = "";

		// Call Row_Rendered event
		$z2011_july->Row_Rendered();
	}

	// Return poup filter
	function GetPopupFilter() {
		global $z2011_july;
		$sWrk = "";
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $z2011_july;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$z2011_july->setOrderBy("");
				$z2011_july->setStartGroup(1);
				$z2011_july->ID->setSort("");
				$z2011_july->FirstName->setSort("");
				$z2011_july->MiddelName->setSort("");
				$z2011_july->LastName->setSort("");
				$z2011_july->Basic_salary->setSort("");
				$z2011_july->Section->setSort("");
				$z2011_july->Sub_Section->setSort("");
				$z2011_july->Group->setSort("");
				$z2011_july->Department->setSort("");
				$z2011_july->Position->setSort("");
				$z2011_july->Position_Allowance->setSort("");
				$z2011_july->Hardship_Allowance->setSort("");
				$z2011_july->Housing_Allowance->setSort("");
				$z2011_july->Loan->setSort("");
				$z2011_july->Court_Deduction->setSort("");
				$z2011_july->Other_Deduction->setSort("");
				$z2011_july->Bonus->setSort("");
				$z2011_july->CHK_Present_Allowance->setSort("");
				$z2011_july->Present_Allowance->setSort("");
				$z2011_july->CHK_LU->setSort("");
				$z2011_july->LU_Contribution->setSort("");
				$z2011_july->CHK_PF->setSort("");
				$z2011_july->PF_Amount->setSort("");
				$z2011_july->PF_Employee->setSort("");
				$z2011_july->PF_Company->setSort("");
				$z2011_july->CHK_Pension->setSort("");
				$z2011_july->Pension_5->setSort("");
				$z2011_july->Pension_12->setSort("");
				$z2011_july->Material->setSort("");
				$z2011_july->CHK_Pledge->setSort("");
				$z2011_july->Pledge->setSort("");
				$z2011_july->Total_Holyday->setSort("");
				$z2011_july->Total_Absent->setSort("");
				$z2011_july->Total_Absent_Day->setSort("");
				$z2011_july->Total_Leave_Days->setSort("");
				$z2011_july->Working_Day->setSort("");
				$z2011_july->Working_Hours->setSort("");
				$z2011_july->Avialable_HR->setSort("");
				$z2011_july->Salary_Per_Hour->setSort("");
				$z2011_july->Working_Day_Payment->setSort("");
				$z2011_july->Leave_Day_Payment->setSort("");
				$z2011_july->Transport_Allowance->setSort("");
				$z2011_july->Total_No_normal1->setSort("");
				$z2011_july->Day_OT->setSort("");
				$z2011_july->Total_No_normal2->setSort("");
				$z2011_july->Night_OT->setSort("");
				$z2011_july->Total_No_Sunday->setSort("");
				$z2011_july->Sunday_OT->setSort("");
				$z2011_july->Total_No_Holyday->setSort("");
				$z2011_july->Holyday_OT->setSort("");
				$z2011_july->Total_OT->setSort("");
				$z2011_july->Holyday_Double_Payment->setSort("");
				$z2011_july->Taxable_Income->setSort("");
				$z2011_july->Income_tax->setSort("");
				$z2011_july->Total_Deduction->setSort("");
				$z2011_july->PrintLayout->setSort("");
				$z2011_july->Prepared->setSort("");
				$z2011_july->Checked->setSort("");
				$z2011_july->Aproved->setSort("");
				$z2011_july->Net_Pay->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$z2011_july->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$z2011_july->CurrentOrderType = @$_GET["ordertype"];
			$sSortSql = $z2011_july->SortSql();
			$z2011_july->setOrderBy($sSortSql);
			$z2011_july->setStartGroup(1);
		}
		return $z2011_july->getOrderBy();
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
