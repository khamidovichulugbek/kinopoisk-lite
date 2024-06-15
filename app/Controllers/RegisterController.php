<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\RegisterService;
use PDOException;

class RegisterController extends Controller
{

    public function index()
    {
        $this->view('auth/register');
    }

    public function register()
    {
        $validation = $this->request()->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'min:3'],
            'password' => ['required', 'min:1', 'confirmation'],
            'password_confirmation' => ['required', 'min:1'],
        ]);
        if (!$validation) {
            foreach ($this->request()->errors() as $key => $error) {
                $this->session()->set($key, $error);
            }

            $this->redirect('/register');
        }


        try {
            $this->service()->save();

            $this->redirect('/');
        } catch (PDOException $e) {
            if ($e->getCode() === "23000"){
                $this->session()->set('email', ["Ushbu email avval ham ro'yxatdan o'tgan"]);
                $this->redirect('/register');
            }
        }
    }

    private function service(){
        return new RegisterService($this->request(), $this->db());
    }
}
