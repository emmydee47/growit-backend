<?php

namespace PHPMaker2022\growit_2021;

// Page object
$JobHistoriesEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { job_histories: currentTable } });
var currentForm, currentPageID;
var fjob_historiesedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fjob_historiesedit = new ew.Form("fjob_historiesedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fjob_historiesedit;

    // Add fields
    var fields = currentTable.fields;
    fjob_historiesedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null, ew.Validators.guid], fields.id.isInvalid],
        ["user_id", [fields.user_id.visible && fields.user_id.required ? ew.Validators.required(fields.user_id.caption) : null], fields.user_id.isInvalid],
        ["job_id", [fields.job_id.visible && fields.job_id.required ? ew.Validators.required(fields.job_id.caption) : null], fields.job_id.isInvalid],
        ["job_type", [fields.job_type.visible && fields.job_type.required ? ew.Validators.required(fields.job_type.caption) : null], fields.job_type.isInvalid],
        ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid],
        ["job_date", [fields.job_date.visible && fields.job_date.required ? ew.Validators.required(fields.job_date.caption) : null, ew.Validators.datetime(fields.job_date.clientFormatPattern)], fields.job_date.isInvalid],
        ["updated_at", [fields.updated_at.visible && fields.updated_at.required ? ew.Validators.required(fields.updated_at.caption) : null, ew.Validators.datetime(fields.updated_at.clientFormatPattern)], fields.updated_at.isInvalid],
        ["created_at", [fields.created_at.visible && fields.created_at.required ? ew.Validators.required(fields.created_at.caption) : null, ew.Validators.datetime(fields.created_at.clientFormatPattern)], fields.created_at.isInvalid]
    ]);

    // Form_CustomValidate
    fjob_historiesedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fjob_historiesedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fjob_historiesedit.lists.user_id = <?= $Page->user_id->toClientList($Page) ?>;
    fjob_historiesedit.lists.job_id = <?= $Page->job_id->toClientList($Page) ?>;
    fjob_historiesedit.lists.job_type = <?= $Page->job_type->toClientList($Page) ?>;
    loadjs.done("fjob_historiesedit");
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
<form name="fjob_historiesedit" id="fjob_historiesedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="job_histories">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_job_histories_id" for="x_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<input type="<?= $Page->id->getInputTextType() ?>" name="x_id" id="x_id" data-table="job_histories" data-field="x_id" value="<?= $Page->id->EditValue ?>" size="38" maxlength="38" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>"<?= $Page->id->editAttributes() ?> aria-describedby="x_id_help">
<?= $Page->id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage() ?></div>
<input type="hidden" data-table="job_histories" data-field="x_id" data-hidden="1" name="o_id" id="o_id" value="<?= HtmlEncode($Page->id->OldValue ?? $Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
    <div id="r_user_id"<?= $Page->user_id->rowAttributes() ?>>
        <label id="elh_job_histories_user_id" for="x_user_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->user_id->caption() ?><?= $Page->user_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->user_id->cellAttributes() ?>>
<span id="el_job_histories_user_id">
    <select
        id="x_user_id"
        name="x_user_id"
        class="form-select ew-select<?= $Page->user_id->isInvalidClass() ?>"
        data-select2-id="fjob_historiesedit_x_user_id"
        data-table="job_histories"
        data-field="x_user_id"
        data-value-separator="<?= $Page->user_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->user_id->getPlaceHolder()) ?>"
        <?= $Page->user_id->editAttributes() ?>>
        <?= $Page->user_id->selectOptionListHtml("x_user_id") ?>
    </select>
    <?= $Page->user_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->user_id->getErrorMessage() ?></div>
<?= $Page->user_id->Lookup->getParamTag($Page, "p_x_user_id") ?>
<script>
loadjs.ready("fjob_historiesedit", function() {
    var options = { name: "x_user_id", selectId: "fjob_historiesedit_x_user_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjob_historiesedit.lists.user_id.lookupOptions.length) {
        options.data = { id: "x_user_id", form: "fjob_historiesedit" };
    } else {
        options.ajax = { id: "x_user_id", form: "fjob_historiesedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.job_histories.fields.user_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->job_id->Visible) { // job_id ?>
    <div id="r_job_id"<?= $Page->job_id->rowAttributes() ?>>
        <label id="elh_job_histories_job_id" for="x_job_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->job_id->caption() ?><?= $Page->job_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->job_id->cellAttributes() ?>>
<span id="el_job_histories_job_id">
    <select
        id="x_job_id"
        name="x_job_id"
        class="form-select ew-select<?= $Page->job_id->isInvalidClass() ?>"
        data-select2-id="fjob_historiesedit_x_job_id"
        data-table="job_histories"
        data-field="x_job_id"
        data-value-separator="<?= $Page->job_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->job_id->getPlaceHolder()) ?>"
        <?= $Page->job_id->editAttributes() ?>>
        <?= $Page->job_id->selectOptionListHtml("x_job_id") ?>
    </select>
    <?= $Page->job_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->job_id->getErrorMessage() ?></div>
<?= $Page->job_id->Lookup->getParamTag($Page, "p_x_job_id") ?>
<script>
loadjs.ready("fjob_historiesedit", function() {
    var options = { name: "x_job_id", selectId: "fjob_historiesedit_x_job_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjob_historiesedit.lists.job_id.lookupOptions.length) {
        options.data = { id: "x_job_id", form: "fjob_historiesedit" };
    } else {
        options.ajax = { id: "x_job_id", form: "fjob_historiesedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.job_histories.fields.job_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->job_type->Visible) { // job_type ?>
    <div id="r_job_type"<?= $Page->job_type->rowAttributes() ?>>
        <label id="elh_job_histories_job_type" for="x_job_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->job_type->caption() ?><?= $Page->job_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->job_type->cellAttributes() ?>>
<span id="el_job_histories_job_type">
    <select
        id="x_job_type"
        name="x_job_type"
        class="form-select ew-select<?= $Page->job_type->isInvalidClass() ?>"
        data-select2-id="fjob_historiesedit_x_job_type"
        data-table="job_histories"
        data-field="x_job_type"
        data-value-separator="<?= $Page->job_type->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->job_type->getPlaceHolder()) ?>"
        <?= $Page->job_type->editAttributes() ?>>
        <?= $Page->job_type->selectOptionListHtml("x_job_type") ?>
    </select>
    <?= $Page->job_type->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->job_type->getErrorMessage() ?></div>
<script>
loadjs.ready("fjob_historiesedit", function() {
    var options = { name: "x_job_type", selectId: "fjob_historiesedit_x_job_type" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjob_historiesedit.lists.job_type.lookupOptions.length) {
        options.data = { id: "x_job_type", form: "fjob_historiesedit" };
    } else {
        options.ajax = { id: "x_job_type", form: "fjob_historiesedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.job_histories.fields.job_type.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description"<?= $Page->description->rowAttributes() ?>>
        <label id="elh_job_histories_description" for="x_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->description->cellAttributes() ?>>
<span id="el_job_histories_description">
<input type="<?= $Page->description->getInputTextType() ?>" name="x_description" id="x_description" data-table="job_histories" data-field="x_description" value="<?= $Page->description->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help">
<?= $Page->description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->job_date->Visible) { // job_date ?>
    <div id="r_job_date"<?= $Page->job_date->rowAttributes() ?>>
        <label id="elh_job_histories_job_date" for="x_job_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->job_date->caption() ?><?= $Page->job_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->job_date->cellAttributes() ?>>
<span id="el_job_histories_job_date">
<input type="<?= $Page->job_date->getInputTextType() ?>" name="x_job_date" id="x_job_date" data-table="job_histories" data-field="x_job_date" value="<?= $Page->job_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->job_date->getPlaceHolder()) ?>"<?= $Page->job_date->editAttributes() ?> aria-describedby="x_job_date_help">
<?= $Page->job_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->job_date->getErrorMessage() ?></div>
<?php if (!$Page->job_date->ReadOnly && !$Page->job_date->Disabled && !isset($Page->job_date->EditAttrs["readonly"]) && !isset($Page->job_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjob_historiesedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fjob_historiesedit", "x_job_date", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
    <div id="r_updated_at"<?= $Page->updated_at->rowAttributes() ?>>
        <label id="elh_job_histories_updated_at" for="x_updated_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->updated_at->caption() ?><?= $Page->updated_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->updated_at->cellAttributes() ?>>
<span id="el_job_histories_updated_at">
<input type="<?= $Page->updated_at->getInputTextType() ?>" name="x_updated_at" id="x_updated_at" data-table="job_histories" data-field="x_updated_at" value="<?= $Page->updated_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->updated_at->getPlaceHolder()) ?>"<?= $Page->updated_at->editAttributes() ?> aria-describedby="x_updated_at_help">
<?= $Page->updated_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->updated_at->getErrorMessage() ?></div>
<?php if (!$Page->updated_at->ReadOnly && !$Page->updated_at->Disabled && !isset($Page->updated_at->EditAttrs["readonly"]) && !isset($Page->updated_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjob_historiesedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fjob_historiesedit", "x_updated_at", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <div id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <label id="elh_job_histories_created_at" for="x_created_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_at->caption() ?><?= $Page->created_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_at->cellAttributes() ?>>
<span id="el_job_histories_created_at">
<input type="<?= $Page->created_at->getInputTextType() ?>" name="x_created_at" id="x_created_at" data-table="job_histories" data-field="x_created_at" value="<?= $Page->created_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->created_at->getPlaceHolder()) ?>"<?= $Page->created_at->editAttributes() ?> aria-describedby="x_created_at_help">
<?= $Page->created_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_at->getErrorMessage() ?></div>
<?php if (!$Page->created_at->ReadOnly && !$Page->created_at->Disabled && !isset($Page->created_at->EditAttrs["readonly"]) && !isset($Page->created_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjob_historiesedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fjob_historiesedit", "x_created_at", jQuery.extend(true, {"useCurrent":false}, options));
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
    ew.addEventHandlers("job_histories");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
