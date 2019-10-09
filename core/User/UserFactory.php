<?php

namespace Core\User;

class UserFactory
{
    public function create(string $username, string $password, string $token = null): User
    {
        $user = new User();
        $user->setUsername($username);
        $user->setNewPassword($password);
        if ($token) {
            $user->setToken($token);
        } else {
            $user->generateToken();
        }
        return $user;
    }
}
