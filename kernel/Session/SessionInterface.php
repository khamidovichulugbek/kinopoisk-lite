<?php


namespace App\Kernel\Session;

interface SessionInterface
{
    public function set(string $key, $value);
    public function get(string $key, $default = null);
    public function getFlash(string $key,  $default = null);
    public function remove(string $key);
    public function destroy();
    public function has(string $key);
}
