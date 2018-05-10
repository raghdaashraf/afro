<?php include_once "usersinfo.php" ?>
<?php

// Create page object
if (!isset($success_stories_grid)) $success_stories_grid = new csuccess_stories_grid();

// Page init
$success_stories_grid->Page_Init();

// Page main
$success_stories_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$success_stories_grid->Page_Render();
?>
<?php if ($success_stories->Export == "") { ?>
<script type="text/javascript">

// Page object
var success_stories_grid = new ew_Page("success_stories_grid");
success_stories_grid.PageID = "grid"; // Page ID
var EW_PAGE_ID = success_stories_grid.PageID; // For backward compatibility

// Form object
var fsuccess_storiesgrid = new ew_Form("fsuccess_storiesgrid");
fsuccess_storiesgrid.FormKeyCountName = '<?php echo $success_stories_grid->FormKeyCountName ?>';

// Validate form
fsuccess_storiesgrid.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	this.PostAutoSuggest();
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		var checkrow = (gridinsert) ? !this.EmptyRow(infix) : true;
		if (checkrow) {
			addcnt++;
			elm = this.GetElements("x" + infix + "_id_services");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($success_stories->id_services->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_scope");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($success_stories->scope->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_customer");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($success_stories->customer->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_date");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($success_stories->date->FldCaption()) ?>");

			// Set up row object
			ew_ElementsToRow(fobj);

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fsuccess_storiesgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "id_services", false)) return false;
	if (ew_ValueChanged(fobj, infix, "scope", false)) return false;
	if (ew_ValueChanged(fobj, infix, "customer", false)) return false;
	if (ew_ValueChanged(fobj, infix, "date", false)) return false;
	return true;
}

// Form_CustomValidate event
fsuccess_storiesgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fsuccess_storiesgrid.ValidateRequired = true;
<?php } else { ?>
fsuccess_storiesgrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
fsuccess_storiesgrid.Lists["x_id_services"] = {"LinkField":"x_id","Ajax":null,"AutoFill":false,"DisplayFields":["x_title","","",""],"ParentFields":[],"FilterFields":[],"Options":[]};

// Form object for search
</script>
<?php } ?>
<?php if ($success_stories->getCurrentMasterTable() == "" && $success_stories_grid->ExportOptions->Visible()) { ?>
<div class="ewListExportOptions"><?php $success_stories_grid->ExportOptions->Render("body") ?></div>
<?php } ?>
<?php
if ($success_stories->CurrentAction == "gridadd") {
	if ($success_stories->CurrentMode == "copy") {
		$bSelectLimit = EW_SELECT_LIMIT;
		if ($bSelectLimit) {
			$success_stories_grid->TotalRecs = $success_stories->SelectRecordCount();
			$success_stories_grid->Recordset = $success_stories_grid->LoadRecordset($success_stories_grid->StartRec-1, $success_stories_grid->DisplayRecs);
		} else {
			if ($success_stories_grid->Recordset = $success_stories_grid->LoadRecordset())
				$success_stories_grid->TotalRecs = $success_stories_grid->Recordset->RecordCount();
		}
		$success_stories_grid->StartRec = 1;
		$success_stories_grid->DisplayRecs = $success_stories_grid->TotalRecs;
	} else {
		$success_stories->CurrentFilter = "0=1";
		$success_stories_grid->StartRec = 1;
		$success_stories_grid->DisplayRecs = $success_stories->GridAddRowCount;
	}
	$success_stories_grid->TotalRecs = $success_stories_grid->DisplayRecs;
	$success_stories_grid->StopRec = $success_stories_grid->DisplayRecs;
} else {
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$success_stories_grid->TotalRecs = $success_stories->SelectRecordCount();
	} else {
		if ($success_stories_grid->Recordset = $success_stories_grid->LoadRecordset())
			$success_stories_grid->TotalRecs = $success_stories_grid->Recordset->RecordCount();
	}
	$success_stories_grid->StartRec = 1;
	$success_stories_grid->DisplayRecs = $success_stories_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$success_stories_grid->Recordset = $success_stories_grid->LoadRecordset($success_stories_grid->StartRec-1, $success_stories_grid->DisplayRecs);
}
$success_stories_grid->RenderOtherOptions();
?>
<?php $success_stories_grid->ShowPageHeader(); ?>
<?php
$success_stories_grid->ShowMessage();
?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div id="fsuccess_storiesgrid" class="ewForm form-inline">
<?php if ($success_stories_grid->ShowOtherOptions) { ?>
<div class="ewGridUpperPanel ewListOtherOptions">
<?php
	foreach ($success_stories_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<?php } ?>
<div id="gmp_success_stories" class="ewGridMiddlePanel">
<table id="tbl_success_storiesgrid" class="ewTable ewTableSeparate">
<?php echo $success_stories->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$success_stories_grid->RenderListOptions();

// Render list options (header, left)
$success_stories_grid->ListOptions->Render("header", "left");
?>
<?php if ($success_stories->id_services->Visible) { // id_services ?>
	<?php if ($success_stories->SortUrl($success_stories->id_services) == "") { ?>
		<td><div id="elh_success_stories_id_services" class="success_stories_id_services"><div class="ewTableHeaderCaption"><?php echo $success_stories->id_services->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div><div id="elh_success_stories_id_services" class="success_stories_id_services">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $success_stories->id_services->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($success_stories->id_services->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($success_stories->id_services->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($success_stories->scope->Visible) { // scope ?>
	<?php if ($success_stories->SortUrl($success_stories->scope) == "") { ?>
		<td><div id="elh_success_stories_scope" class="success_stories_scope"><div class="ewTableHeaderCaption"><?php echo $success_stories->scope->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div><div id="elh_success_stories_scope" class="success_stories_scope">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $success_stories->scope->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($success_stories->scope->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($success_stories->scope->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($success_stories->customer->Visible) { // customer ?>
	<?php if ($success_stories->SortUrl($success_stories->customer) == "") { ?>
		<td><div id="elh_success_stories_customer" class="success_stories_customer"><div class="ewTableHeaderCaption"><?php echo $success_stories->customer->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div><div id="elh_success_stories_customer" class="success_stories_customer">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $success_stories->customer->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($success_stories->customer->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($success_stories->customer->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($success_stories->date->Visible) { // date ?>
	<?php if ($success_stories->SortUrl($success_stories->date) == "") { ?>
		<td><div id="elh_success_stories_date" class="success_stories_date"><div class="ewTableHeaderCaption"><?php echo $success_stories->date->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div><div id="elh_success_stories_date" class="success_stories_date">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $success_stories->date->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($success_stories->date->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($success_stories->date->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$success_stories_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$success_stories_grid->StartRec = 1;
$success_stories_grid->StopRec = $success_stories_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($success_stories_grid->FormKeyCountName) && ($success_stories->CurrentAction == "gridadd" || $success_stories->CurrentAction == "gridedit" || $success_stories->CurrentAction == "F")) {
		$success_stories_grid->KeyCount = $objForm->GetValue($success_stories_grid->FormKeyCountName);
		$success_stories_grid->StopRec = $success_stories_grid->StartRec + $success_stories_grid->KeyCount - 1;
	}
}
$success_stories_grid->RecCnt = $success_stories_grid->StartRec - 1;
if ($success_stories_grid->Recordset && !$success_stories_grid->Recordset->EOF) {
	$success_stories_grid->Recordset->MoveFirst();
	if (!$bSelectLimit && $success_stories_grid->StartRec > 1)
		$success_stories_grid->Recordset->Move($success_stories_grid->StartRec - 1);
} elseif (!$success_stories->AllowAddDeleteRow && $success_stories_grid->StopRec == 0) {
	$success_stories_grid->StopRec = $success_stories->GridAddRowCount;
}

// Initialize aggregate
$success_stories->RowType = EW_ROWTYPE_AGGREGATEINIT;
$success_stories->ResetAttrs();
$success_stories_grid->RenderRow();
if ($success_stories->CurrentAction == "gridadd")
	$success_stories_grid->RowIndex = 0;
if ($success_stories->CurrentAction == "gridedit")
	$success_stories_grid->RowIndex = 0;
while ($success_stories_grid->RecCnt < $success_stories_grid->StopRec) {
	$success_stories_grid->RecCnt++;
	if (intval($success_stories_grid->RecCnt) >= intval($success_stories_grid->StartRec)) {
		$success_stories_grid->RowCnt++;
		if ($success_stories->CurrentAction == "gridadd" || $success_stories->CurrentAction == "gridedit" || $success_stories->CurrentAction == "F") {
			$success_stories_grid->RowIndex++;
			$objForm->Index = $success_stories_grid->RowIndex;
			if ($objForm->HasValue($success_stories_grid->FormActionName))
				$success_stories_grid->RowAction = strval($objForm->GetValue($success_stories_grid->FormActionName));
			elseif ($success_stories->CurrentAction == "gridadd")
				$success_stories_grid->RowAction = "insert";
			else
				$success_stories_grid->RowAction = "";
		}

		// Set up key count
		$success_stories_grid->KeyCount = $success_stories_grid->RowIndex;

		// Init row class and style
		$success_stories->ResetAttrs();
		$success_stories->CssClass = "";
		if ($success_stories->CurrentAction == "gridadd") {
			if ($success_stories->CurrentMode == "copy") {
				$success_stories_grid->LoadRowValues($success_stories_grid->Recordset); // Load row values
				$success_stories_grid->SetRecordKey($success_stories_grid->RowOldKey, $success_stories_grid->Recordset); // Set old record key
			} else {
				$success_stories_grid->LoadDefaultValues(); // Load default values
				$success_stories_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$success_stories_grid->LoadRowValues($success_stories_grid->Recordset); // Load row values
		}
		$success_stories->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($success_stories->CurrentAction == "gridadd") // Grid add
			$success_stories->RowType = EW_ROWTYPE_ADD; // Render add
		if ($success_stories->CurrentAction == "gridadd" && $success_stories->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$success_stories_grid->RestoreCurrentRowFormValues($success_stories_grid->RowIndex); // Restore form values
		if ($success_stories->CurrentAction == "gridedit") { // Grid edit
			if ($success_stories->EventCancelled) {
				$success_stories_grid->RestoreCurrentRowFormValues($success_stories_grid->RowIndex); // Restore form values
			}
			if ($success_stories_grid->RowAction == "insert")
				$success_stories->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$success_stories->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($success_stories->CurrentAction == "gridedit" && ($success_stories->RowType == EW_ROWTYPE_EDIT || $success_stories->RowType == EW_ROWTYPE_ADD) && $success_stories->EventCancelled) // Update failed
			$success_stories_grid->RestoreCurrentRowFormValues($success_stories_grid->RowIndex); // Restore form values
		if ($success_stories->RowType == EW_ROWTYPE_EDIT) // Edit row
			$success_stories_grid->EditRowCnt++;
		if ($success_stories->CurrentAction == "F") // Confirm row
			$success_stories_grid->RestoreCurrentRowFormValues($success_stories_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$success_stories->RowAttrs = array_merge($success_stories->RowAttrs, array('data-rowindex'=>$success_stories_grid->RowCnt, 'id'=>'r' . $success_stories_grid->RowCnt . '_success_stories', 'data-rowtype'=>$success_stories->RowType));

		// Render row
		$success_stories_grid->RenderRow();

		// Render list options
		$success_stories_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($success_stories_grid->RowAction <> "delete" && $success_stories_grid->RowAction <> "insertdelete" && !($success_stories_grid->RowAction == "insert" && $success_stories->CurrentAction == "F" && $success_stories_grid->EmptyRow())) {
?>
	<tr<?php echo $success_stories->RowAttributes() ?>>
<?php

// Render list options (body, left)
$success_stories_grid->ListOptions->Render("body", "left", $success_stories_grid->RowCnt);
?>
	<?php if ($success_stories->id_services->Visible) { // id_services ?>
		<td<?php echo $success_stories->id_services->CellAttributes() ?>>
<?php if ($success_stories->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($success_stories->id_services->getSessionValue() <> "") { ?>
<span<?php echo $success_stories->id_services->ViewAttributes() ?>>
<?php echo $success_stories->id_services->ListViewValue() ?></span>
<input type="hidden" id="x<?php echo $success_stories_grid->RowIndex ?>_id_services" name="x<?php echo $success_stories_grid->RowIndex ?>_id_services" value="<?php echo ew_HtmlEncode($success_stories->id_services->CurrentValue) ?>">
<?php } else { ?>
<select data-field="x_id_services" id="x<?php echo $success_stories_grid->RowIndex ?>_id_services" name="x<?php echo $success_stories_grid->RowIndex ?>_id_services"<?php echo $success_stories->id_services->EditAttributes() ?>>
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
if (@$emptywrk) $success_stories->id_services->OldValue = "";
?>
</select>
<script type="text/javascript">
fsuccess_storiesgrid.Lists["x_id_services"].Options = <?php echo (is_array($success_stories->id_services->EditValue)) ? ew_ArrayToJson($success_stories->id_services->EditValue, 1) : "[]" ?>;
</script>
<?php } ?>
<input type="hidden" data-field="x_id_services" name="o<?php echo $success_stories_grid->RowIndex ?>_id_services" id="o<?php echo $success_stories_grid->RowIndex ?>_id_services" value="<?php echo ew_HtmlEncode($success_stories->id_services->OldValue) ?>">
<?php } ?>
<?php if ($success_stories->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($success_stories->id_services->getSessionValue() <> "") { ?>
<span<?php echo $success_stories->id_services->ViewAttributes() ?>>
<?php echo $success_stories->id_services->ListViewValue() ?></span>
<input type="hidden" id="x<?php echo $success_stories_grid->RowIndex ?>_id_services" name="x<?php echo $success_stories_grid->RowIndex ?>_id_services" value="<?php echo ew_HtmlEncode($success_stories->id_services->CurrentValue) ?>">
<?php } else { ?>
<select data-field="x_id_services" id="x<?php echo $success_stories_grid->RowIndex ?>_id_services" name="x<?php echo $success_stories_grid->RowIndex ?>_id_services"<?php echo $success_stories->id_services->EditAttributes() ?>>
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
if (@$emptywrk) $success_stories->id_services->OldValue = "";
?>
</select>
<script type="text/javascript">
fsuccess_storiesgrid.Lists["x_id_services"].Options = <?php echo (is_array($success_stories->id_services->EditValue)) ? ew_ArrayToJson($success_stories->id_services->EditValue, 1) : "[]" ?>;
</script>
<?php } ?>
<?php } ?>
<?php if ($success_stories->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span<?php echo $success_stories->id_services->ViewAttributes() ?>>
<?php echo $success_stories->id_services->ListViewValue() ?></span>
<input type="hidden" data-field="x_id_services" name="x<?php echo $success_stories_grid->RowIndex ?>_id_services" id="x<?php echo $success_stories_grid->RowIndex ?>_id_services" value="<?php echo ew_HtmlEncode($success_stories->id_services->FormValue) ?>">
<input type="hidden" data-field="x_id_services" name="o<?php echo $success_stories_grid->RowIndex ?>_id_services" id="o<?php echo $success_stories_grid->RowIndex ?>_id_services" value="<?php echo ew_HtmlEncode($success_stories->id_services->OldValue) ?>">
<?php } ?>
<a id="<?php echo $success_stories_grid->PageObjName . "_row_" . $success_stories_grid->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($success_stories->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-field="x_id" name="x<?php echo $success_stories_grid->RowIndex ?>_id" id="x<?php echo $success_stories_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($success_stories->id->CurrentValue) ?>">
<input type="hidden" data-field="x_id" name="o<?php echo $success_stories_grid->RowIndex ?>_id" id="o<?php echo $success_stories_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($success_stories->id->OldValue) ?>">
<?php } ?>
<?php if ($success_stories->RowType == EW_ROWTYPE_EDIT || $success_stories->CurrentMode == "edit") { ?>
<input type="hidden" data-field="x_id" name="x<?php echo $success_stories_grid->RowIndex ?>_id" id="x<?php echo $success_stories_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($success_stories->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($success_stories->scope->Visible) { // scope ?>
		<td<?php echo $success_stories->scope->CellAttributes() ?>>
<?php if ($success_stories->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $success_stories_grid->RowCnt ?>_success_stories_scope" class="control-group success_stories_scope">
<textarea data-field="x_scope" class="editor" name="x<?php echo $success_stories_grid->RowIndex ?>_scope" id="x<?php echo $success_stories_grid->RowIndex ?>_scope" cols="60" rows="6" placeholder="<?php echo ew_HtmlEncode($success_stories->scope->PlaceHolder) ?>"<?php echo $success_stories->scope->EditAttributes() ?>><?php echo $success_stories->scope->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fsuccess_storiesgrid", "x<?php echo $success_stories_grid->RowIndex ?>_scope", 60, 6, <?php echo ($success_stories->scope->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<input type="hidden" data-field="x_scope" name="o<?php echo $success_stories_grid->RowIndex ?>_scope" id="o<?php echo $success_stories_grid->RowIndex ?>_scope" value="<?php echo ew_HtmlEncode($success_stories->scope->OldValue) ?>">
<?php } ?>
<?php if ($success_stories->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $success_stories_grid->RowCnt ?>_success_stories_scope" class="control-group success_stories_scope">
<textarea data-field="x_scope" class="editor" name="x<?php echo $success_stories_grid->RowIndex ?>_scope" id="x<?php echo $success_stories_grid->RowIndex ?>_scope" cols="60" rows="6" placeholder="<?php echo ew_HtmlEncode($success_stories->scope->PlaceHolder) ?>"<?php echo $success_stories->scope->EditAttributes() ?>><?php echo $success_stories->scope->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fsuccess_storiesgrid", "x<?php echo $success_stories_grid->RowIndex ?>_scope", 60, 6, <?php echo ($success_stories->scope->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php } ?>
<?php if ($success_stories->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span<?php echo $success_stories->scope->ViewAttributes() ?>>
<?php echo $success_stories->scope->ListViewValue() ?></span>
<input type="hidden" data-field="x_scope" name="x<?php echo $success_stories_grid->RowIndex ?>_scope" id="x<?php echo $success_stories_grid->RowIndex ?>_scope" value="<?php echo ew_HtmlEncode($success_stories->scope->FormValue) ?>">
<input type="hidden" data-field="x_scope" name="o<?php echo $success_stories_grid->RowIndex ?>_scope" id="o<?php echo $success_stories_grid->RowIndex ?>_scope" value="<?php echo ew_HtmlEncode($success_stories->scope->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($success_stories->customer->Visible) { // customer ?>
		<td<?php echo $success_stories->customer->CellAttributes() ?>>
<?php if ($success_stories->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $success_stories_grid->RowCnt ?>_success_stories_customer" class="control-group success_stories_customer">
<input type="text" data-field="x_customer" name="x<?php echo $success_stories_grid->RowIndex ?>_customer" id="x<?php echo $success_stories_grid->RowIndex ?>_customer" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($success_stories->customer->PlaceHolder) ?>" value="<?php echo $success_stories->customer->EditValue ?>"<?php echo $success_stories->customer->EditAttributes() ?>>
</span>
<input type="hidden" data-field="x_customer" name="o<?php echo $success_stories_grid->RowIndex ?>_customer" id="o<?php echo $success_stories_grid->RowIndex ?>_customer" value="<?php echo ew_HtmlEncode($success_stories->customer->OldValue) ?>">
<?php } ?>
<?php if ($success_stories->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $success_stories_grid->RowCnt ?>_success_stories_customer" class="control-group success_stories_customer">
<input type="text" data-field="x_customer" name="x<?php echo $success_stories_grid->RowIndex ?>_customer" id="x<?php echo $success_stories_grid->RowIndex ?>_customer" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($success_stories->customer->PlaceHolder) ?>" value="<?php echo $success_stories->customer->EditValue ?>"<?php echo $success_stories->customer->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($success_stories->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span<?php echo $success_stories->customer->ViewAttributes() ?>>
<?php echo $success_stories->customer->ListViewValue() ?></span>
<input type="hidden" data-field="x_customer" name="x<?php echo $success_stories_grid->RowIndex ?>_customer" id="x<?php echo $success_stories_grid->RowIndex ?>_customer" value="<?php echo ew_HtmlEncode($success_stories->customer->FormValue) ?>">
<input type="hidden" data-field="x_customer" name="o<?php echo $success_stories_grid->RowIndex ?>_customer" id="o<?php echo $success_stories_grid->RowIndex ?>_customer" value="<?php echo ew_HtmlEncode($success_stories->customer->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($success_stories->date->Visible) { // date ?>
		<td<?php echo $success_stories->date->CellAttributes() ?>>
<?php if ($success_stories->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $success_stories_grid->RowCnt ?>_success_stories_date" class="control-group success_stories_date">
<input type="text" data-field="x_date" name="x<?php echo $success_stories_grid->RowIndex ?>_date" id="x<?php echo $success_stories_grid->RowIndex ?>_date" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($success_stories->date->PlaceHolder) ?>" value="<?php echo $success_stories->date->EditValue ?>"<?php echo $success_stories->date->EditAttributes() ?>>
</span>
<input type="hidden" data-field="x_date" name="o<?php echo $success_stories_grid->RowIndex ?>_date" id="o<?php echo $success_stories_grid->RowIndex ?>_date" value="<?php echo ew_HtmlEncode($success_stories->date->OldValue) ?>">
<?php } ?>
<?php if ($success_stories->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $success_stories_grid->RowCnt ?>_success_stories_date" class="control-group success_stories_date">
<input type="text" data-field="x_date" name="x<?php echo $success_stories_grid->RowIndex ?>_date" id="x<?php echo $success_stories_grid->RowIndex ?>_date" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($success_stories->date->PlaceHolder) ?>" value="<?php echo $success_stories->date->EditValue ?>"<?php echo $success_stories->date->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($success_stories->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span<?php echo $success_stories->date->ViewAttributes() ?>>
<?php echo $success_stories->date->ListViewValue() ?></span>
<input type="hidden" data-field="x_date" name="x<?php echo $success_stories_grid->RowIndex ?>_date" id="x<?php echo $success_stories_grid->RowIndex ?>_date" value="<?php echo ew_HtmlEncode($success_stories->date->FormValue) ?>">
<input type="hidden" data-field="x_date" name="o<?php echo $success_stories_grid->RowIndex ?>_date" id="o<?php echo $success_stories_grid->RowIndex ?>_date" value="<?php echo ew_HtmlEncode($success_stories->date->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$success_stories_grid->ListOptions->Render("body", "right", $success_stories_grid->RowCnt);
?>
	</tr>
<?php if ($success_stories->RowType == EW_ROWTYPE_ADD || $success_stories->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fsuccess_storiesgrid.UpdateOpts(<?php echo $success_stories_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($success_stories->CurrentAction <> "gridadd" || $success_stories->CurrentMode == "copy")
		if (!$success_stories_grid->Recordset->EOF) $success_stories_grid->Recordset->MoveNext();
}
?>
<?php
	if ($success_stories->CurrentMode == "add" || $success_stories->CurrentMode == "copy" || $success_stories->CurrentMode == "edit") {
		$success_stories_grid->RowIndex = '$rowindex$';
		$success_stories_grid->LoadDefaultValues();

		// Set row properties
		$success_stories->ResetAttrs();
		$success_stories->RowAttrs = array_merge($success_stories->RowAttrs, array('data-rowindex'=>$success_stories_grid->RowIndex, 'id'=>'r0_success_stories', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($success_stories->RowAttrs["class"], "ewTemplate");
		$success_stories->RowType = EW_ROWTYPE_ADD;

		// Render row
		$success_stories_grid->RenderRow();

		// Render list options
		$success_stories_grid->RenderListOptions();
		$success_stories_grid->StartRowCnt = 0;
?>
	<tr<?php echo $success_stories->RowAttributes() ?>>
<?php

// Render list options (body, left)
$success_stories_grid->ListOptions->Render("body", "left", $success_stories_grid->RowIndex);
?>
	<?php if ($success_stories->id_services->Visible) { // id_services ?>
		<td>
<?php if ($success_stories->CurrentAction <> "F") { ?>
<?php if ($success_stories->id_services->getSessionValue() <> "") { ?>
<span<?php echo $success_stories->id_services->ViewAttributes() ?>>
<?php echo $success_stories->id_services->ListViewValue() ?></span>
<input type="hidden" id="x<?php echo $success_stories_grid->RowIndex ?>_id_services" name="x<?php echo $success_stories_grid->RowIndex ?>_id_services" value="<?php echo ew_HtmlEncode($success_stories->id_services->CurrentValue) ?>">
<?php } else { ?>
<select data-field="x_id_services" id="x<?php echo $success_stories_grid->RowIndex ?>_id_services" name="x<?php echo $success_stories_grid->RowIndex ?>_id_services"<?php echo $success_stories->id_services->EditAttributes() ?>>
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
if (@$emptywrk) $success_stories->id_services->OldValue = "";
?>
</select>
<script type="text/javascript">
fsuccess_storiesgrid.Lists["x_id_services"].Options = <?php echo (is_array($success_stories->id_services->EditValue)) ? ew_ArrayToJson($success_stories->id_services->EditValue, 1) : "[]" ?>;
</script>
<?php } ?>
<?php } else { ?>
<span<?php echo $success_stories->id_services->ViewAttributes() ?>>
<?php echo $success_stories->id_services->ViewValue ?></span>
<input type="hidden" data-field="x_id_services" name="x<?php echo $success_stories_grid->RowIndex ?>_id_services" id="x<?php echo $success_stories_grid->RowIndex ?>_id_services" value="<?php echo ew_HtmlEncode($success_stories->id_services->FormValue) ?>">
<?php } ?>
<input type="hidden" data-field="x_id_services" name="o<?php echo $success_stories_grid->RowIndex ?>_id_services" id="o<?php echo $success_stories_grid->RowIndex ?>_id_services" value="<?php echo ew_HtmlEncode($success_stories->id_services->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($success_stories->scope->Visible) { // scope ?>
		<td>
<?php if ($success_stories->CurrentAction <> "F") { ?>
<span id="el$rowindex$_success_stories_scope" class="control-group success_stories_scope">
<textarea data-field="x_scope" class="editor" name="x<?php echo $success_stories_grid->RowIndex ?>_scope" id="x<?php echo $success_stories_grid->RowIndex ?>_scope" cols="60" rows="6" placeholder="<?php echo ew_HtmlEncode($success_stories->scope->PlaceHolder) ?>"<?php echo $success_stories->scope->EditAttributes() ?>><?php echo $success_stories->scope->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fsuccess_storiesgrid", "x<?php echo $success_stories_grid->RowIndex ?>_scope", 60, 6, <?php echo ($success_stories->scope->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_success_stories_scope" class="control-group success_stories_scope">
<span<?php echo $success_stories->scope->ViewAttributes() ?>>
<?php echo $success_stories->scope->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_scope" name="x<?php echo $success_stories_grid->RowIndex ?>_scope" id="x<?php echo $success_stories_grid->RowIndex ?>_scope" value="<?php echo ew_HtmlEncode($success_stories->scope->FormValue) ?>">
<?php } ?>
<input type="hidden" data-field="x_scope" name="o<?php echo $success_stories_grid->RowIndex ?>_scope" id="o<?php echo $success_stories_grid->RowIndex ?>_scope" value="<?php echo ew_HtmlEncode($success_stories->scope->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($success_stories->customer->Visible) { // customer ?>
		<td>
<?php if ($success_stories->CurrentAction <> "F") { ?>
<span id="el$rowindex$_success_stories_customer" class="control-group success_stories_customer">
<input type="text" data-field="x_customer" name="x<?php echo $success_stories_grid->RowIndex ?>_customer" id="x<?php echo $success_stories_grid->RowIndex ?>_customer" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($success_stories->customer->PlaceHolder) ?>" value="<?php echo $success_stories->customer->EditValue ?>"<?php echo $success_stories->customer->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_success_stories_customer" class="control-group success_stories_customer">
<span<?php echo $success_stories->customer->ViewAttributes() ?>>
<?php echo $success_stories->customer->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_customer" name="x<?php echo $success_stories_grid->RowIndex ?>_customer" id="x<?php echo $success_stories_grid->RowIndex ?>_customer" value="<?php echo ew_HtmlEncode($success_stories->customer->FormValue) ?>">
<?php } ?>
<input type="hidden" data-field="x_customer" name="o<?php echo $success_stories_grid->RowIndex ?>_customer" id="o<?php echo $success_stories_grid->RowIndex ?>_customer" value="<?php echo ew_HtmlEncode($success_stories->customer->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($success_stories->date->Visible) { // date ?>
		<td>
<?php if ($success_stories->CurrentAction <> "F") { ?>
<span id="el$rowindex$_success_stories_date" class="control-group success_stories_date">
<input type="text" data-field="x_date" name="x<?php echo $success_stories_grid->RowIndex ?>_date" id="x<?php echo $success_stories_grid->RowIndex ?>_date" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($success_stories->date->PlaceHolder) ?>" value="<?php echo $success_stories->date->EditValue ?>"<?php echo $success_stories->date->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_success_stories_date" class="control-group success_stories_date">
<span<?php echo $success_stories->date->ViewAttributes() ?>>
<?php echo $success_stories->date->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_date" name="x<?php echo $success_stories_grid->RowIndex ?>_date" id="x<?php echo $success_stories_grid->RowIndex ?>_date" value="<?php echo ew_HtmlEncode($success_stories->date->FormValue) ?>">
<?php } ?>
<input type="hidden" data-field="x_date" name="o<?php echo $success_stories_grid->RowIndex ?>_date" id="o<?php echo $success_stories_grid->RowIndex ?>_date" value="<?php echo ew_HtmlEncode($success_stories->date->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$success_stories_grid->ListOptions->Render("body", "right", $success_stories_grid->RowCnt);
?>
<script type="text/javascript">
fsuccess_storiesgrid.UpdateOpts(<?php echo $success_stories_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($success_stories->CurrentMode == "add" || $success_stories->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $success_stories_grid->FormKeyCountName ?>" id="<?php echo $success_stories_grid->FormKeyCountName ?>" value="<?php echo $success_stories_grid->KeyCount ?>">
<?php echo $success_stories_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($success_stories->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $success_stories_grid->FormKeyCountName ?>" id="<?php echo $success_stories_grid->FormKeyCountName ?>" value="<?php echo $success_stories_grid->KeyCount ?>">
<?php echo $success_stories_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($success_stories->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fsuccess_storiesgrid">
</div>
<?php

// Close recordset
if ($success_stories_grid->Recordset)
	$success_stories_grid->Recordset->Close();
?>
<?php if ($success_stories_grid->ShowOtherOptions) { ?>
<div class="ewGridLowerPanel ewListOtherOptions">
<?php
	foreach ($success_stories_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<?php } ?>
</div>
</td></tr></table>
<?php if ($success_stories->Export == "") { ?>
<script type="text/javascript">
fsuccess_storiesgrid.Init();
<?php if (EW_MOBILE_REFLOW && ew_IsMobile()) { ?>
ew_Reflow();
<?php } ?>
</script>
<?php } ?>
<?php
$success_stories_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$success_stories_grid->Page_Terminate();
?>
