<?php

namespace Core\Task\Requests;

interface UpdateTaskRequest
{
    public function getAuthUserID(): int;

    public function getTaskID(): int;

    public function getName(): string;

    public function getStatus(): string;

    public function getPriority(): int;
}
