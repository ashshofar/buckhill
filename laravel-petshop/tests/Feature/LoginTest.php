<?php

namespace Tests\Feature;

use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_can_create_user()
    {
        // Send a POST request to your login endpoint with valid credentials.
        $response = $this->json('POST', '/api/v1/user/create', [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->email,
            'password' => 'password',
            'password_confirmation' => 'password',
            'address' => $this->faker->address,
            'phone_number' => $this->faker->phoneNumber
        ]);

        $response->assertStatus(200);
    }

    public function test_valid_user_can_login()
    {
        // Create a user using factory or a real user from your database.
        $user = User::factory()->create([
            'password' => bcrypt('password')
        ]);

        // Send a POST request to your login endpoint with valid credentials.
        $response = $this->json('POST', '/api/v1/admin/login', [
            'email' => $user->email,
            'password' => 'password', // Replace 'password' with the actual user password
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'token'
            ]
        ]);
    }

    public function test_invalid_user_email_cannot_login()
    {
        // Send a POST request with invalid credentials.
        $response = $this->json('POST', '/api/v1/admin/login', [
            'email' => 'nonexistent@example.com',
            'password' => 'wrong_password',
        ]);

        $response->assertStatus(422);
    }

    public function test_invalid_user_password_cannot_login()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password')
        ]);

        // Send a POST request with invalid credentials.
        $response = $this->json('POST', '/api/v1/admin/login', [
            'email' => $user->email,
            'password' => 'wrong_password',
        ]);

        $response->assertStatus(422);
    }
}
