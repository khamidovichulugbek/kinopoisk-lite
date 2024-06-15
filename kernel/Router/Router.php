<?php

namespace App\Kernel\Router;

use App\Kernel\Http\RequestInterface;
use App\Kernel\View\View;
use App\Kernel\View\ViewInterface;

class Router implements RouterInterface
{
    private array $routes = [
        'GET' => [],
        'POST' => []
    ];

    public function __construct(
        private ViewInterface $view,
        private RequestInterface $request,
    )
    {
        $this->initRoutes();
    }

    public function distpatch(string $uri, string $method)
    {
        $routes = $this->findRoute($uri, $method);

        if (!$routes){
            $this->errorFound();
        }

        if (is_array($routes->getAction())){
            [$controller, $action] = $routes->getAction();
            $controller = new $controller();

            call_user_func([$controller, 'setView'], $this->view);
            call_user_func([$controller, 'setRequest'], $this->request);

            
            call_user_func([$controller, $action]);
        }


    }

    private function findRoute(string $uri, string $method){
        if (!isset($this->routes[$method][$uri])){
            return false;
        }

        return $this->routes[$method][$uri];
    
    }

    private function errorFound(){
        http_response_code(404);
        echo '404 Not page';
        die();
    }

    private function initRoutes(){
        $router = $this->getRoutes();
        foreach ($router as $route){
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }
    }

    private function getRoutes(){
        return include_once APP_PATH . "/config/routes.php";
    }
}
