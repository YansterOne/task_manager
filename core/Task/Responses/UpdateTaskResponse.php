<?php

namespace Core\Task\Responses;

use Core\Task\Task;

interface UpdateTaskResponse
{
    public function setTask(Task $task);
}
