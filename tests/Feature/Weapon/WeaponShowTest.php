<?php

namespace Tests\Feature\Weapon;

use App\Models\Material;
use App\Models\Weapon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WeaponShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_single_weapon(): void
    {
        $this->asPlayer();
        $weapon = Weapon::factory()->create(['name' => 'Rathalos Sword']);

        $response = $this->getJson("api/weapons/{$weapon->id}");

        $response->assertStatus(200)
            ->assertJsonPath('data.name', 'Rathalos Sword');
    }

    public function test_returns_materials_for_weapon(): void
    {
        $this->asPlayer();
        $weapon = Weapon::factory()->create();
        $materials = Material::factory()->count(3)->create();
        $weapon->materials()->attach($materials->pluck('id'), ['quantity' => 2]);

        $response = $this->getJson("api/weapons/{$weapon->id}");

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data.materials');
    }

    public function test_returns_empty_materials_when_weapon_has_none(): void
    {
        $this->asPlayer();
        $weapon = Weapon::factory()->create();

        $response = $this->getJson("api/weapons/{$weapon->id}");

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data.materials');
    }

    public function test_returns_404_for_non_existent_weapon(): void
    {
        $this->asPlayer();

        $response = $this->getJson('api/weapons/019bf2f1-70b4-70e2-abd2-83879497461b');

        $response->assertStatus(404);
    }

    public function test_returns_404_for_soft_deleted_weapon(): void
    {
        $this->asPlayer();
        $weapon = Weapon::factory()->create();
        $weapon->delete();

        $response = $this->getJson("api/weapons/{$weapon->id}");

        $response->assertStatus(404);
    }

    public function test_unauthenticated_user_cannot_view_weapon(): void
    {
        $weapon = Weapon::factory()->create();

        $response = $this->getJson("api/weapons/{$weapon->id}");

        $response->assertStatus(401);
    }
}
