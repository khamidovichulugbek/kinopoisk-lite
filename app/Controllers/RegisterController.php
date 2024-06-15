<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class RegisterController extends Controller{
    
    public function index(){
        $this->view('auth/register');
    }

    public function register(){
        $validation = $this->request()->validate([
            'email' => ['required', 'min:3']
        ]);

        if(!$validation){
            $this->request()->errors();
            $this->redirect('/register');
        }

        
    }
}