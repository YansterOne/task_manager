<?php


namespace Fake\Task\Requests;


use Core\Task\Requests\DeleteTaskRequest;

class FakeDeleteTaskRequest implements DeleteTaskRequest
{
    private $taskID;
    private $userID;

    public function __construct(int $taskID, int $userID)
    {
        $this->taskID = $taskID;
        $this->userID = $userID;
    }

    public function getAuthUserID(): int
    {
        return $this->userID;
    }

    public function getTaskID(): int
    {
        return $this->taskID;
    }
}
