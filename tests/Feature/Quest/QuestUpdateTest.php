<?php

namespace Tests\Feature\Quest;

use App\Models\Hunter;
use App\Models\Monster;
use App\Models\Quest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuestUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_updates_quest_outcome(): void
    {
        $this->asAdmin();
        $quest = Quest::factory()->inProgress()->create();

        $response = $this->putJson("api/quests/{$quest->id}", [
            'outcome' => 'success',
            'completedAt' => '2026-03-29T20:00:00Z',
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('data.outcome', 'success');

        $this->assertDatabaseHas('quests', ['id' => $quest->id, 'outcome' => 'success']);
    }

    public function test_admin_updates_quest_hunters(): void
    {
        $this->asAdmin();
        $quest = Quest::factory()->create();
        $oldHunters = Hunter::factory()->count(2)->create(['campaignId' => $quest->campaignId]);
        $quest->hunters()->sync($oldHunters->pluck('id'));

        $newHunters = Hunter::factory()->count(3)->create(['campaignId' => $quest->campaignId]);

        $response = $this->putJson("api/quests/{$quest->id}", [
            'hunterIds' => $newHunters->pluck('id')->toArray(),
        ]);

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data.hunters');

        $this->assertCount(3, $quest->fresh()->hunters);
    }

    public function test_admin_updates_quest_monster(): void
    {
        $this->asAdmin();
        $quest = Quest::factory()->create();
        $newMonster = Monster::factory()->create();

        $response = $this->putJson("api/quests/{$quest->id}", [
            'monsterId' => $newMonster->id,
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('data.monsterId', $newMonster->id);
    }

    public function test_player_can_update_quest(): void
    {
        $this->asPlayer();
        $quest = Quest::factory()->inProgress()->create();

        $response = $this->putJson("api/quests/{$quest->id}", [
            'outcome' => 'success',
            'completedAt' => '2026-03-29T20:00:00Z',
        ]);

        $response->assertStatus(200);
    }

    public function test_unauthenticated_user_cannot_update_quest(): void
    {
        $quest = Quest::factory()->create();

        $response = $this->putJson("api/quests/{$quest->id}", ['outcome' => 'success']);

        $response->assertStatus(401);
    }

    public function test_returns_404_for_non_existent_quest(): void
    {
        $this->asAdmin();

        $response = $this->putJson('api/quests/00000000-0000-0000-0000-000000000000', ['outcome' => 'success']);

        $response->assertStatus(404);
    }

    public function test_returns_validation_error_when_outcome_is_invalid(): void
    {
        $this->asAdmin();
        $quest = Quest::factory()->create();

        $response = $this->putJson("api/quests/{$quest->id}", ['outcome' => 'victory']);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'QST-0204-0008');
    }

    public function test_returns_validation_error_when_hunter_not_in_campaign(): void
    {
        $this->asAdmin();
        $quest = Quest::factory()->create();
        $hunterFromOtherCampaign = Hunter::factory()->create();

        $response = $this->putJson("api/quests/{$quest->id}", [
            'hunterIds' => [$hunterFromOtherCampaign->id],
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'QST-0204-0007');
    }
}
