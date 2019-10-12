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
    private $deadline;

    public function __construct(
        User $user,
        int $taskID,
        string $name,
        int $priority,
        string $status,
        \DateTime $deadline = null
    ) {
        parent::__construct($user);
        $this->taskID = $taskID;
        $this->name = $name;
        $this->priority = $priority;
        $this->status = $status;
        $this->deadline = $deadline;
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

    public function getDeadline(): ?\DateTime
    {
        return $this->deadline;
    }
}
