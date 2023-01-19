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
$RecruitmentPerDepartment = NULL;

//
// Table class for RecruitmentPerDepartment
//
class crRecruitmentPerDepartment {
	var $TableVar = 'RecruitmentPerDepartment';
	var $TableName = 'RecruitmentPerDepartment';
	var $TableType = 'CUSTOMVIEW';
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
	var $Salary;
	var $Transport_Allowance;
	var $Hardship_Allowance;
	var $Position_Allowance;
	var $Department_Name;
	var $Recruited;
	var $Housing_Allowance;
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
	function crRecruitmentPerDepartment() {
		global $ReportLanguage;

		// Auto_ID
		$this->Auto_ID = new crField('RecruitmentPerDepartment', 'RecruitmentPerDepartment', 'x_Auto_ID', 'Auto_ID', '`Auto_ID`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->Auto_ID->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['Auto_ID'] =& $this->Auto_ID;
		$this->Auto_ID->DateFilter = "";
		$this->Auto_ID->SqlSelect = "";
		$this->Auto_ID->SqlOrderBy = "";

		// Employee
		$this->Employee = new crField('RecruitmentPerDepartment', 'RecruitmentPerDepartment', 'x_Employee', 'Employee', '`Employee`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Employee'] =& $this->Employee;
		$this->Employee->DateFilter = "";
		$this->Employee->SqlSelect = "";
		$this->Employee->SqlOrderBy = "";

		// Place
		$this->Place = new crField('RecruitmentPerDepartment', 'RecruitmentPerDepartment', 'x_Place', 'Place', '`Place`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Place'] =& $this->Place;
		$this->Place->DateFilter = "";
		$this->Place->SqlSelect = "";
		$this->Place->SqlOrderBy = "";

		// ID
		$this->ID = new crField('RecruitmentPerDepartment', 'RecruitmentPerDepartment', 'x_ID', 'ID', '`ID`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['ID'] =& $this->ID;
		$this->ID->DateFilter = "";
		$this->ID->SqlSelect = "";
		$this->ID->SqlOrderBy = "";

		// FirstName
		$this->FirstName = new crField('RecruitmentPerDepartment', 'RecruitmentPerDepartment', 'x_FirstName', 'FirstName', '`FirstName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['FirstName'] =& $this->FirstName;
		$this->FirstName->DateFilter = "";
		$this->FirstName->SqlSelect = "";
		$this->FirstName->SqlOrderBy = "";

		// MiddelName
		$this->MiddelName = new crField('RecruitmentPerDepartment', 'RecruitmentPerDepartment', 'x_MiddelName', 'MiddelName', '`MiddelName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['MiddelName'] =& $this->MiddelName;
		$this->MiddelName->DateFilter = "";
		$this->MiddelName->SqlSelect = "";
		$this->MiddelName->SqlOrderBy = "";

		// LastName
		$this->LastName = new crField('RecruitmentPerDepartment', 'RecruitmentPerDepartment', 'x_LastName', 'LastName', '`LastName`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['LastName'] =& $this->LastName;
		$this->LastName->DateFilter = "";
		$this->LastName->SqlSelect = "";
		$this->LastName->SqlOrderBy = "";

		// Age
		$this->Age = new crField('RecruitmentPerDepartment', 'RecruitmentPerDepartment', 'x_Age', 'Age', '`Age`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->Age->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['Age'] =& $this->Age;
		$this->Age->DateFilter = "";
		$this->Age->SqlSelect = "";
		$this->Age->SqlOrderBy = "";

		// Sex
		$this->Sex = new crField('RecruitmentPerDepartment', 'RecruitmentPerDepartment', 'x_Sex', 'Sex', '`Sex`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Sex'] =& $this->Sex;
		$this->Sex->DateFilter = "";
		$this->Sex->SqlSelect = "";
		$this->Sex->SqlOrderBy = "";

		// Photo
		$this->Photo = new crField('RecruitmentPerDepartment', 'RecruitmentPerDepartment', 'x_Photo', 'Photo', '`Photo`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Photo'] =& $this->Photo;
		$this->Photo->DateFilter = "";
		$this->Photo->SqlSelect = "";
		$this->Photo->SqlOrderBy = "";

		// Date
		$this->Date = new crField('RecruitmentPerDepartment', 'RecruitmentPerDepartment', 'x_Date', 'Date', '`Date`', 133, EWRPT_DATATYPE_DATE, 5);
		$this->Date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateYMD"));
		$this->fields['Date'] =& $this->Date;
		$this->Date->DateFilter = "";
		$this->Date->SqlSelect = "";
		$this->Date->SqlOrderBy = "";

		// Address
		$this->Address = new crField('RecruitmentPerDepartment', 'RecruitmentPerDepartment', 'x_Address', 'Address', '`Address`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Address'] =& $this->Address;
		$this->Address->DateFilter = "";
		$this->Address->SqlSelect = "";
		$this->Address->SqlOrderBy = "";

		// Department
		$this->Department = new crField('RecruitmentPerDepartment', 'RecruitmentPerDepartment', 'x_Department', 'Department', '`Department`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Department'] =& $this->Department;
		$this->Department->DateFilter = "";
		$this->Department->SqlSelect = "";
		$this->Department->SqlOrderBy = "";

		// Position
		$this->Position = new crField('RecruitmentPerDepartment', 'RecruitmentPerDepartment', 'x_Position', 'Position', '`Position`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Position'] =& $this->Position;
		$this->Position->DateFilter = "";
		$this->Position->SqlSelect = "";
		$this->Position->SqlOrderBy = "";

		// Salary
		$this->Salary = new crField('RecruitmentPerDepartment', 'RecruitmentPerDepartment', 'x_Salary', 'Salary', '`Salary`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Salary->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Salary'] =& $this->Salary;
		$this->Salary->DateFilter = "";
		$this->Salary->SqlSelect = "";
		$this->Salary->SqlOrderBy = "";

		// Transport_Allowance
		$this->Transport_Allowance = new crField('RecruitmentPerDepartment', 'RecruitmentPerDepartment', 'x_Transport_Allowance', 'Transport_Allowance', '`Transport_Allowance`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Transport_Allowance->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Transport_Allowance'] =& $this->Transport_Allowance;
		$this->Transport_Allowance->DateFilter = "";
		$this->Transport_Allowance->SqlSelect = "";
		$this->Transport_Allowance->SqlOrderBy = "";

		// Hardship_Allowance
		$this->Hardship_Allowance = new crField('RecruitmentPerDepartment', 'RecruitmentPerDepartment', 'x_Hardship_Allowance', 'Hardship_Allowance', '`Hardship_Allowance`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Hardship_Allowance->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Hardship_Allowance'] =& $this->Hardship_Allowance;
		$this->Hardship_Allowance->DateFilter = "";
		$this->Hardship_Allowance->SqlSelect = "";
		$this->Hardship_Allowance->SqlOrderBy = "";

		// Position_Allowance
		$this->Position_Allowance = new crField('RecruitmentPerDepartment', 'RecruitmentPerDepartment', 'x_Position_Allowance', 'Position_Allowance', '`Position_Allowance`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Position_Allowance->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Position_Allowance'] =& $this->Position_Allowance;
		$this->Position_Allowance->DateFilter = "";
		$this->Position_Allowance->SqlSelect = "";
		$this->Position_Allowance->SqlOrderBy = "";

		// Department Name
		$this->Department_Name = new crField('RecruitmentPerDepartment', 'RecruitmentPerDepartment', 'x_Department_Name', 'Department Name', 'aqhrmsdb.recruitment.Department', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['Department_Name'] =& $this->Department_Name;
		$this->Department_Name->DateFilter = "";
		$this->Department_Name->SqlSelect = "";
		$this->Department_Name->SqlOrderBy = "";

		// Recruited
		$this->Recruited = new crField('RecruitmentPerDepartment', 'RecruitmentPerDepartment', 'x_Recruited', 'Recruited', 'Count(aqhrmsdb.recruitment.ID)', 20, EWRPT_DATATYPE_NUMBER, -1);
		$this->Recruited->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['Recruited'] =& $this->Recruited;
		$this->Recruited->DateFilter = "";
		$this->Recruited->SqlSelect = "";
		$this->Recruited->SqlOrderBy = "";

		// Housing_Allowance
		$this->Housing_Allowance = new crField('RecruitmentPerDepartment', 'RecruitmentPerDepartment', 'x_Housing_Allowance', 'Housing_Allowance', '`Housing_Allowance`', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->Housing_Allowance->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['Housing_Allowance'] =& $this->Housing_Allowance;
		$this->Housing_Allowance->DateFilter = "";
		$this->Housing_Allowance->SqlSelect = "";
		$this->Housing_Allowance->SqlOrderBy = "";
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
		return "`aqhrmsdb`.`recruitment`.`Department`";
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
$RecruitmentPerDepartment_rpt = new crRecruitmentPerDepartment_rpt();
$Page =& $RecruitmentPerDepartment_rpt;

// Page init
$RecruitmentPerDepartment_rpt->Page_Init();

// Page main
$RecruitmentPerDepartment_rpt->Page_Main();
?>
<?php include "phprptinc/header.php"; ?>
<?php if ($RecruitmentPerDepartment->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php $RecruitmentPerDepartment_rpt->ShowPageHeader(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php $RecruitmentPerDepartment_rpt->ShowMessage(); ?>
<?php if ($RecruitmentPerDepartment->Export == "" || $RecruitmentPerDepartment->Export == "print" || $RecruitmentPerDepartment->Export == "email") { ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php } ?>
<?php if ($RecruitmentPerDepartment->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
</script>
<?php } ?>
<?php if ($RecruitmentPerDepartment->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<?php if ($RecruitmentPerDepartment->Export == "" || $RecruitmentPerDepartment->Export == "print" || $RecruitmentPerDepartment->Export == "email") { ?>
<?php } ?>
<?php echo $RecruitmentPerDepartment->TableCaption() ?>
<?php if ($RecruitmentPerDepartment->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $RecruitmentPerDepartment_rpt->ExportPrintUrl ?>"><?php echo $ReportLanguage->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $RecruitmentPerDepartment_rpt->ExportExcelUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $RecruitmentPerDepartment_rpt->ExportWordUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToWord") ?></a>
<?php } ?>
<br /><br />
<?php if ($RecruitmentPerDepartment->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($RecruitmentPerDepartment->Export == "" || $RecruitmentPerDepartment->Export == "print" || $RecruitmentPerDepartment->Export == "email") { ?>
<?php } ?>
<?php if ($RecruitmentPerDepartment->Export == "") { ?>
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
<?php if ($RecruitmentPerDepartment->Export == "") { ?>
<div class="ewGridUpperPanel">
<form action="RecruitmentPerDepartmentrpt.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($RecruitmentPerDepartment_rpt->StartGrp, $RecruitmentPerDepartment_rpt->DisplayGrps, $RecruitmentPerDepartment_rpt->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="RecruitmentPerDepartmentrpt.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="RecruitmentPerDepartmentrpt.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="RecruitmentPerDepartmentrpt.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="RecruitmentPerDepartmentrpt.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($RecruitmentPerDepartment_rpt->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($RecruitmentPerDepartment_rpt->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("RecordsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($RecruitmentPerDepartment_rpt->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($RecruitmentPerDepartment_rpt->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($RecruitmentPerDepartment_rpt->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($RecruitmentPerDepartment_rpt->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($RecruitmentPerDepartment_rpt->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($RecruitmentPerDepartment_rpt->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($RecruitmentPerDepartment_rpt->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($RecruitmentPerDepartment_rpt->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($RecruitmentPerDepartment->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
if ($RecruitmentPerDepartment->ExportAll && $RecruitmentPerDepartment->Export <> "") {
	$RecruitmentPerDepartment_rpt->StopGrp = $RecruitmentPerDepartment_rpt->TotalGrps;
} else {
	$RecruitmentPerDepartment_rpt->StopGrp = $RecruitmentPerDepartment_rpt->StartGrp + $RecruitmentPerDepartment_rpt->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($RecruitmentPerDepartment_rpt->StopGrp) > intval($RecruitmentPerDepartment_rpt->TotalGrps))
	$RecruitmentPerDepartment_rpt->StopGrp = $RecruitmentPerDepartment_rpt->TotalGrps;
$RecruitmentPerDepartment_rpt->RecCount = 0;

// Get first row
if ($RecruitmentPerDepartment_rpt->TotalGrps > 0) {
	$RecruitmentPerDepartment_rpt->GetRow(1);
	$RecruitmentPerDepartment_rpt->GrpCount = 1;
}
while (($rs && !$rs->EOF && $RecruitmentPerDepartment_rpt->GrpCount <= $RecruitmentPerDepartment_rpt->DisplayGrps) || $RecruitmentPerDepartment_rpt->ShowFirstHeader) {

	// Show header
	if ($RecruitmentPerDepartment_rpt->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->Auto_ID) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $RecruitmentPerDepartment->Auto_ID->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->Auto_ID) ?>',0);"><?php echo $RecruitmentPerDepartment->Auto_ID->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($RecruitmentPerDepartment->Auto_ID->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($RecruitmentPerDepartment->Auto_ID->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->Employee) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $RecruitmentPerDepartment->Employee->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->Employee) ?>',0);"><?php echo $RecruitmentPerDepartment->Employee->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($RecruitmentPerDepartment->Employee->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($RecruitmentPerDepartment->Employee->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->Place) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $RecruitmentPerDepartment->Place->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->Place) ?>',0);"><?php echo $RecruitmentPerDepartment->Place->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($RecruitmentPerDepartment->Place->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($RecruitmentPerDepartment->Place->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->ID) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $RecruitmentPerDepartment->ID->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->ID) ?>',0);"><?php echo $RecruitmentPerDepartment->ID->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($RecruitmentPerDepartment->ID->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($RecruitmentPerDepartment->ID->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->FirstName) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $RecruitmentPerDepartment->FirstName->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->FirstName) ?>',0);"><?php echo $RecruitmentPerDepartment->FirstName->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($RecruitmentPerDepartment->FirstName->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($RecruitmentPerDepartment->FirstName->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->MiddelName) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $RecruitmentPerDepartment->MiddelName->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->MiddelName) ?>',0);"><?php echo $RecruitmentPerDepartment->MiddelName->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($RecruitmentPerDepartment->MiddelName->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($RecruitmentPerDepartment->MiddelName->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->LastName) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $RecruitmentPerDepartment->LastName->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->LastName) ?>',0);"><?php echo $RecruitmentPerDepartment->LastName->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($RecruitmentPerDepartment->LastName->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($RecruitmentPerDepartment->LastName->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->Age) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $RecruitmentPerDepartment->Age->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->Age) ?>',0);"><?php echo $RecruitmentPerDepartment->Age->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($RecruitmentPerDepartment->Age->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($RecruitmentPerDepartment->Age->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->Sex) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $RecruitmentPerDepartment->Sex->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->Sex) ?>',0);"><?php echo $RecruitmentPerDepartment->Sex->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($RecruitmentPerDepartment->Sex->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($RecruitmentPerDepartment->Sex->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->Photo) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $RecruitmentPerDepartment->Photo->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->Photo) ?>',0);"><?php echo $RecruitmentPerDepartment->Photo->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($RecruitmentPerDepartment->Photo->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($RecruitmentPerDepartment->Photo->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->Date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $RecruitmentPerDepartment->Date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->Date) ?>',0);"><?php echo $RecruitmentPerDepartment->Date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($RecruitmentPerDepartment->Date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($RecruitmentPerDepartment->Date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->Address) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $RecruitmentPerDepartment->Address->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->Address) ?>',0);"><?php echo $RecruitmentPerDepartment->Address->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($RecruitmentPerDepartment->Address->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($RecruitmentPerDepartment->Address->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->Department) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $RecruitmentPerDepartment->Department->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->Department) ?>',0);"><?php echo $RecruitmentPerDepartment->Department->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($RecruitmentPerDepartment->Department->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($RecruitmentPerDepartment->Department->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->Position) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $RecruitmentPerDepartment->Position->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->Position) ?>',0);"><?php echo $RecruitmentPerDepartment->Position->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($RecruitmentPerDepartment->Position->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($RecruitmentPerDepartment->Position->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->Salary) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $RecruitmentPerDepartment->Salary->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->Salary) ?>',0);"><?php echo $RecruitmentPerDepartment->Salary->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($RecruitmentPerDepartment->Salary->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($RecruitmentPerDepartment->Salary->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->Transport_Allowance) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $RecruitmentPerDepartment->Transport_Allowance->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->Transport_Allowance) ?>',0);"><?php echo $RecruitmentPerDepartment->Transport_Allowance->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($RecruitmentPerDepartment->Transport_Allowance->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($RecruitmentPerDepartment->Transport_Allowance->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->Hardship_Allowance) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $RecruitmentPerDepartment->Hardship_Allowance->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->Hardship_Allowance) ?>',0);"><?php echo $RecruitmentPerDepartment->Hardship_Allowance->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($RecruitmentPerDepartment->Hardship_Allowance->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($RecruitmentPerDepartment->Hardship_Allowance->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->Position_Allowance) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $RecruitmentPerDepartment->Position_Allowance->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->Position_Allowance) ?>',0);"><?php echo $RecruitmentPerDepartment->Position_Allowance->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($RecruitmentPerDepartment->Position_Allowance->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($RecruitmentPerDepartment->Position_Allowance->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->Department_Name) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $RecruitmentPerDepartment->Department_Name->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->Department_Name) ?>',0);"><?php echo $RecruitmentPerDepartment->Department_Name->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($RecruitmentPerDepartment->Department_Name->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($RecruitmentPerDepartment->Department_Name->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->Recruited) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $RecruitmentPerDepartment->Recruited->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->Recruited) ?>',0);"><?php echo $RecruitmentPerDepartment->Recruited->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($RecruitmentPerDepartment->Recruited->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($RecruitmentPerDepartment->Recruited->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->Housing_Allowance) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $RecruitmentPerDepartment->Housing_Allowance->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $RecruitmentPerDepartment->SortUrl($RecruitmentPerDepartment->Housing_Allowance) ?>',0);"><?php echo $RecruitmentPerDepartment->Housing_Allowance->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($RecruitmentPerDepartment->Housing_Allowance->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($RecruitmentPerDepartment->Housing_Allowance->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$RecruitmentPerDepartment_rpt->ShowFirstHeader = FALSE;
	}
	$RecruitmentPerDepartment_rpt->RecCount++;

		// Render detail row
		$RecruitmentPerDepartment->ResetCSS();
		$RecruitmentPerDepartment->RowType = EWRPT_ROWTYPE_DETAIL;
		$RecruitmentPerDepartment_rpt->RenderRow();
?>
	<tr<?php echo $RecruitmentPerDepartment->RowAttributes(); ?>>
		<td<?php echo $RecruitmentPerDepartment->Auto_ID->CellAttributes() ?>>
<div<?php echo $RecruitmentPerDepartment->Auto_ID->ViewAttributes(); ?>><?php echo $RecruitmentPerDepartment->Auto_ID->ListViewValue(); ?></div>
</td>
		<td<?php echo $RecruitmentPerDepartment->Employee->CellAttributes() ?>>
<div<?php echo $RecruitmentPerDepartment->Employee->ViewAttributes(); ?>><?php echo $RecruitmentPerDepartment->Employee->ListViewValue(); ?></div>
</td>
		<td<?php echo $RecruitmentPerDepartment->Place->CellAttributes() ?>>
<div<?php echo $RecruitmentPerDepartment->Place->ViewAttributes(); ?>><?php echo $RecruitmentPerDepartment->Place->ListViewValue(); ?></div>
</td>
		<td<?php echo $RecruitmentPerDepartment->ID->CellAttributes() ?>>
<div<?php echo $RecruitmentPerDepartment->ID->ViewAttributes(); ?>><?php echo $RecruitmentPerDepartment->ID->ListViewValue(); ?></div>
</td>
		<td<?php echo $RecruitmentPerDepartment->FirstName->CellAttributes() ?>>
<div<?php echo $RecruitmentPerDepartment->FirstName->ViewAttributes(); ?>><?php echo $RecruitmentPerDepartment->FirstName->ListViewValue(); ?></div>
</td>
		<td<?php echo $RecruitmentPerDepartment->MiddelName->CellAttributes() ?>>
<div<?php echo $RecruitmentPerDepartment->MiddelName->ViewAttributes(); ?>><?php echo $RecruitmentPerDepartment->MiddelName->ListViewValue(); ?></div>
</td>
		<td<?php echo $RecruitmentPerDepartment->LastName->CellAttributes() ?>>
<div<?php echo $RecruitmentPerDepartment->LastName->ViewAttributes(); ?>><?php echo $RecruitmentPerDepartment->LastName->ListViewValue(); ?></div>
</td>
		<td<?php echo $RecruitmentPerDepartment->Age->CellAttributes() ?>>
<div<?php echo $RecruitmentPerDepartment->Age->ViewAttributes(); ?>><?php echo $RecruitmentPerDepartment->Age->ListViewValue(); ?></div>
</td>
		<td<?php echo $RecruitmentPerDepartment->Sex->CellAttributes() ?>>
<div<?php echo $RecruitmentPerDepartment->Sex->ViewAttributes(); ?>><?php echo $RecruitmentPerDepartment->Sex->ListViewValue(); ?></div>
</td>
		<td<?php echo $RecruitmentPerDepartment->Photo->CellAttributes() ?>>
<div<?php echo $RecruitmentPerDepartment->Photo->ViewAttributes(); ?>><?php echo $RecruitmentPerDepartment->Photo->ListViewValue(); ?></div>
</td>
		<td<?php echo $RecruitmentPerDepartment->Date->CellAttributes() ?>>
<div<?php echo $RecruitmentPerDepartment->Date->ViewAttributes(); ?>><?php echo $RecruitmentPerDepartment->Date->ListViewValue(); ?></div>
</td>
		<td<?php echo $RecruitmentPerDepartment->Address->CellAttributes() ?>>
<div<?php echo $RecruitmentPerDepartment->Address->ViewAttributes(); ?>><?php echo $RecruitmentPerDepartment->Address->ListViewValue(); ?></div>
</td>
		<td<?php echo $RecruitmentPerDepartment->Department->CellAttributes() ?>>
<div<?php echo $RecruitmentPerDepartment->Department->ViewAttributes(); ?>><?php echo $RecruitmentPerDepartment->Department->ListViewValue(); ?></div>
</td>
		<td<?php echo $RecruitmentPerDepartment->Position->CellAttributes() ?>>
<div<?php echo $RecruitmentPerDepartment->Position->ViewAttributes(); ?>><?php echo $RecruitmentPerDepartment->Position->ListViewValue(); ?></div>
</td>
		<td<?php echo $RecruitmentPerDepartment->Salary->CellAttributes() ?>>
<div<?php echo $RecruitmentPerDepartment->Salary->ViewAttributes(); ?>><?php echo $RecruitmentPerDepartment->Salary->ListViewValue(); ?></div>
</td>
		<td<?php echo $RecruitmentPerDepartment->Transport_Allowance->CellAttributes() ?>>
<div<?php echo $RecruitmentPerDepartment->Transport_Allowance->ViewAttributes(); ?>><?php echo $RecruitmentPerDepartment->Transport_Allowance->ListViewValue(); ?></div>
</td>
		<td<?php echo $RecruitmentPerDepartment->Hardship_Allowance->CellAttributes() ?>>
<div<?php echo $RecruitmentPerDepartment->Hardship_Allowance->ViewAttributes(); ?>><?php echo $RecruitmentPerDepartment->Hardship_Allowance->ListViewValue(); ?></div>
</td>
		<td<?php echo $RecruitmentPerDepartment->Position_Allowance->CellAttributes() ?>>
<div<?php echo $RecruitmentPerDepartment->Position_Allowance->ViewAttributes(); ?>><?php echo $RecruitmentPerDepartment->Position_Allowance->ListViewValue(); ?></div>
</td>
		<td<?php echo $RecruitmentPerDepartment->Department_Name->CellAttributes() ?>>
<div<?php echo $RecruitmentPerDepartment->Department_Name->ViewAttributes(); ?>><?php echo $RecruitmentPerDepartment->Department_Name->ListViewValue(); ?></div>
</td>
		<td<?php echo $RecruitmentPerDepartment->Recruited->CellAttributes() ?>>
<div<?php echo $RecruitmentPerDepartment->Recruited->ViewAttributes(); ?>><?php echo $RecruitmentPerDepartment->Recruited->ListViewValue(); ?></div>
</td>
		<td<?php echo $RecruitmentPerDepartment->Housing_Allowance->CellAttributes() ?>>
<div<?php echo $RecruitmentPerDepartment->Housing_Allowance->ViewAttributes(); ?>><?php echo $RecruitmentPerDepartment->Housing_Allowance->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$RecruitmentPerDepartment_rpt->AccumulateSummary();

		// Get next record
		$RecruitmentPerDepartment_rpt->GetRow(2);
	$RecruitmentPerDepartment_rpt->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
	</tfoot>
</table>
</div>
<?php if ($RecruitmentPerDepartment_rpt->TotalGrps > 0) { ?>
<?php if ($RecruitmentPerDepartment->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="RecruitmentPerDepartmentrpt.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($RecruitmentPerDepartment_rpt->StartGrp, $RecruitmentPerDepartment_rpt->DisplayGrps, $RecruitmentPerDepartment_rpt->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="RecruitmentPerDepartmentrpt.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="RecruitmentPerDepartmentrpt.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="RecruitmentPerDepartmentrpt.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="RecruitmentPerDepartmentrpt.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($RecruitmentPerDepartment_rpt->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($RecruitmentPerDepartment_rpt->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("RecordsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($RecruitmentPerDepartment_rpt->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($RecruitmentPerDepartment_rpt->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($RecruitmentPerDepartment_rpt->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($RecruitmentPerDepartment_rpt->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($RecruitmentPerDepartment_rpt->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($RecruitmentPerDepartment_rpt->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($RecruitmentPerDepartment_rpt->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($RecruitmentPerDepartment_rpt->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($RecruitmentPerDepartment->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php if ($RecruitmentPerDepartment->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($RecruitmentPerDepartment->Export == "" || $RecruitmentPerDepartment->Export == "print" || $RecruitmentPerDepartment->Export == "email") { ?>
<?php } ?>
<?php if ($RecruitmentPerDepartment->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($RecruitmentPerDepartment->Export == "" || $RecruitmentPerDepartment->Export == "print" || $RecruitmentPerDepartment->Export == "email") { ?>
<?php } ?>
<?php if ($RecruitmentPerDepartment->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $RecruitmentPerDepartment_rpt->ShowPageFooter(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($RecruitmentPerDepartment->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "phprptinc/footer.php"; ?>
<?php
$RecruitmentPerDepartment_rpt->Page_Terminate();
?>
<?php

//
// Page class
//
class crRecruitmentPerDepartment_rpt {

	// Page ID
	var $PageID = 'rpt';

	// Table name
	var $TableName = 'RecruitmentPerDepartment';

	// Page object name
	var $PageObjName = 'RecruitmentPerDepartment_rpt';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $RecruitmentPerDepartment;
		if ($RecruitmentPerDepartment->UseTokenInUrl) $PageUrl .= "t=" . $RecruitmentPerDepartment->TableVar . "&"; // Add page token
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
		global $RecruitmentPerDepartment;
		if ($RecruitmentPerDepartment->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($RecruitmentPerDepartment->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($RecruitmentPerDepartment->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crRecruitmentPerDepartment_rpt() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (RecruitmentPerDepartment)
		$GLOBALS["RecruitmentPerDepartment"] = new crRecruitmentPerDepartment();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'rpt', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'RecruitmentPerDepartment', TRUE);

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
		global $RecruitmentPerDepartment;

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$RecruitmentPerDepartment->Export = $_GET["export"];
	}
	$gsExport = $RecruitmentPerDepartment->Export; // Get export parameter, used in header
	$gsExportFile = $RecruitmentPerDepartment->TableVar; // Get export file, used in header
	if ($RecruitmentPerDepartment->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($RecruitmentPerDepartment->Export == "word") {
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
		global $RecruitmentPerDepartment;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($RecruitmentPerDepartment->Export == "email") {
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
		global $RecruitmentPerDepartment;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 22;
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
		$this->Col = array(FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE);

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
		$sSql = ewrpt_BuildReportSql($RecruitmentPerDepartment->SqlSelect(), $RecruitmentPerDepartment->SqlWhere(), $RecruitmentPerDepartment->SqlGroupBy(), $RecruitmentPerDepartment->SqlHaving(), $RecruitmentPerDepartment->SqlOrderBy(), $this->Filter, $this->Sort);
		$this->TotalGrps = $this->GetCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($RecruitmentPerDepartment->ExportAll && $RecruitmentPerDepartment->Export <> "")
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
		global $RecruitmentPerDepartment;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$RecruitmentPerDepartment->Auto_ID->setDbValue($rs->fields('Auto_ID'));
			$RecruitmentPerDepartment->Employee->setDbValue($rs->fields('Employee'));
			$RecruitmentPerDepartment->Place->setDbValue($rs->fields('Place'));
			$RecruitmentPerDepartment->ID->setDbValue($rs->fields('ID'));
			$RecruitmentPerDepartment->FirstName->setDbValue($rs->fields('FirstName'));
			$RecruitmentPerDepartment->MiddelName->setDbValue($rs->fields('MiddelName'));
			$RecruitmentPerDepartment->LastName->setDbValue($rs->fields('LastName'));
			$RecruitmentPerDepartment->Age->setDbValue($rs->fields('Age'));
			$RecruitmentPerDepartment->Sex->setDbValue($rs->fields('Sex'));
			$RecruitmentPerDepartment->Photo->setDbValue($rs->fields('Photo'));
			$RecruitmentPerDepartment->Date->setDbValue($rs->fields('Date'));
			$RecruitmentPerDepartment->Address->setDbValue($rs->fields('Address'));
			$RecruitmentPerDepartment->Department->setDbValue($rs->fields('Department'));
			$RecruitmentPerDepartment->Position->setDbValue($rs->fields('Position'));
			$RecruitmentPerDepartment->Salary->setDbValue($rs->fields('Salary'));
			$RecruitmentPerDepartment->Transport_Allowance->setDbValue($rs->fields('Transport_Allowance'));
			$RecruitmentPerDepartment->Hardship_Allowance->setDbValue($rs->fields('Hardship_Allowance'));
			$RecruitmentPerDepartment->Position_Allowance->setDbValue($rs->fields('Position_Allowance'));
			$RecruitmentPerDepartment->Department_Name->setDbValue($rs->fields('Department Name'));
			$RecruitmentPerDepartment->Recruited->setDbValue($rs->fields('Recruited'));
			$RecruitmentPerDepartment->Housing_Allowance->setDbValue($rs->fields('Housing_Allowance'));
			$this->Val[1] = $RecruitmentPerDepartment->Auto_ID->CurrentValue;
			$this->Val[2] = $RecruitmentPerDepartment->Employee->CurrentValue;
			$this->Val[3] = $RecruitmentPerDepartment->Place->CurrentValue;
			$this->Val[4] = $RecruitmentPerDepartment->ID->CurrentValue;
			$this->Val[5] = $RecruitmentPerDepartment->FirstName->CurrentValue;
			$this->Val[6] = $RecruitmentPerDepartment->MiddelName->CurrentValue;
			$this->Val[7] = $RecruitmentPerDepartment->LastName->CurrentValue;
			$this->Val[8] = $RecruitmentPerDepartment->Age->CurrentValue;
			$this->Val[9] = $RecruitmentPerDepartment->Sex->CurrentValue;
			$this->Val[10] = $RecruitmentPerDepartment->Photo->CurrentValue;
			$this->Val[11] = $RecruitmentPerDepartment->Date->CurrentValue;
			$this->Val[12] = $RecruitmentPerDepartment->Address->CurrentValue;
			$this->Val[13] = $RecruitmentPerDepartment->Department->CurrentValue;
			$this->Val[14] = $RecruitmentPerDepartment->Position->CurrentValue;
			$this->Val[15] = $RecruitmentPerDepartment->Salary->CurrentValue;
			$this->Val[16] = $RecruitmentPerDepartment->Transport_Allowance->CurrentValue;
			$this->Val[17] = $RecruitmentPerDepartment->Hardship_Allowance->CurrentValue;
			$this->Val[18] = $RecruitmentPerDepartment->Position_Allowance->CurrentValue;
			$this->Val[19] = $RecruitmentPerDepartment->Department_Name->CurrentValue;
			$this->Val[20] = $RecruitmentPerDepartment->Recruited->CurrentValue;
			$this->Val[21] = $RecruitmentPerDepartment->Housing_Allowance->CurrentValue;
		} else {
			$RecruitmentPerDepartment->Auto_ID->setDbValue("");
			$RecruitmentPerDepartment->Employee->setDbValue("");
			$RecruitmentPerDepartment->Place->setDbValue("");
			$RecruitmentPerDepartment->ID->setDbValue("");
			$RecruitmentPerDepartment->FirstName->setDbValue("");
			$RecruitmentPerDepartment->MiddelName->setDbValue("");
			$RecruitmentPerDepartment->LastName->setDbValue("");
			$RecruitmentPerDepartment->Age->setDbValue("");
			$RecruitmentPerDepartment->Sex->setDbValue("");
			$RecruitmentPerDepartment->Photo->setDbValue("");
			$RecruitmentPerDepartment->Date->setDbValue("");
			$RecruitmentPerDepartment->Address->setDbValue("");
			$RecruitmentPerDepartment->Department->setDbValue("");
			$RecruitmentPerDepartment->Position->setDbValue("");
			$RecruitmentPerDepartment->Salary->setDbValue("");
			$RecruitmentPerDepartment->Transport_Allowance->setDbValue("");
			$RecruitmentPerDepartment->Hardship_Allowance->setDbValue("");
			$RecruitmentPerDepartment->Position_Allowance->setDbValue("");
			$RecruitmentPerDepartment->Department_Name->setDbValue("");
			$RecruitmentPerDepartment->Recruited->setDbValue("");
			$RecruitmentPerDepartment->Housing_Allowance->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $RecruitmentPerDepartment;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$RecruitmentPerDepartment->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$RecruitmentPerDepartment->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $RecruitmentPerDepartment->getStartGroup();
			}
		} else {
			$this->StartGrp = $RecruitmentPerDepartment->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$RecruitmentPerDepartment->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$RecruitmentPerDepartment->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$RecruitmentPerDepartment->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $RecruitmentPerDepartment;

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
		global $RecruitmentPerDepartment;
		$this->StartGrp = 1;
		$RecruitmentPerDepartment->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $RecruitmentPerDepartment;
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
			$RecruitmentPerDepartment->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$RecruitmentPerDepartment->setStartGroup($this->StartGrp);
		} else {
			if ($RecruitmentPerDepartment->getGroupPerPage() <> "") {
				$this->DisplayGrps = $RecruitmentPerDepartment->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $Security;
		global $RecruitmentPerDepartment;
		if ($RecruitmentPerDepartment->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($RecruitmentPerDepartment->SqlSelectCount(), $RecruitmentPerDepartment->SqlWhere(), $RecruitmentPerDepartment->SqlGroupBy(), $RecruitmentPerDepartment->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}
		}

		// Call Row_Rendering event
		$RecruitmentPerDepartment->Row_Rendering();

		/* --------------------
		'  Render view codes
		' --------------------- */
		if ($RecruitmentPerDepartment->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// Auto_ID
			$RecruitmentPerDepartment->Auto_ID->ViewValue = $RecruitmentPerDepartment->Auto_ID->Summary;

			// Employee
			$RecruitmentPerDepartment->Employee->ViewValue = $RecruitmentPerDepartment->Employee->Summary;

			// Place
			$RecruitmentPerDepartment->Place->ViewValue = $RecruitmentPerDepartment->Place->Summary;

			// ID
			$RecruitmentPerDepartment->ID->ViewValue = $RecruitmentPerDepartment->ID->Summary;

			// FirstName
			$RecruitmentPerDepartment->FirstName->ViewValue = $RecruitmentPerDepartment->FirstName->Summary;

			// MiddelName
			$RecruitmentPerDepartment->MiddelName->ViewValue = $RecruitmentPerDepartment->MiddelName->Summary;

			// LastName
			$RecruitmentPerDepartment->LastName->ViewValue = $RecruitmentPerDepartment->LastName->Summary;

			// Age
			$RecruitmentPerDepartment->Age->ViewValue = $RecruitmentPerDepartment->Age->Summary;

			// Sex
			$RecruitmentPerDepartment->Sex->ViewValue = $RecruitmentPerDepartment->Sex->Summary;

			// Photo
			$RecruitmentPerDepartment->Photo->ViewValue = $RecruitmentPerDepartment->Photo->Summary;

			// Date
			$RecruitmentPerDepartment->Date->ViewValue = $RecruitmentPerDepartment->Date->Summary;
			$RecruitmentPerDepartment->Date->ViewValue = ewrpt_FormatDateTime($RecruitmentPerDepartment->Date->ViewValue, 5);

			// Address
			$RecruitmentPerDepartment->Address->ViewValue = $RecruitmentPerDepartment->Address->Summary;

			// Department
			$RecruitmentPerDepartment->Department->ViewValue = $RecruitmentPerDepartment->Department->Summary;

			// Position
			$RecruitmentPerDepartment->Position->ViewValue = $RecruitmentPerDepartment->Position->Summary;

			// Salary
			$RecruitmentPerDepartment->Salary->ViewValue = $RecruitmentPerDepartment->Salary->Summary;

			// Transport_Allowance
			$RecruitmentPerDepartment->Transport_Allowance->ViewValue = $RecruitmentPerDepartment->Transport_Allowance->Summary;

			// Hardship_Allowance
			$RecruitmentPerDepartment->Hardship_Allowance->ViewValue = $RecruitmentPerDepartment->Hardship_Allowance->Summary;

			// Position_Allowance
			$RecruitmentPerDepartment->Position_Allowance->ViewValue = $RecruitmentPerDepartment->Position_Allowance->Summary;

			// Department Name
			$RecruitmentPerDepartment->Department_Name->ViewValue = $RecruitmentPerDepartment->Department_Name->Summary;

			// Recruited
			$RecruitmentPerDepartment->Recruited->ViewValue = $RecruitmentPerDepartment->Recruited->Summary;

			// Housing_Allowance
			$RecruitmentPerDepartment->Housing_Allowance->ViewValue = $RecruitmentPerDepartment->Housing_Allowance->Summary;
		} else {

			// Auto_ID
			$RecruitmentPerDepartment->Auto_ID->ViewValue = $RecruitmentPerDepartment->Auto_ID->CurrentValue;
			$RecruitmentPerDepartment->Auto_ID->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Employee
			$RecruitmentPerDepartment->Employee->ViewValue = $RecruitmentPerDepartment->Employee->CurrentValue;
			$RecruitmentPerDepartment->Employee->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Place
			$RecruitmentPerDepartment->Place->ViewValue = $RecruitmentPerDepartment->Place->CurrentValue;
			$RecruitmentPerDepartment->Place->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// ID
			$RecruitmentPerDepartment->ID->ViewValue = $RecruitmentPerDepartment->ID->CurrentValue;
			$RecruitmentPerDepartment->ID->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// FirstName
			$RecruitmentPerDepartment->FirstName->ViewValue = $RecruitmentPerDepartment->FirstName->CurrentValue;
			$RecruitmentPerDepartment->FirstName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// MiddelName
			$RecruitmentPerDepartment->MiddelName->ViewValue = $RecruitmentPerDepartment->MiddelName->CurrentValue;
			$RecruitmentPerDepartment->MiddelName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// LastName
			$RecruitmentPerDepartment->LastName->ViewValue = $RecruitmentPerDepartment->LastName->CurrentValue;
			$RecruitmentPerDepartment->LastName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Age
			$RecruitmentPerDepartment->Age->ViewValue = $RecruitmentPerDepartment->Age->CurrentValue;
			$RecruitmentPerDepartment->Age->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Sex
			$RecruitmentPerDepartment->Sex->ViewValue = $RecruitmentPerDepartment->Sex->CurrentValue;
			$RecruitmentPerDepartment->Sex->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Photo
			$RecruitmentPerDepartment->Photo->ViewValue = $RecruitmentPerDepartment->Photo->CurrentValue;
			$RecruitmentPerDepartment->Photo->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Date
			$RecruitmentPerDepartment->Date->ViewValue = $RecruitmentPerDepartment->Date->CurrentValue;
			$RecruitmentPerDepartment->Date->ViewValue = ewrpt_FormatDateTime($RecruitmentPerDepartment->Date->ViewValue, 5);
			$RecruitmentPerDepartment->Date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Address
			$RecruitmentPerDepartment->Address->ViewValue = $RecruitmentPerDepartment->Address->CurrentValue;
			$RecruitmentPerDepartment->Address->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Department
			$RecruitmentPerDepartment->Department->ViewValue = $RecruitmentPerDepartment->Department->CurrentValue;
			$RecruitmentPerDepartment->Department->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Position
			$RecruitmentPerDepartment->Position->ViewValue = $RecruitmentPerDepartment->Position->CurrentValue;
			$RecruitmentPerDepartment->Position->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Salary
			$RecruitmentPerDepartment->Salary->ViewValue = $RecruitmentPerDepartment->Salary->CurrentValue;
			$RecruitmentPerDepartment->Salary->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Transport_Allowance
			$RecruitmentPerDepartment->Transport_Allowance->ViewValue = $RecruitmentPerDepartment->Transport_Allowance->CurrentValue;
			$RecruitmentPerDepartment->Transport_Allowance->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Hardship_Allowance
			$RecruitmentPerDepartment->Hardship_Allowance->ViewValue = $RecruitmentPerDepartment->Hardship_Allowance->CurrentValue;
			$RecruitmentPerDepartment->Hardship_Allowance->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Position_Allowance
			$RecruitmentPerDepartment->Position_Allowance->ViewValue = $RecruitmentPerDepartment->Position_Allowance->CurrentValue;
			$RecruitmentPerDepartment->Position_Allowance->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Department Name
			$RecruitmentPerDepartment->Department_Name->ViewValue = $RecruitmentPerDepartment->Department_Name->CurrentValue;
			$RecruitmentPerDepartment->Department_Name->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Recruited
			$RecruitmentPerDepartment->Recruited->ViewValue = $RecruitmentPerDepartment->Recruited->CurrentValue;
			$RecruitmentPerDepartment->Recruited->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Housing_Allowance
			$RecruitmentPerDepartment->Housing_Allowance->ViewValue = $RecruitmentPerDepartment->Housing_Allowance->CurrentValue;
			$RecruitmentPerDepartment->Housing_Allowance->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// Auto_ID
		$RecruitmentPerDepartment->Auto_ID->HrefValue = "";

		// Employee
		$RecruitmentPerDepartment->Employee->HrefValue = "";

		// Place
		$RecruitmentPerDepartment->Place->HrefValue = "";

		// ID
		$RecruitmentPerDepartment->ID->HrefValue = "";

		// FirstName
		$RecruitmentPerDepartment->FirstName->HrefValue = "";

		// MiddelName
		$RecruitmentPerDepartment->MiddelName->HrefValue = "";

		// LastName
		$RecruitmentPerDepartment->LastName->HrefValue = "";

		// Age
		$RecruitmentPerDepartment->Age->HrefValue = "";

		// Sex
		$RecruitmentPerDepartment->Sex->HrefValue = "";

		// Photo
		$RecruitmentPerDepartment->Photo->HrefValue = "";

		// Date
		$RecruitmentPerDepartment->Date->HrefValue = "";

		// Address
		$RecruitmentPerDepartment->Address->HrefValue = "";

		// Department
		$RecruitmentPerDepartment->Department->HrefValue = "";

		// Position
		$RecruitmentPerDepartment->Position->HrefValue = "";

		// Salary
		$RecruitmentPerDepartment->Salary->HrefValue = "";

		// Transport_Allowance
		$RecruitmentPerDepartment->Transport_Allowance->HrefValue = "";

		// Hardship_Allowance
		$RecruitmentPerDepartment->Hardship_Allowance->HrefValue = "";

		// Position_Allowance
		$RecruitmentPerDepartment->Position_Allowance->HrefValue = "";

		// Department Name
		$RecruitmentPerDepartment->Department_Name->HrefValue = "";

		// Recruited
		$RecruitmentPerDepartment->Recruited->HrefValue = "";

		// Housing_Allowance
		$RecruitmentPerDepartment->Housing_Allowance->HrefValue = "";

		// Call Row_Rendered event
		$RecruitmentPerDepartment->Row_Rendered();
	}

	// Return poup filter
	function GetPopupFilter() {
		global $RecruitmentPerDepartment;
		$sWrk = "";
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $RecruitmentPerDepartment;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$RecruitmentPerDepartment->setOrderBy("");
				$RecruitmentPerDepartment->setStartGroup(1);
				$RecruitmentPerDepartment->Auto_ID->setSort("");
				$RecruitmentPerDepartment->Employee->setSort("");
				$RecruitmentPerDepartment->Place->setSort("");
				$RecruitmentPerDepartment->ID->setSort("");
				$RecruitmentPerDepartment->FirstName->setSort("");
				$RecruitmentPerDepartment->MiddelName->setSort("");
				$RecruitmentPerDepartment->LastName->setSort("");
				$RecruitmentPerDepartment->Age->setSort("");
				$RecruitmentPerDepartment->Sex->setSort("");
				$RecruitmentPerDepartment->Photo->setSort("");
				$RecruitmentPerDepartment->Date->setSort("");
				$RecruitmentPerDepartment->Address->setSort("");
				$RecruitmentPerDepartment->Department->setSort("");
				$RecruitmentPerDepartment->Position->setSort("");
				$RecruitmentPerDepartment->Salary->setSort("");
				$RecruitmentPerDepartment->Transport_Allowance->setSort("");
				$RecruitmentPerDepartment->Hardship_Allowance->setSort("");
				$RecruitmentPerDepartment->Position_Allowance->setSort("");
				$RecruitmentPerDepartment->Department_Name->setSort("");
				$RecruitmentPerDepartment->Recruited->setSort("");
				$RecruitmentPerDepartment->Housing_Allowance->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$RecruitmentPerDepartment->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$RecruitmentPerDepartment->CurrentOrderType = @$_GET["ordertype"];
			$sSortSql = $RecruitmentPerDepartment->SortSql();
			$RecruitmentPerDepartment->setOrderBy($sSortSql);
			$RecruitmentPerDepartment->setStartGroup(1);
		}
		return $RecruitmentPerDepartment->getOrderBy();
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
