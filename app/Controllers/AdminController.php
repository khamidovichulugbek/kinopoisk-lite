<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class AdminController extends Controller{
    public function index(){

        $this->view('pages/admin');
    }
}