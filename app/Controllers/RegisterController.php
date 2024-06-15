<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class RegisterController extends Controller{
    
    public function index(){
        $this->view('auth/register');
    }

    public function register(){
        $validation = $this->request()->validate([
            'email' => ['required', 'min:3'],
            'password' => ['required', 'min:8'],
        ]);

        if(!$validation){
            foreach ($this->request()->errors() as $key => $error){
                $this->session()->set($key, $error);
            }
            
            $this->redirect('/register');
        }

        
    }
}