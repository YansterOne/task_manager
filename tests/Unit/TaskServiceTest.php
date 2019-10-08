<?php

namespace Tests\Unit;

use Core\Project\Exceptions\AccessDeniedException;
use Core\Project\ProjectFactory;
use Core\Task\Task;
use Core\Task\TaskFactory;
use Core\Task\TaskService;
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

    public function testAddTaskSuccess()
    {
        $user = (new UserFactory())->create($this->faker->userName, $this->faker->password);
        $userID = $this->userRepository->create($user);
        $user->setId($userID);

        $project = (new ProjectFactory())->create($this->faker->word, $user);
        $projectID = $this->projectRepository->create($project);
        $project->setId($projectID);

        $request = new FakeAddTaskRequest($this->faker->words(5, true), 0, Task::UNDONE_STATUS, $projectID, $userID);
        $response = new FakeAddTaskResponse();
        $this->taskService->addTask($request, $response);
        $this->assertNotEmpty($response->getTask());
    }

    public function testAddTaskFailNotAccess()
    {
        $this->expectException(AccessDeniedException::class);

        $user = (new UserFactory())->create($this->faker->userName, $this->faker->password);
        $userID = $this->userRepository->create($user);
        $user->setId($userID);

        $user2 = (new UserFactory())->create($this->faker->userName, $this->faker->password);
        $userID2 = $this->userRepository->create($user2);
        $user2->setId($userID2);

        $project = (new ProjectFactory())->create($this->faker->word, $user2);
        $projectID = $this->projectRepository->create($project);
        $project->setId($projectID);

        $request = new FakeAddTaskRequest($this->faker->words(5, true), 0, Task::UNDONE_STATUS, $projectID, $userID);
        $response = new FakeAddTaskResponse();
        $this->taskService->addTask($request, $response);
    }

    public function testUpdateTaskSuccess()
    {
        $user = (new UserFactory())->create($this->faker->userName, $this->faker->password);
        $userID = $this->userRepository->create($user);
        $user->setId($userID);

        $project = (new ProjectFactory())->create($this->faker->word, $user);
        $projectID = $this->projectRepository->create($project);
        $project->setId($projectID);

        $task = $this->taskFactory->create($this->faker->words(5, true), Task::UNDONE_STATUS, 0, $project, $user);
        $taskID = $this->taskRepository->create($task);
        $task->setId($taskID);

        $request = new FakeUpdateTaskRequest($taskID, $userID, $this->faker->words(5, true), 0, Task::UNDONE_STATUS);
        $response = new FakeUpdateTaskResponse();

        $this->taskService->updateTask($request, $response);
        $this->assertNotEmpty($response->getTask());
    }

    public function testUpdateTaskFailNotAccess()
    {
        $this->expectException(AccessDeniedException::class);

        $user = (new UserFactory())->create($this->faker->userName, $this->faker->password);
        $userID = $this->userRepository->create($user);
        $user->setId($userID);

        $user2 = (new UserFactory())->create($this->faker->userName, $this->faker->password);
        $userID2 = $this->userRepository->create($user2);
        $user2->setId($userID2);

        $project = (new ProjectFactory())->create($this->faker->word, $user2);
        $projectID = $this->projectRepository->create($project);
        $project->setId($projectID);

        $task = $this->taskFactory->create($this->faker->words(5, true), Task::UNDONE_STATUS, 0, $project, $user2);
        $taskID = $this->taskRepository->create($task);
        $task->setId($taskID);

        $request = new FakeUpdateTaskRequest($taskID, $userID, $this->faker->words(5, true), 0, Task::UNDONE_STATUS);
        $response = new FakeUpdateTaskResponse();

        $this->taskService->updateTask($request, $response);
    }

    public function testDeleteTaskSuccess()
    {
        $user = (new UserFactory())->create($this->faker->userName, $this->faker->password);
        $userID = $this->userRepository->create($user);
        $user->setId($userID);

        $project = (new ProjectFactory())->create($this->faker->word, $user);
        $projectID = $this->projectRepository->create($project);
        $project->setId($projectID);

        $task = $this->taskFactory->create($this->faker->words(5, true), Task::UNDONE_STATUS, 0, $project, $user);
        $taskID = $this->taskRepository->create($task);
        $task->setId($taskID);

        $request = new FakeDeleteTaskRequest($taskID, $userID);

        $this->taskService->deleteTask($request);
        $this->assertEmpty($this->taskRepository->getById($taskID));
    }

    public function testDeleteTaskFailNotAccess()
    {
        $this->expectException(AccessDeniedException::class);

        $user = (new UserFactory())->create($this->faker->userName, $this->faker->password);
        $userID = $this->userRepository->create($user);
        $user->setId($userID);

        $user2 = (new UserFactory())->create($this->faker->userName, $this->faker->password);
        $userID2 = $this->userRepository->create($user2);
        $user2->setId($userID2);

        $project = (new ProjectFactory())->create($this->faker->word, $user2);
        $projectID = $this->projectRepository->create($project);
        $project->setId($projectID);


        $task = $this->taskFactory->create($this->faker->words(5, true), Task::UNDONE_STATUS, 0, $project, $user2);
        $taskID = $this->taskRepository->create($task);
        $task->setId($taskID);

        $request = new FakeDeleteTaskRequest($taskID, $userID);

        $this->taskService->deleteTask($request);
    }
}
