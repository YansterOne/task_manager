<?php

namespace Tests\Unit;

use Core\User\Exceptions\PasswordNotMatchException;
use Core\User\UserFactory;
use Core\User\UserService;
use Fake\User\FakeUserRepository;
use Fake\User\Requests\FakeAuthUserRequest;
use Fake\User\Requests\FakeLoginUserRequest;
use Fake\User\Responses\FakeLoginUserResponse;
use Faker\Factory;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private $userFactory;
    private $userRepository;
    private $userService;

    public function setUp(): void
    {
        $this->userFactory = new UserFactory();
        $this->userRepository = new FakeUserRepository();
        $this->userService = new UserService($this->userRepository, $this->userFactory);
    }

    public function testLoginFail()
    {
        $this->expectException(PasswordNotMatchException::class);
        $creds = $this->fakeCredentials();
        $user = $this->userFactory->create($creds['username'], $creds['password']);
        $this->userRepository->create($user);
        $invalidPassword = $creds['password'] . rand();
        $loginRequest = new FakeLoginUserRequest($creds['username'], $invalidPassword);
        $loginResponse = new FakeLoginUserResponse();
        $this->userService->login($loginRequest, $loginResponse);
    }

    public function testLoginSuccess()
    {
        $creds = $this->fakeCredentials();
        $user = $this->userFactory->create($creds['username'], $creds['password'], null, null, true);
        $this->userRepository->create($user);
        $loginRequest = new FakeLoginUserRequest($creds['username'], $creds['password']);
        $loginResponse = new FakeLoginUserResponse();
        $this->userService->login($loginRequest, $loginResponse);
        $this->assertNotEmpty($loginResponse->getUser());
    }

    public function testGetAuthUserSuccess()
    {
        $creds = $this->fakeCredentials();
        $user = $this->userFactory->create($creds['username'], $creds['password']);
        $this->userRepository->create($user);
        $request= new FakeAuthUserRequest($user->getToken());
        $this->userService->getAuthUser($request);
        $this->assertNotEmpty($request->getAuthUser());
    }

    private function fakeCredentials(): array
    {
        $faker = Factory::create();
        return [
            'username' => $faker->userName,
            'password' => $faker->password,
        ];
    }
}
