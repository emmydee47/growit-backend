<?php

namespace PHPMaker2022\growit_2021;

// Page object
$CropMonthsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { crop_months: currentTable } });
var currentForm, currentPageID;
var fcrop_monthsadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcrop_monthsadd = new ew.Form("fcrop_monthsadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fcrop_monthsadd;

    // Add fields
    var fields = currentTable.fields;
    fcrop_monthsadd.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null, ew.Validators.guid], fields.id.isInvalid],
        ["crop_id", [fields.crop_id.visible && fields.crop_id.required ? ew.Validators.required(fields.crop_id.caption) : null], fields.crop_id.isInvalid],
        ["sow_under_cover_from", [fields.sow_under_cover_from.visible && fields.sow_under_cover_from.required ? ew.Validators.required(fields.sow_under_cover_from.caption) : null], fields.sow_under_cover_from.isInvalid],
        ["sow_under_cover_to", [fields.sow_under_cover_to.visible && fields.sow_under_cover_to.required ? ew.Validators.required(fields.sow_under_cover_to.caption) : null], fields.sow_under_cover_to.isInvalid],
        ["sow_direct_from", [fields.sow_direct_from.visible && fields.sow_direct_from.required ? ew.Validators.required(fields.sow_direct_from.caption) : null], fields.sow_direct_from.isInvalid],
        ["sow_direct_to", [fields.sow_direct_to.visible && fields.sow_direct_to.required ? ew.Validators.required(fields.sow_direct_to.caption) : null], fields.sow_direct_to.isInvalid],
        ["plant_start_month", [fields.plant_start_month.visible && fields.plant_start_month.required ? ew.Validators.required(fields.plant_start_month.caption) : null], fields.plant_start_month.isInvalid],
        ["plant_end_month", [fields.plant_end_month.visible && fields.plant_end_month.required ? ew.Validators.required(fields.plant_end_month.caption) : null], fields.plant_end_month.isInvalid],
        ["harvest_start_month", [fields.harvest_start_month.visible && fields.harvest_start_month.required ? ew.Validators.required(fields.harvest_start_month.caption) : null], fields.harvest_start_month.isInvalid],
        ["harvest_end_month", [fields.harvest_end_month.visible && fields.harvest_end_month.required ? ew.Validators.required(fields.harvest_end_month.caption) : null], fields.harvest_end_month.isInvalid],
        ["updated_at", [fields.updated_at.visible && fields.updated_at.required ? ew.Validators.required(fields.updated_at.caption) : null, ew.Validators.datetime(fields.updated_at.clientFormatPattern)], fields.updated_at.isInvalid],
        ["created_at", [fields.created_at.visible && fields.created_at.required ? ew.Validators.required(fields.created_at.caption) : null, ew.Validators.datetime(fields.created_at.clientFormatPattern)], fields.created_at.isInvalid]
    ]);

    // Form_CustomValidate
    fcrop_monthsadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fcrop_monthsadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fcrop_monthsadd.lists.crop_id = <?= $Page->crop_id->toClientList($Page) ?>;
    fcrop_monthsadd.lists.sow_under_cover_from = <?= $Page->sow_under_cover_from->toClientList($Page) ?>;
    fcrop_monthsadd.lists.sow_under_cover_to = <?= $Page->sow_under_cover_to->toClientList($Page) ?>;
    fcrop_monthsadd.lists.sow_direct_from = <?= $Page->sow_direct_from->toClientList($Page) ?>;
    fcrop_monthsadd.lists.sow_direct_to = <?= $Page->sow_direct_to->toClientList($Page) ?>;
    fcrop_monthsadd.lists.plant_start_month = <?= $Page->plant_start_month->toClientList($Page) ?>;
    fcrop_monthsadd.lists.plant_end_month = <?= $Page->plant_end_month->toClientList($Page) ?>;
    fcrop_monthsadd.lists.harvest_start_month = <?= $Page->harvest_start_month->toClientList($Page) ?>;
    fcrop_monthsadd.lists.harvest_end_month = <?= $Page->harvest_end_month->toClientList($Page) ?>;
    loadjs.done("fcrop_monthsadd");
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
<form name="fcrop_monthsadd" id="fcrop_monthsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="crop_months">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_crop_months_id" for="x_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_crop_months_id">
<input type="<?= $Page->id->getInputTextType() ?>" name="x_id" id="x_id" data-table="crop_months" data-field="x_id" value="<?= $Page->id->EditValue ?>" size="38" maxlength="38" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>"<?= $Page->id->editAttributes() ?> aria-describedby="x_id_help">
<?= $Page->id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->crop_id->Visible) { // crop_id ?>
    <div id="r_crop_id"<?= $Page->crop_id->rowAttributes() ?>>
        <label id="elh_crop_months_crop_id" for="x_crop_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->crop_id->caption() ?><?= $Page->crop_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->crop_id->cellAttributes() ?>>
<span id="el_crop_months_crop_id">
    <select
        id="x_crop_id"
        name="x_crop_id"
        class="form-control ew-select<?= $Page->crop_id->isInvalidClass() ?>"
        data-select2-id="fcrop_monthsadd_x_crop_id"
        data-table="crop_months"
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
loadjs.ready("fcrop_monthsadd", function() {
    var options = { name: "x_crop_id", selectId: "fcrop_monthsadd_x_crop_id" };
    if (fcrop_monthsadd.lists.crop_id.lookupOptions.length) {
        options.data = { id: "x_crop_id", form: "fcrop_monthsadd" };
    } else {
        options.ajax = { id: "x_crop_id", form: "fcrop_monthsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.crop_months.fields.crop_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sow_under_cover_from->Visible) { // sow_under_cover_from ?>
    <div id="r_sow_under_cover_from"<?= $Page->sow_under_cover_from->rowAttributes() ?>>
        <label id="elh_crop_months_sow_under_cover_from" for="x_sow_under_cover_from" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sow_under_cover_from->caption() ?><?= $Page->sow_under_cover_from->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sow_under_cover_from->cellAttributes() ?>>
<span id="el_crop_months_sow_under_cover_from">
    <select
        id="x_sow_under_cover_from"
        name="x_sow_under_cover_from"
        class="form-select ew-select<?= $Page->sow_under_cover_from->isInvalidClass() ?>"
        data-select2-id="fcrop_monthsadd_x_sow_under_cover_from"
        data-table="crop_months"
        data-field="x_sow_under_cover_from"
        data-value-separator="<?= $Page->sow_under_cover_from->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->sow_under_cover_from->getPlaceHolder()) ?>"
        <?= $Page->sow_under_cover_from->editAttributes() ?>>
        <?= $Page->sow_under_cover_from->selectOptionListHtml("x_sow_under_cover_from") ?>
    </select>
    <?= $Page->sow_under_cover_from->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->sow_under_cover_from->getErrorMessage() ?></div>
<script>
loadjs.ready("fcrop_monthsadd", function() {
    var options = { name: "x_sow_under_cover_from", selectId: "fcrop_monthsadd_x_sow_under_cover_from" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcrop_monthsadd.lists.sow_under_cover_from.lookupOptions.length) {
        options.data = { id: "x_sow_under_cover_from", form: "fcrop_monthsadd" };
    } else {
        options.ajax = { id: "x_sow_under_cover_from", form: "fcrop_monthsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.crop_months.fields.sow_under_cover_from.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sow_under_cover_to->Visible) { // sow_under_cover_to ?>
    <div id="r_sow_under_cover_to"<?= $Page->sow_under_cover_to->rowAttributes() ?>>
        <label id="elh_crop_months_sow_under_cover_to" for="x_sow_under_cover_to" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sow_under_cover_to->caption() ?><?= $Page->sow_under_cover_to->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sow_under_cover_to->cellAttributes() ?>>
<span id="el_crop_months_sow_under_cover_to">
    <select
        id="x_sow_under_cover_to"
        name="x_sow_under_cover_to"
        class="form-select ew-select<?= $Page->sow_under_cover_to->isInvalidClass() ?>"
        data-select2-id="fcrop_monthsadd_x_sow_under_cover_to"
        data-table="crop_months"
        data-field="x_sow_under_cover_to"
        data-value-separator="<?= $Page->sow_under_cover_to->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->sow_under_cover_to->getPlaceHolder()) ?>"
        <?= $Page->sow_under_cover_to->editAttributes() ?>>
        <?= $Page->sow_under_cover_to->selectOptionListHtml("x_sow_under_cover_to") ?>
    </select>
    <?= $Page->sow_under_cover_to->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->sow_under_cover_to->getErrorMessage() ?></div>
<script>
loadjs.ready("fcrop_monthsadd", function() {
    var options = { name: "x_sow_under_cover_to", selectId: "fcrop_monthsadd_x_sow_under_cover_to" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcrop_monthsadd.lists.sow_under_cover_to.lookupOptions.length) {
        options.data = { id: "x_sow_under_cover_to", form: "fcrop_monthsadd" };
    } else {
        options.ajax = { id: "x_sow_under_cover_to", form: "fcrop_monthsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.crop_months.fields.sow_under_cover_to.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sow_direct_from->Visible) { // sow_direct_from ?>
    <div id="r_sow_direct_from"<?= $Page->sow_direct_from->rowAttributes() ?>>
        <label id="elh_crop_months_sow_direct_from" for="x_sow_direct_from" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sow_direct_from->caption() ?><?= $Page->sow_direct_from->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sow_direct_from->cellAttributes() ?>>
<span id="el_crop_months_sow_direct_from">
    <select
        id="x_sow_direct_from"
        name="x_sow_direct_from"
        class="form-select ew-select<?= $Page->sow_direct_from->isInvalidClass() ?>"
        data-select2-id="fcrop_monthsadd_x_sow_direct_from"
        data-table="crop_months"
        data-field="x_sow_direct_from"
        data-value-separator="<?= $Page->sow_direct_from->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->sow_direct_from->getPlaceHolder()) ?>"
        <?= $Page->sow_direct_from->editAttributes() ?>>
        <?= $Page->sow_direct_from->selectOptionListHtml("x_sow_direct_from") ?>
    </select>
    <?= $Page->sow_direct_from->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->sow_direct_from->getErrorMessage() ?></div>
<script>
loadjs.ready("fcrop_monthsadd", function() {
    var options = { name: "x_sow_direct_from", selectId: "fcrop_monthsadd_x_sow_direct_from" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcrop_monthsadd.lists.sow_direct_from.lookupOptions.length) {
        options.data = { id: "x_sow_direct_from", form: "fcrop_monthsadd" };
    } else {
        options.ajax = { id: "x_sow_direct_from", form: "fcrop_monthsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.crop_months.fields.sow_direct_from.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sow_direct_to->Visible) { // sow_direct_to ?>
    <div id="r_sow_direct_to"<?= $Page->sow_direct_to->rowAttributes() ?>>
        <label id="elh_crop_months_sow_direct_to" for="x_sow_direct_to" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sow_direct_to->caption() ?><?= $Page->sow_direct_to->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sow_direct_to->cellAttributes() ?>>
<span id="el_crop_months_sow_direct_to">
    <select
        id="x_sow_direct_to"
        name="x_sow_direct_to"
        class="form-select ew-select<?= $Page->sow_direct_to->isInvalidClass() ?>"
        data-select2-id="fcrop_monthsadd_x_sow_direct_to"
        data-table="crop_months"
        data-field="x_sow_direct_to"
        data-value-separator="<?= $Page->sow_direct_to->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->sow_direct_to->getPlaceHolder()) ?>"
        <?= $Page->sow_direct_to->editAttributes() ?>>
        <?= $Page->sow_direct_to->selectOptionListHtml("x_sow_direct_to") ?>
    </select>
    <?= $Page->sow_direct_to->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->sow_direct_to->getErrorMessage() ?></div>
<script>
loadjs.ready("fcrop_monthsadd", function() {
    var options = { name: "x_sow_direct_to", selectId: "fcrop_monthsadd_x_sow_direct_to" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcrop_monthsadd.lists.sow_direct_to.lookupOptions.length) {
        options.data = { id: "x_sow_direct_to", form: "fcrop_monthsadd" };
    } else {
        options.ajax = { id: "x_sow_direct_to", form: "fcrop_monthsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.crop_months.fields.sow_direct_to.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->plant_start_month->Visible) { // plant_start_month ?>
    <div id="r_plant_start_month"<?= $Page->plant_start_month->rowAttributes() ?>>
        <label id="elh_crop_months_plant_start_month" for="x_plant_start_month" class="<?= $Page->LeftColumnClass ?>"><?= $Page->plant_start_month->caption() ?><?= $Page->plant_start_month->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->plant_start_month->cellAttributes() ?>>
<span id="el_crop_months_plant_start_month">
    <select
        id="x_plant_start_month"
        name="x_plant_start_month"
        class="form-select ew-select<?= $Page->plant_start_month->isInvalidClass() ?>"
        data-select2-id="fcrop_monthsadd_x_plant_start_month"
        data-table="crop_months"
        data-field="x_plant_start_month"
        data-value-separator="<?= $Page->plant_start_month->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->plant_start_month->getPlaceHolder()) ?>"
        <?= $Page->plant_start_month->editAttributes() ?>>
        <?= $Page->plant_start_month->selectOptionListHtml("x_plant_start_month") ?>
    </select>
    <?= $Page->plant_start_month->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->plant_start_month->getErrorMessage() ?></div>
<script>
loadjs.ready("fcrop_monthsadd", function() {
    var options = { name: "x_plant_start_month", selectId: "fcrop_monthsadd_x_plant_start_month" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcrop_monthsadd.lists.plant_start_month.lookupOptions.length) {
        options.data = { id: "x_plant_start_month", form: "fcrop_monthsadd" };
    } else {
        options.ajax = { id: "x_plant_start_month", form: "fcrop_monthsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.crop_months.fields.plant_start_month.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->plant_end_month->Visible) { // plant_end_month ?>
    <div id="r_plant_end_month"<?= $Page->plant_end_month->rowAttributes() ?>>
        <label id="elh_crop_months_plant_end_month" for="x_plant_end_month" class="<?= $Page->LeftColumnClass ?>"><?= $Page->plant_end_month->caption() ?><?= $Page->plant_end_month->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->plant_end_month->cellAttributes() ?>>
<span id="el_crop_months_plant_end_month">
    <select
        id="x_plant_end_month"
        name="x_plant_end_month"
        class="form-select ew-select<?= $Page->plant_end_month->isInvalidClass() ?>"
        data-select2-id="fcrop_monthsadd_x_plant_end_month"
        data-table="crop_months"
        data-field="x_plant_end_month"
        data-value-separator="<?= $Page->plant_end_month->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->plant_end_month->getPlaceHolder()) ?>"
        <?= $Page->plant_end_month->editAttributes() ?>>
        <?= $Page->plant_end_month->selectOptionListHtml("x_plant_end_month") ?>
    </select>
    <?= $Page->plant_end_month->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->plant_end_month->getErrorMessage() ?></div>
<script>
loadjs.ready("fcrop_monthsadd", function() {
    var options = { name: "x_plant_end_month", selectId: "fcrop_monthsadd_x_plant_end_month" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcrop_monthsadd.lists.plant_end_month.lookupOptions.length) {
        options.data = { id: "x_plant_end_month", form: "fcrop_monthsadd" };
    } else {
        options.ajax = { id: "x_plant_end_month", form: "fcrop_monthsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.crop_months.fields.plant_end_month.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->harvest_start_month->Visible) { // harvest_start_month ?>
    <div id="r_harvest_start_month"<?= $Page->harvest_start_month->rowAttributes() ?>>
        <label id="elh_crop_months_harvest_start_month" for="x_harvest_start_month" class="<?= $Page->LeftColumnClass ?>"><?= $Page->harvest_start_month->caption() ?><?= $Page->harvest_start_month->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->harvest_start_month->cellAttributes() ?>>
<span id="el_crop_months_harvest_start_month">
    <select
        id="x_harvest_start_month"
        name="x_harvest_start_month"
        class="form-select ew-select<?= $Page->harvest_start_month->isInvalidClass() ?>"
        data-select2-id="fcrop_monthsadd_x_harvest_start_month"
        data-table="crop_months"
        data-field="x_harvest_start_month"
        data-value-separator="<?= $Page->harvest_start_month->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->harvest_start_month->getPlaceHolder()) ?>"
        <?= $Page->harvest_start_month->editAttributes() ?>>
        <?= $Page->harvest_start_month->selectOptionListHtml("x_harvest_start_month") ?>
    </select>
    <?= $Page->harvest_start_month->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->harvest_start_month->getErrorMessage() ?></div>
<script>
loadjs.ready("fcrop_monthsadd", function() {
    var options = { name: "x_harvest_start_month", selectId: "fcrop_monthsadd_x_harvest_start_month" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcrop_monthsadd.lists.harvest_start_month.lookupOptions.length) {
        options.data = { id: "x_harvest_start_month", form: "fcrop_monthsadd" };
    } else {
        options.ajax = { id: "x_harvest_start_month", form: "fcrop_monthsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.crop_months.fields.harvest_start_month.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->harvest_end_month->Visible) { // harvest_end_month ?>
    <div id="r_harvest_end_month"<?= $Page->harvest_end_month->rowAttributes() ?>>
        <label id="elh_crop_months_harvest_end_month" for="x_harvest_end_month" class="<?= $Page->LeftColumnClass ?>"><?= $Page->harvest_end_month->caption() ?><?= $Page->harvest_end_month->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->harvest_end_month->cellAttributes() ?>>
<span id="el_crop_months_harvest_end_month">
    <select
        id="x_harvest_end_month"
        name="x_harvest_end_month"
        class="form-select ew-select<?= $Page->harvest_end_month->isInvalidClass() ?>"
        data-select2-id="fcrop_monthsadd_x_harvest_end_month"
        data-table="crop_months"
        data-field="x_harvest_end_month"
        data-value-separator="<?= $Page->harvest_end_month->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->harvest_end_month->getPlaceHolder()) ?>"
        <?= $Page->harvest_end_month->editAttributes() ?>>
        <?= $Page->harvest_end_month->selectOptionListHtml("x_harvest_end_month") ?>
    </select>
    <?= $Page->harvest_end_month->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->harvest_end_month->getErrorMessage() ?></div>
<script>
loadjs.ready("fcrop_monthsadd", function() {
    var options = { name: "x_harvest_end_month", selectId: "fcrop_monthsadd_x_harvest_end_month" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcrop_monthsadd.lists.harvest_end_month.lookupOptions.length) {
        options.data = { id: "x_harvest_end_month", form: "fcrop_monthsadd" };
    } else {
        options.ajax = { id: "x_harvest_end_month", form: "fcrop_monthsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.crop_months.fields.harvest_end_month.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
    <div id="r_updated_at"<?= $Page->updated_at->rowAttributes() ?>>
        <label id="elh_crop_months_updated_at" for="x_updated_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->updated_at->caption() ?><?= $Page->updated_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->updated_at->cellAttributes() ?>>
<span id="el_crop_months_updated_at">
<input type="<?= $Page->updated_at->getInputTextType() ?>" name="x_updated_at" id="x_updated_at" data-table="crop_months" data-field="x_updated_at" value="<?= $Page->updated_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->updated_at->getPlaceHolder()) ?>"<?= $Page->updated_at->editAttributes() ?> aria-describedby="x_updated_at_help">
<?= $Page->updated_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->updated_at->getErrorMessage() ?></div>
<?php if (!$Page->updated_at->ReadOnly && !$Page->updated_at->Disabled && !isset($Page->updated_at->EditAttrs["readonly"]) && !isset($Page->updated_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcrop_monthsadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fcrop_monthsadd", "x_updated_at", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <div id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <label id="elh_crop_months_created_at" for="x_created_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_at->caption() ?><?= $Page->created_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_at->cellAttributes() ?>>
<span id="el_crop_months_created_at">
<input type="<?= $Page->created_at->getInputTextType() ?>" name="x_created_at" id="x_created_at" data-table="crop_months" data-field="x_created_at" value="<?= $Page->created_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->created_at->getPlaceHolder()) ?>"<?= $Page->created_at->editAttributes() ?> aria-describedby="x_created_at_help">
<?= $Page->created_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_at->getErrorMessage() ?></div>
<?php if (!$Page->created_at->ReadOnly && !$Page->created_at->Disabled && !isset($Page->created_at->EditAttrs["readonly"]) && !isset($Page->created_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcrop_monthsadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fcrop_monthsadd", "x_created_at", jQuery.extend(true, {"useCurrent":false}, options));
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
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
    ew.addEventHandlers("crop_months");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
