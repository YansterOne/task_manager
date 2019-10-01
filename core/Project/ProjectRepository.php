<?php

namespace Core\Project;

interface ProjectRepository
{
    public function create(Project $project): int;

    /**
     * @return Project[]
     */
    public function get(): array;
}
