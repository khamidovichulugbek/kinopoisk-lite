<?php

namespace App\Services;

use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Http\RequestInterface;
use App\Models\Categories;

class CategoryService
{
    public function __construct(
        private DatabaseInterface $db,
    ) {
    }

    public function save($name){
        $this->db->insert('categories', [
            'name'=> $name,
        ]); 
    }

    public function all(){
        $categories = $this->db->get('categories');

        return array_map(function ($category) {
            return new Categories(
                id: $category['id'],
                name: $category['name'],
                createdAt: $category['created_at'],
                updatedAt: $category['updated_at'],
            );
        }, $categories);
    }


    public function update(array $data, array $conditions = []){
        $this->db->update('categories', $data, $conditions);
    }


    public function delete($id){
        $this->db->delete('categories', [
            'id' => $id,
        ]);
    }
}
