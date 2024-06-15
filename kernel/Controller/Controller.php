<?php

namespace App\Kernel\Controller;

use App\Kernel\Http\Request;
use App\Kernel\Http\RequestInterface;
use App\Kernel\View\View;
use App\Kernel\View\ViewInterface;

abstract class Controller
{
    private ViewInterface $view;
    private RequestInterface $request;


    public function view(string $path){

        return $this->view->page($path);
    }

    public function setView(ViewInterface $view): void
    {
        $this->view = $view;
    }

    public function request(){
        return $this->request;
    }

    public function setRequest(RequestInterface $request): void{
        $this->request = $request;
    }
}
