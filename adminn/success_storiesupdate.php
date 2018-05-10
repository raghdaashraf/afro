<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg10.php" ?>
<?php include_once "ewmysql10.php" ?>
<?php include_once "phpfn10.php" ?>
<?php include_once "success_storiesinfo.php" ?>
<?php include_once "servicesinfo.php" ?>
<?php include_once "usersinfo.php" ?>
<?php include_once "userfn10.php" ?>
<?php

//
// Page class
//

$success_stories_update = NULL; // Initialize page object first

class csuccess_stories_update extends csuccess_stories {

	// Page ID
	var $PageID = 'update';

	// Project ID
	var $ProjectID = "{742A973F-A49A-4C05-916C-F0633D60D6E6}";

	// Table name
	var $TableName = 'success_stories';

	// Page object name
	var $PageObjName = 'success_stories_update';

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

		// Table object (success_stories)
		if (!isset($GLOBALS["success_stories"]) || get_class($GLOBALS["success_stories"]) == "csuccess_stories") {
			$GLOBALS["success_stories"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["success_stories"];
		}

		// Table object (services)
		if (!isset($GLOBALS['services'])) $GLOBALS['services'] = new cservices();

		// Table object (users)
		if (!isset($GLOBALS['users'])) $GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'update', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'success_stories', TRUE);

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

		// Create form object
		$objForm = new cFormObj();
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
	var $RecKeys;
	var $Disabled;
	var $Recordset;
	var $UpdateCount = 0;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError;

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Try to load keys from list form
		$this->RecKeys = $this->GetRecordKeys(); // Load record keys
		if (@$_POST["a_update"] <> "") {

			// Get action
			$this->CurrentAction = $_POST["a_update"];
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$this->CurrentAction = "I"; // Form error, reset action
				$this->setFailureMessage($gsFormError);
			}
		} else {
			$this->LoadMultiUpdateValues(); // Load initial values to form
		}
		if (count($this->RecKeys) <= 0)
			$this->Page_Terminate("success_storieslist.php"); // No records selected, return to list
		switch ($this->CurrentAction) {
			case "U": // Update
				if ($this->UpdateRows()) { // Update Records based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Set up update success message
					$this->Page_Terminate($this->getReturnUrl()); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values
				}
		}

		// Render row
		$this->RowType = EW_ROWTYPE_EDIT; // Render edit
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Load initial values to form if field values are identical in all selected records
	function LoadMultiUpdateValues() {
		$this->CurrentFilter = $this->GetKeyFilter();

		// Load recordset
		if ($this->Recordset = $this->LoadRecordset()) {
			$i = 1;
			while (!$this->Recordset->EOF) {
				if ($i == 1) {
					$this->id_services->setDbValue($this->Recordset->fields('id_services'));
					$this->scope->setDbValue($this->Recordset->fields('scope'));
					$this->customer->setDbValue($this->Recordset->fields('customer'));
					$this->date->setDbValue($this->Recordset->fields('date'));
				} else {
					if (!ew_CompareValue($this->id_services->DbValue, $this->Recordset->fields('id_services')))
						$this->id_services->CurrentValue = NULL;
					if (!ew_CompareValue($this->scope->DbValue, $this->Recordset->fields('scope')))
						$this->scope->CurrentValue = NULL;
					if (!ew_CompareValue($this->customer->DbValue, $this->Recordset->fields('customer')))
						$this->customer->CurrentValue = NULL;
					if (!ew_CompareValue($this->date->DbValue, $this->Recordset->fields('date')))
						$this->date->CurrentValue = NULL;
				}
				$i++;
				$this->Recordset->MoveNext();
			}
			$this->Recordset->Close();
		}
	}

	// Set up key value
	function SetupKeyValues($key) {
		$sKeyFld = $key;
		if (!is_numeric($sKeyFld))
			return FALSE;
		$this->id->CurrentValue = $sKeyFld;
		return TRUE;
	}

	// Update all selected rows
	function UpdateRows() {
		global $conn, $Language;
		$conn->BeginTrans();

		// Get old recordset
		$this->CurrentFilter = $this->GetKeyFilter();
		$sSql = $this->SQL();
		$rsold = $conn->Execute($sSql);

		// Update all rows
		$sKey = "";
		foreach ($this->RecKeys as $key) {
			if ($this->SetupKeyValues($key)) {
				$sThisKey = $key;
				$this->SendEmail = FALSE; // Do not send email on update success
				$this->UpdateCount += 1; // Update record count for records being updated
				$UpdateRows = $this->EditRow(); // Update this row
			} else {
				$UpdateRows = FALSE;
			}
			if (!$UpdateRows)
				break; // Update failed
			if ($sKey <> "") $sKey .= ", ";
			$sKey .= $sThisKey;
		}

		// Check if all rows updated
		if ($UpdateRows) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			$rsnew = $conn->Execute($sSql);
		} else {
			$conn->RollbackTrans(); // Rollback transaction
		}
		return $UpdateRows;
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->id_services->FldIsDetailKey) {
			$this->id_services->setFormValue($objForm->GetValue("x_id_services"));
		}
		$this->id_services->MultiUpdate = $objForm->GetValue("u_id_services");
		if (!$this->scope->FldIsDetailKey) {
			$this->scope->setFormValue($objForm->GetValue("x_scope"));
		}
		$this->scope->MultiUpdate = $objForm->GetValue("u_scope");
		if (!$this->customer->FldIsDetailKey) {
			$this->customer->setFormValue($objForm->GetValue("x_customer"));
		}
		$this->customer->MultiUpdate = $objForm->GetValue("u_customer");
		if (!$this->date->FldIsDetailKey) {
			$this->date->setFormValue($objForm->GetValue("x_date"));
		}
		$this->date->MultiUpdate = $objForm->GetValue("u_date");
		if (!$this->id->FldIsDetailKey)
			$this->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->id->CurrentValue = $this->id->FormValue;
		$this->id_services->CurrentValue = $this->id_services->FormValue;
		$this->scope->CurrentValue = $this->scope->FormValue;
		$this->customer->CurrentValue = $this->customer->FormValue;
		$this->date->CurrentValue = $this->date->FormValue;
	}

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
		$this->id_services->setDbValue($rs->fields('id_services'));
		$this->scope->setDbValue($rs->fields('scope'));
		$this->customer->setDbValue($rs->fields('customer'));
		$this->date->setDbValue($rs->fields('date'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->id_services->DbValue = $row['id_services'];
		$this->scope->DbValue = $row['scope'];
		$this->customer->DbValue = $row['customer'];
		$this->date->DbValue = $row['date'];
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
		// id_services
		// scope
		// customer
		// date

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$this->id->ViewValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// id_services
			if (strval($this->id_services->CurrentValue) <> "") {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_services->CurrentValue, EW_DATATYPE_NUMBER);
			$sSqlWrk = "SELECT `id`, `title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `services`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}

			// Call Lookup selecting
			$this->Lookup_Selecting($this->id_services, $sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->id_services->ViewValue = $rswrk->fields('DispFld');
					$rswrk->Close();
				} else {
					$this->id_services->ViewValue = $this->id_services->CurrentValue;
				}
			} else {
				$this->id_services->ViewValue = NULL;
			}
			$this->id_services->ViewCustomAttributes = "";

			// scope
			$this->scope->ViewValue = $this->scope->CurrentValue;
			$this->scope->ViewCustomAttributes = "";

			// customer
			$this->customer->ViewValue = $this->customer->CurrentValue;
			$this->customer->ViewCustomAttributes = "";

			// date
			$this->date->ViewValue = $this->date->CurrentValue;
			$this->date->ViewCustomAttributes = "";

			// id_services
			$this->id_services->LinkCustomAttributes = "";
			$this->id_services->HrefValue = "";
			$this->id_services->TooltipValue = "";

			// scope
			$this->scope->LinkCustomAttributes = "";
			$this->scope->HrefValue = "";
			$this->scope->TooltipValue = "";

			// customer
			$this->customer->LinkCustomAttributes = "";
			$this->customer->HrefValue = "";
			$this->customer->TooltipValue = "";

			// date
			$this->date->LinkCustomAttributes = "";
			$this->date->HrefValue = "";
			$this->date->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id_services
			$this->id_services->EditCustomAttributes = "";
			if ($this->id_services->getSessionValue() <> "") {
				$this->id_services->CurrentValue = $this->id_services->getSessionValue();
			if (strval($this->id_services->CurrentValue) <> "") {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_services->CurrentValue, EW_DATATYPE_NUMBER);
			$sSqlWrk = "SELECT `id`, `title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `services`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}

			// Call Lookup selecting
			$this->Lookup_Selecting($this->id_services, $sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->id_services->ViewValue = $rswrk->fields('DispFld');
					$rswrk->Close();
				} else {
					$this->id_services->ViewValue = $this->id_services->CurrentValue;
				}
			} else {
				$this->id_services->ViewValue = NULL;
			}
			$this->id_services->ViewCustomAttributes = "";
			} else {
			$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `services`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}

			// Call Lookup selecting
			$this->Lookup_Selecting($this->id_services, $sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), "", "", "", "", "", "", ""));
			$this->id_services->EditValue = $arwrk;
			}

			// scope
			$this->scope->EditCustomAttributes = "";
			$this->scope->EditValue = $this->scope->CurrentValue;
			$this->scope->PlaceHolder = ew_RemoveHtml($this->scope->FldCaption());

			// customer
			$this->customer->EditCustomAttributes = "";
			$this->customer->EditValue = ew_HtmlEncode($this->customer->CurrentValue);
			$this->customer->PlaceHolder = ew_RemoveHtml($this->customer->FldCaption());

			// date
			$this->date->EditCustomAttributes = "";
			$this->date->EditValue = ew_HtmlEncode($this->date->CurrentValue);
			$this->date->PlaceHolder = ew_RemoveHtml($this->date->FldCaption());

			// Edit refer script
			// id_services

			$this->id_services->HrefValue = "";

			// scope
			$this->scope->HrefValue = "";

			// customer
			$this->customer->HrefValue = "";

			// date
			$this->date->HrefValue = "";
		}
		if ($this->RowType == EW_ROWTYPE_ADD ||
			$this->RowType == EW_ROWTYPE_EDIT ||
			$this->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$this->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError;

		// Initialize form error message
		$gsFormError = "";
		$lUpdateCnt = 0;
		if ($this->id_services->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->scope->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->customer->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->date->MultiUpdate == "1") $lUpdateCnt++;
		if ($lUpdateCnt == 0) {
			$gsFormError = $Language->Phrase("NoFieldSelected");
			return FALSE;
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($this->id_services->MultiUpdate <> "" && !$this->id_services->FldIsDetailKey && !is_null($this->id_services->FormValue) && $this->id_services->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->id_services->FldCaption());
		}
		if ($this->scope->MultiUpdate <> "" && !$this->scope->FldIsDetailKey && !is_null($this->scope->FormValue) && $this->scope->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->scope->FldCaption());
		}
		if ($this->customer->MultiUpdate <> "" && !$this->customer->FldIsDetailKey && !is_null($this->customer->FormValue) && $this->customer->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->customer->FldCaption());
		}
		if ($this->date->MultiUpdate <> "" && !$this->date->FldIsDetailKey && !is_null($this->date->FormValue) && $this->date->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->date->FldCaption());
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language;
		$sFilter = $this->KeyFilter();
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->LoadDbValues($rsold);
			$rsnew = array();

			// id_services
			$this->id_services->SetDbValueDef($rsnew, $this->id_services->CurrentValue, 0, $this->id_services->ReadOnly || $this->id_services->MultiUpdate <> "1");

			// scope
			$this->scope->SetDbValueDef($rsnew, $this->scope->CurrentValue, "", $this->scope->ReadOnly || $this->scope->MultiUpdate <> "1");

			// customer
			$this->customer->SetDbValueDef($rsnew, $this->customer->CurrentValue, "", $this->customer->ReadOnly || $this->customer->MultiUpdate <> "1");

			// date
			$this->date->SetDbValueDef($rsnew, $this->date->CurrentValue, "", $this->date->ReadOnly || $this->date->MultiUpdate <> "1");

			// Check referential integrity for master table 'services'
			$bValidMasterRecord = TRUE;
			$sMasterFilter = $this->SqlMasterFilter_services();
			$KeyValue = isset($rsnew['id_services']) ? $rsnew['id_services'] : $rsold['id_services'];
			if (strval($KeyValue) <> "") {
				$sMasterFilter = str_replace("@id@", ew_AdjustSql($KeyValue), $sMasterFilter);
			} else {
				$bValidMasterRecord = FALSE;
			}
			if ($bValidMasterRecord) {
				$rsmaster = $GLOBALS["services"]->LoadRs($sMasterFilter);
				$bValidMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->Close();
			}
			if (!$bValidMasterRecord) {
				$sRelatedRecordMsg = str_replace("%t", "services", $Language->Phrase("RelatedRecordRequired"));
				$this->setFailureMessage($sRelatedRecordMsg);
				$rs->Close();
				return FALSE;
			}

			// Call Row Updating event
			$bUpdateRow = $this->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $this->Update($rsnew, "", $rsold);
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
				if ($EditRow) {
				}
			} else {
				if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage <> "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$Breadcrumb->Add("list", $this->TableVar, "success_storieslist.php", $this->TableVar, TRUE);
		$PageId = "update";
		$Breadcrumb->Add("update", $PageId, ew_CurrentUrl());
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($success_stories_update)) $success_stories_update = new csuccess_stories_update();

// Page init
$success_stories_update->Page_Init();

// Page main
$success_stories_update->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$success_stories_update->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Page object
var success_stories_update = new ew_Page("success_stories_update");
success_stories_update.PageID = "update"; // Page ID
var EW_PAGE_ID = success_stories_update.PageID; // For backward compatibility

// Form object
var fsuccess_storiesupdate = new ew_Form("fsuccess_storiesupdate");

// Validate form
fsuccess_storiesupdate.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	this.PostAutoSuggest();
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	if (!ew_UpdateSelected(fobj)) {
		alert(ewLanguage.Phrase("NoFieldSelected"));
		return false;
	}
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
			elm = this.GetElements("x" + infix + "_id_services");
			uelm = this.GetElements("u" + infix + "_id_services");
			if (uelm && uelm.checked) {
				if (elm && !ew_HasValue(elm))
					return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($success_stories->id_services->FldCaption()) ?>");
			}
			elm = this.GetElements("x" + infix + "_scope");
			uelm = this.GetElements("u" + infix + "_scope");
			if (uelm && uelm.checked) {
				if (elm && !ew_HasValue(elm))
					return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($success_stories->scope->FldCaption()) ?>");
			}
			elm = this.GetElements("x" + infix + "_customer");
			uelm = this.GetElements("u" + infix + "_customer");
			if (uelm && uelm.checked) {
				if (elm && !ew_HasValue(elm))
					return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($success_stories->customer->FldCaption()) ?>");
			}
			elm = this.GetElements("x" + infix + "_date");
			uelm = this.GetElements("u" + infix + "_date");
			if (uelm && uelm.checked) {
				if (elm && !ew_HasValue(elm))
					return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($success_stories->date->FldCaption()) ?>");
			}

			// Set up row object
			ew_ElementsToRow(fobj);

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
fsuccess_storiesupdate.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fsuccess_storiesupdate.ValidateRequired = true;
<?php } else { ?>
fsuccess_storiesupdate.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
fsuccess_storiesupdate.Lists["x_id_services"] = {"LinkField":"x_id","Ajax":null,"AutoFill":false,"DisplayFields":["x_title","","",""],"ParentFields":[],"FilterFields":[],"Options":[]};

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $Breadcrumb->Render(); ?>
<?php $success_stories_update->ShowPageHeader(); ?>
<?php
$success_stories_update->ShowMessage();
?>
<form name="fsuccess_storiesupdate" id="fsuccess_storiesupdate" class="ewForm form-inline" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" value="success_stories">
<input type="hidden" name="a_update" id="a_update" value="U">
<?php foreach ($success_stories_update->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td>
<table id="tbl_success_storiesupdate" class="table table-bordered table-striped">
<thead>
	<tr>
		<th><label class="checkbox"><strong><?php echo $Language->Phrase("UpdateValue") ?></strong><input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);"></label></th>
		<th><?php echo $Language->Phrase("FieldName") ?></th>
		<th><?php echo $Language->Phrase("NewValue") ?></th>
	</tr>
</thead>
<tbody>
<?php if ($success_stories->id_services->Visible) { // id_services ?>
	<tr id="r_id_services">
		<td class="ewCheckbox"<?php echo $success_stories->id_services->CellAttributes() ?>>
<label class="checkbox"><input type="checkbox" name="u_id_services" id="u_id_services" value="1"<?php echo ($success_stories->id_services->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>></label>
</td>
		<td<?php echo $success_stories->id_services->CellAttributes() ?>><span id="elh_success_stories_id_services"><?php echo $success_stories->id_services->FldCaption() ?></span></td>
		<td<?php echo $success_stories->id_services->CellAttributes() ?>>
<?php if ($success_stories->id_services->getSessionValue() <> "") { ?>
<span<?php echo $success_stories->id_services->ViewAttributes() ?>>
<?php echo $success_stories->id_services->ViewValue ?></span>
<input type="hidden" id="x_id_services" name="x_id_services" value="<?php echo ew_HtmlEncode($success_stories->id_services->CurrentValue) ?>">
<?php } else { ?>
<select data-field="x_id_services" id="x_id_services" name="x_id_services"<?php echo $success_stories->id_services->EditAttributes() ?>>
<?php
if (is_array($success_stories->id_services->EditValue)) {
	$arwrk = $success_stories->id_services->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($success_stories->id_services->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
<script type="text/javascript">
fsuccess_storiesupdate.Lists["x_id_services"].Options = <?php echo (is_array($success_stories->id_services->EditValue)) ? ew_ArrayToJson($success_stories->id_services->EditValue, 1) : "[]" ?>;
</script>
<?php } ?>
<?php echo $success_stories->id_services->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($success_stories->scope->Visible) { // scope ?>
	<tr id="r_scope">
		<td class="ewCheckbox"<?php echo $success_stories->scope->CellAttributes() ?>>
<label class="checkbox"><input type="checkbox" name="u_scope" id="u_scope" value="1"<?php echo ($success_stories->scope->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>></label>
</td>
		<td<?php echo $success_stories->scope->CellAttributes() ?>><span id="elh_success_stories_scope"><?php echo $success_stories->scope->FldCaption() ?></span></td>
		<td<?php echo $success_stories->scope->CellAttributes() ?>>
<span id="el_success_stories_scope" class="control-group">
<textarea data-field="x_scope" class="editor" name="x_scope" id="x_scope" cols="60" rows="6" placeholder="<?php echo ew_HtmlEncode($success_stories->scope->PlaceHolder) ?>"<?php echo $success_stories->scope->EditAttributes() ?>><?php echo $success_stories->scope->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fsuccess_storiesupdate", "x_scope", 60, 6, <?php echo ($success_stories->scope->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php echo $success_stories->scope->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($success_stories->customer->Visible) { // customer ?>
	<tr id="r_customer">
		<td class="ewCheckbox"<?php echo $success_stories->customer->CellAttributes() ?>>
<label class="checkbox"><input type="checkbox" name="u_customer" id="u_customer" value="1"<?php echo ($success_stories->customer->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>></label>
</td>
		<td<?php echo $success_stories->customer->CellAttributes() ?>><span id="elh_success_stories_customer"><?php echo $success_stories->customer->FldCaption() ?></span></td>
		<td<?php echo $success_stories->customer->CellAttributes() ?>>
<span id="el_success_stories_customer" class="control-group">
<input type="text" data-field="x_customer" name="x_customer" id="x_customer" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($success_stories->customer->PlaceHolder) ?>" value="<?php echo $success_stories->customer->EditValue ?>"<?php echo $success_stories->customer->EditAttributes() ?>>
</span>
<?php echo $success_stories->customer->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($success_stories->date->Visible) { // date ?>
	<tr id="r_date">
		<td class="ewCheckbox"<?php echo $success_stories->date->CellAttributes() ?>>
<label class="checkbox"><input type="checkbox" name="u_date" id="u_date" value="1"<?php echo ($success_stories->date->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>></label>
</td>
		<td<?php echo $success_stories->date->CellAttributes() ?>><span id="elh_success_stories_date"><?php echo $success_stories->date->FldCaption() ?></span></td>
		<td<?php echo $success_stories->date->CellAttributes() ?>>
<span id="el_success_stories_date" class="control-group">
<input type="text" data-field="x_date" name="x_date" id="x_date" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($success_stories->date->PlaceHolder) ?>" value="<?php echo $success_stories->date->EditValue ?>"<?php echo $success_stories->date->EditAttributes() ?>>
</span>
<?php echo $success_stories->date->CustomMsg ?></td>
	</tr>
<?php } ?>
</tbody>
</table>
</td></tr></table>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("UpdateBtn") ?></button>
</form>
<script type="text/javascript">
fsuccess_storiesupdate.Init();
<?php if (EW_MOBILE_REFLOW && ew_IsMobile()) { ?>
ew_Reflow();
<?php } ?>
</script>
<?php
$success_stories_update->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$success_stories_update->Page_Terminate();
?>
