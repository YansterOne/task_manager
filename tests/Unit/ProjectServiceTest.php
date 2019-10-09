<?php

namespace Tests\Unit;

use Core\Project\Exceptions\AccessDeniedException;
use Core\Project\Project;
use Core\Project\ProjectFactory;
use Core\Project\ProjectService;
use Core\User\User;
use Core\User\UserFactory;
use Fake\Project\FakeProjectRepository;
use Fake\Project\Requests\FakeCreateProjectRequest;
use Fake\Project\Requests\FakeDeleteProjectRequest;
use Fake\Project\Requests\FakeGetProjectsRequest;
use Fake\Project\Requests\FakeUpdateProjectRequest;
use Fake\Project\Responses\FakeCreateProjectResponse;
use Fake\Project\Responses\FakeGetProjectsResponse;
use Fake\Project\Responses\FakeUpdateProjectResponse;
use Fake\User\FakeUserRepository;
use Faker\Provider\Lorem;
use Tests\TestCase;

class ProjectServiceTest extends TestCase
{
    private $projectRepository;
    private $projectFactory;
    private $projectService;
    private $userRepository;

    public function setUp(): void
    {
        $this->userRepository = new FakeUserRepository();
        $this->projectRepository = new FakeProjectRepository();
        $this->projectFactory = new ProjectFactory();
        $this->projectService = new ProjectService($this->projectRepository, $this->projectFactory,
            $this->userRepository);
    }

    private function createAndSaveUser(): User
    {
        $user = (new UserFactory())->create($this->faker->userName, $this->faker->password);
        $userID = $this->userRepository->create($user);
        $user->setId($userID);
        return $user;
    }

    private function createAndSaveProject(User $user): Project
    {
        $project = $this->projectFactory->create($this->newProjectName(), $user);
        $projectID = $this->projectRepository->create($project);
        $project->setId($projectID);
        return $project;
    }

    public function testCreateProject()
    {
        $user = $this->createAndSaveUser();
        $request = new FakeCreateProjectRequest($this->newProjectName(), $user->getId());
        $response = new FakeCreateProjectResponse();
        $this->projectService->createProject($request, $response);
        $this->assertNotEmpty($response->getProject());
    }

    public function testGetProjectsEmpty()
    {
        $user = $this->createAndSaveUser();
        $request = new FakeGetProjectsRequest($user->getId());
        $response = new FakeGetProjectsResponse();
        $this->projectService->getProjects($request, $response);
        $this->assertEmpty($response->getProjects());
    }

    public function testGetProjectsNotEmpty()
    {
        $user = $this->createAndSaveUser();
        for ($i = 0; $i < 20; $i++) {
            $this->projectRepository->create($this->projectFactory->create($this->newProjectName(), $user));
        }
        $request = new FakeGetProjectsRequest($user->getId());
        $response = new FakeGetProjectsResponse();
        $this->projectService->getProjects($request, $response);
        $this->assertNotEmpty($response->getProjects());
    }

    public function testUpdateProjectSuccess()
    {
        $user = $this->createAndSaveUser();
        $project = $this->createAndSaveProject($user);
        $newProjectName = $this->newProjectName();
        $request = new FakeUpdateProjectRequest($user->getId(), $project->getId(), $newProjectName);
        $response = new FakeUpdateProjectResponse();
        $this->projectService->updateProject($request, $response);
        $this->assertEquals($newProjectName, $response->getProject()->getName());
    }

    public function testUpdateProjectFailAccessDenied()
    {
        $this->expectException(AccessDeniedException::class);
        $user = $this->createAndSaveUser();
        $user2 = $this->createAndSaveUser();
        $project = $this->createAndSaveProject($user2);
        $newProjectName = $this->newProjectName();
        $request = new FakeUpdateProjectRequest($user->getId(), $project->getId(), $newProjectName);
        $response = new FakeUpdateProjectResponse();
        $this->projectService->updateProject($request, $response);
    }

    public function testDeleteProjectSuccess()
    {
        $user = $this->createAndSaveUser();
        $project = $this->createAndSaveProject($user);
        $request = new FakeDeleteProjectRequest($user->getId(), $project->getId());
        $this->projectService->deleteProject($request);
        $this->assertEmpty($this->projectRepository->getByID($project->getId()));
    }

    public function testDeleteProjectFailAccessDenied()
    {
        $this->expectException(AccessDeniedException::class);
        $user = $this->createAndSaveUser();
        $user2 = $this->createAndSaveUser();
        $project = $this->createAndSaveProject($user2);
        $request = new FakeDeleteProjectRequest($user->getId(), $project->getId());
        $this->projectService->deleteProject($request);
        $this->assertEmpty($this->projectRepository->getByID($project->getId()));
    }

    private function newProjectName(): string
    {
        return Lorem::words(rand(1, 10), true);
    }
}
