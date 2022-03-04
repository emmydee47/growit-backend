<?php

namespace PHPMaker2022\growit_2021;

// Page object
$ArticlesView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { articles: currentTable } });
var currentForm, currentPageID;
var farticlesview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    farticlesview = new ew.Form("farticlesview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = farticlesview;
    loadjs.done("farticlesview");
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
<form name="farticlesview" id="farticlesview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="articles">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_articles_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_articles_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_title->Visible) { // title ?>
    <tr id="r__title"<?= $Page->_title->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_articles__title"><?= $Page->_title->caption() ?></span></td>
        <td data-name="_title"<?= $Page->_title->cellAttributes() ?>>
<span id="el_articles__title">
<span<?= $Page->_title->viewAttributes() ?>>
<?= $Page->_title->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_content->Visible) { // content ?>
    <tr id="r__content"<?= $Page->_content->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_articles__content"><?= $Page->_content->caption() ?></span></td>
        <td data-name="_content"<?= $Page->_content->cellAttributes() ?>>
<span id="el_articles__content">
<span<?= $Page->_content->viewAttributes() ?>>
<?= $Page->_content->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->usefull_links->Visible) { // usefull_links ?>
    <tr id="r_usefull_links"<?= $Page->usefull_links->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_articles_usefull_links"><?= $Page->usefull_links->caption() ?></span></td>
        <td data-name="usefull_links"<?= $Page->usefull_links->cellAttributes() ?>>
<span id="el_articles_usefull_links">
<span<?= $Page->usefull_links->viewAttributes() ?>>
<?= $Page->usefull_links->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->media_url->Visible) { // media_url ?>
    <tr id="r_media_url"<?= $Page->media_url->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_articles_media_url"><?= $Page->media_url->caption() ?></span></td>
        <td data-name="media_url"<?= $Page->media_url->cellAttributes() ?>>
<span id="el_articles_media_url">
<span>
<?= GetFileViewTag($Page->media_url, $Page->media_url->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->article_category_id->Visible) { // article_category_id ?>
    <tr id="r_article_category_id"<?= $Page->article_category_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_articles_article_category_id"><?= $Page->article_category_id->caption() ?></span></td>
        <td data-name="article_category_id"<?= $Page->article_category_id->cellAttributes() ?>>
<span id="el_articles_article_category_id">
<span<?= $Page->article_category_id->viewAttributes() ?>>
<?= $Page->article_category_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
    <tr id="r_updated_at"<?= $Page->updated_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_articles_updated_at"><?= $Page->updated_at->caption() ?></span></td>
        <td data-name="updated_at"<?= $Page->updated_at->cellAttributes() ?>>
<span id="el_articles_updated_at">
<span<?= $Page->updated_at->viewAttributes() ?>>
<?= $Page->updated_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <tr id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_articles_created_at"><?= $Page->created_at->caption() ?></span></td>
        <td data-name="created_at"<?= $Page->created_at->cellAttributes() ?>>
<span id="el_articles_created_at">
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
