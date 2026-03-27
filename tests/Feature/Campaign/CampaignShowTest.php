<?php

namespace Tests\Feature\Campaign;

use App\Models\Campaign;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CampaignShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_single_campaign(): void
    {
        $this->asPlayer();
        $campaign = Campaign::factory()->create([
            'name' => 'My Campaign',
            'teamName' => 'My Team',
        ]);

        $response = $this->getJson("api/campaigns/{$campaign->id}");

        $response->assertStatus(200)
            ->assertJsonPath('data.id', $campaign->id)
            ->assertJsonPath('data.name', 'My Campaign')
            ->assertJsonPath('data.teamName', 'My Team');
    }

    public function test_returns_404_for_non_existent_campaign(): void
    {
        $this->asPlayer();
        $response = $this->getJson('api/campaigns/019bf2f1-70b4-70e2-abd2-83879497461b');

        $response->assertStatus(404)
            ->assertJsonPath('code', 'RES-0200-0001');
    }

    public function test_returns_404_for_soft_deleted_campaign(): void
    {
        $this->asPlayer();
        $campaign = Campaign::factory()->create();
        $campaign->delete();

        $response = $this->getJson("api/campaigns/{$campaign->id}");

        $response->assertStatus(404);
    }
}
