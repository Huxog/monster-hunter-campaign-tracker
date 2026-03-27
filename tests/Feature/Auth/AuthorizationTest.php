<?php

namespace Tests\Feature\Auth;

use App\Models\Map;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_user_cannot_access_routes(): void
    {
        $response = $this->getJson('api/maps');

        $response->assertStatus(401);
    }

    public function test_player_can_read_resources(): void
    {
        $this->asPlayer();
        Map::factory()->count(3)->create();

        $response = $this->getJson('api/maps');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function test_player_cannot_create_resources(): void
    {
        $this->asPlayer();

        $response = $this->postJson('api/maps', [
            'name' => 'Forbidden Map',
        ]);

        $response->assertStatus(403);
    }

    public function test_player_cannot_update_resources(): void
    {
        $this->asPlayer();
        $map = Map::factory()->create();

        $response = $this->putJson("api/maps/{$map->id}", [
            'name' => 'Updated Name',
        ]);

        $response->assertStatus(403);
    }

    public function test_player_cannot_delete_resources(): void
    {
        $this->asPlayer();
        $map = Map::factory()->create();

        $response = $this->deleteJson("api/maps/{$map->id}");

        $response->assertStatus(403);
    }

    public function test_admin_can_create_resources(): void
    {
        $this->asAdmin();

        $response = $this->postJson('api/maps', [
            'name' => 'Admin Map',
        ]);

        $response->assertStatus(201);
    }

    public function test_admin_can_update_resources(): void
    {
        $this->asAdmin();
        $map = Map::factory()->create();

        $response = $this->putJson("api/maps/{$map->id}", [
            'name' => 'Updated by Admin',
        ]);

        $response->assertStatus(200);
    }

    public function test_admin_can_delete_resources(): void
    {
        $this->asAdmin();
        $map = Map::factory()->create();

        $response = $this->deleteJson("api/maps/{$map->id}");

        $response->assertStatus(200);
    }
}
