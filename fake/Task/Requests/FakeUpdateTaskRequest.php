<?php

namespace Fake\Task\Requests;

use Core\Task\Requests\UpdateTaskRequest;
use Core\User\User;
use Fake\FakeAuthRequest;

class FakeUpdateTaskRequest extends FakeAuthRequest implements UpdateTaskRequest
{
    private $taskID;
    private $status;
    private $priority;
    private $name;

    public function __construct(User $user, int $taskID, string $name, int $priority, string $status)
    {
        parent::__construct($user);
        $this->taskID = $taskID;
        $this->name = $name;
        $this->priority = $priority;
        $this->status = $status;
    }

    public function getTaskID(): int
    {
        return $this->taskID;
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
