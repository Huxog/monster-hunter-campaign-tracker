<?php

namespace Tests\Feature\Hunter;

use App\Enums\EquipmentType;
use App\Models\Equipment;
use App\Models\Hunter;
use App\Models\Weapon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HunterEquipTest extends TestCase
{
    use RefreshDatabase;

    // -------------------------------------------------------------------------
    // equip weapon
    // -------------------------------------------------------------------------

    public function test_player_can_equip_weapon_from_inventory(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create();
        $weapon = Weapon::factory()->create();
        $hunter->inventoryWeapons()->attach($weapon->id);

        $this->postJson("api/hunters/{$hunter->id}/equip/weapon", [
            'equippableId' => $weapon->id,
        ])
            ->assertOk()
            ->assertJsonPath('data.weapon.id', $weapon->id);

        $this->assertDatabaseHas('hunters', [
            'id' => $hunter->id,
            'weaponId' => $weapon->id,
        ]);
    }

    public function test_returns_422_when_weapon_not_in_inventory(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create();
        $weapon = Weapon::factory()->create();

        $this->postJson("api/hunters/{$hunter->id}/equip/weapon", [
            'equippableId' => $weapon->id,
        ])
            ->assertUnprocessable()
            ->assertJsonPath('code', 'HUN-0306-0004');
    }

    public function test_returns_404_when_weapon_does_not_exist(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create();

        $this->postJson("api/hunters/{$hunter->id}/equip/weapon", [
            'equippableId' => '019bf2f1-70b4-70e2-abd2-83879497461b',
        ])->assertNotFound();
    }

    // -------------------------------------------------------------------------
    // equip helmet
    // -------------------------------------------------------------------------

    public function test_player_can_equip_helmet_from_inventory(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create();
        $helmet = Equipment::factory()->create(['type' => EquipmentType::Helmet]);
        $hunter->inventoryEquipment()->attach($helmet->id);

        $this->postJson("api/hunters/{$hunter->id}/equip/helmet", [
            'equippableId' => $helmet->id,
        ])
            ->assertOk()
            ->assertJsonPath('data.helmet.id', $helmet->id);

        $this->assertDatabaseHas('hunters', [
            'id' => $hunter->id,
            'helmetId' => $helmet->id,
        ]);
    }

    public function test_cannot_equip_vest_in_helmet_slot(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create();
        $vest = Equipment::factory()->create(['type' => EquipmentType::Vest]);
        $hunter->inventoryEquipment()->attach($vest->id);

        $this->postJson("api/hunters/{$hunter->id}/equip/helmet", [
            'equippableId' => $vest->id,
        ])
            ->assertUnprocessable()
            ->assertJsonPath('code', 'HUN-0306-0004');
    }

    // -------------------------------------------------------------------------
    // equip vest
    // -------------------------------------------------------------------------

    public function test_player_can_equip_vest_from_inventory(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create();
        $vest = Equipment::factory()->create(['type' => EquipmentType::Vest]);
        $hunter->inventoryEquipment()->attach($vest->id);

        $this->postJson("api/hunters/{$hunter->id}/equip/vest", [
            'equippableId' => $vest->id,
        ])
            ->assertOk()
            ->assertJsonPath('data.vest.id', $vest->id);
    }

    public function test_cannot_equip_trouser_in_vest_slot(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create();
        $trouser = Equipment::factory()->create(['type' => EquipmentType::Trouser]);
        $hunter->inventoryEquipment()->attach($trouser->id);

        $this->postJson("api/hunters/{$hunter->id}/equip/vest", [
            'equippableId' => $trouser->id,
        ])
            ->assertUnprocessable()
            ->assertJsonPath('code', 'HUN-0306-0004');
    }

    // -------------------------------------------------------------------------
    // equip trouser
    // -------------------------------------------------------------------------

    public function test_player_can_equip_trouser_from_inventory(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create();
        $trouser = Equipment::factory()->create(['type' => EquipmentType::Trouser]);
        $hunter->inventoryEquipment()->attach($trouser->id);

        $this->postJson("api/hunters/{$hunter->id}/equip/trouser", [
            'equippableId' => $trouser->id,
        ])
            ->assertOk()
            ->assertJsonPath('data.trousers.id', $trouser->id);
    }

    // -------------------------------------------------------------------------
    // shared validation
    // -------------------------------------------------------------------------

    public function test_returns_406_when_equippable_id_missing(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create();

        $this->postJson("api/hunters/{$hunter->id}/equip/weapon", [])
            ->assertStatus(406)
            ->assertJsonPath('0.code', 'HUN-0206-0015');
    }

    public function test_returns_406_when_equippable_id_not_uuid(): void
    {
        $this->asPlayer();
        $hunter = Hunter::factory()->create();

        $this->postJson("api/hunters/{$hunter->id}/equip/weapon", ['equippableId' => 'not-a-uuid'])
            ->assertStatus(406)
            ->assertJsonPath('0.code', 'HUN-0206-0016');
    }

    public function test_unauthenticated_user_cannot_equip(): void
    {
        $hunter = Hunter::factory()->create();

        $this->postJson("api/hunters/{$hunter->id}/equip/weapon", [
            'equippableId' => '019bf2f1-70b4-70e2-abd2-83879497461b',
        ])->assertUnauthorized();
    }
}
