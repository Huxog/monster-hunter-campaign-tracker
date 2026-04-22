<?php

namespace Tests\Feature\Weapon;

use App\Models\Material;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WeaponStoreTest extends TestCase
{
    use RefreshDatabase;

    private function basePayload(): array
    {
        return [
            'name' => 'Rathalos Blade',
            'class' => 'Great Sword',
            'element' => 'Fire',
            'damage' => ['0' => 5, '1' => 6, '2' => 7, '3' => 8, '4' => 9],
        ];
    }

    public function test_admin_creates_weapon_with_valid_data(): void
    {
        $this->asAdmin();

        $response = $this->postJson('api/weapons', $this->basePayload());

        $response->assertStatus(201)
            ->assertJsonPath('data.name', 'Rathalos Blade');

        $this->assertDatabaseHas('weapons', ['name' => 'Rathalos Blade']);
    }

    public function test_admin_creates_weapon_with_materials(): void
    {
        $this->asAdmin();
        $materials = Material::factory()->count(3)->create();

        $response = $this->postJson('api/weapons', array_merge($this->basePayload(), [
            'materials' => $materials->map(fn ($m) => ['id' => $m->id, 'quantity' => 2])->all(),
        ]));

        $response->assertStatus(201)
            ->assertJsonCount(3, 'data.materials');
    }

    public function test_player_cannot_create_weapon(): void
    {
        $this->asPlayer();

        $response = $this->postJson('api/weapons', $this->basePayload());

        $response->assertStatus(403);
    }

    public function test_unauthenticated_user_cannot_create_weapon(): void
    {
        $response = $this->postJson('api/weapons', $this->basePayload());

        $response->assertStatus(401);
    }

    public function test_returns_validation_error_when_name_missing(): void
    {
        $this->asAdmin();

        $response = $this->postJson('api/weapons', [
            'class' => 'Great Sword',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'WPN-0202-0001');
    }

    public function test_returns_validation_error_when_class_missing(): void
    {
        $this->asAdmin();

        $response = $this->postJson('api/weapons', [
            'name' => 'Rathalos Blade',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'WPN-0202-0004');
    }

    public function test_returns_validation_error_when_class_invalid(): void
    {
        $this->asAdmin();

        $response = $this->postJson('api/weapons', [
            'name' => 'Rathalos Blade',
            'class' => 'Chainsaw',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'WPN-0202-0005');
    }

    public function test_returns_validation_error_when_material_id_not_found(): void
    {
        $this->asAdmin();

        $response = $this->postJson('api/weapons', array_merge($this->basePayload(), [
            'materials' => [['id' => '019bf2f1-70b4-70e2-abd2-83879497461b', 'quantity' => 1]],
        ]));

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'WPN-0202-0009');
    }

    public function test_returns_validation_error_when_material_quantity_missing(): void
    {
        $this->asAdmin();
        $material = Material::factory()->create();

        $response = $this->postJson('api/weapons', array_merge($this->basePayload(), [
            'materials' => [['id' => $material->id]],
        ]));

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'WPN-0202-0010');
    }
}
