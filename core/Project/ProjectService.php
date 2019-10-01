<?php

namespace Core\Project;

use Core\Project\Requests\CreateProjectRequest;
use Core\Project\Responses\CreateProjectResponse;

class ProjectService extends AbstractProjectService
{
    private $projectRepository;
    private $projectFactory;

    public function __construct(ProjectRepository $projectRepository, ProjectFactory $projectFactory)
    {
        $this->projectRepository = $projectRepository;
        $this->projectFactory = $projectFactory;
    }

    public function createProject(CreateProjectRequest $request, CreateProjectResponse $response)
    {
        $project = $this->projectFactory->create($request->getName());
        $id = $this->projectRepository->create($project);
        $project->setId($id);
        $response->setProject($project);
    }
}
