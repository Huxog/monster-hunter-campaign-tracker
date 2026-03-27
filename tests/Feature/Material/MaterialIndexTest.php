<?php

namespace Tests\Feature\Material;

use App\Models\Material;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MaterialIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_all_materials(): void
    {
        $this->asPlayer();
        Material::factory()->count(5)->create();

        $response = $this->getJson('api/materials');

        $response->assertStatus(200)
            ->assertJsonCount(5, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name', 'createdAt', 'updatedAt'],
                ],
            ]);
    }

    public function test_returns_empty_array_when_no_materials_exist(): void
    {
        $this->asPlayer();

        $response = $this->getJson('api/materials');

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    public function test_does_not_return_soft_deleted_materials(): void
    {
        $this->asPlayer();
        Material::factory()->count(3)->create();
        $deleted = Material::factory()->create();
        $deleted->delete();

        $response = $this->getJson('api/materials');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function test_unauthenticated_user_cannot_list_materials(): void
    {
        $response = $this->getJson('api/materials');

        $response->assertStatus(401);
    }
}
