<?php

namespace Core\Project;

interface ProjectRepository
{
    /**
     * @param Project $project
     * @return int
     */
    public function create(Project $project): int;

    /**
     * @param int $userID
     * @return array
     */
    public function getForUser(int $userID): array;

    /**
     * @param int $id
     * @return Project
     */
    public function getByID(int $id): ?Project;

    /**
     * @param Project $project
     */
    public function update(Project $project);

    /**
     * @param Project $project
     */
    public function delete(Project $project);
}
