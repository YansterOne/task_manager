<?php

namespace Core\Project;

use Core\Project\Exceptions\AccessDeniedException;
use Core\Project\Exceptions\NotFoundException;
use Core\Project\Requests\CreateProjectRequest;
use Core\Project\Requests\DeleteProjectRequest;
use Core\Project\Requests\GetProjectsRequest;
use Core\Project\Requests\UpdateProjectRequest;
use Core\Project\Responses\CreateProjectResponse;
use Core\Project\Responses\GetProjectsResponse;
use Core\Project\Responses\UpdateProjectResponse;
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
        $user = $request->getAuthUser();
        $project = $this->projectFactory->create($request->getName(), $user);
        $id = $this->projectRepository->create($project);
        $project->setId($id);
        $response->setProject($project);
    }

    public function getProjects(GetProjectsRequest $request, GetProjectsResponse $response)
    {
        $projects = $this->projectRepository->getForUser($request->getAuthUser()->getId());
        $response->setProjects($projects);
    }

    /**
     * @param UpdateProjectRequest $request
     * @param UpdateProjectResponse $response
     * @throws NotFoundException
     * @throws AccessDeniedException
     */
    public function updateProject(UpdateProjectRequest $request, UpdateProjectResponse $response)
    {
        $user = $request->getAuthUser();
        $project = $this->projectRepository->getByID($request->getProjectID());
        if (!$project) {
            throw new NotFoundException('Project not found');
        }
        if (!$project->hasPermissions($user)) {
            throw new AccessDeniedException('Access denied');
        }
        $project->setName($request->getName());
        $this->projectRepository->update($project);
        $response->setProject($project);
    }

    public function deleteProject(DeleteProjectRequest $request)
    {
        $user = $request->getAuthUser();
        $project = $this->projectRepository->getByID($request->getProjectID());
        if (!$project->hasPermissions($user)) {
            throw new AccessDeniedException('Access denied');
        }
        $this->projectRepository->delete($project);
    }
}
