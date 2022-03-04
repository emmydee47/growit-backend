<?php

namespace PHPMaker2022\growit_2021;

// Page object
$CropMonthsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { crop_months: currentTable } });
var currentForm, currentPageID;
var fcrop_monthsdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcrop_monthsdelete = new ew.Form("fcrop_monthsdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fcrop_monthsdelete;
    loadjs.done("fcrop_monthsdelete");
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
<form name="fcrop_monthsdelete" id="fcrop_monthsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="crop_months">
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
        <th class="<?= $Page->crop_id->headerCellClass() ?>"><span id="elh_crop_months_crop_id" class="crop_months_crop_id"><?= $Page->crop_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->plant_start_month->Visible) { // plant_start_month ?>
        <th class="<?= $Page->plant_start_month->headerCellClass() ?>"><span id="elh_crop_months_plant_start_month" class="crop_months_plant_start_month"><?= $Page->plant_start_month->caption() ?></span></th>
<?php } ?>
<?php if ($Page->plant_end_month->Visible) { // plant_end_month ?>
        <th class="<?= $Page->plant_end_month->headerCellClass() ?>"><span id="elh_crop_months_plant_end_month" class="crop_months_plant_end_month"><?= $Page->plant_end_month->caption() ?></span></th>
<?php } ?>
<?php if ($Page->harvest_start_month->Visible) { // harvest_start_month ?>
        <th class="<?= $Page->harvest_start_month->headerCellClass() ?>"><span id="elh_crop_months_harvest_start_month" class="crop_months_harvest_start_month"><?= $Page->harvest_start_month->caption() ?></span></th>
<?php } ?>
<?php if ($Page->harvest_end_month->Visible) { // harvest_end_month ?>
        <th class="<?= $Page->harvest_end_month->headerCellClass() ?>"><span id="elh_crop_months_harvest_end_month" class="crop_months_harvest_end_month"><?= $Page->harvest_end_month->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_crop_months_crop_id" class="el_crop_months_crop_id">
<span<?= $Page->crop_id->viewAttributes() ?>>
<?= $Page->crop_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->plant_start_month->Visible) { // plant_start_month ?>
        <td<?= $Page->plant_start_month->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_crop_months_plant_start_month" class="el_crop_months_plant_start_month">
<span<?= $Page->plant_start_month->viewAttributes() ?>>
<?= $Page->plant_start_month->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->plant_end_month->Visible) { // plant_end_month ?>
        <td<?= $Page->plant_end_month->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_crop_months_plant_end_month" class="el_crop_months_plant_end_month">
<span<?= $Page->plant_end_month->viewAttributes() ?>>
<?= $Page->plant_end_month->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->harvest_start_month->Visible) { // harvest_start_month ?>
        <td<?= $Page->harvest_start_month->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_crop_months_harvest_start_month" class="el_crop_months_harvest_start_month">
<span<?= $Page->harvest_start_month->viewAttributes() ?>>
<?= $Page->harvest_start_month->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->harvest_end_month->Visible) { // harvest_end_month ?>
        <td<?= $Page->harvest_end_month->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_crop_months_harvest_end_month" class="el_crop_months_harvest_end_month">
<span<?= $Page->harvest_end_month->viewAttributes() ?>>
<?= $Page->harvest_end_month->getViewValue() ?></span>
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
