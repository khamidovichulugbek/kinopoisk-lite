<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Kernel\Database\Database;
use App\Services\CategoryService;
use App\Services\MovieService;

class AdminController extends Controller{
    public function index(){
        $categories = new CategoryService($this->db());
        $movies = new MovieService($this->db());

        $this->view('pages/admin', [
            'categories' => $categories->all(),
            'movies' => $movies->all(),
        ]);
    }
}