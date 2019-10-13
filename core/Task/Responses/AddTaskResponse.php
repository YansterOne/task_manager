<?php

namespace Core\Task\Responses;

use Core\Task\Task;

interface AddTaskResponse
{
    public function setTask(Task $task);
}
