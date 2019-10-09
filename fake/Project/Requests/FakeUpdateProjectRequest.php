<?php

namespace Fake\Project\Requests;

use Core\Project\Requests\UpdateProjectRequest;
use Core\User\User;
use Fake\FakeAuthRequest;

class FakeUpdateProjectRequest extends FakeAuthRequest implements UpdateProjectRequest
{
    private $name;
    private $projectID;

    public function __construct(User $user, int $projectID, string $name)
    {
        parent::__construct($user);
        $this->projectID = $projectID;
        $this->name = $name;
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
