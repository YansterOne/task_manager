<?php

namespace Fake\Task\Requests;

use Core\Task\Requests\AddTaskRequest;
use Core\User\User;
use Fake\FakeAuthRequest;

class FakeAddTaskRequest extends FakeAuthRequest implements AddTaskRequest
{
    private $name;
    private $priority;
    private $status;
    private $projectID;

    public function __construct(User $user, string $name, int $priority, string $status, int $projectID)
    {
        parent::__construct($user);
        $this->name = $name;
        $this->priority = $priority;
        $this->status = $status;
        $this->projectID = $projectID;
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
}
