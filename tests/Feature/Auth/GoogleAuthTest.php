<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Socialite\Contracts\Factory as SocialiteFactory;
use Laravel\Socialite\Contracts\Provider;
use Laravel\Socialite\Two\User as SocialiteUser;
use Mockery;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class GoogleAuthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Role::firstOrCreate(['name' => 'player', 'guard_name' => 'web']);
    }

    private function mockSocialiteUser(string $googleId, string $email, string $name): void
    {
        $socialiteUser = Mockery::mock(SocialiteUser::class);
        $socialiteUser->shouldReceive('getId')->andReturn($googleId);
        $socialiteUser->shouldReceive('getEmail')->andReturn($email);
        $socialiteUser->shouldReceive('getName')->andReturn($name);

        $provider = Mockery::mock(Provider::class);
        $provider->shouldReceive('stateless')->andReturnSelf();
        $provider->shouldReceive('user')->andReturn($socialiteUser);

        $socialite = Mockery::mock(SocialiteFactory::class);
        $socialite->shouldReceive('driver')->with('google')->andReturn($provider);

        $this->app->instance(SocialiteFactory::class, $socialite);
    }

    private function mockSocialiteRedirect(): void
    {
        $provider = Mockery::mock(Provider::class);
        $provider->shouldReceive('stateless')->andReturnSelf();
        $provider->shouldReceive('redirect')->andReturnSelf();
        $provider->shouldReceive('getTargetUrl')->andReturn('https://accounts.google.com/o/oauth2/auth?client_id=test');

        $socialite = Mockery::mock(SocialiteFactory::class);
        $socialite->shouldReceive('driver')->with('google')->andReturn($provider);

        $this->app->instance(SocialiteFactory::class, $socialite);
    }

    public function test_redirect_returns_google_oauth_url(): void
    {
        $this->mockSocialiteRedirect();

        $response = $this->getJson('api/v1/auth/google/redirect');

        $response->assertStatus(200)
            ->assertJsonStructure(['url'])
            ->assertJsonPath('url', 'https://accounts.google.com/o/oauth2/auth?client_id=test');
    }

    public function test_callback_creates_new_user_and_redirects_with_token(): void
    {
        $this->mockSocialiteUser('google-123', 'new@example.com', 'New User');

        $response = $this->get('api/v1/auth/google/callback');

        $response->assertRedirectContains('/auth/callback?token=');

        $this->assertDatabaseHas('users', [
            'email' => 'new@example.com',
            'googleId' => 'google-123',
        ]);
    }

    public function test_callback_returns_existing_user_matched_by_google_id(): void
    {
        $user = User::factory()->create(['googleId' => 'google-456']);
        $this->mockSocialiteUser('google-456', $user->email, $user->name);

        $this->get('api/v1/auth/google/callback')
            ->assertRedirectContains('/auth/callback?token=');

        $this->assertDatabaseCount('users', 1);
    }

    public function test_callback_links_google_id_to_existing_password_account(): void
    {
        $user = User::factory()->create([
            'email' => 'existing@example.com',
            'googleId' => null,
        ]);

        $this->mockSocialiteUser('google-789', 'existing@example.com', $user->name);

        $this->get('api/v1/auth/google/callback')
            ->assertRedirectContains('/auth/callback?token=');

        $this->assertDatabaseHas('users', [
            'email' => 'existing@example.com',
            'googleId' => 'google-789',
        ]);

        $this->assertDatabaseCount('users', 1);
    }

    public function test_new_google_user_is_assigned_player_role(): void
    {
        $this->mockSocialiteUser('google-101', 'player@example.com', 'Player One');

        $this->get('api/v1/auth/google/callback')
            ->assertRedirectContains('/auth/callback?token=');

        $user = User::where('email', 'player@example.com')->first();
        $this->assertTrue($user->hasRole('player'));
    }

    public function test_callback_redirects_with_error_on_failure(): void
    {
        $provider = Mockery::mock(Provider::class);
        $provider->shouldReceive('stateless')->andReturnSelf();
        $provider->shouldReceive('user')->andThrow(new \Exception('OAuth failed'));

        $socialite = Mockery::mock(SocialiteFactory::class);
        $socialite->shouldReceive('driver')->with('google')->andReturn($provider);
        $this->app->instance(SocialiteFactory::class, $socialite);

        $this->get('api/v1/auth/google/callback')
            ->assertRedirectContains('/auth/callback?error=google_auth_failed');
    }
}
