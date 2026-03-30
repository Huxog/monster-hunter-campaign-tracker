<?php

namespace Tests\Feature\Monster;

use App\Models\Material;
use App\Models\Monster;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MonsterUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_updates_monster_with_valid_data(): void
    {
        $this->asAdmin();
        $monster = Monster::factory()->create(['name' => 'Rathalos', 'stars' => 3]);

        $response = $this->putJson("api/monsters/{$monster->id}", [
            'name' => 'Azure Rathalos',
            'stars' => 6,
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('data.name', 'Azure Rathalos')
            ->assertJsonPath('data.stars', 6);

        $this->assertDatabaseHas('monsters', [
            'id' => $monster->id,
            'name' => 'Azure Rathalos',
        ]);
    }

    public function test_admin_updates_monster_materials(): void
    {
        $this->asAdmin();
        $monster = Monster::factory()->create();
        $oldMaterials = Material::factory()->count(2)->create();
        $monster->materials()->sync($oldMaterials->pluck('id'));

        $newMaterials = Material::factory()->count(3)->create();

        $response = $this->putJson("api/monsters/{$monster->id}", [
            'materials' => $newMaterials->pluck('id')->toArray(),
        ]);

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data.materials');

        $this->assertCount(3, $monster->fresh()->materials);
    }

    public function test_player_cannot_update_monster(): void
    {
        $this->asPlayer();
        $monster = Monster::factory()->create();

        $response = $this->putJson("api/monsters/{$monster->id}", ['name' => 'Nargacuga']);

        $response->assertStatus(403);
    }

    public function test_unauthenticated_user_cannot_update_monster(): void
    {
        $monster = Monster::factory()->create();

        $response = $this->putJson("api/monsters/{$monster->id}", ['name' => 'Nargacuga']);

        $response->assertStatus(401);
    }

    public function test_returns_404_for_non_existent_monster(): void
    {
        $this->asAdmin();

        $response = $this->putJson('api/monsters/non-existent-id', ['name' => 'Nargacuga']);

        $response->assertStatus(404);
    }

    public function test_returns_validation_error_when_stars_out_of_range(): void
    {
        $this->asAdmin();
        $monster = Monster::factory()->create();

        $response = $this->putJson("api/monsters/{$monster->id}", ['stars' => 0]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'MON-0204-0004');
    }

    public function test_returns_validation_error_when_material_not_found(): void
    {
        $this->asAdmin();
        $monster = Monster::factory()->create();

        $response = $this->putJson("api/monsters/{$monster->id}", [
            'materials' => ['00000000-0000-0000-0000-000000000000'],
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'MON-0204-0011');
    }
}
