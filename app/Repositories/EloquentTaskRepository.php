<?php

namespace App\Repositories;

use Core\Project\ProjectFactory;
use Core\Task\Task;
use Core\Task\TaskFactory;
use Core\Task\TaskRepository;
use App\Models\Task as DBTask;
use Core\User\UserFactory;

class EloquentTaskRepository implements TaskRepository
{
    /**
     * @var TaskFactory
     */
    private $taskFactory;
    /**
     * @var ProjectFactory
     */
    private $projectFactory;
    /**
     * @var UserFactory
     */
    private $userFactory;

    public function __construct(TaskFactory $taskFactory, ProjectFactory $projectFactory, UserFactory $userFactory)
    {
        $this->taskFactory = $taskFactory;
        $this->projectFactory = $projectFactory;
        $this->userFactory = $userFactory;
    }

    public function create(Task $task): int
    {
        $dbTask = DBTask::query()->create([
            'name' => $task->getName(),
            'status' => $task->getName(),
            'priority' => $task->getPriority(),
            'deadline' => $task->getDeadline(),
        ]);
        $id = $dbTask->getId();
        $task->setId($id);
        return $id;
    }

    public function delete(Task $task)
    {
        DBTask::query()->where('id', $task->getId())->delete();
    }

    public function getById(int $taskID): ?Task
    {
        $dbTask = DBTask::with(['project', 'user'])->find($taskID);
        if (!$dbTask) {
            return null;
        }
        $dbTaskUser = $dbTask->getUser();
        $user = $this->userFactory->create($dbTaskUser->getUsername(), $dbTaskUser->getPassword(),
            $dbTaskUser->getApiToken(), $dbTaskUser->getId());
        $dbProject = $dbTask->getProject();
        $dbProjectUser = $dbProject->getUser();
        $projectUser = $this->userFactory->create($dbProjectUser->getUsername(), $dbProjectUser->getPassword(),
            $dbProjectUser->getApiToken(), $dbProjectUser->getId());
        $project = $this->projectFactory->create($dbProject->getName(), $projectUser, $dbProject->getId());
        $task = $this->taskFactory->create($dbTask->getName(), $dbTask->getStatus(), $dbTask->getPriority(), $project,
            $user);
        return $task;
    }

    public function update(Task $task)
    {
        DBTask::query()->where('id', $task->getId())->update([
            'name' => $task->getName(),
            'status' => $task->getName(),
            'priority' => $task->getPriority(),
            'deadline' => $task->getDeadline(),
        ]);
    }
}
