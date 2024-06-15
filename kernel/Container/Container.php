<?php

namespace App\Kernel\Container;

use App\Kernel\Auth\Auth;
use App\Kernel\Auth\AuthInterface;
use App\Kernel\Config\Config;
use App\Kernel\Config\ConfigInterface;
use App\Kernel\Controller\Controller;
use App\Kernel\Database\Database;
use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Http\Redirect;
use App\Kernel\Http\RedirectInterface;
use App\Kernel\Http\Request;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Router\Router;
use App\Kernel\Router\RouterInterface;
use App\Kernel\Session\Session;
use App\Kernel\Session\SessionInterface;
use App\Kernel\View\View;
use App\Kernel\View\ViewInterface;

class Container
{
    public readonly RouterInterface $router;
    public readonly ViewInterface $view;
    public readonly RequestInterface $request;
    public readonly RedirectInterface $redirect;
    public readonly SessionInterface $session;
    public readonly ConfigInterface $config;
    public readonly DatabaseInterface $database;
    public readonly AuthInterface $auth;

    public function __construct()
    {
        $this->registerService();
    }

    public function registerService()
    {
        $this->request = Request::createFromGlobals();
        $this->redirect = new Redirect();
        $this->session = new Session();
        $this->config = new Config();
        $this->database = new Database($this->config);
        $this->view = new View($this->session);
        $this->auth = new Auth($this->database, $this->session, $this->config);
        $this->router = new Router(
            $this->view,
            $this->request,
            $this->redirect,
            $this->session,
            $this->database,
            $this->auth,
        );
    }
}
