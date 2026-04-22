<?php

namespace Tests\Feature\Campaign;

use App\Models\Campaign;
use App\Models\Hunter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CampaignHunterIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_hunters_for_campaign(): void
    {
        $this->asPlayer();
        $campaign = Campaign::factory()->create();
        Hunter::factory()->count(3)->create(['campaignId' => $campaign->id]);
        Hunter::factory()->count(2)->create();

        $response = $this->getJson("api/campaigns/{$campaign->id}/hunters");

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data')
            ->assertJsonPath('meta.total', 3);
    }

    public function test_returns_empty_when_campaign_has_no_hunters(): void
    {
        $this->asPlayer();
        $campaign = Campaign::factory()->create();

        $response = $this->getJson("api/campaigns/{$campaign->id}/hunters");

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    public function test_returns_paginated_response(): void
    {
        $this->asPlayer();
        $campaign = Campaign::factory()->create();
        Hunter::factory()->count(4)->create(['campaignId' => $campaign->id]);

        $response = $this->getJson("api/campaigns/{$campaign->id}/hunters?per_page=2");

        $response->assertStatus(200)
            ->assertJsonCount(2, 'data')
            ->assertJsonPath('meta.total', 4)
            ->assertJsonStructure(['data', 'links', 'meta']);
    }

    public function test_returns_404_for_nonexistent_campaign(): void
    {
        $this->asPlayer();

        $response = $this->getJson('api/campaigns/nonexistent-id/hunters');

        $response->assertStatus(404);
    }

    public function test_unauthenticated_user_cannot_access_nested_hunters(): void
    {
        $campaign = Campaign::factory()->create();

        $response = $this->getJson("api/campaigns/{$campaign->id}/hunters");

        $response->assertStatus(401);
    }
}
