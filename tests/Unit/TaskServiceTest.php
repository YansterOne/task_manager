<?php

namespace Tests\Unit;

use Core\Project\Exceptions\AccessDeniedException;
use Core\Project\Project;
use Core\Project\ProjectFactory;
use Core\Task\Task;
use Core\Task\TaskFactory;
use Core\Task\TaskService;
use Core\User\User;
use Core\User\UserFactory;
use Fake\Project\FakeProjectRepository;
use Fake\Task\Requests\FakeAddTaskRequest;
use Fake\Task\Requests\FakeDeleteTaskRequest;
use Fake\Task\Requests\FakeUpdateTaskRequest;
use Fake\Task\Responses\FakeAddTaskResponse;
use Fake\Task\FakeTaskRepository;
use Fake\Task\Responses\FakeUpdateTaskResponse;
use Fake\User\FakeUserRepository;
use Tests\TestCase;

class TaskServiceTest extends TestCase
{
    private $userRepository;
    private $projectRepository;
    private $taskRepository;
    private $taskFactory;
    private $taskService;

    public function setUp(): void
    {
        $this->userRepository = new FakeUserRepository();
        $this->projectRepository = new FakeProjectRepository();
        $this->taskRepository = new FakeTaskRepository();
        $this->taskFactory = new TaskFactory();
        $this->taskService = new TaskService($this->taskRepository, $this->taskFactory, $this->userRepository,
            $this->projectRepository);
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
        $project = (new ProjectFactory())->create($this->faker->word, $user);
        $projectID = $this->projectRepository->create($project);
        $project->setId($projectID);
        return $project;
    }

    private function createAndSaveTask(Project $project, User $user): Task
    {
        $task = $this->taskFactory->create($this->faker->words(5, true), Task::UNDONE_STATUS, 0, $project, $user);
        $taskID = $this->taskRepository->create($task);
        $task->setId($taskID);
        return $task;
    }

    public function testAddTaskSuccess()
    {
        $user = $this->createAndSaveUser();
        $project = $this->createAndSaveProject($user);
        $request = new FakeAddTaskRequest($this->faker->words(5, true), 0, Task::UNDONE_STATUS, $project->getId(),
            $user->getId());
        $response = new FakeAddTaskResponse();
        $this->taskService->addTask($request, $response);
        $this->assertNotEmpty($response->getTask());
    }

    public function testAddTaskFailNotAccess()
    {
        $this->expectException(AccessDeniedException::class);
        $user = $this->createAndSaveUser();
        $user2 = $this->createAndSaveUser();
        $project = $this->createAndSaveProject($user2);
        $request = new FakeAddTaskRequest($this->faker->words(5, true), 0, Task::UNDONE_STATUS, $project->getId(),
            $user->getId());
        $response = new FakeAddTaskResponse();
        $this->taskService->addTask($request, $response);
    }

    public function testUpdateTaskSuccess()
    {
        $user = $this->createAndSaveUser();
        $project = $this->createAndSaveProject($user);

        $task = $this->taskFactory->create($this->faker->words(5, true), Task::UNDONE_STATUS, 0, $project, $user);
        $taskID = $this->taskRepository->create($task);
        $task->setId($taskID);

        $request = new FakeUpdateTaskRequest($taskID, $user->getId(), $this->faker->words(5, true), 0,
            Task::UNDONE_STATUS);
        $response = new FakeUpdateTaskResponse();

        $this->taskService->updateTask($request, $response);
        $this->assertNotEmpty($response->getTask());
    }

    public function testUpdateTaskFailNotAccess()
    {
        $this->expectException(AccessDeniedException::class);

        $user = $this->createAndSaveUser();
        $user2 = $this->createAndSaveUser();
        $project = $this->createAndSaveProject($user2);

        $task = $this->taskFactory->create($this->faker->words(5, true), Task::UNDONE_STATUS, 0, $project, $user2);
        $taskID = $this->taskRepository->create($task);
        $task->setId($taskID);

        $request = new FakeUpdateTaskRequest($taskID, $user->getId(), $this->faker->words(5, true), 0,
            Task::UNDONE_STATUS);
        $response = new FakeUpdateTaskResponse();

        $this->taskService->updateTask($request, $response);
    }

    public function testDeleteTaskSuccess()
    {
        $user = $this->createAndSaveUser();
        $project = $this->createAndSaveProject($user);
        $task = $this->createAndSaveTask($project, $user);
        $request = new FakeDeleteTaskRequest($task->getId(), $user->getId());
        $this->taskService->deleteTask($request);
        $this->assertEmpty($this->taskRepository->getById($task->getId()));
    }

    public function testDeleteTaskFailNotAccess()
    {
        $this->expectException(AccessDeniedException::class);
        $user = $this->createAndSaveUser();
        $user2 = $this->createAndSaveUser();
        $project = $this->createAndSaveProject($user2);
        $task = $this->createAndSaveTask($project, $user2);
        $request = new FakeDeleteTaskRequest($task->getId(), $user->getId());
        $this->taskService->deleteTask($request);
    }
}
