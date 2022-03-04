<?php

namespace PHPMaker2022\growit_2021;

// Page object
$PlantListList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { PlantList: currentTable } });
var currentForm, currentPageID;
var fPlantListlist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fPlantListlist = new ew.Form("fPlantListlist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fPlantListlist;
    fPlantListlist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fPlantListlist");
});
var fPlantListsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fPlantListsrch = new ew.Form("fPlantListsrch", "list");
    currentSearchForm = fPlantListsrch;

    // Dynamic selection lists

    // Filters
    fPlantListsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fPlantListsrch");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
<?php } ?>
</div>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !$Page->CurrentAction && $Page->hasSearchFields()) { ?>
<form name="fPlantListsrch" id="fPlantListsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fPlantListsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="PlantList">
<div class="ew-extended-search container-fluid">
<div class="row mb-0">
    <div class="col-sm-auto px-0 pe-sm-2">
        <div class="ew-basic-search input-group">
            <input type="search" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control ew-basic-search-keyword" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>" aria-label="<?= HtmlEncode($Language->phrase("Search")) ?>">
            <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" class="ew-basic-search-type" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
            <button type="button" data-bs-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false">
                <span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fPlantListsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fPlantListsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fPlantListsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fPlantListsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
            </div>
        </div>
    </div>
    <div class="col-sm-auto mb-3">
        <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
    </div>
</div>
</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> PlantList">
<form name="fPlantListlist" id="fPlantListlist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="PlantList">
<div id="gmp_PlantList" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_PlantListlist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->id->Visible) { // id ?>
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_PlantList_id" class="PlantList_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
        <th data-name="user_id" class="<?= $Page->user_id->headerCellClass() ?>"><div id="elh_PlantList_user_id" class="PlantList_user_id"><?= $Page->renderFieldHeader($Page->user_id) ?></div></th>
<?php } ?>
<?php if ($Page->crop_id->Visible) { // crop_id ?>
        <th data-name="crop_id" class="<?= $Page->crop_id->headerCellClass() ?>"><div id="elh_PlantList_crop_id" class="PlantList_crop_id"><?= $Page->renderFieldHeader($Page->crop_id) ?></div></th>
<?php } ?>
<?php if ($Page->variety->Visible) { // variety ?>
        <th data-name="variety" class="<?= $Page->variety->headerCellClass() ?>"><div id="elh_PlantList_variety" class="PlantList_variety"><?= $Page->renderFieldHeader($Page->variety) ?></div></th>
<?php } ?>
<?php if ($Page->crop_type->Visible) { // crop_type ?>
        <th data-name="crop_type" class="<?= $Page->crop_type->headerCellClass() ?>"><div id="elh_PlantList_crop_type" class="PlantList_crop_type"><?= $Page->renderFieldHeader($Page->crop_type) ?></div></th>
<?php } ?>
<?php if ($Page->job_type->Visible) { // job_type ?>
        <th data-name="job_type" class="<?= $Page->job_type->headerCellClass() ?>"><div id="elh_PlantList_job_type" class="PlantList_job_type"><?= $Page->renderFieldHeader($Page->job_type) ?></div></th>
<?php } ?>
<?php if ($Page->_title->Visible) { // title ?>
        <th data-name="_title" class="<?= $Page->_title->headerCellClass() ?>"><div id="elh_PlantList__title" class="PlantList__title"><?= $Page->renderFieldHeader($Page->_title) ?></div></th>
<?php } ?>
<?php if ($Page->job_date->Visible) { // job_date ?>
        <th data-name="job_date" class="<?= $Page->job_date->headerCellClass() ?>"><div id="elh_PlantList_job_date" class="PlantList_job_date"><?= $Page->renderFieldHeader($Page->job_date) ?></div></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Page->status->headerCellClass() ?>"><div id="elh_PlantList_status" class="PlantList_status"><?= $Page->renderFieldHeader($Page->status) ?></div></th>
<?php } ?>
<?php if ($Page->stage_one_completed->Visible) { // stage_one_completed ?>
        <th data-name="stage_one_completed" class="<?= $Page->stage_one_completed->headerCellClass() ?>"><div id="elh_PlantList_stage_one_completed" class="PlantList_stage_one_completed"><?= $Page->renderFieldHeader($Page->stage_one_completed) ?></div></th>
<?php } ?>
<?php if ($Page->stage_two_completed->Visible) { // stage_two_completed ?>
        <th data-name="stage_two_completed" class="<?= $Page->stage_two_completed->headerCellClass() ?>"><div id="elh_PlantList_stage_two_completed" class="PlantList_stage_two_completed"><?= $Page->renderFieldHeader($Page->stage_two_completed) ?></div></th>
<?php } ?>
<?php if ($Page->sow_date->Visible) { // sow_date ?>
        <th data-name="sow_date" class="<?= $Page->sow_date->headerCellClass() ?>"><div id="elh_PlantList_sow_date" class="PlantList_sow_date"><?= $Page->renderFieldHeader($Page->sow_date) ?></div></th>
<?php } ?>
<?php if ($Page->stage_three_completed->Visible) { // stage_three_completed ?>
        <th data-name="stage_three_completed" class="<?= $Page->stage_three_completed->headerCellClass() ?>"><div id="elh_PlantList_stage_three_completed" class="PlantList_stage_three_completed"><?= $Page->renderFieldHeader($Page->stage_three_completed) ?></div></th>
<?php } ?>
<?php if ($Page->plant_date->Visible) { // plant_date ?>
        <th data-name="plant_date" class="<?= $Page->plant_date->headerCellClass() ?>"><div id="elh_PlantList_plant_date" class="PlantList_plant_date"><?= $Page->renderFieldHeader($Page->plant_date) ?></div></th>
<?php } ?>
<?php if ($Page->harvest_start_date->Visible) { // harvest_start_date ?>
        <th data-name="harvest_start_date" class="<?= $Page->harvest_start_date->headerCellClass() ?>"><div id="elh_PlantList_harvest_start_date" class="PlantList_harvest_start_date"><?= $Page->renderFieldHeader($Page->harvest_start_date) ?></div></th>
<?php } ?>
<?php if ($Page->harvest_end_date->Visible) { // harvest_end_date ?>
        <th data-name="harvest_end_date" class="<?= $Page->harvest_end_date->headerCellClass() ?>"><div id="elh_PlantList_harvest_end_date" class="PlantList_harvest_end_date"><?= $Page->renderFieldHeader($Page->harvest_end_date) ?></div></th>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
        <th data-name="updated_at" class="<?= $Page->updated_at->headerCellClass() ?>"><div id="elh_PlantList_updated_at" class="PlantList_updated_at"><?= $Page->renderFieldHeader($Page->updated_at) ?></div></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th data-name="created_at" class="<?= $Page->created_at->headerCellClass() ?>"><div id="elh_PlantList_created_at" class="PlantList_created_at"><?= $Page->renderFieldHeader($Page->created_at) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
if ($Page->ExportAll && $Page->isExport()) {
    $Page->StopRecord = $Page->TotalRecords;
} else {
    // Set the last record to display
    if ($Page->TotalRecords > $Page->StartRecord + $Page->DisplayRecords - 1) {
        $Page->StopRecord = $Page->StartRecord + $Page->DisplayRecords - 1;
    } else {
        $Page->StopRecord = $Page->TotalRecords;
    }
}
$Page->RecordCount = $Page->StartRecord - 1;
if ($Page->Recordset && !$Page->Recordset->EOF) {
    // Nothing to do
} elseif ($Page->isGridAdd() && !$Page->AllowAddDeleteRow && $Page->StopRecord == 0) {
    $Page->StopRecord = $Page->GridAddRowCount;
}

// Initialize aggregate
$Page->RowType = ROWTYPE_AGGREGATEINIT;
$Page->resetAttributes();
$Page->renderRow();
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->RowCount++;

        // Set up key count
        $Page->KeyCount = $Page->RowIndex;

        // Init row class and style
        $Page->resetAttributes();
        $Page->CssClass = "";
        if ($Page->isGridAdd()) {
            $Page->loadRowValues(); // Load default values
            $Page->OldKey = "";
            $Page->setKey($Page->OldKey);
        } else {
            $Page->loadRowValues($Page->Recordset); // Load row values
            if ($Page->isGridEdit()) {
                $Page->OldKey = $Page->getKey(true); // Get from CurrentValue
                $Page->setKey($Page->OldKey);
            }
        }
        $Page->RowType = ROWTYPE_VIEW; // Render view

        // Set up row attributes
        $Page->RowAttrs->merge([
            "data-rowindex" => $Page->RowCount,
            "id" => "r" . $Page->RowCount . "_PlantList",
            "data-rowtype" => $Page->RowType,
            "class" => ($Page->RowCount % 2 != 1) ? "ew-table-alt-row" : "",
        ]);
        if ($Page->isAdd() && $Page->RowType == ROWTYPE_ADD || $Page->isEdit() && $Page->RowType == ROWTYPE_EDIT) { // Inline-Add/Edit row
            $Page->RowAttrs->appendClass("table-active");
        }

        // Render row
        $Page->renderRow();

        // Render list options
        $Page->renderListOptions();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->id->Visible) { // id ?>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PlantList_id" class="el_PlantList_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->user_id->Visible) { // user_id ?>
        <td data-name="user_id"<?= $Page->user_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PlantList_user_id" class="el_PlantList_user_id">
<span<?= $Page->user_id->viewAttributes() ?>>
<?= $Page->user_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->crop_id->Visible) { // crop_id ?>
        <td data-name="crop_id"<?= $Page->crop_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PlantList_crop_id" class="el_PlantList_crop_id">
<span<?= $Page->crop_id->viewAttributes() ?>>
<?= $Page->crop_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->variety->Visible) { // variety ?>
        <td data-name="variety"<?= $Page->variety->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PlantList_variety" class="el_PlantList_variety">
<span<?= $Page->variety->viewAttributes() ?>>
<?= $Page->variety->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->crop_type->Visible) { // crop_type ?>
        <td data-name="crop_type"<?= $Page->crop_type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PlantList_crop_type" class="el_PlantList_crop_type">
<span<?= $Page->crop_type->viewAttributes() ?>>
<?= $Page->crop_type->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->job_type->Visible) { // job_type ?>
        <td data-name="job_type"<?= $Page->job_type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PlantList_job_type" class="el_PlantList_job_type">
<span<?= $Page->job_type->viewAttributes() ?>>
<?= $Page->job_type->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->_title->Visible) { // title ?>
        <td data-name="_title"<?= $Page->_title->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PlantList__title" class="el_PlantList__title">
<span<?= $Page->_title->viewAttributes() ?>>
<?= $Page->_title->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->job_date->Visible) { // job_date ?>
        <td data-name="job_date"<?= $Page->job_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PlantList_job_date" class="el_PlantList_job_date">
<span<?= $Page->job_date->viewAttributes() ?>>
<?= $Page->job_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PlantList_status" class="el_PlantList_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->stage_one_completed->Visible) { // stage_one_completed ?>
        <td data-name="stage_one_completed"<?= $Page->stage_one_completed->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PlantList_stage_one_completed" class="el_PlantList_stage_one_completed">
<span<?= $Page->stage_one_completed->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_stage_one_completed_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->stage_one_completed->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->stage_one_completed->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_stage_one_completed_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->stage_two_completed->Visible) { // stage_two_completed ?>
        <td data-name="stage_two_completed"<?= $Page->stage_two_completed->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PlantList_stage_two_completed" class="el_PlantList_stage_two_completed">
<span<?= $Page->stage_two_completed->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_stage_two_completed_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->stage_two_completed->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->stage_two_completed->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_stage_two_completed_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sow_date->Visible) { // sow_date ?>
        <td data-name="sow_date"<?= $Page->sow_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PlantList_sow_date" class="el_PlantList_sow_date">
<span<?= $Page->sow_date->viewAttributes() ?>>
<?= $Page->sow_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->stage_three_completed->Visible) { // stage_three_completed ?>
        <td data-name="stage_three_completed"<?= $Page->stage_three_completed->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PlantList_stage_three_completed" class="el_PlantList_stage_three_completed">
<span<?= $Page->stage_three_completed->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_stage_three_completed_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->stage_three_completed->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->stage_three_completed->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_stage_three_completed_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->plant_date->Visible) { // plant_date ?>
        <td data-name="plant_date"<?= $Page->plant_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PlantList_plant_date" class="el_PlantList_plant_date">
<span<?= $Page->plant_date->viewAttributes() ?>>
<?= $Page->plant_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->harvest_start_date->Visible) { // harvest_start_date ?>
        <td data-name="harvest_start_date"<?= $Page->harvest_start_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PlantList_harvest_start_date" class="el_PlantList_harvest_start_date">
<span<?= $Page->harvest_start_date->viewAttributes() ?>>
<?= $Page->harvest_start_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->harvest_end_date->Visible) { // harvest_end_date ?>
        <td data-name="harvest_end_date"<?= $Page->harvest_end_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PlantList_harvest_end_date" class="el_PlantList_harvest_end_date">
<span<?= $Page->harvest_end_date->viewAttributes() ?>>
<?= $Page->harvest_end_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->updated_at->Visible) { // updated_at ?>
        <td data-name="updated_at"<?= $Page->updated_at->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PlantList_updated_at" class="el_PlantList_updated_at">
<span<?= $Page->updated_at->viewAttributes() ?>>
<?= $Page->updated_at->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->created_at->Visible) { // created_at ?>
        <td data-name="created_at"<?= $Page->created_at->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PlantList_created_at" class="el_PlantList_created_at">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
<?php if (!$Page->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("PlantList");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
