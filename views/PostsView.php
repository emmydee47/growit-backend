<?php

namespace PHPMaker2022\growit_2021;

// Page object
$PostsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { posts: currentTable } });
var currentForm, currentPageID;
var fpostsview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpostsview = new ew.Form("fpostsview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fpostsview;
    loadjs.done("fpostsview");
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
<form name="fpostsview" id="fpostsview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="posts">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_posts_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_posts_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->crop_id->Visible) { // crop_id ?>
    <tr id="r_crop_id"<?= $Page->crop_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_posts_crop_id"><?= $Page->crop_id->caption() ?></span></td>
        <td data-name="crop_id"<?= $Page->crop_id->cellAttributes() ?>>
<span id="el_posts_crop_id">
<span<?= $Page->crop_id->viewAttributes() ?>>
<?= $Page->crop_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
    <tr id="r_user_id"<?= $Page->user_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_posts_user_id"><?= $Page->user_id->caption() ?></span></td>
        <td data-name="user_id"<?= $Page->user_id->cellAttributes() ?>>
<span id="el_posts_user_id">
<span<?= $Page->user_id->viewAttributes() ?>>
<?= $Page->user_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_title->Visible) { // title ?>
    <tr id="r__title"<?= $Page->_title->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_posts__title"><?= $Page->_title->caption() ?></span></td>
        <td data-name="_title"<?= $Page->_title->cellAttributes() ?>>
<span id="el_posts__title">
<span<?= $Page->_title->viewAttributes() ?>>
<?= $Page->_title->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->post_type->Visible) { // post_type ?>
    <tr id="r_post_type"<?= $Page->post_type->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_posts_post_type"><?= $Page->post_type->caption() ?></span></td>
        <td data-name="post_type"<?= $Page->post_type->cellAttributes() ?>>
<span id="el_posts_post_type">
<span<?= $Page->post_type->viewAttributes() ?>>
<?= $Page->post_type->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->crop_type->Visible) { // crop_type ?>
    <tr id="r_crop_type"<?= $Page->crop_type->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_posts_crop_type"><?= $Page->crop_type->caption() ?></span></td>
        <td data-name="crop_type"<?= $Page->crop_type->cellAttributes() ?>>
<span id="el_posts_crop_type">
<span<?= $Page->crop_type->viewAttributes() ?>>
<?= $Page->crop_type->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->variety->Visible) { // variety ?>
    <tr id="r_variety"<?= $Page->variety->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_posts_variety"><?= $Page->variety->caption() ?></span></td>
        <td data-name="variety"<?= $Page->variety->cellAttributes() ?>>
<span id="el_posts_variety">
<span<?= $Page->variety->viewAttributes() ?>>
<?= $Page->variety->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->media_url->Visible) { // media_url ?>
    <tr id="r_media_url"<?= $Page->media_url->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_posts_media_url"><?= $Page->media_url->caption() ?></span></td>
        <td data-name="media_url"<?= $Page->media_url->cellAttributes() ?>>
<span id="el_posts_media_url">
<span<?= $Page->media_url->viewAttributes() ?>>
<?= $Page->media_url->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->thumbnail_url->Visible) { // thumbnail_url ?>
    <tr id="r_thumbnail_url"<?= $Page->thumbnail_url->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_posts_thumbnail_url"><?= $Page->thumbnail_url->caption() ?></span></td>
        <td data-name="thumbnail_url"<?= $Page->thumbnail_url->cellAttributes() ?>>
<span id="el_posts_thumbnail_url">
<span<?= $Page->thumbnail_url->viewAttributes() ?>>
<?= $Page->thumbnail_url->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->use_thumbnail->Visible) { // use_thumbnail ?>
    <tr id="r_use_thumbnail"<?= $Page->use_thumbnail->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_posts_use_thumbnail"><?= $Page->use_thumbnail->caption() ?></span></td>
        <td data-name="use_thumbnail"<?= $Page->use_thumbnail->cellAttributes() ?>>
<span id="el_posts_use_thumbnail">
<span<?= $Page->use_thumbnail->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_use_thumbnail_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->use_thumbnail->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->use_thumbnail->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_use_thumbnail_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_content->Visible) { // content ?>
    <tr id="r__content"<?= $Page->_content->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_posts__content"><?= $Page->_content->caption() ?></span></td>
        <td data-name="_content"<?= $Page->_content->cellAttributes() ?>>
<span id="el_posts__content">
<span<?= $Page->_content->viewAttributes() ?>>
<?= $Page->_content->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->deleted->Visible) { // deleted ?>
    <tr id="r_deleted"<?= $Page->deleted->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_posts_deleted"><?= $Page->deleted->caption() ?></span></td>
        <td data-name="deleted"<?= $Page->deleted->cellAttributes() ?>>
<span id="el_posts_deleted">
<span<?= $Page->deleted->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_deleted_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->deleted->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->deleted->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_deleted_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <tr id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_posts_created_at"><?= $Page->created_at->caption() ?></span></td>
        <td data-name="created_at"<?= $Page->created_at->cellAttributes() ?>>
<span id="el_posts_created_at">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
    <tr id="r_updated_at"<?= $Page->updated_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_posts_updated_at"><?= $Page->updated_at->caption() ?></span></td>
        <td data-name="updated_at"<?= $Page->updated_at->cellAttributes() ?>>
<span id="el_posts_updated_at">
<span<?= $Page->updated_at->viewAttributes() ?>>
<?= $Page->updated_at->getViewValue() ?></span>
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
