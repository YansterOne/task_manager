<?php

namespace Core\Project\Requests;

use Core\User\Requests\AuthUserRequest;

interface CreateProjectRequest extends AuthUserRequest
{
    public function getName(): string;
}
