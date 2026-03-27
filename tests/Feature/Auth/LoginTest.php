<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_logs_in_with_valid_credentials(): void
    {
        User::factory()->create([
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response = $this->postJson('api/auth/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['data', 'token'])
            ->assertJsonPath('data.email', 'test@example.com');
    }

    public function test_returns_401_with_wrong_password(): void
    {
        User::factory()->create([
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response = $this->postJson('api/auth/login', [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(401)
            ->assertJsonPath('code', 'AUT-0302-0001');
    }

    public function test_returns_401_with_non_existent_email(): void
    {
        $response = $this->postJson('api/auth/login', [
            'email' => 'nonexistent@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(401);
    }

    public function test_returns_validation_error_when_email_missing(): void
    {
        $response = $this->postJson('api/auth/login', [
            'password' => 'password123',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'AUT-0202-0001');
    }

    public function test_returns_validation_error_when_password_missing(): void
    {
        $response = $this->postJson('api/auth/login', [
            'email' => 'test@example.com',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'AUT-0202-0003');
    }
}
