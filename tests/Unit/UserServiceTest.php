<?php

namespace Tests\Unit;

use Core\User\Exceptions\PasswordNotMatchException;
use Core\User\UserService;
use Fake\User\FakeUserFactory;
use Fake\User\FakeUserRepository;
use Fake\User\Requests\FakeLoginUserRequest;
use Fake\User\Responses\FakeLoginUserResponse;
use Faker\Factory;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    public function testLoginFail()
    {
        $this->expectException(PasswordNotMatchException::class);
        $creds = $this->fakeCredentials();
        $userFactory = new FakeUserFactory();
        $user = $userFactory->create($creds['username'], $creds['password']);
        $userRepository = new FakeUserRepository([$user]);
        $invalidPassword = $creds['password'] . rand();
        $loginRequest = new FakeLoginUserRequest($creds['username'], $invalidPassword);
        $loginResponse = new FakeLoginUserResponse();
        $userService = new UserService($userRepository, $userFactory);
        $userService->login($loginRequest, $loginResponse);
    }

    public function testLoginSuccess()
    {
        $creds = $this->fakeCredentials();
        $userFactory = new FakeUserFactory();
        $user = $userFactory->create($creds['username'], $creds['password']);
        $userRepository = new FakeUserRepository([$user]);
        $loginRequest = new FakeLoginUserRequest($creds['username'], $creds['password']);
        $loginResponse = new FakeLoginUserResponse();
        $userService = new UserService($userRepository, $userFactory);
        $userService->login($loginRequest, $loginResponse);
        $this->assertNotEmpty($loginResponse->getUser());
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
