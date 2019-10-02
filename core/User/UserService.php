<?php

namespace Core\User;

use Core\User\Exceptions\PasswordNotMatchException;
use Core\User\Requests\LoginUserRequest;
use Core\User\Responses\LoginUserResponse;

class UserService extends AbstractUserService
{
    private $userRepository;
    private $userFactory;

    public function __construct(UserRepository $userRepository, UserFactory $userFactory)
    {
        $this->userRepository = $userRepository;
        $this->userFactory = $userFactory;
    }

    /**
     * @param LoginUserRequest $request
     * @param LoginUserResponse $response
     * @throws PasswordNotMatchException
     */
    public function login(LoginUserRequest $request, LoginUserResponse $response)
    {
        $user = $this->userRepository->findByUsername($request->getUsername());
        if (!$user) {
            $user = $this->createUser($request->getUsername(), $request->getPassword());
        } elseif (!$user->checkPassword($request->getPassword())) {
            throw new PasswordNotMatchException('Password not match');
        }
        $response->setUser($user);
    }

    private function createUser(string $username, string $password): User
    {
        $user = $this->userFactory->create($username, $password);
        $id = $this->userRepository->create($user);
        $user->setId($id);
    }
}
