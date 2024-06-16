<?php


namespace App\Kernel\Database;


interface DatabaseInterface {
    public function insert(string $table, array $data = []);
    public function first(string $table, array $conditions = []);
    public function get(string $table,  array $conditions = []);
    public function delete(string $table,  array $conditions = []);
    public function update(string $table,array $data, array $conditions = []);

}