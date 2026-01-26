<?php

namespace Tests\Feature\Campaign;

use App\Models\Campaign;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CampaignIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_all_campaigns(): void
    {
        Campaign::factory()->count(5)->create();

        $response = $this->getJson('api/campaigns');

        $response->assertStatus(200)
            ->assertJsonCount(5, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name', 'teamName', 'createdAt', 'updatedAt']
                ]
            ]);
    }

    public function test_returns_empty_array_when_no_campaigns_exist(): void
    {
        $response = $this->getJson('api/campaigns');

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    public function test_includes_map_relationship_when_loaded(): void
    {
        $campaign = Campaign::factory()->create();

        $response = $this->getJson('api/campaigns');

        $response->assertStatus(200)
            ->assertJsonPath('data.0.id', $campaign->id);
    }
}