<?php

namespace PHPMaker2022\growit_2021;

// Page object
$CropRecommendationsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { crop_recommendations: currentTable } });
var currentForm, currentPageID;
var fcrop_recommendationsadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcrop_recommendationsadd = new ew.Form("fcrop_recommendationsadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fcrop_recommendationsadd;

    // Add fields
    var fields = currentTable.fields;
    fcrop_recommendationsadd.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null, ew.Validators.guid], fields.id.isInvalid],
        ["crop_id", [fields.crop_id.visible && fields.crop_id.required ? ew.Validators.required(fields.crop_id.caption) : null], fields.crop_id.isInvalid],
        ["recommendation", [fields.recommendation.visible && fields.recommendation.required ? ew.Validators.required(fields.recommendation.caption) : null], fields.recommendation.isInvalid],
        ["affiliate_links", [fields.affiliate_links.visible && fields.affiliate_links.required ? ew.Validators.required(fields.affiliate_links.caption) : null], fields.affiliate_links.isInvalid],
        ["thumbnail_url", [fields.thumbnail_url.visible && fields.thumbnail_url.required ? ew.Validators.fileRequired(fields.thumbnail_url.caption) : null], fields.thumbnail_url.isInvalid],
        ["updated_at", [fields.updated_at.visible && fields.updated_at.required ? ew.Validators.required(fields.updated_at.caption) : null, ew.Validators.datetime(fields.updated_at.clientFormatPattern)], fields.updated_at.isInvalid],
        ["created_at", [fields.created_at.visible && fields.created_at.required ? ew.Validators.required(fields.created_at.caption) : null, ew.Validators.datetime(fields.created_at.clientFormatPattern)], fields.created_at.isInvalid]
    ]);

    // Form_CustomValidate
    fcrop_recommendationsadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fcrop_recommendationsadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fcrop_recommendationsadd.lists.crop_id = <?= $Page->crop_id->toClientList($Page) ?>;
    loadjs.done("fcrop_recommendationsadd");
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
<form name="fcrop_recommendationsadd" id="fcrop_recommendationsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="crop_recommendations">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_crop_recommendations_id" for="x_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_crop_recommendations_id">
<input type="<?= $Page->id->getInputTextType() ?>" name="x_id" id="x_id" data-table="crop_recommendations" data-field="x_id" value="<?= $Page->id->EditValue ?>" size="38" maxlength="38" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>"<?= $Page->id->editAttributes() ?> aria-describedby="x_id_help">
<?= $Page->id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->crop_id->Visible) { // crop_id ?>
    <div id="r_crop_id"<?= $Page->crop_id->rowAttributes() ?>>
        <label id="elh_crop_recommendations_crop_id" for="x_crop_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->crop_id->caption() ?><?= $Page->crop_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->crop_id->cellAttributes() ?>>
<span id="el_crop_recommendations_crop_id">
    <select
        id="x_crop_id"
        name="x_crop_id"
        class="form-control ew-select<?= $Page->crop_id->isInvalidClass() ?>"
        data-select2-id="fcrop_recommendationsadd_x_crop_id"
        data-table="crop_recommendations"
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
loadjs.ready("fcrop_recommendationsadd", function() {
    var options = { name: "x_crop_id", selectId: "fcrop_recommendationsadd_x_crop_id" };
    if (fcrop_recommendationsadd.lists.crop_id.lookupOptions.length) {
        options.data = { id: "x_crop_id", form: "fcrop_recommendationsadd" };
    } else {
        options.ajax = { id: "x_crop_id", form: "fcrop_recommendationsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.crop_recommendations.fields.crop_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->recommendation->Visible) { // recommendation ?>
    <div id="r_recommendation"<?= $Page->recommendation->rowAttributes() ?>>
        <label id="elh_crop_recommendations_recommendation" for="x_recommendation" class="<?= $Page->LeftColumnClass ?>"><?= $Page->recommendation->caption() ?><?= $Page->recommendation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->recommendation->cellAttributes() ?>>
<span id="el_crop_recommendations_recommendation">
<input type="<?= $Page->recommendation->getInputTextType() ?>" name="x_recommendation" id="x_recommendation" data-table="crop_recommendations" data-field="x_recommendation" value="<?= $Page->recommendation->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->recommendation->getPlaceHolder()) ?>"<?= $Page->recommendation->editAttributes() ?> aria-describedby="x_recommendation_help">
<?= $Page->recommendation->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->recommendation->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->affiliate_links->Visible) { // affiliate_links ?>
    <div id="r_affiliate_links"<?= $Page->affiliate_links->rowAttributes() ?>>
        <label id="elh_crop_recommendations_affiliate_links" for="x_affiliate_links" class="<?= $Page->LeftColumnClass ?>"><?= $Page->affiliate_links->caption() ?><?= $Page->affiliate_links->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->affiliate_links->cellAttributes() ?>>
<span id="el_crop_recommendations_affiliate_links">
<textarea data-table="crop_recommendations" data-field="x_affiliate_links" name="x_affiliate_links" id="x_affiliate_links" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->affiliate_links->getPlaceHolder()) ?>"<?= $Page->affiliate_links->editAttributes() ?> aria-describedby="x_affiliate_links_help"><?= $Page->affiliate_links->EditValue ?></textarea>
<?= $Page->affiliate_links->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->affiliate_links->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->thumbnail_url->Visible) { // thumbnail_url ?>
    <div id="r_thumbnail_url"<?= $Page->thumbnail_url->rowAttributes() ?>>
        <label id="elh_crop_recommendations_thumbnail_url" class="<?= $Page->LeftColumnClass ?>"><?= $Page->thumbnail_url->caption() ?><?= $Page->thumbnail_url->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->thumbnail_url->cellAttributes() ?>>
<span id="el_crop_recommendations_thumbnail_url">
<div id="fd_x_thumbnail_url" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->thumbnail_url->title() ?>" data-table="crop_recommendations" data-field="x_thumbnail_url" name="x_thumbnail_url" id="x_thumbnail_url" lang="<?= CurrentLanguageID() ?>"<?= $Page->thumbnail_url->editAttributes() ?> aria-describedby="x_thumbnail_url_help"<?= ($Page->thumbnail_url->ReadOnly || $Page->thumbnail_url->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->thumbnail_url->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->thumbnail_url->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_thumbnail_url" id= "fn_x_thumbnail_url" value="<?= $Page->thumbnail_url->Upload->FileName ?>">
<input type="hidden" name="fa_x_thumbnail_url" id= "fa_x_thumbnail_url" value="0">
<input type="hidden" name="fs_x_thumbnail_url" id= "fs_x_thumbnail_url" value="255">
<input type="hidden" name="fx_x_thumbnail_url" id= "fx_x_thumbnail_url" value="<?= $Page->thumbnail_url->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_thumbnail_url" id= "fm_x_thumbnail_url" value="<?= $Page->thumbnail_url->UploadMaxFileSize ?>">
<table id="ft_x_thumbnail_url" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
    <div id="r_updated_at"<?= $Page->updated_at->rowAttributes() ?>>
        <label id="elh_crop_recommendations_updated_at" for="x_updated_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->updated_at->caption() ?><?= $Page->updated_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->updated_at->cellAttributes() ?>>
<span id="el_crop_recommendations_updated_at">
<input type="<?= $Page->updated_at->getInputTextType() ?>" name="x_updated_at" id="x_updated_at" data-table="crop_recommendations" data-field="x_updated_at" value="<?= $Page->updated_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->updated_at->getPlaceHolder()) ?>"<?= $Page->updated_at->editAttributes() ?> aria-describedby="x_updated_at_help">
<?= $Page->updated_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->updated_at->getErrorMessage() ?></div>
<?php if (!$Page->updated_at->ReadOnly && !$Page->updated_at->Disabled && !isset($Page->updated_at->EditAttrs["readonly"]) && !isset($Page->updated_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcrop_recommendationsadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fcrop_recommendationsadd", "x_updated_at", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <div id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <label id="elh_crop_recommendations_created_at" for="x_created_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_at->caption() ?><?= $Page->created_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_at->cellAttributes() ?>>
<span id="el_crop_recommendations_created_at">
<input type="<?= $Page->created_at->getInputTextType() ?>" name="x_created_at" id="x_created_at" data-table="crop_recommendations" data-field="x_created_at" value="<?= $Page->created_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->created_at->getPlaceHolder()) ?>"<?= $Page->created_at->editAttributes() ?> aria-describedby="x_created_at_help">
<?= $Page->created_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_at->getErrorMessage() ?></div>
<?php if (!$Page->created_at->ReadOnly && !$Page->created_at->Disabled && !isset($Page->created_at->EditAttrs["readonly"]) && !isset($Page->created_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcrop_recommendationsadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fcrop_recommendationsadd", "x_created_at", jQuery.extend(true, {"useCurrent":false}, options));
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
    ew.addEventHandlers("crop_recommendations");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
