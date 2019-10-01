<?php

namespace Tests\Unit;

use Core\Project\Project;
use Core\Project\ProjectService;
use Fake\Project\FakeProjectFactory;
use Fake\Project\FakeProjectRepository;
use Fake\Project\Requests\FakeCreate;
use Faker\Provider\Lorem;
use Tests\TestCase;

class ProjectServiceTest extends TestCase
{
    private $projectService;

    protected function setUp(): void
    {
        $projectRepository = new FakeProjectRepository(new FakeProjectFactory());
        $this->projectService = new ProjectService($projectRepository);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateProject()
    {
        $project = $this->projectService->createProject(new FakeCreate());
        $this->assertNotEmpty($project);
    }
}
