<?php

namespace Tests\Unit\Enums;

use App\Enums\WeaponClass;
use PHPUnit\Framework\TestCase;

class WeaponClassTest extends TestCase
{
    public function test_has_expected_number_of_weapon_classes(): void
    {
        $this->assertCount(14, WeaponClass::cases());
    }

    public function test_all_weapon_classes_have_string_values(): void
    {
        foreach (WeaponClass::cases() as $weaponClass) {
            $this->assertIsString($weaponClass->value);
            $this->assertNotEmpty($weaponClass->value);
        }
    }

    public function test_can_create_from_valid_value(): void
    {
        $bow = WeaponClass::from('Bow');
        $this->assertEquals(WeaponClass::Bow, $bow);
    }

    public function test_try_from_returns_null_for_invalid_value(): void
    {
        $result = WeaponClass::tryFrom('InvalidWeapon');
        $this->assertNull($result);
    }

    public function test_contains_all_monster_hunter_weapon_types(): void
    {
        $expectedWeapons = [
            'Bow',
            'Great Sword',
            'Dual Blades',
            'Long Sword',
            'Sword and Shield',
            'Hammer',
            'Lance',
            'Gun Lance',
            'Switch Axe',
            'Charge Blade',
            'Insect Glaive',
            'Light Bowgun',
            'Heavy Bowgun',
            'Hunting Horn',
        ];

        $actualValues = array_map(fn ($case) => $case->value, WeaponClass::cases());

        foreach ($expectedWeapons as $weapon) {
            $this->assertContains($weapon, $actualValues, "Missing weapon: {$weapon}");
        }
    }
}