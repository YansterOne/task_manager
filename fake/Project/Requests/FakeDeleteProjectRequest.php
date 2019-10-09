<?php

namespace Fake\Project\Requests;

use Core\Project\Requests\DeleteProjectRequest;
use Core\User\User;
use Fake\FakeAuthRequest;

class FakeDeleteProjectRequest extends FakeAuthRequest implements DeleteProjectRequest
{
    private $projectID;

    public function __construct(User $user, int $projectID)
    {
        parent::__construct($user);
        $this->projectID = $projectID;
    }

    public function getProjectID(): int
    {
        return $this->projectID;
    }

}
