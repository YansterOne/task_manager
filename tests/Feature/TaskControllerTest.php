<?php

namespace Tests\Feature;

use App\Repositories\EloquentProjectRepository;
use App\Repositories\EloquentUserRepository;
use Core\Project\Project;
use Core\Project\ProjectFactory;
use Core\Task\Task;
use Core\User\User;
use Core\User\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @var UserFactory
     */
    private $userFactory;
    /**
     * @var EloquentUserRepository
     */
    private $userRepository;
    /**
     * @var User
     */
    private $user;
    /**
     * @var ProjectFactory
     */
    private $projectFactory;
    /**
     * @var EloquentProjectRepository
     */
    private $projectRepository;
    /**
     * @var Project
     */
    private $project;

    public function setUp(): void
    {
        parent::setUp();
        $this->userFactory = new UserFactory();
        $this->userRepository = new EloquentUserRepository($this->userFactory);
        $this->projectFactory = new ProjectFactory();
        $this->projectRepository = new EloquentProjectRepository($this->projectFactory, $this->userFactory);
        $this->mockUser();
        $this->mockProject();
    }

    private function mockUser()
    {
        $this->user = $this->userFactory->create($this->faker->userName, $this->faker->password);
        $this->userRepository->create($this->user);
    }

    private function mockProject()
    {
        $this->project = $this->projectFactory->create($this->faker->words(3, true), $this->user);
        $this->projectRepository->create($this->project);
    }

    public function testCreateTaskSuccess()
    {
        $taskData = $this->taskData();
        $response = $this->withHeaders([
            'Authorization' => $this->user->getToken(),
            'Accept' => 'application/json'
        ])->post('/api/tasks', $taskData);
        $response->dump();
        $response->assertStatus(200);
        $response->assertJsonStructure(['id', 'name', 'status', 'deadline', 'priority']);
    }

    private function taskData(): array
    {
        $statuses = [Task::UNDONE_STATUS, Task::DONE_STATUS];
        return [
            'name' => $this->faker->words(10, true),
            'status' => $statuses[array_rand($statuses)],
            'deadline' => $this->faker->dateTime,
            'priority' => $this->faker->numberBetween(),
            'project_id' => $this->project->getId(),
        ];
    }
}

