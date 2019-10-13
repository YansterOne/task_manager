<?php

namespace Core\User\Requests;

interface LoginUserRequest
{
    public function getUsername(): string;

    public function getPassword(): string;
}
