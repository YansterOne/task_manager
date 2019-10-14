<?php

namespace App\Repositories;

use Core\Project\Project;
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
            'status' => $task->getStatus(),
            'priority' => $task->getPriority(),
            'deadline' => $task->getDeadline(),
            'project_id' => $task->getProject()->getId(),
            'user_id' => $task->getUser()->getId(),
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
        $task = $this->createTaskFromDBTask($dbTask);
        return $task;
    }

    public function update(Task $task)
    {
        DBTask::query()->where('id', $task->getId())->update([
            'name' => $task->getName(),
            'status' => $task->getStatus(),
            'priority' => $task->getPriority(),
            'deadline' => $task->getDeadline(),
        ]);
    }

    public function getForProject(Project $project): array
    {
        $dbTasks = DBTask::query()->where('project_id', $project->getId())->get();
        return $dbTasks->map(function (DBTask $task) {
            return $this->createTaskFromDBTask($task);
        })->toArray();
    }

    private function createTaskFromDBTask(DBTask $dbTask): Task
    {
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
        $task->setId($dbTask->getId());
        return $task;
    }
}
