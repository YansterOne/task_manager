<?php

namespace Core\Project;

use Core\Project\Requests\Create;

class ProjectService extends AbstractProjectService
{
    private $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function createProject(Create $request): Project
    {
        return $this->projectRepository->create(['name' => $request->getName()]);
    }
}
