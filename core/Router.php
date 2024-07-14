<?php

namespace app\core;

class Router
{
    private array $routes = [];
    private Request $request;
    private Response $response;
    function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        $this->routes['GET'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['POST'][$path] = $callback;
    }

    public function resolve()
    {
        $method = $this->request->getMethod();
        $url = $this->request->getUrl();
        $callback = $this->routes[$method][$url] ?? false;
        if($callback === false){
            $this->response->setResponseCode(404);
            return 'PAGE NOT FOUND!';
        }
        if(is_string($callback)){
            return $this->renderView($callback);
        }
        if(is_array($callback))
        {
            Application::$app->controller = new $callback[0]();
            $callback[0] = Application::$app->controller;
            return call_user_func($callback);
        }
        return call_user_func($callback);
    }

    public function renderView($view, $params = [])
    {
        $pageLayout = $this->pageLayout();
        $viewLayout = $this->viewLayout($view, $params);

        return str_replace("{{content}}", $viewLayout, $pageLayout);
    }

    public function pageLayout()
    {
        $layout = Application::$app->controller->layout;
        require_once Application::$ROOT_PATH."\\views\\layouts\\$layout.php";
        return ob_get_clean();
    }

    public function viewLayout($view, array $params = [])
    {
        extract($params);
        ob_start();
        require_once Application::$ROOT_PATH."\\views\\$view.php";
        return ob_get_clean();
    }

}