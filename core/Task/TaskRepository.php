<?php

namespace Core\Task;

use Core\Project\Project;

interface TaskRepository
{
    public function create(Task $task): int;

    public function getById(int $taskID): ?Task;

    public function update(Task $task);

    public function delete(Task $task);

    public function getForProject(Project $project): array;
}
