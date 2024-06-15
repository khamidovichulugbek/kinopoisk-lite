<?php

namespace App\Kernel\Http;

class Redirect implements RedirectInterface
{
    public function to($uri)
    {
        header("Location: $uri");
        exit;
    }
}
