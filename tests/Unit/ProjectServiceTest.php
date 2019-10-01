<?php

namespace Tests\Unit;

use Core\Project\ProjectService;
use Fake\Project\FakeProjectFactory;
use Fake\Project\FakeProjectRepository;
use Fake\Project\Requests\FakeCreateProjectRequest;
use Fake\Project\Responses\FakeCreateProjectResponse;
use Fake\Project\Responses\FakeGetProjectsResponse;
use Faker\Provider\Lorem;
use Tests\TestCase;

class ProjectServiceTest extends TestCase
{
    public function testCreateProject()
    {
        $projectRepository = new FakeProjectRepository();
        $projectFactory = new FakeProjectFactory();
        $projectService = new ProjectService($projectRepository, $projectFactory);
        $request = new FakeCreateProjectRequest($this->newProjectName());
        $response = new FakeCreateProjectResponse();
        $projectService->createProject($request, $response);
        $this->assertNotEmpty($response->getProject());
    }

    public function testGetProjectsEmpty()
    {
        $projectFactory = new FakeProjectFactory();
        $projectRepository = new FakeProjectRepository();
        $projectService = new ProjectService($projectRepository, $projectFactory);
        $response = new FakeGetProjectsResponse();
        $projectService->getProjects($response);
        $this->assertEmpty($response->getProjects());
    }

    public function testGetProjectsNotEmpty()
    {
        $projectFactory = new FakeProjectFactory();
        $projects = [];
        for ($i = 0; $i < 20; $i++) {
            $projects[] = $projectFactory->create($this->newProjectName());
        }
        $projectRepository = new FakeProjectRepository($projects);
        $projectService = new ProjectService($projectRepository, $projectFactory);
        $response = new FakeGetProjectsResponse();
        $projectService->getProjects($response);
        $this->assertNotEmpty($response->getProjects());
    }

    private function newProjectName(): string
    {
        return Lorem::words(rand(1, 10), true);
    }
}
