<?php

namespace Tests\Feature\Campaign;

use App\Models\Campaign;
use App\Models\Hunter;
use App\Models\Material;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CampaignLootTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_aggregated_loot_across_all_hunters(): void
    {
        $this->asPlayer();
        $campaign = Campaign::factory()->create();
        $hunterA = Hunter::factory()->create(['campaignId' => $campaign->id]);
        $hunterB = Hunter::factory()->create(['campaignId' => $campaign->id]);
        $material = Material::factory()->create();

        $hunterA->loot()->attach($material->id, ['quantity' => 3]);
        $hunterB->loot()->attach($material->id, ['quantity' => 5]);

        $this->getJson("api/campaigns/{$campaign->id}/loot")
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.id', $material->id)
            ->assertJsonPath('data.0.quantity', 8);
    }

    public function test_returns_empty_when_campaign_has_no_loot(): void
    {
        $this->asPlayer();
        $campaign = Campaign::factory()->create();

        $this->getJson("api/campaigns/{$campaign->id}/loot")
            ->assertOk()
            ->assertJsonCount(0, 'data');
    }

    public function test_excludes_loot_from_other_campaigns(): void
    {
        $this->asPlayer();
        $campaign = Campaign::factory()->create();
        $otherCampaign = Campaign::factory()->create();
        $hunter = Hunter::factory()->create(['campaignId' => $campaign->id]);
        $otherHunter = Hunter::factory()->create(['campaignId' => $otherCampaign->id]);
        $material = Material::factory()->create();

        $hunter->loot()->attach($material->id, ['quantity' => 4]);
        $otherHunter->loot()->attach($material->id, ['quantity' => 10]);

        $this->getJson("api/campaigns/{$campaign->id}/loot")
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.quantity', 4);
    }

    public function test_excludes_loot_from_soft_deleted_hunters(): void
    {
        $this->asPlayer();
        $campaign = Campaign::factory()->create();
        $hunter = Hunter::factory()->create(['campaignId' => $campaign->id]);
        $deletedHunter = Hunter::factory()->create(['campaignId' => $campaign->id]);
        $material = Material::factory()->create();

        $hunter->loot()->attach($material->id, ['quantity' => 2]);
        $deletedHunter->loot()->attach($material->id, ['quantity' => 99]);
        $deletedHunter->delete();

        $this->getJson("api/campaigns/{$campaign->id}/loot")
            ->assertOk()
            ->assertJsonPath('data.0.quantity', 2);
    }

    public function test_returns_404_for_nonexistent_campaign(): void
    {
        $this->asPlayer();

        $this->getJson('api/campaigns/nonexistent-id/loot')
            ->assertNotFound();
    }

    public function test_unauthenticated_user_cannot_access_campaign_loot(): void
    {
        $campaign = Campaign::factory()->create();

        $this->getJson("api/campaigns/{$campaign->id}/loot")
            ->assertUnauthorized();
    }
}
