<?php

namespace Tests\Feature\Equipment;

use App\Models\Equipment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EquipmentIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_all_equipment(): void
    {
        $this->asPlayer();
        Equipment::factory()->count(5)->create();

        $response = $this->getJson('api/equipment');

        $response->assertStatus(200)
            ->assertJsonCount(5, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name', 'type', 'class', 'createdAt', 'updatedAt'],
                ],
            ]);
    }

    public function test_returns_empty_array_when_no_equipment_exists(): void
    {
        $this->asPlayer();

        $response = $this->getJson('api/equipment');

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    public function test_does_not_return_soft_deleted_equipment(): void
    {
        $this->asPlayer();
        Equipment::factory()->count(3)->create();
        $deleted = Equipment::factory()->create();
        $deleted->delete();

        $response = $this->getJson('api/equipment');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function test_unauthenticated_user_cannot_list_equipment(): void
    {
        $response = $this->getJson('api/equipment');

        $response->assertStatus(401);
    }
}
