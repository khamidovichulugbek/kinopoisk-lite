<?php


namespace App\Models;


class Users
{
    public function __construct(
        private $id,
        private string $name,
        private string $username,
    ) {
    }

    public function id(){
        return $this->id;
    }

    public function name(): string{
        return $this->name;
    }

    public function username(): string{
        return $this->username;
    }
}
