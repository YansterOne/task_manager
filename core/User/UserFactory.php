<?php

namespace Core\User;

class UserFactory
{
    public function create(string $username, string $password): User
    {
        $user = new User();
        $user->setUsername($username);
        $user->setNewPassword($password);
        return $user;
    }
}
