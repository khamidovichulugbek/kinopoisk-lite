<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;


class LoginController extends Controller
{

    public function index()
    {
        $this->view('auth/login');
    }

    public function login()
    {
        $username = $this->request()->input('email');
        $password = $this->request()->input('password');

        $user = $this->auth()->attempt($username, $password);

        if(!$user){
            $this->session()->set('errors', ['Login yoki parol notogri !']);
            $this->redirect('/login');
        }

        $this->redirect('/');
    }

}
