<?php

namespace Fake\Project\Requests;

use Core\Project\Requests\UpdateProjectRequest;

class FakeUpdateProjectRequest implements UpdateProjectRequest
{
    private $userID;
    private $name;
    private $projectID;

    public function __construct(int $userID, int $projectID, string $name)
    {
        $this->userID = $userID;
        $this->projectID = $projectID;
        $this->name = $name;
    }

    public function getAuthUserID(): int
    {
        return $this->userID;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getProjectID(): int
    {
        return $this->projectID;
    }
}
