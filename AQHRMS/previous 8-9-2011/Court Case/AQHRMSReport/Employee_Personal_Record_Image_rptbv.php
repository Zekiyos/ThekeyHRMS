<?php
session_start();
ob_start();
?>
<?php include "phprptinc/ewrcfg4.php"; ?>
<?php include "phprptinc/ewmysql.php"; ?>
<?php include "phprptinc/ewrfn4.php"; ?>
<?php include "phprptinc/ewrusrfn.php"; ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Create page object
$Employee_Personal_Record_Image_rptblobview = new crEmployee_Personal_Record_Image_rptblobview();
$Page =& $Employee_Personal_Record_Image_rptblobview;

// Page init
$Employee_Personal_Record_Image_rptblobview->Page_Init();

// Page main
$Employee_Personal_Record_Image_rptblobview->Page_Main();
?>
<?php
$Employee_Personal_Record_Image_rptblobview->Page_Terminate();
?>
<?php

//
// Page class
//
class crEmployee_Personal_Record_Image_rptblobview {

	// Page ID
	var $PageID = 'rptblobview';

	// Page object name
	var $PageObjName = 'Employee_Personal_Record_Image_rptblobview';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		return $PageUrl;
	}

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

	// Validate page request
	function IsPageRequest() {
		return TRUE;
	}

	//
	// Page class constructor
	//
	function crEmployee_Personal_Record_Image_rptblobview() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'rptblobview', TRUE);

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

	//
	// Page main
	//
	function Page_Main() {
		global $conn;
		$sSqlFrom = "`employee_personal_record`";
		$sSqlSelect = "SELECT * FROM " . $sSqlFrom;
		$sSqlWhere = "";
		$sSqlGroupBy = "";
		$sSqlHaving = "";
		$sSqlOrderBy = "`Department` ASC";

		// Get key
		$sFilter = "";
		if (@$_GET["Auto_ID"] <> "") {
			$Auto_ID = ewrpt_StripSlashes($_GET["Auto_ID"]);
			if ($sFilter <> "") $sFilter .= " AND ";
			$sFilter .= "`Auto_ID` = " . ewrpt_QuotedValue($Auto_ID, EWRPT_DATATYPE_NUMBER);
		} else {
			$this->Page_Terminate(); // Exit
			exit();
		}

		// Show thumbnail
		$bShowThumbnail = (@$_GET["showthumbnail"] == "1");
		if (@$_GET["thumbnailwidth"] == "" && @$_GET["thumbnailheight"] == "") {
			$iThumbnailWidth = EWRPT_THUMBNAIL_DEFAULT_WIDTH; // Set default width
			$iThumbnailHeight = EWRPT_THUMBNAIL_DEFAULT_HEIGHT; // Set default height
		} else {
			if (@$_GET["thumbnailwidth"] <> "") {
				$iThumbnailWidth = $_GET["thumbnailwidth"];
				if (!is_numeric($iThumbnailWidth) || $iThumbnailWidth < 0) $iThumbnailWidth = 0;
			}
			if (@$_GET["thumbnailheight"] <> "") {
				$iThumbnailHeight = $_GET["thumbnailheight"];
				if (!is_numeric($iThumbnailHeight) || $iThumbnailHeight < 0) $iThumbnailHeight = 0;
			}
		}
		if (@$_GET["quality"] <> "") {
			$quality = $_GET["quality"];
			if (!is_numeric($quality)) $quality = EWRPT_THUMBNAIL_DEFAULT_QUALITY; // Set Default
		} else {
			$quality = EWRPT_THUMBNAIL_DEFAULT_QUALITY;
		}
		$sSql = ewrpt_BuildReportSql($sSqlSelect, $sSqlWhere, $sSqlGroupBy, $sSqlHaving, $sSqlOrderBy, $sFilter, "");
		if ($rs = $conn->Execute($sSql)) {
			if (!$rs->EOF) {
				if (!EWRPT_DEBUG_ENABLED && ob_get_length())
					ob_end_clean();
				if (strpos(ewrpt_ServerVar("HTTP_USER_AGENT"), "MSIE") === FALSE)
					header("Content-type: images");
				$data = $rs->fields('Image');

				//$data = $data;
				if ($bShowThumbnail) {
					ewrpt_ResizeBinary($data, $iThumbnailWidth, $iThumbnailHeight, $quality);
				}
				if (substr($data, 0, 2) == "PK" && strpos($data, "[Content_Types].xml") > 0 &&
					strpos($data, "_rels") > 0 && strpos($data, "docProps") > 0) { // Fix Office 2007 documents
					if (substr($data, -4) <> "\0\0\0\0")
						$data .= "\0\0\0\0";
				}
				ob_clean();
				echo $data;
			}
			$rs->Close();
		}
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
}
?>
