<?php

namespace Fake\Task\Responses;

use Core\Task\Responses\AddTaskResponse;
use Core\Task\Task;

class FakeAddTaskResponse implements AddTaskResponse
{
    private $task;

    /**
     * @param Task $task
     */
    public function setTask(Task $task)
    {
        $this->task = $task;
    }

    /**
     * @return Task|null
     */
    public function getTask(): ?Task
    {
        return $this->task;
    }
}
