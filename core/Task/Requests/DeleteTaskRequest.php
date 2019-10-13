<?php

namespace Core\Task\Requests;

use Core\User\Requests\AuthUserRequest;

interface DeleteTaskRequest extends AuthUserRequest
{
    public function getTaskID(): int;
}
