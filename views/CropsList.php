<?php

namespace PHPMaker2022\growit_2021;

// Page object
$CropsList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { crops: currentTable } });
var currentForm, currentPageID;
var fcropslist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcropslist = new ew.Form("fcropslist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fcropslist;
    fcropslist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fcropslist");
});
var fcropssrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fcropssrch = new ew.Form("fcropssrch", "list");
    currentSearchForm = fcropssrch;

    // Dynamic selection lists

    // Filters
    fcropssrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fcropssrch");
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
<form name="fcropssrch" id="fcropssrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fcropssrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="crops">
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fcropssrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fcropssrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fcropssrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fcropssrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> crops">
<form name="fcropslist" id="fcropslist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="crops">
<div id="gmp_crops" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_cropslist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->name->Visible) { // name ?>
        <th data-name="name" class="<?= $Page->name->headerCellClass() ?>"><div id="elh_crops_name" class="crops_name"><?= $Page->renderFieldHeader($Page->name) ?></div></th>
<?php } ?>
<?php if ($Page->thumbnail_url->Visible) { // thumbnail_url ?>
        <th data-name="thumbnail_url" class="<?= $Page->thumbnail_url->headerCellClass() ?>"><div id="elh_crops_thumbnail_url" class="crops_thumbnail_url"><?= $Page->renderFieldHeader($Page->thumbnail_url) ?></div></th>
<?php } ?>
<?php if ($Page->variety->Visible) { // variety ?>
        <th data-name="variety" class="<?= $Page->variety->headerCellClass() ?>"><div id="elh_crops_variety" class="crops_variety"><?= $Page->renderFieldHeader($Page->variety) ?></div></th>
<?php } ?>
<?php if ($Page->grow_level->Visible) { // grow_level ?>
        <th data-name="grow_level" class="<?= $Page->grow_level->headerCellClass() ?>"><div id="elh_crops_grow_level" class="crops_grow_level"><?= $Page->renderFieldHeader($Page->grow_level) ?></div></th>
<?php } ?>
<?php if ($Page->category->Visible) { // category ?>
        <th data-name="category" class="<?= $Page->category->headerCellClass() ?>"><div id="elh_crops_category" class="crops_category"><?= $Page->renderFieldHeader($Page->category) ?></div></th>
<?php } ?>
<?php if ($Page->life_cycle->Visible) { // life_cycle ?>
        <th data-name="life_cycle" class="<?= $Page->life_cycle->headerCellClass() ?>"><div id="elh_crops_life_cycle" class="crops_life_cycle"><?= $Page->renderFieldHeader($Page->life_cycle) ?></div></th>
<?php } ?>
<?php if ($Page->crop_cover_image->Visible) { // crop_cover_image ?>
        <th data-name="crop_cover_image" class="<?= $Page->crop_cover_image->headerCellClass() ?>"><div id="elh_crops_crop_cover_image" class="crops_crop_cover_image"><?= $Page->renderFieldHeader($Page->crop_cover_image) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_crops",
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
    <?php if ($Page->name->Visible) { // name ?>
        <td data-name="name"<?= $Page->name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_crops_name" class="el_crops_name">
<span<?= $Page->name->viewAttributes() ?>>
<?= $Page->name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->thumbnail_url->Visible) { // thumbnail_url ?>
        <td data-name="thumbnail_url"<?= $Page->thumbnail_url->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_crops_thumbnail_url" class="el_crops_thumbnail_url">
<span>
<?= GetFileViewTag($Page->thumbnail_url, $Page->thumbnail_url->getViewValue(), false) ?>
</span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->variety->Visible) { // variety ?>
        <td data-name="variety"<?= $Page->variety->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_crops_variety" class="el_crops_variety">
<span<?= $Page->variety->viewAttributes() ?>>
<?= $Page->variety->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->grow_level->Visible) { // grow_level ?>
        <td data-name="grow_level"<?= $Page->grow_level->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_crops_grow_level" class="el_crops_grow_level">
<span<?= $Page->grow_level->viewAttributes() ?>>
<?= $Page->grow_level->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->category->Visible) { // category ?>
        <td data-name="category"<?= $Page->category->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_crops_category" class="el_crops_category">
<span<?= $Page->category->viewAttributes() ?>>
<?= $Page->category->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->life_cycle->Visible) { // life_cycle ?>
        <td data-name="life_cycle"<?= $Page->life_cycle->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_crops_life_cycle" class="el_crops_life_cycle">
<span<?= $Page->life_cycle->viewAttributes() ?>>
<?= $Page->life_cycle->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->crop_cover_image->Visible) { // crop_cover_image ?>
        <td data-name="crop_cover_image"<?= $Page->crop_cover_image->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_crops_crop_cover_image" class="el_crops_crop_cover_image">
<span<?= $Page->crop_cover_image->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_crop_cover_image_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->crop_cover_image->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->crop_cover_image->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_crop_cover_image_<?= $Page->RowCount ?>"></label>
</div></span>
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
    ew.addEventHandlers("crops");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
