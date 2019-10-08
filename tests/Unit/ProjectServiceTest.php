<?php

namespace Tests\Unit;

use Core\Project\ProjectFactory;
use Core\Project\ProjectService;
use Core\User\UserFactory;
use Fake\Project\FakeProjectRepository;
use Fake\Project\Requests\FakeCreateProjectRequest;
use Fake\Project\Requests\FakeGetProjectsRequest;
use Fake\Project\Responses\FakeCreateProjectResponse;
use Fake\Project\Responses\FakeGetProjectsResponse;
use Fake\User\FakeUserRepository;
use Faker\Provider\Lorem;
use Tests\TestCase;

class ProjectServiceTest extends TestCase
{
    public function testCreateProject()
    {
        $user = (new UserFactory())->create($this->faker->userName, $this->faker->password);
        $userRepository = new FakeUserRepository();
        $userID = $userRepository->create($user);

        $projectRepository = new FakeProjectRepository();
        $projectFactory = new ProjectFactory();
        $projectService = new ProjectService($projectRepository, $projectFactory, $userRepository);
        $request = new FakeCreateProjectRequest($this->newProjectName(), $userID);
        $response = new FakeCreateProjectResponse();
        $projectService->createProject($request, $response);
        $this->assertNotEmpty($response->getProject());
    }

    public function testGetProjectsEmpty()
    {
        $user = (new UserFactory())->create($this->faker->userName, $this->faker->password);
        $userRepository = new FakeUserRepository();
        $userID = $userRepository->create($user);
        $user->setId($userID);

        $projectFactory = new ProjectFactory();
        $projectRepository = new FakeProjectRepository();
        $projectService = new ProjectService($projectRepository, $projectFactory, $userRepository);
        $request = new FakeGetProjectsRequest($userID);
        $response = new FakeGetProjectsResponse();
        $projectService->getProjects($request, $response);
        $this->assertEmpty($response->getProjects());
    }

    public function testGetProjectsNotEmpty()
    {
        $user = (new UserFactory())->create($this->faker->userName, $this->faker->password);
        $userRepository = new FakeUserRepository();
        $userID = $userRepository->create($user);
        $user->setId($userID);

        $projectFactory = new ProjectFactory();
        $projects = [];
        for ($i = 0; $i < 20; $i++) {
            $projects[] = $projectFactory->create($this->newProjectName(), $user);
        }
        $projectRepository = new FakeProjectRepository($projects);
        $projectService = new ProjectService($projectRepository, $projectFactory, $userRepository);
        $request = new FakeGetProjectsRequest($userID);
        $response = new FakeGetProjectsResponse();
        $projectService->getProjects($request, $response);
        $this->assertNotEmpty($response->getProjects());
    }

    private function newProjectName(): string
    {
        return Lorem::words(rand(1, 10), true);
    }
}
