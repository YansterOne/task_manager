<?php

namespace Fake\Task\Requests;

use Core\Task\Requests\AddTaskRequest;

class FakeAddTaskRequest implements AddTaskRequest
{
    private $name;
    private $priority;
    private $status;
    private $projectID;
    private $userID;

    public function __construct(string $name, int $priority, string $status, int $projectID, int $userID)
    {
        $this->name = $name;
        $this->priority = $priority;
        $this->status = $status;
        $this->projectID = $projectID;
        $this->userID = $userID;
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

    public function getProjectID(): int
    {
        return $this->projectID;
    }

    public function getAuthUserID(): int
    {
        return $this->userID;
    }
}
