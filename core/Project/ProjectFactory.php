<?php

namespace Core\Project;

use Core\User\User;

class ProjectFactory
{
    public function create(string $name, User $user, int $id = null): Project
    {
        $project = new Project($name, $user);
        if ($id) {
            $project->setId($id);
        }
        return $project;
    }
}
