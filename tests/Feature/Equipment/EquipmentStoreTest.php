<?php

namespace Tests\Feature\Equipment;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EquipmentStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_creates_equipment_with_valid_data(): void
    {
        $this->asAdmin();

        $response = $this->postJson('api/equipment', [
            'name' => 'Rathalos Helm',
            'type' => 'helmet',
            'class' => 'Great Sword',
            'armor' => 50,
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('data.name', 'Rathalos Helm')
            ->assertJsonPath('data.type', 'helmet');

        $this->assertDatabaseHas('equipment', [
            'name' => 'Rathalos Helm',
        ]);
    }

    public function test_player_cannot_create_equipment(): void
    {
        $this->asPlayer();

        $response = $this->postJson('api/equipment', [
            'name' => 'Rathalos Helm',
            'type' => 'helmet',
            'class' => 'Great Sword',
        ]);

        $response->assertStatus(403);
    }

    public function test_unauthenticated_user_cannot_create_equipment(): void
    {
        $response = $this->postJson('api/equipment', [
            'name' => 'Rathalos Helm',
            'type' => 'helmet',
            'class' => 'Great Sword',
        ]);

        $response->assertStatus(401);
    }

    public function test_returns_validation_error_when_name_missing(): void
    {
        $this->asAdmin();

        $response = $this->postJson('api/equipment', [
            'type' => 'helmet',
            'class' => 'Great Sword',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'EQP-0202-0001');
    }

    public function test_returns_validation_error_when_type_missing(): void
    {
        $this->asAdmin();

        $response = $this->postJson('api/equipment', [
            'name' => 'Rathalos Helm',
            'class' => 'Great Sword',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'EQP-0202-0004');
    }

    public function test_returns_validation_error_when_type_invalid(): void
    {
        $this->asAdmin();

        $response = $this->postJson('api/equipment', [
            'name' => 'Rathalos Helm',
            'type' => 'gloves',
            'class' => 'Great Sword',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'EQP-0202-0005');
    }

    public function test_returns_validation_error_when_class_missing(): void
    {
        $this->asAdmin();

        $response = $this->postJson('api/equipment', [
            'name' => 'Rathalos Helm',
            'type' => 'helmet',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'EQP-0202-0006');
    }

    public function test_returns_validation_error_when_class_invalid(): void
    {
        $this->asAdmin();

        $response = $this->postJson('api/equipment', [
            'name' => 'Rathalos Helm',
            'type' => 'helmet',
            'class' => 'Chainsaw',
        ]);

        $response->assertStatus(406)
            ->assertJsonPath('0.code', 'EQP-0202-0007');
    }
}
