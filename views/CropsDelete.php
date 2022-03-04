<?php

namespace PHPMaker2022\growit_2021;

// Page object
$CropsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { crops: currentTable } });
var currentForm, currentPageID;
var fcropsdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcropsdelete = new ew.Form("fcropsdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fcropsdelete;
    loadjs.done("fcropsdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fcropsdelete" id="fcropsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="crops">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table table-bordered table-hover table-sm ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->name->Visible) { // name ?>
        <th class="<?= $Page->name->headerCellClass() ?>"><span id="elh_crops_name" class="crops_name"><?= $Page->name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->thumbnail_url->Visible) { // thumbnail_url ?>
        <th class="<?= $Page->thumbnail_url->headerCellClass() ?>"><span id="elh_crops_thumbnail_url" class="crops_thumbnail_url"><?= $Page->thumbnail_url->caption() ?></span></th>
<?php } ?>
<?php if ($Page->variety->Visible) { // variety ?>
        <th class="<?= $Page->variety->headerCellClass() ?>"><span id="elh_crops_variety" class="crops_variety"><?= $Page->variety->caption() ?></span></th>
<?php } ?>
<?php if ($Page->grow_level->Visible) { // grow_level ?>
        <th class="<?= $Page->grow_level->headerCellClass() ?>"><span id="elh_crops_grow_level" class="crops_grow_level"><?= $Page->grow_level->caption() ?></span></th>
<?php } ?>
<?php if ($Page->category->Visible) { // category ?>
        <th class="<?= $Page->category->headerCellClass() ?>"><span id="elh_crops_category" class="crops_category"><?= $Page->category->caption() ?></span></th>
<?php } ?>
<?php if ($Page->life_cycle->Visible) { // life_cycle ?>
        <th class="<?= $Page->life_cycle->headerCellClass() ?>"><span id="elh_crops_life_cycle" class="crops_life_cycle"><?= $Page->life_cycle->caption() ?></span></th>
<?php } ?>
<?php if ($Page->crop_cover_image->Visible) { // crop_cover_image ?>
        <th class="<?= $Page->crop_cover_image->headerCellClass() ?>"><span id="elh_crops_crop_cover_image" class="crops_crop_cover_image"><?= $Page->crop_cover_image->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->name->Visible) { // name ?>
        <td<?= $Page->name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_crops_name" class="el_crops_name">
<span<?= $Page->name->viewAttributes() ?>>
<?= $Page->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->thumbnail_url->Visible) { // thumbnail_url ?>
        <td<?= $Page->thumbnail_url->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_crops_thumbnail_url" class="el_crops_thumbnail_url">
<span>
<?= GetFileViewTag($Page->thumbnail_url, $Page->thumbnail_url->getViewValue(), false) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->variety->Visible) { // variety ?>
        <td<?= $Page->variety->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_crops_variety" class="el_crops_variety">
<span<?= $Page->variety->viewAttributes() ?>>
<?= $Page->variety->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->grow_level->Visible) { // grow_level ?>
        <td<?= $Page->grow_level->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_crops_grow_level" class="el_crops_grow_level">
<span<?= $Page->grow_level->viewAttributes() ?>>
<?= $Page->grow_level->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->category->Visible) { // category ?>
        <td<?= $Page->category->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_crops_category" class="el_crops_category">
<span<?= $Page->category->viewAttributes() ?>>
<?= $Page->category->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->life_cycle->Visible) { // life_cycle ?>
        <td<?= $Page->life_cycle->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_crops_life_cycle" class="el_crops_life_cycle">
<span<?= $Page->life_cycle->viewAttributes() ?>>
<?= $Page->life_cycle->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->crop_cover_image->Visible) { // crop_cover_image ?>
        <td<?= $Page->crop_cover_image->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_crops_crop_cover_image" class="el_crops_crop_cover_image">
<span<?= $Page->crop_cover_image->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_crop_cover_image_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->crop_cover_image->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->crop_cover_image->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_crop_cover_image_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
