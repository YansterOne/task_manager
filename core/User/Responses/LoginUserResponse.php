<?php

namespace Core\User\Responses;

use Core\User\User;

interface LoginUserResponse
{
    public function setUser(User $user);
}
