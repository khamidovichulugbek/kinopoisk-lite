<?php


namespace App\Kernel\Router;

interface RouterInterface{
    public function distpatch(string $uri, string $method);
}