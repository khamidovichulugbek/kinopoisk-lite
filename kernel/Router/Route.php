<?php

namespace App\Kernel\Router;


class Route
{
    public function __construct(
        private string $uri,
        private string $method,
        private $action,
        private array $middlewares = []

    ) {
    }

    public static function get($uri, $action, $middleware = [])
    {
        return new static($uri, "GET", $action, $middleware);
    }

    public static function post($uri, $action, $middleware = [])
    {
        return new static($uri, "POST", $action, $middleware);
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getAction()
    {
        return $this->action;
    }
    public function hasMiddlewares(){
       return  !empty($this->middlewares);
    }
    public function getMiddlewares(){
        return $this->middlewares;
    }


}
