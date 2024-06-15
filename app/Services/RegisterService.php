<?php

namespace App\Services;

use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Session\SessionInterface;
use PDOException;

class RegisterService
{
    public function __construct(
        private RequestInterface $request,
        private DatabaseInterface $db,
    ) {
    }
    public function save()
    {

        return $this->db->insert('users', [
            'name' => $this->request->input('name'),
            'email' => $this->request->input('email'),
            'password' => password_hash($this->request->input('password'), PASSWORD_DEFAULT),
        ]);
    }
}
