<?php

namespace Tests\Feature\Hunter;

use App\Enums\WeaponClass;
use App\Models\Campaign;
use App\Models\Hunter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HunterIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_paginated_hunters(): void
    {
        $this->asPlayer();
        Hunter::factory()->count(5)->create();

        $response = $this->getJson('api/hunters');

        $response->assertStatus(200)
            ->assertJsonCount(5, 'data')
            ->assertJsonStructure(['data', 'links', 'meta']);
    }

    public function test_pagination_respects_per_page_param(): void
    {
        $this->asPlayer();
        Hunter::factory()->count(10)->create();

        $response = $this->getJson('api/hunters?per_page=3');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data')
            ->assertJsonPath('meta.per_page', 3)
            ->assertJsonPath('meta.total', 10);
    }

    public function test_per_page_is_capped_at_100(): void
    {
        $this->asPlayer();
        Hunter::factory()->count(5)->create();

        $response = $this->getJson('api/hunters?per_page=999');

        $response->assertStatus(200)
            ->assertJsonPath('meta.per_page', 100);
    }

    public function test_filters_by_campaign_id(): void
    {
        $this->asPlayer();
        $campaign = Campaign::factory()->create();
        Hunter::factory()->count(3)->create(['campaignId' => $campaign->id]);
        Hunter::factory()->count(2)->create();

        $response = $this->getJson("api/hunters?campaignId={$campaign->id}");

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data')
            ->assertJsonPath('meta.total', 3);
    }

    public function test_filters_by_class(): void
    {
        $this->asPlayer();
        Hunter::factory()->count(3)->create(['class' => WeaponClass::Bow]);
        Hunter::factory()->count(2)->create(['class' => WeaponClass::GreatSword]);

        $response = $this->getJson('api/hunters?class=Bow');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function test_returns_empty_data_when_no_hunters_exist(): void
    {
        $this->asPlayer();

        $response = $this->getJson('api/hunters');

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    public function test_unauthenticated_user_cannot_list_hunters(): void
    {
        $response = $this->getJson('api/hunters');

        $response->assertStatus(401);
    }
}