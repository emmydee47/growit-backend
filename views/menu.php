<?php

namespace PHPMaker2022\growit_2021;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
    $MenuRelativePath = "";
    $MenuLanguage = &$Language;
} else { // Compat reports
    $LANGUAGE_FOLDER = "../lang/";
    $MenuRelativePath = "../";
    $MenuLanguage = Container("language");
}

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(29, "mci_Crops", $MenuLanguage->MenuPhrase("29", "MenuText"), "", -1, "", true, false, true, "fa fa-leaf", "", false, true);
$sideMenu->addMenuItem(6, "mi_crops", $MenuLanguage->MenuPhrase("6", "MenuText"), $MenuRelativePath . "cropslist", 29, "", IsLoggedIn() || AllowListMenu('{21861580-6154-4FBA-85B4-7D9A7F2283C0}crops'), false, false, "", "", false, true);
$sideMenu->addMenuItem(13, "mi_crop_steps", $MenuLanguage->MenuPhrase("13", "MenuText"), $MenuRelativePath . "cropstepslist", 29, "", IsLoggedIn() || AllowListMenu('{21861580-6154-4FBA-85B4-7D9A7F2283C0}crop_steps'), false, false, "", "", false, true);
$sideMenu->addMenuItem(18, "mi_crop_months", $MenuLanguage->MenuPhrase("18", "MenuText"), $MenuRelativePath . "cropmonthslist", 29, "", IsLoggedIn() || AllowListMenu('{21861580-6154-4FBA-85B4-7D9A7F2283C0}crop_months'), false, false, "", "", false, true);
$sideMenu->addMenuItem(11, "mi_crop_tips", $MenuLanguage->MenuPhrase("11", "MenuText"), $MenuRelativePath . "croptipslist", 29, "", IsLoggedIn() || AllowListMenu('{21861580-6154-4FBA-85B4-7D9A7F2283C0}crop_tips'), false, false, "", "", false, true);
$sideMenu->addMenuItem(1, "mi_suggestions", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "suggestionslist", 29, "", IsLoggedIn() || AllowListMenu('{21861580-6154-4FBA-85B4-7D9A7F2283C0}suggestions'), false, false, "", "", false, true);
$sideMenu->addMenuItem(4, "mi_crop_recommendations", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "croprecommendationslist", 29, "", IsLoggedIn() || AllowListMenu('{21861580-6154-4FBA-85B4-7D9A7F2283C0}crop_recommendations'), false, false, "", "", false, true);
$sideMenu->addMenuItem(30, "mci_Jobs", $MenuLanguage->MenuPhrase("30", "MenuText"), "", -1, "", true, false, true, "fa fa-tasks", "", false, true);
$sideMenu->addMenuItem(2, "mi_SowList", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "sowlistlist", 30, "", IsLoggedIn() || AllowListMenu('{21861580-6154-4FBA-85B4-7D9A7F2283C0}Sow List'), false, false, "", "", false, true);
$sideMenu->addMenuItem(22, "mi_PlantList", $MenuLanguage->MenuPhrase("22", "MenuText"), $MenuRelativePath . "plantlistlist", 30, "", IsLoggedIn() || AllowListMenu('{21861580-6154-4FBA-85B4-7D9A7F2283C0}Plant List'), false, false, "", "", false, true);
$sideMenu->addMenuItem(12, "mi_HarvestList", $MenuLanguage->MenuPhrase("12", "MenuText"), $MenuRelativePath . "harvestlistlist", 30, "", IsLoggedIn() || AllowListMenu('{21861580-6154-4FBA-85B4-7D9A7F2283C0}Harvest List'), false, false, "", "", false, true);
$sideMenu->addMenuItem(10, "mi_reminders", $MenuLanguage->MenuPhrase("10", "MenuText"), $MenuRelativePath . "reminderslist", 30, "", IsLoggedIn() || AllowListMenu('{21861580-6154-4FBA-85B4-7D9A7F2283C0}reminders'), false, false, "", "", false, true);
$sideMenu->addMenuItem(24, "mi_job_histories", $MenuLanguage->MenuPhrase("24", "MenuText"), $MenuRelativePath . "jobhistorieslist", 30, "", IsLoggedIn() || AllowListMenu('{21861580-6154-4FBA-85B4-7D9A7F2283C0}job_histories'), false, false, "", "", false, true);
$sideMenu->addMenuItem(31, "mci_Posts_&_Articles", $MenuLanguage->MenuPhrase("31", "MenuText"), "", -1, "", true, false, true, "fa fa-clipboard", "", false, true);
$sideMenu->addMenuItem(8, "mi_article_categories", $MenuLanguage->MenuPhrase("8", "MenuText"), $MenuRelativePath . "articlecategorieslist", 31, "", IsLoggedIn() || AllowListMenu('{21861580-6154-4FBA-85B4-7D9A7F2283C0}article_categories'), false, false, "", "", false, true);
$sideMenu->addMenuItem(9, "mi_articles", $MenuLanguage->MenuPhrase("9", "MenuText"), $MenuRelativePath . "articleslist", 31, "", IsLoggedIn() || AllowListMenu('{21861580-6154-4FBA-85B4-7D9A7F2283C0}articles'), false, false, "", "", false, true);
$sideMenu->addMenuItem(25, "mi_posts", $MenuLanguage->MenuPhrase("25", "MenuText"), $MenuRelativePath . "postslist", 31, "", IsLoggedIn() || AllowListMenu('{21861580-6154-4FBA-85B4-7D9A7F2283C0}posts'), false, false, "", "", false, true);
$sideMenu->addMenuItem(32, "mci_Settings", $MenuLanguage->MenuPhrase("32", "MenuText"), "", -1, "", true, false, true, "fa fa-cog", "", false, true);
$sideMenu->addMenuItem(19, "mi_users", $MenuLanguage->MenuPhrase("19", "MenuText"), $MenuRelativePath . "userslist", 32, "", IsLoggedIn() || AllowListMenu('{21861580-6154-4FBA-85B4-7D9A7F2283C0}users'), false, false, "", "", false, true);
$sideMenu->addMenuItem(27, "mi_fcm_notification_messages", $MenuLanguage->MenuPhrase("27", "MenuText"), $MenuRelativePath . "fcmnotificationmessageslist", 32, "", IsLoggedIn() || AllowListMenu('{21861580-6154-4FBA-85B4-7D9A7F2283C0}fcm_notification_messages'), false, false, "", "", false, true);
$sideMenu->addMenuItem(16, "mi_follows", $MenuLanguage->MenuPhrase("16", "MenuText"), $MenuRelativePath . "followslist", 32, "", IsLoggedIn() || AllowListMenu('{21861580-6154-4FBA-85B4-7D9A7F2283C0}follows'), false, false, "", "", false, true);
$sideMenu->addMenuItem(14, "mi_device_id_registrations", $MenuLanguage->MenuPhrase("14", "MenuText"), $MenuRelativePath . "deviceidregistrationslist", 32, "", IsLoggedIn() || AllowListMenu('{21861580-6154-4FBA-85B4-7D9A7F2283C0}device_id_registrations'), false, false, "", "", false, true);
echo $sideMenu->toScript();
