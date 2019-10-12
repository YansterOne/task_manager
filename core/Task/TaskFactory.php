<?php

namespace Core\Task;

use Core\Project\Project;
use Core\User\User;

class TaskFactory
{
    public function create(
        string $name,
        string $status,
        int $priority,
        Project $project,
        User $user,
        \DateTime $deadline = null
    ): Task {
        return new Task($name, $status, $priority, $project, $user, $deadline);
    }
}
