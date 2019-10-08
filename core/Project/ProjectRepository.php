<?php

namespace Core\Project;

interface ProjectRepository
{
    public function create(Project $project): int;

    /**
     * @return Project[]
     */
    public function get(): array;

    /**
     * @param int $id
     * @return Project
     */
    public function getByID(int $id): ?Project;
}
