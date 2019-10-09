<?php

namespace Fake\User\Requests;

use Core\User\Requests\AuthUserRequest;
use Core\User\Responses\AuthUserResponse;
use Core\User\User;

class FakeAuthUserRequest implements AuthUserRequest
{
    private $apiToken;

    private $user;

    public function __construct(string $apiToken)
    {
        $this->apiToken = $apiToken;
    }

    public function getApiToken(): string
    {
        return $this->apiToken;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getAuthUser(): User
    {
        return $this->user;
    }
}
