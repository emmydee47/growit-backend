<?php

namespace PHPMaker2022\growit_2021;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

// Handle Routes
return function (App $app) {
    // suggestions
    $app->map(["GET","POST","OPTIONS"], '/suggestionslist[/{id}]', SuggestionsController::class . ':list')->add(PermissionMiddleware::class)->setName('suggestionslist-suggestions-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/suggestionsadd[/{id}]', SuggestionsController::class . ':add')->add(PermissionMiddleware::class)->setName('suggestionsadd-suggestions-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/suggestionsview[/{id}]', SuggestionsController::class . ':view')->add(PermissionMiddleware::class)->setName('suggestionsview-suggestions-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/suggestionsedit[/{id}]', SuggestionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('suggestionsedit-suggestions-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/suggestionsdelete[/{id}]', SuggestionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('suggestionsdelete-suggestions-delete'); // delete
    $app->group(
        '/suggestions',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', SuggestionsController::class . ':list')->add(PermissionMiddleware::class)->setName('suggestions/list-suggestions-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', SuggestionsController::class . ':add')->add(PermissionMiddleware::class)->setName('suggestions/add-suggestions-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', SuggestionsController::class . ':view')->add(PermissionMiddleware::class)->setName('suggestions/view-suggestions-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', SuggestionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('suggestions/edit-suggestions-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', SuggestionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('suggestions/delete-suggestions-delete-2'); // delete
        }
    );

    // SowList
    $app->map(["GET","POST","OPTIONS"], '/sowlistlist', SowListController::class . ':list')->add(PermissionMiddleware::class)->setName('sowlistlist-SowList-list'); // list
    $app->group(
        '/sowlist',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '', SowListController::class . ':list')->add(PermissionMiddleware::class)->setName('sowlist/list-SowList-list-2'); // list
        }
    );

    // crop_recommendations
    $app->map(["GET","POST","OPTIONS"], '/croprecommendationslist[/{id}]', CropRecommendationsController::class . ':list')->add(PermissionMiddleware::class)->setName('croprecommendationslist-crop_recommendations-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/croprecommendationsadd[/{id}]', CropRecommendationsController::class . ':add')->add(PermissionMiddleware::class)->setName('croprecommendationsadd-crop_recommendations-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/croprecommendationsview[/{id}]', CropRecommendationsController::class . ':view')->add(PermissionMiddleware::class)->setName('croprecommendationsview-crop_recommendations-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/croprecommendationsedit[/{id}]', CropRecommendationsController::class . ':edit')->add(PermissionMiddleware::class)->setName('croprecommendationsedit-crop_recommendations-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/croprecommendationsdelete[/{id}]', CropRecommendationsController::class . ':delete')->add(PermissionMiddleware::class)->setName('croprecommendationsdelete-crop_recommendations-delete'); // delete
    $app->group(
        '/crop_recommendations',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', CropRecommendationsController::class . ':list')->add(PermissionMiddleware::class)->setName('crop_recommendations/list-crop_recommendations-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', CropRecommendationsController::class . ':add')->add(PermissionMiddleware::class)->setName('crop_recommendations/add-crop_recommendations-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', CropRecommendationsController::class . ':view')->add(PermissionMiddleware::class)->setName('crop_recommendations/view-crop_recommendations-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', CropRecommendationsController::class . ':edit')->add(PermissionMiddleware::class)->setName('crop_recommendations/edit-crop_recommendations-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', CropRecommendationsController::class . ':delete')->add(PermissionMiddleware::class)->setName('crop_recommendations/delete-crop_recommendations-delete-2'); // delete
        }
    );

    // jobs
    $app->map(["GET","POST","OPTIONS"], '/jobslist[/{id}]', JobsController::class . ':list')->add(PermissionMiddleware::class)->setName('jobslist-jobs-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jobsview[/{id}]', JobsController::class . ':view')->add(PermissionMiddleware::class)->setName('jobsview-jobs-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/jobsedit[/{id}]', JobsController::class . ':edit')->add(PermissionMiddleware::class)->setName('jobsedit-jobs-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/jobsdelete[/{id}]', JobsController::class . ':delete')->add(PermissionMiddleware::class)->setName('jobsdelete-jobs-delete'); // delete
    $app->group(
        '/jobs',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', JobsController::class . ':list')->add(PermissionMiddleware::class)->setName('jobs/list-jobs-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', JobsController::class . ':view')->add(PermissionMiddleware::class)->setName('jobs/view-jobs-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', JobsController::class . ':edit')->add(PermissionMiddleware::class)->setName('jobs/edit-jobs-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', JobsController::class . ':delete')->add(PermissionMiddleware::class)->setName('jobs/delete-jobs-delete-2'); // delete
        }
    );

    // crops
    $app->map(["GET","POST","OPTIONS"], '/cropslist[/{id}]', CropsController::class . ':list')->add(PermissionMiddleware::class)->setName('cropslist-crops-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/cropsadd[/{id}]', CropsController::class . ':add')->add(PermissionMiddleware::class)->setName('cropsadd-crops-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/cropsview[/{id}]', CropsController::class . ':view')->add(PermissionMiddleware::class)->setName('cropsview-crops-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/cropsedit[/{id}]', CropsController::class . ':edit')->add(PermissionMiddleware::class)->setName('cropsedit-crops-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/cropsdelete[/{id}]', CropsController::class . ':delete')->add(PermissionMiddleware::class)->setName('cropsdelete-crops-delete'); // delete
    $app->group(
        '/crops',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', CropsController::class . ':list')->add(PermissionMiddleware::class)->setName('crops/list-crops-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', CropsController::class . ':add')->add(PermissionMiddleware::class)->setName('crops/add-crops-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', CropsController::class . ':view')->add(PermissionMiddleware::class)->setName('crops/view-crops-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', CropsController::class . ':edit')->add(PermissionMiddleware::class)->setName('crops/edit-crops-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', CropsController::class . ':delete')->add(PermissionMiddleware::class)->setName('crops/delete-crops-delete-2'); // delete
        }
    );

    // article_categories
    $app->map(["GET","POST","OPTIONS"], '/articlecategorieslist[/{id}]', ArticleCategoriesController::class . ':list')->add(PermissionMiddleware::class)->setName('articlecategorieslist-article_categories-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/articlecategoriesadd[/{id}]', ArticleCategoriesController::class . ':add')->add(PermissionMiddleware::class)->setName('articlecategoriesadd-article_categories-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/articlecategoriesview[/{id}]', ArticleCategoriesController::class . ':view')->add(PermissionMiddleware::class)->setName('articlecategoriesview-article_categories-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/articlecategoriesedit[/{id}]', ArticleCategoriesController::class . ':edit')->add(PermissionMiddleware::class)->setName('articlecategoriesedit-article_categories-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/articlecategoriesdelete[/{id}]', ArticleCategoriesController::class . ':delete')->add(PermissionMiddleware::class)->setName('articlecategoriesdelete-article_categories-delete'); // delete
    $app->group(
        '/article_categories',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', ArticleCategoriesController::class . ':list')->add(PermissionMiddleware::class)->setName('article_categories/list-article_categories-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', ArticleCategoriesController::class . ':add')->add(PermissionMiddleware::class)->setName('article_categories/add-article_categories-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', ArticleCategoriesController::class . ':view')->add(PermissionMiddleware::class)->setName('article_categories/view-article_categories-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', ArticleCategoriesController::class . ':edit')->add(PermissionMiddleware::class)->setName('article_categories/edit-article_categories-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', ArticleCategoriesController::class . ':delete')->add(PermissionMiddleware::class)->setName('article_categories/delete-article_categories-delete-2'); // delete
        }
    );

    // articles
    $app->map(["GET","POST","OPTIONS"], '/articleslist[/{id}]', ArticlesController::class . ':list')->add(PermissionMiddleware::class)->setName('articleslist-articles-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/articlesadd[/{id}]', ArticlesController::class . ':add')->add(PermissionMiddleware::class)->setName('articlesadd-articles-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/articlesview[/{id}]', ArticlesController::class . ':view')->add(PermissionMiddleware::class)->setName('articlesview-articles-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/articlesedit[/{id}]', ArticlesController::class . ':edit')->add(PermissionMiddleware::class)->setName('articlesedit-articles-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/articlesdelete[/{id}]', ArticlesController::class . ':delete')->add(PermissionMiddleware::class)->setName('articlesdelete-articles-delete'); // delete
    $app->group(
        '/articles',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', ArticlesController::class . ':list')->add(PermissionMiddleware::class)->setName('articles/list-articles-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', ArticlesController::class . ':add')->add(PermissionMiddleware::class)->setName('articles/add-articles-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', ArticlesController::class . ':view')->add(PermissionMiddleware::class)->setName('articles/view-articles-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', ArticlesController::class . ':edit')->add(PermissionMiddleware::class)->setName('articles/edit-articles-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', ArticlesController::class . ':delete')->add(PermissionMiddleware::class)->setName('articles/delete-articles-delete-2'); // delete
        }
    );

    // reminders
    $app->map(["GET","POST","OPTIONS"], '/reminderslist[/{id}]', RemindersController::class . ':list')->add(PermissionMiddleware::class)->setName('reminderslist-reminders-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/remindersadd[/{id}]', RemindersController::class . ':add')->add(PermissionMiddleware::class)->setName('remindersadd-reminders-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/remindersview[/{id}]', RemindersController::class . ':view')->add(PermissionMiddleware::class)->setName('remindersview-reminders-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/remindersedit[/{id}]', RemindersController::class . ':edit')->add(PermissionMiddleware::class)->setName('remindersedit-reminders-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/remindersdelete[/{id}]', RemindersController::class . ':delete')->add(PermissionMiddleware::class)->setName('remindersdelete-reminders-delete'); // delete
    $app->group(
        '/reminders',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', RemindersController::class . ':list')->add(PermissionMiddleware::class)->setName('reminders/list-reminders-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', RemindersController::class . ':add')->add(PermissionMiddleware::class)->setName('reminders/add-reminders-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', RemindersController::class . ':view')->add(PermissionMiddleware::class)->setName('reminders/view-reminders-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', RemindersController::class . ':edit')->add(PermissionMiddleware::class)->setName('reminders/edit-reminders-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', RemindersController::class . ':delete')->add(PermissionMiddleware::class)->setName('reminders/delete-reminders-delete-2'); // delete
        }
    );

    // crop_tips
    $app->map(["GET","POST","OPTIONS"], '/croptipslist[/{id}]', CropTipsController::class . ':list')->add(PermissionMiddleware::class)->setName('croptipslist-crop_tips-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/croptipsadd[/{id}]', CropTipsController::class . ':add')->add(PermissionMiddleware::class)->setName('croptipsadd-crop_tips-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/croptipsview[/{id}]', CropTipsController::class . ':view')->add(PermissionMiddleware::class)->setName('croptipsview-crop_tips-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/croptipsedit[/{id}]', CropTipsController::class . ':edit')->add(PermissionMiddleware::class)->setName('croptipsedit-crop_tips-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/croptipsdelete[/{id}]', CropTipsController::class . ':delete')->add(PermissionMiddleware::class)->setName('croptipsdelete-crop_tips-delete'); // delete
    $app->group(
        '/crop_tips',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', CropTipsController::class . ':list')->add(PermissionMiddleware::class)->setName('crop_tips/list-crop_tips-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', CropTipsController::class . ':add')->add(PermissionMiddleware::class)->setName('crop_tips/add-crop_tips-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', CropTipsController::class . ':view')->add(PermissionMiddleware::class)->setName('crop_tips/view-crop_tips-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', CropTipsController::class . ':edit')->add(PermissionMiddleware::class)->setName('crop_tips/edit-crop_tips-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', CropTipsController::class . ':delete')->add(PermissionMiddleware::class)->setName('crop_tips/delete-crop_tips-delete-2'); // delete
        }
    );

    // HarvestList
    $app->map(["GET","POST","OPTIONS"], '/harvestlistlist', HarvestListController::class . ':list')->add(PermissionMiddleware::class)->setName('harvestlistlist-HarvestList-list'); // list
    $app->group(
        '/harvestlist',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '', HarvestListController::class . ':list')->add(PermissionMiddleware::class)->setName('harvestlist/list-HarvestList-list-2'); // list
        }
    );

    // crop_steps
    $app->map(["GET","POST","OPTIONS"], '/cropstepslist[/{id}]', CropStepsController::class . ':list')->add(PermissionMiddleware::class)->setName('cropstepslist-crop_steps-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/cropstepsadd[/{id}]', CropStepsController::class . ':add')->add(PermissionMiddleware::class)->setName('cropstepsadd-crop_steps-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/cropstepsview[/{id}]', CropStepsController::class . ':view')->add(PermissionMiddleware::class)->setName('cropstepsview-crop_steps-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/cropstepsedit[/{id}]', CropStepsController::class . ':edit')->add(PermissionMiddleware::class)->setName('cropstepsedit-crop_steps-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/cropstepsdelete[/{id}]', CropStepsController::class . ':delete')->add(PermissionMiddleware::class)->setName('cropstepsdelete-crop_steps-delete'); // delete
    $app->group(
        '/crop_steps',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', CropStepsController::class . ':list')->add(PermissionMiddleware::class)->setName('crop_steps/list-crop_steps-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', CropStepsController::class . ':add')->add(PermissionMiddleware::class)->setName('crop_steps/add-crop_steps-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', CropStepsController::class . ':view')->add(PermissionMiddleware::class)->setName('crop_steps/view-crop_steps-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', CropStepsController::class . ':edit')->add(PermissionMiddleware::class)->setName('crop_steps/edit-crop_steps-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', CropStepsController::class . ':delete')->add(PermissionMiddleware::class)->setName('crop_steps/delete-crop_steps-delete-2'); // delete
        }
    );

    // follows
    $app->map(["GET","POST","OPTIONS"], '/followslist[/{id}]', FollowsController::class . ':list')->add(PermissionMiddleware::class)->setName('followslist-follows-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/followsadd[/{id}]', FollowsController::class . ':add')->add(PermissionMiddleware::class)->setName('followsadd-follows-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/followsview[/{id}]', FollowsController::class . ':view')->add(PermissionMiddleware::class)->setName('followsview-follows-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/followsedit[/{id}]', FollowsController::class . ':edit')->add(PermissionMiddleware::class)->setName('followsedit-follows-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/followsdelete[/{id}]', FollowsController::class . ':delete')->add(PermissionMiddleware::class)->setName('followsdelete-follows-delete'); // delete
    $app->group(
        '/follows',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', FollowsController::class . ':list')->add(PermissionMiddleware::class)->setName('follows/list-follows-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', FollowsController::class . ':add')->add(PermissionMiddleware::class)->setName('follows/add-follows-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', FollowsController::class . ':view')->add(PermissionMiddleware::class)->setName('follows/view-follows-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', FollowsController::class . ':edit')->add(PermissionMiddleware::class)->setName('follows/edit-follows-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', FollowsController::class . ':delete')->add(PermissionMiddleware::class)->setName('follows/delete-follows-delete-2'); // delete
        }
    );

    // crop_months
    $app->map(["GET","POST","OPTIONS"], '/cropmonthslist[/{id}]', CropMonthsController::class . ':list')->add(PermissionMiddleware::class)->setName('cropmonthslist-crop_months-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/cropmonthsadd[/{id}]', CropMonthsController::class . ':add')->add(PermissionMiddleware::class)->setName('cropmonthsadd-crop_months-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/cropmonthsview[/{id}]', CropMonthsController::class . ':view')->add(PermissionMiddleware::class)->setName('cropmonthsview-crop_months-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/cropmonthsedit[/{id}]', CropMonthsController::class . ':edit')->add(PermissionMiddleware::class)->setName('cropmonthsedit-crop_months-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/cropmonthsdelete[/{id}]', CropMonthsController::class . ':delete')->add(PermissionMiddleware::class)->setName('cropmonthsdelete-crop_months-delete'); // delete
    $app->group(
        '/crop_months',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', CropMonthsController::class . ':list')->add(PermissionMiddleware::class)->setName('crop_months/list-crop_months-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', CropMonthsController::class . ':add')->add(PermissionMiddleware::class)->setName('crop_months/add-crop_months-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', CropMonthsController::class . ':view')->add(PermissionMiddleware::class)->setName('crop_months/view-crop_months-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', CropMonthsController::class . ':edit')->add(PermissionMiddleware::class)->setName('crop_months/edit-crop_months-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', CropMonthsController::class . ':delete')->add(PermissionMiddleware::class)->setName('crop_months/delete-crop_months-delete-2'); // delete
        }
    );

    // users
    $app->map(["GET","POST","OPTIONS"], '/userslist[/{id}]', UsersController::class . ':list')->add(PermissionMiddleware::class)->setName('userslist-users-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/usersadd[/{id}]', UsersController::class . ':add')->add(PermissionMiddleware::class)->setName('usersadd-users-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/usersview[/{id}]', UsersController::class . ':view')->add(PermissionMiddleware::class)->setName('usersview-users-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/usersedit[/{id}]', UsersController::class . ':edit')->add(PermissionMiddleware::class)->setName('usersedit-users-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/usersdelete[/{id}]', UsersController::class . ':delete')->add(PermissionMiddleware::class)->setName('usersdelete-users-delete'); // delete
    $app->group(
        '/users',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', UsersController::class . ':list')->add(PermissionMiddleware::class)->setName('users/list-users-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', UsersController::class . ':add')->add(PermissionMiddleware::class)->setName('users/add-users-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', UsersController::class . ':view')->add(PermissionMiddleware::class)->setName('users/view-users-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', UsersController::class . ':edit')->add(PermissionMiddleware::class)->setName('users/edit-users-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', UsersController::class . ':delete')->add(PermissionMiddleware::class)->setName('users/delete-users-delete-2'); // delete
        }
    );

    // PlantList
    $app->map(["GET","POST","OPTIONS"], '/plantlistlist', PlantListController::class . ':list')->add(PermissionMiddleware::class)->setName('plantlistlist-PlantList-list'); // list
    $app->group(
        '/plantlist',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '', PlantListController::class . ':list')->add(PermissionMiddleware::class)->setName('plantlist/list-PlantList-list-2'); // list
        }
    );

    // job_histories
    $app->map(["GET","POST","OPTIONS"], '/jobhistorieslist[/{id}]', JobHistoriesController::class . ':list')->add(PermissionMiddleware::class)->setName('jobhistorieslist-job_histories-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jobhistoriesview[/{id}]', JobHistoriesController::class . ':view')->add(PermissionMiddleware::class)->setName('jobhistoriesview-job_histories-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/jobhistoriesedit[/{id}]', JobHistoriesController::class . ':edit')->add(PermissionMiddleware::class)->setName('jobhistoriesedit-job_histories-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/jobhistoriesdelete[/{id}]', JobHistoriesController::class . ':delete')->add(PermissionMiddleware::class)->setName('jobhistoriesdelete-job_histories-delete'); // delete
    $app->group(
        '/job_histories',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', JobHistoriesController::class . ':list')->add(PermissionMiddleware::class)->setName('job_histories/list-job_histories-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', JobHistoriesController::class . ':view')->add(PermissionMiddleware::class)->setName('job_histories/view-job_histories-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', JobHistoriesController::class . ':edit')->add(PermissionMiddleware::class)->setName('job_histories/edit-job_histories-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', JobHistoriesController::class . ':delete')->add(PermissionMiddleware::class)->setName('job_histories/delete-job_histories-delete-2'); // delete
        }
    );

    // posts
    $app->map(["GET","POST","OPTIONS"], '/postslist[/{id}]', PostsController::class . ':list')->add(PermissionMiddleware::class)->setName('postslist-posts-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/postsview[/{id}]', PostsController::class . ':view')->add(PermissionMiddleware::class)->setName('postsview-posts-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/postsdelete[/{id}]', PostsController::class . ':delete')->add(PermissionMiddleware::class)->setName('postsdelete-posts-delete'); // delete
    $app->group(
        '/posts',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', PostsController::class . ':list')->add(PermissionMiddleware::class)->setName('posts/list-posts-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', PostsController::class . ':view')->add(PermissionMiddleware::class)->setName('posts/view-posts-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', PostsController::class . ':delete')->add(PermissionMiddleware::class)->setName('posts/delete-posts-delete-2'); // delete
        }
    );

    // fcm_notification_messages
    $app->map(["GET","POST","OPTIONS"], '/fcmnotificationmessageslist[/{id}]', FcmNotificationMessagesController::class . ':list')->add(PermissionMiddleware::class)->setName('fcmnotificationmessageslist-fcm_notification_messages-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/fcmnotificationmessagesadd[/{id}]', FcmNotificationMessagesController::class . ':add')->add(PermissionMiddleware::class)->setName('fcmnotificationmessagesadd-fcm_notification_messages-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/fcmnotificationmessagesview[/{id}]', FcmNotificationMessagesController::class . ':view')->add(PermissionMiddleware::class)->setName('fcmnotificationmessagesview-fcm_notification_messages-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/fcmnotificationmessagesedit[/{id}]', FcmNotificationMessagesController::class . ':edit')->add(PermissionMiddleware::class)->setName('fcmnotificationmessagesedit-fcm_notification_messages-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/fcmnotificationmessagesdelete[/{id}]', FcmNotificationMessagesController::class . ':delete')->add(PermissionMiddleware::class)->setName('fcmnotificationmessagesdelete-fcm_notification_messages-delete'); // delete
    $app->group(
        '/fcm_notification_messages',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', FcmNotificationMessagesController::class . ':list')->add(PermissionMiddleware::class)->setName('fcm_notification_messages/list-fcm_notification_messages-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', FcmNotificationMessagesController::class . ':add')->add(PermissionMiddleware::class)->setName('fcm_notification_messages/add-fcm_notification_messages-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', FcmNotificationMessagesController::class . ':view')->add(PermissionMiddleware::class)->setName('fcm_notification_messages/view-fcm_notification_messages-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', FcmNotificationMessagesController::class . ':edit')->add(PermissionMiddleware::class)->setName('fcm_notification_messages/edit-fcm_notification_messages-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', FcmNotificationMessagesController::class . ':delete')->add(PermissionMiddleware::class)->setName('fcm_notification_messages/delete-fcm_notification_messages-delete-2'); // delete
        }
    );

    // error
    $app->map(["GET","POST","OPTIONS"], '/error', OthersController::class . ':error')->add(PermissionMiddleware::class)->setName('error');

    // login
    $app->map(["GET","POST","OPTIONS"], '/login', OthersController::class . ':login')->add(PermissionMiddleware::class)->setName('login');

    // logout
    $app->map(["GET","POST","OPTIONS"], '/logout', OthersController::class . ':logout')->add(PermissionMiddleware::class)->setName('logout');

    // Swagger
    $app->get('/' . Config("SWAGGER_ACTION"), OthersController::class . ':swagger')->setName(Config("SWAGGER_ACTION")); // Swagger

    // Index
    $app->get('/[index]', OthersController::class . ':index')->add(PermissionMiddleware::class)->setName('index');

    // Route Action event
    if (function_exists(PROJECT_NAMESPACE . "Route_Action")) {
        Route_Action($app);
    }

    /**
     * Catch-all route to serve a 404 Not Found page if none of the routes match
     * NOTE: Make sure this route is defined last.
     */
    $app->map(
        ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
        '/{routes:.+}',
        function ($request, $response, $params) {
            $error = [
                "statusCode" => "404",
                "error" => [
                    "class" => "text-warning",
                    "type" => Container("language")->phrase("Error"),
                    "description" => str_replace("%p", $params["routes"], Container("language")->phrase("PageNotFound")),
                ],
            ];
            Container("flash")->addMessage("error", $error);
            return $response->withStatus(302)->withHeader("Location", GetUrl("error")); // Redirect to error page
        }
    );
};
