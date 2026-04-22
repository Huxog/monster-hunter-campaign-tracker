<?php

namespace Tests\Feature\Equipment;

use App\Models\Equipment;
use App\Models\Material;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EquipmentUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_updates_equipment_with_valid_data(): void
    {
        $this->asAdmin();
        $equipment = Equipment::factory()->create(['name' => 'Rathalos Helm']);

        $response = $this->putJson("api/equipment/{$equipment->id}", [
            'name' => 'Rathalos Ruby Helm',
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('data.name', 'Rathalos Ruby Helm');

        $this->assertDatabaseHas('equipment', [
            'id' => $equipment->id,
            'name' => 'Rathalos Ruby Helm',
        ]);
    }

    public function test_player_cannot_update_equipment(): void
    {
        $this->asPlayer();
        $equipment = Equipment::factory()->create();

        $response = $this->putJson("api/equipment/{$equipment->id}", [
            'name' => 'Rathalos Ruby Helm',
        ]);

        $response->assertStatus(403);
    }

    public function test_unauthenticated_user_cannot_update_equipment(): void
    {
        $equipment = Equipment::factory()->create();

        $response = $this->putJson("api/equipment/{$equipment->id}", [
            'name' => 'Rathalos Ruby Helm',
        ]);

        $response->assertStatus(401);
    }

    public function test_returns_404_for_non_existent_equipment(): void
    {
        $this->asAdmin();

        $response = $this->putJson('api/equipment/019bf2f1-70b4-70e2-abd2-83879497461b', [
            'name' => 'Rathalos Ruby Helm',
        ]);

        $response->assertStatus(404);
    }

    public function test_admin_updates_equipment_materials(): void
    {
        $this->asAdmin();
        $equipment = Equipment::factory()->create();
        $old = Material::factory()->create();
        $equipment->materials()->attach($old->id, ['quantity' => 1]);
        $new = Material::factory()->count(2)->create();

        $response = $this->putJson("api/equipment/{$equipment->id}", [
            'materials' => $new->map(fn ($m) => ['id' => $m->id, 'quantity' => 2])->all(),
        ]);

        $response->assertStatus(200)
            ->assertJsonCount(2, 'data.materials');

        $this->assertDatabaseMissing('recipes', ['materialId' => $old->id]);
    }

    public function test_omitting_materials_leaves_recipe_unchanged(): void
    {
        $this->asAdmin();
        $equipment = Equipment::factory()->create();
        $material = Material::factory()->create();
        $equipment->materials()->attach($material->id, ['quantity' => 1]);

        $response = $this->putJson("api/equipment/{$equipment->id}", [
            'name' => 'Updated Name',
        ]);

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data.materials');
    }

    public function test_returns_validation_error_when_material_id_not_found(): void
    {
        $this->asAdmin();
        $equipment = Equipment::factory()->create();

        $response = $this->putJson("api/equipment/{$equipment->id}", [
            'materials' => [['id' => '019bf2f1-70b4-70e2-abd2-83879497461b', 'quantity' => 1]],
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'EQP-0204-0009');
    }

    public function test_returns_validation_error_when_type_invalid(): void
    {
        $this->asAdmin();
        $equipment = Equipment::factory()->create();

        $response = $this->putJson("api/equipment/{$equipment->id}", [
            'type' => 'gloves',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'EQP-0204-0003');
    }

    public function test_returns_validation_error_when_class_invalid(): void
    {
        $this->asAdmin();
        $equipment = Equipment::factory()->create();

        $response = $this->putJson("api/equipment/{$equipment->id}", [
            'class' => 'Chainsaw',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'EQP-0204-0004');
    }
}
