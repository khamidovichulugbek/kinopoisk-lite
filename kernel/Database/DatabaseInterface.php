<?php


namespace App\Kernel\Database;


interface DatabaseInterface {
    public function insert(string $table, array $data = []);
    public function first(string $table, array $conditions = []);
}