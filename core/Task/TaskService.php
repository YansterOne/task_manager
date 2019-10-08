<?php

namespace Core\Task;

use Core\Project\Exceptions\AccessDeniedException;
use Core\Project\ProjectRepository;
use Core\Task\Requests\AddTaskRequest;
use Core\Task\Responses\AddTaskResponse;
use Core\User\UserRepository;

class TaskService
{
    /**
     * @var TaskRepository
     */
    private $taskRepository;

    /**
     * @var TaskFactory
     */
    private $taskFactory;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    public function __construct(
        TaskRepository $repository,
        TaskFactory $factory,
        UserRepository $userRepository,
        ProjectRepository $projectRepository
    ) {
        $this->taskRepository = $repository;
        $this->taskFactory = $factory;
        $this->userRepository = $userRepository;
        $this->projectRepository = $projectRepository;
    }

    /**
     * @param AddTaskRequest $request
     * @param AddTaskResponse $response
     * @throws AccessDeniedException
     */
    public function addTask(AddTaskRequest $request, AddTaskResponse $response)
    {
        $user = $this->userRepository->getByID($request->getAuthUserID());
        $project = $this->projectRepository->getByID($request->getProjectID());
        if (!$project->hasPermissions($user)) {
            throw new AccessDeniedException('Access denied');
        }
        $task = $this->taskFactory->create($request->getName(), $request->getStatus(), $request->getPriority(),
            $project, $user);
        $id = $this->taskRepository->create($task);
        $task->setId($id);
        $response->setTask($task);
    }

}
