<?php

namespace Core\Task\Requests;

use Core\User\Requests\AuthUserRequest;

interface AddTaskRequest extends AuthUserRequest
{
    public function getProjectID(): int;

    public function getName(): string;

    public function getStatus(): string;

    public function getPriority(): int;

    public function getDeadline(): ?\DateTime;
}
