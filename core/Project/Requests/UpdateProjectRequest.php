<?php

namespace Core\Project\Requests;

use Core\User\Requests\AuthUserRequest;

interface UpdateProjectRequest extends AuthUserRequest
{
    public function getName(): string;

    public function getProjectID(): int;
}
