<?php

namespace Tests\Feature\Material;

use App\Models\Material;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MaterialStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_creates_material_with_valid_data(): void
    {
        $this->asAdmin();

        $response = $this->postJson('api/materials', [
            'name' => 'Rathalos Scale',
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('data.name', 'Rathalos Scale');

        $this->assertDatabaseHas('materials', [
            'name' => 'Rathalos Scale',
        ]);
    }

    public function test_unauthenticated_user_cannot_create_material(): void
    {
        $response = $this->postJson('api/materials', [
            'name' => 'Rathalos Scale',
        ]);

        $response->assertStatus(401);
    }

    public function test_returns_validation_error_when_name_missing(): void
    {
        $this->asAdmin();

        $response = $this->postJson('api/materials', []);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'MAT-0202-0001');
    }

    public function test_returns_validation_error_when_name_not_string(): void
    {
        $this->asAdmin();

        $response = $this->postJson('api/materials', [
            'name' => 12345,
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'MAT-0202-0002');
    }

    public function test_returns_validation_error_when_name_already_exists(): void
    {
        $this->asAdmin();
        Material::factory()->create(['name' => 'Rathalos Scale']);

        $response = $this->postJson('api/materials', [
            'name' => 'Rathalos Scale',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'MAT-0202-0004');
    }
}
