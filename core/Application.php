<?php
namespace app\core;

class Application
{
    public static Application $app;
    public static string $ROOT_PATH;
    public Router $router;
    public Request $request;
    private Response $response;
    public Controller $controller;
    public Database $database;
    function __construct(string $rootPath, array $config)
    {
        self::$app = $this;
        self::$ROOT_PATH = $rootPath;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->controller = new Controller();
        $this->database = new Database($config['database']);
    }
    public function run()
    {
        echo $this->router->resolve();
    }
}