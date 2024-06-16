<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\CategoryService;

class MoviesController extends Controller

{
    public function index()
    {
        $categories = new CategoryService($this->db());
        $this->view('pages/movies/add', [
            'categories' => $categories->all(),
        ]);
    }

    public function create()
    {
        $validation = $this->request()->validate([
            'name' => ['required', 'min:3'],
            'description' => ['required', 'min:3'],
        ]);

        if (!$validation) {
            foreach ($this->request()->errors() as $key => $error) {
                $this->session()->set($key, $error);
            }

            $this->redirect('/admin/movies/create');
        }

        $image = $this->request()->file('preview');
        $filePath = $image->move('movies');

        $this->db()->insert('movies', [
            'category_id' => $this->request()->input('categoryId'),
            'name' => $this->request()->input('name'),
            'description' => $this->request()->input('description'),
            'preview' => $filePath,
        ]);

        $this->redirect('/admin');
    }
    public function edit()
    {
        $movies = $this->db()->first('movies', [
            'id' => $this->request()->input('id'),
        ]);
        $categories = new CategoryService($this->db());
        $this->view('/pages/movies/update', [
            'movies' => $movies,
            'categories' => $categories->all()
        ]);
    }

    public function update()
    {

        $validation = $this->request()->validate([
            'name' => ['required', 'min:3'],
        ]);

        if (!$validation) {
            foreach ($this->request()->errors() as $key => $error) {
                $this->session()->set($key, $error);
            }

            $this->redirect('/admin/movies/update?id=' . $this->request()->input('id'));
        }

        $uri = $this->request()->file('preview');
        $data = [];
        if ($uri->hasError()) {
            $data = [
                'name' => $this->request()->input('name'),
                'description' => $this->request()->input('description'),
                'category_id' => $this->request()->input('categoryId'),
            ];
        } else {
            $filePath = $uri->move('movies');
            $data = [
                'name' => $this->request()->input('name'),
                'description' => $this->request()->input('description'),
                'category_id' => $this->request()->input('categoryId'),
                'preview' => $filePath
            ];
        }


        $this->db()->update(
            'movies',
            $data,
            [
                'id' => $this->request()->input('id'),
            ]
        );

        $this->redirect('/admin');
    }

    public function delete()
    {
        $this->db()->delete('movies', [
            'id' => $this->request()->input('id'),
        ]);

        $this->redirect('/admin');
    }
}
