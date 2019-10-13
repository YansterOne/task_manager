<?php

namespace Fake\User\Responses;

use Core\User\Responses\LoginUserResponse;
use Core\User\User;

class FakeLoginUserResponse implements LoginUserResponse
{
    private $user;

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }

}
