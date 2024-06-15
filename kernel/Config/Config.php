<?php

namespace App\Kernel\Config;


class Config implements ConfigInterface{
    public function get($value, $default = null)
    {   //database.localhost

        [$file, $key] = explode('.', $value);
        $configPath = APP_PATH . "/config/$file.php";

        if (!file_exists($configPath)){
            return $default;
        }
        $config = require $configPath;

        return $config[$key] ?? $default;
    }
}