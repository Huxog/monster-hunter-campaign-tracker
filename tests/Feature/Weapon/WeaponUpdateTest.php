<?php

namespace Tests\Feature\Weapon;

use App\Models\Material;
use App\Models\Weapon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WeaponUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_updates_weapon_with_valid_data(): void
    {
        $this->asAdmin();
        $weapon = Weapon::factory()->create(['name' => 'Rathalos Blade']);

        $response = $this->putJson("api/weapons/{$weapon->id}", [
            'name' => 'Rathalos Ruby Blade',
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('data.name', 'Rathalos Ruby Blade');

        $this->assertDatabaseHas('weapons', [
            'id' => $weapon->id,
            'name' => 'Rathalos Ruby Blade',
        ]);
    }

    public function test_admin_updates_weapon_materials(): void
    {
        $this->asAdmin();
        $weapon = Weapon::factory()->create();
        $old = Material::factory()->create();
        $weapon->materials()->attach($old->id, ['quantity' => 1]);
        $new = Material::factory()->count(2)->create();

        $response = $this->putJson("api/weapons/{$weapon->id}", [
            'materials' => $new->map(fn ($m) => ['id' => $m->id, 'quantity' => 3])->all(),
        ]);

        $response->assertStatus(200)
            ->assertJsonCount(2, 'data.materials');

        $this->assertDatabaseMissing('recipes', ['materialId' => $old->id]);
    }

    public function test_omitting_materials_leaves_recipe_unchanged(): void
    {
        $this->asAdmin();
        $weapon = Weapon::factory()->create();
        $material = Material::factory()->create();
        $weapon->materials()->attach($material->id, ['quantity' => 1]);

        $response = $this->putJson("api/weapons/{$weapon->id}", [
            'name' => 'Updated Name',
        ]);

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data.materials');
    }

    public function test_player_cannot_update_weapon(): void
    {
        $this->asPlayer();
        $weapon = Weapon::factory()->create();

        $response = $this->putJson("api/weapons/{$weapon->id}", [
            'name' => 'Rathalos Ruby Blade',
        ]);

        $response->assertStatus(403);
    }

    public function test_unauthenticated_user_cannot_update_weapon(): void
    {
        $weapon = Weapon::factory()->create();

        $response = $this->putJson("api/weapons/{$weapon->id}", [
            'name' => 'Rathalos Ruby Blade',
        ]);

        $response->assertStatus(401);
    }

    public function test_returns_404_for_non_existent_weapon(): void
    {
        $this->asAdmin();

        $response = $this->putJson('api/weapons/019bf2f1-70b4-70e2-abd2-83879497461b', [
            'name' => 'Rathalos Ruby Blade',
        ]);

        $response->assertStatus(404);
    }

    public function test_returns_validation_error_when_class_invalid(): void
    {
        $this->asAdmin();
        $weapon = Weapon::factory()->create();

        $response = $this->putJson("api/weapons/{$weapon->id}", [
            'class' => 'Chainsaw',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'WPN-0204-0003');
    }

    public function test_returns_validation_error_when_material_id_not_found(): void
    {
        $this->asAdmin();
        $weapon = Weapon::factory()->create();

        $response = $this->putJson("api/weapons/{$weapon->id}", [
            'materials' => [['id' => '019bf2f1-70b4-70e2-abd2-83879497461b', 'quantity' => 1]],
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'WPN-0204-0007');
    }
}
