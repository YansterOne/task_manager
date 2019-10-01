<?php

namespace Fake\Project\Requests;

use Core\Project\Requests\CreateProjectRequest;
use Faker\Provider\Lorem;

class FakeCreateProjectRequest implements CreateProjectRequest
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
