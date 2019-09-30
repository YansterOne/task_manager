<?php

namespace Core\Project;

class ProjectFactory
{
    public function create(int $id, string $name): Project
    {
        $project = new Project();
        $project->setId($id);
        $project->setName($name);
        return $project;
    }
}
