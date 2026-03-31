<?php

namespace Tests\Feature\Hunter;

use App\Models\Hunter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HunterUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_player_can_update_hunter_name(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create(['hunterName' => 'OldName']);

        $this->putJson("api/hunters/{$hunter->id}", ['hunterName' => 'NewName'])
            ->assertOk()
            ->assertJsonPath('data.hunterName', 'NewName');
    }

    public function test_unauthenticated_user_cannot_update_hunter(): void
    {
        $hunter = Hunter::factory()->create();

        $this->putJson("api/hunters/{$hunter->id}", ['hunterName' => 'NewName'])
            ->assertUnauthorized();
    }

    public function test_campaign_id_is_ignored_on_update(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create();
        $originalCampaignId = $hunter->campaignId;

        $this->putJson("api/hunters/{$hunter->id}", [
            'hunterName' => 'NewName',
            'campaignId' => '019bf2f1-70b4-70e2-abd2-83879497461b',
        ])->assertOk();

        $this->assertDatabaseHas('hunters', [
            'id' => $hunter->id,
            'campaignId' => $originalCampaignId,
        ]);
    }

    public function test_returns_404_for_non_existent_hunter(): void
    {
        $this->asPlayer();

        $this->putJson('api/hunters/019bf2f1-70b4-70e2-abd2-83879497461b', [
            'hunterName' => 'NewName',
        ])->assertNotFound();
    }

    public function test_returns_406_when_hunter_name_not_string(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create();

        $this->putJson("api/hunters/{$hunter->id}", ['hunterName' => 12345])
            ->assertStatus(406)
            ->assertJsonPath('0.code', 'HUN-0204-0003');
    }
}
