<?php

namespace App\Middlewares;

use App\Kernel\Middleware\AbstractMiddleware;

class GuestMiddlewares extends AbstractMiddleware{
    public function handle(): void
    {
        if($this->auth->check()){
            $this->redirect->to('/');
        }
    }
}
