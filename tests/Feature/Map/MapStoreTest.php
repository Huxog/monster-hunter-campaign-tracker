<?php

namespace Tests\Feature\Map;

use App\Models\Map;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MapStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_creates_map_with_valid_data(): void
    {
        $response = $this->postJson('api/maps', [
            'name' => 'Ancient Forest',
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('data.name', 'Ancient Forest');

        $this->assertDatabaseHas('maps', [
            'name' => 'Ancient Forest',
        ]);
    }

    public function test_returns_validation_error_when_name_missing(): void
    {
        $response = $this->postJson('api/maps', []);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'MAP-0202-0001');
    }

    public function test_returns_validation_error_when_name_not_string(): void
    {
        $response = $this->postJson('api/maps', [
            'name' => 12345,
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'MAP-0202-0002');
    }

    public function test_returns_validation_error_when_name_already_exists(): void
    {
        Map::factory()->create(['name' => 'Ancient Forest']);

        $response = $this->postJson('api/maps', [
            'name' => 'Ancient Forest',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'MAP-0202-0003');
    }
}
