<?php

namespace Core\Project;

use Core\Project\Requests\CreateProjectRequest;
use Core\Project\Responses\CreateProjectResponse;
use Core\Project\Responses\GetProjectsResponse;
use Core\User\UserRepository;

class ProjectService
{
    private $projectRepository;
    private $projectFactory;
    private $userRepository;

    public function __construct(
        ProjectRepository $projectRepository,
        ProjectFactory $projectFactory,
        UserRepository $userRepository
    ) {
        $this->projectRepository = $projectRepository;
        $this->userRepository = $userRepository;
        $this->projectFactory = $projectFactory;
    }

    public function createProject(CreateProjectRequest $request, CreateProjectResponse $response)
    {
        $user = $this->userRepository->getByID($request->getAuthUserID());
        $project = $this->projectFactory->create($request->getName(), $user);
        $id = $this->projectRepository->create($project);
        $project->setId($id);
        $response->setProject($project);
    }

    public function getProjects(GetProjectsResponse $response)
    {
        $projects = $this->projectRepository->get();
        $response->setProjects($projects);
    }
}
