<?php

namespace Fake\Task\Requests;

use Core\Task\Requests\UpdateTaskRequest;

class FakeUpdateTaskRequest implements UpdateTaskRequest
{
    private $userID;
    private $taskID;
    private $status;
    private $priority;
    private $name;

    public function __construct(int $taskID, int $userID, string $name, int $priority, string $status)
    {
        $this->userID = $userID;
        $this->taskID = $taskID;
        $this->name = $name;
        $this->priority = $priority;
        $this->status = $status;
    }

    public function getTaskID(): int
    {
        return $this->taskID;
    }

    public function getAuthUserID(): int
    {
        return $this->userID;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
