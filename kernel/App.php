<?php

namespace App\Kernel;

use App\Kernel\Container\Container;

class App
{
    private Container $container;

    public function __construct()
    {
        $this->container = new Container();
    }

    public function run()
    {

        $this->container->router->distpatch(
            $this->container->request->uri(),
            $this->container->request->method()
        );
    }
}
