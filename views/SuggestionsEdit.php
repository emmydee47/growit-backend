<?php

namespace PHPMaker2022\growit_2021;

// Page object
$SuggestionsEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { suggestions: currentTable } });
var currentForm, currentPageID;
var fsuggestionsedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fsuggestionsedit = new ew.Form("fsuggestionsedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fsuggestionsedit;

    // Add fields
    var fields = currentTable.fields;
    fsuggestionsedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null, ew.Validators.guid], fields.id.isInvalid],
        ["month", [fields.month.visible && fields.month.required ? ew.Validators.required(fields.month.caption) : null], fields.month.isInvalid],
        ["crop_id", [fields.crop_id.visible && fields.crop_id.required ? ew.Validators.required(fields.crop_id.caption) : null], fields.crop_id.isInvalid],
        ["_content", [fields._content.visible && fields._content.required ? ew.Validators.required(fields._content.caption) : null], fields._content.isInvalid],
        ["created_at", [fields.created_at.visible && fields.created_at.required ? ew.Validators.required(fields.created_at.caption) : null, ew.Validators.datetime(fields.created_at.clientFormatPattern)], fields.created_at.isInvalid],
        ["updated_at", [fields.updated_at.visible && fields.updated_at.required ? ew.Validators.required(fields.updated_at.caption) : null, ew.Validators.datetime(fields.updated_at.clientFormatPattern)], fields.updated_at.isInvalid]
    ]);

    // Form_CustomValidate
    fsuggestionsedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fsuggestionsedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fsuggestionsedit.lists.month = <?= $Page->month->toClientList($Page) ?>;
    fsuggestionsedit.lists.crop_id = <?= $Page->crop_id->toClientList($Page) ?>;
    loadjs.done("fsuggestionsedit");
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
<form name="fsuggestionsedit" id="fsuggestionsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="suggestions">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_suggestions_id" for="x_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<input type="<?= $Page->id->getInputTextType() ?>" name="x_id" id="x_id" data-table="suggestions" data-field="x_id" value="<?= $Page->id->EditValue ?>" size="38" maxlength="38" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>"<?= $Page->id->editAttributes() ?> aria-describedby="x_id_help">
<?= $Page->id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage() ?></div>
<input type="hidden" data-table="suggestions" data-field="x_id" data-hidden="1" name="o_id" id="o_id" value="<?= HtmlEncode($Page->id->OldValue ?? $Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->month->Visible) { // month ?>
    <div id="r_month"<?= $Page->month->rowAttributes() ?>>
        <label id="elh_suggestions_month" for="x_month" class="<?= $Page->LeftColumnClass ?>"><?= $Page->month->caption() ?><?= $Page->month->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->month->cellAttributes() ?>>
<span id="el_suggestions_month">
    <select
        id="x_month"
        name="x_month"
        class="form-select ew-select<?= $Page->month->isInvalidClass() ?>"
        data-select2-id="fsuggestionsedit_x_month"
        data-table="suggestions"
        data-field="x_month"
        data-value-separator="<?= $Page->month->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->month->getPlaceHolder()) ?>"
        <?= $Page->month->editAttributes() ?>>
        <?= $Page->month->selectOptionListHtml("x_month") ?>
    </select>
    <?= $Page->month->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->month->getErrorMessage() ?></div>
<script>
loadjs.ready("fsuggestionsedit", function() {
    var options = { name: "x_month", selectId: "fsuggestionsedit_x_month" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fsuggestionsedit.lists.month.lookupOptions.length) {
        options.data = { id: "x_month", form: "fsuggestionsedit" };
    } else {
        options.ajax = { id: "x_month", form: "fsuggestionsedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.suggestions.fields.month.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->crop_id->Visible) { // crop_id ?>
    <div id="r_crop_id"<?= $Page->crop_id->rowAttributes() ?>>
        <label id="elh_suggestions_crop_id" for="x_crop_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->crop_id->caption() ?><?= $Page->crop_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->crop_id->cellAttributes() ?>>
<span id="el_suggestions_crop_id">
    <select
        id="x_crop_id"
        name="x_crop_id"
        class="form-control ew-select<?= $Page->crop_id->isInvalidClass() ?>"
        data-select2-id="fsuggestionsedit_x_crop_id"
        data-table="suggestions"
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
loadjs.ready("fsuggestionsedit", function() {
    var options = { name: "x_crop_id", selectId: "fsuggestionsedit_x_crop_id" };
    if (fsuggestionsedit.lists.crop_id.lookupOptions.length) {
        options.data = { id: "x_crop_id", form: "fsuggestionsedit" };
    } else {
        options.ajax = { id: "x_crop_id", form: "fsuggestionsedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.suggestions.fields.crop_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_content->Visible) { // content ?>
    <div id="r__content"<?= $Page->_content->rowAttributes() ?>>
        <label id="elh_suggestions__content" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_content->caption() ?><?= $Page->_content->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_content->cellAttributes() ?>>
<span id="el_suggestions__content">
<?php $Page->_content->EditAttrs->appendClass("editor"); ?>
<textarea data-table="suggestions" data-field="x__content" name="x__content" id="x__content" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->_content->getPlaceHolder()) ?>"<?= $Page->_content->editAttributes() ?> aria-describedby="x__content_help"><?= $Page->_content->EditValue ?></textarea>
<?= $Page->_content->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_content->getErrorMessage() ?></div>
<script>
loadjs.ready(["fsuggestionsedit", "editor"], function() {
    ew.createEditor("fsuggestionsedit", "x__content", 35, 4, <?= $Page->_content->ReadOnly || false ? "true" : "false" ?>);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <div id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <label id="elh_suggestions_created_at" for="x_created_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_at->caption() ?><?= $Page->created_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_at->cellAttributes() ?>>
<span id="el_suggestions_created_at">
<input type="<?= $Page->created_at->getInputTextType() ?>" name="x_created_at" id="x_created_at" data-table="suggestions" data-field="x_created_at" value="<?= $Page->created_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->created_at->getPlaceHolder()) ?>"<?= $Page->created_at->editAttributes() ?> aria-describedby="x_created_at_help">
<?= $Page->created_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_at->getErrorMessage() ?></div>
<?php if (!$Page->created_at->ReadOnly && !$Page->created_at->Disabled && !isset($Page->created_at->EditAttrs["readonly"]) && !isset($Page->created_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fsuggestionsedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fsuggestionsedit", "x_created_at", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
    <div id="r_updated_at"<?= $Page->updated_at->rowAttributes() ?>>
        <label id="elh_suggestions_updated_at" for="x_updated_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->updated_at->caption() ?><?= $Page->updated_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->updated_at->cellAttributes() ?>>
<span id="el_suggestions_updated_at">
<input type="<?= $Page->updated_at->getInputTextType() ?>" name="x_updated_at" id="x_updated_at" data-table="suggestions" data-field="x_updated_at" value="<?= $Page->updated_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->updated_at->getPlaceHolder()) ?>"<?= $Page->updated_at->editAttributes() ?> aria-describedby="x_updated_at_help">
<?= $Page->updated_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->updated_at->getErrorMessage() ?></div>
<?php if (!$Page->updated_at->ReadOnly && !$Page->updated_at->Disabled && !isset($Page->updated_at->EditAttrs["readonly"]) && !isset($Page->updated_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fsuggestionsedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fsuggestionsedit", "x_updated_at", jQuery.extend(true, {"useCurrent":false}, options));
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
    ew.addEventHandlers("suggestions");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
