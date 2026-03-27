<?php

namespace Tests\Feature\Material;

use App\Models\Material;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MaterialDestroyTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_soft_deletes_material(): void
    {
        $this->asAdmin();
        $material = Material::factory()->create();

        $response = $this->deleteJson("api/materials/{$material->id}");

        $response->assertStatus(200);

        $this->assertSoftDeleted('materials', [
            'id' => $material->id,
        ]);
    }

    public function test_deleted_material_not_in_index(): void
    {
        $this->asAdmin();
        $material = Material::factory()->create();
        $material->delete();

        $response = $this->getJson('api/materials');

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    public function test_unauthenticated_user_cannot_delete_material(): void
    {
        $material = Material::factory()->create();

        $response = $this->deleteJson("api/materials/{$material->id}");

        $response->assertStatus(401);
    }

    public function test_returns_404_for_non_existent_material(): void
    {
        $this->asAdmin();

        $response = $this->deleteJson('api/materials/019bf2f1-70b4-70e2-abd2-83879497461b');

        $response->assertStatus(404);
    }

    public function test_returns_404_for_already_deleted_material(): void
    {
        $this->asAdmin();
        $material = Material::factory()->create();
        $material->delete();

        $response = $this->deleteJson("api/materials/{$material->id}");

        $response->assertStatus(404);
    }
}
