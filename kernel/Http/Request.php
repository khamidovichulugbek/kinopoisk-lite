<?php

namespace App\Kernel\Http;

use App\Kernel\Validation\Validation;
use App\Kernel\Validation\ValidationInterface;

class Request implements RequestInterface
{

    private ValidationInterface $validation;
    private array $errors = [];

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

    public function validate($rules)
    {
        $data = [];

        foreach ($rules as $key => $rule) {
            $data[$key] = $this->input($key);
        }
        $validation = $this->validation->validate($data, $rules);
        if (!$validation) {
            $this->errors = $this->validation->errors();
        }
    }

    public function errors()
    {
        return $this->errors;
    }
}
