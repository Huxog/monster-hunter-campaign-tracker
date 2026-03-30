<?php

namespace Tests\Feature\Equipment;

use App\Models\Equipment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EquipmentDestroyTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_soft_deletes_equipment(): void
    {
        $this->asAdmin();
        $equipment = Equipment::factory()->create();

        $response = $this->deleteJson("api/equipment/{$equipment->id}");

        $response->assertStatus(200);

        $this->assertSoftDeleted('equipment', [
            'id' => $equipment->id,
        ]);
    }

    public function test_deleted_equipment_not_in_index(): void
    {
        $this->asAdmin();
        $equipment = Equipment::factory()->create();
        $equipment->delete();

        $response = $this->getJson('api/equipment');

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    public function test_player_cannot_delete_equipment(): void
    {
        $this->asPlayer();
        $equipment = Equipment::factory()->create();

        $response = $this->deleteJson("api/equipment/{$equipment->id}");

        $response->assertStatus(403);
    }

    public function test_unauthenticated_user_cannot_delete_equipment(): void
    {
        $equipment = Equipment::factory()->create();

        $response = $this->deleteJson("api/equipment/{$equipment->id}");

        $response->assertStatus(401);
    }

    public function test_returns_404_for_non_existent_equipment(): void
    {
        $this->asAdmin();

        $response = $this->deleteJson('api/equipment/019bf2f1-70b4-70e2-abd2-83879497461b');

        $response->assertStatus(404);
    }

    public function test_returns_404_for_already_deleted_equipment(): void
    {
        $this->asAdmin();
        $equipment = Equipment::factory()->create();
        $equipment->delete();

        $response = $this->deleteJson("api/equipment/{$equipment->id}");

        $response->assertStatus(404);
    }
}
