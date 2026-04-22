<?php

namespace Tests\Feature\Quest;

use App\Models\Campaign;
use App\Models\Hunter;
use App\Models\Monster;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuestStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_creates_quest_with_valid_data(): void
    {
        $this->asAdmin();
        $campaign = Campaign::factory()->create();
        $monster = Monster::factory()->create();
        $hunters = Hunter::factory()->count(2)->create(['campaignId' => $campaign->id]);

        $response = $this->postJson('api/quests', [
            'campaignId' => $campaign->id,
            'monsterId' => $monster->id,
            'hunterIds' => $hunters->pluck('id')->toArray(),
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('data.campaignId', $campaign->id)
            ->assertJsonPath('data.monsterId', $monster->id)
            ->assertJsonCount(2, 'data.hunters');

        $this->assertDatabaseHas('quests', ['campaignId' => $campaign->id, 'monsterId' => $monster->id]);
    }

    public function test_admin_creates_completed_quest(): void
    {
        $this->asAdmin();
        $campaign = Campaign::factory()->create();
        $monster = Monster::factory()->create();
        $hunter = Hunter::factory()->create(['campaignId' => $campaign->id]);

        $response = $this->postJson('api/quests', [
            'campaignId' => $campaign->id,
            'monsterId' => $monster->id,
            'hunterIds' => [$hunter->id],
            'outcome' => 'success',
            'completedAt' => '2026-03-29T20:00:00Z',
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('data.outcome', 'success');
    }

    public function test_player_can_create_quest(): void
    {
        $this->asPlayer();
        $campaign = Campaign::factory()->create();
        $monster = Monster::factory()->create();
        $hunter = Hunter::factory()->create(['campaignId' => $campaign->id]);

        $response = $this->postJson('api/quests', [
            'campaignId' => $campaign->id,
            'monsterId' => $monster->id,
            'hunterIds' => [$hunter->id],
        ]);

        $response->assertStatus(201);
    }

    public function test_unauthenticated_user_cannot_create_quest(): void
    {
        $response = $this->postJson('api/quests', [
            'campaignId' => '00000000-0000-0000-0000-000000000000',
            'monsterId' => '00000000-0000-0000-0000-000000000000',
            'hunterIds' => [],
        ]);

        $response->assertStatus(401);
    }

    public function test_returns_validation_error_when_campaign_id_missing(): void
    {
        $this->asAdmin();
        $monster = Monster::factory()->create();

        $response = $this->postJson('api/quests', [
            'monsterId' => $monster->id,
            'hunterIds' => [],
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'QST-0202-0001');
    }

    public function test_returns_validation_error_when_campaign_not_found(): void
    {
        $this->asAdmin();
        $monster = Monster::factory()->create();

        $response = $this->postJson('api/quests', [
            'campaignId' => '00000000-0000-0000-0000-000000000000',
            'monsterId' => $monster->id,
            'hunterIds' => [],
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'QST-0202-0003');
    }

    public function test_returns_validation_error_when_monster_not_found(): void
    {
        $this->asAdmin();
        $campaign = Campaign::factory()->create();

        $response = $this->postJson('api/quests', [
            'campaignId' => $campaign->id,
            'monsterId' => '00000000-0000-0000-0000-000000000000',
            'hunterIds' => [],
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'QST-0202-0006');
    }

    public function test_returns_validation_error_when_hunter_not_in_campaign(): void
    {
        $this->asAdmin();
        $campaign = Campaign::factory()->create();
        $monster = Monster::factory()->create();
        $hunterFromOtherCampaign = Hunter::factory()->create();

        $response = $this->postJson('api/quests', [
            'campaignId' => $campaign->id,
            'monsterId' => $monster->id,
            'hunterIds' => [$hunterFromOtherCampaign->id],
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'QST-0202-0010');
    }

    public function test_returns_validation_error_when_outcome_is_invalid(): void
    {
        $this->asAdmin();
        $campaign = Campaign::factory()->create();
        $monster = Monster::factory()->create();
        $hunter = Hunter::factory()->create(['campaignId' => $campaign->id]);

        $response = $this->postJson('api/quests', [
            'campaignId' => $campaign->id,
            'monsterId' => $monster->id,
            'hunterIds' => [$hunter->id],
            'outcome' => 'victory',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'QST-0202-0011');
    }
}
