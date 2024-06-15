<?php

namespace App\Kernel\Config;


interface ConfigInterface{
    public function get($value,  $default = null);
}