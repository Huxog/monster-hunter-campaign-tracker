<?php

namespace Tests\Feature;

use App\Models\Campaign;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CampaignIndexTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_the_campaign_index_returns_all_campaigns(): void
    {
        Campaign::factory()->count(70)->create();
        $campaignCount = Campaign::all();
        $this->getJson('api/campaings')->assertJsonCount($campaignCount->count(), 'data');
    }
}
