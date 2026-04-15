<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ChangePasswordTest extends TestCase
{
    use RefreshDatabase;

    public function test_changes_password_with_correct_current_password(): void
    {
        $user = $this->asPlayer();
        $user->update(['password' => 'oldpassword123']);

        $response = $this->postJson('api/auth/change-password', [
            'current_password' => 'oldpassword123',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('message', 'Password changed successfully');

        $this->assertTrue(Hash::check('newpassword123', $user->fresh()->password));
    }

    public function test_returns_422_when_current_password_is_wrong(): void
    {
        $this->asPlayer();

        $response = $this->postJson('api/auth/change-password', [
            'current_password' => 'wrongpassword',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertStatus(422)
            ->assertJsonPath('code', 'AUT-0306-0002');
    }

    public function test_requires_authentication(): void
    {
        $response = $this->postJson('api/auth/change-password', [
            'current_password' => 'oldpassword123',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertStatus(401);
    }

    public function test_returns_validation_error_when_current_password_missing(): void
    {
        $this->asPlayer();

        $response = $this->postJson('api/auth/change-password', [
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'AUT-0206-0001');
    }

    public function test_returns_validation_error_when_new_password_missing(): void
    {
        $this->asPlayer();

        $response = $this->postJson('api/auth/change-password', [
            'current_password' => 'oldpassword123',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'AUT-0206-0002');
    }

    public function test_returns_validation_error_when_new_password_too_short(): void
    {
        $this->asPlayer();

        $response = $this->postJson('api/auth/change-password', [
            'current_password' => 'oldpassword123',
            'password' => 'short',
            'password_confirmation' => 'short',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'AUT-0206-0003');
    }

    public function test_returns_validation_error_when_passwords_dont_match(): void
    {
        $this->asPlayer();

        $response = $this->postJson('api/auth/change-password', [
            'current_password' => 'oldpassword123',
            'password' => 'newpassword123',
            'password_confirmation' => 'different123',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'AUT-0206-0004');
    }
}
