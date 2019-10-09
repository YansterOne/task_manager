<?php

namespace Core\User;

use Core\Entity;
use Illuminate\Support\Str;

class User extends Entity
{
    private $username;

    private $password;

    private $token;

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }


    /**
     * @param string $password
     * @return $this
     */
    public function setNewPassword(string $password): self
    {
        $this->password = md5($password);
        return $this;
    }

    /**
     * @param string $password
     * @return bool
     */
    public function checkPassword(string $password)
    {
        return $this->password === md5($password);
    }


    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    public function generateToken(): string
    {
        $this->token = Str::random(60);
        return $this->token;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;
        return $this;
    }
}
