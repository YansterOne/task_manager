<?php

namespace Fake\Project\Requests;

use Core\Project\Requests\CreateProjectRequest;
use Core\User\User;
use Fake\FakeAuthRequest;
use Faker\Provider\Lorem;

class FakeCreateProjectRequest extends FakeAuthRequest implements CreateProjectRequest
{
    private $name;

    public function __construct(User $user, string $name)
    {
        parent::__construct($user);
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
