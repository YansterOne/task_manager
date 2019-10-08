<?php

namespace Core\Project;

use Core\Entity;
use Core\User\User;

class Project extends Entity
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var User
     */
    private $user;

    public function __construct(string $name, User $user)
    {
        $this->name = $name;
        $this->user = $user;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function hasPermissions(User $user): bool
    {
        return $this->user->getId() === $user->getId();
    }
}
