<?php

namespace Fake\Project\Requests;

use Core\Project\Requests\GetProjectsRequest;

class FakeGetProjectsRequest implements GetProjectsRequest
{
    private $userID;

    public function __construct(int $userID)
    {
        $this->userID = $userID;
    }

    public function getAuthUserID(): int
    {
        return $this->userID;
    }

}
