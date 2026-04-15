<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    use RefreshDatabase;

    public function test_resets_password_with_valid_token(): void
    {
        $user = User::factory()->create(['email' => 'test@example.com']);
        $token = Password::createToken($user);

        $response = $this->postJson('api/auth/reset-password', [
            'token' => $token,
            'email' => 'test@example.com',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('message', 'Password has been reset successfully');

        $this->assertTrue(Hash::check('newpassword123', $user->fresh()->password));
    }

    public function test_returns_422_for_invalid_token(): void
    {
        User::factory()->create(['email' => 'test@example.com']);

        $response = $this->postJson('api/auth/reset-password', [
            'token' => 'invalid-token',
            'email' => 'test@example.com',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertStatus(422)
            ->assertJsonPath('code', 'AUT-0306-0001');
    }

    public function test_returns_validation_error_when_token_missing(): void
    {
        $response = $this->postJson('api/auth/reset-password', [
            'email' => 'test@example.com',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'AUT-0206-0001');
    }

    public function test_returns_validation_error_when_email_missing(): void
    {
        $response = $this->postJson('api/auth/reset-password', [
            'token' => 'sometoken',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'AUT-0206-0002');
    }

    public function test_returns_validation_error_when_email_invalid(): void
    {
        $response = $this->postJson('api/auth/reset-password', [
            'token' => 'sometoken',
            'email' => 'not-an-email',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'AUT-0206-0003');
    }

    public function test_returns_validation_error_when_password_too_short(): void
    {
        $response = $this->postJson('api/auth/reset-password', [
            'token' => 'sometoken',
            'email' => 'test@example.com',
            'password' => 'short',
            'password_confirmation' => 'short',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'AUT-0206-0005');
    }

    public function test_returns_validation_error_when_passwords_dont_match(): void
    {
        $response = $this->postJson('api/auth/reset-password', [
            'token' => 'sometoken',
            'email' => 'test@example.com',
            'password' => 'newpassword123',
            'password_confirmation' => 'different123',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'AUT-0206-0006');
    }
}
