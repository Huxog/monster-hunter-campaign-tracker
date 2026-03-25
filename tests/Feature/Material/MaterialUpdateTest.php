<?php

namespace Tests\Feature\Material;

use App\Models\Material;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MaterialUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_updates_material_with_valid_data(): void
    {
        $this->asAdmin();
        $material = Material::factory()->create(['name' => 'Rathalos Scale']);

        $response = $this->putJson("api/materials/{$material->id}", [
            'name' => 'Rathalos Ruby',
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('data.name', 'Rathalos Ruby');

        $this->assertDatabaseHas('materials', [
            'id' => $material->id,
            'name' => 'Rathalos Ruby',
        ]);
    }

    public function test_player_cannot_update_material(): void
    {
        $this->asPlayer();
        $material = Material::factory()->create();

        $response = $this->putJson("api/materials/{$material->id}", [
            'name' => 'Rathalos Ruby',
        ]);

        $response->assertStatus(403);
    }

    public function test_unauthenticated_user_cannot_update_material(): void
    {
        $material = Material::factory()->create();

        $response = $this->putJson("api/materials/{$material->id}", [
            'name' => 'Rathalos Ruby',
        ]);

        $response->assertStatus(401);
    }

    public function test_returns_404_for_non_existent_material(): void
    {
        $this->asAdmin();

        $response = $this->putJson('api/materials/019bf2f1-70b4-70e2-abd2-83879497461b', [
            'name' => 'Rathalos Ruby',
        ]);

        $response->assertStatus(404);
    }

    public function test_returns_validation_error_when_name_missing(): void
    {
        $this->asAdmin();
        $material = Material::factory()->create();

        $response = $this->putJson("api/materials/{$material->id}", []);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'MAT-0204-0001');
    }

    public function test_can_update_material_with_same_name(): void
    {
        $this->asAdmin();
        $material = Material::factory()->create(['name' => 'Rathalos Scale']);

        $response = $this->putJson("api/materials/{$material->id}", [
            'name' => 'Rathalos Scale',
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('data.name', 'Rathalos Scale');
    }

    public function test_returns_validation_error_when_name_already_exists(): void
    {
        $this->asAdmin();
        Material::factory()->create(['name' => 'Rathalos Scale']);
        $material = Material::factory()->create(['name' => 'Rathalos Wing']);

        $response = $this->putJson("api/materials/{$material->id}", [
            'name' => 'Rathalos Scale',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'MAT-0204-0004');
    }
}
