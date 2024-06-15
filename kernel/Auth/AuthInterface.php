<?php

namespace App\Kernel\Auth;


interface AuthInterface{

    public function attempt(string $username, $password);
    public function table(): string;
    public function username(): string;
    public function password(): string;

}