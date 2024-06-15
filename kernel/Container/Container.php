<?php

namespace App\Kernel\Container;

use App\Kernel\Controller\Controller;
use App\Kernel\Http\Request;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Router\Router;
use App\Kernel\Router\RouterInterface;
use App\Kernel\View\View;
use App\Kernel\View\ViewInterface;

class Container
{
    public readonly RouterInterface $router;
    public readonly ViewInterface $view;
    public readonly RequestInterface $request;

    public function __construct()
    {
        $this->registerService();
    }

    public function registerService()
    {
        $this->view = new View();
        $this->request = Request::createFromGlobals();
        $this->router = new Router($this->view, $this->request);
    }
}
