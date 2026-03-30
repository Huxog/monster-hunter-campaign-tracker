<?php

namespace Tests\Feature\Quest;

use App\Models\Hunter;
use App\Models\Quest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuestShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_single_quest(): void
    {
        $this->asPlayer();
        $quest = Quest::factory()->create();

        $response = $this->getJson("api/quests/{$quest->id}");

        $response->assertStatus(200)
            ->assertJsonPath('data.id', $quest->id);
    }

    public function test_returns_quest_with_hunters(): void
    {
        $this->asPlayer();
        $quest = Quest::factory()->create();
        $hunters = Hunter::factory()->count(2)->create(['campaignId' => $quest->campaignId]);
        $quest->hunters()->sync($hunters->pluck('id'));

        $response = $this->getJson("api/quests/{$quest->id}");

        $response->assertStatus(200)
            ->assertJsonCount(2, 'data.hunters');
    }

    public function test_returns_quest_with_campaign_and_monster(): void
    {
        $this->asPlayer();
        $quest = Quest::factory()->create();

        $response = $this->getJson("api/quests/{$quest->id}");

        $response->assertStatus(200)
            ->assertJsonPath('data.campaign.id', $quest->campaignId)
            ->assertJsonPath('data.monster.id', $quest->monsterId);
    }

    public function test_returns_404_for_non_existent_quest(): void
    {
        $this->asPlayer();

        $response = $this->getJson('api/quests/00000000-0000-0000-0000-000000000000');

        $response->assertStatus(404);
    }

    public function test_returns_404_for_soft_deleted_quest(): void
    {
        $this->asPlayer();
        $quest = Quest::factory()->create();
        $quest->delete();

        $response = $this->getJson("api/quests/{$quest->id}");

        $response->assertStatus(404);
    }

    public function test_unauthenticated_user_cannot_view_quest(): void
    {
        $quest = Quest::factory()->create();

        $response = $this->getJson("api/quests/{$quest->id}");

        $response->assertStatus(401);
    }
}
