<?php

namespace Core\User;

use Core\User\Requests\LoginUserRequest;
use Core\User\Responses\LoginUserResponse;

abstract class AbstractUserService
{
    abstract public function login(LoginUserRequest $request, LoginUserResponse $response);
}
