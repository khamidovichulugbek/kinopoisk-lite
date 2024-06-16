<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    public function index()
    {
        $this->view('pages/categories/add');
    }


    public function create()
    {
        $validation = $this->request()->validate([
            'name' => ['required', 'min:3'],
        ]);

        if (!$validation) {
            foreach ($this->request()->errors() as $key => $error) {
                $this->session()->set($key, $error);
            }
            $this->redirect('/admin/categories/create');
        }

        $name = $this->request()->input('name');
        $this->service()->save($name);

        $this->redirect('/admin');
    }

    public function edit()
    {

        $categories = $this->db()->first('categories', [
            'id' => $this->request()->input('id'),
        ]);

        $this->view('pages/categories/update', [
            'categories' => $categories,
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
            $this->redirect('/admin/categories/update');
        }

        $this->service()->update(
            [
                'name' => $this->request()->input('name')
            ],
            [
                'id' => $this->request()->input('id')
            ]
        );


        $this->redirect('/admin');
    }

    public function delete()
    {
        $this->service()->delete($this->request()->input('id'));

        $this->redirect('/admin');
    }

    private function service()
    {
        return new CategoryService(
            $this->db(),
        );
    }
}
