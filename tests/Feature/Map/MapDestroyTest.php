<?php

namespace Tests\Feature\Map;

use App\Models\Map;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MapDestroyTest extends TestCase
{
    use RefreshDatabase;

    public function test_soft_deletes_map(): void
    {
        $this->asAdmin();
        $map = Map::factory()->create();

        $response = $this->deleteJson("api/maps/{$map->id}");

        $response->assertStatus(200);

        $this->assertSoftDeleted('maps', [
            'id' => $map->id,
        ]);
    }

    public function test_deleted_map_not_in_index(): void
    {
        $this->asAdmin();
        $map = Map::factory()->create();
        $map->delete();

        $response = $this->getJson('api/maps');

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    public function test_returns_404_for_non_existent_map(): void
    {
        $this->asAdmin();
        $response = $this->deleteJson('api/maps/019bf2f1-70b4-70e2-abd2-83879497461b');

        $response->assertStatus(404);
    }

    public function test_returns_404_for_already_deleted_map(): void
    {
        $this->asAdmin();
        $map = Map::factory()->create();
        $map->delete();

        $response = $this->deleteJson("api/maps/{$map->id}");

        $response->assertStatus(404);
    }
}
