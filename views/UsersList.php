<?php

namespace PHPMaker2022\growit_2021;

// Page object
$UsersList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { users: currentTable } });
var currentForm, currentPageID;
var fuserslist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fuserslist = new ew.Form("fuserslist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fuserslist;
    fuserslist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fuserslist");
});
var fuserssrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fuserssrch = new ew.Form("fuserssrch", "list");
    currentSearchForm = fuserssrch;

    // Dynamic selection lists

    // Filters
    fuserssrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fuserssrch");
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
<form name="fuserssrch" id="fuserssrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fuserssrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="users">
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fuserssrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fuserssrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fuserssrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fuserssrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> users">
<form name="fuserslist" id="fuserslist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="users">
<div id="gmp_users" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_userslist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_users_id" class="users_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->auth_id->Visible) { // auth_id ?>
        <th data-name="auth_id" class="<?= $Page->auth_id->headerCellClass() ?>"><div id="elh_users_auth_id" class="users_auth_id"><?= $Page->renderFieldHeader($Page->auth_id) ?></div></th>
<?php } ?>
<?php if ($Page->avatar->Visible) { // avatar ?>
        <th data-name="avatar" class="<?= $Page->avatar->headerCellClass() ?>"><div id="elh_users_avatar" class="users_avatar"><?= $Page->renderFieldHeader($Page->avatar) ?></div></th>
<?php } ?>
<?php if ($Page->_username->Visible) { // username ?>
        <th data-name="_username" class="<?= $Page->_username->headerCellClass() ?>"><div id="elh_users__username" class="users__username"><?= $Page->renderFieldHeader($Page->_username) ?></div></th>
<?php } ?>
<?php if ($Page->fullname->Visible) { // fullname ?>
        <th data-name="fullname" class="<?= $Page->fullname->headerCellClass() ?>"><div id="elh_users_fullname" class="users_fullname"><?= $Page->renderFieldHeader($Page->fullname) ?></div></th>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
        <th data-name="_password" class="<?= $Page->_password->headerCellClass() ?>"><div id="elh_users__password" class="users__password"><?= $Page->renderFieldHeader($Page->_password) ?></div></th>
<?php } ?>
<?php if ($Page->role_id->Visible) { // role_id ?>
        <th data-name="role_id" class="<?= $Page->role_id->headerCellClass() ?>"><div id="elh_users_role_id" class="users_role_id"><?= $Page->renderFieldHeader($Page->role_id) ?></div></th>
<?php } ?>
<?php if ($Page->_token->Visible) { // token ?>
        <th data-name="_token" class="<?= $Page->_token->headerCellClass() ?>"><div id="elh_users__token" class="users__token"><?= $Page->renderFieldHeader($Page->_token) ?></div></th>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <th data-name="_email" class="<?= $Page->_email->headerCellClass() ?>"><div id="elh_users__email" class="users__email"><?= $Page->renderFieldHeader($Page->_email) ?></div></th>
<?php } ?>
<?php if ($Page->gender->Visible) { // gender ?>
        <th data-name="gender" class="<?= $Page->gender->headerCellClass() ?>"><div id="elh_users_gender" class="users_gender"><?= $Page->renderFieldHeader($Page->gender) ?></div></th>
<?php } ?>
<?php if ($Page->date_of_birth->Visible) { // date_of_birth ?>
        <th data-name="date_of_birth" class="<?= $Page->date_of_birth->headerCellClass() ?>"><div id="elh_users_date_of_birth" class="users_date_of_birth"><?= $Page->renderFieldHeader($Page->date_of_birth) ?></div></th>
<?php } ?>
<?php if ($Page->last_login->Visible) { // last_login ?>
        <th data-name="last_login" class="<?= $Page->last_login->headerCellClass() ?>"><div id="elh_users_last_login" class="users_last_login"><?= $Page->renderFieldHeader($Page->last_login) ?></div></th>
<?php } ?>
<?php if ($Page->is_verified->Visible) { // is_verified ?>
        <th data-name="is_verified" class="<?= $Page->is_verified->headerCellClass() ?>"><div id="elh_users_is_verified" class="users_is_verified"><?= $Page->renderFieldHeader($Page->is_verified) ?></div></th>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
        <th data-name="location" class="<?= $Page->location->headerCellClass() ?>"><div id="elh_users_location" class="users_location"><?= $Page->renderFieldHeader($Page->location) ?></div></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th data-name="created_at" class="<?= $Page->created_at->headerCellClass() ?>"><div id="elh_users_created_at" class="users_created_at"><?= $Page->renderFieldHeader($Page->created_at) ?></div></th>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
        <th data-name="updated_at" class="<?= $Page->updated_at->headerCellClass() ?>"><div id="elh_users_updated_at" class="users_updated_at"><?= $Page->renderFieldHeader($Page->updated_at) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_users",
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
<span id="el<?= $Page->RowCount ?>_users_id" class="el_users_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->auth_id->Visible) { // auth_id ?>
        <td data-name="auth_id"<?= $Page->auth_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_auth_id" class="el_users_auth_id">
<span<?= $Page->auth_id->viewAttributes() ?>>
<?= $Page->auth_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->avatar->Visible) { // avatar ?>
        <td data-name="avatar"<?= $Page->avatar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_avatar" class="el_users_avatar">
<span<?= $Page->avatar->viewAttributes() ?>>
<?= $Page->avatar->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->_username->Visible) { // username ?>
        <td data-name="_username"<?= $Page->_username->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users__username" class="el_users__username">
<span<?= $Page->_username->viewAttributes() ?>>
<?= $Page->_username->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->fullname->Visible) { // fullname ?>
        <td data-name="fullname"<?= $Page->fullname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_fullname" class="el_users_fullname">
<span<?= $Page->fullname->viewAttributes() ?>>
<?= $Page->fullname->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->_password->Visible) { // password ?>
        <td data-name="_password"<?= $Page->_password->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users__password" class="el_users__password">
<span<?= $Page->_password->viewAttributes() ?>>
<?= $Page->_password->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->role_id->Visible) { // role_id ?>
        <td data-name="role_id"<?= $Page->role_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_role_id" class="el_users_role_id">
<span<?= $Page->role_id->viewAttributes() ?>>
<?= $Page->role_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->_token->Visible) { // token ?>
        <td data-name="_token"<?= $Page->_token->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users__token" class="el_users__token">
<span<?= $Page->_token->viewAttributes() ?>>
<?= $Page->_token->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->_email->Visible) { // email ?>
        <td data-name="_email"<?= $Page->_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users__email" class="el_users__email">
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->gender->Visible) { // gender ?>
        <td data-name="gender"<?= $Page->gender->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_gender" class="el_users_gender">
<span<?= $Page->gender->viewAttributes() ?>>
<?= $Page->gender->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_of_birth->Visible) { // date_of_birth ?>
        <td data-name="date_of_birth"<?= $Page->date_of_birth->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_date_of_birth" class="el_users_date_of_birth">
<span<?= $Page->date_of_birth->viewAttributes() ?>>
<?= $Page->date_of_birth->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->last_login->Visible) { // last_login ?>
        <td data-name="last_login"<?= $Page->last_login->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_last_login" class="el_users_last_login">
<span<?= $Page->last_login->viewAttributes() ?>>
<?= $Page->last_login->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->is_verified->Visible) { // is_verified ?>
        <td data-name="is_verified"<?= $Page->is_verified->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_is_verified" class="el_users_is_verified">
<span<?= $Page->is_verified->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_is_verified_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->is_verified->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->is_verified->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_is_verified_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->location->Visible) { // location ?>
        <td data-name="location"<?= $Page->location->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_location" class="el_users_location">
<span<?= $Page->location->viewAttributes() ?>>
<?= $Page->location->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->created_at->Visible) { // created_at ?>
        <td data-name="created_at"<?= $Page->created_at->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_created_at" class="el_users_created_at">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->updated_at->Visible) { // updated_at ?>
        <td data-name="updated_at"<?= $Page->updated_at->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_updated_at" class="el_users_updated_at">
<span<?= $Page->updated_at->viewAttributes() ?>>
<?= $Page->updated_at->getViewValue() ?></span>
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
    ew.addEventHandlers("users");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
