<?php

namespace App\Repositories;

use Core\Project\Project;
use Core\Project\ProjectFactory;
use Core\Project\ProjectRepository;
use App\Models\Project as DBProject;

class EloquentProjectRepository implements ProjectRepository
{
    private $projectFactory;

    public function __construct(ProjectFactory $projectFactory)
    {
        $this->projectFactory = $projectFactory;
    }

    public function create(Project $project): int
    {
        $id = DBProject::query()->create([
            'name' => $project->getName(),
            'user_id' => $project->getUser()->getId()
        ])->getId();
        $project->setId($id);
        return $id;
    }

    public function getForUser(int $userID): array
    {
        return [];
    }

    public function getByID(int $id): ?Project
    {
        return null;
    }

    public function update(Project $project)
    {

    }

    public function delete(Project $project)
    {

    }
}
