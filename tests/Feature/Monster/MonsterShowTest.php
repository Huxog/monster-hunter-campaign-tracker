<?php

namespace Tests\Feature\Monster;

use App\Models\Material;
use App\Models\Monster;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MonsterShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_single_monster(): void
    {
        $this->asPlayer();
        $monster = Monster::factory()->create([
            'name' => 'Rathalos',
            'stars' => 5,
        ]);

        $response = $this->getJson("api/monsters/{$monster->id}");

        $response->assertStatus(200)
            ->assertJsonPath('data.name', 'Rathalos')
            ->assertJsonPath('data.stars', 5)
            ->assertJsonStructure([
                'data' => ['id', 'name', 'description', 'stars', 'elementalWeaknesses', 'ailmentWeaknesses', 'imagePath', 'materials', 'createdAt', 'updatedAt'],
            ]);
    }

    public function test_returns_monster_with_materials(): void
    {
        $this->asPlayer();
        $monster = Monster::factory()->create();
        $materials = Material::factory()->count(3)->create();
        $monster->materials()->sync($materials->pluck('id'));

        $response = $this->getJson("api/monsters/{$monster->id}");

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data.materials');
    }

    public function test_returns_404_for_non_existent_monster(): void
    {
        $this->asPlayer();

        $response = $this->getJson('api/monsters/non-existent-id');

        $response->assertStatus(404);
    }

    public function test_returns_404_for_soft_deleted_monster(): void
    {
        $this->asPlayer();
        $monster = Monster::factory()->create();
        $monster->delete();

        $response = $this->getJson("api/monsters/{$monster->id}");

        $response->assertStatus(404);
    }

    public function test_unauthenticated_user_cannot_view_monster(): void
    {
        $monster = Monster::factory()->create();

        $response = $this->getJson("api/monsters/{$monster->id}");

        $response->assertStatus(401);
    }
}
