<?php

namespace App\Middlewares;

use App\Kernel\Middleware\AbstractMiddleware;

class AdminMiddlewares extends AbstractMiddleware
{
    public function handle(): void
    {
        if ($this->auth->check()) {
            if (!$this->auth->is_admin()) {
                $this->redirect->to('/');
            }
        }
    }
}
