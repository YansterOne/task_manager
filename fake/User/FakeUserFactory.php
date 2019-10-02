<?php

namespace Fake\User;

use Core\User\User;
use Core\User\UserFactory;

class FakeUserFactory implements UserFactory
{
    public function create(string $username, string $password): User
    {
        $user = new User();
        $user->setUsername($username);
        $user->setNewPassword($password);
        return $user;
    }

}
