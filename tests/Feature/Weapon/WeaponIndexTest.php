<?php

namespace Tests\Feature\Weapon;

use App\Models\Material;
use App\Models\Weapon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WeaponIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_all_weapons(): void
    {
        $this->asPlayer();
        Weapon::factory()->count(5)->create();

        $response = $this->getJson('api/weapons');

        $response->assertStatus(200)
            ->assertJsonCount(5, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name', 'class', 'element', 'damage', 'materials', 'createdAt', 'updatedAt'],
                ],
            ]);
    }

    public function test_returns_materials_for_each_weapon(): void
    {
        $this->asPlayer();
        $weapon = Weapon::factory()->create();
        $materials = Material::factory()->count(2)->create();
        $weapon->materials()->attach($materials->pluck('id'), ['quantity' => 1]);

        $response = $this->getJson('api/weapons');

        $response->assertStatus(200)
            ->assertJsonCount(2, 'data.0.materials');
    }

    public function test_returns_empty_array_when_no_weapons_exist(): void
    {
        $this->asPlayer();

        $response = $this->getJson('api/weapons');

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    public function test_does_not_return_soft_deleted_weapons(): void
    {
        $this->asPlayer();
        Weapon::factory()->count(3)->create();
        $deleted = Weapon::factory()->create();
        $deleted->delete();

        $response = $this->getJson('api/weapons');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function test_unauthenticated_user_cannot_list_weapons(): void
    {
        $response = $this->getJson('api/weapons');

        $response->assertStatus(401);
    }
}
