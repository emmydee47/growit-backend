<?php

namespace PHPMaker2022\growit_2021;

// Page object
$SuggestionsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { suggestions: currentTable } });
var currentForm, currentPageID;
var fsuggestionsdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fsuggestionsdelete = new ew.Form("fsuggestionsdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fsuggestionsdelete;
    loadjs.done("fsuggestionsdelete");
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
<form name="fsuggestionsdelete" id="fsuggestionsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="suggestions">
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
<?php if ($Page->month->Visible) { // month ?>
        <th class="<?= $Page->month->headerCellClass() ?>"><span id="elh_suggestions_month" class="suggestions_month"><?= $Page->month->caption() ?></span></th>
<?php } ?>
<?php if ($Page->crop_id->Visible) { // crop_id ?>
        <th class="<?= $Page->crop_id->headerCellClass() ?>"><span id="elh_suggestions_crop_id" class="suggestions_crop_id"><?= $Page->crop_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_content->Visible) { // content ?>
        <th class="<?= $Page->_content->headerCellClass() ?>"><span id="elh_suggestions__content" class="suggestions__content"><?= $Page->_content->caption() ?></span></th>
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
<?php if ($Page->month->Visible) { // month ?>
        <td<?= $Page->month->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_suggestions_month" class="el_suggestions_month">
<span<?= $Page->month->viewAttributes() ?>>
<?= $Page->month->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->crop_id->Visible) { // crop_id ?>
        <td<?= $Page->crop_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_suggestions_crop_id" class="el_suggestions_crop_id">
<span<?= $Page->crop_id->viewAttributes() ?>>
<?= $Page->crop_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_content->Visible) { // content ?>
        <td<?= $Page->_content->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_suggestions__content" class="el_suggestions__content">
<span<?= $Page->_content->viewAttributes() ?>>
<?= $Page->_content->getViewValue() ?></span>
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
