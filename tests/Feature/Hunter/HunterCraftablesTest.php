<?php

namespace Tests\Feature\Hunter;

use App\Models\Equipment;
use App\Models\Hunter;
use App\Models\Material;
use App\Models\Weapon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HunterCraftablesTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_weapons_and_equipment_hunter_can_craft(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create(['class' => 'Bow']);
        $weapon = Weapon::factory()->create(['class' => 'Bow']);
        $equipment = Equipment::factory()->create(['class' => 'Bow']);
        $material = Material::factory()->create();

        $weapon->materials()->attach($material->id, ['quantity' => 2]);
        $equipment->materials()->attach($material->id, ['quantity' => 3]);
        $hunter->loot()->attach($material->id, ['quantity' => 5]);

        $this->getJson("api/hunters/{$hunter->id}/craftables")
            ->assertOk()
            ->assertJsonCount(1, 'data.weapons')
            ->assertJsonCount(1, 'data.equipment')
            ->assertJsonPath('data.weapons.0.id', $weapon->id)
            ->assertJsonPath('data.equipment.0.id', $equipment->id);
    }

    public function test_excludes_items_hunter_cannot_afford(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create(['class' => 'Bow']);
        $affordable = Weapon::factory()->create(['class' => 'Bow']);
        $tooExpensive = Weapon::factory()->create(['class' => 'Bow']);
        $material = Material::factory()->create();

        $affordable->materials()->attach($material->id, ['quantity' => 2]);
        $tooExpensive->materials()->attach($material->id, ['quantity' => 10]);
        $hunter->loot()->attach($material->id, ['quantity' => 5]);

        $this->getJson("api/hunters/{$hunter->id}/craftables")
            ->assertOk()
            ->assertJsonCount(1, 'data.weapons')
            ->assertJsonPath('data.weapons.0.id', $affordable->id);
    }

    public function test_excludes_items_with_no_recipe(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create(['class' => 'Bow']);
        Weapon::factory()->create(['class' => 'Bow']);

        $this->getJson("api/hunters/{$hunter->id}/craftables")
            ->assertOk()
            ->assertJsonCount(0, 'data.weapons');
    }

    public function test_returns_empty_when_hunter_has_no_loot(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create(['class' => 'Bow']);
        $weapon = Weapon::factory()->create(['class' => 'Bow']);
        $material = Material::factory()->create();
        $weapon->materials()->attach($material->id, ['quantity' => 1]);

        $this->getJson("api/hunters/{$hunter->id}/craftables")
            ->assertOk()
            ->assertJsonCount(0, 'data.weapons')
            ->assertJsonCount(0, 'data.equipment');
    }

    public function test_requires_all_materials_to_be_affordable(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create(['class' => 'Bow']);
        $weapon = Weapon::factory()->create(['class' => 'Bow']);
        [$mat1, $mat2] = Material::factory()->count(2)->create();

        $weapon->materials()->attach([
            $mat1->id => ['quantity' => 2],
            $mat2->id => ['quantity' => 3],
        ]);
        $hunter->loot()->attach([
            $mat1->id => ['quantity' => 5],
            $mat2->id => ['quantity' => 1], // insufficient
        ]);

        $this->getJson("api/hunters/{$hunter->id}/craftables")
            ->assertOk()
            ->assertJsonCount(0, 'data.weapons');
    }

    public function test_excludes_items_of_a_different_class(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create(['class' => 'Bow']);
        $matching = Weapon::factory()->create(['class' => 'Bow']);
        $other = Weapon::factory()->create(['class' => 'Hammer']);
        $material = Material::factory()->create();

        $matching->materials()->attach($material->id, ['quantity' => 1]);
        $other->materials()->attach($material->id, ['quantity' => 1]);
        $hunter->loot()->attach($material->id, ['quantity' => 5]);

        $this->getJson("api/hunters/{$hunter->id}/craftables")
            ->assertOk()
            ->assertJsonCount(1, 'data.weapons')
            ->assertJsonPath('data.weapons.0.id', $matching->id);
    }

    public function test_excludes_items_already_in_inventory(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create(['class' => 'Bow']);
        $owned = Weapon::factory()->create(['class' => 'Bow']);
        $notOwned = Weapon::factory()->create(['class' => 'Bow']);
        $material = Material::factory()->create();

        $owned->materials()->attach($material->id, ['quantity' => 1]);
        $notOwned->materials()->attach($material->id, ['quantity' => 1]);
        $hunter->loot()->attach($material->id, ['quantity' => 5]);
        $hunter->inventoryWeapons()->syncWithoutDetaching([$owned->id]);

        $this->getJson("api/hunters/{$hunter->id}/craftables")
            ->assertOk()
            ->assertJsonCount(1, 'data.weapons')
            ->assertJsonPath('data.weapons.0.id', $notOwned->id);
    }

    public function test_returns_404_for_nonexistent_hunter(): void
    {
        $this->asPlayer();

        $this->getJson('api/hunters/019bf2f1-70b4-70e2-abd2-83879497461b/craftables')
            ->assertNotFound();
    }

    public function test_unauthenticated_user_cannot_access_craftables(): void
    {
        $hunter = Hunter::factory()->create(['class' => 'Bow']);

        $this->getJson("api/hunters/{$hunter->id}/craftables")
            ->assertUnauthorized();
    }
}
