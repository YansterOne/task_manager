<?php

namespace Core\Project;

use Core\User\User;

class ProjectFactory
{
    public function create(string $name, User $user): Project
    {
        return new Project($name, $user);
    }
}
