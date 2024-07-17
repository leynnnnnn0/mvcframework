<?php
// Use the application class from the namespace app\core
require_once  __DIR__ . '/../vendor/autoload.php';
require_once '../core/functions.php';
use app\controller\AuthController;
use app\controller\SiteController;
use app\core\Application;
use app\model\User;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'userClass' => User::class,
    'database' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];
// Initialize
$application = new Application(dirname(__DIR__), $config);
// Pages
$application->router->get('/', [SiteController::class, 'home']);
$application->router->get('/contact', [SiteController::class, 'contact']);
// Auth
$application->router->get('/register', [AuthController::class, 'register']);
$application->router->post('/register', [AuthController::class, 'register']);
$application->router->get('/login', [AuthController::class, 'login']);
$application->router->post('/login', [AuthController::class, 'login']);
$application->router->get('/logout', [AuthController::class, 'logout']);
// Run
$application->run();