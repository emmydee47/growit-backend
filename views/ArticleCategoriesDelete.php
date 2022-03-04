<?php

namespace PHPMaker2022\growit_2021;

// Page object
$ArticleCategoriesDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { article_categories: currentTable } });
var currentForm, currentPageID;
var farticle_categoriesdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    farticle_categoriesdelete = new ew.Form("farticle_categoriesdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = farticle_categoriesdelete;
    loadjs.done("farticle_categoriesdelete");
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
<form name="farticle_categoriesdelete" id="farticle_categoriesdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="article_categories">
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
<?php if ($Page->_title->Visible) { // title ?>
        <th class="<?= $Page->_title->headerCellClass() ?>"><span id="elh_article_categories__title" class="article_categories__title"><?= $Page->_title->caption() ?></span></th>
<?php } ?>
<?php if ($Page->summary->Visible) { // summary ?>
        <th class="<?= $Page->summary->headerCellClass() ?>"><span id="elh_article_categories_summary" class="article_categories_summary"><?= $Page->summary->caption() ?></span></th>
<?php } ?>
<?php if ($Page->thumbnail_url->Visible) { // thumbnail_url ?>
        <th class="<?= $Page->thumbnail_url->headerCellClass() ?>"><span id="elh_article_categories_thumbnail_url" class="article_categories_thumbnail_url"><?= $Page->thumbnail_url->caption() ?></span></th>
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
<?php if ($Page->_title->Visible) { // title ?>
        <td<?= $Page->_title->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_article_categories__title" class="el_article_categories__title">
<span<?= $Page->_title->viewAttributes() ?>>
<?= $Page->_title->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->summary->Visible) { // summary ?>
        <td<?= $Page->summary->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_article_categories_summary" class="el_article_categories_summary">
<span<?= $Page->summary->viewAttributes() ?>>
<?= $Page->summary->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->thumbnail_url->Visible) { // thumbnail_url ?>
        <td<?= $Page->thumbnail_url->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_article_categories_thumbnail_url" class="el_article_categories_thumbnail_url">
<span>
<?= GetImageViewTag($Page->thumbnail_url, $Page->thumbnail_url->getViewValue()) ?></span>
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
