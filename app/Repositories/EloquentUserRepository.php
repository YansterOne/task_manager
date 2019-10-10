<?php

namespace App\Repositories;

use Core\User\User;
use Core\User\UserFactory;
use Core\User\UserRepository;
use App\Models\User as DBUser;

class EloquentUserRepository implements UserRepository
{
    private $userFactory;

    public function __construct(UserFactory $userFactory)
    {
        $this->userFactory = $userFactory;
    }

    public function create(User $user): int
    {
        $createdUser = DBUser::query()->create([
            'username' => $user->getUsername(),
            'password' => $user->getPassword(),
            'api_token' => $user->getToken(),
        ]);
        $id = $createdUser->getId();
        $user->setId($id);
        return $id;
    }

    public function findByUsername(string $username): ?User
    {
        $founded = DBUser::query()->where('username', $username)->first();
        if (!$founded) {
            return null;
        }
        return $this->userFactory->create($founded->getUsername(), $founded->getPassword(), $founded->getApiToken(),
            $founded->getId());
    }

    public function getByID(int $id): ?User
    {
        $founded = DBUser::query()->find($id);
        if (!$founded) {
            return null;
        }
        return $this->userFactory->create($founded->getUsername(), $founded->getPassword(), $founded->getApiToken(),
            $founded->getId());
    }

    public function findByToken(string $token): ?User
    {
        $founded = DBUser::query()->where('api_token', $token)->first();
        if (!$founded) {
            return null;
        }
        return $this->userFactory->create($founded->getUsername(), $founded->getPassword(), $founded->getApiToken(),
            $founded->getId());
    }
}
