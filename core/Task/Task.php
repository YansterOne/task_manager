<?php

namespace Core\Task;

use Core\Entity;
use Core\Project\Project;
use Core\User\User;

class Task extends Entity
{
    public const DONE_STATUS = 'Done';
    public const UNDONE_STATUS = 'Undone';
    /**
     * @var string
     */
    private $status;

    /**
     * @var Project
     */
    private $project;

    /**
     * @var User
     */
    private $user;

    /**
     * @var int
     */
    private $priority;

    public function __construct(string $name, string $status, int $priority, Project $project, User $user)
    {
        $this->name = $name;
        $this->status = $status;
        $this->priority = $priority;
        $this->project = $project;
        $this->user = $user;
    }
}
