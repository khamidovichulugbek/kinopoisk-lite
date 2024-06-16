<?php

namespace App\Kernel\View;

use App\Kernel\Auth\AuthInterface;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Session\Session;
use App\Kernel\Session\SessionInterface;
use App\Kernel\Storage\StorageInterface;
use Exception;

class View implements ViewInterface
{
    public function __construct(
        private SessionInterface $session,
        private AuthInterface $auth,
        private RequestInterface $request,
        private StorageInterface $storage,
    ) {
    }
    public function page(string $path, $data = [])
    {
        $filePath =  APP_PATH . "/view/$path.php";

        if (!file_exists($filePath)) {
            throw new Exception("View $path not found");
        }

        extract(array_merge($this->defaultData(), $data));


        include_once $filePath;
    }

    public function component($path, $data = [])
    {
        $filePath =  APP_PATH . "/view/components/$path.php";
        if (!file_exists($filePath)) {
            throw new Exception("View $path not found");
        }

        extract(array_merge($this->defaultData(), $data));

        include_once $filePath;
    }

    private function defaultData()
    {
        return [
            'view' => $this,
            'session' => $this->session,
            'auth' => $this->auth,
            'request' => $this->request,
            'storage' => $this->storage
        ];
    }
}
