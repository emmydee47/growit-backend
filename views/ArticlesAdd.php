<?php

namespace PHPMaker2022\growit_2021;

// Page object
$ArticlesAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { articles: currentTable } });
var currentForm, currentPageID;
var farticlesadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    farticlesadd = new ew.Form("farticlesadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = farticlesadd;

    // Add fields
    var fields = currentTable.fields;
    farticlesadd.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null, ew.Validators.guid], fields.id.isInvalid],
        ["_title", [fields._title.visible && fields._title.required ? ew.Validators.required(fields._title.caption) : null], fields._title.isInvalid],
        ["_content", [fields._content.visible && fields._content.required ? ew.Validators.required(fields._content.caption) : null], fields._content.isInvalid],
        ["usefull_links", [fields.usefull_links.visible && fields.usefull_links.required ? ew.Validators.required(fields.usefull_links.caption) : null], fields.usefull_links.isInvalid],
        ["media_url", [fields.media_url.visible && fields.media_url.required ? ew.Validators.fileRequired(fields.media_url.caption) : null], fields.media_url.isInvalid],
        ["article_category_id", [fields.article_category_id.visible && fields.article_category_id.required ? ew.Validators.required(fields.article_category_id.caption) : null], fields.article_category_id.isInvalid],
        ["updated_at", [fields.updated_at.visible && fields.updated_at.required ? ew.Validators.required(fields.updated_at.caption) : null, ew.Validators.datetime(fields.updated_at.clientFormatPattern)], fields.updated_at.isInvalid],
        ["created_at", [fields.created_at.visible && fields.created_at.required ? ew.Validators.required(fields.created_at.caption) : null, ew.Validators.datetime(fields.created_at.clientFormatPattern)], fields.created_at.isInvalid]
    ]);

    // Form_CustomValidate
    farticlesadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    farticlesadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    farticlesadd.lists.article_category_id = <?= $Page->article_category_id->toClientList($Page) ?>;
    loadjs.done("farticlesadd");
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
<form name="farticlesadd" id="farticlesadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="articles">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_articles_id" for="x_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_articles_id">
<input type="<?= $Page->id->getInputTextType() ?>" name="x_id" id="x_id" data-table="articles" data-field="x_id" value="<?= $Page->id->EditValue ?>" size="38" maxlength="38" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>"<?= $Page->id->editAttributes() ?> aria-describedby="x_id_help">
<?= $Page->id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_title->Visible) { // title ?>
    <div id="r__title"<?= $Page->_title->rowAttributes() ?>>
        <label id="elh_articles__title" for="x__title" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_title->caption() ?><?= $Page->_title->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_title->cellAttributes() ?>>
<span id="el_articles__title">
<input type="<?= $Page->_title->getInputTextType() ?>" name="x__title" id="x__title" data-table="articles" data-field="x__title" value="<?= $Page->_title->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_title->getPlaceHolder()) ?>"<?= $Page->_title->editAttributes() ?> aria-describedby="x__title_help">
<?= $Page->_title->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_title->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_content->Visible) { // content ?>
    <div id="r__content"<?= $Page->_content->rowAttributes() ?>>
        <label id="elh_articles__content" for="x__content" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_content->caption() ?><?= $Page->_content->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_content->cellAttributes() ?>>
<span id="el_articles__content">
<textarea data-table="articles" data-field="x__content" name="x__content" id="x__content" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->_content->getPlaceHolder()) ?>"<?= $Page->_content->editAttributes() ?> aria-describedby="x__content_help"><?= $Page->_content->EditValue ?></textarea>
<?= $Page->_content->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_content->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->usefull_links->Visible) { // usefull_links ?>
    <div id="r_usefull_links"<?= $Page->usefull_links->rowAttributes() ?>>
        <label id="elh_articles_usefull_links" for="x_usefull_links" class="<?= $Page->LeftColumnClass ?>"><?= $Page->usefull_links->caption() ?><?= $Page->usefull_links->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->usefull_links->cellAttributes() ?>>
<span id="el_articles_usefull_links">
<textarea data-table="articles" data-field="x_usefull_links" name="x_usefull_links" id="x_usefull_links" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->usefull_links->getPlaceHolder()) ?>"<?= $Page->usefull_links->editAttributes() ?> aria-describedby="x_usefull_links_help"><?= $Page->usefull_links->EditValue ?></textarea>
<?= $Page->usefull_links->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->usefull_links->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->media_url->Visible) { // media_url ?>
    <div id="r_media_url"<?= $Page->media_url->rowAttributes() ?>>
        <label id="elh_articles_media_url" class="<?= $Page->LeftColumnClass ?>"><?= $Page->media_url->caption() ?><?= $Page->media_url->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->media_url->cellAttributes() ?>>
<span id="el_articles_media_url">
<div id="fd_x_media_url" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->media_url->title() ?>" data-table="articles" data-field="x_media_url" name="x_media_url" id="x_media_url" lang="<?= CurrentLanguageID() ?>"<?= $Page->media_url->editAttributes() ?> aria-describedby="x_media_url_help"<?= ($Page->media_url->ReadOnly || $Page->media_url->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->media_url->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->media_url->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_media_url" id= "fn_x_media_url" value="<?= $Page->media_url->Upload->FileName ?>">
<input type="hidden" name="fa_x_media_url" id= "fa_x_media_url" value="0">
<input type="hidden" name="fs_x_media_url" id= "fs_x_media_url" value="255">
<input type="hidden" name="fx_x_media_url" id= "fx_x_media_url" value="<?= $Page->media_url->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_media_url" id= "fm_x_media_url" value="<?= $Page->media_url->UploadMaxFileSize ?>">
<table id="ft_x_media_url" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->article_category_id->Visible) { // article_category_id ?>
    <div id="r_article_category_id"<?= $Page->article_category_id->rowAttributes() ?>>
        <label id="elh_articles_article_category_id" for="x_article_category_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->article_category_id->caption() ?><?= $Page->article_category_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->article_category_id->cellAttributes() ?>>
<span id="el_articles_article_category_id">
    <select
        id="x_article_category_id"
        name="x_article_category_id"
        class="form-select ew-select<?= $Page->article_category_id->isInvalidClass() ?>"
        data-select2-id="farticlesadd_x_article_category_id"
        data-table="articles"
        data-field="x_article_category_id"
        data-value-separator="<?= $Page->article_category_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->article_category_id->getPlaceHolder()) ?>"
        <?= $Page->article_category_id->editAttributes() ?>>
        <?= $Page->article_category_id->selectOptionListHtml("x_article_category_id") ?>
    </select>
    <?= $Page->article_category_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->article_category_id->getErrorMessage() ?></div>
<?= $Page->article_category_id->Lookup->getParamTag($Page, "p_x_article_category_id") ?>
<script>
loadjs.ready("farticlesadd", function() {
    var options = { name: "x_article_category_id", selectId: "farticlesadd_x_article_category_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (farticlesadd.lists.article_category_id.lookupOptions.length) {
        options.data = { id: "x_article_category_id", form: "farticlesadd" };
    } else {
        options.ajax = { id: "x_article_category_id", form: "farticlesadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.articles.fields.article_category_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
    <div id="r_updated_at"<?= $Page->updated_at->rowAttributes() ?>>
        <label id="elh_articles_updated_at" for="x_updated_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->updated_at->caption() ?><?= $Page->updated_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->updated_at->cellAttributes() ?>>
<span id="el_articles_updated_at">
<input type="<?= $Page->updated_at->getInputTextType() ?>" name="x_updated_at" id="x_updated_at" data-table="articles" data-field="x_updated_at" value="<?= $Page->updated_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->updated_at->getPlaceHolder()) ?>"<?= $Page->updated_at->editAttributes() ?> aria-describedby="x_updated_at_help">
<?= $Page->updated_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->updated_at->getErrorMessage() ?></div>
<?php if (!$Page->updated_at->ReadOnly && !$Page->updated_at->Disabled && !isset($Page->updated_at->EditAttrs["readonly"]) && !isset($Page->updated_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["farticlesadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("farticlesadd", "x_updated_at", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <div id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <label id="elh_articles_created_at" for="x_created_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_at->caption() ?><?= $Page->created_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_at->cellAttributes() ?>>
<span id="el_articles_created_at">
<input type="<?= $Page->created_at->getInputTextType() ?>" name="x_created_at" id="x_created_at" data-table="articles" data-field="x_created_at" value="<?= $Page->created_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->created_at->getPlaceHolder()) ?>"<?= $Page->created_at->editAttributes() ?> aria-describedby="x_created_at_help">
<?= $Page->created_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_at->getErrorMessage() ?></div>
<?php if (!$Page->created_at->ReadOnly && !$Page->created_at->Disabled && !isset($Page->created_at->EditAttrs["readonly"]) && !isset($Page->created_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["farticlesadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("farticlesadd", "x_created_at", jQuery.extend(true, {"useCurrent":false}, options));
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
    ew.addEventHandlers("articles");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
