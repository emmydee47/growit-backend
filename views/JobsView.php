<?php

namespace PHPMaker2022\growit_2021;

// Page object
$JobsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jobs: currentTable } });
var currentForm, currentPageID;
var fjobsview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fjobsview = new ew.Form("fjobsview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fjobsview;
    loadjs.done("fjobsview");
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
<form name="fjobsview" id="fjobsview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jobs">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jobs_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_jobs_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
    <tr id="r_user_id"<?= $Page->user_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jobs_user_id"><?= $Page->user_id->caption() ?></span></td>
        <td data-name="user_id"<?= $Page->user_id->cellAttributes() ?>>
<span id="el_jobs_user_id">
<span<?= $Page->user_id->viewAttributes() ?>>
<?= $Page->user_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->crop_id->Visible) { // crop_id ?>
    <tr id="r_crop_id"<?= $Page->crop_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jobs_crop_id"><?= $Page->crop_id->caption() ?></span></td>
        <td data-name="crop_id"<?= $Page->crop_id->cellAttributes() ?>>
<span id="el_jobs_crop_id">
<span<?= $Page->crop_id->viewAttributes() ?>>
<?= $Page->crop_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->variety->Visible) { // variety ?>
    <tr id="r_variety"<?= $Page->variety->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jobs_variety"><?= $Page->variety->caption() ?></span></td>
        <td data-name="variety"<?= $Page->variety->cellAttributes() ?>>
<span id="el_jobs_variety">
<span<?= $Page->variety->viewAttributes() ?>>
<?= $Page->variety->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->crop_type->Visible) { // crop_type ?>
    <tr id="r_crop_type"<?= $Page->crop_type->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jobs_crop_type"><?= $Page->crop_type->caption() ?></span></td>
        <td data-name="crop_type"<?= $Page->crop_type->cellAttributes() ?>>
<span id="el_jobs_crop_type">
<span<?= $Page->crop_type->viewAttributes() ?>>
<?= $Page->crop_type->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->job_type->Visible) { // job_type ?>
    <tr id="r_job_type"<?= $Page->job_type->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jobs_job_type"><?= $Page->job_type->caption() ?></span></td>
        <td data-name="job_type"<?= $Page->job_type->cellAttributes() ?>>
<span id="el_jobs_job_type">
<span<?= $Page->job_type->viewAttributes() ?>>
<?= $Page->job_type->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->assigned_by->Visible) { // assigned_by ?>
    <tr id="r_assigned_by"<?= $Page->assigned_by->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jobs_assigned_by"><?= $Page->assigned_by->caption() ?></span></td>
        <td data-name="assigned_by"<?= $Page->assigned_by->cellAttributes() ?>>
<span id="el_jobs_assigned_by">
<span<?= $Page->assigned_by->viewAttributes() ?>>
<?= $Page->assigned_by->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_title->Visible) { // title ?>
    <tr id="r__title"<?= $Page->_title->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jobs__title"><?= $Page->_title->caption() ?></span></td>
        <td data-name="_title"<?= $Page->_title->cellAttributes() ?>>
<span id="el_jobs__title">
<span<?= $Page->_title->viewAttributes() ?>>
<?= $Page->_title->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->job_date->Visible) { // job_date ?>
    <tr id="r_job_date"<?= $Page->job_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jobs_job_date"><?= $Page->job_date->caption() ?></span></td>
        <td data-name="job_date"<?= $Page->job_date->cellAttributes() ?>>
<span id="el_jobs_job_date">
<span<?= $Page->job_date->viewAttributes() ?>>
<?= $Page->job_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status"<?= $Page->status->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jobs_status"><?= $Page->status->caption() ?></span></td>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el_jobs_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->stage_one_completed->Visible) { // stage_one_completed ?>
    <tr id="r_stage_one_completed"<?= $Page->stage_one_completed->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jobs_stage_one_completed"><?= $Page->stage_one_completed->caption() ?></span></td>
        <td data-name="stage_one_completed"<?= $Page->stage_one_completed->cellAttributes() ?>>
<span id="el_jobs_stage_one_completed">
<span<?= $Page->stage_one_completed->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_stage_one_completed_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->stage_one_completed->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->stage_one_completed->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_stage_one_completed_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->stage_two_completed->Visible) { // stage_two_completed ?>
    <tr id="r_stage_two_completed"<?= $Page->stage_two_completed->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jobs_stage_two_completed"><?= $Page->stage_two_completed->caption() ?></span></td>
        <td data-name="stage_two_completed"<?= $Page->stage_two_completed->cellAttributes() ?>>
<span id="el_jobs_stage_two_completed">
<span<?= $Page->stage_two_completed->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_stage_two_completed_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->stage_two_completed->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->stage_two_completed->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_stage_two_completed_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->stage_three_completed->Visible) { // stage_three_completed ?>
    <tr id="r_stage_three_completed"<?= $Page->stage_three_completed->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jobs_stage_three_completed"><?= $Page->stage_three_completed->caption() ?></span></td>
        <td data-name="stage_three_completed"<?= $Page->stage_three_completed->cellAttributes() ?>>
<span id="el_jobs_stage_three_completed">
<span<?= $Page->stage_three_completed->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_stage_three_completed_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->stage_three_completed->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->stage_three_completed->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_stage_three_completed_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sow_date->Visible) { // sow_date ?>
    <tr id="r_sow_date"<?= $Page->sow_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jobs_sow_date"><?= $Page->sow_date->caption() ?></span></td>
        <td data-name="sow_date"<?= $Page->sow_date->cellAttributes() ?>>
<span id="el_jobs_sow_date">
<span<?= $Page->sow_date->viewAttributes() ?>>
<?= $Page->sow_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->plant_date->Visible) { // plant_date ?>
    <tr id="r_plant_date"<?= $Page->plant_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jobs_plant_date"><?= $Page->plant_date->caption() ?></span></td>
        <td data-name="plant_date"<?= $Page->plant_date->cellAttributes() ?>>
<span id="el_jobs_plant_date">
<span<?= $Page->plant_date->viewAttributes() ?>>
<?= $Page->plant_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->harvest_start_date->Visible) { // harvest_start_date ?>
    <tr id="r_harvest_start_date"<?= $Page->harvest_start_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jobs_harvest_start_date"><?= $Page->harvest_start_date->caption() ?></span></td>
        <td data-name="harvest_start_date"<?= $Page->harvest_start_date->cellAttributes() ?>>
<span id="el_jobs_harvest_start_date">
<span<?= $Page->harvest_start_date->viewAttributes() ?>>
<?= $Page->harvest_start_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->harvest_end_date->Visible) { // harvest_end_date ?>
    <tr id="r_harvest_end_date"<?= $Page->harvest_end_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jobs_harvest_end_date"><?= $Page->harvest_end_date->caption() ?></span></td>
        <td data-name="harvest_end_date"<?= $Page->harvest_end_date->cellAttributes() ?>>
<span id="el_jobs_harvest_end_date">
<span<?= $Page->harvest_end_date->viewAttributes() ?>>
<?= $Page->harvest_end_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
    <tr id="r_updated_at"<?= $Page->updated_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jobs_updated_at"><?= $Page->updated_at->caption() ?></span></td>
        <td data-name="updated_at"<?= $Page->updated_at->cellAttributes() ?>>
<span id="el_jobs_updated_at">
<span<?= $Page->updated_at->viewAttributes() ?>>
<?= $Page->updated_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <tr id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jobs_created_at"><?= $Page->created_at->caption() ?></span></td>
        <td data-name="created_at"<?= $Page->created_at->cellAttributes() ?>>
<span id="el_jobs_created_at">
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
