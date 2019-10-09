<?php

namespace Core\Project\Requests;

use Core\User\Requests\AuthUserRequest;

interface DeleteProjectRequest extends AuthUserRequest
{
    public function getProjectID(): int;
}
