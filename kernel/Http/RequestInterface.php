<?php

namespace App\Kernel\Http;


interface RequestInterface
{
    public static function createFromGlobals();
    public function uri();
    public function method();
    public function input(string $value);
    public function validate($rules): bool;
    public function errors();
}
