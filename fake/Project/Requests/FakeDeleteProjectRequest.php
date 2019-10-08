<?php

namespace Fake\Project\Requests;

use Core\Project\Requests\DeleteProjectRequest;

class FakeDeleteProjectRequest implements DeleteProjectRequest
{
    private $userID;
    private $projectID;

    public function __construct(int $userID, int $projectID)
    {
        $this->userID = $userID;
        $this->projectID = $projectID;
    }

    public function getAuthUserID(): int
    {
        return $this->userID;
    }

    public function getProjectID(): int
    {
        return $this->projectID;
    }

}
