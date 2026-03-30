<?php

namespace Tests\Feature\Quest;

use App\Models\Quest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuestIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_all_quests(): void
    {
        $this->asPlayer();
        Quest::factory()->count(3)->create();

        $response = $this->getJson('api/quests');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function test_returns_empty_array_when_no_quests_exist(): void
    {
        $this->asPlayer();

        $response = $this->getJson('api/quests');

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    public function test_does_not_return_soft_deleted_quests(): void
    {
        $this->asPlayer();
        Quest::factory()->count(2)->create();
        Quest::factory()->create()->delete();

        $response = $this->getJson('api/quests');

        $response->assertStatus(200)
            ->assertJsonCount(2, 'data');
    }

    public function test_unauthenticated_user_cannot_list_quests(): void
    {
        $response = $this->getJson('api/quests');

        $response->assertStatus(401);
    }
}
