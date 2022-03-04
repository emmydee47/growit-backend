<?php

namespace PHPMaker2022\growit_2021;

// Page object
$ArticleCategoriesView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { article_categories: currentTable } });
var currentForm, currentPageID;
var farticle_categoriesview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    farticle_categoriesview = new ew.Form("farticle_categoriesview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = farticle_categoriesview;
    loadjs.done("farticle_categoriesview");
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
<form name="farticle_categoriesview" id="farticle_categoriesview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="article_categories">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_article_categories_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_article_categories_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_title->Visible) { // title ?>
    <tr id="r__title"<?= $Page->_title->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_article_categories__title"><?= $Page->_title->caption() ?></span></td>
        <td data-name="_title"<?= $Page->_title->cellAttributes() ?>>
<span id="el_article_categories__title">
<span<?= $Page->_title->viewAttributes() ?>>
<?= $Page->_title->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->summary->Visible) { // summary ?>
    <tr id="r_summary"<?= $Page->summary->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_article_categories_summary"><?= $Page->summary->caption() ?></span></td>
        <td data-name="summary"<?= $Page->summary->cellAttributes() ?>>
<span id="el_article_categories_summary">
<span<?= $Page->summary->viewAttributes() ?>>
<?= $Page->summary->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->thumbnail_url->Visible) { // thumbnail_url ?>
    <tr id="r_thumbnail_url"<?= $Page->thumbnail_url->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_article_categories_thumbnail_url"><?= $Page->thumbnail_url->caption() ?></span></td>
        <td data-name="thumbnail_url"<?= $Page->thumbnail_url->cellAttributes() ?>>
<span id="el_article_categories_thumbnail_url">
<span>
<?= GetImageViewTag($Page->thumbnail_url, $Page->thumbnail_url->getViewValue()) ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->image_url->Visible) { // image_url ?>
    <tr id="r_image_url"<?= $Page->image_url->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_article_categories_image_url"><?= $Page->image_url->caption() ?></span></td>
        <td data-name="image_url"<?= $Page->image_url->cellAttributes() ?>>
<span id="el_article_categories_image_url">
<span>
<?= GetFileViewTag($Page->image_url, $Page->image_url->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
    <tr id="r_updated_at"<?= $Page->updated_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_article_categories_updated_at"><?= $Page->updated_at->caption() ?></span></td>
        <td data-name="updated_at"<?= $Page->updated_at->cellAttributes() ?>>
<span id="el_article_categories_updated_at">
<span<?= $Page->updated_at->viewAttributes() ?>>
<?= $Page->updated_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <tr id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_article_categories_created_at"><?= $Page->created_at->caption() ?></span></td>
        <td data-name="created_at"<?= $Page->created_at->cellAttributes() ?>>
<span id="el_article_categories_created_at">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
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
