<?php

namespace Fake\Task;

use Core\Task\Task;
use Core\Task\TaskRepository;

class FakeTaskRepository implements TaskRepository
{
    private $id = 0;

    /**
     * @var Task[]
     */
    private $tasks = [];

    public function __construct(array $tasks = [])
    {
        foreach ($tasks as $task) {
            $id = ++$this->id;
            $this->tasks[$id] = $task;
        }
    }

    public function create(Task $task): int
    {
        $id = ++$this->id;
        $this->tasks[$id] = $task;
        return $id;
    }

    public function getById(int $taskID): ?Task
    {
        return $this->tasks[$taskID] ?? null;
    }

    public function update(Task $task)
    {
        $this->tasks[$task->getId()] = $task;
    }
}
