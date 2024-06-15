<?php

namespace App\Kernel\Http;


interface RequestInterface{
    public static function createFromGlobals();
    public function uri();
    public function method();
    
}