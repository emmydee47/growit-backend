<?php

namespace PHPMaker2022\growit_2021;

// Page object
$JobHistoriesDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { job_histories: currentTable } });
var currentForm, currentPageID;
var fjob_historiesdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fjob_historiesdelete = new ew.Form("fjob_historiesdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fjob_historiesdelete;
    loadjs.done("fjob_historiesdelete");
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
<form name="fjob_historiesdelete" id="fjob_historiesdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="job_histories">
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
<?php if ($Page->user_id->Visible) { // user_id ?>
        <th class="<?= $Page->user_id->headerCellClass() ?>"><span id="elh_job_histories_user_id" class="job_histories_user_id"><?= $Page->user_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->job_id->Visible) { // job_id ?>
        <th class="<?= $Page->job_id->headerCellClass() ?>"><span id="elh_job_histories_job_id" class="job_histories_job_id"><?= $Page->job_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->job_type->Visible) { // job_type ?>
        <th class="<?= $Page->job_type->headerCellClass() ?>"><span id="elh_job_histories_job_type" class="job_histories_job_type"><?= $Page->job_type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
        <th class="<?= $Page->description->headerCellClass() ?>"><span id="elh_job_histories_description" class="job_histories_description"><?= $Page->description->caption() ?></span></th>
<?php } ?>
<?php if ($Page->job_date->Visible) { // job_date ?>
        <th class="<?= $Page->job_date->headerCellClass() ?>"><span id="elh_job_histories_job_date" class="job_histories_job_date"><?= $Page->job_date->caption() ?></span></th>
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
<?php if ($Page->user_id->Visible) { // user_id ?>
        <td<?= $Page->user_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_histories_user_id" class="el_job_histories_user_id">
<span<?= $Page->user_id->viewAttributes() ?>>
<?= $Page->user_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->job_id->Visible) { // job_id ?>
        <td<?= $Page->job_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_histories_job_id" class="el_job_histories_job_id">
<span<?= $Page->job_id->viewAttributes() ?>>
<?= $Page->job_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->job_type->Visible) { // job_type ?>
        <td<?= $Page->job_type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_histories_job_type" class="el_job_histories_job_type">
<span<?= $Page->job_type->viewAttributes() ?>>
<?= $Page->job_type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
        <td<?= $Page->description->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_histories_description" class="el_job_histories_description">
<span<?= $Page->description->viewAttributes() ?>>
<?= $Page->description->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->job_date->Visible) { // job_date ?>
        <td<?= $Page->job_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_job_histories_job_date" class="el_job_histories_job_date">
<span<?= $Page->job_date->viewAttributes() ?>>
<?= $Page->job_date->getViewValue() ?></span>
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
