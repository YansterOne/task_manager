<?php

namespace Tests\Unit;

use Core\Project\Project;
use Core\Project\ProjectService;
use Fake\Project\FakeProjectFactory;
use Fake\Project\FakeProjectRepository;
use Fake\Project\Requests\FakeCreateProjectRequest;
use Fake\Project\Responses\FakeCreateProjectResponse;
use Faker\Provider\Lorem;
use Tests\TestCase;

class ProjectServiceTest extends TestCase
{
    public function testCreateProject()
    {
        $projectRepository = new FakeProjectRepository();
        $projectFactory = new FakeProjectFactory();
        $projectService = new ProjectService($projectRepository, $projectFactory);
        $request = new FakeCreateProjectRequest(Lorem::words(rand(1, 10), true));
        $response = new FakeCreateProjectResponse();
        $projectService->createProject($request, $response);
        $this->assertNotEmpty($response->getProject());
    }
}
