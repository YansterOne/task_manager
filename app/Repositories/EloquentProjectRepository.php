<?php

namespace App\Repositories;

use Core\Project\Project;
use Core\Project\ProjectFactory;
use Core\Project\ProjectRepository;
use App\Models\Project as DBProject;
use Core\User\UserFactory;

class EloquentProjectRepository implements ProjectRepository
{
    private $projectFactory;
    private $userFactory;

    public function __construct(ProjectFactory $projectFactory, UserFactory $userFactory)
    {
        $this->projectFactory = $projectFactory;
        $this->userFactory = $userFactory;
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
        $founded = DBProject::query()->where('user_id', $userID)->with('user')->get();
        $result = [];
        $founded->each(function (DBProject $dbProject) use (&$result) {
            $dbUser = $dbProject->getUser();
            $user = $this->userFactory->create($dbUser->getUsername(), $dbUser->getPassword(), $dbUser->getApiToken(),
                $dbUser->getId());
            array_push($result, $this->projectFactory->create($dbProject->getName(), $user, $dbProject->getId()));
        });
        return $result;
    }

    public function getByID(int $id): ?Project
    {
        $founded = DBProject::query()->find($id);
        if (!$founded) {
            return null;
        }
        $dbUser = $founded->getUser();
        $user = $this->userFactory->create($dbUser->getUsername(), $dbUser->getPassword(), $dbUser->getApiToken(),
            $dbUser->getId());
        return $this->projectFactory->create($founded->getName(), $user, $founded->getId());
    }

    public function update(Project $project)
    {
        DBProject::query()->where('id', $project->getId())->update(['name' => $project->getName()]);
    }

    public function delete(Project $project)
    {

    }
}
