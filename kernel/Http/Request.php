<?php

namespace App\Kernel\Http;


class Request implements RequestInterface{

    public function __construct(
        private array $server,
        private array $files,
        private array $get,
        private array $post,
        private array $cookie,
    )
    {
        
    }

    public static function createFromGlobals()
    {
        return new static (
            $_SERVER,
            $_FILES,
            $_GET,
            $_POST,
            $_COOKIE,
        );
    }

    public function uri(){
        return strtok($this->server['REQUEST_URI'], '?');
    }

    public function method(){
        return $this->server['REQUEST_METHOD'];
    }
}