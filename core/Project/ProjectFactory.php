<?php

namespace Core\Project;

class ProjectFactory
{
    public function create(string $name): Project
    {
        return new Project($name);
    }
}
