<?php

namespace Tests\Feature\Campaign;

use App\Enums\QuestOutcome;
use App\Models\Campaign;
use App\Models\Quest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CampaignQuestIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_quests_for_campaign(): void
    {
        $this->asPlayer();
        $campaign = Campaign::factory()->create();
        Quest::factory()->count(4)->create(['campaignId' => $campaign->id]);
        Quest::factory()->count(2)->create();

        $response = $this->getJson("api/campaigns/{$campaign->id}/quests");

        $response->assertStatus(200)
            ->assertJsonCount(4, 'data')
            ->assertJsonPath('meta.total', 4);
    }

    public function test_returns_empty_when_campaign_has_no_quests(): void
    {
        $this->asPlayer();
        $campaign = Campaign::factory()->create();

        $response = $this->getJson("api/campaigns/{$campaign->id}/quests");

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    public function test_filters_by_outcome_within_campaign(): void
    {
        $this->asPlayer();
        $campaign = Campaign::factory()->create();
        Quest::factory()->count(3)->create([
            'campaignId' => $campaign->id,
            'outcome' => QuestOutcome::Success,
        ]);
        Quest::factory()->count(2)->create([
            'campaignId' => $campaign->id,
            'outcome' => QuestOutcome::Failure,
        ]);

        $response = $this->getJson("api/campaigns/{$campaign->id}/quests?outcome=success");

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function test_returns_paginated_response(): void
    {
        $this->asPlayer();
        $campaign = Campaign::factory()->create();
        Quest::factory()->count(5)->create(['campaignId' => $campaign->id]);

        $response = $this->getJson("api/campaigns/{$campaign->id}/quests?per_page=2");

        $response->assertStatus(200)
            ->assertJsonCount(2, 'data')
            ->assertJsonPath('meta.total', 5)
            ->assertJsonStructure(['data', 'links', 'meta']);
    }

    public function test_returns_404_for_nonexistent_campaign(): void
    {
        $this->asPlayer();

        $response = $this->getJson('api/campaigns/nonexistent-id/quests');

        $response->assertStatus(404);
    }

    public function test_unauthenticated_user_cannot_access_nested_quests(): void
    {
        $campaign = Campaign::factory()->create();

        $response = $this->getJson("api/campaigns/{$campaign->id}/quests");

        $response->assertStatus(401);
    }
}