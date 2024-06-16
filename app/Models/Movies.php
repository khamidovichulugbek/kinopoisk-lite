<?php


namespace App\Models;

class Movies
{
    public function __construct(
        private $id,
        private $categoryId,
        private $name,
        private $description,
        private $preview,
        private $createdAt,
        private $updatedAt,
    ) {
    }

    public function id(){
        return $this->id;
    }

    public function categoryId(){
        return $this->categoryId;
    }

    public function name(){
        return $this->name;
    }

    public function description(){
        return $this->description;
    }

    public function preview(){
        return $this->preview;
    }

    public function createdAt(){
        return $this->createdAt;
    }

    public function updatedAt(){
        return $this->updatedAt;
    }
}
