<?php

namespace Core\User;

class UserFactory
{
    public function create(
        string $username,
        string $password,
        string $token = null,
        int $id = null,
        bool $newPassword = false
    ): User {
        $user = new User();
        $user->setUsername($username);
        if ($newPassword) {
            $user->setNewPassword($password);
        } else {
            $user->setPassword($password);
        }
        if ($token) {
            $user->setToken($token);
        } else {
            $user->generateToken();
        }
        if ($id) {
            $user->setId($id);
        }
        return $user;
    }
}
