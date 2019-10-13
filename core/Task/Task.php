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

    /**
     * @var string
     */
    private $name;

    /**
     * @var \DateTime
     */
    private $deadline;

    public function __construct(
        string $name,
        string $status,
        int $priority,
        Project $project,
        User $user,
        \DateTime $deadline = null
    ) {
        $this->name = $name;
        $this->status = $status;
        $this->priority = $priority;
        $this->project = $project;
        $this->user = $user;
        $this->deadline = $deadline;
    }

    public function hasPermissions(User $user): bool
    {
        return $this->user->getId() === $user->getId();
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setPriority(int $priority): self
    {
        $this->priority = $priority;
        return $this;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDeadline(): ?\DateTime
    {
        return $this->deadline;
    }

    public function setDeadline(\DateTime $deadline): self
    {
        $this->deadline = $deadline;
        return $this;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getProject(): Project
    {
        return $this->project;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
