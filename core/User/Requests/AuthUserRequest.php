<?php

namespace Core\User\Requests;

use Core\User\User;

interface AuthUserRequest
{
    public function getApiToken(): string;
    public function setUser(User $user);
    public function getAuthUser(): User;
}
