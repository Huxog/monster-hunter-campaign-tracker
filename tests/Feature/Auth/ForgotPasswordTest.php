<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ForgotPasswordTest extends TestCase
{
    use RefreshDatabase;

    public function test_sends_reset_link_for_registered_email(): void
    {
        Notification::fake();

        User::factory()->create(['email' => 'test@example.com']);

        $response = $this->postJson('api/auth/forgot-password', [
            'email' => 'test@example.com',
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('message', 'If that email is registered you will receive a password reset link shortly');
    }

    public function test_returns_same_response_for_unregistered_email(): void
    {
        Notification::fake();

        $response = $this->postJson('api/auth/forgot-password', [
            'email' => 'nobody@example.com',
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('message', 'If that email is registered you will receive a password reset link shortly');
    }

    public function test_returns_validation_error_when_email_missing(): void
    {
        $response = $this->postJson('api/auth/forgot-password', []);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'AUT-0206-0001');
    }

    public function test_returns_validation_error_when_email_invalid(): void
    {
        $response = $this->postJson('api/auth/forgot-password', [
            'email' => 'not-an-email',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'AUT-0206-0002');
    }
}
