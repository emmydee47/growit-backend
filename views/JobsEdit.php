<?php

namespace PHPMaker2022\growit_2021;

// Page object
$JobsEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jobs: currentTable } });
var currentForm, currentPageID;
var fjobsedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fjobsedit = new ew.Form("fjobsedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fjobsedit;

    // Add fields
    var fields = currentTable.fields;
    fjobsedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null, ew.Validators.guid], fields.id.isInvalid],
        ["user_id", [fields.user_id.visible && fields.user_id.required ? ew.Validators.required(fields.user_id.caption) : null], fields.user_id.isInvalid],
        ["crop_id", [fields.crop_id.visible && fields.crop_id.required ? ew.Validators.required(fields.crop_id.caption) : null], fields.crop_id.isInvalid],
        ["variety", [fields.variety.visible && fields.variety.required ? ew.Validators.required(fields.variety.caption) : null], fields.variety.isInvalid],
        ["crop_type", [fields.crop_type.visible && fields.crop_type.required ? ew.Validators.required(fields.crop_type.caption) : null], fields.crop_type.isInvalid],
        ["job_type", [fields.job_type.visible && fields.job_type.required ? ew.Validators.required(fields.job_type.caption) : null], fields.job_type.isInvalid],
        ["assigned_by", [fields.assigned_by.visible && fields.assigned_by.required ? ew.Validators.required(fields.assigned_by.caption) : null], fields.assigned_by.isInvalid],
        ["_title", [fields._title.visible && fields._title.required ? ew.Validators.required(fields._title.caption) : null], fields._title.isInvalid],
        ["job_date", [fields.job_date.visible && fields.job_date.required ? ew.Validators.required(fields.job_date.caption) : null, ew.Validators.datetime(fields.job_date.clientFormatPattern)], fields.job_date.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
        ["stage_one_completed", [fields.stage_one_completed.visible && fields.stage_one_completed.required ? ew.Validators.required(fields.stage_one_completed.caption) : null], fields.stage_one_completed.isInvalid],
        ["stage_two_completed", [fields.stage_two_completed.visible && fields.stage_two_completed.required ? ew.Validators.required(fields.stage_two_completed.caption) : null], fields.stage_two_completed.isInvalid],
        ["stage_three_completed", [fields.stage_three_completed.visible && fields.stage_three_completed.required ? ew.Validators.required(fields.stage_three_completed.caption) : null], fields.stage_three_completed.isInvalid],
        ["sow_date", [fields.sow_date.visible && fields.sow_date.required ? ew.Validators.required(fields.sow_date.caption) : null, ew.Validators.datetime(fields.sow_date.clientFormatPattern)], fields.sow_date.isInvalid],
        ["plant_date", [fields.plant_date.visible && fields.plant_date.required ? ew.Validators.required(fields.plant_date.caption) : null, ew.Validators.datetime(fields.plant_date.clientFormatPattern)], fields.plant_date.isInvalid],
        ["harvest_start_date", [fields.harvest_start_date.visible && fields.harvest_start_date.required ? ew.Validators.required(fields.harvest_start_date.caption) : null, ew.Validators.datetime(fields.harvest_start_date.clientFormatPattern)], fields.harvest_start_date.isInvalid],
        ["harvest_end_date", [fields.harvest_end_date.visible && fields.harvest_end_date.required ? ew.Validators.required(fields.harvest_end_date.caption) : null, ew.Validators.datetime(fields.harvest_end_date.clientFormatPattern)], fields.harvest_end_date.isInvalid],
        ["updated_at", [fields.updated_at.visible && fields.updated_at.required ? ew.Validators.required(fields.updated_at.caption) : null, ew.Validators.datetime(fields.updated_at.clientFormatPattern)], fields.updated_at.isInvalid],
        ["created_at", [fields.created_at.visible && fields.created_at.required ? ew.Validators.required(fields.created_at.caption) : null, ew.Validators.datetime(fields.created_at.clientFormatPattern)], fields.created_at.isInvalid]
    ]);

    // Form_CustomValidate
    fjobsedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fjobsedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fjobsedit.lists.user_id = <?= $Page->user_id->toClientList($Page) ?>;
    fjobsedit.lists.crop_id = <?= $Page->crop_id->toClientList($Page) ?>;
    fjobsedit.lists.job_type = <?= $Page->job_type->toClientList($Page) ?>;
    fjobsedit.lists.status = <?= $Page->status->toClientList($Page) ?>;
    fjobsedit.lists.stage_one_completed = <?= $Page->stage_one_completed->toClientList($Page) ?>;
    fjobsedit.lists.stage_two_completed = <?= $Page->stage_two_completed->toClientList($Page) ?>;
    fjobsedit.lists.stage_three_completed = <?= $Page->stage_three_completed->toClientList($Page) ?>;
    loadjs.done("fjobsedit");
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
<form name="fjobsedit" id="fjobsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jobs">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_jobs_id" for="x_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<input type="<?= $Page->id->getInputTextType() ?>" name="x_id" id="x_id" data-table="jobs" data-field="x_id" value="<?= $Page->id->EditValue ?>" size="38" maxlength="38" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>"<?= $Page->id->editAttributes() ?> aria-describedby="x_id_help">
<?= $Page->id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage() ?></div>
<input type="hidden" data-table="jobs" data-field="x_id" data-hidden="1" name="o_id" id="o_id" value="<?= HtmlEncode($Page->id->OldValue ?? $Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
    <div id="r_user_id"<?= $Page->user_id->rowAttributes() ?>>
        <label id="elh_jobs_user_id" for="x_user_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->user_id->caption() ?><?= $Page->user_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->user_id->cellAttributes() ?>>
<span id="el_jobs_user_id">
    <select
        id="x_user_id"
        name="x_user_id"
        class="form-control ew-select<?= $Page->user_id->isInvalidClass() ?>"
        data-select2-id="fjobsedit_x_user_id"
        data-table="jobs"
        data-field="x_user_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->user_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->user_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->user_id->getPlaceHolder()) ?>"
        <?= $Page->user_id->editAttributes() ?>>
        <?= $Page->user_id->selectOptionListHtml("x_user_id") ?>
    </select>
    <?= $Page->user_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->user_id->getErrorMessage() ?></div>
<?= $Page->user_id->Lookup->getParamTag($Page, "p_x_user_id") ?>
<script>
loadjs.ready("fjobsedit", function() {
    var options = { name: "x_user_id", selectId: "fjobsedit_x_user_id" };
    if (fjobsedit.lists.user_id.lookupOptions.length) {
        options.data = { id: "x_user_id", form: "fjobsedit" };
    } else {
        options.ajax = { id: "x_user_id", form: "fjobsedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.jobs.fields.user_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->crop_id->Visible) { // crop_id ?>
    <div id="r_crop_id"<?= $Page->crop_id->rowAttributes() ?>>
        <label id="elh_jobs_crop_id" for="x_crop_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->crop_id->caption() ?><?= $Page->crop_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->crop_id->cellAttributes() ?>>
<span id="el_jobs_crop_id">
    <select
        id="x_crop_id"
        name="x_crop_id"
        class="form-control ew-select<?= $Page->crop_id->isInvalidClass() ?>"
        data-select2-id="fjobsedit_x_crop_id"
        data-table="jobs"
        data-field="x_crop_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->crop_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->crop_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->crop_id->getPlaceHolder()) ?>"
        <?= $Page->crop_id->editAttributes() ?>>
        <?= $Page->crop_id->selectOptionListHtml("x_crop_id") ?>
    </select>
    <?= $Page->crop_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->crop_id->getErrorMessage() ?></div>
<?= $Page->crop_id->Lookup->getParamTag($Page, "p_x_crop_id") ?>
<script>
loadjs.ready("fjobsedit", function() {
    var options = { name: "x_crop_id", selectId: "fjobsedit_x_crop_id" };
    if (fjobsedit.lists.crop_id.lookupOptions.length) {
        options.data = { id: "x_crop_id", form: "fjobsedit" };
    } else {
        options.ajax = { id: "x_crop_id", form: "fjobsedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.jobs.fields.crop_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->variety->Visible) { // variety ?>
    <div id="r_variety"<?= $Page->variety->rowAttributes() ?>>
        <label id="elh_jobs_variety" for="x_variety" class="<?= $Page->LeftColumnClass ?>"><?= $Page->variety->caption() ?><?= $Page->variety->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->variety->cellAttributes() ?>>
<span id="el_jobs_variety">
<input type="<?= $Page->variety->getInputTextType() ?>" name="x_variety" id="x_variety" data-table="jobs" data-field="x_variety" value="<?= $Page->variety->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->variety->getPlaceHolder()) ?>"<?= $Page->variety->editAttributes() ?> aria-describedby="x_variety_help">
<?= $Page->variety->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->variety->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->crop_type->Visible) { // crop_type ?>
    <div id="r_crop_type"<?= $Page->crop_type->rowAttributes() ?>>
        <label id="elh_jobs_crop_type" for="x_crop_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->crop_type->caption() ?><?= $Page->crop_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->crop_type->cellAttributes() ?>>
<span id="el_jobs_crop_type">
<input type="<?= $Page->crop_type->getInputTextType() ?>" name="x_crop_type" id="x_crop_type" data-table="jobs" data-field="x_crop_type" value="<?= $Page->crop_type->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->crop_type->getPlaceHolder()) ?>"<?= $Page->crop_type->editAttributes() ?> aria-describedby="x_crop_type_help">
<?= $Page->crop_type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->crop_type->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->job_type->Visible) { // job_type ?>
    <div id="r_job_type"<?= $Page->job_type->rowAttributes() ?>>
        <label id="elh_jobs_job_type" for="x_job_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->job_type->caption() ?><?= $Page->job_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->job_type->cellAttributes() ?>>
<span id="el_jobs_job_type">
    <select
        id="x_job_type"
        name="x_job_type"
        class="form-select ew-select<?= $Page->job_type->isInvalidClass() ?>"
        data-select2-id="fjobsedit_x_job_type"
        data-table="jobs"
        data-field="x_job_type"
        data-value-separator="<?= $Page->job_type->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->job_type->getPlaceHolder()) ?>"
        <?= $Page->job_type->editAttributes() ?>>
        <?= $Page->job_type->selectOptionListHtml("x_job_type") ?>
    </select>
    <?= $Page->job_type->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->job_type->getErrorMessage() ?></div>
<script>
loadjs.ready("fjobsedit", function() {
    var options = { name: "x_job_type", selectId: "fjobsedit_x_job_type" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjobsedit.lists.job_type.lookupOptions.length) {
        options.data = { id: "x_job_type", form: "fjobsedit" };
    } else {
        options.ajax = { id: "x_job_type", form: "fjobsedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jobs.fields.job_type.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->assigned_by->Visible) { // assigned_by ?>
    <div id="r_assigned_by"<?= $Page->assigned_by->rowAttributes() ?>>
        <label id="elh_jobs_assigned_by" for="x_assigned_by" class="<?= $Page->LeftColumnClass ?>"><?= $Page->assigned_by->caption() ?><?= $Page->assigned_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->assigned_by->cellAttributes() ?>>
<span id="el_jobs_assigned_by">
<input type="<?= $Page->assigned_by->getInputTextType() ?>" name="x_assigned_by" id="x_assigned_by" data-table="jobs" data-field="x_assigned_by" value="<?= $Page->assigned_by->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->assigned_by->getPlaceHolder()) ?>"<?= $Page->assigned_by->editAttributes() ?> aria-describedby="x_assigned_by_help">
<?= $Page->assigned_by->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->assigned_by->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_title->Visible) { // title ?>
    <div id="r__title"<?= $Page->_title->rowAttributes() ?>>
        <label id="elh_jobs__title" for="x__title" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_title->caption() ?><?= $Page->_title->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_title->cellAttributes() ?>>
<span id="el_jobs__title">
<input type="<?= $Page->_title->getInputTextType() ?>" name="x__title" id="x__title" data-table="jobs" data-field="x__title" value="<?= $Page->_title->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_title->getPlaceHolder()) ?>"<?= $Page->_title->editAttributes() ?> aria-describedby="x__title_help">
<?= $Page->_title->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_title->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->job_date->Visible) { // job_date ?>
    <div id="r_job_date"<?= $Page->job_date->rowAttributes() ?>>
        <label id="elh_jobs_job_date" for="x_job_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->job_date->caption() ?><?= $Page->job_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->job_date->cellAttributes() ?>>
<span id="el_jobs_job_date">
<input type="<?= $Page->job_date->getInputTextType() ?>" name="x_job_date" id="x_job_date" data-table="jobs" data-field="x_job_date" value="<?= $Page->job_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->job_date->getPlaceHolder()) ?>"<?= $Page->job_date->editAttributes() ?> aria-describedby="x_job_date_help">
<?= $Page->job_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->job_date->getErrorMessage() ?></div>
<?php if (!$Page->job_date->ReadOnly && !$Page->job_date->Disabled && !isset($Page->job_date->EditAttrs["readonly"]) && !isset($Page->job_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjobsedit", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID
            },
            display: {
                components: {
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i)
                },
                icons: {
                    previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                    next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
                }
            },
            meta: {
                format,
                numberingSystem: ew.getNumberingSystem()
            }
        };
    ew.createDateTimePicker("fjobsedit", "x_job_date", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status"<?= $Page->status->rowAttributes() ?>>
        <label id="elh_jobs_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status->cellAttributes() ?>>
<span id="el_jobs_status">
    <select
        id="x_status"
        name="x_status"
        class="form-select ew-select<?= $Page->status->isInvalidClass() ?>"
        data-select2-id="fjobsedit_x_status"
        data-table="jobs"
        data-field="x_status"
        data-value-separator="<?= $Page->status->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>"
        <?= $Page->status->editAttributes() ?>>
        <?= $Page->status->selectOptionListHtml("x_status") ?>
    </select>
    <?= $Page->status->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
<script>
loadjs.ready("fjobsedit", function() {
    var options = { name: "x_status", selectId: "fjobsedit_x_status" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjobsedit.lists.status.lookupOptions.length) {
        options.data = { id: "x_status", form: "fjobsedit" };
    } else {
        options.ajax = { id: "x_status", form: "fjobsedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jobs.fields.status.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->stage_one_completed->Visible) { // stage_one_completed ?>
    <div id="r_stage_one_completed"<?= $Page->stage_one_completed->rowAttributes() ?>>
        <label id="elh_jobs_stage_one_completed" class="<?= $Page->LeftColumnClass ?>"><?= $Page->stage_one_completed->caption() ?><?= $Page->stage_one_completed->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->stage_one_completed->cellAttributes() ?>>
<span id="el_jobs_stage_one_completed">
<div class="form-check d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->stage_one_completed->isInvalidClass() ?>" data-table="jobs" data-field="x_stage_one_completed" name="x_stage_one_completed[]" id="x_stage_one_completed_402877" value="1"<?= ConvertToBool($Page->stage_one_completed->CurrentValue) ? " checked" : "" ?><?= $Page->stage_one_completed->editAttributes() ?> aria-describedby="x_stage_one_completed_help">
    <div class="invalid-feedback"><?= $Page->stage_one_completed->getErrorMessage() ?></div>
</div>
<?= $Page->stage_one_completed->getCustomMessage() ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->stage_two_completed->Visible) { // stage_two_completed ?>
    <div id="r_stage_two_completed"<?= $Page->stage_two_completed->rowAttributes() ?>>
        <label id="elh_jobs_stage_two_completed" class="<?= $Page->LeftColumnClass ?>"><?= $Page->stage_two_completed->caption() ?><?= $Page->stage_two_completed->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->stage_two_completed->cellAttributes() ?>>
<span id="el_jobs_stage_two_completed">
<div class="form-check d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->stage_two_completed->isInvalidClass() ?>" data-table="jobs" data-field="x_stage_two_completed" name="x_stage_two_completed[]" id="x_stage_two_completed_228424" value="1"<?= ConvertToBool($Page->stage_two_completed->CurrentValue) ? " checked" : "" ?><?= $Page->stage_two_completed->editAttributes() ?> aria-describedby="x_stage_two_completed_help">
    <div class="invalid-feedback"><?= $Page->stage_two_completed->getErrorMessage() ?></div>
</div>
<?= $Page->stage_two_completed->getCustomMessage() ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->stage_three_completed->Visible) { // stage_three_completed ?>
    <div id="r_stage_three_completed"<?= $Page->stage_three_completed->rowAttributes() ?>>
        <label id="elh_jobs_stage_three_completed" class="<?= $Page->LeftColumnClass ?>"><?= $Page->stage_three_completed->caption() ?><?= $Page->stage_three_completed->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->stage_three_completed->cellAttributes() ?>>
<span id="el_jobs_stage_three_completed">
<div class="form-check d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->stage_three_completed->isInvalidClass() ?>" data-table="jobs" data-field="x_stage_three_completed" name="x_stage_three_completed[]" id="x_stage_three_completed_950697" value="1"<?= ConvertToBool($Page->stage_three_completed->CurrentValue) ? " checked" : "" ?><?= $Page->stage_three_completed->editAttributes() ?> aria-describedby="x_stage_three_completed_help">
    <div class="invalid-feedback"><?= $Page->stage_three_completed->getErrorMessage() ?></div>
</div>
<?= $Page->stage_three_completed->getCustomMessage() ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sow_date->Visible) { // sow_date ?>
    <div id="r_sow_date"<?= $Page->sow_date->rowAttributes() ?>>
        <label id="elh_jobs_sow_date" for="x_sow_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sow_date->caption() ?><?= $Page->sow_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sow_date->cellAttributes() ?>>
<span id="el_jobs_sow_date">
<input type="<?= $Page->sow_date->getInputTextType() ?>" name="x_sow_date" id="x_sow_date" data-table="jobs" data-field="x_sow_date" value="<?= $Page->sow_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->sow_date->getPlaceHolder()) ?>"<?= $Page->sow_date->editAttributes() ?> aria-describedby="x_sow_date_help">
<?= $Page->sow_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sow_date->getErrorMessage() ?></div>
<?php if (!$Page->sow_date->ReadOnly && !$Page->sow_date->Disabled && !isset($Page->sow_date->EditAttrs["readonly"]) && !isset($Page->sow_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjobsedit", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID
            },
            display: {
                components: {
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i)
                },
                icons: {
                    previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                    next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
                }
            },
            meta: {
                format,
                numberingSystem: ew.getNumberingSystem()
            }
        };
    ew.createDateTimePicker("fjobsedit", "x_sow_date", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->plant_date->Visible) { // plant_date ?>
    <div id="r_plant_date"<?= $Page->plant_date->rowAttributes() ?>>
        <label id="elh_jobs_plant_date" for="x_plant_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->plant_date->caption() ?><?= $Page->plant_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->plant_date->cellAttributes() ?>>
<span id="el_jobs_plant_date">
<input type="<?= $Page->plant_date->getInputTextType() ?>" name="x_plant_date" id="x_plant_date" data-table="jobs" data-field="x_plant_date" value="<?= $Page->plant_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->plant_date->getPlaceHolder()) ?>"<?= $Page->plant_date->editAttributes() ?> aria-describedby="x_plant_date_help">
<?= $Page->plant_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->plant_date->getErrorMessage() ?></div>
<?php if (!$Page->plant_date->ReadOnly && !$Page->plant_date->Disabled && !isset($Page->plant_date->EditAttrs["readonly"]) && !isset($Page->plant_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjobsedit", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID
            },
            display: {
                components: {
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i)
                },
                icons: {
                    previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                    next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
                }
            },
            meta: {
                format,
                numberingSystem: ew.getNumberingSystem()
            }
        };
    ew.createDateTimePicker("fjobsedit", "x_plant_date", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->harvest_start_date->Visible) { // harvest_start_date ?>
    <div id="r_harvest_start_date"<?= $Page->harvest_start_date->rowAttributes() ?>>
        <label id="elh_jobs_harvest_start_date" for="x_harvest_start_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->harvest_start_date->caption() ?><?= $Page->harvest_start_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->harvest_start_date->cellAttributes() ?>>
<span id="el_jobs_harvest_start_date">
<input type="<?= $Page->harvest_start_date->getInputTextType() ?>" name="x_harvest_start_date" id="x_harvest_start_date" data-table="jobs" data-field="x_harvest_start_date" value="<?= $Page->harvest_start_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->harvest_start_date->getPlaceHolder()) ?>"<?= $Page->harvest_start_date->editAttributes() ?> aria-describedby="x_harvest_start_date_help">
<?= $Page->harvest_start_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->harvest_start_date->getErrorMessage() ?></div>
<?php if (!$Page->harvest_start_date->ReadOnly && !$Page->harvest_start_date->Disabled && !isset($Page->harvest_start_date->EditAttrs["readonly"]) && !isset($Page->harvest_start_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjobsedit", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID
            },
            display: {
                components: {
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i)
                },
                icons: {
                    previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                    next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
                }
            },
            meta: {
                format,
                numberingSystem: ew.getNumberingSystem()
            }
        };
    ew.createDateTimePicker("fjobsedit", "x_harvest_start_date", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->harvest_end_date->Visible) { // harvest_end_date ?>
    <div id="r_harvest_end_date"<?= $Page->harvest_end_date->rowAttributes() ?>>
        <label id="elh_jobs_harvest_end_date" for="x_harvest_end_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->harvest_end_date->caption() ?><?= $Page->harvest_end_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->harvest_end_date->cellAttributes() ?>>
<span id="el_jobs_harvest_end_date">
<input type="<?= $Page->harvest_end_date->getInputTextType() ?>" name="x_harvest_end_date" id="x_harvest_end_date" data-table="jobs" data-field="x_harvest_end_date" value="<?= $Page->harvest_end_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->harvest_end_date->getPlaceHolder()) ?>"<?= $Page->harvest_end_date->editAttributes() ?> aria-describedby="x_harvest_end_date_help">
<?= $Page->harvest_end_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->harvest_end_date->getErrorMessage() ?></div>
<?php if (!$Page->harvest_end_date->ReadOnly && !$Page->harvest_end_date->Disabled && !isset($Page->harvest_end_date->EditAttrs["readonly"]) && !isset($Page->harvest_end_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjobsedit", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID
            },
            display: {
                components: {
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i)
                },
                icons: {
                    previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                    next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
                }
            },
            meta: {
                format,
                numberingSystem: ew.getNumberingSystem()
            }
        };
    ew.createDateTimePicker("fjobsedit", "x_harvest_end_date", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
    <div id="r_updated_at"<?= $Page->updated_at->rowAttributes() ?>>
        <label id="elh_jobs_updated_at" for="x_updated_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->updated_at->caption() ?><?= $Page->updated_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->updated_at->cellAttributes() ?>>
<span id="el_jobs_updated_at">
<input type="<?= $Page->updated_at->getInputTextType() ?>" name="x_updated_at" id="x_updated_at" data-table="jobs" data-field="x_updated_at" value="<?= $Page->updated_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->updated_at->getPlaceHolder()) ?>"<?= $Page->updated_at->editAttributes() ?> aria-describedby="x_updated_at_help">
<?= $Page->updated_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->updated_at->getErrorMessage() ?></div>
<?php if (!$Page->updated_at->ReadOnly && !$Page->updated_at->Disabled && !isset($Page->updated_at->EditAttrs["readonly"]) && !isset($Page->updated_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjobsedit", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID
            },
            display: {
                components: {
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i)
                },
                icons: {
                    previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                    next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
                }
            },
            meta: {
                format,
                numberingSystem: ew.getNumberingSystem()
            }
        };
    ew.createDateTimePicker("fjobsedit", "x_updated_at", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <div id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <label id="elh_jobs_created_at" for="x_created_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_at->caption() ?><?= $Page->created_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_at->cellAttributes() ?>>
<span id="el_jobs_created_at">
<input type="<?= $Page->created_at->getInputTextType() ?>" name="x_created_at" id="x_created_at" data-table="jobs" data-field="x_created_at" value="<?= $Page->created_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->created_at->getPlaceHolder()) ?>"<?= $Page->created_at->editAttributes() ?> aria-describedby="x_created_at_help">
<?= $Page->created_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_at->getErrorMessage() ?></div>
<?php if (!$Page->created_at->ReadOnly && !$Page->created_at->Disabled && !isset($Page->created_at->EditAttrs["readonly"]) && !isset($Page->created_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjobsedit", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID
            },
            display: {
                components: {
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i)
                },
                icons: {
                    previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                    next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
                }
            },
            meta: {
                format,
                numberingSystem: ew.getNumberingSystem()
            }
        };
    ew.createDateTimePicker("fjobsedit", "x_created_at", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .row -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("jobs");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
