<?php

namespace Tests\Feature;

use App\Repositories\EloquentProjectRepository;
use App\Repositories\EloquentTaskRepository;
use App\Repositories\EloquentUserRepository;
use Core\Project\Project;
use Core\Project\ProjectFactory;
use Core\Task\Task;
use Core\Task\TaskFactory;
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

    /**
     * @var EloquentTaskRepository
     */
    private $taskRepository;
    /**
     * @var TaskFactory
     */
    private $taskFactory;

    public function setUp(): void
    {
        parent::setUp();
        $this->userFactory = new UserFactory();
        $this->userRepository = new EloquentUserRepository($this->userFactory);
        $this->projectFactory = new ProjectFactory();
        $this->projectRepository = new EloquentProjectRepository($this->projectFactory, $this->userFactory);
        $this->taskFactory = new TaskFactory();
        $this->taskRepository = new EloquentTaskRepository($this->taskFactory, $this->projectFactory,
            $this->userFactory);
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

    private function mockTask()
    {
        $task = $this->taskFactory->create($this->faker->words(10, true), $this->randomStatus(),
            $this->faker->numberBetween(), $this->project, $this->user, $this->faker->dateTime);
        $this->taskRepository->create($task);
        return $task;
    }

    public function testCreateTaskSuccess()
    {
        $taskData = $this->taskData();
        $response = $this->withHeaders([
            'Authorization' => $this->user->getToken(),
            'Accept' => 'application/json'
        ])->post('/api/tasks', $taskData);
        $response->assertStatus(200);
        $response->assertJsonStructure(['id', 'name', 'status', 'deadline', 'priority']);
    }

    public function testUpdateSuccess()
    {
        $task = $this->mockTask();
        $taskData = $this->taskData();
        $response = $this->withHeaders([
            'Authorization' => $this->user->getToken(),
            'Accept' => 'application/json'
        ])->put('/api/tasks/' . $task->getId(), $taskData);
        $response->assertStatus(200);
        $response->assertJsonStructure(['id', 'name', 'status', 'deadline', 'priority']);
    }

    public function testDeleteSuccess()
    {
        $task = $this->mockTask();
        $response = $this->withHeaders([
            'Authorization' => $this->user->getToken(),
            'Accept' => 'application/json'
        ])->delete('/api/tasks/' . $task->getId());
        $response->assertStatus(200);
        $this->assertDatabaseMissing('tasks', ['id' => $task->getId()]);
    }

    private function taskData(): array
    {
        return [
            'name' => $this->faker->words(10, true),
            'status' => $this->randomStatus(),
            'deadline' => $this->faker->dateTime,
            'priority' => $this->faker->numberBetween(),
            'project_id' => $this->project->getId(),
        ];
    }

    private function randomStatus(): string
    {
        $taskStatuses = [Task::UNDONE_STATUS, Task::DONE_STATUS];
        return $taskStatuses[array_rand($taskStatuses)];
    }

}

