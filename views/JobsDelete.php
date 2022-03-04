<?php

namespace PHPMaker2022\growit_2021;

// Page object
$JobsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jobs: currentTable } });
var currentForm, currentPageID;
var fjobsdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fjobsdelete = new ew.Form("fjobsdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fjobsdelete;
    loadjs.done("fjobsdelete");
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
<form name="fjobsdelete" id="fjobsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jobs">
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
        <th class="<?= $Page->user_id->headerCellClass() ?>"><span id="elh_jobs_user_id" class="jobs_user_id"><?= $Page->user_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->crop_id->Visible) { // crop_id ?>
        <th class="<?= $Page->crop_id->headerCellClass() ?>"><span id="elh_jobs_crop_id" class="jobs_crop_id"><?= $Page->crop_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->job_type->Visible) { // job_type ?>
        <th class="<?= $Page->job_type->headerCellClass() ?>"><span id="elh_jobs_job_type" class="jobs_job_type"><?= $Page->job_type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_title->Visible) { // title ?>
        <th class="<?= $Page->_title->headerCellClass() ?>"><span id="elh_jobs__title" class="jobs__title"><?= $Page->_title->caption() ?></span></th>
<?php } ?>
<?php if ($Page->job_date->Visible) { // job_date ?>
        <th class="<?= $Page->job_date->headerCellClass() ?>"><span id="elh_jobs_job_date" class="jobs_job_date"><?= $Page->job_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_jobs_status" class="jobs_status"><?= $Page->status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->stage_one_completed->Visible) { // stage_one_completed ?>
        <th class="<?= $Page->stage_one_completed->headerCellClass() ?>"><span id="elh_jobs_stage_one_completed" class="jobs_stage_one_completed"><?= $Page->stage_one_completed->caption() ?></span></th>
<?php } ?>
<?php if ($Page->stage_two_completed->Visible) { // stage_two_completed ?>
        <th class="<?= $Page->stage_two_completed->headerCellClass() ?>"><span id="elh_jobs_stage_two_completed" class="jobs_stage_two_completed"><?= $Page->stage_two_completed->caption() ?></span></th>
<?php } ?>
<?php if ($Page->stage_three_completed->Visible) { // stage_three_completed ?>
        <th class="<?= $Page->stage_three_completed->headerCellClass() ?>"><span id="elh_jobs_stage_three_completed" class="jobs_stage_three_completed"><?= $Page->stage_three_completed->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_jobs_user_id" class="el_jobs_user_id">
<span<?= $Page->user_id->viewAttributes() ?>>
<?= $Page->user_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->crop_id->Visible) { // crop_id ?>
        <td<?= $Page->crop_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jobs_crop_id" class="el_jobs_crop_id">
<span<?= $Page->crop_id->viewAttributes() ?>>
<?= $Page->crop_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->job_type->Visible) { // job_type ?>
        <td<?= $Page->job_type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jobs_job_type" class="el_jobs_job_type">
<span<?= $Page->job_type->viewAttributes() ?>>
<?= $Page->job_type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_title->Visible) { // title ?>
        <td<?= $Page->_title->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jobs__title" class="el_jobs__title">
<span<?= $Page->_title->viewAttributes() ?>>
<?= $Page->_title->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->job_date->Visible) { // job_date ?>
        <td<?= $Page->job_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jobs_job_date" class="el_jobs_job_date">
<span<?= $Page->job_date->viewAttributes() ?>>
<?= $Page->job_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <td<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jobs_status" class="el_jobs_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->stage_one_completed->Visible) { // stage_one_completed ?>
        <td<?= $Page->stage_one_completed->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jobs_stage_one_completed" class="el_jobs_stage_one_completed">
<span<?= $Page->stage_one_completed->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_stage_one_completed_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->stage_one_completed->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->stage_one_completed->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_stage_one_completed_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
<?php } ?>
<?php if ($Page->stage_two_completed->Visible) { // stage_two_completed ?>
        <td<?= $Page->stage_two_completed->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jobs_stage_two_completed" class="el_jobs_stage_two_completed">
<span<?= $Page->stage_two_completed->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_stage_two_completed_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->stage_two_completed->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->stage_two_completed->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_stage_two_completed_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
<?php } ?>
<?php if ($Page->stage_three_completed->Visible) { // stage_three_completed ?>
        <td<?= $Page->stage_three_completed->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jobs_stage_three_completed" class="el_jobs_stage_three_completed">
<span<?= $Page->stage_three_completed->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_stage_three_completed_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->stage_three_completed->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->stage_three_completed->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_stage_three_completed_<?= $Page->RowCount ?>"></label>
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
