<?php

namespace Tests\Feature\Campaign;

use App\Models\Campaign;
use App\Models\Map;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CampaignUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_updates_campaign_with_valid_data(): void
    {
        $this->asAdmin();
        $campaign = Campaign::factory()->create([
            'name' => 'Old Name',
            'teamName' => 'Old Team',
        ]);

        $response = $this->putJson("api/campaigns/{$campaign->id}", [
            'name' => 'New Name',
            'teamName' => 'New Team',
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('data.name', 'New Name')
            ->assertJsonPath('data.teamName', 'New Team');

        $this->assertDatabaseHas('campaigns', [
            'id' => $campaign->id,
            'name' => 'New Name',
            'teamName' => 'New Team',
        ]);
    }

    public function test_updates_campaign_map(): void
    {
        $this->asAdmin();
        $campaign = Campaign::factory()->create();
        $newMap = Map::factory()->create();

        $response = $this->putJson("api/campaigns/{$campaign->id}", [
            'name' => $campaign->name,
            'teamName' => $campaign->teamName,
            'mapId' => $newMap->id,
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('data.mapId', $newMap->id);
    }

    public function test_player_can_update_campaign(): void
    {
        $this->asPlayer();
        $campaign = Campaign::factory()->create();

        $response = $this->putJson("api/campaigns/{$campaign->id}", [
            'name' => 'Updated Name',
            'teamName' => 'Updated Team',
        ]);

        $response->assertStatus(200);
    }

    public function test_returns_404_for_non_existent_campaign(): void
    {
        $this->asAdmin();
        $response = $this->putJson('api/campaigns/019bf2f1-70b4-70e2-abd2-83879497461b', [
            'name' => 'Test',
            'teamName' => 'Test',
        ]);

        $response->assertStatus(404);
    }

    public function test_returns_validation_error_when_name_missing(): void
    {
        $this->asAdmin();
        $campaign = Campaign::factory()->create();

        $response = $this->putJson("api/campaigns/{$campaign->id}", [
            'teamName' => 'Test Team',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'CAM-0204-0001');
    }

    public function test_returns_validation_error_for_invalid_map_id(): void
    {
        $this->asAdmin();
        $campaign = Campaign::factory()->create();

        $response = $this->putJson("api/campaigns/{$campaign->id}", [
            'name' => 'Test',
            'teamName' => 'Test',
            'mapId' => 'invalid-uuid',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'CAM-0204-0005');
    }
}
