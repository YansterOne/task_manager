<?php

namespace Tests\Feature;

use App\Repositories\EloquentProjectRepository;
use App\Repositories\EloquentUserRepository;
use Core\Project\Project;
use Core\Project\ProjectFactory;
use Core\User\User;
use Core\User\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProjectControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @var User
     */
    private $user;
    private $userRepository;
    private $userFactory;

    public function setUp(): void
    {
        parent::setUp();
        $this->userFactory = new UserFactory();
        $this->userRepository = new EloquentUserRepository($this->userFactory);
        $this->mockUser();
    }

    public function testCreateProject()
    {
        $response = $this->withHeader('Authorization', $this->user->getToken())->post('/api/projects', [
            'name' => $this->faker->words(10, true)
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure(['id', 'name']);
    }

    public function testUpdateProject()
    {
        $project = $this->mockProject();
        $newProjectName = $this->faker->words(10, true);
        $response = $this->withHeader('Authorization', $this->user->getToken())
            ->put('/api/projects/' . $project->getId(), ['name' => $newProjectName]);
        $response->assertStatus(200);
        $response->assertJson(['id' => $project->getId(), 'name' => $newProjectName]);
        $this->assertDatabaseHas('projects', ['id' => $project->getId(), 'name' => $newProjectName]);
    }

    public function testGetProjects()
    {
        $project = $this->mockProject();
        $response = $this->withHeader('Authorization', $this->user->getToken())->get('/api/projects');
        $response->assertStatus(200);
        $response->assertJson([['id' => $project->getId(), 'name' => $project->getName(), 'tasks' => []]]);
    }


    private function mockProject(): Project
    {
        $projectFactory = new ProjectFactory();
        $projectRepository = new EloquentProjectRepository($projectFactory, $this->userFactory);
        $project = $projectFactory->create($this->faker->words(10, true), $this->user);
        $projectRepository->create($project);
        return $project;
    }

    private function mockUser()
    {
        $this->user = $this->userFactory->create($this->faker->userName, $this->faker->password);
        $this->userRepository->create($this->user);
    }
}
