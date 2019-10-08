<?php

namespace Core\Task\Requests;

use Core\User\User;

interface AddTaskRequest
{
    public function getAuthUserID(): int;

    public function getProjectID(): int;

    public function getName(): string;

    public function getStatus(): string;

    public function getPriority(): int;
}
