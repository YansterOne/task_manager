<?php

namespace Fake;

use Core\User\User;

class FakeAuthRequest
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAuthUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getApiToken(): string
    {
        return $this->user->getToken();
    }
}
