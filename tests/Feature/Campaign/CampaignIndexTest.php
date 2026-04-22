<?php

namespace Tests\Feature\Campaign;

use App\Models\Campaign;
use App\Models\Hunter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CampaignIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_returns_all_campaigns(): void
    {
        $this->asAdmin();
        Campaign::factory()->count(5)->create();

        $response = $this->getJson('api/campaigns');

        $response->assertStatus(200)
            ->assertJsonCount(5, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name', 'teamName', 'createdAt', 'updatedAt'],
                ],
            ]);
    }

    public function test_player_returns_only_campaigns_where_they_have_a_hunter(): void
    {
        $user = $this->asPlayer();
        $myCampaign = Campaign::factory()->create();
        Campaign::factory()->count(2)->create();

        Hunter::factory()->create(['campaignId' => $myCampaign->id, 'userId' => $user->id]);

        $response = $this->getJson('api/campaigns');

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.id', $myCampaign->id);
    }

    public function test_player_returns_empty_when_they_have_no_hunters(): void
    {
        $this->asPlayer();
        Campaign::factory()->count(3)->create();

        $response = $this->getJson('api/campaigns');

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    public function test_returns_empty_array_when_no_campaigns_exist(): void
    {
        $this->asAdmin();

        $response = $this->getJson('api/campaigns');

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    public function test_includes_map_relationship_when_loaded(): void
    {
        $this->asAdmin();
        $campaign = Campaign::factory()->create();

        $response = $this->getJson('api/campaigns');

        $response->assertStatus(200)
            ->assertJsonPath('data.0.id', $campaign->id);
    }
}
