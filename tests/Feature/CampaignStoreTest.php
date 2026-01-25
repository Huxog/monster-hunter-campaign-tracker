<?php

namespace Tests\Feature;

use App\Models\Map;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CampaignStoreTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_the_campaign_store_creates_a_campaign(): void
    {
        $map = Map::factory()->create();

        $response = $this->postJson('api/campaigns', [
            'name' => 'Test Campaign Name',
            'teamName' => 'Test team name',
            'mapId' => $map->id,
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('campaigns', [
            'name' => 'Test Campaign Name',
            'teamName' => 'Test team name',
            'mapId' => $map->id,
        ]);
    }
}
