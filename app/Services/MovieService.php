<?php

namespace App\Services;

use App\Kernel\Database\DatabaseInterface;
use App\Models\Movies;

class MovieService
{

    public function __construct(
        private DatabaseInterface $db,
    ) {
    }

    public function all(){
        $movies = $this->db->get('movies');

        return array_map(function ($movies) {
            return new Movies(
                id: $movies['id'],
                name: $movies['name'],
                description: $movies['description'],
                categoryId: $movies['category_id'],
                preview: $movies['preview'],
                createdAt: $movies['created_at'],
                updatedAt: $movies['updated_at'],
            );
        }, $movies);
    }
}
