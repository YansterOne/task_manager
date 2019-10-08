<?php

namespace Core\Task;

interface TaskRepository
{
    public function create(Task $task): int;
}
