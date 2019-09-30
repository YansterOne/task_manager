<?php

namespace Core\Project;

class ProjectService extends AbstractProjectService
{
    private $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function createProject(string $name): Project
    {
        return $this->projectRepository->create(['name' => $name]);
    }
}
