<?php

namespace Tests\Feature\Campaign;

use App\Models\Map;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CampaignStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_creates_campaign_with_valid_data(): void
    {
        $this->asAdmin();
        $map = Map::factory()->create();

        $response = $this->postJson('api/campaigns', [
            'name' => 'Test Campaign',
            'teamName' => 'Test Team',
            'mapId' => $map->id,
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('data.name', 'Test Campaign')
            ->assertJsonPath('data.teamName', 'Test Team');

        $this->assertDatabaseHas('campaigns', [
            'name' => 'Test Campaign',
            'teamName' => 'Test Team',
            'mapId' => $map->id,
        ]);
    }

    public function test_player_can_create_campaign(): void
    {
        $this->asPlayer();
        $map = Map::factory()->create();

        $response = $this->postJson('api/campaigns', [
            'name' => 'Player Campaign',
            'teamName' => 'Player Team',
            'mapId' => $map->id,
        ]);

        $response->assertStatus(201);
    }

    public function test_returns_validation_error_when_name_missing(): void
    {
        $this->asAdmin();
        $response = $this->postJson('api/campaigns', [
            'teamName' => 'Test Team',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'CAM-0202-0001');
    }

    public function test_returns_validation_error_when_team_name_missing(): void
    {
        $this->asAdmin();
        $response = $this->postJson('api/campaigns', [
            'name' => 'Test Campaign',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'CAM-0202-0003');
    }

    public function test_returns_validation_error_when_map_id_invalid(): void
    {
        $this->asAdmin();
        $response = $this->postJson('api/campaigns', [
            'name' => 'Test Campaign',
            'teamName' => 'Test Team',
            'mapId' => 'not-a-uuid',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'CAM-0202-0005');
    }

    public function test_returns_validation_error_when_map_does_not_exist(): void
    {
        $this->asAdmin();
        $response = $this->postJson('api/campaigns', [
            'name' => 'Test Campaign',
            'teamName' => 'Test Team',
            'mapId' => '019bf2f1-70b4-70e2-abd2-83879497461b',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'CAM-0202-0006');
    }
}
