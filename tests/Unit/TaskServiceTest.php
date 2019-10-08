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
use Fake\Task\Responses\FakeAddTaskResponse;
use Fake\Task\FakeTaskRepository;
use Fake\User\FakeUserRepository;
use Tests\TestCase;

class TaskServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testAddTaskSuccess()
    {
        $user = (new UserFactory())->create($this->faker->userName, $this->faker->password);
        $userRepository = new FakeUserRepository();
        $userID = $userRepository->create($user);
        $user->setId($userID);

        $project = (new ProjectFactory())->create($this->faker->word, $user);
        $projectRepository = new FakeProjectRepository();
        $projectID = $projectRepository->create($project);
        $project->setId($projectID);

        $request = new FakeAddTaskRequest($this->faker->words(5, true), 0, Task::UNDONE_STATUS, $projectID, $userID);
        $response = new FakeAddTaskResponse();
        $repository = new FakeTaskRepository();
        $factory = new TaskFactory();
        $service = new TaskService($repository, $factory, $userRepository, $projectRepository);
        $service->addTask($request, $response);
        $this->assertNotEmpty($response->getTask());
    }

    public function testAddTaskFailNotAccess()
    {
        $this->expectException(AccessDeniedException::class);
        $userRepository = new FakeUserRepository();

        $user = (new UserFactory())->create($this->faker->userName, $this->faker->password);
        $userID = $userRepository->create($user);
        $user->setId($userID);

        $user2 = (new UserFactory())->create($this->faker->userName, $this->faker->password);
        $userID2 = $userRepository->create($user2);
        $user2->setId($userID2);

        $project = (new ProjectFactory())->create($this->faker->word, $user2);
        $projectRepository = new FakeProjectRepository();
        $projectID = $projectRepository->create($project);
        $project->setId($projectID);

        $request = new FakeAddTaskRequest($this->faker->words(5, true), 0, Task::UNDONE_STATUS, $projectID, $userID);
        $response = new FakeAddTaskResponse();
        $repository = new FakeTaskRepository();
        $factory = new TaskFactory();
        $service = new TaskService($repository, $factory, $userRepository, $projectRepository);
        $service->addTask($request, $response);
    }
}
