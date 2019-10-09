<?php


namespace Fake\Task\Requests;


use Core\Task\Requests\DeleteTaskRequest;
use Core\User\User;
use Fake\FakeAuthRequest;

class FakeDeleteTaskRequest extends FakeAuthRequest implements DeleteTaskRequest
{
    private $taskID;

    public function __construct(User $user, int $taskID)
    {
        parent::__construct($user);
        $this->taskID = $taskID;
    }

    public function getTaskID(): int
    {
        return $this->taskID;
    }
}
