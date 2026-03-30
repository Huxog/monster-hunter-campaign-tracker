<?php

namespace Tests\Feature\Monster;

use App\Models\Material;
use App\Models\Monster;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MonsterStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_creates_monster_with_valid_data(): void
    {
        $this->asAdmin();

        $response = $this->postJson('api/monsters', [
            'name' => 'Rathalos',
            'description' => 'The King of the Skies.',
            'stars' => 5,
            'elementalWeaknesses' => ['Fire' => 0, 'Thunder' => 3],
            'ailmentWeaknesses' => ['Poison' => 2, 'Sleep' => 1],
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('data.name', 'Rathalos')
            ->assertJsonPath('data.stars', 5);

        $this->assertDatabaseHas('monsters', ['name' => 'Rathalos']);
    }

    public function test_admin_creates_monster_with_materials(): void
    {
        $this->asAdmin();
        $materials = Material::factory()->count(3)->create();

        $response = $this->postJson('api/monsters', [
            'name' => 'Rathalos',
            'stars' => 5,
            'materials' => $materials->pluck('id')->toArray(),
        ]);

        $response->assertStatus(201)
            ->assertJsonCount(3, 'data.materials');

        $monster = Monster::where('name', 'Rathalos')->first();
        $this->assertCount(3, $monster->materials);
    }

    public function test_player_cannot_create_monster(): void
    {
        $this->asPlayer();

        $response = $this->postJson('api/monsters', [
            'name' => 'Rathalos',
            'stars' => 5,
        ]);

        $response->assertStatus(403);
    }

    public function test_unauthenticated_user_cannot_create_monster(): void
    {
        $response = $this->postJson('api/monsters', [
            'name' => 'Rathalos',
            'stars' => 5,
        ]);

        $response->assertStatus(401);
    }

    public function test_returns_validation_error_when_name_missing(): void
    {
        $this->asAdmin();

        $response = $this->postJson('api/monsters', ['stars' => 5]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'MON-0202-0001');
    }

    public function test_returns_validation_error_when_stars_missing(): void
    {
        $this->asAdmin();

        $response = $this->postJson('api/monsters', ['name' => 'Rathalos']);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'MON-0202-0004');
    }

    public function test_returns_validation_error_when_stars_out_of_range(): void
    {
        $this->asAdmin();

        $response = $this->postJson('api/monsters', [
            'name' => 'Rathalos',
            'stars' => 8,
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'MON-0202-0007');
    }

    public function test_returns_validation_error_when_material_not_found(): void
    {
        $this->asAdmin();

        $response = $this->postJson('api/monsters', [
            'name' => 'Rathalos',
            'stars' => 5,
            'materials' => ['00000000-0000-0000-0000-000000000000'],
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'MON-0202-0013');
    }
}
