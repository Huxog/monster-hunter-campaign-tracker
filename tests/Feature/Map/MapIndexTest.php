<?php

namespace Tests\Feature\Map;

use App\Models\Map;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MapIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_all_maps(): void
    {
        $this->asPlayer();
        Map::factory()->count(5)->create();

        $response = $this->getJson('api/maps');

        $response->assertStatus(200)
            ->assertJsonCount(5, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name', 'createdAt', 'updatedAt'],
                ],
            ]);
    }

    public function test_returns_empty_array_when_no_maps_exist(): void
    {
        $this->asPlayer();
        $response = $this->getJson('api/maps');

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    public function test_does_not_return_soft_deleted_maps(): void
    {
        $this->asPlayer();
        Map::factory()->count(3)->create();
        $deletedMap = Map::factory()->create();
        $deletedMap->delete();

        $response = $this->getJson('api/maps');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }
}
