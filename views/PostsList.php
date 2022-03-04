<?php

namespace PHPMaker2022\growit_2021;

// Page object
$PostsList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { posts: currentTable } });
var currentForm, currentPageID;
var fpostslist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpostslist = new ew.Form("fpostslist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fpostslist;
    fpostslist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fpostslist");
});
var fpostssrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fpostssrch = new ew.Form("fpostssrch", "list");
    currentSearchForm = fpostssrch;

    // Dynamic selection lists

    // Filters
    fpostssrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fpostssrch");
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
<form name="fpostssrch" id="fpostssrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fpostssrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="posts">
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fpostssrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fpostssrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fpostssrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fpostssrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> posts">
<form name="fpostslist" id="fpostslist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="posts">
<div id="gmp_posts" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_postslist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_posts_id" class="posts_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->crop_id->Visible) { // crop_id ?>
        <th data-name="crop_id" class="<?= $Page->crop_id->headerCellClass() ?>"><div id="elh_posts_crop_id" class="posts_crop_id"><?= $Page->renderFieldHeader($Page->crop_id) ?></div></th>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
        <th data-name="user_id" class="<?= $Page->user_id->headerCellClass() ?>"><div id="elh_posts_user_id" class="posts_user_id"><?= $Page->renderFieldHeader($Page->user_id) ?></div></th>
<?php } ?>
<?php if ($Page->_title->Visible) { // title ?>
        <th data-name="_title" class="<?= $Page->_title->headerCellClass() ?>"><div id="elh_posts__title" class="posts__title"><?= $Page->renderFieldHeader($Page->_title) ?></div></th>
<?php } ?>
<?php if ($Page->post_type->Visible) { // post_type ?>
        <th data-name="post_type" class="<?= $Page->post_type->headerCellClass() ?>"><div id="elh_posts_post_type" class="posts_post_type"><?= $Page->renderFieldHeader($Page->post_type) ?></div></th>
<?php } ?>
<?php if ($Page->crop_type->Visible) { // crop_type ?>
        <th data-name="crop_type" class="<?= $Page->crop_type->headerCellClass() ?>"><div id="elh_posts_crop_type" class="posts_crop_type"><?= $Page->renderFieldHeader($Page->crop_type) ?></div></th>
<?php } ?>
<?php if ($Page->variety->Visible) { // variety ?>
        <th data-name="variety" class="<?= $Page->variety->headerCellClass() ?>"><div id="elh_posts_variety" class="posts_variety"><?= $Page->renderFieldHeader($Page->variety) ?></div></th>
<?php } ?>
<?php if ($Page->media_url->Visible) { // media_url ?>
        <th data-name="media_url" class="<?= $Page->media_url->headerCellClass() ?>"><div id="elh_posts_media_url" class="posts_media_url"><?= $Page->renderFieldHeader($Page->media_url) ?></div></th>
<?php } ?>
<?php if ($Page->thumbnail_url->Visible) { // thumbnail_url ?>
        <th data-name="thumbnail_url" class="<?= $Page->thumbnail_url->headerCellClass() ?>"><div id="elh_posts_thumbnail_url" class="posts_thumbnail_url"><?= $Page->renderFieldHeader($Page->thumbnail_url) ?></div></th>
<?php } ?>
<?php if ($Page->use_thumbnail->Visible) { // use_thumbnail ?>
        <th data-name="use_thumbnail" class="<?= $Page->use_thumbnail->headerCellClass() ?>"><div id="elh_posts_use_thumbnail" class="posts_use_thumbnail"><?= $Page->renderFieldHeader($Page->use_thumbnail) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_posts",
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
<span id="el<?= $Page->RowCount ?>_posts_id" class="el_posts_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->crop_id->Visible) { // crop_id ?>
        <td data-name="crop_id"<?= $Page->crop_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_posts_crop_id" class="el_posts_crop_id">
<span<?= $Page->crop_id->viewAttributes() ?>>
<?= $Page->crop_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->user_id->Visible) { // user_id ?>
        <td data-name="user_id"<?= $Page->user_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_posts_user_id" class="el_posts_user_id">
<span<?= $Page->user_id->viewAttributes() ?>>
<?= $Page->user_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->_title->Visible) { // title ?>
        <td data-name="_title"<?= $Page->_title->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_posts__title" class="el_posts__title">
<span<?= $Page->_title->viewAttributes() ?>>
<?= $Page->_title->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->post_type->Visible) { // post_type ?>
        <td data-name="post_type"<?= $Page->post_type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_posts_post_type" class="el_posts_post_type">
<span<?= $Page->post_type->viewAttributes() ?>>
<?= $Page->post_type->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->crop_type->Visible) { // crop_type ?>
        <td data-name="crop_type"<?= $Page->crop_type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_posts_crop_type" class="el_posts_crop_type">
<span<?= $Page->crop_type->viewAttributes() ?>>
<?= $Page->crop_type->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->variety->Visible) { // variety ?>
        <td data-name="variety"<?= $Page->variety->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_posts_variety" class="el_posts_variety">
<span<?= $Page->variety->viewAttributes() ?>>
<?= $Page->variety->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->media_url->Visible) { // media_url ?>
        <td data-name="media_url"<?= $Page->media_url->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_posts_media_url" class="el_posts_media_url">
<span<?= $Page->media_url->viewAttributes() ?>>
<?= $Page->media_url->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->thumbnail_url->Visible) { // thumbnail_url ?>
        <td data-name="thumbnail_url"<?= $Page->thumbnail_url->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_posts_thumbnail_url" class="el_posts_thumbnail_url">
<span<?= $Page->thumbnail_url->viewAttributes() ?>>
<?= $Page->thumbnail_url->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->use_thumbnail->Visible) { // use_thumbnail ?>
        <td data-name="use_thumbnail"<?= $Page->use_thumbnail->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_posts_use_thumbnail" class="el_posts_use_thumbnail">
<span<?= $Page->use_thumbnail->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_use_thumbnail_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->use_thumbnail->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->use_thumbnail->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_use_thumbnail_<?= $Page->RowCount ?>"></label>
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
    ew.addEventHandlers("posts");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
