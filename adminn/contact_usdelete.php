<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg10.php" ?>
<?php include_once "ewmysql10.php" ?>
<?php include_once "phpfn10.php" ?>
<?php include_once "contact_usinfo.php" ?>
<?php include_once "usersinfo.php" ?>
<?php include_once "userfn10.php" ?>
<?php

//
// Page class
//

$contact_us_delete = NULL; // Initialize page object first

class ccontact_us_delete extends ccontact_us {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = "{742A973F-A49A-4C05-916C-F0633D60D6E6}";

	// Table name
	var $TableName = 'contact_us';

	// Page object name
	var $PageObjName = 'contact_us_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		if ($this->UseTokenInUrl) $PageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	function getWarningMessage() {
		return @$_SESSION[EW_SESSION_WARNING_MESSAGE];
	}

	function setWarningMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_WARNING_MESSAGE], $v);
	}

	// Show message
	function ShowMessage() {
		$hidden = TRUE;
		$html = "";

		// Message
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sMessage;
			$html .= "<div class=\"alert alert-success ewSuccess\">" . $sMessage . "</div>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$sWarningMessage = $this->getWarningMessage();
		$this->Message_Showing($sWarningMessage, "warning");
		if ($sWarningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sWarningMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sWarningMessage;
			$html .= "<div class=\"alert alert-warning ewWarning\">" . $sWarningMessage . "</div>";
			$_SESSION[EW_SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sSuccessMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sSuccessMessage;
			$html .= "<div class=\"alert alert-success ewSuccess\">" . $sSuccessMessage . "</div>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sErrorMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sErrorMessage;
			$html .= "<div class=\"alert alert-error ewError\">" . $sErrorMessage . "</div>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo "<table class=\"ewStdTable\"><tr><td><div class=\"ewMessageDialog\"" . (($hidden) ? " style=\"display: none;\"" : "") . ">" . $html . "</div></td></tr></table>";
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p>" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Footer exists, display
			echo "<p>" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm;
		if ($this->UseTokenInUrl) {
			if ($objForm)
				return ($this->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($this->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function __construct() {
		global $conn, $Language;
		$GLOBALS["Page"] = &$this;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Parent constuctor
		parent::__construct();

		// Table object (contact_us)
		if (!isset($GLOBALS["contact_us"]) || get_class($GLOBALS["contact_us"]) == "ccontact_us") {
			$GLOBALS["contact_us"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["contact_us"];
		}

		// Table object (users)
		if (!isset($GLOBALS['users'])) $GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'contact_us', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action

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

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();
		$this->Page_Redirecting($url);

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}
	var $TotalRecs = 0;
	var $RecCnt;
	var $RecKeys = array();
	var $Recordset;
	var $StartRowCnt = 1;
	var $RowCnt = 0;

	//
	// Page main
	//
	function Page_Main() {
		global $Language;

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Load key parameters
		$this->RecKeys = $this->GetRecordKeys(); // Load record keys
		$sFilter = $this->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("contact_uslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in contact_us class, contact_usinfo.php

		$this->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$this->CurrentAction = $_POST["a_delete"];
		} else {
			$this->CurrentAction = "I"; // Display record
		}
		switch ($this->CurrentAction) {
			case "D": // Delete
				$this->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // Delete rows
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($this->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn;

		// Call Recordset Selecting event
		$this->Recordset_Selecting($this->CurrentFilter);

		// Load List page SQL
		$sSql = $this->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $Language;
		$sFilter = $this->KeyFilter();

		// Call Row Selecting event
		$this->Row_Selecting($sFilter);

		// Load SQL based on filter
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row = &$rs->fields;
		$this->Row_Selected($row);
		$this->id->setDbValue($rs->fields('id'));
		$this->country->setDbValue($rs->fields('country'));
		$this->address->setDbValue($rs->fields('address'));
		$this->first_phone->setDbValue($rs->fields('first_phone'));
		$this->first_email->setDbValue($rs->fields('first_email'));
		$this->second_email->setDbValue($rs->fields('second_email'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->country->DbValue = $row['country'];
		$this->address->DbValue = $row['address'];
		$this->first_phone->DbValue = $row['first_phone'];
		$this->first_email->DbValue = $row['first_email'];
		$this->second_email->DbValue = $row['second_email'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language;
		global $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// country
		// address
		// first_phone
		// first_email
		// second_email

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$this->id->ViewValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// country
			$this->country->ViewValue = $this->country->CurrentValue;
			$this->country->ViewCustomAttributes = "";

			// address
			$this->address->ViewValue = $this->address->CurrentValue;
			$this->address->ViewCustomAttributes = "";

			// first_phone
			$this->first_phone->ViewValue = $this->first_phone->CurrentValue;
			$this->first_phone->ViewCustomAttributes = "";

			// first_email
			$this->first_email->ViewValue = $this->first_email->CurrentValue;
			$this->first_email->ViewCustomAttributes = "";

			// second_email
			$this->second_email->ViewValue = $this->second_email->CurrentValue;
			$this->second_email->ViewCustomAttributes = "";

			// country
			$this->country->LinkCustomAttributes = "";
			$this->country->HrefValue = "";
			$this->country->TooltipValue = "";

			// address
			$this->address->LinkCustomAttributes = "";
			$this->address->HrefValue = "";
			$this->address->TooltipValue = "";

			// first_phone
			$this->first_phone->LinkCustomAttributes = "";
			$this->first_phone->HrefValue = "";
			$this->first_phone->TooltipValue = "";

			// first_email
			$this->first_email->LinkCustomAttributes = "";
			$this->first_email->HrefValue = "";
			$this->first_email->TooltipValue = "";

			// second_email
			$this->second_email->LinkCustomAttributes = "";
			$this->second_email->HrefValue = "";
			$this->second_email->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security;
		$DeleteRows = TRUE;
		$sSql = $this->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;

		//} else {
		//	$this->LoadRowValues($rs); // Load row values

		}
		$conn->BeginTrans();

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $this->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
				$sThisKey .= $row['id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $this->Delete($row); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$Breadcrumb->Add("list", $this->TableVar, "contact_uslist.php", $this->TableVar, TRUE);
		$PageId = "delete";
		$Breadcrumb->Add("delete", $PageId, ew_CurrentUrl());
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
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
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($contact_us_delete)) $contact_us_delete = new ccontact_us_delete();

// Page init
$contact_us_delete->Page_Init();

// Page main
$contact_us_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contact_us_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Page object
var contact_us_delete = new ew_Page("contact_us_delete");
contact_us_delete.PageID = "delete"; // Page ID
var EW_PAGE_ID = contact_us_delete.PageID; // For backward compatibility

// Form object
var fcontact_usdelete = new ew_Form("fcontact_usdelete");

// Form_CustomValidate event
fcontact_usdelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fcontact_usdelete.ValidateRequired = true;
<?php } else { ?>
fcontact_usdelete.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php

// Load records for display
if ($contact_us_delete->Recordset = $contact_us_delete->LoadRecordset())
	$contact_us_deleteTotalRecs = $contact_us_delete->Recordset->RecordCount(); // Get record count
if ($contact_us_deleteTotalRecs <= 0) { // No record found, exit
	if ($contact_us_delete->Recordset)
		$contact_us_delete->Recordset->Close();
	$contact_us_delete->Page_Terminate("contact_uslist.php"); // Return to list
}
?>
<?php $Breadcrumb->Render(); ?>
<?php $contact_us_delete->ShowPageHeader(); ?>
<?php
$contact_us_delete->ShowMessage();
?>
<form name="fcontact_usdelete" id="fcontact_usdelete" class="ewForm form-inline" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" value="contact_us">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($contact_us_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table id="tbl_contact_usdelete" class="ewTable ewTableSeparate">
<?php echo $contact_us->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
<?php if ($contact_us->country->Visible) { // country ?>
		<td><span id="elh_contact_us_country" class="contact_us_country"><?php echo $contact_us->country->FldCaption() ?></span></td>
<?php } ?>
<?php if ($contact_us->address->Visible) { // address ?>
		<td><span id="elh_contact_us_address" class="contact_us_address"><?php echo $contact_us->address->FldCaption() ?></span></td>
<?php } ?>
<?php if ($contact_us->first_phone->Visible) { // first_phone ?>
		<td><span id="elh_contact_us_first_phone" class="contact_us_first_phone"><?php echo $contact_us->first_phone->FldCaption() ?></span></td>
<?php } ?>
<?php if ($contact_us->first_email->Visible) { // first_email ?>
		<td><span id="elh_contact_us_first_email" class="contact_us_first_email"><?php echo $contact_us->first_email->FldCaption() ?></span></td>
<?php } ?>
<?php if ($contact_us->second_email->Visible) { // second_email ?>
		<td><span id="elh_contact_us_second_email" class="contact_us_second_email"><?php echo $contact_us->second_email->FldCaption() ?></span></td>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$contact_us_delete->RecCnt = 0;
$i = 0;
while (!$contact_us_delete->Recordset->EOF) {
	$contact_us_delete->RecCnt++;
	$contact_us_delete->RowCnt++;

	// Set row properties
	$contact_us->ResetAttrs();
	$contact_us->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$contact_us_delete->LoadRowValues($contact_us_delete->Recordset);

	// Render row
	$contact_us_delete->RenderRow();
?>
	<tr<?php echo $contact_us->RowAttributes() ?>>
<?php if ($contact_us->country->Visible) { // country ?>
		<td<?php echo $contact_us->country->CellAttributes() ?>>
<span id="el<?php echo $contact_us_delete->RowCnt ?>_contact_us_country" class="control-group contact_us_country">
<span<?php echo $contact_us->country->ViewAttributes() ?>>
<?php echo $contact_us->country->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contact_us->address->Visible) { // address ?>
		<td<?php echo $contact_us->address->CellAttributes() ?>>
<span id="el<?php echo $contact_us_delete->RowCnt ?>_contact_us_address" class="control-group contact_us_address">
<span<?php echo $contact_us->address->ViewAttributes() ?>>
<?php echo $contact_us->address->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contact_us->first_phone->Visible) { // first_phone ?>
		<td<?php echo $contact_us->first_phone->CellAttributes() ?>>
<span id="el<?php echo $contact_us_delete->RowCnt ?>_contact_us_first_phone" class="control-group contact_us_first_phone">
<span<?php echo $contact_us->first_phone->ViewAttributes() ?>>
<?php echo $contact_us->first_phone->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contact_us->first_email->Visible) { // first_email ?>
		<td<?php echo $contact_us->first_email->CellAttributes() ?>>
<span id="el<?php echo $contact_us_delete->RowCnt ?>_contact_us_first_email" class="control-group contact_us_first_email">
<span<?php echo $contact_us->first_email->ViewAttributes() ?>>
<?php echo $contact_us->first_email->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contact_us->second_email->Visible) { // second_email ?>
		<td<?php echo $contact_us->second_email->CellAttributes() ?>>
<span id="el<?php echo $contact_us_delete->RowCnt ?>_contact_us_second_email" class="control-group contact_us_second_email">
<span<?php echo $contact_us->second_email->ViewAttributes() ?>>
<?php echo $contact_us->second_email->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$contact_us_delete->Recordset->MoveNext();
}
$contact_us_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<div class="btn-group ewButtonGroup">
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
</div>
</form>
<script type="text/javascript">
fcontact_usdelete.Init();
</script>
<?php
$contact_us_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$contact_us_delete->Page_Terminate();
?>
