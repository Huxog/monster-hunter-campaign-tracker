<?php

namespace Tests\Feature\Map;

use App\Models\Map;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MapShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_single_map(): void
    {
        $map = Map::factory()->create([
            'name' => 'Ancient Forest',
        ]);

        $response = $this->getJson("api/maps/{$map->id}");

        $response->assertStatus(200)
            ->assertJsonPath('data.id', $map->id)
            ->assertJsonPath('data.name', 'Ancient Forest');
    }

    public function test_returns_404_for_non_existent_map(): void
    {
        $response = $this->getJson('api/maps/019bf2f1-70b4-70e2-abd2-83879497461b');

        $response->assertStatus(404)
            ->assertJsonPath('code', 'RES-0200-0001');
    }

    public function test_returns_404_for_soft_deleted_map(): void
    {
        $map = Map::factory()->create();
        $map->delete();

        $response = $this->getJson("api/maps/{$map->id}");

        $response->assertStatus(404);
    }
}
