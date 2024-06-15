<?php

namespace App\Kernel\View;

interface ViewInterface
{
    public function page(string $path);
    public function component(string $path);
}
