<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\CategoryService;
use App\Services\MovieService;
use DateTime;
use PDOException;

class HomeController extends Controller
{
    public function index()
    {
        $movies = new MovieService($this->db());

        $this->view('home', [
            'movies' => $movies->all(),
        ]);
    }

    public function oneMovie()
    {
        $movies = $this->db()->first('movies', [
            'id' => $this->request()->input('id'),
        ]);

        $ratings = [];

        try {
            $ratings = $this->db()->get('ratings', [
                'movie_id' => $this->request()->input('id'),
            ]);
        } catch (PDOException $e) {
            $ratings = [];
        }

        $ratin =  [];
        foreach ($ratings as $rating) {
            $ratin[] = $rating['rating'];
        }

        $realrating = array_sum($ratin) / count($ratin);


        $this->view('pages/onemovie', [
            'movies' => $movies,
            'rating' => round($realrating, 1),
        ]);
    }


    public function ratingCreate()
    {


        $this->db()->insert('ratings', [
            'user_id' => $this->session()->get('user_id'),
            'movie_id' => $this->request()->input('movies_id'),
            'rating' => $this->request()->input('rating')
        ]);

        $this->redirect('/movie?id=' . $this->request()->input('movies_id'));
    }
}
