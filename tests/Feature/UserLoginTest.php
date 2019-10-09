<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    public function testLoginSuccess()
    {
        $credentials = [
            'username' => $this->faker->userName,
            'password' => $this->faker->password
        ];
        $response = $this->post('/api/login', $credentials);
        $response->assertStatus(200);
        $response->assertJsonStructure(['username', 'token']);
        $response->assertJsonFragment(['username' => $credentials['username']]);
    }
}
