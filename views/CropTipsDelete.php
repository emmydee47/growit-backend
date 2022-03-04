<?php

namespace PHPMaker2022\growit_2021;

// Page object
$CropTipsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { crop_tips: currentTable } });
var currentForm, currentPageID;
var fcrop_tipsdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcrop_tipsdelete = new ew.Form("fcrop_tipsdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fcrop_tipsdelete;
    loadjs.done("fcrop_tipsdelete");
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
<form name="fcrop_tipsdelete" id="fcrop_tipsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="crop_tips">
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
<?php if ($Page->crop_id->Visible) { // crop_id ?>
        <th class="<?= $Page->crop_id->headerCellClass() ?>"><span id="elh_crop_tips_crop_id" class="crop_tips_crop_id"><?= $Page->crop_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sow_tip->Visible) { // sow_tip ?>
        <th class="<?= $Page->sow_tip->headerCellClass() ?>"><span id="elh_crop_tips_sow_tip" class="crop_tips_sow_tip"><?= $Page->sow_tip->caption() ?></span></th>
<?php } ?>
<?php if ($Page->plant_tip->Visible) { // plant_tip ?>
        <th class="<?= $Page->plant_tip->headerCellClass() ?>"><span id="elh_crop_tips_plant_tip" class="crop_tips_plant_tip"><?= $Page->plant_tip->caption() ?></span></th>
<?php } ?>
<?php if ($Page->harvest_tip->Visible) { // harvest_tip ?>
        <th class="<?= $Page->harvest_tip->headerCellClass() ?>"><span id="elh_crop_tips_harvest_tip" class="crop_tips_harvest_tip"><?= $Page->harvest_tip->caption() ?></span></th>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
        <th class="<?= $Page->updated_at->headerCellClass() ?>"><span id="elh_crop_tips_updated_at" class="crop_tips_updated_at"><?= $Page->updated_at->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th class="<?= $Page->created_at->headerCellClass() ?>"><span id="elh_crop_tips_created_at" class="crop_tips_created_at"><?= $Page->created_at->caption() ?></span></th>
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
<?php if ($Page->crop_id->Visible) { // crop_id ?>
        <td<?= $Page->crop_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_crop_tips_crop_id" class="el_crop_tips_crop_id">
<span<?= $Page->crop_id->viewAttributes() ?>>
<?= $Page->crop_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sow_tip->Visible) { // sow_tip ?>
        <td<?= $Page->sow_tip->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_crop_tips_sow_tip" class="el_crop_tips_sow_tip">
<span<?= $Page->sow_tip->viewAttributes() ?>>
<?= $Page->sow_tip->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->plant_tip->Visible) { // plant_tip ?>
        <td<?= $Page->plant_tip->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_crop_tips_plant_tip" class="el_crop_tips_plant_tip">
<span<?= $Page->plant_tip->viewAttributes() ?>>
<?= $Page->plant_tip->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->harvest_tip->Visible) { // harvest_tip ?>
        <td<?= $Page->harvest_tip->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_crop_tips_harvest_tip" class="el_crop_tips_harvest_tip">
<span<?= $Page->harvest_tip->viewAttributes() ?>>
<?= $Page->harvest_tip->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
        <td<?= $Page->updated_at->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_crop_tips_updated_at" class="el_crop_tips_updated_at">
<span<?= $Page->updated_at->viewAttributes() ?>>
<?= $Page->updated_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <td<?= $Page->created_at->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_crop_tips_created_at" class="el_crop_tips_created_at">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
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
