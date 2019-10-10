<?php

namespace Tests\Feature;

use App\Repositories\EloquentUserRepository;
use Core\User\User;
use Core\User\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProjectCreateTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @var User
     */
    private $user;
    private $userRepository;
    private $userFactory;

    public function setUp(): void
    {
        parent::setUp();
        $this->userFactory = new UserFactory();
        $this->userRepository = new EloquentUserRepository($this->userFactory);
        $this->mockUser();
    }

    public function testCreateProject()
    {
        $response = $this->withHeader('Authorization', $this->user->getToken())->post('/api/projects', [
            'name' => $this->faker->words(10, true)
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure(['id', 'name']);
    }

    private function mockUser()
    {
        $this->user = $this->userFactory->create($this->faker->userName, $this->faker->password);
        $this->userRepository->create($this->user);
    }

}
