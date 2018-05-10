<?php include_once "usersinfo.php" ?>
<?php

// Create page object
if (!isset($services_sub_grid)) $services_sub_grid = new cservices_sub_grid();

// Page init
$services_sub_grid->Page_Init();

// Page main
$services_sub_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$services_sub_grid->Page_Render();
?>
<?php if ($services_sub->Export == "") { ?>
<script type="text/javascript">

// Page object
var services_sub_grid = new ew_Page("services_sub_grid");
services_sub_grid.PageID = "grid"; // Page ID
var EW_PAGE_ID = services_sub_grid.PageID; // For backward compatibility

// Form object
var fservices_subgrid = new ew_Form("fservices_subgrid");
fservices_subgrid.FormKeyCountName = '<?php echo $services_sub_grid->FormKeyCountName ?>';

// Validate form
fservices_subgrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_details");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($services_sub->details->FldCaption()) ?>");

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
fservices_subgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "id_services", false)) return false;
	if (ew_ValueChanged(fobj, infix, "name", false)) return false;
	if (ew_ValueChanged(fobj, infix, "details", false)) return false;
	return true;
}

// Form_CustomValidate event
fservices_subgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fservices_subgrid.ValidateRequired = true;
<?php } else { ?>
fservices_subgrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
fservices_subgrid.Lists["x_id_services"] = {"LinkField":"x_id","Ajax":null,"AutoFill":false,"DisplayFields":["x_title","","",""],"ParentFields":[],"FilterFields":[],"Options":[]};

// Form object for search
</script>
<?php } ?>
<?php if ($services_sub->getCurrentMasterTable() == "" && $services_sub_grid->ExportOptions->Visible()) { ?>
<div class="ewListExportOptions"><?php $services_sub_grid->ExportOptions->Render("body") ?></div>
<?php } ?>
<?php
if ($services_sub->CurrentAction == "gridadd") {
	if ($services_sub->CurrentMode == "copy") {
		$bSelectLimit = EW_SELECT_LIMIT;
		if ($bSelectLimit) {
			$services_sub_grid->TotalRecs = $services_sub->SelectRecordCount();
			$services_sub_grid->Recordset = $services_sub_grid->LoadRecordset($services_sub_grid->StartRec-1, $services_sub_grid->DisplayRecs);
		} else {
			if ($services_sub_grid->Recordset = $services_sub_grid->LoadRecordset())
				$services_sub_grid->TotalRecs = $services_sub_grid->Recordset->RecordCount();
		}
		$services_sub_grid->StartRec = 1;
		$services_sub_grid->DisplayRecs = $services_sub_grid->TotalRecs;
	} else {
		$services_sub->CurrentFilter = "0=1";
		$services_sub_grid->StartRec = 1;
		$services_sub_grid->DisplayRecs = $services_sub->GridAddRowCount;
	}
	$services_sub_grid->TotalRecs = $services_sub_grid->DisplayRecs;
	$services_sub_grid->StopRec = $services_sub_grid->DisplayRecs;
} else {
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$services_sub_grid->TotalRecs = $services_sub->SelectRecordCount();
	} else {
		if ($services_sub_grid->Recordset = $services_sub_grid->LoadRecordset())
			$services_sub_grid->TotalRecs = $services_sub_grid->Recordset->RecordCount();
	}
	$services_sub_grid->StartRec = 1;
	$services_sub_grid->DisplayRecs = $services_sub_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$services_sub_grid->Recordset = $services_sub_grid->LoadRecordset($services_sub_grid->StartRec-1, $services_sub_grid->DisplayRecs);
}
$services_sub_grid->RenderOtherOptions();
?>
<?php $services_sub_grid->ShowPageHeader(); ?>
<?php
$services_sub_grid->ShowMessage();
?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div id="fservices_subgrid" class="ewForm form-horizontal">
<?php if ($services_sub_grid->ShowOtherOptions) { ?>
<div class="ewGridUpperPanel ewListOtherOptions">
<?php
	foreach ($services_sub_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<?php } ?>
<div id="gmp_services_sub" class="ewGridMiddlePanel">
<table id="tbl_services_subgrid" class="ewTable ewTableSeparate">
<?php echo $services_sub->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$services_sub_grid->RenderListOptions();

// Render list options (header, left)
$services_sub_grid->ListOptions->Render("header", "left");
?>
<?php if ($services_sub->id_services->Visible) { // id_services ?>
	<?php if ($services_sub->SortUrl($services_sub->id_services) == "") { ?>
		<td><div id="elh_services_sub_id_services" class="services_sub_id_services"><div class="ewTableHeaderCaption"><?php echo $services_sub->id_services->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div><div id="elh_services_sub_id_services" class="services_sub_id_services">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $services_sub->id_services->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($services_sub->id_services->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($services_sub->id_services->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($services_sub->name->Visible) { // name ?>
	<?php if ($services_sub->SortUrl($services_sub->name) == "") { ?>
		<td><div id="elh_services_sub_name" class="services_sub_name"><div class="ewTableHeaderCaption"><?php echo $services_sub->name->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div><div id="elh_services_sub_name" class="services_sub_name">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $services_sub->name->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($services_sub->name->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($services_sub->name->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($services_sub->details->Visible) { // details ?>
	<?php if ($services_sub->SortUrl($services_sub->details) == "") { ?>
		<td><div id="elh_services_sub_details" class="services_sub_details"><div class="ewTableHeaderCaption"><?php echo $services_sub->details->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div><div id="elh_services_sub_details" class="services_sub_details">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $services_sub->details->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($services_sub->details->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($services_sub->details->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$services_sub_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$services_sub_grid->StartRec = 1;
$services_sub_grid->StopRec = $services_sub_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($services_sub_grid->FormKeyCountName) && ($services_sub->CurrentAction == "gridadd" || $services_sub->CurrentAction == "gridedit" || $services_sub->CurrentAction == "F")) {
		$services_sub_grid->KeyCount = $objForm->GetValue($services_sub_grid->FormKeyCountName);
		$services_sub_grid->StopRec = $services_sub_grid->StartRec + $services_sub_grid->KeyCount - 1;
	}
}
$services_sub_grid->RecCnt = $services_sub_grid->StartRec - 1;
if ($services_sub_grid->Recordset && !$services_sub_grid->Recordset->EOF) {
	$services_sub_grid->Recordset->MoveFirst();
	if (!$bSelectLimit && $services_sub_grid->StartRec > 1)
		$services_sub_grid->Recordset->Move($services_sub_grid->StartRec - 1);
} elseif (!$services_sub->AllowAddDeleteRow && $services_sub_grid->StopRec == 0) {
	$services_sub_grid->StopRec = $services_sub->GridAddRowCount;
}

// Initialize aggregate
$services_sub->RowType = EW_ROWTYPE_AGGREGATEINIT;
$services_sub->ResetAttrs();
$services_sub_grid->RenderRow();
if ($services_sub->CurrentAction == "gridadd")
	$services_sub_grid->RowIndex = 0;
if ($services_sub->CurrentAction == "gridedit")
	$services_sub_grid->RowIndex = 0;
while ($services_sub_grid->RecCnt < $services_sub_grid->StopRec) {
	$services_sub_grid->RecCnt++;
	if (intval($services_sub_grid->RecCnt) >= intval($services_sub_grid->StartRec)) {
		$services_sub_grid->RowCnt++;
		if ($services_sub->CurrentAction == "gridadd" || $services_sub->CurrentAction == "gridedit" || $services_sub->CurrentAction == "F") {
			$services_sub_grid->RowIndex++;
			$objForm->Index = $services_sub_grid->RowIndex;
			if ($objForm->HasValue($services_sub_grid->FormActionName))
				$services_sub_grid->RowAction = strval($objForm->GetValue($services_sub_grid->FormActionName));
			elseif ($services_sub->CurrentAction == "gridadd")
				$services_sub_grid->RowAction = "insert";
			else
				$services_sub_grid->RowAction = "";
		}

		// Set up key count
		$services_sub_grid->KeyCount = $services_sub_grid->RowIndex;

		// Init row class and style
		$services_sub->ResetAttrs();
		$services_sub->CssClass = "";
		if ($services_sub->CurrentAction == "gridadd") {
			if ($services_sub->CurrentMode == "copy") {
				$services_sub_grid->LoadRowValues($services_sub_grid->Recordset); // Load row values
				$services_sub_grid->SetRecordKey($services_sub_grid->RowOldKey, $services_sub_grid->Recordset); // Set old record key
			} else {
				$services_sub_grid->LoadDefaultValues(); // Load default values
				$services_sub_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$services_sub_grid->LoadRowValues($services_sub_grid->Recordset); // Load row values
		}
		$services_sub->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($services_sub->CurrentAction == "gridadd") // Grid add
			$services_sub->RowType = EW_ROWTYPE_ADD; // Render add
		if ($services_sub->CurrentAction == "gridadd" && $services_sub->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$services_sub_grid->RestoreCurrentRowFormValues($services_sub_grid->RowIndex); // Restore form values
		if ($services_sub->CurrentAction == "gridedit") { // Grid edit
			if ($services_sub->EventCancelled) {
				$services_sub_grid->RestoreCurrentRowFormValues($services_sub_grid->RowIndex); // Restore form values
			}
			if ($services_sub_grid->RowAction == "insert")
				$services_sub->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$services_sub->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($services_sub->CurrentAction == "gridedit" && ($services_sub->RowType == EW_ROWTYPE_EDIT || $services_sub->RowType == EW_ROWTYPE_ADD) && $services_sub->EventCancelled) // Update failed
			$services_sub_grid->RestoreCurrentRowFormValues($services_sub_grid->RowIndex); // Restore form values
		if ($services_sub->RowType == EW_ROWTYPE_EDIT) // Edit row
			$services_sub_grid->EditRowCnt++;
		if ($services_sub->CurrentAction == "F") // Confirm row
			$services_sub_grid->RestoreCurrentRowFormValues($services_sub_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$services_sub->RowAttrs = array_merge($services_sub->RowAttrs, array('data-rowindex'=>$services_sub_grid->RowCnt, 'id'=>'r' . $services_sub_grid->RowCnt . '_services_sub', 'data-rowtype'=>$services_sub->RowType));

		// Render row
		$services_sub_grid->RenderRow();

		// Render list options
		$services_sub_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($services_sub_grid->RowAction <> "delete" && $services_sub_grid->RowAction <> "insertdelete" && !($services_sub_grid->RowAction == "insert" && $services_sub->CurrentAction == "F" && $services_sub_grid->EmptyRow())) {
?>
	<tr<?php echo $services_sub->RowAttributes() ?>>
<?php

// Render list options (body, left)
$services_sub_grid->ListOptions->Render("body", "left", $services_sub_grid->RowCnt);
?>
	<?php if ($services_sub->id_services->Visible) { // id_services ?>
		<td<?php echo $services_sub->id_services->CellAttributes() ?>>
<?php if ($services_sub->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($services_sub->id_services->getSessionValue() <> "") { ?>
<span<?php echo $services_sub->id_services->ViewAttributes() ?>>
<?php echo $services_sub->id_services->ListViewValue() ?></span>
<input type="hidden" id="x<?php echo $services_sub_grid->RowIndex ?>_id_services" name="x<?php echo $services_sub_grid->RowIndex ?>_id_services" value="<?php echo ew_HtmlEncode($services_sub->id_services->CurrentValue) ?>">
<?php } else { ?>
<select data-field="x_id_services" id="x<?php echo $services_sub_grid->RowIndex ?>_id_services" name="x<?php echo $services_sub_grid->RowIndex ?>_id_services"<?php echo $services_sub->id_services->EditAttributes() ?>>
<?php
if (is_array($services_sub->id_services->EditValue)) {
	$arwrk = $services_sub->id_services->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($services_sub->id_services->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $services_sub->id_services->OldValue = "";
?>
</select>
<script type="text/javascript">
fservices_subgrid.Lists["x_id_services"].Options = <?php echo (is_array($services_sub->id_services->EditValue)) ? ew_ArrayToJson($services_sub->id_services->EditValue, 1) : "[]" ?>;
</script>
<?php } ?>
<input type="hidden" data-field="x_id_services" name="o<?php echo $services_sub_grid->RowIndex ?>_id_services" id="o<?php echo $services_sub_grid->RowIndex ?>_id_services" value="<?php echo ew_HtmlEncode($services_sub->id_services->OldValue) ?>">
<?php } ?>
<?php if ($services_sub->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($services_sub->id_services->getSessionValue() <> "") { ?>
<span<?php echo $services_sub->id_services->ViewAttributes() ?>>
<?php echo $services_sub->id_services->ListViewValue() ?></span>
<input type="hidden" id="x<?php echo $services_sub_grid->RowIndex ?>_id_services" name="x<?php echo $services_sub_grid->RowIndex ?>_id_services" value="<?php echo ew_HtmlEncode($services_sub->id_services->CurrentValue) ?>">
<?php } else { ?>
<select data-field="x_id_services" id="x<?php echo $services_sub_grid->RowIndex ?>_id_services" name="x<?php echo $services_sub_grid->RowIndex ?>_id_services"<?php echo $services_sub->id_services->EditAttributes() ?>>
<?php
if (is_array($services_sub->id_services->EditValue)) {
	$arwrk = $services_sub->id_services->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($services_sub->id_services->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $services_sub->id_services->OldValue = "";
?>
</select>
<script type="text/javascript">
fservices_subgrid.Lists["x_id_services"].Options = <?php echo (is_array($services_sub->id_services->EditValue)) ? ew_ArrayToJson($services_sub->id_services->EditValue, 1) : "[]" ?>;
</script>
<?php } ?>
<?php } ?>
<?php if ($services_sub->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span<?php echo $services_sub->id_services->ViewAttributes() ?>>
<?php echo $services_sub->id_services->ListViewValue() ?></span>
<input type="hidden" data-field="x_id_services" name="x<?php echo $services_sub_grid->RowIndex ?>_id_services" id="x<?php echo $services_sub_grid->RowIndex ?>_id_services" value="<?php echo ew_HtmlEncode($services_sub->id_services->FormValue) ?>">
<input type="hidden" data-field="x_id_services" name="o<?php echo $services_sub_grid->RowIndex ?>_id_services" id="o<?php echo $services_sub_grid->RowIndex ?>_id_services" value="<?php echo ew_HtmlEncode($services_sub->id_services->OldValue) ?>">
<?php } ?>
<a id="<?php echo $services_sub_grid->PageObjName . "_row_" . $services_sub_grid->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($services_sub->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-field="x_id_sub" name="x<?php echo $services_sub_grid->RowIndex ?>_id_sub" id="x<?php echo $services_sub_grid->RowIndex ?>_id_sub" value="<?php echo ew_HtmlEncode($services_sub->id_sub->CurrentValue) ?>">
<input type="hidden" data-field="x_id_sub" name="o<?php echo $services_sub_grid->RowIndex ?>_id_sub" id="o<?php echo $services_sub_grid->RowIndex ?>_id_sub" value="<?php echo ew_HtmlEncode($services_sub->id_sub->OldValue) ?>">
<?php } ?>
<?php if ($services_sub->RowType == EW_ROWTYPE_EDIT || $services_sub->CurrentMode == "edit") { ?>
<input type="hidden" data-field="x_id_sub" name="x<?php echo $services_sub_grid->RowIndex ?>_id_sub" id="x<?php echo $services_sub_grid->RowIndex ?>_id_sub" value="<?php echo ew_HtmlEncode($services_sub->id_sub->CurrentValue) ?>">
<?php } ?>
	<?php if ($services_sub->name->Visible) { // name ?>
		<td<?php echo $services_sub->name->CellAttributes() ?>>
<?php if ($services_sub->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $services_sub_grid->RowCnt ?>_services_sub_name" class="control-group services_sub_name">
<input type="text" data-field="x_name" name="x<?php echo $services_sub_grid->RowIndex ?>_name" id="x<?php echo $services_sub_grid->RowIndex ?>_name" size="30" maxlength="255" placeholder="<?php echo $services_sub->name->PlaceHolder ?>" value="<?php echo $services_sub->name->EditValue ?>"<?php echo $services_sub->name->EditAttributes() ?>>
</span>
<input type="hidden" data-field="x_name" name="o<?php echo $services_sub_grid->RowIndex ?>_name" id="o<?php echo $services_sub_grid->RowIndex ?>_name" value="<?php echo ew_HtmlEncode($services_sub->name->OldValue) ?>">
<?php } ?>
<?php if ($services_sub->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $services_sub_grid->RowCnt ?>_services_sub_name" class="control-group services_sub_name">
<input type="text" data-field="x_name" name="x<?php echo $services_sub_grid->RowIndex ?>_name" id="x<?php echo $services_sub_grid->RowIndex ?>_name" size="30" maxlength="255" placeholder="<?php echo $services_sub->name->PlaceHolder ?>" value="<?php echo $services_sub->name->EditValue ?>"<?php echo $services_sub->name->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($services_sub->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span<?php echo $services_sub->name->ViewAttributes() ?>>
<?php echo $services_sub->name->ListViewValue() ?></span>
<input type="hidden" data-field="x_name" name="x<?php echo $services_sub_grid->RowIndex ?>_name" id="x<?php echo $services_sub_grid->RowIndex ?>_name" value="<?php echo ew_HtmlEncode($services_sub->name->FormValue) ?>">
<input type="hidden" data-field="x_name" name="o<?php echo $services_sub_grid->RowIndex ?>_name" id="o<?php echo $services_sub_grid->RowIndex ?>_name" value="<?php echo ew_HtmlEncode($services_sub->name->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($services_sub->details->Visible) { // details ?>
		<td<?php echo $services_sub->details->CellAttributes() ?>>
<?php if ($services_sub->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $services_sub_grid->RowCnt ?>_services_sub_details" class="control-group services_sub_details">
<textarea data-field="x_details" class="editor" name="x<?php echo $services_sub_grid->RowIndex ?>_details" id="x<?php echo $services_sub_grid->RowIndex ?>_details" cols="60" rows="6" placeholder="<?php echo $services_sub->details->PlaceHolder ?>"<?php echo $services_sub->details->EditAttributes() ?>><?php echo $services_sub->details->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fservices_subgrid", "x<?php echo $services_sub_grid->RowIndex ?>_details", 60, 6, <?php echo ($services_sub->details->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<input type="hidden" data-field="x_details" name="o<?php echo $services_sub_grid->RowIndex ?>_details" id="o<?php echo $services_sub_grid->RowIndex ?>_details" value="<?php echo ew_HtmlEncode($services_sub->details->OldValue) ?>">
<?php } ?>
<?php if ($services_sub->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $services_sub_grid->RowCnt ?>_services_sub_details" class="control-group services_sub_details">
<textarea data-field="x_details" class="editor" name="x<?php echo $services_sub_grid->RowIndex ?>_details" id="x<?php echo $services_sub_grid->RowIndex ?>_details" cols="60" rows="6" placeholder="<?php echo $services_sub->details->PlaceHolder ?>"<?php echo $services_sub->details->EditAttributes() ?>><?php echo $services_sub->details->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fservices_subgrid", "x<?php echo $services_sub_grid->RowIndex ?>_details", 60, 6, <?php echo ($services_sub->details->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php } ?>
<?php if ($services_sub->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span<?php echo $services_sub->details->ViewAttributes() ?>>
<?php echo $services_sub->details->ListViewValue() ?></span>
<input type="hidden" data-field="x_details" name="x<?php echo $services_sub_grid->RowIndex ?>_details" id="x<?php echo $services_sub_grid->RowIndex ?>_details" value="<?php echo ew_HtmlEncode($services_sub->details->FormValue) ?>">
<input type="hidden" data-field="x_details" name="o<?php echo $services_sub_grid->RowIndex ?>_details" id="o<?php echo $services_sub_grid->RowIndex ?>_details" value="<?php echo ew_HtmlEncode($services_sub->details->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$services_sub_grid->ListOptions->Render("body", "right", $services_sub_grid->RowCnt);
?>
	</tr>
<?php if ($services_sub->RowType == EW_ROWTYPE_ADD || $services_sub->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fservices_subgrid.UpdateOpts(<?php echo $services_sub_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($services_sub->CurrentAction <> "gridadd" || $services_sub->CurrentMode == "copy")
		if (!$services_sub_grid->Recordset->EOF) $services_sub_grid->Recordset->MoveNext();
}
?>
<?php
	if ($services_sub->CurrentMode == "add" || $services_sub->CurrentMode == "copy" || $services_sub->CurrentMode == "edit") {
		$services_sub_grid->RowIndex = '$rowindex$';
		$services_sub_grid->LoadDefaultValues();

		// Set row properties
		$services_sub->ResetAttrs();
		$services_sub->RowAttrs = array_merge($services_sub->RowAttrs, array('data-rowindex'=>$services_sub_grid->RowIndex, 'id'=>'r0_services_sub', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($services_sub->RowAttrs["class"], "ewTemplate");
		$services_sub->RowType = EW_ROWTYPE_ADD;

		// Render row
		$services_sub_grid->RenderRow();

		// Render list options
		$services_sub_grid->RenderListOptions();
		$services_sub_grid->StartRowCnt = 0;
?>
	<tr<?php echo $services_sub->RowAttributes() ?>>
<?php

// Render list options (body, left)
$services_sub_grid->ListOptions->Render("body", "left", $services_sub_grid->RowIndex);
?>
	<?php if ($services_sub->id_services->Visible) { // id_services ?>
		<td>
<?php if ($services_sub->CurrentAction <> "F") { ?>
<?php if ($services_sub->id_services->getSessionValue() <> "") { ?>
<span<?php echo $services_sub->id_services->ViewAttributes() ?>>
<?php echo $services_sub->id_services->ListViewValue() ?></span>
<input type="hidden" id="x<?php echo $services_sub_grid->RowIndex ?>_id_services" name="x<?php echo $services_sub_grid->RowIndex ?>_id_services" value="<?php echo ew_HtmlEncode($services_sub->id_services->CurrentValue) ?>">
<?php } else { ?>
<select data-field="x_id_services" id="x<?php echo $services_sub_grid->RowIndex ?>_id_services" name="x<?php echo $services_sub_grid->RowIndex ?>_id_services"<?php echo $services_sub->id_services->EditAttributes() ?>>
<?php
if (is_array($services_sub->id_services->EditValue)) {
	$arwrk = $services_sub->id_services->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($services_sub->id_services->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $services_sub->id_services->OldValue = "";
?>
</select>
<script type="text/javascript">
fservices_subgrid.Lists["x_id_services"].Options = <?php echo (is_array($services_sub->id_services->EditValue)) ? ew_ArrayToJson($services_sub->id_services->EditValue, 1) : "[]" ?>;
</script>
<?php } ?>
<?php } else { ?>
<span<?php echo $services_sub->id_services->ViewAttributes() ?>>
<?php echo $services_sub->id_services->ViewValue ?></span>
<input type="hidden" data-field="x_id_services" name="x<?php echo $services_sub_grid->RowIndex ?>_id_services" id="x<?php echo $services_sub_grid->RowIndex ?>_id_services" value="<?php echo ew_HtmlEncode($services_sub->id_services->FormValue) ?>">
<?php } ?>
<input type="hidden" data-field="x_id_services" name="o<?php echo $services_sub_grid->RowIndex ?>_id_services" id="o<?php echo $services_sub_grid->RowIndex ?>_id_services" value="<?php echo ew_HtmlEncode($services_sub->id_services->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($services_sub->name->Visible) { // name ?>
		<td>
<?php if ($services_sub->CurrentAction <> "F") { ?>
<span id="el$rowindex$_services_sub_name" class="control-group services_sub_name">
<input type="text" data-field="x_name" name="x<?php echo $services_sub_grid->RowIndex ?>_name" id="x<?php echo $services_sub_grid->RowIndex ?>_name" size="30" maxlength="255" placeholder="<?php echo $services_sub->name->PlaceHolder ?>" value="<?php echo $services_sub->name->EditValue ?>"<?php echo $services_sub->name->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_services_sub_name" class="control-group services_sub_name">
<span<?php echo $services_sub->name->ViewAttributes() ?>>
<?php echo $services_sub->name->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_name" name="x<?php echo $services_sub_grid->RowIndex ?>_name" id="x<?php echo $services_sub_grid->RowIndex ?>_name" value="<?php echo ew_HtmlEncode($services_sub->name->FormValue) ?>">
<?php } ?>
<input type="hidden" data-field="x_name" name="o<?php echo $services_sub_grid->RowIndex ?>_name" id="o<?php echo $services_sub_grid->RowIndex ?>_name" value="<?php echo ew_HtmlEncode($services_sub->name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($services_sub->details->Visible) { // details ?>
		<td>
<?php if ($services_sub->CurrentAction <> "F") { ?>
<span id="el$rowindex$_services_sub_details" class="control-group services_sub_details">
<textarea data-field="x_details" class="editor" name="x<?php echo $services_sub_grid->RowIndex ?>_details" id="x<?php echo $services_sub_grid->RowIndex ?>_details" cols="60" rows="6" placeholder="<?php echo $services_sub->details->PlaceHolder ?>"<?php echo $services_sub->details->EditAttributes() ?>><?php echo $services_sub->details->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("fservices_subgrid", "x<?php echo $services_sub_grid->RowIndex ?>_details", 60, 6, <?php echo ($services_sub->details->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_services_sub_details" class="control-group services_sub_details">
<span<?php echo $services_sub->details->ViewAttributes() ?>>
<?php echo $services_sub->details->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_details" name="x<?php echo $services_sub_grid->RowIndex ?>_details" id="x<?php echo $services_sub_grid->RowIndex ?>_details" value="<?php echo ew_HtmlEncode($services_sub->details->FormValue) ?>">
<?php } ?>
<input type="hidden" data-field="x_details" name="o<?php echo $services_sub_grid->RowIndex ?>_details" id="o<?php echo $services_sub_grid->RowIndex ?>_details" value="<?php echo ew_HtmlEncode($services_sub->details->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$services_sub_grid->ListOptions->Render("body", "right", $services_sub_grid->RowCnt);
?>
<script type="text/javascript">
fservices_subgrid.UpdateOpts(<?php echo $services_sub_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($services_sub->CurrentMode == "add" || $services_sub->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $services_sub_grid->FormKeyCountName ?>" id="<?php echo $services_sub_grid->FormKeyCountName ?>" value="<?php echo $services_sub_grid->KeyCount ?>">
<?php echo $services_sub_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($services_sub->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $services_sub_grid->FormKeyCountName ?>" id="<?php echo $services_sub_grid->FormKeyCountName ?>" value="<?php echo $services_sub_grid->KeyCount ?>">
<?php echo $services_sub_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($services_sub->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fservices_subgrid">
</div>
<?php

// Close recordset
if ($services_sub_grid->Recordset)
	$services_sub_grid->Recordset->Close();
?>
<?php if ($services_sub_grid->ShowOtherOptions) { ?>
<div class="ewGridLowerPanel ewListOtherOptions">
<?php
	foreach ($services_sub_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<?php } ?>
</div>
</td></tr></table>
<?php if ($services_sub->Export == "") { ?>
<script type="text/javascript">
fservices_subgrid.Init();
<?php if (EW_MOBILE_REFLOW && ew_IsMobile()) { ?>
ew_Reflow();
<?php } ?>
</script>
<?php } ?>
<?php
$services_sub_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$services_sub_grid->Page_Terminate();
?>
