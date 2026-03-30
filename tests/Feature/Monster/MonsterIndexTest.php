<?php

namespace Tests\Feature\Monster;

use App\Models\Monster;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MonsterIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_all_monsters(): void
    {
        $this->asPlayer();
        Monster::factory()->count(5)->create();

        $response = $this->getJson('api/monsters');

        $response->assertStatus(200)
            ->assertJsonCount(5, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name', 'description', 'stars', 'elementalWeaknesses', 'ailmentWeaknesses', 'imagePath', 'createdAt', 'updatedAt'],
                ],
            ]);
    }

    public function test_returns_empty_array_when_no_monsters_exist(): void
    {
        $this->asPlayer();

        $response = $this->getJson('api/monsters');

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    public function test_does_not_return_soft_deleted_monsters(): void
    {
        $this->asPlayer();
        Monster::factory()->count(3)->create();
        Monster::factory()->create()->delete();

        $response = $this->getJson('api/monsters');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function test_unauthenticated_user_cannot_list_monsters(): void
    {
        $response = $this->getJson('api/monsters');

        $response->assertStatus(401);
    }
}
