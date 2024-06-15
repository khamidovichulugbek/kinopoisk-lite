<?php

namespace App\Kernel\Auth;

use App\Kernel\Config\ConfigInterface;
use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Session\SessionInterface;

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

        if(!$user){
            return false;
        }

        if(!password_verify($password, $user[$this->password()])){
            return false;
        }

        if ($user){
            $this->session->set($this->sessionId(), $user['id']);
        }

        return true;
    }



    public function table(): string
    {
        return $this->config->get('auth.table');
    }

    public function username(): string
    {
        return $this->config->get('auth.username');
    }

    public function password(): string {
        return $this->config->get('auth.password');
    }

    public function sessionId(){
        return $this->config->get('auth.session_field');
    }
}
