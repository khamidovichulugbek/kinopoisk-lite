<?php

namespace App\Kernel\Http;

use App\Kernel\Upload\UploadFile;
use App\Kernel\Validation\Validation;
use App\Kernel\Validation\ValidationInterface;

class Request implements RequestInterface
{

    private ValidationInterface $validation;

    public function __construct(
        private array $server,
        private array $files,
        private array $get,
        private array $post,
        private array $cookie,
    ) {
        $this->validation = new Validation();
    }

    public static function createFromGlobals()
    {
        return new static(
            $_SERVER,
            $_FILES,
            $_GET,
            $_POST,
            $_COOKIE,
        );
    }

    public function uri()
    {
        return strtok($this->server['REQUEST_URI'], '?');
    }

    public function method()
    {
        return $this->server['REQUEST_METHOD'];
    }

    public function input(string $value)
    {
        return $this->post[$value] ?? $this->get[$value] ?? null;
    }

    public function file(string $key)
    {
        if (!isset($this->files[$key])) {
            return null;
        }

        return new UploadFile(
            $this->files[$key]['name'],
            $this->files[$key]['type'],
            $this->files[$key]['tmp_name'],
            $this->files[$key]['error'],
            $this->files[$key]['size'],
        );
    }

    public function validate($rules): bool
    {
        $data = [];

        foreach ($rules as $key => $rule) {
            $data[$key] = $this->input($key);
        }
        return $this->validation->validate($data, $rules);
    }

    public function errors()
    {
        return $this->validation->errors();
    }
}
