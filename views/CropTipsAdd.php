<?php

namespace PHPMaker2022\growit_2021;

// Page object
$CropTipsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { crop_tips: currentTable } });
var currentForm, currentPageID;
var fcrop_tipsadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcrop_tipsadd = new ew.Form("fcrop_tipsadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fcrop_tipsadd;

    // Add fields
    var fields = currentTable.fields;
    fcrop_tipsadd.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null, ew.Validators.guid], fields.id.isInvalid],
        ["crop_id", [fields.crop_id.visible && fields.crop_id.required ? ew.Validators.required(fields.crop_id.caption) : null], fields.crop_id.isInvalid],
        ["sow_tip", [fields.sow_tip.visible && fields.sow_tip.required ? ew.Validators.required(fields.sow_tip.caption) : null], fields.sow_tip.isInvalid],
        ["plant_tip", [fields.plant_tip.visible && fields.plant_tip.required ? ew.Validators.required(fields.plant_tip.caption) : null], fields.plant_tip.isInvalid],
        ["harvest_tip", [fields.harvest_tip.visible && fields.harvest_tip.required ? ew.Validators.required(fields.harvest_tip.caption) : null], fields.harvest_tip.isInvalid],
        ["sow_summary", [fields.sow_summary.visible && fields.sow_summary.required ? ew.Validators.required(fields.sow_summary.caption) : null], fields.sow_summary.isInvalid],
        ["plant_summary", [fields.plant_summary.visible && fields.plant_summary.required ? ew.Validators.required(fields.plant_summary.caption) : null], fields.plant_summary.isInvalid],
        ["harvest_summary", [fields.harvest_summary.visible && fields.harvest_summary.required ? ew.Validators.required(fields.harvest_summary.caption) : null], fields.harvest_summary.isInvalid],
        ["updated_at", [fields.updated_at.visible && fields.updated_at.required ? ew.Validators.required(fields.updated_at.caption) : null, ew.Validators.datetime(fields.updated_at.clientFormatPattern)], fields.updated_at.isInvalid],
        ["created_at", [fields.created_at.visible && fields.created_at.required ? ew.Validators.required(fields.created_at.caption) : null, ew.Validators.datetime(fields.created_at.clientFormatPattern)], fields.created_at.isInvalid]
    ]);

    // Form_CustomValidate
    fcrop_tipsadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fcrop_tipsadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fcrop_tipsadd.lists.crop_id = <?= $Page->crop_id->toClientList($Page) ?>;
    loadjs.done("fcrop_tipsadd");
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
<form name="fcrop_tipsadd" id="fcrop_tipsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="crop_tips">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_crop_tips_id" for="x_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_crop_tips_id">
<input type="<?= $Page->id->getInputTextType() ?>" name="x_id" id="x_id" data-table="crop_tips" data-field="x_id" value="<?= $Page->id->EditValue ?>" size="38" maxlength="38" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>"<?= $Page->id->editAttributes() ?> aria-describedby="x_id_help">
<?= $Page->id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->crop_id->Visible) { // crop_id ?>
    <div id="r_crop_id"<?= $Page->crop_id->rowAttributes() ?>>
        <label id="elh_crop_tips_crop_id" for="x_crop_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->crop_id->caption() ?><?= $Page->crop_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->crop_id->cellAttributes() ?>>
<span id="el_crop_tips_crop_id">
    <select
        id="x_crop_id"
        name="x_crop_id"
        class="form-control ew-select<?= $Page->crop_id->isInvalidClass() ?>"
        data-select2-id="fcrop_tipsadd_x_crop_id"
        data-table="crop_tips"
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
loadjs.ready("fcrop_tipsadd", function() {
    var options = { name: "x_crop_id", selectId: "fcrop_tipsadd_x_crop_id" };
    if (fcrop_tipsadd.lists.crop_id.lookupOptions.length) {
        options.data = { id: "x_crop_id", form: "fcrop_tipsadd" };
    } else {
        options.ajax = { id: "x_crop_id", form: "fcrop_tipsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.crop_tips.fields.crop_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sow_tip->Visible) { // sow_tip ?>
    <div id="r_sow_tip"<?= $Page->sow_tip->rowAttributes() ?>>
        <label id="elh_crop_tips_sow_tip" for="x_sow_tip" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sow_tip->caption() ?><?= $Page->sow_tip->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sow_tip->cellAttributes() ?>>
<span id="el_crop_tips_sow_tip">
<textarea data-table="crop_tips" data-field="x_sow_tip" name="x_sow_tip" id="x_sow_tip" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->sow_tip->getPlaceHolder()) ?>"<?= $Page->sow_tip->editAttributes() ?> aria-describedby="x_sow_tip_help"><?= $Page->sow_tip->EditValue ?></textarea>
<?= $Page->sow_tip->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sow_tip->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->plant_tip->Visible) { // plant_tip ?>
    <div id="r_plant_tip"<?= $Page->plant_tip->rowAttributes() ?>>
        <label id="elh_crop_tips_plant_tip" for="x_plant_tip" class="<?= $Page->LeftColumnClass ?>"><?= $Page->plant_tip->caption() ?><?= $Page->plant_tip->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->plant_tip->cellAttributes() ?>>
<span id="el_crop_tips_plant_tip">
<textarea data-table="crop_tips" data-field="x_plant_tip" name="x_plant_tip" id="x_plant_tip" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->plant_tip->getPlaceHolder()) ?>"<?= $Page->plant_tip->editAttributes() ?> aria-describedby="x_plant_tip_help"><?= $Page->plant_tip->EditValue ?></textarea>
<?= $Page->plant_tip->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->plant_tip->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->harvest_tip->Visible) { // harvest_tip ?>
    <div id="r_harvest_tip"<?= $Page->harvest_tip->rowAttributes() ?>>
        <label id="elh_crop_tips_harvest_tip" for="x_harvest_tip" class="<?= $Page->LeftColumnClass ?>"><?= $Page->harvest_tip->caption() ?><?= $Page->harvest_tip->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->harvest_tip->cellAttributes() ?>>
<span id="el_crop_tips_harvest_tip">
<textarea data-table="crop_tips" data-field="x_harvest_tip" name="x_harvest_tip" id="x_harvest_tip" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->harvest_tip->getPlaceHolder()) ?>"<?= $Page->harvest_tip->editAttributes() ?> aria-describedby="x_harvest_tip_help"><?= $Page->harvest_tip->EditValue ?></textarea>
<?= $Page->harvest_tip->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->harvest_tip->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sow_summary->Visible) { // sow_summary ?>
    <div id="r_sow_summary"<?= $Page->sow_summary->rowAttributes() ?>>
        <label id="elh_crop_tips_sow_summary" for="x_sow_summary" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sow_summary->caption() ?><?= $Page->sow_summary->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sow_summary->cellAttributes() ?>>
<span id="el_crop_tips_sow_summary">
<textarea data-table="crop_tips" data-field="x_sow_summary" name="x_sow_summary" id="x_sow_summary" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->sow_summary->getPlaceHolder()) ?>"<?= $Page->sow_summary->editAttributes() ?> aria-describedby="x_sow_summary_help"><?= $Page->sow_summary->EditValue ?></textarea>
<?= $Page->sow_summary->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sow_summary->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->plant_summary->Visible) { // plant_summary ?>
    <div id="r_plant_summary"<?= $Page->plant_summary->rowAttributes() ?>>
        <label id="elh_crop_tips_plant_summary" for="x_plant_summary" class="<?= $Page->LeftColumnClass ?>"><?= $Page->plant_summary->caption() ?><?= $Page->plant_summary->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->plant_summary->cellAttributes() ?>>
<span id="el_crop_tips_plant_summary">
<textarea data-table="crop_tips" data-field="x_plant_summary" name="x_plant_summary" id="x_plant_summary" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->plant_summary->getPlaceHolder()) ?>"<?= $Page->plant_summary->editAttributes() ?> aria-describedby="x_plant_summary_help"><?= $Page->plant_summary->EditValue ?></textarea>
<?= $Page->plant_summary->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->plant_summary->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->harvest_summary->Visible) { // harvest_summary ?>
    <div id="r_harvest_summary"<?= $Page->harvest_summary->rowAttributes() ?>>
        <label id="elh_crop_tips_harvest_summary" for="x_harvest_summary" class="<?= $Page->LeftColumnClass ?>"><?= $Page->harvest_summary->caption() ?><?= $Page->harvest_summary->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->harvest_summary->cellAttributes() ?>>
<span id="el_crop_tips_harvest_summary">
<textarea data-table="crop_tips" data-field="x_harvest_summary" name="x_harvest_summary" id="x_harvest_summary" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->harvest_summary->getPlaceHolder()) ?>"<?= $Page->harvest_summary->editAttributes() ?> aria-describedby="x_harvest_summary_help"><?= $Page->harvest_summary->EditValue ?></textarea>
<?= $Page->harvest_summary->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->harvest_summary->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
    <div id="r_updated_at"<?= $Page->updated_at->rowAttributes() ?>>
        <label id="elh_crop_tips_updated_at" for="x_updated_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->updated_at->caption() ?><?= $Page->updated_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->updated_at->cellAttributes() ?>>
<span id="el_crop_tips_updated_at">
<input type="<?= $Page->updated_at->getInputTextType() ?>" name="x_updated_at" id="x_updated_at" data-table="crop_tips" data-field="x_updated_at" value="<?= $Page->updated_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->updated_at->getPlaceHolder()) ?>"<?= $Page->updated_at->editAttributes() ?> aria-describedby="x_updated_at_help">
<?= $Page->updated_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->updated_at->getErrorMessage() ?></div>
<?php if (!$Page->updated_at->ReadOnly && !$Page->updated_at->Disabled && !isset($Page->updated_at->EditAttrs["readonly"]) && !isset($Page->updated_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcrop_tipsadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fcrop_tipsadd", "x_updated_at", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <div id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <label id="elh_crop_tips_created_at" for="x_created_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_at->caption() ?><?= $Page->created_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_at->cellAttributes() ?>>
<span id="el_crop_tips_created_at">
<input type="<?= $Page->created_at->getInputTextType() ?>" name="x_created_at" id="x_created_at" data-table="crop_tips" data-field="x_created_at" value="<?= $Page->created_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->created_at->getPlaceHolder()) ?>"<?= $Page->created_at->editAttributes() ?> aria-describedby="x_created_at_help">
<?= $Page->created_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_at->getErrorMessage() ?></div>
<?php if (!$Page->created_at->ReadOnly && !$Page->created_at->Disabled && !isset($Page->created_at->EditAttrs["readonly"]) && !isset($Page->created_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcrop_tipsadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fcrop_tipsadd", "x_created_at", jQuery.extend(true, {"useCurrent":false}, options));
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
    ew.addEventHandlers("crop_tips");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
