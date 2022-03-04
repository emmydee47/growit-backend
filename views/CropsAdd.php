<?php

namespace PHPMaker2022\growit_2021;

// Page object
$CropsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { crops: currentTable } });
var currentForm, currentPageID;
var fcropsadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcropsadd = new ew.Form("fcropsadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fcropsadd;

    // Add fields
    var fields = currentTable.fields;
    fcropsadd.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["name", [fields.name.visible && fields.name.required ? ew.Validators.required(fields.name.caption) : null], fields.name.isInvalid],
        ["media_url", [fields.media_url.visible && fields.media_url.required ? ew.Validators.fileRequired(fields.media_url.caption) : null], fields.media_url.isInvalid],
        ["variety", [fields.variety.visible && fields.variety.required ? ew.Validators.required(fields.variety.caption) : null], fields.variety.isInvalid],
        ["grow_level", [fields.grow_level.visible && fields.grow_level.required ? ew.Validators.required(fields.grow_level.caption) : null], fields.grow_level.isInvalid],
        ["category", [fields.category.visible && fields.category.required ? ew.Validators.required(fields.category.caption) : null], fields.category.isInvalid],
        ["life_cycle", [fields.life_cycle.visible && fields.life_cycle.required ? ew.Validators.required(fields.life_cycle.caption) : null], fields.life_cycle.isInvalid],
        ["companion_crops", [fields.companion_crops.visible && fields.companion_crops.required ? ew.Validators.required(fields.companion_crops.caption) : null], fields.companion_crops.isInvalid],
        ["crop_cover_image", [fields.crop_cover_image.visible && fields.crop_cover_image.required ? ew.Validators.required(fields.crop_cover_image.caption) : null], fields.crop_cover_image.isInvalid],
        ["created_at", [fields.created_at.visible && fields.created_at.required ? ew.Validators.required(fields.created_at.caption) : null], fields.created_at.isInvalid],
        ["updated_at", [fields.updated_at.visible && fields.updated_at.required ? ew.Validators.required(fields.updated_at.caption) : null], fields.updated_at.isInvalid]
    ]);

    // Form_CustomValidate
    fcropsadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fcropsadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fcropsadd.lists.grow_level = <?= $Page->grow_level->toClientList($Page) ?>;
    fcropsadd.lists.category = <?= $Page->category->toClientList($Page) ?>;
    fcropsadd.lists.life_cycle = <?= $Page->life_cycle->toClientList($Page) ?>;
    fcropsadd.lists.crop_cover_image = <?= $Page->crop_cover_image->toClientList($Page) ?>;
    loadjs.done("fcropsadd");
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
<form name="fcropsadd" id="fcropsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="crops">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->name->Visible) { // name ?>
    <div id="r_name"<?= $Page->name->rowAttributes() ?>>
        <label id="elh_crops_name" for="x_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->name->caption() ?><?= $Page->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->name->cellAttributes() ?>>
<span id="el_crops_name">
<input type="<?= $Page->name->getInputTextType() ?>" name="x_name" id="x_name" data-table="crops" data-field="x_name" value="<?= $Page->name->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>"<?= $Page->name->editAttributes() ?> aria-describedby="x_name_help">
<?= $Page->name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->media_url->Visible) { // media_url ?>
    <div id="r_media_url"<?= $Page->media_url->rowAttributes() ?>>
        <label id="elh_crops_media_url" class="<?= $Page->LeftColumnClass ?>"><?= $Page->media_url->caption() ?><?= $Page->media_url->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->media_url->cellAttributes() ?>>
<span id="el_crops_media_url">
<div id="fd_x_media_url" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->media_url->title() ?>" data-table="crops" data-field="x_media_url" name="x_media_url" id="x_media_url" lang="<?= CurrentLanguageID() ?>"<?= $Page->media_url->editAttributes() ?> aria-describedby="x_media_url_help"<?= ($Page->media_url->ReadOnly || $Page->media_url->Disabled) ? " disabled" : "" ?>>
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
<?php if ($Page->variety->Visible) { // variety ?>
    <div id="r_variety"<?= $Page->variety->rowAttributes() ?>>
        <label id="elh_crops_variety" for="x_variety" class="<?= $Page->LeftColumnClass ?>"><?= $Page->variety->caption() ?><?= $Page->variety->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->variety->cellAttributes() ?>>
<span id="el_crops_variety">
<input type="<?= $Page->variety->getInputTextType() ?>" name="x_variety" id="x_variety" data-table="crops" data-field="x_variety" value="<?= $Page->variety->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->variety->getPlaceHolder()) ?>"<?= $Page->variety->editAttributes() ?> aria-describedby="x_variety_help">
<?= $Page->variety->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->variety->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->grow_level->Visible) { // grow_level ?>
    <div id="r_grow_level"<?= $Page->grow_level->rowAttributes() ?>>
        <label id="elh_crops_grow_level" class="<?= $Page->LeftColumnClass ?>"><?= $Page->grow_level->caption() ?><?= $Page->grow_level->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->grow_level->cellAttributes() ?>>
<span id="el_crops_grow_level">
<template id="tp_x_grow_level">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="crops" data-field="x_grow_level" name="x_grow_level" id="x_grow_level"<?= $Page->grow_level->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x_grow_level" class="ew-item-list"></div>
<selection-list hidden
    id="x_grow_level"
    name="x_grow_level"
    value="<?= HtmlEncode($Page->grow_level->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_grow_level"
    data-bs-target="dsl_x_grow_level"
    data-repeatcolumn="5"
    class="form-control<?= $Page->grow_level->isInvalidClass() ?>"
    data-table="crops"
    data-field="x_grow_level"
    data-value-separator="<?= $Page->grow_level->displayValueSeparatorAttribute() ?>"
    <?= $Page->grow_level->editAttributes() ?>></selection-list>
<?= $Page->grow_level->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->grow_level->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->category->Visible) { // category ?>
    <div id="r_category"<?= $Page->category->rowAttributes() ?>>
        <label id="elh_crops_category" for="x_category" class="<?= $Page->LeftColumnClass ?>"><?= $Page->category->caption() ?><?= $Page->category->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->category->cellAttributes() ?>>
<span id="el_crops_category">
    <select
        id="x_category"
        name="x_category"
        class="form-select ew-select<?= $Page->category->isInvalidClass() ?>"
        data-select2-id="fcropsadd_x_category"
        data-table="crops"
        data-field="x_category"
        data-value-separator="<?= $Page->category->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->category->getPlaceHolder()) ?>"
        <?= $Page->category->editAttributes() ?>>
        <?= $Page->category->selectOptionListHtml("x_category") ?>
    </select>
    <?= $Page->category->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->category->getErrorMessage() ?></div>
<script>
loadjs.ready("fcropsadd", function() {
    var options = { name: "x_category", selectId: "fcropsadd_x_category" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcropsadd.lists.category.lookupOptions.length) {
        options.data = { id: "x_category", form: "fcropsadd" };
    } else {
        options.ajax = { id: "x_category", form: "fcropsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.crops.fields.category.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->life_cycle->Visible) { // life_cycle ?>
    <div id="r_life_cycle"<?= $Page->life_cycle->rowAttributes() ?>>
        <label id="elh_crops_life_cycle" for="x_life_cycle" class="<?= $Page->LeftColumnClass ?>"><?= $Page->life_cycle->caption() ?><?= $Page->life_cycle->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->life_cycle->cellAttributes() ?>>
<span id="el_crops_life_cycle">
    <select
        id="x_life_cycle"
        name="x_life_cycle"
        class="form-select ew-select<?= $Page->life_cycle->isInvalidClass() ?>"
        data-select2-id="fcropsadd_x_life_cycle"
        data-table="crops"
        data-field="x_life_cycle"
        data-value-separator="<?= $Page->life_cycle->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->life_cycle->getPlaceHolder()) ?>"
        <?= $Page->life_cycle->editAttributes() ?>>
        <?= $Page->life_cycle->selectOptionListHtml("x_life_cycle") ?>
    </select>
    <?= $Page->life_cycle->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->life_cycle->getErrorMessage() ?></div>
<script>
loadjs.ready("fcropsadd", function() {
    var options = { name: "x_life_cycle", selectId: "fcropsadd_x_life_cycle" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcropsadd.lists.life_cycle.lookupOptions.length) {
        options.data = { id: "x_life_cycle", form: "fcropsadd" };
    } else {
        options.ajax = { id: "x_life_cycle", form: "fcropsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.crops.fields.life_cycle.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->companion_crops->Visible) { // companion_crops ?>
    <div id="r_companion_crops"<?= $Page->companion_crops->rowAttributes() ?>>
        <label id="elh_crops_companion_crops" for="x_companion_crops" class="<?= $Page->LeftColumnClass ?>"><?= $Page->companion_crops->caption() ?><?= $Page->companion_crops->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->companion_crops->cellAttributes() ?>>
<span id="el_crops_companion_crops">
<textarea data-table="crops" data-field="x_companion_crops" name="x_companion_crops" id="x_companion_crops" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->companion_crops->getPlaceHolder()) ?>"<?= $Page->companion_crops->editAttributes() ?> aria-describedby="x_companion_crops_help"><?= $Page->companion_crops->EditValue ?></textarea>
<?= $Page->companion_crops->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->companion_crops->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->crop_cover_image->Visible) { // crop_cover_image ?>
    <div id="r_crop_cover_image"<?= $Page->crop_cover_image->rowAttributes() ?>>
        <label id="elh_crops_crop_cover_image" class="<?= $Page->LeftColumnClass ?>"><?= $Page->crop_cover_image->caption() ?><?= $Page->crop_cover_image->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->crop_cover_image->cellAttributes() ?>>
<span id="el_crops_crop_cover_image">
<div class="form-check d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->crop_cover_image->isInvalidClass() ?>" data-table="crops" data-field="x_crop_cover_image" name="x_crop_cover_image[]" id="x_crop_cover_image_299862" value="1"<?= ConvertToBool($Page->crop_cover_image->CurrentValue) ? " checked" : "" ?><?= $Page->crop_cover_image->editAttributes() ?> aria-describedby="x_crop_cover_image_help">
    <div class="invalid-feedback"><?= $Page->crop_cover_image->getErrorMessage() ?></div>
</div>
<?= $Page->crop_cover_image->getCustomMessage() ?>
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
    ew.addEventHandlers("crops");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
