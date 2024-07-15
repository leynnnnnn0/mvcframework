<?php

require_once  __DIR__ . '/vendor/autoload.php';
require_once 'core/functions.php';
use app\core\Application;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
    'database' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];
// Initialize
$application = new Application(__DIR__, $config);

$application->database->addMigrations();