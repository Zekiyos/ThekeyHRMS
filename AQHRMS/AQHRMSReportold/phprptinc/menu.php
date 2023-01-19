<?php

// Menu
define("EWRPT_MENUBAR_CLASSNAME", "ewMenuBarVertical", TRUE);
define("EWRPT_MENUBAR_SUBMENU_CLASSNAME", "", TRUE);
?>
<?php

/**
 * Menu class
 */

class crMenu {
	var $Id;
	var $IsRoot = FALSE;
	var $NoItem = NULL;
	var $ItemData = array();

	function crMenu($id) {
		$this->Id = $id;
	}

	// Add a menu item
	function AddMenuItem($id, $text, $url, $parentid, $src, $target, $allowed = TRUE) {
		$item = new crMenuItem($id, $text, $url, $parentid, $src, $target, $allowed);

		// Fire MenuItem_Adding event
		if (function_exists("MenuItem_Adding") && !MenuItem_Adding($item))
			return;
		if ($item->ParentId < 0) {
			$this->AddItem($item);
		} else {
			if ($oParentMenu =& $this->FindItem($item->ParentId))
				$oParentMenu->AddItem($item);
		}
	}

	// Add item to internal array
	function AddItem($item) {
		$this->ItemData[] = $item;
	}

	// Find item
	function &FindItem($id) {
		$cnt = count($this->ItemData);
		for ($i = 0; $i < $cnt; $i++) {
			$item =& $this->ItemData[$i];
			if ($item->Id == $id) {
				return $item;
			} elseif (!is_null($item->SubMenu)) {
				if ($subitem =& $item->SubMenu->FindItem($id))
					return $subitem;
			}
		}
		return $this->NoItem;
	}

	// Check if a menu item should be shown
	function RenderItem($item) {
		if (!is_null($item->SubMenu)) {
			foreach ($item->SubMenu->ItemData as $subitem) {
				if ($item->SubMenu->RenderItem($subitem))
					return TRUE;
			}
		}
		return ($item->Allowed && $item->Url <> "");
	}

	// Check if this menu should be rendered
	function RenderMenu() {
		foreach ($this->ItemData as $item) {
			if ($this->RenderItem($item))
				return TRUE;
		}
		return FALSE;
	}

	// Render the menu
	function Render() {
		if (!$this->RenderMenu())
			return;
		echo "<ul";
		if ($this->Id <> "") {
			if (is_numeric($this->Id)) {
				echo " id=\"menu_" . $this->Id . "\"";
			} else {
				echo " id=\"" . $this->Id . "\"";
			}
		}
		if ($this->IsRoot)
			echo " class=\"" . EWRPT_MENUBAR_CLASSNAME . "\"";
		echo ">\n";
		foreach ($this->ItemData as $item) {
			if ($this->RenderItem($item)) {
				echo "<li><a";
				if (!is_null($item->SubMenu) && $item->SubMenu->RenderMenu())
					echo " class=\"" . EWRPT_MENUBAR_SUBMENU_CLASSNAME . "\"";
				if ($item->Url <> "")
					echo " href=\"" . htmlspecialchars(strval($item->Url)) . "\"";
				if ($item->Target <> "")
					echo " target=\"" . $item->Target . "\"";
				echo ">" . $item->Text . "</a>\n";
				if (!is_null($item->SubMenu))
					$item->SubMenu->Render();
				echo "</li>\n";
			}
		}
		echo "</ul>\n";
	}
}

// Menu item class
class crMenuItem {
	var $Id;
	var $Text;
	var $Url;
	var $ParentId; 
	var $SubMenu = NULL; // Data type = crMenu
	var $Source;
	var $Allowed = TRUE;
	var $Target;

	function crMenuItem($id, $text, $url, $parentid, $src, $target, $allowed) {
		$this->Id = $id;
		$this->Text = $text;
		$this->Url = $url;
		$this->ParentId = $parentid;
		$this->Source = $src;
		$this->Target = $target;
		$this->Allowed = $allowed;
	}

	function AddItem($item) { // Add submenu item
		if (is_null($this->SubMenu))
			$this->SubMenu = new crMenu($this->Id);
		$this->SubMenu->AddItem($item);
	}
}

// Report MenuItem Adding event
function MenuItem_Adding(&$Item) {

	//var_dump($Item);
	// Return FALSE if menu item not allowed

	return TRUE;
}
?>
<!-- Begin Main Menu -->
<div class="phpreportmaker">
<?php

// Generate all menu items
$RootMenu = new crMenu("RootMenu");
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(38, $ReportLanguage->Phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("38", "MenuText") . $ReportLanguage->Phrase("SimpleReportMenuItemSuffix"), "RecruitmentPerDepartmentrpt.php", -1, "", "", TRUE);
$RootMenu->AddMenuItem(39, $ReportLanguage->Phrase("DetailSummaryReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("39", "MenuText") . $ReportLanguage->Phrase("DetailSummaryReportMenuItemSuffix"), "Recruitment_Per_Departmentsmry.php", -1, "", "", TRUE);
$RootMenu->AddMenuItem(22, $ReportLanguage->Phrase("DetailSummaryReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("22", "MenuText") . $ReportLanguage->Phrase("DetailSummaryReportMenuItemSuffix"), "Total_Leave_Day_Takensmry.php", -1, "", "", TRUE);
$RootMenu->AddMenuItem(23, $ReportLanguage->Phrase("DetailSummaryReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("23", "MenuText") . $ReportLanguage->Phrase("DetailSummaryReportMenuItemSuffix"), "Total_Attendancesmry.php", -1, "", "", TRUE);
$RootMenu->AddMenuItem(24, $ReportLanguage->Phrase("DetailSummaryReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("24", "MenuText") . $ReportLanguage->Phrase("DetailSummaryReportMenuItemSuffix"), "Employee_Personal_Recordsmry.php", -1, "", "", TRUE);
$RootMenu->AddMenuItem(25, $ReportLanguage->Phrase("ChartReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("25", "MenuText") . $ReportLanguage->Phrase("ChartReportMenuItemSuffix"), "Employee_Personal_Recordsmry.php#cht_Number_Of_Employee_Per_Department", 24, "", "", TRUE);
$RootMenu->AddMenuItem(49, $ReportLanguage->Phrase("DetailSummaryReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("49", "MenuText") . $ReportLanguage->Phrase("DetailSummaryReportMenuItemSuffix"), "Number_Of_Employee_Per_Department_Summarysmry.php", 24, "", "", TRUE);
$RootMenu->AddMenuItem(48, $ReportLanguage->Phrase("ChartReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("48", "MenuText") . $ReportLanguage->Phrase("ChartReportMenuItemSuffix"), "Employee_Personal_Recordsmry.php#cht_Employee_Distribution", 24, "", "", TRUE);
$RootMenu->AddMenuItem(52, $ReportLanguage->Phrase("DetailSummaryReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("52", "MenuText") . $ReportLanguage->Phrase("DetailSummaryReportMenuItemSuffix"), "Cholinesterase_Testsmry.php", -1, "", "", TRUE);
$RootMenu->AddMenuItem(28, $ReportLanguage->Phrase("DetailSummaryReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("28", "MenuText") . $ReportLanguage->Phrase("DetailSummaryReportMenuItemSuffix"), "Terminated_Employeesmry.php", -1, "", "", TRUE);
$RootMenu->AddMenuItem(53, $ReportLanguage->Phrase("ChartReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("53", "MenuText") . $ReportLanguage->Phrase("ChartReportMenuItemSuffix"), "Terminated_Employeesmry.php#cht_Terminated_Employee_Per_Department", 28, "", "", TRUE);
$RootMenu->AddMenuItem(30, $ReportLanguage->Phrase("DetailSummaryReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("30", "MenuText") . $ReportLanguage->Phrase("DetailSummaryReportMenuItemSuffix"), "Transfered_Outsmry.php", -1, "", "", TRUE);
$RootMenu->AddMenuItem(31, $ReportLanguage->Phrase("DetailSummaryReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("31", "MenuText") . $ReportLanguage->Phrase("DetailSummaryReportMenuItemSuffix"), "Tranfered_Insmry.php", -1, "", "", TRUE);
$RootMenu->AddMenuItem(33, $ReportLanguage->Phrase("DetailSummaryReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("33", "MenuText") . $ReportLanguage->Phrase("DetailSummaryReportMenuItemSuffix"), "Recruited_Employeesmry.php", -1, "", "", TRUE);
$RootMenu->AddMenuItem(21, $ReportLanguage->MenuPhrase("21", "MenuText"), "", -1, "", "", TRUE);
$RootMenu->AddMenuItem(14, $ReportLanguage->Phrase("DetailSummaryReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("14", "MenuText") . $ReportLanguage->Phrase("DetailSummaryReportMenuItemSuffix"), "Annual_Leavesmry.php", 21, "", "", TRUE);
$RootMenu->AddMenuItem(34, $ReportLanguage->Phrase("DetailSummaryReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("34", "MenuText") . $ReportLanguage->Phrase("DetailSummaryReportMenuItemSuffix"), "Annual_Leave_Per_Deparmtent_Summarysmry.php", 14, "", "", TRUE);
$RootMenu->AddMenuItem(15, $ReportLanguage->Phrase("DetailSummaryReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("15", "MenuText") . $ReportLanguage->Phrase("DetailSummaryReportMenuItemSuffix"), "Funeral_Leavesmry.php", 21, "", "", TRUE);
$RootMenu->AddMenuItem(42, $ReportLanguage->Phrase("DetailSummaryReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("42", "MenuText") . $ReportLanguage->Phrase("DetailSummaryReportMenuItemSuffix"), "Funera_Leave_Per_Department_Summarysmry.php", 15, "", "", TRUE);
$RootMenu->AddMenuItem(16, $ReportLanguage->Phrase("DetailSummaryReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("16", "MenuText") . $ReportLanguage->Phrase("DetailSummaryReportMenuItemSuffix"), "Sick_Leavesmry.php", 21, "", "", TRUE);
$RootMenu->AddMenuItem(45, $ReportLanguage->Phrase("DetailSummaryReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("45", "MenuText") . $ReportLanguage->Phrase("DetailSummaryReportMenuItemSuffix"), "Sick_Leave_Per_Department_Summarysmry.php", 16, "", "", TRUE);
$RootMenu->AddMenuItem(17, $ReportLanguage->Phrase("DetailSummaryReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("17", "MenuText") . $ReportLanguage->Phrase("DetailSummaryReportMenuItemSuffix"), "Maternity_Leavesmry.php", 21, "", "", TRUE);
$RootMenu->AddMenuItem(36, $ReportLanguage->Phrase("DetailSummaryReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("36", "MenuText") . $ReportLanguage->Phrase("DetailSummaryReportMenuItemSuffix"), "Maternity__Leave_Per_Department_Summarysmry.php", 17, "", "", TRUE);
$RootMenu->AddMenuItem(18, $ReportLanguage->Phrase("DetailSummaryReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("18", "MenuText") . $ReportLanguage->Phrase("DetailSummaryReportMenuItemSuffix"), "Paternity_Leavesmry.php", 21, "", "", TRUE);
$RootMenu->AddMenuItem(40, $ReportLanguage->Phrase("DetailSummaryReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("40", "MenuText") . $ReportLanguage->Phrase("DetailSummaryReportMenuItemSuffix"), "Paternity_Leave_Per_Department_Summarysmry.php", 18, "", "", TRUE);
$RootMenu->AddMenuItem(19, $ReportLanguage->Phrase("DetailSummaryReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("19", "MenuText") . $ReportLanguage->Phrase("DetailSummaryReportMenuItemSuffix"), "Special_Leavesmry.php", 21, "", "", TRUE);
$RootMenu->AddMenuItem(46, $ReportLanguage->Phrase("DetailSummaryReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("46", "MenuText") . $ReportLanguage->Phrase("DetailSummaryReportMenuItemSuffix"), "Special_Leave_Per_Department_Summarysmry.php", 19, "", "", TRUE);
$RootMenu->AddMenuItem(20, $ReportLanguage->Phrase("DetailSummaryReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("20", "MenuText") . $ReportLanguage->Phrase("DetailSummaryReportMenuItemSuffix"), "Wedding_Leavesmry.php", 21, "", "", TRUE);
$RootMenu->AddMenuItem(47, $ReportLanguage->Phrase("DetailSummaryReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("47", "MenuText") . $ReportLanguage->Phrase("DetailSummaryReportMenuItemSuffix"), "Wedding_Leave_Per_Department_Summarysmry.php", 20, "", "", TRUE);
$RootMenu->Render();
?>
</div>
<!-- End Main Menu -->
