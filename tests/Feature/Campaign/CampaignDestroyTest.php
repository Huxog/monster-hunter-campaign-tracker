<?php

namespace Tests\Feature\Campaign;

use App\Models\Campaign;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CampaignDestroyTest extends TestCase
{
    use RefreshDatabase;

    public function test_soft_deletes_campaign(): void
    {
        $campaign = Campaign::factory()->create();

        $response = $this->deleteJson("api/campaigns/{$campaign->id}");

        $response->assertStatus(200);

        $this->assertSoftDeleted('campaigns', [
            'id' => $campaign->id,
        ]);
    }

    public function test_deleted_campaign_not_in_index(): void
    {
        $campaign = Campaign::factory()->create();
        $campaign->delete();

        $response = $this->getJson('api/campaigns');

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    public function test_returns_404_for_non_existent_campaign(): void
    {
        $response = $this->deleteJson('api/campaigns/019bf2f1-70b4-70e2-abd2-83879497461b');

        $response->assertStatus(404);
    }

    public function test_returns_404_for_already_deleted_campaign(): void
    {
        $campaign = Campaign::factory()->create();
        $campaign->delete();

        $response = $this->deleteJson("api/campaigns/{$campaign->id}");

        $response->assertStatus(404);
    }
}