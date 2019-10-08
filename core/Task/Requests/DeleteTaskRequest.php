<?php

namespace Core\Task\Requests;

interface DeleteTaskRequest
{
    public function getAuthUserID(): int;

    public function getTaskID(): int;
}
