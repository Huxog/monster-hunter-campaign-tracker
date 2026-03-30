<?php

namespace Tests\Feature\Quest;

use App\Models\Quest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuestDestroyTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_soft_deletes_quest(): void
    {
        $this->asAdmin();
        $quest = Quest::factory()->create();

        $response = $this->deleteJson("api/quests/{$quest->id}");

        $response->assertStatus(200);
        $this->assertSoftDeleted('quests', ['id' => $quest->id]);
    }

    public function test_deleted_quest_not_in_index(): void
    {
        $this->asAdmin();
        $quest = Quest::factory()->create();
        $quest->delete();

        $response = $this->getJson('api/quests');

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    public function test_player_cannot_delete_quest(): void
    {
        $this->asPlayer();
        $quest = Quest::factory()->create();

        $response = $this->deleteJson("api/quests/{$quest->id}");

        $response->assertStatus(403);
    }

    public function test_unauthenticated_user_cannot_delete_quest(): void
    {
        $quest = Quest::factory()->create();

        $response = $this->deleteJson("api/quests/{$quest->id}");

        $response->assertStatus(401);
    }

    public function test_returns_404_for_non_existent_quest(): void
    {
        $this->asAdmin();

        $response = $this->deleteJson('api/quests/00000000-0000-0000-0000-000000000000');

        $response->assertStatus(404);
    }

    public function test_returns_404_for_already_deleted_quest(): void
    {
        $this->asAdmin();
        $quest = Quest::factory()->create();
        $quest->delete();

        $response = $this->deleteJson("api/quests/{$quest->id}");

        $response->assertStatus(404);
    }
}
