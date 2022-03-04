<?php

namespace PHPMaker2022\growit_2021;

// Page object
$CropTipsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { crop_tips: currentTable } });
var currentForm, currentPageID;
var fcrop_tipsview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcrop_tipsview = new ew.Form("fcrop_tipsview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fcrop_tipsview;
    loadjs.done("fcrop_tipsview");
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
<form name="fcrop_tipsview" id="fcrop_tipsview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="crop_tips">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crop_tips_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_crop_tips_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->crop_id->Visible) { // crop_id ?>
    <tr id="r_crop_id"<?= $Page->crop_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crop_tips_crop_id"><?= $Page->crop_id->caption() ?></span></td>
        <td data-name="crop_id"<?= $Page->crop_id->cellAttributes() ?>>
<span id="el_crop_tips_crop_id">
<span<?= $Page->crop_id->viewAttributes() ?>>
<?= $Page->crop_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sow_tip->Visible) { // sow_tip ?>
    <tr id="r_sow_tip"<?= $Page->sow_tip->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crop_tips_sow_tip"><?= $Page->sow_tip->caption() ?></span></td>
        <td data-name="sow_tip"<?= $Page->sow_tip->cellAttributes() ?>>
<span id="el_crop_tips_sow_tip">
<span<?= $Page->sow_tip->viewAttributes() ?>>
<?= $Page->sow_tip->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->plant_tip->Visible) { // plant_tip ?>
    <tr id="r_plant_tip"<?= $Page->plant_tip->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crop_tips_plant_tip"><?= $Page->plant_tip->caption() ?></span></td>
        <td data-name="plant_tip"<?= $Page->plant_tip->cellAttributes() ?>>
<span id="el_crop_tips_plant_tip">
<span<?= $Page->plant_tip->viewAttributes() ?>>
<?= $Page->plant_tip->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->harvest_tip->Visible) { // harvest_tip ?>
    <tr id="r_harvest_tip"<?= $Page->harvest_tip->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crop_tips_harvest_tip"><?= $Page->harvest_tip->caption() ?></span></td>
        <td data-name="harvest_tip"<?= $Page->harvest_tip->cellAttributes() ?>>
<span id="el_crop_tips_harvest_tip">
<span<?= $Page->harvest_tip->viewAttributes() ?>>
<?= $Page->harvest_tip->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sow_summary->Visible) { // sow_summary ?>
    <tr id="r_sow_summary"<?= $Page->sow_summary->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crop_tips_sow_summary"><?= $Page->sow_summary->caption() ?></span></td>
        <td data-name="sow_summary"<?= $Page->sow_summary->cellAttributes() ?>>
<span id="el_crop_tips_sow_summary">
<span<?= $Page->sow_summary->viewAttributes() ?>>
<?= $Page->sow_summary->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->plant_summary->Visible) { // plant_summary ?>
    <tr id="r_plant_summary"<?= $Page->plant_summary->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crop_tips_plant_summary"><?= $Page->plant_summary->caption() ?></span></td>
        <td data-name="plant_summary"<?= $Page->plant_summary->cellAttributes() ?>>
<span id="el_crop_tips_plant_summary">
<span<?= $Page->plant_summary->viewAttributes() ?>>
<?= $Page->plant_summary->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->harvest_summary->Visible) { // harvest_summary ?>
    <tr id="r_harvest_summary"<?= $Page->harvest_summary->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crop_tips_harvest_summary"><?= $Page->harvest_summary->caption() ?></span></td>
        <td data-name="harvest_summary"<?= $Page->harvest_summary->cellAttributes() ?>>
<span id="el_crop_tips_harvest_summary">
<span<?= $Page->harvest_summary->viewAttributes() ?>>
<?= $Page->harvest_summary->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
    <tr id="r_updated_at"<?= $Page->updated_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crop_tips_updated_at"><?= $Page->updated_at->caption() ?></span></td>
        <td data-name="updated_at"<?= $Page->updated_at->cellAttributes() ?>>
<span id="el_crop_tips_updated_at">
<span<?= $Page->updated_at->viewAttributes() ?>>
<?= $Page->updated_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <tr id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crop_tips_created_at"><?= $Page->created_at->caption() ?></span></td>
        <td data-name="created_at"<?= $Page->created_at->cellAttributes() ?>>
<span id="el_crop_tips_created_at">
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
