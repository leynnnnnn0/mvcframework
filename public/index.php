<?php

// Use the application class from the namespace app\core
require_once  __DIR__ . '/../vendor/autoload.php';

use app\controller\AuthController;
use app\controller\SiteController;
use app\core\Application;

// Initialize
$application = new Application(dirname(__DIR__));
// Pages
$application->router->get('/', [SiteController::class, 'home']);
$application->router->get('/contact', [SiteController::class, 'contact']);

// Auth
$application->router->get('/register', [AuthController::class, 'register']);
$application->router->post('/register', [AuthController::class, 'register']);
$application->router->get('/login', [AuthController::class, 'login']);
$application->router->post('/login', [AuthController::class, 'login']);
$application->run();