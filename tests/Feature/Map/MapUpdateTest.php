<?php

namespace Tests\Feature\Map;

use App\Models\Map;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MapUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_updates_map_with_valid_data(): void
    {
        $this->asAdmin();
        $map = Map::factory()->create([
            'name' => 'Old Name',
        ]);

        $response = $this->putJson("api/maps/{$map->id}", [
            'name' => 'New Name',
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('data.name', 'New Name');

        $this->assertDatabaseHas('maps', [
            'id' => $map->id,
            'name' => 'New Name',
        ]);
    }

    public function test_returns_404_for_non_existent_map(): void
    {
        $this->asAdmin();
        $response = $this->putJson('api/maps/019bf2f1-70b4-70e2-abd2-83879497461b', [
            'name' => 'Test',
        ]);

        $response->assertStatus(404);
    }

    public function test_returns_validation_error_when_name_missing(): void
    {
        $this->asAdmin();
        $map = Map::factory()->create();

        $response = $this->putJson("api/maps/{$map->id}", []);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'MAP-0204-0001');
    }

    public function test_returns_validation_error_when_name_already_exists(): void
    {
        $this->asAdmin();
        Map::factory()->create(['name' => 'Existing Map']);
        $map = Map::factory()->create(['name' => 'My Map']);

        $response = $this->putJson("api/maps/{$map->id}", [
            'name' => 'Existing Map',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'MAP-0204-0003');
    }
}
