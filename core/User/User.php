<?php

namespace Core\User;

class User
{
    private $username;

    private $password;

    private $id;

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

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }
}
