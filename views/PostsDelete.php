<?php

namespace PHPMaker2022\growit_2021;

// Page object
$PostsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { posts: currentTable } });
var currentForm, currentPageID;
var fpostsdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpostsdelete = new ew.Form("fpostsdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fpostsdelete;
    loadjs.done("fpostsdelete");
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
<form name="fpostsdelete" id="fpostsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="posts">
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
<?php if ($Page->id->Visible) { // id ?>
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_posts_id" class="posts_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->crop_id->Visible) { // crop_id ?>
        <th class="<?= $Page->crop_id->headerCellClass() ?>"><span id="elh_posts_crop_id" class="posts_crop_id"><?= $Page->crop_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
        <th class="<?= $Page->user_id->headerCellClass() ?>"><span id="elh_posts_user_id" class="posts_user_id"><?= $Page->user_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_title->Visible) { // title ?>
        <th class="<?= $Page->_title->headerCellClass() ?>"><span id="elh_posts__title" class="posts__title"><?= $Page->_title->caption() ?></span></th>
<?php } ?>
<?php if ($Page->post_type->Visible) { // post_type ?>
        <th class="<?= $Page->post_type->headerCellClass() ?>"><span id="elh_posts_post_type" class="posts_post_type"><?= $Page->post_type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->crop_type->Visible) { // crop_type ?>
        <th class="<?= $Page->crop_type->headerCellClass() ?>"><span id="elh_posts_crop_type" class="posts_crop_type"><?= $Page->crop_type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->variety->Visible) { // variety ?>
        <th class="<?= $Page->variety->headerCellClass() ?>"><span id="elh_posts_variety" class="posts_variety"><?= $Page->variety->caption() ?></span></th>
<?php } ?>
<?php if ($Page->media_url->Visible) { // media_url ?>
        <th class="<?= $Page->media_url->headerCellClass() ?>"><span id="elh_posts_media_url" class="posts_media_url"><?= $Page->media_url->caption() ?></span></th>
<?php } ?>
<?php if ($Page->thumbnail_url->Visible) { // thumbnail_url ?>
        <th class="<?= $Page->thumbnail_url->headerCellClass() ?>"><span id="elh_posts_thumbnail_url" class="posts_thumbnail_url"><?= $Page->thumbnail_url->caption() ?></span></th>
<?php } ?>
<?php if ($Page->use_thumbnail->Visible) { // use_thumbnail ?>
        <th class="<?= $Page->use_thumbnail->headerCellClass() ?>"><span id="elh_posts_use_thumbnail" class="posts_use_thumbnail"><?= $Page->use_thumbnail->caption() ?></span></th>
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
<?php if ($Page->id->Visible) { // id ?>
        <td<?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_posts_id" class="el_posts_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->crop_id->Visible) { // crop_id ?>
        <td<?= $Page->crop_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_posts_crop_id" class="el_posts_crop_id">
<span<?= $Page->crop_id->viewAttributes() ?>>
<?= $Page->crop_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
        <td<?= $Page->user_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_posts_user_id" class="el_posts_user_id">
<span<?= $Page->user_id->viewAttributes() ?>>
<?= $Page->user_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_title->Visible) { // title ?>
        <td<?= $Page->_title->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_posts__title" class="el_posts__title">
<span<?= $Page->_title->viewAttributes() ?>>
<?= $Page->_title->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->post_type->Visible) { // post_type ?>
        <td<?= $Page->post_type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_posts_post_type" class="el_posts_post_type">
<span<?= $Page->post_type->viewAttributes() ?>>
<?= $Page->post_type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->crop_type->Visible) { // crop_type ?>
        <td<?= $Page->crop_type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_posts_crop_type" class="el_posts_crop_type">
<span<?= $Page->crop_type->viewAttributes() ?>>
<?= $Page->crop_type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->variety->Visible) { // variety ?>
        <td<?= $Page->variety->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_posts_variety" class="el_posts_variety">
<span<?= $Page->variety->viewAttributes() ?>>
<?= $Page->variety->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->media_url->Visible) { // media_url ?>
        <td<?= $Page->media_url->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_posts_media_url" class="el_posts_media_url">
<span<?= $Page->media_url->viewAttributes() ?>>
<?= $Page->media_url->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->thumbnail_url->Visible) { // thumbnail_url ?>
        <td<?= $Page->thumbnail_url->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_posts_thumbnail_url" class="el_posts_thumbnail_url">
<span<?= $Page->thumbnail_url->viewAttributes() ?>>
<?= $Page->thumbnail_url->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->use_thumbnail->Visible) { // use_thumbnail ?>
        <td<?= $Page->use_thumbnail->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_posts_use_thumbnail" class="el_posts_use_thumbnail">
<span<?= $Page->use_thumbnail->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_use_thumbnail_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->use_thumbnail->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->use_thumbnail->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_use_thumbnail_<?= $Page->RowCount ?>"></label>
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
