<?php

namespace Tests\Feature\Hunter;

use App\Models\Hunter;
use App\Models\Material;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HunterLootTest extends TestCase
{
    use RefreshDatabase;

    // -------------------------------------------------------------------------
    // addLoot
    // -------------------------------------------------------------------------

    public function test_player_can_add_material_to_loot(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create();
        $material = Material::factory()->create();

        $this->postJson("api/hunters/{$hunter->id}/loot", [
            'materialId' => $material->id,
            'quantity' => 3,
        ])
            ->assertOk()
            ->assertJsonCount(1, 'data.loot');

        $this->assertDatabaseHas('loot', [
            'hunterId' => $hunter->id,
            'materialId' => $material->id,
            'quantity' => 3,
        ]);
    }

    public function test_adding_existing_material_increments_quantity(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create();
        $material = Material::factory()->create();
        $hunter->loot()->attach($material->id, ['quantity' => 2]);

        $this->postJson("api/hunters/{$hunter->id}/loot", [
            'materialId' => $material->id,
            'quantity' => 5,
        ])->assertOk();

        $this->assertDatabaseHas('loot', [
            'hunterId' => $hunter->id,
            'materialId' => $material->id,
            'quantity' => 7,
        ]);
    }

    public function test_unauthenticated_user_cannot_add_loot(): void
    {
        $hunter = Hunter::factory()->create();
        $material = Material::factory()->create();

        $this->postJson("api/hunters/{$hunter->id}/loot", [
            'materialId' => $material->id,
            'quantity' => 1,
        ])->assertUnauthorized();
    }

    public function test_returns_406_when_material_id_missing_on_add(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create();

        $this->postJson("api/hunters/{$hunter->id}/loot", ['quantity' => 1])
            ->assertStatus(406)
            ->assertJsonPath('0.code', 'HUN-0206-0006');
    }

    public function test_returns_406_when_material_does_not_exist(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create();

        $this->postJson("api/hunters/{$hunter->id}/loot", [
            'materialId' => '019bf2f1-70b4-70e2-abd2-83879497461b',
            'quantity' => 1,
        ])
            ->assertStatus(406)
            ->assertJsonPath('0.code', 'HUN-0206-0008');
    }

    public function test_returns_406_when_quantity_is_zero_on_add(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create();
        $material = Material::factory()->create();

        $this->postJson("api/hunters/{$hunter->id}/loot", [
            'materialId' => $material->id,
            'quantity' => 0,
        ])
            ->assertStatus(406)
            ->assertJsonPath('0.code', 'HUN-0206-0011');
    }

    // -------------------------------------------------------------------------
    // decreaseLoot
    // -------------------------------------------------------------------------

    public function test_player_can_decrease_material_quantity(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create();
        $material = Material::factory()->create();
        $hunter->loot()->attach($material->id, ['quantity' => 5]);

        $this->patchJson("api/hunters/{$hunter->id}/loot/{$material->id}", ['quantity' => 2])
            ->assertOk();

        $this->assertDatabaseHas('loot', [
            'hunterId' => $hunter->id,
            'materialId' => $material->id,
            'quantity' => 3,
        ]);
    }

    public function test_decreasing_to_zero_removes_entry(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create();
        $material = Material::factory()->create();
        $hunter->loot()->attach($material->id, ['quantity' => 3]);

        $this->patchJson("api/hunters/{$hunter->id}/loot/{$material->id}", ['quantity' => 3])
            ->assertOk();

        $this->assertDatabaseMissing('loot', [
            'hunterId' => $hunter->id,
            'materialId' => $material->id,
        ]);
    }

    public function test_decreasing_below_zero_removes_entry(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create();
        $material = Material::factory()->create();
        $hunter->loot()->attach($material->id, ['quantity' => 2]);

        $this->patchJson("api/hunters/{$hunter->id}/loot/{$material->id}", ['quantity' => 10])
            ->assertOk();

        $this->assertDatabaseMissing('loot', [
            'hunterId' => $hunter->id,
            'materialId' => $material->id,
        ]);
    }

    public function test_returns_404_when_decreasing_material_not_in_loot(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create();
        $material = Material::factory()->create();

        $this->patchJson("api/hunters/{$hunter->id}/loot/{$material->id}", ['quantity' => 1])
            ->assertNotFound();
    }

    public function test_returns_406_when_quantity_missing_on_decrease(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create();
        $material = Material::factory()->create();

        $this->patchJson("api/hunters/{$hunter->id}/loot/{$material->id}", [])
            ->assertStatus(406)
            ->assertJsonPath('0.code', 'HUN-0206-0012');
    }

    // -------------------------------------------------------------------------
    // removeLoot
    // -------------------------------------------------------------------------

    public function test_player_can_remove_material_from_loot(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create();
        $material = Material::factory()->create();
        $hunter->loot()->attach($material->id, ['quantity' => 5]);

        $this->deleteJson("api/hunters/{$hunter->id}/loot/{$material->id}")
            ->assertOk();

        $this->assertDatabaseMissing('loot', [
            'hunterId' => $hunter->id,
            'materialId' => $material->id,
        ]);
    }

    public function test_returns_404_when_removing_material_not_in_loot(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create();
        $material = Material::factory()->create();

        $this->deleteJson("api/hunters/{$hunter->id}/loot/{$material->id}")
            ->assertNotFound();
    }

    public function test_unauthenticated_user_cannot_remove_loot(): void
    {
        $hunter = Hunter::factory()->create();
        $material = Material::factory()->create();

        $this->deleteJson("api/hunters/{$hunter->id}/loot/{$material->id}")
            ->assertUnauthorized();
    }
}
