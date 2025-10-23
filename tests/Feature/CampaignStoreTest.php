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
        Map::factory()->create();
        $this->postJson('api/campaings', [
            'name' => 'Test Campaign Name',
            'teamName' => 'Test team name',
            'mapId' => 1,
        ]);

        $this->assertDatabaseHas('campaigns', [
            'name' => 'Test Campaign Name',
            'teamName' => 'Test team name',
            'mapId' => 1,
        ]);
    }
}
