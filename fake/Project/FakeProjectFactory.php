<?php

namespace Fake\Project;

use Core\Project\Project;
use Core\Project\ProjectFactory;

class FakeProjectFactory implements ProjectFactory
{
    public function create(int $id, string $name): Project
    {
        return new Project($id, $name);
    }
}
