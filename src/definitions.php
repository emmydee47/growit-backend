<?php

namespace PHPMaker2022\growit_2021;

use Slim\Views\PhpRenderer;
use Slim\Csrf\Guard;
use Psr\Container\ContainerInterface;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use Doctrine\DBAL\Logging\LoggerChain;
use Doctrine\DBAL\Logging\DebugStack;

return [
    "cache" => function (ContainerInterface $c) {
        return new \Slim\HttpCache\CacheProvider();
    },
    "view" => function (ContainerInterface $c) {
        return new PhpRenderer("views/");
    },
    "flash" => function (ContainerInterface $c) {
        return new \Slim\Flash\Messages();
    },
    "audit" => function (ContainerInterface $c) {
        $logger = new Logger("audit"); // For audit trail
        $logger->pushHandler(new AuditTrailHandler("logs/audit.log"));
        return $logger;
    },
    "log" => function (ContainerInterface $c) {
        global $RELATIVE_PATH;
        $logger = new Logger("log");
        $logger->pushHandler(new RotatingFileHandler($RELATIVE_PATH . "logs/log.log"));
        return $logger;
    },
    "sqllogger" => function (ContainerInterface $c) {
        $loggers = [];
        if (Config("DEBUG")) {
            $loggers[] = $c->get("debugstack");
        }
        return (count($loggers) > 0) ? new LoggerChain($loggers) : null;
    },
    "csrf" => function (ContainerInterface $c) {
        global $ResponseFactory;
        return new Guard($ResponseFactory, Config("CSRF_PREFIX"));
    },
    "debugstack" => \DI\create(DebugStack::class),
    "debugsqllogger" => \DI\create(DebugSqlLogger::class),
    "security" => \DI\create(AdvancedSecurity::class),
    "profile" => \DI\create(UserProfile::class),
    "language" => \DI\create(Language::class),
    "timer" => \DI\create(Timer::class),
    "session" => \DI\create(HttpSession::class),

    // Tables
    "suggestions" => \DI\create(Suggestions::class),
    "SowList" => \DI\create(SowList::class),
    "post_view_counts" => \DI\create(PostViewCounts::class),
    "crop_recommendations" => \DI\create(CropRecommendations::class),
    "jobs" => \DI\create(Jobs::class),
    "crops" => \DI\create(Crops::class),
    "comments" => \DI\create(Comments::class),
    "article_categories" => \DI\create(ArticleCategories::class),
    "articles" => \DI\create(Articles::class),
    "reminders" => \DI\create(Reminders::class),
    "crop_tips" => \DI\create(CropTips::class),
    "HarvestList" => \DI\create(HarvestList::class),
    "crop_steps" => \DI\create(CropSteps::class),
    "device_id_registrations" => \DI\create(DeviceIdRegistrations::class),
    "likes" => \DI\create(Likes::class),
    "follows" => \DI\create(Follows::class),
    "fcm_topic_subscriptions" => \DI\create(FcmTopicSubscriptions::class),
    "crop_months" => \DI\create(CropMonths::class),
    "users" => \DI\create(Users::class),
    "token_auths" => \DI\create(TokenAuths::class),
    "crops_view" => \DI\create(CropsView::class),
    "PlantList" => \DI\create(PlantList::class),
    "journals" => \DI\create(Journals::class),
    "job_histories" => \DI\create(JobHistories::class),
    "posts" => \DI\create(Posts::class),
    "device_token_registrations" => \DI\create(DeviceTokenRegistrations::class),
    "fcm_notification_messages" => \DI\create(FcmNotificationMessages::class),
    "post_bookmarks" => \DI\create(PostBookmarks::class),
];
