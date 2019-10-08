<?php

namespace Fake\Project\Requests;

use Core\Project\Requests\CreateProjectRequest;
use Faker\Provider\Lorem;

class FakeCreateProjectRequest implements CreateProjectRequest
{
    private $name;
    private $userID;

    public function __construct(string $name, int $userID)
    {
        $this->name = $name;
        $this->userID = $userID;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAuthUserID(): int
    {
        return $this->userID;
    }
}
