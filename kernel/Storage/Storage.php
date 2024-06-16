<?php

namespace App\Kernel\Storage;

use App\Kernel\Config\ConfigInterface;

class Storage implements StorageInterface
{
    public function __construct(
        private ConfigInterface $config,
    )
    {
        
    }
    public function url(string $path): string
    {  
        $url = $this->config->get('app.url', 'http://localhost:8000');

        return "$url/assets/storage/$path";
    }

    public function get(string $path): string
    {
        return file_get_contents($this->storagePath($path));
    }

    private function storagePath(string $path)
    {
        return APP_PATH . "/public/assets/storage/$path";
    }
}