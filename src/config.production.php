<?php

/**
 * PHPMaker 2022 configuration file (Production)
 */

return [
    "Databases" => [
        "DB" => ["id" => "DB", "type" => "POSTGRESQL", "qs" => "\"", "qe" => "\"", "host" => "178.62.99.21", "port" => "5432", "user" => "growuser", "password" => "growpswd", "dbname" => "growit_dbase", "schema" => "public"]
    ],
    "SMTP" => [
        "PHPMAILER_MAILER" => "smtp", // PHPMailer mailer
        "SERVER" => "localhost", // SMTP server
        "SERVER_PORT" => 25, // SMTP server port
        "SECURE_OPTION" => "",
        "SERVER_USERNAME" => "", // SMTP server user name
        "SERVER_PASSWORD" => "", // SMTP server password
    ],
    "JWT" => [
        "SECRET_KEY" => "tbMLZ4Po902OzRAq", // API Secret Key
        "ALGORITHM" => "HS512", // API Algorithm
        "AUTH_HEADER" => "X-Authorization", // API Auth Header (Note: The "Authorization" header is removed by IIS, use "X-Authorization" instead.)
        "NOT_BEFORE_TIME" => 0, // API access time before login
        "EXPIRE_TIME" => 600 // API expire time
    ]
];
