<?php

namespace Tests\Feature\Hunter;

use App\Models\Equipment;
use App\Models\Hunter;
use App\Models\Material;
use App\Models\Weapon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HunterCraftTest extends TestCase
{
    use RefreshDatabase;

    // -------------------------------------------------------------------------
    // Happy paths
    // -------------------------------------------------------------------------

    public function test_player_can_craft_weapon_with_sufficient_materials(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create(['class' => 'Bow']);
        $weapon = Weapon::factory()->create(['class' => 'Bow']);
        $material = Material::factory()->create();

        $weapon->materials()->attach($material->id, ['quantity' => 3]);
        $hunter->loot()->attach($material->id, ['quantity' => 5]);

        $this->postJson("api/hunters/{$hunter->id}/craft", [
            'craftableType' => 'weapon',
            'craftableId' => $weapon->id,
        ])
            ->assertOk()
            ->assertJsonPath('data.id', $weapon->id);

        $this->assertDatabaseHas('inventory', [
            'hunterId' => $hunter->id,
            'inventoryable_type' => Weapon::class,
            'inventoryable_id' => $weapon->id,
        ]);
    }

    public function test_player_can_craft_equipment_with_sufficient_materials(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create(['class' => 'Bow']);
        $equipment = Equipment::factory()->create(['class' => 'Bow']);
        $material = Material::factory()->create();

        $equipment->materials()->attach($material->id, ['quantity' => 2]);
        $hunter->loot()->attach($material->id, ['quantity' => 4]);

        $this->postJson("api/hunters/{$hunter->id}/craft", [
            'craftableType' => 'equipment',
            'craftableId' => $equipment->id,
        ])
            ->assertOk()
            ->assertJsonPath('data.id', $equipment->id);

        $this->assertDatabaseHas('inventory', [
            'hunterId' => $hunter->id,
            'inventoryable_type' => Equipment::class,
            'inventoryable_id' => $equipment->id,
        ]);
    }

    public function test_crafting_deducts_quantity_when_material_is_partially_consumed(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create(['class' => 'Bow']);
        $weapon = Weapon::factory()->create(['class' => 'Bow']);
        $material = Material::factory()->create();

        $weapon->materials()->attach($material->id, ['quantity' => 3]);
        $hunter->loot()->attach($material->id, ['quantity' => 5]);

        $this->postJson("api/hunters/{$hunter->id}/craft", [
            'craftableType' => 'weapon',
            'craftableId' => $weapon->id,
        ])->assertOk();

        $this->assertDatabaseHas('loot', [
            'hunterId' => $hunter->id,
            'materialId' => $material->id,
            'quantity' => 2,
        ]);
    }

    public function test_crafting_removes_material_from_loot_when_fully_consumed(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create(['class' => 'Bow']);
        $weapon = Weapon::factory()->create(['class' => 'Bow']);
        $material = Material::factory()->create();

        $weapon->materials()->attach($material->id, ['quantity' => 3]);
        $hunter->loot()->attach($material->id, ['quantity' => 3]);

        $this->postJson("api/hunters/{$hunter->id}/craft", [
            'craftableType' => 'weapon',
            'craftableId' => $weapon->id,
        ])->assertOk();

        $this->assertDatabaseMissing('loot', [
            'hunterId' => $hunter->id,
            'materialId' => $material->id,
        ]);
    }

    public function test_crafting_same_item_twice_does_not_duplicate_inventory_entry(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create(['class' => 'Bow']);
        $weapon = Weapon::factory()->create(['class' => 'Bow']);
        $material = Material::factory()->create();

        $weapon->materials()->attach($material->id, ['quantity' => 1]);
        $hunter->loot()->attach($material->id, ['quantity' => 10]);

        $this->postJson("api/hunters/{$hunter->id}/craft", [
            'craftableType' => 'weapon',
            'craftableId' => $weapon->id,
        ])->assertOk();

        $hunter->load('loot');

        $this->postJson("api/hunters/{$hunter->id}/craft", [
            'craftableType' => 'weapon',
            'craftableId' => $weapon->id,
        ])->assertOk();

        $this->assertDatabaseCount('inventory', 1);
    }

    public function test_crafting_deducts_all_required_materials(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create(['class' => 'Bow']);
        $weapon = Weapon::factory()->create(['class' => 'Bow']);
        [$mat1, $mat2] = Material::factory()->count(2)->create();

        $weapon->materials()->attach([
            $mat1->id => ['quantity' => 2],
            $mat2->id => ['quantity' => 4],
        ]);
        $hunter->loot()->attach([
            $mat1->id => ['quantity' => 5],
            $mat2->id => ['quantity' => 4],
        ]);

        $this->postJson("api/hunters/{$hunter->id}/craft", [
            'craftableType' => 'weapon',
            'craftableId' => $weapon->id,
        ])->assertOk();

        $this->assertDatabaseHas('loot', ['hunterId' => $hunter->id, 'materialId' => $mat1->id, 'quantity' => 3]);
        $this->assertDatabaseMissing('loot', ['hunterId' => $hunter->id, 'materialId' => $mat2->id]);
    }

    // -------------------------------------------------------------------------
    // Error paths
    // -------------------------------------------------------------------------

    public function test_returns_422_when_craftable_class_does_not_match_hunter_class(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create(['class' => 'Bow']);
        $weapon = Weapon::factory()->create(['class' => 'Hammer']);
        $material = Material::factory()->create();

        $weapon->materials()->attach($material->id, ['quantity' => 1]);
        $hunter->loot()->attach($material->id, ['quantity' => 5]);

        $this->postJson("api/hunters/{$hunter->id}/craft", [
            'craftableType' => 'weapon',
            'craftableId' => $weapon->id,
        ])
            ->assertUnprocessable()
            ->assertJsonPath('code', 'HUN-0306-0003');
    }

    public function test_returns_422_when_hunter_has_insufficient_materials(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create(['class' => 'Bow']);
        $weapon = Weapon::factory()->create(['class' => 'Bow']);
        $material = Material::factory()->create();

        $weapon->materials()->attach($material->id, ['quantity' => 5]);
        $hunter->loot()->attach($material->id, ['quantity' => 2]);

        $this->postJson("api/hunters/{$hunter->id}/craft", [
            'craftableType' => 'weapon',
            'craftableId' => $weapon->id,
        ])
            ->assertUnprocessable()
            ->assertJsonPath('code', 'HUN-0306-0002')
            ->assertJsonPath('details.materialId', $material->id)
            ->assertJsonPath('details.required', 5)
            ->assertJsonPath('details.held', 2);
    }

    public function test_returns_422_when_item_has_no_recipe(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create(['class' => 'Bow']);
        $weapon = Weapon::factory()->create(['class' => 'Bow']);

        $this->postJson("api/hunters/{$hunter->id}/craft", [
            'craftableType' => 'weapon',
            'craftableId' => $weapon->id,
        ])
            ->assertUnprocessable()
            ->assertJsonPath('code', 'HUN-0306-0001');
    }

    public function test_returns_404_when_craftable_id_does_not_exist(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create(['class' => 'Bow']);

        $this->postJson("api/hunters/{$hunter->id}/craft", [
            'craftableType' => 'weapon',
            'craftableId' => '019bf2f1-70b4-70e2-abd2-83879497461b',
        ])->assertNotFound();
    }

    public function test_returns_404_when_hunter_does_not_exist(): void
    {
        $this->asPlayer();

        $this->postJson('api/hunters/019bf2f1-70b4-70e2-abd2-83879497461b/craft', [
            'craftableType' => 'weapon',
            'craftableId' => '019bf2f1-70b4-70e2-abd2-83879497461c',
        ])->assertNotFound();
    }

    public function test_returns_406_when_craftable_type_is_invalid(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create(['class' => 'Bow']);

        $this->postJson("api/hunters/{$hunter->id}/craft", [
            'craftableType' => 'potion',
            'craftableId' => '019bf2f1-70b4-70e2-abd2-83879497461b',
        ])
            ->assertStatus(406)
            ->assertJsonPath('0.code', 'HUN-0206-0003');
    }

    public function test_returns_406_when_craftable_id_is_missing(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create(['class' => 'Bow']);

        $this->postJson("api/hunters/{$hunter->id}/craft", [
            'craftableType' => 'weapon',
        ])
            ->assertStatus(406)
            ->assertJsonPath('0.code', 'HUN-0206-0004');
    }

    public function test_returns_406_when_craftable_id_is_not_a_uuid(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create(['class' => 'Bow']);

        $this->postJson("api/hunters/{$hunter->id}/craft", [
            'craftableType' => 'weapon',
            'craftableId' => 'not-a-uuid',
        ])
            ->assertStatus(406)
            ->assertJsonPath('0.code', 'HUN-0206-0005');
    }

    public function test_unauthenticated_user_cannot_craft(): void
    {
        $hunter = Hunter::factory()->create(['class' => 'Bow']);

        $this->postJson("api/hunters/{$hunter->id}/craft", [
            'craftableType' => 'weapon',
            'craftableId' => '019bf2f1-70b4-70e2-abd2-83879497461b',
        ])->assertUnauthorized();
    }

    public function test_loot_is_unchanged_after_failed_craft(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create(['class' => 'Bow']);
        $weapon = Weapon::factory()->create(['class' => 'Bow']);
        [$mat1, $mat2] = Material::factory()->count(2)->create();

        $weapon->materials()->attach([
            $mat1->id => ['quantity' => 3],
            $mat2->id => ['quantity' => 5],
        ]);
        $hunter->loot()->attach([
            $mat1->id => ['quantity' => 10], // sufficient
            $mat2->id => ['quantity' => 2],  // insufficient
        ]);

        $this->postJson("api/hunters/{$hunter->id}/craft", [
            'craftableType' => 'weapon',
            'craftableId' => $weapon->id,
        ])->assertUnprocessable();

        // mat1 must be untouched — no partial deduction before the check fails
        $this->assertDatabaseHas('loot', [
            'hunterId' => $hunter->id,
            'materialId' => $mat1->id,
            'quantity' => 10,
        ]);
    }
}
