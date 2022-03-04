<?php

namespace PHPMaker2022\growit_2021;

// Page object
$UsersEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { users: currentTable } });
var currentForm, currentPageID;
var fusersedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fusersedit = new ew.Form("fusersedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fusersedit;

    // Add fields
    var fields = currentTable.fields;
    fusersedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null, ew.Validators.guid], fields.id.isInvalid],
        ["auth_id", [fields.auth_id.visible && fields.auth_id.required ? ew.Validators.required(fields.auth_id.caption) : null], fields.auth_id.isInvalid],
        ["avatar", [fields.avatar.visible && fields.avatar.required ? ew.Validators.required(fields.avatar.caption) : null], fields.avatar.isInvalid],
        ["_username", [fields._username.visible && fields._username.required ? ew.Validators.required(fields._username.caption) : null], fields._username.isInvalid],
        ["fullname", [fields.fullname.visible && fields.fullname.required ? ew.Validators.required(fields.fullname.caption) : null], fields.fullname.isInvalid],
        ["_password", [fields._password.visible && fields._password.required ? ew.Validators.required(fields._password.caption) : null], fields._password.isInvalid],
        ["role_id", [fields.role_id.visible && fields.role_id.required ? ew.Validators.required(fields.role_id.caption) : null], fields.role_id.isInvalid],
        ["_token", [fields._token.visible && fields._token.required ? ew.Validators.required(fields._token.caption) : null], fields._token.isInvalid],
        ["_email", [fields._email.visible && fields._email.required ? ew.Validators.required(fields._email.caption) : null], fields._email.isInvalid],
        ["gender", [fields.gender.visible && fields.gender.required ? ew.Validators.required(fields.gender.caption) : null], fields.gender.isInvalid],
        ["date_of_birth", [fields.date_of_birth.visible && fields.date_of_birth.required ? ew.Validators.required(fields.date_of_birth.caption) : null, ew.Validators.datetime(fields.date_of_birth.clientFormatPattern)], fields.date_of_birth.isInvalid],
        ["biography", [fields.biography.visible && fields.biography.required ? ew.Validators.required(fields.biography.caption) : null], fields.biography.isInvalid],
        ["last_login", [fields.last_login.visible && fields.last_login.required ? ew.Validators.required(fields.last_login.caption) : null, ew.Validators.datetime(fields.last_login.clientFormatPattern)], fields.last_login.isInvalid],
        ["is_verified", [fields.is_verified.visible && fields.is_verified.required ? ew.Validators.required(fields.is_verified.caption) : null], fields.is_verified.isInvalid],
        ["location", [fields.location.visible && fields.location.required ? ew.Validators.required(fields.location.caption) : null], fields.location.isInvalid],
        ["created_at", [fields.created_at.visible && fields.created_at.required ? ew.Validators.required(fields.created_at.caption) : null, ew.Validators.datetime(fields.created_at.clientFormatPattern)], fields.created_at.isInvalid],
        ["updated_at", [fields.updated_at.visible && fields.updated_at.required ? ew.Validators.required(fields.updated_at.caption) : null, ew.Validators.datetime(fields.updated_at.clientFormatPattern)], fields.updated_at.isInvalid]
    ]);

    // Form_CustomValidate
    fusersedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fusersedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fusersedit.lists.is_verified = <?= $Page->is_verified->toClientList($Page) ?>;
    loadjs.done("fusersedit");
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
<form name="fusersedit" id="fusersedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_users_id" for="x_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<input type="<?= $Page->id->getInputTextType() ?>" name="x_id" id="x_id" data-table="users" data-field="x_id" value="<?= $Page->id->EditValue ?>" size="38" maxlength="38" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>"<?= $Page->id->editAttributes() ?> aria-describedby="x_id_help">
<?= $Page->id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage() ?></div>
<input type="hidden" data-table="users" data-field="x_id" data-hidden="1" name="o_id" id="o_id" value="<?= HtmlEncode($Page->id->OldValue ?? $Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->auth_id->Visible) { // auth_id ?>
    <div id="r_auth_id"<?= $Page->auth_id->rowAttributes() ?>>
        <label id="elh_users_auth_id" for="x_auth_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->auth_id->caption() ?><?= $Page->auth_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->auth_id->cellAttributes() ?>>
<span id="el_users_auth_id">
<input type="<?= $Page->auth_id->getInputTextType() ?>" name="x_auth_id" id="x_auth_id" data-table="users" data-field="x_auth_id" value="<?= $Page->auth_id->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->auth_id->getPlaceHolder()) ?>"<?= $Page->auth_id->editAttributes() ?> aria-describedby="x_auth_id_help">
<?= $Page->auth_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->auth_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->avatar->Visible) { // avatar ?>
    <div id="r_avatar"<?= $Page->avatar->rowAttributes() ?>>
        <label id="elh_users_avatar" for="x_avatar" class="<?= $Page->LeftColumnClass ?>"><?= $Page->avatar->caption() ?><?= $Page->avatar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->avatar->cellAttributes() ?>>
<span id="el_users_avatar">
<input type="<?= $Page->avatar->getInputTextType() ?>" name="x_avatar" id="x_avatar" data-table="users" data-field="x_avatar" value="<?= $Page->avatar->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->avatar->getPlaceHolder()) ?>"<?= $Page->avatar->editAttributes() ?> aria-describedby="x_avatar_help">
<?= $Page->avatar->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->avatar->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_username->Visible) { // username ?>
    <div id="r__username"<?= $Page->_username->rowAttributes() ?>>
        <label id="elh_users__username" for="x__username" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_username->caption() ?><?= $Page->_username->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_username->cellAttributes() ?>>
<span id="el_users__username">
<input type="<?= $Page->_username->getInputTextType() ?>" name="x__username" id="x__username" data-table="users" data-field="x__username" value="<?= $Page->_username->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_username->getPlaceHolder()) ?>"<?= $Page->_username->editAttributes() ?> aria-describedby="x__username_help">
<?= $Page->_username->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_username->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->fullname->Visible) { // fullname ?>
    <div id="r_fullname"<?= $Page->fullname->rowAttributes() ?>>
        <label id="elh_users_fullname" for="x_fullname" class="<?= $Page->LeftColumnClass ?>"><?= $Page->fullname->caption() ?><?= $Page->fullname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->fullname->cellAttributes() ?>>
<span id="el_users_fullname">
<input type="<?= $Page->fullname->getInputTextType() ?>" name="x_fullname" id="x_fullname" data-table="users" data-field="x_fullname" value="<?= $Page->fullname->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->fullname->getPlaceHolder()) ?>"<?= $Page->fullname->editAttributes() ?> aria-describedby="x_fullname_help">
<?= $Page->fullname->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->fullname->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
    <div id="r__password"<?= $Page->_password->rowAttributes() ?>>
        <label id="elh_users__password" for="x__password" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_password->caption() ?><?= $Page->_password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_password->cellAttributes() ?>>
<span id="el_users__password">
<input type="<?= $Page->_password->getInputTextType() ?>" name="x__password" id="x__password" data-table="users" data-field="x__password" value="<?= $Page->_password->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_password->getPlaceHolder()) ?>"<?= $Page->_password->editAttributes() ?> aria-describedby="x__password_help">
<?= $Page->_password->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_password->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->role_id->Visible) { // role_id ?>
    <div id="r_role_id"<?= $Page->role_id->rowAttributes() ?>>
        <label id="elh_users_role_id" for="x_role_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->role_id->caption() ?><?= $Page->role_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->role_id->cellAttributes() ?>>
<span id="el_users_role_id">
<input type="<?= $Page->role_id->getInputTextType() ?>" name="x_role_id" id="x_role_id" data-table="users" data-field="x_role_id" value="<?= $Page->role_id->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->role_id->getPlaceHolder()) ?>"<?= $Page->role_id->editAttributes() ?> aria-describedby="x_role_id_help">
<?= $Page->role_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->role_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_token->Visible) { // token ?>
    <div id="r__token"<?= $Page->_token->rowAttributes() ?>>
        <label id="elh_users__token" for="x__token" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_token->caption() ?><?= $Page->_token->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_token->cellAttributes() ?>>
<span id="el_users__token">
<input type="<?= $Page->_token->getInputTextType() ?>" name="x__token" id="x__token" data-table="users" data-field="x__token" value="<?= $Page->_token->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_token->getPlaceHolder()) ?>"<?= $Page->_token->editAttributes() ?> aria-describedby="x__token_help">
<?= $Page->_token->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_token->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
    <div id="r__email"<?= $Page->_email->rowAttributes() ?>>
        <label id="elh_users__email" for="x__email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_email->caption() ?><?= $Page->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_email->cellAttributes() ?>>
<span id="el_users__email">
<input type="<?= $Page->_email->getInputTextType() ?>" name="x__email" id="x__email" data-table="users" data-field="x__email" value="<?= $Page->_email->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_email->getPlaceHolder()) ?>"<?= $Page->_email->editAttributes() ?> aria-describedby="x__email_help">
<?= $Page->_email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->gender->Visible) { // gender ?>
    <div id="r_gender"<?= $Page->gender->rowAttributes() ?>>
        <label id="elh_users_gender" for="x_gender" class="<?= $Page->LeftColumnClass ?>"><?= $Page->gender->caption() ?><?= $Page->gender->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->gender->cellAttributes() ?>>
<span id="el_users_gender">
<input type="<?= $Page->gender->getInputTextType() ?>" name="x_gender" id="x_gender" data-table="users" data-field="x_gender" value="<?= $Page->gender->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->gender->getPlaceHolder()) ?>"<?= $Page->gender->editAttributes() ?> aria-describedby="x_gender_help">
<?= $Page->gender->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->gender->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_of_birth->Visible) { // date_of_birth ?>
    <div id="r_date_of_birth"<?= $Page->date_of_birth->rowAttributes() ?>>
        <label id="elh_users_date_of_birth" for="x_date_of_birth" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_of_birth->caption() ?><?= $Page->date_of_birth->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_of_birth->cellAttributes() ?>>
<span id="el_users_date_of_birth">
<input type="<?= $Page->date_of_birth->getInputTextType() ?>" name="x_date_of_birth" id="x_date_of_birth" data-table="users" data-field="x_date_of_birth" value="<?= $Page->date_of_birth->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_of_birth->getPlaceHolder()) ?>"<?= $Page->date_of_birth->editAttributes() ?> aria-describedby="x_date_of_birth_help">
<?= $Page->date_of_birth->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_of_birth->getErrorMessage() ?></div>
<?php if (!$Page->date_of_birth->ReadOnly && !$Page->date_of_birth->Disabled && !isset($Page->date_of_birth->EditAttrs["readonly"]) && !isset($Page->date_of_birth->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fusersedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fusersedit", "x_date_of_birth", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->biography->Visible) { // biography ?>
    <div id="r_biography"<?= $Page->biography->rowAttributes() ?>>
        <label id="elh_users_biography" for="x_biography" class="<?= $Page->LeftColumnClass ?>"><?= $Page->biography->caption() ?><?= $Page->biography->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->biography->cellAttributes() ?>>
<span id="el_users_biography">
<textarea data-table="users" data-field="x_biography" name="x_biography" id="x_biography" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->biography->getPlaceHolder()) ?>"<?= $Page->biography->editAttributes() ?> aria-describedby="x_biography_help"><?= $Page->biography->EditValue ?></textarea>
<?= $Page->biography->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->biography->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->last_login->Visible) { // last_login ?>
    <div id="r_last_login"<?= $Page->last_login->rowAttributes() ?>>
        <label id="elh_users_last_login" for="x_last_login" class="<?= $Page->LeftColumnClass ?>"><?= $Page->last_login->caption() ?><?= $Page->last_login->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->last_login->cellAttributes() ?>>
<span id="el_users_last_login">
<input type="<?= $Page->last_login->getInputTextType() ?>" name="x_last_login" id="x_last_login" data-table="users" data-field="x_last_login" value="<?= $Page->last_login->EditValue ?>" placeholder="<?= HtmlEncode($Page->last_login->getPlaceHolder()) ?>"<?= $Page->last_login->editAttributes() ?> aria-describedby="x_last_login_help">
<?= $Page->last_login->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->last_login->getErrorMessage() ?></div>
<?php if (!$Page->last_login->ReadOnly && !$Page->last_login->Disabled && !isset($Page->last_login->EditAttrs["readonly"]) && !isset($Page->last_login->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fusersedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fusersedit", "x_last_login", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->is_verified->Visible) { // is_verified ?>
    <div id="r_is_verified"<?= $Page->is_verified->rowAttributes() ?>>
        <label id="elh_users_is_verified" class="<?= $Page->LeftColumnClass ?>"><?= $Page->is_verified->caption() ?><?= $Page->is_verified->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->is_verified->cellAttributes() ?>>
<span id="el_users_is_verified">
<div class="form-check d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->is_verified->isInvalidClass() ?>" data-table="users" data-field="x_is_verified" name="x_is_verified[]" id="x_is_verified_745192" value="1"<?= ConvertToBool($Page->is_verified->CurrentValue) ? " checked" : "" ?><?= $Page->is_verified->editAttributes() ?> aria-describedby="x_is_verified_help">
    <div class="invalid-feedback"><?= $Page->is_verified->getErrorMessage() ?></div>
</div>
<?= $Page->is_verified->getCustomMessage() ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
    <div id="r_location"<?= $Page->location->rowAttributes() ?>>
        <label id="elh_users_location" for="x_location" class="<?= $Page->LeftColumnClass ?>"><?= $Page->location->caption() ?><?= $Page->location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->location->cellAttributes() ?>>
<span id="el_users_location">
<input type="<?= $Page->location->getInputTextType() ?>" name="x_location" id="x_location" data-table="users" data-field="x_location" value="<?= $Page->location->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->location->getPlaceHolder()) ?>"<?= $Page->location->editAttributes() ?> aria-describedby="x_location_help">
<?= $Page->location->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->location->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <div id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <label id="elh_users_created_at" for="x_created_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_at->caption() ?><?= $Page->created_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_at->cellAttributes() ?>>
<span id="el_users_created_at">
<input type="<?= $Page->created_at->getInputTextType() ?>" name="x_created_at" id="x_created_at" data-table="users" data-field="x_created_at" value="<?= $Page->created_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->created_at->getPlaceHolder()) ?>"<?= $Page->created_at->editAttributes() ?> aria-describedby="x_created_at_help">
<?= $Page->created_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_at->getErrorMessage() ?></div>
<?php if (!$Page->created_at->ReadOnly && !$Page->created_at->Disabled && !isset($Page->created_at->EditAttrs["readonly"]) && !isset($Page->created_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fusersedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fusersedit", "x_created_at", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
    <div id="r_updated_at"<?= $Page->updated_at->rowAttributes() ?>>
        <label id="elh_users_updated_at" for="x_updated_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->updated_at->caption() ?><?= $Page->updated_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->updated_at->cellAttributes() ?>>
<span id="el_users_updated_at">
<input type="<?= $Page->updated_at->getInputTextType() ?>" name="x_updated_at" id="x_updated_at" data-table="users" data-field="x_updated_at" value="<?= $Page->updated_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->updated_at->getPlaceHolder()) ?>"<?= $Page->updated_at->editAttributes() ?> aria-describedby="x_updated_at_help">
<?= $Page->updated_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->updated_at->getErrorMessage() ?></div>
<?php if (!$Page->updated_at->ReadOnly && !$Page->updated_at->Disabled && !isset($Page->updated_at->EditAttrs["readonly"]) && !isset($Page->updated_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fusersedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fusersedit", "x_updated_at", jQuery.extend(true, {"useCurrent":false}, options));
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
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
    ew.addEventHandlers("users");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
