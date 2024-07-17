<?php
namespace app\core;

class Application
{
    public static Application $app;
    public static string $ROOT_PATH;
    public Router $router;
    public Request $request;
    public Response $response;
    public Controller $controller;
    public Database $database;
    public Session $session;
    public string $userClass;
    public ?DbModel $user;
    function __construct(string $rootPath, array $config)
    {
        self::$app = $this;
        self::$ROOT_PATH = $rootPath;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
        $this->controller = new Controller();
        $this->database = new Database($config['database']);
        $this->userClass = $config['userClass'];

        $primaryValue = $this->session->get('user');
        if($primaryValue)
        {
            $instance = new $this->userClass();
            $this->user = $instance->findUser([$instance->getPrimaryKey() => $primaryValue]);
        }


    }
    public function run()
    {
        echo $this->router->resolve();
    }

    public function login(DbModel $user): true
    {
        $instance = new $this->userClass();
        $primaryKey = $instance->getPrimaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;

    }

    public function logout(): void
    {
        $this->user = null;
        $this->session->remove('user');
    }
}