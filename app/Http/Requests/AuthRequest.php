<?php

namespace App\Http\Requests;

use Core\User\Exceptions\UserNotFoundException;
use Core\User\Requests\AuthUserRequest;
use Core\User\User;
use Core\User\UserService;
use Illuminate\Foundation\Http\FormRequest;

abstract class AuthRequest extends FormRequest implements AuthUserRequest
{
    private $apiToken;
    private $user;

    public function authorize(UserService $userService)
    {
        $this->apiToken = $this->header('Authorization');
        try {
            $userService->getAuthUser($this);
        } catch (UserNotFoundException $exception) {
            return false;
        }
        return true;
    }

    public function getApiToken(): string
    {
        return $this->apiToken;
    }

    public function getAuthUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }
}
