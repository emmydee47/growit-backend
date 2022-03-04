<?php

namespace PHPMaker2022\growit_2021;

// Page object
$FcmNotificationMessagesAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { fcm_notification_messages: currentTable } });
var currentForm, currentPageID;
var ffcm_notification_messagesadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ffcm_notification_messagesadd = new ew.Form("ffcm_notification_messagesadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = ffcm_notification_messagesadd;

    // Add fields
    var fields = currentTable.fields;
    ffcm_notification_messagesadd.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null, ew.Validators.guid], fields.id.isInvalid],
        ["user_id", [fields.user_id.visible && fields.user_id.required ? ew.Validators.required(fields.user_id.caption) : null], fields.user_id.isInvalid],
        ["notification_message", [fields.notification_message.visible && fields.notification_message.required ? ew.Validators.required(fields.notification_message.caption) : null], fields.notification_message.isInvalid],
        ["notification_type", [fields.notification_type.visible && fields.notification_type.required ? ew.Validators.required(fields.notification_type.caption) : null], fields.notification_type.isInvalid],
        ["notifier_id", [fields.notifier_id.visible && fields.notifier_id.required ? ew.Validators.required(fields.notifier_id.caption) : null], fields.notifier_id.isInvalid],
        ["created_at", [fields.created_at.visible && fields.created_at.required ? ew.Validators.required(fields.created_at.caption) : null, ew.Validators.datetime(fields.created_at.clientFormatPattern)], fields.created_at.isInvalid],
        ["updated_at", [fields.updated_at.visible && fields.updated_at.required ? ew.Validators.required(fields.updated_at.caption) : null, ew.Validators.datetime(fields.updated_at.clientFormatPattern)], fields.updated_at.isInvalid]
    ]);

    // Form_CustomValidate
    ffcm_notification_messagesadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ffcm_notification_messagesadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("ffcm_notification_messagesadd");
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
<form name="ffcm_notification_messagesadd" id="ffcm_notification_messagesadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="fcm_notification_messages">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_fcm_notification_messages_id" for="x_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_fcm_notification_messages_id">
<input type="<?= $Page->id->getInputTextType() ?>" name="x_id" id="x_id" data-table="fcm_notification_messages" data-field="x_id" value="<?= $Page->id->EditValue ?>" size="38" maxlength="38" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>"<?= $Page->id->editAttributes() ?> aria-describedby="x_id_help">
<?= $Page->id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
    <div id="r_user_id"<?= $Page->user_id->rowAttributes() ?>>
        <label id="elh_fcm_notification_messages_user_id" for="x_user_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->user_id->caption() ?><?= $Page->user_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->user_id->cellAttributes() ?>>
<span id="el_fcm_notification_messages_user_id">
    <select
        id="x_user_id"
        name="x_user_id"
        class="form-select ew-select<?= $Page->user_id->isInvalidClass() ?>"
        data-select2-id="ffcm_notification_messagesadd_x_user_id"
        data-table="fcm_notification_messages"
        data-field="x_user_id"
        data-value-separator="<?= $Page->user_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->user_id->getPlaceHolder()) ?>"
        <?= $Page->user_id->editAttributes() ?>>
        <?= $Page->user_id->selectOptionListHtml("x_user_id") ?>
    </select>
    <?= $Page->user_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->user_id->getErrorMessage() ?></div>
<script>
loadjs.ready("ffcm_notification_messagesadd", function() {
    var options = { name: "x_user_id", selectId: "ffcm_notification_messagesadd_x_user_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ffcm_notification_messagesadd.lists.user_id.lookupOptions.length) {
        options.data = { id: "x_user_id", form: "ffcm_notification_messagesadd" };
    } else {
        options.ajax = { id: "x_user_id", form: "ffcm_notification_messagesadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.fcm_notification_messages.fields.user_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->notification_message->Visible) { // notification_message ?>
    <div id="r_notification_message"<?= $Page->notification_message->rowAttributes() ?>>
        <label id="elh_fcm_notification_messages_notification_message" for="x_notification_message" class="<?= $Page->LeftColumnClass ?>"><?= $Page->notification_message->caption() ?><?= $Page->notification_message->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->notification_message->cellAttributes() ?>>
<span id="el_fcm_notification_messages_notification_message">
<textarea data-table="fcm_notification_messages" data-field="x_notification_message" name="x_notification_message" id="x_notification_message" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->notification_message->getPlaceHolder()) ?>"<?= $Page->notification_message->editAttributes() ?> aria-describedby="x_notification_message_help"><?= $Page->notification_message->EditValue ?></textarea>
<?= $Page->notification_message->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->notification_message->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->notification_type->Visible) { // notification_type ?>
    <div id="r_notification_type"<?= $Page->notification_type->rowAttributes() ?>>
        <label id="elh_fcm_notification_messages_notification_type" for="x_notification_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->notification_type->caption() ?><?= $Page->notification_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->notification_type->cellAttributes() ?>>
<span id="el_fcm_notification_messages_notification_type">
<textarea data-table="fcm_notification_messages" data-field="x_notification_type" name="x_notification_type" id="x_notification_type" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->notification_type->getPlaceHolder()) ?>"<?= $Page->notification_type->editAttributes() ?> aria-describedby="x_notification_type_help"><?= $Page->notification_type->EditValue ?></textarea>
<?= $Page->notification_type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->notification_type->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->notifier_id->Visible) { // notifier_id ?>
    <div id="r_notifier_id"<?= $Page->notifier_id->rowAttributes() ?>>
        <label id="elh_fcm_notification_messages_notifier_id" for="x_notifier_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->notifier_id->caption() ?><?= $Page->notifier_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->notifier_id->cellAttributes() ?>>
<span id="el_fcm_notification_messages_notifier_id">
<input type="<?= $Page->notifier_id->getInputTextType() ?>" name="x_notifier_id" id="x_notifier_id" data-table="fcm_notification_messages" data-field="x_notifier_id" value="<?= $Page->notifier_id->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->notifier_id->getPlaceHolder()) ?>"<?= $Page->notifier_id->editAttributes() ?> aria-describedby="x_notifier_id_help">
<?= $Page->notifier_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->notifier_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <div id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <label id="elh_fcm_notification_messages_created_at" for="x_created_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_at->caption() ?><?= $Page->created_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_at->cellAttributes() ?>>
<span id="el_fcm_notification_messages_created_at">
<input type="<?= $Page->created_at->getInputTextType() ?>" name="x_created_at" id="x_created_at" data-table="fcm_notification_messages" data-field="x_created_at" value="<?= $Page->created_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->created_at->getPlaceHolder()) ?>"<?= $Page->created_at->editAttributes() ?> aria-describedby="x_created_at_help">
<?= $Page->created_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_at->getErrorMessage() ?></div>
<?php if (!$Page->created_at->ReadOnly && !$Page->created_at->Disabled && !isset($Page->created_at->EditAttrs["readonly"]) && !isset($Page->created_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ffcm_notification_messagesadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ffcm_notification_messagesadd", "x_created_at", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
    <div id="r_updated_at"<?= $Page->updated_at->rowAttributes() ?>>
        <label id="elh_fcm_notification_messages_updated_at" for="x_updated_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->updated_at->caption() ?><?= $Page->updated_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->updated_at->cellAttributes() ?>>
<span id="el_fcm_notification_messages_updated_at">
<input type="<?= $Page->updated_at->getInputTextType() ?>" name="x_updated_at" id="x_updated_at" data-table="fcm_notification_messages" data-field="x_updated_at" value="<?= $Page->updated_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->updated_at->getPlaceHolder()) ?>"<?= $Page->updated_at->editAttributes() ?> aria-describedby="x_updated_at_help">
<?= $Page->updated_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->updated_at->getErrorMessage() ?></div>
<?php if (!$Page->updated_at->ReadOnly && !$Page->updated_at->Disabled && !isset($Page->updated_at->EditAttrs["readonly"]) && !isset($Page->updated_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ffcm_notification_messagesadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ffcm_notification_messagesadd", "x_updated_at", jQuery.extend(true, {"useCurrent":false}, options));
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
    ew.addEventHandlers("fcm_notification_messages");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
