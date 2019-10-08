<?php

namespace Fake\Task\Responses;

use Core\Task\Responses\UpdateTaskResponse;
use Core\Task\Task;

class FakeUpdateTaskResponse implements UpdateTaskResponse
{
    private $task;

    public function setTask(Task $task)
    {
        $this->task = $task;
    }

    public function getTask(): ?Task
    {
        return $this->task;
    }
}
