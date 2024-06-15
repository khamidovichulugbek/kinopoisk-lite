<?php

namespace App\Kernel\Auth;

use App\Kernel\Config\ConfigInterface;
use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Session\SessionInterface;
use App\Models\Users;

class Auth implements AuthInterface
{

    public function __construct(
        private DatabaseInterface $db,
        private SessionInterface $session,
        private ConfigInterface $config,
    ) {
    }

    public function attempt(string $username, $password)
    {
        $user = $this->db->first($this->table(), [
            $this->username() => $username,
        ]);

        if (!$user) {
            return false;
        }

        if (!password_verify($password, $user[$this->password()])) {
            return false;
        }

        if ($user) {
            $this->session->set($this->sessionId(), $user['id']);
            $this->session->set('role', $user['role']);
        }

        return true;
    }

    public function check(): bool
    {
        return $this->session->has($this->sessionId());
    }
    public function is_admin(): bool
    {
        $role = $this->session->get('role');
        if ($role === 1) {
            return true;
        }

        return false;
    }

    public function logout()
    {
        return $this->session->remove($this->sessionId());
    }

    public function user()
    {
        if (!$this->check()) {
            return null;
        }
        $user = $this->db->first($this->table(), [
            'id' => $this->session->get($this->sessionId()),
        ]);
        return new Users(
            id: $user['id'],
            name: $user['name'],
            username: $user['email']
        );
    }

    public function table(): string
    {
        return $this->config->get('auth.table');
    }

    public function username(): string
    {
        return $this->config->get('auth.username');
    }

    public function password(): string
    {
        return $this->config->get('auth.password');
    }

    public function sessionId()
    {
        return $this->config->get('auth.session_field');
    }
}
