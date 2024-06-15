<?php

namespace App\Kernel\View;

use Exception;

class View implements ViewInterface
{
    public function page(string $path)
    {
        $filePath =  APP_PATH . "/view/$path.php";

        if(!file_exists($filePath)){
            throw new Exception("View $path not found");
        }
    
        extract([
            'view' => $this
        ]);

        include_once $filePath;
    }

    public function component($path){
        $filePath =  APP_PATH . "/view/components/$path.php";

        if(!file_exists($filePath)){
            throw new Exception("View $path not found");
        }
    

        include_once $filePath;
    }
}
