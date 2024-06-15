<?php

namespace App\Kernel\Controller;

use App\Kernel\Http\Redirect;
use App\Kernel\Http\RedirectInterface;
use App\Kernel\Http\Request;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Session\SessionInterface;
use App\Kernel\Validation\ValidationInterface;
use App\Kernel\View\View;
use App\Kernel\View\ViewInterface;

abstract class Controller
{
    private ViewInterface $view;
    private RequestInterface $request;
    private RedirectInterface $redirect;
    private SessionInterface $session;

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

    public function redirect($uri){
        return $this->redirect->to($uri);
    }

    public function setRedirect(RedirectInterface $redirect): void{
        $this->redirect = $redirect;
    }


    public function session(){
        return $this->session;
    }

    public function setSession(SessionInterface $session): void{
        $this->session = $session;
    }


}
