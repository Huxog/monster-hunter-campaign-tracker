<?php

namespace Tests\Feature\Monster;

use App\Models\Monster;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MonsterDestroyTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_soft_deletes_monster(): void
    {
        $this->asAdmin();
        $monster = Monster::factory()->create();

        $response = $this->deleteJson("api/monsters/{$monster->id}");

        $response->assertStatus(200);
        $this->assertSoftDeleted('monsters', ['id' => $monster->id]);
    }

    public function test_deleted_monster_not_in_index(): void
    {
        $this->asAdmin();
        $monster = Monster::factory()->create();
        $this->deleteJson("api/monsters/{$monster->id}");

        $response = $this->getJson('api/monsters');

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    public function test_player_cannot_delete_monster(): void
    {
        $this->asPlayer();
        $monster = Monster::factory()->create();

        $response = $this->deleteJson("api/monsters/{$monster->id}");

        $response->assertStatus(403);
    }

    public function test_unauthenticated_user_cannot_delete_monster(): void
    {
        $monster = Monster::factory()->create();

        $response = $this->deleteJson("api/monsters/{$monster->id}");

        $response->assertStatus(401);
    }

    public function test_returns_404_for_non_existent_monster(): void
    {
        $this->asAdmin();

        $response = $this->deleteJson('api/monsters/non-existent-id');

        $response->assertStatus(404);
    }

    public function test_returns_404_for_already_deleted_monster(): void
    {
        $this->asAdmin();
        $monster = Monster::factory()->create();
        $monster->delete();

        $response = $this->deleteJson("api/monsters/{$monster->id}");

        $response->assertStatus(404);
    }
}
