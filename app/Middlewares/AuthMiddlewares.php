<?php

namespace App\Middlewares;

use App\Kernel\Middleware\AbstractMiddleware;

class AuthMiddlewares extends AbstractMiddleware{
    public function handle(): void
    {
        if(!$this->auth->check()){
            $this->redirect->to('/login');
        }
    }
}
