<?php

namespace Tests\Feature\Hunter;

use App\Models\Campaign;
use App\Models\Hunter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HunterStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_player_can_create_hunter(): void
    {
        $this->asPlayer();
        $campaign = Campaign::factory()->create();

        $this->postJson('api/hunters', [
            'playerName' => 'John Doe',
            'hunterName' => 'Artian',
            'campaignId' => $campaign->id,
        ])
            ->assertStatus(201)
            ->assertJsonPath('data.hunterName', 'Artian');

        $this->assertDatabaseHas('hunters', [
            'hunterName' => 'Artian',
            'campaignId' => $campaign->id,
        ]);
    }

    public function test_unauthenticated_user_cannot_create_hunter(): void
    {
        $campaign = Campaign::factory()->create();

        $this->postJson('api/hunters', [
            'playerName' => 'John Doe',
            'hunterName' => 'Artian',
            'campaignId' => $campaign->id,
        ])->assertUnauthorized();
    }

    public function test_cannot_create_fifth_hunter_in_campaign(): void
    {
        $this->asPlayer();
        $campaign = Campaign::factory()->create();
        Hunter::factory()->count(4)->create(['campaignId' => $campaign->id]);

        $this->postJson('api/hunters', [
            'playerName' => 'John Doe',
            'hunterName' => 'Artian',
            'campaignId' => $campaign->id,
        ])
            ->assertUnprocessable()
            ->assertJsonPath('code', 'HUN-0306-0003');
    }

    public function test_can_create_fourth_hunter_in_campaign(): void
    {
        $this->asPlayer();
        $campaign = Campaign::factory()->create();
        Hunter::factory()->count(3)->create(['campaignId' => $campaign->id]);

        $this->postJson('api/hunters', [
            'playerName' => 'John Doe',
            'hunterName' => 'Artian',
            'campaignId' => $campaign->id,
        ])->assertStatus(201);
    }

    public function test_hunter_limit_is_per_campaign(): void
    {
        $this->asPlayer();
        $campaignA = Campaign::factory()->create();
        $campaignB = Campaign::factory()->create();
        Hunter::factory()->count(4)->create(['campaignId' => $campaignA->id]);

        $this->postJson('api/hunters', [
            'playerName' => 'John Doe',
            'hunterName' => 'Artian',
            'campaignId' => $campaignB->id,
        ])->assertStatus(201);
    }

    public function test_returns_406_when_player_name_missing(): void
    {
        $this->asPlayer();
        $campaign = Campaign::factory()->create();

        $this->postJson('api/hunters', [
            'hunterName' => 'Artian',
            'campaignId' => $campaign->id,
        ])
            ->assertStatus(406)
            ->assertJsonPath('0.code', 'HUN-0202-0001');
    }

    public function test_returns_406_when_campaign_id_missing(): void
    {
        $this->asPlayer();

        $this->postJson('api/hunters', [
            'playerName' => 'John Doe',
            'hunterName' => 'Artian',
        ])
            ->assertStatus(406)
            ->assertJsonPath('0.code', 'HUN-0202-0007');
    }

    public function test_returns_406_when_campaign_does_not_exist(): void
    {
        $this->asPlayer();

        $this->postJson('api/hunters', [
            'playerName' => 'John Doe',
            'hunterName' => 'Artian',
            'campaignId' => '019bf2f1-70b4-70e2-abd2-83879497461b',
        ])
            ->assertStatus(406)
            ->assertJsonPath('0.code', 'HUN-0202-0009');
    }
}
