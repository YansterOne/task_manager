<?php

namespace Tests\Unit;

use Core\Project\FakeProjectRepository;
use Core\Project\Project;
use Core\Project\ProjectService;
use Faker\Provider\Lorem;
use Tests\TestCase;

class ProjectServiceTest extends TestCase
{
    private $projectService;

    protected function setUp(): void
    {
        $this->projectService = new ProjectService(new FakeProjectRepository());
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateProject()
    {
        $projectName = Lorem::words(rand(1, 10), true);
        $project = $this->projectService->createProject($projectName);
        $this->assertInstanceOf(Project::class, $project);
        $this->assertEquals($projectName, $project->getName());
        $this->assertIsInt($project->getId());
    }
}
