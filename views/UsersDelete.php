<?php

namespace PHPMaker2022\growit_2021;

// Page object
$UsersDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { users: currentTable } });
var currentForm, currentPageID;
var fusersdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fusersdelete = new ew.Form("fusersdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fusersdelete;
    loadjs.done("fusersdelete");
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
<form name="fusersdelete" id="fusersdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="users">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_users_id" class="users_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->auth_id->Visible) { // auth_id ?>
        <th class="<?= $Page->auth_id->headerCellClass() ?>"><span id="elh_users_auth_id" class="users_auth_id"><?= $Page->auth_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->avatar->Visible) { // avatar ?>
        <th class="<?= $Page->avatar->headerCellClass() ?>"><span id="elh_users_avatar" class="users_avatar"><?= $Page->avatar->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_username->Visible) { // username ?>
        <th class="<?= $Page->_username->headerCellClass() ?>"><span id="elh_users__username" class="users__username"><?= $Page->_username->caption() ?></span></th>
<?php } ?>
<?php if ($Page->fullname->Visible) { // fullname ?>
        <th class="<?= $Page->fullname->headerCellClass() ?>"><span id="elh_users_fullname" class="users_fullname"><?= $Page->fullname->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
        <th class="<?= $Page->_password->headerCellClass() ?>"><span id="elh_users__password" class="users__password"><?= $Page->_password->caption() ?></span></th>
<?php } ?>
<?php if ($Page->role_id->Visible) { // role_id ?>
        <th class="<?= $Page->role_id->headerCellClass() ?>"><span id="elh_users_role_id" class="users_role_id"><?= $Page->role_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_token->Visible) { // token ?>
        <th class="<?= $Page->_token->headerCellClass() ?>"><span id="elh_users__token" class="users__token"><?= $Page->_token->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <th class="<?= $Page->_email->headerCellClass() ?>"><span id="elh_users__email" class="users__email"><?= $Page->_email->caption() ?></span></th>
<?php } ?>
<?php if ($Page->gender->Visible) { // gender ?>
        <th class="<?= $Page->gender->headerCellClass() ?>"><span id="elh_users_gender" class="users_gender"><?= $Page->gender->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_of_birth->Visible) { // date_of_birth ?>
        <th class="<?= $Page->date_of_birth->headerCellClass() ?>"><span id="elh_users_date_of_birth" class="users_date_of_birth"><?= $Page->date_of_birth->caption() ?></span></th>
<?php } ?>
<?php if ($Page->last_login->Visible) { // last_login ?>
        <th class="<?= $Page->last_login->headerCellClass() ?>"><span id="elh_users_last_login" class="users_last_login"><?= $Page->last_login->caption() ?></span></th>
<?php } ?>
<?php if ($Page->is_verified->Visible) { // is_verified ?>
        <th class="<?= $Page->is_verified->headerCellClass() ?>"><span id="elh_users_is_verified" class="users_is_verified"><?= $Page->is_verified->caption() ?></span></th>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
        <th class="<?= $Page->location->headerCellClass() ?>"><span id="elh_users_location" class="users_location"><?= $Page->location->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th class="<?= $Page->created_at->headerCellClass() ?>"><span id="elh_users_created_at" class="users_created_at"><?= $Page->created_at->caption() ?></span></th>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
        <th class="<?= $Page->updated_at->headerCellClass() ?>"><span id="elh_users_updated_at" class="users_updated_at"><?= $Page->updated_at->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_users_id" class="el_users_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->auth_id->Visible) { // auth_id ?>
        <td<?= $Page->auth_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_auth_id" class="el_users_auth_id">
<span<?= $Page->auth_id->viewAttributes() ?>>
<?= $Page->auth_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->avatar->Visible) { // avatar ?>
        <td<?= $Page->avatar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_avatar" class="el_users_avatar">
<span<?= $Page->avatar->viewAttributes() ?>>
<?= $Page->avatar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_username->Visible) { // username ?>
        <td<?= $Page->_username->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users__username" class="el_users__username">
<span<?= $Page->_username->viewAttributes() ?>>
<?= $Page->_username->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->fullname->Visible) { // fullname ?>
        <td<?= $Page->fullname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_fullname" class="el_users_fullname">
<span<?= $Page->fullname->viewAttributes() ?>>
<?= $Page->fullname->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
        <td<?= $Page->_password->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users__password" class="el_users__password">
<span<?= $Page->_password->viewAttributes() ?>>
<?= $Page->_password->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->role_id->Visible) { // role_id ?>
        <td<?= $Page->role_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_role_id" class="el_users_role_id">
<span<?= $Page->role_id->viewAttributes() ?>>
<?= $Page->role_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_token->Visible) { // token ?>
        <td<?= $Page->_token->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users__token" class="el_users__token">
<span<?= $Page->_token->viewAttributes() ?>>
<?= $Page->_token->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <td<?= $Page->_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users__email" class="el_users__email">
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->gender->Visible) { // gender ?>
        <td<?= $Page->gender->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_gender" class="el_users_gender">
<span<?= $Page->gender->viewAttributes() ?>>
<?= $Page->gender->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_of_birth->Visible) { // date_of_birth ?>
        <td<?= $Page->date_of_birth->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_date_of_birth" class="el_users_date_of_birth">
<span<?= $Page->date_of_birth->viewAttributes() ?>>
<?= $Page->date_of_birth->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->last_login->Visible) { // last_login ?>
        <td<?= $Page->last_login->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_last_login" class="el_users_last_login">
<span<?= $Page->last_login->viewAttributes() ?>>
<?= $Page->last_login->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->is_verified->Visible) { // is_verified ?>
        <td<?= $Page->is_verified->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_is_verified" class="el_users_is_verified">
<span<?= $Page->is_verified->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_is_verified_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->is_verified->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->is_verified->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_is_verified_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
        <td<?= $Page->location->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_location" class="el_users_location">
<span<?= $Page->location->viewAttributes() ?>>
<?= $Page->location->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <td<?= $Page->created_at->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_created_at" class="el_users_created_at">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
        <td<?= $Page->updated_at->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_updated_at" class="el_users_updated_at">
<span<?= $Page->updated_at->viewAttributes() ?>>
<?= $Page->updated_at->getViewValue() ?></span>
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
