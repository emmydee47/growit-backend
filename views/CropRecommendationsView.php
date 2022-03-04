<?php

namespace PHPMaker2022\growit_2021;

// Page object
$CropRecommendationsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { crop_recommendations: currentTable } });
var currentForm, currentPageID;
var fcrop_recommendationsview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcrop_recommendationsview = new ew.Form("fcrop_recommendationsview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fcrop_recommendationsview;
    loadjs.done("fcrop_recommendationsview");
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
<form name="fcrop_recommendationsview" id="fcrop_recommendationsview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="crop_recommendations">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crop_recommendations_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_crop_recommendations_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->crop_id->Visible) { // crop_id ?>
    <tr id="r_crop_id"<?= $Page->crop_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crop_recommendations_crop_id"><?= $Page->crop_id->caption() ?></span></td>
        <td data-name="crop_id"<?= $Page->crop_id->cellAttributes() ?>>
<span id="el_crop_recommendations_crop_id">
<span<?= $Page->crop_id->viewAttributes() ?>>
<?= $Page->crop_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->recommendation->Visible) { // recommendation ?>
    <tr id="r_recommendation"<?= $Page->recommendation->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crop_recommendations_recommendation"><?= $Page->recommendation->caption() ?></span></td>
        <td data-name="recommendation"<?= $Page->recommendation->cellAttributes() ?>>
<span id="el_crop_recommendations_recommendation">
<span<?= $Page->recommendation->viewAttributes() ?>>
<?= $Page->recommendation->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->affiliate_links->Visible) { // affiliate_links ?>
    <tr id="r_affiliate_links"<?= $Page->affiliate_links->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crop_recommendations_affiliate_links"><?= $Page->affiliate_links->caption() ?></span></td>
        <td data-name="affiliate_links"<?= $Page->affiliate_links->cellAttributes() ?>>
<span id="el_crop_recommendations_affiliate_links">
<span<?= $Page->affiliate_links->viewAttributes() ?>>
<?= $Page->affiliate_links->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->thumbnail_url->Visible) { // thumbnail_url ?>
    <tr id="r_thumbnail_url"<?= $Page->thumbnail_url->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crop_recommendations_thumbnail_url"><?= $Page->thumbnail_url->caption() ?></span></td>
        <td data-name="thumbnail_url"<?= $Page->thumbnail_url->cellAttributes() ?>>
<span id="el_crop_recommendations_thumbnail_url">
<span>
<?= GetFileViewTag($Page->thumbnail_url, $Page->thumbnail_url->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
    <tr id="r_updated_at"<?= $Page->updated_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crop_recommendations_updated_at"><?= $Page->updated_at->caption() ?></span></td>
        <td data-name="updated_at"<?= $Page->updated_at->cellAttributes() ?>>
<span id="el_crop_recommendations_updated_at">
<span<?= $Page->updated_at->viewAttributes() ?>>
<?= $Page->updated_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <tr id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_crop_recommendations_created_at"><?= $Page->created_at->caption() ?></span></td>
        <td data-name="created_at"<?= $Page->created_at->cellAttributes() ?>>
<span id="el_crop_recommendations_created_at">
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
