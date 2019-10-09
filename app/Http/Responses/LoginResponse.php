<?php

namespace App\Http\Responses;

use Core\User\Responses\LoginUserResponse;
use Core\User\User;
use Illuminate\Http\JsonResponse;

class LoginResponse extends JsonResponse implements LoginUserResponse
{
    private $user;

    public function setUser(User $user)
    {
        $this->user = $user;
    }
}
