<?php

namespace PHPMaker2022\growit_2021;

// Page object
$CropMonthsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { crop_months: currentTable } });
var currentForm, currentPageID;
var fcrop_monthsview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcrop_monthsview = new ew.Form("fcrop_monthsview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fcrop_monthsview;
    loadjs.done("fcrop_monthsview");
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
<form name="fcrop_monthsview" id="fcrop_monthsview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="crop_months">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crop_months_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_crop_months_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->crop_id->Visible) { // crop_id ?>
    <tr id="r_crop_id"<?= $Page->crop_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crop_months_crop_id"><?= $Page->crop_id->caption() ?></span></td>
        <td data-name="crop_id"<?= $Page->crop_id->cellAttributes() ?>>
<span id="el_crop_months_crop_id">
<span<?= $Page->crop_id->viewAttributes() ?>>
<?= $Page->crop_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sow_under_cover_from->Visible) { // sow_under_cover_from ?>
    <tr id="r_sow_under_cover_from"<?= $Page->sow_under_cover_from->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crop_months_sow_under_cover_from"><?= $Page->sow_under_cover_from->caption() ?></span></td>
        <td data-name="sow_under_cover_from"<?= $Page->sow_under_cover_from->cellAttributes() ?>>
<span id="el_crop_months_sow_under_cover_from">
<span<?= $Page->sow_under_cover_from->viewAttributes() ?>>
<?= $Page->sow_under_cover_from->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sow_under_cover_to->Visible) { // sow_under_cover_to ?>
    <tr id="r_sow_under_cover_to"<?= $Page->sow_under_cover_to->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crop_months_sow_under_cover_to"><?= $Page->sow_under_cover_to->caption() ?></span></td>
        <td data-name="sow_under_cover_to"<?= $Page->sow_under_cover_to->cellAttributes() ?>>
<span id="el_crop_months_sow_under_cover_to">
<span<?= $Page->sow_under_cover_to->viewAttributes() ?>>
<?= $Page->sow_under_cover_to->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sow_direct_from->Visible) { // sow_direct_from ?>
    <tr id="r_sow_direct_from"<?= $Page->sow_direct_from->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crop_months_sow_direct_from"><?= $Page->sow_direct_from->caption() ?></span></td>
        <td data-name="sow_direct_from"<?= $Page->sow_direct_from->cellAttributes() ?>>
<span id="el_crop_months_sow_direct_from">
<span<?= $Page->sow_direct_from->viewAttributes() ?>>
<?= $Page->sow_direct_from->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sow_direct_to->Visible) { // sow_direct_to ?>
    <tr id="r_sow_direct_to"<?= $Page->sow_direct_to->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crop_months_sow_direct_to"><?= $Page->sow_direct_to->caption() ?></span></td>
        <td data-name="sow_direct_to"<?= $Page->sow_direct_to->cellAttributes() ?>>
<span id="el_crop_months_sow_direct_to">
<span<?= $Page->sow_direct_to->viewAttributes() ?>>
<?= $Page->sow_direct_to->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->plant_start_month->Visible) { // plant_start_month ?>
    <tr id="r_plant_start_month"<?= $Page->plant_start_month->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crop_months_plant_start_month"><?= $Page->plant_start_month->caption() ?></span></td>
        <td data-name="plant_start_month"<?= $Page->plant_start_month->cellAttributes() ?>>
<span id="el_crop_months_plant_start_month">
<span<?= $Page->plant_start_month->viewAttributes() ?>>
<?= $Page->plant_start_month->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->plant_end_month->Visible) { // plant_end_month ?>
    <tr id="r_plant_end_month"<?= $Page->plant_end_month->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crop_months_plant_end_month"><?= $Page->plant_end_month->caption() ?></span></td>
        <td data-name="plant_end_month"<?= $Page->plant_end_month->cellAttributes() ?>>
<span id="el_crop_months_plant_end_month">
<span<?= $Page->plant_end_month->viewAttributes() ?>>
<?= $Page->plant_end_month->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->harvest_start_month->Visible) { // harvest_start_month ?>
    <tr id="r_harvest_start_month"<?= $Page->harvest_start_month->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crop_months_harvest_start_month"><?= $Page->harvest_start_month->caption() ?></span></td>
        <td data-name="harvest_start_month"<?= $Page->harvest_start_month->cellAttributes() ?>>
<span id="el_crop_months_harvest_start_month">
<span<?= $Page->harvest_start_month->viewAttributes() ?>>
<?= $Page->harvest_start_month->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->harvest_end_month->Visible) { // harvest_end_month ?>
    <tr id="r_harvest_end_month"<?= $Page->harvest_end_month->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crop_months_harvest_end_month"><?= $Page->harvest_end_month->caption() ?></span></td>
        <td data-name="harvest_end_month"<?= $Page->harvest_end_month->cellAttributes() ?>>
<span id="el_crop_months_harvest_end_month">
<span<?= $Page->harvest_end_month->viewAttributes() ?>>
<?= $Page->harvest_end_month->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
    <tr id="r_updated_at"<?= $Page->updated_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crop_months_updated_at"><?= $Page->updated_at->caption() ?></span></td>
        <td data-name="updated_at"<?= $Page->updated_at->cellAttributes() ?>>
<span id="el_crop_months_updated_at">
<span<?= $Page->updated_at->viewAttributes() ?>>
<?= $Page->updated_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <tr id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crop_months_created_at"><?= $Page->created_at->caption() ?></span></td>
        <td data-name="created_at"<?= $Page->created_at->cellAttributes() ?>>
<span id="el_crop_months_created_at">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
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
