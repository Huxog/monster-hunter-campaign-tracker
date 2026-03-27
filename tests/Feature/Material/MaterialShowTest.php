<?php

namespace Tests\Feature\Material;

use App\Models\Equipment;
use App\Models\Hunter;
use App\Models\Material;
use App\Models\Weapon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MaterialShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_single_material(): void
    {
        $this->asPlayer();
        $material = Material::factory()->create(['name' => 'Rathalos Scale']);

        $response = $this->getJson("api/materials/{$material->id}");

        $response->assertStatus(200)
            ->assertJsonPath('data.id', $material->id)
            ->assertJsonPath('data.name', 'Rathalos Scale');
    }

    public function test_returns_404_for_non_existent_material(): void
    {
        $this->asPlayer();

        $response = $this->getJson('api/materials/019bf2f1-70b4-70e2-abd2-83879497461b');

        $response->assertStatus(404);
    }

    public function test_returns_404_for_soft_deleted_material(): void
    {
        $this->asPlayer();
        $material = Material::factory()->create();
        $material->delete();

        $response = $this->getJson("api/materials/{$material->id}");

        $response->assertStatus(404);
    }

    public function test_unauthenticated_user_cannot_view_material(): void
    {
        $material = Material::factory()->create();

        $response = $this->getJson("api/materials/{$material->id}");

        $response->assertStatus(401);
    }

    public function test_show_includes_hunters_that_have_this_material(): void
    {
        $this->asPlayer();
        $material = Material::factory()->create();
        $hunter = Hunter::factory()->create();
        $material->hunters()->attach($hunter->id, ['quantity' => 3]);

        $response = $this->getJson("api/materials/{$material->id}");

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data.hunters')
            ->assertJsonPath('data.hunters.0.id', $hunter->id);
    }

    public function test_show_includes_weapons_that_use_this_material(): void
    {
        $this->asPlayer();
        $material = Material::factory()->create();
        $weapon = Weapon::factory()->create();
        $material->weapons()->attach($weapon->id, ['quantity' => 2]);

        $response = $this->getJson("api/materials/{$material->id}");

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data.weapons')
            ->assertJsonPath('data.weapons.0.id', $weapon->id);
    }

    public function test_show_includes_equipment_that_uses_this_material(): void
    {
        $this->asPlayer();
        $material = Material::factory()->create();
        $equipment = Equipment::factory()->create();
        $material->equipment()->attach($equipment->id, ['quantity' => 4]);

        $response = $this->getJson("api/materials/{$material->id}");

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data.equipment')
            ->assertJsonPath('data.equipment.0.id', $equipment->id);
    }

    public function test_show_returns_empty_relations_when_material_is_unused(): void
    {
        $this->asPlayer();
        $material = Material::factory()->create();

        $response = $this->getJson("api/materials/{$material->id}");

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data.hunters')
            ->assertJsonCount(0, 'data.weapons')
            ->assertJsonCount(0, 'data.equipment');
    }
}
