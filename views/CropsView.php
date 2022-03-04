<?php

namespace PHPMaker2022\growit_2021;

// Page object
$CropsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { crops: currentTable } });
var currentForm, currentPageID;
var fcropsview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcropsview = new ew.Form("fcropsview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fcropsview;
    loadjs.done("fcropsview");
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
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fcropsview" id="fcropsview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="crops">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crops_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_crops_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
    <tr id="r_name"<?= $Page->name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crops_name"><?= $Page->name->caption() ?></span></td>
        <td data-name="name"<?= $Page->name->cellAttributes() ?>>
<span id="el_crops_name">
<span<?= $Page->name->viewAttributes() ?>>
<?= $Page->name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->media_url->Visible) { // media_url ?>
    <tr id="r_media_url"<?= $Page->media_url->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crops_media_url"><?= $Page->media_url->caption() ?></span></td>
        <td data-name="media_url"<?= $Page->media_url->cellAttributes() ?>>
<span id="el_crops_media_url">
<span>
<?= GetFileViewTag($Page->media_url, $Page->media_url->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->thumbnail_url->Visible) { // thumbnail_url ?>
    <tr id="r_thumbnail_url"<?= $Page->thumbnail_url->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crops_thumbnail_url"><?= $Page->thumbnail_url->caption() ?></span></td>
        <td data-name="thumbnail_url"<?= $Page->thumbnail_url->cellAttributes() ?>>
<span id="el_crops_thumbnail_url">
<span>
<?= GetFileViewTag($Page->thumbnail_url, $Page->thumbnail_url->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->variety->Visible) { // variety ?>
    <tr id="r_variety"<?= $Page->variety->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crops_variety"><?= $Page->variety->caption() ?></span></td>
        <td data-name="variety"<?= $Page->variety->cellAttributes() ?>>
<span id="el_crops_variety">
<span<?= $Page->variety->viewAttributes() ?>>
<?= $Page->variety->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->grow_level->Visible) { // grow_level ?>
    <tr id="r_grow_level"<?= $Page->grow_level->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crops_grow_level"><?= $Page->grow_level->caption() ?></span></td>
        <td data-name="grow_level"<?= $Page->grow_level->cellAttributes() ?>>
<span id="el_crops_grow_level">
<span<?= $Page->grow_level->viewAttributes() ?>>
<?= $Page->grow_level->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->category->Visible) { // category ?>
    <tr id="r_category"<?= $Page->category->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crops_category"><?= $Page->category->caption() ?></span></td>
        <td data-name="category"<?= $Page->category->cellAttributes() ?>>
<span id="el_crops_category">
<span<?= $Page->category->viewAttributes() ?>>
<?= $Page->category->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->life_cycle->Visible) { // life_cycle ?>
    <tr id="r_life_cycle"<?= $Page->life_cycle->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crops_life_cycle"><?= $Page->life_cycle->caption() ?></span></td>
        <td data-name="life_cycle"<?= $Page->life_cycle->cellAttributes() ?>>
<span id="el_crops_life_cycle">
<span<?= $Page->life_cycle->viewAttributes() ?>>
<?= $Page->life_cycle->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->companion_crops->Visible) { // companion_crops ?>
    <tr id="r_companion_crops"<?= $Page->companion_crops->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crops_companion_crops"><?= $Page->companion_crops->caption() ?></span></td>
        <td data-name="companion_crops"<?= $Page->companion_crops->cellAttributes() ?>>
<span id="el_crops_companion_crops">
<span<?= $Page->companion_crops->viewAttributes() ?>>
<?= $Page->companion_crops->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->crop_cover_image->Visible) { // crop_cover_image ?>
    <tr id="r_crop_cover_image"<?= $Page->crop_cover_image->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crops_crop_cover_image"><?= $Page->crop_cover_image->caption() ?></span></td>
        <td data-name="crop_cover_image"<?= $Page->crop_cover_image->cellAttributes() ?>>
<span id="el_crops_crop_cover_image">
<span<?= $Page->crop_cover_image->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_crop_cover_image_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->crop_cover_image->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->crop_cover_image->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_crop_cover_image_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <tr id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crops_created_at"><?= $Page->created_at->caption() ?></span></td>
        <td data-name="created_at"<?= $Page->created_at->cellAttributes() ?>>
<span id="el_crops_created_at">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
    <tr id="r_updated_at"<?= $Page->updated_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crops_updated_at"><?= $Page->updated_at->caption() ?></span></td>
        <td data-name="updated_at"<?= $Page->updated_at->cellAttributes() ?>>
<span id="el_crops_updated_at">
<span<?= $Page->updated_at->viewAttributes() ?>>
<?= $Page->updated_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
