<?php

namespace Fake\User;

use Core\User\User;
use Core\User\UserRepository;

class FakeUserRepository implements UserRepository
{
    private $id = 0;

    /**
     * @var User[]
     */
    private $users = [];

    public function __construct(array $users = [])
    {
        foreach ($users as $user) {
            $id = ++$this->id;
            $this->users[$id] = $user;
        }
    }

    public function findByUsername(string $username): ?User
    {
        foreach ($this->users as $user) {
            if ($user->getUsername() === $username) {
                return $user;
            }
        }
        return null;
    }

    public function create(User $user): int
    {
        $id = ++$this->id;
        $this->users[$id] = $user;
        return $id;
    }

    public function get(): array
    {
        return $this->users;
    }

    public function getByID(int $id): ?User
    {
        return $this->users[$id];
    }
}
