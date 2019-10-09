<?php

namespace Core\Task\Requests;

use Core\User\Requests\AuthUserRequest;

interface UpdateTaskRequest extends AuthUserRequest
{
    public function getTaskID(): int;

    public function getName(): string;

    public function getStatus(): string;

    public function getPriority(): int;
}
