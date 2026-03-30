<?php

namespace Tests\Feature\Equipment;

use App\Models\Equipment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EquipmentShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_single_equipment(): void
    {
        $this->asPlayer();
        $equipment = Equipment::factory()->create(['name' => 'Rathalos Helm']);

        $response = $this->getJson("api/equipment/{$equipment->id}");

        $response->assertStatus(200)
            ->assertJsonPath('data.name', 'Rathalos Helm');
    }

    public function test_returns_404_for_non_existent_equipment(): void
    {
        $this->asPlayer();

        $response = $this->getJson('api/equipment/019bf2f1-70b4-70e2-abd2-83879497461b');

        $response->assertStatus(404);
    }

    public function test_returns_404_for_soft_deleted_equipment(): void
    {
        $this->asPlayer();
        $equipment = Equipment::factory()->create();
        $equipment->delete();

        $response = $this->getJson("api/equipment/{$equipment->id}");

        $response->assertStatus(404);
    }

    public function test_unauthenticated_user_cannot_view_equipment(): void
    {
        $equipment = Equipment::factory()->create();

        $response = $this->getJson("api/equipment/{$equipment->id}");

        $response->assertStatus(401);
    }
}
