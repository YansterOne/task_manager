<?php

namespace App\Http\Responses;

use Core\User\Responses\LoginUserResponse;
use Core\User\User;
use Illuminate\Http\JsonResponse;

class LoginResponse extends JsonResponse implements LoginUserResponse
{
    public function setUser(User $user)
    {
        $this->setData([
            'username' => $user->getUsername(),
            'token' => $user->getToken(),
        ]);
    }
}
