<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Role::firstOrCreate(['name' => 'player', 'guard_name' => 'web']);
    }

    public function test_registers_user_with_valid_data(): void
    {
        $response = $this->postJson('api/auth/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('data.name', 'Test User')
            ->assertJsonPath('data.email', 'test@example.com')
            ->assertJsonStructure(['data', 'token']);

        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }

    public function test_registered_user_has_player_role(): void
    {
        $this->postJson('api/auth/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $user = User::where('email', 'test@example.com')->first();
        $this->assertTrue($user->hasRole('admin') === false);
        $this->assertTrue($user->hasRole('player'));
    }

    public function test_returns_validation_error_when_email_missing(): void
    {
        $response = $this->postJson('api/auth/register', [
            'name' => 'Test User',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'AUT-0202-0004');
    }

    public function test_returns_validation_error_for_duplicate_email(): void
    {
        User::factory()->create(['email' => 'test@example.com']);

        $response = $this->postJson('api/auth/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'AUT-0202-0006');
    }

    public function test_returns_validation_error_when_password_too_short(): void
    {
        $response = $this->postJson('api/auth/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'short',
            'password_confirmation' => 'short',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'AUT-0202-0008');
    }

    public function test_returns_validation_error_when_passwords_dont_match(): void
    {
        $response = $this->postJson('api/auth/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'different123',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'AUT-0202-0009');
    }
}
